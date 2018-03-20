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
use PEAR2\Net\RouterOS;
require_once '../../config/telnet/PEAR2_Net_RouterOS-1.0.0b4.phar';


redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
            
    $content ='<section class="content-header">
                    <h1>
                        Log Mikrotik 90
                    </h1>
                    
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Log Mikrotik 90</h3>
                                    <div class="box-tools pull-right">
                                        
                                    </div>
                                </div>
                                <div class="box-body table-responsive">';
    


try {
    $client = new RouterOS\Client('192.168.1.90', 'dwi', 'dwi');
} catch (Exception $e) {
    $content .='<div>Unable to connect to RouterOS.</div>';
}

if (isset($client)) {
        
    $content .= '<table class="table table-hover table-border">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Topics</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>';
                    
    $logEntries = $client->sendSync(
        new RouterOS\Request('/log print')
    )->getAllOfType(RouterOS\Response::TYPE_DATA);
    foreach ($logEntries as $entry) {
        $content .= '<tr>
                    <td>'.$entry('time').'</td>
                    <td>';
                    $topics = explode(',', $entry('topics'));
                    foreach ($topics as $topic) {
                        $content .='<span>'.$topic.'</span> | ';
                    }
        $content .='</td>
                    <td>'.$entry('message').'</td>
                </tr>';
    }

$content .='</tbody>
        </table>';
    }
    
$content .='                    </div><!-- /.box-body-->
                            </div><!-- /.box -->

                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->';
    
    $title	= 'Cek Bandwidth';
    $submenu	= "inet_datausage";
    $plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>