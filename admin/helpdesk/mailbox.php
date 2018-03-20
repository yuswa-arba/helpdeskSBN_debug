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
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Mailbox");
    global $conn;
    //paging
     $perhalaman = 50;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
    
    if(isset($_POST["update_kategori"]))
    {
	  $id_email 	= isset($_POST['id_email']) ? $_POST["id_email"] : '';
	  $id_kategori	= isset($_POST['id_kategori']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_kategori']))) : "";
        
	  $update    = "UPDATE `gx_email` SET `id_kategori` = '".$id_kategori."', `date_upd` = NOW(), `user_upd` = '$loggedin[username]'
			 WHERE `ID`='".$id_email."'";
			 
	  //echo $update;
	  mysql_query($update, $conn)or die("<script language='JavaScript'>
					     alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
					     location.href = 'mailbox.php';
					</script>");
	  header('location: '.URL_ADMIN.'helpdesk/mailbox.php');
    }
    
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
				    <h2 class="box-title">Search</h2>
				</div>
				<form role="form" method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Email From</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="from" name="from" value="">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Subject</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="subject" name="subject" value="">
					    </div>
                                        </div>
					</div>
					
				    <div class="actions">
					<div class="button-well">
					    <input type="submit" class="button button-primary" data-icon="v" name="search" value="Search">
					</div>
				    </div>
				    
				    </form>
				</div>
				<div class="box-footer">
				    
				</div>
			    </div>
			</div>
			
			 <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				    <a href="" class="btn bg-navy btn-flat margin">All</a>
				    <a href="?e=gx" class="btn bg-navy btn-flat margin">Email GlobalXtreme</a>
				    <a href="?e=nongx" class="btn bg-navy btn-flat margin">Email Non GlobalXtreme</a>
				</div>
			    </div>
			</div>
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Mailbox</h2>
                                
				<div class="box-tools pull-right">
				   <div class="btn bg-olive btn-flat margin">
					<a href="'.URL_ADMIN.'helpdesk/mailbox.php">ALL</a>
				   </div>
                                        ';
$query_email_kategori	= "SELECT * FROM `gx_email_kategori` WHERE `level` = '1';";
$sql_email_kategori	= mysql_query($query_email_kategori, $conn);

while($row_email_kategori = mysql_fetch_array($sql_email_kategori))
{
     $content .='<div class="btn bg-olive btn-flat margin">
     <a href="'.URL_ADMIN.'helpdesk/mailbox.php?type='.$row_email_kategori["id_kategori"].'">'.$row_email_kategori["nama_kategori"].'</a></div>';
}

$content .='</div></div>
                                <div class="box-body table-responsive">
				
                                    <form action="" method="post" name="form_mailbox" >
	<div class="table-container">
	  <div id="autorefresh">
              <table class="table table-bordered table-striped" id="mailbox" style="width: 100%;">
	      <thead>
	      <tr>
		<th>#</th>
		<th>From</th>
		<th>Cust Numb</th>
		<th>UID</th>
		<th>Date</th>
		<th>Subject</th>
		<th>Kategory</th>
		<th>Action</th>
		<th>Status</th>
		<th>SPK</th>
		<th>SPK Status</th>
	    </tr>
	    </thead>
	    <tbody>';
	    
	    //<th>Message</th>

$q = isset($_GET["type"]) ? mysql_real_escape_string($_GET["type"]) : "";
$e = isset($_GET["e"]) ? mysql_real_escape_string($_GET["e"]) : "";
$from 	= isset($_GET["f"]) ? mysql_real_escape_string($_GET["f"]) : "";
$subject= isset($_GET["s"]) ? mysql_real_escape_string($_GET["s"]) : "";


if(isset($_POST["search"])){
	
	$from		= isset($_POST['from']) ? mysql_real_escape_string(strip_tags(trim($_POST['from']))) : "";
	$subject	= isset($_POST['subject']) ? mysql_real_escape_string(strip_tags(trim($_POST['subject']))) : "";
	    
	$sql_email	= mysql_query("SELECT * FROM `gx_email`
				      WHERE `gx_email`.`EmailFrom` LIKE '%".$from."%'
				      AND `gx_email`.`Subject` LIKE '%".$subject."%'
				      ORDER BY `DateE` DESC LIMIT $start,$perhalaman;",$conn);

	$sql_total_email	= mysql_num_rows(mysql_query("SELECT * FROM `gx_email`
				      WHERE `gx_email`.`EmailFrom` LIKE '%".$from."%'
				      AND `gx_email`.`Subject` LIKE '%".$subject."%' ORDER BY `DateE` DESC;",$conn));
	$hal = "?f=$from&s=$subject&";
}
if(isset($_GET["f"]) AND isset($_GET["s"])){
	$from 	= isset($_GET["f"]) ? mysql_real_escape_string($_GET["f"]) : "";
	$subject= isset($_GET["s"]) ? mysql_real_escape_string($_GET["s"]) : "";

	$sql_email	= mysql_query("SELECT * FROM `gx_email`
				      WHERE `gx_email`.`EmailFrom` LIKE '%".$from."%'
				      AND `gx_email`.`Subject` LIKE '%".$subject."%'
				      ORDER BY `DateE` DESC LIMIT $start,$perhalaman;",$conn);

	$sql_total_email	= mysql_num_rows(mysql_query("SELECT * FROM `gx_email`
				      WHERE `gx_email`.`EmailFrom` LIKE '%".$from."%'
				      AND `gx_email`.`Subject` LIKE '%".$subject."%' ORDER BY `DateE` DESC;",$conn));
	$hal = "?f=$from&s=$subject&";
	
}elseif(isset($_GET["type"])){
	
	$kategori	= isset($_GET["type"]) ? mysql_real_escape_string($_GET["type"]) : "";
	
	
	$sql_email 	= mysql_query("SELECT * FROM `gx_email` WHERE `id_kategori` LIKE '%".$kategori."%' ORDER BY `DateE` DESC LIMIT $start,$perhalaman;",$conn);
	$sql_total_email 	= mysql_num_rows(mysql_query("SELECT * FROM `gx_email` WHERE `id_kategori` LIKE '%".$kategori."%' ORDER BY `DateE` DESC;",$conn));
	$hal = "?type=$q&";
    }else{
	  if($e== "gx"){
	       $sql_email	= mysql_query("SELECT * FROM `gx_email` WHERE `EmailFrom` LIKE '%globalxtreme.net%' ORDER BY `DateE` DESC LIMIT $start,$perhalaman;",$conn);
	       $sql_total_email	= mysql_num_rows(mysql_query("SELECT * FROM `gx_email` WHERE `EmailFrom` LIKE '%globalxtreme.net%' ORDER BY `DateE` DESC;",$conn));
	       $hal = "?e=gx&";
	  }elseif($e== "nongx"){
	       $sql_email	= mysql_query("SELECT * FROM `gx_email` WHERE `EmailFrom` NOT LIKE '%globalxtreme.net%' ORDER BY `DateE` DESC LIMIT $start,$perhalaman;",$conn);
	       $sql_total_email	= mysql_num_rows(mysql_query("SELECT * FROM `gx_email` WHERE `EmailFrom` NOT LIKE '%globalxtreme.net%' ORDER BY `DateE` DESC;",$conn));
	       $hal = "?e=nongx&";
	  }else{
	       $sql_email	= mysql_query("SELECT * FROM `gx_email` ORDER BY `DateE` DESC LIMIT $start,$perhalaman;",$conn);
	       $sql_total_email	= mysql_num_rows(mysql_query("SELECT * FROM `gx_email` ORDER BY `DateE` DESC;",$conn));
	       $hal = "?";
	
	  }
    }

$no = $start + 1;
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
     $kategori	= ((isset($sql_kat_mailbox['nama_kategori']) == "") ? '<a href="form_mailbox_new.php?id='.$email['ID'].'" onclick="return valideopenerform(\'form_mailbox_new.php?id='.$email['ID'].'\',\'mailbox'.$email["ID"].'\');">Non-Kategory</a>' : '<a href="form_mailbox_e.php?id_complaint='.$email['ID'].'" onclick="return valideopenerform(\'form_mailbox_e.php?id_complaint='.$email['ID'].'\',\'mailbox'.$email["ID"].'\');">'.$sql_kat_mailbox['nama_kategori'].'</a>');
     
     
     $query_email_kategori2	= "SELECT * FROM `gx_email_kategori` WHERE `level` = '1';";
     $sql_email_kategori2	= mysql_query($query_email_kategori2, $conn);

     if($email["status_email"] == 0)
     {
	  $status_email = '<span class="label label-warning">Open</span>';
     }elseif($email["status_email"] == 1)
     {
	  $status_email = '<span class="label label-warning">Closed</span>';
     }elseif($email["status_email"] == 2)
     {
	  $status_email = '<span class="label label-warning">Re-Open</span>';
     }else{
	  $status_email = "";
     }
     
     $content .= '
	<tr>
	<td>'.$no.'.</td>
	<td><a href="detail.php?complaint_id='.$email["ID"].'" onclick="return valideopenerform(\'detail.php?complaint_id='.$email["ID"].'\',\'detail'.$email["ID"].'\');">'.$email['EmailFromP'].'</a></td>
	<td>'.$email['customer_number'].'</td>
	<td>'.$email['userid'].'</td>
	<td>'.$email['DateE'].'</td>
	<td><a href="detail_mail?id='.$email['ID'].'" onclick="return valideopenerform(\'detail_mail?id='.$email['ID'].'\',\'mail'.$email["ID"].'\');"
	data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-html="true" title="<table style=\'width:200px;\'>
                                        <tr>
                                            <td>Read by: -</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Reply by: -</td>
                                            
                                        </tr>
                                    </table>">'.substr($email['Subject'], 0 ,100).'</a></td>
	<td>'.$kategori.'
	<ul class="list-unstyled">
	<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Menu Footer-->
                                <li>
                                    <div style="width:200px;padding: 8px;">
                                        <form action="" method="post" name="form_kategori">
					     <input name="id_email" type="hidden" value="'.$email["ID"].'" readonly="">
          <table style="width:100%;">
	    <tbody>
	    
	    
	    <tr>
		
		<td>';
		
		while($row_update_kategori = mysql_fetch_array($sql_email_kategori2))
	       {
		    $content .='<input type="radio" id="id_kategori" name="id_kategori" value="'.$row_update_kategori["id_kategori"].'" style="float:left;" '.(($email["id_kategori"] == $row_update_kategori["id_kategori"]) ? "checked" : "").'> '.$row_update_kategori["nama_kategori"].'<br>';
	       }
		  
     $content .='
		</td>
	      </tr>
	    </tbody>
	</table>
	<div class="actions" align="center">
	    <div class="button-well">
		<input type="submit" class="btn bg-blue btn-flat" data-icon="v" name="update_kategori" value="Save">
	    </div>
	</div>
	
	</form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
	</td>
	<td><a href="form_reply.php?id='.$email['ID'].'">Reply</a>';
	if($email["id_kategori"] == '2' || $email["id_kategori"] == '3'){
	  $content .=' || <a href="form_mail_troubleticket.php?id_email='.$email['ID'].'">Form Troubleticket</a>';
	}
	
	$content .='</td>
	<td>'.(($sql_status_reply >= 1) ? '<a href="reply.php?id='.$email['ID'].'" onclick="return valideopenerform(\'reply.php?id='.$email['ID'].'\',\'reply'.$email["ID"].'\');"><span class="label label-success">replied</span></a>'
	       : '<span class="label label-warning">not replied</span>').'
	'.$status_email.'
	</td>
	<td>'.$btn_spk.'</td>
	<td><a href="spk_detail.php" onclick="return valideopenerform(\'spk_detail.php?id='.$sql_spk["id_spk"].'\',\'reply'.$sql_jawabspk['id_jawabspk'].'\');"><span class="label label-success">'.$sql_jawabspk['status_teknisi'].'</span></a></td>
	
	</tr>';
	$no++;
	//<td>'.substr($email['Message'], 0, 300).'</td>
}
$content .= '</tbody>

</table><br>

</div>
</div>
	
</form>
                                </div><!-- /.box-body -->
				<div class="box-footer">
				   <div class="box-tools pull-right">
				   '.(halaman($sql_total_email, $perhalaman, 1, $hal)).'
				   </div>
				   <br style="clear:both;">
				</div>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
		<div id="download_mail" style="display:none;"></div>
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />

     <script type="text/javascript">
	  $(function () {
	       $.ajaxSetup({ cache: false }); 
	       setInterval(function() {
		    $(\'#download_mail\').load(\''.URL_ADMIN.'ajax/mailbox.php\');
	       }, 10000); 
	  });
    
     </script>


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
	header('location: '.URL_ADMIN.'logout.php');
    }

?>