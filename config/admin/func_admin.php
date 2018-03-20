<?php
/*
 * Project Name: Globalxtreme Web Payment Template
 * Project URI: https://globalxtreme.net/new/mbayartagihanglobal
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Agustus 2013
 * Email: dwi@globalxtreme.net
 * Project for Web Payment
 * Last edited: Dwi (10 Agustus 2014)
 * Desc: Update sistem login dan created expired session
 * 
 */


function preffixVoip($string)
{
	
	//$array	= array("0","1","2","3","4","5","6","7","8","9");
	//$return = str_replace($string, "");
	$return = preg_replace("/[^0-9]/", "", $string);
	return $return;
	
}

function toSeconds($hours, $minutes, $day)
{
    return (($day-1) * 1440) + ($hours * 60) + $minutes;
}

function get_uuid($tabel)
{
	global $conn;
	$query	= mysql_query("SELECT UUID() AS `uuid`;", $conn);
	$result = mysql_fetch_array($query);
	
	$uuid = $result['uuid'];
	
	$uuid = md5($uuid.'-'.$tabel.'-'.date("dmyHis"));
	return $uuid;		
}

function StatusCustomer($status)
{
//	'grace','blokir','off','proses','Inactive Tidak Sopan','Inactive Sopan','aktif'
	switch ($status){
		case "blokir": 
			return '<span class="label label-danger">Blokir</span>';
			break;
		case "off": 
			return '<span class="label label-danger">Blokir</span>';
			break;
		case "Inactive Tidak Sopan": 
			return '<span class="label label-danger">Inactive Tidak Sopan</span>';
			break;
		case "aktif": 
			return '<span class="label label-success">Aktif</span>';
			break;
		case "Inactive Sopan": 
			return '<span class="label label-warning">Inactive Sopan</span>';
			break;
		case "grace":
			return '<span class="label label-warning">Grace</span>';
			break;
		case "Proses":
			return '<span class="label label-warning">Proses</span>';
			break;
		case "":
			return '<span class="label label-warning">Proses</span>';
			break;
	}
}

function StatusInvoice($status)
{
	switch ($status){
		case 0: 
			return '<span class="label label-danger">Unpaid</span>';
			break;
		case 1: 
			return '<span class="label label-success">Paid</span>';
			break;
		case 2:
			return '<span class="label label-warning">Partial Paid</span>';
			break;
	}
}
function StatusVA($status)
{
	switch ($status){
		case 0: 
			return "Available";
			break;
		case 1: 
			return "Upload";
			break;
		case 2:
			return "Aktif";
			break;
		case 3:
			return "Dormant";
			break;
	}
}
function StatusNumberVOIP($status)
{
	switch ($status){
		case 0: 
			return "Used";
			break;
		case 1: 
			return "Inactive";
			break;
		case 2:
			return "Available";
			break;
		case 3:
			return "Reused";
			break;
	}
}
function StatusFilter($status)
{
	switch ($status){
		case 1: 
			return "GroupName";
			break;
		case 2:
			return "AccountType";
			break;
		case 3:
			return "UserID";
			break;
	}
}
function StatusVOIP($status)
{
	switch ($status){
		case 0: 
			return "CANCEL";
			break;
		case 1: 
			return "ACTIVE";
			break;
		case 2:
			return "NEW";
			break;
		case 3:
			return "WAITING";
			break;
		case 4:
			return "RESERV";
			break;
		case 5:
			return "EXPIRED";
			break;
		case 6:
			return "SUS-PAY";
			break;
		case 7:
			return "SUS-LIT";
			break;
		case 8:
			return "WAIT-PAY";
			break;
	}
}
function boxColor($box)
{
	$box_a = ($box > 3) ? ($box % 3) : $box;
	switch ($box_a){
		case 0:
			return "box-danger";
			break;
		case 1: 
			return "box-success";
			break;
		case 2:
			return "box-warning";
			break;
		case 3:
			return "box-danger";
			break;
		
	}
}
function NamaBulan($bulan)
{
	switch ($bulan){
		case 1: 
			return "Januari";
			break;
		case 2:
			return "Februari";
			break;
		case 3:
			return "Maret";
			break;
		case 4:
			return "April";
			break;
		case 5:
			return "Mei";
			break;
		case 6:
			return "Juni";
			break;
		case 7:
			return "Juli";
			break;
		case 8:
			return "Agustus";
			break;
		case 9:
			return "September";
			break;
		case 01: 
			return "Januari";
			break;
		case 02:
			return "Februari";
			break;
		case 03:
			return "Maret";
			break;
		case 04:
			return "April";
			break;
		case 05:
			return "Mei";
			break;
		case 06:
			return "Juni";
			break;
		case 07:
			return "Juli";
			break;
		case 08:
			return "Agustus";
			break;
		case 09:
			return "September";
			break;
		case 10:
			return "Oktober";
			break;
		case 11:
			return "November";
			break;
		case 12:
			return "Desember";
			break;
	}
}

function getIpRange(  $cidr) {

    list($ip, $mask) = explode('/', $cidr);

    $maskBinStr =str_repeat("1", $mask ) . str_repeat("0", 32-$mask );      //net mask binary string
    $inverseMaskBinStr = str_repeat("0", $mask ) . str_repeat("1",  32-$mask ); //inverse mask

    $ipLong = ip2long( $ip );
    $ipMaskLong = bindec( $maskBinStr );
    $inverseIpMaskLong = bindec( $inverseMaskBinStr );
    $netWork = $ipLong & $ipMaskLong; 

    $start = $netWork+1;//ignore network ID(eg: 192.168.1.0)

    $end = ($netWork | $inverseIpMaskLong) -1 ; //ignore brocast IP(eg: 192.168.1.255)
    return array('firstIP' => $start, 'lastIP' => $end );
}

function getEachIpInRange ( $cidr) {
    $ips = array();
    $range = getIpRange($cidr);
    for ($ip = $range['firstIP']; $ip <= $range['lastIP']; $ip++) {
        $ips[] = long2ip($ip);
    }
    return $ips;
}