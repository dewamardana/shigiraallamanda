@extends('Homepage.Layout.main')

@section('content')
<div class="mt-4 my-20 mx-4 md:mx-auto md:max-w-2xl p-4 bg-white border border-gray-200 rounded-lg shadow-2xl sm:p-6 md:p-8">
    <div id="form-checker" class="mt-6">
            <h2 class="text-xl font-bold text-center text-teal-1001 mb-4">
                Task {{ $tasksActive->name }}
            </h2>
        <form action="{{ route('officeStore') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="task_group_id" value="{{ $tasksActive->id }}">

            {{-- Nama User --}}
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-teal-1001">{{ __('checker.name') }}</label>
                <input type="text" value="{{ $user->nama }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" readonly/>
            </div>

            {{-- Date Input Demo--}}
            <div class="mb-6">
                <label for="date" class="block mb-1 font-medium text-teal-1001">
                    {{ __('form.date_input') ?? 'Date' }}
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i data-feather="calendar" class="w-4 y-4 text-accent-1000"></i>
                    </div>
                    <input
                        type="text"
                        id="date"
                        name="date"
                        value="{{ now()->toDateString() }}"
                        readonly
                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg w-full ps-10 p-2.5 cursor-not-allowed"
                    >
                </div>
            </div>

            {{-- Loop Task Group Aktif --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                @foreach ($tasksActive->tasks as $task)
                    @php
                        $detail = $task->details->first(); // Ambil siapa yang sudah kerjakan di tanggal tsb
                    @endphp

                    @if ($detail)
                        {{-- Sudah dikerjakan --}}
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 flex items-center justify-center rounded-full bg-teal-1001 text-white font-bold">
                                {{ strtoupper(substr($detail->user->nama, 0, 2)) }}
                            </div>
                            <span class="text-sm text-gray-700">{{ $task->name }}</span>
                        </div>
                    @else
                        {{-- Belum dikerjakan --}}
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="tasks[]" value="{{ $task->id }}"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                            <span class="text-sm font-medium text-teal-1001">{{ $task->name }}</span>
                        </label>
                    @endif
                @endforeach
            </div>
            {{-- Submit --}}
            <div class="flex justify-center gap-4 mt-6">
                <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
                    {{ __('button.submit') }}
                </button>

                <a href="{{ route('homepage') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    {{ __('button.back') }}
                </a>
            </div>            
        </form>
    </div>
</div>
@endsection
