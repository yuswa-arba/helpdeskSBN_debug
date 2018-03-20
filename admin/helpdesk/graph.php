<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

 include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}

    global $conn;
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

foreach (range(1, $jum_hari) as $day) {
    $date = $t.'-'.$b.'-' . str_pad($day, 2, '0', STR_PAD_LEFT);



//$date = date( "Y-m-d", strtotime($year."W".$week."$i") ); // First day of week

//echo $date.'<br>';

	$jum_total_request = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'request' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0';", $conn));
	
	$jum_total_problem = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
	$jum_total_problem_fo = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'FO' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
	$jum_total_problem_fo_cust = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'FO' AND
		  `gx_helpdesk_complaint`.`which_side` = 'Customer' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
	$jum_total_problem_fo_isp = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'FO' AND
		  `gx_helpdesk_complaint`.`which_side` = 'isp' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
	$jum_total_problem_wifi = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'wireless' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
	$jum_total_problem_wifi_cust = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'wireless' AND
		  `gx_helpdesk_complaint`.`which_side` = 'Customer' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
	$jum_total_problem_wifi_isp = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'wireless' AND
		  `gx_helpdesk_complaint`.`which_side` = 'isp' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
	$jum_total_cleared = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`status` = 'cleared' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
	$jum_total_uncleared = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`status` = 'uncleared' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));

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


	}else
	{

//$date = date("Y-m-d");

$year = date("Y"); // Year 2010
$week1 = isset($_GET["w"]) ? (int)$_GET["w"] : ""; // Week 1
$week = ($week1=="") ? date("W") : sprintf("%02s", $week1); // Week 1
//echo "week:".$week;
//echo "week2:".$week1;

$data_graph = 'series: [';

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
$data_date ="";


for($i=1;$i<=7; $i++){

$date = date( "Y-m-d", strtotime($year."W".$week."$i") ); // First day of week

//echo $date.'<br>';

	$jum_total_request = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'Request' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0';", $conn));
	
	$jum_total_problem = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'Problem' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0';", $conn));
    
	$jum_total_problem_fo = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'Problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'FO' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0';", $conn));
    
	$jum_total_problem_fo_cust = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'Problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'FO' AND
		  `gx_helpdesk_complaint`.`which_side` = 'Customer' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0';", $conn));
    
	$jum_total_problem_fo_isp = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'Problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'FO' AND
		  `gx_helpdesk_complaint`.`which_side` = 'ISP' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0';", $conn));
    
	$jum_total_problem_wifi = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'Problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'Wireless' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0';", $conn));
    
	$jum_total_problem_wifi_cust = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'Problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'Wireless' AND
		  `gx_helpdesk_complaint`.`which_side` = 'Customer' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0';", $conn));
    
	$jum_total_problem_wifi_isp = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'Problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'Wireless' AND
		  `gx_helpdesk_complaint`.`which_side` = 'ISP' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0';", $conn));
    
	$jum_total_cleared = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`status` = 'cleared' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0';", $conn));
    
	$jum_total_uncleared = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  `gx_helpdesk_complaint`.`status` = 'uncleared' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0';", $conn));

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

//echo $data_graph1;color: {['#FC0101','#012AFC','#04B625','#FFCC00','#3D96AE']},

	}

$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Graph Complaint
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Summary</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								<a href="summary_complaint.php" class="btn bg-maroon btn-flat margin">Summary Complaint</a>
								<div id="container" style="min-width: 400px; height: 500px; margin: 0 auto"></div>
								
    <br>
</div>
    <br />
            </div> 
       </div>';

$submenu	= "helpdesk_complaint";
$plugins	= '<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
           
	    chart: {
                renderTo: \'container\',
                type: \'column\'
            },
            title: { '.((isset($_GET["b"]) && isset($_GET["t"])) ?	"text: 'Statistik Complaint Bulan ".date("F", mktime(0, 0, 0, (int)$_GET["b"], 10))." Tahun ".(int)$_GET["t"]."'" : "text: 'Statistik Complaint'").'
		},
            xAxis: {
		title:{
			text: \'Tanggal\'
		}, '.$date_cat.'
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
                    return \'<b>\'+ this.x +\'</b><br/>\'+
                        this.series.name +\': \'+ this.y +\'<br/>\'+
                        \'Total: \'+ this.point.stackTotal;
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
            },'.$data_graph1.'
			});
    });
    
});
</script>
<script src="'.URL.'config/graph/highcharts.js"></script>
<script src="'.URL.'config/graph/exporting.js"></script>
       ';

    $title	= 'Graph';
    
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
     else{
	header("location: ".URL_CSO."logout.php");
    }

?>