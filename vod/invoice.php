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
include ("../config/configuration.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Menu Invoice");
global $conn;
global $conn_voip;

$id_invoice     = isset($_GET['id']) ? $_GET['id'] : "";

//data klien
$sql_cust = mysql_query("SELECT `tbCustomer`.* FROM `tbCustomer`
			     WHERE `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_cust = mysql_fetch_array($sql_cust);

//data invoice
$sql_invoice = "SELECT `gx_vod_invoice`.*, `gx_cabang`.* FROM `gx_vod_invoice`, `gxLogin`, `gx_cabang` 
                WHERE `gx_vod_invoice`.`id_vod` = `gxLogin`.`id_vod`
                AND `gxLogin`.`id_cabang` = `gx_cabang`.`id_cabang`
                AND `gx_vod_invoice`.`id_invoice` = '".$id_invoice."'
                AND `gx_vod_invoice`.`id_vod` = '".$loggedin["id_vod"]."' 
                AND `gx_vod_invoice`.`invoice_status` = 'unpaid' 
                AND `gx_vod_invoice`.`level` = '0' ;";
//echo $sql_invoice;
$query_invoice  = mysql_query($sql_invoice, $conn);
$row_invoice    = mysql_fetch_array($query_invoice);

//desc invoice
$sql_desc_invoice = "SELECT `gx_vod_invoice`.*, `gx_paket`.`nama_paket`
                FROM `gx_vod_invoice`, `gx_paket`
                WHERE `gx_vod_invoice`.`id_paket` = `gx_paket`.`id_paket`
                AND `gx_vod_invoice`.`id_invoice` = '".$id_invoice."'
                AND `gx_vod_invoice`.`id_vod` = '".$loggedin["id_vod"]."' 
                AND `gx_vod_invoice`.`invoice_status` = 'unpaid' 
                AND `gx_vod_invoice`.`level` = '0' ;";
//echo $sql_desc_invoice;
$query_desc_invoice  = mysql_query($sql_desc_invoice, $conn);
            
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
                                    <td width="73%"><div align="right"><span class="stylelogoindosat">powered by <strong>IFONE</strong> </span></div></td>
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
                                <strong>'.$row_invoice["nama_cabang"].'</strong><br>
                                '.$row_invoice["alamat_cabang"].'<br>
                                Phone: '.$row_invoice["telp_cabang"].'<br/>
                                Email: '.$row_invoice["email_cabang"].'
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
			    Invoice Number: <b>'.$row_invoice["invoice_code"].'-'.$row_invoice["invoice_number"].'</b><br/>
			    Date: <b>'.$row_invoice["invoice_date"].'</b><br/>
                            Payment Due: <b>'.$row_invoice["invoice_duedate"].'</b><br/>
                            Account: <b>'.$row_cust["cKode"].'</b>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Product</th>
                                        
                                        <th>Description</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>';

$no = 1;
while($row_desc_invoice    = mysql_fetch_array($query_desc_invoice))
{
    $content .='<tr>
                <td>'.$no.'.</td>
                <td>'.$row_desc_invoice["nama_paket"].'</td>
                <td>'.$row_desc_invoice["invoice_desc"].'</td>
                <td>'.Rupiah($row_desc_invoice["invoice_amount"]).'</td>
            </tr>';
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
                            <p class="lead">Amount Due '.$row_invoice["invoice_duedate"].'</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>'.Rupiah($row_invoice["invoice_amount"]).'</td>
                                    </tr>
                                    <tr>
                                        <th>Tax (10%)</th>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>'.Rupiah($row_invoice["invoice_amount"]).'</td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            
			    <button class="btn btn-success pull-left" onclick="window.print();"><i class="fa fa-print"></i> Print </button>
			    <a href="detail_invoice.php?id='.$id_invoice.'" class="btn btn-primary pull-left" style="margin-left: 5px;" target="_blank"><i class="fa fa-download"></i> Generate PDF</a>
                            <!--<button class="btn btn-primary pull-right" onclick="window.print();" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
                        </div>
                    </div>
                </section><!-- /.content -->
            ';

$plugins = '
	
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="'.URL.'js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="'.URL.'js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="'.URL.'js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="'.URL.'js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="'.URL.'js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="'.URL.'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="'.URL.'js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<script type="text/javascript">
            $(function() {
                $("#callhistory").dataTable();
                $(\'#example2\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
	
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>

    ';


    $title	= 'Detail Invoice VOD';
    $submenu	= "vod_invoice";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"yellow");
    
    echo $template;
}
    } else{
	header("location: ".URL."logout.php");
    }

?>