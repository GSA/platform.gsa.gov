<?php
add_action('shutdown', 'gather_gantt_chart_data');

function gather_gantt_chart_data()
{
    if(isset($_POST['chart_type']) && $_POST['chart_type']=="gantt")
    {
        if(isset($_POST['chart_data']) && $_POST['chart_data']!="")
        {
            $chartdata=$_POST['chart_data'];
        }
        if(isset($_POST['host_platform']) && $_POST['host_platform']!="")
        {
            foreach ($_POST['host_platform'] as $host){
                 $hostdata[]=$host;
            }
        }
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
        if((isset($_POST['display_selection']) && $_POST['display_selection']=="agency_selection") && $_POST['agency_selection_box']!="")
        {
            $agencyname=$_POST['agency_selection_box'];
        }
	if((isset($_POST['display_selection']) && $_POST['display_selection']=="top_agencies") && $_POST['number_of_agencies']!="")
        {
            $number_of_agencies=$_POST['number_of_agencies'];
        }
	
        if(isset($_POST['chart_data']) && $_POST['chart_data']!="")
        {
            if($_POST['chart_data']=="submission_period")
            {
                $task="Submission Period";
            }
	    if($_POST['chart_data']=="public_voting_period")
            {
                $task="Public Voting Period";
            }
	    if($_POST['chart_data']=="judging_period")
            {
                $task="Judging Period";
            }
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
       
        $allchallengedata=getAgencyChallenge($agencyname,$hostdata,$_POST['chart_data'],$finaldate,$number_of_agencies);
	
	$callfor='loadchart';
	
        draw_gantt_chart($allchallengedata,$agencyname,$task,$_POST['chart_data'],$report_on,$hostdata,$finaldate,$number_of_agencies,$callfor);
        
    }
    
}
function getAgencyChallenge($agencyname,$hostdata,$chartdata,$daterange,$number_of_agencies)
{
     $args = array(
       
	'post_type'	=> 'challenge',
	'post_status' =>  'publish',
         'posts_per_page' => -1);
   
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
    
    if(isset($hostdata) && $hostdata!="")
    {
        foreach($hostdata as $hostplatform)
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
   
  
    if($number_of_agencies!="")
    {
	$tax_operator = 'IN';
    
	$term_args=array('orderby'  => 'name', 
                     'order'    => 'ASC');
    
    
	$agency_list=get_terms( 'agency', $term_args );
    
	foreach($agency_list as $agencies)
	{
	  if($agencies->parent==0)
	  {
	   $challenge_count = do_shortcode('[challenge-display-posts return_found="true" post_type="challenge" taxonomy="agency" tax_term="'.$agencies->name.'"]');
	   $challengearray[$agencies->name]=$challenge_count;
	  }
	  
	}
	$agencyarray=array();
	arsort($challengearray);
	$agencyarray=array_slice($challengearray,0,$number_of_agencies);

	foreach($agencyarray as $agenylist=>$value)
	{
	    $agencynames[]=$agenylist;
	}
    
    
     $tax_args = array(
                            'tax_query' => array(
                                    array(
                                            'taxonomy' => 'agency',
                                            'field'    => 'slug',
                                            'operator' => 'IN',
                                            'terms'    => $agencynames
                                            
                                )
                            )
                    );
    }
    elseif($agencyname=="all")
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

    elseif($agencyname!="")
    {
	$tax_args=array('tax_query' => array(
                  array(
                        'taxonomy' => 'agency',
                        'terms'    => $agencyname,
                        'field'    => 'slug',
                        'operator' => 'IN'
                                            
                                )
                            ));
    }
    else{
	$tax_args=array();
    }
   
    
    $args=array_merge($args,$tax_args);
         
   
    $the_query = new WP_Query( $args );
//print_r($the_query);
   if($the_query->have_posts() ): 
     while( $the_query->have_posts() ) : $the_query->the_post();
    
           if($chartdata=="submission_period")
           {
                $startdate = get_field('submission_start',get_the_ID());
		$enddate = get_field('submission_end',get_the_ID());
		$unixbased_startdate=$startdate;
           }
	   if($chartdata=="public_voting_period")
           {
                $startdate = get_field('public_voting_start',get_the_ID());
		$enddate = get_field('public_voting_end',get_the_ID());
		$unixbased_startdate=mysql2date( 'U', $startdate);
           }
	    if($chartdata=="judging_period")
           {
                $startdate = get_field('judging_start',get_the_ID());
		$enddate = get_field('judging_end',get_the_ID());
		$unixbased_startdate=mysql2date( 'U', $startdate);
           } 
           $duration= date_diff(date_create(verify_challenge_datetime_view($enddate,'m/d/y')) , date_create(verify_challenge_datetime_view($startdate,'m/d/y')));
           $timeline_year=$duration->y;
	   $timeline_month=$duration->m;
	   $timeline_days=$duration->d;
	   $timeline="";
	   if($timeline_year!=0)
	   {
		$timeline_year_string=$timeline_year." Year(s)";
		$timeline=$timeline_year_string;
	   }
	   if($timeline_month!=0)
	   {
		$timeline_month_string=" ".$timeline_month." Month(s)";
		$timeline.=$timeline_month_string;
	   }
	   if($timeline_days!=0)
	   {
		$timeline_days_string=" ".$timeline_days." Day(s)";
		$timeline.=$timeline_days_string;
	   }
	   
	  if($startdate!="" &&  $enddate!="")
	  {
	    
	    $allchallengedata[get_the_ID()][]= get_the_title(get_the_ID());
	    $allchallengedata[get_the_ID()][]=verify_challenge_datetime_view($startdate,'Y-m-d');
	    $allchallengedata[get_the_ID()][]=verify_challenge_datetime_view($enddate,'Y-m-d');
	    $allchallengedata[get_the_ID()][]=$unixbased_startdate;
	    $allchallengedata[get_the_ID()][]=$timeline;
	    if($number_of_agencies!="" || $agencyname=='all')
	    {
	    
		$terms = wp_get_post_terms(get_the_ID(), 'agency');
		foreach($terms as $term)
		{
		    $assignagency=$term->name;
		    $parentid = $term->parent;
		    
		    if($parentid!=0)
		    {
			$parent  = get_term_by( 'id', $term->parent, 'agency');
			// climb up the hierarchy until we reach a term with parent = '0'
			while ($parent->parent != '0'){
			    $term_id = $parent->parent;
		     
			    $parent  = get_term_by( 'id', $term_id, 'agency');
			}
            
			$assignagency=$parent->name;
                
                
		    }
		    $allchallengedata[get_the_ID()][]=$assignagency;
		}
	    }
	    
	   
	   }
           
     endwhile;
    endif;
  
    
    return $allchallengedata;
    
}
function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return html_entity_decode($text);
    }
function draw_gantt_chart($allchallengedata,$agencyname,$task,$chart_data,$report_on,$host,$daterange,$number_of_agencies,$callfor)
{
    
    
    $i=0;
    
    $challengejson= array();
    if(isset($allchallengedata))
    {
	    foreach($allchallengedata as $challenges)
	    {
	       
	    
	
		$challengejson[$i] = array();
		//$challengejson[$i]['category'] = wordwrap(html_entity_decode($challenges[0]), 40, "\n", true);
		//limit_text($challenges[0],5);
		$challengejson[$i]['category'] = html_entity_decode($challenges[0]);
		
		$challengejson[$i]['segments'] = array();
		$challengejson[$i]['segments'][0]['start'] = $challenges[1];
		$challengejson[$i]['segments'][0]['color'] = '#'.random_color();
		
		$challengejson[$i]['segments'][0]['end'] = $challenges[2];
		$challengejson[$i]['segments'][0]['task'] = $task;
		
		
		$submission_start_array[]=$challenges[3];
		
		if(($number_of_agencies!="" || $agencyname=="all") && isset($challenges[5]) && $challenges[5]!="")
		{
		    $challenge_title_array[$challenges[5]][html_entity_decode($challenges[0])][$challenges[1]][$challenges[2]]=$challenges[4];
		
		}
		else{
		    $challenge_title_array[html_entity_decode($challenges[0])][$challenges[1]][$challenges[2]]=$challenges[4];
		}
		$i++;
	    }
	    sort($submission_start_array);
	   
	    $start_date_timestamp=$submission_start_array[0];
	    $start_date=verify_challenge_datetime_view($start_date_timestamp,'Y-m-d');
	    $mynewjson = json_encode($challengejson);
	    
	    /* Data Table */
	    if($chart_data=="submission_period")
	    {
                $start_text="Submission Start Date";
		$end_text="Submission End Date";
	    }
	    if($chart_data=="public_voting_period")
	    {
                $start_text="Public Voting Start Date";
		$end_text="Public Voting End Date";
	    }
	    if($chart_data=="judging_period")
	    {
                $start_text="Judging Start Date";
		$end_text="Judging End Date";
	    } 
	    $showtable="<table width='100%' class='table table-condensed table-bordered chart-table table-hover'>";
            
            
            $data_array=array();
            if($number_of_agencies!="" || $agencyname=="all")
	    {
		$showtable.="<tr><th width='20%'>Agencies</th><th width='30%'>Challenge Name</th><th width='15%'>".$start_text."</th><th width='15%'>".$end_text."</th><th width='20%'>Interval</th></tr>";
		$title_array=array('Agencies','Challenge Name',$start_text,$end_text,'Interval');
		
		foreach($challenge_title_array as $agencies => $challenges)
		{
		    
		    $showtable.="<tr style='border-bottom:1px solid black'><td valign='top' width='20%'>".$agencies."</td><td colspan='4'><table width='100%'>";
		    foreach($challenges as $challengenames=>$dates)
		    {
			foreach($dates as $startdate=>$enddate)
			{
			    foreach($enddate as $enddates=>$timegap)
			    {
				$showtable.="<tr><th width='30%'>".$challengenames."</th><th width='15%'>".$startdate."</th><th width='15%'>".$enddates."</th><th width='20%'>".$timegap."</th></tr>";
				$dataarray[$agencies][$challengenames][$startdate][$enddates]=$timegap;
			    }
			}
		    }
		    $showtable.="</table></td></tr>";
		}
		
	    }
	    else{
		$showtable.="<tr><th>Challenge Name</th><th>".$start_text."</th><th>".$end_text."</th><th>Interval</th></tr>";
		$title_array=array('Challenge Name',$start_text,$end_text,'Interval');
		foreach($challenge_title_array as $challengenames => $periods)
		{
		    foreach($periods as $startdate=>$enddate)
		    {
			foreach($enddate as $enddates=>$timegap)
			{
			    $showtable.="<tr><td>".$challengenames."</td><td>".$startdate."</td><td>".$enddates."</td><td>".$timegap."</td></tr>";
			    $dataarray[$challengenames][$startdate][$enddates]=$timegap;
			}
		    }
		}
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
	    $showtable.="<input type='hidden' name='number_of_agencies' value='".$number_of_agencies."'>";
	    $showtable.="<input type='hidden' name='task' value='".$task."'>";
            $showtable.="<input type='hidden' name='displayfor' value='loaddata_gantt'>";
            
	    if($callfor=="csvexport")
            {
                foreach($title_array as $titlearray)
                {
                    $titlearray_temp[]=$titlearray;
                }
            }
               
                $showtable.="</td></tr>";
                $showtable.="<tr><td><input type='submit' name='csv_export' value='Export to CSV'></td></tr></table></form></td></tr>";
                $showtable.="</table>";
    }
if($callfor!="csvexport")
{
    if(isset($mynewjson) && $mynewjson!="")
    {
       
	    ?>
	   
        
	jQuery("#legenddiv").html("<?php echo $showtable;?>");
	 var ganttchart = AmCharts.makeChart( "drawchart", {
		
		    "type": "gantt",
		    
		   
		    "autoMargins":true,
		    

		    "dataDateFormat":"YYYY-MM-DD",
		    "pathToImages": "https://www.amcharts.com/lib/3/images/",
		    "columnWidth": 0.5,
		    "valueAxis": {
			 "type": "date",
			},
		       
			"categoryAxis": {
			"labelFunction": function(label,item,chart) {
			  if ( chart.cellWidth < 60 ) {
			    labelarray = label.split(" ");
			    if(labelarray.length>4)
			    {
			    labelTemp="";
				for(i=0; i<4; i++)
				{
				    labelTemp+=labelarray[i]+" ";
				}
				labelTemp=labelTemp+"...";
			    }
			    else
			    {
				labelTemp=label;
			    }
			  
			    label = $('<div/>').html(labelTemp).text();
			  }
			  return label;
			}
		    },
	
		       "brightnessStep": 10,
		       "graph": {
			 "fillAlphas": 1,
			 "balloonText": "<b>[[task]]</b>: [[open]] [[value]]"
		       },
		       "rotate": true,
		       marginTop : 50,
		    	"categoryField": "category",
		       "segmentsField": "segments",
		       "colorField": "color",
		       "startDateField":"start",
		       "endDateField":"end",
		       "dataProvider": <?php echo $mynewjson;?>,
		       "chartScrollbar": {},
		       "chartCursor": {
			 "valueBalloonsEnabled": false,
			 "cursorAlpha": 0.1,
			 "valueLineBalloonEnabled": true,
			 "valueLineEnabled": true,
			 "fullWidth": true
			 
			
		       },
		       export: {
                            enabled: true,
			  //"divId": exporticon,
			   // position: "top-left",
                                "libs": {
                                    "path": "https://amcharts.com/lib/3/plugins/export/libs/"
                                },
			    "menu": [ {
			    
				"label": "Download Chart",
                                "menu": ["JPG", "PNG", "pdf", "print"]
				} ]
                    }
		     });
	  jQuery("h1.entry-title" ).html("<span class='small'>Data Visualization Reports: <?php echo $agencyname;?><span>"); 
	     <?php
    }    
    
    else
    {
	?>
	
                jQuery( document ).ready(function() {
                    jQuery("#drawchart").html("Sorry! No data found.");
                });
             
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
			if(is_array($total_val))
			{
			    foreach($total_val as $total_val_key=>$total_val_val)
			    {
				$array_to_write=array($keyofkeyvalarray,$keyofvalarray,$total_key,$total_val_key,$total_val_val);
				fputcsv($output, $array_to_write);
			    }
			}
			else{
			    $array_to_write=array($keyofkeyvalarray,$keyofvalarray,$total_key,$total_val);
			    fputcsv($output, $array_to_write);
			}
                        
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
?>