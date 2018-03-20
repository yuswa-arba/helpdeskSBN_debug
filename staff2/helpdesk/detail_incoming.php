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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Incoming");
    global $conn;
    global $conn_voip;
    
$sql_last_data  = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint` WHERE `date_add` LIKE '".date("Y-m-d")."%' ORDER BY `date_add` DESC", $conn)) + 1;
 //echo date("Y-m-d H:i:s");   
	    if(isset($_GET['id_complaint'])){
		$get_id = isset($_GET['id_complaint']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_complaint']))) : "";
		$data_complaint = mysql_fetch_array(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
							  WHERE `gx_helpdesk_complaint`.`id_complaint` = '$get_id';", $conn));
	    }
    
    $sql_parent = mysql_query("SELECT * FROM `gx_email_kategori` ORDER BY `id_kategori` DESC;",$conn);
    $content ='<section class="content-header">
                    <h1>
                        Detail Incoming
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="detail_incoming">Detail Incoming</a></li>
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
			  : '.$data_complaint['problem'].'
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
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert Complaint = $insert_complaint");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'incoming.php';
		</script>";
	}
$plugins = '
<script type="text/javascript">
			function customer(){
			    var popy= window.open("data_cust.php","popup_form","toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
			}
			
</script>
    
    ';

    $title	= 'Form Incoming';
    $submenu	= "helpdesk_form_complaint";
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