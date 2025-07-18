<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="h2 text-neutral-900 dark:text-neutral-100">
                {{ __('messages.fishing_spots_title') }}
            </h2>
            <a href="{{ route('fishing-spots.create') }}" class="btn-secondary">
                {{ __('messages.new_fishing_spot') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="container-wide">
            @if($spots->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($spots as $spot)
                        <div class="card card-hover">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100 truncate">{{ $spot->name }}</h3>
                                        @if($spot->type)
                                            <span class="badge-primary mt-1">
                                                {{ $spot->type }}
                                            </span>
                                        @endif
                                    </div>
                                    @if($spot->is_favorite)
                                        <svg class="w-5 h-5 text-yellow-500 flex-shrink-0 ml-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endif
                                </div>
                                
                                @if($spot->description)
                                    <p class="text-neutral-600 dark:text-neutral-400 text-sm mb-4 line-clamp-2">{{ Str::limit($spot->description, 80) }}</p>
                                @endif
                                
                                <!-- Mappa del punto di pesca -->
                                @if($spot->latitude && $spot->longitude)
                                    <div class="mb-4">
                                        <div id="map-{{ $spot->id }}" class="w-full h-32 map-container"></div>
                                    </div>
                                @endif
                                
                                <div class="space-y-2 text-sm text-neutral-600 dark:text-neutral-400">
                                    @if($spot->address)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="truncate">{{ $spot->address }}</span>
                                        </div>
                                    @endif
                                </div>
                                
                                @if($spot->species_common && count($spot->species_common) > 0)
                                    <div class="mt-4">
                                        <p class="text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">{{ __('messages.common_species') }}:</p>
                                        <div class="flex flex-wrap gap-1">
                                            @foreach(array_slice($spot->species_common, 0, 2) as $species)
                                                <span class="badge-secondary text-xs">
                                                    {{ $species }}
                                                </span>
                                            @endforeach
                                            @if(count($spot->species_common) > 2)
                                                <span class="badge text-xs">
                                                    +{{ count($spot->species_common) - 2 }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="mt-6 flex flex-wrap gap-2 items-center">
                                    <div class="flex flex-wrap gap-2 flex-1 min-w-0">
                                        <a href="{{ route('fishing-spots.show', $spot) }}" class="btn-outline text-sm px-3 py-1.5 min-w-[70px] text-center">{{ __('messages.view') }}</a>
                                        <a href="{{ route('fishing-spots.edit', $spot) }}" class="btn-outline text-sm px-3 py-1.5 min-w-[70px] text-center">{{ __('messages.edit') }}</a>
                                        <form action="{{ route('fishing-spots.destroy', $spot) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5 min-w-[70px] text-center"
                                                    onclick="return confirm('{{ __('messages.confirm_delete_spot') }}')"
                                                    aria-label="{{ __('messages.delete') }} {{ $spot->name }}">
                                                {{ __('messages.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                    
                                    <form method="POST" action="{{ route('fishing-spots.toggle-favorite', $spot) }}" class="inline flex-shrink-0">
                                        @csrf
                                        <button type="submit" 
                                                class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-700 dark:hover:text-yellow-300 transition-colors duration-200 p-1"
                                                aria-label="{{ $spot->is_favorite ? __('messages.remove_from_favorites') : __('messages.add_to_favorites') }}">
                                            @if($spot->is_favorite)
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-6">
                    {{ $spots->links() }}
                </div>
            @else
                <div class="card">
                    <div class="p-6 text-center">
                        <svg class="w-6 h-6 text-neutral-400 dark:text-neutral-500 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-neutral-600 dark:text-neutral-400 mb-4">{{ __('messages.no_spots') }}</p>
                        <a href="{{ route('fishing-spots.create') }}" class="btn-secondary">
                            {{ __('messages.add_first_spot') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inizializza le mappe per ogni punto di pesca
            @foreach($spots as $spot)
                @if($spot->latitude && $spot->longitude)
                    var map{{ $spot->id }} = L.map('map-{{ $spot->id }}').setView([{{ $spot->latitude }}, {{ $spot->longitude }}], 13);
                    
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map{{ $spot->id }});
                    
                    var marker{{ $spot->id }} = L.marker([{{ $spot->latitude }}, {{ $spot->longitude }}], {
                        icon: L.divIcon({
                            className: 'custom-marker',
                            html: '<div style="background-color: #3b82f6; width: 48px; height: 48px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;"><svg width="24" height="24" fill="white" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>',
                            iconSize: [48, 48],
                            iconAnchor: [24, 24]
                        })
                    }).addTo(map{{ $spot->id }});
                    
                    marker{{ $spot->id }}.bindPopup(`
                        <div class="text-center">
                            <h3 class="font-semibold text-sm">{{ $spot->name }}</h3>
                            @if($spot->type)
                                <p class="text-xs text-gray-600">{{ $spot->type }}</p>
                            @endif
                            @if($spot->address)
                                <p class="text-xs text-gray-500">{{ $spot->address }}</p>
                            @endif
                        </div>
                    `);
                @endif
            @endforeach
        });
    </script>
    @endpush
</x-app-layout> 