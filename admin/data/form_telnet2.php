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


global $conn;
global $conn_voip;

//DATA Internet
$conn_soft = Config::getInstanceSoft();
$messages = '';


if(isset($_POST["send"])){
    
    $ip_address	= isset($_POST['ip_address']) ? $_POST['ip_address'] : '';
    $port	= isset($_POST['port']) ? $_POST['port'] : '8728';
    $username	= isset($_POST['username']) ? $_POST['username'] : '';
    $password	= isset($_POST['password']) ? $_POST['password'] : '';
    $command	= isset($_POST['command_telnet']) ? $_POST['command_telnet'] : '';

try {
    $client = new RouterOS\Client($ip_address, $username, $password);
} catch (Exception $e) {
    $messages ='<div>Unable to connect to RouterOS.</div>';
}

    if (isset($client)) {
                //$client->sendSync(new RouterOS\Request('/interface vlan remove tes_vlan'));
                $util = new RouterOS\Util($client);
                //$util->changeMenu('');
                ///interface vlan remove [find name=vlan12]
                $util->exec("
                    $command
                    ");
                
                $logEntries = $client->sendSync(
                    new RouterOS\Request('/interface pppoe-server print')
                )->getAllOfType(RouterOS\Response::TYPE_DATA);
                
                $messages .='OK';
    }else{
        $messages ='<div>Unable to connect to RouterOS.</div>';
    }

}else{
    $messages = '';
}

    $content ='<section class="content-header">
                    <h1>
                        Telnet Command
                        
                    </h1>
                    
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Command Telnet</h3>
                                    <!--<div class="box-tools">
                                        <div class="input-group">
                                            <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>-->
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    '.$messages.'
                                    <form role="form" method="POST" action="">
                                    <div class="box-body">
                                        <h5>IP Address</h5>
                                        <div class="row">
                                            
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" name="ip_address" value="" data-inputmask="\'alias\': \'ip\'" data-mask="" />
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="port" value="" placeholder="Port">
                                            </div>
                                            
                                        </div>
					<div class="form-group">
                                            <h5>Username</h5>
                                            <input type="text" class="form-control" name="username" value="">
                                        </div>
					<div class="form-group">
                                            <h5>Password</h5>
                                            <input type="text" class="form-control" name="password" value="">
                                        </div>
					<div class="form-group">
                                            <h5>Command Telnet</h5>
                                            <textarea class="form-control" name="command_telnet"></textarea>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="send" class="btn btn-primary">Execute</button>
                                    </div>
                                </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '<!-- InputMask -->
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        
        <script type="text/javascript">
        $(function() {
                
                $("[data-mask]").inputmask();

                
            });

        </script>
	
    ';

    $title	= 'Form Telnet';
    $submenu	= "inet_sesshistory";
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