<?php
/**
 * The template for displaying all pages.
 * Template Name: Signup
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 */
require_once( '/var/www/opencms/' . 'wp-load.php' );

function do_signup_header() {
	do_action( 'signup_header' );
}
add_action( 'wp_head', 'do_signup_header' );

get_header();
the_breadcrumb();
st_before_content($columns='sixteen');
get_template_part( 'loop', 'page' );
st_after_content();

?>
<div id="ecpic_footer"><center><a href="#">Contact&nbsp;US</a> &nbsp;|&nbsp; <a href="#">Privacy&nbsp;Statement</a> &nbsp;|&nbsp; <a href="#">Disclaimer&nbsp;of&nbsp;Use</a> &nbsp;|&nbsp; <a href="#">Product&nbsp;Support</a> &nbsp;|&nbsp; <a href="#">Site&nbsp;Map</a></br />
eCPIC is a government-owned, managed, and distributed program</center></div>