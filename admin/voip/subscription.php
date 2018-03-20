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
include ("../../config/configuration_voip_bali.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master Subscription");
    global $conn;
    global $conn_voip;
    
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                
				<div class="box-header">
                                    <h3 class="box-title">List Group Customer</h3>
				    <a href="'.URL_ADMIN.'voip/form_subscription.php" class="btn bg-olive btn-flat margin pull-right">Create Group</a>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Nama</th>
						<th>Fee</th>
						<th>Status</th>
						<th>Date Start</th>
						<th>Date Stop</th>
						<th>NBRUN</th>
						<th>Date Lastrun</th>
						<th>ACC Perform</th>
						<th>Total Credit</th>
						<th width="100">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					

if(isset($_POST["search"])){
    
}else{
    $sql_subscription = mysql_query("SELECT * FROM `cc_subscription_service`;",$conn_voip);
}


$no = 1;
while ($row_subscription = mysql_fetch_array($sql_subscription))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_subscription["label"].'</td>
		    <td>'.$row_subscription["fee"].'</td>
		    <td>'.(($row_subscription["status"] == "1") ? "Active" : "Inactive").'</td>
		    <td>'.$row_subscription["startdate"].'</td>
		    <td>'.$row_subscription["stopdate"].'</td>
		    <td>'.$row_subscription["numberofrun"].'</td>
		    <td>'.$row_subscription["datelastrun"].'</td>
		    <td>'.$row_subscription["totalcardperform"].'</td>
		    <td>'.$row_subscription["totalcredit"].'</td>
		    <td align="center"><a href=""><span class="label label-info">Detail</span></a>
		    <a href="form_subscription?id='.$row_subscription["id"].'"><span class="label label-info">Edit</span></a>
		    </td>
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

$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#customer\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
    ';

    $title	= 'Master Subscription Service';
    $submenu	= "master_subscription";
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