<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="h2 text-neutral-900 dark:text-neutral-100">
                {{ __('messages.catches') }}
            </h2>
            <a href="{{ route('catches.create') }}" class="btn-accent">
                {{ __('messages.add_catch') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="container-wide">
            @if($catches->count() > 0)
                <div class="grid-responsive">
                            @foreach($catches as $catch)
                                <div class="card card-hover">
                                    @if($catch->photo_path)
                                        <img src="{{ Storage::url($catch->photo_path) }}" 
                                             alt="{{ $catch->species }}" 
                                             class="w-full h-48 object-cover rounded-t-2xl">
                                    @else
                                        <div class="w-full h-48 bg-neutral-200 dark:bg-neutral-700 flex items-center justify-center rounded-t-2xl">
                                            <span class="text-neutral-400 dark:text-neutral-500 text-4xl">🐟</span>
                                        </div>
                                    @endif
                                    
                                    <div class="p-6">
                                        <div class="flex justify-between items-start mb-4">
                                            <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">{{ $catch->species }}</h3>
                                            @if($catch->released)
                                                <span class="badge-accent">
                                                    {{ __('messages.released') }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="space-y-2 text-sm text-neutral-600 dark:text-neutral-400">
                                            <p><strong>{{ __('messages.trip') }}:</strong> {{ $catch->fishingTrip->title }}</p>
                                            <p><strong>{{ __('messages.date') }}:</strong> {{ $catch->catch_time->format('d/m/Y H:i') }}</p>
                                            @if($catch->weight)
                                                <p><strong>{{ __('messages.weight') }}:</strong> {{ $catch->formatted_weight }}</p>
                                            @endif
                                            @if($catch->length)
                                                <p><strong>{{ __('messages.length') }}:</strong> {{ $catch->formatted_length }}</p>
                                            @endif
                                            @if($catch->bait_used)
                                                <p><strong>{{ __('messages.bait') }}:</strong> {{ $catch->bait_used }}</p>
                                            @endif
                                            @if($catch->technique_used)
                                                <p><strong>{{ __('messages.technique') }}:</strong> {{ $catch->technique_used }}</p>
                                            @endif
                                        </div>
                                        
                                        @if($catch->notes)
                                            <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-4 italic">"{{ $catch->notes }}"</p>
                                        @endif
                                        
                                        <div class="flex flex-wrap gap-2 items-center mt-6 pt-4 border-t border-neutral-200 dark:border-neutral-700">
                                            <div class="flex flex-wrap gap-2 flex-1 min-w-0">
                                                <a href="{{ route('catches.show', $catch) }}" 
                                                   class="btn-outline text-sm px-3 py-1.5 min-w-[70px] text-center">
                                                    {{ __('messages.view') }}
                                                </a>
                                                <a href="{{ route('catches.edit', $catch) }}" 
                                                   class="btn-outline text-sm px-3 py-1.5 min-w-[70px] text-center">
                                                    {{ __('messages.edit') }}
                                                </a>
                                                <form action="{{ route('catches.destroy', $catch) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5 min-w-[70px] text-center"
                                                            onclick="return confirm('{{ __('messages.confirm_delete_catch') }}')">
                                                        {{ __('messages.delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="p-6 text-center">
                        <div class="text-6xl mb-4">🐟</div>
                        <h3 class="text-lg font-medium text-neutral-900 dark:text-neutral-100 mb-2">{{ __('messages.no_catches_yet') }}</h3>
                        <p class="text-neutral-600 dark:text-neutral-400 mb-4">{{ __('messages.start_fishing_message') }}</p>
                        <a href="{{ route('catches.create') }}" class="btn-accent">
                            {{ __('messages.add_first_catch') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout> 