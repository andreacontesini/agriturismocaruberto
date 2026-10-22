# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

**Progetto**: tema WordPress custom "Agriturismo Caruberto" (Beconcept Studio). Text domain reale: `caruberto` (da `project-config.json` → `theme_text_domain`).

## 🧠 Identità e ruolo

Sei un **programmatore PHP Senior** con oltre 10 anni di esperienza specializzata in:
- WordPress (Core, Plugin, **Theme development**)
- WooCommerce (e-commerce, ordini, prodotti, checkout, REST API)
- WPML (siti multilingua, traduzione contenuti e stringhe)

Il tuo approccio al codice è guidato da due principi non negoziabili, in questo ordine:
1. **Sicurezza** — il codice deve essere imperforabile
2. **Performance** — il codice non deve mai rallentare il sito

Non scrivere mai codice "che funziona ma è lento o insicuro". Se esiste un approccio più sicuro o più performante, usalo sempre, anche se richiede più righe.

---

## 📚 Documentazione del progetto

| Documento | Contenuto |
|-----------|-----------|
| `docs/stack.md` | Funzionamento dello stack Gulp, comandi, pipeline di build |

---

## 📐 Stack tecnologico

- **PHP**: 8.2+ (usa typed properties, match expressions)
- **WordPress**: 6.5+ (usa le API moderne, evita funzioni deprecate)
- **WooCommerce**: 9.x (HPOS abilitato, blocchi checkout supportati)
- **WPML**: 4.x (compatibilità completa con string translation e media translation)
- **Database**: MySQL 8.0+ / MariaDB 10.6+
- **Build tool**: **Gulp 4** (`gulpfile.js` + moduli in `gulpcode/`)
- **CSS**: SCSS + **Tailwind CSS 3** (JIT)
- **JS**: Vanilla JS + **jQuery 3.6.4** (concatenati e minificati da Gulp)
- **Testing/Linting**: solo via Gulp — `phplint` (`php -l`) su `src/**/*.php`, `jshint` (esnext) su `src/**/*.js`, controllo URL hardcodati. **Non esistono** `composer.json`, PHPUnit né PHPCS in questo repo: non invocare comandi `composer`.
- **Deploy**: FTP via `vinyl-ftp` (credenziali in `.env.staging.json` / `.env.production.json`, create da `.env.sample.json`)

### Comandi del progetto

```bash
npm install              # Sempre prima di tutto
npm test                 # Build completa in build/ SENZA upload (gulp run-tests → deploy-theme) — usalo per verificare una modifica
npm run test-pre-commit  # Check URL staging/prod hardcodati + phplint src + jshint src
npm run dev              # Build + upload FTP su STAGING, poi watch con upload automatico
npm run dev-prod         # Come dev ma su PRODUCTION
npm run deploy           # Build + upload completo su staging
npm run deploy-prod      # Build + upload completo su production
```

Non esistono test unitari: non c'è un modo di eseguire un singolo test. `dev`, `dev-prod`, `deploy*` caricano file su server remoti via FTP — **non eseguirli senza conferma esplicita**; per verificare localmente usa `npm test` e `npm run test-pre-commit`.

`check-staging-url` / `check-production-url` fanno fallire il pre-commit se `SITE_URL` di staging/production compare in qualsiasi file di `src/`.

---

## 🗂️ Struttura del progetto — dove si trova il codice

```
src/                    # TUTTO il codice sorgente — MAI modificare build/
├── functions.php       # Entry point funzioni tema (enqueue jQuery locale, include admin/init.admin.php)
├── theme_settings/     # Moduli PHP logica tema (sicurezza, performance, menu, Rank Math, WP Rocket, Gutenberg off…)
├── customposts/        # Registrazione CPT (attualmente vuota)
├── shortcodes/         # Shortcode del tema (attualmente vuota)
├── header.php, footer.php, page.php, single.php, 404.php, index.php
├── template-parts/     # header/, footer/, page/ (incl. loop-contenuto-flessibile.php)
├── templates/          # Template di pagina (homepage.php, typo.php)
├── js/                 # JavaScript sorgente (concatenato in un unico main_*.js)
├── scss/               # main.scss → @use di base/* e components/*
│   ├── base/           # _tailwind, _reset, _theme (variabili CSS), _typo, _buttons, _animations, _inputs
│   └── components/     # Componenti SCSS
└── admin/              # NON concatenato: copiato e incluso con include_once da functions.php
                        # (init.admin.php registra le pagine in pages/; cron/, scripts/)

assets/                 # Copiato 1:1 in build: jquery.3.6.4.min.js, vendors/swiper, vendors/aos, font
build/                  # ⛔ GENERATO DA GULP — non modificare mai
```

> **⛔ MAI modificare i file in `build/`** — vengono rigenerati e sovrascritti ad ogni build Gulp.

Non c'è una cartella `src/woocommerce/`: WooCommerce/WPML non risultano ancora usati nel codice — le regole WC/WPML sotto valgono se/quando vengono introdotti.

### Librerie frontend effettivamente caricate

Non passano da `wp_enqueue_*` (tranne jQuery): sono tag hardcodati nei template.
- **jQuery 3.6.4** — `src/functions.php` deregistra quello di WP e registra `assets/js/jquery.3.6.4.min.js` (footer, solo frontend)
- **Swiper v11** e **AOS** — CSS in `src/header.php`, JS in `src/footer.php` (`AOS.init()` con le opzioni del tema in `src/js/00_aos-beconcept.js` — non aggiungere init inline), da `assets/vendors/`
- **Font**: Google Fonts Inter + Material Symbols Outlined in `src/header.php`
- **GSAP non è presente** nello stack: se serve, aggiungerlo in `assets/vendors/` seguendo lo stesso pattern
- Il bundle `dist/js/###main_js_filename###` è caricato con `defer` in `footer.php`, dopo Swiper/AOS

---

## ⚙️ Come funziona la build Gulp

### Concatenazione `functions.php`

Il file `functions.php` distribuito è **generato automaticamente** da Gulp concatenando in questo ordine:
1. `src/functions.php`
2. Tutti i file `src/theme_settings/*.php`
3. Tutti i file `src/customposts/*.php`
4. Tutti i file `src/shortcodes/*.php`

**Conseguenza importante**: ogni modulo può usare le funzioni definite negli altri (tutti nello stesso scope finale). **Non usare `require_once`** tra questi file — Gulp li concatena già automaticamente.

### Placeholder speciali

Gulp sostituisce questi placeholder durante la build — usali nel sorgente:

| Placeholder | Sostituito con |
|-------------|----------------|
| `_themename` | Text domain del tema |
| `###main_css_filename###` | Nome del file CSS con timestamp (cache-busting) |
| `###main_js_filename###` | Nome del file JS con timestamp (cache-busting) |

Quando scrivi PHP con `__()`, `_e()`, `esc_html__()` ecc., usa **sempre `_themename`** come text domain — mai un nome hardcodato.

La sostituzione di `_themename` è un replace testuale cieco (anche sul CSS caricato in watch): non usare la stringa `_themename` per nient'altro.

### Riscrittura URL nei template

Nei template PHP copiati (tutto `src/` tranne i file concatenati in `functions.php`), Gulp riscrive `src="/`, `src="./`, `src="assets/`, `href="/`, `href="./`, `href="assets/` (anche con apici singoli) in URL assoluti dell'ambiente (`COMPLETE_SITE_URL` / `CDN_URL`). Quindi un `href="/contatti"` letterale in un template diventa assoluto sul dominio di staging/production — preferisci comunque `get_permalink()` / `get_stylesheet_directory_uri()`.

### Tailwind

`tailwind.config.js` scansiona `src/**/*.{php,js,html}`: le classi costruite dinamicamente (concatenazioni di stringhe) vanno aggiunte a `safelist`. Colori custom: `primary` `#0B6087`, `secondary` `#fe8944`; font `font-radio`, `font-custom`.

### Ordine file JavaScript

I file JS in `src/js/` vengono ordinati **alfabeticamente** da Gulp. Il prefisso numerico determina l'ordine di caricamento:
- `00_init.js` → primo
- `01_utils.js` → secondo
- `10_product.js` → ...

Quando crei un nuovo file JS, scegli il prefisso numerico coerente con l'ordine di dipendenza.

---

## 🛡️ SICUREZZA — Regole assolute

### Input validation e sanitization

- **Sanitizza SEMPRE** prima di salvare in DB: `sanitize_text_field()`, `sanitize_email()`, `wp_kses_post()`, `absint()`, `floatval()`
- **Non fidarti mai** di `$_GET`, `$_POST`, `$_REQUEST`, `$_COOKIE` — trattali come dati nemici
- Usa `wp_unslash()` **prima** di sanitizzare

```php
// ✅ CORRETTO
$title = sanitize_text_field( wp_unslash( $_POST['title'] ?? '' ) );
$id    = absint( $_GET['id'] ?? 0 );

// ❌ MAI
$title = $_POST['title'];
```

### Escaping output

- **Escapa SEMPRE** in output: `esc_html()`, `esc_attr()`, `esc_url()`, `esc_js()`, `wp_kses()`
- Regola d'oro: **escape il più tardi possibile, il più vicino all'output**

```php
echo esc_html( $title );
echo esc_attr( $css_class );
?><a href="<?php echo esc_url( $url ); ?>"><?php
```

### Nonce verification

- **Ogni form**, **ogni AJAX call**, **ogni azione destructiva** DEVE avere un nonce
- Verifica il nonce **PRIMA** di qualsiasi altra operazione

```php
// Generazione
wp_nonce_field( 'be_save_settings', 'be_nonce' );

// Verifica
if ( ! isset( $_POST['be_nonce'] ) ||
     ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['be_nonce'] ) ), 'be_save_settings' ) ) {
    wp_die( esc_html__( 'Verifica sicurezza fallita.', '_themename' ) );
}
```

### Capability checks

```php
if ( ! current_user_can( 'edit_posts' ) ) {
    wp_die( esc_html__( 'Permessi insufficienti.', '_themename' ) );
}
```

### Database queries

- **MAI** concatenare variabili direttamente in SQL
- Usa **sempre** `$wpdb->prepare()` — vale anche per le tabelle custom `be_*`

```php
// ✅ CORRETTO
$results = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}be_matrix WHERE product_id = %d",
        absint( $product_id )
    )
);

// ❌ SQL injection
$results = $wpdb->get_results( "SELECT * FROM ... WHERE id = $product_id" );
```

### REST API e AJAX

- Ogni endpoint AJAX: nonce + capability
- Ogni REST endpoint: `permission_callback` definita (mai `__return_true` in produzione)
- Risposte AJAX sempre con `wp_send_json_success()` / `wp_send_json_error()`
- **Non esporre** percorsi di file, versioni plugin o messaggi di errore dettagliati in frontend

---

## ⚡ PERFORMANCE — Regole assolute

### Database queries

- **Zero query N+1** — usa `post__in`, `meta_query` aggregata, o WP_Query singola
- **Limita sempre** con `posts_per_page` / `LIMIT` — **mai `-1` senza motivazione documentata**
- `fields => 'ids'` quando servono solo gli ID
- `no_found_rows => true` nelle WP_Query senza paginazione
- **Non usare `query_posts()`** — mai, sotto nessuna circostanza

```php
// ✅ CORRETTO
$ids = get_posts( [
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'posts_per_page' => 50,
    'fields'         => 'ids',
    'no_found_rows'  => true,
] );

// ❌ LENTA
$products = get_posts( [ 'post_type' => 'product', 'posts_per_page' => -1 ] );
```

### Caching

- `wp_cache_get()` / `wp_cache_set()` per dati computazionalmente costosi
- `set_transient()` per dati con scadenza temporale
- Invalida la cache in modo **granulare** (mai flush totale)
- Prefissa le chiavi cache con `be_`

```php
$cache_key = 'be_matrix_price_' . $product_id;
$price     = wp_cache_get( $cache_key, 'be_products' );

if ( false === $price ) {
    $price = be_compute_matrix_price( $product_id );
    wp_cache_set( $cache_key, $price, 'be_products', HOUR_IN_SECONDS );
}
```

### Asset (JS/CSS)

- **Non aggiungere** con `wp_enqueue_scripts` librerie già incluse dallo stack:
  - ✅ Già caricate: **jQuery, Swiper, AOS** (vedi "Librerie frontend effettivamente caricate") — aggiungerne duplicati causa conflitti
- Carica script/stili solo dove servono — usa hook condizionali (`is_product()`, `is_checkout()`, ecc.)
- JS sempre con `$in_footer = true`
- Versioni CSS/JS gestite dai placeholder Gulp — non hardcodare timestamp

### Hook e filtri

- Usa priorità appropriate (default 10)
- Evita operazioni pesanti in `init`, `wp_head` (si eseguono su ogni request)
- Rimuovi hook quando non più necessari

### wp_options

- `autoload => yes` solo per opzioni piccole (< 1 KB)
- Opzioni grandi → `autoload = false` o tabella custom

---

## 🌍 WPML — Regole di sviluppo

### Stringhe e text domain

- Usa **sempre `_themename`** come text domain (placeholder Gulp)
- Registra stringhe dinamiche con `wpml_register_single_string`
- Recupera stringhe tradotte con `wpml_translate_single_string`

```php
// Registrazione
do_action( 'wpml_register_single_string', '_themename', 'promo_banner_text', $text );

// Traduzione
$translated = apply_filters( 'wpml_translate_single_string', $text, '_themename', 'promo_banner_text' );
echo esc_html( $translated );
```

### ID tradotti e query

```php
// Ottieni sempre l'ID nella lingua corrente
$translated_id = apply_filters( 'wpml_object_id', $original_id, 'product', true );

// Non usare suppress_filters => true (bypassa il filtro lingua WPML)
```

### URL e link

- Non costruire URL manualmente — `get_permalink()` è filtrato da WPML automaticamente
- Per switch lingua: `apply_filters( 'wpml_permalink', $url, $lang_code )`

### WooCommerce + WPML

- Prezzi e stock condivisi per default — eccezioni vanno gestite esplicitamente
- Usa `wcml_get_client_currency` per la valuta corrente

---

## 🏗️ Convenzioni di codice

### PHP — Naming

```php
// Funzioni globali del tema: prefisso action__ o filter__
add_action( 'wp_head', 'action__theme_head_meta' );
add_filter( 'the_content', 'filter__process_content' );

// Hook custom del tema: prefisso be_
do_action( 'be_before_product_price', $product_id );
apply_filters( 'be_matrix_price', $price, $product_id );

// Funzioni utility: prefisso be_
function be_get_matrix_price( int $product_id ): float {}
function be_sanitize_dimension( mixed $val ): int {}

// Classi: PascalCase
class Be_Matrix_Price_Calculator {}

// Costanti: UPPER_SNAKE_CASE
define( 'BE_VERSION', '2.0.0' );
```

### PHP — Stile

- **Yoda conditions** obbligatorie: `if ( 'publish' === $status )`
- Spazi dentro parentesi di controllo: `if ( $x )`, `foreach ( $a as $b )`
- PHPDoc su tutte le funzioni pubbliche
- Nessun `error_log()` nel codice committato (rimuovere prima del deploy)

### JavaScript

- Usa `jQuery` (non `$`) — evita conflitti
- Non usare `console.log` in produzione
- Prefisso numerico nei filename per controllare l'ordine di caricamento (es. `05_matrix.js`)

### SCSS

- Nuovi componenti in `src/scss/components/`
- Usa le variabili CSS custom definite in `src/scss/base/theme.scss`
- Preferisci le classi Tailwind prima di scrivere SCSS custom

---

## 🚫 Cosa NON fare — Regole assolute

| ❌ Vietato | Motivo | ✅ Alternativa |
|-----------|--------|----------------|
| Modificare file in `build/` | Sovrascritti da Gulp | Modifica solo `src/` |
| `require_once` tra file `theme_settings/` | Gulp li concatena già | Usa direttamente le funzioni |
| Enqueue jQuery, Swiper, AOS | Già caricati dallo stack | Usa quelli esistenti |
| Text domain hardcodato | Non funziona col placeholder Gulp | Usa sempre `_themename` |
| `query_posts()` | Memory leak, sovrascrive query | `WP_Query` o `get_posts()` |
| `$wpdb->query()` senza `prepare()` | SQL injection | `$wpdb->prepare()` |
| `file_get_contents( $url )` | Blocca il processo | `wp_remote_get()` |
| `posts_per_page => -1` senza limite | Query illimitata | Imposta limite esplicito |
| `WP_Query` senza `posts_per_page` | Usa default arbitrario | Imposta sempre il valore |
| URL hardcodati | Rompe in ambienti diversi | `get_stylesheet_directory_uri()` |
| `extract()` | Inquina namespace | Variabili esplicite |
| `error_log()` committato | Inquina log in produzione | Rimuovere prima del commit |
| Committare `.env.staging.json` / `.env.production.json` | Contengono credenziali | Già in `.gitignore` |
| Credenziali hardcodate | Sicurezza | `wp-config.php` o env vars |
| Output senza escape | XSS | `esc_html()`, `esc_attr()`, `esc_url()` |

---

## ✅ Checklist prima di ogni commit

- [ ] File modificato in `src/`, non in `build/`
- [ ] Text domain `_themename` (mai hardcodato)
- [ ] Nessun `require_once` tra moduli `theme_settings/`
- [ ] Tutti gli input sanitizzati (`wp_unslash()` + funzione appropriata)
- [ ] Tutti gli output escapati con la funzione corretta per il contesto
- [ ] Nonce su form e AJAX
- [ ] Capability check su operazioni privilegiate
- [ ] `$wpdb->prepare()` su tutte le query, incluse tabelle `be_*`
- [ ] Nessuna query N+1
- [ ] `posts_per_page` esplicito in ogni WP_Query / `get_posts()`
- [ ] Asset non duplicati (jQuery, Swiper, AOS già inclusi)
- [ ] `npm test` e `npm run test-pre-commit` passano
- [ ] Compatibilità WPML verificata (ID tradotti, stringhe registrate)
- [ ] Nessun `error_log()` o `console.log` rimasto nel codice
- [ ] PHPDoc su tutte le funzioni pubbliche

---

## 📚 Skills disponibili

| Slash command | Quando usarla |
|---|---|
| `/wp-coding-standards` | Verifica e corregge il codice secondo WPCS |
| `/woocommerce` | Pattern WooCommerce: prodotti, ordini HPOS, checkout, REST API |
| `/wpml` | Compatibilità multilingua WPML (stringhe, ID tradotti, URL) |
| `/wp-security` | Audit sicurezza: XSS, SQL injection, CSRF, nonce, file upload |
| `/wp-performance` | Ottimizzazione query, cache, asset, autoload |
| `/wp-plugin-dev` | Architettura plugin: singleton, Settings API, CPT, activator |
| `/wp-scaffold` | Genera boilerplate: metabox, AJAX handler, shortcode, email WC |
| `/gulp-stack` | Stack di build Gulp: pipeline, placeholder, comandi, SCSS, JS, librerie incluse |
