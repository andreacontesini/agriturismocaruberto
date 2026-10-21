<?php if (have_rows('contenuto_pagina')) { ?>

  <?php while (have_rows('contenuto_pagina')) { the_row(); ?>

    <?php if (get_row_layout() == 'paragrafo') { ?>
      <!-- ! Paragrafo -->
      <?php
        $mostra_sezione = get_sub_field('mostra_sezione');
        $personalizza_paragrafo = get_sub_field('personalizza_paragrafo');
        $titolo = get_sub_field('titolo');
        $sottotitolo = get_sub_field('ilsottotitolo');
        $testo = get_sub_field('testo');
      ?>
      <?php if ($mostra_sezione && $testo) { ?>
        <section class="relative space-top-half">
          <div class="div--container">
            <div class="common--grid">
              <div data-aos="fade" class="col-span-12 space-y-2">
                <?php if ( $personalizza_paragrafo == 'con-titolo' && $titolo ) { ?>
                  <p class="h3"><?php echo $titolo; ?></p>
                <?php } else if( $personalizza_paragrafo == 'titolo-piu-sottotitolo' && $titolo) { ?>
                  <p class="h3"><?php echo $titolo; ?></p>
                  <?php if ($sottotitolo) { ?>
                    <p class="uppercase text-lg !pt-0"><?php echo $sottotitolo; ?></p>
                  <?php } ?>
                <?php } ?>
              </div>
              <div data-aos="fade" data-aos-delay="100" class="col-span-12 text-base text-black"><?php echo $testo; ?></div>
            </div>
          </div>
        </section>
      <?php } ?>
    <?php } ?>


    <?php if (get_row_layout() == 'immagine_sx_testo_dx') { ?>
      <!-- ! Immagine SX testo DX -->
      <?php
        $mostra_sezione = get_sub_field('mostra_sezione');
        $immagine = get_sub_field('immagine');
        $personalizza_paragrafo = get_sub_field('personalizza_paragrafo');
        $titolo = get_sub_field('titolo');
        $sottotitolo = get_sub_field('ilsottotitolo');
        $testo = get_sub_field('testo');
      ?>
      <?php if ($mostra_sezione && $testo && $immagine) { ?>
        <section class="relative space-top-half">
          <div class="div--container">
            <div class="common--grid">
              <div data-aos="fade" class="col-span-12 md:col-span-6 overflow-hidden">
                <img class="w-full h-full object-cover object-center" src="<?php echo $immagine['url']; ?>" alt="<?php echo $immagine['alt']; ?>"/>
              </div>
              <div data-aos="fade" data-aos-delay="100" class="col-span-12 md:col-span-6 md:col-start-7 self-center space-y-8">
                <div class="space-y-2">
                  <?php if ( $personalizza_paragrafo == 'con-titolo' && $titolo ) { ?>
                    <p class="h3"><?php echo $titolo; ?></p>
                  <?php } else if( $personalizza_paragrafo == 'titolo-piu-sottotitolo' && $titolo) { ?>
                    <p class="h3"><?php echo $titolo; ?></p>
                    <?php if ($sottotitolo) { ?>
                      <p class="uppercase text-lg !pt-0"><?php echo $sottotitolo; ?></p>
                    <?php } ?>
                  <?php } ?>
                </div>
                <div class="text-base text-black"><?php echo $testo; ?></div>
              </div>
            </div>
          </div>
        </section>
      <?php } ?>
    <?php } ?>


    <?php if (get_row_layout() == 'immagine_dx_testo_sx') { ?>
      <!-- ! Immagine DX testo SX -->
      <?php
        $mostra_sezione = get_sub_field('mostra_sezione');
        $immagine = get_sub_field('immagine');
        $personalizza_paragrafo = get_sub_field('personalizza_paragrafo');
        $titolo = get_sub_field('titolo');
        $sottotitolo = get_sub_field('ilsottotitolo');
        $testo = get_sub_field('testo');
      ?>
      <?php if ($mostra_sezione && $testo && $immagine) { ?>
        <section class="relative space-top-half">
          <div class="div--container">
            <div class="common--grid check--mobile--order">
              <div data-aos="fade" data-aos-delay="100" class="col-span-12 md:col-span-6 self-center space-y-8">
                <div class="space-y-2">
                  <?php if ( $personalizza_paragrafo == 'con-titolo' && $titolo ) { ?>
                    <p class="h3"><?php echo $titolo; ?></p>
                  <?php } else if( $personalizza_paragrafo == 'titolo-piu-sottotitolo' && $titolo) { ?>
                    <p class="h3"><?php echo $titolo; ?></p>
                    <?php if ($sottotitolo) { ?>
                      <p class="uppercase text-lg !pt-0"><?php echo $sottotitolo; ?></p>
                    <?php } ?>
                  <?php } ?>
                </div>
                <div class="text-base text-black"><?php echo $testo; ?></div>
              </div>
              <div data-aos="fade" class="col-span-12 md:col-span-6 md:col-start-7 overflow-hidden">
                <img class="w-full h-full object-cover object-center" src="<?php echo $immagine['url']; ?>" alt="<?php echo $immagine['alt']; ?>"/>
              </div>
            </div>
          </div>
        </section>
      <?php } ?>
    <?php } ?>


    <?php if (get_row_layout() == 'accordion') { ?>
      <!-- ! Accordion -->
      <?php
        $mostra_sezione = get_sub_field('mostra_sezione');
        $personalizza_paragrafo = get_sub_field('personalizza_paragrafo');
        $titolo = get_sub_field('titolo');
        $sottotitolo = get_sub_field('ilsottotitolo');
        $accordion = get_sub_field('accordion');
      ?>
      <?php if ($mostra_sezione && $accordion) { ?>
        <section class="relative space-top-half">
          <div class="div--container">
            <div class="common--grid">
              <?php if ( $titolo || $sottotitolo ) { ?>
                <div data-aos="fade" data-aos-delay="100" class="col-span-12 space-y-2">
                  <?php if ( $personalizza_paragrafo == 'con-titolo' && $titolo ) { ?>
                    <p class="h3"><?php echo $titolo; ?></p>
                  <?php } else if( $personalizza_paragrafo == 'titolo-piu-sottotitolo' && $titolo) { ?>
                    <p class="h3"><?php echo $titolo; ?></p>
                    <?php if ($sottotitolo) { ?>
                      <p class="p large medium opacity-70 !pt-0"><?php echo $sottotitolo; ?></p>
                    <?php } ?>
                  <?php } ?>
                </div>
              <?php } ?>
              <?php if ( $accordion ) { ?>
                <div class="accordion-list space-y-4 col-span-12">
                  <?php foreach ( $accordion as $element ) { 
                      $accordion_title = $element['accordion_title'];
                      $accordion_text = $element['accordion_text'];
                    ?>
                    <div class="accordion-element group overflow-hidden border-b border-solid border-gray-200 pb-4">
                      <div class="js--trigger-accordion-click cursor-pointer">
                        <div class="flex items-center justify-between">
                          <h5 class="h6"><?php echo $accordion_title; ?></h5>
                          <span class="material-symbols-outlined">
                            keyboard_arrow_down
                          </span>
                        </div>
                      </div>
                      <div class="p content pt-4 lg:pr-16">
                        <div class="text-base"><?php echo $accordion_text; ?></div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
          </div>
        </section>
      <?php } ?>
    <?php } ?>


    <?php if (get_row_layout() == 'contact_form') { ?>
      <!-- ! Contact form -->
      <?php
        $mostra_sezione = get_sub_field('mostra_sezione');
        $cf = get_sub_field('id_contact_form');
      ?>
      <?php if ($mostra_sezione && $cf) { ?>
        <section class="relative space-top-half">
          <div class="div--container">
            <div class="common--grid">
              <?php if($cf){ ?>
                <div data-aos="fadeup" class="col-span-12 md:col-span-7 overflow-hidden">
                  <div class="bg-gray-200 p-6 xl:p-8">
                    <?php echo do_shortcode('[contact-form-7 id="' . $cf . '"]'); ?>
                  </div>
                </div> 
              <?php } ?>
            </div>
          </div>
        </section>
      <?php } ?>
    <?php } ?>
    

    <?php if (get_row_layout() == 'immagine_full') { ?>
      <!-- ! Immagine full -->
      <?php
        $mostra_sezione = get_sub_field('mostra_sezione');
        $immagine = get_sub_field('immagine');
        $didascalia = get_sub_field('caption');;
        $impostazioni_avanzate = get_sub_field('impostazioni_avanzate');

        if( $impostazioni_avanzate['button_h'] == 'custom' && $impostazioni_avanzate['custom_h'] ){ 
          $h_img = $impostazioni_avanzate['custom_h'] . 'px';
        } else {
          $h_img = '100%';
        }
      ?>
      <?php if ($mostra_sezione && $immagine) { ?>
        <section class="relative space-top-half">
          <div class="div--container">
            <div class="common--grid !gap-y-4">
              <div data-aos="fade-up-short" class="col-span-12 overflow-hidden" style="height: <?php echo $h_img; ?>; ">
                <img class="w-full h-full object-cover object-center" src="<?php echo $immagine['url']; ?>" alt="<?php echo $immagine['alt']; ?>"/>
              </div>
              <?php if( $didascalia ) { ?>
                <p data-aos="fade-up-short" class="col-span-12 p"><?php echo $didascalia; ?></p>
              <?php } ?>
            </div>
          </div>
        </section>
      <?php } ?>
    <?php } ?>
    

    <?php if (get_row_layout() == 'immagini_affiancate') { ?>
      <!-- ! Immagini affiancate -->
      <?php
        $mostra_sezione = get_sub_field('mostra_sezione');
        $immagini_repeater = get_sub_field('immagini_repeater');
        if( $impostazioni_avanzate['button_h'] == 'custom' && $impostazioni_avanzate['custom_h'] ){ 
          $h_img = $impostazioni_avanzate['custom_h'] . 'px';
        } else {
          $h_img = '100%';
        }
      ?>

      <?php if ($mostra_sezione && $immagini_repeater) { ?> 
        <section class="relative space-top-half">
          <div class="div--container">
            <div class="common--grid">
              <div class="col-span-12 <?php if( count($immagini_repeater) < 2 ) { ?> xl:col-span-10 xl:col-start-2 <?php } ?>">
                <div class="swiper-container swiper-contenutoflessibile-immagini overflow-hidden">
                  <div class="swiper-wrapper">
                    <?php foreach( $immagini_repeater as $i => $img ) { 
                        $image = $img['img'];
                        $didascalia = $img['caption'];
                        if( count($immagini_repeater) == 3 ) {
                          $w_img = 'w-full md:w-[48.5%] xl:w-[32%] mr-5';
                          $aspect_img = 'aspect-square';
                        } else if( count($immagini_repeater) == 2 ){
                          $w_img = 'w-full md:w-[48.5%] mr-5';
                          $aspect_img = 'aspect-square';
                        } else {
                          $w_img = 'w-full';
                          $aspect_img = 'aspect-square xl:aspect-[16/7]';
                        }
                      ?>
                      <?php if( $image ) { ?>
                        <div data-aos="fade" data-aos-delay="<?php echo ($i+2)*100; ?>" class="swiper-slide <?php echo $w_img; ?> h-full">
                          <div class="<?php echo $aspect_img; ?> w-full h-full overflow-hidden">
                            <img class="w-full h-full object-cover object-center" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                          </div>
                          <?php if( $didascalia ) { ?>
                            <p class="p mt-4"><?php echo $didascalia; ?></p>
                          <?php } ?>
                        </div>
                      <?php } else { 
                          $placeholder = get_site_url() . "/wp-content/uploads/2024/07/placeholder-chiaro.jpg";
                        ?>
                        <div data-aos="fade" data-aos-delay="<?php echo ($i+1)*100; ?>" class="swiper-slide <?php echo $w_img; ?> h-full">
                          <div class="<?php echo $aspect_img; ?> w-full h-full overflow-hidden">
                            <img class="w-full h-full object-cover object-center" src="<?php echo $placeholder; ?>"/>
                          </div>
                        </div>
                      <?php } ?>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      <?php } ?>
    <?php } ?>
    

    <?php if (get_row_layout() == 'galleria') { ?>
      <!-- ! Galleria -->
      <?php
        $mostra_sezione = get_sub_field('mostra_sezione');
        $immagini = get_sub_field('galleria_immagini');
      ?>
      <?php if ( $mostra_sezione && $immagini ) { ?>
        <section class="relative space-top-half">
          <div class="div--container">
            <div class="common--grid">
              <div data-aos="fade-in" class="col-span-12 ">
                <div class="swiper swiper-contenutoflessibile-galleria">
                  <div class="swiper-wrapper">
                    <?php foreach($immagini as $image){ ?>
                      <div class="swiper-slide flex flex-col justify-center h-auto">
                        <div class="max-h-[65vh] lg:max-h-[75vh] mx-auto overflow-hidden">
                          <img src="<?php echo $image['url']; ?>" class="w-auto h-full object-cover object-center"/>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="navigation gap-2 flex items-center mt-4 justify-center">
                    <div class="be-button-prev">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                      </svg>
                    </div>
                    <div class="be-button-next">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      <?php } ?>
    <?php } ?>


    <?php if (get_row_layout() == 'video_full') { ?>
      <!-- ! Video -->
      <?php
        $mostra_sezione = get_sub_field('mostra_sezione');
        $sorgente = get_sub_field('sorgente_video');
        $self_mp4 = get_sub_field('self_mp4');
        $self_webm = get_sub_field('self_webm');
        $yt_embed = get_sub_field('yt_embed');
        $vimeo_embed = get_sub_field('vimeo_embed');
      ?>
      <?php if ($mostra_sezione) { ?>
        <section class="relative space-top-half">
          <div class="div--container">
            <div class="common--grid">
              <?php if ($sorgente == "yt") { ?>
                <div class="be-video-container col-span-12 overflow-hidden aspect-[16/9]">
                  <?php if ($yt_embed) { ?>
                  <iframe
                    class="object-cover object-center w-full h-full"
                    src="<?php echo $yt_embed; ?>"
                    frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope;"
                    allowfullscreen>
                  </iframe>
                  <?php } ?>
                </div>
              <?php } else if ($sorgente == "sh") { ?>
                <div class="col-span-12 be-video-container overflow-hidden aspect-[16/9]">
                  <?php if ($self_mp4 && $self_webm) { ?>
                    <video class="w-full h-full object-cover object-center" controls playsinline>
                      <source src="<?php echo $self_mp4['url']; ?>" type="video/mp4">
                      <source src="<?php echo $self_webm['url']; ?>" type="video/webm">
                    </video>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
          </div>
        </section>
      <?php } ?>
    <?php } ?>

  <?php } ?>

<?php } ?>