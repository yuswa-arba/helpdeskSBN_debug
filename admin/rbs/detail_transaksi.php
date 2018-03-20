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
if($loggedin = logged_inAdmin())
{
	if($loggedin["group"] == 'admin'){
		
		$conn_soft = Config::getInstanceSoft();
		
		$sql_data = $conn_soft->prepare("SELECT *
				FROM
					dbo.BillingTransactions
				WHERE
					UserIndex = '72'
				AND TransType = '1'
				;");
		
		$sql_data->execute();
		$row_data = $sql_data->fetch();
		
		echo "<pre>";
		var_dump($row_data);
		echo "</pre>";
	
	}
}
else
{
	header('location: '.URL_ADMIN.'logout.php');
}

?>