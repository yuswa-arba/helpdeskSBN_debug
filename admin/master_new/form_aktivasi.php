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
    //echo "save";
   
    $kode_aktivasi		= isset($_POST['kode_aktivasi']) ? mysql_real_escape_string(trim($_POST['kode_aktivasi'])) : '';
    $tanggal	    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $id_customer  		= isset($_POST['id_customer']) ? mysql_real_escape_string(trim($_POST['id_customer'])) : '';
    $nama_customer    		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $id_cabang    		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $id_linkbudget   		= isset($_POST['id_linkbudget']) ? mysql_real_escape_string(trim($_POST['id_linkbudget'])) : '';
    $paket_koneksi		= isset($_POST['paket_koneksi']) ? mysql_real_escape_string(trim($_POST['paket_koneksi'])) : '';
    $nama_koneksi	   	= isset($_POST['nama_koneksi']) ? mysql_real_escape_string(trim($_POST['nama_koneksi'])) : '';
    $user_id	    		= isset($_POST['user_id']) ? mysql_real_escape_string(trim($_POST['user_id'])) : '';
    $telpon	    		= isset($_POST['telpon']) ? mysql_real_escape_string(trim($_POST['telpon'])) : '';
    $alamat			= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    $id_teknisi			= isset($_POST['id_teknisi']) ? mysql_real_escape_string(trim($_POST['id_teknisi'])) : '';
    $id_employee	    	= isset($_POST['id_employee']) ? mysql_real_escape_string(trim($_POST['id_employee'])) : '';
    $ip_customer	    	= isset($_POST['ip_customer']) ? mysql_real_escape_string(trim($_POST['ip_customer'])) : '';
    //insert into gx_control_justifikasi
    $sql_insert = "INSERT INTO `gx_aktivasi` (`id_aktivasi`, `kode_aktivasi`, `tanggal`,
						  `id_customer`, `nama_customer`, `id_cabang`, `id_linkbudget`, `paket_koneksi`,
						  `nama_koneksi`, `user_id`, `telpon`, `alamat`, `id_marketing`, `id_teknisi`, `ip_customer`,
						  `date_add`, `date_upd`, `user_add`, `user_upd`, `level`) 
					  VALUES ('', '$kode_aktivasi', '$tanggal',
						  '$id_customer', '$nama_customer', '$id_cabang', '$id_linkbudget', '$paket_koneksi',
						  '$nama_koneksi', '$user_id', '$telpon', '$alamat', '$id_employee', '$id_teknisi', '$ip_customer',
						  NOW(), NOW(), '$loggedin[username]', '$loggedin[username]', '0');";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master_anyar/master_aktivasi.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    
    $kode_aktivasi		= isset($_POST['kode_aktivasi']) ? mysql_real_escape_string(trim($_POST['kode_aktivasi'])) : '';
    $tanggal	    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $id_customer  		= isset($_POST['id_customer']) ? mysql_real_escape_string(trim($_POST['id_customer'])) : '';
    $nama_customer    		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $id_cabang    		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $id_linkbudget   		= isset($_POST['id_linkbudget']) ? mysql_real_escape_string(trim($_POST['id_linkbudget'])) : '';
    $paket_koneksi		= isset($_POST['paket_koneksi']) ? mysql_real_escape_string(trim($_POST['paket_koneksi'])) : '';
    $nama_koneksi	   	= isset($_POST['nama_koneksi']) ? mysql_real_escape_string(trim($_POST['nama_koneksi'])) : '';
    $user_id	    		= isset($_POST['user_id']) ? mysql_real_escape_string(trim($_POST['user_id'])) : '';
    $telpon	    		= isset($_POST['telpon']) ? mysql_real_escape_string(trim($_POST['telpon'])) : '';
    $alamat			= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    $id_teknisi			= isset($_POST['id_teknisi']) ? mysql_real_escape_string(trim($_POST['id_teknisi'])) : '';
    $id_employee	    	= isset($_POST['id_employee']) ? mysql_real_escape_string(trim($_POST['id_employee'])) : '';
    $ip_customer	    	= isset($_POST['ip_customer']) ? mysql_real_escape_string(trim($_POST['ip_customer'])) : '';
    
    $sql_update = "UPDATE `gx_aktivasi` SET `kode_aktivasi` = '".$kode_aktivasi."', `tanggal`='".$tanggal."',
		    `id_customer`='".$id_customer."',
		    `nama_customer`='".$nama_customer."', `id_cabang`='".$id_cabang."', `id_linkbudget`='".$id_linkbudget."',
		    `paket_koneksi`='".$paket_koneksi."', `nama_koneksi`='".$nama_koneksi."', `user_id`='".$user_id."',
		    `telpon`='".$telpon."', `alamat`='".$alamat."', `id_teknisi`='".$id_teknisi."',
		    `id_marketing`='".$id_employee."', `ip_customer` = '".$ip_customer."',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_aktivasi` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."master_anyar/master_aktivasi.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_aktivasi		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_aktivasi		= "SELECT * FROM `gx_aktivasi` WHERE `id_aktivasi`='$id_aktivasi' LIMIT 0,1;";
    $sql_spk_aktivasi		= mysql_query($query_aktivasi, $conn);
    $row_aktivasi		= mysql_fetch_array($sql_spk_aktivasi);
    $sql_teknisi    = mysql_query("SELECT `tbPegawai`.*
				      FROM `tbPegawai`
                                      WHERE `tbPegawai`.`id_employee` = '$row_aktivasi[id_teknisi]';", $conn);
    $row_teknisi    = mysql_fetch_array($sql_teknisi);
    $sql_marketing    = mysql_query("SELECT `tbPegawai`.*
				      FROM `tbPegawai`
                                      WHERE `tbPegawai`.`id_employee` = '$row_aktivasi[id_marketing]';", $conn);
    $row_marketing    = mysql_fetch_array($sql_marketing);
    
    $sql_cabang    = mysql_query("SELECT * FROM `gx_cabang`
                                      WHERE `gx_cabang`.`id_cabang` = '$row_aktivasi[id_cabang]';", $conn);
    $row_cabang    = mysql_fetch_array($sql_cabang);
    $sql_paket    = mysql_query("SELECT * FROM `gx_paket2`
                                      WHERE `gx_paket2`.`id_paket` = '$row_aktivasi[paket_koneksi]';", $conn);
    $row_paket    = mysql_fetch_array($sql_paket);
    
    $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
    $hari_ini	= date("d");
  
    $sum_aktivasi_sd_akhirbulan = $jumlah_hari - $hari_ini;
    $tagihanperhari    = $row_paket["monthly_fee"] / $jumlah_hari;
    $total_tagihan	=  $sum_aktivasi_sd_akhirbulan * $tagihanperhari;
    $ppn		= 10/100 * $total_tagihan;
    $totalppn		= $total_tagihan + $ppn;
}

    $content ='<section class="content-header">
                    <h1>
                        Form Aktivasi Baru
                        
                    </h1>
                    
                </section>

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
						<input type="text" class="form-control" name="nama_cabang" value="'.(isset($_GET['id']) ? $row_cabang["nama_cabang"] : "").'">
						<input type="hidden" class="form-control" name="id_cabang" value="'.(isset($_GET['id']) ? $row_aktivasi["id_cabang"] : "").'">
						<a href="'.URL_ADMIN.'master_anyar/data_cabang.php?r=myForm&f=aktivasi"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_cabang.php?r=myForm&f=aktivasi\',\'cabang\');">Search Cabang</a>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Aktivasi Baru</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" id="kode_aktivasi" name="kode_aktivasi" required="" value="'.(isset($_GET['id']) ? $row_aktivasi["kode_aktivasi"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_aktivasi["tanggal"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div> 
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="id_customer" value="'.(isset($_GET['id']) ? $row_aktivasi["id_customer"] : "").'">
						<a href="'.URL_ADMIN.'master_anyar/data_cust.php?r=myForm&f=aktivasi"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_cust.php?r=myForm&f=aktivasi\',\'cust\');">Search Cust</a>
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="nama_customer" value="'.(isset($_GET['id']) ? $row_aktivasi["nama_customer"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>No. link Budget</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="id_linkbudget" value="'.(isset($_GET['id']) ? $row_aktivasi["id_linkbudget"] : "").'">
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
						<a href="'.URL_ADMIN.'master_anyar/data_paket2.php?r=myForm"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_paket2.php?r=myForm\',\'paket\');">Search paket</a>
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
						<input type="text" class="form-control" name="user_id" value="'.(isset($_GET['id']) ? $row_aktivasi["user_id"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Telp</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="telpon" value="'.(isset($_GET['id']) ? $row_aktivasi["telpon"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="alamat" value="'.(isset($_GET['id']) ? $row_aktivasi["alamat"] : "").'">
					    </div>
                                        
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Teknisi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" name="nama_teknisi" value="'.(isset($_GET['id']) ? $row_teknisi["cNama"] : "").'">
						<input type="hidden" readonly="" class="form-control" name="id_teknisi" value="'.(isset($_GET['id']) ? $row_aktivasi["id_teknisi"] : "").'">
						<a href="'.URL_ADMIN.'master_anyar/data_teknisi.php?r=myForm"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_teknisi.php?r=myForm\',\'cust\');">Search Teknisi</a>
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Marketing</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" name="nama_marketing" value="'.(isset($_GET['id']) ? $row_marketing["cNama"] : "").'">
					        <input type="hidden" class="form-control" readonly="" name="id_employee" value="'.(isset($_GET['id']) ? $row_aktivasi["id_marketing"] : "").'">
						<a href="'.URL_ADMIN.'master_anyar/data_marketing.php?r=myForm"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_marketing.php?r=myForm\',\'cust\');">Search marketing</a>
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
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-12" align="center">
						<label>PERHITUNGAN INVOICE</label>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Monthly Fee</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" readonly="" class="form-control" name="monthly" value="'.(isset($_GET['id']) ? $row_paket["monthly_fee"] : "").'">
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tagihan Perhari</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" readonly="" class="form-control" name="daily" value="'.(isset($_GET['id']) ? $tagihanperhari : "").'">
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>jumlah Hari Aktivasi</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" readonly="" class="form-control" name="hari_aktivasi" value="'.(isset($_GET['id']) ? $sum_aktivasi_sd_akhirbulan : "").'">
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Total Tagihan Prorate</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" readonly="" class="form-control" name="total" value="'.(isset($_GET['id']) ? $total_tagihan : "").'">
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>PPN</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" readonly="" class="form-control" name="ppn" value="'.(isset($_GET['id']) ? $ppn : "").'">
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Total Tagihan + PPN</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" readonly="" class="form-control" name="totalppn" value="'.(isset($_GET['id']) ? $totalppn : "").'">
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

$plugins = '';

    $title	= 'Form SPK Aktivasi Baru';
    $submenu	= "SPK_aktivasi";
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