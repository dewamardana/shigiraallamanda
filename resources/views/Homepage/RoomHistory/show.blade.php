@extends('Homepage.Layout.main')

@section('content')
  <div class="max-w-screen-2xl mx-auto px-4 md:px-6 lg:px-8 py-6 md:py-8 space-y-10">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8 mt-5">

      {{-- STATUS --}}
      <div
        class="p-4 rounded-lg shadow bg-white border-l-8
  {{ $reports->where('status', 'pending')->count() ? 'border-red-500' : 'border-green-500' }}">
        <p class="text-sm text-gray-500">Status Kamar</p>
        <p class="text-xl font-bold">
          {{ $reports->where('status', 'pending')->count() ? '⚠️ Bermasalah' : '✅ Aman' }}
        </p>
      </div>

      {{-- LAST CLEANING --}}
      @php
        $lastCleaning = $cleaningPaginated->first();
      @endphp
      <div class="p-4 rounded-lg shadow bg-white">
        <p class="text-sm text-gray-500">Cleaning Terakhir</p>
        <p class="font-semibold">{{ $lastCleaning->record->date ?? '-' }}</p>
        <p class="text-xs text-gray-400">{{ $lastCleaning->record->members->pluck('nama')->join(', ') ?? '' }}</p>
      </div>

      {{-- LAST CHECKER --}}
      @php
        $lastChecker = $checkerPaginated->first();
      @endphp
      <div class="p-4 rounded-lg shadow bg-white">
        <p class="text-sm text-gray-500">Checker Terakhir</p>
        <p class="font-semibold">{{ $lastChecker->detail->record->date ?? '-' }}</p>
        <p class="text-xs text-gray-400">{{ $lastChecker->detail->record->user->nama ?? '-' }}</p>
      </div>

      {{-- REPORT --}}
      <div class="p-4 rounded-lg shadow bg-white">
        <p class="text-sm text-gray-500">Report Aktif</p>
        <p class="text-2xl font-bold text-red-600">
          {{ $reports->whereIn('status', ['pending', 'in_progress'])->count() }}
        </p>
      </div>
    </div>


    <h2 class="text-lg font-bold text-purple-700">🧹 Riwayat Cleaning</h2>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
      @foreach ($cleaningPaginated as $c)
        <div class="bg-white rounded-xl shadow p-4 cursor-pointer" onclick="openModal('cleaning-{{ $c->id }}')">
          <span class="text-xs bg-purple-100 px-2 py-1 rounded">{{ $c->record->date }}</span>
          <p class="font-semibold mt-1">{{ $c->task->name }}</p>
          <p class="text-sm text-gray-600 mt-1">Petugas: {{ $c->record->members->pluck('nama')->join(', ') }}</p>
          <p class="text-sm text-gray-600">Gedung: {{ $c->record->group->building_name ?? '-' }}</p>
        </div>

        {{-- Modal per record --}}
        <div id="cleaning-{{ $c->id }}" class="fixed inset-0 hidden items-center justify-center bg-black/50 z-50">
          <div class="bg-white rounded-xl max-w-3xl w-full p-6">
            <h3 class="font-bold mb-4">Detail Cleaning {{ $c->record->date }}</h3>
            <p class="font-semibold">{{ $c->task->name }}</p>
            <p class="text-sm">Petugas: {{ $c->record->members->pluck('nama')->join(', ') }}</p>
            <p class="text-sm">Gedung: {{ $c->record->group->building_name ?? '-' }}</p>
            <button onclick="closeModal('cleaning-{{ $c->id }}')"
              class="mt-4 px-4 py-2 bg-purple-600 text-white rounded">
              Tutup
            </button>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-6">
      {{ $cleaningPaginated->links('vendor.pagination.flowbite') }}
    </div>

    <h2 class="text-lg font-bold mb-4 text-green-700">✅ Riwayat Checker</h2>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
      @foreach ($checkerPaginated as $c)
        <div class="bg-white rounded-xl shadow p-4 cursor-pointer" onclick="openModal('checker-{{ $c->id }}')">
          <span class="text-xs bg-green-100 px-2 py-1 rounded">{{ $c->detail->record->date }}</span>
          <p class="font-semibold mt-1">{{ $c->detail->task->name }}</p>
          <p class="text-sm text-gray-600 mt-1">Checker: {{ $c->detail->record->user->nama ?? '-' }}</p>
          <p class="text-sm text-gray-600">Gedung: {{ $c->group->building_name ?? '-' }}</p>
        </div>

        {{-- Modal per record --}}
        <div id="checker-{{ $c->id }}" class="fixed inset-0 hidden items-center justify-center bg-black/50 z-50">
          <div class="bg-white rounded-xl max-w-3xl w-full p-6">
            <h3 class="font-bold mb-4">Detail Checker {{ $c->detail->record->date }}</h3>
            <p class="font-semibold">{{ $c->detail->task->name }}</p>
            <p class="text-sm">Checker: {{ $c->detail->record->user->nama ?? '-' }}</p>
            <p class="text-sm">Gedung: {{ $c->group->building_name ?? '-' }}</p>
            <button onclick="closeModal('checker-{{ $c->id }}')"
              class="mt-4 px-4 py-2 bg-green-600 text-white rounded">
              Tutup
            </button>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-6">
      {{ $checkerPaginated->links('vendor.pagination.flowbite') }}
    </div>


    <h2 class="text-lg font-bold text-red-600 mb-4">🛠️ Report & Masalah</h2>
    <div class="bg-white rounded-xl shadow overflow-hidden">
      <table class="w-full text-sm bg-white rounded-lg shadow overflow-hidden">
        <thead class="bg-red-600 text-white text-center">
          <tr>
            <th class="px-4 py-2">Tanggal</th>
            <th class="px-4 py-2">Masalah</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($reports as $report)
            <tr class="border-t hover:bg-red-50 text-center">
              <td class="px-4 py-2">{{ $report->date }}</td>
              <td class="px-4 py-2 font-medium">{{ $report->report_type }}</td>
              <td class="px-4 py-2">
                <span
                  class="px-2 py-1 rounded text-xs font-semibold
            {{ $report->status === 'pending'
                ? 'bg-yellow-200 text-yellow-800'
                : ($report->status === 'resolved'
                    ? 'bg-green-200 text-green-800'
                    : 'bg-blue-200 text-blue-800') }}">
                  {{ ucfirst($report->status) }}
                </span>
              </td>
              <td class="px-4 py-2">
                <a href="{{ route('reportHistory.show', $report) }}"
                  class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded">
                  Detail
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center py-4 text-gray-500 italic">
                Tidak ada laporan
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('script')
  <script>
    function openModal(id) {
      const modal = document.getElementById(id);
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }

    function closeModal(id) {
      const modal = document.getElementById(id);
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  </script>
@endsection
