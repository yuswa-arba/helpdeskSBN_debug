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
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Setting Email");
     global $conn;

     $id_mailbox	= isset($_GET['complaint_id']) ? mysql_real_escape_string(strip_tags(trim($_GET['complaint_id']))) : "";
     $sql_mailbox	= mysql_query("SELECT * FROM `gx_email` WHERE `ID` = '$id_mailbox' LIMIT 0,1;", $conn);
     $row_mailbox 	= mysql_fetch_array($sql_mailbox);
     $user_email	= $row_mailbox["EmailFrom"];
     
     $sql_user	= mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".$row_mailbox["customer_number"]."' AND `cNonAktiv` = '0' AND `level` = '0' LIMIT 0,1;", $conn);
     $row_user 	= mysql_fetch_array($sql_user);
     $user_id	= $row_user["cUserID"];
     //echo $user_id;

     /*<div role="tabpanel" class="tab-pane " id="footer">
			    
			      <div class="box">
				   <div class="box-header">
					<h2 class="box-title">List Footer</h2>
				   </div>
				 <a href="form_footer.php" class="btn bg-green btn-flat margin">Add Footer</a>
				   <div class="box-body">
				     <form action="" method="post" name="form_nonprospek" >
	 <div class="table-container">
	       <table class="table table-bordered table-striped" id="complaint_history" style="width: 100%;">
	       <thead>
	       <tr>
		 <th width="1%">No.</th>
		 <th width="10%">Nama Staff</th>
		 <th width="50%">Footer</th>
		 <th width="10%">User Add</th>
		 <th width="12%">Date Add</th>
		 <th width="7%">status</th>
		 <th width="10%">Action</th>
	       </tr>
	       </thead>
	       <tbody>';
	     
	     //<th>Message</th>
 
$sql_email_footer	= "SELECT * FROM `gx_email_footer` ORDER BY `date_add` DESC;";
$query_email_footer	= mysql_query($sql_email_footer, $conn);


$no = 1;
while ($row_footer = mysql_fetch_array($query_email_footer)) {
     $status ="";
     $status .= ($row_footer["active"] == "0") ? "Active" : '';
     $status .= ($row_footer["active"] == "1") ? "-" : '';
     
     $sql_staff = mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee` = '".$row_footer["id_employee"]."' LIMIT 0,1;", $conn);
     $row_staff = mysql_fetch_array($sql_staff);
     
	 $content .= '
	 <tr>
		     <td>'.$no.'</td>
		     <td>'.$row_staff["cNama"].'</td>
		     <td>'.substr($row_footer["footer"], 0, 50).'</td>
		     <td>'.$row_footer["user_add"].'</td>
		     <td>'.$row_footer["date_add"].'</td>
		     <td>'.$status.'</td>
		     <td>View || <a href="form_footer.php?id_footer='.$row_footer["id_footer"].'">Edit</a></td>
		    
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
			     </div>*/
     
$sql_email_setting	= "SELECT * FROM `gx_email_setting` WHERE `level` = '0';";
$query_email_setting	= mysql_query($sql_email_setting, $conn);
$row_setting 		= mysql_fetch_array($query_email_setting);

     $content ='<section class="content-header">
		     <h1>
			 Setting Email
		     </h1>
		     
		 </section>
 
		 <!-- Main content -->
		 
		 <section class="content">
		     <div class="row">
			 <div class="col-xs-12">
			    <ul class="nav nav-tabs" role="tablist" id="myTab">
				<!--<li role="presentation" ><a href="#footer" aria-controls="footer" role="tab" data-toggle="tab">Footer Email</a></li>-->
				<li role="presentation" class="active"><a href="#setting" aria-controls="setting" role="tab" data-toggle="tab">Setting Email</a></li>
				<li role="presentation"><a href="#category" aria-controls="category" role="tab" data-toggle="tab">Category Email</a></li>
			    </ul>
			    <div class="tab-content">
			    
			      
			     <div role="tabpanel" class="tab-pane active" id="setting">
			     <form role="form" method="POST" action="">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Email</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    
                                    <div class="box-body">
					<table class="form" width="70%">
					     <tbody><tr>
					       <td width="10%">
						 <label>Reply From</label>
					       </td>
					       <td width="30%">
						 <input type="text" placeholder="Email Reply From" class="form-control" name="re_from" value="'.$row_setting["reply_from"].'">
					       </td>
					     </tr>
					     <tr>
					       <td width="10%">
						 <label>Email</label>
					       </td>
					       <td width="30%">
						 <input type="text" placeholder="Email" class="form-control" name="email" value="'.$row_setting["email"].'">
					       </td>
					     </tr>
					     <tr>
					       <td width="10%">
						 <label>Email CC</label>
					       </td>
					       <td width="30%">
						 <input type="text" placeholder="Email" class="form-control" name="cc_email" value="'.$row_setting["cc_email"].'">
					       </td>
					     </tr>
						 <tr>
					       <td width="10%">
						 <label>Email BCC</label>
					       </td>
					       <td width="30%">
						 <input type="text" placeholder="Email" class="form-control" name="bcc_email" value="'.$row_setting["bcc_email"].'">
					       </td>
					     </tr>
					     <tr>
					       <td width="10%">
						 <label>Password</label>
					       </td>
					       <td width="30%">
						 <input type="password" placeholder="Password" class="form-control" name="pass" value="'.$row_setting["password"].'" style="width: 200px;">
					       </td>
					     </tr>
					     </tbody>
					</table>
					<div class="actions" align="center">
					     <div class="button-well">
						 <input type="submit" class="btn btn-success" data-icon="v" name="save" value="Save">
					     </div>
					</div>
	
                                    </div><!-- /.box-body -->

                                    
                                </div><!-- /.box-body -->
                                
                            </div><!-- /.box -->
			    </form>
			     </div>
			     
			     <div role="tabpanel" class="tab-pane" id="category">
			    
			      <div class="box">
				   <div class="box-header">
					<h2 class="box-title">List Category Email</h2>
				   </div>
				 <a href="form_category.php" class="btn bg-green btn-flat margin">Add Category</a>
				   <div class="box-body">
				     <form action="" method="post" name="form_nonprospek" >
	 <div class="table-container">
	       <table class="table table-bordered table-striped" id="complaint_history" style="width: 100%;">
	       <thead>
	       <tr>
		 <th width="1%">No.</th>
		 <th width="10%">Category</th>
		 <th width="50%">Desc</th>
		 <th width="10%">User Add</th>
		 <th width="12%">Date Add</th>
		 <th width="10%">Action</th>
	       </tr>
	       </thead>
	       <tbody>';
	     
	     //<th>Message</th>
 
$sql_email_kategori	= "SELECT * FROM `gx_email_kategori` ORDER BY `date_add` DESC;";
$query_email_kategori	= mysql_query($sql_email_kategori, $conn);


$no = 1;
while ($row_kategori = mysql_fetch_array($query_email_kategori)) {
     
	 $content .= '
	 <tr>
		     <td>'.$no.'</td>
		     <td>'.$row_kategori["nama_kategori"].'</td>
		     <td>'.substr($row_kategori["desc_kategori"], 0, 50).'</td>
		     <td>'.$row_kategori["user_add"].'</td>
		     <td>'.$row_kategori["date_add"].'</td>
		     <td><a href="form_category.php?id_category='.$row_kategori["id_kategori"].'">Edit</a></td>
		    
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
		     </div>
 
		 </section><!-- /.content -->
	     ';
	     
$save	= isset($_POST['save']) ? $_POST["save"] : "";
if($save == "Save"){
	  $re_from	= isset($_POST['re_from']) ? mysql_real_escape_string(strip_tags(trim($_POST['re_from']))) : "";
	  $email 	= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	  $bcc_email 	= isset($_POST['bcc_email']) ? mysql_real_escape_string(strip_tags(trim($_POST['bcc_email']))) : "";
	  $cc_email 	= isset($_POST['cc_email']) ? mysql_real_escape_string(strip_tags(trim($_POST['cc_email']))) : "";
	  $pass		= isset($_POST['pass']) ? mysql_real_escape_string(strip_tags(trim($_POST['pass']))) : "";
     
     $sql_update = "UPDATE `gx_email_setting` SET `level` = '1';";
	    //echo $sql_insert;
   
    mysql_query($sql_update, $conn) or die("<script language='JavaScript'>
				    alert('Maaf Data tidak bisa disimpan ke dalam Database, Ada kesalahan!');
				    window.history.go(-1);
			      </script>");
     
    $sql_insert = "INSERT INTO `gx_email_setting`(`email`, `bcc_email`, `cc_email`, `reply_from`, `password`, `level`)
	    VALUES('".$email."', '".$bcc_email."', '".$cc_email."', '".$re_from."', '".$pass."', '0')";
	    //echo $sql_insert;
   
    mysql_query($sql_insert, $conn) or die("<script language='JavaScript'>
				    alert('Maaf Data tidak bisa disimpan ke dalam Database, Ada kesalahan!');
				    window.history.go(-1);
			      </script>");
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "insert setting email = $sql_insert");
    echo "<script language='JavaScript'>
         alert('Data Telah tersimpan');
         location.href = 'setting_email.php';
      </script>";
   
}

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

    $title	= 'Setting Email';
    $submenu	= "setting";
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