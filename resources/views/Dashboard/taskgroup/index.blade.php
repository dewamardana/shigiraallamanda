@extends('Dashboard.Layout.main')

@section('content')
  <div class="w-full max-w-screen-2xl mx-auto h-[calc(100vh-80px)] overflow-y-auto px-4 py-6">
    {{-- Alert Component --}}
    @if (session('success'))
      <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 mt-4 w-1/2 mx-auto"
        role="alert">
        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
          viewBox="0 0 20 20">
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <div class="ms-3 text-sm font-medium">
          {{ session('success') }}
        </div>
        <button type="button"
          class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
          data-dismiss-target="#alert-3" aria-label="Close">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
        </button>
      </div>
    @elseif (session('warning'))
      <div id="alert-4" class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 mt-4 w-1/2 mx-auto"
        role="alert">
        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
          viewBox="0 0 20 20">
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <div class="ms-3 text-sm font-medium">
          {{ session('warning') }}
        </div>
        <button type="button"
          class="ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8"
          data-dismiss-target="#alert-4" aria-label="Close">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
        </button>
      </div>
  </div>
@elseif (session('error'))
  <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 mt-4 w-1/2 mx-auto"
    role="alert">
    <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
      viewBox="0 0 20 20">
      <path
        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <div class="ms-3 text-sm font-medium">
      {{ session('error') }}
    </div>
    <button type="button"
      class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
      data-dismiss-target="#alert-2" aria-label="Close">
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
      </svg>
    </button>
  </div>
  @endif
  {{-- Alert Component --}}

  <h1 class="text-3xl font-bold mb-8 text-gray-800">{{ __('dashboardTaskGroup.index.title') }}</h1>
  <a href="{{ route('task-groups.create') }}"
    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">{{ __('button.add') }}</a>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
      <thead class="text-xs text-white bg-teal-1001 uppercase text-center">
        <tr>
          <th scope="col" class="px-6 py-3">{{ __('dashboardTaskGroup.table.name') }}</th>
          <th scope="col" class="px-6 py-3">{{ __('dashboardTaskGroup.table.status') }}</th>
          <th scope="col" class="px-6 py-3">{{ __('dashboardTaskGroup.table.action') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($taskGroups as $group)
          <tr class="bg-white even:bg-teal-50 border-b border-gray-200 hover:bg-yellow-50 text-center">
            <td class="px-6 py-4">
              {{ $group->name }}
            </td>
            <td class="px-6 py-4">
              <span
                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $group->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $group->active ? __('dashboardTaskGroup.table.active') : __('dashboardTaskGroup.table.inactive') }}
              </span>
            </td>
            <td class="px-6 py-4">
              <a href="{{ route('task-groups.show', $group->id) }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 focus:outline-none">{{ __('button.show') }}</a>
              <a href="{{ route('task-groups.edit', $group->id) }} "
                class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2">{{ __('button.edit') }}</a>
              <form action="{{ route('task-groups.destroy', $group->id) }}" method="POST" class="inline-block"
                data-confirm="{{ __('button.delete_confirm') }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2">
                  {{ __('button.delete') }}
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  </div>
@endsection
