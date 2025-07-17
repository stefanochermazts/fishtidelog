<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.user_details') }} - {{ $user->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('messages.back_to_users') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Informazioni utente -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('messages.user_information') }}</h3>
                            <div class="space-y-3">
                                <div>
                                    <span class="font-medium text-gray-700 dark:text-gray-300">{{ __('messages.name') }}:</span>
                                    <span class="ml-2 text-gray-900 dark:text-gray-100">{{ $user->name }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700 dark:text-gray-300">{{ __('messages.email') }}:</span>
                                    <span class="ml-2 text-gray-900 dark:text-gray-100">{{ $user->email }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700 dark:text-gray-300">{{ __('messages.registered') }}:</span>
                                    <span class="ml-2 text-gray-900 dark:text-gray-100">{{ $user->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700 dark:text-gray-300">{{ __('messages.role') }}:</span>
                                    <span class="ml-2">
                                        @if($user->isAdmin())
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                {{ __('messages.admin') }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                                {{ __('messages.user') }}
                                            </span>
                                        @endif
                                    </span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700 dark:text-gray-300">{{ __('messages.premium_status') }}:</span>
                                    <span class="ml-2">
                                        @if($user->isPremium())
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                {{ __('messages.premium') }}
                                            </span>
                                            @if($user->premium_until)
                                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                    {{ __('messages.until') }} {{ $user->premium_until->format('d/m/Y') }}
                                                </div>
                                            @endif
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                                {{ __('messages.free') }}
                                            </span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('messages.statistics') }}</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['fishing_trips'] }}</div>
                                    <div class="text-sm text-blue-600 dark:text-blue-400">{{ __('messages.fishing_trips') }}</div>
                                </div>
                                <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                                    <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $stats['fishing_spots'] }}</div>
                                    <div class="text-sm text-green-600 dark:text-green-400">{{ __('messages.fishing_spots') }}</div>
                                </div>
                                <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg">
                                    <div class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $stats['catches'] }}</div>
                                    <div class="text-sm text-red-600 dark:text-red-400">{{ __('messages.catches') }}</div>
                                </div>
                                <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                                    <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ number_format($stats['total_weight'], 1) }} kg</div>
                                    <div class="text-sm text-yellow-600 dark:text-yellow-400">{{ __('messages.total_weight') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modifica ruolo e stato premium -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Modifica ruolo -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('messages.change_role') }}</h3>
                        <form method="POST" action="{{ route('admin.users.update-role', $user) }}">
                            @csrf
                            @method('PATCH')
                            <div class="mb-4">
                                <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('messages.select_role') }}
                                </label>
                                <select name="role" id="role" class="form-select w-full">
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>{{ __('messages.user') }}</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>{{ __('messages.admin') }}</option>
                                </select>
                            </div>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                {{ __('messages.update_role') }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Modifica stato premium -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('messages.change_premium_status') }}</h3>
                        <form method="POST" action="{{ route('admin.users.update-premium', $user) }}">
                            @csrf
                            @method('PATCH')
                            <div class="mb-4">
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_premium" value="1" {{ $user->is_premium ? 'checked' : '' }} 
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ __('messages.make_premium') }}</span>
                                </label>
                            </div>
                            <div class="mb-4">
                                <label for="premium_until" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('messages.premium_until') }}
                                </label>
                                <input type="date" name="premium_until" id="premium_until" 
                                    value="{{ $user->premium_until ? $user->premium_until->format('Y-m-d') : '' }}"
                                    class="form-input w-full">
                            </div>
                            <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg">
                                {{ __('messages.update_premium') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Uscite recenti -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('messages.recent_trips') }}</h3>
                    <div class="space-y-3">
                        @forelse($recentTrips as $trip)
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $trip->title }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $trip->start_time->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $trip->catches->count() }} {{ __('messages.catches') }}</div>
                                        @if($trip->total_weight > 0)
                                            <div class="text-sm text-gray-600 dark:text-gray-400">{{ number_format($trip->total_weight, 1) }} kg</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 text-center py-4">{{ __('messages.no_trips_found') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Punti di pesca recenti -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('messages.recent_spots') }}</h3>
                    <div class="space-y-3">
                        @forelse($recentSpots as $spot)
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $spot->name }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $spot->type ?? __('messages.no_type') }}</p>
                                    </div>
                                    <div class="text-right">
                                        @if($spot->is_favorite)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                {{ __('messages.favorite') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 text-center py-4">{{ __('messages.no_spots_found') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 