<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("/var/www/software/beta/config/configuration_admin.php");
include ("/var/www/software/beta/config/configuration_voip_bpn.php");

global $conn;
global $conn_voip;
$conn_soft = Config::getInstanceSoft();


    $tgl_tagihan    = date("Y-m-d");
    $dept	    	= "Riset";
	$id_cabang    	= "7"; //balikpapan
	
	//$tgl_tagihan	= str_replace('/', '-', $tgl_tagihan);

    if($tgl_tagihan != "" AND $id_cabang !="")
	{
		$sql_insert = "INSERT INTO `software`.`gx_generate_invoice` (`id_generate`, `tgl_tagihan`, `id_cabang`, `dept`, `user_add`, `date_add`)
		VALUES (NULL, '".date("Y-m-d", strtotime($tgl_tagihan))."', '".$id_cabang."', '".$dept."', 'auto generate', NOW());";
		
		echo $sql_insert;
		//mysql_query($sql_insert, $conn) or die (mysql_error());
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
		print_r($cKode);
		echo "<br>";
		//$cKode = array("P-D000001");
		//$cKode = isset($_POST["cKode"]) ? $_POST["cKode"] : $cKode;
		$total_key = 0;
		$total_nongenerate = 0;
		foreach($cKode as $key => $value)
		{
			//GENERATE INVOICE
			/*echo "SELECT `tbCustomer`.*, `gx_cabang`.`invoice_code, `gx_paket2`.`abonemen_voip`, `gx_paket2`.`abonemen_video`, `gx_paket2`.`monthly_fee`
											FROM `tbCustomer`, `gx_paket2`, `gx_cabang`
											WHERE `tbCustomer`.`cKdpaket` = `gx_paket2`.`kode_paket`
											AND `tbCustomer`.`id_cabang` = `gx_cabang`.`id_cabang`
											AND `tbCustomer`.`cKode` = '".$value."'
											AND `tbCustomer`.`level` = '0' 
											LIMIT 0,1;";
				*/
			//invoice
			//cek invoice
			$sql_invoice_cek = mysql_query("SELECT * FROM `gx_invoice`
										   WHERE `customer_number` = '".$value."'
										   AND `tanggal_tagihan` LIKE '%".date("Y-m-", strtotime($tgl_tagihan))."%'
										   AND `level` = '0' LIMIT 0,1;", $conn);
			$row_invoice_cek = mysql_num_rows($sql_invoice_cek);
			echo $row_invoice_cek."<br>";
			if($row_invoice_cek == "0")
			{
				$sql_customer	= mysql_query("SELECT `tbCustomer`.*, `gx_cabang`.`invoice_code`, `gx_paket2`.`abonemen_voip`, `gx_paket2`.`abonemen_video`, `gx_paket2`.`monthly_fee`
											FROM `tbCustomer`, `gx_paket2`, `gx_cabang`
											WHERE `tbCustomer`.`cKdPaket` = `gx_paket2`.`kode_paket`
											AND `tbCustomer`.`id_cabang` = `gx_cabang`.`id_cabang`
											AND `tbCustomer`.`cKode` = '".$value."'
											AND `tbCustomer`.`level` = '0'
											AND `gx_paket2`.`level` = '0'
											LIMIT 0,1;", $conn);
				
				$row_customer	= mysql_fetch_array($sql_customer);
				
				
				//RBS
				$sql_rbs_lastdata	= "SELECT TOP 1 [billingTransactions].[BillingTransactionIndex] FROM [dbo].[billingTransactions] ORDER BY [BillingTransactionIndex] DESC;";
				$query_rbs_lastdata = $conn_soft->prepare($sql_rbs_lastdata);
				$query_rbs_lastdata->execute();
				$row_rbs_lastdata	= $query_rbs_lastdata->fetch();
				
				$BillingTransactionIndex = $row_rbs_lastdata["BillingTransactionIndex"] + 1;
				
				$sql_bill_lastdata	= "SELECT TOP 1 [Bills].[BillIndex] FROM [dbo].[Bills] ORDER BY [BillIndex] DESC;";
				$query_bill_lastdata = $conn_soft->prepare($sql_bill_lastdata);
				$query_bill_lastdata->execute();
				$row_bill_lastdata	= $query_bill_lastdata->fetch();
				
				$BillIndex = $row_bill_lastdata["BillIndex"] + 1;
				
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
				
				if($row_customer["nterm"]==-"0.00")
				{
					$grace = "2";
				}else
				{
					$grace =(int)$row_customer["nterm"] -1;
				}
				
				if($row_customer["cKode"] != "")
				{
				$sql_invoice  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_invoice` ORDER BY `id_invoice` DESC", $conn));
				$last_data  = $sql_invoice["id_invoice"] + 1;
				$tanggal    = date("Ymd");
				$kode_invoice = $row_customer["invoice_code"].''.$tanggal.''.sprintf("%04d", $last_data);
			
				$sql_insert_invoice = "INSERT INTO `gx_invoice`(`id_invoice`, `kode_aktivasi`, `kode_invoice`, `title`, `customer_number`,`nama_customer`,
										`npwp`, `no_faktur_pajak`, `note`, `periode_tagihan`,`tanggal_tagihan`, `tanggal_jatuh_tempo`,
									`no_virtual_account_bca`, `nama_virtual`, `prepared_by`, `date_add`, `date_upd`,
									`user_add`, `user_upd`, `level`)
								VALUES (NULL, '', '".$kode_invoice."', 'INVOICE ".NamaBulan(date("n", strtotime($tgl_tagihan)))." ".date("Y", strtotime($tgl_tagihan))."', '".$row_customer["cKode"]."', '".$row_customer["cNama"]."',
									'".$row_customer["no_npwp"]."', '', 'INVOICE ".NamaBulan(date("n", strtotime($tgl_tagihan)))." ".date("Y", strtotime($tgl_tagihan))."',
									'".NamaBulan(date("n", strtotime($tgl_tagihan)))." ".date("Y", strtotime($tgl_tagihan))."', '".date("Y-m-d", strtotime($tgl_tagihan))."',
									'".date("Y-m-d", strtotime("$tgl_tagihan +$grace days"))."',
									'".$row_customer["cNoRekVirtual"]."', '".$row_customer["cNama"]."', 'auto', NOW(), NOW(),
									'auto', 'auto', '0');";
				
				echo $sql_insert_invoice."<br>";
			
				/*mysql_query($sql_insert_invoice, $conn) or die ("<script language='JavaScript'>
										   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
										   window.history.go(-1);
										   </script>");*/
				
				//log
				enableLog("","auto", "auto", "Create Invoice", $sql_insert_invoice);
				
				//detiail invoice inet
				$sql_detail_inet = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`, `date`,
										`harga`, `desc`, `date_add`,
										`date_upd`, `user_add`, `user_upd`, `level`)
									VALUES ('', '".$kode_invoice."', '".date("Y-m-d H:i:s", strtotime($tgl_tagihan))."',
										'".$row_customer["monthly_fee"]."', 'INTERNET', NOW(),
										NOW(), 'auto', 'auto', '0');";
				echo $sql_detail_inet;
				/*mysql_query($sql_detail_inet, $conn) or die ("<script language='JavaScript'>
										   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
										   window.history.go(-1);
										   </script>");*/
				//log
				enableLog("","auto", "auto", "Create Invoice (detail internet)", $sql_detail_inet);
				
				
				//detiail invoice voip
				$sql_detail_voip = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`, `date`,
										`harga`, `desc`, `date_add`,
										`date_upd`, `user_add`, `user_upd`, `level`)
									VALUES ('', '".$kode_invoice."', '".date("Y-m-d H:i:s", strtotime($tgl_tagihan))."',
										'".$row_customer["abonemen_voip"]."', 'VOIP', NOW(),
										NOW(), 'auto', 'auto', '0');";
				echo $sql_detail_voip;
				/*mysql_query($sql_detail_voip, $conn) or die ("<script language='JavaScript'>
										   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
										   window.history.go(-1);
										   </script>");*/
				//log
				enableLog("","auto", "auto", "Create Invoice (detail voip)", $sql_detail_voip);
				
				//detiail invoice video
				$sql_detail_video = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`, `date`,
										`harga`, `desc`, `date_add`,
										`date_upd`, `user_add`, `user_upd`, `level`)
									VALUES ('', '".$kode_invoice."', '".date("Y-m-d H:i:s", strtotime($tgl_tagihan))."',
										'".$row_customer["abonemen_video"]."', 'TV/VIDEO', NOW(),
										NOW(), 'auto', 'auto', '0');";
				echo $sql_detail_video;
				/*mysql_query($sql_detail_video, $conn) or die ("<script language='JavaScript'>
										   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
										   window.history.go(-1);
										   </script>");*/
				//log
				enableLog("","auto", "auto", "Create Invoice (detail video)", $sql_detail_video);
				
			
				//END GENERATE
				
				
				//GENERATE detail invoice
				$sql_insert_detail = "INSERT INTO `software`.`gx_generate_detail` (`id_detail`, `id_generate`, `id_customer`, `kode_paket`)
				VALUES (NULL, '".$row_generate["id_generate"]."', '".$value."', '".$row_customer["cKdPaket"]."');";
				$total_key = $total_key + 1;
				echo $sql_insert_detail;
				//mysql_query($sql_insert_detail, $conn) or die (mysql_error());
				enableLog("","auto", "auto", "Create Report Generate Invoice (detail)", $sql_insert_detail);
			
			
					if($row_customer["abonemen_voip"] != "0")
					{
						//input invoice VOIP
						$sql_invoice = mysql_query("SELECT COUNT(*) as `total` FROM `cc_invoice` WHERE `date` LIKE '%2015-%';", $conn_voip);
						$row_invoice = mysql_fetch_array($sql_invoice);
						
						$total = $row_invoice["total"] + 1;
						$reference = date("Ymd").sprintf("%04d", $total);
						
						$sql_voip = mysql_query("SELECT * FROM `gx_voip_nomerTelpon` WHERE `customer_number` = '".$value."' LIMIT 0,1;", $conn);
						$row_voip = mysql_fetch_array($sql_voip);
						
						$sql_card = mysql_query("SELECT `id` FROM `cc_card` WHERE `useralias` = '".$row_voip["nomer_telpon"]."' LIMIT 0,1;", $conn_voip);
						$row_card = mysql_fetch_array($sql_card);
						
						if($row_card["id"] !="")
						{
							//insert into cc_subscription_service
							$sql_voip_insert = "INSERT INTO `mya2billing`.`cc_invoice` (`id`, `reference`, `id_card`, `date`,
							`paid_status`, `status`, `title`, `description`)
							VALUES (NULL, '$reference', '".$row_card["id"]."', '".date("Y-m-d H:i:s", strtotime($tgl_tagihan))."', '0', '0',
							'INVOICE ABONEMEN', 'INVOICE ".NamaBulan(date("n", strtotime($tgl_tagihan)))." ".date("Y", strtotime($tgl_tagihan))."');";
							
							echo $sql_voip_insert;
							//mysql_query($sql_voip_insert, $conn_voip) or die (mysql_error());
							//log
							enableLog("","auto", "auto", "Create invoice VOIP (invoice)", $sql_voip_insert);
							
							$sql_voip_invoice = mysql_query("SELECT `id` FROM `cc_invoice` WHERE `id_card` = '".$row_card["id"]."'
													AND `date` LIKE '%".date("Y-m-d", strtotime($tgl_tagihan))."%'
													LIMIT 0,1 ORDER BY `id` DESC;", $conn_voip);
							$row_voip_invoice = mysql_fetch_array($sql_voip_invoice);
							
							$sql_voip_insertdetail = "INSERT INTO `mya2billing`.`cc_invoice_item` (`id`, `id_invoice`, `date`,
							`price`, `VAT`, `description`, `id_ext`, `type_ext`)
							VALUES (NULL, '".$row_voip_invoice["id"]."', '".date("Y-m-d H:i:s", strtotime($tgl_tagihan))."', '".$row_customer["abonemen_voip"].".00000',
							'0.00000', 'Abonemen', NULL, NULL);";
							echo $sql_voip_insertdetail;
							//mysql_query($sql_voip_insertdetail, $conn_voip) or die (mysql_error());
							//log
							enableLog("","auto", "auto", "Create invoice VOIP (invoice item)", $sql_voip_insertdetail);
						}
					}
					//END GENERATE VOIP
					
					
					//START GENERATE INPUT INVOICE RBS
					if($row_customer["monthly_fee"] != "0")
					{
						$sql = "SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
						INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
						VALUES ('".$BillingTransactionIndex."', '".date("Y-m-d H:i:s.000")."', '1', '".$row_customer["iuserIndex"]."', '1', '".$BillIndex."', '-".$row_customer["monthly_fee"]."');
						SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF";
						
						echo $sql;
						//$q = $conn_soft->prepare($sql);
						//$q->execute();
						enableLog("","auto", "auto",$sql);
						
						$UserPaymentBalance_update = $UserPaymentBalance - $row_customer["monthly_fee"];
						$nterm = (int)$row_customer["nterm"];
						$tambahan_grace = ($nterm == "0") ? "2" : $nterm;
						
						$sql_rbs_user_detail = "SET IDENTITY_INSERT [dbo].[Bills] ON
						INSERT INTO [dbo].[Bills] ([BillIndex], [BillType], [UserIndex], [BillStartDate], [BillEndDate], [CreateDate], [Emailed], [Charged], [EmailedSessions], [Exported1], [Exported2])
						VALUES ('".$BillIndex."', '1', '".$row_customer["iuserIndex"]."', '".date("Y-m-01 00:00:00.000", strtotime($tgl_tagihan))."', '".date("Y-m-t 23:59:59.000", strtotime($tgl_tagihan))."', '".date("Y-m-d H:i:s.000")."', '0', '0', '0', '0', '0');
						SET IDENTITY_INSERT [dbo].[Bills] OFF
						
						INSERT INTO [dbo].[BillsSections] ([BillIndex], [BillSectionIndex], [Type], [Charge], [Info1], [Info2], [Info3], [Remark])
						VALUES ('".$BillIndex."', '1', '1', '".$row_customer["monthly_fee"]."', '0', '0', '0', 'For Dates ".date("d/m/Y", strtotime($tgl_tagihan))." - ".date("t/m/Y", strtotime($tgl_tagihan))." (".$AccountName.").');
						
						UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='".$UserPaymentBalance_update."', [GracePeriodExpiration] = '". date("Y-m-d 00:00:00.000", strtotime($tgl_tagihan. "+$tambahan_grace days"))."',
						[UserExpiryDate] = '".date("Y-m-01 00:00:00.000", strtotime($tgl_tagihan. "+1 month"))."'
						WHERE ([UserIndex]='".$row_customer["iuserIndex"]."');
						";
						echo $sql_rbs_user_detail;
						//$query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);
						
						//$query_rbs_user_detail->execute();
						enableLog("","auto", "auto",$sql_rbs_user_detail);
					}
					//END GENERATE RBS
			
			
				}
				
				echo "<br><br>";
				
			}else{
				$total_nongenerate = $total_nongenerate + 1;
				echo "$total_key invoice telah di generate $total_nongenerate sudah pernah dibuat untuk periode ini.";
			}
		}
		echo "$total_key invoice telah di generate. $total_nongenerate sudah pernah dibuat untuk periode ini.";
    }else{
		echo "Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!";
    }

//*/10 * * * * php -f /var/www/software/beta/cso/helpdesk/crontab.php >> /var/log/crontab_invoice.log 2>&1
?>