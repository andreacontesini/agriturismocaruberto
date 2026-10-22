<?php
/* Template Name: BE - Coming Soon */
get_header('noindex');
global $wp, $wpdb;
?>
<?php if ( ! post_password_required( $post ) ) { ?>
<div class="page--container antialiased overflow-x-clip bg-one/10">
  <div class="w-full bg-black/10 grid grid-cols-12 gap-8 h-screen">
    <div data-aos="fade-in" data-aos-delay="400" class="col-span-12 lg:col-span-7 p-4">
      <div class="h-full flex flex-col justify-between gap-5">
        <div class="space-y-10">
          <div class="max-w-[220px]">
            <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2026/10/logoHor.svg" class="w-full block"/>
          </div>
          <div class="space-y-4">
            <h1 class="h4">Un nuovo angolo di relax immerso nella campagna cremonese, a pochi passi dal Cremona Circuit.</h1>
            <div class="max-w-[460px]">Natura, tranquillità e ospitalità autentica: un luogo speciale dove staccare dalla routine e riscoprire il piacere delle cose semplici. Compila il form e resta aggiornato sulla data di apertura!</div>
          </div>
        </div>
        <div class="hidden p-4 bg-white">FORM</div>
      </div>
    </div>
    <div data-aos="fade-in" data-aos-delay="400" class="col-span-12 lg:col-span-5 aspect-square lg:aspect-auto overflow-hidden">
      <div class="w-full h-full ">
        <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2026/10/coming.jpg" class="object-cover object-center w-full h-full"/>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php get_footer('noindex');?>