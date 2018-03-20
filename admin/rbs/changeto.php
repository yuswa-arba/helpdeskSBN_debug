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
 
global $conn;
$conn_soft = Config::getInstanceSoft();
redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
	if($loggedin["group"] == 'admin'){


$content ='
<h4>Data Gamas</h4>

<table id="listdata2" class="table table-bordered table-striped table-responsive">
								<thead>
									<tr>
										<th>#</th>
										<th>UserIndex</th>
										<th>UserID</th>
										<th>AccountName Old</th>
										<th>AccountName New</th>
									</tr>
								</thead>
								<tbody>';
								

if(isset($_REQUEST['GroupNameOld']))
{
	$GroupNameOld 	= isset($_REQUEST["GroupNameOld"]) ? $_REQUEST["GroupNameOld"] : "";
	$GroupNameNew 	= isset($_REQUEST["GroupNameNew"]) ? $_REQUEST["GroupNameNew"] : "";
	
	$sql_group 		= isset($_REQUEST["GroupNameOld"]) ? " AND dbo.Users.AccountIndex = '".$GroupNameOld."' " : "";
	$sql_group_new	= isset($_REQUEST["GroupNameNew"]) ? " AND dbo.Users.AccountIndex = '".$GroupNameNew."' " : "";
	
	$sql_data = $conn_soft->prepare("SELECT dbo.Users.UserIndex, dbo.Users.UserID, dbo.Users.GroupName, dbo.Users.UserActive
	  FROM dbo.Users, dbo.AccountTypes
	  WHERE dbo.Users.AccountIndex = dbo.AccountTypes.AccountIndex
	  AND dbo.Users.UserActive = '1'
	  $sql_group
	  ORDER BY dbo.Users.UserIndex DESC;");
	//  AND dbo.Users.UserIndex = '6418'
	$sql_data->execute();

/*else
{
	$userIndex = isset($_GET["id"]) ? (int)$_GET["id"] : "";
	$UserID = isset($_GET["u"]) ? $_GET["u"] : "";
	$sql_userindex = isset($_GET["id"]) ? " AND dbo.Users.UserIndex = '".$userIndex."' " : "";
	$sql_userid = isset($_GET["u"]) ? " AND dbo.Users.UserID LIKE '%".$UserID."%' " : "";
	
	$sql_data = $conn_soft->prepare("SELECT dbo.Users.UserIndex, dbo.Users.UserID, dbo.Users.UserIP, dbo.AccountTypes.AccountName, dbo.Users.GroupName, dbo.Users.UserPaymentBalance,
									dbo.Users.GracePeriodExpiration , dbo.Users.UserActive, dbo.Users.UserExpiryDate
	  FROM dbo.Users, dbo.AccountTypes
	  WHERE dbo.Users.AccountIndex = dbo.AccountTypes.AccountIndex
	  AND dbo.Users.UserActive = '1'
	$sql_userindex
	$sql_userid
	  ORDER BY dbo.Users.UserIndex DESC;");
	//  AND dbo.Users.UserIndex = '6418'
	$sql_data->execute();

}*/

$row_data = $sql_data->fetchAll(PDO::FETCH_ASSOC);
foreach($row_data as $value)
{
	$sql_data_update = $conn_soft->prepare("UPDATE TOP(1) [dbo].[Users] SET [AccountIndex]='".$GroupNameNew."' WHERE ([UserIndex]='".$value["UserIndex"]."');");
	$sql_data_update->execute();
	mysql_query("INSERT INTO `software`.`gx_inet_gamas` (`id_gamas`, `userid`, `userindex`, `groupname_old`,
							  `groupname_new`, `date_add`, `user_add`, `from_ip`)
							  VALUES (NULL, '".$value["UserID"]."', '".$value["UserIndex"]."',
							  '".$GroupNameOld."', '".$GroupNameNew."',
							  NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."');", $conn);
}
//{
//	
//	$sql_data_update = $conn_soft->prepare("UPDATE TOP(1) [dbo].[Users] SET [GroupName]='".$GroupNameNew."' WHERE ([UserIndex]='".$row_data["UserIndex"]."');");
//	$sql_data_update->execute();
//	
//	//mysql_query("INSERT INTO `software`.`gx_inet_gamas` (`id_gamas`, `userid`, `userindex`, `groupname_old`,
//	//							  `groupname_new`, `date_add`, `user_add`, `from_ip`)
//	//							  VALUES (NULL, '".$row_data["UserID"]."', '".$row_data["UserIndex"]."',
//	//							  '".$GroupNameOld."', '".$GroupNameNew."',
//	//							  NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."');", $conn);
//
//}


	
	
	$sql_data_acc = $conn_soft->prepare("SELECT TOP(1) AccountName FROM dbo.AccountTypes WHERE dbo.AccountTypes.AccountIndex = '".$GroupNameOld."';");
	$sql_data_acc->execute();
	$row_data_acc = $sql_data_acc->fetch(PDO::FETCH_ASSOC);
	
	$sql_data_new = $conn_soft->prepare("SELECT dbo.Users.UserIndex, dbo.Users.UserID, dbo.Users.UserIP, dbo.AccountTypes.AccountName, dbo.Users.GroupName, dbo.Users.UserPaymentBalance,
									dbo.Users.GracePeriodExpiration , dbo.Users.UserActive, dbo.Users.UserExpiryDate
	  FROM dbo.Users, dbo.AccountTypes
	  WHERE dbo.Users.AccountIndex = dbo.AccountTypes.AccountIndex
	  AND dbo.Users.UserActive = '1'
	  $sql_group_new
	  ORDER BY dbo.Users.UserIndex DESC;");
	//  AND dbo.Users.UserIndex = '6418'
	$sql_data_new->execute();
	//echo $row_data_acc['AccountName'];
	//echo "<pre>";
	//print_r($row_data_acc);
	//echo "</pre>";
	//
	$no = 1;
	while ($row_data_new = $sql_data_new->fetch(PDO::FETCH_ASSOC))
	{
		
		$content .= '<tr>
			<td>'.$no.'</td>
			<td>'.$row_data_new["UserIndex"].'</td>
			<td>'.$row_data_new["UserID"].'</td>
			<td>'.$row_data_acc["AccountName"].'</td>
			<td>'.$row_data_acc['GroupName'].'</td>
			<td>'.$row_data_new['GroupName'].'</td>
			
		</tr>';
		$no++;
	}
	
	
}
$content .= '
                                            
                                        </tbody>
                                    </table>';
									
echo $content;

}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }
?>