<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
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
                <div id="beforecontent">                  
                    <header id="page-title-wrapper">
                        <div class="page-title-header">
                           <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                       </div><!-- page-title-header --> 
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
<div id="maincontent" class="site-content">
<div class="container">
    <div class="row">
    <div class="maincontent-wrapper">
            
       <section id="primary" class="content-area eight columns">
            <main id="main" class="site-main page" role="main">
            
			<?php if ( function_exists('yoast_breadcrumb') && ! is_front_page() ) {
              yoast_breadcrumb('<div id="breadcrumbs">','</div>');
            } ?>
    
            <?php
            // Start the loop.
            while ( have_posts() ) : the_post();
    
                // Include the page content template.
                get_template_part( 'content', 'page' );
    
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
    
            // End the loop.
            endwhile;
            ?>
    
            </main><!-- .site-main -->
        </section><!-- .content-area -->
        
        <aside id="secondary" class="sidebar widget-area four columns " role="complementary">
        <?php get_sidebar(); ?>
        </aside><!-- .sidebar .widget-area -->
        <div class="clear"></div>
	</div>
    </div>
</div>
</div><!-- end maincontent -->
<!-- END MAIN CONTENT -->

<?php get_footer(); ?>
