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
      <input type="hidden" name="rooms_selected[${task.id}]" id="rooms_selected_${task.id}">


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


    <!-- 🔹 Modal Pilih Room -->
    <div id="roomModal" tabindex="-1"
      class="hidden fixed inset-0 z-50 bg-black/40 backdrop-blur-sm justify-center items-center w-full h-full transition-all duration-300">
      <div class="relative p-4 w-full max-w-2xl">
        <div
          class="relative bg-white border border-gray-200 rounded-2xl shadow-2xl overflow-hidden transition-all duration-300">
          <!-- Tombol Close -->
          <button type="button"
            class="absolute top-3 right-3 text-gray-400 hover:bg-gray-100 hover:text-gray-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition"
            onclick="closeRoomModal()">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
          </button>

          <!-- Konten Modal -->
          <div class="p-6">
            <h2 id="roomModalTitle" class="text-lg font-semibold mb-4 text-teal-800 text-center">
              Pilih Room
            </h2>

            <!-- Search Bar -->
            <input type="text" id="roomSearch" placeholder="Cari room..."
              class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2 mb-3
                 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none bg-gray-50">

            <!-- List Room -->
            <div id="roomList"
              class="max-h-56 overflow-y-auto border border-gray-200 rounded-lg p-3 bg-gray-50 transition-all duration-200">
              <!-- Daftar room akan diinject di sini -->
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end mt-6">
              <button type="button" id="cancelRoomBtn"
                class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 font-medium rounded px-5 py-2 mr-2">
                {{ __('button.back') }}
              </button>
              <button type="button" id="saveRoomBtn"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded px-5 py-2">
                {{ __('button.add') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>


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

      // 🧹 RESET DATA SAAT GANTI BUILDING
      selectedRoomsByTask = {}; // hapus semua pilihan rooms sebelumnya
      roomsData = {}; // hapus cache data rooms
      taskContainer.innerHTML = ''; // kosongkan task lama
      document.getElementById('total_room').textContent = ''; // reset total
      document.getElementById('total_room_input').value = '';

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
            wrapper.className = "flex flex-col space-y-1 mb-4";

            wrapper.innerHTML = `
        <label class="text-sm font-medium text-teal-800">${task.name}</label>
        <button type="button"
          class="bg-gray-100 hover:bg-gray-200 border border-gray-300 p-2 rounded-lg flex justify-between items-center"
          onclick="openRoomModal(${task.id}, '${task.name}')">
          <span id="task_label_${task.id}">Belum ada room dipilih</span>
          <i data-feather="chevron-right" class="text-accent-1000"></i>
        </button>
        <input type="hidden" name="tasks[${task.id}]" id="task_${task.id}" value="0">
        <input type="hidden" name="rooms_selected[${task.id}]" id="rooms_selected_${task.id}">
      `;
            taskContainer.appendChild(wrapper);
          });
          feather.replace();
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
      document.querySelectorAll('#taskContainer input[name^="tasks["]').forEach(input => {
        const val = parseInt(input.value);
        if (!isNaN(val)) total += val;
      });

      document.getElementById('total_room').textContent = total;
      document.getElementById('total_room_input').value = total;
    }

    let currentTaskId = null;
    let currentTaskName = null;
    let roomsData = {}; // cache per groupId -> [ {id,name}, ... ]
    let selectedRoomsByTask = {}; // task_id => [room_id,...]

    function openRoomModal(taskId, taskName) {
      currentTaskId = taskId;
      currentTaskName = taskName;

      const groupId = document.getElementById('cleaning_group').value;
      if (!groupId) {
        alert('Pilih building terlebih dahulu');
        return;
      }

      // init selectedRoomsByTask for this task jika belum ada
      if (!selectedRoomsByTask[taskId]) selectedRoomsByTask[taskId] = [];

      // Ambil data rooms (cache per group)
      if (!roomsData[groupId]) {
        fetch(`/cleaning/rooms/${groupId}`)
          .then(res => res.json())
          .then(data => {
            // pastikan setiap room punya { id, name }
            roomsData[groupId] = data.map(r => ({
              id: Number(r.id),
              name: r.name ?? r.room_name ?? r.roomName ?? r
            }));
            renderRoomList(roomsData[groupId]);
          })
          .catch(err => {
            console.error(err);
            renderRoomList([]);
          });
      } else {
        renderRoomList(roomsData[groupId]);
      }

      document.getElementById('roomModalTitle').textContent = `Pilih Room untuk ${taskName}`;
      document.getElementById('roomSearch').value = '';
      document.getElementById('roomModal').classList.remove('hidden');
      document.getElementById('roomModal').classList.add('flex');
    }

    // tutup modal
    function closeRoomModal() {
      const modal = document.getElementById('roomModal');
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      document.getElementById('roomSearch').value = '';
    }

    // Render daftar room sebagai kartu toggle
    function renderRoomList(rooms) {
      const list = document.getElementById('roomList');
      list.innerHTML = '';

      const selectedRooms = selectedRoomsByTask[currentTaskId] || [];

      // grid container
      const grid = document.createElement('div');
      grid.className = "grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2";

      rooms.forEach(room => {
        const isSelected = selectedRooms.includes(Number(room.id));

        const card = document.createElement('div');
        card.className = isSelected ?
          'flex items-center justify-center text-xs sm:text-sm font-medium p-2 sm:p-3 border rounded-lg cursor-pointer select-none transition-all duration-150 bg-blue-600 text-white border-blue-600 shadow-sm' :
          'flex items-center justify-center text-xs sm:text-sm font-medium p-2 sm:p-3 border rounded-lg cursor-pointer select-none transition-all duration-150 bg-white text-gray-700 border-gray-300 hover:bg-blue-50 hover:border-blue-400';

        card.textContent = room.name;
        card.dataset.roomId = Number(room.id);

        card.addEventListener('click', () => {
          const id = Number(card.dataset.roomId);
          const idx = selectedRooms.indexOf(id);
          if (idx > -1) {
            selectedRooms.splice(idx, 1);
            // unselect style
            card.className =
              'flex items-center justify-center text-xs sm:text-sm font-medium p-2 sm:p-3 border rounded-lg cursor-pointer select-none transition-all duration-150 bg-white text-gray-700 border-gray-300 hover:bg-blue-50 hover:border-blue-400';
          } else {
            selectedRooms.push(id);
            // select style
            card.className =
              'flex items-center justify-center text-xs sm:text-sm font-medium p-2 sm:p-3 border rounded-lg cursor-pointer select-none transition-all duration-150 bg-blue-600 text-white border-blue-600 shadow-sm';
          }
          selectedRoomsByTask[currentTaskId] = selectedRooms;
          // optional: live update label jumlah sementara
          const labelEl = document.getElementById(`task_label_${currentTaskId}`);
          if (labelEl) labelEl.textContent = `${selectedRooms.length} room dipilih`;
        });

        grid.appendChild(card);
      });

      list.appendChild(grid);
    }


    // Render daftar room dalam bentuk kartu toggle
    function renderRoomList(rooms) {
      const list = document.getElementById('roomList');
      list.innerHTML = '';

      const selectedRooms = selectedRoomsByTask[currentTaskId] || [];

      // Gunakan grid responsif untuk hemat ruang
      const grid = document.createElement('div');
      grid.className = "grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2";

      rooms.forEach(room => {
        const isSelected = selectedRooms.includes(room.id);

        const card = document.createElement('div');
        card.className = `
      flex items-center justify-center text-xs sm:text-sm font-medium p-2 sm:p-3
      border rounded-lg cursor-pointer select-none transition-all duration-150
      ${isSelected
        ? 'bg-blue-600 text-white border-blue-600 shadow-sm'
        : 'bg-white text-gray-700 border-gray-300 hover:bg-blue-50 hover:border-blue-400'}
    `;
        card.textContent = room.name;
        card.dataset.roomId = room.id;

        card.addEventListener('click', () => {
          const index = selectedRooms.indexOf(room.id);
          if (index > -1) {
            selectedRooms.splice(index, 1);
            card.className = `
          flex items-center justify-center text-xs sm:text-sm font-medium p-2 sm:p-3
          border rounded-lg cursor-pointer select-none transition-all duration-150
          bg-white text-gray-700 border-gray-300 hover:bg-blue-50 hover:border-blue-400
        `;
          } else {
            selectedRooms.push(room.id);
            card.className = `
          flex items-center justify-center text-xs sm:text-sm font-medium p-2 sm:p-3
          border rounded-lg cursor-pointer select-none transition-all duration-150
          bg-blue-600 text-white border-blue-600 shadow-sm
        `;
          }
          selectedRoomsByTask[currentTaskId] = selectedRooms;
        });

        grid.appendChild(card);
      });

      list.appendChild(grid);
    }


    // search filter
    document.getElementById('roomSearch').addEventListener('input', function() {
      const query = this.value.toLowerCase();
      const groupId = document.getElementById('cleaning_group').value;
      const rooms = roomsData[groupId] || [];
      const filtered = rooms.filter(r => String(r.name).toLowerCase().includes(query));
      renderRoomList(filtered);
    });

    // SIMPAN pilihan dari selectedRoomsByTask (JANGAN cari checkbox karena tak ada)
    document.getElementById('saveRoomBtn').addEventListener('click', function() {
      const selected = selectedRoomsByTask[currentTaskId] || [];

      // update hidden inputs & label
      const total = selected.length;
      const taskInput = document.getElementById(`task_${currentTaskId}`);
      const roomsHidden = document.getElementById(`rooms_selected_${currentTaskId}`);
      const labelEl = document.getElementById(`task_label_${currentTaskId}`);

      if (taskInput) taskInput.value = total;
      if (roomsHidden) roomsHidden.value = selected.join(',');
      if (labelEl) labelEl.textContent = total > 0 ? `${total} room dipilih` : 'Belum ada room dipilih';

      updateTotal();
      closeRoomModal();
    });

    document.getElementById('cancelRoomBtn').addEventListener('click', closeRoomModal);
  </script>
@endsection
