<x-app-layout>
    <x-slot name="header">
        <h2 class="h2 text-neutral-900 dark:text-neutral-100">
            {{ __('messages.add_catch') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="container-wide">
            <div class="card">
                <div class="p-6">
                    <form action="{{ route('catches.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Campo nascosto per il redirect -->
                        @if(isset($redirectTo))
                            <input type="hidden" name="redirect_to" value="{{ $redirectTo }}">
                        @endif
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Colonna sinistra -->
                            <div class="space-y-6">
                                <!-- Uscita di pesca -->
                                <div>
                                    <label for="fishing_trip_id" class="form-label">{{ __('messages.trip') }}</label>
                                    <select id="fishing_trip_id" name="fishing_trip_id" required
                                            class="form-input">
                                        <option value="">{{ __('messages.select_trip') }}</option>
                                        @foreach($trips as $trip)
                                            <option value="{{ $trip->id }}" 
                                                {{ old('fishing_trip_id', $selectedTripId ?? '') == $trip->id ? 'selected' : '' }}>
                                                {{ $trip->title }} - {{ $trip->start_time->format('d/m/Y H:i') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fishing_trip_id')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Specie -->
                                <div>
                                    <label for="species_select" class="form-label">{{ __('messages.species') }}</label>
                                    <select id="species_select" class="form-input" name="species"></select>
                                    @error('species')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Data e ora cattura -->
                                <div>
                                    <label for="catch_time" class="form-label">{{ __('messages.catch_time') }}</label>
                                    <input id="catch_time" name="catch_time" type="datetime-local" 
                                           class="form-input" value="{{ old('catch_time', now()->format('Y-m-d\TH:i')) }}" required />
                                    @error('catch_time')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Peso e lunghezza -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="weight" class="form-label">{{ __('messages.weight') }} (kg)</label>
                                        <input id="weight" name="weight" type="number" step="0.01" min="0" max="100"
                                               class="form-input" value="{{ old('weight') }}" />
                                        @error('weight')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="length" class="form-label">{{ __('messages.length') }} (cm)</label>
                                        <input id="length" name="length" type="number" step="0.1" min="0" max="500"
                                               class="form-input" value="{{ old('length') }}" />
                                        @error('length')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Esca e tecnica -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="bait_used" class="form-label">{{ __('messages.bait') }}</label>
                                        <input id="bait_used" name="bait_used" type="text" 
                                               class="form-input" value="{{ old('bait_used') }}" />
                                        @error('bait_used')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="technique_used" class="form-label">{{ __('messages.technique') }}</label>
                                        <input id="technique_used" name="technique_used" type="text" 
                                               class="form-input" value="{{ old('technique_used') }}" />
                                        @error('technique_used')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Coordinate -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="latitude" class="form-label">{{ __('messages.latitude') }}</label>
                                        <input id="latitude" name="latitude" type="number" step="0.000001" 
                                               class="form-input" value="{{ old('latitude') }}" />
                                        @error('latitude')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="longitude" class="form-label">{{ __('messages.longitude') }}</label>
                                        <input id="longitude" name="longitude" type="number" step="0.000001" 
                                               class="form-input" value="{{ old('longitude') }}" />
                                        @error('longitude')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Rilasciato -->
                                <div class="flex items-center">
                                    <input id="released" name="released" type="checkbox" 
                                           class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-neutral-300 dark:border-neutral-600 rounded"
                                           {{ old('released') ? 'checked' : '' }}>
                                    <label for="released" class="ml-2 block text-sm text-neutral-900 dark:text-neutral-100">
                                        {{ __('messages.released') }}
                                    </label>
                                </div>
                            </div>

                            <!-- Colonna destra -->
                            <div class="space-y-6">
                                <!-- Foto -->
                                <div>
                                    <label for="photo" class="form-label">{{ __('messages.photo') }}</label>
                                    <input id="photo" name="photo" type="file" accept="image/*"
                                           class="mt-1 block w-full text-sm text-neutral-500 dark:text-neutral-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 dark:file:bg-primary-900/30 file:text-primary-700 dark:file:text-primary-400 hover:file:bg-primary-100 dark:hover:file:bg-primary-900/50" />
                                    @error('photo')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Note -->
                                <div>
                                    <label for="notes" class="form-label">{{ __('messages.notes') }}</label>
                                    <textarea id="notes" name="notes" rows="4" 
                                              class="form-input">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Anteprima foto -->
                                <div id="photo-preview" class="hidden">
                                    <label class="form-label">{{ __('messages.photo_preview') }}</label>
                                    <img id="preview-image" src="" alt="Preview" 
                                         class="mt-2 max-w-xs rounded-lg border border-neutral-300 dark:border-neutral-600">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 space-x-4">
                            @if(isset($redirectTo) && $redirectTo === 'fishing-trip' && isset($selectedTripId))
                                <a href="{{ route('fishing-trips.show', $selectedTripId) }}" 
                                   class="btn-secondary">
                                    {{ __('messages.cancel') }}
                                </a>
                            @else
                                <a href="{{ route('catches.index') }}" 
                                   class="btn-secondary">
                                    {{ __('messages.cancel') }}
                                </a>
                            @endif
                            <button type="submit" class="btn-primary">
                                {{ __('messages.save_catch') }}
                            </button>
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
            let desc = species.description ? `<div class='text-xs text-neutral-500 dark:text-neutral-400'>${species.description}</div>` : '';
            return `<div><b>${species.text}</b>${desc}</div>`;
        }
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
                    id: params.term,
                    text: params.term
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
            escapeMarkup: function (markup) { return markup; }
        });
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