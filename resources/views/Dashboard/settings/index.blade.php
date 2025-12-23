@extends('Dashboard.Layout.main')

@section('content')
  <div class="w-full max-w-screen-xl mx-auto h-[calc(100vh-80px)] overflow-y-auto px-4 py-6" x-data="{
      tab: new URLSearchParams(window.location.search).get('tab') || 'roles'
  }">

    {{-- Alert Component --}}
    @if (session('success'))
      <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 mt-4 w-1/2 mx-auto"
        role="alert">
        <svg class="shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <div class="ms-3 text-sm font-medium">
          {{ session('success') }}
        </div>
        <button type="button"
          class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
          data-dismiss-target="#alert-3" aria-label="Close">
          <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
        </button>
      </div>
    @elseif (session('error'))
      <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 mt-4 w-1/2 mx-auto"
        role="alert">
        <svg class="shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <div class="ms-3 text-sm font-medium">
          {{ session('error') }}
        </div>
        <button type="button"
          class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
          data-dismiss-target="#alert-2" aria-label="Close">
          <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
        </button>
      </div>
    @endif
    {{-- End Alert Component --}}

    <h2 class="text-2xl font-bold mb-6 text-gray-800">{{ __('dashboardSettingValue.title') }}</h2>

    {{-- Tabs --}}
    <div class="flex space-x-4 border-b border-gray-300 mb-6">
      <button @click=" tab = 'roles'; history.replaceState(null, '', '?tab=roles')"
        :class="tab === 'roles' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500'"
        class="pb-2 font-semibold">
        Roles
      </button>

      <button @click=" tab = 'skills'; history.replaceState(null, '', '?tab=skills')"
        :class="tab === 'skills' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500'"
        class="pb-2 font-semibold">
        Skills
      </button>

      <button @click=" tab = 'reportTypes'; history.replaceState(null, '', '?tab=reportTypes')"
        :class="tab === 'reportTypes' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500'"
        class="pb-2 font-semibold">
        Report Types
      </button>

      <button @click=" tab = 'rooms'; history.replaceState(null, '', '?tab=rooms') "
        :class="tab === 'rooms' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500'"
        class="pb-2 font-semibold">
        Rooms
      </button>

    </div>

    {{-- Roles Tab --}}
    <div x-show="tab === 'roles'" class="space-y-4">
      <form action="{{ route('settings.role.store') }}" method="POST" class="flex gap-2">
        @csrf
        <input type="hidden" name="tab" value="roles">
        <input type="text" name="name" placeholder="{{ __('dashboardSettingValue.placeholders.role_name') }}"
          required class="flex-1 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit"
          class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">{{ __('button.add') }}</button>
      </form>
      <div class="bg-white rounded-lg shadow p-4">
        <ul class="divide-y divide-gray-200">
          @foreach ($roles as $role)
            <li class="flex justify-between items-center py-2">
              <span>{{ $role->name }}</span>
              <form action="{{ route('settings.role.delete', $role->id) }}" method="POST"
                onsubmit="return confirm('{{ __('dashboardSettingValue.confirm.delete_role') }}')">
                @csrf
                @method('DELETE')

                <input type="hidden" name="tab" value="roles">
                <button type="submit"
                  class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">{{ __('button.delete') }}</button>
              </form>
            </li>
          @endforeach
        </ul>
      </div>
    </div>

    {{-- Skills Tab --}}
    <div x-show="tab === 'skills'" class="space-y-4" x-cloak>
      <form action="{{ route('settings.skill.store') }}" method="POST" class="flex gap-2">
        @csrf
        <input type="hidden" name="tab" value="skills">
        <input type="text" name="name" placeholder="{{ __('dashboardSettingValue.placeholders.skill_name') }}"
          required class="flex-1 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        <button type="submit"
          class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">{{ __('button.add') }}</button>
      </form>
      <div class="bg-white rounded-lg shadow p-4">
        <ul class="divide-y divide-gray-200">
          @foreach ($skills as $skill)
            <li class="flex justify-between items-center py-2">
              <span>{{ $skill->name }}</span>
              <form action="{{ route('settings.skill.delete', $skill->id) }}" method="POST"
                onsubmit="return confirm('{{ __('dashboardSettingValue.confirm.delete_skill') }}')">
                @csrf
                @method('DELETE')
                <input type="hidden" name="tab" value="skills">
                <button type="submit"
                  class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">{{ __('button.delete') }}</button>
              </form>
            </li>
          @endforeach
        </ul>
      </div>
    </div>

    {{-- Report Types Tab --}}
    <div x-show="tab === 'reportTypes'" class="space-y-4" x-cloak>
      <form action="{{ route('settings.reporttype.store') }}" method="POST" class="flex gap-2">
        @csrf
        <input type="hidden" name="tab" value="reportTypes">
        <input type="text" name="name"
          placeholder="{{ __('dashboardSettingValue.placeholders.report_type_name') }}" required
          class="flex-1 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
        <button type="submit"
          class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">{{ __('button.add') }}</button>
      </form>
      <div class="bg-white rounded-lg shadow p-4">
        <ul class="divide-y divide-gray-200">
          @foreach ($reportTypes as $type)
            <li class="flex justify-between items-center py-2">
              <span>{{ $type->name }}</span>
              <form action="{{ route('settings.reporttype.delete', $type->id) }}" method="POST"
                onsubmit="return confirm('{{ __('dashboardSettingValue.confirm.delete_report_type') }}')">
                @csrf
                @method('DELETE')

                <input type="hidden" name="tab" value="reportTypes">
                <button type="submit"
                  class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">{{ __('button.delete') }}</button>
              </form>
            </li>
          @endforeach
        </ul>
      </div>
    </div>

    {{-- 🏠 Rooms Tab --}}
    <div x-show="tab === 'rooms'" class="space-y-4" x-cloak>
      <form action="{{ route('settings.room.store') }}" method="POST" class="flex gap-2">
        @csrf
        <input type="hidden" name="tab" value="rooms">
        <input type="text" name="room_name" placeholder="Input Room Number" required
          class="flex-1 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit"
          class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">
          {{ __('button.add') }}
        </button>
      </form>

      <div class="bg-white rounded-lg shadow p-4">
        <ul class="divide-y divide-gray-200">
          @foreach ($rooms as $room)
            <li class="flex justify-between items-center py-2">
              <span>{{ $room->room_name }}</span>
              <form action="{{ route('settings.room.delete', $room->id) }}" method="POST"
                onsubmit="return confirm('{{ __('button.delete_confirm') }}')">
                @csrf
                @method('DELETE')
                <input type="hidden" name="tab" value="rooms">
                <button type="submit"
                  class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                  {{ __('button.delete') }}
                </button>
              </form>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  {{-- Alpine.js for tabs --}}
  <script src="//unpkg.com/alpinejs" defer></script>
@endsection
