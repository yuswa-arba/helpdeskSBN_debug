<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration_user.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
 enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Menu Topup");   
    
    global $conn;
    include("../config/configuration_tv.php");
	$conn_tv   = DB_TV();
	
	
	$sql_voip = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$loggedin["cabang"]."' LIMIT 0,1;", $conn);
	$row_voip = mysql_fetch_array($sql_voip);
	
	include("../config/".$row_voip["voip_config"]);
	global $conn_voip;
	
	
    $message = '';
    
    $get_form = isset($_GET['form']) ? strip_tags(trim($_GET['form'])) : '';
    
//echo $loggedin["bank_saldo"];
if(isset($_POST["save_topup"]))
{
    $id_customer	= isset($_POST['id_customer']) ? strip_tags(trim($_POST['id_customer'])) : '';
    $date_topup		= date("Y-m-d H:i:s");
    $id_stb		= isset($_POST['id_stb']) ? strip_tags(trim($_POST['id_stb'])) : '0';
    $nominal		= isset($_POST['nominal']) ? strip_tags(trim($_POST['nominal'])) : '0';
    $id_topup		=	isset($_POST['id_topup']) ?strip_tags(trim($_POST['id_topup'])) : '0';
    
    if(($nominal != 0) AND ($nominal <= $loggedin["bank_saldo"]))
    {
	//update saldo (bank_saldo - nominal_topup)
	$sql_bank_saldo = "UPDATE `tbCustomer` SET `gx_saldo` = '".($loggedin["bank_saldo"]-$nominal)."' WHERE `cKode` = '".$loggedin["customer_number"]."';";
	mysql_query($sql_bank_saldo, $conn) or die ("Data saldo error");
	enableLog($loggedin["id_user"],$loggedin["username"], "", "$sql_bank_saldo");
	
	
	//Insert gx_tv_topup
	$sql_insert_topup = "INSERT INTO `gx_tv_topup` (`id_topup`, `id_user`, `id_stb`, `saldo`,
	    `method_payment`, `date_added`, `date_upd`, `level`, `user_add`, `user_upd`, `keterangan`)
	VALUES (NULL, '".$loggedin["customer_number"]."', '".$id_stb."', '".$nominal."', 'bank saldo', NOW(), NOW(),
	    '0', '".$loggedin["username"]."', '".$loggedin["username"]."', 'User Topup');";
	mysql_query($sql_insert_topup, $conn) or die ("Data topup error");
	enableLog($loggedin["id_user"], $loggedin["username"], "", "$sql_insert_topup");
	    
	$sql_insert_topup_boss = "INSERT INTO `boss`.`t_recharge` (`RECHARGEID`, `MONEY`, `RECHARGEDT`, `CLIENTID`)
	VALUES ('".$id_topup."', '".$nominal."', '".$date_topup."', '".$id_stb."');";
	mysqli_query($conn_tv, $sql_insert_topup_boss) or die ("Data topup error");
	enableLog($loggedin["id_user"], $loggedin["username"], "", "$sql_insert_topup_boss");
	
	//Update t_account_cms boss
	
	$sql_t_account_cms	= mysqli_query($conn_tv,"SELECT `boss`.`t_account_cms`.* FROM `boss`.`t_account_cms` WHERE `CLIENTID` = '".$id_stb."';");
	$row_t_account_cms	= mysqli_fetch_array($sql_t_account_cms);
	$total_Balance	= $row_t_account_cms["BALANCE"] + $nominal;
   
	$sql_update_balance = "UPDATE `boss`.`t_account_cms` SET `boss`.`t_account_cms`.`BALANCE` = '$total_Balance.00000'  WHERE `boss`.`t_account_cms`.`CLIENTID` = '$id_stb'";
	mysqli_query($conn_tv, $sql_update_balance) or die ("Data error");
	enableLog($loggedin["id_user"], $loggedin["username"], "", "$sql_update_balance");
	
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
}

	
	
	$sql_paket_tv = mysql_query("SELECT `gx_tv_customer`.* FROM `gx_tv_customer` WHERE `gx_tv_customer`.`id_customer` = '".$loggedin["customer_number"]."';", $conn);
	$row_paket_tv = mysql_fetch_array($sql_paket_tv);

	$sql_data_tv	= mysqli_query($conn_tv,"SELECT `boss`.`t_account_cms`.* FROM `boss`.`t_account_cms` WHERE `CLIENTID` = '".$row_paket_tv["id_stb"]."';");
	$row_data_tv	= mysqli_fetch_array($sql_data_tv);

	$sql_data_boss	= mysqli_query($conn_tv,"SELECT `boss`.`t_recharge`.* FROM `boss`.`t_recharge` WHERE `boss`.`t_recharge`.`RECHARGEID` LIKE 'TUP%' ;");
	$count_data_boss	= mysqli_num_rows($sql_data_boss);
	$count = $count_data_boss + 1;
	
	
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
						<a href="'.URL.'tv/topup.php?form=bank_saldo" class="small-box-footer">
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
						<a href="'.URL.'tv/history_topup.php" class="small-box-footer">
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
						<input type="hidden" name="id_topup" value="TUP'.sprintf("%05d", $count).'" readonly="" />
						<input type="text" name="id_customer" value="'.$loggedin["customer_number"].'" readonly="" />
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-5">
						<label for="type_topup">ID STB</label>
					    </div>
					    <div class="col-xs-7">
							<input type="text" name="id_stb" value="'.$row_data_tv["CLIENTID"].'" readonly="" />
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
		    
}

$content .='</section><!-- /.content -->';

$plugins = '';

    $title	= 'TV Topup';
    $submenu	= "tv_topup";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"yellow");
    
    echo $template;
}
    } else{
	header('location: '.URL.'logout.php');
    }

?>