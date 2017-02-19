//Tab to top
jQuery(window).scroll(function($) {
    if (jQuery(this).scrollTop() > 1){
        jQuery('.scroll-top-wrapper').addClass("show");
    }
    else{
        jQuery('.scroll-top-wrapper').removeClass("show");
    }
});
jQuery(".scroll-top-wrapper").on("click", function($) {
    jQuery("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});
// Contact Form
jQuery('.wpcf7-file').after('<label class="file-label">Upload File</label>');
// Remove Placeholder
jQuery('input,textarea').focus(function($){
   $(this).data('placeholder',$(this).attr('placeholder'))
   $(this).attr('placeholder','');
});
jQuery('input,textarea').blur(function($){
   $(this).attr('placeholder',$(this).data('placeholder'));
});
jQuery('.navbar .dropdown').hover(function($) {
      jQuery(this).find('.dropdown-menu').first().stop(true, true).slideDown(150);
    }, function() {
      jQuery(this).find('.dropdown-menu').first().stop(true, true).slideUp(105)
    });
// Animations
new WOW().init();
