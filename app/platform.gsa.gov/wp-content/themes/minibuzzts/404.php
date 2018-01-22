<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage minibuzz
 * @since minibuzz 5.0
 */

get_header(); 

//Header images
$postthumbnailid = get_post_thumbnail_id($post->ID);
$headerimgsrc = wp_get_attachment_image_src($postthumbnailid,'full');
$cf_imgheader = $headerimgsrc[0];

?>

<!-- BEFORECONTENT -->
<div id="outerbeforecontent">
    <div class="container">
        <div class="row">
            <div class="twelve columns">
            	<div id="beforecontent-wrap">
                <div id="beforecontent" style=" <?php if ($cf_imgheader !=""){ echo 'background:url(' . esc_url($cf_imgheader) . ')';}?> ">                  
                    <header id="page-title-wrapper">
                        <div class="page-title-header">
                           <h1 class="page-title"><?php esc_html_e(  'Not Found', 'minibuzzts' ); ?></h1>
                       </div><!-- .entry-header --> 
                    </header>
                    <div class="clear"></div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END BEFORECONTENT --> 

<!-- MAIN CONTENT -->
<div id="maincontent" class="site-content">

<div class="container">
    <div class="row">
    <div class="maincontent-wrapper">
       
       <section id="primary" class="content-area eight columns">
			<main id="main" class="site-main" role="main">

			<div class="page-wrapper">
				<div class="page-content">
					<h2><?php esc_html_e(  'This is somewhat embarrassing, isn&rsquo;t it?', 'minibuzzts' ); ?></h2>
					<p><?php esc_html_e(  'It looks like nothing was found at this location. Maybe try a search?', 'minibuzzts' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</div><!-- .page-wrapper -->

            </main><!-- .site-main -->
        </section><!-- .content-area -->
        
        <aside id="secondary" class="sidebar widget-area four columns " role="complementary">
        <?php get_sidebar(); ?>
        </aside><!-- .sidebar .widget-area -->
        <div class="clear"></div>
	</div>
    </div>
</div>
</div><!-- end maincontent -->
<!-- END MAIN CONTENT -->
                
<?php get_footer(); ?>