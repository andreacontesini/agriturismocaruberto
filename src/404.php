<?php
/**
 * The template for displaying 404 pages (not found).
 *
 */
get_header(); 
?>

<div class="page--container max-w-[1100px] mx-auto overflow-x-clip">
  <section class="space-top space-bottom">
    <div class="div--container z-30 relative space-y-6 text-center max-w-[720px] mx-auto">
      <div class="relative max-w-[300px] aspect-[9/6] text-center mx-auto overflow-hidden rounded-3xl">
        <iframe src="https://giphy.com/embed/rlL4XHR60GPew" class="pointer-events-none object-cover object-center w-full h-full" width="480" height="341" frameBorder="0" allowFullScreen></iframe>
      </div>
      <div class="space-y-3">
        <h1 class="h3">Ops! Pagina non trovata</h1>
        <div class="text-base font-light max-w-[520px] mx-auto opacity-80">La pagina che stai cercando non esiste o è stata spostata. Clicca qui sotto per tornare alla homepage.</div>
      </div>
      <div class="btn-container relative mt-16 justify-center" data-aos="fade-up-short">
        <a href="<?php echo home_url(); ?>" class="btn outline-black"><span>Torna alla homepage</span></a>
      </div>    
    </div>
  </section><!-- #main -->
</div><!-- #primary -->
  
<?php
get_footer();