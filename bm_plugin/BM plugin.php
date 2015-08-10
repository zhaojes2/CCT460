<?php 
/*
 * Plugin Name: BM Plugin 
 * Description: Add Custom Post Type and Widget
 * Author: BerryMakeup
 * Version: 1.0
 */

// add custom post type 

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'acme_tutorial',
    array(
      'labels' => array(
       'name' => __( 'Tutorials' ),
       'singular_name' => __( 'Tutorials' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
} 