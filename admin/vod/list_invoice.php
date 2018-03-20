<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;
    global $conn_voip;
    
$sql_invoice = "SELECT `gx_vod_invoice`.*, `gx_cabang`.`invoice_code` FROM `gx_vod_invoice`, `gxLogin`, `gx_cabang` 
                WHERE `gx_vod_invoice`.`id_vod` = `gxLogin`.`id_vod`
                AND `gxLogin`.`id_cabang` = `gx_cabang`.`id_cabang`
                AND `gx_vod_invoice`.`invoice_status` = 'unpaid' 
                AND `gx_vod_invoice`.`level` = '0' ;";
//echo $sql_invoice;
$query_invoice = mysql_query($sql_invoice, $conn);

    $content ='<section class="content-header">
                    <h1>
                        List Invoices
                        
                    </h1>
                    
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Invoice </h3>
                                    <div class="box-tools pull-right">
					<div class="btn bg-olive btn-flat margin">
					     <a href="'.URL_ADMIN.'vod/form_invoice.php">Create Invoice</a>
					</div>
					
				   </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>No.</th>
                                            <th>Invoice Number</th>
                                            <th>Invoice Date</th>
                                            <th>Due Date</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>';

$no = 1;
while($row_invoice = mysql_fetch_array($query_invoice))
{
    if($row_invoice["invoice_status"] == "unpaid")
    {
        $status = '<span class="label label-danger">Unpaid</span>';
    }elseif($row_invoice["invoice_status"] == "paid")
    {
        $status = '<span class="label label-success">Paid</span>';
    }
    $content .='<tr>
                    <td>'.$no.'.</td>
                    <td><a href="'.URL_ADMIN.'vod/invoice.php?id='.$row_invoice["id_invoice"].'" target="_blank">
                    '.$row_invoice["invoice_code"].'-'.$row_invoice["invoice_number"].'</a></td>
                    <td>'.$row_invoice["invoice_date"].'</td>
                    <td>'.$row_invoice["invoice_duedate"].'</td>
                    <td>'.Rupiah($row_invoice["invoice_amount"]).'</td>
                    <td>'.$status.'</td>
                    <td><a href="'.URL_ADMIN.'vod/invoice.php?id='.$row_invoice["id_invoice"].'" target="_blank">Detail</a> | 
                    <a href="'.URL_ADMIN.'vod/detail_invoice.php?id='.$row_invoice["id_invoice"].'" target="_blank">PDF</a> | 
                    <a href="'.URL_ADMIN.'vod/detail_invoice.php?id='.$row_invoice["id_invoice"].'" target="_blank">Pay</a></td>
                </tr>';
    $no++;
}

$content .='
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
                $(\'#usermanagement\').dataTable({
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

    $title	= 'List Invoice';
    $submenu	= "vod_invoice";
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