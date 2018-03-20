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
if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}
    
    global $conn;
	
	//paging
    $perhalaman = 50;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }

	

if(isset($_POST["search"])){
    $date		= isset($_POST["date"]) ? trim(strip_tags($_POST["date"])) : "";
    $date_start 	= isset($_POST["date_start"]) ? trim(strip_tags($_POST["date_start"])) : "";
    $date_finish 	= isset($_POST["date_finish"]) ? trim(strip_tags($_POST["date_finish"])) : "";
    $uid		= isset($_POST["uid"]) ? trim(strip_tags($_POST["uid"])) : "";
	$media		= isset($_POST["media"]) ? trim(strip_tags($_POST["media"])) : "";
    $status		= isset($_POST["status"]) ? trim(strip_tags($_POST["status"])) : "";
	$which_side		= isset($_POST["which_side"]) ? trim(strip_tags($_POST["which_side"])) : "";
    
	//$sql_date		= ($date != "") ? "AND `date_add` LIKE '%$date%'" : "";
	 $sql_date		= ($date_start != "" && $date_finish != "") ? "AND (`date_add` between '".$date_start."' AND '".$date_finish."')" : "";
	 
    $sql_uid		= ($uid != "") ? "AND `user_id` LIKE '%$uid%'" : "";
    $sql_media		= ($media != "") ? "AND `media` LIKE '%$media%'" : "";
    $sql_status		= ($status != "") ? "AND `status` LIKE '%$status%'" : "";
    $sql_side		= ($which_side != "") ? "AND `which_side` LIKE '%$which_side%'" : "";
    
	$sql_complaint = mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0'
					$sql_date
					$sql_uid
					$sql_media
					$sql_status
					$sql_side
				       ORDER BY `gx_helpdesk_complaint`.`date_add`
				       DESC LIMIT $start, $perhalaman;", $conn);
	
	$sql_total_compliant = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0'
					$sql_date
					$sql_uid
					$sql_media
					$sql_status
					$sql_side
				       ORDER BY `gx_helpdesk_complaint`.`date_add`;", $conn));
    
    $hal= "?u=$uid&ds=$date_start&df=$date_finish&m=$media&s=$status&w=$which_side&";
    $no = $start + 1;
}else{
	$hal = "?";
	
	$no = $start + 1;
	$id_cso		= $loggedin["id_employee"];
	$sql_complaint = mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0'
					 AND `date_add` LIKE '%".date("Y-m-d")."%' AND `id_cso` = '".$id_cso."'
				       ORDER BY `gx_helpdesk_complaint`.`date_add`
				       DESC LIMIT $start, $perhalaman;", $conn);
	
	$sql_total_compliant = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0'
					 AND `date_add` LIKE '%".date("Y-m-d")."%' AND `id_cso` = '".$id_cso."'
				       ORDER BY `gx_helpdesk_complaint`.`date_add`;", $conn));
	
}
if(isset($_GET["u"]) || isset($_GET["ds"]) || isset($_GET["df"])){
    
    $date		= isset($_GET["d"]) ? trim(strip_tags($_GET["d"])) : "";
    $date_start		= isset($_GET["ds"]) ? trim(strip_tags($_GET["ds"])) : "";	
    $date_finish	= isset($_GET["df"]) ? trim(strip_tags($_GET["df"])) : "";
    $uid		= isset($_GET["u"]) ? trim(strip_tags($_GET["u"])) : "";
    $media		= isset($_GET["m"]) ? trim(strip_tags($_GET["m"])) : "";
    $status		= isset($_GET["s"]) ? trim(strip_tags($_GET["s"])) : "";
    $which_side		= isset($_GET["w"]) ? trim(strip_tags($_GET["w"])) : "";
    
	$sql_date		= ($date_start != "" && $date_finish) ? "AND (`date_add` BETWEEN '".$date_start."' AND '".$date_finish."')" : "";
    $sql_uid		= ($uid != "") ? "AND `user_id` LIKE '%$uid%'" : "";
    $sql_media		= ($media != "") ? "AND `media` LIKE '%$media%'" : "";
    $sql_status		= ($status != "") ? "AND `status` LIKE '%$status%'" : "";
    $sql_side		= ($which_side != "") ? "AND `which_side` LIKE '%$which_side%'" : "";
    
	$sql_complaint = mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0'
					$sql_date
					$sql_uid
					$sql_media
					$sql_status
					$sql_side
				       ORDER BY `gx_helpdesk_complaint`.`date_add`
				       DESC LIMIT $start, $perhalaman;", $conn);
	
	$sql_total_compliant = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0'
					$sql_date
					$sql_uid
					$sql_media
					$sql_status
					$sql_side
				       ORDER BY `gx_helpdesk_complaint`.`date_add`;", $conn));
    
    $hal= "?u=$uid&ds=$date_start&df=$date_finish&m=$media&s=$status&w=$which_side&";
    $no = $start + 1;
}
	
$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Helpdesk Complaint
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Search</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								
								<form action="" method="post" name="form_search">
								
			
									
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
											<label>Tanggal Awal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker" id="datepicker"  name="date_start" value="">
											</div>
											<div class="col-xs-2">
											<label>Tanggal Akhir</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker" id="datepicker2"  name="date_finish" value="">
											</div>
										</div>
										</div>
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
											<label>UserID</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" name="uid" id="uid" value="">
											</div>
											
										</div>
										</div>
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
											<label>Media </label>
											</div>
											<div class="col-xs-3">
												<select class="form-control" name="media">
													<option value="">ALL</option>
													<option value="telephone">Telephone</option>
													<option value="email">Email</option>
													<option value="website">Website</option>
													<option value="sms">SMS</option>
													<option value="walkin">Walk In</option>
												</select>
											</div>
											<div class="col-xs-2">
											<label>Status</label>
											</div>
											<div class="col-xs-3">
												<select class="form-control" name="status">
													<option value="">ALL</option>
													<option value="open">Open</option>
													<option value="closed">Closed</option>
													<option value="reopen">Reopen</option>
												</select>
											</div>
										</div>
										</div>
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
											<label>Which Side </label>
											</div>
											<div class="col-xs-3">
												<select class="form-control" name="which_side">
													<option value="">ALL</option>
													<option value="customer">Customer</option>
													<option value="iso">ISP</option>
													<option value="none">None</option>
												</select>
											</div>
											
										</div>
										</div>
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    <input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
	</form>
	<hr>
								<!--<div class="box-header">
                                    <h3 class="box-title">List Incoming Complaint</h3>
									<a href="form_complaint.php" class="btn bg-olive btn-flat margin pull-right">New Complaint</a>
                                </div>--><!-- /.box-header -->
								
								

    <table id="complaint" class="table table-bordered table-striped">
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
			
                  </tr>
                </thead>
                <tbody>';
				
	while($r_complaint = mysql_fetch_array($sql_complaint))
	{
	    $trouble_ticket ='';
	    if($r_complaint['trouble_ticket'] == 1){
		$trouble_ticket .= '<a href="detail_troubleticket.php?id_troubleticket='.$r_complaint["id_complaint"].'" onclick="return valideopenerform(\'detail_troubleticket.php?id_troubleticket='.$r_complaint["id_complaint"].'\',\'complaint\');">Detail TroubleTicket</a>';
	    
	    }else{
		$trouble_ticket .= '<a href="form_troubleticket.php?id_complaint='.$r_complaint["id_complaint"].'">Create TroubleTicket</a>';
	    }
		
		if($r_complaint["status"] == "open")
		{
			$status = '<span class="label label-danger">Open</span>';
		}elseif($r_complaint["status"] == "closed")
		{
			$status = '<span class="label label-success">Closed</span>';
		}elseif($r_complaint["status"] == "reopen")
		{
			$status = '<span class="label label-warning">Reopen</span>';
		}else
		{
			$status = '<span class="label label-info">No Status</span>';
		}
	    
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$r_complaint["created_by"].'</td>
		<td>'.$r_complaint["cust_number"].'</td>
		<td>'.$r_complaint["user_id"].'</td>
		<td>'.date("d-m-Y", strtotime($r_complaint["date_add"])).'</td>
		<td>'.$r_complaint["name"].'</td>
		<td><a href="detail_incoming.php?id_complaint='.$r_complaint["id_complaint"].'" onclick="return valideopenerform(\'detail_incoming.php?id_complaint='.$r_complaint["id_complaint"].'\',\'complaint\');">'.
		(($r_complaint["problem_select"]  != "" ) ? $r_complaint["problem_select"] : "Details").'</a></td>
		<td>'.$status.'</td>
		<td>'.$trouble_ticket.' | 
		<a href="form_complaint.php?id_complaint='.$r_complaint["id_complaint"].'">edit</a></td>
		
	    </tr>';
	    $no++;
		
		//<td><a href="detail_incoming.php?id_complaint='.$r_complaint["id_complaint"].'" onclick="return valideopenerform(\'detail_incoming.php?id_complaint='.$r_complaint["id_complaint"].'\',\'complaint\');">Details</a></td>
	}

$content .='</tbody>

</table><br>
</div><!-- /.box-body -->
								<div class="box-footer">
				   <div class="box-tools pull-right">
				   '.(halaman($sql_total_compliant, $perhalaman, 1, $hal)).'
				   </div>
				   <br style="clear:both;">
				</div>
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
            });
	    $(function() {
                $("#datepicker2").datepicker({format: "yyyy-mm-dd"});
            });
        </script>';

    $title	= 'Helpdesk Complaint';
    $submenu	= "helpdesk_complaint";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
     else{
	header("location: ".URL_CSO."logout.php");
    }

?>