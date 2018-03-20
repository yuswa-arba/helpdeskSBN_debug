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
    
$sql_last_data  = mysql_num_rows(mysql_query("SELECT `id_prospek`, `tanggal`, `cabang`, `kode_cust`, `nama_cust`, `nama_perusahaan`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp_1`, `no_hp_2`, `contact_person`, `email`, `id_marketing`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_prospek`", $conn)) + 1;
 //echo date("Y-m-d H:i:s");   
	    if(isset($_GET['id_prospek'])){
		$get_id = isset($_GET['id_prospek']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_prospek']))) : "";
		$data_prospek = mysql_fetch_array(mysql_query("SELECT `id_prospek`, `tanggal`, `cabang`, `kode_cust`, `nama_cust`, `nama_perusahaan`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp_1`, `no_hp_2`, `contact_person`, `email`, `id_marketing`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_prospek` WHERE `gx_prospek`.`id_prospek` = '$get_id';", $conn));
	    }
    
    $sql_parent = mysql_query("SELECT * FROM `gx_email_kategori` ORDER BY `id_kategori` DESC;",$conn);
    $content ='<section class="content-header">
                    <h1>
                        Form Prospek                        
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
        <form action="" method="post" name="form_prospek">
	  
	  <input type="hidden" style="" name="ID" value="'.(isset($_GET['id_prospek']) ? $_GET['id_prospek'] :"").'" />
          
	<div >
	    <fieldset>
		<legend>Data Automatic</legend>
		<div class="table-container table-form">
		    <!--<a href="'.URL_ADMIN.'helpdesk/data_cust.php?r=form_prospek" class="btn btn-sm bg-navy btn-flat margin pull-right"
						onclick="return valideopenerform(\''.URL_ADMIN.'helpdesk/data_cust.php?r=form_prospek\',\'prospek\');">Search Customer</a>-->
		 
		    <table class="form" width="100%">
		      <tbody><tr>
			<td width="12.5%">
			  <label>No Prospek*</label>
			</td>
			<td width="37.5%">
			  <input type="text" readonly="" style="" name="troubleticket" value="GCT-'.date("dmy").sprintf("%04d", $sql_last_data).'" />
			</td>
		      </tr>
		      <tr>
			<td width="12.5%">
			  <label>Tanggal*</label>
			</td>
			<td width="37.5%">
			  <input class="form-control" name="id_prospek" placeholder="Tanggal" type="hidden" value="'.(isset($_GET["id_prospek"]) ? $_GET["id_prospek"] :"") .'" readonly="">
			  <input class="form-control required" readonly="" name="tanggal" id="tanggal" placeholder="User ID" type="text" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['tanggal'] :"") .'" >
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Cabang*</label>
			</td>
		      
			<td>
			  <input class="form-control" name="cabang" readonly="" id="cabang" placeholder="Cabang" type="text" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['cabang'] :"") .'" >
			</td>
		      </tr>
		      <tr>
			<td colspan="2"><a onclick="cabang()" title="Search Cabang" style="padding-left: 66%; color : #4571b5; cursor : pointer;">Search Trouble Ticket</a><br></td>
		      </tr>
		      <tr>
			<td>
			  <label>Kode Customer</label>
			</td>
			<td>
			  <input class="form-control" name="name" readonly="" placeholder="Kode Customer" type="text" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kode_customer'] : "") .'">
			</td>
		      </tr>
		      <tr>
			<td colspan="2"><a onclick="Customer()" title="Search Trouble Ticket" style="padding-left: 66%; color : #4571b5; cursor : pointer;">Search Trouble Ticket</a><br></td>
		      </tr>
		      
		      <tr>
			<td colspan="2">
			<legend>Data prospek:</legend>
			  
			</td>
		      </tr>
		     	    
		    <tr>
			<td colspan="2">
			  
			</td>
		      </tr>
<tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Nama Customer</label>
			</td>
			<td>
			  <input type="text" name="nama_cust"  class="form-control"  value="'.(isset($_GET["id_prospek"]) ? $data_prospek['nama_cust'] :"") .'" placeholder="Nama Customer">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Nama Perusahaan</label>
			</td>
			<td>
			  <input class="form-control" name="nama_perusahaan" placeholder="Phone" type="text" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['nama_perusahaan'] :"") .'" >
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Alamat</label>
			</td>
			<td>
			  <input class="form-control" name="alamat" placeholder="Alamat" type="text" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['alamat'] :"") .'" >
			</td>
		      </tr>
		      <!--<tr>
			<td>
			  <label>Connection Type</label>
			</td>
			<td>
			  <input class="form-control" name="connection_type" placeholder="Connection Type" type="text" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['connection_type'] :"") .'">
			</td>
		      </tr>-->
		      
		      <tr>
			<td colspan="2">
			  
			</td>
		      </tr>
			<tr>
			    <td>
			      <label>Kelurahan</label>
			    </td>
			    <td>
			    <input class="form-control" name="kelurahan" placeholder="kelurahan" type="text" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kelurahan'] :"") .'">
		        
				<!--<select name="media" style="width:200px;">
				    <option value="telephone" '.((isset($_GET["id_prospek"]) && $data_prospek["media"]== "telephone" ) ? 'selected="selected"' :"") .'>Telephone</option>
				    <option value="email" '.((isset($_GET["id_prospek"]) && $data_prospek["media"]== "email" ) ? 'selected="selected"' :"") .'>Email</option>
				    <option value="website" '.((isset($_GET["id_prospek"]) && $data_prospek["media"]== "website" ) ? 'selected="selected"' :"") .'>Website</option>
				    <option value="sms" '.((isset($_GET["id_prospek"]) && $data_prospek["media"]== "sms" ) ? 'selected="selected"' :"") .'>SMS</option>
				    <option value="walkin" '.((isset($_GET["id_prospek"]) && $data_prospek["media"]== "walkin" ) ? 'selected="selected"' :"") .'>Walk In</option>
				</select>-->
			    </td>
		      </tr>
		      
		      <tr>
			<td>
			  <label>Kecamatan</label>
			</td>
			<td>
			    <input class="form-control" name="kecamatan" placeholder="kecamatan" type="text" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kecamatan'] :"") .'">
		        
			    <!--
			    <input class="required" type="radio" name="prospek_type" value="request" style="float:left;" '.((isset($_GET["id_prospek"]) && $data_prospek["prospek_type"]== "request" ) ? "checked" :"") .'>Request <a href="#" title="Hint." class="tooltip"><span title="Hint"> [?] </span></a>
			    <input class="required" type="radio" name="prospek_type" value="problem" style="float:left;" '.((isset($_GET["id_prospek"]) && $data_prospek["prospek_type"]== "problem" ) ? "checked" :"") .'>Problem
			    -->
			</td>
		      </tr>
		      
		      <tr>
			<td>
			  <label>Kota</label>
			</td>
			<td>
			<input class="form-control" name="kota" placeholder="kota" type="text" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kota'] :"") .'">
		          <!--
			  <input class="required" type="radio" name="which_side" value="wireless" style="float:left;" '.((isset($_GET["id_prospek"]) && $data_prospek["which_side"]== "wireless" ) ? "checked" :"") .'> Customer
			  <input class="required" type="radio" name="which_side" value="isp" style="float:left;"  '.((isset($_GET["id_prospek"]) && $data_prospek["which_side"]== "isp" ) ? "checked" :"") .'>  ISP 
			  <input class="required" type="radio" name="which_side" value="none" style="float:left;" '.((isset($_GET["id_prospek"]) && $data_prospek["which_side"]== "none" ) ? "checked" :"") .'>  None 
			  -->
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Kode Pos</label>
			</td>
			<td>
			<input class="form-control" name="kode_pos" placeholder="Kode Pos" type="text" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kode_pos'] :"").'">
		            <!--
			    <select class="required" name="status" style="width:200px;">
				<option value="">Choose one</option>
				<option value="open" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "open" ) ? 'selected="selected"' :"") .'>Open</option>
				<option value="closed" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "closed" ) ? 'selected="selected"' :"") .'>Closed</option>
				<option value="reopen" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "reopen" ) ? 'selected="selected"' :"") .'>Reopen</option>
			    </select>
			    -->
			    
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>No. Telp</label>
			</td>
			<td>
			    <input class="form-control" name="no_telp" placeholder="No. Telepon" type="text" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_telp'] :"").'">
		           
			    <!--<select class="required" name="status" style="width:200px;">
				<option value="">Choose one</option>
				<option value="open" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "open" ) ? 'selected="selected"' :"") .'>Open</option>
				<option value="closed" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "closed" ) ? 'selected="selected"' :"") .'>Closed</option>
				<option value="reopen" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "reopen" ) ? 'selected="selected"' :"") .'>Reopen</option>
			    </select>-->
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>No. HP 1</label>
			</td>
			<td>
			<input class="form-control" name="no_hp_1" placeholder="No. HP 1" type="text" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_hp_1'] :"").'">
		           <!--<select class="required" name="status" style="width:200px;">
				<option value="">Choose one</option>
				<option value="open" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "open" ) ? 'selected="selected"' :"") .'>Open</option>
				<option value="closed" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "closed" ) ? 'selected="selected"' :"") .'>Closed</option>
				<option value="reopen" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "reopen" ) ? 'selected="selected"' :"") .'>Reopen</option>
			    </select>-->
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>No. HP 2</label>
			</td>
			<td>
			<input class="form-control" name="no_hp_2" placeholder="No. HP 2" type="text" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_hp_2'] :"").'">
		           <!--
			    <select class="required" name="status" style="width:200px;">
				<option value="">Choose one</option>
				<option value="open" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "open" ) ? 'selected="selected"' :"") .'>Open</option>
				<option value="closed" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "closed" ) ? 'selected="selected"' :"") .'>Closed</option>
				<option value="reopen" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "reopen" ) ? 'selected="selected"' :"") .'>Reopen</option>
			    </select>
			    -->
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Contact Person</label>
			</td>
			<td>
			<input class="form-control" name="no_hp_2" placeholder="No. HP 2" type="text" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_hp_2'] :"").'">
		            <!--
			    <select class="required" name="status" style="width:200px;">
				<option value="">Choose one</option>
				<option value="open" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "open" ) ? 'selected="selected"' :"") .'>Open</option>
				<option value="closed" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "closed" ) ? 'selected="selected"' :"") .'>Closed</option>
				<option value="reopen" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "reopen" ) ? 'selected="selected"' :"") .'>Reopen</option>
			    </select>
			    -->
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Email</label>
			</td>
			<td>
			<input class="form-control" name="no_hp_2" placeholder="No. HP 2" type="text" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_hp_2'] :"").'">
		            <!--
			    <select class="required" name="status" style="width:200px;">
				<option value="">Choose one</option>
				<option value="open" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "open" ) ? 'selected="selected"' :"") .'>Open</option>
				<option value="closed" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "closed" ) ? 'selected="selected"' :"") .'>Closed</option>
				<option value="reopen" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "reopen" ) ? 'selected="selected"' :"") .'>Reopen</option>
			    </select>
			    -->
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Marketing</label>
			</td>
			<td>
			    
			    <select class="required" name="status" style="width:200px;">
				<option value="">Choose one</option>
				<option value="open" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "open" ) ? 'selected="selected"' :"") .'>Open</option>
				<option value="closed" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "closed" ) ? 'selected="selected"' :"") .'>Closed</option>
				<option value="reopen" '.((isset($_GET["id_prospek"]) && $data_prospek["status"]== "reopen" ) ? 'selected="selected"' :"") .'>Reopen</option>
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
		<input type="submit" class="button button-primary" data-icon="v" name="'.(isset($_GET["id_prospek"]) ? "update" : "save") .'" value="Save">
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
	    $prospek_type	= isset($_POST['prospek_type']) ? mysql_real_escape_string(strip_tags(trim($_POST['prospek_type']))) : "";
	    $which_side		= isset($_POST['which_side']) ? mysql_real_escape_string(strip_tags(trim($_POST['which_side']))) : "";
	    $status 		= isset($_POST['status']) ? mysql_real_escape_string(strip_tags(trim($_POST['status']))) : "";
	    $action 		= isset($_POST['action']) ? mysql_real_escape_string(strip_tags(trim($_POST['action']))) : "";
	    $problem 		= isset($_POST['problem']) ? mysql_real_escape_string(strip_tags(trim($_POST['problem']))) : "";
	    $note_		= isset($_POST['note_']) ? mysql_real_escape_string(strip_tags(trim($_POST['note_']))) : "";
	    $spk 		= isset($_POST['spk']) ? mysql_real_escape_string(strip_tags(trim($_POST['spk']))) : "";
	    $solusi 		= isset($_POST['solusi']) ? mysql_real_escape_string(strip_tags(trim($_POST['solusi']))) : "";
	    
		    
		$insert_prospek    	= "INSERT INTO `gx_helpdesk_prospek` (`id_prospek`, `user_id`, `ticket_number`, `cust_number`,
									     `name`, `email`, `address`, `phone`, `media`, `note_`, `type_client`, `problem`,
									     `spk`, `solusi`, `status`, `action`, `which_side`, `prospek_type`,
									     `id_cso`, `created_by`, `updated_by`, `date_add`, `date_upd`, `level`)
								     VALUES ('', '$user_id', '$troubleticket', '$cust_number',
									     '$name', '$email', '$address', '$phone', '$media', '$note_', 'client', '$problem',
									     '$spk', '$solusi', '$status', '$action', '$which_side', '$prospek_type',
									     '$loggedin[id_employee]', '$loggedin[username]', '$loggedin[username]', NOW(), NOW(), '0');";
		//echo $insert_prospek;
		mysql_query($insert_prospek, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert prospek = $insert_prospek");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'incoming.php';
		</script>";
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
	    $prospek_type	= isset($_POST['prospek_type']) ? mysql_real_escape_string(strip_tags(trim($_POST['prospek_type']))) : "";
	    $which_side		= isset($_POST['which_side']) ? mysql_real_escape_string(strip_tags(trim($_POST['which_side']))) : "";
	    $status 		= isset($_POST['status']) ? mysql_real_escape_string(strip_tags(trim($_POST['status']))) : "";
	    $action 		= isset($_POST['action']) ? mysql_real_escape_string(strip_tags(trim($_POST['action']))) : "";
	    $problem 		= isset($_POST['problem']) ? mysql_real_escape_string(strip_tags(trim($_POST['problem']))) : "";
	    $note_		= isset($_POST['note_']) ? mysql_real_escape_string(strip_tags(trim($_POST['note_']))) : "";
	    $spk 		= isset($_POST['spk']) ? mysql_real_escape_string(strip_tags(trim($_POST['spk']))) : "";
	    $solusi 		= isset($_POST['solusi']) ? mysql_real_escape_string(strip_tags(trim($_POST['solusi']))) : "";
	    
		    
		$insert_prospek    	= "UPDATE `gx_helpdesk_prospek` SET `user_id` = '$user_id', `cust_number` = '$cust_number', `name` = '$name', 
							       `email` = '$email', `address` = '$address',`phone` = '$phone', `media` = '$media',`note_` = '$note_', `problem` = '$problem',
							       `spk` = '$spk', `solusi` = '$solusi', `status` = '$status', `action` = '$action', `which_side` = '$which_side', `prospek_type` = '$prospek_type',
							       `updated_by` = '$loggedin[username]', `date_upd` = NOW()
							       WHERE `gx_helpdesk_prospek`.`id_prospek` = $ID;";
		
		
		//echo $insert_prospek;
		mysql_query($insert_prospek, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit prospek = $insert_prospek");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'incoming.php';
		</script>";
	}
$plugins = '';

    $title	= 'Form Customer';
    $submenu	= "master_form_prospek";
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