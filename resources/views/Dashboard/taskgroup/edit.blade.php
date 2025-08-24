@extends('Dashboard.Layout.main')

@section('content')
<div class="bg-white p-5 rounded-xl shadow m-5 mx-auto max-w-3xl w-full">
  <h2 class="font-bold text-4xl text-center text-black-500 mb-8">Edit Task Group</h2>

  @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
      <strong>Terjadi kesalahan saat menyimpan perubahan:</strong>
      <ul class="mt-2 list-disc list-inside">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('task-groups.update', $taskGroup->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="flex flex-col gap-5">
      <div>
        <label for="name" class="block mb-2 text-sm font-medium text-teal-1001">Nama Group</label>
        <input type="text" name="name" id="name" value="{{ old('name', $taskGroup->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
        @error('name')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="active" class="inline-flex items-center cursor-pointer">
          <span class="mr-3 text-sm font-medium text-gray-700">Aktif</span>
          <div class="relative">
            <input type="checkbox" id="active" name="active" value="1" class="sr-only peer" {{ old('active', $taskGroup->active) ? 'checked' : '' }}>
            <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-teal-1001 transition-all duration-300"></div>
            <div class="absolute left-0.5 top-0.5 bg-white w-5 h-5 rounded-full transition-all duration-300 peer-checked:translate-x-full"></div>
          </div>
        </label>
      </div>
    </div>
    <div class="flex justify-center gap-4 mt-6">
        <button type="submit"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
            Update
        </button>

        <a href="{{ route('task-groups.index') }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Kembali
        </a>
    </div>
  </form>
</div>
@endsection
