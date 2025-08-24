@extends('Homepage.Layout.main')

@section('content')
    {{-- Alert Component --}}
    @if (session('success'))
        <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 mt-4 w-1/2 mx-auto" role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ms-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @elseif (session('warning'))
        <div id="alert-4" class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 mt-4 w-1/2 mx-auto" role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ms-3 text-sm font-medium">
                {{ session('warning') }}
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-4" aria-label="Close">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
            </div>
        </div>
     @elseif (session('error'))
        <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 mt-4 w-1/2 mx-auto" role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ms-3 text-sm font-medium">
                {{ session('error') }}
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
    {{-- End Alert Component --}}


<div class="mt-4 my-20 mx-4 md:mx-auto md:max-w-2xl p-4 bg-white border border-gray-200 rounded-lg shadow-2xl sm:p-6 md:p-8">
    <form action="{{ route('cleaningStore') }}" method="POST">
        @csrf
            <!-- Team Members -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center gap-2">
                    <i data-feather="users" class="text-accent-1000"></i>
                    <span class="font-medium text-teal-1001">{{ __('cleaning.team_members') }}</span>
                    </div>
                    <button type="button" onclick="addMemberSelect()" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center me-2 mb-2">{{ __('button.add_member') }}</button>
                </div>
                <div id="memberSelectContainer">
                    <div class="flex gap-2 mb-2">
                        <select id="default" name="members[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <option value="">{{ __('cleaning.select_member_placeholder') }}</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->nama }}</option>
                            @endforeach
                        </select>
                        <button type="button" onclick="removeMemberSelect(this)" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center ">{{ __('button.remove') }}</button>
                    </div>
                </div>
            </div>
            
            <!-- Building -->
            <div class="mb-6">
                <label for="building" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('cleaning.building') }}</label>
                <select id="building" name="building_id" class="g-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option value="">{{ __('cleaning.select_building') }}</option>
                    @foreach ($building as $build)
                    <option value="{{ $build->id }} {{ old('building_id') == $build->id ? 'selected' : '' }}">{{ $build->building_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Date Input -->
            <div class="mb-6">
                <label for="date" class="block mb-1 font-medium text-teal-1001">
                    {{ __('form.date_input') ?? 'Date' }}
                </label>

                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i data-feather="calendar" class="w-4 y-4 text-accent-1000"></i>
                    </div>
                <input id="datepicker-autohide" name="date" datepicker datepicker-autohide datepicker-autoselect-today datepicker-format="yyyy-mm-dd" type="text" value="{{ old('date') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="{{ __('form.date_placeholder') }}">
                </div> 
            </div>


            <!-- Room Status -->
            <div>
                <label class="block mb-2 font-semibold text-teal-800">{{ __('cleaning.room_status') }}</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @php
                        $rooms = ['oa', 'ov', 'stay', 'vec'];
                    @endphp

                    @foreach ($rooms as $room)
                        <div class="flex flex-col space-y-1 max-w-full">
                            <label for="{{ $room }}" class="text-sm font-medium text-teal-800">
                                {{ __('cleaning.' . $room) }}
                            </label>
                            <div class="relative flex items-center rounded-lg shadow-sm overflow-hidden">
                                <button type="button" onclick="decrement('{{ $room }}')"
                                    class="bg-gray-100 hover:bg-gray-200 border border-gray-300 p-2 h-11 focus:ring-2 focus:ring-gray-100 focus:outline-none rounded-l-lg">
                                    <i data-feather="minus" class="text-accent-1000"></i>
                                </button>

                                <input type="text" name="{{ $room }}" id="{{ $room }}" value="{{ old($room, 0) }}"
                                    min="0" required
                                    class="w-full text-center text-sm font-medium bg-gray-50 h-11 border-t border-b border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none min-w-0" />

                                <button type="button" onclick="increment('{{ $room }}')"
                                    class="bg-gray-100 hover:bg-gray-200 border border-gray-300 p-2 h-11 focus:ring-2 focus:ring-gray-100 focus:outline-none rounded-r-lg">
                                    <i data-feather="plus" class="text-accent-1000"></i>
                                </button>

                                <div class="absolute bottom-1 left-1/2 -translate-x-1/2 flex items-center text-xs text-gray-400 space-x-1">
                                    <i data-feather="home" class="w-3 h-3 text-accent-1000"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Optional: PREMIER --}}
                    <div id="premierInput" class="flex flex-col space-y-1 max-w-full">
                        <label for="premier" class="text-sm font-medium text-teal-800">
                            {{ __('cleaning.premier') }}
                        </label>
                        <div class="relative flex items-center rounded-lg shadow-sm overflow-hidden">
                            <button type="button" onclick="decrement('premier')"
                                class="bg-gray-100 hover:bg-gray-200 border border-gray-300 p-2 h-11 focus:ring-2 focus:ring-gray-100 focus:outline-none rounded-l-lg">
                                <i data-feather="minus" class="text-accent-1000"></i>
                            </button>

                            <input type="text" name="premier" id="premier" value="{{ old('premier', 0) }}"
                                min="0" required
                                class="w-full text-center text-sm font-medium bg-gray-50 h-11 border-t border-b border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none min-w-0" />

                            <button type="button" onclick="increment('premier')"
                                class="bg-gray-100 hover:bg-gray-200 border border-gray-300 p-2 h-11 focus:ring-2 focus:ring-gray-100 focus:outline-none rounded-r-lg">
                                <i data-feather="plus" class="text-accent-1000"></i>
                            </button>

                            <div class="absolute bottom-1 left-1/2 -translate-x-1/2 flex items-center text-xs text-gray-400 space-x-1">
                                <i data-feather="home" class="w-3 h-3 text-accent-1000"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Total -->
            <div class="flex items-center  justify-between py-3 border-t border-gray-200">
                <span class="font-medium text-teal-1001 text-4xl">{{ __('cleaning.total_rooms') }}</span>
                <span id="total" class="text-4xl font-bold bg-teal-1001 text-gold min-w-20 text-center rounded p-2"></span>
                <input id="total_room" type="hidden" name="total_room" value="{{ old('total_room') }}">
            </div>

            <!-- User Id -->
            <div class="flex items-center  justify-between py-3 border-t border-gray-200">
                <input id="user_id" type="hidden" name="user_id" value="{{ $user_id->id }}">
            </div>        

            <!-- Submit -->
             <div class="flex justify-center gap-4 mt-6">
                <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
                    {{ __('button.submit') }}
                </button>

                <a href="{{ route('homepage') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 focus:outline-none">
                    Back
                </a>
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
          <option value="">{{ __('homepageIndex.select_member_placeholder') }}</option>
          ${options}
          </select>
          <button type="button" onclick="removeMemberSelect(this)" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center ">{{ __('homepageIndex.remove_member') }}</button>
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
      document.addEventListener('DOMContentLoaded', function () {
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

    function increment(id) {
      const input = document.getElementById(id);
      input.value = parseInt(input.value) + 1;
      updateTotal();
    }

    function decrement(id) {
      const input = document.getElementById(id);
      if (parseInt(input.value) > 0) {
        input.value = parseInt(input.value) - 1;
        updateTotal();
      }
    }

    function updateTotal() {
      const oa = parseInt(document.getElementById("oa").value) || 0;
      const ov = parseInt(document.getElementById("ov").value) || 0;
      const stay = parseInt(document.getElementById("stay").value) || 0;
      const vec = parseInt(document.getElementById("vec").value) || 0;
      const premierInput = document.getElementById("premier");
      const premier = premierInput ? (parseInt(premierInput.value) || 0) : 0;

      const total = oa + ov + stay + vec + premier;
      document.getElementById("total").textContent = total;
      document.getElementById("total_room").value = total;
    }

    function togglePremier(buildingName) {
      const premierInput = document.getElementById('premierInput');
      if (buildingName.toLowerCase().includes('royal')) {
        premierInput.classList.remove('hidden');
      } else {
        premierInput.classList.add('hidden');
        document.getElementById('premier').value = 0; // reset nilai jika disembunyikan
      }
    }

    document.addEventListener("DOMContentLoaded", function () {
        updateTotal();
        updateRemoveButtonState();

        const buildingSelect = document.querySelector('select[name="building_id"]');
        const premierInput = document.getElementById('premierInput');

        // Trigger saat pertama kali load
        togglePremier(buildingSelect.options[buildingSelect.selectedIndex].text);

        // Trigger saat value building dipilih
        buildingSelect.addEventListener('change', function () {
          togglePremier(this.options[this.selectedIndex].text);
        });
      });
</script>
@endsection



