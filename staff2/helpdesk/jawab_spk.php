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
 //enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Mailbox");
    global $conn;
    global $conn_voip;

    
$save = isset($_POST["save_spk"]) ? $_POST["save_spk"] : "";

if($save == "Save"){
	$id_spk		= isset($_POST['id_spk']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_spk']))) : "";
	$spk_number	= isset($_POST['spk_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['spk_number']))) : "";
	//$name_cso	= isset($_POST['name_cso']) ? mysql_real_escape_string(strip_tags(trim($_POST['name_cso']))) : "";
	$ticket_number	= isset($_POST['ticket_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['ticket_number']))) : "";
	$cust_number	= isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
	$name		= isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
	$address	= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$problem	= isset($_POST['problem']) ? mysql_real_escape_string(strip_tags(trim($_POST['problem']))) : "";
	$solusi		= isset($_POST['solusi']) ? mysql_real_escape_string(strip_tags(trim($_POST['solusi']))) : "";
	$teknisi_id	= isset($_POST['id_employee']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_employee']))) : "";
	$created_by	= isset($_POST['created_by']) ? mysql_real_escape_string(strip_tags(trim($_POST['created_by']))) : "";
	$id_complaint	= isset($_POST['id_complaint']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_complaint']))) : "";
	$status_cso	= "";
	$status_teknisi	= isset($_POST['status_teknisi']) ? mysql_real_escape_string(strip_tags(trim($_POST['status_teknisi']))) : "";
	$created_by	= isset($_POST['created_by']) ? mysql_real_escape_string(strip_tags(trim($_POST['created_by']))) : "";
	
	$query = "INSERT INTO `gx_helpdesk_jawabspk` (`id_jawabspk`, `spk_number`, `id_spk`, `id_teknisi`, `jawab_spk`, `status_cso`,
					    `status_teknisi`, `date_add`, `date_upd`, `created_by`, `updated_by`, `level`)
					VALUES (NULL, '$spk_number', '$id_spk', '$teknisi_id', '$solusi', '$status_cso',
					'$status_teknisi', NOW(), NOW(), '$created_by', '$created_by', '0');";
	
	//echo $query;
	
	mysql_query($query,$conn) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	
	echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'incoming.php?type=spktech';
            </script>";
}


$id		= isset($_GET["id_spk"]) ? $_GET["id_spk"] : "";
$sql_last_data  = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_spk` WHERE `date_add` LIKE '".date("Y-m-d")."%' ORDER BY `date_add` DESC",$conn)) + 1;
$data_spk	= mysql_fetch_array(mysql_query("SELECT `gx_helpdesk_spk`.*, `gx_helpdesk_complaint`.`phone`, `gx_helpdesk_complaint`.`email`, `tbPegawai`.`cNama`,
						`gx_helpdesk_complaint`.`user_id`
						FROM `gx_helpdesk_spk`,`gx_helpdesk_complaint`,`tbPegawai`
						WHERE `gx_helpdesk_spk`.`id_complaint` = `gx_helpdesk_complaint`.`id_complaint`
						AND `gx_helpdesk_spk`.`id_teknisi` = `tbPegawai`.`id_employee`
						AND `gx_helpdesk_spk`.`level` = '0'
						AND `gx_helpdesk_spk`.`id_spk` = '$id' LIMIT 0,1;",$conn));
/*, `gx_helpdesk_complaint`.`cust_number`,
						`gx_helpdesk_complaint`.`address`, `gx_helpdesk_complaint`.`phone`, `gx_helpdesk_complaint`.`name`,
						`*/
                                                
    $content ='<section class="content-header">
                    <h1>
                        Jawab SPK
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="jawab_spk">Jawab SPK</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Jawab SPK</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_spk" id="form_spk"  method="post" enctype="multipart/form-data">
	    <div class="table-container table-form">	    
              
                    <table class="form">
		    <tr>
		    <input class="form-control" name="id_spk" placeholder="id spk" readonly="" type="hidden" value="'.(isset($_GET["id_spk"]) ? $data_spk["id_spk"] :"").'" readonly="">
			<td width="12.5%">
			  <label>SPK Number</label>
			</td>
			<td width="37.5%">
			   <input class="form-control" name="spk_number" placeholder="SPK Number" type="text" value="'.(isset($_GET["id_spk"]) ? $data_spk["spk_number"] :"MCT-".date("dmy").sprintf("%04d", $sql_last_data)."").'" readonly="">
			</td>
		      </tr>
		      <tr>
			    <td>
			      <label>Technician</label>
			    </td>
			    <td>
				<input name="id_employee" placeholder="ID" type="hidden" value="'.(isset($_GET["id_spk"]) ? $data_spk["id_teknisi"] :"").'" readonly="" style="width:150px;">
				<input name="name_technician" class="form-control" placeholder="Technician" type="text" value="'.(isset($_GET["id_spk"]) ? $data_spk["cNama"] :"").'" readonly="" style="width:350px;">
				
			    </td>
		      </tr>
		      <tr>
			<td colspan="2"></td>
		      </tr>
		      <tr>
			<td>
			  <label>Trouble Ticket Number*</label>
			</td>
			<td>
			  <input class="form-control" name="ticket_number" placeholder="Trouble Ticket Number" type="text" value="'.(isset($_GET["id_spk"]) ? $data_spk["id_trouble_ticket"] :"").'" readonly="" >
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>User ID*</label>
			</td>
			<td> <input class="form-control" name="id_complaint" placeholder="id complaint" type="hidden" value="'.(isset($_GET["id_spk"]) ? $data_spk["id_complaint"] :"").'" readonly="" >
			  <input class="form-control" name="user_id" placeholder="User ID" type="text" value="'.(isset($_GET["id_spk"]) ? $data_spk["user_id"] :"").'" readonly="" >
			</td>
		      </tr>
		      <tr>
			    <td>
			      <label>Customer Number</label>
			    </td>
			    <td>
				<input class="form-control" name="customer_number" placeholder="Customer Number" type="text" value="'.(isset($_GET["id_spk"]) ? $data_spk["cust_number"] :"").'" readonly="">
				
			    </td>
		      </tr>
		      <tr>
			    <td>
			      <label>Name</label>
			    </td>
			    <td>
				<input class="form-control" name="name" placeholder="Name" readonly="" type="text" value="'.(isset($_GET["id_spk"]) ? $data_spk["name"] :"").'" readonly="">
				
			    </td>
		      </tr>
		      <tr style="vertical-align: middle;">
			    <td style="vertical-align: middle;">
			      <label>Address</label>
			    </td>
			    <td>
				<textarea name="address" id="address" rows="4" cols="70" readonly="" style="resize: none;">'.(isset($_GET["id_spk"]) ? $data_spk["address"] :"").'</textarea>
				
			    </td>
		      </tr>
		      <tr>
			<td>
			  <label>Phone</label>
			</td>
			<td>
			  <input class="form-control" name="phone" placeholder="Phone" readonly="" type="text" value="'.(isset($_GET["id_spk"]) ? $data_spk["phone"] :"").'" >
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Email</label>
			</td>
			<td>
			  <input class="form-control" name="email" placeholder="Email" readonly="" type="text" value="'.(isset($_GET["id_spk"]) ? $data_spk["email"] :"").'" >
			</td>
		      </tr>
		      <tr style="vertical-align: middle;">
			    <td style="vertical-align: middle;">
			      <label>Problem</label>
			    </td>
			    <td>
				<textarea name="form-control" id="problem" rows="4" readonly=""  cols="70" style="resize: none;">'.(isset($_GET["id_spk"]) ? $data_spk['problem'] :"").'</textarea>
			    </td>
		      </tr>
		      <tr>
			<td colspan="2"></td>
		      </tr>
		      <tr style="vertical-align: middle;">
			    <td style="vertical-align: middle;">
			      <label>Solusi</label>
			    </td>
			    <td>
				<textarea name="solusi" id="solusi" rows="4" cols="70" style="resize: none;"></textarea>
			    </td>
		      </tr>
		      <tr style="vertical-align: middle;">
			    <td style="vertical-align: middle;">
			      <label>Status</label>
			    </td>
			    <td>
				<select name="status_teknisi" style="width:200px;">
				    <option value="">Status</option>
				    <option value="clear">Clear</option>
				    <option value="uncleared">Uncleared</option>
				</select>
			    </td>
		      </tr>
		    </table>
                
	       
	      
	      <input name="created_by" value="'.$loggedin["username"].'" type="hidden">
	      <input name="id_cso" value="'.$loggedin["id_employee"].'" type="hidden">
            </div>
            <div class="actions">
              <div class="button-well">
                <input style="font-size : 100%" type="submit" class="button button-primary" name="save_spk" data-icon="v" value="Save">
              </div>

            </div>
	    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '

<script type=\'text/javascript\'>
	function validepopupform2(uid,  nama){
                window.opener.document.form_spk.id_employee.value=uid;
                window.opener.document.form_spk.name_technician.value=nama;
		self.close();
        }
</script>
<style>
 .form-control {
  width: 55%;
 }
</style>
<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#tech\').dataTable({
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
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>