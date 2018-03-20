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
if($loggedin = logged_inAdmin()){ // Check if they are logged in
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

    $date 			= isset($_POST["date"]) ? strip_tags(trim($_POST["date"])) : date("Y-m-d");
    $jenis_kerjaan 	= isset($_POST["jenis_kerjaan"]) ? strip_tags(trim($_POST["jenis_kerjaan"])) : "";
    $teknisi 		= isset($_POST["teknisi"]) ? strip_tags(trim($_POST["teknisi"])) : "";
    $status 		= isset($_POST["status"]) ? strip_tags(trim($_POST["status"])) : "";
    $id_area 		= isset($_POST["id_area"]) ? strip_tags(trim($_POST["id_area"])) : "";
    $sql_jk 		= ($jenis_kerjaan != "") ? "AND `jenis_kerjaan` = '$jenis_kerjaan'" : "";
    $message_jk 	= ($jenis_kerjaan != "") ? " Dengan jenis_kerjaan $jenis_kerjaan" : "";


	$message_date	= ($date == "") ? " Pada Hari ini" : " Pada tanggal $date";
	
	$sql_teknisi = ($teknisi == "") ? "" : "AND `id_teknisi` = '$teknisi'";
	$message_teknisi = ($teknisi == "") ? "" : " Dengan teknisi $teknisi";
    
	$sql_status = ($status == "") ? "" : "AND `status` = '$status'";
	$message_status = ($status == "") ? "" : " Dengan Status $status";
    
    $sql_area = ($id_area == "") ? "" : " AND `id_area` = '$id_area'";
	$message_area = ($id_area == "") ? "" : " Pada Area $id_area";
    

    $queryList = "SELECT * FROM `gx_maintenance` WHERE `tanggal` LIKE '%$date%' $sql_status $sql_teknisi $sql_jk
    AND `level` = '0' ORDER BY `id_monitoring` ASC";
    $result = mysql_query($queryList) or die ("Error on Query List.data: ".mysql_error());
    $total = mysql_num_rows($result);
    $message_title = "Semua data $message_date $message_teknisi $message_status $message_area $message_jk.";

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
    $date = date("Y-m");
    $queryList = "SELECT DISTINCT `id_teknisi` FROM `gx_maintenance` WHERE `tanggal` LIKE '$date%'";
    $result = mysql_query($queryList) or die ("Error on Query List.data: ".mysql_error());
    $total = mysql_num_rows($result);
    $message_title = "Semua Data pada hari ini.";
}

$content = '<!-- Content Header (Page header) -->
                

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
												<input type="text" class="form-control" name="nama" id="nama" value="">
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
		<tr>
			<th width="50">No</th>
			<th>Nama Teknisi</th>
			<th>Open</th>
			<th>Check-in</th>
			<th>Cleared</th>
			<th>Pending</th>
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
				<td>".$data["user_id"]."</td>
                <td>".$data["nama"]."</td>
                <td>".$data["alamat"]."</td>
                <td>".$data["status"]."</td>
                <td>".$row_teknisi["nama"]."</td>
                </tr>";

                $no++;

            }

	    

	}else{
		$no = 1;
            while ($data = mysql_fetch_array($result)) {
				
				$query_teknisi	= mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee` = '".$data["id_teknisi"]."' AND `level` = '0' LIMIT 0,1;", $conn);
				$row_teknisi	= mysql_fetch_array($query_teknisi);
				
				$query_count_cleared	= mysql_query("SELECT COUNT(`status`) AS `stats_cleared` FROM `gx_maintenance` WHERE `id_teknisi` = '".$data["id_teknisi"]."' AND `status`= 'Cleared' AND `tanggal` LIKE '$date%';", $conn);
				$row_cleared	= mysql_fetch_array($query_count_cleared);
				
				$query_count_open	= mysql_query("SELECT COUNT(`status`) AS `stats_open` FROM `gx_maintenance` WHERE `id_teknisi` = '".$data["id_teknisi"]."' AND `status`= 'Open' AND `tanggal` LIKE '$date%';", $conn);
				$row_open	= mysql_fetch_array($query_count_open);
				
				$query_count_Check	= mysql_query("SELECT COUNT(`status`) AS `stats_checkin` FROM `gx_maintenance` WHERE `id_teknisi` = '".$data["id_teknisi"]."' AND `status`= 'Check-in' AND `tanggal` LIKE '$date%';", $conn);
				$row_Check	= mysql_fetch_array($query_count_Check);
				
				$query_count_pending	= mysql_query("SELECT COUNT(`status`) AS `stats_pending` FROM `gx_maintenance` WHERE `id_teknisi` = '".$data["id_teknisi"]."' AND `status`= 'Pending' AND `tanggal` LIKE '$date%';", $conn);
				$row_pending	= mysql_fetch_array($query_count_pending);
				
                $content .=" <tr><td align='center'>".$no."</td>
                <td>".$row_teknisi["nama"]."</td>
				<td>".$row_open["stats_open"]."</td>
                <td>".$row_Check["stats_checkin"]."</td>
                <td>".$row_cleared["stats_cleared"]."</td>
				<td>".$row_pending["stats_pending"]."</td>";

		

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
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
     else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>