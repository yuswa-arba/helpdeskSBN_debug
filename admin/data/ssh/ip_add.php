<?php
include ("../../../config/configuration_admin.php");
echo '<pre>';
$ip_pool = getEachIpInRange ( '10.252.252.1/24');
$sql_insert_cust = "INSERT INTO `software`.`gx_master_ipvm` (`id_ip`, `ip_address`, `mac_address`, `keterangan_ip`, `userid_ip`, `type_ip`, `flag_ip`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`) VALUES ";
foreach($ip_pool as $value)
{
    
    //insert into gx_inet_grouptime
    $sql_insert_cust .= "(NULL, '".ip2long($value)."', '',  '', '', 'private', '', 'dwi', 'dwi', NOW(), NOW(), '0'),<br>";
    
    //echo ip2long($value).'<br>';
    

}
echo $sql_insert_cust.'<br>';
echo '</pre>';

//echo '<pre>';
//$ip_pool = getEachIpInRange ( '10.252.252.1/24');
//$sql_insert_vlan = "INSERT INTO `db_sbn`.`gx_data_vlan` (`id_vlan`, `userid_vlan`, `vlan`, `mac_address`, `ip_vlan`, `id_esx`, `username`, `password`, `flag_vlan`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)  VALUES ";
//for($i=3001; $i<=3100; $i++)
//{
//    
//    //insert into gx_inet_grouptime
//    $sql_insert_vlan .= "('', NULL, '".$i."', '', NULL, '13', NULL, NULL, 'aktif', 'dwi', '', NOW(), '', '0'),<br>";
//    
//    //echo ip2long($value).'<br>';
//    
//
//}
//echo $sql_insert_vlan.'<br>';
//echo '</pre>';