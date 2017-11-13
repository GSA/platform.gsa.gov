				<?php if (is_home() && get_option('solostream_recent_posts_title')) { ?>
				<h2 class="feature-title"><span><?php echo stripslashes(get_option('solostream_recent_posts_title')); ?></span></h2>
				<?php } ?>

				<div class="post-by-2 clearfix">

<?php
$count = 1; 
if (is_home()) { 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts(array(
	'post__not_in' => $do_not_duplicate,
	'paged' => $paged
)); }
if (have_posts()) : while (have_posts()) : the_post();
	$guest_author = get_post_custom_values('guest-author');
	$guest_on = get_option('sites-custom-author');
	if(!is_author() || (is_author() && (empty($guest_author[0]) || empty($guest_on)) )):
		$post_class = ('post-left' == $post_class) ? 'post-right' : 'post-left'; ?>

					<div class="<?php echo $post_class; ?>">
						<div <?php post_class(); ?> id="post-main-<?php the_ID(); ?>">
							<div class="entry clearfix">
								<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
								<?php include (TEMPLATEPATH . "/postinfo.php"); ?>
								<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_thumbnail(); ?></a>
								<?php if ( get_option('solostream_post_content') == 'Excerpts' ) { ?>
									<?php the_excerpt(); ?>
									<p class="readmore"><a class="more-link" href="<?php the_permalink() ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php _e("Read More", "solostream"); ?></a></p>
								<?php } else { ?>
									<?php the_content(__("Read More", "solostream")); ?>
								<?php } ?>
								<div style="clear:both;"></div>
							</div>
						</div>
					</div>

					<?php if ( $post_class == 'post-right' ) { ?>
					<div class="post-clear"></div>
					<?php } ?>

<?php $count = $count + 1 ?>
<?php endif; endwhile; endif; ?>

					<?php include (TEMPLATEPATH . "/bot-nav.php"); ?>

				</div>