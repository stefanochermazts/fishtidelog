<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.admin_dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistiche principali -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['total_users'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.total_users') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['premium_users'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.premium_users') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m-6 3l6-3"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['total_trips'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.total_trips') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['total_catches'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.total_catches') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistiche aggiuntive -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('messages.fishing_spots') }}</h3>
                        <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['total_spots'] }}</div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ __('messages.total_fishing_spots') }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('messages.total_weight') }}</h3>
                        <div class="text-3xl font-bold text-green-600 dark:text-green-400">{{ number_format($stats['total_weight'], 1) }} kg</div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ __('messages.total_weight_caught') }}</p>
                    </div>
                </div>
            </div>

            <!-- Link Rapidi Admin -->
            <div class="mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('messages.admin_quick_links') }}</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <a href="{{ route('admin.users.index') }}" 
                               class="flex items-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white">{{ __('messages.manage_users') }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.view_edit_users') }}</div>
                                </div>
                            </a>

                            <a href="{{ route('admin.instructions.index') }}" 
                               class="flex items-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/30 transition-colors">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white">{{ __('messages.manage_instructions') }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.edit_help_content') }}</div>
                                </div>
                            </a>

                            <a href="{{ route('instructions.index') }}" target="_blank"
                               class="flex items-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white">{{ __('messages.view_public_instructions') }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.see_user_experience') }}</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Utenti recenti e uscite recenti -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Utenti recenti -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('messages.recent_users') }}</h3>
                        <div class="space-y-3">
                            @foreach($stats['recent_users'] as $user)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-8 h-8 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center">
                                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ substr($user->name, 0, 1) }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                            <div class="text-xs text-gray-600 dark:text-gray-400">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @if($user->isAdmin())
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                {{ __('messages.admin') }}
                                            </span>
                                        @endif
                                        @if($user->isPremium())
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                {{ __('messages.premium') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                {{ __('messages.view_all_users') }} →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Uscite recenti -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('messages.recent_trips') }}</h3>
                        <div class="space-y-3">
                            @foreach($stats['recent_trips'] as $trip)
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $trip->title }}</div>
                                        <div class="text-xs text-gray-600 dark:text-gray-400">{{ $trip->user->name }} • {{ $trip->start_time->format('d/m/Y H:i') }}</div>
                                    </div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">
                                        {{ $trip->catches->count() }} {{ __('messages.catches') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 