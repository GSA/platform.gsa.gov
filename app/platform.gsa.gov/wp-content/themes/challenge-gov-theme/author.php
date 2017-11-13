<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 */
global $curauth;
$user_interests = array();
$user_internal_interests = array();
$curauth = get_userdata(intval($author));
foreach($curauth->roles as $userroles)
{
    $authroles=$userroles.",";
}
$authroles=substr($authroles,0,-1);

$usermetadata=get_user_meta(intval($author));

$cur_user_ID = get_current_user_id();
 
$unauthorized=0;

if($cur_user_ID==intval($author) || current_user_can('create_users'))
{
    $unauthorized=0;
}
else{
    if($usermetadata['is_profile_public'][0]=="private" || $usermetadata['is_profile_public'][0]=="")
    {
        $unauthorized=1;
        wp_redirect( home_url() );
        exit;   
    }
}
if(isset($_GET['edit-author']) && $_GET['edit-author']==true && $unauthorized==1)
{
     wp_redirect( home_url() ); exit;
}

get_header();
  $user_id= isset($_POST['userid']) ? $_POST['userid']: 0;
  if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency'))) {
  }
  else{
    ?>
<style type="text/css">
    .attachment-info .edit-attachment{ display:none; }
</style>
    <?php
  }
?>
<style type="text/css">
    
  #tabs .row{margin:0;}
  #tabs .container{width:100%;padding:0;}
  #tabs .col-md-12{padding:0;}
  #tabs #tabs-2{padding:1em 0;}
  #tabs .display-posts-listing h4{position: relative; height: 55px;}
  #tabs .display-posts-listing h4 a{
    max-height: 50px;
    height:auto;
    position: absolute;
    bottom: 0;
    width: 100%;
    left: 0;
  }
  #tabs .challenge-thumbnail{margin-bottom:5px;}
  #manage-newsletter-div{display: none;
    width:300px;height:300px;border:2px solid #000;
    left: calc(50% - 170px);position:absolute;background: #f1f1f1;z-index: 1;margin-top:50px;
    padding:20px;
  }
</style>
<?php
if(isset($_GET['edit-author-submit']) && $_GET['edit-author-submit']==true)
{   

    $cur_userdata=get_userdata( $author );
    $cur_user_email=$cur_userdata->user_email;
    
    if(empty($_POST['user_email']) || $_POST['user_email']=="" || !is_email($_POST['user_email']))
    {
       
      // $email_failed=true;
        ?>
         <script type="text/javascript">
            jQuery( document ).ready(function($){
                $("#message").show();
                $("#message").addClass('alert-danger');
                $("#message").html('Please enter valid email address');
            });
      </script>
         <?php
    }
    
  else if (email_exists($_POST['user_email'] ) && $cur_user_email!=$_POST['user_email'])
  {
    
  ?>
        <script type="text/javascript">
            jQuery( document ).ready(function($){
                
            $("#message").show();
            $("#message").addClass('alert-danger');
            $("#message").html('This email address is already exists. Please enter different email address.');
            });   
      </script>
        
  <?php
  }
  else
  {

  if($_POST['userid']!="" && isset($_POST['userid']))
  {
    $user_interests = get_user_meta($author, 'user_interests', 1);
    $user_internal_interests = get_user_meta($author, 'user_internal_interests', 1);
    $userdata=array('ID' => $author, 'user_url' => $_POST['user_url'], 'user_email' => $_POST['user_email']);
    
    wp_update_user( $userdata );
    
    if(isset($_POST['agriculture'])){
      $user_interests['agriculture'] = $_POST['agriculture'];
    }
    else{
      if(isset($user_interests['agriculture']))
        unset( $user_interests['agriculture']); 
    }

    if(isset($_POST['business'])){
      $user_interests['business'] = $_POST['business'];
    }
    else{
      if(isset($user_interests['business']))
        unset( $user_interests['business']); 
    }
    if(isset($_POST['climate'])){
      $user_interests['climate'] = $_POST['climate'];
    }
    else{
      if(isset($user_interests['climate']))
        unset( $user_interests['climate']); 
    }
    if(isset($_POST['consumer'])){
      $user_interests['consumer'] = $_POST['consumer'];
    }
    else{
      if(isset($user_interests['consumer']))
        unset( $user_interests['consumer']); 
    }
    if(isset($_POST['ecosystems'])){
      $user_interests['ecosystems'] = $_POST['ecosystems'];
    }    
    else{
      if(isset($user_interests['ecosystems']))
        unset( $user_interests['ecosystems']); 
    }

    if(isset($_POST['education'])){
      $user_interests['education'] = $_POST['education'];
    }    
    else{
      if(isset($user_interests['education']))
        unset( $user_interests['education']);  
    }
    if(isset($_POST['energy'])){
      $user_interests['energy'] = $_POST['energy'];
    }    
    else{
      if(isset($user_interests['energy']))
        unset( $user_interests['energy']);  
    }
    if(isset($_POST['finance'])){
      $user_interests['finance'] = $_POST['finance'];
    }    
    else{
      if(isset($user_interests['finance']))
        unset( $user_interests['finance']);  
    }
    if(isset($_POST['health'])){
      $user_interests['health'] = $_POST['health'];
    }    
    else{
      if(isset($user_interests['health']))
        unset( $user_interests['health']);  
    }
    if(isset($_POST['government'])){
      $user_interests['government'] = $_POST['government'];
    }    
    else{
      if(isset($user_interests['government']))
        unset( $user_interests['government']);  
    }

    if(isset($_POST['manufacturing'])){
      $user_interests['manufacturing'] = $_POST['manufacturing'];
    }    
    else{
      if(isset($user_interests['manufacturing']))
        unset( $user_interests['manufacturing']);  
    }

    if(isset($_POST['ocean'])){
      $user_interests['ocean'] = $_POST['ocean'];
    }    
    else{
      if(isset($user_interests['ocean']))
        unset( $user_interests['ocean']);  
    }

    if(isset($_POST['safety'])){
      $user_interests['safety'] = $_POST['safety'];
    }    
    else{
      if(isset($user_interests['safety']))
        unset( $user_interests['safety']);  
    }

    if(isset($_POST['research'])){
      $user_interests['research'] = $_POST['research'];
    }    
    else{
      if(isset($user_interests['research']))
        unset( $user_interests['research']);  
    }
    if(isset($_POST['software'])){
      $user_internal_interests['software'] = $_POST['software'];
    }
    else{
      if(isset($user_internal_interests['software']))
          unset($user_internal_interests['software']); 
    }

    if(isset($_POST['scientific'])){
      $user_internal_interests['scientific'] = $_POST['scientific'];
    }
    else{
      if(isset($user_internal_interests['scientific']))
        unset( $user_internal_interests['scientific']); 
    }
    if(isset($_POST['algorithms'])){
      $user_internal_interests['algorithms'] = $_POST['algorithms'];
    }
    else{
      if(isset($user_internal_interests['algorithms']))
        unset( $user_internal_interests['algorithms']); 
    }
    if(isset($_POST['ideas'])){
      $user_internal_interests['ideas'] = $_POST['ideas'];
    }
    else{
      if(isset($user_internal_interests['ideas']))
        unset( $user_internal_interests['ideas']); 
    }
    if(isset($_POST['engineering'])){
      $user_internal_interests['engineering'] = $_POST['engineering'];
    }    
    else{
      if(isset($user_internal_interests['engineering']))
        unset( $user_internal_interests['engineering']); 
    }
    if(isset($_POST['plans'])){
      $user_internal_interests['plans'] = $_POST['plans'];
    }      
    else{
      if(isset($user_internal_interests['plans']))
        unset( $user_internal_interests['plans']);  
    }  
    // if(isset($_POST['softwaredesign'])){
    //   $user_internal_interests['softwaredesign'] = $_POST['softwaredesign'];
    // }    
    // else{
    //   if(isset($user_internal_interests['softwaredesign']))
    //     unset( $user_internal_interests['softwaredesign']);  
    // }
    if(isset($_POST['multimedia'])){
      $user_internal_interests['multimedia'] = $_POST['multimedia'];
    }    
    else{
      if(isset($user_internal_interests['multimedia']))
        unset( $user_internal_interests['multimedia']);  
    }
    if(isset($_POST['graphic'])){
      $user_internal_interests['graphic'] = $_POST['graphic'];
    }    
    else{
      if(isset($user_internal_interests['graphic']))
        unset( $user_internal_interests['graphic']);  
    }

    if(isset($_POST['additional_interest'])){
      $user_internal_interests['additional_interest'] = $_POST['additional_interest'];
    }
        // update meta_data
    
    update_user_meta($_POST['userid'], 'user_interests', $user_interests);
    update_user_meta($_POST['userid'], 'user_internal_interests', $user_internal_interests);

    
    update_user_meta( $_POST['userid'], 'first_name', $_POST['first_name'] );
    
    update_user_meta( $_POST['userid'], 'last_name', $_POST['last_name'] );
    
    update_user_meta( $_POST['userid'], 'phone_number', $_POST['phone_number'] );
    
    if($_POST['countries']!="United States")
    {
        update_user_meta( $_POST['userid'], 'states', '' );
    }
    else{
        if(isset($_POST['states']) &&  $_POST['states']!="")
        {
            update_user_meta( $_POST['userid'], 'states', $_POST['states'] );
        }
    }
    update_user_meta( $_POST['userid'], 'countries', $_POST['countries'] );
    
    
    update_user_meta( $_POST['userid'], 'cities', $_POST['cities'] );
    
    
    update_user_meta( $_POST['userid'], 'description', $_POST['description'] );
   
    
    /* Set public/private option */
    update_user_meta( $_POST['userid'], 'is_profile_public', $_POST['is_profile_public'] );
    update_user_meta( $_POST['userid'], 'is_username_public', $_POST['is_username_public'] );
    update_user_meta( $_POST['userid'], 'is_firstname_public', $_POST['is_firstname_public'] );
    update_user_meta( $_POST['userid'], 'is_lastname_public', $_POST['is_lastname_public'] );
   
    update_user_meta( $_POST['userid'], 'is_email_public', $_POST['is_email_public'] );
    update_user_meta( $_POST['userid'], 'is_userurl_public', $_POST['is_userurl_public'] );
    update_user_meta( $_POST['userid'], 'is_phone_public', $_POST['is_phone_public'] );
    update_user_meta( $_POST['userid'], 'is_location_public', $_POST['is_location_public'] );
    update_user_meta( $_POST['userid'], 'is_description_public', $_POST['is_description_public'] );
    update_user_meta( $_POST['userid'], 'is_photo_public', $_POST['is_photo_public'] );

    update_user_meta( $_POST['userid'], 'is_interests_public', $_POST['is_interests_public']);
    update_user_meta( $_POST['userid'], 'is_skills_public', $_POST['is_skills_public']);
    update_user_meta( $_POST['userid'], 'is_additional_interest_public', $_POST['is_additional_interest_public']);

   // If the current user can edit Users, allow this.
    update_user_meta( $_POST['userid'], 'cupp_meta', $_POST['cupp_meta'] );
    update_user_meta( $_POST['userid'], 'cupp_upload_meta', $_POST['cupp_upload_meta'] );
    update_user_meta( $_POST['userid'], 'cupp_upload_edit_meta', $_POST['cupp_upload_edit_meta'] );



    $userdata=get_user_meta($author);
          if(isset($userdata) && $userdata!="")
            {
                $k=0;
                foreach($userdata as $userkey => $userval)
                {
                                   
                   if (strpos($userkey,'_field_') !== false) {
                    $k++; 
                    $usermetakey= $userkey;
                     delete_user_meta($author,$usermetakey);
                      delete_user_meta($author,'is_'.$k.'_public');
                   }
                  
                }
            }    
         
        for($i=1; $i<=$_POST['totalfieldcnt']; $i++)
        {
            $fieldname=$_POST['field_lable_'.$i];
            $fieldval=$_POST['field_value_'.$i];
           
            if(isset($fieldname) &&  $fieldname!="" && isset($fieldval) && $fieldval!="")
            {
                update_user_meta( $author, '_field_'.$fieldname, $fieldval );
                 update_user_meta( $author, 'is_'.$i.'_public', $_POST['is_'.$i.'_public']);
            } 
        }
        $query=remove_query_arg('edit-author-submit', get_permalink());
     
        $query = add_query_arg( 'form-submit', 'true', $query );
          
       // wp_redirect($query);
        //die();
        //if(isset($_GET['form-submit']) && $_GET['form-submit']==true)
        //{
        ?>
         <script type="text/javascript">
            jQuery( document ).ready(function(){
                
                jQuery("#message").addClass('success');
                jQuery("#message").show().html('Your data has been saved successfully');
            });   
            
         </script>
         <?php
        //}
  }   
 
  else{
    ?>
    <script type="text/javascript">
            jQuery( document ).ready(function(){
             jQuery("#message").addClass('alert-danger');
             jQuery("#message").show().html('Unauthorized access to this page is forbidden.');
            });   
      </script>
    <?php
  }
  
}
}

$usermetadata=get_user_meta(intval($author));
 if(isset($_GET['edit-author']) && $_GET['edit-author']==true)
 {
    
    $countries_array=array("united_states : United States","afghanistan : Afghanistan","albania : Albania","algeria : Algeria","american_samoa : American Samoa","andorra : Andorra","angola : Angola", "anguilla : Anguilla",
"antigua_and_barbuda : Antigua and Barbuda",
"argentina : Argentina",
"armenia : Armenia",
"aruba : Aruba",
"australia : Australia",
"austria : Austria",
"azerbaijan : Azerbaijan",
"bahamas : Bahamas",
"bahrain : Bahrain",
"bangladesh : Bangladesh",
"barbados : Barbados",
"belarus : Belarus",
"belgium : Belgium",
"belize : Belize",
"benin : Benin",
"bermuda : Bermuda",
"bhutan : Bhutan",
"bolivia : Bolivia",
"bosnia-herzegovina : Bosnia-Herzegovina",
"botswana : Botswana",
"bouvet_island : Bouvet Island",
"brazil : Brazil",
"brunei : Brunei",
"bulgaria : Bulgaria",
"burkina_faso : Burkina Faso",
"burundi : Burundi",
"cambodia : Cambodia",
"cameroon : Cameroon",
"canada : Canada",
"cape_verde : Cape Verde",
"cayman_islands : Cayman Islands",
"central_african_republic : Central African Republic",
"chad : Chad",
"chile : Chile",
"china : China",
"christmas_island : Christmas Island",
"cocos_(keeling)_islands : Cocos (Keeling) Islands",
"colombia : Colombia",
"comoros : Comoros",
"congo,_democratic_republic_of_the_(zaire) : Congo, Democratic Republic of the (Zaire)",
"congo,_republic_of : Congo, Republic of",
"cook_islands : Cook Islands",
"costa_rica : Costa Rica",
"croatia : Croatia",
"cuba : Cuba",
"cyprus : Cyprus",
"czech_republic : Czech Republic",
"denmark : Denmark",
"djibouti : Djibouti",
"dominica : Dominica",
"dominican_republic : Dominican Republic",
"ecuador : Ecuador",
"egypt : Egypt",
"el_salvador : El Salvador",
"equatorial_guinea : Equatorial Guinea",
"eritrea : Eritrea",
"estonia : Estonia",
"ethiopia : Ethiopia",
"falkland_islands : Falkland Islands",
"faroe_islands : Faroe Islands",
"fiji : Fiji",
"finland : Finland",
"france : France",
"french_guiana : French Guiana",
"gabon : Gabon",
"gambia : Gambia",
"georgia : Georgia",
"germany : Germany",
"ghana : Ghana",
"gibraltar : Gibraltar",
"greece : Greece",
"greenland : Greenland",
"grenada : Grenada",
"guadeloupe_(french) : Guadeloupe (French)",
"guam_(usa) : Guam (USA)",
"guatemala : Guatemala",
"guinea : Guinea",
"guinea_bissau : Guinea Bissau",
"guyana : Guyana",
"haiti : Haiti",
"holy_see : Holy See",
"honduras : Honduras",
"hong_kong : Hong Kong",
"hungary : Hungary",
"iceland : Iceland",
"india : India",
"indonesia : Indonesia",
"iran : Iran",
"iraq : Iraq",
"ireland : Ireland",
"israel : Israel",
"italy : Italy",
"ivory_coast_(cote_d'ivoire) : Ivory Coast (Cote D'Ivoire)",
"jamaica : Jamaica",
"japan : Japan",
"jordan : Jordan",
"kazakhstan : Kazakhstan",
"kenya : Kenya",
"kiribati : Kiribati",
"kuwait : Kuwait",
"kyrgyzstan : Kyrgyzstan",
"laos : Laos",
"latvia : Latvia",
"lebanon : Lebanon",
"lesotho : Lesotho",
"liberia : Liberia",
"libya : Libya",
"liechtenstein : Liechtenstein",
"lithuania : Lithuania",
"luxembourg : Luxembourg",
"macau : Macau",
"macedonia : Macedonia",
"madagascar : Madagascar",
"malawi : Malawi",
"malaysia : Malaysia",
"maldives : Maldives",
"mali : Mali",
"malta : Malta",
"marshall_islands : Marshall Islands",
"martinique_(french) : Martinique (French)",
"mauritania : Mauritania",
"mauritius : Mauritius",
"mayotte : Mayotte",
"mexico : Mexico",
"micronesia : Micronesia",
"moldova : Moldova",
"monaco : Monaco",
"mongolia : Mongolia",
"montenegro : Montenegro",
"montserrat : Montserrat",
"morocco : Morocco",
"mozambique : Mozambique",
"myanmar : Myanmar",
"namibia : Namibia",
"nauru : Nauru",
"nepal : Nepal",
"netherlands : Netherlands",
"netherlands_antilles : Netherlands Antilles",
"new_caledonia_(french) : New Caledonia (French)",
"new_zealand : New Zealand",
"nicaragua : Nicaragua",
"niger : Niger",
"nigeria : Nigeria",
"niue : Niue",
"norfolk_island : Norfolk Island",
"north_korea : North Korea",
"northern_mariana_islands : Northern Mariana Islands",
"norway : Norway",
"oman : Oman",
"pakistan : Pakistan",
"palau : Palau",
"panama : Panama",
"papua_new_guinea : Papua New Guinea",
"paraguay : Paraguay",
"peru : Peru",
"philippines : Philippines",
"pitcairn_island : Pitcairn Island",
"poland : Poland",
"polynesia_(french) : Polynesia (French)",
"portugal : Portugal",
"puerto_rico : Puerto Rico",
"qatar : Qatar",
"reunion : Reunion",
"romania : Romania",
"russia : Russia",
"rwanda : Rwanda",
"saint_helena : Saint Helena",
"saint_kitts_and_nevis : Saint Kitts and Nevis",
"saint_lucia : Saint Lucia",
"saint_pierre_and_miquelon : Saint Pierre and Miquelon",
"saint_vincent_and_grenadines : Saint Vincent and Grenadines",
"samoa : Samoa",
"san_marino : San Marino",
"sao_tome_and_principe : Sao Tome and Principe",
"saudi_arabia : Saudi Arabia",
"senegal : Senegal",
"serbia : Serbia",
"seychelles : Seychelles",
"sierra_leone : Sierra Leone",
"singapore : Singapore",
"slovakia : Slovakia",
"slovenia : Slovenia",
"solomon_islands : Solomon Islands",
"somalia : Somalia",
"south_africa : South Africa",
"south_georgia_and_south_sandwich_islands : South Georgia and South Sandwich Islands",
"south_korea : South Korea",
"south_sudan : South Sudan",
"spain : Spain",
"sri_lanka : Sri Lanka",
"sudan : Sudan",
"suriname : Suriname",
"svalbard_and_jan_mayen_islands : Svalbard and Jan Mayen Islands",
"swaziland : Swaziland",
"sweden : Sweden",
"switzerland : Switzerland",
"syria : Syria",
"taiwan : Taiwan",
"tajikistan : Tajikistan",
"tanzania : Tanzania",
"thailand : Thailand",
"timor-leste_(east_timor) : Timor-Leste (East Timor)",
"togo : Togo",
"tokelau : Tokelau",
"tonga : Tonga",
"trinidad_and_tobago : Trinidad and Tobago",
"tunisia : Tunisia",
"turkey : Turkey",
"turkmenistan : Turkmenistan",
"turks_and_caicos_islands : Turks and Caicos Islands",
"tuvalu : Tuvalu",
"uganda : Uganda",
"ukraine : Ukraine",
"united_arab_emirates : United Arab Emirates",
"united_kingdom : United Kingdom",
"uruguay : Uruguay",
"uzbekistan : Uzbekistan",
"vanuatu : Vanuatu",
"venezuela : Venezuela",
"vietnam : Vietnam",
"virgin_islands : Virgin Islands",
"wallis_and_futuna_islands : Wallis and Futuna Islands",
"yemen : Yemen",
"zambia : Zambia",
"zimbabwe : Zimbabwe");
    
    $states_array=array("AL : Alabama",
"AK : Alaska",
"AZ : Arizona",
"AR : Arkansas",
"CA : California",
"CO : Colorado",
"CT : Connecticut",
"DE : Delaware",
"DC : District of Columbia",
"FL : Florida",
"GA : Georgia",
"HI : Hawaii",
"ID : Idaho",
"IL : Illinois",
"IN : Indiana",
"IA : Iowa",
"KS : Kansas",
"KY : Kentucky",
"LA : Louisiana",
"ME : Maine",
"MD : Maryland",
"MA : Massachusetts",
"MI : Michigan",
"MN : Minnesota",
"MS : Mississippi",
"MO : Missouri",
"MT : Montana",
"NE : Nebraska",
"NV : Nevada",
"NH : New Hampshire",
"NJ : New Jersey",
"NM : New Mexico",
"NY : New York",
"NC : North Carolina",
"ND : North Dakota",
"OH : Ohio",
"OK : Oklahoma",
"OR : Oregon",
"PA : Pennsylvania",
"RI : Rhode Island",
"SC : South Carolina",
"SD : South Dakota",
"TN : Tennessee",
"TX : Texas",
"UT : Utah",
"VT : Vermont",
"VA : Virginia",
"WA : Washington",
"WV : West Virginia",
"WI : Wisconsin",
"WY : Wyoming");

function check_newsletter_changes($author, $this_post_key, $this_meta_key){
  $current_val = get_user_meta($author, $this_meta_key, 1);
  error_log('checking changes for author '.$author.' and type: '.$this_post_key);
  if((!isset($_POST[$this_post_key]) && $current_val == '1') || (isset($_POST[$this_post_key]) && empty($current_val)))
  {
    if(isset($_POST[$this_post_key]))
      update_user_meta($author, $this_meta_key, 1);
    else
      delete_user_meta($author, $this_meta_key);
    if(function_exists('update_challenge_newsletters_by_user'))
      update_challenge_newsletters_by_user($author, $this_post_key);
    error_log($this_post_key.' was changed.');
  }
}

if(isset($_POST['newsletter-update'])){
  check_newsletter_changes($author, 'global-newsletter', 'challenge_global_newsletter');
  check_newsletter_changes($author, 'agency-newsletter', 'challenge_agency_newsletter');
  check_newsletter_changes($author, 'follow-newsletter', 'challenge_follow_newsletter');
  check_newsletter_changes($author, 'submit-newsletter', 'challenge_submit_newsletter');
  check_newsletter_changes($author, 'types-newsletter', 'challenge_types_newsletter');
  check_newsletter_changes($author, 'skills-newsletter', 'challenge_skills_newsletter');
  check_newsletter_changes($author, 'interests-newsletter', 'challenge_interests_newsletter');
  /*
  if(isset($_POST['global-newsletter']))
    update_user_meta($author,'challenge_global_newsletter',1);
  else
    delete_user_meta($author,'challenge_global_newsletter');
  if(isset($_POST['agency-newsletter']))
    update_user_meta($author,'challenge_agency_newsletter',1);
  else
    delete_user_meta($author,'challenge_agency_newsletter');
  if(isset($_POST['follow-newsletter']))
    update_user_meta($author,'challenge_follow_newsletter',1);
  else
    delete_user_meta($author,'challenge_follow_newsletter');
  if(isset($_POST['submit-newsletter']))
    update_user_meta($author,'challenge_submit_newsletter',1);
  else
    delete_user_meta($author,'challenge_submit_newsletter');
  if(isset($_POST['skills-newsletter']))
    update_user_meta($author,'challenge_skills_newsletter',1);
  else
    delete_user_meta($author,'challenge_skills_newsletter');
  if(isset($_POST['types-newsletter']))
    update_user_meta($author,'challenge_types_newsletter',1);
  else
    delete_user_meta($author,'challenge_types_newsletter');
  if(isset($_POST['interests-newsletter']))
    update_user_meta($author,'challenge_interests_newsletter',1);
  else
    delete_user_meta($author,'challenge_interests_newsletter');
  */
}
   /*
    ?>
    <script type="text/javascript">
      jQuery(document).ready(function($){
            $('form[name="edit_profile"] input[type="submit"]').click(function(){
                alert('Challenge.gov is undergoing scheduled maintenance. Between the hours of 8 p.m. EST and 10 p.m. EST tonight, the Challenge.gov database will be in read-only mode. It will be unable to save new registrations, profile updates, submissions or comments during this time. We apologize for this inconvenience, and encourage you to try back once the maintenance is completed.');
                return false;
            });
        });
    </script>
	<?php
	*/
   ?>
    <div class="container">
      <div id="manage-newsletter-div"><a href="#" id="manage-newsletter-close" style="position:absolute;top:0;right:5px;text-decoration:none;">x</a>
        <form action="" method="POST">
          <span style="display:block;font-weight:bold;font-size:20px;">Manage Newsletters</span>
          <span style="font-size:10px;line-height:14px;display:block;margin:10px 0;">Select the checkbox(s) below to receive the corresponding Challenge newsletters</span>
          Global Newsletter<input name="global-newsletter" type="checkbox" style="position:absolute;right:40px;" class="newsletter-select"<?php echo get_user_meta($author,'challenge_global_newsletter',1) == '1'?' checked':'';?>><br/>
          Agencies<input name="agency-newsletter" type="checkbox" style="position:absolute;right:40px;" class="newsletter-select"<?php echo get_user_meta($author,'challenge_agency_newsletter',1) == '1'?' checked':'';?>><br/>
          Challenge Types<input name="types-newsletter" type="checkbox" style="position:absolute;right:40px;" class="newsletter-select"<?php echo get_user_meta($author,'challenge_types_newsletter',1) == '1'?' checked':'';?>><br/>
          Challenges I'm Following<input name="follow-newsletter" type="checkbox" style="position:absolute;right:40px;" class="newsletter-select"<?php echo get_user_meta($author,'challenge_follow_newsletter',1) == '1'?' checked':'';?>><br/>
          Challenges I've Submitted to<input name="submit-newsletter" type="checkbox" style="position:absolute;right:40px;" class="newsletter-select"<?php echo get_user_meta($author,'challenge_submit_newsletter',1) == '1'?' checked':'';?>><br/>
          My Skills<input name="skills-newsletter" type="checkbox" style="position:absolute;right:40px;" class="newsletter-select"<?php echo get_user_meta($author,'challenge_skills_newsletter',1) == '1'?' checked':'';?>><br/>
          My Interests<input name="interests-newsletter" type="checkbox" style="position:absolute;right:40px;" class="newsletter-select"<?php echo get_user_meta($author,'challenge_interests_newsletter',1) == '1'?' checked':'';?>><br/>
          <a href="#" style="position:absolute;left:20px;bottom:25px;" class="newsletter-select-all">Select all</a>
          <input type="hidden" name="newsletter-update" value="Y">
          <input type="submit" name="submit" value="Save" style="position:absolute;right:20px;bottom:20px;">
        </form>
      </div>
      <form name="edit_profile" action="<?php echo add_query_arg( 'edit-author-submit', 'true', $_SERVER['REQUEST_URI'] )?>" method="post" class="author_form">  
    <div>
        <h2 class="page-title">Edit <?php echo ucfirst($curauth->user_login);?> Profile</h2>
        <?php
         if($usermetadata['is_profile_public'][0]=="public")
            {
                $pub_status="checked";
               
            }
            else{
                
                 $priv_status="checked";
            }
            ?>
            <div id="message"></div>
        <div class="edit-profile-actions">
            <span class="edit-profile-filters">
                  <fieldset style="display:inline-block;">
                   <legend class="sr-only">Profile Page</legend>
                <label for="check_public_for_profile">
                    <input id="check_public_for_profile" type="radio" name="is_profile_public" value="public" <?php echo $pub_status; ?>> Make Profile Public
                </label>
                <label for="check_private_for_profile">
                    <input id="check_private_for_profile" type="radio" name="is_profile_public" value="private" <?php echo $priv_status; ?>> Make Profile Private
                </label>
                </fieldset>
            </span>
            <span class="view-profile"><a href="#" id="manage-newsletter">Manage Newsletters</a> | <a href="<?php echo remove_query_arg( array('edit-author-submit', 'edit-author'), get_permalink() )?>">View profile page</a></span>
        </div>
        
    <div class="page-content"  style="padding: 10px;">

    <div id = "sides"><b>Name:</b></div>
    <div id="sides">
      <div class = "col-md-7">
        <div id ="author_left">Profile Display Name:</div>
        <div id ="author_right"><?php echo $curauth->user_login;?></div>
      </div>
      <div class = "col-md-5">
        <?php
        $pub_status="";
        $priv_status="";
         if($usermetadata['is_username_public'][0]=="public")
            {
                $pub_status="checked";
               
            }
            else{
                
                 $priv_status="checked";
            }
            ?>
        <div id ="author_right_decision">
               <fieldset>
                   <legend class="sr-only">Profile Display Name:</legend>
                    <input aria-labelledby="username_public" type="radio" name="is_username_public" value="public" <?php echo $pub_status;?>>  
            <span id="username_public">Show on public profile</span>
                      <input aria-labelledby="username_private" type="radio" name="is_username_public" value="private" <?php echo $priv_status;?>> 
           <span id="username_private">Don't show on public profile</span>
                </fieldset>
        </div>
      </div>
    </div>
    
   <div id="sides">
      <div class = "col-md-7">
        <label id ="author_left" for="first_name">First Name:</label>
        <div id ="author_right"><input id="first_name" class="text" value="<?php echo $usermetadata['first_name'][0];?>" type="text" name="first_name"></div>
      </div>
      <div class = "col-md-5">
        <?php
        $pub_status="";
        $priv_status="";
         if($usermetadata['is_firstname_public'][0]=="public")
            {
                $pub_status="checked";
               
            }
            else{
                
                 $priv_status="checked";
            }
            ?>
        <div id ="author_right_decision">
             <fieldset>
                   <legend class="sr-only">First Name:</legend>
            <input aria-labelledby="firstname_public" type="radio" name="is_firstname_public" value="public" <?php echo $pub_status;?>> 
            <span id="firstname_public">Show on public profile</span>
                <input aria-labelledby="firstname_private" type="radio" name="is_firstname_public" value="private" <?php echo $priv_status;?>> 
                <span id="firstname_private">Don't show on public profile</span>
            </fieldset>
        </div>
      </div>
    </div>
    
  <div id="sides">
    <div class = "col-md-7">
      <label id ="author_left" for="last_name">Last Name:</label>
      <div id ="author_right"><input id="last_name" class="text" value="<?php echo $usermetadata['last_name'][0];?>" type="text"  name="last_name"></div>
    </div>
    <div class = "col-md-5">
         <?php
         $pub_status="";
        $priv_status="";
         if($usermetadata['is_lastname_public'][0]=="public")
            {
                $pub_status="checked";
               
            }
            else{
                
                 $priv_status="checked";
            }
            ?>
        <div id ="author_right_decision">
             <fieldset>
                <legend class="sr-only">Last Name:</legend>
                <input aria-labelledby="lastname_public" type="radio" name="is_lastname_public" value="public" <?php echo $pub_status;?>> 
                <span id="lastname_public">Show on public profile</span>
                    <input aria-labelledby="lastname_private" type="radio" name="is_lastname_public" value="private" <?php echo $priv_status;?>> 
                <span id="lastname_private">Don't show on public profile</span>
            </fieldset>
        </div>
      </div>
    </div>
   
   <hr>
   

    <div id = "sides"><b>Contact Information:</b></div>
    <div id="sides">
      <div class = "col-md-7">
        <label id ="author_left" for="user_email">Email: <span class="required">*</span></label>
        <?php
         $session_codes = get_max_agency_codes();
     $pub_status="";
        $priv_status="";
        if(!empty($session_codes) && !empty($session_codes['OMBAgencyCode']) && !empty($session_codes['OMBBureauCode']))
        {
             echo "<div id ='author_right'>".$curauth->user_email."</div>";
        }
        else{
            
            if($usermetadata['is_email_public'][0]=="public")
            {
                $pub_status="checked";
               
            }
            else{
                
                 $priv_status="checked";
            }
            ?>
        <div id ="author_right"><input id="user_email" class="text" value="<?php echo $curauth->user_email;?>" type="text" name="user_email"></div>
      </div> 
      <div class = "col-md-5">
        <div id ="author_right_decision">
            <fieldset>
                <legend class="sr-only">Email:</legend>
            <input aria-labelledby="email_public" type="radio" name="is_email_public" value="public" <?php echo $pub_status; ?>> 
                <span id="email_public">Show on public profile</span>
                <input aria-labelledby="email_private" type="radio" name="is_email_public" value="private" <?php echo $priv_status; ?>> 
                <span id="email_private">Don't show on public profile</span>
            </fieldset>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
    
    <div id="sides">
      <div class = "col-md-7">
        <label id ="author_left" for="user_url">Website:</label>
        <div id ="author_right"><input id="user_url" class="text" value="<?php echo $curauth->user_url;?>" type="text" name="user_url"></div>
      </div>
      <div class = "col-md-5">
        <?php
          $pub_status="";
        $priv_status="";
         if($usermetadata['is_userurl_public'][0]=="public")
            {
                $pub_status="checked";
               
            }
            else{
                
                 $priv_status="checked";
            }
            ?>
        <div id ="author_right_decision">
            <fieldset>
                <legend class="sr-only">Website:</legend>
                <input aria-labelledby="website_public" type="radio" name="is_userurl_public" value="public" <?php echo $pub_status; ?>> 
                <span id="website_public">Show on public profile</span>
                <input aria-labelledby="website_private" type="radio" name="is_userurl_public" value="private" <?php echo $priv_status; ?>> 
                <span id="website_private">Don't show on public profile</span>
            </fieldset>
        </div>
      </div>
    </div>
   

   <div id="sides">
    <div class = "col-md-7">
        <label id ="author_left" for="phone_number">Phone Number:</label>
        <script type="text/javascript">
           
            jQuery( document ).ready(function($) {
               jQuery("#phone_number").keypress(function (e) {
           
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                   if (e.which==45 ) {
                    $("#errmsgchallenges").hide();
                   }
                   else
                   {
                        $("#errmsgchallenges").html("Digits and '-' Only").show();
                        return false;
                   }
                   
               }
           else{
             $("#errmsgchallenges").hide();
           }
          });
              $('#manage-newsletter-close').on('click',function(){
                $('#manage-newsletter-div').fadeOut();
                return false;
              });
              $('#manage-newsletter').on('click',function(){
                $('#manage-newsletter-div').fadeToggle();
                return false;
              });
              if($('.newsletter-select:checked').length == $('.newsletter-select').length)
              {
                $('.newsletter-select-all').text("Deselect all");
                $('.newsletter-select-all').addClass('newsletter-all-selected');
              }
              $(".newsletter-select-all").on('click',function() {
                  if($(this).is(".newsletter-all-selected"))
                  {
                    $(this).removeClass('newsletter-all-selected');
                    $('.newsletter-select').prop("checked", false);
                    $('.newsletter-select-all').text("Select all");
                  }
                  else
                  {
                    $('.newsletter-select').prop("checked", true);
                    $('.newsletter-select-all').text("Deselect all");
                    $(this).addClass('newsletter-all-selected');
                  }
                  return false;
              });
              $(document).keyup(function(e) {
                if (e.keyCode == 27){
                  if($('#manage-newsletter-div').is(':visible'))
                    $('#manage-newsletter-div').fadeOut();
                }
              });
              
            });
	
        </script>
        <div id ="author_right">
            <input class="text" value="<?php echo $usermetadata['phone_number'][0];?>" type="text" id="phone_number" name="phone_number"></div><div id="errmsgchallenges"></div>
        <?php
          $pub_status="";
        $priv_status="";
         if($usermetadata['is_phone_public'][0]=="public")
            {
                $pub_status="checked";
               
            }
            else{
                
                 $priv_status="checked";
            }
            ?>
    </div>
    <div class = "col-md-5">
          <div id ="author_right_decision">
              <fieldset>
                <legend class="sr-only">Phone Information:</legend>
                  <input aria-labelledby="phone_public" type="radio" name="is_phone_public" value="public" <?php echo $pub_status; ?>> 
                  <span id="phone_public">Show on public profile</span>
                <input aria-labelledby="phone_private" type="radio" name="is_phone_public" value="private" <?php echo $priv_status; ?>> 
                  <span id="phone_private">Don't show on public profile</span>
              </fieldset>
          </div>
    </div>
    </div>
   
    <hr> 

      <div id = "sides"><b>About Yourself:</b></div>
      <script type="text/javascript">
        jQuery( document ).ready(function($) {
            jQuery("#countries").change(function () {
                
                if ($("#countries").val()=="United States") {
                    $("#us_states_dropdown").show();
                }
                else{
                    $("#us_states_dropdown").hide();
                }
               
          });
        }); 
	
        </script>
     <div id="sides">
      <div class = "col-md-7">
        <label id="author_left" for="countries">Location:</label>
        <div id="author_right">
            <div style="padding-bottom:10px;">
            <select name="countries" id="countries">
        <option value=""><-- Select Country --></option>
            <?php
            $user_country=$usermetadata['countries'][0];
                foreach($countries_array as $counties)
                {
                    $contrynamearray=explode(":",$counties);
                    
                    
                    $selected = $user_country==ltrim($contrynamearray[1]) ? 'selected="selected"' : '';
														
		    echo '<option value="'.ltrim($contrynamearray[1]).'" '.$selected.'>'.ltrim($contrynamearray[1]).'</option>';
                    
                    
                }
            ?>
            </select></div>
            <div style="padding-bottom:10px; display:none;" id="us_states_dropdown" name="us_states">
                <?php
                $user_states=$usermetadata['states'][0];
           
            ?>
            <label for="states" class="sr-only">Select State:</label>
            <select name="states" id="states">
             <option value=""><-- Select States --></option>
            <?php
            
            if($user_states!="" && $user_country=="United States")
            {
                
                ?>
                <script type="text/javascript">
                    
                    jQuery("#us_states_dropdown").show();
                
            </script>
            <?php
            }
            
            
                foreach($states_array as $states)
                {
                    $statesnamearray=explode(":",$states);
                    if($user_states==$statesnamearray[1])
                    {
                        $selected="selected";
                    }
                    else{
                        $selected="";
                    }
                    ?>
                    <option value="<?php echo $statesnamearray[1];?>" <?php echo $selected;?>><?php echo $statesnamearray[1];?></option>
                    <?php
                    
                }
            ?>
            </select>
            
        </div>
            
            <div style="padding-bottom:10px;">
                 <label for="city" class="sr-only">Select State:</label>
                <input id="city" type="text" placeholder="City" name="cities" value="<?php echo $usermetadata['cities'][0];?>"></div>
        <?php
          $pub_status="";
          $priv_status="";
         if($usermetadata['is_location_public'][0]=="public")
            {
                $pub_status="checked";
               
            }
            else{
                
                 $priv_status="checked";
            }
            ?>
            </div>
      </div>
      <div class = "col-md-5">
        <div id ="author_right_decision">
            <fieldset>
                <legend class="sr-only">Location Information:</legend>
            <input aria-labelledby="location_public" type="radio" name="is_location_public" value="public" <?php echo $pub_status; ?>> 
                <span id="location_public">Show on public profile</span>
                <input aria-labelledby="location_private" type="radio" name="is_location_public" value="private" <?php echo $priv_status; ?>> 
                <span id="location_private">Don't show on public profile</span>
            </fieldset>
        </div>
      </div>  
     </div>
           
     <div id="sides">
      <div class = "col-md-7">
        <label id ="author_left" for="bio-info">Biographical Info:</label>
        <div id ="author_right">
            <textarea id="bio-info" name="description" maxlength="1000" cols="40" rows="4"><?php echo $usermetadata['description'][0];?>
            </textarea>
            <div class="text-small">Text limit 1000 characters, including spaces</div>
          </div>
      </div>
        <?php
          $pub_status="";
          $priv_status="";
         if($usermetadata['is_description_public'][0]=="public")
            {
                $pub_status="checked";
               
            }
            else{
                
                 $priv_status="checked";
            }
            ?>
      <div class = "col-md-5">
        <div id ="author_right_decision">
             <fieldset>
                <legend class="sr-only">Biographical Information:</legend>
            <input aria-labelledby="bio_info_public" type="radio" name="is_description_public" value="public" <?php echo $pub_status; ?>> 
                 <span id="bio_info_public">Show on public profile</span>
                <input aria-labelledby="bio_info_private" type="radio" name="is_description_public" value="private" <?php echo $priv_status; ?>> 
                 <span id="bio_info_private">Don't show on public profile</span>
            </fieldset>
        </div>
      </div>
    </div>
  </br></br></br><hr>
    <div id ="sides">
      <div class = "col-md-7">
          <?php
            add_action( 'enqueue_scripts', 'cupp_enqueue_scripts_styles' );
          
            // vars
            $curauthor= new WP_User( intval($author) );
            
            cupp_profile_img_fields($curauthor);
          ?>
      </div>
      <div class = "col-md-5">
        <?php
            $pub_status="";
            $priv_status="";
           if($usermetadata['is_photo_public'][0]=="public")
              {
                  $pub_status="checked";
                 
              }
              else{
                  
                   $priv_status="checked";
              }
        ?>
        <div id ="author_right_decision">
             <fieldset>
                <legend class="sr-only">Profile Picture:</legend>
            <input aria-labelledby="profile_picture_public" type="radio" name="is_photo_public" value="public" <?php echo $pub_status; ?>> 
                 <span id="profile_picture_public">Show on public profile</span>
                <input aria-labelledby="profile_picture_private" type="radio" name="is_photo_public" value="private" <?php echo $priv_status; ?>> 
                 <span id="profile_picture_private">Don't show on public profile</span>
            </fieldset>
        </div>
      </div>
      <br>
    </div>

    <?php

      $user_interests = get_user_meta($author, 'user_interests', 1);
      $user_internal_interests = get_user_meta($author, 'user_internal_interests', 1);

      echo '<div id="sides"><b><hr>Interests and Skills:</b></div>';
        echo '<div id = "sides">';
         echo '<div class = "col-md-7">';
          echo '<div id="author_left"><strong>Your area(s) of interest:</strong></div></br></br>';
          echo '<div id="author_right_decision_check1">';

            echo '<label>Agriculture<input class = "check1" type="checkbox" name = "agriculture" value = "yes" '.(isset($user_interests['agriculture']) ? "checked" : "").' /></label>';

            echo '<label>Business<input class = "check1" type="checkbox" name = "business" value = "yes" '.(isset($user_interests['business']) ? "checked" : "").' /></label>';

            echo '<label>Climate<input class = "check1" type="checkbox" name = "climate" value = "yes" '.(isset($user_interests['climate']) ? "checked" : "").' /></label>';
            
            echo '<label>Consumer<input class = "check1" type="checkbox" name = "consumer" value = "yes" '.(isset($user_interests['consumer']) ? "checked" : "").' /></label>';     
                
            echo '<label>Ecosystems<input class = "check1" type="checkbox" name = "ecosystems" value = "yes" '.(isset($user_interests['ecosystems']) ? "checked" : "").' /></label>';
            
            echo '<label>Education<input class = "check1" type="checkbox" name = "education" value = "yes" '.(isset($user_interests['education']) ? "checked" : "").' /></label>';
         
            echo '<label>Energy<input class = "check1" type="checkbox" name = "energy" value = "yes" '.(isset($user_interests['energy']) ? "checked" : "").' /></label>';

            echo '<label>Finance<input class = "check1" type="checkbox" name = "finance" value = "yes" '.(isset($user_interests['finance']) ? "checked" : "").' /></label>';
        
            echo '<label>Health<input class = "check1" type="checkbox" name = "health" value = "yes" '.(isset($user_interests['health']) ? "checked" : "").' /></label>';
          
            echo '<label>Local Government<input class = "check1" type = "checkbox" name = "government" value = "yes" '.(isset($user_interests['government']) ? "checked" : "").' /></label>';      

            echo '<label>Manufacturing<input class = "check1" type = "checkbox" name = "manufacturing" value = "yes" '.(isset($user_interests['manufacturing']) ? "checked" : "").' /></label>';

            echo '<label>Ocean<input class = "check1" type = "checkbox" name = "ocean" value = "yes" '.(isset($user_interests['ocean']) ? "checked" : "").' /></label>';

            echo '<label>Public Safety<input class = "check1" type = "checkbox" name = "safety" value = "yes" '.(isset($user_interests['safety']) ? "checked" : "").' /></label>';

            echo '<label>Science & Research<input class = "check1" type = "checkbox" name = "research" value = "yes" '.(isset($user_interests['research']) ? "checked" : "").' /></label>';        
          echo '</div>';
        echo '</div>';
        ?>
        <div class = "col-md-5">
          <?php
            $pub_status="";
            $priv_status="";
            if($usermetadata['is_interests_public'][0]=="public")
              {
                $pub_status="checked";
                 
              }
            else{
                
                 $priv_status="checked";
            }
          ?>
          <div id ="author_right_decision"></br></br>
               <fieldset>
                    <legend class="sr-only">Interest Information:</legend>
                    <input aria-labelledby="interest_info_public" type="radio" name="is_interests_public" value="public" <?php echo $pub_status; ?>>
                    <span id="interest_info_public">Show on public profile</span>
                    <input aria-labelledby="interest_info_private" type="radio" name="is_interests_public" value="private" <?php echo $priv_status; ?>>
                    <span id="interest_info_private">Don't show on public profile</span>
                </fieldset>
            </div>
        </div>
          <?php

      echo '</div>';
      echo '<br><div id = "sides">';
      echo '<div class = "col-md-7"></br>';
      echo '<div id="author_left"><strong>Your skill(s):</strong></div></br></br>';
        echo '<div id="author_right_decision_check2">';

            echo '<label>Software/Apps<input class = "check2" type="checkbox" name = "software" value = "yes" '.(isset($user_internal_interests['software']) ? "checked" : "").' /></label>';

            echo '<label>Scientific<input class = "check2" type="checkbox" name = "scientific" value = "yes" '.(isset($user_internal_interests['scientific']) ? "checked" : "").' /></label>';

            echo '<label>Algorithms<input class = "check2" type="checkbox" name = "algorithms" value = "yes" '.(isset($user_internal_interests['algorithms']) ? "checked" : "").' /></label>';

            echo '<label>Ideas<input class = "check2" type="checkbox" name = "ideas" value = "yes" '.(isset($user_internal_interests['ideas']) ? "checked" : "").' /></label>';

            echo '<label>Engineering<input class = "check2" type="checkbox" name = "engineering" value = "yes" '.(isset($user_internal_interests['engineering']) ? "checked" : "").' /></label>';


            echo '<label>Plans/Strategies<input class = "check2" type="checkbox" name = "plans" value = "yes" '.(isset($user_internal_interests['plans']) ? "checked" : "").' /></label>';

            //echo '<label>Software Design<input class = "check2" type="checkbox" name = "softwaredesign" value = "yes" '.(isset($user_internal_interests['softwaredesign']) ? "checked" : "").' /></label>';

            echo '<label>Visual Media<input class = "check2" type="checkbox" name = "multimedia" value = "yes" '.(isset($user_internal_interests['multimedia']) ? "checked" : "").' /></label>'; 

            echo '<label>Graphic Design<input class = "check2" type="checkbox" name = "graphic" value = "yes" '.(isset($user_internal_interests['graphic']) ? "checked" : "").' /></label>'; 
        echo '</div>';
      echo '</div>';
      ?>
      <div class = "col-md-5">
        <?php
          $pub_status="";
          $priv_status="";
          if($usermetadata['is_skills_public'][0]=="public")
            {
                $pub_status="checked";
               
            }
          else{
                
                 $priv_status="checked";
            }
        ?>
          <div id ="author_right_decision"></br></br>
            <fieldset>
                <legend class="sr-only">Skills Information:</legend>
                <input aria-labelledby="skills_info_public" type="radio" name="is_skills_public" value="public" <?php echo $pub_status; ?>> 
                <span id="skills_info_public">Show on public profile</span>
                <input aria-labelledby="skills_info_private" type="radio" name="is_skills_public" value="private" <?php echo $priv_status; ?>> 
                <span id="skills_info_private">Don't show on public profile</span>
            </fieldset>      
        </div>
        </div>
          <?php
            echo '</div></br>';

          ?>
          <div id = "sides">
            <div class = "col-md-7"></br>
              <label for="add_int">Your additional interest(s):</label></br></br>
                <div id = "author_right">
                  <input id = "add_int" type = "text" name = "additional_interest" value = "<?php echo @$user_internal_interests['additional_interest'];?>"/>
                </div>
            </div>
            <div class = "col-md-5">
            <?php
              $pub_status="";
              $priv_status="";
              if($usermetadata['is_additional_interest_public'][0]=="public")
                {
                    $pub_status="checked";
                   
                }
              else{
                    
                     $priv_status="checked";
                }
            ?>
            <div id ="author_right_decision"></br></br>
                <fieldset>
                    <legend class="sr-only">Skills Information:</legend>              
                    <input aria-labelledby="additional_int_info_public" type="radio" name="is_additional_interest_public" value="public" <?php echo $pub_status; ?>> 
                    <span id="additional_int_info_public">Show on public profile</span>
                    <input aria-labelledby="additional_int_info_private" type="radio" name="is_additional_interest_public" value="private" <?php echo $priv_status; ?>>
                    <span id="additional_int_info_private">Don't show on public profile</span>
                </fieldset>        
            </div>
          </div>
          </br>
        </div>
     </br></br><hr>
    <div id="sides">
        <div><b>Extra Information:</b></div>  
    </div>

    
    <script type="text/javascript">
    jQuery(function($) {
        var scntDiv = $('#user_extra_fields');
        var i = $('#user_extra_fields p').size() + 1;
        
        $('#addfield').live('click', function() {
            
                $('<p><label for="userfieldlable' + i +'" class="sr-only">Interest Title</label><input type="text" id="userfieldlable' + i +'" size="20" name="field_lable_' + i +'" value="" placeholder="Interest (e.g., hobby)" /> <label for="userfieldvalue' + i +'" class="sr-only">Interest Title</label><input type="text" id="userfieldvalue' + i +'" size="40" name="field_value_' + i +'" value="" placeholder="Detail (e.g., swimming)" /> <a href="#" id="removefield">Remove</a> <span><fieldset><legend class="sr-only">Privacy Options for Extra Info</legend>  <input aria-labelledby="int_info_public' + i +'" type="radio" name="is_'+i+'_public" value="public"> <span id="int_info_public' + i +'">Show on public profile</span> <input aria-labelledby="int_info_private' + i +'" type="radio" name="is_'+i+'_public" value="private"> <span id="int_info_private' + i +'">Don\'t show on public profile</span</fieldset></span></p>').appendTo(scntDiv);
                i++;
                $("#totalfieldcnt").val(i);
                return false;
        });
        
        $('#removefield').live('click', function() { 
                if( i > 1 ) {
                    
                        $(this).parent('p').remove();
                        i--;
                        $("#totalfieldcnt").val(i);
                }
                return false;
        });  
    });
 </script>
      <?php
     $output='<div><a href="#" id="addfield">Add field</a></div>
            <div id="user_extra_fields">';
            $hasfieldval=false;
            $k=0;
             
            if(isset($usermetadata) && $usermetadata!="")
            {
                
                foreach($usermetadata as $userkey => $userval)
                {
                     $pub_status="";
                    $priv_status="";                
                   if (strpos($userkey,'_field_') !== false) {
                    $k++;
                    $hasfieldval=true;
                        $usermetakey= $userkey;
                        
                        $usermetaval=get_user_meta(intval($author),$userkey);
                       
                        if($usermetadata['is_'.$k.'_public'][0]=="public")
                        {
                            $pub_status="checked";
                        }
                        else {
                            $priv_status="checked";
                        }
                        $output.='<p>                          
                          <label for="userfieldlabel" class="sr-only">Title Information</label><input type="text" id="userfieldlabel" size="20" name="field_lable_'.$k.'" value="'.esc_attr(substr($usermetakey,7)).'" placeholder="Title Info"/>
                          <label for="userfieldvalue" class="sr-only">Information Text</label>
                          <input type="text" id="userfieldvalue" size="40" name="field_value_'.$k.'" value="'.esc_attr($usermetaval[0]).'" placeholder="Information Text" />
                          <a href="#" id="removefield">Remove</a>
                    <span>
                            <fieldset>
                            <legend class="sr-only">Privacy Options for Extra Info</legend>        
                            <input aria-labelledby="extra_info_public" type="radio" name="is_'.$k.'_public" value="public" '.$pub_status.'> 
                            <span id="extra_info_public">Show on public profile</span>
                            <input aria-labelledby="extra_info_private" type="radio" name="is_'.$k.'_public" value="private" '.$priv_status.'> 
                            <span id="extra_info_private">Don\'t show on public profile</span>
                            </fieldset>
                            </span>
                        </p>';
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
       ?>
    <p><label for='terms_condition'>** By updating my profile, I acknowledge that information I marked "show on public profile" will be made publicly available and visible to anyone visiting <a href="
<?php echo site_url(); ?>">Challenge.gov</a> or receiving its content (e.g., API, RSS. etc.). **</label></p>
    <input type="hidden" name="userid" id="userid" value="<?php echo intval($author)?>">
    <div class="field"><input type="submit" name="submit" value="Update Profile"></div>
    
  </div>
</div>  
    
</form>

</div>
    <?php
 }
 else{
?>
<div class="container">
    
        <h2 class="page-title"><?php echo ucfirst($curauth->user_login);?> Profile</h2>
        <?php
        $cur_user_ID = get_current_user_id();
       
        if($cur_user_ID==intval($author) || current_user_can('create_users'))
        {
        ?>
        <div class="edit-profile-actions">
            <span>&nbsp; </span>
           <span class="view-profile"><a id="edit-your-profile" href="<?php echo add_query_arg( 'edit-author', 'true', $_SERVER['REQUEST_URI'] )?>">Edit your profile</a></span>
        </div>
         <?php
    }
    ?>
        
   <div class="page-content" style="padding: 10px;">
        
<div id="view_author_page">
    <div id="view_author_title">Name:</div>
    <?php
    if($usermetadata['is_username_public'][0]=="public")
    {
        ?>
         <div id="author_left">Username:</div>
        <div id="author_right"><?php echo $curauth->user_login;?></div>
        <div class="author_clear"></div>  
         <?php
    }
    else{
      ?>
      <div id="author_left">Username:</div>
      <div id="author_right"><?php echo 'private</br>';?></div>
      <div class="author_clear"></div>
      <?php
    }
     
    if($usermetadata['is_firstname_public'][0]=="public")
    {
        ?>
         <div id="author_left">First Name:</div>
        <div id="author_right"><?php echo $usermetadata['first_name'][0];?></div>
        <div class="author_clear"></div>
        <?php
    }
    else{
      ?>
      <div id="author_left">First Name:</div>
      <div id="author_right"><?php echo 'private</br>';?></div>
      <div class="author_clear"></div>
      <?php
    }

    if($usermetadata['is_lastname_public'][0]=="public")
    {
        ?>
        <div id="author_left">Last Name:</div>
        <div id="author_right"><?php echo $usermetadata['last_name'][0];?></div>
        <div class="author_clear"></div>
        <?php
    }
    else{
      ?>
      <div id="author_left">Last Name:</div>
      <div id="author_right"><?php echo 'private</br>';?></div>
      <div class="author_clear"></div>
      <?php
    }
    
    ?>
    <hr>
    </br>
    <div id="view_author_title">Contact Information:</div>
    <?php
    if($usermetadata['is_email_public'][0]=="public")
    {
        ?>
           <div id="author_left">Email:</div>
            <div id="author_right"><?php echo $curauth->user_email;?></div>
          <div class="author_clear"></div>
         <?php
    }
    else{
      ?>
      <div id="author_left">Email:</div>
      <div id="author_right"><?php echo 'private</br>';?></div>
      <div class="author_clear"></div>
      <?php
    }
    
    if($usermetadata['is_userurl_public'][0]=="public")
    {
      ?>
        <div id="author_left">Website:</div>
        <div id="author_right"><?php echo $curauth->user_url;?></div>
        <div class="author_clear"></div>
      <?php
    }
    else{
      ?>
      <div id="author_left">Website:</div>
      <div id="author_right"><?php echo 'private</br>';?></div>
      <div class="author_clear"></div>
      <?php
    }

    if($usermetadata['is_phone_public'][0]=="public")
    {
        ?>
         <div id="author_left">Phone Number:</div>
         <div id="author_right"><?php echo $usermetadata['phone_number'][0];?></div>
        <div class="author_clear"></div>
      </br>
         <?php
    }
    else{
    ?>
      <div id="author_left">Phone Number:</div>
      <div id="author_right"><?php echo 'private</br>';?></div>
      <div class="author_clear"></div>
      <?php
    }
    ?> 
    <hr>
    </br>
     <div id="view_author_title">About Yourself:</div>
      <?php
     if($usermetadata['is_location_public'][0]=="public")
    {
        ?>
         <div id="author_left">Location:</div>
         <?php
         if($usermetadata['countries'][0]!="")
         {
            $location=$usermetadata['countries'][0];
         }
         if($usermetadata['states'][0]!="")
         {
            $location.=", ".$usermetadata['states'][0];
         }
         if($usermetadata['cities'][0]!="")
         {
            $location.=", ".$usermetadata['cities'][0];
         }
         ?>
         <div id="author_right"><?php echo $location;?></div>
         <div class="author_clear"></div>
         <?php
    }
    else{
      ?>
      <div id="author_left">Location:</div>
      <?php
        echo '<div id="author_right">private</div>';
      ?>
      <div class="author_clear"></div>
      <?php
    }
    
    if($usermetadata['is_description_public'][0]=="public")
    {
        ?>
         <div id="author_left">Biographical Info:</div>
          <div id="author_right-bio-info" class="review-info"><?php echo $usermetadata['description'][0];?></div>
        <div class="author_clear"></div>
         <?php
    }
    else{
      ?>  
      <div id="author_left">Biographical Info:</div>
      <?php
        echo '<div id="author_right">private</div>';
      ?>
      <div class="author_clear"></div>
      <?php 
    }
    ?>
    <hr>
    </br>
     <div id="view_author_title">Interests and Skills:</div>
     <?php
      if ($usermetadata['is_interests_public'][0]=="public")
      { 
        $interests = get_user_meta($author, 'user_interests');

        ?>
        <div id = "author_left">Your Interest(s):</div> 
        </br>
        <div id = "author_right_decision_check1">
          <?php 
          foreach ($interests[0] as $key => $value){
            switch ($key){
              case "agriculture":
                $key = "Agriculture";
                break;
              case "business":
                $key = "Business";
                break;
              case "climate":
                $key = "Climate";
                break;
              case "consumer":
                $key = "Consumer";
                break;
              case "ecosystem":
                $key = "Ecosystem";
                break;
              case "education":
                $key = "Education";
                break;
              case "energy":
                $key = "Energy";
                break;
              case "finance":
                $key = "Finance";
                break;
              case "health":
                $key = "Health";
                break;
              case "government":
                $key = "Local Government";
                break;
              case "manufacturing":
                $key = "Manufacturing";
                break;
              case "ocean":
                $key = "Ocean";
                break;
              case "safety":
                $key = "Public Safety";
                break;
              case "research":
                $key = "Science & Research";
                break;
            }
            echo '<span><center>'.$key.'</center></span>';
          }
        ?>
        <div class = "author_clear"></div>
      </div>
        <?php 
      }
      else{
        ?>
        <div id = "author_left">Your Interest(s):</div>
        <?php
        echo '<div id="author_right">private</div>';
        ?>
        <div class = "author_clear"></div>
          <?php
      }

      if ($usermetadata['is_skills_public'][0]=="public")
      { 
        $skills = get_user_meta($author, 'user_internal_interests');

        ?>
        </br> 
        <div id = "author_left">Your Skill(s):</div> 
        </br>
        <div id = "author_right_decision_check2">
          <?php 
          if(!empty($skills)){
            foreach ($skills[0] as $key => $value){
            switch ($key){
              case "software":
                $key = "Software/Apps";
                break;
              case "scientific":
                  $key = "Scientific";
                  break;
              case "algorithms":
                  $key = "Algorithms";
                  break;
              case "ideas":
                  $key = "Ideas";
                  break;
              case "engineering":
                  $key = "Engineering";
                  break;
              case "plans":
                  $key = "Plans/Strategies";
                  break;
              // case "softwaredesign":
              //     $key = "Software Design";
              //     break;
              case "multimedia":
                  $key = "Visual Media";
                  break;  
              case "graphic":
                  $key = "Graphic Design";
                  break;
              default:
                  $key='';
                  break;
            }
            if($key!="")
            {
             echo '<span><center>'.$key.'</center></span>'; 
            }
            }
          }
        ?>
        <div class = "author_clear"></div>
      </div>
        <?php 
      }
      else{
        ?>
        <div id = "author_left">Your Skill(s):</div>
        <?php
        echo '<div id="author_right">private</div>';
        ?>
        <div class = "author_clear"></div>
        <?php
      }

      if ($usermetadata['is_additional_interest_public'][0] =="public"){

      ?>
        </br>
        <div id="author_left">Additional Interest(s):</div>
        <?php
        $unserilizedarray=unserialize($usermetadata['user_internal_interests'][0]);
        foreach($unserilizedarray as $key=>$val)
        {
            if($key=='additional_interest')
            {
                $add_interest= $val;
            }
            else{
                $add_interest="No additional interest found.";
            }
        }
        
        ?>
        <div id="author_right"><?php echo $add_interest;?></div>
        <div class="author_clear"></div>
      <?php
      }
      else{
        ?>
        <div id="author_left">Additional Interest(s):</div>
        <?php echo '<div id = "author_right">private</div>';
        ?>
        <div class = "author-clear"></div>
        <?php
      }

      ?>
      </br>
      <hr>
    </br>
    <div id="view_author_title">Extra Information:</div>
    <?php
    if(isset($usermetadata) && $usermetadata!="")
            {
                $noextrafield=true;
                $k=0;
                foreach($usermetadata as $userkey => $userval)
                {
                                    
                   if (strpos($userkey,'_field_') !== false) {
                    $k++;
                    $noextrafield=false;
                    $usermetakey= $userkey;
                     $usermetaval=get_user_meta(intval($author),$userkey);
                      if($usermetadata['is_'.$k.'_public'][0]=="public")
                     {
                    ?>
                    <div id="author_left"><?php echo esc_attr(substr($usermetakey,7));?></div>
                     <div id="author_right"><?php echo $usermetaval[0];?></div>
                    <div class="author_clear"></div>
                    <?php
                     }
                   }
                   
                }
                if($noextrafield==true)
                {
                    ?>
                    <div id="author_left">No extra field has been found</div>
                    <div class="author_clear"></div>
                    <?php
                }
            }
    ?> 
</div>

   <div id="author_left">
    <?php
      if ($usermetadata['is_photo_public'][0] =="public"){
        $size = 'medium';
        
        
        $imgURL = get_cupp_meta(intval($author), $size);
        if($imgURL=="")
        {
            $defaultimageurl=get_bloginfo('template_directory')."/images/default_user.png";
            echo '<img src="'. $defaultimageurl .'" alt="user profile picture">';
        }
        else{
            echo '<img src="'. $imgURL .'" alt="user profile picture">';
        }
      }
      else{
        $defaultimageurl=get_bloginfo('template_directory')."/images/default_user.png";
        echo '<img src="'. $defaultimageurl .'" alt="user profile picture">';        
      } 
        ?>
    </div>    
  <div class="author_clear" style="padding-bottom: 10px;"></div>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
    <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
  <div id="tabs">
  <ul>
    
   
   
    <li><a href="#tabs-1">My Challenges</a></li>
    
    <li><a href="#tabs-2">My Solutions</a></li>
    <!-- <li><a href="#tabs-3">Newsletter Signup</a></li> -->
  </ul>
  
 
  <div id="tabs-1">
   
    <p><?php  echo do_shortcode( '[followed-challenge-of-user author="'.intval($author).'"]' );?></p>
     <script language="javascript" type="text/javascript">
                jQuery(".selection-check-challenge input").click(function(){
                
                //if(this.checked) {
                    
                    var userandchid=(jQuery(this).attr('customid'));
                    var userchidarray=userandchid.split("||");
                    delete_followers(userchidarray[0],userchidarray[1]);
               // }
                })
            
            </script>
  </div>
  
  <div id="tabs-2">
    <div class="row">
        <div class="container">
            <?php
            $solution_count = do_shortcode('[display-solution return_found="true" post_status="publish, pending, draft" author="'.$curauth->user_login.'"]');
            ?>
            <div class="col-md-12"><?php
            if($solution_count>0)
            {
                echo  do_shortcode('[display-solution item_class="front-challenge-item" post_status="publish, pending, draft" author="'.$curauth->user_login.'"]');
            }
            else{
                echo "<center><strong>No solutions have been posted for this profile yet.</strong></center>";
            }
            ?></div>
    </div>
    </div>
  </div>
  <!-- <div id="tabs-3">
    <p><?php //echo do_shortcode('[mc4wp_form]'); ?></p>
  </div>-->
  
</div>
  
        
   

</div>
</div>

				

<?php
 }	
	get_footer();
?>