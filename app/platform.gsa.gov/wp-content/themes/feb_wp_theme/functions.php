<?php
/**
 * @package FEB WordPress Theme Framework
 * @subpackage feb
 * @author CTAC - www.ctacorp.com
 *
*
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, feb_setup(), sets up the theme by registering support
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
 *     remove_filter( 'excerpt_length', 'feb_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @since feb 1.0.1
 */

/*-----------------------------------------------------------------------------------*/
/* Set Proper Parent/Child theme paths for inclusion
/*-----------------------------------------------------------------------------------*/

@define( 'PARENT_DIR', get_template_directory() );
@define( 'CHILD_DIR', get_stylesheet_directory() );

@define( 'PARENT_URL', get_template_directory_uri() );
@define( 'CHILD_URL', get_stylesheet_directory_uri() );


add_filter('show_admin_bar', '__return_false');

// Add Navigation Menu Walker (To adapt Bootstrap menus to WP)
require_once('wp_bootstrap_navwalker.php');
// Add Custom Post Types Function
require_once ('feb-post-types.php' );
// Add Custom Shortcodes
require_once ('feb-shortcodes.php' );
// Add Theme Settings
require_once ('feb-theme-settings.php');

// Execute functions to add custom post types
add_action( 'init', 'register_news_post_type');
add_action( 'init', 'register_notes_post_type');
add_action( 'init', 'register_workforce_post_type');
add_action( 'init', 'register_collaboration_post_type');
add_action( 'init', 'register_em_contact_lists_post_type');
add_action( 'init', 'register_em_contact_post_type');

//Force strong passwords on ALL users
add_filter( 'slt_fsp_caps_check', __return_empty_array() );


if ( ! function_exists( 'feb_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since FEB 1.0
 */
function feb_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'feb' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'feb' ), get_the_author() ),
			get_the_author()
		)
	);
}

endif;

// Register Core Stylesheets
// Supports the 'Better WordPress Minify' plugin to properly minimize styleshsets into one.
// http://wordpress.org/extend/plugins/bwp-minify/

if ( !function_exists( 'st_registerstyles' ) ) {

add_action('get_header', 'st_registerstyles');
function st_registerstyles() {
	$theme  = wp_get_theme();
	$version = $theme['Version'];
    $stylesheets = wp_enqueue_style('bootstrap-theme', PARENT_URL.'/css/bootstrap-theme.css', false, $version, 'screen, projection');
    $stylesheets .= wp_enqueue_style('bootstrap', PARENT_URL.'/css/bootstrap.css', 'bootstrap-theme', $version, 'screen, projection');
    $stylesheets .= wp_enqueue_style('theme', PARENT_URL.'/style.css', 'bootstrap', $version, 'screen, projection');
    $stylesheets .= wp_enqueue_style('social', PARENT_URL.'/css/social-buttons.css', 'theme', $version, 'screen, projection');
    $stylesheets .= wp_enqueue_style('font-awesome', PARENT_URL.'/font-awesome-4.2.0/css/font-awesome.css', 'theme', $version, 'screen, projection');
    //$stylesheets .= wp_enqueue_style('zabuto', PARENT_URL.'/css/zabuto_calendar.css', 'theme', $version, 'screen, projection');
	if ( class_exists( 'jigoshop' ) ) {
	  $stylesheets .= wp_enqueue_style('jigoshop', get_bloginfo('template_directory').'/jigoshop.css', 'theme', $version, 'screen, projection');
	}
	echo apply_filters ('child_add_stylesheets',$stylesheets);
}

}

if ( !function_exists( 'st_header_scripts' ) ) {
if (!is_admin())
	add_action('init', 'st_header_scripts');
function st_header_scripts() {
  $javascripts  = wp_enqueue_script('jquery');
  $javascripts .= wp_enqueue_script('bootstrap',get_bloginfo('template_url') ."/js/bootstrap.min.js",array('jquery'),'1.2.3',true);
  //$javascripts .= wp_enqueue_script('npm',get_bloginfo('template_url') ."/js/npm.js",array('jquery'),'1.2.3',true);
  //$javascripts .= wp_enqueue_script('jQuery-1.11.1',"https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js",array('bootstrap'),'1.11.1',true);
  //$javascripts .= wp_enqueue_script('bootstrap2',get_bloginfo('template_url') ."/js/bootstrap.min.js",array('jQuery-1.11.1'),'1.2.3',true);
  //$javascripts .= wp_enqueue_script('zabuto',get_bloginfo('template_url') ."/js/zabuto_calendar.min.js",array('jquery'),'1.2.3',true);
  $javascripts .= wp_enqueue_script('themejs',get_bloginfo('template_url') ."/js/script.js",array('bootstrap'),'',true);
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


/** Tell WordPress to run feb_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'feb_setup' );

if ( ! function_exists( 'feb_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override feb_setup() in a child theme, add your own feb_setup to your child theme's
 * functions.php file.
 *
 * @since FEB 1.0
 */
function feb_setup() {
	
	if ( class_exists( 'bbPress' ) ) {
	add_theme_support( 'bbpress' );
	}
	// This theme styles the visual editor with editor-style.css to match the theme style.
	//add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	// add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// Register the available menus
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'feb' ),
	));
		// No support for text inside the header image.
		/*
		if ( ! defined( 'NO_HEADER_TEXT' ) )
			define( 'NO_HEADER_TEXT', true );
			
		if ( ! defined( 'HEADER_IMAGE_WIDTH') )
			define( 'HEADER_IMAGE_WIDTH', apply_filters( 'feb_header_image_width',960));
			
			
		if ( ! defined( 'HEADER_IMAGE_HEIGHT') )
		 	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'feb_header_image_height',185 ));
		*/
	}
endif;

if ( !function_exists( 'st_widgets_init' ) ) {

function st_widgets_init() {
		// Area 1, located at the top of the sidebar.
		register_sidebar( array(
		'name' => __( 'Posts Widget Area', 'feb' ),
		'id' => 'primary-widget-area',
		'description' => __( 'Shown only in Blog Posts, Archives, Categories, etc.', 'feb' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Pages Widget Area', 'feb' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'Shown only in Pages', 'feb' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'feb' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'feb' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'feb' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'feb' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'feb' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'feb' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'feb' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'feb' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Register bbPress sidebar if plugin is installed
	if ( class_exists( 'bbPress' ) ) {
	register_sidebar( array(
		'name' => __( 'Forum Sidebar', 'feb' ),
		'id' => 'bbpress-widget-area',
		'description' => __( 'Sidebar displayed in forum', 'feb' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	}
	
	// Register Jigoshop Cart sidebar if plugin is installed
	if ( class_exists( 'jigoshop' ) ) {
	register_sidebar( array(
		'name' => __( 'Jigoshop Sidebar', 'feb' ),
		'id' => 'shop-widget-area',
		'description' => __( 'Sidebar displayed in Jigoshop pages', 'feb' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	}

	// Register Partners Section Sidebar
	register_sidebar( array(
	    'name' => __( 'Partners Sidebar', 'feb' ),
		'id' => 'partners-sidebar',
		'description' => __( 'The sidebar for the partners section', 'feb' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Register News Section Sidebar
	register_sidebar( array(
	    'name' => __( 'News Sidebar', 'feb' ),
		'id' => 'news-sidebar',
		'description' => __( 'The sidebar for the news section', 'feb' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Register Workforce Section Sidebar
	register_sidebar( array(
	    'name' => __( 'Workforce Sidebar', 'feb' ),
		'id' => 'workforce-sidebar',
		'description' => __( 'The sidebar for the workforce section', 'feb' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Register Collaboration Section Sidebar
	register_sidebar( array(
	    'name' => __( 'Collaboration Sidebar', 'feb' ),
		'id' => 'collaboration-sidebar',
		'description' => __( 'The sidebar for the collaboration section', 'feb' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	
}
/** Register sidebars by running feb_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'st_widgets_init' );

}

// Navigation (menu)
if ( !function_exists( 'st_navbar' ) ) {

function st_navbar() {
	echo '<div id="navigation" class="row sixteen columns">';
	//wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary'));
	//wp_nav_menu( array( 'container_class' => 'collapse navbar-collapse', 'container_id' => 'bs-example-navbar-collapse-1', 'menu_class' => 'nav navbar-nav', 'theme_location' => 'primary', 'walker' => new feb_walker_nav_menu));
	if(is_user_logged_in())
	{
		wp_nav_menu( array(
                'menu'              => 'Logged in',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
        		'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
	}else{
	wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
        		'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
	}
	echo '</div><!--/#navigation-->';
}
 
} //endif

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
     /*if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active';  // your new class
     }*/
     if(array_intersect($classes, array('current-menu-item', 'current-menu-parent'))) {
	  $classes[] = 'active';  // your new class
	 }
     return $classes;
}

function event_map_fix()
{
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			if($('#location-address, #location-town').val() != '')
				('#em-map-404').hide();
		});
	</script>
	<?php
}
//add_action('wp', function() { if(is_page('my-events')){add_action('wp_head', 'event_map_fix');}});

add_action( 'admin_menu', 'feb_remove_menu_pages' );

function feb_remove_menu_pages() {
	if(!current_user_can('add_users')){
	    remove_menu_page('edit.php');
	    remove_menu_page('index.php');
	    remove_menu_page('edit-comments.php');
	    remove_menu_page('tools.php');
	}
}

add_filter( 'register_url', 'feb_register_url' );
function feb_register_url( $register_url )
{
    $register_url = get_permalink( get_page_by_title('Registration') );
    return $register_url;
}

//add_filter('wppb_before_form_fields', function(){return '<div class="inlineForm">';});
//add_filter('wppb_after_form_fields', function(){return '</div>';});
add_filter('wppb_before_send_credentials_checkbox', function(){return '<div>';});
add_filter('wppb_after_send_credentials_checkbox', function(){return '</div>';});

function feb_before_form_fields($field, $error_var){
	return str_replace('<li class="wppb-form-field','<div class="form-group wppb-form-field',$field);
}
function feb_yeah(){
	return '<div class="yeah">';
}
//add_action('wppb_before_register_fields','feb_yeah',10,0);
//add_action('wppb_after_register_fields',function(){return '</div>';});

//add_filter('wppb_output_before_form_field', function(){return '<div>';});
add_filter('wppb_output_before_form_field', 'feb_before_form_fields', 10, 2);
add_filter('wppb_output_after_form_field', function(){ return '</div>';});

//Function for navbar 'active' fix when on the add event page (via url param for my events page)
add_action('wp',function(){
	if(is_page('My Events'))
	{
		if(isset($_GET['action']) && $_GET['action'] == 'edit' && !isset($_GET['event_id']))
		{
			add_action('wp_head', function() {
			?>
			<script type="text/javascript">
				jQuery(document).ready(function($){
					$('#bs-example-navbar-collapse-1 > ul > li > ul > li > a').each(function(){
						if($(this).text()=='My Events')
							$(this).parent().removeClass('active');
					});
				});
			</script>
			<?php
			});
		}
	}
});

add_action('wp',function(){
	if(is_page('Events'))
	{
		if(isset($_GET['action']) && $_GET['action'] == 'edit' && !isset($_GET['event_id']))
		{
			add_action('wp_head', function() {
			?>
			<script type="text/javascript">
				jQuery(document).ready(function($){
					$('#panel-92488 > div > ').each(function(){
						if($(this).text()=='My Events')
							$(this).parent().removeClass('active');
					});
				});
			</script>
			<?php
			});
		}
	}
});


function show_on_news_notes() {

	$screens = array( 'news', 'notes' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'myplugin_sectionid',
			__( 'Feature on Homepage', 'feb' ),
			'show_on_news_notes_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'show_on_news_notes' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function show_on_news_notes_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'show_on_news_notes', 'feb' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$featued_on_homepage = get_post_meta( $post->ID, 'featued_on_homepage', true );
	$homepage_position = get_post_meta( $post->ID, 'homepage_position', true );
	echo '<label for="homepage_display">';
	_e( 'Display on Homepage?: ', 'feb' );
	echo '</label> ';
	
	
	
	if($featued_on_homepage=="on")
	{
		$checked="checked";
	}
	else{
		$checked="";
	}
	
	
	?>
	<input type="checkbox" name="featued_on_homepage" <?php echo $checked;?>>
	
	<br/>
	<?php
	echo '<label for="homepage_position">';
	_e( 'Homepage position:', 'feb' );
	echo '</label> ';
	//echo '<input type="text" id="myplugin_new_field" name="myplugin_new_field" value="' . esc_attr( $value ) . '" size="25" />';
	?>
	<input type="radio" name="homepage_position" value="1" <?php if($homepage_position=="1") { echo "checked"; } ?>>1&nbsp;&nbsp;
	<input type="radio" name="homepage_position" value="2" <?php if($homepage_position=="2") { echo "checked"; } ?>>2&nbsp;&nbsp;
	<input type="radio" name="homepage_position" value="3" <?php if($homepage_position=="3") { echo "checked"; } ?>>3&nbsp;&nbsp;
	
	<?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function save_home_featured_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	
	if ( ! isset( $_POST['feb'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['feb'], 'show_on_news_notes' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	
	if ( isset( $_POST['post_type'] ) && ('notes' == $_POST['post_type'] || 'news' == $_POST['post_type']) ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	
	

	// Sanitize user input.
	$featued_on_homepage = $_POST['featued_on_homepage'];
	if(isset($featued_on_homepage))
	{
		$featued_on_homepage="on";
	}
	else
	{
		$featued_on_homepage="off";
	}
	
	$homepage_position = $_POST['homepage_position'];
	
	// Delete previous post position for homepage news/notes
	$args = array('meta_key' => 'homepage_position', 'meta_value' => $homepage_position, 'post_status' => 'publish', 'post_type' => array('news', 'notes'));
	$posts_array = get_posts( $args );
	foreach($posts_array as $newsOrnotes)
	{
		
		$post_id_to_delete=$newsOrnotes->ID;
		delete_post_meta( $post_id_to_delete, 'homepage_position', $homepage_position );
		delete_post_meta( $post_id_to_delete, 'featued_on_homepage', $featued_on_homepage);
		
	}
	
	// Update the meta field in the database.
	update_post_meta( $post_id, 'featued_on_homepage', $featued_on_homepage );
	if($featued_on_homepage=="off")
	{
		$homepage_position="";
	}
	
	// Set new position for news/notes
	update_post_meta( $post_id, 'homepage_position', $homepage_position );
}
add_action( 'save_post', 'save_home_featured_data' );
add_action("wp_ajax_Show_Building_Query", "ShowBuildingList");
add_action("wp_ajax_nopriv_Show_Building_Query", "ShowBuildingList");
function ShowBuildingList()
{
	$args = array(
    'post_type' => 'emergency_contact',
    'post_status' => array('publish','future'),
    'posts_per_page' => -1,
     
    'meta_query' => array(
        array(
            'value'     => $_POST['agency'],
            
        ),
    ),
);
$posts_array = get_posts( $args );

$building_array=array();
foreach($posts_array as $postid)
{
	
	$postid=$postid->ID;
	$meta_values = get_post_meta( $postid, 'building');
	$building_array[]=$meta_values['0'];
	
}

$building_array=array_unique($building_array);

//$building_dropdown='<div id="buillistdiv"></div><select class="form-control">';
foreach($building_array as $buildingname)
{
	if($buildingname!="Null" && $buildingname!="NULL" && $buildingname!="null")
	{
		//$building_dropdown.='<option value="'.$buildingname.'">'.$buildingname.'</option>';
		$building_dropdown[]=$buildingname;
	}
}
//$building_dropdown.='</select>';
echo json_encode($building_dropdown);

wp_die();
}


add_action("wp_ajax_Show_Address_Query", "ShowAddressList");
add_action("wp_ajax_nopriv_Show_Address_Query", "ShowAddressList");
function ShowAddressList()
{
	$args = array(
    'post_type' => 'emergency_contact',
    'post_status' => array('publish','future'),
    'posts_per_page' => -1,
     
    'meta_query' => array(
	
        array(
            'value'     => $_POST['agency'],
            
        ),
	 array(
            'value'     => $_POST['building'],
            
        ),
    ),
);
$posts_array = get_posts( $args );

$address_array=array();
foreach($posts_array as $postid)
{
	
	$postid=$postid->ID;
	$meta_address_values = get_post_meta( $postid, 'address_1');
	$meta_suite_values = get_post_meta( $postid, 'office_suite');
	
	//$address_array[]=$meta_address_values['0'];
	if($meta_address_values['0']!="Null" && $meta_address_values['0']!="NULL" && $meta_address_values['0']!="null")
	{
		
		
			if($meta_suite_values['0']!="" && $meta_suite_values['0']!="NULL" && $meta_suite_values['0']!="Null" && $meta_suite_values['0']!="null")
			{
				
				$address_dropdown[]=$meta_address_values['0']." : ".$meta_suite_values['0'];	
			}
			else{
				$address_dropdown[]=$meta_address_values['0'];
			}
		
	}
	
	
}

$address_dropdown=array_unique($address_dropdown);
//print_r($address_dropdown);
echo json_encode(array_values($address_dropdown));

wp_die();
}


add_action("wp_ajax_auto_address_fields", "LoadAddressFields");
add_action("wp_ajax_nopriv_auto_address_fields", "LoadAddressFields");
function LoadAddressFields()
{
	
	/*if($_POST['officesuite']!="null")
	{
	
		$args = array(
	    'post_type' => 'emergency_contact',
	    'post_status' => 'publish',
	    'posts_per_page' => -1,
	     
	    'meta_query' => array(
		
		array(
		    'value'     => $_POST['agency'],
		    
		),
		 array(
		    'value'     => $_POST['building'],
		    
		),
		 array(
		    'value'     => $_POST['address'],
		    
		),
		 
		 array(
		    'value'     => $_POST['officesuite'],
		    
		),
		),
		);
	}
	else{*/
		$args = array(
	    'post_type' => 'emergency_contact',
	    'post_status' => 'publish',
	    'posts_per_page' => -1,
	     
	    'meta_query' => array(
		
		array(
		    'value'     => $_POST['agency'],
		    
		),
		 array(
		    'value'     => $_POST['building'],
		    
		),
		 array(
		    'value'     => $_POST['address'],
		    
		),
		 ),
		);
		 
	//}
$posts_array = get_posts( $args );

$address_array=array();
foreach($posts_array as $postid)
{
	
	$postid=$postid->ID;
	$meta_city = get_post_meta( $postid, 'city');
	$meta_county = get_post_meta( $postid, 'county');
	$meta_state = get_post_meta( $postid, 'state');
	$meta_zip = get_post_meta( $postid, 'zip');
	
	$rest_of_the_address[]=$meta_city['0']."||".$meta_county['0']."||".$meta_state['0']."||".$meta_zip['0'];
	
}

$rest_of_the_address_array=array_unique($rest_of_the_address);
 

echo json_encode($rest_of_the_address_array);

wp_die();
}

add_filter('pre_get_posts', 'feb_query_post_type');
function feb_query_post_type($query) {
  if(is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
	$post_type = array('post','page','news','notes','workforce','collaboraton');
    $query->set('post_type',$post_type);
	return $query;
    }
}

add_action( 'admin_init', 'add_post_heading_meta_boxes' );
add_action( 'save_post', 'save_post_heading_custom_fields' );

function add_post_heading_meta_boxes(){
    add_meta_box("feb_post_headings", "Collaboration / News / Workforce Headings (if applicable)", "add_feb_headings_meta_box","page","normal","high");
}

function add_feb_headings_meta_box( $post )
{
	$heading1 = get_post_meta( get_the_ID(), 'feb_post_heading1', true );
	$heading2 = get_post_meta( get_the_ID(), 'feb_post_heading2', true );
    ?>
    <style>.width99 {width:99%;}</style>
    <p>
        <label>Page Heading:</label><br />
        <input type="text" name="feb_post_heading1" value="<?php echo !empty($heading1) ? $heading1 : '' ?>" class="width99" />
    </p>
    <label>Header Text:</label><br />
    <?php
    wp_editor( htmlspecialchars_decode($heading2), 'metabox_feb_heading2_style', $settings = array('textarea_name'=>'feb_post_heading2') );
}

function save_post_heading_custom_fields(){
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    // Prevent quick edit from clearing custom fields
    if (defined('DOING_AJAX') && DOING_AJAX)
        return;

    if ( $post && $post->post_type == 'page' ){
        if(isset($_POST["feb_post_heading1"]))
            update_post_meta($post->ID, "feb_post_heading1", $_POST["feb_post_heading1"]);
        else
            delete_post_meta($post->ID, "feb_post_heading1");

        if(isset($_POST["feb_post_heading2"]) )
            update_post_meta($post->ID, "feb_post_heading2", $_POST["feb_post_heading2"]);
        else
            delete_post_meta($post->ID, "feb_post_heading2");
    }
}
?>
