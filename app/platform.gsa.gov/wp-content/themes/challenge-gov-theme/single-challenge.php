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
//$default_img_url = "//platform.gsa.gov/wp-content/uploads/sites/51/2013/12/default-image.gif";

//if(strpos(get_site_url('http'), "http://localhost/") !== false || strpos(get_site_url('http'), "http://sites.usa.local") !== false) //override if local dev
    $default_img_url = get_template_directory_uri().'/images/default-image.gif';
 
if(isset($_GET['follow-challenge']) && $_GET['follow-challenge']==1 && isset($_GET['challenge_id']) && $_GET['challenge_id']!="" )
{
    $user_ID = get_current_user_id();
    
    $user_followed_challenges = get_post_meta( $_GET['challenge_id'], 'followed_challenges', 1);
   
    if($user_followed_challenges!="")
    {
        
        if(!in_array($user_ID,$user_followed_challenges))
        {
            array_push($user_followed_challenges,$user_ID);
            
        }
         //print_r($user_followed_challenges);
    }
   else{
    $user_followed_challenges[]=$user_ID;
   
   }
    
    update_post_meta($_GET['challenge_id'], 'followed_challenges', $user_followed_challenges);
    //update_user_meta($current_user->ID, 'followed_challenges',$user_followed_challenges );
   
   
}
get_header();
?>
<style type="text/css">
  #tab3 .row,
  #tab6 .row{margin:0;}
  #tab3 .container,
  #tab6 .container{width:100%;padding:0;}
  #tab3 .col-md-12,
  #tab6 .col-md-12{padding:0;}
  #tab3 .solution-thumbnail-header,
  #tab6 .solution-thumbnail-header{
    height:55px;
    position: relative;
  }
  #tab3 .display-posts-listing h4,
  #tab6 .display-posts-listing h4{
    position: absolute;
    max-height: 55px;
    margin: 0;
    vertical-align: bottom;
    bottom: 0;
    height: auto;
    width:100%;
  }
  #tab3 .display-posts-listing h4 a,
  #tab6 .display-posts-listing h4 a{
    height:auto;
  }
  #tab3 .challenge-thumbnail,
  #tab6 .challenge-thumbnail{margin-bottom:5px;}
</style>
<script type="text/javascript">
		
	jQuery(document).ready(function($){
            function load_discussion()
                {
                    var pathname = window.location.href;
                    if(pathname.indexOf('#comment') > -1){
                        $("#discussion a").trigger( "click" );
                    }
                
                }
                load_discussion();
            function load_solution_submission_form(){
                var pathname = window.location.href;
                if (pathname.indexOf("tab") > -1){
                $("#submit-solution a").trigger( "click" );

                $("#challenge a, #challenge").removeClass("active");

            }
            }
            load_solution_submission_form();
            if($('#create-solution').length){
                $('#create-solution input[type="submit"]').prop('disabled', true);
                $('#create-solution input[type="submit"]').css({'background-color':'#ccc'});
            }
            $('#create-solution #acf-field-accept_terms-1').on('click', function(){
                if($(this).is(':checked')){
                    $('#create-solution input[type="submit"]').prop('disabled', false);
                $('#create-solution input[type="submit"]').css({'background-color':'#f80'});
                }else{
                    $('#create-solution input[type="submit"]').prop('disabled', true);
                    $('#create-solution input[type="submit"]').css({'background-color':'#ccc'});
                }
            });
            $('#create-solution label[for="acf-field-accept_terms"]').html('I accept the challenge <a href="#solution-terms-conditions">terms and conditions.</a>');
            $('#solution-submitted-close a').on('click', function(){
                $('#solution-submitted').slideUp();
            });
        });
</script> 
<div class="container">


    <div>
    <?php
    $edit_var = $_GET['edit-challenge'];
    $edit_var2 = $_GET['new-solution'];
    //$edit_var3 = $_GET['newsletter'];
    if((empty($edit_var) || $edit_var != 'true') && (empty($edit_var2) || $edit_var2 != 'true') ) {
        ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php
            $custom_fields = get_post_custom(get_the_ID());
              
              $userinfo_temp = get_post_meta( get_the_ID(), 'followed_challenges', 1);
		
             if($userinfo_temp!="")
             {
		foreach($userinfo_temp as $key=>$userid)
		{
		    if($userid!=0)
		    {	
	
			$follower_cnt++;  
		    }
		}
                $user_followed_challenge_count=$follower_cnt;
             }
             else{
                $user_followed_challenge_count=0;
             }
              
             
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

            if(isset($_GET['solution-created']) && $_GET['solution-created'] == 'true'){
                ?>
                <div id="solution-submitted"><strong>Congratulations!</strong><span id="solution-submitted-close"><a href="#">&times;</a></span><br/><br/>
                You have successfully submitted a solution to be considered for <?php the_title(); ?>. The <?php echo !empty($agencies) ? $agencies : 'agency'; ?> will consider your submission. Be sure to follow the challenge discussion board for updates and to submit any related questions.</br><br/>
                For questions about the Challenge.gov program, contact <a href="mailto:challenge@gsa.gov">challenge@gsa.gov</a>.</div>
                <?php
            }
            if(isset($_GET['newsletter-saved']) && $_GET['newsletter-saved'] == 'true'){
                ?>
                <div id="solution-submitted"><strong>Your newsletter has been saved.</strong><span id="solution-submitted-close"><a href="#">&times;</a></span><br/><br/>
                You have successfully saved a newsletter to be sent out for <?php the_title(); ?>. Once submitted for approval the Challenge team will add this newsletter to the outgoing mail queue pending approval. <u>If this was previously submitted for approval, by resaving you will need to submit this for approval again.</u></br><br/>
                For questions about the Challenge.gov program, contact <a href="mailto:challenge@gsa.gov">challenge@gsa.gov</a>.</div>
                <?php
            }
            ?>
              <!--Challenges Starts here -->
         <h2 class="page-title"><?php the_title();
                      if ($post->post_status == 'draft') {
                    ?>
                    -&nbsp;<span style="color:red;">Draft</span>
                <?php
                }
                ?></h2>
              <div class="container page-content">
                   <div class="row">
                  <div class="span12">
                     
                  </div>
              </div>

              <div class="row">
            <div class="span3">
    <nav class="nav-sidebar" id="sidebartabs">
        <?php echo !empty($agencies) ? '<div class="backlink"><i class="fa fa-chevron-circle-left link-look"></i> '.$agencies.'</div>' : '';?>
        <div class="thumbnail" ><img src="<?php echo $logo_in; ?>"  alt="<?php the_title();?> image" /></div>
        <ul class="nav tabs single-challenge-tabs"> 
          <li id="challenge" class="active"><a href="#tab1" data-toggle="tab">Challenge Details</a></li>
          <li id="discussion" class=""><a href="#tab2" data-toggle="tab">Discussions <span class="badge pull-right"><?php echo $comment_count["approved"];?></span></a></li>
          <li id="solution" class=""><a href="#tab3" data-toggle="tab">Solutions<span class="badge pull-right"><?php echo $solution_count;?></span></a></li> 
            <li id="rules" class=""><a href="#tab4" data-toggle="tab">Rules</a></li>
            <li id="submit-solution" class=""><a href="#tab5" data-toggle="tab">Submit Solution</a></li>
            <li id="follower-challenge" class=""><a href="#tab7" data-toggle="tab">Challenge Followers<span class="badge pull-right"><?php echo $user_followed_challenge_count; ?></span></a></li>
            <?php if (is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') )){ ?>
            <li id="manage-solution" class=""><a href="#tab6" data-toggle="tab">Manage Solutions<span class="badge pull-right"><?php echo $manage_solution_count;?></span></a></li>
            <li id="edit_challenge" class=""><a href="<?php echo add_query_arg( 'edit-challenge', 'true', get_permalink() ); ?>">Edit this Challenge</a></li>
            <?php
            if(current_user_can('create_users')){
                ?>
            <li id="send_newsletter" class=""><a href="#tab8" data-toggle="tab">Send Newsletter</a></li>
            <?php
                }
            } ?>
        </ul>
	<script type="text/javascript">
	     jQuery("#edit_challenge").on("click",function(){
		jQuery("#sidebartabs>ul>li.active, #sidebartabs>ul>li>a.active").removeClass("active");
		jQuery("#edit_challenge a").addClass("active");
		
	     });
	</script>
        <?php get_sidebar('challenge'); ?>
    </nav>
            </div>
            <div class="span8">
                
            <?php
            if ($where_host == "remote") {
                wp_register_script( 'list_hover', get_template_directory_uri() . '/javascripts/redirect_list.js'  );
                wp_enqueue_script( 'list_hover' );
                $pos = strpos($external_url, "http://");
                $pos1 = strpos($external_url, "https://");
                print '<div class="external_challenge">This is an external challenge hosted at: <a class="external_link_path" target="_blank" href="' . (($pos === 0 || $pos1 === 0) ? $external_url : "http://".$external_url) . '">' . $external_url . '</a></div>';
                print '<div class="external_link_timer">You will be redirected in <span class="internal_timer">10</span> seconds.</div>';
            }
            else{
                ?>
                <div class="tab-content single-challenge-tab-content">
                    <div class="tab-pane active text-style" id="tab1">
                <?php
                    $partners = get_field('partners');
                    $partners = !empty($partners) ? "<br/>Partners: " . $partners : '';
                    $partner_agency = get_field('partner_agency',$post->ID);
                   
                     if(!empty($partner_agency))
                    {
                        
                       foreach($partner_agency as $key => $this_partner_agency)
			         {
			
                       $partner_agency_title.='<a href="'.get_term_link( $this_partner_agency['partner_agency']->post_title, 'agency' ).'" title="' . esc_attr( sprintf( __( "View all challenges in %s" ), $this_partner_agency['partner_agency']->post_title ) ) . '">'.
                        ($this_partner_agency['partner_agency']->post_title).'</a>'."<br>";
			         }
                       // $partner_agency_title=substr($partner_agency_title,0,-2);
                    }
                    $challenge_cat = get_field('category',get_the_ID());
                    $these_cats = array();
                    if(gettype($challenge_cat)=="string")
                    {
                        $thiscat=$challenge_cat;
                        $tag_url = add_query_arg('tag', $thiscat, site_url());
                        switch($thiscat){
                            case "ScientificEngineering": $thiscat = "Scientific/Engineering"; break;
                            case "SoftwareApps": $thiscat = "Software/Apps"; break;
                            case "Media": $thiscat = "Multimedia"; break;
                        }
                       $these_cats[]= "<a href=\"" . add_query_arg('post_type', 'challenge', $tag_url) . "\">" . $thiscat . "</a>";
                    }
                    else{
                         foreach($challenge_cat as $thiscat)
                        {
                            $tag_url = add_query_arg('tag', $thiscat, site_url());
                                        switch($thiscat)
                            {
                                case "ScientificEngineering": $thiscat = "Scientific/Engineering"; break;
                                case "SoftwareApps": $thiscat = "Software/Apps"; break;
                                case "Media": $thiscat = "Multimedia"; break;
                            }
                            $these_cats[]= "<a href=\"" . add_query_arg('post_type', 'challenge', $tag_url) . "\">" . $thiscat . "</a>";
                        }
                    }
                   
                    $these_cats_output = implode(', ',$these_cats);
                    $challenge_cat_output = !empty($challenge_cat) ? "<br/>Category: ".$these_cats_output : '';
                    
                    //$tag_url = add_query_arg('tag', $challenge_cat, site_url());
                    //$challenge_cat_output = (!empty($challenge_cat) && $challenge_cat != 'None') ? "<br/>Category: <a href=\"" . add_query_arg('post_type', 'challenge', $tag_url) . "\">" . $challenge_cat . "</a>" : '';
                    ?>
               <div class="col-md-8 col-sm-12 col-xs-12">    
                <div class="challenge-tab">
                <div class="challenge-top">
                    <div class="challenge-description">
                        <span class="challenge-description-header">About the Challenge</span>
                        <div class="challenge-top-text">
                        <?php echo !empty($tag_line) ? '<span class="challenge-tag-line">' . $tag_line . '</span><br/><br/>' : ''; ?>
                        <?php echo !empty($agencies) ? '<span class="challenge-posted-by">Posted By: ' . $agencies . $challenge_cat_output . $partners . '</span>' : ''; ?>
                        <?php echo !empty($partner_agency) ? '<span class="challenge-posted-by">Partnership With: '.$partner_agency_title. '</span>' :''; ?>
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
                            <span class="challenge-submission-date">Submission <?php echo $date_text; ?>: <strong><?php echo !empty($submission_start) ? str_replace(array('am','pm'),array('a.m.','p.m.'), date((date('i', $submission_start) == '00' ? 'g a' : 'g:i a'), $submission_start)).' ET, '.verify_challenge_datetime_view($submission_start) : ''; ?><?php echo (!empty($submission_start) && !empty($submission_end)) ? ' - ' : ''; ?><?php echo !empty($submission_end) ? str_replace(array('am','pm'),array('a.m.','p.m.'),date((date('i', $submission_end) == '00' ? 'g a' : 'g:i a'), $submission_end)).' ET, '.verify_challenge_datetime_view($submission_end) : ''; ?></strong></span>
                        <?php
                        endif;

                        if (!empty($public_voting_start) || !empty($public_voting_end)):
                            $date_text = "Dates"; //Dates, Deadline or Start Date
                            if (empty($public_voting_start)) //No start, only end date
                                $date_text = "Deadline";
                            elseif (empty($public_voting_end))
                                $date_text = "Start Date";
                            ?>
                            <span class="challenge-pubvote-date">Public Voting <?php echo $date_text; ?>: <strong><?php echo !empty($public_voting_start) ? str_replace(array('am','pm'),array('a.m.','p.m.'), date((date('i', $public_voting_start) == '00' ? 'g a' : 'g:i a'), $public_voting_start)).' ET, '.verify_challenge_datetime_view($public_voting_start) : ''; ?><?php echo (!empty($public_voting_start) && !empty($public_voting_end)) ? ' - ' : ''; ?><?php echo !empty($public_voting_end) ? str_replace(array('am','pm'),array('a.m.','p.m.'),date((date('i', $public_voting_end) == '00' ? 'g a' : 'g:i a'), $public_voting_end)).' ET, '.verify_challenge_datetime_view($public_voting_end) : ''; ?></strong></span>
                        <?php
                        endif;

                        if (!empty($judging_start) || !empty($judging_end)):
                            $date_text = "Dates"; //Dates, Deadline or Start Date
                            if (empty($judging_start)) //No start, only end date
                                $date_text = "Deadline";
                            elseif (empty($judging_end))
                                $date_text = "Start Date";
                            ?>
                            <span class="challenge-judging-date">Judging <?php echo $date_text; ?>: <strong><?php echo !empty($judging_start) ? verify_challenge_datetime_view($judging_start) : ''; ?><?php echo (!empty($judging_start) && !empty($judging_end)) ? ' - ' : ''; ?><?php echo !empty($judging_end) ? verify_challenge_datetime_view($judging_end) : ''; ?></strong></span>
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

                        <div class="challenge-description-item"><?php echo get_field('description'); ?></div>
                    </div>

                    
                </div>
                <div class="challenge-inner">
                    
                    
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
                </div>
                        </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
			<div style="padding-bottom: 15px;">
                         <?php if (is_user_logged_in())
                        {
                           $arr_param=array('follow-challenge'=>true,'challenge_id'=>get_the_ID());
                           $redirect_link=add_query_arg($arr_param,get_permalink());
                           
                        }
                        else{
                           $redirect_link = site_url('login');
                        }
			$user_ID = get_current_user_id();
			
			    $followed_challenges=get_post_meta(get_the_ID(),'followed_challenges','challenge');
			
			    if(!empty($followed_challenges)) 
			    {
				if($user_ID!=0 && in_array($user_ID,$followed_challenges))
				{
				    
					echo "<div class='thank_you_follower' name='follow_challenge'>Thank you for following us!</div>";
				   
				}
				else{
				?>
				    <input type='button' title = "By clicking this link you indicate that you are interested in recieving updates about this Challenge." class='acf-button' name='follow_challenge' value='Follow this challenge' onclick='document.location.href="<?php echo $redirect_link;?>"'>
				<?php
				}
				
			    }
			    else{
				?>
				<input type='button' title = "By clicking this link you indicate that you are interested in recieving updates about this Challenge." class='acf-button' name='follow_challenge' value='Follow this challenge' onclick='document.location.href="<?php echo $redirect_link;?>"'>
			    <?php
			    }
			
			
			
                   ?>
		   </div>
                    
                        
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
                                                    <strong>Won by: <?php echo $this_prize['the_winner_name']; ?></strong><br/>
                                                    Solution: <?php echo $this_prize['winning_solution_title']; ?><br/>
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
                    }//end prizes
                    ?>
                         <div class="social-share">
                            <i class="fa fa-rss"></i> <a href="<?php echo site_url(); ?>/feed/?post_type=challenge">Subscribe to alerts / new challenge posts via RSS</a>
                        </div>
                        <div class="social-share">
                            <h4>Share and Subscribe</h4>
                            <?php
                            $customAddThis = array('size' => '16');
                            //$addthis_new_styles = array('small_toolbox' => array( 'src' =>  '<div class="addthis_toolbox addthis_default_style addthis_" %s ><a class="addthis_button_preferred_1"></a><a class="addthis_button_preferred_2"></a><a class="addthis_button_preferred_3"></a><a class="addthis_button_preferred_4"></a><a class="addthis_button_compact"></a></div>', 'img' => 'toolbox-small.png', 'name' => 'Small Toolbox', 'above' => 'hidden ', 'below' => ''));                        
                        do_action('addthis_widget'); ?>
                        </div>
                    <div class="social-share">
                            <h4>Latest Discussion</h4>
                            <div class="comments"><?php echo do_shortcode('[display-this-object-comments]'); ?></div>
                        </div>
                    </div>
                
                </div>
                <div class="tab-pane text-style" id="tab2">
                    <?php comments_template(); ?>
                </div>
                <div class="tab-pane text-style" id="tab3">
                    <div class="challenge-solutions">
                        <span class="challenges-header-right">Solutions</span>
                        <?php
                        if ($solution_count > 0)
                        {
                            ?>
                         	<a href="#" class="solutions-view-select" class="solutions-view-list">View as List</a>
					  		<?php
                            if(current_user_can('create_users') || current_user_can('all_access_agency')){
                                ?>
                                <a href="<?php echo add_query_arg('chal',get_the_ID(),get_template_directory_uri().'/download-solutions.php');?>" style="float:right;">Download Solutions</a>
                                <?php
                            }
                            ?>
                            <div class="solutions-display-grid-container">
                                <?php echo do_shortcode('[display-solution item_class="front-challenge-item" challenge_id="' . get_the_ID() . '"]'); ?>
                            </div>
                            <div class="solutions-display-list-container">
                                <br/><br/>
                                <?php echo do_shortcode('[display-solution item_class="front-challenge-item" challenge_id="' . get_the_ID() . '" view_as="list"]'); ?>
                            </div>
                            <?php
                        }
                        else
                            echo "<center><strong>No solutions have been posted for this challenge yet.</strong></center>";
                        ?>
                    </div>
                </div>
                <div class="tab-pane text-style" id="tab4">
                    <div class="challenge-rules">
                        <span class="challenges-header-right">Rules</span>
                        <?php echo get_field('rules'); ?>
                    </div>
                </div>
                <div class="tab-pane text-style" id="tab5">
				 <?php
			  /*
				  <script type="text/javascript">
                        jQuery(document).ready(function($){
                            $('#commentform input[type="submit"], form#create-solution input[type="submit"]').click(function(){
                                alert('Challenge.gov is undergoing scheduled maintenance. Between the hours of 8 p.m. EST and 10 p.m. EST tonight, the Challenge.gov database will be in read-only mode. It will be unable to save new registrations, profile updates, submissions or comments during this time. We apologize for this inconvenience, and encourage you to try back once the maintenance is completed.');
                                return false;
                            });
                        });
                    </script>
					*/
			  ?>
				  	<style type="text/css">
                        form#create-solution thead tr{display: none;}
                        form#create-solution #acf-image_logo .no-image p{font-weight: normal;}
                        form#create-solution #acf-solution_files .no-file a.button.add-file{margin-left:5px;padding:2px;}
                    </style>
                    <div class="challenge-container-inner">
                        <span class="challenges-header-right">Submit Solution</span>

                        <div class="inline-form">
                        <?php
                            if (is_user_logged_in()){
                                if (!empty($submission_end)) {
                                    $dt = DateTime::createFromFormat('U', time());
                                    $dt->setTimeZone(new DateTimeZone('America/New_York'));
                                    $adjusted_timestamp = $dt->format('U') + $dt->getOffset();

                                    if ($submission_end >= $adjusted_timestamp && (empty($submission_start) || $submission_start <= $adjusted_timestamp)) {
                                        //echo do_shortcode('[contact-form-7 id="'  . get_post_meta(get_the_ID(), 'challenge_wpcf7_id', true) . '" title="Submit Solution"]');
                                        $solution_args = array(
                                        //'field_groups' => array('description','tag-line'), // this will find the field groups for this post (post ID's of the acf post objects)
                                        'form' => true, // set this to false to prevent the <form> tag from being created
                                        'form_attributes' => array( // attributes will be added to the form element
                                            'id' => 'create-solution',
                                            'class' => 'page-content inline-form ',
                                            'action' => PARENT_URL .'/challenge-post-process.php',
                                            'method' => 'post',
                                        ),
                                        'post_id' => 'new-solution',
                                        'post_type' => 'solution',
                                        'field_groups' => array(395),
                                        'return' => add_query_arg( 'solution-created', 'true', get_permalink() ), // return url
                                        'html_before_fields' => '', // html inside form before fields
                                        'html_after_fields' => '<input type="hidden" value="'.get_the_ID().'" name="challenge-post-id">', // html inside form after fields
                                        'submit_value' => 'Submit Solution', // value for submit field
                                        'updated_message' => '', // default updated message. Can be false t
                                        );

                                        $return_form .= acf_form( $solution_args );

                                        ?>
                                        <script type="text/javascript">
                                            jQuery(document).ready(function($){
                                                $('.button.insert-media.add_media').attr('title', 'Upload file(s)');
                                                var el = $(".button.insert-media.add_media");  
                                                //replace(/word to remove/ig, "");  
                                                el.html(el.html().replace(/Add Media/ig, "Upload file(s)"));
											  	$('#acf-solution_files .no-file a.button.add-file').html('Upload File');
                                            });
                                        </script>
                                        <?php
                                        
                                        $terms_conditions = get_field('terms_conditions');
                                        echo '<span id="solution-terms-conditions" class="agency-challenges-header">Terms and Conditions</span><br/>';
                                        if (!empty($terms_conditions)) {
                                            ?>
                                            <div id="submit-terms-conditions" class="solution-submit-terms">
                                                <?php echo $terms_conditions; ?>
                                            </div>
                                        <?php
                                        }
                                    }elseif (!empty($submission_start) && $submission_start >= $adjusted_timestamp){
                                        echo "<center><strong>The submission period for this Challenge has not begun yet.<br/><br/> Please check back on ".date("l, F d, Y", $submission_start).".</strong></center>";   
                                    }else{
                                        echo "<center><strong>The submission period for this Challenge has ended.</strong></center>";
                                    }
                                }else{
                                    echo "<center><strong>Submissions for this Challenge are closed.</strong></center>";
                                }
                            }
                            else{
                                echo do_shortcode('[wp-login-method page="challenge"]');
                            }
                        ?>
                    </div>

                    </div>
                </div>
                <style type="text/css">
                    .solutions-display-list-container{display:none;}
                </style>
                <script type="text/javascript">
                    jQuery(document).ready(function($){
                        $('.solutions-view-select').on('click', function(){
                            if($(this).html() == 'View as List'){
                                $(this).html('View as Grid');
                                $(this).siblings('.solutions-display-grid-container').hide();
                                $(this).siblings('.solutions-display-list-container').show();
                                
                            }else{
                                $(this).html('View as List');
                                $(this).siblings('.solutions-display-list-container').hide();
                                $(this).siblings('.solutions-display-grid-container').show();
                            }
                            return false;
                        });
                    });
                </script>
                <?php
                if(current_user_can('all_access_agency') || current_user_can('create_users')){
                    ?>
                <div class="tab-pane text-style" id="tab6">
                        <span class="challenges-header-right">Manage Solutions</span>
                        <center><strong><a href="<?php echo add_query_arg('new-solution', 'true', get_permalink()); ?>">Click here to add a new solution for this Challenge.</a></strong></center>
                            <!-- <br/><br/> -->
                            <a href="#" class="solutions-view-select" class="solutions-view-list">View as List</a>
				  			<?php
                            if(current_user_can('create_users') || current_user_can('all_access_agency'))
                            {
                                ?>
                                <a href="<?php echo add_query_arg('all','1',add_query_arg('chal',get_the_ID(),get_template_directory_uri().'/download-solutions.php'));?>" style="float:right;">Download Solutions</a>
                                <?php
                            }
                            ?>
                            <div class="solutions-display-grid-container">
                                <?php echo do_shortcode('[display-solution item_class="front-challenge-item" post_status="publish, pending, draft" challenge_id="' . get_the_ID() . '"]'); ?>
                            </div>
                            <div class="solutions-display-list-container">
                                <br/><br/>
                                <?php echo do_shortcode('[display-solution post_status="publish, pending, draft" challenge_id="' . get_the_ID() . '" view_as="list"]'); ?>
                            </div>
                    </div>
                    <?php
                }
                    ?>
                <div class="tab-pane text-style" id="tab7">
                    <span class="challenges-header-right">Challenge Followers</span>
                    <?php echo do_shortcode('[display-followers challenge_id="' . get_the_ID() .'"]'); ?>
                </div>
                <?php
                if(current_user_can('create_users')){
                ?>
                <div class="tab-pane text-style" id="tab8">
                    <span class="challenges-header-right" style="margin-top:15px;">Send <?php the_title(); ?> Newsletter</span>
                    <?php
				  //error_log(print_r($_POST,1));
                    if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (get_current_user_id() == $post->post_author) ) ){
                        echo do_shortcode('[challenge-newsletter type="challenge" id="' . get_the_ID() .'"]');
                    }?>
                </div>
                <?php
                }
                ?>
            </div>
            <?php
            }
            ?>
            </div>
    </div></div>
    <!--Challenges Ends Here -->
    <?php endwhile; ?>
    <?php
    }
    elseif (!empty($edit_var2) && $edit_var2 == 'true') {
        //if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$post->ID,'category-id') || (get_current_user_id() == $post->post_author) ) ) )
        if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (get_current_user_id() == $post->post_author) ) )
        {
            $formattedpageurl = site_url('','http').challenge_permalink($post->ID);
            //$page_url =
            //$formattedpageurl .= $page_url;
            echo '<h1 class="page-title">New Solution for Challenge: <small><a href="'.$formattedpageurl.'" style="text-decoration:none;">'.$post->post_title.'</a></small></h1>';
            $user = get_user_by( 'id', $post->post_author );
            echo "<br/><span style=\"font-size:14px;text-transform:none;font-weight:normal;\"> Challenge Created on ".get_the_date()." by: <strong>".$user->user_login."</strong></span></span>";

            $solution_args = array(
                //'field_groups' => array('description','tag-line'), // this will find the field groups for this post (post ID's of the acf post objects)
                'form' => true, // set this to false to prevent the <form> tag from being created
                'form_attributes' => array( // attributes will be added to the form element
                    'id' => 'create-solution',
                    'class' => 'page-content inline-form ',
                    'action' => PARENT_URL .'/challenge-post-process.php',
                    'method' => 'post',
                ),
                'post_id' => 'new-solution',
                'post_type' => 'solution',
                'field_groups' => array(395),
                'return' => add_query_arg( 'solution-created', 'true', get_permalink() ), // return url
                'html_before_fields' => '', // html inside form before fields
                'html_after_fields' => '<input type="hidden" value="'.get_the_ID().'" name="challenge-post-id">', // html inside form after fields
                'submit_value' => 'Submit Solution', // value for submit field
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
        //if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$post->ID,'category-id') || (get_current_user_id() == $post->post_author) ) ) )
        if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (get_current_user_id() == $post->post_author) ) )
        {
		  /*
		  ?>
                <script type="text/javascript">
                    jQuery(document).ready(function($){
                        $('form#update-challenge input[type="submit"]').click(function(){
                            alert('Challenge.gov is undergoing scheduled maintenance. Between the hours of 8 p.m. EST tonight and midnight, Jan. 13, the Challenge.gov database will be in read-only mode. It will be unable to save new registrations, profile updates, submissions or comments during this time. We apologize for this inconvenience, and encourage you to try back once the maintenance is completed.');
                            return false;
                        });
                    });
                </script>
            <?php
			*/
            $formattedpageurl = site_url('','http').challenge_permalink($post->ID);
            //$page_url =
            //$formattedpageurl .= $page_url;
            echo '<h2 class="page-title" style="margin-top:10px;">Editing Challenge:&nbsp;<small><a href="'.$formattedpageurl.'" style="text-decoration:none;">'.$post->post_title.'</a></small></h2>';
            if($post->post_status == 'draft' || $post->post_status == 'pending')
            {
                ?>
                -&nbsp;<span style="color:red;">Draft</span>
            <?php
            }
            $user = get_user_by( 'id', $post->post_author );
            echo "<div> Challenge Created on ".get_the_date()." by: <strong>".$user->user_login."</strong></div>";
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
                    'class' => 'page-content inline-form ',
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
            //acf_form_head();
            if(current_user_can('publish_posts'))
                echo acf_form( $args );
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
