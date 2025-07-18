<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" 
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm hover:bg-[#f5f5f5] dark:hover:bg-[#1a1a19] focus:outline-none transition-colors duration-200">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
        </svg>
        {{ __('language') }}
        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <div x-show="open" 
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute right-0 mt-2 w-48 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm shadow-lg z-50">
        <div class="py-1">
            <a href="{{ route('locale.change', 'it') }}" 
               class="block px-4 py-2 text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#f5f5f5] dark:hover:bg-[#1a1a19] transition-colors duration-200 {{ app()->getLocale() === 'it' ? 'bg-[#e3f2fd] dark:bg-[#1e3a5f] text-[#1976d2] dark:text-[#64b5f6]' : '' }}">
                🇮🇹 {{ __('italian') }}
            </a>
            <a href="{{ route('locale.change', 'en') }}" 
               class="block px-4 py-2 text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#f5f5f5] dark:hover:bg-[#1a1a19] transition-colors duration-200 {{ app()->getLocale() === 'en' ? 'bg-[#e3f2fd] dark:bg-[#1e3a5f] text-[#1976d2] dark:text-[#64b5f6]' : '' }}">
                🇬🇧 {{ __('english') }}
            </a>
            <a href="{{ route('locale.change', 'de') }}" 
               class="block px-4 py-2 text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#f5f5f5] dark:hover:bg-[#1a1a19] transition-colors duration-200 {{ app()->getLocale() === 'de' ? 'bg-[#e3f2fd] dark:bg-[#1e3a5f] text-[#1976d2] dark:text-[#64b5f6]' : '' }}">
                🇩🇪 {{ __('german') }}
            </a>
            <a href="{{ route('locale.change', 'fr') }}" 
               class="block px-4 py-2 text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#f5f5f5] dark:hover:bg-[#1a1a19] transition-colors duration-200 {{ app()->getLocale() === 'fr' ? 'bg-[#e3f2fd] dark:bg-[#1e3a5f] text-[#1976d2] dark:text-[#64b5f6]' : '' }}">
                🇫🇷 {{ __('french') }}
            </a>
        </div>
    </div>
</div> 