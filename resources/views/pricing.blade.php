<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Prezzi - {{ config('app.name', 'FishTideLog') }}</title>
    <meta name="description" content="Scopri i piani e i prezzi di FishTideLog. Attualmente gratuito fino al 31 dicembre 2025.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-900 text-gray-100">
    <!-- Navigation -->
    <nav class="bg-gray-800/90 backdrop-blur-sm border-b border-gray-700 sticky top-0 z-50">
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
                    <a href="{{ route('features') }}" class="text-gray-300 hover:text-white transition-colors">Funzionalità</a>
                    <a href="{{ route('pricing') }}" class="text-blue-400 font-semibold">Prezzi</a>
                    <a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition-colors">Contatti</a>
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Accedi
                    </a>
                    <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Registrati
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-900 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                Piani <span class="text-blue-400">Semplici</span>
            </h1>
            <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
                Scegli il piano che si adatta alle tue esigenze. Attualmente tutti i piani sono gratuiti fino al 31 dicembre 2025.
            </p>
        </div>
    </section>

    <!-- Pricing Cards -->
    <section class="py-20 bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Free Plan -->
                <div class="bg-gray-700 rounded-xl p-8 border-2 border-green-500 relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-green-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                            GRATUITO
                        </span>
                    </div>
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-white mb-2">Piano Gratuito</h3>
                        <div class="text-4xl font-bold text-white mb-2">
                            €0<span class="text-lg text-gray-400">/mese</span>
                        </div>
                        <p class="text-gray-300 text-sm">Fino al 31 dicembre 2025</p>
                    </div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Uscite di pesca illimitate
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Gestione catture completa
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Punti di pesca illimitati
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Informazioni maree
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Statistiche base
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Supporto multilingua
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Mappa interattiva
                        </li>
                    </ul>

                    <a href="{{ route('register') }}" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold text-center block transition-colors">
                        Inizia Gratis
                    </a>
                </div>

                <!-- Premium Plan -->
                <div class="bg-gray-700 rounded-xl p-8 border-2 border-blue-500 relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                            PROSSIMAMENTE
                        </span>
                    </div>
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-white mb-2">Piano Premium</h3>
                        <div class="text-4xl font-bold text-white mb-2">
                            €9.99<span class="text-lg text-gray-400">/mese</span>
                        </div>
                        <p class="text-gray-300 text-sm">Disponibile dal 2026</p>
                    </div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Tutto del piano gratuito
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Statistiche avanzate
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Esportazione dati
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Backup automatico
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Supporto prioritario
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Funzionalità esclusive
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Nessuna pubblicità
                        </li>
                    </ul>

                    <button class="w-full bg-gray-600 text-gray-400 py-3 rounded-lg font-semibold text-center cursor-not-allowed">
                        Disponibile dal 2026
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Domande Frequenti
                </h2>
                <p class="text-xl text-gray-300">
                    Risposte alle domande più comuni sui nostri piani
                </p>
            </div>

            <div class="space-y-8">
                <div class="bg-gray-800 rounded-xl p-6">
                    <h3 class="text-xl font-semibold text-white mb-3">
                        Fino a quando è gratuito?
                    </h3>
                    <p class="text-gray-300">
                        FishTideLog è completamente gratuito fino al 31 dicembre 2025. Dopo quella data, introdurremo il piano premium con funzionalità aggiuntive.
                    </p>
                </div>

                <div class="bg-gray-800 rounded-xl p-6">
                    <h3 class="text-xl font-semibold text-white mb-3">
                        Posso cancellare in qualsiasi momento?
                    </h3>
                    <p class="text-gray-300">
                        Sì, puoi cancellare il tuo account in qualsiasi momento. I tuoi dati verranno eliminati definitivamente entro 30 giorni dalla cancellazione.
                    </p>
                </div>

                <div class="bg-gray-800 rounded-xl p-6">
                    <h3 class="text-xl font-semibold text-white mb-3">
                        Ci sono limiti nel piano gratuito?
                    </h3>
                    <p class="text-gray-300">
                        No, il piano gratuito include tutte le funzionalità principali senza limiti. Puoi registrare uscite, catture e punti di pesca illimitati.
                    </p>
                </div>

                <div class="bg-gray-800 rounded-xl p-6">
                    <h3 class="text-xl font-semibold text-white mb-3">
                        I miei dati sono sicuri?
                    </h3>
                    <p class="text-gray-300">
                        Assolutamente sì. Utilizziamo le migliori pratiche di sicurezza per proteggere i tuoi dati personali e le tue informazioni di pesca.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-green-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Inizia Subito Gratuitamente
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Unisciti a migliaia di pescatori che già utilizzano FishTideLog. Nessuna carta di credito richiesta.
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
                Gratuito fino al 31 dicembre 2025 • Registrazione in meno di 2 minuti
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