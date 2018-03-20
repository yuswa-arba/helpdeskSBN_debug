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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Data Trouble ticket");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data TroubleTicket
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data TroubleTicket</h2>
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
	$sql_userid	= ($user_id != "") ? "AND`user_id` LIKE '%".$user_id."%'": "";
	$sql_address	= ($address != "") ? "AND `address` LIKE '%".$address."%'": "";
	$sql_email	= ($email != "") ? "AND `email` LIKE '%".$email."%'" : "";
	$sql_phone	= ($phone != "") ? "AND `phone` LIKE '%".$phone."%'" : "";
	
	$sql_troubleticket	= "SELECT * FROM `gx_helpdesk_complaint`
	WHERE `gx_helpdesk_complaint`.`status` = 'open'
	AND `gx_helpdesk_complaint`.`cust_number` LIKE '".$customer_number."%' 
	AND `gx_helpdesk_complaint`.`spk` = 'spk'
	AND `gx_helpdesk_complaint`.`trouble_ticket` = '1'
	$sql_nama
	$sql_userid
	$sql_address
	$sql_email
	$sql_phone
	ORDER BY `gx_helpdesk_complaint`.`date_add` DESC ;";
	echo $sql_troubleticket;
	}else{
	  $sql_troubleticket	= "SELECT * FROM `gx_helpdesk_complaint`
	 WHERE `gx_helpdesk_complaint`.`status` = 'open'
	 AND `gx_helpdesk_complaint`.`trouble_ticket` = '1'
	 AND `gx_helpdesk_complaint`.`spk` = 'spk'
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


$query_troubleticket	= mysql_query($sql_troubleticket, $conn);
$no = 1;
//echo $sql_customer;
    while ($row_troubleticket = mysql_fetch_array($query_troubleticket)) {
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_troubleticket["ticket_number"].'</td>
		    <td>'.$row_troubleticket["cust_number"].'</td>
                    <td>'.$row_troubleticket["user_id"].'</td>
		    <td>'.$row_troubleticket["name"].'</td>
		    
		    <!--<td>'.$row_troubleticket["email"].'</td>
		    <td>'.$row_troubleticket["phone"].'</td>
		    <td></td>-->
                    <td>
                      <a href="" onclick="validepopupform3(\''.$row_troubleticket["user_id"].'\',\''.$row_troubleticket["cust_number"].'\',\''.$row_troubleticket["name"].'\',\''.$row_troubleticket["address"].'\',\''.$row_troubleticket["phone"].'\',\''.$row_troubleticket["email"].'\',\''.mysql_real_escape_string($row_troubleticket["problem"]).'\',\''.$row_troubleticket["ticket_number"].'\',\''.$row_troubleticket["id_complaint"].'\')">Select</a>
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
                window.opener.document.'.$return_form.'.ticket_number.value=cTrouble;
		window.opener.document.'.$return_form.'.user_id.value=uid;
                window.opener.document.'.$return_form.'.customer_number.value=custNumber;
		window.opener.document.'.$return_form.'.name.value=nama;
		window.opener.document.'.$return_form.'.address.value=alamat;
		window.opener.document.'.$return_form.'.phone.value=ctelp;
		window.opener.document.'.$return_form.'.email.value=cemail;
		window.opener.document.'.$return_form.'.problem.value=cProblem;
		window.opener.document.'.$return_form.'.id_complaint.value=id_complaint;
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

    $title	= 'Data Trouble ticket';
    $submenu	= "helpdesk_spktech";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>