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
if($loggedin = logged_inAdmin())
{ // Check if they are logged in

    if($loggedin["group"] == 'admin')
    {
	global $conn;
    
if(isset($_POST["save"]))
{
    $id_cabang 	= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $id_type	= isset($_POST['id_type']) ? mysql_real_escape_string(trim($_POST['id_type'])) : '';
    $nama_paket	= isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
    $bw_paket	= isset($_POST['bw_paket']) ? mysql_real_escape_string(trim($_POST['bw_paket'])) : '';
    $sla_paket	= isset($_POST['sla_paket']) ? mysql_real_escape_string(trim($_POST['sla_paket'])) : '';
    $periode_paket	= isset($_POST['periode_paket']) ? mysql_real_escape_string(trim($_POST['periode_paket'])) : '';
    $grace_periode	= isset($_POST['grace_periode']) ? mysql_real_escape_string(trim($_POST['grace_periode'])) : '';
    $harga_paket	= isset($_POST['harga_paket']) ? mysql_real_escape_string(trim($_POST['harga_paket'])) : '';
    $abonemen_paket	= isset($_POST['abonemen_paket']) ? mysql_real_escape_string(trim($_POST['abonemen_paket'])) : '';
    $pulsa_paket 	= isset($_POST['pulsa_paket']) ? mysql_real_escape_string(trim($_POST['pulsa_paket'])) : '';
    
    //insert into gxPaket
    $sql_insert = "INSERT INTO `gxPaket` (`id_paket`, `id_cabang`, `id_type`, `nama_paket`, `bw_paket`,
		    `sla_paket`, `periode_paket`, `grace_periode`, `harga_paket`, `abonemen_paket`,
		    `pulsa_paket`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
		    VALUES (NULL, '".$id_cabang."', '".$id_type."', '".$nama_paket."', '".$bw_paket."',
		    '".$sla_paket."', '".$periode_paket."', '".$grace_periode."', '".$harga_paket."', '".$abonemen_paket."',
		    '".$pulsa_paket."', NOW(), NOW(), '0', '".$loggedin["username"]."', '".$loggedin["username"]."');";                    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master_paket.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id_paket   = isset($_POST['id_paket']) ? mysql_real_escape_string(trim($_POST['id_paket'])) : '';
    $id_cabang 	= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $id_type	= isset($_POST['id_type']) ? mysql_real_escape_string(trim($_POST['id_type'])) : '';
    $nama_paket	= isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
    $bw_paket	= isset($_POST['bw_paket']) ? mysql_real_escape_string(trim($_POST['bw_paket'])) : '';
    $sla_paket	= isset($_POST['sla_paket']) ? mysql_real_escape_string(trim($_POST['sla_paket'])) : '';
    $periode_paket	= isset($_POST['periode_paket']) ? mysql_real_escape_string(trim($_POST['periode_paket'])) : '';
    $grace_periode	= isset($_POST['grace_periode']) ? mysql_real_escape_string(trim($_POST['grace_periode'])) : '';
    $harga_paket	= isset($_POST['harga_paket']) ? mysql_real_escape_string(trim($_POST['harga_paket'])) : '';
    $abonemen_paket	= isset($_POST['abonemen_paket']) ? mysql_real_escape_string(trim($_POST['abonemen_paket'])) : '';
    $pulsa_paket 	= isset($_POST['pulsa_paket']) ? mysql_real_escape_string(trim($_POST['pulsa_paket'])) : '';
    
    
    //update gxPaket
    mysql_query("", $conn);
    
    $sql_update = "UPDATE `gxPaket` SET `id_cabang` = '".$id_cabang."', `id_type` = '".$id_type."', `nama_paket` = '".$nama_paket."',
		    `bw_paket` = '".$bw_paket."', `sla_paket` = '".$sla_paket."', `periode_paket` = '".$periode_paket."',
		    `grace_periode` = '".$grace_periode."', `harga_paket` = '".$harga_paket."',
		    `abonemen_paket` = '".$abonemen_paket."', `pulsa_paket` = '".$pulsa_paket."', `date_upd` = NOW(), `user_upd`= '".$location["username"]."'
		   WHERE `id_paket` = '$id_paket';";
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."master_paket.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_paket		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_paket 	= "SELECT * FROM `gxPaket` WHERE `id_paket`='$id_paket' LIMIT 0,1;";
    $sql_paket 		= mysql_query($query_paket, $conn);
    $row_paket 		= mysql_fetch_array($sql_paket);
    
}


    $content ='<section class="content-header">
                    <h1>
                        Form Paket
                        
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
                                <form role="form" method="POST" action="">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Nama Paket</label>
                                            <input type="text" class="form-control" placeholder="Nama Paket" name="nama_paket" value="'.(isset($_GET['id']) ? $row_paket["nama_paket"] : "").'">
					    '.(isset($_GET['id']) ? '<input type="hidden" name="id_paket" value="'.$id_paket.'">' : "").'
                                        </div>
                                        <div class="form-group">
                                            <label>Cabang</label>
                                            <select class="form-control" name="id_cabang">';
					    
$sql_gxCabang = mysql_query("SELECT * FROM `gxCabang` ORDER BY `nama_cabang` ASC", $conn);
while($row_gxcabang = mysql_fetch_array($sql_gxCabang)){
    $selected = isset($_GET["id"]) ? $row_paket["id_cabang"] : "";
    $selected = ($selected == $row_gxcabang["id_cabang"]) ? ' selected=""' : "";
    
    $content .= '<option value="'.$row_gxcabang["id_cabang"].'" '.$selected.'>'.$row_gxcabang["nama_cabang"].'</option>';
    
}
						
						
						$content .= '
                                            </select>
                                        </div>
					<div class="form-group">
                                            <label>Type</label>
                                            <select class="form-control" name="id_type">';
$sql_gxTipe = mysql_query("SELECT * FROM `gxTipe` ORDER BY `nama_type` ASC", $conn);
while($row_gxTipe = mysql_fetch_array($sql_gxTipe)){
    $selected = isset($_GET["id"]) ? $row_paket["id_type"] : "";
    $selected = ($selected == $row_gxTipe["id_type"]) ? ' selected=""' : "";
    $content .= '<option value="'.$row_gxTipe["id_type"].'" '.$selected.'>'.$row_gxTipe["nama_type"].'</option>';
    
}
                                            $content .= '</select>
                                        </div>
					<div class="form-group">
                                            <label>Periode</label>
                                            <input type="text" class="form-control" placeholder="Periode" name="periode_paket" value="'.(isset($_GET['id']) ? $row_paket["periode_paket"] : "").'">
                                        </div>
					<div class="form-group">
                                            <label>Harga</label>
                                            <input type="text" class="form-control" placeholder="Harga" name="harga_paket" value="'.(isset($_GET['id']) ? $row_paket["harga_paket"] : "").'">
                                        </div>
					<div class="form-group">
                                            <label>SLA</label>
                                            <input type="text" class="form-control" placeholder="SLA" name="sla_paket" value="'.(isset($_GET['id']) ? $row_paket["sla_paket"] : "").'">
                                        </div>
					<div class="form-group">
                                            <label>Bandwidth</label>
                                            <input type="text" class="form-control" placeholder="Bandwidth" name="bw_paket" value="'.(isset($_GET['id']) ? $row_paket["bw_paket"] : "").'">
                                        </div>
					<div class="form-group">
                                            <label>Grace Periode</label>
                                            <input type="text" class="form-control" placeholder="GracePeriode" name="grace_periode" value="'.(isset($_GET['id']) ? $row_paket["grace_periode"] : "").'">
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
    
    
    $title	= 'Form Paket';
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