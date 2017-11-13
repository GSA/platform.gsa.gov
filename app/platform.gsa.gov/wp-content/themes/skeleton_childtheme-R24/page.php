<?php get_header(); ?>
<div class="sixteen columns section sectionBlue">
	<?php if ( have_posts() ) : ?>
		<?php while (have_posts()) : the_post(); ?>	
			<h1><?php the_title();?></h1>
</div>
<div class="main sixteen columns">
	<div class="content twelve columns alpha">		
				<div class="indexed-post single-post thePost" id="post-id-<?php the_ID();?>">
					<p><?php the_content();?></p>
				</div>				
			<?php endwhile; ?>
		<?php endif;  ?>

	</div>
	<div class="sidebar four columns omega blogRoll">
		<?php //dynamic_sidebar( 'default-sidebar' ); ?>
	</div>
</div>

<?php get_footer(); ?>
