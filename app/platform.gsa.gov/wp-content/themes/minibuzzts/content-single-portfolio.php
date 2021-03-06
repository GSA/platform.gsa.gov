<?php
/**
 * The template part for displaying single posts
 *
 * @package minibuzz
 * @since minibuzz 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

   
    <header class="entry-header">
       <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header><!-- .entry-header -->
    
    <div class="entry-utility">
        
        <div class="user"><?php esc_html_e('Posted by','minibuzzts'); ?>
        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></div>
        <div class="date"><?php esc_html_e('on ','minibuzzts'); ?> <?php the_time(get_option('date_format')); ?></div> 
    
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
	
    <?php if (has_post_thumbnail()) {?>
    <div class="post-thumbnail">
        <?php the_post_thumbnail( 'minibuzzts-blog-img', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
    </div><!-- .post-thumbnail -->
	<?php } ?>
    
	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' .  esc_html__( 'Pages : ', 'minibuzzts' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			) );

		?>      
	</div><!-- .entry-content -->
        
    <footer class="entry-footer">
        <?php
            edit_post_link( esc_html__( 'Edit', 'minibuzzts' ), '<span class="edit-link">', '</span>' );
        ?>

    </footer><!-- .entry-footer -->

</article><!-- #post-## -->


