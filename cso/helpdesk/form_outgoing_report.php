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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Outgoing Report");
    global $conn;
    
    
$sql_last_data  = mysql_num_rows(mysql_query("SELECT * FROM `gx_outgoing_report` WHERE `date_add` LIKE '".date("Y-m-d")."%' ORDER BY `date_add` DESC", $conn)) + 1;
 //echo date("Y-m-d H:i:s");   
	    if(isset($_GET['id_outgoing'])){
		$get_id = isset($_GET['id_outgoing']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_outgoing']))) : "";
		$data_complaint = mysql_fetch_array(mysql_query("SELECT * FROM `gx_outgoing_report`
							  WHERE `gx_outgoing_report`.`id_outgoing_report` = '$get_id';", $conn));
	    }
    
    $sql_parent = mysql_query("SELECT * FROM `gx_email_kategori` ORDER BY `id_kategori` DESC;",$conn);
    $content ='<section class="content-header">
                    <h1>
                        Form Outgoing Report
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
        <form action="" method="post" name="form_complaint">
	  
	  <input type="hidden" style="" name="ID" value="'.(isset($_GET['id_complaint']) ? $_GET['id_complaint'] :"").'" />
          
	<div >
	    <fieldset>
		<legend>Data Customer</legend>
		<div class="table-container table-form">
		    <a href="'.URL_CSO.'helpdesk/data_cust.php?r=form_complaint" class="btn btn-sm bg-navy btn-flat margin pull-right"
						onclick="return valideopenerform(\''.URL_CSO.'helpdesk/data_cust.php?r=form_complaint\',\'complaint\');">Search Customer</a>
		    <br>
		    <table class="form" width="100%">
		      <tbody><tr>
			<td width="12.5%">
			  <label>Complaint ID *</label>
			</td>
			<td width="37.5%">
			  <input type="text" class="form-control" readonly="" style="" name="troubleticket" value="GCT-'.date("dmy").sprintf("%04d", $sql_last_data).'" />
			</td>
		      </tr>
		      <tr>
			<td width="12.5%">
			  <label>User ID *</label>
			</td>
			<td width="37.5%">
			  <input class="form-control" name="id_complaint"  type="hidden" value="'.(isset($_GET["id_outgoing"]) ? $_GET["id_outgoing"] :"") .'" >
			  <input class="form-control required" required="" name="user_id" id="user_id" placeholder="User ID" type="text" value="'.(isset($_GET["id_outgoing"]) ? $data_complaint['user_id'] :"") .'" >
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Customer Number *</label>
			</td>
			<td>
			  <input class="form-control" name="customer_number" required="" id="customer_number" placeholder="Customer Number" type="text" value="'.(isset($_GET["id_outgoing"]) ? $data_complaint['cust_number'] :"") .'" >
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Name *</label>
			</td>
			<td>
			  <input class="form-control" name="name" required="" placeholder="Name" type="text" value="'.(isset($_GET["id_outgoing"]) ? $data_complaint['name'] :"") .'" >
			</td>
		      </tr>
		      <tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Address</label>
			</td>
			<td>
			  <textarea name="address" rows="3" cols="70" class="" style="resize: none;">'.(isset($_GET["id_outgoing"]) ? $data_complaint['address'] :"") .'</textarea>
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Phone</label>
			</td>
			<td>
			  <input class="form-control" name="phone" placeholder="Phone" type="text" value="'.(isset($_GET["id_outgoing"]) ? $data_complaint['phone'] :"") .'" >
			</td>
		      </tr>
              <tr>
			<td>
			  <label>No HP 1</label>
			</td>
			<td>
			  <input class="form-control" name="hp" placeholder="HP" type="text" value="" >
			</td>
		      </tr><tr>
			<td>
			  <label>No HP 2</label>
			</td>
			<td>
			  <input class="form-control" name="hp2" placeholder="HP 2" type="text" value="" >
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Email *</label>
			</td>
			<td>
			  <input class="form-control" name="email" placeholder="Email" type="text" value="'.(isset($_GET["id_outgoing"]) ? $data_complaint['email'] :"") .'" >
			</td>
		      </tr>
		      <!--<tr>
			<td>
			  <label>Connection Type</label>
			</td>
			<td>
			  <input class="form-control" name="connection_type" placeholder="Connection Type" type="text" value="'.(isset($_GET["id_outgoing"]) ? $data_complaint['connection_type'] :"") .'">
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
			  <label>Connection Type *</label>
			</td>
			<td>
			    <input class="required" type="radio" name="connection_type" value="fo" style="float:left;" '.((isset($_GET["id_outgoing"]) && $data_complaint["connection_type"]== "fo" ) ? "checked" :"") .'>FO
			    <input class="required" type="radio" name="connection_type" value="wl" style="float:left;" '.((isset($_GET["id_outgoing"]) && $data_complaint["connection_type"]== "wl" ) ? "checked" :"") .'>Wireless
			</td>
		      </tr>

			<tr>
			    <td>
			      <label>Media Complaint *</label>
			    </td>
			    <td>
				<select name="media" style="width:200px;">
				    <option value="telephone" '.((isset($_GET["id_outgoing"]) && $data_complaint["media"]== "telephone" ) ? 'selected="selected"' :"") .'>Telephone</option>
				    <option value="email" '.((isset($_GET["id_outgoing"]) && $data_complaint["media"]== "email" ) ? 'selected="selected"' :"") .'>Email</option>
				    <option value="website" '.((isset($_GET["id_outgoing"]) && $data_complaint["media"]== "website" ) ? 'selected="selected"' :"") .'>Website</option>
				    <option value="sms" '.((isset($_GET["id_outgoing"]) && $data_complaint["media"]== "sms" ) ? 'selected="selected"' :"") .'>SMS</option>
				    <option value="walkin" '.((isset($_GET["id_outgoing"]) && $data_complaint["media"]== "walkin" ) ? 'selected="selected"' :"") .'>Walk In</option>
                    <option value="voicemail" '.((isset($_GET["id_outgoing"]) && $data_complaint["media"]== "voicemail" ) ? 'selected="selected"' :"") .'>Voice Mail</option>
				    <option value="">-----------------------------------</option>
				    <option value="Admin" '.((isset($_GET["id_outgoing"]) && $data_complaint["media"]== "admin" ) ? 'selected="selected"' :"") .'>Admin</option>
				</select>
			    </td>
		      </tr>
		      
		      <tr>
			<td>
			  <label>Complaint Type *</label>
			</td>
			<td>
			    <input class="required" type="radio" name="complaint_type" value="request" style="float:left;" '.((isset($_GET["id_outgoing"]) && $data_complaint["complaint_type"]== "request" ) ? "checked" :"") .'>Request
                <a href="#" title="Hint." class="tooltip"><span title="Hint"> [?] </span></a>
			    <input class="required" type="radio" name="complaint_type" value="problem" style="float:left;" '.((isset($_GET["id_outgoing"]) && $data_complaint["complaint_type"]== "problem" ) ? "checked" :"") .'>Problem
                <input class="required" type="radio" name="complaint_type" value="admin" style="float:left;" '.((isset($_GET["id_outgoing"]) && $data_complaint["complaint_type"]== "admin" ) ? "checked" :"") .'>Administrasi
			</td>
		      </tr>
		      
		      <tr>
			<td>
			  <label>Which Side *</label>
			</td>
			<td>
			  <input class="required" type="radio" name="which_side" value="customer" style="float:left;" '.((isset($_GET["id_outgoing"]) && $data_complaint["which_side"]== "customer" ) ? "checked" :"") .'> Customer
			  <input class="required" type="radio" name="which_side" value="isp" style="float:left;"  '.((isset($_GET["id_outgoing"]) && $data_complaint["which_side"]== "isp" ) ? "checked" :"") .'>  ISP 
			  <input class="required" type="radio" name="which_side" value="none" style="float:left;" '.((isset($_GET["id_outgoing"]) && $data_complaint["which_side"]== "none" ) ? "checked" :"") .'>  None 
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Status</label>
			</td>
			<td>
			    <select class="required" name="status" style="width:200px;">
				
				<option value="open" '.((isset($_GET["id_outgoing"]) && $data_complaint["status"]== "open" ) ? 'selected="selected"' :"") .'>Open</option>
				<option value="closed" '.((isset($_GET["id_outgoing"]) && $data_complaint["status"]== "closed" ) ? 'selected="selected"' :"") .'>Closed</option>
				<option value="reopen" '.((isset($_GET["id_outgoing"]) && $data_complaint["status"]== "reopen" ) ? 'selected="selected"' :"") .'>Reopen</option>
			    </select>
			</td>
		      </tr>
		      <tr>
			    <td>
			      <label>Action</label>
			    </td>
			    <td>
				<select name="action" style="width:200px;">
				    
				    <option value="Handled by CSO" '.((isset($_GET["id_outgoing"]) && $data_complaint["action"]== "Handled by CSO" ) ? 'selected="selected"' :"") .'>Handled by CSO</option>
				    <option value="Request Trouble Ticket" '.((isset($_GET["id_outgoing"]) && $data_complaint["action"]== "Request Trouble Ticket" ) ? 'selected="selected"' :"") .'>Request Trouble Ticket</option>
				    <option value="survey" '.((isset($_GET["id_outgoing"]) && $data_complaint["action"]== "survey" ) ? 'selected="selected"' :"") .'>Survey</option>
				    
				</select>
				
			    </td>
		      </tr>
		      <tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Problem</label>
			</td>
			<td>
			  <textarea hidden="" name="problem" rows="3" cols="70" style="resize: none;">'.(isset($_GET["id_outgoing"]) ? $data_complaint['problem'] :"") .'</textarea>
              <select required="" name="problem_select" style="width:200px;">';
              
                $sql_problem = mysql_query("SELECT * FROM `gx_cso_problem` ORDER BY `id_problem` ASC;", $conn);
                while($row_problem = mysql_fetch_array($sql_problem))
                {
		    if($row_problem['problem'] != ''){
			$content .='<option value="'.$row_problem["problem"].'" '.((isset($_GET["id_outgoing"]) && $data_complaint["problem_select"]== $row_problem["problem"] ) ? 'selected="selected"' :"") .'>'.$row_problem["problem"].'</option>';
		    }else{
			$content .='<option value="" disabled>-----------------------------------</option>';
		    }
                    
                }
				    
				    $content .='
				</select>
			</td>
		      </tr>
		      <tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Note</label>
			</td>
			<td>
			  <input class="medium" name="id_ticket" placeholder="ID Ticket" type="hidden" value="'.(isset($_GET["id_outgoing"]) ? $data_complaint['ticket_number'] :"") .'" readonly="">
			  <textarea name="note_" id="note_" rows="6" cols="40" style="resize: none;">'.(isset($_GET["id_outgoing"]) ? $data_complaint['note_'] :"") .' '.(isset($_GET['threadid']) ?  $data_note_chat : '').' </textarea>
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
			    <textarea name="solusi" id="solusi" rows="3" cols="70" style="resize: none;">'.(isset($_GET["id_outgoing"]) ? $data_complaint['solusi'] :"") .'</textarea>
			  </td>
			</tr>
			</tbody></table>
		      </div><br />
	       
	      <div class="form-group">																
            <div class="row">						
                <div class="col-xs-3">					
                    <label>Created By</label>				
                </div>					
                <div class="col-xs-6">					
                    '.(isset($_GET['id_outgoing']) ? $data_complaint["created_by"]." on ".date("d-m-Y H:i:s", strtotime($data_complaint["date_add"])) : $loggedin["username"]).'				
                </div>					
            </div>						
            </div>						
                                    
            <div class="form-group">						
            <div class="row">						
                <div class="col-xs-3">					
                    <label>Latest Update By </label>				
                </div>					
                <div class="col-xs-6">					
                    '.(isset($_GET['id_outgoing']) ? $data_complaint["updated_by"]." on ".date("d-m-Y H:i:s", strtotime($data_complaint["date_upd"])) : "").'				
                </div>					
            </div>
            </div>
	      <input name="created_by" value="'.$loggedin["username"].'" type="hidden">
	      <input name="id_employee" value="'.$loggedin["id_employee"].'" type="hidden">
            </div>
	    </fieldset>
	    </div>
	
	<div class="actions">
	    <div class="button-well">
		<input type="submit" class="button button-primary" data-icon="v" name="'.(isset($_GET["id_outgoing"]) ? "update" : "save") .'" value="Save">
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
$update = isset($_POST["update"]) ? $_POST["update"] : "";

	if($save == "Save"){
	    $ID 		    = isset($_POST["ID"]) ? $_POST["ID"] : "";
	    $troubleticket	= isset($_POST["troubleticket"]) ? $_POST["troubleticket"] : "";
	    $kategori 		= isset($_POST["id_kategori"]) ? $_POST["id_kategori"] : "";
	    
	    $user_id		= isset($_POST['user_id']) ? mysql_real_escape_string(strip_tags(trim($_POST['user_id']))) : "";
	    $cust_number	= isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
	    $name		    = isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
	    $address 		= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	    $phone		    = isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
	    $email		    = isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	    
	    $media	 	    = isset($_POST['media']) ? mysql_real_escape_string(strip_tags(trim($_POST['media']))) : "";
	    $complaint_type	= isset($_POST['complaint_type']) ? mysql_real_escape_string(strip_tags(trim($_POST['complaint_type']))) : "";
	    $which_side		= isset($_POST['which_side']) ? mysql_real_escape_string(strip_tags(trim($_POST['which_side']))) : "";
	    $status 		= isset($_POST['status']) ? mysql_real_escape_string(strip_tags(trim($_POST['status']))) : "";
	    $action 		= isset($_POST['action']) ? mysql_real_escape_string(strip_tags(trim($_POST['action']))) : "";
	    $problem 		= isset($_POST['problem']) ? mysql_real_escape_string(strip_tags(trim($_POST['problem']))) : "";
        $problem_select	= isset($_POST['problem_select']) ? mysql_real_escape_string(strip_tags(trim($_POST['problem_select']))) : "";
	    $note_		    = isset($_POST['note_']) ? mysql_real_escape_string(strip_tags(trim($_POST['note_']))) : "";
	    $spk 		    = isset($_POST['spk']) ? mysql_real_escape_string(strip_tags(trim($_POST['spk']))) : "";
	    $solusi 		= isset($_POST['solusi']) ? mysql_real_escape_string(strip_tags(trim($_POST['solusi']))) : "";
	    $connection_type	= isset($_POST['connection_type']) ? mysql_real_escape_string(strip_tags(trim($_POST['connection_type']))) : "";
		
        if($user_id !="" AND $name !="" AND $which_side !="" AND $media !="" AND $connection_type !="" AND $complaint_type !="" AND $status !="")
        {
            $insert_complaint    	= "INSERT INTO `gx_outgoing_report` (`id_outgoing_report`, `user_id`, `ticket_number`, `cust_number`,
                                             `name`, `email`, `address`, `phone`, `media`, `note_`, `type_client`, `problem_select`,
                                             `solusi`, `status`, `action`, `which_side`, `complaint_type`, `connection_type`,
                                             `id_cso`, `created_by`, `updated_by`, `date_add`, `date_upd`, `level`)
                                         VALUES ('', '$user_id', '$troubleticket', '$cust_number',
                                             '$name', '$email', '$address', '$phone', '$media', '$note_', 'client', '$problem_select',
                                             '$solusi', '$status', '$action', '$which_side', '$complaint_type', '$connection_type',
                                             '$loggedin[id_employee]', '$loggedin[username]', '$loggedin[username]', NOW(), NOW(), '0');";
            //echo $insert_complaint;
            mysql_query($insert_complaint, $conn) or die ("<script language='JavaScript'>
                                   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                                   window.history.go(-1);
                                   </script>");
            enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert Outgoing report = $insert_complaint");
            
            echo "<script language='JavaScript'>
                alert('Data telah disimpan!');
                location.href = 'outgoing_report.php';
            </script>";
        }else
        {
            echo "<script language='JavaScript'>
                                   alert('Maaf Data tidak bisa disimpan, ada data yg harus diisi.');
                                   window.history.go(-1);
                                   </script>";
        }
	}elseif($update == "Save"){
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
        $problem_select	= isset($_POST['problem_select']) ? mysql_real_escape_string(strip_tags(trim($_POST['problem_select']))) : "";
	    $note_		= isset($_POST['note_']) ? mysql_real_escape_string(strip_tags(trim($_POST['note_']))) : "";
	    $spk 		= isset($_POST['spk']) ? mysql_real_escape_string(strip_tags(trim($_POST['spk']))) : "";
	    $solusi 		= isset($_POST['solusi']) ? mysql_real_escape_string(strip_tags(trim($_POST['solusi']))) : "";
	    $connection_type	= isset($_POST['connection_type']) ? mysql_real_escape_string(strip_tags(trim($_POST['connection_type']))) : "";
		
		if($ID != "" AND $user_id !="" AND $name !="" AND $which_side !="" AND $media !="" AND $connection_type !="" AND $complaint_type !="" AND $status !="")
        {
            $insert_complaint    	= "UPDATE `gx_outgoing_report` SET `level` = '1', 
                                       `updated_by` = '$loggedin[username]', `date_upd` = NOW()
                                       WHERE `gx_outgoing_report`.`id_outgoing_report` = $ID;";
            //echo $insert_complaint;
            mysql_query($insert_complaint, $conn) or die ("<script language='JavaScript'>
                                   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                                   window.history.go(-1);
                                   </script>");
            enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit Outgoing Report = $insert_complaint");
            
            $insert_complaint    	= "INSERT INTO `gx_outgoing_report` (`id_outgoing_report`, `user_id`, `ticket_number`, `cust_number`,
                                             `name`, `email`, `address`, `phone`, `media`, `note_`, `type_client`, `problem_select`,
                                              `solusi`, `status`, `action`, `which_side`, `complaint_type`,  `connection_type`,
                                             `id_cso`, `created_by`, `updated_by`, `date_add`, `date_upd`, `level`)
                                         VALUES ('', '$user_id', '$troubleticket', '$cust_number',
                                             '$name', '$email', '$address', '$phone', '$media', '$note_', 'client', '$problem_select',
                                             '$solusi', '$status', '$action', '$which_side', '$complaint_type', '$connection_type',
                                             '$loggedin[id_employee]', '$loggedin[username]', '$loggedin[username]', NOW(), NOW(), '0');";
            //echo $insert_complaint;
            mysql_query($insert_complaint, $conn) or die ("<script language='JavaScript'>
                                   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                                   window.history.go(-1);
                                   </script>");
            enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert Outgoing Report = $insert_complaint");
            
            echo "<script language='JavaScript'>
                alert('Data telah disimpan!');
                location.href = 'outgoing_report.php';
            </script>";
        }else
        {
            echo "<script language='JavaScript'>
                    alert('Maaf Data tidak bisa disimpan, ada data yg harus diisi.');
                    window.history.go(-1);
                    </script>";
        }
		
	}
$plugins = '';

    $title	= 'Form Outgoing Report';
    $submenu	= "helpdesk_form_outgoing_report";
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