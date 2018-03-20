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

    $content =' <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Edit User</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    
                                    <form role="form" method="POST" action="">
										<h4>Semua User SBN diupdate ke </h4>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-4">
													<h5>Bandwidth</h5>
												</div>
												<div class="col-xs-4">
													<select class="form-control" name="GroupName">
														<option value="h.10">h.10</option>
														<option value="h.09">h.09</option>
														<option value="h.08">h.08</option>
														<option value="h.07">h.07</option>
														<option value="h.06">h.06</option>
														<option value="h.05">h.05</option>
														<option value="h.04">h.04</option>
														<option value="h.03">h.03</option>
														<option value="h.02">h.02</option>
														<option value="h.01">h.01</option>
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
	
	$conn_soft = Config::getInstanceSoft();


	$sql_all_user = $conn_soft ->prepare("SELECT [Users].*, [AccountTypes].[AccountName]
										 FROM [dbo].[Users], [dbo].[AccountTypes]
										 WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex]
										 AND [Users].[userActive] = '1';");
	$sql_all_user->execute();
	$row_all_user = $sql_all_user->fetchAll(PDO::FETCH_ASSOC);
	
	foreach ($row_all_user as $rows)
	{
		//log
		$sql_log = "INSERT INTO `sbn_bw_log` (`id_log`, `userid_log`, `bw_awal`, `bw_akhir`, `user_upd`, `date_upd`)
		VALUES (NULL, '".$rows["cUserID"]."', '".$rows["GroupName"]."', '".$GroupName."', '".$loggedin["username"]."', NOW());";
		mysql_query($sql_log, $conn);
		
		$query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$GroupName."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
		$update_bw = $conn_soft->prepare($query_bw);
		$update_bw->execute();
		//echo $query_bw."<br>";		
	}
	
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