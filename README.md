# FishTideLog

FishTideLog è un'applicazione SaaS leggera costruita con lo stack TALL (Tailwind, Alpine.js, Laravel, Livewire) che combina un diario digitale e una dashboard ambientale per la pesca ricreativa.

---

## Indice

1. [Panoramica](#panoramica)
2. [Stack Tecnologico](#stack-tecnologico)
3. [Funzionalità](#funzionalità)
4. [Design System](#design-system)
5. [Prerequisiti](#prerequisiti)
6. [Installazione](#installazione)
7. [Struttura Progetto](#struttura-progetto)
8. [Variabili Ambiente](#variabili-ambiente)
9. [Comandi Comuni](#comandi-comuni)
10. [Testing](#testing)
11. [Contribuire](#contribuire)
12. [Licenza](#licenza)

---

## Panoramica

FishTideLog fornisce:

* **Diario Digitale**: registra ogni uscita di pesca con specie, posizione (GPS), attrezzatura e foto
* **Dashboard Ambientale**: integrazione con maree, fasi lunari, alba/tramonto e previsioni meteo
* **Mappa Interattiva**: visualizza heatmap delle catture e punti preferiti
* **Avvisi e Notifiche**: notifiche push quando le condizioni sono ideali per la pesca ("golden hour", bassa marea, ecc.)

## Stack Tecnologico

* **Backend**: Laravel 11 + Eloquent ORM
* **Frontend**: Livewire, Alpine.js, Tailwind CSS
* **Database**: PostgreSQL (con PostGIS) o MySQL
* **Deployment**: Laravel Forge / Vapor
* **Cursor AI**: configurato via `.cursor/config.yaml` per scaffolding e completamenti codice

## Funzionalità

### 🎨 Design System Moderno
- **Responsive & Mobile-First**: Layout adattivo da 320px a 1440px
- **Tema Scuro/Chiaro**: Toggle automatico con localStorage
- **Accessibilità WCAG AA**: Contrasto 4.5:1, navigazione da tastiera, screen reader support
- **Animazioni Fluide**: Transizioni e micro-interazioni per UX ottimale

### 🎯 Componenti Interattivi
- **Livewire Components**: Widget statistiche in tempo reale
- **Alpine.js**: Dropdown, modali, accordion con gestione stato
- **Form Accessibili**: Validazione client/server con feedback visivo
- **Loading States**: Spinner e skeleton per stati di caricamento

### 📱 Mobile Experience
- **Touch-Friendly**: Pulsanti e target di dimensioni ottimali
- **Gesture Support**: Swipe e tap per navigazione mobile
- **Offline Ready**: Cache intelligente per contenuti statici
- **PWA Ready**: Manifest e service worker per installazione app

## Design System

### Palette Colori
```css
/* Primary - Azioni principali */
primary-500: #0ea5e9
primary-600: #0284c7
primary-700: #0369a1

/* Secondary - Successo e conferme */
secondary-500: #22c55e
secondary-600: #16a34a
secondary-700: #15803d

/* Accent - Avvisi e highlights */
accent-500: #f37415
accent-600: #e45a0b
accent-700: #bc440c

/* Neutral - Testo e bordi */
neutral-50: #fafafa
neutral-900: #171717
```

### Componenti Base
```html
<!-- Card con tema scuro -->
<div class="card card-hover">
  <div class="p-6">
    <!-- Contenuto -->
  </div>
</div>

<!-- Pulsanti con varianti -->
<button class="btn-primary">Azione Primaria</button>
<button class="btn-secondary">Azione Secondaria</button>
<button class="btn-outline">Azione Outline</button>

<!-- Form accessibili -->
<input class="form-input" type="text" aria-label="Nome">
<label class="form-label">Nome</label>
```

### Utility Classes
```css
.container-fluid    /* Container fluido */
.container-narrow   /* Container stretto */
.container-wide     /* Container largo */
.grid-responsive    /* Grid responsive */
.flex-responsive    /* Flex responsive */
```

---

## Prerequisiti

* PHP >= 8.2
* Composer
* Node.js >= 18 e npm o Yarn
* PostgreSQL o MySQL server
* Redis (opzionale, per code e cache)

---

## Installazione

### Clona Repository

```bash
git clone https://github.com/your-org/fishtidelog.git
cd fishtidelog
```

### Installa Dipendenze

```bash
composer install
npm install
```

### Configurazione Ambiente

1. Copia `.env.example` in `.env`:

   ```bash
   cp .env.example .env
   ```
2. Genera chiave applicazione:

   ```bash
   php artisan key:generate
   ```
3. Configura le credenziali del database in `.env`.

### Setup Database e Migrazioni

```bash
php artisan migrate
php artisan db:seed   # opzionale, dati demo
```

### Compila Assets

```bash
npm run dev       # sviluppo (watch mode)
npm run build     # produzione
```

### Avvia Applicazione

```bash
php artisan serve --port=8001  # avvia su http://localhost:8001
```

---

## Struttura Progetto

```
├── app/
│   ├── Http/Livewire/       # Componenti Livewire
│   ├── Models/              # Modelli Eloquent
│   └── Livewire/            # Componenti reattivi
├── resources/
│   ├── views/
│   │   ├── layouts/         # Layout principali
│   │   ├── components/      # Componenti Blade
│   │   └── livewire/        # Viste Livewire
│   ├── js/                  # Entry points Alpine.js
│   └── css/                 # Stili Tailwind CSS
├── routes/
│   ├── web.php              # Route web
│   └── api.php              # Route API
├── database/
│   ├── migrations/          # File migrazione
│   └── seeders/             # Classi seeder
├── docs/
│   ├── architecture.md      # Documentazione architettura
│   └── description.md       # Descrizione progetto
├── .cursor/config.yaml      # Configurazione Cursor AI
├── .env.example             # Template variabili ambiente
├── README.md                # Questo file
└── package.json
```

### Componenti Principali

#### Layout System
- `resources/views/layouts/app.blade.php` - Layout principale con tema scuro
- `resources/views/layouts/navigation.blade.php` - Navigazione responsive
- `resources/views/components/theme-toggle.blade.php` - Toggle tema

#### Livewire Components
- `app/Livewire/StatisticsWidget.php` - Widget statistiche in tempo reale
- `resources/views/livewire/statistics-widget.blade.php` - Vista componente

---

## Variabili Ambiente

Aggiorna `.env` con i valori per:

* `APP_URL`
* `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
* `REDIS_HOST`, `REDIS_PASSWORD`, `REDIS_PORT` (se usato)
* Chiavi API per servizi maree, lunari e meteo

---

## Comandi Comuni

| Comando                      | Descrizione                   |
| ---------------------------- | ----------------------------- |
| `composer install`           | Installa dipendenze PHP      |
| `npm install`                | Installa dipendenze JS       |
| `php artisan migrate`        | Esegui migrazioni database   |
| `php artisan db:seed`        | Popola il database           |
| `npm run dev`                | Compila assets in watch mode |
| `npm run build`              | Compila assets per produzione|
| `php artisan test`           | Esegui test suite PHP        |
| `vendor/bin/phpstan analyse` | Analisi statica              |
| `php artisan serve --port=8001` | Avvia server sviluppo    |

---

## Testing

Questo repo usa PHPUnit per i test backend.

```bash
php artisan test
```

### Test Accessibilità
```bash
# Test automatici WCAG (se configurati)
npm run test:a11y
```

---

## Contribuire

1. Fai fork del repository
2. Crea un branch feature (`git checkout -b feature/xyz`)
3. Committa le modifiche (`git commit -m "Aggiungi feature xyz"`)
4. Pusha al branch (`git push origin feature/xyz`)
5. Apri una Pull Request

Segui PSR-12 e esegui `npm run lint` prima di inviare.

### Checklist Contribuzione
- [ ] Codice segue PSR-12
- [ ] Test passano
- [ ] Accessibilità verificata (WCAG AA)
- [ ] Design responsive testato
- [ ] Tema scuro funziona correttamente
- [ ] Documentazione aggiornata

---

## Licenza

MIT © Your Name or Organization
