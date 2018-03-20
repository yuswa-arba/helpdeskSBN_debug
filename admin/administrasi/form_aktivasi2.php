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
		$conn_soft = Config::getInstanceSoft();


if(isset($_POST["save"]))
{
    //echo "save";
   
    $kode_aktivasi	= isset($_POST['kode_aktivasi']) ? mysql_real_escape_string(trim($_POST['kode_aktivasi'])) : '';
    $tanggal	    = isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $id_customer  	= isset($_POST['id_customer']) ? mysql_real_escape_string(trim($_POST['id_customer'])) : '';
    $nama_customer  = isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $id_cabang    	= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $id_linkbudget  = isset($_POST['id_linkbudget']) ? mysql_real_escape_string(trim($_POST['id_linkbudget'])) : '';
    $paket_koneksi	= isset($_POST['paket_koneksi']) ? mysql_real_escape_string(trim($_POST['paket_koneksi'])) : '';
    $nama_koneksi	= isset($_POST['nama_koneksi']) ? mysql_real_escape_string(trim($_POST['nama_koneksi'])) : '';
    $user_id	    = isset($_POST['user_id']) ? mysql_real_escape_string(trim($_POST['user_id'])) : '';
    $telpon	    	= isset($_POST['telpon']) ? mysql_real_escape_string(trim($_POST['telpon'])) : '';
    $alamat			= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    $id_teknisi		= isset($_POST['id_teknisi']) ? mysql_real_escape_string(trim($_POST['id_teknisi'])) : '';
    $id_employee	= isset($_POST['id_employee']) ? mysql_real_escape_string(trim($_POST['id_employee'])) : '';
    $ip_customer	= isset($_POST['ip_customer']) ? mysql_real_escape_string(trim($_POST['ip_customer'])) : '';
    $monthly		= isset($_POST['monthly']) ? str_replace(",", "", $_POST['monthly']) : '0';
    $acc_ppn		= isset($_POST['acc_ppn']) ? str_replace(",", "", $_POST['acc_ppn']) : '0';
    $acc_total		= isset($_POST['acc_total']) ? str_replace(",", "", $_POST['acc_total']) : '0';
    
    $acc_admin		= isset($_POST['acc_admin']) ? mysql_real_escape_string(trim($_POST['acc_admin'])) : '';
    
    $acc_monthly	= ($acc_total == "0") ? str_replace(",", "", $_POST['acc_total']) : $acc_total;
    
    
    if($kode_aktivasi != "" AND $id_linkbudget != ""){
		
		//insert data aktivasi
    $sql_insert = "INSERT INTO `gx_aktivasi` (`id_aktivasi`, `kode_aktivasi`, `tanggal`,
						  `id_customer`, `nama_customer`, `id_cabang`, `id_linkbudget`, `paket_koneksi`,
						  `nama_koneksi`, `user_id`, `telpon`, `alamat`, `id_marketing`, `id_teknisi`, `ip_customer`,
						  `acc_admin`, `acc_monthly`,  
						  `date_add`, `date_upd`, `user_add`, `user_upd`, `level`) 
					  VALUES ('', '".$kode_aktivasi."', '".$tanggal."',
						  '".$id_customer."', '".$nama_customer."', '".$id_cabang."', '".$id_linkbudget."', '".$paket_koneksi."',
						  '".$nama_koneksi."', '".$user_id."', '".$telpon."', '".$alamat."', '".$id_employee."', '".$id_teknisi."', '".$ip_customer."',
						  '".$acc_admin."', '".$acc_monthly."', 
						  NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
						  
    $sql_update = "UPDATE `tbCustomer` SET `cNonAktiv` = '0' WHERE `cKode` = '".$id_customer."';";
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan aktivasi!');
							   window.history.go(-1);
						       </script>");
    mysql_query($sql_update, $conn);
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);


    //invoice    
    $sql_cabang	= mysql_query("SELECT * FROM `gx_cabang` WHERE `level` = '0' AND `id_cabang` = '".$id_cabang."' LIMIT 0,1;", $conn);
    $row_cabang = mysql_fetch_array($sql_cabang);
    
    $sql_customer	= mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".$id_customer."' LIMIT 0,1;", $conn);
    $row_customer	= mysql_fetch_array($sql_customer);
	
	$sql_paket	= mysql_query("SELECT * FROM `gx_paket2` WHERE `kode_paket` = '".$paket_koneksi."' LIMIT 0,1;", $conn);
    $row_paket	= mysql_fetch_array($sql_paket);
    
    $sql_invoice  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_invoice` ORDER BY `id_invoice` DESC", $conn));
    $last_data  = $sql_invoice["id_invoice"] + 1;
    $tanggal    = date("d");
    $kode_invoice = $row_cabang["kode_cabang"].'-'.$row_cabang["invoice_code"].''.$tanggal.''.sprintf("%04d", $last_data);
	
	
	//RBS
	$sql_rbs_lastdata	= "SELECT TOP 1 [dbo].[BillingTransactions].[BillingTransactionIndex] FROM [dbo].[BillingTransactions] ORDER BY [dbo].[BillingTransactions].[BillingTransactionIndex] DESC;";
	$query_rbs_lastdata = $conn_soft->prepare($sql_rbs_lastdata);
	$query_rbs_lastdata->execute();
	$row_rbs_lastdata	= $query_rbs_lastdata->fetch();
	
	$BillingTransactionIndex = $row_rbs_lastdata["BillingTransactionIndex"] + 1;
	
	$sql_bill_lastdata	= "SELECT TOP 1 [dbo].[Bills].[BillIndex] FROM [dbo].[Bills] ORDER BY [dbo].[Bills].[BillIndex] DESC;";
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
	
	$acc_monthly = $row_paket["monthly_fee"] + $row_paket["abonemen_video"] + $row_paket["abonemen_voip"];
	
	//START GENERATE INPUT INVOICE RBS
	if($acc_monthly != "0")
	{
		$ppn = (10/100) * $acc_monthly;
		$grandtotal = $acc_monthly + $ppn;
		
		
		$sql = "SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
		INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
		VALUES ('".$BillingTransactionIndex."', '".date("Y-m-d H:i:s.000")."', '1', '".$row_customer["iuserIndex"]."', '1', '".$BillIndex."', '-".$grandtotal."');
		SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF";
		
		//echo $sql;
		$q = $conn_soft->prepare($sql);
		$q->execute();
		enableLog("","auto", "auto",$sql);
		
		$UserPaymentBalance_update = $UserPaymentBalance - $grandtotal;
		$nterm = (int)$row_customer["nterm"];
		$tambahan_grace = ($nterm == "0") ? "2" : $nterm;
		
		$sql_rbs_user_detail = "SET IDENTITY_INSERT [dbo].[Bills] ON
		INSERT INTO [dbo].[Bills] ([BillIndex], [BillType], [UserIndex], [BillStartDate], [BillEndDate], [CreateDate], [Emailed], [Charged], [EmailedSessions], [Exported1], [Exported2])
		VALUES ('".$BillIndex."', '1', '".$row_customer["iuserIndex"]."', '".date("Y-m-d 00:00:00.000", strtotime($tgl_tagihan))."', '".date("Y-m-d 23:59:59.000", strtotime($tgl_tagihan))."', '".date("Y-m-d H:i:s.000")."', '0', '0', '0', '0', '0');
		SET IDENTITY_INSERT [dbo].[Bills] OFF
		
		
		INSERT INTO [dbo].[BillsSections] ([BillIndex], [BillSectionIndex], [Type], [Charge], [Info1], [Info2], [Info3], [Remark])
		VALUES ('".$BillIndex."', '".$BillSectionIndex."', '1', '".$grandtotal."', '0', '0', '0', 'Activation For Dates ".date("d/m/Y", strtotime($tgl_tagihan))." - ".date("d/m/Y", strtotime($tgl_tagihan))." (".$AccountName.").');
		
		
		UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='".$UserPaymentBalance_update."', [GracePeriodExpiration] = '". date("Y-m-d 00:00:00.000", strtotime($tgl_tagihan. "+$tambahan_grace days"))."',
		[UserExpiryDate] = '".date("Y-m-01 00:00:00.000", strtotime($tgl_tagihan. "+1 month"))."'
		WHERE ([UserIndex]='".$row_customer["iuserIndex"]."');
		";
		//echo $sql_rbs_user_detail;
		$query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);
		
		$query_rbs_user_detail->execute();
		enableLog("","auto", "auto",$sql_rbs_user_detail);
	
	//END GENERATE RBS

	//insert data invoice
    $sql_insert_invoice = "INSERT INTO `gx_invoice`(`id_invoice`, `kode_aktivasi`, `kode_invoice`, `title`, `customer_number`,`nama_customer`,
     					    `npwp`, `no_faktur_pajak`, `note`, `periode_tagihan`,`tanggal_tagihan`, `tanggal_jatuh_tempo`,
					    `total`, `ppn`, `grandtotal`, `posting`, `paid_status`, `status`, `reference`,
						`no_virtual_account_bca`, `nama_virtual`, `prepared_by`, `date_add`, `date_upd`,
					    `user_add`, `user_upd`, `level`)
				    VALUES ('', '".$kode_aktivasi."', '".$kode_invoice."', 'AKTIVASI BARU', '".$id_customer."', '".$nama_customer."',
					    '".$row_customer["no_npwp"]."', '', 'AKTIVASI BARU', '', '".date("Y-m-d")."', '".date("Y-m-d", strtotime("+3 days"))."',
					    '".$acc_monthly."', '".$ppn."', '".$grandtotal."', '1', '0', '1', '".$BillIndex."',
						'".$row_customer["cNoRekVirtual"]."', '".$row_customer["cNama"]."', '".$loggedin["username"]."', NOW(), NOW(),
					    '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    
    //echo $sql_insert."<br>";

   mysql_query($sql_insert_invoice, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_invoice);
    
    //detiail invoice
    $sql_insert_detail = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`, `date`,
						    `harga`, `desc`, `date_add`,
						    `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES ('', '".$kode_invoice."', '".date("Y-m-d H:i:s")."',
						    '".$acc_monthly."', 'AKTIVASI BARU', NOW(),
						    NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    //echo $sql_insert;
    mysql_query($sql_insert_detail, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_detail);
    
	}
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='master_aktivasi.php';
	</script>";
    
    }else{
	echo "<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan invoice!');
							   window.history.go(-1);
						       </script>";
    }
}
elseif(isset($_POST["update"]))
{
    //echo "update";
    $id_aktivasi		= isset($_POST['id_aktivasi']) ? mysql_real_escape_string(trim($_POST['id_aktivasi'])) : '';
    $kode_aktivasi		= isset($_POST['kode_aktivasi']) ? mysql_real_escape_string(trim($_POST['kode_aktivasi'])) : '';
    $tanggal	    	= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $id_customer  		= isset($_POST['id_customer']) ? mysql_real_escape_string(trim($_POST['id_customer'])) : '';
    $nama_customer    	= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $id_cabang    		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $id_linkbudget   	= isset($_POST['id_linkbudget']) ? mysql_real_escape_string(trim($_POST['id_linkbudget'])) : '';
    $paket_koneksi		= isset($_POST['paket_koneksi']) ? mysql_real_escape_string(trim($_POST['paket_koneksi'])) : '';
    $nama_koneksi	   	= isset($_POST['nama_koneksi']) ? mysql_real_escape_string(trim($_POST['nama_koneksi'])) : '';
    $user_id	    	= isset($_POST['user_id']) ? mysql_real_escape_string(trim($_POST['user_id'])) : '';
    $telpon	    		= isset($_POST['telpon']) ? mysql_real_escape_string(trim($_POST['telpon'])) : '';
    $alamat				= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    $id_teknisi			= isset($_POST['id_teknisi']) ? mysql_real_escape_string(trim($_POST['id_teknisi'])) : '';
    $id_employee	    = isset($_POST['id_employee']) ? mysql_real_escape_string(trim($_POST['id_employee'])) : '';
    $ip_customer	    = isset($_POST['ip_customer']) ? mysql_real_escape_string(trim($_POST['ip_customer'])) : '';
    
    $acc_admin		= isset($_POST['acc_admin']) ? mysql_real_escape_string(trim($_POST['acc_admin'])) : '';
    $monthly		= isset($_POST['monthly']) ? str_replace(",", "", $_POST['monthly']) : '0';
    
    $acc_monthly	= ($monthly == "0") ? str_replace(",", "", $_POST['monthly']) : $monthly;

    if($id_aktivasi != ""){
    $sql_update = "UPDATE `gx_aktivasi` SET `kode_aktivasi` = '".$kode_aktivasi."', `tanggal`='".$tanggal."',
		    `id_customer`='".$id_customer."',
		    `nama_customer`='".$nama_customer."', `id_cabang`='".$id_cabang."', `id_linkbudget`='".$id_linkbudget."',
		    `paket_koneksi`='".$paket_koneksi."', `nama_koneksi`='".$nama_koneksi."', `user_id`='".$user_id."',
		    `telpon`='".$telpon."', `alamat`='".$alamat."', `id_teknisi`='".$id_teknisi."',
		    `id_marketing`='".$id_employee."', `ip_customer` = '".$ip_customer."',
		    `acc_admin`='".$acc_admin."', `acc_monthly`='".$acc_monthly."',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_aktivasi` = '".$id_aktivasi."';
			";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
		echo "<script language='JavaScript'>
		alert('Data telah diupdate.');
		window.location.href='master_aktivasi.php';
		</script>";
    }else{
		echo "<script language='JavaScript'>
			alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
			</script>";
    }
}

if(isset($_GET["id"]))
{
    $id_aktivasi		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_aktivasi		= "SELECT * FROM `gx_aktivasi` WHERE `id_aktivasi`='$id_aktivasi' LIMIT 0,1;";
    $sql_spk_aktivasi		= mysql_query($query_aktivasi, $conn);
    $row_aktivasi		= mysql_fetch_array($sql_spk_aktivasi);
    $sql_teknisi    = mysql_query("SELECT `gx_pegawai`.*
				      FROM `gx_pegawai`
                                      WHERE `gx_pegawai`.`kode_pegawai` = '$row_aktivasi[id_teknisi]';", $conn);
    $row_teknisi    = mysql_fetch_array($sql_teknisi);
    $sql_marketing    = mysql_query("SELECT `gx_pegawai`.*
				      FROM `gx_pegawai`
                                      WHERE `gx_pegawai`.`kode_pegawai` = '$row_aktivasi[id_marketing]';", $conn);
    $row_marketing    = mysql_fetch_array($sql_marketing);
    
    $sql_cabang    = mysql_query("SELECT * FROM `gx_cabang`
                                      WHERE `gx_cabang`.`id_cabang` = '$row_aktivasi[id_cabang]';", $conn);
    $row_cabang    = mysql_fetch_array($sql_cabang);
    $sql_paket    = mysql_query("SELECT * FROM `gx_paket2`
                                      WHERE `gx_paket2`.`kode_paket` = '$row_aktivasi[paket_koneksi]';", $conn);
    $row_paket    = mysql_fetch_array($sql_paket);
    
    $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
    $hari_ini	= date("d");
  

}

    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Aktivasi Baru</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="">
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=aktivasi\',\'cabang\');" name="nama_cabang" value="'.(isset($_GET['id']) ? $row_cabang["nama_cabang"] : "").'" placeholder="Search Cabang">
						<input type="hidden" class="form-control" name="id_cabang" value="'.(isset($_GET['id']) ? $row_aktivasi["id_cabang"] : "").'">
						<input type="hidden" class="form-control" name="id_aktivasi" value="'.(isset($_GET['id']) ? $row_aktivasi["id_aktivasi"] : "").'">
					    
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Aktivasi Baru</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" readonly=""  class="form-control" id="kode_aktivasi" name="kode_aktivasi" required="" value="'.(isset($_GET['id']) ? $row_aktivasi["kode_aktivasi"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_aktivasi["tanggal"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div> 
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly=""  class="form-control" placeholder="Search Customer"
						onclick="return valideopenerform(\'data_spk_aktivasi_baru.php?r=myForm&f=aktivasi\',\'spkaktivasi\');" name="id_customer" value="'.(isset($_GET['id']) ? $row_aktivasi["id_customer"] : "").'">
						
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" readonly=""  class="form-control"  name="nama_customer" value="'.(isset($_GET['id']) ? $row_aktivasi["nama_customer"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>No. link Budget</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  readonly="" name="id_linkbudget" value="'.(isset($_GET['id']) ? $row_aktivasi["id_linkbudget"] : "").'">
						<a id="linkk" name="linkk" href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(this);">Detail Link Budget</a>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Paket Koneksi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="paket_koneksi" value="'.(isset($_GET['id']) ? $row_aktivasi["paket_koneksi"] : "").'">
						
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Nama Paket</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" readonly="" class="form-control"  name="nama_koneksi" value="'.(isset($_GET['id']) ? $row_aktivasi["nama_koneksi"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>User ID</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="user_id" value="'.(isset($_GET['id']) ? $row_aktivasi["user_id"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Telp</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="telpon" value="'.(isset($_GET['id']) ? $row_aktivasi["telpon"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" readonly="" class="form-control" name="alamat" value="'.(isset($_GET['id']) ? $row_aktivasi["alamat"] : "").'">
					    </div>
                                        
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Teknisi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" onclick="return valideopenerform(\'data_teknisi.php?r=myForm\',\'cust\');" readonly="" name="nama_teknisi" value="'.(isset($_GET['id']) ? $row_teknisi["nama"] : "").'">
						<input type="hidden" readonly="" class="form-control" name="id_teknisi" value="'.(isset($_GET['id']) ? $row_aktivasi["id_teknisi"] : "").'">
						
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Marketing</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" onclick="return valideopenerform(\'data_marketing.php?r=myForm\',\'cust\');" name="nama_marketing" value="'.(isset($_GET['id']) ? $row_marketing["nama"] : "").'">
					        <input type="hidden" class="form-control" readonly="" name="id_employee" value="'.(isset($_GET['id']) ? $row_aktivasi["id_marketing"] : "").'">
						
					    </div>
                                        </div>
					</div>

					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>IP Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="ip_customer" value="'.(isset($_GET['id']) ? $row_aktivasi["ip_customer"] : "").'">
					    </div>
                                        
                                        </div>
					</div>
					<!--<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC Admin</label>
					    </div>
					    <div class="col-xs-3">
						<input type="radio" class="form-control" name="acc_admin" value="1"> yes  
						<input type="radio" class="form-control" name="acc_admin" value="0"> no
					    </div>
                                        
                                        </div>
					</div>-->
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3" align="center">
						<label> </label>
					    </div>
					    <div class="col-xs-4" align="center">
						<label>PERHITUNGAN INVOICE</label>
					    </div>
					    <div class="col-xs-4" align="center">
						<label></label>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Monthly Fee</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="monthly" value="'.(isset($_GET['id']) ? $row_paket["acc_monthly"] : "").'">
					    </div>
					    <div class="col-xs-4">
						
					    </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Total</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="acc_total" value="'.(isset($_GET['id']) ? $row_paket["acc_total"] : "").'">
					    </div>
					    <div class="col-xs-4">
						
					    </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_aktivasi["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_aktivasi["user_upd"]." ".$row_aktivasi["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
	<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: \'\',
		thousandsSeparator: \',\',
		centsLimit: 0
	    });
        </script>';

    $title	= 'Form Aktivasi Baru';
    $submenu	= "aktivasi";
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