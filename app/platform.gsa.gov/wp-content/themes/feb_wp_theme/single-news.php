<?php
/**
 * Template Name: News Story Template
 * Description: News Story individual post template
 *
 * @package FEB WordPress Theme Framework
 * @subpackage feb
 * @author CTAC - www.ctacorp.com
 */

get_header();
get_template_part( 'loop', 'news' );
get_sidebar();
get_footer();

?>