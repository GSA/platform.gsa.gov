<?php
/**
 * Template Name: Designer Page - No Sidebar or Page Title
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
*/
acf_form_head();
get_header();
?>
<div class="challenge-content">
<?php
st_before_content($columns='');
get_template_part( 'loop', 'page' );
/*$options = array(
    'post_id' => $post->ID, // post id to get field groups from and save data to
    'field_groups' => array(), // this will find the field groups for this post (post ID's of the acf post objects)
    'form' => true, // set this to false to prevent the <form> tag from being created
    'form_attributes' => array( // attributes will be added to the form element
        'id' => 'post',
        'class' => '',
        'action' => '',
        'method' => 'post',
    ),
    'return' => add_query_arg( 'updated', 'true', get_permalink() ), // return url
    'html_before_fields' => '', // html inside form before fields
    'html_after_fields' => '', // html inside form after fields
    'submit_value' => 'Update', // value for submit field
    'updated_message' => 'Post updated.', // default updated message. Can be false to show no message
);
acf_form( $options );*/

st_after_content();
?>
</div>
<?php
get_footer();
?>
