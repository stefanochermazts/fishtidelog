<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      class="scroll-smooth"
      x-data="{ 
        theme: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')
      }"
      x-init="
        if (theme === 'dark') {
          document.documentElement.classList.add('dark');
        } else {
          document.documentElement.classList.remove('dark');
        }
      ">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        {{-- Favicon --}}
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon.png') }}">
        
        {{-- Meta tags per accessibilità e SEO --}}
        <meta name="description" content="{{ config('app.description', 'FishTideLog - Il tuo diario di pesca digitale') }}">
        <meta name="theme-color" content="#0ea5e9" media="(prefers-color-scheme: light)">
        <meta name="theme-color" content="#0c4a6e" media="(prefers-color-scheme: dark)">
        
        {{-- Preload delle risorse critiche --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="preconnect" href="https://unpkg.com">
        
        <title>{{ config('app.name', 'FishTideLog') }} - @yield('title', 'Autenticazione')</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    
    <body class="font-sans antialiased bg-gradient-to-br from-neutral-50 to-primary-50 dark:from-neutral-900 dark:to-primary-950 transition-colors duration-200">
        {{-- Skip to content link per accessibilità --}}
        <a href="#main-content" class="skip-to-content">
            {{ __('Vai al contenuto principale') }}
        </a>
        
        <div class="min-h-screen flex flex-col">
            {{-- Header con navigazione pubblica --}}
            <nav x-data="{ open: false }" 
                 class="bg-white/90 dark:bg-neutral-800/90 backdrop-blur-sm border-b border-neutral-200 dark:border-neutral-700 shadow-soft dark:shadow-strong transition-colors duration-200 relative z-50"
                 role="navigation" 
                 aria-label="{{ __('Main navigation') }}">
                
                <!-- Primary Navigation Menu -->
                <div class="container-wide">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('home') }}" 
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
                                <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="nav-link">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                    </svg>
                                    {{ __('Home') }}
                                </x-nav-link>
                                
                                <x-nav-link :href="route('features')" :active="request()->routeIs('features')" class="nav-link">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ __('Funzionalità') }}
                                </x-nav-link>
                                
                                <x-nav-link :href="route('pricing')" :active="request()->routeIs('pricing')" class="nav-link">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
                                    </svg>
                                    {{ __('Prezzi') }}
                                </x-nav-link>
                                
                                <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="nav-link">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                    {{ __('Contatti') }}
                                </x-nav-link>
                            </div>
                        </div>

                        <!-- Settings Dropdown e Theme Toggle - Desktop -->
                        <div class="hidden lg:flex lg:items-center lg:space-x-4">
                            <!-- Language Selector -->
                            <x-public-language-selector />
                            
                            <!-- Theme Toggle -->
                            <x-public-theme-toggle />
                            
                            <!-- Auth Buttons -->
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('login') }}" class="text-sm text-neutral-600 dark:text-neutral-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">
                                    {{ __('Login') }}
                                </a>
                                <a href="{{ route('register') }}" class="btn-primary text-sm">
                                    {{ __('Registrati') }}
                                </a>
                            </div>
                        </div>

                        <!-- Mobile menu button -->
                        <div class="flex items-center lg:hidden space-x-2">
                            <!-- Language Selector Mobile -->
                            <x-public-language-selector />
                            
                            <!-- Theme Toggle Mobile -->
                            <x-public-theme-toggle />
                            
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
                        <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="nav-link">
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                            </svg>
                            {{ __('Home') }}
                        </x-responsive-nav-link>
                        
                        <x-responsive-nav-link :href="route('features')" :active="request()->routeIs('features')" class="nav-link">
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('Funzionalità') }}
                        </x-responsive-nav-link>
                        
                        <x-responsive-nav-link :href="route('pricing')" :active="request()->routeIs('pricing')" class="nav-link">
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
                            </svg>
                            {{ __('Prezzi') }}
                        </x-responsive-nav-link>
                        
                        <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="nav-link">
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            {{ __('Contatti') }}
                        </x-responsive-nav-link>
                        
                        <!-- Auth Links Mobile -->
                        <div class="pt-4 border-t border-neutral-200 dark:border-neutral-700">
                            <div class="flex flex-col space-y-2 px-4">
                                <a href="{{ route('login') }}" class="text-sm text-neutral-600 dark:text-neutral-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">
                                    {{ __('Login') }}
                                </a>
                                <a href="{{ route('register') }}" class="btn-primary text-sm text-center">
                                    {{ __('Registrati') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Main Content con ID per skip link --}}
            <main id="main-content" class="flex-1 py-6 sm:py-8" role="main">
                <div class="container-wide">
                    {{-- Flash Messages con supporto per screen readers --}}
                    @if (session('status'))
                        <div class="mb-6 animate-fade-in" role="alert" aria-live="polite">
                            <div class="bg-secondary-50 dark:bg-secondary-900/30 border border-secondary-200 dark:border-secondary-700 text-secondary-800 dark:text-secondary-200 px-4 py-3 rounded-2xl">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    {{ session('status') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 animate-fade-in" role="alert" aria-live="assertive">
                            <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 text-red-800 dark:text-red-200 px-4 py-3 rounded-2xl">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ session('error') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Auth Content --}}
                    <div class="flex justify-center">
                        <div class="w-full sm:max-w-md">
                            <div class="bg-white dark:bg-neutral-800 shadow-soft dark:shadow-strong rounded-2xl overflow-hidden">
                                <div class="p-6 sm:p-8">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
            {{-- Footer con supporto per tema scuro --}}
            <footer class="bg-white/80 dark:bg-neutral-800/80 backdrop-blur-sm border-t border-neutral-200 dark:border-neutral-700 transition-colors duration-200" role="contentinfo">
                <div class="container-wide py-6">
                    <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                        <div class="text-sm text-neutral-600 dark:text-neutral-400">
                            &copy; {{ date('Y') }} {{ config('app.name', 'FishTideLog') }}. {{ __('Tutti i diritti riservati') }}
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('contact') }}" class="text-sm text-neutral-600 dark:text-neutral-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">
                                {{ __('Contatti') }}
                            </a>
                            <span class="text-neutral-400 dark:text-neutral-600">|</span>
                            <a href="#" class="text-sm text-neutral-600 dark:text-neutral-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">
                                {{ __('Privacy') }}
                            </a>
                            <span class="text-neutral-400 dark:text-neutral-600">|</span>
                            <a href="#" class="text-sm text-neutral-600 dark:text-neutral-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">
                                {{ __('Termini') }}
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        
        {{-- Stack per script aggiuntivi --}}
        @stack('scripts')
    </body>
</html> 