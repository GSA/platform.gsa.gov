<div class="meta<?php if ( is_single() ) { ?> single<?php } ?>">

	<span class="meta-date">
		<?php the_time( get_option( 'date_format' ) ); ?> | 
	</span> 

	<span class="meta-author">
		By <?php (function_exists('coauthors_posts_links')) ? coauthors_posts_links() : the_author_posts_link(); ?>
	</span>

	<?php if ('open' == $post->comment_status) { ?>
	<span class="meta-comments">
		 | <a href="<?php comments_link(); ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Comments for", "solostream"); ?> <?php the_title(); ?>"><?php comments_number(__("Reply", "solostream"), __("1 Reply", "solostream"), __("% Replies", "solostream")); ?></a>
	</span>
	<?php } ?>

	<span class="readmore">
		<a href="<?php the_permalink() ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php _e("More", "solostream"); ?></a>
	</span>

</div>