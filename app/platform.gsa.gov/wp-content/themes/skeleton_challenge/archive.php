<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 */

 get_header();

// set page title
print '<div class="challenge-content tag-archives"><h1 class="entry-title"> Tags</h1>';

if (is_tag()) {
    $current_object = get_queried_object();

    $posttags = get_tags('orderby=count&order=DESC');
    wp_register_script( 'list_hover', get_template_directory_uri() . '/javascripts/redirect_list.js'  );
    wp_enqueue_script( 'list_hover' );

    if ($posttags) {
        print '<ul class="tag-list-archive">';
        // list all tags
        foreach($posttags as $tag) {
              print '<li class="im-tag-list"> <span>+</span> <a href="#" class="post-tag ' . (($current_object->term_id == $tag->term_id)? 'expanded' : '') . '">' . $tag->name . ' (' . $tag->count . ')</a>';
            // need to list posts under tags
            $posts = get_posts( array(
                'numberposts' => -1, // we want to retrieve all of the posts
                'post_type' => 'challenge',
                'suppress_filters' => false, // this argument is required for CPT-onomies
                'tax_query' => array(
                    array(
                        'taxonomy' => 'post_tag',
                        'field' => 'id', // can be slug or id - a CPT-onomy term's ID is the same as its post ID
                        'terms' => $tag->term_id
                    )
                )
            ));

            if (count($posts) > 0) {
                print "<ul class='tagged-posts' >";

                foreach ($posts as $post) {
                    print '<li class="post-list-within-tag"><a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></li>';
                }

                print "</ul>";
            }
            print "</li>";
        }
        print '</ul>';
    }
}
else
{
    /* Queue the first post, that way we know
     * what date we're dealing with (if that is the case).
     *
     * We reset this later so we can run the loop
     * properly with a call to rewind_posts().
     */
    if (have_posts())
        the_post();
    st_before_content($columns = '');
    ?>

    <h1>
        <?php if (is_day()) : ?>
            <?php printf(__('Daily Archives: %s', 'skeleton'), get_the_date()); ?>
        <?php elseif (is_month()) : ?>
            <?php printf(__('Monthly Archives: %s', 'skeleton'), get_the_date('F Y')); ?>
        <?php
        elseif (is_year()) : ?>
            <?php printf(__('Yearly Archives: %s', 'skeleton'), get_the_date('Y')); ?>
        <?php
        else : ?>
            <?php _e('Blog Archives', 'skeleton'); ?>
        <?php endif; ?>
    </h1>

    <?php

    /* Since we called the_post() above, we need to
    * rewind the loop back to the beginning that way
    * we can run the loop properly, in full.
    */
    rewind_posts();

    /* Run the loop for the archives page to output the posts.
     * If you want to overload this in a child theme then include a file
     * called loop-archives.php and that will be used instead.
     */
    get_template_part('loop', 'archive');
    st_after_content();
    get_sidebar();
}
print "</div>";

get_footer();
?>
