<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FishTideLog') }} - Il tuo diario di pesca digitale</title>
    <meta name="description" content="Registra le tue uscite di pesca, gestisci i punti di pesca e consulta le maree. La piattaforma completa per i pescatori.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-900 dark:bg-gray-900 text-gray-100 dark:text-gray-100" 
      x-data="{}" 
      x-init="
        // Initialize theme from localStorage
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
      ">
    <!-- Navigation -->
    <nav class="bg-gray-800/90 dark:bg-gray-800/90 backdrop-blur-sm border-b border-gray-700 dark:border-gray-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-green-500 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white group-hover:text-blue-400 transition-colors">
                            {{ config('app.name', 'FishTideLog') }}
                        </span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('features') }}" class="text-gray-300 dark:text-gray-300 hover:text-white dark:hover:text-white transition-colors">{{ __('features') }}</a>
                    <a href="{{ route('pricing') }}" class="text-gray-300 dark:text-gray-300 hover:text-white dark:hover:text-white transition-colors">{{ __('pricing') }}</a>
                    <a href="{{ route('contact') }}" class="text-gray-300 dark:text-gray-300 hover:text-white dark:hover:text-white transition-colors">{{ __('contact') }}</a>
                    
                    <!-- Language and Theme Controls -->
                    <div class="flex items-center space-x-2">
                        <x-public-language-selector />
                        <x-public-theme-toggle />
                    </div>
                    
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                        {{ __('login') }}
                    </a>
                    <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                        {{ __('register') }}
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="text-gray-300 hover:text-white p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-gray-900 via-blue-900 to-gray-900 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    {{ __('home_hero_title') }}
                </h1>
                <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
                    {{ __('home_hero_subtitle') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                        {{ __('start_free') }}
                    </a>
                    <a href="{{ route('features') }}" class="border border-gray-600 text-gray-300 hover:text-white hover:border-gray-500 px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                        {{ __('discover_features') }}
                    </a>
                </div>
                <p class="text-sm text-gray-400 mt-4">
                    {{ __('free_until') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Funzionalità Principali
                </h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Tutto quello che ti serve per gestire le tue attività di pesca
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Uscite di Pesca -->
                <div class="bg-gray-700 rounded-xl p-6 hover:bg-gray-600 transition-colors">
                    <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m-6 3l6-3"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Uscite di Pesca</h3>
                    <p class="text-gray-300">
                        Registra ogni uscita con dettagli completi: data, ora, località, condizioni meteo e maree.
                    </p>
                </div>

                <!-- Catture -->
                <div class="bg-gray-700 rounded-xl p-6 hover:bg-gray-600 transition-colors">
                    <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Gestione Catture</h3>
                    <p class="text-gray-300">
                        Documenta ogni cattura con specie, peso, lunghezza, tecnica utilizzata e foto.
                    </p>
                </div>

                <!-- Punti di Pesca -->
                <div class="bg-gray-700 rounded-xl p-6 hover:bg-gray-600 transition-colors">
                    <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Punti di Pesca</h3>
                    <p class="text-gray-300">
                        Salva i tuoi spot preferiti con coordinate GPS, foto e note personali.
                    </p>
                </div>

                <!-- Maree -->
                <div class="bg-gray-700 rounded-xl p-6 hover:bg-gray-600 transition-colors">
                    <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Informazioni Maree</h3>
                    <p class="text-gray-300">
                        Consulta le maree in tempo reale per qualsiasi località costiera.
                    </p>
                </div>

                <!-- Statistiche -->
                <div class="bg-gray-700 rounded-xl p-6 hover:bg-gray-600 transition-colors">
                    <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Statistiche Avanzate</h3>
                    <p class="text-gray-300">
                        Analizza le tue performance con grafici e statistiche dettagliate.
                    </p>
                </div>

                <!-- Mappa -->
                <div class="bg-gray-700 rounded-xl p-6 hover:bg-gray-600 transition-colors">
                    <div class="w-12 h-12 bg-indigo-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Mappa Interattiva</h3>
                    <p class="text-gray-300">
                        Visualizza i tuoi punti di pesca e uscite su una mappa interattiva.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    La Piattaforma in Numeri
                </h2>
                <p class="text-xl text-gray-300">
                    Scopri l'attività della nostra community di pescatori
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-blue-400 mb-2">{{ number_format($stats['total_users']) }}</div>
                    <div class="text-gray-300">Pescatori Registrati</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-green-400 mb-2">{{ number_format($stats['total_trips']) }}</div>
                    <div class="text-gray-300">Uscite Registrate</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-yellow-400 mb-2">{{ number_format($stats['total_catches']) }}</div>
                    <div class="text-gray-300">Catture Documentate</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-purple-400 mb-2">{{ number_format($stats['total_weight'], 1) }} kg</div>
                    <div class="text-gray-300">Peso Totale Pesato</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-green-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Inizia a Registrare le Tue Avventure di Pesca
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Unisciti a migliaia di pescatori che già utilizzano FishTideLog per documentare le loro esperienze.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                    Registrati Ora
                </a>
                <a href="{{ route('login') }}" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                    Accedi
                </a>
            </div>
            <p class="text-sm text-blue-200 mt-4">
                Gratuito fino al 31 dicembre 2025 • Nessuna carta di credito richiesta
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-lg font-bold text-white">{{ config('app.name', 'FishTideLog') }}</span>
                    </div>
                    <p class="text-gray-300">
                        La piattaforma completa per i pescatori che vogliono documentare e analizzare le loro esperienze.
                    </p>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-4">Prodotto</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('features') }}" class="text-gray-300 hover:text-white transition-colors">Funzionalità</a></li>
                        <li><a href="{{ route('pricing') }}" class="text-gray-300 hover:text-white transition-colors">Prezzi</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">API</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-4">Supporto</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition-colors">Contatti</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Documentazione</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-4">Legale</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Privacy</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Termini</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Cookie</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    © {{ date('Y') }} {{ config('app.name', 'FishTideLog') }}. Tutti i diritti riservati.
                </p>
            </div>
        </div>
    </footer>
</body>
</html> 