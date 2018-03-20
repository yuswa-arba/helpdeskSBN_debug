<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration_admin.php");


redirectToHTTPS();
if($loggedin = logged_inGlobal()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");

    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Home");
    
    global $conn;
    
    $content ='<!-- Content Header (Page header) -->
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
		    

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Home';
    $submenu	= "dashboard";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= global_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
    } else{
	header("location: logout.php");
    }

?>