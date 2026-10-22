<?php
/* Template Name: BE - Coming Soon */
get_header('noindex');
global $wp, $wpdb;
?>
<?php if ( ! post_password_required( $post ) ) { ?>
<div class="page--container lg:h-screen min-h-screen antialiased overflow-hidden flex overflow-x-clip bg-five text-one p-5">
  <div class="border border-solid overflow-hidden border-one/20 min-h-[100%] w-full flex items-center justify-center">
    <div data-aos="fade-up-short" data-aos-delay="400" data-aos-duration="1400" class="col-span-12 lg:col-span-6 lg:col-start-4 p-4 space-top space-bottom">
      <div class="max-w-[640px] space-y-12">
        <div class="space-y-10">
          <div class="max-w-[220px] mx-auto">
            <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2026/10/logoCream.svg" class="w-full block"/>
          </div>
          <div class="space-y-5 text-center">
            <div class="h6 opacity-50">Coming soon – Apertura 2027</div>
            <h1 class="h4">Un nuovo angolo di relax immerso nella campagna cremonese, a pochi passi dal Cremona Circuit.</h1>
            <div class="max-w-[460px] mx-auto">Natura, tranquillità e ospitalità autentica: un luogo speciale dove staccare dalla routine e riscoprire il piacere delle cose semplici. Compila il form e resta aggiornato sulla data di apertura!</div>
          </div>
        </div>
        <div class=""><?php echo do_shortcode('[contact-form-7 id="912886c" title="Newsletter Light"]'); ?></div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php get_footer('noindex');?>