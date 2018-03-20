<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

 include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inStaff()){ // Check if they are logged in
if($loggedin["group"] == 'staff'){
    
    global $conn_helpdesk;
    global $conn;
$ttl  = "";
$ttl .= (isset($_GET['type']) && $_GET['type'] == "complaint") ? "List Incoming Complaint" : "";
$ttl .= (isset($_GET['type']) && $_GET['type'] == "troubleticket") ? "List Troubleticket" : "";
$ttl .= (isset($_GET['type']) && $_GET['type'] == "spktech") ? "List SPK Teknisi" : "";
$ttl .= (isset($_GET['type']) && $_GET['type'] == "spkmkt") ? "List SPK Marketing" : "";
$ttl .= (isset($_GET['type']) && $_GET['type'] == "prospek") ? "List Prospek" : "";
$ttl .= (isset($_GET['type']) && $_GET['type'] == "nonprospek") ? "List Non Prospek" : "";
$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Helpdesk
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">'.$ttl.'</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				';

$type = isset($_GET['type']) ? $_GET['type'] : '';
// enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Helpdesk $type");
if($type == "troubleticket"){
$content .='';

$content .= '
 <table id="example1" class="table table-bordered table-striped">
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
	$no = 1;
	$sql_troubleticket = mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0' AND `gx_helpdesk_complaint`.`trouble_ticket` = '1'
				       ORDER BY `gx_helpdesk_complaint`.`date_add`
				       DESC LIMIT 100;", $conn);
	while($r_troubleticket = mysql_fetch_array($sql_troubleticket))
	{
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$r_troubleticket["created_by"].'</td>
		<td>'.$r_troubleticket["cust_number"].'</td>
		<td>'.$r_troubleticket["user_id"].'</td>
		<td>'.date("d-m-Y", strtotime($r_troubleticket["date_add"])).'</td>
		<td>'.$r_troubleticket["name"].'</td>
		<td><a href="detail_troubleticket.php?id_troubleticket='.$r_troubleticket["id_complaint"].'" onclick="return valideopenerform(\'detail_troubleticket.php?id_troubleticket='.$r_troubleticket["id_complaint"].'\',\'toubleticket\');">Details</a></td>
		<td>'.$r_troubleticket["status"].'</td>
		<td><a href="form_troubleticket.php?id_troubleticket='.$r_troubleticket["id_complaint"].'">edit</a></td>
		<td><input type="checkbox" name="id_troubleticket[]" value="'.$r_troubleticket["id_complaint"].'"></td>
	    </tr>';
	    
	    $no++;
	}

$content .='</tbody>

</table>
</div>';

$submenu	= "helpdesk_troubleticket";

}elseif($type == "nonprospek"){
$content .='';

$content .= '
 <table id="example1" class="table table-bordered table-striped">
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


    $sql_nonprospek	= mysql_query("SELECT *  FROM  `gx_helpdesk_complaint`
			    WHERE `gx_helpdesk_complaint`.`level` =  '0'
			    AND  `gx_helpdesk_complaint`.`type_client` =  'nonclient'
			    AND  `gx_helpdesk_complaint`.`status_prospek` =  'nonprospek'
			    ORDER BY  `gx_helpdesk_complaint`.`log_time` DESC;", $conn);
    $no = 1;

    while($r_nonprospek = mysql_fetch_array($sql_nonprospek))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$r_nonprospek["name"].'</td>
			<td>'.$r_nonprospek["address"].'</td>
			<td>'.$r_nonprospek["phone"].'</td>
			<td>'.$r_nonprospek["email"].'</td>
			<td>'.$r_nonprospek["media"].'</td>
			<td>'.$r_nonprospek["note_nclient"].'</td>
			<td>'.$r_nonprospek["status_prospek"].'</td>
			<td><a href="detail.php?id_prospek='.$r_nonprospek["id_complaint"].'"> View </a></td>
			<td><input type="checkbox" name="id_nprospek[]" value="'.$r_nonprospek["id_complaint"].'"><a href="form_complaint.php?id_complaint='.$r_nonprospek["id_complaint"].'">edit</a></td>
		</tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>';

$submenu	= "helpdesk_nonprospek";

}elseif($type == "prospek")
{
    $content .= '
    <table id="example1" class="table table-bordered table-striped">
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


    $no= 1;
    $sql_prospek = mysql_query("SELECT *  FROM  `gx_helpdesk_complaint` 
				WHERE `gx_helpdesk_complaint`.`level` =  '0'
				AND  `gx_helpdesk_complaint`.`type_client` =  'nonclient'
				AND  `gx_helpdesk_complaint`.`status_prospek` =  'prospek'
				ORDER BY  `gx_helpdesk_complaint`.`log_time` DESC;", $conn);

    while($r_prospek = mysql_fetch_array($sql_prospek))
    {
	$content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$r_prospek["name"].'</td>
		<td>'.$r_prospek["address"].'</td>
		<td>'.$r_prospek["phone"].'</td>
		<td>'.$r_prospek["email"].'</td>
		<td>'.$r_prospek["media"].'</td>
		<td>'.$r_prospek["note_nclient"].'</td>
		<td>'.$r_prospek["status_prospek"].'</td>
		<td><a href="detail.php?id_prospek='.$r_prospek["id_complaint"].'"> View </a></td>
		<td><input type="checkbox" name="id_prospek[]" value="'.$r_prospek["id_complaint"].'"><a href="form_complaint.php?id_complaint='.$r_prospek["id_complaint"].'">edit</a></td>
	    </tr>';

	$no++;
    }

$content .='</tbody>
</table><br>
</div>           
    <!--<input type="submit" style="font-size: 100%;margin-left: 10px;" class="button button-primary" data-icon="v" name="prospek" value="Hapus">-->';
$submenu	= "helpdesk_prospek";
}elseif($type == "spktech")
{
    $content .= '
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th width="10%">No SPK</th>
			<th width="10%">Teknisi</th>
			<th width="8%">Cust ID</th>
			<th width="18%">Complaint</th>
			<th width="10%">Date</th>
			<th width="15%">Status</th>
			<th width="10%">Action</th>
			
                  </tr>
                </thead>
                <tbody>';
    $sql_spktech = mysql_query("SELECT  `gx_helpdesk_spk`. * ,  `tbPegawai`.`cNama`, `gx_helpdesk_jawabspk`.`status_cso`, `gx_helpdesk_jawabspk`.`status_teknisi`
                                FROM  `gx_helpdesk_spk` ,  `gx_helpdesk_jawabspk` ,  `tbPegawai` 
                                WHERE  `gx_helpdesk_spk`.`spk_number` =  `gx_helpdesk_jawabspk`.`spk_number` 
                                AND  `gx_helpdesk_spk`.`id_teknisi` =  `tbPegawai`.`id_employee`
				AND `gx_helpdesk_spk`.`id_teknisi` = '".$loggedin["id_employee"]."'
                                AND `gx_helpdesk_spk`.`level` = '0' ORDER BY `gx_helpdesk_spk`.`date_add` DESC;", $conn);
    $no= 1;
    while($r_spktech = mysql_fetch_array($sql_spktech))
    {
	$content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$r_spktech["spk_number"].'</td>
		<td>'.$r_spktech["cNama"].'</td>
		<td>'.$r_spktech["cust_number"].'</td>
		<td>'.$r_spktech["problem"].'</td>
		<td>'.date("d-m-Y", strtotime($r_spktech["date_add"])).'</td>
		
		<td>
		
		';
		$ci  = "";
		
		$ci .= ($r_spktech["check_in"] == "0000-00-00 00:00:00") ? '<a href="ci_co.php?id='.$r_spktech["id_spk"].'&t=ci">Check In</a>' : "";
		$ci .= ($r_spktech["check_in"] != "0000-00-00 00:00:00") ? "Check In : ".$r_spktech["check_in"] : "";
		
		$co  = "";
		$co .= ($r_spktech["check_out"] == "0000-00-00 00:00:00") ? '<a href="ci_co.php?id='.$r_spktech["id_spk"].'&t=co">Check Out</a>' : "";
		$co .= ($r_spktech["check_out"] != "0000-00-00 00:00:00") ? "Check Out : ".$r_spktech["check_out"] : "";
		
		$cout = ($r_spktech["check_in"] != "0000-00-00 00:00:00") ? $co."<br />" : "";
		
		$content .=''.$ci.'<br />'.$cout.''.$r_spktech["status_teknisi"].'</td>
		<td align="center"><a href="detail_spk.php?id_spk='.$r_spktech["id_spk"].'" onclick="return valideopenerform(\'detail_spk.php?id_spk='.$r_spktech["id_spk"].'\',\'spk\');">View</a> || <a href="jawab_spk.php?id_spk='.$r_spktech["id_spk"].'">Jawab SPK</a></td>
		
	</tr>';
	
	$no++;
    }

$content .='</tbody>

</table><br>
</div>
	<!--<input type="submit" style="font-size: 100%;margin-left: 10px;" class="button button-primary" data-icon="v" name="spk" value="Hapus">-->';

$submenu	= "helpdesk_spktech";
}elseif($type == "spkmkt")
{
    $content .= '
<table id="example1" class="table table-bordered table-striped">
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


    $sql_spkmkt = mysql_query("SELECT  `gx_helpdesk_spk` . * ,  `tbPegawai`.`cNama`, `gx_helpdesk_complaint`.`name` ,  `gx_helpdesk_complaint`.`note_nclient` ,  `gx_helpdesk_complaint`.`address` ,  `gx_helpdesk_complaint`.`email` ,  `gx_helpdesk_complaint`.`phone` 
			    FROM  `gx_helpdesk_spk` ,  `gx_helpdesk_complaint` ,  `tbPegawai` 
			    WHERE  `spk_number` LIKE  '%MST%'
			    AND  `gx_helpdesk_spk`.`id_complaint` =  `gx_helpdesk_complaint`.`id_complaint` 
			    AND  `gx_helpdesk_spk`.`level` =  '0'
			    AND  `gx_helpdesk_spk`.`id_marketing` =  `tbPegawai`.`id_employee`
			    ORDER BY `gx_helpdesk_spk`.`date_add` DESC;", $conn);
    $no= 1;
    while($r_spkmkt = mysql_fetch_array($sql_spkmkt))
    {
	$content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$r_spkmkt["spk_number"].'</td>
		<td>'.$r_spkmkt["first_name"].' '.$r_spkmkt["last_name"].'</td>
		<td>'.$r_spkmkt["name"].'</td>
		<td>'.$r_spkmkt["address"].'</td>
		<td>'.$r_spkmkt["note_nclient"].'</td>
		
		<td>'.date("d-m-Y", strtotime($r_spkmkt["date_add"])).'</td>
		<td><a href="detail.php?id_spk_survey='.$r_spkmkt["id_spk"].'">View</a></td>
		<td><input type="checkbox" name="id_spk[]" value="'.$r_spkmkt["id_spk"].'"><a href="form_spk_mar.php?id_spk='.$r_spkmkt["id_spk"].'">edit</a></td>
	</tr>';

	$no++;
    }

$content .='</tbody>
</table><br>
</div>
	<!--<input type="submit" style="font-size: 100%;margin-left: 10px;" class="button button-primary" data-icon="v" name="spk" value="Hapus">-->';

$submenu	= "helpdesk_spkmkt";
}elseif($type == "complaint")
{
    $sql_cso = mysql_query("SELECT `u`.`username`, `ud`.`first_name`, `ud`.`last_name`, `ud`.`id_employee` FROM `gx_employee` ud, `users` u WHERE `ud`.`id_employee` = `u`.`id_user` AND `ud`.`level` = '0' AND `u`.`group` = 'cso';", $conn_helpdesk);
    
    $content .= '
    <table id="example1" class="table table-bordered table-striped">
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


	
	$no = 1;
	$id_cso		= $loggedin["id_employee"];
	$sql_complaint = mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0' 
				       ORDER BY `gx_helpdesk_complaint`.`date_add`
				       DESC LIMIT 100;", $conn);
	while($r_complaint = mysql_fetch_array($sql_complaint))
	{
	    $trouble_ticket ='';
	    if($r_complaint['trouble_ticket'] == 1){
		$trouble_ticket .= '<a href="detail_troubleticket.php?id_troubleticket='.$r_complaint["id_complaint"].'" onclick="return valideopenerform(\'detail_troubleticket.php?id_troubleticket='.$r_complaint["id_complaint"].'\',\'complaint\');">Detail TroubleTicket</a>';
	    
	    }else{
		$trouble_ticket .= '<a href="form_troubleticket.php?id_complaint='.$r_complaint["id_complaint"].'">Create TroubleTicket</a>';
	    }
	    
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$r_complaint["created_by"].'</td>
		<td>'.$r_complaint["cust_number"].'</td>
		<td>'.$r_complaint["user_id"].'</td>
		<td>'.date("d-m-Y", strtotime($r_complaint["date_add"])).'</td>
		<td>'.$r_complaint["name"].'</td>
		<td><a href="detail_incoming.php?id_complaint='.$r_complaint["id_complaint"].'" onclick="return valideopenerform(\'detail_incoming.php?id_complaint='.$r_complaint["id_complaint"].'\',\'complaint\');">Details</a></td>
		<td>'.$r_complaint["status"].'</td>
		<td>'.$trouble_ticket.' | 
		<a href="form_complaint.php?id_complaint='.$r_complaint["id_complaint"].'">edit</a></td>
		<td><input type="checkbox" name="id_complaint[]" value="'.$r_complaint["id_complaint"].'"></td>
	    </tr>';
	    $no++;
	}

$content .='</tbody>

</table><br>
</div>
    
	<!--<input type="submit" style="font-size: 100%;margin-left: 10px;" class="button button-primary" data-icon="v" name="complaint" value="Hapus">-->';

$submenu	= "helpdesk_complaint";	
}elseif($type == "")
{
    header("location:incoming.php?type=complaint");

}else{
    $content .='';
    $submenu	= "helpdesk_dashboard";
}
 
 $content .='<br />
            </div> 
       </div>';

}else{
    $content ='
        <div class="box round first">
            <h2> Sorry, You don\'t have permission to access this Page</h2>
                <div class="block">
                   
                </div> 
       </div>';
    $submenu	= "helpdesk_dashboard";
}

//<script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
//



$plugins = '

        <!-- DATA TABLES -->
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
            });
        </script>';

    $title	= 'Helpdesk';
    
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
     else{
	header("location: ".URL_STAFF."logout.php");
    }

?>