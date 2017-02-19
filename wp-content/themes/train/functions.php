<?php
/**
 * train functions and definitions
 *
 * @package Train
 * @since 	1.0.9
 */

if ( ! function_exists( 'train_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function train_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on train, use a find and replace
	 * to change 'train' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'train', get_template_directory() . '/languages' );

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
	set_post_thumbnail_size( 571, 373, true );
	add_image_size( 'train-slider-thumb', 1920, 500, true ); // Homepage blog Images
	add_image_size( 'train-home-thumb', 360, 240, array( 'center', 'center') ); // Homepage blog Images
	
	

	/* woocommerce support */
	add_theme_support( 'woocommerce' );
	

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'train' ),
		'secondary' => esc_html__( 'Footer Menu', 'train' ),
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
    
    /*
	 * Enable support for Custom Logo.
	 */
    add_theme_support( 'custom-logo', array(
      'height'      => 45,
      'width'       => 200,
      'flex-height' => true,
      'flex-width'  => true,  
    ) ); 

	/*
	 * Enable support for Custom Background.
	 */
	add_theme_support( 'custom-background', apply_filters( 'train_theme_custom_background_args', array(
		'default-color' => 'e1e1e1',
		'default-image' => '',
	) ) );
}
endif; // train_theme_setup
add_action( 'after_setup_theme', 'train_theme_setup' );

/**
 * Enqueue scripts and styles.
 */

function train_theme_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css' );	
	wp_enqueue_style( 'fontawesome', get_template_directory_uri().'/css/font-awesome.css' );
	wp_enqueue_style( 'animate-css', get_template_directory_uri().'/css/animate.css' );
	wp_enqueue_style( 'custom-css', get_template_directory_uri().'/css/custom.css' );
        add_editor_style( 'custom-css', get_template_directory_uri().'/css/custom.css' );
    
    if(is_rtl()) {
		wp_enqueue_style( 'rtl-css', get_template_directory_uri().'/css/rtl.css' );
		wp_enqueue_style( 'custom-rtl', get_template_directory_uri().'/css/custom-rtl.css' );
		wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri().'/css/bootstrap-rtl.css' );
		wp_enqueue_script( 'bootstrap-js-rtl-js', get_template_directory_uri() . '/js/bootstrap.rtl.js', array(), '1.0.0', true );
       
	}
    wp_enqueue_script('jquery');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array(), '1.0.0', true );
	wp_enqueue_script( 'wow-js', get_template_directory_uri() . '/js/wow.js', array(), '1.0.0', true );
	wp_enqueue_script( 'script-js', get_template_directory_uri() . '/js/script.js', array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'train_theme_scripts' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! isset( $content_width ) ) $content_width = 900;
function train_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'train_theme_content_width', 640 );

}
add_action( 'after_setup_theme', 'train_theme_content_width', 0 );


function train_theme_filter_front_page_template( $template ) {
    return is_home() ? '' : $template;
}
add_filter( 'front_page_template', 'train_theme_filter_front_page_template' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function train_theme_widgets_init() {

	register_sidebar( array(
		'name'          => __('Sidebar Right','train'),
		'class'			=> 'sidebar',
		'id'            => 'category_right_1',
		'before_widget' => '<div class="single">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="side-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
			'name'          => __('Sidebar Left','train'),
			'id'            => 'category_left_1',
			'before_widget' => '<div class="single">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="side-title">',
			'after_title'   => '</h3>',
		) );

	
	register_sidebar( array(
			'name'          => __('Footer Sidebar','train'),
			'id'            => 'footer_1',
			'before_widget' => '<div class="col-md-3 col-sm-6 single">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );

}
add_action( 'widgets_init', 'train_theme_widgets_init' );


/*Excerpt */

function train_excerpt( $length ) {
			
		      return 30;
		}
		add_filter( 'excerpt_length', 'train_excerpt', 999 );
		function train_excerpt_more( $more ) {
		    return '...';
		}
add_filter( 'excerpt_more', 'train_excerpt_more' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/custom-train.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// Register Custom Navigation Walker
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';