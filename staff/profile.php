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
if($loggedin = logged_inStaff()){ // Check if they are logged in
if($loggedin["group"] == 'staff'){
  enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Profile");
  global $conn;
  
  $sql_profile = mysql_query("SELECT * FROM `gx_pegawai` WHERE `id_employee` = '".$loggedin["id_employee"]."' AND `level` = '0' LIMIT 0,1;", $conn);
  $row_profile = mysql_fetch_array($sql_profile);
    
    
    $content ='<!-- Main content -->
                <section class="content">
		    <div class="row">
			<section class="col-lg-7"> 
			    <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Profile </h3>
                                    
                                </div>
                                <div class="box-body">
                                    <div class="box-body no-padding">
					<table class="table no-border" width="70%">
					    <tr>
						<td rowspan="8"><img src="'.URL_ADMIN.'img/staff/'.$row_profile['pic_profile'].'" width="160px" class="img-square" alt="User Image" /></td>
						<td>Nama </td>
						<td>'.$row_profile["nama"].'</td>
					    </tr>
					    <tr>
						<td>Alamat</td>
						<td>'.$row_profile["alamat"].'<br>
						Kota:'.$row_profile["kota"].'<br>
						
						</td>
					    </tr>
					    <tr>
						<td>
					    </tr>
					    <tr>
						<td>No. Telpon</td>
						<td>'.$row_profile["hp"].'</td>
					    </tr>
					    <tr>
						<td>Agama</td>
						<td>'.$row_profile["agama"].'</td>
					    </tr>
					    <tr>
						<td>NIK</td>
						<td>'.$row_profile["nik"].'</td>
					    </tr>
					    <tr>
						<td>Kode Pegawai</td>
						<td>'.$row_profile["kode_pegawai"].'</td>
					    </tr>
					    <tr>
						<td>Email</td>
						<td>'.$row_profile["email"].'</td>
					    </tr>
					    <tr>
						<td></td>
						<td colspan="2">
						  <a href="form_profile.php" class="btn bg-maroon btn-flat margin">Update</a>
						  <a href="form_ganti_password.php" class="btn bg-maroon btn-flat margin">Ganti Password</a>
						  
						</td>
					    </tr>
					    
					</table>
				    </div>
				</div><!-- /.box-body -->
				
			    </div>
			</section>
			<!--<section class="col-lg-5"> 
			    <div class="box box-solid box-info">
				<div class="box-header">
				    <h3 class="box-title">Saldo anda Rp. 100.000,00 </h3>
				    
				</div>
				
			    </div>
			    <div class="box box-solid box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-bar-chart-o"></i>  Status Data/Internet</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    
                                </div>
                            </div>
			    <div class="box box-solid box-danger">
				<div class="box-header">
				    <h3 class="box-title"><i class="fa fa-phone-square"></i>  VOIP</h3>
				    
				</div>
				<div class="box-body">
				    <div class="box-body no-padding">
				    
				    </div>
				</div>
			    </div>
			    <div class="box box-solid box-warning">
				<div class="box-header">
				    <h3 class="box-title"><i class="fa fa-laptop"></i>  VOD</h3>
				    
				</div>
				<div class="box-body">
				    <div class="box-body no-padding">
				    -
				    </div>
				</div>
			    </div>
			</section>-->
		    </div>
		</section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Profile';
    $submenu	= "profile";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    
	$template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$loggedin["id_bagian"]);
    
    echo $template;
}
    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>