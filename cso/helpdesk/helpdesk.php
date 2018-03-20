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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
    
    global $conn_helpdesk;
    
        
$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Helpdesk
                        <small>advanced tables</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">Helpdesk</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				    <a href="helpdesk.php?type=complaint" class="btn bg-maroon btn-flat margin">Complaint</a>
				    <a href="helpdesk.php?type=spktech" class="btn bg-purple btn-flat margin">SPK Technician</a>
				    <a href="helpdesk.php?type=spkmkt" class="btn bg-navy btn-flat margin">SPK Marketing</a>
				    <a href="helpdesk.php?type=prospek" class="btn bg-orange btn-flat margin">Prospek</a>
				    <a href="helpdesk.php?type=nonprospek" class="btn bg-olive btn-flat margin">Non Prospek</a>
			        </div>
			    </div>
			</div>
		    </div>

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Helpdesk</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">';

$type = isset($_GET['type']) ? $_GET['type'] : '';
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Helpdesk $type");
if($type == "nonprospek"){
$content .='';

$content .= '
<hr>
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


    $sql_nonprospek	= mysql_query("SELECT *  FROM  `gx_complaint`
			    WHERE `gx_complaint`.`level` =  '0'
			    AND  `gx_complaint`.`type_client` =  'nonclient'
			    AND  `gx_complaint`.`status_prospek` =  'nonprospek'
			    ORDER BY  `gx_complaint`.`log_time` DESC;", $conn_helpdesk);
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
    $content .= '<hr>
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
    $sql_prospek = mysql_query("SELECT *  FROM  `gx_complaint` 
				WHERE `gx_complaint`.`level` =  '0'
				AND  `gx_complaint`.`type_client` =  'nonclient'
				AND  `gx_complaint`.`status_prospek` =  'prospek'
				ORDER BY  `gx_complaint`.`log_time` DESC;", $conn_helpdesk);

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
    <input type="submit" style="font-size: 100%;" class="button button-primary" data-icon="v" name="prospek" value="Hapus">';
$submenu	= "helpdesk_prospek";
}elseif($type == "spktech")
{
    $content .= '<hr>
              <table id="example1" class="table table-bordered table-striped">
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
    $sql_spktech = mysql_query("SELECT  `gx_spk`. * ,  `gx_employee`.`first_name` , `users`.`username`,  `gx_employee`.`last_name` ,  `gx_complaint`.`name` , `gx_complaint`.`status` ,  `gx_complaint`.`note_nclient` ,  `gx_complaint`.`address` ,  `gx_complaint`.`email` ,  `gx_complaint`.`phone` 
                                FROM  `gx_spk` ,  `gx_complaint` ,  `gx_employee` , `users`
                                WHERE  `spk_number` LIKE  '%MCT%'
                                AND  `gx_spk`.`id_complaint` =  `gx_complaint`.`id_complaint` 
                                AND  `gx_spk`.`id_teknisi` =  `gx_employee`.`id_employee`
                                AND  `gx_spk`.`id_teknisi` =  `users`.`id_user`
                                AND `gx_spk`.`level` = '0' ORDER BY `gx_spk`.`date_add` DESC;", $conn_helpdesk);
    $no= 1;
    while($r_spktech = mysql_fetch_array($sql_spktech))
    {
	$content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$r_spktech["spk_number"].'</td>
		<td>'.$r_spktech["first_name"].' '.$r_spktech["last_name"].'</td>
		<td>'.$r_spktech["name"].'</td>
		<td>'.$r_spktech["problem"].'</td>
		<td>'.date("d-m-Y", strtotime($r_spktech["date_add"])).'</td>
		
		<td>'.(($r_spktech["status"] == "cleared") ? $r_spktech["status"] : '<a href="jawab_spk.php?id_spk='.$r_spktech["id_spk"].'">'.$r_spktech["status"].'</a>' ).'</td>
		<td><a href="detail.php?id_spk='.$r_spktech["id_spk"].'">View</a></td>
		<td><input type="checkbox" name="id_spk[]" value="'.$r_spktech["id_spk"].'"><a href="form_spk.php?id_spk='.$r_spktech["id_spk"].'">edit</a></td>
	</tr>';
	
	$no++;
    }

$content .='</tbody>

</table><br>
</div>
	<input type="submit" style="font-size: 100%;" class="button button-primary" data-icon="v" name="spk" value="Hapus">';

$submenu	= "helpdesk_spktech";
}elseif($type == "spkmkt")
{
    $content .= '<hr>
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


    $sql_spkmkt = mysql_query("SELECT  `gx_spk` . * ,  `gx_employee`.`first_name` , `users`.`username`,  `gx_employee`.`last_name` ,  `gx_complaint`.`name` ,  `gx_complaint`.`note_nclient` ,  `gx_complaint`.`address` ,  `gx_complaint`.`email` ,  `gx_complaint`.`phone` 
			    FROM  `gx_spk` ,  `gx_complaint` ,  `gx_employee` , `users`
			    WHERE  `spk_number` LIKE  '%MST%'
			    AND  `gx_spk`.`id_complaint` =  `gx_complaint`.`id_complaint` 
			    AND  `gx_spk`.`level` =  '0'
			    AND  `gx_spk`.`id_marketing` =  `gx_employee`.`id_employee`
			    AND  `gx_spk`.`id_marketing` =  `users`.`id_user`
			    ORDER BY `gx_spk`.`date_add` DESC;", $conn_helpdesk);
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
	<input type="submit" style="font-size: 100%;" class="button button-primary" data-icon="v" name="spk" value="Hapus">';

$submenu	= "helpdesk_spkmkt";
}elseif($type == "complaint")
{
    $sql_cso = mysql_query("SELECT `u`.`username`, `ud`.`first_name`, `ud`.`last_name`, `ud`.`id_employee` FROM `gx_employee` ud, `users` u WHERE `ud`.`id_employee` = `u`.`id_user` AND `ud`.`level` = '0' AND `u`.`group` = 'cso';", $conn_helpdesk);
    
    $content .= '<hr>
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
	$sql_complaint = mysql_query("SELECT * FROM `gx_complaint`
				     WHERE `gx_complaint`.`level` = '0' 
				       ORDER BY `gx_complaint`.`log_time`
				       DESC LIMIT 100;", $conn_helpdesk);
	while($r_complaint = mysql_fetch_array($sql_complaint))
	{
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td></td>
		<td>'.$r_complaint["cust_number"].'</td>
		<td>'.$r_complaint["user_id"].'</td>
		<td>'.date("d-m-Y", strtotime($r_complaint["log_time"])).'</td>
		<td>'.$r_complaint["name"].'</td>
		<td><a href="detail.php?id_complaint='.$r_complaint["id_complaint"].'" class="lightbox">Details</a></td>
		<td>'.$r_complaint["status"].'</td>
		<td><a href="trouble_ticket.php?id_complaint='.$r_complaint["id_complaint"].'">Create TroubleTicket</a> | 
		<a href="form_complaint.php?id_complaint='.$r_complaint["id_complaint"].'">edit</a></td>
		<td><input type="checkbox" name="id_complaint[]" value="'.$r_complaint["id_complaint"].'"></td>
	    </tr>';
	    
	    $no++;
	}

$content .='</tbody>

</table><br>
</div>
	<input type="submit" style="font-size: 100%;" class="button button-primary" data-icon="v" name="complaint" value="Hapus">';

$submenu	= "helpdesk_complaint";	
}elseif($type == "")
{
    header("location:helpdesk.php?type=complaint");

}else{
    $content .='';
    $submenu	= "helpdesk_dashboard";
}
 
 $content .='
            </div> 
       </div>';

/*}else{
    $content ='
        <div class="box round first">
            <h2> Sorry, You don\'t have permission to access this Page</h2>
                <div class="block">
                   
                </div> 
       </div>';
    $submenu	= "helpdesk_dashboard";
}*/

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
            });
        </script>';

    $title	= 'Helpdesk';
    
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
}
     else{
	header("location: ".URL_CSO."logout.php");
    }

?>