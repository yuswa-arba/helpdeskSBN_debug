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
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List Refiils Voip");
    global $conn;
    global $conn_voip;
    
    $new_search = isset($_GET['search']) ? $_GET['search'] : '';
$id_ref = isset($_GET['id_ref']) ? $_GET['id_ref'] : '';
$del    = isset($_GET['del']) ? $_GET['del'] : '';
if($id_ref !== '' && $del=='true'){
   $sql_del = mysql_query("DELETE FROM `cc_logrefill` WHERE `id`='$id_ref'", $conn_voip);
   header('location:log_refill.php');
}

if($new_search == 'search'){
$fromstatsday_sday                          = isset($_GET['fromstatsday_sday']) ? mysql_real_escape_string(trim($_GET['fromstatsday_sday'])) : '';
$fromstatsmonth_sday                        = isset($_GET['fromstatsmonth_sday']) ? mysql_real_escape_string(trim($_GET['fromstatsmonth_sday'])) : '';
$tostatsday_sday                            = isset($_GET['tostatsday_sday']) ? mysql_real_escape_string(trim($_GET['tostatsday_sday'])) : '';
$tostatsmonth_sday                          = isset($_GET['tostatsmonth_sday']) ? mysql_real_escape_string(trim($_GET['tostatsmonth_sday'])) : '';
$var_username                               = isset($_GET['var_username']) ? mysql_real_escape_string(trim($_GET['var_username'])) : '';
$var_firstname                              = isset($_GET['var_firstname']) ? mysql_real_escape_string(trim($_GET['var_firstname'])) : '';
$var_lastname                               = isset($_GET['var_lastname']) ? mysql_real_escape_string(trim($_GET['var_lastname'])) : '';
$from_date                                  = implode('-', array($fromstatsmonth_sday, $fromstatsday_sday));
$to_date                                    = implode('-', array($tostatsmonth_sday, $tostatsday_sday));  


$sql_from_to_day                            = "(`cc_logrefill`.`date` BETWEEN '$from_date 00:00:00' AND '$to_date 23:59:59')";        
$sql_username                               = "`cc_card`.`username` LIKE '%".$var_username."%'";
$sql_lastname                               = "`cc_card`.`lastname` LIKE '%".$var_lastname."%'";
$sql_firstname                              = "`cc_card`.`firstname` LIKE '%".$var_firstname."%'";

$sql_cc_logrefill = mysql_query("SELECT `cc_logrefill`.`id`, `cc_logrefill`.`date`, `cc_logrefill`.`credit`, `cc_logrefill`.`card_id`,
                                                                        `cc_logrefill`.`description`, `cc_logrefill`.`refill_type`, `cc_logrefill`.`added_invoice`, `cc_logrefill`.`agent_id`,
                                                                        `cc_card`.`creationdate`, `cc_card`.`firstusedate`, `cc_card`.`expirationdate`, `cc_card`.`enableexpire`,
                                                                        `cc_card`.`expiredays`, `cc_card`.`username`, `cc_card`.`useralias`, `cc_card`.`uipass`, `cc_card`.`tariff`,
                                                                        `cc_card`.`id_didgroup`, `cc_card`.`activated`, `cc_card`.`status`, `cc_card`.`lastname`, `cc_card`.`firstname`, `cc_card`.`address`,
                                                                        `cc_card`.`city`, `cc_card`.`state`, `cc_card`.`country`, `cc_card`.`zipcode`, `cc_card`.`phone`, `cc_card`.`email`, `cc_card`.`fax`,
                                                                        `cc_card`.`inuse`, `cc_card`.`simultaccess`, `cc_card`.`currency`, `cc_card`.`lastuse`, `cc_card`.`nbused`, `cc_card`.`typepaid`,
                                                                        `cc_card`.`creditlimit`, `cc_card`.`voipcall`, `cc_card`.`sip_buddy`, `cc_card`.`iax_buddy`, `cc_card`.`language`, `cc_card`.`redial`,
                                                                        `cc_card`.`runservice`, `cc_card`.`nbservice`, `cc_card`.`id_campaign`, `cc_card`.`num_trials_done`, `cc_card`.`vat`, `cc_card`.`servicelastrun`,
                                                                        `cc_card`.`initialbalance`, `cc_card`.`invoiceday`, `cc_card`.`autorefill`, `cc_card`.`loginkey`, `cc_card`.`mac_addr`, `cc_card`.`id_timezone`, `cc_card`.`tag`,
                                                                        `cc_card`.`voicemail_permitted`, `cc_card`.`voicemail_activated`, `cc_card`.`last_notification`, `cc_card`.`email_notification`, `cc_card`.`notify_email`, `cc_card`.`credit_notification`,
                                                                        `cc_card`.`id_group`, `cc_card`.`company_name`, `cc_card`.`company_website`, `cc_card`.`vat_rn`, `cc_card`.`traffic`, `cc_card`.`traffic_target`, `cc_card`.`discount`, `cc_card`.`restriction`,
                                                                        `cc_card`.`id_seria`, `cc_card`.`serial`, `cc_card`.`block`, `cc_card`.`lock_pin`, `cc_card`.`lock_date`
                                                                        FROM `cc_logrefill`, `cc_card` WHERE `cc_logrefill`.`card_id`=`cc_card`.`id` AND $sql_from_to_day AND $sql_username AND $sql_lastname AND $sql_firstname
                                                                        ORDER BY `cc_logrefill`.`date` DESC;", $conn_voip);


}else{
$sql_cc_logrefill = mysql_query("SELECT `cc_logrefill`.`id`, `cc_logrefill`.`date`, `cc_logrefill`.`credit`, `cc_logrefill`.`card_id`,
                                                                        `cc_logrefill`.`description`, `cc_logrefill`.`refill_type`, `cc_logrefill`.`added_invoice`, `cc_logrefill`.`agent_id`,
                                                                        `cc_card`.`creationdate`, `cc_card`.`firstusedate`, `cc_card`.`expirationdate`, `cc_card`.`enableexpire`,
                                                                        `cc_card`.`expiredays`, `cc_card`.`username`, `cc_card`.`useralias`, `cc_card`.`uipass`, `cc_card`.`tariff`,
                                                                        `cc_card`.`id_didgroup`, `cc_card`.`activated`, `cc_card`.`status`, `cc_card`.`lastname`, `cc_card`.`firstname`, `cc_card`.`address`,
                                                                        `cc_card`.`city`, `cc_card`.`state`, `cc_card`.`country`, `cc_card`.`zipcode`, `cc_card`.`phone`, `cc_card`.`email`, `cc_card`.`fax`,
                                                                        `cc_card`.`inuse`, `cc_card`.`simultaccess`, `cc_card`.`currency`, `cc_card`.`lastuse`, `cc_card`.`nbused`, `cc_card`.`typepaid`,
                                                                        `cc_card`.`creditlimit`, `cc_card`.`voipcall`, `cc_card`.`sip_buddy`, `cc_card`.`iax_buddy`, `cc_card`.`language`, `cc_card`.`redial`,
                                                                        `cc_card`.`runservice`, `cc_card`.`nbservice`, `cc_card`.`id_campaign`, `cc_card`.`num_trials_done`, `cc_card`.`vat`, `cc_card`.`servicelastrun`,
                                                                        `cc_card`.`initialbalance`, `cc_card`.`invoiceday`, `cc_card`.`autorefill`, `cc_card`.`loginkey`, `cc_card`.`mac_addr`, `cc_card`.`id_timezone`, `cc_card`.`tag`,
                                                                        `cc_card`.`voicemail_permitted`, `cc_card`.`voicemail_activated`, `cc_card`.`last_notification`, `cc_card`.`email_notification`, `cc_card`.`notify_email`, `cc_card`.`credit_notification`,
                                                                        `cc_card`.`id_group`, `cc_card`.`company_name`, `cc_card`.`company_website`, `cc_card`.`vat_rn`, `cc_card`.`traffic`, `cc_card`.`traffic_target`, `cc_card`.`discount`, `cc_card`.`restriction`,
                                                                        `cc_card`.`id_seria`, `cc_card`.`serial`, `cc_card`.`block`, `cc_card`.`lock_pin`, `cc_card`.`lock_date`
                                                                        FROM `cc_logrefill`, `cc_card` WHERE `cc_logrefill`.`card_id`=`cc_card`.`id`
                                                                        ORDER BY `cc_logrefill`.`date` DESC;", $conn_voip);   
} 
    
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
				    <h3 class="box-title">Refills</h3>
                                    
                                    
                                </div>

                                <div class="box-body table-responsive">
                                    <table class="searchhandler_table1">
		<form action="" method="GET" class="sidebar-form">
					<tr>
        		<td align="left" class="bgcolor_002">
					<font class="fontstyle_003"><label>DATE</label></font>
				&nbsp;&nbsp;</td>
      			<td align="left" class="bgcolor_003">
					<table  border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr><td class="fontstyle_searchoptions">
                                       	From : <select name="fromstatsday_sday" class="form_input_select">';
                                        $bil_tgl = date("d");
                                        $content .= '<option value="00" selected>-Select Day From-</option>';
                                        for($bil=1; $bil<=31; $bil++){
                                                if($bil == $bil_tgl){
                                                    $content .= '<option value="'.($bil < 10 ? '0'.$bil  : $bil).'">'.($bil < 10 ? '0'.$bil  : $bil).'</option>';
                                                }else{
                                                    $content .= '<option value="'.($bil < 10 ? '0'.$bil  : $bil).'">'.($bil < 10 ? '0'.$bil  : $bil).'</option>';
                                                }
                                        }
					$content .= '
                                        </select>
                                        <select name="fromstatsmonth_sday" class="form_input_select">
					';
                                            $time_H = date("H");
                                            $time_i = date("i");
                                            $time_s = date("s");
                                            $time_m = date("m");
                                            $time_d = date("d");
                                            $time_Y = date("Y");
                                            for($month_r=1; $month_r<=36; $month_r++){
                                                if($month_r == 1){
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m + $month_r - 1), $time_d, $time_Y))).'"  selected>'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
                                                }else{
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m + $month_r - 1), $time_d, $time_Y))).'" >'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
                                                }
                                            }
                                        $content .= '</select>
					</td><td class="fontstyle_searchoptions">
					 &nbsp;&nbsp; To : <select name="tostatsday_sday" class="form_input_select">
                                        ';
					$bil_tgl = date("d");
                                        $content .= '<option value="00">-Select Day To-</option>';
                                        for($bil=1; $bil<=31; $bil++){
                                                    
                                                if($bil == $bil_tgl){
                                                    $content .= '<option value="'.$bil.'" selected>'.($bil < 10 ? '0'.$bil  : $bil).'</option>';
                                                }else{
                                                    $content .= '<option value="'.$bil.'">'.($bil < 10 ? '0'.$bil  : $bil).'</option>';
                                                }
                                        }
                                        
                                        $content .= '
                                        </select>
				 	<select name="tostatsmonth_sday" class="form_input_select">';
                                            $time_H = date("H");
                                            $time_i = date("i");
                                            $time_s = date("s");
                                            $time_m = date("m");
                                            $time_d = date("d");
                                            $time_Y = date("Y");
                                            for($month_r=1; $month_r<=36; $month_r++){
                                                if($month_r == 1){
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m + $month_r - 1), $time_d, $time_Y))).'"  selected>'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
                                                }else{
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m + $month_r - 1), $time_d, $time_Y))).'" >'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
                                                }
                                            }
                                        $content .= '</select>
					</td></tr></table>
	  			</td>
    		</tr>
				
				
		
				
		
		<!-- compare with a value //-->
					<tr>
				<td class="bgcolor_004" align="left">
					<label><font class="fontstyle_003">ACCOUNT NUMBER</font>&nbsp;&nbsp;</label>
				</td>
				<td class="bgcolor_005" align="left" >
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td class="fontstyle_searchoptions">&nbsp;&nbsp;<INPUT TYPE="text" NAME="var_username" value="" class="form-control"></td>

				</tr></table></td>
			</tr>
						<!-- compare between 2 values //-->
									<tr>
        		<td class="bgcolor_004" align="left"> </td>
				<td class="bgcolor_005" align="center">
					<input type="submit"  name="search" align="top" border="0" class="btn btn-default btn-sm" value="search">
						  			</td>
    		</tr>
		</tbody></table>
	</FORM>
        <hr>
        <div class="box-tools pull-right">
            <a href="form_refill.php" class="btn bg-olive btn-flat margin">Add Refill</a>
       </div>
        
        <table id="refill" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>No.</th>
                                                <th style="width: 110px">Card Number</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Refill Amount</th>
                                                <th>Refill Type</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					
$no = 1;
while($row_logrefill = mysql_fetch_array($sql_cc_logrefill)){
    $content .= '
    <tr>
        <td>'.$no.'</td>
        <td><a href="#" onclick="load_url(\'detail_cust?cust_numb='.$row_logrefill['username'].'\')">'.$row_logrefill['username'].'</a></td>
        <td>'.$row_logrefill['firstname'].' '.$row_logrefill['lastname'].'</td>
        <td>'.$row_logrefill['date'].'</td>
        <td>'.$row_logrefill['credit'].'</td>
        <td>';
        if($row_logrefill['refill_type'] == '0'){
            $content .= 'AMOUNT';
        }
        elseif($row_logrefill['refill_type'] == '1'){
            $content .= 'CORRECTION';
        }
        elseif($row_logrefill['refill_type'] == '2'){
            $content .= 'EXTRA FEE';
        }
        elseif($row_logrefill['refill_type'] == '3'){
            $content .= 'AGENT REFUND';
        }
        $content .= '</td>
        <td><a href="info_log_refill.php?id_info='.$row_logrefill['id'].'">Info</a> ||
        <a href="form_refill.php?id='.$row_logrefill['id'].'">Edit</a> ||
        <a href="?del=true&id_ref='.$row_logrefill['id'].'">Delete</a>   </td>
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
                $(\'#refill\').dataTable({
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

    $title	= 'Log Refiils';
    $submenu	= "log_refills";
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