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
    if($loggedin["group"] == 'admin')
    {
        global $conn;
    
if(isset($_POST["save"]))
{
    $cKode       	= isset($_POST['cKode']) ? mysql_real_escape_string(strip_tags(trim($_POST['cKode']))) : '';
    $cNama       	= isset($_POST['cNama']) ? mysql_real_escape_string(strip_tags(trim($_POST['cNama']))) : '';
    $cNamaPers		= isset($_POST['cNamaPers']) ? mysql_real_escape_string(strip_tags(trim($_POST['cNamaPers']))) : '';
    $cAlamat1   	= isset($_POST['cAlamat1']) ? mysql_real_escape_string(strip_tags(trim($_POST['cAlamat1']))) : '';
    $cKota		= isset($_POST['cKota']) ? mysql_real_escape_string(strip_tags(trim($_POST['cKota']))) : '';
    $cArea		= isset($_POST['cArea']) ? mysql_real_escape_string(strip_tags(trim($_POST['cArea']))) : '';
    $cDaerah		= isset($_POST['cDaerah']) ? mysql_real_escape_string(strip_tags(trim($_POST['cDaerah']))) : '';
    $ctelp		= isset($_POST['ctelp']) ? mysql_real_escape_string(strip_tags(trim($_POST['ctelp']))) : '';
    $cContact		= isset($_POST['cContact']) ? mysql_real_escape_string(strip_tags(trim($_POST['cContact']))) : '';
    $nterm		= isset($_POST['nterm']) ? mysql_real_escape_string(strip_tags(trim($_POST['nterm']))) : '';
    $cKet		= isset($_POST['cKet']) ? mysql_real_escape_string(strip_tags(trim($_POST['cKet']))) : '';
    $cEmail		= isset($_POST['cEmail']) ? mysql_real_escape_string(strip_tags(trim($_POST['cEmail']))) : '';
    $cMailIntern 	= isset($_POST['cMailIntern']) ? mysql_real_escape_string(strip_tags(trim($_POST['cMailIntern']))) : '';
    $cUserID	 	= isset($_POST['cUserID']) ? mysql_real_escape_string(strip_tags(trim($_POST['cUserID']))) : '';
    $cNamaIbu	 	= isset($_POST['cNamaIbu']) ? mysql_real_escape_string(strip_tags(trim($_POST['cNamaIbu']))) : '';
    $cNoHp1	 	= isset($_POST['cNoHp1']) ? mysql_real_escape_string(strip_tags(trim($_POST['cNoHp1']))) : '';
    $cNoHp2		= isset($_POST['cNoHp2']) ? mysql_real_escape_string(strip_tags(trim($_POST['cNoHp2']))) : '';
    $cPassword		= isset($_POST['cPassword']) ? mysql_real_escape_string(strip_tags(trim($_POST['cPassword']))) : '';
    $cKdPaket		= isset($_POST['cKdPaket']) ? mysql_real_escape_string(strip_tags(trim($_POST['cKdPaket']))) : '';
    $cIncludePPN	= isset($_POST['cIncludePPN']) ? mysql_real_escape_string(strip_tags(trim($_POST['cIncludePPN']))) : '0';
    $cExcludePPN	= isset($_POST['cExcludePPN']) ? mysql_real_escape_string(strip_tags(trim($_POST['cExcludePPN']))) : '0';
    $no_npwp		= isset($_POST['no_npwp']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_npwp']))) : '';
    $nama_npwp		= isset($_POST['nama_npwp']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_npwp']))) : '';
    $alamat_npwp	= isset($_POST['alamat_npwp']) ? mysql_real_escape_string(strip_tags(trim($_POST['alamat_npwp']))) : '';
    $cNoRekVirtual	= isset($_POST['cNoRekVirtual']) ? mysql_real_escape_string(strip_tags(trim($_POST['cNoRekVirtual']))) : '';
    $cSales		= isset($_POST['cSales']) ? mysql_real_escape_string(strip_tags(trim($_POST['cSales']))) : '';
    $cPaket		= isset($_POST['cPaket']) ? mysql_real_escape_string(strip_tags(trim($_POST['cPaket']))) : '';
    $dTglMulai		= isset($_POST['dTglMulai']) ? mysql_real_escape_string(strip_tags(trim($_POST['dTglMulai']))) : '';
    $dTglBerhenti	= isset($_POST['dTglBerhenti']) ? mysql_real_escape_string(strip_tags(trim($_POST['dTglBerhenti']))) : '';
    $id_acc_justifikasi	= isset($_POST['id_acc_justifikasi']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_acc_justifikasi']))) : '';
    $cNonAktiv		= isset($_POST['cNonAktiv']) ? mysql_real_escape_string(strip_tags(trim($_POST['cNonAktiv']))) : '';
    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_cabang']))) : '';
    $dTglLahir		= isset($_POST['dTglLahir']) ? mysql_real_escape_string(strip_tags(trim($_POST['dTglLahir']))) : '';
    $gx_bahasa		= isset($_POST['gx_bahasa']) ? mysql_real_escape_string(strip_tags(trim($_POST['gx_bahasa']))) : '';
	
    //data internet
    $cLongi		= isset($_POST['cLongi']) ? mysql_real_escape_string(strip_tags(trim($_POST['cLongi']))) : '';
    $cLati		= isset($_POST['cLati']) ? mysql_real_escape_string(strip_tags(trim($_POST['cLati']))) : '';
    $ip_ap		= isset($_POST['ip_ap']) ? mysql_real_escape_string(strip_tags(trim($_POST['ip_ap']))) : '';
    $ip_wl		= isset($_POST['ip_wl']) ? mysql_real_escape_string(strip_tags(trim($_POST['ip_wl']))) : '';
    $ip_bts		= isset($_POST['ip_bts']) ? mysql_real_escape_string(strip_tags(trim($_POST['ip_bts']))) : '';
    $cMacAdd		= isset($_POST['cMacAdd']) ? mysql_real_escape_string(strip_tags(trim($_POST['cMacAdd']))) : '';
    $bts		= isset($_POST['bts']) ? mysql_real_escape_string(strip_tags(trim($_POST['bts']))) : '';
    $acc_type_rbs	= isset($_POST['acc_type_rbs']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_type_rbs']))) : '';
    $user_ip		= isset($_POST['user_ip']) ? mysql_real_escape_string(strip_tags(trim($_POST['user_ip']))) : '';
    $iuserIndex		= isset($_POST['iuserIndex']) ? mysql_real_escape_string(strip_tags(trim($_POST['iuserIndex']))) : '';
    $cGroupRBS		= isset($_POST['cGroupRBS']) ? mysql_real_escape_string(strip_tags(trim($_POST['cGroupRBS']))) : '';
    $cKdNAS		= isset($_POST['cKdNAS']) ? mysql_real_escape_string(strip_tags(trim($_POST['cKdNAS']))) : '';
    $NASAttribute	= isset($_POST['NASAttribute']) ? mysql_real_escape_string(strip_tags(trim($_POST['NASAttribute']))) : '';
    $ddns		= isset($_POST['ddns']) ? mysql_real_escape_string(strip_tags(trim($_POST['ddns']))) : '';
    $ip_inet		= isset($_POST['ip_inet']) ? mysql_real_escape_string(strip_tags(trim($_POST['ip_inet']))) : '';
    $ip_blokir		= isset($_POST['ip_blokir']) ? mysql_real_escape_string(strip_tags(trim($_POST['ip_blokir']))) : '';
    $profile_grace		= isset($_POST['profile_grace']) ? mysql_real_escape_string(strip_tags(trim($_POST['profile_grace']))) : '';
    $profile_aktif		= isset($_POST['profile_aktif']) ? mysql_real_escape_string(strip_tags(trim($_POST['profile_aktif']))) : '';
    $tipe_koneksi		= isset($_POST['tipe_koneksi']) ? mysql_real_escape_string(strip_tags(trim($_POST['tipe_koneksi']))) : '';
    
    
    //data_login
    $username		= isset($_POST['username']) ? mysql_real_escape_string(strip_tags(trim($_POST['username']))) : '';
    $password		= isset($_POST['pass']) ? mysql_real_escape_string(strip_tags(trim($_POST['pass']))) : '';
    $repassword		= isset($_POST['repass']) ? mysql_real_escape_string(strip_tags(trim($_POST['repass']))) : '';

    //data_login
    $promosi_nama	= isset($_POST['promosi_nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_nama']))) : '';
    $promosi_alamat	= isset($_POST['promosi_alamat']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_alamat']))) : '';
    $promosi_norek	= isset($_POST['promosi_norek']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_norek']))) : '';
    
	$promosi_nominal	= isset($_POST['promosi_nominal']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_nominal']))) : '';
	$promosi_nobank	= isset($_POST['promosi_nobank']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_nobank']))) : '';
    $promosi_nama_rekening	= isset($_POST['promosi_nama_rekening']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_nama_rekening']))) : '';
    $promosi_remark	= isset($_POST['promosi_remark']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_remark']))) : '';
    $masa_start	= isset($_POST['masa_start']) ? mysql_real_escape_string(strip_tags(trim($_POST['masa_start']))) : '';
    $masa_end	= isset($_POST['masa_end']) ? mysql_real_escape_string(strip_tags(trim($_POST['masa_end']))) : '';
    $remark	= isset($_POST['remark']) ? mysql_real_escape_string(strip_tags(trim($_POST['remark']))) : '';
    

    if($cKode != "" AND $cNama != ""){
		
		
		//Input data ke RBS [Users]
		$conn_soft = Config::getInstanceSoft();

$sql_rbs_lastdata	= "SELECT TOP 1 [UserIndex] FROM [Users] ORDER BY [UserIndex] DESC;";
$query_rbs_lastdata = $conn_soft->prepare($sql_rbs_lastdata);
$query_rbs_lastdata->execute();
$row_rbs_lastdata	= $query_rbs_lastdata->fetch();

$UserIndex = $row_rbs_lastdata["UserIndex"] + 1;

$ip_address = ip2long($user_ip);
if (PHP_INT_SIZE == 8)
{
    if ($ip_address>0x7FFFFFFF)
    {
        $ip_address-=0x100000000;
    }
}

$sql_rbs_user = "SET IDENTITY_INSERT [dbo].[Users] ON
INSERT INTO [dbo].[Users] 
([UserIndex], [UserID], [Password], [PasswordDate], [PasswordSource], 
[GroupName], [UserService], [UserIP], [FilterName], [StartDate], 
[UserExpiryDate], [ManualExpirationDate], [SuspendDate], [UserActive], 
[AccountIndex], [UserTimeBank], [UserKBBank], [UserDollarBank], [UserBalance], 
[UserPaymentBalance], [TimeOnline], [CallBackNumber], [CallerID], [Lockout], 
[LockoutTime], [LockoutCount], [GracePeriodExpiration], [NASAttributes]) 
VALUES ('".$UserIndex."', '".$cUserID."', '".$cPassword."', NULL, '0',
		'".$cGroupRBS."', '0', '".$ip_address."', NULL, '".date("Y-m-d")."',
		'".date("Y-m-d")."', NULL, NULL, 'TRUE',
		'".$acc_type_rbs."', '0',
		'0', '0', '0', '0', '0', NULL, NULL, '0', NULL, NULL, '".date("Y-m-d")."', NULL);
SET IDENTITY_INSERT [dbo].[Users] OFF";
$query_rbs_user = $conn_soft->prepare($sql_rbs_user);

//echo $ip_address;

$query_rbs_user->execute();

				  
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
VALUES ('".$UserIndex."', '".$cNama."', '', '', '".$cNamaPers."', '".$cAlamat1."', '', '".$cKota."', '".$cDaerah."', '', '".$cKode."', '".$cNoHp1."', '".$cNoHp2."', 
'', '".$cEmail."', '".date("Y-m-d H:i:s.000")."', '".date("Y-m-d H:i:s.000")."',  '0', '0', '0', '0', '0', '0', '".date("Y-m-d H:i:s.000")."', NULL, '0', NULL, NULL, '0', NULL, 
NULL, NULL,NULL,NULL,NULL,'".$user_ip."', '".$cKode."', '','', '".$NASAttribute."', NULL, NULL, '0', '0', '0', NULL, '0', NULL, '0', '0', '0', '0', NULL, 
NULL, NULL, NULL, NULL);";
$query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);

$query_rbs_user_detail->execute();
				  
    //insert into tbCustomer
    $sql_insert_customer = "INSERT INTO `tbCustomer` (`idCustomer`, `cKode`, `cNama`,
    `cNamaPers`, `cAlamat1`, `cKota`, `cArea`, `cDaerah`, `ctelp`, `cContact`, `nterm`,
    `cEmail`, `cMailIntern`, `dTglLahir`,
    `cUserID`, `cNamaIbu`, `cNoHp1`, `cNoHp2`, `cPassword`,
    `cKdPaket`, `cIncludePPN`, `cExcludePPN`, `no_npwp`, `nama_npwp`,
    `alamat_npwp`, `cNoRekVirtual`, `cSales`, `cPaket`,
    `dTglMulai`, `dTglBerhenti`, `id_acc_justifikasi`, `cNonAktiv`,
    `ip_ap`, `ip_wl`, `cLati`, `cLongi`,
    `ip_bts`, `cMacAdd`, `bts`, `acc_type_rbs`,
    `user_ip`, `iuserIndex`, `cGroupRBS`, `cKdNAS`,
    `NASAttribute`, `ddns`, `tipe_koneksi`,
	`ip_inet`, `ip_blokir`, `profile_grace`, `profile_aktif`,
	`id_cabang`, `paket_voip`, `paket_data`, `paket_video`, `gx_saldo`, `gx_tipe`, `gx_bahasa`,
	`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
	VALUES (NULL, '".$cKode."', '".$cNama."',
	'".$cNamaPers."', '".$cAlamat1."', '".$cKota."', '".$cArea."', '".$cDaerah."', '".$ctelp."', '".$cContact."', '".$nterm."',
	'".$cEmail."', '".$cMailIntern."',  '".date("Y-m-d", strtotime($dTglLahir))."',
	'".$cUserID."', '".$cNamaIbu."', '".$cNoHp1."', '".$cNoHp2."', '".$cPassword."',
	'".$cKdPaket."', '".$cIncludePPN."', '".$cExcludePPN."', '".$no_npwp."', '".$nama_npwp."',
	'".$alamat_npwp."', '".$cNoRekVirtual."', '".$cSales."', '".$cPaket."',
	'".$dTglMulai."', '".$dTglBerhenti."', '".$id_acc_justifikasi."', '".$cNonAktiv."',
	'".$ip_ap."', '".$ip_wl."', '".$cLati."', '".$cLongi."',
	'".$ip_bts."', '".$cMacAdd."', '".$bts."', '".$acc_type_rbs."',
	'".$user_ip."', '".$UserIndex."', '".$cGroupRBS."', '".$cKdNAS."',
	'".$NASAttribute."', '".$ddns."', '".$tipe_koneksi."', 
	'".$ip_inet."', '".$ip_blokir."', '".$profile_grace."', '".$profile_aktif."',
	'".$id_cabang."', '', '', '', '0', 'webgx', '".$gx_bahasa."',
	'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
        //echo $insert."<br>";
	
    //echo $sql_insert_customer;
    mysql_query($sql_insert_customer, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_customer);


	
	
    //sql insert data login
    $sql_insert_login = "INSERT INTO `gxLogin` (`id_user`, `customer_number`, `id_voip`,
        `id_vod`, `id_cabang`, `username`, `password`, `password_date`, `ip`, `mac`,
        `user_service`, `user_ip`, `filter_name`, `start_date`, `user_expiry_date`,
        `manual_expiration_date`, `suspend_date`, `user_active`, `account_index`,
        `user_time_bank`, `user_kb_bank`, `user_dollar_bank`, `user_balance`,
        `user_payment_balance`, `time_online`, `callback_number`, `group`, `id_group`,
        `caller_id`, `lockout`, `lockout_time`, `lockout_count`, `grace_period_expiration`,
        `nas_attributes`, `user_ip_lastvisit`, `lastvisit`, `level`)
        VALUES (NULL, '".$cKode."', '', '', '".$id_cabang."', '".$username."', MD5('".$password."'), NOW(),
        '".$_SERVER['REMOTE_ADDR']."', '', '0', '', '', NOW(), '0000-00-00 00:00:00', '0000-00-00 00:00:00',
        '0000-00-00 00:00:00', 'yes', '0', '0', '0', '0', '0', '0', '0', '', 'customer', '0', '0', '0',
        NOW(), '0', '0', '0', '".$_SERVER['REMOTE_ADDR']."', NOW(), '0');";
        //echo $insert."<br>";
	
    //echo $sql_insert_customer;
	mysql_query($sql_insert_login, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_login);
    
	if($cNoRekVirtual != "")
	{
		//UPDATE status va
		$sql_update_va = "UPDATE `gx_va` SET `status`='1' WHERE (`no_rek`='".$cNoRekVirtual."');";
		//echo $sql_insert_customer;
		mysql_query($sql_update_va, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_va);
	}
    
    //upload foto
    $target_dir_promosi = "../upload/promosi/";
    // Random number for both file, will be added after image name
    $RandomNumber 	= rand(0, 9999999999);
    
    $uploadOk = 1;
    $nama_file_formulir1     = str_replace(' ','-',strtolower($_FILES['formulir1']['name']));
    $ImageName_formulir1     = pathinfo($nama_file_formulir1, PATHINFO_FILENAME);
    $imageFileType_formulir1 = strtolower(pathinfo($_FILES['formulir1']['name'],PATHINFO_EXTENSION));
    $NewImageName_formulir1  = $ImageName_formulir1.'-'.$RandomNumber.'.'.$imageFileType_formulir1;
    $target_file_formulir1   = $target_dir_promosi . $NewImageName_formulir1;
    
    $nama_file_formulir2     = str_replace(' ','-',strtolower($_FILES['formulir2']['name']));
    $ImageName_formulir2     = pathinfo($nama_file_formulir2, PATHINFO_FILENAME);
    $imageFileType_formulir2 = strtolower(pathinfo($_FILES['formulir2']['name'],PATHINFO_EXTENSION));
    $NewImageName_formulir2  = $ImageName_formulir2.'-'.$RandomNumber.'.'.$imageFileType_formulir2;
    $target_file_formulir2   = $target_dir_promosi . $NewImageName_formulir2;
    
    // Check if image file is a actual image or fake image
    if(($_FILES["formulir1"]["tmp_name"] !="") OR ($_FILES["formulir2"]["tmp_name"] !="")) {
	$check = getimagesize($_FILES["formulir1"]["tmp_name"]);
	if($check !== false) {
	   // echo "File is an image - " . $check["mime"] . ".";
	    $uploadOk = 1;
	} else {
	   // echo "File is not an image.";
	    $uploadOk = 0;
	}
    }else{
	$uploadOk = 0;
    }
    // Check if file already exists
    if ((file_exists($target_file_formulir1)) OR (file_exists($target_file_formulir2))) {
	//echo "Sorry, file already exists.";
	$uploadOk = 0;
    }
    // Check file size
    if (($_FILES["formulir1"]["size"] > 1000000) OR ($_FILES["formulir2"]["size"] > 1000000)){
	//echo "Sorry, your file is too large.";
	$uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType_formulir1 != "jpg" && $imageFileType_formulir1 != "png" && $imageFileType_formulir1 != "jpeg"
    && $imageFileType_formulir1 != "gif" ) {
	//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
	//echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
	if (move_uploaded_file($_FILES["formulir1"]["tmp_name"], $target_file_formulir1)) {
	    //echo "The file ". basename( $_FILES["ImageFile"]["name"]). " has been uploaded.";
	    move_uploaded_file($_FILES["formulir2"]["tmp_name"], $target_file_formulir2);
	    
	    //sql insert data duta promosi
	    $sql_insert_promosi = "INSERT INTO `gx_duta_promosi` (`id_dutapromosi`, `kode_customer`,
	    `nama`, `alamat`, `no_rek`, `formulir1`, `formulir2`, `formulir3`, `formulir4`, `formulir5`,
		`nama_bank`, `nama_rekening`, `nominal`, `masa_start`, `masa_end`, `remark`,
	    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	    VALUES (NULL, '".$cKode."', '".$promosi_nama."', '".$promosi_alamat."', '".$promosi_norek."',
	    '".$NewImageName_formulir1."', '".$NewImageName_formulir2."', NULL, NULL, NULL,
		'".$promosi_nobank."', '".$promosi_nama_rekening."', '".$promosi_nominal."', '".$masa_start."', '".$masa_end."', '".$promosi_remark."',
	    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
		//echo $insert."<br>";
		
	    //echo $sql_insert_customer;
	    mysql_query($sql_insert_promosi, $conn) or die (mysql_error());
	    //log
	    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_promosi);
	    
	} else {
	    echo "Sorry, there was an error uploading your file.";
	}
    }
    
    
    
    //upload foto
    $target_dir = "../upload/customer/";
    // Random number for both file, will be added after image name
    $RandomNumber 	= rand(0, 9999999999);
    
    $uploadOk = 1;
    $nama_file_card     = str_replace(' ','-',strtolower($_FILES['image_card']['name']));
    $ImageName_card	= pathinfo($nama_file_card, PATHINFO_FILENAME);
    $imageFileType_card = strtolower(pathinfo($_FILES['image_card']['name'],PATHINFO_EXTENSION));
    //$target_file 	= $target_dir . basename($_FILES["ImageFile"]["name"]);
    $NewImageName_card 	= $ImageName_card.'-'.$RandomNumber.'.'.$imageFileType_card;
    $target_file_card 	= $target_dir . $NewImageName_card;
    
    $nama_file_akta     = str_replace(' ','-',strtolower($_FILES['image_akta']['name']));
    $ImageName_akta	= pathinfo($nama_file_akta, PATHINFO_FILENAME);
    $imageFileType_akta = strtolower(pathinfo($_FILES['image_akta']['name'],PATHINFO_EXTENSION));
    //$target_file = $target_dir . basename($_FILES["ImageFile"]["name"]);
    $NewImageName_akta  = $ImageName_akta.'-'.$RandomNumber.'.'.$imageFileType_akta;
    $target_file_akta   = $target_dir . $NewImageName_akta;
    
    $nama_file_npwp     = str_replace(' ','-',strtolower($_FILES['image_npwp']['name']));
    $ImageName_npwp	= pathinfo($nama_file_npwp, PATHINFO_FILENAME);
    $imageFileType_npwp = strtolower(pathinfo($_FILES['image_npwp']['name'],PATHINFO_EXTENSION));
    //$target_file = $target_dir . basename($_FILES["ImageFile"]["name"]);
    $NewImageName_npwp  = $ImageName_npwp.'-'.$RandomNumber.'.'.$imageFileType_npwp;
    $target_file_npwp   = $target_dir . $NewImageName_npwp;
    
    $nama_file_tdp     = str_replace(' ','-',strtolower($_FILES['image_tdp']['name']));
    $ImageName_tdp	= pathinfo($nama_file_tdp, PATHINFO_FILENAME);
    $imageFileType_tdp = strtolower(pathinfo($_FILES['image_tdp']['name'],PATHINFO_EXTENSION));
    //$target_file = $target_dir . basename($_FILES["ImageFile"]["name"]);
    $NewImageName_tdp  = $ImageName_tdp.'-'.$RandomNumber.'.'.$imageFileType_tdp;
    $target_file_tdp   = $target_dir . $NewImageName_tdp;
    
    
    $nama_file_lain     = str_replace(' ','-',strtolower($_FILES['image_lain']['name']));
    $ImageName_lain	= pathinfo($nama_file_lain, PATHINFO_FILENAME);
    $imageFileType_lain = strtolower(pathinfo($_FILES['image_lain']['name'],PATHINFO_EXTENSION));
    //$target_file = $target_dir . basename($_FILES["ImageFile"]["name"]);
    $NewImageName_lain  = $ImageName_lain.'-'.$RandomNumber.'.'.$imageFileType_lain;
    $target_file_lain   = $target_dir . $NewImageName_lain;
    
    // Check if image file is a actual image or fake image
    if(($_FILES["image_card"]["tmp_name"] !="") OR ($_FILES["image_akta"]["tmp_name"] !="")
       OR ($_FILES["image_npwp"]["tmp_name"] !="") OR ($_FILES["image_tdp"]["tmp_name"] !="")
       OR ($_FILES["image_lain"]["tmp_name"] !="")) {
	$check = getimagesize($_FILES["image_card"]["tmp_name"]);
	if($check !== false) {
	    //echo "File is an image - " . $check["mime"] . ".";
	    $uploadOk = 1;
	} else {
	    //echo "File is not an image.";
	    $uploadOk = 0;
	}
    }else{
	$uploadOk = 0;
    }
    // Check if file already exists
    if ((file_exists($target_file_card)) OR (file_exists($target_file_akta))
	OR (file_exists($target_file_tdp)) OR (file_exists($target_file_npwp))
	OR (file_exists($target_file_lain))) {
	//echo "Sorry, file already exists.";
	$uploadOk = 0;
    }
    // Check file size
    if (($_FILES["image_card"]["size"] > 1000000) OR ($_FILES["image_npwp"]["size"] > 1000000)
	OR ($_FILES["image_lain"]["size"] > 1000000) OR ($_FILES["image_tdp"]["size"] > 1000000)
	OR ($_FILES["image_akta"]["size"] > 1000000)){
	//echo "Sorry, your file is too large.";
	$uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType_card != "jpg" && $imageFileType_card != "png" && $imageFileType_card != "jpeg"
    && $imageFileType_card != "gif" ) {
	//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
	//echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
	if (move_uploaded_file($_FILES["image_card"]["tmp_name"], $target_file_card)) {
	    //echo "The file ". basename( $_FILES["ImageFile"]["name"]). " has been uploaded.";
	    if($_FILES["image_akta"]["tmp_name"] != "") { move_uploaded_file($_FILES["image_akta"]["tmp_name"], $target_file_akta); }
	    if($_FILES["image_npwp"]["tmp_name"] != "") { move_uploaded_file($_FILES["image_npwp"]["tmp_name"], $target_file_npwp); }
	    if($_FILES["image_tdp"]["tmp_name"] != "") { move_uploaded_file($_FILES["image_tdp"]["tmp_name"], $target_file_tdp); }
	    if($_FILES["image_lain"]["tmp_name"] != "") { move_uploaded_file($_FILES["image_lain"]["tmp_name"], $target_file_lain); }
	    
	    $sql_insert_foto = "INSERT INTO `software`.`gx_file_customer` (`id_file`, `id_customer`, `id_card`,
	    `akta`, `tdp`, `npwp`, `lain_lain`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
			VALUES (NULL, '".$cKode."',  '".$NewImageName_card."', '".$NewImageName_akta."',
			'".$NewImageName_tdp."', '".$NewImageName_npwp."', '".$NewImageName_lain."',
			'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
	    //echo $sql_insert_foto;
	    mysql_query($sql_insert_foto, $conn) or die (mysql_error());
	    
	    //log
	    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_foto);
	} else {
	    echo "Sorry, there was an error uploading your file.";
	}
    }

 
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master/customer.php';
	</script>";
    }else{
	echo "<script language='JavaScript'>
	    alert('Kode tidak boleh kosong.');
	    window.history.go(-1);
	</script>";
    }
}elseif(isset($_POST["update"]))
{
    $idCustomer       	= isset($_POST['idCustomer']) ? mysql_real_escape_string(strip_tags(trim($_POST['idCustomer']))) : '';
    $cKode       	= isset($_POST['cKode']) ? mysql_real_escape_string(strip_tags(trim($_POST['cKode']))) : '';
    $cNama       	= isset($_POST['cNama']) ? mysql_real_escape_string(strip_tags(trim($_POST['cNama']))) : '';
    $cNamaPers		= isset($_POST['cNamaPers']) ? mysql_real_escape_string(strip_tags(trim($_POST['cNamaPers']))) : '';
    $cAlamat1   	= isset($_POST['cAlamat1']) ? mysql_real_escape_string(strip_tags(trim($_POST['cAlamat1']))) : '';
    $cKota		= isset($_POST['cKota']) ? mysql_real_escape_string(strip_tags(trim($_POST['cKota']))) : '';
    $cArea		= isset($_POST['cArea']) ? mysql_real_escape_string(strip_tags(trim($_POST['cArea']))) : '';
    $cDaerah		= isset($_POST['cDaerah']) ? mysql_real_escape_string(strip_tags(trim($_POST['cDaerah']))) : '';
    $ctelp		= isset($_POST['ctelp']) ? mysql_real_escape_string(strip_tags(trim($_POST['ctelp']))) : '';
    $cContact		= isset($_POST['cContact']) ? mysql_real_escape_string(strip_tags(trim($_POST['cContact']))) : '';
    $nterm		= isset($_POST['nterm']) ? mysql_real_escape_string(strip_tags(trim($_POST['nterm']))) : '';
    $cKet		= isset($_POST['cKet']) ? mysql_real_escape_string(strip_tags(trim($_POST['cKet']))) : '';
    $cEmail		= isset($_POST['cEmail']) ? mysql_real_escape_string(strip_tags(trim($_POST['cEmail']))) : '';
    $cMailIntern 	= isset($_POST['cMailIntern']) ? mysql_real_escape_string(strip_tags(trim($_POST['cMailIntern']))) : '';
    $cUserID	 	= isset($_POST['cUserID']) ? mysql_real_escape_string(strip_tags(trim($_POST['cUserID']))) : '';
    $cNamaIbu	 	= isset($_POST['cNamaIbu']) ? mysql_real_escape_string(strip_tags(trim($_POST['cNamaIbu']))) : '';
    $cNoHp1	 	= isset($_POST['cNoHp1']) ? mysql_real_escape_string(strip_tags(trim($_POST['cNoHp1']))) : '';
    $cNoHp2		= isset($_POST['cNoHp2']) ? mysql_real_escape_string(strip_tags(trim($_POST['cNoHp2']))) : '';
    $cPassword		= isset($_POST['cPassword']) ? mysql_real_escape_string(strip_tags(trim($_POST['cPassword']))) : '';
    $cKdPaket		= isset($_POST['cKdPaket']) ? mysql_real_escape_string(strip_tags(trim($_POST['cKdPaket']))) : '';
    $cIncludePPN	= isset($_POST['cIncludePPN']) ? mysql_real_escape_string(strip_tags(trim($_POST['cIncludePPN']))) : '0';
    $cExcludePPN	= isset($_POST['cExcludePPN']) ? mysql_real_escape_string(strip_tags(trim($_POST['cExcludePPN']))) : '0';
    $no_npwp		= isset($_POST['no_npwp']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_npwp']))) : '';
    $nama_npwp		= isset($_POST['nama_npwp']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_npwp']))) : '';
    $alamat_npwp	= isset($_POST['alamat_npwp']) ? mysql_real_escape_string(strip_tags(trim($_POST['alamat_npwp']))) : '';
    $cNoRekVirtual	= isset($_POST['cNoRekVirtual']) ? mysql_real_escape_string(strip_tags(trim($_POST['cNoRekVirtual']))) : '';
    $cSales		= isset($_POST['cSales']) ? mysql_real_escape_string(strip_tags(trim($_POST['cSales']))) : '';
    $cPaket		= isset($_POST['cPaket']) ? mysql_real_escape_string(strip_tags(trim($_POST['cPaket']))) : '';
    $dTglMulai		= isset($_POST['dTglMulai']) ? mysql_real_escape_string(strip_tags(trim($_POST['dTglMulai']))) : '';
    $dTglBerhenti	= isset($_POST['dTglBerhenti']) ? mysql_real_escape_string(strip_tags(trim($_POST['dTglBerhenti']))) : '';
    $id_acc_justifikasi	= isset($_POST['id_acc_justifikasi']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_acc_justifikasi']))) : '';
    $cNonAktiv		= isset($_POST['cNonAktiv']) ? mysql_real_escape_string(strip_tags(trim($_POST['cNonAktiv']))) : '';
    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_cabang']))) : '';
    $dTglLahir		= isset($_POST['dTglLahir']) ? mysql_real_escape_string(strip_tags(trim($_POST['dTglLahir']))) : '';
    $gx_bahasa		= isset($_POST['gx_bahasa']) ? mysql_real_escape_string(strip_tags(trim($_POST['gx_bahasa']))) : '';
	
    //data internet
    $cLongi		= isset($_POST['cLongi']) ? mysql_real_escape_string(strip_tags(trim($_POST['cLongi']))) : '';
    $cLati		= isset($_POST['cLati']) ? mysql_real_escape_string(strip_tags(trim($_POST['cLati']))) : '';
    $ip_ap		= isset($_POST['ip_ap']) ? mysql_real_escape_string(strip_tags(trim($_POST['ip_ap']))) : '';
    $ip_wl		= isset($_POST['ip_wl']) ? mysql_real_escape_string(strip_tags(trim($_POST['ip_wl']))) : '';
    $ip_bts		= isset($_POST['ip_bts']) ? mysql_real_escape_string(strip_tags(trim($_POST['ip_bts']))) : '';
    $cMacAdd		= isset($_POST['cMacAdd']) ? mysql_real_escape_string(strip_tags(trim($_POST['cMacAdd']))) : '';
    $bts		= isset($_POST['bts']) ? mysql_real_escape_string(strip_tags(trim($_POST['bts']))) : '';
    $acc_type_rbs	= isset($_POST['acc_type_rbs']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_type_rbs']))) : '';
    $user_ip		= isset($_POST['user_ip']) ? mysql_real_escape_string(strip_tags(trim($_POST['user_ip']))) : '';
    $iuserIndex		= isset($_POST['iuserIndex']) ? mysql_real_escape_string(strip_tags(trim($_POST['iuserIndex']))) : '';
    $cGroupRBS		= isset($_POST['cGroupRBS']) ? mysql_real_escape_string(strip_tags(trim($_POST['cGroupRBS']))) : '';
    $cKdNAS		= isset($_POST['cKdNAS']) ? mysql_real_escape_string(strip_tags(trim($_POST['cKdNAS']))) : '';
    $NASAttribute	= isset($_POST['NASAttribute']) ? mysql_real_escape_string(strip_tags(trim($_POST['NASAttribute']))) : '';
    $ddns		= isset($_POST['ddns']) ? mysql_real_escape_string(strip_tags(trim($_POST['ddns']))) : '';
    $ip_inet		= isset($_POST['ip_inet']) ? mysql_real_escape_string(strip_tags(trim($_POST['ip_inet']))) : '';
    $ip_blokir		= isset($_POST['ip_blokir']) ? mysql_real_escape_string(strip_tags(trim($_POST['ip_blokir']))) : '';
    $profile_grace		= isset($_POST['profile_grace']) ? mysql_real_escape_string(strip_tags(trim($_POST['profile_grace']))) : '';
    $profile_aktif		= isset($_POST['profile_aktif']) ? mysql_real_escape_string(strip_tags(trim($_POST['profile_aktif']))) : '';
    $tipe_koneksi		= isset($_POST['tipe_koneksi']) ? mysql_real_escape_string(strip_tags(trim($_POST['tipe_koneksi']))) : '';
    
    
    //data_login
    $username		= isset($_POST['username']) ? mysql_real_escape_string(strip_tags(trim($_POST['username']))) : '';
    $password		= isset($_POST['pass']) ? mysql_real_escape_string(strip_tags(trim($_POST['pass']))) : '';
    $repassword		= isset($_POST['repass']) ? mysql_real_escape_string(strip_tags(trim($_POST['repass']))) : '';

    $idFoto		= isset($_POST['idFoto']) ? mysql_real_escape_string(strip_tags(trim($_POST['idFoto']))) : '';
    $id_file		= isset($_POST['id_file']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_file']))) : '';
    
    //data_promosi
    $promosi_nama	= isset($_POST['promosi_nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_nama']))) : '';
    $promosi_alamat	= isset($_POST['promosi_alamat']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_alamat']))) : '';
    $promosi_norek	= isset($_POST['promosi_norek']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_norek']))) : '';
    $id_dutapromosi	= isset($_POST['id_dutapromosi']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_dutapromosi']))) : '';
    
	$promosi_nominal	= isset($_POST['promosi_nominal']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_nominal']))) : '';
	$promosi_nobank	= isset($_POST['promosi_nobank']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_nobank']))) : '';
    $promosi_nama_rekening	= isset($_POST['promosi_nama_rekening']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_nama_rekening']))) : '';
    $promosi_remark	= isset($_POST['promosi_remark']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_remark']))) : '';
    $masa_start	= isset($_POST['masa_start']) ? mysql_real_escape_string(strip_tags(trim($_POST['masa_start']))) : '';
    $masa_end	= isset($_POST['masa_end']) ? mysql_real_escape_string(strip_tags(trim($_POST['masa_end']))) : '';
	$remark		= isset($_POST['remark']) ? mysql_real_escape_string(strip_tags(trim($_POST['remark']))) : '';
    
	
    if($idCustomer != "" AND $cKode != ""){
    //Update into tbCustomer
    $sql_update_customer = "UPDATE `tbCustomer` SET `cNama` = '".$cNama."',
    `cNamaPers` = '".$cNamaPers."', `cAlamat1` = '".$cAlamat1."', `cKota` = '".$cKota."', `cArea` = '".$cArea."',
    `cDaerah` = '".$cDaerah."', `ctelp` = '".$ctelp."', `cContact` = '".$cContact."', `nterm` = '".$nterm."',
    `cEmail` = '".$cEmail."', `cMailIntern` = '".$cMailIntern."', `dTglLahir` = '".date("Y-m-d", strtotime($dTglLahir))."',
    `cUserID` = '".$cUserID."', `cNamaIbu` = '".$cNamaIbu."', `cNoHp1` = '".$cNoHp1."', `cNoHp2` = '".$cNoHp2."',
    `cPassword` = '".$cPassword."', `cKdPaket` = '".$cKdPaket."', `cIncludePPN` = '".$cIncludePPN."',
    `cExcludePPN` = '".$cExcludePPN."', `no_npwp` = '".$no_npwp."', `nama_npwp` = '".$nama_npwp."',
    `alamat_npwp` = '".$alamat_npwp."', `cNoRekVirtual` = '".$cNoRekVirtual."', `cSales` = '".$cSales."', `cPaket` = '".$cPaket."',
    `dTglMulai` = '".$dTglMulai."', `dTglBerhenti` = '".$dTglBerhenti."', `id_acc_justifikasi` = '".$id_acc_justifikasi."',
    `cNonAktiv` = '".$cNonAktiv."', 
    `ip_ap` = '".$ip_ap."', `ip_wl` = '".$ip_wl."', `cLati` = '".$cLati."', `cLongi` = '".$cLongi."',
    `ip_bts` = '".$ip_bts."', `cMacAdd` = '".$cMacAdd."', `bts` = '".$bts."', `acc_type_rbs` = '".$acc_type_rbs."',
    `user_ip` = '".$user_ip."', `iuserIndex` = '".$iuserIndex."', `cGroupRBS` = '".$cGroupRBS."', `cKdNAS` = '".$cKdNAS."',
    `NASAttribute` = '".$NASAttribute."', `ddns` = '".$ddns."',
	`ip_inet` = '".$ip_inet."', `ip_blokir` = '".$ip_blokir."',  `tipe_koneksi` = '".$tipe_koneksi."',
	`profile_grace` = '".$profile_grace."', `profile_aktif` = '".$profile_aktif."',
	`gx_bahasa` = '".$gx_bahasa."', `id_cabang` = '".$id_cabang."',
		    `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
		    WHERE `idCustomer` = '".$idCustomer."';";
    //echo $sql_update_customer;
    mysql_query($sql_update_customer, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_customer);
    
	if($username !="" AND $password != "" AND $cKode != "")
	{
		//update data login
		$sql_update_login = "UPDATE `software`.`gxLogin` SET  `username`='".$username."',
		`password`= MD5('".$password."'), `password_date`=NOW()
		WHERE `customer_number`='".$cKode."';";
		//echo $insert."<br>";
	
		//echo $sql_insert_customer;
		mysql_query($sql_update_login, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_login);
	}
	
	if($cKode !="" AND $id_dutapromosi != "")
	{
    //update data promosi
    $sql_update_promosi = "UPDATE `software`.`gx_duta_promosi` SET `kode_customer`='".$cKode."', `nama`='".$promosi_nama."',
	`alamat`='".$promosi_alamat."', `nama_bank`='".$promosi_nobank."', `nama_rekening`='".$promosi_nama_rekening."', `nominal`='".$promosi_nominal."',
	`no_rek`='".$promosi_norek."', `masa_start`='".$masa_start."', `masa_end`='".$masa_end."', `remark`='".$remark."',
	`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
	WHERE (`id_dutapromosi`='".$id_dutapromosi."');";
    //echo $insert."<br>";

    //echo $sql_insert_customer;
    mysql_query($sql_update_promosi, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_promosi);
    
	}
    /*
    //upload foto
    $target_dir = "../upload/customer/";
    // Random number for both file, will be added after image name
    $RandomNumber 	= rand(0, 9999999999);
    
    $uploadOk = 1;
    $nama_file_card     = str_replace(' ','-',strtolower($_FILES['image_card']['name']));
    $ImageName_card	= pathinfo($nama_file_card, PATHINFO_FILENAME);
    $imageFileType_card = strtolower(pathinfo($_FILES['image_card']['name'],PATHINFO_EXTENSION));
    //$target_file 	= $target_dir . basename($_FILES["ImageFile"]["name"]);
    $NewImageName_card 	= $ImageName_card.'-'.$RandomNumber.'.'.$imageFileType_card;
    $target_file_card 	= $target_dir . $NewImageName_card;
    
    $nama_file_akta     = str_replace(' ','-',strtolower($_FILES['image_akta']['name']));
    $ImageName_akta	= pathinfo($nama_file_akta, PATHINFO_FILENAME);
    $imageFileType_akta = strtolower(pathinfo($_FILES['image_akta']['name'],PATHINFO_EXTENSION));
    //$target_file = $target_dir . basename($_FILES["ImageFile"]["name"]);
    $NewImageName_akta  = $ImageName_akta.'-'.$RandomNumber.'.'.$imageFileType_akta;
    $target_file_akta   = $target_dir . $NewImageName_akta;
    
    $nama_file_npwp     = str_replace(' ','-',strtolower($_FILES['image_npwp']['name']));
    $ImageName_npwp	= pathinfo($nama_file_npwp, PATHINFO_FILENAME);
    $imageFileType_npwp = strtolower(pathinfo($_FILES['image_npwp']['name'],PATHINFO_EXTENSION));
    //$target_file = $target_dir . basename($_FILES["ImageFile"]["name"]);
    $NewImageName_npwp  = $ImageName_npwp.'-'.$RandomNumber.'.'.$imageFileType_npwp;
    $target_file_npwp   = $target_dir . $NewImageName_npwp;
    
    $nama_file_tdp     = str_replace(' ','-',strtolower($_FILES['image_tdp']['name']));
    $ImageName_tdp	= pathinfo($nama_file_tdp, PATHINFO_FILENAME);
    $imageFileType_tdp = strtolower(pathinfo($_FILES['image_tdp']['name'],PATHINFO_EXTENSION));
    //$target_file = $target_dir . basename($_FILES["ImageFile"]["name"]);
    $NewImageName_tdp  = $ImageName_tdp.'-'.$RandomNumber.'.'.$imageFileType_tdp;
    $target_file_tdp   = $target_dir . $NewImageName_tdp;
    
    
    $nama_file_lain     = str_replace(' ','-',strtolower($_FILES['image_lain']['name']));
    $ImageName_lain	= pathinfo($nama_file_lain, PATHINFO_FILENAME);
    $imageFileType_lain = strtolower(pathinfo($_FILES['image_lain']['name'],PATHINFO_EXTENSION));
    //$target_file = $target_dir . basename($_FILES["ImageFile"]["name"]);
    $NewImageName_lain  = $ImageName_lain.'-'.$RandomNumber.'.'.$imageFileType_lain;
    $target_file_lain   = $target_dir . $NewImageName_lain;
    
    // Check if image file is a actual image or fake image
    if(($_FILES["image_card"]["tmp_name"] !="") OR ($_FILES["image_akta"]["tmp_name"] !="")
       OR ($_FILES["image_npwp"]["tmp_name"] !="") OR ($_FILES["image_tdp"]["tmp_name"] !="")
       OR ($_FILES["image_lain"]["tmp_name"] !="")) {
	$check = getimagesize($_FILES["image_card"]["tmp_name"]);
	if($check !== false) {
	    echo "File is an image - " . $check["mime"] . ".";
	    $uploadOk = 1;
	} else {
	    echo "File is not an image.";
	    $uploadOk = 0;
	}
    }else{
	$uploadOk = 0;
    }
    // Check if file already exists
    if ((file_exists($target_file_card)) OR (file_exists($target_file_akta))
	OR (file_exists($target_file_tdp)) OR (file_exists($target_file_npwp))
	OR (file_exists($target_file_lain))) {
	echo "Sorry, file already exists.";
	$uploadOk = 0;
    }
    // Check file size
    if (($_FILES["image_card"]["size"] > 1000000) OR ($_FILES["image_npwp"]["size"] > 1000000)
	OR ($_FILES["image_lain"]["size"] > 1000000) OR ($_FILES["image_tdp"]["size"] > 1000000)
	OR ($_FILES["image_akta"]["size"] > 1000000)){
	echo "Sorry, your file is too large.";
	$uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType_card != "jpg" && $imageFileType_card != "png" && $imageFileType_card != "jpeg"
    && $imageFileType_card != "gif" ) {
	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
	if (move_uploaded_file($_FILES["image_card"]["tmp_name"], $target_file_card)) {
	    //echo "The file ". basename( $_FILES["ImageFile"]["name"]). " has been uploaded.";
	    move_uploaded_file($_FILES["image_akta"]["tmp_name"], $target_file_akta);
	    move_uploaded_file($_FILES["image_npwp"]["tmp_name"], $target_file_npwp);
	    move_uploaded_file($_FILES["image_tdp"]["tmp_name"], $target_file_tdp);
	    move_uploaded_file($_FILES["image_lain"]["tmp_name"], $target_file_lain);
	    
	    if(($_FILES["image_card"]["tmp_name"] !="") AND ($_FILES["image_akta"]["tmp_name"] !="")
		AND ($_FILES["image_npwp"]["tmp_name"] !="") AND ($_FILES["image_tdp"]["tmp_name"] !="")
		AND ($_FILES["image_lain"]["tmp_name"] !="")) {
		
	    $sql_insert_foto = "INSERT INTO `software`.`gx_file_customer` (`id_file`, `id_customer`, `id_card`,
	    `akta`, `tdp`, `npwp`, `lain_lain`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
			VALUES (NULL, '".$cKode."',  '".$NewImageName_card."', '".$NewImageName_akta."',
			'".$NewImageName_tdp."', '".$NewImageName_npwp."', '".$NewImageName_lain."',
			'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
	    //echo $sql_insert_foto;
	    mysql_query($sql_insert_foto, $conn) or die (mysql_error());
	    
	    //log
	    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_foto);
	    }
	} else {
	    echo "Sorry, there was an error uploading your file.";
	}
    }*/
    
   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."master/customer.php';
	</script>";
    }
	else
	{
	
	echo "<script language='JavaScript'>
	    alert('Kode tidak boleh kosong.');
	    window.history.go(-1);
	</script>";
	
    }
}

if(isset($_GET["id"]))
{
    $cKode		= isset($_GET['id']) ? strip_tags(trim($_GET['id'])) : '';
    $query_customer 	= "SELECT * FROM `tbCustomer` WHERE `cKode` LIKE '%".$cKode."%' AND `level` = '0' LIMIT 0,1;";
    $sql_customer	= mysql_query($query_customer, $conn);
    $row_customer	= mysql_fetch_array($sql_customer);
    
    
    $query_login 	= "SELECT `username` FROM `gxLogin` WHERE `customer_number`='".$cKode."' AND `level` = '0' LIMIT 0,1;";
    $sql_login		= mysql_query($query_login, $conn);
    $row_login		= mysql_fetch_array($sql_login);
    
    $query_promosi 	= "SELECT * FROM `gx_duta_promosi` WHERE `kode_customer`='".$cKode."' AND `level` = '0' LIMIT 0,1;";
    $sql_promosi	= mysql_query($query_promosi, $conn);
    $row_promosi	= mysql_fetch_array($sql_promosi);
    
    $query_foto	= "SELECT * FROM `gxFoto_Profile` WHERE `cKode`='".$cKode."' AND `level` = '0' LIMIT 0,1;";
    $sql_foto	= mysql_query($query_foto, $conn);
    $row_foto	= mysql_fetch_array($sql_foto);
    
    $query_foto2= "SELECT * FROM `gx_file_customer` WHERE `id_customer`='".$cKode."' AND `level` = '0' ORDER BY `date_add` DESC LIMIT 0,1;";
    $sql_foto2	= mysql_query($query_foto2, $conn);
    $row_foto2	= mysql_fetch_array($sql_foto2);
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update form customer id=$cKode");
}else{
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "create new form customer");
}


//<!--<input type="text" readonly="" class="form-control" name="cNoRekVirtual" value="'.(isset($_GET['id']) ? $row_customer["cNoRekVirtual"] : "").'"
//						onclick="return valideopenerform(\'data_va.php?r=customer&f=custpaket\',\'custva\');">-->

$selected_kontrak	= isset($_GET["id"]) ? $row_customer["gx_kontrak"] : "";
    
    $content ='<section class="content-header">
                    <h1>
                        Master Customer
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-12"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Form Customer</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" name="customer" id="customer" role="form" method="post" enctype="multipart/form-data" autocomplete="off">
				    
                                    <div class="box-body">
                                        <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Data Customer</a></li>
                                    
				    <li><a href="#tab_2" data-toggle="tab">File</a></li>
                                    <li><a href="#tab_login" data-toggle="tab">Data Login</a></li>
				    <li><a href="#tab_inet" data-toggle="tab">Data Internet</a></li>
				    <li><a href="#tab_promosi" data-toggle="tab">Duta Promosi</a></li>
				    
				    
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<select class="form-control required"  name="id_cabang" id="id_cabang" style="width:200px;">
						    <option value="">Choose one</option>';
						    
						    $sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `level` = '0';", $conn);
						    
						    while($row_cabang = mysql_fetch_array($sql_cabang))
						    {
							$content .='<option value="'.$row_cabang["id_cabang"].'" '.((isset($_GET["id"]) && ($row_customer["id_cabang"] == $row_cabang["id_cabang"]) ) ? 'selected="selected"' :"") .'>'.$row_cabang["nama_cabang"].'</option>';
							
						    }
						    
$content .='						</select>
					    </div>
					    <div class="col-xs-3">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" id="cKode" name="cKode" value="'.(isset($_GET['id']) ? $row_customer["cKode"] : '').'" readonly="">
						<input type="hidden" name="idCustomer" value="'.(isset($_GET['id']) ? $row_customer["idCustomer"] : '').'" readonly="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" id="cNama" onkeyup="generatecKode();" required="" name="cNama" value="'.(isset($_GET['id']) ? $row_customer["cNama"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Perusahaan</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control"  name="cNamaPers" value="'.(isset($_GET['id']) ? $row_customer["cNamaPers"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-9">
						<textarea class="form-control" name="cAlamat1" cols="10" rows="6" style="resize:none;">'.(isset($_GET['id']) ? $row_customer["cAlamat1"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kelurahan</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="cArea" value="'.(isset($_GET['id']) ? $row_customer["cArea"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Kecamatan</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="cDaerah" value="'.(isset($_GET['id']) ? $row_customer["cDaerah"] : "").'">
					    </div>
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kota</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="cKota" value="'.(isset($_GET['id']) ? $row_customer["cKota"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Telpon</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="ctelp" value="'.(isset($_GET['id']) ? $row_customer["ctelp"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No HP 1</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="cNoHp1" value="'.(isset($_GET['id']) ? $row_customer["cNoHp1"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>No HP 2</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="cNoHp2" value="'.(isset($_GET['id']) ? $row_customer["cNoHp2"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Contact Person</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="cContact" value="'.(isset($_GET['id']) ? $row_customer["cContact"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tanggal Lahir</label>
					    </div>
					    <div class="col-xs-3">
						
						<input type="text" class="form-control" data-inputmask="\'alias\': \'dd-mm-yyyy\'" data-mask="" name="dTglLahir" value="'.(isset($_GET['id']) ? date("d-m-Y", strtotime($row_customer["dTglLahir"])) : "").'">
					    </div>
					    
                                        </div>
					</div>
					 <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Email Address</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" required="" name="cEmail" value="'.(isset($_GET['id']) ? $row_customer["cEmail"] : "").'">
					    </div>
                                        </div>
					</div>
					 <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Email Address Intern</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="cMailIntern" value="'.(isset($_GET['id']) ? $row_customer["cMailIntern"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>User ID</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="cUserID" value="'.(isset($_GET['id']) ? $row_customer["cUserID"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Password</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="cPassword" value="'.(isset($_GET['id']) ? $row_customer["cPassword"] : "").'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Paket</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" id="cKdPaket" name="cKdPaket" value="'.(isset($_GET['id']) ? $row_customer["cKdPaket"] : "").'"
						onclick="return valideopenerform(\'data_paket.php?r=customer&f=custpaket\',\'custpaket\');">
						
					    </div>
					    <div class="col-xs-3">
						<label>Grace</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="nterm" value="'.(isset($_GET['id']) ? $row_customer["nterm"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Paket</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control"  id="cPaket" name="cPaket" value="'.(isset($_GET['id']) ? $row_customer["cPaket"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tipe Kontrak</label>
					    </div>
					    <div class="col-xs-3">
						<input id="kontrak" type="radio" name="gx_kontrak" value="kontrak" '.(($selected_kontrak == "kontrak") ? ' checked=""' : "").' /> Kontrak
					    </div>
					    <div class="col-xs-3">
						<input id="kontrak" type="radio" name="gx_kontrak" value="nonkontrak" '.(($selected_kontrak == "nonkontrak") ? ' checked=""' : "").' /> Non Kontrak
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kontrak</label>
					    </div>
					    <div class="col-xs-3">
						
					    <input type="text" class="form-control" data-inputmask="\'alias\': \'dd-mm-yyyy\'" data-mask="" name="dTglMulai" value="'.(isset($_GET['id']) ? date("d-m-Y", strtotime($row_customer["dTglMulai"])) : "").'">
					    
						</div>
					    <div class="col-xs-1">
						<label>s/d</label>
					    </div>
					    <div class="col-xs-3">
					    <input type="text" class="form-control" data-inputmask="\'alias\': \'dd-mm-yyyy\'" data-mask="" name="dTglBerhenti" value="'.(isset($_GET['id']) ? date("d-m-Y", strtotime($row_customer["dTglBerhenti"])) : "").'">
					    
						</div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>PPN</label>
					    </div>
					    <div class="col-xs-9">
						<input type="checkbox" name="cIncludePPN" value="1" style="float:left;" '.((isset($_GET["id"]) && $row_customer["cIncludePPN"]== "1" ) ? 'checked=""' : "") .'>&nbsp;<label>Include PPN</label>&nbsp;
						<input type="checkbox" name="cExcludePPN" value="1" style="float:left;" '.((isset($_GET["id"]) && $row_customer["cExcludePPN"]== "1" ) ? 'checked=""' : "") .'>&nbsp;<label>Exclude PPN</label>&nbsp;
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tipe Koneksi</label>
					    </div>
					    <div class="col-xs-6">
						<select class="form-control" name="tipe_koneksi">
							<option value="wireless">Wifi</option>
							<option value="fo">FO</option>
                        </select>
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<h3>NPWP</h3>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No NPWP</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="no_npwp" value="'.(isset($_GET['id']) ? $row_customer["nama_npwp"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama NPWP</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="nama_npwp" value="'.(isset($_GET['id']) ? $row_customer["nama_npwp"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alamat NPWP</label>
					    </div>
					    <div class="col-xs-9">
						<textarea class="form-control" name="alamat_npwp" cols="10" rows="6" style="resize:none;">'.(isset($_GET['id']) ? $row_customer["alamat_npwp"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Ibu Kandung</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control"  name="cNamaIbu" value="'.(isset($_GET['id']) ? $row_customer["cNamaIbu"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Virtual Account</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="cNoRekVirtual" value="'.(isset($_GET['id']) ? $row_customer["cNoRekVirtual"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Marketing</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="cSales" value="'.(isset($_GET['id']) ? $row_customer["cSales"] : "").'"
						onclick="return valideopenerform(\'data_marketing.php?r=customer&f=custpaket\',\'custmarketing\');">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No ACC Justifikasi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="id_acc_justifikasi" value="'.(isset($_GET['id']) ? $row_customer["id_acc_justifikasi"] : "").'"
						onclick="return valideopenerform(\'data_acc_justifikasi.php?r=customer&f=custpaket\',\'custpaket\');">
						
					    </div>
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>Bahasa</label>
					    </div>
					    <div class="col-xs-3">
							<select class="form-control required"  name="gx_bahasa" id="gx_bahasa">
								<option value="id" '.((isset($_GET["id"]) && $row_customer["gx_bahasa"]== "id" ) ? 'selected=""' : "") .'>ID</option>
								<option value="en" '.((isset($_GET["id"]) && $row_customer["gx_bahasa"]== "en" ) ? 'selected=""' : "") .'>EN</option>
								
							</select>
						</div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>Status</label>
					    </div>
					    <div class="col-xs-3">
							<select class="form-control required"  name="cNonAktiv" id="cNonAktiv">
								<option value="0" '.((isset($_GET["id"]) && $row_customer["cNonAktiv"]== "0" ) ? 'selected=""' : "") .'>Aktif</option>
								<option value="1" '.((isset($_GET["id"]) && $row_customer["cNonAktiv"]== "1" ) ? 'selected=""' : "") .'>NonAktif</option>
								<option value="2" '.((isset($_GET["id"]) && $row_customer["cNonAktiv"]== "2" ) ? 'selected=""' : "") .'>Proses</option>
								<option value="3" '.((isset($_GET["id"]) && $row_customer["cNonAktiv"]== "3" ) ? 'selected=""' : "") .'>Grace</option>
								<option value="4" '.((isset($_GET["id"]) && $row_customer["cNonAktiv"]== "4" ) ? 'selected=""' : "") .'>Blokir</option>
							
							</select>
						</div>
                    </div>
					</div>
					</div><!-- /.tab-pane -->
					
				    <div class="tab-pane" id="tab_2">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>ID Card</label>
					    </div>
					    <div class="col-xs-4">
						<input type="hidden" name="id_file" value="'.(isset($_GET['id']) ? $row_foto2["id_file"] : "").'">
						<input type="file" name="image_card" id="image_card" onchange="readURL(this);" />
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['id']) ? '<a href="'.URL_ADMIN.'upload/customer/'.$row_foto2["id_card"].'" class="lightbox">view</a>' : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Akta Terakhir</label>
					    </div>
					    <div class="col-xs-4">
						<input type="hidden" name="akta" value="'.(isset($_GET['id']) ? $row_foto2["akta"] : "").'">
						<input type="file" name="image_akta" id="image_akta" onchange="readURL(this);" />
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['id']) ? '<a href="'.URL_ADMIN.'upload/customer/'.$row_foto2["akta"].'" class="lightbox">view</a>' : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>TDP</label>
					    </div>
					    <div class="col-xs-4">
						<input type="hidden" name="tdp" value="'.(isset($_GET['id']) ? $row_foto2["tdp"] : "").'">
						<input type="file" name="image_tdp" id="image_tdp" onchange="readURL(this);" />
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['id']) ? '<a href="'.URL_ADMIN.'upload/customer/'.$row_foto2["tdp"].'" class="lightbox">view</a>' : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>NPWP</label>
					    </div>
					    <div class="col-xs-4">
						<input type="hidden" name="npwp" value="'.(isset($_GET['id']) ? $row_foto2["npwp"] : "").'">
						<input type="file" name="image_npwp" id="image_npwp" onchange="readURL(this);" />
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['id']) ? '<a href="'.URL_ADMIN.'upload/customer/'.$row_foto2["npwp"].'" class="lightbox">view</a>' : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Lain lain</label>
					    </div>
					    <div class="col-xs-4">
						<input type="hidden" name="lain_lain" value="'.(isset($_GET['id']) ? $row_foto2["lain_lain"] : "").'">
						<input type="file" name="image_lain" id="image_lain" onchange="readURL(this);" />
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['id']) ? '<a href="'.URL_ADMIN.'upload/customer/'.$row_foto2["lain_lain"].'" class="lightbox">view</a>' : "").'
					    </div>
                                        </div>
					</div>
					<!--<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Photo</label>
					    </div>
					    <div class="col-xs-8">
						<input type="hidden" name="idFoto" value="'.(isset($_GET['id']) ? $row_foto["idFoto"] : "").'">
						<img id="preview" src="'.(isset($_GET['id']) ? URL_ADMIN.'img/customer/'.$row_foto["file_foto"] : "").'" alt="Preview Image" /><br>		
						<input type="file" name="ImageFile" id="ImageFile" onchange="readURL(this);" />
					    </div>
                                        </div>
					</div>-->
                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_login">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Username</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="username" value="'.(isset($_GET['id']) ? $row_login["username"] : "").'">
					    </div>
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Password</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" '.(isset($_GET['id']) ? "" : 'required=""').' name="pass" value="">
					    </div>
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Retype Password</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" '.(isset($_GET['id']) ? "" : 'required=""').' name="repass" value="">
					    </div>
                                        </div>
					</div>
                                    </div><!-- /.tab-pane -->
				    <div class="tab-pane" id="tab_inet">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Longitude</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="cLongi" value="'.(isset($_GET['id']) ? $row_customer["cLongi"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Latitude</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="cLati" value="'.(isset($_GET['id']) ? $row_customer["cLati"] : "").'">
					    </div>
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>IP AP</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="ip_ap" value="'.(isset($_GET['id']) ? $row_customer["ip_ap"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>IP WL</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="ip_wl" value="'.(isset($_GET['id']) ? $row_customer["ip_wl"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>IP BTS</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="ip_bts" value="'.(isset($_GET['id']) ? $row_customer["ip_bts"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Mac Address</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="cMacAdd" value="'.(isset($_GET['id']) ? $row_customer["cMacAdd"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>BTS</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="bts" value="'.(isset($_GET['id']) ? $row_customer["bts"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Acc Type RBS</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="acc_type_rbs" value="'.(isset($_GET['id']) ? $row_customer["acc_type_rbs"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>User IP</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="user_ip" value="'.(isset($_GET['id']) ? $row_customer["user_ip"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>User Index RBS</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="iuserIndex" value="'.(isset($_GET['id']) ? $row_customer["iuserIndex"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Group RBS</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="cGroupRBS" value="'.(isset($_GET['id']) ? $row_customer["cGroupRBS"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Kode NAS Attribute</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="cKdNAS" value="'.(isset($_GET['id']) ? $row_customer["cKdNAS"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>NAS Attribute</label>
					    </div>
					    <div class="col-xs-9">
						<textarea class="form-control" name="NASAttribute" cols="10" rows="6" style="resize:none;">'.(isset($_GET['id']) ? $row_customer["NASAttribute"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>DDNS</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="ddns" value="'.(isset($_GET['id']) ? $row_customer["ddns"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>IP Internet</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="ip_inet" value="'.(isset($_GET['id']) ? $row_customer["ip_inet"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>IP Blokir</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="ip_blokir" value="'.(isset($_GET['id']) ? $row_customer["ip_blokir"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Profile Grace</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control"  name="profile_grace" value="'.(isset($_GET['id']) ? $row_customer["profile_grace"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Profile Aktif</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control"  name="profile_aktif" value="'.(isset($_GET['id']) ? $row_customer["profile_aktif"] : "").'">
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.tab-pane -->
				    
				    <div class="tab-pane" id="tab_promosi">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-6">
						<input type="hidden" readonly="" name="id_dutapromosi" value="'.(isset($_GET['id']) ? $row_promosi["id_dutapromosi"] : "").'">
						<input type="text" class="form-control" name="promosi_nama" value="'.(isset($_GET['id']) ? $row_promosi["nama"] : "").'">
					    </div>
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-6">
						<textarea class="form-control" name="promosi_alamat" cols="10" rows="6" style="resize:none;">'.(isset($_GET['id']) ? $row_promosi["alamat"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Rekening</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="promosi_norek" value="'.(isset($_GET['id']) ? $row_promosi["no_rek"] : "").'">
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Bank</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="promosi_nobank" value="'.(isset($_GET['id']) ? $row_promosi["nama_bank"] : "").'">
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Rekening</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="promosi_nama_rekening" value="'.(isset($_GET['id']) ? $row_promosi["nama_rekening"] : "").'">
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nominal</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control"  maxlength="10" name="promosi_nominal" value="'.(isset($_GET['id']) ? $row_promosi["nominal"] : "").'">
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Masa Duta Promosi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control hasDatepicker" id="datepicker" name="masa_start" value="'.(isset($_GET['id']) ? date("Y-m-d", strtotime($row_promosi["masa_start"])) : "").'">
					    </div>
					    <div class="col-xs-1">
						<label>s/d</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control hasDatepicker" id="datepicker" name="masa_end" value="'.(isset($_GET['id']) ? date("Y-m-d", strtotime($row_promosi["masa_end"])) : date("Y-m-d", strtotime("+ 10 Years"))).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks</label>
					    </div>
					    <div class="col-xs-6">
						<textarea class="form-control" name="promosi_remark" cols="10" rows="6" style="resize:none;">'.(isset($_GET['id']) ? $row_promosi["remark"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Formulir 1</label>
					    </div>
					    <div class="col-xs-3">
						<input name="formulir1" class="form-control" type="file" id="formulir1"/>
						<input type="hidden" class="form-control" name="promosi_formulir1" value="'.(isset($_GET['id']) ? $row_promosi["formulir1"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Formulir 2</label>
					    </div>
					    <div class="col-xs-3">
						<input name="formulir2" class="form-control" type="file" id="formulir2"/>
						<input type="hidden" class="form-control" name="promosi_formulir2" value="'.(isset($_GET['id']) ? $row_promosi["formulir2"] : "").'">
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.tab-pane -->
                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';
//onclick="return valideopenerform(\'../administrasi/data_paket.php?r=myForm&f=customer\',\'cabang\');"
$plugins = '<script type="text/javascript">
function readURL(input) {
    if (input.files && input.files[0]) {
	var reader = new FileReader();

	reader.onload = function (e) {
	    $(\'#preview\')
		.attr(\'src\', e.target.result)
		.width(250);
	};

	reader.readAsDataURL(input.files[0]);
    }
}
function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}


function generatecKode() {
    
    var cport = document.getElementById("id_cabang").value;
    var cnama = document.getElementById("cNama").value;
    
    $.ajax({url: "sum_cust.php?k=" +cport + "&n=" + cnama.charAt(0), success: function(result){
        
	document.getElementById("cKode").value = result;
	
    }});
    
    
}

</script>
<!-- Colorbox -->
<link media="screen" rel="stylesheet" type="text/css" href="'.URL.'js/colorbox/example1/colorbox.css" />
  <script src="'.URL.'js/colorbox/jquery.colorbox.js"></script>
  <script type="text/javascript">
   $(document).ready(function(){
    //Examples of how to assign the ColorBox event to elements
    $(".lightbox").colorbox({width:"75%", height:"75%"});
    
   });

  </script>
  
<!-- datepicker -->
<script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

<script>
    $(function() {
	$("[id=datepicker]").datepicker({format: "dd-mm-yyyy"});
	 $("[data-mask]").inputmask();
    });
</script>

<!-- InputMask -->
    <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.extensions.js"></script>
';

//document.getElementById("id_cabang2").value = cport + (parseInt(result)+1);
    $title	= 'Form Customer';
    $submenu	= "master_customer";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>