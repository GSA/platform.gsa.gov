<?php


get_header();
st_before_content($columns='');
while ( have_posts() ) : the_post();
//get template ID,
//call page source
	echo '<h1>'.get_the_title().' Newsletter</h1>';
	$get_apikey = get_option('ChallChimp_api','');

    $template_id = intval('0'.get_field('template_id'));

    if (!class_exists('Challenge_Mailchimp_V2')) {
        require_once(ABSPATH.'wp-content/plugins/challenge-mailchimp/challenge-mailchimp-api2.0.class.php');
    }
    if(class_exists('Challenge_Mailchimp_V2')){
        $mailchimp2 = new Challenge_Mailchimp_V2($get_apikey);
        $template = $mailchimp2->call('templates/info',array('template_id'=>$template_id,'user'));
        $challenges = '';
        //error_log(print_r($template,1));
        echo '<div id="single-newsletter-container" style="background:#fff;border:1px solid #eee;">';
        echo $template['source'];
        echo '</div>';

        $num = get_field('number_of_challenges');
        $for_id = get_field('newsletter_for_id');
        $content = get_field('content');
        $content = str_replace("\n","",$content);
        $content = str_replace("\r","",$content);
        $recent = get_field('include_recent_challenges');
        $this_pt = get_post_type($for_id);
        if($this_pt == 'agency' && $recent == '1' && $num > 0){
            $challenges = do_shortcode('[newsletter_challenge_items agency="'.$title.'" num="'.$num.'"]');
            //$challenges = preg_replace('/[ \t]+/', ' ', preg_replace('/[\r\n]+/', "\n", $challenges));
            $challenges = str_replace("\n","",$challenges);
            $challenges = str_replace("\r","",$challenges);
        }
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('#newsletter-content').html('<?php echo trim($content); ?>');
                $('table#newsletter-content p').css({'padding':'0 10px'});
                <?php
                if($this_pt == 'agency'){
                    ?>
                $('#challenges-container').empty();
                $('#challenges-container').html($.trim('<?php echo trim(html_entity_decode($challenges)); ?>'));
                <?php
                }
                if($this_pt == 'challenge' || empty($challenges)){
                    ?>
                $('#challenges-container').empty();
                <?php
                }
                ?>
            });
        </script>
        <?php
    }
//substitute
endwhile;

st_after_content();
get_footer();