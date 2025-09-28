@extends('Dashboard.Layout.main')

@section('content')
  <div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-1/2">
    <h2 class="font-bold text-4xl text-center text-black-500 mb-8">{{ $title ?? 'Edit Cleaning Task' }}</h2>

    <form action="{{ route('cleaningTasks.update', $task->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="flex flex-col md:flex-row gap-8 justify-center p-6">
        {{-- Form Input --}}
        <div class="w-1/2 space-y-5">
          {{-- Task Name --}}
          <div>
            <label for="name" class="block mb-2 text-sm font-medium text-teal-1001">Task Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $task->name) }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
              focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              required />
            @error('name')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Status --}}
          <div>
            <label for="status" class="block mb-2 text-sm font-medium text-teal-1001">Status</label>
            <select name="status" id="status"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
              focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
              <option value="active" {{ old('status', $task->status) == 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ old('status', $task->status) == 'inactive' ? 'selected' : '' }}>Inactive
              </option>
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
          class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 
          focus:ring-yellow-300 font-medium rounded-lg text-sm px-6 py-2.5">
          {{ __('button.edit') }}
        </button>

        <a href="{{ route('cleaningTasks.index') }}"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 
          font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 
          focus:outline-none dark:focus:ring-blue-800">
          {{ __('button.back') }}
        </a>
      </div>
    </form>
  </div>
@endsection
