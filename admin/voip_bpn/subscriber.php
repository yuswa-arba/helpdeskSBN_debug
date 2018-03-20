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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master Subscriber");
    global $conn;
    global $conn_voip;
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                
				<div class="box-header">
                                    <h3 class="box-title">List Subscriber</h3>
				    <a href="'.URL_ADMIN.'voip/form_subscriber.php" class="btn bg-olive btn-flat margin pull-right">Add Subscriber</a>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Account Number</th>
						<th>Service</th>
						<th>Date Start</th>
						<th>Date Stop</th>
						<th>Product</th>
						<th width="100">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					

if(isset($_POST["search"])){
    
}else{
    $sql_subscriber = mysql_query("SELECT `cc_card_subscription`.*, `cc_card`.`username`, `cc_card`.`useralias`,
				  `cc_subscription_service`.`label`
				  FROM `cc_card_subscription`, `cc_card`, `cc_subscription_service`
				  WHERE `cc_card_subscription`.`id_cc_card` = `cc_card`.`id`
				  AND `cc_card_subscription`.`id_subscription_fee` = `cc_subscription_service`.`id`;",$conn_voip);
}


$no = 1;
while ($row_subscriber = mysql_fetch_array($sql_subscriber))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_subscriber["username"].'</td>
		    <td>'.$row_subscriber["label"].'</td>
		    <td>'.$row_subscriber["startdate"].'</td>
		    <td>'.$row_subscriber["stopdate"].'</td>
		    <td>'.$row_subscriber["product_name"].'</td>
		    <td align="center"><a href=""><span class="label label-info">Detail</span></a>
		    <a href="form_subscriber?id='.$row_subscriber["id"].'"><span class="label label-info">Edit</span></a>
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

    $title	= 'Subscriber';
    $submenu	= "master_subscriber";
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