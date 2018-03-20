<?php

/* Example of finding registration-table ID for specified MAC */

require('../routeros_api.class.php');

$API = new RouterosAPI();

$API->debug = true;

if ($API->connect('192.168.1.1', 'yuswa', 'password')) {

   $ARRAY = $API->comm("/interface/wireless/registration-table/print", array(
      ".proplist"=> ".id",
      "?mac-address" => "00:0E:BB:DD:FF:FF",
   ));
	
   print_r($ARRAY);

   $API->disconnect();

}

?>