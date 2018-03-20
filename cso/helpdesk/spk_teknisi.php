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
    $uid		= isset($_POST["uid"]) ? trim(strip_tags($_POST["uid"])) : "";
	$media		= isset($_POST["media"]) ? trim(strip_tags($_POST["media"])) : "";
    $status		= isset($_POST["status"]) ? trim(strip_tags($_POST["status"])) : "";
	$which_side		= isset($_POST["which_side"]) ? trim(strip_tags($_POST["which_side"])) : "";
    
	$sql_date		= ($date != "") ? "AND `date_add` LIKE '%$date%'" : "";
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
    
    $hal= "?u=$uid&d=$date&m=$media&s=$status&w=$which_side&";
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
if(isset($_GET["u"]) || isset($_GET["d"])){
    $date		= isset($_GET["d"]) ? trim(strip_tags($_GET["d"])) : "";
    $uid		= isset($_GET["u"]) ? trim(strip_tags($_GET["u"])) : "";
    $media		= isset($_GET["m"]) ? trim(strip_tags($_GET["m"])) : "";
    $status		= isset($_GET["s"]) ? trim(strip_tags($_GET["s"])) : "";
    $which_side	= isset($_GET["w"]) ? trim(strip_tags($_GET["w"])) : "";
    
	$sql_date		= ($date != "") ? "AND `date_add` LIKE '%$date%'" : "";
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
    
    $hal= "?u=$uid&d=$date&m=$media&s=$status&w=$which_side&";
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
											<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" name="date" id="date" value="'.date("Y-m-d").'">
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
								<div class="box-header">
                                    <h3 class="box-title">List Incoming Complaint</h3>
									<a href="form_complaint.php" class="btn bg-olive btn-flat margin pull-right">New Complaint</a>
                                </div><!-- /.box-header -->
								
								

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
			<th width="2%">#</th>
                  </tr>
                </thead>
                <tbody>';
    $sql_spktech = mysql_query("SELECT  `gx_helpdesk_spk`. * ,  `gx_pegawai`.`nama`
                                FROM  `gx_helpdesk_spk` ,  `gx_pegawai` 
                                WHERE  `gx_helpdesk_spk`.`id_teknisi` =  `gx_pegawai`.`id_employee`
								AND `gx_helpdesk_spk`.`date_add` LIKE '%".date("Y-m-d")."%'
                                AND `gx_helpdesk_spk`.`level` = '0' ORDER BY `gx_helpdesk_spk`.`date_add` DESC;", $conn);
    $no= 1;
    while($r_spktech = mysql_fetch_array($sql_spktech))
    {
		 $sql_jawabspk = mysql_query("SELECT `gx_helpdesk_jawabspk`.`status_cso`, `gx_helpdesk_jawabspk`.`status_teknisi`
                                FROM  `gx_helpdesk_jawabspk`
                                WHERE `gx_helpdesk_jawabspk`.`spk_number` = '".$r_spktech["spk_number"]."'
                                AND `level` = '0' ORDER BY `gx_helpdesk_jawabspk`.`date_add` DESC;", $conn);
		$r_jawabspk = mysql_fetch_array($sql_jawabspk);
	$content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$r_spktech["spk_number"].'</td>
		<td>'.$r_spktech["nama"].'</td>
		<td>'.$r_spktech["cust_number"].'</td>
		<td>'.$r_spktech["problem"].'</td>
		<td>'.date("d-m-Y", strtotime($r_spktech["date_add"])).'</td>
		
		<td>Teknisi: '.$r_jawabspk["status_teknisi"].'<br>
		CSO: '.$r_jawabspk["status_cso"].'</td>
		<td align="center"><a href="detail_spk.php?id_spk='.$r_spktech["id_spk"].'" onclick="return valideopenerform(\'detail_spk.php?id_spk='.$r_spktech["id_spk"].'\',\'spk\');">View</a> || <a href="jawab_spk.php?id_spk='.$r_spktech["id_spk"].'">Jawab SPK</a></td>
		<td><input type="checkbox" name="id_spk[]" value="'.$r_spktech["id_spk"].'"><a href="form_spk.php?id_spk='.$r_spktech["id_spk"].'">edit</a> </td>
	</tr>';
	
	$no++;
    }

$content .='</tbody>

</table><br>
</div>

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
        </script>';

    $title	= 'Helpdesk Complaint';
    $submenu	= "helpdesk_complaint";	
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