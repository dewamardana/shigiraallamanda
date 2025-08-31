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
  {{-- Filter --}}
  <div class="mb-6">
    <form action="{{ route('reportData') }}" method="GET" class="grid sm:flex sm:flex-wrap sm:items-end gap-4">

      {{-- Start Date --}}
      <div class="relative w-full sm:w-auto">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <i data-feather="calendar" class="w-4 h-4 text-accent-1000"></i>
        </div>
        <input id="datepicker-start" name="start_date" value="{{ request('start_date') }}" datepicker datepicker-autohide
          datepicker-autoselect-today datepicker-format="dd/mm/yyyy" type="text"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-[200px] ps-10 p-2.5"
          placeholder="{{ __('general.filter.start_date') }}">
      </div>

      {{-- End Date --}}
      <div class="relative w-full sm:w-auto">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <i data-feather="calendar" class="w-4 h-4 text-accent-1000"></i>
        </div>
        <input id="datepicker-end" name="end_date" value="{{ request('end_date') }}" datepicker datepicker-autohide
          datepicker-autoselect-today datepicker-format="dd/mm/yyyy" type="text"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-[200px] ps-10 p-2.5"
          placeholder="{{ __('general.filter.end_date') }}">
      </div>

      {{-- User --}}
      <div class="w-full sm:w-auto">
        <label for="user_id" class="block mb-1 text-sm font-medium text-gray-900">
          {{ __('dashboardCleaning.checkdata.user') }}
        </label>
        <select id="user_id" name="user_id"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full sm:w-[200px] p-2.5">
          <option value="">{{ __('dashboardCleaning.checkdata.all') }}</option>
          @foreach ($users as $u)
            <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>
              {{ $u->nama }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Report type --}}
      <div class="w-full sm:w-auto">
        <label for="report_types_name" class="block mb-1 text-sm font-medium text-gray-900">
          {{ __('dashboardReportData.report_label') }}
        </label>
        <select id="report_types_name" name="report_types_name"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full sm:w-[200px] p-2.5">
          <option value="">{{ __('dashboardReportData.report_select') }}</option>
          @foreach ($type as $t)
            <option value="{{ $t->name }}" {{ request('report_types_name') == $t->name ? 'selected' : '' }}>
              {{ $t->name }}
            </option>
          @endforeach
        </select>
      </div>


      {{-- Filter Button --}}
      <button type="submit"
        class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center">
        {{ __('button.filter') }}
      </button>

      {{-- Reset Button --}}
      <a href="{{ route('reportData') }}">
        <button type="button"
          class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-sm text-sm px-5 py-2.5">
          {{ __('button.reset') }}
        </button>
      </a>
    </form>
  </div>

  {{-- Tabel --}}
  <div class="relative overflow-x-auto shadow-2xl sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-700">
      <thead class="text-xs text-white uppercase bg-teal-600">
        <tr>
          <th class="px-6 py-3">{{ __('dashboardReportData.table.reporter_name') }}</th>
          <th class="px-6 py-3">{{ __('dashboardReportData.table.report_type') }}</th>
          <th class="px-6 py-3">{{ __('dashboardReportData.table.date') }}</th>
          <th class="px-6 py-3">{{ __('dashboardReportData.table.description') }}</th>
          <th class="px-6 py-3">{{ __('dashboardReportData.table.media') }}</th>
          <th class="px-6 py-3">{{ __('dashboardReportData.table.member_name') }}</th>
          <th class="px-6 py-3">{{ __('dashboardReportData.table.point') }}</th>
          <th class="px-6 py-3">{{ __('dashboardReportData.table.action') }}</th>
        </tr>
      </thead>
      <tbody>
        @forelse($reports as $report)
          <tr class="bg-white hover:bg-teal-50 transition duration-200">
            {{-- Nama Pelapor --}}
            <td class="px-6 py-4 font-semibold text-teal-800">
              {{ $report->user->nama }}
            </td>

            {{-- Tipe Laporan --}}
            <td class="px-6 py-4">
              <span class="px-2 py-2 font-medium text-white bg-teal-500 rounded-sm">
                {{ $report->report_type }}
              </span>
            </td>

            {{-- Tanggal --}}
            <td class="px-6 py-4 text-gray-600">
              {{ \Carbon\Carbon::parse($report->date)->format('d M Y') }}
            </td>

            {{-- Deskripsi dengan tooltip --}}
            <td class="px-6 py-4 max-w-[200px] truncate" title="{{ $report->description }}">
              {{ $report->description }}
            </td>

            {{-- Media --}}
            <td class="px-6 py-4 flex flex-wrap gap-2">
              @foreach ($report->media as $media)
                @if ($media->type === 'photo')
                  <img src="{{ asset('storage/' . $media->path) }}" alt="foto"
                    class="w-16 h-16 object-cover rounded shadow cursor-pointer"
                    onclick="openMediaModal('{{ asset('storage/' . $media->path) }}', 'image')">
                @elseif($media->type === 'video')
                  <video src="{{ asset('storage/' . $media->path) }}" class="w-24 h-16 rounded shadow cursor-pointer"
                    onclick="openMediaModal('{{ asset('storage/' . $media->path) }}', 'video')"></video>
                @endif
              @endforeach
            </td>

            {{-- Nama Member --}}
            <td class="px-6 py-4 text-gray-700">
              @foreach ($report->members as $member)
                <span class="block">{{ $member->nama }}</span>
              @endforeach
            </td>

            {{-- Poin --}}
            <td class="px-6 py-4 font-semibold text-center {{ $report->point ? 'text-green-600' : 'text-gray-400' }}">
              {{ $report->point ?? '-' }}
            </td>

            {{-- Aksi --}}
            <td class="px-6 py-4">
              @if (!is_null($report->point))
                {{ $report->reply }}
              @else
                <form action="{{ route('reply', $report) }}" method="POST" class="space-y-2">
                  @csrf
                  <input type="hidden" name="report_id" value="{{ $report->id }}">
                  <textarea name="reply" rows="3" placeholder="{{ __('dashboardReportData.form.reply_placeholder') }}"
                    class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 resize-none"></textarea>
                  @error('reply')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                  @enderror

                  <input type="number" name="point" min="0"
                    placeholder="{{ __('dashboardReportData.form.point_placeholder') }}"
                    class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500"
                    required />

                  <button type="submit"
                    class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 transition">
                    {{ __('button.reply') }}
                  </button>
                </form>
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
              {{ __('dashboardReportData.table.no_data') }}
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
    {{-- Modal Preview Media --}}
    <div id="mediaModal" class="fixed inset-0 backdrop-blur-sm bg-opacity-70 hidden items-center justify-center z-50"
      onclick="backgroundClick(event)">
      <div class="bg-white rounded-lg p-4 max-w-3xl w-full relative" onclick="event.stopPropagation()">
        <button onclick="closeMediaModal()" class="absolute top-2 right-2 text-gray-700 hover:text-red-500">
          ✖
        </button>
        <div id="mediaContent" class="flex justify-center items-center">
          {{-- Konten media akan dimasukkan via JS --}}
        </div>
      </div>
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
