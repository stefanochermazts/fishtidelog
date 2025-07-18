<x-app-layout>
    <x-slot name="header">
        <h2 class="h2 text-neutral-900 dark:text-neutral-100">
            {{ __('messages.new_fishing_trip') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="container-wide">
            <div class="card">
                <div class="p-6">
                    <form method="POST" action="{{ route('fishing-trips.store') }}" class="space-y-6">
                        @csrf
                        
                        <!-- Campo nascosto per il redirect -->
                        @if(isset($redirectTo))
                            <input type="hidden" name="redirect_to" value="{{ $redirectTo }}">
                        @endif
                        
                        <div>
                            <label for="title" class="form-label">{{ __('messages.title') }} *</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="form-input">
                            @error('title')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="form-label">{{ __('messages.description') }}</label>
                            <textarea name="description" id="description" rows="3"
                                class="form-input">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="start_time" class="form-label">{{ __('messages.start_time') }} *</label>
                            <input type="datetime-local" name="start_time" id="start_time" value="{{ old('start_time') }}" required
                                class="form-input">
                            @error('start_time')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Dati Ambientali -->
                        <div id="environmental-data" class="hidden">
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                                <h4 class="font-medium text-blue-900 dark:text-blue-100 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.004 5.004 0 00-4.9 4H3z"></path>
                                    </svg>
                                    Dati Ambientali
                                </h4>
                                
                                <!-- Loading -->
                                <div id="env-loading" class="flex items-center justify-center py-4">
                                    <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                                    <span class="ml-3 text-neutral-600 dark:text-neutral-400">Caricamento dati ambientali...</span>
                                </div>

                                <!-- Dati Luna -->
                                <div id="moon-data" class="hidden mb-4">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                                        </svg>
                                        <span class="font-medium text-neutral-900 dark:text-neutral-100">Fase Lunare</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="text-neutral-600 dark:text-neutral-400">Fase:</span>
                                            <span id="moon-phase" class="ml-2 font-medium text-neutral-900 dark:text-neutral-100"></span>
                                        </div>
                                        <div>
                                            <span class="text-neutral-600 dark:text-neutral-400">Illuminazione:</span>
                                            <span id="moon-illumination" class="ml-2 font-medium text-neutral-900 dark:text-neutral-100"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dati Sole -->
                                <div id="sun-data" class="hidden mb-4">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                                        </svg>
                                        <span class="font-medium text-neutral-900 dark:text-neutral-100">Alba e Tramonto</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="text-neutral-600 dark:text-neutral-400">Alba:</span>
                                            <span id="sunrise-time" class="ml-2 font-medium text-neutral-900 dark:text-neutral-100"></span>
                                        </div>
                                        <div>
                                            <span class="text-neutral-600 dark:text-neutral-400">Tramonto:</span>
                                            <span id="sunset-time" class="ml-2 font-medium text-neutral-900 dark:text-neutral-100"></span>
                                        </div>
                                        <div>
                                            <span class="text-neutral-600 dark:text-neutral-400">Durata giorno:</span>
                                            <span id="day-length" class="ml-2 font-medium text-neutral-900 dark:text-neutral-100"></span>
                                        </div>
                                        <div>
                                            <span class="text-neutral-600 dark:text-neutral-400">Mezzogiorno solare:</span>
                                            <span id="solar-noon" class="ml-2 font-medium text-neutral-900 dark:text-neutral-100"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dati Meteo -->
                                <div id="weather-data" class="hidden">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                                        </svg>
                                        <span class="font-medium text-neutral-900 dark:text-neutral-100">Previsioni Meteo</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="text-neutral-600 dark:text-neutral-400">Temperatura:</span>
                                            <span id="weather-temp" class="ml-2 font-medium text-neutral-900 dark:text-neutral-100"></span>
                                        </div>
                                        <div>
                                            <span class="text-neutral-600 dark:text-neutral-400">Condizioni:</span>
                                            <span id="weather-desc" class="ml-2 font-medium text-neutral-900 dark:text-neutral-100"></span>
                                        </div>
                                        <div>
                                            <span class="text-neutral-600 dark:text-neutral-400">Umidità:</span>
                                            <span id="weather-humidity" class="ml-2 font-medium text-neutral-900 dark:text-neutral-100"></span>
                                        </div>
                                        <div>
                                            <span class="text-neutral-600 dark:text-neutral-400">Vento:</span>
                                            <span id="weather-wind" class="ml-2 font-medium text-neutral-900 dark:text-neutral-100"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Errore -->
                                <div id="env-error" class="hidden">
                                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-3">
                                        <div class="flex">
                                            <svg class="w-5 h-5 text-red-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-red-800 dark:text-red-200">Errore</h3>
                                                <div class="mt-1 text-sm text-red-700 dark:text-red-300" id="env-error-message"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Selezione punto di pesca esistente -->
                        @if($fishingSpots->count() > 0)
                            <div>
                                <label for="fishing_spot_id" class="form-label">{{ __('messages.select_fishing_spot') }}</label>
                                <select name="fishing_spot_id" id="fishing_spot_id" 
                                    class="form-input">
                                    <option value="">{{ __('messages.select_fishing_spot_placeholder') }}</option>
                                    @foreach($fishingSpots as $spot)
                                        <option value="{{ $spot->id }}" 
                                            {{ old('fishing_spot_id', $selectedSpotId ?? '') == $spot->id ? 'selected' : '' }}
                                            data-lat="{{ $spot->latitude }}" 
                                            data-lng="{{ $spot->longitude }}"
                                            data-name="{{ $spot->name }}"
                                            data-type="{{ $spot->type }}">
                                            {{ $spot->name }} ({{ __('messages.' . $spot->type) }})
                                        </option>
                                    @endforeach
                                </select>
                                <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">{{ __('messages.select_fishing_spot_help') }}</p>
                                @error('fishing_spot_id')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        <div>
                            <label for="location_name" class="form-label">{{ __('messages.location_name') }}</label>
                            <div class="flex space-x-2">
                                <input type="text" name="location_name" id="location_name" value="{{ old('location_name') }}"
                                    class="form-input flex-1"
                                    placeholder="{{ __('messages.enter_location') }}">
                                <button type="button" id="geocode-btn" 
                                    class="btn-primary px-3 py-2 text-sm">
                                    {{ __('messages.find_coordinates') }}
                                </button>
                            </div>
                            @error('location_name')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mappa per selezione coordinate -->
                        <div>
                            <label class="form-label mb-2">{{ __('messages.select_location') }}</label>
                            <div id="map" class="w-full h-64 rounded-lg border border-neutral-300 dark:border-neutral-600 bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center">
                                <div id="map-loading" class="text-neutral-500 dark:text-neutral-400">
                                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary-500 mx-auto mb-2"></div>
                                    {{ __('messages.loading_map') }}
                                </div>
                                <div id="map-error" class="text-red-500 dark:text-red-400 hidden">
                                    {{ __('messages.map_error') }}
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">{{ __('messages.click_map_to_select') }}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="latitude" class="form-label">{{ __('messages.latitude') }}</label>
                                <input type="number" step="any" name="latitude" id="latitude" value="{{ old('latitude') }}" readonly
                                    class="form-input bg-neutral-50 dark:bg-neutral-700 text-neutral-500 dark:text-neutral-400">
                                @error('latitude')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="longitude" class="form-label">{{ __('messages.longitude') }}</label>
                                <input type="number" step="any" name="longitude" id="longitude" value="{{ old('longitude') }}" readonly
                                    class="form-input bg-neutral-50 dark:bg-neutral-700 text-neutral-500 dark:text-neutral-400">
                                @error('longitude')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
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

                        <div class="flex items-center">
                            <input type="checkbox" name="is_public" id="is_public" value="1" {{ old('is_public') ? 'checked' : '' }}
                                class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-neutral-300 dark:border-neutral-600 rounded">
                            <label for="is_public" class="ml-2 block text-sm text-neutral-900 dark:text-neutral-100">
                                {{ __('messages.is_public') }}
                            </label>
                        </div>

                        <div class="flex justify-end space-x-3 mt-6">
                            @if(isset($redirectTo) && $redirectTo === 'fishing-spot' && isset($selectedSpotId))
                                <a href="{{ route('fishing-spots.show', $selectedSpotId) }}" 
                                   class="btn-secondary">
                                    {{ __('messages.cancel') }}
                                </a>
                            @else
                                <a href="{{ route('fishing-trips.index') }}" 
                                   class="btn-secondary">
                                    {{ __('messages.cancel') }}
                                </a>
                            @endif
                            <button type="submit" 
                                class="btn-primary">
                                {{ __('messages.create') }}
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
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM caricato, inizializzo mappa...');
            
            // Verifica che Leaflet sia caricato
            if (typeof L === 'undefined') {
                console.error('Leaflet non è caricato!');
                return;
            }
            
            // Verifica che l'elemento mappa esista
            const mapElement = document.getElementById('map');
            if (!mapElement) {
                console.error('Elemento mappa non trovato!');
                return;
            }
            
            console.log('Inizializzo mappa...');
            
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
                        html: '<div style="background-color: #10b981; width: 48px; height: 48px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;"><svg width="24" height="24" fill="white" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>',
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
                            html: '<div style="background-color: #10b981; width: 48px; height: 48px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;"><svg width="24" height="24" fill="white" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>',
                            iconSize: [48, 48],
                            iconAnchor: [24, 24]
                        })
                    }).addTo(map);
                }
            });
            
            // Gestione selezione punto di pesca esistente
            const spotSelect = document.getElementById('fishing_spot_id');
            if (spotSelect) {
                spotSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const lat = selectedOption.dataset.lat;
                    const lng = selectedOption.dataset.lng;
                    
                    if (lat && lng) {
                        const latFloat = parseFloat(lat);
                        const lngFloat = parseFloat(lng);
                        
                        // Aggiorna i campi input
                        latInput.value = latFloat.toFixed(6);
                        lngInput.value = lngFloat.toFixed(6);
                        
                        // Copia automaticamente le coordinate nei campi delle maree
                        tideLatitude.value = latFloat.toFixed(6);
                        tideLongitude.value = lngFloat.toFixed(6);
                        
                        // Aggiorna la mappa
                        if (marker) {
                            marker.setLatLng([latFloat, lngFloat]);
                        } else {
                            marker = L.marker([latFloat, lngFloat], {
                                icon: L.divIcon({
                                    className: 'custom-marker',
                                    html: '<div style="background-color: #10b981; width: 24px; height: 24px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;"><svg width="12" height="12" fill="white" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>',
                                    iconSize: [24, 24],
                                    iconAnchor: [12, 12]
                                })
                            }).addTo(map);
                        }
                        
                        map.setView([latFloat, lngFloat], 15);
                    }
                });
            }
            
            // Gestione geocoding
            const geocodeBtn = document.getElementById('geocode-btn');
            const locationInput = document.getElementById('location_name');
            
            if (geocodeBtn && locationInput) {
                geocodeBtn.addEventListener('click', function() {
                    const location = locationInput.value.trim();
                    if (!location) {
                        alert('{{ __("messages.enter_location_first") }}');
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
                            marker = L.marker([lat, lng]).addTo(map);
                        }
                        
                        map.setView([lat, lng], 12);
                        
                        geocodeBtn.disabled = false;
                        geocodeBtn.textContent = '{{ __("messages.find_coordinates") }}';
                    }, 1000);
                });
            }
            
            } catch (error) {
                console.error('Errore nell\'inizializzazione della mappa:', error);
                if (mapLoading) mapLoading.style.display = 'none';
                if (mapError) mapError.classList.remove('hidden');
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
                    // Copia automaticamente le coordinate e la data se sono vuote
                    if (!tideLatitude.value && latInput.value) {
                        tideLatitude.value = latInput.value;
                    }
                    if (!tideLongitude.value && lngInput.value) {
                        tideLongitude.value = lngInput.value;
                    }
                    if (!tideDate.value && startTimeInput.value) {
                        tideDate.value = startTimeInput.value.split('T')[0];
                    }
                    
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

            // Gestione dati ambientali
            const startTimeInput = document.getElementById('start_time');
            const environmentalData = document.getElementById('environmental-data');
            const envLoading = document.getElementById('env-loading');
            const envError = document.getElementById('env-error');
            const envErrorMessage = document.getElementById('env-error-message');
            const moonData = document.getElementById('moon-data');
            const sunData = document.getElementById('sun-data');
            const weatherData = document.getElementById('weather-data');

            if (startTimeInput) {
                startTimeInput.addEventListener('change', function() {
                    const dateTime = this.value;
                    if (dateTime) {
                        // Estrai solo la data dal datetime-local
                        const date = dateTime.split('T')[0];
                        loadEnvironmentalData(date);
                        
                        // Copia automaticamente la data nel campo delle maree se è vuoto
                        if (!tideDate.value) {
                            tideDate.value = date;
                        }
                    }
                });
            }

            // Copia automatica delle coordinate e data quando si interagisce con i campi delle maree
            const tideFields = [tideLatitude, tideLongitude, tideDate];
            tideFields.forEach(field => {
                field.addEventListener('focus', function() {
                    // Copia le coordinate dell'uscita se i campi delle maree sono vuoti
                    if (this === tideLatitude && !this.value && latInput.value) {
                        this.value = latInput.value;
                    }
                    if (this === tideLongitude && !this.value && lngInput.value) {
                        this.value = lngInput.value;
                    }
                    if (this === tideDate && !this.value && startTimeInput.value) {
                        this.value = startTimeInput.value.split('T')[0];
                    }
                    
                    // Mostra messaggio di feedback
                    showCopyFeedback();
                });
            });

            // Funzione per mostrare feedback visivo della copia automatica
            function showCopyFeedback() {
                // Crea un elemento di feedback se non esiste
                let feedback = document.getElementById('copy-feedback');
                if (!feedback) {
                    feedback = document.createElement('div');
                    feedback.id = 'copy-feedback';
                    feedback.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 transform transition-all duration-300';
                    feedback.textContent = 'Coordinate e data copiate automaticamente!';
                    document.body.appendChild(feedback);
                }
                
                // Mostra il feedback
                feedback.style.transform = 'translateX(0)';
                feedback.style.opacity = '1';
                
                // Nascondi dopo 3 secondi
                setTimeout(() => {
                    feedback.style.transform = 'translateX(100%)';
                    feedback.style.opacity = '0';
                }, 3000);
            }

            function loadEnvironmentalData(date) {
                // Usa coordinate di default (Roma) se non sono state selezionate
                const latitude = latInput.value || 41.9028;
                const longitude = lngInput.value || 12.4964;

                if (!latitude || !longitude) {
                    showEnvError('Seleziona prima una posizione sulla mappa');
                    return;
                }

                showEnvLoading();

                fetch('{{ route("environmental-data.get") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        date: date,
                        latitude: parseFloat(latitude),
                        longitude: parseFloat(longitude)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    hideEnvLoading();
                    if (data.success) {
                        showEnvironmentalData(data.data);
                    } else {
                        showEnvError(data.message || 'Errore nel caricamento dei dati ambientali');
                    }
                })
                .catch(error => {
                    hideEnvLoading();
                    showEnvError('Errore di connessione');
                });
            }

            function showEnvLoading() {
                environmentalData.classList.remove('hidden');
                envLoading.classList.remove('hidden');
                envError.classList.add('hidden');
                moonData.classList.add('hidden');
                sunData.classList.add('hidden');
                weatherData.classList.add('hidden');
            }

            function hideEnvLoading() {
                envLoading.classList.add('hidden');
            }

            function showEnvError(message) {
                envErrorMessage.textContent = message;
                envError.classList.remove('hidden');
                envLoading.classList.add('hidden');
                moonData.classList.add('hidden');
                sunData.classList.add('hidden');
                weatherData.classList.add('hidden');
            }

            function showEnvironmentalData(data) {
                // Mostra dati lunari
                if (data.moon && data.moon.success) {
                    document.getElementById('moon-phase').textContent = data.moon.data.phase;
                    document.getElementById('moon-illumination').textContent = data.moon.data.illumination + '%';
                    moonData.classList.remove('hidden');
                }

                // Mostra dati solari
                if (data.sun && data.sun.success) {
                    document.getElementById('sunrise-time').textContent = data.sun.data.sunrise;
                    document.getElementById('sunset-time').textContent = data.sun.data.sunset;
                    document.getElementById('day-length').textContent = data.sun.data.day_length;
                    document.getElementById('solar-noon').textContent = data.sun.data.solar_noon;
                    sunData.classList.remove('hidden');
                }

                // Mostra dati meteo
                if (data.weather && data.weather.success) {
                    document.getElementById('weather-temp').textContent = data.weather.data.temperature + '°C';
                    document.getElementById('weather-desc').textContent = data.weather.data.description;
                    document.getElementById('weather-humidity').textContent = data.weather.data.humidity + '%';
                    document.getElementById('weather-wind').textContent = data.weather.data.wind_speed + ' km/h';
                    weatherData.classList.remove('hidden');
                }

                // Nascondi errori
                envError.classList.add('hidden');
            }

            // Aggiorna dati ambientali quando cambia la posizione
            if (latInput && lngInput) {
                const updateEnvironmentalData = () => {
                    const dateTime = startTimeInput.value;
                    if (dateTime && latInput.value && lngInput.value) {
                        const date = dateTime.split('T')[0];
                        loadEnvironmentalData(date);
                    }
                };

                latInput.addEventListener('change', updateEnvironmentalData);
                lngInput.addEventListener('change', updateEnvironmentalData);
            }

            // Autocaricamento dati ambientali se c'è un punto di pesca preselezionato
            @if(isset($selectedSpotId) && $selectedSpotId)
                // Aspetta che il DOM sia completamente caricato e che la mappa sia inizializzata
                setTimeout(() => {
                    const dateTime = startTimeInput.value;
                    const latitude = latInput.value;
                    const longitude = lngInput.value;
                    
                    if (dateTime && latitude && longitude) {
                        const date = dateTime.split('T')[0];
                        loadEnvironmentalData(date);
                    }
                }, 1000); // Attendi 1 secondo per assicurarsi che tutto sia caricato
            @endif

            // Autocaricamento maree se c'è un punto di pesca preselezionato
            @if(isset($selectedSpotId) && $selectedSpotId)
                setTimeout(() => {
                    const tideLat = tideLatitude.value;
                    const tideLng = tideLongitude.value;
                    const tideDate = tideDate.value;
                    
                    if (tideLat && tideLng) {
                        // Se non c'è una data specifica per le maree, usa la data di inizio
                        const date = tideDate || (startTimeInput.value ? startTimeInput.value.split('T')[0] : null);
                        
                        if (date) {
                            showTideLoading();
                            
                            fetch('{{ route("tides.get-by-coordinates") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    latitude: parseFloat(tideLat),
                                    longitude: parseFloat(tideLng),
                                    date: date
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                hideTideLoading();
                                if (data.success) {
                                    showTideResults(data.data);
                                } else {
                                    showTideError(data.message || 'Errore nel caricamento dei dati maree');
                                }
                            })
                            .catch(error => {
                                hideTideLoading();
                                showTideError('Errore di connessione per i dati maree');
                            });
                        }
                    }
                }, 1500); // Attendi 1.5 secondi per assicurarsi che tutto sia caricato
            @endif
        });
    </script>
</x-app-layout> 