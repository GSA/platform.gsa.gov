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
        'post_parent'   => $parent,
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
  /*
  ?>
<script type="text/javascript">
        jQuery(document).ready(function($){
            $('form#create-challenge input[type="submit"]').click(function(){
                alert('Challenge.gov is undergoing scheduled maintenance. Between the hours of 10 p.m. EST tonight and midnight, the Challenge.gov database will be in read-only mode. It will be unable to save new registrations, profile updates, submissions or comments during this time. We apologize for this inconvenience, and encourage you to try back once the maintenance is completed.');
                return false;
            });
        });
    </script>
<?php
*/
    echo '<h2 class="page-title">Create New Challenge</h2>';
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
            'class' => 'page-content inline-form ',
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
    //error_log(print_r($args,1));
    //error_log(print_r($return_form,1));
    $return_form = str_replace('type="submit"', 'type="submit" disabled', $return_form );
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

    //$default_img_url = "http".$secure_connection."://www.challenge.gov/files/2013/12/default-image.gif";
    //if(strpos(get_site_url('http'), "http://localhost/") !== false || strpos(get_site_url('http'), "http://sites.usa.local") !== false || strpos(get_site_url(), "https://staging.platform") !== false) //override if local dev
        $default_img_url = get_template_directory_uri().'/images/default-image.gif';
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
        'item_class'          => '',
        'meta_key'            => '',
        'no_posts_message'    => '',
        'offset'              => 0,
        'order'               => 'DESC',
        'orderby'             => 'date',
        'post_parent'         => false,
        'post_status'         => 'publish',
        'post_type'           => 'post',
        'posts_per_page'      => '15',
        'tag'                 => '',
        'tax_operator'        => 'IN',
        'tax_term'            => false,
        'taxonomy'            => false,
        'top'                 => '',
        'wrapper'             => 'ul',
        'return_found'        => false,
        
    ), $atts );
  
    $loadthrough=$_POST['loadthrough'];
    $which_page=$original_atts['which_page'];
    $followerid=$original_atts['followerid'];
    if($loadthrough=="ajaxcall")
    {
        $page=$_POST['page'];
    }
    else{
        $page=$wp_query->query_vars["paged"];
        if(empty($page))
        {
            $page=1;
        }
    }
    $return_found = sanitize_key( $atts['return_found'] );  
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
    $paged = $return_found ? 1 : $page;
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
    $sort_var = $_POST['sort'];
    $filter_type = $_POST['type'];
    
    if(isset($filter_type))
    {
        $filter_type_array=@explode("||",$filter_type);
    }
     
    $filter_agency = $_POST['ag'];
    $filter_prize = $_POST['price'];
    $direction_var = !empty($_REQUEST['direction']) ? $_REQUEST['direction'] : $order;

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

    $tag=$filter_type_array;
    
    if(isset($filter_prize))
    {
        $sort_array[] = array('relation' => 'AND');
        $price_range=explode(";",$filter_prize);
        $start_prize=$price_range[0];
        $end_prize=$price_range[1];
        //if($sort_var == 'prize-asc' || $sort_var == 'prize-desc')
            //$orderby = 'meta_value_num';
     // if($start_prize != 0)
        //{
            $sort_array[] = array(
                'key' => 'cash_prize_total',
                'compare' => '>=',
                'type' => 'NUMERIC',
                'value' => $start_prize,
            );
      // }

        //if(!in_array($filter_prize,array('1000001','cp')))
        //{
        // if($end_prize != 0)
        //{
            $sort_array[] = array(
                'key' => 'cash_prize_total',
                'compare' => '<=',
                'type' => 'NUMERIC',
                'value' => $end_prize,
            );
      //  }
    }
            

  
    $args = array(
        'tax_query'           => $thistquery,
        'category_name'       => $category,
        'order'               => $direction_var,
        'orderby'             => $orderby,
        'meta_key'            => $meta_key,
        'paged'               => $paged,
        'post_type'           => explode( ',', $post_type ),
        'posts_per_page'      => $posts_per_page,
        //'tag'                 => $tag,
        'tag_slug__in'                 => $tag,
        'meta_query'          => $sort_array,

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
    
     if($return_found)
    {
        return !empty($listing->found_posts) ? $listing->found_posts : 0;
    }
    if ( ! $listing->have_posts() )
    {
       
        echo '<span style="display:block;font-weight:bold;width:100%;margin-top:30px;text-align:center;">No Challenges matched the filter criteria.</span>';
        return apply_filters( 'display_posts_shortcode_no_results', wpautop( $no_posts_message ) );
    }

    $inner = '';
    $total_challenge_found = $listing->found_posts;

    
    $top="<div class='number-competitions'>".$total_challenge_found." Competitions Found</div>";
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
        $logo_in = !empty($logo_new) ? str_replace('http:','',$logo_new['url']) : $default_img_url;

        $tagline_new = get_field('tag-line');
        $tagline_text = !empty($tagline_new) ? "<span class=\"front-challenge-tagline\">".$tagline_new."</span>" : "";

        $query_agency_category = wp_get_post_terms($post->ID, 'agency', array("fields" => "all"));
       
        $separator = ' ';
        $agencies = '';
       
        if($query_agency_category){
            foreach($query_agency_category as $agency) {
                
                $agencies .= '<a href="'.get_term_link( $agency->name, 'agency' ).'" title="' . esc_attr( sprintf( __( "View all challenges in %s" ), $agency->name ) ) . '">'.$agency->name.'</a>'.$separator;
            }
           
            //echo trim($agencies, $separator);
        }

        //$posted_by = !empty($agencies) ? '<span class="challenge-posted-by">Posted By: '.$agencies.'</span>' : "" ;
        $posted_by = !empty($agencies) ? $agencies : "" ;


        $total_value = get_field('cash_prize_total');
        $the_prizes = get_field('the_prizes');
        $a_cash_prize = false;
        $prize_output = "";
       
        if(isset($the_prizes) && !empty($the_prizes))
        {
            foreach($the_prizes as $this_prize)
            {
                if($this_prize['is_cash_prize'])
                    $a_cash_prize = true;
            }

            if($a_cash_prize) // there are cash prizes
                //commented for now
                   //$prize_output .="$".number_format((int)$total_value)."</span><br/>In Prizes";
                $prize_output .="<a href=\"".$link_out."\"".(!empty($where_host) && $where_host == 'remote' ? ' target="_blank"' : '').">$".number_format((int)$total_value)." in prizes</a>";
            else
                $prize_output .= "<a href=\"".$link_out."\"".(!empty($where_host) && $where_host == 'remote' ? ' target="_blank"' : '').">View Prize List On This Challenge</a><br/>";
        }
        $edit_link = '';
        //if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$post->ID,'category-id') || get_current_user_id() == $post->post_author)))
        if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency')))
            $edit_link = '<span class="edit-challenge-link"><a href="'.add_query_arg( 'edit-challenge', 'true', get_permalink() ).'">Edit</a></span>';
            
            //start challenge_gov_theme
            $output =  '<div class="column col-lg-4 col-md-6 col-sm-12 col-xs-12">';
            $output .=      '<h4>'.$title.'</h4>' ;
            $output .=       '<div class="challenge-thumbnail">'.$edit_link;
            $partner_agency = get_field('partner_agency',$post->ID);
                    
                     if(!empty($partner_agency))
                    {
                        $partner_agency_title='';
                        foreach($partner_agency as $key => $this_partner_agency)
            			{
							$partner_agency_post_title = !empty($this_partner_agency['partner_agency']->post_title) ? $this_partner_agency['partner_agency']->post_title : '';
		                    $partner_agency_term_link = get_term_link($partner_agency_post_title, 'agency' );
                		    if(is_wp_error($partner_agency_term_link))
        		                $partner_agency_term_link = '#';
		                    $partner_agency_title.='<a href="'.$partner_agency_term_link.'" title="' . esc_attr( sprintf( __( "View all challenges in %s" ), $partner_agency_post_title ) ) . '">'.($this_partner_agency['partner_agency']->post_title).'</a>'."<br> ";
            			}
                    }
                   
    $partner_agency_lists = !empty($partner_agency) ? '<br><span class="challenge-posted-by">Partnership With</span><div class="partnertitle">'.$partner_agency_title.'</div>' : "" ;
        $subclosedate=get_field('submission_end');
       
       
        $diffindate= ($subclosedate < time() ? "Closed On" : "Open Until");
   
            if(!empty($partner_agency))
                    {
            $output .= '<div class="partner-icon" id='.$post->ID.'><i class="fa fa-retweet"></i></div>';
                    }
                    $output .= $edit_link;
            $output .=           '<img src="'.$logo_in.'" class="front-challenge-img">';
            $output .=          '<div class="caption">';
            $output .=                 '<div class="prize">'.$prize_output.'</div>';
            $output .=                     '<p>'.$tagline_text.'</p>';
            $output .=                     '<h5 class="challengeDateOpen">';
           if($diffindate=="Closed On")
           {
                 $output .=  '<span class="closedchallenge">'.$diffindate.'</span>';
           }
           else{
                $output .=    '<span class="openchallenge">'.$diffindate.'</span>';
           }
           
            $output .=                     '<span>'.verify_challenge_datetime_view(get_field('submission_end')).'</span>';
            $output .=                     '</h5>';
            $output .=           '</div>';
            $output .=           '<div class="posted-by">';
            $output .=              '<div class="text-muted">Posted by:</div>';
            $output .=                  '<div class="agency-name" id="'.$post->ID.'">'.$posted_by .'</div>';
        
        if($which_page=="profile")
        {
            if(is_user_logged_in() && (get_current_user_id() == $followerid))
            {
            $output .="<div class='selection-check-challenge'><input type='button' customid='".get_current_user_id()."||".$post->ID."' name='stopfollowing' id='deletefollowers_chk' class='btn btn-default' value='Stop Following Challenge'>
            </div>";
            }
          
       
        }
    
            $output .='</div>';
            
             $agencypostid=get_page_by_title($agency->name,'','agency');
            $challenge_count = do_shortcode('[challenge-display-posts return_found="true" post_type="challenge" taxonomy="agency" tax_term="'.$agency->name.'"]');
           $comment_count = (array)wp_count_comments( $agencypostid->ID );
           if(get_field('agency_info',$agencypostid->ID)=="")
           {
                $agencyinfo="No description found for this agency";
           }
           else{
            $agencyinfo=strip_tags(get_field('agency_info',$agencypostid->ID));
           }
            $output .=  '<div id="agencyInfo_'.$post->ID.'"  class="agencyInfo">
                        <div class="col-md-12 col-lg-12">
                            <div class="agency-info-title">information</div>
                            <p>'.$agencyinfo.'</p>
                        <div class="row">
                         <div class="left-btn col-md-6 col-lg-6">
                             <div>Discussions</div>
                             <div class="badge"><a href=""></a>'.$comment_count["approved"].'</div>
                         </div>
                         <div class="right-btn col-md-6 col-lg-6">
                              <div>Challenges</div>
                             <div class="badge">'.$challenge_count.'</div>
                         </div>
                        </div>';
              
            $output .= '
                    </div></div>
                    <div id="partneragency_'.$post->ID.'" class="PartnerInfo">'.$partner_agency_lists.'</div>';
                    
            $output .= '</div></div>';
            //end challenge_gov_theme

        // If post is set to private, only show to logged in users
        if( 'private' == get_post_status( $post->ID ) && !current_user_can( 'read_private_posts' ) )
            $output = '';

        $inner .= apply_filters( 'display_posts_shortcode_output', $output, $original_atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class );
        //var_dump($listing->query_vars);
        //die();
        if(($listing->current_post + 1) == ($listing->post_count)) {
           
            $big = 9999999;
            $pagination_args = array(
                //'base'           => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'       => '/page/%#%',
                'total'        => $listing->max_num_pages,
                'current'      => max( 1, $listing->query_vars["paged"]),
                'show_all'     => False,
                'end_size'     => 2,
                'mid_size'     => 7,
                'prev_next'    => True,
                'prev_text'    => __('<span class="challenge-pagination-prev">« Pre</span>'),
                'next_text'    => __('<span class="challenge-pagination-next">Next »</span>'),
                'type'         => 'plain',
                'add_args'     => False,
                'add_fragment' => ''
            );
            //commented for now

            $pagination = '<div class="pagination" id="pagination">';
            $pagination .= paginate_links( $pagination_args );
            $pagination .= '</div>';
            
           
        }

    endwhile; wp_reset_postdata();
    
    $return = $top. $open . $inner . $pagination . $close . "\n";

    wp_register_script( 'list_hover', get_template_directory_uri() . '/javascripts/redirect_list.js'  );
    wp_enqueue_script( 'list_hover' );


    if (is_page('list')){

        wp_register_script( 'challengelist-js', get_template_directory_uri() . '/javascripts/challengelist.js'  );
        wp_enqueue_script( 'challengelist-js' );
    }

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
    $comments = get_comments('post_id='.$post_id);
    if(count($comments) > 0)
        echo '<div class="">';
    else
        echo 'No Discussion Items Currently';
    foreach($comments as $comment) :
        //var_dump($comment);
        if($count < $limit)
        {
            echo '<div class="">';
            echo($comment->comment_author).": ";
            echo '<a href="'.add_query_arg('i',rand(1,9999),get_comment_link( $comment->comment_ID )).'">'.substr($comment->comment_content,0,100).'</a>';
            if(strlen($comment->comment_content) > 100)
                echo "...";
            echo '</div>';
        }
        $count++;
    endforeach;
    if(count($comments) > 0)
        echo "</div>";
}

add_shortcode('display-this-object-comments','display_this_object_comments');

function check_and_redirect( $atts )
{
    return;
}

add_shortcode('check-and-redirect','check_and_redirect');

function wp_login_method($atts){
    extract(shortcode_atts(array(
        "page" => ""
    ),$atts
    ));
    return wp_login_form_frontend($args, $page);
}

add_shortcode('wp-login-method', 'wp_login_method');


function display_this_category_func($atts)
{

    $atts = shortcode_atts( array(
        'category'  => '',
    ), $atts );

    $taxonomy = sanitize_text_field($atts['category']);

    $terms = wp_list_categories( 'title_li=&style=none&hide_empty=1&echo=0&taxonomy=' . $taxonomy );

    if(!empty($terms))
        return $terms;
}
add_shortcode('display-this-category','display_this_category_func');

function challenge_api_head($atts)
{
    extract(shortcode_atts(array(
        'url' => ''
    ), $atts));

    ?>
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url') . "/swagger.css"; ?>" type="text/css">
    <link rel="stylesheet" href="https://raw.githubusercontent.com/swagger-api/swagger-ui/master/dist/css/screen.css" type="text/css">
    <link rel="stylesheet" href="https://raw.githubusercontent.com/swagger-api/swagger-ui/master/dist/css/reset.css" type="text/css">
    <link rel="stylesheet" href="https://raw.githubusercontent.com/swagger-api/swagger-ui/master/dist/css/typography.css" type="text/css">

    <script type="text/javascript" src="<?php echo get_bloginfo('template_url') ."/javascripts/swagger.js"; ?>"></script>
    <script type="text/javascript">
    $(function () {
      var url = window.location.search.match(/url=([^&]+)/);
      if (url && url.length > 1) {
        url = decodeURIComponent(url[1]);
      } else {
        url = "<?php echo (!empty($url) ? $url : 'http://api.challenge.gov/swagger_docs/api-docs.json'); ?>";
      }
      window.swaggerUi = new SwaggerUi({
        url: url,
        dom_id: "swagger-ui-container",
        supportedSubmitMethods: ['get', 'post', 'put', 'delete', 'patch'],
        onComplete: function(swaggerApi, swaggerUi){
          if(typeof initOAuth == "function") {
            /*
            initOAuth({
              clientId: "your-client-id",
              realm: "your-realms",
              appName: "your-app-name"
            });
            */
          }
          $('pre code').each(function(i, e) {
            hljs.highlightBlock(e)
          });
        },
        onFailure: function(data) {
          log("Unable to Load SwaggerUI");
        },
        docExpansion: "none",
        sorter : "alpha"
      });

      function addApiKeyAuthorization() {
        var key = encodeURIComponent($('#input_apiKey')[0].value);
        log("key: " + key);
        if(key && key.trim() != "") {
            var apiKeyAuth = new SwaggerClient.ApiKeyAuthorization("api_key", key, "query");
            window.swaggerUi.api.clientAuthorizations.add("api_key", apiKeyAuth);
            log("added key " + key);
        }
      }

      $('#input_apiKey').change(addApiKeyAuthorization);

      // if you have an apiKey you would like to pre-populate on the page for demonstration purposes...
      /*
        var apiKey = "myApiKeyXXXX123456789";
        $('#input_apiKey').val(apiKey);
        addApiKeyAuthorization();
      */

      window.swaggerUi.load();

      function log() {
        if ('console' in window) {
          //console.log.apply(console, arguments);
        }
      }
  });
  </script>
  <?php
    //$output = ob_get_contents();
    //ob_end_clean();
    //return $output;
}
add_shortcode('challenge-api-head', 'challenge_api_head');

function challenge_api_body()
{
    ob_start();
    ?>
<style type="text/css">
    #swagger-ui-container .footer{display:none;}
</style>
<div class="swagger-section">
<div id='header'>
  <div class="swagger-ui-wrap" style="display:none;">
    <a id="logo" href="http://swagger.io">swagger</a>
    <form id='api_selector' style="display:none;">
      <div class='input'><input placeholder="http://example.com/api" id="input_baseUrl" name="baseUrl" type="text"/></div>
      <div class='input'><input placeholder="api_key" id="input_apiKey" name="apiKey" type="text"/></div>
      <div class='input'><a id="explore" href="#">Explore</a></div>
    </form>
  </div>
</div>

<div id="message-bar" class="swagger-ui-wrap">&nbsp;</div>
<div id="swagger-ui-container" class="swagger-ui-wrap"></div>
</div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode('challenge-api-body', 'challenge_api_body');

function return_site_url()
{
    return get_site_url();
}
add_shortcode( 'site_url', 'return_site_url');
function AgencySelectBox()
{
    ob_start();
      $term_args=array('orderby'  => 'name', 
                     'order'    => 'ASC',
                     'hide_empty'=>false);
    
    
    $agency_list=get_terms( 'agency', $term_args );
   // return $agency_list;
 
  ?>
<div class="sr-only" id="agencydropdown">Select Agency</div>     
<select aria-labelledby="agencydropdown" name="agency_selection_box" id="agency_selection_box"<?php echo is_page('all-charts') ? ' class="form-control"' : '';?>>
     <option value="all">All</option>
     <?php
     foreach($agency_list as $agencies)
     {
       
        ?>
    
          <option value="<?php echo $agencies->name?>"><?php echo $agencies->name?></option>
          <?php
     }      
  ?>
  </select>
     <?php
    $output_string=ob_get_contents();
    ob_end_clean();

    return $output_string;
 
    
}
add_shortcode('agency-select-box','AgencySelectBox');



function challenge_return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    switch($last) {
        // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }

    return $val;
} 

function challenge_activate_signup($key) {
    global $wpdb;
    $bloginfo = get_bloginfo( 'name' );
    $wppb_generalSettings = get_option('wppb_general_settings');

    if ( is_multisite() )
        $signup = $wpdb->get_row( $wpdb->prepare("SELECT * FROM $wpdb->signups WHERE activation_key = %s", $key) );
    else
        $signup = $wpdb->get_row( $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."signups WHERE activation_key = %s", $key) );

    if ( empty( $signup ) )
        return $activateUserErrorMessage1 = apply_filters('wppb_register_activate_user_error_message1', '<p class="error">'. __('Invalid activation key!', 'profilebuilder') .'</p>');

    if ( $signup->active )
        if ( empty( $signup->domain ) )
            return $activateUserErrorMessage2 = apply_filters('wppb_register_activate_user_error_message2', '<p class="error">'. __('The user is already active!', 'profilebuilder') .'</p>');

    $meta = unserialize($signup->meta);
    if (isset($wppb_generalSettings['loginWith']) && ($wppb_generalSettings['loginWith'] == 'email'))
        $user_login = $wpdb->escape($signup->user_email);
    else
        $user_login = $wpdb->escape($signup->user_login);
    $user_email = $wpdb->escape($signup->user_email);
    $password = base64_decode($meta['user_pass']);

    /*$user_id = username_exists($user_login);

    if ( ! $user_id )
    {
        $user_id = wppb_create_user($user_login, $password, $user_email);
       
    }
    else
        $user_already_exists = true;

    if ( ! $user_id )
        return $activateUserErrorMessage4 = apply_filters('wppb_register_activate_user_error_message4', '<p class="error">'. __('Could not create user!', 'profilebuilder') .'</p>');
        
    elseif ( isset( $user_already_exists ) )
        return $activateUserErrorMessage5 = apply_filters('wppb_register_activate_user_error_message5', '<p class="error">'. __('That username is already activated!', 'profilebuilder') .'</p>');
    
    else{*/
        $now = current_time('mysql', true);
        
        if ( is_multisite() )
            $retVal = $wpdb->update( $wpdb->signups, array('active' => 1, 'activated' => $now), array('activation_key' => $key) );
        else
            $retVal = $wpdb->update( $wpdb->prefix.'signups', array('active' => 1, 'activated' => $now), array('activation_key' => $key) );

        wppb_add_meta_to_user_on_activation($user_id, '', $meta);
        
        $set_role='public_user';
        add_user_to_blog(get_current_blog_id(), $user_id, $set_role);
        // if admin approval is activated, then block the user untill he gets approved
        $wppb_generalSettings = get_option('wppb_general_settings');
        if($wppb_generalSettings['adminApproval'] == 'yes'){
            wp_set_object_terms( $user_id, array( 'unapproved' ), 'user_status', false);
            clean_object_term_cache( $user_id, 'user_status' );
        }
        
        challenge_notify_user_registration_email($bloginfo, $user_login, $user_email, 'sending', $password, $wppb_generalSettings['adminApproval']);
        
        do_action('wppb_activate_user', $user_id, $password, $meta);
        
        if ($retVal) 
            return $registerFilterArray['successfullUserActivation'] = apply_filters('wppb_register_successfull_user_activation', '<p class="success">'. __('Thanks for joining Challenge.gov! Your account is now active. You may now log in.', 'profilebuilder') .'</p><!-- .success -->');
        else
            return $registerFilterArray['successfullUserActivationFail'] = apply_filters('wppb_register_failed_user_activation', '<p class="error">'. __('There was an error while trying to activate the user.', 'profilebuilder') .'</p><!-- .error -->');
    //}       
}
function challenge_front_end_register($atts){
    define( 'CHALLENGE_SERVER_MAX_UPLOAD_SIZE_MEGA', ini_get( 'upload_max_filesize') );
    define( 'CHALLENGE_SERVER_MAX_UPLOAD_SIZE_BYTE', challenge_return_bytes( ini_get( 'upload_max_filesize') ) );
    define( 'CHALLENGE_SERVER_MAX_POST_SIZE_MEGA', ini_get( 'post_max_size') );
    define( 'CHALLENGE_SERVER_MAX_POST_SIZE_BYTE', challenge_return_bytes( ini_get( 'post_max_size') ) );
    ob_start();
    global $current_user;
    global $wp_roles;
    global $wpdb;
    global $error;  
    global $challenge_shortcode_on_front;
    
    //get required and shown fields
    $challenge_defaultOptions = get_option('challenge_default_settings');
    $challenge_defaultOptions['username'] = 'show';
    $challenge_defaultOptions['email'] = 'show';
    $challenge_defaultOptions['firstname'] = 'show';
    $challenge_defaultOptions['lastname'] = 'show';
    $challenge_defaultOptions['bio'] = 'show';
    $challenge_defaultOptions['website'] = 'show';
    $challenge_defaultOptions['password'] = 'show';

    $challenge_defaultOptions['usernameRequired'] = 'yes';
    $challenge_defaultOptions['emailRequired'] = 'yes';
    $challenge_defaultOptions['passwordRequired'] = 'yes';

    /*
    array(24) { ["username"]=> string(4) "show" ["usernameRequired"]=> string(3) "yes" ["firstname"]=> string(4) "hide" ["firstnameRequired"]=> string(2) "no" ["lastname"]=> string(4) "hide" ["lastnameRequired"]=> string(2) "no" ["nickname"]=> string(4) "hide" ["nicknameRequired"]=> string(2) "no" ["dispname"]=> string(4) "hide" ["dispnameRequired"]=> string(2) "no" ["email"]=> string(4) "show" ["emailRequired"]=> string(3) "yes" ["website"]=> string(4) "hide" ["websiteRequired"]=> string(2) "no" ["aim"]=> string(4) "hide" ["aimRequired"]=> string(2) "no" ["yahoo"]=> string(4) "hide" ["yahooRequired"]=> string(2) "no" ["jabber"]=> string(4) "hide" ["jabberRequired"]=> string(2) "no" ["bio"]=> string(4) "hide" ["bioRequired"]=> string(2) "no" ["password"]=> string(4) "show" ["passwordRequired"]=> string(3) "yes" } 
    */
    //get "login with" setting

    $challenge_generalSettings = get_option('challenge_general_settings');
    /*
    array(3) { ["extraFieldsLayout"]=> string(3) "yes" ["emailConfirmation"]=> string(2) "no" ["loginWith"]=> string(8) "username" }
    */

    $challenge_shortcode_on_front = true;
    $agreed = true;
    $new_user = 'no';
    $multisite_message = false;
    $registerFilterArray = array();
    $registerFilterArray2 = array(); //section #1
    $registerFilterArray3 = array(); //section #4
    $uploadExt = array();
    $extraFieldsErrorHolder = array();  //we will use this array to store the ID's of the extra-fields left uncompleted
    get_currentuserinfo();

    /* variables used to verify if all required fields were submitted*/
    $firstnameComplete = 'yes';
    $lastnameComplete = 'yes';
    $nicknameComplete = 'yes';
    $websiteComplete = 'yes';
    $aimComplete = 'yes';
    $yahooComplete = 'yes';
    $jabberComplete = 'yes';
    $bioComplete = 'yes';

    $challenge_generalSettings['loginWith'] = 'username';
    /* END variables used to verify if all required fields were submitted*/
    
    

    /* Check if users can register. */
    $registration = get_option( 'users_can_register' );
    //$registration = apply_filters ( 'challenge_register_setting_override', $registration);
    
    /* If user registered, input info. */
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'adduser' && wp_verify_nonce($_POST['register_nonce_field'],'verify_true_registration') && ($_POST['formName'] == 'register') ) {
        //global $wp_roles;
        ?>
        <style type="text/css">
            #register-2,#register-3,#register-4{
                display:block !important;
            }
        </style>
        <?php
        //get value sent in the shortcode as parameter, use default if not set
        $default_role = get_option( 'default_role' );
        extract(shortcode_atts(array('role' => $default_role), $atts));

        //check if the specified role exists in the database, else fall back to the "safe-zone"
        $aprovedRole = ( ($role == $default_role) || get_role($role) ) ? $role : $default_role;
    
        /* preset the values in case some are not submitted */
        $user_pass = '';
        $user_interests = array();
        $user_internal_interests = array();

        if (isset($_POST['passw1']))
            $user_pass = esc_attr( $_POST['passw1'] );
        $email = '';
        if (isset($_POST['email']))
            $email = trim ($_POST['email']);
        $user_name = '';
        if (isset($_POST['user_name']))
            $user_name = trim ($_POST['user_name']);
        $first_name = '';
        if (isset($_POST['first_name']))
            $first_name = trim ($_POST['first_name']);
        $last_name = '';
        if (isset($_POST['last_name']))
            $last_name = trim ($_POST['last_name']);
        $nickname = '';
        if (isset($_POST['nickname'])){
            //the field is filled by the user upon registration
            $nickname = trim ($_POST['nickname']);
        }else{
            $nickname = $user_name;
        }
        $website = '';
        if (isset($_POST['website']))
            $website = trim ($_POST['website']);
        $aim = '';
        if (isset($_POST['aim']))
            $aim = trim ($_POST['aim']);
        $yim = '';
        if (isset($_POST['yim']))
            $yim = trim ($_POST['yim']);
        $jabber = '';
        if (isset($_POST['jabber']))
            $jabber = trim ($_POST['jabber']);
        $description = '';
        if (isset($_POST['description']))
            $description = trim ($_POST['description']);

        if (isset($_POST['agriculture']))
            $user_interests['agriculture'] = 'yes';

        if (isset($_POST['business']))
           $user_interests['business'] = 'yes'; 
  
        if (isset($_POST['climate']))
           $user_interests['climate'] = 'yes'; 

        if (isset($_POST['consumer']))
           $user_interests['consumer'] = 'yes'; 

        if (isset($_POST['ecosystems']))
           $user_interests['ecosystems'] = 'yes'; 

        if (isset($_POST['education']))
           $user_interests['education'] = 'yes'; 

        if (isset($_POST['energy']))
           $user_interests['energy'] = 'yes'; 

        if (isset($_POST['finance']))
           $user_interests['finance'] = 'yes'; 

        if (isset($_POST['health']))
           $user_interests['health'] = 'yes';

        if (isset($_POST['government']))
           $user_interests['government'] = 'yes'; 

        if (isset($_POST['manufacturing']))
           $user_interests['manufacturing'] = 'yes'; 

        if (isset($_POST['ocean']))
           $user_interests['ocean'] = 'yes'; 

        if (isset($_POST['safety']))
           $user_interests['safety'] = 'yes'; 

        if (isset($_POST['research']))
           $user_interests['research'] = 'yes';
 

        if (isset($_POST['software']))
            $user_internal_interests['software'] = 'yes';

        if (isset($_POST['scientific']))
            $user_internal_interests['scientific'] = 'yes'; 

        if (isset($_POST['algorithms']))
            $user_internal_interests['algorithms'] = 'yes';

        if (isset($_POST['ideas']))
            $user_internal_interests['ideas'] = 'yes';

        if (isset($_POST['engineering']))
            $user_internal_interests['engineering'] = 'yes';
 
        if (isset($_POST['plans']))
            $user_internal_interests['plans'] = 'yes';
 
        // if (isset($_POST['softwaredesign']))
        //     $user_internal_interests['softwaredesign'] = 'yes';

        if (isset($_POST['multimedia']))
            $user_internal_interests['multimedia'] = 'yes';

        if (isset($_POST['graphic']))
            $user_internal_interests['graphic'] = 'yes';

        if (isset($_POST['additional_interest']))
            $user_internal_interests['additional_interest'] = $_POST['additional_interest'];

        /* use filters to modify (if needed) the posted data before creating the user-data */
        $user_pass = apply_filters('challenge_register_posted_password', $user_pass);
        $user_name = apply_filters('challenge_register_posted_username', $user_name);
        $first_name = apply_filters('challenge_register_posted_first_name', $first_name);
        $last_name = apply_filters('challenge_register_posted_last_name', $last_name);
        $nickname = apply_filters('challenge_register_posted_nickname', $nickname);
        $email = apply_filters('challenge_register_posted_email', $email);
        $website = apply_filters('challenge_register_posted_website', $website);
        $aim = apply_filters('challenge_register_posted_aim', $aim);
        $yim = apply_filters('challenge_register_posted_yahoo', $yim);
        $jabber = apply_filters('challenge_register_posted_jabber', $jabber);
        $description = apply_filters('challenge_register_posted_bio', $description);
        /* END use filters to modify (if needed) the posted data before creating the user-data */
        
        $userdata = array(
            'user_pass' => $user_pass,
            'user_login' => esc_attr( $user_name ),
            'first_name' => esc_attr( $first_name ),
            'last_name' => esc_attr( $last_name ),
            'nickname' => esc_attr( $nickname ),
            'user_email' => esc_attr( $email ),
            'user_url' => esc_attr( $website ),
            'aim' => esc_attr( $aim ),
            'yim' => esc_attr( $yim ),
            'jabber' => esc_attr( $jabber ),
            'description' => esc_attr( $description ),
            'role' => $aprovedRole);
        $userdata = apply_filters('challenge_register_userdata', $userdata);
        
        //$registerFilterArray['extraError'] = ''; //this is for creating extra error message and bypassing registration
        //$registerFilterArray['extraError'] = apply_filters('challenge_register_extra_error', $registerFilterArray['extraError']);
        
        /* check if all the required fields were completed */
        if($challenge_defaultOptions['firstname'] == 'show'){
            if (($challenge_defaultOptions['firstnameRequired'] == 'yes') && (trim($_POST['first_name']) == ''))
                $firstnameComplete = 'no';
        }
        
        if($challenge_defaultOptions['lastname'] == 'show'){
            if (($challenge_defaultOptions['lastnameRequired'] == 'yes') && (trim($_POST['last_name']) == ''))
                $lastnameComplete = 'no';
        }
        
        if($challenge_defaultOptions['nickname'] == 'show'){
            if (($challenge_defaultOptions['nicknameRequired'] == 'yes') && (trim($_POST['nickname']) == ''))
                $nicknameComplete = 'no';
        }
        
        if($challenge_defaultOptions['website'] == 'show'){
            if (($challenge_defaultOptions['websiteRequired'] == 'yes') && (trim($_POST['website']) == ''))
                $websiteComplete = 'no';
        }
        
        if($challenge_defaultOptions['aim'] == 'show'){
            if (($challenge_defaultOptions['aimRequired'] == 'yes') && (trim($_POST['aim']) == ''))
                $aimComplete = 'no';
        }
        
        if($challenge_defaultOptions['yahoo'] == 'show'){
            if (($challenge_defaultOptions['yahooRequired'] == 'yes') && (trim($_POST['yahoo']) == ''))
                $yahooComplete = 'no';
        }
        
        if($challenge_defaultOptions['jabber'] == 'show'){
            if (($challenge_defaultOptions['jabberRequired'] == 'yes') && (trim($_POST['jabber']) == ''))
                $jabberComplete = 'no';
        }
        
        if($challenge_defaultOptions['bio'] == 'show'){
            if (($challenge_defaultOptions['bioRequired'] == 'yes') && (trim($_POST['description']) == ''))
                $bioComplete = 'no';
        }
        /*
        case "agreeToTerms":{
                        if (isset($value['item_required'])){
                            if ($value['item_required'] == 'yes'){
                                if ($_POST[$value['item_type'].$value['id']] == NULL)
                                    array_push($extraFieldsErrorHolder, $value['id']);
                            }
                        }
                        break;}
                        */
        /* END check if all the required fields were completed */

        if ($registerFilterArray['extraError'] != '')
            $error = $registerFilterArray['extraError'];
        elseif ( !$userdata['user_login'] ){
                $error = apply_filters('challenge_register_userlogin_error1', __('A username is required for registration.', 'challengegov'));
        }elseif (!validate_username($userdata['user_login']) || (strlen(trim($userdata['user_login'])) != strlen($userdata['user_login']))){
                $error = apply_filters('challenge_register_userlogin_error1', __('Only lowercase letters (a-z) and numbers are allowed for Username field. Spaces not allowed.', 'challengegov'));
        }elseif ( username_exists($userdata['user_login']) ){
                $error = apply_filters('challenge_register_userlogin_error2', __('This username is currently in use on the U.S. General Services Admininistration\'s WordPress Network, which powers Challenge.gov. If this is your user name, click the log in link below. If not, please select a different username.', 'challengegov'));
        }elseif ( !is_email($userdata['user_email'], true) )
            $error = apply_filters('challenge_register_useremail_error1', __('You must enter a valid email address.', 'challengegov'));
        elseif ( email_exists($userdata['user_email']) )
            $error = apply_filters('challenge_register_useremail_error2', __('Sorry, that email address is already used!', 'challengegov'));
        elseif (( empty($_POST['passw1'] ) || empty( $_POST['passw2'] )) || ( $_POST['passw1'] != $_POST['passw2'] )){
            if ( empty($_POST['passw1'] ) || empty( $_POST['passw2'] ))                                                    //verify if the user has completed both password fields
                $error = apply_filters('challenge_register_userpass_error1', __('You didn\'t complete one of the password-fields!', 'challengegov'));
            elseif ( $_POST['passw1'] != $_POST['passw2'] )                                                                //verify if the the password and the retyped password are a match
                $error = apply_filters('challenge_register_userpass_error2', __('The entered passwords don\'t match!', 'challengegov'));
        }elseif ( $agreed == false )
            $error = __('You must agree to the terms and conditions before registering!', 'challengegov');
        elseif(($firstnameComplete == 'no' || $lastnameComplete == 'no' ||  $nicknameComplete == 'no' || $websiteComplete == 'no' || $aimComplete == 'no' || $yahooComplete == 'no' ||  $jabberComplete == 'no' ||  $bioComplete == 'no' ) || !empty($extraFieldsErrorHolder))
            $error = __('The account was NOT created!', 'challengegov') .'<br/>'. __('(Several required fields were left uncompleted)', 'challengegov');
        else{
            $registered_name = $_POST['user_name'];
            
            //register the user normally if it is not a multi-site installation
            if ( !is_multisite() ){
                $challenge_generalSettings = get_option('challenge_general_settings');

                $challenge_generalSettings['emailConfirmation'] = 'no'; //manually set email conf

                if ($challenge_generalSettings['emailConfirmation'] == 'yes'){
                    $foundError = false;
                
                    if ( is_multisite() )
                        $userSignup = $wpdb->get_results("SELECT * FROM $wpdb->signups WHERE user_login='".$userdata['user_login']."' OR user_email='".$userdata['user_email']."'");
                    else
                        $userSignup = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."signups WHERE user_login='".$userdata['user_login']."' OR user_email='".$userdata['user_email']."'");
                        
                    if (trim($userSignup[0]->user_login) == $userdata['user_login']){
                        $foundError = true;
                        $error = __('This username is already reserved to be used soon.', 'challengegov') .'<br/>'. __('Please try a different one!', 'challengegov');
                        
                    }elseif (trim($userSignup[0]->user_email) == $userdata['user_email']){
                        $foundError = true;
                        $error = __('This email address is already reserved to be used soon.', 'challengegov') .'<br/>'. __('Please try a different one!', 'challengegov');
                    }
                    
                    if ( $foundError ){
                    }else{
                        $new_user = 'yes';
                        $multisite_message = true;

                        $meta = array(
                            'user_pass' => base64_encode($userdata['user_pass']),
                            'first_name' => $userdata['first_name'],
                            'last_name' => $userdata['last_name'],
                            'nickname' => $userdata['nickname'],
                            'user_url' => $userdata['user_url'],
                            'aim' => $userdata['aim'],
                            'yim' => $userdata['yim'],
                            'jabber' => $userdata['jabber'],
                            'description' => $userdata['description'],
                            'role' => $userdata['role']
                        );

                        //$meta = challenge_add_custom_field_values($_POST, $meta);
                        //$meta = '';
                        challenge_signup_user( $userdata['user_login'], $userdata['user_email'], $meta );
                    }
                }else{
                    $new_user = wp_insert_user( $userdata  );
                    if ($new_user != 0){
                        $set_role='public_user';
                        update_user_meta($new_user, 'user_interests', $user_interests);
                        update_user_meta($new_user, 'user_internal_interests', $user_internal_interests);
                        add_user_to_blog(get_current_blog_id(), $new_user, $set_role);
                    }; 
                    // if admin approval is activated, then block the user until they are approved
                    /*
                    $challenge_generalSettings = get_option('challenge_general_settings', 'not_found');
                    if ($challenge_generalSettings != 'not_found')
                        if($challenge_generalSettings['adminApproval'] == 'yes'){
                            wp_set_object_terms( $new_user, array( 'unapproved' ), 'user_status', false);
                            clean_object_term_cache( $new_user, 'user_status' );
                        }
                    */
                    // send an email to the admin, and - if selected - to the user also.
                    $bloginfo = get_bloginfo( 'name' );
                    $sentEmailStatus = challenge_notify_user_registration_email($bloginfo, esc_attr($_POST['user_name']), esc_attr($_POST['email']), $_POST['send_credentials_via_email'], $_POST['passw1'], $challenge_generalSettings['adminApproval']);
                    
                }
            }elseif ( is_multisite() ){
                //validate username and email
                $validationRes = wpmu_validate_user_signup($userdata['user_login'], $userdata['user_email']);
                $error = apply_filters('challenge_register_wpmu_registration_error', $validationRes['errors']->get_error_message());
                switch ($error){
                    case "Only lowercase letters (a-z) and numbers are allowed.":
                        $error = "Only lowercase letters (a-z) and numbers are allowed for Username field. Spaces not allowed.";
                        break;
                    case "That email address has already been used. Please check your inbox for an activation email. It will become available in a couple of days if you do nothing.":
                        $error = "This email address has already been used. Please check your inbox for an activation email.";
                        break;
                }

                if ( trim($error) != '' ){
                }else{
                   

                $user_id = username_exists($userdata['user_login']);


                if ( ! $user_id )
                {
                    
                     $new_user = wp_insert_user($userdata);
                     $set_role='public_user';
                    $multisite_message = true;

                    $meta = array(
                        'user_pass' => base64_encode($userdata['user_pass']),
                        'first_name' => $userdata['first_name'],
                        'last_name' => $userdata['last_name'],
                        'nickname' => $userdata['nickname'],
                        'user_url' => $userdata['user_url'],
                        'aim' => $userdata['aim'],
                        'yim' => $userdata['yim'],
                        'jabber' => $userdata['jabber'],
                        'description' => $userdata['description'],
                        'role' => $userdata['role'],
                        'user_interests' => $user_interests,
                        'user_internal_interests' => $user_internal_interests
                    );
                    challenge_signup_user( $userdata['user_login'], $userdata['user_email'], $meta );
                   
                        update_user_meta($new_user, 'user_interests', $user_interests);
                        update_user_meta($new_user, 'user_internal_interests', $user_internal_interests);
                       add_user_to_blog(get_current_blog_id(), $new_user, $set_role);
                        if(!isset($_POST['notify_challenge'])){
                            update_user_meta($new_user,'challenge_global_newsletter',1);
                            update_user_meta($new_user,'challenge_agency_newsletter',1);
                            update_user_meta($new_user,'challenge_follow_newsletter',1);
                            update_user_meta($new_user,'challenge_submit_newsletter',1);
                            update_user_meta($new_user,'challenge_types_newsletter',1);
                            update_user_meta($new_user,'challenge_skills_newsletter',1);
                            update_user_meta($new_user,'challenge_interests_newsletter',1);
                        }
                }
                else
                {
                    
                    $user_already_exists = true;
                }
                    
                $user_id = username_exists($userdata['user_login']);
                if ( ! $user_id )
                    return $activateUserErrorMessage4 = apply_filters('wppb_register_activate_user_error_message4', '<p class="error">'. __('Could not create user!', 'profilebuilder') .'</p>');
                    
                elseif ( isset( $user_already_exists ) )
                    return $activateUserErrorMessage5 = apply_filters('wppb_register_activate_user_error_message5', '<p class="error">'. __('That username is already activated!', 'profilebuilder') .'</p>');
    
                 
                }
            }
            
        }
    }

?>
    <div class="challenge_holder" id="challenge_register">
<?php   

        if ( is_user_logged_in() && !current_user_can( 'create_users' ) ) :

        global $user_ID; 
        $login = get_userdata( $user_ID );
        if($login->display_name == ''){ 
            $login->display_name = $login->user_login;
        }
            $registerFilterArray['loginLogoutError'] = '
                <p class="log-in-out alert">'. __('You are logged in as', 'challengegov') .' <a href="'.get_author_posts_url( $login->ID ).'" title="'.$login->display_name.'">'.$login->display_name.'</a>. '. __('You don\'t need another account.', 'challengegov') .' <a href="'.wp_logout_url(get_permalink()).'" title="'. __('Log out of this account.', 'challengegov') .'">'. __('Logout', 'challengegov') .'  &raquo;</a></p><!-- .log-in-out .alert -->';
            $registerFilterArray['loginLogoutError'] = apply_filters('challenge_register_have_account_alert', $registerFilterArray['loginLogoutError'], $login->ID);
            echo $registerFilterArray['loginLogoutError'];
            
        elseif ( $new_user != 'no' ) :
                    $hours_48 = '<div class="registration_48hours"><div id="requestnew_message" class="cls_requestnew_message"></div><span class="registration_almostdone">You\'re almost done.</span><span>Check your inbox for an account activation email. You must activate your account within 48 hours of receiving this email. If you did not receive an email from us, <a href="javascript:void(0)" data-username='.$_POST['user_name'].' data-email='.$_POST['email'].' id="requestnewemail">request a new one</a> or <a href="'.site_url().'/contact/">contact us</a>.</span><img src="'.get_template_directory_uri().'/images/48hours.png"></div>';
                    if ( current_user_can( 'create_users' ) ){
                    
                        if ($multisite_message){
                            $registerFilterArray['wpmuRegistrationMessage1'] = '<p class="success">' . sprintf(__( '', 'challengegov'), $userdata['user_email']) . '</p><!-- .success -->';
                            echo $registerFilterArray['registrationMessage1'] = apply_filters('challenge_wpmu_register_account_created1', $registerFilterArray['wpmuRegistrationMessage1'], $registered_name, $userdata['user_email']);
                        
                        }else{
                            $registerFilterArray['registrationMessage1'] = '<p class="success">' . sprintf(__( 'A user account has been created for %1$s.', 'challengegov'), $registered_name) . '</p><!-- .success -->';
                            echo $registerFilterArray['registrationMessage1'] = apply_filters('challenge_register_account_created1', $registerFilterArray['registrationMessage1'], $registered_name);
                        }
                        
                        $redirectLink = challenge_curpageurl();
                        
                        $registerFilterArray['48hoursMessage1'] = $hours_48;
                        echo $registerFilterArray['48hoursMessage1'] = apply_filters('challenge_register_page_after_creation1', $registerFilterArray['48hoursMessage1']);       
                        
                    }else{
                    
                        if ($multisite_message){
                            $registerFilterArray['wpmuRegistrationMessage2'] = '<p class="success">'. __('An email has been sent to you with information on how to activate your account.', 'challengegov') .'</p><!-- .success -->';
                            //echo $registerFilterArray['wpmuRegistrationMessage2'] = apply_filters('challenge_register_account_created2', $registerFilterArray['wpmuRegistrationMessage2'], $registered_name);
                        
                        }else{
                            $registerFilterArray['registrationMessage2'] = '<p class="success">' . sprintf(__( 'Thank you for registering %1$s.', 'challengegov'), $registered_name) .'</p><!-- .success -->';
                            echo $registerFilterArray['registrationMessage2'] = apply_filters('challenge_register_account_created2', $registerFilterArray['registrationMessage2'], $registered_name);
                        }
                        
                        //$redirectLink = challenge_curpageurl();
                        $redirectLink = site_url();
                        $registerFilterArray['48hoursMessage2'] = $hours_48;
                        echo $registerFilterArray['48hoursMessage2'] = apply_filters('challenge_register_page_after_creation2', $registerFilterArray['48hoursMessage2']);       
                    }

            
                if(isset($_POST['send_credentials_via_email'])){
                    if ($sentEmailStatus == 1){
                        $registerFilterArray['emailMessage1'] = '<p class="error">'. __('An error occured while trying to send the notification email.', 'challengegov') .'</p><!-- .error -->';
                        $registerFilterArray['emailMessage1'] = apply_filters('challenge_register_send_notification_email_fail', $registerFilterArray['emailMessage1']);
                        echo $registerFilterArray['emailMessage1'];
                    }elseif ($sentEmailStatus == 2){
                        if ($multisite_message){
                            $registerFilterArray['wpmuEmailMessage2'] = '<p class="success">'. __('An email containing activation instructions was successfully sent.', 'challengegov') .'</p><!-- .success -->';
                            $registerFilterArray['wpmuEmailMessage2'] = apply_filters('challenge_register_send_notification_email_success', $registerFilterArray['wpmuEmailMessage2']);
                            echo $registerFilterArray['wpmuEmailMessage2'];

                        }else{
                            $registerFilterArray['emailMessage2'] = '<p class="success">'. __('An email containing the username and password was successfully sent.', 'challengegov') .'</p><!-- .success -->';
                            $registerFilterArray['emailMessage2'] = apply_filters('challenge_register_send_notification_email_success', $registerFilterArray['emailMessage2']);
                            echo $registerFilterArray['emailMessage2'];
                        }
                    }
                }
?>
<?php           
            else :
                if ( $error ) : 
                    $registerFilterArray['errorMessage'] = '<p class="error">'. $error .'</p><!-- .error -->';
                    $registerFilterArray['errorMessage'] = apply_filters('challenge_register_error_messaging', $registerFilterArray['errorMessage'], $error);
                    echo $registerFilterArray['errorMessage'];
                    //error_log(print_r($_POST, 1));
                endif;
                /*
                if ( current_user_can( 'create_users' ) && $registration ) :
                    $registerFilterArray['alertMessage1'] = '<p class="alert">'. __('Users can register themselves or you can manually create users here.', 'challengegov') .'</p><!-- .alert -->';
                    $registerFilterArray['alertMessage1'] = apply_filters('challenge_register_alert_messaging1', $registerFilterArray['alertMessage1']);
                    echo $registerFilterArray['alertMessage1'];                 
                    
                elseif ( current_user_can( 'create_users' ) ) :
                    $registerFilterArray['alertMessage2'] = '<p class="alert">'. __('Users cannot currently register themselves, but you can manually create users here.', 'challengegov') .'</p><!-- .alert -->';
                    $registerFilterArray['alertMessage2'] = apply_filters('challenge_register_alert_messaging2', $registerFilterArray['alertMessage2']);
                    echo $registerFilterArray['alertMessage2'];
                    
                elseif ( !current_user_can( 'create_users' ) && !$registration) :
                    $registerFilterArray['alertMessage3'] = '<p class="alert">'. __('Only an administrator can add new users.', 'challengegov') .'</p><!-- .alert -->';
                    $registerFilterArray['alertMessage3'] = apply_filters('challenge_register_alert_messaging3', $registerFilterArray['alertMessage3']);
                    echo $registerFilterArray['alertMessage3'];             
                endif;
                */
                if ( $registration || current_user_can( 'create_users' ) ) :
                    /* use this action hook to add extra content before the register form. */
                    echo '<div id="challenge-registration">';
                    do_action( 'challenge_before_register_fields' );
?>
                    <form enctype="multipart/form-data" method="post" id="challenge-register" class="user-forms" action="//<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
<?php                   
                        echo '<input type="hidden" name="MAX_FILE_SIZE" value="'.CHALLENGE_SERVER_MAX_UPLOAD_SIZE_BYTE.'" /><!-- set the MAX_FILE_SIZE to the server\'s current max upload size in bytes -->'; 
    
                        //$registerFilterArray2['name1'] = '<p class="registerNameHeading"><strong>'. __('Name', 'challengegov') .'</strong></p>';
                        //$registerFilterArray2['name1'] = apply_filters('challenge_register_content_name1', $registerFilterArray2['name1']);
                        
                        if ($challenge_defaultOptions['username'] == 'show'){
                            $errorVar = '';
                            $errorMark = '';
                            if ($challenge_defaultOptions['usernameRequired'] == 'yes'){
                                //$errorMark = '<font color="red" title="This field is required for registration.">*</font>';
                                if (isset($_POST['user_name'])){
                                    if (trim($_POST['user_name']) == ''){
                                        $errorMark = '&nbsp;&nbsp;<img src="'. get_template_directory_uri() . '/images/pencil_delete.png" title="'.__('This field must be filled out before registering (It was marked as required by the administrator)', 'challengegov').'"/>';
                                        $errorVar = ' errorHolder';
                                    }
                                    if (!validate_username($_POST['user_name'])){
                                        $errorMark = '&nbsp;&nbsp;<img src="'. get_template_directory_uri() . '/images/pencil_delete.png" title="'.__('This field must be filled out before registering (It was marked as required by the administrator)', 'challengegov').'"/>';
                                        $errorVar = ' errorHolder';
                                    }
                                }
                            }
                            
                            
                                $localVar = '';
                                if (isset($_POST['user_name']))
                                    $localVar = $_POST['user_name'];
                                $registerFilterArray2['name2'] = '
                                    <p class="form-username'.$errorVar.'">
                                        <font class="required" title="This field is required for registration.">*</font>&nbsp;<label for="user_name">'. __('Username (required)', 'challengegov') .$errorMark.'</label>
                                        <input class="text-input" name="user_name" type="text" id="user_name" value="'.trim($localVar).'" />
                                    </p><!-- .form-username -->';
                                $registerFilterArray2['name2'] = apply_filters('challenge_register_content_name2', $registerFilterArray2['name2'], trim($localVar), $errorVar, $errorMark);
                        }
                        
                        if ($challenge_defaultOptions['firstname'] == 'show'){
                                $errorVar = '';
                                $errorMark = '';
                                if ($challenge_defaultOptions['firstnameRequired'] == 'yes'){
                                    $errorMark = '<font class="required" title="'.__('This field is marked as required by the administrator', 'challengegov').'">*</font>';
                                    if (isset($_POST['first_name'])){
                                        if (trim($_POST['first_name']) == ''){
                                            $errorMark = '<img src="'. get_template_directory_uri() . '/assets/images/pencil_delete.png" title="'.__('This field must be filled out before registering (It was marked as required by the administrator)', 'challengegov').'"/>';
                                            $errorVar = ' errorHolder';
                                        }
                                    }
                                }
                                
                            $localVar = '';
                            if (isset($_POST['first_name']))
                                $localVar = $_POST['first_name'];
                            $registerFilterArray2['name3'] = '
                                <p class="first_name'.$errorVar.'">
                                    <label for="first_name">'. __('First Name (optional)', 'challengegov') .$errorMark.'</label>
                                    <input class="text-input" name="first_name" type="text" id="first_name" value="'.trim($localVar).'" />
                                </p><!-- .first_name -->';
                            $registerFilterArray2['name3'] = apply_filters('challenge_register_content_name3', $registerFilterArray2['name3'], trim($localVar), $errorVar, $errorMark);
                        }

                        if ($challenge_defaultOptions['lastname'] == 'show'){ 
                            $errorVar = '';
                            $errorMark = '';
                            if ($challenge_defaultOptions['lastnameRequired'] == 'yes'){
                                $errorMark = '<font class="required" title="'.__('This field is marked as required by the administrator', 'challengegov').'">*</font>';
                                if (isset($_POST['last_name'])){
                                    if (trim($_POST['last_name']) == ''){
                                        $errorMark = '<img src="'. get_template_directory_uri() . '/assets/images/pencil_delete.png" title="'.__('This field must be filled out before registering (It was marked as required by the administrator)', 'challengegov').'"/>';
                                        $errorVar = ' errorHolder';
                                    }
                                }
                            }
                            
                            $localVar = '';
                            if (isset($_POST['last_name']))
                                $localVar = $_POST['last_name'];
                            $registerFilterArray2['name4'] = '
                                <p class="last_name'.$errorVar.'">
                                    <label for="last_name">'. __('Last Name (optional)', 'challengegov') .$errorMark.'</label>
                                    <input class="text-input" name="last_name" type="text" id="last_name" value="'.trim($localVar).'" />
                                </p><!-- .last_name -->';
                            $registerFilterArray2['name4'] = apply_filters('challenge_register_content_name4', $registerFilterArray2['name4'], trim($localVar), $errorVar, $errorMark);
                        }

                        if ($challenge_defaultOptions['email'] == 'show'){
                            $errorVar = '';
                            $errorMark = '';
                            if ($challenge_defaultOptions['emailRequired'] == 'yes'){
                                //$errorMark = '<font color="red" title="'.__('This field is marked as required by the administrator', 'challengegov').'">*</font>';
                                if (isset($_POST['email'])){

                                    if ( (trim($_POST['email']) == '') || (!is_email(trim($_POST['email']))) || email_exists($userdata['user_email']) ){
                                        $errorMark = '&nbsp;&nbsp;<img src="'. get_template_directory_uri() . '/images/pencil_delete.png" title="This field is required for registration."/>';
                                        $errorVar = ' errorHolder';
                                    }
                                }
                            }
                            
                            $localVar = '';
                            if (isset($_POST['email']))
                                $localVar = $_POST['email'];
                            $registerFilterArray3['info2'] = '
                                <p class="form-email'.$errorVar.'">
                                    <font class="required" title="This field is required for registration.">*</font>&nbsp;
                                    <label for="email">'. __('E-mail (required)', 'challengegov') .$errorMark.'</label>
                                    <input class="text-input" name="email" type="text" id="email" value="'.stripslashes(trim($localVar)).'" />
                                </p><!-- .form-email -->';
                            $registerFilterArray3['info2'] = apply_filters('challenge_register_content_info2', $registerFilterArray3['info2'], trim($localVar), $errorVar, $errorMark);
                        }

                        if ($challenge_defaultOptions['password'] == 'show'){
                            $errorMark = '';
                            $errorMark2 = '';
                            $errorVar = '';
                            $errorVar2 = '';
                            if ($challenge_defaultOptions['passwordRequired'] == 'yes'){
                                //$errorMark = '<font color="red" title="This field is required for registration.">*</font>';
                                //$errorMark2 = '<font color="red" title="This field is required for registration.">*</font>';
                                if (isset ($_POST['passw1']))
                                    if (trim($_POST['passw1']) == ''){
                                        $errorMark = '<img src="'. get_template_directory_uri() . '/images/pencil_delete.png" title="This field is required for registration."/>';
                                        $errorVar = ' errorHolder';
                                    }
                                if (isset ($_POST['passw2']))
                                    if (trim($_POST['passw2']) == ''){
                                        $errorMark2 = '<img src="'. get_template_directory_uri() . '/images/pencil_delete.png" title="This field is required for registration."/>';
                                        $errorVar2 = ' errorHolder';
                                    }
                                if (isset($_POST['passw1']) && isset($_POST['passw2']))
                                    if (trim($_POST['passw1']) != trim($_POST['passw2'])){
                                        $errorVar = ' errorHolder';
                                        $errorVar2 = ' errorHolder';    
                                    }
                            }
                            
                            $localVar1 = '';
                            if (isset($_POST['passw1']))
                                $localVar1 = $_POST['passw1'];//put '.trim($localVar1).' in value attribute to make the password show at error refresh
                            $localVar2 = '';
                            if (isset($_POST['passw2']))
                                $localVar2 = $_POST['passw2'];//put '.trim($localVar2).' in value attribute to make the password confirmation show at error refresh
                            $registerFilterArray3['ay3'] = '
                                <p class="form-password'.$errorVar.'">
                                    <font class="required" title="This field is required for registration.">*</font>&nbsp;
                                    <label for="pass1">'. __('Password (required)', 'challengegov') .$errorMark.'</label>
                                    <input class="text-input" name="passw1" type="password" id="pass1" value="" />
                                </p><!-- .form-password -->
                 
                                <p class="form-password'.$errorVar2.'">
                                    <font class="required" title="This field is required for registration.">*</font>&nbsp;
                                    <label for="pass2">'. __('Confirm Password (required)', 'challengegov') .$errorMark2.'</label>
                                    <input class="text-input" name="passw2" type="password" id="pass2" value="" />
                                </p><!-- .form-password -->';
                            $registerFilterArray3['ay3'] = apply_filters('challenge_register_content_about_yourself3', $registerFilterArray3['ay3'], trim($localVar1), trim($localVar2), $errorVar, $errorMark, $errorVar2, $errorMark2);
                        }
                            /*
                            $challenge_premium = get_template_directory() . '/premium/functions/';
                            if (file_exists ( $challenge_premium.'extra.fields.php' )){
                                require_once($challenge_premium.'extra.fields.php');
                                
                                //register_user_extra_fields($error, $_POST, $extraFieldsErrorHolder);
                                $page = 'register';
                                $returnedValue = challenge_extra_fields($current_user->id, $extraFieldsErrorHolder, $registerFilterArray, $page, $error, $_POST);
                                
                                //copy over extra fields to the rest of the fieldso on the edit profile
                                foreach($returnedValue as $key => $value)
                                    $registerFilterArray2[$key] = apply_filters('challenge_register_content_'.$key, $value);
                            }
                            */

                            /*
                            if(function_exists('challenge_add_recaptcha_to_registration_form')){
                                $challenge_addon_settings = get_option('challenge_addon_settings');
                                if ($challenge_addon_settings['challenge_reCaptcha'] == 'show'){
                                    $reCAPTCHAForm = challenge_add_recaptcha_to_registration_form();
                                    $labelName = apply_filters('challenge_register_anti_spam_title', __('Anti-Spam', 'challengegov'));
                                    $registerFilterArray2['reCAPTCHAForm'] = '<div class="form-reCAPTCHA"><label class="form-reCAPTCHA-label" for="'.$labelName.'">'.$labelName.'</label>'.$reCAPTCHAForm.'</div><!-- .form-reCAPTCHA -->';
                                }
                            }
                            */

                            // additional filter, just in case it is needed
                            $registerFilterArray3['extraRegistrationFilter'] = '';
                            $registerFilterArray3['extraRegistrationFilter'] = apply_filters('extraRegistrationField', $registerFilterArray3['extraRegistrationFilter']);
                            // END additional filter, just in case it is needed

                            $challenge_generalSettings = get_option('challenge_general_settings');
                            /*
                            if ($challenge_generalSettings['emailConfirmation'] != 'yes'){
                                if (!is_multisite()){
                                    if (isset($_POST['send_credentials_via_email'])) 
                                        $checkedVar = ' checked';
                                    else $checkedVar = '';
                                    $registerFilterArray2['confirmationEmailForm'] = '
                                        <p class="send-confirmation-email">
                                            <label for="send-confirmation-email"> 
                                                <input id="send_credentials_via_email" type="checkbox" name="send_credentials_via_email" value="sending"'. $checkedVar .'/>
                                                '. __('Send these credentials via email.', 'challengegov') . '
                                            </label>
                                        </p><!-- .send-confirmation-email -->';
                                    $registerFilterArray2['confirmationEmailForm'] = apply_filters('challenge_register_confirmation_email_form', $registerFilterArray2['confirmationEmailForm'], $checkedVar);
                                }
                            }
                            */
                            ?>
                            <script type="text/javascript">
                                jQuery(document).ready(function($){
                                    var windowHeight = $(window).height();

                                    // get header height
                                    var headerHeight = $('#register-1').offset().top;

                                    //set the first div height
                                    $('#register-1').css('min-height', (windowHeight - headerHeight));
                                    $('#register-2, #register-3, #register-4').hide()
                                    $('#register-2, #register-3, #register-4').css('min-height', windowHeight);

                                    $(window).resize(function() {
                                        //get the header height after resize
                                        headerHeight = $('#register-1').offset().top;

                                        //get the window height after resize
                                        windowHeight = $(window).height();

                                        //set the first div height after resize
                                        $('#register-1').css('min-height', (windowHeight - headerHeight));
                                        $('#register-2, #register-3, #register-4').css('min-height', windowHeight);
                                    });
								  
                                    $('.register-1-next').click(function(){
                                        $('#register-2').show();
                                        $("html, body").animate({ scrollTop: $('#register-2').offset().top }, 100);
                                    });
									<?php
									  /*
								  $('.register-1-next').click(function(){
                                        alert('Challenge.gov is undergoing scheduled maintenance. Between the hours of 8 p.m. EST and 10 p.m. EST tonight, the Challenge.gov database will be in read-only mode. It will be unable to save new registrations, profile updates, submissions or comments during this time. We apologize for this inconvenience, and encourage you to try back once the maintenance is completed.');
                                        return false;
                                    });
									*/
									  ?>
                                    $('.register-2-next').click(function(){
                                        $('#register-3').show();
                                        $("html, body").animate({ scrollTop: $('#register-3').offset().top }, 100);
                                    });
                                    $('.register-3-next').click(function(){
                                        $('#register-4').show();
                                        $("html, body").animate({ scrollTop: $('#register-4').offset().top }, 100);
                                    });
                                
                                
                                    $("#select_checkones").change(function() {
                                        if ($("#select_checkones").attr('checked') ){
                                            $('.check1').prop("checked", true);
                                            $('#sel_all_1').text("Deselect all");
                                        }
                                        else {
                                            $('.check1').prop("checked", false);
                                            $("#sel_all_1").text("Select all");
                                        }

                                    });
                                    
                                    $("#select_checktwos").change(function(){
                                        if ($("#select_checktwos").attr('checked') ){
                                            $('.check2').prop("checked", true);
                                            $('#sel_all_2').text("Deselect all");
                                        }
                                        else {
                                            $('.check2').prop("checked", false);
                                            $("#sel_all_2").text("Select all");
                                        }

                                    });                                        
                                });
                            </script>
                            <?php
                            $registerFilterArray2 = apply_filters('challenge_register', $registerFilterArray2);
                            echo '<div id="register-1">';
                            echo '<div class = "row">';
                            echo '<div class = "col-md-6 hidden-sm hidden-xs">';
                            echo '<div class="register-1-img">';
                            echo '<img alt="sample image for login profile" src="'.get_template_directory_uri().'/images/login-graphic.png" width="100%" height="100%">';
                            echo '</div></div>';
                            echo '<div class = "col-md-6 col-sm-12 col-xs-12">';
                            echo '<div class="register-1-form-box"><div class="register-1-form">';
  							//echo '<strong><p>Agency users must use a government OMB MAX Information System account to manage challenges. New to OMB MAX? <a href="https://max.omb.gov/maxportal/registrationForm.action" target="_blank">Register here.</a></p></strong>';
                            echo '<p><strong>Federal Challenge Managers Only:</strong> You must use an OMB MAX Information System account to access this platform. <a href="https://max.omb.gov/maxportal/registrationForm.action" target="_blank">Register for OMB MAX</a> or, if you already have an account, <a href="'.site_url().'/wp-login.php?ombAuth=1&redirect_to='.site_url().'/login">log in to Challenge.gov</a>.</p>';
                            echo '<hr style="border-color: #000;">';
                            echo '<p><strong>Solvers, Inventors, Entrepreneurs, and Fans:</strong> Complete the fields below to register or submit your solutions to Challenge.gov.</p>';
  							foreach ($registerFilterArray2 as $key => $value)
                                echo $value;
                            echo '<a href="#" class="register-1-next">Next</a>';
                            echo '<span class="register-login">Already have an account? <a href="'.site_url('login').'">Log in</a>';
                            echo '<strong><p>There is no cost for the public to participate in the Challenge Program.</p></strong></div></div></div>';
                            echo '<ul class="reg-steps"><li class="reg-step reg-step-filled"></li><li class="reg-step"></li><li class="reg-step"></li><li class="reg-step"></li></ul>';
                            echo '</div></div>';
                            echo '<div id="register-2"><span class="reg-form-header">What are your interests?</span><span class="reg-form-header-second">Select all that apply (optional)</span>';
                            echo '<div>';
                            echo '<label><span id="sel_all_1">Select All</span><input type="checkbox" id="select_checkones" value = "yes" '.(isset($_POST['agriculture']) && isset($_POST['business']) && isset($_POST['climate']) && isset($_POST['consumer']) && isset($_POST['ecosystems']) && isset($_POST['education']) && isset($_POST['energy']) && isset($_POST['finance']) && isset($_POST['health']) && isset($_POST['government']) && isset($_POST['manufacturing']) && isset($_POST['ocean']) && isset($_POST['safety']) && isset($_POST['research'])  ? "checked" : "").'/></label></div>';
                            echo '<div>';
                            echo '<label><i class = "topic-food"></i>&nbsp; <span>Agriculture</span><input class = "check1" id = "check1_1" type="checkbox" name = "agriculture" value = "yes" '.(isset($_POST['agriculture']) ? "checked" : "").'/></label>';
                            echo '<label><i class = "topic-business"></i>&nbsp; <span>Business</span><input class = "check1" id = "check1_2" type="checkbox" name = "business" value = "yes" '.(isset($_POST['business']) ? "checked" : "").'/></label>';
                            echo '<label><i class = "topic-climate"></i>&nbsp; <span>Climate</span><input class = "check1" id = "check1_3" type="checkbox" name = "climate" value = "yes" '.(isset($_POST['climate']) ? "checked" : "").'/></label>';
                            echo '<label><i class = "topic-consumer"></i>&nbsp; <span>Consumer</span><input class = "check1" id = "check1_4" type="checkbox" name = "consumer" value = "yes" '.(isset($_POST['consumer']) ? "checked" : "").'/></label>';
                            echo '<label><i class = "topic-ecosystem"></i>&nbsp; <span>Ecosystems</span><input class = "check1" id = "check1_5" type="checkbox" name = "ecosystems" value = "yes" '.(isset($_POST['ecosystems']) ? "checked" : "").'/></label>';
                            echo '<label><i class = "topic-education"></i>&nbsp; <span>Education</span><input class = "check1" id = "check1_6" type="checkbox" name = "education" value = "yes" '.(isset($_POST['education']) ? "checked" : "").'/></label>';
                            echo '<label><i class = "topic-energy"></i>&nbsp; <span>Energy</span><input class = "check1" id = "check1_7" type="checkbox" name = "energy" value = "yes" '.(isset($_POST['energy']) ? "checked" : "").'/></label>';
                            echo '<label><i class = "topic-finance"></i>&nbsp; <span>Finance</span><input class = "check1" id = "check1_8" type="checkbox" name = "finance" value = "yes" '.(isset($_POST['finance']) ? "checked" : "").'/></label>';
                            echo '<label><i class = "topic-health"></i>&nbsp; <span>Health</span><input class = "check1" id = "check1_9" type="checkbox" name = "health" value = "yes" '.(isset($_POST['health']) ? "checked" : "").'/></label>';
                            echo '<label><i class = "topic-local"></i>&nbsp; <span>Local Government</span><input class = "check1" id = "check1_10" type = "checkbox" name = "government" value = "yes" '.(isset($_POST['government']) ? "checked" : "").'/></label>';
                            echo '<label><i class = "topic-manufacturing"></i>&nbsp; <span>Manufacturing</span><input class = "check1" id = "check1_11" type = "checkbox" name = "manufacturing" value = "yes" '.(isset($_POST['manufacturing']) ? "checked" : "").'/></label>';
                            echo '<label><i class = "topic-ocean"></i>&nbsp; <span>Ocean</span><input class = "check1" id = "check1_12" type = "checkbox" name = "ocean" value = "yes" '.(isset($_POST['ocean']) ? "checked" : "").'/></label>';
                            echo '<label><i class = "topic-safety"></i>&nbsp; <span>Public Safety</span><input class = "check1" id = "check1_13" type = "checkbox" name = "safety" value = "yes" '.(isset($_POST['safety']) ? "checked" : "").'/></label>';
                            echo '<label><i class = "topic-research"></i>&nbsp; <span>Science & Research</span><input class = "check1" id = "check1_14" type = "checkbox" name = "research" value = "yes" '.(isset($_POST['research']) ? "checked" : "").'/></label>';
                            echo '</div>'; 
                            echo '<a href="#" class="register-2-next">Next</a><ul class="reg-steps"><li class="reg-step reg-step-filled"></li><li class="reg-step reg-step-filled"></li><li class="reg-step"></li><li class="reg-step"></li></ul></div>';
                            echo '<div id="register-3"><span class="reg-form-header" style="color:#993333;">What are your skills?</span><span class="reg-form-header-second">Select all that apply (optional)</span>';
                            echo '<div>';
                            echo '<label><span id="sel_all_2">Select All</span><input type="checkbox" id="select_checktwos" '.(isset($_POST['software']) && isset($_POST['scientific']) && isset($_POST['algorithms']) && isset($_POST['ideas']) && isset($_POST['engineering']) && isset($_POST['plans']) && isset($_POST['design']) && isset($_POST['multimedia']) && isset($_POST['miscellaneous']) ? "checked" : "").'/></label></div>';
                            echo '<div>';
                            echo '<label><span>Software/Apps</span><input class = "check2" id = "check2_1" type="checkbox" name= "software" value = "yes" '.(isset($_POST['software']) ? "checked" : "").'/></label>';
                            echo '<label><span>Scientific</span><input class = "check2" id = "check2_2" type="checkbox" name= "scientific" value = "yes" '.(isset($_POST['scientific']) ? "checked" : "").'/></label>';
                            echo '<label><span>Algorithms</span><input class = "check2" id = "check2_3" type="checkbox" name= "algorithms" value = "yes" '.(isset($_POST['algorithms']) ? "checked" : "").'/></label>';
                            echo '<label><span>Ideas</span><input class = "check2" id = "check2_4" type="checkbox" name= "ideas" value = "yes" '.(isset($_POST['ideas']) ? "checked" : "").'/></label>';
                            echo '<label><span>Engineering</span><input class = "check2" id = "check2_5" type="checkbox" name= "engineering" value = "yes" '.(isset($_POST['engineering']) ? "checked" : "").'/></label>';
                            echo '<label><span>Plans/Strategies</span><input class = "check2" id = "check2_6" type="checkbox" name= "plans" value = "yes" '.(isset($_POST['plans']) ? "checked" : "").'/></label>';
                            // echo '<label><span>Software Design</span><input class = "check2" id = "check2_7" type="checkbox" name= "softwaredesign" value = "yes" '.(isset($_POST['softwaredesign']) ? "checked" : "").'/></label>';
                            echo '<label><span>Visual Media</span><span class = "multimedia-label">(Photo, Video)</span><input class = "check2" id = "check2_8" type="checkbox" name= "multimedia" value = "yes" '.(isset($_POST['multimedia']) ? "checked" : "").'/></label>';
                            echo '<label><span>Graphic Design</span><span class = "multimedia-label">(Brand, Logo, Poster)</span><input class = "check2" id = "check2_9" type="checkbox" name= "graphic" value = "yes" '.(isset($_POST['graphic']) ? "checked" : "").'/></label>';
                            echo '</div>';
                            echo '
                            <span id="additional-int-info" class="reg-form-header-second" for="additional-skills" style="font-size:16px;margin:10px 0 0;">Looking for more? You can add additional skills here:</span>
                            <input id="additional_interests" aria-labelledby="additional-int-info" type="text" name= "additional_interest" value = "'.(isset($_POST["additional_interest"]) ? $_POST["additional_interest"] : "").'" />';
                            echo '<a href="#" class="register-3-next">Next</a><ul class="reg-steps"><li class="reg-step reg-step-filled"></li><li class="reg-step reg-step-filled"></li><li class="reg-step reg-step-filled"></li><li class="reg-step"></li></ul></div>';
                            echo '<div id="register-4">';
                            echo '<span class="reg-form-header" style="color:#000;text-align:center;">Complete Registration</span>';
                            echo '<div style="padding:20px 0px 0px;">';
                            foreach ($registerFilterArray3 as $key => $value)
                                echo $value;
                            echo '</div>';
                            echo '<div style="text-align:left;padding-bottom:50px;"><input name="notify_challenge" type="checkbox"'.(isset($_POST['notify_challenge']) ? " checked" : "").'><span style="margin-left:10px;">Opt out of receiving news and information (e.g., newsletters) from Challenge.gov.</span></div>';
                            echo '<ul class="reg-steps"><li class="reg-step reg-step-filled"></li><li class="reg-step reg-step-filled"></li><li class="reg-step reg-step-filled"></li><li class="reg-step reg-step-filled"></li></ul>';
                            echo '<p>By creating an account, you agree to our <a href = "'.site_url('terms-of-use').'/">Terms of Service</a> and <a href = "'.site_url().'/privacy-policy/">Privacy Policy</a>, and acknowledge that your username cannot be modified.</p>';

?>                      
                            
                        <p class="form-submit">
                            <input name="adduser" type="submit" id="addusersub" class="submit button" value="<?php if ( current_user_can( 'create_users' ) ) _e('Add User', 'challengegov'); else _e('Register', 'challengegov'); ?>" />
                            <input name="action" type="hidden" id="action" value="adduser" />
                            <input type="hidden" name="formName" value="register" />
                        </p><!-- .form-submit -->
<?php
                        echo '</div>';
                        wp_nonce_field('verify_true_registration','register_nonce_field'); 
?>
                    </form><!-- #adduser -->

<?php   
                endif;
            endif;
        
        /* use this action hook to add extra content after the register form. */
        do_action( 'challenge_after_register_fields' );
?>
    
    </div>
<?php
    $output = ob_get_contents();
    ob_end_clean();
    
    return $output;
}

// function to add the new user to the signup table if email confirmation is selected as active or it is a wpmu installation
function challenge_signup_user($user, $user_email, $meta = '') {
    global $wpdb;

    // Format data
    $user = preg_replace( '/\s+/', '', sanitize_user( $user, true ) );
    $user_email = sanitize_email( $user_email );
    $key = substr( md5( time() . rand() . $user_email ), 0, 16 );
    $meta = serialize($meta);

    if ( is_multisite() )
    {
        //$blog_details = get_blog_details(get_current_blog_id());
        $wpdb->insert( $wpdb->signups, array('domain' => '', 'path' => '', 'title' => '', 'user_login' => $user, 'user_email' => $user_email, 'registered' => current_time('mysql', true), 'activation_key' => $key, 'meta' => $meta) );
    }
    else
        $wpdb->insert( $wpdb->prefix.'signups', array('domain' => '', 'path' => '', 'title' => '', 'user_login' => $user, 'user_email' => $user_email, 'registered' => current_time('mysql', true), 'activation_key' => $key, 'meta' => $meta) );
    
    challenge_signup_user_notification($user, $user_email, $key, $meta);
}

function challenge_signup_user_notification($user, $user_email, $key, $meta = '') {
    if ( !apply_filters('challenge_signup_user_notification_filter', $user, $user_email, $key, $meta) )
        return false;

    // Send email with activation link.
    $admin_email = get_site_option( 'admin_email' );
    if ( $admin_email == '' )
        $admin_email = 'support@' . $_SERVER['SERVER_NAME'];
        
    $from_name = 'Challenge.gov';
    $from_name = apply_filters ('challenge_signup_user_notification_email_from_field', $from_name);
//    error_log($from_name);
    $message_headers = apply_filters ("challenge_signup_user_notification_from", "From: \"{$from_name}\" <{$admin_email}>\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n");
    
    $siteURL = challenge_curpageurl().challenge_passed_arguments_check().'key='.$key;
    
    $subject = sprintf(apply_filters( 'challenge_signup_user_notification_subject', __( 'Welcome to Challenge.gov - Please activate your user account: %2$s', 'challengegov'), $user, $user_email, $key, $meta ), $from_name, $user);
    $message = sprintf(apply_filters( 'challenge_signup_user_notification_email', __( "<div style = 'text-align: center; font-weight: bold; padding: 20px; color: #337ab7; border: 3px solid #337ab7; font-size: 2em;  margin-top: 10px; margin-bottom: 10px;'>
                                        Welcome to <a href='http://www.challenge.gov' style = 'text-decoration: none; color: #337ab7;'>Challenge.gov</a></div>\n\n\n
                                        Hello,\n</br></br>
                                        Please click the following link to verify your email address and activate your Challenge.gov account:\n</br>
                                        %s%s%s\n</br>
                                        If you didn’t sign up at <a href = 'www.challenge.gov'>Challenge.gov</a>, please let us know at Challenge@gsa.gov\n</br>
                                        <div style = 'text-align: left; background-color: #F0F8FF; border: 1px solid #E5E4E2; font-size: .8em; padding: 20px; margin-top:5px; margin-bottom: 5px;'>
                                        2015 Challenge.gov. All rights reserved.</div>", "profilebuilder"),$user, $user_email, $key, $meta), '<a href="'.$siteURL.'">', $siteURL, '</a>.');
                                
    challenge_mail( $user_email, $subject, $message, $from_name, '', $user, '', $user_email, 'register_w_email_confirmation', $siteURL, $meta );
    
    return true;
}
function challenge_send_requested_email($user, $user_email, $key, $meta = '') {
    if ( !apply_filters('challenge_signup_user_notification_filter', $user, $user_email, $key, $meta) )
        return false;

    // Send email with activation link.
    $admin_email = get_site_option( 'admin_email' );
    if ( $admin_email == '' )
        $admin_email = 'support@' . $_SERVER['SERVER_NAME'];
        
    $from_name = 'Challenge.gov';
    $from_name = apply_filters ('challenge_signup_user_notification_email_from_field', $from_name);
   
    $message_headers = apply_filters ("challenge_signup_user_notification_from", "From: \"{$from_name}\" <{$admin_email}>\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n");
    
    $siteURL = site_url().'/registration/?key='.$key;
    $subject = sprintf(apply_filters( 'challenge_signup_user_notification_subject', __( 'Welcome to Challenge.gov - Please activate your user account: %2$s', 'challengegov'), $user, $user_email, $key, $meta ), $from_name, $user);
    $message = sprintf(apply_filters( 'challenge_signup_user_notification_email', __( "<div style = 'text-align: center; font-weight: bold; padding: 20px; color: #337ab7; border: 3px solid #337ab7; font-size: 2em;  margin-top: 10px; margin-bottom: 10px;'>
                                        Welcome to <a href='http://www.challenge.gov' style = 'text-decoration: none; color: #337ab7;'>Challenge.gov</a></div>\n\n\n
                                        Hello,\n</br></br>
                                        Please click the following link to verify your email address and activate your Challenge.gov account:\n</br>
                                        %s%s%s\n</br>
                                        If you didnâ€™t sign up at <a href = 'www.challenge.gov'>Challenge.gov</a>, please let us know at Challenge@gsa.gov\n</br>
                                        <div style = 'text-align: left; background-color: #F0F8FF; border: 1px solid #E5E4E2; font-size: .8em; padding: 20px; margin-top:5px; margin-bottom: 5px;'>
                                        2015 Challenge.gov. All rights reserved.</div>", "profilebuilder"),$user, $user_email, $key, $meta), '<a href="'.$siteURL.'">', $siteURL, '</a>.');
   
  
    challenge_mail( $user_email, $subject, $message, $from_name, '', $user, '', $user_email, 'register_w_email_confirmation', $siteURL, $meta );
    
    return true;
}
if(!function_exists('challenge_curpageurl')){
    function challenge_curpageurl() {
        $pageURL = 'http';
        
        if ((isset($_SERVER["HTTPS"])) && ($_SERVER["HTTPS"] == "on"))
            $pageURL .= "s";
            
        $pageURL .= "://";
        
        if ($_SERVER["SERVER_PORT"] != "80")
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
            
        else
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        
        return $pageURL;
    }
}

//function to add new variables in the address. Checks whether the new variable has to start with a ? or an &
function challenge_passed_arguments_check(){

    $verifyLink = get_permalink();
    $questionMarkPosition = strpos ( (string)$verifyLink , '?' );
    if ($questionMarkPosition !== FALSE ) //we already have 1 "?"
        $passedArgument = '&';
    else $passedArgument = '?';
    
    return $passedArgument;
}

//send an email to the admin regarding each and every new subscriber, and - if selected - to the user himself
function challenge_notify_user_registration_email($bloginfo, $user_name, $email, $send_credentials_via_email, $passw1, $adminApproval){

    $registerFilterArray['adminMessageOnRegistration']  = sprintf(__( 'New subscriber on %1$s.<br/><br/>Username:%2$s<br/>E-mail:%3$s<br/>', 'challengegov'), $bloginfo, $user_name, $email);
    if ($adminApproval == 'yes')
        $registerFilterArray['adminMessageOnRegistration'] .= '<br/>'. __('The "Admin Approval" feature was activated at the time of registration, so please remember that you need to approve this user before he/she can log in!', 'challengegov') ."\r\n";
    $registerFilterArray['adminMessageOnRegistration'] = apply_filters('challenge_register_admin_message_content', $registerFilterArray['adminMessageOnRegistration'], $bloginfo, $user_name, $email);
    
    $registerFilterArray['adminMessageOnRegistrationSubject'] = '['. $bloginfo .'] '. __('A new subscriber has (been) registered!', 'challengegov');
    $registerFilterArray['adminMessageOnRegistrationSubject'] = apply_filters ('challenge_register_admin_message_title', $registerFilterArray['adminMessageOnRegistrationSubject']);

    if (trim($registerFilterArray['adminMessageOnRegistration']) != '')
        challenge_mail(get_option('admin_email'), $registerFilterArray['adminMessageOnRegistrationSubject'], $registerFilterArray['adminMessageOnRegistration'], $blogInfo, '', $user_name, $passw1, $email, 'register_w_o_admin_approval_admin_email', $adminApproval, '' );

    
    //send an email to the newly registered user, if this option was selected
    if (isset($send_credentials_via_email) && ($send_credentials_via_email == 'sending')){
        //change these variables to modify sent email message, destination and source.  
        
        $registerFilterArray['userMessageFrom'] = $bloginfo;
        $registerFilterArray['userMessageFrom'] = apply_filters('challenge_register_from_email_content', $registerFilterArray['userMessageFrom']);

        $registerFilterArray['userMessageSubject'] = __('A new account has been created for you.', 'challengegov');
        $registerFilterArray['userMessageSubject'] = apply_filters('challenge_register_subject_email_content', $registerFilterArray['userMessageSubject']);
        
        $registerFilterArray['userMessageContent'] = sprintf(__( 'Welcome to %1$s!<br/><br/> Your username is:%2$s.', 'challengegov'), $registerFilterArray['userMessageFrom'], $user_name);
        if ($adminApproval == 'yes')
            $registerFilterArray['userMessageContent'] .= '<br/>'. __('Before you can access your account, an administrator needs to approve it. You will be notified via email.', 'challengegov');
        $registerFilterArray['userMessageContent'] = apply_filters('challenge_register_email_content', $registerFilterArray['userMessageContent'], $registerFilterArray['userMessageFrom'], $user_name, $passw1);
        
        $messageSent = challenge_mail( $email, $registerFilterArray['userMessageSubject'], $registerFilterArray['userMessageContent'], $registerFilterArray['userMessageFrom'], '', $user_name, $passw1, $email, 'register_w_o_admin_approval', $adminApproval, '' );
        
        if( $messageSent == TRUE)
            return 2; 
        else
            return 1;
    }
}

function challenge_mail($to, $subject, $message, $blogInfo, $userID, $userName, $password, $userEmail, $function, $extraData1, $extraData2){

    //we add this filter to enable html encoding
    add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
    $header[] = 'From: Challenge.gov <challenge@gsa.gov>' . "\r\n";
    return $sent = wp_mail( $to , $subject, wpautop($message, true), $header);
}

/* Hook to change auto generated password */
add_filter('random_password', 'challenge_signup_password_random_password_filter');
/**
 * Function that changes the auto generated password with the one selected by the user.
 */
function challenge_signup_password_random_password_filter($password) {
    global $wpdb;

    if ( ! empty($_GET['key']) ) {
        $key = $_GET['key'];
    } else {
        $key = $_POST['key'];
    }
    if ( !empty($_POST['user_pass']) ) {
        $password = $_POST['user_pass'];
    } else if ( !empty( $key ) ) {
    
        if ( is_multisite() )
            $signup = $wpdb->get_row("SELECT * FROM " . $wpdb->signups . " WHERE activation_key = '" . $key . "'");
        else
            $signup = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "signups WHERE activation_key = '" . $key . "'");
        
        if ( empty($signup) || $signup->active ) {
            //bad key or already active
        } else {
            //check for password in signup meta
            $meta = unserialize($signup->meta);
            
            $password = $meta['user_pass'];
        }       
    }
    return $password;
}

function challenge_generate_random_username($sentEmail){
    $email = '';
    
    for($i=0;$i<strlen($sentEmail);$i++){
        if ($sentEmail[$i] == '@')
            break;
        else
            $email .= $sentEmail[$i];
    }
    
    $username = 'pb_user_'.$email.mktime(date("H"), date("i"), date("s"), date("n"), date("j"), date("Y"));

    while (username_exists($username)){
         $username = 'pb_user_'.$email.mktime(date("H"), date("i"), date("s"), date("n"), date("j"), date("Y"));
    }
    
    return $username;
}

// function to choose whether to display the registration page or the key-validating function
function challenge_front_end_register_handler($atts){

    $res = '';
    if (isset($_GET['key'])){
        $res .= challenge_activate_signup ($_GET['key']);
    }else
        $res .= challenge_front_end_register($atts);
        
    return $res;    
}
add_shortcode('challenge-reg','challenge_front_end_register_handler');

function reporting_tool_func()
{
    ob_start();
    //<script type="text/javascript" src="//www.amcharts.com/lib/3/amcharts.js"></script>
    ?>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory');  ?>/javascripts/amcharts.js"></script>
    <script type="text/javascript" src="//www.amcharts.com/lib/3/pie.js"></script>
    <script type="text/javascript" src="//www.amcharts.com/lib/3/serial.js"></script>
    <script type="text/javascript" src="//www.amcharts.com/lib/3/gantt.js"></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory');  ?>/javascripts/export.js"></script>
    <script type="text/javascript" src="//www.amcharts.com/lib/3/plugins/export/libs/pdfmake/pdfmake.js"></script>
    <script type="text/javascript" src="//www.amcharts.com/lib/3/plugins/export/libs/pdfmake/vfs_fonts.js"></script>
    <script type="text/javascript" src="//www.amcharts.com/lib/3/plugins/export/libs/jszip/jszip.js"></script>
    <script type="text/javascript" src="//www.amcharts.com/lib/3/plugins/export/libs/fabric.js/fabric.js"></script>
    <script type="text/javascript" src="//www.amcharts.com/lib/3/plugins/export/libs/FileSaver.js/FileSaver.js"></script>
    
    <link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css">
    
    <script type="text/javascript">
    jQuery(document).ready(function($){

      //$(".saved-filters").closest("dd ul").hide();
      
      function updateCheckboxSelections(thisItem) {
        $(thisItem).closest('dl.dropdown').find('.multiSel').empty();
            
        $("input[name='host_platform[]']:checked").each(function (index) {
            var html = '<span title="' + $(this).val() + '">' + (index > 0 ? ', ' : '') + $(this).val() + '</span>';
            $(thisItem).closest('dl.dropdown').find('.multiSel').append(html);
            //$(thisItem).closest('dl.dropdown').find(".hida").hide();
        });

        if( $(thisItem).closest('dl.dropdown').find('p.multiSel').is(':empty') )
            $(thisItem).closest('dl.dropdown').find(".hida").show();
      }
      function updateRadioSelections(thisItem) {
        var title = $(thisItem).val();

          if ($(thisItem).is(':checked')) {
              var html = '<span title="' + title + '">' + title + '</span>';
              $(thisItem).closest('dl.dropdown').find('.multiSel').html(html);
              //$(thisItem).closest('dl.dropdown').find(".hida").hide();
          } 
          else {
              $('span[title="' + title + '"]').remove();
              var ret = $(".hida");
              //$('.dropdown dt a').append(ret);
          }
      }

      $('.mutliSelect:eq(0) input[type="radio"], .mutliSelect:eq(1) input[type="radio"], .mutliSelect:eq(3) input[type="radio"]').each(function(){
        if($(this).is(':checked'))
            updateRadioSelections($(this));
      });
      $('.mutliSelect:eq(2) input[type="checkbox"]').each(function(){
          updateCheckboxSelections($(this));
      });

      function get_save_filters()
      {
        var save_filter_string = '';
        $(".mutliSelect:eq(2) ul li input").each(function(index){
            
            if($(this).is(':checked'))
                save_filter_string+= 'CT='+(index+1);
        });
        $("input[type=radio][name='range_selection']").each(function(index){
            if($(this).is(':checked'))
                save_filter_string+= '&RS='+(index+1);
        });
        $(".mutliSelect:eq(1) ul li input").each(function(index){
            if($(this).is(':checked'))
                save_filter_string+= '&RD='+(index+1);
        });
        var hp = '&HP=';
        $(".mutliSelect:eq(3) ul li input").each(function(index){
            if($(this).is(':checked'))
                hp+=(hp.length>4?',':'')+(index+1)
        });
        save_filter_string+=(hp.length>4?hp:'');
        /*$(".mutliSelect:eq(3) .secondSelects-box > .secondSelect ul li input").each(function(index){
            if($(this).is(':checked'))
                save_filter_string+= '&ROCHL='+(index+1);
        });
        if($("#top_challenges").is(':checked') && $("#number_of_challenges").val() != "")
                save_filter_string+= ":"+$("#number_of_challenges").val();*/
        $(".mutliSelect:eq(0) .secondSelects-box > #agencydiv ul li input").each(function(index){
            if($(this).is(':checked'))
                save_filter_string+= '&ROAG='+(index+1);
        });
        
        if($("#pick_agency").is(':checked') && $("#agency_selection_box").val() != "")
            save_filter_string+= ":"+$("#agency_selection_box").val();
        if($("#top_agencies").is(':checked') && $("#number_of_agencies").val() != "")
            save_filter_string+= ":"+$("#number_of_agencies").val();
            
        save_filter_string+= $("#datepicker_start").val() != '' ? '&DPST='+$("#datepicker_start").val() : '';
        save_filter_string+= $("#datepicker_end").val() != '' ? '&DPEND='+$("#datepicker_end").val() : '';
        
        return save_filter_string;
      }

      $(".filter-delete").on('click', function () {
        if(confirm('Are you sure that you would like to delete "'+$(this).prev().html()+'"?'))
            delete_filters_ajax($(this).prev().html());
        return false;
      });

      $(".dropdown dt").on('click', function () {
          
          $(this).closest('dl.dropdown').find('dd > div > ul').slideToggle('fast');
          $(this).closest('dl.dropdown').find('dd > div > div.secondSelects-box').slideToggle('fast');
          return false;
      });

      $('#report_save_filters').on('click', function (e) {
        e.preventDefault();
        
        if($(this).html() == 'Click to save')
            save_filters_ajax($('#save_filter').val(), get_save_filters());
        
        else
        {
            $('#report_save_filters').html('Click to save');
            $('#save_filter_box').slideDown('fast');
        }
        return false;
      });

      $(".dropdown dd ul li a:not(.filter-delete)").on('click', function () {
         // $(".dropdown > dd > div > ul").hide();
      });

      function getSelectedValue(id) {
           return $("#" + id).find("dt a span.value").html();
      }
/*
      $(document).bind('click', function (e) {
          var $clicked = $(e.target);
          if (!$clicked.parents().hasClass("dropdown")) {
            $(".dropdown > dd > div > ul").hide();
            $('dd > div > div.secondSelects-box').hide();
          }
      });
*/
      $(document).keyup(function(e) {
          if (e.keyCode == 27) {
            $( ":focus" ).blur();
            $(".dropdown > dd > div > ul").slideUp('fast');
            $('dd > div > div.secondSelects-box').slideUp('fast');
           }
        });

      $('.mutliSelect:eq(2) input[type="checkbox"]').on('click', function () {
          updateCheckboxSelections($(this));
      });
      $('.mutliSelect:eq(0) input[type="radio"], .mutliSelect:eq(1) input[type="radio"], .mutliSelect:eq(3) input[type="radio"]').on('click', function () {
          updateRadioSelections($(this));
      });
      
    });
    </script>
    <?php

    $ret = ob_get_contents();
    ob_end_clean();
    return $ret;
}

add_shortcode('reporting-tool','reporting_tool_func');

add_action('wp_footer',function(){
    ?>
<script language="javascript" type="text/javascript">
    
    function delete_filters_ajax(this_filter)
    {
        jQuery.ajax({
            type : 'post',
            url: "<?php echo admin_url('admin-ajax.php');?>",
            data: {
                'action' : 'delete_filters_func',
                'delete_this' : this_filter,
                'loadthrough' : 'ajaxcall',
            },
            beforeSend: function(){
                $("ul.saved-filters li a.saved-filter").each(function(){
                    if($(this).text()==this_filter){
                        // $(this).closest('li').empty();
                        $(this).closest('li').prepend('<div class="small-ajax"><img id="loading" src="<?php echo get_bloginfo('template_directory'); ?>/images/ajax-loader-small.gif" /></div>');
                    }
                });
            },
            success: function(response){
                if(response==0)
                {

                }
                $("ul.saved-filters li a.saved-filter").each(function(){
                    if($(this).text()==this_filter){
                        $(this).closest('li').fadeOut(500, function(){
                            $(this).remove();
                            if(!$.trim( $("ul.saved-filters").html() ).length)
                            {
                                $("ul.saved-filters").closest('.reporting-filter-box').fadeOut(500, function(){
                                    //$(this).remove();
                                });
                                
                            }
                        });
                    }
                });
                $('ul.saved-filters li a.saved-filter').on('click', function () {
                
                    $('ul.saved-filters li').removeClass();
                    $(this).closest('li').addClass("active-filters"); 
                    var filter_val = $(this).attr('filter-value');
                            var filter_vars = filter_val.split('&');
                    $(".mutliSelect:eq(3) ul li input:eq(0)").prop('checked', false);
                    $(".mutliSelect:eq(3) ul li input:eq(1)").prop('checked', false);
                    $("#agency_selection_box").find('option:selected').removeAttr("selected");
                    for (var i = 0; i < filter_vars.length; i++) 
                    {
                        var filter_param = filter_vars[i].split('=');
                        
                        if(filter_param[0]=='ROAG')
                        {
                             var a = filter_param[1].split(':');
                  
                            $(".mutliSelect:eq(0) #agencydiv .secondSelect ul li input:eq("+(a[0]-1)+")").prop('checked', true);                  
                                                        
                            if(a[0] == '1' && a[1] != undefined) {
                                $("#agency_selection_box").val(a[1]);
                                decide_chart('agency_selection','filterthrough',filter_val);
                            }
                            if(a[0] == '2' && a[1] != undefined)
                            {
                                $("#number_of_agencies").val(a[1]);
                                decide_chart('top_agencies','filterthrough',filter_val);
                            }
                           
                            
                        }
                    }
                });

            },
            error: function(){

            }
        });
    }

    function save_filters_ajax(save_as, these_filters)
    {
        jQuery.ajax({
            type : 'post',
            url: "<?php echo admin_url('admin-ajax.php');?>",
            data: {
                'action':'save_filters_func',
                'saveas': save_as,
                'filters': these_filters,
                'loadthrough' : 'ajaxcall',
            },
            beforeSend: function($){
                jQuery('.chart-menu-buttonRow').hide();
                jQuery('#report_save_id').show().html('<img id="loading" src="<?php echo get_template_directory_uri();?>/images/ajax-loader-small.gif" />');
                //jQuery('#ganttchart').prepend('<img id="loading" src="<?php echo get_bloginfo('template_directory');?>/images/ajax-loader.gif" />');
            },
            success : function( response ) {
                jQuery('.chart-menu-buttonRow').show();
                jQuery('#report_save_id').hide();
                jQuery("#report_save_filters").fadeIn().html('Save Filters');
                //jQuery('#ganttchart').fadeIn().html(response);
                jQuery("#save_filter_box").hide();
                jQuery("#save_filter").val('');
                if(jQuery("ul.saved-filters li").length < 1){
                    jQuery(".reporting-filter-box:eq(0)").show();
                    jQuery(".saved-filters").show();
                }
                
                jQuery("ul.saved-filters").append('<li><a href="#" class="saved-filter" filter-value="'+these_filters+'">'+save_as+'</a><a href="#" class="filter-delete">Delete</a></li>');
               location.reload(); 
               
               if (response==0) {
                //jQuery('#ganttchart').show().html("Sorry, No data found!");
                //if 0, show validation errors - i.e. enter a name
               }
            },
            error : function(  ) {

            }
        });
    }
   
    function delete_followers(userid,challengeid)
    {
        jQuery.ajax({
            type : 'post',
            url: "<?php echo admin_url('admin-ajax.php');?>",
            data: {
                'action':'delete_followers_func',
                'userid': userid,
                'challengeid': challengeid,
                'loadthrough' : 'ajaxcall',
            },
            beforeSend: function($){
                jQuery('#challenge_followers').empty();
                jQuery('#challenge_followers').prepend('<img id="loading" src="<?php echo get_bloginfo('template_directory');?>/images/ajax-loader.gif" />');
            },
            success : function( response ) {
                jQuery('#challenge_followers').empty();
                jQuery("#challenge_followers").html(response);
                jQuery(".selection-check-challenge input").unbind();
                jQuery(".selection-check-challenge input").click(function(){
                    var userandchid=(jQuery(this).attr('customid'));
                    var userchidarray=userandchid.split("||");
                    delete_followers(userchidarray[0],userchidarray[1]);
              
                })
               
               if (response==0) {
                jQuery("#challenge_followers").html("Sorry! an error occurs while processing your request!");
               }
            },
            error : function(  ) {

            }
        });
    }
</script>
 <?php
});
add_action("wp_ajax_delete_followers_func", "delete_followers_ajax_func");
add_action("wp_ajax_nopriv_delete_followers_func", "delete_followers_ajax_func");
function delete_followers_ajax_func()
{

$user_ID = $_POST['userid'];
$challengeid= $_POST['challengeid'];

    $user_followed_challenges = get_post_meta( $challengeid, 'followed_challenges', 1);
  
    if($user_followed_challenges!="")
    {
        
        if(in_array($user_ID,$user_followed_challenges))
        {
            $key=array_search($user_ID,$user_followed_challenges);
            unset($user_followed_challenges[$key]);
        }
       
    }
    update_post_meta($challengeid, 'followed_challenges', $user_followed_challenges);
    echo do_shortcode( '[followed-challenge-of-user author="'.$user_ID.'"]');
    
    exit;
}
function save_filters_ajax_func()
{
   $save_as=$_POST["saveas"];
   $user_id = get_current_user_id();
   $filters = $_POST['filters'];

   if(empty($save_as) || empty($filters) || $user_id == '0')
   {
    echo '0';
    exit;
   }
   $saved_filters = get_user_meta($user_id, 'saved_filters',1);
   $inc = 2;
   $orig_save = $save_as;
   while(array_key_exists($save_as,$saved_filters)){
        $save_as = $orig_save." #".$inc;
        $inc++;
    }
    $saved_filters[$save_as] = $filters;
   update_user_meta($user_id, 'saved_filters', $saved_filters);
   echo '1';
   exit;
}
add_action("wp_ajax_save_filters_func", "save_filters_ajax_func");
add_action("wp_ajax_nopriv_save_filters_func", "save_filters_ajax_func");

function delete_filters_ajax_func()
{

   $delete_this = $_POST["delete_this"];
   $user_id = get_current_user_id();

   if(empty($delete_this) || $user_id == '0')
   {
    echo '0';
    exit;
   }

   $saved_filters = get_user_meta($user_id, 'saved_filters', 1);

   if(isset($saved_filters[$delete_this]))
    unset($saved_filters[$delete_this]);
    
   if(update_user_meta($user_id, 'saved_filters', $saved_filters))
    echo '1';
   else
    echo '0';
   
   exit;
}
add_action("wp_ajax_delete_filters_func", "delete_filters_ajax_func");
add_action("wp_ajax_nopriv_delete_filters_func", "delete_filters_ajax_func");

function saved_filters_func()
{
    ob_start();
    if(is_user_logged_in()):
    $saved_filters = get_user_meta(get_current_user_id(), 'saved_filters',1);
    if(empty($saved_filters)){
        ?>
        <style type="text/css">
            #challenge-reporting-container .reporting-filter-box:nth-of-type(1){
              display: none;
            }
        </style>
        <?php
    }
    
    ?>
    <div class="reporting-filter-box">
    <div id="view_author_title" style="display:none;">Saved Filters</div>
    <div id="sides">
    <dl class="dropdown">
    <dt>
    <a href="#">
      <span class="hida">Select A Saved Filter</span>    
      <p class="multiSel"></p>  
    </a>
    </dt>
    <dd>
        <div class="savedSelect">
            <ul class="saved-filters">
                <?php
                if(!empty($saved_filters))
                {
                    foreach($saved_filters as $this_filter => $filter_value)
                        echo '<li><a href="#" class="saved-filter" filter-value="'.$filter_value.'">'.$this_filter.'</a><a href="#" class="filter-delete">Delete</a></li>';
                }
                ?>
            </ul>
        </div>
    </dd>
    </dl>
    </div>
    </div>
    <?php
    endif;
    $ret = ob_get_contents();
    ob_end_clean();
    return $ret;
}
add_shortcode('saved-filters','saved_filters_func');

function display_followers_of_challenge($atts)
{
    $challnegid=$atts['challenge_id'];
    
    
    $user_followed_challenges = get_post_meta($challnegid, 'followed_challenges', 1);
    
   if(isset($user_followed_challenges) && $user_followed_challenges!="")
    {
        
        $size = 'medium';
        $flag=0;
        $pub_cnt=0;
        $follower_cnt=0;
        $output =  '<div class="">';

        foreach($user_followed_challenges as $key=>$userid)
        {
        if($userid!=0)
        {   

                $follower_cnt++;  
            }
        }
        foreach($user_followed_challenges as $key=>$userid)
        {
                $user_profile_priv_pub=get_user_meta($userid,'is_profile_public');

                if($user_profile_priv_pub[0]=="public")
                {
                    $pub_cnt++;
                }
        }


        $priv_profile_cnt=$follower_cnt-$pub_cnt;
        $output .='<div id="sides"><div id="author_left"><b>Public Profile:</b> '.$pub_cnt.'</div><div id="author_right"><b>Private Profile:</b> '.$priv_profile_cnt.'</div></div>';
        $output .='<div class="col-md-12 col-sm-12 col-xs-12">';

        foreach($user_followed_challenges as $key=>$userid)
        {
            $user_profile_priv_pub=get_user_meta($userid,'is_profile_public');
            if($user_profile_priv_pub[0]=="public")
            {
                   
                $flag=1;
                $userinfo=get_userdata( $userid );
                
                $user_photo_priv_pub=get_user_meta($userid,'is_photo_public');
                
                if ($user_photo_priv_pub[0] =="public"){
                    $imgURL = get_cupp_meta($userid, $size);
                }
                else{
                    $imgURL="";
                }
                if($imgURL=="")
                {
                    $defaultimageurl=get_bloginfo('template_directory')."/images/default_user.png";
                    $assigned_imageurl=$defaultimageurl;
                }
                else{
                    $assigned_imageurl= $imgURL;
                }  
                    
                $output .=  '<div class="col-md-4 col-sm-6 col-xs-12"><div class="challenge-follower-thumbs">';
                $output .=           '<img src="'.$assigned_imageurl.'" alt="'.$userinfo->user_login.'">';
                $output .=      '<h4><div class="prize"><a href="'.get_site_url().'/profile/'.$userinfo->user_login.'">'.$userinfo->user_login.'</a></div></h4>' ;
                $output .= '</div></div>';
                    
            }
            
        }
        $output .= '</div></div>';
        if($flag==0)
        {
            $output .= "";
        }
        
        
    }
    else{
        $output .= "No followers found.";
    }
   
    echo $output;
    
}
add_shortcode('display-followers','display_followers_of_challenge');

function followed_challenge_display_posts($atts)
{
    $userid=$atts['author'];
    $followed_challenges=get_meta_values('followed_challenges','challenge');
   
    if(isset($followed_challenges) && $followed_challenges!="")
    {
         foreach($followed_challenges as $post_id=>$userids)
        {
            $follower_array=unserialize($userids);
            if(in_array($userid,$follower_array))
            {
                 $challengeid_array[]=$post_id;
            }
        }
 
        if(empty($challengeid_array) || $challengeid_array=="")
    {
    
        echo "<center><strong>No followed challenge is found.</strong></center>";
    }
    else
    {
            $challengeids=implode(",",$challengeid_array);
            echo '<div id="challenge_followers"><div class="thumbnails profile-thumbnails">';
        echo do_shortcode('[challenge-display-posts which_page="profile" followerid='.$userid.' post_type="challenge" id='.$challengeids.']');
            
            echo '</div></div>';
            
    }
    } 
    else{
        echo "<center><strong>No followed challenge is found.</strong></center>";
    }
   
}
add_shortcode( 'followed-challenge-of-user', 'followed_challenge_display_posts' );

function sl_display_posts_shortcode( $atts ) {

    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
        $secure_connection = 's';
    }
    else
        $secure_connection = '';

   // $default_img_url = "http".$secure_connection."://www.challenge.gov/files/2013/12/default-image.gif";
    $original_atts = $atts;
    //if(strpos(get_site_url('http'), "http://localhost/") !== false || strpos(get_site_url('http'), "http://sites.usa.local") !== false || strpos(get_site_url(), "https://staging.platform") !== false) //override if local dev
        $default_img_url = get_template_directory_uri().'/images/default-image.gif';

    // Pull in shortcode attributes and set defaults
    $atts = shortcode_atts( array(
        'author'              => '',
        'category'            => '',
        'challenge_id'        => '',
        'container_class'     => '',
        'date_format'         => '(n/j/Y)',
        'id'                  => false,
        'ignore_sticky_posts' => false,
        'image_size'          => false,
        'include_content'     => false,
        'include_date'        => false,
        'include_excerpt'     => false,
        'item_class'          => '',
        'meta_key'            => '',
        'no_posts_message'    => '',
        'offset'              => 0,
        'order'               => 'DESC',
        'orderby'             => 'date',
        'post_parent'         => false,
        'post_status'         => 'publish',
        'post_type'           => 'solution',
        'posts_per_page'      => '10',
        'return_found'        => false,
        'tag'                 => '',
        'tax_operator'        => 'IN',
        'tax_term'            => false,
        'taxonomy'            => false,
        'view_as'             => 'grid',
        'wrapper'             => 'div',
    ), $atts );

    $author = sanitize_text_field( $atts['author'] );
    $category = sanitize_text_field( $atts['category'] );
    $challenge_id = $atts['challenge_id'];
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
    $post_parent = $atts['post_parent']; // Validated later, after check for 'current'
    $post_status = $atts['post_status']; // Validated later as one of a few values
    $post_type = sanitize_text_field( $atts['post_type'] );
    $posts_per_page = intval( $atts['posts_per_page'] );
    $return_found = sanitize_key( $atts['return_found'] );
    $tag = sanitize_text_field( $atts['tag'] );
    $tax_operator = $atts['tax_operator']; // Validated later as one of a few values
    $tax_term = sanitize_text_field( $atts['tax_term'] );
    $taxonomy = sanitize_key( $atts['taxonomy'] );
    $view_as = sanitize_key( $atts['view_as'] );
    $wrapper = sanitize_text_field( $atts['wrapper'] );


    // Set up initial query for post
    $args = array(
        //'category_name'       => $category,
        //'order'               => $order,
        //'orderby'             => $orderby,
        'post_type'           => 'solution',
        'posts_per_page'      => -1,
        //'tag'                 => $tag,
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
        $args['author_name'] = $author;

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
    if ( !empty( $challenge_id) ) {
        $meta_args = array(
            'meta_key' => 'challenge_id',
            'meta_query' => array(
                array(
                    'key' => 'challenge_id',
                    'value' => (int)$challenge_id,
                ))
        );
        $args = array_merge( $args, $meta_args );
    }

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

        $args = array_merge( $args, $tax_args );
    }

    $listing = new WP_Query( apply_filters( 'display_posts_shortcode_args', $args, $original_atts ) );
    if($return_found)
    {
        return !empty($listing->found_posts) ? $listing->found_posts : 0;
    }
    else
        if ( ! $listing->have_posts() )
            return apply_filters( 'display_posts_shortcode_no_results', wpautop( $no_posts_message ) );

    $wrapper_options = array( 'ul', 'ol', 'div' );
    if( ! in_array( $wrapper, $wrapper_options ) )
        $wrapper = 'ul';
    $inner_wrapper = 'div' == $wrapper ? 'div' : 'li';

    $inner = '';

    if($return_found)
    {
        return !empty($listing->found_posts) ? $listing->found_posts : '0';
    }

    $dt = DateTime::createFromFormat('U', time());
    $dt->setTimeZone(new DateTimeZone('America/New_York'));
    $adjusted_timestamp = $dt->format('U') + $dt->getOffset();

    while ( $listing->have_posts() ): $listing->the_post();
        global $post;

        $image = $date = $excerpt = $content = '';

        //$ext_url = get_field('external_url');
        //$link_out = empty($ext_url) ? apply_filters( 'the_permalink', get_permalink() ) : $ext_url;
        $link_out = apply_filters( 'the_permalink', get_permalink() );

        $title = '';
        if($post->post_status == 'draft' || $post->post_status == 'pending')
            $title.= " <span style=\"color:red;\">(HIDDEN) </span>";
        $title .= '<a class="title" href="' . $link_out . '">' . apply_filters( 'the_title', get_the_title() ) . '</a>';

        if($view_as == 'list')
        {
            echo $title."<br/>";
            continue;
        }

        if ( $image_size && has_post_thumbnail() )
            $image = '<a class="image" href="' . $link_out . '">' . get_the_post_thumbnail( $post->ID, $image_size ) . '</a> ';

        if ( $include_date )
            $date = ' <span class="date">' . get_the_date( $date_format ) . '</span>';

        if ( $include_excerpt )
            $excerpt = ' <span class="excerpt-dash">-</span> <span class="excerpt">' . get_the_excerpt() . '</span>';

        if( $include_content )
            $content = '<div class="content">' . apply_filters( 'the_content', get_the_content() ) . '</div>';

        $class = array( 'listing-item', $item_class );
        $class = apply_filters( 'display_posts_shortcode_post_class', $class, $post, $listing );

        $public_voting_start = get_field('public_voting_start', $challenge_id);
        $public_voting_end = get_field('public_voting_end', $challenge_id);

        $rating = "";
        $show_rating = true;
        $not_started = false;

        if($public_voting_start) {
            if($public_voting_start >= $adjusted_timestamp){
                $show_rating = false;
                $not_started = true;
            }
        }
        if($public_voting_end){
            if($public_voting_end <= $adjusted_timestamp)
                $show_rating = false;
        }
        $pub_voting_status = get_field('enable_public_voting',$challenge_id);

        if(($pub_voting_status != "off") && $show_rating){
            if(function_exists('the_ratings')) {  $rating .= the_ratings('div',0,false); }
        }
        if(($pub_voting_status != "off") && !$show_rating)
        {
            if(function_exists('the_ratings')) {  $rating .= the_rating_passive('div', 0, false); }
        }

        $logo_new = get_field('image_logo');
        $logo_in = !empty($logo_new) ? $logo_new['url'] : $default_img_url;

        $tagline_new = get_field('tag-line');
        $tagline_in = !empty($tagline_new) ? "<span class=\"front-challenge-tagline\">".$tagline_new."</span>" : "";


        //$output = '<div class="front-challenge-item-container"><' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">'.'<a href="' . $link_out . '"><img src="'.$logo_in.'" class="front-challenge-img"></a><div class="front-challenge-innertext">' . $image . $title . $date . $excerpt . $content . $tagline_in . $rating . '</div></' . $inner_wrapper . '>';
        //$output .='<div class="front-challenge-summary"><div class="front-challenge-summary-inner"><span class="summary-item-text">'.strip_tags(substr(get_field('description'),0,100)).'</span></div></div></div><div class="clear"></div>';

        //if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$post->ID,'category-id') || get_current_user_id() == $post->post_author)))
        if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency')))
            $edit_link = '<span class="edit-challenge-link"><a href="'.add_query_arg( 'edit-solution', 'true', get_permalink($listing->ID) ).'">Edit</a></span>';
        //start challenge_gov_theme
        $output =  '<div class="col-md-4 col-sm-4 col-xs-12">';
        $output .=    '<div class="solution-thumbnail-header">';
        $output .=      '<h4>'.$title.'</h4>';
        $output .=    '</div>';
        $output .=       '<div class="challenge-thumbnail">'.$edit_link;
        $output .=           '<img src="'.$logo_in.'" alt="'.get_the_title().'">';
        $output .=          '<div class="caption">';
        $output .=                 '<div class="prize"><a href="'.$link_out.'">View this solution</a></div>';
        $output .=                     '<div>'.$tagline_in.'</div>';
        $output .=                     $pub_voting_status == 'off' ? '' : ($not_started ? '' : $rating);
        $output .=                     '<div>'.strip_tags(substr(get_field('description'),0,100)).'</div>';
        $output .=           '</div>';
        $output .=           '';
        $output .=              '';
        $output .=                  '';
        $output .= '</div></div>';
        //end challenge_gov_theme


        // If post is set to private, only show to logged in users
        if( 'private' == get_post_status( $post->ID ) && !current_user_can( 'read_private_posts' ) )
            $output = '';

        $inner .= apply_filters( 'display_posts_shortcode_output', $output, $original_atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class );
      
    endwhile; wp_reset_postdata();

    $open = apply_filters( 'display_posts_shortcode_wrapper_open', '<' . $wrapper . ' class="display-posts-listing '.$container_class.'">', $original_atts );
    $close = apply_filters( 'display_posts_shortcode_wrapper_close', '</' . $wrapper . '>', $original_atts );
    $return = $open . $inner . $close;

    return $return;
}
add_shortcode( 'display-solution', 'sl_display_posts_shortcode' );

include_once('recover-password.php');
add_shortcode('wppb-recover-password', 'challenge_front_end_password_recovery');

function resend_confirmation_email($atts)
{
    global $wpdb;
    $username=$atts['userid'];
    $useremail=$atts['useremail'];
    if ( is_multisite() )
        $signup = $wpdb->get_row("SELECT * FROM " . $wpdb->signups . " WHERE user_login = '" . $username . "' or user_email='".$useremail."'");
    else
        $signup = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "signups WHERE user_login = '" . $username . "' or user_email='".$useremail."'");
    
   
    $user = $signup->user_login;
    $user_email = $signup->user_email;
    $key = $signup->activation_key;
    $meta = $signup->meta;
   
    $send=challenge_send_requested_email($user, $user_email, $key, $meta);
    exit;
}
add_shortcode('request-for-new-email','resend_confirmation_email');
function show_categories()
{
    $field = get_field_object('field_5293da669ef07');
		
		if (isset($field["choices"]))
		{
			
			
		    foreach ($field["choices"] as $key => $choice) {
			
			if(!empty($choice))
			{
			    $this_link = challenge_strip_page(add_query_arg( 'type', $key ));
			    ?>
			    <div class="checkbox">
			    <label>
			      <input type="checkbox" value="<?php echo $key; ?>" name="challenge_type" checked><?php echo $choice; ?>
			    </label>
			  </div>
			    <?php
			    $i++;
			    
			}
		    }
		}
}
add_shortcode('display-categories','show_categories');

add_action("wp_ajax_preview_newsletter_func", "preview_newsletter_func");
add_action("wp_ajax_nopriv_preview_newsletter_func", "preview_newsletter_func");

function preview_newsletter_func(){
    $template_id = intval('0'.$_POST['template']);
    $content = $_POST['content'];
    $type = $_POST['type'];
    $title = $_POST['title'];
    $num = $_POST['num_chal'];
    //$scheduled = $_POST['scheduled'];

    $debug = get_option('challenge_mailchimp_debug','');
    $get_apikey = get_option('ChallChimp_api','');

    //$template_id = intval('0'.$_POST['newsletter-preview']);

    if (!class_exists('Challenge_Mailchimp_V2')) {
        require_once(ABSPATH.'wp-content/plugins/challenge-mailchimp/challenge-mailchimp-api2.0.class.php');
    }
    if(class_exists('Challenge_Mailchimp_V2')){
        $mailchimp2 = new Challenge_Mailchimp_V2($get_apikey);
        $template = $mailchimp2->call('templates/info',array('template_id'=>$template_id,'user'));
        $challenges = '';
        //error_log(print_r($template,1));
        echo $template['source'];
        if($type == 'agency' && $num > 0){
            $challenges = do_shortcode('[newsletter_challenge_items agency="'.$title.'" num="'.$num.'"]');
            //$challenges = preg_replace('/[ \t]+/', ' ', preg_replace('/[\r\n]+/', "\n", $challenges));
            $challenges = str_replace("\n","",$challenges);
            $challenges = str_replace("\r","",$challenges);
        }
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('#newsletter-content').html('<?php echo trim($content); ?>');
                <?php
                if($type == 'agency'){
                    ?>
                $('#challenges-container').empty();
                $('#challenges-container').html($.trim('<?php echo trim(html_entity_decode($challenges)); ?>'));
                <?php
                }
                if($type == 'challenge' || empty($challenges)){
                    ?>
                $('#challenges-container').empty();
                <?php
                }
                ?>
            });
        </script>
        <?php
    }
    exit;
}

function challenge_newsletter_func($atts)
{
    //error_log(print_r($_POST,1));
    extract(shortcode_atts(array(
        'type' => '',
    ), $atts));

    if($type == 'admin' && !current_user_can('create_users'))
    {   
        print '<META http-equiv="refresh" content="5;URL='.site_url('list').'">';
        print '<div class="external_challenge">This page is for administrators only. <a class="external_link_path" href="' .site_url('list'). '">Click here to return home</a></div>';
        print '<div class="external_link_timer">You will be redirected in <span class="internal_timer">5</span> seconds.</div>';
        exit;
    }
    if ( is_plugin_active( 'challenge-mailchimp/challenge_mailchimp.php' ) ) {
        
        $debug = get_option('challenge_mailchimp_debug','');
        $get_apikey = get_option('ChallChimp_api','');

        if(!class_exists('Challenge_Mailchimp'))
            require_once(ABSPATH.'wp-content/plugins/challenge-mailchimp/challenge-mailchimp.class.php');
        
        if(class_exists('Challenge_Mailchimp')){
            $mailchimp = new Challenge_Mailchimp($get_apikey);

        $templates_list = $mailchimp->get('templates',array('type'=>'user'));
        $templates = $mailchimp->get('templates');
        //error_log(print_r($templates,1));
        //$this_chal_temp = $mailchimp->get('templates/169905');

        if (!class_exists('Challenge_Mailchimp_V2')) {
            require_once(ABSPATH.'wp-content/plugins/challenge-mailchimp/challenge-mailchimp-api2.0.class.php');
        }
        if(class_exists('Challenge_Mailchimp_V2')){
            $mailchimp2 = new Challenge_Mailchimp_V2($get_apikey);

            $template = array();
            
            if(isset($_POST['newsletter_save']))
            {
                //error_log($_POST['newsletter_send_select']);
                //error_log($_POST['challenge_newsletter_content']);
                //error_log($_POST['challenge_template_id']);
                //error_log($_POST['newsletter_schedule_datepicker']);
                
                $args = array(
                    'type' => 'regular',
                    'options' => array(
                        'list_id' => '67a951db77',
                        'subject' => 'Newsletter from Challenge',
                        'from_email' => 'challenge@gsa.gov',
                        'from_name' => 'Challenge.gov',
                        'template_id' => $_POST['challenge_template_id']
                        ),
                    'content' => array(
                        'sections' => array(
                            'std_preheader_content' => 'Test Pre Header Content!',
                            'std_content00' => $_POST['challenge_newsletter_content'],
                            )
                        )
                    );
                //$campaign = $mailchimp2->call('campaigns/create',$args);
                /*
                $args = array(
                    'cid' => $campaign['id'],
                    'schedule_time' => date('Y-m-d H:i:s',strtotime($_POST['fields[field_565f08df357aa]'])),
                    );
                */
                //$campaign_schedule = $mailchimp2->call('campaigns/schedule',$args);
            }
        }
        ?>
        <script type="text/javascript">
            
            jQuery(document).ready(function($) {
                $('#challenge-newsletter-form #acf-field-from_email').prop('readonly', true);
                $('#challenge-newsletter-form #acf-field-from_email').css({'background':'#ccc'});
                $(".newsletter-zoom-in").on('click', function(evt){
                    evt.stopPropagation();
                    $("#challenge-newsletter-send-wrapper").prepend('<div class="challenge-newsletter-template-zoom"><img src="'+$(this).siblings('img').attr('src')+'"></div>');
                    if($(this).parent().hasClass('selected-newsletter'))
                        $(".challenge-newsletter-template-zoom").css({'border':'5px solid #BCF5A9'});
                    $(".challenge-newsletter-template-zoom").fadeIn();
                    return false;
                });
                $(".select-newsletter-template").on('click', function(){
                    if($(this).hasClass('selected-newsletter')){
                        $(this).removeClass('selected-newsletter');
                    }else{
                        $(".select-newsletter-template").removeClass('selected-newsletter');
                        $(this).addClass('selected-newsletter');
                    }
                    return false;
                });
                $("#newsletter-submit-approval").on('click', function(){
                    if(!$.trim($('#acf-scheduled input.ps_timepicker').val()))
                    {
                        alert('Please enter a scheduled date to send this newsletter before submitting for approval.')
                    }else{
                        if($.isNumeric($('.selected-newsletter').attr('newsletter-id')) && !$.trim($("input#acf-field-title").val()) == ''){
                            $('<input>').attr({
                                type: 'hidden',
                                name: 'submit-for-approval',
                                value: 'Y',
                            }).appendTo('#challenge-newsletter-form');
                            alert('By submitting your newsletter for approval your newsletter will be evaluated by the Challenge.gov team. If approved, your newsletter will be sent out at the scheduled time. If you have any questions or if this is a rush newsletter please contact us at challenge@gsa.gov.');
                        }
                        $("#challenge-newsletter-form #poststuff input[type='submit']").click();
                    }
                    return false;
                });
                $("#newsletter-preview").on('click', function(){
                    if($.isNumeric($('.selected-newsletter').attr('newsletter-id'))){
                        var shownum = 0;
                        if($("#acf-field-include_recent_challenges-1").is(":checked")){
                            if($("#acf-field-number_of_challenges").val() != '')
                            {
                                if($("#acf-field-number_of_challenges").val().toLowerCase() == 'all')
                                    shownum = -1
                                else
                                    shownum = $("#acf-field-number_of_challenges").val();
                            }
                                
                        }
                        preview_newsletter_ajax($('.selected-newsletter').attr('newsletter-id'),$("iframe[id^='wysiwyg-acf-field-content-']").contents().find('#tinymce').html(),'<?php echo $type; ?>','<?php echo get_the_title(); ?>',shownum);
                    }else{
                        alert('Please select a template to preview the newsletter.');
                    }
                    return false;
                });
                
                $("#challenge-newsletter-form").submit(function(e){
                    
                    if(!$.isNumeric($('.selected-newsletter').attr('newsletter-id'))){
                        alert('Please select a template before saving the newsletter.');
                        return false;
                    }
                    if($.trim($("input#acf-field-title").val()) == ''){
                        alert('Please enter a title before saving the newsletter.');
                        return false;
                    }
                    $("#acf-field-template_id").val($('.selected-newsletter').attr('newsletter-id'));
                    <?php
                    if($type == 'admin' || $type == 'challenge'){
                        ?>
                    if($("input[name='sendto-challenge-submitters']").is(':checked') && !$("input[name='sendto-challenge-followers']").is(':checked'))
                        $("#acf-field-recipients").val('Challenge Submitters');
                    if($("input[name='sendto-challenge-followers']").is(':checked') && !$("input[name='sendto-challenge-submitters']").is(':checked'))
                        $("#acf-field-recipients").val('Challenge Followers');
                    if($("input[name='sendto-challenge-submitters']").is(':checked') && $("input[name='sendto-challenge-followers']").is(':checked'))
                        $("#acf-field-recipients").val('Challenge Followers and Submitters');
                    <?php
                    }
                    if($type == 'agency'){
                        ?>
                        $("#acf-field-recipients").val('Agency Subscribers');
                        <?php
                    }
                    if($type != 'admin'){
                        ?>
                    $("#acf-field-newsletter_for").val('<?php echo ucfirst($type).": ".get_the_title(); ?>');
                    $("#acf-field-newsletter_for_id").val('<?php echo get_the_ID(); ?>');
                    <?php
                    }else{
                        ?>
                    $("#acf-field-newsletter_for").val($("#admin-select-newsletter").val().replace(/(-\s)*Agency/g,'Agency'));

                    <?php
                    }
                    ?>
                    //$('.selected-newsletter').attr('newsletter-id')
                });
                $(document).keyup(function(e) {
                    if (e.keyCode == 27){
                      if($('.challenge-newsletter-template-zoom').is(':visible')){
                        $('.challenge-newsletter-template-zoom').fadeOut();
                        $('.challenge-newsletter-template-zoom').remove();
                      }
                    }
                });

                function preview_newsletter_ajax(template_id, content, type, title, num_challenges)
                {
                    jQuery.ajax({
                        type : 'post',
                        url: "<?php echo admin_url('admin-ajax.php');?>",
                        data: {
                            'action':'preview_newsletter_func',
                            'template': template_id,
                            'content': content,
                            'type' : type,
                            'title' : title,
                            'num_chal' : num_challenges,
                            'loadthrough' : 'ajaxcall',
                        },
                        beforeSend: function($){
                            jQuery('<div />', {
                                id:   'template-preview',
                            }).prependTo('body');
                            jQuery('<div />', {
                                id:   'overlay',
                            }).prependTo('body');
                        },
                        success : function( response ) {
                            //$("div#template-preview").load('<?php echo plugins_url(); ?>/challenge-mailchimp/preview.php?newsletter-preview=164773').ready(function(){
                            jQuery("div#template-preview").html(response);
                                //jQuery('div#template-preview').contents().find("#std_content00").html(content);
                            jQuery('div#template-preview').fadeIn('slow');
                            //});
                            //jQuery("ul.saved-filters").append('<li><a href="#" class="saved-filter" filter-value="'+these_filters+'">'+save_as+'</a><a href="#" class="filter-delete">Delete</a></li>');
                            //location.reload();
                            $(document).keyup(function(e) {
                                if (e.keyCode == 27){
                                  if(jQuery('#template-preview').is(':visible')){
                                    jQuery('div#overlay').fadeOut();
                                    jQuery('div#overlay').remove();
                                    jQuery('#template-preview').fadeOut('slow', function(){
                                        jQuery('#template-preview').remove();  
                                    });
                                  }
                                }
                            });
                            $('html, body').animate({ scrollTop: 0 }, 'fast');
                        },
                        error : function(  ) {

                        }
                    });
                }
            });
        </script>
        <style type="text/css">
            #template-preview{
                display:none;
                z-index:100001;
                position:absolute;
                /*height:100%;*/
                width:80%;
                top:0;
                left:10%;
                background: #ccc;
            }
            input[name="newsletter_schedule_datepicker"]{
                display:none;width:300px;
            }
            .ui-slider .ui-slider-handle{background:none;}
            .ui-slider-horizontal .ui-slider-handle{top:1px !important;}
            .select-newsletter-template{position:relative;}
            .newsletter-zoom-in{
                background: url(<?php echo get_template_directory_uri(); ?>/images/newsletter-zoom-in.png) no-repeat center;
                background-size: 16px;
                width:32px;
                height:32px;
                display:inline-block;
                position:absolute;
                bottom:0;
                right:0;
                z-index:3;
            }
            .challenge-newsletter-template-zoom{display:none;max-width:500px;position:absolute;z-index:4;border:5px solid #bbb;}
            .challenge-newsletter-template-zoom img{max-width:100%;}
            .select-newsletter-template{display:inline-block;max-width:175px;border:5px solid #fff;margin:10px 5px;}
            .select-newsletter-template:hover{border:5px solid #bbb;}
            .select-newsletter-template img{max-width:100%;}
            .selected-newsletter, .selected-newsletter:hover{border:5px solid #BCF5A9;}
            #overlay {
                position: fixed; 
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: #000;
                opacity: 0.5;
                filter: alpha(opacity=50);
                z-index:100000;
            }
            #acf-approved, #acf-template_id,
            #acf-recipients, #acf-newsletter_for, #acf-newsletter_for_id,
            #acf-unapproved, #acf-why_unapproved{display:none;}
            <?php
            if($type=="challenge"){
                ?>
                #acf-number_of_challenges, #acf-include_recent_challenges{
                    display:none;
                }
                <?php
            }
            ?>
            #acf-scheduled input[type="text"]{width:250px;}
            #newsletter-preview,
            #newsletter-submit-approval,
            #poststuff input[type="submit"]{
                background-color: #f80;border: solid 1px #ccc;padding:8px 12px;border-radius:4px;
            }
            #newsletter-preview{
                position: absolute;
                margin-left: 150px;
                margin-top: -38px;
            }
            #newsletter-submit-approval{
                position: absolute;
                margin-left: 232px;
                margin-top: -38px;
            }
            #challenge-newsletter-form{
                margin-bottom:0;
                padding-bottom:0;
            }
            #challenge-newsletters-listing_wrapper{
                padding:0px 15px;
            }
            table#challenge-newsletters-listing{
                border-color: #CCC #CCCCCC #DFDFDF;
                border-style: solid;
                border-radius: 3px 3px 0 0;
                border-width: 1px;
            }
            table#challenge-newsletters-listing tr.newsletter-approved{
                background-color:#D8F6CE;
            }
            table#challenge-newsletters-listing tr.newsletter-unapproved{
                background-color:#F5BCA9;
            }
            table#challenge-newsletters-listing tr.newsletter-sent{
                background-color:#F2F5A9;
            }
            table#challenge-newsletters-listing thead th, table#challenge-newsletters-listing thead td{
                border-bottom:1px solid #CCC;
            }
            table#challenge-newsletters-listing tbody{
                color:#222;
                font-size:12px;
            }
            .editing-newsletter{width:100%;text-align:center;font-size:18px;font-weight:bold;}
        </style>
        <!-- <div class="container" style="background:#fff;padding:20px 10px;"> -->
            <!-- <form id="challenge-newsletter-send-form" action="" method="POST"> -->
            <div id="challenge-newsletter-send-wrapper">
                <div><strong>Send to</strong></div>
                <div style="padding-left:20px;margin-bottom:20px;">
                    <?php
                    if($type=="challenge"){
                        ?>
                        <input type="checkbox" name="sendto-challenge-submitters">&nbsp;&nbsp;Challenge Submitters<br/>
                        <input type="checkbox" name="sendto-challenge-followers">&nbsp;&nbsp;Challenge Followers
                        <?php
                    }
                    if($type=="agency"){
                        echo 'Agency subscribers';
                    }
                    if($type=="admin"){

                        $interests = array(
                            'agriculture' => 'Agriculture',
                            'business' => 'Business',
                            'climate' => 'Climate',
                            'consumer' => 'Consumer',
                            'ecosystems' => 'Ecosystems',
                            'education' => 'Education',
                            'energy' => 'Energy',
                            'finance' => 'Finance',
                            'health' => 'Health',
                            'government' => 'Local Government',
                            'manufacturing' => 'Manufacturing',
                            'ocean' => 'Ocean',
                            'safety' => 'Public Safety',
                            'research' => 'Science & Research'
                        );
                        $skills = array(
                            'software' => 'Software/Apps',
                            'scientific' => 'Scientific',
                            'algorithms' => 'Algorithms',
                            'ideas' => 'Ideas',
                            'engineering' => 'Engineering',
                            'plans' => 'Plans/Strategies',
                            'multimedia' => 'Visual Media',
                            'graphic' => 'Graphic Design'
                        );
                        $agency_args = array('post_type'=>'agency','posts_per_page'=>'-1','post_status'=>array('publish','pending','draft','private'),'orderby'=>'name','order'=>'ASC','post_parent'=>0);
                        $challenge_args = array('post_type'=>'challenge','posts_per_page'=>'-1','post_status'=>array('publish','pending','draft','private'));
                        $agency_query = new WP_Query($agency_args);
                        wp_reset_postdata();
                        $challenge_query = new WP_Query($challenge_args);
                        wp_reset_postdata();
                        //error_log(print_r($agency_query,1));
                        ?>
                        <select id="admin-select-newsletter">
                            <?php
                            
                            ?>
                            <option>Global Newsletter</option>
                            <?php
                            foreach($skills as $key => $value)
                                echo '<option value="skill-'.$key.'">Skill: '.$value.'</option>';
                            foreach($interests as $key => $value)
                                echo '<option value="skill-'.$key.'">Interest: '.$value.'</option>';
                            $challenge_types = get_field_object('field_5293da669ef07');
                            if (isset($challenge_types["choices"]))
                            {
                                foreach($challenge_types["choices"] as $key => $choice) {   
                                    echo !empty($choice) ? '<option value="type-'.$key.'">Challenge Type: '.$choice.'</option>' : '';
                                }
                            }
                            ?>
                            <?php
                            if($agency_query->have_posts()){
                                while($agency_query->have_posts()){
                                    $agency_query->the_post();
                                    echo '<option value="agency-'.get_the_ID().'">Agency: '.get_the_title()."</option>\n";
                                    //error_log(get_the_title());
                                    $child_args = array('post_type' => 'agency', 'post_parent' => get_the_ID(), 'post_status'=>array('publish','pending','draft','private'),'orderby'=>'name','order'=>'ASC');
                                    $child_query = new WP_Query($child_args);
                                    wp_reset_postdata();
                                    if($child_query->have_posts()){
                                        while($child_query->have_posts()){
                                            $child_query->the_post();
                                            echo '<option value="agency-'.get_the_ID().'"> - - Agency: '.get_the_title()."</option>\n";
                                            $grandchild_args = array('post_type' => 'agency', 'post_parent' => get_the_ID(), 'post_status'=>array('publish','pending','draft','private'),'orderby'=>'name','order'=>'ASC');
                                            $grandchild_query = new WP_Query($grandchild_args);
                                            wp_reset_postdata();
                                            if($grandchild_query->have_posts()){
                                                while($grandchild_query->have_posts()){
                                                    $grandchild_query->the_post();
                                                    echo '<option value="agency-'.get_the_ID().'">- - - - Agency: '.get_the_title()."</option>\n";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                            <?php
                            if($challenge_query->have_posts()){
                                while($challenge_query->have_posts()){
                                    $challenge_query->the_post();
                                    echo '<option value="challenge-'.get_the_ID().'">Challenge: '.get_the_title()."</option>\n";
                                }
                            }
                            ?>
                        </select>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <div><strong>Select template<span class="required">*</span></strong></div>
                <div style="text-align:center;max-width:750px;">
                    <?php
                    foreach($templates_list['templates'] as $this_template){
                        //error_log(print_r($this_template,1));
                        ?>
                    <a href="#" class="select-newsletter-template" newsletter-id="<?php echo $this_template['id']; ?>"><img src="<?php echo str_replace('http://', 'https://', $this_template['thumbnail'] ); ?>"><span class="newsletter-zoom-in"></span></a>
                        <?php
                    }
                    ?>
                </div>
                
                <?php //<div><strong>Newsletter content:</strong></div>
                //<textarea style="width:100%;min-height:300px;"></textarea>
                if(isset($_GET['nid']) && $_GET['nid'] > 0)
                {
                    ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function($){
                            //$('.select-newsletter-template').removeClass('selected-newsletter');
                            <?php
                            if($type == 'challenge'){
                                if(strpos(get_field("recipients", $_GET["nid"]),'Submitters') !== false)
                                    echo "$('input[name=\"sendto-challenge-submitters\"]').prop('checked', true);";
                                else
                                    echo "$('input[name=\"sendto-challenge-submitters\"]').prop('checked', false);";
                                if(strpos(get_field("recipients", $_GET["nid"]),'Followers') !== false)
                                    echo "$('input[name=\"sendto-challenge-followers\"]').prop('checked', true);";
                                else
                                    echo "$('input[name=\"sendto-challenge-followers\"]').prop('checked', false);";
                            }
                            ?>
                            $('.select-newsletter-template').each(function(){
                                if($(this).attr('newsletter-id') == '<?php echo get_field("template_id", $_GET["nid"]);?>')
                                    $(this).addClass('selected-newsletter');
                            });
                            $('#challenge-newsletter-send-wrapper').prepend('<div class="editing-newsletter"><span style="color:red;">Editing Newsletter:</span> <?php echo get_field("title", $_GET["nid"]);?></div>');
                            $('<input>').attr({
                                type: 'hidden',
                                name: 'update-saved',
                                value: 'Y',
                            }).appendTo('#challenge-newsletter-form');
                            $('<input>').attr({
                                type: 'hidden',
                                name: 'newsletter_id',
                                value: <?php echo $_GET["nid"]; ?>,
                            }).appendTo('#challenge-newsletter-form');
                            $("#send_newsletter a").trigger( "click" );
                            setTimeout(function(){$("ul.nav.tabs.single-challenge-tabs li:first-child, ul.nav.tabs.single-challenge-tabs li:first-child a").removeClass("active");},100);
                        });
                    </script>
                    <?php
                    $args = array(
                        //'field_groups' => array('description','tag-line'), // this will find the field groups for this post (post ID's of the acf post objects)
                        'form' => true, // set this to false to prevent the <form> tag from being created
                        'form_attributes' => array( // attributes will be added to the form element
                            'id' => 'challenge-newsletter-form',
                            'class' => 'page-content inline-form ',
                            //'action' => PARENT_URL .'/challenge-post-process.php',
                            'action' => '',
                            'method' => 'post',
                        ),
                        'post_id' => $_GET['nid'],
                        'post_type' => 'challenge_newsletter',
                        'field_groups' => array(45288),
                        'return' => add_query_arg( array('newsletter-saved' => 'true'), get_permalink() ), // return url
                        //'html_before_fields' => '<p><span class="challenge-create-section-header">Organization / Agency</span><br/>'.wp_dropdown_categories( 'show_option_none=Select Agency / Organization&tab_index=4&taxonomy=agency&hide_empty=0&orderby=NAME&order=ASC'.$select_embed.'&echo=0' ).'</p>', // html inside form before fields
                        'html_after_fields' => '<input type="hidden" name="newsletter-type" value="'.$type.'">',
                        //'html_after_fields' => '<label for="challenge-publish_state">Published Status: </label>&nbsp;&nbsp;&nbsp;<select name="challenge-publish_state" class="select"><option value="draft"'.(($post->post_status == 'draft' || $post->post_name == 'create-new-challenge') ? ' selected' : '').'>Draft</option><option value="publish"'.(($post->post_status == 'publish' && $post->post_name != 'create-new-challenge') ? ' selected' : '').'>Publish</option></select>
                                //<small><br/>Select your save option:</small><br/><br/>', // html inside form after fields
                        'submit_value' => 'Save Newsletter', // value for submit field
                        'updated_message' => 'Your Newsletter has been saved.  Redirection in ...', // default updated message. Can be false t
                    );
                }
                else
                {
                    $args = array(
                        //'field_groups' => array('description','tag-line'), // this will find the field groups for this post (post ID's of the acf post objects)
                        'form' => true, // set this to false to prevent the <form> tag from being created
                        'form_attributes' => array( // attributes will be added to the form element
                            'id' => 'challenge-newsletter-form',
                            'class' => 'page-content inline-form ',
                            //'action' => PARENT_URL .'/challenge-post-process.php',
                            'action' => '',
                            'method' => 'post',
                        ),
                        'post_id' => 'challenge-newsletter-form',
                        'post_type' => 'challenge_newsletter',
                        'field_groups' => array(45288),
                        'return' => is_page('admin-newsletter') ? add_query_arg( array('newsletter-saved' => 'true'), get_permalink() ) : add_query_arg( array('newsletter-saved' => 'true'), get_permalink() ), // return url
                        //'html_before_fields' => '<p><span class="challenge-create-section-header">Organization / Agency</span><br/>'.wp_dropdown_categories( 'show_option_none=Select Agency / Organization&tab_index=4&taxonomy=agency&hide_empty=0&orderby=NAME&order=ASC'.$select_embed.'&echo=0' ).'</p>', // html inside form before fields
                        'html_after_fields' => '<input type="hidden" name="newsletter-type" value="'.$type.'">',
                        //'html_after_fields' => '<label for="challenge-publish_state">Published Status: </label>&nbsp;&nbsp;&nbsp;<select name="challenge-publish_state" class="select"><option value="draft"'.(($post->post_status == 'draft' || $post->post_name == 'create-new-challenge') ? ' selected' : '').'>Draft</option><option value="publish"'.(($post->post_status == 'publish' && $post->post_name != 'create-new-challenge') ? ' selected' : '').'>Publish</option></select>
                                //<small><br/>Select your save option:</small><br/><br/>', // html inside form after fields
                        'submit_value' => 'Save Newsletter', // value for submit field
                        'updated_message' => 'Your Newsletter has been saved.  Redirection in ...', // default updated message. Can be false t
                    );
                }
                //error_log(is_page('admin-newsletter') ? get_permalink() : 'not admin newsletter');
                //$return_form .= '<form method="post" action="'.PARENT_URL .'/challenge-post-process.php" name="challenge-create-form">';
                acf_form_head();
                if( is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency')) )
                    echo acf_form( $args );
                else
                    echo "You do not have access to create a newsletter.";
    ?>
                <a id="newsletter-preview" href="#">Preview</a>
                <a id="newsletter-submit-approval" href="#">Submit For Approval</a>
                <?php
                if(!is_page('admin-newsletter')){
                    $args = array(
                        'post_type' => 'challenge_newsletter',
                        'posts_per_page' => '-1',
                        //'meta_key' => 'newsletter_for',
                        'post_status' => array('publish','pending','draft','private'),
                        'meta_query' => array(
                            array(
                                'key' => 'newsletter_for_id',
                                'value' => get_the_ID(),
                            )
                        ),
                    );
                    $newsletters_query = new WP_Query($args);
                    //error_log(print_r($newsletters_query,1));
                    if($newsletters_query->have_posts()){
                        ?>
                        <link rel="stylesheet" href="<?php echo plugins_url(); ?>/challenge-mailchimp/css/datatables.min.css">
                        <script src="<?php echo plugins_url(); ?>/challenge-mailchimp/js/datatables.min.js"></script>
                        <script type="text/javascript">
                          jQuery(document).ready(function($) {
                            $("#challenge-newsletters-listing").DataTable({
                                "pageLength": 10,
                                "searching": false,
                                "bLengthChange": false,
                                //"columnDefs": [ { "targets": 2, "orderable": false } ]
                                aaSorting: [],
                                "fnDrawCallback": function() {
                                    $(".load-saved-newsletter").on('click',function(){
                                        var this_newsletter_id = $(this).attr('newsletter-id');
                                        jQuery.ajax({
                                            type : 'post',
                                            url: "<?php echo admin_url('admin-ajax.php');?>",
                                            dataType: 'json',
                                            data: {
                                                'action':'load_saved_newsletter_func',
                                                'type': '<?php echo $type; ?>',
                                                'objectid': $(this).attr('newsletter-id'),
                                                'loadthrough' : 'ajaxcall',
                                            },
                                            beforeSend: function($){
                                                //$('html, body').animate({ scrollTop: 0 }, 'fast');
                                            },
                                            success : function( response ) {
                                                <?php
                                                    if($type == 'challenge'){
                                                        ?>
                                                        if(response['recips'].indexOf("Submitters") >= 0)
                                                            $('input[name="sendto-challenge-submitters"]').prop('checked', true);
                                                        else
                                                            $('input[name="sendto-challenge-submitters"]').prop('checked', false);
                                                        if(response['recips'].indexOf("Followers") >= 0)
                                                            $('input[name="sendto-challenge-followers"]').prop('checked', true);
                                                        else
                                                            $('input[name="sendto-challenge-followers"]').prop('checked', false);
                                                        <?php    
                                                    }
                                                ?>
                                                $('#acf-field-title').val(response['title']);
                                                $('#acf-field-subject').val(response['subject']);
                                                $('#acf-field-from_name').val(response['from_name']);
                                                $('#acf-field-from_email').val(response['from_email']);
                                                $('#acf-scheduled input.ps_timepicker').val(response['scheduled']);
                                                $("iframe[id^='wysiwyg-acf-field-content-']").contents().find('#tinymce').html(response['content']);
                                                $('.select-newsletter-template').removeClass('selected-newsletter');
                                                $('.select-newsletter-template').each(function(){
                                                    if($(this).attr('newsletter-id') == response['template_id'])
                                                        $(this).addClass('selected-newsletter');
                                                });
                                                //$('#acf-field-include_recent_challenges-1').val(response['include_recent']);
                                                if(response['include_recent']){
                                                    $('#acf-field-include_recent_challenges-1').prop('checked', true);
                                                    $('#acf-number_of_challenges').removeClass('acf-conditional_logic-hide');
                                                    $('#acf-number_of_challenges').addClass('acf-conditional_logic-show');
                                                }
                                                else{
                                                    $('#acf-field-include_recent_challenges-1').prop('checked', false);
                                                    $('#acf-number_of_challenges').removeClass('acf-conditional_logic-show');
                                                    $('#acf-number_of_challenges').addClass('acf-conditional_logic-hide');
                                                }
                                                if(response['num_challenges'])
                                                    $('#acf-field-number_of_challenges').val(response['num_challenges']);
                                                else
                                                    $('#acf-field-number_of_challenges').val('');
                                                
                                                $('.editing-newsletter').remove();
                                                $('#challenge-newsletter-send-wrapper').prepend('<div class="editing-newsletter"><span style="color:red;">Editing Newsletter:</span> '+response['title']+'</div>');
                                                if(!$("input[name='update-saved']").length){
                                                    $('<input>').attr({
                                                        type: 'hidden',
                                                        name: 'update-saved',
                                                        value: 'Y',
                                                    }).appendTo('#challenge-newsletter-form');
                                                }
                                                if($("input[name='newsletter_id']").length){
                                                    $("input[name='newsletter_id']").remove();
                                                }
                                                $('<input>').attr({
                                                    type: 'hidden',
                                                    name: 'newsletter_id',
                                                    value: this_newsletter_id,
                                                }).appendTo('#challenge-newsletter-form');
                                                $("#challenge-newsletter-form input[name='post_id']").val(this_newsletter_id);
                                                //$('#challenge-newsletter-form').replaceWith(response);
                                                $('html, body').animate({ scrollTop: $('div.container.page-content').offset().top }, 'slow');
                                            },
                                            error : function() {
                                            }
                                        });
                                        return false;
                                    });
                                },
                            });
                            $(".load-saved-newsletter").on('click',function(){
                                var this_newsletter_id = $(this).attr('newsletter-id');
                                
                                jQuery.ajax({
                                    type : 'post',
                                    url: "<?php echo admin_url('admin-ajax.php');?>",
                                    dataType: 'json',
                                    data: {
                                        'action':'load_saved_newsletter_func',
                                        'type': '<?php echo $type; ?>',
                                        'objectid': $(this).attr('newsletter-id'),
                                        'loadthrough' : 'ajaxcall',
                                    },
                                    beforeSend: function($){
                                        //$('html, body').animate({ scrollTop: 0 }, 'fast');
                                    },
                                    success : function( response ) {
                                        <?php
                                        if($type == 'challenge'){
                                            ?>
                                            if(response['recips'].indexOf("Submitters") >= 0)
                                                $('input[name="sendto-challenge-submitters"]').prop('checked', true);
                                            else
                                                $('input[name="sendto-challenge-submitters"]').prop('checked', false);
                                            if(response['recips'].indexOf("Followers") >= 0)
                                                $('input[name="sendto-challenge-followers"]').prop('checked', true);
                                            else
                                                $('input[name="sendto-challenge-followers"]').prop('checked', false);
                                            <?php    
                                        }
                                        ?>
                                        $('#acf-field-title').val(response['title']);
                                        $('#acf-field-subject').val(response['subject']);
                                        $('#acf-field-from_name').val(response['from_name']);
                                        $('#acf-field-from_email').val(response['from_email']);
                                        $('#acf-scheduled input.ps_timepicker').val(response['scheduled']);
                                        $("iframe[id^='wysiwyg-acf-field-content-']").contents().find('#tinymce').html(response['content']);
                                        $('.select-newsletter-template').removeClass('selected-newsletter');
                                        $('.select-newsletter-template').each(function(){
                                            if($(this).attr('newsletter-id') == response['template_id'])
                                                $(this).addClass('selected-newsletter');
                                        });
                                        //$('#acf-field-include_recent_challenges-1').val(response['include_recent']);
                                        if(response['include_recent']){
                                            $('#acf-field-include_recent_challenges-1').prop('checked', true);
                                            $('#acf-number_of_challenges').removeClass('acf-conditional_logic-hide');
                                            $('#acf-number_of_challenges').addClass('acf-conditional_logic-show');
                                        }
                                        else{
                                            $('#acf-field-include_recent_challenges-1').prop('checked', false);
                                            $('#acf-number_of_challenges').removeClass('acf-conditional_logic-show');
                                            $('#acf-number_of_challenges').addClass('acf-conditional_logic-hide');
                                        }
                                        if(response['num_challenges'])
                                            $('#acf-field-number_of_challenges').val(response['num_challenges']);
                                        else
                                            $('#acf-field-number_of_challenges').val('');

                                        $('.editing-newsletter').remove();
                                        $('#challenge-newsletter-send-wrapper').prepend('<div class="editing-newsletter"><span style="color:red;">Editing Newsletter:</span> '+response['title']+'</div>');
                                        if(!$("input[name='update-saved']").length){
                                            $('<input>').attr({
                                                type: 'hidden',
                                                name: 'update-saved',
                                                value: 'Y',
                                            }).appendTo('#challenge-newsletter-form');
                                        }
                                        if($("input[name='newsletter_id']").length){
                                            $("input[name='newsletter_id']").remove();
                                        }
                                        $('<input>').attr({
                                            type: 'hidden',
                                            name: 'newsletter_id',
                                            value: this_newsletter_id,
                                        }).appendTo('#challenge-newsletter-form');
                                        $("#challenge-newsletter-form input[name='post_id']").val(this_newsletter_id);
                                        //$('#challenge-newsletter-form').replaceWith(response);
                                        $('html, body').animate({ scrollTop: $('div.container.page-content').offset().top }, 'slow');
                                    },
                                    error : function() {
                                    }
                                });
                                return false;
                            });
                          });
                        </script>
                        <div style="padding:15px;font-weight:bold;line-height: 1.5em;color:#333;font-size: 15px;text-shadow: 0 1px 0 #FFF;">Newsletters</div>
                        <table id="challenge-newsletters-listing">
                            <thead><tr><th>Title</th><th>Created by</th><th>Last modified by</th><th>Scheduled</th><th>Status</th></tr></thead>
                            <tbody>
                        <?php
                        while($newsletters_query->have_posts()){
                            $newsletter_sent = false;
                            $newsletters_query->the_post();
                            $dateTime = new DateTime(get_field('scheduled'),new DateTimeZone('America/New_York'));
                            //error_log(print_r($dateTime,1));
                            //error_log(print_r($dateTime->diff(new DateTime(null,new DateTimeZone('America/New_York')))->format('%R'),1));
                            if ($dateTime->diff(new DateTime(null,new DateTimeZone('America/New_York')))->format('%R') == '+' && get_field('approved') == '1') {
                              $newsletter_sent = true;
                              //error_log('sent = true');
                              //error_log(print_r(new DateTime(null,new DateTimeZone('America/New_York')),1));
                            }
                            $initial_creation = get_post_meta(get_the_ID(), 'newsletter_intial_creation',true);
                            $mod_time = get_post_meta(get_the_ID(), 'newsletter_modified_time', true);
                            $mod_author = get_post_meta(get_the_ID(), 'newsletter_modified_author', true);

                            echo '<tr class="'.(get_post_status() == 'draft' ? 'newsletter-saved' : ($newsletter_sent ? ' newsletter-sent' : (get_field('approved') == '1' ? ' newsletter-approved' : ' newsletter-unapproved'))).'"><td><a href="#" newsletter-id="'.get_the_ID().'" class="load-saved-newsletter">'.get_the_title().'</a></td><td data-order="'.$initial_creation.'">'.get_the_author().' on '.date('n/d/y \a\t g:i a', intval($initial_creation)).'</td><td data-order="'.$mod_time.'">'.(empty($mod_time)?'n/a':$mod_author.' on '.date('n/d/y \a\t g:i a', $mod_time)).'</td><td>'.get_field('scheduled').'</td><td>'.(get_post_status() == 'draft' ? 'Saved' : ($newsletter_sent ? 'Sent' : (get_field('approved') == '1' ? 'Approved' : 'Pending Approval'))).'</td></tr>';
                        }
                        ?>
                            </tbody>
                        </table>
                        <?php
                    }
                }
                ?>
            </div>
            <!-- </form> -->
        <!-- </div> -->
    <?php
        }
    }
    else
    {
        echo 'Challenge Mailchimp plugin is not enabled. Please enable this plugin to view newsletters.';
    }
}
add_shortcode('challenge-newsletter','challenge_newsletter_func');

function challenge_blog_func($atts){
    ob_start();

    extract(shortcode_atts(array(
        'limit' => '',
        ),$atts));

    $excerpt_limit = (!empty($limit) && is_numeric((int)$limit)) ? (int)$limit : 450;
    $args = array(
        'post_type'       => 'post',
        'posts_per_page'  => '-1'
        );

    $this_query = new WP_Query($args);

    wp_reset_postdata();
    
    if($this_query->have_posts()):
        $counter = 0;
        while ( $this_query->have_posts() ) : $this_query->the_post();
        if($counter > 0)
            echo '<hr style="width:90%;margin:25px auto;">';
    ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'skeleton' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

            <div class="entry-meta">
                <?php echo challenge_blog_posted_on(); ?>
            </div><!-- .entry-meta -->

            <div class="entry-image">
                <?php
                    $url = wp_get_attachment_url( get_post_thumbnail_id() );
                    $url = !empty($url) ? $url : get_template_directory_uri().'/images/default-image.gif" style="max-width:150px;';
                ?>
                <img src="<?php echo $url; ?>">
            </div>
            <div class="entry-content">
                <?php
                    $content_in = get_the_content();
                    echo substr(strip_tags($content_in, '<a><br>'), 0, $excerpt_limit);
                if(strlen($content_in) > $excerpt_limit)
                {
                    echo '... <a href="'.get_permalink().'">Continue reading <span class="meta-nav">&rarr;</span></a>';
                }
                ?>
                <div class="clear"></div>
                <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'skeleton' ), 'after' => '</div>' ) ); ?>
            </div><!-- .entry-content -->

            <div class="entry-utility">
                <?php if ( count( get_the_category() ) ) : ?>
                    <span class="cat-links">
                        <?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'skeleton' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
                    </span>
                    <span class="meta-sep">|</span>
                <?php endif; ?>
                <?php
                    //global $wp_query;
                    //error_log(print_r($wp_query,1));
                    if(is_page('challenge-blog'))
                        $tags_list = get_the_term_list( get_the_ID(), 'blog_tag', '', ', ' );
                    else
                        $tags_list = get_the_tag_list( '', ', ' );
                    if ( $tags_list ):
                ?>
                    <span class="tag-links">
                        <?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'skeleton' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
                    </span>
                    <span class="meta-sep">|</span>
                <?php endif; ?>
                <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'skeleton' ), __( '1 Comment', 'skeleton' ), __( '% Comments', 'skeleton' ) ); ?></span>
                <?php edit_post_link( __( 'Edit', 'skeleton' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
            </div><!-- .entry-utility -->
        </div><!-- #post-## -->

    <?php $counter++;
    endwhile;
    wp_reset_postdata();
    endif;

    $ret = ob_get_contents();
    ob_end_clean();
    return $ret;
}
add_shortcode('challenge-blog', 'challenge_blog_func');
