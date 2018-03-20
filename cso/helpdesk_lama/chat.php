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
if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}
    
global $conn_helpdesk;

    
$locate = isset($_GET['locate']) ? $_GET['locate'] : '';

if($locate == 'mlg'){
    $codename = "Malang";
}elseif($locate == 'bpn'){
    $codename = "Balikpapan";
}elseif($locate == 'smd'){
    $codename = "Samarinda";
}else{
    $codename = "Bali";
}

 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open live support chat $codename");
    $content ='<section class="content-header">
                    <h1>
                        Live support - Chat - '.$codename.'
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="chat">Chat</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                   
                                </div>
				
				
                                
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                  
                                </div><!-- /.box-header -->
                                    
<form action="" method="post" name="form_chat" >
	<div class="table-container">
              <table class="table table-bordered table-striped" id="chat" style="width: 100%;">
	      <thead>
	      <tr>
		<th>#</th>
		<th>Visitor</th>
		<th>IP Visitor</th>
		<th>Operator</th>
		<th>Date</th>
		<th>OS</th>
	    </tr>
	    </thead>
	    <tbody>';
	    
	    //<th>Message</th>




$code_name = "";

$page 	= isset($_GET['page']) ? $_GET['page'] : '';

if($locate == 'mlg'){
//////buka mlg//////	
$host = "202.58.203.29";
$mysqldb = "globalxt_mibew";
$mysqllogin = "globalxt_mibew";
$mysqlpass = "b4ckupw3b";
$connect = mysql_connect($host, $mysqllogin, $mysqlpass) or die("koneksi gagal");
mysql_select_db($mysqldb, $connect) or die("database gagal diakses");    
$sql_chat 	= mysql_query("SELECT * FROM `chatthread` ORDER BY `dtmcreated` DESC");
$no = 1;
while($chat = mysql_fetch_array($sql_chat)){
   	$content .= '<tr>
	<td>'.$no.'.</td>
	<td><a href="#" onclick="window.open(\'chatdetail.php?kota=mlg&threadid='.$chat['threadid'].'\', \'newwindow\', \'width=800px, height=600px, scrollbars=yes, \'); return false;">'.$chat['userName'].'</a></td>
	<td>'.$chat['remote'].'</td>
	
	<td>'.$chat['agentName'].'</td>
	<td>'.$chat['dtmcreated'].'</td>
	
	<td>'.$chat['userAgent'].'</td>
	</tr>';
	$no++;
	//<td>'.substr($email['Message'], 0, 300).'</td>
}
$content .= '</tbody>

</table>
</div>
	
</form>';
/////tutup mlg/////
}
elseif($locate == 'bpn'){
//////buka bpn//////	
$host = "202.58.203.29";
$mysqldb = "globalxt_chat_bpn";
$mysqllogin = "globalxt_mibew";
$mysqlpass = "b4ckupw3b";
$connect = mysql_connect($host, $mysqllogin, $mysqlpass) or die("koneksi gagal");
mysql_select_db($mysqldb, $connect) or die("database gagal diakses");    
$sql_chat 	= mysql_query("SELECT * FROM `chatthread` ORDER BY `dtmcreated` DESC");
$no = 1;
while($chat = mysql_fetch_array($sql_chat)){
   	$content .= '<tr>
	<td>'.$no.'.</td>
	<td><a href="#" onclick="window.open(\'chatdetail.php?kota=bpn&threadid='.$chat['threadid'].'\', \'newwindow\', \'width=800px, height=600px, \'); return false;">'.$chat['userName'].'</a></td>
	<td>'.$chat['remote'].'</td>
	
	<td>'.$chat['agentName'].'</td>
	<td>'.$chat['dtmcreated'].'</td>
	
	<td>'.$chat['userAgent'].'</td>
	</tr>';
	$no++;
	//<td>'.substr($email['Message'], 0, 300).'</td>
}
$content .= '</tbody>

</table>
</div>
	
</form>';
/////tutup bpn/////
}
elseif($locate == 'smd'){
//////buka smd//////	
$host = "202.58.203.29";
$mysqldb = "globalxt_chat_smd";
$mysqllogin = "globalxt_mibew";
$mysqlpass = "b4ckupw3b";
$connect = mysql_connect($host, $mysqllogin, $mysqlpass) or die("koneksi gagal");
mysql_select_db($mysqldb, $connect) or die("database gagal diakses");    
$sql_chat 	= mysql_query("SELECT * FROM `chatthread` ORDER BY `dtmcreated` DESC");
$no = 1;
while($chat = mysql_fetch_array($sql_chat)){
   	$content .= '<tr>
	<td>'.$no.'.</td>
	<td><a href="#" onclick="window.open(\'chatdetail.php?kota=smd&threadid='.$chat['threadid'].'\', \'newwindow\', \'width=800px, height=600px,  scrollbars=yes,\' ); return false;">'.$chat['userName'].'</a></td>
	<td>'.$chat['remote'].'</td>
	
	<td>'.$chat['agentName'].'</td>
	<td>'.$chat['dtmcreated'].'</td>
	
	<td>'.$chat['userAgent'].'</td>
	</tr>';
	$no++;
	//<td>'.substr($email['Message'], 0, 300).'</td>
}
$content .= '</tbody>

</table>
</div>
	
</form>';
/////tutup smd/////
}else{
//////buka bali//////	
$host = "202.58.203.29";
$mysqldb = "globalxt_chat_bali";
$mysqllogin = "globalxt_mibew";
$mysqlpass = "b4ckupw3b";
$connect = mysql_connect($host, $mysqllogin, $mysqlpass) or die("koneksi gagal");
mysql_select_db($mysqldb, $connect) or die("database gagal diakses");    
$sql_chat 	= mysql_query("SELECT * FROM `chatthread` ORDER BY `dtmcreated` DESC");
$no = 1;
while($chat = mysql_fetch_array($sql_chat)){
   	$content .= '<tr>
	<td>'.$no.'.</td>
	<td><a href="#" onclick="window.open(\'chatdetail.php?kota=bali&threadid='.$chat['threadid'].'\', \'newwindow\', \'width=800px, height=600px, \'); return false;">'.$chat['userName'].'</a></td>
	<td>'.$chat['remote'].'</td>
	
	<td>'.$chat['agentName'].'</td>
	<td>'.$chat['dtmcreated'].'</td>
	
	<td>'.$chat['userAgent'].'</td>
	</tr>';
	$no++;
	//<td>'.substr($email['Message'], 0, 300).'</td>
}
$content .= '</tbody>

</table>
</div>
	
</form>';
/////tutup bali/////
}


 $content .='
				    
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
                $(\'#chat\').dataTable({
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
    
    $title	= 'Live Support Chat';
    $submenu	= $codename;
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>