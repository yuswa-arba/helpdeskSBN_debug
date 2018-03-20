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
   $conn_soft = Config::getInstanceSoft();
   $conn_soft2 = Config::getInstanceSoft();
   
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
	
	$sql_rbs_lastdata_user	= "SELECT TOP 1 [Users].[UserPaymentBalance], [AccountTypes].[AccountName] FROM [dbo].[Users], [dbo].[AccountTypes]
	WHERE [dbo].[Users].[AccountIndex] = [dbo].[AccountTypes].[AccountIndex]
	AND [dbo].[Users].[UserIndex] = '6420';";
	$query_rbs_lastdata_user = $conn_soft->prepare($sql_rbs_lastdata_user);
	$query_rbs_lastdata_user->execute();
	$row_rbs_lastdata_user	= $query_rbs_lastdata_user->fetch();
	
	$UserPaymentBalance = $row_rbs_lastdata_user["UserPaymentBalance"];
	$AccountName = $row_rbs_lastdata_user["AccountName"];
	
    echo $BillingTransactionIndex."<br>";
	echo $UserPaymentBalance."<br>";
	//echo date("Y-m-d H:i:s.000");
	//$sql_insert_on = $conn_soft->prepare("SET IDENTITY_INSERT [Users] ON;");
		//$sql_data = $conn_soft->prepare("SET IDENTITY_INSERT [RBS-ISP].[dbo].[Users]  OFF");
	//$sql_insert_on->execute();

   //$sql_data = $conn_soft->prepare("SET IDENTITY_INSERT [RBS-ISP].[dbo].[Users] ON");
   /*$sql_data = $conn_soft->prepare("INSERT INTO [dbo].[Users] 
([UserIndex], [UserID], [Password], [PasswordDate], [PasswordSource], 
[GroupName], [UserService], [UserIP], [FilterName], [StartDate], 
[UserExpiryDate], [ManualExpirationDate], [SuspendDate], [UserActive], 
[AccountIndex], [UserTimeBank], [UserKBBank], [UserDollarBank], [UserBalance], 
[UserPaymentBalance], [TimeOnline], [CallBackNumber], [CallerID], [Lockout], 
[LockoutTime], [LockoutCount], [GracePeriodExpiration], [NASAttributes]) 
VALUES ('6418', 'dwiwardiansah', 'global123', NULL, '0',
'dl-business', '0', '".ip2long("202.58.203.27")."', NULL, GETDATE(), 
GETDATE(), NULL, NULL, '0', 
'397', '0', '0', '0', '0',
'0', '0', NULL, NULL, '0', 
NULL, NULL, GETDATE(), NULL); ");
	//$sql_data = $conn_soft->prepare("SET IDENTITY_INSERT [RBS-ISP].[dbo].[Users]  OFF");
$sql_data->execute();
*/
// query

//SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
//SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF
$sql = "SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
VALUES ('".$BillingTransactionIndex."', '".date("Y-m-d H:i:s.000")."', '1', '6420', '1', '".$BillIndex."', '-100000');
SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF";

echo $sql;
$q = $conn_soft->prepare($sql);
$ip_address = ip2long("10.0.100.23");
//echo $ip_address;

$q->execute();


$UserPaymentBalance_update = $UserPaymentBalance - 100000;

$sql_rbs_user_detail = "SET IDENTITY_INSERT [dbo].[Bills] ON
INSERT INTO [dbo].[Bills] ([BillIndex], [BillType], [UserIndex], [BillStartDate], [BillEndDate], [CreateDate], [Emailed], [Charged], [EmailedSessions], [Exported1], [Exported2])
VALUES ('".$BillIndex."', '1', '6420', '".date("Y-m-01 00:00:00.000")."', '".date("Y-m-t 23:59:59.000")."', '".date("Y-m-d H:i:s.000")."', '0', '0', '0', '0', '0');
SET IDENTITY_INSERT [dbo].[Bills] OFF
INSERT INTO [dbo].[BillsSections] ([BillIndex], [BillSectionIndex], [Type], [Charge], [Info1], [Info2], [Info3], [Remark])
VALUES ('".$BillIndex."', '1', '1', '100000', '0', '0', '0', 'For Dates 09/08/2015 - 09/09/2015 (".$AccountName.").');

UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='".$UserPaymentBalance_update."' WHERE ([UserIndex]='6420');
";
echo $sql_rbs_user_detail;
$query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);

$query_rbs_user_detail->execute();
	//$sql_insert_off = $conn_soft->prepare("SET IDENTITY_INSERT [dbo].[Users] OFF;");
		//$sql_data = $conn_soft->prepare("SET IDENTITY_INSERT [RBS-ISP].[dbo].[Users]  OFF");
	//$sql_insert_off->execute();
