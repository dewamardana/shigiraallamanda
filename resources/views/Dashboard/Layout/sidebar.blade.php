<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
      <ul class="space-y-2 font-medium">
        <li>
            <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-teal-1000 hover:text-white {{ request()->routeIs(['dashboard', 'cleaningdata', 'checkerdata','userpoint','Cleaninghistorydata', 'CheckOfficeHistoryData']) ? 'bg-teal-1001 text-white' : '' }}" aria-controls="dropdown_data" data-collapse-toggle="dropdown_data">
                    <i data-feather="file-text" class="text-accent-1000"></i>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ __('layoutMessage.sidebar_data') }}</span>
                    <i data-feather="chevron-down"></i>
            </button>
            <ul id="dropdown_data" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-teal-1000 hover:text-white {{ Request::is('dashboard') ? 'bg-teal-1001 text-white' : '' }}">{{ __('layoutMessage.sidebar_analysis') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('cleaningdata') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-teal-1000 hover:text-white {{ Request::is('dashboard/cleaningdata') ? 'bg-teal-1001 text-white' : '' }}">{{ __('layoutMessage.sidebar_cleanning') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('checkerdata') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-teal-1000 hover:text-white {{ Request::is('dashboard/checker') ? 'bg-teal-1001 text-white' : '' }}">{{ __('layoutMessage.sidebar_datacheck') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('userpoint') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-teal-1000 hover:text-white {{ Request::is('dashboard/userpoint') ? 'bg-teal-1001 text-white' : '' }}">{{ __('layoutMessage.sidebar_user') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('Cleaninghistorydata') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-teal-1000 hover:text-white {{ Request::is('dashboard/cleaninghistorydata') ? 'bg-teal-1001 text-white' : '' }}">{{ __('layoutMessage.sidebar_cleaning_history') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('CheckOfficeHistoryData') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-teal-1000 hover:text-white {{ request()->routeIs('CheckOfficeHistoryData') ? 'bg-teal-1001 text-white' : '' }}">{{ __('layoutMessage.sidebar_checker_history') }}</a>
                    </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('user.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-teal-1000 hover:text-white {{ request()->routeIs('user.*') ? 'bg-teal-1001 text-white' : '' }}">
               <i data-feather="users" class="text-accent-1000"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">{{ __('layoutMessage.sidebar_workers') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('building.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-teal-1000 hover:text-white {{ request()->routeIs('building.*') ? 'bg-teal-1001 text-white' : '' }}">
               <i data-feather="home" class="text-accent-1000"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">{{ __('layoutMessage.sidebar_building') }}</span>
            </a>
        </li>
        <li>  
        <li>
            <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-teal-1000 hover:text-white {{ request()->routeIs(['formula.*','formulaCheck.*']) ? 'bg-teal-1001 text-white' : '' }}" aria-controls="dropdown-formula" data-collapse-toggle="dropdown-formula">
                   <i data-feather="thermometer" class="text-accent-1000"></i>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ __('layoutMessage.sidebar_formula') }}</span>
                    <i data-feather="chevron-down"></i>
            </button>
            <ul id="dropdown-formula" class="hidden py-2 space-y-2">
                <li>
                    <a href="{{ route('formula.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-teal-1000 hover:text-white {{ request()->routeIs('formula.*') ? 'bg-teal-1001 text-white' : '' }}">{{ __('layoutMessage.sidebar_formulabuilding') }}</a>
                </li>
                <li>
                    <a href="{{ route('formulaCheck.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-teal-1000 hover:text-white {{ request()->routeIs('formulaCheck.*') ? 'bg-teal-1001 text-white' : '' }}">{{ __('layoutMessage.sidebar_formulacheck') }}</a>
                </li>
            </ul>
        </li>
         <li>
            <a href="{{ route('task-groups.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-teal-1000 hover:text-white {{ request()->routeIs('task-groups.*','tasks.*') ? 'bg-teal-1001 text-white' : '' }}">
               <i data-feather="briefcase" class="text-accent-1000"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Office Task</span>
            </a>
         </li>
         <li>
            <a href="{{ route('reportData') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-teal-1000 hover:text-white {{ request()->routeIs('reportData.*') ? 'bg-teal-1001 text-white' : '' }}">
               <i data-feather="alert-triangle" class="text-accent-1000"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Report Data</span>
            </a>
         </li>
         <li>
            <a href="{{ route('settings.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-teal-1000 hover:text-white {{ request()->routeIs('reportData.*') ? 'bg-teal-1001 text-white' : '' }}">
               <i data-feather="settings" class="text-accent-1000"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Settings Value</span>
            </a>
         </li>
      </ul>
   </div>
</aside>