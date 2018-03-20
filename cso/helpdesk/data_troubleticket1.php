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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Mailbox");
    global $conn;

    
  
    $content ='<section class="content-header">
                    <h1>
                        SPK
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="form_spk">Form Spk</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Form SPK</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="100%">
		      <tr>
			<td>
			  <label>User ID *</label>
			</td>
			<td>
			  <input class="form-control" name="user_id" placeholder="User ID" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Customer Number</label>
			</td>
			<td>
			  <input class="form-control" name="customer_number" placeholder="Customer Number" type="text" value="GNB-">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Name</label>
			</td>
			<td>
			  <input class="form-control" name="name" placeholder="Name" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Address</label>
			</td>
			<td>
			  <textarea name="address" rows="4" cols="50" style="resize: none;"></textarea>
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Phone</label>
			</td>
			<td>
			  <input class="form-control" name="phone" placeholder="Phone" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Email</label>
			</td>
			<td>
			  <input class="form-control" name="email" placeholder="Email" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>&nbsp;</td>
			<td>
			  <input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
			</td>
		      </tr>
		</table>';
	if(isset($_POST["save_search"])){
	$user_id	= isset($_POST['user_id']) ? mysql_real_escape_string(strip_tags(trim($_POST['user_id']))) : "";
	$customer_number= isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
	$name		= isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
	//$title	= isset($_POST['title']) ? mysql_real_escape_string(strip_tags(trim($_POST['title']))) : "";
	$address 	= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$phone	 	= isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
	$email	 	= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	
	
	$sql_nama	= ($name != "") ? "AND `name` LIKE '".$name."%'": "";
	$sql_userid	= ($user_id != "") ? "AND`userid` LIKE '%".$user_id."%'": "";
	$sql_address	= ($address != "") ? "AND `address` LIKE '%".$address."%'": "";
	$sql_email	= ($email != "") ? "AND `email` LIKE '%".$email."%'" : "";
	$sql_phone	= ($phone != "") ? "AND `phone` LIKE '%".$phone."%'" : "";
	
	$sql_customer	= "SELECT * FROM `gx_helpdesk_complaint`
	WHERE `gx_helpdesk_complaint`.`status` = 'open' AND
	`gx_helpdesk_complaint`.`cust_number` LIKE '".$customer_number."%' AND
	`gx_helpdesk_complaint`.`spk` = 'spk'
	$sql_nama
	$sql_userid
	$sql_address
	$sql_email
	$sql_phone
	ORDER BY `gx_helpdesk_complaint`.`date_add` DESC ;";
	//echo $sql_customer;
	}else{
	  $sql_customer	= "SELECT * FROM `gx_helpdesk_complaint`
	 WHERE `gx_helpdesk_complaint`.`status` = 'open' 
	 ORDER BY `gx_helpdesk_complaint`.`date_add` DESC ;";
	}
		$content .='<table class="table table-bordered table-striped" id="toubleticket">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Trouble Ticket Number</th>
		    <th>Customer Number</th>
		    <th>User ID</th>
		    <th>Name</th>
		    
		    <!--<th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>-->
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_customer	= mysql_query($sql_customer, $conn);
$no = 1;
//echo $sql_customer;
    while ($row_customer = mysql_fetch_array($query_customer)) {
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_customer["ticket_number"].'</td>
		    <td>'.$row_customer["cust_number"].'</td>
                    <td>'.$row_customer["user_id"].'</td>
		    <td>'.$row_customer["name"].'</td>
		    
		    <!--<td>'.$row_customer["email"].'</td>
		    <td>'.$row_customer["phone"].'</td>
		    <td></td>-->
                    <td>
                      <a href="" onclick="validepopupform3(\''.$row_customer["user_id"].'\',\''.$row_customer["cust_number"].'\',\''.$row_customer["name"].'\',\''.$row_customer["address"].'\',\''.$row_customer["phone"].'\',\''.$row_customer["email"].'\',\''.$row_customer["problem"].'\',\''.$row_customer["ticket_number"].'\',\''.$row_customer["id_complaint"].'\')">Select</a>
                    </td>
                  </tr>';
	$no++;
    }
		
                  $content .='
                  
                </tbody>
              </table>';
	      




		
		$content .='</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '

<script type=\'text/javascript\'>
	function validepopupform3(uid, custNumber, nama, alamat,ctelp, cemail, cProblem, cTrouble, id_complaint){
                window.opener.document.form_spk.ticket_number.value=cTrouble;
		window.opener.document.form_spk.user_id.value=uid;
                window.opener.document.form_spk.customer_number.value=custNumber;
		window.opener.document.form_spk.name.value=nama;
		window.opener.document.form_spk.address.value=alamat;
		window.opener.document.form_spk.phone.value=ctelp;
		window.opener.document.form_spk.email.value=cemail;
		window.opener.document.form_spk.problem.value=cProblem;
		window.opener.document.form_spk.id_complaint.value=id_complaint;
		self.close();
        }
</script>
<style>
 .form-control {
  width: 53%;
 }
</style>
<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#toubleticket\').dataTable({
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

    $title	= 'Form Mailbox';
    $submenu	= "Mailbox";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_CSO."logout.php");
    }

?>