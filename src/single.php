<?php 
global $wp, $wpdb;
get_header(); 

$bottomspace = get_field( 'add_page_space' , $page_for_posts , true);
$topspace = get_field( 'add_page_topspace', $page_for_posts , true );

$pagecontent = get_field('contenuto_pagina');
?>

<div class="page--container max-w-[1100px] mx-auto <?php if($topspace){ ?>space-top <?php } ?> <?php if($bottomspace){ ?>space-bottom <?php } ?>overflow-x-clip">
  
  <?php if( $pagecontent ) { ?>
    <!-- ! Hero -->
    <section id="hero" class="relative">
      <div class="div--container">
        <div class="common--grid">
          <h1 data-aos="fade-up-short" class="h2 col-span-12 text-center"><?php the_title(); ?></h1>
        </div>
      </div>
    </section>
  <?php } ?>


  <?php if( $pagecontent ) { ?>
    <!-- ! Contenuto flessibile -->
    <?php get_template_part('template-parts/page/loop-contenuto','flessibile'); ?>
  <?php } else { ?>
    <section id="hero" class="relative space-top-half">
      <div class="div--container">
        <div class="common--grid">
          <div data-aos="fade-up-short" data-aos-delay="100" class="col-span-12 md:col-span-8 md:col-start-3 text-center space-y-3">
            <h2 class="h3"><?php _e('Ops! This page has no content', '_themename'); ?></h2>
            <p class="p large"><?php _e('No problem, you can return to the Homepage and continue browsing by simply clicking the button below.', '_themename'); ?></p>
          </div>
          <div data-aos="fade-up-short" data-aos-delay="300" class="col-span-12 btn-container relative justify-center">
            <a href="<?php echo home_url(); ?>" class="btn primary">
              <span><?php _e('Back to homepage' , '_themename') ?></span>
            </a>
          </div>
        </div>
      </div>
    </section>
  <?php } ?>

</div>

<?php get_footer(); ?>