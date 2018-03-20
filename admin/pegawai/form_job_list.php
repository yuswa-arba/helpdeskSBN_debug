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
    if($loggedin["group"] == 'admin')
    {
        global $conn;



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Master Gaji");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_master_job_list` WHERE `id_master_job_list`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}

    $content = '<section class="content-header">
                                       
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="form_job_list" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label><h2>Master Job List</h2></label>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Divisi</label>
											</div>
											<div class="col-xs-8">
												<input type="hidden" class="form-control" id="" name="id_master_job_list" placeholder="" value="'.(isset($_GET['id']) ? $row_data["id_master_job_list"] : "").'">
												<input type="text" class="form-control" id="" name="divisi" placeholder="" value="'.(isset($_GET['id']) ? $row_data["divisi"] : "").'" onclick="return valideopenerform(\'data_department.php?r=form_job_list&f=data_bagian\',\'job_list\');">
											</div>
										</div>
										</div>
										
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Level</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="level_master" placeholder="" value="'.(isset($_GET['id']) ? $row_data["level_master"] : "").'" onclick="return valideopenerform(\'data_level.php?r=form_job_list&f=data_level\',\'job_list\');">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-9">
												<label>Rutin Harian</label>
											</div>
											<div class="col-xs-3">
												<label>Hari</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-1">
												<label>1</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="rutin_harian_1" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["rutin_harian_1"] : "").'">
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="hari_1" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["hari_1"] : "").'">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-1">
												<label>2</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="rutin_harian_2" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["rutin_harian_2"] : "").'">
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="hari_2" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["hari_2"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-1">
												<label>3</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="rutin_harian_3" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["rutin_harian_3"] : "").'">
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="hari_3" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["hari_3"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-1">
												<label>4</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="rutin_harian_4" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["rutin_harian_4"] : "").'">
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="hari_4" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["hari_4"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-1">
												<label>5</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="rutin_harian_5" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["rutin_harian_5"] : "").'">
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="hari_5" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["hari_5"] : "").'">
											</div>
										</div>
										</div>
										
										
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-9">
												<label>Rutin Tanggal</label>
											</div>
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-1">
												<label>1</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="rutin_tanggal_1" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["rutin_tanggal_1"] : "").'">
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="tanggal_1" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["tanggal_1"] : "").'">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-1">
												<label>2</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="rutin_tanggal_2" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["rutin_tanggal_2"] : "").'">
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="tanggal_2" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["tanggal_2"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-1">
												<label>3</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="rutin_tanggal_3" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["rutin_tanggal_3"] : "").'">
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="tanggal_3" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["tanggal_3"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-1">
												<label>4</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="rutin_tanggal_4" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["rutin_tanggal_4"] : "").'">
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="tanggal_4" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["tanggal_4"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-1">
												<label>5</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="rutin_tanggal_5" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["rutin_tanggal_5"] : "").'">
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="tanggal_5" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["tanggal_5"] : "").'">
											</div>
										</div>
										</div>
										
										
										
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' '.(isset($_GET['id']) ? 'value="update"' : 'value="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->';
			

if(isset($_POST["save"]))
{
	$divisi	   		= isset($_POST['divisi']) ? mysql_real_escape_string(trim($_POST['divisi'])) : '';
	$level_master	   	= isset($_POST['level_master']) ? mysql_real_escape_string(trim($_POST['level_master'])) : '';
	$rutin_harian_1	   	= isset($_POST['rutin_harian_1']) ? mysql_real_escape_string(trim($_POST['rutin_harian_1'])) : '';
	$rutin_harian_2	   	= isset($_POST['rutin_harian_2']) ? mysql_real_escape_string(trim($_POST['rutin_harian_2'])) : '';
	$rutin_harian_3	   	= isset($_POST['rutin_harian_3']) ? mysql_real_escape_string(trim($_POST['rutin_harian_3'])) : '';
	$rutin_harian_4	   	= isset($_POST['rutin_harian_4']) ? mysql_real_escape_string(trim($_POST['rutin_harian_4'])) : '';
	$rutin_harian_5	   	= isset($_POST['rutin_harian_5']) ? mysql_real_escape_string(trim($_POST['rutin_harian_5'])) : '';
	$hari_1	   		= isset($_POST['hari_1']) ? mysql_real_escape_string(trim($_POST['hari_1'])) : '';
	$hari_2	   		= isset($_POST['hari_2']) ? mysql_real_escape_string(trim($_POST['hari_2'])) : '';
	$hari_3	   		= isset($_POST['hari_3']) ? mysql_real_escape_string(trim($_POST['hari_3'])) : '';
	$hari_4	   		= isset($_POST['hari_4']) ? mysql_real_escape_string(trim($_POST['hari_4'])) : '';
	$hari_5	   		= isset($_POST['hari_5']) ? mysql_real_escape_string(trim($_POST['hari_5'])) : '';
	$rutin_tanggal_1	= isset($_POST['rutin_tanggal_1']) ? mysql_real_escape_string(trim($_POST['rutin_tanggal_1'])) : '';
	$rutin_tanggal_2	= isset($_POST['rutin_tanggal_2']) ? mysql_real_escape_string(trim($_POST['rutin_tanggal_2'])) : '';
	$rutin_tanggal_3	= isset($_POST['rutin_tanggal_3']) ? mysql_real_escape_string(trim($_POST['rutin_tanggal_3'])) : '';
	$rutin_tanggal_4	= isset($_POST['rutin_tanggal_4']) ? mysql_real_escape_string(trim($_POST['rutin_tanggal_4'])) : '';
	$rutin_tanggal_5	= isset($_POST['rutin_tanggal_5']) ? mysql_real_escape_string(trim($_POST['rutin_tanggal_5'])) : '';
	$tanggal_1	   	= isset($_POST['tanggal_1']) ? mysql_real_escape_string(trim($_POST['tanggal_1'])) : '';
	$tanggal_2	   	= isset($_POST['tanggal_2']) ? mysql_real_escape_string(trim($_POST['tanggal_2'])) : '';
	$tanggal_3	   	= isset($_POST['tanggal_3']) ? mysql_real_escape_string(trim($_POST['tanggal_3'])) : '';
	$tanggal_4	   	= isset($_POST['tanggal_4']) ? mysql_real_escape_string(trim($_POST['tanggal_4'])) : '';
	$tanggal_5	   	= isset($_POST['tanggal_5']) ? mysql_real_escape_string(trim($_POST['tanggal_5'])) : '';
	$username 		= $loggedin['username'];
	
	$sql_insert = "INSERT INTO `gx_master_job_list`(`id_master_job_list`, `divisi`, `level_master`, `rutin_harian_1`, `rutin_harian_2`, `rutin_harian_3`, `rutin_harian_4`, `rutin_harian_5`, `hari_1`, `hari_2`, `hari_3`, `hari_4`, `hari_5`, `rutin_tanggal_1`, `rutin_tanggal_2`, `rutin_tanggal_3`, `rutin_tanggal_4`, `rutin_tanggal_5`, `tanggal_1`, `tanggal_2`, `tanggal_3`, `tanggal_4`, `tanggal_5`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL,'".$divisi."','".$level_master."','".$rutin_harian_1."','".$rutin_harian_2."','".$rutin_harian_3."','".$rutin_harian_4."','".$rutin_harian_5."','".$hari_1."','".$hari_2."','".$hari_3."','".$hari_4."','".$hari_5."','".$rutin_tanggal_1."','".$rutin_tanggal_2."','".$rutin_tanggal_3."','".$rutin_tanggal_4."','".$rutin_tanggal_5."','".$tanggal_1."','".$tanggal_2."','".$tanggal_3."','".$tanggal_4."','".$tanggal_5."',NOW(),NOW(),'".$username."','".$username."','0')";                                   
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/master_job_list.php';
			</script>";
	
}elseif(isset($_POST["update"]))
{
    //echo "update";
	//$	   		= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
	$id_master_job_list	= isset($_POST['id_master_job_list']) ? mysql_real_escape_string(trim($_POST['id_master_job_list'])) : '';
	$divisi	   		= isset($_POST['divisi']) ? mysql_real_escape_string(trim($_POST['divisi'])) : '';
	$level_master	   	= isset($_POST['level_master']) ? mysql_real_escape_string(trim($_POST['level_master'])) : '';
	$rutin_harian_1	   	= isset($_POST['rutin_harian_1']) ? mysql_real_escape_string(trim($_POST['rutin_harian_1'])) : '';
	$rutin_harian_2	   	= isset($_POST['rutin_harian_2']) ? mysql_real_escape_string(trim($_POST['rutin_harian_2'])) : '';
	$rutin_harian_3	   	= isset($_POST['rutin_harian_3']) ? mysql_real_escape_string(trim($_POST['rutin_harian_3'])) : '';
	$rutin_harian_4	   	= isset($_POST['rutin_harian_4']) ? mysql_real_escape_string(trim($_POST['rutin_harian_4'])) : '';
	$rutin_harian_5	   	= isset($_POST['rutin_harian_5']) ? mysql_real_escape_string(trim($_POST['rutin_harian_5'])) : '';
	$hari_1	   		= isset($_POST['hari_1']) ? mysql_real_escape_string(trim($_POST['hari_1'])) : '';
	$hari_2	   		= isset($_POST['hari_2']) ? mysql_real_escape_string(trim($_POST['hari_2'])) : '';
	$hari_3	   		= isset($_POST['hari_3']) ? mysql_real_escape_string(trim($_POST['hari_3'])) : '';
	$hari_4	   		= isset($_POST['hari_4']) ? mysql_real_escape_string(trim($_POST['hari_4'])) : '';
	$hari_5	   		= isset($_POST['hari_5']) ? mysql_real_escape_string(trim($_POST['hari_5'])) : '';
	$rutin_tanggal_1	= isset($_POST['rutin_tanggal_1']) ? mysql_real_escape_string(trim($_POST['rutin_tanggal_1'])) : '';
	$rutin_tanggal_2	= isset($_POST['rutin_tanggal_2']) ? mysql_real_escape_string(trim($_POST['rutin_tanggal_2'])) : '';
	$rutin_tanggal_3	= isset($_POST['rutin_tanggal_3']) ? mysql_real_escape_string(trim($_POST['rutin_tanggal_3'])) : '';
	$rutin_tanggal_4	= isset($_POST['rutin_tanggal_4']) ? mysql_real_escape_string(trim($_POST['rutin_tanggal_4'])) : '';
	$rutin_tanggal_5	= isset($_POST['rutin_tanggal_5']) ? mysql_real_escape_string(trim($_POST['rutin_tanggal_5'])) : '';
	$tanggal_1	   	= isset($_POST['tanggal_1']) ? mysql_real_escape_string(trim($_POST['tanggal_1'])) : '';
	$tanggal_2	   	= isset($_POST['tanggal_2']) ? mysql_real_escape_string(trim($_POST['tanggal_2'])) : '';
	$tanggal_3	   	= isset($_POST['tanggal_3']) ? mysql_real_escape_string(trim($_POST['tanggal_3'])) : '';
	$tanggal_4	   	= isset($_POST['tanggal_4']) ? mysql_real_escape_string(trim($_POST['tanggal_4'])) : '';
	$tanggal_5	   	= isset($_POST['tanggal_5']) ? mysql_real_escape_string(trim($_POST['tanggal_5'])) : '';
	$username 		= $loggedin['username'];
	
	
    $sql_update = "UPDATE `gx_master_job_list` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_master_job_list` = '".$id_master_job_list."';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "INSERT INTO `gx_master_job_list`(`id_master_job_list`, `divisi`, `level_master`, `rutin_harian_1`, `rutin_harian_2`, `rutin_harian_3`, `rutin_harian_4`, `rutin_harian_5`, `hari_1`, `hari_2`, `hari_3`, `hari_4`, `hari_5`, `rutin_tanggal_1`, `rutin_tanggal_2`, `rutin_tanggal_3`, `rutin_tanggal_4`, `rutin_tanggal_5`, `tanggal_1`, `tanggal_2`, `tanggal_3`, `tanggal_4`, `tanggal_5`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL,'".$divisi."','".$level_master."','".$rutin_harian_1."','".$rutin_harian_2."','".$rutin_harian_3."','".$rutin_harian_4."','".$rutin_harian_5."','".$hari_1."','".$hari_2."','".$hari_3."','".$hari_4."','".$hari_5."','".$rutin_tanggal_1."','".$rutin_tanggal_2."','".$rutin_tanggal_3."','".$rutin_tanggal_4."','".$rutin_tanggal_5."','".$tanggal_1."','".$tanggal_2."','".$tanggal_3."','".$tanggal_4."','".$tanggal_5."',NOW(),NOW(),'".$username."','".$username."','0')";                                   
    
    //echo $sql_insert;
    mysql_query($sql_insert_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/master_job_list.php';
			</script>";
			
}

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                $("#datepicker2").datepicker({format: "yyyy-mm-dd"});  
            });
        </script>
	<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: \'\',
		thousandsSeparator: \',\',
		centsLimit: 0
	    });
        </script>
		';

    $title	= 'Master Job List';
    $submenu	= "master_job_list";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>