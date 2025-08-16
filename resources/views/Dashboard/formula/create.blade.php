@extends('Dashboard.Layout.main')
@section('content')
<div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-full">
  <h2 class="font-bold text-4xl text-center text-black-500 mb-8">{{ __('dashboardFormulaCreate.title') }}</h2>
  <form action="{{ route('formula.store') }}" method="POST">@csrf
    <div class="flex flex-col gap-5">
      <div>
        <label for="building_slug" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('homepageIndex.building') }}</label>
        <select name="building_slug" required class="g-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="">{{ __('homepageIndex.select_building') }}</option>
            @foreach ($building as $build)
              <option value="{{ $build->slug }} {{ old('building_name') == $build->building_name ? 'selected' : '' }}">{{ $build->building_name }}</option>
            @endforeach
          </select>
      </div>
      <div>
          <label for="member_count" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCreate.member_label') }}</label>
          <input type="text" name="member_count" id="member_count" value="{{ old('member_count') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="0" required />                      
      </div>
      <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
        <div>
          <label for="oa" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCreate.oa_label') }}</label>
          <input type="number" name="oa" id="oa" min="0" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="0" required />
        </div>
        <div>
          <label for="ov" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCreate.ov_label') }}</label>
          <input type="number" name="ov" id="ov" min="0" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="0" required />
        </div>
        <div>
          <label for="stay" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCreate.stay_label') }}</label>
          <input type="number" name="stay" id="stay" min="0" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="0" required />
        </div>
        <div>
          <label for="vec" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCreate.vec_label') }}</label>
          <input type="number" name="vec" id="vec" min="0" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="0" required />
        </div>
        <div>
          <label for="premier" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaCreate.premier_label') }}</label>
          <input type="number" name="premier" id="premier" min="0" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="0" required />
        </div>
      </div>
      <div class="flex justify-center gap-4 mt-6">
        <button type="submit"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
            {{ __('dashboardFormulaCreate.button') }}
        </button>

        <a href="{{ route('formula.index') }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            {{ __('dashboardFormulaCreate.back') }}
        </a>
    </div>
    </div>
  </form>
</div>
@endsection
