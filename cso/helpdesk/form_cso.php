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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
  enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Profile");
  global $conn;
$id_cso = $_GET['k'];
if(isset($_POST["update"]))
{
    $status		= isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '';
    
	
		$sql_update_pegawai = "UPDATE `gx_pegawai` SET `aktif` = '".$status."', `level` = '1',
				`user_upd` = '$loggedin[username]', `date_upd` = NOW()
				WHERE `kode_pegawai` = '".$id_cso."';";
		//echo $sql_update_staff;
		mysql_query($sql_update_pegawai, $conn) or die (mysql_error());
		
		$sql_update_loginpegawai = "UPDATE `gxLogin_admin` SET `level` = '1',
				`user_upd` = '$loggedin[username]', `date_upd` = NOW()
				WHERE `id_employee` = '".$id_cso."';";
		//echo $sql_update_staff;
		mysql_query($sql_update_loginpegawai, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_pegawai);
		
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='list_cso.php';
	</script>";
	
}

	$sql_profile = mysql_query("SELECT * FROM `gx_pegawai` WHERE `kode_pegawai` = '".$id_cso."' AND `level` = '0' LIMIT 0,1;", $conn);
	$row_provider = mysql_fetch_array($sql_profile);	


    
    $content ='<section class="content-header">
                    <h1>
                       Update CSO
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-7"> 
							<div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Form Profile</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
									
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Nama</label>
											</div>
											<div class="col-xs-8">
												<input type="text" readonly="" class="form-control" name="nama" value="'.$row_provider["nama"].'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Email</label>
											</div>
											<div class="col-xs-8">
												<input type="text" readonly="" class="form-control" name="alamat" value="'. $row_provider["email"].'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Bagian</label>
											</div>
											<div class="col-xs-8">
												<input type="text" readonly="" class="form-control" name="kota" value="'. $row_provider["id_bagian"].'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>No Telp</label>
											</div>
											<div class="col-xs-8">
												<input type="text" readonly="" class="form-control" name="no_telp" value="'.$row_provider["hp"].'">
											</div>
										</div>
										</div>
										
                                        <div class="form-group">
											<div class="row">
												<div class="col-xs-4">
													<label>Status</label>
												</div>
												<div class="col-xs-8">
													<select name="status">
													  <option '.(($row_provider['aktif'] == "0") ? "selected" : '').' value="0">Active</option>
													  <option '.( ($row_provider['aktif'] == "1") ? "selected" : '').' value="1">Non Active</option>
													</select>
												</div>
											</div>
										</div>
                                    </div><!-- /.box-body -->
									
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" name="update" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->
				</div>
			</section>
            ';

$plugins = '<script type="text/javascript">
function readURL(input) {
    if (input.files && input.files[0]) {
	var reader = new FileReader();

	reader.onload = function (e) {
	    $(\'#preview\')
		.attr(\'src\', e.target.result)
		.width(250);
	};

	reader.readAsDataURL(input.files[0]);
    }
}
</script>';

    $title	= 'Form Profile';
    $submenu	= "profile";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
	}
    } else{
	header("location: ".URL_CSO."logout.php");
    }

?>