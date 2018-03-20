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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Troubleticket");
    global $conn;
    global $conn_voip;
    
$sql_last_data  = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint` WHERE `date_add` LIKE '".date("Y-m-d")."%' ORDER BY `date_add` DESC", $conn)) + 1;
 //echo date("Y-m-d H:i:s");   
	    if(isset($_GET['id_troubleticket'])){
		$get_id = isset($_GET['id_troubleticket']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_troubleticket']))) : "";
		$data_troubleticket = mysql_fetch_array(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
							  WHERE `gx_helpdesk_complaint`.`id_complaint` = '$get_id';", $conn));
	    }elseif(isset($_GET['id_email'])){
		$get_id_mail = isset($_GET['id_email']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_email']))) : "";
		$data_email_troubleticket = mysql_fetch_array(mysql_query("SELECT * FROM `gx_email`
							  WHERE `gx_email`.`ID` = '$get_id_mail';", $conn));
		$data_complaint = mysql_fetch_array(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
							  WHERE `gx_helpdesk_complaint`.`id_email` = '$data_email_troubleticket[ID]' ORDER BY `id_email` DESC;", $conn));
	    }
    
    $sql_parent = mysql_query("SELECT * FROM `gx_email_kategori` ORDER BY `id_kategori` DESC;",$conn);
    $content ='<section class="content-header">
                    <h1>
                        Form Trouble Ticket
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box">
				
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_troubleticket">
	  
	  <input type="hidden" style="" name="ID" value="'.(isset($_GET['id_email']) ? $_GET['id_email'] : "").'" />
          
	<div >
	    <fieldset>
		<legend>Data Customer</legend>
		<div class="table-container table-form">
		    <!--<a href="'.URL_STAFF.'helpdesk/data_cust.php?r=form_troubleticket" class="btn btn-sm bg-navy btn-flat margin pull-right"
						onclick="return valideopenerform(\''.URL_STAFF.'helpdesk/data_cust.php?r=form_troubleticket\',\'troubleticket\');">Search Customer</a>
		    <br>-->
		    <table class="form" width="100%">
		      <tbody><tr>
			<td width="12.5%">
			  <label>Ticket Number*</label>
			</td>
			<td width="37.5%">
			  <input type="text" readonly="" style="" name="troubleticket" value="GCT-'.date("dmy").sprintf("%04d", $sql_last_data).'" />
			</td>
		      </tr>
		      <tr>
			<td width="12.5%">
			  <label>User ID*</label>
			</td>
			<td width="37.5%">
			  <input class="form-control" readonly="" name="id_troubleticket" placeholder="ID Complaint" type="hidden" value="'.(isset($_GET["id_email"]) ? $_GET["id_email"] :"") .'" readonly="">
			  <input class="form-control required" readonly="" name="user_id" id="user_id" placeholder="User ID" type="text" value="'.(isset($_GET["id_email"]) ? $data_complaint['user_id'] :"") .'" >
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Customer Number*</label>
			</td>
			<td>
			  <input class="form-control" readonly="" name="customer_number" id="customer_number" placeholder="Customer Number" type="text" value="'.(isset($_GET["id_email"]) ? $data_complaint['cust_number'] :"") .'" >
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Name</label>
			</td>
			<td>
			  <input class="form-control" readonly="" name="name" placeholder="Name" type="text" value="'.(isset($_GET["id_email"]) ? $data_complaint['name'] :"") .'" >
			</td>
		      </tr>
		      <tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Address</label>
			</td>
			<td>
			  <textarea name="address" readonly="" rows="3" cols="70" class="" style="resize: none;">'.(isset($_GET["id_email"]) ? $data_complaint['address'] :"") .'</textarea>
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Phone</label>
			</td>
			<td>
			  <input class="form-control" readonly="" name="phone" placeholder="Phone" type="text" value="'.(isset($_GET["id_email"]) ? $data_complaint['phone'] :"") .'" >
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Email</label>
			</td>
			<td>
			  <input class="form-control" readonly="" name="email" placeholder="Email" type="text" value="'.(isset($_GET["id_email"]) ? $data_complaint['email'] :"") .'" >
			</td>
		      </tr>
		      
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
			    <input class="form-control" name="complaint_type" placeholder="complaint type" type="text" value="'.$data_complaint["complaint_type"].'" readonly="">
			    
			</td>
		      </tr>
		      
		      <tr>
			<td>
			  <label>Which Side</label>
			</td>
			<td>
			  <input class="form-control" name="which_side" placeholder="which side" type="text" value="'.$data_complaint["which_side"].'" readonly="">
			  
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Status</label>
			</td>
			<td>
			    <input class="form-control" name="status" placeholder="status" type="text" value="'.$data_complaint["status"].'" readonly="">
			    
			</td>
		      </tr>
		      <tr>
			    <td>
			      <label>Action</label>
			    </td>
			    <td>
				<input class="form-control" name="action" placeholder="action" type="text" value="'.$data_complaint["action"].'" readonly="">
				
			    </td>
		      </tr>
		      <tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Problem</label>
			</td>
			<td>
			  <textarea class="required" name="problem" rows="3" cols="70" style="resize: none;">'.(isset($_GET["id_email"]) ? $data_complaint['problem'] :"") .'</textarea>
			</td>
		      </tr>
		      <tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Note</label>
			</td>
			<td>
			  <input class="medium" name="id_ticket" placeholder="ID Ticket" type="hidden" value="'.(isset($_GET["id_email"]) ? $data_complaint['ticket_number'] :"") .'" readonly="">
			  <textarea name="note_" id="note_" rows="6" cols="40" style="resize: none;">'.(isset($_GET["id_email"]) ? $data_complaint['note_'] :"") .' '.(isset($_GET['threadid']) ?  $data_note_chat : '').' </textarea>
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Create SPK</label>
			</td>
			<td>
			  <input class="required" type="radio" id="spk" name="spk" value="spk" style="float:left;" '.((isset($_GET["id_email"]) && $data_complaint["spk"]== "spk" ) ? "checked" :"") .'> Yes 
			  <input class="required" type="radio" id="nonspk" name="spk" value="nonspk" style="float:left;" '.((isset($_GET["id_email"]) && $data_complaint["spk"]== "nonspk" ) ? "checked" :"") .'> No
			</td>
		      </tr>
		      <tr>
			    <td>
			      <label>Priority</label>
			    </td>
			    <td>
				<select name="priority" style="width:200px;">
				    <option value="0" '.((isset($_GET["id_email"]) && $data_complaint["priority"]== "0" ) ? 'selected="selected"' :"") .'>-</option>
				    <option value="1" '.((isset($_GET["id_email"]) && $data_complaint["priority"]== "1" ) ? 'selected="selected"' :"") .'>HIGH</option>
				    <option value="2" '.((isset($_GET["id_email"]) && $data_complaint["priority"]== "2" ) ? 'selected="selected"' :"") .'>MEDIUM</option>
				    <option value="3" '.((isset($_GET["id_email"]) && $data_complaint["priority"]== "3" ) ? 'selected="selected"' :"") .'>LOW</option>
				</select>
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
	       
	      
	      <input name="created_by" value="'.$loggedin["username"].'" type="hidden">
	      <input name="id_employee" value="'.$loggedin["id_employee"].'" type="hidden">
            </div>
	    </fieldset>
	    </div>
	
	<div class="actions">
	    <div class="button-well">
		<input type="submit" class="button button-primary" data-icon="v" name="save" value="Save">
	    </div>
	</div>
	
	</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$save = isset($_POST["save"]) ? $_POST["save"] : "";

	if($save == "Save"){
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
	    $priority 		= isset($_POST['priority']) ? mysql_real_escape_string(strip_tags(trim($_POST['priority']))) : "";
		    
		$insert_troubleticket    	= "UPDATE `gx_helpdesk_complaint` SET `note_` = '$note_', `problem` = '$problem',`priority` = '$priority', `trouble_ticket` = '1',
							   `spk` = '$spk',`date_upd` = NOW(), `updated_by` = '$loggedin[username]'
							   WHERE `gx_helpdesk_complaint`.`id_email` = $ID;";
		//echo $insert_troubleticket;
		mysql_query($insert_troubleticket, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		//enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert Complaint = $insert_troubleticket");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'incoming.php?type=troubleticket';
		</script>";
	}
$plugins = '';

    $title	= 'Form Incoming';
    $submenu	= "helpdesk_troubleticket";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>