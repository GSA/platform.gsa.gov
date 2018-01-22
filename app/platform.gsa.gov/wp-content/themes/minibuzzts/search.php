<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package minibuzz
 * @since minibuzz 5.0
 */

get_header(); 

?>

<!-- BEFORECONTENT -->
<div id="outerbeforecontent" class="search-page">
    <div class="container">
        <div class="row">
            <div class="twelve columns">
            	<div id="beforecontent-wrap">
                <div id="beforecontent">                  
                    <header id="page-title-wrapper">
                        <div class="page-title-header">
                           <h1 class="page-title"><?php printf(  esc_html__( 'Search Results for: %s', 'minibuzzts' ), get_search_query() ); ?></h1>
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
<div id="maincontent" class="site-content search">

<div class="container">
    <div class="row">
    <div class="maincontent-wrapper">
         	
        <section id="primary" class="content-area eight columns">
            <main id="main" class="site-main" role="main">
    
            <?php if ( have_posts() ) : ?>

                <?php
                // Start the loop.
                while ( have_posts() ) : the_post(); ?>
    
                    <?php
                    /*
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
                     */
                    get_template_part( 'content', 'search' );
    
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