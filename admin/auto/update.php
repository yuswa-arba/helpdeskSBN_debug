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
//include ("/var/www/software/beta/config/configuration_voip_bpn.php");

global $conn;
global $conn_voip;
$conn_soft = Config::getInstanceSoft();

$sql_customer	= mysql_query("SELECT `tbCustomer`.*, `gx_cabang`.`invoice_code`, `gx_paket2`.`abonemen_voip`, `gx_paket2`.`abonemen_video`, `gx_paket2`.`monthly_fee`
FROM `tbCustomer`, `gx_paket2`, `gx_cabang`
WHERE `tbCustomer`.`cKdPaket` = `gx_paket2`.`kode_paket`
AND `tbCustomer`.`id_cabang` = `gx_cabang`.`id_cabang`
AND `tbCustomer`.`level` = '0'
AND `gx_paket2`.`level` = '0'
", $conn);

$monthly_fee = '330000';

while($row_customer	= mysql_fetch_array($sql_customer))
{

	$gx_saldo = $row_customer["gx_saldo"] - ($monthly_fee);
	$sql_update_saldo = "UPDATE `tbCustomer` SET `gx_saldo` = '".$gx_saldo."',
	`user_upd` = 'auto_generate', `date_upd` = NOW()
	WHERE (`idCustomer` = '".$row_customer["idCustomer"]."');";
	echo $sql_update_saldo."<br>";
	//mysql_query($sql_update_saldo, $conn) or die ("Update GX Saldo error.");
	//log
	//enableLog("","auto", "auto", "Update GX Saldo (tbCustomer)", $sql_update_saldo);
}

