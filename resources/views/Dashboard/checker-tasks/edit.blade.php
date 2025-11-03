@extends('Dashboard.Layout.main')

@section('content')
  <div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-1/2">
    <h2 class="font-bold text-4xl text-center text-black-500 mb-8">{{ __('dashboardCheckerTask.edit.title') }}</h2>

    <form action="{{ route('checker-tasks.update', $checkerTask->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="flex flex-col md:flex-row gap-8 justify-center p-6">
        {{-- Form Input --}}
        <div class="w-1/2 space-y-5">
          <div>
            <label for="name"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardCheckerTask.form.name') }}</label>
            <input type="text" name="name" id="name" value="{{ old('name', $checkerTask->name) }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
              focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              required />
            @error('name')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="type"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardCheckerTask.form.type') }}</label>
            <select name="type" id="type"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
              focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              required>
              <option value="boolean" {{ old('type', $checkerTask->type) == 'boolean' ? 'selected' : '' }}>
                {{ __('dashboardCheckerTask.option.boolean') }}
              </option>
              <option value="number" {{ old('type', $checkerTask->type) == 'number' ? 'selected' : '' }}>
                {{ __('dashboardCheckerTask.option.number') }}</option>
            </select>
            @error('type')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="formula"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardCheckerTask.form.formula') }}</label>
            <input type="number" step="0.01" name="formula" id="formula"
              value="{{ old('formula', $checkerTask->formula) }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
              focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              required />
            @error('formula')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="active" class="inline-flex items-center cursor-pointer">
              <span class="mr-3 text-sm font-medium text-gray-700">{{ __('dashboardTaskGroup.form.active') }}</span>
              <div class="relative">
                <input type="checkbox" id="active" name="active" value="1" class="sr-only peer"
                  {{ old('active', $checkerTask->active) ? 'checked' : '' }}>
                <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-teal-600 transition-all duration-300">
                </div>
                <div
                  class="absolute left-0.5 top-0.5 bg-white w-5 h-5 rounded-full transition-all duration-300 peer-checked:translate-x-full">
                </div>
              </div>
            </label>
          </div>
        </div>
      </div>

      {{-- Tombol Aksi --}}
      <div class="flex justify-center gap-4 mt-6">
        <button type="submit"
          class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 
          focus:ring-yellow-300 font-medium rounded-lg text-sm px-6 py-2.5">
          {{ __('button.edit') }}
        </button>

        <a href="{{ route('checker-tasks.index') }}"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 
          font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 
          focus:outline-none dark:focus:ring-blue-800">
          {{ __('button.back') }}
        </a>
      </div>
    </form>
  </div>
@endsection
