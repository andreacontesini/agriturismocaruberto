<?php
/* Template Name: BE - Homepage */
get_header();
global $wp, $wpdb;
?>
<?php if ( ! post_password_required( $post ) ) { ?>
<div class="page--container overflow-x-clip space-bottom">
  <!-- Content page -->
</div>
<?php }else{ ?>
  <div class="page--container overflow-x-clip space-bottom space-top">
    <div class="div--container ">
      <?php echo get_the_password_form(); ?>
    </div>
  </div> 
<?php } ?>
<?php get_footer();?>