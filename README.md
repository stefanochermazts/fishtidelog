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
7. [Configurazione Database](#configurazione-database)
8. [Setup Ambiente Sviluppo](#setup-ambiente-sviluppo)
9. [Struttura Progetto](#struttura-progetto)
10. [Variabili Ambiente](#variabili-ambiente)
11. [Comandi Comuni](#comandi-comuni)
12. [Testing](#testing)
13. [Contribuire](#contribuire)
14. [Licenza](#licenza)

---

## Panoramica

FishTideLog fornisce:

* **Diario Digitale**: registra ogni uscita di pesca con specie, posizione (GPS), attrezzatura e foto
* **Dashboard Ambientale**: integrazione con maree, fasi lunari, alba/tramonto e previsioni meteo
* **Mappa Interattiva**: visualizza heatmap delle catture e punti preferiti
* **Avvisi e Notifiche**: notifiche push quando le condizioni sono ideali per la pesca ("golden hour", bassa marea, ecc.)
* **Sistema Multilingua**: supporto per Italiano, Inglese, Francese e Tedesco
* **Pannello Amministrativo**: gestione utenti e statistiche per amministratori

## Stack Tecnologico

* **Backend**: Laravel 11 + Eloquent ORM
* **Frontend**: Livewire, Alpine.js, Tailwind CSS
* **Database**: PostgreSQL (configurato per Laragon)
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

### 🌍 Multilingua
- **4 Lingue**: Italiano, Inglese, Francese, Tedesco
- **Traduzioni Complete**: Interfaccia, messaggi, validazioni
- **Selezione Lingua**: Toggle dinamico con persistenza

### 👥 Sistema Amministrativo
- **Dashboard Admin**: Statistiche globali e gestione utenti
- **Gestione Ruoli**: Assegnazione ruoli admin e premium
- **Statistiche Avanzate**: Analisi uscite, punti pesca, catture

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

### Software Richiesto
* **PHP >= 8.2** con estensioni: BCMath, Ctype, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML
* **Composer >= 2.0**
* **Node.js >= 18** e npm o Yarn
* **PostgreSQL >= 12** (configurato per Laragon)
* **Git**

### Ambiente Sviluppo Consigliato
* **Laragon** (Windows) - Include Apache, PHP, PostgreSQL
* **XAMPP** (Cross-platform) - Alternativa a Laragon
* **Docker** (opzionale) - Per ambiente containerizzato

---

## Installazione

### 1. Clona Repository

```bash
git clone https://github.com/stefanochermazts/fishtidelog.git
cd fishtidelog
```

### 2. Installa Dipendenze PHP

```bash
composer install --no-dev --optimize-autoloader
```

### 3. Installa Dipendenze Node.js

```bash
npm install
```

### 4. Configurazione Ambiente

1. **Copia file ambiente**:
   ```bash
   cp .env.example .env
   ```

2. **Genera chiave applicazione**:
   ```bash
   php artisan key:generate
   ```

3. **Configura database in `.env`**:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=fishtidelog
   DB_USERNAME=postgres
   DB_PASSWORD=your_password
   ```

### 5. Setup Database

1. **Crea database PostgreSQL**:
   ```sql
   CREATE DATABASE fishtidelog;
   ```

2. **Esegui migrazioni**:
   ```bash
   php artisan migrate
   ```

3. **Popola database con dati di test**:
   ```bash
   php artisan db:seed
   ```

### 6. Compila Assets

```bash
# Sviluppo (watch mode)
npm run dev

# Produzione
npm run build
```

### 7. Avvia Applicazione

```bash
# Server sviluppo (porta 8001)
php artisan serve --port=8001

# Oppure con host specifico
php artisan serve --host=0.0.0.0 --port=8001
```

L'applicazione sarà disponibile su: **http://localhost:8001**

---

## Configurazione Database

### PostgreSQL con Laragon

1. **Avvia Laragon** e assicurati che PostgreSQL sia attivo
2. **Crea database** tramite pgAdmin o comando:
   ```sql
   CREATE DATABASE fishtidelog;
   ```
3. **Configura credenziali** in `.env`:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=fishtidelog
   DB_USERNAME=postgres
   DB_PASSWORD=root
   ```

### Verifica Connessione

```bash
php artisan tinker
>>> DB::connection()->getPdo();
```

Se non ci sono errori, la connessione è corretta.

---

## Setup Ambiente Sviluppo

### Configurazione Laragon (Raccomandato)

1. **Installa Laragon** da [laragon.org](https://laragon.org)
2. **Clona progetto** in `C:\laragon\www\FishTideLog`
3. **Avvia Laragon** e clicca "Start All"
4. **Accedi al database** tramite pgAdmin (incluso in Laragon)

### Configurazione Virtual Host (Opzionale)

1. **Crea virtual host** in Laragon:
   - Clicca destro su Laragon → Apache → Sites-enabled
   - Aggiungi: `fishtidelog.test`

2. **Configura hosts file**:
   ```
   127.0.0.1 fishtidelog.test
   ```

3. **Accedi via**: `http://fishtidelog.test`

### Permessi File

```bash
# Windows (PowerShell)
icacls storage -grant Everyone:F /T
icacls bootstrap/cache -grant Everyone:F /T

# Linux/Mac
chmod -R 775 storage bootstrap/cache
```

---

## Struttura Progetto

```
FishTideLog/
├── app/
│   ├── Console/Commands/     # Comandi Artisan
│   ├── Http/
│   │   ├── Controllers/      # Controller MVC
│   │   ├── Middleware/       # Middleware personalizzati
│   │   └── Requests/         # Form Request Validation
│   ├── Livewire/             # Componenti Livewire
│   ├── Models/               # Modelli Eloquent
│   ├── Policies/             # Policy autorizzazioni
│   ├── Providers/            # Service Providers
│   └── Services/             # Servizi applicazione
├── config/                   # File configurazione
├── database/
│   ├── factories/            # Factory per testing
│   ├── migrations/           # Migrazioni database
│   └── seeders/              # Seeder dati
├── docs/                     # Documentazione
├── lang/                     # Traduzioni Laravel
├── resources/
│   ├── lang/                 # Traduzioni frontend
│   ├── views/                # Viste Blade
│   │   ├── admin/           # Viste amministrative
│   │   ├── auth/            # Viste autenticazione
│   │   ├── catches/         # Viste catture
│   │   ├── components/      # Componenti Blade
│   │   ├── fishing-spots/   # Viste punti pesca
│   │   ├── fishing-trips/   # Viste uscite pesca
│   │   ├── layouts/         # Layout principali
│   │   └── livewire/        # Viste Livewire
│   ├── css/                 # Stili Tailwind
│   └── js/                  # JavaScript Alpine.js
├── routes/                   # Definizione rotte
├── storage/                  # File storage
└── tests/                    # Test PHPUnit
```

### Componenti Principali

#### Controller
- `DashboardController.php` - Dashboard principale
- `FishingTripController.php` - Gestione uscite pesca
- `FishingSpotController.php` - Gestione punti pesca
- `FishCatchController.php` - Gestione catture
- `AdminController.php` - Pannello amministrativo
- `HomeController.php` - Pagine pubbliche

#### Modelli
- `User.php` - Utenti con ruoli e premium
- `FishingTrip.php` - Uscite di pesca
- `FishingSpot.php` - Punti di pesca
- `FishCatch.php` - Catture con specie
- `TideData.php` - Dati maree cache

#### Middleware
- `AdminMiddleware.php` - Protezione rotte admin
- `SetLocale.php` - Gestione multilingua

---

## Variabili Ambiente

Configura `.env` con i seguenti valori:

### Database
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=fishtidelog
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### Applicazione
```env
APP_NAME="FishTideLog"
APP_ENV=local
APP_KEY=base64:your_generated_key
APP_DEBUG=true
APP_URL=http://localhost:8001
```

### Cache e Session
```env
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### Mail (opzionale)
```env
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

---

## Comandi Comuni

### Sviluppo
```bash
# Avvia server sviluppo
php artisan serve --port=8001

# Compila assets in watch mode
npm run dev

# Compila assets per produzione
npm run build
```

### Database
```bash
# Esegui migrazioni
php artisan migrate

# Rollback migrazioni
php artisan migrate:rollback

# Reset database e seed
php artisan migrate:fresh --seed

# Popola solo seeder specifico
php artisan db:seed --class=AdminUserSeeder
```

### Cache e Config
```bash
# Pulisci cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Cache configurazione
php artisan config:cache
php artisan route:cache
```

### Testing
```bash
# Esegui test
php artisan test

# Test con coverage
php artisan test --coverage
```

### Comandi Personalizzati
```bash
# Test cambio locale
php artisan test:locale

# Test query statistiche
php artisan test:statistics

# Pulisci dati maree scaduti
php artisan tides:clean
```

---

## Testing

### Test PHPUnit

```bash
# Tutti i test
php artisan test

# Test specifici
php artisan test --filter=AuthenticationTest
php artisan test tests/Feature/Auth/

# Test con verbose
php artisan test -v
```

### Test Browser (se configurato)

```bash
# Test Dusk
php artisan dusk

# Test specifici Dusk
php artisan dusk --filter=LoginTest
```

### Test Accessibilità

```bash
# Test automatici WCAG (se configurati)
npm run test:a11y
```

---

## Contribuire

1. **Fai fork** del repository
2. **Crea branch feature**: `git checkout -b feature/nuova-funzionalita`
3. **Committa modifiche**: `git commit -m "Aggiungi nuova funzionalità"`
4. **Pusha al branch**: `git push origin feature/nuova-funzionalita`
5. **Apri Pull Request**

### Standard di Codice

- **PHP**: PSR-12
- **JavaScript**: ESLint + Prettier
- **CSS**: Tailwind CSS
- **Test**: PHPUnit per backend

### Checklist Contribuzione

- [ ] Codice segue PSR-12
- [ ] Test passano (`php artisan test`)
- [ ] Assets compilati (`npm run build`)
- [ ] Accessibilità verificata (WCAG AA)
- [ ] Design responsive testato
- [ ] Tema scuro funziona correttamente
- [ ] Traduzioni aggiornate (IT, EN, FR, DE)
- [ ] Documentazione aggiornata

---

## Licenza

MIT © Stefano Chermaz

---

## Supporto

Per supporto tecnico o domande:
- **Issues**: [GitHub Issues](https://github.com/stefanochermazts/fishtidelog/issues)
- **Documentazione**: Vedi cartella `docs/`
- **Wiki**: [GitHub Wiki](https://github.com/stefanochermazts/fishtidelog/wiki)
