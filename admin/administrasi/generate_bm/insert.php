<?php

global $conn;
$conn_soft = Config::getInstanceSoft();

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
		

		$fp = fopen($_FILES['file']['tmp_name'], 'rb');
		$data_va = fread($fp,filesize($_FILES['file']['tmp_name']));
											
		
		$pecah_kategori = explode("------------------------------------------------------------------------------------------------------------------------------------------------------------------------- ", $data_va);
		//print_r($pecah_kategori);
		$pecah_log_virtual = $pecah_kategori[0];
		$pecah_log_virtual = explode(" : ", $pecah_log_virtual);
		//print_r($pecah_log_virtual);
		$out = '';
		/*
		$out .= ''.substr($pecah_log_virtual[1], 0, -(strlen(" LAPORAN TRANSAKSI VIRTUAL ACCOUNT FREKWENSI")*2))."<br/>";
		$out .= ''.substr($pecah_log_virtual[2], 0, -(strlen(" LAPORAN")*2))."<br/>";
		$out .= ''.substr($pecah_log_virtual[3], 0, -(strlen(" TANGGAL")*2))."<br/>";
		$out .= ''.substr($pecah_log_virtual[4], 0, -(strlen(" CABANG")*2))."<br/>";
		$out .= ''.substr($pecah_log_virtual[5], 0, -(strlen(" JAM ")*2))."<br/>";
		$out .= ''.substr($pecah_log_virtual[6], 0, -(strlen(" KD. PERUSAHAAN")*2))."<br/>";
		$out .= ''.substr($pecah_log_virtual[7], 0, -(strlen(" HALAMAN")*2))."<br/>";
		$out .= ''.substr($pecah_log_virtual[8], 0, -(strlen(" ")*2))."<br/>";
		*/
		$retensi 		= trim(substr($pecah_log_virtual[1], 0, -(strlen(" LAPORAN TRANSAKSI VIRTUAL ACCOUNT FREKWENSI")*2)));
		$frekuensi 		= trim(substr($pecah_log_virtual[2], 0, -(strlen(" LAPORAN")*2)));
		$laporan 		= trim(substr($pecah_log_virtual[3], 0, -(strlen(" TANGGAL")*2)));
		$tanggal 		= trim(substr($pecah_log_virtual[4], 0, -(strlen(" CABANG")*2)));
		
		$arr_tanggal = explode('/', $tanggal);
		$tanggal = trim($arr_tanggal[2]).'/'.trim($arr_tanggal[1]).'/'.trim($arr_tanggal[0]);
		$tanggal_cari = trim($arr_tanggal[2]).'-'.trim($arr_tanggal[1]).'-'.trim($arr_tanggal[0]);
		
		$cabang 		= trim(substr($pecah_log_virtual[5], 0, -(strlen("  JAM")*2)));
		$jam 			= trim(substr($pecah_log_virtual[6], 0, -(strlen(" KD. PERUSAHAAN")*2)));
		$kd_perusahaan 	= trim(substr($pecah_log_virtual[7], 0, -(strlen(" HALAMAN")*2)));
		$halaman 		= trim(substr($pecah_log_virtual[8], 0, -(strlen(" ")*2)));

		//$out .= 'kategori field <br/>';
		//$out .= print_r(explode("#", str_replace("  ", "#", $pecah_kategori[1])));
		$proc_data = explode("#", str_replace("  ", "", str_replace("  ", "#", $pecah_kategori[1])));
		$ins_data = array();
		foreach($proc_data as $d => $e){
			if($e != '' && $e != ' ' && isset($e)){ $ins_data[] = $e; }
		}
		//echo print_r($ins_data);
		foreach($ins_data as $fi){
			//$out .= $fi ."<br>";
		}



		
		

		$pecah_transact_virtual = $pecah_kategori[3];
		$pecah_transact_virtual = explode(" : ", $pecah_transact_virtual);
		/*
			$out .= ''.substr($pecah_transact_virtual[1], 0, -(strlen(" JUMLAH")*2))."<br/>";
			$out .= ''.substr($pecah_transact_virtual[2], 0, -(strlen(" KOMISI")*2))."<br/>";
			$out .= ''.substr($pecah_transact_virtual[3], 0, -(strlen(" ")*2))."<br/>";
		*/
		//$total_transaksi 	= substr($pecah_transact_virtual[1], 0, -(strlen(" JUMLAH")*2));
		//$jumlah 			= substr($pecah_transact_virtual[2], 0, -(strlen(" KOMISI")*2));
		//$komisi				= substr($pecah_transact_virtual[3], 0, -(strlen(" ")*2));

		
		
		$pecah_transact_virtual = str_replace("=", "", $pecah_kategori[4]);
		$pecah_transact_virtual = explode(" : ", $pecah_transact_virtual);
		//$out .= ''.substr($pecah_transact_virtual[1], 0, -(strlen(" ")*2))."<br/>";
		$check_sum_perusahaan = substr($pecah_transact_virtual[1], 0, -(strlen(" ")*2));


		//$out .= '<br/>';

		//$out .= '';
		//echo $out;
		//$out .= print_r(explode("#", str_replace("  ", "#", $pecah_kategori[1])));
		/*
		$proc_data = explode("#", str_replace("  ", "", str_replace("  ", "#", $pecah_kategori[2])));
		$ins_data = array();
		$num_in = 0;
		foreach($proc_data as $d => $e){
			if($d > 0){
					if($e != '' && $e != ' ' && isset($e)){				
						if($num_in>=-10){ if($num_in == -5){$ins_data[] = $e; $num_in = $num_in-1; $ins_data[] = $e; } else{$ins_data[] = $e;}}
						elseif($num_in<-10){if($num_in%-10 == 0){$ins_data[] = $e; $num_in = $num_in-1; $ins_data[] = $e;} else{$ins_data[] = $e;}} 
						else{$ins_data[] = $e;}
						//$ins_data[] = $e;
					}	
					
			}
		$num_in--;	
		}
		echo ($num_in%10);*/
		$proc_data = explode("#", str_replace("  ", "", str_replace(" ", "#", $pecah_kategori[2])));
		$search_data_num = array();
		$input_data = array();
		$input_data_ = array();
		$string_ins = array();
		$all_num = array();
		
		foreach($proc_data as $search){
				//$check_data = preg_match("/^[0-9]*$/", $search_id); 
				/*if(!preg_match("/[0-9]/", $search)){ 
						//null
				}else{
					$search_data_num[] = $search;
				}*/
				/*
				if($d > 0){
							if($e != '' && $e != ' ' && isset($e)){				
								if($num_in>=-10){ if($num_in == -5){$ins_data[] = $e; $num_in = $num_in-1; $ins_data[] = $e; } else{$ins_data[] = $e;}}
								elseif($num_in<-10){if($num_in%-10 == 0){$ins_data[] = $e; $num_in = $num_in-1; $ins_data[] = $e;} else{$ins_data[] = $e;}} 
								else{$ins_data[] = $e;}
								$detect = explode(" ", $e);
								//print_r($detect);
								$in = isset($detect[1]) ? $detect[1] : ' ';
								//if(strlen($in) == 5){$trace_data = explode(" ", $e); $ins_data[] = $trace_data[0]; $ins_data[] = $trace_data[1];}
								//if(strlen($in) == 5){ $ins_data[] = $e; $ins_data[] = $e;}
								if(strlen($in) == 5){
									$trace_data = explode(" ", $e); $num_trace = count($trace_data); 
								if($num_trace > 2){ 
								$data_im = array(); foreach($trace_data as $ntd => $td ){ if($ntd > 1){$data_im[] = $td;} } $data_last = implode(" ", $data_im);
								}
								//else{$data_last = $trace_data[2];} 
									$ins_data[] = $trace_data[1]; 
										$num_word = strlen($data_last);
										if($num_word > 15){ $ins_data[] = $data_last; $ins_data[] = $data_last; }
										elseif($num_word < 2){ if (strpos($data_last,'.') !== false){$ins_data[] = $data_last; $ins_data[] = $data_last; }else{$ins_data[] = $data_last; }}
										//elseif($num_word > 2 && $num_in%10 == 6 && strpos($data_last,'') !== false){ $ins_data[] = $data_last; $ins_data[] = $data_last;}
										else{  $ins_data[] = $data_last; }
										//if($d%10 == 9){ echo "test :". $data_last ." in :".$d;}
								}
								else{$ins_data[] = $e;
										if($check_num == 9){$check_data = preg_match("/[0-9]/", $e); if($check_data == true){ $ins_data[] = ''; }}
								}
								//if($check_num == 9){$check_data = preg_match("/[0-9]/i", $e); if($check_data == true){ $ins_data[] = ''; }}
							
							if($check_num >= 9){$check_num = 0; }else{ $check_num++;}	
							}	
							
					}*/
				if(!is_numeric($search)){
					
				}else{
					if(strlen(str_replace(" ", "", $search))<=3){
						$search_data_num[] = $search;
						
						$num_start = $search;
						if($search != 0){$num_finnish = $search+1;}
						else{$num_finnish = 0;}
						//ring data
						$input_data[] = array($num_start, $num_finnish);
						$startnum = array_search(" ".$num_start."", $proc_data);
						$endnum = array_search(" ".$num_finnish."", $proc_data);
						$all_num[] = $search;
						$string_ins[] = implode(' ', array_slice($proc_data, $startnum, $endnum-$startnum));
						
						/*
						//$input_data[] = array($num_start, $num_finnish);
						$input_data[] = array_chunk(, 2,true);
						*/
						/*if($check_num == 0 && $num_in == 9){$check_num = 9;}
						elseif($check_num == 8 && $num_in == 9){$check_num = 9;}
						elseif($check_num == 9 && $num_in == 7){$check_num = 7;}
						elseif($check_num == 9 && $num_in == 8){$check_num = 8;}*/		
						
					}
					
				}
		}
		//print_r($string_ins);

		//$num = {}
		
		$ar_filter = array_unique($all_num);
		$array = $ar_filter;

		
		$data_ins = array();
		foreach($array as $d){
			if(current($array) == false || $d == 0){
				
			}else{
			$data_1 = $d;
			$mo1 = $data_1;
			next($array);	
			$data_2 =   current($array);
			$mo2 = $data_2;
			$data_ins[] = array($mo1, $mo2);
			}
			
		}
		

		
		$data_row = array();
		foreach($data_ins as $data_kode){
						$num_start = $data_kode[0];
						$num_finnish = $data_kode[1];
						$startnum = array_search(" ".$num_start."", $proc_data);
						$endnum = array_search(" ".$num_finnish."", $proc_data);
		$data_row[] = implode(' ', array_slice($proc_data, $startnum, $endnum-$startnum));
		}
		

		
		$data_row_new = array();
		foreach($data_row as $dr){
		$proc_row = explode("#", str_replace("  ", "", str_replace("  ", "#", $dr)));	
					$ins_data = array();
					foreach($proc_row as $d => $e){
						
								if($e != '' && $e != ' ' && isset($e)){				
									/*if($num_in>=-10){ if($num_in == -5){$ins_data[] = $e; $num_in = $num_in-1; $ins_data[] = $e; } else{$ins_data[] = $e;}}
									elseif($num_in<-10){if($num_in%-10 == 0){$ins_data[] = $e; $num_in = $num_in-1; $ins_data[] = $e;} else{$ins_data[] = $e;}} 
									else{$ins_data[] = $e;}*/
									$detect = explode(" ", $e);
									
									$in = isset($detect[1]) ? $detect[1] : ' ';
									//if(strlen($in) == 5){$trace_data = explode(" ", $e); $ins_data[] = $trace_data[0]; $ins_data[] = $trace_data[1];}
									//if(strlen($in) == 5){ $ins_data[] = $e; $ins_data[] = $e;}
									if(strlen($in) == 5){
											/*
												$trace_data = explode(" ", $e); $num_trace = count($trace_data); 
												if($num_trace > 2){ 
												$data_im = array(); foreach($trace_data as $ntd => $td ){ if($ntd > 1){$data_im[] = $td;} } $data_last = implode(" ", $data_im);
												}
												//else{$data_last = $trace_data[2];} 
													$ins_data[] = $trace_data[1]; 
													$num_word = strlen($data_last);
													if($num_word > 15){ $ins_data[] = $data_last; $ins_data[] = $data_last; }
													elseif($num_word < 2){ if (strpos($data_last,'.') !== false){$ins_data[] = $data_last; $ins_data[] = $data_last; }else{$ins_data[] = $data_last; }}
													//elseif($num_word > 2 && $num_in%10 == 6 && strpos($data_last,'') !== false){ $ins_data[] = $data_last; $ins_data[] = $data_last;}
													else{  $ins_data[] = $data_last; }
													//if($d%10 == 9){ echo "test :". $data_last ." in :".$d;}*/
									$trace_data = explode(" ", $e); $num_trace = count($trace_data); 
									if($num_trace > 2){ $data_im = array(); foreach($trace_data as $ntd => $td ){ if($ntd > 1){$data_im[] = $td;} } $data_last = implode(" ", $data_im);}
									//else{$data_last = $trace_data[2];} 
									$ins_data[] = $trace_data[1]; $ins_data[] = $data_last;}
									else{$ins_data[] = $e;}
								}	
							
					}
		$data_row_new[] = $ins_data;
		}
		//print_r($data_row_new);
		
		/*
		define("DATABASE_LOCATION", "192.168.1.97");
		define("DATABASE_USERNAME", "webserver_admin");
		define("DATABASE_PASSWORD", "b4ckupw3b");
		define("DATABASE_NAME", "software");
		$conn = mysql_connect(DATABASE_LOCATION, DATABASE_USERNAME, DATABASE_PASSWORD) or die("not connected");
		mysql_select_db(DATABASE_NAME, $conn); */
//		"total_transaksi"=>$total_transaksi, "jumlah"=>$jumlah,
//								"komisi"=>$komisi,
		
		
		$insert_table_1 = array("retensi"=>$retensi, "frekuensi"=>$frekuensi,
								"laporan"=>$laporan, "tanggal"=>$tanggal,
								"cabang"=>$cabang, "jam"=>$jam,
								"kd_perusahaan"=>$kd_perusahaan, "halaman"=>$halaman,
								"check_sum_perusahaan"=>$check_sum_perusahaan);
		$insert_table_2 = array();
		
		foreach($data_row_new as $drn){
				$nomor_urut 		= isset($drn[0]) ? $drn[0] : '';
				$nomor_pengenal 	= isset($drn[1]) ? $drn[1] : '';
				$nama 				= isset($drn[2]) ? $drn[2] : '';
				$nilai_transaksi 	= isset($drn[3]) ? $drn[3] : '';
				$tgl	 			= isset($drn[4]) ? $drn[4] : '';
				$waktu 				= isset($drn[5]) ? $drn[5] : '';
				$lokasi 			= isset($drn[6]) ? $drn[6] : '';
				$berita_1 			= isset($drn[7]) ? $drn[7] : '';
				$plus 				= isset($drn[9]) ? $drn[9] : '';
				$berita_2 			= isset($drn[8]) ? $drn[8]." ".$plus : '';
				
				
				
				$insert_table_2[] = array("nomor_pengenal"=>$nomor_pengenal, "nama"=>$nama, "nilai_transaksi"=>$nilai_transaksi,
										  "tgl"=>$tgl, "waktu"=>$waktu, "lokasi"=>$lokasi, "berita_1"=>$berita_1, "berita_2"=>$berita_2);
			
		}
		
		//data cabang
		$sql_cabang	= mysql_query("SELECT `gx_cabang`.`kode_cabang`, `gx_cabang`.`kode_bm` FROM `gx_cabang`, `gx_pegawai`
			      WHERE `gx_cabang`.`id_cabang` = `gx_pegawai`.`id_cabang`
			      AND `gx_pegawai`.`id_employee` = '".$loggedin["id_employee"]."' LIMIT 0,1;", $conn);
		$row_cabang	= mysql_fetch_array($sql_cabang);
		
		$sql_last_data 	= mysql_fetch_array(mysql_query("SELECT COUNT(`id_bankmasuk`) as `total` FROM `gx_bank_masuk` WHERE `tgl_transaction` LIKE '%".$tanggal_cari."%';", $conn));
		
		
		$last_data  	= $sql_last_data["total"] + 1;
		
		//--print_r($insert_table_2);
		foreach($insert_table_2 as $ins_2){
			
			
			$nomor_pengenal = trim($ins_2['nomor_pengenal']);
			$nama = trim($ins_2['nama']);
			$nilai_transaksi = trim(str_replace(".", "", substr(trim($ins_2['nilai_transaksi']), 0, -3)));
			$tgl = trim($ins_2['tgl']);
			
			$arr_tgl = explode('/', $tgl);
			$tgl = trim($arr_tgl[2]).'/'.trim($arr_tgl[1]).'/'.trim($arr_tgl[0]);
			
			$waktu = trim($ins_2['waktu']);
			$lokasi = trim($ins_2['lokasi']);
			$berita_1 = trim($ins_2['berita_1']);
			$berita_2 = trim($ins_2['berita_2']);
			
			
			//data transaksi id bank masuk
			$tanggal    	= str_replace("/", "", $tgl);
			$transaction_id	= $row_cabang["kode_bm"].''.$tanggal.''.sprintf("%03d", $last_data);
			//echo $last_data."<br>";
	
			//data user
			$sql_user	= mysql_query("SELECT * FROM `tbCustomer`
					  WHERE `tbCustomer`.`cNoRekVirtual` = '".$nomor_pengenal."' LIMIT 0,1;", $conn);
			$row_user	= mysql_fetch_array($sql_user);
			
			
	//Data RBS jika ckode berisi nilai
	if($row_user["cKode"] != "")
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
			
			//--print_r($insert_table_1);
			$sql_insert_bank_masuk = "INSERT INTO `software`.`gx_bank_masuk` (`id_bankmasuk`, `transaction_id`, `tgl_transaction`,
									`nomer_va`, `bank_code`, `id_customer`, `nama`, `acc_credit`, `mu`, `rate`, `total`, `remarks`, `status`,
									`date_add`, `date_upd`, `user_upd`, `user_add`, `level`)
									VALUES (NULL, '".$transaction_id."', '".$insert_table_1['tanggal']."', 
									'".$nomor_pengenal."', 'BCA VA', '".$row_user["cKode"]."',  '".$row_user["cNama"]."',  '1121',  'IDR',  '1.0',
									'',  'upload txt',  '1',  
									NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
			//echo $sql_insert_bank_masuk."<br>";
			mysql_query($sql_insert_bank_masuk, $conn);
			
			$sql_lastdata_bm = mysql_query("SELECT `id_bankmasuk` FROM `gx_bank_masuk` WHERE `transaction_id` = '".$transaction_id."';", $conn);
			$row_lasdata_bm	 = mysql_fetch_array($sql_lastdata_bm);
			
			//insert bank masuk
			$sql_insert_bm_detail = "INSERT INTO `software`.`gx_bm_detail` (`id_bm_detail`, `id_bankmasuk`, `no_acc`,
			`kode_invoice`, `title`, `nominal`, `tgl_txn`, `waktu`, `lokasi`, `berita1`, `berita2`,
			`date_add`, `date_upd`, `user_upd`, `user_add`, `level`)
			VALUES ('', '".$row_lasdata_bm["id_bankmasuk"]."', '', '".$row_user["cKode"]."', 'BCA VA', '".$nilai_transaksi."',
			'".$tgl."', '".$waktu."', '".$lokasi."', '".$berita_1."', '".$berita_2."',
			NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
			//echo $sql_insert_bm_detail."<br>";
			mysql_query($sql_insert_bm_detail, $conn);
			
			$last_data++;
		}
		
echo "<script language='JavaScript'>
	    alert('Data telah di insert.');
	    window.location.href='master_bankmasuk.php';
	    </script>";
		
		}
}

?>