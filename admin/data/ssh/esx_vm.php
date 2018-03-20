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
include '../../../config/telnet/PEAR2_Net_RouterOS-1.0.0b5.phar';
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
    //enableLog("","dwi", "dwicoba","Unable to connect to RouterOS.");
	echo "Unable to connect to RouterOS.";
}

//$util = new RouterOS\Util($client);
//$util->exec("
///interface pppoe-server remove [find user=purwoko2]
//");

$responses = $client->sendSync(new RouterOS\Request('/ip dhcp-server lease print'));
echo "<pre>";
print_r($responses);
echo "</pre>";
//$no = 1;
//if(count($responses[0]) > 1)
//{
//	foreach($responses[0] as $key1 => $value1)
//	{
//		echo $no .'. '.$key1.' = '.$value1.'<br>';
//		$no++;
//	}
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