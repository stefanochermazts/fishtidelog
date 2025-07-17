# Architettura Tecnica - FishTideLog

## Stack Tecnologico

### Frontend
- **Laravel Blade**: Template engine per viste server-side
- **Livewire**: Componenti reattivi senza JavaScript complesso
- **Alpine.js**: Interazioni leggere e gestione stato client-side
- **Tailwind CSS**: Framework CSS utility-first con supporto tema scuro
- **Alpine.js**: Gestione interazioni e stato componenti

### Backend
- **Laravel 11**: Framework PHP moderno con Eloquent ORM
- **PostgreSQL**: Database relazionale con estensione PostGIS per coordinate GPS
- **Laravel Sanctum**: Autenticazione API e gestione sessioni

### Design System

#### Responsive & Mobile-First
- **Breakpoints**: 320px (xs) → 1440px (2xl)
- **Grid System**: CSS Grid e Flexbox per layout fluidi
- **Spacing**: Sistema di spacing scalabile (px-4, md:px-8, etc.)
- **Typography**: Scala tipografica responsive (text-3xl md:text-4xl lg:text-5xl)

#### Tema Scuro/Chiaro
- **Configurazione**: `darkMode: 'class'` in Tailwind
- **Toggle**: Componente Alpine.js con localStorage
- **Colori**: Palette personalizzata (primary, secondary, accent, neutral)
- **Transizioni**: Animazioni fluide tra temi (duration-200)

#### Accessibilità WCAG AA
- **Contrasto**: Minimo 4.5:1 per testo normale, 3:1 per testo grande
- **Semantic HTML**: `<nav>`, `<header>`, `<main>`, `<footer>`, `<form>`
- **ARIA**: Ruoli, labels e live regions per screen readers
- **Keyboard Navigation**: Supporto completo per navigazione da tastiera
- **Focus Management**: Focus visibile e gestione tabindex

### Componenti Architetturali

#### Layout System
```
resources/views/layouts/
├── app.blade.php          # Layout principale con tema scuro
├── navigation.blade.php   # Navigazione responsive
└── guest.blade.php        # Layout per utenti non autenticati
```

#### Componenti Blade
```
resources/views/components/
├── theme-toggle.blade.php     # Toggle tema scuro/chiaro
├── nav-link.blade.php         # Link navigazione con stati
├── btn-*.blade.php           # Varianti pulsanti
├── card.blade.php            # Componente card con hover
└── form-*.blade.php          # Componenti form accessibili
```

#### Componenti Livewire
```
app/Livewire/
├── StatisticsWidget.php       # Widget statistiche in tempo reale
└── [Altri componenti reattivi]
```

### Sistema di Colori

#### Palette Principale
- **Primary**: Blu (#0ea5e9) - Azioni principali, link
- **Secondary**: Verde (#22c55e) - Successo, conferme
- **Accent**: Arancione (#f37415) - Avvisi, highlights
- **Neutral**: Grigio scala - Testo, bordi, sfondi

#### Varianti Tema Scuro
- **Background**: `bg-white dark:bg-neutral-900`
- **Text**: `text-neutral-900 dark:text-neutral-100`
- **Borders**: `border-neutral-200 dark:border-neutral-700`
- **Cards**: `bg-white dark:bg-neutral-800`

### Utility Classes

#### Responsive Design
```css
.container-fluid    /* Container fluido con padding */
.container-narrow   /* Container stretto per contenuto */
.container-wide     /* Container largo per dashboard */
.grid-responsive    /* Grid responsive 1→4 colonne */
.flex-responsive    /* Flex responsive column→row */
```

#### Componenti
```css
.card              /* Card base con tema scuro */
.card-hover        /* Card con effetto hover */
.btn-primary       /* Pulsante primario */
.btn-secondary     /* Pulsante secondario */
.btn-outline       /* Pulsante outline */
.form-input        /* Input form con tema scuro */
.nav-link          /* Link navigazione */
.badge-*           /* Badge con varianti colore */
```

### Animazioni e Transizioni

#### Animazioni Personalizzate
- **fade-in**: Opacità 0→1 con easing
- **slide-up**: Trasformazione Y con easing
- **bounce-soft**: Bounce leggero per feedback

#### Transizioni
- **Tema**: `transition-colors duration-200`
- **Hover**: `hover:shadow-medium dark:hover:shadow-strong`
- **Focus**: `focus:ring-2 focus:ring-primary-500`

### Performance e SEO

#### Ottimizzazioni
- **Lazy Loading**: Immagini e componenti pesanti
- **Preload**: Font e risorse critiche
- **Caching**: Livewire cache per componenti statici
- **Compression**: Gzip per CSS/JS

#### SEO
- **Meta Tags**: Description, theme-color, viewport
- **Semantic HTML**: Struttura semantica per crawler
- **Schema.org**: Markup strutturato per dati

### Sicurezza

#### Autenticazione
- **Laravel Sanctum**: Token-based authentication
- **CSRF Protection**: Protezione cross-site request forgery
- **Input Validation**: Validazione lato server e client

#### Autorizzazione
- **Policies**: Controllo accessi per modelli
- **Middleware**: Filtri per route protette
- **Role-based**: Sistema ruoli per funzionalità avanzate

### Database Schema

#### Tabelle Principali
```sql
users              # Utenti e autenticazione
fishing_trips      # Uscite di pesca
fish_catches       # Catture con foto
fishing_spots      # Punti di pesca con coordinate
```

#### Relazioni
- **User** → **FishingTrips** (1:N)
- **FishingTrip** → **FishCatches** (1:N)
- **User** → **FishingSpots** (1:N)

### Deployment

#### Ambiente di Sviluppo
- **Laragon**: Stack locale con PostgreSQL
- **Vite**: Build tool per assets
- **PHP 8.2+**: Versione PHP moderna

#### Produzione
- **Server**: Laravel Forge o Vapor
- **Database**: PostgreSQL con PostGIS
- **CDN**: Cloudflare per assets statici
- **Monitoring**: Laravel Telescope per debug

### Testing

#### Test Suite
- **PHPUnit**: Test unitari e feature
- **Browser Tests**: Test end-to-end
- **Accessibility**: Test automatici WCAG
- **Performance**: Lighthouse CI

### Documentazione

#### File di Configurazione
- `tailwind.config.js`: Configurazione design system
- `resources/css/app.css`: Stili globali e componenti
- `composer.json`: Dipendenze PHP
- `package.json`: Dipendenze frontend

#### Guide
- **Setup**: Installazione e configurazione
- **Components**: Documentazione componenti
- **Theming**: Guida personalizzazione tema
- **Accessibility**: Checklist WCAG AA
