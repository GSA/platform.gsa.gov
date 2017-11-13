<?php
/**
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

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 

<!-- Favicons
================================================== -->

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/img/favicon.ico">

<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon.png">

<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon-72x72.png" />

<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon-114x114.png" />

<link rel="pingback" href="<?php echo get_option('siteurl') .'/xmlrpc.php';?>" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" id="custom" href="<?php echo home_url() .'/?get_styles=css';?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/app.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/federated-analytics.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/swipe.js"></script>
<?php
	/* 
	 * enqueue threaded comments support.
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	// Load head elements
	wp_head();
?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.scrollTo.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/app.js"></script>
</head>
<body <?php body_class(); ?>>
	<div id="wrap" class="container">
	<div class="customHeader sixteen columns">
		<div class="eight columns alpha">
			<a href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri();?>/img/logo-header.png"></a>
		</div>
        <div class="clear"></div>
	</div>
	<?php /*st_navbar();*/ ?>
	
	<div id="navigation" class="sixteen columns">
        <div class="row">
            <div class="menu-header fourteen columns alpha">
                <?php $config = array(
                    'theme_location'  => '',
                    'menu'            => '',
                    'container'       => 'nav',
                    'container_class' => '',
                    'container_id'    => 'menu-header',
                    'menu_class'      => 'menu',
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => ''
                );?>
                <?php wp_nav_menu($config);?>
            </div>
            <div class="two columns omega contact">
                <span><a href="mailto:feedback@supportthevoter.gov">Contact </a> | </span><a href="https://twitter.com/supportthevoter"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/tw.png"></a>
            </div>
        </div>
	</div>
	