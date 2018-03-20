<?php
/*
 * Theme Name: Software Globalxtreme ver. 1.0
 * Website: http://192.168.182.10/software/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 1.0  | 8 Agustus 2014
 * Email:
 * Theme for http://192.168.182.10/software/beta/
 */


function hrd_theme($title="",$content="",$plugins="",$user="",$sub_menu="",$group="",$id_bagian="")
{
    
    $user_explode = explode(' ', $user);
    
        $sidebar ='<!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="'.URL.'img/avatar5.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, '.$user_explode[0].'</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type="submit" name="seach" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li'.(($sub_menu=="dashboard") ? ' class="active"' : '').'>
                            <a href="'.URL_STAFF.'home.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li'.(($sub_menu=="profile")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'profile.php">
                                <i class="fa fa-user"></i> <span>Profile</span>
                            </a>
                        </li>';
                        
                        
                            
                        $marketing ='
                        
                        <li'.(($sub_menu=="prospek")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'marketing/list_prospek.php">
                                <i class="fa fa-table"></i> <span>Prospek</span>
                            </a>
                        </li>
                        
                        <li'.(($sub_menu=="spk" || $sub_menu=="helpdesk_spkmkt")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'marketing/spk_survey.php">
                                <i class="fa fa-table"></i> <span>SPK Survey</span>
                            </a>
                        </li>
                        
                        <li'.(($sub_menu=="jawab_survey")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'marketing/list_jawab_survey.php">
                                <i class="fa fa-table"></i> <span>Jawab SPK Survey</span>
                            </a>
                        </li>
                        
                        <li'.(($sub_menu=="penawaran")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'marketing/master_penawaran.php">
                                <i class="fa fa-table"></i> <span>Penawaran</span>
                            </a>
                        </li>
                        
                        <li'.(($sub_menu=="proposal")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'marketing/proposal/master_proposal.php">
                                <i class="fa fa-table"></i> <span>Proposal</span>
                            </a>
                        </li>
                        
                        <li'.(($sub_menu=="reproposal")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'marketing/reproposal/master_reproposal.php">
                                <i class="fa fa-table"></i> <span>Re Proposal</span>
                            </a>
                        </li>
                        
                        <li'.(($sub_menu=="reproposal_kabag")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'marketing/reproposal/master_reproposal_kabag.php">
                                <i class="fa fa-table"></i> <span>Re Proposal Kabag</span>
                            </a>
                        </li>
                        
                        <li'.(($sub_menu=="jawab_proposal")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'marketing/reproposal/master_jawab_proposal.php">
                                <i class="fa fa-table"></i> <span>Jawab Proposal</span>
                            </a>
                        </li>
                        
                        
                         <li'.(($sub_menu=="Permohonan_justifikasi")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'marketing/list_permohonan_justifikasi.php">
                                <i class="fa fa-table"></i> <span>Permohonan Justifikasi</span>
                            </a>
                        </li>
                        
                        <li'.(($sub_menu=="service_plan")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'marketing/service_plan.php">
                                <i class="fa fa-table"></i> <span>Service Plan</span>
                            </a>
                        </li>
                        
                        <li'.(($sub_menu=="brosur")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'marketing/brosur.php">
                                <i class="fa fa-table"></i> <span>Brosur</span>
                            </a>
                        </li>
                        
                        <li'.(($sub_menu=="cetak_formulir")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'marketing/cetak_formulir.php">
                                <i class="fa fa-table"></i> <span>Cetak Formulir</span>
                            </a>
                        </li>';
                        
                        $marketing_sementara = '<li'.(($sub_menu=="master_formulir")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'marketing/master_formulir.php">
                                <i class="fa fa-table"></i> <span>Master Formulir</span>
                            </a>
                        </li>
                        
                        <li'.(($sub_menu=="cetak_formulir")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'marketing/cetak_formulir.php">
                                <i class="fa fa-table"></i> <span>Cetak Formulir</span>
                            </a>
                        </li>
                        
                        <li'.(($sub_menu=="list_formulir")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'marketing/list_formulir.php">
                                <i class="fa fa-table"></i> <span>List Formulir Cetak</span>
                            </a>
                        </li>';
                        
                    
                            
                        $teknisi ='<li'.(($sub_menu=="spk_pasang")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'teknisi/list_spk_pasang.php">
                                <i class="fa fa-table"></i> <span>SPK Pasang</span>
                            </a>
                        </li>
                        
                        <li'.(($sub_menu=="spk_aktivasi_konversi")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'teknisi/list_spk_aktivasi_konversi.php">
                                <i class="fa fa-table"></i> <span>SPK Aktivasi Konversi</span>
                            </a>
                        </li>
                        
                        <li'.(($sub_menu=="spk_aktivasi")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'teknisi/spk_aktivasi.php">
                                <i class="fa fa-table"></i> <span>SPK Aktivasi</span>
                            </a>
                        </li>
                        
                         <li'.(($sub_menu=="spk_bongkar")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'teknisi/list_spk_bongkar.php">
                                <i class="fa fa-table"></i> <span>SPK Bongkar</span>
                            </a>
                        </li>
                        
                        <li'.(($sub_menu=="maintenance")
                       ? ' class="active"' : ' class=""').'>
                            <a href="'.URL_STAFF.'teknisi/list_maintenance.php">
                                <i class="fa fa-table"></i> <span>Maintenance</span>
                            </a>
                        </li>';
                    
                        $sidebar .='
                        '.(($id_bagian=="Marketing") ? $marketing_sementara : '').'
                        '.(($id_bagian=="Teknisi") ? $teknisi : '').'
                        <li>
                            <a href="https://web.whatsapp.com/" target="_blank">
                                <i class="fa fa-phone-square"></i> <span>Whatsapp Web</span>
                            </a>
                        </li>
                        <!--<li'.(($sub_menu=="newsletter_add" || $sub_menu=="newsletter_list")
                       ? ' class="active"' : ' class=""').'>
                            <a href="#">
                                <i class="fa fa-list-alt"></i> <span>Newsletter</span>
				<i class="fa fa-angle-left pull-right"></i>
                            </a>
			    <ul class="-menu">
                                <li'.(($sub_menu=="newsletter_add") ? ' class="active"' : '').'><a href="'.URL_STAFF.'helpdesk/newsletter"><i class="fa fa-angle-double-right"></i> Add Newsletter</a></li>
                                <li'.(($sub_menu=="newsletter_list") ? ' class="active"' : '').'><a href="'.URL_STAFF.'helpdesk/list_newsletter"><i class="fa fa-angle-double-right"></i> List Newsletter</a></li>				
                            </ul>
                        </li>-->
                        
                    </ul>';
    
    //<li'.(($sub_menu=="inet_limiter") ? ' class="active"' : '').'><a href="'.URL_STAFF.'data/setting_limiter.php"><i class="fa fa-angle-double-right"></i> Setting Limiter</a></li>
    $title = ($title != "") ? "Panel Customer (beta) - $title" : "Panel Customer (beta)";

    
    //MailBox
    //$sql_mailbox    = mysql_query("SELECT * FROM `gx_email` WHERE `kategori` = '' ORDER BY `DateE` DESC");
    //$sum_mailbox    = mysql_num_rows($sql_mailbox);
    
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
            <a href="'.URL_STAFF.'home.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img alt="Logo" src="'.URL.'img/logo20.png"/> &nbsp;
                <span>GlobalXtreme</span></a>
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
	
            $template .='window.location.href = "'.URL_STAFF.'logout.php";';
        
        
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
            $(\'#notification\').load(\''.URL_STAFF.'ajax/notif.php\');
        }, 20000); 
    });
    
</script>
</body>
</html>';



return $template;

}


function staff_theme_popup($title="",$content="",$plugins="",$user="",$sub_menu="",$group=""){
    
    $title = ($title != "") ? "Panel Administrator (beta) - $title" : "Panel Administrator (beta) ";
    $sidebar = '';
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
            <a href="'.URL_STAFF.'home.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img alt="Logo" src="'.URL.'img/logo20.png"/> &nbsp;
                <span>GlobalXtreme</span></a>
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
	   
       window.location.href = "'.URL_STAFF.'logout.php";
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
