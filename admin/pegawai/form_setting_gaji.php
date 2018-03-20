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



enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Master Gaji");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_setting_gaji_karyawan` WHERE `id_setting_gaji_karyawan`='$id_data' AND `level`='0' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
}

$data_id_setting_gaji_karyawan= mysql_fetch_array(mysql_query("SELECT `id_setting_gaji_karyawan` FROM `gx_setting_gaji_karyawan` WHERE `level`='0' ORDER BY `id_setting_gaji_karyawan` DESC LIMIT 1", $conn));
$value_id_setting_gaji_karyawan = $data_id_setting_gaji_karyawan['id_setting_gaji_karyawan'] != '' ? $data_id_setting_gaji_karyawan['id_setting_gaji_karyawan'] + 1 : '1';

    $content = '<section class="content-header">
                    <h1>
                        
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="form_setting_gaji" action="" enctype="multipart/form-data" id="">
                                    <div class="box-body">
										<input type="hidden" name="id_setting_gaji_karyawan" value="'.(isset($_GET['id']) ? $row_data["id_setting_gaji_karyawan"] : $value_id_setting_gaji_karyawan).'"> 
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label><h2>Form Setting Gaji Karyawan</h2></label>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kode Staff</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="kode" readonly="" placeholder="" value="'.(isset($_GET['id']) ? $row_data["kode"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Nama</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="nama" readonly="" placeholder="" value="'.(isset($_GET['id']) ? $row_data["nama"] : "").'"  onclick="return valideopenerform(\'data_staff.php?r=form_setting_gaji&f=data_staff\',\'staff\');">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Level</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="level" placeholder="" value="'.(isset($_GET['id']) ? $row_data["level"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Gaji Pokok</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="gaji_pokok" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["gaji_pokok"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Tunjangan Jabatan</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="tunjangan_jabatan" placeholder="" value="'.(isset($_GET['id']) ? $row_data["tunjangan_jabatan"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Dana Pensiun</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="dana_pensiun" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["dana_pensiun"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Jamsostek</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="jamsostek" placeholder="" value="'.(isset($_GET['id']) ? $row_data["jamsostek"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Insentif Hadir</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="insentif_hadir" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["insentif_hadir"] : "").'">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Total Gaji</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="total_gaji" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["total_gaji"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Total Gaji Diterima</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="total_gaji_diterima" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["total_gaji_diterima"] : "").'">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Koperasi</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="koperasi" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["koperasi"] : "").'">
											</div>
										</div>
										</div>
										
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' value="Submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
			

if(isset($_POST["save"]))
{
       //echo "save";
    //$					= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $kode	   			= isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : '';
    $nama				= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $level_setting			= isset($_POST['level_setting']) ? mysql_real_escape_string(trim($_POST['level_setting'])) : '';
    $gaji_pokok				= isset($_POST['gaji_pokok']) ? mysql_real_escape_string(trim($_POST['gaji_pokok'])) : '';
    $tunjangan_jabatan			= isset($_POST['tunjangan_jabatan']) ? mysql_real_escape_string(trim($_POST['tunjangan_jabatan'])) : '';
    $dana_pensiun			= isset($_POST['dana_pensiun']) ? mysql_real_escape_string(trim($_POST['dana_pensiun'])) : '';
    $jamsostek				= isset($_POST['jamsostek']) ? mysql_real_escape_string(trim($_POST['jamsostek'])) : '';
    $insentif_hadir			= isset($_POST['insentif_hadir']) ? mysql_real_escape_string(trim($_POST['insentif_hadir'])) : '';
    $total_gaji				= isset($_POST['total_gaji']) ? mysql_real_escape_string(trim($_POST['total_gaji'])) : '';
    $total_gaji_diterima		= isset($_POST['total_gaji_diterima']) ? mysql_real_escape_string(trim($_POST['total_gaji_diterima'])) : '';
    $koperasi				= isset($_POST['koperasi']) ? mysql_real_escape_string(trim($_POST['koperasi'])) : '';
    $username 				= $loggedin["username"];	
	
	if($_POST['save'] == 'Submit'){
	$sql_insert = "INSERT INTO `gx_setting_gaji_karyawan`(`id_setting_gaji_karyawan`, `kode`, `nama`, `level_setting`, `gaji_pokok`, `tunjangan_jabatan`, `dana_pensiun`, `jamsostek`, `insentif_hadir`, `total_gaji`, `total_gaji_diterima`, `koperasi`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
				    VALUES (NULL,'".$kode."','".$nama."','".$level_setting."','".$gaji_pokok."','".$tunjangan_jabatan."','".$dana_pensiun."','".$jamsostek."','".$insentif_hadir."','".$total_gaji."','".$total_gaji_diterima."','".$koperasi."',NOW(),NOW(),'".$username."','".$username."','0')";                    
    
   //echo $sql_insert;
    
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/setting_gaji.php';
			</script>";
	
    }else{
		echo"<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Data tidak lengkap pada pengisian form!');
		window.history.go(-1);
	    </script>";
	}
}elseif(isset($_POST["update"]))
{
    
    
    //$					= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $id_setting_gaji_karyawan		= isset($_POST['id_setting_gaji_karyawan']) ? mysql_real_escape_string(trim($_POST['id_setting_gaji_karyawan'])) : '';
    $kode	   			= isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : '';
    $nama				= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $level_setting			= isset($_POST['level_setting']) ? mysql_real_escape_string(trim($_POST['level_setting'])) : '';
    $gaji_pokok				= isset($_POST['gaji_pokok']) ? mysql_real_escape_string(trim($_POST['gaji_pokok'])) : '';
    $tunjangan_jabatan			= isset($_POST['tunjangan_jabatan']) ? mysql_real_escape_string(trim($_POST['tunjangan_jabatan'])) : '';
    $dana_pensiun			= isset($_POST['dana_pensiun']) ? mysql_real_escape_string(trim($_POST['dana_pensiun'])) : '';
    $jamsostek				= isset($_POST['jamsostek']) ? mysql_real_escape_string(trim($_POST['jamsostek'])) : '';
    $insentif_hadir			= isset($_POST['insentif_hadir']) ? mysql_real_escape_string(trim($_POST['insentif_hadir'])) : '';
    $total_gaji				= isset($_POST['total_gaji']) ? mysql_real_escape_string(trim($_POST['total_gaji'])) : '';
    $total_gaji_diterima		= isset($_POST['total_gaji_diterima']) ? mysql_real_escape_string(trim($_POST['total_gaji_diterima'])) : '';
    $koperasi				= isset($_POST['koperasi']) ? mysql_real_escape_string(trim($_POST['koperasi'])) : '';
    $username 				= $loggedin["username"];	
	
    $sql_update = "UPDATE `gx_setting_gaji_karyawan` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$username."'
		    WHERE `id_setting_gaji_karyawan` = '".$id_setting_gaji_karyawan."'";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "INSERT INTO `gx_setting_gaji_karyawan`(`id_setting_gaji_karyawan`, `kode`, `nama`, `level_setting`, `gaji_pokok`, `tunjangan_jabatan`, `dana_pensiun`, `jamsostek`, `insentif_hadir`, `total_gaji`, `total_gaji_diterima`, `koperasi`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
				    VALUES (NULL,'".$kode."','".$nama."','".$level_setting."','".$gaji_pokok."','".$tunjangan_jabatan."','".$dana_pensiun."','".$jamsostek."','".$insentif_hadir."','".$total_gaji."','".$total_gaji_diterima."','".$koperasi."',NOW(),NOW(),'".$username."','".$username."','0')";                                   
    
    //echo $sql_insert;
    mysql_query($sql_insert_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");

	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_update);
    

    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/setting_gaji.php';
			</script>";

}

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                $("#datepicker2").datepicker({format: "yyyy-mm-dd"});  
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

    $title	= 'Form Master Gaji';
    $submenu	= "setting_gaji";
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