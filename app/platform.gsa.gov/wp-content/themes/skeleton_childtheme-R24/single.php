<?php get_header(); ?>
<div class="sixteen columns section sectionBlue">
	<h1><?php $category = get_the_category(); echo $category[0]->cat_name;?></h1>
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
		<?php //comments_template( '', true ); ?>
	</div>
	<div class="sidebar four columns omega blogRoll">
		<?php if(in_category('Public Comments')){ ?>
			<?php dynamic_sidebar( 'default-sidebar' ); ?>
		<?php } else { ?>
			<h3>Recent News</h3>
			<?php $postid = get_the_ID(); ?> 
			<?php query_posts('cat=21&showposts=3&order=desc'); ?>
			<?php if ( have_posts() ) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<?php if($post->ID !== 1201): ?>
						<div class="sidebar-widget" id="widget-id-<?php the_ID();?>">
							<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h4>
						</div>
					<?php endif;?>
				<?php endwhile; ?>
			<?php endif; wp_reset_query(); ?>
		<?php } ?>
	</div>
</div>

<?php get_footer(); ?>