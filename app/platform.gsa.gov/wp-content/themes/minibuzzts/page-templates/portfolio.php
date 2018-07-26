<?php
/*
 * Template Name: Portfolio Template
 *
 * @package minibuzz
 * @since minibuzz 5.0
*/

get_header();

?>

<!-- BEFORECONTENT -->
<div id="outerbeforecontent" >
    <div class="container">
        <div class="row">
            <div class="twelve columns">
            	<div id="beforecontent-wrap">
                <div id="beforecontent">                  
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
<div id="maincontent" class="site-content portfolio-template">

<div class="container">
    <div class="row">
    <div class="maincontent-wrapper">
       
        <section id="primary" class="content-area twelve columns">
            <main id="main" class="site-main page full" role="main">
				<?php if ( function_exists('yoast_breadcrumb') && ! is_front_page() ) {
                  yoast_breadcrumb('<div id="breadcrumbs">','</div>');
                } ?>
                <div id="page" class="portfolio-template">
                

                        
                <?php while ( have_posts() ) : the_post(); ?>
                
                    <div class="page-content">
                        <?php
                            the_content();
                            wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' .  esc_html__( 'Pages: ', 'minibuzzts' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                            ) );
                        ?>
                    </div><!-- .page-content -->
                
                <?php endwhile; // end of the loop. ?>
                
                
              <?php if ( post_type_exists( 'jetpack-portfolio' )) : ?> 
                <div class="portfolio-filter">
                    <ul>
                        <li id="filter--all" class="filter active" data-filter="*"><?php esc_html_e( 'All', 'minibuzzts' ) ?></li>
                        <?php 
                            // list terms in a given taxonomy
                            $taxonomy = 'jetpack-portfolio-type';
                            $tax_terms = get_terms( $taxonomy );
        
                            foreach ( $tax_terms as $tax_term ) {
                            echo '<li class="filter" data-filter=".'. $tax_term->slug.'">' . $tax_term->name .'</li>';
                            }
                        ?>
                    </ul>
                </div><!-- .portfolio-filter --> 
               <?php endif; ?> 
                        
				<div class="row">
                <div class="portfolio-wrapper">

                <div class="portfolio">
                            
                    <?php
            
                    
                        if ( get_query_var( 'paged' ) ) :
                            $paged = get_query_var( 'paged' );
                        elseif ( get_query_var( 'page' ) ) :
                            $paged = get_query_var( 'page' );
                        else :
                            $paged = -1;
                        endif;
            
                        $posts_per_page = get_option( 'jetpack_portfolio_posts_per_page', '-1' );
            
                        $args = array(
                            'post_type'      => 'jetpack-portfolio',
                            'paged'          => $paged,
                            'posts_per_page' => $posts_per_page,
                            
                        );
                        
                        
                        $project_query = new WP_Query ( $args );
            
                        //use the query for paging
                        $project_query->query_vars[ 'paged' ] > 1 ? $current = $project_query->query_vars[ 'paged' ] : $current = 1;
                
                        //set the "paginate_links" array to do what we would like it it. Check the codex for examples http://codex.wordpress.org/Function_Reference/paginate_links
                        $pagination = array(
                            'base' 			=> @add_query_arg( 'paged', '%#%' ),
                            'showall' 		=> false,
                            'end_size' 		=> 4,
                            'mid_size' 		=> 4,
                            'total'			=> $project_query->max_num_pages,
                            'current' 		=> $current,
                            'type' 			=> 'list',
							'prev_text'     =>  esc_html__('Prev', 'minibuzzts'),
							'next_text'     =>  esc_html__('Next', 'minibuzzts'),
                        );
                
                        //build the paging links
                        if ( $wp_rewrite->using_permalinks() )
                            $pagination[ 'base' ] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
                
                        //more paging links
                        if ( !empty( $project_query->query_vars[ 's' ] ) )
                            $pagination[ 'add_args' ] = array( 's' => get_query_var( 's' ) );
            
            
            
                        
                        if ( post_type_exists( 'jetpack-portfolio' ) && $project_query -> have_posts() ) :
                            
                            while ( $project_query -> have_posts() ) : $project_query -> the_post();
            
                                // get Jetpack Portfolio taxonomy terms for portfolio filtering
                                $terms = get_the_terms( $post->ID, 'jetpack-portfolio-type' );
                                                        
                                if ( $terms && ! is_wp_error( $terms ) ) : 
                                
                                    $filtering_links = array();
                                
                                    foreach ( $terms as $term ) {
                                        $filtering_links[] = $term->slug;
                                    }
                                                        
                                    $filtering = join( " ", $filtering_links );
                                    
                                    $cols = 4;
                            
                                    if($cols==1){
                                        $colclass = "item twelve columns";
                                    }elseif($cols==2){
                                        $colclass = "item one_half columns";
                                    }elseif($cols==3){
                                        $colclass = "item one_third columns";
                                    }elseif($cols==4){	
                                        $colclass = "item one_fourth columns";
                                    }elseif($cols==5){
                                        $colclass = "item one_fifth columns";
                                    }elseif($cols==6){
                                        $colclass = "item one_sixth columns";
                                    }
                                    
                                ?>
                                
                                    <article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($filtering) .' '. esc_attr($colclass)); ?>>
                                        
                                        <?php  if ( has_post_thumbnail() ) : ?>
                                            <div class="portfolio-img">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark" class="image-link" tabindex="-1"><span class="rollover"></span>
												<?php $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'minibuzzts-portfolio-img' );
                                                      echo '<img alt="post" class="imagepf" src="' . esc_url($image_src[0]) . '">'; 
                                                ?>
                                            </a>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="portfolio-text-wrapper">
                                            <h2 class="portfolio-title">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark" class="title-link">
                                                <?php echo the_title(); ?>
                                            </a>
                                            </h2>
                                            <div class="portfolio-text"><?php echo minibuzzts_string_limit_words(get_the_excerpt(), 17);  ?> </div>
                                        </div>
                                        
                                    </article><!-- #post-## -->
                                
                                <?php
                                endif;
            
                        endwhile;
                            
                        wp_reset_postdata();
                    ?>
                    </div><!-- .portfolio -->
                    </div>
                    </div>
                  	<div class="clear"></div>
                        	<?php if ( paginate_links($pagination)){
								echo '<div class="navigation pagination pf paging template"><div class="nav-links">' . paginate_links($pagination) . '</div></div>'; 
							}?>
                        
                        <?php
                                
                            else :
                        ?>
                
                            <section class="no-results not-found twelve columns">
                                <header class="page-header">
                                    <h2 class="page-title"><?php esc_html_e(  'No Project Found.', 'minibuzzts' ); ?></h2><br />
                        			<span><?php esc_html_e(  'Please check the jetpack plugin has been installed or activated or not ', 'minibuzzts' ); ?></span>
                                </header><!-- .page-header -->
                
                                <div class="page-content">
                                    <?php if ( current_user_can( 'publish_posts' ) ) : ?>
                
                                        <p><?php $url = admin_url( 'post-new.php?post_type=jetpack-portfolio') ;
												$link = sprintf( wp_kses( __( 'Ready to publish your first project? <a href="%1$s">Get started here</a>.', 'minibuzzts' ), 
												array(  'a' => array( 'href' => array() ) ) ), esc_url( $url ) );
												echo force_balance_tags($link);?></p>
                
                                    <?php else : ?>
                
                                        <p><?php esc_html_e(  'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'minibuzzts' ); ?></p>
                
                                    <?php endif; ?>
                                </div><!-- .page-content -->
                            </section><!-- .no-results -->
                        <?php endif;  ?>
                
               
                </div><!-- .portfolio-template -->
				<div class="clear"></div>
            </main><!-- .site-main -->
            <div class="clear"></div>
        </section><!-- .content-area -->
        
        <div class="clear"></div>
	</div>
    </div>
</div>
</div><!-- end maincontent -->
<!-- END MAIN CONTENT -->
<?php get_footer(); ?>