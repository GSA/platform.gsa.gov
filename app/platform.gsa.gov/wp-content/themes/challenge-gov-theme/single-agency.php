<?php
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
		$secure_connection = 's';
	}
	else
		$secure_connection = '';

	//$default_img_url = "//platform.gsa.gov/wp-content/uploads/sites/51/2013/12/default-image.gif";
	//if(strpos(get_site_url('http'), "http://localhost/") !== false || strpos(get_site_url('http'), "http://sites.usa.local") !== false) //override if local dev
    	$default_img_url = get_template_directory_uri().'/images/default-image.gif';
	$this_title = get_the_title();

	if(isset($_GET['follow-agency']) && $_GET['follow-agency']==1 && isset($_GET['agency_id']) && $_GET['agency_id']!="" )
	{
	    $user_ID = get_current_user_id();
	    $users_following_agency = get_post_meta( $_GET['agency_id'], 'followed_agency', 1);
	    if($users_following_agency!="")
	    {
	        if(!in_array($user_ID, $users_following_agency))
	        {
	            array_push($users_following_agency, $user_ID);
	        }
	    }else{
	    	$users_following_agency[]=$user_ID;
	   	}
	    update_post_meta($_GET['agency_id'], 'followed_agency', $users_following_agency);
	    //update_user_meta($current_user->ID, 'followed_challenges',$user_followed_challenges );
	}
	get_header();
	?>
	<div class="container">
	<?php
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

	//$default_img_url = "http".$secure_connection."://challenge.gov/files/2013/12/default-image.gif";
	//if(strpos(get_site_url('http'), "http://localhost/") !== false || strpos(get_site_url('http'), "http://sites.usa.local") !== false) //override if local dev
    	$default_img_url = get_template_directory_uri().'/images/default-image.gif';
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
		'posts_per_page'      => '15',
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
    global $wp_query;
    $paged = !empty($wp_query->query_vars["paged"]) ? $wp_query->query_vars["paged"] : 1;


	// Set up initial query for post
$args = array(
		//'category_name'       => $category,
		//'order'               => $order,
		//'orderby'             => $orderby,
		'post_type'           => 'challenge',
		'posts_per_page'      => $posts_per_page,
        'paged'				  => $paged,
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
global $post;
$custom_args = array(
			
			'meta_query' => array(
				
				
				array(
					'key' => 'partner_agency_%_partner_agency',
					'value'=> $post->ID,
					'compare' => 'LIKE'
					
				)
			)
		);
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
	
	$args_custom = array(

		'post_type'           => 'challenge',
		'posts_per_page'      => $posts_per_page,
       
	);
	$args_custom['post_status']=$args['post_status'][0];
	$final_custom=array_merge($args_custom,$custom_args);
$listing_taxonomies = new WP_Query( apply_filters( 'display_posts_shortcode_args', $args, $original_atts ) );
	
	add_filter('posts_where',custom_and_or);
	
	$listing_custom = new WP_Query( apply_filters( 'display_posts_shortcode_args', $final_custom) );
	
	remove_filter('posts_where', custom_and_or);
	
	 $listing = new WP_Query();
	 
	if($listing_taxonomies->have_posts() && $listing_custom->have_posts())
	{
		$listing->posts = array_merge( $listing_taxonomies->posts, $listing_custom->posts );
		$uniques = array();
		foreach ($listing->posts as $obj) {
		    $uniques[$obj->ID] = $obj;
		}
		
		$listing->posts=$uniques;
	}
	else{
		if($listing_taxonomies->have_posts())
		{
			$listing->posts = $listing_taxonomies->posts;
		}
		if($listing_custom->have_posts())
		{
			$listing->posts = $listing_custom->posts;
		}
		
	}
	$listing->post_count = count($listing->posts);
	
	
	if($return_found)
	{
		
		if($listing->post_count>0)
		{
			$foundpost=$listing->post_count;
			
			return $foundpost;
		}
		else{
			$foundpost=0;
			return $foundpost;
		}
	}
	else{
		if ($listing->post_count==0)
		return apply_filters( 'display_posts_shortcode_no_results', wpautop( $no_posts_message ) );
	}
	

	
	$wrapper_options = array( 'ul', 'ol', 'div' );
	if( ! in_array( $wrapper, $wrapper_options ) )
		$wrapper = 'ul';
	$inner_wrapper = 'div' == $wrapper ? 'div' : 'li';

	$inner = '';

if($listing->post_count>0)
	{
		$cnt=0;
		
		foreach( $listing->posts as  $listing) {
	//while ( $listing->have_posts() ): $listing->the_post();
		global $post;

		$image = $date = $excerpt = $content = '';

		$where_host = get_field('where_host',$listing->ID);
		$ext_url = get_field('external_challenge_url',$listing->ID);
		//$link_out = (empty($where_host) || $where_host == 'local') ? apply_filters( 'the_permalink', get_permalink() ) : $ext_url;
		$link_out = ( !empty($ext_url) && ( empty($where_host) || (!empty($where_host) && $where_host == 'remote') ) ) ? $ext_url : apply_filters( 'the_permalink', get_permalink($listing->ID) );

		$title = '<a class="title" href="' . $link_out . '"'.(!empty($ext_url) && ( empty($where_host) || (!empty($where_host) && $where_host == 'remote') ) ? ' target="_blank"' : '').'>' . apply_filters( 'the_title', get_the_title($listing->ID) ) . '</a>';

		if ( $image_size && has_post_thumbnail($listing->ID) )
			$image = '<a class="image" href="' . $link_out . '"'.(!empty($ext_url) && ( empty($where_host) || (!empty($where_host) && $where_host == 'remote') ) ? ' target="_blank"' : '').'>' . get_the_post_thumbnail( $post->ID, $image_size ) . '</a> ';

		if ( $include_date )
			$date = ' <span class="date">' . get_the_date( $date_format,$listing->ID ) . '</span>';

		if ( $include_excerpt )
			$excerpt = ' <span class="excerpt-dash">-</span> <span class="excerpt">' . get_the_excerpt($listing->ID) . '</span>';

		if( $include_content )
			$content = '<div class="content">' . apply_filters( 'the_content', get_the_content($listing->ID) ) . '</div>';

		$class = array( 'listing-item', $item_class );
		$class = apply_filters( 'display_posts_shortcode_post_class', $class, $post, $listing->posts );

		$rating = "";
		//if(function_exists('the_ratings')) { $rating = the_ratings('div',0,false); }

		$logo_new = get_field('logo',$listing->ID);
		$logo_in = !empty($logo_new) ? $logo_new['url'] : $default_img_url;

		$tagline_new = get_field('tag-line',$listing->ID);
		$tagline_in = !empty($tagline_new) ? "<span class=\"front-challenge-tagline\">".$tagline_new."</span>" : "";

		$total_value = 0;
		$the_prizes = get_field('the_prizes',$listing->ID);
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
			//$prize_output = '<span class="summary-item-text">';
			if($a_cash_prize) // there are cash prizes
			{
				$prize_output .= "<a href=\"".$link_out."\"".(!empty($where_host) && $where_host == 'remote' ? ' target="_blank"' : '').">$".number_format((int)$total_value)." in prizes</a>";
				//echo "CASH";
				//$prize_output .= "testing</span>";
			}
			elseif($a_non_cash_prize)
			{
				$prize_output .= "<a href=\"".$link_out."\"".(!empty($where_host) && $where_host == 'remote' ? ' target="_blank"' : '').">View Prize List On This Challenge</a><br/>";
				//echo "NO CASH";
			}
		}

		$edit_link = '';
		//if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$post->ID,'category-id') || get_current_user_id() == $post->post_author)))
		if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency')))
			$edit_link = '<span class="edit-challenge-link"><a href="'.add_query_arg( 'edit-challenge', 'true', get_permalink($listing->ID) ).'">Edit</a></span>';

		//$output = '<div class="front-challenge-item-container">'.$edit_link.'<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">'.'<a href="' . $link_out . '"><img src="'.$logo_in.'" class="front-challenge-img"></a><div class="front-challenge-innertext">' . $image . $title . $date . $excerpt . $content . $tagline_in . $rating . '</div></' . $inner_wrapper . '>';
		//$output .='<div class="front-challenge-summary"><div class="front-challenge-summary-inner">'.$prize_output.'</div><div class="front-challenge-summary-inner">Open Until<br/><span class="summary-item-text">'.verify_challenge_datetime_view(get_field('submission_end')).'</span></div></div></div><div class="clear"></div>';
		$subclosedate=get_field('submission_end',$listing->ID);
        $diffindate= ($subclosedate < time() ? "Closed On" : "Open Until");
		//start challenge_gov_theme
        $output =  '<div class="col-md-6 col-sm-6 col-xs-12">';
        $output .=      '<h4>'.$title.'</h4>' ;
        $output .=       '<div class="challenge-thumbnail">'.$edit_link;;
        $output .=           '<img src="'.$logo_in.'" alt="'.get_the_title().'">';
        $output .=          '<div class="caption">';
        $output .=                 '<div class="prize">'.$prize_output.'</div>';
        $output .=                     '<p>'.$tagline_in.'</p>';
        $output .=                     '<h5 class="challengeDateOpen">';
	if($diffindate=="Closed On")
           {
                 $output .=  '<span class="closedchallenge">'.$diffindate.'</span>';
           }
           else{
                $output .=    '<span class="openchallenge">'.$diffindate.'</span>';
           }
        
        $output .=                     '<span>'.verify_challenge_datetime_view(get_field('submission_end',$listing->ID)).'</span>';
        $output .=                     '</h5>';
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

         if(($cnt + 1) == ($listing->post_count)) {
           
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
                'prev_text'    => __('<span class="challenge-pagination-prev">« Pre</span>'),
                'next_text'    => __('<span class="challenge-pagination-next">Next »</span>'),
                'type'         => 'plain',
                'add_args'     => False,
                'add_fragment' => ''
            );
            $pagination = '<div class="pagination" id="pagination">';
            $pagination .= paginate_links( $pagination_args );
            $pagination .= '</div>';

        }

$cnt++;
}
}
wp_reset_postdata();

    // need to set page plugin for activation for the tab
    $activate_challenges_tab = (isset($paged) && $paged > 1)? '<input type="hidden" class="activate-challenge-tab" />':"";

	$open = apply_filters( 'display_posts_shortcode_wrapper_open', '<' . $wrapper . ' class="display-posts-listing '.$container_class.'">', $original_atts );
	$close = apply_filters( 'display_posts_shortcode_wrapper_close', '</' . $wrapper . '>', $original_atts );
	$return = $open . $inner . $pagination . $close . $activate_challenges_tab;

	return $return;
}
	$comment_count = (array)wp_count_comments( get_the_ID() );
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#solution-submitted-close a').on('click', function(){
                $('#solution-submitted').slideUp();
            });
		});
	</script>
	<?php
	/*
	<script type="text/javascript">
      	jQuery(document).ready(function($){
            $('#commentform input[type="submit"]').click(function(){
                alert('Challenge.gov is undergoing scheduled maintenance. Between the hours of 8 p.m. EST and 10 p.m. EST tonight, the Challenge.gov database will be in read-only mode. It will be unable to save new registrations, profile updates, submissions or comments during this time. We apologize for this inconvenience, and encourage you to try back once the maintenance is completed.');
                return false;
            });
        });
    </script>
	*/
	?>
	<div class="agency-content">
		<?php
		$edit_var = $_GET['edit-agency'];
		if(empty($edit_var) || $edit_var != 'true')
		{
			$logo_new = get_field('logo');
			$logo_in = !empty($logo_new) ? $logo_new['url'] : $default_img_url;
			$challenge_count = do_shortcode('[display-agency return_found="true" post_type="challenge" taxonomy="agency" tax_term="'.$this_title.'" posts_per_page="-1"]');
			$draft_count = do_shortcode('[display-agency return_found="true" post_status="draft" post_type="challenge" taxonomy="agency" tax_term="'.$this_title.'" posts_per_page="-1"]');
			if(isset($_GET['newsletter-saved']) && $_GET['newsletter-saved'] == 'true'){
                ?>
                <div id="solution-submitted"><strong>Your newsletter has been saved.</strong><span id="solution-submitted-close"><a href="#">&times;</a></span><br/><br/>
                You have successfully saved a newsletter to be sent out for <?php the_title(); ?>. Once submitted for approval the Challenge team will add this newsletter to the outgoing mail queue pending approval. <u>If this was previously submitted for approval, by resaving you will need to submit this for approval again.</u></br><br/>
                For questions about the Challenge.gov program, contact <a href="mailto:challenge@gsa.gov">challenge@gsa.gov</a>.</div>
                <?php
            }
		?>
			<!--Agency Starts here -->
        <h2 class="page-title"><?php echo $this_title; ?></h2>
          <div class="container page-content">
               <div class="row">
              <div class="column col-md-12">
                
                  <?php
						$ancestry = get_agency_hierarchy();
						if ( !empty($ancestry) )
						{
							echo " {$ancestry} <br /><br />";
						}
					?>
              </div>
          </div>
			

			<div class="container row">
            <div class="col-md-3 col-sm-12 col-xs-12">
		    <nav class="nav-sidebar">
		    	<div class="thumbnail" ><img src="<?php echo $logo_in; ?>"  alt="<?php the_title();?> image" /></div>
				<ul class="nav tabs single-challenge-tabs">
		          	<li class="active"><a href="#tab1" data-toggle="tab">Home</a></li>
		          	<li class=""><a href="#tab2" data-toggle="tab">Discussions <span class="badge pull-right"><?php echo $comment_count["approved"]; ?></span></a></li>
		          	<li class=""><a href="#tab3" data-toggle="tab">Challenges<span class="badge pull-right"><?php echo $challenge_count; ?></span></a></li> 
		          	<?php //if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$post->ID,'post-id') || get_current_user_id() == $post->post_author))){ // or your id created this //user is agency admin
		          		if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || get_current_user_id() == $post->post_author)){ // or your id created this //user is agency admin
		            ?><li class=""><a href="#tab4" data-toggle="tab">Challenge Drafts<span class="badge pull-right"><?php echo $draft_count; ?></span></a></li>
		            <li class=""><a href="<?php echo add_query_arg( 'edit-agency', 'true', get_permalink() ); ?>">Edit Agency</a></li>
		            <?php
		            if(current_user_can('create_users')){
		            	?>
		            <li id="send_newsletter" class=""><a href="#tab5" data-toggle="tab">Send Newsletter</a></li>
		            <?php
		        		}
		            } ?>
				</ul>
			</nav>
			<?php //get_sidebar('challenge'); ?>
		    </div>
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="tab-content single-challenge-tab-content">
                    <div class="tab-pane active  text-style" id="tab1">
				  <div class="col-md-8 col-sm-12 col-xs-12">   
					<div class="agency-tab">
						<div class="agency-top">
							<div class="challenge-top-text">
								<h3 class="agency-challenges-header">Agency Info</h3><?php echo get_field('agency_info'); ?>
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
					</div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">  
                        <div style="padding-bottom: 15px;">
						<?php 
						if(is_user_logged_in())
						{
						   $arr_param=array('follow-agency'=>true,'agency_id'=>get_the_ID());
						   $redirect_link=add_query_arg($arr_param,get_permalink());
						}
						else{
						   $redirect_link = site_url('login');
						}
						$user_ID = get_current_user_id();

						$following_agency=get_post_meta(get_the_ID(),'followed_agency', true);

						if(!empty($following_agency)) 
						{
							if($user_ID!=0 && in_array($user_ID, $following_agency))
							{
								echo "<div class='thank_you_follower' name='follow_challenge'>Thank you for following us!</div>";
							}else{
								?>
								<input type='button' title = "By clicking this link you indicate that you are interested in recieving updates about this Agency." class='acf-button' name='follow_agency' value='Follow this agency' onclick='document.location.href="<?php echo $redirect_link;?>"' style="background:#f80;border: solid 1px #ccc;">
								<?php
							}
						}else{
							?>
							<input type='button' title = "By clicking this link you indicate that you are interested in recieving updates about this Agency." class='acf-button' name='follow_agency' value='Follow this agency' onclick='document.location.href="<?php echo $redirect_link;?>"' style="background:#f80;border: solid 1px #ccc;">
							<?php
						}
						?>
						</div>
					<div class="social-share">
                        <h5>Share and Subscribe</h5>
                        <?php
                            $customAddThis = array('size' => '16');
                        	do_action('addthis_widget'); ?>
                    </div>
                    <div class="social-share">
                        <h5>Latest Discussion</h5>
                        <div class="comments"><?php echo do_shortcode('[display-this-object-comments]'); ?></div>
                    </div>
                        </div>
				</div>
				<div class="tab-pane text-style" id="tab2">
					<?php comments_template(); ?>
                </div>
				<div class="tab-pane text-style" id="tab3">
					<div class="agency-challenges thumbnails">
						<?php
							if($challenge_count > 0)
							echo do_shortcode('[display-agency post_type="challenge" taxonomy="agency" tax_term="'.$this_title.'" item_class="front-challenge-item" posts_per_page="-1"]');
							else
								echo "<center><strong>No challenges have been posted for this agency yet.</strong></center>";
						?>

					</div>
				</div>
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
				if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || get_current_user_id() == $post->post_author)){
				?>
				<div class="tab-pane text-style" id="tab4">
					<div class="agency-contact thumbnails">
						<?php
						if($draft_count > 0)
							echo do_shortcode('[display-agency post_type="challenge" post_status="draft" taxonomy="agency" tax_term="'.$this_title.'" item_class="front-challenge-item" posts_per_page="-1"]');
						else
							echo "<center><strong>No drafts have been created for this agency yet.</strong></center>";
						?>
					</div>
				</div>
				<?php
				if(current_user_can('create_users')){
					?>
				<div class="tab-pane text-style" id="tab5">
                    <span class="challenges-header-right">Send <?php the_title(); ?> Newsletter</span>
                    <?php echo do_shortcode('[challenge-newsletter type="agency" id="' . get_the_ID() .'"]'); ?>
                </div>
					<?php
					}
				}
				?>
			</div></div></div></div>
			<?php /*
			Submission ends:&nbsp;<?php date("M d, Y",((int)get_field('submission_end'))); ?>
			*/
			?>
<?php
		}
		else
		{
			//if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$post->ID,'post-id') || get_current_user_id() == $post->post_author)))
			if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || get_current_user_id() == $post->post_author))
			{
			  /*
			  ?>
				<script type="text/javascript">
                 	jQuery(document).ready(function($){
                        $('form#update-agency input[type="submit"]').click(function(){
                            alert('Challenge.gov is undergoing scheduled maintenance. Between the hours of 8 p.m. EST and 10 p.m. EST tonight, the Challenge.gov database will be in read-only mode. It will be unable to save new registrations, profile updates, submissions or comments during this time. We apologize for this inconvenience, and encourage you to try back once the maintenance is completed.');
                            return false;
                        });
                    });
                </script>
				<?php
				*/
				$formattedpageurl = site_url('','http').challenge_permalink($post->ID);
				//$page_url =
				//$formattedpageurl .= $page_url;
				echo '<h2 class="container  page-title">Editing Agency: <small><a href="'.$formattedpageurl.'" style="text-decoration:none;">'.$post->post_title.'</a></small></h2>';
				$agency_args = array(
				    'post_id' => $post->ID, // post id to get field groups from and save data to
				    'field_groups' => array(), // this will find the field groups for this post (post ID's of the acf post objects)
				    'form' => true, // set this to false to prevent the <form> tag from being created
				    'form_attributes' => array( // attributes will be added to the form element
				        'id' => 'update-agency',
				        'class' => 'container page-content inline-form ',
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

	</div></div>
	<?php
	
function custom_and_or($where) {
	

	$where = str_replace("meta_key = 'partner_agency_%_partner_agency'", "meta_key LIKE 'partner_agency_%_partner_agency'", $where);
	
	return $where;
}
	get_footer();
?>
