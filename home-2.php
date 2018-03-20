<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("config/configuration.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
    
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
            
    $content ='<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-4 connectedSortable">                            
			    <div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Status Data/Internet</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    Status Paket : Nama Paket<br>
				    Expired Paket: 01 Agustus 2022<br>
				    Monthly fee: Rp. 5.000.000,00<br><br>
				    
				    Status : Aktif
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
                            <!-- List History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Nama Paket Promo</h3>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th style="width: 40px">Status</th>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td>Paket Inet 1</td>
                                            <td>Rp. 500.000,00</td>
                                            <td>Active</td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>Paket Inet 2</td>
                                            <td>Rp. 600.000,00</td>
                                            <td>Active</td>
                                        </tr>
					<tr>
                                            <td>3.</td>
                                            <td>Paket Inet 3</td>
                                            <td>Rp. 700.000,00</td>
                                            <td>Active</td>
                                        </tr>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </section><!-- /.Left col -->
                        
                        <section class="col-lg-4 connectedSortable">
			<div class="box box-solid box-warning">
                                <div class="box-header">
                                    <h3 class="box-title">Status Voip/Telepon</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-warning btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-warning btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
				    Nomer Telpon : 0341 - 555 555<br>
				    Saldo : Rp. 500.123,00<br>
                                    Status Paket : Nama Paket<br>
				    Expired Paket: 01 Agustus 2022<br>
				    Monthly fee: Rp. 50.000,00<br><br>
				    
				    Status : Aktif
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
                            <!-- List History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Call History</h3>
                                    <div class="box-tools">
                                        <ul class="pagination pagination-sm no-margin pull-right">
                                            <li><a href="#">&laquo;</a></li>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">&raquo;</a></li>
                                        </ul>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Destination</th>
                                            <th>Duration</th>
                                            <th>Rate</th>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td>08123456</td>
                                            <td>00:45</td>
                                            <td>Rp. 2000</td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>081123456</td>
                                            <td>00:45</td>
                                            <td>Rp. 2000</td>
                                        </tr>
					<tr>
                                            <td>3.</td>
                                            <td>081231456</td>
                                            <td>00:15</td>
                                            <td>Rp. 700</td>
                                        </tr>
					<tr>
                                            <td>4.</td>
                                            <td>081213456</td>
                                            <td>06:45</td>
                                            <td>Rp. 21000</td>
                                        </tr>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </section><!-- right col -->
			
			<section class="col-lg-4 connectedSortable">
			    <div class="box box-solid box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Status Video/VOD</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    OFF<br><br>
				    
				    <a href="" title="sign up">Sign up</a>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
                            <!-- List History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Paket VOD</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Nama Paket</th>
                                            <th>Harga</th>
                                            
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td>Paket VOD 1</td>
                                            <td>Rp. 50.000</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>Paket VOD 2</td>
                                            <td>Rp. 500.000</td>
                                            
                                        </tr>
					<tr>
                                            <td>3.</td>
                                            <td>Paket VOD 3</td>
                                            <td>Rp. 750.000</td>
                                            
                                        </tr>
					<tr>
                                            <td>4.</td>
                                            <td>Paket VOD 4</td>
                                            <td>Rp. 5.000.000</td>
                                            
                                        </tr>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			</section>
                    </div><!-- /.row (main row) -->

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

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>

    ';

    $title	= 'Home';
    $submenu	= "dashboard";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>