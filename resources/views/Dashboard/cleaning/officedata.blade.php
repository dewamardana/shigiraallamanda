<!-- resources/views/office_records/index.blade.php -->
@extends('Dashboard.Layout.main')

@section('content')
  <div class="w-full max-w-screen-2xl mx-auto h-[calc(100vh-80px)] overflow-y-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">{{ __('dashboardCleaning.officedata.title') }}</h1>
    {{-- Filter --}}
    <div class="mb-6">
      <form action="{{ route('officedata') }}" method="GET" class="grid sm:flex sm:flex-wrap sm:items-end gap-4">

        {{-- Start Date --}}
        <div class="relative w-full sm:w-auto">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <i data-feather="calendar" class="w-4 h-4 text-accent-1000"></i>
          </div>
          <input id="datepicker-start" name="start_date" value="{{ request('start_date') }}" datepicker
            datepicker-autohide datepicker-autoselect-today datepicker-format="dd/mm/yyyy" type="text"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-[200px] ps-10 p-2.5"
            placeholder="{{ __('general.filter.start_date') }}">
        </div>

        {{-- End Date --}}
        <div class="relative w-full sm:w-auto">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <i data-feather="calendar" class="w-4 h-4 text-accent-1000"></i>
          </div>
          <input id="datepicker-end" name="end_date" value="{{ request('end_date') }}" datepicker datepicker-autohide
            datepicker-autoselect-today datepicker-format="dd/mm/yyyy" type="text"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-[200px] ps-10 p-2.5"
            placeholder="{{ __('general.filter.end_date') }}">
        </div>

        {{-- User --}}
        <div class="w-full sm:w-auto">
          <label for="user_id" class="block mb-1 text-sm font-medium text-gray-900">
            {{ __('dashboardCleaning.checkdata.user') }}
          </label>
          <select id="user_id" name="user_id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full sm:w-[200px] p-2.5">
            <option value="">{{ __('dashboardCleaning.checkdata.all') }}</option>
            @foreach ($users as $u)
              <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>
                {{ $u->nama }}
              </option>
            @endforeach
          </select>
        </div>


        {{-- Filter Button --}}
        <button type="submit"
          class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center">
          {{ __('button.filter') }}
        </button>

        {{-- Reset Button --}}
        <a href="{{ route('officedata') }}">
          <button type="button"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-sm text-sm px-5 py-2.5">
            {{ __('button.reset') }}
          </button>
        </a>

        <a
          href="{{ route('officeexport', [
              'start_date' => request('start_date'),
              'end_date' => request('end_date'),
              'user_id' => request('user_id'),
          ]) }}">
          <button type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-2.5 focus:outline-none">
            {{ __('button.export') }}
          </button>
        </a>


      </form>
    </div>

    {{-- Table --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-white bg-teal-1001 text-center">
          <tr>
            <th scope="col" class="px-6 py-3">{{ __('dashboardCleaning.officedata.table.no') }}</th>
            <th scope="col" class="px-6 py-3">{{ __('dashboardCleaning.officedata.table.date') }}</th>
            <th scope="col" class="px-6 py-3">{{ __('dashboardCleaning.officedata.table.user') }}</th>
            <th scope="col" class="px-6 py-3">{{ __('dashboardCleaning.officedata.table.task_group') }}</th>
            <th scope="col" class="px-6 py-3">{{ __('dashboardCleaning.officedata.table.task_point') }}</th>
            <th scope="col" class="px-6 py-3">{{ __('dashboardCleaning.officedata.table.total') }}</th>
          </tr>
        </thead>
        <tbody>
          @forelse($records as $i => $record)
            <tr class="bg-white odd:bg-teal-50 border-t border-gray-200 hover:bg-yellow-50">
              {{-- No --}}
              <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $i + 1 }}
              </td>

              {{-- Tanggal --}}
              <td class="px-6 py-4 whitespace-nowrap">
                {{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}
              </td>

              {{-- User --}}
              <td class="px-6 py-4 whitespace-nowrap">
                {{ $record->details->pluck('user.nama')->unique()->join(', ') ?: '-' }}
              </td>

              {{-- Task Group --}}
              <td class="px-6 py-4 whitespace-nowrap">
                @if ($record->details->isNotEmpty())
                  {{ $record->details->first()->task->group->name ?? '-' }}
                @else
                  -
                @endif
              </td>

              {{-- Task & Point --}}
              <td class="px-6 py-4">
                <div class="flex flex-col gap-1">
                  @foreach ($record->details as $detail)
                    <span class="inline-block bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">
                      {{ $detail->task->name ?? '-' }} (+{{ $detail->point }})
                    </span>
                  @endforeach
                </div>
              </td>

              {{-- Total Point --}}
              <td class="px-6 py-4 text-center font-bold text-green-700 whitespace-nowrap">
                {{ $record->details->sum('point') }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-gray-500 py-4">
                {{ __('dashboardCleaning.officedata.table.empty') }}
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
