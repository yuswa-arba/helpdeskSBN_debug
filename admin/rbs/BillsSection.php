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
    global $conn_voip;
    
    
    //paging
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
     
    $content ='<section class="content-header">
                    <h1>
                        BillsSections
                    </h1>
                    
                </section>

                <!-- Main content -->
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
										<th>BillIndex</th>
										<th>BillSectionIndex</th>
										<th>Type</th>
										<th>Charge</th>
										<th>Info1</th>
										<th>Info2</th>
										<th>Info3</th>
										<th>Remark</th>
									</tr>
								</thead>
								<tbody>';
								
 $conn_soft = Config::getInstanceSoft();

$sql_data = $conn_soft->prepare("SELECT *
  FROM dbo.BillsSections

  ORDER BY dbo.BillsSections.BillIndex DESC;");
//  AND dbo.Users.UserIndex = '6418'
//INSERT INTO [DRBSISP].[dbo].[BillsSections] ([BillIndex], [BillSectionIndex], [Type], [Charge], [Info1], [Info2], [Info3], [Remark]) 

$sql_data->execute();

$no = 1;
while ($row_data = $sql_data->fetch())
{
$content .= '<tr>
			<td>'.$no.'</td>
			<td>'.$row_data["BillIndex"].'</td>
			<td>'.$row_data["BillSectionIndex"].'</td>
			<td>'.$row_data["Type"].'</td>
			<td>'.($row_data["Charge"]).'</td>
			<td>'.($row_data["Info1"]).'</td>
			<td>'.($row_data["Info2"]).'</td>
			<td>'.($row_data["Info3"]).'</td>
			<td>'.($row_data["Remark"]).'</td>
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