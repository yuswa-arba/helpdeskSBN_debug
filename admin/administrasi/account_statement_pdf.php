<?php
/*
 * Project Name: Globalxtreme Web Payment Template
 * Project URI: https://globalxtreme.net/new/payment
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Agustus 2013
 * Email: dwi@globalxtreme.net
 * Project for Web Payment
 * Last edited: Dwi
 * Desc: 
 * 
 */
include("../../config/configuration_admin.php");

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') { // jika yang login adalah admin

        global $conn;

        // menambil nilai/string yang ada pada url
        $customer_number = isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : "";
        $from_date = isset($_GET['f']) ? mysql_real_escape_string(strip_tags(trim($_GET['f']))) : "";
        $to_date = isset($_GET['t']) ? mysql_real_escape_string(strip_tags(trim($_GET['t']))) : "";

        $sql_customer = mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` LIKE '%" . $customer_number . "%' LIMIT 0,1;", $conn);
        $row_customer = mysql_fetch_array($sql_customer);

        $start = $current = strtotime($from_date);
        $end = strtotime($to_date);
        $balance = 0;
        $credit = 0;
        $debet = 0;
        $html_data = "";

        while ($current <= $end) {

            $sql_invoice = mysql_query("SELECT * FROM `gx_invoice`
			       WHERE `customer_number` = '" . $customer_number . "'
				   AND `level` = '0'
			       AND `tanggal_tagihan` = '" . date("Y-m-d", $current) . "';", $conn);

            while ($row_invoice = mysql_fetch_array($sql_invoice)) {

                $balance = ($balance + ($credit - $row_invoice["grandtotal"]));
                $html_data .= '
                        <tr align="left">
                            <td>' . date("d F Y", $current) . '</td>
                            <td>' . $row_invoice["title"] . '</td>
                            <td>' . $row_invoice["kode_invoice"] . '</td>
                            <td></td>
                            <td>' . number_format($row_invoice["grandtotal"], 0, '.', ',') . '</td>
                            <td></td>
                            <td>' . number_format($balance, 0, '.', ',') . '</td>
                        </tr>';
            }

            $sql_bankmasuk = mysql_query("SELECT * FROM `gx_bank_masuk`
			       WHERE `id_customer` = '" . $customer_number . "'
				   AND `level` = '0'
			       AND `tgl_transaction` = '" . date("Y-m-d", $current) . "';", $conn);

            while ($row_bankmasuk = mysql_fetch_array($sql_bankmasuk)) {
                $sql_bank_detail = mysql_query("SELECT SUM(`nominal`) AS `total` FROM `gx_bm_detail`
					      WHERE `id_bankmasuk` = '" . $row_bankmasuk["id_bankmasuk"] . "';", $conn);
                $row_bank_detail = mysql_fetch_array($sql_bank_detail);
                $balance = ($balance + ($row_bank_detail["total"] - $debet));
                $html_data .= '
                        <tr align="left">
                            <td>' . date("d F Y", $current) . '</td>
                            <td>' . $row_bankmasuk["remarks"] . '</td>
                            <td></td>
                            <td>' . $row_bankmasuk["transaction_id"] . '</td>
                            <td></td>
                            <td>' . number_format($row_bank_detail["total"], 0, '.', ',') . '</td>
                            <td>' . number_format($balance, 0, '.', ',') . '</td>
                        </tr>';
            }
            $sql_kasmasuk = mysql_query("SELECT * FROM `gx_kas_masuk`
			       WHERE `id_customer` = '" . $customer_number . "'
				   AND `level` = '0'
			       AND `tgl_transaction` = '" . date("Y-m-d", $current) . "';", $conn);

            while ($row_kasmasuk = mysql_fetch_array($sql_kasmasuk)) {
                $sql_kas_detail = mysql_query("SELECT SUM(`nominal`) AS `total` FROM `gx_km_detail`
					      WHERE `id_kasmasuk` = '" . $row_kasmasuk["id_kasmasuk"] . "';", $conn);
                $row_kas_detail = mysql_fetch_array($sql_kas_detail);
                $balance = ($balance + ($row_kas_detail["total"] - $debet));
                $html_data .= '
                        <tr align="left">
                            <td>' . date("d F Y", $current) . '</td>
                            <td>' . $row_kasmasuk["remarks"] . '</td>
                            <td></td>
                            <td>' . $row_kasmasuk["transaction_id"] . '</td>
                            <td></td>
                            <td>' . number_format($row_kas_detail["total"], 0, '.', ',') . '</td>
                            <td>' . number_format($balance, 0, '.', ',') . '</td>
                        </tr>';
            }

            $current = strtotime('+1 days', $current);
        }

        $sql_data_invoice = mysql_query("SELECT * FROM `gx_invoice`
			       WHERE `customer_number` = '" . $customer_number . "'
				   AND `level` = '0'
			       AND `tanggal_tagihan` >= '" . date("Y-m-d", strtotime($from_date)) . "'
			       AND `tanggal_tagihan` <= '" . date("Y-m-d", strtotime($to_date)) . "' ORDER BY `tanggal_tagihan` ASC LIMIT 0,1;", $conn);
        $row_data_invoice = mysql_fetch_array($sql_data_invoice);

        $status = "";
        if (($balance <= 0)) {
            $datetime1 = date_create($row_data_invoice["tanggal_jatuh_tempo"]);
            $datetime2 = date_create(date("Y-m-d"));
            $interval = date_diff($datetime2, $datetime1);
            $status = $interval->days;
        } else {
            $status = 0;
        }

        $sql_status = mysql_query("SELECT `nama_status` FROM `gx_status_collect`
			       WHERE `tgl1` >= '" . $status . "'
			       AND `tgl2` <= '" . $status . "' LIMIT 0,1;", $conn);
        $row_status = mysql_fetch_array($sql_status);
        $return = $row_status["nama_status"];


        $html = '
            <div style="top:0;margin-bottom:20px;font-size:10pt;">
                <table width="900" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#333333">
                    <tr>
                        <td>
                            <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="300" ><img src="/software/beta/img/logo_pdf.png" width="300"></td>
                                    <td width="400" align="center"><b>ACCOUNT STATEMENT</b></td>
                                    <td width="100" >Data, VOIP, Video</td>
                                </tr>
                            </table><hr>
                        </td>
                    </tr>
                    <tr>
                        <td width="900" colspan="2">
                            <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>Name Customer</td>
                                                <td>' . (isset($_GET['c']) ? $row_customer["cNama"] : '') . '</td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td>' . (isset($_GET['c']) ? $row_customer["cAlamat1"] : '') . '</td>
                                            </tr>
                                            <tr>
                                                <td>' . (isset($_GET['c']) ? $row_customer["cAlamat2"] : '') . '</td>
                                                <td>' . (isset($_GET['c']) ? $row_customer["cArea"] : '') . ' / ' . (isset($_GET['id']) ? $row_customer["cDaerah"] : '') . '</td>
                                            </tr>
                                            <tr>
                                                <td>City</td>
                                                <td>' . (isset($_GET['c']) ? $row_customer["cKota"] : '') . '</td>
                                            </tr>
                                            <tr>
                                                <td>Post Code</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Package</td>
                                                <td>' . (isset($_GET['c']) ? $row_customer["cPaket"] : '') . '</td>
                                            </tr>
                                            <tr>
                                                <td>Collectibility Status</td>
                                                <td>' . $return . '</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td valign="top">Customer Number</td>
                                                <td valign="top">' . (isset($_GET['c']) ? $row_customer["cKode"] : '') . '</td>
                                            </tr>
                                            <tr>
                                                <td valign="top">Periode Date</td>
                                                <td valign="top">' . date("d F Y") . '</td>
                                            </tr>
                                            <tr>
                                                <td>Due Date</td>
                                                <td>' . (isset($_GET['c']) ? date("d F Y", strtotime($row_data_invoice["tanggal_jatuh_tempo"])) : '') . '</td>
                                            </tr>
                                            <tr>
                                                <td>No Virtual Acc BCA</td>
                                                <td>' . (isset($_GET['c']) ? $row_customer["cNoRekVirtual"] : '') . '</td>
                                            </tr>
                                            <tr>
                                                <td>Page</td>
                                                <td>1 of 1</td>
                                            </tr>
                                            <tr>
                                                <td>Deposit Payment</td>
                                                <td>' . (($balance >= 0) ? number_format($balance, 0, '.', ',') : "0") . '</td>
                                            </tr>
                                            <tr>
                                                <td>Total Balance</td>
                                                <td>' . (($balance >= 0) ? "0" : number_format($balance, 0, '.', ',')) . '</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table><br><br>
                <table width="900" border="0" style="border:1px solid #000;font-size:8pt;" cellpadding="0" cellspacing="0" >
                    <tr align="center">
                        <th width="100">Date</th>
                        <th width="200">Description</th>
                        <th width="100">Reference No</th>
                        <th width="100">transaction No</th>
                        <th width="100">Debit</th>
                        <th width="100">Credit</th>
                        <th width="100">Balance</th>
                    </tr>
                    <tr align="center" >
                        <td style="border-bottom:1px solid #000 !important;" colspan="7"></td>
                    </tr>';
                        $html .= $html_data;
                        $html .= '<tr align="left">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr align="left">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            
            <div style="position: fixed;bottom:0; font-size:8pt;">
                <table width="900" border="0" cellspacing="0" style="border-bottom:solid; border-bottom-color:#000;font-size:8pt;">
                    <tr>
                        <td height="22" align="center">
                        <font style="font-size:9px;">Payment Due On Delivery Of This Invoice</font>
                        </td>
                    </tr>
                </table>
                
                <table width="900" border="0" cellspacing="0">
                    <tr>
                        <td colspan="3" align="center"><font style="font-size:9px;">Thank you for your bussiness</font></td>
                    </tr>
                    <tr>
                        <td width="281" align="right"><font style="font-size:9px;">Prepared By :</font></td>
                        <td width="202" align="left"><font style="font-size:9px; padding-left:15px">' . ucfirst(trim($loggedin["username"])) . '</font></td>
                        <td rowspan="2"><font style="font-size:9px;">Tanggal Cetak: ' . date("d F Y H:i:s") . '<br />
                        Printed: 1 </font></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top"><font style="font-size:9px;">Printed By :</font></td>
                        <td align="left" valign="top"><font style="font-size:9px; padding-left:15px">' . ucfirst(trim($loggedin["username"])) . '( ' . $_SERVER['REMOTE_ADDR'] . ' )</font></td>
                    </tr>
                </table>
            </div>';

        include_once("../../pdf/mpdf.php");

        $mpdf = new mPDF('s');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->SetTitle("Account Statement");
        $mpdf->WriteHTML($html); // Separate Paragraphs defined by font

        $mpdf->Output('account_statement.pdf', 'I');
        exit;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}
?>