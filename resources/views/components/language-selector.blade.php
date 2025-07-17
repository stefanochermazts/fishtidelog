<div class="relative inline-block text-left" x-data="{ open: false }">
    <div>
        <button type="button" 
                class="inline-flex items-center justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                id="language-menu-button"
                aria-expanded="true"
                aria-haspopup="true"
                @click="open = !open">
            <span class="flex items-center">
                @switch(app()->getLocale())
                    @case('it')
                        🇮🇹 IT
                        @break
                    @case('en')
                        🇺🇸 EN
                        @break
                    @case('de')
                        🇩🇪 DE
                        @break
                    @case('fr')
                        🇫🇷 FR
                        @break
                    @default
                        🇮🇹 IT
                @endswitch
            </span>
            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <div class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
         role="menu"
         aria-orientation="vertical"
         aria-labelledby="language-menu-button"
         tabindex="-1"
         x-show="open"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         @click.away="open = false">
        <div class="py-1" role="none">
            <a href="{{ route('locale.change', 'it') }}" 
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 {{ app()->getLocale() === 'it' ? 'bg-gray-100 text-gray-900' : '' }}"
               role="menuitem"
               tabindex="-1">
                🇮🇹 Italiano
            </a>
            <a href="{{ route('locale.change', 'en') }}" 
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 {{ app()->getLocale() === 'en' ? 'bg-gray-100 text-gray-900' : '' }}"
               role="menuitem"
               tabindex="-1">
                🇺🇸 English
            </a>
            <a href="{{ route('locale.change', 'de') }}" 
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 {{ app()->getLocale() === 'de' ? 'bg-gray-100 text-gray-900' : '' }}"
               role="menuitem"
               tabindex="-1">
                🇩🇪 Deutsch
            </a>
            <a href="{{ route('locale.change', 'fr') }}" 
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 {{ app()->getLocale() === 'fr' ? 'bg-gray-100 text-gray-900' : '' }}"
               role="menuitem"
               tabindex="-1">
                🇫🇷 Français
            </a>
        </div>
    </div>
</div> 