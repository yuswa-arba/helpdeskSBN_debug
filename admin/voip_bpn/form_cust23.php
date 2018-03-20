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
    $username_cust	= isset($_GET["cust_id"]) ? $_GET["cust_id"] : "";
    if(isset($_GET["form_action"]) == "edit-cust"){
	$act	= 'Open Form Edit Customer with username = '.$username_cust;
    }else{
	$act	= 'Open Form Customer';
    }
    enableLog("", $loggedin["username"], $loggedin["id_employee"], $act);
    global $conn;
    global $conn_voip;
    
    $edit = isset($_POST["confirm_edit"]) ? $_POST["confirm_edit"] : "";
    $save = isset($_POST["confirm_save"]) ? $_POST["confirm_save"] : "";
    $sql_last_cust  = mysql_fetch_array(mysql_query("SELECT * FROM `cc_card` ORDER BY `id` DESC", $conn_voip));
    $last_data  = $sql_last_cust["id"] + 1;
    if($save == "Confirm Data"){
	$username 		= isset($_POST['username']) ? mysql_real_escape_string(strip_tags(trim($_POST['username']))) : "";
	$useralias 		= isset($_POST['useralias']) ? mysql_real_escape_string(strip_tags(trim($_POST['useralias']))) : "";
	$uipass 		= isset($_POST['uipass']) ? mysql_real_escape_string(strip_tags(trim($_POST['uipass']))) : "";
	$credit 		= isset($_POST['credit']) ? mysql_real_escape_string(strip_tags(trim($_POST['credit']))) : "";
	$id_group 		= isset($_POST['id_group']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_group']))) : "";
	$id_seria 		= isset($_POST['id_seria']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_seria']))) : "";
	$lastname 		= isset($_POST['lastname']) ? mysql_real_escape_string(strip_tags(trim($_POST['lastname']))) : "";
	$firstname 		= isset($_POST['firstname']) ? mysql_real_escape_string(strip_tags(trim($_POST['firstname']))) : "";
	$email 			= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	$address 		= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$city 			= isset($_POST['city']) ? mysql_real_escape_string(strip_tags(trim($_POST['city']))) : "";
	$state 			= isset($_POST['state']) ? mysql_real_escape_string(strip_tags(trim($_POST['state']))) : "";
	$country		= isset($_POST['country']) ? mysql_real_escape_string(strip_tags(trim($_POST['country']))) : "";
	$zipcode 		= isset($_POST['zipcode']) ? mysql_real_escape_string(strip_tags(trim($_POST['zipcode']))) : "";
	$phone 			= isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
	$fax 			= isset($_POST['fax']) ? mysql_real_escape_string(strip_tags(trim($_POST['fax']))) : "";
	$company_name 		= isset($_POST['company_name']) ? mysql_real_escape_string(strip_tags(trim($_POST['company_name']))) : "";
	$company_website	= isset($_POST['company_website']) ? mysql_real_escape_string(strip_tags(trim($_POST['company_website']))) : "";
	$typepaid 		= isset($_POST['typepaid']) ? mysql_real_escape_string(strip_tags(trim($_POST['typepaid']))) : "";
	$tariff 		= isset($_POST['tariff']) ? mysql_real_escape_string(strip_tags(trim($_POST['tariff']))) : "";
	$id_didgroup 		= isset($_POST['id_didgroup']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_didgroup']))) : "";
	$id_timezone 		= isset($_POST['id_timezone']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_timezone']))) : "";
	$language 		= isset($_POST['language']) ? mysql_real_escape_string(strip_tags(trim($_POST['language']))) : "";
	$currency		= isset($_POST['currency']) ? mysql_real_escape_string(strip_tags(trim($_POST['currency']))) : "";
	$status 		= isset($_POST['status']) ? mysql_real_escape_string(strip_tags(trim($_POST['status']))) : "";
	$block			= isset($_POST['block']) ? mysql_real_escape_string(strip_tags(trim($_POST['block']))) : "";
	$lock_pin 		= isset($_POST['lock_pin']) ? mysql_real_escape_string(strip_tags(trim($_POST['lock_pin']))) : "";
	$simultaccess 		= isset($_POST['simultaccess']) ? mysql_real_escape_string(strip_tags(trim($_POST['simultaccess']))) : "";
	$runservice 		= isset($_POST['runservice']) ? mysql_real_escape_string(strip_tags(trim($_POST['runservice']))) : "";
	$creditlimit 		= isset($_POST['creditlimit']) ? mysql_real_escape_string(strip_tags(trim($_POST['creditlimit']))) : "";
	$credit_notification 	= isset($_POST['credit_notification']) ? mysql_real_escape_string(strip_tags(trim($_POST['credit_notification']))) : "";
	$notify_email 		= isset($_POST['notify_email']) ? mysql_real_escape_string(strip_tags(trim($_POST['notify_email']))) : "";
	$email_notification 	= isset($_POST['email_notification']) ? mysql_real_escape_string(strip_tags(trim($_POST['email_notification']))) : "";
	$id_campaign 		= isset($_POST['id_campaign']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_campaign']))) : "";
	$firstusedate 		= isset($_POST['firstusedate']) ? mysql_real_escape_string(strip_tags(trim($_POST['firstusedate']))) : "";
	$enableexpire 		= isset($_POST['enableexpire']) ? mysql_real_escape_string(strip_tags(trim($_POST['enableexpire']))) : "";
	$expirationdate 	= isset($_POST['expirationdate']) ? mysql_real_escape_string(strip_tags(trim($_POST['expirationdate']))) : "";
	$expiredays 		= isset($_POST['expiredays']) ? mysql_real_escape_string(strip_tags(trim($_POST['expiredays']))) : "";
	$sip_buddy 		= isset($_POST['sip_buddy']) ? mysql_real_escape_string(strip_tags(trim($_POST['sip_buddy']))) : "";
	$iax_buddy 		= isset($_POST['iax_buddy']) ? mysql_real_escape_string(strip_tags(trim($_POST['iax_buddy']))) : "";
	$mac_addr 		= isset($_POST['mac_addr']) ? mysql_real_escape_string(strip_tags(trim($_POST['mac_addr']))) : "";
	$inuse 			= isset($_POST['inuse']) ? mysql_real_escape_string(strip_tags(trim($_POST['inuse']))) : "";
	$autorefill 		= isset($_POST['autorefill']) ? mysql_real_escape_string(strip_tags(trim($_POST['autorefill']))) : "";
	$initialbalance 	= isset($_POST['initialbalance']) ? mysql_real_escape_string(strip_tags(trim($_POST['initialbalance']))) : "";
	$invoiceday 		= isset($_POST['invoiceday']) ? mysql_real_escape_string(strip_tags(trim($_POST['invoiceday']))) : "";
	$vat 			= isset($_POST['vat']) ? mysql_real_escape_string(strip_tags(trim($_POST['vat']))) : "";
	$vat_rn 		= isset($_POST['vat_rn']) ? mysql_real_escape_string(strip_tags(trim($_POST['vat_rn']))) : "";
	$discount 		= isset($_POST['discount']) ? mysql_real_escape_string(strip_tags(trim($_POST['discount']))) : "";
	$traffic 		= isset($_POST['traffic']) ? mysql_real_escape_string(strip_tags(trim($_POST['traffic']))) : "";
	$traffic_target 	= isset($_POST['traffic_target']) ? mysql_real_escape_string(strip_tags(trim($_POST['traffic_target']))) : "";
	$restriction 		= isset($_POST['restriction']) ? mysql_real_escape_string(strip_tags(trim($_POST['restriction']))) : "";
	$customer_number	= isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
	//insert cc_card
	$sql_cc_card = "INSERT INTO `mya2billing`.`cc_card` (`id`, `creationdate`, `firstusedate`, `expirationdate`, `enableexpire`, `expiredays`,
					     `username`, `useralias`, `uipass`, `credit`, `tariff`, `id_didgroup`, `activated`,
					     `status`, `lastname`, `firstname`, `address`, `city`, `state`, `country`, `zipcode`,
					     `phone`, `email`, `fax`, `inuse`, `simultaccess`, `currency`, `lastuse`, `nbused`,
					     `typepaid`, `creditlimit`, `voipcall`, `sip_buddy`, `iax_buddy`, `language`, `redial`,
					     `runservice`, `nbservice`, `id_campaign`, `num_trials_done`, `vat`, `servicelastrun`,
					     `initialbalance`, `invoiceday`, `autorefill`, `loginkey`, `mac_addr`, `id_timezone`,
					     `tag`, `voicemail_permitted`, `voicemail_activated`, `last_notification`, `email_notification`,
					     `notify_email`, `credit_notification`, `id_group`, `company_name`, `company_website`,
					     `vat_rn`, `traffic`, `traffic_target`, `discount`, `restriction`, `id_seria`, `serial`,
					     `block`, `lock_pin`, `lock_date`)
			VALUES ('', NOW(), '0000-00-00 00:00:00', '$expirationdate', '$enableexpire', '$expiredays',
				'$username', '$useralias', '$uipass','$credit', '$tariff', '$id_didgroup', 'f',
				'$status', '$lastname', '$firstname', '$address', '$city', '$state', '$country', '$zipcode',
				'$phone', '$email', '$fax', '$inuse', '$simultaccess', '$currency', '0000-00-00 00:00:00', '0',
				'$typepaid', '$creditlimit', '0', '$sip_buddy', '$iax_buddy', '$language', '',
				'$runservice', '0', '$id_campaign', '0', '$vat', '0000-00-00 00:00:00',
				'$initialbalance', '$invoiceday', '$autorefill', '', '$mac_addr', '$id_timezone',
				'', '0', '0', NULL, '$email_notification',
				'0', '$credit_notification', '$id_group', '$company_name', '$company_website',
				'$vat_rn', '$traffic', '$traffic_target', '$discount', '$restriction', '$id_seria', NULL,
				'$block', '$lock_pin', NULL);";
	//echo $sql_cc_card;
	
        mysql_query($sql_cc_card, $conn_voip) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	
	//insert cc_callerid
	$sql_cc_callerid = "INSERT INTO `mya2billing`.`cc_callerid` (`id`, `cid`, `id_cc_card`, `activated`)
							     VALUES ('', '$useralias', '$last_data', 't');";
	//echo $sql_cc_callerid;
	
        mysql_query($sql_cc_callerid, $conn_voip) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	
	//insert cc_iax_buddies
	$sql_cc_iax_buddies = "INSERT INTO `mya2billing`.`cc_iax_buddies` (`id`, `id_cc_card`, `name`, `accountcode`, `regexten`, `amaflags`, `callerid`,
						    `context`, `DEFAULTip`, `host`, `language`, `deny`, `permit`, `mask`, `port`,
						    `qualify`, `secret`, `type`, `username`, `disallow`, `allow`, `regseconds`,
						    `ipaddr`, `trunk`, `dbsecret`, `regcontext`, `sourceaddress`, `mohinterpret`,
						    `mohsuggest`, `inkeys`, `outkey`, `cid_number`, `sendani`, `fullname`, `auth`,
						    `maxauthreq`, `encryption`, `transfer`, `jitterbuffer`, `forcejitterbuffer`,
						    `codecpriority`, `qualifysmoothing`, `qualifyfreqok`, `qualifyfreqnotok`,
						    `timezone`, `adsi`, `setvar`, `requirecalltoken`, `maxcallnumbers`,
						    `maxcallnumbers_nonvalidated`)
					    VALUES ('', '$last_data', '$username', '$username', '$username', 'billing', '',
						    'a2billing', NULL, 'dynamic', NULL, '', NULL, '', '',
						    'no', '1234', 'friend', '$username', '', 'ulaw,alaw,gsm,g729', '0',
						    '', 'no', '', '', '', '',
						    '', '', '', '', '', '', '',
						    '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');";
	//echo $sql_cc_iax_buddies;
	
        mysql_query($sql_cc_iax_buddies, $conn_voip) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	
	//insert cc_iax_buddies
	$sql_cc_sip_buddies = "INSERT INTO `mya2billing`.`cc_sip_buddies` (`id`, `id_cc_card`, `name`, `accountcode`, `regexten`, `amaflags`, `callgroup`,
						    `callerid`, `canreinvite`, `context`, `DEFAULTip`, `dtmfmode`, `fromuser`,
						    `fromdomain`, `host`, `insecure`, `language`, `mailbox`, `md5secret`, `nat`,
						    `deny`, `permit`, `mask`, `pickupgroup`, `port`, `qualify`, `restrictcid`,
						    `rtptimeout`, `rtpholdtimeout`, `secret`, `type`, `username`, `disallow`, `allow`,
						    `musiconhold`, `regseconds`, `ipaddr`, `cancallforward`, `fullcontact`, `setvar`,
						    `regserver`, `lastms`, `defaultuser`, `auth`, `subscribemwi`, `vmexten`, `cid_number`,
						    `callingpres`, `usereqphone`, `incominglimit`, `subscribecontext`, `musicclass`,
						    `mohsuggest`, `allowtransfer`, `autoframing`, `maxcallbitrate`, `outboundproxy`,
						    `rtpkeepalive`, `useragent`)
					    VALUES ('', '$last_data', '$username', '$username', '$username', 'billing', NULL, '', 'YES', 'a2billing', NULL, 'RFC2833', '', '',
						    'dynamic', '', NULL, '', '', 'yes', '', NULL, '', NULL, '', 'no', NULL, NULL, NULL, '1234', 'friend', '$username',
						    'ALL', 'ulaw,alaw,gsm,g729', '', '0', '', 'yes', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '',
						    '', '', '', '', '0', NULL);";
	//echo $sql_cc_sip_buddies;
	
        mysql_query($sql_cc_sip_buddies, $conn_voip) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	
	$query_update_voip_numb = "UPDATE `gx_voip_nomerTelpon` SET `customer_number` = '$customer_number', `status` = '0'
					WHERE `nomer_telpon` = '$useralias'";
        //echo $query;
	
        mysql_query($query_update_voip_numb, $conn) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	
	echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'list_customer.php';
            </script>";
	
	
	/*
	$sql_cc_card = "INSERT INTO `mya2billing`.`cc_card` (`id`, `creationdate`, `firstusedate`, `expirationdate`, `enableexpire`, `expiredays`,
					     `username`, `useralias`, `uipass`, `credit`, `tariff`, `id_didgroup`, `activated`,
					     `status`, `lastname`, `firstname`, `address`, `city`, `state`, `country`, `zipcode`,
					     `phone`, `email`, `fax`, `inuse`, `simultaccess`, `currency`, `lastuse`, `nbused`,
					     `typepaid`, `creditlimit`, `voipcall`, `sip_buddy`, `iax_buddy`, `language`, `redial`,
					     `runservice`, `nbservice`, `id_campaign`, `num_trials_done`, `vat`, `servicelastrun`,
					     `initialbalance`, `invoiceday`, `autorefill`, `loginkey`, `mac_addr`, `id_timezone`,
					     `tag`, `voicemail_permitted`, `voicemail_activated`, `last_notification`, `email_notification`,
					     `notify_email`, `credit_notification`, `id_group`, `company_name`, `company_website`,
					     `vat_rn`, `traffic`, `traffic_target`, `discount`, `restriction`, `id_seria`, `serial`,
					     `block`, `lock_pin`, `lock_date`)
	VALUES ('', NOW(), '0000-00-00 00:00:00', '2025-01-28 11:12:38', '0', '0', '39600', '1717', '1234',
		'1000', '1', '-1', 'f', '1', 'demo', 'input', 'dinoyo', 'malang', 'jawa timur', 'IDN', '123', '12345678',
		'demo@gmail.com', '1', '0', '1', 'IDR', '0000-00-00 00:00:00', '0', '0', '0', '0', '1', '1', 'en', '', '1',
		'0', '-1', '0', '0', '0000-00-00 00:00:00', '0', '1', '0', '', '00-00-00-00-00-00', '59', '', '0', '0', NULL,
		'', '0', '-1', '1', '12', '1234', NULL, NULL, '', '0', '0', '-1', NULL, '0', '0', NULL);";
	
	
	//insert cc_callerid
	INSERT INTO `mya2billing`.`cc_callerid` (`id`, `cid`, `id_cc_card`, `activated`) VALUES ('11', '1712', '10', 't');
	
	//insert cc_iax_buddies
	INSERT INTO `mya2billing`.`cc_iax_buddies` (`id`, `id_cc_card`, `name`, `accountcode`, `regexten`, `amaflags`, `callerid`,
						    `context`, `DEFAULTip`, `host`, `language`, `deny`, `permit`, `mask`, `port`,
						    `qualify`, `secret`, `type`, `username`, `disallow`, `allow`, `regseconds`,
						    `ipaddr`, `trunk`, `dbsecret`, `regcontext`, `sourceaddress`, `mohinterpret`,
						    `mohsuggest`, `inkeys`, `outkey`, `cid_number`, `sendani`, `fullname`, `auth`,
						    `maxauthreq`, `encryption`, `transfer`, `jitterbuffer`, `forcejitterbuffer`,
						    `codecpriority`, `qualifysmoothing`, `qualifyfreqok`, `qualifyfreqnotok`,
						    `timezone`, `adsi`, `setvar`, `requirecalltoken`, `maxcallnumbers`,
						    `maxcallnumbers_nonvalidated`)
	VALUES ('2', '12', '39600', '39600', '39600', 'billing', '', 'a2billing', NULL, 'dynamic', NULL, '', NULL, '', '',
		'no', '1234', 'friend', '39600', '', 'ulaw,alaw,gsm,g729', '0', '', 'no', '', '', '', '', '', '', '', '', '',
		'', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
	
	//insert cc_sip_buddies
	INSERT INTO `mya2billing`.`cc_sip_buddies` (`id`, `id_cc_card`, `name`, `accountcode`, `regexten`, `amaflags`, `callgroup`,
						    `callerid`, `canreinvite`, `context`, `DEFAULTip`, `dtmfmode`, `fromuser`,
						    `fromdomain`, `host`, `insecure`, `language`, `mailbox`, `md5secret`, `nat`,
						    `deny`, `permit`, `mask`, `pickupgroup`, `port`, `qualify`, `restrictcid`,
						    `rtptimeout`, `rtpholdtimeout`, `secret`, `type`, `username`, `disallow`, `allow`,
						    `musiconhold`, `regseconds`, `ipaddr`, `cancallforward`, `fullcontact`, `setvar`,
						    `regserver`, `lastms`, `defaultuser`, `auth`, `subscribemwi`, `vmexten`, `cid_number`,
						    `callingpres`, `usereqphone`, `incominglimit`, `subscribecontext`, `musicclass`,
						    `mohsuggest`, `allowtransfer`, `autoframing`, `maxcallbitrate`, `outboundproxy`,
						    `rtpkeepalive`, `useragent`)
	VALUES ('6', '12', '39600', '39600', '39600', 'billing', NULL, '', 'YES', 'a2billing', NULL, 'RFC2833', '', '',
		'dynamic', '', NULL, '', '', 'yes', '', NULL, '', NULL, '', 'no', NULL, NULL, NULL, '1234', 'friend', '39600',
		'ALL', 'ulaw,alaw,gsm,g729', '', '0', '', 'yes', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '',
		'', '', '', '', '0', NULL);
	*/
	
    }elseif($edit == "Confirm Data"){
	
	$useralias 		= isset($_POST['useralias']) ? mysql_real_escape_string(strip_tags(trim($_POST['useralias']))) : "";
	$uipass 		= isset($_POST['uipass']) ? mysql_real_escape_string(strip_tags(trim($_POST['uipass']))) : "";
	$credit 		= isset($_POST['credit']) ? mysql_real_escape_string(strip_tags(trim($_POST['credit']))) : "";
	$id_group 		= isset($_POST['id_group']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_group']))) : "";
	$id_seria 		= isset($_POST['id_seria']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_seria']))) : "";
	$lastname 		= isset($_POST['lastname']) ? mysql_real_escape_string(strip_tags(trim($_POST['lastname']))) : "";
	$firstname 		= isset($_POST['firstname']) ? mysql_real_escape_string(strip_tags(trim($_POST['firstname']))) : "";
	$email 			= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	$address 		= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$city 			= isset($_POST['city']) ? mysql_real_escape_string(strip_tags(trim($_POST['city']))) : "";
	$state 			= isset($_POST['state']) ? mysql_real_escape_string(strip_tags(trim($_POST['state']))) : "";
	$country		= isset($_POST['country']) ? mysql_real_escape_string(strip_tags(trim($_POST['country']))) : "";
	$zipcode 		= isset($_POST['zipcode']) ? mysql_real_escape_string(strip_tags(trim($_POST['zipcode']))) : "";
	$phone 			= isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
	$fax 			= isset($_POST['fax']) ? mysql_real_escape_string(strip_tags(trim($_POST['fax']))) : "";
	$company_name 		= isset($_POST['company_name']) ? mysql_real_escape_string(strip_tags(trim($_POST['company_name']))) : "";
	$company_website	= isset($_POST['company_website']) ? mysql_real_escape_string(strip_tags(trim($_POST['company_website']))) : "";
	$typepaid 		= isset($_POST['typepaid']) ? mysql_real_escape_string(strip_tags(trim($_POST['typepaid']))) : "";
	$tariff 		= isset($_POST['tariff']) ? mysql_real_escape_string(strip_tags(trim($_POST['tariff']))) : "";
	$id_didgroup 		= isset($_POST['id_didgroup']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_didgroup']))) : "";
	$id_timezone 		= isset($_POST['id_timezone']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_timezone']))) : "";
	$language 		= isset($_POST['language']) ? mysql_real_escape_string(strip_tags(trim($_POST['language']))) : "";
	$currency		= isset($_POST['currency']) ? mysql_real_escape_string(strip_tags(trim($_POST['currency']))) : "";
	$status 		= isset($_POST['status']) ? mysql_real_escape_string(strip_tags(trim($_POST['status']))) : "";
	$block			= isset($_POST['block']) ? mysql_real_escape_string(strip_tags(trim($_POST['block']))) : "";
	$lock_pin 		= isset($_POST['lock_pin']) ? mysql_real_escape_string(strip_tags(trim($_POST['lock_pin']))) : "";
	$simultaccess 		= isset($_POST['simultaccess']) ? mysql_real_escape_string(strip_tags(trim($_POST['simultaccess']))) : "";
	$runservice 		= isset($_POST['runservice']) ? mysql_real_escape_string(strip_tags(trim($_POST['runservice']))) : "";
	$creditlimit 		= isset($_POST['creditlimit']) ? mysql_real_escape_string(strip_tags(trim($_POST['creditlimit']))) : "";
	$credit_notification 	= isset($_POST['credit_notification']) ? mysql_real_escape_string(strip_tags(trim($_POST['credit_notification']))) : "";
	$notify_email 		= isset($_POST['notify_email']) ? mysql_real_escape_string(strip_tags(trim($_POST['notify_email']))) : "";
	$email_notification 	= isset($_POST['email_notification']) ? mysql_real_escape_string(strip_tags(trim($_POST['email_notification']))) : "";
	$id_campaign 		= isset($_POST['id_campaign']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_campaign']))) : "";
	$firstusedate 		= isset($_POST['firstusedate']) ? mysql_real_escape_string(strip_tags(trim($_POST['firstusedate']))) : "";
	$enableexpire 		= isset($_POST['enableexpire']) ? mysql_real_escape_string(strip_tags(trim($_POST['enableexpire']))) : "";
	$expirationdate 	= isset($_POST['expirationdate']) ? mysql_real_escape_string(strip_tags(trim($_POST['expirationdate']))) : "";
	$expiredays 		= isset($_POST['expiredays']) ? mysql_real_escape_string(strip_tags(trim($_POST['expiredays']))) : "";
	$sip_buddy 		= isset($_POST['sip_buddy']) ? mysql_real_escape_string(strip_tags(trim($_POST['sip_buddy']))) : "";
	$iax_buddy 		= isset($_POST['iax_buddy']) ? mysql_real_escape_string(strip_tags(trim($_POST['iax_buddy']))) : "";
	$mac_addr 		= isset($_POST['mac_addr']) ? mysql_real_escape_string(strip_tags(trim($_POST['mac_addr']))) : "";
	$inuse 			= isset($_POST['inuse']) ? mysql_real_escape_string(strip_tags(trim($_POST['inuse']))) : "";
	$autorefill 		= isset($_POST['autorefill']) ? mysql_real_escape_string(strip_tags(trim($_POST['autorefill']))) : "";
	$initialbalance 	= isset($_POST['initialbalance']) ? mysql_real_escape_string(strip_tags(trim($_POST['initialbalance']))) : "";
	$invoiceday 		= isset($_POST['invoiceday']) ? mysql_real_escape_string(strip_tags(trim($_POST['invoiceday']))) : "";
	$vat 			= isset($_POST['vat']) ? mysql_real_escape_string(strip_tags(trim($_POST['vat']))) : "";
	$vat_rn 		= isset($_POST['vat_rn']) ? mysql_real_escape_string(strip_tags(trim($_POST['vat_rn']))) : "";
	$discount 		= isset($_POST['discount']) ? mysql_real_escape_string(strip_tags(trim($_POST['discount']))) : "";
	$traffic 		= isset($_POST['traffic']) ? mysql_real_escape_string(strip_tags(trim($_POST['traffic']))) : "";
	$traffic_target 	= isset($_POST['traffic_target']) ? mysql_real_escape_string(strip_tags(trim($_POST['traffic_target']))) : "";
	$restriction 		= isset($_POST['restriction']) ? mysql_real_escape_string(strip_tags(trim($_POST['restriction']))) : "";
	
	$query = "UPDATE `cc_card` SET `useralias` = '$useralias', `uipass` = '$uipass',`credit` = '$credit', `id_group` = '$id_group',
					`id_seria` = '$id_seria', `lastname` = '$lastname' ,`firstname` = '$firstname', `email` = '$email',
					`address` = '$address', `city` = '$city', `state` = '$state', `country` = '$country', `zipcode` = '$zipcode',
					`phone` = '$phone', `fax` = '$fax', `company_name` = '$company_name', `company_website` = '$company_website',
					`typepaid` = '$typepaid', `tariff` = '$tariff', `id_didgroup` = '$id_didgroup', `id_timezone` = '$id_timezone',
					`language` = '$language', `currency` = '$currency', `status` = '$status', `block` = '$block',`lock_pin` = '$lock_pin', 
					`simultaccess` = '$simultaccess' ,`runservice` = '$runservice', `creditlimit` = '$creditlimit',`credit_notification` = '$credit_notification',
					`notify_email` = '$notify_email', `email_notification` = '$email_notification', `id_campaign` = '$id_campaign',`firstusedate` = '$firstusedate',
					`enableexpire` = '$enableexpire', `expirationdate` = '$expirationdate', `expiredays` = '$expiredays',`sip_buddy` = '$sip_buddy',
					`iax_buddy` = '$iax_buddy', `mac_addr` = '$mac_addr', `inuse` = '$inuse',`autorefill` = '$autorefill', `initialbalance` = '$initialbalance',
					`invoiceday` = '$invoiceday', `vat` = '$vat', `vat_rn` = '$vat_rn',`discount` = '$discount', `traffic` = '$traffic', `traffic_target` = '$traffic_target', `restriction` = '$restriction'
					WHERE `username` = '$username_cust'";
        //echo $query;
	
        mysql_query($query, $conn_voip) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	 enableLog("", $loggedin["username"], $loggedin["id_employee"], $query);
	echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'list_customer.php';
            </script>";
	    
	
    }
    //echo "SELECT * FROM `cc_card` WHERE `username` = '".$username_cust."';";
    
    $sql_data_cust	= mysql_query("SELECT * FROM `cc_card` WHERE `username` = '".$username_cust."';", $conn_voip);
    $row_data_cust	= mysql_fetch_array($sql_data_cust);
    
    $random_5_number ='';
    for ($i = 0; $i<5; $i++){
	$random_5_number .= mt_rand(0,9);
    }
    $random_15_number ='';
    for ($i = 0; $i<15; $i++){
	$random_15_number .= mt_rand(0,9);
    }
    $random_10_number ='';
    for ($i = 0; $i<10; $i++){
	$random_10_number .= mt_rand(0,9);
    }
    
    //echo $random_5_number;
    $content ='<section class="content-header">
                    <h1>
                        Form Customer 
                    </h1>
                    
                </section>
		 <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-10"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Form Customer</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" id="myForm" method="post" name="myForm">
				    
                                    <div class="box-body">
				    <div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
					    <li class="active"><a href="#cust" data-toggle="tab">Data Customer</a></li>
					    <li><a href="#cust_voip" data-toggle="tab">Data VOIP</a></li>
					</ul>
					<div class="tab-content">
					    <div class="tab-pane" id="cust_voip">
					    
	<table cellspacing="2" class="addform_table1"  style="display: table;border-collapse: separate;border-spacing: 2px;border-color: gray;">
	    <input type="hidden" name="form_action" value="add">
	    <input type="hidden" name="wh" value="">
	    <input type="hidden" name="atmenu" value="">
	    <tbody>
	    <tr>
		<td width="%25" valign="top" bgcolor="#FEFEEE" colspan="2" class="tableBodyRight"><i>Customer Information</i></td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> ACCOUNT NUMBER </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <input class="form_input_text" name="username" size="30" value="'.(isset($_GET["cust_id"]) ? $row_data_cust["username"] : $random_5_number).'" readonly="" maxlength="40">
		    <span class="liens"> </span> 
	        </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> WEBUI LOGIN </td>
		<td width="%75" valign="top" class="tableBodyRight" >
		    <input class="form_input_text" readonly="" name="useralias" size="20" value="'.(isset($_GET["cust_id"]) ? $row_data_cust["useralias"] : '').'" maxlength="40"> 
		    <a href="'.URL_ADMIN.'voip_bpn/data_voipnumb.php?r=myForm" class="btn btn-primary" onclick="return valideopenerform(\''.URL_ADMIN.'voip_bpn/data_voipnumb.php?r=myForm\',\'notelp\');">Search</a>
		    <span class="liens"></span> 
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> WEBUI PASSWORD </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" readonly="" name="uipass" size="20" value="'.(isset($_GET["cust_id"]) ? $row_data_cust["uipass"] : $random_10_number).'" maxlength="20">
		    <span class="liens"></span> 
		    <br>Password for customer to access to the web interface and view the balance.
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> BALANCE </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="credit" size="30" maxlength="30" value="'.(isset($_GET["cust_id"]) ? Nominal($row_data_cust["credit"]) : "0").'">
		    <span class="liens"> </span> 
		    <br>currency : '.(isset($_GET["cust_id"]) ? $row_data_cust["currency"] : "IDR").'
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> CUSTOMER GROUP </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="id_group" class="form_input_select">';
			$sql_group = mysql_query("SELECT * FROM `cc_card_group` ", $conn_voip);
			
			
			while($row_group = mysql_fetch_array($sql_group)){
			    $content .='<option value="'.$row_group["id"].'" '.((isset($_GET["cust_id"] )&& ($row_data_cust["id_group"] == $row_group["id"])) ? 'selected=""' : "").'> '.$row_group["name"].'</option>';
			}
			
			
			$content .='
			
		    </select>
		    <span class="liens"></span> 
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> SERIAL </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="id_seria" class="form_input_select">
			<option value="-1" '.((isset($_GET["cust_id"] )&& ($row_data_cust["id_seria"] == "-1")) ? 'selected=""' : "").'>NOT DEFINED</option>
		    </select>
		    <span class="liens"> </span> 
		</td>
	    </tr>
	    		
	    <tr>
		<td width="%25" valign="top" bgcolor="#FEFEEE" colspan="2" class="tableBodyRight"><i>Customer Status</i></td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> PAYMENT TYPE </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="typepaid" class="form_input_select">
			<option value="0" '.((isset($_GET["cust_id"] )&& ($row_data_cust["typepaid"] == "0")) ? 'selected=""' : "").'> PREPAID CARD</option>
			<option value="1" '.((isset($_GET["cust_id"] )&& ($row_data_cust["typepaid"] == "1")) ? 'selected=""' : "").'> POSTPAID CARD</option>
		    </select>
		    <span class="liens"> </span> 
		</td>
	    </tr>			
	    <tr>
		<td width="%25" valign="middle" class="form_head"> CALL PLAN </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="tariff" class="form_input_select">
		    ';
			$sql_tariff = mysql_query("SELECT * FROM `cc_tariffgroup` ", $conn_voip);
			
			
			while($row_tariff = mysql_fetch_array($sql_tariff)){
			    $content .='<option value="'.$row_tariff["id"].'" '.((isset($_GET["cust_id"] )&& ($row_data_cust["tariff"] == $row_tariff["id"])) ? 'selected=""' : "").'> '.$row_tariff["tariffgroupname"].'</option>';    
			}
			
			$content .='
			
		    </select>
		    <span class="liens"></span> 
		    <br>Changing the call plan will result in the free minutes or free calls package being reset.
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> DIDGROUP </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="id_didgroup" class="form_input_select">
			<option value="-1" '.((isset($_GET["cust_id"] )&& ($row_data_cust["id_didgroup"] == "-1")) ? 'selected=""' : "").'>NOT DEFINED</option>
		    </select>
		    <span class="liens"></span> 
	        </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> TIMEZONE </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="id_timezone" class="form_input_select">
		    ';
			$sql_timezone = mysql_query("SELECT * FROM `cc_timezone` ", $conn_voip);
			
			
			while($row_timezone = mysql_fetch_array($sql_timezone)){
			    $content .='<option value="'.$row_timezone["id"].'" '.((isset($_GET["cust_id"] )&& ($row_data_cust["id_timezone"] == $row_timezone["id"])) ? 'selected=""' : "").'> '.$row_timezone["gmtzone"].'</option>';    
			}
			
			$content .='
		    </select>
		    <span class="liens"></span> 
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> LANGUAGE </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="language" class="form_input_select">
			<option value="en" '.((isset($_GET["cust_id"] )&& ($row_data_cust["language"] == "en")) ? 'selected=""' : "").'> ENGLISH</option>
			<option value="es" '.((isset($_GET["cust_id"] )&& ($row_data_cust["language"] == "es")) ? 'selected=""' : "").'> SPANISH</option>
			<option value="fr" '.((isset($_GET["cust_id"] )&& ($row_data_cust["language"] == "fr")) ? 'selected=""' : "").'> FRENCH</option>
			<option value="ru" '.((isset($_GET["cust_id"] )&& ($row_data_cust["language"] == "ru")) ? 'selected=""' : "").'> RUSSIAN</option>
			<option value="br" '.((isset($_GET["cust_id"] )&& ($row_data_cust["language"] == "br")) ? 'selected=""' : "").'> BRAZILIAN</option>
		    </select>
		    <span class="liens"></span> 
	        </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> CURRENCY </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="currency" class="form_input_select">
		    ';
			$sql_currency = mysql_query("SELECT * FROM `cc_currencies` ", $conn_voip);
			
			
			while($row_currency = mysql_fetch_array($sql_currency)){
			    $content .='<option value="'.$row_currency["currency"].'" '.((isset($_GET["cust_id"] )&& ($row_data_cust["currency"] == $row_currency["currency"])) ? 'selected=""' : "").'> '.$row_currency["name"].'</option>';    
			}
			
			$content .='
			
		    </select>
		    <span class="liens"></span> 
		    <br>Currency used at the customer end.
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> STATUS </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="status" class="form_input_select">
			<option value="1" '.((isset($_GET["cust_id"] )&& ($row_data_cust["status"] == "1")) ? 'selected=""' : "").'> ACTIVE</option>
			<option value="0" '.((isset($_GET["cust_id"] )&& ($row_data_cust["status"] == "0")) ? 'selected=""' : "").'> CANCELLED</option>
			<option value="2" '.((isset($_GET["cust_id"] )&& ($row_data_cust["status"] == "2")) ? 'selected=""' : "").'> NEW</option>
			<option value="3" '.((isset($_GET["cust_id"] )&& ($row_data_cust["status"] == "3")) ? 'selected=""' : "").'> WAITING-MAILCONFIRMATION</option>
			<option value="4" '.((isset($_GET["cust_id"] )&& ($row_data_cust["status"] == "4")) ? 'selected=""' : "").'> RESERVED</option>
			<option value="5" '.((isset($_GET["cust_id"] )&& ($row_data_cust["status"] == "5")) ? 'selected=""' : "").'> EXPIRED</option>
			<option value="6" '.((isset($_GET["cust_id"] )&& ($row_data_cust["status"] == "6")) ? 'selected=""' : "").'> SUSPENDED FOR UNDERPAYMENT</option>
			<option value="7" '.((isset($_GET["cust_id"] )&& ($row_data_cust["status"] == "7")) ? 'selected=""' : "").'> SUSPENDED FOR LITIGATION</option>
			<option value="8" '.((isset($_GET["cust_id"] )&& ($row_data_cust["status"] == "8")) ? 'selected=""' : "").'> WAITING SUBSCRIPTION PAYMENT</option>
		    </select>
		    <span class="liens"></span> 
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> LOCK </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    Yes  <input type="radio" '.((isset($_GET["cust_id"] )&& ($row_data_cust["block"] == "1")) ? 'checked=""' : "").' name="block" value="1"> - No <input type="radio" name="block" '.((isset($_GET["cust_id"] )&& ($row_data_cust["block"] == "0")) ? 'checked=""' : "").' value="0">
		    <span class="liens"></span> 
		    <br>Enable lock for this account.
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> LOCK PIN </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="lock_pin" size="20" maxlength="10" value="'.$row_data_cust["lock_pin"].'">
		    <span class="liens"></span> 
		    <br>Code required to make the call if the lock is active.
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> SIMULTANEOUS ACCESS </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="simultaccess" class="form_input_select">
			<option value="1" '.((isset($_GET["cust_id"] )&& ($row_data_cust["simultaccess"] == "1")) ? 'selected=""' : "").'> SIMULTANEOUS ACCESS</option>
			<option value="0" '.((isset($_GET["cust_id"] )&& ($row_data_cust["simultaccess"] == "0")) ? 'selected=""' : "").'> INDIVIDUAL ACCESS</option>
		    </select>
		    <span class="liens"></span> 
	        </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> RUN SERVICE </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    Yes  <input type="radio" name="runservice" value="1" '.((isset($_GET["cust_id"] )&& ($row_data_cust["runservice"] == "1")) ? 'checked=""' : "").' > - No <input type="radio" name="runservice" value="0" '.((isset($_GET["cust_id"] )&& ($row_data_cust["runservice"] == "0")) ? 'checked=""' : "").' >
		    <span class="liens"></span> 
		    <br>Apply recurring service to this account.
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> CREDIT LIMIT </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="creditlimit" size="20" maxlength="20" value="'.$row_data_cust["creditlimit"].'">
		    <span class="liens"></span> 
		    <br>Credit limit is only used for the postpaid account.
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> CREDIT LIMIT NOTIFICATION </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="credit_notification" class="form_input_select">
			<option value="-1"'.((isset($_GET["cust_id"] )&& ($row_data_cust["credit_notification"] == "-1")) ? 'selected=""' : "").' >NOT DEFINED</option>
			<option value="10" '.((isset($_GET["cust_id"] )&& ($row_data_cust["credit_notification"] == "10")) ? 'selected=""' : "").'> 10</option>
			<option value="20" '.((isset($_GET["cust_id"] )&& ($row_data_cust["credit_notification"] == "20")) ? 'selected=""' : "").'> 20</option>
			<option value="50" '.((isset($_GET["cust_id"] )&& ($row_data_cust["credit_notification"] == "50")) ? 'selected=""' : "").'> 50</option>
			<option value="100" '.((isset($_GET["cust_id"] )&& ($row_data_cust["credit_notification"] == "100")) ? 'selected=""' : "").'> 100</option>
			<option value="500" '.((isset($_GET["cust_id"] )&& ($row_data_cust["credit_notification"] == "500")) ? 'selected=""' : "").'> 500</option>
			<option value="1000" '.((isset($_GET["cust_id"] )&& ($row_data_cust["credit_notification"] == "1000")) ? 'selected=""' : "").'> 1000</option>
		    </select>
		    <span class="liens"></span> 
		    <br>currency : '.$row_data_cust["currency"].'<br>Low credit limit to alert the customer
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> PERMITTED NOTIFICATIONS BY MAIL </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    Yes  <input type="radio" name="notify_email" value="1" '.((isset($_GET["cust_id"] )&& ($row_data_cust["notify_email"] == "1")) ? 'checked=""' : "").'> - No <input type="radio" name="notify_email" value="0" '.((isset($_GET["cust_id"] )&& ($row_data_cust["notify_email"] == "0")) ? 'checked=""' : "").'>
		    <span class="liens"></span> 
		    <br>Enable the notification by mail for this account.
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> EMAIL NOTIFICATION </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <input class="form_input_text" name="email_notification" size="30" maxlength="70" value="'.$row_data_cust["email_notification"].'">
		    <span class="liens">                 </span> 
	        </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> CAMPAIGN </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		   <select name="id_campaign" class="form_input_select">
			<option value="-1" '.((isset($_GET["cust_id"] )&& ($row_data_cust["id_campaign"] == "-1")) ? 'selected=""' : "").'>NOT DEFINED</option>
		    </select>
		    <span class="liens"></span> 
	        </td>
	    </tr>
            <tr>
		<td width="%25" valign="middle" class="form_head"> FIRST USE DATE </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <input class="form_input_text" name="firstusedate" size="40" maxlength="40" readonly="" value="'.$row_data_cust["firstusedate"].'">
		    <span class="liens"></span> 
	        </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> ENABLE EXPIRY </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="enableexpire" class="form_input_select">
			<option value="0" '.((isset($_GET["cust_id"] )&& ($row_data_cust["enableexpire"] == "0")) ? 'selected=""' : "").'> NO EXPIRY</option>
			<option value="1" '.((isset($_GET["cust_id"] )&& ($row_data_cust["enableexpire"] == "1")) ? 'selected=""' : "").'> EXPIRE DATE</option>
			<option value="2" '.((isset($_GET["cust_id"] )&& ($row_data_cust["enableexpire"] == "2")) ? 'selected=""' : "").'> EXPIRE DAYS SINCE FIRST USE</option>
			<option value="3" '.((isset($_GET["cust_id"] )&& ($row_data_cust["enableexpire"] == "3")) ? 'selected=""' : "").'> EXPIRE DAYS SINCE CREATION</option>
		    </select>
		    <span class="liens"></span> 
		    <br>Select method of expiry for the account.
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> EXPIRY DATE </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="expirationdate" size="40" maxlength="40" value="'.(isset($_GET["cust_id"] ) ? $row_data_cust["expirationdate"] : (date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d"), (date("Y")+10))))).'">
		    <span class="liens"></span> 
		    <br>please use the format YYYY-MM-DD HH:MM:SS. For instance, \'2004-12-31 00:00:00\'
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> EXPIRY DAYS </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="expiredays" size="10" maxlength="6" value="'.(isset($_GET["cust_id"] ) ? $row_data_cust["expiredays"] : "0").'">
		    <span class="liens">  </span> 
		    <br>The number of days after which the account will expire.
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> CREATE SIP CONFIG </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    Yes  <input type="radio" name="sip_buddy" value="1" '.((isset($_GET["cust_id"] )&& ($row_data_cust["sip_buddy"] == "1")) ? 'checked=""' : "").'> - No <input type="radio" name="sip_buddy" value="0" '.((isset($_GET["cust_id"] )&& ($row_data_cust["sip_buddy"] == "0")) ? 'checked=""' : "").'>
		    <span class="liens"></span> 
		    <br>Create the SIP config automatically
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> CREATE IAX CONFIG </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    Yes  <input type="radio" name="iax_buddy" value="1" '.((isset($_GET["cust_id"] )&& ($row_data_cust["iax_buddy"] == "1")) ? 'checked=""' : "").'> - No <input type="radio" name="iax_buddy" value="0" '.((isset($_GET["cust_id"] )&& ($row_data_cust["iax_buddy"] == "0")) ? 'checked=""' : "").'>
		    <span class="liens"></span> 
		    <br>Create the IAX config automatically
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> MAC ADDRESS </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="mac_addr" size="20" maxlength="17" value="'.(isset($_GET["cust_id"]) ? $row_data_cust["mac_addr"] : "00-00-00-00-00-00").'">
		    <span class="liens"></span> 
		    <br>FORMAT: 00-08-74-4C-7F-1D
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> IN USE </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="inuse" size="5" maxlength="5" value="'.$row_data_cust["inuse"].'">
		    <span class="liens"></span> 
		    <br>Updated to show the number of concurrent calls in use by this customer. If there are no currently no calls, and the system shows that there are, manually reset this field back to zero.
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="top" bgcolor="#FEFEEE" colspan="2" class="tableBodyRight"><i>AUTOREFILL</i></td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> AUTOREFILL </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    Yes  <input type="radio" name="autorefill" value="1" '.((isset($_GET["cust_id"] )&& ($row_data_cust["autorefill"] == "1")) ? 'checked=""' : "").'> - No <input type="radio" name="autorefill" value="0" '.((isset($_GET["cust_id"] )&& ($row_data_cust["autorefill"] == "0")) ? 'checked=""' : "").'>
		    <span class="liens"></span> 
		    <br>Define if you want to authorize the autorefill to apply on this accout
		</td>
	    </tr>
            <tr>
	    	<td width="%25" valign="middle" class="form_head"> INITIAL BALANCE </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="initialbalance" size="30" value="'.$row_data_cust["initialbalance"].'" maxlength="30">
		    <span class="liens"></span> 
		    <br>The initial balance is used by autorefill to reset the current balance to this amount
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="top" bgcolor="#FEFEEE" colspan="2" class="tableBodyRight"><i>Invoice Status</i></td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> INVOICE DAY </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="invoiceday" class="form_input_select">
			<option value="1"  '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "1")) ? 'selected=""' : "").'> 1</option>
			<option value="2" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "2")) ? 'selected=""' : "").'> 2</option>
			<option value="3" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "3")) ? 'selected=""' : "").'> 3</option>
			<option value="4" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "4")) ? 'selected=""' : "").'> 4</option>
			<option value="5" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "5")) ? 'selected=""' : "").'> 5</option>
			<option value="6" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "6")) ? 'selected=""' : "").'> 6</option>
			<option value="7" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "7")) ? 'selected=""' : "").'> 7</option>
			<option value="8" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "8")) ? 'selected=""' : "").'> 8</option>
			<option value="9" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "9")) ? 'selected=""' : "").'> 9</option>
			<option value="10" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "10")) ? 'selected=""' : "").'> 10</option>
			<option value="11" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "11")) ? 'selected=""' : "").'> 11</option>
			<option value="12" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "12")) ? 'selected=""' : "").'> 12</option>
			<option value="13" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "13")) ? 'selected=""' : "").'> 13</option>
			<option value="14" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "14")) ? 'selected=""' : "").'> 14</option>
			<option value="15" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "15")) ? 'selected=""' : "").'> 15</option>
			<option value="16" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "16")) ? 'selected=""' : "").'> 16</option>
			<option value="17" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "17")) ? 'selected=""' : "").'> 17</option>
			<option value="18" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "18")) ? 'selected=""' : "").'> 18</option>
			<option value="19" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "19")) ? 'selected=""' : "").'> 19</option>
			<option value="20" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "20")) ? 'selected=""' : "").'> 20</option>
			<option value="21" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "21")) ? 'selected=""' : "").'> 21</option>
			<option value="22" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "22")) ? 'selected=""' : "").'> 22</option>
			<option value="23" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "23")) ? 'selected=""' : "").'> 23</option>
			<option value="24" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "24")) ? 'selected=""' : "").'> 24</option>
			<option value="25" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "25")) ? 'selected=""' : "").'> 25</option>
			<option value="26" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "26")) ? 'selected=""' : "").'> 26</option>
			<option value="27" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "27")) ? 'selected=""' : "").'> 27</option>
			<option value="28" '.((isset($_GET["cust_id"] )&& ($row_data_cust["invoiceday"] == "28")) ? 'selected=""' : "").'> 28</option>
		    </select>
		    <span class="liens">
	                         </span> 
		    <br>Define the day of the month when the system will generate the customer invoice.
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> VAT </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="vat" size="10" maxlength="6" value="'.(isset($_GET["cust_id"]) ? $row_data_cust["vat"] : "0").'">
		    <span class="liens"> </span> 
		    <br>VAT to add on the invoice of this customer. it should be a decimal value \'21\' this will be for 21% of VAT!
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> VAT REGIStrATION NUMBER  </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="vat_rn" size="40" maxlength="40" value="'.$row_data_cust["vat_rn"].'">
		    <span class="liens"></span> 
	        </td>
	    </tr>		
	    <tr>
		<td width="%25" valign="middle" class="form_head"> DISCOUNT </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="discount" class="form_input_select">
			<option value="0.00" '.((isset($_GET["cust_id"] )&& ($row_data_cust["discount"] == "0.00")) ? 'selected=""' : "").'> NO DISCOUNT</option>
			<option value="1.00" '.((isset($_GET["cust_id"] )&& ($row_data_cust["discount"] == "1.00")) ? 'selected=""' : "").'> 1%</option>
			<option value="2.00" '.((isset($_GET["cust_id"] )&& ($row_data_cust["discount"] == "2.00")) ? 'selected=""' : "").'> 2%</option>
			<option value="3.00" '.((isset($_GET["cust_id"] )&& ($row_data_cust["discount"] == "3.00")) ? 'selected=""' : "").'> 3%</option>
			<option value="4.00" '.((isset($_GET["cust_id"] )&& ($row_data_cust["discount"] == "4.00")) ? 'selected=""' : "").'> 4%</option>
			<option value="5.00" '.((isset($_GET["cust_id"] )&& ($row_data_cust["discount"] == "5.00")) ? 'selected=""' : "").'> 5%</option>
			<option value="6.00" '.((isset($_GET["cust_id"] )&& ($row_data_cust["discount"] == "6.00")) ? 'selected=""' : "").'> 6%</option>
			<option value="7.00" '.((isset($_GET["cust_id"] )&& ($row_data_cust["discount"] == "7.00")) ? 'selected=""' : "").'> 7%</option>
			<option value="8.00" '.((isset($_GET["cust_id"] )&& ($row_data_cust["discount"] == "8.00")) ? 'selected=""' : "").'> 8%</option>
			<option value="9.00" '.((isset($_GET["cust_id"] )&& ($row_data_cust["discount"] == "9.00")) ? 'selected=""' : "").'> 9%</option>
			<option value="10.00" '.((isset($_GET["cust_id"] )&& ($row_data_cust["discount"] == "10.00")) ? 'selected=""' : "").'> 10%</option>
			
		    </select>
		    <span class="liens"></span> 
	        </td>
	    </tr>
	    <tr>
		<td width="%25" valign="top" bgcolor="#FEFEEE" colspan="2" class="tableBodyRight"><i>TARGET trAFFIC</i></td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> TRAFFIC PER MONTH </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="traffic" size="30" maxlength="20" value="'.$row_data_cust["traffic"].'">
		    <span class="liens"> </span> 
	        </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> TARGET trAFFIC </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <textarea class="form_input_textarea" name="traffic_target" cols="50" rows="4">'.$row_data_cust["traffic_target"].'</textarea> 
			<span class="liens"></span> 
	        </td>
	    </tr>
	    <tr>
		<td width="%25" valign="top" bgcolor="#FEFEEE" colspan="2" class="tableBodyRight"><i>REStrICTED NUMBERS</i></td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> REStrICTION </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="restriction" class="form_input_select">
			<option value="0" '.((isset($_GET["cust_id"] )&& ($row_data_cust["restriction"] == "0")) ? 'selected=""' : "").'> NONE RESTRICTION USED</option>
			<option value="1" '.((isset($_GET["cust_id"] )&& ($row_data_cust["restriction"] == "1")) ? 'selected=""' : "").'> CAN\'T CALL RESTRICTED NUMBERS</option>
			<option value="2" '.((isset($_GET["cust_id"] )&& ($row_data_cust["restriction"] == "2")) ? 'selected=""' : "").'> CAN ONLY CALL RESTRICTED NUMBERS</option>
		    </select>
		    <span class="liens"> </span> 
	        </td>
	    </tr>';
	    /*if(isset($_GET["form_action"]) == "edit-cust"){
		$content .='<tr>
		<!-- ******************** PARTIE EXTERN : HAS_MANY ***************** -->
                <td width="122" class="form_head">REStrICTED NUMBERS</td>
                <td align="center" valign="top" class="tableBodyRight" ><br>
                    <!-- Table with list instance already inserted -->
                    <table cellspacing="0" class="editform_table2" >
                        <tbody>
			<tr bgcolor="#ffffff">
                            <td height="16" style="PADDING-LEFT: 5px; PADDING-RIGHT: 3px" class="form_head">
                            	<table border="0" cellpadding="0" cellspacing="0" width="100%">
                                	<tbody>
					<tr>
                                	    <td class="form_head">RESTRICTED NUMBERS&nbsp;LIST </td>
                                	</tr>
					</tbody>
				</table>
			    </td>
                        </tr>
                        <tr>
                            <td>
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody>
				    <tr bgcolor="#F2F2EE" onmouseover="bgColor=\'#C4FFD7\'" onmouseout="bgColor=\'#F2F2EE\'">
					<td colspan="2" align="" valign="top" class="tableBody">
					    <div align="center" class="liens">No REStrICTED NUMBERS</div>
					</td>
				    </tr>
                                    </tbody>
				</table>
			    </td>
                        </tr>
                        <tr class="bgcolor_016"> 
                            <td class="editform_table3_td2"> 
                            	<table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody>
				    <tr>
					<td height="4" align="right"></td>
				    </tr>
				    </tbody>
				</table>
			    </td>
                        </tr>
                        </tbody>
		    </table>
		    <br>
		</td>
            </tr>
	    <tr>
		<!-- *******************   Select to ADD new instances  ****************************** -->					  
                <td class="form_head">&nbsp;</td>
                <td align="center" valign="top" class="tableBodyRight"><br>
                    <table width="300" height="50" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tbody><tr> 
                            <td bgcolor="#7f99cc" colspan="3" height="16" style="PADDING-LEFT: 5px; PADDING-RIGHT: 5px" class="form_head">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
				    <tbody><tr> 
					<td class="form_head">Add a new RESTRICTED NUMBERS</td>
				    </tr>
				    </tbody>
				</table>
			    </td>
                        </tr>
                        <tr> 
			    <td class="form_head">
				<img height="1"  width="1">
			    </td>
			    <td class="editform_table4_td1"> 
                               <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
				    <tbody><tr> 
					<td width="122" class="tableBody">RESTRICTED NUMBERS</td>
					<td width="516">
					    <div align="left"> 	
					    <input type="TEXT" name="number" class="form_input_text" size="20" maxlength="20">
					    </div>
					</td>
                                    </tr>
                                    <tr> 
					<td colspan="2" align="center">									  	
						<a href="#" onclick="sendto(\'add-content\',\'51\');"> <span class="cssbutton">ADD REStrICTED NUMBERS</span></a>
					</td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" height="4"></td>
                                    </tr>
                                    <tr> 
                                      <td colspan="2"> <div align="right"></div></td>
                                    </tr>
                                </tbody></table>
			    </td>
			    <td class="form_head"><img height="1" width="1">
			    </td>
			</tr>
			<tr> 
			  <td colspan="3" class="form_head"><img height="1"  width="1"></td>
			</tr>
		    </tbody></table>
		<br></td>
	    </tr>
	    <tr>
		<td width="%25" valign="top" bgcolor="#FEFEEE" colspan="2" class="tableBodyRight" ><i>CALLERID / CUSTOMER HISTORY</i></td>
	    </tr>
	    <tr>
		<!-- ******************** PARTIE EXTERN : HAS_MANY ***************** -->
                <td width="122" class="form_head">CALLERID</td>
                <td align="center" valign="top"  class="tableBodyRight"><br>
                    <!-- Table with list instance already inserted -->
                    <table cellspacing="0" class="editform_table2">
                        <tr bgcolor="#ffffff">
                            <td height=16 style="PADDING-LEFT: 5px; PADDING-RIGHT: 3px" class="form_head">
                            	<table border=0 cellPadding=0 cellSpacing=0 width="100%">
				    <tr>
					<td class="form_head">CALLERID&nbsp;LIST </td>
				    </tr>
                            	</table>
			    </td>
                        </tr>
                        <tr>
                            <td>
				<table border=0 cellPadding=0 cellSpacing=0 width="100%">
                                    <tr bgcolor="#F2F2EE"  onMouseOver="bgColor=\'#C4FFD7\'" onMouseOut="bgColor=\'#F2F2EE\'">
					<td vAlign="top" align="" class="tableBody">
                                            <font face="Verdana" size="2"> 1700  </font>
					</td>
					<td align="center" vAlign="top2" class="tableBodyRight">
					    <img onClick="sendto(\'del-content\',\'52\',\'cid\',\'1700\');" alt="Remove this CALLERID" border=0 height=11 hspace=2 id="del" name="del" width=33 value="add-split">
					</td>
				    </tr>
                                </table>
			    </td>
                        </tr>
                        <tr class="bgcolor_016"> 
                            <td class="editform_table3_td2"> 
                            	<table border=0 cellPadding=0 cellSpacing=0 width="100%">
                                	<tr><td height="4" align="right"></td></tr>
                              	</table>
			    </td>
                        </tr>
                    </table><br>
		</td>
            </tr>
            <tr>
		<!-- *******************   Select to ADD new instances  ****************************** -->					  
		<td class="form_head">&nbsp;</td>
		<td align="center" valign="top"  class="tableBodyRight"><br>
                    <table width="300" height=50 border=0 align="center" cellPadding=0 cellSpacing=0>
                        <tr> 
                            <td bgColor=#7f99cc colspan=3 height=16 style="PADDING-LEFT: 5px; PADDING-RIGHT: 5px" class="form_head">
				<table border=0 cellPadding=0 cellSpacing=0 width="100%">
				    <tr> 
					<td class="form_head">Add a new CALLERID</td>
				    </tr>
				</table>
			    </td>
                        </tr>
			<tr> 
			    <td class="form_head"> 
			    </td>
			    <td class="editform_table4_td1"> 
				<table width="97%" border=0 align="center" cellPadding=0 cellSpacing=0>
				    <tr> 
					<td width="122" class="tableBody">CALLERID</td>
					<td width="516"><div align="left"> 	
					    <INPUT TYPE="TEXT" name=cid class="form_input_text"  size="20" maxlength="20">
					</td>
				    </tr>
				    <tr> 
					<td colspan="2" align="center">									  	
						<a href="#" onClick="sendto(\'add-content\',\'52\');"> <span class="cssbutton">ADD CALLERID</span></a>
					</td>
                                    </tr>
                                    <tr>
                                      <td colspan=2 height=4></td>
                                    </tr>
                                    <tr> 
                                      <td colspan=2> <div align="right"></div></td>
                                    </tr>
                                </table>
			    </td>
			    <td class="form_head"><IMG height=1 width=1>
			    </td>
			</tr>
			<tr> 
			  <td colspan=3 class="form_head"></td>
			</tr>
		    </table>
		<br></td>
            </tr>					
	    <tr>
		<!-- ******************** PARTIE EXTERN : HAS_MANY ***************** -->
		<td width="122" class="form_head">CUSTOMER HISTORY</td>
		<td align="center" valign="top"  class="tableBodyRight"><br>
		    <!-- Table with list instance already inserted -->
		    <table cellspacing="0" class="editform_table2">
                        <tr bgcolor="#ffffff">
                            <td height=16 style="PADDING-LEFT: 5px; PADDING-RIGHT: 3px" class="form_head">
                            	<table border=0 cellPadding=0 cellSpacing=0 width="100%">
				    <tr>
					<td class="form_head">CUSTOMER HISTORY&nbsp;LIST </td>
				    </tr>
                            	</table>
			    </td>
                        </tr>
                        <tr>
			    <td>
				<table border=0 cellPadding=0 cellSpacing=0 width="100%">
				    <tr bgcolor="#FCFBFB"  onMouseOver="bgColor=\'#C4FFD7\'" onMouseOut="bgColor=\'#FCFBFB\'">
					<td colspan="2" align="" vAlign="top" class="tableBody">
					    <div align="center" class="liens">No CUSTOMER HISTORY</div>
					</td>
				    </tr>
				</table>
			    </td>
                        </tr>
                        <tr class="bgcolor_016"> 
                            <td class="editform_table3_td2"> 
                            	<table border=0 cellPadding=0 cellSpacing=0 width="100%">
                                    <tr><td height="4" align="right"></td></tr>
                              	</table>
			    </td>
                        </tr>
                    </table><br>
		</td>
            </tr>
            <tr>
		<!-- *******************   Select to ADD new instances  ****************************** -->					  
                <td class="form_head">&nbsp;</td>
                <td align="center" valign="top"  class="tableBodyRight"><br>
                    <table width="300" height=50 border=0 align="center" cellPadding=0 cellSpacing=0>
                        <tr> 
                            <td bgColor=#7f99cc colspan=3 height=16 style="PADDING-LEFT: 5px; PADDING-RIGHT: 5px" class="form_head">
				<table border=0 cellPadding=0 cellSpacing=0 width="100%">
					<tr> 
						<td class="form_head">Add a new CUSTOMER HISTORY</td>
					</tr>
				</table>
			    </td>
                        </tr>
			<tr> 
			    <td class="form_head"> 
			    </td>
			    <td class="editform_table4_td1"> 
				<table width="97%" border=0 align="center" cellPadding=0 cellSpacing=0>
				    <tr> 
					<td width="122" class="tableBody">CUSTOMER HISTORY</td>
					<td width="516"><div align="left"> 	
					    <textarea name=description class="form_input_text"  cols="40" rows="5"></textarea>
					</td>
                                    </tr>
                                    <tr> 
					<td colspan="2" align="center">									  	
					    <a href="#" onClick="sendto(\'add-content\',\'53\');"> <span class="cssbutton">ADD CUSTOMER HISTORY</span></a>
					</td>
                                    </tr>
                                    <tr>
					<td colspan=2 height=4></td>
                                    </tr>
                                    <tr> 
					<td colspan=2> <div align="right"></div></td>
                                    </tr>
                                </table>
			    </td>
			    <td class="form_head">
			    </td>
			</tr>
			<tr> 
			  <td colspan=3 class="form_head"></td>
			</tr>
		    </table>
		<br></td>
            </tr>			
	    ';
	    }else{
		$content .='';
	    }*/
	    $content .='
	    
		
        </tbody>
      </table>
      <br />
	<table cellspacing="0" class="editform_table8" width="100%">
	     <tbody>
		 <tr>
		     <td  align="right" valign="top" class="text">
			     <input class="btn btn-primary" name="'.(isset($_GET["form_action"]) ? "confirm_edit" : "confirm_save").'" value="Confirm Data" type="submit">
			     
		     </td>
		 </tr>
	     </tbody>
	</table>
	<br />
	</div>
	<div class="tab-pane active" id="cust">
	
	<a href="'.URL_ADMIN.'voip_bpn/data_cust.php?r=myForm" class="btn btn-primary" onclick="return valideopenerform(\''.URL_ADMIN.'voip_bpn/data_cust.php?r=myForm\',\'cust\');">Search Customer</a>
	<br />
	<br />
	<table cellspacing="2" class="addform_table1"  style="display: table;border-collapse: separate;border-spacing: 2px;border-color: gray;">
	    <tbody>
	    <tr>
		<td width="%25" valign="top" bgcolor="#FEFEEE" colspan="2" class="tableBodyRight"><i>Personal Information</i></td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> Cust Number </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		     <input class="form_input_text" name="customer_number" size="30" maxlength="20" value="" readonly="">
		    <span class="liens"> </span> 
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> NAME </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="firstname" size="30" maxlength="50" value="'.$row_data_cust["firstname"].' '.$row_data_cust["lastname"].'">
		    <span class="liens"></span> 
	       </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> EMAIL </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="email" size="30" maxlength="70" value="'.$row_data_cust["email"].'">
		    <span class="liens"></span> 
	       </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> ADDRESS </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="address" size="30" maxlength="100" value="'.$row_data_cust["address"].'">
		    <span class="liens"></span> 
	       </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> CITY </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <input class="form_input_text" name="city" size="30" maxlength="40" value="'.$row_data_cust["city"].'">
		    <span class="liens"></span> 
	       </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> STATE/PROVINCE </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <input class="form_input_text" name="state" size="30" maxlength="40" value="'.$row_data_cust["state"].'">
		    <span class="liens"></span> 
	       </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> COUNTRY </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <select name="country" class="form_input_select">
			';
			$sql_country = mysql_query("SELECT * FROM `cc_country` ", $conn_voip);
			
			
			while($row_country = mysql_fetch_array($sql_country)){
			    $content .='<option value="'.$row_country["countrycode"].'" '.(((isset($_GET["cust_id"] )&& ($row_data_cust["country"] == $row_country["countrycode"]) || ($row_country["countrycode"] == "IDN") )) ? 'selected=""' : "").'> '.$row_country["countryname"].'</option>';    
			}
			
			
			$content .='
		    </select>
			<span class="liens"></span> 
		</td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> ZIP/POSTAL CODE </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <input class="form_input_text" name="zipcode" size="30" maxlength="20" value="'.$row_country["zipcode"].'">
		    <span class="liens"></span> 
	        </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> PHONE NUMBER </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="phone" size="30" maxlength="20" value="'.$row_country["phone"].'">
		    <span class="liens"></span> 
	        </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> FAX NUMBER </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="fax" size="30" maxlength="20" value="'.$row_country["fax"].'">
		    <span class="liens"></span> 
	       </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> COMPANY NAME </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
	            <input class="form_input_text" name="company_name" size="40" maxlength="50" value="'.$row_country["company_name"].'">
		    <span class="liens"></span> 
	        </td>
	    </tr>
	    <tr>
		<td width="%25" valign="middle" class="form_head"> COMPANY WEBSITE </td>  
		<td width="%75" valign="top" class="tableBodyRight" >
		    <input class="form_input_text" name="company_website" size="40" maxlength="60" value="'.$row_country["company_website"].'">
		    <span class="liens"></span> 
	        </td>
	    </tr>	
	    </tbody>
	</table>
	<table cellspacing="0" class="editform_table8" width="100%">
	     <tbody>
		 <tr>
		     <td  align="right" valign="top" class="text">
			<a href="#cust_voip" class="btn btn-primary" data-toggle="tab">Next</a>
		    </td>
		</tr>
	    </tbody>
	</table>
	</div>
	
	</div>
	</div>
	
	</div>
    </form>			    
                                
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
	<style>
	    .addform_table1 {
	    border-right: 0px;
	    padding-right: 2px;
	    border-top: 0px;
	    padding-left: 2px;
	    padding-bottom: 2px;
	    border-left: 0px;
	    width: 95%;
	    padding-top: 2px;
	    border-bottom: 0px;
	    margin-left: auto;
	    margin-right: auto;
	    background-color: #E2E2D3;
	    }
	    .editform_table4_td1 {
	    padding-bottom: 7px;
	    padding-left: 5px;
	    padding-right: 5px;
	    padding-top: 5px;
	    background-color: #F3F3F3;
	    }
	    .editform_table8 {
	    border-right: 0px;
	    padding-right: 3px;
	    border-top: 0px;
	    padding-left: 3px;
	    padding-bottom: 3px;
	    border-left: 0px;
	    width: 95%;
	    height: 30px;
	    padding-top: 3px;
	    border-bottom: 0px;
	    margin-left: auto;
	    margin-right: auto;
	    background-color: #FFFFFF;
	    }
	    .form_head {
	    font-family: Arial, Helvetica, sans-serif;

	    font-weight: bold;
	    text-transform: uppercase;
	    color: #FFFFFF;
	    background-color: #666666;
	    width: auto;
	    }
	    .tableBodyRight {
	    PADDING-BOTTOM: 4px;
	    PADDING-LEFT: 4px;
	    PADDING-RIGHT: 4px;
	    PADDING-TOP: 4px;
	    
	    background-color: #F5F5F5;
	    }
	</style>
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

    $title	= 'List Customer';
    $submenu	= "voip_customers";
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