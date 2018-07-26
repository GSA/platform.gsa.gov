<?php
/**
 * Custom Shortcodes
 *
 * @package FEB WordPress Theme Framework
 * @subpackage feb
 * @author CTAC - www.ctacorp.com
 */

function return_site_url()
{
	return get_site_url();
}
add_shortcode( 'site_url', 'return_site_url');


function feb_collapse_func()
{
	if(is_page('old-news') || is_page('news') || is_page('collaboration') || is_page('workforce'))
		return '<div id="topstory" class="accordion-body collapse ">
	<div class="accordion-inner">';
}
add_shortcode('feb-collapse','feb_collapse_func');

function feb_events_page_listing_func()
{
	global $wp_query;
	ob_start();
	$paged = !empty($wp_query->query_vars["paged"]) ? $wp_query->query_vars["paged"] : 1;

	$thistquery = '';

	if((isset($_GET['type']) && !empty($_GET['type'])) || (isset($_GET['lob']) && !empty($_GET['lob'])))
	{
		$this_term = (isset($_GET['type']) && !empty($_GET['type'])) ? $_GET['type'] : $_GET['lob'];
		$thistquery = array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'event-categories',
				'field'    => 'slug',
				'terms'    => array( $this_term ),
			),
		);
	}

	$eventsQuery = new WP_Query( array( 'post_type' => 'event', 'posts_per_page' => 10, 'paged' => $paged, 'tax_query' => $thistquery) );
		if ( $eventsQuery->have_posts() ) {
			echo '<div id="event-list-page">';
		    while($eventsQuery->have_posts()) {
		        $eventsQuery->the_post();
		        $end_booking = get_post_meta(get_the_ID(), '_event_rsvp_date', true).' '.get_post_meta(get_the_ID(), '_event_rsvp_time', true);
		        $date1 = new DateTime("now");
				$date2 = new DateTime($end_booking);
		        ?>
		        <div class="media">
<div class="media-body">
<h4 class="media-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
<div><small class="text-muted"><?php echo get_post_meta(get_the_ID(), '_event_start_date', true).' '.get_post_meta(get_the_ID(), '_event_start_time', true).' - '.get_post_meta(get_the_ID(), '_event_end_date', true).' '.get_post_meta(get_the_ID(), '_event_end_time', true); ?></small></div>
<?php /*<div><small class="text-muted">Course Fee: $0.00</small></div>*/?>
<div><small class="text-muted">Total Seats: <?php echo get_post_meta(get_the_ID(), '_event_spaces', true) == ('0' || '') ? 'Unlimited' : get_post_meta(get_the_ID(), '_event_spaces', true);?></small></div>
<div><small class="text-muted">Event Status: <?php echo get_post_meta(get_the_ID(), 'Event Status', true) == '' ? 'Closed' : get_post_meta(get_the_ID(), 'Event Status', true);?></small></div>
<p class="text-muted">Brief Event Description: <?php the_excerpt(); ?></p>
<p><a href="<?php the_permalink(); ?>"><?php echo get_post_meta(get_the_ID(), '_event_rsvp', true) == '0' ? 'REGISTRATION IS CLOSED' : ($date1 < $date2 ? 'REGISTRATION IS OPEN - CLCK HERE' : 'REGISTRATION HAS ENDED'); ?></a></p>
<?php /*<div><small><a href="#">More <span class="caret"></span></a></small></div>*/ ?>
</div>
</div>
<?php
//echo strtotime(get_post_meta(get_the_ID(), '_event_start_date', true));
		    }
		echo '</div>';
		$big = 9999999;
			$pagination_args = array(
				//'base' 		   => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'       => '/page/%#%',
				'total'        => $eventsQuery->max_num_pages,
				'current'      => max( 1, $eventsQuery->query_vars["paged"]),
				'show_all'     => False,
				'end_size'     => 1,
				'mid_size'     => 2,
				'prev_next'    => True,
				'prev_text'    => __('<span class="feb-pagination-prev">« Previous Events</span>'),
				'next_text'    => __('<span class="feb-pagination-next">Next Events »</span>'),
				'type'         => 'plain',
				'add_args'     => False,
				'add_fragment' => ''
			);
			$pagination = '<div class="feb-pagination-links">';
			$pagination .= paginate_links( $pagination_args );
			$pagination .= '</div>';
		echo $pagination;
		}else{
			echo '<center>No events currently listed<center>';
		}
/*
		global $wpdb;
$tablename = $wpdb->prefix . "postmeta";
echo "NAME: ".$tablename;
$sql = $wpdb->prepare( "SELECT * FROM %s WHERE str_to_date(_event_start_date, '%Y-%m-%d') BETWEEN '2015-02-01' AND '2015-02-28'",$tablename );
$results = $wpdb->get_results( $sql , ARRAY_A );
var_dump($results);
*/
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode('feb-events-page-listing','feb_events_page_listing_func');

function feb_add_sidebar($atts, $content = null)
{
	ob_start();
	extract(shortcode_atts(array(
		'name' => ''
    ), $atts));
	if ( is_active_sidebar( $name ) ) : ?>
		<ul id="sidebar">
			<?php dynamic_sidebar( $name ); ?>
		</ul>
	<?php endif;
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode('feb-add-sidebar','feb_add_sidebar');

function feb_landing_page($atts, $content = null)
{
	ob_start();
	extract(shortcode_atts(array(
		'page' => ''
    ), $atts));
	?>
<div class="column">
<?php
$landingHeader = '';
$landingSecond = '';
$saved_header1 = get_post_meta( get_the_ID(), 'feb_post_heading1', true );
$saved_header2 = get_post_meta( get_the_ID(), 'feb_post_heading2', true );

if(is_page('news')){
	$landingHeader = !empty($saved_header1) ? $saved_header1 : '';
	$landingSecond = !empty($saved_header2) ? $saved_header2 : '';
}
else if(is_page('collaboration')){
	$landingHeader = !empty($saved_header1) ? $saved_header1 : '';
	$landingSecond = !empty($saved_header2) ? $saved_header2 : '';
}else if(is_page('workforce')){
	$landingHeader = !empty($saved_header1) ? $saved_header1 : '';
	$landingSecond = !empty($saved_header2) ? $saved_header2 : '';
}
?>
<h3><?php echo $landingHeader; ?></h3>
<?php echo $landingSecond; ?>
<div id="topStoriesGroup">
<?php
//$featuredItem = new WP_Query( array( 'post_type' => strtolower($page) ,'meta_key' => 'top-story', 'meta_value' => 'true') );
$featuredItem = new WP_Query( array( 'post_type' => strtolower($page), 'posts_per_page' => 10 ) );
$itemCounter = 1;
		if ( $featuredItem->have_posts() ) {
		    while($featuredItem->have_posts()) {
		        $featuredItem->the_post();
		        $replace_count = 0;
			?>
	<div class="media">
	<div class="media-body">
	<h4 class="media-heading">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h4>
	<?php echo str_replace('<div id="topstory" class="accordion-body collapse ">','<div id="topstory'.$itemCounter.'" class="accordion-body collapse ">',do_shortcode(get_the_content()), $replace_count);
		if($replace_count > 0)
		{
			?>
			</div>
		</div>
		<div class="more" data-toggle="collapse" data-parent="#topStoriesGroup" href="#topstory<?php echo $itemCounter; ?>">More</div>
		<?php
		}
	?>
	</div>
	</div><!-- Media !-->
	<?php
	$itemCounter++;
	}
}
?>
</div>
	<?php 
	if(strtolower($page) == 'news'){
		echo '<div style="width:100%;margin-top:10px;text-align:right;"><a href="'.site_url().'/news-archives">News Archives <i class="fa fa-arrow-circle-right"></i></a></div>';
	}
	?>
	</div>
<?php
$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

add_shortcode('feb-landing-page','feb_landing_page');
function feb_add_news_notes($atts, $content = null)
{
	global $wp_query;
	ob_start();
	//$paged = !empty($wp_query->query_vars["paged"]) ? $wp_query->query_vars["paged"] : 1;
	$newsQuery = new WP_Query( array( 'post_type' => 'news', 'meta_key'=>'featued_on_homepage', 'meta_value'=> 'on') );

	$notesQuery = new WP_Query( array( 'post_type' => 'notes', 'meta_key'=>'featued_on_homepage', 'meta_value'=> 'on') );
	
	$listing = new WP_Query();
	if($newsQuery->have_posts() && $notesQuery->have_posts())
	{
		$listing->posts = array_merge( $newsQuery->posts, $notesQuery->posts );
		$uniques = array();
		foreach ($listing->posts as $obj) {
		    $uniques[$obj->ID] = $obj;
		}
		
		$listing->posts=$uniques;
	}
	else{
		if($newsQuery->have_posts())
		{
			$listing->posts = $newsQuery->posts;
		}
		if($notesQuery->have_posts())
		{
			$listing->posts = $notesQuery->posts;
		}
		
	}
	
	$listing->post_count = count($listing->posts);
	
		if($listing->post_count>0)
		{
			?>
	<div class="row" id="feb-home-news-container">
	
	<?php
	
	
	$newArr = array();
	foreach( $listing->posts as  $listing) {
		$home_pos = get_post_meta( $listing->ID, 'homepage_position');
		if(!empty($home_pos))
			$home_single = $home_pos[0];
		$newArr[$home_single] = $listing;
	}
	
	ksort($newArr);
	foreach( $newArr as  $listing) {
		//print_r($listing);
		if(isset($listing))
		{
		//print_r($listing);
		$meta_values_for_position = get_post_meta( $listing->ID, 'homepage_position');
			//print_r($meta_values_for_position);
			 //print_r($listing);
			 
			?>
			 <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="thumbnail">
                    <h4 class="news-head-title">
						<?php echo $listing->post_title; ?>
					</h4>
                 <div class="col-md-4">
					
					<?php
	        if ( has_post_thumbnail($listing->ID) ) {
			 
	            echo '<a href="'.get_permalink($listing->ID).'">
		    
		    <img src='.wp_get_attachment_url( get_post_thumbnail_id($listing->ID)).' alt="300x200"></a>';
	        } else {
	            echo '<img src="'.PARENT_URL.'/images/febdefaultimg.png" alt="300x200" />';
	        }

	    ?></div>
                    <div class="caption col-md-8"><?php
					$line=$body;
					/*
					if (preg_match('/^.{1,260}\b/s', $listing->post_content, $match))
					{
					    $line=$match[0];
					}
					*/
					$line = truncateHtml($listing->post_content, 300);
					?>
                                           <?php echo $line; ?></div>
                     <div class="download-news">
			     </div>
                </div>

			 </div>

<?php
		}
		 // endwhile;
	}
		    ?>
		
	<?php
		
		}else{
			echo '<center>No news/notes found<center>';
		}

	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	?>
</div>	

	<?php
	
}
add_shortcode('feb-add-news-notes','feb_add_news_notes');

/**
 * truncateHtml can truncate a string up to a number of characters while preserving whole words and HTML tags
 *
 * @param string $text String to truncate.
 * @param integer $length Length of returned string, including ellipsis.
 * @param string $ending Ending to be appended to the trimmed string.
 * @param boolean $exact If false, $text will not be cut mid-word
 * @param boolean $considerHtml If true, HTML tags would be handled correctly
 *
 * @return string Trimmed string.
 */
function truncateHtml($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true) {
	if ($considerHtml) {
		// if the plain text is shorter than the maximum length, return the whole text
		if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
			return $text;
		}
		// splits all html-tags to scanable lines
		preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
		$total_length = strlen($ending);
		$open_tags = array();
		$truncate = '';
		foreach ($lines as $line_matchings) {
			// if there is any html-tag in this line, handle it and add it (uncounted) to the output
			if (!empty($line_matchings[1])) {
				// if it's an "empty element" with or without xhtml-conform closing slash
				if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
					// do nothing
				// if tag is a closing tag
				} else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
					// delete tag from $open_tags list
					$pos = array_search($tag_matchings[1], $open_tags);
					if ($pos !== false) {
					unset($open_tags[$pos]);
					}
				// if tag is an opening tag
				} else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
					// add tag to the beginning of $open_tags list
					array_unshift($open_tags, strtolower($tag_matchings[1]));
				}
				// add html-tag to $truncate'd text
				$truncate .= $line_matchings[1];
			}
			// calculate the length of the plain text part of the line; handle entities as one character
			$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
			if ($total_length+$content_length> $length) {
				// the number of characters which are left
				$left = $length - $total_length;
				$entities_length = 0;
				// search for html entities
				if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
					// calculate the real length of all entities in the legal range
					foreach ($entities[0] as $entity) {
						if ($entity[1]+1-$entities_length <= $left) {
							$left--;
							$entities_length += strlen($entity[0]);
						} else {
							// no more characters left
							break;
						}
					}
				}
				$truncate .= substr($line_matchings[2], 0, $left+$entities_length);
				// maximum lenght is reached, so get off the loop
				break;
			} else {
				$truncate .= $line_matchings[2];
				$total_length += $content_length;
			}
			// if the maximum length is reached, get off the loop
			if($total_length>= $length) {
				break;
			}
		}
	} else {
		if (strlen($text) <= $length) {
			return $text;
		} else {
			$truncate = substr($text, 0, $length - strlen($ending));
		}
	}
	// if the words shouldn't be cut in the middle...
	if (!$exact) {
		// ...search the last occurance of a space...
		$spacepos = strrpos($truncate, ' ');
		if (isset($spacepos)) {
			// ...and cut the text in this position
			$truncate = substr($truncate, 0, $spacepos);
		}
	}
	// add the defined ending to the text
	$truncate .= $ending;
	if($considerHtml) {
		// close all unclosed html-tags
		foreach ($open_tags as $tag) {
			$truncate .= '</' . $tag . '>';
		}
	}
	return $truncate;
}

function feb_wppb_login()
{	
	return str_replace('id="wppb-login-wrap" class="wppb-user-forms"','id="wppb-login-wrap" class="wppb-user-forms inlineForm"', do_shortcode('[wppb-login]'));
}
add_shortcode('feb-wppb-login','feb_wppb_login');

function feb_wppb_register()
{	
	return str_replace('</form>','</form></div>',str_replace('<form','<div class="inlineForm"><form',str_replace('class="submit button"','class="btn-primary btn"', do_shortcode('[wppb-register]'))));
}
add_shortcode('feb-wppb-register','feb_wppb_register');

function feb_wppb_edit_profile()
{	
	return str_replace('</form>','</form></div>',str_replace('<form','<div class="inlineForm"><form',str_replace('class="submit button"','class="btn-primary btn"', do_shortcode('[wppb-edit-profile]'))));
}
add_shortcode('feb-wppb-edit-profile','feb_wppb_edit_profile');

function feb_event_lob_list($atts, $content = null)
{
	ob_start();
	$these_events = get_terms('event-categories', array('hide_empty' => false));
	extract(shortcode_atts(array(
		'allowed' => ''
    ), $atts));
    $allowed_types = array_map('trim', explode(',', sanitize_text_field($allowed)));
	?>
	<div id="panel-element-152676" class="panel-collapse<?php echo (isset($_GET['type']) && !empty($_GET['type'])) ? ' collapse' : ' in'; ?>">
		<div class="panel-body">
			<ul class="list-group">
				<li class="list-group-item"><a href="<?php echo site_url('events-list');?>">View All</a></li>
			<?php
				foreach ($these_events as $this_event)
					echo in_array($this_event->name, $allowed_types) ? '<li class="list-group-item"><a href="'.add_query_arg('lob',$this_event->slug, get_permalink()).'">'.$this_event->name.'</a></li>'."\n" : '';
			?>
            </ul>
		</div>
	</div>
    <?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode('feb-event-lob-list','feb_event_lob_list');


function feb_event_types_list($atts, $content = null)
{
	ob_start();
	$these_events = get_terms('event-categories', array('hide_empty' => false));
	extract(shortcode_atts(array(
		'allowed' => ''
    ), $atts));
    $allowed_types = array_map('trim', explode(',', sanitize_text_field($allowed)));
	?>
	<div id="panel-element-658438" class="panel-collapse<?php echo (isset($_GET['type']) && !empty($_GET['type'])) ? ' in' : ' collapse'; ?>">
		<div class="panel-body">
			<ul class="list-group">
			<?php
				foreach ($these_events as $this_event)
					echo in_array($this_event->name, $allowed_types) ? '<li class="list-group-item'.((isset($_GET['type']) && $_GET['type'] == $this_event->slug) ? ' active-filter' : '').'"><a href="'.add_query_arg('type',$this_event->slug, get_permalink()).'">'.$this_event->name.'</a></li>'."\n" : '';
			?>
            </ul>
		</div>
	</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode('feb-event-types-list','feb_event_types_list');

function feb_emergency_contact_submit()
{
	
	if (!empty($_POST['emergency_contact_profile']))
	{
		if(isset($_POST['firstName']) && $_POST['firstName'] !="")
		{
			$firstname=sanitize_text_field($_POST['firstName']);
		}
		if(isset($_POST['middleInitial']) && $_POST['middleInitial'] !="")
		{
			$middleInitial=sanitize_text_field($_POST['middleInitial']);
		}
		if(isset($_POST['lastName']) && $_POST['lastName'] !="")
		{
			$lastName=sanitize_text_field($_POST['lastName']);
			
		}
		if(isset($_POST['professionalTitle']) && $_POST['professionalTitle'] !="")
		{
			$professionalTitle=sanitize_text_field($_POST['professionalTitle']);
		}
		if(isset($_POST['agencyName']) && $_POST['agencyName'] !="")
		{
			$agencyName=str_replace('"',"'",sanitize_text_field($_POST['agencyName']));
		}
		if(isset($_POST['buildingName']) && $_POST['buildingName'] !="")
		{
			$buildingName=str_replace('"',"'",sanitize_text_field($_POST['buildingName']));
		}
		if(isset($_POST['officeaddress1']) && $_POST['officeaddress1'] !="")
		{
			$officeaddress1=str_replace('"',"'",sanitize_text_field($_POST['officeaddress1']));
		}
		
		if(isset($_POST['officesuite']) && $_POST['officesuite'] !="")
		{
			$officesuite=str_replace('"',"'",sanitize_text_field($_POST['officesuite']));
		}
		if(isset($_POST['officecity']) && $_POST['officecity'] !="")
		{
			$officecity=str_replace('"',"'",sanitize_text_field($_POST['officecity']));
		}
		if(isset($_POST['officecounty']) && $_POST['officecounty'] !="")
		{
			$officecounty=str_replace('"',"'",sanitize_text_field($_POST['officecounty']));
		}
		if(isset($_POST['officestate']) && $_POST['officestate'] !="")
		{
			$officestate=str_replace('"',"'",sanitize_text_field($_POST['officestate']));
		}
		if(isset($_POST['officezip']) && $_POST['officezip'] !="")
		{
			$officezip=str_replace('"',"'",sanitize_text_field($_POST['officezip']));
		}
		if(isset($_POST['workphone']) && $_POST['workphone'] !="")
		{
			$workphone=sanitize_text_field($_POST['workphone']);
		}
		if(isset($_POST['workphoneext']) && $_POST['workphoneext'] !="")
		{
			$workphoneext=sanitize_text_field($_POST['workphoneext']);
		}
		if(isset($_POST['homephone']) && $_POST['homephone'] !="")
		{
			$homephone=sanitize_text_field($_POST['homephone']);
		}
		if(isset($_POST['cellphone1']) && $_POST['cellphone1'] !="")
		{
			$cellphone1=sanitize_text_field($_POST['cellphone1']);
		}
		if(isset($_POST['cellphone2']) && $_POST['cellphone2'] !="")
		{
			$cellphone2=sanitize_text_field($_POST['cellphone2']);
		}
		if(isset($_POST['emailaddress1']) && $_POST['emailaddress1'] !="")
		{
			$emailaddress1=sanitize_text_field($_POST['emailaddress1']);
		}
		if(isset($_POST['emailaddress2']) && $_POST['emailaddress2'] !="")
		{
			$emailaddress2=sanitize_text_field($_POST['emailaddress2']);
		}
	  /*
		if(isset($_POST['emergencygroup']) && $_POST['emergencygroup'] !="")
		{
			$emergencygroup=sanitize_text_field($_POST['emergencygroup']);
		}
		*/
		if(isset($_POST['empnumber']) && $_POST['empnumber'] !="")
		{
			$empnumber=sanitize_text_field($_POST['empnumber']);
		}
		if(isset($_POST['officetype']) && $_POST['officetype'] !="")
		{
			$officetype=sanitize_text_field($_POST['officetype']);
		}
		
		
		$email_exists = email_exists(sanitize_text_field($_POST['emailaddress1']));
        
		 if(!$email_exists)
		{
			
			$user_login = strtolower(sanitize_text_field(substr($_POST['firstName'],0,1)).sanitize_text_field($_POST['lastName'])); 
			$user_exists = username_exists($user_login);
			$user_login_original = $user_login;
			$user_counter = 1;
			$max_counter = 30;
			if($user_exists)
			{
			    while(username_exists($user_login))
			    {
				$user_login = $user_login_original.$user_counter;
				$user_counter++;
				if($user_counter > $max_counter)
				    break;
			    }
			}

		 $user_email = sanitize_text_field($_POST['emailaddress1']);
            //validation on user login / email / any other req fields
		$rand_char_set = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$new_pwd = substr(str_shuffle($rand_char_set), 0, 10);  //10 characters of a random pwd
		$new_user = wp_create_user($user_login, $new_pwd, $user_email);
		wp_new_user_notification($user_login,$new_pwd);
		if(intval($new_user) > 1)
		{
			
			$user_id = wp_update_user( array( 'ID' => $new_user, 'first_name' => $firstname, 'last_name' => $lastName ) );
			
			wp_set_auth_cookie($new_user);
			wp_set_current_user($new_user);
			
		}
		else
		{
		    echo 'User could not be created.  Please Contact the system administrator.';
		}
		
		
		
		}
		else{
			
			$userinfo=get_user_by_email( $_POST['emailaddress1'] );
			$new_user=$userinfo->id;
			
		}
		
		 $tmp_date = date('Y-m-d H:i:s', time());
		$post = array(
		    'post_title' => $firstname . ' ' . $lastName,
		    'post_status' => 'publish', // publish, preview, future, etc.
		    'post_type' => 'emergency_contact',
		    'post_date' => $tmp_date,
		    'post_author' => $new_user
		);
		$post_id = wp_insert_post($post);
		
		update_user_meta( $new_user, 'emergency_contact_post_id', $post_id);
		update_field('field_54f8f4e637c17', $firstname, $post_id);
		
		update_field('field_54f8f4f137c18', $lastName, $post_id);
		update_field('field_54f8f6650e405', $middleInitial, $post_id);
		
		update_field('field_54f8f63ca9204', $agencyName, $post_id);
		
		update_field('field_54f8f4fa37c19', $professionalTitle, $post_id);
		update_field('field_54f8f519268e2', $buildingName, $post_id);
		update_field('field_54f8f523268e3', $officeaddress1, $post_id);
		update_field('field_54f8f530268e4', $officesuite, $post_id);
		update_field('field_54f8f5407b1e5', $officecity, $post_id);
		update_field('field_54f8f54c7b1e6', $officecounty, $post_id);
		update_field('field_54f8f5547b1e7', $officestate, $post_id);
		update_field('field_54f8f55f7b1e8', $officezip, $post_id);
		update_field('field_54f8f5723568f', $emailaddress1, $post_id);
		update_field('field_54f8f58135690', $emailaddress2, $post_id);
		update_field('field_54f8f597d9edd', $homephone, $post_id);
		update_field('field_54f8f5acd9ede', $workphone, $post_id);
		update_field('field_54f8f5bcd9edf', $workphoneext, $post_id);
		update_field('field_54f8f5c9d9ee0', $cellphone1, $post_id);
		update_field('field_54f8f5dad9ee1', $cellphone2, $post_id);
	  //update_field('field_54f8f5f3a9200', $emergencygroup, $post_id);
		update_field('field_54f8f601a9201', $empnumber, $post_id);
		update_field('field_54f8f60ea9202', $officetype, $post_id);
		
		?>
		<script type="text/javascript">
			
			jQuery(document).ready(function($){
				$("#errormessagediv").addClass('alert-success');
				$("#errormessagediv").show().html('Thank you for registering in emergency notification system. Your data has been saved successfully.');
				$('html, body').animate({
				scrollTop: $('.inlineForm').offset().top-100
			    }, 'slow');
		});
		</script>
		<?php
				
	}
	if (!empty($_POST['emergency_contact_login']))
	{
		
		if(isset($_POST['username']) && $_POST['username']!="")
		{
			$username=sanitize_text_field($_POST['username']);
		}
		if(isset($_POST['useremail']) && $_POST['useremail']!="")
		{
			$useremail=sanitize_text_field($_POST['useremail']);
		}
		
		$userinfo=get_user_by_email($useremail);
		
		$userid=$userinfo->id;
		
		$args = array(
		
		'post_type'        => 'emergency_contact',
		'meta_key'   => 'email_1',
		'meta_value'       => $useremail,
		'post_status'      => array('publish','future'),
		
	);
		
	$posts_array = get_posts( $args );
	$postid=$posts_array[0]->ID;
	 if(empty($postid))
	 {
		?>
		<script type="text/javascript">
		
		jQuery(document).ready(function($){
			$("#errormessagediv").addClass('alert-danger');
			$("#errormessagediv").show().html('Sorry!, No record found for entered email address.');
			$('html, body').animate({
				scrollTop: $('.inlineForm').offset().top-100
			    }, 'slow');
		});
		</script>
		<?php
	 }
	 
		$firstname = get_field('field_54f8f4e637c17',$postid);
		
		$lastName= get_field('field_54f8f4f137c18', $postid);
		
		$middleInitial= get_field('field_54f8f6650e405', $postid);
		$agencyName= get_field('field_54f8f63ca9204', $postid);
		
		$professionalTitle= get_field('field_54f8f4fa37c19',$postid);
		$buildingName= get_field('field_54f8f519268e2', $postid);
		$officeaddress1= get_field('field_54f8f523268e3', $postid);
		
		$officesuite= get_field('field_54f8f530268e4', $postid);
		$officecity= get_field('field_54f8f5407b1e5', $postid);
		$officecounty= get_field('field_54f8f54c7b1e6', $postid);
		$officestate= get_field('field_54f8f5547b1e7', $postid);
		$officezip= get_field('field_54f8f55f7b1e8', $postid);
		$emailaddress1= get_field('field_54f8f5723568f', $postid);
		$emailaddress2= get_field('field_54f8f58135690', $postid);
		$homephone= get_field('field_54f8f597d9edd', $postid);
		$workphone= get_field('field_54f8f5acd9ede', $postid);
		$workphoneext= get_field('field_54f8f5bcd9edf', $postid);
		$cellphone1= get_field('field_54f8f5c9d9ee0', $postid);
		$cellphone2= get_field('field_54f8f5dad9ee1', $postid);
		$emergencygroup= get_field('field_54f8f5f3a9200', $postid);
		$empnumber= get_field('field_54f8f601a9201', $postid);
		$officetype= get_field('field_54f8f60ea9202', $postid);
		?>
	
	<script type="text/javascript">
		
	jQuery(document).ready(function($){
		function load_fields()
		{
                   
                
                    var firstname = "<?php echo $firstname; ?>";
		  
		   $('#firstName').val(firstname);
                                   
                    var lastName = "<?php echo $lastName; ?>";
                    $('#lastName').val(lastName);
                    
                    var middleInitial = "<?php echo $middleInitial; ?>";
                    $('#middleInitial').val(middleInitial);
		    
		     var professionalTitle = "<?php echo $professionalTitle; ?>";
                    $('#professionalTitle').val(professionalTitle);
		    
		    var agencyName = "<?php echo $agencyName; ?>";
                    $('#agencyName').val(agencyName);
		    
		    var buildingName = "<?php echo $buildingName; ?>";
                    $('#buildingName').val(buildingName);
		    
                   var officeaddress1 = "<?php echo $officeaddress1; ?>";
                    $('#officeaddress1').val(officeaddress1);
                    
                    var officesuite = "<?php echo $officesuite; ?>";
                    $('#officesuite').val(officesuite);
		    
		     var officecity = "<?php echo $officecity; ?>";
                    $('#officecity').val(officecity);
		    
		     var officecounty = "<?php echo $officecounty; ?>";
                    $('#officecounty').val(officecounty);
		    
		    var officestate = "<?php echo $officestate; ?>";
                    $('#officestate').val(officestate);
		    
		    var officezip = "<?php echo $officezip; ?>";
                    $('#officezip').val(officezip);
		    
		     var emailaddress1 = "<?php echo $emailaddress1; ?>";
                    $('#emailaddress1').val(emailaddress1);
		    
		     var emailaddress2 = "<?php echo $emailaddress2; ?>";
                    $('#emailaddress2').val(emailaddress2);
		    
		     var homephone = "<?php echo $homephone; ?>";
                    $('#homephone').val(homephone);
		    
		    var workphone = "<?php echo $workphone; ?>";
                    $('#workphone').val(workphone);
		    
		    var workphoneext = "<?php echo $workphoneext; ?>";
                    $('#workphoneext').val(workphoneext);
                    
		     var cellphone1 = "<?php echo $cellphone1; ?>";
                    $('#cellphone1').val(cellphone1);
		    
		    var cellphone2 = "<?php echo $cellphone2; ?>";
                    $('#cellphone2').val(cellphone2);
		    
		    var emergencygroup = "<?php echo $emergencygroup; ?>";
                    $('#emergencygroup').val(emergencygroup);
		    
		    var empnumber = "<?php echo $empnumber; ?>";
                    $('#empnumber').val(empnumber);
		    
		    var officetype = "<?php echo $officetype; ?>";
                    $('#officetype').val(officetype);
                    
		}
               load_fields();
		

	})(jQuery);
	</script>
	
	<?php
	//exit;
	}
	
}
add_shortcode('feb-emergency-contact-submit','feb_emergency_contact_submit');
function CreateAgencyList()
{
	$args = array(
    'post_type' => 'emergency_contact',
    'post_status' => array('publish','future'),
    'posts_per_page' => -1,
     
    'meta_query' => array(
        array(
            'key'     => 'agency',
            
        ),
    ),
);
	
$posts_array = get_posts( $args );

$agency_array=array();
foreach($posts_array as $postid)
{
	
	$postid=$postid->ID;
	$meta_values = get_post_meta( $postid, 'agency');
	$agency_array[]=$meta_values['0'];
	
}

$agency_array=array_unique($agency_array);

asort($agency_array);

$agency_dropdown='<select class="form-control" id="agencylist" name="agencylist">';
$agency_dropdown.='<option>-- Select Agencies --</option>';
foreach($agency_array as $agencyname)
{
	if($agencyname!="Null" && $agencyname!="NULL" && $agencyname!="null")
	{
		$agency_dropdown.='<option value="'.str_replace('"',"'",$agencyname).'">'.$agencyname.'</option>';
	}
}
$agency_dropdown.='</select>';

return $agency_dropdown;

}
add_shortcode('Create-Agency-List','CreateAgencyList');

function CreateBuildingList()
{
	$args = array(
    'post_type' => 'emergency_contact',
    'post_status' => array('publish','future'),
    'posts_per_page' => -1,
     
    'meta_query' => array(
        array(
            'key'     => 'building',
            
        ),
    ),
);
$posts_array = get_posts( $args );
$building_array=array();
foreach($posts_array as $postid)
{
	
	$postid=$postid->ID;
	$meta_values = get_post_meta( $postid, 'building');
	$building_array[]=$meta_values['0'];
	
}
$building_array=array_unique($building_array);
asort($building_array);
$building_dropdown='<select class="form-control" id="BuildingList">';
$building_dropdown.='<option>-- Select Buildings --</option>';
foreach($building_array as $buildingname)
{
	if($buildingname!="Null" && $buildingname!="NULL" && $buildingname!="null")
	{
		$building_dropdown.='<option value="'.str_replace('"',"'",$buildingname).'">'.$buildingname.'</option>';
	}
}
$building_dropdown.='</select>';

return $building_dropdown;

}
add_shortcode('Create-Building-List','CreateBuildingList');

function CreateAddressList()
{
	$args = array(
    'post_type' => 'emergency_contact',
    'post_status' => array('publish','future'),
    'posts_per_page' => -1,
     
    'meta_query' => array(
        array(
            'key'     => 'address_1',
            
        ),
    ),
);
$posts_array = get_posts( $args );
$address_array=array();
$address_dropdown='<select class="form-control" id="AddressList">';
$address_dropdown.='<option>-- Select Address --</option>';
foreach($posts_array as $postid)
{
	
	$postid=$postid->ID;
	$meta_address_values = get_post_meta( $postid, 'address_1');
	$meta_suite_values = get_post_meta( $postid, 'office_suite');
	$address_array[]=$meta_address_values['0'];
	$suites_arry[$meta_address_values['0']]=$meta_suite_values['0'];
	
}

$address_array=array_unique($address_array);
asort($address_array);
foreach($address_array as $address)
{
	if($address!="Null" && $address!="NULL" && $address!="null")
	{
		
		
			if($suites_arry[$address]!="" && $suites_arry[$address]!="NULL" && $suites_arry[$address]!="Null" && $suites_arry[$address]!="null")
			{
				
				$address_dropdown.='<option value="'.str_replace('"',"'",$buildingname).'">'.$address." : ".$suites_arry[$address].'</option>';	
			}
			else{
				$address_dropdown.='<option value="'.str_replace('"',"'",$buildingname).'">'.$address.'</option>';
			}
		
	}
	
	
}

$address_dropdown.='</select>';

return $address_dropdown;

}
add_shortcode('Create-Address-List','CreateAddressList');



add_action('wp_footer', function(){
	if(is_page(array('emergency', 'Emergency'))){
?>

<script type="text/javascript">
jQuery(document).ready(function($){

jQuery("#agencylist").on('change', function(){
	
 var agencyName=$('#agencylist').val();
 $('#agencyName').val(agencyName);
     $.ajax({
	type : 'post',
	dataType:"json",
        url: "<?php echo admin_url('admin-ajax.php');?>",
        data: {
	    
            'action':'Show_Building_Query',
            'agency' : agencyName
        },
         success : function( response ) {
		
		$("#BuildingList").empty();
		//jQuery("#buillistdiv").html(response)
		$("#BuildingList").append('<option>-- Select Buildings --</option>');
		for (i = 0; i < response.length; i++) {
			
			$("#BuildingList").append('<option>'+response[i]+'</option>');
		}
		$("#AddressList").empty();
		$("#AddressList").append('<option>-- Select Address --</option>');
	 },
	  error : function(  ) {
		$("#errormessagediv").addClass('alert-danger');
		$("#errormessagediv").show().html('Sorry!, An error occur while procesing your input.');
	 }
    });  
              
});

jQuery("#BuildingList").on('change', function(){
	
 var buildingName=$('#BuildingList').val();
var agencyName=$('#agencylist').val();
     $.ajax({
	type : 'post',
	dataType:"json",
        url: "<?php echo admin_url('admin-ajax.php');?>",
        data: {
	    
            'action':'Show_Address_Query',
            'agency' : agencyName,
	    'building' : buildingName
        },
         success : function( response ) {
		
		$("#AddressList").empty();
		//jQuery("#errormessagediv").show().html(response)
		$("#AddressList").append('<option>-- Select Address --</option>');
		for (i = 0; i < response.length; i++) {
			
			$("#AddressList").append('<option>'+response[i]+'</option>');
		}
		 $('#buildingName').val(buildingName);
		
	 },
	  error : function(  ) {
		$("#errormessagediv").addClass('alert-danger');
		$("#errormessagediv").show().html('Sorry!, An error occur while procesing your input.');
	 }
    });  
              
});

jQuery("#AddressList").on('change', function(){
	
 var AddressName=$('#AddressList').val();
 var buildingName=$('#BuildingList').val();
var agencyName=$('#agencylist').val();
 //var officesuite="null";
 
if (AddressName.indexOf(":") > -1) {
	var addressarray = AddressName.split(":");
	$('#officeaddress1').val(addressarray[0]);
	var AddressName=addressarray[0];
	//officesuite=addressarray[1];
	$('#officesuite').val(addressarray[1]);
 }
 else{
	$('#officeaddress1').val(AddressName);
	
 }
 
  $.ajax({
	type : 'post',
	dataType:"json",
        url: "<?php echo admin_url('admin-ajax.php');?>",
        data: {
	    
            'action': 'auto_address_fields',
            'agency' : agencyName,
	    'building' : buildingName,
	    'address' : AddressName
	   // 'officesuite' : officesuite
	   
        },
         success : function( response ) {
		
		if (response[0].indexOf("||") > -1) {
			var restoftheaddress = response[0].split("||");
			
			$('#officecity').val(restoftheaddress[0]);
			$('#officecounty').val(restoftheaddress[1]);
			$('#officestate').val(restoftheaddress[2]);
			$('#officezip').val(restoftheaddress[3]);
		}
		
		
	 },
	  error : function(  ) {
		//alert(console.log);
		$("#errormessagediv").addClass('alert-danger');
		$("#errormessagediv").show().html('Sorry!, An error occur while procesing your input.');
	 }
    }); 
 
 
		

              
});

});
</script>
<?php
	}
});

function theme_url_func(){
	return get_template_directory_uri();
}
add_shortcode( 'theme-url', 'theme_url_func' );

function feb_archives_func($atts){
	extract(shortcode_atts(array(
		'type' => 'news',
		'by' => 'month'
		),$atts));

	$years = array();

	$posts = get_posts(array(
		'numberposts' => -1,
		'orderby' => 'post_date',
		'order' => 'ASC',
		'post_type' => $type,
		'post_status' => 'publish'
	));

	foreach($posts as $post) {
		if($by == 'year'){
			$years[date('Y', strtotime($post->post_date))][] = $post;
	  	}
	  	if($by =='month'){
	  		$years[date('Y', strtotime($post->post_date))][date('F', strtotime($post->post_date))][] = $post;
	  	} 
	}
	?>
	<style type="text/css">
		h2{font-weight:bold;}
	</style>
	<?php
	krsort($years);
	if($by == 'year'){
		foreach($years as $year => $posts) { ?>
		  <h2><?php echo $year; ?></h2>
		  <ul>
		    <?php foreach($posts as $post) { ?>
		      <li>
		        <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
		      </li>
		    <?php } ?>
		  </ul>
		<?php
		echo '<br/>';
		}
	}
	if($by == 'month'){
		foreach($years as $year => $months) { ?>
		  <h2><?php echo $year; ?></h2>
		<?php
			foreach($months as $month => $posts)
			{
				?>
				<h3><?php echo $month; ?></h3>
				  <ul>
				    <?php foreach($posts as $post) { ?>
				      <li>
				        <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
				      </li>
				    <?php } ?>
				  </ul>
				<?php
			}
			echo '<br/>';
		}
	}
}
add_shortcode('feb-archives', 'feb_archives_func');

function feb_partial_func($atts){
	ob_start();
	extract(shortcode_atts(array(
			'page' => ''
		), $atts));

    $insert_page = new WP_Query("pagename={$page}");
    if($insert_page->have_posts()):
	    while($insert_page->have_posts()) : $insert_page->the_post();
	       the_content();
	    endwhile;
	else:
		echo '<strong>FEB page (partial) not found: '.$page.'</strong>';
	endif;
    wp_reset_postdata();
    $ret = ob_get_contents();
    ob_end_clean();
    return $ret;
}
add_shortcode('feb-partial', 'feb_partial_func');