<?php

add_action('shutdown', 'gather_chart_data');

function gather_chart_data()
{
   
   
    $host="";
    $report_on="";
    $prizearray=array();
    if(isset($_POST['report_on']) && $_POST['report_on']!="")
    {
        if($_POST['report_on']=="challenges")
        {
            $report_on="challenges";
        }
        else{
            $report_on="agencies";
        }
    }
    if(isset($_POST['host_platform']) && $_POST['host_platform']!="")
    {
        foreach ($_POST['host_platform'] as $host){
             $hostdata[]=$host;
        }
    }
    if((isset($_POST['number_of_challenges']) && $_POST['number_of_challenges']!="") && ($_POST['display_selection']=="top"))
    {
        $numb_of_challenges=$_POST['number_of_challenges'];
        $prizearray=gettopchallenges($numb_of_challenges);
    }
   
    if(isset($_POST['chart_data']) && $_POST['chart_data']!="")
    {
        $chart_data=$_POST['chart_data'];
        
    }
     if((isset($_POST['number_of_agencies']) && $_POST['number_of_agencies']!="") && ($_POST['display_selection']=="top"))
    {
        $numb_of_agencies=$_POST['number_of_agencies'];
        if($_POST['chart_data']!="")
        {
            gettopagencies($numb_of_agencies,$_POST['chart_data']);
        }    
    }
    if((isset($_POST['display_selection']) && $_POST['display_selection']=="agency_selection") && $_POST['agency_selection_box']!="")
    {
        $agencyname=$_POST['agency_selection_box'];
    }
    if(isset($_POST['chart_type']) && $_POST['chart_type']=="pie" && $_POST['display_selection']!="top")
    {
     getPieChart($report_on,$hostdata,$prizearray,$chart_data,$agencyname);
    }
   
   
}
function gettopchallenges($numb_of_challenges)
{
    
    $allchallenges = array(
                    'posts_per_page' => -1,
                    'post_type' => 'challenge',
                    'post_status' =>  'publish'
                    );
    $challenge_query = new WP_Query( $allchallenges );
    if($challenge_query->have_posts() ):
        while( $challenge_query->have_posts() ) : $challenge_query->the_post();
            $the_prizes = get_field('the_prizes',get_the_ID());
            foreach ($the_prizes as $this_prize)
            {
                $this_cash_value = $this_prize['the_cash_amount'];
                $prize_array[get_the_ID()]=$this_cash_value;
            }    
       endwhile;         
    arsort($prize_array);
    endif;
    $prize_array=array_slice($prize_array,0,$numb_of_challenges,true);
   
    return $prize_array;
}

function gettopagencies($numb_of_agencies,$data)
{
 $color_array=array("#2EC4B6", "#C0C0C0", "#CEE0DC", "#B9CFD4", "#FCA311", "#A9BCD0", "#58A4B0", "#77BFC7", "#EEF5DB", "#A9A9F5", "#F0B67F", "#D6D1B1", "#E5E6E4", "#CFD2CD", "#999999", "#847577", "#FBFBF2", "#97F9F9", "#A4DEF9", "#C1E0F7", "#C59FC9");

    
    $allchallenges = array(
                    'posts_per_page' => -1,
                    'post_type' => 'challenge',
                    'post_status' =>  'publish'
                    );
    $challenge_query = new WP_Query( $allchallenges );
    if($challenge_query->have_posts() ):
        while( $challenge_query->have_posts() ) : $challenge_query->the_post();
             if($data=="challenge_type")
                {
                    $category_data = get_field('category',get_the_ID());
                    
                     $terms = wp_get_post_terms(get_the_ID(), 'agency');
                    foreach($terms as $term)
                    {
                        $assignagency=$term->name;
                        
                         if(gettype($category_data)=="string")
                        {
                           //get_the_title(get_the_ID())
                            
                             if(isset($agency_data[$category_data][$assignagency]))
                            {
                                $agency_data[$category_data][$assignagency]++;
                                               
                            }
                            else{
                                $agency_data[$category_data][$assignagency]=1;
                                               
                            }
                            // Challenges posted by agencies per category
                            $challenge_per_agencies[$category_data][$assignagency][]= get_the_title(get_the_ID()); 
                            
                        }
                        else{
                            foreach($category_data as $catdata)
                            {
                                  if(isset($agency_data[$catdata][$assignagency]))
                                {
                                    $agency_data[$catdata][$assignagency]++;
                                                     
                                }
                                else{
                                    $agency_data[$catdata][$assignagency]=1;
                                                   
                                }
                                
                                // Challenges posted by agencies per category
                                $challenge_per_agencies[$catdata][$assignagency][]= get_the_title(get_the_ID());
                                
                            }
                        }
                    }
                   
                }
                else
                {
                    if($data=="prize_type")
                    {
                        $report_type = get_field('prize_type',get_the_ID());
                    }
                    if($data=="solution_type")
                    {
                        $report_type = get_field('solution_type',get_the_ID());
                    }
                    if($data=="legal_authority")
                    {
                        $report_type = get_field('legal_authority',get_the_ID());
                    }    
                     if(isset($report_type) && $report_type!="" && $report_type!=":")
                    {
                         $terms = wp_get_post_terms(get_the_ID(), 'agency');
                        foreach($terms as $term)
                        {
                            
                           
                            $assignagency=$term->name;
                            if(isset($agency_data[$report_type][$assignagency]))
                            {
                                $agency_data[$report_type][$assignagency]++;
                                
                            }
                            else{
                                 $agency_data[$report_type][$assignagency]=1;
                            }
                            
                           
                            // Challenges posted by agencies per prize type
                            $challenge_per_agencies[$report_type][$assignagency][]= get_the_title(get_the_ID());
                        } 
                    }
                }
                 
                    
                
                
                if($data=="cash_prize")
                {
                    $the_prizes = get_field('the_prizes',get_the_ID());
                    $terms = wp_get_post_terms(get_the_ID(), 'agency');
                     for($i=0; $i<=5000000; $i=$i+500000)
                    {
                         $prize_increment[]=$i;
                         
                       
                    }
                    foreach($terms as $term)
                    {
                        $assignagency=$term->name;
                    }    
                     $added_challenge_prize=0;
                         
                        foreach ($the_prizes as $this_prize)
                        {
                            $challenge_prize = intval($this_prize['the_cash_amount']);
                            $added_challenge_prize+=$challenge_prize;
                           
                                $j=0;
                               $terms = wp_get_post_terms(get_the_ID(), 'agency');

                                for($i=0; $i<=5000000; $i=$i+500000)
                                {
                                   
                                  
                                    if(intval($prize_increment[$j])<=intval($added_challenge_prize) && intval($added_challenge_prize)<=intval($prize_increment[$j+1]))
                                    {
                                        $prize_purse=($prize_increment[$j]+1)."-".$prize_increment[$j+1];
                                        
                                        if(@array_key_exists($assignagency,$temp_agency_data[$prize_purse]))
                                        {
                                            $temp_agency_data[$prize_purse][$assignagency]++;
                                        }    
                                        else{
                                            $temp_agency_data[$prize_purse][$assignagency]=0;
                                        }
                                            
                                    }
                                     if(intval($added_challenge_prize) >=5000000)
                                    {
                                        $prize_purse="5000000 >";
                                        
                                        if(@array_key_exists($assignagency,$temp_agency_data[$prize_purse]))
                                        {
                                            $temp_agency_data[$prize_purse][$assignagency]++;
                                        }    
                                        else{
                                            $temp_agency_data[$prize_purse][$assignagency]=0;
                                        }
                                        
                                    }
                                    
                                   $j=$j+1;
                                }
                               
                       
                        $cnt++;
                        }
                        foreach($temp_agency_data as $temp_prize=>$temp_agency_challenge)
                        {
                            foreach($temp_agency_challenge as $temp_agency=>$temp_challenge_cnt)
                            {
                                if($temp_challenge_cnt!=0)
                                {
                                    $agency_data[$temp_prize][$temp_agency]=$temp_challenge_cnt;
                                }
                                
                            }
                            
                        }
                       //asort($agency_data);
                        
                }
                
                
                    
           
            
          endwhile;
         
  
    $newarr = array();
    foreach($agency_data as $key => $val) {
       
        arsort($val);
        
        $newagencyarr[$key] = $val;
       
    }
  
    foreach($newagencyarr as $cat=>$agencycnt)
    {
        
        $agency_array[$cat]=array_slice($agencycnt,0,$numb_of_agencies,true);
    }
    

    
    foreach($agency_array as $category => $agencies)
    {
       // print_r($agencies);
       $challengecnt_per_category=0;
        foreach($agencies as $agency_name => $challengecnt)
        {
            
            $challengecnt_per_category+=$challengecnt;
        }
        $json_agencies[]=array(
                        "Category" => $category,
                       "Agencies" => $challengecnt_per_category
                       
                    );
    }
   
    
    $showagencytable="<table width='100%' class='table table-condensed table-bordered chart-table'>";
            $showagencytable.="<tr><th><i class='fa fa-bar-chart' title='Chart Color Indication'></i></th><th width='30%'>Category</th><th width='50%'>Agencies</th><th align='left' width='20%'>Challenge Count</th></tr>";
            $k=0;
            foreach($agency_array as $category => $agencies)
            {
                
                $showagencytable.="<tr><td BGCOLOR=".$color_array[$k]."></td><td valign='top' align='left' width='30%' valign='top'>".$category."</td><td colspan='2' BGCOLOR=".$color_array[$k].">";
                
                foreach($agencies as $agencyname => $challengecnt)
                {
                    
                        $termdata=get_term_by('name',  $agencyname, 'agency');
                        $parent_agency="";
                        if($termdata->parent!=0)
                        {
                                       
                            $parent_agency_data=get_term_by('id', $termdata->parent, 'agency');
                            
                            $parent_agency=$parent_agency_data->name;
                                       
                        }
                         
                        $showagencytable.="<table width='100%'><tr><td alight='left' width='50%'>".$agencyname;
                        if($parent_agency!="")
                        {
                            $showagencytable.=" - <b>Parent: </b>".$parent_agency;
                        }
                        $showagencytable.="</td><td alight='left' width='20%'>".$challengecnt."</td></tr></table>";
                    
                       
                }        
                    $showagencytable.="</td></tr>";
                    $k++;
                
            }
            $showagencytable.="</table>";
  
    endif;
    
     if(!isset($json_agencies) || $json_agencies=="")
        {
            ?>
            <script type="text/javascript">
                jQuery( document ).ready(function() {
                    jQuery("#drawpiechart").html("Sorry! No data found.");
                });
             </script>
        <?php
        }
        else{
     ?>
         <script type="text/javascript">
        var chart;
           DrawAuthorityPieChart();
           function DrawAuthorityPieChart()
           {
           jQuery("#legenddiv").html("<?php echo $showagencytable;?>");
          
           AmCharts.ready(function() {
           
           var chartAuthorityData=<?php echo json_encode( $json_agencies );?>;
          
               chart = new AmCharts.AmPieChart();
               chart.valueField = "Agencies";
               chart.titleField = "Category";
               chart.dataProvider = chartAuthorityData;
              
               chart.write("drawpiechart");
               });
           }
         </script>
   <?php 
    }
    //$prize_array=array_slice($prize_array,0,$numb_of_challenges,true);
    exit;
    
  
}

function getPieChart($report_on,$host,$prizearray,$chart_data,$agencyname)
{
    $color_array=array("#2EC4B6", "#C0C0C0", "#CEE0DC", "#B9CFD4", "#FCA311", "#A9BCD0", "#58A4B0", "#77BFC7", "#EEF5DB", "#A9A9F5", "#F0B67F", "#D6D1B1", "#E5E6E4", "#CFD2CD", "#999999", "#847577", "#FBFBF2", "#97F9F9", "#A4DEF9", "#C1E0F7", "#C59FC9");

    if(isset($prizearray) && $prizearray!="")
    {
        foreach($prizearray as $challengeids => $prizes)
        {
            $challengeidsarray[]=$challengeids;
        }
    }
   
    if(isset($host) && $host!="")
    {
        foreach($host as $hostplatform)
        {
            if($hostplatform=="external")
            {
                $hostvalue[]="remote";
            }
            if($hostplatform=="internal")
            {
                $hostvalue[]="local";
            }
        }
     
        if($report_on=="agencies")
        {
            
           if($agencyname=="all")
           {
                $term_args=array('orderby'  => 'name', 
                         'order'    => 'ASC');
        
        
                $agency_list=get_terms( 'agency', $term_args );
                 foreach($agency_list as $agencies)
                {
                    
                     $allagencies=$agencies->name;
                     $agencyname_array[]=$allagencies;
                }
                $allchallenges = array(
                    'posts_per_page' => -1,
                    'post_type' => 'challenge',
                    'post_status' =>  'publish',
                   
                    'meta_query' => array(
                            array(
                            'key' => 'where_host',
                            'value' => $hostvalue
                            )),
                     'tax_query' => array(
                                    array(
                                            'taxonomy' => 'agency',
                                            'terms'    => $agencyname_array,
                                            'field'    => 'slug',
                                            'operator' => 'IN'
                                            
                                )
                            )   
                    );
           }
           else{
           
            $allchallenges = array(
                    'posts_per_page' => -1,
                    'post_type' => 'challenge',
                    'post_status' =>  'publish',
                   
                    'meta_query' => array(
                            array(
                            'key' => 'where_host',
                            'value' => $hostvalue
                            )),
                     'tax_query' => array(
                                    array(
                                            'taxonomy' => 'agency',
                                            'terms'    => $agencyname,
                                            'field'    => 'slug',
                                            'operator' => 'IN'
                                            
                                )
                            )   
                    );
           
           }  
        }
        else
        {
            $allchallenges = array(
                        'posts_per_page' => -1,
                        'post_type' => 'challenge',
                        'post_status' =>  'publish',
                        'post__in' => $challengeidsarray,
                        'meta_query' => array(
                                array(
                                'key' => 'where_host',
                                'value' => $hostvalue
                                ))
                        
                        );
        }
    }
    else{
        if($report_on=="agencies" && $agencyname!="all")
        {
            $allchallenges = array(
                    'posts_per_page' => -1,
                    'post_type' => 'challenge',
                    'post_status' =>  'publish',
                    
                     'tax_query' => array(
                                    array(
                                            'taxonomy' => 'agency',
                                            'terms'    => $agencyname,
                                            'field'    => 'slug',
                                            'operator' => 'IN'
                                            
                                )
                            )   );
        }
        else
        {
            $allchallenges = array(
                        'posts_per_page' => -1,
                        'post_type' => 'challenge',
                        'post_status' =>  'publish',
                        'post__in' => $challengeidsarray);
        }    
    }
    $challenge_query = new WP_Query( $allchallenges );
    
    if($challenge_query->have_posts() ):
                 if($chart_data=="cash_prize")
                {
                  $j=0;
                    for($i=0; $i<=5000000; $i=$i+500000)
                    {
                         $prize_increment[]=$i;
                         
                       
                    }
                   
                    
                }
               
         while( $challenge_query->have_posts() ) : $challenge_query->the_post();
                
                $challenge_title=get_the_title( get_the_ID() );
                if($chart_data=="challenge_type")
                {
                    $category = get_field('category',get_the_ID());
                   
                }
                if($chart_data=="prize_type")
                {
                    $category = get_field('prize_type',get_the_ID());
                     if(!isset($category) || $category=="" || $category==":")
                    {
                        $category="None";
                    }
                }
                 if($chart_data=="solution_type")
                {
                    $category = get_field('solution_type',get_the_ID());
                    if(!isset($category) || $category=="" || $category==":")
                    {
                        $category="None";
                    }
                }
                
                if($chart_data=="cash_prize")
                {
                    
                   
                    
                    $the_prizes = get_field('the_prizes',get_the_ID());
                    
                }
                
                if($chart_data=="legal_authority")
                {
                     $category = get_field('legal_authority',get_the_ID());
                    if(!isset($category) || $category=="" || $category==":")
                    {
                        $category="None";
                    }
                }
                $cnt=0;
              
            
                    if($chart_data=="cash_prize")
                    {
                        $added_challenge_prize=0;
                         
                        foreach ($the_prizes as $this_prize)
                        {
                            $challenge_prize = intval($this_prize['the_cash_amount']);
                            $added_challenge_prize+=$challenge_prize;
                           
                                $j=0;
                               
                                for($i=0; $i<=5000000; $i=$i+500000)
                                {
                                   
                                  
                                    if(intval($prize_increment[$j])<=intval($added_challenge_prize) && intval($added_challenge_prize)<=intval($prize_increment[$j+1]))
                                    {
                                        $category[]=($prize_increment[$j]+1)."-".$prize_increment[$j+1];
                                        $number_of_challenges[$prize_increment[$j]."-".$prize_increment[$j+1]]++;
                                       
                                       if($report_on=="agencies" && $agencyname=="all")
                                        {
                                            
                                            $terms = wp_get_post_terms(get_the_ID(), 'agency');
                                            foreach($terms as $term)
                                            {
                                                   $assignagency=$term->name;
                                                   $challenge_title_array[$assignagency][$challenge_title][]=$prize_increment[$j]."-".$prize_increment[$j+1];
                                                   
                                            }
                                        }
                                        else{
                                            
                                            
                                            if(@!in_array($challenge_title,$challenge_title_array[$prize_increment[$j]."-".$prize_increment[$j+1]]))
                                            {
                                                    $challenge_title_array[$prize_increment[$j]."-".$prize_increment[$j+1]][]=$challenge_title;
                                                    break;
                                            }
                                        }    
                                            
                                        
                                    }
                                     if(intval($added_challenge_prize) >=5000000)
                                    {
                                        $number_of_challenges["5000000 >"]++;
                                        if($report_on=="agencies" && $agencyname=="all")
                                        {
                                            
                                            $terms = wp_get_post_terms(get_the_ID(), 'agency');
                                            foreach($terms as $term)
                                            {
                                                   $assignagency=$term->name;
                                                   $challenge_title_array[$assignagency][$challenge_title][]="5000000 >";
                                                   
                                            }
                                        }
                                        else{
                                            if(@!in_array($challenge_title,$challenge_title_array["5000000 >"]))
                                            {
                                                $challenge_title_array["5000000 >"][]=$challenge_title;
                                                 break;
                                            }    
                                           
                                        }
                                    }
                                    
                                   $j=$j+1;
                                }
                               
                        
                        $cnt++;
                        }
                        $category[]="5000000 >";
                        
                    }
                    
                    else{
                        
                    
                        

                               if(gettype($category)=="string")
                                {
                                     if(isset($number_of_challenges[ltrim($category)]))
                                        {
                                            $number_of_challenges[ltrim($category)]++;
                                                   
                                        }
                                        else{
                                            $number_of_challenges[ltrim($category)]=1;
                                                
                                        }
                                        
                                    if($report_on=="agencies" && $agencyname=="all")
                                    {
                                        
                                        $terms = wp_get_post_terms(get_the_ID(), 'agency');
                                        foreach($terms as $term)
                                        {
                                               $assignagency=$term->name;
                                               $challenge_title_array[$assignagency][$challenge_title][]=ltrim($category);
                                               
                                        }
                                    }
                                    else{
                                        $challenge_title_array[ltrim($category)][]=$challenge_title;
                                    }
                                }
                                else
                                {
                                    foreach($category as $cat)
                                    {
                                        if(isset($number_of_challenges[ltrim($cat)]))
                                       {
                                           $number_of_challenges[ltrim($cat)]++;
                                                 
                                       }
                                       else{
                                           $number_of_challenges[ltrim($cat)]=1;
                                               
                                       }
                                       if($report_on=="agencies" && $agencyname=="all")
                                        {
                                            
                                            $terms = wp_get_post_terms(get_the_ID(), 'agency');
                                            foreach($terms as $term)
                                            {
                                                   $assignagency=$term->name;
                                                   $challenge_title_array[$assignagency][$challenge_title]=ltrim($cat);
                                                   
                                            }
                                        }
                                        else{
                                          $challenge_title_array[ltrim($cat)][]=$challenge_title;
                                        }
                                    }
                    
                                }
                    }        
              //  }  
         endwhile;
       
     //  print_r($number_of_challenges);
        $k=0;
        
        foreach($number_of_challenges as $category_name => $numb_of_challenges)
        {
            
             
               
                  $jsoncategory[] = array(
                    "Category" => $category_name,
                   "Challenge_category_Cnt" => $numb_of_challenges
                   
                );
                 
        }
  
       if($chart_data=="challenge_type")
       {
            $categorytitle="Challenge Type";
       }
       else if($chart_data=="prize_type")
       {
            $categorytitle="Prize Type";
       }
        else if($chart_data=="solution_type")
       {
            $categorytitle="Solution Type";
       }
       else if($chart_data=="solution_type")
       {
            $categorytitle="Solution Type";
       }
       else if($chart_data=="cash_prize")
       {
            $categorytitle="Cash Value";
       }
       else if($chart_data=="legal_authority")
       {
            $categorytitle="Legal Authority ";
       }
       
        if($report_on=="agencies" && $agencyname=="all")
        {
            $showtable="<table width='100%'>";
            $showtable.="<tr><td width='30%'>Agencies</td><td width='50%'>Challenge Name</td><td align='left' width='20%'>".$categorytitle."</td></tr>";
            
            foreach($challenge_title_array as $agencytitle => $challengetitle)
            {
                $showtable.="<tr><td valign='top' align='left' width='30%'>".$agencytitle."</td><td colspan='2'>";
                
                foreach($challengetitle as $challenges => $category)
                {
                    $challenge_cat="";
                     if(gettype($category)=="string")
                    {
                        $challenge_cat.=$category;
                        
                       
                    }
                    else{
                        $challenge_cat.=$category[0];
                    }
                    
                    $index = array_search($challenge_cat, array_column($jsoncategory, 'Category'));
                    $bgcolor=$color_array[$index];
                    
                    $showtable.="<table width='100%' style='background-color:".$bgcolor."'><tr><td alight='left' width='50%'>".$challenges."</td><td alight='left' width='20%'>".$challenge_cat."</td></tr></table>";
            
                }
                $showtable.="</td></tr>";
            }
            $showtable.="</table>";
            
        }
        else{
            $showtable="<table width='100%'>";
            $showtable.="<tr><td>".$categorytitle."</td><td>Challenge Name</td></tr>";
            foreach($challenge_title_array as $category_name => $challengetitle)
            {
                 
               $showtable.="<tr><td BGCOLOR=".$color_array[$k]." valign='top'>".$category_name."</td><td BGCOLOR=".$color_array[$k].">";
               
                foreach($challengetitle as $challengename)
                {
                    
                     $showtable.="<table><tr><td>".$challengename."</td></tr></table>";
                    
                }
                $showtable.="</td></tr>";
                $assigncolor[]=$color_array[$k];
                 $k++;
                    
            }
            $showtable.="</table>";
        }
    endif;


     
        if(!isset($jsoncategory) || $jsoncategory=="")
        {
            ?>
            <script type="text/javascript">
                jQuery( document ).ready(function() {
                    jQuery("#drawpiechart").html("Sorry! No data found.");
                });
             </script>
        <?php
        }
        else{
     ?>
         <script type="text/javascript">
        var chart;
           DrawAuthorityPieChart();
           function DrawAuthorityPieChart()
           {
           jQuery("#legenddiv").html("<?php echo $showtable;?>");
           jQuery("#agencynamediv").html("<?php echo $agencyname;?>");
           AmCharts.ready(function() {
             // console.write(<?php echo json_encode( $jsoncategorylables );?>);
           
            var chartAuthorityData=<?php echo json_encode( $jsoncategory );?>;
          
               chart = new AmCharts.AmPieChart();
               chart.valueField = "Challenge_category_Cnt";
               chart.titleField = "Category";
               chart.dataProvider = chartAuthorityData;
              
               chart.write("drawpiechart");
               });
           }
         </script>
   <?php 
    }
   
}

?>