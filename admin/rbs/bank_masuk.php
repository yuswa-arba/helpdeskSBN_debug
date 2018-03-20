<?php
include ("../../config/configuration_admin.php");
//the SQL statement that will query the database
$conn_soft = Config::getInstanceSoft();
global $conn;
   
	$id_customer		= "P-D000001";
    $transaction_id		= "BM150813001";
    
	//detail_bankmasuk
	$query_bm	= "SELECT `gx_bm_detail`.* FROM `gx_bank_masuk`, `gx_bm_detail`
	WHERE `gx_bank_masuk`.`id_bankmasuk` = `gx_bm_detail`.`id_bankmasuk`
	AND `gx_bank_masuk`.`transaction_id` ='".$transaction_id."' AND  `gx_bank_masuk`.`level` ='0';";
    $sql_bm		= mysql_query($query_bm, $conn);
	
	//detail user
	$query_user	= "SELECT `iuserIndex` FROM `tbCustomer` WHERE `cKode` ='".$id_customer."';";
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
					
					
				}
				elseif($nominal <  $row_invoice["harga"])
				{
					//posting ke database RBS sesuai bankmasuk_detail
					echo "rbs aja";
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
				}
				
			}
			
			//ABONEMEN VOIP
			/*if($row_invoice["desc"] == "VOIP" )
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
			*/
			echo $nominal_update;
			
		}
		
	}
	
	
	
	
?>