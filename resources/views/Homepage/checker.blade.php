@extends('Homepage.Layout.main')

@section('content')
    {{-- Alert Component --}}
    @if (session('success'))
        <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 mt-4 w-1/2 mx-auto" role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ms-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @elseif (session('warning'))
        <div id="alert-4" class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 mt-4 w-1/2 mx-auto" role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ms-3 text-sm font-medium">
                {{ session('warning') }}
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-4" aria-label="Close">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
            </div>
        </div>
     @elseif (session('error'))
        <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 mt-4 w-1/2 mx-auto" role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ms-3 text-sm font-medium">
                {{ session('error') }}
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
    {{-- End Alert Component --}}


<div class="mt-4 my-20 mx-4 md:mx-auto md:max-w-2xl p-4 bg-white border border-gray-200 rounded-lg shadow-2xl sm:p-6 md:p-8">
    <!-- FORM CHECKER -->
    <div id="form-checker" class="mt-6">
        <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-teal-1001">{{ __('checker.checker_data_input') }}</h2>
        </div>

        <form action="{{ route('checkerStore') }}" method="POST">
        @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <!-- Nama User -->
            <div class="mb-4">
                <label for="first_name" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('checker.name') }}</label>
                <input type="text" value="{{ $user->nama }}" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="John" readonly/>
                @error('first_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Date Input -->
            <div class="mb-6">
                <label for="date" class="block mb-1 font-medium text-teal-1001">
                    {{ __('form.date_input') ?? 'Date' }}
                </label>

                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i data-feather="calendar" class="w-4 y-4 text-accent-1000"></i>
                    </div>
                <input id="datepicker-autohide" name="date" datepicker datepicker-autohide datepicker-autoselect-today datepicker-format="yyyy-mm-dd" type="text" value="{{ old('date') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="{{ __('form.date_placeholder') }}">
                </div> 
                @error('date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jumlah Kamar -->
            <div class="mb-4">
                <label for="jumlah_kamar" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('checker.total_rooms') }}</label>
                <input type="number" id="number-input" name="jumlah_kamar" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                @error('jumlah_kamar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Checkbox Section -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="mengajar" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                    <span class="ms-2 text-sm font-medium text-teal-1001">{{ __('checker.teaching') }}</span>
                    @error('mengajar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" name="pembersihan_khusus" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                    <span class="ms-2 text-sm font-medium text-teal-1001">{{ __('checker.special_cleaning') }}</span>
                    @error('pembersihan_khusus')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="membawa_bagasi" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                    <span class="ms-2 text-sm font-medium text-teal-1001">{{ __('checker.lifting') }}</span>
                    @error('membawa_bagasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="membersihkan_gudang" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                    <span class="ms-2 text-sm font-medium text-teal-1001">{{ __('checker.warehouse_cleaning') }}</span>
                    @error('membersihkan_gudang')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="obat_pool" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                    <span class="ms-2 text-sm font-medium text-teal-1001">{{ __('checker.pool_chemicals') }}</span>
                    @error('obat_pool')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="membersihkan_kolam" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                    <span class="ms-2 text-sm font-medium text-teal-1001">{{ __('checker.pool_cleaning') }}</span>
                    @error('membersihkan_kolam')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="sampah" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                    <span class="ms-2 text-sm font-medium text-teal-1001">{{ __('checker.waste_disposal') }}</span>
                    @error('sampah')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </label>
            </div>

            <!-- Submit Button -->
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