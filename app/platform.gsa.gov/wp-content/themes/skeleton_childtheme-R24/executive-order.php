<?php
/*
Template Name: Executive Order
*/
?>

<?php get_header(); ?>
<div class="sixteen columns section sectionBlue">
	<h1>The Commission in the News</h1>
	<p class="subtitle hugeSubtitle">Check back for press releases and media coverage of the Commission</p>
	
</div>
<div class="main sixteen columns">
	<div class="content twelve columns alpha">
		<?php if ( have_posts() ) : ?>
			<?php while (have_posts()) : the_post(); ?>	
				<div class="indexed-post single-post thePost" id="post-id-<?php the_ID();?>">
					<h2><?php the_title();?></h2>
					<p><?php the_content();?></p>
				</div>
			<?php endwhile; ?>
		<?php endif;  ?>
	</div>
	<div class="sidebar four columns omega blogRoll">
		<h3>Recent News</h3>
		<?php $postid = get_the_ID(); ?> 
		<?php query_posts('showposts=3&order=desc'); ?>
		<?php if ( have_posts() ) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<div class="sidebar-widget" id="widget-id-<?php the_ID();?>">
					<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h4>
				</div>
			<?php endwhile; ?>
		<?php endif; wp_reset_query(); ?>
	</div>
</div>


<?php get_footer(); ?>