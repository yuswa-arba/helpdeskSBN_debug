<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */


function bootstrap_helpdesk($title="",$content="",$plugins="",$user="",$sub_menu="",$group=""){
    
    
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

    
    $sidebar = '<div class="primary-sidebar">

  <!-- Main nav -->
  <ul class="nav nav-collapse collapse nav-collapse-primary">

    

        

            <li class="active">
              <span class="glow"></span>
              <a href="dashboard.html">
                  <i class="icon-dashboard icon-2x"></i>
                  <span>Dashboard</span>
              </a>
            </li>

        

    

        

            <li class="dark-nav ">

              <span class="glow"></span>

              

              <a class="accordion-toggle collapsed " data-toggle="collapse" href="#3hzyGPtrSk">
                  <i class="icon-beaker icon-2x"></i>
                    <span>
                      UI Lab
                      <i class="icon-caret-down"></i>
                    </span>

              </a>

              <ul id="3hzyGPtrSk" class="collapse ">
                
                    <li class="">
                      <a href="../ui_lab/buttons.html">
                          <i class="icon-hand-up"></i> Buttons
                      </a>
                    </li>
                
                    <li class="">
                      <a href="../ui_lab/general.html">
                          <i class="icon-beaker"></i> General elements
                      </a>
                    </li>
                
                    <li class="">
                      <a href="../ui_lab/icons.html">
                          <i class="icon-info-sign"></i> Icons
                      </a>
                    </li>
                
                    <li class="">
                      <a href="../ui_lab/grid.html">
                          <i class="icon-th-large"></i> Grid
                      </a>
                    </li>
                
                    <li class="">
                      <a href="../ui_lab/tables.html">
                          <i class="icon-table"></i> Tables
                      </a>
                    </li>
                
                    <li class="">
                      <a href="../ui_lab/widgets.html">
                          <i class="icon-plus-sign-alt"></i> Widgets
                      </a>
                    </li>
                
              </ul>

            </li>

        

    

        

            <li class="">
              <span class="glow"></span>
              <a href="../forms/forms.html">
                  <i class="icon-edit icon-2x"></i>
                  <span>Forms</span>
              </a>
            </li>

        

    

        

            <li class="">
              <span class="glow"></span>
              <a href="../charts/charts.html">
                  <i class="icon-bar-chart icon-2x"></i>
                  <span>Charts</span>
              </a>
            </li>

        

    

        

            <li class="dark-nav ">

              <span class="glow"></span>

              

              <a class="accordion-toggle collapsed " data-toggle="collapse" href="#MB8CPSHAKP">
                  <i class="icon-link icon-2x"></i>
                    <span>
                      Others
                      <i class="icon-caret-down"></i>
                    </span>

              </a>

              <ul id="MB8CPSHAKP" class="collapse ">
                
                    <li class="">
                      <a href="../other/wizard.html">
                          <i class="icon-magic"></i> Wizard
                      </a>
                    </li>
                
                    <li class="">
                      <a href="../other/login.html">
                          <i class="icon-user"></i> Login Page
                      </a>
                    </li>
                
                    <li class="">
                      <a href="../other/sign_up.html">
                          <i class="icon-user"></i> Sign Up Page
                      </a>
                    </li>
                
                    <li class="">
                      <a href="../other/full_calendar.html">
                          <i class="icon-calendar"></i> Full Calendar
                      </a>
                    </li>
                
                    <li class="">
                      <a href="../other/error404.html">
                          <i class="icon-ban-circle"></i> Error 404 page
                      </a>
                    </li>
                
              </ul>

            </li>

        

    

  </ul>

  <div class="hidden-tablet hidden-phone">
    <div class="text-center" style="margin-top: 60px">
      <div class="easy-pie-chart-percent" style="display: inline-block" data-percent="89"><span>89%</span></div>
      <div style="padding-top: 20px"><b>CPU Usage</b></div>
    </div>

    <hr class="divider" style="margin-top: 60px" />

    <div class="sparkline-box side">

      <div class="sparkline-row">
        <h4 class="gray"><span>Complaint</span> '.$sum_complaint.'</h4>
        <div class="sparkline big" data-color="gray"><!--'.$complaint.'--></div>
      </div>

      <hr class="divider" />
      <div class="sparkline-row">
        <h4 class="dark-green"><span>Trouble Ticket</span> '.$sum_ticket.'</h4>
        <div class="sparkline big" data-color="darkGreen"><!--'.$ticket.'--></div>
      </div>

      <hr class="divider" />
      <div class="sparkline-row">
        <h4 class="blue"><span>Non Trouble <br>Ticket</span> '.$sum_nonticket.'</h4>
        <div class="sparkline big"><!--'.$nonticket.'--></div>
      </div>

      <hr class="divider" />
    </div>
  </div>


</div>';
    
    
	
	$riset	 	  = ($sub_menu=="Dashboard Riset") ? '<li class="displayactive"><a href="agenda.php">Agenda</a> </li>' : '<li ><a href="agenda.php">Agenda</a> </li>';
	$riset	 	 .= ($sub_menu=="Dashboard Riset") ? '<li class="displayactive"><a href="#">Profile</a> </li>' : '<li ><a href="#">Profile</a> </li>';
	
	
    
    $title = ($title != "") ? "Helpdesk Bali (beta) - $title" : "Helpdesk Bali (beta)";


    $template ='<!DOCTYPE HTML>
<html>
<head>

  <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" />
  <meta charset="utf-8" />

  <!-- Always force latest IE rendering engine or request Chrome Frame -->
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />

  <!-- Use title if it\'s in the page YAML frontmatter -->
  <title>'.$title.'</title>

  <link href="'.URL.'core-admin/stylesheets/application.css" media="screen" rel="stylesheet" type="text/css" />

  <!--[if lt IE 9]>
  <script src="'.URL.'core-admin/javascripts/vendor/html5shiv.js" type="text/javascript"></script>
  <script src="'.URL.'core-admin/javascripts/vendor/excanvas.js" type="text/javascript"></script>
  <![endif]-->

  <script src="'.URL.'core-admin/javascripts/application.js" type="text/javascript"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 </head>



<body>
<div class="navbar navbar-top navbar-inverse">
  <div class="navbar-inner">
    <div class="container-fluid">

      <a class="brand" href="#"><img src="http://202.58.203.27/~helpdesk/new/img/logo.png" alt="'.$title.'" /></a>

      <!-- the new toggle buttons -->

      <ul class="nav pull-right">

        <li class="toggle-primary-sidebar hidden-desktop" data-toggle="collapse" data-target=".nav-collapse-primary"><button type="button" class="btn btn-navbar"><i class="icon-th-list"></i></button></li>

        <li class="hidden-desktop" data-toggle="collapse" data-target=".nav-collapse-top"><button type="button" class="btn btn-navbar"><i class="icon-align-justify"></i></button></li>

      </ul>

      
          

          <div class="nav-collapse nav-collapse-top collapse">

            <ul class="nav full pull-right">
              <li class="dropdown user-avatar">

                <!-- the dropdown has a custom user-avatar class, this is the small avatar with the badge -->

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span>
                    <img class="menu-avatar" src="'.URL.'core-admin/images/avatars/avatar1.jpg" /> <span>'.ucfirst($user).' <i class="icon-caret-down"></i></span>
                    <span class="badge badge-dark-red">5</span>
                  </span>
                </a>

                <ul class="dropdown-menu">

                  <!-- the first element is the one with the big avatar, add a with-image class to it -->

                  <li class="with-image">
                    <div class="avatar">
                      <img src="'.URL.'core-admin/images/avatars/avatar1.jpg" />
                    </div>
                    <span>'.ucfirst($user).'</span>
                  </li>

                  <li class="divider"></li>

                  <li><a href="#"><i class="icon-user"></i> <span>Profile</span></a></li>
                  <li><a href="#"><i class="icon-cog"></i> <span>Settings</span></a></li>
                  <li><a href="#"><i class="icon-envelope"></i> <span>Messages</span> <span class="label label-dark-red pull-right">5</span></a></li>
                  <li><a href="javascript:logout();"><i class="icon-off"></i> <span>Logout</span></a></li>
                </ul>
              </li>
            </ul>

          </div>
      

    </div>
  </div>
</div><div class="sidebar-background">
  <div class="primary-sidebar-background"></div>
</div>

'.$sidebar.'
<div class="main-content">
  <div class="container-fluid">
    <div class="row-fluid">

      <div class="area-top clearfix">
        <div class="pull-left header">
          <h3 class="title">
            <i class="icon-dashboard"></i>
            '.$title.'
          </h3>
          <h5>
            &nbsp;
          </h5>
        </div>

        <ul class="inline pull-right sparkline-box">

          <li class="sparkline-row">
            <h4 class="blue"><span>Complaint</span> '.$sum_complaint.'</h4>
            <div class="sparkline big" data-color="blue"><!--'.$complaint.'--></div>
          </li>

          <li class="sparkline-row">
            <h4 class="green"><span>Trouble Ticket</span> '.$sum_ticket.'</h4>
            <div class="sparkline big" data-color="green"><!--'.$ticket.'--></div>
          </li>

          <li class="sparkline-row">
            <h4 class="red"><span>Non Trouble Ticket</span> '.$sum_nonticket.'</h4>
            <div class="sparkline big"><!--'.$nonticket.'--></div>
          </li>

        </ul>
      </div>
    </div>
  </div>

  <div class="container-fluid padded">
    <div class="row-fluid">

      <!-- Breadcrumb line -->

      <div id="breadcrumbs">
        <div class="breadcrumb-button blue">
          <span class="breadcrumb-label"><i class="icon-home"></i> Home</span>
          <span class="breadcrumb-arrow"><span></span></span>
        </div>

        

        <div class="breadcrumb-button">
          <span class="breadcrumb-label">
            <i class="icon-dashboard"></i> Dashboard
          </span>
          <span class="breadcrumb-arrow"><span></span></span>
        </div>
      </div>
    </div>
  </div>

  '.$content.'
</div>

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

</body>
</html>';



return $template;

}



function pad_zero($number, $length=6, $in_front=TRUE) {
    // ubah ke string agar dapat dihitung jumlah karakternya
    $number = (string)$number;
    // jumlah loop yang dilakukan adalah panjang digit - jumlah karakter
    // jadi jika ingin digit 6 dan angka yang disupply adalah 3
    // maka loop = 6 - 1 => 5 buah NOL
    $loop = $length - strlen($number);

    // variabel penampung hasil
    $result = '';
    for ($i=0; $i<$loop; $i++) {
        // tambahkan nol
        $result .= '0';
    }

    // gabungkan jumlah NOL dengan angka
    if ($in_front === TRUE) {
        $result = $result . $number;
    } else {
        // NOL dibelakang
        $result = $number . $result;
    }

    return $result;
}