<?php 
/*
 * Plugin Name: BM Plugin 
 * Description: Add Custom Post Type and Widget
 * Author: BerryMakeup: YiBing Zhao, Tiffany Haoxin Lam, Melany Kim
 * Version: 1.0
 */

//reference from Wordpress Codex 

/* ------------------------
 Enqueue plugin stylesheet 
 ---------------------------*/

function enqueue_bm_stylesheet() {

    wp_register_style( 'myCSS', plugins_url( '/css/style.css', __FILE__ ) );
    wp_enqueue_style( 'myCSS' ); 
}
add_action( 'wp_enqueue_scripts', 'enqueue_bm_stylesheet' );

/* ---------------------
   Add custom post type 
   ---------------------*/
add_action( 'init', 'create_post_type' );

    function create_post_type() {
    register_post_type( 'bm_tutorial', //text domain of custom post type
        array(
            'labels' => array(
                'name' => 'Tutorials', //Name 
                'singular_name' => 'Tutorial', 
                'add_new' => 'Add New', //Functions 
                'add_new_item' => 'Add New Tutorial',
                'edit' => 'Edit',
                'edit_item' => 'Edit Tutorial',
                'new_item' => 'New Tutorial',
                'view' => 'View',
                'view_item' => 'View Tutorial',
                'search_items' => 'Search Tutorial',
                'not_found' => 'No Tutorial found',
                'not_found_in_trash' => 'No Tutorial found in Trash',
                'parent' => 'Parent Tutorial'
            ),
 
            'public' => true,
            'menu_position' => 15,
            //Enable thumbnail image
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail' ),
            'taxonomies' => array( '' ),
            'has_archive' => true
        )
    );
}

/* ---------------------
   Creating the widget 
   ---------------------*/

class bm_widget extends WP_Widget {
     
      // Register widget with wordpress   
        function __construct() {
          parent::__construct(
            'bm_widget', // Base ID
            __('BM Widget', 'bm_widget'), //Name
            array( 'description' => __( 'Display posts from a Custom Post Type', 'bm_widget' ), ) // Description 
          );
        }
       
      // Front-end display of widget
        function widget($args, $instance) {
          extract($args, EXTR_SKIP);
            echo $before_widget;
            $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
            
            if (!empty($title))
            echo $before_title . $title . $after_title;;
      // Custom Post Type Query: bm_tutorial ?>
            <ul class="widget_list">
              <?php // Create and run custom loop
                  $custom_posts = new WP_Query();
                  //Define query post type bm_tutorial, show 3 post per page 
                  $custom_posts->query('post_type=bm_tutorial&posts_per_page=3');
                  //checks to see if query have post
                  while ($custom_posts->have_posts()) : $custom_posts->the_post();?>
                    <li> <?php //checks to see if there is a thumbnail/featured image
                        if ( has_post_thumbnail() ) {the_post_thumbnail();} 
                        //link the title to the post ?>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                     </li>
                  <?php endwhile; ?>
            </ul>
              <?php
           echo $after_widget;
        }
       
       // Widget Backend
   
        function form( $instance ) {
           $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
           ?>
           <p>
           <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
           <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
           </p>
           <?php 
         }

        // Updating widget replacing old instances with new

        function update( $new_instance, $old_instance ) {
           $instance = array();
           $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
           return $instance;
         } 
} // End class bm_widget 

/* ------------------------
    Register and Load Widget 
   --------------------------*/

function bm_load_widget() {
    register_widget( 'bm_widget' );
}
add_action( 'widgets_init', 'bm_load_widget' ); 
   