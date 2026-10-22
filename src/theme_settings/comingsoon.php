<?php
/**
 * Indica se la modalità coming soon è attiva: la home statica usa il template "BE - Coming Soon".
 * Con WPML page_on_front è già filtrato sulla lingua corrente.
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
 * Modalità coming soon: per i visitatori non autorizzati ogni URL del frontend
 * viene rediretto alla home (302) e tutto il sito è noindex.
 * Admin, AJAX, REST, cron e wp-login.php non passano da template_redirect: restano accessibili.
 *
 * @return void
 */
function action__be_coming_soon_redirect(): void {
	if ( ! be_is_coming_soon_active() || current_user_can( 'edit_posts' ) ) {
		return;
	}

	be_force_noindex();

	if ( is_front_page() || is_robots() || is_favicon() ) {
		return;
	}

	nocache_headers();
	wp_safe_redirect( home_url( '/' ), 302 );
	exit;
}
add_action( 'template_redirect', 'action__be_coming_soon_redirect', 0 );

?>
