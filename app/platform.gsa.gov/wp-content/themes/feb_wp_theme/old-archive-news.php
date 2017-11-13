<?php
/**
 * The template for displaying the News homepage.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Template OLDName: News homepage Template
 * Description: For including custom news homepage layout
 * 
 * @package FEB WordPress Theme Framework
 * @subpackage feb
 * @author CTAC - www.ctacorp.com
 */

ob_start();
global $wp_query;
get_header(); ?>

<div class="row clearfix">
<div class="col-md-12 column web-content">
<div class="page-header">
<h1>News</h1>
</div>
</div>
</div>

<div class="container">
<div class="row clearfix">
<div class="col-md-12 column">
<div class="row clearfix">
<div class="col-md-8 column">
<h3>Top Stories</h3>
<div id="topStoriesGroup">
<?php
$featuredNews = new WP_Query( array( 'post_type' => 'news' ,'meta_key' => 'top-story', 'meta_value' => 'true') );
$newsCounter = 1;
		if ( $featuredNews->have_posts() ) {
		    while($featuredNews->have_posts()) {
		        $featuredNews->the_post();
		        $replace_count = 0;
			?>
	<div class="media">
		<?php
	        if ( has_post_thumbnail() ) {
	            echo '<a href="<?php the_permalink(); ?>" class="media-left"><img src='.wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())).' class="img-circle media-object"></a>';
	        } else {
	            //echo '<img src="'.site_url().'/wp-content/themes/IHIM/images/blog-placeholder-image.png" alt="Featured Story\'s Display Image">';
	            echo '<div class="media-left"><div class="media-object"></div></div>';
	        }
	    ?>
	<div class="media-body">
	<h4 class="media-heading">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h4>
	<?php echo str_replace('<div id="topstory" class="accordion-body collapse ">','<div id="topstory'.$newsCounter.'" class="accordion-body collapse ">',do_shortcode(get_the_content()), $replace_count);
		if($replace_count > 0)
		{
			?>
			</div>
		</div>
		<div class="more" data-toggle="collapse" data-parent="#topStoriesGroup" href="#topstory<?php echo $newsCounter; ?>">More</div>
		<?php
		}
	?>
	</div>
	</div><!-- Media !-->
	<?php
	$newsCounter++;
	}
}
?>
</div>
	</div>

<div class="col-md-4 column">
	<h3>
		Important Links and Documents
	</h3>
	<ul>
		<li><a href="/wp-content/uploads/sites/21/2015/03/2015-Atlanta-FEB-Leadership-Government-Program-Application.pdf" title="download a copy" target="_blank">2015 Leadership Government Application</a>&nbsp;<i class="fa fa-download"></i>&nbsp;</li>
        <li><a href="/wp-content/uploads/sites/21/2015/03/2015-Leadership-Government-Payment-Form.doc" title="download a copy" target="_blank">2015 Leadership Government Payment Form</a>&nbsp;<i class="fa fa-download"></i>&nbsp;</li>
        <li><a href="/wp-content/uploads/sites/21/2015/03/Congressional-Resource-Guide-Web.pdf" title="download a copy" target="_blank">Interagency Congressional Resource Guide Download a PDF Copy</a>&nbsp;<i class="fa fa-download"></i>&nbsp;</li>
        <li><a href="http://www.thebookpatch.com/BookStore/interagency-congressional-resource-guide/3f7c647c-5d0d-4a67-bf28-825d429a3420" target="_new">Order A Printed Copy of the Interagency Congressional Resource Guide</a>&nbsp;<i class="fa fa-download"></i>&nbsp;</li>
        <li><a href="/wp-content/uploads/sites/21/2015/03/PSRW-2013-letter-from-the-President.pdf" title="download a copy" target="_blank">The White House - Public Service Recognition Week</a>&nbsp;<i class="fa fa-download"></i>&nbsp;</li>
        <li><a href="http://www.opm.gov/policy-data-oversight/pay-leave/furlough-guidance/guidance-for-administrative-furloughs.pdf" title="download a copy" target="_blank">Guidance for Administrative Furloughs</a>&nbsp;<i class="fa fa-download"></i></li>
        <li><a href="/wp-content/uploads/sites/21/2015/03/2012_Atlanta_Crime_Report__Final.pdf" title="download a copy" target="_blank">The 2012 Atlanta Crime Report</a>&nbsp;<i class="fa fa-download"></i></li>
        <li><a href="http://www.opm.gov/" target="_new">Office of Personnel Management - OPM</a>&nbsp;<i class="fa fa-external-link"></i></li>
        <li><a href="https://www.whitehouse.gov/" target="_new">The White House</a>&nbsp;<i class="fa fa-external-link"></i></li>
	</ul>
</div>

</div>
</div>

</div>
</div>
</div>
</div>
<?php get_footer(); 
ob_end_flush();
?>
