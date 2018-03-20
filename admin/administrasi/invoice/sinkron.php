<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin())
{
    if($loggedin["group"] == 'admin')
    {
        global $conn;
			
		$query_invoice 	= "SELECT * FROM `gx_invoice`;";
		$sql_invoice	= mysql_query($query_invoice, $conn);
		
		while($row_invoice = mysql_fetch_array($sql_invoice))
		{
			$query_total 	= "SELECT SUM(`harga`) AS `total` FROM `gx_invoice_detail`
			WHERE `kode_invoice` ='".$row_invoice["kode_invoice"]."' GROUP BY `kode_invoice`;";
			$sql_total		= mysql_query($query_total, $conn);
			$row_total 		= mysql_fetch_array($sql_total);
			
			$total			= $row_total["total"];
			$ppn			= 10/100 * $total;
			$grandtotal		= $total + $ppn;
			
			//Update into cc_subscription_service
			$sql_update = "UPDATE `gx_invoice` SET `total`='".$total."',
			`ppn`='".$ppn."', `grandtotal`='".$grandtotal."',
			`date_upd` = NOW(), `user_upd` = 'dwi'
			WHERE `id_invoice`='".$row_invoice["id_invoice"]."';";
			
			echo $sql_update."<br>";
			//mysql_query($sql_update, $conn);
		}

}
	
}
else
{
	header("location: ".URL_ADMIN."logout.php");
}

?>