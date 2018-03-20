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
                    
if(isset($_GET["b"]) && isset($_GET["t"])){
	
$b = isset($_GET["b"]) ? (int)$_GET["b"] : "";
$t = isset($_GET["t"]) ? (int)$_GET["t"] : "";
$b = sprintf("%02s", $b);
/*	
function week_of_month($date) {
    $date_parts = explode('-', $date);
    $date_parts[2] = '01';
    $first_of_month = implode('-', $date_parts);
    $day_of_first = date('N', strtotime($first_of_month));
    $day_of_month = date('j', strtotime($date));
    return floor(($day_of_first + $day_of_month - 1) / 7) + 1;
}

$jum_hari = cal_days_in_month(CAL_GREGORIAN, $b, $t);

foreach (range(1, $jum_hari) as $day) {
    $test_date = $t.'-'.$b.'-' . str_pad($day, 2, '0', STR_PAD_LEFT);
    //echo "$test_date - ";
    echo week_of_month($test_date) . "<br>";
}	
*/
$data_graph = 'series: [';


$data_req = "";
$data_problem = "";
$data_problem_fo = "";
$data_problem_fo_cust = "";
$data_problem_fo_isp = "";
$data_problem_wifi = "";
$data_problem_wifi_cust = "";
$data_problem_wifi_isp = "";
$data_cleared = "";
$data_uncleared = "";
$data_date = "";

$jum_total_request = "";
$jum_total_problem = "";
$jum_total_problem_fo = "";
$jum_total_problem_fo_cust = "";
$jum_total_problem_fo_isp = "";
$jum_total_problem_wifi = "";
$jum_total_problem_wifi_cust = "";
$jum_total_problem_wifi_isp = "";
$jum_total_cleared = "";
$jum_total_uncleared = "";

$jum_hari = cal_days_in_month(CAL_GREGORIAN, $b, $t);

foreach (range(1, $jum_hari) as $day) {
    $date = $t.'-'.$b.'-' . str_pad($day, 2, '0', STR_PAD_LEFT);



//$date = date( "Y-m-d", strtotime($year."W".$week."$i") ); // First day of week

//echo $date.'<br>';

	$jum_total_request = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Request' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
	
	$jum_total_problem = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Problem' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_problem_fo = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Problem' AND
		  `gx_complaint`.`connection_type` = 'FO' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_problem_fo_cust = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Problem' AND
		  `gx_complaint`.`connection_type` = 'FO' AND
		  `gx_complaint`.`which_side` = 'Customer' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_problem_fo_isp = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Problem' AND
		  `gx_complaint`.`connection_type` = 'FO' AND
		  `gx_complaint`.`which_side` = 'ISP' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_problem_wifi = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Problem' AND
		  `gx_complaint`.`connection_type` = 'Wireless' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_problem_wifi_cust = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Problem' AND
		  `gx_complaint`.`connection_type` = 'Wireless' AND
		  `gx_complaint`.`which_side` = 'Customer' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_problem_wifi_isp = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Problem' AND
		  `gx_complaint`.`connection_type` = 'Wireless' AND
		  `gx_complaint`.`which_side` = 'ISP' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_cleared = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`status` = 'cleared' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_uncleared = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`status` = 'uncleared' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));

$data_req .= $jum_total_request.",";
$data_problem .= $jum_total_problem.",";
$data_problem_fo .= $jum_total_problem_fo.",";
$data_problem_fo_cust .= $jum_total_problem_fo_cust.",";
$data_problem_fo_isp .= $jum_total_problem_fo_isp.",";
$data_problem_wifi .= $jum_total_problem_wifi.",";
$data_problem_wifi_cust .= $jum_total_problem_wifi_cust.",";
$data_problem_wifi_isp .= $jum_total_problem_wifi_isp.",";
$data_cleared .= $jum_total_cleared.",";
$data_uncleared .= $jum_total_uncleared.",";

//$data_date .= "'$date',";
$data_date .= "'".sprintf("%02s", $day)."',";

}

$request		= substr($data_req, 0, -1);
$problem		= substr($data_problem, 0, -1);
$problem_fo		= substr($data_problem_fo, 0, -1);
$problem_fo_cust	= substr($data_problem_fo_cust, 0, -1);
$data_problem_fo_isp 	= substr($data_problem_fo_isp, 0, -1);
$problem_wifi 		= substr($data_problem_wifi, 0, -1);
$problem_wifi_cust 	= substr($data_problem_wifi_cust, 0, -1);
$problem_wifi_isp 	= substr($data_problem_wifi_isp, 0, -1);
$cleared		= substr($data_cleared, 0, -1);
$uncleared		= substr($data_uncleared, 0, -1);

$data_graph .= '{name: \'Request\',
                data: ['.$request.'],
		color: [\'#3CD2FD\']
            },';
/*$data_graph .= '{name: \'Problem\',
                data: ['.$problem.']
            },';
$data_graph .= '{name: \'Problem FO\',
                data: ['.$problem_fo.']
            },';*/
$data_graph .= '{name: \'Problem FO (Customer)\',
                data: ['.$problem_fo_cust.'],
		color: [\'#FD4B4B\']
            },';
$data_graph .= '{name: \'Problem FO (ISP)\',
                data: ['.$data_problem_fo_isp.'],
		color: [\'#F1FC49\']
            },';
/*$data_graph .= '{name: \'Problem Wifi\',
                data: ['.$problem_wifi.']
            },';*/
$data_graph .= '{name: \'Problem Wifi (Customer)\',
                data: ['.$problem_wifi_cust.'],
		color: [\'#64DC54\']
            },';
$data_graph .= '{name: \'Problem Wifi (ISP)\',
                data: ['.$problem_wifi_isp.'],
		color: [\'#FE9B60\']
            },';
/*$data_graph .= '{name: \'Cleared\',
                data: ['.$cleared.']
            },';
$data_graph .= '{name: \'Uncleared\',
                data: ['.$uncleared.']
            },';*/
$data_graph1 = substr($data_graph, 0, -1) . ']';

$data_date1 = substr($data_date, 0, -1);
$date_cat = "categories: [$data_date1]";
//$date_cat = "categories: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun']";


	}else{

//$date = date("Y-m-d");

$year = date("Y"); // Year 2010
$week1 = isset($_GET["w"]) ? (int)$_GET["w"] : ""; // Week 1
$week = ($week1=="") ? date("W") : sprintf("%02s", $week1); // Week 1
//echo "week:".$week;
//echo "week2:".$week1;

$data_graph = 'series: [';

$data_req = "";
$data_problem = "";
$data_problem_fo = "";
$data_problem_fo_cust = "";
$data_problem_fo_isp = "";
$data_problem_wifi = "";
$data_problem_wifi_cust = "";
$data_problem_wifi_isp = "";
$data_cleared = "";
$data_uncleared = "";
$data_date = "";

$jum_total_request = "";
$jum_total_problem = "";
$jum_total_problem_fo = "";
$jum_total_problem_fo_cust = "";
$jum_total_problem_fo_isp = "";
$jum_total_problem_wifi = "";
$jum_total_problem_wifi_cust = "";
$jum_total_problem_wifi_isp = "";
$jum_total_cleared = "";
$jum_total_uncleared = "";

for($i=1;$i<=7; $i++){

$date = date( "Y-m-d", strtotime($year."W".$week."$i") ); // First day of week

//echo $date.'<br>';

	$jum_total_request = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Request' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
	
	$jum_total_problem = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Problem' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_problem_fo = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Problem' AND
		  `gx_complaint`.`connection_type` = 'FO' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_problem_fo_cust = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Problem' AND
		  `gx_complaint`.`connection_type` = 'FO' AND
		  `gx_complaint`.`which_side` = 'Customer' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_problem_fo_isp = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Problem' AND
		  `gx_complaint`.`connection_type` = 'FO' AND
		  `gx_complaint`.`which_side` = 'ISP' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_problem_wifi = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Problem' AND
		  `gx_complaint`.`connection_type` = 'Wireless' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_problem_wifi_cust = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Problem' AND
		  `gx_complaint`.`connection_type` = 'Wireless' AND
		  `gx_complaint`.`which_side` = 'Customer' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_problem_wifi_isp = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Problem' AND
		  `gx_complaint`.`connection_type` = 'Wireless' AND
		  `gx_complaint`.`which_side` = 'ISP' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_cleared = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`status` = 'cleared' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_uncleared = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`status` = 'uncleared' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));

$data_req .= $jum_total_request.",";
$data_problem .= $jum_total_problem.",";
$data_problem_fo .= $jum_total_problem_fo.",";
$data_problem_fo_cust .= $jum_total_problem_fo_cust.",";
$data_problem_fo_isp .= $jum_total_problem_fo_isp.",";
$data_problem_wifi .= $jum_total_problem_wifi.",";
$data_problem_wifi_cust .= $jum_total_problem_wifi_cust.",";
$data_problem_wifi_isp .= $jum_total_problem_wifi_isp.",";
$data_cleared .= $jum_total_cleared.",";
$data_uncleared .= $jum_total_uncleared.",";

$data_date .= "'$date',";
}

$request		= substr($data_req, 0, -1);
$problem		= substr($data_problem, 0, -1);
$problem_fo		= substr($data_problem_fo, 0, -1);
$problem_fo_cust	= substr($data_problem_fo_cust, 0, -1);
$data_problem_fo_isp 	= substr($data_problem_fo_isp, 0, -1);
$problem_wifi 		= substr($data_problem_wifi, 0, -1);
$problem_wifi_cust 	= substr($data_problem_wifi_cust, 0, -1);
$problem_wifi_isp 	= substr($data_problem_wifi_isp, 0, -1);
$cleared		= substr($data_cleared, 0, -1);
$uncleared		= substr($data_uncleared, 0, -1);

$data_graph .= '{name: \'Request\',
                data: ['.$request.'],
		color: [\'#3CD2FD\']
            },';
/*$data_graph .= '{name: \'Problem\',
                data: ['.$problem.']
            },';
$data_graph .= '{name: \'Problem FO\',
                data: ['.$problem_fo.']
            },';*/
$data_graph .= '{name: \'Problem FO (Customer)\',
                data: ['.$problem_fo_cust.'],
		color: [\'#FD4B4B\']
            },';
$data_graph .= '{name: \'Problem FO (ISP)\',
                data: ['.$data_problem_fo_isp.'],
		color: [\'#F1FC49\']
            },';
/*$data_graph .= '{name: \'Problem Wifi\',
                data: ['.$problem_wifi.']
            },';*/
$data_graph .= '{name: \'Problem Wifi (Customer)\',
                data: ['.$problem_wifi_cust.'],
		color: [\'#64DC54\']
            },';
$data_graph .= '{name: \'Problem Wifi (ISP)\',
                data: ['.$problem_wifi_isp.'],
		color: [\'#FE9B60\']
            },';
/*$data_graph .= '{name: \'Cleared\',
                data: ['.$cleared.']
            },';
$data_graph .= '{name: \'Uncleared\',
                data: ['.$uncleared.']
            },';*/
$data_graph1 = substr($data_graph, 0, -1) . ']';

$data_date1 = substr($data_date, 0, -1);
$date_cat = "categories: [$data_date1]";
//$date_cat = "categories: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun']";

//echo $data_graph1;color: {['#FC0101','#012AFC','#04B625','#FFCC00','#3D96AE']},

	}

//echo $data_graph1;color: {['#FC0101','#012AFC','#04B625','#FFCC00','#3D96AE']},

//Statistik Complaint
$stat_complaint = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%';"));
$stat_ticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Problem';"));
$stat_nonticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Request';"));
$stat_prospek = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `status_prospek` = 'prospek';"));
$stat_nonprospek = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `status_prospek` = 'nonprospek';"));
$stat_spktech = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk` WHERE `date_add` LIKE '%".date("Y-m-")."%' AND `type_spk` = 'teknisi';"));
$stat_spkmkt = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk` WHERE `date_add` LIKE '%".date("Y-m-")."%' AND `type_spk` = 'marketing';"));


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

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        15 <sup style="font-size: 20px">Movies</sup>
                                    </h3>
                                    <p>
                                        VOD Movie Shop
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        53<sup style="font-size: 20px">Call</sup>
                                    </h3>
                                    <p>
                                        Rate VoIP Calls
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        0<sup style="font-size: 20px">% Downtime</sup>
                                    </h3>
                                    <p>
                                        SLA Internet
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
							<div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        0<sup style="font-size: 20px">Khusus Admin</sup>
                                    </h3>
                                    <p>
                                        VoIP User Registrations
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-7 connectedSortable">                            


                           

                            <!-- Messages box -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <i class="fa fa-comments-o"></i>
                                    <h3 class="box-title">Messages</h3>
                                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                                        <div class="btn-group" data-toggle="btn-toggle" >
                                            <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body chat" id="chat-box">
                                    <!-- chat item -->
                                    <div class="item">
                                        <img src="img/avatar.png" alt="user image" class="online"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                                                Kharis Amam
                                            </a>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                        </p>
                                        <div class="attachment">
                                            <h4>Attachments:</h4>
                                            <p class="filename">
                                                Theme-thumbnail-image.jpg
                                            </p>
                                            <div class="pull-right">
                                                <button class="btn btn-primary btn-sm btn-flat">Open</button>
                                            </div>
                                        </div><!-- /.attachment -->
                                    </div><!-- /.item -->
                                    <!-- chat item -->
                                    <div class="item">
                                        <img src="img/avatar2.png" alt="user image" class="offline"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                                                Dwi Wardiansah
                                            </a>
                                           Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
										   Vestibulum condimentum eros a ante aliquet, a interdum elit fringilla. 
                                        </p>
                                    </div><!-- /.item -->
                                    <!-- chat item -->
                                    <div class="item">
                                        <img src="img/avatar3.png" alt="user image" class="offline"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                                                Muammar Dafi
                                            </a>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent elementum convallis magna at lobortis.
                                        </p>
                                    </div><!-- /.item -->
                                </div><!-- /.chat -->
                                <div class="box-footer">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Type message..."/>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.box (chat box) -->                                                        

                            <!-- List Invoices -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Call History</h3>
                                    <div class="box-tools pull-right">
                                        <ul class="pagination pagination-sm inline">
                                            <li><a href="#">&laquo;</a></li>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">&raquo;</a></li>
                                        </ul>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <ul class="todo-list">
                                        <li>
                                            <!-- drag handle -->
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <!-- checkbox -->
                                            <input type="checkbox" value="" name=""/>
                                            <!-- todo text -->
                                            <span class="text">Lutfi - XL - 0892345</span>
                                            <!-- Emphasis label -->
                                            <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                                            <!-- General tools such as edit or delete-->
                                            <div class="tools">
                                                <i class="fa fa-clock-o"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Lutfi - XL - 0892345</span>
                                            <small class="label label-info"><i class="fa fa-clock-o"></i> 4 mins</small>
                                            <div class="tools">
                                                <i class="fa-clock-o"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Lutfi - XL - 0892345</span>
                                            <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 mins</small>
                                            <div class="tools">
                                                <i class="fa-clock-o"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Lutfi - XL - 0892345</span>
                                            <small class="label label-success"><i class="fa fa-clock-o"></i> 3 mins</small>
                                            <div class="tools">
                                                <i class="fa-clock-o"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Lutfi - XL - 0892345</span>
                                            <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 mins</small>
                                            <div class="tools">
                                                <i class="fa-clock-o"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Lutfi - XL - 0892345</span>
                                            <small class="label label-default"><i class="fa fa-clock-o"></i> 1 mins</small>
                                            <div class="tools">
                                                <i class="fa-clock-o"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                    </ul>
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                    <button class="btn btn-default pull-right"><i class="fa fa-money"></i> View Invoices</button>
                                </div>
                            </div><!-- /.box -->

                            <!-- quick email widget -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title">Email To Customer Service</h3>
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

                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-5 connectedSortable"> 



                            <!-- List Movies -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Movies</h3>
                                    <div class="box-tools">
                                        <ul class="pagination pagination-sm no-margin pull-right">
                                            <li><a href="#">&laquo;</a></li>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">&raquo;</a></li>
                                        </ul>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Title</th>
                                            <th>% View</th>
                                            <th style="width: 40px">Rate</th>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td>Cinta Fitri S.1 Ep. 3</td>
                                            <td>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-red">55</span></td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>Abraham Lincoln Vampire</td>
                                            <td>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-yellow">70</span></td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>Avatar</td>
                                            <td>
                                                <div class="progress xs progress-striped active">
                                                    <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-light-blue">30</span></td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td>Titanic 3D</td>
                                            <td>
                                                <div class="progress xs progress-striped active">
                                                    <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-green">90</span></td>
                                        </tr>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
							
							<!-- List Invoices -->
							<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Invoices</h3>
                                    <div class="box-tools">
                                        <div class="input-group">
                                            <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            
                                            <th>Invoices </th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Description</th>
                                        </tr>
                                        <tr>
                                            <td>183</td>
                                           
                                            <td>11-7-2014</td>
                                            <td><span class="label label-success">Paid</span></td>
                                            <td>Lorem ipsum 12 34 56</td>
                                        </tr>
                                        <tr>
                                            <td>219</td>
                                          
                                            <td>11-6-2014</td>
                                            <td><span class="label label-warning">Unpaid</span></td>
                                            <td>Lorem ipsum 12 34 56</td>
                                        </tr>
                                        <tr>
                                            <td>657</td>
                                        
                                            <td>11-5-2014</td>
                                            <td><span class="label label-primary">Paid</span></td>
                                            <td>Lorem ipsum 12 34 56</td>
                                        </tr>
                                        <tr>
                                            <td>175</td>
                                        
                                            <td>11-4-2014</td>
                                            <td><span class="label label-danger">Unpaid</span></td>
                                            <td>Lorem ipsum 12 34 56</td>
                                        </tr>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
							
							
							
							
                            <!-- Calendar -->
                            <div class="box box-solid bg-green-gradient">
                                <div class="box-header">
                                    <i class="fa fa-calendar"></i>
                                    <h3 class="box-title">Calendar</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <!-- button with a dropdown -->
                                        <div class="btn-group">
                                            <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a href="#">Add new event</a></li>
                                                <li><a href="#">Clear events</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">View calendar</a></li>
                                            </ul>
                                        </div>
                                        <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>                                        
                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <!--The calendar -->
                                    <div id="calendar" style="width: 100%"></div>
                                </div><!-- /.box-body -->  
                                <div class="box-footer text-black">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- Progress bars -->
                                            <div class="clearfix">
                                                <span class="pull-left">Task #1</span>
                                                <small class="pull-right">90%</small>
                                            </div>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                                            </div>

                                            <div class="clearfix">
                                                <span class="pull-left">Task #2</span>
                                                <small class="pull-right">70%</small>
                                            </div>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                                            </div>
                                        </div><!-- /.col -->
                                        <div class="col-sm-6">
                                            <div class="clearfix">
                                                <span class="pull-left">Task #3</span>
                                                <small class="pull-right">60%</small>
                                            </div>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                                            </div>

                                            <div class="clearfix">
                                                <span class="pull-left">Task #4</span>
                                                <small class="pull-right">40%</small>
                                            </div>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                                            </div>
                                        </div><!-- /.col -->
                                    </div><!-- /.row -->                                                                        
                                </div>
                            </div><!-- /.box -->                            

                        </section><!-- right col -->
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
	header("location: index.php");
    }

?>