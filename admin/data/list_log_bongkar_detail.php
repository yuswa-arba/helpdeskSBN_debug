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
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],"Open Menu List Log Bongkar Detail");
    

    
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title with-border">List Log Bongkar</h3>
                                    
                                </div>
                                <div class="box-body">
								
								<h5>Detail Bongkar</h5>
                                    
									';
									
$uuid_bongkar = isset($_GET['id']) ? strip_tags($_GET['id']) : '';
$sql_data = mysql_query("SELECT * FROM `gx_log_bongkar_detail`
						WHERE `idlog_bongkar` = '".$uuid_bongkar."'
						LIMIT 0,20;", $conn);


$no = 1;
while ($row_data = mysql_fetch_array($sql_data))
{
	
    $content .= '<div class="row">
					<div class="col-xs-10">
						<div class="box box-solid box-info collapsed-box">
							<div class="box-header">
								<h3 class="box-title">'.$row_data['step_bongkar'].'</h3>
								<div class="box-tools pull-right">
									<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<pre>'.$row_data['feedback_bongkar'].'</pre>
							</div>
						</div>
					</div>
				</div><tr>';
}

$content .= '


                                    
                                </div><!-- /.box-body-->
                                <div class="box-footer">
                                    
                                </div>
                            </div><!-- /.box -->
                            </form>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->

            ';

$plugins = '';

    $title	= 'List LOG BONGKAR DETAIL';
    $submenu	= "inet_server_ras";
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