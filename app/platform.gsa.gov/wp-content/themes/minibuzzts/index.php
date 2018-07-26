<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
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
                            <?php if( is_home() && get_option('page_for_posts') ) { ?>
                                <?php echo '<h1 class="page-title">' . apply_filters('the_title',get_page( get_option('page_for_posts') )->post_title) . '</h1>'; ?>
                            <?php } elseif( is_singular() ) { ?>
                                <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                            <?php }else{ ?> 
                                <?php echo '<h1 class="page-title">' . esc_html__('Latest Posts', 'minibuzzts') . '</h1>'; ?>
                            <?php } ?>
                       </div>
                    </header><!-- .entry-header --> 
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
    
                <?php if ( is_home() && ! is_front_page() ) : ?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
                <?php endif; ?>
    
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();
    
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part( 'content', get_post_format() );
    
                // End the loop.
                endwhile;
 
				/* Display navigation to next/previous pages when applicable */ 
				if (  $wp_query->max_num_pages > 1 ) : 
				if(function_exists('wp_pagenavi')) { 
				  wp_pagenavi(); 
				}else{ 
				  minibuzzts_content_nav( 'nav-below' ); 
				}
				endif;
			  
            // If no content, include the "No posts found" template.
            else :
                get_template_part( 'content', 'none' );
    
            endif;
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