<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration_admin.php");
include 'kuota/routeros_api.class.php';

//use PEAR2\Net\RouterOS;
//require_once '../../config/telnet/PEAR2_Net_RouterOS-1.0.0b4.phar';

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){

global $conn;

//log
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open menu data usage");

$conn_soft2 = Config::getInstanceSoft();


$sql_user_h10 = $conn_soft2->prepare("SELECT [dbo].[Users].[UserID]
                                     FROM [dbo].[Users], [dbo].[AccountTypes]
                                     WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex] AND
                                    [Users].[GroupName] = 'h.10'
                                     AND [Users].[userActive] = '1';");
$sql_user_h10->execute();
$sql_user_h10 = $sql_user_h10->fetchAll(PDO::FETCH_ASSOC);  
$total_user_h10 = count($sql_user_h10);

foreach($sql_user_h10 as $user_h10):
    
    $sql_total_data = $conn_soft2->prepare("SELECT  ISNULL([AcctOutputOctets], 0) AS totalin,
                                       ISNULL([AcctInputOctets], 0) AS totalout,
                                       ISNULL([AcctSessionTime], 0) AS totaltime
                        FROM [dbo].[Accountinglog]
                        WHERE  [Accountinglog].[UserId] = '".$user_h10["UserID"]."'
                        AND MONTH(AcctDate) = ".date("m")." AND YEAR(AcctDate) = ".date("Y").";");


    $sql_total_data->execute();
    
    
    $total_kuota = 0;
    $totalin = 0;
    $totalout = 0;
    $totaltime = 0;
    $bw = '-';
    
    $row_total_data = $sql_total_data->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($row_total_data as $kuota)
    {
        $totalin = $totalin + ($kuota["totalin"]);
        $totalout = $totalout + ($kuota["totalout"]);
        $totaltime = $totaltime + ($kuota["totaltime"]);
        $total_kuota = $total_kuota + ($kuota["totalin"] + $kuota["totalout"]);
        
    }
    $data_h10[] = array('name' => $user_h10["UserID"],
                        'y' => round(($total_kuota/1024/1024/1024), 2));
    
    $data_user_h10[] = $user_h10["UserID"];

endforeach;



$sql_user_h8 = $conn_soft2->prepare("SELECT [dbo].[Users].[UserID]
                                     FROM [dbo].[Users], [dbo].[AccountTypes]
                                     WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex] AND
                                    [Users].[GroupName] = 'h.08'
                                     AND [Users].[userActive] = '1';");
$sql_user_h8->execute();
$sql_user_h8 = $sql_user_h8->fetchAll(PDO::FETCH_ASSOC);  
$total_user_h8 = count($sql_user_h8);

foreach($sql_user_h8 as $user_h8):
    
    $sql_total_data = $conn_soft2->prepare("SELECT  ISNULL([AcctOutputOctets], 0) AS totalin,
                                       ISNULL([AcctInputOctets], 0) AS totalout,
                                       ISNULL([AcctSessionTime], 0) AS totaltime
                        FROM [dbo].[Accountinglog]
                        WHERE  [Accountinglog].[UserId] = '".$user_h8["UserID"]."'
                        AND MONTH(AcctDate) = ".date("m")." AND YEAR(AcctDate) = ".date("Y").";");


    $sql_total_data->execute();
    
    
    $total_kuota = 0;
    $totalin = 0;
    $totalout = 0;
    $totaltime = 0;
    $bw = '-';
    
    $row_total_data = $sql_total_data->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($row_total_data as $kuota)
    {
        $totalin = $totalin + ($kuota["totalin"]);
        $totalout = $totalout + ($kuota["totalout"]);
        $totaltime = $totaltime + ($kuota["totaltime"]);
        $total_kuota = $total_kuota + ($kuota["totalin"] + $kuota["totalout"]);
        
    }
    $data_h8[] = array('name' => $user_h8["UserID"],
                        'y' => round(($total_kuota/1024/1024/1024), 2));
    $data_user_h8[] = $user_h8["UserID"];
endforeach;


$sql_user_h5 = $conn_soft2->prepare("SELECT [dbo].[Users].[UserID]
                                     FROM [dbo].[Users], [dbo].[AccountTypes]
                                     WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex] AND
                                    [Users].[GroupName] = 'h.05'
                                     AND [Users].[userActive] = '1';");
$sql_user_h5->execute();
$sql_user_h5 = $sql_user_h5->fetchAll(PDO::FETCH_ASSOC);  
$total_user_h5 = count($sql_user_h5);

foreach($sql_user_h5 as $user_h5):
    
    $sql_total_data = $conn_soft2->prepare("SELECT  ISNULL([AcctOutputOctets], 0) AS totalin,
                                       ISNULL([AcctInputOctets], 0) AS totalout,
                                       ISNULL([AcctSessionTime], 0) AS totaltime
                        FROM [dbo].[Accountinglog]
                        WHERE  [Accountinglog].[UserId] = '".$user_h5["UserID"]."'
                        AND MONTH(AcctDate) = ".date("m")." AND YEAR(AcctDate) = ".date("Y").";");


    $sql_total_data->execute();
    
    
    $total_kuota = 0;
    $totalin = 0;
    $totalout = 0;
    $totaltime = 0;
    $bw = '-';
    
    $row_total_data = $sql_total_data->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($row_total_data as $kuota)
    {
        $totalin = $totalin + ($kuota["totalin"]);
        $totalout = $totalout + ($kuota["totalout"]);
        $totaltime = $totaltime + ($kuota["totaltime"]);
        $total_kuota = $total_kuota + ($kuota["totalin"] + $kuota["totalout"]);
        
    }
    $data_h5[] = array('name' => $user_h5["UserID"],
                        'y' => round(($total_kuota/1024/1024/1024), 2));
    $data_user_h5[] = $user_h5["UserID"];

endforeach;


$sql_user_h2 = $conn_soft2->prepare("SELECT [dbo].[Users].[UserID]
                                     FROM [dbo].[Users], [dbo].[AccountTypes]
                                     WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex] AND
                                    [Users].[GroupName] = 'h.02'
                                     AND [Users].[userActive] = '1';");
$sql_user_h2->execute();
$sql_user_h2 = $sql_user_h2->fetchAll(PDO::FETCH_ASSOC);  
$total_user_h2 = count($sql_user_h2); 

foreach($sql_user_h2 as $user_h2):
    
    $sql_total_data = $conn_soft2->prepare("SELECT  ISNULL([AcctOutputOctets], 0) AS totalin,
                                       ISNULL([AcctInputOctets], 0) AS totalout,
                                       ISNULL([AcctSessionTime], 0) AS totaltime
                        FROM [dbo].[Accountinglog]
                        WHERE  [Accountinglog].[UserId] = '".$user_h2["UserID"]."'
                        AND MONTH(AcctDate) = ".date("m")." AND YEAR(AcctDate) = ".date("Y").";");


    $sql_total_data->execute();
    
    
    $total_kuota = 0;
    $totalin = 0;
    $totalout = 0;
    $totaltime = 0;
    $bw = '-';
    
    $row_total_data = $sql_total_data->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($row_total_data as $kuota)
    {
        $totalin = $totalin + ($kuota["totalin"]);
        $totalout = $totalout + ($kuota["totalout"]);
        $totaltime = $totaltime + ($kuota["totaltime"]);
        $total_kuota = $total_kuota + ($kuota["totalin"] + $kuota["totalout"]);
        
    }
    $data_h2[] = array('name' => $user_h2["UserID"],
                        'y' => round(($total_kuota/1024/1024/1024), 2));
    $data_user_h2[] = $user_h2["UserID"];

endforeach;

    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h4 class="box-title">Grafik</h4>
								</div><!-- /.box-header -->
								<div class="box-body">
									<div id="grafik" class="col-lg-12" style="height: 400px;"></div>
								</div>
							</div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-lg-4 col-xs-12">
                            <div class="box">
								<div class="box-header">
									<h4 class="box-title">Bandwidth 10MB</h4>
								</div><!-- /.box-header -->
								<div class="box-body">
									<div id="grafik10" class="col-lg-12" style="height: 300px;"></div>
								</div>
							</div>
                        </div><!-- /.col -->
                    
                        <div class="col-lg-4 col-xs-12">
                            <div class="box">
								<div class="box-header">
									<h4 class="box-title">Bandwidth 8MB</h4>
								</div><!-- /.box-header -->
								<div class="box-body">
									<div id="grafik8" class="col-lg-12" style="height: 300px;"></div>
								</div>
							</div>
                        </div><!-- /.col -->
                        <div class="col-lg-4 col-xs-12">
                            <div class="box">
								<div class="box-header">
									<h4 class="box-title">Bandwidth 5MB</h4>
								</div><!-- /.box-header -->
								<div class="box-body">
									<div id="grafik5" class="col-lg-12" style="height: 300px;"></div>
								</div>
							</div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
								<div class="box-header">
									<h4 class="box-title">Bandwidth 2MB</h4>
								</div><!-- /.box-header -->
								<div class="box-body">
									<div id="grafik2" class="col-lg-12" style="height: 300px;"></div>
								</div>
							</div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->

            ';

$plugin = '
<script src="/sbn/beta/plugins/highcharts/code/highcharts.js"></script>
<script src="/sbn/beta/plugins/highcharts/code/modules/data.js"></script>
<script src="/sbn/beta/plugins/highcharts/code/modules/drilldown.js"></script>

<script type="text/javascript">

// Create the chart
Highcharts.chart(\'grafik\', {
    chart: {
        type: \'column\'
    },
    title: {
        text: \'Group Bandwidth User SBN\'
    },
    subtitle: {
        text: \'Klik kolom untuk lihat detail.\'
    },
    xAxis: {
        type: \'category\'
    },
    yAxis: {
        title: {
            text: \'Total User\'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: \'{point.y}\'
            }
        }
    },

    tooltip: {
        headerFormat: \'<span style="font-size:11px">{series.name}</span><br>\',
        pointFormat: \'<span style="color:{point.color}">Total Users :{point.name}</span>: <b>{point.y}</b><br/>\'
    },

    series: [{
        name: \'Group Bandwidth\',
        colorByPoint: true,
        data: [{
            name: \'BW 10MB\',
            y: '.$total_user_h10.'
        }, {
            name: \'BW 8MB\',
            y: '.$total_user_h8.'
        }, {
            name: \'BW 5MB\',
            y: '.$total_user_h5.'
        }, {
            name: \'BW 1MB\',
            y: '.$total_user_h2.'
        }]
    }]
    
});
		</script>
        
<script type="text/javascript">

// Create the chart
Highcharts.chart(\'grafik10\', {
    chart: {
        type: \'column\'
    },
    title: {
        text: \'Group Bandwidth 10Mbps\'
    },
    subtitle: {
        text: \'Klik kolom untuk lihat detail.\'
    },
    xAxis: {
        type: \'category\',
        categories: '.json_encode($data_user_h10).'
    },
    yAxis: {
        title: {
            text: \'Kuota (GB)\'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: \'{point.y}\'
            }
        }
    },

    tooltip: {
        headerFormat: \'<span style="font-size:11px">Total Pemakaian Kuota {point.x}</span><br>\',
        pointFormat: \'<b>{point.y}</b><br/>\'
    },

    series: [{
        name: \'User SBN\',
        colorByPoint: true,
        data: '.json_encode($data_h10).'
    }]
    
});
		</script>
<script type="text/javascript">

// Create the chart
Highcharts.chart(\'grafik8\', {
    chart: {
        type: \'column\'
    },
    title: {
        text: \'Group Bandwidth 8Mbps\'
    },
    subtitle: {
        text: \'Klik kolom untuk lihat detail.\'
    },
    xAxis: {
        type: \'category\',
        categories: '.json_encode($data_user_h8).'
    },
    yAxis: {
        title: {
            text: \'Kuota (GB)\'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: \'{point.y}\'
            }
        }
    },

    tooltip: {
        headerFormat: \'<span style="font-size:11px">Total Pemakaian Kuota {point.x}</span><br>\',
        pointFormat: \'<b>{point.y}</b><br/>\'
    },

    series: [{
        name: \'User SBN\',
        colorByPoint: true,
        data: '.json_encode($data_h8).'
    }]
    
});
		</script>
<script type="text/javascript">

// Create the chart
Highcharts.chart(\'grafik5\', {
    chart: {
        type: \'column\'
    },
    title: {
        text: \'Group Bandwidth 5Mbps\'
    },
    subtitle: {
        text: \'Klik kolom untuk lihat detail.\'
    },
    xAxis: {
        type: \'category\',
        categories: '.json_encode($data_user_h5).'
    },
    yAxis: {
        title: {
            text: \'Kuota (GB)\'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: \'{point.y}\'
            }
        }
    },

    tooltip: {
        headerFormat: \'<span style="font-size:11px">Total Pemakaian Kuota {point.x}</span><br>\',
        pointFormat: \'<b>{point.y}</b><br/>\'
    },

    series: [{
        name: \'User SBN\',
        colorByPoint: true,
        data: '.json_encode($data_h5).'
    }]
    
});
		</script>
<script type="text/javascript">

// Create the chart
Highcharts.chart(\'grafik2\', {
    chart: {
        type: \'column\'
    },
    title: {
        text: \'Group Bandwidth 2Mbps\'
    },
    subtitle: {
        text: \'Klik kolom untuk lihat detail.\'
    },
    xAxis: {
        type: \'category\',
        categories: '.json_encode($data_user_h2).'
    },
    yAxis: {
        title: {
            text: \'Kuota (GB)\'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: \'{point.y}\'
            }
        }
    },

    tooltip: {
        headerFormat: \'<span style="font-size:11px">Total Pemakaian Kuota {point.x}</span><br>\',
        pointFormat: \'<b>{point.y}</b><br/>\'
    },

    series: [{
        name: \'User SBN\',
        colorByPoint: true,
        data: '.json_encode($data_h2).'
    }]
    
});
		</script>
		';

    $title	= 'Grafik Cek Bandwidth';
    $submenu	= "inet_datausage";
    $plugins	= $plugin;
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>