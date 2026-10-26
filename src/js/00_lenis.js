// ---------------------------------------------------- LENIS SMOOTH SCROLL ---------------------------------------------------- //
// Lenis scrolla la window nativamente: gli eventi "scroll" continuano a scattare, quindi AOS funziona senza modifiche.
// L'istanza è esposta su window.beLenis per gli altri script (es. 00_scrollToId.js).

(function () {
  if (typeof Lenis === 'undefined') return;
  if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  var lenis = new Lenis({
    lerp: 0.1,
    smoothWheel: true,
    syncTouch: false, // su touch resta lo scroll nativo
    autoRaf: true
  });

  window.beLenis = lenis;

  // Ricalcola le dimensioni a pagina caricata (immagini, font) e aggiorna AOS
  window.addEventListener('load', function () {
    lenis.resize();
    if (typeof AOS !== 'undefined') AOS.refresh();
  });
})();
