<?php
/* Template Name: BE - Coming Soon */
get_header('noindex');
global $wp, $wpdb;
?>
<?php if ( ! post_password_required( $post ) ) { ?>
<div class="page--container overflow-x-clip bg-one/10 h-screen w-screen">
  <div class="w-full h-full bg-black/10 grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-7 p-4"></div>
    <div class="col-span-12 lg:col-span-5 aspect-square lg:aspect-auto">
      <div class="w-full h-full">
        <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2026/10/coming.jpg" class="object-cover object-center w-full h-full"/>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php get_footer('noindex');?>