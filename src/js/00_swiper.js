jQuery(document).ready(function($){
  
  // ---------------------------------------------------- CONTENUTO FLESSIBILE ---------------------------------------------------- //
  

  if($('.swiper-contenutoflessibile-galleria').length > 0){
    var swiperContenutoflessibileGalleria = new Swiper('.swiper-contenutoflessibile-galleria', {
      loop: true,
      centeredSlides: true,
      slidesPerView: 1,
      speed: 1000,
      spaceBetween: 0,
      keyboard: true,
      grabCursor: true,
      navigation: {
        prevEl: '.be-button-prev',
        nextEl: '.be-button-next'
      }
    });
  }

  if ($('.swiper-contenutoflessibile-immagini').length > 0) {
    var swiperContenutoflessibileImmagini = new Swiper(".swiper-contenutoflessibile-immagini", {
      spaceBetween: 0,
      slidesPerView: 'auto',
      loop: true,
      speed: 1000,
      autoplay: {
        delay: 3000,
        stopOnLastSlide: false,
        pauseOnMouseEnter: false
      },
      keyboard: false,
      grabCursor: false,
      breakpoints: {
        1280: {
          allowTouchMove: false,
          autoplay: false,
        }
      },
    });
  }
  
});