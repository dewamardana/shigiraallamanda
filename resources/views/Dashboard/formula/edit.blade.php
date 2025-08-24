@extends('Dashboard.Layout.main')
@section('content')
  <div class="bg-white p-5 rounded-xl shadow m-5 mx-auto max-w-5xl w-full">
    <h2 class="font-bold text-4xl text-center text-black-500 mb-8">{{ __('dashboardFormulaBuilding.edit.title') }}</h2>
    <form action="/dashboard/formula/{{ $formula->id }}" method="POST">
      @csrf @method('PUT')
      <div class="flex flex-col gap-5">
        <div>
          <label for="building_slug"
            class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaBuilding.form.building_label') }}</label>
          <input type="text" name="building_slug" id="building_slug"
            value="{{ old('building_slug', $formula->building_slug) }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            required />
        </div>
        <div>
          <label for="member_count"
            class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaBuilding.form.member_label') }}</label>
          <input type="text" name="member_count" id="member_count"
            value="{{ old('member_count', $formula->member_count) }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="0" required />
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
          <div>
            <label for="oa"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaBuilding.form.oa_label') }}</label>
            <input type="number" name="oa" id="oa" min="0" value="{{ old('oa', $formula->oa) }}"
              aria-describedby="helper-text-explanation"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
              placeholder="0" required />
          </div>
          <div>
            <label for="ov"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaBuilding.form.ov_label') }}</label>
            <input type="number" name="ov" id="ov" min="0" value="{{ old('ov', $formula->ov) }}"
              aria-describedby="helper-text-explanation"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
              placeholder="0" required />
          </div>
          <div>
            <label for="stay"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaBuilding.form.stay_label') }}</label>
            <input type="number" name="stay" id="stay" min="0" value="{{ old('stay', $formula->stay) }}"
              aria-describedby="helper-text-explanation"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
              placeholder="0" required />
          </div>
          <div>
            <label for="vec"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaBuilding.form.vec_label') }}</label>
            <input type="number" name="vec" id="vec" min="0" value="{{ old('vec', $formula->vec) }}"
              aria-describedby="helper-text-explanation"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
              placeholder="0" required />
          </div>
          <div>
            <label for="premier"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardFormulaBuilding.form.premier_label') }}</label>
            <input type="number" name="premier" id="premier" min="0"
              value="{{ old('premier', $formula->premier) }}" aria-describedby="helper-text-explanation"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
              placeholder="0" required />
          </div>
        </div>
        <div class="flex justify-center gap-4 mt-6">
          <button type="submit"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
            {{ __('button.edit') }}
          </button>

          <a href="{{ route('formula.index') }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            {{ __('button.back') }}
          </a>
        </div>
      </div>
    </form>
  </div>
@endsection
