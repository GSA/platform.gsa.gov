<script type="text/javascript">
//<![CDATA[
	jQuery(window).load(function() {
		jQuery('#featured').flexslider({
			slideshowSpeed: 6000,
			directionNav:false,
			pauseOnHover:true,
			manualControls: '.flexslide-custom-controls li a',
			controlsContainer: '.container'
		});

	});
//]]>
</script>

<div class="featured">

	<div class="container">

		<div id="featured" class="flexslider">

			<ul class="slides">

<?php 
$count = 1;
$featurecount = get_option('solostream_features_number'); 
$my_query = new WP_Query("tag=featured&showposts=$featurecount");
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate[] = $post->ID; ?>

	    			<li id="narrow-feature-post-<?php echo $count; ?>"<?php echo solostream_featureclass(); ?>>

					<div class="slide-container clearfix">

						<?php if ( get_post_meta( $post->ID, 'video_embed', true ) ) { ?>
							<div class="feature-video">
								<div class="video"><?php echo get_post_meta( $post->ID, 'video_embed', true ); ?></div>
							</div>
						<?php } else { ?>
							<div class="feature-image"> 
								<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_feature_image(); ?></a>
							</div>
						<?php } ?>

		    				<div class="flex-caption">
							<div class="excerpt">
								<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
								<?php if ( 'post' == get_post_type() ) { ?>
									<?php include (TEMPLATEPATH . "/postinfo.php"); ?>
								<?php } ?>
								<?php the_excerpt(); ?>
								<p class="readmore"><a class="more-link" href="<?php the_permalink() ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php _e("Read More", "solostream"); ?></a></p>
							</div>
						</div>
	
					</div>

				</li>

<?php $count = $count + 1 ?>
<?php endwhile; ?>

			</ul>


		</div>

		<div class="controls-container clearfix">

			<ul class="flexslide-custom-controls clearfix">

<?php 
$count = 1;
$featurecount = get_option('solostream_features_number'); 
$my_query = new WP_Query("tag=featured&showposts=$featurecount");
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate[] = $post->ID; ?>

				<li><a href="#" title="<?php the_title(); ?>"><?php echo $count; ?></a></li>

<?php $count = $count + 1 ?>
<?php endwhile; ?>

			</ul>

		</div>

	</div>

</div>