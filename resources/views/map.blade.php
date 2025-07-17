<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.map') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Controlli filtro -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
                <div class="flex flex-wrap gap-4 items-center">
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="checkbox" id="show-spots" checked class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">{{ __('messages.fishing_spots') }}</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" id="show-trips" checked class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">{{ __('messages.fishing_trips') }}</span>
                        </label>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-600">{{ __('messages.spot_type') }}:</span>
                        <select id="spot-type-filter" class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">{{ __('messages.all_types') }}</option>
                            <option value="shore">{{ __('messages.shore') }}</option>
                            <option value="boat">{{ __('messages.boat') }}</option>
                            <option value="pier">{{ __('messages.pier') }}</option>
                            <option value="rock">{{ __('messages.rock') }}</option>
                            <option value="beach">{{ __('messages.beach') }}</option>
                            <option value="lake">{{ __('messages.lake') }}</option>
                            <option value="river">{{ __('messages.river') }}</option>
                        </select>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-600">{{ __('messages.favorite_only') }}:</span>
                        <input type="checkbox" id="favorite-only" class="rounded border-gray-300 text-yellow-600 shadow-sm focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Mappa Leaflet -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div id="map" class="w-full h-96 rounded-lg"></div>
            </div>

            <!-- Statistiche -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-blue-100 text-blue-600 mr-3">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ __('messages.total_spots') }}</p>
                            <p class="text-2xl font-bold text-gray-900" id="total-spots">{{ $spots->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-green-100 text-green-600 mr-3">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ __('messages.total_trips') }}</p>
                            <p class="text-2xl font-bold text-gray-900" id="total-trips">{{ $trips->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-yellow-100 text-yellow-600 mr-3">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ __('messages.favorite_spots') }}</p>
                            <p class="text-2xl font-bold text-gray-900" id="favorite-spots">{{ $spots->where('is_favorite', true)->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-purple-100 text-purple-600 mr-3">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ __('messages.visible_markers') }}</p>
                            <p class="text-2xl font-bold text-gray-900" id="visible-markers">0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Verifica che Leaflet sia caricato
            if (typeof L === 'undefined') {
                console.error('Leaflet non è caricato!');
                return;
            }
            
            // Dati dal backend
            const spots = @json($spots);
            const trips = @json($trips);
            
            // Inizializza la mappa
            const map = L.map('map').setView([45.4642, 9.1900], 10); // Default: Milano
            
            // Aggiungi layer OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
            
            // Layer per i marker
            let spotsLayer = L.layerGroup();
            let tripsLayer = L.layerGroup();
            
            // Icone personalizzate
            const spotIcon = L.divIcon({
                html: '🎣',
                className: 'custom-div-icon',
                iconSize: [40, 40],
                iconAnchor: [20, 20]
            });
            
            const tripIcon = L.divIcon({
                html: '📍',
                className: 'custom-div-icon',
                iconSize: [35, 35],
                iconAnchor: [17, 17]
            });
            
            const favoriteIcon = L.divIcon({
                html: '⭐',
                className: 'custom-div-icon',
                iconSize: [45, 45],
                iconAnchor: [22, 22]
            });
            

            
            // Funzione per aggiungere marker degli spot
            function addSpotMarkers() {
                spotsLayer.clearLayers();
                
                spots.forEach(spot => {
                    if (spot.latitude && spot.longitude) {
                        const icon = spot.is_favorite ? favoriteIcon : spotIcon;
                        const marker = L.marker([spot.latitude, spot.longitude], { icon })
                            .bindPopup(`
                                <div class="p-2">
                                    <h3 class="font-bold text-lg">${spot.name}</h3>
                                    <p class="text-sm text-gray-600">${spot.type || 'N/A'}</p>
                                    ${spot.description ? `<p class="text-sm mt-1">${spot.description}</p>` : ''}
                                    <div class="mt-2 flex space-x-2">
                                        <a href="/fishing-spots/${spot.id}" class="text-blue-600 hover:text-blue-800 text-sm">${@json(__('messages.view'))}</a>
                                        <a href="/fishing-spots/${spot.id}/edit" class="text-green-600 hover:text-green-800 text-sm">${@json(__('messages.edit'))}</a>
                                    </div>
                                </div>
                            `);
                        spotsLayer.addLayer(marker);
                    }
                });
            }
            
            // Funzione per aggiungere marker delle uscite
            function addTripMarkers() {
                tripsLayer.clearLayers();
                
                trips.forEach(trip => {
                    if (trip.latitude && trip.longitude) {
                        const marker = L.marker([trip.latitude, trip.longitude], { icon: tripIcon })
                            .bindPopup(`
                                <div class="p-2">
                                    <h3 class="font-bold text-lg">${trip.title}</h3>
                                    <p class="text-sm text-gray-600">${trip.start_time}</p>
                                    <p class="text-sm">${trip.total_catches} ${@json(__('messages.total_catches'))}</p>
                                    <div class="mt-2 flex space-x-2">
                                        <a href="/fishing-trips/${trip.id}" class="text-blue-600 hover:text-blue-800 text-sm">${@json(__('messages.view'))}</a>
                                        <a href="/fishing-trips/${trip.id}/edit" class="text-green-600 hover:text-green-800 text-sm">${@json(__('messages.edit'))}</a>
                                    </div>
                                </div>
                            `);
                        tripsLayer.addLayer(marker);
                    }
                });
            }
            
            // Inizializza i marker
            addSpotMarkers();
            addTripMarkers();
            
            // Aggiungi layer alla mappa
            spotsLayer.addTo(map);
            tripsLayer.addTo(map);
            
            // Controlli filtro
            document.getElementById('show-spots').addEventListener('change', function() {
                if (this.checked) {
                    map.addLayer(spotsLayer);
                } else {
                    map.removeLayer(spotsLayer);
                }
                updateVisibleMarkers();
            });
            
            document.getElementById('show-trips').addEventListener('change', function() {
                if (this.checked) {
                    map.addLayer(tripsLayer);
                } else {
                    map.removeLayer(tripsLayer);
                }
                updateVisibleMarkers();
            });
            
            // Funzione per aggiornare contatore marker visibili
            function updateVisibleMarkers() {
                const visibleSpots = document.getElementById('show-spots').checked ? spotsLayer.getLayers().length : 0;
                const visibleTrips = document.getElementById('show-trips').checked ? tripsLayer.getLayers().length : 0;
                document.getElementById('visible-markers').textContent = visibleSpots + visibleTrips;
            }
            
            // Inizializza contatore
            updateVisibleMarkers();
            
            // Fit bounds se ci sono marker, altrimenti mantieni la vista di default
            const allMarkers = [...spotsLayer.getLayers(), ...tripsLayer.getLayers()];
            if (allMarkers.length > 0) {
                const group = L.featureGroup(allMarkers);
                map.fitBounds(group.getBounds().pad(0.1));
            }
        });
    </script>
    
    <style>
        /* Assicura che la mappa sia visibile */
        #map {
            width: 100%;
            height: 384px !important;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            z-index: 1;
        }
        
        /* Stili per le icone personalizzate */
        .custom-div-icon {
            background: none !important;
            border: none !important;
        }
        .custom-div-icon div {
            font-size: 32px !important;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8) !important;
            line-height: 1 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            height: 100% !important;
        }
        
        /* Assicura che le icone siano sopra la mappa */
        .leaflet-marker-icon {
            z-index: 1000 !important;
        }
    </style>
    @endpush
</x-app-layout> 