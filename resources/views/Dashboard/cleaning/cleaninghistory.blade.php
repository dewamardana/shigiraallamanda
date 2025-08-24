@extends('Dashboard.Layout.main')

@section('content')
<div class="w-full max-w-screen-2xl mx-auto h-[calc(100vh-80px)] overflow-y-auto px-4 py-6">
  <h1 class="text-3xl font-bold mb-6 text-gray-800">📋 {{ __('dashboardCleaning.cleaningHistory.title') }}</h1>


  <p class="text-2xl font-semibold mb-4 text-blue-800 text-center">
    {{ __('dashboardCleaning.cleaningHistory.cleaning_title') }}
  </p>


    <div class="pb-4">
        <label for="table-search" class="sr-only text-teal-1001">{{ __('form.search') }}</label>
        <div class="relative mt-1">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <i data-feather="search" class="w-4 y-4 text-accent-1000"></i>
            </div>
            <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="{{ __("form.search_placeholder") }}">
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-white bg-teal-1001 text-center">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('dashboardCleaning.cleaningHistory.table.no') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('dashboardCleaning.cleaningHistory.table.date') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('dashboardCleaning.cleaningHistory.table.input_by') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('dashboardCleaning.cleaningHistory.table.building') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('dashboardCleaning.cleaningHistory.table.total_point') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('dashboardCleaning.cleaningHistory.table.point_per_member') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('dashboardCleaning.cleaningHistory.table.members') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($cleaningData as $i => $data)
                    <tr class="bg-white odd:bg-teal-50 border-t border-gray-200 hover:bg-yellow-50">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $i + 1 }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $data['date'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $data['user_name'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $data['building'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ number_format($data['total_point'] ?? 0, 1) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $data['point_per_member'] }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                            @foreach($data['members'] as $member)
                                <span class="inline-block bg-blue-100 text-blue-800 px-2 rounded text-xs">{{ $member }}</span>
                            @endforeach
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-4">
                            {{ __('dashboardCleaning.cleaningHistory.table.no_data') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

