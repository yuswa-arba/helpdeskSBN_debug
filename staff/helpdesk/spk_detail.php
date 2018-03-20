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
if($loggedin = logged_inStaff()){ // Check if they are logged in
if($loggedin["group"] == 'staff'){
     //enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail complaint");
     global $conn;

     $id_spk		= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
     $sql_spk		= mysql_query("SELECT * FROM `gx_helpdesk_spk` WHERE `id_spk` = '$id_spk' LIMIT 0,1;", $conn);
     $row_spk 		= mysql_fetch_array($sql_spk);
     $cust_number	= $row_spk["cust_number"];
     $spk_number	= $row_spk["spk_number"];
     $id_complaint      = $row_spk["id_complaint"];
     
     $sql_user	= mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` LIKE '%".$cust_number."%' AND `level` = '0' LIMIT 0,1;", $conn);
     $row_user 	= mysql_fetch_array($sql_user);
     $user_id	= $row_user["cUserID"];
     //echo "SELECT * FROM `gx_helpdesk_spk` WHERE `id_spk` = '$id_spk' LIMIT 0,1";
     $content ='<section class="content-header">
		     <h1>
			 Detail SPK
		     </h1>
		     
		 </section>
 
		 <!-- Main content -->
		 <section class="content">
		     <div class="row">
			 <div class="col-xs-12">
			     <div class="box">
				   <div class="box-header">
					<h2 class="box-title">Data Customer</h2>
				   </div>
				 
				   <div class="box-body">
				   <table style="margin-bottom: 0;width:60%">
				     <tbody>
				     <tr>
					 <td>Customer Number</td>
					 <td>'.$row_user["cKode"].'</td>
				     </tr>
				     <tr>
					 <td>User ID</td>
					 <td><span class="sugar_field" id="name">'.$row_user["cUserID"].'</span></td>
				     </tr>
				     <tr>
					 <td>Nama</td>
					 <td>'.$row_user["cNama"].'</td>
				     </tr>
				     <tr>
					 <td>Nama Perusahaan</td>
					 <td>'.$row_user["cNamaPers"].'</td>
				     </tr>
				     <tr>
					 <td>Alamat</td>
					 <td>'.$row_user["cAlamat1"].', Kota: '.$row_user["cKota"].'</td>
				     </tr>
				     <tr>
					 <td>No Telp</td>
					 <td>'.$row_user["ctelp"].'</td>
				     </tr>
				     <tr>
					 <td>Fax</td>
					 <td>'.$row_user["cfax"].'</td>
				     </tr>
				     <tr>
					 <td>Email</td>
					 <td>'.$row_user["cEmail"].'</td>
				     </tr>
				     </tbody>
				 </table>
				 </div>
			      </div>
			      
                              <div class="box">
				   <div class="box-header">
					<h2 class="box-title">Detail Complaint</h2>
				   </div>
				 
				   <div class="box-body">
				     <form action="" method="post" name="form_nonprospek" >
	 <div class="table-container">
	       <table class="table table-bordered table-striped" id="complaint_history" style="width: 100%;">
	       <thead>
	       <tr>
		 <th>No.</th>
		 <th>Nomer Trouble Ticket</th>
		 <th>Customer ID</th>
		 <th>complaint</th>
		 <th>tanggal</th>
	       </tr>
	       </thead>
	       <tbody>';
	     
	     //<th>Message</th>
 
if($row_user["cKode"] != ""){
$sql_history_complaint	= "SELECT * FROM `gx_helpdesk_complaint`
			 WHERE `cust_number` = '".$row_user["cKode"]."'
			 AND `id_complaint` = '$id_complaint'
			 ORDER BY `date_add` DESC;";
$query_history_complaint= mysql_query($sql_history_complaint, $conn);


$no = 1;
while ($row_complaint = mysql_fetch_array($query_history_complaint)) {
	 $content .= '
	 <tr>
		     <td>'.$no.'</td>
		     <td>'.$row_complaint["ticket_number"].'</td>
		     <td>'.$row_complaint["cust_number"].'</td>
		     <td>'.substr($row_complaint["problem"], 0, 50).'</td>
		     <td>Last updated by '.$row_complaint["updated_by"].' ('.$row_complaint["date_upd"].')</td>
		     
	 </tr>';
	 $no++;
	 //<td>'.substr($email['Message'], 0, 300).'</td>
 }
}
 $content .= '</tbody>
 
 </table><br>
 </div>
	 
 </form>
				 </div><!-- /.box-body -->
			     </div><!-- /.box -->
                              
			      <div class="box">
				   <div class="box-header">
					<h2 class="box-title">Detail SPK</h2>
				   </div>
				 
				   <div class="box-body">
				     <form action="" method="post" name="form_nonprospek" >
	 <div class="table-container">
	       <table class="table table-bordered table-striped" id="complaint_history" style="width: 100%;">
	       <thead>
	       <tr>
		 <th>No.</th>
		 <th>Nomer SPK</th>
		 <th>Teknisi</th>
		 <th>Customer ID</th>
		 <th>complaint</th>
		 <th>tanggal</th>
	       </tr>
	       </thead>
	       <tbody>';
	     
	     //<th>Message</th>
 
if($row_user["cKode"] != ""){
$sql_history_spk	= "SELECT * FROM `gx_helpdesk_spk`
			 WHERE `cust_number` = '".$row_user["cKode"]."'
			 AND `id_spk` = '$id_spk'
			 ORDER BY `date_add` DESC;";
$query_history_spk= mysql_query($sql_history_spk, $conn);


$no = 1;
while ($row_spk = mysql_fetch_array($query_history_spk)) {
$sql_tech	= "SELECT * FROM `tbPegawai`
			 WHERE `id_employee` = '".$row_spk["id_teknisi"]."';";
$query_tech= mysql_query($sql_tech, $conn);
$row_tech = mysql_fetch_array($query_tech);
	 $content .= '
	 <tr>
		     <td>'.$no.'</td>
		     <td>'.$row_spk["spk_number"].'</td>
		     <td>'.$row_tech["cNama"].'</td>
		     <td>'.$row_spk["cust_number"].'</td>
		     <td>'.substr($row_spk["problem"], 0, 50).'</td>
		     <td>Last updated by '.$row_spk["updated_by"].' ('.$row_spk["date_upd"].')</td>
		     
	 </tr>';
	 $no++;
	 //<td>'.substr($email['Message'], 0, 300).'</td>
 }
}
 $content .= '</tbody>
 
 </table><br>
 </div>
	 
 </form>
				 </div><!-- /.box-body -->
			     </div><!-- /.box -->
			     <div class="box">
				   <div class="box-header">
					<h2 class="box-title">History Jawab SPK</h2>
				   </div>
				 
				   <div class="box-body">
	 <div class="table-container">
	       <table class="table table-bordered table-striped" id="email_history" style="width: 100%;">
	       <thead>
	       <tr>
		 <th>No.</th>
		 <th>SPK Number</th>
		 <th>Teknisi</th>
		 <th>Jawab SPK</th>
	         <th>Status</th>
		 <th>Last Update</th>
	       </tr>
	       </thead>
	       <tbody>';
	     
	     //<th>Message</th>
 
if($row_user["cKode"] !=""){
$sql_history_jawabspk	= "SELECT * FROM `gx_helpdesk_jawabspk`
			 WHERE `spk_number` = '".$spk_number."'
			 AND `id_spk` = '$id_spk'
			 ORDER BY `date_add` DESC;";
$query_history_jawabspk= mysql_query($sql_history_jawabspk, $conn);

//echo $sql_history_jawabspk;
$noe = 1;
while ($row_jawabspk = mysql_fetch_array($query_history_jawabspk)) {
$sql_tech2	= "SELECT * FROM `tbPegawai`
			 WHERE `id_employee` = '".$row_jawabspk["id_teknisi"]."';";
$query_tech2= mysql_query($sql_tech2, $conn);
$row_tech2 = mysql_fetch_array($query_tech2);
    
	 $content .= '
	 <tr>
	       <td>'.$noe.'</td>
	       <td>'.$row_jawabspk["spk_number"].'</td>
	       <td>'.$row_tech2["cNama"].'</td>
	       <td>'.substr($row_jawabspk["jawab_spk"], 0, 50).'</td>
	       <td>'.$row_jawabspk["status_teknisi"].'</td>
	       <td>Last updated by '.$row_jawabspk["updated_by"].' ('.$row_jawabspk["date_upd"].')</td>
		     
	  </tr>
          
	 ';
	 $noe++;
	 //<td>'.substr($email['Message'], 0, 300).'</td>
 }
}

 $content .= '</tbody>

 </table><br>
 </div>
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
	       $(\'#complaint_history\').dataTable({
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
	       });
	       $(\'#email_history\').dataTable({
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
	       });
            });
        </script>

    ';

    $title	= 'Mailbox';
    $submenu	= "mailbox";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_STAFF.'logout.php');
    }

?>