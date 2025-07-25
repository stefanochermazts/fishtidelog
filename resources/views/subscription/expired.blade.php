<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Il tuo periodo di prova è scaduto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Header con icona -->
                    <div class="text-center mb-8">
                        <div class="mx-auto w-24 h-24 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-12 h-12 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                            Periodo di prova scaduto
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300">
                            Il tuo trial gratuito di 6 mesi è terminato
                            @if($trialEndedAt)
                                il <strong>{{ $trialEndedAt->format('d/m/Y') }}</strong>
                            @endif
                        </p>
                    </div>

                    <!-- Messaggio principale -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-2">
                            Continua a usare FishTideLog!
                        </h3>
                        <p class="text-blue-800 dark:text-blue-200 mb-4">
                            Hai potuto utilizzare tutte le funzionalità di FishTideLog gratuitamente per 6 mesi. 
                            Per continuare a documentare le tue avventure di pesca, aggiorna al Piano Standard.
                        </p>
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-blue-200 dark:border-blue-700">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white">Piano Standard</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Accesso completo a tutte le funzionalità</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">€4,99</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">al mese</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Caratteristiche incluse -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                            Cosa include il Piano Standard:
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Uscite di pesca illimitate</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Gestione catture completa</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Punti di pesca illimitati</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Informazioni maree</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Statistiche avanzate</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Mappa interattiva</span>
                            </div>
                        </div>
                    </div>

                    <!-- Azioni -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <form action="{{ route('subscription.upgrade') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors shadow-lg">
                                Aggiorna al Piano Standard
                            </button>
                        </form>
                        
                        <a href="{{ route('home') }}" class="w-full sm:w-auto bg-gray-300 hover:bg-gray-400 text-gray-800 px-8 py-3 rounded-lg font-semibold transition-colors text-center">
                            Torna alla Homepage
                        </a>
                    </div>

                    <!-- Note -->
                    <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
                        <p>
                            I tuoi dati sono al sicuro e verranno conservati per 30 giorni.<br>
                            Puoi riattivare il tuo account in qualsiasi momento.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout> 