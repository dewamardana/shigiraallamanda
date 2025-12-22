@extends('Dashboard.Layout.main')

@section('content')
  <div class="max-w-4xl mx-auto space-y-6">

    {{-- Title --}}
    <h2 class="text-2xl font-bold text-gray-800">
      Report Detail
    </h2>

    {{-- Report Info Card --}}
    <div class="bg-white rounded-xl shadow p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <p class="text-sm text-gray-500">Pelapor</p>
        <p class="font-semibold text-gray-800">{{ $report->user->nama }}</p>
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
                onclick="openMediaModal('{{ asset('storage/' . $media->path) }}', 'image')">
            @else
              <video src="{{ asset('storage/' . $media->path) }}"
                class="w-full h-32 object-cover rounded-lg shadow cursor-pointer hover:opacity-80"
                onclick="openMediaModal('{{ asset('storage/' . $media->path) }}', 'video')">
              </video>
            @endif
          @endforeach
        </div>
      </div>
    @endif

    {{-- Reply / Form --}}
    @if ($report->reply)
      <div class="bg-green-50 border border-green-200 rounded-xl p-6">
        <p class="text-sm text-green-700 font-medium mb-2">
          Catatan Admin Terakhir
        </p>
        <p class="text-gray-800 leading-relaxed">
          {{ $report->reply }}
        </p>
      </div>
    @endif
    <form action="{{ route('reports.reply', $report) }}" method="POST"
      class="bg-gray-50 rounded-xl shadow p-6 space-y-4">
      @csrf

      <h3 class="text-lg font-semibold text-gray-700">
        Update Status & Catatan
      </h3>

      {{-- Status --}}
      <div>
        <label class="block mb-1 text-sm font-medium text-gray-700">
          Status
        </label>
        <select name="status" required class="w-full border rounded-lg p-2">
          <option value="pending" @selected($report->status === 'pending')>Pending</option>
          <option value="in_progress" @selected($report->status === 'in_progress')>In Progress</option>
          <option value="resolved" @selected($report->status === 'resolved')>Resolved</option>
          <option value="rejected" @selected($report->status === 'rejected')>Rejected</option>
        </select>
      </div>

      {{-- Reply --}}
      <div>
        <label class="block mb-1 text-sm font-medium text-gray-700">
          Catatan / Balasan Admin
        </label>
        <textarea name="reply" rows="4" class="w-full border rounded-lg p-2"
          placeholder="Update progres / catatan baru...">{{ old('reply', $report->reply) }}</textarea>
      </div>

      <div class="flex justify-center gap-4 mt-6">
        <button type="submit"
          class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-6 py-2.5">
          {{ __('button.edit') }}
        </button>

        <a href="{{ route('reportData') }}"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 focus:outline-none">
          {{ __('button.back') }}
        </a>
      </div>
    </form>


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

@section('scripts')
  <script>
    function openMediaModal(src, type) {
      const modal = document.getElementById('mediaModal');
      const content = document.getElementById('mediaContent');

      if (type === 'image') {
        content.innerHTML = `<img src="${src}" class="max-h-[80vh] rounded-lg">`;
      } else {
        content.innerHTML = `<video src="${src}" controls autoplay class="max-h-[80vh] rounded-lg"></video>`;
      }

      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }

    function closeMediaModal() {
      const modal = document.getElementById('mediaModal');
      const content = document.getElementById('mediaContent');
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      content.innerHTML = '';
    }
  </script>
@endsection
