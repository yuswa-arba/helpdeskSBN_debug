<?php
/*
 * Theme Name: Software Globalxtreme ver. 1.0
 * Website: http://192.168.182.10/software/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 1.0  | 8 Agustus 2014
 * Email:
 * Theme for http://192.168.182.10/software/beta/
 */


function software_theme($title="",$content="",$plugins="",$user="",$sub_menu="",$group="",$type=""){

 //Statistik Complaint
    /*$stat_complaint = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%';"));
    $stat_ticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Problem';"));
    $stat_nonticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Request';"));
    
    //Statistik Week
$year = date("Y"); // Year 2010
$week1 = isset($_GET["w"]) ? (int)$_GET["w"] : ""; // Week 1
$week = ($week1=="") ? date("W") : sprintf("%02s", $week1); // Week 1


$data_graph = 'series: [';

$jum_total_complaint = "";
$jum_total_ticket = "";
$jum_total_nonticket = "";

$sum_complaint = "";
$sum_ticket = "";
$sum_nonticket = "";

$data_complaint = "";
$data_ticket = "";
$data_nonticket = "";

for($i=1;$i<=7; $i++){

$date = date( "Y-m-d", strtotime($year."W".$week."$i") ); // First day of week

//echo $date.'<br>';

	$jum_total_complaint = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
	
	$jum_total_ticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Problem' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
	$jum_total_nonticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `user_details` WHERE
	          `gx_complaint`.`id_cso` = `user_details`.`user_index` AND
		  `gx_complaint`.`complaint_type` = 'Request' AND
		  `gx_complaint`.`log_time` LIKE '$date%' AND
		  `gx_complaint`.`level` = '0'"));
    
$data_complaint .= $jum_total_complaint.",";
$data_ticket .= $jum_total_ticket.",";
$data_nonticket .= $jum_total_nonticket.",";

$sum_complaint += $jum_total_complaint;
$sum_ticket += $jum_total_ticket;
$sum_nonticket += $jum_total_nonticket;

}

$complaint		= substr($data_complaint, 0, -1);
$ticket			= substr($data_ticket, 0, -1);
$nonticket		= substr($data_nonticket, 0, -1);
*/

//END Statistik week
    // Saldo
    global $conn;
    
    $loggedin     = logged_in();
    $sql_saldo    = mysql_query("SELECT `gx_saldo` FROM `tbCustomer` WHERE `cKode` = '".$loggedin["customer_number"]."' LIMIT 0,1;", $conn);
    $row_saldo    = mysql_fetch_array($sql_saldo);
    $saldo        = Rupiah($row_saldo["gx_saldo"]);
    
    //poto profile
    $sql_pic    = mysql_query("SELECT `file_foto` FROM `gxFoto_Profile` WHERE `cKode` = '".$loggedin["customer_number"]."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_pic    = mysql_fetch_array($sql_pic);
    $pic_profile        = ($row_pic["file_foto"] == "") ? URL.'img/avatar5.png' : URL."img/profile/customer/".$row_pic["file_foto"];
    
    
    
    $user_explode = explode(' ', $user);
	$sidebar ='<!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="'.$pic_profile.'" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, '.$user_explode[0].'</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a><br><br>
                            
                        </div>
                    </div>
                    
                    <!-- search form -->
                    <!--<div class="sidebar-form" style="padding: 3px;text-align: center;">
                        <span style="color:#000;font-size:16px;">Saldo </br>Rp 100,00</span>
                    </div><form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type="submit" name="seach" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>-->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li'.(($sub_menu=="Dashboard") ? ' class="active"' : '').'>
                            <a href="'.URL.'home.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li'.(($sub_menu=="profile") ? ' class="active"' : '').'>
                            <a href="'.URL.'profile">
                                <i class="fa fa-user"></i> <span>Profile</span>
                            </a>
                        </li>
                        <li'.(($sub_menu=="inet_dashboard" || $sub_menu=="inet_invoice" || $sub_menu=="inet_paket"
                               || $sub_menu=="inet_mrtg" || $sub_menu=="inet_voucher" || $sub_menu=="inet_payment"
                               || $sub_menu=="inet_sesshistory" || $sub_menu=="complaint")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Internet/Data</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="inet_invoice") ? ' class="active"' : '').'><a href="'.URL.'data/invoice.php"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li'.(($sub_menu=="inet_payment") ? ' class="active"' : '').'><a href="'.URL.'data/payment.php"><i class="fa fa-angle-double-right"></i> Payment History</a></li>
                                <li'.(($sub_menu=="inet_paket") ? ' class="active"' : '').'><a href="'.URL.'data/paket.php"><i class="fa fa-angle-double-right"></i> Paket</a></li>
                                <!--<li'.(($sub_menu=="inet_voucher") ? ' class="active"' : '').'><a href="'.URL.'data/voucher.php"><i class="fa fa-angle-double-right"></i> Voucher</a></li>-->
                                <li'.(($sub_menu=="inet_mrtg") ? ' class="active"' : '').'><a href="'.URL.'data/mrtg.php"><i class="fa fa-angle-double-right"></i> MRTG</a></li>
                                <li'.(($sub_menu=="inet_sesshistory") ? ' class="active"' : '').'><a href="'.URL.'data/session_history.php"><i class="fa fa-angle-double-right"></i> Session History</a></li>
                                <li'.(($sub_menu=="complaint") ? ' class="active"' : '').'><a href="'.URL.'complaint/complaint.php"><i class="fa fa-angle-double-right"></i> Complaint</a></li>
                                
                            </ul>
                        </li>
                        <li'.(($sub_menu=="Invoice" || $sub_menu=="Payment History" || $sub_menu=="Call History"
                               || $sub_menu=="Voucher" || $sub_menu=="paket_voip" || $sub_menu=="voip_topup"
                               || $sub_menu=="voip_setting")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-phone-square"></i>
                                <span>Voip</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="voip_invoice") ? ' class="active"' : '').'><a href="'.URL.'voip/list_invoice.php"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                
                                <li'.(($sub_menu=="Call History") ? ' class="active"' : '').'><a href="'.URL.'voip/call_history.php"><i class="fa fa-angle-double-right"></i> Call History</a></li>
                                <li'.(($sub_menu=="voip_voucher") ? ' class="active"' : '').'><a href="'.URL.'voip/voucher.php"><i class="fa fa-angle-double-right"></i> Voucher</a></li>
                                <li'.(($sub_menu=="paket_voip") ? ' class="active"' : '').'><a href="'.URL.'voip/paket.php"><i class="fa fa-angle-double-right"></i> Paket</a></li>
                                <li'.(($sub_menu=="voip_topup") ? ' class="active"' : '').'><a href="'.URL.'voip/topup.php"><i class="fa fa-angle-double-right"></i> Topup</a></li>
                                <li'.(($sub_menu=="voip_setting") ? ' class="active"' : '').'><a href="'.URL.'voip/setting.php"><i class="fa fa-angle-double-right"></i> Setting</a></li>
                            </ul>
                        </li>';
                        /*<li'.(($sub_menu=="vod_dashboard" || $sub_menu=="vod_invoice" || $sub_menu=="vod_topup" || $sub_menu=="vod_paket"
                               || $sub_menu=="vod_payment" || $sub_menu=="vod_topup")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-laptop"></i> <span>VOD</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="vod_invoice") ? ' class="active"' : '').'><a href="'.URL.'vod/list_invoice.php"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                
                        <li'.(($sub_menu=="vod_topup") ? ' class="active"' : '').'><a href="'.URL.'vod/topup.php"><i class="fa fa-angle-double-right"></i> Top Up Saldo</a></li>
                                <li'.(($sub_menu=="vod_paket") ? ' class="active"' : '').'><a href="'.URL.'vod/paket.php"><i class="fa fa-angle-double-right"></i> Paket</a></li>
                                <li'.(($sub_menu=="vod_topup") ? ' class="active"' : '').'><a href="'.URL.'vod/topup.php"><i class="fa fa-angle-double-right"></i> Topup</a></li>
                            </ul>
                        </li>*/
                        $sidebar .='
                        <li'.(($sub_menu=="tv_dashboard" || $sub_menu=="tv_invoice" || $sub_menu=="tv_topup" || $sub_menu=="tv_paket"
                               || $sub_menu=="tv_payment" || $sub_menu=="tv_topup")
                                ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-laptop"></i> <span>TV</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="tv_invoice") ? ' class="active"' : '').'><a href="'.URL.'tv/list_invoice.php"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li'.(($sub_menu=="tv_topup") ? ' class="active"' : '').'><a href="'.URL.'tv/topup.php"><i class="fa fa-angle-double-right"></i> Top Up Saldo</a></li>
                                <li'.(($sub_menu=="tv_paket") ? ' class="active"' : '').'><a href="'.URL.'tv/paket.php"><i class="fa fa-angle-double-right"></i> Paket</a></li>
                            </ul>
                        </li>
                        <li'.(($sub_menu=="topup") ? ' class="active"' : '').'>
                            <a href="'.URL.'topup/form_topup.php">
                                <i class="fa fa-credit-card"></i> <span>Topup</span>
                            </a>
                        </li>
                        <li'.(($sub_menu=="mail") ? ' class="active"' : '').'>
                            <a href="'.URL.'">
                                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                                <small class="badge pull-right bg-red">3</small>
                            </a>
                        </li>
                        <li>
                            <a href="'.URL.'notification.php">
                                <i class="fa fa-exclamation-triangle"></i> <span>Notification</span>
                                <small class="badge pull-right bg-yellow">12</small>
                            </a>
                        </li>
                        <li>
                            <a href="'.URL.'setting.php">
                                <i class="fa fa-gear"></i> <span>Setting</span>
                                
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="'.URL.'help.php">
                                <i class="fa fa-th"></i> <span>Help</span>
                            </a>
                        </li>
                    </ul>';
    
    $title_html = ($title != "") ? "Panel Customer (beta) - $title" : "Panel Customer (beta)";

    //<li'.(($sub_menu=="Payment History") ? ' class="active"' : '').'><a href="'.URL.'voip/payment_history.php"><i class="fa fa-angle-double-right"></i> Payment History</a></li>
    //<li'.(($sub_menu=="vod_payment") ? ' class="active"' : '').'><a href="'.URL.'vod/payment.php"><i class="fa fa-angle-double-right"></i> Payment History</a></li>
    //MailBox
    //$sql_mailbox    = mysql_query("SELECT * FROM `gx_email` WHERE `kategori` = '' ORDER BY `DateE` DESC");
    //$sum_mailbox    = mysql_num_rows($sql_mailbox);
    
    
    
    $template ='<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>'.$title_html.'</title>
        
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- bootstrap 3.0.2 -->
        <link href="'.URL.'css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="'.URL.'css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="'.URL.'css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="'.URL.'css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="'.URL.'css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="'.URL.'css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="'.URL.'css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="'.URL.'css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="'.URL.'css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="'.URL.'js/html5shiv.js"></script>
          <script src="'.URL.'js/respond.min.js"></script>
        <![endif]-->
        <style> table {white-space: nowrap;} </style>
	
    </head>
    <body class="skin-'.(($type !="") ? $type : "blue").'">
	        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="'.URL.'home.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img alt="GX Panel Customer Logo" src="'.URL.'img/logo20.png"/> &nbsp;
                <span>GX Panel Customer</span></a>
            </a>
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
                        
                        <!--<li class="user user-menu">
                            <a href="" >
                                Saldo Anda'.$saldo.'
                            </a>
                        </li>-->
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
                                                    <img src="'.$pic_profile.'" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Please pay for the invoice</p>
                                            </a>
                                        </li><!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="'.URL.'img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Please pay for the invoice</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="'.URL.'img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Please pay for the invoice</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="'.URL.'img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                </h4>
                                                <p>Please pay for the invoice</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="'.URL.'img/avatar.png" class="img-circle" alt="user image"/>
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
                                <span>Profile<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="'.$pic_profile.'" class="img-circle" alt="User Image" />
                                    <p>
                                        '.$user.'
                                        
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-body">
                                    <div class="col-xs-12 text-center">
                                        Saldo Anda '.$saldo.'
                                    </div>
                                    
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="profile" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="javascript: logout();" class="btn btn-default btn-flat">Sign out</a>
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
                    '.$sidebar.'
                    
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="padding-bottom:100px;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        '.$title.'
                    </h1>
		    <div class="breadcrumb"><span style="font-size:16px;" '.(($type !="") ? 'class="text-'.$type.'"' : "").'>Saldo Anda '.$saldo.'</span></div>
                    
                </section>
                
                '.$content.'
	    </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <div id="notification"></div>
        <a id="StickyChatWithUs" style="width: 163px; height: 87px;"  href="https://globalxtreme.net/bali/chat/client.php?locale=en" target="_blank" onclick="if(navigator.userAgent.toLowerCase().indexOf(\'opera\') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open(&#039;https://globalxtreme.net/bali/chat/client.php?locale=en&amp;url=&#039;+escape(document.location.href)+&#039;&amp;referrer=&#039;+escape(document.referrer), \'mibew\', \'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1\');this.newWindow.focus();this.newWindow.opener=window;return false;">
    <img src="https://globalxtreme.net/bali/chat/b.php?i=mibew&amp;lang=en" border="0" width="163" height="87" alt="" class="TransparentImages" style="bottom: 0; right: 0;">
    <span id="StickyChatWithUsText" style="left: 85px; top: 30px;">Chat With Us</span>
</a>

<style type="text/css">
#StickyChatWithUs {
position: fixed;
bottom: 0;
right: 0;
width: 150px;
height: 31px;
color: #FFF;
font-size: 13px;
font-weight: bold;
line-height: 31px;
text-align: justify;
text-decoration: none;
cursor: pointer;
}
</style>

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="'.URL.'js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="'.URL.'js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="'.URL.'js/bootstrap.min.js" type="text/javascript"></script>
        
	<!-- AdminLTE App -->
        <script src="'.URL.'js/AdminLTE/app.js" type="text/javascript"></script>    
        
	'.$plugins.'

<script language="javascript">
//confirm message for logout.
function logout() {
    if (confirm("Anda yakin untuk keluar ?")) {
	   
       window.location.href = "'.URL.'logout.php";
    }
}
//open popup window
function valideopenerform(url,title){
	var popy= window.open(url,title,"toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
	if (window.focus) {popy.focus()}
	return false;
    }
</script>

</body>
</html>';
/*
<!-- Growl Notification -->
<script src="'.URL.'js/plugins/growl/jquery.bootstrap-growl.js"></script>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({ cache: false }); 
        setInterval(function() {
            $(\'#notification\').load(\'ajax/notif.php\');
        }, 20000); 
    });
    
</script>
*/
return $template;

}

function software_theme_popup($title="",$content="",$plugins="",$user="",$sub_menu="",$group=""){
    
    $title_html = ($title != "") ? "Panel Administrator (beta) - $title" : "Panel Administrator (beta) ";
    $sidebar = '';
    
    // Saldo
    global $conn;
    
    $loggedin = logged_in();
    $sql_saldo    = mysql_query("SELECT `gx_saldo` FROM `tbCustomer` WHERE `cKode` = '".$loggedin["customer_number"]."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_saldo    = mysql_fetch_array($sql_saldo);
    $saldo        = Rupiah($row_saldo["gx_saldo"]);
    
    $sql_pic    = mysql_query("SELECT `file_foto` FROM `gxFoto_Profile` WHERE `cKode` = '".$loggedin["customer_number"]."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_pic    = mysql_fetch_array($sql_pic);
    $pic_profile        = ($row_pic["file_foto"] == "") ? URL.'img/avatar5.png' : URL."img/profile/customer/".$row_pic["file_foto"];
    
    $template ='<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>'.$title_html.'</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- bootstrap 3.0.2 -->
        <link href="'.URL.'css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="'.URL.'css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="'.URL.'css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="'.URL.'css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
	
	
	
    </head>
    <body class="skin-blue">
	        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="home.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img alt="GX Panel Customer Logo" src="'.URL.'img/logo20.png"/> &nbsp;
                <span>GX Panel Customer</span></a>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Profile<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="'.$pic_profile.'" class="img-circle" alt="User Image" />
                                    <p>
                                        '.$user.'
                                        
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="javascript: logout();" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            '.$sidebar.'

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        '.$title.'
                    </h1>
                    <div class="breadcrumb"><span style="color:#000;font-size:16px;">Saldo Anda '.$saldo.'</span></div>
                </section>
                '.$content.'
	    </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <div id="notification"></div>

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="'.URL.'js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="'.URL.'js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="'.URL.'js/bootstrap.min.js" type="text/javascript"></script>
        
	<!-- AdminLTE App -->
        <script src="'.URL.'js/AdminLTE/app.js" type="text/javascript"></script>    
        
	'.$plugins.'


<script language="javascript">
//Added by dwi
//confirm message for logout.
function logout() {
    if (confirm("Anda yakin untuk keluar ?")) {
	   
       window.location.href = "'.URL.'logout.php";
    }
}
//open popup window
function valideopenerform(url,title){
	var popy= window.open(url,title,"toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
	if (window.focus) {popy.focus()}
	return false;
    }
</script>

</body>
</html>';

/*
 *
 *<!-- Growl Notification -->
<script src="'.URL.'js/plugins/growl/jquery.bootstrap-growl.js"></script>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({ cache: false }); 
        setInterval(function() {
            $(\'#notification\').load(\'ajax/notif.php\');
        }, 20000); 
    });
    
</script>

 *<!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-danger">'.$sum_mailbox.'</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have '.$sum_mailbox.' messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">';
                                    while($row_mailbox = mysql_fetch_array($sql_mailbox)){
                                        $template .= '<li><!-- start message -->
                                            <a href="form_mailbox.php?id='.$row_mailbox["ID"].'" onclick="return valideopenerform(\'form_mailbox.php?id='.str_replace(' ', '', $row_mailbox["ID"]).'\',\'mailbox'.$row_mailbox["ID"].'\');">
                                                <div class="pull-left">
                                                    <img src="img/avatar5.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    '.$row_mailbox["EmailFromP"].'
                                                    <small><i class="fa fa-clock-o"></i> '.date("H:i", strtotime($row_mailbox["DateE"])).'</small>
                                                </h4>
                                                <p>'.$row_mailbox["Subject"].'</p>
                                            </a>
                                        </li><!-- end message -->';
                                    }
                                        
                                $template .='
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
                        
                        */

return $template;

}
function map_popup($title="",$content="",$plugins="",$user="",$sub_menu="",$group=""){
    
    $title_html = ($title != "") ? "Panel Administrator (beta) - $title" : "Panel Administrator (beta) ";
    $sidebar = '';
    $template ='<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>'.$title_html.'</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- bootstrap 3.0.2 -->
        <link href="'.URL.'css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="'.URL.'css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="'.URL.'css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="'.URL.'css/AdminLTE.css" rel="stylesheet" type="text/css" />

        
    </head>
    <body class="skin-blue">
	        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="home.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img alt="GX Panel Customer Logo" src="'.URL.'img/logo20.png"/> &nbsp;
                <span>GX Panel Customer</span></a>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Profile<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="'.$pic_profile.'" class="img-circle" alt="User Image" />
                                    <p>
                                        '.$user.'
                                        
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="javascript: logout();" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            '.$sidebar.'

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        '.$title.'
                    </h1>
                    <!--<ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="customer">Customer</a></li>
                    </ol>-->
                </section>
                '.$content.'
	    </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <div id="notification"></div>

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="'.URL.'js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="'.URL.'js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="'.URL.'js/bootstrap.min.js" type="text/javascript"></script>
        
        
	'.$plugins.'


<script language="javascript">
//Added by dwi
//confirm message for logout.
function logout() {
    if (confirm("Anda yakin untuk keluar ?")) {
	   
       window.location.href = "'.URL.'logout.php";
    }
}
//open popup window
function valideopenerform(url,title){
	var popy= window.open(url,title,"toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
	if (window.focus) {popy.focus()}
	return false;
    }
</script>

</body>
</html>';

return $template;

}