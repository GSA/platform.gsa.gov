<?php
// class OMBMax
//{
//   static function isAuthenticated() { return true; }
//}

//add_action('wp',function(){die();});
/**
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 *
 * Layout Functions:
 *
 * st_header  // Opening header tag and logo/header text
 * st_header_extras // Additional content may be added to the header
 * st_navbar // Opening navigation element and WP3 menus
 * st_before_content // Opening content wrapper
 * st_after_content // Closing content wrapper
 * st_before_sidebar // Opening sidebar wrapper
 * st_after_sidebar // Closing sidebar wrapper
 * st_before_footer // Opening footer wrapper
 * st_footer // The footer (includes sidebar-footer.php)
 * st_after_footer // The closing footer wrapper
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, skeleton_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'skeleton_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */

/*-----------------------------------------------------------------------------------*/
/* Set Proper Parent/Child theme paths for inclusion
/*-----------------------------------------------------------------------------------*/

@define( 'PARENT_DIR', get_template_directory() );
@define( 'CHILD_DIR', get_stylesheet_directory() );

@define( 'PARENT_URL', get_template_directory_uri() );
@define( 'CHILD_URL', get_stylesheet_directory_uri() );



/*-----------------------------------------------------------------------------------*/
/* Initialize the Options Framework
/* http://wptheming.com/options-framework-theme/
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {

    define('OPTIONS_FRAMEWORK_URL', PARENT_URL . '/admin/');
    define('OPTIONS_FRAMEWORK_DIRECTORY', PARENT_DIR . '/admin/');

    require_once (OPTIONS_FRAMEWORK_DIRECTORY . 'options-framework.php');

}

if ( class_exists( 'jigoshop' ) ) {
    require_once (PARENT_DIR . '/jigoshop_functions.php');
}

if ( class_exists( 'bbPress' ) ) {
    require_once (PARENT_DIR . '/bbpress/bbpress_functions.php');
}


require_once (PARENT_DIR . '/shortcodes.php');

add_action('wp',function()
    {
    if(is_page('All charts')) 
    {
       
         if(is_user_logged_in() && (current_user_can('create_users'))) {
         }
         else{
           
            wp_redirect(home_url());
            exit;
         }
    }
    });
add_action("wp_ajax_select_chart_field", "select_chart_field_toload");
add_action("wp_ajax_nopriv_select_chart_field", "select_chart_field_toload");


add_action("wp_ajax_load_chart_data", "challenge_charts_load");
add_action("wp_ajax_nopriv_load_chart_data", "challenge_charts_load");

add_action("wp_ajax_decide_chart_fields", "decide_chart_field_toload");
add_action("wp_ajax_nopriv_decide_chart_fields", "decide_chart_field_toload");

function challenge_charts_load()
{
    if($_POST['chart_type']=="gantt")
      {
        
        require_once (PARENT_DIR . '/function_gantt_chart.php');
      }
      if($_POST['chart_type']=="pie")
      {
    
       require_once (PARENT_DIR . '/function_pie_chart.php');
      }
      
      if($_POST['chart_type']=="bar")
        {
            require_once (PARENT_DIR . '/function_bar_chart.php');
        }
         if($_POST['chart_type']=="line")
        {
            require_once (PARENT_DIR . '/function_line_chart.php');
        }
      
}
function decide_chart_field_toload()
{

   
    if($_POST['AgencyOptions']=="agency_selection")
    {
        
        if($_POST['agencynames']=='all')
        {
            $chartfield='<li>
            <span id="pietype"></span>
                    <input aria-labelledby="pietype" type="radio" id="pie_type" name="chart_type" value="pie" checked="checked" /> Pie</li>
                <li>
                <span id="bartype"></span>
                    <input aria-labelledby="bartype" type="radio" id="bar_type" name="chart_type" value="bar" /> Bar</li>';
        
            $datafield='<li>
            <span id="agency"></span>
                        <input aria-labelledby="agency" type="radio" name="chart_data" value="by_agency" checked="checked"> Agency</li>
                    <li>
                    <span id="fiscalyear"></span>
                        <input aria-labelledby="fiscalyear" type="radio" name="chart_data" value="tot_numb_challenges"> Fiscal Year</li>
                    <li>
                    <li>
                     <span id="challengetype"></span>
                        <input aria-labelledby="challengetype" type="radio" name="chart_data" value="challenge_type"> Challenge Type</li>
                    <li>
                    <span id="prizetype"></span>
                        <input aria-labelledby="prizetype" type="radio" name="chart_data" value="prize_type"> Prize Type</li>
                    <li>
                    <span id="solutiontype"></span>
                        <input area-labelledby="solutiontype" type="radio" name="chart_data" value="solution_type"> Solution Type</li>
                    <li>
                    <span id="prizeamount"></span>
                        <input area-labelledby="prizeamount" type="radio" name="chart_data" value="cash_prize"> Prize Amount</li>
                    <li>
                    <span id="legalauthority"></span>
                    <input aria-labelledby="legalauthority" type="radio" name="chart_data" value="legal_authority"> Legal Authority</li>';
        }
        else{
            $chartfield='<li>
                      <span id="pie"></span>
                        <input aria-labelledby="pie" type="radio" id="pie_type" name="chart_type" value="pie" checked="checked" /> Pie</li>
                    <li>
                       <span id="bar"></span>
                        <input aria-labelledby="bar" type="radio" id="bar_type" name="chart_type" value="bar" /> Bar</li>
                    <li>
                    <span id="line"></span>
                        <input aria-labelledby="line" type="radio" id="bar_type" name="chart_type" value="line" /> Line</li>
                       <div class="reporting-filter-box" id="line_report_data" style="display:none">
                    <span id="fiscalyear"></span>   
                    <input aria-labelledby="fiscalyear" type="radio" id="range_fiscal_selection" name="range_selection" value="fiscal_year" checked="checked"> By Fiscal Year</li>
                    <span id="bymonth"></span>
                    <input type="radio" aria-labelledby="bymonth" id="range_month_selection" name="range_selection" value="month"> By Month</li>
                       </div>';
        
            $datafield='<li>
                        <span id="agency"></span>
                        <input aria-labelledby="agency" type="radio" name="chart_data" value="by_agency" checked="checked"> Agency</li>
                    <li>
                    <span id="fiscalyear"></span>
                        <input aria-labelledby="fiscalyear" type="radio" name="chart_data" value="tot_numb_challenges"> Fiscal Year</li>
                    <li>
                    <li>
                    <span id="challengetype"></span>
                        <input aria-labelledby="fiscalyear" type="radio" name="chart_data" value="challenge_type"> Challenge Type</li>
                    <li>
                    <span id="prizetype"></span>
                        <input aria-labelledby="prizetype" type="radio" name="chart_data" value="prize_type"> Prize Type</li>
                    <li>
                       <span id="solutiontype"></span>
                        <input aria-labelledby="solutiontype" type="radio" name="chart_data" value="solution_type"> Solution Type</li>
                    <li>
                       <span id="prizeamount"></span>
                        <input aria-labelledby="prizeamount" type="radio" name="chart_data" value="cash_prize"> Prize Amount</li>
                    <li>
                        <span id="legalauthority"></span>
                        <input aria-labelledby="legalauthority" type="radio" name="chart_data" value="legal_authority"> Legal Authority</li>
                    <hr style="border-top: dotted 1px #333;" />
                    <li>
                        <span id="submissionperiod"></span>
                        <input aria-labelledby="submissionperiod" type="radio" name="chart_data" value="submission_period"> Submission Period</li>
                    <li>
                        <span id="publicvoting"></span>
                        <input aria-labelledby="publicvoting" type="radio" name="chart_data" value="public_voting_period"> Public Voting Period</li>
                    <li>
                        <span id="judgingperiod"></span>
                        <input aria-labelledby="judgingperiod" type="radio" name="chart_data" value="judging_period"> Judging Period</li>';
        }
        
                    
    }
    
    if($_POST['AgencyOptions']=="top_agencies")
    {
        
        $chartfield='<li>
                        <span id="pietype"></span>
                        <input aria-labelledby="pietype" type="radio" id="pie_type" name="chart_type" value="pie" checked="checked" /> Pie
                    </li>
                    <li>
                        <span id="charttype"></span>
                        <input aria-labelledby="charttype" type="radio" id="bar_type" name="chart_type" value="bar" /> Bar
                    </li>
                    <li>
                        <span id="linetype"></span>
                        <input aria-labelledby="linetype" type="radio" id="line_type" name="chart_type" value="line"> Line
                    </li>';
        $datafield='<li>
                        <span id="agency"></span>
                        <input aria-labelledby="agency" type="radio" name="chart_data" value="by_agency" checked="checked"> Agency</li>
                    <li>
                     <span id="fiscal_year"></span>
                        <input aria-labelledby="fiscal_year" type="radio" name="chart_data" value="tot_numb_challenges"> Fiscal Year</li>
                    <li>
                    <li>
                        <span id="challengetype"></span>
                        <input aria-labelledby="challengetype" type="radio" name="chart_data" value="challenge_type"> Challenge Type</li>
                    <li>
                        <span id="prizetype"></span>
                        <input aria-labelledby="prizetype" type="radio" name="chart_data" value="prize_type"> Prize Type</li>
                    <li>
                        <span id="solutiontype"></span>
                        <input aria-labelledby="solutiontype" type="radio" name="chart_data" value="solution_type"> Solution Type</li>
                    <li>
                        <span id="prizeamount"></span>
                        <input aria-labelledby="prizeamount" type="radio" name="chart_data" value="cash_prize"> Prize Amount</li>
                    <li>
                        <span id="legalauthority"></span>
                        <input aria-labelledby="legalauthority" type="radio" name="chart_data" value="legal_authority"> Legal Authority</li>
                        <hr style="border-top: dotted 1px #333;" />
                    <li>
                        <span id="submissionperiod"></span>
                        <input aria-labelledby="submissionperiod"  type="radio" name="chart_data" value="submission_period"> Submission Period</li>
                    <li>
                        <span id="publicvoting"></span>
                        <input aria-labelledby="publicvoting" type="radio" name="chart_data" value="public_voting_period"> Public Voting Period</li>
                    <li>
                        <span id="judgingperiod"></span>
                        <input aria-labelledby="judgingperiod"  type="radio" name="chart_data" value="judging_period"> Judging Period</li>';            
                    
    }
    
    echo $chartfield."||".$datafield;
   
   exit;
}
function select_chart_field_toload()
{
   
        if($_POST['reporton']=='top_agencies')
        {
            
            if($_POST['chartdata']=="submission_period" || $_POST['chartdata']=="public_voting_period" || $_POST['chartdata']=="judging_period")
            {
                $chartfield='<li>
                <span id="gantt"></span><input aria-labelledby="gantt" id="line_type" type="radio" value="gantt" name="chart_type" checked="checked"> Gantt</li>';
            }
            else if($_POST['chartdata']=='by_agency')
            {
                $chartfield='<li>
                        <span id="pietype"></span><input aria-labelledby="pietype" type="radio" id="pie_type" name="chart_type" value="pie" checked="checked" /> Pie</li>
                    <li>
                    <span id="bartype"></span>
                        <input aria-labelledby="bartype" type="radio" id="bar_type" name="chart_type" value="bar" /> Bar</li>
                    <li>
                        <input  type="radio" id="line_type" name="chart_type" value="line"> Line</li><div class="reporting-filter-box" id="line_report_data" style="display:none"><ul>
                            <li>
                                <input type="radio" id="range_fiscal_selection" name="range_selection" value="fiscal_year" checked="checked"> Fiscal Year</li>
                            <li>
                                <input type="radio" id="range_month_selection" name="range_selection" value="month"> Month</li>
                        </ul></div>';
            }
            else{
                $chartfield='<li>
                <span id="pietype"></span>
                        <input aria-labelledby="pietype" type="radio" id="pie_type" name="chart_type" value="pie" checked="checked" /> Pie</li>
                    <li>
                    <span id="bartype"></span>
                        <input aria-labelledby="bartype" type="radio" id="bar_type" name="chart_type" value="bar" /> Bar</li>';
            }
        }
        else{
            if($_POST['chartdata']=="submission_period" || $_POST['chartdata']=="public_voting_period" || $_POST['chartdata']=="judging_period")
            {
                $chartfield='<li><input id="line_type" type="radio" value="gantt" name="chart_type" checked="checked"> Gantt</li>';
            }
            else{
                if($_POST['agencynames']=='all')
                {
                 $chartfield='<li>
                 <span id="pietype"></span>
                    <input aria-labelledby="pietype" type="radio" id="pie_type" name="chart_type" value="pie" checked="checked" /> Pie</li>
                <li>
                <span id="bartype"></span>
                    <input aria-labelledby="bartype" type="radio" id="bar_type" name="chart_type" value="bar" /> Bar</li>';
                }
                else
                {
                 $chartfield='<li>
                 <span id="pietype"></span>
                    <input aria-labelledby="pietype" type="radio" id="pie_type" name="chart_type" value="pie" checked="checked" /> Pie</li>
                <li>
                 <span id="bartype"></span>
                    <input aria-labelledby="bartype" type="radio" id="bar_type" name="chart_type" value="bar" /> Bar</li>
                <li>
                    <input type="radio" id="line_type" name="chart_type" value="line"> Line</li>
                <div class="reporting-filter-box" id="line_report_data" style="display:none"><input type="radio" id="range_fiscal_selection" name="range_selection" value="fiscal_year" checked="checked"> Fiscal Year</li>
                <input type="radio" id="range_month_selection" name="range_selection" value="month"> Month</li>
                </div>';
                }
            }
           
        }
    echo $chartfield;
   
   exit;
}
add_action('init',function()
{
     
      
         if($_GET['csv_export'] && $_GET['csv_export'] ==1)
            {
                
                 setlocale(LC_MONETARY, 'en_US');
                $displayfor=$_POST['displayfor'];
                
                $callfor='csvexport';
                
                if($displayfor=="topagency_pie")
                {
                    $numb_of_agencies=$_POST['numb_of_agencies'];
                    $data=$_POST['data'];
                    $host=$_POST['host'];
                    $daterange=$_POST['daterange'];
                    require_once (PARENT_DIR . '/function_pie_chart.php');
                    gettopagencies($numb_of_agencies,$data,$host,$daterange,$callfor);
                }
                if($displayfor=="loaddata_pie")
                {
                    $report_on=$_POST['report_on'];
                    $host=$_POST['host'];
                    //$prizearray=$_POST['prizearray'];
                    $prizearray='';
                    $chart_data=$_POST['chart_data'];
                    $agencyname=$_POST['agencyname'];
                    $daterange=$_POST['daterange'];
                    require_once (PARENT_DIR . '/function_pie_chart.php');
                    getPieChart($report_on,$host,$prizearray,$chart_data,$agencyname,$daterange,$callfor);
                }
                if($displayfor=="topagency_bar")
                {
                    $numb_of_agencies=$_POST['numb_of_agencies'];
                    $data=$_POST['data'];
                    $host=$_POST['host'];
                    $daterange=$_POST['daterange'];
                    require_once (PARENT_DIR . '/function_bar_chart.php');
                    gettopagencies($numb_of_agencies,$data,$host,$daterange,$callfor);
                    
                }
                if($displayfor=="loaddata_bar")
                {
                    $report_on=$_POST['report_on'];
                    $host=$_POST['host'];
                    //$prizearray=$_POST['prizearray'];
                    $prizearray='';
                    $chart_data=$_POST['chart_data'];
                    $agencyname=$_POST['agencyname'];
                    $daterange=$_POST['daterange'];
                    require_once (PARENT_DIR . '/function_bar_chart.php');
                    getBarChart($report_on,$host,$prizearray,$chart_data,$agencyname,$daterange,$callfor);
                }
                if($displayfor=="topagency_line")
                {
                    $report_on=$_POST['report_on'];
                    $host=$_POST['host'];
                    $numb_of_agencies=$_POST['numb_of_agencies'];
                    $chart_data=$_POST['chart_data'];
                    $agencyname=$_POST['agencyname'];
                    $daterange=$_POST['daterange'];
                    $range_selection=$_POST['range_selection'];
                    $report_factor=$_POST['report_factor'];
                    require_once (PARENT_DIR . '/function_line_chart.php');
                    gettopagencies($numb_of_agencies,$chart_data,$host,$daterange,$range_selection,$callfor,$report_factor);
                    
                }
                if($displayfor=="loaddata_line")
                {
                    $report_on=$_POST['report_on'];
                    $host=$_POST['host'];
                    //$prizearray=$_POST['prizearray'];
                    $prizearray='';
                    $chart_data=$_POST['chart_data'];
                    $agencyname=$_POST['agencyname'];
                    $daterange=$_POST['daterange'];
                    $range_selection=$_POST['range_selection'];
                    $report_factor=$_POST['report_factor'];
                    require_once (PARENT_DIR . '/function_line_chart.php');
                    getLineChart($report_on,$host,$prizearray,$chart_data,$agencyname,$daterange,$range_selection,$callfor,$report_factor);
                }
                if($displayfor=="loaddata_gantt")
                {
                    $report_on=$_POST['report_on'];
                    $host=$_POST['host'];
                    $chart_data=$_POST['chart_data'];
                    $agencyname=$_POST['agencyname'];
                    $daterange=$_POST['daterange'];
                    $task=$_POST['task'];
                    $number_of_agencies=$_POST['number_of_agencies'];
                   
                    require_once (PARENT_DIR . '/function_gantt_chart.php');
                    
                    $allchallengedata=getAgencyChallenge($agencyname,$host,$chart_data,$daterange,$number_of_agencies);
                   
                    draw_gantt_chart($allchallengedata,$agencyname,$task,$chart_data,$report_on,$host,$daterange,$number_of_agencies,$callfor);
                    
                }
                
                exit;
                
            }
    
});
add_action("wp_ajax_challenge_request_new_email", "challenge_send_new_email");
add_action("wp_ajax_nopriv_challenge_request_new_email", "challenge_send_new_email");
add_action('wp_head',function()
{
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function() {
     jQuery("#requestnewemail").on("click",function(){
        var username =  jQuery(this).data("username");
        var email = jQuery(this).data("email");
       
        jQuery.ajax({
	type : 'post',
	url: "<?php echo admin_url('admin-ajax.php');?>",
	data: {
	    
            'action':'challenge_request_new_email',
            'username': username,
	    'useremail' : email,
        },
	beforeSend: function($){
            jQuery('#requestnew_message').fadeOut();
        },
        success : function( response ) {
            jQuery('#requestnew_message').fadeIn().html("Another activation email has been sent to "+email);
            if (response==0) {
                jQuery('#ganttchart').show().html("Sorry, No data found!");
               }
        },
	  error : function(  ) {
		jQuery("#requestnew_message").addClass('alert-danger');
		jQuery("#requestnew_message").show().html('Sorry!, An error occur while procesing your input.');
                
	 }
	 
	 
    });
        
    });
    });
    </script>
    <?php
            
});
function challenge_send_new_email()
{
    $username=$_POST['username'];
    $useremail=$_POST['email'];
    do_shortcode( '[request-for-new-email userid='.$username.' useremail='.$useremail.']' );
}

add_action('wp_head',function()
    {
    if(is_page('All charts')) 
    {
        
      
        ?>
        
         <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
            
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript">
            
            $(function() {
            $( "#datepicker_start" ).datepicker();
            $( "#datepicker_end" ).datepicker();
            });
             
        </script>
        
        <script type="text/javascript">
             jQuery( document ).ready(function($) {
                function decide_chart(AgencyOptions,whichthrough,filter_val)
                {
                    
                    if (AgencyOptions=='agency_selection') {
                        var agencynames=$( "#agency_selection_box" ).val();
                        
                        agencynames=agencynames;
                        
                      
                    }
                    if (AgencyOptions=='top_agencies') {
                        agencynames='none';
                    }
                   
                    jQuery.ajax({
                        type : 'post',
                        url: "<?php echo admin_url('admin-ajax.php');?>",
                        data: {
                            
                            'action':'decide_chart_fields',
                            'AgencyOptions': AgencyOptions,
                            'agencynames':agencynames,
                            
                            'loadthrough' : 'ajaxcall',
                        },
                        beforeSend: function($){
                        jQuery("#legenddiv").hide();
                        jQuery("#filter_report_on").hide();
                        jQuery('#drawchart').empty();
                        jQuery( "h1.entry-title" ).html("<span class='small'>Data Visualization Reports<span>");
                        
                        //jQuery('#agencynamediv').empty();
                        jQuery('#chart_div .dropdown ul').empty();
                        jQuery('#chart_div .dropdown ul').prepend('<img id="loading" src="<?php echo get_bloginfo('template_directory');?>/images/ajax-loader.gif" />');
                        jQuery('#chart_report_data .dropdown ul').empty();
                        jQuery('#chart_report_data .dropdown ul').prepend('<img id="loading" src="<?php echo get_bloginfo('template_directory');?>/images/ajax-loader.gif" />');
                        
                      },
                    success : function( response ) {
                   
                        jQuery('#chart_div .dropdown ul').empty();
                        jQuery('#chart_report_data .dropdown ul').empty();
                        
                        respArray=response.split("||");
                        
                        jQuery('#chart_div .dropdown ul').fadeIn().html(respArray[0]);
                        
                        jQuery('#chart_report_data .dropdown ul').fadeIn().html(respArray[1]);
                        jQuery("#line_report_data").hide();
                        $("input[type=radio][name='chart_data']").click(function(){
                            var reporton=$("input[type=radio][name='display_selection']:checked").val();
                            load_chart_field(this.value,reporton);
                        }); 
                         jQuery("input[type=radio][name='chart_type']").click(function(){
                            loadreportonfields(this.value,jQuery("input[type=radio][name='chart_data']:checked").val());
                         });
                         
                        if (response==0) {
                         jQuery('#chart_div').show().html("Sorry, No data found!");
                        }
                        
                        if (whichthrough=="filterthrough") {
                            
                            if (filter_val!="") {
                               var filter_vars = filter_val.split('&');
                                for (var i = 0; i < filter_vars.length; i++) 
                                {
                                    var filter_param = filter_vars[i].split('=');
                                   
                                    switch(filter_param[0])
                                    {
                                        case 'ROAG':
                                            var a = filter_param[1].split(':');
                                            $(".mutliSelect:eq(0) #agencydiv .secondSelect ul li input:eq("+(a[0]-1)+")").prop('checked', true);
                                            
                                            /*if(a[0] == '1' && a[1] != undefined)
                                                $("#agency_selection_box option[value='"+a[1]+"']").attr("selected","selected");
                                            if(a[0] == '2' && a[1] != undefined)
                                                $("#number_of_agencies").val(a[1]);*/
                                            break;
                                        
                                        case 'CT':
                                            
                                            $(".mutliSelect:eq(2) ul li input:eq("+(filter_param[1]-1)+")").prop('checked', true);
                                            break;
                                        case 'RD':
                                            $(".mutliSelect:eq(1) ul li input:eq("+(filter_param[1]-1)+")").prop('checked', true);
                                            if ((filter_param[1]-1)>=7) {
                                                var reporton=$("input[type=radio][name='display_selection']:checked").val();
                                                var chartdata=$("input[type=radio][name='chart_data']:checked").val();
                                                
                                                load_chart_field(chartdata,reporton);
                                            }
                                            break;
                                        case 'RS':
                                            $("input[type=radio][name='range_selection']:eq("+(filter_param[1]-1)+")").prop('checked', true);
                                            break;
                                        case 'HP':
                                            var h = filter_param[1].split(',');
                                            $.each(h, function(key, value){
                                                $(".mutliSelect:eq(3) ul li input:eq("+(value-1)+")").prop('checked', true);
                                            });
                                            break;
                                        case 'ROCHL':
                                            var c = filter_param[1].split(':');
                                            $(".mutliSelect:eq(3) .secondSelects-box > .secondSelect ul li input:eq("+(c[0]-1)+")").prop('checked', true);    
                                            if(c[0] == '2' && c[1] != undefined)
                                                $("#number_of_challenges").val(c[1]);
                                            break;
                                        
                                        case 'DPST':
                                            $("#datepicker_start").val(filter_param[1]);
                                            break;
                                        case 'DPEND':
                                            $("#datepicker_end").val(filter_param[1]);
                                            break;
                                    }
                                }
                            }
                            
                        }
                    },
                    error : function(  ) {
                    jQuery("#chart_div").addClass('alert-danger');
                    jQuery("#chart_div").show().html('Sorry!, An error occur while procesing your input.');
                
                 }
                });
                    
                
            }
            $('ul.saved-filters li a.saved-filter').on('click', function () {
                
                $('ul.saved-filters li').removeClass();
             $(this).closest('li').addClass("active-filters"); 
            var filter_val = $(this).attr('filter-value');
            var filter_vars = filter_val.split('&');
            $(".mutliSelect:eq(3) ul li input:eq(0)").prop('checked', false);
            $(".mutliSelect:eq(3) ul li input:eq(1)").prop('checked', false);
            $("#datepicker_start").val("");
            $("#datepicker_end").val("");
            $("#agency_selection_box").find('option').removeAttr("selected");
            
            for (var i = 0; i < filter_vars.length; i++) 
            {
                var filter_param = filter_vars[i].split('=');
                
                if(filter_param[0]=='ROAG')
                {
                     var a = filter_param[1].split(':');
                  
                    $(".mutliSelect:eq(0) #agencydiv .secondSelect ul li input:eq("+(a[0]-1)+")").prop('checked', true);                  
                                                
                    if(a[0] == '1' && a[1] != undefined) {
                        //$("#agency_selection_box option[value='"+a[1]+"']").attr("selected","selected");
                        $("#agency_selection_box").val(a[1]);
                        decide_chart('agency_selection','filterthrough',filter_val);
                    }
                    if(a[0] == '2' && a[1] != undefined)
                    {
                        $("#number_of_agencies").val(a[1]);
                        decide_chart('top_agencies','filterthrough',filter_val);
                    }
                    
                   
                   
                    
                }
            }
            
            /*$('.mutliSelect:eq(0) input[type="radio"], .mutliSelect:eq(1) input[type="radio"], .mutliSelect:eq(3) input[type="radio"]').each(function(){
                if($(this).is(':checked'))
                    updateRadioSelections($(this));
            });
            $('.mutliSelect:eq(2) input[type="checkbox"]').each(function(){
                updateCheckboxSelections($(this));
            });*/
        return false;
      });
                $( "h1.entry-title" ).html("<span class='small'>Data Visualization Reports<span>");
                $("#legenddiv").hide();
               
                jQuery("input[type=radio][name='chart_type']").change(function(){
                    loadreportonfields(this.value,jQuery("input[type=radio][name='chart_data']:checked").val());
                });
               $("#agency_selection_box").change(function() {
                        $("#pick_agency").prop('checked',true);
                        $('#number_of_agencies').val('');
                        decide_chart('agency_selection','submitthrough','');
                    }
                );
               $("input[type=radio][name='display_selection']").click(function() {
                
                    if($(this).val()=="agency_selection")
                    {
                        $('#number_of_agencies').val('');
                    }
                    if($(this).val()=="top_agencies")
                    {
                        $('#agency_selection_box').val('all');
                    }
                    decide_chart(this.value,'submitthrough','');
               });
              
                
	 
                function load_chart(chart_form_data)
                {
                    var host_platform=[];
                    var chartformdataarray=chart_form_data.split("||");
                    if (chartformdataarray[2]!="") {
                       host_platform_temp=chartformdataarray[2].split(",");
                        host_platform[0]=host_platform_temp[0];
                        host_platform[1]=host_platform_temp[1];
                    }
                    var submission_start=Date.parse(chartformdataarray[6]);
                   if (Date.parse(chartformdataarray[7])<Date.parse(chartformdataarray[6])) {
                        jQuery("#drawchart").addClass('alert-danger');
                        jQuery("#drawchart").html('Submission end date should be greater than submission start date');
                        return false;
                   }
                   if (chartformdataarray[3]=="agency_selection" && chartformdataarray[4]=="") {
                        jQuery("#drawchart").addClass('alert-danger');
                        jQuery("#drawchart").html('Please select an agency');
                        return false;
                   }
                   else{
                    jQuery("#drawchart").removeClass('alert-danger');
                   }
                    
                    jQuery.ajax({
                        type : 'post',
                        url: "<?php echo admin_url('admin-ajax.php');?>",
                        data: {
                    
                            'action':'load_chart_data',
                            'chart_type': chartformdataarray[0],
                            'host_platform[]':host_platform,
                            'chart_data':chartformdataarray[1],
                            'display_selection':chartformdataarray[3],
                            'submission_start_from':chartformdataarray[6],
                            'submission_end_to':chartformdataarray[7],
                            'number_of_agencies':chartformdataarray[5],
                            'agency_selection_box':chartformdataarray[4],
                            'range_selection':chartformdataarray[8],
                            'loadthrough' : 'ajaxcall',
                        },
                        beforeSend: function($){
                        
                        jQuery('#legenddiv').show().empty(); 
                        jQuery('#drawchart').empty();
                        jQuery('#drawchart').prepend('<div style="width:100%;text-align:center;"><img id="loading" src="<?php echo get_bloginfo('template_directory');?>/images/ajax-loader.gif" /></div>');
                        
                      },
                success : function( response ) {
                        
                        $('html, body').animate({scrollTop : 200},1000,function(){
                          jQuery('#drawchart').empty();
                          eval(response);
                          //jQuery('#drawchart').html(response);
                         
                       
                        });
                        $('ul.saved-filters li a.saved-filter').on('click', function () {
                
                    $('ul.saved-filters li').removeClass();
                    $(this).closest('li').addClass("active-filters"); 
                    var filter_val = $(this).attr('filter-value');
                            var filter_vars = filter_val.split('&');
                    $(".mutliSelect:eq(3) ul li input:eq(0)").prop('checked', false);
                    $(".mutliSelect:eq(3) ul li input:eq(1)").prop('checked', false);
                    
                    for (var i = 0; i < filter_vars.length; i++) 
                    {
                        var filter_param = filter_vars[i].split('=');
                        
                        if(filter_param[0]=='ROAG')
                        {
                             var a = filter_param[1].split(':');
                            if(a[0] == '1' && a[1] != undefined) {
                                decide_chart('agency_selection','filterthrough',filter_val);
                            }
                            if(a[0] == '2' && a[1] != undefined)
                            {
                                decide_chart('top_agencies','filterthrough',filter_val);
                            }
                            
                           
                           
                            
                        }
                    }
                });
                        if (response==0) {
                         jQuery('#drawchart').html("Sorry, No data found!");
                        }
                        
                        
                 },
                error : function(  ) {
                    jQuery("#drawchart").addClass('alert-danger');
                    jQuery("#drawchart").html('Sorry!, An error occur while procesing your input.');
                
                 }
                });
            }
                
                function loadreportonfields(charttype,chartdata) {
                    
                    if(charttype=="line")
                    {
                        jQuery("#line_report_data").show();
                      
                    }
                    else{
                        jQuery("#line_report_data").hide();
                        jQuery("#range_fiscal_selection").prop('checked', false);
                        jQuery("#range_month_selection").prop('checked', false);
                       
                    }
                }
                function load_chart_field(chartdata,reporton)
                {
                jQuery("#legenddiv").hide();
                jQuery("#filter_report_on").hide();
                jQuery('#drawchart').empty();
                jQuery( "h1.entry-title" ).html("<span class='small'>Data Visualization Reports<span>");
                var agencynames=$( "#agency_selection_box" ).val();
                //jQuery('#agencynamediv').empty();
             
                jQuery.ajax({
                        type : 'post',
                        url: "<?php echo admin_url('admin-ajax.php');?>",
                        data: {
                            
                            'action':'select_chart_field',
                            'agencynames':agencynames,
                            'chartdata': chartdata,
                            'reporton':reporton,
                            'loadthrough' : 'ajaxcall',
                        },
                        beforeSend: function($){
                       
                        jQuery('#chart_div .dropdown ul').empty();
                        jQuery('#chart_div .dropdown ul').prepend('<img id="loading" src="<?php echo get_bloginfo('template_directory');?>/images/ajax-loader.gif" />');
                        
                        
                      },
                    success : function( response ) {
                   
                        jQuery('#chart_div .dropdown ul').empty();
                        jQuery('#chart_div .dropdown ul').fadeIn().html(response);
                        
                        jQuery("input[type=radio][name='chart_type']").click(function(){
                            loadreportonfields(this.value,jQuery("input[type=radio][name='chart_data']:checked").val());
                         });
                        if (response==0) {
                         jQuery('#chart_div').show().html("Sorry, No data found!");
                        }
                    },
                    error : function(  ) {
                    jQuery("#chart_div").addClass('alert-danger');
                    jQuery("#chart_div").show().html('Sorry!, An error occur while procesing your input.');
                
                 }
	 
                 });
            }
               $("#pie_type").prop('checked',true);
        
               $("input[type=radio][name='chart_data']").click(function(){
                    var reporton=$("input[type=radio][name='display_selection']:checked").val();
                    
                    load_chart_field(this.value,reporton);
                 });
               
              
            
            $("#submit").click(function () {
                jQuery('#legenddiv').empty();
                jQuery('#drawchart').empty();
               
                jQuery( "h1.entry-title" ).html("<span class='small'>Data Visualization Reports<span>");
                
                //jQuery('#agencynamediv').empty();
                jQuery("#sortdata").val($("#sortdata option:first").val());
                if($("input[type=radio][name='display_selection']:checked").val()=="top_agencies" && $('#number_of_agencies').val()=="")
                {
                    jQuery("#drawchart").addClass('alert-danger');
                    jQuery("#drawchart").show().html('Please enter number in a top agencies textbox');
                    return false;
                }

                var charttype=$("input[type=radio][name='chart_type']:checked").val();
                var chart_data=$("input[type=radio][name='chart_data']:checked").val();
                
               
                var host_platform_temp= [];
                //var host_platform_temp=$("input[name='host_platform[]:checked");
                var i=0;
                $.each($("input[name='host_platform[]']:checked"), function() {
                    host_platform_temp[i]=($(this).val());
                    i++;
                  });
               
                
                var display_selection=$("input[type=radio][name='display_selection']:checked").val();
                var agency_selection_box=$("#agency_selection_box").val();
                var number_of_agencies=$("#number_of_agencies").val();
                var submission_start_from=$("input[type=text][name='submission_start_from']").val();
                var submission_end_to=$("input[type=text][name='submission_end_to']").val();
                var range_selection=$("input[type=radio][name='range_selection']:checked").val();
                var finaldata;
                finaldata=charttype+"||"+chart_data+"||"+host_platform_temp+"||"+display_selection+"||"+agency_selection_box+"||"+number_of_agencies+"||"+submission_start_from+"||"+submission_end_to+"||"+range_selection;
                            
                load_chart(finaldata);
                return false;
            });
              
            jQuery("#number_of_challenges").focus(function() {
               $("#top_challenges").prop('checked',true);
            });
            jQuery("#number_of_challenges").focusout(function() {
                $("#errmsgchallenges").hide();
            });
            
            jQuery("#number_of_challenges").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               //display error message
               $("#errmsgchallenges").html("Digits Only").show();
                      return false;
           }
           else{
             $("#errmsgchallenges").hide();
           }
          });
            
              jQuery("#number_of_agencies").focus(function() {
               $("#top_agencies").prop('checked',true);
            });
            jQuery("#number_of_agencies").focusout(function() {
                $("#errmsgagencies").hide();
            });
            
            jQuery("#number_of_agencies").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               //display error message
               if(e.which==13)
               {
                    $("#errmsgagencies").html("The ENTER key is not an allowed command. Please enter digits only.").show();
               }
               else
               {
                    $("#errmsgagencies").html("Digits Only").show();
               }
               
                      return false;
           }
           else{
             $("#errmsgchallenges").hide();
           }
          });
    });
      
           
        </script>
        <?php
    }
    
    });
   

/*add_action( 'after_setup_theme', 'challenge_post_script' );
if ( ! function_exists( 'skeleton_setup' ) ):

function challenge_post_script(){
	require_once (PARENT_DIR . '/challenge-post-process.php');
}
endif;*/

/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 */
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

if (!function_exists('optionsframework_custom_scripts')) {

    function optionsframework_custom_scripts() { ?>

        <script type="text/javascript">
            jQuery(document).ready(function() {

                jQuery('#use_logo_image').click(function() {
                    jQuery('#section-header_logo,#section-logo_width,#section-logo_height').fadeToggle(400);
                });

                if (jQuery('#use_logo_image:checked').val() !== undefined) {
                    jQuery('#section-header_logo,#section-logo_width,#section-logo_height').show();
                }

            });
        </script>

    <?php
    }
}
// Register Core Stylesheets
// These are necessary for the theme to function as intended
// Supports the 'Better WordPress Minify' plugin to properly minimize styleshsets into one.
// http://wordpress.org/extend/plugins/bwp-minify/

if ( !function_exists( 'st_registerstyles' ) ) {

    add_action('get_header', 'st_registerstyles');
    function st_registerstyles() {
        $theme  = wp_get_theme();
        $version = $theme['Version'];

        //start challenge_gov_theme
        $stylesheets .= wp_enqueue_style('bootstrap', get_bloginfo('stylesheet_directory').'/bootstrap.css', array(), $version, 'screen, projection');
        $stylesheets .= wp_enqueue_style('theme', get_bloginfo('stylesheet_directory').'/style.css', array('bootstrap'));        
        $stylesheets .= wp_enqueue_style('bootstrap-responsive', get_bloginfo('stylesheet_directory').'/bootstrap-responsive.css', 'bootstrap', $version, 'screen, projection');
        $stylesheets .= wp_enqueue_style('fontawesome', get_bloginfo('stylesheet_directory').'/font-awesome/css/font-awesome.min.css', 'bootstrap', $version, 'screen, projection');

        //end challenge_gov_theme

        if ( class_exists( 'jigoshop' ) ) {
           // $stylesheets .= wp_enqueue_style('jigoshop', get_bloginfo('template_directory').'/jigoshop.css', 'theme', $version, 'screen, projection');
        }
        echo apply_filters ('child_add_stylesheets',$stylesheets);
    }

}

// Build Query vars for dynamic theme option CSS from Options Framework

if ( !function_exists( 'production_stylesheet' )) {

    function production_stylesheet($public_query_vars) {
        $public_query_vars[] = 'get_styles';
        return $public_query_vars;
    }
    add_filter('query_vars', 'production_stylesheet');
}

if ( !function_exists( 'theme_css' ) ) {

    add_action('template_redirect', 'theme_css');
    function theme_css(){
        $css = get_query_var('get_styles');
        if ($css == 'css'){
            include_once (PARENT_DIR . '/style.php');
            exit;  //This stops WP from loading any further
        }
    }

}

if ( !function_exists( 'st_header_scripts' ) ) {

    add_action('init', 'st_header_scripts');
    function st_header_scripts() {
        $javascripts  = wp_enqueue_script('jquery');
 
        // start challenge_gov_theme
        
        $javascripts .= wp_enqueue_script('custom',get_bloginfo('template_url') ."/javascripts/app.js",array('jquery'),'1.2.3',true);
        $javascripts .= wp_enqueue_script('jquery',get_bloginfo('template_url') ."/javascripts/jquery-1.10.2.min.js",array('jquery'),'1.2.3',false);
        $javascripts .= wp_enqueue_script('bootstrap',get_bloginfo('template_url') ."/javascripts/bootstrap.min.js",array('jquery'),'1.2.3',false);
        $javascripts .= wp_enqueue_script('classie',get_bloginfo('template_url') ."/javascripts/bower_components/classie/classie.js",array('jquery'),'1.2.3',false);
        // end challenge_gov_theme


        echo apply_filters ('child_add_javascripts',$javascripts);
    }

}

// Instead of remove_filter('the_content', 'wpautop');
// The function below removes wp_autop from specified pages with a custom field:
// Name: wpautop Value: false

function st_remove_wpautop($content) {
    global $post;
    // Get the keys and values of the custom fields:
    $rmwpautop = get_post_meta($post->ID, 'wpautop', true);
    // Remove the filter
    remove_filter('the_content', 'wpautop');
    if ('false' === $rmwpautop) {
    } else {
        add_filter('the_content', 'wpautop');
    }
    return $content;
}
// Hook into the Plugin API
add_filter('the_content', 'st_remove_wpautop', 9);


/** Tell WordPress to run skeleton_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'skeleton_setup' );

if ( ! function_exists( 'skeleton_setup' ) ):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     *
     * To override skeleton_setup() in a child theme, add your own skeleton_setup to your child theme's
     * functions.php file.
     *
     * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
     * @uses register_nav_menus() To add support for navigation menus.
     * @uses add_editor_style() To style the visual editor.
     * @uses load_theme_textdomain() For translation/localization support.
     * @uses add_custom_image_header() To add support for a custom header.
     * @uses register_default_headers() To register the default custom header images provided with the theme.
     * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
     *
     * @since Skeleton 1.0
     */
    function skeleton_setup() {

        if ( class_exists( 'bbPress' ) ) {
            add_theme_support( 'bbpress' );
        }
        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();

        // Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
        // add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

        // This theme uses post thumbnails
        add_theme_support( 'post-thumbnails' );

        // Add default posts and comments RSS feed links to head
        add_theme_support( 'automatic-feed-links' );

        // Register the available menus
        register_nav_menus( array(
            'primary' => __( 'Primary Navigation', 'skeleton' ),
        ));

        // Make theme available for translation
        // Translations can be filed in the /languages/ directory
        load_theme_textdomain( 'smpl', PARENT_DIR . '/languages' );

        $locale = get_locale();
        $locale_file = PARENT_DIR . "/languages/$locale.php";
        if ( is_readable( $locale_file ) )
            require_once( $locale_file );


        // No support for text inside the header image.
        if ( ! defined( 'NO_HEADER_TEXT' ) )
            define( 'NO_HEADER_TEXT', true );

        if ( ! defined( 'HEADER_IMAGE_WIDTH') )
            define( 'HEADER_IMAGE_WIDTH', apply_filters( 'skeleton_header_image_width',960));


        if ( ! defined( 'HEADER_IMAGE_HEIGHT') )
            define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'skeleton_header_image_height',185 ));

        // Add a way for the custom header to be styled in the admin panel that controls
        // custom headers. See skeleton_admin_header_style(), below.
        add_custom_image_header( '', 'skeleton_admin_header_style' );

        // ... and thus ends the changeable header business.

        // Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
        register_default_headers( array(
            'berries' => array(
                'url' => '%s/images/headers/berries.jpg',
                'thumbnail_url' => '%s/images/headers/berries-thumbnail.jpg',
                /* translators: header image description */
                'description' => __( 'Berries', 'skeleton' )
            ),
            'cherryblossom' => array(
                'url' => '%s/images/headers/cherryblossoms.jpg',
                'thumbnail_url' => '%s/images/headers/cherryblossoms-thumbnail.jpg',
                /* translators: header image description */
                'description' => __( 'Cherry Blossoms', 'skeleton' )
            ),
            'concave' => array(
                'url' => '%s/images/headers/concave.jpg',
                'thumbnail_url' => '%s/images/headers/concave-thumbnail.jpg',
                /* translators: header image description */
                'description' => __( 'Concave', 'skeleton' )
            ),
            'fern' => array(
                'url' => '%s/images/headers/fern.jpg',
                'thumbnail_url' => '%s/images/headers/fern-thumbnail.jpg',
                /* translators: header image description */
                'description' => __( 'Fern', 'skeleton' )
            ),
            'forestfloor' => array(
                'url' => '%s/images/headers/forestfloor.jpg',
                'thumbnail_url' => '%s/images/headers/forestfloor-thumbnail.jpg',
                /* translators: header image description */
                'description' => __( 'Forest Floor', 'skeleton' )
            ),
            'inkwell' => array(
                'url' => '%s/images/headers/inkwell.jpg',
                'thumbnail_url' => '%s/images/headers/inkwell-thumbnail.jpg',
                /* translators: header image description */
                'description' => __( 'Inkwell', 'skeleton' )
            ),
            'path' => array(
                'url' => '%s/images/headers/path.jpg',
                'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',
                /* translators: header image description */
                'description' => __( 'Path', 'skeleton' )
            ),
            'sunset' => array(
                'url' => '%s/images/headers/sunset.jpg',
                'thumbnail_url' => '%s/images/headers/sunset-thumbnail.jpg',
                /* translators: header image description */
                'description' => __( 'Sunset', 'skeleton' )
            )
        ) );
        //require_once (PARENT_DIR . '/challenge-post-process.php');
        //get_template_part('challenge-post-process');
    }
endif;

/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in skeleton_setup().
 *
 * @since Skeleton 1.0
 */
if ( !function_exists( 'skeleton_admin_header_style' ) ) :

    function skeleton_admin_header_style() {
        ?>
        <style type="text/css">
            /* Shows the same border as on front end */
            #headimg {
                border-bottom: 100px solid #000;
                border-top: 4px solid #000;
            }
            /* If NO_HEADER_TEXT is false, you would style the text with these selectors:
                #headimg #name { }
                #headimg #desc { }
            */
        </style>
    <?php
    }
endif;

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Skeleton 1.0
 * @return int
 */
if ( !function_exists( 'skeleton_excerpt_length' ) ) {

    function skeleton_excerpt_length( $length ) {
        return 40;
    }
    add_filter( 'excerpt_length', 'skeleton_excerpt_length' );

}
/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Skeleton 1.0
 * @return string "Continue Reading" link
 */

if ( !function_exists( 'skeleton_continue_reading_link' ) ) {

    function skeleton_continue_reading_link() {
        return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'skeleton' ) . '</a>';
    }
}
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and skeleton_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Skeleton 1.0
 * @return string An ellipsis
 */

if ( !function_exists( 'skeleton_auto_excerpt_more' ) ) {

    function skeleton_auto_excerpt_more( $more ) {
        return ' &hellip;' . skeleton_continue_reading_link();
    }
    add_filter( 'excerpt_more', 'skeleton_auto_excerpt_more' );

}
/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Skeleton 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
if ( !function_exists( 'skeleton_custom_excerpt_more' ) ) {

    function skeleton_custom_excerpt_more( $output ) {
        if ( has_excerpt() && ! is_attachment() ) {
            $output .= skeleton_continue_reading_link();
        }
        return $output;
    }
    add_filter( 'get_the_excerpt', 'skeleton_custom_excerpt_more' );

}
/**
 * Removes inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Skeleton's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Skeleton 1.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override st_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @uses register_sidebar
 */
//

if ( !function_exists( 'remove_more_jump_link' ) ) {

    function remove_more_jump_link($link) {
        $offset = strpos($link, '#more-');
        if ($offset) {
            $end = strpos($link, '"',$offset);
        }
        if ($end) {
            $link = substr_replace($link, '', $offset, $end-$offset);
        }
        return $link;
    }
    add_filter('the_content_more_link', 'remove_more_jump_link');

}

if ( !function_exists( 'st_widgets_init' ) ) {

    function st_widgets_init() {
        // Area 1, located at the top of the sidebar.
        register_sidebar( array(
            'name' => __( 'Posts Widget Area', 'skeleton' ),
            'id' => 'primary-widget-area',
            'description' => __( 'Shown only in Blog Posts, Archives, Categories, etc.', 'skeleton' ),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );


        // Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
        register_sidebar( array(
            'name' => __( 'Pages Widget Area', 'skeleton' ),
            'id' => 'secondary-widget-area',
            'description' => __( 'Shown only in Pages', 'skeleton' ),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );

        // Area 3, located in the footer. Empty by default.
        register_sidebar( array(
            'name' => __( 'First Footer Widget Area', 'skeleton' ),
            'id' => 'first-footer-widget-area',
            'description' => __( 'The first footer widget area', 'skeleton' ),
            'before_widget' => '<div class="%1$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );

        // Area 4, located in the footer. Empty by default.
        register_sidebar( array(
            'name' => __( 'Second Footer Widget Area', 'skeleton' ),
            'id' => 'second-footer-widget-area',
            'description' => __( 'The second footer widget area', 'skeleton' ),
            'before_widget' => '<div class="%1$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );

        // Area 5, located in the footer. Empty by default.
        register_sidebar( array(
            'name' => __( 'Third Footer Widget Area', 'skeleton' ),
            'id' => 'third-footer-widget-area',
            'description' => __( 'The third footer widget area', 'skeleton' ),
            'before_widget' => '<div class="%1$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );

        // Area 6, located in the footer. Empty by default.
        register_sidebar( array(
            'name' => __( 'Fourth Footer Widget Area', 'skeleton' ),
            'id' => 'fourth-footer-widget-area',
            'description' => __( 'The fourth footer widget area', 'skeleton' ),
            'before_widget' => '<div class="%1$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );

        // Register bbPress sidebar if plugin is installed
        if ( class_exists( 'bbPress' ) ) {
            register_sidebar( array(
                'name' => __( 'Forum Sidebar', 'skeleton' ),
                'id' => 'bbpress-widget-area',
                'description' => __( 'Sidebar displayed in forum', 'skeleton' ),
                'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ) );
        }

        // Register Jigoshop Cart sidebar if plugin is installed
        if ( class_exists( 'jigoshop' ) ) {
            register_sidebar( array(
                'name' => __( 'Jigoshop Sidebar', 'skeleton' ),
                'id' => 'shop-widget-area',
                'description' => __( 'Sidebar displayed in Jigoshop pages', 'skeleton' ),
                'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ) );
        }

        register_sidebar(array(
            'name' => __( 'Challenge Sidebar' ),
            'id' => 'challenge-sidebar',
            'description' => __( 'Widgets in this area will be shown on the right-hand side of the challenge details.' ),
            'before_title' => '<h1>',
            'after_title' => '</h1>'
        ));

        register_sidebar(array(
            'name' => __( 'Challenge Footer' ),
            'id' => 'challenge-footer',
            'description' => __( 'Widgets in this area will be shown on the right-hand side of the challenge details.' ),
            'before_title' => '<h1>',
            'after_title' => '</h1>'
        ));
	  
	  	register_sidebar(array(
            'name' => __( 'Challenge Blog Landing Page Sidebar' ),
            'id' => 'challenge-blog-landing',
            'description' => __( 'Widgets in this area will be shown on the right-hand side of the challenge blog landing page.' ),
            'before_title' => '<h1>',
            'after_title' => '</h1>'
        ));

        register_sidebar(array(
            'name' => __( 'Challenge Blog Individual Pages Sidebar' ),
            'id' => 'challenge-blog-individual',
            'description' => __( 'Widgets in this area will be shown on the right-hand side of the challenge blog individual pages.' ),
            'before_title' => '<h1>',
            'after_title' => '</h1>'
        ));

    }
    /** Register sidebars by running skeleton_widgets_init() on the widgets_init hook. */
    add_action( 'widgets_init', 'st_widgets_init' );

}

/** Comment Styles */

if ( ! function_exists( 'st_comments' ) ) :
    function st_comments($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="single-comment clearfix">
            <div class="comment-author vcard"> <?php echo get_avatar($comment,$size='64',$default='<path_to_url>' ); ?></div>
            <div class="comment-meta commentmetadata">
                <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php _e('Comment is awaiting moderation','smpl');?></em> <br />
                <?php endif; ?>
                <h6><?php echo __('By','smpl').' '.get_comment_author_link(). ' '. get_comment_date(). '  -  ' . get_comment_time(); ?></h6>
                <?php comment_text() ?>
                <?php edit_comment_link(__('Edit comment','smpl'),'  ',''); ?>
                <?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply','smpl'),'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
            </div>
        </div>
        <!-- </li> -->
    <?php  }
endif;

if ( ! function_exists( 'skeleton_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     *
     * @since Skeleton 1.0
     */
    function skeleton_posted_on() {
        printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'skeleton' ),
            'meta-prep meta-prep-author',
            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                get_permalink(),
                esc_attr( get_the_time() ),
                get_the_date()
            ),
            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
                get_author_posts_url( get_the_author_meta( 'ID' ) ),
                sprintf( esc_attr__( 'View all posts by %s', 'skeleton' ), get_the_author() ),
                get_the_author()
            )
        );
    }

endif;

if ( ! function_exists( 'skeleton_posted_in' ) ) :
    /**
     * Prints HTML with meta information for the current post (category, tags and permalink).
     *
     * @since Skeleton 1.0
     */
    function skeleton_posted_in() {
        // Retrieves tag list of current post, separated by commas.
        $tag_list = get_the_tag_list( '', ', ' );
        if ( $tag_list ) {
            $posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'skeleton' );
        } elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
            $posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'skeleton' );
        } else {
            $posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'skeleton' );
        }
        // Prints the string, replacing the placeholders.
        printf(
            $posted_in,
            get_the_category_list( ', ' ),
            $tag_list,
            get_permalink(),
            the_title_attribute( 'echo=0' )
        );
    }

endif;


// Header Functions

// Hook to add content before header

if ( !function_exists( 'st_above_header' ) ) {

    function st_above_header() {
        do_action('st_above_header');
    }

} // endif

// Primary Header Function

if ( !function_exists( 'st_header' ) ) {

    function st_header() {
        do_action('st_header');
    }

}


// Opening #header div with flexible grid

if ( !function_exists( 'st_header_open' ) ) {

    function st_header_open() {
        echo "<div id=\"header\" class=\"sixteen columns\">\n<div class=\"inner\">\n";
    }
} // endif

add_action('st_header','st_header_open', 1);


// Hookable theme option field to add add'l content to header
// Child Theme Override: child_header_extras();

if ( !function_exists( 'st_header_extras' ) ) {

    function st_header_extras() {
        if (of_get_option('header_extra')) {
            $extras  = "<div class=\"header_extras\">";
            $extras .= of_get_option('header_extra');
            $extras .= "</div>";
            echo apply_filters ('child_header_extras',$extras);
        }
    }
} // endif

add_action('st_header','st_header_extras', 2);


// Build the logo
// Child Theme Override: child_logo();
if ( !function_exists( 'st_logo' ) ) {

    function st_logo() {
        // Displays H1 or DIV based on whether we are on the home page or not (SEO)
        $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
        if (of_get_option('use_logo_image')) {
            $class="graphic";
        } else {
            $class="text";
        }
        // echo of_get_option('header_logo')
        $st_logo  = '<'.$heading_tag.' id="site-title" class="'.$class.'"><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo('name','display')).'">'.get_bloginfo('name').'</a></'.$heading_tag.'>'. "\n";
        $st_logo .= '<span class="site-desc '.$class.'">'.get_bloginfo('description').'</span>'. "\n";
        echo apply_filters ( 'child_logo' , $st_logo);
    }
} // endif

add_action('st_header','st_logo', 3);



if ( !function_exists( 'logostyle' ) ) {

    function logostyle() {
        if (of_get_option('use_logo_image')) {
            echo '<style type="text/css">
	#header #site-title.graphic a {background-image: url('.of_get_option('header_logo').');width: '.of_get_option('logo_width').'px;height: '.of_get_option('logo_height').'px;}</style>';
        }
    }

} //endif

add_action('wp_head', 'logostyle');



if ( !function_exists( 'st_header_close' ) ) {

    function st_header_close() {
        echo "</div></div><!--/#header-->";
    }
} //endif

add_action('st_header','st_header_close', 4);



// Hook to add content after header

if ( !function_exists( 'st_below_header' ) ) {

    function st_below_header() {
        do_action('st_below_header');
    }

} //endif


// End Header Functions


// Navigation (menu)
if ( !function_exists( 'st_navbar' ) ) {

    function st_navbar() {
        echo '<div id="navigation" class="row sixteen columns">';
        wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary'));
        echo '</div><!--/#navigation-->';
    }

} //endif

// Before Content - st_before_content($columns);
// Child Theme Override: child_before_content();

if ( !function_exists( 'st_before_content' ) ) {

    function st_before_content($columns) {
        //
        // Specify the number of columns in conditional statements
        // See http://codex.wordpress.org/Conditional_Tags for a full list
        //
        // If necessary, you can pass $columns as a variable in your template files:
        // st_before_content('six');
        //
        // Set the default

        if (empty($columns)) {
            $columns = 'eleven';
        } else {
            // Check the function for a returned variable
            $columns = $columns;
        }

        // Example of further conditionals:
        // (be sure to add the excess of 16 to st_before_sidebar as well)

        if (is_page_template('onecolumn-page.php')) {
            $columns = 'sixteen';
        }

        // check to see if bbpress is installed

        if ( class_exists( 'bbPress' ) ) {
            // force wide on bbPress pages
            if (is_bbpress()) {
                $columns = 'sixteen';
            }

            // unless it's the member profile
            if (bbp_is_user_home()) {
                $columns = 'eleven';
            }

        } // bbPress

        // Apply the markup
        echo "<a name=\"top\" id=\"top\"></a>";

        //orig content container
        //echo "<div id=\"content\" class=\"$columns columns\">";

        //start challenge_gov_template
        echo '<div class="row-fluid clearfix">';
        echo '<div class="container">';
        if(is_page('list'))
            echo    '<div class="thumbnails">';
       // echo        '<div id="site-canvas" class="col-lg-8 col-lg-offset-2 ">';
        //echo           '<ul class="thumbnailnails">';
        //end challenge_gov_template            


    }
}


// After Content

if (! function_exists('st_after_content'))  {
    function st_after_content() {
        if(is_page('list'))
            echo '</div>';
        echo "\t\t</div></div><!-- /.columns (#content) -->\n";
    }
}


// Before Sidebar - do_action('st_before_sidebar')

// call up the action
if ( !function_exists( 'before_sidebar' ) ) {

    function before_sidebar($columns) {
        // You can specify the number of columns in conditional statements
        // See http://codex.wordpress.org/Conditional_Tags for a full list
        //
        // If necessary, you can also pass $columns as a variable in your template files:
        // do_action('st_before_sidebar','six');
        //
        if (empty($columns)) {
            // Set the default
            $columns = 'five';
        } else {
            // Check the function for a returned variable
            $columns = $columns;
        }
        // Example of further conditionals:
        // (be sure to add the excess of 16 to st_before_content as well)
        // if (is_page() || is_single()) {
        // $columns = 'five';
        // } else {
        // $columns = 'four';
        // }
        // Apply the markup
        echo '<div id="sidebar" class="'.$columns.' columns" role="complementary">';
    }
} //endif
// create our hook
add_action( 'st_before_sidebar', 'before_sidebar');

// After Sidebar
if ( !function_exists( 'after_sidebar' ) ) {
    function after_sidebar() {
        // Additional Content could be added here
        echo '</div><!-- #sidebar -->';
    }
} //endif
add_action( 'st_after_sidebar', 'after_sidebar');


// Before Footer

if (!function_exists('st_before_footer'))  {
    function st_before_footer() {
        $footerwidgets = is_active_sidebar('first-footer-widget-area') + is_active_sidebar('second-footer-widget-area') + is_active_sidebar('third-footer-widget-area') + is_active_sidebar('fourth-footer-widget-area');
        $class = ($footerwidgets == '0' ? 'noborder' : 'normal');
        echo '<div class="clear"></div><div id="footer" class="'.$class.' column col-md-12">';
    }
}

if ( !function_exists( 'st_footer' ) ) {

// The Footer
    add_action('wp_footer', 'st_footer');
    do_action('st_footer');
    function st_footer() {
        //loads sidebar-footer.php
        get_sidebar( 'footer' );
        // prints site credits
        echo '<div id="credits">';
        echo of_get_option('footer_text');
        echo '</div>';
    }

}


// After Footer

if (!function_exists('st_after_footer'))  {

    function st_after_footer() {
        echo "</div><!--/#footer-->"."\n";
        echo "</div><!--/#wrap.container-->"."\n";
        // Google Analytics
        if (of_get_option('footer_scripts') <> "" ) {
            echo '<script type="text/javascript">'.stripslashes(of_get_option('footer_scripts')).'</script>';
        }
    }
}



// Enable Shortcodes in excerpts and widgets
add_filter('widget_text', 'do_shortcode');
add_filter( 'the_excerpt', 'do_shortcode');
add_filter('get_the_excerpt', 'do_shortcode');


if (!function_exists('get_image_path'))  {
    function get_image_path() {
        global $post;
        $id = get_post_thumbnail_id();
        // check to see if NextGen Gallery is present
        if(stripos($id,'ngg-') !== false && class_exists('nggdb')){
            $nggImage = nggdb::find_image(str_replace('ngg-','',$id));
            $thumbnail = array(
                $nggImage->imageURL,
                $nggImage->width,
                $nggImage->height
            );
            // otherwise, just get the wp thumbnail
        } else {
            $thumbnail = wp_get_attachment_image_src($id,'full', true);
        }
        $theimage = $thumbnail[0];
        return $theimage;
    }
}

/*
 * override default filter for 'textarea' sanitization.
 */

add_action('admin_init','optionscheck_change_santiziation', 100);

function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'st_custom_sanitize_textarea' );
}

function st_custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
        "src" => array(),
        "type" => array(),
        "allowfullscreen" => array(),
        "allowscriptaccess" => array(),
        "height" => array(),
        "width" => array()
    );
    $custom_allowedtags["script"] = array();
    $custom_allowedtags["a"] = array('href' => array(),'title' => array());
    $custom_allowedtags["img"] = array('src' => array(),'title' => array(),'alt' => array());
    $custom_allowedtags["br"] = array();
    $custom_allowedtags["em"] = array();
    $custom_allowedtags["strong"] = array();
    $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
    $output = wp_kses( $input, $custom_allowedtags);
    return $output;
    $of_custom_allowedtags = array_merge($of_custom_allowedtags, $allowedtags);
    $output = wp_kses( $input, $of_custom_allowedtags);
    return $output;
}

function create_challenge_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Agencies', 'taxonomy general name' ),
        'singular_name'     => _x( 'Agency', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Agencies' ),
        'all_items'         => __( 'All Agencies' ),
        'parent_item'       => __( 'Parent Agency' ),
        'parent_item_colon' => __( 'Parent Agency:' ),
        'edit_item'         => __( 'Edit Agency' ),
        'update_item'       => __( 'Update Agency' ),
        'add_new_item'      => __( 'Add New Agency' ),
        'new_item_name'     => __( 'New Agency Name' ),
        'menu_name'         => __( 'Agencies' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'agency' ),
    );

    register_taxonomy( 'agency', array( 'challenge' ), $args );
}

function create_submission_post_type() {
    $labels = array(
        'name'               => 'Solutions',
        'singular_name'      => 'Solution',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Solution',
        'edit_item'          => 'Edit Solution',
        'new_item'           => 'New Solutions',
        'all_items'          => 'All Solutions',
        'view_item'          => 'View Solution',
        'search_items'       => 'Search Solutions',
        'not_found'          => 'No solutions found',
        'not_found_in_trash' => 'No solutions found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Solutions'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'solution' ),
        //'taxonomies'		 => array('agency'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields')
    );

    register_post_type( 'solution', $args );
}

function create_agency_post_type()
{
    $labels = array(
        'name'                => _x( 'Agencies', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Agency', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Agencies', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Agency:', 'text_domain' ),
        'all_items'           => __( 'All Agencies', 'text_domain' ),
        'view_item'           => __( 'View Agency', 'text_domain' ),
        'add_new_item'        => __( 'Add New Agency', 'text_domain' ),
        'add_new'             => __( 'Add New', 'text_domain' ),
        'edit_item'           => __( 'Edit Agency', 'text_domain' ),
        'update_item'         => __( 'Update Agency', 'text_domain' ),
        'search_items'        => __( 'Search Agency', 'text_domain' ),
        'not_found'           => __( 'No Agencies found', 'text_domain' ),
        'not_found_in_trash'  => __( 'No Agencies found in Trash', 'text_domain' ),
    );
    $args = array(
        'label'               => __( 'agency', 'text_domain' ),
        'description'         => __( 'Agencies and Organizations', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', ),
        'rewrite'             => array( 'slug' => 'agency' ),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'agency', $args );
}

function create_challenge_post_type() {
    $labels = array(
        'name'               => 'Challenges',
        'singular_name'      => 'Challenge',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Challenge',
        'edit_item'          => 'Edit Challenge',
        'new_item'           => 'New Challenge',
        'all_items'          => 'All Challenges',
        'view_item'          => 'View Challenge',
        'search_items'       => 'Search Challenges',
        'not_found'          => 'No challenges found',
        'not_found_in_trash' => 'No challenges found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Challenges'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'challenge' ),
        'taxonomies'		 => array('agency','post_tag'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions')
    );

    register_post_type( 'challenge', $args );
}

function create_challenge_blog_slide_post_type() {
    $labels = array(
        'name'               => 'Featured Blog Slides',
        'singular_name'      => 'Featured Blog Slide',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Blog Slide',
        'edit_item'          => 'Edit Blog Slide',
        'new_item'           => 'New Blog Slide',
        'all_items'          => 'All Blog Slides',
        'view_item'          => 'View Blog Slide',
        'search_items'       => 'Search Blog Slides',
        'not_found'          => 'No blog slides found',
        'not_found_in_trash' => 'No blog slides found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Featured Blog Slides'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'blog_slide' ),
        //'taxonomies'         => array(''),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 19,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions')
    );

    register_post_type( 'challenge_blog_slide', $args );
}

function save_agency_meta( $post_id ) {


    /*
     * In production code, $slug should be set only once in the plugin,
     * preferably as a class property, rather than in each function that needs it.
     */

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    // Prevent quick edit from clearing custom fields
    if (defined('DOING_AJAX') && DOING_AJAX)
        return;

    $slug = 'agency';

    // If this isn't a 'agency' post, don't update it.
    if ( isset($_POST['post_type']) && $slug != $_POST['post_type'] ) {
        return;
    }

    $this_post = get_post( $post_id );

    if ($slug != $this_post->post_type) {
        return;
    }

    $parent_agency_title=find_parent_agency('agency_parent',$post_id);
    
    $cat_term_id=get_term_by('name', $parent_agency_title, 'agency');
    $parent_cat_id=$cat_term_id->term_id;
    
    $new_agency = array(
        'cat_name' => $this_post->post_title,
        'category_nicename' => $this_post->post_name,
        'taxonomy' => 'agency',
        'category_parent' => $parent_cat_id);

    $term = term_exists($this_post->post_title, 'agency');

    //if title does not exist, create new tax with this title and slug
    if ($term === 0 || $term === null) {
        wp_insert_category($new_agency);
    }
    else
    {
        $upcat=array(
            'term_id' => $term['term_id'],
            'parent' => $parent_cat_id
        );
        wp_update_term($term['term_id'], 'agency', $upcat );
        return;
    }

    global $current_user;
    get_currentuserinfo();

    $wpcf7_post = array(
        'post_title'	=> $this_post->post_title,
        'post_type' => 'wpcf7_contact_form'
    );

    remove_action( 'save_post', 'save_agency_metadata' );
    $wpcf7_post_id = wp_insert_post($wpcf7_post);

    add_action( 'save_post', 'save_agency_meta' );

    wpcf7_contact_form( $wpcf7_post_id );
    $post_form = '<p>Your Name (required)<br />
	    [text* your-name] </p>

	<p>Your Email (required)<br />
	    [email* your-email] </p>

	<p>Your Message<br />
	    [textarea your-message] </p>

	<p>[submit "Send"]</p>';
    $form_data = array(
        'subject' => 'Challenge.gov Agency Contact',
        'sender'  => '[your-name] <[your-email]>',
        'body'	  => 'Submitted by: [your-name] <[your-email]>

Message:
[your-message]

--
This mail is sent via Challenge.gov',
        'recipient'=> (!empty($current_user->user_email) ? $current_user->user_email : 'challenges@gsa.gov'),
        'additional_headers' => '',
    );

    $form_messages = array(
        'mail_sent_ok' => 'Your message was sent successfully. Thanks.',
        'mail_sent_ng' => 'Failed to send your message. Please try later or contact the administrator by another method.',
        'validation_error' => 'Validation errors occurred. Please confirm the fields and submit it again.',
        'spam'	=> 'Failed to send your message. Please try later or contact the administrator by another method.',
        'accept_terms'	=> 'Please accept the terms to proceed.',
        'invalid_email'	=> 'Email address seems invalid.',
        'invalid_required' => 'Please fill the required field.',
        'captcha_not_match' => 'Your entered code is incorrect.',
        'upload_failed' => 'Failed to upload file.',
        'upload_file_type_invalid' => 'This file type is not allowed.',
        'upload_file_too_large' => 'This file is too large.',
        'upload_failed_php_error' => 'Failed to upload file. Error occurred.',
        'quiz_answer_not_correct' => 'Your answer is not correct.'
    );
    add_post_meta($wpcf7_post_id, '_form', $post_form);
    add_post_meta($wpcf7_post_id, '_mail', wpcf7_normalize_newline_deep( maybe_unserialize($form_data) ));
    add_post_meta($wpcf7_post_id, '_messages', wpcf7_normalize_newline_deep( maybe_unserialize($form_messages) ));
    add_post_meta($post_id, 'agency_wpcf7_id', $wpcf7_post_id);
    //echo "YYY".$this_post->post_type;
    //die();
    
    if ( is_plugin_active( 'challenge-mailchimp/challenge_mailchimp.php' ) ) {
        
        $debug = get_option('challenge_mailchimp_debug','');
        $get_apikey = get_option('ChallChimp_api','');

        if(!class_exists('Challenge_Mailchimp'))
            require_once(ABSPATH.'wp-content/plugins/challenge-mailchimp/challenge-mailchimp.class.php');
        if(class_exists('Challenge_Mailchimp')){
            $mailchimp = new Challenge_Mailchimp($get_apikey);
            if(!$debug){
                $new_list = $mailchimp->post('lists',
                    array(
                        'name' => 'Agency: '.$this_post->post_title,
                        'permission_reminder' => 'test sign up on Challenge.gov',
                        'email_type_option' => false,
                        'contact' => array(
                            'company' => 'CTAC',
                            'address1' => '3120 Fairview Park Dr.',
                            'city' => 'Falls Church',
                            'state' => 'VA',
                            'zip' => '22042',
                            'country' => 'US'
                            ),
                        'campaign_defaults' => array(
                            'from_name' => 'Challenge',
                            'from_email' => 'newsletter@challenge.gov',
                            'subject' => 'Challenge Newsletter for '.$this_post->post_title.' Agency',
                            'language' => 'English'
                            ),
                        ));
                if(isset($new_list['id']) && !empty($new_list['id']))
                {
                    $new_merge = $mailchimp->post('lists/'.$new_list['id'].'/merge-fields',
                    array(
                        'tag' => 'WPUSER',
                        'name' => 'WP Username',
                        'public' => false,
                        'type' => 'text',
                        'required' => false,
                    ));
                }
                update_post_meta($post_id, '_challenge_newsletter_list_id', $new_list['id']);
            }else{
                error_log("Debugging. Agency: ".$this_post->post_title." would have been created.");
            }
        }
    }

}

add_action( 'init', 'create_challenge_taxonomies', 0 );
add_action( 'init', 'create_submission_post_type' );
add_action( 'init', 'create_agency_post_type' );
add_action( 'init', 'create_challenge_post_type' );
add_action( 'init', 'create_challenge_blog_slide_post_type' );

add_action( 'admin_menu', 'my_remove_menu_pages' );
add_action( 'save_post', 'save_agency_meta' );

function my_remove_menu_pages() {
    //remove_menu_page('edit.php');
    remove_menu_page('index.php');
}

function my_pre_save_post( $post_id )
{
    // check if this is to be a new post
    if( $post_id != 'new-challenge' && $post_id != 'create-challenge' )
    {
        if(isset($_POST['challenge-post-type']) && $_POST['challenge-post-type'] == 'challenge-update')  //if update
        {
            $post = array(
                'ID'	=> $post_id,
                'post_title'  => $_POST['fields']['field_5298d94539343'],
                'post_type'  => 'challenge',
                'post_status' => !empty($_POST['challenge-publish_state']) ? $_POST['challenge-publish_state'] : 'publish');

            wp_set_object_terms($post_id, $_POST['fields']['field_5293da669ef07'], 'post_tag', false);
            wp_update_post( $post );
        }
        if(isset($_POST['solution-post-type']) && $_POST['solution-post-type'] == 'solution-update')  //if updating solution
        {
            $challenge_id = !empty($_POST['challenge-post-id']) ? $_POST['challenge-post-id'] : get_page_by_title('Home');
            $submission_start = get_field('submission_start', $challenge_id);
            $submission_end = get_field('submission_end', $challenge_id);
            $dt = DateTime::createFromFormat('U', time());
            $dt->setTimeZone(new DateTimeZone('America/New_York'));
            $adjusted_timestamp = $dt->format('U') + $dt->getOffset();
            if (($submission_end >= $adjusted_timestamp && (empty($submission_start) || $submission_start <= $adjusted_timestamp)) || current_user_can('create_users') || current_user_can('all_access_agency')) {
                $post = array(
                    'ID'	=> $post_id,
                    'post_title'  => $_POST['fields']['field_52a62ff61a5db'],
                    'post_type'  => 'solution',
                    'post_status' => !empty($_POST['fields']['field_52a6329fbc61b']) ? 'draft' : 'publish');

                wp_update_post( $post );
            }
            elseif (!empty($submission_start) && $submission_start >= $adjusted_timestamp){
                wp_redirect( add_query_arg( 'submissions', 'early', get_permalink( $challenge_id)) );
                exit;
            }else{
                wp_redirect( add_query_arg( 'submissions', 'ended', get_permalink( $challenge_id)) );
                exit;
            }
        }
        return $post_id;
    }
    elseif ($post_id == 'create-challenge' || $post_id == 'new-challenge')
    {
        $nonce = $_REQUEST['acf_nonce'];

        if ( ! wp_verify_nonce( $nonce, 'input' ) ) {
            die( 'Nonce security check failed.' ); //Add Redirect
        } else {
            $cat = array( $_POST['cat'] );

            $first = true;
            $title_out = "";

            $custom_fields = $_POST['fields'];
            reset($custom_fields);
            //$title_out = current($custom_fields);
            $title_out= $custom_fields['field_5298d94539343'];
            $post = array(
                'post_title'	=> $title_out,
                'tax_input' => array( 'agency' => $cat ),
                'post_status'  => !empty($_POST['challenge-publish_state']) ? $_POST['challenge-publish_state'] : 'publish', // Choose: publish, preview, future, etc.
                'post_type'		=> 'challenge' // Set the post type based on the IF is post_type X
            );
            $post_id = wp_insert_post($post);  // Pass the value of $post to WordPress the insert function

            $field_group_id = '23';

            if ( $post_id ) {
                $all_meta = get_post_meta($field_group_id);

                if(!empty($custom_fields['field_5293da669ef07'])) //no empty category
                    wp_set_object_terms($post_id, $custom_fields['field_5293da669ef07'], 'post_tag', true);

                if(empty($custom_fields['field_5293e5c7ca430'])) //no submission end date
                    $_POST['fields']['field_5293e5c7ca430'] = date("n/j/y ", time() + (90*86400))."12:00 am";

                global $current_user;
                get_currentuserinfo();

                $wpcf7_post = array(
                    'post_title'	=> $title_out,
                    'post_type'		=> 'wpcf7_contact_form' // Set the post type based on the IF is post_type X
                );
                //$wpcf7_post_id = wp_insert_post($wpcf7_post);
                //wpcf7_contact_form( $wpcf7_post_id );
                $post_form = '<p>Your Name (required)<br />
	    [text* your-name] </p>

	<p>Your Email (required)<br />
	    [email* your-email] </p>

	<p>Submission Title<br />
	    [text your-subject] </p>

	<p>External Link<br />
	    [text external-link] </p>

	<p>Submission Text<br />
	    [textarea your-message] </p>

	<p class="files">Additional Files<br /></p>
	<p class="hide files">[file your-file limit:50mb] </p>
  <p class="hide files">[file file-01 limit:50mb]<a class="del_file" href="#">Delete</a></p>
  <p class="hide files">[file file-02 limit:50mb]<a class="del_file" href="#">Delete</a></p>
  <p class="hide files">[file file-03 limit:50mb]<a class="del_file" href="#">Delete</a></p>
  <p class="hide files">[file file-04 limit:50mb]<a class="del_file" href="#">Delete</a></p>
  <p class="hide files">[file file-05 limit:50mb]<a class="del_file" href="#">Delete</a></p>
  <p class="hide files">[file file-06 limit:50mb]<a class="del_file" href="#">Delete</a></p>
  <p class="hide files">[file file-07 limit:50mb]<a class="del_file" href="#">Delete</a></p>
  <p class="hide files">[file file-08 limit:50mb]<a class="del_file" href="#">Delete</a></p>
  <p class="hide files">[file file-09 limit:50mb]<a class="del_file" href="#">Delete</a></p>
  <p class="hide files">[file file-10 limit:50mb]<a class="del_file" href="#">Delete</a></p>
  <p class="hide files">[file file-11 limit:50mb]<a class="del_file" href="#">Delete</a></p>
  <p class="hide files">[file file-12 limit:50mb]<a class="del_file" href="#">Delete</a></p>
  <p class="hide files">[file file-13 limit:50mb]<a class="del_file" href="#">Delete</a></p>
  <p class="hide files">[file file-14 limit:50mb]<a class="del_file" href="#">Delete</a></p>
  <p class="hide files">[file file-15 limit:50mb]<a class="del_file" href="#">Delete</a></p>
  <a href="#" class="add_file">Add file</a>
';

                $post_form .= '<p>[acceptance acceptance] Accept Challenge <a href="#submit-terms-conditions">Terms and Conditions</a></p><p><input type="hidden" name="new-solution" id="new-solution" value="1" /></p>

    <p>[submit "Send"]</p>';

                $new_cat = !empty($cat) ? get_term($cat[0],'agency') : "";
                $new_cat = !empty($new_cat) ? $new_cat->name." " : "";
//error_log($new_cat);
                $form_data = array(
                    'subject' => 'New Challenge.gov Solution: '.$title_out,
                    'sender'  => '[your-name] <[your-email]>',
                    'body'	  => 'Solution for '.$new_cat.'Challenge: <a href="'.get_permalink($post_id).'">'.$title_out.'</a>

Solution Submitted by: [your-name] ([your-email])

Solution Title: [your-subject]

Solution External Link: [external-link]

Solution Text:

     [your-message]


--
This mail is sent via Challenge.gov',
                    'recipient'=> (!empty($current_user->user_email) ? $current_user->user_email : 'challenge@gsa.gov'),
                    'additional_headers' => '',
                    'attachments' => '[your-file][file-01][file-02][file-03][file-04][file-05][file-06][file-07][file-08][file-09][file-10][file-11][file-12][file-13][file-14][file-15]'
                );

                $form_messages = array(
                    'mail_sent_ok' => 'Your solution was sent successfully. Thanks.',
                    'mail_sent_ng' => 'Failed to send your solution. Please try later or contact the administrator by another method.',
                    'validation_error' => 'Validation errors occurred. Please confirm the fields and submit it again.',
                    'spam'	=> 'Failed to send your solution. Please try later or contact the administrator by another method.',
                    'accept_terms'	=> 'Please accept the terms to proceed.',
                    'invalid_email'	=> 'Email address seems invalid.',
                    'invalid_required' => 'Please fill the required field.',
                    'captcha_not_match' => 'Your entered code is incorrect.',
                    'upload_failed' => 'Failed to upload file.',
                    'upload_file_type_invalid' => 'This file type is not allowed.',
                    'upload_file_too_large' => 'This file is too large.',
                    'upload_failed_php_error' => 'Failed to upload file. Error occurred.',
                    'quiz_answer_not_correct' => 'Your answer is not correct.'
                );
                //add_post_meta($wpcf7_post_id, '_form', $post_form);
                //add_post_meta($wpcf7_post_id, '_mail', wpcf7_normalize_newline_deep( maybe_unserialize($form_data) ));
                //add_post_meta($wpcf7_post_id, '_messages', wpcf7_normalize_newline_deep( maybe_unserialize($form_messages) ));

                //add_post_meta($post_id, 'challenge_wpcf7_id', $wpcf7_post_id);

                if ( is_plugin_active( 'challenge-mailchimp/challenge_mailchimp.php' ) ) {
    
                    $debug = get_option('challenge_mailchimp_debug','');
                    $get_apikey = get_option('ChallChimp_api','');
                                 
                    if(!class_exists('Challenge_Mailchimp'))
                        require_once(ABSPATH.'wp-content/plugins/challenge-mailchimp/challenge-mailchimp.class.php');
                    if(class_exists('Challenge_Mailchimp')){
                        $mailchimp = new Challenge_Mailchimp($get_apikey);
                        if(!$debug){
                            $new_list = $mailchimp->post('lists',
                                array(
                                    'name' => 'Challenge: '.$title_out,
                                    'permission_reminder' => 'test sign up on Challenge.gov',
                                    'email_type_option' => false,
                                    'contact' => array(
                                        'company' => 'CTAC',
                                        'address1' => '3120 Fairview Park Dr.',
                                        'city' => 'Falls Church',
                                        'state' => 'VA',
                                        'zip' => '22042',
                                        'country' => 'US'
                                        ),
                                    'campaign_defaults' => array(
                                        'from_name' => 'Challenge',
                                        'from_email' => 'newsletter@challenge.gov',
                                        'subject' => 'Challenge Newsletter for '.$title_out.' Challenge',
                                        'language' => 'English'
                                        ),
                                    ));
                            if(isset($new_list['id']) && !empty($new_list['id']))
                            {
                                $new_merge = $mailchimp->post('lists/'.$new_list['id'].'/merge-fields',
                                array(
                                    'tag' => 'WPUSER',
                                    'name' => 'WP Username',
                                    'public' => false,
                                    'type' => 'text',
                                    'required' => false,
                                ));
                                $new_merge = $mailchimp->post('lists/'.$new_list['id'].'/merge-fields',
                                array(
                                    'tag' => 'FOLLOW',
                                    'name' => 'Following',
                                    'public' => false,
                                    'type' => 'text',
                                    'required' => false
                                ));
                                $new_merge = $mailchimp->post('lists/'.$new_list['id'].'/merge-fields',
                                array(
                                    'tag' => 'SUBMIT',
                                    'name' => 'Submitted',
                                    'public' => false,
                                    'type' => 'text',
                                    'required' => false
                                ));
                            }
                            update_post_meta($post_id, '_challenge_newsletter_list_id', $new_list['id']);
                            
                            if (!class_exists('Challenge_Mailchimp_V2')) {
                                require_once CHALCHIMP_PLUGIN_PATH . '/challenge-mailchimp-api2.0.class.php';
                            }
                            if(class_exists('Challenge_Mailchimp_V2')){
                                $mailchimp2 = new Challenge_Mailchimp_V2($get_apikey);

                                $mailchimp2->call('lists/segment-add',
                                    array(
                                        'id' => $new_list['id'],
                                        'opts' => array(
                                            'type' => 'saved',
                                            'name' => 'Challenge Submitters',
                                            'segment_opts' => array(
                                                'match' => 'all',
                                                'conditions' => array(
                                                    array(
                                                    'field' => 'SUBMIT',
                                                    'op'=>'like',
                                                    'value'=>'Yes')
                                                )
                                            )
                                        )
                                    )
                                );
                                $new_seg = $mailchimp2->call('lists/segment-add',
                                    array(
                                        'id' => $new_list['id'],
                                        'opts' => array(
                                            'type' => 'saved',
                                            'name' => 'Challenge Followers',
                                            'segment_opts' => array(
                                                'match' => 'all',
                                                'conditions' => array(
                                                    array(
                                                    'field' => 'FOLLOW',
                                                    'op'=>'like',
                                                    'value'=>'Yes')
                                                )
                                            )
                                        )
                                    )
                                );
                                //error_log(print_r($new_seg,1));
                            }
                        }else{
                            error_log("Debugging. Challenge: ".$title_out." would have been created.");
                        }
                    }
                }
                //wp_redirect( home_url() );
                do_action( 'acf/save_post' , $post_id );

                wp_redirect( add_query_arg( 'edit-challenge', 'true', get_permalink( $post_id ) ) );
                exit;
                //return $post_id;
            }
            else
            {
                wp_redirect( home_url().'?message=create-challenge-error' );
                exit;
            }
        }//end nonce else
    }

    $post = array(
        'post_status'  => !empty($_POST['challenge-publish_state']) ? $_POST['challenge-publish_state'] : 'publish',
        'post_title'  => get_post_meta() , //need to update this to never be autosave
        'post_type'  => 'challenge' ,
    );

    // insert the post
    $post_id = wp_insert_post( $post );
    // update $_POST['return']
    $_POST['return'] = add_query_arg( array('post_id' => $post_id), $_POST['return'] );

    // return the new ID
    return $post_id;
}

add_filter('acf/pre_save_post' , 'my_pre_save_post' );

add_action( 'wp_print_styles', 'my_deregister_styles', 100 );

function my_deregister_styles() {
    wp_deregister_style( 'wp-admin' );
}

function my_acf_save_post( $post_id ) {
    //$_POST['return'] = add_query_arg( 'updated', 'true', get_permalink( $post_id ) );
    if ( isset($_POST['post_type']) && 'challenge' != $_POST['post_type'] ) {
        return;
    }

    $this_post = get_post( $post_id );

    if ('challenge' != $this_post->post_type) {
        return;
    }

    remove_action('acf/save_post', 'my_acf_save_post', 10, 1 );
    $partner_agency = get_field('partner_agency',$post_id);

    if(count($partner_agency) > 0)
    {
        foreach($partner_agency as $key => $this_partner_agency)
        {
            //$agency_title=($this_partner_agency['partner_agency']->post_title).", ";
            $agency_title=($this_partner_agency['partner_agency']->post_title);
                       $partner_agency[$key]['agency_value']=$agency_title;
        }
        update_field('field_54ca4e3784bd7', $partner_agency, $post_id );           
    }
    $the_prizes = get_field('the_prizes',$post_id);

    $cash_total = 0;
    if(count($the_prizes) > 0)
    {
        foreach($the_prizes as $key => $this_prize)
        {
            $this_cash_value = $this_prize['the_cash_amount'];
            $this_cash_value = str_replace("$","",$this_prize['the_cash_amount']);
            $this_cash_value = str_replace(",","",$this_cash_value);

            $the_prizes[$key]['the_cash_amount'] = (int)$this_cash_value; //update val to int
            $cash_total += (int)$this_cash_value;
        }
        update_field( 'field_52e66cc049092', $the_prizes, $post_id );
    }

    //update_field('cash_prize_total',$cash_total,$post_id);
    //update_field('field_5427f22394810',$cash_total, $post_id); //local cash_prize_total
    //update_field('field_54287ee9efaee',$cash_total, $post_id); //staging
    update_field('field_54288d4436485',$cash_total, $post_id); //prod

    $fields = get_field_object('title',$post_id);
    $new_post_title = $_POST["fields"][$fields["key"]];

    $my_post = array(
        'ID'           => $post_id,
        'post_title' => $new_post_title,
        'post_content' => '',
        'post_name' => str_replace(' ', '-', $new_post_title)
    );

    wp_update_post( $my_post );
    add_action('acf/save_post', 'my_acf_save_post', 10, 1 );
}
add_action( 'acf/save_post', 'my_acf_save_post', 10, 1 );


function modify_post_title( $data , $postarr )
{
    if($data['post_type'] == 'challenge') {

        $fields = get_field_object('title',$postarr['post_ID']);
        //print_r(get_field_object('title',$postarr['post_ID']));
        $data['post_title'] = $postarr["fields"][$fields['key']];
    }
    return $data;
}

//add_filter( 'wp_insert_post_data' , 'modify_post_title' , '99', 2 );

function my_posts_nav_link( $type = '', $label = '',  $maxPageNum = '' ) {
    $args = array_filter( compact('type', 'label', 'maxPageNum') );
    return my_get_posts_nav_link($args);
}

function my_get_posts_nav_link($args = array()) {
    global $wp_query;
    $return = '';
    $defaults = array(
        'maxPageNum' => '0',
    );
    //var_dump($wp_query->query_vars);
    //die();
    $max_num_pages = $args['maxPageNum'];
    $args = wp_parse_args( $args, $defaults );
    $paged = !empty($wp_query->query_vars["page"]) ? $wp_query->query_vars["page"] : 1;
    if ( $max_num_pages > 1 ) {
        if ($args['type'] == "prev") {
            $return = get_previous_posts_link($args['label']);
        }
        if ($args['type'] == "next") {
            $return = my_get_next_posts_link($args['label'], $max_num_pages);
        }
    }
    return $return;
}

function my_get_next_posts_link( $label = 'Next Page &raquo;', $max_page = 0 ) {
    global $paged, $wp_query;
    if ( !$paged ) {
        $paged = 1;
    }
    $nextpage = intval($paged) + 1;
    if ( !is_single() && ( empty($paged) || $nextpage <= $max_page) ) {
        $attr = apply_filters( 'next_posts_link_attributes', '' );
        return '<a href="' . next_posts( $max_page, false ) . "\" $attr>" . preg_replace('/&([^#])(?![a-z]{1,8};)/i', '&$1', $label) . '</a>';
    }
}
/*
function modify_contact_methods($profile_fields) {

	// Add new fields
	$profile_fields['twitter'] = 'Twitter Username';
	$profile_fields['facebook'] = 'Facebook URL';
	$profile_fields['gplus'] = 'Google+ URL';
	$profile_fields['affiliation'] = 'GSA';
	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');
*/
function isChallengeTimeStamp($timestamp) {
    return ((string)(int)$timestamp === (string)$timestamp);
}

function verify_challenge_datetime_view($datetime_in, $format_in = "M d, Y") {
    return isChallengeTimeStamp($datetime_in) ? date($format_in, $datetime_in) : date($format_in,strtotime($datetime_in));
}

function verify_challenge_datetime_store($datetime_in, $format_in = "M d, Y") {
    return isChallengeTimeStamp($datetime_in) ? (int)$datetime_in : strtotime($datetime_in);
}

function max_agency_match_codes($max_codes, $return)
{
    // find bureau
    $max_agency_code = isset($max_codes['OMBAgencyCode']) ? $max_codes['OMBAgencyCode'] : false;
    $max_bureau_code = isset($max_codes['OMBBureauCode']) ? $max_codes['OMBBureauCode'] : '00';
    if ( $max_agency_code === false ) { return 0; }
    $query = new WP_Query(array(
        'post_type'  => 'agency',
        'groupby'    => 'ID',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key'     => 'omb_agency_code',
                'value'   => trim($max_agency_code),
                'compare' => '='
            ),
            array(
                'key'     => 'omb_bureau_code',
                'value'   => trim($max_bureau_code),
                'compare' => '='
            )
        )
    ));
    if ( $query->have_posts() )
    {
        while($query->have_posts()){
            //$query->the_post();
            $query->next_post();
            $thid_id = $query->post->ID;
            switch($return){
                case 'post-id':
                    //return get_the_ID();
                    return $thid_id;
                    break;
                case 'category-id':
                    //if( $this_term = term_exists(get_the_title(), 'agency') )
                    if( $this_term = term_exists(get_post_field('post_title',$thid_id), 'agency') )
                        return $this_term['term_id'];
                    else
                        return 0;
                    break;
                case 'nice-name':
                    //return get_the_title();
                    return get_post_field('post_title',$thid_id);
                    break;
            }
        }
    }
    else if ( $max_bureau_code !== '00' )
    {
        $max_codes['OMBBureauCode'] = '00';
        return max_agency_match_codes($max_codes, $return);
    } else {
        return 0;
    }
}

function max_agency_match($max_codes, $post_id, $type)
{
    //var_dump($matches);
    //echo $post_id;
    $matches = wp_get_post_terms($post_id, 'agency', array("fields" => "all"));
    $agency_cat_ids = array();
    //var_dump($matches);
    if ($type == 'category-id')
    {
        foreach($matches as $match)
        {
            $agency_cat_ids[] = $match->term_id;
        }
        if(in_array(max_agency_match_codes($max_codes, $type), $agency_cat_ids))
            return true;
    }
    elseif ($type == 'post-id')
    {
        if(max_agency_match_codes($max_codes, $type) == $post_id)
            return true;
    }
    //var_dump($agency_cat_ids);
    return false;
}

function check_omb_on_login()

{

    if($GLOBALS['pagenow'] != 'wp-login.php')

        return;

    if(class_exists('OMBMax')){

        if( OMBMax::isAuthenticated() && isset($_GET['ombAuth']) && @$_GET['ombAuth'] == '1')

        {

            $email_exists = email_exists(OMBMax::get('user'));

            $set_role = 'all_access_agency';

            if(!$email_exists)

            {

                $user_login = strtolower(substr(OMBMax::get('First-Name'),0,1).OMBMax::get('Last-Name')); //should have max for last name

                $user_exists = username_exists($user_login);

                $user_login_original = $user_login;

                $user_counter = 1;

                $max_counter = 30;

                if($user_exists)

                {

                    while(username_exists($user_login))

                    {

                        $user_login = $user_login_original.$user_counter;

                        $user_counter++;

                        if($user_counter > $max_counter)

                            break;

                    }

                }


                $user_email = OMBMax::get('user');

                //validation on user login / email / any other req fields

                $rand_char_set = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

                $rand_num_special_set = '0123456789!@#$%^&*';

                $new_pwd = substr(str_shuffle($rand_char_set), 0, 10).substr(str_shuffle($rand_num_special_set), 0, 10).substr(str_shuffle($rand_char_set), 0, 10);

                $new_user = wpmu_create_user($user_login, $new_pwd, $user_email);

                if(intval($new_user) > 1)

                {

                    update_user_meta($new_user, 'OMBAgencyCode', OMBMax::get('Agency-Code'));

                    update_user_meta($new_user, 'OMBBureauCode', OMBMax::get('Bureau-Code'));

                    add_user_to_blog(get_current_blog_id(), $new_user, $set_role);

                    //wpmu_welcome_user_notification($new_user, $new_pwd, $meta = ''); // send email

                    //confirm_user_signup($user_login, $user_email); //Display user confirmation after post

                    wp_set_auth_cookie($new_user);

                    wp_set_current_user($new_user);

                    if(isset($_GET['redirect_to']) && @$_GET['redirect_to'] != '')

                    {

                        wp_redirect($_GET['redirect_to']);

                        exit;

                    }

                    else

                    {

                        wp_redirect(get_site_url());

                        exit;

                    }

                }

                else

                {

                    echo 'User could not be created.  Please Contact the system administrator.';

                }

            }

            else //email exists already

            {

                if(!is_user_member_of_blog($email_exists,get_current_blog_id()))

                {//user is NOT a member of this blog, add them and login.

                    update_user_meta($email_exists, 'OMBAgencyCode', OMBMax::get('Agency-Code'));

                    update_user_meta($email_exists, 'OMBBureauCode', OMBMax::get('Bureau-Code'));

                    add_user_to_blog(get_current_blog_id(), $email_exists, $set_role);


                    wp_set_auth_cookie($email_exists);

                    wp_set_current_user($email_exists);


                    if(isset($_GET['redirect_to']) && @$_GET['redirect_to'] != '')

                    {

                        wp_redirect($_GET['redirect_to']);

                        exit;

                    }

                    else

                    {

                        wp_redirect(get_site_url());

                        exit;

                    }

                }

                update_user_meta($email_exists, 'OMBAgencyCode', OMBMax::get('Agency-Code'));

                update_user_meta($email_exists, 'OMBBureauCode', OMBMax::get('Bureau-Code'));

            }

        }

    }

}




add_action('init', 'check_omb_on_login');

function get_max_agency_codes()
{
    global $current_user;
    get_currentuserinfo();
    if(!empty($current_user->ID) && $current_user->ID != '')
        return array(
            'OMBAgencyCode'=>get_user_meta( $current_user->ID, 'OMBAgencyCode', true ),
            'OMBBureauCode'=>get_user_meta( $current_user->ID, 'OMBBureauCode', true )
        );
    else
        return false;
}

function mytheme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <article class="row">
        <div id="div-comment-<?php comment_ID() ?>">
    <?php endif; ?>
    <div class="col-md-2 col-sm-2 hidden-xs">
        <figure class="thumbnail"><?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?></figure>
    </div>
    <?php if ($comment->comment_approved == '0') : ?>
        <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
        <br />
    <?php endif; ?>
    <div class="col-md-10 col-sm-10">
        <div class="panel panel-default arrow left">
            <?php echo (!empty($args['has_children']) && $comment->comment_parent == '0') ? '<a href="javascript:void(0);" class="expand-comment">Show Replies [+]</a>' : '' ;?>
            <?php if($depth > 1) { ?>
            <div class="panel-heading right">Reply</div>
            <?php } ?>
            <div class="panel-body">
                <div class="comment-user">
                    <i class="fa fa-user"></i><?php echo ' '.get_comment_author_link(); ?>
                </div>
                <div class="text-left"><i class="fa fa-clock-o"></i><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
            <?php
            /* translators: 1: date, 2: time */
            printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
        ?></div>
                <div class="comment-post"><?php comment_text() ?></div>
                <p class="text-right">
                    <div class="reply">
        <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </div>
                </p>
            </div>
        </div>
    </div>

    
    <?php if ( 'div' != $args['style'] ) : ?>
        </div>
        </article>
    <?php endif; ?>
<?php
}

//wp_enqueue_script( 'add-this', '//s7.addthis.com/js/300/addthis_widget.js#pubid=0b1d50f9402f4ba064ca234ec8bce41a', array('jquery'), "1.0.0", 'all' );

function check_and_redirect_cb()
{
    $session_codes = get_max_agency_codes();

    if(is_user_logged_in())
    {
        if (current_user_can('administrator')) {
            wp_redirect(admin_url());
        }
        elseif(current_user_can('agencyuser') || current_user_can('all_access_agency')) {
            if(!isset($_GET['login-message']))
                !empty($session_codes) ? wp_redirect(get_permalink(max_agency_match_codes($session_codes,'post-id'))) : wp_redirect(site_url().'?login-message=no-omb-max-auth');
        }
    }
}

add_action('template_redirect', 'add_check_redirect');
function add_check_redirect() {
    global $wp_query;
    if ( is_singular() ) {

        $post = $wp_query->get_queried_object();
        $pattern = get_shortcode_regex();

        preg_match('/'.$pattern.'/s', $post->post_content, $matches);
        if (is_array($matches) && $matches[2] == 'check-and-redirect') {
            check_and_redirect_cb();
        }
    }
}

//apply_filters( 'wp_save_post_revision_check_for_changes', true, $last_revision, $post );

add_action('wp', 'challenge_check_ssl');
function challenge_check_ssl()
{
    //global $using_ssl;
    $ssl_value = $_GET['edit-challenge'];
    $ssl_value2 = $_GET['edit-agency'];
    $ssl_value3 = $_GET['new-solution'];
    $ssl_value4 = $_GET['edit-solution'];

    $using_ssl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' || $_SERVER['SERVER_PORT'] == 443;
    // Page ID 2 must be https
    if ((is_page('Create New Challenge') || is_page('list') || (isset($ssl_value) && $ssl_value == 'true') || (isset($ssl_value2) && $ssl_value2 == 'true') || (isset($ssl_value3) && $ssl_value3 == 'true') || (isset($ssl_value4))))
    {
        if(strpos(get_site_url('http'), "http://localhost/") !== false || strpos(get_site_url('http'), "http://sites.usa.local") !== false) //override if local dev
            $using_ssl = true;

        if(!$using_ssl) {
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: https://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
            exit;
        }
        else
            add_action('wp_head','acf_challenge_validation');
    }

}

function challenge_permalink($post_id) {
    return substr(get_permalink($post_id), strlen(get_option('home')));
}

function verify_recipients($wpcf7) {
    $wpcf7->mail['use_html'] = 1;
    $args = array(
        'numberposts' => -1,
        'post_type' => 'challenge',
        'meta_key' => 'challenge_wpcf7_id',
        'meta_value' => $wpcf7->id
    );
    //error_log(print_r($wpcf7,1));
    $the_query = new WP_Query( $args );  //query to find the challenge post that corresponds to this mail id
    $this_challenge_id = 0;

    if( $the_query->have_posts() ):
        while ( $the_query->have_posts() ) : $the_query->the_post();
            $this_challenge_id = get_the_ID();
        endwhile;
    endif;

    if($this_challenge_id != 0)  //if the challenge id exists
    {
        $email_recips = get_field('email_recipients',$this_challenge_id);
        if(!empty($email_recips))
        {
            //error_log($email_recips);
            $email_recips = preg_replace('/\s+/', '', $email_recips);
            $wpcf7->mail['recipient'] = $email_recips;
        }
    }
    wp_reset_query();

    return $wpcf7;
}
add_action('wpcf7_before_send_mail', 'verify_recipients');

function acf_challenge_validation()
{
    ?>
    <script type="text/javascript">
        (function($){
            function isFutureDate(idate){
                var today = new Date('<?php echo date("n/d/y");?>').getTime();
                var thisDate = new Date(idate).getTime();
                return (today - thisDate) <= 0 ? true : false;
            }
            $(document).ready(function() {
                $('.acf-form').submit(function(e){
                    e.preventDefault();
                    noPost = false;
                    var currentTarget = e.target;
                    var validation_failed = [];

                    $('span.required').each(function(){
                        thisId = $(this).parent().parent().parent().attr('id');
                        if (thisId == 'acf-submission_end')
                        {
                            var myRegexp = /^\d+\/\d+\/\d+/;
                            var match = myRegexp.exec($('#'+thisId+' input').val());
                            if(match !== null)
                            {
                                if (!isFutureDate(match[0]))
                                {
                                    var r = confirm('You have entered a date in the past for the submission end date. Solutions will not be able to be submitted. Are you sure?');
                                    if(r !== true)
                                        noPost = true;
                                }
                            }
                        }
                        if (thisId == 'acf-category')
                        {
                            
                            if ($('#'+thisId+' select').val() == 'Blank' || $('#'+thisId+' select').val()==null)
                            {
                                $('#'+thisId).addClass('field error');
                                validation_failed.push($(this).parent().text().slice(0, -3));
                            }
                        }

                        if($('#'+thisId).is('.field_type-text,.field_type-date_time_picker'))
                            type = 'input';
                        else if($('#'+thisId).is('.field_type-select'))
                            type = 'select';

                        if($('#'+thisId+' '+type).length == 0 || $('#'+thisId+' '+type).val() == ''){
                            $('#'+thisId).addClass('field error');
                            validation_failed.push($(this).parent().text().slice(0, -2));
                        }
                    });

                    if(!noPost)
                    {
                        if (validation_failed.length > 0)
                            alert("Please check the following fields: \n\n"+validation_failed.join("\n"));
                        else
                            currentTarget.submit();
                    }
                });
            });
        })(jQuery);
    </script>
<?php
}

//add_action('acf_head-fields', 'acf_challenge_validation');
//add_action('acf/input/form_data','acf_challenge_validation');

function agency_columns_head($defaults)
{
    $new = array();
    foreach($defaults as $key => $title)
    {
        if ($key=='author') // Put the new column before the author
        {
            $new['agency_parent'] = 'Parent';
        }
        $new[$key] = $title;
    }
    return $new;
}
function agency_columns_content($column_name, $post_ID)
{
    if ($column_name == 'agency_parent')
    {
        $ancestors = get_post_ancestors($post_ID);
        for( $a=count($ancestors)-1; $a>=0; $a-- )
        {
            echo get_post_field('post_title',$ancestors[$a])."<br />";
        }
    }
}
add_filter('manage_agency_posts_columns',       'agency_columns_head',    10);
add_action('manage_agency_posts_custom_column', 'agency_columns_content', 10, 2);

/// autoselect agency parent fields
function admin_enqueue_agency_theme()
{
    wp_enqueue_script( 'admin_agency_js_select2', get_template_directory_uri().'/admin/js/select2.min.js' );
    wp_enqueue_script( 'admin_agency_js',         get_template_directory_uri().'/admin/js/agency.js', array('admin_agency_js_select2') );

    wp_register_style( 'admin_agency_css_select2',           get_template_directory_uri() . '/admin/css/select2.css' );
    wp_register_style( 'admin_agency_css_select2_bootstrap', get_template_directory_uri() . '/admin/css/select2-bootstrap.css', array( 'admin_agency_css_select2') );

    wp_enqueue_style( 'admin_agency_css_select2' );
    wp_enqueue_style( 'admin_agency_css_select2_bootstrap' );
}
add_action('admin_enqueue_scripts', 'admin_enqueue_agency_theme' );

/// check custom field as part of default search
function admin_search_agency_join($join)
{
    global $wpdb;
    if ( is_admin() && is_post_type_archive('agency') )
    {
        $join .= " LEFT JOIN {$wpdb->postmeta} ON ({$wpdb->posts}.ID = {$wpdb->postmeta}.post_id) ";
    }
    return $join;
}
function admin_search_agency_search($search,$query)
{
    global $wpdb;
    if ( is_admin() && is_post_type_archive('agency') )
    {
        $meta_search = $wpdb->prepare("( ({$wpdb->postmeta}.meta_key = 'acronym' AND CAST({$wpdb->postmeta}.meta_value AS CHAR) LIKE '%%%s%%') )", $query->get('s') );
        $search = preg_replace( '/\(\((.+)\)\)/', '(($1 OR '.$meta_search.'))', $search );
    }
    return $search;
};
function admin_search_agency_groupby($where)
{
    if ( is_admin() && is_post_type_archive('agency') )
    {
        $groupby .= 'wp_posts.ID';
    }
    return $groupby;
};
//add_filter('posts_join',   'admin_search_agency_join');
//add_filter('posts_search', 'admin_search_agency_search', 1,2 ); /// 1=exec first,2=search+query
//add_filter('posts_groupby','admin_search_agency_groupby');

add_action('wp',function(){ if(strpos(get_site_url('http'), "http://localhost/") !== false || strpos(get_site_url('http'), "http://sites.usa.local") !== false || strpos(get_site_url('http'), "https://staging.platform") !== false) {if (is_home()) wp_redirect( 'list' );}});

add_filter( 'redirect_canonical','custom_disable_redirect_canonical' );
function custom_disable_redirect_canonical( $redirect_url ){
    if ( is_singular('agency') ) $redirect_url = false;
    return $redirect_url;
}

add_filter( 'body_class', 'ie_class_addition' );
function ie_class_addition( $classes ) {
    if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') ) {
        $classes[] = 'ie-page';
        return $classes;
    }
}

add_action('wp_head', 'add_contact_form_fields_js');
function add_contact_form_fields_js()
{
    ?>
    <script type="text/javascript">
        (function($){

            $(document).ready(function() {
                //hide all inputs except the first one
                $('p.hide').hide();
                $('p.hide').first().show();

                //functionality for add-file link
                $('a.add_file').on('click', function(e){
                    //show by click the first one from hidden inputs
                    $('p.hide:not(:visible):first').show('slow');
                    e.preventDefault();
                });

                //functionality for del-file link
                $('a.del_file').on('click', function(e){
                    //var init
                    var input_parent = $(this).parent();
                    var input_wrap = input_parent.find('span');
                    //reset field value
                    input_wrap.html(input_wrap.html());
                    //hide by click
                    input_parent.hide('slow');
                    e.preventDefault();
                });
            });
        })(jQuery);
    </script>
<?php
}

add_filter( 'wpcf7_mail_components', 'app_100_handle_cf7_mail_components', 50, 2 );
function app_100_handle_cf7_mail_components($mail_params, $form = null) {
    return $mail_params;
}

function find_parent_agency($column_name, $post_ID)
{
    if ($column_name == 'agency_parent')
    {
        $ancestors = get_post_ancestors($post_ID);
        
        for( $a=count($ancestors)-1; $a>=0; $a-- )
        {
            return get_post_field('post_title',$ancestors[$a]);
        }
    }
}
function email_confirmation($wpcf7) {

    if(isset($_POST['new-solution']) && $_POST['new-solution']==1)
    {
        $recipient_email=$_POST['your-email'];
        $headers = 'From: Challenge Admin <challenges@gsa.gov>' . "\r\n";
        $agencyname=$wpcf7->title;

        $subject="Solution is submitted for ".$agencyname;
        $body="Thank you for entering the challenge and prize competition. We appreciate the effort you've contributed to the mission. The judging and award dates are listed in the rules and terms of the challenge competition.";
//var_export($wpcf7,1);
        wp_mail($recipient_email, $subject, $body, $headers);
    }
    return $wpcf7;
}
add_action('wpcf7_before_send_mail', 'email_confirmation');

function get_page_by_title_publish( $page_title, $output = OBJECT, $post_type = 'page' ) {
    global $wpdb;

    if ( is_array( $post_type ) ) {
        $post_type = esc_sql( $post_type );
        $post_type_in_string = "'" . implode( "','", $post_type ) . "'";
        $sql = $wpdb->prepare( "
            SELECT ID
            FROM $wpdb->posts
            WHERE post_title = %s
                        AND post_status = 'publish'
            AND post_type IN ($post_type_in_string)
        ", $page_title );
    } else {
        $sql = $wpdb->prepare( "
            SELECT ID
            FROM $wpdb->posts
            WHERE post_title = %s
                        AND post_status = 'publish'
            AND post_type = %s
        ", $page_title, $post_type );
    }

    $page = $wpdb->get_var( $sql );

    if ( $page )
        return get_post( $page, $output );

    return null;
}
add_action("wp_ajax_challenge_display_posts", "challenge_display_posts_list");
add_action("wp_ajax_nopriv_challenge_display_posts", "challenge_display_posts_list");
function challenge_display_posts_list()
{
    $catarr=$_POST["type"];
   
    echo do_shortcode( '[challenge-display-posts post_type="challenge" type='.$catarr.']' );
  
    //echo json_encode($_POST['category']);
    wp_die();
}

function custom_readonly()
{
  //$_GET['post']= get_the_ID();
  global $post;
  
    $sub_open_date=get_field('submission_start',$post->ID);
    $sub_close_date=get_field('submission_end',$post->ID);
    
    $init_date=get_field('initiated_date',$post->ID);
    $judge_open=get_field('judging_start',$post->ID);
    $win_announced=get_field('winners_announced',$post->ID);
    
    $judge_close=get_field('judging_end',$post->ID);
 
    if($sub_open_date !="" && $init_date!="")
    {
        $diff_prepare = date_diff(date_create($init_date) , date_create(verify_challenge_datetime_view($sub_open_date,'m/d/y')));
        $preparation_timeline=$diff_prepare->days;
     
    }
    else{
        $preparation_timeline="No dates have been entered either for submission start or for Initial date or for both";
    }
    
    if($sub_close_date!="" && $sub_open_date!="")
    {
        $diff_sub = date_diff(date_create(verify_challenge_datetime_view($sub_close_date,'m/d/y')) , date_create(verify_challenge_datetime_view($sub_open_date,'m/d/y')));
        $submission_timeline=$diff_sub->days;
    }    
    else
    {
        $submission_timeline="No dates have been entered either for submission start or for submission end or for both";
    }
    
    if($judge_open!="" && $judge_close!="")
    {
        $diff_judge = date_diff(date_create($judge_close) , date_create($judge_open));
     
        $judge_timeline=$diff_judge->days;
    }
    else
    {
        $judge_timeline="No dates have been entered either for judging start or for judging end or for both";
    }
    if($win_announced!="" && $judge_close!="")
    {
         $diff_award = date_diff(date_create($win_announced) , date_create($judge_close));
        
        $award_timeline=$diff_award->days;
    }
    else{
        $award_timeline="No dates have been entered either for winner announced or for judging end or for both";
    }
    
    if($win_announced!="" && $init_date!="")
    {
        $diff_challeneg = date_diff(date_create($win_announced) , date_create($init_date));
       $challenge_timeline =$diff_challeneg->days;
       // $challenge_timeline = floor($diff_challeneg->y * 365.25 + $diff_challeneg->m * 30 + $diff_challeneg->d + $diff_challeneg->h/24 + $diff_challeneg->i / 60);
        //$challenge_timeline=human_time_diff($win_announced,$init_date);
    }
    else{
        $challenge_timeline="No dates have been entered either for winner announced or for initiated date or for both";
    }
    
    $total_prize_cost=get_field('total_prize_cost',$post->ID);
    $total_admin_cost=get_field('total_administration_cost',$post->ID);
    $total_challenge_cost=$total_prize_cost+$total_admin_cost;
    
    ?>
<script type="text/javascript">
	(function($){
		function readonly_fields()
		{    
            var totalchallengecost = "<?php echo $total_challenge_cost; ?>";
            $('#acf-field-total_challenge_cost').val(totalchallengecost);
             $('#acf-field-total_challenge_cost').prop("readonly", true);
             
            var preptimeline = "<?php echo $preparation_timeline; ?>";
            $('#acf-field-preparation_timeline').val(preptimeline);
             $('#acf-field-preparation_timeline').prop("readonly", true);
            
            var subtimeline = "<?php echo $submission_timeline; ?>";
            
           $('#acf-field-submission_timeline').val(subtimeline);
            $('#acf-field-submission_timeline').prop("readonly", true);
            
            var judgetimeline = "<?php echo $judge_timeline; ?>";
            
           $('#acf-field-judging_timeline').val(judgetimeline);
            $('#acf-field-judging_timeline').prop("readonly", true);
            
            var awardtimeline = "<?php echo $award_timeline; ?>";
            
           $('#acf-field-award_timeline').val(awardtimeline);
            $('#acf-field-award_timeline').prop("readonly", true);
            
            var challengetimeline = "<?php echo $challenge_timeline; ?>";
            
           $('#acf-field-challenge_timeline').val(challengetimeline);
            $('#acf-field-challenge_timeline').prop("readonly", true);
            
            $('#acf-field-number_of_submissions').prop("readonly", true);
		}
        readonly_fields();
	})(jQuery);
	</script>
	<?php
}

add_action('wp',function(){
  
  if ((is_page('Create New Challenge') || (isset($_GET['edit-challenge']) && $_GET['edit-challenge'] == 'true')))
      add_action('shutdown', 'custom_readonly');

  if(isset($_GET['edit-agency']) && $_GET['edit-agency']=="true")
      add_action('shutdown', 'agency_readonly');  
});

function agency_readonly()
{
    ?>
    <script type="text/javascript">
	(function($){
		function agency_readonly()
		{
           $('#acf-field-omb_agency_code').prop("readonly", true);
           $('#acf-field-omb_bureau_code').prop("readonly", true);
           $('#acf-field-treasury_agency_code').prop("readonly", true);
           $('#acf-field-cgac_agency_code').prop("readonly", true);
        }
        agency_readonly();
	})(jQuery);
	</script>
    <?php
}

function limit_words($string, $word_limit)
{
    $truncatedstring="";
    $words = explode(" ",$string);
    $truncatedstring=implode(" ", array_splice($words, 0, $word_limit));
   
    if(sizeof($words)>$word_limit)
    {
        $truncatedstring=$truncatedstring.'...';
    }
    return $truncatedstring;
}

function add_my_custom_field_node() {
    global $post;
    $custom_fields = get_post_custom();

    foreach($custom_fields AS $key => $value) {
        if(substr($key, 0, 1) != "_") {
        //preg_replace("([0-9]+)", "", $key);

        $key = str_replace("1st_place_prize_amount","first_place_prize_amount",$key);
                        $key = str_replace("number_of_submissions_(category)","number_of_submissions_category", $key);
                        $key = str_replace("descriptio","custom_description", $key);
                        $key = str_replace("title","custom_title", $key);
            foreach($value AS $_value) {
                $_value = trim($_value);
                if($_value) {
                    
                    //echo("<testData>{$_value}</testData>\r\n");
                    echo("<$key><![CDATA[$_value]]></$key>\r\n");
                    //echo("<![CDATA[<$key>{$_value}</$key>]]>\r\n");
                }
            }
        }
   }
}
add_action('rss2_item', 'add_my_custom_field_node');

function challenge_usa_search()
{
    ?>
    <script type="text/javascript">
//<![CDATA[
      var usasearch_config = { siteHandle:"challenge.gov" };

      var script = document.createElement("script");
      script.type = "text/javascript";
      script.src = "//search.usa.gov/javascripts/remote.loader.js";
      document.getElementsByTagName("head")[0].appendChild(script);

//]]>
    </script>
<?php
}
//add_action('wp_footer', 'challenge_usa_search');

//add_action('shutdown',  'getfiscalyeardata');

add_action('shutdown',function(){if(is_page('Serial Charts')){getfiscalyeardata();}});



function getfiscalyeardata()
{
 
 
    $args = array(
	'posts_per_page' => -1,
	'post_type'	=> 'challenge',
	'post_status' =>  'publish'
        
    );
    
    $the_query = new WP_Query( $args );
    
    
     if( $the_query->have_posts() ):
     $metaval=array();
     while( $the_query->have_posts() ) : $the_query->the_post();
    
        $metaval=get_field('fiscal_year',get_the_ID());
        
        if($metaval!="")
        {
            if(isset($fiscalyearval[$metaval]))
            {
                $fiscalyearval[$metaval]++;    
            }
            else{
                $fiscalyearval[$metaval]=1;
            }
            $fiscalyear_array[]=$metaval;
        }
     endwhile;
     
     endif;
        
    
    $totalval=0;
        foreach($fiscalyearval as $year => $val)
        {
           $json[] = array(
                    "Year" => $year,
                   "value" => $val
                ); 
          $totalval+=$val;
        }
    sort($json);
     $json[] = array(
                    "Year" => 'Grand Total',
                   "value" => $totalval
                );
 
 
    /* Line Chart */
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
    $agencyarray=array_slice($challengearray,0,5);
 
    foreach($agencyarray as $agenylist=>$value)
    {
        $agencynames[]=$agenylist;
    }
    
    
     $tax_args = array(
                            'tax_query' => array(
                                    array(
                                            'taxonomy' => 'agency',
                                            'field'    => 'slug',
                                            'operator' => $tax_operator,
                                            'terms'    => $agencynames
                                            
                                )
                            )
                    );
 
    $totalargs = array_merge( $args, $tax_args );
    
    $topdeptquery = new WP_Query( $totalargs );
    
    $fiscalyear_array=array_unique($fiscalyear_array);
    $fiscalyear_array = array_values($fiscalyear_array);
    
    sort($fiscalyear_array);
    
    
   if( $topdeptquery->have_posts() ):
   
   
    while( $topdeptquery->have_posts() ) : $topdeptquery->the_post();
   
       $metaval_dept=get_field('fiscal_year',get_the_ID());
       
       
       $terms = wp_get_post_terms(get_the_ID(), 'agency');
      
    
      foreach ( $terms as $term ) {


        $parentid = $term->parent;
        $termname= $term->name;
        if($parentid!=0)
        {
            $parent  = get_term_by( 'id', $term->parent, 'agency');
           // climb up the hierarchy until we reach a term with parent = '0'
           while ($parent->parent != '0'){
               $term_id = $parent->parent;
        
               $parent  = get_term_by( 'id', $term_id, 'agency');
           }
               // $termname=get_term_by('id',$parentid,'agency');
                $termname=$parent->name;
                
                
        }
        
                     
                       
                           
                        foreach($fiscalyear_array as $fiscalyearname)
                        {
                           
                            if($metaval_dept==$fiscalyearname)
                            {
                                //echo $termname."==".$fiscalyearname."<br>";
                               // if($termname == "Department of State" && $fiscalyearname == "FY12")
                                 //   echo "<strong>this is it</strong>";
                               if(isset($fiscalyear_dept[$termname][$fiscalyearname]))
                               {
                                
                                 $fiscalyear_dept[$termname][$fiscalyearname]++;
                                 
                               }
                               else
                               {
                                $fiscalyear_dept[$termname][$fiscalyearname]=1;
                                
                               }
                            }else{
                                 if (!isset($fiscalyear_dept[$termname][$fiscalyearname]))
                                 {
                                    $fiscalyear_dept[$termname][$fiscalyearname] = 0;  
                                 }
                            }
                            
                           
                        }
                        
                        
                       
                      
                       
                        
                }
       
         
    
 endwhile;
 
 endif;
  
 
 $totalvaldept=0;
 $data=array();
     $i=50;
     $k=0;
    foreach($fiscalyear_dept as $fiscalkey => $fiscalval)
    {
    
        
        foreach($fiscalval as $year => $cnt)
        {
            $data[$year][] = $cnt;
            
        }
        
        $color=array('#FF6600','#FCD202', '#B0DE09', '#0D8ECF', '#2A0CD0');
        $jsonagencynames[]= array("text" => $fiscalkey." ----------------",
                          "x" => 130,
                          "y"=> $i,
                          "color" => $color[$k]);
        $i=$i+20;
        $k++;
        
    }
 
    foreach($data as $fiscalyear=>$cnt)
    {
        
        $jsondept[] = array(
                "Year" => $fiscalyear,
               "value1" => $cnt[0],
               "value2" => $cnt[1],
               "value3" => $cnt[2],
               "value4" => $cnt[3],
               "value5" => $cnt[4],
            ); 
    }



 ?>
<script type="text/javascript">
   var chart;

function drawcharts()
{
 
AmCharts.ready(function() {
   
 // var chartData = '<?php echo json_encode( $json );?>';
 var chartData=<?php echo json_encode( $json );?>;
//console.debug(chartData);
  
    chart = new AmCharts.AmSerialChart();
    chart.dataProvider = chartData;
    chart.categoryField = "Year";

  var graph = new AmCharts.AmGraph();
    graph.valueField = "value";
    graph.type = "column";
    chart.addGraph(graph);
    
    var categoryAxis = chart.categoryAxis;
categoryAxis.autoGridCount  = false;
categoryAxis.gridCount = chartData.length;
categoryAxis.gridPosition = "start";
graph.fillAlphas = 0.8;
  chart.write("chartdiv");
  
  
  /* Line Chart*/
  var chartLineData=<?php echo json_encode( $jsondept );?>;

  
    chartLine = new AmCharts.AmSerialChart();
    chartLine.dataProvider = chartLineData;
    chartLine.categoryField = "Year";
  
    chartLine.allLabels=<?php echo json_encode( $jsonagencynames );?>;

  var graph1 = new AmCharts.AmGraph();
  graph1.type = "line";
  graph1.valueField = "value1";
  graph1.colors="#FF6600";
  graph1.bullet = "round";
  graph1.bulletBorderColor = "#FFFFFF";
  graph1.bulletBorderThickness = 2;
  graph1.lineThickness = 2;
  graph1.lineAlpha = 0.5;
  chartLine.addGraph(graph1);

  var graph2 = new AmCharts.AmGraph();
  graph2.valueField = "value2";
  graph2.bullet = "round";
  graph2.colors='#FCD202'; 
  graph2.bulletBorderColor = "#FFFFFF";
  graph2.bulletBorderThickness = 2;
  graph2.lineThickness = 2;
  graph2.lineAlpha = 0.5;
  chartLine.addGraph(graph2);
  
  var graph3 = new AmCharts.AmGraph();
  graph3.valueField = "value3";
  graph3.bullet = "round";
  graph3.colors='#B0DE09';
  graph3.bulletBorderColor = "#FFFFFF";
  graph3.bulletBorderThickness = 2;
  graph3.lineThickness = 2;
  graph3.lineAlpha = 0.5;
  chartLine.addGraph(graph3);
  
   var graph4 = new AmCharts.AmGraph();
  graph4.valueField = "value4";
  graph4.bullet = "round";
  graph4.colors='#0D8ECF'; 
  graph4.bulletBorderColor = "#FFFFFF";
  graph4.bulletBorderThickness = 2;
  graph4.lineThickness = 2;
  graph4.lineAlpha = 0.5;
  chartLine.addGraph(graph4);
  
  var graph5 = new AmCharts.AmGraph();
  graph5.valueField = "value5";
  graph5.bullet = "round";
  graph5.colors='#2A0CD0';
  graph5.bulletBorderColor = "#FFFFFF";
  graph5.bulletBorderThickness = 2;
  graph5.lineThickness = 2;
  graph5.lineAlpha = 0.5;
  chartLine.addGraph(graph5);
  
  
  
  chartLine.write("chartLinediv");
  
  
});
}
drawcharts();
 </script>
 <?php
}

 add_action('shutdown',function(){
    if(is_page('Gantt Chart')){ 
?>

 <script language="javascript" type="text/javascript">
jQuery("#agency_selection_box").change(function(e){
		e.preventDefault();
		loadganttchart(this.value);

});
function loadganttchart(agencyname) {

var dataarray;
var chart;

jQuery.ajax({
	type : 'post',
	
        url: "<?php echo admin_url('admin-ajax.php');?>",
	
        data: {
	    
            'action':'ganttchart_display_by_agency',
            'agency': agencyname,
	    'loadthrough' : 'ajaxcall',
        },
	beforeSend: function($){
	jQuery('#ganttchart').empty();
	jQuery('#ganttchart').prepend('<img id="loading" src="<?php echo get_bloginfo('template_directory');?>/images/ajax-loader.gif" />')
	
	//jQuery('#ganttchart').fadeOut();
	//jQuery('#loadingDiv').fadeIn();
          
      },
         success : function( response ) {
           
             
		//jQuery('#loadingDiv').fadeOut();
                jQuery('#ganttchart').empty();
                jQuery("#challengetitle").html(agencyname);
                jQuery('#ganttchart').fadeIn().html(response);
               
                //console.debug(response);
               
               if (response==0) {
                jQuery('#ganttchart').show().html("Sorry, No data found!");
               }
              
            
             
               
                  
         },
	  error : function(  ) {
		jQuery("#ganttchart").addClass('alert-danger');
		jQuery("#ganttchart").show().html('Sorry!, An error occur while procesing your input.');
                
	 }
	 
	 
    });

   
       

}

</script>
 <?php
  }});
   
add_action("wp_ajax_ganttchart_display_by_agency", "retrive_ganttchart_data");
add_action("wp_ajax_nopriv_ganttchart_display_by_agency", "retrive_ganttchart_data");


/*add_action('shutdown',function(){
    if(is_page('Gantt Chart')){
        $agencyname="Environmental Protection Agency";
    $allchallengedata=getchallengeByagency($agencyname);
    getDataForGanttChart($allchallengedata);
    }
    });*/

function retrive_ganttchart_data()
{
    $agencyname=$_POST["agency"];
    
   
   $allchallengedata=getchallengeByagency($agencyname);
  
   if(isset($allchallengedata) && $allchallengedata!="")
   {
        getDataForGanttChart($allchallengedata);
   }
   else{
    echo "0";
    die();
   }
}

function getDataForGanttChart($allchallengedata)
{
    
    
    $i=0;
    
    $challengejson= array();
    
    foreach($allchallengedata as $challenges)
    {
       
        $challengejson[$i] = array();
        $challengejson[$i]['category'] = $challenges[0];
        
        $challengejson[$i]['segments'] = array();
        $challengejson[$i]['segments'][0]['start'] = $challenges[1];
        $challengejson[$i]['segments'][0]['color'] = '#'.random_color();
        //$challengejson[$i]['segments'][0]['duration'] = $challenges[2];
        $challengejson[$i]['segments'][0]['end'] = $challenges[2];
        $challengejson[$i]['segments'][0]['task'] = "Submission Duration";
    
        $i++;
    }
  
  
    $mynewjson = json_encode($challengejson);
    
    ?>
    <script type="text/javascript">
   
    var ganttchart = AmCharts.makeChart( "ganttchart", {
                   "type": "gantt",
                  "marginRight": 60,
                  "dataDateFormat":"YYYY-MM-DD",
                 
                  "pathToImages": "https://www.amcharts.com/lib/3/images/",
                
                  "columnWidth": 0.5,
                  "valueAxis": {
                    "type": "date"
                  },
                  "brightnessStep": 10,
                  "graph": {
                    "fillAlphas": 1,
                    "balloonText": "<b>[[task]]</b>: [[open]] [[value]]"
                  },
                  "rotate": true,
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
                  }
                });
     </script>
    <?php
  
}

function getchallengeByagency($agencyname)
{
  
    $args = array(
       
	'post_type'	=> 'challenge',
	'post_status' =>  'publish',
         'posts_per_page' => -1,
         'tax_query' => array(
                                    array(
                                            'taxonomy' => 'agency',
                                            'terms'    => $agencyname,
                                            'field'    => 'slug',
                                            'operator' => 'IN'
                                            
                                )
                            )
	
        
    );
    
    $the_query = new WP_Query( $args );
 
   if($the_query->have_posts() ): 
     while( $the_query->have_posts() ) : $the_query->the_post();
          
           $submission_startdate = get_field('submission_start',get_the_ID());
           $submission_enddate = get_field('submission_end',get_the_ID());
           $submission_duration= date_diff(date_create(verify_challenge_datetime_view($submission_enddate,'m/d/y')) , date_create(verify_challenge_datetime_view($submission_startdate,'m/d/y')));
           $submission_timeline=$submission_duration->days;
           $allchallengedata[get_the_ID()][]= get_the_title(get_the_ID());
           $allchallengedata[get_the_ID()][]=verify_challenge_datetime_view($submission_startdate,'Y-m-d');
           $allchallengedata[get_the_ID()][]=verify_challenge_datetime_view($submission_enddate,'Y-m-d');
          
           
     endwhile;
    endif;
   
  
    return $allchallengedata;
    
}
function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}


add_action('shutdown',function(){if(is_page('Pie Chart')){getHostData(); getLegalAuthorityData();}});

function getLegalAuthorityData()
{
    
    $allchallenges = array(
		'posts_per_page' => -1,
		'post_type' => 'challenge',
                'post_status' =>  'publish');
    $challenge_query = new WP_Query( $allchallenges );
    
    if($challenge_query->have_posts() ): 
     while( $challenge_query->have_posts() ) : $challenge_query->the_post();
            $legal_authority = get_field('legal_authority',get_the_ID());
            
           if(isset($data[$legal_authority]))
           {
              $data[$legal_authority]++;
           }
           else{
            $data[$legal_authority]=1;
           }
     endwhile;
    endif;
   foreach($data as $authorityname => $authorityval)
        {
              $jsonauthority[] = array(
                "Authority" => $authorityname,
               "Challenge_Authoruty_Cnt" => $authorityval
            );
        }
       
        ?>
         <script type="text/javascript">
     var chart;
    DrawAuthorityPieChart();
    function DrawAuthorityPieChart()
    {
    
    AmCharts.ready(function() {
       
    
     var chartAuthorityData=<?php echo json_encode( $jsonauthority );?>;
    console.debug(chartAuthorityData);
        chart = new AmCharts.AmPieChart();
        chart.valueField = "Challenge_Authoruty_Cnt";
        chart.titleField = "Authority";
        chart.dataProvider = chartAuthorityData;
       // chart.allLabels=<?php echo json_encode( $jsonhostables );?>;
        
        chart.write("chartlegalauthoritydiv");
        });
    }
         </script>
   <?php 
     
}
function getHostData()
{
     /* Pie Chart for host */
    
    $hostargsinternal = array(
		'posts_per_page' => -1,
		'post_type' => 'challenge',
                'post_status' =>  'publish',
        
		'meta_query' => array(
                        array(
			'key' => 'where_host',
			'value' => 'local'
			))
		);
	$internal_challenge = new WP_Query($hostargsinternal);
         $internal_challenge_count=$internal_challenge->found_posts;
        
        /* Count total prizes for internal challenge */
        if( $internal_challenge->have_posts() ):
   
   $total_internal_cache_prize=0;
      while( $internal_challenge->have_posts() ) : $internal_challenge->the_post();
   
             //$cache_amt=get_field('the_cash_amount',get_the_ID());
             $the_prizes = get_field('the_prizes');
             foreach ($the_prizes as $this_prize)
             {
                $this_cash_value = $this_prize['the_cash_amount'];
                $total_internal_cache_prize+=$this_cash_value;
               
             }
            
        endwhile;
        
        
 
    endif;
        
        $hostargsexternal = array(
		'posts_per_page' => -1,
		'post_type' => 'challenge',
                'post_status' =>  'publish',
        
		'meta_query' => array(
                        array(
			'key' => 'where_host',
			'value' => 'remote'
			))
		);
	$external_challenge = new WP_Query($hostargsexternal);
        $external_challenge_count=$external_challenge->found_posts;
        
    /* Count total prizes for external challenge */
    
    if( $external_challenge->have_posts() ):
         $total_external_cache_prize=0;
      while( $external_challenge->have_posts() ) : $external_challenge->the_post();
   
            $the_prizes = get_field('the_prizes');
            foreach ($the_prizes as $this_prize)
            {
                $this_cash_value = $this_prize['the_cash_amount'];
                $total_external_cache_prize+=$this_cash_value;
               
            }
           
    endwhile;
        
         
    endif;
    
    
        $total=$internal_challenge_count+$external_challenge_count;
        
        $total_prizes=$total_internal_cache_prize+$total_external_cache_prize;
         
        
        $challengeHostDetail=array("Internal"=>$internal_challenge_count,"External"=>$external_challenge_count);
        $challengePrizeDetails=array("Internal"=>$total_internal_cache_prize,"External"=>$total_external_cache_prize);
         $colors=array("#FF0F00", "#FF6600", "#FF9E01");
         $h=0;
         $verticle=40;
        foreach($challengeHostDetail as $hostkey => $hostval)
        {
              $jsonhost[] = array(
                "challengecount" => $hostval,
               "Where_Host" => $hostkey,
              
            );
                $jsonhostables[]= array("text" => $hostkey."=>".$hostval,
                          "x" => 0,
                          "y"=> $verticle,
                          "color"=>$colors[$h]
                          );
                 $verticle=$verticle+20;
                 $h++;
        }
       $jsonhost[] = array(
                "challengecount" => $total,
               "Where_Host" => "Grand Total",
            );
       $jsonhostables[]=array("text" => "Grand Total=>".$total,
                               "x" => 0,
                          "y"=> $verticle,
                           "color"=>$colors[$h]);
       $i=40;
       $k=0;
      foreach($challengePrizeDetails as $prizekey => $prizeval)
        {
              $jsonprize[] = array(
                "challengeprizecnt" => $prizeval,
               "Where_Host" => $prizekey,
              
            );
              
              $this_cash_value = number_format((double)$prizeval, 2, '.', ',');
                $jsonprizelables[]= array("text" => $prizekey."=>$".$this_cash_value,
                          "x" => 0,
                          "y"=> $i,
                          "color"=>$colors[$k]
                          );
                 $i=$i+20;
                 $k++;
        
        }
        
       $jsonprize[] = array(
                "challengeprizecnt" => $total_prizes,
               "Where_Host" => "Grand Total",
              
            );
       
      $this_cash_value = number_format((double)$total_prizes, 2, '.', ',');
      $jsonprizelables[]=array("text" => "Grand Total=>$".$this_cash_value,
                               "x" => 0,
                          "y"=> $i,
                           "color"=>$colors[$k]);
 ?>       
  <script type="text/javascript">
   var chart;

function drawPiecharts()
{

  AmCharts.ready(function() {
   
  var chartHostData=<?php echo json_encode( $jsonhost );?>;

    chart = new AmCharts.AmPieChart();
    chart.valueField = "challengecount";
    chart.titleField = "Where_Host";
    chart.dataProvider = chartHostData;
    chart.allLabels=<?php echo json_encode( $jsonhostables );?>;
    
    chart.write("charthostdiv");
    
    var chartPrizeData=<?php echo json_encode( $jsonprize );?>;

    chart = new AmCharts.AmPieChart();
    chart.valueField = "challengeprizecnt";
    chart.titleField = "Where_Host";
    chart.dataProvider = chartPrizeData;
    chart.allLabels=<?php echo json_encode( $jsonprizelables );?>;
    chart.write("chartprizediv"); 

});
}
drawPiecharts();
        </script>
 <?php
    }
   
  
   function add_field() {
    
    global $profileuser;
    $user_id = $profileuser->ID;
    $userdata=get_user_meta($user_id);
    
    ?>
    <script type="text/javascript">
    jQuery(function($) {
        var scntDiv = $('#user_extra_fields');
        var i = $('#user_extra_fields p').size() + 1;
        
        $('#addfield').live('click', function() {
                $('<p><label for="userfieldlable"><input type="text" id="userfieldlable" size="20" name="field_lable_' + i +'" value="" placeholder="Input Title" /></label><label for="userfieldvalue"><input type="text" id="userfieldvalue" size="40" name="field_value_' + i +'" value="" placeholder="Input Value" /></label><a href="#" id="removefield">Remove</a></p>').appendTo(scntDiv);
                i++;
                $("#totalfieldcnt").val(i);
                return false;
        });
        
        $('#removefield').live('click', function() { 
                if( i > 2 ) {
                        $(this).parents('p').remove();
                        i--;
                        $("#totalfieldcnt").val(i);
                }
                return false;
        });
    });
    </script>
<?php
    $output='<h3><a href="#" id="addfield">Add field</a></h3>
            <div id="user_extra_fields">';
            $hasfieldval=false;
            $k=0;
            if(isset($userdata) && $userdata!="")
            {
                foreach($userdata as $userkey => $userval)
                {
                                    
                   if (strpos($userkey,'_field_') !== false) {
                    $k++;
                    $hasfieldval=true;
                        $usermetakey= $userkey;
                        
                        $usermetaval=get_user_meta($user_id,$userkey);
                        
                        $output.='<p>
                            <label for="userfieldlable"><input type="text" id="userfieldlable" size="20" name="field_lable_'.$k.'" value="'.esc_attr(substr($usermetakey,7)).'" placeholder="Input Title" /></label>
                            <label for="userfieldvalue"><input type="text" id="userfieldvalue" size="40" name="field_value_'.$k.'" value="'.esc_attr($usermetaval[0]).'" placeholder="Input Value" /></label>
                        <a href="#" id="removefield">Remove</a></p>';
                    }
                }
            } 
            if($hasfieldval==false)
            {
                $k=1;
                $output.'<p>
                            <label for="userfieldlable"><input type="text" id="userfieldlable" size="20" name="field_lable_1" value="" placeholder="Input Title" /></label>
                            <label for="userfieldvalue"><input type="text" id="userfieldvalue" size="40" name="field_value_1" value="" placeholder="Input Value" /></label>
                        </p>';
            }
            $output.='<input type="hidden" name="totalfieldcnt" id="totalfieldcnt" value="'.$k.'"></div>';
       echo $output;        

}

add_action( 'edit_user_profile', 'add_field' );
add_action('show_user_profile', 'add_field');

function save_custom_user_profile_fields( $user_id ) {
    
    if ( !current_user_can( 'edit_user', $user_id ) )
        return FALSE;
         
         $userdata=get_user_meta($user_id);
          if(isset($userdata) && $userdata!="")
            {
                foreach($userdata as $userkey => $userval)
                {
                                    
                   if (strpos($userkey,'_field_') !== false) {
                    $usermetakey= $userkey;
                     delete_user_meta($user_id,$usermetakey);
                   }
                }
            }    
         
        for($i=1; $i<=$_POST['totalfieldcnt']; $i++)
        {
            $fieldname=$_POST['field_lable_'.$i];
            $fieldval=$_POST['field_value_'.$i];
           
            if(isset($fieldname) &&  $fieldname!="" && isset($fieldval) && $fieldval!="")
            {
                update_user_meta( $user_id, '_field_'.$fieldname, $fieldval );
            } 
        } 
}

add_action( 'personal_options_update', 'save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_custom_user_profile_fields' );

function change_author_permalinks() {
   global $wp_rewrite;
   
   $wp_rewrite->author_base = 'profile';
}
add_action('init','change_author_permalinks');

function get_meta_values( $key = '',  $type = 'post', $status = 'publish') {
    global $wpdb;
if( empty( $catid ) ) $catid = '1';
    if( empty( $key ) )
        return;
    $r = $wpdb->get_results( $wpdb->prepare( "
        SELECT p.ID, pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        
        WHERE pm.meta_key = '%s'
        AND p.post_status = '%s'
        AND p.post_type = '%s'
       
    ", $key, $status, $type, $tax, $catid ));

    foreach ( $r as $my_r )
        $metas[$my_r->ID] = $my_r->meta_value;

    return $metas;
}

add_action('init', function (){   
    if(isset($_GET['loginpost']) && $_GET['loginpost']==1)
        {
            $username=sanitize_text_field($_POST['log']);
            $pass=sanitize_text_field($_POST['pwd']);
            $user = get_user_by( 'login', $username );
            
            if ( $user && wp_check_password( $pass, $user->data->user_pass, $user->ID) ){
              if(strpos($_SERVER['HTTP_REFERER'], "login") !== FALSE)   
                $redirectlink=site_url().'/list/';
              else
                $redirectlink = esc_url($_SERVER['HTTP_REFERER']);
              wp_set_auth_cookie($user->ID);
              wp_set_current_user($user->ID);
              wp_redirect($redirectlink);
              exit;
            }
            else{
                $error = __('Incorrect Username or Password entered.');
                $_SESSION['login_error']=$error;
                
               // echo $error;
            }

           
        }
        else if (isset($_GET['tab']) && $_GET['tab']==5){
            $username=sanitize_text_field($_POST['log']);
            $pass=sanitize_text_field($_POST['pwd']);
            $user = get_user_by( 'login', $username );
            if ( $user && wp_check_password( $pass, $user->data->user_pass, $user->ID) ){
              if(strpos($_SERVER['HTTP_REFERER'], "login") !== FALSE) 
                $redirectlink = site_url().'/list/';
              else
                $redirectlink = $_SERVER['HTTP_REFERER']. '?tab=5';
              wp_set_auth_cookie($user->ID);
              wp_set_current_user($user->ID);
              wp_redirect($redirectlink);
              exit;    
            }
            else{
                $error = __('Incorrect Username or Password entered.');
                $_SESSION['login_error']=$error;
              $redirectlink = esc_url($_SERVER['HTTP_REFERER']);
              wp_redirect(add_query_arg('login','incorrect',$redirectlink));
            }
        }   
});

function wp_login_form_frontend( $args = array(), $page,$error='' ) {
    
   //ob_start();

	$defaults = array(
		'echo' => true,
		'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], // Default redirect is back to the current page
		'form_id' => 'loginform',
		'label_username' => __( 'Username' ),
		'label_password' => __( 'Password' ),
		'label_remember' => __( 'Remember Me' ),
		'label_log_in' => __( 'Log in' ),
		'id_username' => 'user_login',
		'id_password' => 'user_pass',
		'id_remember' => 'rememberme',
		'id_submit' => 'wp-submit',
		'remember' => true,
		'value_username' => '',
		'value_remember' => false, // Set this to true to default the "Remember me" checkbox to checked
	);

	/**
	 * Filter the default login form output arguments.
	 *
	 * @since 3.0.0
	 *
	 * @see wp_login_form()
	 *
	 * @param array $defaults An array of default login form arguments.
	 */
	$args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );
	/**
	 * Filter content to display at the top of the login form.
	 *
	 * The filter evaluates just following the opening form tag element.
	 *
	 * @since 3.0.0
	 *
	 * @param string $content Content to display. Default empty.
	 * @param array  $args    Array of login form arguments.
	 */
	$login_form_top = apply_filters( 'login_form_top', '', $args );

	/**
	 * Filter content to display in the middle of the login form.
	 *
	 * The filter evaluates just following the location where the 'login-password'
	 * field is displayed.
	 *
	 * @since 3.0.0
	 *
	 * @param string $content Content to display. Default empty.
	 * @param array  $args    Array of login form arguments.
	 */
	$login_form_middle = apply_filters( 'login_form_middle', '', $args );

	/**
	 * Filter content to display at the bottom of the login form.
	 *
	 * The filter evaluates just preceding the closing form tag element.
	 *
	 * @since 3.0.0
	 *
	 * @param string $content Content to display. Default empty.
	 * @param array  $args    Array of login form arguments.
	 */
	$login_form_bottom = apply_filters( 'login_form_bottom', '', $args );
         
    if ($page == "challenge"){
      $arr_params = array('tab' => 5 );
      $redirectlink = add_query_arg($arr_params, get_permalink());
    }
    else{
        $redirectlink=add_query_arg('loginpost',true,site_url().'/login/');
    }
	$form = '<div class = "public-login">';
   if(isset($_SESSION['login_error']) && $_SESSION['login_error']!="")
    {
        
        $form .= '<p class="challenge_login_error">'.$_SESSION['login_error'].'</p>';
    }

    $form .='<p class = "omb-register"><strong>Federal Challenge Managers Only:</strong> <a href = "'.site_url().'/wp-login.php?ombAuth=1&redirect_to='.site_url().'/login">Log in</a>.
    Managers must use your OMB MAX account for secure access. If you need an account, go to <a href="https://max.omb.gov/maxportal/registrationForm.action" target="_blank">OMB</a>.</p>
    <hr style="border-color:#000;"><p><strong>Solvers, Inventors, Entrepreneurs, and Fans:</strong> Sign in to submit your solutions or edit your profile.</p>
        <div style="margin-top:15px;font-weight:bold;">Log in:</div>
        </br>
		<form name="' . $args['form_id'] . '" id="' . $args['form_id'] . '" action="' . esc_url($redirectlink) . '" method="post">
			' . $login_form_top . '
			<p class="login-username">
				<label class = "sr-only" for="' . esc_attr( $args['id_username'] ) . '">' . esc_html( $args['label_username'] ) . '</label>
				<input type="text" name="log" id="' . esc_attr( $args['id_username'] ) . '" placeholder = "Username" class="form-control" value="' . esc_attr( $args['value_username'] ) . '" size="20" />
			</p>
			<p class="login-password">
				<label class = "sr-only" for="' . esc_attr( $args['id_password'] ) . '">' . esc_html( $args['label_password'] ) . '</label>
				<input type="password" name="pwd" id="' . esc_attr( $args['id_password'] ) . '" placeholder = "Password" class="form-control" value="" size="20" />
			</p>
      <a href = "'.site_url("forgot-password").'">Forgot your Password?</a>
			<center>
      <p class="login-submit">
        </br>
				<input type="submit" name="wp-submit" id="' . esc_attr( $args['id_submit'] ) . '" class="button-primary login-button" value="' . esc_attr( $args['label_log_in'] ) . '" />
				<input type="hidden" name="redirect_to" value="' . esc_url( $args['redirect'] ) . '" />
			</p>
      </center>
			' . $login_form_bottom . '
		</form>
      <p>New to Challenge.gov?</p>
      <a href = "'.site_url("registration").'">Register for an account</a>
      <p><strong>There is no cost for the public to participate in the Challenge Program.</strong></p>
    </div>';
    unset($_SESSION['login_error']);
       return $form;
       
    //   $output = ob_get_contents();
    //ob_end_clean();
    //return $output;
	/*if ( $args['echo'] )
            return $form;
	else
            return $form;*/
  
}
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

add_filter( 'ajax_query_attachments_args', "user_restrict_media_library" );
function user_restrict_media_library(  $query ) {
    global $current_user;
    if ( $current_user->roles[0] =='public_user')
    {
        $query['author'] = $current_user->ID ;
        
    }
   return $query;
}

function delete_folower( $user_id ) {
  global $pagenow;
  if($pagenow== 'users.php')
  { 
	
       $followed_challenges=get_meta_values('followed_challenges','challenge');
	
      
      if(isset($followed_challenges) && $followed_challenges!="")
      {
          foreach($followed_challenges as $post_id=>$userids)
          {
           	$follower_array_unserial = array();
           
              $follower_array_unserial=maybe_unserialize($userids);
			
			
             
			/*if(is_array($follower_array_unserial[$post_id]))
             {
                  foreach($follower_array_unserial[$post_id] as $key=>$val)
                  {
                      $follower_array_unserial_temp[$key]=maybe_unserialize($val);
                  }
                  
				  
				  }*/
		
             
			//$follow_array = $follower_array_unserial;
            
             if(in_array($user_id,$follower_array_unserial))
              {
             
                $key=array_search($user_id,$follower_array_unserial);
                unset($follower_array_unserial[$key]);
				update_post_meta($post_id, 'followed_challenges', $follower_array_unserial); 
              }
			
              
          }
       
      }
  }   
}
add_action( 'delete_user', 'delete_folower' );
add_action( 'remove_user_from_blog', 'delete_folower' );


function wpisl_get_default_options() {
	$wpisl = new WP_Image_Size_Limit;
	$limit = $wpisl->wp_limit();
        $limit=5000; // 5MB
	$default_options = array(
		'img_upload_limit' => $limit,
	);

	return apply_filters( 'wpisl_default_options', $default_options );
}

/*
 *one time process
 *add_option( 'wpisl_options', wpisl_get_default_options() );
*/
function max_up_size() {
	return 5242880; // 5 MB
}


class Challenge_Image_Size_Limit {
        
	public function __construct()  {
		
		add_filter('wp_handle_upload_prefilter', array($this, 'challenge_checksize_of_picture'));
	}  

	

	public function challenge_get_limit() {
		$option = get_option('wpisl_options');

		if ( isset($option['img_upload_limit']) ){
			$limit = $option['img_upload_limit'];
		} else {
			$limit = $this->challenge_wp_limit();
		}

		return $limit;
	}

	public function challenge_output_limit() {
		$limit = $this->challenge_get_limit();
		$limit_output = $limit;
		$mblimit = $limit / 1000;


		if ( $limit >= 1000 ) {
			$limit_output = $mblimit;
		}

		return $limit_output;
	}

	public function challenge_wp_limit() {
		$output = wp_max_upload_size();
		$output = round($output);
		$output = $output / 1000000; //convert to megabytes
		$output = round($output);
		$output = $output * 1000; // convert to kilobytes

		return $output;

	}

	public function challenge_limit_unit() {
		$limit = $this->challenge_get_limit();

		if ( $limit < 1000 ) {
			return 'KB';
		}
		else {
			return 'MB';
		}

	}

	public function challenge_checksize_of_picture($file) {
		$size = $file['size'];
		$size = $size / 1024;
		$type = $file['type'];
		$is_image = strpos($type, 'image');
		$limit = $this->challenge_get_limit();
		$limit_output = $this->challenge_output_limit();
		$unit = $this->challenge_limit_unit();

	   if ( ( $size > $limit ) && ($is_image !== false) ) {
	     $file['error'] = 'Image files must be smaller than '.$limit_output.$unit;
	     if (WPISL_DEBUG) {
	     	$file['error'] .= ' [ filesize = '.$size.', limit ='.$limit.' ]';
	     }
	  }
	  return $file;
	}

	
}
$Challenge_Image_Size_Limit = new Challenge_Image_Size_Limit;
if(strpos($_SERVER['REQUEST_URI'],'edit-author=true')>0)
{
    //$WP_Image_Size_Limit = new WP_Image_Size_Limit;
    add_filter('upload_size_limit', 'max_up_size');
}


    /*add_filter('wp_handle_upload_prefilter', 'error_message');
    function error_message($file) {
        
		$size = $file['size'];
		$size = $size / 1024;
		$type = $file['type'];
		$is_image = strpos($type, 'image');
		$limit = get_limit();
		$limit_output = output_limit();
		$unit = limit_unit();

	   if ( ( $size > $limit ) && ($is_image !== false) ) {
	     $file['error'] = 'Image files must be smaller than '.$limit_output.$unit;
	     if (WPISL_DEBUG) {
	     	$file['error'] .= ' [ filesize = '.$size.', limit ='.$limit.' ]';
	     }
	  }
	  return $file;
    }
    
    function get_limit() {
		$option = get_option('wpisl_options');

		if ( isset($option['img_upload_limit']) ){
			$limit = $option['img_upload_limit'];
		} else {
			$limit = wp_limit();
		}

		return $limit;
	}

    function output_limit() {
		$limit = get_limit();
		$limit_output = $limit;
		$mblimit = $limit / 1000;


		if ( $limit >= 1000 ) {
			$limit_output = $mblimit;
		}

		return $limit_output;
	}

    function wp_limit() {
		$output = wp_max_upload_size();
		$output = round($output);
		$output = $output / 1000000; //convert to megabytes
		$output = round($output);
		$output = $output * 1000; // convert to kilobytes

		return $output;

	}

    function limit_unit() {
		$limit = get_limit();

		if ( $limit < 1000 ) {
			return 'KB';
		}
		else {
			return 'MB';
		}

	}
}*/
/*
add_action('wp_footer',function()
{
     $allchallenges = array(
		'posts_per_page' => -1,
		'post_type' => 'challenge',
                'post_status' =>  'publish',
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key'     => 'legal_authority',
                        'value'   => 'America Competes',
                        //'value'   => 'Unknown',
                         // 'value'   => 'Undisclosed',
                        // 'value'   => 'other',
                        'compare' => '='
                    )));
    
    

    
    
    $challenge_query = new WP_Query( $allchallenges );
   
    if($challenge_query->have_posts() ): 
     while( $challenge_query->have_posts() ) : $challenge_query->the_post();
            $legal_authority = get_field('legal_authority',get_the_ID());
           
            //update_post_meta(get_the_ID(), 'legal_authority', 'America COMPETES');
            //update_post_meta(get_the_ID(), 'legal_authority', 'Unspecified');

           //echo $legal_authority."==".get_the_ID()."<br>";
           
           endwhile;
    endif;
});
function remove_menus () {
global $menu;

 if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency'))) {
$restricted = array(); } // check if admin and hide nothing
else { // for all other users
remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'edit.php' );                   //Posts
  remove_menu_page( 'upload.php' );                 //Media
  remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit.php?post_type=challenge' );    //Pages
  remove_menu_page( 'edit.php?post_type=solution' );    //Pages
  remove_menu_page( 'edit.php?post_type=agency' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  remove_menu_page( 'themes.php' );                 //Appearance
  remove_menu_page( 'plugins.php' );                //Plugins
  remove_menu_page( 'users.php' );                  //Users
  remove_menu_page( 'tools.php' );                  //Tools
  remove_menu_page( 'options-general.php' );        //Settings
}
}
add_action('admin_menu', 'remove_menus');*/

add_action( 'admin_init', 'redirect_non_admin_users' );

function redirect_non_admin_users() {
   
	if ( is_user_logged_in() && !(current_user_can('create_users') || current_user_can('all_access_agency')) && ('/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF']) && ('/wp-admin/async-upload.php'!= $_SERVER['PHP_SELF'])  && ('/wp-admin/media-upload.php' != $_SERVER['PHP_SELF'] )) {
		wp_redirect( home_url() );
		exit;
	}
}

if(!function_exists('update_challenge_newsletters_by_user')){
    function update_challenge_newsletters_by_user($author, $this_post_key){
        //error_log('update by user called');
        $debug = get_option('challenge_mailchimp_debug','');
        $global_list_id = get_option('_challenge_newsltr_global_id','');
        $this_user = get_user_by('id',$author);
        $get_apikey = get_option('ChallChimp_api','');
        
        if(!$debug){
            if ( is_plugin_active( 'challenge-mailchimp/challenge_mailchimp.php' ) ) {
                //error_log(plugin_dir_path().'challenge-mailchimp/challenge-mailchimp.class.php');
                //error_log('ABS: '.ABSPATH.'wp-content/plugins/challenge-mailchimp/challenge-mailchimp.class.php');
                if(!class_exists('Challenge_Mailchimp'))
                    require_once(ABSPATH.'wp-content/plugins/challenge-mailchimp/challenge-mailchimp.class.php');
                if(class_exists('Challenge_Mailchimp')){
                    $mailchimp = new Challenge_Mailchimp($get_apikey);

                    //Update Global Newsletter
                    if($this_post_key == 'global-newsletter'){
                        if(get_user_meta($author, 'challenge_global_newsletter', 1) == '1'){
                            $new_user = $mailchimp->post('lists/'.$global_list_id.'/members',
                                array(
                                    'status' => 'subscribed',
                                    'email_address' => $this_user->data->user_email,
                                    'merge_fields' => array('WPUSER' => $this_user->data->user_login),
                                ));
                            //error_log('added user to global newsletter');
                            //error_log(print_r($new_user,1));
                        }else{
                            $member_info = $mailchimp->get('lists/'.$global_list_id.'/members');
                            $member_found = false;
                            if(!empty($member_info)){
                                foreach($member_info['members'] as $this_member){
                                    $member_array[$this_member['id']] = $this_member['email_address'];
                                    if($this_member['email_address'] == $this_user->data->user_email)
                                        $member_found = true;
                                }
                                if($member_found){
                                    if(in_array($this_user->data->user_email, $member_array)){
                                        $this_key = array_search($this_user->data->user_email, $member_array);
                                        $remove_user = $mailchimp->delete('lists/'.$global_list_id.'/members/'.$this_key);
                                        //error_log('removed user from global list');
                                        //error_log(print_r($remove_user,1));
                                    }
                                }
                            }
                        }
                    }
                    //Update Skills or Interests
                    if($this_post_key == 'skills-newsletter' || $this_post_key == 'interests-newsletter')
                    {
                        if($this_post_key == 'skills-newsletter'){
                            $these_options = array('field' => 'user_internal_interests',
                                'option_key' => '_challenge_newsltr_skill_',
                                'meta_key' => 'challenge_skills_newsletter'
                                );
                        }
                        elseif($this_post_key == 'interests-newsletter'){
                            $these_options = array('field' => 'user_interests',
                                'option_key' => '_challenge_newsltr_int_',
                                'meta_key' => 'challenge_interests_newsletter'
                                );
                        }
                        //foreach($these_options as $this_option){
                            $these_lists = get_user_meta($author, $these_options['field'], 1);
                            if(!empty($these_lists)){
                                if(isset($these_lists['additional_interest']))
                                    unset($these_lists['additional_interest']);
                                foreach($these_lists as $this_list => $this_value){
                                    $list_id = get_option($these_options['option_key'].$this_list,''); //foreach skill / interest that this user has
                                    if(!empty($list_id)){
                                        if(get_user_meta($author, $these_options['meta_key'], 1) == '1'){
                                            if(!$debug){
                                                $new_user = $mailchimp->post('lists/'.$list_id.'/members',
                                                    array(
                                                        'status' => 'subscribed',
                                                        'email_address' => $this_user->data->user_email,
                                                        'merge_fields' => array('WPUSER' => $this_user->data->user_login),
                                                    ));
                                                //error_log('new user for '.$these_options['meta_key']);
                                                //error_log(print_r($new_user,1));
                                            }
                                        }else{
                                            if(!$debug){
                                                $member_info = $mailchimp->get('lists/'.$list_id.'/members');
                                                $member_found = false;
                                                //error_log('getting member_info for list id: '.$list_id);
                                                //error_log(print_r($member_info,1));
                                                if(!empty($member_info) && !isset($member_info['title'])){
                                                    foreach($member_info['members'] as $this_member){
                                                        $member_array[$this_member['id']] = $this_member['email_address'];
                                                        if($this_member['email_address'] == $this_user->data->user_email)
                                                            $member_found = true;
                                                    }
                                                    if($member_found){
                                                        if(in_array($this_user->data->user_email, $member_array)){
                                                            $this_key = array_search($this_user->data->user_email, $member_array);
                                                            $remove_user = $mailchimp->delete('lists/'.$list_id.'/members/'.$this_key);
                                                            //error_log('removed user from '.$these_options['meta_key']);
                                                            //error_log(print_r($remove_user,1));
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        //}
                    }

                    if($this_post_key == 'agency-newsletter')
                    {
                        global $wpdb;

                        $get_apikey = get_option('ChallChimp_api','');
                        $debug = get_option('challenge_mailchimp_debug');
                        $users_following = '';
                        $mailchimp = new Challenge_Mailchimp($get_apikey);
                        $counter = 0;
                        $completedItems = array();
                        $merge_fields = array();
                        $post_submitters = array();

                        $args = array(
                            'post_type' => 'agency',
                            'post_status' => 'publish',
                            'posts_per_page' => '-1',
                        );

                        $loop = new WP_Query($args);
                        $this_table_id = get_current_blog_id() == 1 ? '' : '_'.get_current_blog_id();
                        if(count($loop->posts) > 0)
                        {
                            foreach($loop->posts as $this_post){
                                $counter++;
                                $list_id = get_post_meta($this_post->ID, '_challenge_newsletter_list_id',1);
                                $tax_args = array(
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'agency',
                                            'field'    => 'slug',
                                            'terms'    => $this_post->post_title,
                                            'operator' => 'IN'
                                        )
                                    )
                                );
                                $args = array(
                                    'post_type' => 'challenge',
                                    'post_status' => 'publish',
                                    'posts_per_page' => -1,
                                    );
                                $args = array_merge( $args, $tax_args );
                                $this_query = new WP_Query($args);

                                if(count($this_query) > 0)
                                {
                                    $this_user_id = get_current_user_id();
                                    foreach($this_query->posts as $this_chal){
                                        $users_following = get_post_meta($this_chal->ID, 'followed_challenges',1);
                                        if(!empty($list_id) && !empty($users_following)){ //we have users following this particular challenge
                                            if(in_array($this_user_id, $users_following))
                                            {
                                                $this_user_data = get_user_by('id',$this_user_id);
                                                //error_log('checking '.$this_user_id.' for '.$list_id);
                                                if(!$debug){
                                                    if(get_user_meta($this_user_data->ID, 'challenge_agency_newsletter',1) == '1'){ //if user has agency newsletter on
                                                        //error_log('Agency ID: '.$this_post->ID.', List id: '.$list_id);
                                                        $new_user = $mailchimp->post('lists/'.$list_id.'/members',
                                                            array(
                                                                'status' => 'subscribed',
                                                                'email_address' => $this_user_data->data->user_email,
                                                                'merge_fields' => array('WPUSER' => $this_user_data->data->user_login),
                                                            ));
                                                        //error_log('added user to list: '.$list_id.' from: '.$this_chal->post_title);
                                                        //error_log(print_r($new_user,1));
                                                        if($new_user['title'] == 'Member Exists'){
                                                            $completedItems[] = $this_user_data->data->user_email.' <span style="color:red;">is already subscribed to </span>Agency: '.$this_post->post_title;
                                                        }
                                                        elseif($new_user['title'] == 'Resource Not Found')
                                                            $completedItems[] = $this_user_data->data->user_email.' <span style="color:red;">not subscribed to </span>Agency: '.$this_post->post_title.'. <span style="color:red;">List does not exist.</span>';
                                                        else
                                                            $completedItems[] = $this_user_data->data->user_email.' <span style="color:green;">has been subscribed to </span>Agency: '.$this_post->post_title;
                                                    }else{
                                                        $member_info = $mailchimp->get('lists/'.$list_id.'/members');
                                                        $member_found = false;
                                                        if(!empty($member_info)){
                                                            $member_array = array();
                                                            foreach($member_info['members'] as $this_member){
                                                                $member_array[$this_member['id']] = $this_member['email_address'];
                                                                if($this_member['email_address'] == $this_user_data->data->user_email)
                                                                    $member_found = true;
                                                            }
                                                            if($member_found){
                                                                if(in_array($this_user_data->data->user_email, $member_array)){
                                                                    $this_key = array_search($this_user_data->data->user_email, $member_array);
                                                                    $remove_user = $mailchimp->delete('lists/'.$list_id.'/members/'.$this_key);
                                                                    //error_log('removed user from list: '.$list_id);
                                                                    //error_log(print_r($remove_user,1));
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                    //Update Challenge Types

                    //Update Challenges Following / Submitted
                }else{
                    error_log('Mailchimp Class Not Loaded');
                }
            }else{
                error_log('Plugin not active');
            }
        }
    }
}

function challenge_email_validator($email_address='' ){
        //Validator will fail on apostrophes when is_email is called if we don't check the POST var instead of $email_address
        $user_email_address = ($_POST['email']) ? $_POST['email'] : $email_address;
        if(filter_var(stripslashes($user_email_address), FILTER_VALIDATE_EMAIL)){
            return stripslashes($user_email_address);
        } else {
            return false;
        }
}
add_filter('is_email', 'challenge_email_validator', 1, 1);
add_filter( 'sanitize_email', 'challenge_email_validator', 1, 1 );

function preprocess_challenge_comment_handler( $commentdata ) {
    $commentdata['comment_content'] = strip_tags($commentdata['comment_content'], '<br>');
    return $commentdata;
}
add_filter( 'preprocess_comment' , 'preprocess_challenge_comment_handler' );

function add_post_authored_by_meta_boxes() {
    add_meta_box("challenge_blog_subheading", "Subheading", "add_challenge_blog_subheading_meta_box","post","normal","high");
    add_meta_box("challenge_authored_by", "Authored By", "add_challenge_authored_by_meta_box", "post", "normal", "high");
}

function add_challenge_authored_by_meta_box()
{
    global $post;
    $custom_author = get_post_meta( get_the_ID(), 'blog_author', true );
 
    ?>
    <style>.width99 {width:99%;}</style>
    <p>
        <label>Author:</label><br />
        <input type="text" name="blog_author" value="<?php echo !empty($custom_author) ? $custom_author : '' ?>" class="width99" />
    </p>
    <?php
}

function add_challenge_blog_subheading_meta_box( $post ) 
{
    $value = get_post_meta($_GET['post'], 'challenge_blog_subheading' , true );
    wp_editor( htmlspecialchars_decode($value), 'metabox_challenge_subheading_style', $settings = array('textarea_name'=>'challenge_subheading') );
}
/**
 * Save custom field data when creating/updating posts
 */
function save_blog_post_custom_fields(){
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    // Prevent quick edit from clearing custom fields
    if (defined('DOING_AJAX') && DOING_AJAX)
        return;

    if ( $post && $post->post_type == 'post' ){
        update_post_meta($post->ID, "challenge_blog_subheading", $_POST["challenge_subheading"]);   
    }
    if ( $post && $post->post_type == 'post' && isset($_POST["blog_author"]) )
    {
        update_post_meta($post->ID, "blog_author", $_POST["blog_author"]);
    }
}
add_action( 'admin_init', 'add_post_authored_by_meta_boxes' );
add_action( 'save_post', 'save_blog_post_custom_fields' );

if ( ! function_exists( 'challenge_blog_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     *
     * @since Skeleton 1.0
     */
    function challenge_blog_posted_on() {
        $the_author = get_post_meta(get_the_ID(),'blog_author',true);
        $ret = sprintf( __( '<span class="meta-prep meta-prep-author">Posted on</span> %1$s', 'skeleton' ),
            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                get_permalink(),
                esc_attr( get_the_time() ),
                get_the_date()
            )
        );
        if(!empty($the_author))
            $ret .= '<br/>Authored by: '.$the_author;
        if(!is_page('challenge-blog'))
            $ret .= '<br/>';
        return $ret;
    }
endif;

if ( ! function_exists( 'challenge_blog_posted_in' ) ) :
    /**
     * Prints HTML with meta information for the current post (category, tags and permalink).
     *
     * @since Skeleton 1.0
     */
    function challenge_blog_posted_in() {
        // Retrieves tag list of current post, separated by commas.
        $tag_list = get_the_term_list( get_the_ID(), 'blog_tag', '', ', ' );
        if ( $tag_list ) {
            $posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'skeleton' );
        } elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
            $posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'skeleton' );
        } else {
            $posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'skeleton' );
        }
        // Prints the string, replacing the placeholders.
        printf(
            $posted_in,
            get_the_category_list( ', ' ),
            $tag_list,
            get_permalink(),
            the_title_attribute( 'echo=0' )
        );
    }

endif;

/*function mySearchFilter($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', 'post');
    };
    return $query;
};

add_filter('pre_get_posts','mySearchFilter');
*/
add_action( 'init', 'create_blog_tags_taxonomy', 0 );

function create_blog_tags_taxonomy() {

// Labels part for the GUI

  $labels = array(
    'name' => _x( 'Blog Tags', 'taxonomy general name' ),
    'singular_name' => _x( 'Blog Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Blog Tags' ),
    'popular_items' => __( 'Popular Blog Tags' ),
    'all_items' => __( 'All Blog Tags' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Blog Tag' ), 
    'update_item' => __( 'Update Blog Tag' ),
    'add_new_item' => __( 'Add New Blog Tag' ),
    'new_item_name' => __( 'New Blog Tag Name' ),
    'separate_items_with_commas' => __( 'Separate blog tags with commas' ),
    'add_or_remove_items' => __( 'Add or remove blog tags' ),
    'choose_from_most_used' => __( 'Choose from the most used blog tags' ),
    'menu_name' => __( 'Blog Tags' ),
  ); 

// Now register the non-hierarchical taxonomy like tag

  register_taxonomy( 'blog_tag', 'post', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_quick_edit' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'blog-tag' ),
  ));
}
function remove_post_tag_metaboxes(){
    remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'normal' ); 
}
add_action( 'admin_menu' , 'remove_post_tag_metaboxes' );

?>
