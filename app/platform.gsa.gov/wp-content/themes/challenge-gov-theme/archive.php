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
?>
<script type="text/javascript">
    jQuery(document).ready(function($){
        if($("#challenge-blog-landing-container #challenge-blog-landing").height() > $("#challenge-blog-landing-container #sidebar").height())
            $("#challenge-blog-landing-container #sidebar").css({'height':(($("#challenge-blog-landing-container #challenge-blog-landing").height()+30)+'px')});
        if($("#challenge-blog-landing-container #challenge-blog-landing").height() < $("#challenge-blog-landing-container #sidebar").height())
            $("#challenge-blog-landing-container #challenge-blog-landing").css({'height':($("#challenge-blog-landing-container #sidebar").height()+'px')});
    });
</script>
<style type="text/css">
    html #wpadminbar{
        position: fixed;
    }
    /*
    #challenge-blog-landing-container{
        margin: 0 auto;
        background-color: #fff;
        box-shadow: -10px 0 8px -8px #eee, 10px 0 8px -8px #eee;
        overflow: hidden;
        text-align: left;
        padding: 0 15px;
        width: 90%;
    }
    */
    #challenge-blog-landing-container{
        text-align: left;
        padding: 0 15px;
    }

    #challenge-blog-landing-container{
        margin: 0 auto;
        width: 100%;
    }
    #challenge-blog-landing-container .page-content{
        box-shadow: none;
        padding: 0 15px;
        width: auto;
    }
    body>h2.entry-title{
        width: 100%;
        margin: 20px auto 10px;
    }

    #challenge-blog-landing-container #challenge-blog-landing{
        display: inline-block;
        width: calc(100% - 305px);
    }
    #challenge-blog-landing-container #sidebar{
        display: inline-block;
        width: 280px;
        vertical-align: top;
        padding: 0 15px;
    }
    #challenge-blog-landing-container #sidebar h1{
        font-size: 18px
    }
    #challenge-blog-landing-container #sidebar > ul{
        padding: 0 15px;
    }
    #challenge-blog-landing-container #sidebar > ul > li{
        list-style-type: none;
    }
    #challenge-blog-landing-container .entry-image{
        display: inline-block;
        width: 150px;
        margin: 10px 10px 10px 0px;
        vertical-align: top;
    }
    #challenge-blog-landing-container .entry-image img{
        max-width: 100%;
    }
    #challenge-blog-landing-container .entry-content{
        margin: 10px 0px;
        display: inline-block;
        width: calc(100% - 165px);
    }

    #challenge-blog-landing-container #sidebar #searchsubmit{
        background-color: #f80;
        border: solid 1px #ccc;
        opacity: 1;
        border-radius: 3px;
        height: 28px;
        padding: 0 11px 1px;
        cursor: pointer;
        margin-top:3px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        color: #fff;
        font-weight: normal;
        font-size: 13px;
        line-height: 26px;
        text-align: center;
        text-decoration: none;   
        box-shadow: 0 1px 0 rgba(255, 255, 255, 0.25) inset;
        margin-bottom: 5px;
    }

    #challenge-blog-page-wrapper{
        max-width: 1290px;
        margin: 0 auto;
    }
    /*===Divided===*/

    #challenge-blog-landing-container #sidebar,
    #challenge-blog-landing-container #challenge-blog-landing{
        background-color: #fff;
        box-shadow: -10px 0 8px -8px #eee, 10px 0 8px -8px #eee;
        overflow: hidden;
    }
    #challenge-blog-landing-container #sidebar{
        margin-left:20px;
        height:100%;
    }
    #challenge-blog-landing-container #challenge-blog-landing{
        width: calc(100% - 305px);
        padding: 15px;
        min-height: 640px;
    }

    /*=====Responsive*/

    @media only screen and (max-width: 767px){
        #challenge-blog-landing-container #challenge-blog-landing,
        #challenge-blog-landing-container #sidebar,
        #challenge-blog-landing-container .entry-content{
            width: 100%;
        }
        #challenge-blog-landing-container .entry-image{
            width: 100%;
            text-align: center;
        }

        /*===Divided===*/

        #challenge-blog-landing-container #sidebar,
        #challenge-blog-landing-container #challenge-blog-landing{
            box-shadow: none;
        }
        #challenge-blog-landing-container #sidebar{
            margin-left:0px;
        }
    }
</style>
<div id="challenge-blog-page-wrapper">
<?php
if(is_archive() && $wp_query->query_vars['taxonomy'] == 'blog_tag' && isset($wp_query->query['blog_tag'])){
    ?>
    <div id="challenge-blog-landing-container">
        <div id="challenge-blog-landing">
            <div style="margin-top:20px;"><i class="fa fa-chevron-circle-left link-look"></i><a href="<?php echo site_url('challenge-blog'); ?>"> Back to Challenge Blog</a></div>
            <h1 class="page-title"> Blog tag: <?php echo $wp_query->query['blog_tag']; ?></h1>
                <?php get_template_part('loop', 'archive'); ?>
        </div>
        <?php get_sidebar('challenge-blog-individual'); ?>
    </div>
    <?php
}else{
    if (is_tag()) {
        ?>
        <div id="challenge-blog-landing-container">
        <div id="challenge-blog-landing">
        <div class="container tag-archives"><h1 class="page-title"> Tags</h1>
        <?php
        $current_object = get_queried_object();

        $posttags = get_tags('orderby=count&order=DESC');
        wp_register_script( 'list_hover', get_template_directory_uri() . '/javascripts/redirect_list.js'  );
        wp_enqueue_script( 'list_hover' );

        if ($posttags) {
            print '<div class="page-content"><ul class="tag-list-archive">';
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
            print '</ul></div>';
        }
        ?>
            </div>
        </div>
        <?php get_sidebar('challenge-blog-individual'); ?>
    </div>
    <?php
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
        //st_before_content($columns = '');
        ?>
        <div id="challenge-blog-landing-container">
        <div id="challenge-blog-landing">
        <div style="margin-top:20px;"><i class="fa fa-chevron-circle-left link-look"></i><a href="<?php echo site_url('challenge-blog'); ?>"> Back to Challenge Blog</a></div>
        <h1 class="page-title">
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
        //st_after_content();
        //get_sidebar();
        ?>
        </div>
        <?php get_sidebar('challenge-blog-individual'); ?>
    </div>
        <?php
    }
}
echo '</div>';
get_footer();
?>
