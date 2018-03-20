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
if($loggedin = logged_inStaff()){ // Check if they are logged in
if($loggedin["group"] == 'staff'){
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Last Mailbox");
    global $conn;
    
    $content ='<table class="table table-bordered table-striped" id="mailbox2" style="width: 100%;">
	      <thead>
	      <tr>
		<th>#</th>
		<th>From</th>
		<th>Cust Numb</th>
		<th>UID</th>
		<th>Date</th>
		<th>Subject</th>
		<th>Kategory</th>
		<th>SPK</th>
		<th>Status</th>
		<th>Reply</th>
		<th>Status</th>
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
    
     $sql_kat_mailbox 	= mysql_fetch_array(mysql_query("SELECT * FROM `gx_email_kategori`
						      WHERE `id_kategori` = '".$email["id_kategori"]."'
						      LIMIT 0,1;",$conn));
     $sql_status_reply 	= mysql_num_rows(mysql_query("SELECT * FROM `gx_email_reply`
						   WHERE `id_email` = '".$email["ID"]."';", $conn));
     
     $sql_complaint 	= mysql_fetch_array(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
						   WHERE `id_email` = '".$email["ID"]."' AND `level` = '0';", $conn));
     
     $sql_spk 		= mysql_fetch_array(mysql_query("SELECT * FROM `gx_helpdesk_spk`
						   WHERE `id_complaint` = '".$sql_complaint["id_complaint"]."' AND `level` = '0';", $conn));
    
     $sql_jawabspk 	= mysql_fetch_array(mysql_query("SELECT * FROM `gx_helpdesk_jawabspk`
						   WHERE `id_spk` = '".$sql_spk["id_spk"]."' AND `level` = '0';", $conn)); 
     $b_spk	= (($sql_complaint['spk'] == 'spk') ? '<a href="form_spk.php" onclick="return valideopenerform(\'form_spk.php\',\'reply'.$email["ID"].'\');"><span class="label label-success">SPK</span></a>' : '');
     $b_nonspk	= (($sql_complaint['spk'] == 'nonspk') ? '<span class="label label-warning">Non SPK</span>' : '');
     if($sql_spk["id_complaint"] != $sql_complaint["id_complaint"]){
	$btn_spk = $b_spk.''.$b_nonspk;
	
     }else{
	$btn_spk = '<a href="spk_detail.php" onclick="return valideopenerform(\'spk_detail.php?id='.$sql_spk["id_spk"].'\',\'reply'.$email["ID"].'\');"><span class="label label-success">SPK</span></a>';
     }
     $content .= '
	<tr>
	<td>'.$no.'.</td>
	<td><a href="detail.php?complaint_id='.$email["ID"].'">'.$email['EmailFromP'].'</a></td>
	<td>'.$email['customer_number'].'</td>
	<td>'.$email['userid'].'</td>
	<td>'.$email['DateE'].'</td>
	<td><a href="form_mailbox_new.php?id='.$email['ID'].'" onclick="return valideopenerform(\'form_mailbox_new.php?id='.$email['ID'].'\',\'mailbox'.$email["ID"].'\');">'.substr($email['Subject'], 0 ,100).'</a></td>
	<td>'.$sql_kat_mailbox['nama_kategori'].'</td>
	<td>'.$btn_spk.'</td>
	<td><a href="spk_detail.php" onclick="return valideopenerform(\'spk_detail.php?id='.$sql_spk["id_spk"].'\',\'reply'.$sql_jawabspk['id_jawabspk'].'\');"><span class="label label-success">'.$sql_jawabspk['status_teknisi'].'</span></a></td>
	<td><a href="form_reply.php?id='.$email['ID'].'">Reply</a></td>
	<td>'.(($sql_status_reply >= 1) ? '<a href="reply.php?id='.$email['ID'].'" onclick="return valideopenerform(\'reply.php?id='.$email['ID'].'\',\'reply'.$email["ID"].'\');"><span class="label label-success">replied</span></a>'
	       : '<span class="label label-warning">not replied</span>').'</td>
	</tr>';
	$no++;
	//<td>'.substr($email['Message'], 0, 300).'</td>
}
$content .= '</tbody>

</table><br>

<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#mailbox2\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>';

     echo $content;
}
    } else{
	header('location: '.URL_STAFF.'logout.php');
    }

?>