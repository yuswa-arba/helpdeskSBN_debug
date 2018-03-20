<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration_user.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
    
    enableLog("",$loggedin["username"], $loggedin["username"], "Open menu setting topup");
    
    global $conn;
    global $conn_voip;

    $message ='';
if(isset($_POST["save"])){
    
    $id_setting_topup	= isset($_POST['id_setting_topup']) ? strip_tags(trim($_POST['id_setting_topup'])) : '';
    $type_topup		= isset($_POST['type_topup']) ? strip_tags(trim($_POST['type_topup'])) : '';
    $minimal_saldo	= ($type_topup == "auto_topup") ? strip_tags(trim($_POST['minimal_saldo'])) : '0';
    $topup_saldo	= ($type_topup == "auto_topup") ? strip_tags(trim($_POST['topup_saldo'])) : '0';
    $max_topup		= ($type_topup == "auto_topup") ? strip_tags(trim($_POST['max_topup'])) : '0';
    
    if($id_setting_topup == ""){
	$sql_insert = "INSERT INTO `gx_voip_setting_topup` (`id`, `id_customer`, `id_voip`, `type_topup`,
	    `minimal_saldo`, `topup_saldo`, `max_topup`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
	VALUES (NULL, '".$loggedin["customer_number"]."', '".$loggedin["id_voip"]."', '".$type_topup."',
	    '".$minimal_saldo."', '".$topup_saldo."', '".$topup_saldo."', '".$loggedin["username"]."',
	    '".$loggedin["username"]."', NOW(), NOW(), '0');";
	mysql_query($sql_insert, $conn) or die ("Data error");
	
	enableLog("",$loggedin["username"], $loggedin["username"], "$sql_insert");
	$message = '<div class="alert alert-info alert-dismissable">
                                        <i class="fa fa-info"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Info!</b> Data sudah diupdate.
                                    </div>';
    }else{
	$sql_update = "UPDATE `gx_voip_setting_topup` SET `type_topup` = '".mysql_real_escape_string($type_topup)."',
		    `minimal_saldo` = '".mysql_real_escape_string($minimal_saldo)."',
		    `topup_saldo` = '".mysql_real_escape_string($topup_saldo)."',
		    `max_topup` = '".mysql_real_escape_string($max_topup)."',
		    `user_upd` = '".mysql_real_escape_string($loggedin["username"])."',
		    `date_upd` = NOW()
	    WHERE `gx_voip_setting_topup`.`id` = '".$id_setting_topup."';";
	    
	mysql_query($sql_update, $conn) or die ("Data error");
	enableLog("",$loggedin["username"], $loggedin["username"], "$sql_update");
	$message = '<div class="alert alert-info alert-dismissable">
                                        <i class="fa fa-info"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Info!</b> Data sudah diupdate.
                                    </div>';
    }

}


$sql_setting_topup = mysql_query("SELECT * FROM `gx_voip_setting_topup` WHERE `id_customer` = '".$loggedin["customer_number"]."' LIMIT 0,1;", $conn);

$sum_setting_topup = mysql_num_rows($sql_setting_topup);

if($sum_setting_topup == 1){
    $row_setting_topup = mysql_fetch_array($sql_setting_topup);
    
    if($row_setting_topup["type_topup"] == "auto_topup")
    {
	$auto_topup = 'checked=""';
	$manual_topup = '';
    }elseif($row_setting_topup["type_topup"] == "manual_topup")
    {
	$auto_topup ='';
	$manual_topup = 'checked=""';
    }
}else
{
    $auto_topup ='';
    $manual_topup = '';
}


    $content ='<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
                                    <a href="'.URL.'voip/setting.php" class="btn btn-success">Topup</a>
                                </div>
			    </div>
			</div>
			<div class="col-xs-7">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Setting</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <div class="box-body">
				'.$message.'
				    <form role="form" method="POST" action="">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label for="type_topup">Type Topup</label>
					    </div>
					    <div class="col-xs-4">
						<input id="auto_topup" type="radio" name="type_topup" value="auto_topup" '.(($sum_setting_topup == 1) ? $auto_topup : "").' /> Auto Topup
					    </div>
					    <div class="col-xs-4">
						<input id="manual_topup" type="radio" name="type_topup" value="manual_topup" '.(($sum_setting_topup == 1) ? $manual_topup : "").' /> Manual
					    </div>
                                        </div>
					</div>
					<div id="form_auto" '.(($auto_topup != "") ? '' : 'style="display:none;"').'>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label for="nominal">Minimal Saldo</label>
					    </div>
					    <div class="col-xs-4">
                                            <select class="form-control" name="minimal_saldo">
						<option value="20000" '.((($sum_setting_topup == 1) AND ($row_setting_topup["minimal_saldo"] == 20000)) ? 'selected=""' : "").'>Rp 20.000</option>
						<option value="10000" '.((($sum_setting_topup == 1) AND ($row_setting_topup["minimal_saldo"] == 10000)) ? 'selected=""' : "").'>Rp 10.000</option>
						<option value="5000" '.((($sum_setting_topup == 1) AND ($row_setting_topup["minimal_saldo"] == 5000)) ? 'selected=""' : "").'>Rp 5.000</option>
					    </select>
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label for="topup_saldo">Auto Topup</label>
                                            </div>
					    <div class="col-xs-4">
						<select class="form-control" name="topup_saldo">
						    <option value="10000" '.((($sum_setting_topup == 1) AND ($row_setting_topup["topup_saldo"] == 10000)) ? 'selected=""' : "").'>Rp 10.000</option>
						    <option value="20000" '.((($sum_setting_topup == 1) AND ($row_setting_topup["topup_saldo"] == 20000)) ? 'selected=""' : "").'>Rp 20.000</option>
						    <option value="50000" '.((($sum_setting_topup == 1) AND ($row_setting_topup["topup_saldo"] == 50000)) ? 'selected=""' : "").'>Rp 50.000</option>
						    <option value="100000" '.((($sum_setting_topup == 1) AND ($row_setting_topup["topup_saldo"] == 100000)) ? 'selected=""' : "").'>Rp 100.000</option>
						    <option value="150000" '.((($sum_setting_topup == 1) AND ($row_setting_topup["topup_saldo"] == 150000)) ? 'selected=""' : "").'>Rp 150.000</option>
						    
						</select>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label for="max_topup">Sebanyak</label>
                                            </div>
					    <div class="col-xs-4">
						<select class="form-control" name="max_topup">
						    <option value="1" '.((($sum_setting_topup == 1) AND ($row_setting_topup["max_topup"] == 1)) ? 'selected=""' : "").'>1</option>
						    <option value="2" '.((($sum_setting_topup == 1) AND ($row_setting_topup["max_topup"] == 2)) ? 'selected=""' : "").'>2</option>
						    <option value="3" '.((($sum_setting_topup == 1) AND ($row_setting_topup["max_topup"] == 3)) ? 'selected=""' : "").'>3</option>
						</select>
						
					    </div>
					    <div class="col-xs-4">
						Kali dalam 1 Bulan
					    </div>
                                        </div>
					</div>
				    </div>
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						&nbsp;
                                            </div>
					    <div class="col-xs-4">
						<input type="hidden" name="id_setting_topup" value="'.(($sum_setting_topup == 1) ? $row_setting_topup["id"] : "").'" />
						<button type="submit" name="save" class="btn btn-primary">Save</button>
					    </div>
					    <div class="col-xs-4">
						&nbsp;
					    </div>
                                        </div>
				    </div>
				    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->';

$plugins = '<script type="text/javascript">
$(document).ready(function () {
$(\'#auto_topup\').on(\'ifChecked\', function(event){

    $(\'#form_auto\').show(\'fast\');
});
   $(\'#manual_topup\').on(\'ifChecked\', function(event){
        $(\'#form_auto\').hide(\'fast\');
    });
});
</script>';

    $title	= 'Setting';
    $submenu	= "voip_setting";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"red");
    
    echo $template;
}
    } else{
	header('location: '.URL.'logout.php');
    }

?>