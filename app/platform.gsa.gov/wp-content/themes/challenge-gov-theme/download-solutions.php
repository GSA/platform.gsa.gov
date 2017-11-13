<?php
ob_start();

if(strpos($_SERVER['SERVER_NAME'],'www.challenge.gov.local') !== false)
    require_once('/Users/robmorris/Documents/sites-usa-gov/wp-load.php');
elseif(strpos($_SERVER['SERVER_NAME'],'localhost') !== false)
    require_once('/Library/WebServer/Documents/wordpress-challenge/wp-load.php');
else
    require_once('../../../wp-load.php');

if(current_user_can('create_users') || current_user_can('all_access_agency'))
{
    $zip = new ZipArchive();
    $write_to = wp_upload_dir();
    //$write_to_path = $write_to['path'].'/test.zip';
    $chal_id = 0;
    $post_status = (isset($_GET['all']) && $_GET['all'] == '1') ? 'publish,draft,pending,private' : 'publish';
    $args = array(
        //'order'               => $order,
        //'orderby'             => $orderby,
        'post_status'         => $post_status,
        'post_type'           => 'solution',
        'posts_per_page'      => -1,
    );
    if(isset($_GET['chal']) && !empty($_GET['chal'])){
        $chal_id = intval('0'.$_GET['chal']);
        $meta_args = array(
            'meta_key' => 'challenge_id',
            'meta_query' => array(
                array(
                    'key' => 'challenge_id',
                    'value' => (int)$chal_id,
                ))
        );
        $args = array_merge( $args, $meta_args );
    }
    $these_solutions = new WP_Query($args);

    if(strpos($_SERVER['SERVER_NAME'],'www.challenge.gov.local') !== false || strpos($_SERVER['SERVER_NAME'],'localhost') !== false)
        $write_to_path = '/Users/robmorris/Documents/testchallengefiles/solution-'.time().'.zip';
    else
        $write_to_path = '/tmp/solution-'.time().'.zip';

    if ($zip->open($write_to_path, ZipArchive::CREATE) === TRUE) {
        $challenge_title = $chal_id != 0 ? get_the_title( $chal_id ) : 'solutions';
        $count = 0;
        $solution_title_array = array();
        if($these_solutions->have_posts())
        {
            while($these_solutions->have_posts()){
                $these_solutions->the_post();
                $count++;
                $author_name = get_the_author_meta('user_login');
                $author_id = get_the_author_meta( 'ID' );
                
                if(!isset($solution_array[$author_id])){
                    if($zip->addEmptyDir($author_name)){
                        //error_log('Created new directory: '.$author_name.' for user '.$author_id);
                    } else {
                        //error_log('Could not create the directory '.$author_name.' for user '.$author_id);
                    }
                }
                $solution_array[$author_id] = !isset($solution_array[$author_id]) ? 1 : $solution_array[$author_id]+1;
                //if($zip->addEmptyDir($author_name.'/solution-'.$solution_array[$author_id])) {
                $solution_txt = '';
                
                if(get_post_status() != 'publish')
                    $solution_txt .= "The user has elected to hide this submission on Challenge.gov\n\n";
                //$solution_txt .= "Submitted By: ".get_the_author()." ".((get_the_author() != get_the_author_meta('user_login')) ? "(".get_the_author_meta('user_login').")" : '').(strpos($challenge_title, 'Congressional App Challenge') !== false ? " - ".get_the_author_meta('user_email') : "")."\n\n";
                $solution_txt .= "Submitted By: ".get_the_author_meta('user_login').(strpos($challenge_title, 'Congressional App Challenge') !== false ? " - ".get_the_author_meta('user_email') : "")."\n\n";
                $solution_txt .= 'Title: '.get_the_title()."\n\n";
                $solution_title = trim(get_the_title());
                $solution_title = str_replace('"', "", $solution_title);
                $solution_title = str_replace("'", "", $solution_title);
                $solution_title = str_replace("8211;", "", $solution_title);
                $solution_title = str_replace("8220;", "", $solution_title);
                $solution_title = str_replace("8221;", "", $solution_title);
                
                $solution_title = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).])", '', html_entity_decode($solution_title));
                // Remove any runs of periods
                $solution_title = preg_replace("([\.]{2,})", '', $solution_title);

                if($zip->addEmptyDir($author_name.'/'.$solution_title)) {
                    //error_log('Created new directory: solution-'.$solution_array[$author_id].' for user '.$author_id);
                } else {
                //error_log('Could not create the directory solution-'.$solution_array[$author_id].' for user '.$author_id);
                }

                if(isset($solution_title_array[$author_id]) && in_array(strtolower($solution_title),$solution_title_array[$author_id]))
                {
                    $title_counter = 1;
                    $new_solution_title = $solution_title;
                    while(in_array(strtolower($new_solution_title),$solution_title_array[$author_id]))
                    {
                        $title_counter++;
                        $new_solution_title = $solution_title.'-'.$title_counter;
                    }
                    $solution_title = $new_solution_title;
                    $solution_title_array[$author_id][] = strtolower($solution_title);
                }else{
                    $solution_title_array[$author_id][] = strtolower($solution_title);
                }

                $the_desc = get_field('description');
                $the_img = get_field('image_logo');

                if(!empty($the_img))
                    $solution_txt.= 'Image/Logo: '.$the_img['url']."\n\n";
                $ext_url = get_field('external_url');
                if(!empty($ext_url))
                    $solution_txt.= 'External Url: '.$ext_url."\n\n";

                $attachments = get_attached_media('');
                //error_log(get_the_title());
                //error_log(print_r($attachments,1));
                if(!empty($attachments)){
                    //if($zip->addEmptyDir($author_name.'/solution-'.$solution_array[$author_id].'/files')){
                    if($zip->addEmptyDir($author_name.'/'.$solution_title.'/files')){
                        $file_count = 0;
                        $file_out = '';
                        foreach($attachments as $attachment){
                            $this_file = get_attached_file( $attachment->ID );
                            preg_match('#^.+/(.*)$#', $this_file, $matches);
                            if(!empty($matches)){
                                //$zip->addFile($this_file, $author_name.'/solution-'.$solution_array[$author_id].'/files/'.$matches[1]);
                                $zip->addFile($this_file, $author_name.'/'.$solution_title.'/files/'.$matches[1]);
                            }
                        }
                    }
                }
                $solution_txt .= 'Description: '.$the_desc;
                //$zip->addFromString($author_name.'/solution-'.$solution_array[$author_id].'/solution.txt', $solution_txt);
                //$zip->addFromString($author_name.'/solution-'.$solution_array[$author_id].'/solution.html', str_replace("\n", "<br/>", $solution_txt));
                $zip->addFromString($author_name.'/'.$solution_title.'/'.$solution_title.'.txt', $solution_txt);
                $zip->addFromString($author_name.'/'.$solution_title.'/'.$solution_title.'.html', str_replace("\n", "<br/>", $solution_txt));
            }
        }
        $solution_info .= "Solutions downloaded: ".$count."\n\n";
        $solution_info .= "Number of submitters: ".count($solution_array)."\n\n";
        $solution_info .= "For technical assistance, contact the Challenge.gov team at challenge@gsa.gov.\n\n";

        $output_name = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).])", '', html_entity_decode($challenge_title));
        // Remove any runs of periods
        $output_name = preg_replace("([\.]{2,})", '', $output_name);

        $zip->addFromString($output_name.'-solution-overview.txt', $solution_info);
        wp_reset_postdata();
        $zip->close();

        $dt = DateTime::createFromFormat('U', time());
        $dt->setTimeZone(new DateTimeZone('America/New_York'));
        $adjusted_timestamp = $dt->format('U') + $dt->getOffset();
        $date_out = date('mdy.Hi',$adjusted_timestamp);
        $output_name = "Challenge - ".$output_name.($output_name != 'solutions' ? " - solutions": '').'.'.$date_out;

        /*if (isset($_SERVER['HTTP_USER_AGENT'])) {
            if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false){
                $output_name = str_replace(' ','-',$output_name);
            }
        }*/

        //error_log(print_r($solution_title_array,1));
        ob_end_clean();
        if (file_exists($write_to_path)){
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"".$output_name.".zip\"");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: ".filesize($write_to_path));
            ob_end_flush();
            @readfile($write_to_path);
        }
        /*header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename="'.$output_name.'.zip"');
        header('Content-Length: ' . filesize($write_to_path));
        header("Pragma: no-cache"); 
        header("Expires: 0"); 
        readfile($write_to_path);*/
        unlink($write_to_path);
    } else {
        echo 'failed';
    }
}else{
    echo '<center>You do not have access to download this file.<br/><br/> <a href="'.site_url('list').'">Click here to return home</a></center>';
}
?>