<?php
/**
 * Restituisce l'URL di un asset del tema con il parametro ?ver= basato sulla data di modifica del file.
 *
 * Il nome dei bundle in dist/ contiene un timestamp generato solo all'avvio della build:
 * in watch il file viene sovrascritto con lo stesso nome, quindi serve il filemtime
 * per invalidare la cache del browser/CDN ad ogni salvataggio.
 *
 * @param string $relative_path Percorso relativo alla root del tema (es. 'dist/css/main.css').
 * @return string URL dell'asset (non escapato).
 */
function be_get_versioned_asset_url( string $relative_path ): string {
  $relative_path = ltrim( $relative_path, '/' );
  $url           = get_stylesheet_directory_uri() . '/' . $relative_path;
  $file          = get_stylesheet_directory() . '/' . $relative_path;
  $version       = is_readable( $file ) ? filemtime( $file ) : false;

  return false !== $version ? add_query_arg( 'ver', $version, $url ) : $url;
}
?>
