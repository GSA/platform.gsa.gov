<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package FEB WordPress Theme Framework
 * @subpackage feb
 * @author CTAC - www.ctacorp.com
 */

get_header();


?>
<div class="page-header">
<h2><?php
		printf( __( 'Category: %s', 'feb' ), single_cat_title( '', false ) );
	?></h2></div>	
	<?php
		$category_description = category_description();
		if ( ! empty( $category_description ) )
			echo '' . $category_description . '';
  
	/* Run the loop for the category page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-category.php and that will be used instead.
	 */
	get_template_part( 'loop', 'category' );
	
	get_sidebar();
	get_footer();
?>
