<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.edit_catch') }} - {{ $catch->species }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('catches.update', $catch) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Campo nascosto per il redirect -->
                        @if(request()->get('redirect_to'))
                            <input type="hidden" name="redirect_to" value="{{ request()->get('redirect_to') }}">
                        @endif
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Colonna sinistra -->
                            <div class="space-y-6">
                                <!-- Uscita di pesca -->
                                <div>
                                    <x-input-label for="fishing_trip_id" :value="__('messages.trip')" />
                                    <select id="fishing_trip_id" name="fishing_trip_id" required
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="">{{ __('messages.select_trip') }}</option>
                                        @foreach($trips as $trip)
                                            <option value="{{ $trip->id }}" {{ old('fishing_trip_id', $catch->fishing_trip_id) == $trip->id ? 'selected' : '' }}>
                                                {{ $trip->title }} - {{ $trip->start_time->format('d/m/Y H:i') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('fishing_trip_id')" class="mt-2" />
                                </div>

                                <!-- Specie -->
                                <div>
                                    <x-input-label for="species_select" :value="__('messages.species')" />
                                    <select id="species_select" class="mt-1 block w-full" name="species"></select>
                                    <x-input-error :messages="$errors->get('species')" class="mt-2" />
                                </div>

                                <!-- Data e ora cattura -->
                                <div>
                                    <x-input-label for="catch_time" :value="__('messages.catch_time')" />
                                    <x-text-input id="catch_time" name="catch_time" type="datetime-local" 
                                                 class="mt-1 block w-full" 
                                                 :value="old('catch_time', $catch->catch_time->format('Y-m-d\TH:i'))" required />
                                    <x-input-error :messages="$errors->get('catch_time')" class="mt-2" />
                                </div>

                                <!-- Peso e lunghezza -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="weight" :value="__('messages.weight') . ' (kg)'" />
                                        <x-text-input id="weight" name="weight" type="number" step="0.01" min="0" max="100"
                                                     class="mt-1 block w-full" :value="old('weight', $catch->weight)" />
                                        <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="length" :value="__('messages.length') . ' (cm)'" />
                                        <x-text-input id="length" name="length" type="number" step="0.1" min="0" max="500"
                                                     class="mt-1 block w-full" :value="old('length', $catch->length)" />
                                        <x-input-error :messages="$errors->get('length')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- Esca e tecnica -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="bait_used" :value="__('messages.bait')" />
                                        <x-text-input id="bait_used" name="bait_used" type="text" 
                                                     class="mt-1 block w-full" :value="old('bait_used', $catch->bait_used)" />
                                        <x-input-error :messages="$errors->get('bait_used')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="technique_used" :value="__('messages.technique')" />
                                        <x-text-input id="technique_used" name="technique_used" type="text" 
                                                     class="mt-1 block w-full" :value="old('technique_used', $catch->technique_used)" />
                                        <x-input-error :messages="$errors->get('technique_used')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- Coordinate -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="latitude" :value="__('messages.latitude')" />
                                        <x-text-input id="latitude" name="latitude" type="number" step="0.000001" 
                                                     class="mt-1 block w-full" :value="old('latitude', $catch->latitude)" />
                                        <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="longitude" :value="__('messages.longitude')" />
                                        <x-text-input id="longitude" name="longitude" type="number" step="0.000001" 
                                                     class="mt-1 block w-full" :value="old('longitude', $catch->longitude)" />
                                        <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- Rilasciato -->
                                <div class="flex items-center">
                                    <input id="released" name="released" type="checkbox" 
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                           {{ old('released', $catch->released) ? 'checked' : '' }}>
                                    <x-input-label for="released" :value="__('messages.released')" class="ml-2" />
                                </div>
                            </div>

                            <!-- Colonna destra -->
                            <div class="space-y-6">
                                <!-- Foto attuale -->
                                @if($catch->photo_path)
                                    <div>
                                        <x-input-label :value="__('messages.current_photo')" />
                                        <img src="{{ Storage::url($catch->photo_path) }}" 
                                             alt="{{ $catch->species }}" 
                                             class="mt-2 max-w-xs rounded-lg border border-gray-300">
                                    </div>
                                @endif

                                <!-- Nuova foto -->
                                <div>
                                    <x-input-label for="photo" :value="__('messages.new_photo')" />
                                    <input id="photo" name="photo" type="file" accept="image/*"
                                           class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                                </div>

                                <!-- Note -->
                                <div>
                                    <x-input-label for="notes" :value="__('messages.notes')" />
                                    <textarea id="notes" name="notes" rows="4" 
                                              class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notes', $catch->notes) }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                                </div>

                                <!-- Anteprima foto -->
                                <div id="photo-preview" class="hidden">
                                    <x-input-label :value="__('messages.photo_preview')" />
                                    <img id="preview-image" src="" alt="Preview" 
                                         class="mt-2 max-w-xs rounded-lg border border-gray-300">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 space-x-4">
                            @if(request()->get('redirect_to') === 'fishing-trip')
                                <a href="{{ route('fishing-trips.show', $catch->fishing_trip_id) }}" 
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    {{ __('messages.cancel') }}
                                </a>
                            @else
                                <a href="{{ route('catches.show', $catch) }}" 
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    {{ __('messages.cancel') }}
                                </a>
                            @endif
                            <x-primary-button>
                                {{ __('messages.save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
$(document).ready(function() {
    function formatSpecies(species) {
        if (!species.id) return species.text;
        let desc = species.description ? `<div class='text-xs text-gray-500'>${species.description}</div>` : '';
        return `<div><b>${species.text}</b>${desc}</div>`;
    }
    // Preselezione specie
    let initialData = null;
    @if($catch->species)
        initialData = {
            id: '{{ $catch->species }}',
            text: '{{ $catch->species }}'
        };
    @endif
    $('#species_select').select2({
        placeholder: "{{ __('messages.select_or_type_species') }}",
        minimumInputLength: 2,
        ajax: {
            url: '{{ route('species.search') }}',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return { q: params.term };
            },
            processResults: function(data) {
                return { results: data };
            },
            cache: true
        },
        templateResult: formatSpecies,
        templateSelection: formatSpecies,
        tags: true,
        createTag: function(params) {
            // Se l'utente digita qualcosa che non è nei risultati, crea una specie personalizzata
            if (params.term.trim() === '') {
                return null;
            }
            return {
                id: 'custom_' + params.term,
                text: params.term,
                custom: true
            };
        },
        language: {
            noResults: function() {
                return "{{ __('messages.no_species_found') }}";
            },
            inputTooShort: function() {
                return "{{ __('messages.type_at_least_2_chars') }}";
            }
        },
        escapeMarkup: function (markup) { return markup; },
        allowClear: true,
        data: initialData ? [initialData] : undefined
    });
    if(initialData) {
        let option = new Option(initialData.text, initialData.id, true, true);
        $('#species_select').append(option).trigger('change');
    }
    });
    
    // Anteprima foto
    document.getElementById('photo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('photo-preview');
        const previewImage = document.getElementById('preview-image');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
        }
    });
    </script>
    @endpush
</x-app-layout> 