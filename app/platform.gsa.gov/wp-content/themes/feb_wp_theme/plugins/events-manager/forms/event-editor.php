<?php
/* WARNING! This file may change in the near future as we intend to add features to the event editor. If at all possible, try making customizations using CSS, jQuery, or using our hooks and filters. - 2012-02-14 */
/* 
 * To ensure compatability, it is recommended you maintain class, id and form name attributes, unless you now what you're doing. 
 * You also must keep the _wpnonce hidden field in this form too.
 */
global $EM_Event, $EM_Notices, $bp;

//check that user can access this page
if( is_object($EM_Event) && !$EM_Event->can_manage('edit_events','edit_others_events') ){
	?>
	<div class="wrap"><h2><?php esc_html_e('Unauthorized Access','dbem'); ?></h2><p><?php echo sprintf(__('You do not have the rights to manage this %s.','dbem'),__('Event','dbem')); ?></p></div>
	<?php
	return false;
}elseif( !is_object($EM_Event) ){
	$EM_Event = new EM_Event();
}
$required = apply_filters('em_required_html','<i>*</i>');

echo $EM_Notices;
//Success notice
if( !empty($_REQUEST['success']) ){
	if(!get_option('dbem_events_form_reshow')) return false;
}
?>	
<form enctype='multipart/form-data' id="event-form" method="post" action="<?php echo esc_url(add_query_arg(array('success'=>null))); ?>">
	<div class="wrap">
		<?php do_action('em_front_event_form_header'); ?>
		<?php if(get_option('dbem_events_anonymous_submissions') && !is_user_logged_in()): ?>
			<h3 class="event-form-submitter"><?php esc_html_e( 'Your Details', 'dbem' ); ?></h3>
			<div class="inside event-form-submitter">
				<p>
					<label><?php esc_html_e('Name', 'dbem'); ?></label>
					<input type="text" name="event_owner_name" id="event-owner-name" value="<?php echo esc_attr($EM_Event->event_owner_name); ?>" />
				</p>
				<p>
					<label><?php esc_html_e('Email', 'dbem'); ?></label>
					<input type="text" name="event_owner_email" id="event-owner-email" value="<?php echo esc_attr($EM_Event->event_owner_email); ?>" />
				</p>
				<?php do_action('em_font_event_form_guest'); ?>
			</div>
		<?php endif; ?>
        <div class="page-header">
            <h1>Add New Event</h1>
        </div>
        <div class="inlineForm ">
            <div class="formWrap">
        <div class="form-group">
		<label class="event-form-name"><?php esc_html_e( 'Event Name', 'dbem' ); ?><span class="required"><?php echo $required; ?></span></label>
		
			<input type="text" class="form-control" name="event_name" id="event-name" value=" <?php echo esc_attr($EM_Event->event_name,ENT_QUOTES); ?>" />
			<div clas=""><?php esc_html_e('(Example:Training Event)', 'dbem'); ?></div><?php em_locate_template('forms/event/group.php',true); ?>
	</div>
		 <div class="form-group">			
		<label class="event-form-when"><?php esc_html_e( 'When', 'dbem' ); ?><span class="required"><?php echo $required; ?></span></label><?php 
			if( empty($EM_Event->event_id) && $EM_Event->can_manage('edit_recurring_events','edit_others_recurring_events') && get_option('dbem_recurrence_enabled') ){
				em_locate_template('forms/event/when-with-recurring.php',true);
			}elseif( $EM_Event->is_recurring()  ){
				em_locate_template('forms/event/recurring-when.php',true);
			}else{
				em_locate_template('forms/event/when.php',true);
			}
		?>
            </div>
<div class="form-group">	
		<?php if( get_option('dbem_locations_enabled') ): ?>
		<label class="event-form-where"><?php esc_html_e( 'Where', 'dbem' ); ?></label>
		<div class="inside event-form-where subform-group"><?php em_locate_template('forms/event/location.php',true); ?></div>
    <?php endif; ?>
</div>
                <label class="event-form-details"><?php esc_html_e( 'Details', 'dbem' ); ?></label>
		<div class="inside event-form-details">
			<div class="event-editor">
				<?php if( get_option('dbem_events_form_editor') && function_exists('wp_editor') ): ?>
					<?php wp_editor($EM_Event->post_content, 'em-editor-content', array('textarea_name'=>'content') ); ?> 
				<?php else: ?>
					<textarea name="content" class="textarea"><?php echo $EM_Event->post_content ?></textarea>
					<br />
					<?php esc_html_e( 'Details about the event.', 'dbem' )?> <?php esc_html_e( 'HTML allowed.', 'dbem' )?>
				<?php endif; ?>
			</div>
			<div class="event-extra-details">
				<?php if(get_option('dbem_attributes_enabled')) { em_locate_template('forms/event/attributes-public.php',true); }  ?>
				<?php if(get_option('dbem_categories_enabled')) { em_locate_template('forms/event/categories-public.php',true); }  ?>
			</div>
		</div>
		<div class="form-group subform-group">
		<?php if( $EM_Event->can_manage('upload_event_images','upload_event_images') ): ?>
		<label><?php esc_html_e( 'Event Image', 'dbem' ); ?></label>
		<div class="inside event-form-image">
			<?php em_locate_template('forms/event/featured-image-public.php',true); ?>
		</div>
                </div>
		<?php endif; ?>
		<?php if( get_option('dbem_rsvp_enabled') && $EM_Event->can_manage('manage_bookings','manage_others_bookings') ) : ?>
		<!-- START Bookings -->
                <div class="form-group subform-group">
		<label><?php esc_html_e('Bookings/Registration','dbem'); ?></label>
		<div class="inside event-form-bookings">				
            <?php em_locate_template('forms/event/bookings.php',true); ?></div></div>
		<!-- END Bookings -->
		<?php endif; ?>
		<?php do_action('em_front_event_form_footer'); ?>
            </div>
	</div>
    </div>
	<div class="submit">
	    <?php if( empty($EM_Event->event_id) ): ?>
	    <input type='submit' class='btn btn-primary' name='submit' value='<?php echo esc_attr(sprintf( __('Submit %s','dbem'), __('Event','dbem') )); ?>' />
	    <?php else: ?>
	    <input type='submit' class='btn btn-primary' name='submit' value='<?php echo esc_attr(sprintf( __('Update %s','dbem'), __('Event','dbem') )); ?>' />
	    <?php endif; ?>
	</div>
	<input type="hidden" name="event_id" value="<?php echo $EM_Event->event_id; ?>" />
	<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('wpnonce_event_save'); ?>" />
	<input type="hidden" name="action" value="event_save" />
	<?php if( !empty($_REQUEST['redirect_to']) ): ?>
	<input type="hidden" name="redirect_to" value="<?php echo esc_attr($_REQUEST['redirect_to']); ?>" />
	<?php endif; ?>
</form>