<?php
include ("../../../config/configuration_admin.php");

$sql_data		= mysql_query("SELECT * FROM `tbCustomer` WHERE `level` =  '0';", $conn);

while ($row_data= mysql_fetch_array($sql_data))
{
	echo "INSERT INTO `gx_master_onu` (`id_onu`, `userid_onu`, `sn_onu`, `mac_onu`, `status_onu`, `dateadd_onu`, `dateupd_onu`, `useradd_onu`, `userupd_onu`, `level_onu`)
	VALUES (NULL, '".$row_data["cUserID"]."', '', '".$row_data["cMacAdd"]."', '1', NOW(), NOW(), NULL, NULL, '0');<br>";
}
?>