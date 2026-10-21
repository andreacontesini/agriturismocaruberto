jQuery(document).ready(function($){
  
  if($('.accordion-list').length > 0){
    $('.accordion-list > .accordion-element .content').hide(); 
    $('.accordion-list > .accordion-element.activeAccordion .content').show();
    
    $('.accordion-list .js--trigger-accordion-click').click(function() {
      $parent = $(this).parent();
      if ($($parent).hasClass("activeAccordion")) {
        $($parent).removeClass("activeAccordion").find(".content").slideUp();
      } else {
        $('.accordion-list > .accordion-element .content').slideUp();
        $('.accordion-list > .accordion-element').removeClass("activeAccordion");
        $($parent).addClass("activeAccordion").find(".content").slideDown();
      }
      return false;
    });
  }
  
});