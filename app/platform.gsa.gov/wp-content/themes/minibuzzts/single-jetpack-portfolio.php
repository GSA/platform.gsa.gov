<?php
/**
 * The Template for displaying all single posts.
 *
 * @package minibuzz
 * @since minibuzz 5.0
 */

get_header(); ?>

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
						   		$categories="";
						   
						   		if ( post_type_exists( 'jetpack-portfolio' )) :
									$pfcat = '';
									$categories = get_the_terms( $post->ID, 'jetpack-portfolio-type' );
									$count=0;
									if($categories){
										foreach($categories as $category) {
										$count++;
											if (1 == $count) {
											$pfcat .= $category->name;
											}
										}
									}
								
								endif;
									
								if ( $categories !="" ) :
									
									echo '<h1 class="page-title">' . esc_attr($pfcat) . '</h1>';
		
								else :
								
									$count=0;
									foreach((get_the_category()) as $category) { 
									$count++;
										if (1 == $count) {
										echo '<h1 class="page-title">'.$category->cat_name . '</h1> '; 
										}
									} 
																	
								endif;
						   ?>
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
        <main id="main" class="site-main" role="main">
        
			<?php if ( function_exists('yoast_breadcrumb') && ! is_front_page() ) {
              yoast_breadcrumb('<div id="breadcrumbs">','</div>');
            } ?>
        
            <?php
            // Start the loop.
            while ( have_posts() ) : the_post();
        
                // Include the single post content template.
                get_template_part( 'content', 'single-portfolio' );

        
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }

                // End of the loop.
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