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
   
   /*$sql_rbs_lastdata	= "SELECT TOP 1 [Users].[UserIndex] FROM [dbo].[Users] ORDER BY [UserIndex] DESC;";
	$query_rbs_lastdata = $conn_soft->prepare($sql_rbs_lastdata);
	$query_rbs_lastdata->execute();
	$row_rbs_lastdata	= $query_rbs_lastdata->fetch();
	
	$UserIndex = $row_rbs_lastdata["UserIndex"] + 1;
    echo $UserIndex;
	echo date("Y-m-d H:i:s.000");
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
$ip_address = ip2long("10.0.100.23");
echo long2ip("-1057380088")."<br>";
echo ip2long("192.168.1.20")."<br>";

// IP Address to Number
function inet_aton($ip)
{
    $ip = trim($ip);
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) return 0;
    return sprintf("%u", ip2long($ip));  
}

// Number to IP Address
function inet_ntoa($num)
{
    $num = trim($num);
    if ($num == "0") return "0.0.0.0";
    return long2ip(-(4294967295 - ($num - 1))); 
}

echo inet_aton("192.168.1.20");
/*
$sql = "SET IDENTITY_INSERT [dbo].[Users] ON
INSERT INTO [Users] 
([UserIndex], [UserID], [Password], [PasswordDate], [PasswordSource], 
[GroupName], [UserService], [UserIP], [FilterName], [StartDate], 
[UserExpiryDate], [ManualExpirationDate], [SuspendDate], [UserActive], 
[AccountIndex], [UserTimeBank], [UserKBBank], [UserDollarBank], [UserBalance], 
[UserPaymentBalance], [TimeOnline], [CallBackNumber], [CallerID], [Lockout], 
[LockoutTime], [LockoutCount], [GracePeriodExpiration], [NASAttributes]) 
VALUES ('".$UserIndex."', 'dwiwi1', 'global123', NULL, '0', 'dl-business',
		'0', '".$ip_address."', NULL, '".date("Y-m-d")."', '".date("Y-m-d")."', NULL, NULL, '0', '397', '0',
		'0', '0', '0', '0', '0', NULL, NULL, '0', NULL, NULL, '".date("Y-m-d")."', NULL);
SET IDENTITY_INSERT [dbo].[Users] OFF ";
echo $sql;

$q = $conn_soft->prepare($sql);

//echo $ip_address;

$q->execute();

$sql_rbs_user_detail = " IF NOT EXISTS (SELECT * FROM [dbo].[UserDetails] WHERE [UserIndex]='".$UserIndex."')
INSERT INTO [dbo].[UserDetails] ([UserIndex], [FirstName], [MiddleName], [LastName], 
[Company], [Address1], [Address2], [City], [State], [Country], [Zip], [PhoneHome], 
[PhoneWork], [PhoneFax], [Email], [CreateDate], [LastModify], [NewUser], [LastCharge], 
[TotalCharge], [LastOnlineTime], [LastTotalTime], [TotalOnlineTime], [LastTotalOnlineUpdate], 
[TaxType], [AdminType], [CreditCardType], [CreditCardNumber], [CreditExpiration], [CreditHolderName], 
[CreditHolderAddress], [CreditHolderCity], [CreditHolderState], [CreditHolderCountry],
[CreditHolderCityZip], [CustomInfo1], [CustomInfo2], [CustomInfo3], [CustomInfo4], 
[Comments], [OnExpireAction], [NewAccountIndex], [NewUserBill], [MBRUserIndex], 
[IsMBR], [AffiliateIndex], [PaymentMethod], [PrePayClass], [EmailFlag1], [EmailFlag2],
[EmailFlag3], [EmailFlag4], [BankName], [BankAddress], [BankAccountName], [BankAccountNumber], 
[TransferCurrencyType])
VALUES ('".$UserIndex."', 'dwiwar12', '', 'war', 'test', 'malang', '', 'malang', 'jawa', '', '65123', '0817', '08766', 
'', 'email@email.com', '".date("Y-m-d H:i:s.000")."', '".date("Y-m-d H:i:s.000")."',  '0', '0', '0', '0', '0', '0', '".date("Y-m-d H:i:s.000")."', NULL, '0', NULL, NULL, '0', NULL, 
NULL, NULL,NULL,NULL,NULL,'192.168.1.1', 'GNB-D002', '','', '', NULL, NULL, '0', '0', '0', NULL, '0', NULL, '0', '0', '0', '0', NULL, 
NULL, NULL, NULL, NULL);";
echo $sql_rbs_user_detail;
$query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);

$query_rbs_user_detail->execute();
	//$sql_insert_off = $conn_soft->prepare("SET IDENTITY_INSERT [dbo].[Users] OFF;");
		//$sql_data = $conn_soft->prepare("SET IDENTITY_INSERT [RBS-ISP].[dbo].[Users]  OFF");
	//$sql_insert_off->execute();
