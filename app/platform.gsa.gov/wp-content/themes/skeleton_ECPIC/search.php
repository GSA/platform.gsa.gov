<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */

get_header();
st_before_content($columns='');
//echo '<a href="/search" style="text-decoration:none;">Search</a><br/>';

if ( have_posts() ) : ?>
				<center><span class="ecpic-headertext"><?php printf( __( 'Search Results for: %s', 'skeleton' ), '' . get_search_query() . '' ); ?></span></center><br />&nbsp;
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
			<div id="ecpic_container">
				<div id="post-0" class="post no-results not-found">
					<center><span class="ecpic-headertext"><?php _e( 'Nothing Found', 'skeleton' ); ?></span></center>
					<p><br /><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'skeleton' ); ?></p>
						<?php get_search_form(); ?>
					
				</div><!-- #post-0 -->
			</div>
<?php endif;
st_after_content();
get_sidebar('page');
get_footer();
?>