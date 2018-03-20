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

if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'super_admin' || $loggedin["group"] == 'admin' || $loggedin["group"] == 'manager' || $loggedin["group"] == 'kabag' || $loggedin["group"] == 'na' || $loggedin["group"] == 'cso'){
    
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
            
    $content ='<section class="content-header">
                    <h1>
                        Dashboard
                        <small>Customer Service</small>
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
                        <div class="col-lg-3 col-xs-3">
                            
                            <a class="btn btn-app" style="width:100px;height:80px;"><span class="badge bg-yellow">+</span><i class="glyphicon glyphicon-file" style="margin:0 auto; font-size:35px;"></i> New Complaint</a>
                            <a class="btn btn-app" style="width:100px;height:80px;"><span class="badge bg-yellow">+</span><i class="glyphicon glyphicon-file" style="margin:0 auto; font-size:35px;"></i> Trouble Ticket</a>
                            <a class="btn btn-app" style="width:100px;height:80px;"><span class="badge bg-yellow">+</span><i class="glyphicon glyphicon-file" style="margin:0 auto; font-size:35px;"></i> SPK Tech</a>
                            <a class="btn btn-app" style="width:100px;height:80px;"><span class="badge bg-yellow">+</span><i class="glyphicon glyphicon-file" style="margin:0 auto; font-size:35px;"></i> SPK Marketing</a>
                        </div><!-- ./col -->
                        <div class="col-lg-9 col-xs-9">
                            <div class="box box-danger" id="loading-pending">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                    <i class="fa fa-th-list"></i>

                                    <h3 class="box-title">Complaint Pending</h3>
                                </div><!-- /.box-header -->
                            
                                <div class="box-body">
                                    
                                    <table id="ComplaintPending" class="table table-bordered table-hover">
                                        <tbody><tr>
                                            <th style="width: 10px">#</th>
                                            <th>UserID</th>
                                            <th>Ticket Number</th>
                                            <th>Spk Number</th>
                                            <th>Teknisi</th>
                                            <th>Status</th>
                                        </tr>';

    $date_sql = date("Y-m-d"); //getdate converted day
    $sql_complaint_pending = "SELECT `gx_complaint`.`id_complaint`, `gx_complaint`.`ticket_number`, `gx_complaint`.`name`, `gx_complaint`.`cust_number`, `gx_complaint`.`status`
			    FROM `gx_complaint`
			    WHERE `gx_complaint`.`status` = 'open'
			    AND `gx_complaint`.`date_add` NOT LIKE '%$date_sql%'
			    ORDER BY `gx_complaint`.`date_add` DESC LIMIT 0,10;";
			    //echo $sql_complaint_pending;
    $query_complaint_pending = mysql_query($sql_complaint_pending);

$no = 1;
while($row_complaint_pending = mysql_fetch_array($query_complaint_pending)){

    $sql_spk = mysql_query("SELECT `gx_spk`.*, `gx_employee`.`id_employee`, `gx_employee`.`first_name` FROM `gx_spk`, `gx_employee`
                           WHERE `gx_spk`.`id_teknisi` = `gx_employee`.`id_employee`
                           AND `gx_spk`.`level` = '0'
                           AND `gx_spk`.`id_trouble_ticket` = '".$row_complaint_pending["ticket_number"]."' LIMIT 0,1;");
    $row_spk = mysql_fetch_array($sql_spk);
    $sum_spk = mysql_num_rows($sql_spk);
    $content .='<tr>
            <td>'.$no.'.</td>
            <td><a href="info.php?idC='.str_replace(' ', '', $row_complaint_pending["cust_number"]).'" onclick="return valideopenerform(\'info.php?idC='.str_replace(' ', '', $row_complaint_pending["cust_number"]).'\',\'customer'.$row_complaint_pending["id_complaint"].'\');">'.str_replace($replaceWord, '<br>', $row_complaint_pending["name"]).'</a></td>
            <td><a href="info.php?idT='.str_replace(' ', '', $row_complaint_pending["ticket_number"]).'" onclick="return valideopenerform(\'info.php?idT='.str_replace(' ', '', $row_complaint_pending["ticket_number"]).'\',\'ticket'.$row_complaint_pending["id_complaint"].'\');">'.$row_complaint_pending["ticket_number"].'</a></td>
            <td>'.(($sum_spk == 1) ? '<a href="info.php?idS='.str_replace(' ', '', $row_spk["spk_number"]).'"  onclick="return valideopenerform(\'info.php?idS='.str_replace(' ', '', $row_spk["spk_number"]).'\',\'spk'.$row_spk["id_spk"].'\');">'.$row_spk["spk_number"].'</a>' : "-").'</a></td>
            <td>'.(($sum_spk == 1) ? '<a href="info.php?idTech='.str_replace(' ', '', $row_spk["id_employee"]).'"  onclick="return valideopenerform(\'info.php?idTech='.str_replace(' ', '', $row_spk["id_employee"]).'\',\'teknisi'.$row_spk["id_spk"].'\');">'.$row_spk["first_name"].'</a>' : "-").'</td>
            
            <td><span class="label label-danger">'.$row_complaint_pending["status"].'</span></td>
        </tr>';
        $no++;
}

$content .='</tbody></table>
            
                                </div><!-- /.box-body -->
                            </div>
                        
                            <div class="col-lg-6" style="padding-left:0;">
                            &nbsp;
                            </div>
                            
                            <div class="col-lg-6"  style="padding-right:0;">
                            &nbsp;
                            </div>
                            
                        </div><!-- ./col -->
                        
                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-6 connectedSortable"> 
                            <!-- Box (Complaint Today) -->
                            <div class="box box-success" id="loading-today">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                    <i class="fa fa-th-list"></i>

                                    <h3 class="box-title">Complaint Today</h3>
                                </div><!-- /.box-header -->
                                
                                <div class="box-body">
                                    
                                    <table id="ComplaintToday" class="table table-bordered table-hover">
                                        <tbody><tr>
                                            <th style="width: 10px">#</th>
                                            <th>UserID</th>
                                            <th>Ticket Number</th>
                                            <th>Spk Number</th>
                                            <th>Teknisi</th>
                                            <th>Status</th>
                                        </tr>';

    $date_sql = date("Y-m-d"); //getdate converted day
    $sql_complaint_today = "SELECT `gx_complaint`.`id_complaint`, `gx_complaint`.`ticket_number`, `gx_complaint`.`name`, `gx_complaint`.`cust_number`, `gx_complaint`.`status`
			    FROM `gx_complaint`
			    WHERE `gx_complaint`.`status` = 'open'
                            AND `gx_complaint`.`date_add` LIKE '%$date_sql%'
			    AND `gx_complaint`.`level` = '0' 
			    ORDER BY `gx_complaint`.`date_add` DESC LIMIT 0,10;";
			    //echo $sql_complaint_today;
    $query_complaint_today = mysql_query($sql_complaint_today);

$noToday = 1;
while($row_complaint_today = mysql_fetch_array($query_complaint_today)){
    $sql_spk = mysql_query("SELECT `gx_spk`.*, `gx_employee`.`id_employee`, `gx_employee`.`first_name` FROM `gx_spk`, `gx_employee`
                           WHERE `gx_spk`.`id_teknisi` = `gx_employee`.`id_employee`
                           AND `gx_spk`.`level` = '0'
                           AND `gx_spk`.`id_trouble_ticket` = '".$row_complaint_today["ticket_number"]."' LIMIT 0,1;");
    $row_spk = mysql_fetch_array($sql_spk);
    $sum_spk = mysql_num_rows($sql_spk);
    
    $content .='<tr>
            <td>'.$noToday.'.</td>
            <td><a href="info.php?idC='.str_replace(' ', '', $row_complaint_today["cust_number"]).'" onclick="return valideopenerform(\'info.php?idC='.str_replace(' ', '', $row_complaint_today["cust_number"]).'\',\'customer'.$row_complaint_today["id_complaint"].'\');">'.str_replace($replaceWord, '<br>', $row_complaint_today["name"]).'</a></td>
            <td><a href="info.php?idT='.str_replace(' ', '', $row_complaint_today["ticket_number"]).'" onclick="return valideopenerform(\'info.php?idT='.str_replace(' ', '', $row_complaint_today["ticket_number"]).'\',\'ticket'.$row_complaint_today["id_complaint"].'\');">'.$row_complaint_today["ticket_number"].'</a></td>
            <td>'.(($sum_spk == 1) ? '<a href="info.php?idS='.str_replace(' ', '', $row_spk["spk_number"]).'"  onclick="return valideopenerform(\'info.php?idS='.str_replace(' ', '', $row_spk["spk_number"]).'\',\'spk'.$row_spk["id_spk"].'\');">'.$row_spk["spk_number"].'</a>' : "-").'</a></td>
            <td>'.(($sum_spk == 1) ? '<a href="info.php?idTech='.str_replace(' ', '', $row_spk["id_employee"]).'"  onclick="return valideopenerform(\'info.php?idTech='.str_replace(' ', '', $row_spk["id_employee"]).'\',\'teknisi'.$row_spk["id_spk"].'\');">'.$row_spk["first_name"].'</a>' : "-").'</td>
            
            <td>'.$row_complaint_today["status"].'</td>
        </tr>';
        $noToday++;
}

$content .='</tbody></table>
            
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            <!-- Box (Complaint Tommorow) -->
                            <div class="box box-warning" id="loading-tomorrow">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                    <i class="fa fa-th-list"></i>

                                    <h3 class="box-title">Schedule Complaint</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    
                                    <table id="ComplaintToday" class="table table-bordered table-hover">
                                        <tbody><tr>
                                            <th style="width: 10px">#</th>
                                            <th>UserID</th>
                                            <th>Ticket Number</th>
                                            <th>Spk Number</th>
                                            <th>Teknisi</th>
                                            <th>Status</th>
                                        </tr>';

    $date_sql = date("Y-m-d"); //getdate converted day
    $sql_complaint_tomorrow = "SELECT `gx_complaint`.`id_complaint`, `gx_complaint`.`ticket_number`, `gx_complaint`.`name`, `gx_complaint`.`cust_number`, `gx_complaint`.`status`
			    FROM `gx_complaint`
			    WHERE `gx_complaint`.`status` = 'open'
			    AND `gx_complaint`.`date_execution` = CURDATE() + INTERVAL 1 DAY
			    AND `gx_complaint`.`action` = 'tomorrow'
			    ORDER BY `gx_complaint`.`date_add` DESC LIMIT 0,10;";
    $query_complaint_tomorrow = mysql_query($sql_complaint_tomorrow);


$noTomorrow = 1;
while($row_complaint_tomorrow = mysql_fetch_array($query_complaint_tomorrow)){
	    
    $sql_spk = mysql_query("SELECT `gx_spk`.*, `gx_employee`.`id_employee`, `gx_employee`.`first_name`
                           FROM `gx_spk`, `gx_employee`
                           WHERE `gx_spk`.`id_teknisi` = `gx_employee`.`id_employee`
                           AND `gx_spk`.`level` = '0'
                           AND `gx_spk`.`id_trouble_ticket` = '".$row_complaint_tomorrow["ticket_number"]."' LIMIT 0,1;");
    $row_spk = mysql_fetch_array($sql_spk);
    $sum_spk = mysql_num_rows($sql_spk);
    $content .='<tr>
            <td>'.$noTomorrow.'.</td>
            <td><a href="info.php?idC='.str_replace(' ', '', $row_complaint_tomorrow["cust_number"]).'" onclick="return valideopenerform(\'info.php?idC='.str_replace(' ', '', $row_complaint_tomorrow["cust_number"]).'\',\'customer'.$row_complaint_tomorrow["id_complaint"].'\');">'.str_replace($replaceWord, '<br>', $row_complaint_tomorrow["name"]).'</a></td>
            <td><a href="info.php?idT='.str_replace(' ', '', $row_complaint_tomorrow["ticket_number"]).'" onclick="return valideopenerform(\'info.php?idT='.str_replace(' ', '', $row_complaint_tomorrow["ticket_number"]).'\',\'ticket'.$row_complaint_tomorrow["id_complaint"].'\');">'.$row_complaint_tomorrow["ticket_number"].'</a></td>
            <td>'.(($sum_spk == 1) ? '<a href="info.php?idS='.str_replace(' ', '', $row_spk["spk_number"]).'"  onclick="return valideopenerform(\'info.php?idS='.str_replace(' ', '', $row_spk["spk_number"]).'\',\'spk'.$row_spk["id_spk"].'\');">'.$row_spk["spk_number"].'</a>' : "-").'</a></td>
            <td>'.(($sum_spk == 1) ? '<a href="info.php?idTech='.str_replace(' ', '', $row_spk["id_employee"]).'"  onclick="return valideopenerform(\'info.php?idTech='.str_replace(' ', '', $row_spk["id_employee"]).'\',\'teknisi'.$row_spk["id_spk"].'\');">'.$row_spk["first_name"].'</a>' : "-").'</td>
            
            <td>'.$row_complaint_tomorrow["status"].'</td>
        </tr>';
        $noTomorrow++;
}

$content .='</tbody></table>
            
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            <!-- Box (with bar chart) -->
                            <div class="box box-danger" id="statsComplaint">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                    <i class="fa fa-cloud"></i>

                                    <h3 class="box-title">Statistik Complaint</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- bar chart -->
                                            '.$stats_content.'
                                        </div>
                                        
                                    </div><!-- /.row - inside box -->
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    
                                </div><!-- /.box-footer -->
                            </div><!-- /.box -->
                            
                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-6 connectedSortable">
                            
                            <!-- Calendar -->
                            <div class="box box-warning">
                                <div class="box-header">
                                    <i class="fa fa-calendar"></i>
                                    <div class="box-title">Schedule Maintance</div>
                                    
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <!-- button with a dropdown -->
                                        
                                            <button class="btn btn-warning btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                                            <button class="btn btn-warning btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a href="#">Add new event</a></li>
                                                <li><a href="#">Clear events</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">View calendar</a></li>
                                            </ul>
                                        
                                    </div><!-- /. tools -->                                    
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <!--The calendar -->
                                    <div id="calendar"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            
                            <!-- Map box -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <!-- tools box -->
                                    
                                    <div class="pull-right box-tools">                                        
                                        <button class="btn btn-primary btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                                        <!--<button class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range"><i class="fa fa-calendar"></i></button>-->
                                        <button class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    </div><!-- /. tools -->

                                    <i class="fa fa-map-marker"></i>
                                    <h3 class="box-title">
                                        GPS Tracker
                                    </h3>
                                </div>
                                <div class="box-body no-padding">
                                    <div id="world-map2" ></div>
                                    <div class="google-map-canvas" id="map-canvas" style="width:100%;height: 300px;"></div>
                                    <div class="table-responsive">
                                        <!-- .table - Uses sparkline charts-->
                                        <table class="table table-striped">
                                            <tr>
                                                <th>#</th>
                                                <th>Technician</th>
                                                <th>Last Position</th>
                                                <th>Status</th>
                                            </tr>
                                            <tr>
                                                <td>1.</td>
                                                <td><a href="#">Lutfi</a></td>
                                                <td>Denpasar (lat,long)</td>
                                                <td>Uncleared</td>
                                            </tr>
                                        </table><!-- /.table -->
                                    </div>
                                </div><!-- /.box-body-->
                                <div class="box-footer">
                                    <!--<button class="btn btn-info"><i class="fa fa-download"></i> Generate PDF</button>
                                    <button class="btn btn-warning"><i class="fa fa-bug"></i> Report Bug</button>-->
                                </div>
                            </div>
                            <!-- /.box -->

                            <!-- Notifikasi box -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-warning"></i> Notification</h3>
                                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                                        
                                            
                                            <button class="btn btn-primary btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>                                        
                                            <button class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        
                                    </div>
                                </div>
                                <div class="box-body chat" id="chat-box">
                                    <!-- chat item -->
                                    <div class="item">
                                        <img src="img/avatar.png" alt="user image" class="online"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                                                Mike Doe
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
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
                                </div><!-- /.chat -->
                                <div class="box-footer">
                                    
                                </div>
                            </div><!-- /.box (chat box) -->

                            <!-- TO DO List -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">To Do List</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>                                        
                                        <button class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        
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
                                            <span class="text">Design a nice theme</span>
                                            <!-- Emphasis label -->
                                            <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                                            <!-- General tools such as edit or delete-->
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>                                            
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Make the theme responsive</span>
                                            <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Let theme shine like a star</span>
                                            <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Let theme shine like a star</span>
                                            <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Check your messages and notifications</span>
                                            <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Let theme shine like a star</span>
                                            <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                    </ul>
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                    <button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                                    <ul class="pagination pagination-sm inline">
                                        <li><a href="#">&laquo;</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">&raquo;</a></li>
                                    </ul>
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
$plugins = '<!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="'.URL.'js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="'.URL.'js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="'.URL.'js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="'.URL.'js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="'.URL.'js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="'.URL.'js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="'.URL.'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="'.URL.'js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>
        
<!--HighCarts Added by Dwi -->
<script src="http://202.58.203.27/~helpdesk/js/graph/highcharts.js"></script>
<script src="http://202.58.203.27/~helpdesk/js/graph/exporting.js"></script>
<script type="text/javascript">
$(function () {
    var chartStats;
    $(document).ready(function() {
        chartStats = new Highcharts.Chart({
           
	    chart: {
                renderTo: \'graphDashboard\',
                type: \'column\'
            },
            title: {'.((isset($_GET["b"]) && isset($_GET["t"])) ? 'text: \'Statistik Complaint Bulan '.date("F", mktime(0, 0, 0, (int)$_GET["b"], 10)).' Tahun '.(int)$_GET["t"].'\'' : 'text: \'Statistik Complaint\'').'},
            xAxis: {
		title:{
			text: \'Tanggal\'
		},
                '.$date_cat.'
            },
            yAxis: {
                min: 0,
                title: {
                    text: \'Total Complaint\'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: \'bold\',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || \'gray\'
                    }
                }
            },
            legend: {
                backgroundColor: \'#FFFFFF\',
                reversed: true
            },
            tooltip: {
                formatter: function() {
                    return \'<b>Tanggal \'+ this.x +\'</b><br/>\'+
                        this.series.name +\'</a>: \'+ this.y +\'<br/>\'+
                        \'Total: \'+ this.point.stackTotal +\'<br/><br/>\'+
                        \'<a href="detail.php?t=\'+ this.x +\'">View Detail</a>\';
                }
            },
            plotOptions: {
                column: {
                    stacking: \'normal\',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || \'white\'
                    }
                }
            },
            '.$data_graph1.'
        });
    });
    
});
</script>

<!--GPS Google Maps-->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed"></script>
<script>
    function initialize() {
        var mapOptions = {
            center: new google.maps.LatLng(-8.672134, 115.2243929),
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),
        mapOptions);
    }
    google.maps.event.addDomListener(window, \'load\', initialize);
</script>
    ';

    $title	= 'Home';
    $submenu	= "dashboard";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= bootstrap_theme3($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: index.php");
    }

?>