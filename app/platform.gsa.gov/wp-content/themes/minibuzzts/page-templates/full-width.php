<?php
/**
 * Template Name: Full Width Template
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package minibuzz
 * @since minibuzz 5.0
 */

get_header(); 
?>

<!-- BEFORECONTENT -->
<div id="outerbeforecontent">
    <div class="container">
        <div class="row">
            <div class="twelve columns">
            	<div id="beforecontent-wrap">
                <div id="beforecontent" >                  
                    <header id="page-title-wrapper">
                        <div class="page-title-header">
                           <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                       </div><!-- .entry-header --> 
                    </header>
                    <div class="clear"></div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END BEFORECONTENT -->  

<!-- MAIN CONTENT -->
<div id="maincontent" class="site-content full-template">

<div class="container">
    <div class="row">
    <div class="maincontent-wrapper">
       
        <section id="primary" class="content-area twelve columns">
            <main id="main" class="site-main page full" role="main">
			<?php if ( function_exists('yoast_breadcrumb') && ! is_front_page() ) {
              yoast_breadcrumb('<div id="breadcrumbs">','</div>');
            } ?>
            
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

            </main><!-- .site-main -->
        </section><!-- .content-area -->

        <div class="clear"></div>
	</div>
    </div>
</div>
</div><!-- end maincontent -->
<?php get_footer(); ?>