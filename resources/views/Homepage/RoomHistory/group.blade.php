@extends('Homepage.Layout.main')

@section('content')
  {{-- ✅ Pastikan Alpine.js dimuat --}}
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="roomHistory()">
    <!-- Tombol Kembali -->
    <div class="mb-6">
      <a href="{{ route('showGroup') }}"
        class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm w-full px-5 py-2.5 text-center me-2 mb-2">
        {{ __('button.back') }}
      </a>
    </div>

    <!-- Judul Halaman -->
    <div class="text-center mb-8">
      <h1 class="text-3xl font-extrabold text-teal-900">
        Room Tracker – {{ $group->building_name }}
      </h1>
      <p class="text-slate-600 mt-2 text-sm sm:text-base">
        Status pembersihan ruangan per <span class="font-semibold text-teal-700">{{ $today }}</span>
      </p>
    </div>

    <!-- Legenda Warna -->
    <div class="flex flex-wrap justify-center gap-3 mb-6">
      <div class="flex items-center gap-2">
        <span class="w-4 h-4 rounded-sm bg-green-500"></span>
        <span class="text-sm text-slate-600">Dibersihkan hari ini</span>
      </div>
      <div class="flex items-center gap-2">
        <span class="w-4 h-4 rounded-sm bg-yellow-400"></span>
        <span class="text-sm text-slate-600">Dibersihkan &lt; 30 hari</span>
      </div>
      <div class="flex items-center gap-2">
        <span class="w-4 h-4 rounded-sm bg-red-500"></span>
        <span class="text-sm text-slate-600">Belum dibersihkan &gt; 30 hari</span>
      </div>
      <div class="flex items-center gap-2">
        <span class="w-4 h-4 rounded-sm bg-gray-300"></span>
        <span class="text-sm text-slate-600">Belum ada data</span>
      </div>
    </div>

    <!-- Grid Daftar Ruangan -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-8 gap-3">
      @foreach ($rooms as $room)
        @php
          $last = $lastCleaned[$room->id] ?? null;
          $colorClass = 'bg-gray-200 text-gray-700 hover:bg-gray-300'; // default

          if ($last === $today) {
              $colorClass = 'bg-green-500 text-white hover:bg-green-600';
          } elseif ($last && \Carbon\Carbon::parse($last)->diffInDays(now()) <= 30) {
              $colorClass = 'bg-yellow-400 text-black hover:bg-yellow-500';
          } elseif ($last && \Carbon\Carbon::parse($last)->diffInDays(now()) > 30) {
              $colorClass = 'bg-red-500 text-white hover:bg-red-600';
          }
        @endphp

        {{-- <button type="button" @click="openHistory({{ $room->id }})"
          class="transition-transform transform hover:-translate-y-1 w-full">
          <div
            class="flex flex-col justify-center items-center p-3 rounded-lg font-semibold cursor-pointer shadow-sm hover:shadow-md transition {{ $colorClass }} min-h-[80px]">
            <div class="truncate w-full text-center">{{ $room->room_name }}</div>
            <div class="text-xs mt-1 opacity-90 text-center w-full">
              @if ($last)
                {{ \Carbon\Carbon::parse($last)->format('d M Y') }}
              @else
                <span class="italic opacity-70">Belum dibersihkan</span>
              @endif
            </div>
          </div>
        </button> --}}
        <a href="{{ route('roomHistory', $room->id) }}" class="transition-transform transform hover:-translate-y-1">
          <div
            class="flex flex-col justify-center items-center p-3 rounded-lg font-semibold cursor-pointer shadow-sm hover:shadow-md transition {{ $colorClass }} min-h-[80px]">
            <div class="truncate w-full text-center">{{ $room->room_name }}</div>
            <div class="text-xs mt-1 opacity-90 text-center w-full">
              @if ($last)
                {{ \Carbon\Carbon::parse($last)->format('d M Y') }}
              @else
                <span class="italic opacity-70">Belum dibersihkan</span>
              @endif
            </div>
          </div>
        </a>
      @endforeach
    </div>

    @if ($rooms->isEmpty())
      <div class="mt-8 text-center bg-white border border-slate-200 rounded-xl shadow p-6">
        <i data-feather="info" class="mx-auto w-10 h-10 text-slate-400 mb-3"></i>
        <p class="text-slate-600">Belum ada ruangan terdaftar pada gedung ini.</p>
      </div>
    @endif

    <!-- ✅ Modal Popup -->
    <template x-if="modalOpen">
      <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-2/3 lg:w-1/2 max-h-[80vh] overflow-y-auto animate-fadeIn">
          <div class="flex justify-between items-center border-b px-4 py-2 bg-purple-600 text-white">
            <h2 class="font-bold text-lg" x-text="'🧹 Riwayat Pembersihan - Room ' + roomName"></h2>
            <button @click="closeModal()" class="text-white hover:text-gray-200 text-2xl leading-none">&times;</button>
          </div>
          <div class="p-4">
            <template x-if="loading">
              <div class="text-center text-gray-500 py-6">Memuat data...</div>
            </template>
            <template x-if="!loading">
              <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm text-sm">
                <thead class="bg-gray-200">
                  <tr>
                    <th class="p-2 border text-center">Tanggal</th>
                    <th class="p-2 border text-center">Task</th>
                    <th class="p-2 border text-center">Petugas</th>
                    <th class="p-2 border text-center">Group</th>
                  </tr>
                </thead>
                <tbody>
                  <template x-if="history.length === 0">
                    <tr>
                      <td colspan="4" class="p-4 text-center text-gray-500">Belum ada riwayat untuk kamar ini.</td>
                    </tr>
                  </template>
                  <template x-for="row in history" :key="row.tanggal + row.task">
                    <tr class="hover:bg-gray-100">
                      <td class="p-2 border text-center" x-text="row.tanggal"></td>
                      <td class="p-2 border text-center" x-text="row.task"></td>
                      <td class="p-2 border text-center" x-text="row.petugas"></td>
                      <td class="p-2 border text-center" x-text="row.group"></td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </template>
          </div>
        </div>
      </div>
    </template>
  </div>
@endsection

@section('script')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      feather.replace();
    });

    function roomHistory() {
      return {
        modalOpen: false,
        loading: false,
        roomName: '',
        history: [],

        async openHistory(roomId) {
          this.modalOpen = true;
          this.loading = true;
          this.history = [];
          this.roomName = '...';

          try {
            const res = await fetch(`/homepage/room-history/${roomId}`);
            const data = await res.json();

            this.roomName = data.room_name;
            this.history = data.history;
          } catch (err) {
            console.error('❌ Gagal mengambil data:', err);
            this.history = [];
          } finally {
            this.loading = false;
          }
        },

        closeModal() {
          this.modalOpen = false;
        }
      }
    }
  </script>

  <style>
    .animate-fadeIn {
      animation: fadeIn 0.25s ease-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.98);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }
  </style>
@endsection
