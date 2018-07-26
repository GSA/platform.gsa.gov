<?php

 
if ( ! function_exists( 'minibuzzts_fonts_url' ) ) :
/**
 * Register Google fonts for minibuzz.
 *
 * Create your own minibuzzts_fonts_url() function to override in a child theme.
 *
 * @since minibuzz 5.0
 *
 * @return string Google fonts URL for the theme.
 */
function minibuzzts_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Metrophobic, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Metrophobic font: on or off', 'minibuzzts' ) ) {
		$fonts[] = 'Metrophobic:400,200,300,700';
	}


	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;
 
/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since minibuzz 5.0
 */
function minibuzzts_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'minibuzzts_javascript_detection', 0 );


/**
 * Enqueue scripts and styles.
 *
 * @since minibuzz 5.0
 */ 
function minibuzzts_scripts() {
	
	if ( is_page_template( 'page-templates/portfolio.php') || is_tax('jetpack-portfolio-type') || is_tax('jetpack-portfolio-tag')) {
		wp_enqueue_script('isotope', get_template_directory_uri().'/js/isotope.pkgd.min.js', array('jquery'), '2.2.2', true);
		wp_enqueue_script( 'minibuzzts-portfolio', get_template_directory_uri() . '/js/minibuzzts-portfolio.js', array( 'jquery' ), '', true );
	}
	
	if ( is_front_page() ) { 
		wp_enqueue_script('camera', get_template_directory_uri().'/js/camera.js', array('jquery'), '1.4.0', true);
		wp_enqueue_script('camera-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ), '1.3', true );
		wp_enqueue_script('camera-jquery.mobile.customized.min', get_template_directory_uri().'/js/jquery.mobile.customized.min.js', array('jquery'), '1.4.0', true);
		wp_enqueue_style('camera', get_template_directory_uri().'/css/camera.css', array(), '');
		wp_enqueue_script('minibuzzts-slider', get_stylesheet_directory_uri().'/js/minibuzzts-slider.js', array('jquery'), '', true);
	
	}
	
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'minibuzzts-fonts', minibuzzts_fonts_url(), array(), null );
	
	// Load stylesheet and scripts custom pages.

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	
	// Load our stylesheet.
	wp_enqueue_style('minibuzzts-skeleton', get_template_directory_uri().'/css/skeleton.css', array(), '1.0');
	
	wp_enqueue_style('minibuzzts-style', get_stylesheet_uri() );
	wp_enqueue_style('minibuzzts-layout', get_stylesheet_directory_uri().'/css/layout.css', array(), '2.6.0');
	

	// Load our scripts.
	wp_enqueue_script('superfish', get_template_directory_uri().'/js/superfish.js', array('jquery'), '1.7.9', true);
	wp_enqueue_script('hoverIntent', get_template_directory_uri().'/js/hoverIntent.js', array('jquery'), '0.3', true);
	wp_enqueue_script('tinynav', get_template_directory_uri().'/js/tinynav.js', array('jquery'), '1.2', true);

	wp_enqueue_script('minibuzzts-custom', get_stylesheet_directory_uri().'/js/minibuzzts-custom.js', array('jquery'), '1.0', true);
	
	

}
add_action( 'wp_enqueue_scripts', 'minibuzzts_scripts' );
