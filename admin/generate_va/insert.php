<?php
if(isset($_POST["save"])){
	if ($_FILES["file"]["error"] > 0)
		{
		//echo "Error: " . $_FILES["file"]["error"] . "<br />";
		echo "<script language='JavaScript'>
			alert('Error: " . $_FILES["file"]["error"] ."');
			window.location.href='".$redirect_update_data."';
			</script>";
		}
		elseif ($_FILES["file"]["type"] !== "text/plain")
		{
			echo "<script language='JavaScript'>
			alert('File harus ekstensi .txt');
			window.location.href='".$redirect_update_data."';
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
											$retensi 		= substr($pecah_log_virtual[1], 0, -(strlen(" LAPORAN TRANSAKSI VIRTUAL ACCOUNT FREKWENSI")*2));
											$frekuensi 		= substr($pecah_log_virtual[2], 0, -(strlen(" LAPORAN")*2));
											$laporan 		= substr($pecah_log_virtual[3], 0, -(strlen(" TANGGAL")*2));
											$tanggal 		= substr($pecah_log_virtual[4], 0, -(strlen(" CABANG")*2));
											$cabang 		= substr($pecah_log_virtual[5], 0, -(strlen("  JAM")*2));
											$jam 			= substr($pecah_log_virtual[6], 0, -(strlen(" KD. PERUSAHAAN")*2));
											$kd_perusahaan 	= substr($pecah_log_virtual[7], 0, -(strlen(" HALAMAN")*2));
											$halaman 		= substr($pecah_log_virtual[8], 0, -(strlen(" ")*2));

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
											$total_transaksi 	= substr($pecah_transact_virtual[1], 0, -(strlen(" JUMLAH")*2));
											$jumlah 			= substr($pecah_transact_virtual[2], 0, -(strlen(" KOMISI")*2));
											$komisi				= substr($pecah_transact_virtual[3], 0, -(strlen(" ")*2));

											
											
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
											
											$data_num_tbl_1 = mysql_fetch_array(mysql_query("SELECT `id_table` FROM `va` ORDER BY `id_table` DESC LIMIT 1", $conn));
											$num_table_1 = $data_num_tbl_1['id_table']+1;
											
											$data_num_tbl_2 = mysql_fetch_assoc(mysql_query("SELECT `id_table` FROM `va_detail` ORDER BY `id_table` DESC LIMIT 1", $conn));
											
											$num_table_2 = $data_num_tbl_2['id_table']+1;
											$num = $num_table_2;
											
											$insert_table_1 = array("id_table"=>$num_table_1, "retensi"=>$retensi, "frekuensi"=>$frekuensi, "laporan"=>$laporan, "tanggal"=>$tanggal, "cabang"=>$cabang, "jam"=>$jam, "kd_perusahaan"=>$kd_perusahaan, "halaman"=>$halaman, "total_transaksi"=>$total_transaksi, "jumlah"=>$jumlah, "komisi"=>$komisi, "check_sum_perusahaan"=>$check_sum_perusahaan);
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
													
													
													
													$insert_table_2[] = array("id_table"=>$num, "id_foreign_key"=>$num_table_1, "nomor_urut"=>$nomor_urut, "nomor_pengenal"=>$nomor_pengenal, "nama"=>$nama, "nilai_transaksi"=>$nilai_transaksi, "tgl"=>$tgl, "waktu"=>$waktu, "lokasi"=>$lokasi, "berita_1"=>$berita_1, "berita_2"=>$berita_2);
											$num++;
											}

											

											//--print_r($insert_table_1);
											mysql_query("INSERT INTO `va`(`id`, `id_table`, `retensi`, `frekuensi`, `laporan`, `tanggal`, `cabang`, `jam`, `kd_perusahaan`, `halaman`, `total_transaksi`, `jumlah`, `komisi`, `check_sum_perusahaan`) VALUES ('','".$insert_table_1['id_table']."','".$insert_table_1['retensi']."','".$insert_table_1['frekuensi']."','".$insert_table_1['laporan']."','".$insert_table_1['tanggal']."','".$insert_table_1['cabang']."','".$insert_table_1['jam']."','".$insert_table_1['kd_perusahaan']."','".$insert_table_1['halaman']."','".$insert_table_1['total_transaksi']."','".$insert_table_1['jumlah']."','".$insert_table_1['komisi']."','".$insert_table_1['check_sum_perusahaan']."')", $conn);
											//--print_r($insert_table_2);
											foreach($insert_table_2 as $ins_2){
												$id_table = $ins_2['id_table'];
												$id_foreign_key = $ins_2['id_foreign_key'];
												$nomor_urut = $ins_2['nomor_urut'];
												$nomor_pegawai = $ins_2['nomor_pengenal'];
												$nama = $ins_2['nama'];
												$nilai_transaksi = $ins_2['nilai_transaksi'];
												$tgl = $ins_2['tgl'];
												$waktu = $ins_2['waktu'];
												$lokasi = $ins_2['lokasi'];
												$berita_1 = $ins_2['berita_1'];
												$berita_2 = $ins_2['berita_2'];
												mysql_query("INSERT INTO `va_detail`(`id`, `id_table`, `id_foreign_key`, `nomor_urut`, `nomor_pegawai`, `nama`, `nilai_transaksi`, `tgl`, `waktu`, `lokasi`, `berita_1`, `berita_2`) VALUES ('','".$id_table."','".$id_foreign_key."','".$nomor_urut."','".$nomor_pegawai."','".$nama."','".$nilai_transaksi."','".$tgl."','".$waktu."','".$lokasi."','".$berita_1."','".$berita_2."')", $conn);
											}
											/*
											foreach($input_data as $ins){
												$ins 
											}*/
											//print_r($input_data);
											/*
											$data_open = array();
											foreach($input_data as $val_i){
												$awal = $val_i[0];
												$array1 = explode(" ".$awal." ", $pecah_kategori[2]);
												
												$akhir = $val_i[1];
												$array2 = explode(" ".$akhir." ", $pecah_kategori[2]);
												$data_open[] = $array1;
											}
											print_r($data_open);
											*/
											//print_r(array_unique($search_data_num));
											//$d = array_unique($search_data_num);
											//echo 'datanya :'.$d[46];
											//if($d[46]==0){ /*echo 'data benar2 kosong';*/}
											//echo $pecah_kategori[2];
											/*
											foreach($ins_data as $fi){
												$out .= gettype($fi) ."<br/>";
											}
											*/
											//echo $out;
											//echo strlen(" LAPORAN TRANSAKSI VIRTUAL ACCOUNT FREKWENSI");
echo "<script language='JavaScript'>
	    alert('Data telah di insert.');
	    window.location.href='".$redirect_update_data."';
	    </script>";
			
		}
}

?>