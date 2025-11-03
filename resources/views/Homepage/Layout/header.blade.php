<nav class="bg-teal-1001">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    @auth
      <a href="{{ route('homepage') }}" class="flex ms-2 md:me-4">
        <img src="{{ asset('images/Logo.png') }}" class="h-8 me-3" alt="FlowBite Logo" />
        <span
          class="self-center text-xl text-gold font-semibold sm:text-2xl whitespace-nowrap">{{ __('general.brand_name') }}</span>
      </a>
    @endauth
    <div class="flex items-center md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse">
      <!-- Tombol Utama di Navbar -->
      <button id="language-toggle-btn" data-locale="{{ app()->getLocale() }}" type="button"
        data-dropdown-toggle="language-dropdown-menu"
        class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-gold rounded-lg cursor-pointer hover:bg-teal-1000">
        <i class="w-5 h-5 rounded-full me-3"><span class="fi"></span></i>
        <span id="language-label" class="hidden sm:inline"></span>
      </button>

      <!-- Dropdown Menu -->
      <div class="z-50 hidden my-4 text-base list-none bg-teal-1001 divide-y divide-gray-100 rounded-lg shadow-2xl"
        id="language-dropdown-menu">
        <ul class="py-2 font-medium" role="none">
          <li>
            <button onclick="changeLanguage('en')"
              class="w-full text-left block px-4 py-2 text-sm text-gold hover:bg-teal-1000" role="menuitem"
              data-locale-option="en">
              <div class="inline-flex items-center">
                <span class="fi fi-us h-3.5 w-3.5 rounded-full me-2"></span>
                {{ __('general.language.en') }}
              </div>
            </button>
          </li>
          <li>
            <button onclick="changeLanguage('id')"
              class="w-full text-left block px-4 py-2 text-sm text-gold hover:bg-teal-1000" role="menuitem"
              data-locale-option="id">
              <div class="inline-flex items-center">
                <span class="fi fi-id h-3.5 w-3.5 rounded-full me-2"></span>
                {{ __('general.language.id') }}
              </div>
            </button>
          </li>
          <li>
            <button onclick="changeLanguage('ja')"
              class="w-full text-left block px-4 py-2 text-sm text-gold hover:bg-teal-1000" role="menuitem"
              data-locale-option="ja">
              <div class="inline-flex items-center">
                <span class="fi fi-jp h-3.5 w-3.5 rounded-full me-2"></span>
                {{ __('general.language.ja') }}
              </div>
            </button>
          </li>
          <li>
            <button onclick="changeLanguage('km')"
              class="w-full text-left block px-4 py-2 text-sm text-gold hover:bg-teal-1000" role="menuitem"
              data-locale-option="km">
              <div class="inline-flex items-center">
                <span class="fi fi-kh h-3.5 w-3.5 rounded-full me-2"></span>
                {{ __('general.language.km') }}
              </div>
            </button>
          </li>
          <li>
            <button onclick="changeLanguage('my')"
              class="w-full text-left block px-4 py-2 text-sm text-gold hover:bg-teal-1000" role="menuitem"
              data-locale-option="my">
              <div class="inline-flex items-center">
                <span class="fi fi-mm h-3.5 w-3.5 rounded-full me-2"></span>
                {{ __('general.language.my') }}
              </div>
            </button>
          </li>
          <li>
            <button onclick="changeLanguage('vi')"
              class="w-full text-left block px-4 py-2 text-sm text-gold hover:bg-teal-1000" role="menuitem"
              data-locale-option="vi">
              <div class="inline-flex items-center">
                <span class="fi fi-vn h-3.5 w-3.5 rounded-full me-2"></span>
                {{ __('general.language.vi') }}
              </div>
            </button>
          </li>
        </ul>
      </div>
      <button data-collapse-toggle="navbar-language" type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
        aria-controls="navbar-language" aria-expanded="false">
        <span class="sr-only">{{ __('HomepageLayout.open_main_menu') }}</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M1 1h15M1 7h15M1 13h15" />
        </svg>
      </button>
    </div>
    @auth
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-language">
        <ul
          class="flex flex-col font-medium p-4 md:p-0 mt-4 rounded-lg bg-teal-1001 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-teal-1001">
          <li>
            <a href="{{ route('homepage') }}"
              class="block py-2 px-3 text-gold rounded-sm hover:bg-teal-1000 md:hover:text-white">{{ __('HomepageLayout.header.menu.homepage') }}</a>
          </li>
          @can('cleaning')
            <li>
              <a href="{{ route('cleaning') }}"
                class="block py-2 px-3 text-gold rounded-sm hover:bg-teal-1000 md:hover:text-white ">{{ __('HomepageLayout.header.menu.cleaning') }}</a>
            </li>
          @endcan
          @can('checker')
            <li>
              <a href="{{ route('checker') }}"
                class="block py-2 px-3 text-gold rounded-sm hover:bg-teal-1000 md:hover:text-white ">{{ __('HomepageLayout.header.menu.checker') }}</a>
            </li>
          @endcan
          @can('office')
            <li>
              <a href="{{ route('office') }}"
                class="block py-2 px-3 text-gold rounded-sm hover:bg-teal-1000 md:hover:text-white ">{{ __('HomepageLayout.header.menu.office') }}</a>
            </li>
          @endcan
          @can('admin')
            <li>
              <a href="{{ route('dashboard') }}"
                class="block py-2 px-3 text-gold rounded-sm hover:bg-teal-1000 md:hover:text-white ">{{ __('HomepageLayout.header.menu.dashboard') }}</a>
            </li>
          @endcan
          @can('FO')
            <li>
              <a href="{{ route('lostitem.index') }}"
                class="block py-2 px-3 text-gold rounded-sm hover:bg-teal-1000 md:hover:text-white ">{{ __('HomepageLayout.header.menu.lostfound') }}</a>
            </li>
          @endcan
          <li>
            <a href="{{ route('userprofile') }}"
              class="block py-2 px-3 text-gold rounded-sm hover:bg-teal-1000 md:hover:text-white">{{ __('HomepageLayout.header.menu.profile') }}</a>
          </li>
        </ul>
      </div>
    @else
      <a href="{{ route('homepage') }}" class="flex ms-2 md:me-24">
        <img src="{{ asset('images/Logo.png') }}" class="h-8 me-3" alt="FlowBite Logo" />
        <span
          class="self-center text-xl text-gold font-semibold sm:text-2xl whitespace-nowrap">{{ __('general.brand_name') }}</span>
      </a>
    @endauth
  </div>
</nav>
