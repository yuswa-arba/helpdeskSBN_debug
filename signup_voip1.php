<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("config/configuration.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
 
if(
	isset($_POST['language']) &&
	isset($_POST['currency']) &&
	isset($_POST['tariff']) &&
	isset($_POST['lastname']) &&
	isset($_POST['firstname']) &&
	isset($_POST['email']) &&
	isset($_POST['address']) &&
	isset($_POST['city']) &&
	isset($_POST['state']) &&
	isset($_POST['country']) &&
 	isset($_POST['zipcode']) &&
	isset($_POST['id_timezone']) &&
	isset($_POST['phone']) ){




	
	//generate username, useralias, uipass
        $min_v_username = '10000';
        $max_v_username = '99999';
        $ran_v_username = mt_rand ( $min_v_username , $max_v_username );
        $sql_select_username = "SELECT * FROM `cc_card` WHERE `username`='$ran_v_username'";
        $query_select_username = mysql_query($sql_select_username);
        $jumlah_username = mysql_num_rows($query_select_username);
        if($jumlah_username > 0){
                        $ran_v_username = mt_rand ( $min_v_username , $max_v_username );
                        $sql_select_username = "SELECT * FROM `cc_card WHERE `username`='$ran_v_username'";
                        $query_select_username = mysql_query($sql_select_username);
                        $jumlah_username = mysql_num_rows($query_select_username);
                        if($jumlah_username > 0){
                                        $ran_v_username = mt_rand ( $min_v_username , $max_v_username );
                                        $sql_select_username = "SELECT * FROM `cc_card WHERE `username`='$ran_v_username'";
                                        $query_select_username = mysql_query($sql_select_username);
                                        $jumlah_username = mysql_num_rows($query_select_username);
                                        if($jumlah_username > 0){
                                                    $ran_v_username = mt_rand ( $min_v_username , $max_v_username );
                                                    $sql_select_username = "SELECT * FROM `cc_card WHERE `username`='$ran_v_username'";
                                                    $query_select_username = mysql_query($sql_select_username);
                                                    $jumlah_username = mysql_num_rows($query_select_username);
                                                    if($jumlah_username > 0){
                                                                    $value_username = mt_rand ( $min_v_username , $max_v_username );
                                                    }else{  $value_username = $ran_v_username; }    
                                            }
                                        else{ $value_username = $ran_v_username; }   
                            }
                        else{ $value_username = $ran_v_username; }    
            }
        else{ $value_username = $ran_v_username; }
        
  
        
$min_v_useralias1 = '10000000';
        $max_v_useralias1 = '99999999';
$min_v_useralias2 = '1000000';
        $max_v_useralias2 = '9999999';
        
        $ran_v_useralias1 = mt_rand ( $min_v_useralias1, $max_v_useralias1 );
        $ran_v_useralias2 = mt_rand ( $min_v_useralias2, $max_v_useralias2 );
        $ran_v_useralias = $ran_v_useralias1.$ran_v_useralias2;
        $sql_select_useralias = "SELECT * FROM `cc_card` WHERE `useralias`='$ran_v_useralias'";
        $query_select_useralias = mysql_query($sql_select_useralias);
        $jumlah_useralias = mysql_num_rows($query_select_useralias);
        if($jumlah_useralias > 0){
                        $ran_v_useralias = mt_rand ( $min_v_useralias , $max_v_useralias );
                        $sql_select_useralias = "SELECT * FROM `cc_card WHERE `useralias`='$ran_v_useralias'";
                        $query_select_useralias = mysql_query($sql_select_useralias);
                        $jumlah_useralias = mysql_num_rows($query_select_useralias);
                        if($jumlah_useralias > 0){
                                        $ran_v_useralias = mt_rand ( $min_v_useralias , $max_v_useralias );
                                        $sql_select_useralias = "SELECT * FROM `cc_card WHERE `useralias`='$ran_v_useralias'";
                                        $query_select_useralias = mysql_query($sql_select_useralias);
                                        $jumlah_useralias = mysql_num_rows($query_select_useralias);
                                        if($jumlah_useralias > 0){
                                                    $ran_v_useralias = mt_rand ( $min_v_useralias , $max_v_useralias );
                                                    $sql_select_useralias = "SELECT * FROM `cc_card WHERE `useralias`='$ran_v_useralias'";
                                                    $query_select_useralias = mysql_query($sql_select_useralias);
                                                    $jumlah_useralias = mysql_num_rows($query_select_useralias);
                                                    if($jumlah_useralias > 0){
                                                                    $value_useralias = mt_rand ( $min_v_useralias , $max_v_useralias );
                                                    }else{  $value_useralias = $ran_v_useralias; }    
                                            }
                                        else{ $value_useralias = $ran_v_useralias; }   
                            }
                        else{ $value_useralias = $ran_v_useralias; }    
            }
        else{ $value_useralias = $ran_v_useralias; }
        
 
 $min_v_uipass = '1000000000';
        $max_v_uipass = '9999999999';
        $ran_v_uipass = mt_rand ( $min_v_uipass , $max_v_uipass );
        $sql_select_uipass = "SELECT * FROM `cc_card` WHERE `uipass`='$ran_v_uipass'";
        $query_select_uipass = mysql_query($sql_select_uipass);
        $jumlah_uipass = mysql_num_rows($query_select_uipass);
        if($jumlah_uipass > 0){
                        $ran_v_uipass = mt_rand ( $min_v_uipass , $max_v_uipass );
                        $sql_select_uipass = "SELECT * FROM `cc_card WHERE `uipass`='$ran_v_uipass'";
                        $query_select_uipass = mysql_query($sql_select_uipass);
                        $jumlah_uipass = mysql_num_rows($query_select_uipass);
                        if($jumlah_uipass > 0){
                                        $ran_v_uipass = mt_rand ( $min_v_uipass , $max_v_uipass );
                                        $sql_select_uipass = "SELECT * FROM `cc_card WHERE `uipass`='$ran_v_uipass'";
                                        $query_select_uipass = mysql_query($sql_select_uipass);
                                        $jumlah_uipass = mysql_num_rows($query_select_uipass);
                                        if($jumlah_uipass > 0){
                                                    $ran_v_uipass = mt_rand ( $min_v_uipass , $max_v_uipass );
                                                    $sql_select_uipass = "SELECT * FROM `cc_card WHERE `uipass`='$ran_v_uipass'";
                                                    $query_select_uipass = mysql_query($sql_select_uipass);
                                                    $jumlah_uipass = mysql_num_rows($query_select_uipass);
                                                    if($jumlah_uipass > 0){
                                                                    $value_uipass = mt_rand ( $min_v_uipass , $max_v_uipass );
                                                    }else{  $value_uipass = $ran_v_uipass; }    
                                            }
                                        else{ $value_uipass = $ran_v_uipass; }   
                            }
                        else{ $value_uipass = $ran_v_uipass; }    
            }
        else{ $value_uipass = $ran_v_uipass; }
        
        //akhir generate
        
        
        
        
        //generate loginkey
        $alpha = "abcdefghijklmnopqrstuvwxyz";
        $numeric = "0123456789";
        $alpha_upper = strtoupper($alpha);
        $special = ".-+=_,!@$#*%<>[]{}";
        $chars = "";
         
        if (isset($_POST['length'])){
            // if you want a form like above
            if (isset($_POST['alpha']) && $_POST['alpha'] == 'off')
                $chars .= $alpha;
             
            if (isset($_POST['alpha_upper']) && $_POST['alpha_upper'] == 'off')
                $chars .= $alpha_upper;
             
            if (isset($_POST['numeric']) && $_POST['numeric'] == 'on')
                $chars .= $numeric;
             
            if (isset($_POST['special']) && $_POST['special'] == 'off')
                $chars .= $special;
             
            $length = $_POST['length'];
        }else{
            // default [a-zA-Z0-9]{9}
            $chars = $alpha . $alpha_upper . $numeric;
            $length = 20;
        }
         
        $len = strlen($chars);
        $loginkey_num = '';
         
        for ($i=0;$i<$length;$i++)
                $loginkey_num .= substr($chars, rand(0, $len-1), 1);
         
        // the finished password
        $loginkey_num = str_shuffle($loginkey_num);
        
        
        //end generate keylogin
        
	//Proses mencari NOW() + 10 tahun
        $date_now = mysql_query("SELECT NOW() as date_now");
	$data_date_now = mysql_fetch_array($date_now);
	$date_expiration = date($data_date_now['date_now'], mktime(0, 0, 0, date('m'), date('d'), date('y')+10));
	
        $firstusedate		= '0000-00-00 00:00:00';
	$expirationdate		= $date_expiration; // NOW() + 10thn
	$enableexpire		= '1';
	$expiredays		= '30';
	$username		= $value_username; // telah generate nilai random
	$useralias		= $value_useralias; // telah generate nilai random
	$uipass			= $value_uipass; // telah generate nilai random
	$credit			= '0.00000';
	$tariff			= '1';
	$id_didgroup		= '0';
	$activated		= 'f';
	$status			= '2';
	$lastname		= isset($_POST['lastname']) ? $_POST['lastname'] : '';
	$firstname		= isset($_POST['firstname']) ? $_POST['firstname'] : '';
	$address		= isset($_POST['address']) ? $_POST['address'] : '';
	$city			= isset($_POST['city']) ? $_POST['city'] : '';
	$state			= isset($_POST['state']) ? $_POST['state'] : '';
	$country		= isset($_POST['country']) ? $_POST['country'] : '';
	$zipcode		= isset($_POST['zipcode']) ? $_POST['zipcode'] : '';
	$phone			= isset($_POST['phone']) ? $_POST['phone'] : '';
	$email			= isset($_POST['email']) ? $_POST['email'] : '';
	$fax			= isset($_POST['fax']) ? $_POST['fax'] : '';
	$inuse			= '3'; // masih default - proses pengembangan
	$simultaccess		= '1'; // masih default - proses pengembangan
	$currency		= isset($_POST['currency']) ? $_POST['currency'] : '';
	$lastuse		= '2014-06-22 00:47:42';
	$nbused			= '72'; // masih default - proses pengembangan
	$typepaid		= '0'; // masih default - proses pengembangan
	$creditlimit		= '0'; // masih default - proses pengembangan
	$voipcall		= '0'; // masih default - proses pengembangan
	$sip_buddy		= '0'; // masih default - proses pengembangan
	$iax_buddy		= '0'; // masih default - proses pengembangan
	$language		= isset($_POST['language']) ? $_POST['language'] : '';
	$redial			= '';  // masih default - proses pengembangan
	$runservice		= '1'; // masih default - proses pengembangan
	$nbservice		= '0'; // masih default - proses pengembangan
	$id_campaign		= '0'; // masih default - proses pengembangan
	$num_trials_done	= '0'; // masih default - proses pengembangan
	$vat			= '0'; // masih default - proses pengembangan
	$servicelastrun		= '0000-00-00 00:00:00'; // masih default - proses pengembangan
	$initialbalance		= '0.00000'; // masih default - proses pengembangan
	$invoiceday		= '1'; // masih default - proses pengembangan
	$autorefill		= '0'; // masih default - proses pengembangan
	$loginkey		= $loginkey_num; // masih default - proses pengembangan
	$mac_addr		= '00-00-00-00-00-00'; // masih default - proses pengembangan
	$id_timezone		= '55'; // masih default - proses pengembangan
	$tag			= ''; // masih default - proses pengembangan
	$voicemail_permitted	= '0'; // masih default - proses pengembangan
	$voicemail_activated	= '0'; // masih default - proses pengembangan
	$last_notification	= ''; // masih default - proses pengembangan
	$email_notification	= ''; // masih default - proses pengembangan
	$notify_email		= '0'; // masih default - proses pengembangan
	$credit_notification	= '-1'; // masih default - proses pengembangan
	$id_group		= '1'; // masih default - proses pengembangan
	$company_name		= ''; // masih default - proses pengembangan
	$company_website	= ''; // masih default - proses pengembangan
	$vat_rn			= isset($_POST['vat_rn']) ? $_POST['vat_rn'] : '';
	$traffic		= isset($_POST['traffic']) ? $_POST['traffic'] : '';
	$traffic_target		= isset($_POST['traffic_target']) ? $_POST['traffic_target'] : '';
	$discount		= '0.00';
	$restriction		= '0';
	$id_seria		= '';
	$serial			= '';
	$block			= '0';
	$lock_pin		= '';
	$lock_date		= '';
	
	/*
	$form_action 		= isset($_POST['form_action']) ? $_POST['form_action'] : '';
	$wh 			= isset($_POST['wh']) ? $_POST['wh'] : '';
	$iax_buddy		= isset($_POST['iax_buddy']) ? $_POST['iax_buddy'] : '';
	$sip_buddy		= isset($_POST['sip_buddy']) ? $_POST['sip_buddy'] : '';
	$expire_day		= isset($_POST['expire_day']) ? $_POST['expire_day'] : '';
	$typepaid		= isset($_POST['typepaid']) ? $_POST['typepaid'] : '';
	$enableexpire		= isset($_POST['enableexpire']) ? $_POST['enableexpire'] : '';
	$runservice		= isset($_POST['runservice']) ? $_POST['runservice'] : '';
	$simultaccess		= isset($_POST['simultaccess']) ? $_POST['simultaccess'] : '';
	$credit			= isset($_POST['credit']) ? $_POST['credit'] : '';
	$username		= isset($_POST['username']) ? $_POST['username'] : '';
	$uipass			= isset($_POST['uipass']) ? $_POST['uipass'] : '';
	$loginkey		= isset($_POST['loginkey']) ? $_POST['loginkey'] : '';
	$status			= isset($_POST['status']) ? $_POST['status'] : '';
	$atmenu			= isset($_POST['atmenu']) ? $_POST['atmenu'] : '';
	$language		= isset($_POST['language']) ? $_POST['language'] : '';
	$currency		= isset($_POST['currency']) ? $_POST['currency'] : '';
	$tariff			= isset($_POST['tariff']) ? $_POST['tariff'] : '';
	$lastname		= isset($_POST['lastname']) ? $_POST['lastname'] : '';
	$firstname		= isset($_POST['firstname']) ? $_POST['firstname'] : '';
	$email			= isset($_POST['email']) ? $_POST['email'] : '';
	$address		= isset($_POST['address']) ? $_POST['address'] : '';
	$city			= isset($_POST['city']) ? $_POST['city'] : '';
	$state			= isset($_POST['state']) ? $_POST['state'] : '';
	$country		= isset($_POST['country']) ? $_POST['country'] : '';
	$zipcode		= isset($_POST['zipcode']) ? $_POST['zipcode'] : '';
	$id_timezone		= isset($_POST['id_timezone']) ? $_POST['id_timezone'] : '';
	$phone			= isset($_POST['phone']) ? $_POST['phone'] : '';
	$fax			= isset($_POST['fax']) ? $_POST['fax'] : '';
	$company_name		= isset($_POST['company_name']) ? $_POST['company_name'] : '';
	$company_website	= isset($_POST['company_website']) ? $_POST['company_website'] : '';
	$vat_rn			= isset($_POST['vat_rn']) ? $_POST['vat_rn'] : '';
	$traffic		= isset($_POST['traffic']) ? $_POST['traffic'] : '';
	$traffic_target		= isset($_POST['traffic_target']) ? $_POST['traffic_target'] : '';
	$captcha_code		= isset($_POST['captcha_code']) ? $_POST['captcha_code'] : '';
	$sign_up		= isset($_POST['sign_up']) ? $_POST['sign_up'] : '';
	*/
	$sql = "INSERT INTO `cc_card` (`id`, `creationdate`, `firstusedate`, `expirationdate`, `enableexpire`, `expiredays`, `username`, `useralias`, `uipass`, `credit`, `tariff`, `id_didgroup` ,`activated`, `status`, `lastname`, `firstname`, `address`, `city`, `state`, `country`, `zipcode`, `phone`, `email`, `fax`, `inuse`, `simultaccess`, `currency`, `lastuse`, `nbused`, `typepaid`, `creditlimit`, `voipcall`, `sip_buddy`, `iax_buddy`, `language`, `redial`, `runservice`, `nbservice`, `id_campaign`, `num_trials_done`, `vat`, `servicelastrun`, `initialbalance`, `invoiceday`, `autorefill`, `loginkey`, `mac_addr`, `id_timezone`, `tag`, `voicemail_permitted`, `voicemail_activated`, `last_notification`, `email_notification`, `notify_email`, `credit_notification`, `id_group`, `company_name`, `company_website`, `vat_rn`, `traffic`, `traffic_target`, `discount`, `restriction`, `id_seria`, `serial`, `block`, `lock_pin`, `lock_date`)
		       VALUES (NULL, NOW(), '$firstusedate', '$expirationdate', '$enableexpire', '$expiredays', '$username', '$useralias', '$uipass', '$credit', '$tariff', '$id_didgroup', '$activated', '$status', '$lastname', '$firstname', '$address', '$city', '$state', '$country', '$zipcode', '$phone', '$email', '$fax', '$inuse', '$simultaccess', '$currency', '$lastuse', '$nbused', '$typepaid', '$creditlimit', '$voipcall', '$sip_buddy', '$iax_buddy', '$language', '$redial', '$runservice', '$nbservice', '$id_campaign', '$num_trials_done', '$vat', '$servicelastrun', '$initialbalance', '$invoiceday', '$autorefill', '$loginkey', '$mac_addr', '$id_timezone', '$tag', '$voicemail_permitted', '$voicemail_activated', '$last_notification', '$email_notification', '$notify_email', '$credit_notification', '$id_group', '$company_name', '$company_website', '$vat_rn', '$traffic', '$traffic_target', '$discount', '$restriction', '$id_seria', '$serial', '$block', '$lock_pin', '$lock_date');";
	$sql_insert = mysql_query($sql);
	if($sql_insert){echo'data berhasil diinput';}  else {echo'data gagal diinput';}
	
			
}

$id_voip = $loggedin['id_voip']; 
$data_sign_up = mysql_query("SELECT * FROM cc_card WHERE useralias='$id_voip'");
$data_array = mysql_fetch_array($data_sign_up);
/*
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="../../index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                AdminLTE
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../../img/avatar3.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li><!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../../img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../../img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../../img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../../img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Reviewers
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users warning"></i> 5 new members joined
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-cart success"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-person danger"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Jane Doe <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="../../img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        Jane Doe - Web Developer
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="../../img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Jane</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="../../index.html">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="../widgets.html">
                                <i class="fa fa-th"></i> <span>Widgets</span> <small class="badge pull-right bg-green">new</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Charts</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../charts/morris.html"><i class="fa fa-angle-double-right"></i> Morris</a></li>
                                <li><a href="../charts/flot.html"><i class="fa fa-angle-double-right"></i> Flot</a></li>
                                <li><a href="../charts/inline.html"><i class="fa fa-angle-double-right"></i> Inline charts</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>UI Elements</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../UI/general.html"><i class="fa fa-angle-double-right"></i> General</a></li>
                                <li><a href="../UI/icons.html"><i class="fa fa-angle-double-right"></i> Icons</a></li>
                                <li><a href="../UI/buttons.html"><i class="fa fa-angle-double-right"></i> Buttons</a></li>
                                <li><a href="../UI/sliders.html"><i class="fa fa-angle-double-right"></i> Sliders</a></li>
                                <li><a href="../UI/timeline.html"><i class="fa fa-angle-double-right"></i> Timeline</a></li>
                            </ul>
                        </li>
                        <li class="treeview active">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Forms</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active"><a href="general.html"><i class="fa fa-angle-double-right"></i> General Elements</a></li>
                                <li><a href="advanced.html"><i class="fa fa-angle-double-right"></i> Advanced Elements</a></li>
                                <li><a href="editors.html"><i class="fa fa-angle-double-right"></i> Editors</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Tables</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../tables/simple.html"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
                                <li><a href="../tables/data.html"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="../calendar.html">
                                <i class="fa fa-calendar"></i> <span>Calendar</span>
                                <small class="badge pull-right bg-red">3</small>
                            </a>
                        </li>
                        <li>
                            <a href="../mailbox.html">
                                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                                <small class="badge pull-right bg-yellow">12</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Examples</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../examples/invoice.html"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li><a href="../examples/login.html"><i class="fa fa-angle-double-right"></i> Login</a></li>
                                <li><a href="../examples/register.html"><i class="fa fa-angle-double-right"></i> Register</a></li>
                                <li><a href="../examples/lockscreen.html"><i class="fa fa-angle-double-right"></i> Lockscreen</a></li>
                                <li><a href="../examples/404.html"><i class="fa fa-angle-double-right"></i> 404 Error</a></li>
                                <li><a href="../examples/500.html"><i class="fa fa-angle-double-right"></i> 500 Error</a></li>
                                <li><a href="../examples/blank.html"><i class="fa fa-angle-double-right"></i> Blank Page</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        General Form Elements
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Forms</a></li>
                        <li class="active">General Elements</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Quick Example</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <input type="file" id="exampleInputFile">
                                            <p class="help-block">Example block-level help text here.</p>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Check me out
                                            </label>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->

                            <!-- Form Element sizes -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Different Height</h3>
                                </div>
                                <div class="box-body">
                                    <input class="form-control input-lg" type="text" placeholder=".input-lg">
                                    <br/>
                                    <input class="form-control" type="text" placeholder="Default input">
                                    <br/>
                                    <input class="form-control input-sm" type="text" placeholder=".input-sm">
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Different Width</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <input type="text" class="form-control" placeholder=".col-xs-3">
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" placeholder=".col-xs-4">
                                        </div>
                                        <div class="col-xs-5">
                                            <input type="text" class="form-control" placeholder=".col-xs-5">
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                            <!-- Input addon -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Input Addon</h3>
                                </div>
                                <div class="box-body">
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" class="form-control" placeholder="Username">
                                    </div>
                                    <br/>
                                    <div class="input-group">
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                    <br/>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon">.00</span>
                                    </div>

                                    <h4>With icons</h4>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="text" class="form-control" placeholder="Email">
                                    </div>
                                    <br/>
                                    <div class="input-group">
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                    </div>
                                    <br/>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon"><i class="fa fa-ambulance"></i></span>
                                    </div>

                                    <h4>With checkbox and radio inputs</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="checkbox">
                                                </span>
                                                <input type="text" class="form-control">
                                            </div><!-- /input-group -->
                                        </div><!-- /.col-lg-6 -->
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="radio">
                                                </span>
                                                <input type="text" class="form-control">
                                            </div><!-- /input-group -->
                                        </div><!-- /.col-lg-6 -->
                                    </div><!-- /.row -->

                                    <h4>With buttons</h4>
                                    <p class="margin">Large: <code>.input-group.input-group-lg</code></p>
                                    <div class="input-group input-group-lg">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Action <span class="fa fa-caret-down"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Separated link</a></li>
                                            </ul>
                                        </div><!-- /btn-group -->
                                        <input type="text" class="form-control">
                                    </div><!-- /input-group -->
                                    <p class="margin">Normal</p>
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-danger">Action</button>
                                        </div><!-- /btn-group -->
                                        <input type="text" class="form-control">
                                    </div><!-- /input-group -->
                                    <p class="margin">Small <code>.input-group.input-group-sm</code></p>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-flat" type="button">Go!</button>
                                        </span>
                                    </div><!-- /input-group -->
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">
                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-header">
                                    <h3 class="box-title">General Elements</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <form role="form">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Text</label>
                                            <input type="text" class="form-control" placeholder="Enter ..."/>
                                        </div>
                                        <div class="form-group">
                                            <label>Text Disabled</label>
                                            <input type="text" class="form-control" placeholder="Enter ..." disabled/>
                                        </div>

                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Textarea</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Textarea Disabled</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter ..." disabled></textarea>
                                        </div>

                                        <!-- input states -->
                                        <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Input with success</label>
                                            <input type="text" class="form-control" id="inputSuccess" placeholder="Enter ..."/>
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="inputWarning"><i class="fa fa-warning"></i> Input with warning</label>
                                            <input type="text" class="form-control" id="inputWarning" placeholder="Enter ..."/>
                                        </div>
                                        <div class="form-group has-error">
                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Input with error</label>
                                            <input type="text" class="form-control" id="inputError" placeholder="Enter ..."/>
                                        </div>

                                        <!-- checkbox -->
                                        <div class="form-group"> 
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"/>
                                                    Checkbox 1
                                                </label>                                                
                                            </div>

                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"/>
                                                    Checkbox 2
                                                </label>                                                
                                            </div>

                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" disabled/>
                                                    Checkbox disabled
                                                </label>                                                
                                            </div>
                                        </div>

                                        <!-- radio -->
                                        <div class="form-group"> 
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                                    Option one is this and that&mdash;be sure to include why it's great
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                    Option two can be something else and selecting it will deselect option one
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled/>
                                                    Option three is disabled
                                                </label>
                                            </div>
                                        </div>

                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Select</label>
                                            <select class="form-control">
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Disabled</label>
                                            <select class="form-control" disabled>
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                            </select>
                                        </div>

                                        <!-- Select multiple-->
                                        <div class="form-group">
                                            <label>Select Multiple</label>
                                            <select multiple class="form-control">
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Multiple Disabled</label>
                                            <select multiple class="form-control" disabled>
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                            </select>
                                        </div>

                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>        
    </body>
</html>
*/    
    $stats_content ='<h4>'.((isset($_GET["b"]) && isset($_GET["t"])) ? 'Bulan '.date("F", mktime(0, 0, 0, (int)$_GET["b"], 10)).' Tahun '.(int)$_GET["t"] : '').'</h4>
                
                <form action="" method="get">
  Sort by
<select name="sort" onchange="location.href=\'stats.php\'+options[selectedIndex].value;">
	<option value="">- Select -</option>
	<option value="">This Week</option>
	<option value="?b='.date("m").'&t='.date("Y").'">This Month</option>
        
</select>
</form>
                <div class="block">
                    <div id="chart1">';
                    
//echo $data_graph1;color: {['#FC0101','#012AFC','#04B625','#FFCC00','#3D96AE']},

//Statistik Complaint
/*$stat_complaint = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%';"));
$stat_ticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Problem';"));
$stat_nonticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Request';"));
$stat_prospek = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `status_prospek` = 'prospek';"));
$stat_nonprospek = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `status_prospek` = 'nonprospek';"));
$stat_spktech = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk` WHERE `date_add` LIKE '%".date("Y-m-")."%' AND `type_spk` = 'teknisi';"));
$stat_spkmkt = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk` WHERE `date_add` LIKE '%".date("Y-m-")."%' AND `type_spk` = 'marketing';"));
*/

//Array for userID Complaint
$replaceWord = array("/", '\/', ";", ",");


$stats_content .='

<div id="graphDashboard" style="min-width:100%; height: 380px; margin: 0 auto;"></div>
                    
                    
                    </div>
                </div>';
/*
 *            <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				<div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Info Tagihan </h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-info btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    Anda tidak mempunyai tagihan <br>
									or
									<div class="box-body no-padding">
                                    <table class="table" width="70%">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Paket</th>
                                            <th>Bulan</th>
											<th>Tagihan</th>
                                            <th style="width: 100px"> </th>
											<th style="width: 100px"> </th>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td>Data/Internet</td>
											<td>Agustus</td>
                                            <td>Rp. 500.000,00</td>
                                            <td><span class="label label-warning">View Invoices</span></td>
											<td><span class="label label-success">Payment History</span></td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>Abonnement VoIP/Telepon</td>
											<td>Agustus</td>
                                            <td>Rp. 60.000,00</td>
                                            <td><span class="label label-warning">View Invoices</span></td>
											<td><span class="label label-success">Payment History</span></td>
                                        </tr>
					<tr>
                                            <td>3.</td>
                                            <td>Video/VOD</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                    </table>
                                </div>
                                </div><!-- /.box-body -->
                            </div>
                    
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-4 connectedSortable">                            
			    <div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Status Data/Internet</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    Status Paket : Nama Paket<br>
				    Expired Paket: 01 Agustus 2022<br>
				    Monthly fee: Rp. 5.000.000,00<br><br>
				    
				    Status : Aktif<br><br><br><br>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
                            <!-- List History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Complaint History</h3>
                                    <div class="box-tools">
                                        <ul class="pagination pagination-sm no-margin pull-right">
                                            <li><a href="#">&laquo;</a></li>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">&raquo;</a></li>
                                        </ul>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th style="width: 40px">Status</th>
                                        </tr>
                                        <tr>
                                            
                                            <td>Inet Putus</td>
                                            <td>20/07/2014</td>
                                            <td><span class="label label-primary">Detail</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>Inet Putus</td>
                                            <td>15/06/2014</td>
                                            <td><span class="label label-primary">Detail</span></td>
                                        </tr>
					<tr>
                                            
                                            <td>Lemot</td>
                                            <td>28/04/2014</td>
                                            <td><span class="label label-primary">Detail</span></td>
                                        </tr>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </section><!-- /.Left col -->
                        
                        <section class="col-lg-4 connectedSortable">
			<div class="box box-solid box-warning">
                                <div class="box-header">
                                    <h3 class="box-title">Status Voip/Telepon</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-warning btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-warning btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
				    Nomer Telpon : 0341 - 555 555<br>
				    Saldo : Rp. 500.123,00<br>
                                    Status Paket : Nama Paket<br>
				    Expired Paket: 01 Agustus 2022<br>
				    Monthly fee: Rp. 50.000,00<br><br>
				    
				    Status : Aktif<br><br>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
                            <!-- List History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Call History</h3>
                                    <div class="box-tools">
                                        <ul class="pagination pagination-sm no-margin pull-right">
                                            <li><a href="#">&laquo;</a></li>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">&raquo;</a></li>
                                        </ul>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Destination</th>
                                            <th>Duration</th>
                                            <th>Rate</th>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td>08123456</td>
                                            <td>00:45</td>
                                            <td>Rp. 2000</td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>081123456</td>
                                            <td>00:45</td>
                                            <td>Rp. 2000</td>
                                        </tr>
					<tr>
                                            <td>3.</td>
                                            <td>081231456</td>
                                            <td>00:15</td>
                                            <td>Rp. 700</td>
                                        </tr>
					
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </section><!-- right col -->
			
			<section class="col-lg-4 connectedSortable">
			    <div class="box box-solid box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Status Video/VOD</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    OFF<br><br>
				    
				    <a href="" title="sign up">Sign up</a>
					<br><br><br><br><br><br>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
                            <!-- List History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Paket VOD</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Nama Paket</th>
                                            <th>Harga</th>
                                            
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td>Paket VOD 1</td>
                                            <td>Rp. 50.000</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>Paket VOD 2</td>
                                            <td>Rp. 500.000</td>
                                            
                                        </tr>
					<tr>
                                            <td>3.</td>
                                            <td>Paket VOD 3</td>
                                            <td>Rp. 750.000</td>
                                            
                                        </tr>
					
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			</section>
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
                */
    $content =' 
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Form  Sign Up
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Forms</a></li>
                        <li class="active">General Elements</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Sign Up</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" action="" method="POST">
                                    <div class="box-body">
                                        
                                        <!-- text input 
                                        <div class="form-group">
                                            <label>Text</label>
                                            <input type="text" class="form-control" placeholder="Enter ..."/>
                                        </div>
                                        -->
                                        
                                        <!-- language smd -->
                                        <div class="form-group">
                                            <label>Language</label>
                                            <select name="language" class="form-control">';
                                            if($data_array['language'] == 'en'){ $content .= '<OPTION  value="en" selected> ENGLISH </OPTION>'; } 
                                            if($data_array['language'] == 'es'){ $content .= '<OPTION  value="es" selected> SPANISH </OPTION>'; }
                                            if($data_array['language'] == 'fr'){ $content .= '<OPTION  value="fr" selected> FRENCH</OPTION>'; }
                                            if($data_array['language'] == 'ru'){ $content .= '<OPTION  value="ru" selected> RUSSIAN</OPTION>'; }
                                            if($data_array['language'] == 'br'){ $content .= '<OPTION  value="br" selected> BRAZILIAN</OPTION>'; }
                                            $content .= '    
                                            </select>
                                        </div>
                                        <!-- /language smd -->
                                        <!-- currency smd -->
                                        <div class="form-group">
                                            <label>Currency</label>
                                            <select name="currency" class="form-control">';
                                                    $query_currency = mysql_query("SELECT * FROM `cc_currencies`");
                                                    while($qc = mysql_fetch_array($query_currency)){
                                                    if($data_array['currency'] == $qc['currency']){ $content .= '<option value="'.$qc['currency'].'" selected>'.$qc['name'].'</option>'; }
                                                    }
                                            $content .= '    
                                            </select>
                                        </div>
                                        <!-- /currency smd -->
                                        <!-- callplan smd -->
                                        <div class="form-group">
                                            <label>Callplan</label>
                                            <select name="tariff" class="form-control">';
                                                    $query_tariffgroup = mysql_query("SELECT * FROM `cc_tariffgroup`");
                                                    while($qtg = mysql_fetch_array($query_tariffgroup)){
                                                    if($data_array['tariff'] == $qtg['id']){ $content .= '<option value="'.$qtg['id'].'" selected>'.$qtg['tariffgroupname'].'</option>'; }
                                                    }
                                            $content .= '   
                                            </select>
                                        </div>
                                        <!-- /callplan smd -->
                                        
                                        <!-- lastname td -->
                                        <div class="form-group">
                                            <label>Lastname</label>
                                            <input type="text" name="lastname" class="form-control" placeholder="Enter ..." value="'.$data_array['lastname'].'">
                                        </div>
                                        
                                        <!-- firstname td -->
                                        <div class="form-group">
                                            <label>Firstname</label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="firstname" value="'.$data_array['firstname'].'">
                                        </div>
                                        
                                        <!-- email td -->
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="email" value="'.$data_array['email'].'">
                                        </div>
                                        
                                        <!-- address td -->
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="address" value="'.$data_array['address'].'">
                                        </div>
                                        
                                        <!-- city td -->
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="city" value="'.$data_array['city'].'">
                                        </div>
                                        
                                        <!-- state td -->
                                        <div class="form-group">
                                            <label>State / Province</label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="state" value="'.$data_array['state'].'">
                                        </div>
                                        
                                        <!-- country smd -->
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select name="country" class="form-control">';
                                                    $query_country = mysql_query("SELECT * FROM `cc_country`");
                                                    while($qcy = mysql_fetch_array($query_country)){
                                                    if($data_array['country'] == $qcy['countrycode']){ $content .= '<option value="'.$qcy['countrycode'].'" selected>'.$qcy['countryname'].'</option>'; }
                                                    }
                                            $content .= '   
                                            </select>
                                        </div>
                                        
                                        <!-- zip code td -->
                                        <div class="form-group">
                                            <label>Zipcode</label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="zipcode" value="'.$data_array['zipcode'].'">
                                        </div>
                                        
                                        <!-- timezone smd -->
                                        <div class="form-group">
                                            <label>Timezone</label>
                                            <select name="id_timezone" class="form-control">';
                                            $query_timezone = mysql_query("SELECT * FROM `cc_timezone`");
                                                    while($qtz = mysql_fetch_array($query_timezone)){
                                                    if($data_array['id_timezone'] == $qtz['id']){ $content .= '<option value="'.$qtz['id'].'" selected>'.$qtz['gmtzone'].'</option>'; }
                                                    }
                                            $content .= ' 
                                            </select>
                                        </div>
                                        
                                        <!-- phonenumber -->
                                        <div class="form-group">
                                            <label>Phonenumber</label>
                                            <input type="text" class="form-control" name="phone" value="'.$data_array['phone'].'" placeholder="Enter ...">
                                        </div>
                                        
                                        <!-- fax number t -->
                                        <div class="form-group">
                                            <label>Fax Number</label>
                                            <input type="text" name="fax" class="form-control" placeholder="Enter ..."/>
                                        </div>
                                        
                                        <!-- company name t -->
                                        <div class="form-group">
                                            <label>Company name</label>
                                            <input type="text" name="company_name" class="form-control" placeholder="Enter ..."/>
                                        </div>
                                        
                                        <!-- company website t -->
                                        <div class="form-group">
                                            <label>Company Website</label>
                                            <input type="text" class="form-control" name="company_website" placeholder="Enter ..."/>
                                        </div>
                                        
                                        <!-- vat registration number t -->
                                        <div class="form-group">
                                            <label>Vat Registration Number</label>
                                            <input type="text" class="form-control" placeholder="Enter ..."/>
                                        </div>
                                        
                                        <!-- traffic per month t -->
                                        <div class="form-group">
                                            <label>Traffic Per Month</label>
                                            <input type="text" class="form-control" placeholder="Enter ..."/>
                                        </div>
                                        
                                        <!-- target trafic ta -->
                                        <div class="form-group">
                                            <label>Target Trafic</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                        </div>
                                        
                                        <!--
                                        //verification 
                                        <div class="form-group">
                                            <label>Verification</label>
                                            <input type="text" class="form-control" placeholder="Enter ..." disabled/>
                                        </div>
                                        -->
                                        
                                        
                                        
                                        
                                        
                                        <!--
                                        <div class="form-group">
                                            <label>Text Disabled</label>
                                            <input type="text" class="form-control" placeholder="Enter ..." disabled/>
                                        </div>

                                        // textarea 
                                        <div class="form-group">
                                            <label>Textarea</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Textarea Disabled</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter ..." disabled></textarea>
                                        </div>

                                        // input states 
                                        <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Input with success</label>
                                            <input type="text" class="form-control" id="inputSuccess" placeholder="Enter ..."/>
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="inputWarning"><i class="fa fa-warning"></i> Input with warning</label>
                                            <input type="text" class="form-control" id="inputWarning" placeholder="Enter ..."/>
                                        </div>
                                        <div class="form-group has-error">
                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Input with error</label>
                                            <input type="text" class="form-control" id="inputError" placeholder="Enter ..."/>
                                        </div>

                                        // checkbox
                                        <div class="form-group"> 
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"/>
                                                    Checkbox 1
                                                </label>                                                
                                            </div>

                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"/>
                                                    Checkbox 2
                                                </label>                                                
                                            </div>

                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" disabled/>
                                                    Checkbox disabled
                                                </label>                                                
                                            </div>
                                        </div>

                                        // radio 
                                        <div class="form-group"> 
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                                    Option one is this and that&mdash;be sure to include why its great
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                    Option two can be something else and selecting it will deselect option one
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled/>
                                                    Option three is disabled
                                                </label>
                                            </div>
                                        </div>

                                        // select
                                        <div class="form-group">
                                            <label>Select</label>
                                            <select class="form-control">
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Disabled</label>
                                            <select class="form-control" disabled>
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                            </select>
                                        </div>

                                        // Select multiple
                                        <div class="form-group">
                                            <label>Select Multiple</label>
                                            <select multiple class="form-control">
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Multiple Disabled</label>
                                            <select multiple class="form-control" disabled>
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                            </select>
                                        </div>

                                        
                                        
                                        
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <input type="file" id="exampleInputFile">
                                            <p class="help-block">Example block-level help text here.</p>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Check me out
                                            </label>
                                        </div>
                                    </div>
                                    //.box-body 
                                    -->
                                    
                                    
                                    
                                    <div class="box-footer">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </form>
                            </div><!-- /.box -->

                           

                           
                        </div><!--/.col (left) -->
                        
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            ';
            

/*
 *<!-- quick email widget -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title">Quick Email</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                </div>
                                <div class="box-body">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="emailto" placeholder="Email to:"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject"/>
                                        </div>
                                        <div>
                                            <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>
                            
*/
$plugins = '
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="'.URL.'js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="'.URL.'js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="'.URL.'js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="'.URL.'js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="'.URL.'js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="'.URL.'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="'.URL.'js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>


        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>

    ';

    $title	= 'Home';
    $submenu	= "dashboard";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>