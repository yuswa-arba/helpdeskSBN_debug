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

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Group RBS");
    global $conn;
    $conn_soft = Config::getInstanceSoft();
	/*
	$userindex = '29';
	$nominal = '-300000';
	
	$sql_rbs_lastdata	= "SELECT TOP 1 [billingTransactions].[BillingTransactionIndex] FROM [dbo].[billingTransactions] ORDER BY [BillingTransactionIndex] DESC;";
	$query_rbs_lastdata = $conn_soft->prepare($sql_rbs_lastdata);
	$query_rbs_lastdata->execute();
	$row_rbs_lastdata	= $query_rbs_lastdata->fetch();
	
	$BillingTransactionIndex = $row_rbs_lastdata["BillingTransactionIndex"] + 1;
	
	$sql_pay_lastdata	= "SELECT TOP 1 [Payments].[PaymentNumber] FROM [dbo].[Payments] ORDER BY [PaymentNumber] DESC;";
	$query_pay_lastdata = $conn_soft->prepare($sql_pay_lastdata);
	$query_pay_lastdata->execute();
	$row_pay_lastdata	= $query_pay_lastdata->fetch();
	
	$PaymentNumber = $row_pay_lastdata["PaymentNumber"] + 1;
	
	$sql_bill_lastdata	= "SELECT TOP 1 [dbo].[Bills].[BillIndex] FROM [dbo].[Bills] ORDER BY [dbo].[Bills].[BillIndex] DESC;";
	$query_bill_lastdata = $conn_soft->prepare($sql_bill_lastdata);
	$query_bill_lastdata->execute();
	$row_bill_lastdata	= $query_bill_lastdata->fetch();
	
	$BillIndex = $row_bill_lastdata["BillIndex"] + 1;
	
		//$sql_invoice = "SET IDENTITY_INSERT [dbo].[Bills] ON
		//		INSERT INTO [dbo].[Bills] ([BillIndex], [BillType], [UserIndex], [BillStartDate], [BillEndDate], [CreateDate], [Emailed], [Charged], [EmailedSessions], [Exported1], [Exported2])
		//		VALUES ('".$BillIndex."', '1', '".$userindex."', '', '', '".date("Y-m-d H:i:s.000")."', '0', '0', '0', '0', '0');
		//		SET IDENTITY_INSERT [dbo].[Bills] OFF
		//		
		//		INSERT INTO [dbo].[BillsSections] ([BillIndex], [BillSectionIndex], [Type], [Charge], [Info1], [Info2], [Info3], [Remark])
		//		VALUES ('".$BillIndex."', '1', '1', '300000', '0', '0', '0', 'Adjustment RBS');
		//		";
		//$q = $conn_soft->prepare($sql_invoice);
		//$q->execute();
		
		$sql = "SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
		INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
		VALUES ('".$BillingTransactionIndex."', '".date("Y-m-d H:i:s.000")."', '1', '".$userindex."', '2', '".$PaymentNumber."', '".$nominal."');
		SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF";
		$q = $conn_soft->prepare($sql);
		$q->execute();
		
		
		$sql_rbs_user_detail = "
		INSERT INTO [dbo].[Payments] ([PaymentNumber], [PaymentMethod], [CreateDate], [UserType], [UserIndex], [Amount], [Remark])
		VALUES ('".$PaymentNumber."', '3', '".date("Y-m-d H:i:s.000")."', '1', '".$userindex."', '".$nominal."', 'Adjustment RBS');
		
		UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='0'
		WHERE ([UserIndex]='".$userindex."');
		";
		$query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);
		
		$query_rbs_user_detail->execute();
	*/
    echo "ok";
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>