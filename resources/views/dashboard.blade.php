<x-app-layout>
    <x-slot name="header">
        <h2 class="h2 text-neutral-900 dark:text-neutral-100">
            {{ __('messages.dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Statistiche Rapide -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">{{ __('messages.total_trips') }}</p>
                            <p class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">{{ $totalTrips }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">{{ __('messages.total_catches') }}</p>
                            <p class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">{{ $totalCatches }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">{{ __('messages.total_weight') }}</p>
                            <p class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">{{ number_format($totalWeight, 1) }} kg</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">{{ __('messages.this_month') }}</p>
                            <p class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">{{ $monthlyTrips }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Azioni Rapide -->
        <div class="card">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100 mb-4">{{ __('messages.quick_actions') }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <a href="{{ route('fishing-trips.create') }}" class="flex items-center p-4 border border-blue-200 dark:border-blue-700 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                        <div class="p-2 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 mr-3">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-neutral-900 dark:text-neutral-100">{{ __('messages.new_trip') }}</p>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ __('messages.fishing_trips_title') }}</p>
                        </div>
                    </a>

                    <a href="{{ route('catches.create') }}" class="flex items-center p-4 border border-green-200 dark:border-green-700 rounded-lg hover:bg-green-50 dark:hover:bg-green-900/20 transition-colors">
                        <div class="p-2 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 mr-3">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-neutral-900 dark:text-neutral-100">{{ __('messages.add_catch') }}</p>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ __('messages.catches') }}</p>
                        </div>
                    </a>

                    <a href="{{ route('fishing-spots.create') }}" class="flex items-center p-4 border border-yellow-200 dark:border-yellow-700 rounded-lg hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-colors">
                        <div class="p-2 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 mr-3">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-neutral-900 dark:text-neutral-100">{{ __('messages.new_spot') }}</p>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ __('messages.fishing_spots_title') }}</p>
                        </div>
                    </a>

                    <a href="{{ route('map') }}" class="flex items-center p-4 border border-purple-200 dark:border-purple-700 rounded-lg hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors">
                        <div class="p-2 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 mr-3">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-neutral-900 dark:text-neutral-100">{{ __('messages.view_map') }}</p>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ __('messages.map') }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Uscite Recenti -->
        <div class="card">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">{{ __('messages.recent_trips') }}</h3>
                    <a href="{{ route('fishing-trips.index') }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 text-sm font-medium">{{ __('messages.view_all') }}</a>
                </div>
                
                @if($recentTrips->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentTrips as $trip)
                            <div class="flex items-center justify-between p-4 border border-neutral-200 dark:border-neutral-700 rounded-lg hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-neutral-900 dark:text-neutral-100">{{ $trip->title }}</p>
                                        <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ $trip->start_time->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ $trip->duration }}</p>
                                    <p class="text-sm font-medium text-neutral-900 dark:text-neutral-100">{{ $trip->total_catches }} {{ __('messages.total_catches') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-6 h-6 text-neutral-400 dark:text-neutral-500 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-neutral-600 dark:text-neutral-400">{{ __('messages.no_trips_recorded') }}</p>
                        <a href="{{ route('fishing-trips.create') }}" class="mt-2 inline-flex items-center text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300">
                            {{ __('messages.record_first_trip') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Catture Recenti -->
        @if($recentCatches->count() > 0)
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">{{ __('messages.recent_catches') }}</h3>
                        <a href="{{ route('catches.index') }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 text-sm font-medium">{{ __('messages.view_all') }}</a>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach($recentCatches as $catch)
                            <div class="flex items-center justify-between p-4 border border-neutral-200 dark:border-neutral-700 rounded-lg hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                        <span class="text-2xl">🐟</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-neutral-900 dark:text-neutral-100">{{ $catch->species }}</p>
                                        <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ $catch->catch_time->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    @if($catch->weight)
                                        <p class="text-sm font-medium text-neutral-900 dark:text-neutral-100">{{ $catch->formatted_weight }}</p>
                                    @endif
                                    @if($catch->released)
                                        <span class="text-xs bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 px-2 py-1 rounded">{{ __('messages.released') }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Punti Preferiti -->
        @if($favoriteSpots->count() > 0)
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">{{ __('messages.favorite_spots') }}</h3>
                        <a href="{{ route('fishing-spots.index') }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 text-sm font-medium">{{ __('messages.view_all') }}</a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($favoriteSpots as $spot)
                            <div class="p-4 border border-neutral-200 dark:border-neutral-700 rounded-lg hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-neutral-900 dark:text-neutral-100">{{ $spot->name }}</p>
                                        <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ $spot->type ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
