@extends('Dashboard.Layout.main')

@section('content')
  <div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-full">
    <h2 class="font-bold text-4xl text-center text-black-500 mb-8">
      {{ __('dashboardCleaningGroup.create.title') }}</h2>
    <form action="{{ route('cleaningGroups.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="flex flex-col md:flex-row gap-8 justify-center p-6">

        {{-- Foto --}}
        <div class="w-full md:max-w-xs">
          <h6 class="mb-2 text-lg font-semibold text-center">{{ __('dashboardCleaningGroup.common.image_title') }}</h6>
          <p class="text-xs text-slate-500 mb-6 text-center">{{ __('dashboardCleaningGroup.common.image_desc') }}</p>
          <div
            class="relative w-40 h-40 rounded-xl overflow-hidden mb-6 border-2 border-indigo-600 group cursor-pointer block mx-auto">
            <img id="preview-foto" src="https://via.placeholder.com/150" class="object-cover w-full h-full">
            <div
              class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
              <i class="fas fa-edit text-white text-2xl"></i>
            </div>
          </div>
          <label for="foto"
            class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardCleaningGroup.common.upload_label') }}</label>
          <input type="file" name="foto" id="foto" accept="image/*"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:bg-teal-1001 file:text-white hover:file:bg-teal-1000" />
          <p class="mt-1 text-sm text-teal-1001">{{ __('dashboardCleaningGroup.common.upload_hint') }}</p>

          @error('foto')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Form Input --}}
        <div class="w-full space-y-5">
          {{-- Building Name --}}
          <div>
            <label for="building_name"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardCleaningGroup.common.building_name') }}</label>
            <input type="text" name="building_name" id="building_name" value="{{ old('building_name') }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              required />
            @error('building_name')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Description --}}
          <div>
            <label for="description"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardCleaningGroup.common.description') }}</label>
            <textarea name="description" id="description" rows="4"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
            @error('description')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Status --}}
          <div>
            <label for="status"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardCleaningGroup.common.status') }}</label>
            <select name="status" id="status"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
              <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                {{ __('dashboardCleaningGroup.common.status_active') }}</option>
              <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                {{ __('dashboardCleaningGroup.common.status_inactive') }}</option>
            </select>
            @error('status')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>

      {{-- Tombol Aksi --}}
      <div class="flex justify-center gap-4 mt-6">
        <button type="submit"
          class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
          {{ __('button.add') }}
        </button>

        <a href="{{ route('cleaningGroups.index') }}"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
          {{ __('button.back') }}
        </a>
      </div>
    </form>
  </div>
@endsection

@section('scripts')
  <script>
    document.getElementById('foto').addEventListener('change', function(event) {
      const [file] = event.target.files;
      if (file) {
        document.getElementById('preview-foto').src = URL.createObjectURL(file);
      }
    });
  </script>
@endsection
