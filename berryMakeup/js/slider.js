jQuery(document).ready(function(jQuery) {
    jQuery("#gallery li img").hover(function(){
        jQuery('#main-img').attr('src',jQuery(this).attr('src').replace('thumb/', '')).parent().attr('href',jQuery(this).parent().attr('href'));
    });
});