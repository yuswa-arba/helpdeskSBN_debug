<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include("../../config/configuration_admin.php");
include ("../../config/configuration_voip_bali.php");
include ("../../config/configuration_voip_bpn.php");

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') {

        global $conn;
        global $voip_bpn;
        global $voip_bali;

        $custnumber = isset($_GET['custnumber']) ? strip_tags($_GET['custnumber']) : '';

        $sql_customer = mysql_query("SELECT * FROM `tbCustomer`, `gx_cabang` WHERE `tbCustomer`.`id_cabang` = `gx_cabang`.`id_cabang` AND `tbCustomer`.`cKode` = '" . $custnumber . "' LIMIT 0,1;", $conn);
        $row_customer = mysql_fetch_array($sql_customer);

        $sql_nomer_voip = mysql_query("SELECT * FROM `gx_voip_nomerTelpon` WHERE `kode` = '" . $row_customer["kode_voip"] . "' AND `status` = '2' LIMIT 0,1;", $conn);
        $row_nomer_voip = mysql_fetch_array($sql_nomer_voip);

        /*$sql_last_cust  = mysql_fetch_array(mysql_query("SELECT * FROM `cc_card` ORDER BY `id` DESC", $conn_voip));
        $last_data  = $sql_last_cust["id"] + 1;

        if($save == "Confirm Data")
        {
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

        //update gx_voip Nomer telpon
        $query_update_voip_numb = "UPDATE `gx_voip_nomerTelpon` SET `customer_number` = '$customer_number', `status` = '0'
                        WHERE `nomer_telpon` = '$useralias'";
            //echo $query;

            mysql_query($query_update_voip_numb, $conn) or die("<script language='JavaScript'>
                alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                window.history.go(-1);
                </script>");

        //insert gx voip customer
        $sql_voip_customer = "INSERT INTO `gx_voip_customer` (`id`, `customer_number`, `username`, `voip_number`,
        `id_card`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
        VALUES (NULL, '".$customer_number."', '".$username."', '".$useralias."', '".$last_data."',
        '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
        mysql_query($sql_voip_customer, $conn) or die("<script language='JavaScript'>
                alert('GX VOIP Customer, Ada kesalahan!');
                window.history.go(-1);
                </script>");

        echo "<script language='JavaScript'>
                alert('Data telah disimpan!');
                location.href = 'list_customer.php';
                </script>";

        }
        elseif($edit == "Confirm Data")
        {

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

        if($username_cust != ""){
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

        }
        echo "<script language='JavaScript'>
                alert('Data telah disimpan!');
                location.href = 'list_customer.php';
                </script>";

        }
            sql insert data usertv
            $sql_insert_usertv = "INSERT INTO `gx_user_tv` (`id_user_tv`, `custnumber_user_tv`, `clientname_user_tv`, `clientcode_user_tv`, `status_user_tv`)
            VALUES (NULL, '".$custnumber."', '".$username."', '".strtoupper($useridstb)."', 'aktif');";
            mysql_query($sql_insert_usertv, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_usertv);*/

        $random_5_number = mt_rand(10001, 90001);
        $random_10_number = mt_rand(1000000001, 9000000001);

        $content = '
                <section class="content-header">
                    <h1>
                        VOIP User
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
					
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <!-- /.box-header -->
								<div class="box-header">
                                    <h3 class="box-title">Form VOIP User</h3>
                                </div>
                                <!-- form start -->
                                <form name="formuser" action="" role="form" method="post" enctype="multipart/form-data" autocomplete="off">
                                    //VOIP
                                    <input type="hidden" name="username" value="' . $random_5_number . '">
                                    <input type="hidden" name="useralias" value="' . $row_nomer_voip["nomer_telpon"] . '"> 
                                    <input type="hidden" name="uipass" value="' . $random_10_number . '">
                                    <input type="hidden" name="credit" value="0">
                                    <input type="hidden" name="id_group" value="2">
                                    <input type="hidden" name="id_seria" value="">
                                    <input type="hidden" name="tariff" value="">
                                    <input type="hidden" name="id_didgroup" value="">
                                    <input type="hidden" name="id_timezone" value="59">
                                    <input type="hidden" name="language" value="en">
                                    <input type="hidden" name="currency" value="IDR">
                                    <input type="hidden" name="status" value="8">
                                    <input type="hidden" name="block" value="0">
                                    <input type="hidden" name="lock_pin" value="">
                                    <input type="hidden" name="simultaccess" value="1">
                                    <input type="hidden" name="runservice" value="1">
                                    <input type="hidden" name="creditlimit" value="">
                                    <input type="hidden" name="credit_notification" value="-1">
                                    <input type="hidden" name="notify_email" value="0">
                                    <input type="hidden" name="email_notification" value="">
                                    <input type="hidden" name="id_campaign" value="-1">
                                    <input type="hidden" name="firstusedate" value="">
                                    <input type="hidden" name="enableexpire" value="0">
                                    <input type="hidden" name="expirationdate" value="' . date("Y-m-d 00:00:00", strtotime("+10 Years")) . '">
                                    <input type="hidden" name="expiredays" value="0">
                                    <input type="hidden" name="sip_buddy" value="1">
                                    <input type="hidden" name="iax_buddy" value="1">
                                    <input type="hidden" name="mac_addr" value="00-00-00-00-00-00">
                                    <input type="hidden" name="inuse" value="">
                                    <input type="hidden" name="autorefill" value="0">
                                    <input type="hidden" name="initialbalance" value="0">
                                    <input type="hidden" name="invoiceday" value="1">
                                    <input type="hidden" name="vat" value="0">
                                    <input type="hidden" name="vat_rn" value="">
                                    <input type="hidden" name="discount" value="0.00">
                                    <input type="hidden" name="traffic" value="">
                                    <input type="hidden" name="traffic_target" value="">
                                    <input type="hidden" name="restriction" value="0">
                                    
                                    //Customer
                                    <input type="hidden" name="customer_number" value="' . $custnumber . '">
                                    <input type="hidden" name="firstname" value="' . ($row_customer["firstname"] . ' ' . $row_customer["lastname"]) . '">
                                    <input type="hidden" name="email" value="' . $row_customer["cEmail"] . '">
                                    <input type="hidden" name="address" value="' . $row_customer["cAlamat1"] . '">
                                    <input type="hidden" name="city" value="' . $row_customer["cKota"] . '">
                                    <input type="hidden" name="state" value="">
                                    <input type="hidden" name="country" value="IDN">
                                    <input type="hidden" name="zipcode" value="">
                                    <input type="hidden" name="phone" value="' . $row_customer["cNohp1"] . '">
                                    <input type="hidden" name="fax" value="">
                                    <input type="hidden" name="company_name" value="' . $row_customer["cNamaPers"] . '">
                                    <input type="hidden" name="company_website" value="">

                                    <div class="box-body">
									    <div class="form-group">
										    <div class="row">
										    	<div class="col-xs-4">
										    	    <label>Nomer Telepon VOIP</label>
										    	</div>
										    	<div class="col-xs-8">
										    	    (' . $row_nomer_voip["kode"] . ') ' . $row_nomer_voip["nomer_telpon"] . '
										    	    <input type="hidden" class="form-control" readonly="" name="useralias" value="' . $row_nomer_voip["nomer_telpon"] . '">
										    	    <input type="hidden"  name="custnumber" value="' . $custnumber . '">
										    	</div>
										    </div>
										</div>
										
                                    </div><!-- /.box-body -->
				    
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" ' . (isset($_GET['id']) ? 'name="update"' : 'name="save"') . ' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->';

        $plugins = '';

        $title = 'Form User VOIP';
        $submenu = "voip_user";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group);

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>