<?php


if(isset($_POST["save"])){
	if ($_FILES["file"]["error"] > 0)
	{
	//echo "Error: " . $_FILES["file"]["error"] . "<br />";
	echo "<script language='JavaScript'>
		alert('Error: " . $_FILES["file"]["error"] ."');
		window.location.href='form_generate.php';
		</script>";
	}
	elseif ($_FILES["file"]["type"] !== "text/plain")
	{
		echo "<script language='JavaScript'>
		alert('File harus ekstensi .txt');
		window.location.href='form_generate.php';
		</script>";
	//echo "File harus ekstensi .txt";
		
	}
	else
	{
		
		$id_cabang	= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
		$lines = file($_FILES['file']['tmp_name']); // Get each line of the file and store it as an array
		$line_data =  count ($lines) - 1;
		
		$retensi = (explode("1RETENSI",file_get_contents($_FILES['file']['tmp_name'])));
		$total_retensi = count($retensi) - 1;
		
		$line_retensi =  explode("\n", $retensi[$total_retensi]);
		
		for($a = 0; $a<= 4; $a++)
		{
			if (strripos($lines[$a], 'TANGGAL') !== false)
			{
				$tanggal = explode(':',$lines[$a]);
				//echo end($tanggal);
				$arr_tgl = explode('/', end($tanggal));
				$tanggal = trim($arr_tgl[2]).'/'.trim($arr_tgl[1]).'/'.trim($arr_tgl[0]);
				//echo '20'.$tanggal;
				//echo date("Y-m-d", strtotime('20'.$tanggal));
			}
		}
		
		for($a = 2; $a<= $line_data; $a++)
		{
			
			$nomor_urut			= trim(substr($lines[$a], 0, 11));
			$nomor_pengenal		= trim(substr($lines[$a], 12, 30));
			$nama				= trim(substr($lines[$a], 42, 32));
			$nilai_transaksi	= str_replace('.','', trim(substr($lines[$a], 74, 20)));
			$tgl_txn			= trim(substr($lines[$a], 94, 16));
			$waktu				= trim(substr($lines[$a], 110, 14));
			$lokasi				= trim(substr($lines[$a], 124, 10));
			$berita1			= trim(substr($lines[$a], 134, 18));
			$berita2			= trim(substr($lines[$a], 152, 18));
			
			if(is_numeric($nomor_urut))
			{
				
				
				$sql_user	= mysql_query("SELECT * FROM `tbCustomer`
						  WHERE `tbCustomer`.`cNoRekVirtual` = '".$nomor_pengenal."' LIMIT 0,1;", $conn);
				$row_user	= mysql_fetch_array($sql_user);
				
				$sql_paket	= mysql_query("SELECT `gx_paket2`.`acc_piutang_inet` FROM `tbCustomer`, `gx_paket2`
							WHERE `tbCustomer`.`cKdPaket` = `gx_paket2`.`kode_paket`
							AND `tbCustomer`.`cNoRekVirtual` = '".$nomor_pengenal."' LIMIT 0,1;", $conn);
				$row_paket	= mysql_fetch_array($sql_paket);
				
				$sql_last_data 	= mysql_fetch_array(mysql_query("SELECT COUNT(`id_bankmasuk`) as `total` FROM `gx_bank_masuk` WHERE `date_add` LIKE '%".date("Y-m-d")."%';", $conn));
		
				$last_data  	= $sql_last_data["total"] + 1;
				$sql_cabang	= mysql_query("SELECT `gx_cabang`.`kode_cabang`, `gx_cabang`.`kode_bm` FROM `gx_cabang`, `gx_pegawai`
			      WHERE `gx_cabang`.`id_cabang` = `gx_pegawai`.`id_cabang`
			      AND `gx_cabang`.`id_cabang` = '6' LIMIT 0,1;", $conn);
				$row_cabang	= mysql_fetch_array($sql_cabang);
				//data transaksi id bank masuk
				$transaction_id	= $row_cabang["kode_bm"].''.date("ymd").''.sprintf("%03d", $last_data);
				
				
				//Data RBS jika ckode berisi nilai
				/*if($row_user["cKode"] != "")
				{
					//detail user
					//$query_user	= "SELECT `iuserIndex`, `cUserID` FROM `tbCustomer` WHERE `cKode` ='".$row_user["cKode"]."';";
					//$sql_user	= mysql_query($query_user, $conn);
					//$row_user	= mysql_fetch_array($sql_user);
					
					//Detail RBS
					$sql_rbs_lastdata	= "SELECT TOP 1 [billingTransactions].[BillingTransactionIndex] FROM [dbo].[billingTransactions] ORDER BY [BillingTransactionIndex] DESC;";
					$query_rbs_lastdata = $conn_soft->prepare($sql_rbs_lastdata);
					$query_rbs_lastdata->execute();
					$row_rbs_lastdata	= $query_rbs_lastdata->fetch();
					
					$BillingTransactionIndex = $row_rbs_lastdata["BillingTransactionIndex"] + 1;
					
					$sql_pay_lastdata	= "SELECT TOP 1 [Payments].[PaymentNumber] FROM [dbo].[Payments] ORDER BY [PaymentNumber] DESC;";
					$query_pay_lastdata = $conn_soft->prepare($sql_pay_lastdata);
					$query_pay_lastdata->execute();
					$row_pay_lastdata	= $query_pay_lastdata->fetch();
					
					$PaymentNumber = $row_pay_lastdata["PaymentNumber"] + 1;
					
					$sql_rbs_lastdata_user	= "SELECT TOP 1 [Users].[UserPaymentBalance], [AccountTypes].[AccountName] FROM [dbo].[Users], [dbo].[AccountTypes]
					WHERE [dbo].[Users].[AccountIndex] = [dbo].[AccountTypes].[AccountIndex]
					AND [dbo].[Users].[UserIndex] = '".$row_user["iuserIndex"]."';";
					$query_rbs_lastdata_user = $conn_soft->prepare($sql_rbs_lastdata_user);
					$query_rbs_lastdata_user->execute();
					$row_rbs_lastdata_user	= $query_rbs_lastdata_user->fetch();
					
					$UserPaymentBalance = $row_rbs_lastdata_user["UserPaymentBalance"];
					$AccountName = $row_rbs_lastdata_user["AccountName"];
					//End Detail RBS
					
					
					$sql = "SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
					INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
					VALUES ('".$BillingTransactionIndex."', '".date("Y-m-d H:i:s.000")."', '1', '".$row_user["iuserIndex"]."', '2', '".$PaymentNumber."', '".$nilai_transaksi."');
					SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF";
					$q = $conn_soft->prepare($sql);
					$q->execute();
					
					
					$UserPaymentBalance_update = $UserPaymentBalance + $nilai_transaksi;
					
					$sql_rbs_user_detail = "
					INSERT INTO [dbo].[Payments] ([PaymentNumber], [PaymentMethod], [CreateDate], [UserType], [UserIndex], [Amount], [Remark])
					VALUES ('".$PaymentNumber."', '5', '".date("Y-m-d H:i:s.000")."', '1', '".$row_user["iuserIndex"]."', '".$nilai_transaksi."', 'VA Bank Masuk ');
					
					UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='".$UserPaymentBalance_update."'
					WHERE ([UserIndex]='".$row_user["iuserIndex"]."');
					";
					$query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);
					
					$query_rbs_user_detail->execute();
					//END RBS
				
				}
				
				*/
				
				$sql_insert_bank_masuk = "INSERT INTO `gx_bank_masuk` (`id_bankmasuk`, `id_cabang`, `transaction_id`, `tgl_transaction`,
									`nomer_va`, `bank_code`, `id_customer`, `nama`, `acc_credit`, `mu`, `rate`, `total`, `remarks`, `status`,
									`date_add`, `date_upd`, `user_upd`, `user_add`, `level`)
									VALUES (NULL, '".$id_cabang."', '".$transaction_id."', '".$tanggal."', 
									'".$nomor_pengenal."', 'BCA VA', '".$row_user["cKode"]."',  '".$row_user["cNama"]."',  '1121',  'IDR',  '1.0',
									'',  'Payment by VA',  '1',
									NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
				//echo $sql_insert_bank_masuk."<br>";
				mysql_query($sql_insert_bank_masuk, $conn);
				
				$sql_lastdata_bm = mysql_query("SELECT `id_bankmasuk` FROM `gx_bank_masuk` WHERE `transaction_id` = '".$transaction_id."';", $conn);
				$row_lasdata_bm	 = mysql_fetch_array($sql_lastdata_bm);
				
				
				$sql_insert_bm_detail = "INSERT INTO `gx_bm_detail` (`id_bm_detail`, `id_bankmasuk`, `no_acc`,
				`kode_invoice`, `title`, `nominal`, `tgl_txn`, `waktu`, `lokasi`, `berita1`, `berita2`,
				`date_add`, `date_upd`, `user_upd`, `user_add`, `level`)
				VALUES ('', '".$row_lasdata_bm["id_bankmasuk"]."', '".$row_paket["acc_piutang_inet"]."', '".$row_user["cKode"]."', 'BCA VA', '".(int)$nilai_transaksi."',
				'".$tgl_txn."', '".$waktu."', '".$lokasi."', '".$berita1."', '".$berita2."',
				NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
				//echo '<b>'.$nomor_urut.'.</b> '. $sql_insert_bm_detail."<br>";
				mysql_query($sql_insert_bm_detail, $conn);
			}
			
		}

	}
	echo "<script language='JavaScript'>
	    alert('Data telah di insert.');
	    window.location.href='master_bankmasuk.php';
	    </script>";
}
?>