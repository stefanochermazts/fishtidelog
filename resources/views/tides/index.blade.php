<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.tides') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Sezione di ricerca -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4">{{ __('messages.tides_description') }}</h3>
                        
                        <div class="max-w-2xl">
                            <!-- Ricerca per coordinate -->
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                                <h4 class="font-medium mb-4 text-gray-900 dark:text-gray-100">{{ __('messages.custom_coordinates') }}</h4>
                                
                                <div class="space-y-3">
                                    <!-- Indirizzo per geocoding -->
                                    <div>
                                        <label for="coordinates-address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            {{ __('messages.address_for_geocoding') }}
                                        </label>
                                        <div class="flex space-x-2">
                                            <input type="text" id="coordinates-address" placeholder="{{ __('messages.enter_address_placeholder') }}" class="form-input flex-1">
                                            <button type="button" id="geocode-coordinates-btn" class="btn-primary px-3 py-2 text-sm">
                                                {{ __('messages.find_coordinates_tide') }}
                                            </button>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('messages.address_help') }}</p>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label for="latitude" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                {{ __('messages.latitude') }}
                                            </label>
                                            <input type="number" id="latitude" step="0.000001" placeholder="45.4371" class="form-input w-full bg-neutral-50 dark:bg-neutral-700 text-neutral-500 dark:text-neutral-400" readonly>
                                        </div>
                                        <div>
                                            <label for="longitude" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                {{ __('messages.longitude') }}
                                            </label>
                                            <input type="number" id="longitude" step="0.000001" placeholder="12.3326" class="form-input w-full bg-neutral-50 dark:bg-neutral-700 text-neutral-500 dark:text-neutral-400" readonly>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label for="coordinates-date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            {{ __('messages.tide_date_optional') }}
                                        </label>
                                        <input type="date" id="coordinates-date" class="form-input w-full">
                                    </div>
                                    
                                    <button onclick="getTidesByCoordinates()" class="btn-primary w-full">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ __('messages.search_tides') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Risultati -->
                    <div id="tide-results" class="hidden">
                        <div class="border-t border-gray-200 dark:border-gray-600 pt-6">
                            <h3 class="text-lg font-medium mb-4">{{ __('messages.tide_results') }}</h3>
                            
                            <div id="tide-data" class="space-y-6">
                                <!-- I dati delle maree verranno inseriti qui dinamicamente -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Loading -->
                    <div id="tide-loading" class="hidden">
                        <div class="flex items-center justify-center py-8">
                            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                            <span class="ml-3 text-gray-600 dark:text-gray-400">{{ __('messages.tide_loading') }}</span>
                        </div>
                    </div>
                    
                    <!-- Errore -->
                    <div id="tide-error" class="hidden">
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                            <div class="flex">
                                <svg class="w-5 h-5 text-red-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800 dark:text-red-200">{{ __('messages.tide_error') }}</h3>
                                <div class="mt-2 text-sm text-red-700 dark:text-red-300" id="error-message"></div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Traduzioni per JavaScript
        const translations = {
            selectLocation: '{{ __("messages.select_location_first") }}',
            enterCoordinates: '{{ __("messages.enter_coordinates") }}',
            coordinatesFound: '{{ __("messages.coordinates_found") }}',
            addressNotFound: '{{ __("messages.address_not_found_tide") }}',
            geocodingError: '{{ __("messages.geocoding_error_tide") }}',
            enterAddressFirst: '{{ __("messages.enter_address_first_tide") }}',
            searchingCoordinates: '{{ __("messages.searching_coordinates") }}',
            findCoordinates: '{{ __("messages.find_coordinates_tide") }}',
            tideDataError: '{{ __("messages.tide_data_error") }}',
            connectionError: '{{ __("messages.connection_error") }}',
            tideError: '{{ __("messages.tide_error_message") }}',
            tideCoordinatesError: '{{ __("messages.tide_coordinates_error") }}',
            currentSituation: '{{ __("messages.current_tide") }}',
            currentHeight: '{{ __("messages.current_height") }}',
            currentTime: '{{ __("messages.current_time") }}',
            currentStatus: '{{ __("messages.current_status") }}',
            nextExtremes: '{{ __("messages.next_extremes") }}',
            highTide: '{{ __("messages.high_tide") }}',
            lowTide: '{{ __("messages.low_tide") }}',
            allTidesToday: '{{ __("messages.all_tides_today") }}',
            tideType: '{{ __("messages.tide_type") }}',
            tideHeight: '{{ __("messages.tide_height") }}',
            tideTime: '{{ __("messages.tide_time") }}',
            risingTide: '{{ __("messages.rising_tide") }}',
            fallingTide: '{{ __("messages.falling_tide") }}'
        };

        function showLoading() {
            document.getElementById('tide-loading').classList.remove('hidden');
            document.getElementById('tide-results').classList.add('hidden');
            document.getElementById('tide-error').classList.add('hidden');
        }

        function hideLoading() {
            document.getElementById('tide-loading').classList.add('hidden');
        }

        function showError(message) {
            document.getElementById('error-message').textContent = message;
            document.getElementById('tide-error').classList.remove('hidden');
            document.getElementById('tide-results').classList.add('hidden');
        }

        function showResults(data) {
            const resultsDiv = document.getElementById('tide-results');
            const dataDiv = document.getElementById('tide-data');
            
            let html = '';
            
            if (data.current) {
                html += `
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6">
                        <h4 class="text-lg font-medium text-blue-900 dark:text-blue-100 mb-4">${translations.currentSituation}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">${data.current.height}m</div>
                                <div class="text-sm text-blue-700 dark:text-blue-300">${translations.currentHeight}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-semibold text-blue-600 dark:text-blue-400">${data.current.time}</div>
                                <div class="text-sm text-blue-700 dark:text-blue-300">${translations.currentTime}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-semibold text-blue-600 dark:text-blue-400">${data.current_status}</div>
                                <div class="text-sm text-blue-700 dark:text-blue-300">${translations.currentStatus}</div>
                            </div>
                        </div>
                    </div>
                `;
            }
            
            if (data.next_high || data.next_low) {
                html += `
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-6">
                        <h4 class="text-lg font-medium text-green-900 dark:text-green-100 mb-4">${translations.nextExtremes}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                `;
                
                if (data.next_high) {
                    html += `
                        <div class="text-center">
                            <div class="text-lg font-semibold text-green-600 dark:text-green-400">${translations.highTide}</div>
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">${data.next_high.height}m</div>
                            <div class="text-sm text-green-700 dark:text-green-300">${data.next_high.time}</div>
                        </div>
                    `;
                }
                
                if (data.next_low) {
                    html += `
                        <div class="text-center">
                            <div class="text-lg font-semibold text-green-600 dark:text-green-400">${translations.lowTide}</div>
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">${data.next_low.height}m</div>
                            <div class="text-sm text-green-700 dark:text-green-300">${data.next_low.time}</div>
                        </div>
                    `;
                }
                
                html += `
                        </div>
                    </div>
                `;
            }
            
            if (data.extremes && data.extremes.length > 0) {
                html += `
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">${translations.allTidesToday}</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                <thead class="bg-gray-100 dark:bg-gray-600">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">${translations.tideType}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">${translations.tideHeight}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">${translations.tideTime}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                `;
                
                data.extremes.forEach(extreme => {
                    const isHigh = extreme.type === 'alta';
                    const bgClass = isHigh ? 'bg-blue-50 dark:bg-blue-900/20' : 'bg-yellow-50 dark:bg-yellow-900/20';
                    const textClass = isHigh ? 'text-blue-600 dark:text-blue-400' : 'text-yellow-600 dark:text-yellow-400';
                    
                    html += `
                        <tr class="${bgClass}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ${textClass}">
                                ${extreme.type === 'alta' ? translations.highTide : translations.lowTide}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm ${textClass}">${extreme.height}m</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm ${textClass}">${extreme.time}</td>
                        </tr>
                    `;
                });
                
                html += `
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
            }
            
            dataDiv.innerHTML = html;
            resultsDiv.classList.remove('hidden');
        }



        function getTidesByCoordinates() {
            const latitude = document.getElementById('latitude').value;
            const longitude = document.getElementById('longitude').value;
            const date = document.getElementById('coordinates-date').value;
            
            if (!latitude || !longitude) {
                showError(translations.enterCoordinates);
                return;
            }
            
            showLoading();
            
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
                hideLoading();
                if (data.success) {
                    showResults(data.data);
                } else {
                    showError(data.message || translations.tideDataError);
                }
            })
            .catch(error => {
                hideLoading();
                showError(translations.connectionError);
            });
        }

        // Gestione geocoding per coordinate personalizzate
        document.addEventListener('DOMContentLoaded', function() {
            const geocodeBtn = document.getElementById('geocode-coordinates-btn');
            const addressInput = document.getElementById('coordinates-address');
            const latitudeInput = document.getElementById('latitude');
            const longitudeInput = document.getElementById('longitude');
            
            if (geocodeBtn && addressInput) {
                geocodeBtn.addEventListener('click', function() {
                    const address = addressInput.value.trim();
                    if (!address) {
                        showError(translations.enterAddressFirst);
                        return;
                    }
                    
                    geocodeBtn.disabled = true;
                    geocodeBtn.textContent = translations.searchingCoordinates;
                    
                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}&limit=1`)
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.length > 0) {
                                const lat = parseFloat(data[0].lat);
                                const lng = parseFloat(data[0].lon);
                                
                                // Aggiorna i campi input
                                latitudeInput.value = lat.toFixed(6);
                                longitudeInput.value = lng.toFixed(6);
                                
                                // Mostra messaggio di successo
                                showError(translations.coordinatesFound);
                                setTimeout(() => {
                                    document.getElementById('tide-error').classList.add('hidden');
                                }, 3000);
                                
                            } else {
                                showError(translations.addressNotFound);
                            }
                        })
                        .catch(error => {
                            console.error('Errore geocoding:', error);
                            showError(translations.geocodingError);
                        })
                        .finally(() => {
                            geocodeBtn.disabled = false;
                            geocodeBtn.textContent = translations.findCoordinates;
                        });
                });
            }
        });
    </script>
</x-app-layout> 