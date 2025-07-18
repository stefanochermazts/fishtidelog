{{-- Navigation con supporto per tema scuro, accessibilità e design mobile-first --}}
<nav x-data="{ open: false, dropdownOpen: false }" 
     class="bg-white/90 dark:bg-neutral-800/90 backdrop-blur-sm border-b border-neutral-200 dark:border-neutral-700 shadow-soft dark:shadow-strong transition-colors duration-200 relative z-50"
     role="navigation" 
     aria-label="{{ __('Main navigation') }}">
    
    <!-- Primary Navigation Menu -->
    <div class="container-wide">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center space-x-3 group"
                       aria-label="{{ config('app.name', 'FishTideLog') }} - {{ __('Home') }}">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-2xl flex items-center justify-center shadow-soft group-hover:shadow-medium transition-all duration-200">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-neutral-900 dark:text-neutral-100 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors duration-200">
                            {{ config('app.name', 'FishTideLog') }}
                        </span>
                    </a>
                </div>

                <!-- Navigation Links - Desktop -->
                <div class="hidden lg:flex space-x-1 ml-8">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-link">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('fishing-trips.index')" :active="request()->routeIs('fishing-trips.*')" class="nav-link">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ __('Uscite') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('fishing-spots.index')" :active="request()->routeIs('fishing-spots.*')" class="nav-link">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        {{ __('Punti Pesca') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('catches.index')" :active="request()->routeIs('catches.*')" class="nav-link">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ __('Le Mie Catture') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('map')" :active="request()->routeIs('map')" class="nav-link">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ __('Mappa') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('statistics')" :active="request()->routeIs('statistics')" class="nav-link">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                        {{ __('Statistiche') }}
                    </x-nav-link>
                    
                    @if(Auth::user()->isAdmin())
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')" class="nav-link">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Amministrazione') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown e Theme Toggle - Desktop -->
            <div class="hidden lg:flex lg:items-center lg:space-x-4">
                <!-- Language Selector -->
                <x-language-selector />
                
                <!-- Theme Toggle -->
                <x-theme-toggle />
                
                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" 
                            @keydown.escape="open = false"
                            @click.away="open = false"
                            class="inline-flex items-center px-4 py-2 border border-neutral-300 dark:border-neutral-600 text-sm leading-4 font-medium rounded-xl text-neutral-700 dark:text-neutral-300 bg-white dark:bg-neutral-800 hover:text-neutral-900 dark:hover:text-neutral-100 hover:bg-neutral-50 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200"
                            aria-expanded="false"
                            aria-haspopup="true"
                            aria-label="{{ __('User menu') }}">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-full flex items-center justify-center">
                                <span class="text-sm font-medium text-white">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </span>
                            </div>
                            <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white dark:bg-neutral-800 rounded-2xl shadow-strong border border-neutral-200 dark:border-neutral-700 py-1 z-[9999]"
                         role="menu"
                         aria-orientation="vertical"
                         aria-labelledby="user-menu">
                        
                        <x-dropdown-link :href="route('profile.edit')" class="nav-link" role="menuitem">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            {{ __('Profilo') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" role="none">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="nav-link"
                                    role="menuitem">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Logout') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center lg:hidden space-x-2">
                <!-- Language Selector Mobile -->
                <x-language-selector />
                
                <!-- Theme Toggle Mobile -->
                <x-theme-toggle />
                
                <button @click="open = !open" 
                        @keydown.escape="open = false"
                        class="inline-flex items-center justify-center p-2 rounded-xl text-neutral-400 hover:text-neutral-500 hover:bg-neutral-100 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200"
                        aria-expanded="false"
                        aria-label="{{ __('Toggle navigation menu') }}">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" 
         class="hidden lg:hidden animate-slide-up"
         role="navigation"
         aria-label="{{ __('Mobile navigation') }}">
        
        <div class="pt-2 pb-3 space-y-1 bg-white dark:bg-neutral-800 border-t border-neutral-200 dark:border-neutral-700">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-link">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                </svg>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('fishing-trips.index')" :active="request()->routeIs('fishing-trips.*')" class="nav-link">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ __('Uscite') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('fishing-spots.index')" :active="request()->routeIs('fishing-spots.*')" class="nav-link">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                {{ __('Punti Pesca') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('catches.index')" :active="request()->routeIs('catches.*')" class="nav-link">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ __('Le Mie Catture') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('map')" :active="request()->routeIs('map')" class="nav-link">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ __('Mappa') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('statistics')" :active="request()->routeIs('statistics')" class="nav-link">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                </svg>
                {{ __('Statistiche') }}
            </x-responsive-nav-link>
            
            @if(Auth::user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')" class="nav-link">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                    </svg>
                    {{ __('Amministrazione') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800">
            <div class="px-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-full flex items-center justify-center">
                        <span class="text-sm font-medium text-white">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </span>
                    </div>
                    <div>
                        <div class="font-medium text-base text-neutral-900 dark:text-neutral-100">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-neutral-500 dark:text-neutral-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="nav-link">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Profilo') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="nav-link">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
