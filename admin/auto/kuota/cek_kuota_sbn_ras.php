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

//$kondisi1 = 'h.10';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
//$kondisi2 = 'h.08';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
//$kondisi3 = 'h.05';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
//$kondisi4 = 'h.02';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
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
    
//    if(((strpos($rows["GroupName"], "h.10")) !== FALSE)){
//        $bw = "10Mbps";
//    }
//	if(((strpos($rows["GroupName"], "h.08")) !== FALSE)){
//        $bw = "8Mbps";
//    }
//	if(((strpos($rows["GroupName"], "h.05")) !== FALSE)){
//        $bw = "5Mbps";
//    }
//	if(((strpos($rows["GroupName"], "h.02")) !== FALSE) ){
//        $bw = "2Mbps";
//    }

        
        $max_kuota = kuotaKB($rows["UserKBBank"]);
        $total_kuota_rbs_ras = $total_kuota + $kuota_ras;
        
                    
        $current_time = DateTime::createFromFormat('H:i', date("H:i"));
        $start = DateTime::createFromFormat('H:i', "08:00");
        $end = DateTime::createFromFormat('H:i', "20:00");
    
		$query_setting_kuota	= "SELECT * FROM `sbn_setting_kuota`;";
        $sql_setting_kuota		= mysql_query($query_setting_kuota, $conn);
		
		while($row_setting_kuota = mysql_fetch_array($sql_setting_kuota))
		{
			//Start Kuota
			$start_kuota = (($row_setting_kuota["start_kuota_cron"] == 0) ? 1 : ($row_setting_kuota["start_kuota_cron"] * 1000 * 1024 * 1024));
			
			//end kuota
			$end_kuota = (($row_setting_kuota["end_kuota_cron"] == 0) ?  0 : ($row_setting_kuota["end_kuota_cron"] * 1000 * 1024 * 1024) );
			
			$bw_kuota = $row_setting_kuota["bw_cron"];
			
			if($end_kuota == 0)
			{
				if(($total_kuota_rbs_ras > $start_kuota))
				{
					
					if((strpos($rows["GroupName"], $bw_kuota)) === FALSE)
					{
						//history_bw
						$query_history_bw = "INSERT INTO `gx_inet_bwhistory` (`id_bwhistory`, `user_id`, `account_name`,
										  `group_name`, `date_upd`, `user_upd`, `session_in`, `session_out`, `total_session`, `session_time`)
										  VALUES (NULL, '".$rows["UserID"]."', '".$rows["AccountName"]."', '".$rows["GroupName"]."',
										  NOW(), 'dwi', '".$totalin."', '".$totalout."', '".$total_kuota_rbs_ras."', '".$totaltime."');";
						
						//$sql_history_bw = mysql_query($query_history_bw, $conn);
						//enableLog("","dwi", "dwi","$query_history_bw");
						
						$query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$bw_kuota."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
						//$update_bw = $conn_soft->prepare($query_bw);
						//$update_bw->execute();
						echo $query_bw."<br>";
						//enableLog("","dwi", "dwi", "$query_bw");
						
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
				
				
			}
			elseif($end_kuota > 1)
			{
				if(($total_kuota_rbs_ras > $start_kuota) AND ($total_kuota_rbs_ras <= $end_kuota) )
				{
					
					if((strpos($rows["GroupName"], $bw_kuota)) === FALSE)
					{
						//history_bw
						$query_history_bw = "INSERT INTO `gx_inet_bwhistory` (`id_bwhistory`, `user_id`, `account_name`,
										  `group_name`, `date_upd`, `user_upd`, `session_in`, `session_out`, `total_session`, `session_time`)
										  VALUES (NULL, '".$rows["UserID"]."', '".$rows["AccountName"]."', '".$rows["GroupName"]."',
										  NOW(), 'dwi', '".$totalin."', '".$totalout."', '".$total_kuota_rbs_ras."', '".$totaltime."');";
						$sql_history_bw = mysql_query($query_history_bw, $conn);
						enableLog("","dwi", "dwi","$query_history_bw");
						
						$query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$bw_kuota."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
						$update_bw = $conn_soft->prepare($query_bw);
						$update_bw->execute();
						// echo $query_bw."<br>";
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
				
				
			
			}
		}
    


    
}


?>