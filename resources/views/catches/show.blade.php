<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $catch->species }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('catches.edit', $catch) }}" 
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('messages.edit') }}
                </a>
                <form action="{{ route('catches.destroy', $catch) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                            onclick="return confirm('{{ __('messages.confirm_delete_catch') }}')">
                        {{ __('messages.delete') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Colonna sinistra - Foto e dettagli principali -->
                        <div>
                            @if($catch->photo_path)
                                <div class="mb-6">
                                                                    <img src="{{ Storage::url($catch->photo_path) }}" 
                                     alt="{{ $catch->species }}" 
                                     class="w-full h-96 object-cover rounded-lg shadow-lg">
                                </div>
                            @else
                                <div class="mb-6 w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-400 text-8xl">🐟</span>
                                </div>
                            @endif

                            <!-- Dettagli principali -->
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $catch->species }}</h3>
                                    @if($catch->released)
                                        <span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">
                                            {{ __('messages.released') }}
                                        </span>
                                    @else
                                        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                                            {{ __('messages.kept') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    @if($catch->weight)
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <p class="text-sm text-gray-600">{{ __('messages.weight') }}</p>
                                            <p class="text-xl font-bold text-gray-900">{{ $catch->formatted_weight }}</p>
                                        </div>
                                    @endif
                                    @if($catch->length)
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <p class="text-sm text-gray-600">{{ __('messages.length') }}</p>
                                            <p class="text-xl font-bold text-gray-900">{{ $catch->formatted_length }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Colonna destra - Informazioni dettagliate -->
                        <div class="space-y-6">
                            <!-- Informazioni sull'uscita -->
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-blue-900 mb-2">{{ __('messages.trip') }}</h4>
                                <p class="text-blue-800">{{ $catch->fishingTrip->title }}</p>
                                <p class="text-sm text-blue-600">{{ $catch->fishingTrip->start_time->format('d/m/Y H:i') }}</p>
                                <a href="{{ route('fishing-trips.show', $catch->fishingTrip) }}" 
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    {{ __('messages.view') }} {{ __('messages.trip') }}
                                </a>
                            </div>

                            <!-- Informazioni sulla specie -->
                            <div class="bg-indigo-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-indigo-900 mb-2">{{ __('messages.species') }}</h4>
                                <p class="text-indigo-800 font-medium">{{ $catch->species }}</p>
                            </div>

                            <!-- Data e ora cattura -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">{{ __('messages.catch_time') }}</h4>
                                <p class="text-gray-800">{{ $catch->catch_time->format('d/m/Y H:i') }}</p>
                            </div>

                            <!-- Tecniche e esche -->
                            @if($catch->bait_used || $catch->technique_used)
                                <div class="bg-green-50 p-4 rounded-lg">
                                    <h4 class="font-semibold text-green-900 mb-2">{{ __('messages.fishing_details') }}</h4>
                                    @if($catch->bait_used)
                                        <div class="mb-2">
                                            <p class="text-sm text-green-600">{{ __('messages.bait') }}</p>
                                            <p class="text-green-800">{{ $catch->bait_used }}</p>
                                        </div>
                                    @endif
                                    @if($catch->technique_used)
                                        <div>
                                            <p class="text-sm text-green-600">{{ __('messages.technique') }}</p>
                                            <p class="text-green-800">{{ $catch->technique_used }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <!-- Coordinate -->
                            @if($catch->latitude && $catch->longitude)
                                <div class="bg-purple-50 p-4 rounded-lg">
                                    <h4 class="font-semibold text-purple-900 mb-2">{{ __('messages.location') }}</h4>
                                    <p class="text-sm text-purple-600">{{ __('messages.latitude') }}</p>
                                    <p class="text-purple-800">{{ $catch->latitude }}</p>
                                    <p class="text-sm text-purple-600 mt-1">{{ __('messages.longitude') }}</p>
                                    <p class="text-purple-800">{{ $catch->longitude }}</p>
                                </div>
                            @endif

                            <!-- Note -->
                            @if($catch->notes)
                                <div class="bg-yellow-50 p-4 rounded-lg">
                                    <h4 class="font-semibold text-yellow-900 mb-2">{{ __('messages.notes') }}</h4>
                                    <p class="text-yellow-800 italic">"{{ $catch->notes }}"</p>
                                </div>
                            @endif

                            <!-- Azioni -->
                            <div class="flex space-x-4 pt-4">
                                <a href="{{ route('catches.index') }}" 
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    {{ __('messages.back') }}
                                </a>
                                <a href="{{ route('catches.edit', $catch) }}" 
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    {{ __('messages.edit') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 