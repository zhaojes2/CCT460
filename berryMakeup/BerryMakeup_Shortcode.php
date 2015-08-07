<?php
/*
 * Plugin Name: BerryMakeup Shortcode
 * Plugin URI: http://codediva.com
 * Description: You May Also Love
 * Author: Eun Ji Kim
 * Version: 1.0
 * Author URI: http://codediva.com
 */

// Enqueue plugin stylesheet 
function enqueue_style_sheet() {
	wp_enqueue_style( 'stylesheet', plugins_url('style.css') );
}
add_action( 'wp_enqueue_scripts', 'enqueue_style_sheet' );

/* Creates a div and lets user set color of the text 
 * 		can be used as [text_color] content [/text_color]
 *		user can edit color in the css file	
 */	
function color_short_code( $atts , $content = null ) {
return '<div class="textcolor">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'text_color', 'color_short_code' );

/* Creates a Button and allows users to specify the button's text, link and the colour
 *		can be used as [button link="#"]Button Name[/button]
 *		user can edit color in css file 
 */
function sButton($atts, $content = null) {
   extract(shortcode_atts(array
   		('link' => '#'), $atts));
   return '<a class="button" href="'.$link.'"><span>' . $content. '</span></a>';
}
add_shortcode('button', 'sButton');