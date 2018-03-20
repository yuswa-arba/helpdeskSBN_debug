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
    
if(isset($_POST["update"]))
{
    $new_pass	= isset($_POST['new_pass']) ? mysql_real_escape_string(trim($_POST['new_pass'])) : '';
    $renew_pass	= isset($_POST['renew_pass']) ? mysql_real_escape_string(trim($_POST['renew_pass'])) : '';
	
	if($new_pass != "" && $renew_pass != "")
	{
		if($new_pass == $renew_pass)
		{
			//insert into gx_bagian
			$sql_update_provider = "UPDATE `software`.`gxLogin_admin` SET `password` = MD5('".$new_pass."'), `password_date` = NOW(),
			`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
			WHERE (`id_employee`='".$loggedin["kode_pegawai"]."');";
			
			//echo $sql_update_provider;
			mysql_query($sql_update_provider, $conn) or die (mysql_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_provider);
		   
			echo "<script language='JavaScript'>
			alert('Data telah diupdate.');
			window.location.href='profile.php';
			</script>";
		}
		else
		{
			echo "<script language='JavaScript'>
			alert('retype password harus sama.');
			window.location.href='form_ganti_password.php';
			</script>";
		}
	}
	else
	{
		echo "<script language='JavaScript'>
		alert('Data ada yang kosong.');
		window.location.href='form_ganti_password.php';
		</script>";
	}
	
}

	$sql_profile = mysql_query("SELECT * FROM `gx_pegawai` WHERE `id_employee` = '".$loggedin["id_employee"]."' AND `level` = '0' LIMIT 0,1;", $conn);
	$row_provider = mysql_fetch_array($sql_profile);	


    
    $content ='<section class="content-header">
                    <h1>
                       Profile
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-7"> 
							<div class="box box-solid box-info">
                            
                                <div class="box-header">
                                    <h3 class="box-title">Form Change Password</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
									
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>New Password</label>
											</div>
											<div class="col-xs-8">
												<input type="password" class="form-control" required="" name="new_pass" maxlength="20" value="">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Retype New Password</label>
											</div>
											<div class="col-xs-8">
												<input type="password" class="form-control" required="" name="renew_pass" maxlength="20" value="">
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
					</section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form change password';
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