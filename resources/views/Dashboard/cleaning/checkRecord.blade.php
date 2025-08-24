@extends('Dashboard.Layout.main')

@section('content')
<div class="w-full max-w-screen-2xl mx-auto h-[calc(100vh-80px)] overflow-y-auto px-4 py-6">
  <h1 class="text-3xl font-bold mb-8 text-gray-800">📊 {{ __('dashboardCleaning.checkRecords.title') }}</h1>

  {{-- Filter --}}
  <div class="mb-6">
    <form action="{{ route('CheckOfficeHistoryData') }}" method="GET" class="grid sm:flex sm:flex-wrap sm:items-end gap-4">
      
      {{-- Start Date --}}
      <div class="relative w-full sm:w-auto">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <i data-feather="calendar" class="w-4 h-4 text-accent-1000"></i>
        </div>
        <input
          id="datepicker-start"
          name="start_date"
          value="{{ request('start_date') }}"
          datepicker
          datepicker-autohide
          datepicker-autoselect-today
          datepicker-format="dd/mm/yyyy"
          type="text"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-[200px] ps-10 p-2.5"
          placeholder="{{ __('general.filter.start_date') }}"
        >
      </div>

      {{-- End Date --}}
      <div class="relative w-full sm:w-auto">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <i data-feather="calendar" class="w-4 h-4 text-accent-1000"></i>
        </div>
        <input
          id="datepicker-end"
          name="end_date"
          value="{{ request('end_date') }}"
          datepicker
          datepicker-autohide
          datepicker-autoselect-today
          datepicker-format="dd/mm/yyyy"
          type="text"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-[200px] ps-10 p-2.5"
          placeholder="{{ __('general.filter.end_date') }}"
        >
      </div>

      {{-- Filter Button --}}
      <button type="submit"
        class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center">
        {{ __('button.filter') }}
      </button>

      {{-- Reset Button --}}
      <a href="{{ route('CheckOfficeHistoryData') }}">
        <button type="button"
          class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-sm text-sm px-5 py-2.5">
          {{ __('button.reset') }}
        </button>
      </a>
    </form>
  </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-white bg-teal-1001 text-center">
                <tr>
                    <th class="px-6 py-3">{{ __('dashboardCleaning.checkRecords.table.no') }}</th>
                    <th class="px-6 py-3">{{ __('dashboardCleaning.checkRecords.table.date') }}</th>
                    <th class="px-6 py-3">{{ __('dashboardCleaning.checkRecords.table.type') }}</th>
                    <th class="px-6 py-3">{{ __('dashboardCleaning.checkRecords.table.input_by') }}</th>
                    <th class="px-6 py-3">{{ __('dashboardCleaning.checkRecords.table.total_point') }}</th>
                    <th class="px-6 py-3">{{ __('dashboardCleaning.checkRecords.table.point_per_member') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($checkandoffice as $i => $data)
                    <tr class="bg-white odd:bg-teal-50 border-t border-gray-200 hover:bg-yellow-50 text-center">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $i + 1 }}</td>
                        <td class="px-6 py-4">{{ $data['date'] }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs
                                {{ $data['type'] == 'check' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($data['type']) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $data['user_name'] }}</td>
                        <td class="px-6 py-4">{{ number_format($data['total_point'] ?? 0, 1) }}</td>
                        <td class="px-6 py-4">{{ $data['point_per_member'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-gray-500 py-4">{{ __('dashboardCleaning.checkRecords.table.no_data') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
