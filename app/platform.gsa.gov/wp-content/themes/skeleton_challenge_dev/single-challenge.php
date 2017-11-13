<?php
/**
 * The Template for displaying all single challenge.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */
acf_form_head();
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
		$secure_connection = 's';
	}
	else
		$secure_connection = '';
	$default_img_url = "http".$secure_connection."://challenge.sites.usa.gov/files/2013/12/default-image.gif";
	
	get_header();
	
	add_shortcode( 'display-solution', 'sl_display_posts_shortcode' );

function sl_display_posts_shortcode( $atts ) {
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
		'challenge_id'		  => '',
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
		'post_type'           => 'solution',
		'posts_per_page'      => '10',
		'return_found'		  => false,
		'tag'                 => '',
		'tax_operator'        => 'IN',
		'tax_term'            => false,
		'taxonomy'            => false,
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
	$wrapper = sanitize_text_field( $atts['wrapper'] );

	
	// Set up initial query for post
$args = array(
		//'category_name'       => $category,
		//'order'               => $order,
		//'orderby'             => $orderby,
		'post_type'           => 'solution',
		'posts_per_page'      => 50,
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

		$title = '<a class="title" href="' . $link_out . '">' . apply_filters( 'the_title', get_the_title() ) . '</a>';

		if($post->post_status == 'draft' || $post->post_status == 'pending')
			$title .= " <span style=\"display:inline-block;\">&nbsp-&nbsp;<span style=\"color:red;\">Hidden</span></span>";

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
		
		if($public_voting_start) {
			if($public_voting_start >= $adjusted_timestamp)
				$show_rating = false;
		}
		if($public_voting_end){
			if($public_voting_end <= $adjusted_timestamp)
				$show_rating = false;
		}
		$pub_voting_status = get_field('enable_public_voting',$challenge_id);

		if(($pub_voting_status != "off") && $show_rating){
			if(function_exists('the_ratings')) {  $rating .= the_ratings('div',0,false); }
		}
		else{
			if(function_exists('the_ratings')) {  $rating .= the_rating_passive('div', 0, false); }
		}
		
		$logo_new = get_field('image_logo');
		$logo_in = !empty($logo_new) ? $logo_new['url'] : $default_img_url;

		$tagline_new = get_field('tag-line');
		$tagline_in = !empty($tagline_new) ? "<span class=\"front-challenge-tagline\">".$tagline_new."</span>" : "";
		
		
		$output = '<div class="front-challenge-item-container"><' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">'.'<a href="' . $link_out . '"><img src="'.$logo_in.'" class="front-challenge-img"></a><div class="front-challenge-innertext">' . $image . $title . $date . $excerpt . $content . $tagline_in . $rating . '</div></' . $inner_wrapper . '>';
		$output .='<div class="front-challenge-summary"><div class="front-challenge-summary-inner"><span class="summary-item-text">'.strip_tags(substr(get_field('description'),0,100)).'</span></div></div></div><div class="clear"></div>';
		
		
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
	?>

	<div class="challenge-content">
		<?php
		$edit_var = $_GET['edit-challenge'];
		$edit_var2 = $_GET['new-solution'];
		if((empty($edit_var) || $edit_var != 'true') && (empty($edit_var2) || $edit_var2 != 'true')) {
            ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php
                $custom_fields = get_post_custom(get_the_ID());
                $logo_new = get_field('logo');
                $tag_line = get_field('tag-line');
                $logo_in = !empty($logo_new) ? $logo_new['url'] : $default_img_url;
                global $post;
                $categories = wp_get_post_terms($post->ID, 'agency', array("fields" => "all"));
                $separator = ', ';
                $agencies = '';

                if ($categories) {
                    $counter = 0;
                    foreach ($categories as $category) {
                        $counter++;
                        $agencies .= '<a href="' . get_term_link($category->term_id, 'agency') . '" title="' . esc_attr(sprintf(__("View all challenges in %s"), $category->name)) . '">' . $category->name . '</a>' . ($counter < count($categories) ? $separator : '');
                    }
                }
                $comment_count = (array)wp_count_comments(get_the_ID());
                $solution_count = do_shortcode('[display-solution return_found="true" challenge_id="' . get_the_ID() . '"]');
                $manage_solution_count = do_shortcode('[display-solution return_found="true" post_status="publish, pending, draft" challenge_id="' . get_the_ID() . '"]');
                $where_host = get_field('where_host');
                $external_url = get_field('external_challenge_url');
                ?>

                <h1 class="entry-title">
                    <?php
                    the_title();


                    if ($post->post_status == 'draft') {
                        ?>
                        -&nbsp;<span style="color:red;">Draft</span>
                    <?php
                    }
                    ?></h1>
                <?php
                if ($where_host == "remote") {
                    wp_register_script( 'list_hover', get_template_directory_uri() . '/javascripts/redirect_list.js'  );
                    wp_enqueue_script( 'list_hover' );

                    print '<div class="external_challenge">This is an external challenge hosted at: <a class="external_link_path" target="_blank" href="' . $external_url . '">' . $external_url . '</a></div>';
                    print '<div class="external_link_timer">You will be redirected in <span class="internal_timer">10</span> seconds.</div>';
                }
                else {
                    ?>
                    <ul class="tabs">
                        <li class="active"><a href="#t1" class="active">Details</a></li>
                        <li><a href="#t2">Discussions (<?php echo $comment_count["approved"]; ?>)</a></li>
                        <li><a href="#t3">Solutions (<?php echo $solution_count; ?>)</a></li>

                        <?php
                        if (is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(), $post->ID, 'category-id') || get_current_user_id() == $post->post_author))) // or your id created this //user is agency admin
                        {
                            ?>
                            <li style="border-right:1px solid #ddd;"><a href="#t4">Rules</a></li>
                            <li class="right-tab"><?php //<a href="#tlast"> ?><a
                                    href="<?php echo add_query_arg('edit-challenge', 'true', get_permalink()); ?>">Edit
                                    this
                                    Challenge</a></li>
                            <li class="second-last"><a href="#t5">Manage Solutions
                                    (<?php echo $manage_solution_count; ?>)</a></li>
                        <?php
                        } else {
                            ?>
                            <li><a href="#t4">Rules</a></li>
                            <li><a href="#tlast">Submit Solution</a></li>
                        <?php
                        }
                        $partners = get_field('partners');
                        $partners = !empty($partners) ? "<br/>Partners: " . $partners : '';
                        $challenge_cat = get_field('category');
                        $tag_url = add_query_arg('tag', $challenge_cat, site_url());
                        $challenge_cat = (!empty($challenge_cat) && $challenge_cat != 'None') ? "<br/>Category: <a href=\"" . add_query_arg('post_type', 'challenge', $tag_url) . "\">" . $challenge_cat . "</a>" : '';
                        ?>
                    </ul>
                    <ul class="tabs-content">
                    <li id="t1Tab" class="active">
                    <div class="challenge-tab">
                    <div class="challenge-top">
                        <img class="challenge-image-top" src="<?php echo $logo_in; ?>">

                        <div class="challenge-top-text">
                            <?php echo !empty($agencies) ? '<span class="challenge-posted-by">Posted By: ' . $agencies . $partners . $challenge_cat . '</span>' : ''; ?>
                            <?php echo !empty($tag_line) ? '<span class="challenge-tag-line">' . $tag_line . '</span>' : ''; ?>
                            <?php
                            $submission_start = get_field('submission_start');
                            $submission_end = get_field('submission_end');

                            $public_voting_start = get_field('public_voting_start');
                            $public_voting_end = get_field('public_voting_end');

                            $judging_start = get_field('judging_start');
                            $judging_end = get_field('judging_end');

                            $winners_announced = get_field('winners_announced');

                            $the_prizes = get_field('the_prizes');
                            $prize_display = get_field('prizes-display');
                            $prize_text = "Prizes";

                            $date_text = "";

                            /*<span class="challenge-submission-date">Submission Deadline: <strong><?php echo verify_challenge_datetime_view(get_field('submission_end')); ?></strong></span>*/
                            if (!empty($submission_start) || !empty($submission_end)):
                                $date_text = "Dates"; //Dates, Deadline or Start Date
                                if (empty($submission_start)) //No start, only end date
                                    $date_text = "Deadline";
                                elseif (empty($submission_end))
                                    $date_text = "Start Date";
                                ?>
                                <span class="challenge-submission-date">Submission <?php echo $date_text; ?>
                                    : <strong><?php echo !empty($submission_start) ? verify_challenge_datetime_view($submission_start) : ''; ?><?php echo (!empty($submission_start) && !empty($submission_end)) ? ' - ' : ''; ?><?php echo !empty($submission_end) ? verify_challenge_datetime_view($submission_end) : ''; ?></strong></span>
                            <?php
                            endif;

                            if (!empty($public_voting_start) || !empty($public_voting_end)):
                                $date_text = "Dates"; //Dates, Deadline or Start Date
                                if (empty($public_voting_start)) //No start, only end date
                                    $date_text = "Deadline";
                                elseif (empty($public_voting_end))
                                    $date_text = "Start Date";
                                ?>
                                <span class="challenge-pubvote-date">Public Voting <?php echo $date_text; ?>
                                    : <strong><?php echo !empty($public_voting_start) ? verify_challenge_datetime_view($public_voting_start) : ''; ?><?php echo (!empty($public_voting_start) && !empty($public_voting_end)) ? ' - ' : ''; ?><?php echo !empty($public_voting_end) ? verify_challenge_datetime_view($public_voting_end) : ''; ?></strong></span>
                            <?php
                            endif;

                            if (!empty($judging_start) || !empty($judging_end)):
                                $date_text = "Dates"; //Dates, Deadline or Start Date
                                if (empty($judging_start)) //No start, only end date
                                    $date_text = "Deadline";
                                elseif (empty($judging_end))
                                    $date_text = "Start Date";
                                ?>
                                <span class="challenge-judging-date">Judging <?php echo $date_text; ?>
                                    : <strong><?php echo !empty($judging_start) ? verify_challenge_datetime_view($judging_start) : ''; ?><?php echo (!empty($judging_start) && !empty($judging_end)) ? ' - ' : ''; ?><?php echo !empty($judging_end) ? verify_challenge_datetime_view($judging_end) : ''; ?></strong></span>
                            <?php
                            endif;

                            if (!empty($winners_announced)):
                                ?>
                                <span
                                    class="challenge-winnerannounce-date">Winners Announced: <strong><?php echo verify_challenge_datetime_view($winners_announced); ?></strong></span>
                            <?php
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="challenge-inner">
                        <?php
                        $the_prizes = get_field('the_prizes');
                        $prize_display = get_field('prizes-display');
                        $prize_text = "Prizes";
                        $show_winners = false;
                        if (!empty($prize_display) && $prize_display == "winners") //as long as name or title empty, will not show winners
                        {
                            $show_winners = true;
                            $prize_text = "Winners";
                        }
                        if (isset($the_prizes) && !empty($the_prizes) && ($the_prizes[0]['the_prize_name'] != "" || ($the_prizes[0]['is_cash_prize'] && !empty($the_prizes[0]['the_cash_amount'])))) //There's at least one prize name or cash
                        {
                            ?>
                            <div class="challenge-prizes">
                                <span class="challenge-prizes-header"><?php echo $prize_text; ?></span>
                                <?php
                                foreach ($the_prizes as $this_prize) {
                                    $this_cash_value = $this_prize['the_cash_amount'];
                                    if (strpos($this_prize['the_cash_amount'], '$') !== false)
                                        $this_cash_value = str_replace("$", "", $this_prize['the_cash_amount']);

                                    $this_cash_value = str_replace(",", "", $this_cash_value);
                                    $this_cash_value = number_format((double)$this_cash_value, 2, '.', ',');

                                    if (!empty($the_prizes) && !empty($this_prize) && (!empty($this_prize['the_prize_name']) || !empty($this_prize['the_prize_description']) || ($this_prize['is_cash_prize'] === true && !empty($this_prize['the_cash_amount'])))) {
                                        ?>
                                        <div class="challenge-prize-item">
                                            <span class="challenge-prize-icon"></span>

                                            <div class="challenge-prize-inner">
                                            <span
                                                class="challenge-prize-item-title"><?php echo $this_prize['the_prize_name']; ?></span>
                                                <?php
                                                if ($this_prize['is_cash_prize']) {
                                                    ?>
                                                    <span
                                                        class="challenge-prize-item-amount">$<?php echo $this_cash_value; ?></span>
                                                <?php
                                                }
                                                ?>
                                                <span class="challenge-prize-item-info">
														<?php echo $this_prize['the_prize_description']; ?>
													</span>
                                                <?php
                                                if ($show_winners):
                                                    ?>
                                                    <span class="challenge-prize-item-winner-info">
																<strong>Won
                                                                    by: <?php echo $this_prize['the_winner_name']; ?></strong><br/>
																Solution: <?php echo $this_prize['winning_solution_title']; ?>
                                                        <br/>
																Description: <?php echo $this_prize['winning_solution_description']; ?>
															</span>
                                                <?php
                                                endif;
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                        //$this_winner->test_prize_description;
                                    }
                                }

                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="challenge-description">
                            <span class="challenge-description-header">About the Challenge</span>

                            <div class="challenge-description-item"><?php echo get_field('description'); ?></div>
                        </div>
                        <?php

                        $user_instructions = get_field('user_instructions');
                        if (!empty($user_instructions)): ?>
                            <div class="challenge-instruct">
                                <span class="challenge-instruct-header">Instructions</span>

                                <div class="challenge-instruct-item"><?php echo get_field('user_instructions'); ?></div>
                            </div>
                        <?php endif; ?>
                        <?php
                        $the_judges = get_field('the_judges');
                        $show_titles = get_field('show_title_org');
                        $the_judging_criteria = get_field('the_judging_criteria');
                        if (!empty($the_judges) || !empty($the_judging_criteria)):
                            ?>
                            <div class="challenge-judging">
                                <?php
                                if (!empty($the_judges) && $the_judges[0]['this_judge_name'] != "") {
                                    ?>
                                    <div class="challenge-judges">
                                        <span class="challenge-judges-header">Judges</span>
                                        <?php
                                        foreach ($the_judges as $this_judge) {
                                            if (!empty($this_judge['this_judge_name'])) {
                                                ?>
                                                <div class="challenge-judges-item">
                                                    <strong><?php echo trim($this_judge['this_judge_name']); ?></strong>
                                                    <?php
                                                    if (isset($show_titles) && !empty($show_titles)) {
                                                        echo "<br/><small>" . $this_judge['this_judge_title_org'] . "</small>";
                                                    }
                                                    ?>
                                                </div>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                <?php
                                }
                                $show_percentage = get_field('show_judging_percentage');
                                if (!empty($the_judging_criteria) && $the_judging_criteria[0]['this_judging_criteria'] != "") {
                                    ?>
                                    <div class="challenge-judging-criteria">
                                        <span class="challenge-judging-criteria-header">Judging Criteria</span>
                                        <span class="clear"></span>
                                        <?php
                                        foreach ($the_judging_criteria as $this_criteria) {
                                            if (!empty($this_criteria['this_judging_criteria']) || !empty($this_criteria['this_judging_description'])) {
                                                ?>
                                                <div class="challenge-judging-item">
                                                    <p>
                                                        <strong><?php echo $this_criteria['this_judging_criteria']; ?></strong>
                                                        <?php
                                                        if (!empty($show_percentage)) {
                                                            $this_judging_percentage = $this_criteria['this_judging_percentage'];
                                                            if (strpos($this_criteria['this_judging_percentage'], '%') !== false)
                                                                $this_judging_percentage = str_replace("%", "", $this_criteria['this_judging_percentage']);
                                                            ?>
                                                            <?php echo "- " . $this_judging_percentage; ?>%
                                                        <?php
                                                        }
                                                        ?>
                                                    </p>

                                                    <p><?php echo $this_criteria['this_judging_description']; ?></p>
                                                </div>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php
                        $how_to_enter = get_field('how_to_enter');
                        if (!empty($how_to_enter)): ?>
                            <div class="challenge-enter">
                                <span class="challenge-enter-header">How to Enter</span>

                                <div class="challenge-enter-item"><?php echo get_field('how_to_enter'); ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php get_sidebar('challenge'); ?>
                    </div>
                    </li>
                    <li id="t2Tab" style="text-align:center;"><?php comments_template(); ?></li>
                    <li id="t3Tab">
                        <div class="challenge-solutions">
                            <?php
                            if ($solution_count > 0)
                                echo do_shortcode('[display-solution item_class="front-challenge-item" challenge_id="' . get_the_ID() . '"]');
                            else
                                echo "<center><strong>No solutions have been posted for this challenge yet.</strong></center>";
                            ?>
                        </div>
                    </li>
                    <li id="t4Tab">
                        <div class="challenge-rules">
                            <span class="agency-challenges-header">Rules</span>
                            <?php echo get_field('rules'); ?>
                        </div>
                    </li>
                    <?php
                    /*
                    <li id="tlastTab">
                        <div class="challenge-submission">
                            Form Here (Or redirection)
                        </div>
                    </li>
                    */
                    //if(is_user_logged_in()) //user is agency admin
                    if (is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(), $post->ID, 'category-id') || get_current_user_id() == $post->post_author))) // or your id created this //user is agency admin
                    {
                        ?>
                        <li id="t5Tab">
                            <div class="challenge-container-inner">
                                <span class="agency-challenges-header">Manage Solutions</span>
                                <?php /*
							$solution_args = array(
								//'field_groups' => array('description','tag-line'), // this will find the field groups for this post (post ID's of the acf post objects)
				    			'form' => true, // set this to false to prevent the <form> tag from being created
							    'form_attributes' => array( // attributes will be added to the form element
							        'id' => 'create-solution',
							        'class' => '',
							        'action' => PARENT_URL .'/challenge-post-process.php',
							        'method' => 'post',
							    ),
								'post_id' => 'new-solution',
								'post_type' => 'solution',
								'field_groups' => array(395),
								'return' => add_query_arg( 'newsolution', 'true', get_permalink() ), // return url
							    'html_before_fields' => '', // html inside form before fields
							    'html_after_fields' => '<input type="hidden" value="'.get_the_ID().'" name="challenge-post-id">', // html inside form after fields
							    'submit_value' => 'Create Solution', // value for submit field
							    'updated_message' => '', // default updated message. Can be false t
							);
					//$return_form .= '<form method="post" action="'.PARENT_URL .'/challenge-post-process.php" name="challenge-create-form">';
							acf_form( $solution_args ); */
                                ?>
                                <center><strong><a
                                            href="<?php echo add_query_arg('new-solution', 'true', get_permalink()); ?>">Click
                                            here to add a new solution for this Challenge.</a></strong></center>
                                <br/><br/>
                                <?php
                                echo do_shortcode('[display-solution item_class="front-challenge-item" post_status="publish, pending, draft" challenge_id="' . get_the_ID() . '"]');
                                ?>
                            </div>
                        </li>
                        <li id="tlastTab">
                            Will be styled (Possibly Accordion?)
                            <?php
                            //echo "<br/><strong>Challenge Created on ".get_the_date()." by: ".get_the_author()."</strong>";
                            $challenge_args = array(
                                'post_id' => $post->ID, // post id to get field groups from and save data to
                                'field_groups' => array(23), // this will find the field groups for this post (post ID's of the acf post objects)
                                'form' => true, // set this to false to prevent the <form> tag from being created
                                'form_attributes' => array( // attributes will be added to the form element
                                    'id' => 'update-challenge',
                                    'class' => '',
                                    'action' => '',
                                    //'action' => PARENT_URL .'/challenge-post-process.php',
                                    'method' => 'post',
                                ),
                                'return' => add_query_arg('updated', 'true', get_permalink()), // return url
                                'html_before_fields' => '', // html inside form before fields
                                'html_after_fields' => '<input type="hidden" value="challenge-update" name="challenge-post-type">', // html inside form after fields
                                'submit_value' => 'Update', // value for submit field
                                'updated_message' => '<span class="green">Challenge updated.</span>', // default updated message. Can be false to show no message
                            );
                            //acf_form_head();
                            //acf_form( $challenge_args );
                            ?>
                        </li>
                    <?php
                    } else {
                        ?>
                        <li id="tlastTab">
                            <div class="challenge-container-inner">
                                <?php
                                if (!empty($submission_end)) {
                                    $dt = DateTime::createFromFormat('U', time());
                                    $dt->setTimeZone(new DateTimeZone('America/New_York'));
                                    $adjusted_timestamp = $dt->format('U') + $dt->getOffset();

                                    if ($submission_end >= $adjusted_timestamp) {
                                        echo do_shortcode('[contact-form-7 id="' . get_post_meta(get_the_ID(), 'challenge_wpcf7_id', true) . '" title="Submit Solution"]');
                                        $terms_conditions = get_field('terms_conditions');
                                        echo '<span class="agency-challenges-header">Terms and Conditions</span><br/><br/>';
                                        if (!empty($terms_conditions)) {
                                            ?>
                                            <div id="submit-terms-conditions" class="solution-submit-terms">
                                                <?php echo $terms_conditions; ?>
                                            </div>
                                        <?php
                                        }
                                    } else
                                        echo "<center><strong>The submission period for this Challenge has ended.<strong></center>";

                                } else
                                    echo "<center><strong>Submissions for this Challenge are closed.</strong></center>";
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
                }
                    ?>
                    <?php endwhile; ?>
                <?php
		}
		elseif (!empty($edit_var2) && $edit_var2 == 'true') {
			if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$post->ID,'category-id') || (get_current_user_id() == $post->post_author) ) ) )
			{
				$formattedpageurl = site_url('','http').challenge_permalink($post->ID);
				//$page_url =
				//$formattedpageurl .= $page_url;
				echo '<span class="agency-challenges-header" style="margin-top:10px;">New Solution for Challenge: <strong><a href="'.$formattedpageurl.'" style="text-decoration:none;">'.$post->post_title.'</a></strong>';
				$user = get_user_by( 'id', $post->post_author );
				echo "<br/><span style=\"font-size:14px;text-transform:none;font-weight:normal;\"> Challenge Created on ".get_the_date()." by: <strong>".$user->user_login."</strong></span></span>";

				$solution_args = array(
								//'field_groups' => array('description','tag-line'), // this will find the field groups for this post (post ID's of the acf post objects)
				    			'form' => true, // set this to false to prevent the <form> tag from being created
							    'form_attributes' => array( // attributes will be added to the form element
							        'id' => 'create-solution',
							        'class' => '',
							        'action' => PARENT_URL .'/challenge-post-process.php',
							        'method' => 'post',
							    ),
								'post_id' => 'new-solution',
								'post_type' => 'solution',
								'field_groups' => array(395),
								'return' => add_query_arg( 'solution-created', 'true', get_permalink() ), // return url
							    'html_before_fields' => '', // html inside form before fields
							    'html_after_fields' => '<input type="hidden" value="'.get_the_ID().'" name="challenge-post-id">', // html inside form after fields
							    'submit_value' => 'Create Solution', // value for submit field
							    'updated_message' => '', // default updated message. Can be false t
							);

				if(current_user_can('publish_posts'))
					$return_form .= acf_form( $solution_args );
				else
					echo '<div style="min-height:350px;">You do not have access to edit this Challenge.<br/><a href='.site_url().'>Click here to return home</a></div>';
			}
			else
				echo '<div style="min-height:350px;">You do not have access to edit this Challenge.<br/><a href='.site_url().'>Click here to return home</a></div>';
		}
		else //edit
		{
			$categories = wp_get_post_terms($post->ID, 'agency', array("fields" => "all"));
			//echo $categories[0]->term_id." === Debug";
			//echo get_max_agency_codes()." ==Debug";
			if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$post->ID,'category-id') || (get_current_user_id() == $post->post_author) ) ) )
			{
				$formattedpageurl = site_url('','http').challenge_permalink($post->ID);
				//$page_url =
				//$formattedpageurl .= $page_url;
				echo '<span class="agency-challenges-header" style="margin-top:10px;">Editing Challenge: <strong><a href="'.$formattedpageurl.'" style="text-decoration:none;">'.$post->post_title.'</a></strong>';
				if($post->post_status == 'draft' || $post->post_status == 'pending')
				{
				?>
					-&nbsp;<span style="color:red;">Draft</span>
				<?php
				}
				$user = get_user_by( 'id', $post->post_author );
				echo "<br/><span style=\"font-size:14px;text-transform:none;font-weight:normal;\"> Challenge Created on ".get_the_date()." by: <strong>".$user->user_login."</strong></span></span>";
				$select_embed = "";
				$session_code = get_max_agency_codes();
				if(!empty($session_code) && $session_code != 0)
				{
					$select_id = max_agency_match_codes($session_code,'category-id');
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
							'post_id' => $post->ID,
							'post_type' => 'challenge',
							'field_groups' => array(23),
							'return' => add_query_arg( 'edit-challenge', 'true', get_permalink() ), // return url
						    'html_before_fields' => '',
						    'html_after_fields' => '<input type="hidden" value="challenge-update" name="challenge-post-type"><label for="challenge-publish_state">Published Status: </label>&nbsp;&nbsp;&nbsp;<select name="challenge-publish_state" class="select"><option value="draft"'.($post->post_status == 'draft' ? ' selected' : '').'>Draft</option><option value="publish"'.($post->post_status == 'publish' ? ' selected' : '').'>Publish</option></select>
						    <small><br/>Select your save option:</small><br/><br/>', // html inside form after fields
						    'submit_value' => 'Update Challenge', // value for submit field
						    'updated_message' => '<span class="green">Your Challenge has been updated. </span>', // default updated message. Can be false t
						);
				//$return_form .= '<form method="post" action="'.PARENT_URL .'/challenge-post-process.php" name="challenge-create-form">';
				if(current_user_can('publish_posts'))
					$return_form .= acf_form( $args );
				else
					echo '<div style="min-height:350px;">You do not have access to edit this Challenge.<br/><a href='.site_url().'>Click here to return home</a></div>';
				//$return_form .= '<p><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p></form>';
				//var_dump($user);
				//echo $return_form;
			}
			else
				echo '<div style="min-height:350px;">You do not have access to edit this Challenge.<br/><a href='.site_url().'>Click here to return home</a></div>';
		}
		?>
	</div>
	<?php
	//get_sidebar('page');
	//st_after_content();
	get_footer();
?>