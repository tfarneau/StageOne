<?php
/**
 * stageone functions and definitions
 *
 * @package stageone
 */

// FORMS

function __update_post_meta( $post_id, $field_name, $value = '' )
{
	if ( empty( $value ) OR ! $value )
	{
	    delete_post_meta( $post_id, $field_name );
	}
	elseif ( ! get_post_meta( $post_id, $field_name ) )
	{
	    add_post_meta( $post_id, $field_name, $value );
	}
	else
	{
	    update_post_meta( $post_id, $field_name, $value );
	}
}

// END FORMS

add_filter( 'posts_clauses', function( $pieces )
{
	global $wpdb, $INCLUDE_SIZE;
 
	if ( empty($INCLUDE_TAXO) )
		return $pieces;
 
	$pieces['join'] .= " LEFT JOIN $wpdb->term_relationships iqctr ON iqctr.object_id=$wpdb->posts.ID
						 LEFT JOIN $wpdb->term_taxonomy iqctt ON iqctt.term_taxonomy_id=iqctr.term_taxonomy_id AND iqctt.taxonomy='genre'
						 LEFT JOIN $wpdb->terms iqct ON iqct.term_id=iqctt.term_id";
	$pieces['fields'] .= ",GROUP_CONCAT(iqct.name SEPARATOR ', ') AS genres";
 
	return $pieces;
}, 10, 1 );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'stageone_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function stageone_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on stageone, use a find and replace
	 * to change 'stageone' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'stageone', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'stageone' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'stageone_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // stageone_setup
add_action( 'after_setup_theme', 'stageone_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function stageone_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'stageone' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'stageone_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function stageone_scripts() {
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/main.css' );
	
	wp_enqueue_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', array(), '20120206', true );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js', array(), '20120206', true );
	wp_enqueue_script( 'gmaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAhE4dy6-EBZ2uxj7ajkvf0YOn9OFK-8_c', array(), '20120206', true );

	wp_enqueue_script( 'app', get_template_directory_uri() . '/js/app.min.js', array(), '20120206', true );
	wp_enqueue_script( 'ajax', get_template_directory_uri() . '/js/script.js', array(), '20120206', true );

}
add_action( 'wp_enqueue_scripts', 'stageone_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
