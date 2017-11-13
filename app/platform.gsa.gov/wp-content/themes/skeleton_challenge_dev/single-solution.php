<?php
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
		$secure_connection = 's';
	}
	else
		$secure_connection = '';
	$default_img_url = "http".$secure_connection."://challenge.sites.usa.gov/files/2013/12/default-image.gif";
	get_header();
	acf_form_head();
	?>
	<div class="challenge-content">
		<?php
		$edit_var = $_GET['edit-solution'];
		$challenge_id = get_field('challenge_id');
		$categories = wp_get_post_terms($challenge_id, 'agency', array("fields" => "all"));

		if(!empty($edit_var) && $edit_var != '0')
		{
			if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$categories[0]->term_id,'category-id') || get_current_user_id() == $post->post_author))) //user is agency admin
			{
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
				echo "<br/><span style=\"font-size:14px;text-transform:none;font-weight:normal;\"> Solution Created on ".get_the_date()." by: <strong>".$user->user_login."</strong></span></span>";
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
						    'html_after_fields' => '<input type="hidden" value="solution-update" name="solution-post-type">', // html inside form after fields
						    'submit_value' => 'Update', // value for submit field
						    'updated_message' => 'Solution updated.', // default updated message. Can be false to show no message
						);
						acf_form( $challenge_args );
					?>
				</li>
				<?php
			}
			else
				echo '<div style="min-height:350px;">You do not have access to edit this Solution.<br/><a href='.site_url().'>Click here to return home</a></div>';
		}
		else
		{
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
				<h1 class="entry-title"><?php the_title();
					if($post->post_status == 'draft' || $post->post_status == 'pending')
					{
					?>
						-&nbsp;<span style="color:red;">Hidden</span>
					<?php
					}
					?>
					</h1>
				<ul class="tabs">
					<li class="active"><a href="#t1" class="active">Details</a></li>
					<li><a href="#t2">Discussions (<?php echo $comment_count["approved"]; ?>)</a></li>
					
					<?php
					if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$categories[0]->term_id,'category-id') || get_current_user_id() == $post->post_author)))
					{
						//<li class="right-tab"><?php echo add_query_arg( 'edit-solution', get_the_ID(), get_permalink($challenge_id) );
						?>
							<li class="right-tab"><a href="<?php echo add_query_arg( 'edit-solution', 'true' , get_permalink() ); ?>">Edit this Solution</a></li>
						<?php
					}
					?>
				</ul>
				<ul class="tabs-content">
					<li id="t1Tab" class="active">
						<div class="challenge-tab">
							<div class="challenge-top">
								<img class="challenge-image-top" src="<?php echo $logo_in; ?>">
								<div class="challenge-top-text">
									<span class="challenge-posted-by">Solution for: <a href="<?php echo get_permalink($challenge_id); ?>"><?php echo get_the_title($challenge_id); ?></a></span>
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
							<?php get_sidebar('challenge'); ?>
						</div>
					</li>
					<li id="t2Tab" style="text-align:center;"><span class="challenge-discussion-header">Discussions</span><br/><?php comments_template(); ?></li>
					<?php
					/*
					<li id="tlastTab">
						<div class="challenge-submission">
							Form Here (Or redirection)
						</div>
					</li>
					*/
					if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency') || (max_agency_match(get_max_agency_codes(),$categories[0]->term_id,'category-id') || get_current_user_id() == $post->post_author))) //user is agency admin
					{
						?>
						<li id="tlastTab">
							<?php
								$challenge_args = array(
								    'post_id' => $post->ID, // post id to get field groups from and save data to
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
								    'html_after_fields' => '', // html inside form after fields
								    'submit_value' => 'Update', // value for submit field
								    'updated_message' => 'Solution updated.', // default updated message. Can be false to show no message
								);
								acf_form( $challenge_args );
							?>
						</li>
						<?php
					}
					?>
				</ul>
				<?php /*
				Submission ends:&nbsp;<?php date("M d, Y",((int)get_field('submission_end'))); ?>
				*/
				?>
			<?php endwhile;
		}
		?>
	</div>
	<?php
	//get_sidebar('page');
	//st_after_content();
	get_footer();
?>