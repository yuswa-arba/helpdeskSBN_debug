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
if($loggedin["group"] == 'admin'){


global $conn;

//log
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open Form OLT Customer");

if(isset($_GET["userid"]))
{
	$userid = $_GET["userid"];
	
	$sql_data = mysql_query("SELECT * FROM `tbCustomer`
				  WHERE `cUserID`='".$userid."' AND `level` = '0' ORDER BY `cUserID` ASC;", $conn);
	$row_data = mysql_fetch_array($sql_data);
	
	$conn_soft = Config::getInstanceSoft();
    $sql_data_rbs = $conn_soft->prepare("SELECT TOP 1 [dbo].[Users].[GroupName] FROM [dbo].[Users]
									WHERE [dbo].[Users].[UserID] = '".$row_data["cUserID"]."';");
    $sql_data_rbs->execute();
    
    $row_data_rbs = $sql_data_rbs->fetch(PDO::FETCH_ASSOC);
}

    $content =' <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Edit User</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    
                                    <form role="form" method="POST" action="">
										<div class="form-group">
											<div class="row">
												<div class="col-xs-4">
													<h5>Kode Customer</h5>
												</div>
												<div class="col-xs-4">
													<input type="text" readonly="" class="form-control" name="cKode" value="'.$row_data["cKode"].'">
													<input type="hidden" readonly="" class="form-control" name="iuserIndex" value="'.$row_data["iuserIndex"].'">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-4">
													<h5>Nama</h5>
												</div>
												<div class="col-xs-4">
													<input type="text" readonly="" class="form-control" name="cNama" value="'.$row_data["cKode"].'">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-4">
													<h5>UserID</h5>
												</div>
												<div class="col-xs-4">
													<input type="text" readonly="" class="form-control" name="cUserID" maxlength="4" value="'.$row_data["cUserID"].'">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-4">
													<h5>Bandwidth</h5>
												</div>
												<div class="col-xs-4">
													<select class="form-control" name="GroupName">
														<option value="h.10" '.(($row_data_rbs['GroupName'] == "h.10") ? "selected" : "").'>h.10</option>
														<option value="h.09" '.(($row_data_rbs['GroupName'] == "h.09") ? "selected" : "").'>h.09</option>
														<option value="h.08" '.(($row_data_rbs['GroupName'] == "h.08") ? "selected" : "").'>h.08</option>
														<option value="h.07" '.(($row_data_rbs['GroupName'] == "h.07") ? "selected" : "").'>h.07</option>
														<option value="h.06" '.(($row_data_rbs['GroupName'] == "h.06") ? "selected" : "").'>h.06</option>
														<option value="h.05" '.(($row_data_rbs['GroupName'] == "h.05") ? "selected" : "").'>h.05</option>
														<option value="h.04" '.(($row_data_rbs['GroupName'] == "h.04") ? "selected" : "").'>h.04</option>
														<option value="h.03" '.(($row_data_rbs['GroupName'] == "h.03") ? "selected" : "").'>h.03</option>
														<option value="h.02" '.(($row_data_rbs['GroupName'] == "h.02") ? "selected" : "").'>h.02</option>
														<option value="h.01" '.(($row_data_rbs['GroupName'] == "h.01") ? "selected" : "").'>h.01</option>
													</select>
												</div>
						
											</div>
										</div>
							
										<div class="form-group">
											<div class="row">
												
												<div class="col-xs-3">
													<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
												</div>
												
											</div>
                                        </div>
                                </form>
								
<hr>';
	
if(isset($_POST["submit"]))
{
	$GroupName	= isset($_POST['GroupName']) ? ($_POST['GroupName']) : '';
	$iuserIndex	= isset($_POST['iuserIndex']) ? ($_POST['iuserIndex']) : '';	
	
	$query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$GroupName."' WHERE [Users].[UserIndex] = '".$iuserIndex."'";
	$update_bw = $conn_soft->prepare($query_bw);
	$update_bw->execute();
	
	 echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='list_user_bw.php';
	</script>";
	
}
	
	
$content .='	
								
									
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Setting Kuota';
    $submenu	= "setting_kuota";
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