<?php
/**
 * Emergency Contact Functions
 *
 * @package FEB WordPress Theme Framework
 * @subpackage feb
 * @author CTAC - www.ctacorp.com
 */

add_action("wp_ajax_Show_Building_Query", "ShowBuildingList");
add_action("wp_ajax_nopriv_Show_Building_Query", "ShowBuildingList");
function ShowBuildingList()
{
	$args = array(
    'post_type' => 'emergency_contact',
    'post_status' => array('publish','future'),
    'posts_per_page' => -1,
     
    'meta_query' => array(
        array(
            'value'     => $_POST['agency'],
            
        ),
    ),
);
$posts_array = get_posts( $args );

$building_array=array();
foreach($posts_array as $postid)
{
	
	$postid=$postid->ID;
	$meta_values = get_post_meta( $postid, 'building');
	$building_array[]=$meta_values['0'];
	
}
$building_array=array_unique($building_array);

foreach($building_array as $buildingname)
{
	if($buildingname!="Null" && $buildingname!="NULL" && $buildingname!="null")
	{
		$building_dropdown[]=$buildingname;
	}
}
echo json_encode($building_dropdown);
wp_die();
}
add_action("wp_ajax_Show_Address_Query", "ShowAddressList");
add_action("wp_ajax_nopriv_Show_Address_Query", "ShowAddressList");

function ShowAddressList()
{
	$args = array(
    'post_type' => 'emergency_contact',
    'post_status' => array('publish','future'),
    'posts_per_page' => -1,     
    'meta_query' => array(
        array(
            'value'     => $_POST['agency'],
        ),
	 	array(
            'value'     => $_POST['building'],
        ),
    ),
);
$posts_array = get_posts( $args );
$address_array=array();
foreach($posts_array as $postid)
{
	$postid=$postid->ID;
	$meta_address_values = get_post_meta( $postid, 'address_1');
	$meta_suite_values = get_post_meta( $postid, 'office_suite');

	if($meta_address_values['0']!="Null" && $meta_address_values['0']!="NULL" && $meta_address_values['0']!="null"){			

		if($meta_suite_values['0']!="" && $meta_suite_values['0']!="NULL" && $meta_suite_values['0']!="Null" && $meta_suite_values['0']!="null"){

			$address_dropdown[]=$meta_address_values['0']." : ".$meta_suite_values['0'];	
		}
		else{
			$address_dropdown[]=$meta_address_values['0'];
		}
	}	
}

$address_dropdown=array_unique($address_dropdown);
echo json_encode(array_values($address_dropdown));
wp_die();
}
add_action("wp_ajax_auto_address_fields", "LoadAddressFields");
add_action("wp_ajax_nopriv_auto_address_fields", "LoadAddressFields");

function LoadAddressFields()
{
	$args = array(
    	'post_type' => 'emergency_contact',
    	'post_status' => 'publish',
    	'posts_per_page' => -1,
    	'meta_query' => array(
		array(
		    'value'     => $_POST['agency'],
		),
		array(
		    'value'     => $_POST['building'],
		),
		array(
		    'value'     => $_POST['address'],
		),
		),
	);
$posts_array = get_posts( $args );
$address_array=array();
foreach($posts_array as $postid)
{
	$postid=$postid->ID;
	$meta_city = get_post_meta( $postid, 'city');
	$meta_county = get_post_meta( $postid, 'county');
	$meta_state = get_post_meta( $postid, 'state');
	$meta_zip = get_post_meta( $postid, 'zip');
	$rest_of_the_address[]=$meta_city['0']."||".$meta_county['0']."||".$meta_state['0']."||".$meta_zip['0'];
}
$rest_of_the_address_array=array_unique($rest_of_the_address);
echo json_encode($rest_of_the_address_array);

wp_die();
}