<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      class="scroll-smooth"
      x-data="{ theme: localStorage.getItem('theme') || 'light' }"
      x-init="
        theme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        if (theme === 'dark') document.documentElement.classList.add('dark');
      ">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        {{-- Meta tags per accessibilità e SEO --}}
        <meta name="description" content="{{ config('app.description', 'FishTideLog - Il tuo diario di pesca digitale') }}">
        <meta name="theme-color" content="#0ea5e9" media="(prefers-color-scheme: light)">
        <meta name="theme-color" content="#0c4a6e" media="(prefers-color-scheme: dark)">
        
        {{-- Preload delle risorse critiche --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="preconnect" href="https://unpkg.com">
        
        <title>{{ config('app.name', 'FishTideLog') }} - @yield('title', 'Il tuo diario di pesca')</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
              integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
              crossorigin=""/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
                integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" 
                crossorigin=""></script>
                
        {{-- Livewire Styles --}}
        @livewireStyles
    </head>
    
    <body class="font-sans antialiased bg-gradient-to-br from-neutral-50 to-primary-50 dark:from-neutral-900 dark:to-primary-950 transition-colors duration-200">
        {{-- Skip to content link per accessibilità --}}
        <a href="#main-content" class="skip-to-content">
            {{ __('Vai al contenuto principale') }}
        </a>
        
        <div class="min-h-screen flex flex-col">
            {{-- Header con navigazione --}}
            @include('layouts.navigation')

            {{-- Page Heading con supporto per tema scuro --}}
            @isset($header)
                <header class="bg-white/80 dark:bg-neutral-800/80 backdrop-blur-sm shadow-soft dark:shadow-strong border-b border-neutral-200 dark:border-neutral-700 transition-colors duration-200">
                    <div class="container-wide py-4 sm:py-6">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Main Content con ID per skip link --}}
            <main id="main-content" class="flex-1 py-6 sm:py-8" role="main">
                <div class="container-wide">
                    {{-- Flash Messages con supporto per screen readers --}}
                    @if (session('success'))
                        <div class="mb-6 animate-fade-in" role="alert" aria-live="polite">
                            <div class="bg-secondary-50 dark:bg-secondary-900/30 border border-secondary-200 dark:border-secondary-700 text-secondary-800 dark:text-secondary-200 px-4 py-3 rounded-2xl">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    {{ session('success') }}
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

                    @if (session('warning'))
                        <div class="mb-6 animate-fade-in" role="alert" aria-live="polite">
                            <div class="bg-accent-50 dark:bg-accent-900/30 border border-accent-200 dark:border-accent-700 text-accent-800 dark:text-accent-200 px-4 py-3 rounded-2xl">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ session('warning') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Page Content --}}
                    @isset($slot)
                        {{ $slot }}
                    @else
                        @yield('content')
                    @endisset
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
                            <a href="{{ route('profile.edit') }}" class="text-sm text-neutral-600 dark:text-neutral-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">
                                {{ __('Impostazioni') }}
                            </a>
                            <span class="text-neutral-400 dark:text-neutral-600">|</span>
                            <a href="#" class="text-sm text-neutral-600 dark:text-neutral-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">
                                {{ __('Aiuto') }}
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        
        {{-- Livewire Scripts --}}
        @livewireScripts
        
        {{-- Stack per script aggiuntivi --}}
        @stack('scripts')
        
        {{-- Script per inizializzazione tema --}}
        <script>
            // Inizializzazione tema al caricamento della pagina
            document.addEventListener('DOMContentLoaded', function() {
                const theme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                }
            });
        </script>
    </body>
</html>
