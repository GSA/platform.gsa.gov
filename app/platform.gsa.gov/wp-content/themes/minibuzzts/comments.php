<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to klasik_comment which is
 * located in the functions.php file.
 *
 * @package minibuzz
 * @since minibuzz 5.0
 */
 
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
    <div class="comments-area-wrapper">
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( '1' === $comments_number ) {
					/* translators: %s: post title */
					printf( esc_html_x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'minibuzzts' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s Reply to &ldquo;%2$s&rdquo;',
							'%1$s Replies to &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'minibuzzts'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h2>

		
		<ol class="comment-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use minibuzzts_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define minibuzzts_comment() and that will be used instead.
				 * See minibuzzts_comment() in includes/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'minibuzzts_comment' ) );
			?>
		</ol><!-- .comment-list -->

		<?php minibuzzts_comment_nav(); ?>
	</div>
	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e(  'Comments are closed.', 'minibuzzts' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- .comments-area -->
