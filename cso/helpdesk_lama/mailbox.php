<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inCSO()){ // Check if they are logged in
if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}
    

     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Mailbox");
     global $conn;
    
     $content ='<section class="content-header">
                    <h1>
                        MailBox
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Mailbox</h2>
                                
				<div class="box-tools pull-right">
				   <div class="btn bg-olive btn-flat margin">
					<a href="'.URL_CSO.'helpdesk/mailbox.php">ALL</a>
				   </div>
                                        ';
$query_email_kategori	= "SELECT * FROM `gx_email_kategori` WHERE `level` = '1';";
$sql_email_kategori	= mysql_query($query_email_kategori, $conn);

while($row_email_kategori = mysql_fetch_array($sql_email_kategori))
{
     $content .='<div class="btn bg-olive btn-flat margin">
     <a href="'.URL_CSO.'helpdesk/mailbox.php?type='.$row_email_kategori["id_kategori"].'">'.$row_email_kategori["nama_kategori"].'</a></div>';
}

$content .='</div></div>
                                <div class="box-body table-responsive">
				
                                    <form action="" method="post" name="form_nonprospek" >
	<div class="table-container">
              <table class="table table-bordered table-striped" id="mailbox" style="width: 100%;">
	      <thead>
	      <tr>
		<th>#</th>
		<th>Email From</th>
		<th>Date</th>
		<th>Subject</th>
		<th>Kategori</th>
		<th>Customer Number</th>
		<th>UserID</th>
		<th>Status</th>
		<th>Action</th>
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
    
    $sql_kat_mailbox = mysql_fetch_array(mysql_query("SELECT * FROM `gx_email_kategori` WHERE `id_kategori` = '".$email["id_kategori"]."' LIMIT 0,1;",$conn));
    
	$content .= '
	<tr>
	<td>'.$no.'.</td>
	<td><a href="detail.php?complaint_id='.$email["ID"].'">'.$email['EmailFromP'].'</a></td>
	
	<td>'.$email['DateE'].'</td>
	<td><a href="form_mailbox.php?id='.$email['ID'].'" onclick="return valideopenerform(\'form_mailbox_new.php?id='.$email['ID'].'\',\'mailbox'.$email["ID"].'\');">'.substr($email['Subject'], 0 ,100).'</a></td>
	
	<td>'.$sql_kat_mailbox['nama_kategori'].'</td>
	<td>'.$email['customer_number'].'</td>
	<td>'.$email['userid'].'</td>
	<td>'.$email['status_cso'].'</td>
	<td><a href="form_reply.php?id='.$email['ID'].'" >Reply</a></td>
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
	       <div id="download_mail"></div>
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
     <script type="text/javascript">
	  $(function () {
	       $.ajaxSetup({ cache: false }); 
	       setInterval(function() {
		    $(\'#download_mail\').load(\''.URL_ADMIN.'ajax/mailbox.php\');
	       }, 300000); 
	  });
    
     </script>

    ';

    $title	= 'Mailbox';
    $submenu	= "mailbox";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>