<?php
/**
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 **/

function st_one_third( $atts, $content = null ) {
    return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'st_one_third');

function st_one_third_last( $atts, $content = null ) {
    return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'st_one_third_last');

function st_two_thirds( $atts, $content = null ) {
    return '<div class="two_thirds">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_thirds', 'st_two_thirds');

function st_two_thirds_last( $atts, $content = null ) {
    return '<div class="two_thirds last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_thirds_last', 'st_two_thirds_last');

// 1-4 col 

function st_one_half( $atts, $content = null ) {
    return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'st_one_half');


function st_one_half_last( $atts, $content = null ) {
    return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'st_one_half_last');


function st_one_fourth( $atts, $content = null ) {
    return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'st_one_fourth');


function st_one_fourth_last( $atts, $content = null ) {
    return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'st_one_fourth_last');

function st_three_fourths( $atts, $content = null ) {
    return '<div class="three_fourths">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourths', 'st_three_fourths');


function st_three_fourths_last( $atts, $content = null ) {
    return '<div class="three_fourths last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourths_last', 'st_three_fourths_last');


function st_one_fifth( $atts, $content = null ) {
    return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'st_one_fifth');

function st_two_fifth( $atts, $content = null ) {
    return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'st_two_fifth');

function st_three_fifth( $atts, $content = null ) {
    return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'st_three_fifth');

function st_four_fifth( $atts, $content = null ) {
    return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'st_four_fifth');

//

function st_one_fifth_last( $atts, $content = null ) {
    return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'st_one_fifth_last');

function st_two_fifth_last( $atts, $content = null ) {
    return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'st_two_fifth_last');

function st_three_fifth_last( $atts, $content = null ) {
    return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'st_three_fifth_last');

function st_four_fifth_last( $atts, $content = null ) {
    return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'st_four_fifth_last');

// 1-6 col 

// one_sixth
function st_one_sixth( $atts, $content = null ) {
    return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'st_one_sixth');

function st_one_sixth_last( $atts, $content = null ) {
    return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'st_one_sixth_last');

// five_sixth
function st_five_sixth( $atts, $content = null ) {
    return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'st_five_sixth');

function st_five_sixth_last( $atts, $content = null ) {
    return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 'st_five_sixth_last');


// Callouts

function st_callout( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'width' => '',
        'align' => ''
    ), $atts));
    $style;
    if ($width || $align) {
        $style .= 'style="';
        if ($width) $style .= 'width:'.$width.'px;';
        if ($align == 'left' || 'right') $style .= 'float:'.$align.';';
        if ($align == 'center') $style .= 'margin:0px auto;';
        $style .= '"';
    }
    return '<div class="cta" '.$style.'>' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('callout', 'st_callout');



// Buttons
function st_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link' => '',
        'size' => 'medium',
        'color' => '',
        'target' => '_self',
        'caption' => '',
        'align' => 'right'
    ), $atts));
    $button;
    $button .= '<div class="button '.$size.' '. $align.'">';
    $button .= '<a target="'.$target.'" class="button '.$color.'" href="'.$link.'">';
    $button .= $content;
    if ($caption != '') {
        $button .= '<br /><span class="btn_caption">'.$caption.'</span>';
    };
    $button .= '</a></div>';
    return $button;
}
add_shortcode('button', 'st_button');


// Tabs
add_shortcode( 'tabgroup', 'st_tabgroup' );

function st_tabgroup( $atts, $content ){

    $GLOBALS['tab_count'] = 0;
    do_shortcode( $content );

    if( is_array( $GLOBALS['tabs'] ) ){

        foreach( $GLOBALS['tabs'] as $tab ){
            $tabs[] = '<li><a href="#'.$tab['id'].'">'.$tab['title'].'</a></li>';
            $panes[] = '<li id="'.$tab['id'].'Tab">'.$tab['content'].'</li>';
        }
        $return = "\n".'<!-- the tabs --><ul class="tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<!-- tab "panes" --><ul class="tabs-content">'.implode( "\n", $panes ).'</ul>'."\n";
    }
    return $return;

}

add_shortcode( 'tab', 'st_tab' );
function st_tab( $atts, $content ){
    extract(shortcode_atts(array(
        'title' => '%d',
        'id' => '%d'
    ), $atts));

    $x = $GLOBALS['tab_count'];
    $GLOBALS['tabs'][$x] = array(
        'title' => sprintf( $title, $GLOBALS['tab_count'] ),
        'content' =>  do_shortcode($content),
        'id' =>  $id );

    $GLOBALS['tab_count']++;
}


// Toggle
function st_toggle( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'title' => '',
        'style' => 'list'
    ), $atts));
    //output;
    $output .= '<div class="'.$style.'"><p class="trigger"><a href="#">' .$title. '</a></p>';
    $output .= '<div class="toggle_container"><div class="block">';
    $output .= do_shortcode($content);
    $output .= '</div></div></div>';

    return $output;
}
add_shortcode('toggle', 'st_toggle');


/*-----------------------------------------------------------------------------------*/
// Latest Posts
// Example Use: [latest excerpt="true" thumbs="true" width="50" height="50" num="5" cat="8,10,11"]
/*-----------------------------------------------------------------------------------*/


function st_latest($atts, $content = null) {
    extract(shortcode_atts(array(
        "offset" => '',
        "num" => '5',
        "thumbs" => 'false',
        "excerpt" => 'false',
        "length" => '50',
        "morelink" => '',
        "width" => '100',
        "height" => '100',
        "type" => 'post',
        "parent" => '',
        "cat" => '',
        "orderby" => 'date',
        "order" => 'ASC'
    ), $atts));
    global $post;

    $do_not_duplicate[] = $post->ID;
    $args = array(
        'post__not_in' => $do_not_duplicate,
        'cat' => $cat,
        'post_type' => $type,
        'post_parent'	=> $parent,
        'showposts' => $num,
        'orderby' => $orderby,
        'offset' => $offset,
        'order' => $order
    );
    // query
    $myposts = new WP_Query($args);

    // container
    $result='<div id="category-'.$cat.'" class="latestposts">';

    while($myposts->have_posts()) : $myposts->the_post();
        // item
        $result.='<div class="latest-item clearfix">';
        // title
        if ($excerpt == 'true') {
            $result.='<h4><a href="'.get_permalink().'">'.the_title("","",false).'</a></h4>';
        } else {
            $result.='<div class="latest-title"><a href="'.get_permalink().'">'.the_title("","",false).'</a></div>';
        }


        // thumbnail
        if (has_post_thumbnail() && $thumbs == 'true') {
            $result.= '<img alt="'.get_the_title().'" class="alignleft latest-img" src="'.get_bloginfo('template_directory').'/thumb.php?src='.get_image_path().'&amp;h='.$height.'&amp;w='.$width.'"/>';
        }

        // excerpt
        if ($excerpt == 'true') {
            // allowed tags in excerpts
            $allowed_tags = '<a>,<i>,<em>,<b>,<strong>,<ul>,<ol>,<li>,<blockquote>,<img>,<span>,<p>';
            // filter the content
            $text = preg_replace('/\[.*\]/', '', strip_tags(get_the_excerpt(), $allowed_tags));
            // remove the more-link
            $pattern = '/(<a.*?class="more-link"[^>]*>)(.*?)(<\/a>)/';
            // display the new excerpt
            $content = preg_replace($pattern,"", $text);
            $result.= '<div class="latest-excerpt">'.st_limit_words($content,$length).'</div>';
        }

        // excerpt
        if ($morelink) {
            $result.= '<a class="more-link" href="'.get_permalink().'">'.$morelink.'</a>';
        }

        // item close
        $result.='</div>';

    endwhile;
    wp_reset_postdata();

    // container close
    $result.='</div>';
    return $result;
}
add_shortcode("latest", "st_latest");

// Example Use: [latest excerpt="true" thumbs="true" width="50" height="50" num="5" cat="8,10,11"]

/*-----------------------------------------------------------------------------------*/
// Creates an additional hook to limit the excerpt
/*-----------------------------------------------------------------------------------*/

function st_limit_words($string, $word_limit) {
    // creates an array of words from $string (this will be our excerpt)
    // explode divides the excerpt up by using a space character
    $words = explode(' ', $string);
    // this next bit chops the $words array and sticks it back together
    // starting at the first word '0' and ending at the $word_limit
    // the $word_limit which is passed in the function will be the number
    // of words we want to use
    // implode glues the chopped up array back together using a space character
    return implode(' ', array_slice($words, 0, $word_limit));
}


// Related Posts - [related_posts]
add_shortcode('related_posts', 'skeleton_related_posts');
function skeleton_related_posts( $atts ) {
    extract(shortcode_atts(array(
        'limit' => '5',
    ), $atts));

    global $wpdb, $post, $table_prefix;

    if ($post->ID) {
        $retval = '<div class="st_relatedposts">';
        $retval .= '<h4>Related Posts</h4>';
        $retval .= '<ul>';
        // Get tags
        $tags = wp_get_post_tags($post->ID);
        $tagsarray = array();
        foreach ($tags as $tag) {
            $tagsarray[] = $tag->term_id;
        }
        $tagslist = implode(',', $tagsarray);

        // Do the query
        $q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
 			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";

        $related = $wpdb->get_results($q);
        if ( $related ) {
            foreach($related as $r) {
                $retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
            }
        } else {
            $retval .= '
	<li>No related posts found</li>';
        }
        $retval .= '</ul>';
        $retval .= '</div>';
        return $retval;
    }
    return;
}

// Break
function st_break( $atts, $content = null ) {
    return '<div class="clear"></div>';
}
add_shortcode('clear', 'st_break');


// Line Break
function st_linebreak( $atts, $content = null ) {
    return '<hr /><div class="clear"></div>';
}
add_shortcode('clearline', 'st_linebreak');

/*
function challenge_post_form_func( $atts, $content = null ) {

		$form_description = acf_form(array(
			'field_groups' => array('description'), // the ID of the field group
			'form' => true
		));
	$return_form = '<div id="postbox">
		<form id="new_post" name="new_post" method="post" action="'.get_bloginfo('template_directory').'/challenge-post-process.php">
		
			<p><label for="title">Title</label><br />
			<input type="text" id="title" value="" tabindex="1" size="20" name="title" /></p>
			
			<p><label for="description">Description</label><br />
			<textarea id="description" tabindex="3" name="description" cols="50" rows="6"></textarea>
			</p>
			
			<p>'.wp_dropdown_categories( 'show_option_none=Select Agency / Organization&tab_index=4&taxonomy=agency&echo=0' ).'</p>
			
			<p><label for="post_tags">Tags</label>
			<input type="text" value="" tabindex="5" size="16" name="post_tags" id="post_tags" /></p>
			
			<p>'.$form_description.'</p>

			<p><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p>
			
			<input type="hidden" name="post_type" id="post_type" value="challenge" />
			<input type="hidden" name="action" value="post" />'.wp_nonce_field( 'new-challenge-post' ).'
		
		</form>
	</div>';

	return $return_form;
}
*/

function challenge_strip_page($strip_from)
{
    return preg_replace('/\/page\/\d+/i','',$strip_from);
}

function challenge_post_form_func( $atts, $content = null )
{
    global $post;

    $return_form = "";
    $select_embed = "";
    $session_codes = get_max_agency_codes();
    if(!empty($session_codes) && !empty($session_codes['OMBAgencyCode']) && !empty($session_codes['OMBBureauCode']))
    {
        $select_id = max_agency_match_codes($session_codes,'category-id');
        $select_embed = "&selected=".$select_id;
    }
    $args = array(
        //'field_groups' => array('description','tag-line'), // this will find the field groups for this post (post ID's of the acf post objects)
        'form' => true, // set this to false to prevent the <form> tag from being created
        'form_attributes' => array( // attributes will be added to the form element
            'id' => 'create-challenge',
            'class' => '',
            //'action' => PARENT_URL .'/challenge-post-process.php',
            'action' => '',
            'method' => 'post',
        ),
        'post_id' => 'new-challenge',
        'post_type' => 'challenge',
        'field_groups' => array(23),
        'return' => add_query_arg( 'new-challenge', 'true', site_url('','http') ), // return url
        'html_before_fields' => '<p><span class="challenge-create-section-header">Organization / Agency</span><br/>'.wp_dropdown_categories( 'show_option_none=Select Agency / Organization&tab_index=4&taxonomy=agency&hide_empty=0&orderby=NAME&order=ASC'.$select_embed.'&echo=0' ).'</p>', // html inside form before fields
        //'html_before_fields' => '',
        'html_after_fields' => '<label for="challenge-publish_state">Published Status: </label>&nbsp;&nbsp;&nbsp;<select name="challenge-publish_state" class="select"><option value="draft"'.(($post->post_status == 'draft' || $post->post_name == 'create-new-challenge') ? ' selected' : '').'>Draft</option><option value="publish"'.(($post->post_status == 'publish' && $post->post_name != 'create-new-challenge') ? ' selected' : '').'>Publish</option></select>
			    <small><br/>Select your save option:</small><br/><br/>', // html inside form after fields
        'submit_value' => 'Create Challenge', // value for submit field
        'updated_message' => 'Your Challenge has been created.  Redirection in ...', // default updated message. Can be false t
    );
    //$return_form .= '<form method="post" action="'.PARENT_URL .'/challenge-post-process.php" name="challenge-create-form">';
    if(current_user_can('publish_posts'))
        $return_form .= acf_form( $args );
    else
        $return_form .= "You do not have access to create a new Challenge.";
    //$return_form .= '<p><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p></form>';
    return $return_form;
}
add_shortcode('challenge-post-form','challenge_post_form_func');

function challenge_edit_post_form_func( $atts, $content = null )
{
    $return_form = "";
    $select_embed = "";
    $session_codes = get_max_agency_codes();
    if(!empty($session_codes) && $session_codes != 0)
    {
        $select_id = max_agency_match_codes($session_codes,'category-id');
        $select_embed = "&selected=".$select_id;
    }
    $args = array(
        //'field_groups' => array('description','tag-line'), // this will find the field groups for this post (post ID's of the acf post objects)
        'form' => true, // set this to false to prevent the <form> tag from being created
        'form_attributes' => array( // attributes will be added to the form element
            'id' => 'update-challenge',
            'class' => '',
            'action' => '',
            'method' => 'post',
        ),
        'post_id' => 'update-challenge',
        'post_type' => 'challenge',
        'field_groups' => array(23),
        'return' => add_query_arg( 'editchallenge', 'true', get_permalink() ), // return url
        'html_before_fields' => '',
        'html_after_fields' => '', // html inside form after fields
        'submit_value' => 'Create Challenge', // value for submit field
        'updated_message' => '<span class="green">Your Challenge has been updated. </span>', // default updated message. Can be false t
    );
    //$return_form .= '<form method="post" action="'.PARENT_URL .'/challenge-post-process.php" name="challenge-create-form">';
    if(current_user_can('publish_posts'))
        $return_form .= acf_form( $args );
    else
        $return_form .= "You do not have access to edit this Challenge.";
    //$return_form .= '<p><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p></form>';
    return $return_form;
}
add_shortcode('challenge-edit-post-form','challenge_edit_post_form_func');

function challenge_display_posts_shortcode( $atts ) {
    global $wp_query;

    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
        $secure_connection = 's';
    }
    else
        $secure_connection = '';

    $default_img_url = "http".$secure_connection."://challenge.sites.usa.gov/files/2013/12/default-image.gif";
    // Original Attributes, for filters
    $original_atts = $atts;

    // Pull in shortcode attributes and set defaults
    $atts = shortcode_atts( array(
        'author'              => '',
        'category'            => '',
        'container_class'     => '',
        'date_format'         => '(n/j/Y)',
        'id'                  => false,
        'ignore_sticky_posts' => false,
        'image_size'          => false,
        'include_content'     => false,
        'include_date'        => false,
        'include_excerpt'     => false,
        'item_class'		  => '',
        'meta_key'            => '',
        'no_posts_message'    => '',
        'offset'              => 0,
        'order'               => 'DESC',
        'orderby'             => 'date',
        'post_parent'         => false,
        'post_status'         => 'publish',
        'post_type'           => 'post',
        'posts_per_page'      => '10',
        'tag'                 => '',
        'tax_operator'        => 'IN',
        'tax_term'            => false,
        'taxonomy'            => false,
        'top'				  => '',
        'wrapper'             => 'ul',
    ), $atts );

    $author = sanitize_text_field( $atts['author'] );
    $category = sanitize_text_field( $atts['category'] );
    $container_class = sanitize_text_field( $atts['container_class'] );
    $container_class = !empty($container_class) ? trim($container_class) : '';
    $date_format = sanitize_text_field( $atts['date_format'] );
    $id = $atts['id']; // Sanitized later as an array of integers
    $ignore_sticky_posts = (bool) $atts['ignore_sticky_posts'];
    $image_size = sanitize_key( $atts['image_size'] );
    $include_content = (bool)$atts['include_content'];
    $include_date = (bool)$atts['include_date'];
    $include_excerpt = (bool)$atts['include_excerpt'];
    $item_class = sanitize_text_field( $atts['item_class'] );
    $item_class = !empty($item_class) ? trim($item_class) : '';
    $meta_key = sanitize_text_field( $atts['meta_key'] );
    $no_posts_message = sanitize_text_field( $atts['no_posts_message'] );
    $offset = intval( $atts['offset'] );
    $order = sanitize_key( $atts['order'] );
    $orderby = sanitize_key( $atts['orderby'] );
    $paged = !empty($wp_query->query_vars["paged"]) ? $wp_query->query_vars["paged"] : 1;
    $post_parent = $atts['post_parent']; // Validated later, after check for 'current'
    $post_status = $atts['post_status']; // Validated later as one of a few values
    $post_type = sanitize_text_field( $atts['post_type'] );
    $posts_per_page = intval( $atts['posts_per_page'] );
    $tag = sanitize_text_field( $atts['tag'] );
    $tax_operator = $atts['tax_operator']; // Validated later as one of a few values
    $tax_term = sanitize_text_field( $atts['tax_term'] );
    $taxonomy = sanitize_key( $atts['taxonomy'] );
    $top_in = sanitize_text_field( $atts['top'] );
    $wrapper = sanitize_text_field( $atts['wrapper'] );
    $pagination = "";
    $sort_array = array();
    $today = time();
    $sort_var = $_GET['sort'];
    $filter_type = $_GET['type'];
    $filter_agency = $_GET['ag'];
    $filter_prize = $_GET['prize'];
    $direction_var = !empty($_GET['direction']) ? $_GET['direction'] : $order;

    switch($sort_var)
    {
        case 'ending-soon':
            $meta_key = 'submission_end';
            $orderby = 'meta_value_num';

            $sort_array[] = array(
                'key' => $meta_key,
                'compare' => '>=',
                'value' => $today,
            );
            $direction_var = 'asc';
            break;
        case 'ending-date-desc':
            $meta_key = 'submission_end';
            $orderby = 'meta_value_num';
            $sort_array[] = array(
                'key' => $meta_key,
            );
            $direction_var = 'desc';
            break;
        case 'ending-date-asc':
            $meta_key = 'submission_end';
            $orderby = 'meta_value_num';
            $sort_array[] = array(
                'key' => $meta_key,
            );
            $direction_var = 'asc';
            break;
        case 'ending-latest':
            $meta_key = 'submission_end';
            $orderby = 'meta_value_num';
            $sort_array[] = array(
                'key' => $meta_key,
                'compare' => '>=',
                'value' => $today,
            );
            $direction_var = 'desc';
            break;
        case 'prize-desc':
            $meta_key = 'cash_prize_total';
            $orderby = 'meta_value_num';
            $sort_array[] = array(
                'key' => $meta_key,
            );
            $direction_var = 'desc';
            break;
        case 'prize-asc':
            $meta_key = 'cash_prize_total';
            $orderby = 'meta_value_num';
            $sort_array[] = array(
                'key' => $meta_key,
            );
            $direction_var = 'asc';
            break;
        default:
            $orderby = 'date';
            break;
    }

    $thistquery = '';
    $agency_here = '';
    if(!empty($filter_agency))
    {
        $agency_here = get_term_by('name', $filter_agency, 'agency');
        $thistquery = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'agency',
                'field'    => 'term_id',
                'terms'    => array( $agency_here->term_id ),
            ),
        );
    }

    if(!empty($filter_type))
    {
        $tag = $filter_type;
    }

    if(!empty($filter_prize))
    {
        $sort_array[] = array('relation' => 'AND');

        switch($filter_prize)
        {
            case 'cp':
                $start_prize = 1;
                break;
            case 'ncp':
                $end_prize = 0;
                break;
            case '10000':
                $start_prize = 1;
                $end_prize = 9999;
                break;
            case '25000':
                $start_prize = 10000;
                $end_prize = 24999;
                break;
            case '50000':
                $start_prize = 25000;
                $end_prize = 49999;
                break;
            case '100000':
                $start_prize = 50000;
                $end_prize = 99999;
                break;
            case '1000000':
                $start_prize = 100000;
                $end_prize = 999999;
                break;
            case '1000001':
                $start_prize = 1000000;
                break;
        }
        $orderby = 'meta_value_num';
        if($filter_prize != 'ncp')
        {
            $sort_array[] = array(
                'key' => 'cash_prize_total',
                'compare' => '>=',
                'type' => 'NUMERIC',
                'value' => $start_prize,
            );
        }

        if(!in_array($filter_prize,array('1000001','cp')))
        {
            $sort_array[] = array(
                'key' => 'cash_prize_total',
                'compare' => '<=',
                'type' => 'NUMERIC',
                'value' => $end_prize,
            );
        }
    }
    //var_dump($sort_array);
    $args = array(
        'tax_query'			  => $thistquery,
        'category_name'       => $category,
        'order'               => $direction_var,
        'orderby'             => $orderby,
        'meta_key'			  => $meta_key,
        'paged'				  => $paged,
        'post_type'           => explode( ',', $post_type ),
        'posts_per_page'      => $posts_per_page,
        'tag'                 => $tag,
        'meta_query'		  => $sort_array,

    );


    // Ignore Sticky Posts
    if( $ignore_sticky_posts )
        $args['ignore_sticky_posts'] = true;

    // Meta key (for ordering)
    if( !empty( $meta_key ) )
        $args['meta_key'] = $meta_key;

    // If Post IDs
    if( $id ) {
        $posts_in = array_map( 'intval', explode( ',', $id ) );
        $args['post__in'] = $posts_in;
    }

    // Post Author
    if( !empty( $author ) )
    {
        if(strtolower($author) == 'the_current_user')
        {
            $current_user = wp_get_current_user();
            $author = $current_user->user_login;
        }
        $args['author_name'] = $author;
    }

    // Offset
    if( !empty( $offset ) )
        $args['offset'] = $offset;

    // Post Status
    $post_status = explode( ', ', $post_status );
    $validated = array();
    $available = array( 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash', 'any' );
    foreach ( $post_status as $unvalidated )
        if ( in_array( $unvalidated, $available ) )
            $validated[] = $unvalidated;
    if( !empty( $validated ) )
        $args['post_status'] = $validated;


    // If taxonomy attributes, create a taxonomy query
    if ( !empty( $taxonomy ) && !empty( $tax_term ) ) {

        // Term string to array
        $tax_term = explode( ', ', $tax_term );

        // Validate operator
        if( !in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) )
            $tax_operator = 'IN';

        $tax_args = array(
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'    => $tax_term,
                    'operator' => $tax_operator
                )
            )
        );

        // Check for multiple taxonomy queries
        $count = 2;
        $more_tax_queries = false;
        while(
            isset( $original_atts['taxonomy_' . $count] ) && !empty( $original_atts['taxonomy_' . $count] ) &&
            isset( $original_atts['tax_' . $count . '_term'] ) && !empty( $original_atts['tax_' . $count . '_term'] )
        ):

            // Sanitize values
            $more_tax_queries = true;
            $taxonomy = sanitize_key( $original_atts['taxonomy_' . $count] );
            $terms = explode( ', ', sanitize_text_field( $original_atts['tax_' . $count . '_term'] ) );
            $tax_operator = isset( $original_atts['tax_' . $count . '_operator'] ) ? $original_atts['tax_' . $count . '_operator'] : 'IN';
            $tax_operator = in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ? $tax_operator : 'IN';

            $tax_args['tax_query'][] = array(
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => $terms,
                'operator' => $tax_operator
            );

            $count++;

        endwhile;

        if( $more_tax_queries ):
            $tax_relation = 'AND';
            if( isset( $original_atts['tax_relation'] ) && in_array( $original_atts['tax_relation'], array( 'AND', 'OR' ) ) )
                $tax_relation = $original_atts['tax_relation'];
            $args['tax_query']['relation'] = $tax_relation;
        endif;

        $args = array_merge( $args, $tax_args );
    }

    // If post parent attribute, set up parent
    if( $post_parent ) {
        if( 'current' == $post_parent ) {
            global $post;
            $post_parent = $post->ID;
        }
        $args['post_parent'] = intval( $post_parent );
    }

    // Set up html elements used to wrap the posts.
    // Default is ul/li, but can also be ol/li and div/div
    $wrapper_options = array( 'ul', 'ol', 'div' );
    if( ! in_array( $wrapper, $wrapper_options ) )
        $wrapper = 'ul';
    $inner_wrapper = 'div' == $wrapper ? 'div' : 'li';


    $listing = new WP_Query( apply_filters( 'display_posts_shortcode_args', $args, $original_atts ) );
    //var_dump($listing);
    $top = '<div class="challenge-top-extras">';
    /*<div class="challenge-top-search">'.get_search_form(false).'</div>*/

    $top .=	'<div class="challenge-top-sort">';
    $top .= '<div class="challenge-sort-container"><label for="search-sort">Sort by:</label>
	<div class="challenge-sort-form">';

    $top .= '<span class="sort-selector">';
    $top .= 		'<select id="agency-sort" name="sort-agency" class="challenge-filter" onchange="window.location.href=this.options[this.selectedIndex].value">
						<option value="'.challenge_strip_page(remove_query_arg( 'sort' )).'">Newest Challenge</option>';
    $top .= '<option '.challenge_sort_is('sort','ending-date-desc').' value="'.challenge_strip_page(add_query_arg( 'sort', 'ending-date-desc' )).'">Submission Date - Latest</option>';
    $top .= '<option '.challenge_sort_is('sort','ending-date-asc').' value="'.challenge_strip_page(add_query_arg( 'sort', 'ending-date-asc' )).'">Submission Date - Oldest</option>';
    $top .= '<option '.challenge_sort_is('sort','ending-soon').' value="'.challenge_strip_page(add_query_arg( 'sort', 'ending-soon' )).'">Open - Ending Soonest</option>';
    $top .= '<option '.challenge_sort_is('sort','ending-latest').' value="'.challenge_strip_page(add_query_arg( 'sort', 'ending-latest' )).'">Open - Ending Latest</option>';
    $top .= '<option '.challenge_sort_is('sort','prize-desc').' value="'.challenge_strip_page(add_query_arg( 'sort', 'prize-desc' )).'">Prize - High to Low</option>';
    $top .= '<option '.challenge_sort_is('sort','prize-asc').' value="'.challenge_strip_page(add_query_arg( 'sort', 'prize-asc' )).'">Prize - Low to High</option>';
    $top .= 		'</select>';
    $top .= '</span></div></div>';

    $top .= '<div class="challenge-filter-container"><label for="search-filter">Filter by:</label>';
    $top .= '<div class="challenge-filter-form">';
    $field = get_field_object('field_5293da669ef07'); //get category acf field to show choices
    //var_dump($field);

    $select_embed = !empty($filter_agency) ? '&selected='.$agency_here->term_id : '';
    $agency_list = get_terms('agency');
    $top .= '<span class="sort-selector">';
    $top .= 		'<select id="agency-sort" name="sort-agency" class="challenge-filter" onchange="window.location.href=this.options[this.selectedIndex].value">
						<option value="'.challenge_strip_page(remove_query_arg( 'ag' )).'">Any Agency</option>';
    foreach ($agency_list as $this_agency)
    {
        $top .= '<option '.challenge_sort_is('ag',$this_agency->name).' value="'.challenge_strip_page(add_query_arg( 'ag', $this_agency->name )).'">'.$this_agency->name.'</option>';
    }
    $top .= 		'</select>';
    $top .= '</span>';

    //$agency_dropdown = preg_replace("#<select([^>]*)>#", "<select$1 onchange='window.location.href=this.options[this.selectedIndex].value'> value=\"".add_query_arg( 'agency', 'def' )."\">", $agency_dropdown);
    $top .= '<span class="sort-selector">';
    $top .= 		'<select id="challenge-type-sort" name="sort-type" class="challenge-filter" onchange="window.location.href=this.options[this.selectedIndex].value">
						<option value="'.challenge_strip_page(remove_query_arg( 'type' )).'">Any Challenge Type</option>';
    if (isset($field["choices"]))
    {
        foreach ($field["choices"] as $key => $choice) {
            if(!empty($choice))
            {
                $this_link = challenge_strip_page(add_query_arg( 'type', $key ));
                $top .= '<option '.challenge_sort_is('type',$key).' value="'.$this_link.'">'.$choice.'</option>';
            }
        }
    }
    $top .= '</select>';
    $top .= '</span>';

    $top .= '<span class="sort-selector">';
    $top .= 		'<select id="prize-sort" name="sort-prize" class="challenge-filter" onchange="window.location.href=this.options[this.selectedIndex].value">
						<option value="'.challenge_strip_page(remove_query_arg( 'prize' )).'">Any Prize Amount</option>
						<option '.challenge_sort_is('prize','ncp').' value="'.challenge_strip_page(add_query_arg( 'prize', 'ncp' )).'">No Cash Prize</option>
						<option '.challenge_sort_is('prize','cp').' value="'.challenge_strip_page(add_query_arg( 'prize', 'cp' )).'">Only Cash Prizes</option>
				    	<option '.challenge_sort_is('prize','10000').' value="'.challenge_strip_page(add_query_arg( 'prize', '10000' )).'">Under $10,000</option>
						<option '.challenge_sort_is('prize','25000').' value="'.challenge_strip_page(add_query_arg( 'prize', '25000' )).'">$10,000 - 24,999</option>
						<option '.challenge_sort_is('prize','50000').' value="'.challenge_strip_page(add_query_arg( 'prize', '50000' )).'">$25,000 - 49,999</option>
						<option '.challenge_sort_is('prize','100000').' value="'.challenge_strip_page(add_query_arg( 'prize', '100000' )).'">$50,000 - 99,999</option>
						<option '.challenge_sort_is('prize','1000000').' value="'.challenge_strip_page(add_query_arg( 'prize', '1000000' )).'">$100,000 - 999,999</option>
						<option '.challenge_sort_is('prize','1000001').' value="'.challenge_strip_page(add_query_arg( 'prize', '1000001' )).'">One Million or Greater</option>
					</select>';
    $top .= '</span>';
    $top .= '</div></div>';
    $top .= '</div></div>';

    if ( ! $listing->have_posts() )
    {
        echo '<p></p>';
        echo $top;
        echo '<span style="display:block;font-weight:bold;width:100%;margin-top:30px;text-align:center;">No Challenges matched the filter criteria.</span>';
        return apply_filters( 'display_posts_shortcode_no_results', wpautop( $no_posts_message ) );
    }

    $inner = '';
    $total_challenge_found = $listing->found_posts;
    while ( $listing->have_posts() ): $listing->the_post(); global $post;

        $image = $date = $excerpt = $content = '';

        $where_host = get_field('where_host');
        $ext_url = get_field('external_challenge_url');
        $pos = strpos($ext_url, "http://");
        $pos1 = strpos($ext_url, "https://");
        $ext_url = ($pos ===0 || $pos1 === 0)? $ext_url : "http://".$ext_url;

        $link_out = ( !empty($ext_url) && ( empty($where_host) || (!empty($where_host) && $where_host == 'remote') ) ) ? $ext_url : apply_filters( 'the_permalink', get_permalink() );
        //$link_out = apply_filters( 'the_permalink', get_permalink() );

        $title = '<a class="title" href="' . $link_out . '"'.($where_host == "remote" ? " target=\"_blank\"" : "").'>' . apply_filters( 'the_title', get_the_title() ) .'</a>';

        if ( $image_size && has_post_thumbnail() )
            $image = '<a class="image" href="' . $link_out . '" ' .($where_host == "remote" ? " target=\"_blank\"" : "").' >' . get_the_post_thumbnail( $post->ID, $image_size ) . '</a> ';

        if ( $include_date )
            $date = ' <span class="date">' . get_the_date( $date_format ) . '</span>';

        if ( $include_excerpt )
            $excerpt = ' <span class="excerpt-dash">-</span> <span class="excerpt">' . get_the_excerpt() . '</span>';

        if( $include_content )
            $content = '<div class="content">' . apply_filters( 'the_content', get_the_content() ) . '</div>';

        $class = array( 'listing-item', $item_class );
        $class = apply_filters( 'display_posts_shortcode_post_class', $class, $post, $listing );

        $rating = "";
        //if(function_exists('the_ratings')) { $rating = the_ratings('div',0,false); }

        $logo_new = get_field('logo');
        $logo_in = !empty($logo_new) ? $logo_new['url'] : $default_img_url;

        $tagline_new = get_field('tag-line');
        $tagline_text = !empty($tagline_new) ? "<span class=\"front-challenge-tagline\">".$tagline_new."</span>" : "";

        //$pagination = my_posts_nav_link('challenge','Newer',''.$listing->max_num_pages.'');
        //$pagination = my_posts_nav_link('prev','Previous','5') . my_posts_nav_link('next','Newer','5');

        $query_agency_category = wp_get_post_terms($post->ID, 'agency', array("fields" => "all"));
        $separator = ' ';
        $agencies = '';
        //var_dump($categories);
        if($query_agency_category){
            foreach($query_agency_category as $agency) {
                $agencies .= '<a href="'.get_term_link( $agency->name, 'agency' ).'" title="' . esc_attr( sprintf( __( "View all challenges in %s" ), $agency->name ) ) . '">'.$agency->name.'</a>'.$separator;
            }
            //echo trim($agencies, $separator);
        }

        $posted_by = !empty($agencies) ? '<span class="challenge-posted-by">Posted By: '.$agencies.'</span>' : "" ;
$partner_agency = get_field('partner_agency',$post->ID);
                    
                     if(!empty($partner_agency))
                    {
                        $partner_agency_title='';
                        foreach($partner_agency as $key => $this_partner_agency)
			{
			
                        $partner_agency_title.='<a href="'.get_term_link($this_partner_agency['partner_agency']->post_title, 'agency' ).'" title="' . esc_attr( sprintf( __( "View all challenges in %s" ), $this_partner_agency['partner_agency']->post_title ) ) . '">'.
                        ($this_partner_agency['partner_agency']->post_title).'</a>'."<br> ";
			}
                        //$partner_agency_title=substr($partner_agency_title,0,-2);
			
                    }
                   
	$partner_agency_lists = !empty($partner_agency) ? '<br><span class="challenge-posted-by">Partnership With: '.$partner_agency_title.'</span>' : "" ;

        $total_value = get_field('cash_prize_total');
        $the_prizes = get_field('the_prizes');
        $a_cash_prize = false;
        $prize_output = "";
        //var_dump(get_field('cash_prize_total'));
        if(isset($the_prizes) && !empty($the_prizes))
        {
            foreach($the_prizes as $this_prize)
            {
                if($this_prize['is_cash_prize'])
                    $a_cash_prize = true;
            }

            $prize_output = '<span class="summary-item-text">';
            if($a_cash_prize) // there are cash prizes
                $prize_output .="$".number_format((int)$total_value)."</span><br/>In Prizes";
            else
                $prize_output .= "<a href=\"".$link_out."\">View Prize List<br/>On This Challenge</a></span><br/>";
        }
        $edit_link = '';
        if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$post->ID,'category-id') || get_current_user_id() == $post->post_author)))
            $edit_link = '<span class="edit-challenge-link"><a href="'.add_query_arg( 'edit-challenge', 'true', get_permalink() ).'">Edit</a></span>';

        $output = '<div class="front-challenge-item-container">'.$edit_link.'<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">'.'<a ' .($where_host == "remote" ? " target=\"_blank\"" : ""). 'class="challenge-title" href="' . $link_out . '"><img src="'.$logo_in.'" class="front-challenge-img"></a><div class="front-challenge-innertext">' . $image . $title . $posted_by . $partner_agency_lists. $tagline_text . $date . $excerpt . $content . $rating . '</div></' . $inner_wrapper . '>';
        $output .='<div class="front-challenge-summary"><div class="front-challenge-summary-inner">'.$prize_output.'</div><div class="front-challenge-summary-inner">Open Until<br/><span class="summary-item-text">'.verify_challenge_datetime_view(get_field('submission_end')).'</span></div></div></div><div class="clear"></div>';


        // If post is set to private, only show to logged in users
        if( 'private' == get_post_status( $post->ID ) && !current_user_can( 'read_private_posts' ) )
            $output = '';

        $inner .= apply_filters( 'display_posts_shortcode_output', $output, $original_atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class );
        //var_dump($listing->query_vars);
        //die();
        if(($listing->current_post + 1) == ($listing->post_count)) {
            //$pagination = '<div class="nav-next">';
            //s$pagination .= my_posts_nav_link('prev','Previous Challenges',$listing->max_num_pages).'1</div>';
            //$pagination .= '<div class="nav-next">'.my_posts_nav_link('next','Next',0).'3</div>';
            //$pagination .= get_next_posts_link( 'Next Challenges' ,$listing->max_num_pages).'</div>';
            $big = 9999999;
            $pagination_args = array(
                //'base' 		   => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'       => '/page/%#%',
                'total'        => $listing->max_num_pages,
                'current'      => max( 1, $listing->query_vars["paged"]),
                'show_all'     => False,
                'end_size'     => 1,
                'mid_size'     => 2,
                'prev_next'    => True,
                'prev_text'    => __('<span class="challenge-pagination-prev">« Previous Challenges</span>'),
                'next_text'    => __('<span class="challenge-pagination-next">Next Challenges »</span>'),
                'type'         => 'plain',
                'add_args'     => False,
                'add_fragment' => ''
            );
            $pagination = '<div class="challenge-pagination-links">';
            $pagination .= paginate_links( $pagination_args );
            $pagination .= '</div>';
            //die();
            //$pagination .= '<div class="navigation"><p>'.posts_nav_link().'</p></div>';
        }

    endwhile; wp_reset_postdata();

    $open = apply_filters( 'display_posts_shortcode_wrapper_open', '<' . $wrapper . ' class="display-posts-listing '.$container_class.'">', $original_atts );
    $close = apply_filters( 'display_posts_shortcode_wrapper_close', '</' . $wrapper . '>', $original_atts );

    if(empty($top_in) || $top_in != 'show')
        $top = '';
    $return = "<div class='total-challenge-found'>" . $total_challenge_found . " Competition" . ($total_challenge_found> 1 ? 's':'') . " found</div>". $top . $open . $inner . $pagination . $close . "\n";

    wp_register_script( 'list_hover', get_template_directory_uri() . '/javascripts/redirect_list.js'  );
    wp_enqueue_script( 'list_hover' );

    return $return;
}

add_shortcode( 'challenge-display-posts', 'challenge_display_posts_shortcode' );

function challenge_sort_is($type_in, $sort_in)
{
    if(!empty($_GET[$type_in]) && $_GET[$type_in] == $sort_in)
        return 'selected="selected"';
    else
        return;
}

function omb_login_logout_buttons()
{
    $return_code = '<p id="omb-max-link"><a class="button button-primary button-large" href="'.site_url().'/wp-login.php?ombAuth=1&amp;redirect_to='.site_url().'/login">Log In with OMB MAX</a>';
    if(class_exists('OMBMax'))
    {
        if( OMBMax::isAuthenticated() )
        {
            $return_code .= " | ".'<a class="button button-primary button-large" href="' . wp_logout_url() .'&ombAuth=logout">Log out of OMB MAX</a>';
        }
    }
    $return_code .= '</p>';
    return $return_code;
}
add_shortcode('omb-login-logout-buttons','omb_login_logout_buttons');

function display_this_object_comments( $atts )
{
    $count = 0;

    extract(shortcode_atts( array(
        'limit' => '5',
    ), $atts ));

    $post_id = get_the_ID();
    echo '<h1>Latest Discussion</h1>';
    $comments = get_comments('post_id='.$post_id);
    if(count($comments) > 0)
        echo '<ul class="challenge-recent-comments">';
    else
        echo 'No Discusstion Items Currently';
    foreach($comments as $comment) :
        //var_dump($comment);
        if($count < $limit)
        {
            echo '<li class="challenge-recent-comment">';
            echo($comment->comment_author).": ";
            //echo();
            echo '<a href="'.add_query_arg('i',rand(1,9999),get_comment_link( $comment->comment_ID )).'">'.substr($comment->comment_content,0,100).'</a>';
            if(strlen($comment->comment_content) > 100)
                echo "...";
            echo '</li>';
        }
        $count++;
    endforeach;
    if(count($comments) > 0)
        echo "</ul>";
}

add_shortcode('display-this-object-comments','display_this_object_comments');

function check_and_redirect( $atts )
{
    return;
}

add_shortcode('check-and-redirect','check_and_redirect');

function display_this_category_func($atts)
{

    $atts = shortcode_atts( array(
        'category'	=> '',
    ), $atts );

    $taxonomy = sanitize_text_field($atts['category']);

    $terms = wp_list_categories( 'title_li=&style=none&hide_empty=1&echo=0&taxonomy=' . $taxonomy );

    if(!empty($terms))
        return $terms;
}
add_shortcode('display-this-category','display_this_category_func');