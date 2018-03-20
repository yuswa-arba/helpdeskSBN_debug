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
require_once("/var/www/sbn/beta/admin/auto/pdf_invoice.php");

global $conn;

	$sql_customer	= mysql_query("SELECT * FROM `v_customer_aktivasi`
								WHERE `level` = '0'", $conn);
	
	while($row_customer = mysql_fetch_array($sql_customer))
	{
		
		$total_invoice	= $row_customer["monthly_fee"] + $row_customer["abonemen_voip"] + $row_customer["abonemen_video"];
		$ppn			= (10/100) * $total_invoice;
		$monthly_fee	= $total_invoice + $ppn;
		
		
		
		if($row_customer["cKode"] != "" AND
			$row_customer["kode_inactive"] == NULL AND $row_customer["kode_off"] == NULL AND
			$row_customer["kode_aktivasi"] != NULL)
		{
			echo $row_customer["cKode"]." : ".$row_customer["cUserID"]."<br>";
			
		}
	}

$query_invoice	= "SELECT * FROM `gx_invoice`
			WHERE `level` = '0'
			AND `tanggal_jatuh_tempo` LIKE '%2017-08-03%'
			";
			
$sql_invoice	= mysql_query($query_invoice, $conn);

while($row_invoice = mysql_fetch_array($sql_invoice))
{
	$pdf = generate_pdf($row_invoice["kode_invoice"]);
}

?>