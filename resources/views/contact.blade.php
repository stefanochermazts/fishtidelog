<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Contatti - {{ config('app.name', 'FishTideLog') }}</title>
    <meta name="description" content="Contattaci per supporto, suggerimenti o collaborazioni. Siamo qui per aiutarti.">

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
                    <a href="{{ route('pricing') }}" class="text-gray-300 hover:text-white transition-colors">Prezzi</a>
                    <a href="{{ route('contact') }}" class="text-blue-400 font-semibold">Contatti</a>
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
                Contattaci
            </h1>
            <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
                Hai domande, suggerimenti o bisogno di supporto? Siamo qui per aiutarti.
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-gray-700 rounded-xl p-8">
                    <h2 class="text-2xl font-bold text-white mb-6">Invia un Messaggio</h2>
                    
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-300 mb-2">
                                    Nome
                                </label>
                                <input type="text" id="first_name" name="first_name" 
                                    class="w-full px-4 py-3 bg-gray-600 border border-gray-500 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-300 mb-2">
                                    Cognome
                                </label>
                                <input type="text" id="last_name" name="last_name" 
                                    class="w-full px-4 py-3 bg-gray-600 border border-gray-500 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                                Email
                            </label>
                            <input type="email" id="email" name="email" 
                                class="w-full px-4 py-3 bg-gray-600 border border-gray-500 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-300 mb-2">
                                Oggetto
                            </label>
                            <select id="subject" name="subject" 
                                class="w-full px-4 py-3 bg-gray-600 border border-gray-500 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Seleziona un oggetto</option>
                                <option value="support">Supporto Tecnico</option>
                                <option value="feature">Richiesta Funzionalità</option>
                                <option value="bug">Segnalazione Bug</option>
                                <option value="partnership">Collaborazione</option>
                                <option value="other">Altro</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-300 mb-2">
                                Messaggio
                            </label>
                            <textarea id="message" name="message" rows="6" 
                                class="w-full px-4 py-3 bg-gray-600 border border-gray-500 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Descrivi il tuo messaggio..."></textarea>
                        </div>

                        <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition-colors">
                            Invia Messaggio
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="space-y-8">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-6">Informazioni di Contatto</h2>
                        <p class="text-gray-300 mb-8">
                            Siamo qui per aiutarti con qualsiasi domanda o richiesta riguardo FishTideLog.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <!-- Email -->
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-1">Email</h3>
                                <p class="text-gray-300">support@fishtidelog.com</p>
                                <p class="text-sm text-gray-400">Risposta entro 24 ore</p>
                            </div>
                        </div>

                        <!-- Support -->
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12.862 7.246a4.002 4.002 0 012.08-.041l1.562 1.562a5.976 5.976 0 00-1.54 1.54l-1.53-1.533a4.002 4.002 0 00-1.572.432z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-1">Supporto Tecnico</h3>
                                <p class="text-gray-300">Assistenza per problemi tecnici</p>
                                <p class="text-sm text-gray-400">Lun-Ven 9:00-18:00</p>
                            </div>
                        </div>

                        <!-- Community -->
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-1">Community</h3>
                                <p class="text-gray-300">Forum e gruppi di discussione</p>
                                <p class="text-sm text-gray-400">Condividi esperienze</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Link -->
                    <div class="bg-gray-700 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-white mb-3">Domande Frequenti</h3>
                        <p class="text-gray-300 mb-4">
                            Prima di contattarci, dai un'occhiata alle nostre FAQ per risposte rapide.
                        </p>
                        <a href="#" class="text-blue-400 hover:text-blue-300 font-semibold">
                            Vedi FAQ →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Info -->
    <section class="py-20 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Risposta Rapida</h3>
                    <p class="text-gray-300">
                        Rispondiamo a tutte le email entro 24 ore nei giorni lavorativi.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Supporto Esperto</h3>
                    <p class="text-gray-300">
                        Il nostro team di esperti è pronto ad aiutarti con qualsiasi problema.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Documentazione</h3>
                    <p class="text-gray-300">
                        Guide complete e tutorial per utilizzare al meglio FishTideLog.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-green-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Pronto a Iniziare?
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Registrati gratuitamente e inizia a documentare le tue avventure di pesca.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                    Registrati Ora
                </a>
                <a href="{{ route('login') }}" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                    Accedi
                </a>
            </div>
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