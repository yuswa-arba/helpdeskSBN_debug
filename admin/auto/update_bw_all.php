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
$kondisi2 = 'h.08';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
$kondisi3 = 'h.05';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
$kondisi4 = 'h.02';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
$kondisi5 = 'h.01';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )

$row_all_user = $sql_all_user->fetchAll(PDO::FETCH_ASSOC);


foreach ($row_all_user as $rows)
{            
	$query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi1."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
	$update_bw = $conn_soft->prepare($query_bw);
	$update_bw->execute();
	echo $query_bw."<br>";
	enableLog("","dwi", "dwi", "$query_bw");
	
}


?>