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
if($loggedin["group"] == 'cso'){
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail complaint");
     global $conn;

     $id_mailbox	= isset($_GET['complaint_id']) ? mysql_real_escape_string(strip_tags(trim($_GET['complaint_id']))) : "";
     $sql_mailbox	= mysql_query("SELECT * FROM `gx_email` WHERE `ID` = '$id_mailbox' LIMIT 0,1;", $conn);
     $row_mailbox 	= mysql_fetch_array($sql_mailbox);
     $user_email	= $row_mailbox["EmailFrom"];
     
     $sql_user	= mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".$row_mailbox["customer_number"]."' AND `cNonAktiv` = '0' AND `level` = '0' LIMIT 0,1;", $conn);
     $row_user 	= mysql_fetch_array($sql_user);
     $user_id	= $row_user["cUserID"];
     $user_index = $row_user["iuserIndex"];
     //echo $user_id;
     //Data RBS
     $conn_soft2 = Config::getInstanceSoft();
     $sql_user_soft = $conn_soft2->prepare("SELECT [Users].*
					FROM [DRBSISP].[dbo].[Users]
					WHERE [Users].[UserIndex] = '".$user_index."';");

     $sql_user_soft->execute();
     $row_user_soft = $sql_user_soft->fetch();
     
     $content ='<section class="content-header">
		     <h1>
			 Detail Complaint
		     </h1>
		     
		 </section>
 
		 <!-- Main content -->
		 
		 <section class="content">
		     <div class="row">
			 <div class="col-xs-12">
			    <ul class="nav nav-tabs" role="tablist" id="myTab">
				<li role="presentation" class="active"><a href="#customer" aria-controls="customer" role="tab" data-toggle="tab">Detail Customer</a></li>
				<li role="presentation"><a href="#incoming" aria-controls="incoming" role="tab" data-toggle="tab">History Incoming Complaint</a></li>
				<li role="presentation"><a href="#emails" aria-controls="emails" role="tab" data-toggle="tab">History Email</a></li>
				<li role="presentation"><a href="#billing" aria-controls="billing" role="tab" data-toggle="tab">Billing</a></li>
			    </ul>
			    <div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="customer">
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
			      </div>
			      <div role="tabpanel" class="tab-pane" id="incoming">
			      <div class="box">
				   <div class="box-header">
					<h2 class="box-title">History Complaint</h2>
				   </div>
				 
				   <div class="box-body">
				     <form action="" method="post" name="form_nonprospek" >
	 <div class="table-container">
	       <table class="table table-bordered table-striped" id="complaint_history" style="width: 100%;">
	       <thead>
	       <tr>
		 <th>No.</th>
		 <th>Tanggal</th>
		 <th>Problem</th>
		 <th>Media</th>
		 <th>Status</th>
		 <th>Operator</th>
		 <th>Last Update</th>
	       </tr>
	       </thead>
	       <tbody>';
	     
	     //<th>Message</th>
 
if($row_user["cKode"] != "")
{
$sql_history_complaint	= "SELECT * FROM `gx_helpdesk_complaint`
			 WHERE `cust_number` = '".$row_user["cKode"]."'
			 ORDER BY `date_add` DESC;";
$query_history_complaint= mysql_query($sql_history_complaint, $conn);


$no = 1;
while ($row_complaint = mysql_fetch_array($query_history_complaint)) {
	  if($row_complaint["status"] == "open")
	  {
	       $status_complaint =  '<span class="label label-danger">Open</span>';
	  }elseif($row_complaint["status"] == "closed")
	  {
	       $status_complaint =  '<span class="label label-success">Closed</span>';
	  }elseif($row_complaint["status"] == "pending" || $row_complaint["status"] == "waiting")
	  {
	       $status_complaint =  '<span class="label label-warning">Waiting/Pending</span>';
	  }else
	  {
	       $status_complaint =  '<span class="label label-danger">no status</span>';
	  }
	 
	 $content .= '
	 <tr>
		     <td>'.$no.'</td>
		     <td>'.$row_complaint["date_add"].'</td>
		     <td><a href="detail_mincoming.php" onclick="return valideopenerform(\'detail_incoming.php?id_complaint='.$row_complaint['id_complaint'].'\',\'reply'.$row_complaint['id_complaint'].'\');">'.substr($row_complaint["problem"], 0, 50).'</a></td>
		     <td>'.$row_complaint["media"].'</td>
		     <td>'.$status_complaint.'</td>
		     <td>'.$row_complaint["created_by"].'</td>
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
			     </div>
			     <div role="tabpanel" class="tab-pane" id="emails">
			     <div class="box">
				   <div class="box-header">
					<h2 class="box-title">History Email</h2>
				   </div>
				 
				   <div class="box-body">
	 <div class="table-container">
	       <table class="table table-bordered table-striped" id="email_history" style="width: 100%;">
	       <thead>
	       <tr>
		 <th>No.</th>
		 <th>Tanggal</th>
		 <th>Messagge</th>
		 <th>Status</th>
		 <th>Operator</th>
		 <th>Last Update</th>
	       </tr>
	       </thead>
	       <tbody>';
	     
	     //<th>Message</th>
 
if($row_user["cKode"] !="")
{
$sql_history_email	= "SELECT * FROM `gx_email` WHERE `EmailFrom` LIKE '%".$user_email."%'
			 ORDER BY `date_add` DESC; ";
$query_history_email	= mysql_query($sql_history_email, $conn);

$noe = 1;
while ($row_email = mysql_fetch_array($query_history_email)) {
     $sql_status_reply = mysql_num_rows(mysql_query("SELECT * FROM `gx_email_reply`
						   WHERE `id_email` = '".$row_email["ID"]."';", $conn));
     $row_status_reply = mysql_fetch_array(mysql_query("SELECT * FROM `gx_email_reply`
						   WHERE `id_email` = '".$row_email["ID"]."';", $conn));
    
	 $content .= '
	 <tr>
	       <td>'.$noe.'</td>
	       <td>'.$row_email["date_add"].'</td>
	       <td><a href="detail_mail.php" onclick="return valideopenerform(\'detail_mail.php?id='.$row_email['ID'].'\',\'reply'.$row_email['ID'].'\');">'.substr($row_email["Message"], 0, 50).'</a></td>
	       <td>'.(($sql_status_reply >= 1) ? '<a href="reply.php?id='.$row_email['ID'].'" onclick="return valideopenerform(\'reply.php?id='.$row_email['ID'].'\',\'reply'.$row_email["ID"].'\');"><span class="label label-success">replied</span></a>'
		      : '<span class="label label-warning">not replied</span>').'</td>
	       <td>'.$row_status_reply["user_add"].' </td>
	       <td>'.(($sql_status_reply >= 1) ? 'Last updated by:'.$row_status_reply["user_add"].' ('.$row_status_reply["date_add"].')' : '').'</td>
		     
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
			     
			     <div role="tabpanel" class="tab-pane" id="billing">
				   <div class="box">
					 <div class="box-header">
					      <h2 class="box-title">Data Billing</h2>
					 </div>
				       
					 <div class="box-body">
					 <div class="table-container">
					 <div>
					 <p>Balance: <b>'.number_format(round($row_user_soft["UserPaymentBalance"], 2), 2).'</b></p>
					 </div>
					 
	       <table class="table table-bordered table-striped" id="billingtransaksi" style="width: 100%;">
	       <thead>
	       <tr>
		 <th>No.</th>
		 <th>Transaction Number</th>
		 <th>Tanggal</th>
		 <th>Credit</th>
		 <th>Debet</th>
		 
	       </tr>
	       </thead>
	       <tbody>';
//<th>Balance</th>
     $conn_soft = Config::getInstanceSoft();
     
     $sql_billing_transaksi = $conn_soft->prepare("SELECT *
						  FROM (SELECT TOP 10 [BillingTransactions].*
						  FROM [DRBSISP].[dbo].[Users], [DRBSISP].[dbo].[BillingTransactions]
						  WHERE [Users].[UserIndex] = [BillingTransactions].[UserIndex]
						  AND [Users].[UserIndex] = '".$user_index."'
						  ORDER BY [BillingTransactions].[BillingTransactionIndex] DESC) as tabel1
						  ORDER BY [tabel1].[BillingTransactionIndex] ASC");
     
     $sql_billing_transaksi->execute();
     //$row_billing_transaksi = $sql_billing_transaksi->fetch();
     $row_billing_transaksi = $sql_billing_transaksi->fetchAll(PDO::FETCH_ASSOC);
     $no = 1;
     $total = 0;

foreach ($row_billing_transaksi as $rows)
{
     $total = $total + $rows["Total"];
     if($rows["TransType"] == "2")
     {
	  $kode = "#payment_";
	  $url = $kode.$rows["BillingTransactionIndex"];
     }elseif($rows["TransType"] == "1")
     {
	  $kode = "#invoice_";
	  $url = '<a href="data_bill.php?id_invoice='.$rows["BillingTransactionIndex"].'&c='.$row_user["cKode"].'"
	  onclick="return valideopenerform(\'data_bill.php?id_invoice='.$rows["BillingTransactionIndex"].'&c='.$row_user["cKode"].'\',\'detail'.$rows["BillingTransactionIndex"].'\');">
	  '.$kode.$rows["BillingTransactionIndex"].'</a>';
     }
     
     $content .='<tr>
		 <td>'.$no.'.</td>
		 <td>'.$url.'</td>
		 <td>'.date("d-m-Y", strtotime($rows["CreateDate"])).'</td>
		 <td>'.(($rows["TransType"] == "2") ? number_format(round(str_replace("-", "", $rows["Total"]), 2), 2) : "0").'</td>
		 <td>'.(($rows["TransType"] == "1") ? number_format(round(str_replace("-", "",$rows["Total"]), 2), 2) : "0").'</td>
		 
	       </tr>';
     //<td>'.number_format(round($total,2), 2).'</td>
     $no++;
}

			 $content .='</div>
				    </div>
			      </div>
			      
			     </div>
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
	<script>
	    $(function () {
	      $(\'#myTab a:first\').tab(\'show\')
	    })
	</script>

    ';

    $title	= 'Mailbox';
    $submenu	= "mailbox";
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