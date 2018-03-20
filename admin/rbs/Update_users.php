<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration_admin.php");
include ("../../config/configuration_tv.php");
require_once("../auto/pdf_invoice.php");

$conn_ott   = DB_TV();

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Group RBS");
    global $conn;
    $conn_soft = Config::getInstanceSoft();
	
	$data_userid = array();
    $sql_ip = mysql_query("SELECT * FROM `gx_master_ip` WHERE `level` =  '0';", $conn);
	while($row_ip = mysql_fetch_array($sql_ip))
	{
		//$data_userid[] = array(long2ip($row_ip["ip_address"]) => $row_ip['userid_ip']);
		//$ip_address = long2ip($row_ip["ip_address"]);
		//if (PHP_INT_SIZE == 8)
		//{
		//	if ($ip_address>0x7FFFFFFF)
		//	{
		//		$ip_address-=0x100000000;
		//	}
		//}
		//if($row_ip['userid_ip'] != "")
		//{
		//	$query = "UPDATE [dbo].[Users] SET [UserIP]='".trim($ip_address)."' WHERE ([UserID]='".trim($row_ip['userid_ip'])."');<br>";
		//	echo $query."<br>";
		//	$sql_data = $conn_soft->prepare("UPDATE [dbo].[Users] SET [UserIP]='".trim($ip_address)."' WHERE ([UserID]='".trim($row_ip['userid_ip'])."');");
		//	$sql_data->execute();
		//}
								
	}
	//echo "<pre>";
	//print_r($data_userid);

$userid3 = array(
	'10.210.0.1' => 'resturaheni',
	'10.210.0.2' => 'erikmandala',
	'10.210.0.3' => 'ardiheryana',
	'10.210.0.4' => 'rizkydianpramarta',
	'10.210.0.5' => 'wayanpudja',
	'10.210.0.6' => 'davidsetiawan',
	'10.210.0.7' => 'karmiasih',
	'10.210.0.8' => 'mademurjana',
	'10.210.0.9' => 'nengahtiasta',
	'10.210.0.10' => 'putuyadnya',
	'10.210.0.11' => 'addekrisna',
	'10.210.0.12' => 'bandono',
	'10.210.0.13' => 'yullyani',
	'10.210.0.14' => 'ricaayu',
	'10.210.0.15' => 'frankywirawan',
	'10.210.0.16' => 'trisnaindjaja',
	'10.210.0.17' => 'mulyanus',
	'10.210.0.18' => 'aditama',
	'10.210.0.19' => 'bagusrico',
	'10.210.0.20' => 'yordyiswoyo',
	
	'10.210.0.21' => 'christianta',
	'10.210.0.22' => 'dpachlevy',
	'10.210.0.23' => 'tandrawati',
	'10.210.0.24' => 'madesuyasa',
	'10.210.0.25' => 'purnamawati',
	'10.210.0.26' => 'bayumahardika',
	'10.210.0.27' => 'yuririvalen',
	'10.210.0.28' => 'andyw',
	'10.210.0.29' => 'indrayati',
	'10.210.0.30' => 'raymond',
	
	'10.210.0.31' => 'dwijaputra',
	'10.210.0.32' => 'madesudewa',
	'10.210.0.33' => 'padmalaksana',
	'10.210.0.34' => 'wiradarma',
	'10.210.0.35' => 'anggapremana',
	'10.210.0.36' => 'siska'
);
$userid_2 = array(
	'10.210.0.6' => 'davidsetiawan',
	'10.210.0.7' => 'karmiasih',
);



//update billsection

//$query = "UPDATE [dbo].[BillsSection] SET [UserIP]='".trim($ip_address)."' WHERE ([UserID]='".trim($userid)."');<br>";
//echo $query;
//$sql_data = $conn_soft->prepare("UPDATE TOP (1) [dbo].[BillingTransactions]
//SET [Total] = '-330000'
//WHERE [BillingTransactionIndex] = '258';");
//$sql_data->execute();

//end
/*
//UPDATE TOP(1) [dbo].[Payments] SET [Amount]='300000' WHERE ([PaymentNumber]='65');
//UPDATE TOP(1) [dbo].[BillingTransactions] SET [Total]='300000' WHERE ([BillingTransactionIndex]='158');
//UPDATE [dbo].[Users] SET [UserPaymentBalance]='0' WHERE ([UserID]='".trim('yordyiswoyo')."');
//UPDATE TOP(1) [dbo].[BillsSections] SET [BillIndex]='1', [BillSectionIndex]='1', [Type]='8', [Charge]='2500000', [Info1]='0', [Info2]='0', [Info3]='0', [Remark]='For Dates 11/10/2007 - 11/10/2007 (00_vbU-trial).' WHERE ([BillIndex]='1') AND ([BillSectionIndex]='1');

//UPDATE TOP(1) [dbo].[Payments] SET [Amount]='300000' WHERE ([PaymentNumber]='64');
//UPDATE TOP(1) [dbo].[BillingTransactions] SET [Total]='300000' WHERE ([BillingTransactionIndex]='157');

UPDATE TOP (1) [dbo].[BillsSections] SET [Charge] = '287096' WHERE ([BillIndex] = '97') AND ([BillSectionIndex] = '1');
UPDATE TOP(1) [dbo].[BillingTransactions] SET [Total]='-287096' WHERE ([BillingTransactionIndex]='178');

UPDATE [dbo].[Users] SET [UserPaymentBalance]='-100000' WHERE ([UserID]='".trim('01_sbn.bali')."');


UPDATE TOP(1) [dbo].[BillingTransactions] SET [Total]='0' WHERE ([BillingTransactionIndex]>='1374');
UPDATE [dbo].[Users] SET [UserPaymentBalance]='55000' WHERE ([UserID]='".trim('nyomansuadi')."');
UPDATE TOP (1) [dbo].[BillsSections] SET [Charge] = '0' WHERE ([BillIndex] = '1265') AND ([BillSectionIndex] = '1');

*/
//$sql_data = $conn_soft->prepare("SELECT * FROM [dbo].[Users] WHERE [dbo].[Users].[GracePeriodExpiration] >= '". date("2017-10-03 00:00:00.000")."'
//								AND [dbo].[Users].[GracePeriodExpiration] <= '". date("2017-10-03 23:59:59.000")."'
//								AND [dbo].[Users].[UserPaymentBalance] < 1;");
////  AND dbo.Users.UserIndex = '6418'
//$sql_data->execute();
//
//$no = 1;
//while ($row_data = $sql_data->fetch())
//{
//	echo "UPDATE TOP(1) [dbo].[Users] SET [GracePeriodExpiration] = '". date("2017-10-04 08:00:00.000")."'
//	WHERE ([UserID]='".trim($row_data["UserID"])."');<br>";
//	//$sql_data2 = $conn_soft->prepare("UPDATE [dbo].[Users] SET [GracePeriodExpiration] = '". date("2017-10-04 08:00:00.000")."'
//	//WHERE ([UserIndex]='".trim($row_data["UserIndex"])."');");
//	//$sql_data2->execute();
//}
$query_helpdesk = "



";
$tgl_tagihan = date("Y-m-d");
$query_rbs = "

UPDATE [dbo].[Users] SET [UserPaymentBalance]='0' WHERE ([UserID]='".trim('adisaputra')."');

";
 //echo $query_helpdesk;
 /*
  
}
DELETE FROM [dbo].[BillingTransactions] WHERE ([BillingTransactionIndex]='970');
DELETE FROM [dbo].[BillsSections] WHERE ([BillIndex] = '761') ;

UPDATE [dbo].[Users] SET [UserPaymentBalance]='330000' WHERE ([UserID]='".trim('gedebudiawan')."');

DELETE FROM [dbo].[BillingTransactions] WHERE ([BillingTransactionIndex]='971');
DELETE FROM [dbo].[BillsSections] WHERE ([BillIndex] = '762 AND ([BillSectionIndex] = '1');

UPDATE [dbo].[Users] SET [UserPaymentBalance]='220000' WHERE ([UserID]='".trim('denny.nata')."');

DELETE FROM [dbo].[BillingTransactions] WHERE ([BillingTransactionIndex]='970');
DELETE FROM [dbo].[BillsSections] WHERE ([BillIndex] = '761') AND ([BillSectionIndex] = '1');

UPDATE [dbo].[Users] SET [UserPaymentBalance]='330000' WHERE ([UserID]='".trim('gedebudiawan')."');
  */
//DELETE FROM [dbo].[BillingTransactions] WHERE ([BillingTransactionIndex]='725');
//DELETE FROM [dbo].[Payments] WHERE ([PaymentNumber] = '310');
//DELETE FROM [dbo].[BillingTransactions] WHERE ([BillingTransactionIndex]='656');
//DELETE FROM [dbo].[BillsSections] WHERE ([BillIndex] = '555') AND ([BillSectionIndex] = '1');
 //mysql_query($query_helpdesk, $conn);
//$sql_update_tv = "UPDATE `boss`.`t_account_cms` SET `CLIENTCODE`='0062000000200022001C1D30A85F' WHERE (`CLIENTNAME`='01_sbn.bali');";
//mysqli_query($conn_ott ,$sql_update_tv) or die (mysqli_error());

//UPDATE [dbo].[Users] SET [UserPaymentBalance]='-181500' WHERE ([UserID]='".trim('anggapremana')."');
// echo $query. $sql_update_tv;
//echo substr("0062000000200031001C1D30A86E", 0,-12);
//generate_pdf("SBNB-010418");
////echo nl2br($query_rbs);
////$sql_data = $conn_soft->prepare($query_rbs);
////$sql_data->execute();
//echo '<table border="1">';
//$sql_customer	= mysql_query("SELECT * FROM `v_customer_aktivasi` WHERE `level` = '-330000'", $conn);
//while($row_customer	= mysql_fetch_array($sql_customer))
//{
//
//
//
//	if($row_customer["cKode"] != "" AND $row_customer["cNonAktiv"] == "0" AND
//	   $row_customer["kode_inactive"] == NULL AND $row_customer["kode_off"] == NULL AND
//	   $row_customer["kode_aktivasi"] != NULL)
//	{
//		echo '<tr>
//		<td>'.$row_customer["cUserID"].'</td>
//		<td>'.$row_customer["cKode"].'</td>
//		<td>'.$row_customer["cNonAktiv"].'</td>
//		<td>'.$row_customer["kode_inactive"].'</td>
//		<td>'.$row_customer["kode_off"].'</td>
//		<td>'.$row_customer["kode_aktivasi"].'</td>
//		</tr>
//		';
//	}
//}
//echo '</table>';

//$ip_address = ip2long("10.210.0.37");
//if (PHP_INT_SIZE == 8)
//{
//	if ($ip_address>0x7FFFFFFF)
//	{
//		$ip_address-=0x100000000;
//	}
//}
//
//$query = "UPDATE [dbo].[Users] SET [UserIP]='".trim($ip_address)."' WHERE ([UserID]='01_sbn.bali');<br>";
//echo $query;
//$sql_data = $conn_soft->prepare("UPDATE [dbo].[Users] SET [UserIP]='".trim($ip_address)."' WHERE ([UserID]='01_sbn.bali');");
//$sql_data->execute();

/*
foreach($userid as $ip => $userid)
{
	$ip_address = ip2long($ip);
	if (PHP_INT_SIZE == 8)
	{
		if ($ip_address>0x7FFFFFFF)
		{
			$ip_address-=0x100000000;
		}
	}

	$query = "UPDATE [dbo].[Users] SET [UserIP]='".trim($ip_address)."' WHERE ([UserID]='".trim($userid)."');<br>";
	echo $query;
	$sql_data = $conn_soft->prepare("UPDATE [dbo].[Users] SET [UserIP]='".trim($ip_address)."' WHERE ([UserID]='".trim($userid)."');");
	$sql_data->execute();
}
*/
//  AND dbo.Users.UserIndex = '6418'


echo "ok";
    //$title	= 'Groups RBS';
    //$submenu	= "group_rbs";
    ////$plugins	= '';
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