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
    global $conn_voip;
    
    $content ='<section class="content-header">
                    <h1>
                        MailBox
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="master_customer">Mailbox</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Mailbox</h2>
                                </div>
				
				 
		    <a href="mailbox_kharis.php" class="btn btn-black">All</a>
                    <a href="mailbox_kharis.php?type=4" class="btn btn-blue">Request</a>
                    <a href="mailbox_kharis.php?type=3" class="btn btn-orange">Problem Wireless</a>
                    <a href="mailbox_kharis.php?type=2" class="btn btn-red">Problem Fo</a>
                    <a href="mailbox_kharis.php?type=5" class="btn btn-green">Billing</a>
                    <a href="mailbox_kharis.php?type=1" class="btn btn-black">Spam</a>
                                
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
                                    <form action="" method="post" name="form_nonprospek" >
	<div class="table-container">
              <table class="table table-bordered table-striped" id="mailbox" style="width: 100%;">
	      <thead>
	      <tr>
		<th>#</th>
		<th>Email From</th>
		<th>Email From P</th>
		
		<th>Date E</th>
		<th>Subject</th>
		
		
		<th>Kategori</th>
	    </tr>
	    </thead>
	    <tbody>';
	    
	    //<th>Message</th>

$q = isset($_GET["type"]) ? mysql_real_escape_string($_GET["type"]) : "";
    if(isset($_GET["type"])){
	
	$kategori	= isset($_GET["type"]) ? mysql_real_escape_string($_GET["type"]) : "";
	
	
	$sql_email 	= mysql_query("SELECT * FROM `gx_email` WHERE `id_kategori` LIKE '%".$kategori."%' ORDER BY `DateE` DESC",$conn);
	
    }else{
	$sql_email	= mysql_query("SELECT * FROM `gx_email` ORDER BY `DateE` DESC",$conn);
    }

$no = 1;
while($email = mysql_fetch_array($sql_email)){
    
    $sql_kat_mailbox = mysql_fetch_array(mysql_query("SELECT * FROM `gx_kat_mailbox` WHERE `id_kat_mailbox` = '".$email["id_kategori"]."' LIMIT 0,1;",$conn));
    
	$content .= '
	<tr>
	<td>'.$no.'.</td>
	<td><a href="detail.php?complaint_id='.$email["ID"].'">'.$email['EmailFrom'].'</a></td>
	<td>'.$email['EmailFromP'].'</td>
	
	<td>'.$email['DateE'].'</td>
	<td><a href="form_mailbox.php?id='.$email['ID'].'" onclick="return valideopenerform(\'form_mailbox.php?id='.$email['ID'].'\',\'mailbox'.$email["ID"].'\');">'.$email['Subject'].'</a></td>
	
	<td>'.$sql_kat_mailbox['nama_kat_mailbox'].'</td>
	</tr>';
	$no++;
	//<td>'.substr($email['Message'], 0, 300).'</td>
}
$content .= '</tbody>

</table><br>
</div>
	
</form>
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
                $(\'#mailbox\').dataTable({
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

    $title	= 'Mailbox';
    $submenu	= "mailbox";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>