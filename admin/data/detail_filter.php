<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){


global $conn;

//log
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open detail filter internet");


if(isset($_GET["id"]))
{
    $id_data = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $sql_data = mysql_query("SELECT * FROM `gx_inet_filter` WHERE `id_filter` = '".$id_data."' LIMIT 0,1;", $conn);
    $row_data = mysql_fetch_array($sql_data);
    
}

    $content ='<section class="content-header">
                    <h1>
                        Detail Filter Internet
                    </h1>
                    
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Detail Filter Internet</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    
                                   
                                    <div class="box-body">
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Tipe Filter</h5>
                                            </div>
                                            <div class="col-xs-3">
                                                '.StatusFilter($row_data["tipe_filter"]).'
                                            </div>
                                        </div>
                                        </div>
										
										<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Value Filter</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                '.(isset($_GET["id"]) ? $row_data["value"] : "").'
                                                
                                            </div>
                                        </div>
                                        </div>
										<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>User Created</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                '.(isset($_GET["id"]) ? $row_data["user_add"]." on ". $row_data["date_add"] : "").'
                                                
                                            </div>
                                        </div>
                                        </div>
										<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>User Last Updated</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                '.(isset($_GET["id"]) ? $row_data["user_upd"]." on ". $row_data["date_upd"] : "").'
                                                
                                            </div>
                                        </div>
                                        </div>
                                        
                                    </div><!-- /.box-body -->

                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Detail Filter Internet';
    $submenu	= "inet_filter";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>