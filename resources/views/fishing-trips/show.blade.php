<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $fishingTrip->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('fishing-trips.edit', $fishingTrip) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('messages.edit') }}
                </a>
                @if(!$fishingTrip->end_time)
                    <form method="POST" action="{{ route('fishing-trips.end', $fishingTrip) }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('messages.end_trip') }}
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('messages.trip_details') }}</h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <span class="font-medium text-gray-700">{{ __('messages.title') }}:</span>
                                    <span class="ml-2 text-gray-900">{{ $fishingTrip->title }}</span>
                                </div>
                                
                                @if($fishingTrip->description)
                                    <div>
                                        <span class="font-medium text-gray-700">{{ __('messages.description') }}:</span>
                                        <p class="mt-1 text-gray-900">{{ $fishingTrip->description }}</p>
                                    </div>
                                @endif
                                
                                <div>
                                    <span class="font-medium text-gray-700">{{ __('messages.start_time') }}:</span>
                                    <span class="ml-2 text-gray-900">{{ $fishingTrip->start_time->format('d/m/Y H:i') }}</span>
                                </div>
                                
                                @if($fishingTrip->end_time)
                                    <div>
                                        <span class="font-medium text-gray-700">{{ __('messages.end_time') }}:</span>
                                        <span class="ml-2 text-gray-900">{{ $fishingTrip->end_time->format('d/m/Y H:i') }}</span>
                                    </div>
                                    
                                    <div>
                                        <span class="font-medium text-gray-700">{{ __('messages.duration') }}:</span>
                                        <span class="ml-2 text-gray-900">{{ $fishingTrip->duration }}</span>
                                    </div>
                                @else
                                    <div>
                                        <span class="font-medium text-gray-700">Stato:</span>
                                        <span class="ml-2 text-green-600 font-medium">{{ __('messages.in_progress') }}</span>
                                    </div>
                                @endif
                                
                                @if($fishingTrip->location_name)
                                    <div>
                                        <span class="font-medium text-gray-700">{{ __('messages.location_name') }}:</span>
                                        <span class="ml-2 text-gray-900">{{ $fishingTrip->location_name }}</span>
                                    </div>
                                @endif
                                
                                @if($fishingTrip->latitude && $fishingTrip->longitude)
                                    <div>
                                        <span class="font-medium text-gray-700">{{ __('messages.location') }}:</span>
                                        <div id="map" class="w-full h-64 mt-2 rounded-lg border border-gray-300"></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('messages.trip_statistics') }}</h3>
                            
                            <div class="space-y-3">
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <div class="text-2xl font-bold text-blue-600">{{ $fishingTrip->total_catches }}</div>
                                    <div class="text-sm text-blue-600">{{ __('messages.total_catches') }}</div>
                                </div>
                                
                                <div class="bg-green-50 p-4 rounded-lg">
                                    <div class="text-2xl font-bold text-green-600">{{ number_format($fishingTrip->total_weight, 1) }} kg</div>
                                    <div class="text-sm text-green-600">{{ __('messages.total_weight') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($fishingTrip->catches->count() > 0)
                        <div class="mt-8">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ __('messages.trip_catches') }}</h3>
                                <a href="{{ route('catches.create', ['fishing_trip_id' => $fishingTrip->id, 'redirect_to' => 'fishing-trip']) }}" 
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    {{ __('messages.new_catch') }}
                                </a>
                            </div>
                            <div class="space-y-3">
                                @foreach($fishingTrip->catches as $catch)
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ $catch->species }}</h4>
                                                <p class="text-sm text-gray-600">{{ $catch->catch_time->format('H:i') }}</p>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <div class="text-right">
                                                    @if($catch->weight)
                                                        <p class="text-sm font-medium text-gray-900">{{ $catch->formatted_weight }}</p>
                                                    @endif
                                                    @if($catch->length)
                                                        <p class="text-sm text-gray-600">{{ $catch->formatted_length }}</p>
                                                    @endif
                                                </div>
                                                <a href="{{ route('catches.edit', ['catch' => $catch, 'redirect_to' => 'fishing-trip']) }}" 
                                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                    {{ __('messages.edit') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="mt-8 text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                            <p class="text-gray-600 mb-4">{{ __('messages.no_catches_recorded') }}</p>
                            <a href="{{ route('catches.create', ['fishing_trip_id' => $fishingTrip->id, 'redirect_to' => 'fishing-trip']) }}" 
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                {{ __('messages.new_catch') }}
                            </a>
                        </div>
                    @endif
                    
                    <!-- Sezione Maree -->
                    @if($fishingTrip->latitude && $fishingTrip->longitude)
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('messages.tide_information') }}</h3>
                            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="text-lg font-medium text-blue-900 dark:text-blue-100">{{ __('messages.tide_chart') }}</h4>
                                    <div class="flex items-center space-x-2">
                                        <span id="tide-cache-status" class="text-xs text-gray-500 hidden">
                                            <span id="cache-indicator" class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium"></span>
                                        </span>
                                        <button id="load-tides-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                                            {{ __('messages.load_tide_data') }}
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Loading -->
                                <div id="tide-loading" class="hidden">
                                    <div class="flex items-center justify-center py-8">
                                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                                        <span class="ml-3 text-blue-600">{{ __('messages.loading_tide_data') }}</span>
                                    </div>
                                </div>
                                
                                <!-- Grafico maree -->
                                <div id="tide-chart-container" class="hidden">
                                    <div class="relative" style="height: 300px;">
                                        <canvas id="tide-chart"></canvas>
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
                                                <div class="mt-2 text-sm text-red-700 dark:text-red-300" id="tide-error-message"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Informazioni maree -->
                                <div id="tide-info" class="hidden mt-4">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400" id="current-height">-</div>
                                            <div class="text-sm text-blue-700 dark:text-blue-300">{{ __('messages.current_height') }}</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-lg font-semibold text-blue-600 dark:text-blue-400" id="current-time">-</div>
                                            <div class="text-sm text-blue-700 dark:text-blue-300">{{ __('messages.current_time') }}</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-lg font-semibold text-blue-600 dark:text-blue-400" id="current-status">-</div>
                                            <div class="text-sm text-blue-700 dark:text-blue-300">{{ __('messages.current_status') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    @if($fishingTrip->latitude && $fishingTrip->longitude)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Inizializza la mappa
                var map = L.map('map').setView([{{ $fishingTrip->latitude }}, {{ $fishingTrip->longitude }}], 13);
                
                // Aggiungi il layer di OpenStreetMap
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                
                // Aggiungi un marker per la posizione del fishing trip
                var marker = L.marker([{{ $fishingTrip->latitude }}, {{ $fishingTrip->longitude }}], {
                    icon: L.divIcon({
                        className: 'custom-marker',
                        html: '<div style="background-color: #10b981; width: 48px; height: 48px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;"><svg width="24" height="24" fill="white" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>',
                        iconSize: [48, 48],
                        iconAnchor: [24, 24]
                    })
                }).addTo(map);
                
                // Aggiungi un popup con le informazioni del fishing trip
                marker.bindPopup(`
                    <div class="text-center">
                        <h3 class="font-semibold text-lg">{{ $fishingTrip->title }}</h3>
                        @if($fishingTrip->location_name)
                            <p class="text-sm text-gray-600">{{ $fishingTrip->location_name }}</p>
                        @endif
                        <p class="text-xs text-gray-500">{{ $fishingTrip->start_time->format('d/m/Y H:i') }}</p>
                    </div>
                `);
            });
        </script>
        
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const loadTidesBtn = document.getElementById('load-tides-btn');
                const tideLoading = document.getElementById('tide-loading');
                const tideChartContainer = document.getElementById('tide-chart-container');
                const tideError = document.getElementById('tide-error');
                const tideInfo = document.getElementById('tide-info');
                const tideErrorMessage = document.getElementById('tide-error-message');
                const tideCacheStatus = document.getElementById('tide-cache-status');
                const cacheIndicator = document.getElementById('cache-indicator');
                
                let tideChart = null;
                
                if (loadTidesBtn) {
                    loadTidesBtn.addEventListener('click', function() {
                        loadTideData();
                    });
                }
                
                function showTideLoading() {
                    tideLoading.classList.remove('hidden');
                    tideChartContainer.classList.add('hidden');
                    tideError.classList.add('hidden');
                    tideInfo.classList.add('hidden');
                }
                
                function hideTideLoading() {
                    tideLoading.classList.add('hidden');
                }
                
                function showTideError(message) {
                    tideErrorMessage.textContent = message;
                    tideError.classList.remove('hidden');
                    tideChartContainer.classList.add('hidden');
                    tideInfo.classList.add('hidden');
                }
                
                function loadTideData() {
                    showTideLoading();
                    
                    const tripDate = '{{ $fishingTrip->start_time->format("Y-m-d") }}';
                    const latitude = {{ $fishingTrip->latitude }};
                    const longitude = {{ $fishingTrip->longitude }};
                    
                    fetch('{{ route("tides.get-by-coordinates") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            latitude: latitude,
                            longitude: longitude,
                            date: tripDate
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        hideTideLoading();
                        if (data.success) {
                            createTideChart(data.data);
                            updateTideInfo(data.data);
                            
                            // Mostra indicatore del cache
                            if (data.from_cache) {
                                cacheIndicator.className = 'inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
                                cacheIndicator.textContent = '{{ __("messages.from_cache") }}';
                            } else {
                                cacheIndicator.className = 'inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
                                cacheIndicator.textContent = '{{ __("messages.from_api") }}';
                            }
                            tideCacheStatus.classList.remove('hidden');
                        } else {
                            showTideError(data.message || '{{ __("messages.tide_data_error") }}');
                        }
                    })
                    .catch(error => {
                        hideTideLoading();
                        showTideError('{{ __("messages.connection_error") }}');
                    });
                }
                
                function createTideChart(tideData) {
                    // Distruggi il grafico esistente se presente
                    if (tideChart) {
                        tideChart.destroy();
                    }
                    
                    const ctx = document.getElementById('tide-chart').getContext('2d');
                    
                    // Prepara i dati per il grafico
                    const labels = [];
                    const heights = [];
                    const tripStartTime = '{{ $fishingTrip->start_time->format("H:i") }}';
                    const tripEndTime = '{{ $fishingTrip->end_time ? $fishingTrip->end_time->format("H:i") : "" }}';
                    
                    // Aggiungi i dati delle maree
                    if (tideData.extremes) {
                        tideData.extremes.forEach(extreme => {
                            labels.push(extreme.time);
                            heights.push(extreme.height);
                        });
                    }
                    
                    // Aggiungi dati intermedi per una curva più fluida
                    if (tideData.heights) {
                        tideData.heights.forEach(height => {
                            labels.push(height.time);
                            heights.push(height.height);
                        });
                    }
                    
                    // Ordina i dati per ora
                    const sortedData = labels.map((label, index) => ({
                        time: label,
                        height: heights[index]
                    })).sort((a, b) => {
                        const timeA = new Date('2000-01-01 ' + a.time);
                        const timeB = new Date('2000-01-01 ' + b.time);
                        return timeA - timeB;
                    });
                    
                    const sortedLabels = sortedData.map(d => d.time);
                    const sortedHeights = sortedData.map(d => d.height);
                    
                    // Trova l'indice dell'ora di inizio e fine del fishing trip
                    const tripStartIndex = sortedLabels.findIndex(time => time >= tripStartTime);
                    const tripEndIndex = tripEndTime ? sortedLabels.findIndex(time => time >= tripEndTime) : -1;
                    
                    tideChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: sortedLabels,
                            datasets: [{
                                label: '{{ __("messages.tide_height") }}',
                                data: sortedHeights,
                                borderColor: 'rgb(59, 130, 246)',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                title: {
                                    display: true,
                                    text: '{{ __("messages.tide_chart_title") }} - {{ $fishingTrip->start_time->format("d/m/Y") }}',
                                    color: 'rgb(17, 24, 39)',
                                    font: {
                                        size: 16,
                                        weight: 'bold'
                                    }
                                },
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return '{{ __("messages.tide_height") }}: ' + context.parsed.y + 'm';
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: '{{ __("messages.time") }}',
                                        color: 'rgb(107, 114, 128)'
                                    },
                                    ticks: {
                                        color: 'rgb(107, 114, 128)'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: '{{ __("messages.height_m") }}',
                                        color: 'rgb(107, 114, 128)'
                                    },
                                    ticks: {
                                        color: 'rgb(107, 114, 128)'
                                    }
                                }
                            }
                        }
                    });
                    
                    // Aggiungi informazioni sui tempi del fishing trip
                    if (tripStartIndex >= 0 || tripEndIndex >= 0) {
                        const tripInfo = document.createElement('div');
                        tripInfo.className = 'mt-4 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg';
                        tripInfo.innerHTML = `
                            <h5 class="font-medium text-green-900 dark:text-green-100 mb-2">{{ __("messages.fishing_trip_times") }}</h5>
                            <div class="text-sm text-green-700 dark:text-green-300">
                                <p><strong>{{ __("messages.trip_start") }}:</strong> ${tripStartTime}</p>
                                ${tripEndTime ? `<p><strong>{{ __("messages.trip_end") }}:</strong> ${tripEndTime}</p>` : ''}
                            </div>
                        `;
                        tideChartContainer.appendChild(tripInfo);
                    }
                    
                    tideChartContainer.classList.remove('hidden');
                }
                
                function updateTideInfo(tideData) {
                    if (tideData.current) {
                        document.getElementById('current-height').textContent = tideData.current.height + 'm';
                        document.getElementById('current-time').textContent = tideData.current.time;
                        document.getElementById('current-status').textContent = tideData.current_status || '{{ __("messages.unknown") }}';
                        tideInfo.classList.remove('hidden');
                    }
                }
            });
        </script>
    @endif
</x-app-layout> 