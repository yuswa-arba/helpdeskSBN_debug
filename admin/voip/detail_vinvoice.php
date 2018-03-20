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
include ("../../config/configuration_voip_bali.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;
    global $conn_voip;
    
if(isset($_GET["id"]))
{
    $id_invoice		= isset($_GET['id']) ? $_GET['id'] : '';
    $query_invoice 	= "SELECT `cc_invoice`.* , `cc_card`.`firstname`, `cc_card`.`lastname`, `cc_card`.`username`,
			`cc_card`.`useralias`
			FROM `cc_invoice`, `cc_card`
			WHERE `cc_invoice`.`id_card` = `cc_card`.`id`
			AND `cc_invoice`.`id` ='".$id_invoice."' LIMIT 0,1;";
    $sql_invoice	= mysql_query($query_invoice, $conn_voip);
    $row_invoice	= mysql_fetch_array($sql_invoice);
    
    
//data customer
$sql_cust = mysql_query("SELECT `gx_cabang`.`nama_cabang`, `gx_cabang`.`alamat_cabang`, `gx_cabang`.`telp_cabang`, `gx_cabang`.`email_cabang`,
			`tbCustomer`.`cNama`, `tbCustomer`.`cAlamat1`, `tbCustomer`.`ctelp`, `tbCustomer`.`cEmail`, `tbCustomer`.`cKota`
			FROM `tbCustomer`, `gx_cabang`, `gx_voip_customer`
			WHERE `tbCustomer`.`id_cabang` = `gx_cabang`.`id_cabang`
			AND `tbCustomer`.`cKode` = `gx_voip_customer`.`customer_number`
			AND `gx_voip_customer`.`voip_number` = '".$row_invoice["useralias"]."';", $conn);
$row_cust = mysql_fetch_array($sql_cust);

            
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
                                <table>
                                <tr>
                                    <td width="73%"><div align="right"><span class="stylelogoindosat">powered by <strong>IPHONE</strong> </span></div></td>
                                    <td width="27%"><div align="center"><span class="stylelogoindosat"><img src="'.URL.'img/logo-indosat.png"  height="25" /></span></div></td>
                                </tr>
                                </table>
                                </small>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>'.$row_cust["nama_cabang"].'</strong><br>
                                '.$row_cust["alamat_cabang"].'<br>
                                Phone: '.$row_cust["telp_cabang"].'<br/>
                                Email: '.$row_cust["email_cabang"].'
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <span class="inv3"><b>'.$row_cust['cNama'].'</b></span><br>
                                <span class="inv2">'.$row_cust['cAlamat1'].'<br>
                                '.$row_cust['cKota'].'<br>
                                Phone: '.$row_cust['ctelp'].'<br/>
                                Email: '.$row_cust['cEmail'].'</span>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
			    Invoice Number: <b>'.$row_invoice["reference"].'</b><br/>
			    Date: <b>'.date("d-m-Y", strtotime($row_invoice["date"])).'</b><br/>
                            Payment Due: <b>'.date("d-m-Y", strtotime($row_invoice["date"])).'</b><br/>
                            Account: <b>'.$row_invoice["firstname"].' '.$row_invoice["lastname"].'('.$row_invoice["username"].')</b>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Date</th>
                                        
                                        <th>Description</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>';

$query_invoice_item	= "SELECT * FROM `cc_invoice_item` WHERE `id_invoice` ='".$id_invoice."';";
$sql_invoice_item	= mysql_query($query_invoice_item, $conn_voip);

$no = 1;
$total_price = 0;
$total_vat = 0;
$total_price_vat = 0;

while($row_invoice_item = mysql_fetch_array($sql_invoice_item))
{

    $content .='<tr>
    <td>'.$no.'.</td>
    <td>'.date("d-m-Y", strtotime($row_invoice_item["date"])).'</td>
    <td>'.$row_invoice_item["description"].'</td>
    <td>'.$row_invoice_item["price"].'</td>
    </tr>';
    $no++;
    $total_price = $total_price + $row_invoice_item["price"];
    $total_vat = $total_vat + $row_invoice_item["VAT"];
    $total_price_vat = $total_price_vat + ($row_invoice_item["price"] + $row_invoice_item["VAT"]);
    
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
                            <p class="lead">Amount Due '.(date("d-m-Y", strtotime($row_invoice["date"]))).'</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>'.Rupiah($total_price).'</td>
                                    </tr>
                                    <tr>
                                        <th>Tax (10%)</th>
                                        <td>'.Rupiah($total_vat).'</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>'.Rupiah($total_price_vat).'</td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            
			    <button class="btn btn-success pull-left" onclick="window.print();"><i class="fa fa-print"></i> Print </button>
			    <a href="pdf_vinvoice.php?id='.$id_invoice.'" class="btn btn-primary pull-left" style="margin-left: 5px;" target="_blank"><i class="fa fa-download"></i> Generate PDF</a>
                            <!--<button class="btn btn-primary pull-right" onclick="window.print();" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
                        </div>
                    </div>
                </section><!-- /.content -->
            ';
}
$plugins = '';

    $title	= 'List Invoice';
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