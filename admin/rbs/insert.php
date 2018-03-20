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
   
   $sql_rbs_lastdata	= "SELECT TOP 1 [Users].[UserIndex] FROM [dbo].[Users] ORDER BY [UserIndex] DESC;";
	$query_rbs_lastdata = $conn_soft->prepare($sql_rbs_lastdata);
	$query_rbs_lastdata->execute();
	$row_rbs_lastdata	= $query_rbs_lastdata->fetch();
	
	//$UserIndex = $row_rbs_lastdata["UserIndex"] + 1;
	$UserIndex = '6470';
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

$sql = "SET IDENTITY_INSERT [dbo].[Users] ON
INSERT INTO [Users] 
([UserIndex], [UserID], [Password], [PasswordDate], [PasswordSource], 
[GroupName], [UserService], [UserIP], [FilterName], [StartDate], 
[UserExpiryDate], [ManualExpirationDate], [SuspendDate], [UserActive], 
[AccountIndex], [UserTimeBank], [UserKBBank], [UserDollarBank], [UserBalance], 
[UserPaymentBalance], [TimeOnline], [CallBackNumber], [CallerID], [Lockout], 
[LockoutTime], [LockoutCount], [GracePeriodExpiration], [NASAttributes]) 
VALUES (:UserIndex, :UserID, :Password, :PasswordDate, :PasswordSource, 
:GroupName, :UserService, :UserIP, :FilterName, :StartDate, 
:UserExpiryDate, :ManualExpirationDate, :SuspendDate, :UserActive, 
:AccountIndex, :UserTimeBank, :UserKBBank, :UserDollarBank, :UserBalance, 
:UserPaymentBalance, :TimeOnline, :CallBackNumber, :CallerID, :Lockout, 
:LockoutTime, :LockoutCount, :GracePeriodExpiration, :NASAttributes);
SET IDENTITY_INSERT [dbo].[Users] OFF";
$q = $conn_soft->prepare($sql);
$ip_address = ip2long("192.168.1.10");
echo $sql;
if (PHP_INT_SIZE == 8)
{
    if ($ip_address>0x7FFFFFFF)
    {
        $ip_address-=0x100000000;
    }
}
$q->execute(array(':UserIndex' => "$UserIndex",
				  ':UserID' => "dwiwar",
				  ':Password' => "gl0b4l",
				  ':PasswordDate' => NULL,
				  ':PasswordSource' => "0",
				  ':GroupName' => "dl.shared",
				  ':UserService' => "0",
				  ':UserIP' => "$ip_address",
				  ':FilterName' => NULL,
				  ':StartDate' => date("Y-m-d"),
				  ':UserExpiryDate' => date("Y-m-d"),
				  ':ManualExpirationDate' => NULL,
				  ':SuspendDate' => NULL,
				  ':UserActive' => "1",
				  ':AccountIndex' => "409",
				  ':UserTimeBank' => "0",
				  ':UserKBBank' => "0",
				  ':UserDollarBank' => "0",
				  ':UserBalance' => "0",
				  ':UserPaymentBalance' => "0",
				  ':TimeOnline' => "0",
				  ':CallBackNumber' =>NULL,
				  ':CallerID' => NULL,
				  ':Lockout' => "0",
				  ':LockoutTime' => NULL,
				  ':LockoutCount' => NULL,
				  ':GracePeriodExpiration' => date("Y-m-d"),
				  ':NASAttributes' => NULL));

$sql_rbs_user_detail = "IF EXISTS (SELECT * FROM [dbo].[Users] WHERE [UserIndex]='".$UserIndex."')
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
VALUES (:UserIndex, :FirstName, :MiddleName, :LastName, 
:Company, :Address1, :Address2, :City, :State, :Country, :Zip, :PhoneHome, 
:PhoneWork, :PhoneFax, :Email, :CreateDate, :LastModify, :NewUser, :LastCharge, 
:TotalCharge, :LastOnlineTime, :LastTotalTime, :TotalOnlineTime, :LastTotalOnlineUpdate, 
:TaxType, :AdminType, :CreditCardType, :CreditCardNumber, :CreditExpiration, :CreditHolderName, 
:CreditHolderAddress, :CreditHolderCity, :CreditHolderState, :CreditHolderCountry, 
:CreditHolderCityZip, :CustomInfo1, :CustomInfo2, :CustomInfo3, :CustomInfo4, 
:Comments, :OnExpireAction, :NewAccountIndex, :NewUserBill, :MBRUserIndex, 
:IsMBR, :AffiliateIndex, :PaymentMethod, :PrePayClass, :EmailFlag1, :EmailFlag2, 
:EmailFlag3, :EmailFlag4, :BankName, :BankAddress, :BankAccountName, :BankAccountNumber, 
:TransferCurrencyType);";
$query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);

$query_rbs_user_detail->execute(array(':UserIndex' => "$UserIndex", 
':FirstName' => "Dwi", 
':MiddleName' => "", 
':LastName' => "Wardiansah", 
':Company' => "test", 
':Address1' => "malang", 
':Address2' => "", 
':City' => "malang", 
':State' => "jawa", 
':Country' => "", 
':Zip' => "65123", 
':PhoneHome' => "0817", 
':PhoneWork' => "08766", 
':PhoneFax' => "", 
':Email' => "email@email.com", 
':CreateDate' => date("Y-m-d H:i:s.000"), 
':LastModify' => date("Y-m-d H:i:s.000"),  
':NewUser' => "0", 
':LastCharge' => "0", 
':TotalCharge' => "0", 
':LastOnlineTime' => "0", 
':LastTotalTime' => "0", 
':TotalOnlineTime' => "0", 
':LastTotalOnlineUpdate' => "0", 
':TaxType' => NULL, 
':AdminType' => "0", 
':CreditCardType' => NULL, 
':CreditCardNumber' => NULL, 
':CreditExpiration' => "0", 
':CreditHolderName' => NULL, 
':CreditHolderAddress' => NULL, 
':CreditHolderCity' => NULL,
':CreditHolderState' => NULL,
':CreditHolderCountry' => NULL,
':CreditHolderCityZip' => NULL,
':CustomInfo1' => "192.168.1.1", 
':CustomInfo2' => "P-D000001", 
':CustomInfo3' => "", 
':CustomInfo4' => "", 
':Comments' => "", 
':OnExpireAction' => NULL, 
':NewAccountIndex' => NULL, 
':NewUserBill' => "0", 
':MBRUserIndex' => "0", 
':IsMBR' => "0", 
':AffiliateIndex' => NULL, 
':PaymentMethod' => "0", 
':PrePayClass' => NULL, 
':EmailFlag1' => "0", 
':EmailFlag2' => "0", 
':EmailFlag3' => "0", 
':EmailFlag4' => "0", 
':BankName' => NULL, 
':BankAddress' => NULL,
':BankAccountName' => NULL, 
':BankAccountNumber' => NULL, 
':TransferCurrencyType' => NULL));
	//$sql_insert_off = $conn_soft->prepare("SET IDENTITY_INSERT [dbo].[Users] OFF;");
		//$sql_data = $conn_soft->prepare("SET IDENTITY_INSERT [RBS-ISP].[dbo].[Users]  OFF");
	//$sql_insert_off->execute();
