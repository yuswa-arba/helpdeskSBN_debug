<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

include ("config/configuration.php");
    $perhalaman = 50;

    if (isset($_GET['page'])){
        $start=($page - 1) * $perhalaman;
    }else{
        $start=0;
    }
    $no = 1;
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'super_admin' || $loggedin["group"] == 'admin' || $loggedin["group"] == 'manager' || $loggedin["group"] == 'kabag' || $loggedin["group"] == 'na' || $loggedin["group"] == 'cso'){
        
        
	$submit = isset($_POST["complaint"]) ? $_POST["complaint"] : "";
	if($submit == "Hapus"){
		$id_complaint = array();
		$id_complaint = isset($_POST["id_complaint"]) ? $_POST["id_complaint"] : $id_complaint;
		foreach($id_complaint as $key => $value){
			$update    = mysql_query("UPDATE `gx_complaint` SET level='1' WHERE `id_complaint`='$value'") or die(mysql_error());
		}
		header("location: incoming.php?type=complaint");
	}
	
	$submit = isset($_POST["prospek"]) ? $_POST["prospek"] : "";
	if($submit == "Hapus"){
		$id_prospek = isset($_POST["id_prospek"]) ? $_POST["id_prospek"] : $id_prospekt;
		foreach($id_prospek as $key => $value){
			$update    = mysql_query("UPDATE `gx_complaint` SET level='1' WHERE `id_complaint`='$value'") or die(mysql_error());
		}
		header("location: incoming.php?type=prospek");
	}
	
	$submit = isset($_POST["nprospek"]) ? $_POST["nprospek"] : "";
	if($submit == "Hapus"){
		$id_nprospek = array();
		$id_nprospek = isset($_POST["id_nprospek"]) ? $_POST["id_nprospek"] : $id_nprospek;
		foreach($id_nprospek as $key => $value){
			$update    = mysql_query("UPDATE `gx_complaint` SET level='1' WHERE `id_complaint`='$value'") or die(mysql_error());
		}
		header("location: incoming.php?type=nonprospek");
	}
	
	$submit = isset($_POST["spk"]) ? $_POST["spk"] : "";
	if($submit == "Hapus"){
		$id_spk = array();
		$id_spk = isset($_POST["id_spk"]) ? $_POST["id_spk"] : $id_complaint;
		foreach($id_spk as $key => $value){
			$update    = mysql_query("UPDATE `gx_spk` SET level='1' WHERE `id_spk`='$value'") or die(mysql_error());
		}
		header("location: incoming.php?type=".$_GET['type']."");
	}

        
        $tab          = isset($_GET['type']) ? $_GET['type'] : "";
        $title2 = '';
	$title2 .= ($tab == "nonprospek") ? 'List Non Prospek' : '';
	$title2 .= ($tab == "prospek") ? 'List Prospek' : '';
	$title2 .= ($tab == "complaint") ? 'List Complaint' :'';
	$title2 .= ($tab == "spktech") ? 'List SPK Teknisi' :'';
	$title2 .= ($tab == "spkmkt") ? 'List SPK Marketing' :'';


$content ='

        <div class="box round first grid">
            <h2>Incoming - '.$title2.'</h2>
                <div class="block">
                    <div style="float: right;"  class="button-well">
                        <font style="font-size: 100%;" class="button button-primary">
                            <a href="form_spk_mar.php" style="text-decoration: none; color: rgb(255, 255, 255);" class="lightbox" style="color: #2146F3; text-decoration:none; font-size:15;" title="Form SPK Marketing" > Form SPK Marketing</a>
                        </font>
                    </div>
                    <div style="float: right;"  class="button-well">
                        <font style="font-size: 100%;" class="button button-primary">
                            <a href="form_spk.php" style="text-decoration: none; color: rgb(255, 255, 255);" class="lightbox" style="color: #2146F3; text-decoration:none; font-size:15;" title="Form SPK Teknisi" > Form SPK Teknisi</a>
                        </font>
                    </div>
		    <div style="float: right;"  class="button-well">
                        <font style="font-size: 100%;" class="button button-primary">
                            <a href="trouble_ticket.php" style="text-decoration: none; color: rgb(255, 255, 255);" class="lightbox" style="color: #2146F3; text-decoration:none; font-size:15;" title="Form Trouble Ticket" > Form Trouble Ticket</a>
                        </font>
                    </div>
                    <div style="float: right;"  class="button-well">
                        <font style="font-size: 100%;" class="button button-primary">
                            <a href="form_complaint.php" style="text-decoration: none; color: rgb(255, 255, 255);" class="lightbox" style="color: #2146F3; text-decoration:none; font-size:15;" title="Form Trouble Ticket" > Form Complaint</a>
                        </font>
                    </div>
	   <hr>
                    <a href="incoming.php?type=complaint" class="btn btn-blue">list Complaint</a>
                    <a href="incoming.php?type=spktech" class="btn btn-orange">List SPK Teknisi</a>
                    <a href="incoming.php?type=spkmkt" class="btn btn-red">List SPK Marketing</a>
                    <a href="incoming.php?type=prospek" class="btn btn-green">List Prospek</a>
                    <a href="incoming.php?type=nonprospek" class="btn btn-black">List Non Prospek</a>
                    <hr>
        <div class="clear">
        
        </div>';
if($_GET["type"] == "nonprospek"){
$content .='
            <form action="incoming.php?type='.$tab.'" method="post" name="form_search_nprospek">
				<table border="0" cellpadding="0" cellspacing="0" class="table" style="width: 100%;">
					<tr>
						<td width="15%">Tanggal :</td>
						<td colspan="5" width="40%">
							    <input type="text" style="width:200px" name="date_nprospek" id="date-picker" class="date-picker" readonly="readonly" value="" />  - <input type="text" style="width:200px" name="date_prospek_to" id="date-picker2" class="date-picker2" readonly="readonly" value="" />
						</td>
					</tr>
					<tr>
						<td width="15%">Nama :</td>
						<td colspan="5" width="40%">
							   <input style="width:350px" type="text" name="name_nprospek" value="" />
						</td>
						
					</tr>
					<tr>
						<td width="15%">Alamat :</td>
						<td colspan="5" width="40%">
							<input style="width:350px" type="text" name="address_nprospek" value="" />
						</td>
					</tr>
					<tr>
						<td width="15%">Note :</td>
						<td colspan="4" width="40%">
							<input style="width:350px" type="text" name="note_nprospek" value="" />
						</td>
						<td>
						
						<div class="button-well">
							<input type="submit" style="font-size: 100%;" class="button button-primary" data-icon="v" name="search_nprospek" value="Search" />
						</div>
						</td>
					</tr>
				</table>
				</form>
			';

if(isset($_POST["search_nprospek"])){

	$date_prospek	= isset($_POST["date_nprospek"]) ? trim(strip_tags($_POST["date_nprospek"])) : "";
	$date_to	= isset($_POST["date_nprospek_to"]) ? trim(strip_tags($_POST["date_nprospek_to"])) : "";
	$name		= isset($_POST["name_nprospek"]) ? trim(strip_tags($_POST["name_nprospek"])) : "";
	$address	= isset($_POST["address_nprospek"]) ? trim(strip_tags($_POST["address_nprospek"])) : "";
	$note		= isset($_POST["note_nprospek"]) ? trim(strip_tags($_POST["note_nprospek"])) : "";
	
	
	if($name == ""){
		$sql_name = "";
		$message_name = "";
	}else{
		$sql_name = "AND `gx_complaint`.`name` LIKE '%$name%'";
		$message_teknisiid = " dengan Nama: $name";
	}
	
	if($address == ""){
		$sql_address = "";
		$message_address = "";
	}else{
		$sql_address = "AND `gx_complaint`.`address` LIKE '%$address%'";
		$message_address = " dengan Address: $address";
	}
	
	if($date_to == ""){
		$sql_date_to = "";
		$message_date_to = "";
	}else{
		$sql_date_to = "AND `gx_complaint`.`date_add` >= '$date_spk' AND `gx_complaint`.`date_add` <= '$date_to' ";
		$message_date_to = " Mulai Dari Tanggal: $date_prospek sampai $date_to";
	}
	
	if($note == ""){
		$sql_note = "";
		$message_note = "";
	}else{
		$sql_note = "AND `gx_complaint`.`note_nclient` LIKE '%$note%'";
		$message_note = "";
	}

	$nprospek	= mysql_query("SELECT `gx_complaint`.*,`gx_employee`.`first_name`,`gx_employee`.`first_name`  FROM  `gx_complaint` ,  `gx_employee` 
				WHERE  `gx_complaint`.`id_cso` =  `gx_employee`.`id_employee` 
				AND  `gx_complaint`.`level` =  '0'
				AND  `gx_complaint`.`type_client` =  'nonclient'
				AND  `gx_complaint`.`status_prospek` =  'nonprospek'
				$sql_name
				$sql_date_to
				$sql_note
				$sql_address
				ORDER BY  `gx_complaint`.`log_time` DESC  LIMIT $start, $perhalaman;")
		or (mysql_error());

	$jum_nprospek = mysql_num_rows(mysql_query("SELECT `gx_complaint`.*,`gx_employee`.`first_name`,`gx_employee`.`first_name` FROM  `gx_complaint` ,  `gx_employee` 
				WHERE  `gx_complaint`.`id_cso` =  `gx_employee`.`id_employee` 
				AND  `gx_complaint`.`level` =  '0'
				AND  `gx_complaint`.`type_client` =  'nonclient'
				AND  `gx_complaint`.`status_prospek` =  'nonprospek'
				$sql_name
				$sql_date_to
				$sql_note
				$sql_address
				ORDER BY  `gx_complaint`.`log_time` DESC"));

	$hal = "?type=nonprospek&";


}else{
	$date_spk	= date("Y-m-d");
	$teknisiid	= isset($_POST["teknisiid"]) ? trim(strip_tags($_POST["teknisiid"])) : "";
	$nprospek	= mysql_query("SELECT `gx_complaint`.*,`gx_employee`.`first_name`,`gx_employee`.`first_name`  FROM  `gx_complaint` ,  `gx_employee` 
				WHERE  `gx_complaint`.`id_cso` =  `gx_employee`.`id_employee` 
				AND  `gx_complaint`.`level` =  '0'
				AND  `gx_complaint`.`type_client` =  'nonclient'
				AND  `gx_complaint`.`status_prospek` =  'nonprospek'
				AND  `gx_complaint`.`date_add` LIKE '%$date_spk%'
				ORDER BY  `gx_complaint`.`log_time` DESC ;")
		or (mysql_error());
 
 	$jum_nprospek = mysql_num_rows(mysql_query("SELECT `gx_complaint`.*,`gx_employee`.`first_name`,`gx_employee`.`first_name`  FROM  `gx_complaint` ,  `gx_employee` 
				WHERE  `gx_complaint`.`id_cso` =  `gx_employee`.`id_employee` 
				AND  `gx_complaint`.`level` =  '0'
				AND  `gx_complaint`.`type_client` =  'nonclient'
				AND  `gx_complaint`.`status_prospek` =  'nonprospek'
				ORDER BY  `gx_complaint`.`log_time` DESC"));

	$hal = "?type=nonprospek&";

	$message_search = '<!--<h3><a href="trouble_ticket.php" title="Form Complaint">Add new data</a></h3>-->
	<span style="float:right;margin:left:10px;"><b>Total Complaint Hari ini: '.$jum_nprospek.'</b></span>';
	$hal = "?";
}

$content .= '
<hr>

<form action="" method="post" name="form_nonprospek" >
	<div class="table-container">
              <table class="data display datatable" style="width: 100%;">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th width="8%">Name</th>
			<th width="10%">Address</th>
			<th width="8%">Phone</th>
			<th width="10%">Email</th>
			<th width="8%">Media</th>
			
			<th width="20%">Note</th>
			<th width="5%">Status</th>
			<th width="10%">Action</th>
			<th width="2%">#</th>
                  </tr>
                </thead>
                <tbody>';


	$no= $start + 1;

	while($row_data = mysql_fetch_array($nprospek)){
		$timediff = round((strtotime(date("Y-m-d")) - strtotime($row_data["date_add"]))/3600, 1);
		$tr_class = "";
		if($row_data["status"] == "open" && $timediff < 24){
			$tr_class = 'class="greenComplaint"';
		}elseif($row_data["status"] == "open" && $timediff >= 24 && $timediff < 36){
			$tr_class = 'class="yellowComplaint"';
		}elseif($row_data["status"] == "open" && $timediff >= 36){
			$tr_class = 'class="redComplaint"';
		}
		

$content .='
	<tr valign="top" '.$tr_class.'>
		<td>'.$no.'.</td>
		<td>'.$row_data["name"].'</td>
		<td>'.$row_data["address"].'</td>
		<td>'.$row_data["phone"].'</td>
		<td>'.$row_data["email"].'</td>
		<td>'.$row_data["media"].'</td>
		
		<td>'.$row_data["note_nclient"].'</td>
		<td>'.$row_data["status_prospek"].'</td>
		<td><a href="detail.php?id_prospek='.$row_data["id_complaint"].'"> View </a></td>
		<td><input type="checkbox" name="id_nprospek[]" value="'.$row_data["id_complaint"].'"><a href="form_complaint.php?id_complaint='.$row_data["id_complaint"].'">edit</a></td>
	</tr>';

	//Detail view
	//<a href="detail_complaint.php?id_complaint='.$row_data["id_complaint"].'" class="lightbox">View</a>
	$no++;
    }

$content .='</tbody>
<tfoot>
<tr><td colspan="10">'.(halaman($jum_nprospek, $perhalaman, 1, "$hal")).'</td></tr>
</tfoot>
</table><br>
</div>
	<div class="actions">
              <div class="button-well">

		<input style="font-size: 100%;" type="submit" class="button button-primary" data-icon="v" name="nprospek" value="Hapus">
              </div>
              
        </div>
</form>';
}elseif($_GET["type"] == "prospek"){
$content .='
                    <form action="incoming.php?type='.$tab.'" method="post" name="form_search_prospek">
				<table border="0" cellpadding="0" cellspacing="0" class="table" style="width: 100%;">
					<tr>
						<td width="15%">Tanggal :</td>
						<td colspan="5" width="40%">
							    <input type="text" style="width:200px" name="date_prospek" id="date-picker" class="date-picker" readonly="readonly" value="" />  - <input type="text" style="width:200px" name="date_prospek_to" id="date-picker2" class="date-picker2" readonly="readonly" value="" />
						</td>
					</tr>
					<tr>
						<td width="15%">Nama :</td>
						<td colspan="5" width="40%">
							   <input style="width:350px" type="text" name="name_prospek" value="" />
						</td>
						
					</tr>
					<tr>
						<td width="15%">Alamat :</td>
						<td colspan="5" width="40%">
							<input style="width:350px" type="text" name="address_prospek" value="" />
						</td>
					</tr>
					<tr>
						<td width="15%">Note :</td>
						<td colspan="4" width="40%">
							<input style="width:350px" type="text" name="note_prospek" value="" />
						</td>
						<td>
						
						<div class="button-well">
							<input type="submit" style="font-size: 100%;" class="button button-primary" data-icon="v" name="search_prospek" value="Search" />
						</div>
						</td>
					</tr>
				</table>
				</form>
			';

if(isset($_POST["search_prospek"])){

	$date_prospek	= isset($_POST["date_prospek"]) ? trim(strip_tags($_POST["date_prospek"])) : "";
	$date_to	= isset($_POST["date_prospek_to"]) ? trim(strip_tags($_POST["date_prospek_to"])) : "";
	$name		= isset($_POST["name_prospek"]) ? trim(strip_tags($_POST["name_prospek"])) : "";
	$address	= isset($_POST["address_prospek"]) ? trim(strip_tags($_POST["address_prospek"])) : "";
	$note		= isset($_POST["note_prospek"]) ? trim(strip_tags($_POST["note_prospek"])) : "";
	
	
	if($name == ""){
		$sql_name = "";
		$message_name = "";
	}else{
		$sql_name = "AND `gx_complaint`.`name` LIKE '%$name%'";
		$message_teknisiid = " dengan Nama: $name";
	}
	
	if($address == ""){
		$sql_address = "";
		$message_address = "";
	}else{
		$sql_address = "AND `gx_complaint`.`address` LIKE '%$address%'";
		$message_address = " dengan Address: $address";
	}
	
	if($date_to == ""){
		$sql_date_to = "";
		$message_date_to = "";
	}else{
		$sql_date_to = "AND `gx_complaint`.`date_add` >= '$date_spk' AND `gx_complaint`.`date_add` <= '$date_to' ";
		$message_date_to = " Mulai Dari Tanggal: $date_prospek sampai $date_to";
	}
	
	if($note == ""){
		$sql_note = "";
		$message_note = "";
	}else{
		$sql_note = "AND `gx_complaint`.`note_nclient` LIKE '%$note%'";
		$message_note = "";
	}

	$prospek	= mysql_query("SELECT `gx_complaint`.*,`gx_employee`.`first_name`,`gx_employee`.`first_name`  FROM  `gx_complaint` ,  `gx_employee` 
				WHERE  `gx_complaint`.`id_cso` =  `gx_employee`.`id_employee` 
				AND  `gx_complaint`.`level` =  '0'
				AND  `gx_complaint`.`type_client` =  'nonclient'
				AND  `gx_complaint`.`status_prospek` =  'prospek'
				$sql_name
				$sql_date_to
				$sql_note
				$sql_address
				ORDER BY  `gx_complaint`.`log_time` DESC  LIMIT $start, $perhalaman;")
		or (mysql_error());
	/*echo "SELECT * FROM `gx_complaint`, `gx_employee` WHERE
				      `gx_complaint`.`id_cso` = `gx_employee`.`id_employee` AND
				      `gx_complaint`.`log_time` LIKE '%$date%' $sql_userid $sql_cso $sql_status $sql_action
				       AND `gx_complaint`.`level` = '0' ORDER BY `gx_complaint`.`log_time` DESC LIMIT $start, $perhalaman;";*/
	$jum_prospek = mysql_num_rows(mysql_query("SELECT `gx_complaint`.*,`gx_employee`.`first_name`,`gx_employee`.`first_name`  FROM  `gx_complaint` ,  `gx_employee` 
				WHERE  `gx_complaint`.`id_cso` =  `gx_employee`.`id_employee` 
				AND  `gx_complaint`.`level` =  '0'
				AND  `gx_complaint`.`type_client` =  'nonclient'
				AND  `gx_complaint`.`status_prospek` =  'prospek'
				$sql_name
				$sql_date_to
				$sql_note
				$sql_address
				ORDER BY  `gx_complaint`.`log_time` DESC"));

	$hal = "?type=prospek&";
}else{
	$date_spk	= date("Y-m-d");
	$teknisiid	= isset($_POST["teknisiid"]) ? trim(strip_tags($_POST["teknisiid"])) : "";
	$prospek	= mysql_query("SELECT `gx_complaint`.*,`gx_employee`.`first_name`,`gx_employee`.`first_name`  FROM  `gx_complaint` ,  `gx_employee` 
				WHERE  `gx_complaint`.`id_cso` =  `gx_employee`.`id_employee` 
				AND  `gx_complaint`.`level` =  '0'
				AND  `gx_complaint`.`type_client` =  'nonclient'
				AND  `gx_complaint`.`status_prospek` =  'prospek'
				AND  `gx_complaint`.`date_add` LIKE '%$date_spk%'
				ORDER BY  `gx_complaint`.`log_time` DESC ;")
		or (mysql_error());
	/*echo "SELECT * FROM `gx_complaint`, `gx_employee` WHERE
				      `gx_complaint`.`id_cso` = `gx_employee`.`id_employee` AND
				      `gx_complaint`.`log_time` LIKE '%$date%' $sql_userid $sql_cso $sql_status $sql_action
				       AND `gx_complaint`.`level` = '0' ORDER BY `gx_complaint`.`log_time` DESC LIMIT $start, $perhalaman;";*/
	$jum_prospek = mysql_num_rows(mysql_query("SELECT `gx_complaint`.*,`gx_employee`.`first_name`,`gx_employee`.`first_name`  FROM  `gx_complaint` ,  `gx_employee` 
				WHERE  `gx_complaint`.`id_cso` =  `gx_employee`.`id_employee` 
				AND  `gx_complaint`.`level` =  '0'
				AND  `gx_complaint`.`type_client` =  'nonclient'
				AND  `gx_complaint`.`status_prospek` =  'prospek'
				ORDER BY  `gx_complaint`.`log_time` DESC"));

	$hal = "?type=prospek&";

	//$message_search = '<h3>List Complaint ('.$month.' - '.$year.')</h3>';
	$message_search = '<!--<h3><a href="trouble_ticket.php" title="Form Complaint">Add new data</a></h3>-->
	<span style="float:right;margin:left:10px;"><b>Total Complaint Hari ini: '.$jum_prospek.'</b></span>';
	$hal = "?";
}

$content .= '
<hr>

<form action="" method="post" name="form_prospek">
	<div class="table-container">
              <table class="data display datatable" style="width: 100%;">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th width="8%">Name</th>
			<th width="10%">Address</th>
			<th width="8%">Phone</th>
			<th width="10%">Email</th>
			<th width="8%">Media</th>
			
			<th width="20%">Note</th>
			<th width="5%">Status</th>
			<th width="10%">Action</th>
			<th width="2%">#</th>
                  </tr>
                </thead>
                <tbody>';


	$no= $start + 1;

	while($row_data = mysql_fetch_array($prospek)){
		$timediff = round((strtotime(date("Y-m-d")) - strtotime($row_data["date_add"]))/3600, 1);
		$tr_class = "";
		if($row_data["status"] == "open" && $timediff < 24){
			$tr_class = 'class="greenComplaint"';
		}elseif($row_data["status"] == "open" && $timediff >= 24 && $timediff < 36){
			$tr_class = 'class="yellowComplaint"';
		}elseif($row_data["status"] == "open" && $timediff >= 36){
			$tr_class = 'class="redComplaint"';
		}
		

$content .='
	<tr valign="top" '.$tr_class.'>
		<td>'.$no.'.</td>
		<td>'.$row_data["name"].'</td>
		<td>'.$row_data["address"].'</td>
		<td>'.$row_data["phone"].'</td>
		<td>'.$row_data["email"].'</td>
		<td>'.$row_data["media"].'</td>
		
		<td>'.$row_data["note_nclient"].'</td>
		<td>'.$row_data["status_prospek"].'</td>
		<td><a href="detail.php?id_prospek='.$row_data["id_complaint"].'"> View </a></td>
		<td><input type="checkbox" name="id_prospek[]" value="'.$row_data["id_complaint"].'"><a href="form_complaint.php?id_complaint='.$row_data["id_complaint"].'">edit</a></td>
	</tr>';

	//Detail view
	//<a href="detail_complaint.php?id_complaint='.$row_data["id_complaint"].'" class="lightbox">View</a>
	$no++;
    }

$content .='</tbody>
<tfoot>
<tr><td colspan="10">'.(halaman($jum_prospek, $perhalaman, 1, "$hal")).'</td></tr>
</tfoot>
</table><br>
</div>
	<div class="actions">
              <div class="button-well">

		<input type="submit" style="font-size: 100%;" class="button button-primary" data-icon="v" name="prospek" value="Hapus">
              </div>
              
        </div>
</form>';
}elseif($_GET["type"] == "spktech"){
$content .='
                    <form action="incoming.php?type='.$tab.'" method="post" name="form_search_spk_tech">
				<table border="0" cellpadding="0" cellspacing="0" class="table">
					<tr>
						<td width="15%">Tanggal :</td>
					<td colspan="4" width="40%">
							    <input type="text" style="width:200px" name="date_spk" id="date-picker" class="date-picker" readonly="readonly" value="" />  - <input type="text" style="width:200px" name="date_to" id="date-picker2" class="date-picker2" readonly="readonly" value="" />
						</td>
					</tr>
					<tr>
						<td width="15%">ID Teknisi:</td>
						<td colspan="4" width="40%">
                                                            <input type="text" name="teknisiid" value="" />
						</td>
						<td>
						
						<div class="button-well">
							<input type="submit" style="font-size: 100%;" class="button button-primary" data-icon="v" name="search_spk" value="Search" />
						</div>
						</td>
					</tr>
				</table>
				</form>
			';

if(isset($_POST["search_spk"])){

	$date_spk	= isset($_POST["date_spk"]) ? trim(strip_tags($_POST["date_spk"])) : "";
	$date_to	= isset($_POST["date_to"]) ? trim(strip_tags($_POST["date_to"])) : "";
	$teknisiid	= isset($_POST["teknisiid"]) ? trim(strip_tags($_POST["teknisiid"])) : "";
	
	
	if($teknisiid == ""){
		$sql_teknisiid = "";
		$message_teknisiid = "";
	}else{
		$sql_teknisiid = "AND `users`.`username` LIKE '%$teknisiid%'";
		$message_teknisiid = " dengan User ID: $teknisiid";
	}
	
	if($date_to == ""){
		$sql_date_to = "";
		$message_date_to = "";
	}else{
		$sql_date_to = "AND `gx_spk`.`date_add` >= '$date_spk' AND `gx_spk`.`date_add` <= '$date_to' ";
		$message_date_to = " Mulai Dari Tanggal: $date_spk sampai $date_to";
	}
	
	/*if($date == ""){
		$date = date("Y-m-d");
	}*/

	$spk	= mysql_query("SELECT  `gx_spk`. * ,  `gx_employee`.`first_name` , `users`.`username`,  `gx_employee`.`last_name` ,  `gx_complaint`.`name` , `gx_complaint`.`status` ,  `gx_complaint`.`note_nclient` ,  `gx_complaint`.`address` ,  `gx_complaint`.`email` ,  `gx_complaint`.`phone` 
                                FROM  `gx_spk` ,  `gx_complaint` ,  `gx_employee` , `users`
                                WHERE  `spk_number` LIKE  '%MCT%'
                                AND  `gx_spk`.`id_complaint` =  `gx_complaint`.`id_complaint` 
                                AND  `gx_spk`.`id_teknisi` =  `gx_employee`.`id_employee`
                                AND  `gx_spk`.`id_teknisi` =  `users`.`id_user`
                                $sql_date_to $sql_teknisiid 
                                AND `gx_spk`.`level` = '0' ORDER BY `gx_spk`.`date_add` DESC LIMIT $start, $perhalaman;")
		or (mysql_error());
	/*echo "SELECT * FROM `gx_complaint`, `gx_employee` WHERE
				      `gx_complaint`.`id_cso` = `gx_employee`.`id_employee` AND
				      `gx_complaint`.`log_time` LIKE '%$date%' $sql_userid $sql_cso $sql_status $sql_action
				       AND `gx_complaint`.`level` = '0' ORDER BY `gx_complaint`.`log_time` DESC LIMIT $start, $perhalaman;";*/
	$jum_spk = mysql_num_rows(mysql_query("SELECT `gx_spk`.*, `gx_complaint`.`user_id`,  `users`.`username` , `gx_complaint`.`name`, `gx_complaint`.`address`,
                                      `gx_complaint`.`phone`, `gx_complaint`.`connection_type`, `gx_complaint`.`solusi`,
                                      `gx_complaint`.`status`, `user_details`.`first_name`, `user_details`.`last_name`
				      FROM `gx_spk`, `gx_complaint`,`user_details`,`users` 
                                      WHERE `gx_spk`.`id_trouble_ticket` = `gx_complaint`.`ticket_number`
                                      AND `gx_spk`.`id_teknisi` = `user_details`.`id_user`
				      AND  `gx_spk`.`id_teknisi` =  `users`.`id_user`
				      AND `gx_spk`.`spk_number` LIKE '%MCT-%'
				      $sql_date_to $sql_teknisiid 
				      AND `gx_spk`.`level` = '0'"));

	$hal = "?type=spktech";

	if($date_spk == ""){
		$message_search = '<h3>List Complaint '.$message_teknisiid.' '.$message_date_to.'</h3>';
	}else{
		$message_search = '<h3>List Complaint ('.$date_spk.')'.$message_teknisiid.' '.$message_date_to.'</h3>';
	}


}elseif(isset($_GET["date"]) && isset($_GET["tid"])){

	$date_spk	= isset($_POST["date_spk"]) ? trim(strip_tags($_POST["date_spk"])) : "";
	$date_to	= isset($_POST["date_to"]) ? trim(strip_tags($_POST["date_to"])) : "";
	$teknisiid	= isset($_POST["teknisiid"]) ? trim(strip_tags($_POST["teknisiid"])) : "";
	
	
	
	if($teknisiid == ""){
		$sql_teknisiid = "";
		$message_userid = "";
	}else{
		$sql_teknisiid = "AND `gx_spk`.`id_teknisi` LIKE '%$teknisiid%'";
		$message_userid = " dengan User ID: $teknisiid";
	}

	/*if($date == ""){
		$date = date("Y-m-d");
	}*/
	$spk	= mysql_query("SELECT `gx_spk`.*, `gx_complaint`.`user_id`,  `users`.`username` , `gx_complaint`.`name`, `gx_complaint`.`address`,
                                      `gx_complaint`.`phone`, `gx_complaint`.`connection_type`, `gx_complaint`.`solusi`,
                                      `gx_complaint`.`status`, `user_details`.`first_name`, `user_details`.`last_name`
				      FROM `gx_spk`, `gx_complaint`,`user_details`,`users` 
                                      WHERE `gx_spk`.`id_trouble_ticket` = `gx_complaint`.`ticket_number`
                                      AND `gx_spk`.`id_teknisi` = `user_details`.`id_user`
				      AND  `gx_spk`.`id_teknisi` =  `users`.`id_user`
				      AND `gx_spk`.`spk_number` LIKE '%MCT-%'
				      $sql_date_to $sql_teknisiid 
				      AND `gx_spk`.`level` = '0' ORDER BY `gx_spk`.`date_add` DESC LIMIT $start, $perhalaman;")
		or (mysql_error());
	/*echo "SELECT * FROM `gx_complaint`, `gx_employee` WHERE
				      `gx_complaint`.`id_cso` = `gx_employee`.`id_employee` AND
				      `gx_complaint`.`log_time` LIKE '%$date%' $sql_userid $sql_cso $sql_status $sql_action
				       AND `gx_complaint`.`level` = '0' ORDER BY `gx_complaint`.`log_time` DESC LIMIT $start, $perhalaman;";*/
	$jum_spk = mysql_num_rows(mysql_query("SELECT `gx_spk`.*, `gx_complaint`.`user_id`,  `users`.`username` , `gx_complaint`.`name`, `gx_complaint`.`address`,
                                      `gx_complaint`.`phone`, `gx_complaint`.`connection_type`, `gx_complaint`.`solusi`,
                                      `gx_complaint`.`status`, `user_details`.`first_name`, `user_details`.`last_name`
				      FROM `gx_spk`, `gx_complaint`,`user_details`,`users` 
                                      WHERE `gx_spk`.`id_trouble_ticket` = `gx_complaint`.`ticket_number`
                                      AND `gx_spk`.`id_teknisi` = `user_details`.`id_user`
				      AND  `gx_spk`.`id_teknisi` =  `users`.`id_user`
				      AND `gx_spk`.`spk_number` LIKE '%MCT-%'
				      $sql_date_to $sql_teknisiid 
				      AND `gx_spk`.`level` = '0'"));

	$hal = "?type=spktech";


	if($date == ""){
		$message_search = '<h3>List Complaint '.$message_userid.'</h3>';
	}else{
		$message_search = '<h3>List Complaint ('.$date.')'.$message_userid.'</h3>';
	}
}else{
	$date_spk	= date("Y-m-d");
	$teknisiid	= isset($_POST["teknisiid"]) ? trim(strip_tags($_POST["teknisiid"])) : "";
	$spk	= mysql_query("SELECT  `gx_spk`. * ,  `gx_employee`.`first_name` ,  `gx_employee`.`last_name` ,  `gx_complaint`.`name` , `gx_complaint`.`status` ,  `gx_complaint`.`note_nclient` ,  `gx_complaint`.`address` ,  `gx_complaint`.`email` ,  `gx_complaint`.`phone` 
                                FROM  `gx_spk` ,  `gx_complaint` ,  `gx_employee` 
                                WHERE  `spk_number` LIKE  '%MCT%'
                                AND  `gx_spk`.`id_complaint` =  `gx_complaint`.`id_complaint` 
                                AND  `gx_spk`.`level` =  '0'
                                AND  `gx_spk`.`id_teknisi` =  `gx_employee`.`id_employee`
				AND  `gx_spk`.`date_add` LIKE '%$date_spk%'
                                ORDER BY  `gx_spk`.`date_add` DESC  ;")
		or (mysql_error());
	/*echo "SELECT * FROM `gx_complaint`, `gx_employee` WHERE
				      `gx_complaint`.`id_cso` = `gx_employee`.`id_employee` AND
				      `gx_complaint`.`log_time` LIKE '%$date%' $sql_userid $sql_cso $sql_status $sql_action
				       AND `gx_complaint`.`level` = '0' ORDER BY `gx_complaint`.`log_time` DESC LIMIT $start, $perhalaman;";*/
	$jum_spk = mysql_num_rows(mysql_query("SELECT  `gx_spk`. * ,  `gx_employee`.`first_name` ,  `gx_employee`.`last_name` ,  `gx_complaint`.`name` , `gx_complaint`.`status` ,  `gx_complaint`.`note_nclient` ,  `gx_complaint`.`address` ,  `gx_complaint`.`email` ,  `gx_complaint`.`phone` 
                                FROM  `gx_spk` ,  `gx_complaint` ,  `gx_employee` 
                                WHERE  `spk_number` LIKE  '%MCT%'
                                AND  `gx_spk`.`id_complaint` =  `gx_complaint`.`id_complaint` 
                                AND  `gx_spk`.`level` =  '0'
                                AND  `gx_spk`.`id_teknisi` =  `gx_employee`.`id_employee` 
                                ORDER BY  `gx_spk`.`date_add` DESC "));

	$hal = "?type=spktech";

	//$message_search = '<h3>List Complaint ('.$month.' - '.$year.')</h3>';
	$message_search = '<!--<h3><a href="trouble_ticket.php" title="Form Complaint">Add new data</a></h3>-->
	<span style="float:right;margin:left:10px;"><b>Total Complaint Hari ini: '.$jum_spk.'</b></span>';
	$hal = "?type=spktech";
}

$content .= '
<hr>

<form action="" method="post" name="form_spk_tech">
	<div class="table-container">
              <table class="data display datatable">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th width="10%">No SPK</th>
			<th width="10%">Teknisi</th>
			<th width="8%">Cust ID</th>
			<th width="18%">Complaint</th>
			<th width="10%">Date</th>
			
			<th width="10%">Status</th>
			<th width="5%">Action</th>
			<th width="2%">#</th>
                  </tr>
                </thead>
                <tbody>';
	$no= $start + 1;
	while($row_data = mysql_fetch_array($spk)){
		$timediff = round((strtotime(date("Y-m-d")) - strtotime($row_data["date_add"]))/3600, 1);
		$tr_class = "";
		if($row_data["status"] == "open" && $timediff < 24){
			$tr_class = 'class="greenComplaint"';
		}elseif($row_data["status"] == "open" && $timediff >= 24 && $timediff < 36){
			$tr_class = 'class="yellowComplaint"';
		}elseif($row_data["status"] == "open" && $timediff >= 36){
			$tr_class = 'class="redComplaint"';
		}
		

$content .='
	<tr valign="top" '.$tr_class.'>
		<td>'.$no.'.</td>
		<td>'.$row_data["spk_number"].'</td>
		<td>'.$row_data["first_name"].' '.$row_data["last_name"].'</td>
		<td>'.$row_data["name"].'</td>
		<td>'.$row_data["problem"].'</td>
		<td>'.date("d-m-Y", strtotime($row_data["date_add"])).'</td>
		
		<td>'.(($row_data["status"] == "cleared") ? $row_data["status"] : '<a href="jawab_spk.php?id_spk='.$row_data["id_spk"].'">'.$row_data["status"].'</a>' ).'</td>
		<td><a href="detail.php?id_spk='.$row_data["id_spk"].'">View</a></td>
		<td><input type="checkbox" name="id_spk[]" value="'.$row_data["id_spk"].'"><a href="form_spk.php?id_spk='.$row_data["id_spk"].'">edit</a></td>
	</tr>';

	//Detail view
	//<a href="detail_complaint.php?id_complaint='.$row_data["id_complaint"].'" class="lightbox">View</a>
	$no++;
    }

$content .='</tbody>
<tfoot>
<tr><td colspan="10">'.(halaman($jum_spk, $perhalaman, 1, "$hal")).'</td></tr>
</tfoot>
</table><br>
</div>
	<div class="actions">
              <div class="button-well">

		<input type="submit" style="font-size: 100%;" class="button button-primary" data-icon="v" name="spk" value="Hapus">
              </div>
              
        </div>
</form>';
}elseif($_GET["type"] == "spkmkt"){
$content .='
                    <form action="incoming.php?type=spkmkt" method="post" name="form_search_spk_marketing">
				<table border="0" cellpadding="0" cellspacing="0" class="table">
					<tr>
						<td width="15%">Tanggal :</td>
					<td colspan="4" width="40%">
							    <input type="text" style="width:200px" name="date_spk" id="date-picker" class="date-picker" readonly="readonly" value="" />  - <input type="text" style="width:200px" name="date_to" id="date-picker2" class="date-picker2" readonly="readonly" value="" />
						</td>
					</tr>
					<tr>
						<td width="15%">ID Marketing:</td>
						<td colspan="4" width="40%">
							<input type="text" name="marketingid" value="" />
						</td>
						<td>
						
						<div class="button-well">
							<input type="submit" style="font-size: 100%;" class="button button-primary" data-icon="v" name="search_spk_marketing" value="Search" />
						</div>
						</td>
					</tr>
				</table>
				</form>
			';

if(isset($_POST["search_spk_marketing"])){

	$date_spk	= isset($_POST["date_spk"]) ? trim(strip_tags($_POST["date_spk"])) : "";
	$date_to	= isset($_POST["date_to"]) ? trim(strip_tags($_POST["date_to"])) : "";
	$marketingid	= isset($_POST["marketingid"]) ? trim(strip_tags($_POST["marketingid"])) : "";
	
	
	if($marketingid == ""){
		$sql_teknisiid = "";
		$message_teknisiid = "";
	}else{
		$sql_teknisiid = "AND `users`.`username` LIKE '%$marketingid%'";
		$message_teknisiid = " dengan User ID: $marketingid";
	}
	
	if($date_to == ""){
		$sql_date_to = "";
		$message_date_to = "";
	}else{
		$sql_date_to = "AND `gx_spk`.`date_add` >= '$date_spk' AND `gx_spk`.`date_add` <= '$date_to' ";
		$message_date_to = " Mulai Dari Tanggal: $date_spk sampai $date_to";
	}
	
	/*if($date == ""){
		$date = date("Y-m-d");
	}*/

	$spk_marketing	= mysql_query("SELECT  `gx_spk` . * ,  `gx_employee`.`first_name` , `users`.`username`,  `gx_employee`.`last_name` ,  `gx_complaint`.`name` ,  `gx_complaint`.`note_nclient` ,  `gx_complaint`.`address` ,  `gx_complaint`.`email` ,  `gx_complaint`.`phone` 
					FROM  `gx_spk` ,  `gx_complaint` ,  `gx_employee` , `users`
					WHERE  `spk_number` LIKE  '%MST%'
					AND  `gx_spk`.`id_complaint` =  `gx_complaint`.`id_complaint` 
					AND  `gx_spk`.`level` =  '0'
					AND  `gx_spk`.`id_marketing` =  `gx_employee`.`id_employee`
                                        AND  `gx_spk`.`id_marketing` =  `users`.`id_user`
				      $sql_date_to $sql_teknisiid 
				      ORDER BY `gx_spk`.`date_add` DESC LIMIT $start, $perhalaman;")
		or (mysql_error());
	/*echo "SELECT * FROM `gx_complaint`, `gx_employee` WHERE
				      `gx_complaint`.`id_cso` = `gx_employee`.`id_employee` AND
				      `gx_complaint`.`log_time` LIKE '%$date%' $sql_userid $sql_cso $sql_status $sql_action
				       AND `gx_complaint`.`level` = '0' ORDER BY `gx_complaint`.`log_time` DESC LIMIT $start, $perhalaman;";*/
	$jum_spk_marketing = mysql_num_rows(mysql_query("SELECT  `gx_spk` . * ,  `gx_employee`.`first_name` , `users`.`username`,  `gx_employee`.`last_name` ,  `gx_complaint`.`name` ,  `gx_complaint`.`note_nclient` ,  `gx_complaint`.`address` ,  `gx_complaint`.`email` ,  `gx_complaint`.`phone` 
					FROM  `gx_spk` ,  `gx_complaint` ,  `gx_employee` , `users`
					WHERE  `spk_number` LIKE  '%MST%'
					AND  `gx_spk`.`id_complaint` =  `gx_complaint`.`id_complaint` 
					AND  `gx_spk`.`level` =  '0'
					AND  `gx_spk`.`id_marketing` =  `gx_employee`.`id_employee`
                                        AND  `gx_spk`.`id_marketing` =  `users`.`id_user`
				      $sql_date_to $sql_teknisiid 
				      ORDER BY `gx_spk`.`date_add` DESC
				     "));

	$hal = "?type=spkmkt";

	if($date_spk == ""){
		$message_search = '<h3>List Complaint '.$message_teknisiid.' '.$message_date_to.'</h3>';
	}else{
		$message_search = '<h3>List Complaint ('.$date_spk.')'.$message_teknisiid.' '.$message_date_to.'</h3>';
	}


}else{
	$date_spk	= date("Y-m-d");
	$teknisiid	= isset($_POST["teknisiid"]) ? trim(strip_tags($_POST["teknisiid"])) : "";
	$spk_marketing	= mysql_query("SELECT  `gx_spk` . * ,  `gx_employee`.`first_name` ,  `gx_employee`.`last_name` ,  `gx_complaint`.`name` ,  `gx_complaint`.`note_nclient` ,  `gx_complaint`.`address` ,  `gx_complaint`.`email` ,  `gx_complaint`.`phone` 
					FROM  `gx_spk` ,  `gx_complaint` ,  `gx_employee` 
					WHERE  `spk_number` LIKE  '%MST%'
					AND  `gx_spk`.`id_complaint` =  `gx_complaint`.`id_complaint` 
					AND  `gx_spk`.`level` =  '0'
					AND  `gx_spk`.`date_add` LIKE '%$date_spk%'
					AND  `gx_spk`.`id_marketing` =  `gx_employee`.`id_employee`  ORDER BY `gx_spk`.`date_add` DESC ;")
		or (mysql_error());
	/*echo "SELECT * FROM `gx_complaint`, `gx_employee` WHERE
				      `gx_complaint`.`id_cso` = `gx_employee`.`id_employee` AND
				      `gx_complaint`.`log_time` LIKE '%$date%' $sql_userid $sql_cso $sql_status $sql_action
				       AND `gx_complaint`.`level` = '0' ORDER BY `gx_complaint`.`log_time` DESC LIMIT $start, $perhalaman;";*/
	$jum_spk_marketing = mysql_num_rows(mysql_query("SELECT  `gx_spk` . * ,  `gx_employee`.`first_name` ,  `gx_employee`.`last_name` ,  `gx_complaint`.`name` ,  `gx_complaint`.`note_nclient` ,  `gx_complaint`.`address` ,  `gx_complaint`.`email` ,  `gx_complaint`.`phone` 
							FROM  `gx_spk` ,  `gx_complaint` ,  `gx_employee` 
							WHERE  `spk_number` LIKE  '%MST%'
							AND  `gx_spk`.`id_complaint` =  `gx_complaint`.`id_complaint` 
							AND  `gx_spk`.`level` =  '0'
							AND  `gx_spk`.`id_marketing` =  `gx_employee`.`id_employee`"));

	$hal = "?type=spkmkt";

	//$message_search = '<h3>List Complaint ('.$month.' - '.$year.')</h3>';
	$message_search = '<!--<h3><a href="trouble_ticket.php" title="Form Complaint">Add new data</a></h3>-->
	<span style="float:right;margin:left:10px;"><b>Total Complaint Hari ini: '.$jum_spk_marketing.'</b></span>';
	$hal = "?type=spkmkt";
}

$content .= '
<hr>

<form action="" method="post" name="form_spk_marketing">
	<div class="table-container">
              <table class="data display datatable">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th width="10%">No SPK</th>
			<th width="10%">Marketing</th>
			<th width="8%">Name</th>
			<th width="10%">Address</th>
			<th width="18%">Note</th>
			
			<th width="10%">Date</th>
			<th width="5%">Action</th>
			<th width="2%">#</th>
                  </tr>
                </thead>
                <tbody>';


	$no= $start + 1;

	while($row_data = mysql_fetch_array($spk_marketing)){
		$timediff = round((strtotime(date("Y-m-d")) - strtotime($row_data["date_add"]))/3600, 1);
		$tr_class = "";
		/*if($row_data["status"] == "open" && $timediff < 24){
			$tr_class = 'class="greenComplaint"';
		}elseif($row_data["status"] == "open" && $timediff >= 24 && $timediff < 36){
			$tr_class = 'class="yellowComplaint"';
		}elseif($row_data["status"] == "open" && $timediff >= 36){
			$tr_class = 'class="redComplaint"';
		}*/
		

$content .='
	<tr valign="top" '.$tr_class.'>
		<td>'.$no.'.</td>
		<td>'.$row_data["spk_number"].'</td>
		<td>'.$row_data["first_name"].' '.$row_data["last_name"].'</td>
		<td>'.$row_data["name"].'</td>
		<td>'.$row_data["address"].'</td>
		<td>'.$row_data["note_nclient"].'</td>
		
		<td>'.date("d-m-Y", strtotime($row_data["date_add"])).'</td>
		<td><a href="detail.php?id_spk_survey='.$row_data["id_spk"].'">View</a></td>
		<td><input type="checkbox" name="id_spk[]" value="'.$row_data["id_spk"].'"><a href="form_spk_mar.php?id_spk='.$row_data["id_spk"].'">edit</a></td>
	</tr>';

	//Detail view
	//<a href="detail_complaint.php?id_complaint='.$row_data["id_complaint"].'" class="lightbox">View</a>
	$no++;
    }

$content .='</tbody>
<tfoot>
<tr><td colspan="10">'.(halaman($jum_spk_marketing, $perhalaman, 1, "$hal")).'</td></tr>
</tfoot>
</table><br>
</div>
	<div class="actions">
              <div class="button-well">

		<input type="submit" style="font-size: 100%;" class="button button-primary" data-icon="v" name="spk" value="Hapus">
              </div>
              
        </div>
</form>';

}elseif($_GET["type"] == "complaint"){
    $sql_cso = mysql_query("SELECT `u`.`username`, `ud`.`first_name`, `ud`.`last_name`, `ud`.`id_employee` FROM `gx_employee` ud, `users` u WHERE `ud`.`id_employee` = `u`.`id_user` AND `ud`.`level` = '0' AND `u`.`group` = 'cso'");
$content .='
                    <form action="incoming.php?type=complaint" method="post" name="form_search_complaint">
				<table border="0" cellpadding="0" cellspacing="0" class="table">
					<tr>
						<td width="15%">Tanggal :</td>
					<td colspan="5" width="40%">
							 <input type="text" style="width:200px" name="date" id="date-picker" class="date-picker" readonly="readonly" value="" /> - <input type="text"  style="width:200px" name="date_to" id="date-picker2"  class="date-picker2" readonly="readonly" value="" />
						</td>
						
					</tr>
					<tr>
						<td width="15%">CSO :</td>
						<td colspan="4" width="40%">
							
							<select name="cso" style="width:200px;">
							<option value="">All CSO</option>
							';
							while($row_cso = mysql_fetch_array($sql_cso)){
								$content .= '<option value="'.$row_cso["id_employee"].'"><div class="divSelect">'.$row_cso["username"].'</div></option>';
							}
							$content .= '</select>
						</td>
						<td>Action:
						<select name="action" style="width:200px;">
							<option value="">Choose one</option>
							<option value="pending">Pending</option>
							<option value="today">Scheduled today</option>
							<option value="tomorrow">Scheduled tomorrow</option>
						</select>
						</td>
					</tr>
					<!--<tr>
						<td width="15%">Status :</td>
						<td colspan="4" width="40%">
							<select name="status">
								<option value="">Choose one</option>
								<option value="cleared" style="font-size:20px;">Cleared</option>
								<option value="uncleared">Uncleared</option>
								<option value="pending">Pending</option>
								<option value="today">Scheduled today</option>
								<option value="tomorrow">Scheduled tomorrow</option>
							</select>
						</td>
					</tr>-->
					<tr>
						<td width="15%">User ID :</td>
						<td colspan="4" width="40%">
							<input type="text" class="medium" name="userid" value="" />
						</td>
						<td>Status :
						<select name="status" style="width:150px;">
							<option value="">Choose one</option>
							<option value="open">Open</option>
							<option value="closed">Closed</option>
							<option value="reopen">Reopen</option>
						</select>&nbsp;
						<div class="button-well">
							<input type="submit" style="font-size: 100%;" class="button button-primary" data-icon="v" name="search" value="Search" />
						</div>
						</td>
					</tr>
				</table>
				</form>
			';

if(isset($_POST["search"])){

	$date		= isset($_POST["date"]) ? trim(strip_tags($_POST["date"])) : "";
	$date_to	= isset($_POST["date_to"]) ? trim(strip_tags($_POST["date_to"])) : "";
	$id_cso		= isset($_POST["cso"]) ? trim(strip_tags($_POST["cso"])) : "";
	$userid		= isset($_POST["userid"]) ? trim(strip_tags($_POST["userid"])) : "";
	$status		= isset($_POST["status"]) ? trim(strip_tags($_POST["status"])) : "";
	$action		= isset($_POST["action"]) ? trim(strip_tags($_POST["action"])) : "";
	$sql_status	= ($status != "") ? "AND `gx_complaint`.`status` = '$status'" : "";
	$message_status = ($status != "") ? " dengan Status: $status" : "";
	$sql_action	= ($action != "") ? "AND `gx_complaint`.`action` = '$action'" : "";
	$message_action = ($action != "") ? " dengan Action: $action" : "";


	$sql_name	= mysql_query("SELECT `first_name` FROM `gx_employee` WHERE `id_employee` = '$id_cso' LIMIT 0,1");
	$row_name	= mysql_fetch_array($sql_name);

	if($id_cso == ""){
		$sql_cso	= "";
		//$id_cso		= $loggedin["id_user"];
		$id_cso		= "";
		$id_cso2	= "";
		$message_cso	= "";
	}else{
		$sql_cso	= "AND `gx_complaint`.`id_cso` ='$id_cso'";
		$message_cso	= " dengan CSO: ".$row_name["first_name"];
		$id_cso2	= $id_cso;
	}

	if($userid == ""){
		$sql_userid = "";
		$message_userid = "";
	}else{
		$sql_userid = "AND `gx_complaint`.`user_id` LIKE '%$userid%'";
		$message_userid = " dengan User ID: $userid";
	}
	
	if($date_to == ""){
		$sql_date_to = "";
		$message_date_to = "";
	}else{
		$sql_date_to = "AND `gx_complaint`.`log_time` >= '$date' AND `gx_complaint`.`log_time` <= '$date_to' ";
		$message_date_to = " Mulai Dari Tanggal: $date sampai $date_to";
	}

	/*if($date == ""){
		$date = date("Y-m-d");
	}*/

	$complaint	= mysql_query("SELECT * FROM `gx_complaint`, `gx_employee` WHERE
				      `gx_complaint`.`id_cso` = `gx_employee`.`id_employee` $sql_userid $sql_date_to $sql_cso $sql_status $sql_action
				       AND `gx_complaint`.`level` = '0' ORDER BY `gx_complaint`.`log_time` DESC LIMIT $start, $perhalaman;")
		or (mysql_error());
	/*echo "SELECT * FROM `gx_complaint`, `gx_employee` WHERE
				      `gx_complaint`.`id_cso` = `gx_employee`.`id_employee` AND
				      `gx_complaint`.`log_time` LIKE '%$date%' $sql_userid $sql_cso $sql_status $sql_action
				       AND `gx_complaint`.`level` = '0' ORDER BY `gx_complaint`.`log_time` DESC LIMIT $start, $perhalaman;";*/
	$jum_complaint = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `gx_employee` WHERE
				      `gx_complaint`.`id_cso` = `gx_employee`.`id_employee` $sql_date_to $sql_userid $sql_cso $sql_status $sql_action
				       AND `gx_complaint`.`level` = '0'"));

	$hal = "?type=complaint&";

	if($date == ""){
		$message_search = '<h3>List Complaint '.$message_cso.$message_userid.$message_date_to.$message_status.$message_action.'</h3>';
	}else{
		$message_search = '<h3>List Complaint ('.$date.')'.$message_cso.$message_userid.$message_date_to.$message_status.$message_action.'</h3>';
	}


}elseif(isset($_GET["date"]) && isset($_GET["cso"]) && isset($_GET["uid"]) && isset($_GET["status"]) ){

	$date		= isset($_GET["date"]) ? trim(strip_tags($_GET["date"])) : "";
	$date_to	= isset($_POST["date_to"]) ? trim(strip_tags($_POST["date_to"])) : "";
	$id_cso		= isset($_GET["cso"]) ? trim(strip_tags($_GET["cso"])) : "";
	$userid		= isset($_GET["uid"]) ? trim(strip_tags($_GET["uid"])) : "";
	$status		= isset($_GET["status"]) ? trim(strip_tags($_GET["status"])) : "";
	$action		= isset($_GET["act"]) ? trim(strip_tags($_GET["act"])) : "";
	$sql_status	= ($status != "") ? "AND `gx_complaint`.`status` = '$status'" : "";
	$message_status = ($status != "") ? " dengan Status: $status" : "";
	$sql_action	= ($action != "") ? "AND `gx_complaint`.`action` = '$action'" : "";
	$message_action = ($action != "") ? " dengan Action: $action" : "";

	//echo $date.'<br>';
	//echo $id_cso.'<br>';
	//echo $userid.'<br>';

	$sql_name	= mysql_query("SELECT `first_name` FROM `gx_employee` WHERE `id_employee` = '$id_cso' LIMIT 0,1");
	$row_name	= mysql_fetch_array($sql_name);

	if($id_cso == ""){
		$sql_cso	= "";
		$id_cso		= $loggedin["id_user"];
		$id_cso2	= "";
		$message_cso	= "";
	}else{
		$sql_cso	= "AND `gx_complaint`.`id_cso` ='$id_cso'";
		$message_cso	= " dengan CSO: ".$row_name["first_name"];
		$id_cso2	= $id_cso;
	}

	if($userid == ""){
		$sql_userid = "";
		$message_userid = "";
	}else{
		$sql_userid = "AND `gx_complaint`.`user_id` LIKE '%$userid%'";
		$message_userid = " dengan User ID: $userid";
	}
	
	
	if($date_to == ""){
		$sql_date_to = "";
		$message_userid = "";
	}else{
		$sql_date_to = "AND `gx_complaint`.`log_time` >= '$date' AND `gx_complaint`.`log_time` <= '$date_to' ";
		$message_date_to = " Mulai Dari Tanggal: $date sampai $date_to";
	}
	
	/*if($date == ""){
		$date = date("Y-m-d");
	}*/
	$complaint	= mysql_query("SELECT * FROM `gx_complaint`, `gx_employee` WHERE
				      `gx_complaint`.`id_cso` = `gx_employee`.`id_employee` $sql_date_to $sql_userid $sql_cso $sql_status $sql_action
				       AND `gx_complaint`.`level` = '0' ORDER BY `gx_complaint`.`log_time` DESC LIMIT $start, $perhalaman;")
		or (mysql_error());
		
	$jum_complaint = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `gx_employee` WHERE
				      `gx_complaint`.`id_cso` = `gx_employee`.`id_employee` $sql_userid $sql_date_to $sql_cso $sql_status $sql_action
				       AND `gx_complaint`.`level` = '0'"));

	$hal = "?date=$date&cso=$id_cso2&uid=$userid&status=$status&act=$action&";

	if($date == ""){
		$message_search = '<h3>List Complaint '.$message_cso.$message_userid.$message_status.$message_action.'</h3>';
	}else{
		$message_search = '<h3>List Complaint ('.$date.')'.$message_cso.$message_userid.$message_status.$message_action.'</h3>';
	}
}else{
	$date		= date("Y-m-d");
	$id_cso		= $loggedin["id_user"];

	$complaint	= mysql_query("SELECT * FROM `gx_complaint`, `gx_employee` WHERE
				      `gx_complaint`.`id_cso` = `gx_employee`.`id_employee` AND
				      `gx_complaint`.`type_client` = 'client' AND
				      `gx_complaint`.`level` = '0' AND
				      `gx_complaint`.`date_add` LIKE '%$date%'
				      ORDER BY 	`gx_complaint`.`log_time` DESC
				      ") or (mysql_error());

	$jum_complaint = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint`, `gx_employee` WHERE
				      `gx_complaint`.`id_cso` = `gx_employee`.`id_employee` AND
				      `gx_complaint`.`type_client` = 'client' AND
				      `gx_complaint`.`level` = '0'"));
	//$message_search = '<h3>List Complaint ('.$month.' - '.$year.')</h3>';
	$message_search = '<h3><a href="trouble_ticket.php" title="Form Complaint">Add new data</a></h3>
	<span style="float:right;margin:left:10px;"><b>Total Complaint Hari ini: '.$jum_complaint.'</b></span>';
	$hal = "?type=complaint&";
}

$content .= '
<hr>
<form action="" method="post" name="form_complaint">
	<div class="table-container">
              <table class="data display datatable">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th width="10%">CSO</th>
			<th width="10%">Cust ID</th>
			<th width="8%">User ID</th>
			<th width="8%">Tanggal</th>
			<th width="10%">Name</th>
			<th width="10%" style="text-align:center">Problem</th>
			<th width="10%">Status</th>
			<th width="15%">Action</th>
			<th width="2%">#</th>
                  </tr>
                </thead>
                <tbody>';


	$no= $start + 1;

	while($row_data = mysql_fetch_array($complaint)){
		$timediff = round((strtotime(date("Y-m-d")) - strtotime($row_data["log_time"]))/3600, 1);
		$tr_class = "";
		if($row_data["status"] == "open" && $timediff < 24){
			$tr_class = 'class="greenComplaint"';
		}elseif($row_data["status"] == "open" && $timediff >= 24 && $timediff < 36){
			$tr_class = 'class="yellowComplaint"';
		}elseif($row_data["status"] == "open" && $timediff >= 36){
			$tr_class = 'class="redComplaint"';
		}
		

$content .='
	<tr valign="top" '.$tr_class.'>
		<td>'.$no.'.</td>
		<td>'.$row_data["first_name"].'</td>
		<td>'.$row_data["cust_number"].'</td>
		<td>'.$row_data["user_id"].'</td>
		<td>'.date("d-m-Y", strtotime($row_data["log_time"])).'</td>
		<td>'.$row_data["name"].'</td>
		<td><a href="detail.php?id_complaint='.$row_data["id_complaint"].'" class="lightbox">Details</a></td>
		<td>'.$row_data["status"].'</td>
		<td><a href="trouble_ticket.php?id_complaint='.$row_data["id_complaint"].'">Create TroubleTicket</a> | 
		<a href="form_complaint.php?id_complaint='.$row_data["id_complaint"].'">edit</a></td>
		<td><input type="checkbox" name="id_complaint[]" value="'.$row_data["id_complaint"].'"></td>
	</tr>';

	//Detail view
	//<a href="detail_complaint.php?id_complaint='.$row_data["id_complaint"].'" class="lightbox">View</a>
	$no++;
    }

$content .='</tbody>
<tfoot>
<tr><td colspan="10">'.(halaman($jum_complaint, $perhalaman, 1, "$hal")).'</td></tr>
</tfoot>
</table><br>
</div>
	<div class="actions">
              <div class="button-well">

		<input type="submit" style="font-size: 100%;" class="button button-primary" data-icon="v" name="complaint" value="Hapus">
              </div>
              
        </div>
</form>';
}elseif((isset($_GET['type']) == "")){
    $content .='
       
';
}else{
    $content .='';
}
 $content .='
            </div> 
       </div>

';

}else{
    $content ='
        <div class="box round first">
            <h2> Sorry, You don\'t have permission to access this Page</h2>
                <div class="block">
                   
                </div> 
       </div>';
}

//<script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
//
$plugins = '<script type="text/javascript" src="'.URL_OLD.'js/jquery.js"></script>
<link rel="stylesheet" href="'.URL_OLD.'css/excite-bike/jquery.ui.all.css">

    <script src="'.URL_OLD.'js/jquery.ui.core.js"></script>
    <script src="'.URL_OLD.'js/jquery.ui.widget.js"></script>
    <script src="'.URL_OLD.'js/jquery.ui.datepicker.js"></script>
<script language="JavaScript">
//datepicker baru jquery
var $jq = jQuery.noConflict();

$jq(document).ready(function() {
		$jq( "#date-picker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
		$jq( "#date-picker2" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
		
		
});
</script>

<style type="text/css">

select{
	width:80px;
}
#summary div,#summary div table, #summary h2{
    font-size:14px;
}
.button-well {
background-color: #97cefc;
display: inline-block;
line-height: 14px;
margin-right: 8px;
padding: 5px;
-webkit-background-clip: padding;
-moz-background-clip: padding;
background-clip: padding-box;
background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #94b7ed), color-stop(100%, #dfeffe));
background-image: -webkit-linear-gradient(top, #94b7ed, #dfeffe);
background-image: -moz-linear-gradient(top, #94b7ed, #dfeffe);
background-image: -o-linear-gradient(top, #94b7ed, #dfeffe);
background-image: linear-gradient(top, #94b7ed, #dfeffe);
-webkit-border-radius: 25px;
-moz-border-radius: 25px;
-ms-border-radius: 25px;
-o-border-radius: 25px;
border-radius: 25px;
-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.1);
-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.1);
box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.1);
}
.button.button-primary {
background-color: #81b0ef;
border: 1px solid #4571b5;
color: white;
background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #81b0ef), color-stop(100%, #345994));
background-image: -webkit-linear-gradient(top, #81b0ef, #345994);
background-image: -moz-linear-gradient(top, #81b0ef, #345994);
background-image: -o-linear-gradient(top, #81b0ef, #345994);
background-image: linear-gradient(top, #81b0ef, #345994);
-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 1px 2px rgba(0, 0, 0, 0.35);
-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 1px 2px rgba(0, 0, 0, 0.35);
box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 1px 2px rgba(0, 0, 0, 0.35);
text-shadow: 0 1px 0 #26497e;
}

.button {
background-color: #f3f3f3;
background-size: 1px 60px;
border: 1px solid silver;
color: #646464;
cursor: pointer;
display: inline-block;
font-weight: bold;
line-height: 14px;
padding: 8px 14px;
text-decoration: none;
-webkit-background-clip: padding;
-moz-background-clip: padding;
background-clip: padding-box;
background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #f5f5f5), color-stop(100%, #cccccc));
background-image: -webkit-linear-gradient(top, #f5f5f5, #cccccc);
background-image: -moz-linear-gradient(top, #f5f5f5, #cccccc);
background-image: -o-linear-gradient(top, #f5f5f5, #cccccc);
background-image: linear-gradient(top, #f5f5f5, #cccccc);
-webkit-border-radius: 25px;
-moz-border-radius: 25px;
-ms-border-radius: 25px;
-o-border-radius: 25px;
border-radius: 25px;
-webkit-box-shadow: inset 0 1px 0 white, 0 1px 2px rgba(0, 0, 0, 0.25);
-moz-box-shadow: inset 0 1px 0 white, 0 1px 2px rgba(0, 0, 0, 0.25);
box-shadow: inset 0 1px 0 white, 0 1px 2px rgba(0, 0, 0, 0.25);
font-size: 12px;
font-size: 1.2rem;
text-shadow: 0 1px 0 white;
-webkit-transition: color 0.2s ease-out, background 0.2s ease-out, box-shadow 0.05s ease-out;
-moz-transition: color 0.2s ease-out, background 0.2s ease-out, box-shadow 0.05s ease-out;
-o-transition: color 0.2s ease-out, background 0.2s ease-out, box-shadow 0.05s ease-out;
transition: color 0.2s ease-out, background 0.2s ease-out, box-shadow 0.05s ease-out;
}
</style>





<style type="text/css">
		    .detail{
			margin:0;
			padding: 0;
			height: 200px;
                        overflow-y:scroll;
		    }
		    h4{
			margin-top: 5px;
			padding-left: 10px;
			font-size:14px;		    
		    }
		   </style>
<style>
  body {
    min-width: 520px;
  }
  .column {
    width: 50%;
    float: left;
    padding-bottom: 10px;
  }
  .custom {
    width: 100%;
    padding-bottom: 10px;
    position: relative;
  }  
  .portlet {
    margin: 0 1em 1em 0;
    padding: 0.3em;
  }
  .portlet-header {
    padding: 0.2em 0.3em;
    margin-bottom: 0.5em;
    position: relative;
  }
  .portlet-toggle {
    position: absolute;
    top: 100%;
    right: 0;
    margin-top: -8px;
  }
  .portlet-content {
    padding: 0.4em;
  }
  .portlet-placeholder {
    border: 1px dotted black;
    margin: 0 1em 1em 0;
    height: 50px;
  }
  </style>
';

    $title	= 'Customer';
    $submenu	= "complaint";
    //$plugins	= '';
    
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= bootstrap_theme3($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

    } else{
	header("location: index.php");
    }

?>