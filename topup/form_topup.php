<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
    
    
    global $conn;
	
	$content ='<!-- Main content -->
                <section class="content">';
				
if(isset($_POST["submit"]))
{
	$customer_number_topup	= isset($_POST['customer_number']) ? mysql_real_escape_string(trim($_POST['customer_number'])) : '';
    $userid_topup			= isset($_POST['userid']) ? mysql_real_escape_string(trim($_POST['userid'])) : '';
    $nama_topup				= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $alamat_topup		 	= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    $nominal_topup		 	= isset($_POST['nominal']) ? mysql_real_escape_string(trim($_POST['nominal'])) : '';
	$tipe_topup				= isset($_POST['topup_type']) ? mysql_real_escape_string(trim($_POST['topup_type'])) : '';
    $payment_method_topup	= isset($_POST['payment_method']) ? mysql_real_escape_string(trim($_POST['payment_method'])) : '';
    $expdate_topup			= date("Y-m-d H:i:s", strtotime("+3 Hours"));
	
	if($customer_number_topup != "" AND $nominal_topup != "")
	{
	
	$sql_invoice  = mysql_fetch_array(mysql_query("SELECT `id_invoice` FROM `gx_invoice` ORDER BY `id_invoice` DESC", $conn));
	$last_data  = $sql_invoice["id_invoice"] + 1;
	$kode_invoice = date("Ymd").sprintf("%04d", $last_data);
   
	$nominal_topup = ($nominal_topup != "" ) ? $nominal_topup + rand(111,999) : "";
	
	$sql_insert_topup = "INSERT INTO `gx_topup_pulsa` (`id_topup`, `customer_number_topup`, `userid_topup`, `nama_topup`, `alamat_topup`, `expdate_topup`,
											 `nominal_topup`, `tipe_topup`, `payment_method_topup`, `date_add`, `user_add`)
	VALUES ('', '".$customer_number_topup."', '".$userid_topup."', '".$nama_topup."', '".$alamat_topup."', '".$expdate_topup."', '".$nominal_topup."',
	'".$tipe_topup."', '".$payment_method_topup."', NOW(), '".$loggedin["username"]."');";
    
    //echo $sql_insert."<br>";

    mysql_query($sql_insert_topup, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
	
	$sql_insert = "INSERT INTO `gx_invoice`(`id_invoice`, `kode_invoice`, `title`, `customer_number`,`nama_customer`,
     					    `npwp`, `no_faktur_pajak`, `note`, `periode_tagihan`,`tanggal_tagihan`, `tanggal_jatuh_tempo`,
					    `no_virtual_account_bca`, `nama_virtual`, `prepared_by`, `date_add`, `date_upd`,
					    `user_add`, `user_upd`, `level`)
				    VALUES ('', '".$kode_invoice."', 'TOPUP PULSA', '".$customer_number_topup."', '".$nama_topup."',
					    '', '', 'Topup Pulsa ".$tipe_topup."', '', NOW(), '',
					    '', '', '', NOW(), NOW(),
					    '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    
    //echo $sql_insert."<br>";

    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
	$sql_insert_detail = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`, `date`,
						    `harga`, `desc`, `date_add`,
						    `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES ('', '".$kode_invoice."', NOW(),
						    '".$nominal_topup."', 'topup pulsa ".$tipe_topup."', NOW(),
						    NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    //echo $sql_insert;
    echo mysql_query($sql_insert_detail, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
	
	//send_email_notif();
	
		$message = '<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Topup</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <div class="box-body">
									<div class="alert alert-success alert-dismissible">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<h4><i class="icon fa fa-check"></i> Topup Pulsa </h4>
										Jumlah yang harus anda bayar adalah <b>Rp. '.number_format($nominal_topup, 0, '','.').'</b><br>
										Silahkan melakukan pembayaran sesuai dengan metode pembayaran yg dipilih.<br><br>
										
										Batas waktu anda melakukan pembayaran 3 jam dari sekarang ('.$expdate_topup.').<br><br>
										Note: Apabila transfer tidak sesuai dengan nominal diatas / melebihi batas, silahkan hubungi customer service kami.<br><br>
										
										
										Terima kasih.<br><br><br><br>
										Globalxtreme									
										
										
										
									</div>
				    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>';
					
		email_topup_pulsa($email_customer,$last_data);
	}
	else
	{
		$message = '<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Topup</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <div class="box-body">
									<div class="alert alert-danger alert-dismissible">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<h4><i class="icon fa fa-ban"></i> Alert!</h4>
										Data tidak bisa diproses ada kesalahan, silahkan hubungi customer service kami..<br><br>
										Terima kasih.<br><br><br><br>
										GlobalXtreme
									</div>
				    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>';
	}
	
	$content .= $message;
	
}
else
{
	
    $content .='
                    <div class="row">
                        <div class="col-md-8 col-xs-12">
						
						<form role="form" method="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Topup</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                        <div class="form-group">
											<div class="row">
												<div class="col-md-6 col-xs-12">
													<label>Customer Number</label>
													<input name="customer_number" id="customer_number" type="text" class="form-control" placeholder="Customer Number" required value="'.$loggedin["customer_number"].'">
												</div>
												<div class="col-md-6 col-xs-12">
													<label>UserID</label>
													<input name="userid" id="userid" type="text" class="form-control" placeholder="Customer Number" required value="'.$loggedin["userid"].'">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-8 col-xs-12">
													<label>Nama</label>
													<input name="nama" id="nama" type="text" class="form-control" placeholder="Name" required value="'.$loggedin["username"].'">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-8 col-xs-12">
													<label>Nama</label>
													<input name="email" id="email" type="text" class="form-control" placeholder="Name" required value="'.$loggedin["email"].'">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-8 col-xs-12">
													<label>Address</label>
													<textarea name="address" id="address" class="form-control" rows="4" style="resize: none;">'.$loggedin["alamat"].'</textarea>
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-xs-12">
													<label>Nominal</label>
													<select class="form-control" name="nominal">
														<option value="100000">Rp 100.000</option>
														<option value="200000">Rp 200.000</option>
														<option value="300000">Rp 300.000</option>
														<option value="500000">Rp 500.000</option>
														<option value="1000000">Rp 1.000.000</option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-xs-12">
													<label>Topup for</label>
													<select class="form-control" name="topup_type">
														<option value="voip">VOIP (Phone)</option>
														<option value="tv">TV ()</option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-xs-12">
													<label>Payment Method</label>
													<select class="form-control" name="payment_method">
														<option value="cc">Credit Card</option>
														<option value="va">Virtual Account</option>
														<option value="atm_bca">Transfer BCA</option>
														<option value="atm_mandiri">Transfer Mandiri</option>
													</select>
												</div>
											</div>
										</div>
										
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                
                            </div><!-- /.box -->
							</form>
                        </div>
                    </div>';

                
}

$content .= '</section><!-- /.content -->';
				
$plugins = '';

    $title	= 'Form Topup Pulsa';
    $submenu	= "topup";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ../logout.php");
    }

?>