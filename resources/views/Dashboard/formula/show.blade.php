@extends('Dashboard.Layout.main')
@section('content')
<div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-full">

    <div class="flex flex-col items-center mb-8">
        <h2 class="font-bold text-4xl text-center text-black-500 mb-8">{{ __('dashboardFormulaShow.title') }}</h2>
        <p class="text-indigo-500 font-semibold mt-1">{{ $formula->building->building_name }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-slate-700 mb-8">
        <div class="bg-slate-100 p-4 rounded-lg">
            <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardFormulaShow.member_count') }}</p>
            <p class="text-base font-medium">{{ $formula->member_count }}</p>
        </div>
        <div class="bg-slate-100 p-4 rounded-lg">
            <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardFormulaShow.oa') }}</p>
            <p class="text-base font-medium">{{ $formula->oa }}</p>
        </div>
        <div class="bg-slate-100 p-4 rounded-lg">
            <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardFormulaShow.ov') }}</p>
            <p class="text-base font-medium">{{ $formula->ov }}</p>
        </div>
        <div class="bg-slate-100 p-4 rounded-lg">
            <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardFormulaShow.stay') }}</p>
            <p class="text-base font-medium">{{ $formula->stay }}</p>
        </div>
        <div class="bg-slate-100 p-4 rounded-lg">
            <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardFormulaShow.vec') }}</p>
            <p class="text-base font-medium">{{ $formula->vec }}</p>
        </div>
        <div class="bg-slate-100 p-4 rounded-lg">
            <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardFormulaShow.premier') }}</p>
            <p class="text-base font-medium">{{  $formula->premier ?? '-' }}</p>
        </div>
        
    </div>
    <a href="{{ route('formula.index') }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            ← {{ __('dashboardFormulaShow.back') }}
    </a>
</div>
@endsection
