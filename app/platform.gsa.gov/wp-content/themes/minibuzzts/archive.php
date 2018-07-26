<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
							<?php
                                the_archive_title( '<h1 class="page-title archive-title">', '</h1>' );
                                the_archive_description( '<div class="page-desc taxonomy-description">', '</div>' );
                            ?>
                        </div>
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
            <main id="main" class="site-main" role="main">
            
			<?php if ( function_exists('yoast_breadcrumb') && ! is_front_page() ) {
              yoast_breadcrumb('<div id="breadcrumbs">','</div>');
            } ?>
    
            <?php if ( have_posts() ) : ?>
    
    
                <?php /* The loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', get_post_format() ); ?>
                <?php endwhile; ?>
    
                <?php 
					/* Display navigation to next/previous pages when applicable */ 
					if (  $wp_query->max_num_pages > 1 ) : 
					if(function_exists('wp_pagenavi')) { 
					  wp_pagenavi(); 
					}else{ 
					  minibuzzts_content_nav( 'nav-below' ); 
					}
					endif;
                 ?>
    
            <?php else : ?>
                <?php get_template_part( 'content', 'none' ); ?>
            <?php endif; ?>
    
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