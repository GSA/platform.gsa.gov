<?php // Load Javascripts for Theme
function solostream_theme_js() {

	if ( !is_admin() && is_singular() ) {

		global $post;
		$featcontent = get_post_meta($post->ID, 'post_featcontent', true);
		$featvideo = get_post_meta($post->ID, 'post_featvideo', true);
		$featpages = get_post_meta($post->ID, 'post_featpages', true);
		$featgalleries = get_post_meta($post->ID, 'post_featgalleries', true);

		if ( $featcontent != "No" || $featvideo == "Yes" || $featpages == "Yes" || $featgalleries == "Yes" || is_pagetemplate_active('page-youtube.php') ) {
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'flexslider', get_bloginfo('template_directory').'/js/flexslider.js', array( 'jquery' ) );
		}

		if ( is_pagetemplate_active('page-portfolio.php') ) {
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'framework', get_bloginfo('template_directory').'/js/framework.js', array( 'jquery' ) );
		}

	}

	if ( !is_admin() && is_home() ) {

		global $post;
		$page_id = get_option('page_for_posts');
		$featcontent = get_post_meta($page_id, 'post_featcontent', true);
		$featvideo = get_post_meta($page_id, 'post_featvideo', true);
		$featpages = get_post_meta($page_id, 'post_featpages', true);
		$featgalleries = get_post_meta($post->ID, 'post_featgalleries', true);

		if ( $featcontent != "No" || $featvideo == "Yes" || $featpages == "Yes" || $featgalleries == "Yes" ) {
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'flexslider', get_bloginfo('template_directory').'/js/flexslider.js', array( 'jquery' ) );
		}

	}

	if (!is_admin()) {

		if ( ! function_exists( 'is_plugin_active' ) )
		    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
		    // Makes sure the plugin is defined before trying to use it
		 
		//if ( is_plugin_active_for_network( 'sites-multisite-js/sites_multisite_js.php' ) ) {
		if ( is_plugin_active( 'sites-multisite-includes/sites_multisite_includes.php' ) ) {
		    // Plugin is activated
			wp_enqueue_script( 'superfish', plugins_url('sites-multisite-includes/js/superfish.js'), array( 'jquery' ) );
		}
		wp_enqueue_script( 'external', get_bloginfo('template_directory').'/js/external.js' );
		wp_enqueue_script( 'suckerfish', get_bloginfo('template_directory').'/js/suckerfish.js' );

		if (strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad')) { 
			wp_enqueue_script( 'ios-bugfix', get_bloginfo('template_directory').'/js/ios-bugfix.js', array(), false, true );
		}

		if ( get_option('solostream_show_catnav') == 'yes' ) {
			wp_enqueue_script( 'suckerfish-cat', get_bloginfo('template_directory').'/js/suckerfish-cat.js' );
		}

		if ( get_option('solostream_features_on') != 'No' || get_option('solostream_videos_on') == 'Yes' || get_option('solostream_featpage_on') == 'Yes' || is_active_widget( false, false, 'videoslide-widget' ) ) {
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'flexslider', get_bloginfo('template_directory').'/js/flexslider.js', array( 'jquery' ) );
		}

		if ( is_active_widget( false, false, 'sidetabs-widget' ) || is_pagetemplate_active("page-tabbed-archive.php") || is_pagetemplate_active("page-tabbed-cat.php") ) {
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-ui-per', get_bloginfo('template_directory').'/admin/jquery-ui-personalized-1.5.2.packed.js', array('jquery'));
			wp_enqueue_script( 'sprinkle-tabs', get_bloginfo('template_directory').'/admin/sprinkle-tabs.js', array('jquery') );
		}

	}

}

function topnav_superfish_js() { ?>

	<!-- TopNav Superfsh JS -->
	<script type="text/javascript">  
		jQuery(document).ready(function() { 
			jQuery('#topnav ul.nav').superfish({ 
				delay:		300,				// delay on mouseout 
				animation:	{opacity:'show',height:'show'},	// fade-in and slide-down animation 
				speed:		'fast',				// faster animation speed
				cssArrows:	false				// disable generation of arrow mark-up
			});  
		});  
	</script>

<?php }

function catnav_superfish_js() { ?>

	<!-- CatNav Superfsh JS -->
	<script type="text/javascript">  
		jQuery(document).ready(function() { 
			jQuery('#catnav ul.catnav').superfish({ 
				delay:		300,				// delay on mouseout 
				animation:	{opacity:'show',height:'show'},	// fade-in and slide-down animation 
				speed:		'fast',				// faster animation speed
				cssArrows:	false				// disable generation of arrow mark-up
			}); 
		});  
	</script>

<?php }

function fixed_superfish_js() { ?>

	<!-- FixedNav Superfsh JS -->
	<script type="text/javascript">  
		jQuery(document).ready(function() { 
			jQuery('#fixednav ul.fixednav').superfish({ 
				delay:		300,				// delay on mouseout 
				animation:	{opacity:'show',height:'show'},	// fade-in and slide-down animation 
				speed:		'fast',				// faster animation speed
				cssArrows:	false				// disable generation of arrow mark-up
			}); 
		});  
	</script>

<?php }

add_action('wp_print_scripts', 'solostream_theme_js');

if ( get_option('solostream_show_topnav') != 'no' && !is_page_template('page-landing.php') ) { add_action('wp_head', 'topnav_superfish_js'); }
if ( get_option('solostream_show_catnav') == 'yes' ) { add_action('wp_head', 'catnav_superfish_js'); }
if ( has_nav_menu('fixednav') && !is_page_template('page-landing.php') ) { add_action('wp_head', 'fixed_superfish_js'); }


?>