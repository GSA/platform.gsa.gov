<?php
/*

*/
?>

<?php get_header(); ?>
<div class="sixteen columns section sectionBlue">
	<h1>News Section Title Here</h1>
	<p class="subtitle hugeSubtitle">Lorem Ipsum Dolar Amet</p>
</div>
<div class="main sixteen columns">
		<?php if ( have_posts() ) : ?>
			<?php while (have_posts()) : the_post(); ?>	
				<div class="indexed-post" id="post-id-<?php the_ID();?>">
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h2>
					<span class="date"><?php the_time('F j, Y'); ?></span>
					<p><?php the_excerpt();?></p>
				</div>
			<?php endwhile; ?>
		<?php endif;  ?>

		<?php if (  $wp_query->max_num_pages > 1 ) :  /* pagination */ ?>
			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'skeleton' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'skeleton' ) ); ?></div>
			</div><!-- #nav-below -->
		<?php endif; ?>
</div>

<?php get_footer(); ?>