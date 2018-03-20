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

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
		$conn_ott   = DB_TV();
    
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
    
	//data promosi
	$promosi_nominal	= isset($_POST['promosi_nominal']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_nominal']))) : '';
	$promosi_nobank	= isset($_POST['promosi_nobank']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_nobank']))) : '';
    $promosi_nama_rekening	= isset($_POST['promosi_nama_rekening']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_nama_rekening']))) : '';
    $promosi_remark	= isset($_POST['promosi_remark']) ? mysql_real_escape_string(strip_tags(trim($_POST['promosi_remark']))) : '';
    $masa_start	= isset($_POST['masa_start']) ? mysql_real_escape_string(strip_tags(trim($_POST['masa_start']))) : '';
    $masa_end	= isset($_POST['masa_end']) ? mysql_real_escape_string(strip_tags(trim($_POST['masa_end']))) : '';
    $remark	= isset($_POST['remark']) ? mysql_real_escape_string(strip_tags(trim($_POST['remark']))) : '';
    

    if($cKode != "" AND $cNama != "")
	{
		
		
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

enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_rbs_user);

				  
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
enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_rbs_user_detail);
				  
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
    
	for($i=0;$i<count($_FILES['lokasi']['size']);$i++){
		if(strstr($_FILES['file']['lokasi'][$i], 'image')!==false){
			$file = '../upload/customer/'.date("Ymdhis").'_'.$_FILES['file']['name'][$i];
			move_uploaded_file($_FILES['lokasi']['tmp_name'][$i],$file);
			$na=$_FILES['lokasi']['name'][$i];
	
			$sql_lokasi = "INSERT INTO `gx_galeri` (`id_galeri`, `idcustomer_galeri`, `nama_file`, `keterangan`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
			VALUES (NULL, '".$cKode."', '".date("Ymdhis")."_".$_FILES['file']['name'][$i]."',
			'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
			mysql_query($sql_lokasi, $conn) or die (mysql_error());
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


	//update master ip
    $sql_update_ip = "UPDATE `gx_master_ip` SET `keterangan_ip`='new',
	`userid_ip`='".$cUserID."', `flag_ip`='active',
	`date_upd`= NOW(), `user_upd`='".$loggedin["id_employee"]."'
	WHERE (`ip_address`='".ip2long($user_ip)."');";
        //echo $insert."<br>";
	
    //echo $sql_insert_customer;
	mysql_query($sql_update_ip, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_ip);
    
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
    $cKode			= isset($_GET['id']) ? strip_tags(trim($_GET['id'])) : '';
    $query_customer = "SELECT * FROM `tbCustomer` WHERE `cKode` LIKE '%".$cKode."%' AND `level` = '0' LIMIT 0,1;";
    $sql_customer	= mysql_query($query_customer, $conn);
    $row_customer	= mysql_fetch_array($sql_customer);
    
    
    $sql_user_tv = mysql_query("SELECT * FROM `v_user_tv` WHERE `custnumber_user_tv` = '".$cKode."';", $conn);
	$sql_user_voip = mysql_query("SELECT * FROM `v_user_voip` WHERE `custnumber_user_voip` = '".$cKode."';", $conn);
	
	
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update form customer id=$cKode");
}else{
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "create new form customer");
}



    
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
                                
				    
                                    <div class="box-body">
										<div class="row">
											<div class="col-xs-3">
												<label>Customer Number</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_customer["cKode"] : "").'
											</div>
										</div>
										<div class="row">
											<div class="col-xs-3">
												<label>UserID</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_customer["cUserID"] : "").'
											</div>
										</div>
										<div class="row">
											<div class="col-xs-3">
												<label>Nama</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_customer["cNama"] : "").'
											</div>
										</div>
										<div class="row">
											<div class="col-xs-3">
												<label>Alamat</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_customer["cAlamat1"] : "").'
											</div>
										</div>
										<div class="row">
											<div class="col-xs-3">
												<label>Telepon</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_customer["cNoHp1"] : "").'
											</div>
										</div>
										
										
										<h5>Data TV</h5>
										
										<a href="" class="btn bg-olive btn-flat margin pull-right"
										onclick="return valideopenerform(\'form_usertv.php?r=customer&f=usertv&custnumber='.$row_customer["cKode"].'\',\'usertv\');">Create New</a>
										
								
										<table id="customer" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>No</th>
													<th style="width: 70px">USER TV</th>
													<th style="width: 120px">Status</th>
													<th>User Subscription</th>
													<th>Balance</th>
													<th style="width: 120px">Action</th>
												</tr>
											</thead>
											<tbody>';
											$no_usertv = 1;
											while($row_user_tv = mysql_fetch_array($sql_user_tv))
											{
												$query_ott	= "SELECT * FROM `boss`.`t_account_cms` WHERE `boss`.`t_account_cms`.`CLIENTNAME`='".$row_user_tv["clientname_user_tv"]."' LIMIT 0,1;";
												$sql_ott	= mysqli_query($conn_ott,$query_ott);
												$row_ott	= mysqli_fetch_array($sql_ott);
												
												$sql_paket		= mysqli_query($conn_ott, "SELECT `ott`.`ott_product`.`proName` FROM `boss`.`t_consumerecord`, `ott`.`ott_product`
																			WHERE `boss`.`t_consumerecord`.`PROID` = `ott`.`ott_product`.`proID`
																			AND `boss`.`t_consumerecord`.`CLIENTID` = '".$row_ott["CLIENTID"]."'
																			AND `boss`.`t_consumerecord`.`VALIDDATE` >= NOW()
																			ORDER BY `boss`.`t_consumerecord`.`EXPENSEDT` DESC;");
												 $paket = "";
												 while ($row_paket = mysqli_fetch_array($sql_paket))
												 {
													 $paket .= $row_paket["proName"].",";
												 }
												 
												 if($row_data["STATUS"] == "1")
												 {
													 $user_subscription = "Pay Per";
												 }
												 elseif($row_data["STATUS"] == "2")
												 {
													 $user_subscription = "Monthly charge";
												 }
												 
												$content .='<tr>
													<td>'.$no_usertv.'.</td>
													<td>'.$row_ott["CLIENTNAME"].'</td>
													<td>'.$row_user_tv["status_user_tv"].'</td>
													<td>'.$user_subscription.', '.$paket.'</td>
													<td>'.number_format($row_ott["BALANCE"], 0, '', '.').'</td>
													<td><a href="" onclick="return valideopenerform(\'form_usertv.php?r=customer&f=usertv&custnumber='.$row_customer["cKode"].'&id='.$row_ott["CLIENTID"].'\',\'usertv\');">Edit</a></td>
												</tr>';
												$no_usertv++;
											}

$content .='								</tbody>
										</table>
										
										
										<h5>Data VOIP</h5>
								
										<table id="customer" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th style="width: 70px">Nomer VOIP</th>
													<th style="width: 120px">Status</th>
													<th>Paket</th>
													<th>Saldo Pulsa</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>';
											$no_usertv = 1;
											while($row_user_voip = mysql_fetch_array($sql_user_voip))
											{
												$content .='<tr>
													<td>'.$no_usertv.'.</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													
												</tr>';
												$no_usertv++;
											}

$content .='								</tbody>
										</table>
                                    </div><!-- /.box-body -->
				    
				   
                                  
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

	$plugins = '';

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