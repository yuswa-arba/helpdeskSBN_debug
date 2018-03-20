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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Troubleticket");
    global $conn;
    
    
$sql_last_data  = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint` WHERE `date_add` LIKE '".date("Y-m-d")."%' ORDER BY `date_add` DESC", $conn)) + 1;
 //echo date("Y-m-d H:i:s");   
	    if(isset($_GET['id_troubleticket'])){
		$get_id = isset($_GET['id_troubleticket']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_troubleticket']))) : "";
		$data_complaint = mysql_fetch_array(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
							  WHERE `gx_helpdesk_complaint`.`id_complaint` = '$get_id';", $conn));
	    }
    $priority	= "";
    $priority	.= (isset($_GET['id_troubleticket']) && $data_complaint['priority'] == "0") ? "-" : "";
    $priority	.= (isset($_GET['id_troubleticket']) && $data_complaint['priority'] == "1") ? "HIGH" : "";
    $priority	.= (isset($_GET['id_troubleticket']) && $data_complaint['priority'] == "2") ? "MEDIUM" : "";
    $priority	.= (isset($_GET['id_troubleticket']) && $data_complaint['priority'] == "3") ? "LOW" : "";
    
    $content ='<section class="content-header">
                    <h1>
                        Detail Troubleticket
                        </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			   <ul class="nav nav-tabs" role="tablist" id="myTab">
				<li role="presentation" class="active"><a href="#customer" aria-controls="customer" role="tab" data-toggle="tab">Data Cust</a></li>
				<li role="presentation"><a href="#troubleticket" aria-controls="troubleticket" role="tab" data-toggle="tab">Detail Troubleticket</a></li>
			    </ul>
			    <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="customer">
                            <div class="box">
                                <div class="box-body table-responsive">
				<div class="box-header">
                                </div><!-- /.box-header -->
	<div >
	    <fieldset>
		
		<div class="table-container table-form">
		
		    <table class="form" width="100%">
		      <tbody>
		      <tr>
			<td colspan="2" >
			<legend>Detail Customer:</legend>
			  
			</td>
		      </tr>
		      <tr>
			<td width="12.5%">
			  <label>Ticket Number</label>
			</td>
			<td width="37.5%">
			  : '.$data_complaint["ticket_number"].'
			</td>
		      </tr>
		      <tr>
			<td width="12.5%">
			  <label>User ID</label>
			</td>
			<td width="37.5%">
			  : '.$data_complaint["user_id"].'
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Customer Number</label>
			</td>
			<td>
			  : '.$data_complaint["cust_number"].'
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Name</label>
			</td>
			<td>
			  : '.$data_complaint["name"].'
			</td>
		      </tr>
		      <tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Address</label>
			</td>
			<td>
			  : '.$data_complaint["address"].'
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Phone</label>
			</td>
			<td>
			  : '.$data_complaint["phone"].'
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Email</label>
			</td>
			<td>
			  : '.$data_complaint["email"].'
			</td>
		      </tr>
              
		      </tbody></table>
		      
		      
	       
	      
	      
            </div>
	    </fieldset>
	    </div>
	
	
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    </div>
		      <div role="tabpanel" class="tab-pane" id="troubleticket">
                            <div class="box">
                                <div class="box-body table-responsive">
				<div class="box-header">
                                </div><!-- /.box-header -->
	<div >
	    <fieldset>
		
		<div class="table-container table-form">
		
		    <table class="form" width="100%">
		      <tbody>
		      <tr>
			<td colspan="2" >
			<legend>Detail Troubleticket:</legend>
			  
			</td>
		      </tr>
		     	    
		    <tr>
			<td colspan="2">
			  
			</td>
		      </tr>

			<tr>
			    <td width="15%">
			      <label>Media Complaint</label>
			    </td>
			    <td width="85%">
				: '.$data_complaint["media"].'
			    </td>
		      </tr>
		      
		      <tr>
			<td>
			  <label>Complaint Type</label>
			</td>
			<td>
			    : '.$data_complaint["complaint_type"].'
			</td>
		      </tr>
		      
		      <tr>
			<td>
			  <label>Which Side</label>
			</td>
			<td>
			  : '.$data_complaint["which_side"].'
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Status</label>
			</td>
			<td>
			    : '.$data_complaint["status"].'
			</td>
		      </tr>
		      <tr>
			    <td>
			      <label>Action</label>
			    </td>
			    <td>
				: '.$data_complaint["action"].'
				
			    </td>
		      </tr>
		      <tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Problem</label>
			</td>
			<td>
			  : '.(($data_complaint['problem'] == "") ? $data_complaint['problem_select'] : $data_complaint['problem']).'
			</td>
		      </tr>
		      <tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Note</label>
			</td>
			<td>
			  : '.$data_complaint['note_'].'
			</td>
		      </tr>
		      <tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Priority</label>
			</td>
			<td>
			  : '.$priority.'
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Created By</label>
			</td>
			<td>
			  : '.$data_complaint["created_by"].' on '.(date("d-m-Y H:i:s", strtotime($data_complaint["date_add"]))).'
			</td>
		      </tr>
              <tr>
			<td>
			  <label>Last Updated By</label>
			</td>
			<td>
			  : '.$data_complaint["updated_by"].'on '.(date("d-m-Y H:i:s", strtotime($data_complaint["date_upd"]))).'
			</td>
		      </tr>
		    </tbody></table>
		      
		      
	       
	      
	      
            </div>
	    </fieldset>
	    </div>
	
	
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
		    </div>
                    </div>

                </section><!-- /.content -->
            ';
$plugins = '
<script type="text/javascript">
			function customer(){
			    var popy= window.open("data_cust.php","popup_form","toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
			}
			
</script>
    
    ';

    $title	= 'Detail Troubleticket';
    $submenu	= "helpdesk_detail_troubleticket";
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