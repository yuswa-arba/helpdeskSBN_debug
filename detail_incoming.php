<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("config/configuration_user.php");

redirectToHTTPS();

if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Dashboard");
    
    global $conn;
    
      
	if(isset($_GET['id_complaint'])){
		$get_id = isset($_GET['id_complaint']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_complaint']))) : "";
		$data_complaint = mysql_fetch_array(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
							  WHERE `gx_helpdesk_complaint`.`id_complaint` = '$get_id';", $conn));
	}
    
    
    $content ='
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
			<legend>Detail Complaint:</legend>
			  
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

$plugins = '';

    $title	= 'Detail Complaint';
    $submenu	= "helpdesk_form_complaint";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme_popup($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

    } else{
		header("location: ".URL."logout.php");
    }
} else{
	header("location: ".URL."logout.php");
}

?>