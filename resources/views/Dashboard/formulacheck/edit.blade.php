@extends('Dashboard.Layout.main')

@section('content')
  <div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-full">
    <h2 class="font-bold text-4xl text-center text-black-500 mb-8">{{ __('dashboardFormulaCheck.edit.title') }}</h2>

    <form action="{{ route('formulaCheck.update', $formulaCheck->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="flex flex-col gap-5">
        <div>
          <label for="name"
            class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCheck.form.name') }}</label>
          <input type="text" name="name" id="name" value="{{ old('name', $formulaCheck->name) }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            required />
        </div>

        <div>
          <label for="description"
            class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCheck.form.description') }}</label>
          <input type="text" name="description" id="description"
            value="{{ old('description', $formulaCheck->description) }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            required />
        </div>

        <div>
          <label for="active" class="inline-flex items-center cursor-pointer">
            <span class="mr-3 text-sm font-medium text-gray-700">{{ __('dashboardFormulaCheck.form.active') }}</span>
            <div class="relative">
              <input type="checkbox" id="active" name="active" value="1" class="sr-only peer"
                {{ old('active', $formulaCheck->active) ? 'checked' : '' }}>
              <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-teal-1001 transition-all duration-300">
              </div>
              <div
                class="absolute left-0.5 top-0.5 bg-white w-5 h-5 rounded-full transition-all duration-300 peer-checked:translate-x-full">
              </div>
            </div>
          </label>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
          <div>
            <label for="jumlah_kamar"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCheck.form.jumlah_kamar') }}</label>
            <input type="number" name="jumlah_kamar" id="jumlah_kamar"
              value="{{ old('jumlah_kamar', $formulaCheck->jumlah_kamar) }}" min="0"
              aria-describedby="helper-text-explanation"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
              placeholder="0" required />
            @error('jumlah_kamar')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="mengajar"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCheck.form.mengajar') }}</label>
            <input type="number" name="mengajar" id="mengajar" value="{{ old('mengajar', $formulaCheck->mengajar) }}"
              min="0" aria-describedby="helper-text-explanation"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
              placeholder="0" required />
            @error('mengajar')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="pembersihan_khusus"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCheck.form.pembersihan_khusus') }}</label>
            <input type="number" name="pembersihan_khusus" id="pembersihan_khusus"
              value="{{ old('pembersihan_khusus', $formulaCheck->pembersihan_khusus) }}" min="0"
              aria-describedby="helper-text-explanation"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
              placeholder="0" required />
            @error('pembersihan_khusus')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="mengangkat_barang"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCheck.form.mengangkat_barang') }}</label>
            <input type="number" name="mengangkat_barang" id="mengangkat_barang"
              value="{{ old('mengangkat_barang', $formulaCheck->mengangkat_barang) }}" min="0"
              aria-describedby="helper-text-explanation"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
              placeholder="0" required />
            @error('mengangkat_barang')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="membersihkan_gudang"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCheck.form.membersihkan_gudang') }}</label>
            <input type="number" name="membersihkan_gudang" id="membersihkan_gudang"
              value="{{ old('membersihkan_gudang', $formulaCheck->membersihkan_gudang) }}" min="0"
              aria-describedby="helper-text-explanation"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
              placeholder="0" required />
            @error('membersihkan_gudang')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="obat_pool"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCheck.form.obat_pool') }}</label>
            <input type="number" name="obat_pool" id="obat_pool"
              value="{{ old('obat_pool', $formulaCheck->obat_pool) }}" min="0"
              aria-describedby="helper-text-explanation"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
              placeholder="0" required />
            @error('obat_pool')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="membersihkan_pool"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCheck.form.membersihkan_pool') }}</label>
            <input type="number" name="membersihkan_pool" id="membersihkan_pool"
              value="{{ old('membersihkan_pool', $formulaCheck->membersihkan_pool) }}" min="0"
              aria-describedby="helper-text-explanation"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
              placeholder="0" required />
            @error('membersihkan_pool')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="sampah"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCheck.form.sampah') }}</label>
            <input type="number" name="sampah" id="sampah" value="{{ old('sampah', $formulaCheck->sampah) }}"
              min="0" aria-describedby="helper-text-explanation"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
              placeholder="0" required />
            @error('sampah')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>
      <div class="flex justify-center gap-4 mt-6">
        <button type="submit"
          class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
          {{ __('button.edit') }}
        </button>

        <a href="{{ route('formulaCheck.index') }}"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
          {{ __('button.back') }}
        </a>
      </div>
    </form>
  </div>
@endsection
