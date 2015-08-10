<?php 
/*
 * Plugin Name: BM Plugin 
 * Description: Add Custom Post Type and Widget
 * Author: BerryMakeup
 * Version: 1.0
 */

//reference from Wordpress Codex 

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

// Creating the widget
class bm_widget extends WP_Widget {
  // Register widget with wordpress 
    function __construct() {
          parent::__construct(
                    'bm_widget', // Base ID
                    __('BM Widget', 'BM_widget_domain'), //Name
                    array( 'description' => __( 'Display posts from a Custom Post Type', 'bm_widget_domain' ), ) // Description 
          );
    }

// Front-end display of widget
    public function widget( $args, $instance ) {
    // before and after widget arguments are defined by themes
          echo $args['before_widget'];
          if ( ! empty( $instance['title'] ) ) {
                echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
          }
    // This is where you run the code and display the output
          echo __( 'hi', 
            'bm_widget_domain' );
          echo $args['after_widget'];
}

// Widget Backend

public function form( $instance ) {
          if ( isset( $instance[ 'title' ] ) ) {
          $title = $instance[ 'title' ];
          }
          else {
          $title = __( 'New title', 'bm_widget_domain' );
          }

          // Widget admin form
          ?>
          <p>
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
          </p>
          <?php
          }

// Updating widget replacing old instances with new

public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] 
) : '';

        return $instance;

}

} // Class bm_widget ends here

// Register and load the widget

function bm_load_widget() {
    register_widget( 'bm_widget' );
}
  add_action( 'widgets_init', 'bm_load_widget' );

