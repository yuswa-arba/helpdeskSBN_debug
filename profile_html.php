
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Panel Customer (beta) - Profile</title>
        
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- bootstrap 3.0.2 -->
        <link href="/software/beta/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="/software/beta/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="/software/beta/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="/software/beta/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="/software/beta/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="/software/beta/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="/software/beta/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="/software/beta/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="/software/beta/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="/software/beta/js/html5shiv.js"></script>
          <script src="/software/beta/js/respond.min.js"></script>
        <![endif]-->
	
    </head>
    <body class="skin-blue">
	        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="/software/beta/home.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img alt="GX Panel Customer Logo" src="/software/beta/img/logo20.png"/> &nbsp;
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
                                                    <img src="/software/beta/img/avatar5.png" class="img-circle" alt="User Image"/>
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
                                                    <img src="/software/beta/img/avatar2.png" class="img-circle" alt="user image"/>
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
                                                    <img src="/software/beta/img/avatar.png" class="img-circle" alt="user image"/>
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
                                                    <img src="/software/beta/img/avatar2.png" class="img-circle" alt="user image"/>
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
                                                    <img src="/software/beta/img/avatar.png" class="img-circle" alt="user image"/>
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
                                    <img src="/software/beta/img/avatar5.png" class="img-circle" alt="User Image" />
                                    <p>
                                        Dwi wardiansah
                                        
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-body">
                                    <div class="col-xs-12 text-center">
                                        Saldo Anda Rp. 1.000.000,00
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
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="/software/beta/img/avatar5.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Dwi</p>

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
                        <li>
                            <a href="/software/beta/home.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="/software/beta/profile">
                                <i class="fa fa-user"></i> <span>Profile</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Internet/Data</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/software/beta/data/invoice.php"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li><a href="/software/beta/data/payment.php"><i class="fa fa-angle-double-right"></i> Payment History</a></li>
                                <li><a href="/software/beta/data/paket.php"><i class="fa fa-angle-double-right"></i> Paket</a></li>
                                <!--<li><a href="/software/beta/data/voucher.php"><i class="fa fa-angle-double-right"></i> Voucher</a></li>-->
                                <li><a href="/software/beta/data/mrtg.php"><i class="fa fa-angle-double-right"></i> MRTG</a></li>
                                <li><a href="/software/beta/data/session_history.php"><i class="fa fa-angle-double-right"></i> Session History</a></li>
                                <li><a href="/software/beta/complaint/complaint.php"><i class="fa fa-angle-double-right"></i> Complaint</a></li>
                                
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-phone-square"></i>
                                <span>Voip</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/software/beta/voip/list_invoice.php"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                
                                <li><a href="/software/beta/voip/call_history.php"><i class="fa fa-angle-double-right"></i> Call History</a></li>
                                <li><a href="/software/beta/voip/voucher.php"><i class="fa fa-angle-double-right"></i> Voucher</a></li>
                                <li><a href="/software/beta/voip/paket.php"><i class="fa fa-angle-double-right"></i> Paket</a></li>
                                <li><a href="/software/beta/voip/topup.php"><i class="fa fa-angle-double-right"></i> Topup</a></li>
                                <li><a href="/software/beta/voip/setting.php"><i class="fa fa-angle-double-right"></i> Setting</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i> <span>TV</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/software/beta/tv/list_invoice.php"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li><a href="/software/beta/tv/topup.php"><i class="fa fa-angle-double-right"></i> Top Up Saldo</a></li>
                                <li><a href="/software/beta/tv/paket.php"><i class="fa fa-angle-double-right"></i> Paket</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/software/beta/topup/form_topup.php">
                                <i class="fa fa-credit-card"></i> <span>Topup</span>
                            </a>
                        </li>
                        <li>
                            <a href="/software/beta/">
                                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                                <small class="badge pull-right bg-red">3</small>
                            </a>
                        </li>
                        <li>
                            <a href="/software/beta/notification.php">
                                <i class="fa fa-exclamation-triangle"></i> <span>Notification</span>
                                <small class="badge pull-right bg-yellow">12</small>
                            </a>
                        </li>
                        <li>
                            <a href="/software/beta/setting.php">
                                <i class="fa fa-gear"></i> <span>Setting</span>
                                
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="/software/beta/help.php">
                                <i class="fa fa-th"></i> <span>Help</span>
                            </a>
                        </li>
                    </ul>
                    
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="padding-bottom:100px;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Profile
                    </h1>
		    <div class="breadcrumb"><span style="font-size:16px;" >Saldo Anda Rp. 1.000.000,00</span></div>
                    <form action="#" method="get" >
					<div class="input-group col-xs-3">
					  <input type="text" name="q" class="form-control" placeholder="Search...">
						  <span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
							</button>
						  </span>
					</div>
				</form>
                </section>
                
                <!-- Main content -->
                <section class="content">
		    <div class="row">
			<section class="col-lg-7"> 
			    <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Profile </h3>
                                    
                                </div>
                                <div class="box-body">
                                    <div class="box-body no-padding">
					<table class="table no-border" width="70%">
					    <tr>
						<td rowspan="8"><img src="" class="img-square" alt="User Image" /></td>
						<td>Nama </td>
						<td>dwi wardiansah</td>
					    </tr>
					    <tr>
						<td>Alamat</td>
						<td>balik papan<br>
						Kota: balikpapan<br>
						Lihat peta -
						</td>
					    </tr>
					    <tr>
						<td>
					    </tr>
					    <tr>
						<td>No. Telpon</td>
						<td>08579</td>
					    </tr>
					    <tr>
						<td>Fax</td>
						<td></td>
					    </tr>
					    <tr>
						<td>Nama Perusahaan</td>
						<td>testing</td>
					    </tr>
					    <tr>
						<td>User Id</td>
						<td>dwiwar</td>
					    </tr>
					    <tr>
						<td>Email</td>
						<td>dwi@email.com</td>
					    </tr>
					</table>
				    </div>
				</div><!-- /.box-body -->
			    </div>
			</section>
			<section class="col-lg-5"> 
			    
			    <div class="box box-solid box-success">
				  <div class="box-header">
					  <h3 class="box-title"><i class="fa fa-bar-chart-o"></i>  Status Data/Internet</h3>
					  <div class="box-tools pull-right">
						  <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						  <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
					  </div>
				  </div>
				  <div class="box-body">
					  Nama Paket : <b>Bali Dedicated Link Business 2 Mbps 1 year</b><br>
					  Time Remaining: <b>0</b><br>
					  Volume Based Remaining: <b>0,00 MB</b><br><br>
					  
					  Status : Aktif<br><br><br><br>
				  </div><!-- /.box-body -->
			  </div><!-- /.box -->
			  
			  
			    
			    <div class="box box-solid box-warning">
				<div class="box-header">
				    <h3 class="box-title"><i class="fa fa-laptop"></i>  VOD</h3>
				    
				</div>
				<div class="box-body">
				    <div class="box-body no-padding">
					<div style="font-size:20px;">Status  <span class="label label-success">ACTIVE</span></div><br>
				    Expired Date: <b>-</b><br>
				    Saldo : <b>Rp. 20.000,00</b><br>
				    Nama STB :  <b>test13</b><br>
				    Monthly fee:  <b>Rp 40.000,00</b>
				    </div>
				</div><!-- /.box-body -->
			    </div>
			</section>
		    </div>
		</section><!-- /.content -->
            
	    </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <div id="notification"></div>
        <a id="StickyChatWithUs" style="width: 163px; height: 87px;"  href="https://globalxtreme.net/bali/chat/client.php?locale=en" target="_blank" onclick="if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open(&#039;https://globalxtreme.net/bali/chat/client.php?locale=en&amp;url=&#039;+escape(document.location.href)+&#039;&amp;referrer=&#039;+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;">
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
        <script src="/software/beta/js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="/software/beta/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="/software/beta/js/bootstrap.min.js" type="text/javascript"></script>
        
	<!-- AdminLTE App -->
        <script src="/software/beta/js/AdminLTE/app.js" type="text/javascript"></script>    
        
	
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="/software/beta/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="/software/beta/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="/software/beta/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="/software/beta/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="/software/beta/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="/software/beta/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="/software/beta/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="/software/beta/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>


        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="/software/beta/js/AdminLTE/dashboard.js" type="text/javascript"></script>
    

<script language="javascript">
//confirm message for logout.
function logout() {
    if (confirm("Anda yakin untuk keluar ?")) {
	   
       window.location.href = "/software/beta/logout.php";
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
</html>