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
    $date	= isset($_POST['date']) ? mysql_real_escape_string(trim($_POST['date'])) : '';
    $title	= isset($_POST['title']) ? mysql_real_escape_string(trim($_POST['title'])) : '';
    $description= isset($_POST['description']) ? mysql_real_escape_string(trim($_POST['description'])) : '';
    
    $sql_invoice = mysql_query("SELECT COUNT(*) as `total` FROM `cc_invoice` WHERE `date` LIKE '%2015-%';", $conn_voip);
    $row_invoice = mysql_fetch_array($sql_invoice);
    
    $total = $row_invoice["total"] + 1;
    $reference = date("Ymd").sprintf("%04d", $total);
    
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `mya2billing`.`cc_invoice` (`id`, `reference`, `id_card`, `date`,
    `paid_status`, `status`, `title`, `description`)
    VALUES (NULL, '$reference', '".$id_cc_card."', '".$date."', '0', '0', '".$title."', '".$description."');";
    
    $sql_insert_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
    `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
    VALUES (NULL, '1', '2', 'NEW INVOICE CREATED', 'User added a new record in database',
    'id_card = ".$id_cc_card."| date =  ".$date."| title =  ".$title."| description =  ".$description."| Web Software GX (".$loggedin["username"].")',
    'cc_invoice', 'form_vinvoice.php', '".getenv("REMOTE_ADDR")."', NOW(), '0');";
    //echo $insert."<br>";

    mysql_query($sql_insert, $conn_voip) or die (mysql_error());
    mysql_query($sql_insert_log, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."voip_bpn/vinvoice.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id       	= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    $id_cc_card	= isset($_POST['id_cc_card']) ? mysql_real_escape_string(trim($_POST['id_cc_card'])) : '';
    $date	= isset($_POST['date']) ? mysql_real_escape_string(trim($_POST['date'])) : '';
    $title	= isset($_POST['title']) ? mysql_real_escape_string(trim($_POST['title'])) : '';
    $description= isset($_POST['description']) ? mysql_real_escape_string(trim($_POST['description'])) : '';
    $reference 	= isset($_POST['reference']) ? mysql_real_escape_string(trim($_POST['reference'])) : '';
    
    //Update into cc_subscription_service
    $sql_update = "UPDATE `mya2billing`.`cc_invoice` SET `reference`='".$reference."',
    `id_card`='".$id_cc_card."', `date`='".$date."', `title`='".$title."', `description`='".$description."'
    WHERE (`id`='".$id."');";
    
    $sql_update_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`,
    `description`, `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
    VALUES (NULL, '1', '3', 'A INVOICE UPDATED', 'A RECORD IS UPDATED, EDITION CALUSE USED IS  id=".$id." ',
    'id_card = ".$id_cc_card." |description = ".$description." |title = ".$title." | date = ".$date." | Web Software GX (".$loggedin["username"].")',
    'cc_invoice', 'form_vinvoice.php',
    '".getenv("REMOTE_ADDR")."', NOW(), '0');";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn_voip) or die (mysql_error());
    mysql_query($sql_update_log, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);

   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."voip_bpn/vinvoice.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_invoice	= isset($_GET['id']) ? $_GET['id'] : '';
    $query_invoice 	= "SELECT * FROM `cc_invoice` WHERE `id` ='".$id_invoice."' LIMIT 0,1;";
    $sql_invoice	= mysql_query($query_invoice, $conn_voip);
    $row_invoice	= mysql_fetch_array($sql_invoice);

}

    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-7"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Invoice</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_invoice" id="form_invoice" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>ID Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" readonly="" required="" name="id_cc_card" id="id_cc_card" value="'.(isset($_GET['id']) ? $row_invoice["id_card"] : '').'">
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_invoice["id"] : '').'" readonly="">
						<input type="hidden" name="reference" value="'.(isset($_GET['id']) ? $row_invoice["reference"] : '').'" readonly="">
						
					    </div>
					    <div class="col-xs-4">
						
						<a href="'.URL_ADMIN.'voip_bpn/data_subscription.php?r=form_invoice" class="btn bg-olive btn-flat margin pull-right" onclick="return valideopenerform(\''.URL_ADMIN.'voip_bpn/data_subscription.php?r=form_invoice\',\'invoice\');">Select</a>
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Invoice Date</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="date" id="date" value="'.(isset($_GET['id']) ? $row_invoice["date"] : date("Y-m-d H:i:s")).'">
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Title</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required=""  name="title" value="'.(isset($_GET['id']) ? $row_invoice["title"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Description</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" name="description" style="resize:none;">'.(isset($_GET['id']) ? $row_invoice["description"] : "").'</textarea>
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

    $title	= 'Form Invoice';
    $submenu	= "voip_invoice";
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