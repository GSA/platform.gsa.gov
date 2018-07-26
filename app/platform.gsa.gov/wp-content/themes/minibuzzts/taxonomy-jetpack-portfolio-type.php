<?php
/**
 * The taxonomy archive template for Jetpack portfolio types.
 *
 *
 * @package minibuzz
 * @since minibuzz 1.0
 */

get_header(); ?>


<!-- BEFORECONTENT -->
<div id="outerbeforecontent" >
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
<div id="maincontent" class="site-content archive-portfolio ">
<div class="container">
    <div class="row">
    <div class="maincontent-wrapper">
    	        
        <section id="primary" class="content-area no-border twelve columns">
            <main id="main" class="site-main page full" role="main">
				<?php if ( function_exists('yoast_breadcrumb') && ! is_front_page() ) {
                  yoast_breadcrumb('<div id="breadcrumbs">','</div>');
                } ?>
                <div class="row">

					<?php if ( have_posts() ) : ?>
            			    <div class="portfolio-wrapper">
                          		<div class="portfolio">
									<?php /* Start the Loop */ ?>
                                    <?php while ( have_posts() ) : the_post(); ?>
        
                                        <?php get_template_part( 'content', 'portfolio' ); ?>
        
                                    <?php endwhile; ?>
                            	</div><!-- .portfolio -->
                            </div> 
                            <div class="clear"></div>      
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

                </div>
                <div class="clear"></div>
            </main><!-- #main -->
        </section><!-- #primary -->
        <div class="clear"></div>
	</div>
    </div>
    <div class="clear"></div>
</div>
</div><!-- end maincontent -->
<!-- END MAIN CONTENT -->
<?php get_footer(); ?>