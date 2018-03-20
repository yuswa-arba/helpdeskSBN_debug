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
    enableLog($loggedin["id_user"], $loggedin["username"], "", "Open menu paket");
    
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
                    

//Array for userID Complaint
$replaceWord = array("/", '\/', ";", ",");


$stats_content .='

<div id="graphDashboard" style="min-width:100%; height: 380px; margin: 0 auto;"></div>
                    
                    
                    </div>
                </div>';
//DATA VOIP
$sql_paket_voip = mysql_query("SELECT `gx_paket`.* FROM `gx_paket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_voip` = `gx_paket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_voip = mysql_fetch_array($sql_paket_voip);
$sql_saldo = mysql_query("SELECT `credit`, `useralias` FROM `cc_card` WHERE `useralias` = '".$loggedin["id_voip"]."' LIMIT 0,1;", $conn_voip);
$row_saldo = mysql_fetch_array($sql_saldo);

    $content ='<!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">
		    <!-- Main row -->
		    <div class="row">
			<section class="col-lg-6">
			<div class="box box-solid box-danger">
			    <div class="box-header">
				<h3 class="box-title">Current Status Voip/Telepon</h3>
				<div class="box-tools pull-right">
				    <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
				    <button class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			    </div>
			    <div class="box-body">
				Nomer Telpon : <b>'.$row_saldo["useralias"].'</b><br>
				Saldo : <b>'.Rupiah((int)$row_saldo["credit"]).'</b><br>
				Nama Paket : '.(($row_paket_voip["nama_paket"] == "") ? "-" : $row_paket_voip["nama_paket"]).'<br>
				Expired Paket: '.(($row_paket_voip["periode_paket"] == "") ? "-" : ($row_paket_voip["periode_paket"]/24)).' Hari<br>
				Monthly fee: '.(($row_paket_voip["harga_paket"] == "" OR $row_paket_voip["harga_paket"] == "0") ? "-" : Rupiah($row_paket_voip["harga_paket"])).'<br><br>
				
				Status : '.(($row_paket_voip["level"] == "0") ? "Aktif" : "Nonaktif").'<br><br>
			    </div><!-- /.box-body -->
			</div><!-- /.box -->
			</section>
			<section class="col-lg-6">
			<div class="box box-solid box-info">
                                
                                <div class="box-body">
                                    <img src="'.URL.'img/voip/promo_voip.jpg">
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			</section>
		    </div>
                    <div class="row"><section class="col-lg-4">                            
			    <div class="box box-solid box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Monthly Abonnement</h3>
                                </div>
                                <div class="box-body">
                                    
				    Masa Aktif : 1 Bulan<br>
				    Harga Paket : Rp. 60.000,00<br><br>
				    Dengan rincian sbb:<br>
				    Abonemen : Rp. 60.000,00<br>
				    Saldo/pulsa : -<br><br><br><br><br>
				    <a href=""><span class="label label-warning">Beli Paket</span></a>
                                </div>
                            </div>
                        </section><section class="col-lg-4">                            
			    <div class="box box-solid box-warning">
                                <div class="box-header">
                                    <h3 class="box-title">Monthly Xtreme</h3>
                                </div>
                                <div class="box-body">
                                    
				    Masa Aktif : 1 Bulan<br>
				    Harga Paket : Rp. 150.000,00<br><br>
				    Dengan rincian sbb:<br>
				    Abonemen : Rp. 60.000,00<br>
				    Saldo/pulsa : Rp. 90.000,00<br><br><br><br><br>
				    <a href=""><span class="label label-warning">Beli Paket</span></a>
                                </div>
                            </div>
                        </section><section class="col-lg-4">                            
			    <div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Monthly Regular</h3>
                                </div>
                                <div class="box-body">
                                    
				    Masa Aktif : 1 Bulan<br>
				    Harga Paket : Rp. 100.000,00<br><br>
				    Dengan rincian sbb:<br>
				    Abonemen : Rp. 60.000,00<br>
				    Saldo/pulsa : Rp. 40.000,00<br><br><br><br><br>
				    <a href=""><span class="label label-warning">Beli Paket</span></a>
                                </div>
                            </div>
                        </section>            			
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


        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>
    ';

    $title	= 'Paket VOIP';
    $submenu	= "paket_voip";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"red");
    
    echo $template;
}
    } else{
	header("location: ".URL."logout.php");
    }

?>