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

    $date 			= isset($_POST["date"]) ? strip_tags(trim($_POST["date"])) : date("Y-m-d");
    $jenis_kerjaan 	= isset($_POST["jenis_kerjaan"]) ? strip_tags(trim($_POST["jenis_kerjaan"])) : "";
    $teknisi 		= isset($_POST["teknisi"]) ? strip_tags(trim($_POST["teknisi"])) : "";
	$cso 			= isset($_POST["cso"]) ? strip_tags(trim($_POST["cso"])) : "";
    $status 		= isset($_POST["status"]) ? strip_tags(trim($_POST["status"])) : "";
    $id_area 		= isset($_POST["id_area"]) ? strip_tags(trim($_POST["id_area"])) : "";
    $sql_jk 		= ($jenis_kerjaan != "") ? "AND `jenis_kerjaan` = '$jenis_kerjaan'" : "";
    $message_jk 	= ($jenis_kerjaan != "") ? " Dengan jenis_kerjaan $jenis_kerjaan" : "";


	$message_date	= ($date == "") ? " Pada Hari ini" : " Pada tanggal $date";
	
	$sql_teknisi = ($teknisi == "") ? "" : "AND `id_teknisi` = '$teknisi'";
	$message_teknisi = ($teknisi == "") ? "" : " Dengan teknisi $teknisi";
    
	$sql_cso = ($cso == "") ? "" : "AND `id_cso` = '$cso'";
	$message_cso = ($cso == "") ? "" : " Dengan CSO $cso";
    
	$sql_status = ($status == "") ? "" : "AND `status` = '$status'";
	$message_status = ($status == "") ? "" : " Dengan Status $status";
    
    $sql_area = ($id_area == "") ? "" : " AND `id_area` = '$id_area'";
	$message_area = ($id_area == "") ? "" : " Pada Area $id_area";
    

    $queryList = "SELECT * FROM `gx_maintenance` WHERE `tanggal` LIKE '%$date%' $sql_status $sql_teknisi $sql_jk $sql_cso
    AND `level` = '0' ORDER BY `id_monitoring` ASC";
    $result = mysql_query($queryList) or die ("Error on Query List.data: ".mysql_error());
    $total = mysql_num_rows($result);
    $message_title = "Semua data $message_date $message_teknisi $message_status $message_area $message_jk $message_cso.";

}elseif(isset($_POST["stats"])){

    $userid = isset($_POST["userid"]) ? strip_tags(trim($_POST["userid"])) : "";
    $month = isset($_POST["month"]) ? strip_tags(trim($_POST["month"])) : "";
    $year = isset($_POST["year"]) ? strip_tags(trim($_POST["year"])) : "";

    $message_year = ($month == "") ? " pada tahun $year" : "";
    $message_month = ($month == "") ? "" : " pada bulan $month - $year";	
    
    $queryList = "SELECT * FROM `gx_maintenance` WHERE `user_id` LIKE '%$userid%' AND `tanggal` LIKE '%$year-$month%' AND `level` = '0' ORDER BY `id_monitoring` ASC";
    //echo $queryList;
    $result = mysql_query($queryList) or die ("Error on Query List.data: ".mysql_error());
    $total = mysql_num_rows($result);
    $message_title = "Semua data userid = $userid $message_month$message_year.";
    
}else{
    $date = date("Y-m-d");
    $queryList = "SELECT * FROM `gx_maintenance` WHERE `tanggal` LIKE '%$date%' AND `level` = '0' ORDER BY `id_monitoring` ASC";
    $result = mysql_query($queryList) or die ("Error on Query List.data: ".mysql_error());
    $total = mysql_num_rows($result);
    $message_title = "Semua Data pada hari ini.";
}

$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Jadwal Maintenance
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
													<option value="">All Teknisi</option>';
													$data_sql_teknisi = "SELECT * FROM `gx_pegawai` WHERE `level`='0' AND `id_bagian` = 'Teknisi' AND `id_cabang` = '".$loggedin["cabang"]."'";
													$data_query_teknisi = mysql_query($data_sql_teknisi, $conn);
													while($data_tek = mysql_fetch_array($data_query_teknisi)){
													$content .= '<option value="'.$data_tek['id_employee'].'">'.$data_tek['nama'].'</option>';
						}
					$content .= '
												</select>
											</div>
											
											<div class="col-xs-2">
												<label>Nama CSO</label>
											</div>
											<div class="col-xs-3">
												<select name="cso" class="form-control">
													<option value="">All CSO</option>';
													$data_sql_cso = "SELECT * FROM `gx_pegawai` WHERE `level`='0' AND `id_bagian` = 'CSO' AND `id_cabang` = '".$loggedin["cabang"]."'";
													$data_query_cso = mysql_query($data_sql_cso, $conn);
													while($data_cso = mysql_fetch_array($data_query_cso)){
													$content .= '<option value="'.$data_cso['id_employee'].'">'.$data_cso['nama'].'</option>';
						}
					$content .= '
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
											<label>Jenis Pekerjaan</label>
											</div>
											<div class="col-xs-3">
												<select name="jenis_kerjaan"  class="form-control">
													<option value="">All Job</option>
													<option value="MNT">MNT (Maintainance)</option>
													<option value="PB">PB (Pasang Baru WL)</option>
													<option value="AKT">AKT (Aktivasi FO)</option>
													<option value="MFO">MFO (Maintenance FO)</option>
													<option value="PL">PL (perbaikan link)</option>
													<option value="RL">RL (Relokasi)</option>
													<option value="RP">RP (Reposisi)</option>
													<option value="RA">RA (Reaktivasi)</option>
													<option value="BKR">BKR (Bongkar)</option>
													<option value="TRK">TRK (Penarikan Kabel)</option>
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
                                    <h3 class="box-title">List Maintenance</h3>
									<a href="form_maintenance.php" class="btn bg-olive btn-flat margin pull-right">Tambah Baru</a>
                                </div><!-- /.box-header -->
								
								

<table id="maintenance" class="table table-bordered table-striped">
	<thead>
		<tr>';

if(isset($_POST["stats"]))
{
	    $content .='
                <th width="50">No</th>
				<th>CSO</th>
                <th>Tanggal</th>
                <th>User ID</th>
				<th>Nama</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Teknisi</th>
                <th>Problem</th>';

}
else
{

	    $content .='
				<th width="50">No</th>
                <th>CSO</th>
                <th>Last Upd</th>
                <th>User ID</th>
                <th>Nama</th>
                <th>Alamat</th>
				<th>Jenis Pekerjaan</th>
                <th>Status</th>
                <th>Teknisi</th>
                <th>C/in</th>
                <th>C/out</th>
				<th>Action</th>';

	}

	$content .='
            </tr>
        </thead>
        <tbody>';

        if(isset($_POST["stats"])){
            $no = 1;
            while ($data = mysql_fetch_array($result)) {
				
				$query_teknisi	= mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee` = '".$data["id_teknisi"]."' AND `level` = '0' LIMIT 0,1;", $conn);
				$row_teknisi	= mysql_fetch_array($query_teknisi);
    
				
                $content .="<tr><td align='center'>".$no."</td>
                <td>".$data["updated_by"]."</td>
                <td align='left'>".$data["tanggal"]."</td>
				<td>".$data["user_id"]."</td>
                <td>".$data["nama"]."</td>
                <td>".$data["alamat"]."</td>
                <td>".$data["status"]."</td>
                <td>".$row_teknisi["nama"]."</td>
				
				<td>".$data["check_in"]."</td>
                <td>".$data["check_out"]."</td>
                <td align='center'><a href='detail_maintenance.php?id=".$data["id_monitoring"]."' class='lightbox'>view</a></td>
                </tr>";

                $no++;

            }

	    

	}else{
		$no = 1;
            while ($data = mysql_fetch_array($result)) {
				
				$query_teknisi	= mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee` = '".$data["id_teknisi"]."' AND `level` = '0' LIMIT 0,1;", $conn);
				$row_teknisi	= mysql_fetch_array($query_teknisi);
				
                $content .=" <tr><td align='center'>".$no."</td>
                <td>".$data["updated_by"]."</td>
                <td>".date("d-m-Y H:i A", strtotime($data["date_upd"]))."</td>
				<td>".$data["user_id"]."</td>
                <td>".$data["nama"]."</td>
                <td>".$data["alamat"]."</td>
				<td>".$data["jenis_kerjaan"]."</td>
                <td>".$data["status"]."</td>
                <td>".$row_teknisi["nama"]."</td>
				<td>".$data["check_in"]."</td>
                <td>".$data["check_out"]."</td>
                
			<td align='center'>
			<a href='detail_maintenance.php?id=".$data["id_monitoring"]."'
			onclick=\"return valideopenerform('detail_maintenance.php?id=".$data["id_monitoring"]."','maintenance');\">view</a> |
			<a href='form_maintenance.php?id=".$data["id_monitoring"]."' >Edit</a>
		</td>";

		

                $content .= '</tr>';
                $no++;

            }
	}


$content .='

        </tbody>

</table><br>

';



if(isset($_POST["stats"])){

    $content .='<b>Total kunjungan ('. $total.')</b>';



}

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