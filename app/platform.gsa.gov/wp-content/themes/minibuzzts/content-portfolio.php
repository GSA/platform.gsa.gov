<?php
/**
 * The template part for archive view Jetpack portfolio posts.
 *
 * @package minibuzz
 * @since minibuzz 1.0
 */
?>

<?php
	$cols = 4;

	if($cols==1){
		$colclass = "item twelve columns";
	}elseif($cols==2){
		$colclass = "item one_half columns";
	}elseif($cols==3){
		$colclass = "item one_third columns";
	}elseif($cols==4){	
		$colclass = "item one_fourth columns";
	}elseif($cols==5){
		$colclass = "item one_fifth columns";
	}elseif($cols==6){
		$colclass = "item one_sixth columns";
	}
	
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($colclass); ?>>                                             
	<?php  if ( has_post_thumbnail() ) : ?>
        <div class="portfolio-img">
        <a href="<?php the_permalink(); ?>" rel="bookmark" class="image-link" tabindex="-1"><span class="rollover"></span>
            <?php $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'minibuzzts-portfolio-img' );
                  echo '<img alt="post" class="imagepf" src="' . esc_url($image_src[0]) . '">'; 
            ?>
        </a>
        </div>
    <?php endif; ?>
    
    <div class="portfolio-text-wrapper">
        <h2 class="portfolio-title">
        <a href="<?php the_permalink(); ?>" rel="bookmark" class="title-link">
            <?php echo the_title(); ?>
        </a>
        </h2>
        <div class="portfolio-text"><?php echo minibuzzts_string_limit_words(get_the_excerpt(), 17);  ?> </div>
    </div>
</article><!-- #post-## -->
