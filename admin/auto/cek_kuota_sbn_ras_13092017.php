<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("/var/www/sbn/beta/config/configuration_admin.php");
include '/var/www/sbn/beta/admin/data/kuota/routeros_api.class.php';


global $conn;

//log
enableLog("auto","auto", "0","auto monitoring kuota sbn + ras");


    
$no = 1;
$conn_soft = Config::getInstanceSoft();


$sql_all_user = $conn_soft ->prepare("SELECT [Users].*, [AccountTypes].[AccountName]
                                     FROM [dbo].[Users], [dbo].[AccountTypes]
                                     WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex]
                                    
                                     AND [Users].[userActive] = '1';");
$sql_all_user->execute();

$kondisi1 = 'h.10';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
$kondisi2 = 'h.05';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
$kondisi3 = 'h.02';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
$kondisi4 = 'h.01';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
//$kondisi5 = 'bw.1';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )

$row_all_user = $sql_all_user->fetchAll(PDO::FETCH_ASSOC);

//koneksi ke RAS
$ip_address = "172.16.255.2";
$username   = "nyuwuntulung911";
$password   = "h3lpd3skSBN";

$api_vm = new RouterosAPI();
$api_vm->debug = false;

//step2
if ($api_vm->connect($ip_address, $username, $password))
{

	$api_vm->write('/ppp/active/print');
	//$api_vm->write('=active=');
    $READ2 = $api_vm->read(false);
    $ARRAY2 = $api_vm->parseResponse($READ2);
	
	foreach($ARRAY2 as $value)
	{
		$id = substr($value[".id"], -5);
		$data_nama[$id] = $value["name"];
        $data_remove[$value[".id"]] = $value["name"];
	}

	$api_vm->write('/interface/print',false);
	$api_vm->write('=stats=');
    $READ = $api_vm->read(false);
    $ARRAY = $api_vm->parseResponse($READ);
    

	foreach($ARRAY as $value)
	{
		$id = substr($value[".id"], -5);
		$data_kuota[$id] = ($value["rx-byte"] + $value["tx-byte"]);
	}
}
else
{
	echo 'tidak konek sam';
}

foreach ($row_all_user as $rows)
{
    
    $id_kuota = array_search($rows["UserID"], $data_nama);
    //$id_remove_ppp = array_search($rows["UserID"], $data_remove);
	
    if(!empty ($id_kuota))
    {
        $kuota_ras = $data_kuota[$id_kuota];    
    }
    else
    {
        $kuota_ras = '0';
    }
    


    //total pemakaian
    $conn_soft2 = Config::getInstanceSoft();
    $sql_total_data = $conn_soft2->prepare("SELECT  ISNULL([AcctOutputOctets], 0) AS totalin,
                                           ISNULL([AcctInputOctets], 0) AS totalout,
                                           ISNULL([AcctSessionTime], 0) AS totaltime
                            FROM [dbo].[Accountinglog]
                            WHERE  [Accountinglog].[UserId] = '".$rows["UserID"]."'
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
    
    if(((strpos($rows["GroupName"], "h.10")) !== FALSE)){
        $bw = "10Mbps";
    }elseif(((strpos($rows["GroupName"], "h.05")) !== FALSE)){
        $bw = "5Mbps";
    }elseif(((strpos($rows["GroupName"], "h.02")) !== FALSE)){
        $bw = "2Mbps";
    }elseif(((strpos($rows["GroupName"], "h.01")) !== FALSE) ){
        $bw = "1Mbps";
    }

        
        $max_kuota = kuotaKB($rows["UserKBBank"]);
        $total_kuota_rbs_ras = $total_kuota + $kuota_ras;
        
                    
        $current_time = DateTime::createFromFormat('H:i', date("H:i"));
        $start = DateTime::createFromFormat('H:i', "08:00");
        $end = DateTime::createFromFormat('H:i', "20:00");
    
    
    // kuota 1-10GB : 10Mbps
    if(($total_kuota_rbs_ras > 1) AND ($total_kuota_rbs_ras <= (10*1000*1024*1024)) )
    {
        
        if((strpos($rows["GroupName"], "h.10")) === FALSE)
        {
            //history_bw
            $query_history_bw = "INSERT INTO `gx_inet_bwhistory` (`id_bwhistory`, `user_id`, `account_name`,
                              `group_name`, `date_upd`, `user_upd`, `session_in`, `session_out`, `total_session`, `session_time`)
                              VALUES (NULL, '".$rows["UserID"]."', '".$rows["AccountName"]."', '".$rows["GroupName"]."',
                              NOW(), 'dwi', '".$totalin."', '".$totalout."', '".$total_kuota_rbs_ras."', '".$totaltime."');";
            $sql_history_bw = mysql_query($query_history_bw, $conn);
            enableLog("","dwi", "dwi","$query_history_bw");
            
            $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi1."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi", "$query_bw");
            
            if ($api_vm->connect($ip_address, $username, $password))
            {
                $api_vm->write('/ppp/active/print', false);
                $api_vm->write('?name='.$rows["UserID"], false);
                $api_vm->write('=.proplist=.id');
                $ARRAYS = $api_vm->read();
                
                $id_remove_ppp = ($ARRAYS[0][".id"]);
                
                $api_vm->write('/ppp/active/remove', false);
                $api_vm->write('=.id='.$id_remove_ppp);
                $READ = $api_vm->read(false);
                $output_remove = $api_vm->parseResponse($READ);
            }
            
        }
    }
	// kuota 10-15GB : 5Mbps
    elseif(($total_kuota_rbs_ras > (10*1000*1024*1024)) AND ($total_kuota_rbs_ras <= (15*1000*1024*1024)) )
    {
        if((strpos($rows["GroupName"], "h.05")) === FALSE)
        {
            //history_bw
            $query_history_bw = "INSERT INTO `gx_inet_bwhistory` (`id_bwhistory`, `user_id`, `account_name`,
                              `group_name`, `date_upd`, `user_upd`, `session_in`, `session_out`, `total_session`, `session_time`)
                              VALUES (NULL, '".$rows["UserID"]."', '".$rows["AccountName"]."', '".$rows["GroupName"]."',
                              NOW(), 'dwi', '".$totalin."', '".$totalout."', '".$total_kuota_rbs_ras."', '".$totaltime."');";
            $sql_history_bw = mysql_query($query_history_bw, $conn);
            enableLog("","dwi", "dwi","$query_history_bw");
            
            $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi2."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
            
            if ($api_vm->connect($ip_address, $username, $password))
            {
                $api_vm->write('/ppp/active/print', false);
                $api_vm->write('?name='.$rows["UserID"], false);
                $api_vm->write('=.proplist=.id');
                $ARRAYS = $api_vm->read();
                
                $id_remove_ppp = ($ARRAYS[0][".id"]);
                
                $api_vm->write('/ppp/active/remove', false);
                $api_vm->write('=.id='.$id_remove_ppp);
                $READ = $api_vm->read(false);
                $output_remove = $api_vm->parseResponse($READ);
            }
        }
    }
	// kuota 15-19GB : 2Mbps
    elseif(($total_kuota_rbs_ras > (15*1000*1024*1024)) AND ($total_kuota_rbs_ras <= (19*1000*1024*1024)) )
    {
        if((strpos($rows["GroupName"], "h.02")) === FALSE)
        {
            //history_bw
            $query_history_bw = "INSERT INTO `gx_inet_bwhistory` (`id_bwhistory`, `user_id`, `account_name`,
                              `group_name`, `date_upd`, `user_upd`, `session_in`, `session_out`, `total_session`, `session_time`)
                              VALUES (NULL, '".$rows["UserID"]."', '".$rows["AccountName"]."', '".$rows["GroupName"]."',
                              NOW(), 'dwi', '".$totalin."', '".$totalout."', '".$total_kuota_rbs_ras."', '".$totaltime."');";
            $sql_history_bw = mysql_query($query_history_bw, $conn);
            enableLog("","dwi", "dwi","$query_history_bw");
            
            $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi3."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
            
            if ($api_vm->connect($ip_address, $username, $password))
            {
                $api_vm->write('/ppp/active/print', false);
                $api_vm->write('?name='.$rows["UserID"], false);
                $api_vm->write('=.proplist=.id');
                $ARRAYS = $api_vm->read();
                
                $id_remove_ppp = ($ARRAYS[0][".id"]);
                
                $api_vm->write('/ppp/active/remove', false);
                $api_vm->write('=.id='.$id_remove_ppp);
                $READ = $api_vm->read(false);
                $output_remove = $api_vm->parseResponse($READ);
            }
        }
    }
	// kuota >19GB : 1Mbps
    elseif(($total_kuota_rbs_ras > (19*1000*1024*1024)) )
    {
        if((strpos($rows["GroupName"], "h.01")) === FALSE)
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
            
            if ($api_vm->connect($ip_address, $username, $password))
            {
                $api_vm->write('/ppp/active/print', false);
                $api_vm->write('?name='.$rows["UserID"], false);
                $api_vm->write('=.proplist=.id');
                $ARRAYS = $api_vm->read();
                
                $id_remove_ppp = ($ARRAYS[0][".id"]);
                
                $api_vm->write('/ppp/active/remove', false);
                $api_vm->write('=.id='.$id_remove_ppp);
                $READ = $api_vm->read(false);
                $output_remove = $api_vm->parseResponse($READ);
            }
            
        }
    //bukan masuk group bw kuota dan diganti ke group bw pagi
    }



    
}


?>