<?php
/*
 * Theme Name: Software Globalxtreme ver. 1.0
 * Website: http://192.168.182.10/software/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 1.0  | 8 Agustus 2014
 * Email:
 * Theme for http://192.168.182.10/software/beta/
 */

function global_menu_sidebar($user_explode, $sub_menu, $id_group)
{
    global $conn;
    
    $sidebar_db ='<!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="'.URL.'img/avatar5.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, '.$user_explode.'</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <div id="menu">
                    <div class="sidebar-form">
                        <div class="input-group">
                                <input type="text" class="search form-control" placeholder="Search" />
                                <span class="input-group-btn">
                                    <button data-sort="name" class="sort btn btn-flat"><i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </div>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="list sidebar-menu ">';
                    
    $sql_menu 	= mysql_query("SELECT * FROM `v_menu` WHERE `level` = '0' AND `id_parent` = '0' AND `group_nama` = '".$id_group."' ORDER BY `order_number` ASC ;", $conn);
    
    $no = 1;
    while ($row_menu = mysql_fetch_array($sql_menu))
    {
        $sql_submenu 	= mysql_query("SELECT * FROM `v_menu` WHERE `level` = '0' AND `id_parent` = '".$row_menu["id_menu"]."' ORDER BY `order_number` ASC ;", $conn);
        $count_submenu  = mysql_num_rows($sql_submenu);
        
        if($count_submenu == 0)
        {
            $sidebar_db .='<li '.(($sub_menu == $row_menu["menu"] ) ? ' class="active"' : '').'>
                        <a   href="'.URL_ADMIN.$row_menu["file"].'">
                            <i class="'.$row_menu["icon"].'"></i> <span class="name">'.$row_menu["alias"].'</span>
                        </a>
                    </li>';
        }
        else
        {
            $sidebar_db .= '<li '.(($sub_menu == $row_menu["menu"] ) ? ' class="treeview active"' : ' class="treeview"').'>
                        <a href="">
                            <i class="'.$row_menu["icon"].'"></i> <span class="name" >'.$row_menu["alias"].'</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>';
                        
            $sidebar_db .= '<ul class=" subname treeview-menu">';
            
            while($row_submenu = mysql_fetch_array($sql_submenu))
            {
                $sidebar_db .='<li'.(($sub_menu == $row_submenu["menu"]) ? ' class="active"' : '').'>
                <a  href="'.URL_ADMIN.$row_submenu["file"].'">
                <i class="fa fa-angle-double-right"></i> <span  class=""> '.trim($row_submenu["alias"]).'</span></a></li>';
                //<i class="'.$row_submenu["icon"].'"></i>
            }
            $sidebar_db .= '</ul>
                </li>';
        }
        
    }
    
    $sidebar_db .='</ul>
    </div>';
    
    return $sidebar_db;
}


function global_theme($title="",$content="",$plugins="",$user="",$sub_menu="",$group="")
{
    
    $user_explode = explode(' ', $user);
    $sidebar_db = global_menu_sidebar($user_explode[0], $sub_menu, $group);
                    
    $sidebar_db = '<!-- Sidebar user panel -->
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
                    <div id="menu">
                    <div class="sidebar-form">
                        <div class="input-group">
                                <input type="text" class="search form-control" placeholder="Search" />
                                <span class="input-group-btn">
                                    <button data-sort="name" class="sort btn btn-flat"><i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </div>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="list sidebar-menu "><li class="active">
                        <a href="/software/beta/na/home.php">
                            <i class="fa fa-dashboard"></i> <span class="name">Dashboard</span>
                        </a>
                    </li><li>
                        <a href="/software/beta/na/profile.php">
                            <i class="fa fa-user"></i> <span class="name">Profile</span>
                        </a>
                    </li><li class="treeview">
                        <a href="">
                            <i class="fa fa-bar-chart-o"></i> <span class="name">Internet/Data</span>
                            <i class="fa pull-right fa-angle-left"></i>
                        </a><ul class=" subname treeview-menu" style="display: none;">
                        <li>
                <a href="/software/beta/na/data/monitoring_onu.php" style="margin-left: 10px;">
                <i class="fa fa-angle-double-right"></i> <span class=""> Monitoring ONU</span></a></li>
                <li>
                <a href="/software/beta/na/data/monitoring_olt.php" style="margin-left: 10px;">
                <i class="fa fa-angle-double-right"></i> <span class=""> Monitoring OLT</span></a></li>
                
                <li>
                <a href="/software/beta/na/data/list_olt_customer.php" style="margin-left: 10px;">
                <i class="fa fa-angle-double-right"></i> <span class=""> List OLT Customer</span></a></li>
                </ul>
                </li></ul>
                
                </div>';
    //<li'.(($sub_menu=="inet_limiter") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'data/setting_limiter.php"><i class="fa fa-angle-double-right"></i> Setting Limiter</a></li>
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
            <a href="'.URL_ADMIN.'home.php" class="logo">
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
                                        <a href="javascript: logoutGlobal();" class="btn btn-default btn-flat">Sign out</a>
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
                    '.$sidebar_db.'
                    
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
        
        <!-- JS list Search menu -->
        <script src="'.URL.'js/list.min.js" type="text/javascript"></script>
<script language="javascript">
//jslist
var options = {
    valueNames: [ \'name\', \'subname\' ]
};

var userList = new List(\'menu\', options);
</script>

	'.$plugins.'

<script language="javascript">
//confirm message for logout.
function logoutGlobal() {
    if (confirm("Anda yakin untuk keluar ?")) {
           window.location.href = "/software/beta/na/logout.php";
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


function global_theme_popup($title="",$content="",$plugins="",$user="",$sub_menu="",$group="")
{
    
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
function logoutGlobal() {
    if (confirm("Anda yakin untuk keluar ?")) {
           window.location.href = "/software/beta/na/logout.php";
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

return $template;

}
