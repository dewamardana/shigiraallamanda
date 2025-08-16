@extends('Dashboard.Layout.main')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-2xl m-5 mx-auto max-w-4xl w-full">

  <!-- Foto Building -->
  <div class="flex flex-col items-center mb-8">
    <div class="relative w-84 h-64 rounded-lg overflow-hidden border-4 border-teal-600 mb-4 shadow">
      <img src="{{ $building->foto ? asset('storage/'.$building->foto) : 'https://via.placeholder.com/300x200' }}" 
           alt="Building Photo" class="object-cover w-full h-full">
    </div>
    <h1 class="text-3xl font-bold text-gray-800 text-center">{{ $building->building_name }}</h1>
  </div>

  <!-- Info Detail -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-slate-700">
    <div class="md:col-span-2 bg-slate-100 p-4 rounded-lg">
      <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardBuildingShow.description') }}</p>
      <p class="text-base font-medium text-gray-800 leading-relaxed">
        {{ $building->description }}
      </p>
    </div>
  </div>

  <!-- Tombol Navigasi -->
  <div class="flex justify-between mt-8">
    <a href="/dashboard/building" class="bg-blue-500 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-blue-600 flex items-center gap-1">
      <i data-feather="arrow-left"></i>{{ __('dashboardBuildingShow.back') }}
    </a>
  </div>
</div>

@endsection
