# Stack di sviluppo — Niuma WordPress Theme

## Panoramica

Lo stack si basa su **Gulp 4** come task runner principale. Il codice sorgente risiede in `src/` e viene compilato nella cartella `build/`, dalla quale viene poi caricato sul server tramite FTP.

---

## Struttura dei file

```
root/
├── src/                        # Codice sorgente del tema
│   ├── functions.php           # Entry point delle funzioni (incluso nel bundle finale)
│   ├── header.php, footer.php  # Template base del tema
│   ├── admin/                  # Interfacce admin personalizzate
│   ├── customposts/            # Definizioni custom post type
│   ├── js/                     # File JavaScript sorgente
│   ├── scss/                   # File SCSS sorgente
│   ├── shortcodes/             # Shortcode personalizzati
│   ├── template-parts/         # Componenti template riutilizzabili
│   ├── templates/              # Template di pagina personalizzati
│   ├── theme_settings/         # Moduli logica tema (20 file PHP)
│   └── woocommerce/            # Override template WooCommerce
├── assets/                     # File statici (font, JS vendor, librerie)
├── gulpcode/                   # Moduli Gulp (9 file task)
├── build/                      # Output build (non committare)
├── gulpfile.js                 # Entry point Gulp
├── package.json                # Dipendenze npm
├── project-config.json         # Configurazione tema
├── tailwind.config.js          # Configurazione Tailwind CSS
├── .env.staging.json           # Variabili d'ambiente staging (non in repo)
└── .env.production.json        # Variabili d'ambiente production (non in repo)
```

---

## Configurazione

### `project-config.json`
Contiene le informazioni base del tema e i path usati da Gulp:
- `themeinfo`: nome, autore, URL del tema
- `theme_text_domain`: domain delle traduzioni (es. `niuma`)
- `paths`: path sorgente (`src/`) e destinazione (`build/`)

### File ambiente (`.env.*.json`)
**Non vanno in repository** — contengono credenziali sensibili.
Crearli a partire da `.env.sample.json`.

Variabili richieste:
| Variabile | Descrizione |
|-----------|-------------|
| `SITE_URL` | URL completo del sito |
| `COMPLETE_SITE_URL` | URL usato per gli asset statici |
| `CDN_URL` | URL CDN opzionale (se vuoto, usa `COMPLETE_SITE_URL`) |
| `FTP_HOST` | Host FTP del server |
| `FTP_USER` | Utente FTP |
| `FTP_PASS` | Password FTP |
| `FTP_PORT` | Porta FTP (default 21) |
| `FTP_BASE_PATH` | Percorso base remoto (vuoto se root) |

---

## Moduli Gulp (`gulpcode/`)

| File | Responsabilità |
|------|----------------|
| `config.js` | Carica la configurazione da `project-config.json` e dai file `.env`. Gestisce il flag `--production` per distinguere gli ambienti. |
| `css.js` | Compila SCSS → CSS con Tailwind JIT, PostCSS e Autoprefixer. Minifica in produzione. |
| `scripts.js` | Concatena tutti i file JS in ordine alfabetico, minifica, rimuove i `console.log` in produzione. |
| `php.js` | Concatena tutti i PHP di `theme_settings/`, `shortcodes/`, `customposts/` e `functions.php` in un unico `functions.php`. Sostituisce i placeholder di URL e nomi file. |
| `generic.js` | Genera la struttura delle cartelle, il file `style.css` del tema e i file `.pot` per le traduzioni. |
| `assets.js` | Copia i file statici da `assets/` alla cartella di build. |
| `security.js` | Genera snippet di configurazione sicurezza per `wp-config.php` e `.htaccess`. |
| `ftp.js` | Gestisce l'upload su FTP via `vinyl-ftp`. Upload differenziale: carica solo i file nuovi o modificati. |
| `tests.js` | Validazione PHP (`php -l`), linting JS, controllo URL staging/production nei file. |

---

## Pipeline di build

### Fase 1 — Generazione nome file statici
Il task `generate-static-files-name` crea il file `static_files_name.json` con nomi di file CSS/JS basati sul timestamp corrente:
```
main_202603261430.css
main_202603261430.js
```
Questo previene problemi di cache browser ad ogni deploy.

### Fase 2 — Compilazione asset
In parallelo:
- **SCSS → CSS**: `src/scss/main.scss` → `build/.../dist/css/main_YYYYMMDDHHMM.css`
- **JS**: tutti i file `src/js/*.js` concatenati e ordinati alfabeticamente → `build/.../dist/js/main_YYYYMMDDHHMM.js`
- **Assets**: copia diretta di `assets/` → `build/.../assets/`

### Fase 3 — PHP
- **Template PHP** (`header.php`, `footer.php`, ecc.): copiati con sostituzione URL e placeholder
- **`functions.php`**: concatenazione di tutti i file in:
  - `src/functions.php`
  - `src/theme_settings/*.php`
  - `src/customposts/*.php`
  - `src/shortcodes/*.php`
  I tag `?>` + `<?php` adiacenti vengono rimossi per creare un file PHP unico pulito.

### Placeholder sostituiti durante la build
| Placeholder | Sostituito con |
|-------------|----------------|
| `_themename` | Il `theme_text_domain` da `project-config.json` |
| `###main_css_filename###` | Nome del file CSS con timestamp |
| `###main_js_filename###` | Nome del file JS con timestamp |
| URL relativi (`src="/`, `href="/`) | URL assoluto dell'ambiente corrente |

---

## Comandi

```bash
# Installazione dipendenze (sempre prima di tutto)
npm install

# Sviluppo locale (watch + upload automatico su staging)
npm run dev

# Sviluppo con ambiente production
npm run dev-prod

# Build + upload completo su staging
npm run deploy

# Build + upload completo su production
npm run deploy-prod

# Test e validazione
npm run test

# Validazione pre-commit (PHP lint, JS lint, controllo URL)
npm run test-pre-commit
```

---

## Watch mode

In modalità watch (`npm run dev`), Gulp monitora le modifiche e carica automaticamente via FTP:

- **SCSS modificato** → ricompila CSS → upload solo del file CSS
- **JS modificato** → ricompila JS + ricompila CSS (per Tailwind) → upload JS
- **PHP template** (header, footer, templates...) → upload del singolo file modificato
- **PHP functions** (functions.php, theme_settings/, shortcodes/) → rigenera l'intero `functions.php` concatenato → upload

---

## Librerie esterne incluse

| Libreria | Versione | Caricamento |
|----------|----------|-------------|
| jQuery | 3.6.4 | File locale (`assets/js/`) |
| GSAP + ScrollTrigger | 3.12.5 | CDN |
| Swiper | 11 | File locale (`assets/vendors/`) |
| AOS (Animate On Scroll) | — | File locale (`assets/vendors/`) |

---

## CSS — Architettura SCSS

```
src/scss/
├── main.scss               # Entry point — importa tutto
├── base/
│   ├── tailwind.scss       # @tailwind base/components/utilities
│   ├── reset.scss          # Reset CSS
│   ├── theme.scss          # Variabili CSS custom (colori, font)
│   ├── typo.scss           # Tipografia
│   ├── buttons.scss        # Stili bottoni
│   ├── animations.scss     # Keyframe animations
│   └── inputs.scss         # Form inputs
└── components/
    ├── header.scss
    ├── footer.scss
    ├── form.scss
    ├── messages.scss
    └── search.scss
```

### Tailwind — Configurazione custom
File: `tailwind.config.js`

Colori custom:
- `primary`: `#B8420F` (arancio-marrone brand)
- `secondary`: `#F6F4F0` (bianco sporco)
- `typo`: `#2D2C2A` (grigio scuro testi)

Font family custom: `neue` (NeueMontreal)

---

## Sicurezza nel deploy

Il task `generate-security` produce configurazioni differenziate per ambiente:

**Staging**: `WP_DEBUG` attivo, logging errori abilitato.

**Production**:
- `WP_DEBUG` disabilitato
- Modifica file disabilitata (`DISALLOW_FILE_EDIT`)
- Modifica plugin/temi disabilitata (`DISALLOW_FILE_MODS`)
- Regole `.htaccess` per bloccare esecuzione PHP in `wp-content/uploads/` e `wp-content/plugins/`
- `robots.txt` generato solo per ambienti non-production

---

## Traduzioni

Il task `translate` usa `gulp-wp-pot` per scansionare tutti i file PHP del tema e generare il file `.pot` in `locale/`. Il text domain usato è definito in `project-config.json` → `theme_text_domain`.
