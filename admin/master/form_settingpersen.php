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
if($loggedin = logged_inAdmin())
{ // Check if they are logged in

    if($loggedin["group"] == 'admin')
    {
	global $conn;

if(isset($_POST["save"]))
{
    //$id_paket           = isset($_POST['id_paket']) ? mysql_real_escape_string(trim($_POST['id_paket'])) : '';
    $bulan		        = isset($_POST['bulan']) ? mysql_real_escape_string(trim($_POST['bulan'])) : '';
    $tahun				= isset($_POST['tahun']) ? mysql_real_escape_string(trim($_POST['tahun'])) : '';
    $acc_paket_switched = isset($_POST['acc_paket_switched']) ? mysql_real_escape_string(trim($_POST['acc_paket_switched'])) : '';
    $acc_isp        	= isset($_POST['acc_isp']) ? mysql_real_escape_string(trim($_POST['acc_isp'])) : '';
    $acc_arba			= isset($_POST['acc_arba']) ? mysql_real_escape_string(trim($_POST['acc_arba'])) : '';
    
    //insert into gxPaket
    $sql_insert = "INSERT INTO `software`.`gx_setting_persentase` (`id_settingpersen`, `bulan`, `tahun`, `acc_paket_switched`,
	`acc_isp`, `acc_arba`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL, '".$bulan."', '".$tahun."', '".$acc_paket_switched."', '".$acc_isp."',
	'".$acc_arba."', NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";                    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='setting_persentase.php';
	</script>";
    
    
}elseif(isset($_POST["update"]))
{
    $id_setting         = isset($_POST['id_setting']) ? mysql_real_escape_string(trim($_POST['id_setting'])) : '';
    $bulan		        = isset($_POST['bulan']) ? mysql_real_escape_string(trim($_POST['bulan'])) : '';
    $tahun				= isset($_POST['tahun']) ? mysql_real_escape_string(trim($_POST['tahun'])) : '';
    $acc_paket_switched = isset($_POST['acc_paket_switched']) ? mysql_real_escape_string(trim($_POST['acc_paket_switched'])) : '';
    $acc_isp        	= isset($_POST['acc_isp']) ? mysql_real_escape_string(trim($_POST['acc_isp'])) : '';
    $acc_arba			= isset($_POST['acc_arba']) ? mysql_real_escape_string(trim($_POST['acc_arba'])) : '';
    
    
    if($id_setting !=""){
    //update gxPaket
    $sql_update = "UPDATE `gx_setting_persentase` SET `bulan` = '".$bulan."', `tahun` = '".$tahun."', `acc_paket_switched` = '".$acc_paket_switched."',
    `acc_arba` = '".$acc_arba."', `acc_isp` = '".$acc_isp."',
    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
    WHERE `id_settingpersen` = '".$id_setting."';";
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
	
	
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='setting_persentase.php';
	</script>";
    }else{
	echo "<script language='JavaScript'>
	    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
	    window.history.go(-1);
	</script>";
    }
}

if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data 	= "SELECT * FROM `gx_setting_persentase` WHERE `id_settingpersen` = '".$id_data."' AND `level` = '0' LIMIT 0,1;";
    
    $sql_data 		= mysql_query($query_data, $conn);
    $row_data 		= mysql_fetch_array($sql_data);
    
    
    
}

    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Paket</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="" name="form_paket" id="form_settingpersen">
								<input type="hidden" name="id_setting" value="'.(isset($_GET['id']) ? $row_data["id_settingpersen"] : "").'">
								
                                <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Bulan</label>
					    </div>
					    <div class="col-xs-3">
						<select class="form-control" name="bulan">';
						
					    
$sql_bulan = mysql_query("SELECT * FROM `bulan`", $conn);
while($row_bulan = mysql_fetch_array($sql_bulan)){
    $selected = isset($_GET["id"]) ? $row_data["bulan"] : "";
    $selected = ($selected == $row_bulan["id_bulan"]) ? ' selected=""' : "";
    
    $content .= '<option value="'.$row_bulan["id_bulan"].'" '.$selected.'>'.$row_bulan["nama_bulan"].'</option>';
    
}
						
						$content .= '
                                            </select>
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tahun</label>
					    </div>
					    <div class="col-xs-3">
						<select class="form-control" name="tahun">';
						
					    
$sql_tahun = mysql_query("SELECT * FROM `tahun`", $conn);
while($row_tahun = mysql_fetch_array($sql_tahun)){
    $selected = isset($_GET["id"]) ? $row_data["tahun"] : "";
    $selected = ($selected == $row_tahun["nama_tahun"]) ? ' selected=""' : "";
    
    $content .= '<option value="'.$row_tahun["nama_tahun"].'" '.$selected.'>'.$row_tahun["nama_tahun"].'</option>';
    
}
						
						$content .= '
                                            </select>
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC Paket Switched</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="3" name="acc_paket_switched" value="'.(isset($_GET['id']) ? $row_data["acc_paket_switched"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC ISP</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="3" name="acc_isp" value="'.(isset($_GET['id']) ? $row_data["acc_isp"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC Arba</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="3" name="acc_arba" value="'.(isset($_GET['id']) ? $row_data["acc_arba"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						&nbsp;
					    </div>
					    <div class="col-xs-6">
						&nbsp;
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary" value="Save">Save</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "dd-mm-yyyy"});
				$("#datepicker2").datepicker({format: "dd-mm-yyyy"});
                
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
    
    
    $title	= 'Form Setting Persentase';
    $submenu	= "";
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