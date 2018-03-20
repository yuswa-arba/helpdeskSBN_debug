<?php

/* Example of counting leases from a specific IP Pool (using regexp) */

require('../routeros_api.class.php');

$API = new RouterosAPI();

$API->debug = true;

if ($API->connect('192.168.1.1', 'yuswa', 'password')) {

   $ARRAY = $API->comm("/ip/dhcp-server/lease/print", array(
      "count-only"=> "",
      "~active-address" => "1.1.",
   ));
   
   print_r($ARRAY);

   $API->disconnect();

}

?>