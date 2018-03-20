<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include("../../../../sbn/beta/config/configuration_admin.php");

global $conn;


$tgl_tagihan = date("Y-m-28");
$bln_tagihan = date("Y-m-28", strtotime("+1 month"));

$dept = "Riset";
$id_cabang = "1"; //SBN cabang

//$tgl_tagihan	= str_replace('/', '-', $tgl_tagihan);

if ($tgl_tagihan != "") {
    $sql_insert = "INSERT INTO `gx_generate_invoice` (`id_generate`, `tgl_tagihan`, `id_cabang`, `dept`, `user_add`, `date_add`)
		VALUES (NULL, '" . date("Y-m-d", strtotime($tgl_tagihan)) . "', '', '" . $dept . "', 'auto generate', NOW());";

    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    //log
    enableLog("", "auto", "auto", "Create Report Generate Invoice", $sql_insert);

    $sql_generate = mysql_query("SELECT `id_generate` FROM `gx_generate_invoice` ORDER BY `id_generate` DESC LIMIT 0,1;", $conn);
    $row_generate = mysql_fetch_array($sql_generate);

    $sql_customer = mysql_query("SELECT `cKode` FROM `tbCustomer`, `gx_paket2`
								  WHERE `tbCustomer`.`cKdPaket` = `gx_paket2`.`kode_paket`
								  AND `gx_paket2`.`level` =  '0';", $conn);
    $cKode = array();
    while ($row_customer = mysql_fetch_array($sql_customer)) {
        // Append to the array
        $cKode[] = $row_customer["cKode"];
    }

    //print_r($cKode);

    $total_key = 0;
    $total_nongenerate = 0;
    foreach ($cKode as $key => $value) {
        //invoice
        //cek invoice
        $sql_invoice_cek = mysql_query("SELECT * FROM `gx_invoice`
										   WHERE `customer_number` = '" . $value . "'
										   AND `title` LIKE '%INVOICE%'
										   AND `tanggal_tagihan` LIKE '%" . date("Y-m-28", strtotime($tgl_tagihan)) . "%'
										   AND `level` = '0' LIMIT 0,1;", $conn);
        $row_invoice_cek = mysql_num_rows($sql_invoice_cek);
        //echo $row_invoice_cek."<br>";
        if ($row_invoice_cek == "0") {
            $sql_customer = mysql_query("SELECT * FROM `v_customer_aktivasi`
											WHERE `cKode` = '" . $value . "'
											AND `level` = '0'
											LIMIT 0,1;", $conn);
            $row_customer = mysql_fetch_array($sql_customer);

            $total_invoice = $row_customer["monthly_fee"] + $row_customer["abonemen_voip"] + $row_customer["abonemen_video"];
            $ppn = (10 / 100) * $total_invoice;
            $monthly_fee = $total_invoice + $ppn;
            $uangmuka = (($row_customer["gx_saldo"] > 1) ? $row_customer["gx_saldo"] : 0);

            //RBS

            if ($row_customer["nterm"] == "0.00") {
                $grace = "2";
            } else {
                $grace = (int)$row_customer["nterm"] - 1;
            }

            if ($row_customer["cKode"] != "" AND
                $row_customer["kode_inactive"] == NULL AND $row_customer["kode_off"] == NULL AND
                $row_customer["kode_aktivasi"] != NULL
            ) {
                //echo "ok";
                $sql_invoice = mysql_fetch_array(mysql_query("SELECT * FROM `gx_invoice` ORDER BY `id_invoice` DESC", $conn));
                $last_data = $sql_invoice["id_invoice"] + 1;
                $tanggal = date("Ymd");
                $kode_invoice = $row_customer["invoice_code"] . '' . $tanggal . '' . sprintf("%04d", $last_data);


                $total_invoice = $row_customer["monthly_fee"] + $row_customer["abonemen_voip"] + $row_customer["abonemen_video"];
                $ppn = (10 / 100) * $total_invoice;
                $monthly_fee = $total_invoice + $ppn;


                $sql_insert_invoice = "INSERT INTO `gx_invoice`(`id_invoice`, `id_cabang`, `kode_aktivasi`, `kode_invoice`, `title`, `customer_number`,`nama_customer`,
											`npwp`, `no_faktur_pajak`, `note`, `periode_tagihan`,`tanggal_tagihan`, `tanggal_jatuh_tempo`,
										`no_virtual_account_bca`, `nama_virtual`, `reference`,  `status`,
										`uangmuka`, `total`, `ppn`, `grandtotal`,
										`paid_status`, `posting`,
										`prepared_by`, `date_add`, `date_upd`,
										`user_add`, `user_upd`, `level`)
									VALUES (NULL, '" . $row_customer["id_cabang"] . "', '', '" . $kode_invoice . "', 'INVOICE " . NamaBulan(date("n", strtotime($bln_tagihan))) . " " . date("Y", strtotime($bln_tagihan)) . "', '" . $row_customer["cKode"] . "', '" . $row_customer["cNama"] . "',
										'" . $row_customer["no_npwp"] . "', '', 'INVOICE " . NamaBulan(date("n", strtotime($bln_tagihan))) . " " . date("Y", strtotime($bln_tagihan)) . "',
										'" . NamaBulan(date("n", strtotime($bln_tagihan))) . " " . date("Y", strtotime($bln_tagihan)) . "', '" . date("Y-m-d", strtotime($tgl_tagihan)) . "',
										'" . date("Y-m-03", strtotime($bln_tagihan)) . "', 
										'" . $row_customer["cNoRekVirtual"] . "', '" . $row_customer["cNama"] . "', '0', '1',
										'" . $uangmuka . "', '" . $total_invoice . "', '" . $ppn . "', '" . $monthly_fee . "',
										'0', '1',
										'auto', NOW(), NOW(),
										'auto', 'yuswa', '0');";

                mysql_query($sql_insert_invoice, $conn) or die ("<script language='JavaScript'>
											   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
											   window.history.go(-1);
											   </script>");

                enableLog("", "auto", "auto", "Create Invoice", $sql_insert_invoice);

                //detiail invoice inet
                $sql_detail_inet = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`, `date`,
											`harga`, `desc`, `date_add`,
											`date_upd`, `user_add`, `user_upd`, `level`)
										VALUES ('', '" . $kode_invoice . "', '" . date("Y-m-d H:i:s", strtotime($tgl_tagihan)) . "',
											'" . $total_invoice . "', 'INTERNET', NOW(),
											NOW(), 'auto', 'auto', '0');";
                //echo $sql_detail_inet;
                mysql_query($sql_detail_inet, $conn) or die ("<script language='JavaScript'>
											   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
											   window.history.go(-1);
											   </script>");
                //log
                enableLog("", "auto", "auto", "Create Invoice (detail internet)", $sql_detail_inet);


                $gx_saldo = $row_customer["gx_saldo"] - ($monthly_fee);
                $sql_update_saldo = "UPDATE `tbCustomer` SET `gx_saldo` = '" . $gx_saldo . "',
					`user_upd` = 'auto_generate', `date_upd` = NOW()
					WHERE (`idCustomer` = '" . $row_customer["idCustomer"] . "');";
                //echo $sql_detail_inet;
                mysql_query($sql_update_saldo, $conn) or die ("Update GX Saldo error.");
                //log
                enableLog("", "auto", "auto", "Update GX Saldo (tbCustomer)", $sql_update_saldo);

                //END GENERATE

                //GENERATE detail invoice
                $sql_insert_detail = "INSERT INTO `gx_generate_detail` (`id_detail`, `id_generate`, `id_customer`, `kode_paket`)
					VALUES (NULL, '" . $row_generate["id_generate"] . "', '" . $value . "', '" . $row_customer["cKdPaket"] . "');";
                $total_key = $total_key + 1;
                //echo $sql_insert_detail;
                mysql_query($sql_insert_detail, $conn) or die (mysql_error());
                enableLog("", "auto", "auto", "Create Report Generate Invoice (detail)", $sql_insert_detail);

            }

        } else {
            $total_nongenerate = $total_nongenerate + 1;
            echo "$total_key invoice telah di generate $total_nongenerate sudah pernah dibuat untuk periode ini.";
        }
    }
    //echo "$total_key invoice telah di generate. $total_nongenerate sudah pernah dibuat untuk periode ini.";
} else {
    echo "Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!";
}

//10 1 2 * * php -f /var/www/software/beta/admin/auto/invoice_bpn.php >> /var/log/crontab_invoice_bpn.log 2>&1
?>