<?php


add_action('shutdown', 'gather_line_chart_data');

function gettopagencies($numb_of_agencies,$chart_data,$host,$daterange,$range_selection,$callfor,$report_factor)
{
 
//$color_array=array("#2EC4B6", "#C0C0C0", "#CEE0DC", "#B9CFD4", "#FCA311", "#A9BCD0", "#58A4B0", "#77BFC7", "#EEF5DB", "#A9A9F5", "#F0B67F", "#D6D1B1", "#E5E6E4", "#CFD2CD", "#999999", "#847577", "#FBFBF2", "#97F9F9", "#A4DEF9", "#C1E0F7", "#C59FC9");
 
    $allchallenges = array(
	'posts_per_page' => -1,
	'post_type'	=> 'challenge',
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
           
            if($range_selection=="month")
                {
                    
                    $submission_end_unix=get_field('submission_end',get_the_ID());
                    $submission_end_temp= verify_challenge_datetime_view($submission_end_unix,'M d y');
                    $month_year_array=explode(" ",$submission_end_temp);
                    $submission_end_temp=$month_year_array[0]." 01 ".$month_year_array[2];
                    $submission_end=strtotime($submission_end_temp);
                    $all_fiscal_year[]=$submission_end;
                    $fiscalyearval=$submission_end;
                    //$submission_end=$submission_end_unix;
                    
                }
                else{
                    $fiscalyearval=get_field('fiscal_year',get_the_ID());
                    if($fiscalyearval=="")
                    {
                        $all_fiscal_year[]="No FY";
                    }
                    else
                    {
                        $all_fiscal_year[]=$fiscalyearval;
                    }
                }
            
            $terms = wp_get_post_terms(get_the_ID(), 'agency');
            foreach($terms as $term)
            {
                $assignagency=$term->name;
                if($fiscalyearval=="")
                {
                    $fiscalyearval="No FY";
                }
                if(isset($agency_data[$assignagency][$fiscalyearval]))
                {
                    $agency_data[$assignagency][$fiscalyearval]++;
                    
                                           
                }
                else{
                    $agency_data[$assignagency][$fiscalyearval]=1;
                    
                }
                                       
                $challenge_per_agencies[$assignagency][$fiscalyearval][]= get_the_title(get_the_ID());
            } 
        endwhile;
       
    endif;
   
    arsort($agency_data);
  
    $agency_array_temp=array_slice($agency_data,0,$numb_of_agencies,true);
   // print_r($agency_array_temp);
     $all_fiscal_year_unique= array_unique($all_fiscal_year);
        foreach($all_fiscal_year_unique as $fiscalyear)
        {
            foreach($agency_array_temp as $agencynames=>$fiscalyears)
            {
                
                    if(array_key_exists($fiscalyear,$fiscalyears))
                    {
                        foreach($fiscalyears as $year=>$chcnt)
                        {
                
                           $agency_array[$agencynames][$year]=$chcnt;
                           $number_of_challenges[$year][$agencynames]=$chcnt;
                            
                        }
                    }
                    else{
                        $agency_array[$agencynames][$fiscalyear]=0;
                        
                    }
               
            }
        }
        
    $c=0;
    
     ksort($number_of_challenges);
    $valueCount = 1;
    $masterArray = array();
    foreach($agency_array as $agencies => $fiscalyeardata)
    {
        if($range_selection!="month")
        {
            ksort($fiscalyeardata);
        }
        $positionCount = 0;
        $catforcolor[]=$agencies;
        $catarray[]= $agencies;
        foreach($fiscalyeardata as $year => $chcnt)
        {
            $masterArray[$positionCount]['Year'] = $year;
            $masterArray[$positionCount]['value' . $valueCount] = $chcnt;
            $positionCount++;
            
               
        }
        $valueCount++;
            
    }    
    
    
    $k=0;
    $showagencytable="<table width='100%' class='table table-condensed table-bordered chart-table'>";
    $showagencytable.="<tr><th><i class='fa fa-line-chart' title='Chart Color Indication'></i></th><th width='60%'>Agencies</th><th width='20%'>Fiscal Year</th><th align='left' width='20%'>Total</th></tr>";
    $title_array=array('Agencies','Total');
    foreach($agency_array as $agencyname => $fiscalyeardata)
    {
        ksort($fiscalyeardata);
        $termdata=get_term_by('name',  $agencyname, 'agency');
        $parent_agency="";
        if($termdata->parent!=0)
        {
            $parent_agency_data=get_term_by('id', $termdata->parent, 'agency');
            $parent_agency=$parent_agency_data->name;
                                               
        }
        if($parent_agency!="")
        {
            $agencyname.=" - <b>Parent: </b>".$parent_agency;
        }
        $showagencytable.="<tr><td BGCOLOR=".$color_array[$k]."></td><td alight='left' width='60%'>".$agencyname."</td><td colspan='2'><table width='100%'>";
        
        foreach($fiscalyeardata as $year => $chcnt)
        {
        
            $showagencytable.="<tr><td  width='20%' alight='left'>".$year."</td><td alight='left' width='20%'>".$chcnt."</td></tr>";
            if($parent_agency!="")
            {
                $dataarray[$agencyname." Parent:".$parent_agency][$year]=$chcnt;
            }
            else{
                $dataarray[$agencyname][$year]=$chcnt;
            }
            $grandtotal+=$chcnt;
        }
        $showagencytable.="</table></td></tr>";
        $k++;
       
    }
    $showagencytable.="<tr class='active'><td colspan='3' style='padding-right:10px;' align='right'><b>Total: </b></td><td><b>".$grandtotal."</b></td></tr>";
    $dataarray["Final Total"][""]=$grandtotal;
    $arr_param=array('csv_export'=>true);
                
    $redirect_link=add_query_arg($arr_param,get_site_url()."/all-charts/");
    $showagencytable.="<tr><td colspan='4' align='right'><form name='csvform' class='csvform' method='post' action=".$redirect_link."><table><tr><td>";
    $showagencytable.="<input type='hidden' name='numb_of_agencies' value='".$numb_of_agencies."'>";
  
                
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
    $showagencytable.="<input type='hidden' name='chart_data' value='".$chart_data."'>";
    $showagencytable.="<input type='hidden' name='agencyname' value='".$agencyname."'>";
    $showagencytable.="<input type='hidden' name='daterange' value='".$daterange."'>";
    $showagencytable.="<input type='hidden' name='range_selection' value='".$range_selection."'>";
    $showagencytable.="<input type='hidden' name='report_factor' value='data'>";
    $showagencytable.="<input type='hidden' name='displayfor' value='topagency_line'>";
            
    
    if($callfor=="csvexport")
    {
        foreach($title_array as $titlearray)
        {
            $titlearray_temp[]=$titlearray;
        }
                  
    }
           
           
    $showagencytable.="</td></tr>";
    $showagencytable.="<tr><td><input type='submit' name='csv_export' value='Export to CSV'></td></tr></table></form></td></tr>";
    $showagencytable.="</table>";
    
    if(isset($number_of_challenges))
    {
        $showtimetable="<table width='100%' class='table table-condensed table-bordered chart-table'>";
        $showtimetable.="<tr><th width='30%'>Fiscal Year</th><th width='40%'>Agecnies</th><th width='30%'>Challenge Count</th></tr>";
        $title_array=array('Fiscal Year',$categorytitle,'Challenge Count');
        $dataarray_time=array();
        $grandtotal=0;
        
        foreach($number_of_challenges as $fiscalyear=>$agenciesarray)
        {
            $showtimetable.="<tr><td valign='top' width='30%'>".$fiscalyear."</td><td colspan='2'>";
            foreach($agenciesarray as $agencynames=>$cnt)
            {
                $grandtotal+=$cnt;
                $index=array_search($agencynames,$catarray);
                $bgcolor=$color_array[$index];
                $dataarray_time[$fiscalyear][$agencynames]=$cnt;
                $showtimetable.="<table width='100%' class='sub-table'><tr><td width='40%'>".$agencynames."</td><td width='30%'>".$cnt."</td></tr></table>";
            }
            $showtimetable.="</td></tr>";
        }
        $showtimetable.="<tr class='active'><td colspan='2' style='padding-right:10px;' align='right'><b>Total: </b></td><td><b>".$grandtotal."</b></td></tr>";
                    
        $arr_param=array('csv_export'=>true);
        $redirect_link=add_query_arg($arr_param,get_site_url()."/all-charts/");
        $showtimetable.="<tr><td colspan='4' align='right'><form name='csvform' class='csvform' method='post' action=".$redirect_link."><table><tr><td>";
        $showtimetable.="<input type='hidden' name='report_on' value='".$report_on."'>";
        if(isset($host) && $host!="")
        {
            foreach($host as $hostplatform)
            {
                if($hostplatform=="external")
                {
                    $showtimetable.="<input type='hidden' name='host[]' value='".$hostplatform."'>";
                }
                if($hostplatform=="internal")
                {
                    $showtimetable.="<input type='hidden' name='host[]' value='".$hostplatform."'>";
                }
            }
        }
                
        $showtimetable.="<input type='hidden' name='numb_of_agencies' value='".$numb_of_agencies."'>";
        $showtimetable.="<input type='hidden' name='chart_data' value='".$chart_data."'>";
        $showtimetable.="<input type='hidden' name='agencyname' value='".$agencyname."'>";
        $showtimetable.="<input type='hidden' name='daterange' value='".$daterange."'>";
        $showtimetable.="<input type='hidden' name='range_selection' value='".$range_selection."'>";
        $showtimetable.="<input type='hidden' name='report_factor' value='time'>";
        $showtimetable.="<input type='hidden' name='displayfor' value='topagency_line'>";
                
               
               if($callfor=="csvexport")
               {
                    foreach($title_array as $titlearray)
                    {
                       $titlearray_temp_time[]=$titlearray;
                    }
              
                    
                    $dataarray_time["Final Total"][""]=$grandtotal;
                }
                
              
               
                $showtimetable.="</td></tr>";
                $showtimetable.="<tr><td><input type='submit' name='csv_export' value='Export to CSV'></td></tr></table></form></td></tr></table>";
    }
           
if($callfor!="csvexport")
{   

     if(empty($masterArray) || $masterArray=="")
        {
            ?>
            
                jQuery( document ).ready(function() {
                    jQuery("#drawchart").html("Sorry! No data found.");
                });
             
        <?php
        }
        else{
            
                 ?>
       
          
                jQuery( document ).ready(function() {
                 jQuery("#legenddiv").html("<?php echo $showagencytable;?>");
                 });
                jQuery('#sortdata').on('change', function() {
                if (this.value=="data") {
                    jQuery("#legenddiv").html("<?php echo $showagencytable;?>");
                }
                else{
                   jQuery("#legenddiv").html("<?php echo $showtimetable;?>");
                }
              });
            DrawLineChart();
            function DrawLineChart()
            {
                jQuery("#filter_report_on").show();
                var chartLineData=<?php echo json_encode( $masterArray );?>;
                    var chart = AmCharts.makeChart("drawchart",{
                    type    : "serial",
                    categoryField  : "Year",
                    dataProvider  : chartLineData,
                    marginTop : 50,
                    "chartScrollbar" : {
                        "autoGridCount" : true,
                    },
                    "graphs": [
                    <?php
                    $k=0;
                    for($i=1; $i<$valueCount; $i++)
                    {
                        
                        ?>
                        {
                            "type" : "line",
                            "valueField" : "value<?php echo $i; ?>",
                            "lineColor" : "<?php echo $color_array[$k];?>",
                            "bullet" : "round",
                            "balloonText" : "<?php echo $catarray[$k];?>:<b>[[value]]</b>",
                            "bulletBorderColor" : "#FFFFFF",
                            "bulletBorderThickness" : 2,
                            "lineThickness" : 2,
                            "lineAlpha" : 0.5,
                        
                        },
                        
                        <?php
                        $k++;
                    }
                    ?>
                       
                    ],
                    
                    export: {
                            enabled: true,
                                "libs": {
                                    "path": "https://amcharts.com/lib/3/plugins/export/libs/"
                                },
                                //  "menu": ["JPG", "PNG", "pdf", "print"]
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
    
    if($report_factor=="time")
    {
        fputcsv($output, $titlearray_temp_time);
        
        foreach($dataarray_time as $keyofkeyvalarray=>$keyvalarray)
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
    }
    else{
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
                        }
                    }
                    else{
                        $array_to_write=array($keyofkeyvalarray,$keyofvalarray,$valarray);
                    }
                                
                    fputcsv($output, $array_to_write);
                                
                }
                            
            }
        
        
    }
    
                
   
}
}
function gather_line_chart_data()
{
   
  
    $host="";
    $report_on="";
    $prizearray=array();
    
    setlocale(LC_MONETARY, 'en_US');
    
    if(isset($_POST['chart_type']) && $_POST['chart_type']=="line")
    {
        if(isset($_POST['display_selection']) && $_POST['display_selection']!="")
        {
            //if($_POST['display_selection']=="all_challenges")
            if($_POST['display_selection']=="agency_selection" && $_POST['agency_selection_box']=="all")
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
       if(isset($_POST['range_selection']) && $_POST['range_selection']!="")
       {
            $range_selection=$_POST['range_selection'];
       }
        $callfor='loadchart';
       $report_factor="data";
       
       if((isset($_POST['number_of_agencies']) && $_POST['number_of_agencies']!="") && ($_POST['display_selection']=="top_agencies") && $report_on=="agencies")
        {
            $numb_of_agencies=$_POST['number_of_agencies'];
            if($_POST['chart_data']!="")
            {
                $callfor='loadchart';
                $range_selection='fiscal_year';
                
                gettopagencies($numb_of_agencies,$chart_data,$hostdata,$finaldate,$range_selection,$callfor,$report_factor);
            }    
        }
        else{
            getLineChart($report_on,$hostdata,$prizearray,$chart_data,$agencyname,$finaldate,$range_selection,$callfor,$report_factor);
        }
        
       
        
        
    }
   
   
}

function getLineChart($report_on,$host,$prizearray,$chart_data,$agencyname,$daterange,$range_selection,$callfor,$report_factor)
{
   
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
        $tax_args=array('tax_query' => array(
                                    array(
                                            'taxonomy' => 'agency',
                                            'terms'    => $agencyname,
                                            'field'    => 'slug',
                                            'operator' => 'IN'
                                            
                                )
                            ));
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
                if($range_selection=="month")
                {
                    
                    $submission_end_unix=get_field('submission_end',get_the_ID());
                    $submission_end_temp= verify_challenge_datetime_view($submission_end_unix,'M d y');
                    $month_year_array=explode(" ",$submission_end_temp);
                    $submission_end_temp=$month_year_array[0]." 01 ".$month_year_array[2];
                    $submission_end=strtotime($submission_end_temp);
                    $all_fiscal_year[]=$submission_end;
                    $fiscalyearval=$submission_end;
                    //$submission_end=$submission_end_unix;
                    
                }
                else{
                    $fiscalyearval=get_field('fiscal_year',get_the_ID());
                    if($fiscalyearval=="")
                    {
                        $all_fiscal_year[]="No FY";
                    }
                    else
                    {
                        $all_fiscal_year[]=$fiscalyearval;
                    }
                }
                
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
                    $category = get_field('fiscal_year',get_the_ID());
                    if(!isset($category) || $category=="" || $category=="0")
                    {
                        $category="No FY";
                    }
                }
                if($chart_data!="cash_prize")
                {
                    if(gettype($category)=="string")
                    { 
                        $category_array[]=ltrim($category);
                    }
                    else{
                        
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
                            $category_array[]=ltrim($cat);
                                                     
                        }
                    }
                }    
                 if($chart_data=="cash_prize")
                    {
                        
                        $added_challenge_prize=0;
                         if($fiscalyearval=="")
                        {
                            $fiscalyearval="No FY";
                        }
                            //if($fiscalyearval!="")
                            //{ 
                                foreach ($the_prizes as $this_prize)
                                {
                                    $challenge_prize = intval($this_prize['the_cash_amount']);
                                    $added_challenge_prize+=$challenge_prize;
                                    $prize_array_for_challenge[$fiscalyearval][get_the_ID()]=$added_challenge_prize;
                                    $category_array[]=$added_challenge_prize;
                                }
                            //}
                       
                    }
                    
                    else{
                        if($fiscalyearval=="")
                        {
                            $fiscalyearval="No FY";
                        }
                            //if($fiscalyearval!="")
                            //{
                                if(gettype($category)=="string")
                                {
                                    if($category=="ScientificEngineering")
                                    {
                                        $category="Scientific / Engineering";
                                    }
                                    if($category=="SoftwareApps")
                                    {
                                        $category="Software / Apps";
                                    }
                                    if(isset($number_of_challenges[$fiscalyearval][ltrim($category)]))
                                    {
                                        $number_of_challenges[$fiscalyearval][ltrim($category)]++;
                                                   
                                    }
                                    else{
                                        $number_of_challenges[$fiscalyearval][ltrim($category)]=1;
                                                
                                    }
                                        
                                    
                                    $challenge_title_array[$fiscalyearval][ltrim($category)][]=$challenge_title;
                                  
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
                                        if(isset($number_of_challenges[$fiscalyearval][ltrim($cat)]))
                                       {
                                           $number_of_challenges[$fiscalyearval][ltrim($cat)]++;
                                                 
                                       }
                                       else{
                                           $number_of_challenges[$fiscalyearval][ltrim($cat)]=1;
                                               
                                       }
                                      
                                          $challenge_title_array[$fiscalyearval][ltrim($cat)][]=$challenge_title;
                                       
                                    }
                    
                                }
                            //}
                        
                    }   
    endwhile;
    
    $unique_category=array_unique($category_array);
    
    if($chart_data=="tot_numb_challenges")
    {
        if($range_selection!="month")
        {
            /* Arrange year for data table */
            foreach($challenge_title_array as $year=>$chdata)
            {
                foreach($chdata as $catname=>$chtitle)
                {
                    foreach($chtitle as $challenges)
                    {
                        if($catname=="No FY")
                        {
                            $chtitletemp1[$catname][]=$challenges;
                        }
                        else{
                            $chtitletemp2[$catname][]=$challenges;
                        }
                    }
                }
               
                    
            }
          
            if(isset($chtitletemp2) && $chtitletemp2!="" && isset($chtitletemp1) && $chtitletemp1!="")
            {
               
                ksort($chtitletemp2);
                $challenge_title_array=array_merge_recursive($chtitletemp1,$chtitletemp2);
            }
            else{
                if(isset($chtitletemp1) && $chtitletemp1!="")
                {
                    $challenge_title_array=$chtitletemp1;
                }
                if(isset($chtitletemp2) && $chtitletemp2!="")
                {
                    $challenge_title_array=$chtitletemp2;
                }
                
            }
       
        /* Arrange year for chart */
            foreach($number_of_challenges as $fiscalyear=>$catarray)
            {
                foreach($catarray as $catname=>$numbofchallenge)
                {
                    if($catname=="No FY")
                    {
                        $chtitletemp1[$catname]=$numbofchallenge;
                    }
                    else{
                        $chtitletemp2[$catname]=$numbofchallenge;
                    }
                }
                
                    
            }
           if(isset($chtitletemp2) && $chtitletemp2!="" && isset($chtitletemp1) && $chtitletemp1!="")
            {
                ksort($chtitletemp2);
               $number_of_challenges=array_merge_recursive($chtitletemp1,$chtitletemp2);
            }
            else{
                if(isset($chtitletemp1) && $chtitletemp1!="")
                {
                    $number_of_challenges=$chtitletemp1;
                }
                if(isset($chtitletemp2) && $chtitletemp2!="")
                {
                    $number_of_challenges=$chtitletemp2;
                }
            }
                
            
        }
        else{
            
            foreach($number_of_challenges as $fiscalyear=>$catarray)
            {
                $totalcnt=0;
                foreach($catarray as $catname=>$numbofchallenge)
                {
                    $totalcnt=$totalcnt+$numbofchallenge;
                    $number_of_challenges_temp[$fiscalyear]=$totalcnt;
                   
                }
                
                    
            }
            foreach($number_of_challenges_temp as $chkey=>$chdata)
            {
                $number_of_challenges[$chkey]=$chdata;
                    
            }
           
        }
    }
        if($chart_data=="cash_prize")
        {
           
            foreach ($prize_array_for_challenge as $fiscalyear=>$challengeid)
            {
                   
                $j=0;
                foreach($challengeid as $chid=>$added_challenge_prize)
                {
                    $challenge_title=get_the_title($chid);
                    if(intval($added_challenge_prize)==0)
                    {
                        
                         $number_of_challenges_first["No Cash Value"][$fiscalyear]++;
                        
                        $challenge_title_array_first[$fiscalyear]["No Cash Value"]++;
                               
                          
                    }
                    if(intval($added_challenge_prize) >=5000000)
                    {
                        $number_of_challenges_last["$5,000,000 >"][$fiscalyear]++;
                        $challenge_title_array_last[$fiscalyear]["$5,000,000 >"]++;
                      
                    }
                
                
                    for($i=1; $i<=5000000; $i=$i+500000)
                    {
                         
                        if(intval($prize_increment[$j]+1)<=intval($added_challenge_prize) && intval($added_challenge_prize)<=intval($prize_increment[$j+1]))
                        {
                           
                           $number_of_challenges_temp[$prize_increment[$j+1]][$fiscalyear]++;
                                           
                            $challenge_title_array_temp[$fiscalyear][$prize_increment[$j+1]]++;
                            break;
                                
                               
                        }
                                                                            
                    $j=$j+1;
                    }
                }
                
                
               
                   
            }
        
            ksort($number_of_challenges_temp);
                foreach($number_of_challenges_temp as  $prizerange=>$fiscalyear)
                {
                    ksort($fiscalyear);
                    $newprize=$prizerange-500000;
                    foreach($fiscalyear as $year=>$chcnt)
                    {
                       
                        $newdata[str_replace("USD","$",money_format('%.0n', ($newprize+1)))."-".str_replace("USD","$",money_format('%.0n', $prizerange))][$year]=$chcnt;
                        $number_of_challenges[$year][str_replace("USD","$",money_format('%.0n', ($newprize+1)))."-".str_replace("USD","$",money_format('%.0n', $prizerange))]=$chcnt;
                        
                    }
                    
                }
         
            if(isset($number_of_challenges_first) && $number_of_challenges_first!="")
            {
                  $newdata=array_merge_recursive($number_of_challenges_first,$newdata);
            }
            if(isset($number_of_challenges_last) && $number_of_challenges_last!="")
            {
                  $newdata=array_merge_recursive($newdata,$number_of_challenges_last);
            }
           
           
            $all_fiscal_year_new=array_unique($all_fiscal_year);
            sort($all_fiscal_year_new);
           
          
           
            foreach($newdata as $category=>$fiscalyear)
            {
               
                if($range_selection=="month")
                {
                    
                        foreach($all_fiscal_year_new as $defaultyear)
                        {
                           
                            if(isset($fiscalyear[$defaultyear]))
                            {
                                $data_temp[$defaultyear][$category]=$fiscalyear[$defaultyear];
                            }
                            else{
                                $data_temp[$defaultyear][$category]=0;
                            }
                        }
                  
                    ksort($data_temp);
                   
                    foreach($data_temp as $month_year=>$category)
                    {
                        $sortedmonthyear=verify_challenge_datetime_view($month_year,'M y');
                        
                        foreach($category as $cat=>$chcnt)
                        {
                            $data[$cat][$sortedmonthyear]=$chcnt;
                        }
                        
                    }
                }
                else{
                    foreach($all_fiscal_year_new as $defaultyear)
                    {
                        if(isset($fiscalyear[$defaultyear]))
                        {
                            $data[$category][$defaultyear]=$fiscalyear[$defaultyear];
                        }
                        else{
                            $data[$category][$defaultyear]=0;
                        }
                    }
                }
                
                
            }
          
            if(isset($challenge_title_array_first) && $challenge_title_array_first!="")
            {
                
                if($range_selection=="month")
                {
                    $number_of_challenges=array_merge_recursive_distinct($challenge_title_array_first,$number_of_challenges);
                    ksort($number_of_challenges);
                }
                else{
                    $number_of_challenges=array_merge_recursive($challenge_title_array_first,$number_of_challenges);
                    ksort($number_of_challenges);
                }
                    
              
            }
             
            if(isset($challenge_title_array_last) && $challenge_title_array_last!="")
            {
                
                if($range_selection=="month")
                {
                    $number_of_challenges=array_merge_recursive_distinct($number_of_challenges,$challenge_title_array_last);
                    ksort($number_of_challenges);
                }
                else{
                    $number_of_challenges=array_merge_recursive($number_of_challenges,$challenge_title_array_last);
                    ksort($number_of_challenges);
                }   
             
            }
           
            
        }
        else{
            $k=0;
            $p=0;
            $lablerotation=0;
            
            if(isset($number_of_challenges))
            {
                
                if($range_selection=="month")
                {
                    if($chart_data=="tot_numb_challenges")
                    {
                        if(isset($number_of_challenges))
                        {
                        
                            foreach($number_of_challenges as $year_name => $cnt)
                            {
                                $monthdata[$year_name]= $cnt;
                                
                            }
                          ksort($monthdata);
                         
                          foreach($monthdata as $unixbasedmonthyeararray=>$chcnt)
                            {
                                
                               $sortedmonth=verify_challenge_datetime_view($unixbasedmonthyeararray,'M y');
                               $data[$sortedmonth]=$chcnt;
                                
                                
                            }
                        
                       // ksort($data);
                    
                        } 
                    }
                    else{
                        foreach($unique_category as $catname)
                        {
                            
                            foreach($number_of_challenges as $year_name => $category_name)
                            {
                               
                                    if(array_key_exists($catname,$category_name))
                                    {
                                       
                                        foreach($category_name as $category => $cnt)
                                        {
                                            $monthdata[$year_name][$category] = $cnt;
                                        }
                                    }    
                                    else{
                                
                                        $monthdata[$year_name][$catname] = 0;
                                    }
                                  
                            }
                        }
                        ksort($monthdata);
                        
                            foreach($monthdata as $unixbasedmonthyeararray=>$category)
                            {
                                
                               $sortedmonth=verify_challenge_datetime_view($unixbasedmonthyeararray,'M y');
                               
                                foreach($category as $cat=>$chcnt)
                                {
                                    $data[$cat][$sortedmonth]=$chcnt;
                                }
                                
                            }
                        
                        ksort($data);
                    }
                   
                   
             
                }   
            
           
            else{
                if($chart_data!="tot_numb_challenges")
                {
                    ksort($number_of_challenges);
                   
                    if(isset($number_of_challenges))
                    {
                        
                            foreach($unique_category as $catname)
                            {
                                foreach($number_of_challenges as $year_name => $category_name)
                                {
                                   
                                        if(array_key_exists($catname,$category_name))
                                        {
                                            foreach($category_name as $category => $cnt)
                                            {
                                                $data[$category][$year_name] = $cnt;
                                            }
                                        }    
                                        else{
                                    
                                            $data[$catname][$year_name] = 0;
                                        }
                                      
                                }
                            }
                            ksort($data);
                    
                    }
                }
                else{
                        if(isset($number_of_challenges))
                        {
                        
                            foreach($number_of_challenges as $year_name => $cnt)
                            {
                                $data[$year_name]= $cnt;
                                
                            }
                          //  ksort($data);
                    
                        }
                            
                    }
            
                }
            }
        
        }
       
      
        $k=0;
        $i=100;
        $valueCount = 1;
        $masterArray = array();
       
        if(isset($data))
        {
            if($chart_data!="tot_numb_challenges")
            {
                foreach($data as $catName=>$catArray) {
                    
                    if($range_selection!="month")
                    {
                        ksort($catArray);
                    }
                    $catforcolor[]=$catName;
                    $catarray[]= $catName;
                    $jsoncatnames[]= array("text" => $catName." ----------------",
                                  "x" => 130,
                                  "y"=> $i,
                                  "color" => $color_array[$k]);
                        $i=$i+20;
                        $k++;
                    $positionCount = 0;
                    
                    foreach($catArray as $key => $val) {
                        
                        $masterArray[$positionCount]['Year'] = $key;
                        $masterArray[$positionCount]['value' . $valueCount] = $val;
                        $positionCount++;
                        
                         
                    }
                    
                   
                $valueCount++;
                }
               
            }
            else{
                $positionCount = 0;
                $k=0;
                 foreach($data as $catName=>$finalval) {
                        $masterArray[] = array(
                                        "Year" => $catName,
                                       "value" => $finalval,
                                        "color" => $color_array[$k]
                                       );
                     $k++;
                                       

                       // $masterArray[$positionCount]['Year'] = $catName;
                        //$masterArray[$positionCount]['value1'] = $finalval;
                        //$positionCount++; 
                    }
                    //$valueCount=2;
            }
            
        }
       
   
        if($chart_data=="by_agency")
        {
            $categorytitle="Agencies";
            $lablerotation=90;
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
            $categorytitle="Legal Authority ";
            $lablerotation=90;
       }
       else if($chart_data=="tot_numb_challenges")
       {
            $categorytitle="Fiscal Year";
            
       }
        
       
            if(isset($data))
            {
                $data_array=array();
                $data_array_temp1=array();
                $data_array_temp2=array();
                $showtable="<div id='datatable'><table width='100%' class='table table-condensed table-bordered chart-table'>";
                
                if($chart_data=="tot_numb_challenges")
                {
                    $grandtotal=0;
                    $i=0;
                    $showtable.="<tr><th><i class='fa fa-line-chart' title='Chart Color Indication'></i></th><th width='70%'>".$categorytitle."</th><th width='30%'>Total</th></tr>";
                    $title_array=array($categorytitle,'Total');
                    $i=0;
                    foreach($data as $catName=>$cnt) 
                    {
                        $grandtotal+=$cnt;

                        $bgcolor=$color_array[$i];
                        $showtable.="<tr><td BGCOLOR=".$bgcolor."></td><td valign='top' width='70%'>".$catName."</td><td width='30%' valign='top'>".$cnt."</td></tr>";           
                        $data_array_temp2[$catName]=$cnt;
                    }
                    $i++;
                   $showtable.="<tr class='active'><td colspan='2' style='padding-right:10px;' align='right'><b>Total: </b></td><td><b>".$grandtotal."</b></td></tr>";

                    
                }
                else{
                     $i=0;
                     $grandtotal=0;
                     if($range_selection=="month")
                     {
                        $whichdata="Month";
                     }
                     else{
                        $whichdata="Fiscal Year";
                     }
                    $showtable.="<tr><th><i class='fa fa-line-chart' title='Chart Color Indication'></i><th width='30%'>".$categorytitle."</th><th width='30%'>".$whichdata."</th><th width='20%'>Challenge Count</th><th width='20%'>Total</th></tr>";
                    $title_array=array($categorytitle,'Fiscal Year','Challenge Count','Total');
                    foreach($data as $catName=>$catArray) 
                    {
                        if($range_selection!="month")
                        {
                            ksort($catArray);
                        }
                        $bgcolor=$color_array[$i];
                        $catarray[]= $catName;
                       
                       
                            $showtable.="<tr><td BGCOLOR=".$bgcolor."></td><td valign='top' width='30%'>".$catName."</td><td colspan='2'>";
                            $val_total=0;
                            foreach($catArray as $key => $val) 
                            {
                                
                                 $showtable.="<table width='100%' class='sub-table'><tr><td width='30%'>".$key."</td><td width='20%'>".$val."</td></tr></table>";
                                $val_total+=$val;
                                $data_array_temp1[$catName][$key]=$val;
                            }
                            $showtable.="</td>";
                            $showtable.="<td width='10%' valign='top'>".$val_total."</td>"; 
                       
                       $grandtotal+=$val_total;
                        
                        $data_array_temp2[$catName]=$val_total;
                        $showtable.="</tr>";
                        
                         $i++;
                            
                    }
                    $showtable.="<tr class='active'><td colspan='4' style='padding-right:10px;' align='right'><b>Total: </b></td><td><b>".$grandtotal."</b></td></tr>";
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
            $showtable.="<input type='hidden' name='range_selection' value='".$range_selection."'>";
            $showtable.="<input type='hidden' name='report_factor' value='data'>";
            $showtable.="<input type='hidden' name='displayfor' value='loaddata_line'>";
            
           
               if($callfor=="csvexport")
               {
                    $titlearray_temp=array();
                    foreach($title_array as $titlearray)
                    {
                       $titlearray_temp[]=$titlearray;
                    }
            
                    if($chart_data!="tot_numb_challenges")
                    {
                        foreach($data_array_temp1 as $catname=>$chdatarray)
                        {
                            $valarraytemp=array();
                            $i=0;
                            foreach($chdatarray as $key=>$val)
                            {
                               
                               
                                foreach($data_array_temp2 as $category=>$totalcnt)
                                {
                                       
                                      
                                    if($catname==$category)
                                    {
                                         $valarraytemp[]=$totalcnt;
                                        
                                         if($valarraytemp[$i-1]===intval($totalcnt))
                                        {
                                           
                                            $totalcnt="";
                                        }
                                        
                                        
                                        $dataarray[$catname][$key][$val]=$totalcnt;
                                    }
                            
                                }
                               
                                $i++;
                            }
                            
                        }
                        $dataarray["Final Total"][""][""]=$grandtotal;
                    }
                    else{
                        foreach($data_array_temp2 as $category=>$totalcnt)
                        {
                            $dataarray[$category]=$totalcnt;
                        }
                        $dataarray["Final Total"]=$grandtotal;
                    }
                    
                }
               $showtable.="</td></tr>";
              
                $showtable.="<tr><td><input type='submit' name='csv_export' value='Export to CSV'></td></tr></table></form></td></tr></table></div>";
                
            }
            
            if($chart_data!="tot_numb_challenges")
            {
            if(isset($number_of_challenges))
            {
              
                $showtimetable="<table width='100%' class='table table-condensed table-bordered chart-table'>";
                if($range_selection=="month")
                {
                    $whichdata="Month";
                }
                else{
                    $whichdata="Fiscal Year";
                }
                $showtimetable.="<tr><th><i class='fa fa-line-chart' title='Chart Color Indication'></i></th><th width='30%'>".$whichdata."</th><th width='40%'>".$categorytitle."</th><th width='30%'>Challenge Count</th></tr>";
                $title_array=array('Fiscal Year',$categorytitle,'Challenge Count');
                if($range_selection=="month")
                {
                    $grandtotal=0;
                    if($chart_data=="cash_prize")
                    {
                        $data_array=array();
                        foreach($number_of_challenges as $fiscalyear=>$categories)
                        {
                           
                            $showtimetable.="<tr><td style='background-color:".$bgcolor."'></td><td valign='top' width='30%'>".verify_challenge_datetime_view($fiscalyear,'M y')."</td><td colspan='2'>";
                            foreach($categories as $cat=>$cnt)
                            {
                                $grandtotal+=$cnt;
                                $index=array_search($cat,$catarray);
                                $bgcolor=$color_array[$index];
                                $data_array[verify_challenge_datetime_view($fiscalyear,'M y')][$cat]=$cnt;
                                $showtimetable.="<table width='100%' class='sub-table'><tr><td width='40%'>".$cat."</td><td width='30%'>".$cnt."</td></tr></table>";
                            }
                            $showtimetable.="</td></tr>";
                            
                        }
                        $showtimetable.="<tr class='active'><td colspan='3' style='padding-right:10px;' align='right'><b>Total: </b></td><td><b>".$grandtotal."</b></td></tr>";
                    }
                    else{
                        $data_array=array();
                        $grandtotal=0;
                        foreach($monthdata as $fiscalyear=>$categories)
                        {
                            
                            $showtimetable.="<tr><td style='background-color:".$bgcolor."'></td><td valign='top' width='30%'>".verify_challenge_datetime_view($fiscalyear,'M y')."</td><td colspan='2'>";
                            foreach($categories as $cat=>$cnt)
                            {
                                $grandtotal+=$cnt;
                                $index=array_search($cat,$catarray);
                                $bgcolor=$color_array[$index];
                                $data_array[verify_challenge_datetime_view($fiscalyear,'M y')][$cat]=$cnt;
                                $showtimetable.="<table width='100%' class='sub-table'><tr><td width='40%'>".$cat."</td><td width='30%'>".$cnt."</td></tr></table>";
                            }
                            $showtimetable.="</td></tr>";
                        }
                        $showtimetable.="<tr class='active'><td colspan='3' style='padding-right:10px;' align='right'><b>Total: </b></td><td><b>".$grandtotal."</b></td></tr>";
                    }
                    
                }
                else{
                    $data_array=array();
                    $grandtotal=0;
                    foreach($number_of_challenges as $fiscalyear=>$categories)
                    {
                       
                        $showtimetable.="<tr><td></td><td valign='top' width='30%'>".$fiscalyear."</td><td colspan='2'>";
                        
                        foreach($categories as $cat=>$cnt)
                        {
                            $grandtotal+=$cnt;
                            $index=array_search($cat,$catarray);
                            $bgcolor=$color_array[$index];
                            $data_array[$fiscalyear][$cat]=$cnt;
                            $showtimetable.="<table width='100%' class='sub-table'><tr><td width='40%'>".$cat."</td><td width='30%'>".$cnt."</td></tr></table>";
                        }
                        $showtimetable.="</td></tr>";
                     }
                     $showtimetable.="<tr class='active'><td colspan='3' style='padding-right:10px;' align='right'><b>Total: </b></td><td><b>".$grandtotal."</b></td></tr>";
                    
                }
                
            $arr_param=array('csv_export'=>true);
            $redirect_link=add_query_arg($arr_param,get_site_url()."/all-charts/");
            $showtimetable.="<tr><td colspan='4' align='right'><form name='csvform' class='csvform' method='post' action=".$redirect_link."><table><tr><td>";
            $showtimetable.="<input type='hidden' name='report_on' value='".$report_on."'>";
            if(isset($host) && $host!="")
            {
                foreach($host as $hostplatform)
                {
                    if($hostplatform=="external")
                    {
                        $showtimetable.="<input type='hidden' name='host[]' value='".$hostplatform."'>";
                    }
                    if($hostplatform=="internal")
                    {
                        $showtimetable.="<input type='hidden' name='host[]' value='".$hostplatform."'>";
                    }
                }
            }
                
            //$showtable.="<input type='hidden' name='prizearray' value='".$prizearray."'>";
            $showtimetable.="<input type='hidden' name='chart_data' value='".$chart_data."'>";
            $showtimetable.="<input type='hidden' name='agencyname' value='".$agencyname."'>";
            $showtimetable.="<input type='hidden' name='daterange' value='".$daterange."'>";
            $showtimetable.="<input type='hidden' name='range_selection' value='".$range_selection."'>";
            $showtimetable.="<input type='hidden' name='report_factor' value='time'>";
            $showtimetable.="<input type='hidden' name='displayfor' value='loaddata_line'>";
                
               
               if($callfor=="csvexport")
               {
                    foreach($title_array as $titlearray)
                    {
                       $titlearray_temp_time[]=$titlearray;
                    }
              
                    foreach($data_array as $fiscalarray=>$chdata)
                    {
                        foreach($chdata as $cat=>$cnt)
                        {
                            
                            $dataarray_time[$fiscalarray][$cat]=$cnt;
                        }
                        
                    }
                    $dataarray_time["Final Total"][""]=$grandtotal;
                }
                
               
               
                $showtimetable.="</td></tr>";
                $showtimetable.="<tr><td><input type='submit' name='csv_export' value='Export to CSV'></td></tr></table></form></td></tr></table>";
            }
            }
            
       
    endif;

if($callfor!="csvexport")
{   

     if(empty($masterArray) || $masterArray=="")
        {
            ?>
            
                jQuery( document ).ready(function() {
                    jQuery("#drawchart").html("Sorry! No data found.");
                });
             
        <?php
        }
        else{
            
            if($chart_data=="tot_numb_challenges")
            {
               ?>
                
                DrawLineChart();
                
                function DrawLineChart()
                {
                    jQuery("#filter_report_on").hide();
                    var chartLineData=<?php echo json_encode( $masterArray );?>;
                    var chart = AmCharts.makeChart("drawchart",{
                        type    : "serial",
                        categoryField  : "Year",
                        dataProvider  : chartLineData,
                        marginTop : 50,
                        "chartScrollbar" : {
                            "autoGridCount" : true,
                        },
                        "graphs": [
                        {
                            "valueField" : "value",
                            "lineColor" : "<?php echo $color_array[0];?>",
                            "bullet" : "round",
                            "balloonText" : "[[category]]<br><b>value: [[value]]</b>",
                            "type" : "line",
                                            
                        }
                            
                        ],
                    
                        export: {
                                enabled: true,
                                "libs": {
                                    "path": "https://amcharts.com/lib/3/plugins/export/libs/"
                                },
                                //  "menu": ["JPG", "PNG", "pdf", "print"]
                                 "menu": [ {
			    
				"label": "Download Chart",
                                "menu": ["JPG", "PNG", "pdf", "print"]
				} ]
                              }
                             
                    
                  });
               }
               
                jQuery( document ).ready(function() {
                jQuery( "h1.entry-title" ).html("<span class='small'>Data Visualization Reports: <?php echo $agencyname;?><span>");
                 jQuery("#legenddiv").html("<?php echo $showtable;?>");
                 });
               <?php
            }
            else{
                 ?>
       
          
                jQuery( document ).ready(function() {
                jQuery( "h1.entry-title" ).html("<span class='small'>Data Visualization Reports: <?php echo $agencyname;?><span>");
                 jQuery("#legenddiv").html("<?php echo $showtable;?>");
                 });
                jQuery('#sortdata').on('change', function() {
                if (this.value=="data") {
                    jQuery("#legenddiv").html("<?php echo $showtable;?>");
                }
                else{
                   jQuery("#legenddiv").html("<?php echo $showtimetable;?>");
                }
              });
            DrawLineChart();
            function DrawLineChart()
            {
                jQuery("#filter_report_on").show();
                var chartLineData=<?php echo json_encode( $masterArray );?>;
           
           
                var chart = AmCharts.makeChart("drawchart",{
                type    : "serial",
                categoryField  : "Year",
                marginTop : 50,
                dataProvider  : chartLineData,
                <?php
                    if($chart_data!="by_agency")
                    {
                    ?>
                        allLabels: <?php echo json_encode( $jsoncatnames );?>,
                    <?php
                    }
                    ?>
                "chartScrollbar" : {
                    "autoGridCount" : true,
                },
                "graphs": [
                <?php
                    $k=0;
                    for($i=1; $i<$valueCount; $i++)
                    {
                        
                        ?>
                        
                        {
                            "valueField" : "value<?php echo $i; ?>",
                            "lineColor" : "<?php echo $color_array[$k];?>",
                            "bullet" : "round",
                            "balloonText" : "<?php echo $catarray[$k];?>:<b>[[value]]</b>",
                            "bulletBorderColor" : "#FFFFFF",
                            "type" : "line",
                            "bulletBorderThickness" : 2,
                            "lineThickness" : 2,
                            "lineAlpha" : 0.5
                        },
                     
            
                      
                        <?php
                        $k++;
                    }
                    ?>
                     ],
                
            
                
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
}
else{


    header("Content-type: text/csv");
    header("Content-disposition: csv" . date("Y-m-d") . ".csv");
    header( "Content-disposition: filename=data.csv");
    header("Pragma: no-cache");
    header("Expires: 0");
               
    $output = fopen('php://output', 'w');
    
    if($report_factor=="time")
    {
        fputcsv($output, $titlearray_temp_time);
        foreach($dataarray_time as $keyofkeyvalarray=>$keyvalarray)
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
    }
    else{
        fputcsv($output, $titlearray_temp);
        if($chart_data=="tot_numb_challenges")
        {
            foreach($dataarray as $keyofkeyvalarray=>$keyvalarray)
            {
           
                $array_to_write=array($keyofkeyvalarray,$keyvalarray);
                           
                fputcsv($output, $array_to_write);
                            
            }
        }
        else{
            foreach($dataarray as $keyofkeyvalarray=>$keyvalarray)
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
        }
        
    }
    
                
   
}
   
}
function array_merge_recursive_distinct ( array &$array1, array &$array2 )
{
 $merged = $array1;

 foreach ( $array2 as $key => &$value )
 {
   if ( is_array ( $value ) && isset ( $merged [$key] ) && is_array ( $merged [$key] ) )
   {
     $merged [$key] = array_merge_recursive_distinct ( $merged [$key], $value );
   }
   else
   {
     $merged [$key] = $value;
   }
 }

 return $merged;
}


?>
