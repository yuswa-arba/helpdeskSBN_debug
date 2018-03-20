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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
    
    global $conn;
    
	$sql_supervisor = "SELECT `gxLogin_admin`.`supervisor` FROM `gxLogin_admin`, `gx_pegawai`
                WHERE `gxLogin_admin`.`id_employee` = `gx_pegawai`.`kode_pegawai`
				AND `gx_pegawai`.`id_employee` = '".$loggedin["id_employee"]."'
				AND `gx_pegawai`.`level` = '0' LIMIT 0,1;";
    $query_supervisor 	= mysql_query($sql_supervisor, $conn);
    $row_supervisor 	= mysql_fetch_array($query_supervisor);
	//echo $sql_supervisor;
	
	
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
			AND `id_cabang` = '".$loggedin["cabang"]."'
			AND `id_bagian` = 'CSO'  AND `aktif` = '0'
			$sql_nama
			$sql_email
					ORDER BY `gx_pegawai`.`nama` ASC, `gx_pegawai`.`level` ASC LIMIT $start, $perhalaman;";
	
	$sql_total_staff = mysql_num_rows(mysql_query("SELECT *
			FROM `gx_pegawai`
			WHERE `gx_pegawai`.`id_employee` <> 2 AND `gx_pegawai`.`level` = '0'
			AND `id_cabang` = '".$loggedin["cabang"]."'
			AND `id_bagian` = 'CSO' AND `aktif` = '0'
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
			AND `id_cabang` = '".$loggedin["cabang"]."'
			AND `id_bagian` = 'CSO' AND `aktif` = '0'
					ORDER BY `gx_pegawai`.`nama` ASC, `gx_pegawai`.`level` ASC LIMIT $start, $perhalaman;";
	
	$sql_total_staff = mysql_num_rows(mysql_query("SELECT *
			FROM `gx_pegawai`
			WHERE `gx_pegawai`.`id_employee` <> 2 AND `gx_pegawai`.`level` = '0'
			AND `id_cabang` = '".$loggedin["cabang"]."'
			AND `id_bagian` = 'CSO' AND `aktif` = '0'
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
			AND `id_cabang` = '".$loggedin["cabang"]."'
			AND `id_bagian` = 'CSO' AND `aktif` = '0'
			$sql_nama
			$sql_email
					ORDER BY `gx_pegawai`.`nama` ASC, `gx_pegawai`.`level` ASC LIMIT $start, $perhalaman;";
	
	$sql_total_staff = mysql_num_rows(mysql_query("SELECT *
			FROM `gx_pegawai`
			WHERE `gx_pegawai`.`id_employee` <> 2 AND `gx_pegawai`.`level` = '0'
			AND `id_cabang` = '".$loggedin["cabang"]."'
			AND `id_bagian` = 'CSO' AND `aktif` = '0'
			$sql_nama
			$sql_email
			ORDER BY `gx_pegawai`.`nama` ASC, `gx_pegawai`.`level` ASC;", $conn));
	//echo $sql_staff;
	$query_staff = mysql_query($sql_staff, $conn);
    
    $hal= "?n=$nama&e=$email&";
    
}
    $content ='<section class="content-header">
                    <h1>
                        List CSO
                        
                    </h1>
                    
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">';
						
if($row_supervisor["supervisor"] != "1")
{
	$content .='<div class="box">
					<div class="box-header">
						<h3 class="box-title">Search</h3>
					</div><!-- /.box-header -->
					<div class="box-body table-responsive">
						Sorry, you dont have access this page. back to  <a href="'.URL_CSO.'">home</a>.
					</div>';
}
else
{
	$content .='
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
                                </div><!-- /.box-header -->
								
                                    <table class="table table-bordered table-striped" id="staff" style="width: 100%;">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Bagian</th>
                                            <th>Email</th>
                                            <th>Phone</th>
											<th>Status</th>
                                            <th>Actions</th>
                                        </tr>';

$no = $start + 1;
while($row_staff = mysql_fetch_array($query_staff))
{
    if($row_staff["aktif"] == "1")
    {
        $status = '<span class="label label-danger">Nonaktif</span>';
    }elseif($row_staff["aktif"] == "0")
    {
        $status = '<span class="label label-success">Aktif</span>';
    }
    
  if($loggedin["id_level"] == "Kabag")
  {
    $content .='<tr>
                    <td>'.$no.'.</td>
                    <td>'.$row_staff["nama"].'</a></td>
                    <td>'.$row_staff["id_bagian"].'</td>
		    <td>'.$row_staff["email"].'</td>
		    <td>'.$row_staff["hp"].'</td>
			<td>'.$status.'</td>
            <td><a href="form_cso.php?k='.$row_staff["kode_pegawai"].'">edit</a></td>
                </tr>';
  }else{
	$content .='<tr>
                    <td>'.$no.'.</td>
                    <td>'.$row_staff["nama"].'</a></td>
                    <td>'.$row_staff["id_bagian"].'</td>
		    <td>'.$row_staff["email"].'</td>
		    <td>'.$row_staff["hp"].'</td>
			<td>'.$status.'</td>
            <td></td>
                </tr>';
  }
    $no++;
  }
}

$content .='
                                    </table>
				
                                </div><!-- /.box-body -->
								<div class="box-footer">
				   <div class="box-tools pull-right">
				   '.(halaman($sql_total_staff, $perhalaman, 1, $hal)).'
				   </div>
				   <br style="clear:both;">
				</div>';


$content .='
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'List CSO';
    $submenu	= "cso";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

}
    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>