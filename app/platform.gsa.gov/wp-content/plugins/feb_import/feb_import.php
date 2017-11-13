<?php
/*
Plugin Name: FEB Importer
Description: FEB Data Migration
Version: 1.0.1
Author URI: http://www.gsa.gov

Sites Disable Comment URL is released under GPL:
http://www.opensource.org/licenses/gpl-license.php

*/

add_action('admin_menu', 'feb_importer_admin_menu');

function feb_importer_admin_menu() {
    add_options_page('FEB Data Importer', 'FEB Data Importer', 'manage_options','feb_import', 'feb_data_importer_admin_page');
}

function feb_data_importer_admin_page()
{
    // step 1 import events through event import plugin
    // step 2
  //_feb_import_em_contacts();
    //_import_add_attributes();
    //_feb_import_test();	
    // step 3 update event title
  //_clean_event_title();
  //_clean_test_events_related_data();
}
function _feb_import_em_contacts(){
    $results = $GLOBALS['wpdb']->get_results("select * from EmergencyContacts ", OBJECT);
    $i=0;
    foreach ($results as $res) {

        // to check user is exist or not
        $user_id =email_exists($res->Email1);
        if ($user_id == FALSE) {
            $password = $res->Email1;
            $username = $res->Email1;

            $user_id = wp_create_user($username, $password, $username);
            wp_update_user(array(
                'ID' => $user_id,
                'nickname' => $res->Email1,
                'last_name' => $res->LastName,
                'first_name' => $res->FirstName
            ));
            // setting role
            $user = new WP_User( $user_id );
            $user->set_role('subscriber' );
        }

        // create em contact post type
        $tmp_date = date('Y-m-d H:i:s', time());
        $post = array(
            'post_title' => $res->FirstName . ' ' . $res->LastName,
            'post_status' => 'publish', // publish, preview, future, etc.
            'post_type' => 'emergency_contact',
            'post_date' => $tmp_date,
            'post_author' => $user_id
        );
        $post_id = wp_insert_post($post);

        update_user_meta( $user_id, 'emergency_contact_post_id', $post_id);

        // FirstName
        update_field('field_5506fa131d3b1', $res->FirstName, $post_id);

        // MI
        update_field('field_5506fa2f1d3b2', $res->MI, $post_id);

        // LastName
        update_field('field_5506fa3b1d3b3', $res->LastName, $post_id);

        // Agency
        update_field('field_5506fa471d3b4', $res->Agency, $post_id);

        // Title
        update_field('field_5506fa551d3b5', $res->Title, $post_id);

        // Building
        update_field('field_5506fa611d3b6', $res->Building, $post_id);

        // Address 1
        update_field('field_5506fa731d3b7', $res->Address1, $post_id);

        // Address 2
        update_field('field_5506fa821d3b8', $res->Address2, $post_id);

        // City
        update_field('field_5506fa921d3b9', $res->City, $post_id);

        // County
        update_field('field_5506fa9b1d3ba', $res->County, $post_id);

        // State
        update_field('field_5506fab31d3bb', $res->State, $post_id);

        // Zip
        update_field('field_5506fabc1d3bc', $res->Zip, $post_id);

        // Email 1
        update_field('field_5506fad11d3bd', $res->Email1, $post_id);

        // Email 2
        update_field('field_5506fae11d3be', $res->Email2, $post_id);

        // Homephone
        update_field('field_5506fafa1d3bf', $res->HomePhone, $post_id);

        // Workphone
        update_field('field_5506fb131d3c0', $res->WorkPhone, $post_id);

        // Workphone Ext
        update_field('field_5506fb231d3c1', $res->WorkPhoneExt, $post_id);

        // Cellphone 1
        update_field('field_5506fb391d3c2', $res->CellPhone1, $post_id);

        // Cellphone 2
        update_field('field_5506fb451d3c3', $res->CellPhone2, $post_id);

        // Emergency Group
        update_field('field_5506fb551d3c4', $res->EmergencyGroup, $post_id);

        // Employee Num
        update_field('field_5506fb641d3c5', $res->EmployeeNum, $post_id);

        // Office Type
        update_field('field_5506fb6b1d3c6', $res->OfficeType, $post_id);

        // Active
        update_field('field_5506fb781d3c7', $res->Active, $post_id);

        $i++;
        print $i . ' ' . $res->LastName .' ' . $res->FirstName;
        print "<hr/>";
    }
}
function _feb_import_test(){
    /*
        print "<h2>LISTING ALL TABLES</h2> <hr />";

        $results = $GLOBALS['wpdb']->get_results("SHOW TABLES LIKE 'wp_21%'", OBJECT);
    $i=0;
        foreach ($results as $res) {
        print_r($res);
    $i++;
    print "<hr/>";
        }
    */

    print "<hr/>";
    $results = $GLOBALS['wpdb']->get_results("select count(*) from EmergencyContacts ", OBJECT);
    $i=0;
    foreach ($results as $res) {
        print_r($res);
        $i++;
        print $i."<hr/>";
    }

}

// import events additional attributes
function _import_add_attributes()
{
    print "<h2>Events Additional Fields Migration</h2> <hr />";

    $results = $GLOBALS['wpdb']->get_results("SELECT e.EventTitle, e.EventID, e.FullDesc, e.ShortDesc, e.DunningDays, e.EventTitle, e.ExemptFromProcessing,
  e.LOBID, e.EventTypeNm, e.EventStatusNm, e.Cost, e.MaxOccupancy, e.MinOccupancy, e.RegistrationStartDt, e.RegistrationCloseDt, e.PrimaryContactID, e.SecondaryContactID  FROM Events e ", OBJECT);

    $i = 0;

    foreach ($results as $res) {
        $i++;
        print $res->EventID . '_' . $res->EventTitle;
        $postid = $GLOBALS['wpdb']->get_var( "SELECT ID FROM wp_21_posts WHERE post_title LIKE '%" . $res->EventID . '_' . str_replace("'", "''", $res->EventTitle) . "%' ORDER BY ID DESC LIMIT 1" );
        print_r($postid);
        if (is_numeric($postid) && !empty($postid)){
            print "<h2>" . $postid . "</h2> <hr/>";

            update_post_meta($postid, 'Dunning Days', ($res->DunningDays == 'NULL')? '': $res->DunningDays);
            update_post_meta($postid, 'Event Type', $GLOBALS['wpdb']->get_var( "SELECT EventTypeDesc FROM EventTypes WHERE EventTypeNm LIKE '%" . $res->EventTypeNm . "%'"));
            update_post_meta($postid, 'Event Status', $GLOBALS['wpdb']->get_var( "SELECT EventStatusDesc FROM EventStatus WHERE EventStatusNm LIKE '%" . $res->EventStatusNm . "%'"));
            update_post_meta($postid, 'Exempt from Processing', (($res->ExemptFromProcessing == 0)? 'No':'Yes'));

            $post = get_post($postid);
            $res->FullDesc = str_replace("Nbsp;","",$res->FullDesc);
            $post->post_content = preg_replace("/&#?[a-z0-9]+;/i","",$res->FullDesc);
            $post->post_excerpt = $res->ShortDesc;

            // import event primary Contact create wp user set
            if ($res->PrimaryContactID != '0') {
                $primary_contacts = $GLOBALS['wpdb']->get_results("SELECT * FROM EventContacts WHERE ContractID LIKE '%" . $res->PrimaryContactID . "%'", OBJECT);
                foreach ($primary_contacts as $p_contact) {
                    $user_id =email_exists($p_contact->Email);
                    if ($user_id === FALSE) {
                        $password = $p_contact->Email;
                        $user_id = wp_create_user( $p_contact->Email, $password, $p_contact->Email );
                        wp_update_user(array(
                            'ID'=>$user_id,
                            'nickname'=>$p_contact->Email
                        ));

                        // setting role
                        $user = new WP_User( $user_id );
                        $user->set_role('contributor' );

                    }
                    // updating user meta info
                    update_user_meta($user_id, 'Primary_Contact_Name', $p_contact->ContactName);
                    update_user_meta($user_id, 'Primary_Contact_Desc', $p_contact->ContactDesc);
                    update_user_meta($user_id, 'Primary_Phone', $p_contact->Phone);
                    update_user_meta($user_id, 'Primary_Fax', $p_contact->Fax);
                    update_user_meta($user_id, 'Primary_Website', $p_contact->Website);
                    update_user_meta($user_id, 'Primary_Address', $p_contact->Address1);
                    update_user_meta($user_id, 'Primary_Address2', $p_contact->Address2);
                    update_user_meta($user_id, 'Primary_City', $p_contact->City);
                    update_user_meta($user_id, 'Primary_State', $p_contact->State);
                    update_user_meta($user_id, 'Primary_Zip', $p_contact->Zip);

                    $post->post_author = $user_id;
                }
            }

            wp_update_post($post);

            // Line of Business
            $term = get_term_by("name", $GLOBALS['wpdb']->get_var( "SELECT LOBDesc FROM LineOfBusiness WHERE LOBID LIKE '%" . $res->LOBID . "%'") , 'event-categories');
            wp_set_object_terms($postid, array($term->term_id), 'event-categories', true);


            // import event secondary contact
            if ($res->SecondaryContactID != '0') {
                $secondary_contacts = $GLOBALS['wpdb']->get_results("SELECT * FROM EventContacts WHERE ContractID LIKE '%" . $res->SecondaryContactID . "%'", OBJECT);
                foreach ($secondary_contacts as $s_contact) {

                    /*
                    #_ATT{Secondary Contact Name}
                    #_ATT{Secondary Contact Desc}
                    #_ATT{Secondary Phone}
                    #_ATT{Secondary Fax}
                    #_ATT{Secondary Email}
                    #_ATT{Secondary Website}
                    #_ATT{Secondary Address}
                    #_ATT{Secondary Address 2}
                    #_ATT{Secondary City}
                    #_ATT{Secondary State}
                    #_ATT{Secondary Zip}
                     * */
                    update_post_meta($postid, 'Secondary Contact Name', $s_contact->ContactName);
                    update_post_meta($postid, 'Secondary Contact Desc', $s_contact->ContactDesc);
                    update_post_meta($postid, 'Secondary Phone', $s_contact->Phone);
                    update_post_meta($postid, 'Secondary Fax', $s_contact->Fax);
                    update_post_meta($postid, 'Secondary Email', $s_contact->Email);
                    update_post_meta($postid, 'Secondary Website', $s_contact->Website);
                    update_post_meta($postid, 'Secondary Address', $s_contact->Address1);
                    update_post_meta($postid, 'Secondary Address 2', $s_contact->Address2);
                    update_post_meta($postid, 'Secondary City', $s_contact->City);
                    update_post_meta($postid, 'Secondary State', $s_contact->State);
                    update_post_meta($postid, 'Secondary Zip', $s_contact->Zip);
                }
            }

            // set rsvp for all imported events
            update_post_meta($postid, '_event_rsvp', 1);
            $GLOBALS['wpdb']->query("UPDATE wp_21_em_events SET event_rsvp=1 WHERE post_id=" . $postid);

            $event_id = $GLOBALS['wpdb']->get_var("SELECT event_id FROM wp_21_em_events WHERE post_id=" . $postid);

            /*
                | ticket_id            | bigint(20) unsigned | NO   | PRI | NULL    |
                | event_id             | bigint(20) unsigned | NO   | MUL | NULL    |                |
                | ticket_name          | tinytext            | NO   |     | NULL    |                |
                | ticket_description   | text                | YES  |     | NULL    |                |
                | ticket_price         | decimal(14,4)       | YES  |     | NULL    |                |
                | ticket_start         | datetime            | YES  |     | NULL    |                |
                | ticket_end           | datetime            | YES  |     | NULL    |                |
                | ticket_min           | int(10)             | YES  |     | NULL    |                |
                | ticket_max           | int(10)             | YES  |     | NULL    |                |
                | ticket_spaces        | int(11)             | YES  |     | NULL    |                |
                | ticket_members       | int(1)              | YES  |     | NULL    |                |
                | ticket_members_roles | longtext            | YES  |     | NULL    |                |
                | ticket_guests        | int(1)              | YES  |     | NULL    |                |
                | ticket_required      | int(1)              | YES  |     | NULL    |                |
                | ticket_meta          | longtext            | YES  |     | NULL    |                |
             */

            if(isset($event_id) && $GLOBALS['wpdb']->get_var('SELECT ticket_id FROM wp_21_em_tickets WHERE event_id='.$event_id) > 0) {
                // update EVENT ticket
                $GLOBALS['wpdb']->query("UPDATE wp_21_em_tickets SET ticket_name='" . $res->EventTitle . " Ticket', ticket_price="
                    . $res->Cost . ", ticket_min="
                    . $res->MinOccupancy . ", ticket_max= "
                    . "NULL" . ", ticket_start='"
                    . $res->RegistrationStartDt ."', ticket_end='"
                    . $res->RegistrationCloseDt . "', ticket_spaces="
                    . $res->MaxOccupancy . ", ticket_required =1 WHERE event_id = " .$event_id );
            }
            else {
                // insert new EVENT ticket
                $GLOBALS['wpdb']->query("INSERT INTO wp_21_em_tickets (ticket_id, ticket_name, ticket_price, ticket_min, ticket_max, ticket_start, ticket_end, event_id, ticket_spaces, ticket_required) "
                    ." VALUES('', '" . $res->EventTitle . " Ticket', " . $res->Cost . ", " . $res->MinOccupancy . ", " . "NULL" . ", '" . $res->RegistrationStartDt . "', '" . $res->RegistrationCloseDt . "', " . $event_id . ", " . $res->MaxOccupancy . ", 1)");
                print "<strong style='color:red' >".$event_id . '</strong><hr />';
            }

            _import_event_attendee($res->EventID, $GLOBALS['wpdb']->get_var("SELECT ticket_id FROM wp_21_em_tickets WHERE event_id=".$event_id), $event_id);

        }
        else {
            PRINT '<HR/><H3 style="color:red"> NOT FOUND >>>>>>'.$res->EventID . '_' . $res->EventTitle. ' </H3>';
        }
    }

    print $i;
}

// import Events Attendeee
function _import_event_attendee($old_eventid, $ticketid, $new_eventid) {

    $results = $GLOBALS['wpdb']->get_results("SELECT * FROM Registrations WHERE CAST(EventID AS SIGNED) = " . $old_eventid , OBJECT);

    $i = 0;

    foreach ($results as $res) {

        $sub_resutls = $GLOBALS['wpdb']->get_results("SELECT * FROM Attendees WHERE LENGTH(Email) >0 AND (LENGTH(FirstNm) > 0 OR LENGTH(LastNm) > 0) AND CAST(AttendeeId AS  SIGNED) = " . $res->RegistrationID , OBJECT);

        foreach($sub_resutls as $sub_res) {

            $user_id =email_exists($sub_res->Email);
            if ($user_id == FALSE) {
                $password = $sub_res->Email;

                if (empty($sub_res->Email)) {
                    $username = $sub_res->AttendeeId.$sub_res->FirstNm.$sub_res->LastNm.'@GMAIL.COM';
                    $user_id =email_exists($username);

                }
                ELSE {
                    $username = $sub_res->Email;

                }

                if (!username_exists($username) && $user_id == false) {
                    $user_id = wp_create_user($username, $password, $username);
                    wp_update_user(array(
                        'ID' => $user_id,
                        'nickname' => $username
                    ));
                }
                else {
                    $user_id=username_exists($username);
                }


            }

            // setting role
            $user = new WP_User($user_id);
            $user->set_role('event_attendee');

            // updating user meta info
            update_user_meta($user_id, 'Firstname', $sub_res->FirstNm);
            update_user_meta($user_id, 'Lastname', $sub_res->LastNm);
            update_user_meta($user_id, 'OfficePhone', $sub_res->OfficePhone);
            update_user_meta($user_id, 'Suffix', $sub_res->Suffix);
            update_user_meta($user_id, 'Title', $sub_res->Title);
            update_user_meta($user_id, 'Address', $sub_res->Address);
            update_user_meta($user_id, 'Address2', $sub_res->Address2);
            update_user_meta($user_id, 'City', $sub_res->City);
            update_user_meta($user_id, 'State', $sub_res->State);
            update_user_meta($user_id, 'Zip', $sub_res->Zip);
            update_user_meta($user_id, 'OfficeFax', $sub_res->OfficeFax);
            update_user_meta($user_id, 'OfficeCell', $sub_res->OfficeCell);
            update_user_meta($user_id, 'BillingAddress', $sub_res->BillingAddress);
            update_user_meta($user_id, 'BillingAddress2', $sub_res->BillingAddress2);
            update_user_meta($user_id, 'BillingCity', $sub_res->BillingCity);
            update_user_meta($user_id, 'BillingState', $sub_res->BillingState);
            update_user_meta($user_id, 'BillingZip', $sub_res->BillingZip);
            /*
                | booking_id       | bigint(20) unsigned    | NO   | PRI | NULL              | auto_increment |
                | event_id         | bigint(20) unsigned    | NO   | MUL | NULL              |                |
                | person_id        | bigint(20) unsigned    | NO   |     | NULL              |                |
                | booking_spaces   | int(5)                 | NO   |     | NULL              |                |
                | booking_comment  | text                   | YES  |     | NULL              |                |
                | booking_date     | timestamp              | NO   |     | CURRENT_TIMESTAMP |                |
                | booking_status   | tinyint(1)             | NO   |     | 1                 |                |
                | booking_price    | decimal(14,4) unsigned | NO   |     | 0.0000            |                |
                | booking_tax_rate | decimal(7,4)           | YES  |     | NULL              |                |
                | booking_taxes    | decimal(14,4)          | YES  |     | NULL              |                |
                | booking_meta     | longtext               | YES  |     | NULL              |                |
             */

            // print_r($sub_res);
            // print_r($res);
            print '<hr /> OLD EVENT ID >>> ' . $old_eventid . '  NEW EVENT ID ' . $new_eventid ;
            print ' TICKET ID >>>' . $ticketid;
            print_r($user_id);

            $res->TotalSeats = intval($res->TotalSeats);
            $res->TotalPymt = intval($res->TotalPymt);

            if ($GLOBALS['wpdb']->get_var('SELECT booking_id FROM wp_21_em_bookings WHERE event_id=' . $new_eventid . ' AND person_id=' . $user_id) > 0) {
                // do update
                $GLOBALS['wpdb']->query('UPDATE wp_21_em_bookings SET booking_status=1, booking_date="' . $sub_res->CreateDate . '", booking_spaces=' . $res->TotalSeats . ', booking_price=' . $res->TotalPymt . '  WHERE event_id='.$new_eventid . ' AND person_id=' . $user_id);
            }
            else {
                // do insert
                $GLOBALS['wpdb']->query("INSERT INTO wp_21_em_bookings (booking_id, event_id, person_id, booking_status, booking_date, booking_spaces, booking_price) VALUES('', " . $new_eventid .", " . $user_id . ", 1, '" . $sub_res->CreateDate . "', " . $res->TotalSeats . ", " . $res->TotalPymt . ")");
            }

            // insert total wp_em_tickets_bookings
            $booking_id = $GLOBALS['wpdb']->get_var('SELECT booking_id FROM wp_21_em_bookings WHERE event_id='. $new_eventid . ' AND person_id=' . $user_id);

            /*
                | ticket_booking_id     | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
                | booking_id            | bigint(20) unsigned | NO   | MUL | NULL    |                |
                | ticket_id             | bigint(20) unsigned | NO   | MUL | NULL    |                |
                | ticket_booking_spaces | int(6)              | NO   |     | NULL    |                |
                | ticket_booking_price  | decimal(14,4)       | NO   |     | NULL    |                |
             */

            if ($GLOBALS['wpdb']->get_var("SELECT ticket_booking_id FROM wp_21_em_tickets_bookings WHERE booking_id=".$booking_id . ' AND ticket_id='.$ticketid)> 0) {
                // do update
                $GLOBALS['wpdb']->query("UPDATE wp_21_em_tickets_bookings SET ticket_booking_spaces=". $res->TotalSeats . ", ticket_booking_price=".$res->TotalPymt . " WHERE booking_id=".$booking_id . ' AND ticket_id='.$ticketid);
            }
            else{
                // do insert
                $GLOBALS['wpdb']->query("INSERT INTO wp_21_em_tickets_bookings(ticket_booking_id, booking_id, ticket_id, ticket_booking_spaces, ticket_booking_price) VALUES ('', " . $booking_id .", " . $ticketid .", " . $res->TotalSeats . ", " . $res->TotalPymt . ")");
            }
// global $wpdb;
// $wpdb->update(EM_BOOKINGS_TABLE, array('booking_meta'=> serialize($EM_Booking->booking_meta)), array('booking_id'=>$EM_Booking->booking_id));
            $i++;
        }

    }
    print "<h3 style='color:aqua'> TOTAL ATTENDEES COUNT: " . $i . "</h3> <hr/>";
}



// correct Event title
function _clean_event_title() {

    $results = $GLOBALS['wpdb']->get_results("SELECT * FROM wp_21_em_events ", OBJECT);
    foreach($results as $res) {
        $exploded = explode('_', $res->event_name);
        $new_event_title = isset($exploded[1])? $exploded[1] : $res->event_name;
        print $res->event_name . '>> <span style="color: red"> ' . $new_event_title . '</span> LEGACY_ID:' . $exploded[0] . ' <hr/>';
        $post = get_post($res->post_id);
        $post->post_title = $new_event_title;
        update_post_meta($res->post_id, 'legacy_eventid', $exploded[0]);
        wp_update_post($post);
    }
}

function _clean_test_events_related_data(){
    $results = $GLOBALS['wpdb']->get_results("SELECT * FROM wp_21_em_events WHERE event_name not like '%test%'", OBJECT);
    foreach($results as $res) {

        $post = get_post($res->post_id);
        $post->post_status='publish';

        wp_update_post($post);
    }
}

?>