<?php
/*
Template Name: Portfolio
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

				<div class="post entry clearfix">

					<h1 class="page-title" id="post-<?php the_ID(); ?>"><?php the_title(); ?></h1>

					<?php the_post(); ?>
					<?php $content = get_the_content(); ?>
					<?php if ( ! empty( $content ) ) : ?>
						<div class="content">
							<?php the_content(); ?>
						</div>
					<?php endif; ?>

					<div id="portfolio-container">

						<ul id="filter" class="clearfix">
							<li class="cat-intro">Sort:</li>
							<li class="current"><a href="#">All</a></li>
							<?php
								$categories = get_categories('child_of=' .$catid); 
								foreach ($categories as $category) {
  									$items = '<li><a href="#">';
									$items .= $category->cat_name;
									$items .= '</a></li>'."\n";
									echo $items;
							} ?>
						</ul>

						<ul id="portfolio" class="clearfix">

							<?php
								$count = 1;
								$my_query = new WP_Query(array(
									'cat' => $catid,
									'showposts' => -1 ));
								while ($my_query->have_posts()) : $my_query->the_post();
								$terms = get_the_category(); 
							?>

							<li class="All <?php foreach ( $terms as $term ) { echo $term->name . ' '; } ?>">

								<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_thumbnail(); ?></a>

								<?php the_title(); ?>

							</li>

<?php $count = $count + 1; ?>
<?php endwhile; ?>

						</ul>

					</div>

				</div>

			</div>

			<?php include (TEMPLATEPATH . '/sidebar-narrow.php'); ?>

		</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>