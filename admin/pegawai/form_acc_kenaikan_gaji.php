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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open ACC Kenaikan Gaji");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_master_acc_kenaikan_gaji` WHERE `id_acc_kenaikan_gaji`='$id_data' AND `level`='0' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
}

$data_id_acc_kenaikan_gaji = mysql_fetch_array(mysql_query("SELECT `id_acc_kenaikan_gaji` FROM `gx_master_acc_kenaikan_gaji` WHERE `level`='0' ORDER BY `id_acc_kenaikan_gaji` DESC LIMIT 1", $conn));
$value_id_acc_kenaikan_gaji = $data_id_acc_kenaikan_gaji['id_acc_kenaikan_gaji'] != '' ? $data_id_acc_kenaikan_gaji['id_acc_kenaikan_gaji'] + 1 : '1';

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
                                <form role="form" method="POST" name="form_acc_kenaikan_gaji" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										<input type="hidden" name="id_acc_kenaikan_gaji" value="'.(isset($_GET['id']) ? $row_data["id_acc_kenaikan_gaji"] : $value_id_acc_kenaikan_gaji).'"> 
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label><h2>ACC KENAIKAN GAJI</h2></label>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No ACC Kenaikan Gaji</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="no_acc_kenaikan_gaji" placeholder="" value="'.(isset($_GET['id']) ? $row_data["no_kenaikan_gaji"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>No Kenaikan Gaji</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="no_kenaikan_gaji" placeholder="" value="'.(isset($_GET['id']) ? $row_data["no_kenaikan_gaji"] : "").'" readonly=""  onclick="return valideopenerform(\'data_pegawai.php?r=form_acc_kenaikan_gaji&f=kenaikan_gaji\',\'pegawai\');">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>KODE STAFF</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="kode" placeholder="" value="'.(isset($_GET['id']) ? $row_data["kode"] : "").'" readonly="">
											</div>
											<div class="col-xs-3">
												<label>TANGGAL</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="tanggal" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["tanggal"] : "").'" readonly="">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>NAMA</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="nama" placeholder="" value="'.(isset($_GET['id']) ? $row_data["nama"] : "").'" readonly=""  onclick="return valideopenerform(\'data_staff.php?r=form_acc_kenaikan_gaji\',\'staff\');">
											</div>
											<div class="col-xs-3">
												<label>KENAIKAN KE</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="kenaikan_ke" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["kenaikan_ke"] : "").'" readonly="">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>LEVEL</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="level_gaji" placeholder="" value="'.(isset($_GET['id']) ? $row_data["level_gaji"] : "").'" readonly="">
											</div>
											<div class="col-xs-3">
												<label>SELISIH</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="selisih" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["selisih"] : "").'" readonly="">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-6">
												<label><h3>GAJI LAMA</h3></label>
											</div>
											<div class="col-xs-6">
												<label><h3>KENAIKAN GAJI</h3></label>
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>GAJI POKOK</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="gaji_pokok_lama" placeholder="" value="'.(isset($_GET['id']) ? $row_data["gaji_pokok_lama"] : "").'" readonly="">
											</div>
											<div class="col-xs-3">
												<label>GAJI POKOK</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="gaji_pokok_naik" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["gaji_pokok_naik"] : "").'" readonly="">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>TUNJANGAN JABATAN</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="tunjangan_jabatan_lama" placeholder="" value="'.(isset($_GET['id']) ? $row_data["tunjangan_jabatan_lama"] : "").'" readonly="">
											</div>
											<div class="col-xs-3">
												<label>TUNJANGAN JABATAN</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="tunjangan_jabatan_naik" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["tunjangan_jabatan_naik"] : "").'" readonly="">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>DANA PENSIUN</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="dana_pensiun_lama" placeholder="" value="'.(isset($_GET['id']) ? $row_data["dana_pensiun_lama"] : "").'" readonly="">
											</div>
											<div class="col-xs-3">
												<label>DANA PENSIUN</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="dana_pensiun_naik" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["dana_pensiun_naik"] : "").'" readonly="">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>JAMSOSTEK</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="jamsostek_lama" placeholder="" value="'.(isset($_GET['id']) ? $row_data["jamsostek_lama"] : "").'" readonly="">
											</div>
											<div class="col-xs-3">
												<label>JAMSOSTEK</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="jamsostek_naik" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["jamsostek_naik"] : "").'" readonly="">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>INSENTIF HADIR</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="insentif_hadir_lama" placeholder="" value="'.(isset($_GET['id']) ? $row_data["insentif_hadir_lama"] : "").'" readonly="">
											</div>
											<div class="col-xs-3">
												<label>INSENTIF HADIR</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="insentif_hadir_naik" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["insentif_hadir_naik"] : "").'" readonly="">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>TOTAL GAJI</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="total_gaji_lama" placeholder="" value="'.(isset($_GET['id']) ? $row_data["total_gaji_lama"] : "").'" readonly="">
											</div>
											<div class="col-xs-3">
												<label>TOTAL GAJI</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="total_gaji_naik" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["total_gaji_naik"] : "").'" readonly="">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12">
												<label>REMARKS</label>
											</div>
											<div class="col-xs-12">
												<textarea class="form-control" id="" name="remarks" placeholder="" readonly="">'.(isset($_GET['id']) ? $row_data["remarks"] : "").'</textarea>
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
			

if(isset($_POST["save"]))
{
       //echo "save";
    //SELECT `id`, `id_acc_kenaikan_gaji`, `no_kenaikan_gaji`, `kode`, `tanggal`, `nama`, `kenaikan_ke`, `level_gaji`, `selisih`, `gaji_pokok_lama`, `gaji_pokok_naik`, `tunjangan_jabatan_lama`, `tunjangan_jabatan_naik`, `dana_pensiun_lama`, `dana_pensiun_naik`, `jamsostek_lama`, `jamsostek_naik`, `insentif_hadir_lama`, `insentif_hadir_naik`, `total_gaji_lama`, `total_gaji_naik`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_master_kenaikan_gaji` WHERE 1
    $id_acc_kenaikan_gaji	   	= isset($_POST['id_acc_kenaikan_gaji']) ? mysql_real_escape_string(trim($_POST['id_acc_kenaikan_gaji'])) : '';
    $no_acc_kenaikan_gaji		= isset($_POST['no_acc_kenaikan_gaji']) ? mysql_real_escape_string(trim($_POST['no_acc_kenaikan_gaji'])) : '';
    $no_kenaikan_gaji			= isset($_POST['no_kenaikan_gaji']) ? mysql_real_escape_string(trim($_POST['no_kenaikan_gaji'])) : '';
    //$					= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $kode				= isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : '';
    $tanggal				= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $nama				= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $kenaikan_ke			= isset($_POST['kenaikan_ke']) ? mysql_real_escape_string(trim($_POST['kenaikan_ke'])) : '';
    $level_gaji				= isset($_POST['level_gaji']) ? mysql_real_escape_string(trim($_POST['level_gaji'])) : '';
    $selisih				= isset($_POST['selisih']) ? mysql_real_escape_string(trim($_POST['selisih'])) : '';
    $gaji_pokok_lama			= isset($_POST['gaji_pokok_lama']) ? mysql_real_escape_string(trim($_POST['gaji_pokok_lama'])) : '';
    $gaji_pokok_naik			= isset($_POST['gaji_pokok_naik']) ? mysql_real_escape_string(trim($_POST['gaji_pokok_naik'])) : '';
    $tunjangan_jabatan_lama		= isset($_POST['tunjangan_jabatan_lama']) ? mysql_real_escape_string(trim($_POST['tunjangan_jabatan_lama'])) : '';
    $tunjangan_jabatan_naik		= isset($_POST['tunjangan_jabatan_naik']) ? mysql_real_escape_string(trim($_POST['tunjangan_jabatan_naik'])) : '';
    $dana_pensiun_lama			= isset($_POST['dana_pensiun_lama']) ? mysql_real_escape_string(trim($_POST['dana_pensiun_lama'])) : '';
    $dana_pensiun_naik			= isset($_POST['dana_pensiun_naik']) ? mysql_real_escape_string(trim($_POST['dana_pensiun_naik'])) : '';
    $jamsostek_lama			= isset($_POST['jamsostek_lama']) ? mysql_real_escape_string(trim($_POST['jamsostek_lama'])) : '';
    $jamsostek_naik			= isset($_POST['jamsostek_naik']) ? mysql_real_escape_string(trim($_POST['jamsostek_naik'])) : '';
    $insentif_hadir_lama		= isset($_POST['insentif_hadir_lama']) ? mysql_real_escape_string(trim($_POST['insentif_hadir_lama'])) : '';
    $insentif_hadir_naik		= isset($_POST['insentif_hadir_naik']) ? mysql_real_escape_string(trim($_POST['insentif_hadir_naik'])) : '';
    $total_gaji_lama			= isset($_POST['total_gaji_lama']) ? mysql_real_escape_string(trim($_POST['total_gaji_lama'])) : '';
    $total_gaji_naik			= isset($_POST['total_gaji_naik']) ? mysql_real_escape_string(trim($_POST['total_gaji_naik'])) : '';
    $remarks				= isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';
    $username 				= $loggedin["username"];	
	
	if($id_acc_kenaikan_gaji != "" && $no_acc_kenaikan_gaji != "" && $kode != ""){
	$sql_insert = "INSERT INTO `gx_master_acc_kenaikan_gaji`(`id`, `id_acc_kenaikan_gaji`, `no_acc_kenaikan_gaji`, `no_kenaikan_gaji`, `kode`, `tanggal`, `nama`, `kenaikan_ke`, `level_gaji`, `selisih`, `gaji_pokok_lama`, `gaji_pokok_naik`, `tunjangan_jabatan_lama`, `tunjangan_jabatan_naik`, `dana_pensiun_lama`, `dana_pensiun_naik`, `jamsostek_lama`, `jamsostek_naik`, `insentif_hadir_lama`, `insentif_hadir_naik`, `total_gaji_lama`, `total_gaji_naik`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL,'".$id_acc_kenaikan_gaji."','".$no_acc_kenaikan_gaji."','".$no_kenaikan_gaji."','".$kode."','".$tanggal."','".$nama."','".$kenaikan_ke."','".$level_gaji."','".$selisih."','".$gaji_pokok_lama."','".$gaji_pokok_naik."','".$tunjangan_jabatan_lama."','".$tunjangan_jabatan_naik."','".$dana_pensiun_lama."','".$dana_pensiun_naik."','".$jamsostek_lama."','".$jamsostek_naik."','".$insentif_hadir_lama."','".$insentif_hadir_naik."','".$total_gaji_lama."','".$total_gaji_naik."','".$remarks."',NOW(),NOW(),'".$username."','".$username."','0')";                    
    
   // echo $sql_insert;
    
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/master_acc_kenaikan_gaji.php';
			</script>";
	
    }else{
		echo"<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Data tidak lengkap pada pengisian form!');
		window.history.go(-1);
	    </script>";
	}
}elseif(isset($_POST["update"]))
{
    
    $id_acc_kenaikan_gaji	   	= isset($_POST['id_acc_kenaikan_gaji']) ? mysql_real_escape_string(trim($_POST['id_acc_kenaikan_gaji'])) : '';
    $no_acc_kenaikan_gaji		= isset($_POST['no_acc_kenaikan_gaji']) ? mysql_real_escape_string(trim($_POST['no_acc_kenaikan_gaji'])) : '';
    $no_kenaikan_gaji			= isset($_POST['no_kenaikan_gaji']) ? mysql_real_escape_string(trim($_POST['no_kenaikan_gaji'])) : '';
    
    //$					= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $kode				= isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : '';
    $tanggal				= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $nama				= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $kenaikan_ke			= isset($_POST['kenaikan_ke']) ? mysql_real_escape_string(trim($_POST['kenaikan_ke'])) : '';
    $level_gaji				= isset($_POST['level_gaji']) ? mysql_real_escape_string(trim($_POST['level_gaji'])) : '';
    $selisih				= isset($_POST['selisih']) ? mysql_real_escape_string(trim($_POST['selisih'])) : '';
    $gaji_pokok_lama			= isset($_POST['gaji_pokok_lama']) ? mysql_real_escape_string(trim($_POST['gaji_pokok_lama'])) : '';
    $gaji_pokok_naik			= isset($_POST['gaji_pokok_naik']) ? mysql_real_escape_string(trim($_POST['gaji_pokok_naik'])) : '';
    $tunjangan_jabatan_lama		= isset($_POST['tunjangan_jabatan_lama']) ? mysql_real_escape_string(trim($_POST['tunjangan_jabatan_lama'])) : '';
    $tunjangan_jabatan_naik		= isset($_POST['tunjangan_jabatan_naik']) ? mysql_real_escape_string(trim($_POST['tunjangan_jabatan_naik'])) : '';
    $dana_pensiun_lama			= isset($_POST['dana_pensiun_lama']) ? mysql_real_escape_string(trim($_POST['dana_pensiun_lama'])) : '';
    $dana_pensiun_naik			= isset($_POST['dana_pensiun_naik']) ? mysql_real_escape_string(trim($_POST['dana_pensiun_naik'])) : '';
    $jamsostek_lama			= isset($_POST['jamsostek_lama']) ? mysql_real_escape_string(trim($_POST['jamsostek_lama'])) : '';
    $jamsostek_naik			= isset($_POST['jamsostek_naik']) ? mysql_real_escape_string(trim($_POST['jamsostek_naik'])) : '';
    $insentif_hadir_lama		= isset($_POST['insentif_hadir_lama']) ? mysql_real_escape_string(trim($_POST['insentif_hadir_lama'])) : '';
    $insentif_hadir_naik		= isset($_POST['insentif_hadir_naik']) ? mysql_real_escape_string(trim($_POST['insentif_hadir_naik'])) : '';
    $total_gaji_lama			= isset($_POST['total_gaji_lama']) ? mysql_real_escape_string(trim($_POST['total_gaji_lama'])) : '';
    $total_gaji_naik			= isset($_POST['total_gaji_naik']) ? mysql_real_escape_string(trim($_POST['total_gaji_naik'])) : '';
    $remarks				= isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';
    $username 				= $loggedin["username"];	
	
    $sql_update = "UPDATE `gx_master_acc_kenaikan_gaji` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_acc_kenaikan_gaji` = '".$id_acc_kenaikan_gaji."';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "INSERT INTO `gx_master_acc_kenaikan_gaji`(`id`, `id_acc_kenaikan_gaji`, `no_acc_kenaikan_gaji`, `no_kenaikan_gaji`, `kode`, `tanggal`, `nama`, `kenaikan_ke`, `level_gaji`, `selisih`, `gaji_pokok_lama`, `gaji_pokok_naik`, `tunjangan_jabatan_lama`, `tunjangan_jabatan_naik`, `dana_pensiun_lama`, `dana_pensiun_naik`, `jamsostek_lama`, `jamsostek_naik`, `insentif_hadir_lama`, `insentif_hadir_naik`, `total_gaji_lama`, `total_gaji_naik`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL,'".$id_acc_kenaikan_gaji."','".$no_acc_kenaikan_gaji."','".$no_kenaikan_gaji."','".$kode."','".$tanggal."','".$nama."','".$kenaikan_ke."','".$level_gaji."','".$selisih."','".$gaji_pokok_lama."','".$gaji_pokok_naik."','".$tunjangan_jabatan_lama."','".$tunjangan_jabatan_naik."','".$dana_pensiun_lama."','".$dana_pensiun_naik."','".$jamsostek_lama."','".$jamsostek_naik."','".$insentif_hadir_lama."','".$insentif_hadir_naik."','".$total_gaji_lama."','".$total_gaji_naik."','".$remarks."',NOW(),NOW(),'".$username."','".$username."','0')";                                   
    
    //echo $sql_insert;
    mysql_query($sql_insert_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");

	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_update);
    

    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/master_acc_kenaikan_gaji.php';
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

    $title	= 'ACC Kenaikan Gaji';
    $submenu	= "acc_kenaikan_gaji";
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