<?php
/**
 * The loop that displays a single post.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-single.php.
 *
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
					<?php echo '<div style="margin-top:20px;"><i class="fa fa-chevron-circle-left link-look"></i><a href="'.site_url('challenge-blog').'"> Back to Challenge Blog</a></div>'; ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php
					$sub_head = get_post_meta(get_the_ID(), 'challenge_blog_subheading' , true );
					if(!empty($sub_head))
						echo '<h3 style="margin-top:0px;font-style:italic;">'.$sub_head.'</h3>';
					?>
					<div class="entry-meta">
						<?php echo challenge_blog_posted_on(); ?>
					</div><!-- .entry-meta -->

					<div class="entry-content">
						<?php
							$url = wp_get_attachment_url( get_post_thumbnail_id() );

							if(!empty($url))
							{
								$this_img_post = get_post(get_post_thumbnail_id());
								$this_img_cap = $this_img_post->post_excerpt;
								echo '<div class="blog-featured-image">';
								echo '<img src="'.$url.'" title="'.get_the_title().' featured image">';
								echo !empty($this_img_cap) ? '<div class="featured-caption">'.$this_img_cap.'</div>' : '';
								echo '</div>';
							}
						?>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'skeleton' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'skeleton_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h2><?php printf( esc_attr__( 'About %s', 'skeleton' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'skeleton' ), get_the_author() ); ?>
								</a>
							</div><!-- #author-link	-->
						</div><!-- #author-description -->
					</div><!-- #entry-author-info -->
<?php endif; ?>

					<div class="entry-utility">
						<?php challenge_blog_posted_in(); ?>
						<?php edit_post_link( __( 'Edit', 'skeleton' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'skeleton' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'skeleton' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->
				<br/>
				<?php if(function_exists('the_ratings')) { the_ratings(); } ?><br/>
				<?php do_action('addthis_widget',get_permalink(), get_the_title(), 'large_toolbox');?>
				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>