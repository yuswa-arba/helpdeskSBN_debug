<?php
include ("../../config/configuration_admin.php");

$stats_content ='<h4>'.((isset($_GET["b"]) && isset($_GET["t"])) ? 'Bulan '.date("F", mktime(0, 0, 0, (int)$_GET["b"], 10)).' Tahun '.(int)$_GET["t"] : '').'</h4>
                
                <form action="" method="get">
  Sort by
<select name="sort" onchange="location.href=\'home.php\'+options[selectedIndex].value;">
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

$stats_content .='

<div id="graphDashboard" style="min-width:100%; height: 380px; margin: 0 auto;"></div>
                    
                    
                    </div>
                </div>
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
                ';
?>

<small id="dummy-time" class="pad pull-right text-muted"></small>
<small class="pull-right pad text-muted">Last update:</small>

<div class="row">
    <div class="col-sm-12">
        <!-- bar chart -->
        <?php echo $stats_content; ?>
    </div>
    
</div><!-- /.row - inside box -->
                                    
<script type="text/javascript">
    var now = new Date();
    var strDateTime = [[AddZero(now.getDate()), AddZero(now.getMonth() + 1), now.getFullYear()].join("/"), [AddZero(now.getHours()), AddZero(now.getMinutes())].join(":"), now.getHours() >= 12 ? "PM" : "AM"].join(" ");

    //Pad given value to the left with "0"
    function AddZero(num) {
        return (num >= 0 && num < 10) ? "0" + num : num + "";
    }
    var x = document.getElementById("dummy-time");
    x.innerHTML = strDateTime;
</script>