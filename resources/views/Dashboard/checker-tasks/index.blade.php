@extends('Dashboard.Layout.main')

@section('content')
  <div class="w-full max-w-screen-2xl mx-auto h-[calc(100vh-80px)] overflow-y-auto px-4 py-6">

    {{-- Alert Component --}}
    @if (session('success'))
      <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 w-1/2 mx-auto">
        <div class="ms-3 text-sm font-medium">
          {{ session('success') }}
        </div>
      </div>
    @endif

    <h1 class="text-3xl font-bold mb-8 text-gray-800">Checker Tasks</h1>

    <div class="flex justify-end gap-4">
      <a href="{{ route('checker-tasks.create') }}"
        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
        {{ __('button.add') }}
      </a>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
      <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-white bg-teal-1001 uppercase text-center">
          <tr>
            <th class="px-6 py-3">Task Name</th>
            <th class="px-6 py-3">Type</th>
            <th class="px-6 py-3">Formula</th>
            <th class="px-6 py-3">Active</th>
            <th class="px-6 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($tasks as $task)
            <tr class="bg-white even:bg-teal-50 border-b border-gray-200 hover:bg-yellow-50 text-center">
              <td class="px-6 py-4">{{ $task->name }}</td>
              <td class="px-6 py-4">{{ ucfirst($task->type) }}</td>
              <td class="px-6 py-4">{{ $task->formula }}</td>
              <td class="px-6 py-4">{{ $task->active ? 'Yes' : 'No' }}</td>
              <td class="px-6 py-4 flex flex-wrap gap-2 justify-center">
                <a href="{{ route('checker-tasks.edit', $task->id) }}"
                  class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-1">
                  {{ __('button.edit') }}
                </a>
                <form action="{{ route('checker-tasks.destroy', $task->id) }}" method="POST"
                  data-confirm="{{ __('button.delete_confirm') }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-1">
                    {{ __('button.delete') }}
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                No Checker Task found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
