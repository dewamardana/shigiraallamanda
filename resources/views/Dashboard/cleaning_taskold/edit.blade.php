@extends('Dashboard.Layout.main')

@section('content')
  <div class="max-w-lg mx-auto p-6 bg-white shadow rounded">
    <h1 class="text-xl font-bold mb-4">{{ $title }}</h1>

    <form action="{{ route('cleaning-task.update', $cleaningTask->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-4">
        <label class="block mb-1">Task Name</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ $cleaningTask->name }}"
          required>
      </div>
      <div class="mb-4">
        <label class="block mb-1">Formula</label>
        <input type="number" step="0.01" name="formula" class="w-full border rounded px-3 py-2"
          value="{{ $cleaningTask->formula }}" required>
      </div>
      <div class="flex gap-2">
        <button type="submit"
          class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-6 py-2.5">{{ __('button.edit') }}</button>
        <a href="{{ route('cleaningGroup.show', $cleaningTask->group->slug) }}"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ __('button.back') }}</a>
      </div>
    </form>
  </div>
@endsection
