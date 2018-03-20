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
if($loggedin["group"] == 'admin'){
if(isset($_GET['form'])){
    if($_GET['form'] == 'paket'){    
$id_paket        = isset($_GET['id_paket']) ? $_GET['id_paket'] : '0';
$data_edit_paket = mysql_fetch_array(mysql_query("SELECT * FROM `gxPaket` WHERE `id_paket`='$id_paket'", $conn));

if(isset($_POST['send'])){
$id_cabang 	= isset($_POST['id_cabang']) ? $_POST['id_cabang'] : '';
$id_type	= isset($_POST['id_type']) ? $_POST['id_type'] : '';
$nama_paket	= isset($_POST['nama_paket']) ? $_POST['nama_paket'] : '';
$bw_paket	= isset($_POST['bw_paket']) ? $_POST['bw_paket'] : '';
$sla_paket	= isset($_POST['sla_paket']) ? $_POST{'sla_paket'} : '';
$periode_paket	= isset($_POST['periode_paket']) ? $_POST['periode_paket'] : '';
$grace_periode	= isset($_POST['grace_periode']) ? $_POST['grace_periode'] : '';
$harga_paket	= isset($_POST['harga_paket']) ? $_POST['harga_paket'] : '';
$abonemen_paket	= isset($_POST['abonemen_paket']) ? $_POST['abonemen_paket'] : '';
$pulsa_paket 	= isset($_POST['pulsa_paket']) ? $_POST['pulsa_paket'] : '';
$level		= isset($_POST['level']) ? $_POST['level'] : '';
$id_insert	= isset($_POST['id_insert']) ? $_POST['id_insert'] : '';
$id_update	= isset($_POST['id_update']) ? $_POST['id_update'] : '';

mysql_query("UPDATE `gxPaket` SET `id_paket`='$id_paket',`id_cabang`='$id_cabang',`id_type`='$id_type',`nama_paket`='$nama_paket',`bw_paket`='$bw_paket',`sla_paket`='$sla_paket',`periode_paket`='$periode_paket',`grace_periode`='$grace_periode',`harga_paket`='$harga_paket',`abonemen_paket`='$abonemen_paket',`pulsa_paket`='$pulsa_paket',`date_upd`=NOW(),`level`='$level',`id_insert`='$id_insert',`id_update`='id_update' WHERE `id_paket` = '$id_paket'", $conn);
header('location:?form=paket&id_paket='.$id_paket.'');
}    
    $content ='<section class="content-header">
                    <h1>
                        Paket
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="master_paket">Paket</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Paket</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="?form=paket&id_paket='.$id_paket.'">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Paket</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Paket" name="nama_paket" value="'.$data_edit_paket['nama_paket'].'">
                                        </div>
                                        <div class="form-group">
                                            <label>Cabang</label>
                                            <select class="form-control" name="id_cabang">
                                                ';
						$sql_gxCabang = mysql_query("SELECT * FROM `gxCabang` ORDER BY `nama_cabang` ASC", $conn);
						while($r_gxcabang = mysql_fetch_array($sql_gxCabang)){
						    if($r_gxcabang['id_cabang'] == $data_edit_paket['id_cabang']){
                                                    $content .= '<option value="'.$r_gxcabang['id_cabang'].'" selected>'.$r_gxcabang['nama_cabang'].'</option>';
                                                    }else{
                                                    $content .= '<option value="'.$r_gxcabang['id_cabang'].'">'.$r_gxcabang['nama_cabang'].'</option>';    
                                                    }
                                                }
						
						
						$content .= '
                                            </select>
                                        </div>
					<div class="form-group">
                                            <label>Type</label>
                                            <select class="form-control" name="id_type"> ';
						$sql_gxTipe = mysql_query("SELECT * FROM `gxTipe` ORDER BY `nama_type` ASC", $conn);
						while($r_gxTipe = mysql_fetch_array($sql_gxTipe)){
						    if($r_gxTipe['id_type'] == $data_edit_paket['id_type']){
                                                        $content .= '<option value="'.$r_gxTipe['id_type'].'" selected>'.$r_gxTipe['nama_type'].'</option>';
                                                    }else{
                                                        $content .= '<option value="'.$r_gxTipe['id_type'].'">'.$r_gxTipe['nama_type'].'</option>';
                                                    }
						}
                                            $content .= '</select>
                                        </div>
					<div class="form-group">
                                            <label for="exampleInputEmail1">Periode</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Periode" name="periode_paket" value="'.$data_edit_paket['periode_paket'].'">
                                        </div>
					<div class="form-group">
                                            <label for="exampleInputEmail1">Harga</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Harga" name="harga_paket" value="'.$data_edit_paket['harga_paket'].'">
                                        </div>
					<div class="form-group">
                                            <label for="exampleInputEmail1">SLA</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="SLA" name="sla_paket" value="'.$data_edit_paket['sla_paket'].'">
                                        </div>
					<div class="form-group">
                                            <label for="exampleInputEmail1">Bandwidth</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Bandwidth" name="bw_paket" value="'.$data_edit_paket['bw_paket'].'">
                                        </div>
					<div class="form-group">
                                            <label for="exampleInputEmail1">Grace Periode</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="GracePeriode" name="grace_periode" value="'.$data_edit_paket['grace_periode'].'">
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="send" class="btn btn-primary">Submit</button>
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

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>
	
    ';
    }
    
    
    
    
    elseif($_GET['form'] == 'cabang'){    
$id_cabang        = isset($_GET['id_cabang']) ? $_GET['id_cabang'] : '0';
$data_edit_cabang = mysql_fetch_array(mysql_query("SELECT * FROM `gxCabang` WHERE `id_cabang`='$id_cabang'", $conn));

if(isset($_POST['send'])){
$id_cabang 	= isset($_GET['id_cabang']) ? $_GET['id_cabang'] : '';
$nama_cabang	= isset($_POST['nama_cabang']) ? $_POST['nama_cabang'] : '';
$alamat_cabang	= isset($_POST['alamat_cabang']) ? $_POST['alamat_cabang'] : '';
$kota_cabang	= isset($_POST['kota_cabang']) ? $_POST['kota_cabang'] : '';
$telp_cabang	= isset($_POST['telp_cabang']) ? $_POST['telp_cabang'] : '';
$date_add	= isset($_POST['date_add']) ? $_POST['date_add'] : '';
$date_upd	= isset($_POST['date_upd']) ? $_POST['date_upd'] : '';
$level		= isset($_POST['level']) ? $_POST['level'] : '';
$id_insert	= isset($_POST['id_insert']) ? $_POST['id_insert'] : 'Admin';
$id_update	= isset($_POST['id_update']) ? $_POST['id_update'] : 'Admin';

mysql_query("UPDATE `gxCabang` SET `id_cabang`='$id_cabang',`nama_cabang`='$nama_cabang',`alamat_cabang`='$alamat_cabang',`kota_cabang`='$kota_cabang',`telp_cabang`='$telp_cabang',`date_add`='$date_add',`date_upd`='$date_upd',`level`='$level',`id_insert`='$id_insert',`id_update`='$id_update' WHERE `id_cabang`='$id_cabang'", $conn);
header('location:?form=cabang&id_cabang='.$id_cabang.'');
}    
    $content ='<section class="content-header">
                    <h1>
                        Paket
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="master_paket">Paket</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Paket</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="?form=cabang&id_cabang='.$id_cabang.'">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Cabang</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Cabang" name="nama_cabang" value="'.$data_edit_cabang['nama_cabang'].'">
                                        </div>
					<div class="form-group">
                                            <label for="exampleInputEmail1">Alamat</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Alamat" name="alamat_cabang" value="'.$data_edit_cabang['alamat_cabang'].'">
                                        </div>
					<div class="form-group">
                                            <label for="exampleInputEmail1">Kota</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Kota" name="kota_cabang" value="'.$data_edit_cabang['kota_cabang'].'">
                                        </div>
					<div class="form-group">
                                            <label for="exampleInputEmail1">No Telpon</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="No Telp" name="telp_cabang" value="'.$data_edit_cabang['telp_cabang'].'">
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="send" class="btn btn-primary">Submit</button>
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

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>
	
    ';
    }    
}else{}    
    

    $title	= 'Master Paket';
    $submenu	= "paket";
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