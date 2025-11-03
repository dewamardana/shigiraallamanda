@extends('Dashboard.Layout.main')

@section('content')
  <div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-full">
    <h2 class="font-bold text-3xl text-center text-teal-900 mb-8">{{ __('dashboardLostFound.show.title') }}</h2>

    <form action="{{ route('lostitem.update', $lostitem->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="flex flex-col md:flex-row gap-8 justify-center p-6">
        {{-- Media Section --}}
        <div class="w-full md:max-w-xs">
          <h6 class="mb-2 text-lg font-semibold text-center text-teal-900">
            {{ __('dashboardLostFound.show.media_section') }}</h6>
          <div class="flex flex-wrap justify-center gap-2">
            @if (!empty($mediaUrls))
              @foreach ($mediaUrls as $index => $media)
                @php
                  $isVideo = Str::endsWith($media, ['.mp4', '.mov', '.avi']);
                  $mediaPath = asset('storage/' . $media);
                  $modalId = 'media-modal-' . $index;
                @endphp

                {{-- Thumbnail --}}
                @if ($isVideo)
                  <video class="w-24 h-24 object-cover rounded border cursor-pointer"
                    data-modal-target="{{ $modalId }}" data-modal-toggle="{{ $modalId }}" muted>
                    <source src="{{ $mediaPath }}" type="video/mp4">
                  </video>
                @else
                  <img src="{{ $mediaPath }}" alt="Media"
                    class="w-24 h-24 object-cover rounded border cursor-pointer" data-modal-target="{{ $modalId }}"
                    data-modal-toggle="{{ $modalId }}">
                @endif

                {{-- 🔹 Modal per media --}}
                <div id="{{ $modalId }}" tabindex="-1"
                  class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                  <div class="relative p-4 w-full max-w-3xl max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                      {{-- Tombol close --}}
                      <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white"
                        data-modal-hide="{{ $modalId }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">{{ __('dashboardLostFound.common.close') }}</span>
                      </button>

                      {{-- Konten media --}}
                      <div class="p-4 flex justify-center items-center">
                        @if ($isVideo)
                          <video controls autoplay class="max-h-[80vh] rounded-lg">
                            <source src="{{ $mediaPath }}" type="video/mp4">
                          </video>
                        @else
                          <img src="{{ $mediaPath }}" alt="Media Zoom" class="max-h-[80vh] rounded-lg shadow-lg" />
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p class="text-gray-400 text-sm text-center w-full">{{ __('dashboardLostFound.common.no_media') }}</p>
            @endif
          </div>
        </div>

        {{-- Detail Section --}}
        <div class="w-full space-y-5">
          <div>
            <label class="block text-sm font-medium text-teal-900">{{ __('dashboardLostFound.show.date_found') }}</label>
            <input type="text" class="p-2.5 border border-gray-300 rounded-lg w-full bg-gray-50"
              value="{{ $lostitem->date }}" readonly>
          </div>

          <div>
            <label class="block text-sm font-medium text-teal-900">{{ __('dashboardLostFound.show.found_by') }}</label>
            <input type="text" class="p-2.5 border border-gray-300 rounded-lg w-full bg-gray-50"
              value="{{ $lostitem->foundby->nama }}" readonly>
          </div>

          <div>
            <label class="block text-sm font-medium text-teal-900">{{ __('dashboardLostFound.show.location') }}</label>
            <input type="text" class="p-2.5 border border-gray-300 rounded-lg w-full bg-gray-50"
              value="{{ $lostitem->location }}" readonly>
          </div>

          <div>
            <label
              class="block text-sm font-medium text-teal-900">{{ __('dashboardLostFound.show.description') }}</label>
            <textarea rows="4" class="p-2.5 border border-gray-300 rounded-lg w-full bg-gray-50" readonly>{{ $lostitem->description }}</textarea>
          </div>

          <div>
            <label
              class="block text-sm font-medium text-teal-900">{{ __('dashboardLostFound.show.serial_number') }}</label>
            <input type="text" class="p-2.5 border border-gray-300 rounded-lg w-full bg-gray-50"
              value="{{ $lostitem->serial_number ?? '-' }}" readonly>
          </div>
          @if ($lostitem->status == 0)
            {{-- Status Update --}}
            <div>
              <label class="block text-sm font-medium text-teal-900">{{ __('dashboardLostFound.common.status') }}</label>
              <select name="status" class="p-2.5 border border-gray-300 rounded-lg w-full">
                <option value="0" {{ $lostitem->status == 0 ? 'selected' : '' }}>
                  {{ __('dashboardLostFound.common.not_taken') }}
                </option>
                <option value="1" {{ $lostitem->status == 1 ? 'selected' : '' }}>
                  {{ __('dashboardLostFound.common.taken') }}
                </option>
              </select>
            </div>
            <div class="flex justify-center gap-4 mt-6">
              <button type="submit"
                class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-6 py-2.5">
                {{ __('button.edit') }}
              </button>
            @else
              <div>
                <label
                  class="block text-sm font-medium text-teal-900">{{ __('dashboardLostFound.common.status') }}</label>
                <input type="text" class="p-2.5 border border-gray-300 rounded-lg w-full bg-gray-50"
                  value="{{ __('dashboardLostFound.common.taken') }}" readonly>
              </div>
          @endif
          {{-- Tombol --}}

          <a href="{{ route('lostitem.index') }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5">
            {{ __('button.back') }}
          </a>
        </div>
      </div>
  </div>
  </form>
  </div>
@endsection
