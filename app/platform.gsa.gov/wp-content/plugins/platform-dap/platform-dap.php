<?php
/*
    Plugin Name: Platform DAP
    Plugin URI: http://platform.gsa.gov
    Description: Created for use by Wordpress sites running on  <a href="http://platform.gsa.gov" title="Platform.GSA.Gov">Platform.USA.Gov</a>.
    Author: GSA
    Version: 1.0.2
    Author URI: http://www.gsa.gov

    FedCMS DAP is released under GPL:
    http://www.opensource.org/licenses/gpl-license.php
*/

if ( is_admin() )
    add_action('admin_head', 'insert_federated_anayltics');
else
    add_action('wp_head', 'insert_federated_anayltics');

function insert_federated_anayltics() {

  echo "<!-- We participate in the US government's analytics program. See the data at analytics.usa.gov. -->"."\n";
  echo '<script async type="text/javascript" src="https://dap.digitalgov.gov/Universal-Federated-Analytics-Min.js?agency=GSA" id="_fed_an_ua_tag"></script>';

}

?>