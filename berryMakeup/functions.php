<?php
/**
 * BerryMakeup functions and definitions
 *
 * @package BerryBeauty
 */

if ( ! function_exists( 'berrybeauty_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function berrybeauty_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on BerryBeauty, use a find and replace
	 * to change 'berrybeauty' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'berrybeauty', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'berrybeauty' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'berrybeauty_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // berrybeauty_setup
add_action( 'after_setup_theme', 'berrybeauty_setup' );

//add custom post type 
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


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function berrybeauty_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'berrybeauty_content_width', 640 );
}
add_action( 'after_setup_theme', 'berrybeauty_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function berrybeauty_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'berrybeauty' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'berrybeauty_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

function my_scripts_method() {
// register your script location, dependencies and version
   wp_register_script('custom_script',
   get_template_directory_uri() . '/js/slider.js',
   array('jquery'),
   '1.0' );
 // enqueue the script
  wp_enqueue_script('custom_script');
  }
add_action('wp_enqueue_scripts', 'my_scripts_method');


function berrybeauty_scripts() {
	wp_enqueue_style( 'berrybeauty-style', get_stylesheet_uri() );

	wp_enqueue_script( 'berrybeauty-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'berrybeauty-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'berrybeauty_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * This will control the theme options 
 */
require get_stylesheet_directory() . '/inc/options.php';

//register mobile menu
function mobile_setup() {
register_nav_menu ('primary mobile', __( 'Navigation Mobile', 'BerryMakeup' ));
}
add_action( 'after_setup_theme', 'mobile_setup' );
 