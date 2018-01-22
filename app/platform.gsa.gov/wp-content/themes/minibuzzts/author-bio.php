<?php
/**
 * The template for displaying Author bios
 *
 * @package minibuzz
 * @since minibuzz 5.0
 */
?>

<div class="author-info">
	<div class="author-avatar">
		<?php
		/**
		 * Filter the author bio avatar size.
		 *
		 * @since minibuzz 5.0
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'minibuzzts_author_bio_avatar_size', 53 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .author-avatar -->

	<div class="author-description">
		<h3 class="author-title"><?php esc_html_e(  'About The Author:', 'minibuzzts' ) ?> 
        <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
		<?php the_author_link(); ?>
        </a>
        </h3>
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p><!-- .author-bio -->

	</div><!-- .author-description -->
</div><!-- .author-info -->
