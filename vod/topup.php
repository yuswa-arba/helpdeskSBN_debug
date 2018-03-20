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
 enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Menu Topup");   
    
    global $conn;
    global $conn_voip;
    $message = '';
    
    $get_form = isset($_GET['form']) ? strip_tags(trim($_GET['form'])) : '';
    
    //echo $loggedin["bank_saldo"];
if(isset($_POST["save_topup"]))
{
    $id_customer	= isset($_POST['id_customer']) ? strip_tags(trim($_POST['id_customer'])) : '';
    $date_topup		= date("Y-m-d H:i:s");
    $id_voip		= isset($_POST['id_voip']) ? strip_tags(trim($_POST['id_voip'])) : '0';
    $nominal		= isset($_POST['nominal']) ? strip_tags(trim($_POST['nominal'])) : '0';
    
    
    if(($nominal != 0) AND ($nominal <= $loggedin["bank_saldo"]))
    {
	//update saldo (bank_saldo - nominal_topup)
	$sql_bank_saldo = "UPDATE `tbCustomer` SET `gx_saldo` = '".($loggedin["bank_saldo"]-$nominal)."' WHERE `cKode` = '".$loggedin["customer_number"]."';";
	mysql_query($sql_bank_saldo, $conn) or die ("Data saldo error");
	enableLog($loggedin["id_user"],$loggedin["username"], "", "$sql_bank_saldo");
	
	//Insert gx_voip_topup
	$sql_insert_topup = "INSERT INTO `gx_voip_topup` (`id_topup`, `id_user`, `id_voip`, `saldo`,
	    `method_payment`, `date_added`, `date_upd`, `level`, `user_add`, `user_upd`, `keterangan`)
	VALUES (NULL, '".$loggedin["customer_number"]."', '".$id_voip."', '".$nominal."', 'bank saldo', NOW(), NOW(),
	    '0', '".$loggedin["username"]."', '".$loggedin["username"]."', 'User Topup');";
	mysql_query($sql_insert_topup, $conn) or die ("Data topup error");
	enableLog($loggedin["id_user"], $loggedin["username"], "", "$sql_insert_topup");
	//Insert to table refill mya2billing
	    
	
	//Update cc_card mya2billing
	$sql_card	= mysql_query("SELECT `credit` FROM `cc_card` WHERE `useralias` = '".$id_voip."' LIMIT 0,1;");
	$row_card	= mysql_fetch_array($sql_card);
	$total_credit	= $row_card["credit"] + $nominal;
   
	$sql_update_card = "UPDATE `cc_card` SET `credit` = '$total_credit.00000'  WHERE `cc_card`.`useralias` = '$id_voip'";
	mysql_query($sql_update_card, $conn_voip) or die ("Data error");
	enableLog($loggedin["id_user"], $loggedin["username"], "", "$sql_update_card");
	
	//Send Notifikasi
	
	
	$message = '<div class="alert alert-info alert-dismissable">
		     <i class="fa fa-info"></i>
		     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		     <b>Info!</b> Data sudah diupdate.
		 </div>';
    }else{
    
    $message = '<div class="alert alert-info alert-dismissable">
		 <i class="fa fa-info"></i>
		 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		 <b>Info!</b> Nominal topup yang anda inputkan kurang atau melebihi nominal bank saldo.
	     </div>';
    }
    
}elseif(isset($_POST["save_voucher"]))
{
    
    $voucher	= isset($_POST['voucher']) ? mysql_real_escape_string(strip_tags(trim($_POST['voucher']))) : "";
    $username	= isset($_POST['username']) ? mysql_real_escape_string(strip_tags(trim($_POST['username']))) : "";
	
    $sql_vouchers = "SELECT * FROM  `cc_voucher` WHERE `voucher` = '$voucher' ";
    $sql_voucher  = mysql_query($sql_vouchers);
    $row_voucher  = mysql_fetch_array($sql_voucher);
    $dvoucher	  = $row_voucher["voucher"];
    $used	  = $row_voucher["usedcardnumber"];
    $credit	  = $row_voucher["credit"];
    $expired	  = $row_voucher["expirationdate"];
    
    $sql_cards	  = "SELECT * FROM `cc_card` WHERE `username` = '$username'";
    $sql_card	  = mysql_query($sql_cards);
    $row_card	  = mysql_fetch_array($sql_card);
    $total_credit = $row_card["credit"] + $credit ;
   
    if($voucher == $dvoucher){
	 if($used == ""){
	    if($expired < date("Y-m-d h:i:s")){
		$message = '<div class="alert alert-info alert-dismissable">
			    <i class="fa fa-info"></i>
			    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			    <b>Info!</b> Maaf, Voucher yang anda masukkan sudah tidak aktif.
			</div>';
	    }else{
		$query = "UPDATE `cc_voucher` SET `usedcardnumber` = '$username',`activated` = 'f',
							`usedate` = NOW()
							WHERE `voucher` = $voucher;";
		//echo $query;
		$query2 = "UPDATE `cc_card` SET `credit` = '$total_credit.00000'  WHERE `cc_card`.`username` = '$username'";
	    
		mysql_query($query2) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
		    </script>");
		mysql_query($query) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
		    </script>");
		enableLog($loggedin["id_user"], $loggedin["username"], "", "$query, $query2");
		$message = '<div class="alert alert-info alert-dismissable">
			    <i class="fa fa-info"></i>
			    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			    <b>Info!</b>Voucher dengan kode <b>'.$voucher.' ('.$credit.')</b> sudah ditambahkan ke akun anda.
			</div>';
	    }
	 }else{
	    $message = '<div class="alert alert-info alert-dismissable">
			    <i class="fa fa-info"></i>
			    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			    <b>Info!</b>Maaf, Voucher yang anda masukkan sudah digunakan.
			</div>';
	 }
    }else{
	mysql_query($query) or die("<script language='JavaScript'>
			alert('Maaf, Voucher yang anda masukkan salah!');
			window.history.go(-1);
            </script>");
    }
}

    $content ='<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Topup</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <div class="box-body">
				    <div class="row">
					<div class="col-lg-3 col-xs-6">
					    <!-- small box -->
					    <div class="small-box bg-aqua">
						<div class="inner">
						    <h4>
							From Bank Saldo
						    </h4>
						    <p>
							<br>&nbsp;
						    </p>
						</div>
						<div class="icon">
						    <i class="fa fa-credit-card"></i>
						</div>
						<a href="'.URL.'voip/topup.php?form=bank_saldo" class="small-box-footer">
						    Topup <i class="fa fa-arrow-circle-right"></i>
						</a>
					    </div>
					</div><!-- ./col -->
					<div class="col-lg-3 col-xs-6">
					    <!-- small box -->
					    <div class="small-box bg-yellow">
						<div class="inner">
						    <h4>
							Gift Card
						    </h4>
						    <p>
							<br>&nbsp;
						    </p>
						</div>
						<div class="icon">
						    <i class="fa fa-credit-card"></i>
						</div>
						<a href="'.URL.'voip/topup.php?form=giftcard" class="small-box-footer">
						    Topup <i class="fa fa-arrow-circle-right"></i>
						</a>
					    </div>
					</div><!-- ./col -->
					<div class="col-lg-3 col-xs-6">
					    <!-- small box -->
					    <div class="small-box bg-green">
						<div class="inner">
						    <h4>
							History Topup
						    </h4>
						    <p>
							<br>&nbsp;
						    </p>
						</div>
						<div class="icon">
						    <i class="fa fa-credit-card"></i>
						</div>
						<a href="'.URL.'voip/history_topup.php" class="small-box-footer">
						    History Topup <i class="fa fa-arrow-circle-right"></i>
						</a>
					    </div>
					</div><!-- ./col -->
				    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>';
		    
if($get_form == "bank_saldo"){
    
    $content .='<div class="row">
			<div class="col-lg-7 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Topup
				    </h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <div class="box-body">
				'.$message.'
				    <form role="form" method="POST" action="">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-5">
						<label for="type_topup">ID Customer</label>
					    </div>
					    <div class="col-xs-7">
						<input type="text" name="id_customer" value="'.$loggedin["customer_number"].'" readonly="" />
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-5">
						<label for="type_topup">VOIP Number</label>
					    </div>
					    <div class="col-xs-7">
						<select class="form-control" name="id_voip">
						    <option value="'.$loggedin["id_voip"].'">'.$loggedin["id_voip"].'</option>
						</select>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-5">
						<label for="type_topup">Tanggal</label>
					    </div>
					    <div class="col-xs-7">
						<input type="text" name="date_topup" value="'.date("d-m-Y").'" readonly="" />
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-5">
						<label for="type_topup">Nominal</label>
					    </div>
					    <div class="col-xs-7">
						<input type="text" name="nominal" value="" required=""/>
					    </div>
                                        </div>
					</div>
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-5">
						&nbsp;
                                            </div>
					    <div class="col-xs-7">
						<button type="submit" name="save_topup" class="btn btn-primary">Submit</button>
					    </div>
                                        </div>
				    </div>
				    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
		    </div>';
		    
}elseif($get_form == "giftcard"){
    
    $customer = $loggedin["id_voip"];

    $sql_cust = mysql_query("SELECT * FROM  `cc_card` WHERE `useralias` = '$customer'", $conn_voip);
    $row_cust = mysql_fetch_array($sql_cust);

    $view_username = $row_cust["username"];
    
    $content .='<div class="row">
			<div class="col-lg-7 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Gift Card
				    </h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <div class="box-body">
				'.$message.'
				    <form role="form" method="POST" action="">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-5">
						<label for="type_topup">Kode Gift Card</label>
					    </div>
					    <div class="col-xs-7">
						<input type="text" name="voucher" value="" >
						<input type="hidden" name="username" value="'.$view_username.'" >
					    </div>
                                        </div>
					</div>
					
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						&nbsp;
                                            </div>
					    <div class="col-xs-4">
						<button type="submit" name="save_voucher" class="btn btn-primary">Redeem</button>
					    </div>
					    <div class="col-xs-4">
						&nbsp;
					    </div>
                                        </div>
				    </div>
				    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
		    </div>';
}

$content .='</section><!-- /.content -->';

$plugins = '';

    $title	= 'VOIP Topup';
    $submenu	= "voip_topup";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"red");
    
    echo $template;
}
    } else{
	header('location: '.URL.'logout.php');
    }

?>