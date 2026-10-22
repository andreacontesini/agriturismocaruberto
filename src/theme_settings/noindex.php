<?php
/**
 * Forza noindex/nofollow sulla richiesta corrente (es. pagina "coming soon").
 * Va chiamata prima di qualsiasi output e prima di wp_head() — vedi header-noindex.php.
 *
 * Copre: meta robots del core (wp_robots), meta robots di Rank Math, header HTTP X-Robots-Tag.
 *
 * @return void
 */
function be_force_noindex(): void {
	add_filter( 'wp_robots', 'filter__be_noindex_wp_robots', 999 );
	add_filter( 'rank_math/frontend/robots', 'filter__be_noindex_rank_math_robots', 999 );

	if ( ! headers_sent() ) {
		header( 'X-Robots-Tag: noindex, nofollow', true );
	}
}

/**
 * Meta robots del core WordPress.
 *
 * @param array $robots Direttive robots.
 * @return array
 */
function filter__be_noindex_wp_robots( array $robots ): array {
	unset( $robots['index'], $robots['follow'] );
	$robots['noindex']  = true;
	$robots['nofollow'] = true;
	return $robots;
}

/**
 * Meta robots di Rank Math (che sostituisce quello del core quando attivo).
 *
 * @param array $robots Direttive robots.
 * @return array
 */
function filter__be_noindex_rank_math_robots( $robots ): array {
	$robots          = is_array( $robots ) ? $robots : [];
	$robots['index']  = 'noindex';
	$robots['follow'] = 'nofollow';
	return $robots;
}

?>
