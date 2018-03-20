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
require_once("/var/www/sbn/beta/admin/auto/pdf_invoice.php");

global $conn;

$tgl_tagihan    = date("Y-m-23");
$id_cabang    = '2';

//GENERATE INVOICE

$sql_invoice = mysql_query("SELECT * FROM `gx_invoice`
				WHERE `level` = '0'
				AND `id_cabang` = '2'
				AND `tanggal_tagihan` = '".date("Y-m-d", strtotime($tgl_tagihan))."';", $conn);

while($row_invoice = mysql_fetch_array($sql_invoice))
{
	$pdf = generate_pdf($row_invoice["kode_invoice"]);
}

/* crontab script
 * 
 * 10 3 1 * * php -f /var/www/sbn/beta/admin/auto/generate_pdf_invoice.php >> /var/log/crontab_pdf_invoice_sbn.log 2>&1
 *
 */
