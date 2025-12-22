@extends('Homepage.Layout.main')

@section('content')
  <div class="max-w-4xl mx-auto my-6 space-y-6">

    {{-- Title --}}
    <h2 class="text-2xl font-bold text-teal-800 text-center">
      Detail Report
    </h2>

    {{-- Report Info --}}
    <div class="bg-white rounded-xl shadow p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <p class="text-sm text-gray-500">Pelapor</p>
        <p class="font-semibold text-gray-800">
          {{ $report->user->nama }}
        </p>
      </div>

      <div>
        <p class="text-sm text-gray-500">Tanggal</p>
        <p class="font-semibold text-gray-800">
          {{ \Carbon\Carbon::parse($report->date)->format('d M Y') }}
        </p>
      </div>

      <div>
        <p class="text-sm text-gray-500">Tipe Laporan</p>
        <span class="inline-block mt-1 px-3 py-1 text-sm rounded bg-teal-600 text-white">
          {{ $report->report_type }}
        </span>
      </div>

      <div>
        <p class="text-sm text-gray-500">Status</p>
        <span
          class="inline-block mt-1 px-3 py-1 text-sm rounded
          @if ($report->status === 'pending') bg-gray-400
          @elseif($report->status === 'in_progress') bg-yellow-500
          @elseif($report->status === 'resolved') bg-green-600
          @else bg-red-600 @endif
          text-white">
          {{ ucfirst(str_replace('_', ' ', $report->status)) }}
        </span>
      </div>
    </div>

    {{-- Description --}}
    <div class="bg-white rounded-xl shadow p-6">
      <p class="text-sm text-gray-500 mb-2">Deskripsi Laporan</p>
      <p class="text-gray-700 leading-relaxed">
        {{ $report->description ?? '-' }}
      </p>
    </div>

    {{-- Media --}}
    @if ($report->media->count())
      <div class="bg-white rounded-xl shadow p-6">
        <p class="text-sm text-gray-500 mb-3">Lampiran</p>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
          @foreach ($report->media as $media)
            @if ($media->type === 'photo')
              <img src="{{ asset('storage/' . $media->path) }}"
                class="w-full h-32 object-cover rounded-lg shadow cursor-pointer hover:opacity-80"
                onclick="openMediaModal('{{ asset('storage/' . $media->path) }}','image')">
            @else
              <video src="{{ asset('storage/' . $media->path) }}"
                class="w-full h-32 object-cover rounded-lg shadow cursor-pointer hover:opacity-80"
                onclick="openMediaModal('{{ asset('storage/' . $media->path) }}','video')">
              </video>
            @endif
          @endforeach
        </div>
      </div>
    @endif

    {{-- Admin Reply --}}
    @if ($report->reply)
      <div class="bg-green-50 border border-green-200 rounded-xl p-6">
        <p class="text-sm text-green-700 font-medium mb-2">
          Catatan Admin
        </p>
        <p class="text-gray-800 leading-relaxed">
          {{ $report->reply }}
        </p>
      </div>
    @else
      <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
        <p class="text-sm text-yellow-700">
          Belum ada balasan dari admin.
        </p>
      </div>
    @endif

    {{-- Back Button
    <div class="bg-white rounded-xl shadow p-2">
      <div class="flex justify-end">
        <a href="{{ route('reportHistory') }}"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
          {{ __('button.back') }}
        </a>
      </div>
    </div> --}}
  </div>



  {{-- Media Modal --}}
  <div id="mediaModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50"
    onclick="closeMediaModal()">
    <div class="bg-white rounded-lg p-4 max-w-4xl w-full relative" onclick="event.stopPropagation()">
      <button onclick="closeMediaModal()" class="absolute top-2 right-2 text-gray-600 hover:text-red-500">
        ✖
      </button>
      <div id="mediaContent" class="flex justify-center"></div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    function openMediaModal(src, type) {
      const modal = document.getElementById('mediaModal');
      const content = document.getElementById('mediaContent');

      content.innerHTML = type === 'image' ?
        `<img src="${src}" class="max-h-[80vh] rounded-lg">` :
        `<video src="${src}" controls autoplay class="max-h-[80vh] rounded-lg"></video>`;

      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }

    function closeMediaModal() {
      document.getElementById('mediaModal').classList.add('hidden');
      document.getElementById('mediaContent').innerHTML = '';
    }
  </script>
@endsection
