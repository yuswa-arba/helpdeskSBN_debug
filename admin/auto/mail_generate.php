<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
//include ("/var/www/sbn/beta/config/configuration_admin.php");
//include ("/var/www/software/beta/config/configuration_voip_bpn.php");

//global $conn;
//global $conn_voip;
//$conn_soft = Config::getInstanceSoft();

function invoice_mail($nama_customer, $periode_tagihan)
{
	$mail = '
<div>
<b>Dear Customer ('.$nama_customer.'),</b><br><br><br>


Dengan Ini Kami Mengirimkan Invoice Koneksi Internet Bulan '.$periode_tagihan.'.<br><br>

berikut kami lampirkan invoice terkait ,pembayaran dapat dilakukan dengan 2 cara :<br>

1. Pembayaran Secara Tunai dengan Datang ke kantor STREAM .Jl. Raya Kerobokan Br. Semer No.390X ,Menemui Tutnik<br>

2. Pembayaran Secara Online .Melalui No Virtual Account yang sudah tertera pada lampiran Invoice.<br>

Demikianlah Pemberitahuan yang dapat kami sampaikan ,jika terdapat kendala dapat menghubungi Tutnik ke no 0361-3003450<br><br>


Senang dapat melayani anda.<br><br>


Demikian,atas Perhatian dan Kerjasamanya saya ucapkan Terima Kasih<br><br>

Best Regards,<br>
 Tutnik <br>
Admin Division<br>
<div>';

return $mail;
}