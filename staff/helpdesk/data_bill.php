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
if($loggedin = logged_inStaff()){ // Check if they are logged in
if($loggedin["group"] == 'staff'){
    
    global $conn;
    global $conn_voip;
    
$id_invoice     = isset($_GET['id_invoice']) ? $_GET['id_invoice'] : "";
$customer_number= isset($_GET['c']) ? $_GET['c'] : "";
$type		= isset($_GET['type']) ? $_GET['type'] : "";

//data customer
$sql_customer = "SELECT `gx_cabang`.*, `tbCustomer`.* FROM `tbCustomer`, `gx_cabang`, `gxLogin`
                WHERE `gxLogin`.`id_cabang` = `gx_cabang`.`id_cabang`
                AND `gxLogin`.`customer_number` = `tbCustomer`.`cKode`
		AND `gxLogin`.`customer_number` = '".$customer_number."';";
//echo $sql_invoice;
$query_customer  = mysql_query($sql_customer, $conn);
$row_customer    = mysql_fetch_array($query_customer);

//data invoice
$conn_soft = Config::getInstanceSoft();
$sql_invoice = $conn_soft->prepare("SELECT TOP 1 * FROM [4RBSSQL].[dbo].[Bills], [4RBSSQL].[dbo].[Users]
					     WHERE [Bills].[UserIndex] = [Users].[UserIndex]
					     AND [Bills].[BillIndex] = '".$id_invoice."'");

$sql_invoice->execute();
$row_invoice = $sql_invoice->fetch();

    $content ='
                <!--<div class="pad margin no-print">
                    <div class="alert alert-info" style="margin-bottom: 0!important;">
                        <i class="fa fa-info"></i>
                        <b>Note:</b> This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                    </div>
                </div>-->

                <!-- Main content -->
                <section class="content invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <img src="'.URL.'img/gx-1111000.png" height="25px" /> GlobalXtreme ISP
                                <small class="pull-right">
                                </small>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>'.$row_customer["nama_cabang"].'</strong><br>
                                '.$row_customer["alamat_cabang"].'<br>
                                Phone: '.$row_customer["telp_cabang"].'<br/>
                                Email: '.$row_customer["email_cabang"].'
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <span class="inv3"><b>'.$row_customer['cNama'].'</b></span><br>
                                <span class="inv2">'.$row_customer['cAlamat1'].'<br>
                                '.$row_customer['cKota'].'<br>
                                Phone: '.$row_customer['ctelp'].'<br/>
                                Email: '.$row_customer['cEmail'].'</span>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
			    Invoice Number: <b>#'.$row_invoice["BillIndex"].'</b><br/>
			    Date: <b>'.date("d-m-Y", strtotime($row_invoice["CreateDate"])).'</b><br/>
                            Payment Due: <b></b><br/>
                            Account: <b>'.$row_customer["cKode"].'</b>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Product/Item</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>';

$conn_soft2 = Config::getInstanceSoft();
     
     $sql_detail_invoice = $conn_soft2->prepare("SELECT * FROM [4RBSSQL].[dbo].[BillsSections]
					     WHERE [BillsSections].[BillIndex] = '".$id_invoice."'");
     
     $sql_detail_invoice->execute();
     //$row_billing_transaksi = $sql_billing_transaksi->fetch();
     $row_detail_invoice = $sql_detail_invoice->fetchAll(PDO::FETCH_ASSOC);
     $no = 1;
     $total = 0;

foreach ($row_detail_invoice as $rows)
{
    
    
    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.typeBillSoft($rows["Type"]).'</td>
		<td>'.$rows["Remark"].'</td>
		<td>'.AngkaSoft($rows["Charge"]).'</td>
		
	      </tr>';
    //<td>'.number_format(round($total,2), 2).'</td>
    $total = $total + $rows["Charge"];
    $no++;
}

$content .='
                                </tbody>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                            <p class="lead">Payment Methods:</p>
                            <img src="'.URL.'img/credit/visa.png" alt="Visa"/>
                            <img src="'.URL.'img/credit/mastercard.png" alt="Mastercard"/>
                            
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                
                            </p>
                        </div><!-- /.col -->
                        <div class="col-xs-6">
                            <!--<p class="lead">Amount Due</p>-->
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>'.AngkaSoft($total).'</td>
                                    </tr>
                                    <!--<tr>
                                        <th>Tax (10%)</th>
                                        <td>0</td>
                                    </tr>-->
                                    <tr>
                                        <th>Total:</th>
                                        <td>'.AngkaSoft($total).'</td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            
			    <button class="btn btn-success pull-left" onclick="window.print();"><i class="fa fa-print"></i> Print </button>
			    <a href="pdf.php?id='.$id_invoice.'&c='.$customer_number.'" class="btn btn-primary pull-left" style="margin-left: 5px;" target="_blank"><i class="fa fa-download"></i> Generate PDF</a>
                            <!--<button class="btn btn-primary pull-right" onclick="window.print();" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
                        </div>
                    </div>
                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Data Billing';
    $submenu	= "helpdesk";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_STAFF.'logout.php');
    }

?>