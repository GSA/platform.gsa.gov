<script type="text/javascript">
//<![CDATA[
	jQuery(window).load(function() {
		jQuery('#featured-vids').flexslider({
			slideshow: false,
			slideshowSpeed: 0000,
			directionNav:false,
			manualControls: '.flexslide-custom-controls li a',
			controlsContainer: '.container'
		});
	});
//]]>
</script>

<div class="featured videos">

	<div class="container">

		<?php if (get_option('solostream_features_title')) { ?>
		<h2 class="feature-title"><span><?php echo stripslashes(get_option('solostream_videos_title')); ?></span></h2>
		<?php } ?>

		<div class="controls-container clearfix">

			<ul class="flexslide-custom-controls clearfix">
<?php 
$count = 1;
$my_query = new WP_Query(array(
	'category_name' => get_option('solostream_videos_cat'),
	'showposts' => get_option('solostream_videos_count')
));
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate[] = $post->ID; ?>
				<li><a href="#" title="<?php the_title(); ?>"><?php solostream_thumbnail(); ?></a></li>
<?php $count = $count + 1 ?>
<?php endwhile; ?>
			</ul>
		</div>

		<div id="featured-vids" class="flexslider">

			<ul class="slides">
<?php 
$count = 1;
$my_query = new WP_Query(array(
	'category_name' => get_option('solostream_videos_cat'),
	'showposts' => get_option('solostream_videos_count')
));
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate[] = $post->ID; ?>
	    			<li id="feature-vid-<?php echo $count; ?>">

					<div class="slide-container">

						<div class="feature-video">
							<div class="video"><?php echo get_post_meta( $post->ID, 'video_embed', true ); ?></div>
						</div>

	    					<div class="flex-caption">
							<h2 class="post-title"><?php the_title(); ?></h2>
							<?php the_excerpt(); ?>
							<p class="readmore"><a class="more-link" href="<?php the_permalink() ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php _e("Continue Reading", "solostream"); ?></a></p>
						</div>
	
					</div>

				</li>
<?php $count = $count + 1 ?>
<?php endwhile; ?>
			</ul>

		</div>

	</div>

</div>