<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inStaff()){ // Check if they are logged in
if($loggedin["group"] == 'staff'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form SPK");
    global $conn;
    global $conn_voip;
    
     
$save = isset($_POST["save_spk"]) ? $_POST["save_spk"] : "";
$edit = isset($_POST["edit_spk"]) ? $_POST["edit_spk"] : "";

if($save == "Save"){
	$spk_number	= isset($_POST['spk_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['spk_number']))) : "";
	//$name_cso	= isset($_POST['name_cso']) ? mysql_real_escape_string(strip_tags(trim($_POST['name_cso']))) : "";
	$ticket_number	= isset($_POST['ticket_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['ticket_number']))) : "";
	$cust_number	= isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
	$namee		= isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
	$address	= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$problem	= isset($_POST['problem']) ? mysql_real_escape_string(strip_tags(trim($_POST['problem']))) : "";
	$teknisi_id	= isset($_POST['id_employee']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_employee']))) : "";
	$created_by	= isset($_POST['created_by']) ? mysql_real_escape_string(strip_tags(trim($_POST['created_by']))) : "";
	$id_complaint	= isset($_POST['id_complaint']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_complaint']))) : "";
	
	//$time		= $_POST['time_hour'].':'.$_POST['time_minutes'].' '.$_POST['time_ampm'];
	//$time		= isset($_POST['time']) ? mysql_real_escape_string(strip_tags(trim($_POST['time']))) : "";
	//$log_time	= date("Y-m-d H:i:s");
	
	
	
	$query = "INSERT INTO `gx_helpdesk_spk` (`id_spk`, `spk_number`, `id_complaint`, `id_trouble_ticket`, `cust_number`, `name`, `address`, `problem`,
					`id_teknisi`, `date_add`, `date_upd`, `created_by`, `updated_by`, `level`)
					VALUES ('', '$spk_number', $id_complaint, '$ticket_number', '$cust_number', '$namee', '$address', '$problem',
					'$teknisi_id', NOW(), NOW(), '$created_by', '$created_by', '0');";
	
	//echo $query;
	
	mysql_query($query,$conn) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	
	echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'incoming.php?type=spktech';
            </script>";
}elseif($edit == "Save"){
	$id_complaint	= isset($_POST['id_complaint']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_complaint']))) : "";
	$id_spk		= isset($_POST['id_spk']) ? mysql_real_escape_string(strip_tags($_POST['id_spk'])) : "" ;
	//$spk_number	= isset($_POST['spk_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['spk_number']))) : "";
	//$name_cso	= isset($_POST['name_cso']) ? mysql_real_escape_string(strip_tags(trim($_POST['name_cso']))) : "";
	$ticket_number	= isset($_POST['ticket_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['ticket_number']))) : "";
	$cust_number	= isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
	$namee		= isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
	$address	= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$problem	= isset($_POST['problem']) ? mysql_real_escape_string(strip_tags(trim($_POST['problem']))) : "";
	$teknisi_id	= isset($_POST['id_employee']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_employee']))) : "";
	$created_by	= isset($_POST['created_by']) ? mysql_real_escape_string(strip_tags(trim($_POST['created_by']))) : "";
	
	//$time		= $_POST['time_hour'].':'.$_POST['time_minutes'].' '.$_POST['time_ampm'];
	//$time		= isset($_POST['time']) ? mysql_real_escape_string(strip_tags(trim($_POST['time']))) : "";
	//$log_time	= date("Y-m-d H:i:s");
	
	
	
	$query = "UPDATE `gx_helpdesk_spk` SET `id_trouble_ticket` = '$ticket_number',`id_complaint` = '$id_complaint',
						`cust_number` = '$cust_number', `name` = '$namee',
						`address` = '$address',
						`problem` = '$problem', `id_teknisi` = '$teknisi_id', 
						`date_upd` = NOW(), `updated_by` = '$created_by'
						WHERE `gx_helpdesk_spk`.`id_spk` = $id_spk;";
	
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


/*if(isset($_GET["id"])){
    $id_employee	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
    $sql_employee	= mysql_query("SELECT * FROM `gx_employee` WHERE `id_employee` = '".$id_employee."' AND `level` = '0' LIMIT 0,1;");
    $row_employee 	= mysql_fetch_array($sql_employee);

}*/

$id		= isset($_GET["id_spk"]) ? $_GET["id_spk"] : "";
$sql_last_data  = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_spk` WHERE `date_add` LIKE '".date("Y-m-d")."%' ORDER BY `date_add` DESC", $conn)) + 1;
$data_spk	= mysql_fetch_array(mysql_query("SELECT `gx_helpdesk_spk`.*, `gx_helpdesk_complaint`.`phone`, `gx_helpdesk_complaint`.`email`, `tbPegawai`.`cNama`,
						`gx_helpdesk_complaint`.`user_id`
						FROM `gx_helpdesk_spk`,`gx_helpdesk_complaint`,`tbPegawai`
						WHERE `gx_helpdesk_spk`.`id_complaint` = `gx_helpdesk_complaint`.`id_complaint`
						AND `gx_helpdesk_spk`.`id_teknisi` = `tbPegawai`.`id_employee`
						AND `gx_helpdesk_spk`.`level` = '0'
						AND `gx_helpdesk_spk`.`id_spk` = '$id' LIMIT 0,1;",$conn));
/*, `gx_complaint`.`cust_number`,
						`gx_complaint`.`address`, `gx_complaint`.`phone`, `gx_complaint`.`name`,
						`*/

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
        <form action="" method="post" name="form_spk" id="form_spk"  method="post" enctype="multipart/form-data">
	    <div class="table-container table-form">	    
              
                    <table class="form">
		    <tr>
		    <input class="form-control" name="id_spk" placeholder="id spk" type="hidden" value="'.(isset($_GET["id_spk"]) ? $data_spk["id_spk"] :"").'" readonly="">
			<td width="12.5%">
			  <label>SPK Number</label>
			</td>
			<td width="37.5%">
			   <input class="form-control" name="spk_number" placeholder="SPK Number" type="text" value="'.(isset($_GET["id_spk"]) ? $data_spk["spk_number"] :"MCT-".date("dmy").sprintf("%04d", $sql_last_data)."").'" readonly="">
			</td>
		      </tr>
		      <tr>
			<td colspan="2"><a onclick="troubleticket()" title="Search Trouble Ticket" style="padding-left: 66%; color : #4571b5; cursor : pointer;">Search Trouble Ticket</a><br></td>
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
			<td> <input class="large required" name="id_complaint" placeholder="id complaint" type="hidden" value="'.(isset($_GET["id_spk"]) ? $data_spk["id_complaint"] :"").'" readonly="" >
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
				<input class="form-control" name="name" placeholder="Name" type="text" value="'.(isset($_GET["id_spk"]) ? $data_spk["name"] :"").'" readonly="">
				
			    </td>
		      </tr>
		      <tr style="vertical-align: middle;">
			    <td style="vertical-align: middle;">
			      <label>Address</label>
			    </td>
			    <td>
				<textarea name="address" id="address" rows="4" cols="70" style="resize: none;">'.(isset($_GET["id_spk"]) ? $data_spk["address"] :"").'</textarea>
				
			    </td>
		      </tr>
		      <tr>
			<td>
			  <label>Phone</label>
			</td>
			<td>
			  <input class="form-control" name="phone" placeholder="Phone" type="text" value="'.(isset($_GET["id_spk"]) ? $data_spk["phone"] :"").'" >
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Email</label>
			</td>
			<td>
			  <input class="form-control" name="email" placeholder="Email" type="text" value="'.(isset($_GET["id_spk"]) ? $data_spk["email"] :"").'" >
			</td>
		      </tr>
		      <tr style="vertical-align: middle;">
			    <td style="vertical-align: middle;">
			      <label>Problem</label>
			    </td>
			    <td>
				<textarea name="problem" id="problem" rows="4" cols="70" style="resize: none;">'.(isset($_GET["id_spk"]) ? $data_spk['problem'] :"").'</textarea>
			    </td>
		      </tr>
		      <tr>
			<td colspan="2"><a onclick="valideopenerformTeknisi()" title="Search Teknisi" style="padding-left: 66%; color : #4571b5; cursor : pointer;">Search Technician</a><br></td>
		      </tr>
		      <tr>
			    <td>
			      <label>Technician</label>
			    </td>
			    <td>
				<input name="id_employee" placeholder="ID" type="text" value="'.(isset($_GET["id_spk"]) ? $data_spk["id_teknisi"] :"").'" readonly="" style="width:150px;">
				<input name="name_technician" placeholder="Technician" type="text" value="'.(isset($_GET["id_spk"]) ? $data_spk["cNama"] :"").'" readonly="" style="width:350px;">
				
			    </td>
		      </tr>
		      
		    </table>
                
	       
	      
	      <input name="created_by" value="'.$loggedin["username"].'" type="hidden">
	      <input name="id_cso" value="'.$loggedin["id_employee"].'" type="hidden">
            </div>
            <div class="actions">
              <div class="button-well">
                <input style="font-size : 100%" type="submit" class="button button-primary" name="'.(isset($_GET["id_spk"]) ? "edit_spk" :"save_spk").'" data-icon="v" value="Save">
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

<script type="text/javascript">
			function troubleticket(){
			    var popy= window.open("data_troubleticket.php?r=form_spk","popup_form","toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
			}
			
			function valideopenerformTeknisi(){
			    var popy2= window.open("data_tech.php?r=form_spk","popup_form2","toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
			}
</script>
<style>
 .form-control {
  width: 53%;
 }
</style>
    
    ';

    $title	= 'Form SPK';
    $submenu	= "Helpdesk";
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