@extends('Homepage.Layout.main')

@section('content')
<div class="mt-4 my-20 mx-10 md:max-w-full p-4 bg-white border border-gray-200 rounded-lg shadow-2xl sm:p-6 md:p-8">
    <h2 class="text-2xl font-bold text-teal-1001 text-center">{{ __('history.tooltip.activity_detail') }}</h2>

      {{-- Filter --}}
    <div class="mb-6">
        <form action="{{ route('history') }}" method="GET" class="grid sm:flex sm:flex-wrap sm:items-end gap-4">
        
        {{-- Start Date --}}
        <div class="relative w-full sm:w-auto mt-8">
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
        <a href="{{ route('history') }}">
            <button type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-sm text-sm px-5 py-2.5">
            {{ __('button.reset') }}
            </button>
        </a>

        </form>
    </div>

      
    {{-- Tabel --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-black">
            <thead class="text-xs text-white uppercase bg-teal-1001">
                <tr>
                    <th scope="col" class="px-6 py-3">{{ __('history.table.date') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('history.table.activity_type') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('history.table.activity_detail') }}</th>
                    <th scope="col" class="px-6 py-3 text-center">{{ __('history.table.point') }}</th>
                    <th scope="col" class="px-6 py-3 text-center">{{ __('history.table.total_point') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($points as $date => $records)
                    @php
                        $totalPoin = $records->sum('point');
                    @endphp
                    @foreach($records as $index => $record)
                        <tr class="{{ $loop->parent->iteration % 2 === 0 ? 'bg-slate-100' : 'bg-white' }} hover:bg-yellow-50">
                            @if($index === 0)
                                {{-- Kolom tanggal --}}
                                <td class="px-6 py-4" rowspan="{{ count($records) }}">
                                    {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
                                </td>
                            @endif

                            {{-- Jenis aktivitas --}}
                            <td class="px-6 py-4">
                                {{ $record->activity_type }}
                            </td>

                            {{-- Detail aktivitas dengan tooltip --}}
                            <td class="px-6 py-4" title="{{ $record->activity_detail }}">
                                {{ \Illuminate\Support\Str::limit($record->activity_detail, 30, '...') }}
                            </td>

                            {{-- Poin per task --}}
                            <td class="px-6 py-4 text-center text-blue-800 font-bold">
                                {{ number_format($record->point, 2) }}
                            </td>

                            @if($index === 0)
                                {{-- Total poin hari itu --}}
                                <td class="px-6 py-4 bg-blue-100 text-center font-bold text-blue-800" rowspan="{{ count($records) }}">
                                    {{ number_format($totalPoin, 2) }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 my-6 overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-teal-500 to-teal-700">
            <h3 class="text-lg font-bold text-white">
                {{ __('history.title') }} ({{ now()->translatedFormat('F Y') }})
            </h3>
        </div>

        @if($monthlySummary->isEmpty())
            <div class="px-6 py-4 text-gray-600 text-center">
                {{ __('history.monthly_summary.no_data') }}
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-800 border-collapse">
                    <thead>
                        <tr class="bg-teal-1001 text-white uppercase text-xs tracking-wider">
                            <th class="px-4 py-3 text-center border border-gray-300 whitespace-nowrap">{{ __('history.monthly_summary.date') }}</th>
                            <th class="px-4 py-3 text-center border border-gray-300 whitespace-nowrap">{{ __('history.monthly_summary.total_points') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($monthlySummary as $summary)
                            <tr class="hover:bg-yellow-50 {{ $loop->odd ? 'bg-slate-50' : 'bg-white' }}">
                                <td class="px-4 py-2 text-center font-medium text-gray-700 border border-gray-300">
                                    {{ \Carbon\Carbon::parse($summary->date)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-2 text-center font-bold border border-gray-300
                                    {{ $summary->total_point >= 20 ? 'text-green-600' : 'text-blue-700' }}">
                                    {{ number_format($summary->total_point, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-100 font-bold">
                            <td class="px-4 py-3 text-center border border-gray-300">{{ __('history.monthly_summary.total_month') }}</td>
                            <td class="px-4 py-3 text-center border border-gray-300 text-green-700">
                                {{ number_format($monthlySummary->sum('total_point'), 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @endif
    </div>

</div>
@endsection
