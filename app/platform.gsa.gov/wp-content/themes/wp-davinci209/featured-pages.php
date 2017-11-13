<script type="text/javascript">
//<![CDATA[
	jQuery(window).load(function() {
		jQuery('#featured-pages').flexslider({
			slideshowSpeed: 6000,
			directionNav:false,
			pauseOnHover:true,
			manualControls: '.flexslide-custom-controls li a',
			controlsContainer: '.container',
		});
	});
//]]>
</script>

<div class="featured wide pages">

	<div class="container">

		<div id="featured-pages" class="flexslider">

			<ul class="slides">

<?php 
$featpages = get_option('solostream_featpage_ids');
$featarr=split(",",$featpages);
$featarr = array_diff($featarr, array(""));
$count = 1;
foreach ( $featarr as $featitem ) { ?>

<?php $my_query = new WP_Query(array(
	'post_type' => array('post', 'page'),
	'page_id' => $featitem
	));
while ($my_query->have_posts()) : $my_query->the_post(); ?>

	    			<li id="feature-page-<?php echo $count; ?>"<?php echo solostream_featureclass(); ?>>

					<div class="slide-container clearfix">

						<?php if ( get_post_meta( $post->ID, 'video_embed', true ) ) { ?>
							<div class="feature-video">
								<div class="video"><?php echo get_post_meta( $post->ID, 'video_embed', true ); ?></div>
							</div>
						<?php } else { ?>
							<div class="feature-image"> 
								<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_feature_image_wide(); ?></a>
							</div>
						<?php } ?>

		    				<div class="flex-caption">
							<div class="excerpt">
								<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
								<?php the_excerpt(); ?>
								<p class="readmore"><a class="more-link" href="<?php the_permalink() ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php _e("Read More", "solostream"); ?></a></p>
							</div>
						</div>

					</div>

				</li>

<?php $count = $count + 1 ?>
<?php endwhile; ?>
<?php } ?>

			</ul>


		</div>

		<div class="controls-container clearfix">

			<ul class="flexslide-custom-controls clearfix">

<?php 
$featpages = get_option('solostream_featpage_ids');
$featarr=split(",",$featpages);
$featarr = array_diff($featarr, array(""));
$count = 1;
foreach ( $featarr as $featitem ) { ?>

<?php $my_query = new WP_Query(array(
	'post_type' => array('post', 'page'),
	'page_id' => $featitem
	));
while ($my_query->have_posts()) : $my_query->the_post(); ?>

				<li><a href="#" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>

<?php $count = $count + 1 ?>
<?php endwhile; ?>
<?php } ?>

			</ul>

		</div>

	</div>

</div>