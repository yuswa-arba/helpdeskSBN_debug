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
if($loggedin["group"] == 'admin'){
    
    global $conn_helpdesk;
    
    $content ='<section class="content-header">
                    <h1>
                        Detail Chat
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="master_customer">Detail Chat</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Detail chat</h2>
                                </div>
				
				
                                
                                <div class="box-body table-responsive">
				
	<hr>
                                    <meta http-equiv="refresh" content="3600">
    <div id="divToRefresh"></div>
                <div class="block">
		';
		
$host = "202.58.203.29";
$mysqllogin = "globalxt_mibew";
$mysqlpass = "b4ckupw3b";
 $mysqldb = "globalxt_chat_bali";
$connect = mysql_connect($host, $mysqllogin, $mysqlpass) or die("koneksi gagal");
mysql_select_db($mysqldb, $connect) or die("database gagal diakses");


$sql = mysql_query("SELECT * FROM `chatmessage` WHERE `threadid`='$_GET[threadid]' AND `ikind` NOT LIKE '%4%' AND `ikind` NOT LIKE '%5%' AND `ikind` NOT LIKE '%6%'");

$content .= '<table style="margin:5px;">';
while($detail = mysql_fetch_array($sql)){
$content .= '<tr>
		<td width="10%">';
		if($detail['tname'] != ''){
		    $content .= $detail['tname'];
		} else{ $content .= 'Notifikasi';
		}
		$content .= '</td>
		<td>'.$detail['tmessage'].'</td>
		
	    </tr>';
}
$content .= '</table>';
$content .= '<!--<br><br><center><a href="#" onclick="window.open(\'form_complaint.php?kota='.$_GET['kota'].'&threadid='.$_GET['threadid'].'\', \'newwindow\', \'width=800px, height=600px, scrollbars=yes, \'); return false;">insert into incoming</a></center>-->';
$content .= '</div>
				    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#customer\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>
	
    ';

    $title	= 'Master Customer';
    $submenu	= "customer";
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