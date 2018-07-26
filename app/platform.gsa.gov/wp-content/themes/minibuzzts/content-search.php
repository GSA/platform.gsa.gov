<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package minibuzz
 * @since minibuzz 5.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->
	<?php if ( 'post' === get_post_type() ) { ?>
    <div class="entry-utility">

        <div class="date"><?php the_time(get_option('date_format')); ?></div> 
        <div class="user"><?php esc_html_e('by','minibuzzts'); ?>
         <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></div>
    
         
        <div class="category"><?php esc_html_e('in','minibuzzts'); ?> <?php the_category(', '); ?></div>  
        
        <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
            <?php 
                $css_class = 'zero-comments';
                $number    = (int) get_comments_number( get_the_ID() );
                
                if ( 1 === $number )
                    $css_class = 'one-comment';
                elseif ( 1 < $number )
                    $css_class = 'multiple-comments';
            ?>
            
             <div class="comment <?php echo esc_attr($css_class); ?>">
                 <?php 
                
                    comments_popup_link( 
                        esc_html__(  'No Comments', 'minibuzzts' ), 
                        esc_html__(  '1 Comment', 'minibuzzts' ), 
                        esc_html__(  '% Comments', 'minibuzzts' ),
                        esc_attr($css_class),
                        esc_html__(  'Comments Closed', 'minibuzzts' )
                    );
                 ?>
            </div>
         <?php } ?>
    </div>
    <?php } ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
    


	<?php if ( 'post' == get_post_type() ) : ?>

		<footer class="entry-footer">
			<?php edit_post_link( __( 'Edit', 'minibuzzts' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-footer -->

	<?php else : ?>

		<?php edit_post_link( __( 'Edit', 'minibuzzts' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

	<?php endif; ?>

</article><!-- #post-## -->
