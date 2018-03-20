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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Mailbox");
    global $conn;
    global $conn_voip;
    
    
 //echo date("Y-m-d H:i:s");
    $id_mailbox	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
    
    $sql_email = mysql_query("SELECT `ID`, `EmailFrom`, `EmailFromP`, `EmailTo`, `DateE`, `DateDb`, `DateRead`, `DateRe`, `Subject`, `Message`, `Message_html`,`id_kategori`, `customer_number`, `userid`, `id_complaint`
			 FROM `gx_email`
			 WHERE `ID` = '".$id_mailbox."'
			 LIMIT 0,1;",$conn);

    $email = mysql_fetch_array($sql_email);
    
    $sql_customer = mysql_query("SELECT * FROM `tbCustomer`
			 WHERE `cKode` = '$email[customer_number]'
			 LIMIT 0,1;",$conn);
    $dcustomer = mysql_fetch_array($sql_customer);
    
    
    
    $sql_parent = mysql_query("SELECT * FROM `gx_email_kategori` ORDER BY `id_kategori` DESC;",$conn);
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
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_mailbox">
	  <input type="hidden" style="" name="troubleticket" value="'.$email["id_complaint"].'" />
	  <input type="hidden" style="" name="ID" value="'.$email["ID"].'" />
          <table id="LBL_PROJECT_INFORMATION" class="form" cellspacing="0" style="margin-bottom: 0;">
	    <tbody>
	    <tr>
		<td width="12.5%" scope="col">
		    Name:
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="name">'.$email["EmailFromP"].'</span>
		</td>
		
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Email:
		</td>
		<td width="37.5%">
		    '.$email["EmailFrom"].'
		</td>
		
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date:
		</td>
		<td width="37.5%" colspan="3">
		    '.$email["DateE"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Subject:
		</td>
		<td width="37.5%" colspan="3">
		    '.$email["Subject"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Body:
		</td>
		<td width="37.5%" colspan="3">
		    '.$email["Message_html"].'
		</td>
	    </tr>
	    <tr>
		<td colspan="2">
		    &nbsp;
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Kategori:
		</td>
		<td width="37.5%" colspan="3">
		   ';
		    
		    while($row_parent = mysql_fetch_array($sql_parent)){
			
			$content .='<input id="'.$row_parent["id_kategori"].'" '.(($row_parent["id_kategori"] == $email["id_kategori"]) ? 'checked=""' :"").' type="radio" name="id_kategori" value="'.$row_parent["id_kategori"].'" /> '.$row_parent["nama_kategori"].' ';
			//$content .='<option value="'.$row_parent["id_kategori"].'" '.(($row_parent["id_kategori"]== $email["id_kategori"]) ? 'selected="selected"' :"") .'>'.$row_parent["nama_kategori"].'</option>';/*
		    }
			
			
		    $content .='
		</td>
	    </tr>
	    <tr>
		<td colspan="2">
		    &nbsp;
		</td>
	    </tr>
	    </tbody>
	</table>
	<div id="form_problem" '.(($email["id_kategori"] == "2" || $email["id_kategori"] == "3") ? '' : 'style="display:none;"').' >
	    <fieldset>
		<legend>Data Customer:</legend>
		<div class="table-container table-form">

                    <br>
		    <table class="form" width="100%">
		      <tbody><tr>
			<td width="12.5%">
			  <label>User ID*</label>
			</td>
			<td width="37.5%">
			  <input class="form-control" name="id_complaint" placeholder="ID Complaint" type="hidden" value="" readonly="">
			  <input class="form-control required" name="user_id" id="user_id" placeholder="User ID" type="text" value="'.(($email["customer_number"]!= "") ? $dcustomer["cUserID"] :"").'" >
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Customer Number*</label>
			</td>
			<td>
			  <input class="form-control" name="customer_number" id="customer_number" placeholder="Customer Number" type="text" value="'.(($email["customer_number"]!= "") ? $dcustomer["cKode"] :"").'" >
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Name</label>
			</td>
			<td>
			  <input class="form-control" name="name" placeholder="Name" type="text" value="'.(($email["customer_number"]!= "") ? $dcustomer["cNama"] :"").'" >
			</td>
		      </tr>
		      <tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Address</label>
			</td>
			<td>
			  <textarea name="address" rows="3" cols="70" class="" style="resize: none;">'.(($email["customer_number"]!= "") ? $dcustomer["cAlamat1"] :"").'</textarea>
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Phone</label>
			</td>
			<td>
			  <input class="form-control" name="phone" placeholder="Phone" type="text" value="'.(($email["customer_number"]!= "") ? $dcustomer["ctelp"] :"").'" >
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Email</label>
			</td>
			<td>
			  <input class="form-control" name="email" placeholder="Email" type="text" value="'.(($email["customer_number"]!= "") ? $dcustomer["cEmail"] :"").'" >
			</td>
		      </tr>
		      <!--<tr>
			<td>
			  <label>Connection Type</label>
			</td>
			<td>
			  <input class="form-control" name="connection_type" placeholder="Connection Type" type="text" value="">
			</td>
		      </tr>-->
		      
		      <tr>
			<td colspan="2">
			  
			</td>
		      </tr>
		      <tr>
			<td colspan="2">
			<legend>Data Complaint:</legend>
			  
			</td>
		      </tr>
		     	    
		    <tr>
			<td colspan="2">
			  
			</td>
		      </tr>

			<tr>
			    <td>
			      <label>Media Complaint</label>
			    </td>
			    <td>
				<input class="form-control" name="media" placeholder="Email" type="text" value="email" readonly="">
			    </td>
		      </tr>
		      
		      <tr>
			<td>
			  <label>Complaint Type</label>
			</td>
			<td>
			    <input class="required" type="radio" name="complaint_type" value="request" style="float:left;"> Request <a href="#" title="Hint." class="tooltip"><span title="Hint"> [?] </span></a>
			    <input class="required" type="radio" name="complaint_type" value="problem" style="float:left;"> Problem</font>
			</td>
		      </tr>
		      
		      <tr>
			<td>
			  <label>Which Side</label>
			</td>
			<td>
			  <input class="required" type="radio" name="which_side" value="wireless" style="float:left;"> Customer
			  <input class="required" type="radio" name="which_side" value="isp" style="float:left;"> ISP 
			  <input class="required" type="radio" name="which_side" value="none" style="float:left;">  None 
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Status</label>
			</td>
			<td>
			    <select class="required" name="status" style="width:200px;">
				<option value="">Choose one</option>
				<option value="open">Open</option>
				<option value="closed">Closed</option>
				<option value="reopen">Reopen</option>
			    </select>
			</td>
		      </tr>
		      <tr>
			    <td>
			      <label>Action</label>
			    </td>
			    <td>
				<select name="action" style="width:200px;">
				    <option value="">--</option>
				    <option value="Handled by CSO">Handled by CSO</option>
				    <option value="Request Trouble Ticket">Request Trouble Ticket</option>
				    
				</select>
				
			    </td>
		      </tr>
		      <tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Problem</label>
			</td>
			<td>
			  <textarea class="required" name="problem" rows="3" cols="70" style="resize: none;">'.$email["Message"].' </textarea>
			</td>
		      </tr>
		      <tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Note</label>
			</td>
			<td>
			  <input class="medium" name="id_ticket" placeholder="ID Ticket" type="hidden" value="" readonly="">
			  <textarea name="note_" id="note_" rows="3" cols="70" style="resize: none;">  </textarea>
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Create SPK</label>
			</td>
			<td>
			  <input class="required" type="radio" id="spk" name="spk" value="spk" style="float:left;"> Yes
			  <input class="required" type="radio" id="nonspk" name="spk" value="nonspk" style="float:left;"> No
			</td>
		      </tr>
		      
		    </tbody></table>
		      
		      <div id="form_spk" style="display:none;">
		      <table class="form" width="100%">
			<tr style="vertical-align: middle;">
			  <td style="vertical-align: middle;" width="12.5%">
			    <label>Solusi</label>
			  </td>
			  <td width="37.5%">
			    <input class="medium" name="id_ticket" placeholder="ID Ticket" type="hidden" value="" readonly="">
			    <textarea name="solusi" id="note_" rows="3" cols="70" style="resize: none;">  </textarea>
			  </td>
			</tr>
			</tbody></table>
		      </div><br />
	       
	      
	      <input name="created_by" value="admin" type="hidden">
	      <input name="id_employee" value="1" type="hidden">
            </div>
	    </fieldset>
	    </div>
	
	<div class="actions">
	    <div class="button-well">
		<input type="submit" class="button button-primary" data-icon="v" name="update" value="Save">
	    </div>
	</div>
	
	</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$submit = isset($_POST["update"]) ? $_POST["update"] : "";

	if($submit == "Save"){
	    $ID 		= isset($_POST["ID"]) ? $_POST["ID"] : "";
	    $troubleticket	= isset($_POST["troubleticket"]) ? $_POST["troubleticket"] : "";
	    $kategori 		= isset($_POST["id_kategori"]) ? $_POST["id_kategori"] : "";
	    
	    $user_id		= isset($_POST['user_id']) ? mysql_real_escape_string(strip_tags(trim($_POST['user_id']))) : "";
	    $cust_number	= isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
	    $name		= isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
	    $address 		= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	    $phone		= isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
	    $email		= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	    
	    $media	 	= isset($_POST['media']) ? mysql_real_escape_string(strip_tags(trim($_POST['media']))) : "";
	    $complaint_type	= isset($_POST['complaint_type']) ? mysql_real_escape_string(strip_tags(trim($_POST['complaint_type']))) : "";
	    $which_side		= isset($_POST['which_side']) ? mysql_real_escape_string(strip_tags(trim($_POST['which_side']))) : "";
	    $status 		= isset($_POST['status']) ? mysql_real_escape_string(strip_tags(trim($_POST['status']))) : "";
	    $action 		= isset($_POST['action']) ? mysql_real_escape_string(strip_tags(trim($_POST['action']))) : "";
	    $problem 		= isset($_POST['problem']) ? mysql_real_escape_string(strip_tags(trim($_POST['problem']))) : "";
	    $note_		= isset($_POST['note_']) ? mysql_real_escape_string(strip_tags(trim($_POST['note_']))) : "";
	    $spk 		= isset($_POST['spk']) ? mysql_real_escape_string(strip_tags(trim($_POST['spk']))) : "";
	    $solusi 		= isset($_POST['solusi']) ? mysql_real_escape_string(strip_tags(trim($_POST['solusi']))) : "";
	    
	    $update    = "UPDATE `gx_email` SET `id_kategori` = '".$kategori."', `date_upd` = NOW(), `user_upd` = '$loggedin[username]'  WHERE `ID`='".$ID."'";
	    mysql_query($update, $conn)or die("<script language='JavaScript'>
							    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							    window.history.go(-1);
						    </script>");
	    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update Mailbox = $update");
	    if($kategori == '2' || $kategori == '3'){
		 $sql_complaint = mysql_query("SELECT * FROM `gx_helpdesk_complaint`;",$conn);
		    while($complaint = mysql_fetch_array($sql_complaint)){
			$id_email    = $complaint["id_email"];
		    }
		if($id_email != $ID){
		    
		$insert_complaint    	= "INSERT INTO `gx_helpdesk_complaint` (`id_complaint`, `user_id`, `ticket_number`, `id_email`, `cust_number`,
									     `name`, `email`, `address`, `phone`, `media`, `note_`, `type_client`, `problem`,
									     `spk`, `solusi`, `status`, `action`, `which_side`, `complaint_type`,
									     `id_cso`, `created_by`, `updated_by`, `date_add`, `date_upd`, `level`)
								     VALUES ('', '$user_id', '$troubleticket', '$ID', '$cust_number',
									     '$name', '$email', '$address', '$phone', '$media', '$note_', 'client', '$problem',
									     '$spk', '$solusi', '$status', '$action', '$which_side', '$complaint_type',
									     '$loggedin[id_employee]', '$loggedin[username]', '$loggedin[username]', NOW(), NOW(), '0');";
		//echo $insert_complaint;
		mysql_query($insert_complaint, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		   enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert Complaint Media Email = $insert_complaint");
		
		}else{
		    echo "<script language='JavaScript'>
			    alert('Data Mailbox Sudah Masuk Complait!');
			    window.close();
			</script>";
		}
	    }
	    
	    echo "<script language='JavaScript'>
			alert('Data telah diupdate!');
			window.close();
            </script>";  
	}
$plugins = '
<script type="text/javascript">
$(document).ready(function () {
    $(\'#2\').on(\'ifChecked\', function(event){
	$(\'#form_problem\').show(\'fast\');
    });
    
    $(\'#3\').on(\'ifChecked\', function(event){
	$(\'#form_problem\').show(\'fast\');
    });
    
    $(\'#1\').on(\'ifChecked\', function(event){
        
	$(\'#form_problem\').hide(\'fast\');
    });
    
    $(\'#4\').on(\'ifChecked\', function(event){
	$(\'#form_problem\').hide(\'fast\');
    });
    
    $(\'#5\').on(\'ifChecked\', function(event){
	$(\'#form_problem\').hide(\'fast\');
    });
});
</script>

<script type="text/javascript">
$(document).ready(function () {
    $(\'#spk\').on(\'ifChecked\', function(event){
	$(\'#form_spk\').hide(\'fast\');
    });
    
    $(\'#nonspk\').on(\'ifChecked\', function(event){
	$(\'#form_spk\').show(\'fast\');
    });
   
});
</script>
    
    ';

    $title	= 'Form Mailbox';
    $submenu	= "Mailbox";
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