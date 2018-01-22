<?php
/**
 * minibuzz functions and definitions
 *
 * @package minibuzz
 * @since minibuzz 5.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since minibuzz 5.0
 */

if ( ! isset( $content_width ) ) {
	$content_width = 1000;
}


if ( ! function_exists( 'minibuzzts_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since minibuzz 5.0
 */
function minibuzzts_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on minibuzzts, use a find and replace
	 * to change 'minibuzzts' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'minibuzzts', get_template_directory() . '/languages' );

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
	 * Enable support for custom logo.
	 *
	 *  @since delicious 5.0
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 180,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'minibuzzts-portfolio-img', 420, 235, true );
	add_image_size( 'minibuzzts-testimonial-img', 80, 80, true );
	add_image_size( 'minibuzzts-feature-img', 196, 70, true );
	add_image_size( 'minibuzzts-recent-img', 70, 70, true );
	add_image_size( 'minibuzzts-blog-img', 595, 210, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' =>  esc_html__( 'Primary Menu', 'minibuzzts' ),
	) );

	/*
	 * Switch default core markup for comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form', 'gallery', 'caption'
	) );


	// link a custom stylesheet file to the TinyMCE visual editor
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Open+Sans' );
	add_editor_style( array('css/editor-style.css', $font_url) );
	
	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/includes/template-tags.php';
	
	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	
}
endif; // minibuzzts_setup
add_action( 'after_setup_theme', 'minibuzzts_setup' );

/**
 * The excerpt based on words
 *
 * @since minibuzz 5.0
 */
if(!function_exists("minibuzzts_string_limit_words")){
	function minibuzzts_string_limit_words($string, $word_limit){
	  $words = explode(' ', $string, ($word_limit + 1));
	  if(count($words) > $word_limit)
	  array_pop($words);
	  
	  return implode(' ', $words);
	}
}


/**
 * The Extend WordPress With Custom Fields
 *
 * @since minibuzz 5.0
 */
 
if( !function_exists('minibuzzts_is_pagepost')){
	function minibuzzts_is_pagepost(){
		global $post;
		
		if( is_404() || is_archive() || is_attachment() || is_search() ){
			$custom = false;
		}else{
			$custom = true;
		}
		
		return $custom;
	}
}

if( !function_exists('minibuzzts_get_customdata')){
	function minibuzzts_get_customdata($pid=""){
		global $post;
		
		if($pid!=""){
			$custom = get_post_custom($pid);
		}elseif( minibuzzts_is_pagepost() ){
			$custom = get_post_custom(get_the_ID());
		}else{
			$custom = array();
		}
		
		return $custom;
	}
}


/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 *
 * @since minibuzz 5.0
 */
function minibuzzts_excerpt_more( $more ) {
    return ' ...';
}
add_filter( 'excerpt_more', 'minibuzzts_excerpt_more' );


/**
 * Edit Shortcuts in Customizer Preview for Site Title and Site Description
 *
 * @since minibuzz 5.0
 */

function minibuzzts_theme_customize_register( WP_Customize_Manager $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	 
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'minibuzzts_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'minibuzzts_customize_partial_blogdescription',
	) );
}
add_action( 'customize_register', 'minibuzzts_theme_customize_register' );

/**
 * Filter the output of logo to fix validator.w3.org Error about itemprop logo
 *
 * @since minibuzz 5.0
 */

function minibuzzts_itemprop_logo() {
    $custom_logo_id = esc_attr(get_theme_mod( 'custom_logo' ));
    $html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" >%2$s</a>',
            esc_url( home_url( '/' ) ),
            wp_get_attachment_image( esc_attr($custom_logo_id), 'full', false, array(
                'class'    => 'custom-logo',
            ) )
        );
    return $html;   
}
add_filter( 'get_custom_logo', 'minibuzzts_itemprop_logo' );