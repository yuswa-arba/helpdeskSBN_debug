<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
 
 /* pure data cdrs
    //The variable FG_TABLE_NAME define the table name to use
    $FG_TABLE_NAME = "cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id";

    // This Variable store the argument for the SQL query
    $FG_COL_QUERY = 't1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest, t4.buyrate, t4.rateinitial, t1.sessiontime, t1.card_id, t3.trunkcode, t1.terminatecauseid, t1.sipiax, t1.buycost, t1.sessionbill, case when t1.sessionbill!=0 then ((t1.sessionbill-t1.buycost)/t1.sessionbill)*100 else NULL end as margin,case when t1.buycost!=0 then ((t1.sessionbill-t1.buycost)/t1.buycost)*100 else NULL end as markup';

    select id from cc_card where username=".$entercustomer_num
    
    $QUERY = "SELECT DATE(t1.starttime) AS day, sum(t1.sessiontime) AS calltime, sum(t1.sessionbill) AS cost, count(*) as nbcall,
            sum(t1.buycost) AS buy, sum(case when t1.sessiontime>0 then 1 else 0 end) as success_calls
        	FROM $FG_TABLE_NAME WHERE $FG_TABLE_CLAUSE GROUP BY day ORDER BY day"; //extract(DAY from calldate)
*/

/*
    sql 1 cc_call = "SELECT `id`, `sessionid`, `uniqueid`, `card_id`, `nasipaddress`, `starttime`, `stoptime`, `sessiontime`, `calledstation`, `sessionbill`, `id_tariffgroup`, `id_tariffplan`, `id_ratecard`, `id_trunk`, `sipiax`, `src`, `id_did`, `buycost`, `id_card_package_offer`, `real_sessiontime`, `dnid`, `terminatecauseid`, `destination` FROM `cc_call` WHERE 1";
    sql 2 SELECT `id`, `creationdate`, `firstusedate`, `expirationdate`, `enableexpire`, `expiredays`, `username`, `useralias`, `uipass`, `credit`, `tariff`, `id_didgroup`, `activated`, `status`, `lastname`, `firstname`, `address`, `city`, `state`, `country`, `zipcode`, `phone`, `email`, `fax`, `inuse`, `simultaccess`, `currency`, `lastuse`, `nbused`, `typepaid`, `creditlimit`, `voipcall`, `sip_buddy`, `iax_buddy`, `language`, `redial`, `runservice`, `nbservice`, `id_campaign`, `num_trials_done`, `vat`, `servicelastrun`, `initialbalance`, `invoiceday`, `autorefill`, `loginkey`, `mac_addr`, `id_timezone`, `tag`, `voicemail_permitted`, `voicemail_activated`, `last_notification`, `email_notification`, `notify_email`, `credit_notification`, `id_group`, `company_name`, `company_website`, `vat_rn`, `traffic`, `traffic_target`, `discount`, `restriction`, `id_seria`, `serial`, `block`, `lock_pin`, `lock_date` FROM `cc_card` WHERE 1
    sql 3 cc_trunk = "SELECT `id_trunk`, `trunkcode`, `trunkprefix`, `providertech`, `providerip`, `removeprefix`, `secondusedreal`, `secondusedcarrier`, `secondusedratecard`, `creationdate`, `failover_trunk`, `addparameter`, `id_provider`, `inuse`, `maxuse`, `status`, `if_max_use` FROM `cc_trunk` WHERE 1
    sql 4 cc_ratecard = "SELECT `id`, `idtariffplan`, `dialprefix`, `buyrate`, `buyrateinitblock`, `buyrateincrement`, `rateinitial`, `initblock`, `billingblock`, `connectcharge`, `disconnectcharge`, `stepchargea`, `chargea`, `timechargea`, `billingblocka`, `stepchargeb`, `chargeb`, `timechargeb`, `billingblockb`, `stepchargec`, `chargec`, `timechargec`, `billingblockc`, `startdate`, `stopdate`, `starttime`, `endtime`, `id_trunk`, `musiconhold`, `id_outbound_cidgroup`, `rounding_calltime`, `rounding_threshold`, `additional_block_charge`, `additional_block_charge_time`, `tag`, `disconnectcharge_after`, `is_merged`, `additional_grace`, `minimal_cost`, `announce_time_correction`, `destination` FROM `cc_ratecard` WHERE 1";
    data => 1.  	2014-10-02 08:38:07 	1701 	584488 	584488 	Indonesia 	110.000 IDR 	110.000 IDR 	01:50 	75816 	TELKOM-573222 	ANSWER 	STANDARD 	220.000 IDR 	220.000 IDR 	0.00% 	0.00% 	
 		
Date	=> cc_call.starttime
CallerID => cc_card.useralias -> src
DNID => cc_call.dnid
Phone Number => cc_card.calledstation
Destination => cc_call_destination -> card.destination
Buy Rate => cc_ratecard.buyrate
Sell Rate => cc_ratecard.rateinitial
Duration =>  stoptime -	starttime -> cc_card.sessiontime
Account => cc_card.card_id
Trunk => cc_trunk.trunkcode
TC => cc_card.terminatecauseid
CallType => cc_card.sipiax
Buy => cc_card.buycost
Sell => cc_card.buycost
Margin => margin
Markup => markup
*/
 
include ("../../config/configuration_admin.php");
include ("../../config/configuration_voip_bali.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open CDRs Customer");
    global $conn;
    global $conn_voip;

	$perhalaman = 20;
	if (isset($_GET['page'])){
		$page = (int)$_GET['page'];
		$start=($page - 1) * $perhalaman;
	}else{
		$start=0;
	}

$id_ref = isset($_GET['id_ref']) ? $_GET['id_ref'] : '';
$del    = isset($_GET['del']) ? $_GET['del'] : '';
if($id_ref !== '' && $del=='true'){
   $sql_del = mysql_query("DELETE FROM `cc_logrefill` WHERE `id`='$id_ref'", $conn_voip);
   header('location:log_refill.php');
}
$new_search = isset($_POST['search']) ? $_POST['search'] : '';
if($new_search == 'search'){
//fromstatsday_sday, fromstatsmonth_sday, fromstatsday_hour, fromstatsday_min, tostatsday_sday, tostatsmonth_sday, tostatsday_hour, tostatsday_min, dst, dnid, choose_calltype, terminatecauseid, resulttype, choose_currency, image
//entercustomer, entercustomer_num, entertariffgroup, enterprovider, entertrunk, enterratecard

$fromstatsday_sday		= isset($_POST['fromstatsday_sday']) ? $_POST['fromstatsday_sday'] : '';
$fromstatsmonth_sday		= isset($_POST['fromstatsmonth_sday']) ? $_POST['fromstatsmonth_sday'] : '';
$fromstatsday_hour		= isset($_POST['fromstatsday_hour']) ? $_POST['fromstatsday_hour'] : '';
$fromstatsday_min		= isset($_POST['fromstatsday_min']) ? $_POST['fromstatsday_min'] : '';
$tostatsday_sday		= isset($_POST['tostatsday_sday']) ? $_POST['tostatsday_sday'] : '';
$tostatsmonth_sday		= isset($_POST['tostatsmonth_sday']) ? $_POST['tostatsmonth_sday'] : '';
$tostatsday_hour		= isset($_POST['tostatsday_hour']) ? $_POST['tostatsday_hour'] : '';
$tostatsday_min			= isset($_POST['tostatsday_min']) ? $_POST['tostatsday_min'] : '';
$dst				= isset($_POST['dst']) ? $_POST['dst'] : '';
$src				= isset($_POST['src']) ? $_POST['src'] : '';
$dnid				= isset($_POST['dnid']) ? $_POST['dnid'] : '';
$choose_calltype		= isset($_POST['choose_calltype']) ? $_POST['choose_calltype'] : '';
$terminatecauseid		= isset($_POST['terminatecauseid']) ? $_POST['terminatecauseid'] : '';
$resulttype			= isset($_POST['resulttype']) ? $_POST['resulttype'] : '';
$choose_currency		= isset($_POST['choose_currency']) ? $_POST['choose_currency'] : '';
$entercustomer			= isset($_POST['entercustomer']) ? $_POST['entercustomer'] : '';
$entercustomer_num		= isset($_POST['entercustomer_num']) ? $_POST['entercustomer_num'] : '';
$entertariffgroup		= isset($_POST['entertariffgroup']) ? $_POST['entertariffgroup'] : '';
$enterprovider			= isset($_POST['enterprovider']) ? $_POST['enterprovider'] : '';
$entertrunk			= isset($_POST['entertrunk']) ? $_POST['entertrunk'] : '';
$enterratecard			= isset($_POST['enterratecard']) ? $_POST['enterratecard'] : '';

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
*/

/*
    sql 1 cc_call = "SELECT `id`, `sessionid`, `uniqueid`, `card_id`, `nasipaddress`, `starttime`, `stoptime`, `sessiontime`, `calledstation`, `sessionbill`, `id_tariffgroup`, `id_tariffplan`, `id_ratecard`, `id_trunk`, `sipiax`, `src`, `id_did`, `buycost`, `id_card_package_offer`, `real_sessiontime`, `dnid`, `terminatecauseid`, `destination` FROM `cc_call` WHERE 1";
    sql 2 cc_card = SELECT `id`, `creationdate`, `firstusedate`, `expirationdate`, `enableexpire`, `expiredays`, `username`, `useralias`, `uipass`, `credit`, `tariff`, `id_didgroup`, `activated`, `status`, `lastname`, `firstname`, `address`, `city`, `state`, `country`, `zipcode`, `phone`, `email`, `fax`, `inuse`, `simultaccess`, `currency`, `lastuse`, `nbused`, `typepaid`, `creditlimit`, `voipcall`, `sip_buddy`, `iax_buddy`, `language`, `redial`, `runservice`, `nbservice`, `id_campaign`, `num_trials_done`, `vat`, `servicelastrun`, `initialbalance`, `invoiceday`, `autorefill`, `loginkey`, `mac_addr`, `id_timezone`, `tag`, `voicemail_permitted`, `voicemail_activated`, `last_notification`, `email_notification`, `notify_email`, `credit_notification`, `id_group`, `company_name`, `company_website`, `vat_rn`, `traffic`, `traffic_target`, `discount`, `restriction`, `id_seria`, `serial`, `block`, `lock_pin`, `lock_date` FROM `cc_card` WHERE 1
    sql 3 cc_trunk = "SELECT `id_trunk`, `trunkcode`, `trunkprefix`, `providertech`, `providerip`, `removeprefix`, `secondusedreal`, `secondusedcarrier`, `secondusedratecard`, `creationdate`, `failover_trunk`, `addparameter`, `id_provider`, `inuse`, `maxuse`, `status`, `if_max_use` FROM `cc_trunk` WHERE 1
    sql 4 cc_ratecard = "SELECT `id`, `idtariffplan`, `dialprefix`, `buyrate`, `buyrateinitblock`, `buyrateincrement`, `rateinitial`, `initblock`, `billingblock`, `connectcharge`, `disconnectcharge`, `stepchargea`, `chargea`, `timechargea`, `billingblocka`, `stepchargeb`, `chargeb`, `timechargeb`, `billingblockb`, `stepchargec`, `chargec`, `timechargec`, `billingblockc`, `startdate`, `stopdate`, `starttime`, `endtime`, `id_trunk`, `musiconhold`, `id_outbound_cidgroup`, `rounding_calltime`, `rounding_threshold`, `additional_block_charge`, `additional_block_charge_time`, `tag`, `disconnectcharge_after`, `is_merged`, `additional_grace`, `minimal_cost`, `announce_time_correction`, `destination` FROM `cc_ratecard` WHERE 1";
    sql 5 cc_currencies = SELECT `id`, `currency`, `name`, `value`, `lastupdate` FROM `cc_currencies` WHERE 1
 data => 1.  	2014-10-02 08:38:07 	1701 	584488 	584488 	Indonesia 	110.000 IDR 	110.000 IDR 	01:50 	75816 	TELKOM-573222 	ANSWER 	STANDARD 	220.000 IDR 	220.000 IDR 	0.00% 	0.00% 	
*/



$from_date                                  	= implode('-', array($fromstatsmonth_sday, $fromstatsday_sday));
$to_date                                    	= implode('-', array($tostatsmonth_sday, $tostatsday_sday));  
$from_time                                  	= implode(':', array($fromstatsday_hour, $fromstatsday_min, "00"));
$to_time                                    	= implode(':', array($tostatsday_hour, $tostatsday_min, "59"));  
$date_from_complete 				= implode(" ", array($from_date, $from_time));
$date_to_complete				= implode(" ", array($to_date, $to_time));
$sql_from_to_day                            	= "(`t1`.`starttime` BETWEEN '$date_from_complete' AND '$date_to_complete')";        
$sql_dst					= "`t1`.`destination` LIKE '%$dst%'";
$sql_src					= "`t1`.`src` LIKE '%$src%'";
$sql_dnid					= "`t1`.`dnid` LIKE '%$dnid%'";
//$sql_choose_calltype				= "`t1`.`sipiax` LIKE '%$choose_calltype%'";
//$sql_terminatecauseid				= "`t1`.`terminatecauseid` LIKE '%$terminatecauseid%'";
$sql_entercustomer				= "`t1`.`card_id` LIKE '%$entercustomer%'";
$sql_entercustomer_num				= "`t2`.`username` LIKE '%$entercustomer_num%'";
$sql_entertariffgroup				= "`t1`.`id_tariffgroup` LIKE '%$entertariffgroup%'";
$sql_enterprovider				= "`t3`.`id_provider` LIKE '%$enterprovider%'";
$sql_entertrunk					= "`t1`.`id_trunk` LIKE '%$entertrunk%'";
$sql_enterratecard				= "`t1`.`id_ratecard` LIKE '%$enterratecard%'";


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



$sql_cdrs = mysql_query("SELECT t2.username, t1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest, t4.buyrate, t4.rateinitial, t1.sessiontime, t1.card_id, t3.trunkcode, t1.terminatecauseid, t3.id_provider, t1.sipiax, t1.buycost, t1.sessionbill,
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
$sql_enterratecard AND $sql_show_calls AND $sql_from_to_day ORDER BY t1.starttime DESC LIMIT $start, $perhalaman;", $conn_voip);
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Search CDRs Customer = SELECT t2.username, t1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest, t4.buyrate, t4.rateinitial, t1.sessiontime, t1.card_id, t3.trunkcode, t1.terminatecauseid, t3.id_provider, t1.sipiax, t1.buycost, t1.sessionbill,
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
											$sql_enterratecard AND $sql_show_calls AND $sql_from_to_day LIMIT $start, $perhalaman;");

											
$sql_total_data	= mysql_num_rows(mysql_query("SELECT t2.username, t1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest, t4.buyrate, t4.rateinitial, t1.sessiontime, t1.card_id, t3.trunkcode, t1.terminatecauseid, t3.id_provider, t1.sipiax, t1.buycost, t1.sessionbill,
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
$sql_enterratecard AND $sql_show_calls AND $sql_from_to_day;", $conn_voip));

$hal		= "?";
											
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
$sql_cdrs = mysql_query("SELECT t1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest, t4.buyrate, t4.rateinitial, t1.sessiontime, t1.card_id, t3.trunkcode, t1.terminatecauseid, t1.sipiax, t1.buycost, t1.sessionbill, case when t1.sessionbill!=0 then ((t1.sessionbill-t1.buycost)/t1.sessionbill)*100 else NULL end as margin,case when t1.buycost!=0 then ((t1.sessionbill-t1.buycost)/t1.buycost)*100 else NULL end as markup
                        FROM cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id ORDER BY t1.starttime DESC LIMIT $start, $perhalaman;", $conn_voip);
$sql_total_data = mysql_num_rows(mysql_query("SELECT t1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest, t4.buyrate, t4.rateinitial, t1.sessiontime, t1.card_id, t3.trunkcode, t1.terminatecauseid, t1.sipiax, t1.buycost, t1.sessionbill, case when t1.sessionbill!=0 then ((t1.sessionbill-t1.buycost)/t1.sessionbill)*100 else NULL end as margin,case when t1.buycost!=0 then ((t1.sessionbill-t1.buycost)/t1.buycost)*100 else NULL end as markup
                        FROM cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id", $conn_voip));
$hal = "?";
} 
    
    
            
    $content =' 

                <!-- Main content -->
                <section class="content">

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">CDRs Customer</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">';

/*
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
*/




$content .= '
<!-- ** ** ** ** ** Part for the research ** ** ** ** ** -->
<center>
<FORM METHOD="POST" name="myForm" ACTION="">
<TABLE class="bar-status" width="85%" border="0" cellspacing="1" cellpadding="2" align="center">
				<tr>
		<td align="left" valign="top" class="bgcolor_004"><font
			class="fontstyle_003">&nbsp;&nbsp;CUSTOMERS</font>
		</td>
		<td class="bgcolor_005" align="left">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="fontstyle_searchoptions" width="700" valign="top">
					Enter the customer ID: <INPUT TYPE="text"
					NAME="entercustomer" value=""
					id="card_id"> <a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_id_cust.php\');">id</a>
				 <BR> OR <br>
				Enter the customer number: <INPUT TYPE="text" NAME="entercustomer_num" id="numb_customer"
					value="" class="form_input_text"> 
                                        <a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_numb_cust.php\');">numb customer</a>
				</td>
				<td width="50%">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="left" class="fontstyle_searchoptions">CallPlan :</td>
						<td align="left" class="fontstyle_searchoptions"><INPUT TYPE="text" NAME="entertariffgroup" value="" size="4" id="numb_call_plan" class="form_input_text">&nbsp;
						<a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_call_plan.php\');">id</a></td>
						<td align="left" class="fontstyle_searchoptions">Provider :
			
			<td align="left" class="fontstyle_searchoptions"><INPUT
							TYPE="text" NAME="enterprovider"
							value="" size="4" class="form_input_text" id="data_provider">&nbsp;
							<a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_provider.php\');">id</a></td>
					</tr>
					<tr>
						<td align="left" class="fontstyle_searchoptions">Trunk :</td>
						<td align="left" class="fontstyle_searchoptions"><INPUT
							TYPE="text" NAME="entertrunk" value=""
							size="4" class="form_input_text" id="id_trunk">&nbsp;
							<a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_trunk.php\');">id</a>
							</td>
						<td align="left" class="fontstyle_searchoptions">Rate :</td>
						<td align="left" class="fontstyle_searchoptions"><INPUT
							TYPE="text" NAME="enterratecard"
							value="" size="4"
							class="form_input_text" id="data_rate">&nbsp;
							<a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_rate.php\');">id</a>
							</td>
					</tr>
				</table>
				</td>
			</tr>

		</table>
		</td>
	</tr>			
			<tr>
		<td align="left" class="bgcolor_004"><font class="fontstyle_003">&nbsp;&nbsp;DATE</font>
		</td>
		<td align="left" class="bgcolor_005">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="fontstyle_searchoptions">From :
				<select name="fromstatsday_sday" class="form_input_select">';
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
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m - $month_r - 1), $time_d, $time_Y))).'"  selected>'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
                                                }else{
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m - $month_r - 1), $time_d, $time_Y))).'" >'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
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
				<option value="00">00</option>';
				for($to_sday=1; $to_sday<=31; $to_sday++){
				    if($to_sday<10){
					$content .= '<option value="0'.$to_sday.'">0'.$to_sday.'</option>';
				    }else{
					$content .= '<option value="'.$to_sday.'">'.$to_sday.'</option>';
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
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m - $month_r - 1), $time_d, $time_Y))).'"  selected>'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
                                                }else{
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m - $month_r - 1), $time_d, $time_Y))).'" >'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
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
		<td class="bgcolor_002" align="left"><font class="fontstyle_003">&nbsp;&nbsp;PHONENUMBER</font>
		</td>
		<td class="bgcolor_003" align="left">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>&nbsp;&nbsp;<INPUT TYPE="text" NAME="dst"
					value="" class="form_input_text"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="left" class="bgcolor_004"><font class="fontstyle_003">&nbsp;&nbsp;CALLERID</font>
		</td>
		<td class="bgcolor_005" align="left">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>&nbsp;&nbsp;<INPUT TYPE="text" NAME="src"
					value="" class="form_input_text"></td>
			</tr>
		</table>
		</td>
	</tr>

	<tr>
		<td align="left" class="bgcolor_004"><font class="fontstyle_003">&nbsp;&nbsp;DNID</font>
		</td>
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
		<td class="bgcolor_002" align="left"><font class="fontstyle_003">&nbsp;&nbsp;CALL TYPE</font></td>
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
		<td class="bgcolor_002" align="left"><font class="fontstyle_003">&nbsp;&nbsp;OPTIONS</font></td>
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

               
$content .= '	<table align="right"><tr align="right">
        <td align="right"> &nbsp; </td>
	 </tr></table>

	<br><br>';
/* 		
Date	=> cc_call.starttime
CallerID => cc_card.useralias -> src
DNID => cc_call.dnid
Phone Number => cc_card.calledstation
Destination => cc_call_destination -> card.destination
Buy Rate => cc_ratecard.buyrate
Sell Rate => cc_ratecard.rateinitial
Duration =>  stoptime -	starttime -> cc_card.sessiontime
Account => cc_card.card_id
Trunk => cc_trunk.trunkcode
TC => cc_card.terminatecauseid
CallType => cc_card.sipiax
Buy => cc_card.buycost
Sell => cc_card.buycost
Margin => margin
Markup => markup
*/
$content .= '<table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Date</th>
                                                <th>CallerID</th>
                                                <th>DNID</th>
                                                <th>Phone Number</th>
                                                <th>Destination</th>
                                                <th>Buy Rate</th>
						<th>Sell Rate</th>
                                                <th>Duration</th>
                                                <th>Account</th>
                                                <th>Trunk</th>
                                                <th>TC</th>
                                                <th>CallType</th>
                                                <th>Buy</th>
                                                <th>Sell</th>
                                                <th>Margin</th>
                                                <th>Markup</th>
                                                <th></th>
                                                <th></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>';
/*					
$FG_TABLE_NAME = "cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id";

    // This Variable store the argument for the SQL query
    $FG_COL_QUERY = 't1.starttime, t1.src, t1.dnid, t1.calledstation,
    t1.destination AS dest, t4.buyrate, t4.rateinitial, t1.sessiontime,
    t1.card_id, t3.trunkcode, t1.terminatecauseid, t1.sipiax, t1.buycost, t1.sessionbill,
    case when t1.sessionbill!=0 then ((t1.sessionbill-t1.buycost)/t1.sessionbill)*100 else NULL end as margin,case when t1.buycost!=0 then ((t1.sessionbill-t1.buycost)/t1.buycost)*100 else NULL end as markup';


*/
$no = $start +1;
$data_choose_cur = isset($_POST['choose_currency']) ? $_POST['choose_currency'] : 'IDR';
$data_pembagi_nilai_currency = mysql_fetch_array(mysql_query("SELECT `currency`, `value` FROM `cc_currencies` WHERE `currency`='$data_choose_cur'", $conn_voip));    
					while($row_cdrs = mysql_fetch_array($sql_cdrs)){
					    
					       
						    $content .= '
						    <tr>
						    <td>'.$no.'</th>
						    <td>'.$row_cdrs['starttime'].'</th>
						    <td>'.$row_cdrs['src'].'</th>
						    <td>'.$row_cdrs['dnid'].'</th>
						    <td>'.$row_cdrs['calledstation'].'</th>
						    <td>';
						    
						    $data_array_prefix = mysql_fetch_array(mysql_query("SELECT  `cc_prefix`.`destination` FROM `cc_prefix` WHERE `cc_prefix`.`prefix`='$row_cdrs[dest]'", $conn_voip));
												    
						    $content .= '
						    '.$data_array_prefix['destination'].'
						    </td>';

						    $content .= '
						    <td>'.(isset($_POST['choose_currency']) ? ($row_cdrs['buyrate'] / $data_pembagi_nilai_currency['value']) : $row_cdrs['buyrate']).' '.$data_choose_cur.'</td>
						    <td>'.(isset($_POST['choose_currency']) ? ($row_cdrs['rateinitial'] / $data_pembagi_nilai_currency['value']) : $row_cdrs['rateinitial']).' '.$data_choose_cur.'</td>
						    <td>'.((isset($_POST['resulttype']) ? $_POST['resulttype'] : '') == 'min' ? date("i:s", $row_cdrs['sessiontime']) : date("s", $row_cdrs['sessiontime'])).'</td>
						    <td>';
						    $data_array_username = mysql_fetch_array(mysql_query("SELECT `username` FROM `cc_card` WHERE `id`='$row_cdrs[card_id]'", $conn_voip));
						    $content .= ''.$data_array_username['username'].'</td>
						    <td>'.$row_cdrs['trunkcode'].'</td>
						    <td>';
						    if ($row_cdrs['terminatecauseid'] == 1 && $row_cdrs['terminatecauseid'] > 0 ) {
							$content .= "ANSWER";
						    }
						    elseif ($row_cdrs['terminatecauseid'] != 1 && $row_cdrs['terminatecauseid'] > 0 ) {
							$content .= "INCOMPLET";
						    }
						    elseif ($row_cdrs['terminatecauseid'] == 5 && $row_cdrs['terminatecauseid'] > 0 ) {
							$content .= "CONGESTION";
						    }
						    elseif ($row_cdrs['terminatecauseid'] == 3 && $row_cdrs['terminatecauseid'] > 0 ) {
							$content .= "NOANSWER";	
						    }
						    elseif ($row_cdrs['terminatecauseid'] == 2 && $row_cdrs['terminatecauseid'] > 0 ) {
							$content .= "BUSY";
						    }
						    elseif ($row_cdrs['terminatecauseid'] == 6 && $row_cdrs['terminatecauseid'] > 0 ) {
							$content .= "CHANUNAVAIL";
						    }
						    elseif ($row_cdrs['terminatecauseid'] == 4 && $row_cdrs['terminatecauseid'] > 0 ) {
							$content .= "CANCEL";	
						    }
						    $content .= '</td>
						    <td>'.$row_cdrs['sipiax'].'</td>
						    <td>'.$row_cdrs['buycost'].'</td>
						    <td>'.$row_cdrs['sessionbill'].'</td>
						    <td>'.($row_cdrs['margin'] != 0 ? $row_cdrs['margin'] ."%" : "" ).'</td>
						    <td>'.($row_cdrs['markup'] != 0 ? $row_cdrs['markup'] ."%" : "" ).'</td>';
						    $content .= '
						    <td></td>
						    <td></td>
						    </tr>';
						    $no++;
					   
					    
					}
					
$content .= '                           </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>CallerID</th>
                                                <th>DNID</th>
                                                <th>Phone Number</th>
                                                <th>Destination</th>
                                                <th>Buy Rate</th>
						<th>Sell Rate</th>
                                                <th>Duration</th>
                                                <th>Account</th>
                                                <th>Trunk</th>
                                                <th>TC</th>
                                                <th>CallType</th>
                                                <th>Buy</th>
                                                <th>Sell</th>
                                                <th>Margin</th>
                                                <th>Markup</th>
                                                <th></th>
                                                <th></th>
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
							  <div class="box-footer">
									<div class="box-tools pull-right">
									'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
									</div>
									<br style="clear:both;">
								</div>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->';	        
$plugins = '
        <script Language="JavaScript">
	function load_url(link) {
	var link;
	var load_url = window.open(link,\'\',\'height=600,width=950,resizable=yes,scrollbars=yes\');
	}
	</script>
	<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
';

    $title	= 'CDRs Customer';
    $submenu	= "voip_cdrcustomer";
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