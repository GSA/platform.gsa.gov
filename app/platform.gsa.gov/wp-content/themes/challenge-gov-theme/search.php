<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */

get_header();
//st_before_content($columns='');
?>
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
<script type="text/javascript">
    jQuery(document).ready(function($){
        if($("#challenge-blog-landing-container #challenge-blog-landing").height() > $("#challenge-blog-landing-container #sidebar").height())
            $("#challenge-blog-landing-container #sidebar").css({'height':(($("#challenge-blog-landing-container #challenge-blog-landing").height()+30)+'px')});
        if($("#challenge-blog-landing-container #challenge-blog-landing").height() < $("#challenge-blog-landing-container #sidebar").height())
            $("#challenge-blog-landing-container #challenge-blog-landing").css({'height':($("#challenge-blog-landing-container #sidebar").height()+'px')});
    });
</script>
<div id="challenge-blog-page-wrapper">
<div id="challenge-blog-landing-container">
        <div id="challenge-blog-landing">
            <div style="margin-top:20px;"><i class="fa fa-chevron-circle-left link-look"></i><a href="<?php echo site_url('challenge-blog'); ?>"> Back to Challenge Blog</a></div>
        	<?php
        
			if ( have_posts() ) : ?>
				<div class="challenge-row">
							<h1><?php printf( __( 'Search Results for: %s', 'skeleton' ), '' . get_search_query() . '' ); ?></h1>
							<?php
							/* Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called loop-search.php and that will be used instead.
							 */
							 get_template_part( 'loop', 'search' );
							?>
				</div>
			<?php else : ?>
							<div id="post-0" class="post no-results not-found">
								<h2><?php _e( 'Nothing Found', 'skeleton' ); ?></h2>
								
								<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'skeleton' ); ?></p>
									<?php get_search_form(); ?>
								
							</div><!-- #post-0 -->
			<?php endif; ?>
	</div>
	<?php get_sidebar('challenge-blog-landing'); ?>
</div>
</div>
<?php
//st_after_content();
//get_sidebar();
get_footer();
?>