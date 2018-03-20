<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */

 
 
/*
$temp = date("Y-m-01");
$datetime = new DateTime($temp);
$datetime_end = new DateTime($temp);
$datetime_end->modify("+1 month");
$datetime->modify("-11 month");
$checkdate_month= $datetime->format("Y-m-d");
$datetime->modify("-15 day");
$begin_date_graphe = $datetime->format("Y-m-d");
$end_date_graphe = $datetime_end->format("Y-m-01");
$mingraph_month = strtotime($begin_date_graphe);
$maxgraph_month = strtotime($end_date_graphe);

//day view
$temp = date("Y-m-d");
$datetime = new DateTime($temp);
$datetime_end = new DateTime($temp);
$datetime_end->modify("+1 day");
$datetime->modify("-7 day");
$checkdate_day = $datetime->format("Y-m-d");
$datetime->modify("-12 hour");
$begin_date_graphe =  $datetime->format("Y-m-d HH");
$end_date_graphe = $datetime_end->format("Y-m-d");
$mingraph_day = strtotime($begin_date_graphe);
$maxgraph_day = strtotime($end_date_graphe);


if (!empty($type)) {
    $format='';
    $DBHandle = DbConnect();
    $table = new Table('cc_logrefill','*');
    switch ($type) {
		case 'refills_count':
		    if($view_type == "month"){
			$QUERY = "SELECT UNIX_TIMESTAMP( DATE_FORMAT( date, '%Y-%m-01' ) )*1000 AS this_month , count( * )  FROM cc_logrefill WHERE date >= TIMESTAMP( '$checkdate_month' ) AND date <=CURRENT_TIMESTAMP GROUP BY this_month ORDER BY this_month;";
		    }else{
			$QUERY = "SELECT UNIX_TIMESTAMP( DATE_FORMAT( date, '%Y-%m-%d' ) )*1000 AS this_day , count( * )  FROM cc_logrefill WHERE date >= TIMESTAMP( '$checkdate_day' ) AND date <=CURRENT_TIMESTAMP GROUP BY this_day ORDER BY this_day;";
		    }
		    break;
		case 'refills_amount':
		    
		    if($view_type == "month"){
			$QUERY = "SELECT UNIX_TIMESTAMP( DATE_FORMAT( date, '%Y-%m-01' ) )*1000 AS this_month , SUM( credit )  FROM cc_logrefill WHERE date >= TIMESTAMP( '$checkdate_month' ) AND date <=CURRENT_TIMESTAMP GROUP BY this_month ORDER BY this_month;";
		    }else{
			$QUERY = "SELECT UNIX_TIMESTAMP( DATE_FORMAT( date, '%Y-%m-%d' ) )*1000 AS this_day , SUM( credit )  FROM cc_logrefill WHERE date >= TIMESTAMP( '$checkdate_day' ) AND date <=CURRENT_TIMESTAMP GROUP BY this_day ORDER BY this_day;";
		    }
		    $format='money';
		    break;
    }
	
    $result_graph = $table->SQLExec($DBHandle, $QUERY);
    $max = 0;
    $data = array();
    if (is_array($result_graph)) {
	    for ($i = 0; $i < count($result_graph); $i++) {
		    $max = max($max,$result_graph[$i][1]);
		    $data[]= array($result_graph[$i][0],floatval($result_graph[$i][1]));
	    }
    }
    $response = array('max'=> floatval($max), 'data'=>$data ,'format' => $format);
    if($DEBUG_MODULE) $response['query'] = $QUERY;
    echo json_encode($response);
    die();
}
?>


<center><b><?php echo gettext("Report by"); ?></b></center><br/>
<center><?php echo gettext("Days"); ?> &nbsp;<input id="view_refill_day" type="radio" class="period_refills_graph" name="view_refill" value="day" > &nbsp;

<?php echo gettext("Months"); ?> &nbsp;<input id="view_refill_month" type="radio" class="period_refills_graph" name="view_refill" value="month"></center> <br/>
<b><?php echo gettext("Customer type :"); ?></b><br/>
<input id="refills_count" type="radio" name="mode_refill" class="update_refills_graph" value="count">&nbsp; <?php echo gettext("Number of Refills"); ?><br/>
<input id="refills_amount" type="radio" name="mode_refill" class="update_refills_graph" value="amount">&nbsp; <?php echo gettext("Total Amount of Refills"); ?><br/>
<br/>
<div id="refills_graph" class="dashgraph" style="margin-left: auto;margin-right: auto;"></div>

*/
 
 
 
 
include ("../../config/configuration_admin.php");


redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
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
$fromstatsday_sday                          = isset($_GET['fromstatsday_sday']) ? $_GET['fromstatsday_sday'] : ''; //day selected
$fromstatsmonth_sday                        = isset($_GET['fromstatsmonth_sday']) ? $_GET['fromstatsmonth_sday'] : ''; //month selected
$tostatsday_sday                            = isset($_GET['tostatsday_sday']) ? $_GET['tostatsday_sday'] : '';
$tostatsmonth_sday                          = isset($_GET['tostatsmonth_sday']) ? $_GET['tostatsmonth_sday'] : '';
$var_username                               = isset($_GET['var_username']) ? $_GET['var_username'] : '';
$var_firstname                              = isset($_GET['var_firstname']) ? $_GET['var_firstname'] : '';
$var_lastname                               = isset($_GET['var_lastname']) ? $_GET['var_lastname'] : '';
$from_date                                  = implode('-', array($fromstatsmonth_sday, $fromstatsday_sday));
$to_date                                    = implode('-', array($tostatsmonth_sday, $tostatsday_sday));  


$sql_from_to_day                            = "(`cc_logrefill`.`date` BETWEEN '$from_date 00:00:00' AND '$to_date 23:59:59')";        
$sql_username                               = "`cc_card`.`username` LIKE '%$var_username%'";
$sql_lastname                               = "`cc_card`.`lastname` LIKE '%$var_lastname%'";
$sql_firstname                              = "`cc_card`.`firstname` LIKE '%$var_firstname%'";

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
                                                                        FROM `cc_logrefill`, `cc_card` WHERE `cc_logrefill`.`card_id`=`cc_card`.`id` AND $sql_from_to_day AND $sql_username AND $sql_lastname AND $sql_firstname", $conn_voip);


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
                                                                        FROM `cc_logrefill`, `cc_card` WHERE `cc_logrefill`.`card_id`=`cc_card`.`id`", $conn_voip);   
} 
    
    
            
    $content =' 
                <!-- Main content -->
                <section class="content">

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Log Refill</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">';


$content .= '
	<center>
		<b>Define criteria to make a precise search</b>
		<table class="searchhandler_table1">
		<form action="" method="GET" class="sidebar-form">
		<INPUT TYPE="hidden" NAME="posted_search" value="1">
		<INPUT TYPE="hidden" NAME="current_page" value="0">
 		
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

						<tr>
				<td class="bgcolor_002" align="left">
					<label><font class="fontstyle_003">LASTNAME&nbsp;&nbsp; </font></label>
				</td>
				<td class="bgcolor_003" align="left" >
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td class="fontstyle_searchoptions">&nbsp;&nbsp;<INPUT TYPE="text" NAME="var_lastname" value="" class="form-control"></td>

				</tr></table></td>
			</tr>

						<tr>
				<td class="bgcolor_004" align="left">
					<label><font class="fontstyle_003">FIRSTNAME&nbsp;&nbsp;</font></label>
				</td>
				<td class="bgcolor_005" align="left" >
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td class="fontstyle_searchoptions">&nbsp;&nbsp;<INPUT TYPE="text" NAME="var_firstname" value="" class="form-control"></td>

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
</center>';


               
$content .= '	<table align="right"><tr align="right">
        <td align="right"> 
					<a href="add_log_refill.php" class="btn btn-primary btn-sm"> Add Refill </a>
				&nbsp;
				  </td>
	 </tr></table>

	<br><br>';
// ID 	ACCOUNT 	REFILL DATE 	REFILL AMOUNT 	REFILL TYPE 	ACTION	
// id 	creationdate 	firstusedate 	expirationdate 	enableexpire 	expiredays 	username 	useralias 	uipass 	credit 	tariff 	id_didgroup 	activated 	status 	lastname 	firstname 	address 	city 	state 	country 	zipcode 	phone 	email 	fax 	inuse 	simultaccess 	currency 	lastuse 	nbused 	typepaid 	creditlimit 	voipcall 	sip_buddy 	iax_buddy 	language 	redial 	runservice 	nbservice 	id_campaign 	num_trials_done 	vat 	servicelastrun 	initialbalance 	invoiceday 	autorefill 	loginkey 	mac_addr 	id_timezone 	tag 	voicemail_permitted 	voicemail_activated 	last_notification 	email_notification 	notify_email 	credit_notification 	id_group 	company_name 	company_website 	vat_rn 	traffic 	traffic_target 	discount 	restriction 	id_seria 	serial 	block 	lock_pin 	lock_date
$content .= '<table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>ACCOUNT</th>
                                                <th>REFILL DATE</th>
                                                <th>REFILL AMOUNT</th>
                                                <th>REFILL TYPE</th>
						<th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					
					
					while($row_logrefill = mysql_fetch_array($sql_cc_logrefill)){
					    $content .= '
					    <tr>
						<td>'.$row_logrefill['id'].'</td>
						<td><a href="#" onclick="load_url(\'detail_cust?cust_numb='.$row_logrefill['username'].'\')">'.$row_logrefill['username'].'</a></td>
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
						<td><a href="info_log_refill.php?id_info='.$row_logrefill['id'].'">Info</a> || <a href="edit_log_refill.php?id_edit='.$row_logrefill['id'].'">Edit</a> || <a href="?del=true&id_ref='.$row_logrefill['id'].'">Delete</a>   </td>
					    </tr>';
					}
					
$content .= '                           </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>ACCOUNT</th>
                                                <th>REFILL DATE</th>
                                                <th>REFILL AMOUNT</th>
                                                <th>REFILL TYPE</th>
						<th>ACTION</th>
                                            </tr>
                                        </tfoot>
                                    </table>';	
	
$content .= '</div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->';	        
$plugins = '
<!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
<!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>
        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $(\'#example2\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
        <script Language="JavaScript">
	function load_url(link) {
	var link;
	var load_url = window.open(link,\'\',\'height=600,width=950,resizable=yes,scrollbars=yes\');
	}
	</script>
	
		 
<script id="source" language="javascript" type="text/javascript">
  	
$(document).ready(function () {
var format = "";
var period_val="";
var x_format = "";
var width= Math.min($("#refills_graph").parent("div").width(),$("#refills_graph").parent("div").innerWidth());
$("#refills_graph").width(width-10);
$("#refills_graph").height(Math.floor(width/2));


$(\'.update_refills_graph\').click(function () {
    $.getJSON("modules/refills_lastmonth.php", { type: this.id , view_type : period_val},
		      function(data){
				<?php if($DEBUG_MODULE)echo "alert(data.query);alert(data.data);"?>
				var graph_max = data.max;
				var graph_data = new Array();
				for (i = 0; i < data.data.length; i++) {
				    graph_data[i] = new Array();
				    graph_data[i][0]= parseInt(data.data[i][0]);
				    graph_data[i][1]= data.data[i][1]
				 }
				format = data.format;
				plot_graph_refills(graph_data,graph_max);
			 });

   });
$(\'.period_refills_graph\').change(function () {
    period_val = $(this).val();
    if($(this).val() == "month" ) x_format ="%b";
    else x_format ="%d-%m";
    $(\'.update_refills_graph:checked\').click();
   });

$(\'#view_refill_day\').click();
$(\'#view_refill_day\').change();

function plot_graph_refills(data,max){
    var d= data;
    var max_data = (max+5-(max%5));
    var min_month = $mingraph_month."000";
    var max_month = $maxgraph_month."000";
    var min_day = $mingraph_day."000";
    var max_day = $maxgraph_day."000";
    if(period_val=="month"){
	var min_graph = min_month;
	var max_graph = max_month;
	var bar_width = 28*24 * 60 * 60 * 1000;
    }else{
	var min_graph = min_day;
	var max_graph = max_day;
	var bar_width = 24 * 60 * 60 * 1000;
    }

    $.plot($("#refills_graph"), [
				{
				    data: d,
				    bars: { show: true,
						barWidth: bar_width,
						align: "centered"
				    }
				}
				 ],
			    {   xaxis: {
				    mode: "time",
				    timeformat: x_format,
				    ticks :6,
					min : min_graph,
					max : max_graph
				  },
				  yaxis: {
				  max:max_data,
				  minTickSize: 1,
				  tickDecimals:0
				  },selection: { mode: "y" },
				 grid: { hoverable: true,clickable: true}
				  });

	}
 $(\'#refills_count\').click();
 
   function showTooltip(x, y, contents) {
        $(\'<div id="tooltip">\' + contents + \'</div>\').css( {
            position: \'absolute\',
            display: \'none\',
            top: y + 5,
            left: x + 5,
            border: \'1px solid #fdd\',
            padding: \'2px\',
            \'background-color\': \'#fee\',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    $("#refills_graph").bind("plothover", function (event, pos, item) {
            if (item) {
                if (previousPoint != item.datapoint) {
                    previousPoint = item.datapoint;
                    
                    $("#tooltip").remove();
		    if(format=="money"){
                    	 var y = item.datapoint[1].toFixed(2);
                    	 showTooltip(item.pageX, item.pageY, y+" <?php echo $A2B->config["global"]["base_currency"];?>");
                    }else{
                    	var y = item.datapoint[1].toFixed(0);
                    	showTooltip(item.pageX, item.pageY, y);
                    }
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
    });

    
  
  
});
  
</script>';

    $title	= 'Log Refill';
    $submenu	= "voip_refills";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ../logout.php");
    }

?>