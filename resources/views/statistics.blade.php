<x-app-layout>
    <x-slot name="header">
        <h2 class="h2 text-neutral-900 dark:text-neutral-100">
            {{ __('statistics.title') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="container-wide">
            <div class="mb-8">
                <h1 class="h1 text-neutral-900 dark:text-neutral-100 mb-4">{{ __('statistics.title') }}</h1>
                <p class="text-neutral-600 dark:text-neutral-400">{{ __('statistics.description') }}</p>
            </div>

            <!-- Statistiche per specie -->
            <div class="card mb-8">
                <div class="p-6">
                    <h2 class="h3 text-neutral-900 dark:text-neutral-100 mb-4">{{ __('statistics.species_stats') }}</h2>
                    
                    @if($speciesStats->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                                <thead class="bg-neutral-50 dark:bg-neutral-800">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">
                                            {{ __('statistics.species') }}
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">
                                            {{ __('statistics.count') }}
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">
                                            {{ __('statistics.total_weight') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-neutral-800 divide-y divide-neutral-200 dark:divide-neutral-700">
                                    @foreach($speciesStats as $stat)
                                        <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-700 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neutral-900 dark:text-neutral-100">
                                                {{ $stat->species }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
                                                {{ $stat->count }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
                                                {{ number_format($stat->total_weight, 2) }} kg
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-neutral-500 dark:text-neutral-400">{{ __('statistics.no_species_data') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Statistiche mensili -->
            <div class="card mb-8">
                <div class="p-6">
                    <h2 class="h3 text-neutral-900 dark:text-neutral-100 mb-4">{{ __('statistics.monthly_stats') }}</h2>
                    
                    @if($monthlyStats->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                                <thead class="bg-neutral-50 dark:bg-neutral-800">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">
                                            {{ __('statistics.month') }}
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">
                                            {{ __('statistics.trips') }}
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">
                                            {{ __('statistics.total_minutes') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-neutral-800 divide-y divide-neutral-200 dark:divide-neutral-700">
                                    @foreach($monthlyStats as $stat)
                                        <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-700 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neutral-900 dark:text-neutral-100">
                                                {{ \Carbon\Carbon::create()->month((int) $stat->month)->format('F') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
                                                {{ $stat->trips }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
                                                {{ number_format($stat->total_minutes) }} {{ __('statistics.minutes') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-neutral-500 dark:text-neutral-400">{{ __('statistics.no_monthly_data') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Grafici (placeholder per future implementazioni) -->
            <div class="card">
                <div class="p-6">
                    <h2 class="h3 text-neutral-900 dark:text-neutral-100 mb-4">{{ __('statistics.charts') }}</h2>
                    <div class="text-center py-8">
                        <p class="text-neutral-500 dark:text-neutral-400">{{ __('statistics.charts_coming_soon') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 