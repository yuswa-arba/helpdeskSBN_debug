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

    $bulan 			= isset($_POST["bulan"]) ? strip_tags(trim($_POST["bulan"])) : "";
    $tahun		 	= isset($_POST["tahun"]) ? strip_tags(trim($_POST["tahun"])) : "";
    $nama	 		= isset($_POST["nama"]) ? strip_tags(trim($_POST["nama"])) : "";
	$id_cabang 		= isset($_POST["id_cabang"]) ? strip_tags(trim($_POST["id_cabang"])) : "";
	
	$sql_nama		=($nama != "") ? "AND `gx_pegawai`.`nama` LIKE '%".$nama."%'" : "";
	$sql_cabang		=($id_cabang != "") ? "AND `gx_pegawai`.`id_cabang` = '".$id_cabang."'" : "";
	
	$date = $tahun.'-'.$bulan;
   

	
    $queryList = "SELECT `id_employee`, `nama`, `nama_cabang` FROM `gx_pegawai`, `gx_cabang`
	WHERE `gx_pegawai`.`id_cabang` = `gx_cabang`.`id_cabang`
	$sql_cabang
	$sql_nama
	AND `gx_pegawai`.`id_bagian` = 'Teknisi' ORDER BY `gx_pegawai`.`nama` ASC;";
    $result = mysql_query($queryList) or die ("Error on Query List.data: ".mysql_error());
    $total = mysql_num_rows($result);

}else{
	$date = "Y-m";
    $queryList = "SELECT `id_employee`, `nama`, `nama_cabang` FROM `gx_pegawai`, `gx_cabang`
	WHERE `gx_pegawai`.`id_cabang` = `gx_cabang`.`id_cabang`
	AND `gx_pegawai`.`id_bagian` = 'Teknisi' ORDER BY `gx_pegawai`.`nama` ASC;";
    $result = mysql_query($queryList) or die ("Error on Query List.data: ".mysql_error());
    $total = mysql_num_rows($result);
    //$message_title = "Semua Data pada hari ini.";
}
$bulan = array("Januari","Febuari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

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
											<label>Bulan</label>
											</div>
											<div class="col-xs-2">
												<select name="bulan" class="form-control">
													';
													for($i=0;$i<=11;$i++)
													{
														$content .= '<option value="'.($i+1).'" '.((date("m") == ($i+1)) ? 'selected=""' : "").'>'.$bulan[$i].'</option>';
													}
$content .='
												</select>
											</div>
											<div class="col-xs-2">
											<label>Tahun</label>
											</div>
											<div class="col-xs-2">
												<select name="tahun" class="form-control">
													';
													for($t=2010;$t<=2020;$t++)
													{
														$content .= '<option value="'.$t.'"  '.((date("Y") == ($t)) ? 'selected=""' : "").'>'.$t.'</option>';
													}
$content .='
												</select>
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
											<label>Kantor Cabang</label>
											</div>
											<div class="col-xs-3">
												<select name="id_cabang" class="form-control">
													';
													$data_cabang = mysql_query("SELECT * FROM  `gx_cabang` WHERE `level`= '0';");
													while ($row_cabang = mysql_fetch_array($data_cabang))
													{
														$content .= '<option value="'.$row_cabang["id_cabang"].'" >'.$row_cabang["nama_cabang"].'</option>';
													}
$content .='
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
									
                                </div><!-- /.box-header -->
								
								

<table id="maintenance" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="50">No</th>
			<th>Nama Teknisi</th>
			<th>Cabang</th>
			<th>Open</th>
			<th>Check-in</th>
			<th>Cleared</th>
			<th>Pending</th>
		</tr>
	</thead>
	<tbody>';

       
	$no = 1;
	while ($data = mysql_fetch_array($result)) {
		
		$query_count_cleared	= mysql_query("SELECT COUNT(`status`) AS `stats_cleared` FROM `gx_maintenance` WHERE `id_teknisi` = '".$data["id_employee"]."' AND `status`= 'Cleared' AND `tanggal` LIKE '$date%';", $conn);
		$row_cleared	= mysql_fetch_array($query_count_cleared);
		
		$query_count_open	= mysql_query("SELECT COUNT(`status`) AS `stats_open` FROM `gx_maintenance` WHERE `id_teknisi` = '".$data["id_employee"]."' AND `status`= 'Open' AND `tanggal` LIKE '$date%';", $conn);
		$row_open	= mysql_fetch_array($query_count_open);
		
		$query_count_Check	= mysql_query("SELECT COUNT(`status`) AS `stats_checkin` FROM `gx_maintenance` WHERE `id_teknisi` = '".$data["id_employee"]."' AND `status`= 'Check-in' AND `tanggal` LIKE '$date%';", $conn);
		$row_Check	= mysql_fetch_array($query_count_Check);
		
		$query_count_pending	= mysql_query("SELECT COUNT(`status`) AS `stats_pending` FROM `gx_maintenance` WHERE `id_teknisi` = '".$data["id_employee"]."' AND `status`= 'Pending' AND `tanggal` LIKE '$date%';", $conn);
		$row_pending	= mysql_fetch_array($query_count_pending);
		
		$content .=' <tr><td align="center">'.$no.'</td>
		<td><a href="maintenance.php?id='.$data["id_employee"].'&d='.$date.'" title="Detail Maintenance">'.$data["nama"].'</a></td>
		<td>'.$data["nama_cabang"].'</td>
		<td>'.$row_open["stats_open"].'</td>
		<td>'.$row_Check["stats_checkin"].'</td>
		<td>'.$row_cleared["stats_cleared"].'</td>
		<td>'.$row_pending["stats_pending"].'</td>';

		/*<td><h4><span class="label label-danger">'.$row_open["stats_open"].'</span></h4></td>
		<td><h4><span class="label label-info">'.$row_Check["stats_checkin"].'</span></h4></td>
		<td><h4><span class="label label-success">'.$row_cleared["stats_cleared"].'</span></h4></td>
		<td><h4><span class="label label-warning">'.$row_pending["stats_pending"].'</span></h4></td>*/

		$content .= '</tr>';
		$no++;

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