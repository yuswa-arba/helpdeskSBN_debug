<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../../config/configuration_admin.php");
require_once '../../../config/telnet/PEAR2_Net_RouterOS-1.0.0b5.phar';
use PEAR2\Net\RouterOS;
use PEAR2\Net\RouterOS\Client;
use PEAR2\Net\RouterOS\Request;
use PEAR2\Net\RouterOS\Util; 
use PEAR2\Net\RouterOS\Response;



redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){

global $conn;

$content = '';
 
//koneksi ke RAS
$ip_address = "192.168.5.2";
//$ip_address = "00:50:56:82:67:2d";
$username   = "admin";
$password   = "testing";

//cut koneksi
try {
    $client = new RouterOS\Client($ip_address, $username, $password);
} catch (Exception $e) {
	echo "Unable to connect to RouterOS.";
}
    

//$util = new RouterOS\Util($client);
//$util->exec("
///interface pppoe-server remove [find user=purwoko2]
//");

$responses = $client->sendSync(new RouterOS\Request('/ip address print'));
echo "<pre>";
print_r($responses);
echo "</pre>";

$responses2 = $client->sendSync(new RouterOS\Request('/ping address=10.252.252.252 count=5'));
echo "<pre>";
print_r($responses2);
echo "</pre>";

//
//$responses3 = $client->sendSync(new RouterOS\Request('/tool fetch address=10.252.252.252 src-path=testing.rsc user=ftpvm mode=ftp port=21 password=testing dst-path=test.rsc host="" keep-result=yes'));
//echo "<pre>";
//print_r($responses3);
//echo "</pre>";
//$responses3 = $client->sendSync(new RouterOS\Request('/ip/address/set .id=*6 address=10.252.252.11/24'));

//$addRequest = new RouterOS\Request('/ip/address/set');
//
//$addRequest->setArgument('.id', '*6');
//$addRequest->setArgument('address', '10.252.252.101/24');
//$addRequest->setTag('Remote Helpdesk');
//$client->sendAsync($addRequest);

//$client->loop();
//$responses = $client->extractNewResponses();
//foreach ($responses3 as $response) {
//    if ($response->getType() !== Response::TYPE_FINAL) {
//        echo "Error with {$response->getTag()}!\n";
//    } else {
//        echo "OK with {$response->getTag()}!\n";
//    }
//}


//foreach ($responses as $response) {
//    if ($response->getType() === RouterOS\Response::TYPE_DATA) {
//        //$content .= 'IP: '. $response->getProperty('address').
//        //' MAC: '. $response->getProperty('mac-address').
//        //"<br>";
//		print_r($responses);
//    }
//}

//    if (isset($client)) {
//                
//		$util = new RouterOS\Util($client);
//		$util->exec("
//					/interface print
//					");
//		//$util->exec("
//		//	/interface pppoe-server remove [find user=".$rows["UserID"]."]
//		//	");
//		//enableLog("","dwi", "dwi","/interface pppoe-server remove [find user=".$rows["UserID"]."]");
//                
//    }



    //$title	= 'Sistem Blokir';
    //$submenu	= "blokir";
    //$plugins	= '';
    //$user	= ucfirst($loggedin["username"]);
    //$group	= $loggedin['group'];
    //$template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    //
    //echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>