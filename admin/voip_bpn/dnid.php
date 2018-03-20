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
  enableLog("", $loggedin["username"], $loggedin["id_employee"],"Open DNID");  
    global $conn;
    global $conn_voip;

$new_search = isset($_GET['search']) ? $_GET['search'] : '';
$id_ref = isset($_GET['id_ref']) ? $_GET['id_ref'] : '';
$del    = isset($_GET['del']) ? $_GET['del'] : '';
if($id_ref !== '' && $del=='true'){
   $sql_del = mysql_query("DELETE FROM `cc_dnid` WHERE `id`='$id_ref'", $conn_voip);
   header('location:dnid.php');
}

$new_search = isset($_POST['search']) ? $_POST['search'] : '';
if($new_search == 'search'){
//fromstatsday_sday, fromstatsmonth_sday, fromstatsday_hour, fromstatsday_min, tostatsday_sday, tostatsmonth_sday, tostatsday_hour, tostatsday_min, dst, dnid, choose_calltype, terminatecauseid, resulttype, choose_currency, image
//entercustomer, entercustomer_num, entertariffgroup, enterprovider, entertrunk, enterratecard

$fromstatsday_sday		= isset($_POST['fromstatsday_sday']) ? trim(strip_tags($_POST['fromstatsday_sday'])) : '';
$fromstatsmonth_sday		= isset($_POST['fromstatsmonth_sday']) ? trim(strip_tags($_POST['fromstatsmonth_sday'])) : '';
$fromstatsday_hour		= isset($_POST['fromstatsday_hour']) ? trim(strip_tags($_POST['fromstatsday_hour'])) : '';
$fromstatsday_min		= isset($_POST['fromstatsday_min']) ? trim(strip_tags($_POST['fromstatsday_min'])) : '';
$tostatsday_sday		= isset($_POST['tostatsday_sday']) ? trim(strip_tags($_POST['tostatsday_sday'])) : '';
$tostatsmonth_sday		= isset($_POST['tostatsmonth_sday']) ? trim(strip_tags($_POST['tostatsmonth_sday'])) : '';
$tostatsday_hour		= isset($_POST['tostatsday_hour']) ? trim(strip_tags($_POST['tostatsday_hour'])) : '';
$tostatsday_min			= isset($_POST['tostatsday_min']) ? trim(strip_tags($_POST['tostatsday_min'])) : '';
$dst				= isset($_POST['dst']) ? trim(strip_tags($_POST['dst'])) : '';
$src				= isset($_POST['src']) ? trim(strip_tags($_POST['src'])) : '';
$dnid				= isset($_POST['dnid']) ? trim(strip_tags($_POST['dnid'])) : '';
$choose_calltype		= isset($_POST['choose_calltype']) ? trim(strip_tags($_POST['choose_calltype'])) : '';
$terminatecauseid		= isset($_POST['terminatecauseid']) ? trim(strip_tags($_POST['terminatecauseid'])) : '';
$resulttype			= isset($_POST['resulttype']) ? trim(strip_tags($_POST['resulttype'])) : '';
$choose_currency		= isset($_POST['choose_currency']) ? trim(strip_tags($_POST['choose_currency'])) : '';
$entercustomer			= isset($_POST['entercustomer']) ? trim(strip_tags($_POST['entercustomer'])) : '';
$entercustomer_num		= isset($_POST['entercustomer_num']) ? trim(strip_tags($_POST['entercustomer_num'])) : '';
$entertariffgroup		= isset($_POST['entertariffgroup']) ? trim(strip_tags($_POST['entertariffgroup'])) : '';
$enterprovider			= isset($_POST['enterprovider']) ? trim(strip_tags($_POST['enterprovider'])) : '';
$entertrunk			= isset($_POST['entertrunk']) ? trim(strip_tags($_POST['entertrunk'])) : '';
$enterratecard			= isset($_POST['enterratecard']) ? trim(strip_tags($_POST['enterratecard'])) : '';
$f_buyrate                      = isset($_POST['buyrate']) ? trim(strip_tags($_POST['buyrate'])) : '';
$f_sellrate                     = isset($_POST['sellrate']) ? trim(strip_tags($_POST['sellrate'])) : '';
$f_source                       = isset($_POST['source']) ? trim(strip_tags($_POST['source'])) : '';
$f_called_number                = isset($_POST['called_number']) ? trim(strip_tags($_POST['called_number'])) : '';


/*
    sql 1 cc_call = "SELECT `id`, `sessionid`, `uniqueid`, `card_id`, `nasipaddress`, `starttime`, `stoptime`, `sessiontime`, `calledstation`, `sessionbill`, `id_tariffgroup`, `id_tariffplan`, `id_ratecard`, `id_trunk`, `sipiax`, `src`, `id_did`, `buycost`, `id_card_package_offer`, `real_sessiontime`, `dnid`, `terminatecauseid`, `destination` FROM `cc_call` WHERE 1";
    sql 2 cc_card = SELECT `id`, `creationdate`, `firstusedate`, `expirationdate`, `enableexpire`, `expiredays`, `username`, `useralias`, `uipass`, `credit`, `tariff`, `id_didgroup`, `activated`, `status`, `lastname`, `firstname`, `address`, `city`, `state`, `country`, `zipcode`, `phone`, `email`, `fax`, `inuse`, `simultaccess`, `currency`, `lastuse`, `nbused`, `typepaid`, `creditlimit`, `voipcall`, `sip_buddy`, `iax_buddy`, `language`, `redial`, `runservice`, `nbservice`, `id_campaign`, `num_trials_done`, `vat`, `servicelastrun`, `initialbalance`, `invoiceday`, `autorefill`, `loginkey`, `mac_addr`, `id_timezone`, `tag`, `voicemail_permitted`, `voicemail_activated`, `last_notification`, `email_notification`, `notify_email`, `credit_notification`, `id_group`, `company_name`, `company_website`, `vat_rn`, `traffic`, `traffic_target`, `discount`, `restriction`, `id_seria`, `serial`, `block`, `lock_pin`, `lock_date` FROM `cc_card` WHERE 1
    sql 3 cc_trunk = "SELECT `id_trunk`, `trunkcode`, `trunkprefix`, `providertech`, `providerip`, `removeprefix`, `secondusedreal`, `secondusedcarrier`, `secondusedratecard`, `creationdate`, `failover_trunk`, `addparameter`, `id_provider`, `inuse`, `maxuse`, `status`, `if_max_use` FROM `cc_trunk` WHERE 1
    sql 4 cc_ratecard = "SELECT `id`, `idtariffplan`, `dialprefix`, `buyrate`, `buyrateinitblock`, `buyrateincrement`, `rateinitial`, `initblock`, `billingblock`, `connectcharge`, `disconnectcharge`, `stepchargea`, `chargea`, `timechargea`, `billingblocka`, `stepchargeb`, `chargeb`, `timechargeb`, `billingblockb`, `stepchargec`, `chargec`, `timechargec`, `billingblockc`, `startdate`, `stopdate`, `starttime`, `endtime`, `id_trunk`, `musiconhold`, `id_outbound_cidgroup`, `rounding_calltime`, `rounding_threshold`, `additional_block_charge`, `additional_block_charge_time`, `tag`, `disconnectcharge_after`, `is_merged`, `additional_grace`, `minimal_cost`, `announce_time_correction`, `destination` FROM `cc_ratecard` WHERE 1";
    sql 5 cc_currencies = SELECT `id`, `currency`, `name`, `value`, `lastupdate` FROM `cc_currencies` WHERE 1
 data => 1.  	2014-10-02 08:38:07 	1701 	584488 	584488 	Indonesia 	110.000 IDR 	110.000 IDR 	01:50 	75816 	TELKOM-573222 	ANSWER 	STANDARD 	220.000 IDR 	220.000 IDR 	0.00% 	0.00% 	
*/

/*
cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN  cc_ratecard as rc ON rc.id=t1.id_ratecard

t1.dnid ,count(*) as count,avg(rc.buyrate) as buyrate ,avg(rc.rateinitial) as calledrate,
sum(t1.sessiontime) as sessiontime ,sum(t1.buycost) as buycost, sum(t1.sessionbill) as sessionbill

t1.callstart, t1.duration

t3.id_provider = '$enterprovider'
t3.id_trunk = '$entertrunk'
t1.id_tariffgroup = '$entertariffgroup'
t1.id_ratecard = '$enterratecard'
t1.buyrate = '$buyrate'
t1.calledrate = '$sellrate'

t1.cardID=t2.IDCust AND t2.IDmanager='".$_SESSION["pr_reseller_ID"]."'
t1.sipiax='$choose_calltype'

SELECT DATE(t1.starttime) AS day, sum(t1.sessiontime) AS calltime, sum(t1.sessionbill) AS cost, count(*) as nbcall, sum(t1.buycost) AS buy FROM $FG_TABLE_NAME WHERE ".$FG_TABLE_CLAUSE." GROUP BY day ORDER BY day

DNID, COUNT, AVG Rate, AVG Sale, Duration, Buy, Sell 
*/

/*
echo $fromstatsday_sday; // from day
echo $fromstatsmonth_sday; // from date
echo $fromstatsday_hour; // from hour
echo $fromstatsday_min; // from min
echo $tostatsday_sday; // to day
echo $tostatsmonth_sday; // to date
echo $tostatsday_hour; // to hour
echo $tostatsday_min; // to min
echo $dst; // phonenumber
echo $src; // caller id
echo $dnid; // dnid
echo $choose_calltype; // calltype
echo $terminatecauseid; // show call
echo $resulttype; // result
echo $choose_currency; // currency
echo $entercustomer; // id customer
echo $entercustomer_num; // customer number
echo $entertariffgroup; // callplan
echo $enterprovider; // provider
echo $entertrunk; // trunk
echo $enterratecard; // rate
echo $buyrate; // buyrate
echo $callednumber; // callednumber
echo $source; // source
echo $sellrate; // sellrate
*/

/*
t1.dnid as dnid, rc.buyrate as buyrate, rc.rateinitial as calledrate,
t1.sessiontime as sessiontime, t1.buycost as buycost, t1.sessionbill as sessionbill
 */

$from_date                                  	= implode('-', array($fromstatsmonth_sday, $fromstatsday_sday));
$to_date                                    	= implode('-', array($tostatsmonth_sday, $tostatsday_sday));  
$from_time                                  	= implode(':', array($fromstatsday_hour, $fromstatsday_min, "00"));
$to_time                                    	= implode(':', array($tostatsday_hour, $tostatsday_min, "59"));  
$date_from_complete 				= implode(" ", array($from_date, $from_time));
$date_to_complete				= implode(" ", array($to_date, $to_time));
$sql_from_to_day                            	= "(`t1`.`starttime` BETWEEN '$date_from_complete' AND '$date_to_complete')";        
$sql_number_dnid				= "`t1`.`dnid` LIKE '%$dnid%'";
$sql_entercustomer_num				= "`t2`.`username` LIKE '%$entercustomer_num%'";
$sql_entertariffgroup				= "`t1`.`id_tariffgroup` LIKE '%$entertariffgroup%'";
$sql_enterprovider				= "`t3`.`id_provider` LIKE '%$enterprovider%'";
$sql_entertrunk					= "`t1`.`id_trunk` LIKE '%$entertrunk%'";
$sql_enterratecard				= "`t1`.`id_ratecard` LIKE '%$enterratecard%'";
$sql_buyrate                                    = "`rc`.`buyrate` LIKE '%$f_buyrate%'";
$sql_sellrate                                   = "`rc`.`rateinitial` LIKE '%$f_sellrate%'";
$sql_source                                     = "`t1`.`src` LIKE '%$f_source%'";
$sql_called_number                              = "`t1`.`destination` LIKE '%$f_called_number%'";



if($terminatecauseid == 'ANSWER' ){
    $sql_show_calls = "`t1`.`terminatecauseid`='1' AND `t1`.`terminatecauseid`>'0'";
}elseif($terminatecauseid == 'INCOMPLET'){
    $sql_show_calls = "`t1`.`terminatecauseid`!= '1' AND `t1`.`terminatecauseid`>'0'";
}elseif($terminatecauseid == 'CONGESTION'){
    $sql_show_calls = "`t1`.`terminatecauseid`='5' AND `t1`.`terminatecauseid`>'0'";
}elseif($terminatecauseid == 'NOANSWER'){
    $sql_show_calls = "`t1`.`terminatecauseid`='3' AND `t1`.`terminatecauseid`>'0'";
}elseif($terminatecauseid == 'BUSY'){
    $sql_show_calls = "`t1`.`terminatecauseid`='2' AND `t1`.`terminatecauseid`>'0'";
}elseif($terminatecauseid == 'CHANUNAVAIL'){
    $sql_show_calls = "`t1`.`terminatecauseid`='6' AND `t1`.`terminatecauseid`>'0'";
}elseif($terminatecauseid == 'CANCEL'){
    $sql_show_calls = "`t1`.`terminatecauseid`='4' AND `t1`.`terminatecauseid`>'0'";
}else{
    $sql_show_calls = "`t1`.`terminatecauseid` LIKE '%%'";
}



/*
$sql_from_to_day,
$sql_dst, $sql_src, $sql_dnid, $sql_terminatecauseid, 				= "`t1`.`terminatecauseid` LIKE '%$terminatecauseid%'";
$sql_entercustomer, $sql_entercustomer_num, $sql_entertariffgroup,	
$sql_enterprovider, $sql_entertrunk, $sql_enterratecard	
*/

/*
SELECT t1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest, t4.buyrate, t4.rateinitial, t1.sessiontime, t1.card_id, t3.trunkcode, t1.terminatecauseid, t3.id_provider, t1.sipiax, t1.buycost, t1.sessionbill,
CASE WHEN t1.sessionbill !=0
THEN (
(
t1.sessionbill - t1.buycost
) / t1.sessionbill
) *100
ELSE NULL
END AS margin,
CASE WHEN t1.buycost !=0
THEN (
(
t1.sessionbill - t1.buycost
) / t1.buycost
) *100
ELSE NULL
END AS markup
FROM cc_call t1
LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk
LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id
WHERE `t1`.`destination` LIKE '%%'
AND `t1`.`src` LIKE '%%'
AND `t1`.`dnid` LIKE '%%'
AND `t1`.`card_id` LIKE '%1%'
AND `t1`.`id` LIKE '%%'
AND `t1`.`id_tariffgroup` LIKE '%%'
AND `t3`.`id_provider` LIKE '%%'
AND `t3`.`id_trunk` LIKE '%%'
AND `t1`.`id_ratecard` LIKE '%%'
LIMIT 0 , 30 
*/

/*
SELECT t1.dnid as dnid, rc.buyrate as buyrate, rc.rateinitial as calledrate,
t1.sessiontime as sessiontime, t1.buycost as buycost, t1.sessionbill as sessionbill
FROM `cc_call` `t1` LEFT OUTER JOIN `cc_trunk` `t3` ON `t1`.`id_trunk` = `t3`.`id_trunk` LEFT OUTER JOIN  `cc_ratecard` `rc` ON `rc`.`id`=`t1`.`id_ratecard` GROUP BY t1.dnid
*/

$sql_dnid = mysql_query("SELECT `t1`.`starttime` as `starttime`, t1.dnid as dnid, rc.buyrate as buyrate, rc.rateinitial as calledrate,
t1.sessiontime as sessiontime, t1.buycost as buycost, t1.sessionbill as sessionbill
FROM `cc_call` `t1` LEFT OUTER JOIN `cc_trunk` `t3` ON `t1`.`id_trunk` = `t3`.`id_trunk` LEFT OUTER JOIN  `cc_ratecard` `rc` ON `rc`.`id`=`t1`.`id_ratecard` WHERE $sql_number_dnid AND
$sql_entertariffgroup AND
$sql_enterprovider AND $sql_entertrunk AND
$sql_enterratecard AND $sql_from_to_day AND
$sql_buyrate AND
$sql_sellrate AND 
$sql_source AND
$sql_called_number 
GROUP BY `t1`.`dnid`", $conn_voip);

enableLog("", $loggedin["username"], $loggedin["id_employee"],"Search DNID SELECT `t1`.`starttime` as `starttime`, t1.dnid as dnid, rc.buyrate as buyrate, rc.rateinitial as calledrate,
t1.sessiontime as sessiontime, t1.buycost as buycost, t1.sessionbill as sessionbill
FROM `cc_call` `t1` LEFT OUTER JOIN `cc_trunk` `t3` ON `t1`.`id_trunk` = `t3`.`id_trunk` LEFT OUTER JOIN  `cc_ratecard` `rc` ON `rc`.`id`=`t1`.`id_ratecard` WHERE $sql_number_dnid AND
$sql_entertariffgroup AND
$sql_enterprovider AND $sql_entertrunk AND
$sql_enterratecard AND $sql_from_to_day AND
$sql_buyrate AND
$sql_sellrate AND 
$sql_source AND
$sql_called_number 
GROUP BY `t1`.`dnid`");
/*
echo "SELECT `t1`.`starttime` as `starttime`, t1.dnid as dnid, rc.buyrate as buyrate, rc.rateinitial as calledrate,
t1.sessiontime as sessiontime, t1.buycost as buycost, t1.sessionbill as sessionbill
FROM `cc_call` `t1` LEFT OUTER JOIN `cc_trunk` `t3` ON `t1`.`id_trunk` = `t3`.`id_trunk` LEFT OUTER JOIN  `cc_ratecard` `rc` ON `rc`.`id`=`t1`.`id_ratecard` WHERE $sql_number_dnid AND
$sql_entertariffgroup AND
$sql_enterprovider AND $sql_entertrunk AND
$sql_enterratecard AND $sql_from_to_day AND
$sql_buyrate AND
$sql_sellrate AND 
$sql_source AND
$sql_called_number 
GROUP BY `t1`.`dnid`";*/
//`t1`.`startime`>='2013-07-10 00:00:00'  AND `t1`.`startime`<='2014-08-00 00:00:59'


/*echo  "SELECT t2.username, t1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest, t4.buyrate, t4.rateinitial, t1.sessiontime, t1.card_id, t3.trunkcode, t1.terminatecauseid, t3.id_provider, t1.sipiax, t1.buycost, t1.sessionbill,
CASE WHEN t1.sessionbill !=0
THEN (
(
t1.sessionbill - t1.buycost
) / t1.sessionbill
) *100
ELSE NULL
END AS margin,
CASE WHEN t1.buycost !=0
THEN (
(
t1.sessionbill - t1.buycost
) / t1.buycost
) *100
ELSE NULL
END AS markup
FROM cc_call t1 JOIN cc_card t2 ON t1.card_id = t2.id
LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk
LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id WHERE
$sql_dst AND $sql_src AND $sql_dnid AND $sql_entercustomer AND
$sql_entercustomer_num AND $sql_entertariffgroup AND
$sql_enterprovider AND $sql_entertrunk AND
$sql_enterratecard AND $sql_show_calls AND $sql_from_to_day";
*/

/*
echo "SELECT t2.username, t1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest, t4.buyrate, t4.rateinitial, t1.sessiontime, t1.card_id, t3.trunkcode, t1.terminatecauseid, t3.id_provider, t1.sipiax, t1.buycost, t1.sessionbill,
CASE WHEN t1.sessionbill !=0
THEN (
(
t1.sessionbill - t1.buycost
) / t1.sessionbill
) *100
ELSE NULL
END AS margin,
CASE WHEN t1.buycost !=0
THEN (
(
t1.sessionbill - t1.buycost
) / t1.buycost
) *100
ELSE NULL
END AS markup
FROM cc_call t1
LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk
LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id
FROM cc_call t1 LEFT JOIN cc_card t2 ON t1.card_id = t2.id LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk
LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id WHERE
$sql_dst AND $sql_src AND $sql_dnid AND $sql_entercustomer AND
$sql_entercustomer_num AND $sql_entertariffgroup AND
$sql_enterprovider AND $sql_entertrunk AND
$sql_enterratecard";
*/
}else{
$sql_dnid = mysql_query("SELECT t1.dnid as dnid, rc.buyrate as buyrate, rc.rateinitial as calledrate,
t1.sessiontime as sessiontime, t1.buycost as buycost, t1.sessionbill as sessionbill
 FROM `cc_call` `t1` LEFT OUTER JOIN `cc_trunk` `t3` ON `t1`.`id_trunk` = `t3`.`id_trunk` LEFT OUTER JOIN  `cc_ratecard` `rc` ON `rc`.`id`=`t1`.`id_ratecard` GROUP BY t1.dnid", $conn_voip);
}    
            
    $content ='
                <!-- Main content -->
                <section class="content">

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">DNID</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">';


$content .= '
	<center>
		<b>Define criteria to make a precise search</b>
		<table class="searchhandler_table1">';
                




 
 
 
$content .= '
<!-- ** ** ** ** ** Part for the research ** ** ** ** ** -->
<center>
<FORM METHOD="POST" name="myForm" ACTION="">
<TABLE class="bar-status" width="85%" border="0" cellspacing="1" cellpadding="2" align="center">
				<tr>
		<td align="left" valign="top" class="bgcolor_004"><font
			class="fontstyle_003">CUSTOMERS :</font>
		</td>
		<td class="bgcolor_005" align="left">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>		<td valign="top"> <INPUT TYPE="text" NAME="entercustomer_num" 
					value="" class="form_input_text" id="numb_customer"> 
                                        <a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_numb_cust.php\');">numb customer</a>
				</td>
				<td width="50%">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="left" class="fontstyle_searchoptions">CallPlan :</td>
						<td align="left" class="fontstyle_searchoptions"><INPUT TYPE="text" NAME="entertariffgroup" value="" size="4" id="numb_call_plan" class="form_input_text">&nbsp;<a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_call_plan.php\');">id</a></td>
						<td align="left" class="fontstyle_searchoptions">Provider :
			
			<td align="left" class="fontstyle_searchoptions"><INPUT
							TYPE="text" NAME="enterprovider"
							value="" size="4" class="form_input_text" id="data_provider">
							<a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_provider.php\');">id</a></td>
					</tr>
					<tr>
						<td align="left" class="fontstyle_searchoptions">Trunk :</td>
						<td align="left" class="fontstyle_searchoptions"><INPUT
							TYPE="text" NAME="entertrunk" value=""
							size="4" class="form_input_text" id="id_trunk">
							<a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_trunk.php\');">id</a>
							</td>
                                                <td align="left" class="fontstyle_searchoptions">Rate :</td>
						<td align="left" class="fontstyle_searchoptions"><INPUT
							TYPE="text" NAME="enterratecard"
							value="" size="4"
							class="form_input_text" id="data_rate">
							<a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_rate.php\');">id</a>
							</td>
                                         </tr>
                                         <tr>
                                                <td align="left" class="fontstyle_searchoptions">Buy Rate :</td>
						<td align="left" class="fontstyle_searchoptions"><INPUT
							TYPE="text" NAME="buyrate" value=""
							size="4" class="form_input_text" id="buyrate">&nbsp;
							</td>
                                                <td align="left" class="fontstyle_searchoptions">Sell Rate :</td>
						<td align="left" class="fontstyle_searchoptions"><INPUT
							TYPE="text" NAME="sellrate"
							value="" size="4"
							class="form_input_text" id="sellrate">&nbsp;
							</td>        
					</tr>
				</table>
				</td>
			</tr>

		</table>
		</td>
	</tr>			
			<tr>
		<td align="left" class="bgcolor_004"><font class="fontstyle_003">DATE</font>
		</td>
		<td align="left" class="bgcolor_005">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="fontstyle_searchoptions">From :
				<select name="fromstatsday_sday" class="form_input_select">';
                                        
                                        $bil_tgl = isset($_POST['fromstatsday_sday']) ? $_POST['fromstatsday_sday'] : date("d") ;
                                        
                                        $content .= '<option value="00">-Select Day From-</option>';
                                        for($bil=1; $bil<=31; $bil++){
                                                if($bil == $bil_tgl){
                                                    $content .= '<option value="'.($bil < 10 ? '0'.$bil  : $bil).'" selected>'.($bil < 10 ? '0'.$bil  : $bil).'</option>';
                                                }else{
                                                    $content .= '<option value="'.($bil < 10 ? '0'.$bil  : $bil).'">'.($bil < 10 ? '0'.$bil  : $bil).'</option>';
                                                }
                                        }
					$content .= '
                                        </select>  <select name="fromstatsmonth_sday" class="form_input_select">
					';
                                            $time_H = date("H");
                                            $time_i = date("i");
                                            $time_s = date("s");
                                            $time_m = date("m");
                                            $time_d = date("d");
                                            $time_Y = date("Y");
                                            for($month_r=1; $month_r<=36; $month_r++){
                                                if($month_r == 1){
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m - $month_r + 1), $time_d, $time_Y))).'"  selected>'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
                                                }else{
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m - $month_r + 1), $time_d, $time_Y))).'" >'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
                                                }
                                            }
                                        $content .= '</select> <br />
					Time :				<select name="fromstatsday_hour" class="form_input_select">
					<option value="00" selected>00</option>';
				for($hour=1; $hour<=23; $hour++){
				    if($hour <= 9){
					$content .= '<option value="0'.$hour.'">0'.$hour.'</option>';
				    }else{
					$content .= '<option value="'.$hour.'">'.$hour.'</option>';										
				    }
				
				}
				$content .= '</select> : <select name="fromstatsday_min"
					class="form_input_select">
				<option value="00" selected>00</option>';
				for($min=1; $min<=11; $min++){
				    $minute_for = $min * 5;
				    if($minute_for<10){
					$content .= '<option value="0'.$minute_for.'">0'.$minute_for.'</option>';
				    }else{
					$content .= '<option value="'.$minute_for.'">'.$minute_for.'</option>';
				    }
				}
				$content .= '
				</select></td>
				<td class="fontstyle_searchoptions"> 
				To  :
				<select name="tostatsday_sday" class="form_input_select">
				<option value="00">-Select Day To-</option>';
                                $bil_tgl = isset($_POST['fromstatsday_sday']) ? $_POST['fromstatsday_sday'] : date("d") ;
				for($bil=1; $bil<=31; $bil++){
				    if($bil == $bil_tgl){
                                                    $content .= '<option value="'.($bil < 10 ? '0'.$bil  : $bil).'" selected>'.($bil < 10 ? '0'.$bil  : $bil).'</option>';
                                    }else{
                                                    $content .= '<option value="'.($bil < 10 ? '0'.$bil  : $bil).'">'.($bil < 10 ? '0'.$bil  : $bil).'</option>';
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
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m - $month_r + 1), $time_d, $time_Y))).'"  selected>'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
                                                }else{
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m - $month_r + 1), $time_d, $time_Y))).'" >'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
                                                }
                                            }
                                        $content .= '</select>
				<br />
				Time :	<select name="tostatsday_hour" class="form_input_select">
				<option value="00">00</option>';
				for($hour=1; $hour<=23; $hour++){
				    if($hour <= 9){
					$content .= '<option value="0'.$hour.'">0'.$hour.'</option>';
				    }else{
					$content .= '<option value="'.$hour.'">'.$hour.'</option>';										
				    }
				}
				
				$content .= '
				</select> : <select name="tostatsday_min" class="form_input_select">
				<option value="00">00</option>';
				for($min=1; $min<=11; $min++){
				    $minute_for = $min * 5;
				    if($minute_for<10){
					$content .= '<option value="0'.$minute_for.'">0'.$minute_for.'</option>';
				    }else{
					$content .= '<option value="'.$minute_for.'">'.$minute_for.'</option>';
				    }
				}
				$content .= '
				</select></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="left" class="bgcolor_004"><font class="fontstyle_003">Called Number</font>
		</td>
                <td class="bgcolor_005" align="left">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>&nbsp;&nbsp;<INPUT TYPE="text" NAME="called_number"
					value="" class="form_input_text"></td>
			</tr>
		</table>
		</td>
                </tr>
                <tr>
                <td align="left" class="bgcolor_004"><font class="fontstyle_003">Source</font>
		</td>
                <td class="bgcolor_005" align="left">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>&nbsp;&nbsp;<INPUT TYPE="text" NAME="source"
					value="" class="form_input_text"></td>
			</tr>
		</table>
		</td>
                </tr>
                <tr>
		<td align="left" class="bgcolor_004"><font class="fontstyle_003">DNID</font>
		<td class="bgcolor_005" align="left">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>&nbsp;&nbsp;<INPUT TYPE="text" NAME="dnid"
					value="" class="form_input_text"></td>
			</tr>
		</table>
		</td>
	</tr>
	<!-- Select Calltype: -->
	<tr>
		<td class="bgcolor_002" align="left"><font class="fontstyle_003">CALL TYPE</font></td>
		<td class="bgcolor_003" align="center">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="fontstyle_searchoptions"><select NAME="choose_calltype"
					size="1" class="form_input_select">
					<option value=\'-1\'
												selected >ALL CALLS								</option>
															<option value=\'0\'
						>STANDARD								</option>
															<option value=\'1\'
						>SIP/IAX								</option>
															<option value=\'2\'
						>DIDCALL								</option>
															<option value=\'3\'
						>DID_VOIP								</option>
															<option value=\'4\'
						>CALLBACK								</option>
															<option value=\'5\'
						>PREDICT								</option>
															<option value=\'6\'
						>AUTO DIALER								</option>
															<option value=\'7\'
						>DID-ALEG								</option>
													</select></td>
			</tr>
		</table>
		</td>
	</tr>

	<!-- Select Option : to show just the Answered Calls or all calls, Result type, currencies... -->
	<tr>
		<td class="bgcolor_002" align="left"><font class="fontstyle_003">OPTIONS</font></td>
		<td class="bgcolor_003" align="center">
		<div align="left">

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="20%" class="fontstyle_searchoptions">
					SHOW CALLS :  						
			   </td>
				<td width="80%" class="fontstyle_searchoptions"><select
					NAME="terminatecauseid" size="1" class="form_input_select">
					<option value=\'ANSWER\'
												selected >ANSWERED							</option>

					<option value=\'ALL\' >ALL							</option>

					<option value=\'INCOMPLET\'
						>NOT COMPLETED							</option>

					<option value=\'CONGESTION\'
						>CONGESTIONED							</option>

					<option value=\'BUSY\' >BUSIED							</option>

					<option value=\'NOANSWER\'
						>NOT ANSWERED							</option>

					<option value=\'CHANUNAVAIL\'
						>CHANNEL UNAVAILABLE							</option>

					<option value=\'CANCEL\' >CANCELED							</option>

				</select></td>
			</tr>
			<tr class="bgcolor_005">
				<td class="fontstyle_searchoptions">
					RESULT : 
			   </td>
				<td class="fontstyle_searchoptions">';
				/*
					mins<input type="radio" NAME="resulttype"
					value="min"
					 checked
					> - secs <input type="radio"
					NAME="resulttype" value="sec" >*/
			    $content .= '<select name="resulttype">
					<option value="min">Min</option>
					<option value="sec">Sec</option>				
					</select>';
			    $content .= '</td>
			</tr>
			<tr>
				<td class="fontstyle_searchoptions">
					CURRENCY :
				</td>
				<td class="fontstyle_searchoptions"><select NAME="choose_currency" size="1" class="form_input_select">';
				$sql_currencies = mysql_query("SELECT `id`, `currency`, `name`, `value`, `lastupdate`, `basecurrency` FROM `cc_currencies`  ORDER BY `cc_currencies`.`name` ASC", $conn_voip);
				if((isset($_POST['choose_currency']) ? $_POST['choose_currency'] : 'IDR') == 'IDR'){
				    $data_cur = "IDR";
				}
				else{
				    $data_cur = $_POST['choose_currency'];
				}
				while($data_currencies = mysql_fetch_array($sql_currencies)){
				    if($data_cur == $data_currencies['currency']){
				    $content .= '<option value=\''.$data_currencies['currency'].'\' selected >'.$data_currencies['name'].' ('.$data_currencies['value'].') </option>';
				    }else{
				    $content .= '<option value="'.$data_currencies['currency'].'" >'.$data_currencies['name'].'('.$data_currencies['value'].')</option>';
				    }
				}
				$content .= '</select></td>
			</tr>
		</table>
		
		</td>
	</tr>
	<!-- Select Option : to show just the Answered Calls or all calls, Result type, currencies... -->

	<tr>
		<td class="bgcolor_004" align="left"></td>
		<td class="bgcolor_005" align="center"><input type="submit"
			name="search" align="top" border="0" value="search"></td>
	</tr>
</table>
</FORM>
</center>
';

 

// ID 	ACCOUNT 	REFILL DATE 	REFILL AMOUNT 	REFILL TYPE 	ACTION	
// id 	creationdate 	firstusedate 	expirationdate 	enableexpire 	expiredays 	username 	useralias 	uipass 	credit 	tariff 	id_didgroup 	activated 	status 	lastname 	firstname 	address 	city 	state 	country 	zipcode 	phone 	email 	fax 	inuse 	simultaccess 	currency 	lastuse 	nbused 	typepaid 	creditlimit 	voipcall 	sip_buddy 	iax_buddy 	language 	redial 	runservice 	nbservice 	id_campaign 	num_trials_done 	vat 	servicelastrun 	initialbalance 	invoiceday 	autorefill 	loginkey 	mac_addr 	id_timezone 	tag 	voicemail_permitted 	voicemail_activated 	last_notification 	email_notification 	notify_email 	credit_notification 	id_group 	company_name 	company_website 	vat_rn 	traffic 	traffic_target 	discount 	restriction 	id_seria 	serial 	block 	lock_pin 	lock_date
$content .= '<table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>DNID</th><th>COUNT</th><th>AVG Rate</th><th>AVG Sale</th><th>Duration</th><th>Buy</th><th>Sell</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					//t1.dnid ,count(*) as count,avg(rc.buyrate) as buyrate ,avg(rc.rateinitial) as calledrate, sum(t1.sessiontime) as sessiontime ,sum(t1.buycost) as buycost, sum(t1.sessionbill) as sessionbill
                                        //cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN  cc_ratecard as rc ON rc.id=t1.id_ratecard

					
					while($row_dnid = mysql_fetch_array($sql_dnid)){
					$data_count_call = mysql_fetch_array(mysql_query("SELECT COUNT(dnid) AS count FROM cc_call WHERE dnid='$row_dnid[dnid]'", $conn_voip));   
                                        $data_avg_buyrate = mysql_fetch_array(mysql_query("SELECT AVG(buyrate) AS buyrate FROM cc_call LEFT OUTER JOIN cc_ratecard ON cc_ratecard.id=cc_call.id_ratecard WHERE dnid='$row_dnid[dnid]'", $conn_voip));   
                                        $data_avg_calledrate = mysql_fetch_array(mysql_query("SELECT AVG(rateinitial) AS calledrate FROM cc_call LEFT OUTER JOIN cc_ratecard ON cc_ratecard.id=cc_call.id_ratecard WHERE dnid='$row_dnid[dnid]'", $conn_voip));   
                                        $data_duration = mysql_fetch_array(mysql_query("SELECT sum(cc_call.sessiontime) AS sessiontime FROM cc_call WHERE dnid='$row_dnid[dnid]'", $conn_voip));   
                                        $data_buy = mysql_fetch_array(mysql_query("SELECT sum(cc_call.buycost) AS buycost FROM cc_call WHERE dnid='$row_dnid[dnid]'", $conn_voip));   
                                        $data_sell = mysql_fetch_array(mysql_query("SELECT sum(cc_call.sessionbill) AS sessionbill FROM cc_call WHERE dnid='$row_dnid[dnid]'", $conn_voip));   
                                        
                                            $content .= '
					    <tr>
						<td>'.$row_dnid['dnid'].'</td>
						<td>'.$data_count_call['count'].'</td>
                                                <td>'.$data_avg_buyrate['buyrate'].'</td>
						<td>'.$data_avg_calledrate['calledrate'].'</td>
						<td>'.$data_duration['sessiontime'].'</td>
                                                <td>'.$data_buy['buycost'].'</td>
                                                <td>'.$data_sell['sessionbill'].'</td>
                                            </tr>';
					}
					
$content .= '                           </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>DNID</th><th>COUNT</th><th>AVG Rate</th><th>AVG Sale</th><th>Duration</th><th>Buy</th><th>Sell</th>
						
                                            </tr>
                                        </tfoot>
                                    </table>';	
	

/*
 	TRAFFIC SUMMARY
DATE 	DUR 	GRAPHIC 	CALLS 	ALOC 	ASR 	SELL 	BUY 	PROFIT 	MARGIN 	MARKUP
2014-06-19 	02:19 	
	9 	00:15 	0.00 	0.004 IDR 	0.000 IDR 	0.004 IDR 	100.00% 	NULL
2014-06-20 	17:21 	
	54 	00:19 	0.00 	11,200.008 IDR 	23,360.000 IDR 	-12,159.992 IDR 	-108.57% 	-52.05%
2014-06-21 	01:46 	
	2 	00:53 	0.00 	2,000.000 IDR 	0.000 IDR 	2,000.000 IDR 	100.00% 	NULL
TOTAL 	279:01 	356 	00:47 	0.00 	309,674.179 IDR 	384,930.000 IDR 	-75,255.821 IDR 	-24.30% 	-19.55%
*/
 
 
if($new_search == 'search'){
// ID 	ACCOUNT 	REFILL DATE 	REFILL AMOUNT 	REFILL TYPE 	ACTION	
// id 	creationdate 	firstusedate 	expirationdate 	enableexpire 	expiredays 	username 	useralias 	uipass 	credit 	tariff 	id_didgroup 	activated 	status 	lastname 	firstname 	address 	city 	state 	country 	zipcode 	phone 	email 	fax 	inuse 	simultaccess 	currency 	lastuse 	nbused 	typepaid 	creditlimit 	voipcall 	sip_buddy 	iax_buddy 	language 	redial 	runservice 	nbservice 	id_campaign 	num_trials_done 	vat 	servicelastrun 	initialbalance 	invoiceday 	autorefill 	loginkey 	mac_addr 	id_timezone 	tag 	voicemail_permitted 	voicemail_activated 	last_notification 	email_notification 	notify_email 	credit_notification 	id_group 	company_name 	company_website 	vat_rn 	traffic 	traffic_target 	discount 	restriction 	id_seria 	serial 	block 	lock_pin 	lock_date
$content .= '<br><br><table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>DATE</th><th>DUR</th><th>CALLS</th><th>ALOC</th><th>ASR</th><th>SELL</th><th>BUY</th><th>PROFIT</th><th>MARGIN</th><th>MARKUP</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					//t1.dnid ,count(*) as count,avg(rc.buyrate) as buyrate ,avg(rc.rateinitial) as calledrate, sum(t1.sessiontime) as sessiontime ,sum(t1.buycost) as buycost, sum(t1.sessionbill) as sessionbill
                                        //cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN  cc_ratecard as rc ON rc.id=t1.id_ratecard

					
					

$fromstatsday_sday		= isset($_POST['fromstatsday_sday']) ? trim(strip_tags($_POST['fromstatsday_sday'])) : '';
$fromstatsmonth_sday		= isset($_POST['fromstatsmonth_sday']) ? trim(strip_tags($_POST['fromstatsmonth_sday'])) : '';
$fromstatsday_hour		= isset($_POST['fromstatsday_hour']) ? trim(strip_tags($_POST['fromstatsday_hour'])) : '';
$fromstatsday_min		= isset($_POST['fromstatsday_min']) ? trim(strip_tags($_POST['fromstatsday_min'])) : '';
$tostatsday_sday		= isset($_POST['tostatsday_sday']) ? trim(strip_tags($_POST['tostatsday_sday'])) : '';
$tostatsmonth_sday		= isset($_POST['tostatsmonth_sday']) ? trim(strip_tags($_POST['tostatsmonth_sday'])) : '';
$tostatsday_hour		= isset($_POST['tostatsday_hour']) ? trim(strip_tags($_POST['tostatsday_hour'])) : '';
$tostatsday_min			= isset($_POST['tostatsday_min']) ? trim(strip_tags($_POST['tostatsday_min'])) : '';

$from_date                                  	= implode('-', array($fromstatsmonth_sday, $fromstatsday_sday));
$to_date                                    	= implode('-', array($tostatsmonth_sday, $tostatsday_sday));  
$from_time                                  	= implode(':', array($fromstatsday_hour, $fromstatsday_min, "00"));
$to_time                                    	= implode(':', array($tostatsday_hour, $tostatsday_min, "59"));  
$date_from_complete 				= implode(" ", array($from_date, $from_time));
$date_to_complete				= implode(" ", array($to_date, $to_time));

$ex_tgl_awal	= explode("-", $from_date);
$tgl_awal 	= mktime(date("H"), date("i"), date("s"), $ex_tgl_awal[1], $ex_tgl_awal[2], $ex_tgl_awal[0]);
$ex_tgl_akhir	= explode("-", $to_date);
$tgl_akhir 	= mktime(date("H"), date("i"), date("s"), $ex_tgl_akhir[1], $ex_tgl_akhir[2], $ex_tgl_akhir[0]);

$jml_tgl = ($tgl_akhir - $tgl_awal)/(24*60*60);
for($num_tgl=1; $num_tgl<=$jml_tgl; $num_tgl++){
  
$tgl_awal 	= mktime(date("H"), date("i"), date("s"), $ex_tgl_awal[1], $ex_tgl_awal[2], $ex_tgl_awal[0]);

$tgl_data 	= date("Y-m-d", mktime(date("H"), date("i"), date("s"), $ex_tgl_awal[1], ($ex_tgl_awal[2]+$num_tgl-1), $ex_tgl_awal[0]));

					$data_count_call = mysql_fetch_array(mysql_query("SELECT COUNT(dnid) AS count FROM cc_call WHERE `cc_call`.`starttime` LIKE '%$tgl_data%' AND `cc_call`.`sessiontime`!='0'", $conn_voip));   
                                        $data_duration = mysql_fetch_array(mysql_query("SELECT sum(cc_call.sessiontime) AS sessiontime FROM cc_call WHERE `cc_call`.`starttime` LIKE '%$tgl_data%'", $conn_voip));   
                                        $data_buy = mysql_fetch_array(mysql_query("SELECT sum(cc_call.buycost) AS buycost FROM cc_call WHERE `cc_call`.`starttime` LIKE '%$tgl_data%' AND `cc_call`.`sessiontime`!='0'", $conn_voip));   
                                        $data_sell = mysql_fetch_array(mysql_query("SELECT sum(cc_call.sessionbill) AS sessionbill FROM cc_call WHERE `cc_call`.`starttime` LIKE '%$tgl_data%' AND `cc_call`.`sessiontime`!='0'", $conn_voip));
					$data_margin = mysql_fetch_array(mysql_query("SELECT case when `sessionbill`!=0 then (sum(`sessionbill`-`buycost`)/sum(sessionbill))*100 else NULL end as `margin` FROM `cc_call` WHERE `starttime` LIKE '%$tgl_data%' AND `sessiontime`!='0'", $conn_voip));
					$data_markup = mysql_fetch_array(mysql_query("SELECT case when `buycost`!=0 then (sum(`sessionbill`-`buycost`)/sum(`buycost`))*100 else NULL end as `markup` FROM `cc_call` WHERE `starttime` LIKE '%$tgl_data%' AND `sessiontime`!='0'", $conn_voip));
					$data_asr1 = mysql_num_rows(mysql_query("SELECT `terminatecauseid` FROM cc_call WHERE `starttime` LIKE '%$tgl_data%' AND `terminatecauseid`='1'", $conn_voip));
					$data_asr2 = mysql_num_rows(mysql_query("SELECT `terminatecauseid` FROM cc_call WHERE `starttime` LIKE '%$tgl_data%'", $conn_voip));
					if($data_duration['sessiontime']!=''){
    $data_aloc = floor($data_duration['sessiontime'] / $data_count_call['count']);
    $data_profit = $data_sell['sessionbill'] - $data_buy['buycost'];
   $data_asr =  ($data_asr1/$data_asr2)*100;
   
$content .= '                              <tr>
                                                <td>'.$tgl_data.'</td><td>'.($data_duration['sessiontime']!='' ? $data_duration['sessiontime'] : '0').'</td><td>'.$data_count_call['count'].'</td><td>'.$data_aloc.'</td><td>'.$data_asr.'</td><td>'.$data_sell['sessionbill'].'</td><td>'.$data_buy['buycost'].'</td><td>'.$data_profit.'</td><td>'.$data_margin['margin'].'</td><td>'.$data_markup['markup'].'</td>
                                            </tr>';
  }
}

$content .= '                           </tbody>
                                        <tfoot>';
$content .= '
					    <tr>
                                                <th>DATE</th><th>DUR</th><th>CALLS</th><th>ALOC</th><th>ASR</th><th>SELL</th><th>BUY</th><th>PROFIT</th><th>MARGIN</th><th>MARKUP</th>
                                            </tr>';
										      
					      
$content .= '                                     </tfoot>
                                    </table>';	
}
        
        
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

       <![endif]-->
<!-- jQuery 2.0.2 -->
<!-- Bootstrap -->
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
	
';

    $title	= 'DNID';
    $submenu	= "voip_dnid";
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