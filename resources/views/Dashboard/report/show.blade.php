@extends('Dashboard.Layout.main')

@section('content')
  <div class="max-w-4xl mx-auto px-4 py-6 space-y-6">

    {{-- Title --}}
    <h2 class="text-xl sm:text-2xl font-bold text-teal-800 text-center">
      Detail Report
    </h2>

    {{-- Report Info --}}
    <div class="bg-white rounded-xl shadow p-4 sm:p-6 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
      <div>
        <p class="text-gray-500">Pelapor</p>
        <p class="font-semibold text-gray-800">{{ $report->user->nama }}</p>
      </div>

      <div>
        <p class="text-gray-500">Tanggal</p>
        <p class="font-semibold text-gray-800">
          {{ \Carbon\Carbon::parse($report->date)->format('d M Y') }}
        </p>
      </div>

      <div>
        <p class="text-gray-500">Tipe Laporan</p>
        <span class="inline-block mt-1 px-3 py-1 text-xs rounded bg-teal-600 text-white">
          {{ $report->report_type }}
        </span>
      </div>

      <div>
        <p class="text-gray-500">Status</p>
        <span
          class="inline-block mt-1 px-3 py-1 text-xs rounded text-white
        @if ($report->status === 'pending') bg-gray-400
        @elseif($report->status === 'in_progress') bg-yellow-500
        @elseif($report->status === 'resolved') bg-green-600
        @else bg-red-600 @endif">
          {{ ucfirst(str_replace('_', ' ', $report->status)) }}
        </span>
      </div>
    </div>

    {{-- Description --}}
    <div class="bg-white rounded-xl shadow p-4 sm:p-6">
      <p class="text-sm text-gray-500 mb-1">Deskripsi</p>
      <p class="text-gray-700 text-sm leading-relaxed">
        {{ $report->description ?? '-' }}
      </p>
    </div>

    {{-- Reply Lama --}}
    @if ($report->reply)
      <div class="bg-green-50 border border-green-200 rounded-xl p-4">
        <p class="text-sm font-medium text-green-700 mb-1">Catatan Terakhir</p>
        <p class="text-sm text-gray-800">{{ $report->reply }}</p>
      </div>
    @endif

    {{-- FORM UPDATE --}}
    <form action="{{ route('reports.reply', $report) }}" method="POST" enctype="multipart/form-data"
      class="bg-gray-50 rounded-xl shadow p-4 sm:p-6 space-y-6">
      @csrf

      <h3 class="text-base font-semibold text-gray-700">Update Report</h3>

      {{-- Status --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <select name="status" required class="w-full border rounded-lg p-2 text-sm">
          <option value="pending" @selected($report->status === 'pending')>Pending</option>
          <option value="in_progress" @selected($report->status === 'in_progress')>In Progress</option>
          <option value="resolved" @selected($report->status === 'resolved')>Resolved</option>
          <option value="rejected" @selected($report->status === 'rejected')>Rejected</option>
        </select>
      </div>

      {{-- Reply --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
        <textarea name="reply" rows="3" class="w-full border rounded-lg p-2 text-sm" placeholder="Update progres...">{{ old('reply', $report->reply) }}</textarea>
      </div>

      {{-- MEDIA --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Media Lama --}}
        <div>
          <p class="text-sm font-semibold text-gray-700 mb-2">Media Lama</p>

          @if ($report->media->count())
            <div class="grid grid-cols-3 gap-2">
              @foreach ($report->media as $media)
                <div class="relative rounded-lg overflow-hidden border">
                  <label
                    class="absolute top-1 left-1 z-10 flex items-center gap-1 text-[10px] bg-red-600 text-white px-1.5 py-0.5 rounded">
                    <input type="checkbox" name="delete_media[]" value="{{ $media->id }}">
                    Hapus
                  </label>

                  @if ($media->type === 'photo')
                    <img src="{{ asset('storage/' . $media->path) }}"
                      onclick="openMediaModal('{{ asset('storage/' . $media->path) }}','image')"
                      class="w-full h-24 object-cover cursor-pointer">
                  @else
                    <video src="{{ asset('storage/' . $media->path) }}"
                      onclick="openMediaModal('{{ asset('storage/' . $media->path) }}','video')"
                      class="w-full h-24 object-cover cursor-pointer" muted></video>
                  @endif
                </div>
              @endforeach
            </div>
          @else
            <p class="text-xs text-gray-400 italic">Tidak ada media</p>
          @endif
        </div>

        {{-- Media Baru --}}
        <div>
          <p class="text-sm font-semibold text-gray-700 mb-2">Tambah Media Baru</p>

          <div class="space-y-4">
            <div>
              <label class="text-xs text-gray-600">Foto</label>
              <input type="file" name="new_photos[]" multiple accept="image/*"
                onchange="previewFiles(this,'photoPreview')" class="w-full border rounded-lg text-sm">
              <div id="photoPreview" class="grid grid-cols-3 gap-2 mt-2"></div>
            </div>

            <div>
              <label class="text-xs text-gray-600">Video</label>
              <input type="file" name="new_videos[]" multiple accept="video/*"
                onchange="previewFiles(this,'videoPreview',true)" class="w-full border rounded-lg text-sm">
              <div id="videoPreview" class="grid grid-cols-2 gap-2 mt-2"></div>
            </div>
          </div>
        </div>
      </div>

      {{-- Button --}}
      <div class="flex flex-col sm:flex-row gap-3 pt-4">
        <button type="submit"
          class="w-full sm:w-auto bg-yellow-400 hover:bg-yellow-500 text-white rounded-lg px-6 py-2 text-sm font-medium">
          {{ __('button.edit') }}
        </button>

        <a href="{{ route('reportData') }}"
          class="w-full sm:w-auto text-center bg-blue-700 hover:bg-blue-800 text-white rounded-lg px-6 py-2 text-sm font-medium">
          {{ __('button.back') }}
        </a>
      </div>
    </form>
  </div>

  {{-- Media Modal --}}
  <div id="mediaModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50"
    onclick="closeMediaModal()">
    <div class="bg-white rounded-lg p-3 max-w-3xl w-full relative" onclick="event.stopPropagation()">
      <button onclick="closeMediaModal()"
        class="absolute top-2 right-2 text-gray-600 hover:text-red-500 text-sm">✖</button>
      <div id="mediaContent" class="flex justify-center"></div>
    </div>
  </div>
@endsection


@section('scripts')
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

    function previewFiles(input, previewId, isVideo = false) {
      const preview = document.getElementById(previewId);
      preview.innerHTML = '';

      Array.from(input.files).forEach(file => {
        const url = URL.createObjectURL(file);

        const el = document.createElement(isVideo ? 'video' : 'img');
        el.src = url;
        el.className = 'w-full h-24 object-cover rounded shadow cursor-pointer';

        if (isVideo) {
          el.controls = true;
        } else {
          el.onclick = () => openMediaModal(url, 'image');
        }

        preview.appendChild(el);
      });
    }
  </script>
@endsection
