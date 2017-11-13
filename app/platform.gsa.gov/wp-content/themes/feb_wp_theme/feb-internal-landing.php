<?php
/**
 * The template for displaying the internal landing pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Template Name: Internal Landing Template
 * Description: For including custom internal homepage layouts (news,collaboration,workforce)
 * 
 * @package FEB WordPress Theme Framework
 * @subpackage feb
 * @author CTAC - www.ctacorp.com
 */

ob_start();
global $wp_query;
get_header(); ?>

<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'feb' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'feb' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>

<div class="row clearfix">
<div class="col-md-12 column web-content">
<div class="page-header">
<h1><?php the_title(); ?></h1>
</div>
</div>
</div>

<div class="container">
<div class="row clearfix">

<?php the_content(); ?>

</div>
</div>

<?php endwhile; ?>

</div>
</div>
<?php get_footer(); 
ob_end_flush();
?>
