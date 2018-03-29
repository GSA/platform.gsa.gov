<?php
/**
 * The Header for our theme.
 *
 *
 * @package minibuzz
 * @since minibuzz 5.0
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="bodychild">
	<div id="outercontainer">
    
        <!-- HEADER -->
        <div id="outerheader" class="feb-fixed-header-container">
        	<div id="headercontainer">
                <div class="container feb-header-inner">
                <div class="row">
                    <div class="twelve columns">
                    <header id="top">
                    		<div id="logo">
				<?php minibuzzts_the_custom_logo(); ?>
							</div>
                                                       
                        <div class="clear"></div>
                    </header>
                              
                
                    <section id="navigation">
                        <nav id="top-nav-wrap">
                            <?php wp_nav_menu(array(
								'container' => 'ul',
                                'menu_class' => 'sf-menu',
                                'theme_location' => 'primary'
                            )); ?>
                            <?php get_search_form(); ?>
                            <div class="clear"></div>
                        </nav><!-- nav -->	
                        
                        <div class="clear"></div>
                    </section>
                    </div>
                </div>
                </div>
                <div class="clear"></div>
            </div>
		</div>
        <!-- END HEADER -->

<?php 
if ( is_front_page()  ) :

$cz_tag = esc_attr(get_theme_mod( 'minibuzzts_slider_tag'));

if($cz_tag != ""){

?>
<!-- SLIDER  -->
<div id="outerslider">
<div class="container">
    <div class="row">
    <div class="twelve columns">
    <div id="slidercontainer">
        <section id="slider">
		<?php
					
			$output="";
			
			
			//global $wp_query, $post;
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'showposts' => -1,
				'tag' => $cz_tag,
				'orderby' => 'date',
				'ignore_sticky_posts' => 1
			);
			
		
			global $wp_query;
			$temp = $wp_query;
			$wp_query= null;
			$wp_query = new WP_Query();
			$wp_query->query($args);
			global $post;
			
			$cf_bgslider="";
			

			echo '<div id="slideritems"> ';

			while ($wp_query->have_posts()) : $wp_query->the_post(); 
			
			$custom = get_post_custom($post->ID);
			$cf_slideurl = (isset($custom["slider-link"][0]))?$custom["slider-link"][0] : "";
			$cf_thumb = (isset($custom["slider-image"][0]))?$custom["slider-image"][0] : "";
			
			//embed video	
			$pregemb = preg_match_all('/(\[embed.*\[\/embed\])/is', get_the_content(), $embeds);
			$embed = isset($embeds[1][0])? $embeds[1][0] : "";
			$media = "";
			$cf_video = "";
			global $wp_embed;
			$media = $wp_embed->run_shortcode($embed);
			$cf_video = $media;
				
				$output="";
				
				//slider images
				if(has_post_thumbnail( get_the_ID()) || $cf_thumb!=""){
					if($cf_thumb!=""){
						$cf_bgslider = $cf_thumb;
					}else{
						$postthumbnailid = get_post_thumbnail_id($post->ID);
						$sliderimgsrc = wp_get_attachment_image_src($postthumbnailid,'image-slider');
						$cf_bgslider = $sliderimgsrc[0];
					}
				}elseif($cf_video!=''){
					$cf_bgslider = get_template_directory_uri().'/images/blank.gif';
				}else{
					$cf_bgslider = '';
				}
				
				
				
					$output .='<div class="slider-img" data-src="'.esc_attr($cf_bgslider).'">';
						
					if($media!=""){
						$output .= $cf_video;
					}else{
					
						if($cf_slideurl==""){
							$cf_slideurl = get_permalink();
						}
													
						//slider text
						$output .='<div class="camera_caption fadeFromTop">';
							$output  .='<div class="slider-title-wrap">';											
								if($cf_slideurl!=""){
									$output .='<h1 class="slider-title"><a href="'.esc_url($cf_slideurl).'">' . get_the_title() . '</a></h1>';
								}else{
									$output .='<h1 class="slider-title">' . get_the_title() . '</h1>';
								}
							$output  .='</div>';
							
							if(get_the_excerpt()!=""){
								$output .='<p class="slider-desc">';
								$output .= get_the_excerpt();
								$output .='</p>';
							}
							$output .= '<a href="'.esc_url($cf_slideurl).'" class="slider-button">'. esc_html__( 'Read More', 'minibuzzts' ).'</a>';
																	
						$output .='</div>';
					}
					
					$output .= '</div>';

				echo force_balance_tags($output);
				
				endwhile;
				
				if($cz_tag != ""){	
					echo '</div>';
				}

			
			$wp_query = null; $wp_query = $temp; wp_reset_postdata();
			?>
            <div class="clear"></div>
        </section>
        
    </div>
    </div>
	<div class="clear"></div>
</div>
</div>
</div>
<!-- END SLIDER  -->
<?php } endif; ?>				