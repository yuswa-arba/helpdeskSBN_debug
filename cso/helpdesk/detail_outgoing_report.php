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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Outgoing Report");
    global $conn;
    
    
$sql_last_data  = mysql_num_rows(mysql_query("SELECT * FROM `gx_outgoing_report` WHERE `date_add` LIKE '".date("Y-m-d")."%' ORDER BY `date_add` DESC", $conn)) + 1;
 //echo date("Y-m-d H:i:s");   
	    if(isset($_GET['id_outgoing'])){
		$get_id = isset($_GET['id_outgoing']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_outgoing']))) : "";
		$data_complaint = mysql_fetch_array(mysql_query("SELECT * FROM `gx_outgoing_report`
							  WHERE `gx_outgoing_report`.`id_outgoing_report` = '$get_id';", $conn));
	    }
    
    
    $content ='<section class="content-header">
                    <h1>
                        Detail Outgoing Report
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="detail_incoming">Detail Outgoing</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
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
			<legend>Detail Outgoing Report:</legend>
			  
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
			  : '.(($data_complaint["problem_select"]  != "" ) ? $data_complaint["problem_select"] : $data_complaint['problem']).'
			</td>
		      </tr>
		      <tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Note</label>
			</td>
			<td>
			  : '.$data_complaint['note_'].'</textarea>
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>SPK</label>
			</td>
			<td>
			 : '. $data_complaint["spk"].'
			</td>
		      </tr>
              <tr>
			<td>
			  <label>Created By</label>
			</td>
			<td>
			 : '. $data_complaint["created_by"].' on '. $data_complaint["date_add"].' 
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Last updated by</label>
			</td>
			<td>
			 : '. $data_complaint["updated_by"].' on '. $data_complaint["date_upd"].' 
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

                </section><!-- /.content -->
            ';

$plugins = '
<script type="text/javascript">
			function customer(){
			    var popy= window.open("data_cust.php","popup_form","toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
			}
			
</script>
    
    ';

    $title	= 'Detail Outgoing Report';
    $submenu	= "helpdesk_outgoing_report";
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