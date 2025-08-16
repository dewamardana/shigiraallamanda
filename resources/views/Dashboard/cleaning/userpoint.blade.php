@extends('Dashboard.Layout.main')

@section('content')
<div class="w-full max-w-7xl mx-auto px-4 py-6">
  <h1 class="text-3xl font-bold mb-6 text-gray-900">📊 {{ __('dashboardCleaning.userpoint.title' ) }}</h1>

    {{-- Filter --}}
    <div class="mb-6">
        <form method="GET" action="{{ route('userpoint') }}" class="grid sm:flex sm:flex-wrap sm:items-end gap-4">
            @csrf

            {{-- Start Date (Year & Month only) --}}
            <div class="relative w-full sm:w-auto">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <i data-feather="calendar" class="w-4 h-4 text-accent-1000"></i>
                </div>
                <input
                    id="filter_date"
                    name="filter_date"
                    datepicker
                    datepicker-autohide
                    datepicker-autoselect-today
                    datepicker-format="yyyy/mm"
                    type="text"
                    value="{{ old('filter_date', $filter_date ?? '') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-[200px] ps-10 p-2.5"
                    placeholder="YYYY/MM"
                >
            </div>

            {{-- Filter Button --}}
            <button type="submit"
                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center">
                {{ __('button.filter') }}
            </button>

            {{-- Reset Button --}}
            <a href="{{ route('checkerdata') }}">
                <button type="button"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-sm text-sm px-5 py-2.5">
                    {{ __('button.reset') }}
                </button>
            </a>

            {{-- Export Button --}}
            <a href="{{ route('userPointExport', [
                'year' => $year,
                'month' => $month
                ]) }}">
                <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-2.5 focus:outline-none">
                    {{ __('button.export') }}
                </button>
            </a>
        </form>
    </div>
  


<div class="overflow-x-auto bg-white rounded-xl shadow border border-gray-300 my-4">
  <table class="min-w-full table-auto text-sm text-gray-800 border-collapse">
    <thead class="bg-teal-1001 text-white">
      <tr>
        <th class="border border-gray-300 px-4 py-3 text-center whitespace-nowrap">
          {{ __('dashboardCleaning.userpoint.table.no') }}
        </th>
        <th class="border border-gray-300 px-4 py-3 text-left whitespace-nowrap">
          {{ __('dashboardCleaning.userpoint.table.name') }}
        </th>
        @for($i = 1; $i <= $daysInMonth; $i++)
          <th class="border border-gray-300 px-3 py-3 text-center whitespace-nowrap">
            {{ __('dashboardCleaning.userpoint.table.day') }} {{ $i }}
          </th>
        @endfor
        <th class="border border-gray-300 px-4 py-3 text-center whitespace-nowrap">
          {{ __('dashboardCleaning.userpoint.table.total') }}
        </th>
      </tr>
    </thead>
    <tbody class="text-sm">
      @php $no = 1; @endphp
      @foreach($rekap as $data)
        <tr class="border-t border-gray-200 hover:bg-yellow-50 odd:bg-teal-50">
          {{-- No --}}
          <td class="border border-gray-300 px-4 py-2 text-center font-semibold whitespace-nowrap">
            {{ $no++ }}
          </td>

          {{-- Nama --}}
          <td class="border border-gray-300 px-4 py-2 text-left font-semibold whitespace-nowrap">
            {{ $data['nama'] }}
          </td>

          {{-- Hari 1 - N --}}
          @for($i = 1; $i <= $daysInMonth; $i++)
            <td class="border border-gray-300 px-3 py-2 text-center whitespace-nowrap {{ $data['poin'][$i] == 0 ? 'text-gray-400' : 'font-medium text-slate-700' }}">
              {{ number_format($data['poin'][$i], 1) }}
            </td>
          @endfor

          {{-- Total --}}
          <td class="border border-gray-300 px-4 py-2 text-center font-bold text-blue-800 whitespace-nowrap">
            {{ number_format($data['total'], 1) }}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>




</div>
@endsection
