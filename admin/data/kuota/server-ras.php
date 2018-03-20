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
    
//    $api_vm->write('/interface/print',false);
//	$api_vm->write('=stats=');
	$api_vm->write('/ppp/active/print');
	//$api_vm->write('=active=');
    $READ2 = $api_vm->read(false);
    $ARRAY2 = $api_vm->parseResponse($READ2);
	
//echo "<pre>";
//print_r($ARRAY2);
//echo "</pre>";

echo '<table border="1">
	<tr>
	<th>NO</th>
	<th>.id</th>
	<th>name</th>
	<th>service</th>
	<th>caller-id</th>
	<th>address</th>
	<th>uptime</th>
	<th>encoding</th>
	<th>session-id</th>
	<th>limit-bytes-in</th>
	<th>limit-bytes-out</th>
	<th>radius</th>
</tr>';
$no = 1;
	foreach($ARRAY2 as $value)
	{
		
			echo '<tr>
			<td>'.$no.'</td>
			<td>'.$value[".id"].'</td>
			<td>'.$value["name"].'</td>
			<td>'.$value["service"].'</td>
			<td>'.$value["caller-id"].'</td>
			<td>'.$value["address"].'</td>
			<td>'.$value["uptime"].'</td>
			<td>'.$value["encoding"].'</td>
			<td>'.$value["session-id"].'</td>
			<td>'.$value["limit-bytes-in"].'</td>
			<td>'.$value["limit-bytes-out"].'</td>
			<td>'.$value["radius"].'</td>
			</tr>';
		
		$no++;
	}
	echo '</table>';

	$api_vm->write('/interface/print',false);
	$api_vm->write('=stats=',false);
	$api_vm->write('=detail=');
    $READ = $api_vm->read(false);
    $ARRAY = $api_vm->parseResponse($READ);
    
	echo '<table border="1">
	<tr>
	<th>NO</th>
	<th>.id</th>
<th>name</th>
<th>type</th>
<th>mtu</th>

<th>last-link-up-time</th>
<th>rx-byte</th>
<th>tx-byte</th>
</tr>';
$no = 1;
	foreach($ARRAY as $value)
	{
		$bwtotal = $value["rx-byte"] + $value["tx-byte"];
		$name	= $value["name"];
		$data["$name"] = array(
				'bwtotal' => $bwtotal
		);
		
if($value["mtu"] == "1480" AND $value["type"] == "pppoe-in")
{
	echo '<tr>
	<td>'.$no.'</td>
	
	
	
<td>'.$value[".id"].'</td>
<td>'.$value["name"].'</td>
<td>'.$value["default-name"].'</td>
<td>'.$value["type"].'</td>
<td>'.$value["mtu"].'</td>
<td>'.$value["actual-mtu"].'</td>
<td>'.$value["l2mtu"].'</td>
<td>'.$value["mac-address"].'</td>
<td>'.$value["fast-path"].'</td>
<td>'.$value["last-link-up-time"].'</td>
<td>'.$value["link-downs"].'</td>
<td>'.$value["rx-byte"].'</td>
<td>'.$value["tx-byte"].'</td>
<td>'.$value["rx-packet"].'</td>
<td>'.$value["tx-packet"].'</td>
<td>'.$value["rx-drop"].'</td>
<td>'.$value["tx-drop"].'</td>
<td>'.$value["rx-error"].'</td>
<td>'.$value["tx-error"].'</td>
<td>'.$value["running"].'</td>
<td>'.$value["disabled"].'</td>
<td>'.$value["comment"].'</td>
</tr>';
}
		$no++;
	}
	echo '</table>';
	echo"<pre>";
    print_r($ARRAY);
    echo"</pre>";
}
else
{
	echo 'tidak konek sam';
}
