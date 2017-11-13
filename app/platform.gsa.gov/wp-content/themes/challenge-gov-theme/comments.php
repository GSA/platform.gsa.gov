<?php
/**
* @package Skeleton WordPress Theme Framework
* @subpackage skeleton
* @author Simple Themes - www.simplethemes.com
*/

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.');?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<div id="comments">
<?php if ( have_comments() ) : ?>
	
	
	<h3 class="agency-challenges-header">	
	<?php printf( _n( 'One Discussion for %2$s', '%1$s Discussions for %2$s', get_comments_number(), 'smpl' ),
			number_format_i18n( get_comments_number() ), '<small class="normal">&quot;'.get_the_title().'&quot;</small>' );?>
	
	</h3>

	
	<ul class="commentlist">
	<?php // wp_list_comments("callback=st_comments"); ?>
	<?php wp_list_comments('type=comment&callback=mytheme_comment&reverse_top_level=true'); ?>
	</ul>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	
<?php endif; ?>

</div>
<?php if ( comments_open() ) : ?>

<div id="respond">

<h3 class="agency-challenges-header"><?php comment_form_title( _e('Add to the Discussion','smpl')); ?></h3>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('You must be logged in to post a comment.','smpl');?></a> </p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="form">

<?php if ( is_user_logged_in() ) : ?>

<p><?php _e('Logged in as: ','smpl').' '?><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out','smpl');?>"><?php _e('Log out','smpl');?></a></p>

<?php else : ?>

<div class="form-group">
<p>
<label for="author"><small><span style="color: red"><?php if ($req) _e('* ','smpl');?></span><?php _e('Name','smpl');?><?php if ($req) _e(' (required)','smpl');?> </small></label>
<input class="form-control" type="text" name="author" id="author" value="<?php /*echo esc_attr($comment_author); */ ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
</p>
</div>
<div class="form-group">
<p>
<label for="email"><small><span style="color: red"><?php if ($req) _e('* ','smpl');?></span><?php _e( 'Email','smpl'); _e(' (required, but will not be visible)','smpl');  ?></small></label>
<input class="form-control" type="text" name="email" id="email" value="<?php /*echo esc_attr($comment_author_email); */ ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
</p>
</div>
<div class="form-group">
<p>
<label for="url"><small><?php _e('Website','smpl');?></small></label>
<input class="form-control" type="text" name="url" id="url" value="<?php /*echo esc_attr($comment_author_url);*/ ?>" size="22" tabindex="3" />
</p>
</div>
<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<div class="form-group"><textarea name="comment" id="comment" rows="5" tabindex="4" class="form-control"></textarea></div>
<div class="form-group">
<p><input name="submit" class="btn btn-default pull-right" type="submit" id="submit" tabindex="5" value="<?php _e('Submit comment','smpl');?>" />
<?php comment_id_fields(); ?>
</p>
</div>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
