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

$new_search = isset($_POST['search']) ? $_POST['search'] : '';

if($new_search == 'search'){
    
$fromday                                    = isset($_POST['fromday']) ? $_POST['fromday'] : ''; //checked from
$fromstatsday_sday                          = isset($_POST['fromstatsday_sday']) ? $_POST['fromstatsday_sday'] : ''; //day selected
$fromstatsmonth_sday                        = isset($_POST['fromstatsmonth_sday']) ? $_POST['fromstatsmonth_sday'] : ''; //month selected
$today                                      = isset($_POST['today']) ? $_POST['today'] : ''; 
$tostatsday_sday                            = isset($_POST['tostatsday_sday']) ? $_POST['tostatsday_sday'] : '';
$tostatsmonth_sday                          = isset($_POST['tostatsmonth_sday']) ? $_POST['tostatsmonth_sday'] : '';
$username                                   = isset($_POST['username']) ? $_POST['username'] : '';
$usernametype                               = isset($_POST['usernametype']) && $username!='' ? $_POST['usernametype'] : '';
$firstname                                  = isset($_POST['firstname']) ? $_POST['firstname'] : '';
$firstnametype                              = isset($_POST['firstnametype']) && $firstname!='' ? $_POST['firstnametype'] : '';  
$lastname                                   = isset($_POST['lastname']) ? $_POST['lastname'] : '';
$lastnametype                               = isset($_POST['lastnametype']) && $lastname!='' ? $_POST['lastnametype'] : '';  
$from_date                                  = implode('-', array($fromstatsmonth_sday, $fromstatsday_sday));
$to_date                                    = implode('-', array($tostatsmonth_sday, $tostatsday_sday));  


if((isset($_POST['username']) && $username!='' && $usernametype!='') || (isset($_POST['lastname']) && $lastname!='') || (isset($_POST['firstname']) && $firstname!='')){
    if(isset($_POST['fromday']) && isset($_POST['today']) && $from_date!='' && $to_date!=''){    
            $sql_from_to_day = isset($_POST['fromday']) && isset($_POST['today']) && $from_date!='' && $to_date!='' ? "(`cc_logrefill`.`date` BETWEEN '$from_date 00:00:00' AND '$to_date 23:59:59')" : "";    
    }elseif(isset($_POST['fromday']) && $from_date!=''){
            $sql_from_to_day = isset($_POST['fromday']) && $from_date!='' ? "`cc_logrefill`.`date`>='$from_date 00:00:00'" : "";    
    }elseif(isset($_POST['today']) && $to_date!='' ){
            $sql_from_to_day = isset($_POST['today']) && $to_date!='' ? "`cc_logrefill`.`date`<='$to_date 23:59:59'" : "";
    }else{
            $sql_from_to_day = "";
    }
}else{
    if(isset($_POST['fromday']) && isset($_POST['today']) && $from_date!='' && $to_date!=''){    
            $sql_from_to_day = isset($_POST['fromday']) && isset($_POST['today']) && $from_date!='' && $to_date!='' ? "`cc_logrefill`.`date` BETWEEN '$from_date 00:00:00' AND '$to_date 23:59:59'" : "";    
    }elseif(isset($_POST['fromday']) && $from_date!=''){
            $sql_from_to_day = isset($_POST['fromday']) && $from_date!='' ? "`cc_logrefill`.`date`>='$from_date 00:00:00'" : "";    
    }elseif(isset($_POST['today']) && $to_date!='' ){
            $sql_from_to_day = isset($_POST['today']) && $to_date!='' ? "`cc_logrefill`.`date`<='$to_date 23:59:59'" : "";
    }else{
            $sql_from_to_day = "";
    }
}

$sql_connector_from_to_day_with_username    = isset($_POST['fromday']) && isset($_POST['today']) && isset($_POST['username']) && $username!='' ? "AND" : "";

if($usernametype == '1' && $username!=''){
$sql_username                               = isset($_POST['username']) && $username!='' ? "`cc_card`.`username`='$username'" : "";
}elseif($usernametype == '2' && $username!=''){
$sql_username                               = isset($_POST['username']) && $username!='' ? "`cc_card`.`username` LIKE '%$username'" : "";
}elseif($usernametype == '3' && $username!=''){
$sql_username                               = isset($_POST['username']) && $username!='' ? "`cc_card`.`username` LIKE '%$username%'" : "";
}elseif($usernametype == '4' && $username!=''){
$sql_username                               = isset($_POST['username']) && $username!='' ? "`cc_card`.`username` LIKE '$username%'" : "";
}else{
$sql_username                               = "";
}


$sql_connector_from_to_day_with_lastname    = isset($_POST['fromday']) && isset($_POST['today']) && isset($_POST['lastname']) && $lastname!='' && is_null($_POST['username']) && $username='' && is_null($_POST['firstname']) && $firstname='' ? "AND" : "";

$sql_connector_username_with_lastname       = isset($_POST['username']) && $username!='' && isset($_POST['lastname']) && $lastname!='' ? "AND" : "";

if($lastnametype == '1' && $lastname!=''){
$sql_lastname                               = isset($_POST['lastname']) && $lastname!='' ? "`cc_card`.`lastname`='$lastname'" : "";
}elseif($lastnametype == '2' && $lastname!=''){
$sql_lastname                               = isset($_POST['lastname']) && $lastname!='' ? "`cc_card`.`lastname` LIKE '%$lastname'" : "";
}elseif($lastnametype == '3' && $lastname!=''){
$sql_lastname                               = isset($_POST['lastname']) && $lastname!='' ? "`cc_card`.`lastname` LIKE '%$lastname%'" : "";
}elseif($lastnametype == '4' && $lastname!=''){
$sql_lastname                               = isset($_POST['lastname']) && $lastname!='' ? "`cc_card`.`lastname` LIKE '$lastname%'" : "";
}else{
$sql_lastname                               = "";
}


$sql_connector_from_to_day_with_firstname   = isset($_POST['fromday']) && isset($_POST['today']) && isset($_POST['firstname']) && $firstname!='' && is_null($_POST['lastname']) && $lastname='' && isset($_POST['username']) && $username!='' ? "AND" : "";

$sql_connector_username_with_firstname      = isset($_POST['username']) && $username!='' && isset($_POST['firstname']) && $firstname!='' && is_null($_POST['lastname']) && $lastname='' && is_null($_POST['fromday']) && is_null($_POST['today']) ? "AND" : "";

$sql_connector_lastname_with_firstname      = isset($_POST['lastname']) && $lastname!='' && isset($_POST['firstname']) && $firstname!='' ? "AND" : "";

if($firstnametype == '1' && $firstname!=''){
$sql_firstname                              = isset($_POST['firstname']) && $firstname!='' ? "`cc_card`.`firstname`='$firstname'" : "";
}elseif($firstnametype == '2' && $firstname!=''){
$sql_firstname                              = isset($_POST['firstname']) && $firstname!='' ? "`cc_card`.`firstname` LIKE '%$firstname'" : "";
}elseif($firstnametype == '3' && $firstname!=''){
$sql_firstname                              = isset($_POST['firstname']) && $firstname!='' ? "`cc_card`.`firstname` LIKE '%$firstname%'" : "";
}elseif($firstnametype == '4' && $firstname!=''){
$sql_firstname                              = isset($_POST['firstname']) && $firstname!='' ? "`cc_card`.`firstname` LIKE '$firstname%'" : "";
}else{
$sql_firstname                              = "";    
}

$sql_where                                  = ($to_date!='') || ($from_date!='') || (isset($_POST['username']) && $username!='' && $usernametype!='') || (isset($_POST['lastname']) && $lastname!='') || (isset($_POST['firstname']) && $firstname!='') ? "WHERE" : "";

$sql_cc_logrefill = mysql_query("SELECT `cc_logrefill`.`id`, `cc_logrefill`.`date`, `cc_logrefill`.`credit`, `cc_logrefill`.`card_id`,
                                                                        `cc_logrefill`.`description`, `cc_logrefill`.`refill_type`, `cc_logrefill`.`added_invoice`, `cc_logrefill`.`agent_id`,
                                                                        `cc_card`.`id`, `cc_card`.`creationdate`, `cc_card`.`firstusedate`, `cc_card`.`expirationdate`, `cc_card`.`enableexpire`,
                                                                        `cc_card`.`expiredays`, `cc_card`.`username`, `cc_card`.`useralias`, `cc_card`.`uipass`, `cc_card`.`credit`, `cc_card`.`tariff`,
                                                                        `cc_card`.`id_didgroup`, `cc_card`.`activated`, `cc_card`.`status`, `cc_card`.`lastname`, `cc_card`.`firstname`, `cc_card`.`address`,
                                                                        `cc_card`.`city`, `cc_card`.`state`, `cc_card`.`country`, `cc_card`.`zipcode`, `cc_card`.`phone`, `cc_card`.`email`, `cc_card`.`fax`,
                                                                        `cc_card`.`inuse`, `cc_card`.`simultaccess`, `cc_card`.`currency`, `cc_card`.`lastuse`, `cc_card`.`nbused`, `cc_card`.`typepaid`,
                                                                        `cc_card`.`creditlimit`, `cc_card`.`voipcall`, `cc_card`.`sip_buddy`, `cc_card`.`iax_buddy`, `cc_card`.`language`, `cc_card`.`redial`,
                                                                        `cc_card`.`runservice`, `cc_card`.`nbservice`, `cc_card`.`id_campaign`, `cc_card`.`num_trials_done`, `cc_card`.`vat`, `cc_card`.`servicelastrun`,
                                                                        `cc_card`.`initialbalance`, `cc_card`.`invoiceday`, `cc_card`.`autorefill`, `cc_card`.`loginkey`, `cc_card`.`mac_addr`, `cc_card`.`id_timezone`, `cc_card`.`tag`,
                                                                        `cc_card`.`voicemail_permitted`, `cc_card`.`voicemail_activated`, `cc_card`.`last_notification`, `cc_card`.`email_notification`, `cc_card`.`notify_email`, `cc_card`.`credit_notification`,
                                                                        `cc_card`.`id_group`, `cc_card`.`company_name`, `cc_card`.`company_website`, `cc_card`.`vat_rn`, `cc_card`.`traffic`, `cc_card`.`traffic_target`, `cc_card`.`discount`, `cc_card`.`restriction`,
                                                                        `cc_card`.`id_seria`, `cc_card`.`serial`, `cc_card`.`block`, `cc_card`.`lock_pin`, `cc_card`.`lock_date`
                                                                        FROM `cc_logrefill`, `cc_card` $sql_where $sql_from_to_day $sql_connector_from_to_day_with_username $sql_username $sql_connector_from_to_day_with_lastname $sql_connector_username_with_lastname $sql_lastname $sql_connector_from_to_day_with_firstname $sql_connector_username_with_firstname $sql_connector_lastname_with_firstname $sql_firstname", $conn_voip);

echo"SELECT `cc_logrefill`.`id`, `cc_logrefill`.`date`, `cc_logrefill`.`credit`, `cc_logrefill`.`card_id`,
                                                                        `cc_logrefill`.`description`, `cc_logrefill`.`refill_type`, `cc_logrefill`.`added_invoice`, `cc_logrefill`.`agent_id`,
                                                                        `cc_card`.`id`, `cc_card`.`creationdate`, `cc_card`.`firstusedate`, `cc_card`.`expirationdate`, `cc_card`.`enableexpire`,
                                                                        `cc_card`.`expiredays`, `cc_card`.`username`, `cc_card`.`useralias`, `cc_card`.`uipass`, `cc_card`.`credit`, `cc_card`.`tariff`,
                                                                        `cc_card`.`id_didgroup`, `cc_card`.`activated`, `cc_card`.`status`, `cc_card`.`lastname`, `cc_card`.`firstname`, `cc_card`.`address`,
                                                                        `cc_card`.`city`, `cc_card`.`state`, `cc_card`.`country`, `cc_card`.`zipcode`, `cc_card`.`phone`, `cc_card`.`email`, `cc_card`.`fax`,
                                                                        `cc_card`.`inuse`, `cc_card`.`simultaccess`, `cc_card`.`currency`, `cc_card`.`lastuse`, `cc_card`.`nbused`, `cc_card`.`typepaid`,
                                                                        `cc_card`.`creditlimit`, `cc_card`.`voipcall`, `cc_card`.`sip_buddy`, `cc_card`.`iax_buddy`, `cc_card`.`language`, `cc_card`.`redial`,
                                                                        `cc_card`.`runservice`, `cc_card`.`nbservice`, `cc_card`.`id_campaign`, `cc_card`.`num_trials_done`, `cc_card`.`vat`, `cc_card`.`servicelastrun`,
                                                                        `cc_card`.`initialbalance`, `cc_card`.`invoiceday`, `cc_card`.`autorefill`, `cc_card`.`loginkey`, `cc_card`.`mac_addr`, `cc_card`.`id_timezone`, `cc_card`.`tag`,
                                                                        `cc_card`.`voicemail_permitted`, `cc_card`.`voicemail_activated`, `cc_card`.`last_notification`, `cc_card`.`email_notification`, `cc_card`.`notify_email`, `cc_card`.`credit_notification`,
                                                                        `cc_card`.`id_group`, `cc_card`.`company_name`, `cc_card`.`company_website`, `cc_card`.`vat_rn`, `cc_card`.`traffic`, `cc_card`.`traffic_target`, `cc_card`.`discount`, `cc_card`.`restriction`,
                                                                        `cc_card`.`id_seria`, `cc_card`.`serial`, `cc_card`.`block`, `cc_card`.`lock_pin`, `cc_card`.`lock_date`
                                                                        FROM `cc_logrefill`, `cc_card` $sql_where $sql_from_to_day $sql_connector_from_to_day_with_username $sql_username $sql_connector_from_to_day_with_lastname $sql_connector_username_with_lastname $sql_lastname $sql_connector_from_to_day_with_firstname $sql_connector_username_with_firstname $sql_connector_lastname_with_firstname $sql_firstname";  

}else{
$sql_cc_logrefill = mysql_query("SELECT `cc_logrefill`.`id`, `cc_logrefill`.`date`, `cc_logrefill`.`credit`, `cc_logrefill`.`card_id`,
                                                                        `cc_logrefill`.`description`, `cc_logrefill`.`refill_type`, `cc_logrefill`.`added_invoice`, `cc_logrefill`.`agent_id`,
                                                                        `cc_card`.`id`, `cc_card`.`creationdate`, `cc_card`.`firstusedate`, `cc_card`.`expirationdate`, `cc_card`.`enableexpire`,
                                                                        `cc_card`.`expiredays`, `cc_card`.`username`, `cc_card`.`useralias`, `cc_card`.`uipass`, `cc_card`.`credit`, `cc_card`.`tariff`,
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
    
    
            
    $content =' <!-- Content Header (Page header) -->
                <section class="content-header">
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">Log Refill</li>
                    </ol>
                </section>

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
		<FORM METHOD="POST" ACTION="">
		<INPUT TYPE="hidden" NAME="posted_search" value="1">
		<INPUT TYPE="hidden" NAME="current_page" value="0">
 		
					<tr>
        		<td align="left" class="bgcolor_002">
					&nbsp;&nbsp;<font class="fontstyle_003">DATE</font>
				</td>
      			<td align="left" class="bgcolor_003">
					<table  border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr><td class="fontstyle_searchoptions">
	  				<input type="checkbox" name="fromday" value="" > From : <select name="fromstatsday_sday" class="form_input_select">
                                        
					<option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
                                        </select>
                                        <select name="fromstatsmonth_sday" class="form_input_select">
					<OPTION value="2014-09" > September-2014 </option><OPTION value="2014-08" > August-2014 </option><OPTION value="2014-07" > July-2014 </option><OPTION value="2014-06" > June-2014 </option><OPTION value="2014-05" > May-2014 </option><OPTION value="2014-04" > April-2014 </option><OPTION value="2014-03" > March-2014 </option><OPTION value="2014-02" > February-2014 </option><OPTION value="2014-01" > January-2014 </option><OPTION value="2013-12" > December-2013 </option><OPTION value="2013-11" > November-2013 </option><OPTION value="2013-10" > October-2013 </option><OPTION value="2013-09" > September-2013 </option><OPTION value="2013-08" > August-2013 </option><OPTION value="2013-07" > July-2013 </option><OPTION value="2013-06" > June-2013 </option><OPTION value="2013-05" > May-2013 </option><OPTION value="2013-04" > April-2013 </option><OPTION value="2013-03" > March-2013 </option><OPTION value="2013-02" > February-2013 </option><OPTION value="2013-01" > January-2013 </option><OPTION value="2012-12" > December-2012 </option><OPTION value="2012-11" > November-2012 </option><OPTION value="2012-10" > October-2012 </option><OPTION value="2012-09" > September-2012 </option><OPTION value="2012-08" > August-2012 </option><OPTION value="2012-07" > July-2012 </option><OPTION value="2012-06" > June-2012 </option><OPTION value="2012-05" > May-2012 </option><OPTION value="2012-04" > April-2012 </option><OPTION value="2012-03" > March-2012 </option><OPTION value="2012-02" > February-2012 </option><OPTION value="2012-01" > January-2012 </option><OPTION value="2011-12" > December-2011 </option><OPTION value="2011-11" > November-2011 </option><OPTION value="2011-10" > October-2011 </option><OPTION value="2011-09" > September-2011 </option><OPTION value="2011-08" > August-2011 </option><OPTION value="2011-07" > July-2011 </option><OPTION value="2011-06" > June-2011 </option><OPTION value="2011-05" > May-2011 </option><OPTION value="2011-04" > April-2011 </option><OPTION value="2011-03" > March-2011 </option><OPTION value="2011-02" > February-2011 </option><OPTION value="2011-01" > January-2011 </option><OPTION value="2010-12" > December-2010 </option><OPTION value="2010-11" > November-2010 </option><OPTION value="2010-10" > October-2010 </option><OPTION value="2010-09" > September-2010 </option><OPTION value="2010-08" > August-2010 </option><OPTION value="2010-07" > July-2010 </option><OPTION value="2010-06" > June-2010 </option><OPTION value="2010-05" > May-2010 </option><OPTION value="2010-04" > April-2010 </option><OPTION value="2010-03" > March-2010 </option><OPTION value="2010-02" > February-2010 </option><OPTION value="2010-01" > January-2010 </option><OPTION value="2009-12" > December-2009 </option><OPTION value="2009-11" > November-2009 </option><OPTION value="2009-10" > October-2009 </option><OPTION value="2009-09" > September-2009 </option><OPTION value="2009-08" > August-2009 </option><OPTION value="2009-07" > July-2009 </option><OPTION value="2009-06" > June-2009 </option><OPTION value="2009-05" > May-2009 </option><OPTION value="2009-04" > April-2009 </option><OPTION value="2009-03" > March-2009 </option><OPTION value="2009-02" > February-2009 </option><OPTION value="2009-01" > January-2009 </option><OPTION value="2008-12" > December-2008 </option><OPTION value="2008-11" > November-2008 </option><OPTION value="2008-10" > October-2008 </option><OPTION value="2008-09" > September-2008 </option><OPTION value="2008-08" > August-2008 </option><OPTION value="2008-07" > July-2008 </option><OPTION value="2008-06" > June-2008 </option><OPTION value="2008-05" > May-2008 </option><OPTION value="2008-04" > April-2008 </option><OPTION value="2008-03" > March-2008 </option><OPTION value="2008-02" > February-2008 </option><OPTION value="2008-01" > January-2008 </option><OPTION value="2007-12" > December-2007 </option><OPTION value="2007-11" > November-2007 </option><OPTION value="2007-10" > October-2007 </option><OPTION value="2007-09" > September-2007 </option><OPTION value="2007-08" > August-2007 </option><OPTION value="2007-07" > July-2007 </option><OPTION value="2007-06" > June-2007 </option><OPTION value="2007-05" > May-2007 </option><OPTION value="2007-04" > April-2007 </option><OPTION value="2007-03" > March-2007 </option><OPTION value="2007-02" > February-2007 </option><OPTION value="2007-01" > January-2007 </option><OPTION value="2006-12" > December-2006 </option><OPTION value="2006-11" > November-2006 </option><OPTION value="2006-10" > October-2006 </option><OPTION value="2006-09" > September-2006 </option><OPTION value="2006-08" > August-2006 </option><OPTION value="2006-07" > July-2006 </option><OPTION value="2006-06" > June-2006 </option><OPTION value="2006-05" > May-2006 </option><OPTION value="2006-04" > April-2006 </option><OPTION value="2006-03" > March-2006 </option><OPTION value="2006-02" > February-2006 </option><OPTION value="2006-01" > January-2006 </option><OPTION value="2005-12" > December-2005 </option><OPTION value="2005-11" > November-2005 </option><OPTION value="2005-10" > October-2005 </option><OPTION value="2005-09" > September-2005 </option><OPTION value="2005-08" > August-2005 </option><OPTION value="2005-07" > July-2005 </option><OPTION value="2005-06" > June-2005 </option><OPTION value="2005-05" > May-2005 </option><OPTION value="2005-04" > April-2005 </option><OPTION value="2005-03" > March-2005 </option><OPTION value="2005-02" > February-2005 </option><OPTION value="2005-01" > January-2005 </option><OPTION value="2004-12" > December-2004 </option><OPTION value="2004-11" > November-2004 </option><OPTION value="2004-10" > October-2004 </option><OPTION value="2004-09" > September-2004 </option><OPTION value="2004-08" > August-2004 </option><OPTION value="2004-07" > July-2004 </option><OPTION value="2004-06" > June-2004 </option><OPTION value="2004-05" > May-2004 </option><OPTION value="2004-04" > April-2004 </option><OPTION value="2004-03" > March-2004 </option><OPTION value="2004-02" > February-2004 </option><OPTION value="2004-01" > January-2004 </option>					</select>
					</td><td class="fontstyle_searchoptions">&nbsp;&nbsp;
					<input type="checkbox" name="today" value="" >To :					<select name="tostatsday_sday" class="form_input_select">
                                        ';
					$bil_tgl = date("d");
                                        for($bil=1; $bil<=31; $bil++){	
                                                if($bil == $bil_tgl){
                                                    $content .= '<option value="'.$bil.'" selected>'.$bil.'</option>';
                                                }else{
                                                    $content .= '<option value="'.$bil.'">'.$bil.'</option>';
                                                }
                                        }
                                        
                                        $content .= '
                                        </select>
				 	<select name="tostatsmonth_sday" class="form_input_select">
					<OPTION value="2014-09" > September-2014 </option><OPTION value="2014-08" > August-2014 </option><OPTION value="2014-07" > July-2014 </option><OPTION value="2014-06" > June-2014 </option><OPTION value="2014-05" > May-2014 </option><OPTION value="2014-04" > April-2014 </option><OPTION value="2014-03" > March-2014 </option><OPTION value="2014-02" > February-2014 </option><OPTION value="2014-01" > January-2014 </option><OPTION value="2013-12" > December-2013 </option><OPTION value="2013-11" > November-2013 </option><OPTION value="2013-10" > October-2013 </option><OPTION value="2013-09" > September-2013 </option><OPTION value="2013-08" > August-2013 </option><OPTION value="2013-07" > July-2013 </option><OPTION value="2013-06" > June-2013 </option><OPTION value="2013-05" > May-2013 </option><OPTION value="2013-04" > April-2013 </option><OPTION value="2013-03" > March-2013 </option><OPTION value="2013-02" > February-2013 </option><OPTION value="2013-01" > January-2013 </option><OPTION value="2012-12" > December-2012 </option><OPTION value="2012-11" > November-2012 </option><OPTION value="2012-10" > October-2012 </option><OPTION value="2012-09" > September-2012 </option><OPTION value="2012-08" > August-2012 </option><OPTION value="2012-07" > July-2012 </option><OPTION value="2012-06" > June-2012 </option><OPTION value="2012-05" > May-2012 </option><OPTION value="2012-04" > April-2012 </option><OPTION value="2012-03" > March-2012 </option><OPTION value="2012-02" > February-2012 </option><OPTION value="2012-01" > January-2012 </option><OPTION value="2011-12" > December-2011 </option><OPTION value="2011-11" > November-2011 </option><OPTION value="2011-10" > October-2011 </option><OPTION value="2011-09" > September-2011 </option><OPTION value="2011-08" > August-2011 </option><OPTION value="2011-07" > July-2011 </option><OPTION value="2011-06" > June-2011 </option><OPTION value="2011-05" > May-2011 </option><OPTION value="2011-04" > April-2011 </option><OPTION value="2011-03" > March-2011 </option><OPTION value="2011-02" > February-2011 </option><OPTION value="2011-01" > January-2011 </option><OPTION value="2010-12" > December-2010 </option><OPTION value="2010-11" > November-2010 </option><OPTION value="2010-10" > October-2010 </option><OPTION value="2010-09" > September-2010 </option><OPTION value="2010-08" > August-2010 </option><OPTION value="2010-07" > July-2010 </option><OPTION value="2010-06" > June-2010 </option><OPTION value="2010-05" > May-2010 </option><OPTION value="2010-04" > April-2010 </option><OPTION value="2010-03" > March-2010 </option><OPTION value="2010-02" > February-2010 </option><OPTION value="2010-01" > January-2010 </option><OPTION value="2009-12" > December-2009 </option><OPTION value="2009-11" > November-2009 </option><OPTION value="2009-10" > October-2009 </option><OPTION value="2009-09" > September-2009 </option><OPTION value="2009-08" > August-2009 </option><OPTION value="2009-07" > July-2009 </option><OPTION value="2009-06" > June-2009 </option><OPTION value="2009-05" > May-2009 </option><OPTION value="2009-04" > April-2009 </option><OPTION value="2009-03" > March-2009 </option><OPTION value="2009-02" > February-2009 </option><OPTION value="2009-01" > January-2009 </option><OPTION value="2008-12" > December-2008 </option><OPTION value="2008-11" > November-2008 </option><OPTION value="2008-10" > October-2008 </option><OPTION value="2008-09" > September-2008 </option><OPTION value="2008-08" > August-2008 </option><OPTION value="2008-07" > July-2008 </option><OPTION value="2008-06" > June-2008 </option><OPTION value="2008-05" > May-2008 </option><OPTION value="2008-04" > April-2008 </option><OPTION value="2008-03" > March-2008 </option><OPTION value="2008-02" > February-2008 </option><OPTION value="2008-01" > January-2008 </option><OPTION value="2007-12" > December-2007 </option><OPTION value="2007-11" > November-2007 </option><OPTION value="2007-10" > October-2007 </option><OPTION value="2007-09" > September-2007 </option><OPTION value="2007-08" > August-2007 </option><OPTION value="2007-07" > July-2007 </option><OPTION value="2007-06" > June-2007 </option><OPTION value="2007-05" > May-2007 </option><OPTION value="2007-04" > April-2007 </option><OPTION value="2007-03" > March-2007 </option><OPTION value="2007-02" > February-2007 </option><OPTION value="2007-01" > January-2007 </option><OPTION value="2006-12" > December-2006 </option><OPTION value="2006-11" > November-2006 </option><OPTION value="2006-10" > October-2006 </option><OPTION value="2006-09" > September-2006 </option><OPTION value="2006-08" > August-2006 </option><OPTION value="2006-07" > July-2006 </option><OPTION value="2006-06" > June-2006 </option><OPTION value="2006-05" > May-2006 </option><OPTION value="2006-04" > April-2006 </option><OPTION value="2006-03" > March-2006 </option><OPTION value="2006-02" > February-2006 </option><OPTION value="2006-01" > January-2006 </option><OPTION value="2005-12" > December-2005 </option><OPTION value="2005-11" > November-2005 </option><OPTION value="2005-10" > October-2005 </option><OPTION value="2005-09" > September-2005 </option><OPTION value="2005-08" > August-2005 </option><OPTION value="2005-07" > July-2005 </option><OPTION value="2005-06" > June-2005 </option><OPTION value="2005-05" > May-2005 </option><OPTION value="2005-04" > April-2005 </option><OPTION value="2005-03" > March-2005 </option><OPTION value="2005-02" > February-2005 </option><OPTION value="2005-01" > January-2005 </option><OPTION value="2004-12" > December-2004 </option><OPTION value="2004-11" > November-2004 </option><OPTION value="2004-10" > October-2004 </option><OPTION value="2004-09" > September-2004 </option><OPTION value="2004-08" > August-2004 </option><OPTION value="2004-07" > July-2004 </option><OPTION value="2004-06" > June-2004 </option><OPTION value="2004-05" > May-2004 </option><OPTION value="2004-04" > April-2004 </option><OPTION value="2004-03" > March-2004 </option><OPTION value="2004-02" > February-2004 </option><OPTION value="2004-01" > January-2004 </option>					</select>
					</td></tr></table>
	  			</td>
    		</tr>
				
				
		
				
		
		<!-- compare with a value //-->
					<tr>
				<td class="bgcolor_004" align="left">
					<font class="fontstyle_003">&nbsp;&nbsp;ACCOUNT NUMBER</font>
				</td>
				<td class="bgcolor_005" align="left" >
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td class="fontstyle_searchoptions">&nbsp;&nbsp;<INPUT TYPE="text" NAME="username" value="" class="form_input_text"></td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="usernametype" value="1" checked>Exact </td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="usernametype" value="2" > Begins with</td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="usernametype" value="3" > Contains</td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="usernametype" value="4" > Ends with</td>
				</tr></table></td>
			</tr>

						<tr>
				<td class="bgcolor_002" align="left">
					<font class="fontstyle_003">&nbsp;&nbsp;LASTNAME</font>
				</td>
				<td class="bgcolor_003" align="left" >
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td class="fontstyle_searchoptions">&nbsp;&nbsp;<INPUT TYPE="text" NAME="lastname" value="" class="form_input_text"></td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="lastnametype" value="1" checked>Exact </td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="lastnametype" value="2" > Begins with</td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="lastnametype" value="3" > Contains</td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="lastnametype" value="4" > Ends with</td>
				</tr></table></td>
			</tr>

						<tr>
				<td class="bgcolor_004" align="left">
					<font class="fontstyle_003">&nbsp;&nbsp;FIRSTNAME</font>
				</td>
				<td class="bgcolor_005" align="left" >
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td class="fontstyle_searchoptions">&nbsp;&nbsp;<INPUT TYPE="text" NAME="firstname" value="" class="form_input_text"></td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="firstnametype" value="1" checked>Exact </td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="firstnametype" value="2" > Begins with</td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="firstnametype" value="3" > Contains</td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="firstnametype" value="4" > Ends with</td>
				</tr></table></td>
			</tr>

						<!-- compare between 2 values //-->
									<tr>
        		<td class="bgcolor_004" align="left"> </td>
				<td class="bgcolor_005" align="center">
					<input type="submit"  name="search" align="top" border="0" value="search">
						  			</td>
    		</tr>
		</tbody></table>
	</FORM>
</center>';


               
$content .= '	<table align="right"><tr align="right">
        <td align="right"> 
					<a href="add_log_refill.php"> Add Refill&nbsp;&nbsp;<img src="../Public/templates/default/images/time_add.png" border="0" title="Add Refill" alt="Add Refill"></a>
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
						<td>'.$row_logrefill['username'].'</td>
						<td>'.$row_logrefill['date'].'</td>
						<td>'.$row_logrefill['credit'].'</td>
						<td>'.$row_logrefill['refill_type'].'</td>
						<td></td>
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

    $title	= 'Home';
    $submenu	= "dashboard";
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