<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
    
if(isset($_POST["save"]))
{
    
    $nama_kendaraan    	= isset($_POST['nama_kendaraan']) ? mysql_real_escape_string(trim($_POST['nama_kendaraan'])) : '';
    $nopol_kendaraan  	= isset($_POST['nopol_kendaraan']) ? mysql_real_escape_string(trim($_POST['nopol_kendaraan'])) : '';
    $jenis_kendaraan    = isset($_POST['jenis_kendaraan']) ? mysql_real_escape_string(trim($_POST['jenis_kendaraan'])) : '';
    $tahun_kendaraan   	= isset($_POST['tahun_kendaraan']) ? mysql_real_escape_string(trim($_POST['tahun_kendaraan'])) : '';
    $ket_kendaraan   	= isset($_POST['ket_kendaraan']) ? mysql_real_escape_string(trim($_POST['ket_kendaraan'])) : '';
    $id_cabang	 	= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';

    //insert into gxCabang
    $sql_insert = "INSERT INTO `gx_kendaraan` (`id_kendaraan`, `nama_kendaraan`, `nopol_kendaraan`, `jenis_kendaraan`,
                    `id_cabang`, `tahun_kendaraan`, `keterangan_kendaraan`, `date_add`, `date_upd`,
		    `level`, `user_add`, `user_upd`)
		    VALUES (NULL, '".$nama_kendaraan."', '".$nopol_kendaraan."', '".$jenis_kendaraan."',
		    '".$id_cabang."', '".$tahun_kendaraan."', '".$ket_kendaraan."',
		    NOW(), NOW(), '0', '".$loggedin["username"]."', '".$loggedin["username"]."');";                    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master/master_kendaraan.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    
    $id_kendaraan 	= isset($_POST['id_kendaraan']) ? mysql_real_escape_string(trim($_POST['id_kendaraan'])) : '';
    $id_cabang	 	= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $nama_kendaraan    	= isset($_POST['nama_kendaraan']) ? mysql_real_escape_string(trim($_POST['nama_kendaraan'])) : '';
    $nopol_kendaraan  	= isset($_POST['nopol_kendaraan']) ? mysql_real_escape_string(trim($_POST['nopol_kendaraan'])) : '';
    $jenis_kendaraan    = isset($_POST['jenis_kendaraan']) ? mysql_real_escape_string(trim($_POST['jenis_kendaraan'])) : '';
    $tahun_kendaraan   	= isset($_POST['tahun_kendaraan']) ? mysql_real_escape_string(trim($_POST['tahun_kendaraan'])) : '';
    $ket_kendaraan   	= isset($_POST['ket_kendaraan']) ? mysql_real_escape_string(trim($_POST['ket_kendaraan'])) : '';

    
    //update gxPaket
    $sql_update = "UPDATE `gx_kendaraan` SET `level` = '1', 
                    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
                    WHERE `id_kendaraan` = '".$id_kendaraan."';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	//insert into gxCabang
    $sql_insert = "INSERT INTO `gx_kendaraan` (`id_kendaraan`, `nama_kendaraan`, `nopol_kendaraan`, `jenis_kendaraan`,
                    `id_cabang`, `tahun_kendaraan`, `keterangan_kendaraan`, `date_add`, `date_upd`,
		    `level`, `user_add`, `user_upd`)
		    VALUES (NULL, '".$nama_kendaraan."', '".$nopol_kendaraan."', '".$jenis_kendaraan."',
		    '".$id_cabang."', '".$tahun_kendaraan."', '".$ket_kendaraan."',
		    NOW(), NOW(), '0', '".$loggedin["username"]."', '".$loggedin["username"]."');";                    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."/master/master_kendaraan.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_kendaraan	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_kendaraan 	= "SELECT * FROM `gx_kendaraan` WHERE `id_kendaraan`='".$id_kendaraan."' AND `level` = '0' LIMIT 0,1;";
    $sql_kendaraan	= mysql_query($query_kendaraan, $conn);
    $row_kendaraan	= mysql_fetch_array($sql_kendaraan);
    
}
    $jenis_kendaraan = isset($_GET['id']) ? $row_kendaraan["jenis_kendaraan"] : "";
    
    $content ='<section class="content-header">
                    <h1>
                        Form Kendaraan
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Kendaraan</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="">
                                    <div class="box-body">
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Nama Kendaraan</label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" name="nama_kendaraan" value="'.(isset($_GET['id']) ? $row_kendaraan["nama_kendaraan"] : "").'">
						    '.(isset($_GET['id']) ? '<input type="hidden" name="id_kendaraan" value="'.$id_kendaraan.'">' : "").'
						</div>
					    </div>
                                        </div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-8">
						<select class="form-control" name="id_cabang">';

$sql_gxCabang = mysql_query("SELECT * FROM `gx_cabang` ORDER BY `nama_cabang` ASC", $conn);
while($row_gxcabang = mysql_fetch_array($sql_gxCabang)){
    $selected = isset($_GET["id"]) ? $row_kendaraan["id_cabang"] : "";
    $selected = ($selected == $row_gxcabang["id_cabang"]) ? ' selected=""' : "";
    
    $content .= '<option value="'.$row_gxcabang["id_cabang"].'" '.$selected.'>'.$row_gxcabang["nama_cabang"].'</option>';
    
}
						
						
						$content .= '
                                            </select>
					    </div>
					    
					    </div>
					</div>
                                        <div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Nopol Kendaraan</label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" name="nopol_kendaraan" value="'.(isset($_GET['id']) ? $row_kendaraan["nopol_kendaraan"] : "").'">
						</div>
					    </div>
                                        </div>
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Tahun Kendaraan</label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" name="tahun_kendaraan" value="'.(isset($_GET['id']) ? $row_kendaraan["tahun_kendaraan"] : "").'">
						</div>
					    </div>
                                        </div>
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Jenis Kendaraan</label>
						</div>
						<div class="col-xs-8">
						    <input type="radio" name="jenis_kendaraan" value="R2" '.(($jenis_kendaraan == "R2") ? ' checked=""': "").'/>Roda 2
						    <input type="radio" name="jenis_kendaraan" value="R4" '.(($jenis_kendaraan == "R4") ? ' checked=""': "").'/>Roda 4
						    
						</div>
					    </div>
                                        </div>
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Keterangan</label>
						</div>
						<div class="col-xs-8">
						    <textarea name="ket_kendaraan" class="form-control">'.(isset($_GET['id']) ? $row_kendaraan["keterangan_kendaraan"] : "").'</textarea>
						</div>
					    </div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Kendaraan';
    $submenu	= "master_kendaraan";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>