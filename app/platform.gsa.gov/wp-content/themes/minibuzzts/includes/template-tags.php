<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package minibuzz
 * @since minibuzz 5.0
 */
 
if ( ! function_exists( 'minibuzzts_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since minibuzz 5.0
 */
function minibuzzts_the_custom_logo() {
	
   // Try to retrieve the Custom Logo
    $output = '';
    if (function_exists('get_custom_logo'))
        $output = '<div id="logoimg">'.get_custom_logo().'</div>';
	
    // Nothing in the output: Custom Logo is not supported, or there is no selected logo
    // In both cases we display the site's name
    if (empty($output) || !has_custom_logo())
        $output = '
			<div id="logotext">
			<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'">' . get_bloginfo('name') . '</a></h1>
			<h2 class="site-description">' . get_bloginfo( 'description' ) . '</h2>
			</div>
		';

    echo force_balance_tags($output);
	
}
endif;

if ( ! function_exists( 'minibuzzts_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since minibuzz 5.0
 */
function minibuzzts_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo esc_attr($nav_id); ?>" class="<?php echo esc_attr($nav_class); ?>">
		<h1 class="assistive-text"><?php esc_html_e(  'Post navigation', 'minibuzzts' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '' .  esc_html__( '&larr; Previous', 'minibuzzts' )  ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '' .  esc_html__( 'Next &rarr;', 'minibuzzts' ) ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link(  esc_html__( '&larr; Older posts', 'minibuzzts' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link(  esc_html__( 'Newer posts &rarr;', 'minibuzzts' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>
	<div class="clear"></div>
	</nav><!-- #<?php echo esc_attr($nav_id); ?> -->
	<?php
}
endif; // minibuzzts_content_nav


if ( ! function_exists( 'minibuzzts_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since minibuzz 5.0
 */
function minibuzzts_comment( $comment, $args, $depth ) {

	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php esc_html_e(  'Pingback:', 'minibuzzts' ); ?> <?php comment_author_link(); ?><?php edit_comment_link(  esc_html__( '(Edit)', 'minibuzzts' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
            <div class="comment-author vcard">
                <?php echo get_avatar( $comment, 53 ); ?>
                
            </div><!-- .comment-author .vcard -->
			<footer class="comment-wrapper">
            	<div class="comment-metadata">
					<?php printf( sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                        <em><?php esc_html_e(  'Your comment is awaiting moderation.', 'minibuzzts' ); ?></em>
                        <br />
                    <?php endif; ?>				
					<a class="date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf(  esc_html__( '%1$s at %2$s', 'minibuzzts' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link(  esc_html__( '(Edit)', 'minibuzzts' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
                
                <div class="comment-content"><?php comment_text(); ?></div>
    
                <div class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!-- .reply -->
            </footer>
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for minibuzzts_comment()


if ( ! function_exists( 'minibuzzts_comment_nav' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since minibuzz 5.0
 */
function minibuzzts_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e(  'Comment navigation', 'minibuzzts' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link(  esc_html__( 'Older Comments', 'minibuzzts' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link(  esc_html__( 'Newer Comments', 'minibuzzts' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
        <div class="clear"></div>
	</nav><!-- .comment-navigation -->
    
	<?php
	endif;
}
endif; // ends check for minibuzzts_comment()

if ( ! function_exists( 'minibuzzts_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Create your own minibuzzts_post_thumbnail() function to override in a child theme.
 *
 * @since minibuzz 5.0
 */
function minibuzzts_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>
	
		
        <div class="post-thumbnail">
            <?php the_post_thumbnail(); ?>
        </div><!-- .post-thumbnail -->
        
        
	<?php else : ?>

        <a class="post-thumbnail-link" href="<?php the_permalink(); ?>" aria-hidden="true">
            <?php the_post_thumbnail( 'minibuzzts-blog-img', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
        </a>
	
	<?php endif; // End is_singular()
}
endif;
