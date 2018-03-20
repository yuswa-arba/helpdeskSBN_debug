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
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Caller ID");
    global $conn;
    global $conn_voip;
    
if(isset($_GET["id"]) & isset($_GET["action"]))
{
    $id_invoice		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $action		= isset($_GET['action']) ? $_GET['action'] : '';
    
    if(($id_invoice != NULL) AND ($action == "lock")){
	
	$sql_update_lock = "UPDATE `mya2billing`.`cc_invoice` SET `status`='1' WHERE (`id`='".$id_invoice."');";
	
	//echo $sql_update;
	mysql_query($sql_update_lock, $conn_voip) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_lock);
    }
    header("location: vinvoice.php");

}
    
    
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                
				<div class="box-header">
                                    <h3 class="box-title">List Invoice</h3>
				    <a href="form_vinvoice.php" class="btn bg-olive btn-flat margin pull-right">Add Invoice</a>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Reference</th>
						<th>Account</th>
						<th>Date</th>
						<th>Title</th>
						<th>Paid Status</th>
						<th>Status</th>
						<th>Amount Incl VAT</th>
						<th width="120">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					

if(isset($_POST["search"])){
    
}else{
    $sql_invoice = mysql_query("SELECT `cc_invoice`.*, `cc_card`.`username`, `cc_card`.`firstname`, `cc_card`.`lastname`
				  FROM `cc_invoice`, `cc_card`
				  WHERE `cc_invoice`.`id_card` = `cc_card`.`id`
				  ORDER BY `cc_invoice`.`id` DESC;",$conn_voip);
}


$no = 1;
while ($row_invoice = mysql_fetch_array($sql_invoice))
{
    
    $sql_invoice_item = mysql_query("SELECT SUM(`price`) as `total`, SUM(`VAT`) as `total_vat` FROM `cc_invoice_item` WHERE `id_invoice` = '".$row_invoice["id"]."';", $conn_voip);
    $row_invoice_item = mysql_fetch_array($sql_invoice_item);
    
    $total_amount = $row_invoice_item["total"] + $row_invoice_item["total_vat"];
    
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td><a href="detail_vinvoice?id='.$row_invoice["id"].'">'.$row_invoice["reference"].'</a></td>
		    <td>'.$row_invoice["username"].'</td>
		    <td>'.date("d-m-Y", strtotime($row_invoice["date"])).'</td>
		    <td>'.$row_invoice["title"].'</td>
		    <td>'.(($row_invoice["paid_status"] == "1") ? '<span class="label label-success">Paid</span>' : '<span class="label label-danger">Unpaid</span>').'</td>
		    <td>'.(($row_invoice["status"] == "1") ? '<span class="label label-danger">Close</span>' : '<span class="label label-success">Open</span>').'</td>
		    <td>'.number_format($total_amount, 2, ',','.').' IDR</td>
		    
		    <td align="center">
		    '.(($row_invoice["status"] == "1") ? '<a href="pdf_vinvoice?id='.$row_invoice["id"].'" target="_blank"><span class="label label-info">PDF</span></a>
		       <a href="manage_payment?id='.$row_invoice["id"].'" ><span class="label label-info">Payment</span></a>' : '<a href="form_vinvoice_item?id_invoice='.$row_invoice["id"].'"><span class="label label-info">Detail</span></a>
		    <a href="form_vinvoice?id='.$row_invoice["id"].'"><span class="label label-info">Edit</span></a>
		    <a href="vinvoice?id='.$row_invoice["id"].'&action=lock"><span class="label label-info">Lock</span></a>
		    ').'
		    
		    
		    </td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#customer\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
    ';

    $title	= 'Invoice';
    $submenu	= "voip_invoice";
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