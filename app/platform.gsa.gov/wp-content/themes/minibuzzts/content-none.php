<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package minibuzz
 * @since minibuzz 5.0
 */
?>

<section class="no-results not-found">
	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php 
				$url = admin_url( 'post-new.php' ) ;
				$link = sprintf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'minibuzzts' ), array(  'a' => array( 'href' => array() ) ) ), 
				esc_url( $url ) );
				echo $link;?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e(  'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'minibuzzts' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e(  'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'minibuzzts' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
