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

if(isset($_POST["search"]))
{

    $date = isset($_POST["date"]) ? strip_tags(trim($_POST["date"])) : "";
    
    $teknisi = isset($_POST["teknisi"]) ? strip_tags(trim($_POST["teknisi"])) : "";
    $status = isset($_POST["status"]) ? strip_tags(trim($_POST["status"])) : "";
    $id_area = isset($_POST["id_area"]) ? strip_tags(trim($_POST["id_area"])) : "";
    
	$message_date	= ($date == "") ? " Pada Hari ini" : " Pada tanggal $date";
	
	$sql_teknisi = ($teknisi == "") ? "" : "AND `teknisi` = '$teknisi'";
	$message_teknisi = ($teknisi == "") ? "" : " Dengan teknisi $teknisi";
    
	$sql_status = ($status == "") ? "" : "AND `status` = '$status'";
	$message_status = ($status == "") ? "" : " Dengan Status $status";
    
    $sql_area = ($id_area == "") ? "" : " AND `id_area` = '$id_area'";
	$message_area = ($id_area == "") ? "" : " Pada Area $id_area";
    
    $queryList = "SELECT * FROM `gx_pasang_fo` WHERE `tanggal` LIKE '%$date%' $sql_status $sql_teknisi $sql_area ORDER BY `tanggal` DESC";
    $result = mysql_query($queryList) or die ("Error on Query List.data: ".mysql_error());
    $total = mysql_num_rows($result);
    $message_title = "Semua data $message_date $message_teknisi $message_status $message_area.";

}
elseif(isset($_POST["stats"]))
{

    $pekerjaan = isset($_POST["pekerjaan"]) ? strip_tags(trim($_POST["pekerjaan"])) : "";
    $month = isset($_POST["month"]) ? strip_tags(trim($_POST["month"])) : "";
    $year = isset($_POST["year"]) ? strip_tags(trim($_POST["year"])) : "";
 

    $date = $year.'-'.$month;
   
    if($pekerjaan == ""){
	$sql_pekerjaan = "";
	$message_pekerjaan = '';
    }else{
	$sql_pekerjaan = " AND `pekerjaan` LIKE '%$pekerjaan%'";
	$message_pekerjaan = 'Dengan '.$pekerjaan;
    }
	//All data
	$queryList = "SELECT * FROM `gx_pasang_fo` WHERE `tanggal` LIKE '%$date%' $sql_pekerjaan ORDER BY `tanggal` DESC";
	$result = mysql_query($queryList) or die ("Error on Query List.data: ".mysql_error());
	$total = mysql_num_rows($result);
	$message_title = "Semua data $message_pekerjaan.";
    
}
else
{

    $date = date("Y-m-d");
    $queryList = "SELECT * FROM `gx_pasang_fo` WHERE `tanggal` LIKE '%$date%' ORDER BY `tanggal` DESC";
    $result = mysql_query($queryList) or die ("Error on Query List.data: ".mysql_error());
    $total = mysql_num_rows($result);
    $message_title = "Semua Data pada hari ini.";

}


$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Jadwal Pasang FO
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
											<label>Nama Teknisi</label>
											</div>
											<div class="col-xs-3">
												<select name="teknisi" class="form-control">
													<option value="">All Teknisi</option>
												</select>
											</div>
											
										</div>
										</div>
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
											<label>Status </label>
											</div>
											<div class="col-xs-3">
												<select name="status"  class="form-control">
													<option value="">All Status</option>
													<option value="Open">Open</option>
													<option value="Closed">Closed</option>
													<option value="Check-in">Check-in</option>
													<option value="Check-out">Check-out</option>
													<option value="Delay">Delay</option>
													<option value="Cleared">Cleared </option>
													<option value="Uncleared">Uncleared</option>
													<option value="OTW">OTW</option>
													<option value="Pending">Pending</option>
													<option value="N/A">N/A</option>
													<option value="Cancelled">Cancelled</option>
												</select>
											</div>
											<div class="col-xs-2">
											<label>Area</label>
											</div>
											<div class="col-xs-3">
												<select name="id_area" class="form-control">
													<option value="">All Area</option>
													<option value="1">Area 1</option>
													<option value="2">Area 2</option>
													<option value="3">Area 3</option>
													<option value="4">Area 4</option>
													<option value="5">Area 5</option>
													<option value="6">Area 6</option>
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
                                    <h3 class="box-title">List Pasang FO</h3>
									<a href="form_pasangfo.php" class="btn bg-olive btn-flat margin pull-right">Tambah Baru</a>
                                </div><!-- /.box-header -->
								
								

<table id="maintenance" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="50">No</th>
			
			<th>Tanggal</th>
			<th>User ID</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Status</th>
			<th>Teknisi</th>
			<th>Pekerjaan</th>
			<th>Created by</th>
			<th>Action</th>
            </tr>
        </thead>
        <tbody>';

        
$no = 1;
	while ($data = mysql_fetch_array($result)) {
		
		$query_teknisi	= mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee` = '".$data["teknisi"]."' AND `level` = '0' LIMIT 0,1;", $conn);
		$row_teknisi	= mysql_fetch_array($query_teknisi);
		
		$content .="<tr>
		<td align='center'>".$no."</td>
                
                <td>".$data["tanggal"]."</td>
                <td>".$data["user_id"]."</td>
				<td>".$data["nama"]."</td>
                <td>".$data["alamat"]."</td>
		<!--<td align='center'>".(($data["id_area"] <> 0) ? "Area ".$data["id_area"] : "")."</td>-->
                <td>".$data["status"]."</td>
                <td>".$row_teknisi["nama"]."</td>
                <td>".$data["pekerjaan"]."</td>
				<td>".$data["user_add"]."</td>
		
	<td align='center'>
	<a href='detail_maintenance.php?id=".$data["id_pasang_fo"]."'
	onclick=\"return valideopenerform('detail_maintenance.php?id=".$data["id_pasang_fo"]."','pasangfo');\">view</a> |
	<a href='form_pasangfo.php?id=".$data["id_pasang_fo"]."' >Edit</a>
</td>
</tr>";
		$no++;

	}



$content .='

        </tbody>

</table><br>

';





//				   '.(halaman($sql_total_compliant, $perhalaman, 1, $hal)).'

$content .='<br>
</div><!-- /.box-body -->
								<div class="box-footer">
				   <div class="box-tools pull-right">
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

    $title	= 'Jadwal Maintenance';
    $submenu	= "maintenance";	
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