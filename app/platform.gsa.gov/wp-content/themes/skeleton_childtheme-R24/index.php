<?php
/*
Template Name: News
*/
?>

<?php get_header(); ?>
<div class="sixteen columns section sectionBlue">
	<h1>The Commission in the News</h1>
	<p class="subtitle hugeSubtitle">Check back for press releases and media coverage of the Commission</p>
</div>

	<div class="main sixteen columns">
		<div class="news twelve columns">
			<?php query_posts('cat=21&order=desc'); ?>
			<?php if ( have_posts() ) : ?>
				<?php while (have_posts()) : the_post(); ?>	
					<?php if($post->ID !== 1201): ?>
						<div class="indexed-post" id="post-id-<?php the_ID();?>">
							<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h2>
							<p><?php the_excerpt();?></p>
						</div>
					<?php endif;?>		
				<?php endwhile; ?>
			<?php endif;?>	
		

		<?php if (  $wp_query->max_num_pages > 1 ) :  /* pagination */ ?>
			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'skeleton' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'skeleton' ) ); ?></div>
			</div><!-- #nav-below -->
		<?php endif; ?>
		</div>
		<div class="four columns last"></div>
	</div>

<?php get_footer(); ?>