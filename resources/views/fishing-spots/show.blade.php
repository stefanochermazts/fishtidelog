<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $fishingSpot->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('fishing-spots.edit', $fishingSpot) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('messages.edit') }}
                </a>
                <form method="POST" action="{{ route('fishing-spots.toggle-favorite', $fishingSpot) }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        {{ $fishingSpot->is_favorite ? __('messages.remove_from_favorites') : __('messages.add_to_favorites') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('messages.spot_details') }}</h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <span class="font-medium text-gray-700">{{ __('messages.name') }}:</span>
                                    <span class="ml-2 text-gray-900">{{ $fishingSpot->name }}</span>
                                </div>
                                
                                @if($fishingSpot->description)
                                    <div>
                                        <span class="font-medium text-gray-700">{{ __('messages.description') }}:</span>
                                        <p class="mt-1 text-gray-900">{{ $fishingSpot->description }}</p>
                                    </div>
                                @endif
                                
                                <div>
                                    <span class="font-medium text-gray-700">{{ __('messages.type') }}:</span>
                                    <span class="ml-2 text-gray-900">{{ __('messages.' . $fishingSpot->type) }}</span>
                                </div>
                                
                                @if($fishingSpot->address)
                                    <div>
                                        <span class="font-medium text-gray-700">{{ __('messages.address') }}:</span>
                                        <span class="ml-2 text-gray-900">{{ $fishingSpot->address }}</span>
                                    </div>
                                @endif
                                
                                @if($fishingSpot->latitude && $fishingSpot->longitude)
                                    <div>
                                        <span class="font-medium text-gray-700">{{ __('messages.location') }}:</span>
                                        <div id="map" class="w-full h-64 mt-2 rounded-lg border border-gray-300"></div>
                                    </div>
                                @endif
                                
                                <div>
                                    <span class="font-medium text-gray-700">{{ __('messages.favorite') }}:</span>
                                    <span class="ml-2 text-gray-900">
                                        @if($fishingSpot->is_favorite)
                                            <span class="text-yellow-600">⭐ {{ __('messages.yes') }}</span>
                                        @else
                                            <span class="text-gray-500">{{ __('messages.no') }}</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('messages.spot_statistics') }}</h3>
                            
                            <div class="space-y-3">
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <div class="text-2xl font-bold text-blue-600">{{ $fishingSpot->trips_count ?? 0 }}</div>
                                    <div class="text-sm text-blue-600">{{ __('messages.total_trips') }}</div>
                                </div>
                                
                                <div class="bg-green-50 p-4 rounded-lg">
                                    <div class="text-2xl font-bold text-green-600">{{ number_format($fishingSpot->total_weight ?? 0, 1) }} kg</div>
                                    <div class="text-sm text-green-600">{{ __('messages.total_weight') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($fishingSpot->trips && $fishingSpot->trips->count() > 0)
                        <div class="mt-8">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ __('messages.recent_trips') }}</h3>
                                <a href="{{ route('fishing-trips.create', ['fishing_spot_id' => $fishingSpot->id, 'redirect_to' => 'fishing-spot']) }}" 
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    {{ __('messages.new_trip') }}
                                </a>
                            </div>
                            <div class="space-y-3">
                                @foreach($fishingSpot->trips->take(5) as $trip)
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ $trip->title }}</h4>
                                                <p class="text-sm text-gray-600">{{ $trip->start_time->format('d/m/Y H:i') }}</p>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <div class="text-right">
                                                    <p class="text-sm font-medium text-gray-900">{{ $trip->total_catches }} {{ __('messages.total_catches') }}</p>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <a href="{{ route('fishing-trips.show', $trip) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                        {{ __('messages.view') }}
                                                    </a>
                                                    <a href="{{ route('fishing-trips.edit', ['fishingTrip' => $trip, 'redirect_to' => 'fishing-spot']) }}" 
                                                       class="text-green-600 hover:text-green-800 text-sm font-medium">
                                                        {{ __('messages.edit') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="mt-8 text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-gray-600 mb-4">{{ __('messages.no_trips_recorded') }}</p>
                            <a href="{{ route('fishing-trips.create', ['fishing_spot_id' => $fishingSpot->id, 'redirect_to' => 'fishing-spot']) }}" 
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                {{ __('messages.new_trip') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    @if($fishingSpot->latitude && $fishingSpot->longitude)
        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Inizializza la mappa
                var map = L.map('map').setView([{{ $fishingSpot->latitude }}, {{ $fishingSpot->longitude }}], 15);
                
                // Aggiungi il layer di OpenStreetMap
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                
                // Aggiungi un marker per la posizione del fishing spot
                var marker = L.marker([{{ $fishingSpot->latitude }}, {{ $fishingSpot->longitude }}]).addTo(map);
                
                // Aggiungi un popup con le informazioni del fishing spot
                marker.bindPopup(`
                    <div class="text-center">
                        <h3 class="font-semibold text-lg">{{ $fishingSpot->name }}</h3>
                        <p class="text-sm text-gray-600">{{ __('messages.' . $fishingSpot->type) }}</p>
                        @if($fishingSpot->address)
                            <p class="text-xs text-gray-500">{{ $fishingSpot->address }}</p>
                        @endif
                    </div>
                `);
            });
        </script>
        @endpush
    @endif
</x-app-layout> 