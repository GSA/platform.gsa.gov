<?php

if (!function_exists('array_column')) {
    /**
     * Returns the values from a single column of the input array, identified by
     * the $columnKey.
     *
     * Optionally, you may provide an $indexKey to index the values in the returned
     * array by the values from the $indexKey column in the input array.
     *
     * @param array $input A multi-dimensional array (record set) from which to pull
     *                     a column of values.
     * @param mixed $columnKey The column of values to return. This value may be the
     *                         integer key of the column you wish to retrieve, or it
     *                         may be the string key name for an associative array.
     * @param mixed $indexKey (Optional.) The column to use as the index/keys for
     *                        the returned array. This value may be the integer key
     *                        of the column, or it may be the string key name.
     * @return array
     */
    function array_column($input = null, $columnKey = null, $indexKey = null)
    {
        // Using func_get_args() in order to check for proper number of
        // parameters and trigger errors exactly as the built-in array_column()
        // does in PHP 5.5.
        $argc = func_num_args();
        $params = func_get_args();
        if ($argc < 2) {
            trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
            return null;
        }
        if (!is_array($params[0])) {
            trigger_error(
                'array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given',
                E_USER_WARNING
            );
            return null;
        }
        if (!is_int($params[1])
            && !is_float($params[1])
            && !is_string($params[1])
            && $params[1] !== null
            && !(is_object($params[1]) && method_exists($params[1], '__toString'))
        ) {
            trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        if (isset($params[2])
            && !is_int($params[2])
            && !is_float($params[2])
            && !is_string($params[2])
            && !(is_object($params[2]) && method_exists($params[2], '__toString'))
        ) {
            trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        $paramsInput = $params[0];
        $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;
        $paramsIndexKey = null;
        if (isset($params[2])) {
            if (is_float($params[2]) || is_int($params[2])) {
                $paramsIndexKey = (int) $params[2];
            } else {
                $paramsIndexKey = (string) $params[2];
            }
        }
        $resultArray = array();
        foreach ($paramsInput as $row) {
            $key = $value = null;
            $keySet = $valueSet = false;
            if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                $keySet = true;
                $key = (string) $row[$paramsIndexKey];
            }
            if ($paramsColumnKey === null) {
                $valueSet = true;
                $value = $row;
            } elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                $valueSet = true;
                $value = $row[$paramsColumnKey];
            }
            if ($valueSet) {
                if ($keySet) {
                    $resultArray[$key] = $value;
                } else {
                    $resultArray[] = $value;
                }
            }
        }
        return $resultArray;
    }
}

   


add_action('shutdown', 'gather_pie_chart_data');

function gather_pie_chart_data()
{
   
    $host="";
    $report_on="";
    $prizearray=array();
     setlocale(LC_MONETARY, 'en_US');
    if(isset($_POST['chart_type']) && $_POST['chart_type']=="pie")
    {
        if(isset($_POST['display_selection']) && $_POST['display_selection']!="")
        {
            if($_POST['display_selection']=="all_challenges" || $_POST['display_selection']=="top_challenges")
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
         if(isset($_POST['chart_data']) && $_POST['chart_data']!="")
        {
            $chart_data=$_POST['chart_data'];
            
        }
        
        if((isset($_POST['display_selection']) && $_POST['display_selection']=="agency_selection") && $_POST['agency_selection_box']!="")
        {
            $agencyname=$_POST['agency_selection_box'];
        }
        
        $finaldate="";
       
       if(isset($_POST['submission_start_from']) && $_POST['submission_start_from']!="")
       {
            $startdate=$_POST['submission_start_from'];
            
       }
      
       if(isset($_POST['submission_end_to']) && $_POST['submission_end_to']!="")
       {
            $enddate=$_POST['submission_end_to'];
       }
       if($startdate!="" && $enddate!="")
       {
            $finaldate=$startdate."||".$enddate;
       }
       
       
         if((isset($_POST['number_of_agencies']) && $_POST['number_of_agencies']!="") && ($_POST['display_selection']=="top_agencies") && $report_on=="agencies")
        {
            $numb_of_agencies=$_POST['number_of_agencies'];
            $callfor='loadchart';
            if($_POST['chart_data']!="")
            {
                gettopagencies($numb_of_agencies,$_POST['chart_data'],$hostdata,$finaldate,$callfor);
            }    
        }
        else{
            $callfor='loadchart';
            getPieChart($report_on,$hostdata,$prizearray,$chart_data,$agencyname,$finaldate,$callfor);
        }
        
        
    }
   
   
}

function gettopagencies($numb_of_agencies,$data,$host,$daterange,$callfor)
{
   
 //$color_array=array("#FF0F00", "#FF6600", "#FF9E01", "#FCD202", "#F8FF01", "#B0DE09", "#04D215", "#0D8ECF", "#77BFC7", "#2A0CD0", "#8A0CCF", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25");
//$color_array=array("#2EC4B6", "#C0C0C0", "#CEE0DC", "#B9CFD4", "#FCA311", "#A9BCD0", "#58A4B0", "#77BFC7", "#EEF5DB", "#A9A9F5", "#F0B67F", "#D6D1B1", "#E5E6E4", "#CFD2CD", "#999999", "#847577", "#FBFBF2", "#97F9F9", "#A4DEF9", "#C1E0F7", "#C59FC9");
    
    $allchallenges = array(
                    'posts_per_page' => -1,
                    'post_type' => 'challenge',
                    'post_status' =>  'publish'
                    );
    
    if($daterange!="")
    {
        
        $date_array=explode("||",$daterange);
        
        $start_timestamp=mysql2date( 'U', $date_array[0]);
        $end_timestamp=mysql2date( 'U', $date_array[1]);
         $sort_array[] = array(
				'key' => 'submission_end',
				'value'=> $start_timestamp,
				'compare' => '>='
                                );
                             
        $sort_array[] = array(
				'key' => 'submission_end',
				'value'=> $end_timestamp,
				'compare' => '<='
                                );
         
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
        $sort_array[] = array(
                            'key' => 'where_host',
                            'value' => $hostvalue
                        );
        
       
       
           
    }
   if(isset($sort_array) && $sort_array!="")
   {
        $meta_args=array('meta_query' => $sort_array);
        $allchallenges=array_merge($allchallenges,$meta_args);
   }
   
    $challenge_query = new WP_Query( $allchallenges );
    if($challenge_query->have_posts() ):
    $color_array=array();
        while( $challenge_query->have_posts() ) : $challenge_query->the_post();
        $new_color="#".random_color();
        array_push($color_array,$new_color);
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
                            if($category_data=="ScientificEngineering")
                            {
                                $category_data="Scientific / Engineering";
                            }
                            if($category_data=="SoftwareApps")
                            {
                                $category_data="Software / Apps";
                            }
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
                                if($catdata=="ScientificEngineering")
                                {
                                    $catdata="Scientific / Engineering";
                                }
                                if($catdata=="SoftwareApps")
                                {
                                    $catdata="Software / Apps";
                                }
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
                
                 elseif($data=="cash_prize")
                {
                    $the_prizes = get_field('the_prizes',get_the_ID());
                    $terms = wp_get_post_terms(get_the_ID(), 'agency');
                    $added_challenge_prize=0;
                    for($i=0; $i<=5000000; $i=$i+500000)
                    {
                         $prize_increment[]=$i;
                         
                       
                    }
                    
                    foreach($terms as $term)
                    {
                        $assignagency=$term->name;
                    }    
                     
                         
                         
                    foreach ($the_prizes as $this_prize)
                    {
                        $challenge_prize = intval($this_prize['the_cash_amount']);
                        $added_challenge_prize+=$challenge_prize;
                        $prize_array_for_challenge[get_the_ID()]=$added_challenge_prize;
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
                    if($data=="tot_numb_challenges")
                    {
                        $report_type = get_field('fiscal_year',get_the_ID());
                        if($report_type=="")
                        {
                            $report_type="No FY";
                        }
                    }
                      
                      if($data=="by_agency")
                      {
                         $terms = wp_get_post_terms(get_the_ID(), 'agency');
                           foreach($terms as $term)
                           {
                               $assignagency=$term->name;
                               if(isset($agency_data[$assignagency]))
                               {
                                   $agency_data[$assignagency]++;
                                   
                               }
                               else{
                                    $agency_data[$assignagency]=1;
                               }
                               
                              
                               // Challenges posted by agencies per prize type
                               $challenge_per_agencies[$assignagency][]= get_the_title(get_the_ID());
                           } 
                      }
                      else{
                        
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
                    }
              

          endwhile;
    if($data=="tot_numb_challenges")
    {
        if($agencyname!="all")
        {
            foreach($agency_data as $cat=>$chdata)
            {
                if($cat=="No FY")
                {
                    $chtitletemp1[$cat]=$chdata;
                }
                else{
                    $chtitletemp2[$cat]=$chdata;
                }
                    
            }
            if(isset($chtitletemp2) && $chtitletemp2!="")
            {
                ksort($chtitletemp2);
                if(!isset($chtitletemp1) || empty($chtitletemp1))
		{
		    $agency_array=$chtitletemp2;
		}
		else
		{
                    $agency_array=array_merge_recursive($chtitletemp1,$chtitletemp2);
                }
            }
            else{
                $agency_array=$chtitletemp1;
            }
                
                
        }
            
    }  
    if($data=="cash_prize")
    {
           
            foreach ($prize_array_for_challenge as $challengeid=>$added_challenge_prize)
            {
                          
                $j=0;
               // $challenge_title=get_the_title($challengeid);
                $terms = wp_get_post_terms($challengeid, 'agency');
                foreach($terms as $term)
                {
                    $assignagency=$term->name;
                }    
                
                    if(intval($added_challenge_prize)==0)
                    {
                        $prize_purse="No Cash Value";
                                        
                        if(@array_key_exists($assignagency,$temp_agency_data_first[$prize_purse]))
                        {
                            $temp_agency_data_first[$prize_purse][$assignagency]++;
                        }    
                        else{
                            $temp_agency_data_first[$prize_purse][$assignagency]=1;
                        }
                                      
                    }
                    if(intval($added_challenge_prize) >=5000000)
                            {
                               
                                $prize_purse="$5,000,000 >";
                                if(@array_key_exists($assignagency,$temp_agency_data_last[$prize_purse]))
                                {
                                    $temp_agency_data_last[$prize_purse][$assignagency]++;
                                }    
                                else{
                                    $temp_agency_data_last[$prize_purse][$assignagency]=1;
                                }
                                           
                            }
                    
                for($i=1; $i<=5000000; $i=$i+500000)
                {
                   if(intval($prize_increment[$j]+1)<=intval($added_challenge_prize) && intval($added_challenge_prize)<=intval($prize_increment[$j+1]))
                    {
                        //echo intval($prize_increment[$j]+1)."<=".intval($added_challenge_prize)." && ".intval($added_challenge_prize)."<=".intval($prize_increment[$j+1])."<br>";               
                        
                        $prize_purse=$prize_increment[$j+1];
                        
                        if(@array_key_exists($assignagency,$temp_agency_data[$prize_purse]))
                        {
                            $temp_agency_data[$prize_purse][$assignagency]++;
                        }    
                        else{
                            $temp_agency_data[$prize_purse][$assignagency]=1;
                        }              
                                               
                    }
                                  
                               
                $j=$j+1;
                }
                              
                       
            }
            
            ksort($temp_agency_data); 
            foreach($temp_agency_data as $prizerange => $agencies)
            {
                
                $newprize=$prizerange-500000;
                foreach($agencies as $agencyname=>$challengecnt)
                {
                    $temp_agency_data_sorted[str_replace("USD","$",money_format('%.0n', ($newprize+1)))."-".str_replace("USD","$",money_format('%.0n', $prizerange))][$agencyname]=$challengecnt;
                }
                
            }
            
            if(isset($temp_agency_data_first) && $temp_agency_data_first!="")
            {
                $temp_agency_data=array_merge($temp_agency_data_first,$temp_agency_data_sorted);
            }
            if(isset($temp_agency_data_last) && $temp_agency_data_last!="")
            {
                $temp_agency_data=array_merge($temp_agency_data_sorted,$temp_agency_data_last);
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
                       
    }        
                        
                                       
                        
                       
    $newarr = array();
    if($data=="by_agency")
    {   
           arsort($agency_data);
           $agency_array=array_slice($agency_data,0,$numb_of_agencies,true);
           $p=0;
           $is_chcnt_is_one=false;
           foreach($agency_array as $agencies => $challengecnt)
           {
                if($challengecnt>1)
                {
                    $json_agencies[]=array(
                                   "Category" => $agencies,
                                   "Agencies" => $challengecnt,
                                  "color"=>$color_array[$p]
                               );
                    
                }
                else{
                    $is_chcnt_is_one=true;
                }
                $p++;
           }
           if($is_chcnt_is_one==true)
           {
                 $jsonhostables[]=array("text" => "Agencies documenting one challenge or less are not reflected in this display.",
                               "x" => 10,
                          "y"=> 20,
                          "size"=>14,
                          "bold"=>false,
                           "color"=>"#FF0000");
           }
          

       }

    else{
        if(isset($agency_data))
        {
            foreach($agency_data as $key => $val) {
               
                arsort($val);
                
                $newagencyarr[$key] = $val;
               
            }
      
            foreach($newagencyarr as $cat=>$agencycnt)
            {
                
                $agency_array[$cat]=array_slice($agencycnt,0,$numb_of_agencies,true);
            }
        
    
            $p=0;
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
                               "Agencies" => $challengecnt_per_category,
                               "color"=>$color_array[$p]
                            );
               
                $p++;
            }
       
        }
    }
    if($data=="by_agency")
        {
            $categorytitle="Agencies";
        }
       else if($data=="challenge_type")
       {
            $categorytitle="Challenge Type";
       }
       else if($data=="prize_type")
       {
            $categorytitle="Prize Type";
       }
        else if($data=="solution_type")
       {
            $categorytitle="Solution Type";
       }
       else if($data=="solution_type")
       {
            $categorytitle="Solution Type";
       }
       else if($data=="cash_prize")
       {
            $categorytitle="Cash Value";
       }
       else if($data=="legal_authority")
       {
            $categorytitle="Legal Authority";
       }
       else if($data=="tot_numb_challenges")
       {
            $categorytitle="Fiscal Year";
       }
            
            $k=0;
            if(isset($agency_array))
            {
                $data_array=array();
                $data_array_temp1=array();
                $data_array_temp2=array();
                $grandtotal=0;
                if($data=="by_agency")
                {
                    $showagencytable="<table width='100%' class='table table-condensed table-bordered chart-table'>";
                    $showagencytable.="<tr><th><i title='Chart Color Indication' class='fa fa-pie-chart'></i></th><th width='80%'>Agencies</th><th align='left' width='20%'>Total</th></tr>";
                    $title_array=array('Agencies','Total');
                    foreach($agency_array as $agencyname => $challengecnt)
                    {
                        $termdata=get_term_by('name',  $agencyname, 'agency');
                        $parent_agency="";
                        if($termdata->parent!=0)
                        {
                            $parent_agency_data=get_term_by('id', $termdata->parent, 'agency');
                            $parent_agency=$parent_agency_data->name;
                                               
                        }
                                 
                        $showagencytable.="<tr><td BGCOLOR=".$color_array[$k]."></td><td alight='left' width='80%'>".$agencyname;
                        if($parent_agency!="")
                        {
                            $showagencytable.=" - <b>Parent: </b>".$parent_agency;
                        }
                        $showagencytable.="</td><td alight='left' width='20%'>".$challengecnt."</td></tr>";
                        if($parent_agency!="")
                        {
                            $dataarray[$agencyname." Parent:".$parent_agency]=$challengecnt;
                        }
                        else{
                           $dataarray[$agencyname]=$challengecnt;
                        }
                        $grandtotal+=$challengecnt;
                        $k++;       
                    }
                    $showagencytable.="<tr class='active'><td colspan='2' style='padding-right:10px;' align='right'><b>Total: </b></td><td><b>".$grandtotal."</b></td></tr>";
                    $dataarray["Final Total"]=$grandtotal;
                    $arr_param=array('csv_export'=>true);
                
                    $redirect_link=add_query_arg($arr_param,get_site_url()."/all-charts/");
                    $showagencytable.="<tr><td colspan='3' align='right'><form name='csvform' class='csvform' method='post' action=".$redirect_link."><table><tr><td>";
                }
                else{

                    $showagencytable="<table width='100%' class='table table-condensed table-bordered chart-table'>";

                    $showagencytable.="<tr><th><i class='fa fa-pie-chart' title='Chart Color Indication'></i></th><th width='30%'>".$categorytitle."</th><th width='50%'>Agencies</th><th align='left' width='10%'>Challenge Count</th><th align='left' width='10%'>Total</th></tr>";
                    $title_array=array($categorytitle,'Agencies','Challenge Count','Total');

                    
                    foreach($agency_array as $category => $agencies)
                    {
                    
                        $showagencytable.="<tr><td BGCOLOR=".$color_array[$k]."></td><td valign='top' align='left' width='30%'  valign='top'>".$category."</td><td colspan='2'>";
                        
                        foreach($agencies as $agencyname => $challengecnt)
                        {
                            
                                $termdata=get_term_by('name',  $agencyname, 'agency');
                                $parent_agency="";
                                if($termdata->parent!=0)
                                {
                                               
                                    $parent_agency_data=get_term_by('id', $termdata->parent, 'agency');
                                    
                                    $parent_agency=$parent_agency_data->name;
                                               
                                }
                                 
                                $showagencytable.="<table width='100%' class='sub-table'><tr><td alight='left' width='50%'>".$agencyname;
                                if($parent_agency!="")
                                {
                                    $showagencytable.=" - <b>Parent: </b>".$parent_agency;
                                }
                                $showagencytable.="</td><td alight='left' width='10%'>".$challengecnt."</td></tr></table>";
                                if($parent_agency!="")
                                {
                                    $data_array_temp1[$category][$agencyname." Parent:".$parent_agency]=$challengecnt;
                                }
                                else{
                                    
                                   $data_array_temp1[$category][$agencyname]=$challengecnt;
                                }
                               
                        }        
                            $showagencytable.="</td>";
                            foreach($agency_array as $category_temp => $agencies)
                            {
                               if($category_temp==$category)
                               {
                                $challengecnt_per_category=0;
                                foreach($agencies as $agency_name => $challengecnt)
                                {
                                    
                                    $challengecnt_per_category+=$challengecnt;
                                }
                                $grandtotal+=$challengecnt_per_category;
                                $showagencytable.="<td valign='top'>".$challengecnt_per_category."</td>";
                                $data_array_temp2[$category]=$challengecnt_per_category;
                               }
                               
                            }
                        $showagencytable.="</tr>";
                        
                        $k++;
                    
                    }
                    $showagencytable.="<tr class='active'><td colspan='4' style='padding-right:10px;' align='right'><b>Total: </b></td><td><b>".$grandtotal."</b></td></tr>";
                    $arr_param=array('csv_export'=>true);
                
                    $redirect_link=add_query_arg($arr_param,get_site_url()."/all-charts/");
                    $showagencytable.="<tr><td colspan='5' align='right'><form name='csvform' class='csvform' method='post' action=".$redirect_link."><table><tr><td>";
                }
                 
            }
            
             
                $showagencytable.="<input type='hidden' name='numb_of_agencies' value='".$numb_of_agencies."'>";
                $showagencytable.="<input type='hidden' name='data' value='".$data."'>";
                
                if(isset($host) && $host!="")
                {
                    foreach($host as $hostplatform)
                    {
                        if($hostplatform=="external")
                        {
                            $showagencytable.="<input type='hidden' name='host[]' value='".$hostplatform."'>";
                        }
                        if($hostplatform=="internal")
                        {
                            $showagencytable.="<input type='hidden' name='host[]' value='".$hostplatform."'>";
                        }
                    }
                }
                $showagencytable.="<input type='hidden' name='daterange' value='".$daterange."'>";
                $showagencytable.="<input type='hidden' name='displayfor' value='topagency_pie'>";
                
               
               if($callfor=="csvexport")
               {
                    foreach($title_array as $titlearray)
                    {
                       $titlearray_temp[]=$titlearray;
                    }
                    if($data!="by_agency")
                    {
                        foreach($data_array_temp1 as $catname=>$agencynamearray)
                        {
                            
                         
                            foreach($data_array_temp2 as $category=>$totalcnt)
                            {
                               
                                $curTotal = "";    
                                foreach($agencynamearray as $agname=>$challengecnt)
                                {
                                    $display = true;
                                    
                                    if($category==$catname)
                                    {
                                        if($curTotal === $totalcnt)
                                            $display = false;
                                        $curTotal = $totalcnt;
                                        $dataarray[$catname][$agname][$challengecnt]=($display ? $totalcnt : "");
                                       
                                    }
                                  
                                  
                                }
                                 
                                
                            }
                           
                        }
                        
                    $dataarray["Final Total"][""][""]=$grandtotal;
                        
                    }
                    
               }
                $showagencytable.="</td></tr>";
                $showagencytable.="<tr><td><input type='submit' name='csv_export' value='Export to CSV'></td></tr></table></form></td></tr>";
                $showagencytable.="</table>";
    
    endif;
    if($callfor!="csvexport")
    {
        if(!isset($json_agencies) || $json_agencies=="")
           {
               ?>
               
                   jQuery( document ).ready(function() {
                       jQuery("#drawchart").html("Sorry! No data found.");
                   });
               
           <?php
           }
           else{
        ?>
           
            DrawAuthorityPieChart();
        
            function DrawAuthorityPieChart()
            {
                jQuery("#legenddiv").html("<?php echo $showagencytable;?>");
                var chart = AmCharts.makeChart("drawchart",{
                type    : "pie",
                titleField  : "Category",
                valueField  : "Agencies",
                labelText : "[[title]]: [[percents]]% ([[value]])",
                colorField : "color",
                dataProvider  : <?php echo json_encode( $json_agencies );?>,
                <?php
                    if($data=="by_agency")
                    {
                    ?>
                        fontSize : 9.5,
                        marginTop : 200,
    
                        
                    <?php
                    }
                    if($is_chcnt_is_one==true)
                    {
                        ?>
                        "titles": [
                        {
                                "text": "Agencies documenting one challenge or less are not reflected in this display.",
                                "size": 12,
                                "color": "#ff0000"
        
                                
                        }
                ],
                        <?php
                    }
                    ?>
                export: {
                    enabled: true,
                    "libs": {
                        "path": "https://amcharts.com/lib/3/plugins/export/libs/"
                    },
                     // "menu": ["JPG", "PNG", "pdf", "print"]
                      "menu": [ {
			    
				"label": "Download Chart",
                                "menu": ["JPG", "PNG", "pdf", "print"]
				} ]
                  }
                 
                
              });
               
            }
        
          
            
      <?php 
       }
    }
    else{
       
         header("Content-type: text/csv");
                header("Content-disposition: csv" . date("Y-m-d") . ".csv");
                header( "Content-disposition: filename=data.csv");
                header("Pragma: no-cache");
                header("Expires: 0");
               
                $output = fopen('php://output', 'w');
               fputcsv($output, $titlearray_temp);
                
                
                foreach($dataarray as $keyofkeyvalarray=>$keyvalarray)
                {
                    //$totalcnt=0;
                    if(is_array($keyvalarray))
                    {
                        foreach($keyvalarray as $keyofvalarray=>$valarray)
                        {
                            
                           if(is_array($valarray))
                            {
                                foreach($valarray as $total_key=>$total_val)
                                {
                                    $array_to_write=array($keyofkeyvalarray,$keyofvalarray,$total_key,$total_val);
                                }
                            }
                            else{
                                $array_to_write=array($keyofkeyvalarray,$keyofvalarray,$valarray);
                            }
                            
                            fputcsv($output, $array_to_write);
                            
                        }
                    }
                    else{
                        $array_to_write=array($keyofkeyvalarray,$keyvalarray);
                        fputcsv($output, $array_to_write);
                        
                    }
                    
                }
    }
    //$prize_array=array_slice($prize_array,0,$numb_of_challenges,true);
    exit;
    
  
}

function getPieChart($report_on,$host,$prizearray,$chart_data,$agencyname,$daterange,$callfor)
{
   
    //$color_array=array("#FF0F00", "#FF6600", "#FF9E01", "#FCD202", "#F8FF01", "#B0DE09", "#04D215", "#0D8ECF", "#77BFC7", "#2A0CD0", "#8A0CCF", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25");
//$color_array=array("#2EC4B6", "#C0C0C0", "#CEE0DC", "#B9CFD4", "#FCA311", "#A9BCD0", "#58A4B0", "#77BFC7", "#EEF5DB", "#A9A9F5", "#F0B67F", "#D6D1B1", "#E5E6E4", "#CFD2CD", "#999999", "#847577", "#FBFBF2", "#97F9F9", "#A4DEF9", "#C1E0F7", "#C59FC9");
    if(isset($prizearray) && $prizearray!="")
    {
        foreach($prizearray as $challengeids => $prizes)
        {
            $challengeidsarray[]=$challengeids;
        }
    }
    if($report_on=="agencies")
    {
        $args = array(
                    'posts_per_page' => -1,
                    'post_type' => 'challenge',
                    'post_status' =>  'publish');
    }
    else{
         $args = array(
                    'posts_per_page' => -1,
                    'post_type' => 'challenge',
                    'post_status' =>  'publish');
                   // 'post__in' => $challengeidsarray);
    }
    
    if($daterange!="")
    {
        
        $date_array=explode("||",$daterange);
        
        $start_timestamp=mysql2date( 'U', $date_array[0]);
        $end_timestamp=mysql2date( 'U', $date_array[1]);
         $sort_array[] = array(
				'key' => 'submission_end',
				'value'=> $start_timestamp,
				'compare' => '>='
                                );
                             
        $sort_array[] = array(
				'key' => 'submission_end',
				'value'=> $end_timestamp,
				'compare' => '<='
                                );
         
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
        $sort_array[] = array(
                            'key' => 'where_host',
                            'value' => $hostvalue
                        );
        
       
       
           
    }
   if(isset($sort_array) && $sort_array!="")
   {
        $meta_args=array('meta_query' => $sort_array);
        $args=array_merge($args,$meta_args);
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
                $tax_args=array('tax_query' => array(
                                    array(
                                            'taxonomy' => 'agency',
                                            'terms'    => $agencyname_array,
                                            'field'    => 'slug',
                                            'operator' => 'IN'
                                            
                                )
                            ));
           }
           else{
            $tax_args=array('tax_query' => array(
                                    array(
                                            'taxonomy' => 'agency',
                                            'terms'    => $agencyname,
                                            'field'    => 'slug',
                                            'operator' => 'IN'
                                            
                                )
                            ));
           }
                
        $args=array_merge($args,$tax_args);             
    } 
   
 
    $challenge_query = new WP_Query( $args );
  
    if($challenge_query->have_posts() ):
    
                 if($chart_data=="cash_prize")
                {
                  $j=0;
                    for($i=0; $i<=5000000; $i=$i+500000)
                    {
                         $prize_increment[]=$i;
                         
                       
                    }
                   
                   
                }
         $color_array=array();      
         while( $challenge_query->have_posts() ) : $challenge_query->the_post();
                $new_color="#".random_color();
                array_push($color_array,$new_color);
                $challenge_title=get_the_title( get_the_ID() );
                if($chart_data=="by_agency")
                {
                    $terms = wp_get_post_terms(get_the_ID(), 'agency');
                    foreach($terms as $term)
                    {
                        $assignagency=$term->name;
                    }
                    $category = $assignagency;
                   
                }
                if($chart_data=="challenge_type")
                {
                    $category = get_field('category',get_the_ID());
                   
                    if($category=="ScientificEngineering")
                    {
                        $category="Scientific / Engineering";
                    }
                    if($category=="SoftwareApps")
                    {
                        $category="Software / Apps";
                    }
                   
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
                if($chart_data=="tot_numb_challenges")
                {
                   // $category = $challenge_title;
                    $category = get_field('fiscal_year',get_the_ID());
                    if(!isset($category) || $category=="" || $category==":")
                    {
                        $category="No FY";
                    }
                }
              
            
                    if($chart_data=="cash_prize")
                    {
                        $added_challenge_prize=0;
                         
                        foreach ($the_prizes as $this_prize)
                        {
                            $challenge_prize = intval($this_prize['the_cash_amount']);
                            $added_challenge_prize+=$challenge_prize;
                            $prize_array_for_challenge[get_the_ID()]=$added_challenge_prize;
                        }
                        
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
                                        
                                    if($report_on=="agencies" && $agencyname=="all" && $chart_data!="by_agency")
                                    {
                                        
                                        $terms = wp_get_post_terms(get_the_ID(), 'agency');
                                        foreach($terms as $term)
                                        {
                                               $assignagency=$term->name;
                                               $challenge_title_array[ltrim($category)][$assignagency][]=$challenge_title;
                                               
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
                                        if($cat=="ScientificEngineering")
                                        {
                                            $cat="Scientific / Engineering";
                                        }
                                        if($cat=="SoftwareApps")
                                        {
                                            $cat="Software / Apps";
                                        }
                                        if(isset($number_of_challenges[ltrim($cat)]))
                                       {
                                           $number_of_challenges[ltrim($cat)]++;
                                                 
                                       }
                                       else{
                                           $number_of_challenges[ltrim($cat)]=1;
                                               
                                       }
                                       if($report_on=="agencies" && $agencyname=="all" && $chart_data!="by_agency")
                                        {
                                            
                                            $terms = wp_get_post_terms(get_the_ID(), 'agency');
                                            foreach($terms as $term)
                                            {
                                                   $assignagency=$term->name;
                                                   $challenge_title_array[ltrim($cat)][$assignagency][]=$challenge_title;
                                                   
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
        
        if($chart_data=="tot_numb_challenges")
        {
		  
                foreach($challenge_title_array as $cat=>$chdata)
                {
                    if($cat=="No FY")
                    {
                        $chtitletemp1[$cat]=$chdata;
                    }
                    else{
                        $chtitletemp2[$cat]=$chdata;
                    }
                    
                }
                if(isset($chtitletemp2) && $chtitletemp2!="")
                {
                    ksort($chtitletemp2);
		    if(!isset($chtitletemp1) || empty($chtitletemp1))
		    {
			$challenge_title_array=$chtitletemp2;
		    }
		    else
		    {
                    	$challenge_title_array=array_merge_recursive($chtitletemp1,$chtitletemp2);
		    }
                }
                else{
                    $challenge_title_array=$chtitletemp1;
                }
                
                
            
            
        }
        if($chart_data=="cash_prize")
        {
           
            foreach ($prize_array_for_challenge as $challengeid=>$added_challenge_prize)
            {
                          
                $j=0;
                $challenge_title=get_the_title($challengeid);
                if(intval($added_challenge_prize)==0)
                {
                    if($report_on=="agencies" && $agencyname=="all")
                    {
                        $terms = wp_get_post_terms($challengeid, 'agency');
                        foreach($terms as $term)
                        {
                            $assignagency=$term->name;
                            //$challenge_title_array["No Cash Value"][$assignagency][]=$challenge_title;
                              $challenge_title_array_first["No Cash Value"][$assignagency][]=$challenge_title;                         
                        }
                        $number_of_challenges["No Cash Value"]++;
                    }
                    else{
                        $number_of_challenges["No Cash Value"]++;
                        $challenge_title_array_first["No Cash Value"][]=$challenge_title;
                    }    
                            
                }
                if(intval($added_challenge_prize) >=5000000)
                {
                    if($report_on=="agencies" && $agencyname=="all")
                    {
                        $terms = wp_get_post_terms($challengeid, 'agency');
                        foreach($terms as $term)
                        {
                            $assignagency=$term->name;
                            //$challenge_title_array["5000000 >"][$assignagency][]=$challenge_title;
                            $challenge_title_array_last["$5,000,000 >"][$assignagency][]=$challenge_title;
                                                       
                        }
                        $number_of_challenges["$5,000,000 >"]++;
                    }
                    else{
                           
                            $number_of_challenges["$5,000,000 >"]++;
                            $challenge_title_array_last["$5,000,000 >"][]=$challenge_title;
                                    
                        }
                }
                for($i=1; $i<=5000000; $i=$i+500000)
                {
                               
                    if(intval($prize_increment[$j]+1)<=intval($added_challenge_prize) && intval($added_challenge_prize)<=intval($prize_increment[$j+1]))
                    {
                        
                      
                        
                        $category[]=str_replace("USD","$",money_format('%.0n', $prize_increment[$j]+1))."-".str_replace("USD","$",money_format('%.0n', $prize_increment[$j+1]));
                        $number_of_challenges[str_replace("USD","$",money_format('%.0n', $prize_increment[$j]+1))."-".str_replace("USD","$",money_format('%.0n', $prize_increment[$j+1]))]++;
                                    
                        if($report_on=="agencies" && $agencyname=="all")
                        {
                            $terms = wp_get_post_terms($challengeid, 'agency');
                            foreach($terms as $term)
                            {
                                $assignagency=$term->name;
                                $challenge_title_array_temp[$prize_increment[$j+1]][$assignagency][]=$challenge_title;
                            }
                        }
                        else{
                          
                                $challenge_title_array_temp[$prize_increment[$j+1]][]=$challenge_title;
                                
                                break;
                           
                        }    
                         
                                         
                                        
                    }
                                                                        
                   
                                    
                $j=$j+1;
                }
            }
        
           if($agencyname!="all" && isset($challenge_title_array_temp))
            {
                ksort($challenge_title_array_temp);
                   
                 foreach($challenge_title_array_temp as $prizerange => $challenges)
                 {
                     $newprize=$prizerange-500000;
                     $challenge_title_array[str_replace("USD","$",money_format('%.0n', $newprize+1))."-".str_replace("USD","$",money_format('%.0n', $prizerange))]=$challenges;
                    
                 }
             }
             else{
                ksort($challenge_title_array_temp);
                   
                 foreach($challenge_title_array_temp as $prizerange => $agencies)
                 {
                    $newprize=$prizerange-500000;
                    foreach($agencies as $agencynames=>$challenges)
                    {
                        foreach($challenges as $chtitle)
                        {
                            $challenge_title_array[str_replace("USD","$",money_format('%.0n', $newprize+1))."-".str_replace("USD","$",money_format('%.0n', $prizerange))][$agencynames][]=$chtitle;
                        }
                        
                    }
                     
                    
                }
             }
             if(!isset($challenge_title_array))
             {
                $challenge_title_array=array();
             }
             
            if(isset($challenge_title_array_first) && $challenge_title_array_first!="")
            {
                $challenge_title_array=@array_merge_recursive($challenge_title_array_first,$challenge_title_array);
            }
           
            if(isset($challenge_title_array_last) && $challenge_title_array_last!="")
            {
                $challenge_title_array=@array_merge_recursive($challenge_title_array,$challenge_title_array_last);
            }
              
        }                
       
      
       
      // $challenge_title_array=@array_merge($challenge_title_array_first,$challenge_title_array_sorted,$challenge_title_array_last);
  
        $k=0;
        $p=0;
        
        foreach($number_of_challenges as $category_name => $numb_of_challenges)
        {
            if($agencyname=="all" && $chart_data=="by_agency")
            {
                if($numb_of_challenges>1)
                {
                     $jsoncategory[] = array(
                    "Category" => $category_name,
                   "Challenge_category_Cnt" => $numb_of_challenges,
                   "color"=>$color_array[$p]
                );
                   $p++;
                }
                $jsonhostables[]=array("text" => "Agencies documenting one challenge or less are not reflected in this display.",
                               "x" => 20,
                          "y"=> 20,
                          "bold"=>false,
                          "size"=>14,
                           "color"=>"#FF0000");
            }
            else{
                 $jsoncategory[] = array(
                    "Category" => $category_name,
                   "Challenge_category_Cnt" => $numb_of_challenges,
                   "color"=>$color_array[$p]
                );
                   $p++;
                  
            }
            
                 
                
             
        }
        if($chart_data=="by_agency")
        {
            $categorytitle="Agencies";
        }
       else if($chart_data=="challenge_type")
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
            $categorytitle="Legal Authority";
       }
       else if($chart_data=="tot_numb_challenges")
       {
            $categorytitle="Fiscal Year";
       }

        if($report_on=="agencies" && $agencyname=="all" && $chart_data!="by_agency")
        {
            $showtable="<table width='100%' class='table table-condensed table-bordered chart-table'>";
            $data_array=array();
            $finaltotal=0;
            $dataarray_temp1=array();
            $dataarray_temp2=array();
            
            
                $showtable.="<tr><th><i title='Chart Color Indication' class='fa fa-pie-chart'></i></th><th align='left' width='20%'>".$categorytitle."</th><th width='30%'>Agencies</th><th width='40%'>Challenge Name</th><th style='text-align:center' width='10%'>Total</th></tr>";
                $title_array=array($categorytitle,'Agencies','Challenge Name','Total');
                foreach($challenge_title_array as $cat=>$agencytitle )
                {
                    $chcnt=0;
                    $challenge_cat="";
                    if(gettype($cat)=="string")
                    {
                        $challenge_cat.=$cat;
                    }
                    else{
                        $challenge_cat.=$cat[0];
                    }
                     $index = array_search($challenge_cat, array_column($jsoncategory, 'Category'));
                     $bgcolor=$color_array[$index];
                    
                    
                    $showtable.="<tr><td style='background-color:".$bgcolor."'></td><td valign='top' align='left' width='20%'>".$challenge_cat."</td><td colspan='2'>";
                    foreach($agencytitle as $agencies => $challenges)
                    {
                        $showtable.="<table class='sub-table' width='100%'><tr><td alight='left' width='45%' valign='top'>".$agencies."</td><td colspan='1'><ul class='chart-table-list'>";
                        foreach($challenges as $chnames)
                        {
                             $chcnt++; 
                            $showtable.="<li>".$chnames."</li>";
                            $dataarray_temp1[$challenge_cat][$agencies][]=$chnames;
                        }
                        $showtable.="</ul></td></tr></table>";
                    }
                    $dataarray_temp2[$challenge_cat]=$chcnt;
                    $finaltotal+=$chcnt;
                    $showtable.="</td><td width='10%' style='text-align:center' valign='top'>".$chcnt."</td></tr>";
                
                }
                $showtable.="<tr class='active'><td colspan='4' align='right' style='padding-right:10px'><b>Final Total: </td><td style='text-align:center'>".$finaltotal."</td></tr>";
                if($callfor=="csvexport")
                {
                    foreach($title_array as $titlearray)
                    {
                       $titlearray_temp[]=$titlearray;
                    }
                   
                    foreach($dataarray_temp1 as $category=>$agencies)
                    {
                        foreach($dataarray_temp2 as $cat_temp=>$chcnt)
                        {
                            $curTotal = "";
                          $display = true;
                            foreach($agencies as $agnames=>$challenges)
                            {
                                
                                foreach($challenges as $chnames)
                                {
                                    
                                    
                                if($category==$cat_temp)
                                {
                                    if($curTotal === $chcnt)
                                        $display = false;
                                    $curTotal = $chcnt;
                                    $dataarray[$category][$agnames][$chnames]=($display ? $chcnt : "");
                                    //$showtable.="<input type='hidden' name='dataarray[".$category_name."][".$chname."]' value='".($display ? $numb_of_challenges : "")."'>";
                                }
                                }
                                
                            }
                        }
                        
                    }
                   
                   $dataarray["Final Total"][""][""]=$finaltotal;
                }
                $arr_param=array('csv_export'=>true);
                $redirect_link=add_query_arg($arr_param,get_site_url()."/all-charts/");
                $showtable.="<tr><td colspan='5' align='right'><form name='csvform' class='csvform' method='post' action=".$redirect_link."><table><tr><td>";
               
           
              
                $showtable.="<input type='hidden' name='report_on' value='".$report_on."'>";
                if(isset($host) && $host!="")
                {
                    foreach($host as $hostplatform)
                    {
                        if($hostplatform=="external")
                        {
                            $showtable.="<input type='hidden' name='host[]' value='".$hostplatform."'>";
                        }
                        if($hostplatform=="internal")
                        {
                            $showtable.="<input type='hidden' name='host[]' value='".$hostplatform."'>";
                        }
                    }
                }
                
                
                $showtable.="<input type='hidden' name='chart_data' value='".$chart_data."'>";
                $showtable.="<input type='hidden' name='agencyname' value='".$agencyname."'>";
                $showtable.="<input type='hidden' name='daterange' value='".$daterange."'>";
                $showtable.="<input type='hidden' name='displayfor' value='loaddata_pie'>";
                
              
              
                $showtable.="</td></tr>";
                $showtable.="<tr><td><input type='submit' name='csv_export' value='Export to CSV'></td></tr></table></form></td></tr>";
                $showtable.="</table>";  
               
           
        }
        else{
          
          
                $showtable="<table width='100%'class='table table-condensed table-bordered chart-table'>";
                $showtable.="<tr><th><i title='Chart Color Indication' class='fa fa-pie-chart'></i></th><th>".$categorytitle."</th><th>Challenge Name</td><th>Total</th></tr>";
                $title_array=array($categorytitle,'Challenge Name','Total');
                $data_array_temp1=array();
                $data_array_temp2=array();
                $data_array=array();
                
                foreach($challenge_title_array as $category_name => $challengetitle)
                {
                    $grandtotal=0;
                    $index = recursive_array_search($category_name, array_column($jsoncategory, 'Category'));
                    if($index>=0)
                    {
                        $bgcolor=$color_array[$index];
                    }
                    else{
                        $bgcolor="";
                    }
                    
                   
                        
                    $showtable.="<tr><td BGCOLOR=".$bgcolor."></td><td valign='top'>".$category_name."</td><td>";
                    
                    foreach($challengetitle as $challengename)
                    {
                        
                        $showtable.="<table><tr><td>".$challengename."</td></tr></table>";
                        $data_array_temp1[$category_name][]=html_entity_decode($challengename);
                    }
                    $showtable.="</td>";
                    foreach($number_of_challenges as $chcatname => $numb_of_challenges)
                    {
                        $grandtotal+=$numb_of_challenges;
                        if($chcatname==$category_name)
                        {
                            $showtable.="<td valign='top'>".$numb_of_challenges."</td>";
                            $data_array_temp2[$category_name]=$numb_of_challenges;
                        }
                       
                    }
                    $showtable.="</tr>";
                    
                    $assigncolor[]=$color_array[$k];
                     $k++;
                   
                }
                $showtable.="<tr class='active'><td colspan='3' style='padding-right:10px;' align='right'><b>Total: </b></td><td><b>".$grandtotal."</b></td></tr>";
                
                
                $arr_param=array('csv_export'=>true);
                
                $redirect_link=add_query_arg($arr_param,get_site_url()."/all-charts/");
                $showtable.="<tr><td colspan='4' align='right'><form name='csvform' class='csvform' method='post' action=".$redirect_link."><table><tr><td>";
                $showtable.="<input type='hidden' name='report_on' value='".$report_on."'>";
                if(isset($host) && $host!="")
                {
                    foreach($host as $hostplatform)
                    {
                        if($hostplatform=="external")
                        {
                            $showtable.="<input type='hidden' name='host[]' value='".$hostplatform."'>";
                        }
                        if($hostplatform=="internal")
                        {
                            $showtable.="<input type='hidden' name='host[]' value='".$hostplatform."'>";
                        }
                    }
                }
                
                //$showtable.="<input type='hidden' name='prizearray' value='".$prizearray."'>";
                $showtable.="<input type='hidden' name='chart_data' value='".$chart_data."'>";
                $showtable.="<input type='hidden' name='agencyname' value='".$agencyname."'>";
                $showtable.="<input type='hidden' name='daterange' value='".$daterange."'>";
                $showtable.="<input type='hidden' name='displayfor' value='loaddata_pie'>";
                if($callfor=="csvexport")
                {
                    foreach($title_array as $titlearray)
                    {
                        $titlearray_temp[]=$titlearray;
                    }
                    
                    foreach($data_array_temp1 as $category_name=>$challengename)
                    {
                        foreach($data_array_temp2 as $category_name_temp=>$numb_of_challenges)
                        {
                            $curTotal = "";
                             $display = true;
                            foreach($challengename as $chname)
                            {
                               if($category_name==$category_name_temp)
                                {
                                    if($curTotal === $numb_of_challenges)
                                            $display = false;
                                    $curTotal = $numb_of_challenges;
                                    $dataarray[$category_name][$chname]=($display ? $numb_of_challenges : "");
                                    //$showtable.="<input type='hidden' name='dataarray[".$category_name."][".$chname."]' value='".($display ? $numb_of_challenges : "")."'>";
                                }
                            }
                        }
                        
                    }
                   
                    $dataarray["Final Total"][""]=$grandtotal;
                    
                }
               
                $showtable.="</td></tr>";
                $showtable.="<tr><td><input type='submit' name='csv_export' value='Export to CSV'></td></tr></table></form></td></tr>";
                $showtable.="</table>";
           // }
        }
    endif;
if($callfor!="csvexport")
{
    
    
       
    if(!isset($jsoncategory) || $jsoncategory=="")
    {
            ?>
            
                jQuery( document ).ready(function() {
                    jQuery("#drawchart").html("Sorry! No data found.");
                });
             
        <?php
        }
        else{
     ?>
     
        var chart;
        DrawAuthorityPieChart();
        function DrawAuthorityPieChart()
        {
           jQuery("#legenddiv").html("<?php echo $showtable;?>");
           jQuery( "h1.entry-title" ).html("<span class='small'>Data Visualization Reports: <?php echo $agencyname;?><span>");
          
           //jQuery("#agencynamediv").html("<?php echo $agencyname;?>");
          // AmCharts.isReady = true;
           
           var chart = AmCharts.makeChart("drawchart",{
            type    : "pie",
            titleField  : "Category",
            valueField  : "Challenge_category_Cnt",
            labelText :"[[title]]: [[percents]]% ([[value]])",
            colorField : "color",
            dataProvider  : <?php echo json_encode( $jsoncategory );?>,
             <?php
            if($agencyname=="all" && $chart_data=="by_agency")
            {
            ?>
           
            fontSize: 9.5,
             "titles": [
		{
			"text": "Agencies documenting one challenge or less are not reflected in this display.",
			"size": 12,
                        "color": "#ff0000"

                        
		}
	],
            <?php
            }
            ?>
           
            export: {
                enabled: true,
                "libs": {
                    "path": "https://amcharts.com/lib/3/plugins/export/libs/"
                },
                  //"menu": ["JPG", "PNG", "pdf", "print"]
                  "menu": [ {
			    
				"label": "Download Chart",
                                "menu": ["JPG", "PNG", "pdf", "print"]
				} ]
              }
               
          });
           
        }
           
        
   <?php 
    }
}
   else{
      
        header("Content-type: text/csv");
        header("Content-disposition: csv" . date("Y-m-d") . ".csv");
        header( "Content-disposition: filename=data.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
               
        $output = fopen('php://output', 'w');
        fputcsv($output, $titlearray_temp);
                
        foreach($dataarray as $keyofkeyvalarray=>$keyvalarray)
        {
            foreach($keyvalarray as $keyofvalarray=>$valarray)
            {
               if(is_array($valarray))
                {
                     
                    foreach($valarray as $total_key=>$total_val)
                    {
                        $array_to_write=array($keyofkeyvalarray,$keyofvalarray,$total_key,$total_val);
                        fputcsv($output, $array_to_write);
                        
                    }
                    
                }
                else{
                    $array_to_write=array($keyofkeyvalarray,$keyofvalarray,$valarray);
                    fputcsv($output, $array_to_write);
                }
                    
               // fputcsv($output, $array_to_write);
                        
            }
                    
        }
        
    }
}
function recursive_array_search($needle,$haystack) {
    foreach($haystack as $key=>$value) {
        $current_key=$key;
        if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
            return $current_key;
        }
    }
    return "";
}

?>