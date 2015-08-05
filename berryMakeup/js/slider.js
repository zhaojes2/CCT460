/** Javascript reference 
* from http://www.designchemical.com/blog/index.php/jquery/jquery-image-swap-gallery/
*/
jQuery(document).ready(function() {
    // Image swap on hover
    jQuery("#gallery li img").hover(function(){
        jQuery('#main-img').attr('src',jQuery(this).attr('src').replace('thumb/', ''));
    });
    // Image preload
    var imgSwap = [];
     jQuery("#gallery li img").each(function(){
        imgUrl = this.src.replace('thumb/', '');
        imgSwap.push(imgUrl);
    });
    jQuery(imgSwap).preload();
});
$.fn.preload = function() {
    this.each(function(){
        jQuery('<img/>')[0].src = this;
    });
}