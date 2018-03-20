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
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],"Open Menu List OLT server");
    
    if(isset($_POST["hapus"]))
    {
        $id_server = array();
        $id_server = isset($_POST["id_server"]) ? $_POST["id_server"] : $id_server;
        
        foreach($id_server as $key => $value)
        {
            $query = "UPDATE `gx_inet_esx` SET `level` = '1', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                    WHERE `id_server` = '".$value."';";
            $sql_update = mysql_query($query, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
        }
        header('location: '.URL_ADMIN.'data/list_server_olt.php');
    }
    
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">List Log Aktivasi</h3>
                                    
                                </div>
                                <div class="box-body">
                                    
                                <table class="table table-hover table-bordered table-striped table-responsive">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>Tanggal</th>
                                                <th>UserID</th>
                                                <th>VLAN</th>
												<th>Mac Address</th>
												<th>OLT</th>
												<th>PON</th>
												<th>Step</th>
												<th>Aktivasi</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>';

$sql_data = mysql_query("SELECT * FROM `gx_log_aktivasi` ORDER BY `id_log_aktivasi` DESC LIMIT 0,50;", $conn);


$no = 1;
while ($row_data = mysql_fetch_array($sql_data))
{
	
    $content .= '<tr>
		    <td>'.$no.'.</td>
			<td>'.date("d-m-Y H:i:s", strtotime($row_data["log"])).'</td>
		    <td><a href="list_log_aktivasi_detail.php?id='.$row_data['uuid_log_aktivasi'].'">'.$row_data["userid_aktivasi"].'</a></td>
			<td>'.$row_data["vlan_aktivasi"].'</td>
			<td>'.$row_data["macaddress_aktivasi"].'</td>
			<td>'.$row_data["userid_aktivasi"].'</td>
			<td>'.$row_data["pon_aktivasi"].':'.$row_data["ponid_aktivasi"].'</td>
			
		    <td>'.nl2br(substr($row_data["step"],0,100)).' ...</td>
			<td>'.$row_data["user_add"].' ('.$row_data["from_ip"].')</td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>
                                    
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

    $title	= 'List LOG AKTIVASI';
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