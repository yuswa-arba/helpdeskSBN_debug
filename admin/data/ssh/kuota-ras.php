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
include 'routeros_api.class.php';

redirectToHTTPS();

global $conn;
$loggedin = logged_inAdmin();


$api_vm = new RouterosAPI();
$api_vm->debug = false;

//step2
if ($api_vm->connect('172.16.255.2', 'nyuwuntulung911', 'h3lpd3skSBN'))
{
		$api_vm->write('/ppp/active/print', false);
		$api_vm->write('?name=andyw', false);
		$api_vm->write('=.proplist=.id');
		$ARRAYS = $api_vm->read();
		
		print($ARRAYS[0][".id"]);
		
		//$api_vm->write('/ppp/active/remove', false);
		//$api_vm->write('=.id=' . $ARRAYS[0][".id"]);
		//$READ = $api_vm->read();

	$api_vm->write('/ppp/active/print');
	//$api_vm->write('=active=');
    $READ2 = $api_vm->read(false);
    $ARRAY2 = $api_vm->parseResponse($READ2);
	
	foreach($ARRAY2 as $value)
	{
		$id = substr($value[".id"], -5);
		$data_nama[$id] = $value["name"];
		$data_remove[$value[".id"]] = $value["name"];
	}
//	echo"<pre>";
//    print_r($data_nama);
//    echo"</pre>";

	$api_vm->write('/interface/print',false);
	$api_vm->write('=stats=');
    $READ = $api_vm->read(false);
    $ARRAY = $api_vm->parseResponse($READ);
    
	echo"<pre>";
    print_r($ARRAY);
    echo"</pre>";
	
	foreach($ARRAY as $value)
	{
		$id = substr($value[".id"], -5);
		$data_kuota[$id] = ($value["rx-byte"] + $value["tx-byte"]);
			
	}
	
	//$id_kuota = array_search("andyw", $data_nama);
	//$id_remove = array_search("andyw", $data_remove);
	//print $data_kuota[$id_kuota]."<br>";
	//echo array_search("andyw", $data_remove)."<br>";

	//$api_vm->write('/ppp/active/remove', false);
	//$api_vm->write('=.id='.$id_remove);
	//$READ = $api_vm->read(false);
	//$output_cutkoneksi = $api_vm->parseResponse($READ);
	//print_r($output_cutkoneksi);
	
}
else
{
	echo 'tidak konek sam';
}


