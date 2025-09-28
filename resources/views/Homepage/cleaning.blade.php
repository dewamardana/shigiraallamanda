@extends('Homepage.Layout.main')

@section('content')
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

  @if ($errors->any())
    <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg">
      <ul class="list-disc ms-5">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- End Alert Component --}}

  <div
    class="my-4 md:mb-20 mx-4 md:mx-auto md:max-w-2xl p-4 bg-white border border-gray-200 rounded-lg shadow-2xl sm:p-6 md:p-8">
    <form action="{{ route('cleaningStore') }}" method="POST">
      @csrf

      <!-- Team Members -->
      <div class="mb-6">
        <div class="flex justify-between items-center mb-3">
          <div class="flex items-center gap-2">
            <i data-feather="users" class="text-accent-1000"></i>
            <span class="font-medium text-teal-1001">{{ __('cleaning.team_members') }}</span>
          </div>
          <button type="button" onclick="addMemberSelect()"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center me-2 mb-2">{{ __('button.add_member') }}</button>
        </div>
        <div id="memberSelectContainer">
          <div class="flex gap-2 mb-2">
            <select id="default" name="members[]"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              required>
              <option value="">{{ __('cleaning.select_member_placeholder') }}</option>
              @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('members.0') == $user->id ? 'selected' : '' }}>
                  {{ $user->nama }}
                </option>
              @endforeach
            </select>
            @error('members')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <button type="button" onclick="removeMemberSelect(this)"
              class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center">{{ __('button.remove') }}</button>
          </div>
        </div>
      </div>

      {{-- Cleaning Group --}}
      <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-teal-1001">{{ __('cleaning.building') }}</label>
        <select id="cleaning_group" name="cleaning_group_id"
          class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5" required>
          <option value="">{{ __('cleaning.select_building') }}</option>
          @foreach ($groups as $group)
            <option value="{{ $group->id }}">{{ $group->building_name }}</option>
          @endforeach
        </select>
        @error('cleaning_group_id')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Date Input -->
      <div class="mb-6">
        <label for="datepicker-autohide" class="block mb-1 font-medium text-teal-1001">
          {{ __('form.date_input') ?? 'Date' }}
        </label>

        <div class="relative">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <i data-feather="calendar" class="w-4 y-4 text-accent-1000"></i>
          </div>
          <input id="datepicker-autohide" name="date" datepicker datepicker-autohide datepicker-autoselect-today
            datepicker-format="yyyy-mm-dd" type="text" value="{{ old('date') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
            placeholder="{{ __('form.date_placeholder') }}" required>
          @error('date')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>

      {{-- Tasks --}}
      <div>
        <label class="block mb-2 font-semibold text-teal-800">{{ __('cleaning.room_status') }}</label>
        <div id="taskContainer" class="grid grid-cols-1 md:grid-cols-2 gap-4">
          {{-- Akan diisi via JS sesuai group --}}
        </div>
        @error('tasks')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Total --}}
      <div class="flex items-center justify-between py-3 border-t border-gray-200 mt-4">
        <span class="font-medium text-teal-1001 text-2xl">{{ __('cleaning.total_rooms') }}</span>
        <span id="total_room" class="text-2xl font-bold bg-teal-1001 text-gold min-w-20 text-center rounded p-2"></span>
        <input type="hidden" id="total_room_input" name="total_room">

      </div>

      {{-- Hidden User --}}
      <input type="hidden" name="user_id" value="{{ $user_id->id }}">

      {{-- Submit --}}
      <div class="flex justify-center gap-4 mt-6">
        <button type="submit"
          class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
          {{ __('button.submit') }}
        </button>
        <a href="{{ route('homepage') }}"
          class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-6 py-2.5">
          {{ __('button.back') }}
        </a>
      </div>
    </form>
  </div>
@endsection

@section('script')
  <script>
    // Simpan template options dari select pertama
    let templateOptions = '';
    document.addEventListener("DOMContentLoaded", function() {
      const firstSelect = document.querySelector('#memberSelectContainer select');
      if (firstSelect) {
        firstSelect.querySelectorAll('option').forEach(opt => {
          templateOptions += `<option value="${opt.value}">${opt.text}</option>`;
        });
      }
    });

    function addMemberSelect(selectedValue = '') {
      const container = document.getElementById("memberSelectContainer");

      const div = document.createElement("div");
      div.className = "flex gap-2 mb-2";
      div.innerHTML = `
      <select name="members[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        ${templateOptions}
      </select>
      <button type="button" onclick="removeMemberSelect(this)" 
        class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 
        font-medium rounded-sm text-sm px-5 py-2.5 text-center">
        {{ __('button.remove') }}
      </button>
    `;

      container.appendChild(div);

      const select = div.querySelector('select');
      if (selectedValue) {
        select.value = selectedValue;
      }

      feather.replace();
      updateRemoveButtonState();
    }

    function removeMemberSelect(button) {
      button.parentElement.remove();
      updateRemoveButtonState();
    }

    function updateRemoveButtonState() {
      const buttons = document.querySelectorAll('#memberSelectContainer button');
      if (buttons.length === 1) {
        buttons[0].disabled = true;
        buttons[0].classList.add('opacity-50', 'cursor-not-allowed');
      } else {
        buttons.forEach(btn => {
          btn.disabled = false;
          btn.classList.remove('opacity-50', 'cursor-not-allowed');
        });
      }
    }

    // Restore old members
    let oldMembers = @json(old('members', []));
    document.addEventListener('DOMContentLoaded', function() {
      if (oldMembers.length > 0) {
        document.getElementById('memberSelectContainer').innerHTML = '';
        oldMembers.forEach(member => addMemberSelect(member));
      }
      updateRemoveButtonState();
    });

    // Fetch tasks by group
    document.getElementById('cleaning_group').addEventListener('change', function() {
      const groupId = this.value;
      const taskContainer = document.getElementById('taskContainer');
      if (!groupId) {
        taskContainer.innerHTML = '';
        return;
      }

      fetch("{{ route('getTask', ':id') }}".replace(':id', groupId))
        .then(res => res.json())
        .then(tasks => {
          taskContainer.innerHTML = '';
          tasks.forEach(task => {
            const wrapper = document.createElement('div');
            wrapper.className = "flex flex-col space-y-1 max-w-full mb-4";

            wrapper.innerHTML = `
                <label for="task_${task.id}" class="text-sm font-medium text-teal-800">
                ${task.name}
                </label>
                <div class="relative flex items-center rounded-lg shadow-sm overflow-hidden">
                <button type="button" onclick="decrement('task_${task.id}')"
                    class="bg-gray-100 hover:bg-gray-200 border border-gray-300 p-2 h-11 
                        focus:ring-2 focus:ring-gray-100 focus:outline-none rounded-l-lg">
                    <i data-feather="minus" class="text-accent-1000"></i>
                </button>

                <input type="number" name="tasks[${task.id}]" id="task_${task.id}" value="0" min="0" required
                    class="w-full text-center text-sm font-medium bg-gray-50 h-11 
                        border-t border-b border-gray-300 focus:ring-blue-500 
                        focus:border-blue-500 outline-none min-w-0" />

                <button type="button" onclick="increment('task_${task.id}')"
                    class="bg-gray-100 hover:bg-gray-200 border border-gray-300 p-2 h-11 
                        focus:ring-2 focus:ring-gray-100 focus:outline-none rounded-r-lg">
                    <i data-feather="plus" class="text-accent-1000"></i>
                </button>
                </div>
            `;
            taskContainer.appendChild(wrapper);
            const input = wrapper.querySelector("input");
            input.addEventListener("input", updateTotal);
          });

          // Refresh feather icons setelah inject HTML
          if (window.feather) {
            feather.replace();
          }
        });


    });

    function increment(id) {
      const input = document.getElementById(id);
      let val = parseInt(input.value) || 0;
      input.value = val + 1;
      updateTotal();
    }

    function decrement(id) {
      const input = document.getElementById(id);
      let val = parseInt(input.value) || 0;
      if (val > 0) input.value = val - 1;
      updateTotal();
    }

    function updateTotal() {
      let total = 0;
      document.querySelectorAll('#taskContainer input').forEach(input => {
        total += parseInt(input.value) || 0;
      });
      document.getElementById('total_room').textContent = total;
      document.getElementById('total_room_input').value = total;
    }
    document.querySelector("form").addEventListener("submit", function() {
      updateTotal();
    });
  </script>
@endsection
