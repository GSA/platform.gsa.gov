<?php
/**
 * The Sidebar containing the Challenge Page widget area.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */
?>
<?php do_action('st_before_sidebar');?>

<?php // secondary widget area
	if ( is_active_sidebar( 'challenge-sidebar' ) ) : ?>
	<ul>
		<?php dynamic_sidebar( 'challenge-sidebar' ); ?>
	</ul>
	<?php endif; // end secondary widget area ?>

<?php do_action('st_after_sidebar');?>