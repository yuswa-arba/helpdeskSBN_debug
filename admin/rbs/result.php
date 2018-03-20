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
 
 
if(isset($_REQUEST['GroupName']))
{
	$conn_soft = Config::getInstanceSoft();
	
	$GroupName = isset($_REQUEST["GroupName"]) ? $_REQUEST["GroupName"] : "";
	$sql_group = isset($_REQUEST["GroupName"]) ? " AND dbo.Users.AccountIndex = '".$GroupName."' " : "";
	
	
	$sql_data_acc = $conn_soft->prepare("SELECT * FROM dbo.AccountTypes WHERE dbo.AccountTypes.AccountIndex = '".$GroupName."' ORDER BY dbo.AccountTypes.AccountName;");
	$sql_data_acc->execute();
	$row_data_acc = $sql_data_acc->fetch(PDO::FETCH_ASSOC);
	

$content ='
			<h4>Data AccountName '.$row_data_acc["AccountName"].'</h4>
			<table id="listdata2" class="table table-bordered table-striped table-responsive">
								<thead>
									<tr>
										<th>#</th>
										<th>UserIndex</th>
										<th>UserID</th>
										<th>AccountName</th>
										<th>GroupName</th>
									</tr>
								</thead>
								<tbody>';
								


	
	
$sql_data = $conn_soft->prepare("SELECT dbo.Users.UserIndex, dbo.Users.UserID, dbo.Users.UserIP, dbo.AccountTypes.AccountName, dbo.Users.GroupName, dbo.Users.UserPaymentBalance,
									dbo.Users.GracePeriodExpiration , dbo.Users.UserActive, dbo.Users.UserExpiryDate
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
$no = 1;
while ($row_data = $sql_data->fetch(PDO::FETCH_ASSOC))
{
$content .= '<tr>
			<td>'.$no.'</td>
			<td>'.$row_data["UserIndex"].'</td>
			<td>'.$row_data["UserID"].'</td>
			<td>'.$row_data["AccountName"].'</td>
			<td>'.$row_data["GroupName"].'</td>
		</tr>';
		$no++;
}


$content .= '
                                            
                                        </tbody>
                                    </table>';
									
echo $content;
}
?>