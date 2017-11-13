<?php
/**
 * The template for creating new Challenge post objects.
 *
 * @package WordPress
 * @subpackage skeleton-challenge
 * @since skeleton 0.1
 */
//define('WP_USE_THEMES', false);

/*if(strpos($_SERVER['SERVER_NAME'],'www.challenge.gov.local') !== false)
	require_once('/Users/robmorris/Documents/sites-usa-gov/wp-load.php');
elseif(strpos($_SERVER['SERVER_NAME'],'localhost') !== false)
	require_once('/Library/WebServer/Documents/wordpress-challenge/wp-load.php');
else*/

require_once('../../../wp-load.php');

//function do_challenge_insert() {
if(is_user_logged_in() && current_user_can('publish_posts'))
{
	if( 'POST' == $_SERVER['REQUEST_METHOD']
		&& $_POST['post_id'] == 'new-solution' )	//new solution handler
	{
		$nonce = $_REQUEST['acf_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'input' ) ) {
			die( 'Nonce security check failed.' ); //Add Redirect
		} else {
			$challenge_id = !empty($_POST['challenge-post-id']) ? $_POST['challenge-post-id'] : get_page_by_title('Home');
			$submission_start = get_field('submission_start', $challenge_id);
            $submission_end = get_field('submission_end', $challenge_id);
			$dt = DateTime::createFromFormat('U', time());
            $dt->setTimeZone(new DateTimeZone('America/New_York'));
            $adjusted_timestamp = $dt->format('U') + $dt->getOffset();

            if (($submission_end >= $adjusted_timestamp && (empty($submission_start) || $submission_start <= $adjusted_timestamp)) || current_user_can('create_users') || current_user_can('all_access_agency')) {
				//use $_POST['challenge-post-id'] to check for sub end. if ended.. return to challenge permalink with args submissions=closed
				$title_out = "";

				$custom_fields = $_POST['fields'];
				reset($custom_fields);
				$title_out = current($custom_fields);
				$post_status = !empty($custom_fields['field_52a6329fbc61b']) ? 'draft' : 'publish';

				$post = array(
					'post_title'	=> $title_out,
					'post_status'	=> $post_status, // Choose: publish, preview, future, etc.
					'post_type'		=> 'solution' // Set the post type based on the IF is post_type X
				);

				$post_id = wp_insert_post($post);
				
				foreach($custom_fields as $field_key => $value)
				{
					update_field( $field_key, $value, $post_id );
				}
				update_field('field_52a6320abc61a', $_POST['challenge-post-id'], $post_id);
				if(isset($_POST['fields']['field_56fbbc99717f2'])){
	            	foreach($_POST['fields']['field_56fbbc99717f2'] as $file_array){
	            		if(!empty($file_array['field_56fbbcbe717f3'])){
	            			$ancestors = get_post_ancestors($file_array['field_56fbbcbe717f3']);
	            			if(empty($ancestors)){
		            			$update_post = array(
									'ID'			=> $file_array['field_56fbbcbe717f3'],
									'post_parent'	=> $post_id,
								);
								wp_update_post( $update_post );
							}
	            		}
	            	}
	            }
				//wp_redirect( add_query_arg( 'message', 'solution-created', get_permalink($challenge_id) ) );
				//do_action( 'acf/save_post' , $post_id );

				wp_redirect( add_query_arg( 'solution-created', 'true', get_permalink( $challenge_id)) );
			}
			elseif (!empty($submission_start) && $submission_start >= $adjusted_timestamp){
                wp_redirect( add_query_arg( 'submissions', 'early', get_permalink( $challenge_id)) );
            }else{
                wp_redirect( add_query_arg( 'submissions', 'ended', get_permalink( $challenge_id)) );
            }
			exit;
		}
	}
	if( 'POST' == $_SERVER['REQUEST_METHOD']
		&& $_POST['post_id'] != 'new-challenge' && $_POST['post_id'] != 'new-solution' ) //update handler
	{
		$nonce = $_REQUEST['acf_nonce'];
		if ( ! wp_verify_nonce( $nonce, 'input' ) ) {
			die( 'Nonce security check failed.' ); //Add Redirect
		} else {
			$custom_fields = $_POST['fields'];
			$this_post_id = $_POST['post_id'];
			$post = array(
			'ID'           => $post_id,
			);
		  
		  foreach($custom_fields as $field_key => $value)
			{
				if(!empty($value))
					update_field( $field_key, $value, $post_id );
			}
		//error_log($this_post_id);
		//error_log(get_permalink($this_post_id));
		//wp_redirect( get_permalink( $challenge_id));
		wp_update_post( $post );
		wp_redirect( add_query_arg( 'message', 'updated', get_permalink($this_post_id) ) );

		}
	}
	else
		echo 'No Valid Post.  <br/><a href="'.site_url().'">Return Home</a>';
	//echo "done";
}
else
	wp_redirect(site_url());
// Do the wp_insert_post action to insert it
//do_action('wp_insert_post', 'do_challenge_insert');

?>