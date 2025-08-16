@extends('Dashboard.Layout.main')
@section('content')
<div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-full">
  <h2 class="font-bold text-4xl text-center text-black-500 mb-8">Tambah Formula Check</h2>

  @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
      <strong>Terjadi kesalahan saat menginput data:</strong>
      <ul class="mt-2 list-disc list-inside">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('formulaCheck.store') }}" method="POST">
    @csrf
    <div class="flex flex-col gap-5">
      <div>
        <label for="name" class="block mb-2 text-sm font-medium text-teal-1001">Nama Formula</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required /> 
        @error('name')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="description" class="block mb-2 text-sm font-medium text-teal-1001">Deskripsi</label>
        <input type="text" name="description" id="description" value="{{ old('description') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required /> 
        @error('description')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="active" class="inline-flex items-center cursor-pointer">
          <span class="mr-3 text-sm font-medium text-teal-1001">Aktif</span>
          <div class="relative">
            <input type="checkbox" id="active" name="active" value="1" class="sr-only peer" {{ old('active') ? 'checked' : '' }}>
            <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-teal-1001 transition-all duration-300"></div>
            <div class="absolute left-0.5 top-0.5 bg-white w-5 h-5 rounded-full transition-all duration-300 peer-checked:translate-x-full"></div>
          </div>
        </label>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div>
            <label for="jumlah_kamar" class="block mb-2 text-sm font-medium text-teal-1001">Jumlah Kamar</label>
            <input type="number" name="jumlah_kamar" id="jumlah_kamar" value="{{ old('jumlah_kamar') }}" min="0" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="0" required />
            @error('jumlah_kamar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="mengajar" class="block mb-2 text-sm font-medium text-teal-1001">Mengajar</label>
            <input type="number" name="mengajar" id="mengajar" value="{{ old('mengajar') }}" min="0" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="0" required />
            @error('mengajar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="pembersihan_khusus" class="block mb-2 text-sm font-medium text-teal-1001">Pembersihan Khusus</label>
            <input type="number" name="pembersihan_khusus" id="pembersihan_khusus" value="{{ old('pembersihan_khusus') }}" min="0" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="0" required />  
            @error('pembersihan_khusus')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="mengangkat_barang" class="block mb-2 text-sm font-medium text-teal-1001">Mengangkat Barang</label>
            <input type="number" name="mengangkat_barang" id="mengangkat_barang" value="{{ old('mengangkat_barang') }}" min="0" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="0" required />        
            @error('mengangkat_barang')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="membersihkan_gudang" class="block mb-2 text-sm font-medium text-teal-1001">Membersihkan Gudang</label>
            <input type="number" name="membersihkan_gudang" id="membersihkan_gudang" value="{{ old('membersihkan_gudang') }}" min="0" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="0" required />          
            @error('membersihkan_gudang')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="obat_pool" class="block mb-2 text-sm font-medium text-teal-1001">Obat Pool</label>
            <input type="number" name="obat_pool" id="obat_pool" value="{{ old('obat_pool') }}" min="0" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="0" required />           
            @error('obat_pool')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="membersihkan_pool" class="block mb-2 text-sm font-medium text-teal-1001">Membersihkan Pool</label>
            <input type="number" name="membersihkan_pool" id="membersihkan_pool" value="{{ old('membersihkan_pool') }}" min="0" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="0" required />              
            @error('membersihkan_pool')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="sampah" class="block mb-2 text-sm font-medium text-teal-1001">Sampah</label>
            <input type="number" name="sampah" id="sampah" value="{{ old('sampah') }}" min="0" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="0" required />            
            @error('sampah')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
      </div>
    </div>
    <div class="flex justify-center gap-4 mt-6">
        <button type="submit"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
            Simpan
        </button>

        <a href="{{ route('formulaCheck.index') }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Kembali
        </a>
    </div>
  </form>
</div>
@endsection
