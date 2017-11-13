<?php
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
		$secure_connection = 's';
	}
	else
		$secure_connection = '';
	//$default_img_url = "//platform.gsa.gov/wp-content/uploads/sites/51/2013/12/default-image.gif";
	//if(strpos(get_site_url('http'), "http://localhost/") !== false || strpos(get_site_url('http'), "http://sites.usa.local") !== false) //override if local dev
    	$default_img_url = get_template_directory_uri().'/images/default-image.gif';
	get_header();
	acf_form_head();
	?>
<style type="text/css">
	#acf-accept_terms{display:none;}
</style>
		<?php
		$edit_var = $_GET['edit-solution'];
		$challenge_id = get_field('challenge_id');
		$categories = wp_get_post_terms($challenge_id, 'agency', array("fields" => "all"));

		if(!empty($edit_var) && $edit_var != '0')
		{
			//if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$categories[0]->term_id,'category-id') || get_current_user_id() == $post->post_author))) //user is agency admin
			if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || get_current_user_id() == $post->post_author))
			{
				echo '<div class="container">';
				//var_dump($categories);
				$formattedpageurl = site_url('','http').challenge_permalink($post->ID);
				$formattedchallengeurl = site_url('','http').challenge_permalink($challenge_id);
				//$page_url = 
				//$formattedpageurl .= $page_url;
				echo '<span class="challenge-instruct-header" style="margin-top:10px;">Editing Solution: <strong><a href="'.$formattedpageurl.'" style="text-decoration:none;">'.$post->post_title.'</a></strong>';
				if($post->post_status == 'draft' || $post->post_status == 'pending')
				{
				?>
					-&nbsp;<span style="color:red;">Hidden</span>
				<?php
				}
				echo '<br/>For Challenge: <a href="'.$formattedchallengeurl.'">'.get_the_title($challenge_id).'</a>';
				$user = get_user_by( 'id', $post->post_author ); 
				echo "<br/><span style=\"font-size:14px;text-transform:none;font-weight:normal;\"> Solution Created on ".get_the_date()." by: <strong><a href=\"".site_url()."/profile/".$user->user_login."\">".$user->user_login."</a></strong></span></span>";
			  /*
				?>
				<script type="text/javascript">
                  	jQuery(document).ready(function($){
                        $('form#solution-update input[type="submit"]').click(function(){
                            alert('Challenge.gov is undergoing scheduled maintenance. Between the hours of 8 p.m. EST and 10 p.m. EST tonight, the Challenge.gov database will be in read-only mode. It will be unable to save new registrations, profile updates, submissions or comments during this time. We apologize for this inconvenience, and encourage you to try back once the maintenance is completed.');
                            return false;
                        });
                    });
                </script>
				<?php
				*/
			  ?>
				<li id="tlastTab">
					<?php
						$challenge_args = array(
						    'post_id' => $edit_var3, // post id to get field groups from and save data to
						    'field_groups' => array(), // this will find the field groups for this post (post ID's of the acf post objects)
						    'form' => true, // set this to false to prevent the <form> tag from being created
						    'form_attributes' => array( // attributes will be added to the form element
						        'id' => 'solution-update',
						        'class' => '',
						        'action' => '',
						        //'action' => PARENT_URL .'/challenge-post-process.php',
						        'method' => 'post',
						    ),
						    'return' => add_query_arg( 'edit-solution', 'true', get_permalink() ), // return url
						    'html_before_fields' => '', // html inside form before fields
						    'html_after_fields' => '<input type="hidden" value="solution-update" name="solution-post-type"><input type="hidden" value="'.$challenge_id.'" name="challenge-post-id">', // html inside form after fields
						    'submit_value' => 'Update', // value for submit field
						    'updated_message' => 'Solution updated.', // default updated message. Can be false to show no message
						);
						acf_form( $challenge_args );
					?>
				</li>
				<?php
				echo '</div>';
			}
			else
				echo '<div style="min-height:350px;">You do not have access to edit this Solution.<br/><a href='.site_url().'>Click here to return home</a></div>';
		}
		else
		{
			echo '<div class="container">';
			while ( have_posts() ) : the_post(); ?>
			<?php
				$custom_fields = get_post_custom(get_the_ID());
				$challenge_id = get_field('challenge_id');
				
				$logo_new = get_field('logo');
				$tag_line = get_field('tag-line');
				$logo_in = !empty($logo_new) ? $logo_new['url'] : $default_img_url;
				
				global $post;
				$categories = wp_get_post_terms($challenge_id, 'agency', array("fields" => "all"));
				$separator = ', ';
				$agencies = '';
				
				if($categories){
					$counter = 0;
					foreach($categories as $category) {
						$counter++;
						$agencies .= '<a href="'.get_term_link( $category->name, 'agency' ).'" title="' . esc_attr( sprintf( __( "View all challenges in %s" ), $category->name ) ) . '">'.$category->name.'</a>'.($counter < count($categories) ? $separator : '');
					}
				}
				$comment_count = (array)wp_count_comments( get_the_ID() );
			?>
			<!--Solution Starts here -->
			
			<h2 class="page-title"><?php the_title();
					if($post->post_status == 'draft' || $post->post_status == 'pending')
					{
					?>
						-&nbsp;<span style="color:red;">Hidden</span>
					<?php
					}
					?>
					</h2>
          <div class="container page-content">
              <div class="row">
              <div class="column col-md-12">
                  
              </div>
          	</div>
			<div class="container row">
	           <div class="col-md-3 col-sm-12 col-xs-12">
				    <nav class="nav-sidebar">
				    	<div class="thumbnail" ><img src="<?php echo $logo_in; ?>"  alt="<?php the_title();?> image" /></div>
						<ul class="nav tabs single-challenge-tabs">
				          <li class="active"><a href="#tab1" data-toggle="tab">Solution Details</a></li>
				          <li class=""><a href="#tab2" data-toggle="tab">Discussions<span class="badge pull-right"><?php echo $comment_count["approved"]; ?></span></a></li>
				          <?php
				          //if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$categories[0]->term_id,'category-id') || get_current_user_id() == $post->post_author))) //user is agency admin
				            if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || get_current_user_id() == $post->post_author))
							{?>
				          <li class=""><a href="<?php echo add_query_arg( 'edit-solution', 'true' , get_permalink() ); ?>">Edit this Solution</a></li>
				          <?php } ?>
						</ul>
					</nav>
					<?php get_sidebar('challenge'); ?>
		        </div>
		        <div class="col-md-9 col-sm-12 col-xs-12">
		                <div class="tab-content single-challenge-tab-content">
		                    <div class="tab-pane active text-style" id="tab1">
						<div class="challenge-tab">
							<div class="challenge-top">
								<div class="challenge-top-text">
									<span class="challenge-posted-by">Solution for: <a href="<?php echo get_permalink($challenge_id); ?>"><?php echo get_the_title($challenge_id); ?></a>
									<?php if(current_user_can('create_users') || current_user_can('all_access_agency')){
											echo "<br/>Submitted By: ".get_the_author()." ".((get_the_author() != get_the_author_meta('user_login')) ? "(".get_the_author_meta('user_login').")" : '');
										}
										?>
								  	</span>
									<?php echo !empty($tag_line) ? '<span class="challenge-tag-line">'.$tag_line.'</span>' : ''; ?>
								</div>
							</div>
							<div class="challenge-inner">
								<div class="challenge-description">
									<span class="challenge-description-header">About the Solution</span>
									<?php

									$ext_url = get_field('external_url');
									if(!empty($ext_url)): ?>
										<div class="challenge-description-item">External URL: <a href="<?php echo $ext_url;?>"><?php echo $ext_url;?></a></div><br/>
									<?php endif; ?>
									<div class="challenge-description-item"><?php echo get_field('description'); ?></div>
								</div>
							</div>
							<div class="social-share">
                            <h3>Share and Subscribe</h3>
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
                	<div class="tab-pane text-style" id="tab2">
						<?php comments_template(); ?>
					</div>
				<?php /*
				Submission ends:&nbsp;<?php date("M d, Y",((int)get_field('submission_end'))); ?>
				*/
				?>
				</div>
			</div><!--//span8 !-->
		</div>
	</div><!--//container !-->
			<?php endwhile;
			echo '</div>';
		}
		?>
	<?php
	//get_sidebar('page');
	//st_after_content();
	get_footer();
?>
