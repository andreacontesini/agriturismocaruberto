<div class="hidden lg:flex w-full sticky z-[99999] top-0 left-0 items-center justify-center border-b border-solid border-tertiary bg-background">
  <div class="div--container py-4">
    <div class="common--grid">
      <div class="col-span-4 self-center">
        <a class="block w-fit" href="<?php echo get_site_url(); ?>">
          <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2024/12/VC_Logo_Landscape_web_3.png" class="max-w-[246px]" />
        </a>
      </div>
      <div class="col-span-8 self-center flex items-center justify-end">
        <div class="header-menu-container">
          <?php
          if ( has_nav_menu( 'general_menu' ) ) {
            wp_nav_menu( array( 'theme_location' => 'general_menu' ) );
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>