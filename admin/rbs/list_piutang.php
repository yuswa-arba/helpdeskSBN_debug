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
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Group RBS");
    global $conn;
    
    
    
    //paging
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
     
    $content ='<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
						<div class="box-header">
                            <h3 class="box-title">List Data</h3>
						</div><!-- /.box-header -->
						
						<div class="box-body table-responsive">
                            <table id="listdata" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										
										<th>UserID</th>
										<th>GroupName</th>
										<th>AccountName</th>
										<th>UserIP</th>
										<th>UserPaymentBalance</th>
										<th>GracePeriodExpiration</th>
										<th>UserExpiryDate</th>
										<th>UserActive</th>
									</tr>
								</thead>
								<tbody>';
								
$conn_soft = Config::getInstanceSoft();
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

$no = 1;
while ($row_data = $sql_data->fetch())
{
	$sql_customer = mysql_query("SELECT `cKode` FROM `tbCustomer` WHERE `cUserID` = '".$row_data["UserID"]."' LIMIT 0,1;", $conn);
    $row_customer = mysql_fetch_array($sql_customer);
	
$content .= '<tr>
			<td>'.$no.'</td>
			
			<td><a href="../administrasi/piutang_detail.php?c='.$row_customer["cKode"].'" target="_blank">'.$row_data["UserID"].'</a></td>
			<td>'.$row_data["GroupName"].'</td>
			<td>'.$row_data["AccountName"].'</td>
			<td>'.long2ip($row_data["UserIP"]).'</td>
			<td>'.number_format($row_data["UserPaymentBalance"], 0, ",",".").'</td>
			<td>'.date("d-m-Y", strtotime($row_data["GracePeriodExpiration"])).'</td>
			<td>'.date("d-m-Y", strtotime($row_data["UserExpiryDate"])).'</td>
			<td>'.(($row_data["UserActive"] == "1") ? 'Aktif' : 'Nonaktif').'</td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#listdata\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false,
					"iDisplayLength": 50
                });
            });
        </script>
    ';

    $title	= 'Groups RBS';
    $submenu	= "group_rbs";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>