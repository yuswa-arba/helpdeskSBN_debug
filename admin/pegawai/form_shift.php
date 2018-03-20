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
    $query_data		= "SELECT * FROM `gx_shift` WHERE `id_shift`='$id_data' AND `level`='0' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
}

$data_id_shift= mysql_fetch_array(mysql_query("SELECT `id_shift` FROM `gx_shift` WHERE `level`='0' ORDER BY `id_shift` DESC LIMIT 1", $conn));
$value_id_shift = $data_id_shift['id_shift'] != '' ? $data_id_shift['id_shift'] + 1 : '1';

    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                
                                <!-- form start -->
                                <form role="form" method="POST" name="form_shift" action="" enctype="multipart/form-data" id="">
                                    <div class="box-body">
										<input type="hidden" name="id_shift" value="'.(isset($_GET['id']) ? $row_data["id_shift"] : $value_id_shift).'"> 
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label><h2>Form Shift Pegawai</h2></label>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Shift</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="nama_shift"  placeholder="" value="'.(isset($_GET['id']) ? $row_data["nama_shift"] : "").'">
											</div>
											
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Check In</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="checkin_shift" placeholder="" value="'.(isset($_GET['id']) ? $row_data["checkin_shift"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Check Out</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="checkout_shift" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["checkout_shift"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Created By</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_data["user_add"] : $loggedin["username"]).'
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Latest Update By </label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_data["user_upd"]." ".$row_data["date_upd"] : "").'
											</div>
										</div>
										</div>
										
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' value="Submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
			

if(isset($_POST["save"]))
{
    $nama_shift	   			= isset($_POST['nama_shift']) ? mysql_real_escape_string(trim($_POST['nama_shift'])) : '';
    $checkin_shift			= isset($_POST['checkin_shift']) ? mysql_real_escape_string(trim($_POST['checkin_shift'])) : '';
    $checkout_shift			= isset($_POST['checkout_shift']) ? mysql_real_escape_string(trim($_POST['checkout_shift'])) : '';
   
	
	if($_POST['save'] == 'Submit'){
	$sql_insert = "INSERT INTO `gx_shift`(`id_shift`, `nama_shift`, `checkin_shift`, `checkout_shift`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
				    VALUES (NULL,'".$nama_shift."','".$checkin_shift."','".$checkout_shift."',NOW(),NOW(),'".$username."','".$username."','0')";                    
    
   //echo $sql_insert;
    
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/setting_gaji.php';
			</script>";
	
    }else{
		echo"<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Data tidak lengkap pada pengisian form!');
		window.history.go(-1);
	    </script>";
	}
}elseif(isset($_POST["update"]))
{
    
    
    //$					= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $id_shift			= isset($_POST['id_shift']) ? mysql_real_escape_string(trim($_POST['id_shift'])) : '';
    $nama_shift	   		= isset($_POST['nama_shift']) ? mysql_real_escape_string(trim($_POST['nama_shift'])) : '';
    $checkin_shift		= isset($_POST['checkin_shift']) ? mysql_real_escape_string(trim($_POST['checkin_shift'])) : '';
    $checkout_shift		= isset($_POST['checkout_shift']) ? mysql_real_escape_string(trim($_POST['checkout_shift'])) : '';
   
	
    $sql_update = "UPDATE `gx_shift` SET `nama_shift` = '".$nama_shift."', `checkin_shift` = '".$checkin_shift."', `checkout_shift` = '".$checkout_shift."',
		    `date_upd` = NOW(), `user_upd`= '".$username."'
		    WHERE `id_shift` = '".$id_shift."'";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_update);
    

    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/setting_gaji.php';
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
        </script>';

    $title	= 'Form Shift PEgawai';
    $submenu	= "master_shift";
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