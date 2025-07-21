<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('pricing') }} - {{ config('app.name', 'FishTideLog') }}</title>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-200" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches) }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val)); $nextTick(() => { if (darkMode) document.documentElement.classList.add('dark'); else document.documentElement.classList.remove('dark'); })" :class="{ 'dark': darkMode }">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-lg" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900 dark:text-white">{{ config('app.name', 'FishTideLog') }}</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">{{ __('home') }}</a>
                    <a href="{{ route('features') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">{{ __('features') }}</a>
                    <a href="{{ route('pricing') }}" class="text-blue-600 dark:text-blue-400 font-semibold">{{ __('pricing') }}</a>
                    <a href="{{ route('contact') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">{{ __('contact') }}</a>
                    
                    <!-- Language Selector -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-1 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                            <span>{{ __('language') }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-md shadow-lg z-50">
                            <a href="{{ route('locale.change', 'it') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Italiano</a>
                            <a href="{{ route('locale.change', 'en') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">English</a>
                            <a href="{{ route('locale.change', 'de') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Deutsch</a>
                            <a href="{{ route('locale.change', 'fr') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Français</a>
                        </div>
                    </div>

                    <!-- Theme Toggle -->
                    <button @click="darkMode = !darkMode; $nextTick(() => { if (darkMode) document.documentElement.classList.add('dark'); else document.documentElement.classList.remove('dark'); })" class="p-2 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">{{ __('login') }}</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">{{ __('register') }}</a>
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden flex items-center">
                    <button @click="open = !open" 
                            @keydown.escape="open = false"
                            class="inline-flex items-center justify-center p-2 rounded-xl text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200"
                            :aria-expanded="open"
                            aria-label="{{ __('Toggle navigation menu') }}">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/50 z-40 lg:hidden"
             @click="open = false">
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="lg:hidden fixed top-16 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 shadow-lg z-50 max-h-[calc(100vh-4rem)] overflow-y-auto"
             role="navigation"
             aria-label="{{ __('Mobile navigation') }}"
             @click.away="open = false">
            
            <div class="px-4 py-6 space-y-4">
                <!-- Mobile Navigation Links -->
                <a href="{{ route('home') }}" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors py-2">{{ __('home') }}</a>
                <a href="{{ route('features') }}" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors py-2">{{ __('features') }}</a>
                <a href="{{ route('pricing') }}" class="block text-blue-600 dark:text-blue-400 font-semibold py-2">{{ __('pricing') }}</a>
                <a href="{{ route('contact') }}" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors py-2">{{ __('contact') }}</a>
                
                <!-- Mobile Language Selector -->
                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('language') }}</label>
                    <div class="relative">
                        <select onchange="window.location.href=this.value" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="{{ route('locale.change', 'it') }}" {{ app()->getLocale() == 'it' ? 'selected' : '' }}>🇮🇹 Italiano</option>
                            <option value="{{ route('locale.change', 'en') }}" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>🇬🇧 English</option>
                            <option value="{{ route('locale.change', 'de') }}" {{ app()->getLocale() == 'de' ? 'selected' : '' }}>🇩🇪 Deutsch</option>
                            <option value="{{ route('locale.change', 'fr') }}" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>🇫🇷 Français</option>
                        </select>
                    </div>
                </div>

                <!-- Mobile Theme Toggle -->
                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button @click="darkMode = !darkMode; $nextTick(() => { if (darkMode) document.documentElement.classList.add('dark'); else document.documentElement.classList.remove('dark'); })" class="flex items-center justify-between w-full text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors py-2">
                        <span>{{ __('theme') }}</span>
                        <svg x-show="!darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>

                <!-- Mobile Auth Links -->
                <div class="pt-4 border-t border-gray-200 dark:border-gray-700 space-y-2">
                    <a href="{{ route('login') }}" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors py-2">{{ __('login') }}</a>
                    <a href="{{ route('register') }}" class="block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors text-center">{{ __('register') }}</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 via-blue-50 to-gray-50 dark:from-gray-900 dark:via-blue-900 dark:to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                {{ __('pricing_title') }}
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                {{ __('pricing_subtitle') }}
            </p>
        </div>
    </section>

    <!-- Pricing Cards -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Free Plan -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-8 border-2 border-green-500 relative shadow-lg">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-green-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                            {{ __('free') }}
                        </span>
                    </div>
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('free_plan') }}</h3>
                        <div class="text-4xl font-bold text-gray-900 dark:text-white mb-2">
                            €0<span class="text-lg text-gray-500 dark:text-gray-400">/{{ __('month') }}</span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">{{ __('until_dec_2025') }}</p>
                    </div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('unlimited_trips') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('complete_catch_management') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('unlimited_spots') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('tide_information') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('basic_statistics') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('multilingual_support') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('interactive_map') }}</span>
                        </li>
                    </ul>

                    <a href="{{ route('register') }}" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold text-center block transition-colors">
                        {{ __('start_free') }}
                    </a>
                </div>

                <!-- Premium Plan -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-8 border-2 border-blue-500 relative shadow-lg">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                            {{ __('coming_soon') }}
                        </span>
                    </div>
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('premium_plan') }}</h3>
                        <div class="text-4xl font-bold text-gray-900 dark:text-white mb-2">
                            €9.99<span class="text-lg text-gray-500 dark:text-gray-400">/{{ __('month') }}</span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">{{ __('available_2026') }}</p>
                    </div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('everything_free_plan') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('advanced_statistics') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('data_export') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('automatic_backup') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('priority_support') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('exclusive_features') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('no_ads') }}</span>
                        </li>
                    </ul>

                    <button class="w-full bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 py-3 rounded-lg font-semibold text-center cursor-not-allowed">
                        {{ __('available_2026') }}
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    {{ __('faq_title') }}
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">
                    {{ __('faq_subtitle') }}
                </p>
            </div>

            <div class="space-y-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                        {{ __('faq_1_question') }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('faq_1_answer') }}
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                        {{ __('faq_2_question') }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('faq_2_answer') }}
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                        {{ __('faq_3_question') }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('faq_3_answer') }}
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                        {{ __('faq_4_question') }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('faq_4_answer') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-green-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                {{ __('start_free_now') }}
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                {{ __('join_thousands_fishers') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                    {{ __('register_now') }}
                </a>
                <a href="{{ route('login') }}" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                    {{ __('login') }}
                </a>
            </div>
            <p class="text-sm text-blue-200 mt-4">
                {{ __('free_until_2025') }} • {{ __('registration_2_minutes') }}
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-lg font-bold text-gray-900 dark:text-white">{{ config('app.name', 'FishTideLog') }}</span>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('footer_description') }}
                    </p>
                </div>

                <div>
                    <h3 class="text-gray-900 dark:text-white font-semibold mb-4">{{ __('product') }}</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('features') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">{{ __('features') }}</a></li>
                        <li><a href="{{ route('pricing') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">{{ __('pricing') }}</a></li>
                        <li><a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">API</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-gray-900 dark:text-white font-semibold mb-4">{{ __('support') }}</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('contact') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">{{ __('contact') }}</a></li>
                        <li><a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">{{ __('documentation') }}</a></li>
                        <li><a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-gray-900 dark:text-white font-semibold mb-4">{{ __('legal') }}</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">{{ __('privacy') }}</a></li>
                        <li><a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">{{ __('terms') }}</a></li>
                        <li><a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">{{ __('cookies') }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-300 dark:border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-500 dark:text-gray-400">
                    © {{ date('Y') }} {{ config('app.name', 'FishTideLog') }}. {{ __('all_rights_reserved') }}.
                </p>
            </div>
        </div>
    </footer>
</body>
</html> 