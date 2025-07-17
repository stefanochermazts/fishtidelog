{{-- Statistics Widget Component con supporto per tema scuro e accessibilità WCAG AA --}}
<div class="statistics-widget" 
     x-data="{ expanded: false }"
     wire:poll.30s="loadStatistics"
     aria-live="polite"
     aria-label="{{ __('Statistics widget') }}">
    
    {{-- Loading State con supporto per screen readers --}}
    <div wire:loading 
         class="flex items-center justify-center p-8"
         role="status"
         aria-label="{{ __('Loading statistics') }}">
        <div class="spinner w-8 h-8"></div>
        <span class="sr-only">{{ __('Loading statistics') }}</span>
    </div>

    {{-- Content quando non in caricamento --}}
    <div wire:loading.remove class="space-y-6">
        {{-- Statistiche Rapide con design mobile-first --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            {{-- Total Trips Card --}}
            <div class="card card-hover">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-2xl bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                                {{ __('messages.total_trips') }}
                            </p>
                            <p class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">
                                {{ number_format($totalTrips) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Catches Card --}}
            <div class="card card-hover">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-2xl bg-secondary-100 dark:bg-secondary-900/30 text-secondary-600 dark:text-secondary-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                                {{ __('messages.total_catches') }}
                            </p>
                            <p class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">
                                {{ number_format($totalCatches) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Weight Card --}}
            <div class="card card-hover">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-2xl bg-accent-100 dark:bg-accent-900/30 text-accent-600 dark:text-accent-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                                {{ __('messages.total_weight') }}
                            </p>
                            <p class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">
                                {{ number_format($totalWeight, 1) }} kg
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Monthly Trips Card --}}
            <div class="card card-hover">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-2xl bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                                {{ __('messages.this_month') }}
                            </p>
                            <p class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">
                                {{ number_format($monthlyTrips) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Catture Recenti con accordion per mobile --}}
        @if($recentCatches->count() > 0)
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="h3 text-neutral-900 dark:text-neutral-100">
                            {{ __('messages.recent_catches') }}
                        </h3>
                        <button @click="expanded = !expanded"
                                @keydown.enter="expanded = !expanded"
                                @keydown.space="expanded = !expanded"
                                class="lg:hidden btn-ghost p-2 rounded-xl"
                                :aria-expanded="expanded"
                                aria-controls="recent-catches-content"
                                aria-label="{{ __('Toggle recent catches') }}">
                            <svg class="w-5 h-5 transition-transform duration-200"
                                 :class="expanded ? 'rotate-180' : ''"
                                 fill="currentColor" 
                                 viewBox="0 0 20 20"
                                 aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div id="recent-catches-content"
                         x-show="expanded || window.innerWidth >= 1024"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="space-y-4">
                        
                        @foreach($recentCatches as $catch)
                            <div class="flex items-center justify-between p-4 border border-neutral-200 dark:border-neutral-700 rounded-2xl hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors duration-200">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-secondary-100 dark:bg-secondary-900/30 rounded-full flex items-center justify-center">
                                        <span class="text-2xl">🐟</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-neutral-900 dark:text-neutral-100">
                                            {{ $catch->species }}
                                        </p>
                                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                                            {{ $catch->catch_time->format('d/m/Y H:i') }}
                                        </p>
                                        <p class="text-xs text-neutral-500 dark:text-neutral-500">
                                            {{ $catch->fishingTrip->title }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    @if($catch->weight)
                                        <p class="text-sm font-medium text-neutral-900 dark:text-neutral-100">
                                            {{ $catch->formatted_weight }}
                                        </p>
                                    @endif
                                    @if($catch->released)
                                        <span class="badge-secondary text-xs">
                                            {{ __('messages.released') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Punti Preferiti --}}
        @if($favoriteSpots->count() > 0)
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="h3 text-neutral-900 dark:text-neutral-100">
                            {{ __('messages.favorite_spots') }}
                        </h3>
                        <a href="{{ route('fishing-spots.index') }}" 
                           class="text-sm text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-medium transition-colors duration-200">
                            {{ __('messages.view_all') }}
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($favoriteSpots as $spot)
                            <div class="p-4 border border-neutral-200 dark:border-neutral-700 rounded-2xl hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors duration-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-neutral-900 dark:text-neutral-100">
                                            {{ $spot->name }}
                                        </p>
                                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                                            {{ $spot->fishing_trips_count }} {{ __('messages.trips') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Empty State --}}
        @if($totalCatches === 0)
            <div class="card">
                <div class="p-8 text-center">
                    <div class="text-6xl mb-4">🐟</div>
                    <h3 class="h3 text-neutral-900 dark:text-neutral-100 mb-2">
                        {{ __('messages.no_catches_yet') }}
                    </h3>
                    <p class="text-neutral-600 dark:text-neutral-400 mb-6">
                        {{ __('messages.start_fishing_message') }}
                    </p>
                    <a href="{{ route('catches.create') }}" 
                       class="btn-primary">
                        {{ __('messages.add_first_catch') }}
                    </a>
                </div>
            </div>
        @endif
    </div>

    {{-- Error State --}}
    <div wire:error class="card bg-red-50 dark:bg-red-900/30 border-red-200 dark:border-red-700">
        <div class="p-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <span class="text-red-800 dark:text-red-200">
                    {{ __('messages.error_loading_statistics') }}
                </span>
            </div>
        </div>
    </div>
</div> 