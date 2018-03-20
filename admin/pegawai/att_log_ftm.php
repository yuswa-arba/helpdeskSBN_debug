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
if($loggedin = logged_inAdmin()){
// Check if they are logged in
 
//SQL 
$table_main = "";
$table_detail = "";

    $title_header = 'List Data Absensi Fingerspot';
    $submenu_header = '';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open log pegawai");
    global $conn;
	 
$dayNames = array(
	'Minggu',
	'Senin', 
	'Selasa', 
	'Rabu', 
	'Kamis', 
	'Jumat', 
	'Sabtu', 
 );

//select data
if(isset($_GET["id"]))
{
	$sql_data		= mysql_query("SELECT * FROM `fingerspot`.`att_log` WHERE `pin` = '".$_GET['id']."' ORDER BY `scan_date` DESC LIMIT 0,1;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `fingerspot`.`att_log` WHERE `pin` = '".$_GET['id']."';", $conn));
	
	$sql_data_pegawai		= mysql_query("SELECT * FROM `fingerspot`.`pegawai` WHERE `pegawai_pin` = '".$_GET['id']."';", $conn);
	$row_data_pegawai 		= mysql_fetch_array($sql_data_pegawai);
	
	$sql_gx_pegawai		= mysql_query("SELECT * FROM `gx_pegawai` WHERE `pin_ftm` = '".$_GET['id']."' AND `level` = '0' LIMIT 0,1;", $conn);
	$row_gx_pegawai 		= mysql_fetch_array($sql_gx_pegawai);
}

$content = '
                <!-- Main content -->
                <section class="content">
		   

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">LIST DATA</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table">
									<form action="" method="post" name="form_search">
										
											<input class="form-control" type="hidden" name="pin" value="'.(isset($_GET['id']) ? $row_data_pegawai['pegawai_pin'] : "").'">
											<input class="form-control" type="hidden" name="id_employee" value="'.(isset($_GET['id']) ? $row_gx_pegawai['id_employee'] : "").'">
											<input class="form-control" type="hidden" name="nama_pegawai" value="'.(isset($_GET['id']) ? $row_gx_pegawai['nama'] : "").'">
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Tanggal </label>
											</div>
											<div class="col-xs-2">
												<input class="form-control" id="datepicker" name="start_date" type="text" placeholder="Tanggal Awal" value="'.date("01-m-Y").'">
											</div>
											<div class="col-xs-2">
												<label>s/d </label>
											</div>
											<div class="col-xs-2">
												<input class="form-control" id="datepicker" type="text" name="end_date" placeholder="Tanggal Akhir"  value="'.date("t-m-Y").'">
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
						</div>
										</div>
										</div>
										</div>
						
						<div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">REPORT ABSENSI '.$row_data_pegawai["pegawai_nama"].'</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">	
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>Masuk</th>
			<th>Pulang</th>
			<th>Ket</th>
			<th>Hari</th>
			<th>JK</th>
			<th>MT</th>
			<th>MA</th>
			<th>MB</th>
			<th>JLB</th>
			<th>JLL</th>
		</tr>
	</thead>
<tbody>';



	
if(isset($_POST['search']))
{
	//echo $i.date("-m-Y")."<br>";
	$pin		= isset($_POST['pin']) ? mysql_real_escape_string(trim($_POST['pin'])) : '';
	$start_date		= isset($_POST['start_date']) ? mysql_real_escape_string(trim($_POST['start_date'])) : '';
	$end_date		= isset($_POST['end_date']) ? mysql_real_escape_string(trim($_POST['end_date'])) : '';
	
	
	$jam_masuk_kantor = new DateTime('08:00');
	$jam_plg_kantor = new DateTime('17:00');
	
	$total_mt = 0;
	$total_mb = 0;
	
	$d1	= date("j", strtotime($start_date));
	$d2	= date("j", strtotime($end_date));
	
	for($i= $d1; $i<= $d2; $i++)
	{
		$tanggal = $start_date;
		$tanggal2 = date("Y-m-d", strtotime($end_date));
		$day = date('w', strtotime($tanggal));
		
		$tanggal = sprintf('%02d', $i).date("-m-Y", strtotime($start_date));
		$tanggal2 = date("Y-m-", strtotime($start_date)).$i;
		$day = date('w', strtotime($tanggal));
		
		$data_masuk = mysql_fetch_array(mysql_query("SELECT * FROM `fingerspot`.`att_log` WHERE `pin` = '".$_GET['id']."' AND `scan_date` BETWEEN '".$tanggal2." 06%' AND '".$tanggal2." 08:00%';", $conn));
		$data_telat = mysql_fetch_array(mysql_query("SELECT * FROM `fingerspot`.`att_log` WHERE `pin` = '".$_GET['id']."' AND `scan_date` BETWEEN '".$tanggal2." 08:01%' AND '".$tanggal2." 12%';", $conn));
		$data_pulang = mysql_fetch_array(mysql_query("SELECT * FROM	`fingerspot`.`att_log` WHERE `pin` = '".$_GET['id']."' AND  `scan_date` BETWEEN '".$tanggal2." 16%' AND '".$tanggal2." 23%';", $conn));
		
		
		if($data_telat["scan_date"] != "" )
		{
			$scan_masuk  = explode(" ", $data_telat["scan_date"]);
			$jam_masuk = '<span class="text-red">'.date("H:i", strtotime($scan_masuk[1])).'</span>';
			
			$absen_telat = new DateTime($scan_masuk[1]);  
			$mt = $jam_masuk_kantor->diff($absen_telat)->format('%i');
			$jt = $jam_masuk_kantor->diff($absen_telat)->format('%H') * 60;
			$mt = ($jt + $mt);
			
			$total_mt += $mt;
		}
		else
		{
			if($data_masuk["scan_date"] != "" )
			{
				$scan_masuk  = explode(" ", $data_masuk["scan_date"]);
				$jam_masuk = date("H:i", strtotime($scan_masuk[1]));
				$mt = "0";
			}
			else
			{
				$jam_masuk = "-";
				$mt = "0";
			}
		}
		
		if($data_pulang["scan_date"] != "")
		{
			$scan_pulang = explode(" ", $data_pulang["scan_date"]);
			$jam_pulang = date("H:i", strtotime($scan_pulang[1]));
			
			$absen_pulang = new DateTime($scan_pulang[1]);  
			$mb = $jam_plg_kantor->diff($absen_pulang)->format('%i');
			$jb = $jam_plg_kantor->diff($absen_pulang)->format('%H') * 60;
			
			$mb = $jb + $mb;
			
			$total_mb += $mb;
		}
		else
		{
			$jam_pulang = "-";
			$mb = "0";
		}
		
		
		
		$content .= '
		<tr>
			<td>'.$tanggal.'</td>
			<td>'.$jam_masuk.'</td>
			<td>'.$jam_pulang.'</td>
			<td></td>
			<td>'.$dayNames[$day].'</td>
			<td></td>
			<td><span class="text-red">'.$mt.'</span></td>
			<td></td>
			<td>'.$mb.'</td>
			<td>0.00</td>
			<td>0.00</td>
		</tr>';
		
	}
	
}
else
{
	
	$jam_masuk_kantor = new DateTime('08:00:00');
	$jam_plg_kantor = new DateTime('17:00:00');
	
	$total_mt = 0;
	$total_mb = 0;
	
	for($i= 1; $i<= date("t"); $i++)
	{
		//echo $i.date("-m-Y")."<br>";
		$tanggal = sprintf('%02d', $i).date("-m-Y");
		$tanggal2 = date("Y-m-").$i;
		$day = date('w', strtotime($tanggal));
		
		$data_masuk = mysql_fetch_array(mysql_query("SELECT * FROM `fingerspot`.`att_log` WHERE `pin` = '".$_GET['id']."' AND `scan_date` BETWEEN '".$tanggal2." 06%' AND '".$tanggal2." 08:00:00%';", $conn));
		$data_telat = mysql_fetch_array(mysql_query("SELECT * FROM `fingerspot`.`att_log` WHERE `pin` = '".$_GET['id']."' AND `scan_date` BETWEEN '".$tanggal2." 08:00:01%' AND '".$tanggal2." 12%';", $conn));
		$data_pulang = mysql_fetch_array(mysql_query("SELECT * FROM	`fingerspot`.`att_log` WHERE `pin` = '".$_GET['id']."' AND  `scan_date` BETWEEN '".$tanggal2." 16%' AND '".$tanggal2." 23%';", $conn));
		
		
		if($data_telat["scan_date"] != "" )
		{
			$scan_masuk  = explode(" ", $data_telat["scan_date"]);
			$jam_masuk = '<span class="text-red">'.date("H:i", strtotime($scan_masuk[1])).'</span>';
			
			$absen_telat = new DateTime($scan_masuk[1]);  
			$mt = $jam_masuk_kantor->diff($absen_telat)->format('%i');
			$jt = $jam_masuk_kantor->diff($absen_telat)->format('%H') * 60;
			$mt = ($jt + $mt);
			
			$total_mt += $mt;
		}
		else
		{
			if($data_masuk["scan_date"] != "" )
			{
				$scan_masuk  = explode(" ", $data_masuk["scan_date"]);
				$jam_masuk = date("H:i", strtotime($scan_masuk[1]));
				$mt = "0";
			}
			else
			{
				$jam_masuk = "-";
				$mt = "0";
			}
		}
		
		if($data_pulang["scan_date"] != "")
		{
			$scan_pulang = explode(" ", $data_pulang["scan_date"]);
			$jam_pulang = date("H:i", strtotime($scan_pulang[1]));
			
			$absen_pulang = new DateTime($scan_pulang[1]);  
			$mb = $jam_plg_kantor->diff($absen_pulang)->format('%i');
			$jb = $jam_plg_kantor->diff($absen_pulang)->format('%H') * 60;
			
			$mb = $jb + $mb;
			
			$total_mb += $mb;
		}
		else
		{
			$jam_pulang = "-";
			$mb = "0";
		}
		
		
		
		$content .= '
		<tr>
			<td>'.$tanggal.'</td>
			<td>'.$jam_masuk.'</td>
			<td>'.$jam_pulang.'</td>
			<td></td>
			<td>'.$dayNames[$day].'</td>
			<td></td>
			<td><span class="text-red">'.$mt.'</span></td>
			<td></td>
			<td>'.$mb.'</td>
			<td>0.00</td>
			<td>0.00</td>
		</tr>';
		
	}
	
}
	
	
	
$content .='
</tbody>
<tfoot>
	<tr>
		<td colspan="5"><b>Total (dlm Jam)</b></td>
		<td></td>
		<td><span class="text-red"><b>'.sprintf("%02d:%02d", floor($total_mt/60), $total_mt%60).'</b></span></td>
		<td></td>
		<td><b>'.sprintf("%02d:%02d", floor($total_mb/60), $total_mb%60).'</b></td>
		<td></td>
	</tr>
</tfoot>
</table>
 
</div>
<br />
           
	    <div class="box-footer">
		<div class="box-tools pull-right">
		
		</div>
		<br style="clear:both;">
	     </div>
       </div>
	</section>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
<style type="text/css">
.label
{
	font-size:12px !important;
}

</style>
';


    $title	= $title_header;
    $submenu	= $submenu_header;
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }
	else
	{
		header("location: ".URL_ADMIN."logout.php");
    }

?>