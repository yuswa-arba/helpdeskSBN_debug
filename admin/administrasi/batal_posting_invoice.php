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

redirectToHTTPS();
$conn_soft = Config::getInstanceSoft();

if($loggedin = logged_inAdmin())
{
	 if($loggedin["group"] == 'admin')
	 {
		  enableLog("", $loggedin["username"], $loggedin["username"], "batal posting");
		  global $conn;
	 
		  if(isset($_POST["id"]))
		  {
			   $id		= isset($_POST['id']) ? strip_tags(mysql_real_escape_string($_POST['id'])) : '';
			   $passwordbatal	= isset($_POST['passwordbatal']) ? strip_tags(mysql_real_escape_string($_POST['passwordbatal'])) : '';
			   
			   $sql_supervisor = mysql_query("SELECT * FROM `gxLogin_admin` WHERE `username`='cindie' AND `password`='".md5($passwordbatal)."' LIMIT 1;", $conn);
			   if(mysql_num_rows($sql_supervisor) == 1)
			   {
					$sql_bm = mysql_query("SELECT * FROM `gx_invoice` WHERE `kode_invoice`='".$id."' LIMIT 1;", $conn);
					$row_bm = mysql_fetch_array($sql_bm);
					
					$sql_customer	= mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode`='".$row_bm["id_customer"]."' LIMIT 1;", $conn);
					$row_customer	= mysql_fetch_array($sql_customer);
					
					$sql_rbs_user	= "SELECT TOP 1 * FROM [dbo].[Users] WHERE [Users].[UserID] = '".$row_customer["cUserID"]."';";
					$query_rbs_user = $conn_soft->prepare($sql_rbs_user);
					$query_rbs_user->execute();
					$row_rbs_user	= $query_rbs_user->fetch();
					
					$sql_rbs	= "SELECT TOP 1 * FROM [dbo].[billingTransactions] WHERE [billingTransactions].[BillingTransactionIndex] = '".$row_bm["reference"]."' ORDER BY [BillingTransactionIndex] DESC;";
					$query_rbs = $conn_soft->prepare($sql_rbs);
					$query_rbs->execute();
					$row_rbs	= $query_rbs->fetch();
					
					if(($id != ""))
					{
						 $UserPaymentBalance = $row_rbs_user["UserPaymentBalance"] - ($row_rbs["Total"]);
						 $PaymentNumber = $row_rbs["Reference"];
						 $cUserID	= $row_customer["cUserID"];
						 $reference	= $row_bm["reference"];
						 //UPDATE RBS
						 $sql_rbs_update	= "
						 UPDATE TOP(1) [dbo].[Payments] SET [Amount]='0' WHERE ([PaymentNumber]='".$PaymentNumber."');
						 UPDATE TOP(1) [dbo].[BillingTransactions] SET [Total]='0' WHERE ([BillingTransactionIndex]='".$reference."');
						 UPDATE [dbo].[Users] SET [UserPaymentBalance]='".$UserPaymentBalance."' WHERE ([UserID]='".trim($cUserID)."');
						 ";
						 $query_rbs_update = $conn_soft->prepare($sql_rbs_update);
						 $query_rbs_update->execute();
						 
						 $sql_update_user = "UPDATE `tbCustomer` SET `gx_saldo`='".$UserPaymentBalance."', `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
											 WHERE (`cUserID`='".$cUserID."');";
						 //echo $sql_update;
						 mysql_query($sql_update_user, $conn) or die (mysql_error());
					
						 $sql_update_batal = "UPDATE `gx_invoice` SET `level`='1', `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
											 WHERE (`kode_invoice`='".$id."');";
						 
						 //echo $sql_update;
						 mysql_query($sql_update_batal, $conn) or die (mysql_error());
						 //log
						 enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_batal);
						 $data = array(
							 'success' => true,
							 'message' => 'Data sudah dibatal posting'
						 );
						 echo json_encode($data);
					}
			   }
			   else
			   {
					$data = array(
						 'success' => false,
						 'message' => 'Password salah...',
						 'error' => "$passwordbatal SELECT * FROM `gxLogin_admin` WHERE `username`='cindie' AND `password`='".md5($passwordbatal)."' LIMIT 1;"
					);
					echo json_encode($data);
			   }
			   
		  }
		  
	 
		
	 }
	 
}
else
{
	 header("location: ".URL_ADMIN."logout.php");
}

?>