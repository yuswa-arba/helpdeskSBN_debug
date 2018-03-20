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
    
    enableLog($id_customer="", $nama_customer= $loggedin["username"], $id_admin=$loggedin["id_employee"],$activity="Open List Customer");

    global $conn_voip;
$id_info = isset($_GET['id_info']) && $_GET['id_info']!='' ? $_GET['id_info'] : '';   
if($id_info != ''){
/*
ACCOUNT NUMBER 	: 	Wardiansah Dwi (43146)
AMOUNT 		: 	1000.00000 IDR
CREATION DATE 	: 	2014-09-29 13:09:36
REFILL TYPE 	: 	AMOUNT
DESCRIPTION 	: 	tes 
*/
$sql_cc_card 		= "SELECT `id`, `creationdate`, `firstusedate`, `expirationdate`, `enableexpire`, `expiredays`, `username`, `useralias`, `uipass`, `credit`, `tariff`, `id_didgroup`, `activated`, `status`, `lastname`, `firstname`, `address`, `city`, `state`, `country`, `zipcode`, `phone`, `email`, `fax`, `inuse`, `simultaccess`, `currency`, `lastuse`, `nbused`, `typepaid`, `creditlimit`, `voipcall`, `sip_buddy`, `iax_buddy`, `language`, `redial`, `runservice`, `nbservice`, `id_campaign`, `num_trials_done`, `vat`, `servicelastrun`, `initialbalance`, `invoiceday`, `autorefill`, `loginkey`, `mac_addr`, `id_timezone`, `tag`, `voicemail_permitted`, `voicemail_activated`, `last_notification`, `email_notification`, `notify_email`, `credit_notification`, `id_group`, `company_name`, `company_website`, `vat_rn`, `traffic`, `traffic_target`, `discount`, `restriction`, `id_seria`, `serial`, `block`, `lock_pin`, `lock_date` FROM `cc_card` WHERE 1";
$sql_cc_log_refill	= "SELECT `id`, `date`, `credit`, `card_id`, `description`, `refill_type`, `added_invoice`, `agent_id` FROM `cc_logrefill` WHERE 1";
$sql_info 		= "SELECT `cc_card`.`username`, `cc_card`.`firstname`, `cc_card`.`lastname`, `cc_logrefill`.`credit`, `cc_logrefill`.`date`, `cc_logrefill`.`refill_type`, `cc_logrefill`.`description` FROM `cc_card`, `cc_logrefill` WHERE `cc_card`.`id`= `cc_logrefill`.`card_id` AND `cc_logrefill`.`id`=$id_info";


    
    $content = '
                <!-- Main content -->
                <section class="content">

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Log Refill</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">';

$query_info = mysql_query($sql_info, $conn_voip);
$r_data_info = mysql_fetch_array($query_info);
    $content .= '<table>';
    $content .= '<tr><td width="200px">ACCOUNT NUMBER 	: </td><td>'.$r_data_info['firstname'].' '.$r_data_info['lastname'].' ('.$r_data_info['username'].')</td></tr>';
    $content .= '<tr><td>AMOUNT 		: </td><td>'.$r_data_info['credit'].'</td></tr>';
    $content .= '<tr><td>CREATION DATE 	:</td><td>'.$r_data_info['date'].'</td></tr>';
    $content .= '<tr><td>REFILL TYPE 	:</td><td>'.$r_data_info['refill_type'].'</td></tr>';
    $content .= '<tr><td>DESCRIPTION 	:</td><td>'.$r_data_info['description'].'</td></tr>';
    $content .= '</table>';

$content .= '<br><div width="100%" style="text-align:right;"><a href="#" onclick="javascript:history.go(-1)">Go to list refill</a></div></div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->';	  				

$plugins = '
	<script type="text/javascript">
			function valideopenerform(){
			var popy= window.open("data_id_cust.php","popup_form","toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
			if (window.focus) {popy.focus()}
			    return false;
			}
			function valideopenerform2(url){
			var popy= window.open(url,"history","toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
			if (window.focus) {popy.focus()}
			    return false;
			}
	</script>
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

    $title	= 'List Customer';
    $submenu	= "voip_customers";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
   } 
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>