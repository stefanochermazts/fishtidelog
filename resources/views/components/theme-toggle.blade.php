{{-- Theme Toggle Component con Alpine.js e accessibilità WCAG AA --}}
<div x-data="themeToggle()" 
     x-init="init()" 
     class="theme-toggle-wrapper"
     role="switch" 
     :aria-checked="theme === 'dark'"
     aria-label="{{ __('Toggle dark mode') }}">
    
    <button @click="toggle()" 
            @keydown.enter="toggle()"
            @keydown.space="toggle()"
            class="dark-mode-toggle focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
            :aria-label="theme === 'dark' ? '{{ __('Switch to light mode') }}' : '{{ __('Switch to dark mode') }}'"
            type="button">
        
        {{-- Icona sole per tema chiaro --}}
        <svg x-show="theme === 'light'" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-75"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-75"
             class="absolute left-1.5 h-5 w-5 text-yellow-500"
             fill="currentColor" 
             viewBox="0 0 20 20"
             aria-hidden="true">
            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
        </svg>
        
        {{-- Icona luna per tema scuro --}}
        <svg x-show="theme === 'dark'"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-75"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-75"
             class="absolute right-1.5 h-5 w-5 text-blue-400"
             fill="currentColor" 
             viewBox="0 0 20 20"
             aria-hidden="true">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
        </svg>
        
        {{-- Thumb del toggle --}}
        <span class="dark-mode-toggle-thumb"
              :class="theme === 'dark' ? 'translate-x-10' : 'translate-x-0'"></span>
    </button>
</div>

<script>
function themeToggle() {
    return {
        theme: 'light',
        
        init() {
            // Recupera il tema dal localStorage o usa il default del sistema
            this.theme = localStorage.getItem('theme') || this.getSystemTheme();
            this.applyTheme();
            
            // Ascolta i cambiamenti del sistema
            if (window.matchMedia) {
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                    if (!localStorage.getItem('theme')) {
                        this.theme = e.matches ? 'dark' : 'light';
                        this.applyTheme();
                    }
                });
            }
        },
        
        getSystemTheme() {
            return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        },
        
        toggle() {
            this.theme = this.theme === 'light' ? 'dark' : 'light';
            this.applyTheme();
            localStorage.setItem('theme', this.theme);
            
            // Annuncia il cambiamento per screen readers
            this.announceThemeChange();
        },
        
        applyTheme() {
            if (this.theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        },
        
        announceThemeChange() {
            // Crea un elemento temporaneo per annunciare il cambiamento
            const announcement = document.createElement('div');
            announcement.setAttribute('aria-live', 'polite');
            announcement.setAttribute('aria-atomic', 'true');
            announcement.className = 'sr-only';
            announcement.textContent = this.theme === 'dark' 
                ? '{{ __("Dark mode enabled") }}' 
                : '{{ __("Light mode enabled") }}';
            
            document.body.appendChild(announcement);
            
            // Rimuovi l'elemento dopo l'annuncio
            setTimeout(() => {
                document.body.removeChild(announcement);
            }, 1000);
        }
    }
}
</script> 