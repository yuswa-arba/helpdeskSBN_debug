<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
    
if(isset($_POST["save"]))
{
    
    $nama_cabang    = isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $alamat_cabang  = isset($_POST['alamat_cabang']) ? mysql_real_escape_string(trim($_POST['alamat_cabang'])) : '';
    $kota_cabang    = isset($_POST['kota_cabang']) ? mysql_real_escape_string(trim($_POST['kota_cabang'])) : '';
    $telp_cabang    = isset($_POST['telp_cabang']) ? mysql_real_escape_string(trim($_POST['telp_cabang'])) : '';

    //insert into gxCabang
    $sql_insert = "INSERT INTO `gx_cabang` (id_cabang`, `nama_cabang`, `alamat_cabang`, `kota_cabang`,
                    `telp_cabang`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
		    VALUES (NULL, '".$nama_cabang."', '".$alamat_cabang."', '".$kota_cabang."', '".$telp_cabang."',
                    NOW(), NOW(), '0', '".$loggedin["username"]."', '".$loggedin["username"]."');";                    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master_cabang.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    
    $id_cabang 	= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $nama_cabang    = isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $alamat_cabang  = isset($_POST['alamat_cabang']) ? mysql_real_escape_string(trim($_POST['alamat_cabang'])) : '';
    $kota_cabang    = isset($_POST['kota_cabang']) ? mysql_real_escape_string(trim($_POST['kota_cabang'])) : '';
    $telp_cabang    = isset($_POST['telp_cabang']) ? mysql_real_escape_string(trim($_POST['telp_cabang'])) : '';

    
    //update gxPaket
    mysql_query("", $conn);
    
    $sql_update = "UPDATE `gx_cabang` SET `nama_cabang` = '".$nama_cabang."', `alamat_cabang` = '".$alamat_cabang."',
                    `kota_cabang` = '".$kota_cabang."', `telp_cabang` = '".$telp_cabang."',
                    `date_upd` = NOW(), `user_upd`= '".$location["username"]."'
                    WHERE `id_cabang` = '".$id_cabang."';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."master_cabang.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_cabang		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_cabang 	= "SELECT * FROM `gx_cabang` WHERE `id_cabang`='$id_cabang' LIMIT 0,1;";
    $sql_cabang		= mysql_query($query_cabang, $conn);
    $row_cabang		= mysql_fetch_array($sql_cabang);
    
}
    
    $content ='<section class="content-header">
                    <h1>
                        Form Cabang
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="master_cabang">Cabang</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Cabang</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Cabang</label>
                                            <input type="text" class="form-control" placeholder="Nama Cabang" name="nama_cabang" value="'.(isset($_GET['id']) ? $row_cabang["nama_cabang"] : "").'">
					    '.(isset($_GET['id']) ? '<input type="hidden" name="id_cabang" value="'.$id_cabang.'">' : "").'
                                        </div>
					<div class="form-group">
                                            <label for="exampleInputEmail1">Alamat</label>
                                            <input type="text" class="form-control" placeholder="Alamat" name="alamat_cabang" value="'.(isset($_GET['id']) ? $row_cabang["alamat_cabang"] : "").'">
                                        </div>
					<div class="form-group">
                                            <label for="exampleInputEmail1">Kota</label>
                                            <input type="text" class="form-control" placeholder="Kota" name="kota_cabang" value="'.(isset($_GET['id']) ? $row_cabang["kota_cabang"] : "").'">
                                        </div>
					<div class="form-group">
                                            <label for="exampleInputEmail1">No Telpon</label>
                                            <input type="text" class="form-control" placeholder="No Telp" name="telp_cabang" value="'.(isset($_GET['id']) ? $row_cabang["telp_cabang"] : "").'">
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" value="'.(isset($_GET['id']) ? 'name="update"' : 'name="save"').'" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#customer\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

        
    ';

    $title	= 'Form Cabang';
    $submenu	= "cabang";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>