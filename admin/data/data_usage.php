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

use PEAR2\Net\RouterOS;
require_once '../../config/telnet/PEAR2_Net_RouterOS-1.0.0b4.phar';

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){

global $conn;

//log
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open menu data usage");

    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h4 class="box-title">Search</h4>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <form role="form" method="POST" action="">
                                        <div class="box-body">
                                            <h5>Filter By UserID</h5>
                                            <div class="row">
                                                
                                                <div class="col-xs-9">
                                                    <p>Userid: <input type="text" value="" name="userid"></p>
                                                </div>
                                                
                                            </div>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="submit" name="search" class="btn btn-primary">Search</button>
											<button type="submit" name="cekbw" class="btn btn-primary">Check Filter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- interactive chart -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Data Usage</h3>
                                    <div class="box-tools pull-right">
                                        
                                    </div>
                                </div>
                                <div class="box-body table-responsive">
                                    <div id="cek_bw">
                                    
                                <table class="table table-hover table-border">
                                        <thead>
                                        <tr>
                                            <th><b>No</b></th>
                                            <th><b>UserID</b></th>
                                            <th><b>AccountName</b></th>
                                            <th><b>Sisa Time</b></th>
                                            <th><b>Sisa Kuota</b></th>
                                            <th><b>Download</b></th>
                                            <th><b>Upload</b></th>
                                            <th><b>Total Kuota</b></th>
                                            <th><b>Total Time</b></th>
                                            <th><b>GroupName</b></th>
                                            <th><b>Action</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                ';
//enableLog("","dwi", "dwi","cek bw");
if(isset($_POST["cekbw"]))
{
    
    $sql_data = mysql_query("SELECT * FROM `gx_inet_filter` WHERE `level` = '0' ORDER BY `id_filter` ASC;", $conn);
    $total_data = mysql_num_rows($sql_data);
    while($row_data = mysql_fetch_array($sql_data))
    
    {
        $sql_add = "";
        if($row_data["tipe_filter"] == "1")
        {
            $sql_add = "AND [Users].[GroupName] = '".$row_data["value"]."'";
        }
        elseif($row_data["tipe_filter"] == "2")
        {
            $sql_add = "AND [AccountTypes].[AccountName] = '".$row_data["value"]."'";
        }
        elseif($row_data["tipe_filter"] == "3")
        {
            $sql_add = "AND [Users].[UserID] = '".$row_data["value"]."'";
        }
        else
        {
            $sql_add = "";
        }
    
$no = 1;
$conn_soft = Config::getInstanceSoft();


$sql_all_user = $conn_soft ->prepare("SELECT [Users].*, [AccountTypes].[AccountName]
                                     FROM [dbo].[Users], [dbo].[AccountTypes]
                                     WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex]
                                     $sql_add
                                     AND [Users].[userActive] = '1';");
$sql_all_user->execute();

$kondisi1 = 'bw.5';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
$kondisi2 = 'bw.4';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
$kondisi3 = 'bw.3';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
$kondisi4 = 'bw.2';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
$kondisi5 = 'bw.1';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )

$group_pagi = 'bw.t.1';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )

$row_all_user = $sql_all_user->fetchAll(PDO::FETCH_ASSOC);

//koneksi ke RAS
$ip_address = "192.168.1.90";
$username   = "dwi";
$password   = "dwi";

foreach ($row_all_user as $rows)
{

//cut koneksi
try {
    $client = new RouterOS\Client($ip_address, $username, $password);
} catch (Exception $e) {
    enableLog("","dwi", "dwi","Unable to connect to RouterOS.");
}

    if (isset($client)) {
                
                $util = new RouterOS\Util($client);
                $util->exec("
                    /interface pppoe-server remove [find user=".$rows["UserID"]."]
                    ");
                enableLog("","dwi", "dwi","/interface pppoe-server remove [find user=".$rows["UserID"]."]");
                
    }else{
        enableLog("","dwi", "dwi","Unable to connect to RouterOS.");
        
    }
 
//total pemakaian
$conn_soft2 = Config::getInstanceSoft();
$sql_total_data = $conn_soft2->prepare("SELECT  ISNULL([AcctOutputOctets], 0) AS totalin,
                                       ISNULL([AcctInputOctets], 0) AS totalout,
                                       ISNULL([AcctSessionTime], 0) AS totaltime
                        FROM [4RBSSQL].[dbo].[Accountinglog]
                        WHERE  [Accountinglog].[UserId] = '".$rows["UserID"]."'
                        AND MONTH(AcctDate) = ".date("m")." AND YEAR(AcctDate) = ".date("Y").";");

/*
 *
 *SELECT  [Accountinglog].[AcctOutputOctets], [Accountinglog].[AcctInputOctets]
  FROM [dbo].[Accountinglog]
  WHERE [Accountinglog].[UserId] = '".$rows["UserID"]."'
  AND [Accountinglog].[AcctDate] BETWEEN '2014-09-01 00:00:00' AND '2014-09-31 23:59:59';
  *
  *
  *
  *
  
 *WHERE [Accountinglog].[UserId] = 'test001'
AND[Accountinglog].[AcctDate] >= '2014-09-01 00:00:00.000' 
AND [Accountinglog].[AcctDate] <= '2014/09/31 23:59:59.999'
 */
$sql_total_data->execute();


$total_kuota = 0;
$totalin = 0;
$totalout = 0;
$totaltime = 0;
$bw = '-';

$row_total_data = $sql_total_data->fetchAll(PDO::FETCH_ASSOC);

foreach($row_total_data as $kuota){
    $totalin = $totalin + ($kuota["totalin"]);
    $totalout = $totalout + ($kuota["totalout"]);
    $totaltime = $totaltime + ($kuota["totaltime"]);
    $total_kuota = $total_kuota + ($kuota["totalin"] + $kuota["totalout"]);
    
}

/*if($rows["UserID"] == "test002")
{
    echo $totalin."<br>";
    echo $totalout."<br>";
    echo $total_kuota."<br>";
    echo $totaltime."<br>";
}*/

    if(((strpos($rows["GroupName"], "bw.5")) !== FALSE) || ((strpos($rows["GroupName"], "bw.t.5")) !== FALSE)){
        $bw = "5Mbps";
    }elseif(((strpos($rows["GroupName"], "bw.4")) !== FALSE) || ((strpos($rows["GroupName"], "bw.t.4")) !== FALSE)){
        $bw = "4Mbps";
    }elseif(((strpos($rows["GroupName"], "bw.3")) !== FALSE) || ((strpos($rows["GroupName"], "bw.t.3")) !== FALSE)){
        $bw = "3Mbps";
    }elseif(((strpos($rows["GroupName"], "bw.2")) !== FALSE) || ((strpos($rows["GroupName"], "bw.t.2")) !== FALSE)){
        $bw = "2Mbps";
    }elseif(((strpos($rows["GroupName"], "bw.1")) !== FALSE) || ((strpos($rows["GroupName"], "bw.t.1")) !== FALSE)){
        $bw = "1Mbps";
    }elseif(((strpos($rows["GroupName"], "bw.night")) !== FALSE)){
        $bw = "20Mbps";
    }
    
    $max_kuota = kuotaKB($rows["UserKBBank"]);
    
    $content .='<tr>
                <td>'.$no.'.</td>
                
                <td><a href="'.URL_ADMIN.'data/detail_user.php?uid='.$rows["UserID"].'">'.$rows["UserID"].'</a></td>
                <td>'.$rows["AccountName"].'</td>
                <td>'.kuotaMB($rows["UserTimeBank"]).'</td>
                <td>'.kuotaMB($rows["UserKBBank"]).'</td>
                <td>'.kuotaMB($totalin).'</td>
                <td>'.kuotaMB($totalout).'</td>
                <td>'.kuotaMB($total_kuota).'</td>
                <td>'.detiktoTime($totaltime).'</td>
                
                <td>'.$rows["GroupName"].' ('.$bw.')</td>
                <td><a href="'.URL_ADMIN.'data/form_user.php?uid='.$rows["UserID"].'">edit</a></td>
            </tr>';
            
$current_time = DateTime::createFromFormat('H:i', date("H:i"));
$start = DateTime::createFromFormat('H:i', "08:00");
$end = DateTime::createFromFormat('H:i', "20:00");

//bandwidth pagi
if ($current_time >= $start && $current_time <= $end)
{
    //echo "pagi";
    //all user check
    if(($total_kuota > 1) AND ($total_kuota <= (2*1000*1024*1024)) )
    {
        
        if((strpos($rows["GroupName"], "bw.5")) === FALSE)
        {
            //history_bw
            $query_history_bw = "INSERT INTO `gx_inet_bwhistory` (`id_bwhistory`, `user_id`, `account_name`,
                              `group_name`, `date_upd`, `user_upd`, `session_in`, `session_out`, `total_session`, `session_time`)
                              VALUES (NULL, '".$rows["UserID"]."', '".$rows["AccountName"]."', '".$rows["GroupName"]."',
                              NOW(), 'dwi', '".$totalin."', '".$totalout."', '".$total_kuota."', '".$totaltime."');";
            $sql_history_bw = mysql_query($query_history_bw, $conn);
            enableLog("","dwi", "dwi","$query_history_bw");
            
            $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi1."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi", "$query_bw");
        }
    }
    elseif(($total_kuota > (2*1000*1024*1024)) AND ($total_kuota <= (3*1000*1024*1024)) )
    {
        if((strpos($rows["GroupName"], "bw.4")) === FALSE)
        {
            //history_bw
            $query_history_bw = "INSERT INTO `gx_inet_bwhistory` (`id_bwhistory`, `user_id`, `account_name`,
                              `group_name`, `date_upd`, `user_upd`, `session_in`, `session_out`, `total_session`, `session_time`)
                              VALUES (NULL, '".$rows["UserID"]."', '".$rows["AccountName"]."', '".$rows["GroupName"]."',
                              NOW(), 'dwi', '".$totalin."', '".$totalout."', '".$total_kuota."', '".$totaltime."');";
            $sql_history_bw = mysql_query($query_history_bw, $conn);
            enableLog("","dwi", "dwi","$query_history_bw");
            
            $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi2."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
        }
    }
    elseif(($total_kuota > (3*1000*1024*1024)) AND ($total_kuota <= (4*1000*1024*1024)) )
    {
        if((strpos($rows["GroupName"], "bw.3")) === FALSE)
        {
            //history_bw
            $query_history_bw = "INSERT INTO `gx_inet_bwhistory` (`id_bwhistory`, `user_id`, `account_name`,
                              `group_name`, `date_upd`, `user_upd`, `session_in`, `session_out`, `total_session`, `session_time`)
                              VALUES (NULL, '".$rows["UserID"]."', '".$rows["AccountName"]."', '".$rows["GroupName"]."',
                              NOW(), 'dwi', '".$totalin."', '".$totalout."', '".$total_kuota."', '".$totaltime."');";
            $sql_history_bw = mysql_query($query_history_bw, $conn);
            enableLog("","dwi", "dwi","$query_history_bw");
            
            $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi3."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
        }
    }
    elseif(($total_kuota > (4*1000*1024*1024)) AND ($total_kuota <= (5*1000*1024*1024)) )
    {
        if((strpos($rows["GroupName"], "bw.2")) === FALSE)
        {
            //history_bw
            $query_history_bw = "INSERT INTO `gx_inet_bwhistory` (`id_bwhistory`, `user_id`, `account_name`,
                              `group_name`, `date_upd`, `user_upd`, `session_in`, `session_out`, `total_session`, `session_time`)
                              VALUES (NULL, '".$rows["UserID"]."', '".$rows["AccountName"]."', '".$rows["GroupName"]."',
                              NOW(), 'dwi', '".$totalin."', '".$totalout."', '".$total_kuota."', '".$totaltime."');";
            $sql_history_bw = mysql_query($query_history_bw, $conn);
            enableLog("","dwi", "dwi","$query_history_bw");
            
            $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi4."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
        }
    }
    elseif(($total_kuota > (5*1000*1024*1024)) AND ($total_kuota <= (6*1000*1024*1024)) )
    {
        if((strpos($rows["GroupName"], "bw.1")) === FALSE)
        {
            //history_bw
            $query_history_bw = "INSERT INTO `gx_inet_bwhistory` (`id_bwhistory`, `user_id`, `account_name`,
                              `group_name`, `date_upd`, `user_upd`, `session_in`, `session_out`, `total_session`, `session_time`)
                              VALUES (NULL, '".$rows["UserID"]."', '".$rows["AccountName"]."', '".$rows["GroupName"]."',
                              NOW(), 'dwi', '".$totalin."', '".$totalout."', '".$total_kuota."', '".$totaltime."');";
            $sql_history_bw = mysql_query($query_history_bw, $conn);
            enableLog("","dwi", "dwi","$query_history_bw");
            
            $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi5."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
        }
    }
    elseif(($total_kuota > (6*1000*1024*1024)) )
    {
        if((strpos($rows["GroupName"], "bw.1")) === FALSE)
        {
            //history_bw
            $query_history_bw = "INSERT INTO `gx_inet_bwhistory` (`id_bwhistory`, `user_id`, `account_name`,
                              `group_name`, `date_upd`, `user_upd`, `session_in`, `session_out`, `total_session`, `session_time`)
                              VALUES (NULL, '".$rows["UserID"]."', '".$rows["AccountName"]."', '".$rows["GroupName"]."',
                              NOW(), 'dwi', '".$totalin."', '".$totalout."', '".$total_kuota."', '".$totaltime."');";
            $sql_history_bw = mysql_query($query_history_bw, $conn);
            enableLog("","dwi", "dwi","$query_history_bw");
            
            $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi5."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
        }
    //bukan masuk group bw kuota dan diganti ke group bw pagi
    }
    else
    {
        //history_bw
        $query_history_bw = "INSERT INTO `gx_inet_bwhistory` (`id_bwhistory`, `user_id`, `account_name`,
                              `group_name`, `date_upd`, `user_upd`, `session_in`, `session_out`, `total_session`, `session_time`)
                              VALUES (NULL, '".$rows["UserID"]."', '".$rows["AccountName"]."', '".$rows["GroupName"]."',
                              NOW(), 'dwi', '".$totalin."', '".$totalout."', '".$total_kuota."', '".$totaltime."');";
        $sql_history_bw = mysql_query($query_history_bw, $conn);
        enableLog("","dwi", "dwi","$query_history_bw");
        
        $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$group_pagi."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
        $update_bw = $conn_soft->prepare($query_bw);
        $update_bw->execute();
        //echo $query_bw;
        enableLog("","dwi", "dwi",$query_bw);
        
    }
    
//bandwith malam    
}elseif ($current_time >= $end || $current_time <= $start)
{
    //echo "malam";
    //history_bw
    $query_history_bw = "INSERT INTO `gx_inet_bwhistory` (`id_bwhistory`, `user_id`, `account_name`,
                              `group_name`, `date_upd`, `user_upd`, `session_in`, `session_out`, `total_session`, `session_time`)
                              VALUES (NULL, '".$rows["UserID"]."', '".$rows["AccountName"]."', '".$rows["GroupName"]."',
                              NOW(), 'dwi', '".$totalin."', '".$totalout."', '".$total_kuota."', '".$totaltime."');";
    $sql_history_bw = mysql_query($query_history_bw, $conn);
    enableLog("","dwi", "dwi","$query_history_bw");
        
    $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = 'bw.night' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
    $update_bw = $conn_soft->prepare($query_bw);
    $update_bw->execute();
    //echo $query_bw;
    enableLog("","dwi", "dwi",$query_bw);
}
    //UPDATE [dbo].[Users] SET [NASAttributes] = '".$kondisi."  ' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'
    
    //log insert to MSSQL server 95
    //enableLog("","dwi", "dwi","cek bw");
    
    $no++;

}


    }
	
	echo "<script language='JavaScript'>
					alert('Check Total User: ".$total_data."');
					window.location.href='data_usage_cek.php';
					</script>";
}
$content .='</tbody></table>
                                    </div>
                                </div><!-- /.box-body-->
                            </div><!-- /.box -->

                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->

            ';

$plugin = '<script type="text/javascript">
    $(function () {
        $.ajaxSetup({ cache: false }); 
        setInterval(function() {
            $(\'#cek_bw\').load(\''.URL.'config/admin/ajax/cek_bw_group.php\');
        }, 300000); 
    });
    
</script>';

    $title	= 'Cek Bandwidth';
    $submenu	= "inet_datausage";
    $plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>