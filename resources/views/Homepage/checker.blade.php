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
  {{-- End Alert Component --}}
  <div class="my-6 mx-4 md:mx-auto md:max-w-6xl">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      {{-- ================= LEFT : FORM ================= --}}
      <div class="shadow-2xl md:col-span-2 p-4 bg-white border border-gray-200 rounded-lg sm:p-6 md:p-8">

        <div id="form-checker" class="mt-6">
          <h2 class="text-xl font-bold text-teal-1001 mb-6">
            {{ __('checker.checker_data_input') }}
          </h2>

          <form action="{{ route('checkerStore') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            {{-- Nama --}}
            <div class="mb-4">
              <label class="block mb-2 text-sm font-medium">{{ __('checker.name') }}</label>
              <input type="text" value="{{ $user->nama }}" class="bg-gray-100 border rounded-lg w-full p-2.5"
                readonly>
            </div>

            {{-- Tanggal --}}
            <div class="mb-6">
              <label class="block mb-2 font-medium">{{ __('form.date_input') }}</label>
              <input type="date" name="date" class="bg-gray-50 border rounded-lg w-full p-2.5" required>
            </div>

            {{-- TASK CHECKER --}}
            <div class="space-y-4">
              @foreach ($tasks as $task)
                <div>
                  <label class="block text-sm font-medium mb-1">{{ $task->name }}</label>

                  <button type="button" onclick="openTaskModal({{ $task->id }}, '{{ $task->name }}')"
                    class="w-full flex justify-between items-center bg-gray-50 border border-gray-300 p-3 rounded-lg hover:bg-gray-100 transition">
                    <span id="task_label_{{ $task->id }}">Belum ada room dipilih</span>
                    <i data-feather="chevron-right"></i>
                  </button>

                  <input type="hidden" name="tasks[{{ $task->id }}]" id="task_{{ $task->id }}" value="0">
                  <input type="hidden" name="groups_selected[{{ $task->id }}]" id="groups_{{ $task->id }}">
                  <input type="hidden" name="rooms_selected[{{ $task->id }}]" id="rooms_{{ $task->id }}">
                </div>
              @endforeach
            </div>


            {{-- TOTAL ROOM --}}
            <div class="flex justify-between items-center mt-6 border-t pt-4">
              <span class="font-semibold">Total Room</span>
              <span id="total_room" class="font-bold text-lg bg-teal-700 text-white px-4 py-1 rounded">0</span>
              <input type="hidden" name="total_room" id="total_room_input">
            </div>

            {{-- SUBMIT --}}
            <div class="flex justify-center gap-4 mt-6">
              <button type="submit" class="text-white bg-green-700 hover:bg-green-800 px-6 py-2.5 rounded-lg">
                {{ __('button.submit') }}
              </button>
              <a href="{{ route('homepage') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 px-6 py-2.5 rounded-lg">
                {{ __('button.back') }}
              </a>
            </div>
          </form>

          {{-- MODAL --}}
          <div id="taskModal"
            class="hidden fixed inset-0 z-50 bg-black/40 backdrop-blur-sm flex items-center justify-center">

            <div class="bg-white w-full max-w-2xl h-[90vh] rounded-2xl shadow-2xl flex flex-col">

              {{-- HEADER (STICKY) --}}
              <div class="p-4 border-b flex justify-between items-center sticky top-0 bg-white z-10">
                <h3 id="modalTitle" class="font-semibold text-lg text-teal-800"></h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-700 text-xl">✕</button>
              </div>

              {{-- BODY (SCROLLABLE) --}}
              <div class="flex-1 overflow-y-auto p-6">

                {{-- STEP 1: PILIH GEDUNG --}}
                <div id="groupStep" class="grid grid-cols-2 md:grid-cols-3 gap-3">
                  @foreach ($groups as $group)
                    <button type="button" onclick="selectGroup({{ $group->id }}, '{{ $group->building_name }}')"
                      id="group_btn_{{ $group->id }}" class="border rounded-lg p-3 text-center transition">
                      {{ $group->building_name }}
                    </button>
                  @endforeach
                </div>

                {{-- STEP 2: PILIH ROOM --}}
                <div id="roomStep" class="hidden">
                  <button onclick="backToGroups()" class="text-sm text-blue-600 mb-4">
                    ← Pilih gedung lain
                  </button>

                  <div id="roomList" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                  </div>
                </div>

              </div>

              {{-- FOOTER (STICKY) --}}
              <div class="p-4 border-t flex justify-end gap-2 sticky bottom-0 bg-white">
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded">
                  Batal
                </button>
                <button onclick="saveSelection()" class="px-4 py-2 bg-blue-700 text-white rounded">
                  Simpan
                </button>
              </div>

            </div>
          </div>
        </div>
      </div>

      {{-- ================= RIGHT : SUMMARY ================= --}}
      <div class="shadow-2xl p-6 bg-white border border-gray-200 rounded-lg sm:p-6 md:p-8 sticky top-6 h-fit">


        <h3 class="font-bold text-lg text-teal-800 mb-4">
          Ringkasan Pilihan
        </h3>

        <div id="selectionSummary" class="space-y-4 text-sm text-gray-700">
          <div class="text-gray-400 italic">
            Belum ada data
          </div>
        </div>

      </div>


    </div>
  </div>
@endsection
@section('script')
  <script>
    let taskNames = {};
    let groupNames = {};
    let currentTask = null;
    let currentGroup = null;
    let selected = {};
    let roomsCache = {};
    let modalOpen = false;

    @foreach ($tasks as $t)
      taskNames[{{ $t->id }}] = "{{ $t->name }}";
    @endforeach

    @foreach ($groups as $g)
      groupNames[{{ $g->id }}] = "{{ $g->building_name }}";
    @endforeach

    /* =============================
       MODAL
    ============================= */
    function openTaskModal(taskId, taskName) {
      currentTask = taskId;
      modalOpen = true;

      if (!selected[taskId]) {
        selected[taskId] = {
          groups: {}
        };
      }

      document.getElementById('modalTitle').innerText = taskName;
      document.getElementById('taskModal').classList.remove('hidden');
      document.getElementById('groupStep').classList.remove('hidden');
      document.getElementById('roomStep').classList.add('hidden');

      highlightGroups();
      history.pushState({
        modal: true
      }, '');
    }

    function closeModal() {
      document.getElementById('taskModal').classList.add('hidden');
      modalOpen = false;
      history.replaceState(null, '', location.pathname);
    }

    /* =============================
       GROUP
    ============================= */
    function selectGroup(groupId) {
      currentGroup = groupId;

      if (!selected[currentTask].groups[groupId]) {
        selected[currentTask].groups[groupId] = [];
      }

      highlightGroups();

      if (roomsCache[groupId]) {
        renderRooms(groupId, roomsCache[groupId]);
        return;
      }

      fetch(`/cleaning/rooms/${groupId}`)
        .then(res => res.json())
        .then(data => {
          roomsCache[groupId] = data.map(r => ({
            id: Number(r.id),
            name: r.room_name ?? r.name
          }));
          renderRooms(groupId, roomsCache[groupId]);
        });
    }

    function highlightGroups() {
      document.querySelectorAll('[id^="group_btn_"]').forEach(btn => {
        btn.classList.remove('bg-blue-600', 'text-white');
      });

      Object.keys(selected[currentTask].groups).forEach(gid => {
        const btn = document.getElementById(`group_btn_${gid}`);
        if (btn) btn.classList.add('bg-blue-600', 'text-white');
      });
    }

    /* =============================
       ROOMS
    ============================= */
    function renderRooms(groupId, rooms) {
      const list = document.getElementById('roomList');
      list.innerHTML = '';

      const selectedRooms = selected[currentTask].groups[groupId];

      rooms.forEach(room => {
        const isSelected = selectedRooms.includes(room.id);

        const card = document.createElement('div');
        card.className = `
      flex items-center justify-center text-sm font-medium p-3 border rounded-lg cursor-pointer
      ${isSelected ? 'bg-blue-600 text-white border-blue-600'
                   : 'bg-white border-gray-300 hover:bg-blue-50'}
    `;
        card.innerText = room.name;

        card.onclick = () => {
          const idx = selectedRooms.indexOf(room.id);
          idx > -1 ? selectedRooms.splice(idx, 1) : selectedRooms.push(room.id);
          renderRooms(groupId, rooms);
        };

        list.appendChild(card);
      });

      document.getElementById('groupStep').classList.add('hidden');
      document.getElementById('roomStep').classList.remove('hidden');
    }

    function backToGroups() {
      document.getElementById('roomStep').classList.add('hidden');
      document.getElementById('groupStep').classList.remove('hidden');
    }

    /* =============================
       SAVE
    ============================= */
    function saveSelection() {
      const taskData = selected[currentTask];
      let total = 0;
      let groups = [];
      let rooms = [];

      Object.keys(taskData.groups).forEach(gid => {
        const r = taskData.groups[gid];
        if (r.length) {
          total += r.length;
          groups.push(gid);
          r.forEach(id => rooms.push(`${gid}:${id}`));
        }
      });

      document.getElementById(`task_${currentTask}`).value = total;
      document.getElementById(`groups_${currentTask}`).value = groups.join(',');
      document.getElementById(`rooms_${currentTask}`).value = rooms.join(',');
      document.getElementById(`task_label_${currentTask}`).innerText =
        total ? `${total} room dipilih` : 'Belum ada room';

      updateTotalRoom();
      renderSummary();
      closeModal();
    }

    /* =============================
       SUMMARY
    ============================= */
    function renderSummary() {
      const box = document.getElementById('selectionSummary');
      box.innerHTML = '';

      Object.keys(selected).forEach(tid => {
        const task = selected[tid];
        let totalRooms = 0;
        let buildings = [];

        Object.keys(task.groups).forEach(gid => {
          const r = task.groups[gid];
          if (!r.length) return;

          totalRooms += r.length;
          buildings.push(`${groupNames[gid]} (${r.length})`);
        });

        if (!totalRooms) return;

        box.innerHTML += `
      <div class="border rounded-lg p-4 bg-blue-50">
        <div class="font-semibold text-blue-800">
          ${taskNames[tid]}
        </div>
        <div class="text-sm mt-1">
          ${buildings.join(', ')}
        </div>
        <div class="text-xs text-gray-600 mt-1">
          Total: ${totalRooms} room
        </div>
      </div>
    `;
      });

      if (!box.innerHTML.trim()) {
        box.innerHTML = '<div class="italic text-gray-400">Belum ada data</div>';
      }
    }

    function updateTotalRoom() {
      let total = 0;
      document.querySelectorAll('input[name^="tasks["]').forEach(i => {
        total += parseInt(i.value || 0);
      });
      document.getElementById('total_room').innerText = total;
      document.getElementById('total_room_input').value = total;
    }

    /* =============================
       BACK
    ============================= */
    window.addEventListener('popstate', () => {
      if (modalOpen) closeModal();
    });
  </script>
@endsection
