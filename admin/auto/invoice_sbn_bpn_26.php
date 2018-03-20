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
global $conn_voip;
$conn_soft = Config::getInstanceSoft();


    $tgl_tagihan    = date("Y-m-26");
	$bln_tagihan    = date("Y-m-26", strtotime("+1 month"));
	
    $dept	    	= "Riset";
	$id_cabang    	= "2"; //SBN cabang
	
	//$tgl_tagihan	= str_replace('/', '-', $tgl_tagihan);
	
	//BillingTransactions
	$sql_rbs_lastdata	= "SELECT TOP 1 [dbo].[BillingTransactions].[BillingTransactionIndex] FROM [dbo].[BillingTransactions] ORDER BY [dbo].[BillingTransactions].[BillingTransactionIndex] DESC;";
	$query_rbs_lastdata = $conn_soft->prepare($sql_rbs_lastdata);
	$query_rbs_lastdata->execute();
	$row_rbs_lastdata	= $query_rbs_lastdata->fetch();
	
	$BillingTransactionIndex = $row_rbs_lastdata["BillingTransactionIndex"] ;
	
	//Bills
	$sql_bill_lastdata	= "SELECT TOP 1 [dbo].[Bills].[BillIndex] FROM [dbo].[Bills] ORDER BY [dbo].[Bills].[BillIndex] DESC;";
	$query_bill_lastdata = $conn_soft->prepare($sql_bill_lastdata);
	$query_bill_lastdata->execute();
	$row_bill_lastdata	= $query_bill_lastdata->fetch();
	
	$BillIndex = $row_bill_lastdata["BillIndex"];
	
	//BillSection 
	$sql_billsection_lastdata	= "SELECT TOP 1 [dbo].[BillsSections].[BillSectionIndex] FROM [dbo].[BillsSections] ORDER BY [dbo].[BillsSections].[BillSectionIndex] DESC;";
	$query_billsection_lastdata = $conn_soft->prepare($sql_billsection_lastdata);
	$query_billsection_lastdata->execute();
	$row_billsection_lastdata	= $query_billsection_lastdata->fetch();
	
	$BillSectionIndex = $row_billsection_lastdata["BillSectionIndex"];
	

    if($tgl_tagihan != "" AND $id_cabang !="")
	{
		$sql_insert = "INSERT INTO `gx_generate_invoice` (`id_generate`, `tgl_tagihan`, `id_cabang`, `dept`, `user_add`, `date_add`)
		VALUES (NULL, '".date("Y-m-d", strtotime($tgl_tagihan))."', '".$id_cabang."', '".$dept."', 'auto generate', NOW());";
		
		//echo $sql_insert;
		mysql_query($sql_insert, $conn) or die (mysql_error());
		//log
		enableLog("","auto", "auto", "Create Report Generate Invoice", $sql_insert);
				
		$sql_generate	= mysql_query("SELECT `id_generate` FROM `gx_generate_invoice` ORDER BY `id_generate` DESC LIMIT 0,1;", $conn);
		$row_generate	= mysql_fetch_array($sql_generate);
		
		$sql_customer	= mysql_query("SELECT `cKode` FROM `tbCustomer`, `gx_paket2`
								  WHERE `tbCustomer`.`cKdPaket` = `gx_paket2`.`kode_paket`
								  AND `tbCustomer`.`id_cabang` = '".$id_cabang."'
								  AND `gx_paket2`.`level` =  '0';", $conn);
		$cKode = array();
		while($row_customer = mysql_fetch_array($sql_customer)) {
			// Append to the array
			$cKode[] = $row_customer["cKode"];   
		}
		
		//print_r($cKode);
		
		$total_key = 0;
		$total_nongenerate = 0;
		foreach($cKode as $key => $value)
		{
			
			$BillingTransactionIndex++;
			$BillIndex++;
			$BillSectionIndex++;
			//GENERATE INVOICE
			
			//invoice
			//cek invoice
			$sql_invoice_cek = mysql_query("SELECT * FROM `gx_invoice`
										   WHERE `customer_number` = '".$value."'
										   AND `tanggal_tagihan` LIKE '%".date("Y-m-26", strtotime($tgl_tagihan))."%'
										   AND `level` = '0' LIMIT 0,1;", $conn);
			$row_invoice_cek = mysql_num_rows($sql_invoice_cek);
			//echo $row_invoice_cek."<br>";
			if($row_invoice_cek == "0")
			{
				$sql_customer	= mysql_query("SELECT * FROM `v_customer_aktivasi`
											WHERE `cKode` = '".$value."'
											AND `level` = '0'
											LIMIT 0,1;", $conn);
				
				$row_customer	= mysql_fetch_array($sql_customer);
				
				$total_invoice	= $row_customer["monthly_fee"] + $row_customer["abonemen_voip"] + $row_customer["abonemen_video"];
				$ppn			= (10/100) * $total_invoice;
				$monthly_fee	= $total_invoice + $ppn;
				
				//RBS
				
				
				$sql_rbs_lastdata_user	= "SELECT TOP 1 [Users].[UserPaymentBalance], [AccountTypes].[AccountName] FROM [dbo].[Users], [dbo].[AccountTypes]
				WHERE [dbo].[Users].[AccountIndex] = [dbo].[AccountTypes].[AccountIndex]
				AND [dbo].[Users].[UserActive] = '1'
				AND [dbo].[Users].[UserIndex] = '".$row_customer["iuserIndex"]."';";
				$query_rbs_lastdata_user = $conn_soft->prepare($sql_rbs_lastdata_user);
				$query_rbs_lastdata_user->execute();
				$row_rbs_lastdata_user	= $query_rbs_lastdata_user->fetch();
				
				$UserPaymentBalance = $row_rbs_lastdata_user["UserPaymentBalance"];
				$AccountName = $row_rbs_lastdata_user["AccountName"];
				
				//END RBS
				
				if($row_customer["nterm"]=="0.00")
				{
					$grace = "2";
				}else
				{
					$grace =(int)$row_customer["nterm"] -1;
				}
				
				if($row_customer["cKode"] != "" AND
					$row_customer["kode_inactive"] == NULL AND $row_customer["kode_off"] == NULL AND
					$row_customer["kode_aktivasi"] != NULL)
				{
					//echo "ok";
					$sql_invoice  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_invoice` ORDER BY `id_invoice` DESC", $conn));
					$last_data  = $sql_invoice["id_invoice"] + 1;
					$tanggal    = date("Ymd");
					$kode_invoice = $row_customer["invoice_code"].''.$tanggal.''.sprintf("%04d", $last_data);
					
					
					$total_invoice	= $row_customer["monthly_fee"] + $row_customer["abonemen_voip"] + $row_customer["abonemen_video"];
					$ppn			= (10/100) * $total_invoice;
					$monthly_fee	= $total_invoice + $ppn;
					
					
					$sql_insert_invoice = "INSERT INTO `gx_invoice`(`id_invoice`, `id_cabang`, `kode_aktivasi`, `kode_invoice`, `title`, `customer_number`,`nama_customer`,
											`npwp`, `no_faktur_pajak`, `note`, `periode_tagihan`,`tanggal_tagihan`, `tanggal_jatuh_tempo`,
										`no_virtual_account_bca`, `nama_virtual`, `reference`,  `status`,
										`total`, `ppn`, `grandtotal`,
										`paid_status`, `posting`,
										`prepared_by`, `date_add`, `date_upd`,
										`user_add`, `user_upd`, `level`)
									VALUES (NULL, '".$id_cabang."', '', '".$kode_invoice."', 'INVOICE ".NamaBulan(date("n", strtotime($bln_tagihan)))." ".date("Y", strtotime($bln_tagihan))."', '".$row_customer["cKode"]."', '".$row_customer["cNama"]."',
										'".$row_customer["no_npwp"]."', '', 'INVOICE ".NamaBulan(date("n", strtotime($bln_tagihan)))." ".date("Y", strtotime($bln_tagihan))."',
										'".NamaBulan(date("n", strtotime($bln_tagihan)))." ".date("Y", strtotime($bln_tagihan))."', '".date("Y-m-d", strtotime($tgl_tagihan))."',
										'".date("Y-m-03", strtotime($bln_tagihan))."', 
										'".$row_customer["cNoRekVirtual"]."', '".$row_customer["cNama"]."', '".$BillIndex."', '1',
										'".$row_customer["monthly_fee"]."', '".$ppn."', '".$monthly_fee."',
										'0', '1',
										'auto', NOW(), NOW(),
										'auto', 'auto', '0');";
					
					//echo $sql_insert_invoice."<br>";
				
					mysql_query($sql_insert_invoice, $conn) or die ("<script language='JavaScript'>
											   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
											   window.history.go(-1);
											   </script>");
					
					//log
					enableLog("","auto", "auto", "Create Invoice", $sql_insert_invoice);
					
					//detiail invoice inet
					
					$sql_detail_inet = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`, `date`,
											`harga`, `desc`, `date_add`,
											`date_upd`, `user_add`, `user_upd`, `level`)
										VALUES ('', '".$kode_invoice."', '".date("Y-m-d H:i:s", strtotime($tgl_tagihan))."',
											'".$row_customer["monthly_fee"]."', 'INTERNET', NOW(),
											NOW(), 'auto', 'auto', '0');";
					//echo $sql_detail_inet;
					mysql_query($sql_detail_inet, $conn) or die ("<script language='JavaScript'>
											   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
											   window.history.go(-1);
											   </script>");
					//log
					enableLog("","auto", "auto", "Create Invoice (detail internet)", $sql_detail_inet);
					
					
					$gx_saldo = $row_customer["gx_saldo"] - ($monthly_fee);
					$sql_update_saldo = "UPDATE `tbCustomer` SET `gx_saldo` = '".$gx_saldo."',
					`user_upd` = 'auto_generate', `date_upd` = NOW()
					WHERE (`idCustomer` = '".$row_customer["idCustomer"]."');";
					//echo $sql_detail_inet;
					mysql_query($sql_update_saldo, $conn) or die ("Update GX Saldo error.");
					//log
					enableLog("","auto", "auto", "Update GX Saldo (tbCustomer)", $sql_update_saldo);
					
					//END GENERATE
					
					
					//GENERATE detail invoice
					$sql_insert_detail = "INSERT INTO `gx_generate_detail` (`id_detail`, `id_generate`, `id_customer`, `kode_paket`)
					VALUES (NULL, '".$row_generate["id_generate"]."', '".$value."', '".$row_customer["cKdPaket"]."');";
					$total_key = $total_key + 1;
					//echo $sql_insert_detail;
					mysql_query($sql_insert_detail, $conn) or die (mysql_error());
					enableLog("","auto", "auto", "Create Report Generate Invoice (detail)", $sql_insert_detail);
			
					
					//START GENERATE INPUT INVOICE RBS
					if($monthly_fee != "0")
					{
						$total_invoice	= $row_customer["monthly_fee"] + $row_customer["abonemen_voip"] + $row_customer["abonemen_video"];
						$ppn			= (10/100) * $total_invoice;
						$monthly_fee	= $total_invoice + $ppn;
						
						
						$UserPaymentBalance_update = $UserPaymentBalance - ($monthly_fee);
						$nterm = (int)$row_customer["nterm"];
						$tambahan_grace = ($nterm == "0") ? "2" : $nterm;
						
						$sql_rbs_user_detail = "SET IDENTITY_INSERT [dbo].[Bills] ON
						INSERT INTO [dbo].[Bills] ([BillIndex], [BillType], [UserIndex], [BillStartDate], [BillEndDate], [CreateDate], [Emailed], [Charged], [EmailedSessions], [Exported1], [Exported2])
						VALUES ('".$BillIndex."', '1', '".$row_customer["iuserIndex"]."', '".date("Y-m-01 00:00:00.000", strtotime($bln_tagihan))."', '".date("Y-m-t 23:59:59.000", strtotime($bln_tagihan))."', '".date("Y-m-d H:i:s.000")."', '0', '0', '0', '0', '0');
						SET IDENTITY_INSERT [dbo].[Bills] OFF
						
						INSERT INTO [dbo].[BillsSections] ([BillIndex], [BillSectionIndex], [Type], [Charge], [Info1], [Info2], [Info3], [Remark])
						VALUES ('".$BillIndex."', '".$BillSectionIndex."', '1', '".$monthly_fee."', '0', '0', '0', 'For Dates ".date("01/m/Y", strtotime($bln_tagihan))." - ".date("t/m/Y", strtotime($bln_tagihan))." (".$AccountName.").');
						
						UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='".$UserPaymentBalance_update."', [GracePeriodExpiration] = '". date("Y-m-03 00:00:00.000", strtotime($bln_tagihan))."',
						[UserExpiryDate] = '".date("Y-m-01 00:00:00.000", strtotime($bln_tagihan." +1 month"))."'
						WHERE ([UserIndex]='".$row_customer["iuserIndex"]."');
						";
						//echo $sql_rbs_user_detail;
						$query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);
						
						$query_rbs_user_detail->execute();
						enableLog("","auto", "auto",$sql_rbs_user_detail);
						
						$sql = "SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
						INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
						VALUES ('".$BillingTransactionIndex."', '".date("Y-m-d H:i:s.000")."', '1', '".$row_customer["iuserIndex"]."', '1', '".$BillIndex."', '-".$monthly_fee."');
						SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF";
						
						//echo $sql;
						$q = $conn_soft->prepare($sql);
						$q->execute();
						enableLog("","auto", "auto",$sql);
						
					}
					//END GENERATE RBS
			
					//generate pdf invoice
					
					$pdf = generate_pdf($kode_invoice);
				}
				
				//echo "<br><br>";
				
			}else{
				$total_nongenerate = $total_nongenerate + 1;
				echo "$total_key invoice telah di generate $total_nongenerate sudah pernah dibuat untuk periode ini.";
			}
		}
		//echo "$total_key invoice telah di generate. $total_nongenerate sudah pernah dibuat untuk periode ini.";
    }else{
		echo "Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!";
    }

//10 1 2 * * php -f /var/www/software/beta/admin/auto/invoice_bpn.php >> /var/log/crontab_invoice_bpn.log 2>&1
?>