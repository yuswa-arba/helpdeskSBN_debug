<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Detail Invoice Data");
global $conn;
global $conn_voip;
 
$sql_cust = mysql_query("SELECT `tbCustomer`.* FROM `tbCustomer`
			     WHERE `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_cust = mysql_fetch_array($sql_cust);


    $id_invoice		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_invoice 	= "SELECT `gx_invoice`.* , `tbCustomer`.*
			FROM `gx_invoice`, `tbCustomer`
			WHERE `gx_invoice`.`customer_number` = `tbCustomer`.`cKode`
			AND `gx_invoice`.`id_invoice` ='".$id_invoice."' LIMIT 0,1;";
    $sql_invoice	= mysql_query($query_invoice, $conn);
    $row_invoice	= mysql_fetch_array($sql_invoice);
    
    $query_invoice_item	= "SELECT * FROM `gx_invoice_detail` WHERE `kode_invoice` ='".$row_invoice["kode_invoice"]."' AND `desc` = 'INTERNET';";
    $sql_invoice_item	= mysql_query($query_invoice_item, $conn);

            
    $content ='<div class="pad margin no-print " hidden>
                    <div class="alert alert-info" style="margin-bottom: 0!important;">
                        <i class="fa fa-info"></i>
                        <b>Note:</b> This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                    </div>
                </div>

                <!-- Main content -->
                <section class="content invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> GlobalXtreme ISP
                                <small class="pull-right"><tr>
        <td width="73%"><div align="right"><span class="stylelogoindosat">powered by <strong>IFONE</strong> </span></div></td>
        <td width="27%"><div align="center"><span class="stylelogoindosat"><img src="'.URL.'img/logo-indosat.png"  height="25" /></span></div></td>
      </tr></small>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>GlobalXtreme Malang</strong><br>
                                Ruko Istana Dinoyo E4-E5<br>
                                Jl. MT Haryono 1A, Malang<br>
                                Phone: (0341) 573 222<br/>
                                Email: info@globalxtreme.net
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <span class="inv3">'.$row_cust['cNama'].'</span><br>
                                <span class="inv2">'.$row_cust['cAlamat1'].'<br>
                                '.$row_cust['cKota'].'<br>
                                Phone: '.$row_cust['ctelp'].'<br/>
                                Email: '.$row_cust['cEmail'].'</span>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #'.$row_invoice["id_invoice"].'</b><br/>
                            <b>Date:</b> '.date("d-m-Y", strtotime($row_invoice["tanggal_tagihan"])).'<br/>
                            <b>Order ID:</b> '.$row_invoice["kode_invoice"].'<br/>
                            <b>Payment Due:</b> '.date("d-m-Y", strtotime($row_invoice["tanggal_jatuh_tempo"])).'<br/>
                            <b>Account:</b> 
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>';
                                $no = 1;
                                $total_price = 0;
                                while($row_invoice_item = mysql_fetch_array($sql_invoice_item))
                                {
                            $content .='
                                <tbody>
                                    <tr>
                                        <td>'.$no.'.</td>
                                        <td>'.date("d-m-Y", strtotime($row_invoice_item["date"])).'</td>
                                        <td>'.$row_invoice_item["desc"].'</td>
                                        <td>'.Rupiah($row_invoice_item["harga"]).'</td>
                                        </tr>
                                    </tr>
                                </tbody>';
                                        $no++;
                                        $total_price = $total_price + $row_invoice_item["harga"];
                                }
                            $content .='
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
                            <p class="lead">Amount Due '.date("d-m-Y", strtotime($row_invoice["tanggal_jatuh_tempo"])).'</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>'.Rupiah($total_price).'</td>
                                    </tr>
                                    <tr>
                                        <th>Tax (10%)</th>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping:</th>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>'.Rupiah($total_price).'</td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            
			    <button class="btn btn-success pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print </button>
			    <a href="'.URL.'data/inpdf.php?id='.$id_invoice.'" class="btn btn-primary pull-right" style="margin-right: 5px;" target="_blank"><i class="fa fa-download"></i> Generate PDF</a>
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


    $title	= 'Invoice Internet';
    $submenu	= "inet_invoice";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"green");
    
    echo $template;
}
    } else{
	header("location: ".URL."logout.php");
    }

?>