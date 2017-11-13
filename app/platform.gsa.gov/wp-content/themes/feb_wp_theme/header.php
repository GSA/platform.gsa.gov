<?php
/**
 * The Header for our theme.
 *
 * @package FEB WordPress Theme Framework
 * @subpackage feb
 * @author CTAC - www.ctacorp.com
 */

?>

<!DOCTYPE html>

<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes();?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes();?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes();?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes();?>> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html <?php language_attributes();?>> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <?php /* <meta charset="utf-8"> */ ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <?php /* <title>Atlanta Federal Executive Board</title> */ ?>
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
                echo ' | ' . sprintf( __( 'Page %s', 'feb' ), max( $paged, $page ) );
            }
            ?>
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="keywords" itemprop="keywords" content="Executive Board, Atlanta, Emergency Preparedness, Atalanta Emergency">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel='shortcut icon' href='<?php echo PARENT_URL; ?>/images/favicon.ico' type="x-icon">
        <?php
        /*<link rel="stylesheet" href="css/bootstrap-theme.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/master.css">
        <link rel="stylesheet" href="css/social-buttons.css">
        <link rel="stylesheet" href="font-awesome-4.2.0/css/font-awesome.css">
        <link rel="stylesheet" href="css/zabuto_calendar.css">
        */
        ?>

        <?php
            /* 
             * enqueue threaded comments support.
             */
            if ( is_singular() && get_option( 'thread_comments' ) )
                wp_enqueue_script( 'comment-reply' );
            // Load head elements
            wp_head();
        ?>
    </head>
    <body>
        <a class="sr-only sr-only-focusable" href="#content">Skip to main content</a>
         <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                        <div class="navbar-header">
                             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                             <a class="navbar-brand" href="<?php echo site_url(); ?>">
                            <?php if ( get_theme_mod( 'm1_logo' ) ) : ?>
                                <img class="Brand" src="<?php echo get_theme_mod( 'm1_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" style="max-width:200px;max-height:50px;">
                            <?php else : ?>
                                <img class="Brand" src="<?php echo PARENT_URL; ?>/images/brand.png" alt="Fderal Executive Board Logo">
                            <?php endif; ?></a>
                        </div>
                        <?php st_navbar(); ?>
                          <ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<?php if(is_user_logged_in()){
                                    if(current_user_can('create_users')){ ?>
                                        <li>
                                            <a href="<?php echo admin_url();?>">Go to Backend</a>
                                        </li>
                                    <?php
                                    }?>
                                <li>
									<a href="<?php echo site_url();?>/edit-profile">Edit Profile</a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Logout</a>
								</li>
                                <?php }else{ ?>
                                <li>
									<a href="<?php echo site_url();?>/registration">Login/Register</a>
								</li>
                                <?php } ?>
							</ul>
                    </nav>
                <?php
                /*
                <div class="col-md-12 column">
                <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                    <div class="navbar-header">
                         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="#"><img class="Brand" src="<?php echo PARENT_URL; ?>/images/brand.png" alt="Fderal Executive Board Logo"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">HOME</a></li>
                            <li><a href="events.html">EVENTS</a></li>
                            <li><a href="news.html">NEWS</a></li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">ABOUT<strong class="caret"></strong></a>
                                <ul class="dropdown-menu">
                                    <li><a href="aboutus.html">About Us</a></li>
                                    <li><a href="#">Location</a></li>
                                    <li><a href="#">Our History</a></li>
                                    <li><a href="#">Our Mission</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">FAQs About FEBs</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">PARTNERS<strong class="caret"></strong></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Federal</a></li>
                                    <li><a href="#">State</a></li>
                                    <li><a href="#">Local</a></li>
                                    <li><a href="#">Other Federal Executive Board</a></li>
                                    <li><a href="#">Community</a></li>
                                </ul>
                            </li>
                            <li><a href="emergency.html">EMERGENCY</a></li>
                            <li><a href="#">WORKFORCE</a></li>
                            <li><a href="collaboration.html">COLLABORATION</a></li>
                             </ul>
                        
                                <ul class="nav navbar-nav navbar-right socialMediaConnect">
                                        <li class="sr-only">FOLLOW US</li>
                                        <li class="fa-stack fa-lg"><a alt="On Facebook" href="https://www.facebook.com/pages/Atlanta-Federal-Executive-Board/208822355800755" target="_blank" title="Connect With Facebook"><i class="fa fa-facebook fa-stack-1x img-thumbnail"></i></a></li>
                                        <li class="fa-stack fa-lg">
                                        <a alt="On Twitter" title="Connect With Twitter" href="https://twitter.com/AtlantaFEB " target="_blank"><i class="fa fa-twitter fa-stack-1x img-thumbnail"></i></a></li>
                                </ul>
                       
                  
    </div>
                </nav>

                </div>
                */
                ?>
