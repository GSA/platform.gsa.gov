<?php
/**
 * Template Name: Homepage Template
 *
 *
 * @package minibuzz
 * @since minibuzz 5.0
 */

get_header(); 

//Header images
$postthumbnailid = get_post_thumbnail_id($post->ID);
$headerimgsrc = wp_get_attachment_image_src($postthumbnailid,'full');
$cf_imgheader = $headerimgsrc[0];

$sliderclass = "";
$cz_tag = esc_attr(get_theme_mod( 'minibuzzts_slider_tag'));

if($cz_tag != ""){
$sliderclass = "with-slider"; } else {$sliderclass = "noslider";}
?>


<!-- MAIN CONTENT -->
<div id="maincontent" class="site-content homepage-template  <?php echo esc_attr($sliderclass) ?>">
<div class="container">
    <div class="row">
    <div class="maincontent-wrapper">
       
        <section id="primary" class="content-area eight columns">


            <main id="main" class="site-main page" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php if($post->post_content != "") : ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php endif; ?>
			<?php endwhile; // end of the loop. ?>
            
            </main><!-- .site-main -->

			<?php
				$cz_featured1_img = esc_url(get_theme_mod( 'minibuzzts_featured1_img'));
				$cz_featured1_title = esc_html(get_theme_mod( 'minibuzzts_featured1_title'));
                $cz_featured1_desc = wp_kses_post(get_theme_mod( 'minibuzzts_featured1_desc'));
                $cz_featured1_url = esc_url(get_theme_mod( 'minibuzzts_featured1_url'));
				
				$cz_featured2_img = esc_url(get_theme_mod( 'minibuzzts_featured2_img'));
				$cz_featured2_title = esc_html(get_theme_mod( 'minibuzzts_featured2_title'));
                $cz_featured2_desc = wp_kses_post(get_theme_mod( 'minibuzzts_featured2_desc'));
                $cz_featured2_url = esc_url(get_theme_mod( 'minibuzzts_featured2_url'));
				
				$cz_featured3_img = esc_url(get_theme_mod( 'minibuzzts_featured3_img'));
				$cz_featured3_title = esc_html(get_theme_mod( 'minibuzzts_featured3_title'));
                $cz_featured3_desc = wp_kses_post(get_theme_mod( 'minibuzzts_featured3_desc'));
                $cz_featured3_url = esc_url(get_theme_mod( 'minibuzzts_featured3_url'));
		
		
            ?>
            <!-- Features -->
            <div id="featurescontent">
                <div class="container">
                	<div class="features-wrapper"> 
                    <div class="row"> 

                        <article class="item four columns"> 
                            <?php if ( $cz_featured1_img !="" ) { ?>
                            <div class="features-image">
                                <?php echo '<img alt="icon" class="image-feature" src="' . esc_url($cz_featured1_img) . '">'; ?>
                            </div>
                            <?php } ?>
                            <div class="features-text">
                            	<?php if ( $cz_featured1_title !="" ) { ?>
                                <header class="features-header">
                                    <h2 class="entry-title">
										<?php if( $cz_featured1_url !=""){ ?>
                                            <a href="<?php echo esc_url($cz_featured1_url); ?>">
                                        <?php } ?>
                                        <?php echo esc_html($cz_featured1_title); ?>
                                        <?php if( $cz_featured1_url !=""){ ?>
                                            </a>
                                        <?php } ?>
                                    </h2>
                                </header><!-- .entry-header -->
                    			<?php } ?>
                                <div class="features-summary">
                                    <?php echo wp_kses_post($cz_featured1_desc); ?>
                                </div><!-- .features-summary -->

                            </div>
                        </article>
                        
                        <article class="item four columns"> 
                            <?php if ( $cz_featured2_img !="" ) { ?>
                            <div class="features-image">
                                <?php echo '<img alt="icon" class="image-feature" src="' . esc_url($cz_featured2_img) . '">'; ?>
                            </div>
                            <?php } ?>
                            <div class="features-text">
                            	<?php if ( $cz_featured2_title !="" ) { ?>
                                <header class="features-header">
                                    <h2 class="entry-title">
										<?php if( $cz_featured2_url !=""){ ?>
                                            <a href="<?php echo esc_url($cz_featured2_url); ?>">
                                        <?php } ?>
                                        <?php echo esc_html($cz_featured2_title); ?>
                                        <?php if( $cz_featured2_url !=""){ ?>
                                            </a>
                                        <?php } ?>
                                    </h2>
                                </header><!-- .entry-header -->
                    			<?php } ?>
                                <div class="features-summary">
                                    <?php echo wp_kses_post($cz_featured2_desc); ?>
                                </div><!-- .features-summary -->

                            </div>
                        </article>
                        
                        <article class="item four columns"> 
                            <?php if ( $cz_featured3_img !="" ) { ?>
                            <div class="features-image">
                                <?php echo '<img alt="icon" class="image-feature" src="' . esc_url($cz_featured3_img) . '">'; ?>
                            </div>
                            <?php } ?>
                            <div class="features-text">
                            	<?php if ( $cz_featured3_title !="" ) { ?>
                                <header class="features-header">
                                    <h2 class="entry-title">
										<?php if( $cz_featured3_url !=""){ ?>
                                            <a href="<?php echo esc_url($cz_featured3_url); ?>">
                                        <?php } ?>
                                        <?php echo esc_html($cz_featured3_title); ?>
                                        <?php if( $cz_featured3_url !=""){ ?>
                                            </a>
                                        <?php } ?>
                                    </h2>
                                </header><!-- .entry-header -->
                    			<?php } ?>
                                <div class="features-summary">
                                    <?php echo wp_kses_post($cz_featured3_desc); ?>
                                </div><!-- .features-summary -->

                            </div>
                        </article>
                        
                    </div>
                    </div>
                </div>
            </div> 
            <!-- END Features -->
  



        </section><!-- .content-area -->

        <aside id="secondary" class="sidebar widget-area four columns" role="complementary">
        <div class="widget-area">
			<?php
			
				$cz_cat_title = get_theme_mod( 'minibuzzts_slide_cat_title');
				
				echo '<h2 class="widget-title">'.esc_html($cz_cat_title).'</h2>';
                
               // Get category ID from Theme Customizer
                $catID = get_theme_mod('minibuzzts_slide_cat');
             
                // Only get Posts that are assigned to the given category ID
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'showposts' => 3,
                    'orderby' => 'date',
                    'ignore_sticky_posts' => 1,
                    'category_name' => $catID
                    );
                    
	
				$wp_query = new WP_Query();
				$wp_query->query($args);
								
				$tpl ='';
				
                // The loop
                if ($wp_query->have_posts()) :
                    while ($wp_query->have_posts()) : $wp_query->the_post(); 
						$tpl ='<div class="recentpost-widget">';
							$tpl .='<div class="recent-item">';
								$tpl .= '<h3 class="recent-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
								$tpl .='<div class="recent-date">'.get_the_time( get_option('date_format') ).'</div>';
								$tpl .='<div class="recent-text">'.minibuzzts_string_limit_words(get_the_excerpt(), '15').'</div>';
								$tpl .= '<div class="clear"></div>';
							$tpl .= '</div>';
						$tpl .= '</div>';
                     
                        echo $tpl;
						
                    endwhile;
                    
                endif;
            ?>
        </div>
        </aside><!-- .sidebar .widget-area -->


        <div class="clear"></div>
	</div>
    </div>
</div>
</div><!-- end maincontent -->
<!-- END MAIN CONTENT -->

<?php get_footer(); ?>