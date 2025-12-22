@extends('Homepage.Layout.main')

@section('content')
  <div class="my-4 md:mb-20 mx-4 md:mx-auto md:max-w-3xl p-6 bg-white border border-gray-200 rounded-lg shadow-2xl">
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


  {{-- @if ($errors->any())
    <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg">
      <ul class="list-disc ms-5">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif --}}
  {{-- End Alert Component --}}

  <!-- FORM Report -->
  <h2 class="text-2xl font-bold text-center text-teal-1001 mb-6 border-b pb-2">
    {{ __('report.title') }}
  </h2>

  <form action="{{ route('reportStore') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    <input type="hidden" name="user_id" value="{{ $authUser->id }}">

    <!-- Nama User -->
    <div>
      <label class="block mb-2 text-sm font-medium text-teal-1001">{{ __('report.user_report') }}</label>
      <input type="text" value="{{ $authUser->nama }}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" readonly />
    </div>

    <!-- Report Type -->
    <div>
      <label for="report_type"
        class="block mb-2 text-sm font-medium text-teal-1001">{{ __('report.report_type') }}</label>
      <select id="report_type" name="report_type"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
        <option value="">Report Select</option>
        @foreach ($reportType as $type)
          <option value="{{ $type->name }}" {{ old('report_type') == $type->name ? 'selected' : '' }}>
            {{ $type->name }}</option>
        @endforeach
      </select>
      @error('report_type')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Cleaning Group -->
    <div>
      <label class="block mb-2 text-sm font-medium text-teal-1001">Cleaning Group</label>
      <select id="groupSelect" name="group_id"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
        <option value="">-- Select Cleaning Group --</option>
        @foreach ($groups as $group)
          <option value="{{ $group->id }}">{{ $group->building_name }}</option>
        @endforeach
      </select>
      @error('group_id')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Room -->
    <div>
      <label class="block mb-2 text-sm font-medium text-teal-1001">Room</label>
      <select id="roomSelect" name="room_id"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required disabled>
        <option value="">-- Select Room --</option>
      </select>
      @error('room_id')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>


    <!-- Description + Add Foto & Video -->
    <div>
      <label for="description"
        class="block mb-2 text-sm font-medium text-teal-1001">{{ __('report.description') }}</label>
      <textarea name="description" id="description" rows="4"
        class="block p-2.5 w-full text-sm bg-gray-50 rounded-lg border border-gray-300">{{ old('description') }}</textarea>
      @error('description')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror

      <!-- Upload Foto -->
      <div class="mt-4">
        <label class="block mb-1 text-sm font-medium text-teal-1001">{{ __('report.photos') }}</label>
        <input type="file" name="photos[]" id="photoInput" accept="image/*" multiple
          class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
        <p class="mt-1 text-xs text-gray-500">{{ __('report.photos_help') }}</p>
        <div id="photoPreview" class="flex flex-wrap gap-2 mt-2"></div>
        @error('photos.*')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Upload Video -->
      <div class="mt-4">
        <label class="block mb-1 text-sm font-medium text-teal-1001">{{ __('report.videos') }}</label>
        <input type="file" name="videos[]" id="videoInput" accept="video/*" multiple
          class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
        <p class="mt-1 text-xs text-gray-500">{{ __('report.videos_help') }}</p>
        <div id="videoPreview" class="flex flex-wrap gap-2 mt-2"></div>
        @error('videos.*')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

    </div>

    <!-- Members Report -->
    <div>
      <div class="flex justify-between items-center mb-3">
        <div class="flex items-center gap-2">
          <i data-feather="users" class="text-accent-1000"></i>
          <span class="font-medium text-teal-1001">{{ __('report.members.name') }}</span>
        </div>
        <button type="button" onclick="addMemberSelect()"
          class="text-sm px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
          {{ __('report.members.add') }}
        </button>
      </div>
      <div id="memberSelectContainer">
        <div class="flex gap-2 mb-2">
          <select name="members[]"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            <option value="">{{ __('report.members.select_member') }}</option>
            @foreach ($users as $user)
              <option value="{{ $user->id }}">{{ $user->nama }}</option>
            @endforeach
          </select>
          <button type="button" onclick="removeMemberSelect(this)"
            class="px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-sm">
            {{ __('button.remove') }}
          </button>
        </div>
      </div>
      @error('members')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
      @error('members.*')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Date Input -->
    <div>
      <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <i data-feather="calendar" class="w-4 h-4 text-accent-1000"></i>
        </div>
        <input id="datepicker-actions" name="date" datepicker datepicker-autohide datepicker-buttons
          datepicker-autoselect-today datepicker-format="yyyy-mm-dd" type="text" value="{{ old('date') }}"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
          placeholder="{{ __('form.date_placeholder') }}">
      </div>
      @error('date')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Submit, Back, & History -->
    <div class="flex justify-between pt-4 border-t">
      <!-- Kiri: Tombol History -->
      <a href="{{ route('reportHistory') }}"
        class="px-6 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
        {{ __('report.buttons.history') }}
      </a>

      <!-- Kanan: Back & Submit -->
      <div class="flex gap-3">
        <a href="{{ route('homepage') }}"
          class="px-6 py-2 text-sm text-white bg-gray-500 hover:bg-gray-600 rounded-lg shadow-sm">
          {{ __('button.back') }}
        </a>
        <button type="submit"
          class="px-6 py-2 text-sm text-white bg-green-600 hover:bg-green-700 rounded-lg shadow-sm">
          {{ __('button.submit') }}
        </button>
      </div>
    </div>
  </form>
  </div>
@endsection

@section('script')
  <script>
    function addMemberSelect() {
      const container = document.getElementById("memberSelectContainer");
      const originalSelect = document.querySelector('#memberSelectContainer select');

      let options = '';
      originalSelect.querySelectorAll('option:not([value=""])').forEach(opt => {
        options += `<option value="${opt.value}">${opt.text}</option>`;
      });

      const div = document.createElement("div");
      div.className = "flex gap-2 mb-2";
      div.innerHTML = `
          <select name="members[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
          <option value="">Select Member</option>
          ${options}
          </select>
          <button type="button" onclick="removeMemberSelect(this)" class="px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-sm">Remove</button>
      `;

      container.appendChild(div);
      feather.replace(); // panggil ulang icon
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

    let oldMembers = @json(old('members', []));
    document.addEventListener('DOMContentLoaded', function() {
      // Cek kalau old data ada
      if (oldMembers.length > 1) {
        // Hapus select default
        document.getElementById('memberSelectContainer').innerHTML = '';

        oldMembers.forEach(member => {
          addMemberSelect();
          let selects = document.querySelectorAll('#memberSelectContainer select');
          selects[selects.length - 1].value = member;
        });
      } else if (oldMembers.length == 1) {
        document.querySelector('#memberSelectContainer select').value = oldMembers[0];
      }

      updateRemoveButtonState();
    });


    document.addEventListener("DOMContentLoaded", function() {
      updateRemoveButtonState();
    });
  </script>

  <script>
    document.getElementById('photoInput').addEventListener('change', function(e) {
      let previewContainer = document.getElementById('photoPreview');
      previewContainer.innerHTML = ''; // reset preview
      [...e.target.files].forEach(file => {
        let reader = new FileReader();
        reader.onload = function(event) {
          let img = document.createElement('img');
          img.src = event.target.result;
          img.classList.add('w-24', 'h-24', 'object-cover', 'rounded-lg', 'border');
          previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
      });
    });

    document.getElementById('videoInput').addEventListener('change', function(e) {
      let previewContainer = document.getElementById('videoPreview');
      previewContainer.innerHTML = ''; // reset preview
      [...e.target.files].forEach(file => {
        let reader = new FileReader();
        reader.onload = function(event) {
          let video = document.createElement('video');
          video.src = event.target.result;
          video.controls = true;
          video.classList.add('w-48', 'h-32', 'rounded-lg', 'border');
          previewContainer.appendChild(video);
        };
        reader.readAsDataURL(file);
      });
    });


    document.getElementById('groupSelect').addEventListener('change', function() {
      let groupId = this.value;
      let roomSelect = document.getElementById('roomSelect');

      roomSelect.innerHTML = `<option value="">Loading...</option>`;
      roomSelect.disabled = true;

      if (groupId === "") {
        roomSelect.innerHTML = `<option value="">-- Select Room --</option>`;
        return;
      }

      fetch(`/homepage/report/get-rooms/${groupId}`)
        .then(response => response.json())
        .then(data => {
          roomSelect.innerHTML = `<option value="">-- Select Room --</option>`;
          data.forEach(room => {
            roomSelect.innerHTML += `<option value="${room.id}">${room.room_name}</option>`;
          });
          roomSelect.disabled = false;
        })
        .catch(error => {
          console.error("Error:", error);
          roomSelect.innerHTML = `<option value="">Failed to load rooms</option>`;
        });
    });
  </script>
@endsection
