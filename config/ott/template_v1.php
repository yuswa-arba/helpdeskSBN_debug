<?php
/*
 * Theme Name: Software Globalxtreme ver. 1.0
 * Website: http://192.168.182.10/software/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 1.0  | 8 Agustus 2014
 * Email:
 * Theme for http://192.168.182.10/software/beta/
 */


function ott_theme($title="",$content="",$plugins="",$user="",$sub_menu="",$group=""){

//END Statistik week
    
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
                            <a href="'.URL_OTT.'home.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li'.(($sub_menu=="profile")
                       ? ' class="active"' : '').'>
                            <a href="'.URL_OTT.'profile.php">
                                <i class="fa fa-user"></i> <span>Profile</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Billing</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="master_paket") ? ' class="active"' : '').'><a href="'.URL_OTT.'paket.php"><i class="fa fa-angle-double-right"></i> Paket</a></li>
                                <li'.(($sub_menu=="user") ? ' class="active"' : '').'><a href="'.URL_OTT.'user"><i class="fa fa-angle-double-right"></i> STB User</a></li>
                                <li'.(($sub_menu=="log") ? ' class="active"' : '').'><a href="'.URL_OTT.'log"><i class="fa fa-angle-double-right"></i> Log</a></li>
                                
                            </ul>
                        </li>
                        <li>
                            <a href="'.URL_OTT.'live/channel">
                                <i class="fa fa-gear"></i> <span>LIVE</span>
                            </a>
                            
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>VOD</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="movie_type") ? ' class="active"' : '').'><a href="'.URL_OTT.'vod/type.php"><i class="fa fa-angle-double-right"></i> Movie Type</a></li>
                                <li'.(($sub_menu=="movie_category") ? ' class="active"' : '').'><a href="'.URL_OTT.'vod/category.php"><i class="fa fa-angle-double-right"></i> Movie Kategori</a></li>
                                <li'.(($sub_menu=="movie") ? ' class="active"' : '').'><a href="'.URL_OTT.'vod/movie"><i class="fa fa-angle-double-right"></i> Movie</a></li>
                                
                            </ul>
                        </li>
                        
                        <li'.(($sub_menu=="system_user" || $sub_menu=="logs")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-gear"></i> <span>System</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            
                        </li>
                        
                        
                    </ul>';
                    
    
    //<li'.(($sub_menu=="inet_limiter") ? ' class="active"' : '').'><a href="'.URL_OTT.'data/setting_limiter.php"><i class="fa fa-angle-double-right"></i> Setting Limiter</a></li>
    $title = ($title != "") ? "Panel Customer (beta) - $title" : "Panel Customer (beta)";

    
    //MailBox
    //$sql_mailbox    = mysql_query("SELECT * FROM `gx_email` WHERE `kategori` = '' ORDER BY `DateE` DESC");
    //$sum_mailbox    = mysql_num_rows($sql_mailbox);
    
    $template ='<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
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
            <a href="'.URL_OTT.'home.php" class="logo">
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
	if($group == "admin")
        {
            $template .='window.location.href = "'.URL_OTT.'logout.php";';
        }elseif($group == "cso")
        {
            $template .='window.location.href = "'.URL_CSO.'logout.php";';
        }
        
        
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

</body>
</html>';



return $template;

}

function Email_notification()
{
    
    global $conn;
    
    $sql_email    = mysql_query("SELECT `customer_number`, `Subject`, `DateE`, `EmailFromP` FROM `gx_email` ORDER BY `DateE` DESC LIMIT 0,10;", $conn);
    $total_email  = mysql_num_rows($sql_email);
    
    
    $mail_notification = '<!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">'.$total_email.'</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have '.$total_email.' messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">';
    while($row_email = mysql_fetch_array($sql_email))
    {
        if($row_email["customer_number"] != "")
        {
            $customer_number = $row_email["customer_number"];
            $sql_customer    = mysql_query("SELECT `cNama` FROM `tbCustomer` WHERE `cKode` = '".$customer_number."' LIMIT 0,1;", $conn);
            $row_customer    = mysql_fetch_array($sql_customer);
            
        }
        
        $mail_notification .= '<li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="'.URL.'img/avatar.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    '.(($row_email["customer_number"] != "") ? $row_customer["cNama"] : $row_email["EmailFromP"] ).'
                                                    <small><i class="fa fa-clock-o"></i>'.(date("H:i", strtotime($row_email["DateE"]))).'</small>
                                                </h4>
                                                <p>'.substr($row_email["Subject"], 0, 20).' ...</p>
                                            </a>
                                        </li><!-- end message -->';
    }
    
$mail_notification .='
                                    </ul>
                                </li>
                                <li class="footer"><a href="'.URL.'/helpdesk/mailbox.php">See All Messages</a></li>
                            </ul>
                        </li>';
                        
    return $mail_notification;
}