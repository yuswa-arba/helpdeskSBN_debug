<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 22 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */


function bootstrap_theme3($title="",$content="",$plugins="",$user="",$sub_menu="",$group=""){
    
    
    //Statistik Complaint
    $stat_complaint = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%';"));
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


//END Statistik week
    
    
    $menu_list = '
		<li class="ic-dashboard"><a href="home.php"><span>Dashboard</span></a> 
		    <!--<ul>
                        <li><a href="#">Sub 1</a> </li>
                        <li><a href="#">Sub 2</a> </li>
                    </ul>-->
                </li>
		<li class="ic-grid-tables"><a href="incoming.php?type=complaint"><span>Complaint</span></a>
		    
                </li>
                <li class="ic-form-style"><a href="report.php?type=list_report"><span>Daily Report</span></a>
                   
                </li>
		<li class="ic-charts"><a href="absensi.php"><span>Schedule</span></a>
		    
                </li>
		<li class="ic-gallery dd"><a href="download.php"><span>Download</span></a>
		    
                </li>
		<!--<li class="ic-grid-tables"><a href="#"><span>Piutang</span></a>
		    
                </li>-->
		<li class="ic-form-style"><a href="incoming.php?type=spktech"><span>Maintenance</span></a>
		    
                </li>
                <li class="ic-notifications"><a href="notifikasi.php"><span>Notifications</span></a>
                    
                </li>
		<li class="ic-dashboard"><a href="logs.php?view=table"><span>Logs</span></a> 
		    
                </li>
    
    ';

    
    $sidebar = '<aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">';
    //$sidebar .= '<li'.(($sub_menu=="dashboard") ? ' class="active"' : '';).'><a href="home.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>';
    //$sidebar .= '<li'.(($sub_menu=="widget") ? ' class="active"' : '';).'><a href="pages/widgets.html"><i class="fa fa-th"></i> <span>Widgets</span> <small class="badge pull-right bg-green">new</small></a></li>';
    //Submenu CSO
    $sidebar .= '<li'.(($sub_menu=="dashboard" || $sub_menu=="complaint" || $sub_menu=="administration" || $sub_menu=="staff" || $sub_menu=="absensi" || $sub_menu=="profile" || $sub_menu=="mailbox")
                       ? ' class="treeview active"' : ' class="treeview"').'><a href="#"><i class="fa fa-edit"></i><span>Customer Service</span><i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li'.(($sub_menu=="dashboard") ? ' class="active"' : '').'><a href="home.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
                            <li'.(($sub_menu=="complaint") ? ' class="active"' : '').'><a href="complaint.php"><i class="fa fa-edit"></i> Complaint</a></li>
			    <li'.(($sub_menu=="administration") ? ' class="active"' : '').'><a href="administration.php"><i class="fa fa-edit"></i> Administration</a></li>
			    <li'.(($sub_menu=="absensi") ? ' class="active"' : '').'><a href="absensi.php"><i class="fa fa-edit"></i> Absensi</a></li>
			    <li'.(($sub_menu=="staff") ? ' class="active"' : '').'><a href="staff.php"><i class="glyphicon glyphicon-user"></i> Staff</a></li>
			    <li'.(($sub_menu=="profile") ? ' class="active"' : '').'><a href="profile.php"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
			    <li'.(($sub_menu=="mailbox") ? ' class="active"' : '').'><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                        </ul>
                    </li>';
    //Submenu MKT
    $sidebar .= '<li'.(($sub_menu=="dashboard_mkt" || $sub_menu=="prospek" || $sub_menu=="nonprospek" || $sub_menu=="spk_mkt" || $sub_menu=="profile_mkt") ?' class="treeview active"' : ' class="treeview"').'><a href="#"><i class="fa fa-edit"></i><span>Marketing</span><i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li'.(($sub_menu=="dashboard_mkt") ? ' class="active"' : '').'><a href="home.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
                            <li'.(($sub_menu=="prospek") ? ' class="active"' : '').'><a href="list_prospek.php"><i class="fa fa-edit"></i> List Prospek</a></li>
			    <li'.(($sub_menu=="nonprospek") ? ' class="active"' : '').'><a href="list_nonprospek.php"><i class="fa fa-edit"></i> List Non Prospek</a></li>
			    <li'.(($sub_menu=="spk_mkt") ? ' class="active"' : '').'><a href="spk_mkt.php"><i class="fa fa-edit"></i> SPK Marketing</a></li>
			    <li'.(($sub_menu=="profile_mkt") ? ' class="active"' : '').'><a href="profile.php"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
                        </ul>
                    </li>';
    //submenu technician
    $sidebar .= '<li'.(($sub_menu=="dashboard_tech" || $sub_menu=="profile_tech" || $sub_menu=="spk_tech") ?' class="treeview active"' : ' class="treeview"').'><a href="#"><i class="fa fa-edit"></i><span>Technician</span><i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li'.(($sub_menu=="dashboard_tech") ? ' class="active"' : '').'><a href="home.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
                            <li'.(($sub_menu=="spk_tech") ? ' class="active"' : '').'><a href="spk_tech.php"><i class="fa fa-edit"></i> SPK Technician</a></li>
			    <li'.(($sub_menu=="profile_tech") ? ' class="active"' : '').'><a href="profile.php"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
                        </ul>
                    </li>';
    //submenu Research
    $sidebar .= '<li'.(($sub_menu=="agenda" || $sub_menu=="profile_rd") ?' class="treeview active"' : ' class="treeview"').'><a href="#"><i class="fa fa-edit"></i><span>Research</span><i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li'.(($sub_menu=="agenda") ? ' class="active"' : '').'><a href="agenda.php"><i class="fa fa-edit"></i> Agenda</a></li>
			    <li'.(($sub_menu=="profile_rd") ? ' class="active"' : '').'><a href="profile.php"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
                        </ul>
                    </li>';
		    
    //$sidebar .= '<li'.(($sub_menu=="dashboard") ? ' class="active"' : '').'><a href="home.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>';
    //$sidebar .= '<li'.(($sub_menu=="dashboard") ? ' class="active"' : '').'><a href="home.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>';
    
        $sidebar .= '</ul>
                </section>
                <!-- /.sidebar -->
            </aside>';
    
    
	
	$riset	 	  = ($sub_menu=="Dashboard Riset") ? '<li class="displayactive"><a href="agenda.php">Agenda</a> </li>' : '<li ><a href="agenda.php">Agenda</a> </li>';
	$riset	 	 .= ($sub_menu=="Dashboard Riset") ? '<li class="displayactive"><a href="#">Profile</a> </li>' : '<li ><a href="#">Profile</a> </li>';
	
	
    
    $title = ($title != "") ? "Helpdesk Bali (beta) - $title" : "Helpdesk Bali (beta)";

    
    //MailBox
    $sql_mailbox    = mysql_query("SELECT * FROM `gx_email` WHERE `kategori` = '' ORDER BY `DateE` DESC");
    $sum_mailbox    = mysql_num_rows($sql_mailbox);

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
        <!-- Morris chart -->
        <link href="'.URL.'css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="'.URL.'css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="'.URL.'css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="'.URL.'css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="'.URL.'css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
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
                Globalxtreme Helpdesk
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
                                                    <img src="img/default_avatar.png" class="img-circle" alt="User Image"/>
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
                                <li class="footer"><a href="mailbox.php">See All Messages</a></li>
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
                                <span class="label label-success">9</span>
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
                                <span>'.ucfirst($user).' <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="'.URL.'img/avatar5.png" class="img-circle" alt="User Image" />
                                    <p>
                                        '.ucfirst($user).'
                                        <small></small>
                                    </p>
                                </li>
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="javascript:logout();" class="btn btn-default btn-flat">Sign out</a>
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
//confirm message for logout.
function logout() {
    if (confirm("Anda yakin untuk keluar ?")) {
	   
       window.location.href = "logout.php";
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
            $(\'#notification\').load(\'ajax/notif.php\');
        }, 20000); 
    });
    
</script>
</body>
</html>';



return $template;

}


function bootstrap_theme3_popup($title="",$content="",$plugins="",$user="",$sub_menu="",$group=""){
    
    $title = ($title != "") ? "Helpdesk Bali (beta) - $title" : "Helpdesk Bali (beta)";

    //MailBox
    $sql_mailbox    = mysql_query("SELECT * FROM `gx_email` WHERE `kategori` = '' ORDER BY `DateE` DESC");
    $sum_mailbox    = mysql_num_rows($sql_mailbox);
    
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
        <!-- Morris chart -->
        <link href="'.URL.'css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="'.URL.'css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="'.URL.'css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="'.URL.'css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="'.URL.'css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
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
                Globalxtreme Helpdesk
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>'.ucfirst($user).' <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        '.ucfirst($user).' 
                                        <small></small>
                                    </p>
                                </li>
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="javascript:logout();" class="btn btn-default btn-flat">Sign out</a>
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
	   
       window.location.href = "logout.php";
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
            $(\'#notification\').load(\'ajax/notif.php\');
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