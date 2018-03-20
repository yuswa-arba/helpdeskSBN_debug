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
    $conn_soft = Config::getInstanceSoft();
    
    //paging
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
     
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
						<div class="box-header">
                            <h3 class="box-title">List Data</h3>
						</div><!-- /.box-header -->
						
						<div class="box-body">
						<div class="row">
							<div class="col-lg-6 col-md-12 col-xs-12">
							<form action="" method="post" name="form_search">
								<div class="form-group">
								<div class="row">
									<div class="col-xs-4">
										<label>GroupName</label>
									</div>
									<div class="col-xs-8">
										<select class="form-control" id="GroupName" name="GroupName">
											<option value="">Pilih Group</option>';

$sql_data = $conn_soft->prepare("SELECT  GroupIndex, GroupName, NASAttributes FROM dbo.Groups ORDER BY dbo.Groups.GroupName;");
$sql_data->execute();
while ($row_data = $sql_data->fetch())
{
	$content .= '<option value="'.$row_data["GroupName"].'">'.$row_data["GroupName"].'</option>';
}

$content .= '
										</select>
									</div>
								
								</div>
								</div>
								
								<div class="form-group">
								<div class="row">
									<div class="col-xs-4">
										
									</div>
									<div class="col-xs-8">
										<input class="btn bg-olive btn-flat" id="search" name="search" value="Search" type="submit">
									</div>

								</div>
								</div>
							</form>
						
							<div class="row">
									<div class="col-lg-12 col-xs-12">
                            <table id="listdata" class="table table-bordered table-striped table-responsive">
								<thead>
									<tr>
										<th>#</th>
										<th>UserIndex</th>
										<th>UserID</th>
										<th>GroupName</th>
										
									</tr>
								</thead>
								<tbody>';
								

if(isset($_POST['search']))
{
	
	$GroupName = isset($_POST["GroupName"]) ? $_POST["GroupName"] : "";
	$sql_group = isset($_POST["GroupName"]) ? " AND dbo.Users.GroupName = '".$GroupName."' " : "";
	
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
while ($row_data = $sql_data->fetch())
{
$content .= '<tr>
			<td>'.$no.'</td>
			<td>'.$row_data["UserIndex"].'</td>
			<td>'.$row_data["UserID"].'</td>
			<td>'.$row_data["GroupName"].'</td>
			
		</tr>';
		$no++;
}

}
$content .= '
                                            
                                        </tbody>
                                    </table>
								</div>
							</div>
							
							</div>
							<div class="col-lg-6 col-md-12 col-xs-12">
								
									<div class="form-group">
									<div class="row">
										<div class="col-xs-4">
											<label>GroupName</label>
										</div>
										<div class="col-xs-8">
											<select class="form-control" id="GroupName2" name="GroupName2">
												<option value="">Pilih Group</option>';
	
	$sql_data = $conn_soft->prepare("SELECT  GroupIndex, GroupName, NASAttributes FROM dbo.Groups ORDER BY dbo.Groups.GroupName;");
	$sql_data->execute();
	while ($row_data = $sql_data->fetch())
	{
		$content .= '<option value="'.$row_data["GroupName"].'">'.$row_data["GroupName"].'</option>';
	}
	
	$content .= '
											</select>
										</div>
									
									</div>
									</div>
									
									<div class="form-group">
									<div class="row">
										<div class="col-xs-4">
											
										</div>
										<div class="col-xs-8">
											<input class="btn bg-olive btn-flat" id="changeto" name="changeto" value="Pindah Group" type="button">
										</div>
	
									</div>
									</div>
								
								
								<div class="row">
									<div class="col-lg-12 col-xs-12" id="result">
                            <table id="listdata2" class="table table-bordered table-striped table-responsive">
								<thead>
									<tr>
										<th>#</th>
										<th>UserIndex</th>
										<th>UserID</th>
										<th>GroupName</th>
										
									</tr>
								</thead>
								<tbody>';
								

if(isset($_POST['changeto']))
{
	
	$GroupName = isset($_POST["GroupName"]) ? $_POST["GroupName"] : "";
	$sql_group = isset($_POST["GroupName"]) ? " AND dbo.Users.GroupName = '".$GroupName."' " : "";
	
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
while ($row_data = $sql_data->fetch())
{
$content .= '<tr>
			<td>'.$no.'</td>
			<td>'.$row_data["UserIndex"].'</td>
			<td>'.$row_data["UserID"].'</td>
			<td>'.$row_data["GroupName"].'</td>
			
		</tr>';
		$no++;
}

}
$content .= '
                                            
                                        </tbody>
                                    </table>
								</div>
							</div>
								
							</div>
				    
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
                    "bInfo": false,
                    "bAutoWidth": false,
					"iDisplayLength": 50
                });
				
				$(\'#listdata2\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false,
					"iDisplayLength": 50
                });
            });
        </script>
		
		<script type="text/javascript">
            $(document).ready(function(){
                 
                 function search(){
 
                      var GroupName=$("#GroupName2").val();
 
                      if(GroupName!=""){
                        $("#result").html(\'<img alt="ajax search" src="ajax-loader.gif"/>\');
                         $.ajax({
                            type:"post",
                            url:"search.php",
                            data:"GroupName="+GroupName,
                            success:function(data){
                                $("#result").html(data);
                                $("#GroupName2").val("");
                             }
                          });
                      }
                 }
 
                  $("#changeto").click(function(){
                  	 search();
                  });
 
                  $(\'#changeto\').keyup(function(e) {
                     if(e.keyCode == 13) {
                        search();
                      }
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