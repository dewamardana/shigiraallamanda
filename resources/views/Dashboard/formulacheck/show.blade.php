@extends('Dashboard.Layout.main')

@section('content')
  <div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-full">

    <div class="flex flex-col items-center mb-8">
      <h2 class="font-bold text-4xl text-center text-black-500 mb-8">{{ __('dashboardFormulaCheck.show.title') }}</h2>
      <p class="text-indigo-500 font-semibold mt-1">{{ $formulaCheck->name }}</p>
      <p class="text-gray-600 text-sm italic">{{ $formulaCheck->description }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-slate-700">
      <div class="bg-slate-100 p-4 rounded-lg">
        <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardFormulaCheck.form.active') }}</p>
        <p class="text-base font-medium {{ $formulaCheck->active ? 'text-green-600' : 'text-red-600' }}">
          {{ $formulaCheck->active ? 'Yes' : 'No' }}
        </p>
      </div>

      <div class="bg-slate-100 p-4 rounded-lg">
        <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardFormulaCheck.form.jumlah_kamar') }}</p>
        <p class="text-base font-medium">{{ $formulaCheck->jumlah_kamar }}</p>
      </div>

      <div class="bg-slate-100 p-4 rounded-lg">
        <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardFormulaCheck.form.mengajar') }}</p>
        <p class="text-base font-medium">{{ $formulaCheck->mengajar }}</p>
      </div>

      <div class="bg-slate-100 p-4 rounded-lg">
        <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardFormulaCheck.form.pembersihan_khusus') }}
        </p>
        <p class="text-base font-medium">{{ $formulaCheck->pembersihan_khusus }}</p>
      </div>

      <div class="bg-slate-100 p-4 rounded-lg">
        <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardFormulaCheck.form.mengangkat_barang') }}</p>
        <p class="text-base font-medium">{{ $formulaCheck->mengangkat_barang }}</p>
      </div>

      <div class="bg-slate-100 p-4 rounded-lg">
        <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardFormulaCheck.form.membersihkan_gudang') }}
        </p>
        <p class="text-base font-medium">{{ $formulaCheck->membersihkan_gudang }}</p>
      </div>

      <div class="bg-slate-100 p-4 rounded-lg">
        <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardFormulaCheck.form.obat_pool') }}</p>
        <p class="text-base font-medium">{{ $formulaCheck->obat_pool }}</p>
      </div>

      <div class="bg-slate-100 p-4 rounded-lg">
        <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardFormulaCheck.form.membersihkan_pool') }}</p>
        <p class="text-base font-medium">{{ $formulaCheck->membersihkan_pool }}</p>
      </div>

      <div class="bg-slate-100 p-4 rounded-lg">
        <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardFormulaCheck.form.sampah') }}</p>
        <p class="text-base font-medium">{{ $formulaCheck->sampah }}</p>
      </div>
    </div>

    <div class="flex justify-between mt-8">
      <a href="{{ route('formulaCheck.index') }}"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">←
        {{ __('button.back') }}</a>
    </div>
  </div>
@endsection
