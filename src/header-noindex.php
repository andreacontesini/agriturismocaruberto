<?php be_force_noindex(); ?>
<!doctype html>

<html <?php language_attributes(); ?>>
  <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>" />
      <title><?php echo wp_get_document_title(); ?></title>
      <meta name="color-scheme" content="only">
      <link rel="profile" href="http://gmpg.org/xfn/11" />
      <meta name="author" content="Coded and developed by 91% - Andrea Contesini">
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
      <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
      <meta name="mobile-web-app-capable" content="yes">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <?php wp_head(); ?>
      <link href="<?php echo (get_stylesheet_directory_uri() . '/assets/vendors/swiper/swiper-bundle-v11.min.css'); ?>" rel="stylesheet">
      <link href="<?php echo (get_stylesheet_directory_uri() . '/assets/vendors/aos/aos.css'); ?>" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
      <link href="<?php echo esc_url( be_get_versioned_asset_url( 'dist/css/###main_css_filename###' ) ); ?>" rel="stylesheet">
  </head>
  <body <?php body_class('max-w-screen overflow-x-clip'); ?>>