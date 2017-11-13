<?php
/**
 * Template Name: Full Width - No Sidebar or Page Title
 * @package FEB WordPress Theme Framework
 * @subpackage feb
 * @author CTAC - www.ctacorp.com
*/

get_header();
while ( have_posts() ) : the_post();
    the_content();
endwhile; // end of the loop.
get_sidebar();
get_footer();
?>