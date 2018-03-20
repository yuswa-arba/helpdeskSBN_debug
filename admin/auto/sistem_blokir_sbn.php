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

global $conn;
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
                              AND `tbCustomer`.`gx_status` != 'blokir'
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
    //echo date("d-m-Y", strtotime($row_rbs["GracePeriodExpiration"]));
   // echo $row_customer["cKode"] . date("d-m-Y");
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

            /* Disable karena userip di RBS dikosongi
             *Dwi tgl 8/4/2017
             *
             * 
            
            //update ip blokir RBS
            $sql_update_rbs = "
            UPDATE [dbo].[Users] SET [UserIP]='".$ip_address."'
            WHERE ([UserIndex]='".$row_customer["iuserIndex"]."');
            ";
           // echo $sql_update_rbs."<br>";
            $query_update_rbs = $conn_soft->prepare($sql_update_rbs);
            
            $query_update_rbs->execute();
            enableLog("","blokir", "blokir",$sql_update_rbs);
            
            //disable pppoe
            //get data default IP VM Master
$ip_vm = mysql_query("SELECT * FROM `gx_inet_ipvm` LIMIT 0,1;", $conn);
$data_ip_vm = mysql_fetch_array($ip_vm);

$ip_vlan_baru = mysql_query("SELECT * FROM `gx_master_ipvm` WHERE `userid_ip` = '".$row_customer["cUserID"]."' AND `flag_ip` = 'aktif' AND `level` = '0' LIMIT 0,1;", $conn);
$data_ip_vlan_baru = mysql_fetch_array($ip_vlan_baru);

$ip_vlan = long2ip($data_ip_vlan_baru["ip_address"]);

$api_vm = new RouterosAPI();
$api_vm->debug = false;


//step2
if ($api_vm->connect(trim($ip_vlan), $data_ip_vm['username_ipvm'], $data_ip_vm['password_ipvm']))
{
    //1. get id pppoe-client
    $api_vm->write('/interface/pppoe-client/print');
    $READ = $api_vm->read(false);
    $ARRAY = $api_vm->parseResponse($READ);
    $id_pppoe_client = $ARRAY[0][".id"];
	
	
    //3. disable pppoe-client
    $api_vm->write('/interface/pppoe-client/disable', false);
    $api_vm->write('=.id='.$id_pppoe_client);
    $READ = $api_vm->read(false);
    $output_pppoe2 = $api_vm->parseResponse($READ);
	
}
else
{
    $output_hostname = "Tidak Bisa Login ke Mesin VM";
    
}

*/
            
        }
        
    }
    
    
    
}