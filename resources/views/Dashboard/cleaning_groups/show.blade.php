@extends('Dashboard.Layout.main')

@section('content')
  <div class="bg-white p-8 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-full">
    {{-- Judul --}}
    <h2 class="font-bold text-4xl text-center text-black-500 mb-10">
      {{ $cleaningGroup->building_name }}
    </h2>

    {{-- Foto & Info --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start mb-10">
      {{-- Foto --}}
      <div class="flex justify-center">
        <div class="relative w-48 h-48 rounded-full overflow-hidden border-4 border-indigo-600 shadow">
          <img
            src="{{ $cleaningGroup->foto ? asset('storage/' . $cleaningGroup->foto) : 'https://via.placeholder.com/150' }}"
            alt="{{ __('dashboardCleaningGroup.show.image_alt') }}" class="object-cover w-full h-full">
        </div>
      </div>

      {{-- Detail --}}
      <div class="md:col-span-2 space-y-6">
        <div>
          <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardCleaningGroup.common.description') }}</p>
          <p class="text-base text-gray-700 leading-relaxed">{{ $cleaningGroup->description ?: '-' }}</p>
        </div>
        <div>
          <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardCleaningGroup.common.status') }}</p>
          <span
            class="px-3 py-1 text-xs rounded-full font-semibold {{ $cleaningGroup->status == 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
            {{ ucfirst($cleaningGroup->status) }}
          </span>
        </div>
      </div>
    </div>

    {{-- Tasks --}}
    <div class="mt-8">
      <p class="text-xs font-semibold text-slate-500 mb-4">{{ __('dashboardCleaningGroup.show.assigned_tasks') }}</p>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($cleaningGroup->tasks as $task)
          <div class="bg-slate-100 p-5 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-lg font-semibold text-slate-800 mb-2">{{ $task->name }}</h3>
            <p class="text-sm text-slate-600">
              <span class="font-semibold text-slate-500">{{ __('dashboardCleaningGroup.show.formula') }}</span>
              {{ $task->pivot->formula }}
            </p>
          </div>
        @empty
          <div class="col-span-full text-center text-gray-500 italic">
            {{ __('dashboardCleaningGroup.show.no_tasks') }}
          </div>
        @endforelse
      </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="flex justify-between mt-10">
      <a href="{{ route('cleaningGroups.index') }}"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        {{ __('button.back') }}
      </a>
    </div>
  </div>
@endsection
