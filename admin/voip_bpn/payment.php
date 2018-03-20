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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Payment VOIP");
    global $conn;
    global $conn_voip;
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                
				<div class="box-header">
                                    <h3 class="box-title">List Payment</h3>
				    <a href="form_payment.php" class="btn bg-olive btn-flat margin pull-right">Add Payment</a>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
						<th>Account</th>
						<th>Date</th>
						<th>Amount</th>
						<th>Type</th>
						<th>Refill</th>
						<th width="100">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					

if(isset($_POST["search"])){
    
}else{
    $sql_payment = mysql_query("SELECT `cc_logpayment`.*, `cc_card`.`username`, `cc_card`.`firstname`, `cc_card`.`lastname`
				  FROM `cc_logpayment`, `cc_card`
				  WHERE `cc_logpayment`.`card_id` = `cc_card`.`id`
				  ORDER BY `cc_logpayment`.`id` DESC;",$conn_voip);
}


$no = 1;
while ($row_payment = mysql_fetch_array($sql_payment))
{
    
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_payment["username"].'</td>
		    <td>'.date("d-m-Y H:i:s", strtotime($row_payment["date"])).'</td>
		    <td>'.number_format($row_payment["payment"], 2, ',','.').' IDR</td>
		    <td>'.$row_payment["payment_type"].'</td>
		    <td></td>

		    <td align="center"><a href=""><span class="label label-info">Detail</span></a>
		    <a href="form_payment?id='.$row_payment["id"].'"><span class="label label-info">Edit</span></a>
		    
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

    $title	= 'Payment';
    $submenu	= "voip_payment";
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