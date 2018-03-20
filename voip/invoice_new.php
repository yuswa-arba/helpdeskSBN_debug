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
    
    
    global $conn;
    global $conn_voip;
    
    $stats_content ='<h4>'.((isset($_GET["b"]) && isset($_GET["t"])) ? 'Bulan '.date("F", mktime(0, 0, 0, (int)$_GET["b"], 10)).' Tahun '.(int)$_GET["t"] : '').'</h4>
                
                <form action="" method="get">
  Sort by
<select name="sort" onchange="location.href=\'stats.php\'+options[selectedIndex].value;">
	<option value="">- Select -</option>
	<option value="">This Week</option>
	<option value="?b='.date("m").'&t='.date("Y").'">This Month</option>
        
</select>
</form>
                <div class="block">
                    <div id="chart1">';
                    
//echo $data_graph1;color: {['#FC0101','#012AFC','#04B625','#FFCC00','#3D96AE']},

//Statistik Complaint
/*$stat_complaint = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%';"));
$stat_ticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Problem';"));
$stat_nonticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Request';"));
$stat_prospek = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `status_prospek` = 'prospek';"));
$stat_nonprospek = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `status_prospek` = 'nonprospek';"));
$stat_spktech = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk` WHERE `date_add` LIKE '%".date("Y-m-")."%' AND `type_spk` = 'teknisi';"));
$stat_spkmkt = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk` WHERE `date_add` LIKE '%".date("Y-m-")."%' AND `type_spk` = 'marketing';"));
*/

//Array for userID Complaint
$replaceWord = array("/", '\/', ";", ",");


$stats_content .='

<div id="graphDashboard" style="min-width:100%; height: 380px; margin: 0 auto;"></div>
                    
                    
                    </div>
                </div>';
            
    $content ='<section class="content-header">
                    <h1>
                        Invoice
                        <small>#007612</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Examples</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>

                <div class="pad margin no-print">
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
                                <strong>Bejo Marpaung</strong><br>
                                Jl Raya Kembar 3<br>
                                Lowokwaru, Malang<br>
                                Phone: (0341) 539-1037<br/>
                                Email: bejo@marpaung.com
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Date: 2/10/2014<br/>
			    <b>Invoice #007612</b><br/>
                            <b>Order ID:</b> 4F3S8J<br/>
                            <b>Payment Due:</b> 2/22/2014<br/>
                            <b>Account:</b> 968-34567
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Product</th>
                                        <th>Serial #</th>
                                        <th>Description</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Internet</td>
                                        <td>455-981-221</td>
                                        <td>Internet Periode Agustus 2014<</td>
                                        <td>Rp. 1000.000</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>VoIP</td>
                                        <td>247-925-726</td>
                                        <td>Abonemen Periode Agustus 2014</td>
                                        <td>Rp. 60.000</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>VOD</td>
                                        <td>735-845-642</td>
                                        <td>Abonemen Periode Agustus 2014</td>
                                        <td>Rp. 60.000</td>
                                    </tr>
                                    
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
                            <p class="lead">Amount Due 09/22/2014</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>Rp. 1.120.000</td>
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
                                        <td>Rp. 1.120.000</td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            
			    <button class="btn btn-success pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print </button>
			    <a href="detail_invoice.php" class="btn btn-primary pull-right" style="margin-right: 5px;" target="_blank"><i class="fa fa-download"></i> Generate PDF</a>
                            <!--<button class="btn btn-primary pull-right" onclick="window.print();" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
                        </div>
                    </div>
                </section><!-- /.content -->
            ';

/*
 *<!-- quick email widget -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title">Quick Email</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                </div>
                                <div class="box-body">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="emailto" placeholder="Email to:"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject"/>
                                        </div>
                                        <div>
                                            <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>
                            
*/
$plugins = '
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="'.URL.'js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="'.URL.'js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="'.URL.'js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
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


        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>
    ';

    $title	= 'Home';
    $submenu	= "dashboard";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"red");
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>