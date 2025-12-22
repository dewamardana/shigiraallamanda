@extends('Dashboard.Layout.main')
@section('content')
  <div class="w-full max-w-screen-2xl mx-auto h-[calc(100vh-80px)] overflow-y-auto px-4 py-6">
    {{-- Alert Component --}}
    @if (session('success'))
      <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 mt-4 w-1/2 mx-auto"
        role="alert">
        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
          viewBox="0 0 20 20">
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <div class="ms-3 text-sm font-medium">
          {{ session('success') }}
        </div>
        <button type="button"
          class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
          data-dismiss-target="#alert-3" aria-label="Close">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
        </button>
      </div>
    @elseif (session('warning'))
      <div id="alert-4" class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 mt-4 w-1/2 mx-auto"
        role="alert">
        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
          viewBox="0 0 20 20">
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <div class="ms-3 text-sm font-medium">
          {{ session('warning') }}
        </div>
        <button type="button"
          class="ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8"
          data-dismiss-target="#alert-4" aria-label="Close">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
        </button>
      </div>
    @elseif (session('error'))
      <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 mt-4 w-1/2 mx-auto"
        role="alert">
        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
          viewBox="0 0 20 20">
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <div class="ms-3 text-sm font-medium">
          {{ session('error') }}
        </div>
        <button type="button"
          class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
          data-dismiss-target="#alert-2" aria-label="Close">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
        </button>
      </div>
    @endif
    {{-- Alert Component --}}


    <h2 class="text-2xl font-bold mb-6">{{ __('dashboardReportData.title') }}</h2>

    {{-- TABLE --}}
    <div class="relative overflow-x-auto shadow-2xl sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-700">
        <thead class="text-xs text-white uppercase bg-teal-600">
          <tr>
            <th class="px-6 py-3">Reporter</th>
            <th class="px-6 py-3">Type</th>
            <th class="px-6 py-3">Date</th>
            <th class="px-6 py-3">Media</th>
            <th class="px-6 py-3">Location</th>
            <th class="px-6 py-3 text-center">Action</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($reports as $report)
            <tr class="bg-white hover:bg-teal-50 transition">

              {{-- REPORTER --}}
              <td class="px-6 py-4 font-semibold text-teal-800">
                {{ $report->user->nama }}
              </td>

              {{-- TYPE --}}
              <td class="px-6 py-4">
                <span class="px-2 py-1 bg-teal-500 text-white rounded-sm">
                  {{ $report->report_type }}
                </span>
              </td>

              {{-- DATE --}}
              <td class="px-6 py-4">
                {{ \Carbon\Carbon::parse($report->date)->format('d M Y') }}
              </td>

              {{-- MEDIA --}}
              <td class="px-6 py-4 flex flex-wrap gap-2">
                @foreach ($report->media as $media)
                  @if ($media->type === 'photo')
                    <img src="{{ asset('storage/' . $media->path) }}"
                      class="w-14 h-14 rounded object-cover cursor-pointer"
                      onclick="openMediaModal('{{ asset('storage/' . $media->path) }}','image')">
                  @elseif ($media->type === 'video')
                    <video src="{{ asset('storage/' . $media->path) }}" class="w-20 h-14 rounded cursor-pointer"
                      onclick="openMediaModal('{{ asset('storage/' . $media->path) }}','video')"></video>
                  @endif
                @endforeach
              </td>

              {{-- LOCATION (BUILDING + ROOM) --}}
              <td class="px-6 py-4 text-gray-700">
                <div class="font-medium">
                  {{ $report->group->building_name ?? '-' }}
                </div>
                <div class="text-sm text-gray-500">
                  Room: {{ $report->room->room_name ?? '-' }}
                </div>
              </td>

              {{-- ACTION --}}
              <td class="px-6 py-4 text-center">
                <a href="{{ route('reports.show', $report) }}"
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ __('button.show') }}</a>
                <form action="{{ route('reports.destroy', $report) }}" method="POST" class="inline-block"
                  data-confirm="{{ __('button.delete_confirm') }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    {{ __('button.delete') }}
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-6 text-gray-500">
                {{ __('dashboardReportData.table.no_data') }}
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
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
      } else if (type === 'video') {
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

    function backgroundClick(event) {
      if (event.target.id === 'mediaModal') {
        closeMediaModal();
      }
    }
  </script>
@endsection
