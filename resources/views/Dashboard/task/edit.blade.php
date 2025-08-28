@extends('Dashboard.Layout.main')

@section('content')
  <div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-3xl w-full">
    <h2 class="font-bold text-4xl text-center text-black-500 mb-8">
      {{ __('dashboardTask.edit.title', ['name' => $task->name]) }}</h2>

    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label for="name"
          class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardTask.form.task_name') }}</label>
        <input type="text" name="name" id="name" value="{{ old('name', $task->name) }}"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          required />
        @error('name')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4">
        <label for="point"
          class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardTask.form.point') }}</label>
        <input type="text" name="point" id="point" value="{{ old('point', $task->point) }}"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          required />
        @error('point')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="flex justify-center gap-4 mt-6">
        <button type="submit"
          class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
          {{ __('button.edit') }}
        </button>

        <a href="{{ route('task-groups.show', $task->task_group_id) }}"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
          {{ __('button.back') }}
        </a>
      </div>
    </form>
  </div>
@endsection
