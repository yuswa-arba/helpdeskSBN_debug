<?php
/*
 * Theme Name: Software Globalxtreme ver. 2.0 (Admin LTE 2.2.3)
 * Website: https://172.16.79.194/software/beta/admin/
 * Author: Team Research GlobalXtreme.net
 * Version: 2.0  | 2 Juni 2016
 * Email:
 * Theme for https://172.16.79.194/software/beta/admin/
 */

function menu_sidebar($user, $sub_menu, $id_group)
{
    global $conn;
    $sidebar_db = '
        <aside class="main-sidebar">
        
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
            
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="' . URL . '/assets/adminlte2/dist/img/avatar5.png" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>' . $user . '</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                
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
                    <ul class="sidebar-menu list">';

    $sql_menu = mysql_query("SELECT * FROM `v_menu` WHERE `level` = '0' AND `id_parent` = '0' AND `group_nama` = '" . $id_group . "' ORDER BY `order_number` ASC;", $conn);

    $no_tidak_tampil[] = array(21, 27);

    $no = 1;
    while ($row_menu = mysql_fetch_array($sql_menu)) {
        $sql_submenu = mysql_query("SELECT * FROM `v_menu` WHERE `level` = '0' AND `group_nama` = '" . $id_group . "' AND `id_parent` = '" . $row_menu["id_menu"] . "' ORDER BY `order_number` ASC, `alias` ASC ;", $conn);
        $count_submenu = mysql_num_rows($sql_submenu);

        if ($row_menu['id_menu'] != $no_tidak_tampil && $row_menu['id_parent'] != 21 && $row_menu['id_menu'] != 27 && $row_menu['id_parent'] != 27) {

            if ($count_submenu == 0) {
                $sidebar_db .= '
                        <li ' . (($sub_menu == $row_menu["menu"]) ? ' class="active"' : 's') . '>
                            <a   href="' . URL_ADMIN . $row_menu["file"] . '">
                                <i class="' . $row_menu["icon"] . '"></i> <span class="name">' . $row_menu["alias"] . '</span>
                            </a>
                        </li>';
            } else {
                $sidebar_db .= '
                        <li ' . (($sub_menu == $row_menu["menu"]) ? ' class="treeview active"' : ' class="treeview"') . '>
                            <a href="">
                                <i class="' . $row_menu["icon"] . '"></i> <span class="name" >' . $row_menu["alias"] . '</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>';

                $sidebar_db .= '<ul class="treeview-menu list2">';

                while ($row_submenu = mysql_fetch_array($sql_submenu)) {
                    $sidebar_db .= '
                                <li' . (($sub_menu == $row_submenu["menu"]) ? ' class="active"' : '') . '>
                                    <a  href="' . URL_ADMIN . $row_submenu["file"] . '">
                                        <i class="fa fa-angle-double-right"></i> <span  class=""> ' . trim($row_submenu["alias"]) . '</span>
                                    </a>
                                </li>';
                    //<i class="'.$row_submenu["icon"].'"></i>
                }
                $sidebar_db .= '
                            </ul>
                        </li>';
            }
        }
    }

    $sidebar_db .= '
                    </ul>
                </div>        
            </section>
        <!-- /.sidebar -->
        </aside>';

    return $sidebar_db;
}

function admin_theme($title = "", $content = "", $plugins = "", $user = "", $sub_menu = "", $group = "", $cabang = NULL)
{
    $title = ($title != "") ? "$title" : "";
    $cabang = (!empty($cabang)) ? $cabang : "";
    $menubar = menu_sidebar($user, $sub_menu, $group);
    $template = '
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SBN Helpdesk beta 2.0 | ' . $title . '</title>
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/x-icon" href="' . URL . 'img/favicon.ico" sizes="16x16" />
   
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="' . URL . 'assets/adminlte2/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="' . URL . 'assets/adminlte2/plugins/font-awesome-4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="' . URL . 'assets/adminlte2/plugins/ionicons-2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="' . URL . 'assets/adminlte2/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="' . URL . 'assets/adminlte2/plugins/iCheck/all.css">
        
    <!-- Theme style -->
    <link rel="stylesheet" href="' . URL . 'assets/adminlte2/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="' . URL . 'assets/adminlte2/dist/css/skins/_all-skins.min.css">
  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="sidebar-mini skin-blue-light">
    <div class="wrapper">
	
	  <header class="main-header">

        <!-- Logo -->
        <a href="' . URL_ADMIN . 'home" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>GX</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SBN</b>Helpdesk</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
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
                            <img src="' . URL . '/assets/adminlte2/dist/img/avatar5.png" class="img-circle" alt="User Image">
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
                            <img src="' . URL . '/assets/adminlte2/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
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
                            <img src="' . URL . '/assets/adminlte2/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
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
                            <img src="' . URL . '/assets/adminlte2/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
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
                            <img src="' . URL . '/assets/adminlte2/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
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
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-red"></i> 5 new members joined
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-user text-red"></i> You changed your username
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
                  <i class="fa fa-flag-o"></i>
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
                  <img src="' . URL . '/assets/adminlte2/dist/img/avatar5.png" class="user-image" alt="User Image">
                  <span class="hidden-xs">' . $user . '</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="' . URL . '/assets/adminlte2/dist/img/avatar5.png" class="img-circle" alt="User Image">
                    <p>
                      ' . $user . '
                      <small>' . $cabang . '</small>
                    </p>
                  </li>
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
      
    ' . $menubar . '
    
		<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            ' . $title . '
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="' . URL_ADMIN . 'home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">' . $title . '</li>
        </ol>
    </section>
		' . $content . '
       
	  </div><!-- /.content-wrapper -->
	  <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2016 <a href="http://globalxtreme.net">GlobalXtreme Research Team</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="' . URL . 'assets/adminlte2/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="' . URL . 'assets/adminlte2/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- Select2 -->
    <script src="' . URL . 'assets/adminlte2/plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="' . URL . 'assets/adminlte2/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="' . URL . 'assets/adminlte2/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="' . URL . 'assets/adminlte2/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="' . URL . 'assets/adminlte2/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="' . URL . 'assets/adminlte2/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="' . URL . 'assets/adminlte2/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="' . URL . 'assets/adminlte2/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="' . URL . 'assets/adminlte2/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="' . URL . 'assets/adminlte2/plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="' . URL . 'assets/adminlte2/plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="' . URL . 'assets/adminlte2/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="' . URL . 'assets/adminlte2/dist/js/demo.js"></script>
    
    <!-- SlimScroll 1.3.0 -->
    <script src="' . URL . 'assets/adminlte2/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    
	<!-- For Search menu -->
	<script src="' . URL . 'assets/adminlte2/plugins/jslist/list.min.js"></script>
	
    <link rel="stylesheet" href="' . URL . 'assets/adminlte2/plugins/datepicker/datepicker3.css">
    <!-- bootstrap datepicker -->
    <script src="' . URL . 'assets/adminlte2/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- InputMask -->
    <script src="' . URL . 'assets/adminlte2/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="' . URL . 'assets/adminlte2/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="' . URL . 'assets/adminlte2/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    
    <script>
    $(function() {
        $("[id=datepicker]").datepicker({format: "dd-mm-yyyy",autoclose: true});
        $("[data-mask]").inputmask();
        //iCheck for checkbox and radio inputs
        $(\'input[type="checkbox"].minimal, input[type="radio"].minimal\').iCheck({
          checkboxClass: \'icheckbox_minimal-blue\',
          radioClass: \'iradio_minimal-blue\'
        });
    });
    </script>

	<script language="javascript">
		//confirm message for logout.
		function logout() {
			if (confirm("Logout ?")) {window.location.href = "' . URL_ADMIN . 'logout.php";
			}
		}
		//open popup window
		function valideopenerform(url,title)
		{
			var popy= window.open(url,title,"toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=600,width=750")
			if (window.focus) {popy.focus()}
			return false;
		}
		
		//jslist
		var options = {
			valueNames: [ \'menu1\', \'menu2\', \'list2\' ]
		};
		
		var userList = new List(\'menu\', options);

    </script>
    ' . $plugins . '
  </body>
</html>';

    return $template;

}

function Email_notification()
{

    global $conn;

    $sql_email = mysql_query("SELECT `customer_number`, `Subject`, `DateE`, `EmailFromP` FROM `gx_email` ORDER BY `DateE` DESC LIMIT 0,10;", $conn);
    $total_email = mysql_num_rows($sql_email);


    $mail_notification = '<!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">' . $total_email . '</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have ' . $total_email . ' messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">';
    while ($row_email = mysql_fetch_array($sql_email)) {
        if ($row_email["customer_number"] != "") {
            $customer_number = $row_email["customer_number"];
            $sql_customer = mysql_query("SELECT `cNama` FROM `tbCustomer` WHERE `cKode` = '" . $customer_number . "' LIMIT 0,1;", $conn);
            $row_customer = mysql_fetch_array($sql_customer);

        }

        $mail_notification .= '
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="' . URL . 'img/avatar.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    ' . (($row_email["customer_number"] != "") ? $row_customer["cNama"] : $row_email["EmailFromP"]) . '
                                                    <small><i class="fa fa-clock-o"></i>' . (date("H:i", strtotime($row_email["DateE"]))) . '</small>
                                                </h4>
                                                <p>' . substr($row_email["Subject"], 0, 20) . ' ...</p>
                                            </a>
                                        </li><!-- end message -->';
    }

    $mail_notification .= '
                                    </ul>
                                </li>
                                <li class="footer"><a href="' . URL . '/helpdesk/mailbox.php">See All Messages</a></li>
                            </ul>
                        </li>';

    return $mail_notification;
}
