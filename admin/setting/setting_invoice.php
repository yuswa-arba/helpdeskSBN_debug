<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

 include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}

    global $conn;
	
function selectTgl($name, $selected)
{
	$string = '';
	$select = '<select name="'.$name.'" class="form-control">';
	for($x=1; $x<=31; $x++)
	{
		if($x == $selected)
		{
			$string = 'selected=""';
		}
		$select .= '<option value="'.$x.'" '.$string.'>'.$x.'</option>';
	}
	$select .= '</select>';
	
	return $select;
}

$sql_data = mysql_query("SELECT * FROM `gx_setting_invoice2` WHERE `id_setting_invoice` = '1' LIMIT 0,1;", $conn);
$row_data = mysql_fetch_array($sql_data);
	
$content = '<!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">
					<div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Setting Invoice</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								
								<form action="" method="post" name="form_setting">
								<input type="hidden" name="id_setting_invoice" value="'.$row_data["id_setting_invoice"].'">
								<table class="table table-bordered table-striped" id="setting_invoice" style="width: 100%;">
									<tr>
										<th></th>
										<th>Nominal</th>
										<th>Due Date</th>
										<th>Blokir</th>
										<th>Generate</th>
										<th>Friendly Reminder</th>
									</tr>
									<tr>
										<td>Invoice LTS</td>
										<td><input type="text" class="form-control" name="nominal_lts" value="'.$row_data["nominal_lts"].'"></td>
										<td>'.selectTgl("duedate_lts", $row_data["duedate_lts"]).'</td>
										<td>'.selectTgl("blokir_lts", $row_data["blokir_lts"]).'</td>
										<td>'.selectTgl("generate_lts", $row_data["generate_lts"]).'</td>
										<td><input type="text" class="form-control" name="reminder_lts" value="'.$row_data["reminder_lts"].'"></td>
									</tr>
									<tr>
										<td>Invoice New Connection</td>
										<td><input type="text" class="form-control" name="nominal_new" value="'.$row_data["nominal_new"].'"></td>
										<td>'.selectTgl("duedate_new", $row_data["duedate_new"]).'</td>
										<td>'.selectTgl("blokir_new", $row_data["blokir_new"]).'</td>
										<td>'.selectTgl("generate_new", $row_data["generate_new"]).'</td>
										<td><input type="text" class="form-control" name="reminder_new" value="'.$row_data["reminder_new"].'"></td>
									</tr>
									<tr>
										<td>Invoice Upgrade Downgrade</td>
										<td><input type="text" class="form-control" name="nominal_up" value="'.$row_data["nominal_up"].'"></td>
										<td>'.selectTgl("duedate_up", $row_data["duedate_up"]).'</td>
										<td>'.selectTgl("blokir_up", $row_data["blokir_up"]).'</td>
										<td>'.selectTgl("generate_up", $row_data["generate_up"]).'</td>
										<td><input type="text" class="form-control" name="reminder_up" value="'.$row_data["reminder_up"].'"></td>
									</tr>
									<tr>
										<td>Invoice Reaktivasi</td>
										<td><input type="text" class="form-control" name="nominal_reaktivasi" value="'.$row_data["nominal_reaktivasi"].'"></td>
										<td>'.selectTgl("duedate_reaktivasi", $row_data["duedate_reaktivasi"]).'</td>
										<td>'.selectTgl("blokir_reaktivasi", $row_data["blokir_reaktivasi"]).'</td>
										<td>'.selectTgl("generate_reaktivasi", $row_data["generate_reaktivasi"]).'</td>
										<td><input type="text" class="form-control" name="reminder_reaktivasi" value="'.$row_data["reminder_reaktivasi"].'"></td>
									</tr>
									<tr>
										<td>Invoice Konversi</td>
										<td><input type="text" class="form-control" name="nominal_konversi" value="'.$row_data["nominal_konversi"].'"></td>
										<td>'.selectTgl("duedate_konversi", $row_data["duedate_konversi"]).'</td>
										<td>'.selectTgl("blokir_konversi", $row_data["blokir_konversi"]).'</td>
										<td>'.selectTgl("generate_konversi", $row_data["generate_konversi"]).'</td>
										<td><input type="text" class="form-control" name="reminder_konversi" value="'.$row_data["reminder_konversi"].'"></td>
									</tr>
									<tr>
										<td>Invoice Prorate Konversi</td>
										<td><input type="text" class="form-control" name="nominal_prokonversi" value="'.$row_data["nominal_prokonversi"].'"></td>
										<td>'.selectTgl("duedate_prokonversi", $row_data["duedate_prokonversi"]).'</td>
										<td>'.selectTgl("blokir_prokonversi", $row_data["blokir_prokonversi"]).'</td>
										<td>'.selectTgl("generate_prokonversi", $row_data["generate_prokonversi"]).'</td>
										<td><input type="text" class="form-control" name="reminder_prokonversi" value="'.$row_data["reminder_prokonversi"].'"></td>
									</tr>
									<tr>
										<td>Invoice Balik Nama</td>
										<td><input type="text" class="form-control" name="nominal_bn" value="'.$row_data["nominal_bn"].'"></td>
										<td>'.selectTgl("duedate_bn", $row_data["duedate_bn"]).'</td>
										<td>'.selectTgl("blokir_bn", $row_data["blokir_bn"]).'</td>
										<td>'.selectTgl("generate_bn", $row_data["generate_bn"]).'</td>
										<td><input type="text" class="form-control" name="reminder_bn" value="'.$row_data["reminder_bn"].'"></td>
									</tr>
									<tr>
										<td>Invoice Maintenance</td>
										<td><input type="text" class="form-control" name="nominal_maintenance" value="'.$row_data["nominal_maintenance"].'"></td>
										<td>'.selectTgl("duedate_maintenance", $row_data["duedate_maintenance"]).'</td>
										<td>'.selectTgl("blokir_maintenance", $row_data["blokir_maintenance"]).'</td>
										<td>'.selectTgl("generate_maintenance", $row_data["generate_maintenance"]).'</td>
										<td><input type="text" class="form-control" name="reminder_maintenance" value="'.$row_data["reminder_maintenance"].'"></td>
									</tr>
									<tr>
										<td>Invoice Additional</td>
										<td><input type="text" class="form-control" name="nominal_add" value="'.$row_data["nominal_add"].'"></td>
										<td>'.selectTgl("duedate_add", $row_data["duedate_add"]).'</td>
										<td>'.selectTgl("blokir_add", $row_data["blokir_add"]).'</td>
										<td>'.selectTgl("generate_add", $row_data["generate_add"]).'</td>
										<td><input type="text" class="form-control" name="reminder_add" value="'.$row_data["reminder_add"].'"></td>
									</tr>
								</table>
				    
					<div class="form-group">
				    <div class="row">
						<div class="col-xs-12">
							
						</div>
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
						<div class="col-xs-4">
							
						</div>
						<div class="col-xs-4">
							<input class="btn bg-olive btn-flat" value="Submit" name="update" type="submit">
						</div>
						<div class="col-xs-4">
						
						</div>
				    </div>
				    </div>
	</form>								
								</div>
							</div>
						</div>
					</div>
				</section>';

$submenu	= "";
$plugins	= '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("[id=datepicker]").datepicker({format: "yyyy-mm-dd"});
            });
        </script>';

if(isset($_POST["update"]))
{
    $id_setting_invoice	= isset($_POST['id_setting_invoice']) ? mysql_real_escape_string(trim($_POST['id_setting_invoice'])) : '';
	$nominal_lts		= isset($_POST['nominal_lts']) ? mysql_real_escape_string(trim($_POST['nominal_lts'])) : '';
	$duedate_lts		= isset($_POST['duedate_lts']) ? mysql_real_escape_string(trim($_POST['duedate_lts'])) : '';
	$blokir_lts			= isset($_POST['blokir_lts']) ? mysql_real_escape_string(trim($_POST['blokir_lts'])) : '';
	$generate_lts		= isset($_POST['generate_lts']) ? mysql_real_escape_string(trim($_POST['generate_lts'])) : '';
	$reminder_lts		= isset($_POST['reminder_lts']) ? mysql_real_escape_string(trim($_POST['reminder_lts'])) : '';
	$nominal_new		= isset($_POST['nominal_new']) ? mysql_real_escape_string(trim($_POST['nominal_new'])) : '';
	$duedate_new		= isset($_POST['duedate_new']) ? mysql_real_escape_string(trim($_POST['duedate_new'])) : '';
	$blokir_new			= isset($_POST['blokir_new']) ? mysql_real_escape_string(trim($_POST['blokir_new'])) : '';
	$generate_new		= isset($_POST['generate_new']) ? mysql_real_escape_string(trim($_POST['generate_new'])) : '';
	$reminder_new		= isset($_POST['reminder_new']) ? mysql_real_escape_string(trim($_POST['reminder_new'])) : '';
	$nominal_up			= isset($_POST['nominal_up']) ? mysql_real_escape_string(trim($_POST['nominal_up'])) : '';
	$duedate_up			= isset($_POST['duedate_up']) ? mysql_real_escape_string(trim($_POST['duedate_up'])) : '';
	$blokir_up			= isset($_POST['blokir_up']) ? mysql_real_escape_string(trim($_POST['blokir_up'])) : '';
	$generate_up		= isset($_POST['generate_up']) ? mysql_real_escape_string(trim($_POST['generate_up'])) : '';
	$reminder_up		= isset($_POST['reminder_up']) ? mysql_real_escape_string(trim($_POST['reminder_up'])) : '';
	$nominal_reaktivasi	= isset($_POST['nominal_reaktivasi']) ? mysql_real_escape_string(trim($_POST['nominal_reaktivasi'])) : '';
	$duedate_reaktivasi	= isset($_POST['duedate_reaktivasi']) ? mysql_real_escape_string(trim($_POST['duedate_reaktivasi'])) : '';
	$blokir_reaktivasi	= isset($_POST['blokir_reaktivasi']) ? mysql_real_escape_string(trim($_POST['blokir_reaktivasi'])) : '';
	$generate_reaktivasi	= isset($_POST['generate_reaktivasi']) ? mysql_real_escape_string(trim($_POST['generate_reaktivasi'])) : '';
	$reminder_reaktivasi	= isset($_POST['reminder_reaktivasi']) ? mysql_real_escape_string(trim($_POST['reminder_reaktivasi'])) : '';
	$nominal_konversi		= isset($_POST['nominal_konversi']) ? mysql_real_escape_string(trim($_POST['nominal_konversi'])) : '';
	$duedate_konversi		= isset($_POST['duedate_konversi']) ? mysql_real_escape_string(trim($_POST['duedate_konversi'])) : '';
	$blokir_konversi		= isset($_POST['blokir_konversi']) ? mysql_real_escape_string(trim($_POST['blokir_konversi'])) : '';
	$generate_konversi		= isset($_POST['generate_konversi']) ? mysql_real_escape_string(trim($_POST['generate_konversi'])) : '';
	$reminder_konversi		= isset($_POST['reminder_konversi']) ? mysql_real_escape_string(trim($_POST['reminder_konversi'])) : '';
	$nominal_prokonversi	= isset($_POST['nominal_prokonversi']) ? mysql_real_escape_string(trim($_POST['nominal_prokonversi'])) : '';
	$duedate_prokonversi	= isset($_POST['duedate_prokonversi']) ? mysql_real_escape_string(trim($_POST['duedate_prokonversi'])) : '';
	$blokir_prokonversi		= isset($_POST['blokir_prokonversi']) ? mysql_real_escape_string(trim($_POST['blokir_prokonversi'])) : '';
	$generate_prokonversi	= isset($_POST['generate_prokonversi']) ? mysql_real_escape_string(trim($_POST['generate_prokonversi'])) : '';
	$reminder_prokonversi	= isset($_POST['reminder_prokonversi']) ? mysql_real_escape_string(trim($_POST['reminder_prokonversi'])) : '';
	$nominal_bn				= isset($_POST['nominal_bn']) ? mysql_real_escape_string(trim($_POST['nominal_bn'])) : '';
	$duedate_bn				= isset($_POST['duedate_bn']) ? mysql_real_escape_string(trim($_POST['duedate_bn'])) : '';
	$blokir_bn				= isset($_POST['blokir_bn']) ? mysql_real_escape_string(trim($_POST['blokir_bn'])) : '';
	$generate_bn				= isset($_POST['generate_bn']) ? mysql_real_escape_string(trim($_POST['generate_bn'])) : '';
	$reminder_bn				= isset($_POST['reminder_bn']) ? mysql_real_escape_string(trim($_POST['reminder_bn'])) : '';
	$nominal_maintenance		= isset($_POST['nominal_maintenance']) ? mysql_real_escape_string(trim($_POST['nominal_maintenance'])) : '';
	$duedate_maintenance		= isset($_POST['duedate_maintenance']) ? mysql_real_escape_string(trim($_POST['duedate_maintenance'])) : '';
	$blokir_maintenance			= isset($_POST['blokir_maintenance']) ? mysql_real_escape_string(trim($_POST['blokir_maintenance'])) : '';
	$generate_maintenance		= isset($_POST['generate_maintenance']) ? mysql_real_escape_string(trim($_POST['generate_maintenance'])) : '';
	$reminder_maintenance		= isset($_POST['reminder_maintenance']) ? mysql_real_escape_string(trim($_POST['reminder_maintenance'])) : '';
	$nominal_add				= isset($_POST['nominal_add']) ? mysql_real_escape_string(trim($_POST['nominal_add'])) : '';
	$duedate_add				= isset($_POST['duedate_add']) ? mysql_real_escape_string(trim($_POST['duedate_add'])) : '';
	$blokir_add					= isset($_POST['blokir_add']) ? mysql_real_escape_string(trim($_POST['blokir_add'])) : '';
	$generate_add				= isset($_POST['generate_add']) ? mysql_real_escape_string(trim($_POST['generate_add'])) : '';
	$reminder_add				= isset($_POST['reminder_add']) ? mysql_real_escape_string(trim($_POST['reminder_add'])) : '';

    //insert into gx_bagian
    $sql_update = "UPDATE `software`.`gx_setting_invoice2` SET `nominal_lts`='".$nominal_lts."',
	`duedate_lts`='".$duedate_lts."', `blokir_lts`='".$blokir_lts."', `generate_lts`='".$generate_lts."',
	`reminder_lts`='".$reminder_lts."', `nominal_new`='".$nominal_new."',
	`duedate_new`='".$duedate_new."', `blokir_new`='".$blokir_new."', `generate_new`='".$generate_new."',
	`reminder_new`='".$reminder_new."', `nominal_up`='".$nominal_up."',
	`duedate_up`='".$duedate_up."', `blokir_up`='".$blokir_up."', `generate_up`='".$generate_up."', `reminder_up`='".$reminder_up."',
	`nominal_reaktivasi`='".$nominal_reaktivasi."',	`duedate_reaktivasi`='".$duedate_reaktivasi."',
	`blokir_reaktivasi`='".$blokir_reaktivasi."', `generate_reaktivasi`='".$generate_reaktivasi."',
	`reminder_reaktivasi`='".$reminder_reaktivasi."', `nominal_konversi`='".$nominal_konversi."',
	`duedate_konversi`='".$duedate_konversi."',	`blokir_konversi`='".$blokir_konversi."',
	`generate_konversi`='".$generate_konversi."', `reminder_konversi`='".$reminder_konversi."',
	`nominal_prokonversi`='".$nominal_prokonversi."', `duedate_prokonversi`='".$duedate_prokonversi."',
	`blokir_prokonversi`='".$blokir_prokonversi."',	`generate_prokonversi`='".$generate_prokonversi."',
	`reminder_prokonversi`='".$reminder_prokonversi."', `nominal_bn`='".$nominal_bn."',
	`duedate_bn`='".$duedate_bn."', `blokir_bn`='".$blokir_bn."', `generate_bn`='".$generate_bn."', `reminder_bn`='".$reminder_bn."',
	`nominal_maintenance`='".$nominal_maintenance."', `duedate_maintenance`='".$duedate_maintenance."',
	`blokir_maintenance`='".$blokir_maintenance."',	`generate_maintenance`='".$generate_maintenance."',
	`reminder_maintenance`='".$reminder_maintenance."', `nominal_add`='".$nominal_add."',
	`duedate_add`='".$duedate_add."', `blokir_add`='".$blokir_add."', `generate_add`='".$generate_add."',
	`reminder_add`='".$reminder_add."',
	`date_upd`=NOW(), `updated_by`='".$loggedin["username"]."'
	WHERE (`id_setting_invoice`='".$id_setting_invoice."');";
	//echo $sql_update;
    //echo $sql_update_staff;
    mysql_query($sql_update, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='setting_invoice.php';
	</script>";
	
}

    $title	= 'Setting Invoice';
    
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
     else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>