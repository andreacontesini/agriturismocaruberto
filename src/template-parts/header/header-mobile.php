<div data-aos="fade-in" data-aos-delay="200" class="lg:hidden flex w-full z-[999] fixed top-0 text-cream items-center justify-center py-4">
  <div class="flex items-center gap-2">
    <a id="js--openmenu" class="btn fill-cream small !border !border-dark/40 !border-solid">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
      </svg>
      <span id="btncont">Menu</span>
    </a>
    <a href="tel:+393357106025" class="btn fill-dark small"><?php _e('Contact us' , '_themename'); ?></a>
  </div>
</div>

<div class="fixed lg:hidden z-0 bg-[#f2e7da] p-6 w-screen h-screen overflow-y-scroll">
  <div id="js--innermobile" class="flex flex-col justify-center w-full h-full notVisible">
    <?php if( is_page_template( 'templates/homepage.php') ) { ?>
      <?php
        $appartamenti_onoff = get_field('appartamenti_onoff'); 
        $galleria_onoff = get_field('galleria_onoff');
        $caratteristiche_onoff = get_field('caratteristiche_onoff');
        $location_onoff = get_field('location_onoff');
        $faqs_onoff = get_field('faqs_onoff');
        $form_onoff = get_field('form_onoff');
      ?>
      <div class="header-desktop-menu-vert space-y-4">
        <div class="menu">
          <?php if($appartamenti_onoff){ ?><a href="#appartamenti" class="block"><?php _e('Apartments' , '_themename'); ?></a><?php } ?>
          <?php if($galleria_onoff){ ?><a href="#galleria" class="block"><?php _e('Gallery' , '_themename'); ?></a><?php } ?>
          <?php if($caratteristiche_onoff){ ?><a href="#servizi" class="block"><?php _e('Services' , '_themename'); ?></a><?php } ?>
          <?php if($location_onoff){ ?><a href="#location" class="block"><?php _e('Location' , '_themename'); ?></a><?php } ?>
          <?php if($faqs_onoff){ ?><a href="#faqs" class="block"><?php _e('Faq' , '_themename'); ?></a><?php } ?>
          <?php if($form_onoff){ ?><a href="#prenotazione" class="block"><?php _e('Book now' , '_themename'); ?></a><?php } ?>
          <a href="tel:+393357106025" class="btn fill-dark small"><?php _e('Contact us' , '_themename'); ?></a>
          <?php get_template_part( 'template-parts/header/langselectormobile' ); ?>
        </div>
      </div>
    <?php } elseif( is_singular( 'appartamento') ) { ?>
      <?php 
        $dettagli_onoff = get_field('dettagli_onoff');
        $caratteristiche_onoff = get_field('caratteristiche_onoff');
        $location_onoff = get_field('location_onoff');
        $faqs_onoff = get_field('faqs_onoff');
        $form_onoff = get_field('form_onoff'); 
      ?>
      <div class="header-desktop-menu-vert">
        <div class="menu">
          <a href="<?php echo get_site_url(); ?>" class="block"><?php _e('Home' , '_themename'); ?></a>
          <?php if($dettagli_onoff){ ?><a href="#dettagli" class="block"><?php _e('Details' , '_themename'); ?></a><?php } ?>
          <?php if($caratteristiche_onoff){ ?><a href="#servizi" class="block"><?php _e('Services' , '_themename'); ?></a><?php } ?>
          <?php if($location_onoff){ ?><a href="#location" class="block"><?php _e('Location' , '_themename'); ?></a><?php } ?>
          <?php if($faqs_onoff){ ?><a href="#faqs" class="block"><?php _e('Faq' , '_themename'); ?></a><?php } ?>
          <?php if($form_onoff){ ?><a href="#prenotazione" class="block"><?php _e('Book now' , '_themename'); ?></a><?php } ?>
          <a href="tel:+393357106025" class="btn fill-dark small"><?php _e('Contact us' , '_themename'); ?></a>
          <?php get_template_part( 'template-parts/header/langselectormobile' ); ?>
        </div>
      </div>
    <?php } else { ?>
      <?php if ( has_nav_menu( 'main_menu' ) ) { ?>
        <div class="header-desktop-menu-vert flex flex-col gap-4">
          <?php wp_nav_menu(array('theme_location' => 'main_menu')); ?>
          <a href="tel:+393357106025" class="btn fill-dark small"><?php _e('Contact us' , '_themename'); ?></a>
          <?php get_template_part( 'template-parts/header/langselectormobile' ); ?>
        </div>
      <?php } ?>
    <?php } ?>
  
  </div>
</div>