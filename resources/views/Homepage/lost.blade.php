@extends('Homepage.Layout.main')

@section('content')
  <div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-full">
    <h2 class="font-bold text-3xl text-center text-teal-900 mb-8">{{ __('lostfound.title') }}</h2>

    <form action="{{ route('lostStore') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="flex flex-col md:flex-row gap-8 justify-center p-6">

        {{-- Media Section --}}
        <div class="w-full md:max-w-xs">
          <h6 class="mb-2 text-lg font-semibold text-center text-teal-900">{{ __('lostfound.media_title') }}</h6>
          <p class="text-xs text-gray-500 mb-6 text-center">{{ __('lostfound.media_subtitle') }}</p>

          <div id="media-preview"
            class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-4 min-h-[8rem] bg-gray-50 p-2 rounded-lg border border-dashed border-gray-300 text-center text-gray-400">
            <p class="col-span-full text-sm text-gray-500">{{ __('lostfound.media_empty') }}</p>
          </div>



          <label class="block mb-2 text-sm font-medium text-teal-900"
            for="media_files">{{ __('lostfound.media_label') }}</label>
          <input type="file" name="media_files[]" id="media_files" accept="image/*,video/*" multiple
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 
                   focus:outline-none file:bg-teal-600 file:text-white hover:file:bg-teal-700" />

          <p class="mt-1 text-xs text-gray-500">{{ __('lostfound.media_hint') }}</p>

          @error('media_files')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Form Input Section --}}
        <div class="w-full space-y-5">
          {{-- Tanggal --}}
          <div>
            <label for="datepicker-autohide"
              class="block mb-1 font-medium text-teal-900">{{ __('lostfound.date_label') }}</label>
            <div class="relative">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <i data-feather="calendar" class="w-4 h-4 text-gray-500"></i>
              </div>
              <input id="datepicker-autohide" name="date" datepicker datepicker-autohide datepicker-autoselect-today
                datepicker-format="yyyy-mm-dd" type="text" value="{{ old('date') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                       focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                placeholder="{{ __('lostfound.date_placeholder') }}" required>
            </div>
            @error('date')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Nama Barang --}}
          <div>
            <label for="nameItem"
              class="block mb-2 text-sm font-medium text-teal-900">{{ __('lostfound.name_label') }}</label>
            <input type="text" name="nameItem" id="nameItem" value="{{ old('name') }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                       focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              placeholder="{{ __('lostfound.name_placeholder') }}" required>
            @error('nameItem')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Yang Menemukan --}}
          <div>
            <label for="found_by"
              class="block mb-2 text-sm font-medium text-teal-900">{{ __('lostfound.found_by_label') }}</label>
            <input type="text" id="found_by" value="{{ $user->nama }}"
              class="p-2.5 border border-gray-300 rounded-lg w-full bg-gray-100 cursor-not-allowed" disabled>
            <input type="hidden" name="found_by_id" value="{{ $user->id }}">
            @error('found_by')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Lokasi --}}
          <div>
            <label for="location"
              class="block mb-2 text-sm font-medium text-teal-900">{{ __('lostfound.location_label') }}</label>
            <input type="text" name="location" id="location" value="{{ old('location') }}"
              class="p-2.5 border border-gray-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500"
              placeholder="{{ __('lostfound.location_placeholder') }}" required>
            @error('location')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Deskripsi --}}
          <div>
            <label for="description"
              class="block mb-2 text-sm font-medium text-teal-900">{{ __('lostfound.description_label') }}</label>
            <textarea name="description" id="description" rows="4"
              class="p-2.5 border border-gray-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500"
              placeholder="{{ __('lostfound.description_placeholder') }}" required>{{ old('description') }}</textarea>
            @error('description')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Nomor Seri --}}
          <div>
            <label for="serial_number"
              class="block mb-2 text-sm font-medium text-teal-900">{{ __('lostfound.serial_label') }}</label>
            <input type="text" name="serial_number" id="serial_number" value="{{ old('serial_number') }}"
              class="p-2.5 border border-gray-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500"
              placeholder="{{ __('lostfound.serial_placeholder') }}">
            @error('serial_number')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Tombol --}}
          <div class="flex justify-center gap-4 mt-6">
            <button type="submit"
              class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
              {{ __('button.add') }}
            </button>
            <a href="{{ route('homepage') }}"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5">
              {{ __('button.back') }}
            </a>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('script')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const input = document.getElementById('media_files');
      const previewContainer = document.getElementById('media-preview');

      input.addEventListener('change', function() {
        previewContainer.innerHTML = ''; // Kosongkan preview setiap kali input berubah
        const files = Array.from(this.files);

        if (!files.length) {
          const emptyMsg = document.createElement('p');
          emptyMsg.textContent = 'Belum ada file yang dipilih';
          emptyMsg.className = 'col-span-2 text-gray-500 text-center text-sm';
          previewContainer.appendChild(emptyMsg);
          return;
        }

        files.forEach(file => {
          const fileReader = new FileReader();

          fileReader.onload = (event) => {
            const isVideo = file.type.startsWith('video/');
            const wrapper = document.createElement('div');
            wrapper.className = 'relative rounded-lg overflow-hidden border border-gray-300 bg-gray-50';

            const mediaEl = document.createElement(isVideo ? 'video' : 'img');
            mediaEl.src = event.target.result;
            mediaEl.className = 'object-cover w-full h-32';
            if (isVideo) {
              mediaEl.controls = true;
              mediaEl.classList.add('bg-black');
            }

            // Tambah label nama file
            const label = document.createElement('div');
            label.className =
              'absolute bottom-0 left-0 right-0 bg-black/60 text-white text-xs p-1 truncate';
            label.textContent = file.name;

            wrapper.appendChild(mediaEl);
            wrapper.appendChild(label);
            previewContainer.appendChild(wrapper);
          };

          fileReader.readAsDataURL(file);
        });
      });
    });
  </script>
@endsection
