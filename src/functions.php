<?php
  //enqueue jquery
  function jquery_enqueue() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_stylesheet_directory_uri() . '/assets/js/jquery.3.6.4.min.js', false, null, true);
    wp_enqueue_script('jquery');
  }
  if (!is_admin()) add_action("wp_enqueue_scripts", "jquery_enqueue", 11);
  
  //includo le interfaccie admin custom
  include_once(get_stylesheet_directory() . '/admin/init.admin.php');
?>
