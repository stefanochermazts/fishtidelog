<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.users_management') }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                {{ __('messages.back_to_dashboard') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtri -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('admin.users.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('messages.search') }}
                            </label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                placeholder="{{ __('messages.search_users_placeholder') }}"
                                class="form-input w-full">
                        </div>
                        
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('messages.role') }}
                            </label>
                            <select name="role" id="role" class="form-select w-full">
                                <option value="">{{ __('messages.all_roles') }}</option>
                                <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>{{ __('messages.user') }}</option>
                                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>{{ __('messages.admin') }}</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="premium" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('messages.premium_status') }}
                            </label>
                            <select name="premium" id="premium" class="form-select w-full">
                                <option value="">{{ __('messages.all_users') }}</option>
                                <option value="true" {{ request('premium') === 'true' ? 'selected' : '' }}>{{ __('messages.premium_only') }}</option>
                                <option value="false" {{ request('premium') === 'false' ? 'selected' : '' }}>{{ __('messages.free_only') }}</option>
                            </select>
                        </div>
                        
                        <div class="flex items-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                {{ __('messages.filter') }}
                            </button>
                            @if(request()->hasAny(['search', 'role', 'premium']))
                                <a href="{{ route('admin.users.index') }}" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                    {{ __('messages.clear') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Lista utenti -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('messages.user') }}
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('messages.role') }}
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('messages.premium') }}
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('messages.statistics') }}
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('messages.registered') }}
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('messages.actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div class="h-10 w-10 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ substr($user->name, 0, 1) }}</span>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($user->isAdmin())
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                    {{ __('messages.admin') }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                                    {{ __('messages.user') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
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
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            <div class="space-y-1">
                                                <div>{{ $user->fishingTrips->count() }} {{ __('messages.trips') }}</div>
                                                <div>{{ $user->fishingSpots->count() }} {{ __('messages.spots') }}</div>
                                                <div>{{ $user->total_catches }} {{ __('messages.catches') }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $user->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">
                                                {{ __('messages.view') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Paginazione -->
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 