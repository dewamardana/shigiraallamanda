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

  {{-- === LAYOUT UTAMA === --}}
  <div class="flex flex-col m-2 md:mx-10 gap-4">
    {{-- === SIDEBAR PROFIL === --}}
    <div class="bg-white p-5 rounded-xl shadow-md w-full md:w-1/3 mx-auto">
      <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Profil Pengguna</h2>

      {{-- FOTO & NAMA --}}
      <div class="flex flex-col items-center mb-6">
        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-teal-600 mb-3">
          <img src="{{ $user->foto ? asset('storage/' . $user->foto) : '' }}" alt="Foto Profil"
            class="object-cover w-full h-full">
        </div>
        <h1 class="text-xl font-semibold text-gray-800">{{ $user->nama }}</h1>
        <p class="text-sm text-gray-500">{{ $user->department ?? '-' }}</p>
      </div>

      {{-- DETAIL --}}
      <div class="grid grid-cols-2 gap-3 text-sm text-gray-700">
        <div>
          <p class="text-gray-500 text-xs">Email</p>
          <p>{{ $user->email }}</p>
        </div>
        <div>
          <p class="text-gray-500 text-xs">Username</p>
          <p>{{ $user->username }}</p>
        </div>
        <div>
          <p class="text-gray-500 text-xs">Nomor Telepon</p>
          <p>{{ $user->nomor_telp }}</p>
        </div>
        <div>
          <p class="text-gray-500 text-xs">Gender</p>
          <p>{{ $user->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
        </div>
      </div>

      {{-- SKILLS --}}
      <div class="mt-5">
        <p class="text-xs text-gray-500 mb-2 font-semibold">Skills</p>
        <div class="flex flex-wrap gap-2">
          @forelse($user->skills as $skill)
            <span class="px-3 py-1 bg-teal-600 text-white rounded-full text-xs">
              {{ $skill->name }}
            </span>
          @empty
            <span class="text-gray-400 text-sm">Belum ada skill</span>
          @endforelse
        </div>
      </div>

      {{-- BUTTON EDIT --}}
      <button id="editButton"
        class="bg-yellow-400 hover:bg-yellow-500 text-white text-sm font-medium px-4 py-2 rounded-md mt-5 mx-auto block">
        Edit Profil
      </button>
    </div>

    {{-- === AREA GRAFIK  === --}}
    <div class="bg-white p-5 rounded-xl shadow-md w-full md:flex-1 ">
      {{-- Judul Halaman --}}
      <h1 class="text-2xl font-bold mb-6">
        Rekap Poin - {{ $user->nama }} ({{ $year }}/{{ $month }})
      </h1>

      {{-- Ringkasan --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        <div class="rounded-xl shadow overflow-hidden bg-gradient-to-r from-blue-600 to-blue-800 text-white">
          <div class="p-5">
            <p class="text-sm opacity-80">Total Activity</p>
            <p class="text-3xl font-bold">{{ $activitiesCount }}</p>
          </div>
        </div>
        <div class="rounded-xl shadow overflow-hidden bg-gradient-to-r from-blue-600 to-blue-800 text-white">
          <div class="p-5">
            <p class="text-sm opacity-80">Total Point</p>
            <p class="text-3xl font-bold">{{ $totalPoint + $totalCheckerPoint + $totalOfficePoint }}</p>
          </div>
        </div>
        <div class="rounded-xl shadow overflow-hidden bg-gradient-to-r from-green-600 to-green-800 text-white">
          <div class="p-5">
            <p class="text-sm opacity-80">Total Cleaning</p>
            <p class="text-3xl font-bold">{{ $cleaningsCount }}</p>
          </div>
        </div>
        <div class="rounded-xl shadow overflow-hidden bg-gradient-to-r from-green-600 to-green-800 text-white">
          <div class="p-5">
            <p class="text-sm opacity-80">Total Poin Cleaning</p>
            <p class="text-3xl font-bold">{{ number_format($totalCleaningPoint, 2) }}</p>
          </div>
        </div>
        <div class="rounded-xl shadow overflow-hidden bg-gradient-to-r from-purple-600 to-purple-800 text-white">
          <div class="p-5">
            <p class="text-sm opacity-80">Total Checker</p>
            <p class="text-3xl font-bold">{{ $checkersCount }}</p>
          </div>
        </div>
        <div class="rounded-xl shadow overflow-hidden bg-gradient-to-r from-purple-700 to-purple-900 text-white">
          <div class="p-5">
            <p class="text-sm opacity-80">Total Poin Checker</p>
            <p class="text-3xl font-bold">{{ number_format($totalCheckerPoint, 2) }}</p>
          </div>
        </div>
        <div class="rounded-xl shadow overflow-hidden bg-gradient-to-r from-orange-600 to-orange-800 text-white">
          <div class="p-5">
            <p class="text-sm opacity-80">Total Office Activity</p>
            <p class="text-3xl font-bold">{{ $officeCount }}</p>
          </div>
        </div>

        <div class="rounded-xl shadow overflow-hidden bg-gradient-to-r from-orange-700 to-orange-900 text-white">
          <div class="p-5">
            <p class="text-sm opacity-80">Total Poin Office</p>
            <p class="text-3xl font-bold">{{ number_format($totalOfficePoint, 2) }}</p>
          </div>
        </div>
      </div>


      {{-- ================= CLEANING ================= --}}
      <h2 class="text-xl font-semibold mb-4 text-center">Daftar Cleaning</h2>
      <div class="mb-6 text-center">
      </div>

      <div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 mb-10">
        @forelse($cleaningsWithPoint as $cwp)
          <div class="rounded-xl shadow bg-white border border-gray-100 hover:shadow-lg transition cursor-pointer"
            onclick="openModal('modal-{{ $cwp['record']->id }}')">
            <div class="p-5">
              <div class="flex items-center justify-between mb-3">
                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-medium">
                  {{ \Carbon\Carbon::parse($cwp['record']->date)->format('d M Y') }}
                </span>
                <i data-feather="check-circle" class="text-green-500 w-5 h-5"></i>
              </div>
              <h3 class="text-gray-900 font-semibold text-lg">
                {{ $cwp['record']->group->building_name ?? 'No Building' }}
              </h3>
              <p class="text-sm text-gray-500 mt-1">Cleaning Task Completed</p>
              <p class="text-sm text-gray-700 mt-2">
                Poin Didapat: <span
                  class="font-bold text-green-600">{{ number_format($cwp['poin_per_member'], 2) }}</span>
              </p>
            </div>
          </div>

          <!-- Modal -->
          <div id="modal-{{ $cwp['record']->id }}"
            class="fixed inset-0 backdrop-blur-sm bg-black/50 z-50 hidden items-center justify-center">
            <div
              class="bg-white mx-4 p-6 rounded-xl w-full max-w-3xl border border-gray-200 shadow-lg overflow-auto max-h-[90vh]">
              <h3 class="text-xl font-bold mb-4 text-center">
                Detail Cleaning - {{ \Carbon\Carbon::parse($cwp['record']->date)->format('d M Y') }}
              </h3>

              {{-- Tabel Task --}}
              <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                <table class="w-full text-sm text-left text-gray-500">
                  <thead class="text-xs text-white bg-teal-1001 uppercase text-center">
                    <tr>
                      <th class="px-6 py-3">No</th>
                      <th class="px-6 py-3">Task</th>
                      <th class="px-6 py-3">Jumlah</th>
                      <th class="px-6 py-3">Personal Value</th>
                      <th class="px-6 py-3">Formula</th>
                      <th class="px-6 py-3">Calculated</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $details = $cwp['record']->details ?? collect(); @endphp
                    @foreach ($details as $d)
                      <tr class="bg-white even:bg-teal-50 border-b border-gray-200 hover:bg-yellow-50 text-center">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-left">{{ $d->task->name ?? 'Unknown' }}</td>
                        <td class="px-6 py-4">{{ $d->value ?? 1 }}</td>
                        <td class="px-6 py-4">{{ number_format($d->personal_value ?? 0, 2) }}</td>
                        <td class="px-6 py-4">{{ $d->formula ?? '-' }}</td>
                        <td class="px-6 py-4">{{ number_format($d->calculated ?? 0, 2) }}</td>
                      </tr>
                    @endforeach
                    @if ($details->isEmpty())
                      <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No task detail available.</td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>

              {{-- Ringkasan --}}
              <div class="flex justify-between mt-6 px-2">
                <p class="font-semibold">Total Point:
                  <span class="text-blue-600">{{ number_format($cwp['record']->total_point ?? 0, 2) }}</span>
                </p>
                <p class="font-semibold">Point per Member:
                  <span class="text-green-600"><span
                      class="text-blue-600">{{ number_format($cwp['record']->total_point ?? 0, 2) }}
                      / {{ $cwp['record']->member_count }}</span> =
                    {{ number_format($cwp['poin_per_member'], 2) }}</span>
                </p>
              </div>

              {{-- Tombol Aksi --}}
              <div class="flex justify-end gap-3 pt-6">
                <button onclick="closeModal('modal-{{ $cwp['record']->id }}')"
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium 
             rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 
             focus:outline-none dark:focus:ring-blue-80">
                  Tutup
                </button>
              </div>
            </div>
          </div>
        @empty
          <div class="col-span-full text-center py-10 bg-gray-50 rounded-xl shadow">
            <p class="text-gray-500 italic">Tidak ada data cleaning</p>
          </div>
        @endforelse
      </div>

      {{-- ✅ Pagination --}}
      <div class="mt-6">
        {{ $cleanings->links('vendor.pagination.flowbite') }}
      </div>



      {{-- Rekap Cleaning per Group --}}
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Rekap Cleaning per Group</h2>

      <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full min-w-max text-sm text-center text-gray-600">
          <thead class="text-xs text-white bg-teal-1001 uppercase">
            <tr>
              {{-- Kolom Task sticky --}}
              <th scope="col" class="px-6 py-3 text-left sticky left-0 bg-teal-1001 z-10">Task</th>

              @foreach ($groupSummary as $group)
                <th scope="col" class="px-6 py-3">{{ $group['group_name'] }}</th>
              @endforeach

              {{-- Kolom Total --}}
              <th scope="col" class="px-6 py-3 bg-emerald-700 text-white">Total</th>
            </tr>
          </thead>
          <tbody>
            @php
              $allTasks = collect($groupSummary)
                  ->flatMap(fn($g) => collect($g['taskSummary'])->pluck('task_name'))
                  ->unique();
            @endphp

            {{-- Baris task --}}
            @foreach ($allTasks as $taskName)
              <tr class="bg-white even:bg-teal-50 border-b border-gray-200 hover:bg-yellow-50">
                {{-- Task sticky --}}
                <td class="px-6 py-3 font-medium text-gray-800 text-left sticky left-0 bg-white z-10">
                  {{ $taskName }}
                </td>

                @php
                  $rowTotal = 0;
                @endphp

                @foreach ($groupSummary as $group)
                  @php
                    $task = collect($group['taskSummary'])->firstWhere('task_name', $taskName);
                    $count = $task['total_times'] ?? 0;
                    $rowTotal += $count;
                  @endphp
                  <td class="px-6 py-3">{{ number_format($count, 2) }}</td>
                @endforeach

                {{-- Total tiap baris --}}
                <td class="px-6 py-3 font-bold bg-emerald-50 text-emerald-700">
                  {{ number_format($rowTotal, 2) }}
                </td>
              </tr>
            @endforeach

            {{-- Total per Group --}}
            <tr class="bg-emerald-600 text-white font-bold">
              <td class="px-6 py-3 text-left sticky left-0 bg-emerald-600 z-10">Total Dilakukan</td>
              @foreach ($groupSummary as $group)
                <td class="px-6 py-3">
                  {{ number_format(collect($group['taskSummary'])->sum('total_times'), 2) }}
                </td>
              @endforeach
              {{-- Total keseluruhan --}}
              <td class="px-6 py-3 bg-emerald-700">
                {{ number_format(collect($groupSummary)->flatMap(fn($g) => $g['taskSummary'])->sum('total_times'), 2) }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    @empty($groupSummary)
      <div class="col-span-full text-center py-10 bg-gray-50 rounded-xl shadow">
        <p class="text-gray-500 italic">Tidak ada rekap cleaning per group</p>
      </div>
    @endempty

    {{-- ================= CHECKER ================= --}}
    <h2 class="text-xl font-semibold mb-4 text-center">Daftar Checker</h2>
    <div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 mb-10">
      @forelse($checkers as $chk)
        <div class="rounded-xl shadow bg-white border border-gray-100 hover:shadow-lg transition cursor-pointer"
          onclick="openModal('checker-modal-{{ $chk->id }}')">
          <div class="p-5">
            <div class="flex items-center justify-between mb-3">
              <span class="px-3 py-1 text-xs rounded-full bg-purple-100 text-purple-700 font-medium">
                {{ \Carbon\Carbon::parse($chk->date)->format('d M Y') }}
              </span>
              <i data-feather="check-square" class="text-purple-500 w-5 h-5"></i>
            </div>
            <h3 class="text-gray-900 font-semibold text-lg">
              Checker Record
            </h3>
            <p class="text-sm text-gray-500 mt-1">Total Point: {{ $chk->total_point }}</p>
          </div>
        </div>

        <!-- Modal Checker -->
        <div id="checker-modal-{{ $chk->id }}"
          class="fixed inset-0 backdrop-blur-sm bg-black/50 z-50 hidden items-center justify-center">
          <div
            class="bg-white mx-4 p-6 rounded-xl w-full max-w-3xl border border-gray-200 shadow-lg overflow-auto max-h-[90vh]">
            <h3 class="text-xl font-bold mb-4 text-center">
              Detail Checker - {{ \Carbon\Carbon::parse($chk->date)->format('d M Y') }}
            </h3>

            {{-- Tabel Task --}}
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
              <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-white bg-purple-600 uppercase text-center">
                  <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Task</th>
                    <th class="px-6 py-3">Jumlah</th>
                    <th class="px-6 py-3">Formula</th>
                    <th class="px-6 py-3">Calculated</th>
                  </tr>
                </thead>
                <tbody>
                  @php $details = $chk->details ?? collect(); @endphp
                  @foreach ($details as $d)
                    <tr class="bg-white even:bg-purple-50 border-b border-gray-200 hover:bg-yellow-50 text-center">
                      <td class="px-6 py-4">{{ $loop->iteration }}</td>
                      <td class="px-6 py-4 text-left">{{ $d->task->name ?? 'Unknown' }}</td>
                      <td class="px-6 py-4">{{ $d->value ?? 1 }}</td>
                      <td class="px-6 py-4">{{ $d->formula ?? '-' }}</td>
                      <td class="px-6 py-4">{{ number_format($d->calculated ?? 0, 2) }}</td>
                    </tr>
                  @endforeach
                  @if ($details->isEmpty())
                    <tr>
                      <td colspan="5" class="px-6 py-4 text-center text-gray-500">No task detail available.</td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>

            {{-- Ringkasan --}}
            <div class="flex justify-between mt-6 px-2">
              <p class="font-semibold">Total Point:
                <span class="text-purple-600">{{ number_format($chk->total_point ?? 0, 2) }}</span>
              </p>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-end gap-3 pt-6">
              <button onclick="closeModal('checker-modal-{{ $chk->id }}')"
                class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium 
           rounded-lg text-sm px-6 py-2.5">
                Tutup
              </button>
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-full text-center py-10 bg-gray-50 rounded-xl shadow">
          <p class="text-gray-500 italic">Tidak ada data checker</p>
        </div>
      @endforelse
    </div>


    {{-- ✅ Pagination --}}
    <div class="mt-6">
      {{ $checkers->links('vendor.pagination.checker') }}
    </div>


    {{-- Rekap Checker Task --}}
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Rekap Checker Task</h2>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
      <table class="w-full min-w-max text-sm text-center text-gray-600">
        <thead class="text-xs text-white bg-purple-600 uppercase">
          <tr>
            <th scope="col" class="px-6 py-3 text-left">Aktivitas</th>
            <th scope="col" class="px-6 py-3">Total Dilakukan</th>
            <th scope="col" class="px-6 py-3">Total Poin</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($checkerSummary as $task)
            <tr class="bg-white even:bg-purple-50 border-b border-gray-200 hover:bg-yellow-50">
              <td class="px-6 py-3 font-medium text-gray-800 text-left">
                {{ $task['task_name'] }}
              </td>
              <td class="px-6 py-3">{{ $task['total_times'] }}</td>
              <td class="px-6 py-3 font-semibold text-purple-700">
                {{ $task['total_point'] }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="px-6 py-4 text-center text-gray-500 italic">
                Tidak ada rekap checker task
              </td>
            </tr>
          @endforelse

          {{-- ✅ Baris total --}}
          @if ($checkerSummary->count() > 0)
            <tr class="bg-purple-600 text-white font-bold">
              <td class="px-6 py-3 text-left">TOTAL</td>
              <td class="px-6 py-3">
                {{ $checkerSummary->sum('total_times') }}
              </td>
              <td class="px-6 py-3">
                {{ $checkerSummary->sum('total_point') }}
              </td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>



    {{-- ================= OFFICE ================= --}}
    <h2 class="text-xl font-semibold mb-4 text-center mt-10">Daftar Office</h2>
    <div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 mb-10">
      @forelse($officeWithPoint as $o)
        <div class="rounded-xl shadow bg-white border border-gray-100 hover:shadow-lg transition cursor-pointer"
          onclick="openModal('office-modal-{{ $o['record']->id }}')">
          <div class="p-5">
            <div class="flex items-center justify-between mb-3">
              <span class="px-3 py-1 text-xs rounded-full bg-orange-100 text-orange-700 font-medium">
                {{ \Carbon\Carbon::parse($o['record']->date)->format('d M Y') }}
              </span>
              <i data-feather="clipboard" class="text-orange-500 w-5 h-5"></i>
            </div>
            <h3 class="text-gray-900 font-semibold text-lg">
              {{ $o['record']->group->name ?? 'No Group' }}
            </h3>
            <p class="text-sm text-gray-500 mt-1">Office Task Completed</p>
            <p class="text-sm text-gray-700 mt-2">
              Poin Didapat: <span class="font-bold text-green-600">{{ number_format($o['point'], 2) }}</span>
            </p>
          </div>
        </div>

        <!-- Modal Detail Office -->
        <div id="office-modal-{{ $o['record']->id }}"
          class="fixed inset-0 backdrop-blur-sm bg-black/50 z-50 hidden items-center justify-center">
          <div
            class="bg-white mx-4 p-6 rounded-xl w-full max-w-3xl border border-gray-200 shadow-lg overflow-auto max-h-[90vh]">
            <h3 class="text-xl font-bold mb-4 text-center">
              Detail Office - {{ \Carbon\Carbon::parse($o['record']->date)->format('d M Y') }}
            </h3>

            {{-- Tabel Task --}}
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
              <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-white bg-orange-600 uppercase text-center">
                  <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Task</th>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Point</th>
                  </tr>
                </thead>
                <tbody>
                  @php $details = $o['record']->details ?? collect(); @endphp
                  @foreach ($details as $d)
                    <tr class="bg-white even:bg-orange-50 border-b border-gray-200 hover:bg-yellow-50 text-center">
                      <td class="px-6 py-4">{{ $loop->iteration }}</td>
                      <td class="px-6 py-4 text-left">{{ $d->task->name ?? 'Unknown' }}</td>
                      <td class="px-6 py-4">{{ $d->user->nama ?? 'Unknown' }}</td>
                      <td class="px-6 py-4 font-semibold text-green-600">{{ $d->point }}</td>
                    </tr>
                  @endforeach
                  @if ($details->isEmpty())
                    <tr>
                      <td colspan="4" class="px-6 py-4 text-center text-gray-500">No task detail available.</td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>

            {{-- Ringkasan --}}
            <div class="flex justify-between mt-6 px-2">
              <p class="font-semibold">Total Point:
                <span class="text-orange-600">{{ number_format($o['record']->details->sum('point') ?? 0, 2) }}</span>
              </p>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-end gap-3 pt-6">
              <button onclick="closeModal('office-modal-{{ $o['record']->id }}')"
                class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-6 py-2.5">
                Tutup
              </button>
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-full text-center py-10 bg-gray-50 rounded-xl shadow">
          <p class="text-gray-500 italic">Tidak ada data office</p>
        </div>
      @endforelse
    </div>

    {{-- ✅ Pagination --}}
    <div class="mt-6">
      {{ $office->links('vendor.pagination.office') }}
    </div>


    {{-- Rekap Office Task --}}
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Rekap Office Task</h2>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
      <table class="w-full min-w-max text-sm text-center text-gray-600">
        <thead class="text-xs text-white bg-orange-600 uppercase">
          <tr>
            <th scope="col" class="px-6 py-3 text-left">Aktivitas</th>
            <th scope="col" class="px-6 py-3">Total Dilakukan</th>
            <th scope="col" class="px-6 py-3">Total Poin</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($officeTaskSummary as $task)
            <tr class="bg-white even:bg-orange-50 border-b border-gray-200 hover:bg-yellow-50">
              <td class="px-6 py-3 font-medium text-gray-800 text-left">
                {{ $task['task_name'] }}
              </td>
              <td class="px-6 py-3">{{ $task['total_times'] }}</td>
              <td class="px-6 py-3 font-semibold text-orange-700">
                {{ $task['total_point'] }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="px-6 py-4 text-center text-gray-500 italic">
                Tidak ada rekap office task
              </td>
            </tr>
          @endforelse

          {{-- ✅ Baris total --}}
          @if ($officeTaskSummary->count() > 0)
            <tr class="bg-orange-600 text-white font-bold">
              <td class="px-6 py-3 text-left">TOTAL</td>
              <td class="px-6 py-3">
                {{ $officeTaskSummary->sum('total_times') }}
              </td>
              <td class="px-6 py-3">
                {{ $officeTaskSummary->sum('total_point') }}
              </td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

  {{-- === MODAL EDIT PROFIL === --}}
  <div id="editModal"
    class="fixed inset-0 z-50 flex items-start justify-center bg-black/30 backdrop-blur-sm hidden overflow-y-auto py-5">
    <div class="bg-white mx-4 p-6 rounded-lg w-full max-w-2xl border border-teal-200 relative">

      <h2 class="text-lg font-bold text-center text-gray-800">Edit Profil</h2>

      <form class="space-y-4" action="{{ route('userprofileUpdate', $user->slug) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- FOTO --}}
        <div class="flex flex-col items-center">
          <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-teal-600 mb-2">
            <img src="{{ $user->foto ? asset('storage/' . $user->foto) : '' }}" alt="Foto Profil"
              class="object-cover w-full h-full">
          </div>
          <input type="file" name="foto" class="text-sm text-gray-600">
        </div>

        {{-- INPUT FIELD --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <div>
            <label class="text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" value="{{ $user->nama }}"
              class="w-full p-2 border rounded-md focus:ring-teal-500 focus:border-teal-500 text-gray-500" readonly>
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ $user->email }}"
              class="w-full p-2 border rounded-md focus:ring-teal-500 focus:border-teal-500">
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700">Nomor Telepon</label>
            <input type="text" name="nomor_telp" value="{{ $user->nomor_telp }}"
              class="w-full p-2 border rounded-md focus:ring-teal-500 focus:border-teal-500">
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700">Gender</label>
            <select name="gender" class="w-full p-2 border rounded-md focus:ring-teal-500 focus:border-teal-500">
              <option value="L" {{ $user->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
              <option value="P" {{ $user->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>
        </div>

        {{-- SKILLS --}}
        <div>
          <label class="text-sm font-medium text-gray-700 mb-2 block">Skill yang Dikuasai</label>
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2 border p-3 rounded-md bg-gray-50">
            @foreach ($skills as $skill)
              <div class="flex items-center">
                <input id="modal-skill-{{ $skill->id }}" type="checkbox" name="skills[]"
                  value="{{ $skill->id }}" {{ $user->skills->contains($skill->id) ? 'checked' : '' }}
                  class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-teal-500">
                <label for="modal-skill-{{ $skill->id }}" class="ml-2 text-xs sm:text-sm text-gray-700">
                  {{ $skill->name }}
                </label>
              </div>
            @endforeach
          </div>
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end space-x-2">
          <button type="button" id="cancelButton"
            class="bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium px-4 py-2 rounded-md">
            {{ __('button.back') }}
          </button>
          <button type="submit"
            class="bg-yellow-400 hover:bg-yellow-500 text-white text-sm font-medium px-4 py-2 rounded-md">
            {{ __('button.edit') }}
          </button>
        </div>

      </form>
    </div>
  </div>


  {{-- === SCRIPT MODAL === --}}
  <script>
    const editButton = document.getElementById('editButton');
    const editModal = document.getElementById('editModal');
    const cancelButton = document.getElementById('cancelButton');

    editButton?.addEventListener('click', () => {
      editModal.classList.remove('hidden');
      editModal.classList.add('flex');
    });

    cancelButton?.addEventListener('click', () => {
      editModal.classList.remove('flex');
      editModal.classList.add('hidden');
    });

    // Tutup modal saat klik di luar form
    window.addEventListener('click', (e) => {
      if (e.target === editModal) {
        editModal.classList.remove('flex');
        editModal.classList.add('hidden');
      }
    });
    // 🖼️ === Preview Foto di Modal ===
    const fotoInput = document.querySelector('#editModal input[name="foto"]');
    const fotoPreview = document.querySelector('#editModal img');

    fotoInput?.addEventListener('change', (event) => {
      const file = event.target.files[0];
      if (file) {
        fotoPreview.src = URL.createObjectURL(file);
      }
    });

    function openModal(id) {
      document.getElementById(id).classList.remove('hidden');
      document.getElementById(id).classList.add('flex');
    }

    function closeModal(id) {
      document.getElementById(id).classList.add('hidden');
      document.getElementById(id).classList.remove('flex');
    }
  </script>
@endsection
