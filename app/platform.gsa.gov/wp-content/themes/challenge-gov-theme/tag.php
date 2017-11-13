<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */

get_header();
//st_before_content($columns='');

?>
<div class="challenge-row">

<h1><?php printf( __( 'Challenge Category: %s', 'skeleton' ), '<span class="bolder">' . single_tag_title( '', false ) . '</span>' );?></h1>
<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
$posttags = get_tags();
if ($posttags) {
    foreach($posttags as $tag) {
        echo $tag->name . ' ';
    }
}
?>
</div>
<?php
get_footer();
?>
