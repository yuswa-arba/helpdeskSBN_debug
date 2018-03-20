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
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List Customer Voip");
    global $conn;
    global $conn_voip;
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Audit VOIP</h2>
                                </div>

                                <div class="box-body table-responsive">
                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th style="width: 110px">VOIP Number</th>
                                               
                                                <th>Name</th>
                                                <th>Group</th>
                                                <th>BA</th>
						<th>Plan</th>
						<th>Status</th>
						
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					


    $sql_masterCustomer = mysql_query("SELECT `cc_card`.*, `cc_card_group`.`name`, `cc_tariffgroup`.`tariffgroupname`
									  FROM `cc_card`, `cc_card_group`, `cc_tariffgroup`
									  WHERE `cc_card`.`id_group` = `cc_card_group`.`id`
									  AND `cc_card`.`tariff` = `cc_tariffgroup`.`id`
									  ORDER BY `cc_card`.`id` ASC ;",$conn_voip);


$no = 1;
while ($row_masterCustomer = mysql_fetch_array($sql_masterCustomer))
{
    
    $status	= '';
    $status 	.= ($row_masterCustomer["status"] == "0") ? "CANCEL" : "";
    $status	.= ($row_masterCustomer["status"] == "1") ? "ACTIVATED" : "";
    $status	.= ($row_masterCustomer["status"] == "2") ? "NEW" : "";
    $status	.= ($row_masterCustomer["status"] == "3") ? "WAITING" : "";
    $status	.= ($row_masterCustomer["status"] == "4") ? "RESERV" : "";
    $status	.= ($row_masterCustomer["status"] == "5") ? "EXPIRED" : "";
    $status	.= ($row_masterCustomer["status"] == "6") ? "SUS-PAY" : "";
    $status	.= ($row_masterCustomer["status"] == "7") ? "SUS-LIT" : "";
    $status	.= ($row_masterCustomer["status"] == "8") ? "WAIT-PAY" : "";
    //echo "SELECT * FROM `cc_card_group` WHERE `id` = '".$row_masterCustomer["id_group"]."'";
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_masterCustomer["useralias"].'</td>
		    <td>'.$row_masterCustomer["firstname"].' '.$row_masterCustomer["lastname"].'</td>
		    <td>'.$row_masterCustomer["name"].'</td>
		    <td>'.number_format($row_masterCustomer["credit"], 2, ',', '.').' IDR</td>
		    <td>'.$row_masterCustomer["tariffgroupname"].'</td>
		    <td>'.$status.'</td>
		    
		    <td align="center"><a href="detail_audit?n='.str_replace("0542", "", $row_masterCustomer["useralias"]).'"><span class="label label-info">Detail</span></a>
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

$plugins = '';

    $title	= 'Audit VOIP (ASTERIX + A2BILLING)';
    $submenu	= "voip_audit";
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