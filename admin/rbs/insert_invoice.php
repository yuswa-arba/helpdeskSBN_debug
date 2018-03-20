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

$conn_ott   = DB_TV();

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Group RBS");
    global $conn;
    $conn_soft = Config::getInstanceSoft();
	
	
    $userid  	= '01_sbn.bali';
    $id_paket	= '1';

    //invoice    
    $sql_cabang	= mysql_query("SELECT * FROM `gx_cabang` WHERE `level` = '0' LIMIT 0,1;", $conn);
    $row_cabang = mysql_fetch_array($sql_cabang);
    
    $sql_customer	= mysql_query("SELECT * FROM `tbCustomer` WHERE `cUserID` = '".$userid."' LIMIT 0,1;", $conn);
    $row_customer	= mysql_fetch_array($sql_customer);
	
	$sql_paket	= mysql_query("SELECT * FROM `gx_paket2` WHERE `id_paket` = '".$id_paket."' LIMIT 0,1;", $conn);
    $row_paket	= mysql_fetch_array($sql_paket);
    
    $sql_invoice  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_invoice` ORDER BY `id_invoice` DESC", $conn));
    $last_data  = $sql_invoice["id_invoice"] + 1;
    $tanggal    = date("d");
    $kode_invoice = $row_cabang["kode_cabang"].'-'.$row_cabang["invoice_code"].''.$tanggal.''.sprintf("%04d", $last_data);
	
	
	//RBS
	$sql_rbs_lastdata	= "SELECT TOP 1 [billingTransactions].[BillingTransactionIndex] FROM [dbo].[billingTransactions] ORDER BY [BillingTransactionIndex] DESC;";
	$query_rbs_lastdata = $conn_soft->prepare($sql_rbs_lastdata);
	$query_rbs_lastdata->execute();
	$row_rbs_lastdata	= $query_rbs_lastdata->fetch();
	
	$BillingTransactionIndex = $row_rbs_lastdata["BillingTransactionIndex"] + 1;
	
	$sql_bill_lastdata	= "SELECT TOP 1 [Bills].[BillIndex] FROM [dbo].[Bills] ORDER BY [BillIndex] DESC;";
	$query_bill_lastdata = $conn_soft->prepare($sql_bill_lastdata);
	$query_bill_lastdata->execute();
	$row_bill_lastdata	= $query_bill_lastdata->fetch();
	
	$BillIndex = $row_bill_lastdata["BillIndex"] + 1;
	
	//BillSection 
	$sql_billsection_lastdata	= "SELECT TOP 1 [dbo].[BillsSections].[BillSectionIndex] FROM [dbo].[BillsSections] ORDER BY [dbo].[BillsSections].[BillSectionIndex] DESC;";
	$query_billsection_lastdata = $conn_soft->prepare($sql_billsection_lastdata);
	$query_billsection_lastdata->execute();
	$row_billsection_lastdata	= $query_billsection_lastdata->fetch();
	
	$BillSectionIndex = $row_billsection_lastdata["BillSectionIndex"] + 1;
	
	$sql_rbs_lastdata_user	= "SELECT TOP 1 [Users].[UserPaymentBalance], [AccountTypes].[AccountName] FROM [dbo].[Users], [dbo].[AccountTypes]
	WHERE [dbo].[Users].[AccountIndex] = [dbo].[AccountTypes].[AccountIndex]
	AND [dbo].[Users].[UserActive] = '1'
	AND [dbo].[Users].[UserIndex] = '".$row_customer["iuserIndex"]."';";
	$query_rbs_lastdata_user = $conn_soft->prepare($sql_rbs_lastdata_user);
	$query_rbs_lastdata_user->execute();
	$row_rbs_lastdata_user	= $query_rbs_lastdata_user->fetch();
	
	$UserPaymentBalance = $row_rbs_lastdata_user["UserPaymentBalance"];
	$AccountName = $row_rbs_lastdata_user["AccountName"];
	$tgl_tagihan = date("Y-m-d");
	//END RBS
	
	$acc_monthly = $row_paket["monthly_fee"] + $row_paket["abonemen_video"];
	
	//START GENERATE INPUT INVOICE RBS
	if($acc_monthly != "0")
	{
		$ppn = (10/100) * $acc_monthly;
		$grandtotal = $acc_monthly + $ppn;
		
		
		$sql = "SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
		INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
		VALUES ('".$BillingTransactionIndex."', '".date("Y-m-d H:i:s.000")."', '1', '".$row_customer["iuserIndex"]."', '1', '".$BillIndex."', '-".$grandtotal."');
		SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF";
		
		echo nl2br($sql)."<br>";
		//$q = $conn_soft->prepare($sql);
		//$q->execute();
		//enableLog("","auto", "auto",$sql);
		
		$UserPaymentBalance_update = $UserPaymentBalance - $grandtotal;
		$nterm = (int)$row_customer["nterm"];
		$tambahan_grace = ($nterm == "0") ? "2" : $nterm;
		
		$sql_rbs_user_detail = "SET IDENTITY_INSERT [dbo].[Bills] ON
		INSERT INTO [dbo].[Bills] ([BillIndex], [BillType], [UserIndex], [BillStartDate], [BillEndDate], [CreateDate], [Emailed], [Charged], [EmailedSessions], [Exported1], [Exported2])
		VALUES ('".$BillIndex."', '1', '".$row_customer["iuserIndex"]."', '".date("Y-m-d 00:00:00.000", strtotime($tgl_tagihan))."', '".date("Y-m-d 23:59:59.000", strtotime($tgl_tagihan))."', '".date("Y-m-d H:i:s.000")."', '0', '0', '0', '0', '0');
		SET IDENTITY_INSERT [dbo].[Bills] OFF
		
		INSERT INTO [dbo].[BillsSections] ([BillIndex], [BillSectionIndex], [Type], [Charge], [Info1], [Info2], [Info3], [Remark])
		VALUES ('".$BillIndex."', '".$BillSectionIndex."', '1', '".$grandtotal."', '0', '0', '0', 'Activation For Dates ".date("d/m/Y", strtotime($tgl_tagihan))." - ".date("t/m/Y", strtotime($tgl_tagihan))." (".$AccountName.").');

		
		UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='".$UserPaymentBalance_update."', [GracePeriodExpiration] = '". date("Y-m-d 00:00:00.000", strtotime($tgl_tagihan. "+$tambahan_grace days"))."',
		[UserExpiryDate] = '".date("Y-m-01 00:00:00.000", strtotime($tgl_tagihan. "+1 month"))."'
		WHERE ([UserIndex]='".$row_customer["iuserIndex"]."');
		";
		echo nl2br($sql_rbs_user_detail)."<br>";
		//$query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);
		//
		//$query_rbs_user_detail->execute();
	
$query_rbs = "
DELETE FROM [dbo].[Bills] WHERE ([BillIndex] = '390') AND ([UserIndex] = '9');

DELETE FROM [dbo].[BillsSections] WHERE ([BillIndex] = '390') AND ([BillSectionIndex] = '233');
DELETE FROM [dbo].[BillsSections] WHERE ([BillIndex] = '391') AND ([BillSectionIndex] = '234');

DELETE FROM [dbo].[BillingTransactions] WHERE ([BillingTransactionIndex]='539');
DELETE FROM [dbo].[BillingTransactions] WHERE ([BillingTransactionIndex]='540');
";

echo nl2br($query_rbs);
//$sql_data = $conn_soft->prepare($query_rbs);
//$sql_data->execute();
	//END GENERATE RBS
    
	}
    
    
		echo "Data telah disimpan";
    


}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>