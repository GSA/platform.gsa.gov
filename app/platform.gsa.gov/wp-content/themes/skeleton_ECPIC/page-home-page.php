<?php

/**
 * Template Name: Homepage
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 */

get_header();
st_before_content();
the_breadcrumb();
get_template_part( 'loop', 'page' );
st_after_content();
get_sidebar('page');
get_footer();
?>