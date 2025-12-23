@extends('Homepage.Layout.main')

@section('content')
  <div class="max-w-screen-2xl mx-auto px-4 md:px-6 lg:px-8 py-6 md:py-8 space-y-10">

    {{-- ================= QUICK INFO ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

      {{-- ROOM INFO --}}
      <div class="p-5 rounded-xl bg-gradient-to-br from-blue-600 to-blue-500 text-white shadow">
        <p class="text-xs opacity-80">Room</p>
        <p class="text-2xl font-bold">{{ $room->room_name ?? 'Room' }}</p>
        <p class="text-xs mt-1 opacity-90">Quick Status Overview</p>
      </div>

      {{-- LAST CLEANING --}}
      <div class="p-5 rounded-xl bg-white shadow border-l-4 border-purple-600">
        <p class="text-xs text-gray-500">Cleaning Terakhir</p>
        <p class="text-lg font-semibold text-purple-700">
          {{ $lastCleaning?->date ?? '-' }}
        </p>
        <p class="text-xs text-gray-600 mt-1">
          {{ $lastCleaning?->members?->pluck('nama')->join(', ') ?? '-' }}
        </p>
      </div>

      {{-- LAST CHECKER --}}
      <div class="p-5 rounded-xl bg-white shadow border-l-4 border-green-600">
        <p class="text-xs text-gray-500">Checker Terakhir</p>
        <p class="text-lg font-semibold text-green-700">
          {{ $lastChecker?->date ?? '-' }}
        </p>
        <p class="text-xs text-gray-600 mt-1">
          {{ $lastChecker?->user?->nama ?? '-' }}
        </p>
      </div>

      {{-- ACTIVE REPORT --}}
      <div
        class="p-5 rounded-xl shadow text-white {{ $activeReportsCount > 0 ? 'bg-gradient-to-br from-red-600 to-red-500' : 'bg-gradient-to-br from-green-600 to-green-500' }}">
        <p class="text-xs opacity-90">Report Aktif</p>
        <p class="text-3xl font-bold">
          {{ $activeReportsCount }}
        </p>
        <p class="text-xs opacity-90 mt-1">
          {{ $activeReportsCount > 0 ? 'Perlu perhatian' : 'Aman' }}
        </p>
      </div>
    </div>

    <div class="flex flex-wrap items-center gap-3 mb-6 bg-white p-4 rounded-xl shadow border">

      {{-- Cleaning Filter --}}
      <form method="GET" class="flex items-center gap-2">
        <input type="hidden" name="checker_task" value="{{ request('checker_task') }}">

        <select name="cleaning_task" onchange="this.form.submit()"
          class="px-3 py-2 text-sm rounded-lg border border-purple-300
             focus:ring-purple-500 focus:border-purple-500">

          <option value="">🧹 Semua Task Cleaning</option>

          @foreach ($cleaningTasks as $task)
            <option value="{{ $task->id }}" @selected(request('cleaning_task') == $task->id)>
              {{ $task->name }}
            </option>
          @endforeach
        </select>
      </form>

      {{-- Checker Filter --}}
      <form method="GET" class="flex items-center gap-2">
        <input type="hidden" name="cleaning_task" value="{{ request('cleaning_task') }}">

        <select name="checker_task" onchange="this.form.submit()"
          class="px-3 py-2 text-sm rounded-lg border border-green-300
             focus:ring-green-500 focus:border-green-500">

          <option value="">✅ Semua Task Checker</option>

          @foreach ($checkerTasks as $task)
            <option value="{{ $task->id }}" @selected(request('checker_task') == $task->id)>
              {{ $task->name }}
            </option>
          @endforeach
        </select>
      </form>

      {{-- Reset --}}
      @if (request()->has('cleaning_task') || request()->has('checker_task'))
        <a href="{{ route('roomHistory', $room->id) }}"
          class="px-4 py-2 text-sm rounded-lg bg-gray-200 hover:bg-gray-300">
          Reset Filter
        </a>
      @endif

    </div>





    {{-- CLEANING SESSION --}}
    <h2 class="text-xl font-semibold mb-4 text-center text-purple-700">
      🧹 Riwayat Cleaning
    </h2>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
      @foreach ($cleaningPaginated as $record)
        {{-- CARD --}}
        <div class="rounded-xl shadow bg-white border border-gray-100 hover:shadow-lg transition cursor-pointer"
          onclick="openModal('cleaning-{{ $record->id }}')">

          <div class="p-5">
            <div class="flex items-center justify-between mb-3">
              <span class="px-3 py-1 text-xs rounded-full bg-purple-100 text-purple-700 font-medium">
                {{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}
              </span>
              <i data-feather="check-circle" class="text-green-500 w-5 h-5"></i>
            </div>

            <h3 class="text-gray-900 font-semibold text-lg">
              {{ $record->group->building_name }}
            </h3>

            <p class="text-sm text-gray-600 mt-1">
              Petugas: {{ $record->members->pluck('nama')->join(', ') }}
            </p>

            <p class="text-sm text-gray-500 mt-2">
              {{ $record->details->count() }} task dikerjakan
            </p>
          </div>
        </div>

        {{-- MODAL --}}
        <div id="cleaning-{{ $record->id }}"
          class="fixed inset-0 backdrop-blur-sm bg-black/50 z-50 hidden items-center justify-center">

          <div
            class="bg-white mx-4 p-6 rounded-xl w-full max-w-3xl border border-gray-200 shadow-lg
               overflow-auto max-h-[90vh]">

            <h3 class="text-xl font-bold mb-4 text-center">
              Detail Cleaning – {{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}
            </h3>

            <div class="text-sm text-gray-700 mb-4 space-y-1">
              <p>
                Gedung:
                <strong>{{ $record->group->building_name }}</strong>
              </p>
              <p>
                Petugas:
                {{ $record->members->pluck('nama')->join(', ') }}
              </p>
            </div>

            {{-- TABEL TASK --}}
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
              <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-white bg-purple-600 uppercase text-center">
                  <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Task</th>
                    <th class="px-6 py-3">Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($record->details as $detail)
                    <tr class="bg-white even:bg-purple-50 border-b hover:bg-yellow-50 text-center">
                      <td class="px-6 py-4">{{ $loop->iteration }}</td>
                      <td class="px-6 py-4 text-left">{{ $detail->task->name }}</td>
                      <td class="px-6 py-4">{{ $detail->value }}</td>
                    </tr>
                  @endforeach

                  @if ($record->details->isEmpty())
                    <tr>
                      <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                        Tidak ada detail task
                      </td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>

            {{-- ACTION --}}
            <div class="flex justify-end pt-6">
              <button onclick="closeModal('cleaning-{{ $record->id }}')"
                class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4
                   focus:ring-purple-300 font-medium rounded-lg text-sm px-6 py-2.5">
                Tutup
              </button>
            </div>

          </div>
        </div>
      @endforeach
    </div>

    {{-- PAGINATION --}}
    <div class="mt-6">
      {{ $cleaningPaginated->links('vendor.pagination.flowbite') }}
    </div>

    {{-- ================= CHECKER ================= --}}
    <h2 class="text-xl font-semibold mb-4 text-center text-green-700">Riwayat Checker</h2>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 mb-10">
      @forelse ($checkerPaginated as $c)
        <div class="rounded-xl shadow bg-white border border-gray-100 hover:shadow-lg transition cursor-pointer"
          onclick="openModal('checker-{{ $c->id }}')">
          <div class="p-5">
            <div class="flex items-center justify-between mb-3">
              <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">
                {{ \Carbon\Carbon::parse($c->date)->format('d M Y') }}
              </span>
              <i data-feather="clipboard" class="text-green-600 w-5 h-5"></i>
            </div>

            <h3 class="text-gray-900 font-semibold text-lg">
              {{ optional($c->details->first()?->locations->first()?->group)->building_name ?? '-' }}
            </h3>

            <p class="text-sm text-gray-500 mt-1">
              {{ $c->details->count() }} task dicek
            </p>

            <p class="text-sm text-gray-700 mt-2">
              Checker:
              <span class="font-semibold">{{ $c->user->nama ?? '-' }}</span>
            </p>
          </div>
        </div>


        <div id="checker-{{ $c->id }}"
          class="fixed inset-0 backdrop-blur-sm bg-black/50 z-50 hidden items-center justify-center">

          <div
            class="bg-white mx-4 p-6 rounded-xl w-full max-w-3xl border border-gray-200 shadow-lg
              overflow-auto max-h-[90vh]">

            <h3 class="text-xl font-bold mb-4 text-center">
              Detail Checker - {{ \Carbon\Carbon::parse($c->date)->format('d M Y') }}
            </h3>

            {{-- INFO --}}
            <div class="grid grid-cols-2 gap-4 text-sm mb-4">
              <p>
                <span class="font-semibold">Gedung:</span>
                {{ optional($c->details->first()?->locations->first()?->group)->building_name ?? '-' }}
              </p>
              <p>
                <span class="font-semibold">Checker:</span>
                {{ $c->user->nama ?? '-' }}
              </p>
            </div>

            {{-- TABEL TASK --}}
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
              <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-white bg-green-700 uppercase text-center">
                  <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Task</th>
                    <th class="px-6 py-3">Value</th>
                    <th class="px-6 py-3">Formula</th>
                    <th class="px-6 py-3">Calculated</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($c->details as $d)
                    <tr class="bg-white even:bg-green-50 border-b hover:bg-yellow-50 text-center">
                      <td class="px-6 py-4">{{ $loop->iteration }}</td>
                      <td class="px-6 py-4 text-left">{{ $d->task->name ?? '-' }}</td>
                      <td class="px-6 py-4">{{ $d->value }}</td>
                      <td class="px-6 py-4">{{ $d->formula }}</td>
                      <td class="px-6 py-4">{{ number_format($d->calculated ?? 0, 2) }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            {{-- RINGKASAN --}}
            <div class="flex justify-between mt-6 px-2 text-sm">
              <p class="font-semibold">
                Total Point:
                <span class="text-green-600">
                  {{ number_format($c->total_point ?? 0, 2) }}
                </span>
              </p>
            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end gap-3 pt-6">
              <button onclick="closeModal('checker-{{ $c->id }}')"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4
               focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
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

    {{-- PAGINATION --}}
    <div class="mt-6">
      {{ $checkerPaginated->links('vendor.pagination.flowbite') }}
    </div>



    <h2 class="text-lg font-bold text-red-600 mb-4">🛠️ Report & Masalah</h2>
    <div class="bg-white rounded-xl shadow overflow-hidden">
      <table class="w-full text-sm bg-white rounded-lg shadow overflow-hidden">
        <thead class="bg-red-600 text-white text-center">
          <tr>
            <th class="px-4 py-2">Tanggal</th>
            <th class="px-4 py-2">Masalah</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($reports as $report)
            <tr class="border-t hover:bg-red-50 text-center">
              <td class="px-4 py-2">{{ $report->date }}</td>
              <td class="px-4 py-2 font-medium">{{ $report->report_type }}</td>
              <td class="px-4 py-2">
                <span
                  class="px-2 py-1 rounded text-xs font-semibold
            {{ $report->status === 'pending'
                ? 'bg-yellow-200 text-yellow-800'
                : ($report->status === 'resolved'
                    ? 'bg-green-200 text-green-800'
                    : 'bg-blue-200 text-blue-800') }}">
                  {{ ucfirst($report->status) }}
                </span>
              </td>
              <td class="px-4 py-2">
                <a href="{{ route('reportHistory.show', $report) }}"
                  class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded">
                  Detail
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center py-4 text-gray-500 italic">
                Tidak ada laporan
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('script')
  <script>
    function openModal(id) {
      const modal = document.getElementById(id);
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }

    function closeModal(id) {
      const modal = document.getElementById(id);
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  </script>
@endsection
