/**
 * Customizer custom js
 */

jQuery(document).ready(function() {
   jQuery('.wp-full-overlay-sidebar-content').prepend('<div class="train-ads"><a href="http://oceanwebthemes.com/webthemes/trainplus-premium-wordpress-theme/" class="button" target="_blank">{pro}</a></div>'.replace('{pro}',train_customizer_pro_js_obj.pro));
});