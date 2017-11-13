<?php get_header(); ?>
<div class="sixteen columns section sectionBlue">
	<h1><?php $category = get_the_category(); echo $category[0]->cat_name;?></h1>
</div>

	<div class="main sixteen columns">
		<div class="content twelve columns news alpha">
			<?php if(is_category( 'Public Comments' )) { ?> <ul class="indent-list"> <?php } ?>
		<?php if ( have_posts() ) : ?>
			<?php while (have_posts()) : the_post(); ?>	
					<?php if(is_category( 'Public Comments' )) { ?>
							<?php if(get_post_meta($post->ID, 'Link', true)) { ?>
								<li class="comment-post" ><a href="<?php echo get_post_meta($post->ID, 'Link', true); ?>" title="<?php the_title_attribute();?>"><?php the_title();?></a>, <span><?php the_time('F j, Y');?></span></li>
							<?php } else { ?>
								<li class="comment-post"><a class="comment-post" href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title();?></a>, <span><?php the_time('F j, Y');?></span></li>
							<?php } ?>
					<?php } else { ?>	
						<div class="indexed-post" id="post-id-<?php the_ID();?>">
							<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h2>
							<p><?php the_excerpt();?></p>
						</div>
					<?php } ?>					
			<?php endwhile; ?>
		<?php endif;  ?>
		<?php if(is_category( 'Public Comments' )) { ?> </ul> <?php } ?>	

		<?php if (  $wp_query->max_num_pages > 1 ) :  /* pagination */ ?>
			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'skeleton' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'skeleton' ) ); ?></div>
			</div><!-- #nav-below -->
		<?php endif; ?>
		</div>
		<div class="sidebar four columns omega blogRoll">
			<?php if(in_category('Public Comments')){ ?>
				<?php dynamic_sidebar( 'default-sidebar' ); ?>
			<?php } ?>
		</div>
	</div>

<?php get_footer(); ?>