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
include ("../../config/configuration_voip_bali.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
    
if(isset($_POST["save"]))
{
    
    $invoice_number = isset($_POST['invoice_number']) ? mysql_real_escape_string(trim($_POST['invoice_number'])) : '';
    $id_voip         = isset($_POST['id_voip']) ? mysql_real_escape_string(trim($_POST['id_voip'])) : '';
    $id_paket       = isset($_POST['id_paket']) ? mysql_real_escape_string(trim($_POST['id_paket'])) : '';
    $invoice_date   = isset($_POST['invoice_date']) ? mysql_real_escape_string(trim($_POST['invoice_date'])) : '';
    $invoice_duedate= isset($_POST['invoice_duedate']) ? mysql_real_escape_string(trim($_POST['invoice_duedate'])) : '';
    $invoice_amount = isset($_POST['invoice_amount']) ? mysql_real_escape_string(trim($_POST['invoice_amount'])) : '';
    $invoice_status = isset($_POST['invoice_status']) ? mysql_real_escape_string(trim($_POST['invoice_status'])) : '';
    $invoice_desc   = isset($_POST['invoice_desc']) ? mysql_real_escape_string(trim($_POST['invoice_desc'])) : '';
    
    //insert into gxCabang
    $sql_insert = "INSERT INTO `gx_voip_invoice` (`id_invoice`, `invoice_number`, `id_voip`, `id_paket`,
                    `invoice_date`, `invoice_duedate`, `invoice_amount`, `invoice_status`, `invoice_desc`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES (NULL, '".$invoice_number."', '".$id_voip."', '".$id_paket."',
                    '".$invoice_date."', '".$invoice_duedate."', '".$invoice_amount."',
                    '".$invoice_status."', '".$invoice_desc."',
                    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."voip/list_invoice.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id_invoice     = isset($_POST['id_invoice']) ? mysql_real_escape_string(trim($_POST['id_invoice'])) : '';    
    $invoice_number = isset($_POST['invoice_number']) ? mysql_real_escape_string(trim($_POST['invoice_number'])) : '';
    $id_voip         = isset($_POST['id_voip']) ? mysql_real_escape_string(trim($_POST['id_voip'])) : '';
    $id_paket       = isset($_POST['id_paket']) ? mysql_real_escape_string(trim($_POST['id_paket'])) : '';
    $invoice_date   = isset($_POST['invoice_date']) ? mysql_real_escape_string(trim($_POST['invoice_date'])) : '';
    $invoice_duedate= isset($_POST['invoice_duedate']) ? mysql_real_escape_string(trim($_POST['invoice_duedate'])) : '';
    $invoice_amount = isset($_POST['invoice_amount']) ? mysql_real_escape_string(trim($_POST['invoice_amount'])) : '';
    $invoice_status = isset($_POST['invoice_status']) ? mysql_real_escape_string(trim($_POST['invoice_status'])) : '';
    $invoice_desc   = isset($_POST['invoice_desc']) ? mysql_real_escape_string(trim($_POST['invoice_desc'])) : '';
    
    //update gx_vod_invoice    
    $sql_update = "UPDATE `gx_vod_invoice` SET `invoice_number` = '".$invoice_number."',
                    `id_voip` = '".$id_voip."', `id_paket` = '".$id_paket."',
                    `invoice_date` = '".$invoice_date."', `invoice_duedate` = '".$invoice_duedate."',
                    `invoice_amount` = '".$invoice_amount."', `invoice_status` = '".$invoice_status."',
                    `invoice_desc` = '".$invoice_desc."',
                    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
                    WHERE `id_invoice` = '".$id_invoice."';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."voip/list_invoice.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_invoice		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_invoice 	= "SELECT * FROM `gx_vod_invoice` WHERE `id_invoice`='$id_invoice' LIMIT 0,1;";
    $sql_invoice	= mysql_query($query_invoice, $conn);
    $row_invoice	= mysql_fetch_array($sql_invoice);
    
}
    
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Invoice</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="">
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Invoice Number</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="invoice_number" value="'.(isset($_GET['id']) ? $row_invoice["invoice_number"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Invoice Date</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="invoice_date" value="'.(isset($_GET['id']) ? $row_invoice["invoice_date"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Invoice Due Date</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="invoice_duedate" value="'.(isset($_GET['id']) ? $row_invoice["invoice_duedate"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Customer</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="id_voip" value="'.(isset($_GET['id']) ? $row_invoice["id_voip"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Paket</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="id_paket" value="'.(isset($_GET['id']) ? $row_invoice["id_paket"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Invoice Amount</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="invoice_amount" value="'.(isset($_GET['id']) ? $row_invoice["invoice_amount"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Invoice Status</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="invoice_status" value="'.(isset($_GET['id']) ? $row_invoice["invoice_status"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="invoice_desc" value="'.(isset($_GET['id']) ? $row_invoice["invoice_desc"] : "").'">
					    </div>
                                        </div>
					</div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" value="'.(isset($_GET['id']) ? 'name="update"' : 'name="save"').'" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
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
	header("location: logout.php");
    }

?>