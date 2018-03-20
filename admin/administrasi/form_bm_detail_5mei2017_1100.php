<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration_admin.php");
include ("../../config/configuration_tv.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
		//koneksi RBS
		$conn_soft = Config::getInstanceSoft();
		//koneksi tv
		$conn_ott   = DB_TV();
		
function topup_voip()
{
	
	include ("../../config/configuration_admin.php");
	global $conn_voip;
	
	//insert into cc_subscription_service
    $sql_insert = "INSERT INTO `mya2billing`.`cc_logrefill` (`id`, `date`, `credit`, `card_id`, `description`,
    `refill_type`, `added_invoice`, `agent_id`)
    VALUES (NULL, '".$date."', '".$credit."', '".$id_cc_card."', '".$description."', '".$refill_type."', '".$added_invoice."', NULL);";
    
    $sql_insert_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
    `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
    VALUES (NULL, '1', '2', 'NEW REFILL CREATED', 'User added a new record in database',
    'date =  ".$date."| credit =  ".$credit."| description =  ".$description."| card_id =  ".$id_cc_card."| refill_type =  ".$refill_type."|  added_invoice =  ".$added_invoice."| Web Software GX (".$loggedin["username"].")',
    'cc_logrefill', 'form_refill.php', '".getenv("REMOTE_ADDR")."', NOW(), '0');";
    //echo $insert."<br>";

    mysql_query($sql_insert, $conn_voip) or die (mysql_error());
    mysql_query($sql_insert_log, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    if($added_invoice == 1)
    {
	$sql_invoice = mysql_query("SELECT COUNT(*) as `total` FROM `cc_invoice` WHERE `date` LIKE '%".date("Y")."-%';", $conn_voip);
	$row_invoice = mysql_fetch_array($sql_invoice);
	
	$total = $row_invoice["total"] + 1;
	$reference = date("Ymd").sprintf("%06d", $total);

	//insert into cc_invoice
	$sql_insert_invoice = "INSERT INTO `mya2billing`.`cc_invoice` (`id`, `reference`, `id_card`, `date`, `paid_status`,
	`status`, `title`, `description`)
	VALUES (NULL, '".$reference."', '".$id_cc_card."', '".$date."', '0', '0', 'REFILL', 'Invoice for refill');";
	
	$sql_insert_log_invoice = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
	`data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
	VALUES (NULL, '1', '2', 'NEW INVOICE CREATED', 'User added a new record in database',
	'reference =  ".$reference."| id_card =  ".$id_cc_card."| date =  ".$date."| paid_status =  0| status =  0|  title =  REFILL| description = Invoice for refill| Web Software GX (".$loggedin["username"].")',
	'cc_invoice', 'form_refill.php', '".getenv("REMOTE_ADDR")."', NOW(), '0');";
	//echo $insert."<br>";
    
	mysql_query($sql_insert_invoice, $conn_voip) or die (mysql_error());
	mysql_query($sql_insert_log_invoice, $conn_voip) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_log_invoice);
	
	//insert invoice item
	$sql_invoice_last = mysql_query("SELECT * FROM `cc_invoice` WHERE `reference` LIKE '%".$reference."%';", $conn_voip);
	$row_invoice_last = mysql_fetch_array($sql_invoice_last);
	
	$id_invoice_last = $row_invoice_last["id"];

	//insert into cc_invoice_item
	$sql_insert_invoice_item = "INSERT INTO `mya2billing`.`cc_invoice_item` (`id`, `id_invoice`, `date`,
	`price`, `VAT`, `description`, `id_ext`, `type_ext`)
	VALUES (NULL, '".$id_invoice_last."', '".$date."', '".$credit."', '0', 'Refill', NULL, NULL);";
	
	$sql_insert_log_invoice_item = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
	`data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
	VALUES (NULL, '1', '2', 'NEW INVOICE CREATED', 'User added a new record in database',
	'id_invoice =  ".$id_invoice_last."| price =  ".$credit."| date =  ".$date."| vat =  0| description =  Refill| Web Software GX (".$loggedin["username"].")',
	'cc_invoice_item', 'form_refill.php', '".getenv("REMOTE_ADDR")."', NOW(), '0');";
	//echo $insert."<br>";
    
	mysql_query($sql_insert_invoice_item, $conn_voip) or die (mysql_error());
	mysql_query($sql_insert_log_invoice_item, $conn_voip) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_log_invoice_item);
    }
    
    //add customer credit
    //Update cc_card mya2billing
	$sql_card	= mysql_query("SELECT `credit`, `id` FROM `cc_card` WHERE `id` = '".$id_cc_card."' LIMIT 0,1;",$conn_voip);
	$row_card	= mysql_fetch_array($sql_card);
	$total_credit	= $row_card["credit"] + $credit;
	
	$sql_update_card = "UPDATE `cc_card` SET `credit` = '".$total_credit."'  WHERE `cc_card`.`id` = '".$id_cc_card."'";
	mysql_query($sql_update_card, $conn_voip) or die ("Data error");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "$sql_update_card");
	
	
	$sql_update_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`,
	`description`, `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
	VALUES (NULL, '1', '3', 'A CREDIT UPDATED', 'A RECORD IS UPDATED, EDITION CALUSE USED IS  id=".$id_cc_card." ',
	'id = ".$id_cc_card." |credit=".$credit." |Web Software GX (".$loggedin["username"].")',
	'cc_card', 'form_refill.php',
	'".getenv("REMOTE_ADDR")."', NOW(), '0');";
    mysql_query($sql_update_log, $conn_voip) or die ("Data error");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "$sql_update_log");
}
		
		
//save ke database gx_bankmasuk    
if(isset($_POST["save"]))
{
    $kode_bm		= isset($_POST['kode_bm']) ? mysql_real_escape_string(trim($_POST['kode_bm'])) : '';
    $acc_bm		= isset($_POST['acc_bm']) ? mysql_real_escape_string(trim($_POST['acc_bm'])) : '';
    $nominal		= isset($_POST['nominal']) ? str_replace(",", "", $_POST['nominal']) : '';
    $kode_invoice	= isset($_POST['kode_invoice']) ? mysql_real_escape_string(trim($_POST['kode_invoice'])) : '';
    $title_invoice	= isset($_POST['title_invoice']) ? mysql_real_escape_string(trim($_POST['title_invoice'])) : '';
    $return_url		= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($kode_bm != ""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_bm_detail` (`id_bm_detail`, `id_bankmasuk`, `no_acc`,
    `kode_invoice`, `title`, `nominal`, `date_add`, `date_upd`, `user_upd`, `user_add`, `level`)
    VALUES (NULL, '".$kode_bm."', '".$acc_bm."', '".$kode_invoice."', '".$title_invoice."', '".$nominal."',
    NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    //echo $sql_insert;
	mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."administrasi/".$return_url."';
	</script>";
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
}
elseif(isset($_POST["update"]))
{
    $id       		= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    $kode_bm		= isset($_POST['kode_bm']) ? mysql_real_escape_string(trim($_POST['kode_bm'])) : '';
    $acc_bm		= isset($_POST['acc_bm']) ? mysql_real_escape_string(trim($_POST['acc_bm'])) : '';
    $nominal		= isset($_POST['nominal']) ? str_replace(",", "", $_POST['nominal']) : '';
    $kode_invoice	= isset($_POST['kode_invoice']) ? mysql_real_escape_string(trim($_POST['kode_invoice'])) : '';
    $title_invoice	= isset($_POST['title_invoice']) ? mysql_real_escape_string(trim($_POST['title_invoice'])) : '';
    $return_url		= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($id != "" AND $kode_bm != ""){
    
    //Update into cc_subscription_service
    $sql_update = "UPDATE `gx_bm_detail` SET `id_bankmasuk`='".$kode_bm."', `no_acc`='".$acc_bm."', 
    `kode_invoice`='".$kode_invoice."',  `title`='".$title_invoice."',  `nominal`='".$nominal."', 
    `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE (`id_bm_detail`='".$id."');";
    

    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);

   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".$return_url."';
	</script>";
	
    }else{
	
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
}

if(isset($_POST["posting"]))
{
	$id_customer		= isset($_POST['id_customer']) ? mysql_real_escape_string(trim($_POST['id_customer'])) : '';
    $transaction_id		= isset($_POST['transaction_id']) ? mysql_real_escape_string(trim($_POST['transaction_id'])) : '';
    
	if($id_customer != "" AND $transaction_id != "")
	{
	//detail_bankmasuk
	$query_bm	= "SELECT `gx_bm_detail`.* FROM `gx_bank_masuk`, `gx_bm_detail`
	WHERE `gx_bank_masuk`.`id_bankmasuk` = `gx_bm_detail`.`id_bankmasuk`
	AND `gx_bank_masuk`.`transaction_id` ='".$transaction_id."' AND  `gx_bank_masuk`.`level` ='0';";
    $sql_bm		= mysql_query($query_bm, $conn);
	
	//detail user
	$query_user	= "SELECT `iuserIndex`, `cUserID`, `gx_saldo` FROM `tbCustomer` WHERE `cKode` ='".$id_customer."';";
    $sql_user	= mysql_query($query_user, $conn);
	$row_user	= mysql_fetch_array($sql_user);
	
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
	
	while($row_bm = mysql_fetch_array($sql_bm))
	{
		$nominal = $row_bm["nominal"];
		if($nominal > 0)
		{
		
		//topup saldo RBS
			$sql = "SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
			INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
			VALUES ('".$BillingTransactionIndex."', '".date("Y-m-d H:i:s.000")."', '1', '".$row_user["iuserIndex"]."', '2', '".$PaymentNumber."', '". $nominal."');
			SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF";
			$q = $conn_soft->prepare($sql);
			$q->execute();
			
			
			$UserPaymentBalance_update = $UserPaymentBalance + ($nominal);
			
			$sql_rbs_user_detail = "
			INSERT INTO [dbo].[Payments] ([PaymentNumber], [PaymentMethod], [CreateDate], [UserType], [UserIndex], [Amount], [Remark])
			VALUES ('".$PaymentNumber."', '3', '".date("Y-m-d H:i:s.000")."', '1', '".$row_user["iuserIndex"]."', '". $nominal."', 'Bayar No ".$transaction_id."    ".$row_invoice["kode_invoice"]."  ');
			
			UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='".$UserPaymentBalance_update."'
			WHERE ([UserID]='".trim($row_user["cUserID"])."');
			
			";
			$query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);
			
			$query_rbs_user_detail->execute();
			//END RBS
			
			//saldo uang muka + RBS
			if($row_bm["no_acc"] == "215")
			{
				//topup to dompet GX
				$query_data = "SELECT * FROM `tbCustomer` WHERE `tbCustomer`.`cKode`='".$id_customer."' LIMIT 0,1;";
				$sql_data	= mysql_query($query_data,$conn);
				$row_data	= mysql_fetch_array($sql_data);
				$total_balance	= $row_data["gx_saldo"] + $nominal;
				
				//insert into gx_saldo
				$sql_update_data = "UPDATE `tbCustomer` SET `gx_saldo`='".$total_balance."'
				WHERE (`cKode`='".$id_customer."');";
				
				mysql_query($sql_update_data,$conn) or die (mysql_error());
				//log
				enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_data);
				
								
				
			}
		
			//Dompet Telpon
			if($row_bm["no_acc"] == "1132")
			{
				//topup to dompet GX
				$query_data = "SELECT * FROM `tbCustomer` WHERE `tbCustomer`.`cKode`='".$id_customer."' LIMIT 0,1;";
				$sql_data	= mysql_query($query_data,$conn);
				$row_data	= mysql_fetch_array($sql_data);
				$total_balance	= $row_data["gx_saldo"] + $nominal;
				
				//insert into gx_saldo
				$sql_update_data = "UPDATE `tbCustomer` SET `gx_saldo`='".$total_balance."'
				WHERE (`cKode`='".$id_customer."');";
				
				mysql_query($sql_update_data,$conn) or die (mysql_error());
				//log
				enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_data);
				
			}
			
			//Dompet Telpon
			if($row_bm["no_acc"] == "491")
			{
				//topup to a2billing
				
				
				
			}
			
			//Dompet TV
			if($row_bm["no_acc"] == "492")
			{
				//topup to tv
				//select user
				$query_data = "SELECT `BALANCE`, `CLIENTID` FROM `boss`.`t_account_cms` WHERE `boss`.`t_account_cms`.`CLIENTNAME`='".$row_user["cUserID"]."' LIMIT 0,1;";
				$sql_data	= mysqli_query($conn_ott,$query_data);
				$row_data	= mysqli_fetch_array($sql_data);
				$total_balance	= $row_data["BALANCE"] + $nominal;
				
				$sql_data_boss	= mysqli_query($conn_ott,"SELECT * FROM `boss`.`t_recharge`;");
				$count_data_boss	= mysqli_num_rows($sql_data_boss);
				$count = $count_data_boss + 1;
				
				$RECHARGEID =  "TUTV".sprintf("%05d", $count);
			
				//insert into gx_data
				$sql_insert_data = "INSERT INTO `boss`.`t_recharge` (`RECHARGEID`, `MONEY`, `RECHARGEDT`, `CLIENTID`)
				VALUES ('".$RECHARGEID."', '".$nominal."', NOW(), '".$row_data["CLIENTID"]."');";
				
				mysqli_query($conn_ott ,$sql_insert_data) or die (mysqli_error());
				//log
				enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_data);
				
				
				//insert into gx_data
				$sql_update_data = "UPDATE `boss`.`t_account_cms` SET `BALANCE`='".$total_balance."'
				WHERE (`CLIENTID`='".$row_data["CLIENTID"]."');";
				
				mysqli_query($conn_ott ,$sql_update_data) or die (mysqli_error());
				//log
				enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_data);
				
			}
			
			
			
			//detail_bankmasuk
			$query_invoice	= "SELECT * FROM `gx_invoice_detail` WHERE `kode_invoice` ='".$row_bm["kode_invoice"]."' AND `level` ='0';";
			$sql_invoice	= mysql_query($query_invoice, $conn);
			//echo $query_invoice;
			$nominal_update = 0;
			
			while($row_invoice = mysql_fetch_array($sql_invoice))
			{
				//RBS
				if($row_invoice["desc"] == "INTERNET")
				{
					if($nominal >=  $row_invoice["harga"]) 
					{
						//posting ke database RBS sesuai bankmasuk_detail
						//echo "rbs + voip";
						//INPUT RBS
						$sql = "SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
						INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
						VALUES ('".$BillingTransactionIndex."', '".date("Y-m-d H:i:s.000")."', '1', '".$row_user["iuserIndex"]."', '2', '".$PaymentNumber."', '". $row_invoice["harga"]."');
						SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF";
						$q = $conn_soft->prepare($sql);
						$q->execute();
						
						
						$UserPaymentBalance_update = $UserPaymentBalance + $row_invoice["harga"];
						
						$sql_rbs_user_detail = "
						INSERT INTO [dbo].[Payments] ([PaymentNumber], [PaymentMethod], [CreateDate], [UserType], [UserIndex], [Amount], [Remark])
						VALUES ('".$PaymentNumber."', '3', '".date("Y-m-d H:i:s.000")."', '1', '".$row_user["iuserIndex"]."', '". $row_invoice["harga"]."', 'Bayar No ".$transaction_id."    ".$row_invoice["kode_invoice"]."  ');
						
						UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='".$UserPaymentBalance_update."'
						WHERE ([UserIndex]='".$row_user["iuserIndex"]."');
						
						";
						$query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);
						
						$query_rbs_user_detail->execute();
						//END RBS
						
						$nominal_update = $nominal - $row_invoice["harga"];
						
						$sql_invoice_lock = "UPDATE `gx_invoice` SET `paid_status`='1', `status` = '1', `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
						WHERE (`kode_invoice`='".$row_invoice["kode_invoice"]."');";
						mysql_query($sql_invoice_lock, $conn) or die (mysql_error());
					}
					elseif($nominal <  $row_invoice["harga"])
					{
						//posting ke database RBS sesuai bankmasuk_detail
						//echo "rbs aja";
						//INPUT RBS
						$sql = "SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
						INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
						VALUES ('".$BillingTransactionIndex."', '".date("Y-m-d H:i:s.000")."', '1', '".$row_user["iuserIndex"]."', '2', '".$PaymentNumber."', '". $nominal."');
						SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF";
						$q = $conn_soft->prepare($sql);
						$q->execute();
						
						
						$UserPaymentBalance_update = $UserPaymentBalance + $nominal;
						
						$sql_rbs_user_detail = "
						INSERT INTO [dbo].[Payments] ([PaymentNumber], [PaymentMethod], [CreateDate], [UserType], [UserIndex], [Amount], [Remark])
						VALUES ('".$PaymentNumber."', '3', '".date("Y-m-d H:i:s.000")."', '1', '".$row_user["iuserIndex"]."', '".$nominal."', 'Bayar No ".$transaction_id."    ".$row_invoice["kode_invoice"]."  ');
						
						UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='".$UserPaymentBalance_update."'
						WHERE ([UserIndex]='".$row_user["iuserIndex"]."');
						
						
						";
						$query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);
						
						$query_rbs_user_detail->execute();
						//END RBS
						
						$sql_invoice_lock = "UPDATE `gx_invoice` SET `paid_status`='2', `status` = '1', `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
						WHERE (`kode_invoice`='".$row_invoice["kode_invoice"]."');";
						mysql_query($sql_invoice_lock, $conn) or die (mysql_error());
					}
					
				}
				
				//ABONEMEN VOIP
				if($row_invoice["desc"] == "VOIP" )
				{
					if($row_invoice["harga"] != "0")
					{
						//insert into cc_subscription_service
						$sql_insert = "INSERT INTO `mya2billing`.`cc_logpayment` (`id`, `date`, `payment`, `card_id`,
						`id_logrefill`, `description`, `added_refill`, `payment_type`, `added_commission`, `agent_id`)
						VALUES (NULL, NOW(), '".$payment."', '".$id_cc_card."',
						NULL, '".$description."', '0', '".$payment_type."', '0', NULL);";
						
					   
						$sql_insert_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
						`data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
						VALUES (NULL, '1', '2', 'NEW PAYMENT CREATED', 'User added a new record in database',
						'card_id = ".$id_cc_card."| date =  ".$date."| payment =  ".$payment."| description =  ".$description."| added_refill =  0| added_commission =  0| payment_type =  ".$payment_type."| Web Software GX (".$loggedin["username"].")',
						'cc_logpayment', 'form_payment.php', '".getenv("REMOTE_ADDR")."', NOW(), '0');";
						//echo $insert."<br>";
					
						mysql_query($sql_insert, $conn_voip) or die (mysql_error());
						mysql_query($sql_insert_log, $conn_voip) or die (mysql_error());
						//log
						enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
					}
				}
				
				//echo $nominal_update;
				
			}
			
		}
	}
	
	$sql_update_lock = "UPDATE `gx_bank_masuk` SET `posting`='1', `status`='1', `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
			 WHERE (`transaction_id`='".$transaction_id."');";
	
	//echo $sql_update;
	mysql_query($sql_update_lock, $conn) or die (mysql_error());
	echo "<script language='JavaScript'>
	alert('Transaksi Sukses..');
	window.location.href='master_bankmasuk.php';
	</script>";
	
	}
	else
	{
		echo "<script language='JavaScript'>
		alert('Transaksi Gagal..');
		window.location.href='master_bankmasuk.php';
		</script>";
	}
	
}

$return_url = "";
if(isset($_GET["bm"]))
{
    $kode_data	= isset($_GET['bm']) ? mysql_real_escape_string(strip_tags(trim($_GET['bm']))) : '';
    $query_data 	= "SELECT `tbCustomer`.`cNama`, `gx_bank_masuk`.* FROM `gx_bank_masuk`, `tbCustomer`
			    WHERE `gx_bank_masuk`.`id_customer` = `tbCustomer`.`cKode`
				AND `gx_bank_masuk`.`transaction_id` = '".$kode_data."'
			    LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
   
    
    $return_url = 'form_bm_detail.php?bm='.$kode_data;
    
}


    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<section class="col-lg-9">
						<form action="" role="form" name="form_bm" id="form_bm" method="post" enctype="multipart/form-data">
						
						<input type="hidden" name="id_customer" value="'.(isset($_GET['bm']) ? $row_data["id_customer"] : "").'" readonly="">
						<input type="hidden" name="transaction_id" value="'.(isset($_GET['bm']) ? $row_data["transaction_id"] : "").'" readonly="">
						
						
						<div class="box box-solid box-info">
							<div class="box-header">
								<h3 class="box-title">Data Bank Masuk</h3>
							</div><!-- /.box-header -->
								<div class="box-body">
								
							<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Transaksi</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bm']) ? $row_data["transaction_id"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bm']) ? $row_data["tgl_transaction"] : date("Y-m-d")).'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Bank</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bm']) ? $row_data["bank_code"] : "").'
						
					    </div>
					    <div class="col-xs-3">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bm']) ? $row_data["id_customer"] : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC Kredit</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bm']) ? $row_data["acc_credit"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bm']) ? $row_data["cNama"] : "").'
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
						'.((isset($_GET['bm'])) ? $row_data["mu"] : "").'
						
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Rate</label>
					    </div>
					    <div class="col-xs-3">
					        '.(isset($_GET['bm']) ? $row_data["rate"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks</label>
                                            </div>
					    <div class="col-xs-9">
						'.(isset($_GET['bm']) ? $row_data["remarks"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['bm']) ? $row_data["user_add"] ." on".$row_data["date_add"]: $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Latest Updated By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['bm']) ? $row_data["user_upd"]." on".$row_data["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
					
                                        <table style="width:100%;">
					<tbody>
					    
					    <tr>
						<td colspan="2">&nbsp;</td>
					    </tr>
					    <tr>
						<td colspan="2">
					    <table width="100%" cellspacing="10" class="table table-bordered table-striped">
							    <tbody><tr>
							      <th>No.</th>
							      <th>ACC</th>
							      <th>Invoice Number</th>
							      <th>Invoice Name</th>
							      <th>Nominal</th>
							      <!--<th>#</th>-->
							    </tr>';
if(isset($_GET["bm"]))
{
    $id_bankmasuk	= $row_data["id_bankmasuk"];
    $query_item	= "SELECT * FROM `gx_bm_detail` WHERE `id_bankmasuk` ='".$id_bankmasuk."';";
    $sql_item	= mysql_query($query_item, $conn);
    
    $id_bm_detail  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_detail = "SELECT * FROM `gx_bm_detail` WHERE `id_bankmasuk` ='".$id_bankmasuk."' AND `id_bm_detail` = '".$id_bm_detail."' LIMIT 0,1;";
    $sql_detail   = mysql_query($query_detail, $conn);
    $row_detail = mysql_fetch_array($sql_detail);
    
    $no = 1;
    $total = 0;
    
    while($row_item = mysql_fetch_array($sql_item))
    {
    
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_item["no_acc"].'</td>
	<td>'.$row_item["kode_invoice"].'</td>
	<td>'.$row_item["title"].'</td>
	<td>'.number_format($row_item["nominal"], 0, ',', '.').'</td>
	<!--<td><a href="form_bm_detail?bm='.$kode_data.'&id='.$row_item["id_bm_detail"].'"><span class="label label-info">Edit</span></a>
	<a href="form_bm_detail?bm='.$kode_data.'&id='.$row_item["id_bm_detail"].'&act=del"><span class="label label-danger">Hapus</span></a>
	</td>-->
	</tr>';
	$no++;
	$total = $total + $row_item["nominal"];
	
    }
}else{
    
    $total_price = 0;
    $content .='<tr><td colspan="7">&nbsp;</td></tr>';
}

$content .='<tr>
							    <td>&nbsp;</td>
							    <td>&nbsp;</td>
							    <td colspan="2" align="right">TOTAL &nbsp;:</td>
							    <td  align="right">'.number_format($total, 0, ',', '.').'</td>
							    <!--<td>&nbsp;</td>-->
						    </tr>
					     
					    </tbody></table>
					    
					     
					    </td>
					    </tr>
					</tbody></table>
					
                                    </div><!-- /.box-body -->
									<div class="box-footer">
                                        <button type="submit" value="Posting" name="posting" class="btn btn-primary">Save & Posting</button>
                                    </div>
				    
				   
                            </div><!-- /.box -->
							</form>
                        </section>
                        <section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">FORM BANK MASUK ITEM</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_bm_item" id="form_bm_item" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Invoice</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="kode_invoice" value="'.(isset($_GET['bm']) ? $row_detail["kode_invoice"] : "").'" readonly=""
						placeholder="Search Invoice" onclick="return valideopenerform(\'data_invoice.php?r=form_bm_item&f=bmd&c='.$row_data["id_customer"].'\',\'bmd\');">
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_detail["id_bm_detail"] : '').'" readonly="">
						<input type="hidden" name="kode_bm" value="'.(isset($_GET['bm']) ? $row_data["id_bankmasuk"] : '').'" readonly="">
						
						<input type="hidden" name="return_url" value="'.$return_url.'" readonly="">
						
					    </div>
					   
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Invoice</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="title_invoice" value="'.(isset($_GET['id']) ? $row_detail["title"] : "").'" readonly="">
					    </div>
					   
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>ACC</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" required name="acc_bm" onclick="return valideopenerform(\'data_acc.php?r=form_bm_item&f=bm\',\'bm\');"
						value="'.(isset($_GET['id']) ? $row_detail["no_acc"] : "").'" >
					    </div>
					   
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nominal</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="nominal" id="harga" value="'.(isset($_GET['id']) ? $row_detail["nominal"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_detail["user_add"] ." on ".$row_detail["date_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Latest Updated By </label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_detail["user_upd"]." on ".$row_detail["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: "",
		thousandsSeparator: ",",
		centsLimit: 0
	    });
        </script>
';

    $title	= 'Form Bank Masuk Detail';
    $submenu	= "master_bankmasuk";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>