@extends('Dashboard.Layout.main')

@section('content')
  <div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-full">
    <h2 class="font-bold text-4xl text-center text-black-500 mb-8">{{ __('dashboardBuilding.edit.title') }}</h2>

    <form action="{{ route('building.update', ['building' => $building->slug]) }}" method="POST"
      enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="flex flex-col md:flex-row gap-8 justify-center p-6">

        {{-- Foto --}}
        <div class="w-full md:max-w-xs">
          <h6 class="mb-2 text-lg font-semibold text-center">{{ __('dashboardBuilding.form.building_image') }}</h6>
          <p class="text-xs text-slate-500 mb-6 text-center">{{ __('dashboardBuilding.form.image_hint') }}</p>
          <div
            class="relative w-40 h-40 rounded-xl overflow-hidden mb-6 border-2 border-indigo-600 group cursor-pointer block mx-auto">
            <img id="preview-foto"
              src="{{ $building->foto ? asset('storage/' . $building->foto) : 'https://via.placeholder.com/150' }}"
              class="object-cover w-full h-full">
            <div
              class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
              <i class="fas fa-edit text-white text-2xl"></i>
            </div>
          </div>
          <label class="block mb-2 text-sm font-medium text-teal-1001"
            for="foto">{{ __('dashboardBuilding.form.image_upload') }}</label>
          <input type="file" name="foto" id="foto" accept="image/*"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:bg-teal-1001 file:text-white hover:file:bg-teal-1000" />
          <p class="mt-1 text-sm text-teal-1001" id="foto">{{ __('dashboardBuilding.form.upload_hint') }}</p>
          @error('foto')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Form Input --}}
        <div class="w-full space-y-5">

          <div>
            <label for="building_name"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardBuilding.form.building_name') }}</label>
            <input type="text" name="building_name" id="building_name"
              value="{{ old('building_name', $building->building_name) }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              required />
            @error('building_name')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="description"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardBuilding.form.description') }}</label>
            <textarea name="description" id="description" value="{{ old('description', $building->description) }}" rows="4"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ $building->description }}</textarea>
            @error('description')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="flex justify-center gap-4 mt-6">
            <button type="submit"
              class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-6 py-2.5">
              {{ __('button.edit') }}
            </button>

            <a href="{{ route('building.index') }}"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 focus:outline-none">
              {{ __('button.back') }}
            </a>
          </div>
        </div>
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
