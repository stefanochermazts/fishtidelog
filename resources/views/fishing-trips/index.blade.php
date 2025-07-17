<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="h2 text-neutral-900 dark:text-neutral-100">
                {{ __('messages.fishing_trips_title') }}
            </h2>
            <a href="{{ route('fishing-trips.create') }}" class="btn-primary">
                {{ __('messages.new_fishing_trip') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="container-wide">
            @if($trips->count() > 0)
                <div class="card">
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($trips as $trip)
                                <div class="border border-neutral-200 dark:border-neutral-700 rounded-2xl p-4 hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors duration-200">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">{{ $trip->title }}</h3>
                                            <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ $trip->start_time->format('d/m/Y H:i') }}</p>
                                            @if($trip->location_name)
                                                <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ $trip->location_name }}</p>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ $trip->duration }}</p>
                                            <p class="text-sm font-medium text-neutral-900 dark:text-neutral-100">{{ $trip->total_catches }} {{ __('messages.total_catches') }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex flex-wrap gap-2 items-center">
                                        <div class="flex flex-wrap gap-2 flex-1 min-w-0">
                                            <a href="{{ route('fishing-trips.show', $trip) }}" class="btn-outline text-sm px-3 py-1.5 min-w-[70px] text-center">{{ __('messages.view') }}</a>
                                            <a href="{{ route('fishing-trips.edit', $trip) }}" class="btn-outline text-sm px-3 py-1.5 min-w-[70px] text-center">{{ __('messages.edit') }}</a>
                                            <form action="{{ route('fishing-trips.destroy', $trip) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5 min-w-[70px] text-center"
                                                        onclick="return confirm('{{ __('messages.confirm_delete_trip') }}')"
                                                        aria-label="{{ __('messages.delete') }} {{ $trip->title }}">
                                                    {{ __('messages.delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-6">
                            {{ $trips->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="p-6 text-center">
                        <svg class="w-6 h-6 text-neutral-400 dark:text-neutral-500 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-neutral-600 dark:text-neutral-400 mb-4">{{ __('messages.no_trips_recorded') }}</p>
                        <a href="{{ route('fishing-trips.create') }}" class="btn-primary">
                            {{ __('messages.record_first_trip') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout> 