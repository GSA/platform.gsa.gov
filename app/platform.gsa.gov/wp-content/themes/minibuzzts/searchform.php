<?php
/**
 * The template for displaying search forms
 *
 * @package minibuzz
 * @since minibuzz 5.0
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<div class="searcharea">
    <input type="text" name="s" id="s" value="<?php the_search_query(); ?>" />
    <input type="submit" class="searchbutton" value="<?php echo esc_html__( 'Search', 'minibuzzts' ) ?>" />
</div>
</form>