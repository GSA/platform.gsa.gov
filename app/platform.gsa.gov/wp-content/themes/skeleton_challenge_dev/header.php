<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 */
?>
<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes();?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes();?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes();?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes();?>> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html <?php language_attributes();?>> <!--<![endif]-->

<head>
	<?php echo acf_form_head(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title><?php
	// Detect Yoast SEO Plugin
	if (defined('WPSEO_VERSION')) {
		wp_title('');
	} else {
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'skeleton' ), max( $paged, $page ) );
	}
	?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Add CSS3 Rules here for IE 7-9
================================================== -->

<!--[if IE]>
<style type="text/css">
html.ie #navigation,
html.ie a.button,
html.ie .cta,
html.ie .wp-caption,
html.ie #breadcrumbs,
html.ie a.more-link,
html.ie .gallery .gallery-item img,
html.ie .gallery .gallery-item img.thumbnail,
html.ie .widget-container,
html.ie #author-info {behavior: url("<?php echo get_stylesheet_directory_uri();?>/PIE.php");position: relative;}</style>
<![endif]-->


<!-- Mobile Specific Metas
================================================== -->

<meta name="viewport" content="width=device-width, initial-scale=1" /> 

<!-- Favicons
================================================== -->

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon.ico">

<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon.png">

<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon-72x72.png" />

<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon-114x114.png" />

<link rel="pingback" href="<?php echo get_option('siteurl') .'/xmlrpc.php';?>" />
<link rel="stylesheet" id="custom" href="<?php echo home_url() .'/?get_styles=css';?>" type="text/css" media="all" />

<?php
	/* 
	 * enqueue threaded comments support.
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	// Load head elements
	wp_head();
	$register_text = "Sign Up";
	$this_reg_page = get_page_by_title( "Registration" );
	$this_login_page = get_page_by_title( "Login" );
	$hardcoded_links = false;
    //var_dump($this_page);
    //echo $this_page->ID;
    if ( $this_page->post_type == "page" )
    {
    	//die();
    }

    $edit_value = $_GET['edit-challenge'];
    $edit_value2 = $_GET['edit-agency'];
	
	$using_ssl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' || $_SERVER['SERVER_PORT'] == 443;
    // Page ID 2 must be https
    if ((is_page('Create New Challenge') || (isset($edit_value) && $edit_value == 'true') || (isset($edit_value2) && $edit_value2 == 'true')) && !$using_ssl)
    	$hardcoded_links = true;
        //$content = "Hello World!";
        //return $content;
    $link_text = !is_user_logged_in() ? "Login" : "Logout";
    $link_url = !is_user_logged_in() ? (!empty($this_login_page) ? get_page_link($this_login_page->ID) : get_site_url().'/login') : wp_logout_url(get_site_url());
?>

</head>
<body <?php body_class(); ?>>
	<div id="wrap" class="container">
	<div class="resize"></div>
	<header id="challenge-masthead" role="banner">
	<p id="masthead" class="challenge-row">
	    <a class="header-logo" href="<?php echo site_url(); ?>" id="challenge-gov-logo">Challenge.gov</a>

	    <?php
	    if(current_user_can('create_users'))
	    {
	    	?>
	    	<span class="header-login-links">Logged In As:<a href="<?php echo site_url();?>/wp-admin">GSA Administrator </a> [<a href="<?php echo wp_logout_url(get_site_url().'/login'); ?>">Logout</a>]</span>
	    	<?php
	    }
	    else
	    {
	    	//$session_code = '009';  //testing code
			if(is_user_logged_in() && current_user_can('publish_posts'))
			{
				$session_code = get_max_agency_codes();
				$this_loggedin_link = get_permalink(max_agency_match_codes($session_code,'post-id'));
				if($hardcoded_links)
					$this_loggedin_link = challenge_permalink(max_agency_match_codes($session_code,'post-id'));
	    		?>
	    		<span class="header-login-links">Logged In As:<a href="<?php echo $this_loggedin_link; ?>"><?php echo max_agency_match_codes($session_code,'nice-name');?></a>User [<a href="<?php echo wp_logout_url(get_site_url().'/login'); ?>">Logout</a>]</span>
	    		<?php
	    	}
	    }
	    if(is_user_logged_in() && current_user_can('publish_posts'))
		  {
		  	?>
		  		<center><span class="header-login-links login-links-left">
		  			<?php
		  				if($hardcoded_links)
		  				{
		  					?>
		  					<a href="<?php echo site_url();?>/create-new-challenge">Create New Challenge</a> | <a href="<?php echo site_url();?>/your-challenges">Your Challenges</a> | <a href="<?php echo site_url();?>/all-agencies">All Agencies</a>
		  					<?php
		  				}
		  				else
		  				{
		  					?>
		  					<a href="<?php echo site_url('','http');?>/create-new-challenge">Create New Challenge</a> | <a href="<?php echo site_url('','http');?>/your-challenges">Your Challenges</a> | <a href="<?php echo site_url('','http');?>/all-agencies">All Agencies</a>
		  					<?php
		  				}
		  			?>
		  		</span></center>
		  	<?php
		  }
		  ?>
	</p>
	</header>
  	<header id="challenge-header" class="site-header" role="banner">
    <div class="challenge-row">
      <h1 class="header-title">
        A partnership between the public and the government to solve important challenges.
      </h1>
    </div>
  	</header>
	
	<?php
	// Check if this is a post or page, if it has a thumbnail, and if it exceeds defined HEADER_IMAGE_WIDTH
	if ( is_singular() && current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail( $post->ID ) 
	&& ( /* $src, $width, $height */
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ))
	&&
	$image[1] >= HEADER_IMAGE_WIDTH ) :
	// Houston, we have a new header image!
	$image_attr = array(
				'class'	=> "scale-with-grid",
				'alt'	=> trim(strip_tags( $attachment->post_excerpt )),
				'title'	=> trim(strip_tags( $attachment->post_title ))
				);
	echo '<div id="header_image" class="row sixteen columns">'.get_the_post_thumbnail( $post->ID, array("HEADER_IMAGE_WIDTH","HEADER_IMAGE_HEIGHT"), $image_attr ).'</div>';
	elseif ( get_header_image() ) : ?>
		<div id="header_image" class="row sixteen columns"><img class="scale-with-grid round" src="<?php header_image(); ?>" alt="" /></div>
	<?php endif; ?>	