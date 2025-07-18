<x-app-layout>
    <x-slot name="header">
        <h2 class="h2 text-neutral-900 dark:text-neutral-100">
            {{ __('messages.edit_fishing_spot') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="container-wide">
            <div class="card">
                <div class="p-6">
                    <form method="POST" action="{{ route('fishing-spots.update', $fishingSpot) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="name" class="form-label">{{ __('messages.title') }} *</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $fishingSpot->name) }}" required
                                class="form-input">
                            @error('name')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="form-label">{{ __('messages.description') }}</label>
                            <textarea name="description" id="description" rows="3"
                                class="form-input">{{ old('description', $fishingSpot->description) }}</textarea>
                            @error('description')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Indirizzo per geocoding -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">{{ __('messages.address') }}</label>
                            <div class="flex space-x-2">
                                <input type="text" name="address" id="address" value="{{ old('address', $fishingSpot->address) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="{{ __('messages.enter_address') }}">
                                <button type="button" id="geocode-btn" 
                                    class="mt-1 px-3 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 text-sm">
                                    {{ __('messages.find_coordinates') }}
                                </button>
                            </div>
                            <p class="mt-2 text-sm text-gray-600">{{ __('messages.enter_address_first') }}</p>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mappa per selezione coordinate -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.select_location') }}</label>
                            <div id="map" class="w-full h-64 rounded-lg border border-gray-300 bg-gray-100 flex items-center justify-center">
                                <div id="map-loading" class="text-gray-500">
                                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500 mx-auto mb-2"></div>
                                    {{ __('messages.loading_map') }}
                                </div>
                                <div id="map-error" class="text-red-500 hidden">
                                    {{ __('messages.map_error') }}
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-gray-600">{{ __('messages.click_map_to_select') }}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="latitude" class="block text-sm font-medium text-gray-700">{{ __('messages.latitude') }} *</label>
                                <input type="number" step="any" name="latitude" id="latitude" value="{{ old('latitude', $fishingSpot->latitude) }}" required readonly
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-500">
                                @error('latitude')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="longitude" class="block text-sm font-medium text-gray-700">{{ __('messages.longitude') }} *</label>
                                <input type="number" step="any" name="longitude" id="longitude" value="{{ old('longitude', $fishingSpot->longitude) }}" required readonly
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-500">
                                @error('longitude')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="type" class="form-label">{{ __('messages.type') }}</label>
                            <select name="type" id="type" class="form-input">
                                <option value="">{{ __('messages.select_type') }}</option>
                                <option value="shore" {{ old('type', $fishingSpot->type) == 'shore' ? 'selected' : '' }}>{{ __('messages.shore') }}</option>
                                <option value="boat" {{ old('type', $fishingSpot->type) == 'boat' ? 'selected' : '' }}>{{ __('messages.boat') }}</option>
                                <option value="pier" {{ old('type', $fishingSpot->type) == 'pier' ? 'selected' : '' }}>{{ __('messages.pier') }}</option>
                                <option value="rock" {{ old('type', $fishingSpot->type) == 'rock' ? 'selected' : '' }}>{{ __('messages.rock') }}</option>
                                <option value="beach" {{ old('type', $fishingSpot->type) == 'beach' ? 'selected' : '' }}>{{ __('messages.beach') }}</option>
                                <option value="lake" {{ old('type', $fishingSpot->type) == 'lake' ? 'selected' : '' }}>{{ __('messages.lake') }}</option>
                                <option value="river" {{ old('type', $fishingSpot->type) == 'river' ? 'selected' : '' }}>{{ __('messages.river') }}</option>
                            </select>
                            @error('type')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sezione Maree -->
                        <div class="border-t border-neutral-200 dark:border-neutral-600 pt-6">
                            <h3 class="text-lg font-medium text-neutral-900 dark:text-neutral-100 mb-4">Informazioni Maree</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="tide_latitude" class="form-label">Latitudine per le maree</label>
                                    <input type="number" name="tide_latitude" id="tide_latitude" step="0.000001" class="form-input" placeholder="45.4371">
                                    <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">Inserisci la latitudine per ottenere informazioni sulle maree</p>
                                </div>
                                <div>
                                    <label for="tide_longitude" class="form-label">Longitudine per le maree</label>
                                    <input type="number" name="tide_longitude" id="tide_longitude" step="0.000001" class="form-input" placeholder="12.3326">
                                    <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">Inserisci la longitudine per ottenere informazioni sulle maree</p>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <label for="tide_date" class="form-label">Data per le maree</label>
                                <input type="date" name="tide_date" id="tide_date" class="form-input">
                                <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">Data per cui consultare le maree (opzionale)</p>
                            </div>
                            
                            <div class="mt-4">
                                <button type="button" id="get-tides-btn" class="btn-primary">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Consulta Maree
                                </button>
                            </div>
                            
                            <!-- Risultati maree -->
                            <div id="tide-results" class="mt-4 hidden">
                                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                                    <h4 class="font-medium text-blue-900 dark:text-blue-100 mb-3">Situazione Maree</h4>
                                    <div id="tide-data" class="space-y-3">
                                        <!-- I dati delle maree verranno inseriti qui -->
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Loading maree -->
                            <div id="tide-loading" class="mt-4 hidden">
                                <div class="flex items-center justify-center py-4">
                                    <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                                    <span class="ml-3 text-neutral-600 dark:text-neutral-400">Caricamento dati maree...</span>
                                </div>
                            </div>
                            
                            <!-- Errore maree -->
                            <div id="tide-error" class="mt-4 hidden">
                                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                                    <div class="flex">
                                        <svg class="w-5 h-5 text-red-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                        </svg>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-red-800 dark:text-red-200">Errore</h3>
                                            <div class="mt-2 text-sm text-red-700 dark:text-red-300" id="tide-error-message"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-6">
                            <div class="flex items-center">
                                <input type="checkbox" name="is_public" id="is_public" value="1" {{ old('is_public', $fishingSpot->is_public) ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_public" class="ml-2 block text-sm text-gray-900">
                                    {{ __('messages.is_public') }}
                                </label>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" name="is_favorite" id="is_favorite" value="1" {{ old('is_favorite', $fishingSpot->is_favorite) ? 'checked' : '' }}
                                    class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300 rounded">
                                <label for="is_favorite" class="ml-2 block text-sm text-gray-900">
                                    {{ __('messages.is_favorite') }}
                                </label>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3 mt-6">
                            <a href="{{ route('fishing-spots.index') }}" 
                                class="btn-secondary">
                                {{ __('messages.cancel') }}
                            </a>
                            <button type="submit" 
                                class="btn-primary">
                                {{ __('messages.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Assicura che la mappa sia visibile */
        #map {
            width: 100%;
            height: 256px;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            z-index: 1;
        }
        
        /* Stili per i pulsanti */
        .btn-primary {
            background-color: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 600;
            transition: background-color 0.2s;
        }
        
        .btn-primary:hover {
            background-color: #2563eb;
        }
        
        .btn-secondary {
            background-color: #6b7280;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 600;
            transition: background-color 0.2s;
        }
        
        .btn-secondary:hover {
            background-color: #4b5563;
        }
        
        /* Stili specifici per il pulsante geocoding */
        #geocode-btn {
            background-color: #3b82f6 !important;
            color: white !important;
            padding: 0.5rem 1rem !important;
            border-radius: 0.375rem !important;
            font-weight: 600 !important;
            transition: background-color 0.2s !important;
            border: none !important;
            cursor: pointer !important;
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        #geocode-btn:hover {
            background-color: #2563eb !important;
        }
        
        #geocode-btn:disabled {
            background-color: #9ca3af !important;
            cursor: not-allowed !important;
        }
    </style>
    
    @push('scripts')
    <script>
        // Funzione per inizializzare la mappa
        function initializeMap() {
            console.log('Inizializzazione mappa...');
            
            // Verifica che Leaflet sia caricato
            if (typeof L === 'undefined') {
                console.error('Leaflet non è caricato!');
                showMapError('Leaflet non è disponibile');
                return;
            }
            
            // Verifica che l'elemento mappa esista
            const mapElement = document.getElementById('map');
            if (!mapElement) {
                console.error('Elemento mappa non trovato!');
                return;
            }
            
            // Nascondi loading e mostra mappa
            const mapLoading = document.getElementById('map-loading');
            const mapError = document.getElementById('map-error');
            
            try {
                // Inizializza la mappa
                const map = L.map('map').setView([41.9028, 12.4964], 8); // Centro Italia
                
                // Nascondi loading
                if (mapLoading) mapLoading.style.display = 'none';
                
                // Rimuovi background grigio
                const mapElement = document.getElementById('map');
                mapElement.classList.remove('bg-neutral-100', 'dark:bg-neutral-800', 'flex', 'items-center', 'justify-center');
            
                // Aggiungi layer OpenStreetMap
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
                
                let marker = null;
                const latInput = document.getElementById('latitude');
                const lngInput = document.getElementById('longitude');
                
                // Se ci sono valori esistenti, posiziona il marker
                if (latInput.value && lngInput.value) {
                    const lat = parseFloat(latInput.value);
                    const lng = parseFloat(lngInput.value);
                    marker = L.marker([lat, lng], {
                        icon: L.divIcon({
                            className: 'custom-marker',
                            html: '<div style="background-color: #3b82f6; width: 48px; height: 48px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;"><svg width="24" height="24" fill="white" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>',
                            iconSize: [48, 48],
                            iconAnchor: [24, 24]
                        })
                    }).addTo(map);
                    map.setView([lat, lng], 13);
                }
                
                // Gestione click sulla mappa
                map.on('click', function(e) {
                    const lat = e.latlng.lat;
                    const lng = e.latlng.lng;
                    
                    // Aggiorna i campi input
                    latInput.value = lat.toFixed(6);
                    lngInput.value = lng.toFixed(6);
                    
                    // Aggiorna o crea il marker
                    if (marker) {
                        marker.setLatLng([lat, lng]);
                    } else {
                        marker = L.marker([lat, lng], {
                            icon: L.divIcon({
                                className: 'custom-marker',
                                html: '<div style="background-color: #3b82f6; width: 48px; height: 48px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;"><svg width="24" height="24" fill="white" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>',
                                iconSize: [48, 48],
                                iconAnchor: [24, 24]
                            })
                        }).addTo(map);
                    }
                });
                
                // Gestione geocoding
                const geocodeBtn = document.getElementById('geocode-btn');
                const addressInput = document.getElementById('address');
                
                if (geocodeBtn && addressInput) {
                    geocodeBtn.addEventListener('click', function() {
                        const address = addressInput.value.trim();
                        if (!address) {
                            alert('{{ __("messages.enter_address_first") }}');
                            return;
                        }
                        
                        geocodeBtn.disabled = true;
                        geocodeBtn.textContent = '{{ __("messages.searching") }}...';
                        
                        // Simula geocoding (in produzione usare un servizio reale)
                        setTimeout(() => {
                            // Per ora, usa coordinate di esempio per Roma
                            const lat = 41.9028;
                            const lng = 12.4964;
                            
                            latInput.value = lat.toFixed(6);
                            lngInput.value = lng.toFixed(6);
                            
                            if (marker) {
                                marker.setLatLng([lat, lng]);
                            } else {
                                marker = L.marker([lat, lng], {
                                    icon: L.divIcon({
                                        className: 'custom-marker',
                                        html: '<div style="background-color: #3b82f6; width: 24px; height: 24px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;"><svg width="12" height="12" fill="white" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>',
                                        iconSize: [24, 24],
                                        iconAnchor: [12, 12]
                                    })
                                }).addTo(map);
                            }
                            
                            map.setView([lat, lng], 12);
                            
                            geocodeBtn.disabled = false;
                            geocodeBtn.textContent = '{{ __("messages.find_coordinates") }}';
                        }, 1000);
                    });
                }
                
                // Gestione maree
                const getTidesBtn = document.getElementById('get-tides-btn');
                const tideLatitude = document.getElementById('tide_latitude');
                const tideLongitude = document.getElementById('tide_longitude');
                const tideDate = document.getElementById('tide_date');
                const tideResults = document.getElementById('tide-results');
                const tideLoading = document.getElementById('tide-loading');
                const tideError = document.getElementById('tide-error');
                const tideData = document.getElementById('tide-data');
                const tideErrorMessage = document.getElementById('tide-error-message');
                
                if (getTidesBtn) {
                    getTidesBtn.addEventListener('click', function() {
                        const latitude = tideLatitude.value;
                        const longitude = tideLongitude.value;
                        const date = tideDate.value;
                        
                        if (!latitude || !longitude) {
                            showTideError('Inserisci latitudine e longitudine');
                            return;
                        }
                        
                        showTideLoading();
                        
                        fetch('{{ route("tides.get-by-coordinates") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                latitude: parseFloat(latitude),
                                longitude: parseFloat(longitude),
                                date: date
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            hideTideLoading();
                            if (data.success) {
                                showTideResults(data.data);
                            } else {
                                showTideError(data.message || 'Errore nel caricamento dei dati');
                            }
                        })
                        .catch(error => {
                            hideTideLoading();
                            showTideError('Errore di connessione');
                        });
                    });
                }
                
                function showTideLoading() {
                    tideLoading.classList.remove('hidden');
                    tideResults.classList.add('hidden');
                    tideError.classList.add('hidden');
                }
                
                function hideTideLoading() {
                    tideLoading.classList.add('hidden');
                }
                
                function showTideError(message) {
                    tideErrorMessage.textContent = message;
                    tideError.classList.remove('hidden');
                    tideResults.classList.add('hidden');
                }
                
                function showTideResults(data) {
                    let html = '';
                    
                    if (data.current) {
                        html += `
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="text-center">
                                    <div class="text-lg font-semibold text-blue-600 dark:text-blue-400">${data.current.height}m</div>
                                    <div class="text-sm text-blue-700 dark:text-blue-300">Altezza attuale</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-lg font-semibold text-blue-600 dark:text-blue-400">${data.current.time}</div>
                                    <div class="text-sm text-blue-700 dark:text-blue-300">Ora</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-lg font-semibold text-blue-600 dark:text-blue-400">${data.current_status}</div>
                                    <div class="text-sm text-blue-700 dark:text-blue-300">Stato</div>
                                </div>
                            </div>
                        `;
                    }
                    
                    if (data.next_high || data.next_low) {
                        html += `
                            <div class="mt-4 pt-4 border-t border-blue-200 dark:border-blue-700">
                                <h5 class="font-medium text-blue-900 dark:text-blue-100 mb-3">Prossimi estremi</h5>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        `;
                        
                        if (data.next_high) {
                            html += `
                                <div class="text-center">
                                    <div class="text-sm font-medium text-green-600 dark:text-green-400">Alta marea</div>
                                    <div class="text-lg font-bold text-green-600 dark:text-green-400">${data.next_high.height}m</div>
                                    <div class="text-sm text-green-700 dark:text-green-300">${data.next_high.time}</div>
                                </div>
                            `;
                        }
                        
                        if (data.next_low) {
                            html += `
                                <div class="text-center">
                                    <div class="text-sm font-medium text-green-600 dark:text-green-400">Bassa marea</div>
                                    <div class="text-lg font-bold text-green-600 dark:text-green-400">${data.next_low.height}m</div>
                                    <div class="text-sm text-green-700 dark:text-green-300">${data.next_low.time}</div>
                                </div>
                            `;
                        }
                        
                        html += `
                                </div>
                            </div>
                        `;
                    }
                    
                    tideData.innerHTML = html;
                    tideResults.classList.remove('hidden');
                }
                
            } catch (error) {
                console.error('Errore nell\'inizializzazione della mappa:', error);
                showMapError('Errore nell\'inizializzazione della mappa: ' + error.message);
            }
        }
        
        // Funzione per mostrare errore mappa
        function showMapError(message) {
            const mapLoading = document.getElementById('map-loading');
            const mapError = document.getElementById('map-error');
            
            if (mapLoading) mapLoading.style.display = 'none';
            if (mapError) {
                mapError.textContent = message;
                mapError.classList.remove('hidden');
            }
        }
        
        // Prova prima con Alpine.js
        document.addEventListener('alpine:init', function() {
            console.log('Alpine.js inizializzato, inizializzo mappa...');
            setTimeout(initializeMap, 100);
        });
        
        // Fallback se Alpine.js non è disponibile o non emette l'evento
        setTimeout(function() {
            if (document.getElementById('map-loading') && document.getElementById('map-loading').style.display !== 'none') {
                console.log('Fallback: Alpine.js non ha emesso alpine:init, inizializzo comunque...');
                initializeMap();
            }
        }, 2000);
        
        // Fallback aggiuntivo con DOMContentLoaded
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                if (document.getElementById('map-loading') && document.getElementById('map-loading').style.display !== 'none') {
                    console.log('Fallback DOMContentLoaded: inizializzo mappa...');
                    initializeMap();
                }
            }, 1000);
        });
    </script>
    @endpush
</x-app-layout> 