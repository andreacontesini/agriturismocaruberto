<?php 

function wp_remove_image_size() {
  // Disable image resizing and reduce media space
  remove_image_size('large');
  remove_image_size('medium');
  remove_image_size('thumbnail');
}
add_action('init', 'wp_remove_image_size');
?>