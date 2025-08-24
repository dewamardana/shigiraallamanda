@extends('Dashboard.Layout.main')

@section('content')
<div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-3xl w-full">
  <h2 class="font-bold text-4xl text-center text-black-500 mb-8">➕ Tambah Task untuk "{{ $taskGroup->name }}"</h2>

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

  <form method="POST" action="{{ route('tasks.store') }}">
    @csrf
    <div class="flex flex-col gap-5">
        <div>
            <input type="hidden" name="task_group_id" value="{{ $taskGroup->id }}">
        </div>

        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-teal-1001">Nama Task</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div> 
          <label for="point" class="block mb-2 text-sm font-medium text-teal-1001">Poin</label>
          <input type="number" name="point" id="point" min="0" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="0" required />
            @error('point')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="flex justify-center gap-4 mt-6">
        <button type="submit"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
            Simpan
        </button>

        <a href="{{ route('task-groups.show', $taskGroup->id) }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Kembali
        </a>
    </div>
  </form>
</div>
@endsection
