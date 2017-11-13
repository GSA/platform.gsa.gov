<?php
/**
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 *
 * Layout Functions:
 * 
 * st_header  // Opening header tag and logo/header text
 * st_header_extras // Additional content may be added to the header
 * st_navbar // Opening navigation element and WP3 menus
 * st_before_content // Opening content wrapper 
 * st_after_content // Closing content wrapper 
 * st_before_sidebar // Opening sidebar wrapper 
 * st_after_sidebar // Closing sidebar wrapper 
 * st_before_footer // Opening footer wrapper 
 * st_footer // The footer (includes sidebar-footer.php)
 * st_after_footer // The closing footer wrapper 
 * 
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, skeleton_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'skeleton_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */

/*-----------------------------------------------------------------------------------*/
/* Set Proper Parent/Child theme paths for inclusion
/*-----------------------------------------------------------------------------------*/

@define( 'PARENT_DIR', get_template_directory() );
@define( 'CHILD_DIR', get_stylesheet_directory() );

@define( 'PARENT_URL', get_template_directory_uri() );
@define( 'CHILD_URL', get_stylesheet_directory_uri() );


/*-----------------------------------------------------------------------------------*/
/* Initialize the Options Framework
/* http://wptheming.com/options-framework-theme/
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {

    define('OPTIONS_FRAMEWORK_URL', PARENT_URL . '/admin/');
    define('OPTIONS_FRAMEWORK_DIRECTORY', PARENT_DIR . '/admin/');

require_once (OPTIONS_FRAMEWORK_DIRECTORY . 'options-framework.php');

}

if ( class_exists( 'jigoshop' ) ) {
require_once (PARENT_DIR . '/jigoshop_functions.php');
}

if ( class_exists( 'bbPress' ) ) {
require_once (PARENT_DIR . '/bbpress/bbpress_functions.php');
}


require_once (PARENT_DIR . '/shortcodes.php');

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 */
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

if (!function_exists('optionsframework_custom_scripts')) {

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#use_logo_image').click(function() {
		jQuery('#section-header_logo,#section-logo_width,#section-logo_height').fadeToggle(400);
	});
	
	if (jQuery('#use_logo_image:checked').val() !== undefined) {
		jQuery('#section-header_logo,#section-logo_width,#section-logo_height').show();
	}
	
});
</script>

<?php
}
}


// Register Core Stylesheets
// These are necessary for the theme to function as intended
// Supports the 'Better WordPress Minify' plugin to properly minimize styleshsets into one.
// http://wordpress.org/extend/plugins/bwp-minify/

if ( !function_exists( 'st_registerstyles' ) ) {

add_action('get_header', 'st_registerstyles');
function st_registerstyles() {
	$theme  = wp_get_theme();
	$version = $theme['Version'];
  	$stylesheets = wp_enqueue_style('skeleton', get_bloginfo('template_directory').'/skeleton.css', false, $version, 'screen, projection');
    $stylesheets .= wp_enqueue_style('theme', get_bloginfo('stylesheet_directory').'/style.css', 'skeleton', filemtime( get_stylesheet_directory() . '/style.css'), 'screen, projection');
  	$stylesheets .= wp_enqueue_style('layout', get_bloginfo('template_directory').'/layout.css', 'theme', $version, 'screen, projection');
    $stylesheets .= wp_enqueue_style('formalize', get_bloginfo('template_directory').'/formalize.css', 'theme', $version, 'screen, projection');
    $stylesheets .= wp_enqueue_style('superfish', get_bloginfo('template_directory').'/superfish.css', 'theme', $version, 'screen, projection');
		if ( class_exists( 'jigoshop' ) ) {
	  $stylesheets .= wp_enqueue_style('jigoshop', get_bloginfo('template_directory').'/jigoshop.css', 'theme', $version, 'screen, projection');
		}
		echo apply_filters ('child_add_stylesheets',$stylesheets);
}

}

// Build Query vars for dynamic theme option CSS from Options Framework

if ( !function_exists( 'production_stylesheet' )) {

function production_stylesheet($public_query_vars) {
    $public_query_vars[] = 'get_styles';
    return $public_query_vars;
}
add_filter('query_vars', 'production_stylesheet');
}

if ( !function_exists( 'theme_css' ) ) {

add_action('template_redirect', 'theme_css');
function theme_css(){
    $css = get_query_var('get_styles');
    if ($css == 'css'){
        include_once (PARENT_DIR . '/style.php');
        exit;  //This stops WP from loading any further
    }
}

}

if ( !function_exists( 'st_header_scripts' ) ) {

add_action('init', 'st_header_scripts');
function st_header_scripts() {
  $javascripts  = wp_enqueue_script('jquery');
  $javascripts .= wp_enqueue_script('custom',get_bloginfo('template_url') ."/javascripts/app.js",array('jquery'),'1.2.3',true);
	$javascripts .= wp_enqueue_script('superfish',get_bloginfo('template_url') ."/javascripts/superfish.js",array('jquery'),'1.2.3',true);
	$javascripts .= wp_enqueue_script('formalize',get_bloginfo('template_url') ."/javascripts/jquery.formalize.min.js",array('jquery'),'1.2.3',true);
	echo apply_filters ('child_add_javascripts',$javascripts);
}

}

// Instead of remove_filter('the_content', 'wpautop');
// The function below removes wp_autop from specified pages with a custom field:
// Name: wpautop Value: false

function st_remove_wpautop($content) {
    global $post;
    // Get the keys and values of the custom fields:
    $rmwpautop = get_post_meta($post->ID, 'wpautop', true);
    // Remove the filter
    remove_filter('the_content', 'wpautop');
    if ('false' === $rmwpautop) {
    } else {
    add_filter('the_content', 'wpautop');
    }
    return $content;
}
// Hook into the Plugin API
add_filter('the_content', 'st_remove_wpautop', 9);


/** Tell WordPress to run skeleton_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'skeleton_setup' );

if ( ! function_exists( 'skeleton_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override skeleton_setup() in a child theme, add your own skeleton_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Skeleton 1.0
 */
function skeleton_setup() {
	
	if ( class_exists( 'bbPress' ) ) {
	add_theme_support( 'bbpress' );
	}
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	// add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// Register the available menus
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'skeleton' ),
	));

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'smpl', PARENT_DIR . '/languages' );

	$locale = get_locale();
	$locale_file = PARENT_DIR . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );


		// No support for text inside the header image.
		if ( ! defined( 'NO_HEADER_TEXT' ) )
			define( 'NO_HEADER_TEXT', true );
			
		if ( ! defined( 'HEADER_IMAGE_WIDTH') )
			define( 'HEADER_IMAGE_WIDTH', apply_filters( 'skeleton_header_image_width',960));
			
			
		if ( ! defined( 'HEADER_IMAGE_HEIGHT') )
			define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'skeleton_header_image_height',185 ));

		// Add a way for the custom header to be styled in the admin panel that controls
		// custom headers. See skeleton_admin_header_style(), below.
		add_custom_image_header( '', 'skeleton_admin_header_style' );

		// ... and thus ends the changeable header business.

		// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
		register_default_headers( array(
			'berries' => array(
				'url' => '%s/images/headers/berries.jpg',
				'thumbnail_url' => '%s/images/headers/berries-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Berries', 'skeleton' )
			),
			'cherryblossom' => array(
				'url' => '%s/images/headers/cherryblossoms.jpg',
				'thumbnail_url' => '%s/images/headers/cherryblossoms-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Cherry Blossoms', 'skeleton' )
			),
			'concave' => array(
				'url' => '%s/images/headers/concave.jpg',
				'thumbnail_url' => '%s/images/headers/concave-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Concave', 'skeleton' )
			),
			'fern' => array(
				'url' => '%s/images/headers/fern.jpg',
				'thumbnail_url' => '%s/images/headers/fern-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Fern', 'skeleton' )
			),
			'forestfloor' => array(
				'url' => '%s/images/headers/forestfloor.jpg',
				'thumbnail_url' => '%s/images/headers/forestfloor-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Forest Floor', 'skeleton' )
			),
			'inkwell' => array(
				'url' => '%s/images/headers/inkwell.jpg',
				'thumbnail_url' => '%s/images/headers/inkwell-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Inkwell', 'skeleton' )
			),
			'path' => array(
				'url' => '%s/images/headers/path.jpg',
				'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Path', 'skeleton' )
			),
			'sunset' => array(
				'url' => '%s/images/headers/sunset.jpg',
				'thumbnail_url' => '%s/images/headers/sunset-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Sunset', 'skeleton' )
			)
		) );
	}
	endif;

	/**
	 * Styles the header image displayed on the Appearance > Header admin panel.
	 *
	 * Referenced via add_custom_image_header() in skeleton_setup().
	 *
	 * @since Skeleton 1.0
	 */
	if ( !function_exists( 'skeleton_admin_header_style' ) ) :

	function skeleton_admin_header_style() {
	?>
	<style type="text/css">
	/* Shows the same border as on front end */
	#headimg {
		border-bottom: 100px solid #000;
		border-top: 4px solid #000;
	}
	/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
		#headimg #name { }
		#headimg #desc { }
	*/
	</style>
	<?php
	}
	endif;

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Skeleton 1.0
 * @return int
 */
if ( !function_exists( 'skeleton_excerpt_length' ) ) {

function skeleton_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'skeleton_excerpt_length' );

}
/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Skeleton 1.0
 * @return string "Continue Reading" link
 */

if ( !function_exists( 'skeleton_continue_reading_link' ) ) {

function skeleton_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'skeleton' ) . '</a>';
}
}
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and skeleton_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Skeleton 1.0
 * @return string An ellipsis
 */

if ( !function_exists( 'skeleton_auto_excerpt_more' ) ) {

function skeleton_auto_excerpt_more( $more ) {
	return ' &hellip;' . skeleton_continue_reading_link();
}
add_filter( 'excerpt_more', 'skeleton_auto_excerpt_more' );

}
/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Skeleton 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
if ( !function_exists( 'skeleton_custom_excerpt_more' ) ) {

function skeleton_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= skeleton_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'skeleton_custom_excerpt_more' );

}
/**
 * Removes inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Skeleton's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Skeleton 1.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override st_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @uses register_sidebar
 */
//

if ( !function_exists( 'remove_more_jump_link' ) ) {

function remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
	$end = strpos($link, '"',$offset);
	}
	if ($end) {
	$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
	}
	add_filter('the_content_more_link', 'remove_more_jump_link');

}

if ( !function_exists( 'st_widgets_init' ) ) {

function st_widgets_init() {
		// Area 1, located at the top of the sidebar.
		register_sidebar( array(
		'name' => __( 'Posts Widget Area', 'skeleton' ),
		'id' => 'primary-widget-area',
		'description' => __( 'Shown only in Blog Posts, Archives, Categories, etc.', 'skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Pages Widget Area', 'skeleton' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'Shown only in Pages', 'skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Pages Widget Area2', 'skeleton' ),
		'id' => 'secondary-widget-area2',
		'description' => __( 'Shown only in Pages', 'skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'skeleton' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'skeleton' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'skeleton' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'skeleton' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'skeleton' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'skeleton' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'skeleton' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'skeleton' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Register bbPress sidebar if plugin is installed
	if ( class_exists( 'bbPress' ) ) {
	register_sidebar( array(
		'name' => __( 'Forum Sidebar', 'skeleton' ),
		'id' => 'bbpress-widget-area',
		'description' => __( 'Sidebar displayed in forum', 'skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	}
	
	// Register Jigoshop Cart sidebar if plugin is installed
	if ( class_exists( 'jigoshop' ) ) {
	register_sidebar( array(
		'name' => __( 'Jigoshop Sidebar', 'skeleton' ),
		'id' => 'shop-widget-area',
		'description' => __( 'Sidebar displayed in Jigoshop pages', 'skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	}
	
}
/** Register sidebars by running skeleton_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'st_widgets_init' );

}

/** Comment Styles */

if ( ! function_exists( 'st_comments' ) ) :
function st_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" class="single-comment clearfix">
				<div class="comment-author vcard"> <?php echo get_avatar($comment,$size='64',$default='<path_to_url>' ); ?></div>
				<div class="comment-meta commentmetadata">
						<?php if ($comment->comment_approved == '0') : ?>
						<em><?php _e('Comment is awaiting moderation','smpl');?></em> <br />
						<?php endif; ?>
						<h6><?php echo __('By','smpl').' '.get_comment_author_link(). ' '. get_comment_date(). '  -  ' . get_comment_time(); ?></h6>
						<?php comment_text() ?>
						<?php edit_comment_link(__('Edit comment','smpl'),'  ',''); ?>
						<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply','smpl'),'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</div>
		</div>
<!-- </li> -->
<?php  }
endif;

if ( ! function_exists( 'skeleton_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Skeleton 1.0
 */
function skeleton_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'skeleton' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'skeleton' ), get_the_author() ),
			get_the_author()
		)
	);
}

endif;

if ( ! function_exists( 'skeleton_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Skeleton 1.0
 */
function skeleton_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'skeleton' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'skeleton' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'skeleton' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}

endif;


// Header Functions

// Hook to add content before header

if ( !function_exists( 'st_above_header' ) ) {

function st_above_header() {
    do_action('st_above_header');
}

} // endif

// Primary Header Function

if ( !function_exists( 'st_header' ) ) {

function st_header() {
  do_action('st_header');
}

}


// Opening #header div with flexible grid

if ( !function_exists( 'st_header_open' ) ) {

function st_header_open() {
  echo "<div id=\"header\" class=\"sixteen columns\">\n<div class=\"ecpic_logo\"><a href=\"/\"><img src=\"https://www.ecpic.gov/files/2013/03/ecpic_logo.png\" alt=\"eCPIC logo\" border=\"0\"></a>";
}
} // endif

add_action('st_header','st_header_open', 1);


// Hookable theme option field to add add'l content to header
// Child Theme Override: child_header_extras();

if ( !function_exists( 'st_header_extras' ) ) {

function st_header_extras() {
	if (of_get_option('header_extra')) {
		$extras  = "<div class=\"header_extras\">";
		$extras .= of_get_option('header_extra');
		$extras .= "</div>";
		echo apply_filters ('child_header_extras',$extras);
	}
}
} // endif

add_action('st_header','st_header_extras', 2);


// Build the logo
// Child Theme Override: child_logo();
if ( !function_exists( 'st_logo' ) ) {

function st_logo() {
	// Displays H1 or DIV based on whether we are on the home page or not (SEO)
	$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
	if (of_get_option('use_logo_image')) {
		$class="graphic";
	} else {
		$class="text"; 		
	}
	// echo of_get_option('header_logo')
	//$st_logo  = '<'.$heading_tag.' id="site-title" class="'.$class.'"><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo('name','display')).'">'.get_bloginfo('name').'</a></'.$heading_tag.'>'. "\n";
	//$st_logo .= '<span class="site-desc '.$class.'">'.get_bloginfo('description').'</span>'. "\n";
	echo apply_filters ( 'child_logo' , $st_logo);
}
} // endif

add_action('st_header','st_logo', 3);



if ( !function_exists( 'logostyle' ) ) {

function logostyle() {
	if (of_get_option('use_logo_image')) {
	echo '<style type="text/css">
	#header #site-title.graphic a {background-image: url('.of_get_option('header_logo').');width: '.of_get_option('logo_width').'px;height: '.of_get_option('logo_height').'px;}</style>';
	}
}

} //endif

add_action('wp_head', 'logostyle');



if ( !function_exists( 'st_header_close' ) ) {

function st_header_close() {
	echo '</div><div id="header_right"><div id="header_search">';
	echo str_replace(array('<br/>', '<br>', '<br />'), ' ', get_search_form( false ));
	echo '</div><div class="ecpic_header_text">Electronic Capital Planning and Investment Control System</div></div><div class="navigation_spacer"></div></div><!--/#header-->';
}
} //endif

add_action('st_header','st_header_close', 4);



// Hook to add content after header

if ( !function_exists( 'st_below_header' ) ) {

function st_below_header() {
    do_action('st_below_header');
}

} //endif


// End Header Functions


// Navigation (menu)
if ( !function_exists( 'st_navbar' ) ) {

function st_navbar() {
	register_nav_menus(array(
        'defaultmenu2' => __('Name of Menu', 'responsive'),
        )
);
	echo '<div id="navigation" class="row sixteen columns">';
	if(current_user_can('administrator') || current_user_can('ecpicadmin') || current_user_can('ecpicuser') || current_user_can('curator'))
	{
		/*wp_nav_menu( array( 'menu' => 'defaultmenu2', 'container_class' => 'menu-header', 'theme_location' => 'primary', 'exclude' => '291,361,381,1051,1711,1781,2171,2221,2251,2281,2461,2591,2631,2781,2851,2891,3031,3111,3141,3501,4441'));*/
		wp_nav_menu( array( 'menu' => 'defaultmenu2', 'container_class' => 'menu-header', 'theme_location' => 'primary'));
	}
	elseif(current_user_can('grasshopper'))
	{
		wp_nav_menu( array( 'menu' => 'grasshopper', 'container_class' => 'menu-header', 'theme_location' => 'primary'));
	}
	else
	{
		wp_nav_menu( array( 'menu' => 'defaultmenu2', 'container_class' => 'menu-header', 'theme_location' => 'primary'));
	}
	echo '</div><!--/#navigation-->';
}

} //endif

// Before Content - st_before_content($columns);
// Child Theme Override: child_before_content();

if ( !function_exists( 'st_before_content' ) ) {

	function st_before_content($columns) {
	// 
	// Specify the number of columns in conditional statements
	// See http://codex.wordpress.org/Conditional_Tags for a full list
	//
	// If necessary, you can pass $columns as a variable in your template files:
	// st_before_content('six');
	//
	// Set the default
	
	if (empty($columns)) {
	$columns = 'eleven';
	} else {
	// Check the function for a returned variable
	$columns = $columns;
	}
	
	// Example of further conditionals:
	// (be sure to add the excess of 16 to st_before_sidebar as well)
	
	if (is_page_template('onecolumn-page.php')) {
	$columns = 'sixteen';
	}
	
	// check to see if bbpress is installed
	
	if ( class_exists( 'bbPress' ) ) {
	// force wide on bbPress pages
	if (is_bbpress()) {
	$columns = 'sixteen';
	}
	
	// unless it's the member profile
	if (bbp_is_user_home()) {
	$columns = 'eleven';
	}
	
	} // bbPress

	// Apply the markup
	echo "<a name=\"top\" id=\"top\"></a>";
	echo "<div id=\"content\" class=\"$columns columns\">";
	}
}


// After Content

if (! function_exists('st_after_content'))  {
    function st_after_content() {
    	echo "\t\t</div><!-- /.columns (#content) -->\n";
    }
}


// Before Sidebar - do_action('st_before_sidebar')

// call up the action
if ( !function_exists( 'before_sidebar' ) ) {
	
	function before_sidebar($columns) {
	// You can specify the number of columns in conditional statements
	// See http://codex.wordpress.org/Conditional_Tags for a full list
	//
	// If necessary, you can also pass $columns as a variable in your template files:
	// do_action('st_before_sidebar','six');
	//
	if (empty($columns)) {
	// Set the default
	$columns = 'five';
	} else {
	// Check the function for a returned variable
	$columns = $columns;
	}
	// Example of further conditionals:
	// (be sure to add the excess of 16 to st_before_content as well)
	// if (is_page() || is_single()) {
	// $columns = 'five';
	// } else {
	// $columns = 'four';
	// }
	// Apply the markup
	echo '<div id="sidebar" class="'.$columns.' columns" role="complementary">';
	}
} //endif
// create our hook
add_action( 'st_before_sidebar', 'before_sidebar');  



// After Sidebar
if ( !function_exists( 'after_sidebar' ) ) {
	function after_sidebar() {
	// Additional Content could be added here
	   echo '</div><!-- #sidebar -->';
	}
} //endif
add_action( 'st_after_sidebar', 'after_sidebar');  


// Before Footer

if (!function_exists('st_before_footer'))  {
    function st_before_footer() {
			$footerwidgets = is_active_sidebar('first-footer-widget-area') + is_active_sidebar('second-footer-widget-area') + is_active_sidebar('third-footer-widget-area') + is_active_sidebar('fourth-footer-widget-area');
			$class = ($footerwidgets == '0' ? 'noborder' : 'normal');
			echo '<div class="clear"></div><div id="footer" class="'.$class.' sixteen columns">';
    }
}

if ( !function_exists( 'st_footer' ) ) {

// The Footer
add_action('wp_footer', 'st_footer');
	do_action('st_footer');
	function st_footer() {
		//loads sidebar-footer.php
		get_sidebar( 'footer' );
		?>
		<br /><hr /><div id="ecpic_footer"><center><a href="/contact">Contact&nbsp;Us</a> &nbsp;|&nbsp; <a href="/privacy">Privacy&nbsp;Statement</a><span class="footer_break">&nbsp; |&nbsp;</span> <a href="/disclaimer">Disclaimer&nbsp;of&nbsp;Use</a> &nbsp;|&nbsp; <a href="/support">Product&nbsp;Support</a><span class="footer_break">&nbsp; |&nbsp;</span> <span class="footer_bottom"><a href="/site-map">Site&nbsp;Map</a></span></br />
eCPIC is a government-owned, managed, and distributed program</center></div>
		<?php
		// prints site credits
		/*echo '<div id="credits">';
		echo of_get_option('footer_text');
		echo '<br /><a class="themeauthor" href="http://www.simplethemes.com" title="Simple WordPress Themes">WordPress Themes</a></div>';*/
}

}


// After Footer

if (!function_exists('st_after_footer'))  {
	
    function st_after_footer() {
			echo "</div><!--/#footer-->"."\n";
			echo "</div><!--/#wrap.container-->"."\n";
			// Google Analytics
			if (of_get_option('footer_scripts') <> "" ) {
				echo '<script type="text/javascript">'.stripslashes(of_get_option('footer_scripts')).'</script>';
			}
    }
}



// Enable Shortcodes in excerpts and widgets
add_filter('widget_text', 'do_shortcode');
add_filter( 'the_excerpt', 'do_shortcode');
add_filter('get_the_excerpt', 'do_shortcode');


if (!function_exists('get_image_path'))  {
function get_image_path() {
	global $post;
	$id = get_post_thumbnail_id();
	// check to see if NextGen Gallery is present
	if(stripos($id,'ngg-') !== false && class_exists('nggdb')){
	$nggImage = nggdb::find_image(str_replace('ngg-','',$id));
	$thumbnail = array(
	$nggImage->imageURL,
	$nggImage->width,
	$nggImage->height
	);
	// otherwise, just get the wp thumbnail
	} else {
	$thumbnail = wp_get_attachment_image_src($id,'full', true);
	}
	$theimage = $thumbnail[0];
	return $theimage;
}
}

/*
 * override default filter for 'textarea' sanitization.
 */
 
add_action('admin_init','optionscheck_change_santiziation', 100);
 
function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'st_custom_sanitize_textarea' );
}

function st_custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
      "src" => array(),
      "type" => array(),
      "allowfullscreen" => array(),
      "allowscriptaccess" => array(),
      "height" => array(),
          "width" => array()
      );
    	$custom_allowedtags["script"] = array();
    	$custom_allowedtags["a"] = array('href' => array(),'title' => array());
    	$custom_allowedtags["img"] = array('src' => array(),'title' => array(),'alt' => array());
    	$custom_allowedtags["br"] = array();
    	$custom_allowedtags["em"] = array();
    	$custom_allowedtags["strong"] = array();
      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $custom_allowedtags);
    return $output;
        $of_custom_allowedtags = array_merge($of_custom_allowedtags, $allowedtags);
        $output = wp_kses( $input, $of_custom_allowedtags);
    return $output;
}

function the_breadcrumb() {
global $post;
	if (!is_home()) {
		echo '<div class="breadcrumb"><a href="';
		echo get_option('home');
		echo '">Home';
		echo "</a>";
		echo empty( $post->post_parent ) ? "" : " » <a href=\"".get_permalink($post->post_parent)."\">".get_the_title( $post->post_parent )."</a>";
		if (is_category() || is_single()) {
			the_category('title_li=');
			if (is_single()) {
				echo " » ";
				echo the_title();
			}
		} elseif (is_page() && !is_front_page()) {
			echo " » ";
			echo the_title();
		}
		echo "</div>";
	}
}

function login_func( $atts ){
 global $user_identity;
if (is_page('login') && !is_user_logged_in())
		$return_string = "";
else
{
 //$return_string = !is_front_page() ? "<h2>ADMINISTRATOR &amp; USER Login</h2>" : "";
 $return_string = "";
 $return_string .= "<div class=\"ecpic-login-box";
if ( is_user_logged_in())
 {
	$return_string .= " logged-in\">";
 	$return_string .= "Logged in as:".$user_identity."<br /><br />";
	$return_string .="<a href=\"".wp_logout_url(home_url())."\">Logout</a> |";

 	if (current_user_can('manage_options')) { 
		$return_string .= ' <a href="' . admin_url() . '">' . __('Your admin page') . '</a>'; } else { 
		$return_string .= ' <a href="' . admin_url() . 'profile.php">' . __('Your profile page') . '</a>'; 
	}
	if(is_front_page())
	{
		if(current_user_can('administrator') || current_user_can('curator') || current_user_can('ecpicadmin'))
		{
		$return_string .="<br /><span style=\"display:block;margin-top:15px;\"><a style=\"font-size:16px;\" href=\"".site_url('materials-for-administrator')."\">Click for Downloads</a></span>";
		}
		elseif(current_user_can('ecpicuser'))
		{
		$return_string .="<br /><span style=\"display:block;margin-top:15px;\"><a style=\"font-size:16px;\" href=\"".site_url('materials-for-user')."\">Click for Downloads</a></span>";
		}
		elseif(current_user_can('grasshopper'))
		{
		$return_string .="<br /><span style=\"display:block;margin-top:15px;\"><a style=\"font-size:16px;\" href=\"".site_url('introductory-materials')."\">Click for Downloads</a></span>";
		}
	}
 }
 else
 {
	 $args = array('echo' => false,
	 	'label_username' => __( 'Name:' ),
	        'label_password' => __( 'Password:' ),
	        'remember' => false,);
	$return_string .= "\">";
	$return_string .= wp_login_form($args);
	$return_string .= "<div class=\"login-links\"><a href=\"/registration\">Register</a> | <a href=\"/forgot-password\">Forgot Password</a></div>";
 }
$return_string .= "</div>";
}
	
return $return_string;
}
add_shortcode( 'login-box', 'login_func' );

function get_role_from_email($email_in) {
	$email_pieces = explode('@',$email_in);
	$whitelist_array = explode(',',strtolower(get_option('email_whitelist')));
	if(in_array(strtolower(trim($email_pieces[1])),$whitelist_array))
		return 'member';
	else
		return 'grasshopper';
}

function attachment_download(){
	global $wpdb;
	if(is_attachment())
	{
		if ( current_user_can('ecpicadmin') || current_user_can('curator') || current_user_can('administrator') || current_user_can('ecpicuser') || current_user_can('grasshopper'))
		{
			$attachments = get_queried_object();
			
			$this_attach_id = $attachments->ID;
			$result = $wpdb->get_var("SELECT p.guid
					FROM $wpdb->posts p
					WHERE p.id = '{$this_attach_id}'");
			
			if($result)
			{	
				$remove_this = site_url();
				$this_download_url = get_the_guid($this_attach_id);
				//$fullPath = trim(str_replace($remove_this,"",$this_download_url));
				preg_match('/(\/files\/.+)/i',$this_download_url,$matches);
				//$fullPath = "/var/www/opencms/wp-content/blogs.dir/".get_current_blog_id().trim($matches[0]); -- do not hard code this stuff...
                $fullPath = str_replace("/themes", "", get_theme_root())."/blogs.dir/".get_current_blog_id().trim($matches[0]);

		      if( headers_sent() ) 
    			die('Headers Sent'); 

		    if( file_exists($fullPath) ){ 
    
			    // Parse Info / Get Extension 
			    $fsize = filesize($fullPath); 
			    $path_parts = pathinfo($fullPath); 
			    $ext = strtolower($path_parts["extension"]); 
			    			    // Determine Content Type 
			    switch ($ext) { 
			      case "pdf": $ctype="application/pdf"; break; 
			      case "exe": $ctype="application/octet-stream"; break; 
			      case "zip": $ctype="application/zip"; break; 
			      case "doc": $ctype="application/msword"; break; 
			      case "xls": $ctype="application/vnd.ms-excel"; break; 
			      case "ppt":
			      case "pptx": $ctype="application/vnd.ms-powerpoint"; break;
			      case "gif": $ctype="image/gif"; break; 
			      case "png": $ctype="image/png"; break; 
			      case "jpeg": 
			      case "jpg": $ctype="image/jpg"; break;
			      case "wmv": $ctype="video/x-ms-wmv"; break; 
			      default: $ctype="application/force-download"; 
			    } 

			    header("Pragma: public"); // required 
			    header("Expires: 0"); 
			    header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
			    header("Cache-Control: private",false); // required for certain browsers 
			    header("Content-Type: $ctype"); 
			    header("Content-Disposition: attachment; filename=\"".basename($fullPath)."\";" ); 
			    header("Content-Transfer-Encoding: binary"); 
			    header("Content-Length: ".$fsize); 
			    ob_clean(); 
			    flush(); 
			    readfile( $fullPath ); 
			    die();
			   } else 
			   die('File Not Found!'); 
		    }
		    
		}
		elseif (current_user_can('administrator')){}
		else
			wp_redirect(site_url()); // Or unauthorized page
	}
}
add_filter('wp','attachment_download');

add_action ( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action ( 'edit_user_profile', 'my_show_extra_profile_fields' );
 
function my_show_extra_profile_fields ( $user ) {
?>
 
        <h3>Extra profile information</h3>
        <table class="form-table">
                <tr>
                        <th><label for="phone">Phone number</label></th>
                        <td>
                                <input type="text" name="phone" id="phone" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" class="regular-text" /><br />
                                <span class="description">Please enter your phone number.</span>
                        </td>
                </tr>
                <tr>
                        <th><label for="orgname">Organization name</label></th>
                        <td>
                                <input type="text" name="orgname" id="orgname" value="<?php echo esc_attr( get_the_author_meta( 'orgname', $user->ID ) ); ?>" class="regular-text" /><br />
                                <span class="description">Please enter your organization name.</span>
                        </td>
                </tr>
        </table>
 
<?php
}
add_action ( 'personal_options_update', 'my_save_extra_profile_fields' );

add_action ( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
 function my_save_extra_profile_fields( $user_id ) {
 
    if ( !current_user_can( 'edit_user', $user_id ) )
            return false;          

    if ( ! get_userdata( $user_id ) )
	wp_die( __('Invalid user ID.') );
    /*else
		$ecpic_user = get_userdata($user_id);

    if($ecpic_user)
    {
		if($ecpic_user->roles[0] != $_POST['role'])  //role has been updated
		{
		 if(get_option('email_role_change_primary_email','') != "")
			{
			 $message_headers = "From: \"eCPIC.gov\" <no-reply@ecpic.gov>\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
			 $message = "User: ".$ecpic_user->user_login."\nEmail: ".$_POST['email']."\nOld role: ".$ecpic_user->roles[0]."\nNew role: ".$_POST['role'];
		       	 wp_mail(get_option('email_role_change_primary_email',''), 'Updated ECPIC user role', $message , $message_headers);
		    }
		
			if(get_option('email_role_change_'.$_POST['role'],0) == 1)
			{
	    	 $message_headers2 = "From: \"".get_option('email_role_change_name_from','eCPIC.gov')."\"<".get_option('email_role_change_email_from','no-reply@ecpic.gov').">\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
			 $message2 = get_option('email_role_'.$_POST['role'].'_email_message', 'Your role has been changed to: '.$_POST['role']);
			 wp_mail($ecpic_user->user_email,get_option('email_role_change_email_subject','Your ECPIC.gov role has been changed'), $message2 , $message_headers2);
			}
		}
    }*/
    update_usermeta( $user_id, 'phone', $_POST['phone'] );
    update_usermeta( $user_id, 'orgname', $_POST['orgname'] );    
}
 
add_action('register_form','show_extra_fields');

function show_extra_fields(){
	?>

	<p>
	<label>Phone Number<br />
	<input id="phone" class="input" type="text" tabindex="20" size="25" value="<?php echo $_POST['phone']; ?>" name="phone"/>
	</label>
	</p>

	<p>
	<label>Organization name:<br />
	<input id="orgname" class="input" type="text" tabindex="20" size="25" value="<?php echo $_POST['orgname']; ?>" name="orgname"/>
	</label>
	</p>

	<?php
}

function register_extra_fields($user_id)  {

	update_usermeta($user_id, 'orgname',$_POST['orgname']);
	update_usermeta($user_id, 'phone',$_POST['phone']);
}
add_action('user_register', 'register_extra_fields');

function my_search_form( $form ) {

    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" /><br />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </div>
    </form>';

    return $form;
}

add_filter( 'get_search_form', 'my_search_form' );
function remove_admin_bar()
{
if (current_user_can( 'administrator' ))
{
    return true;
}
return false;
}
add_filter( 'show_admin_bar' , 'remove_admin_bar' );

function my_attachment_fields_to_edit($form_fields, $post) {
	// only activate for images that already attached to pages, ignore images attached to posts
	if (get_post_type($post->post_parent) == 'page') {
		// get the list of pages for our select box
		$all_pages = get_pages();
		$select_code = get_pages_as_select_field($post, $all_pages);
		// $form_fields is a special array of fields to include in the attachment form
		// $post is the attachment record in the database
		// $post->post_type == 'attachment'
		// (attachments are treated as posts in WordPress)
		// add our custom field to the $form_fields array
		// input type="text" name/id="attachments[$attachment->ID][custom1]"
		$form_fields["post_parent"] = array(
			"label" => __("Attatched to page"),
			"input" => "html", 
			"html" => $select_code
		);
	}
	return $form_fields;
}

function get_pages_as_select_field($post, $all_pages) {
	
		$content = "<select name='attachments[{$post->ID}][post_parent]' id='attachments[{$post->ID}][post_parent]'>";
		foreach ($all_pages as $page) {
			if ($page->ID == $post->post_parent) {
				$selected = ' SELECTED ';
			} else {
				$selected = ' ';
			}
			$option_line = "<option" . $selected . "value='" . $page->ID . "'>" . $page->post_title . "</option>";
			$content = $content . $option_line;
		}		
		$content = $content . "</select>";
		return $content;
}

// attach our function to the correct hook
add_filter("attachment_fields_to_edit", "my_attachment_fields_to_edit", null, 2);

function my_attachment_fields_to_save($post, $attachment) {
	if( isset($attachment['post_parent']) ){
		if( trim($attachment['post_parent']) == '' ){
			// adding our custom error
			$post['errors']['post_parent']['errors'][] = __('No value found for post_parent.');
		}else{
			$post['post_parent'] = $attachment['post_parent'];
		}
	}
	return $post;
}
add_filter("attachment_fields_to_save", "my_attachment_fields_to_save", null, 2);

function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url(https://www.ecpic.gov/files/2013/03/ecpic_logo.png) !important; }
        .login h1 a { -webkit-background-size: 300px 76px; background-size: 300px 76px;width:300px;height:76px; };
    </style>';
}

add_action('login_head', 'my_custom_login_logo');

function put_my_url(){
    return ('http://www.ecpic.gov/');
}
add_filter('login_headerurl', 'put_my_url');

function custom_lostpass_url( $lostpassword_url ) {
    return get_option('siteurl'). '/forgot-password';
}
add_filter( 'lostpassword_url', 'custom_lostpass_url' );

function custom_login_url($login_url) {
    return ''.get_option('siteurl'). '/login';
}
//add_filter('login_url','custom_login_url');

add_action( 'user_profile_update_errors', 'slt_strong_passwords', 0, 3 );

function slt_strong_passwords( $errors ) {
	$enforce = true;
	$args = func_get_args();
	$user_id = $args[2]->ID;
	
	if ( $enforce && ! $errors->get_error_data("pass") && $_POST["pass1"] && slt_password_strength( $_POST["pass1"], $_POST["user_login"] ) != 4 )
		$errors->add( 'pass', __( '<strong>ERROR</strong>: Please make the password a strong one.' ) );
	return $errors;
}

function slt_password_strength( $i, $f ) {
	$h = 1; $e = 2; $b = 3; $a = 4; $d = 0; $g = null; $c = null;
	if ( strlen( $i ) < 4 )
		return $h;
	if ( strtolower( $i ) == strtolower( $f ) )
		return $e;
	if ( preg_match( "/[0-9]/", $i ) )
		$d += 10;
	if ( preg_match( "/[a-z]/", $i ) )
		$d += 26;
	if ( preg_match( "/[A-Z]/", $i ) )
		$d += 26;
	if ( preg_match( "/[^a-zA-Z0-9]/", $i ) )
		$d += 31;
	$g = log( pow( $d, strlen( $i ) ) );
	$c = $g / log( 2 );
	if ( $c < 40 )
		return $e;
	if ( $c < 56 )
		return $b;
	return $a;
}

if ( isset( $_GET['action'] ) && ( $_GET['action'] == 'rp' || $_GET['action'] == 'resetpass' ) && isset( $_GET['login'] ) ) {
	add_action( 'login_head', 'slt_fsp_validate_reset_password' );
}

function slt_fsp_validate_reset_password() {
 ?>
		<script type="text/javascript">
		jQuery( document ).ready( function( $ ) {
			$( '#resetpassform' ).submit( function() {
				if ( ! $( '#pass-strength-result' ).hasClass( 'strong' ) ) {
					alert( 'Please enter a strong password!' );
					return false;
				}
			});
		});
		</script>

	<?php
}

if ( is_admin() ){

add_action('admin_menu', 'ecpic_mass_email_admin_menu');

function ecpic_mass_email_admin_menu() {
add_options_page('Mass Emailer Plugin', 'Mass Site Emailer', 'administrator',
'mass_email_plugin', 'ecpic_mass_emailer');
}

function ecpic_mass_emailer() {
global $wp_roles;
$status_message = "";
$all_roles = $wp_roles->roles;
if($_POST)
{
	$from_name = $_POST['name_from'] == "" ? "eCPIC.gov" : $_POST['name_from'];
	$from_email = $_POST['email_from'] == "" ? "no-reply@ecpic.gov" : $_POST['email_from'];
	$email_subject = $_POST['email_subject'];
	$email_message = $_POST['email_message'];

	if(($email_subject == "") || ($email_message == ""))
	{
		echo "<font color=\"red\">Message FAILED.</font>  Reason: Blank subject and/or message";
		$status_message .= "<font color=\"red\">Message FAILED.</font>  Reason: blank subject and/or Message";
	}
	else
	{
		if(isset($_POST['emailAll']) && $_POST['emailAll'] == 1) 
		{
	    	//$user_query = new 
	    	$user_query = new WP_User_query( array('blog_id' => get_current_blog_id(), 'fields' => array('display_name','user_email')));
	    	$query_results = $user_query->get_results();

	    	if(count($query_results) > 0)
			{
				foreach($query_results as $this_user)
				{
					$message_headers = "From: \"".$from_name."\" <".$from_email.">\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
					$status_message .= $this_user->display_name." - ".$this_user->user_email;
					//make sure users limited to scope of blog. is_user_member_of_blog( $user_id, $blog_id );
					if(isset($_POST['debugMode']) && $_POST['debugMode'] == 1) 
					{
						$status_message .= "<font color=\"green\"> would have been e-mailed. </font>(DEBUG)<br />";
					}
					else
					{
						if(wp_mail($this_user->user_email,$email_subject,$email_message,$message_headers))
							$status_message .= "<font color=\"green\"> sent successfully.</font><br />";
						else
							$status_message .= "<font color=\"red\"> failed to send.</font><br />";
					}
				}
			}
		}
		else
		{
			foreach($all_roles as $key => $value)
			{
				if(isset($_POST[$key]) && $_POST[$key] == 1)
				{
					$status_message .= "<strong>'".$key."' role selected.</strong><br />";
					$user_query = new WP_User_Query( array( 'role' => $key, 'blog_id' => get_current_blog_id(), 'fields' => 'all_with_meta' ) );
					$query_results = $user_query->get_results();
					if(count($query_results) > 0)
					{
						foreach($query_results as $this_user)
						{
							$message_headers = "From: \"".$from_name."\" <".$from_email.">\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
							$status_message .= $this_user->display_name." - ".$this_user->user_email;
							//make sure users limited to scope of blog. is_user_member_of_blog( $user_id, $blog_id );
							if(isset($_POST['debugMode']) && $_POST['debugMode'] == 1) 
							{
								$status_message .= "<font color=\"green\"> would have been e-mailed. </font>(DEBUG)<br />";
							}
							else
							{
								if(wp_mail($this_user->user_email,$email_subject,$email_message,$message_headers))
									$status_message .= "<font color=\"green\"> sent successfully.</font><br />";
								else
									$status_message .= "<font color=\"red\"> failed to send.</font><br />";
							}
						}
					}
					else
						$status_message .= "No users of this {$key} role type found.<br />";
					$status_message .= "<br />";
				}
			}
		}
	}
}
?>
<div>
<h2>Mass Emailer</h2>

<form method="post" action="">

<table width="710">

<?php

//echo '<tr valign="top"><td width="200"><font color="red">Debug Mode:</td>';
//echo '<td width="510"><input type="checkbox" name="debugMode" value="1">&nbsp;&nbsp;&nbsp;(mail will not be sent)<br />&nbsp;</td></tr></tr>';

?>
<tr valign="top">
<td width="200">Email All:</td>
<td width="510"><input type="checkbox" name="emailAll" value="1">&nbsp;&nbsp;&nbsp;(check to email all site users)<br />&nbsp;</td></tr>
<tr>
<td width="200">Email Specific Role(s):<br />&nbsp;</td>
<td width="510"><?php 
foreach($all_roles as $key => $value)
{
	if($key != 'subscriber')
	{
		?>
		<input type="checkbox" name="<?php echo $key;?>" value="1">&nbsp;&nbsp;&nbsp;<?php echo $value["name"];?><br />
		<?php
	}
}?>
<br />&nbsp;
</td>
</tr>
<tr>
<td width="200">From Name:</td>
<td width="510"><input type="text" name="name_from" id="name_from" value="eCPIC" size="50">
</tr>
<tr>
<td width="200">From Email:</td>
<td width="510"><input type="text" name="email_from" id="email_from" value="no-reply@ecpic.gov" size="50">
</tr>
<tr>
<td width="200">Subject:</td>
<td width="510"><input type="text" name="email_subject" id="email_subject" size="50">
</tr>
<tr>
<td width="200">Message:</td>
<td width="510"><textarea id="email_message" name="email_message" cols="51" rows="15" /></textarea></td>
</tr>
</table>

<p>
<input type="submit" value="<?php _e('Send Mass E-Mail') ?>" />
</p>

</form>
	<div style="width:600px;margin-top:30px;">
		Mail Status:<br />
		<div style="min-height:100px;max-height:500px;border:1px solid black;overflow:scroll;">
			<?php echo $status_message;?>
		</div>
	</div>
</div>

<?php
}

}

/* EMAIL BY ROLE FUNCTION*/

if ( is_admin() ){

add_option("email_role_change_enable", 0, '', 'yes');
add_action('admin_menu', 'ecpic_email_on_role_admin_menu');

function ecpic_email_on_role_admin_menu() {
add_options_page('Email On Role Change', 'Email On Role Change', 'administrator',
'email_role_change', 'ecpic_email_role_change');
}

function ecpic_email_role_change() {

global $wp_roles;
$status_message = "";
$all_roles = $wp_roles->roles;
if($_POST)
{

	$enable_email = $_POST['enable_email'] == "" ? 0 : $_POST['enable_email'];
	$from_name = $_POST['name_from'] == "" ? "eCPIC.gov" : $_POST['name_from'];
	$from_email = $_POST['email_from'] == "" ? "no-reply@ecpic.gov" : $_POST['email_from'];
	$email_subject = $_POST['email_subject'] == "" ? "You eCPIC.gov role has changed." : $_POST['email_subject'];
	//$email_message = $_POST['notify_message'] == "" ? "Welcome to eCPIC.gov" : $_POST['notify_message'];
	$notify_email = $_POST['email_primary'] == "" ? 0 : $_POST['email_primary'];

	update_option('email_role_change_enable',$enable_email);
	update_option('email_role_change_name_from',$from_name);
	update_option('email_role_change_email_from',$from_email);
	update_option('email_role_change_email_subject',$email_subject);
	//update_option('email_role_change_message',$email_message);
	update_option('email_role_change_primary_email',$notify_email);

	if(isset($_POST['email_subject']) && $_POST['email_subject'] == "")
	{
		echo "<font color=\"red\">Blank message for enabled role - Messaging Disabled</font><br />";
			$enable_email = 0;
			update_option('email_role_change_enable',0);
	}
	else
	{
		$show_form_message = true;
		foreach($all_roles as $key => $value)
		{
			$update_this_message = "";
			$update_this_role = 0;

			if(isset($_POST[$key.'_email_message']))
				$update_this_message = $_POST[$key.'_email_message'];
			if(isset($_POST[$key]))
				$update_this_role = $_POST[$key] == "" ? 0 : $_POST[$key];
			
			update_option('email_role_change_'.$key,$update_this_role);
			update_option('email_role_'.$key.'_email_message',$update_this_message);

			if(trim($update_this_message) == "" && $update_this_role == 1)
			{
				if($show_form_message)
				{
					echo "<font color=\"red\">Blank message for enabled role - Messaging Disabled</font><br />";
					$show_form_message = false;
				}
				$enable_email = 0;
				update_option('email_role_change_enable',0);
			}
		}
	}
}
?>
<div>
<h2>Email User On Role Change</h2>

<form method="post" action="">

<table width="710">

<tr valign="top">
<td width="300">Enable automatic emails sent to users on role promotion:<br />&nbsp;</td>
<td width="510"><input type="checkbox" name="enable_email" value="1" <?php echo get_option('email_role_change_enable',0) == 1 ? "checked" : "";?>>&nbsp;&nbsp;&nbsp;
<?php
if (get_option( 'email_role_change_enable', 0 ) == 0)
		echo 'Automatic emailing is <strong><font color="red">OFF</font></strong>';
	else
		echo 'Automatic emailing is <strong><font color="green">ON</font></strong>'; ?> 
<br />&nbsp;</td></tr>
<tr><td><br />
	<strong>WHICH EMAIL(S) TO NOTIFY OF USER ROLE CHANGE</strong><br/>&nbsp;<br/>
</td><td>&nbsp;</td></tr>
<tr valign="top"><td width="200">
Primary email(s) to notify on all role changes.
</td>
<td width="510">
<input type="text" name="email_primary" id="email_primary" <?php echo 'value="'.get_option('email_role_change_primary_email','').'"'; ?> size="50">
<br />&nbsp;</td></tr>
<tr><td><br />
	<strong>EMAIL SENT TO UPDATED USER</strong><br/>&nbsp;<br/>
</td><td>&nbsp;</td></tr>
<tr valign="top">
<td width="200">Automatically email the user with their respective message when user is assigned this role:<br />&nbsp;</td><td width="510">
	<?php
foreach($all_roles as $key => $value)
{
	add_option("email_role_change_".$key, 0, '', 'yes');
	add_option("email_role_".$key."_email_message", '', '', 'no');
	if($key != 'subscriber')
	{
		?>
		<input type="checkbox" name="<?php echo $key;?>" value="1" <?php echo get_option('email_role_change_'.$key,0) == 1 ? "checked" : "";?>>&nbsp;&nbsp;&nbsp;<?php echo $value["name"];?><br />
		<?php
	}
}?>
<br />&nbsp;
</td>
</tr>
<tr>
<td width="200">From Name:</td>
<td width="510"><input type="text" name="name_from" id="name_from" <?php echo 'value="'.get_option('email_role_change_name_from','eCPIC.gov').'"'; ?> size="50">
</tr>
<tr>
<td width="200">From Email:</td>
<td width="510"><input type="text" name="email_from" id="email_from" <?php echo 'value="'.get_option('email_role_change_email_from','no-reply@ecpic.gov').'"'; ?> size="50">
</tr>
<tr>
<td width="200">Subject:</td>
<td width="510"><input type="text" name="email_subject" id="email_subject" <?php echo 'value="'.get_option('email_role_change_email_subject','Updated ECPIC User role').'"'; ?> size="50">
</tr>
<?php
foreach($all_roles as $key => $value)
{
	if($key != "subscriber")
	{
	?>
<tr>
<td width="200"><?php echo $value["name"]." ";?> Message:</td>
<td width="510"><textarea id="<?php echo $key;?>_email_message" name="<?php echo $key;?>_email_message" cols="60" rows="10" /><?php echo get_option('email_role_'.$key.'_email_message',''); ?></textarea></td>
</tr>
<?php
	}
}
?>
</table>

<p>
<input type="submit" value="<?php _e('Update Settings') ?>" />
</p>

</form>
<?php
/*
	<div style="width:600px;margin-top:30px;">
		Status Messages:<br />
		<div style="min-height:100px;max-height:500px;border:1px solid black;overflow:scroll;">
			<?php echo $status_message;?>
		</div>
	</div>
*/
?>
</div>

<?php
}

}

//Admin Can User-Edit


function mc_admin_users_caps( $caps, $cap, $user_id, $args ){
 
    foreach( $caps as $key => $capability ){
 
        if( $capability != 'do_not_allow' )
            continue;
 
        switch( $cap ) {
            case 'edit_user':
            case 'edit_users':
                $caps[$key] = 'edit_users';
                break;
            case 'delete_user':
            case 'delete_users':
                $caps[$key] = 'delete_users';
                break;
            case 'create_users':
                $caps[$key] = $cap;
                break;
        }
    }
 
    return $caps;
}
add_filter( 'map_meta_cap', 'mc_admin_users_caps', 1, 4 );
remove_all_filters( 'enable_edit_any_user_configuration' );
add_filter( 'enable_edit_any_user_configuration', '__return_true');
 
/**
 * Checks that both the editing user and the user being edited are
 * members of the blog and prevents the super admin being edited.
 */
function mc_edit_permission_check() {
    global $current_user, $profileuser;
 
    $screen = get_current_screen();
 
    get_currentuserinfo();
 
    if( ! is_super_admin( $current_user->ID ) && in_array( $screen->base, array( 'user-edit', 'user-edit-network' ) ) ) { // editing a user profile
        if ( is_super_admin( $profileuser->ID ) ) { // trying to edit a superadmin while less than a superadmin
            wp_die( __( 'You do not have permission to edit this user.' ) );
        } elseif ( ! ( is_user_member_of_blog( $profileuser->ID, get_current_blog_id() ) && is_user_member_of_blog( $current_user->ID, get_current_blog_id() ) )) { // editing user and edited user aren't members of the same blog
            wp_die( __( 'You do not have permission to edit this user.' ) );
        }
    }
 
}
add_filter( 'admin_head', 'mc_edit_permission_check', 1, 4 );

if ( is_admin() ){

add_option("notify_on_register_enable", 0, '', 'yes');
add_action('admin_menu', 'notify_on_register_admin_menu');

function notify_on_register_admin_menu() {
add_options_page('Notify on Register', 'Notify on Register', 'administrator',
'notify_on_register', 'notify_on_register_new');
}

function notify_on_register_new() {

global $wp_roles;
$status_message = "";
$all_roles = $wp_roles->roles;
if($_POST)
{
	$from_name = $_POST['name_from'] == "" ? "eCPIC.gov" : $_POST['name_from'];
	$from_email = $_POST['email_from'] == "" ? "no-reply@ecpic.gov" : $_POST['email_from'];
	$email_subject = $_POST['email_subject'] == "" ? "Welcome to eCPIC!" : $_POST['email_subject'];
	$admin_subject = $_POST['admin_subject'] == "" ? "New eCPIC User has Registered" : $_POST['admin_subject'];
	$email_message = $_POST['notify_message'];
	$enable_email = $_POST['enable_email'] == "" ? 0 : $_POST['enable_email'];
	$notify_email = $_POST['email_primary'] == "" ? 0 : $_POST['email_primary'];
	$notify_user_message = $_POST['message_to_users'];

	update_option('notify_on_register_user_message',$notify_user_message);
	update_option('notify_on_register_enable',$enable_email);
	update_option('notify_on_register_name_from',$from_name);
	update_option('notify_on_register_email_from',$from_email);
	update_option('notify_on_register_email_subject',$email_subject);
	update_option('notify_on_register_admin_subject',$admin_subject);
	update_option('notify_on_register_message',$email_message);
	update_option('notify_on_register_primary_email',$notify_email);
	foreach($all_roles as $key => $value)
	{
		$update_this_role = $_POST[$key] == "" ? 0 : $_POST[$key];
		update_option('notify_on_register_'.$key.'_enable',$update_this_role);
	}
	//if all blank on post, say something
	if(($email_subject == "") || ($email_message == "")) //if auto email is set
	{
		echo "<font color=\"red\">Blank subject and/or message</font><br />";
		$status_message .= "<font color=\"red\">Blank subject and/or Message</font><br />";
	}
	
}
?>
<div>
<h2>Notify on User Registration</h2>

<form method="post" action="">

<table width="710">


<tr>
<td width="300">Enable automatic emails to be sent on new user registration:<br />&nbsp;</td>
<td width="510"><input type="checkbox" name="enable_email" value="1" <?php echo get_option('notify_on_register_enable',0) == 1 ? "checked" : "";?>>&nbsp;&nbsp;&nbsp;
<?php
if (get_option( 'notify_on_register_enable', 0 ) == 0)
		echo 'Automatic emailing is <strong><font color="red">OFF</font></strong>';
	else
		echo 'Automatic emailing is <strong><font color="green">ON</font></strong>'; ?> 
<br />&nbsp;</td></tr>

<tr><td><br />
	<strong>NEW USERS</strong><br/>&nbsp;<br/>
</td><td>&nbsp;</td></tr>

<tr>
<td width="200">From Name:</td>
<td width="510"><input type="text" name="name_from" id="name_from" <?php echo 'value="'.get_option('notify_on_register_name_from','eCPIC.gov').'"'; ?> size="50">
</tr>
<tr>
<td width="200">From Email:</td>
<td width="510"><input type="text" name="email_from" id="email_from" <?php echo 'value="'.get_option('notify_on_register_email_from','no-reply@ecpic.gov').'"'; ?> size="50">
</tr>
<tr>
<td width="200">Subject:</td>
<td width="510"><input type="text" name="email_subject" id="email_subject" <?php echo 'value="'.get_option('notify_on_register_email_subject','New eCPIC User has Registered').'"'; ?> size="50">
</tr>
<tr>
<td width="200">Message sent to new user:</td>
<td width="510"><textarea id="message_to_users" name="message_to_users" cols="60" rows="10" /><?php echo get_option('notify_on_register_user_message',''); ?></textarea></td>
</tr>
<tr><td><br/>&nbsp;<br />
	<strong>NOTIFICATION RECIPIENTS</strong><br/>&nbsp;<br/>
</td><td>&nbsp;</td></tr>
<tr>
<td width="200">Primary email(s) to notify:</td>
<td width="510"><input type="text" name="email_primary" id="email_primary" <?php echo 'value="'.get_option('notify_on_register_primary_email','Patrick.plunkett@gsa.gov').'"'; ?> size="50">
</tr>

<tr valign="top">
<td width="200">Also Notify:<br />&nbsp;</td><td width="510">
	<?php
foreach($all_roles as $key => $value)
{
	add_option("notify_on_register_".$key."_enable", 0, '', 'yes');
	if($key != 'subscriber')
	{
		?>
		<input type="checkbox" name="<?php echo $key;?>" value="1" <?php echo get_option('notify_on_register_'.$key.'_enable',0) == 1 ? "checked" : "";?>>&nbsp;&nbsp;&nbsp;<?php echo $value["name"]."s";?><br />
		<?php
	}
}?>
<br />&nbsp;
</td>
</tr>
<tr>
<td width="200">Notification Subject:</td>
<td width="510"><input type="text" name="admin_subject" id="admin_subject" <?php echo 'value="'.get_option('notify_on_register_admin_subject','New eCPIC User has Registered').'"'; ?> size="50">
</tr>
<tr><td width-"200">
Message Sent to admins / others:
</td><td width="510"><textarea id="notify_message" name="notify_message" cols="60" rows="10" /><?php echo get_option('notify_on_register_message',''); ?></textarea></td>

</tr>
</table>

<p>
<input type="submit" value="<?php _e('Update Settings') ?>" />
</p>

</form>
<div style="background:#eee;border:1px solid black;padding:15px;max-width:400px;"><strong>AVAILABLE SUBSTITUTIONS</strong><br/><br/>USERNAME - Inserts user's username<br/>USERPASS - Inserts user's password<br/>USEREMAIL - Inserts user's email<br/>USERS-NAME - Inserts user's name</div>
</div>

<?php
}

}

function add_webtrends_to_footer()
{
?>
<!-- START OF SmartSource Data Collector TAG -->
<!-- Copyright (c) 1996-2013 Webtrends Inc.  All rights reserved. -->
<!-- Version: 9.4.0 -->
<!-- Tag Builder Version: 4.1  -->
<!-- Created: 3/19/2013 7:15:04 PM -->
<script src="/wp-content/themes/skeleton_ECPIC/webtrends.js" type="text/javascript"></script>
<!-- ----------------------------------------------------------------------------------- -->
<!-- Warning: The two script blocks below must remain inline. Moving them to an external -->
<!-- JavaScript include file can cause serious problems with cross-domain tracking.      -->
<!-- ----------------------------------------------------------------------------------- -->
<script type="text/javascript">
//<![CDATA[
var _tag=new WebTrends();
_tag.dcsGetId();
//]]>
</script>
<script type="text/javascript">
//<![CDATA[
_tag.dcsCustom=function(){
// Add custom parameters here.
//_tag.DCSext.param_name=param_value;
}
_tag.dcsCollect();
//]]>
</script>
<noscript>
<div><img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="//statse.webtrendslive.com/dcsch1ehhabv0h0c6tzqlppzh_4n7z/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=9.4.0&amp;dcssip=www.ecpic.gov"/></div>
</noscript>
<!-- END OF SmartSource Data Collector TAG -->
<?php
}
add_action('wp_footer', 'add_webtrends_to_footer');

function is_user_on_this()
{
	$user_name = sanitize_user($_POST['log']);
		if ( $user = get_user_by('login', $user_name) ) {
			if ( get_user_option('use_ssl', $user->ID) ) {
				$secure_cookie = true;
				force_ssl_admin(true);
				echo "<!-- TRUE! --!>";
			}
			else
				echo "<!-- FALSE! --!>";
		}
		else
			echo "<!-- NO USER --!>";
}
//add_action( 'login_head','is_user_on_this');

function is_ssl_on_here()
{
	//echo "<!-- Server HTTPS: ".print_r($_SERVER['HTTPS'])." --!>";
	if($_POST)
	{
	if(!empty($_POST['log']))
		echo "<!-- ".$_POST['log']." -->";
	else
		echo "<!-- NO LOG --!>";
	if(!empty($_POST['user_login']))
		echo "<!-- ".$_POST['user_login']." -->";
	else
		echo "<!-- NO USERLOG --!>";
	echo "<!-- PAGE POSTED --!>";
	}
	else
	{
		if ( isset( $_SERVER['PATH_INFO'] ) )
			echo "<!-- INFO: ".$_SERVER['PATH_INFO']." -->";
		else
			echo "<!-- NO PATH INFO --!>";
		echo "<!-- SELF: ".$_SERVER['PHP_SELF']." --!>";

		if (isset($_SERVER['HTTP_HOST']))
			echo "<!-- HOST: ".$_SERVER['HTTP_HOST']." --!>";
		echo "<!-- NO PAGE POST --!>";
		if(force_ssl_admin())
		{
			echo "<!-- Admin Forced --!>";
		}
		else
			echo "<!-- Admin NOT Forced --!>";
	}
}
//add_action( 'login_head','is_ssl_on_here');

function ecpic_role_change_notify($user_id, $new_role_in) {

    if(get_option('email_role_change_enable',0) == 1)
    {
    $ecpic_user = get_userdata($user_id);
    if($ecpic_user)
    {
	    $this_user_login = $ecpic_user->user_login;
	    $this_user_email = $ecpic_user->user_email;

		if(get_option('email_role_change_primary_email','') != "")
		{
		 $message_headers = "From: \"eCPIC.gov\" <no-reply@ecpic.gov>\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
		 $message = "User: ".$this_user_login."\nEmail: ".$this_user_email."\nNew role: ".$new_role_in;
	       	 wp_mail(get_option('email_role_change_primary_email',''), 'Updated ECPIC user role', $message , $message_headers);
	    }
	
		if(get_option('email_role_change_'.$new_role_in,0) == 1)
		{
    	 $message_headers2 = "From: \"".get_option('email_role_change_name_from','eCPIC.gov')."\"<".get_option('email_role_change_email_from','no-reply@ecpic.gov').">\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
		 $message2 = get_option('email_role_'.$new_role_in.'_email_message', 'Your role has been changed to: '.$new_role_in);
		 wp_mail($this_user_email,get_option('email_role_change_email_subject','Your ECPIC.gov role has been changed'), $message2 , $message_headers2);
		}
    }
    }
}

add_action('set_user_role','ecpic_role_change_notify',10,2);

class JPB_User_Caps {

  // Add our filters
  function JPB_User_Caps(){
    add_filter( 'editable_roles', array(&$this, 'editable_roles'));
    add_filter( 'map_meta_cap', array(&$this, 'map_meta_cap'),10,4);
  }

  // Remove 'Administrator' from the list of roles if the current user is not an admin
  function editable_roles( $roles ){
    if( isset( $roles['administrator'] ) && !current_user_can('administrator') ){
      unset( $roles['administrator']);
    }
    return $roles;
  }

  // If someone is trying to edit or delete and admin and that user isn't an admin, don't allow it
  function map_meta_cap( $caps, $cap, $user_id, $args ){

    switch( $cap ){
        case 'edit_user':
        case 'remove_user':
        case 'promote_user':
            if( isset($args[0]) && $args[0] == $user_id )
                break;
            elseif( !isset($args[0]) )
                $caps[] = 'do_not_allow';
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        case 'delete_user':
        case 'delete_users':
            if( !isset($args[0]) )
                break;
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        default:
            break;
    }
    return $caps;
  }

}

$jpb_user_caps = new JPB_User_Caps();

function passwordSearchFilter($query) {
    if ($query->is_search) {
        if(strtolower(get_search_query()) == 'password')
			$query->set('post_type', array( 'post', 'Nothing' ));
    }
    return $query;
}
add_filter('pre_get_posts','passwordSearchFilter');

add_action('init', function(){
	if(site_url() == 'https://www.ecpic.gov'){
		if ( in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ){
			wp_redirect( home_url(), 301 );
			exit;
		}
	}
});


add_action('admin_head', function(){
?>
	<style>
		.listUsersWithUncofirmedEmail{display:none !important;}
		span#separatorID{display:none;}
	</style>
<?php
});