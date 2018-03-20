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
include ("../../config/configuration_voip_bpn.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List Provider");
    global $conn;
    global $conn_voip;
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title"></h2>
                                </div>

                                <div class="box-body table-responsive">
	
				<div class="box-header">
                                    <h3 class="box-title">Provider List</h3>
                                </div><!-- /.box-header -->
				    <div align="right">
					<a href="'.URL_ADMIN.'voip/form_provider.php" class="btn bg-navy btn-flat margin" >Add Provider</a>
				    </div>
                                    <table id="customer" class="table table-bordered table-striped" style="width: 80%;" align="center">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Provider Name</th>
                                                <th>Creation Date</th>
                                                <th>Description</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					


    $sql_provider = mysql_query("SELECT * FROM `cc_provider` ORDER BY `id` ASC ;",$conn_voip);



$no = 1;
while ($row_provider = mysql_fetch_array($sql_provider))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_provider["provider_name"].'</td>
		    <td>'.$row_provider["creationdate"].'</td>
		    <td>'.$row_provider["description"].'</td>
		    <td align="center"><span class="label label-info"><a href="form_provider.php?id='.$row_provider["id"].'" target="_blank">Edit</a></span></td>
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

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>
	
    ';

    $title	= 'Provider List';
    $submenu	= "voip_provider";
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