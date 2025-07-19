<x-app-layout>
    <x-slot name="header">
        <h2 class="h2 text-neutral-900 dark:text-neutral-100">
            {{ __('messages.edit_fishing_trip') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="container-wide">
            <div class="card">
                <div class="p-6">
                    <form method="POST" action="{{ route('fishing-trips.update', $fishingTrip) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Campo nascosto per il redirect -->
                        @if(request()->get('redirect_to'))
                            <input type="hidden" name="redirect_to" value="{{ request()->get('redirect_to') }}">
                        @endif
                        
                        <div>
                            <label for="title" class="form-label">{{ __('messages.title') }} *</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $fishingTrip->title) }}" required
                                class="form-input">
                            @error('title')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="form-label">{{ __('messages.description') }}</label>
                            <textarea name="description" id="description" rows="3"
                                class="form-input">{{ old('description', $fishingTrip->description) }}</textarea>
                            @error('description')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="start_time" class="form-label">{{ __('messages.start_time') }} *</label>
                                <input type="datetime-local" name="start_time" id="start_time" 
                                    value="{{ old('start_time', $fishingTrip->start_time->format('Y-m-d\TH:i')) }}" required
                                    class="form-input">
                                @error('start_time')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="end_time" class="form-label">{{ __('messages.end_time') }}</label>
                                <input type="datetime-local" name="end_time" id="end_time" 
                                    value="{{ old('end_time', $fishingTrip->end_time ? $fishingTrip->end_time->format('Y-m-d\TH:i') : '') }}"
                                    class="form-input">
                                @error('end_time')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
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
                                            {{ old('fishing_spot_id', $fishingTrip->fishing_spot_id) == $spot->id ? 'selected' : '' }}
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
                            <input type="text" name="location_name" id="location_name" value="{{ old('location_name', $fishingTrip->location_name) }}"
                                class="form-input">
                            @error('location_name')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="latitude" class="form-label">{{ __('messages.latitude') }}</label>
                                <input type="number" step="any" name="latitude" id="latitude" value="{{ old('latitude', $fishingTrip->latitude) }}" readonly
                                    class="form-input bg-neutral-50 dark:bg-neutral-700 text-neutral-500 dark:text-neutral-400">
                                @error('latitude')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="longitude" class="form-label">{{ __('messages.longitude') }}</label>
                                <input type="number" step="any" name="longitude" id="longitude" value="{{ old('longitude', $fishingTrip->longitude) }}" readonly
                                    class="form-input bg-neutral-50 dark:bg-neutral-700 text-neutral-500 dark:text-neutral-400">
                                @error('longitude')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Sezione Maree -->
                        <div class="border-t border-neutral-200 dark:border-neutral-600 pt-6">
                            <h3 class="text-lg font-medium text-neutral-900 dark:text-neutral-100 mb-4">Informazioni Maree</h3>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-4">
                                💡 <strong>Suggerimento:</strong> Le coordinate vengono prese automaticamente dalla posizione dell'uscita. Se manca la data, verrà utilizzata automaticamente la data di inizio.
                            </p>
                            
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
                            <input type="checkbox" name="is_public" id="is_public" value="1" 
                                {{ old('is_public', $fishingTrip->is_public) ? 'checked' : '' }}
                                class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-neutral-300 dark:border-neutral-600 rounded">
                            <label for="is_public" class="ml-2 block text-sm text-neutral-900 dark:text-neutral-100">
                                {{ __('messages.is_public') }}
                            </label>
                        </div>

                        <div class="flex justify-end space-x-3 mt-6">
                            @if(request()->get('redirect_to') === 'fishing-spot' && $fishingTrip->fishing_spot_id)
                                <a href="{{ route('fishing-spots.show', $fishingTrip->fishing_spot_id) }}" 
                                   class="btn-secondary">
                                    {{ __('messages.cancel') }}
                                </a>
                            @else
                                <a href="{{ route('fishing-trips.show', $fishingTrip) }}" 
                                   class="btn-secondary">
                                    {{ __('messages.cancel') }}
                                </a>
                            @endif
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementi per le maree
            const getTidesBtn = document.getElementById('get-tides-btn');
            const tideDate = document.getElementById('tide_date');
            const tideResults = document.getElementById('tide-results');
            const tideLoading = document.getElementById('tide-loading');
            const tideError = document.getElementById('tide-error');
            const tideData = document.getElementById('tide-data');
            const tideErrorMessage = document.getElementById('tide-error-message');
            
            // Elementi dell'uscita di pesca
            const startTime = document.getElementById('start_time');
            const latitude = document.getElementById('latitude');
            const longitude = document.getElementById('longitude');
            const fishingSpotSelect = document.getElementById('fishing_spot_id');
            
            // Event listener per il cambio del punto di pesca
            if (fishingSpotSelect) {
                fishingSpotSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    if (selectedOption && selectedOption.dataset.lat && selectedOption.dataset.lng) {
                        // Aggiorna le coordinate dell'uscita
                        latitude.value = selectedOption.dataset.lat;
                        longitude.value = selectedOption.dataset.lng;
                    }
                });
            }
            
            // Gestione maree
            if (getTidesBtn) {
                getTidesBtn.addEventListener('click', function() {
                    // Usa le coordinate dalla posizione dell'uscita
                    const tripLatitude = latitude.value;
                    const tripLongitude = longitude.value;
                    
                    // Se non c'è una data per le maree, usa la data di inizio
                    let date = tideDate.value;
                    if (!date && startTime.value) {
                        date = startTime.value.split('T')[0];
                    }
                    
                    if (!tripLatitude || !tripLongitude) {
                        showTideError('Prima aggiungi le coordinate dell\'uscita di pesca');
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
                            latitude: parseFloat(tripLatitude),
                            longitude: parseFloat(tripLongitude),
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
        });
    </script>
</x-app-layout> 