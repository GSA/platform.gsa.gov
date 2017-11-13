<?php get_header(); ?>

	<?php
	global $wp_query;
	$postid = $wp_query->post->ID;
	if ( get_post_meta( $postid, 'post_featpages', true ) == "Yes" ) { ?>
		<?php include (TEMPLATEPATH . '/featured-pages.php'); ?>
	<?php } ?>

	<?php if ( get_post_meta( $postid, 'post_featcontent', true ) == "Full Width Featured Content Slider"  ) { ?>
		<?php include (TEMPLATEPATH . '/featured-wide.php'); ?>
	<?php } ?>

	<div id="page" class="clearfix">

		<div id="contentleft">

			<?php if ( get_post_meta( $postid, 'post_featcontent', true ) == "Narrow Width Featured Content Slider" ) { ?>
				<?php include (TEMPLATEPATH . '/featured-narrow.php'); ?>
			<?php } ?>

			<?php if ( get_post_meta( $postid, 'post_featgalleries', true ) == "Yes" ) { ?>
				<?php include (TEMPLATEPATH . '/featured-galleries.php'); ?>
			<?php } ?>

			<?php if ( get_post_meta( $postid, 'post_featvideo', true ) == "Yes" ) { ?>
				<?php include (TEMPLATEPATH . '/featured-vids.php'); ?>
			<?php } ?>

			<div id="content" class="maincontent">

				<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>

				<?php include (TEMPLATEPATH . '/banner468.php'); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="singlepost">

					<div class="post" id="post-main-<?php the_ID(); ?>">

						<div class="entry">

							<h1 class="post-title single"><a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h1>

							<?php include (TEMPLATEPATH . '/postinfo.php'); ?>

							<?php if ( get_post_meta( $post->ID, 'video_embed', true ) ) { ?>
								<div class="single-video">
									<?php echo get_post_meta( $post->ID, 'video_embed', true ); ?>
								</div>
							<?php } ?>

							<?php the_content(); ?>

							<div style="clear:both;"></div>

							<?php wp_link_pages(); ?>

							<?php if(function_exists('the_tags')) { the_tags('<p class="tags"><strong>'. __('Tags', "solostream"). ': </strong> ', ', ', '</p>'); } ?>
							<p class="cats"><strong><?php _e('Category', "solostream"); ?></strong>: <?php the_category(', '); ?></p>

						</div>

						<?php include (TEMPLATEPATH . '/auth-bio.php'); ?>

						<?php include (TEMPLATEPATH . '/related.php'); ?>

						<?php comments_template('', true); ?>

					</div>

					<?php include (TEMPLATEPATH . "/bot-nav.php"); ?>

				</div>

<?php endwhile; endif; ?>

			</div>

			<?php include (TEMPLATEPATH . '/sidebar-narrow.php'); ?>

		</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>