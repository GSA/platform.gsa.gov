<?php
/**
 * Template Name: Challenge Blog Landing Page
 *
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 */

get_header();
//st_before_content($columns='');
$scroll_meta = get_post_meta(get_the_ID(),'scroll_speed',true);
$scroll_speed = !empty($scroll_meta) ? $scroll_meta*1000 : 10000;
?>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $("#challenge-blog-landing-container #sidebar").css({'height':(($("#challenge-blog-landing-container").height())+'px')});
        $(".blog-featured-img:eq(0), .blog-featured-text:eq(0)").show();
        var hide_num = 0;
        var show_num = 1;
        /* later */

        var slider_loop_func = function(){

            if($(".blog-featured-img").length == show_num)
                show_num = 0;
            
            $(".blog-featured-img:eq("+hide_num+")").hide();
            $(".blog-featured-text:eq("+hide_num+")").hide();
            
            $(".blog-featured-img:eq("+show_num+")").fadeIn();
            $(".blog-featured-text:eq("+show_num+")").show();

            hide_num++;
            if(show_num == 0)
                hide_num = 0;
            show_num++;

        }

        var slider_loop = setInterval(slider_loop_func, <?php echo $scroll_speed; ?>);

        $('.blog-featured-controls a').on('click', function(){
            if($(this).hasClass('blog-featured-play')){
                $(this).addClass('blog-featured-pause');    
                $(this).removeClass('blog-featured-play');
                $(this).html('Pause');
                setInterval(slider_loop_func, <?php echo $scroll_speed; ?>);
            }
            else if($(this).hasClass('blog-featured-pause')){
                $(this).addClass('blog-featured-play');    
                $(this).removeClass('blog-featured-pause');
                $(this).html('Play');
                clearInterval(slider_loop);
            }           
            return false;
        });

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
	    /*padding: 0 15px;*/
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
		width:100%;
		margin: 20px auto 10px;
        padding-left:15px;
	}

	#challenge-blog-landing-container #challenge-blog-landing{
        display: inline-block;
        width: calc(100% - 290px);
        padding: 0 10px;
    }
    #challenge-blog-landing-container #sidebar{
        display: inline-block;
        width: 280px;
        vertical-align: top;
        padding: 0 15px;
    }
    #challenge-blog-landing-container #sidebar #searchform #s{
    	width: 100%;
    }
    #challenge-blog-landing-container #sidebar > ul{
    	padding: 0 15px;
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
    #challenge-blog-landing-container #sidebar h1{
    	font-size: 18px
    }
    #challenge-blog-landing-container #sidebar > ul > li{
    	list-style-type: none;
    }
    #challenge-blog-landing-container .entry-image{
        display: inline-block;
        width: 210px;
        margin: 10px 15px 10px 0px;
        vertical-align: top;
    }
    #challenge-blog-landing-container .entry-image img{
        max-width: 100%;
    }
    #challenge-blog-landing-container .entry-content{
        margin: 10px 0px;
        display: inline-block;
        width: calc(100% - 230px);
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
	}

    #challenge-blog-featured-wrapper{
        width:100%;
        margin: 0 auto;
        padding: 15px 0px;
    }

    #challenge-blog-featured-container{
        width:100%;
        background: #fff;
        padding: 15px;
        -webkit-box-shadow: 3px 3px 10px 1px #aaa;
        -moz-box-shadow: 3px 3px 10px 1px #aaa;
        box-shadow: 3px 3px 10px 1px #aaa;
    }

    #challenge-blog-featured-inner{
        background: #5A5A5A;
        min-height: 270px;
        padding: 10px 15px;
        position: relative;
    }
    #challenge-blog-featured-left{
        display: inline-block;
        width: 50%;
        vertical-align: top;
        padding: 0 2%;
    }
    #challenge-blog-featured-left img{
        max-width: 100%;
        max-height: 250px;
    }
    #challenge-blog-featured-right{
        display: inline-block;
        vertical-align: top;
        width: 45%;
        color: #fff;
        font-size: 20px;
    }
    .blog-featured-img{
        max-height: 250px;
        text-align: center;
    }
    .blog-featured-img,
    .blog-featured-text{
        display: none;
        min-height:250px;
    }
    .featured-headline{
        font-size:24px;
        font-weight:bold;
        margin-bottom:10px;
    }
    #challenge-blog-page-wrapper{
        max-width: 1290px;
        margin: 0 auto;
    }
    .blog-featured-controls{
        position:absolute;
        right:10px;
        bottom:5px;
    }
    .blog-featured-controls a{
        text-decoration: none;
        color: #fff;
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
    		height: auto !important;
    	}
        #challenge-blog-featured-left, #challenge-blog-featured-right{
            display: block;
            width: 100%;
        }
        #challenge-blog-featured-left, #challenge-blog-featured-right .featured-headline{
            text-align: center;
        }
        .blog-featured-img{
            min-height: auto;
            margin-bottom:10px;
        }
    }
</style>

<?php

$args = array(
        'post_type' => 'challenge_blog_slide',
        'post_status' => 'publish',
        'posts_per_page' => '-1',
    );

$blog_slides = new WP_Query($args);
if($blog_slides->have_posts()){
    while($blog_slides->have_posts()){
        $blog_slides->the_post();
        $url = wp_get_attachment_url( get_post_thumbnail_id() );
        $url = !empty($url) ? $url : get_template_directory_uri().'/images/default-image.gif';

        $blog_slides_arr[]=array(
            'title' => get_the_title(),
            'content' => get_the_content(),
            'img' => $url,
        );
    }
}
?>

<div id="challenge-blog-page-wrapper">
    <h2 class="entry-title" style="margin-bottom:0px;">
    <?php //the_title(); 
        echo '<img src="'.get_template_directory_uri().'/images/PrizeWireLogo.png">';
    ?>
    </h2>
<div id="challenge-blog-featured-wrapper">
    <div id="challenge-blog-featured-container">
        <div id="challenge-blog-featured-inner">
            <div id="challenge-blog-featured-left">
                <?php
                    foreach($blog_slides_arr as $key => $blog_slide)
                    {
                        echo '<div class="blog-featured-img" id="blog-featured-left-'.($key+1).'">';
                        echo '<img src="'.$blog_slide['img'].'">';
                        echo '</div>';
                    }
                ?>
            </div>
            <div id="challenge-blog-featured-right">
                <?php 
                    foreach($blog_slides_arr as $key => $blog_slide)
                    {
                        echo '<div class="blog-featured-text" id="blog-featured-right-'.($key+1).'">';
                        echo do_shortcode($blog_slide['content']);
                        echo '</div>';
                    }
                ?>
            </div>
            <div class="blog-featured-controls">
                <a href="#" class="blog-featured-pause">Pause</a>
            </div>
        </div>
    </div>
</div>

<div id="challenge-blog-landing-container">
    <div id="challenge-blog-landing">
<?php
get_template_part( 'loop', 'page' );
//st_after_content();
?>
	</div>
    <?php
    get_sidebar('challenge-blog-landing');
    ?>
</div>
</div>
<?php
get_footer();
?>