<?php
/*
Template Name: Organized by Tag
*/
?>

<?php get_header(); ?>
<div class="sixteen columns section sectionBlue">
	<h1>Public Comments</h1>
</div>
	<div class="main sixteen columns">
		<div class="content twelve columns news alpha">

<?php
//get all terms (e.g. categories or post tags), then display all posts in each term
$taxonomy = 'post_tag';//  e.g. post_tag, category
$param_type = 'tag__in'; //  e.g. tag__in, category__in
$term_args=array(
	'orderby' => 'name',
	'order' => 'ASC'
);
$terms = get_terms($taxonomy,$term_args);
if ($terms) {
  foreach( $terms as $term ) {
    $args=array(
      "$param_type" => array($term->term_id),
	  'tag__not_in' => array(31, 6),
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'caller_get_posts'=> 1
      );
    $my_query = null;
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
      echo '<h4>'.$term->name . '</h4><ul>';
      while ($my_query->have_posts()) : $my_query->the_post(); ?>
        <li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title();?></a> - <span><?php the_time('F j, Y');?></span></li>
       <?php
      endwhile;
	  echo '</ul>';
    }
  }
}
wp_reset_query();  // Restore global post data stomped by the_post().
?>

<?php if (  $wp_query->max_num_pages > 1 ) :  /* pagination */ ?>
			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'skeleton' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'skeleton' ) ); ?></div>
			</div><!-- #nav-below -->
		<?php endif; ?>
		</div>
		<div class="sidebar four columns omega blogRoll">
			<?php if(in_category('Public Comments')){ ?>
				<?php dynamic_sidebar( 'default-sidebar' ); ?>
			<?php } ?>
		</div>
	</div>

<?php get_footer(); ?>