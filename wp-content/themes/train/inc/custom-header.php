<?php

/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 * @package Train
* @since 	2.0.1
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses train_theme_header_style()
 * @uses train_theme_admin_header_style()
 * @uses train_theme_admin_header_image()
 */

function train_theme_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'train_theme_custom_header_args', array(

		'default-text-color'     => '#005580',
		'width'                  => 1320,
		'height'                 => 90,
		'flex-height'            => true,
		'wp-head-callback'       => 'train_theme_header_style',
		
	) ) );

}

add_action( 'after_setup_theme', 'train_theme_custom_header_setup' );

if ( ! function_exists( 'train_theme_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see train_theme_custom_header_setup().
 */

function train_theme_header_style() {
	$header_text_color = get_header_textcolor();
	// If no custom options for text are set, let's bail

	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value.

	if ( HEADER_TEXTCOLOR === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title a,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		 
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>!important;
		}
		.logo-menu .site-title a {
		   color: #<?php echo esc_attr( $header_text_color ); ?>!important;
		}
		.logo-menu .navbar-nav > li > a{
			color: #<?php echo esc_attr( $header_text_color ); ?>!important;
		}
	<?php endif; ?>
	</style>
	<?php

}
endif; // train_theme_header_style

if ( ! function_exists( 'train_header_background' ) ) :		

 function train_header_background(){

 	?> 	<style type="text/css">

			.logo-menu{

				background: #f9f9f9 url('<?php header_image(); ?>')!important;
				background-size: cover!important;

				}

 	</style>

 	<?php

 }
 add_action( 'wp_head', 'train_header_background');

 endif;

 


 
