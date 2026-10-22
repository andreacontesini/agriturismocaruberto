
<?php
  $page_for_posts = get_option( 'page_for_posts' );
  if( is_home() && !is_single() ) {
    $activate_pagetitle = get_field('activate_pagetitle' , $page_for_posts, true);
    $pagetitle_title = get_field('pagetitle_title' , $page_for_posts, true);
  }
  $our_title = get_the_title( get_option('page_for_posts', true) );
?>
<section id="page-title" class="relative overflow-clip flex flex-col justify-center bg-one text-white space-top space-bottom">
  <div class="div--container z-30 relative xl:space-y-3 space-y-2">
    <div class="btn-container w-full justify-center pb-6">
      <a href="<?php echo get_site_url(); ?>" class="btn outline-white">
        <span class="material-symbols-outlined">arrow_back</span>
        <span class="">Torna alla home</span>
      </a>
    </div>
    <?php if( !is_home() && !is_single()){ ?>
      <h1 data-aos="fade-in" class="h2 text-center max-w-[1380px] mx-auto">
        <span><?php if($pagetitle_title) { echo $pagetitle_title; } else { the_title(); } ?></span>
      </h1>
    <?php }; ?>
    <?php if( is_home() && !is_single()){ ?>
      <h1 data-aos="fade-in" class="h2 text-center max-w-[1380px] mx-auto">
        <span><?php if($pagetitle_title) { echo $pagetitle_title; } else { echo $our_title; } ?></span>
      </h1>
    <?php }; ?>
  </div>
</section>