<?php
global $wp, $wpdb;
get_header();
$pagecontent = get_field('contenuto_pagina');
?>

<?php if( $pagecontent ) {
  $footerspace = get_field('remove_footer_space');
  get_template_part('template-parts/page/custompagetitle');
} ?>

<div class="page--container max-w-[1100px] mx-auto lg:pt-m pt-s space-bottom overflow-x-clip">
  <?php if( $pagecontent ) { ?>
    <!-- ! Contenuto flessibile -->
    <?php get_template_part('template-parts/page/loop-contenuto','flessibile'); ?>
  <?php } else { ?>
    <!-- <section class="relative pb-m">
      <div class="div--container">
        <div class="common--grid-12">
          <div data-aos="fade-up-short" data-aos-delay="100" class="col-span-12 md:col-span-8 md:col-start-3 text-center space-y-3">
            <h2 class="h3">Ops! Questa pagina non ha contenuto.</h2>
            <p class="body-s-alt">Non c'è problema, potete tornare alla pagina iniziale e continuare a navigare semplicemente facendo clic sul pulsante qui sotto.</p>
          </div>
          <div data-aos="fade-up-short" data-aos-delay="300" class="col-span-12 btn-container relative justify-center">
            <a href="<?php echo home_url(); ?>" class="btn outline">
              <span>Torna alla Homepage</span>
            </a>
          </div>
        </div>
      </div>
    </section> -->
  <?php } ?>

</div>

<?php get_footer(); ?>