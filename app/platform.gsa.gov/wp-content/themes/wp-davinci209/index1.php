				<?php if (is_home() && get_option('solostream_recent_posts_title')) { ?>
				<h2 class="feature-title"><span><?php echo stripslashes(get_option('solostream_recent_posts_title')); ?></span></h2>
				<?php } ?>

<?php 
if (is_home()) { 
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts(array(
		'post__not_in' => $do_not_duplicate,
		'paged' => $paged
	)); }
if (have_posts()) : while (have_posts()) : the_post();
	$guest_author = get_post_custom_values('guest-author');
	$guest_on = get_option('sites-custom-author');
	if(!is_author() || (is_author() && (empty($guest_author[0]) || empty($guest_on)) )): ?>
				<div <?php post_class(); ?> id="post-main-<?php the_ID(); ?>">
					<div class="entry clearfix">
						<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_thumbnail(); ?></a>
						<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<?php if ( get_option('solostream_post_content') == 'Excerpts' ) { ?>
						<?php the_excerpt(); ?>
						<?php } else { ?>
						<?php the_content(__("", "solostream")); ?>
						<?php } ?>
						<div style="clear:both;"></div>
						<?php include (TEMPLATEPATH . "/postinfo.php"); ?>
					</div>
				</div>
<?php endif; endwhile; endif; ?>

				<?php include (TEMPLATEPATH . "/bot-nav.php"); ?>