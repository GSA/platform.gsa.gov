<?php
/*
Template Name: All Authors
*/
?>

<?php get_header(); ?>

	<?php
	global $wp_query;
	$postid = $wp_query->post->ID;
	$catid = get_post_meta( $post->ID, 'catid', true ); 
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

			<?php if ( get_post_meta( $postid, 'post_featvideo', true ) == "Yes" ) { ?>
				<?php include (TEMPLATEPATH . '/featured-vids.php'); ?>
			<?php } ?>

			<?php if ( get_post_meta( $postid, 'post_featgalleries', true ) == "Yes" ) { ?>
				<?php include (TEMPLATEPATH . '/featured-galleries.php'); ?>
			<?php } ?>

			<div id="content" class="maincontent">

				<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>

				<?php include (TEMPLATEPATH . '/banner468.php'); ?>

<?php /* START THE ALL AUTHORS PAGE TEMPLATE CONTENT */ ?>

				<h1 class="page-title"><?php the_title(); ?></h1>
				<?php the_post(); ?>
				<?php $content = get_the_content(); ?>
				<?php if ( ! empty( $content ) ) : ?>
					<div class="post">
						<div class="entry">
							<?php the_content(); ?>
						</div>
					</div>
				<?php endif; ?>

				<?php
					// Get the authors from the database ordered by user nicename
					global $wpdb;
					$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY user_nicename";
					$author_ids = $wpdb->get_results($query);

					// Loop through each author
					foreach($author_ids as $author) :

					// Get user data
					$curauth = get_userdata($author->ID);

					// If user level is above 0 or login name is "admin", display profile
					if ($curauth->user_level > 0 && $curauth->description || $curauth->user_login == 'admin' && $curauth->description) :

					// Get link to author page
					$user_link = get_author_posts_url($curauth->ID);

					// Set default avatar (values = default, wavatar, identicon, monsterid)
					$avatar = 'default';
				?>

				<div class="post author clearfix">

					<div class="entry clearfix">

						<?php /* Get author gravatar */ ?>
						<a href="<?php echo $user_link; ?>" title="<?php echo $curauth->display_name; ?>"><?php echo get_avatar($curauth->user_email, '144', $avatar); ?></a>

						<?php /* Get author name */ ?>
						<h2 class="post-title" style="margin-bottom:10px;"><a href="<?php echo $user_link; ?>" title="<?php echo $curauth->display_name; ?>"><?php echo $curauth->display_name; ?></a></h2>

						<?php /* Get author bio info */ ?>
						<p><?php echo $curauth->description; ?></p>

						<p><?php if ($curauth->user_url) /* Get author's website */ { ?><a href="<?php echo $curauth->user_url; ?>"><?php _e("Author Website", "solostream"); ?></a> | <?php } ?>

						<?php /* Get author link to recent posts */ ?>
						<a href="<?php echo $user_link; ?>" title="<?php echo $curauth->display_name; ?>"><?php _e("Author Archive Page", "solostream"); ?></a></p>

						<?php  // Get author's latest post title
							query_posts("author=$author->ID&showposts=1");
							if (have_posts()) : while(have_posts()) : the_post();
						?>
							<p>Latest Post: <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
						<?php endwhile; endif; ?>

					</div>

					<?php  /* Get author's social media icons */ ?>
						
					<p>
						<a rel="external" title="<?php _e("RSS Feed for", "solostream"); ?> <?php echo $curauth->display_name; ?>" href="<?php bloginfo('url'); ?>/author/<?php echo $curauth->user_nicename; ?>/feed/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/feed.png" alt="<?php _e("rss feed", "solostream"); ?>" /></a>

						<?php if ( $curauth->facebook ) { ?>
						<a rel="external" title="<?php echo $curauth->display_name; ?> <?php _e("on Facebook", "solostream"); ?>" href="http://www.facebook.com/<?php echo $curauth->facebook; ?>/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/facebook.png" alt="<?php _e("Facebook", "solostream"); ?>" /></a>
						<?php } ?>

						<?php if ( $curauth->twitter ) { ?>
						<a rel="external" title="<?php echo $curauth->display_name; ?> <?php _e("on Twitter", "solostream"); ?>" href="http://www.twitter.com/<?php echo $curauth->twitter; ?>/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/twitter.png" alt="<?php _e("Twitter", "solostream"); ?>" /></a>
						<?php } ?>

						<?php if ( $curauth->googbuzz ) { ?>
						<a rel="external" title="<?php echo $curauth->display_name; ?> <?php _e("on Google Plus", "solostream"); ?>" href="https://plus.google.com/<?php echo $curauth->googbuzz; ?>?rel=author"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/google-plus.png" alt="<?php _e("Google Plus", "solostream"); ?>" /></a>
						<?php } ?>

						<?php if ( $curauth->flickr ) { ?>
						<a rel="external" title="<?php echo $curauth->display_name; ?> <?php _e("on Flickr", "solostream"); ?>" href="http://www.flickr.com/photos/<?php echo $curauth->flickr; ?>/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/flickr.png" alt="<?php _e("Flickr", "solostream"); ?>r" /></a>
						<?php } ?>

						<?php if ( $curauth->linkedin ) { ?>
						<a rel="external" title="<?php echo $curauth->display_name; ?> <?php _e("on LinkedIn", "solostream"); ?>" href="http://www.linkedin.com/in/<?php echo $curauth->linkedin; ?>/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/linkedin.png" alt="<?php _e("LinkedIn", "solostream"); ?>" /></a>
						<?php } ?>

						<?php if ( $curauth->youtube ) { ?>
						<a rel="external" title="<?php echo $curauth->display_name; ?> <?php _e("on YouTube", "solostream"); ?>" href="http://www.youtube.com/user/<?php echo $curauth->youtube; ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/youtube.png" alt="<?php _e("YouTube", "solostream"); ?>" /></a>
						<?php } ?>

					</p>

				</div>

				<?php endif; ?>

				<?php endforeach; ?>

<?php /* END THE ALL AUTHORS PAGE TEMPLATE CONTENT */ ?>

			</div>

			<?php include (TEMPLATEPATH . '/sidebar-narrow.php'); ?>

		</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>