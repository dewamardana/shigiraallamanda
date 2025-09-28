@extends('Homepage.Layout.main')

@section('content')
  <div class="my-4 md:mb-20 mx-10 md:max-w-full p-4 bg-white border border-gray-200 rounded-lg shadow-2xl sm:p-6 md:p-8">
    <h2 class="text-2xl font-bold text-teal-1001 text-center">{{ __('reportHistory.title') }}</h2>

    {{-- Filter --}}
    <div class="mb-6">
      <form action="{{ route('reportHistory') }}" method="GET" class="grid sm:flex sm:flex-wrap sm:items-end gap-4">

        {{-- Start Date --}}
        <div class="relative w-full sm:w-auto mt-8">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <i data-feather="calendar" class="w-4 h-4 text-accent-1000"></i>
          </div>
          <input id="datepicker-start" name="start_date" value="{{ request('start_date') }}" datepicker
            datepicker-autohide datepicker-autoselect-today datepicker-format="dd/mm/yyyy" type="text"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-[200px] ps-10 p-2.5"
            placeholder="{{ __('reportHistory.filter.start_date') }}">
        </div>

        {{-- End Date --}}
        <div class="relative w-full sm:w-auto">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <i data-feather="calendar" class="w-4 h-4 text-accent-1000"></i>
          </div>
          <input id="datepicker-end" name="end_date" value="{{ request('end_date') }}" datepicker datepicker-autohide
            datepicker-autoselect-today datepicker-format="dd/mm/yyyy" type="text"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-[200px] ps-10 p-2.5"
            placeholder="{{ __('reportHistory.filter.end_date') }}">
        </div>

        {{-- Filter Button --}}
        <button type="submit"
          class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center">
          {{ __('button.filter') }}
        </button>

        {{-- Reset Button --}}
        <a href="{{ route('reportHistory') }}">
          <button type="button"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-sm text-sm px-5 py-2.5">
            {{ __('button.reset') }}
          </button>
        </a>

      </form>
    </div>


    {{-- Tabel --}}
    <div class="p-6 bg-white rounded-xl shadow-lg">
      {{-- Tabel --}}
      <div class="relative overflow-x-auto shadow-2xl sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-700">
          <thead class="text-xs text-white uppercase bg-teal-600">
            <tr>
              <th class="px-6 py-3">{{ __('reportHistory.table.reporter_name') }}</th>
              <th class="px-6 py-3">{{ __('reportHistory.table.report_type') }}</th>
              <th class="px-6 py-3">{{ __('reportHistory.table.date') }}</th>
              <th class="px-6 py-3">{{ __('reportHistory.table.description') }}</th>
              <th class="px-6 py-3">{{ __('reportHistory.table.media') }}</th>
              <th class="px-6 py-3">{{ __('reportHistory.table.member_name') }}</th>
              <th class="px-6 py-3">{{ __('reportHistory.table.point') }}</th>
              <th class="px-6 py-3">{{ __('reportHistory.table.reply') }}</th>
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
                <td
                  class="px-6 py-4 font-semibold text-center {{ $report->point ? 'text-green-600' : 'text-gray-400' }}">
                  {{ $report->point ?? '-' }}
                </td>

                {{-- Aksi --}}
                <td class="px-6 py-4">
                  @if (!is_null($report->point))
                    {{ $report->reply }}
                  @else
                    <p>{{ __('reportHistory.table.waiting_reply') }}</p>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                  {{ __('reportHistory.table.empty') }}
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

    </div>

  </div>
@endsection
@section('script')
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
