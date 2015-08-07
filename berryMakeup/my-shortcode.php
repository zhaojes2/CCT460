<?php
/*
 * Plugin Name: BerryMakeup Shortcodes
 */

// Add Self-Closing Schortcode

function my_shortcode(){
	return "<p>You may also love...</p>";
}
add_shortcode( 'my_shortcode','my_shortcode');
