<nav class="fixed top-0 z-50 w-full bg-teal-1001 border-b border-gray-200 py-2">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-teal-1000 rounded-lg sm:hidden hover:bg-teal-1000 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-200">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <a href="{{ route('homepage') }}" class="flex ms-2 md:me-24">
          <img src="{{ asset('images/Logo.png') }}" class="h-8 me-3" alt="FlowBite Logo" />
          <span class="self-center text-xl text-white font-semibold sm:text-2xl whitespace-nowrap">{{ __('general.brand_name') }}</span>
        </a>
      </div>
      <div class="flex items-center gap-4">
          <div class="flex items-center ms-3">
              <p class="text-white hidden md:block md:text-base font-semibold text-2xl me-4">Welcome,  {{ Auth::user()->nama }}</p>
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">{{ __('DashboardLayout.open_main_menu') }}</span>
                <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('images/user-profile.png') }}" alt="user photo">
              </button>
            </div>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm" id="dropdown-user">
              <ul class="py-1" role="none">
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-teal-1001 hover:bg-teal-1001 hover:text-white" role="menuitem">Homepage</a>
                </li>
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-teal-1001 hover:bg-teal-1001 hover:text-white" role="menuitem">Profile</a>
                </li>
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-teal-1001 hover:bg-red-400 hover:text-white" role="menuitem">Sign out</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="flex items-center md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse">
            <!-- Tombol Utama di Navbar -->
            <button id="language-toggle-btn"
              data-locale="{{ app()->getLocale() }}"
              type="button"
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
                  <button onclick="changeLanguage('en')" class="w-full text-left block px-4 py-2 text-sm text-gold hover:bg-teal-1000" role="menuitem" data-locale-option="en">
                    <div class="inline-flex items-center">
                      <span class="fi fi-us h-3.5 w-3.5 rounded-full me-2"></span>
                      {{ __('general.language.en') }}
                    </div>
                  </button>
                </li>
                <li>
                  <button onclick="changeLanguage('id')" class="w-full text-left block px-4 py-2 text-sm text-gold hover:bg-teal-1000" role="menuitem" data-locale-option="id">
                    <div class="inline-flex items-center">
                      <span class="fi fi-id h-3.5 w-3.5 rounded-full me-2"></span>
                      {{ __('general.language.id') }}
                    </div>
                  </button>
                </li>
                <li>
                  <button onclick="changeLanguage('ja')" class="w-full text-left block px-4 py-2 text-sm text-gold hover:bg-teal-1000" role="menuitem" data-locale-option="ja">
                    <div class="inline-flex items-center">
                      <span class="fi fi-jp h-3.5 w-3.5 rounded-full me-2"></span>
                      {{ __('general.language.ja') }}
                    </div>
                  </button>
                </li>
                <li>
                  <button onclick="changeLanguage('km')" class="w-full text-left block px-4 py-2 text-sm text-gold hover:bg-teal-1000" role="menuitem" data-locale-option="km">
                    <div class="inline-flex items-center">
                      <span class="fi fi-kh h-3.5 w-3.5 rounded-full me-2"></span>
                      {{ __('general.language.km') }}
                    </div>
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </div>
  </div>
</nav>