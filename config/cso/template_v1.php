<?php
/*
 * Theme Name: Software Globalxtreme ver. 1.0
 * Website: http://192.168.182.10/software/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 1.0  | 8 Agustus 2014
 * Email:
 * Theme for http://192.168.182.10/software/beta/
 */


function cso_theme($title="",$content="",$plugins="",$user="",$sub_menu="",$group=""){
    global $conn;
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
    
    $user_explode = explode(' ', $user);
    //MailBox
    $sql_mailbox    = mysql_query("SELECT * FROM `gx_email` WHERE `DateE` LIKE  '%".date("Y-m-d")."%' ORDER BY `DateE` DESC", $conn);
    $sum_mailbox    = mysql_num_rows($sql_mailbox);
    $sql_profile = mysql_query("SELECT * FROM `gx_pegawai` WHERE `nama` = '".$user."' AND `level` = '0' LIMIT 0,1;", $conn);
	$row_profile = mysql_fetch_array($sql_profile);
        $sidebar ='<!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">';
								if($row_profile['pic_profile'] != ""){
									$sidebar .='<img src="'.URL_ADMIN.'img/staff/'.$row_profile['pic_profile'].'" class="img-circle" alt="User Image" />';
								}else{
									$sidebar .='<img src="'.URL.'img/avatar5.png" class="img-circle" alt="User Image" />';
								}
								$sidebar .='
                           
                        </div>
                        <div class="pull-left info">
                            <p>Hello, '.$user_explode[0].'</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form 
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type="submit" name="seach" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                     /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li'.(($sub_menu=="dashboard") ? ' class="active"' : '').'>
                            <a href="'.URL_CSO.'home.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li'.(($sub_menu=="profile")
                       ? ' class="active"' : '').'>
                            <a href="'.URL_CSO.'profile.php">
                                <i class="fa fa-user"></i> <span>Profile</span>
                            </a>
                        </li>
			
                        <li'.(($sub_menu=="helpdesk_dashboard" || $sub_menu=="helpdesk_form_complaint" || $sub_menu=="helpdesk_troubleticket" || $sub_menu=="helpdesk_complaint" || $sub_menu=="helpdesk_prospek"
                               || $sub_menu=="helpdesk_nonprospek" || $sub_menu=="helpdesk_spktech" || $sub_menu=="helpdesk_spkmkt" || $sub_menu=="helpdesk_form_outgoing_report" || $sub_menu=="helpdesk_outgoing_report")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-desktop"></i> <span>Helpdesk</span>
				<i class="fa fa-angle-left pull-right"></i>
                            </a>
			    <ul class="treeview-menu">
                                <li'.(($sub_menu=="cso") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/list_cso.php"><i class="fa fa-angle-double-right"></i> List CSO</a></li>
                                <li'.(($sub_menu=="resetpwd") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/resetpwd.php"><i class="fa fa-angle-double-right"></i> Reset Password</a></li>
								<li'.(($sub_menu=="data_customer") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/customer.php"><i class="fa fa-angle-double-right"></i> Data Customer</a></li>
                                <li'.(($sub_menu=="helpdesk_form_complaint") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/form_complaint.php"><i class="fa fa-angle-double-right"></i> Form Incoming</a></li>
                                <li'.(($sub_menu=="helpdesk_complaint") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/complaint"><i class="fa fa-angle-double-right"></i> Incoming Report</a></li>
                                <li'.(($sub_menu=="helpdesk_troubleticket") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/list_troubleticket"><i class="fa fa-angle-double-right"></i> Troubleticket</a></li>
                                <li'.(($sub_menu=="helpdesk_prospek") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/prospek.php"><i class="fa fa-angle-double-right"></i> Prospek</a></li>
                                <li'.(($sub_menu=="helpdesk_nonprospek") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/incoming.php?type=nonprospek"><i class="fa fa-angle-double-right"></i> Non-Prospek</a></li>
								<li'.(($sub_menu=="helpdesk_spktech") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/spk_maintenance.php"><i class="fa fa-angle-double-right"></i> SPK Teknisi</a></li>
                                <li'.(($sub_menu=="helpdesk_spkmkt") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/spk_survey.php"><i class="fa fa-angle-double-right"></i> SPK Marketing</a></li>
								<li'.(($sub_menu=="gen_report") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/generate_report.php"><i class="fa fa-angle-double-right"></i> Generate Report</a></li>
								<li'.(($sub_menu=="summary") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/summary.php"><i class="fa fa-angle-double-right"></i> Summary</a></li>
								<li'.(($sub_menu=="graph") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/graph.php"><i class="fa fa-angle-double-right"></i> Graph</a></li>
								<li'.(($sub_menu=="list_grace") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/list_grace.php"><i class="fa fa-angle-double-right"></i> Rekap Customer Grace</a></li>
								<li'.(($sub_menu=="list_blokir") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/list_blokir.php"><i class="fa fa-angle-double-right"></i> Rekap Customer Blokir</a></li>
								<li'.(($sub_menu=="gen_report") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/report.php"><i class="fa fa-angle-double-right"></i> Report Bulanan</a></li>
								<li'.(($sub_menu=="helpdesk_form_outgoing_report") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/form_outgoing_report.php"><i class="fa fa-angle-double-right"></i> Form Outgoing Report</a></li>
								<li'.(($sub_menu=="helpdesk_outgoing_report") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/outgoing_report.php"><i class="fa fa-angle-double-right"></i> Outgoing Report</a></li>
                            </ul>
                        </li>
						<li'.(($sub_menu=="maintenance" || $sub_menu=="pasang_fo" )
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-desktop"></i> <span>Maintenance</span>
				<i class="fa fa-angle-left pull-right"></i>
                            </a>
			    <ul class="treeview-menu">
                                <li'.(($sub_menu=="maintenance") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/maintenance.php"><i class="fa fa-angle-double-right"></i> Maintenance</a></li>
                                <li'.(($sub_menu=="pasang_fo") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/master_jadwal_pasang_fo.php"><i class="fa fa-angle-double-right"></i> Jadwal Pasang FO</a></li>
                                
                            </ul>
                        </li>
						<li'.(($sub_menu=="brosur" || $sub_menu=="penawaran" || $sub_menu=="proforma_invoice") ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-table"></i>
                                <span>Penawaran</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="penawaran") ? ' class="active"' : '').'><a href="'.URL_CSO.'penawaran/master_penawaran.php"><i class="fa fa-angle-double-right"></i> Master Penawaran</a></li>
                                <li'.(($sub_menu=="brosur") ? ' class="active"' : '').'><a href="'.URL_CSO.'penawaran/master_brosur.php"><i class="fa fa-angle-double-right"></i> Brosur</a></li>
                                <li'.(($sub_menu=="proforma_invoice") ? ' class="active"' : '').'><a href="'.URL_CSO.'penawaran/master_proforma_invoice.php"><i class="fa fa-angle-double-right"></i>Proforma Invoice</a></li>
                            </ul>
                        </li>
						
						<li'.(($sub_menu=="stb_user")
                       ? ' class="active"' : '').'>
                            <a href="'.URL_CSO.'tv/stb_user.php">
                                <i class="fa fa-desktop"></i> <span>GX TV</span>
                            </a>
                        </li>
						<li'.(($sub_menu=="cetak_formulir")
                       ? ' class="active"' : '').'>
                            <a href="'.URL_CSO.'marketing/cetak_formulir.php">
                                <i class="fa fa-list-alt"></i> <span>Cetak Formulir</span>
                            </a>
                        </li>
						<li'.(($sub_menu=="service_plan")
                       ? ' class="active"' : '').'>
                            <a href="'.URL_CSO.'helpdesk/service_plan.php">
                                <i class="fa fa-desktop"></i> <span>Service Plan</span>
                            </a>
                        </li>
						<li'.(($sub_menu=="monitoring_onu")
                       ? ' class="active"' : '').'>
                            <a href="'.URL_CSO.'helpdesk/data/monitoring_onu.php">
                                <i class="fa fa-desktop"></i> <span>Monitoring ONU</span>
                            </a>
                        </li>
						<li'.(($sub_menu=="monitoring_onu")
                       ? ' class="active"' : '').'>
                            <a href="'.URL_CSO.'helpdesk/data/monitoring_olt.php">
                                <i class="fa fa-desktop"></i> <span>Monitoring OLT</span>
                            </a>
                        </li>
						
                        <li'.(($sub_menu=="compose" || $sub_menu=="mailbox" || $sub_menu=="setting") ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-envelope"></i> <span>Email</span>
				'.(($sum_mailbox == "0") ? '<i class="fa fa-angle-left pull-right"></i>' : '<small class="label pull-right label-primary">'.$sum_mailbox.'</small>').'
                                
                                
                            </a>
			    <ul class="treeview-menu">
                                <li'.(($sub_menu=="compose") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/compose_email.php"><i class="fa fa-angle-double-right"></i> Compose</a></li>
                                <li'.(($sub_menu=="mailbox") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/mailbox.php"><i class="fa fa-angle-double-right"></i> Inbox<span class="label label-primary pull-right">'.$sum_mailbox.'</span></a></li>
                                <li'.(($sub_menu=="setting") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/setting_email.php"><i class="fa fa-angle-double-right"></i> Setting Email</a></li>
                            </ul>
                        </li>
                        <li'.(($sub_menu=="Bali" || $sub_menu=="Balikpapan" || $sub_menu=="Samarinda" || $sub_menu=="Malang") ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa  fa-comment"></i> <span>Chat</span>
				<i class="fa fa-angle-left pull-right"></i>
                            </a>
			    <ul class="treeview-menu">
                                <li'.(($sub_menu=="Bali") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/chat.php"><i class="fa fa-angle-double-right"></i> Bali</a></li>
                                <li'.(($sub_menu=="Balikpapan") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/chat.php?locate=bpn"><i class="fa fa-angle-double-right"></i> Balikpapan</a></li>
                                <li'.(($sub_menu=="Malang") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/chat.php?locate=mlg"><i class="fa fa-angle-double-right"></i> Malang</a></li>
								<li'.(($sub_menu=="Samarinda") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/chat.php?locate=smd"><i class="fa fa-angle-double-right"></i> Samarinda</a></li>				
                            </ul>
                        </li>
						<li'.(($sub_menu=="customer_voip" || $sub_menu=="call_history")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-list-alt"></i> <span>VOIP</span>
				<i class="fa fa-angle-left pull-right"></i>
                            </a>
			    <ul class="treeview-menu">
                                <li'.(($sub_menu=="customer_voip") ? ' class="active"' : '').'><a href="'.URL_CSO.'voip/customer_balance"><i class="fa fa-angle-double-right"></i> Customer Balance</a></li>
								<li'.(($sub_menu=="callhistory") ? ' class="active"' : '').'><a href="'.URL_CSO.'voip/callhistory"><i class="fa fa-angle-double-right"></i> Call history</a></li>
                                
                            </ul>
                        </li>
                        <li'.(($sub_menu=="newsletter_add" || $sub_menu=="newsletter_list")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-list-alt"></i> <span>Newsletter</span>
				<i class="fa fa-angle-left pull-right"></i>
                            </a>
			    <ul class="treeview-menu">
                                <li'.(($sub_menu=="newsletter_add") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/newsletter"><i class="fa fa-angle-double-right"></i> Add Newsletter</a></li>
                                <li'.(($sub_menu=="newsletter_list") ? ' class="active"' : '').'><a href="'.URL_CSO.'helpdesk/list_newsletter"><i class="fa fa-angle-double-right"></i> List Newsletter</a></li>				
                            </ul>
                        </li>
						<li>
                            <a href="https://web.whatsapp.com/" target="_blank">
                                <i class="fa fa-phone-square"></i> <span>Whatsapp Web</span>
                            </a>
                        </li>
                        <!--<li'.(($sub_menu=="summary") ? ' class="active"' : '').'>
                            <a href="'.URL_CSO.'helpdesk/administrasi.php">
                                <i class="fa fa-dashboard"></i> <span>Summary</span>
                            </a>
                        </li>-->
                    </ul>';
    
    //<li'.(($sub_menu=="inet_limiter") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'data/setting_limiter.php"><i class="fa fa-angle-double-right"></i> Setting Limiter</a></li>
    $title = ($title != "") ? "Panel Customer (beta) - $title" : "Panel Customer (beta)";

    
    
    
    $template ='<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>'.$title.'</title>
        
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="icon" type="image/x-icon" href="'.URL.'img/favicon.ico" sizes="16x16" />

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
	
    </head>
    <body class="skin-black">
	        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="'.URL_CSO.'home.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img alt="Logo" src="'.URL.'img/logo20.png"/> &nbsp;
                <span>SBN</span></a>
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
                        '.Email_notification().'
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
                                <li class="user-header bg-light-blue">';
								if($row_profile['pic_profile'] != ""){
									$template .='<img src="'.URL_ADMIN.'img/staff/'.$row_profile['pic_profile'].'" class="img-circle" alt="User Image" />';
								}else{
									$template .='<img src="'.URL.'img/avatar5.png" class="img-circle" alt="User Image" />';
								}
								$template .='
                                    
                                    <p>
                                        '.$user.'
                                        
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="'.URL_CSO.'profile.php" class="btn btn-default btn-flat">Profile</a>
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
            <aside class="right-side">
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
//confirm message for logout.
function logout() {
    if (confirm("Anda yakin untuk keluar ?")) {';
	
            $template .='window.location.href = "'.URL_CSO.'logout.php";';
       
        
        
$template .='
    }
}
//open popup window
function valideopenerform(url,title){
	var popy= window.open(url,title,"toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
	if (window.focus) {popy.focus()}
	return false;
    }
</script>
<!-- Growl Notification -->
<script src="'.URL.'js/plugins/growl/jquery.bootstrap-growl.js"></script>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({ cache: false }); 
        setInterval(function() {
            $(\'#notification\').load(\''.URL_ADMIN.'ajax/notif.php\');
        }, 20000); 
    });
    
</script>
</body>
</html>';



return $template;

}


function cso_theme_popup($title="",$content="",$plugins="",$user="",$sub_menu="",$group=""){
    
    $title = ($title != "") ? "Panel Administrator (beta) - $title" : "Panel Administrator (beta) ";
    $sidebar = '';
    $template ='<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>'.$title.'</title>
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
            <a href="'.URL_ADMIN.'home.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img alt="Logo" src="'.URL.'img/logo20.png"/> &nbsp;
                <span>SBN</span></a>
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
                                    <img src="'.URL.'img/avatar5.png" class="img-circle" alt="User Image" />
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
	   
       window.location.href = "'.URL_ADMIN.'logout.php";
    }
}
//open popup window
function valideopenerform(url,title){
	var popy= window.open(url,title,"toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
	if (window.focus) {popy.focus()}
	return false;
    }
</script>

<!-- Growl Notification -->
<script src="'.URL.'js/plugins/growl/jquery.bootstrap-growl.js"></script>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({ cache: false }); 
        setInterval(function() {
            $(\'#notification\').load(\''.URL.'ajax/notif.php\');
        }, 20000); 
    });
    
</script>

</body>
</html>';

/*
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
