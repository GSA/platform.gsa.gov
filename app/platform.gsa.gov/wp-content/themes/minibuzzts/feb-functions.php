<?php
/**
 * FEB Specific Functions
 *
 * @package FEB WordPress Theme Framework
 * @subpackage feb
 * @author CTAC - www.ctacorp.com
 */

@define( 'PARENT_DIR', get_template_directory() );
@define( 'CHILD_DIR', get_stylesheet_directory() );

@define( 'PARENT_URL', get_template_directory_uri() );
@define( 'CHILD_URL', get_stylesheet_directory_uri() );

// Force strong passwords on ALL users
add_filter( 'slt_fsp_caps_check', __return_empty_array() );

if ( ! function_exists( 'feb_posted_on' ) ) :

// Prints HTML with meta information for the current post-date/time and author.

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

if ( !function_exists( 'feb_widgets_init' ) ) {

function feb_widgets_init() {

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
add_action( 'widgets_init', 'feb_widgets_init' );

}

if ( !function_exists( 'feb_remove_menu_pages' ) ) {
// Remove specific menu items for non administrator users

function feb_remove_menu_pages() {
    if(!current_user_can('add_users')){
        remove_menu_page('edit.php');
        remove_menu_page('index.php');
        remove_menu_page('edit-comments.php');
        remove_menu_page('tools.php');
    }
}
add_action( 'admin_menu', 'feb_remove_menu_pages' );

}

if ( !function_exists( 'feb_register_url' ) ) {
// Set registration page URL

function feb_register_url( $register_url ){
    $register_url = get_permalink( get_page_by_title('Registration') );
    return $register_url;
}
add_filter( 'register_url', 'feb_register_url' );

}

add_filter('wppb_before_send_credentials_checkbox', function(){return '<div>';});
add_filter('wppb_after_send_credentials_checkbox', function(){return '</div>';});

function feb_before_form_fields($field, $error_var){
	return str_replace('<li class="wppb-form-field','<div class="form-group wppb-form-field',$field);
}

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

if ( !function_exists( 'feb_query_post_type' ) ) {
	function feb_query_post_type($query) {
	  if(is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
		$post_type = array('post','page','news','notes','workforce','collaboraton');
	    $query->set('post_type',$post_type);
		return $query;
	    }
	}
	add_filter('pre_get_posts', 'feb_query_post_type');
}
// Register Stylesheets

if ( !function_exists( 'feb_registerstyles' ) ) {

	function feb_registerstyles() {
		$theme  = wp_get_theme();
		$version = $theme['Version'];
		$stylesheets = wp_enqueue_style('bootstrap-theme', PARENT_URL.'/css/bootstrap-theme.css', false, $version, 'screen, projection');
		$stylesheets .= wp_enqueue_style('bootstrap', PARENT_URL.'/css/bootstrap.css', 'bootstrap-theme', $version, 'screen, projection');
		$stylesheets .= wp_enqueue_style('social', PARENT_URL.'/css/social-buttons.css', 'bootstrap-theme', $version, 'screen, projection');
		$stylesheets .= wp_enqueue_style('font-awesome', PARENT_URL.'/font-awesome-4.2.0/css/font-awesome.css', 'bootstrap-theme', $version, 'screen, projection');

		echo apply_filters ('child_add_stylesheets',$stylesheets);
	}
	add_action('get_header', 'feb_registerstyles');
}

// Register Scripts

if ( !function_exists( 'feb_header_scripts' ) ) {
	function feb_header_scripts() {
		$javascripts  = wp_enqueue_script('jquery');
		$javascripts .= wp_enqueue_script('bootstrap',get_bloginfo('template_url') ."/js/bootstrap.min.js",array('jquery'),'1.2.3',true);
		$javascripts .= wp_enqueue_script('themejs',get_bloginfo('template_url') ."/js/script.js",array('bootstrap'),'',true);
		echo apply_filters ('child_add_javascripts',$javascripts);
	}
	if (!is_admin())
		add_action('init', 'feb_header_scripts');
}