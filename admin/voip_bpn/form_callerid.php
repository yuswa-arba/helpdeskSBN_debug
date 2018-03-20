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
include ("../../config/configuration_voip_bpn.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    $id_cc_card	= isset($_POST['id_cc_card']) ? mysql_real_escape_string(trim($_POST['id_cc_card'])) : '';
    $activated	= isset($_POST['activated']) ? mysql_real_escape_string(trim($_POST['activated'])) : '';
    $cid	= isset($_POST['cid']) ? mysql_real_escape_string(trim($_POST['cid'])) : '';
    
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `mya2billing`.`cc_callerid` (`id`, `cid`, `id_cc_card`, `activated`)
    VALUES (NULL, '".$cid."', '".$id_cc_card."', '".$activated."');";
    
    $sql_insert_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
    `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
    VALUES (NULL, '1', '2', 'NEW CALLERID CREATED', 'User added a new record in database', 'cid =  ".$cid."| id_cc_card =  ".$id_cc_card."| activated =  ".$activated."| Web Software GX (".$loggedin["username"].")',
    'cc_callerid', 'form_callerid.php', '".getenv("REMOTE_ADDR")."', NOW(), '0');";
    //echo $insert."<br>";

    echo mysql_query($sql_insert, $conn_voip) or die (mysql_error());
    echo mysql_query($sql_insert_log, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."voip_bpn/callerid.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id       	= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    $id_cc_card	= isset($_POST['id_cc_card']) ? mysql_real_escape_string(trim($_POST['id_cc_card'])) : '';
    $activated	= isset($_POST['activated']) ? mysql_real_escape_string(trim($_POST['activated'])) : '';
    $cid	= isset($_POST['cid']) ? mysql_real_escape_string(trim($_POST['cid'])) : '';
    
    //Update into cc_subscription_service
    $sql_update = "UPDATE `mya2billing`.`cc_callerid` SET `cid`='".$cid."', `id_cc_card`='".$id_cc_card."', `activated`='".$activated."'
    WHERE (`id`='".$id."');";
    
    $sql_update_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`,
    `description`, `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
    VALUES (NULL, '1', '3', 'A CALLERID UPDATED', 'A RECORD IS UPDATED, EDITION CALUSE USED IS  id=".$id." ',
    'id_cc_card = ".$id_cc_card." |cid = ".$cid." | activated = ".$activated." | Web Software GX (".$loggedin["username"].")',
    'cc_callerid', 'form_callerid.php',
    '".getenv("REMOTE_ADDR")."', NOW(), '0');";
    
    //echo $sql_update;
    echo mysql_query($sql_update, $conn_voip) or die (mysql_error());
    echo mysql_query($sql_update_log, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);

   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."voip_bpn/callerid.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_callerid	= isset($_GET['id']) ? $_GET['id'] : '';
    $query_callerid 	= "SELECT * FROM `cc_callerid` WHERE `id` ='".$id_callerid."' LIMIT 0,1;";
    $sql_callerid	= mysql_query($query_callerid, $conn_voip);
    $row_callerid	= mysql_fetch_array($sql_callerid);

}

    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-7"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Caller ID</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_callerid" id="form_callerid" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Caller ID</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cid" id="cid" value="'.(isset($_GET['id']) ? $row_callerid["cid"] : '').'">
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_callerid["id"] : '').'" readonly="">
						
					    </div>
					    
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Status</label>
					    </div>
					    <div class="col-xs-8">
						Yes  <input type="radio" name="activated" value="t" '.((isset($_GET["id"] )&& ($row_callerid["activated"] == "t")) ? 'checked=""' : "").'>
						- No <input type="radio" name="activated" value="f" '.((isset($_GET["id"] )&& ($row_callerid["activated"] == "f")) ? 'checked=""' : "").'>
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>ID Card</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" required="" readonly=""  name="id_cc_card" value="'.(isset($_GET['id']) ? $row_callerid["id_cc_card"] : "").'">
					    </div>
					    <div class="col-xs-4">
						
						<a href="'.URL_ADMIN.'voip_bpn/data_subscription.php?r=form_callerid" class="btn bg-olive btn-flat margin pull-right" onclick="return valideopenerform(\''.URL_ADMIN.'voip_bpn/data_subscription.php?r=form_callerid\',\'callerid\');">Select</a>
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Caller ID';
    $submenu	= "callerid";
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