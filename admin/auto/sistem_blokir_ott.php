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
include ("/var/www/sbn/beta/config/configuration_tv.php");

global $conn;
$conn_ott   = DB_TV();
$conn_soft = Config::getInstanceSoft();

$tgl_tagihan    = date("Y-m-d");
$dept	    	= "Riset";
$id_cabang    	= "1"; //balikpapan

$sql_insert = "INSERT INTO `gx_log_blokir` (`id_log_blokir`, `tgl_log_blokir`, `id_cabang`, `dept`, `user_add`, `date_add`)
VALUES (NULL, NOW(), '".$id_cabang."', '".$dept."', 'auto blokir', NOW());";

//echo $sql_insert;
mysql_query($sql_insert, $conn) or die (mysql_error());
//log
enableLog("","auto", "auto", "Auto Blokir", $sql_insert);

//AND `tbCustomer`.`id_cabang` = '".$id_cabang."'
$sql_customer	= mysql_query("SELECT `cKode`, `cUserID`, `iuserIndex`, `user_ip`, `ip_inet`, `ip_blokir`
                              FROM `tbCustomer`, `gx_paket2`
                              WHERE `tbCustomer`.`cKdPaket` = `gx_paket2`.`kode_paket`
                              AND `tbCustomer`.`level` = '0'
                              AND `gx_paket2`.`level` =  '0';", $conn);

                              
//if("31-03-2016" <= "06-04-2016")
//{
//    echo "OK";
//                              
//}
while($row_customer = mysql_fetch_array($sql_customer))
{
    
    $user_id = $row_customer["cUserID"];
    $ip_blokir = $row_customer["ip_blokir"];
    
    $ip_address = ip2long($ip_blokir);
    if (PHP_INT_SIZE == 8)
    {
        if ($ip_address>0x7FFFFFFF)
        {
            $ip_address-=0x100000000;
        }
    }
    // echo $ip_address;
        
    //select data grace customer
    $conn_soft = Config::getInstanceSoft();

    $sql_rbs	= "SELECT TOP 1 [GracePeriodExpiration], [UserPaymentBalance] FROM [Users] WHERE [UserIndex] = '".$row_customer["iuserIndex"]."';";
    $query_rbs  = $conn_soft->prepare($sql_rbs);
    $query_rbs->execute();
    $row_rbs	= $query_rbs->fetch();
    
    //cek tgl grace customer
    //echo date("d-m-Y", strtotime($row_rbs["GracePeriodExpiration"]))."<br>";
    //echo $row_customer["cKode"] . date("d-m-Y")."<br>";
    if((strtotime($row_rbs["GracePeriodExpiration"])) <= strtotime(date("d-m-Y")))
    {
        //cek piutang customer
        // echo (($row_rbs["UserPaymentBalance"] < 0) ? "minus" : "plus");
        if($row_rbs["UserPaymentBalance"] < 0)
        {
            //update ip blokir dan status helpdesk
            $sql_update_soft = "UPDATE `tbCustomer` SET `gx_status`='blokir',
            `date_upd`=NOW(), `level`='0' WHERE (`cKode`='".$row_customer["cKode"]."');";
            // echo $sql_update_soft."<br>";
            mysql_query($sql_update_soft, $conn) or die (mysql_error());
            //log
            enableLog("","blokir", "blokir", "Update IP Blokir userid $user_id.", $sql_update_soft);
            
            
            $sql_user_tv    = "SELECT * FROM `boss`.`t_account_cms` WHERE (`CLIENTNAME`='".$user_id."') LIMIT 0,1;";
            $query_user_tv  = mysqli_query($conn_ott ,$sql_user_tv) or die (mysqli_error());
            $row_user_tv    = mysqli_fetch_array($query_user_tv);
            
            //log history helpdesk
            $sn = substr($row_user_tv["CLIENTCODE"], 0, -12);
            $sql_insert_blokir = "INSERT INTO `gx_blokir_ott` (`id_blokir_ott`, `userid_ott`, `sn_ott`, `mac_ott`, `date_ott`)
            VALUES (NULL, '".$user_id."', '".$sn."', '".$row_user_tv["MACADDRESS"]."', NOW());";
            //echo $sql_insert_blokir."<br>";
            mysql_query($sql_insert_blokir, $conn) or die (mysql_error());
            //log
            enableLog("","blokir", "blokir", "Insert log Blokir userid $user_id.", $sql_insert_blokir);
            
            ////update ip blokir RBS
            //$sql_update_rbs = "
            //UPDATE [dbo].[Users] SET [UserIP]='".$ip_address."'
            //WHERE ([UserIndex]='".$row_customer["iuserIndex"]."');
            //";
            //$query_update_rbs = $conn_soft->prepare($sql_update_rbs);
            //$query_update_rbs->execute();
            
            //update sn tv ott
            $sql_update_tv = "UPDATE `boss`.`t_account_cms` SET `CLIENTCODE`='BLOKIR' WHERE (`CLIENTNAME`='".$user_id."');";
            mysqli_query($conn_ott ,$sql_update_tv) or die (mysqli_error());
            
            enableLog("","blokir", "blokir",$sql_update_rbs);
            
        }
        
    }
    
 // 10 5 * * * php -f /var/www/sbn/beta/admin/auto/sistem_blokir_ott.php >> /var/log/crontab_blokir_ott_sbn.log 2>&1   
    
}