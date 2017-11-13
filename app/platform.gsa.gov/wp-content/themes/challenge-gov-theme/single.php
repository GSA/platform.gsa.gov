<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */
get_query_var('page');
get_header();
?>
<style type="text/css">
	html #wpadminbar{
        position: fixed;
    }
    #challenge-single-post-container #sidebar h1{
    	font-size: 18px
    }
    #challenge-single-post-container #sidebar > ul > li{
    	list-style-type: none;
    }
    #challenge-single-post-container #sidebar #searchform #s{
    	width: 100%;
    }
    #challenge-single-post-container #sidebar > ul{
    	padding: 0 15px;
    }
    #challenge-single-post-container #sidebar #searchsubmit{
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
	#challenge-single-post-container{
	    margin: 0 auto;
	    /*background-color: #fff;
	    box-shadow: -10px 0 8px -8px #eee, 10px 0 8px -8px #eee;*/
	    overflow: hidden;
	    text-align: left;
	    /*padding: 0 15px;*/
	    /*width: 90%;*/
        width: 100%;
	}
	#challenge-single-post-container #challenge-single-post>div>div.container{
		box-shadow: none;
		padding: 0 15px;
		width: auto;
	}
	#challenge-single-post-container #challenge-single-post{
        display: inline-block;
        width: calc(100% - 305px);
        padding: 0 10px;
    }
    #challenge-single-post-container #sidebar{
        display: inline-block;
        width: 280px;
        vertical-align: top;
        padding: 0 15px;
        margin-left:15px;
    }
    #challenge-single-post-container #sidebar #searchform #s{
        width: 100%;
    }
    #challenge-single-post-container .post-ratings{
        min-height: 40px;
    }

    /*===Divided===*/

    #challenge-single-post-container #sidebar,
    #challenge-single-post-container #challenge-single-post{
        background-color: #fff;
        box-shadow: -10px 0 8px -8px #eee, 10px 0 8px -8px #eee;
        overflow: hidden;
    }
    #challenge-single-post-container #sidebar{
        margin-left:20px;
        height:100%;
    }
    #challenge-single-post-container #challenge-single-post{
        width: calc(100% - 305px);
    }
    #challenge-blog-page-wrapper{
        max-width: 1290px;
        margin: 0 auto;
    }
    .blog-featured-image{
        float:left;
        max-width:40%;
        margin-bottom:10px;
        margin-right:20px;
        border: 1px solid #555;
    }
    .blog-featured-image img{
        max-width: 100%;
    }
    .blog-featured-image .featured-caption{
        padding:5px 10px;
        text-align: left;
    }
    #challenge-single-post-container h1.entry-title{
        margin-bottom: 5px;
    }

    #challenge-single-post-container div.entry-meta{
        margin: 10px 0;
    }
    /* Bootstrap Overrides */
    .wp-caption {
        color: #767676;
    }
    .alignleft {
        float: left;
        margin-right: 10px;
    }
    .alignright {
        float: right;
        margin-left: 10px;
    }
    .aligncenter{
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    blockquote.aligncenter, img.aligncenter, .wp-caption.aligncenter {
        margin-top: 7px;
        margin-bottom: 7px;
    }
    @media only screen and (max-width: 767px){
        #challenge-single-post-container #challenge-single-post{
            width:100%;
            box-shadow: none;
        }
        #challenge-single-post-container #sidebar{
            width:100%;
            border-top:1px solid #ccc;
            margin-top:20px;
            box-shadow: none;
            margin-left:0px;
            height: auto !important;
        }
        .blog-featured-image{
            float:none;
            max-width: 100%;
            margin-right:0;
            margin:0 auto 10px;
        }
    }
</style>
<?php
echo '<div id="challenge-blog-page-wrapper">';
echo '<div id="challenge-single-post-container">';
echo '<div id="challenge-single-post">';
st_before_content($columns='');
get_template_part( 'loop', 'single' );
st_after_content();
//do_action('addthis_widget');

echo '</div>';
get_sidebar('challenge-blog-individual');
echo '</div>';
echo '</div>';
get_footer();
?>