<?php
/*
 * Project Name: Globalxtreme Web Payment Template
 * Project URI: https://globalxtreme.net/new/payment
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Agustus 2013
 * Email: dwi@globalxtreme.net
 * Project for Web Payment
 * Last edited: Dwi
 * Desc: 
 * 
 */
include ("../../config/configuration_admin.php");

  //the SQL statement that will query the database
   //$conn_soft = Config::getInstanceSoft();
   
   //RBS
	  $conn_soft = Config::getInstanceSoft();
	  
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
	  
	  $sql_rbs_lastdata_user	= "SELECT TOP 1 [Users].[UserPaymentBalance], [AccountTypes].[AccountName] FROM [dbo].[Users], [dbo].[AccountTypes]
	  WHERE [dbo].[Users].[AccountIndex] = [dbo].[AccountTypes].[AccountIndex]
	  AND [dbo].[Users].[UserIndex] = '6420';";
	  $query_rbs_lastdata_user = $conn_soft->prepare($sql_rbs_lastdata_user);
	  $query_rbs_lastdata_user->execute();
	  $row_rbs_lastdata_user	= $query_rbs_lastdata_user->fetch();
	  
	  $UserPaymentBalance = $row_rbs_lastdata_user["UserPaymentBalance"];
	  $AccountName = $row_rbs_lastdata_user["AccountName"];
	  
	  //END RBS
	  
				
	$sql = "SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
	INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
	VALUES ('".$BillingTransactionIndex."', '".date("Y-m-d H:i:s.000")."', '1', '6420', '2', '".$PaymentNumber."', '50000');
	SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF";
	
	echo $sql;
	$q = $conn_soft->prepare($sql);
	$q->execute();
	
	
	$UserPaymentBalance_update = $UserPaymentBalance + 50000;
	
	$sql_rbs_user_detail = "
	INSERT INTO [dbo].[Payments] ([PaymentNumber], [PaymentMethod], [CreateDate], [UserType], [UserIndex], [Amount], [Remark])
	VALUES ('".$PaymentNumber."', '3', '".date("Y-m-d H:i:s.000")."', '1', '6420', '50000', 'Bayar No INV08132015   BCM-08132015  ');
	
	UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='".$UserPaymentBalance_update."'
	WHERE ([UserIndex]='6420');
	";
	echo $sql_rbs_user_detail;
	$query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);
	
	$query_rbs_user_detail->execute();