<?php
/*
 * Template Name: Testimonial Template
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
<div id="maincontent" class="site-content testimonial-template">

<div class="container">
    <div class="row">
    <div class="maincontent-wrapper">
       
        <section id="primary" class="content-area twelve columns">
        <main id="main" class="site-main page full" role="main">
        
            <div id="page" class="testimonial-template">
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
            
            
       
            <div class="testimonial-wrapper">
            <div class="testimonial">
            
            <?php
            
                if ( get_query_var( 'paged' ) ) :
                    $paged = get_query_var( 'paged' );
                elseif ( get_query_var( 'page' ) ) :
                    $paged = get_query_var( 'page' );
                else :
                    $paged = -1;
                endif;
                
                $posts_per_page = get_option( 'jetpack_testimonial_posts_per_page', '-1' );
            
                $args = array(
                    'post_type'      => 'jetpack-testimonial',
                    'paged'          => $paged,
                    'posts_per_page' => $posts_per_page,
                );
            
                $testi_query = new WP_Query ( $args );
                
                //use the query for paging
                $testi_query->query_vars[ 'paged' ] > 1 ? $current = $testi_query->query_vars[ 'paged' ] : $current = 1;
            
                //set the "paginate_links" array to do what we would like it it. Check the codex for examples http://codex.wordpress.org/Function_Reference/paginate_links
				$pagination = array(
					'base' 			=> @add_query_arg( 'paged', '%#%' ),
					'showall' 		=> false,
					'end_size' 		=> 4,
					'mid_size' 		=> 4,
					'total'			=> $testi_query->max_num_pages,
					'current' 		=> $current,
					'type' 			=> 'list',
					'prev_text'     =>  esc_html__('Prev', 'minibuzzts'),
					'next_text'     =>  esc_html__('Next', 'minibuzzts'),
				);
            
                //build the paging links
                if ( $wp_rewrite->using_permalinks() )
                    $pagination[ 'base' ] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
            
                //more paging links
                if ( !empty( $testi_query->query_vars[ 's' ] ) )
                    $pagination[ 'add_args' ] = array( 's' => get_query_var( 's' ) );
                
					$x = 0;
					$i=0;
                    $cols = 2; // to set the colomns	
					$max_columns = $cols; 
            
                if ( post_type_exists( 'jetpack-testimonial' ) && $testi_query -> have_posts() ) :
            
                    while ( $testi_query -> have_posts() ) : $testi_query -> the_post();
            
                        // get Jetpack Portfolio taxonomy terms for testimonial filtering
                        $terms = get_the_terms( $post->ID, 'jetpack-testimonial-type' );
            
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
							
							$x++;
							if($x%$cols==0){
								$omega = 'omega';
							}elseif($x%$cols==1){
								$omega = 'alpha';
							}else{
								$omega = '';
							}
                            
                        ?>
                        
						<?php if ($i%$max_columns==0) { ?>
                        <div class="row">
                        <?php } ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($colclass) .' '. esc_attr($omega)); ?>>
                        	<div class="testi-quote">
                            	<?php the_content(); ?>
                                <div class="arrow"></div>
                            </div>
                            
                            <?php  if ( has_post_thumbnail() ) : ?>
                            	<div class="testi-thumb">
                                <?php 
                                    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'minibuzzts-testimonial-img' );
                                    echo '<img alt="post" class="imagetesti" src="' . esc_url($image_src[0]) . '">'; 
                                ?>
                                </div>
                            <?php endif; ?>
							
                            <div class="testi-title">
                            	<?php the_title(); ?>
                            </div>
                            
                        </article><!-- #post-## -->
                        <?php $i++; 
						if($i%$max_columns==0) { ?>
                        </div>
                        <?php } ?>
                        
                        <?php
                                                
                    endwhile;
                                                            
                    wp_reset_postdata();
            ?>
            </div><!-- .testimonial -->
            </div>
            <div class="clear"></div>
            <?php  if ( paginate_links($pagination)){	
				echo '<div class="navigation pagination testi paging template"><div class="nav-links">' . paginate_links($pagination) . '</div></div>'; 
			}?>
            
            <?php
                else :
            ?>
            
                <section class="no-results not-found twelve columns">
                    <header class="page-header">
                        <h2 class="page-title"><?php esc_html_e(  'No Testimonial Found. ', 'minibuzzts' ); ?></h2><br />
                        <span><?php esc_html_e(  'Please check the jetpack plugin has been installed or activated or not ', 'minibuzzts' ); ?></span>
                    </header><!-- .page-header -->
            
                    <div class="page-content">
                        <?php if ( current_user_can( 'publish_posts' ) ) : ?>
            
                            <p><?php $url = admin_url( 'post-new.php?post_type=jetpack-testimonial') ;
                                    $link = sprintf( wp_kses( __( 'Ready to publish your first testimonial? <a href="%1$s">Get started here</a>.', 'minibuzzts' ), 
                                    array(  'a' => array( 'href' => array() ) ) ), esc_url( $url ) );
                                    echo force_balance_tags($link); ?></p>
            
                        <?php else : ?>
            
                            <p><?php esc_html_e(  'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'minibuzzts' ); ?></p>
            
                        <?php endif; ?>
                    </div><!-- .page-content -->
                </section><!-- .no-results -->
                
            <?php endif; ?>
                </div><!-- .testimonial-template -->
            <div class="clear"></div>
        </main><!-- .site-main -->
        <div class="clear"></div>
        </section><!-- .content-area -->

        <div class="clear"></div>
	</div>
    </div>
</div>
</div><!-- end .site-content -->
<!-- END MAIN CONTENT -->
<?php get_footer(); ?>