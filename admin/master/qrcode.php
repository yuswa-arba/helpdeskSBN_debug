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
if($loggedin["group"] == 'admin'){
    
    global $conn;
    
	//paging
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }

if(isset($_POST["search"])){
    $nama		= isset($_POST["nama"]) ? trim(strip_tags($_POST["nama"])) : "";
    $email		= isset($_POST["email"]) ? trim(strip_tags($_POST["email"])) : "";
    
	$sql_nama		= ($nama != "") ? "AND `nama` LIKE '%$nama%'" : "";
    $sql_email		= ($email != "") ? "AND `email` LIKE '%$email%'" : "";
    
    
	$sql_staff = "SELECT *
			FROM `gx_pegawai`
			WHERE `gx_pegawai`.`id_employee` <> 2 AND `gx_pegawai`.`level` = '0'
			$sql_nama
			$sql_email
					ORDER BY `gx_pegawai`.`nama` ASC, `gx_pegawai`.`level` ASC LIMIT $start, $perhalaman;";
	
	$sql_total_staff = mysql_num_rows(mysql_query("SELECT *
			FROM `gx_pegawai`
			WHERE `gx_pegawai`.`id_employee` <> 2 AND `gx_pegawai`.`level` = '0'
			$sql_nama
			$sql_email
			ORDER BY `gx_pegawai`.`nama` ASC, `gx_pegawai`.`level` ASC;", $conn));
	//echo $sql_staff;
	$query_staff = mysql_query($sql_staff, $conn);
    
    $hal= "?n=$nama&e=$email&";
    
}else{
	$hal = "?";
	
	$sql_staff = "SELECT *
			FROM `gx_pegawai`
			WHERE `gx_pegawai`.`id_employee` <> 2 AND `gx_pegawai`.`level` = '0'
					ORDER BY `gx_pegawai`.`nama` ASC, `gx_pegawai`.`level` ASC ;";
	
	$sql_total_staff = mysql_num_rows(mysql_query("SELECT *
			FROM `gx_pegawai`
			WHERE `gx_pegawai`.`id_employee` <> 2 AND `gx_pegawai`.`level` = '0'
			ORDER BY `gx_pegawai`.`nama` ASC, `gx_pegawai`.`level` ASC;", $conn));
	//echo $sql_staff;
	$query_staff = mysql_query($sql_staff, $conn);

}

if(isset($_GET["n"])){
    $nama		= isset($_GET["n"]) ? trim(strip_tags($_GET["n"])) : "";
    $email		= isset($_GET["e"]) ? trim(strip_tags($_GET["e"])) : "";
    
	$sql_nama		= ($nama != "") ? "AND `nama` LIKE '%$nama%'" : "";
    $sql_email		= ($email != "") ? "AND `email` LIKE '%$email%'" : "";
    
    
	$sql_staff = "SELECT *
			FROM `gx_pegawai`
			WHERE `gx_pegawai`.`id_employee` <> 2 AND `gx_pegawai`.`level` = '0'
			$sql_nama
			$sql_email
					ORDER BY `gx_pegawai`.`nama` ASC, `gx_pegawai`.`level` ASC LIMIT $start, $perhalaman;";
	
	$sql_total_staff = mysql_num_rows(mysql_query("SELECT *
			FROM `gx_pegawai`
			WHERE `gx_pegawai`.`id_employee` <> 2 AND `gx_pegawai`.`level` = '0'
			$sql_nama
			$sql_email
			ORDER BY `gx_pegawai`.`nama` ASC, `gx_pegawai`.`level` ASC;", $conn));
	//echo $sql_staff;
	$query_staff = mysql_query($sql_staff, $conn);
    
    $hal= "?n=$nama&e=$email&";
    
}
    $content ='<section class="content-header">
                    <h1>
                        List Staff
                        
                    </h1>
                    
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Search</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								
								<form action="" method="post" name="form_search">
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>Nama</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" type="text" name="nama">
					</div>
					
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>Email :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" name="email" type="text">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    <input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
	</form>
	<hr>
								<div class="box-header">
                                    <h3 class="box-title">List Staff</h3>
									<a href="'.URL_ADMIN.'master/form_staff.php" class="btn bg-olive btn-flat margin pull-right">Add New</a>
                                </div><!-- /.box-header -->
								
                                    <table class="table table-bordered table-striped" id="staff" style="width: 100%;">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
											<th>NIK</th>
                                            <th>Bagian</th>
                                            <th>Cabang</th>
                                            <th>Email</th>
                                            <th>Phone</th>
											<th>Status</th>
											<th>QRCODE</th>
                                            <th>Actions</th>
                                        </tr>';

$no = $start + 1;
while($row_staff = mysql_fetch_array($query_staff))
{
	
	echo "INSERT INTO `software`.`gx_qrcode` (`id_qrcode`, `kode_pegawai`, `qrcode`, `date_add`, `user_add`, `level`)
	VALUES (NULL, '".$row_staff["kode_pegawai"]."', md5('".$row_staff["kode_pegawai"].'#'.$row_staff["nik"].'#'.$row_staff["email"]."'), NOW(), 'generate', '0');<br>";
	
    if($row_staff["level"] == "1")
    {
        $status = '<span class="label label-danger">Nonaktif</span>';
    }elseif($row_staff["level"] == "0")
    {
        $status = '<span class="label label-success">Aktif</span>';
    }
    
    $sql_cabang = "SELECT *
		FROM `gx_cabang` 
                WHERE `id_cabang` = '".$row_staff["id_cabang"]."'
		AND `level` = '0'
		LIMIT 0,1;";
    $query_cabang = mysql_query($sql_cabang, $conn);
    $row_cabang = mysql_fetch_array($query_cabang);
    
    $content .='<tr>
                    <td>'.$no.'.</td>
                    <td>'.$row_staff["nama"].'</a></td>
					<td>'.$row_staff["nik"].'</a></td>
                    <td>'.$row_staff["id_bagian"].'</td>
                    <td>'.$row_cabang["nama_cabang"].'</td>
		    <td>'.$row_staff["email"].'</td>
		    <td>'.$row_staff["hp"].'</td>
			<td>'.(($row_staff["aktif"]== "0") ? "Aktif" : "Non-Aktif").'</td>
			<td>'.md5($row_staff["kode_pegawai"].'#'.$row_staff["nik"].'#'.$row_staff["email"]).'</td>
            <td><a href="'.URL_ADMIN.'master/detail_staff.php?id='.$row_staff["id_employee"].'">View</a> | 
		    <a href="'.URL_ADMIN.'master/form_staff.php?id='.$row_staff["id_employee"].'">Edit</a></td>
                </tr>';
    $no++;
}

$content .='
                                    </table>
				
                                </div><!-- /.box-body -->
								<div class="box-footer">
				   <div class="box-tools pull-right">
				   '.(halaman($sql_total_staff, $perhalaman, 1, $hal)).'
				   </div>
				   <br style="clear:both;">
				</div>
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'List Staff';
    $submenu	= "master_staff";
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