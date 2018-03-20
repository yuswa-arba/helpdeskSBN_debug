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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
    
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail complaint");

     global $conn;
     global $conn_helpdesk;
    


    $id_newsletter	= isset($_GET['id_newsletter']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_newsletter']))) : "";
    $sql_newsletter	= mysql_query("SELECT * FROM `newsletter` WHERE `id_newsletter` = '$id_newsletter' LIMIT 0,1;", $conn_helpdesk);
    $row_newsletter 	= mysql_fetch_array($sql_newsletter);
    
    
    $content ='<section class="content-header">
                    <h1>
                        Detail Newsletter
                        
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Newsletter</h2>
                                </div>
				
				<div class="box-body">
                                    <table id="LBL_PROJECT_INFORMATION" class="table footable" cellspacing="0" style="margin-bottom: 0;width:100%">
                                        <tbody>
                                        <tr>
                                            <td>
                                                Subject:
                                            </td>
                                            <td>
                                                '.$row_newsletter["subject"].'
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                user ID:
                                            </td>
                                            <td>
                                                '.$row_newsletter["message"].'
                                            </td>
                                            
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                    </div>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Detail Newsletter';
    $submenu	= "newsletter";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>