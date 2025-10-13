@extends('Homepage.Layout.main')

@section('content')
  {{-- Alert Component --}}
  @if (session('success'))
    <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 mt-4 w-1/2 mx-auto"
      role="alert">
      <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
        viewBox="0 0 20 20">
        <path
          d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
      </svg>
      <div class="ms-3 text-sm font-medium">
        {{ session('success') }}
      </div>
      <button type="button"
        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
        data-dismiss-target="#alert-3" aria-label="Close">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
      </button>
    </div>
  @elseif (session('warning'))
    <div id="alert-4" class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 mt-4 w-1/2 mx-auto"
      role="alert">
      <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
        viewBox="0 0 20 20">
        <path
          d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
      </svg>
      <div class="ms-3 text-sm font-medium">
        {{ session('warning') }}
      </div>
      <button type="button"
        class="ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8"
        data-dismiss-target="#alert-4" aria-label="Close">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
      </button>
    </div>
    </div>
  @elseif (session('error'))
    <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 mt-4 w-1/2 mx-auto"
      role="alert">
      <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
        viewBox="0 0 20 20">
        <path
          d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
      </svg>
      <div class="ms-3 text-sm font-medium">
        {{ session('error') }}
      </div>
      <button type="button"
        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
        data-dismiss-target="#alert-2" aria-label="Close">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
      </button>
    </div>
  @endif
  {{-- End Alert Component --}}

  <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6 p-4 items-stretch mb-4">
    {{-- User Profile Card (span 2 cols) --}}
    <div class="lg:col-span-2 h-full">
      <div class="w-full bg-white rounded-lg shadow-2xl">
        <div class="flex justify-end px-4 pt-4">
          <button id="dropdownButton" data-dropdown-toggle="dropdown"
            class="inline-block text-gray-500 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg text-sm p-1.5"
            type="button">
            <span class="sr-only">{{ __('homepageIndex.dropdown.open') }}</span>
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 16 3">
              <path
                d="M2 0a1.5 1.5 0 1 1 0 3A1.5 1.5 0 0 1 2 0Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3A1.5 1.5 0 0 1 14 0Z" />
            </svg>
          </button>
          <div id="dropdown"
            class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
            <ul class="py-2" aria-labelledby="dropdownButton">
              {{-- <li>
                <a href="{{ route('userprofile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal-200">
                  {{ __('homepageIndex.dropdown.profile') }}
                </a>
              </li> --}}
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit"
                    class="w-full text-left px-4 py-2 text-sm text-gray-700 rounded hover:bg-teal-200">
                    {{ __('general.logout') }}
                  </button>
                </form>
              </li>
            </ul>

          </div>
        </div>
        <div class="flex flex-col items-center pb-12 px-4">
          <img class="w-36 h-36 mb-3 rounded-full shadow-lg"
            src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/user-profile.png') }}"
            alt="User Image" />
          <h5 class="mb-1 text-xl font-medium text-teal-800">{{ $user->nama }}</h5>
          <span class="text-md text-black">{{ $user->department }}</span>
          <div class="grid grid-cols-2 gap-3 mt-4">
            @can('cleaning')
              <a href="{{ route('cleaning') }}"><button type="button"
                  class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm w-full px-5 py-2.5 text-center me-2 mb-2">{{ __('homepageIndex.cleaning') }}</button></a>
            @endcan
            @can('checker')
              <a href="{{ route('checker') }}"><button type="button"
                  class="text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-sm text-sm w-full px-5 py-2.5 text-center me-2 mb-2">{{ __('homepageIndex.checker') }}</button></a>
            @endcan
            @can('office')
              <a href="{{ route('office') }}"><button type="button"
                  class="text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-sm text-sm w-full px-5 py-2.5 text-center me-2 mb-2">{{ __('homepageIndex.office') }}</button></a>
            @endcan
            <a href="{{ route('lost') }}"><button type="button"
                class="text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-4 focus:ring-cyan-300 font-medium rounded-sm text-sm w-full px-5 py-2.5 text-center">
                {{ __('homepageIndex.lostfound') }}
              </button>
            </a>
            <a href="{{ route('history') }}"><button type="button"
                class="text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-sm text-sm w-full px-5 py-2.5 text-center me-2 mb-2 ">{{ __('homepageIndex.history') }}</button></a>
            <a href="{{ route('report') }}"><button type="button"
                class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-sm text-sm w-full px-5 py-2.5 text-center me-2 mb-2 ">{{ __('homepageIndex.report') }}</button></a>

          </div>

        </div>
      </div>
    </div>

    {{-- Leftside Info Panel --}}
    <div class="bg-white rounded-lg shadow-2xl p-6 space-y-6 h-full">
      <div class="flex items-center gap-3">
        <i class="fas fa-umbrella-beach text-teal-600 text-2xl"></i>
        <div>
          <h1 class="text-2xl font-bold text-teal-900">{{ __('general.brand_name') }}</h1>
          <p class="text-sm text-slate-500">{{ __('general.brand_subtitle') }}</p>
        </div>
      </div>

      <div class="space-y-4">
        <div>
          <h3 class="font-semibold text-teal-900">{{ __('homepageIndex.left_info.simple') }}</h3>
          <p class="text-sm text-slate-600">{{ __('homepageIndex.left_info.simple_desc') }}</p>
        </div>
        <div>
          <h3 class="font-semibold text-teal-900">{{ __('homepageIndex.left_info.multi') }}</h3>
          <p class="text-sm text-slate-600">{{ __('homepageIndex.left_info.multi_desc') }}</p>
        </div>
        <div>
          <h3 class="font-semibold text-teal-900">{{ __('homepageIndex.left_info.team') }}</h3>
          <p class="text-sm text-slate-600">{{ __('homepageIndex.left_info.team_desc') }}</p>
        </div>
      </div>

      <blockquote class="italic text-teal-800 border-l-4 border-teal-800 pl-3">
        {{ __('homepageIndex.left_info.quote') }}
      </blockquote>

      <div class="flex items-center gap-3">
        <img src="{{ asset('images/general-manager.jpg') }}" class="w-12 h-12 rounded-full" alt="">
        <div>
          <p class="font-semibold text-slate-800">{{ __('homepageIndex.left_info.manager_name') }}</p>
          <p class="text-sm text-slate-600">{{ __('homepageIndex.left_info.manager_title') }}</p>
        </div>
      </div>
    </div>

  </div>
@endsection
