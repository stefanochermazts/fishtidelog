{{-- Theme Toggle Component con Alpine.js e accessibilità WCAG AA --}}
<div x-data="themeToggle()" 
     x-init="init()" 
     class="theme-toggle-wrapper"
     role="switch" 
     :aria-checked="theme === 'dark'"
     aria-label="{{ __('Toggle dark mode') }}">
    
    <button @click="
    theme = theme === 'light' ? 'dark' : 'light';
    localStorage.setItem('theme', theme);
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
" 
class="inline-flex items-center justify-center p-2 rounded-xl text-neutral-400 hover:text-neutral-500 hover:bg-neutral-100 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200"
:aria-label="theme === 'light' ? '{{ __('Tema Scuro') }}' : '{{ __('Tema Chiaro') }}'"
:title="theme === 'light' ? '{{ __('Tema Scuro') }}' : '{{ __('Tema Chiaro') }}'">
    
    <!-- Sun icon for dark mode toggle -->
    <svg x-show="theme === 'light'" 
         class="w-5 h-5" 
         fill="currentColor" 
         viewBox="0 0 20 20" 
         aria-hidden="true">
        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
    </svg>
    
    <!-- Moon icon for light mode toggle -->
    <svg x-show="theme === 'dark'" 
         class="w-5 h-5" 
         fill="currentColor" 
         viewBox="0 0 20 20" 
         aria-hidden="true">
        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
    </svg>
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