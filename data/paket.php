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
    enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Paket Data");
    
    global $conn;
    
    
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
//DATA Internet
//data paket
$conn_soft = Config::getInstanceSoft();
$sql_paket_data = $conn_soft->prepare("SELECT TOP 1 [Users].*, [AccountTypes].[AccountName], [AccountTypes].[AccountDescription]
  FROM [dbo].[Users], [dbo].[AccountTypes]
  WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex]
  AND [Users].[UserIndex] = '".$loggedin["user_index"]."';");

$sql_paket_data->execute();
$row_paket_data = $sql_paket_data->fetch();

//total pemakaian
$sql_total_data = $conn_soft->prepare("SELECT SUM( [Accountinglog].[AcctOutputOctets]) as totalout, SUM ([Accountinglog].[AcctInputOctets]) as totalin
  FROM [dbo].[Users], [dbo].[Accountinglog]
  WHERE [Users].[UserID] = [Accountinglog].[UserId]
  AND [Accountinglog].[UserId] = '".$loggedin["userid"]."';");

$sql_total_data->execute();
$row_total_data = $sql_total_data->fetch();


//max kuota
$sql_max_kuota = $conn_soft->prepare("SELECT [UserKBBank] as totalmax
  FROM [dbo].[Users]
  WHERE [Users].[UserIndex] = '".$loggedin["user_index"]."';");

$sql_max_kuota->execute();
$row_max_kuota = $sql_max_kuota->fetch();

$total_pemakaian_kuota = kuotaKB($row_total_data["totalin"] + $row_total_data["totalout"]);
$max_kuota = kuotaKB($row_max_kuota["totalmax"]);


    $content ='<!-- Main content -->
                <section class="content">
		    <!-- Main row -->
		    <div class="row">
			<section class="col-lg-6">
			<div class="box box-solid box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Status Data/Internet</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    Nama Paket : <b>'.(($row_paket_data["AccountDescription"] == "") ? "-" : $row_paket_data["AccountDescription"]).'</b><br>
				    Time Remaining: <b>'.(($row_paket_data["UserTimeBank"] == "") ? "-" : $row_paket_data["UserTimeBank"]).'</b><br>
				    Volume Based Remaining: <b>'.(($row_paket_data["UserKBBank"] == "0") ? "-" :  kuotaData($row_paket_data["UserKBBank"])).'</b><br><br>
				    
				    Status : '.(($row_paket_data["UserActive"] == "1") ? "Aktif" : "Nonaktif").'<br><br><br><br>
				    Total Pemakaian: '.(($row_max_kuota["totalmax"] == "0") ? "0 " :  round(($total_pemakaian_kuota/$max_kuota)*100)).' %
				    <div class="progress">
                                        <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="'.(($row_max_kuota["totalmax"] == "0") ? "0 " :  round(($total_pemakaian_kuota/$max_kuota)*100)).'"
										aria-valuemin="0" aria-valuemax="100"
										style="width: '.(($row_max_kuota["totalmax"] == "0") ? "0 " :  round(($total_pemakaian_kuota/$max_kuota)*100)).'%">
                                            <span class="sr-only">'.(($row_max_kuota["totalmax"] == "0") ? "0" :  round(($total_pemakaian_kuota/$max_kuota)*100)).'%</span>
                                        </div>
					<div class="progress-label pull-right">
					'.(($row_max_kuota["totalmax"] == "0") ? "0 " :  round(($total_pemakaian_kuota/$max_kuota)*100)).'%
					</div>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			</section>
			<section class="col-lg-6">
			<div class="box box-solid box-solid">
                                
                                <div class="box-body">
                                    <img src="'.URL.'img/data/promo_fo.jpg">
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			</section>
		    </div>
                    <div class="row">
			<section class="col-lg-4">                            
			    <div class="box box-solid box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Metro Services Silver</h3>
                                </div>
                                <div class="box-body">
                                    <p>Fiber Optic Symmetrical connection with speeds up to 3 Mbps for downloads & upload, perfect for basic web surfing and checking email.<br>
				    1. Ideal for home use up to 5 devices (Computers, Laptops, Tablets, ect)<br>
				    2. Estimated number of devices is not absolute, depending on activity and usage.<br>
				    3. This package does not provide a public IP.<br><br>
				    
				    Price IDR 1.000.000/month<br><br>
		    
				    <a href=""><span class="label label-warning">Change To This Package</span></a></p>
				    
                                </div>
                            </div>
                        </section>
			<section class="col-lg-4">                            
			    <div class="box box-solid box-warning">
                                <div class="box-header">
                                    <h3 class="box-title">Metro Services Gold</h3>
                                </div>
                                <div class="box-body">
                                    <p>Fiber Optic Symmetrical connection with speeds up to 4 Mbps for downloads & upload, large downloads & streaming video.<br>
				    1. Ideal for home use up to 7 devices (Computers, Laptops, Tablets, ect)<br>
				    2. Estimated number of devices is not absolute, depending on activity and usage.<br>
				    3. This package does not provide a public IP.<br><br>
				    
				    Price IDR 1.500.000/month<br><br>
		    
				    <a href=""><span class="label label-warning">Change To This Package</span></a></p>
				    
                                </div>
                            </div>
                        </section>
			<section class="col-lg-4">                            
			    <div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Metro Services Platinum</h3>
                                </div>
                                <div class="box-body">
                                    <p>Fiber Optic Symmetrical connection with speeds up to 6 Mbps for downloads & upload, perfect for gamers & streaming HD video.<br>
				    1. Ideal for home use up to 10 devices (Computers, Laptops, Tablets, ect)<br>
				    2. Estimated number of devices is not absolute, depending on activity and usage.<br>
				    3. This package does not provide a public IP.<br><br>
				    
				    Price IDR 2.500.000/month<br><br>
				    
				    <a href=""><span class="label label-warning">Change To This Package</span></a></p>
				    
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

    $title	= 'Paket Data Internet';
    $submenu	= "inet_paket";
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