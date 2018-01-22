<?php
/**
 * The default template for displaying content. 
 *
 * @package minibuzz
 * @since minibuzz 5.0
 */
 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="articlecontainer">

    <header class="entry-header">
        <?php
            the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
        ?>
    </header><!-- .entry-header -->
       
    <?php if ( 'post' === get_post_type() ) { ?>
    <div class="entry-utility">
        
		<div class="user"><?php esc_html_e( 'Posted by','minibuzzts'); ?> 
        <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php the_author();?></a></div> 
        <div class="date"><?php esc_html_e('on ','minibuzzts'); ?> <?php the_time(get_option('date_format')); ?> </div> 
        
        <?php if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
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
                         esc_html__( 'No Comments', 'minibuzzts' ), 
                         esc_html__( '1 Comment', 'minibuzzts' ), 
                         esc_html__( '% Comments', 'minibuzzts' ),
                        esc_attr($css_class),
                         esc_html__( 'Comments Closed', 'minibuzzts' )
                    );
                 ?>
            </div>
         <?php } ?>
			<?php if ( is_sticky() && is_home() && ! is_paged() )
            echo '<div class="sticky featured-post">' . esc_html__( '( Sticky )', 'minibuzzts' ) . '</div>';
            ?>
        <div class="clear"></div>  
    </div>  
    <?php } ?> 
    
	<?php  if ( has_post_thumbnail() ) : ?>
    <div class="post-image">
        <?php minibuzzts_post_thumbnail(); ?>
    </div>	
    <?php endif; ?>
  
    <div class="entry-content">
     
            <?php the_content(''); ?>

        
        <?php
            wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' .  esc_html__( 'Pages : ', 'minibuzzts' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            ) );
        ?>
        
        <?php if(!is_single()){?>
        <a href="<?php the_permalink(); ?>" class="more"><?php esc_html_e( 'Continue Reading...','minibuzzts'); ?></a>
        <?php }?>

    </div>
 

    
    <div class="clear"></div>
</div>
</article><!-- end post -->