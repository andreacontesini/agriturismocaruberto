<?php
/** Slug della pagina coming soon inglese (template "BE - Coming Soon"), servita su /en/. */
define( 'BE_COMING_SOON_EN_SLUG', 'en' );

/**
 * Indica se la modalità coming soon è attiva: la home statica usa il template "BE - Coming Soon".
 *
 * @return bool
 */
function be_is_coming_soon_active(): bool {
	static $active = null;

	if ( null === $active ) {
		$front_id = absint( get_option( 'page_on_front' ) );
		$active   = 'page' === get_option( 'show_on_front' )
			&& $front_id > 0
			&& 'templates/comingsoon.php' === get_page_template_slug( $front_id );
	}

	return $active;
}

/**
 * Indica se la richiesta corrente è la pagina coming soon inglese.
 *
 * @return bool
 */
function be_is_coming_soon_en_page(): bool {
	return is_page( BE_COMING_SOON_EN_SLUG )
		&& 'templates/comingsoon.php' === get_page_template_slug( get_queried_object_id() );
}

/**
 * Lingua della pagina coming soon corrente: 'en' sulla pagina /en/, altrimenti 'it'.
 *
 * @return string
 */
function be_get_coming_soon_lang(): string {
	return be_is_coming_soon_en_page() ? 'en' : 'it';
}

/**
 * Imposta lang="en-GB" nel tag <html> della pagina coming soon inglese.
 *
 * @param string $output Attributi lingua generati da WordPress.
 * @return string
 */
function filter__be_coming_soon_language_attributes( string $output ): string {
	if ( ! be_is_coming_soon_en_page() ) {
		return $output;
	}

	return (string) preg_replace( '/lang="[^"]*"/', 'lang="en-GB"', $output );
}
add_filter( 'language_attributes', 'filter__be_coming_soon_language_attributes' );

/**
 * Modalità coming soon: per i visitatori non autorizzati ogni URL del frontend
 * (tranne la home e la pagina inglese /en/) viene rediretto alla home (302) e tutto il sito è noindex.
 * Admin, AJAX, REST, cron e wp-login.php non passano da template_redirect: restano accessibili.
 *
 * @return void
 */
function action__be_coming_soon_redirect(): void {
	if ( ! be_is_coming_soon_active() || current_user_can( 'edit_posts' ) ) {
		return;
	}

	be_force_noindex();

	if ( is_front_page() || be_is_coming_soon_en_page() || is_robots() || is_favicon() ) {
		return;
	}

	nocache_headers();
	wp_safe_redirect( home_url( '/' ), 302 );
	exit;
}
add_action( 'template_redirect', 'action__be_coming_soon_redirect', 0 );

?>
