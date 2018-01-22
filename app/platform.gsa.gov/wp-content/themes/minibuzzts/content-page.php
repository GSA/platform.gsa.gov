<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage minibuzz
 * @since minibuzz 5.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' .  esc_html__( 'Pages:', 'minibuzzts' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' .  esc_html__( 'Page', 'minibuzzts' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
        <div class="clear"></div>
	</div><!-- .entry-content -->

	<?php edit_post_link(  esc_html__( 'Edit', 'minibuzzts' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

</article><!-- #post-## -->
