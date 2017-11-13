<?php
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
		$secure_connection = 's';
	}
	else
		$secure_connection = '';

	$default_img_url = "http".$secure_connection."://challenge.sites.usa.gov/files/2013/12/default-image.gif";
	$this_title = get_the_title();
	get_header();
	//st_before_content($columns='');
	//get_template_part( 'loop', 'single' );
add_shortcode( 'display-agency', 'ag_display_posts_shortcode' );

function get_agency_hierarchy()
{
	global $post;
	$ancestors = get_post_ancestors($post->ID);
	$hierarchy = "";
	for( $a=count($ancestors)-1; $a>=0; $a-- )
	{
		if ( !empty($hierarchy) ) { $hierarchy .=" / "; }
		$link_name = get_post_field('post_title',$ancestors[$a]);
		$link_url  = get_post_permalink($ancestors[$a]);
		$hierarchy .= '<a href="'. $link_url .'">'. $link_name .'</a>';
	}
	return $hierarchy;
}

function ag_display_posts_shortcode( $atts ) {
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
		$secure_connection = 's';
	}
	else
		$secure_connection = '';

	$default_img_url = "http".$secure_connection."://challenge.sites.usa.gov/files/2013/12/default-image.gif";
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
		'posts_per_page'      => '50',
		'return_found'		  => false,
		'tag'                 => '',
		'tax_operator'        => 'IN',
		'tax_term'            => false,
		'taxonomy'            => false,
		'wrapper'             => 'div',
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
	$post_parent = $atts['post_parent']; // Validated later, after check for 'current'
	$post_status = $atts['post_status']; // Validated later as one of a few values
	$post_type = sanitize_text_field( $atts['post_type'] );
	$posts_per_page = intval( $atts['posts_per_page'] );
	$return_found = sanitize_key( $atts['return_found'] );
	$tag = sanitize_text_field( $atts['tag'] );
	$tax_operator = $atts['tax_operator']; // Validated later as one of a few values
	$tax_term = sanitize_text_field( $atts['tax_term'] );
	$taxonomy = sanitize_key( $atts['taxonomy'] );
	$wrapper = sanitize_text_field( $atts['wrapper'] );


	// Set up initial query for post
$args = array(
		//'category_name'       => $category,
		//'order'               => $order,
		//'orderby'             => $orderby,
		'post_type'           => 'challenge',
		'posts_per_page'      => $posts_per_page,
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


	/*$tax_args = array(
			'tax_query' => array(
				array(
					'taxonomy' => 'agency',
					'field'    => 'slug',
					'terms'    => $this_title,
					'operator' => 'IN'
				)
			)
		);
*/
	$args = array_merge( $args, $tax_args );
	}
	//var_dump($post_status);
	//$listing = new WP_Query($args);

	$listing = new WP_Query( apply_filters( 'display_posts_shortcode_args', $args, $original_atts ) );
	//var_dump($listing);
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

	while ( $listing->have_posts() ): $listing->the_post();
		global $post;

		$image = $date = $excerpt = $content = '';

		$where_host = get_field('where_host');
		$ext_url = get_field('external_challenge_url');
		//$link_out = (empty($where_host) || $where_host == 'local') ? apply_filters( 'the_permalink', get_permalink() ) : $ext_url;
		$link_out = ( !empty($ext_url) && ( empty($where_host) || (!empty($where_host) && $where_host == 'remote') ) ) ? $ext_url : apply_filters( 'the_permalink', get_permalink() );

		$title = '<a class="title" href="' . $link_out . '">' . apply_filters( 'the_title', get_the_title() ) . '</a>';

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

		$rating = "";
		//if(function_exists('the_ratings')) { $rating = the_ratings('div',0,false); }

		$logo_new = get_field('logo');
		$logo_in = !empty($logo_new) ? $logo_new['url'] : $default_img_url;

		$tagline_new = get_field('tag-line');
		$tagline_in = !empty($tagline_new) ? "<span class=\"front-challenge-tagline\">".$tagline_new."</span>" : "";

		$total_value = 0;
		$the_prizes = get_field('the_prizes');
		$a_cash_prize = false;
		$a_non_cash_prize = false;
		$prize_output = "";

		if(isset($the_prizes) && !empty($the_prizes))
		{
			foreach($the_prizes as $this_prize)
			{
				if($this_prize['is_cash_prize'])
				{
					$this_cash_value = $this_prize['the_cash_amount'];
					//if(strpos($this_prize['the_cash_amount'],'$') !== false)
					$this_cash_value = str_replace("$","",$this_prize['the_cash_amount']);
					$this_cash_value = str_replace(",","",$this_cash_value);
					//echo (int)$this_cash_value . " + ";
					$total_value += (int)$this_cash_value;
					$a_cash_prize = true;
				}
				else
					$a_non_cash_prize = true;
			}

			//echo " = ".$total_value;
			//if($a_cash_prize)
			$prize_output = '<span class="summary-item-text">';
			if($a_cash_prize) // there are cash prizes
			{
				$prize_output .="$".number_format((int)$total_value).($a_non_cash_prize ? '+' : '')."</span><br/>In Prizes";
				//echo "CASH";
				//$prize_output .= "testing</span>";
			}
			elseif($a_non_cash_prize)
			{
				$prize_output .= "<a href=\"".$link_out."\">View Prize List<br/>On This Challenge</a></span><br/>";
				//echo "NO CASH";
			}
		}

		$edit_link = '';
		if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$post->ID,'category-id') || get_current_user_id() == $post->post_author)))
			$edit_link = '<span class="edit-challenge-link"><a href="'.add_query_arg( 'edit-challenge', 'true', get_permalink() ).'">Edit</a></span>';

		$output = '<div class="front-challenge-item-container">'.$edit_link.'<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">'.'<a href="' . $link_out . '"><img src="'.$logo_in.'" class="front-challenge-img"></a><div class="front-challenge-innertext">' . $image . $title . $date . $excerpt . $content . $tagline_in . $rating . '</div></' . $inner_wrapper . '>';
		$output .='<div class="front-challenge-summary"><div class="front-challenge-summary-inner">'.$prize_output.'</div><div class="front-challenge-summary-inner">Open Until<br/><span class="summary-item-text">'.verify_challenge_datetime_view(get_field('submission_end')).'</span></div></div></div><div class="clear"></div>';


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
	$comment_count = (array)wp_count_comments( get_the_ID() );
	?>
	<div class="agency-content">
		<?php
		$edit_var = $_GET['edit-agency'];
		if(empty($edit_var) || $edit_var != 'true')
		{
			$logo_new = get_field('logo');
			$logo_in = !empty($logo_new) ? $logo_new['url'] : $default_img_url;
			$challenge_count = do_shortcode('[display-agency return_found="true" post_type="challenge" taxonomy="agency" tax_term="'.$this_title.'"]');
			$draft_count = do_shortcode('[display-agency return_found="true" post_status="draft" post_type="challenge" taxonomy="agency" tax_term="'.$this_title.'"]');
		?>
			<h1 class="entry-title"><?php echo $this_title; ?></h1>
			<?php
				$ancestry = get_agency_hierarchy();
				if ( !empty($ancestry) )
				{
					echo " {$ancestry} <br /><br />";
				}
			?>
			<ul id="agency-tabs" class="tabs">
				<li><a href="#t1">Home</a></li>
				<li><a href="#t2">Discussions (<?php echo $comment_count["approved"]; ?>)</a></li>
				<?php
				if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$post->ID,'post-id') || get_current_user_id() == $post->post_author))){ // or your id created this //user is agency admin
					?>
					<li><a href="#t3">Challenges (<?php echo $challenge_count; ?>)</a></li>
					<li><a href="#t4" style="border-right:1px solid #ddd;">Challenge Drafts (<?php echo $draft_count; ?>)</a></li>
					<li class="right-tab"><a href="<?php echo add_query_arg( 'edit-agency', 'true', get_permalink() ); ?>">Edit this Agency</a></li>
					<?php
				}
				else
				{
					?>
					<li><a href="#t3" style="border-right:1px solid #ddd;">Challenges (<?php echo $challenge_count; ?>)</a></li>
					<?php
				}
				?>
			</ul>
			<ul class="tabs-content">
				<li id="t1Tab">
					<div class="agency-tab">
						<div class="agency-top">
							<img class="agency-image-top" src="<?php echo $logo_in; ?>">
							<div class="challenge-top-text">
								<span class="agency-challenges-header">Agency Info</span><?php echo get_field('agency_info'); ?>
							</div>
						</div>
						<div class="agency-inner">
							<?php
							$newsupdates = get_field('news_updates');
								if(!empty($newsupdates)): ?>
							<div class="agency-newsupdates">
								<span class="agency-newsupdates-header">News / Updates</span>
								<div class="agency-newsupdates-item"><?php echo get_field('news_updates'); ?></div>
							</div>
							<?php endif;
							$moreinfo = get_field('more_information');
								if(!empty($moreinfo)): ?>
							<div class="agency-moreinfo">
								<span class="agency-moreinfo-header">More Information</span>
								<div class="agency-moreinfo-item"><?php echo get_field('more_information'); ?></div>
							</div>
							<?php endif; ?>
						</div>
						<?php get_sidebar('challenge'); ?>
					</div>
				</li>
				<li id="t2Tab" style="text-align:center;"><?php comments_template(); ?></li>
				<li id="t3Tab">
					<div class="agency-challenges">
						<span class="agency-challenges-header"><?php //echo get_field('title'); ?> Challenges</span>
						<?php
							if($challenge_count > 0)
							echo do_shortcode('[display-agency post_type="challenge" taxonomy="agency" tax_term="'.$this_title.'" item_class="front-challenge-item"]');
							else
								echo "<center><strong>No challenges have been posted for this agency yet.</strong></center>";
						?>

					</div>
				</li>
				<?php
				/*
				<li id="t4Tab">
					<div class="agency-contact">
						<span class="agency-challenges-header">Contact Agency</span>
						<?php echo do_shortcode('[contact-form-7 id="'.get_post_meta(get_the_ID(), 'agency_wpcf7_id',true).'" title="Contact Agency"]'); ?>
					</div>
				</li>
				*/
				?>
				<?php
				if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$post->ID,'post-id') || get_current_user_id() == $post->post_author))){
				?>
				<li id="t4Tab">
					<div class="agency-contact">
						<span class="agency-challenges-header">Drafts</span>
						<?php
						if($draft_count > 0)
							echo do_shortcode('[display-agency post_type="challenge" post_status="draft" taxonomy="agency" tax_term="'.$this_title.'" item_class="front-challenge-item"]');
						else
							echo "<center><strong>No drafts have been created for this agency yet.</strong></center>";
						?>
					</div>
				</li>
				<li id="tlastTab">
						<div class="challenge-container-inner">
						<?php /*
							$agency_args = array(
							    'post_id' => $post->ID, // post id to get field groups from and save data to
							    'field_groups' => array(), // this will find the field groups for this post (post ID's of the acf post objects)
							    'form' => true, // set this to false to prevent the <form> tag from being created
							    'form_attributes' => array( // attributes will be added to the form element
							        'id' => 'update-agency',
							        'class' => '',
							        'action' => '',
							        //'action' => PARENT_URL .'/challenge-post-process.php',
							        'method' => 'post',
							    ),
							    'return' => add_query_arg( 'updated', 'true', get_permalink() ), // return url
							    'html_before_fields' => '', // html inside form before fields
							    'html_after_fields' => '<input type="hidden" value="agency-update" name="agency-post-type">', // html inside form after fields
							    'submit_value' => 'Update', // value for submit field
							    'updated_message' => 'Agency updated.', // default updated message. Can be false to show no message
							);
							acf_form_head();
							acf_form( $agency_args );
							*/
						?>
						</div>
					</li>
					<?php
				}
				?>
			</ul>
			<?php /*
			Submission ends:&nbsp;<?php date("M d, Y",((int)get_field('submission_end'))); ?>
			*/
			?>
<?php
		}
		else
		{
			if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$post->ID,'post-id') || get_current_user_id() == $post->post_author)))
			{
				$formattedpageurl = site_url('','http').challenge_permalink($post->ID);
				//$page_url =
				//$formattedpageurl .= $page_url;
				echo '<span class="agency-challenges-header" style="margin-top:10px;">Editing Agency: <strong><a href="'.$formattedpageurl.'" style="text-decoration:none;">'.$post->post_title.'</a></strong>';
				$agency_args = array(
				    'post_id' => $post->ID, // post id to get field groups from and save data to
				    'field_groups' => array(), // this will find the field groups for this post (post ID's of the acf post objects)
				    'form' => true, // set this to false to prevent the <form> tag from being created
				    'form_attributes' => array( // attributes will be added to the form element
				        'id' => 'update-agency',
				        'class' => '',
				        'action' => '',
				        //'action' => PARENT_URL .'/challenge-post-process.php',
				        'method' => 'post',
				    ),
				    'return' => add_query_arg( 'edit-agency', 'true', get_permalink() ), // return url
				    'html_before_fields' => '', // html inside form before fields
				    'html_after_fields' => '<input type="hidden" value="agency-update" name="agency-post-type">', // html inside form after fields
				    'submit_value' => 'Update Agency', // value for submit field
				    'updated_message' => 'Agency updated.', // default updated message. Can be false to show no message
				);
				acf_form_head();
				acf_form( $agency_args );
			}
		}
?>

	</div>
	<?php
	//st_after_content();
	get_footer();
?>
