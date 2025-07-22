<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.manage_instructions') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Instructions List -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('messages.instructions') }}
                        </h3>
                        <a href="{{ route('instructions.index') }}" target="_blank" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            {{ __('messages.view_public_page') }}
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse($instructions as $instruction)
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start gap-4">
                                    <div class="flex-1">
                                        <!-- Section Info -->
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                                {{ ucfirst(str_replace('_', ' ', $instruction->section_key)) }}
                                            </span>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ __('messages.instruction_order') }}: {{ $instruction->order }}
                                            </span>
                                            @if($instruction->is_active)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                                    {{ __('messages.instruction_active') }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                                                    {{ __('messages.inactive') ?? 'Inattivo' }}
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Title -->
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                            {{ $instruction->getLocalizedTitle() }}
                                        </h4>

                                        <!-- Content Preview -->
                                        <div class="text-sm text-gray-600 dark:text-gray-300 line-clamp-2">
                                            {!! Str::limit(strip_tags($instruction->getLocalizedContent()), 200) !!}
                                        </div>

                                        <!-- Languages Status -->
                                        <div class="mt-3 flex flex-wrap gap-2">
                                            @foreach(['it', 'en', 'de', 'fr'] as $locale)
                                                @php
                                                    $hasTitle = !empty($instruction->title[$locale] ?? '');
                                                    $hasContent = !empty($instruction->content[$locale] ?? '');
                                                    $isComplete = $hasTitle && $hasContent;
                                                @endphp
                                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium
                                                    {{ $isComplete ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' : 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200' }}">
                                                    @switch($locale)
                                                        @case('it') 🇮🇹 IT @break
                                                        @case('en') 🇬🇧 EN @break
                                                        @case('de') 🇩🇪 DE @break
                                                        @case('fr') 🇫🇷 FR @break
                                                    @endswitch
                                                    {{ $isComplete ? '✓' : '⚠' }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="{{ route('admin.instructions.edit', $instruction) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition-all hover:shadow-md">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            {{ __('messages.edit_instruction') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-gray-500 dark:text-gray-400">
                                    {{ __('messages.no_instructions_found') ?? 'Nessuna istruzione trovata.' }}
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 