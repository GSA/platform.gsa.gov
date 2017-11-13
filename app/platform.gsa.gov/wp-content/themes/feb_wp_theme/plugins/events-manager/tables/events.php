<?php
	//TODO Simplify panel for events, use form flags to detect certain actions (e.g. submitted, etc)
	global $wpdb, $bp, $EM_Notices;
	/* @var $args array */
	/* @var $EM_Events array */
	/* @var events_count int */
	/* @var future_count int */
	/* @var pending_count int */
	/* @var url string */
	/* @var show_add_new bool */
	//add new button will only appear if called from em_event_admin template tag, or if the $show_add_new var is set

	?>


	
        <div class="col-md-12 column">
            <div class="page-header eventsBg">
                <h1>My Events</h1>
            </div>
		<?php echo $EM_Notices; ?>
		<form id="posts-filter" action="" method="get">
			<ul class="nav nav-pills nav-justified subNav">
				<?php $default_params = array('scope'=>null,'status'=>null,'em_search'=>null,'pno'=>null); //template for cleaning the link for each view below ?>
				<li <?php echo ( !isset($_REQUEST['view']) || (isset($_REQUEST['view']) && $_REQUEST['view'] == 'future')) ? 'class="active"':''; ?>><a href='<?php echo em_add_get_params($_SERVER['REQUEST_URI'], $default_params + array('view'=>'future')); ?>'><?php _e ( 'Upcoming', 'dbem' ); ?> <span class="badge"><?php echo $future_count; ?></span></a></li>
				<?php if( $pending_count > 0 ): ?>
				<li <?php echo ( isset($_REQUEST['view']) && $_REQUEST['view'] == 'pending') ? 'class="active"':''; ?>><a href='<?php echo em_add_get_params($_SERVER['REQUEST_URI'], $default_params + array('view'=>'pending')); ?>'><?php _e ( 'Pending', 'dbem' ); ?> <span class="badge"><?php echo $pending_count; ?></span></a></li>
				<?php endif; ?>
				<?php if( $draft_count > 0 ): ?>
                <li <?php echo ( isset($_REQUEST['view']) && $_REQUEST['view'] == 'draft') ? 'class="active"':''; ?>><a href='<?php echo em_add_get_params($_SERVER['REQUEST_URI'], $default_params + array('view'=>'draft')); ?>'><?php _e ( 'Draft', 'dbem' ); ?> <span class="badge"><?php echo $draft_count; ?></span></a></li>
				<?php endif; ?>
				<li <?php echo ( isset($_REQUEST['view']) && $_REQUEST['view'] == 'past') ? 'class="active"':''; ?>><a href='<?php echo em_add_get_params($_SERVER['REQUEST_URI'], $default_params + array('view'=>'past')); ?>'><?php _e ( 'Past Events', 'dbem' ); ?> <span class="badge"><?php echo $past_count; ?></span></a></li>
			</ul>
			<p class="search-box">
				<label class="screen-reader-text hidden" for="post-search-input"><?php _e('Search Events','dbem'); ?>:</label><input type="text" id="post-search-input" name="em_search" placeholder="search events" value="<?php echo (!empty($_REQUEST['em_search'])) ? esc_attr($_REQUEST['em_search']):''; ?>" /><?php if( !empty($_REQUEST['view']) ): ?>
				<input type="hidden" name="view" value="<?php echo esc_attr($_REQUEST['view']); ?>" /><?php endif; ?>
				<input type="submit" value="<?php _e('Search Events','dbem'); ?>" class="btn btn-primary" />
			</p>
			<div class="tablenav">
				<?php
				if ( $events_count >= $limit ) {
					$events_nav = em_admin_paginate( $events_count, $limit, $page);
					echo $events_nav;
				}
				?>
<!--				<br class="clear" />-->
			</div>
			<?php
			if ( empty($EM_Events) ) {
				echo get_option ( 'dbem_no_events_message' );
			} else {
			?>
					
			<table class="widefat events-table">
				<thead>
					<tr>
						<?php /* 
						<th class='manage-column column-cb check-column' scope='col'>
							<input class='select-all' type="checkbox" value='1' />
						</th>
						*/ ?>
						<th><?php _e ( 'Name', 'dbem' ); ?></th>
						
						<th><?php _e ( 'Location', 'dbem' ); ?></th>
						<th colspan="2"><?php _e ( 'Date and time', 'dbem' ); ?></th>
                      
					</tr>
				</thead>
				<tbody>
					<?php
					$rowno = 0;
					foreach ( $EM_Events as $EM_Event ) {
						/* @var $EM_Event EM_Event */
						$rowno++;
						$class = ($rowno % 2) ? 'alternate' : '';
						// FIXME set to american						
						$localised_start_date = date_i18n(get_option('dbem_date_format'), $EM_Event->start);
						$localised_end_date = date_i18n(get_option('dbem_date_format'), $EM_Event->end);
						$style = "";
						$today = current_time('timestamp');
						$location_summary = "<b>" . esc_html($EM_Event->get_location()->location_name) . "</b><br/>" . esc_html($EM_Event->get_location()->location_address) . " - " . esc_html($EM_Event->get_location()->location_town);
						
						if ($EM_Event->start < $today && $EM_Event->end < $today){						
							$class .= " past";
						}
						//Check pending approval events
						if ( !$EM_Event->get_status() ){
							$class .= " pending";
						}					
						?>
						<tr class="event <?php echo trim($class); ?>" <?php echo $style; ?> id="event_<?php echo $EM_Event->event_id ?>">
							<?php /*
							<td>
								<input type='checkbox' class='row-selector' value='<?php echo $EM_Event->event_id; ?>' name='events[]' />
							</td>
							*/ ?>
							<td>
								<strong><a class="row-title" href="<?php echo esc_url($EM_Event->get_edit_url()); ?>"><?php echo esc_html($EM_Event->event_name); ?></a></strong><?php 
								if( get_option('dbem_rsvp_enabled') == 1 && $EM_Event->event_rsvp == 1 ){
									?>
                                <br /><a href="<?php echo $EM_Event->get_bookings_url(); ?>"><?php esc_html_e("Bookings",'dbem'); ?></a> &ndash;
									<?php esc_html_e("Booked",'dbem'); ?>: <?php echo $EM_Event->get_bookings()->get_booked_spaces()."/".$EM_Event->get_spaces(); ?>
									<?php if( get_option('dbem_bookings_approval') == 1 ): ?>
										| <?php _e("Pending",'dbem') ?>: <?php echo $EM_Event->get_bookings()->get_pending_spaces(); ?>
									<?php endif;
								}
								?>
								<div class="row-actions">
									<?php if( current_user_can('delete_events')) : ?>
									<span class="trash"><a href="<?php echo esc_url(add_query_arg(array('action'=>'event_delete', 'event_id'=>$EM_Event->event_id, '_wpnonce'=> wp_create_nonce('event_delete_'.$EM_Event->event_id)))); ?>" class="em-event-delete"><?php _e('Delete','dbem'); ?></a></span>
									<?php endif; ?>
								</div>
							</td>
							<?php /*<td>
								<a href="<?php echo esc_url(add_query_arg(array('action'=>'event_duplicate', 'event_id'=>$EM_Event->event_id, '_wpnonce'=> wp_create_nonce('event_duplicate_'.$EM_Event->event_id)))); ?>" title="<?php _e ( 'Duplicate this event', 'dbem' ); ?>">
									<strong>+</strong>
								</a>
							</td> */ ?>
							<td>
								<?php echo $location_summary; ?>
							</td>
					
							<td>
								<?php echo $localised_start_date; ?>
								<?php echo ($localised_end_date != $localised_start_date) ? " - $localised_end_date":'' ?>
								<br />
								<?php
									if(!$EM_Event->event_all_day){
										echo date_i18n(get_option('time_format'), $EM_Event->start) . " - " . date_i18n(get_option('time_format'), $EM_Event->end);
									}else{
										echo get_option('dbem_event_all_day_message');
									}
								?>
							</td>
							<td>
								<?php 
								if ( $EM_Event->is_recurrence() ) {
									$recurrence_delete_confirm = __('WARNING! You will delete ALL recurrences of this event, including booking history associated with any event in this recurrence. To keep booking information, go to the relevant single event and save it to detach it from this recurrence series.','dbem');
									?>
									<strong>
									<?php echo $EM_Event->get_recurrence_description(); ?> <br />
									<a href="<?php echo esc_url($EM_Event->get_edit_reschedule_url()); ?>"><?php _e ( 'Edit Recurring Events', 'dbem' ); ?></a>
									<?php if( current_user_can('delete_events')) : ?>
									<span class="trash"><a href="<?php echo esc_url(add_query_arg(array('action'=>'event_delete', 'event_id'=>$EM_Event->recurrence_id, '_wpnonce'=> wp_create_nonce('event_delete_'.$EM_Event->recurrence_id)))); ?>" class="em-event-rec-delete" onclick ="if( !confirm('<?php echo $recurrence_delete_confirm; ?>') ){ return false; }"><?php _e('Delete','dbem'); ?></a></span>
									<?php endif; ?>										
									</strong>
									<?php
								}
								?>
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
			<?php } ?>
			<div class='tablenav'>
				<div class="alignleft actions">
				<br class='clear' />
				</div>
				<?php if ( $events_count >= $limit ) : ?>
				<div class="tablenav-pages">
					<?php
					echo $events_nav;
					?>
				</div>
				<?php endif; ?>
				<br class='clear' />
			</div>
		</form>
		<?php
                	if(!empty($show_add_new) && current_user_can('edit_events')) echo '<a class="pull-right btn btn-primary" href="'.em_add_get_params($_SERVER['REQUEST_URI'],array('action'=>'edit','scope'=>null,'status'=>null,'event_id'=>null, 'success'=>null)).'">'.__('Add New Event','dbem').'</a>';
			?>
            </div>
