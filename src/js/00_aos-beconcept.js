jQuery(document).ready(function($){
  AOS.init({
		// Global settings:
		disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
		startEvent: 'load',
		initClassName: 'aos-init', // class applied after initialization
		animatedClassName: 'aos-animate', // class applied on animation
		useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
		disableMutationObserver: false, // disables automatic mutations' detections (advanced)
		debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
		throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)
		// Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
		offset: 60, // offset (in px) from the original trigger point
		// delay: 400, // values from 0 to 3000, with step 50ms
		duration: 600, // values from 0 to 3000, with step 50ms
		easing: 'ease', // default easing for AOS animations
		once: true, // whether animation should happen only once - while scrolling down
		mirror: false, // whether elements should animate out while scrolling past them
		anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
	});
});

// Forza il refresh dopo il caricamento completo della pagina
$(window).on('load', function() {
AOS.refresh();
	if (typeof ScrollTrigger !== 'undefined') {
	  ScrollTrigger.refresh();
	}
});

// Mantiene aggiornato AOS (e ScrollTrigger se presente) su resize/scroll
$(window).on('resize scroll', function() {
AOS.refresh();
	if (typeof ScrollTrigger !== 'undefined') {
	  ScrollTrigger.refresh();
	}
});
