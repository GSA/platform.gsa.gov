<script type="text/javascript">
//<![CDATA[
	jQuery(window).load(function() {
		jQuery('#featured-galleries').flexslider({
			controlNav: false,
			slideshow: false,
			slideshowSpeed: 0000,
			animationDuration: 100,
			directionNav:true,
			animationLoop: false,
			prevText: "&laquo;",
			nextText: "&raquo;"
		});
	});
//]]>
</script>

<div class="featured galleries">

	<div class="container">

		<?php if (get_option('solostream_features_title')) { ?>
		<h2 class="feature-title"><span><?php echo stripslashes(get_option('solostream_galleries_title')); ?></span></h2>
		<?php } ?>

		<div id="featured-galleries" class="flexslider">

			<ul class="slides">

				<li>

					<div class="slide-container clearfix">

<?php 
$count = 1;
$my_query = new WP_Query(array(
	'category_name' => get_option('solostream_galleries_cat'),
	'posts_per_page' => get_option('solostream_galleries_count')
));
while ($my_query->have_posts()) : $my_query->the_post();
$totalposts = $my_query->post_count;
$do_not_duplicate[] = $post->ID; ?>

						<div id="post-<?php echo $count; ?>" class="gallery-post">
							<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_thumbnail(); ?></a>
							<p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
						</div>

<?php if ( $count%4 == 0 && $count != $totalposts ) { ?>
					</div>
	    			</li>
				<li>
					<div class="slide-container clearfix">
<?php } ?>

<?php $count = $count + 1 ?>
<?php endwhile; ?>
					</div>

				</li>

			</ul>


		</div>

	</div>

</div>