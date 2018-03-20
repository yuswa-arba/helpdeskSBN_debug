<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Maintenance");
    global $conn;
    

if(isset($_GET["id"])){

	$id_data	= isset( $_GET['id']) ? (int)$_GET['id'] : "";
	$query		= "SELECT * FROM `gx_pasang_fo` WHERE `level` = '0' AND `id_pasang_fo` = '".$id_data."' LIMIT 0,1";
	$sql_data	= mysql_query($query);
	$row_data	= mysql_fetch_array($sql_data);
	
	
}

$selected_status 	= isset($_GET['id']) ? $row_data["status"] : "";
$time_hour      	= isset($_GET['id']) ? substr($row_data["time_slot"], 0, 2) : "";
$time_minutes   	= isset($_GET['id']) ? substr($row_data["time_slot"], 3, 2) : "";
$time_ampm      	= isset($_GET['id']) ? substr($row_data["time_slot"], 10, 2) : "";

    $content ='<section class="content-header">
                    <h1>
                        Form Jadwal Pasang FO
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
						<form action="" method="post" name="form_maintenance" enctype="multipart/form-data">
                            <div class="box">
								<div class="box-header">
                                    <h3 class="box-title">Form Jadwal Pasang FO</h3>
                                </div><!-- /.box-header -->
												
                                <div class="box-body table-responsive">
				
		
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Nama CSO</label>
				</div>
				<div class="col-xs-4">
					<input type="text" class="form-control" required="" name="nama_cso" readonly="" value="'.$loggedin["username"].'">
					<input type="hidden" name="id_cso" readonly="" value="'.(isset($_GET["id"]) ? $row_data["id_cso"] : $loggedin["id_employee"]).'" />
					<input type="hidden" name="id_pasang_fo" readonly="" value="'.(isset($_GET["id"]) ? $row_data["id_pasang_fo"] : '').'" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>User ID</label>
				</div>
				<div class="col-xs-4">
					<input name="user_id" class="form-control" type="text" id="user_id" value="'.(isset($_GET['id']) ? strip_tags(trim($row_data["user_id"])) : "").'" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Nama</label>
				</div>
				<div class="col-xs-4">
					<input name="nama" class="form-control" type="text" id="nama" value="'.(isset($_GET['id']) ? strip_tags(trim($row_data["nama"])) : "").'" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Alamat</label>
				</div>
				<div class="col-xs-4">
					<textarea name="alamat" id="alamat" class="form-control">'.(isset($_GET['id']) ? strip_tags(trim($row_data["alamat"])) : "").'</textarea>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Tanggal</label>
				</div>
				<div class="col-xs-4">
					<input name="tanggal" readonly="" class="form-control" type="text" id="datepicker" value="'.(isset($_GET['id']) ? strip_tags(trim($row_data["tanggal"])) : date("Y-m-d")).'" />
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Time Slot</label>
				</div>
				<div class="col-xs-4">
				<div class="bootstrap-timepicker">
					<input name="time_slot" readonly="" class="form-control timepicker" type="text" value="'.(isset($_GET['id']) ? strip_tags(trim($row_data["time_slot"])) : "").'" />
				</div>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Pekerjaan</label>
				</div>
				<div class="col-xs-4">
					 <select name="pekerjaan" class="form-control">
                
                <option value="Penarikan Kabel" '.(isset($_GET['id']) && ($row_data["pekerjaan"]=="Penarikan Kabel") ? 'selected=""' : "").' >Penarikan Kabel</option>
                <option value="Penyambungan" '.(isset($_GET['id']) && ($row_data["pekerjaan"]=="Penyambungan") ? 'selected=""' : "").' >Penyambungan</option>
                <option value="Aktivasi" '.(isset($_GET['id']) && ($row_data["pekerjaan"]=="Aktivasi") ? 'selected=""' : "").' >Aktivasi</option>
                
              </select>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Teknisi</label>
				</div>
				<div class="col-xs-4">
					<select  class="form-control" name="teknisi">';
						$data_sql_teknisi = "SELECT * FROM `gx_pegawai` WHERE `level`='0' AND `id_bagian` = 'Teknisi' AND `id_cabang` = '".$loggedin["cabang"]."'";
						$data_query_teknisi = mysql_query($data_sql_teknisi, $conn);
						while($data_tek = mysql_fetch_array($data_query_teknisi)){
						$content .= '<option value="'.$data_tek['id_employee'].'" '.((isset($_GET["id"]) && $row_data["id_teknisi"] == $data_tek["id_employee"]) ? 'selected=""' : "").'>'.$data_tek['nama'].'</option>';
						}
					$content .= '
					</select>
				</div>
				
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Status</label>
				</div>
				<div class="col-xs-4">
					 <select name="status" class="form-control">
						
						<option value="Check-in" '.(($selected_status =="Check-in") ? 'selected=""' : "").' >Check-in</option>
						<option value="Check-out" '.(($selected_status =="Check-out") ? 'selected=""' : "").' >Check-out</option>
						<option value="Delay" '.(($selected_status =="Delay") ? 'selected=""' : "").' >Delay</option>
						<option value="Cleared" '.(($selected_status=="Cleared") ? 'selected=""' : "").' >Cleared </option>
						<option value="Uncleared" '.(($selected_status=="Uncleared") ? 'selected=""' : "").' >Uncleared</option>
						<option value="OTW" '.(($selected_status=="OTW") ? 'selected=""' : "").' >OTW</option>
						<option value="Pending" '.(($selected_status=="Pending") ? 'selected=""' : "").' >Pending</option>
						<option value="N/A" '.(($selected_status=="N/A") ? 'selected=""' : "").' >N/A</option>
						
              </select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Keterangan</label>
				</div>
				<div class="col-xs-4">
					<textarea  class="form-control" name="keterangan">'.(isset($_GET['id']) ? $row_data["keterangan"] : '').'</textarea>
				</div>
			</div>
		</div>
		
		</div><!-- /.box-body -->
			
		   
		<div class="box-footer">
			<button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
		</div>
	
          
	
	
                               
                            </div><!-- /.box -->
							</form>
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

if(isset($_POST["save"]))
{
	$user_id	= isset($_POST['user_id']) ? strip_tags(trim($_POST["user_id"])) : "";
	$nama		= isset($_POST['nama']) ? strip_tags(trim($_POST["nama"])) : "";
	$alamat 	= isset($_POST['alamat']) ? strip_tags(trim($_POST["alamat"])) : "";
	$id_area 	= isset($_POST['id_area']) ? strip_tags(trim($_POST["id_area"])) : "";
	$tanggal 	= isset($_POST['tanggal']) ? strip_tags(trim($_POST["tanggal"])) : date("Y-m-d");
	$pekerjaan 	= isset($_POST['pekerjaan']) ? strip_tags(trim($_POST["pekerjaan"])) : "";
	$keterangan 	= isset($_POST['keterangan']) ? strip_tags(trim($_POST["keterangan"])) : "";
	$status 	= isset($_POST['status']) ? strip_tags(trim($_POST["status"])) : "";
	$teknisi 	= isset($_POST['teknisi']) ? strip_tags(trim($_POST["teknisi"])) : "";
	$time_slot	= isset($_POST['time_slot']) ? strip_tags(trim($_POST["time_slot"])) : "";

	if($user_id !="")
	{
		
		$query = "INSERT INTO `gx_pasang_fo` (`id_pasang_fo`, `user_id`, `nama`, `alamat`, `pekerjaan`, `keterangan`,
		`status`, `teknisi`, `tanggal`, `id_area`, `time_slot`,
		`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
		VALUES ('', '$user_id', '$nama', '$alamat', '$pekerjaan', '$keterangan',
		'$status', '$teknisi', '$tanggal', '$id_area', '$time_slot',
		'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0')";
	
		mysql_query($query) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
				</script>");
	
		echo "<script language='JavaScript'>
				alert('Data telah disimpan!');
				location.href = 'jadwal_pasangfo.php';
				</script>";
	
	}
	else
	{
		echo "<script language='JavaScript'>
				alert('Data userid tidak boleh kosong!');
				location.href = 'form_jadwalfo.php';
				</script>";	
	}
}
elseif( isset($_POST["update"]))
{
	$id_pasang_fo	= isset($_POST['id_pasang_fo']) ? strip_tags(trim($_POST["id_pasang_fo"])) : "";
	$user_id	= isset($_POST['user_id']) ? strip_tags(trim($_POST["user_id"])) : "";
	$nama		= isset($_POST['nama']) ? strip_tags(trim($_POST["nama"])) : "";
	$alamat 	= isset($_POST['alamat']) ? strip_tags(trim($_POST["alamat"])) : "";
	$id_area 	= isset($_POST['id_area']) ? strip_tags(trim($_POST["id_area"])) : "";
	$tanggal 	= isset($_POST['tanggal']) ? strip_tags(trim($_POST["tanggal"])) : date("Y-m-d");
	$pekerjaan 	= isset($_POST['pekerjaan']) ? strip_tags(trim($_POST["pekerjaan"])) : "";
	$keterangan 	= isset($_POST['keterangan']) ? strip_tags(trim($_POST["keterangan"])) : "";
	$status 	= isset($_POST['status']) ? strip_tags(trim($_POST["status"])) : "";
	$teknisi 	= isset($_POST['teknisi']) ? strip_tags(trim($_POST["teknisi"])) : "";
	$time_slot	= isset($_POST['time_slot']) ? strip_tags(trim($_POST["time_slot"])) : "";

	//$last_upd	= isset($_POST['last_upd']) ? strip_tags(trim($_POST["last_upd"])) : "";
	
	if($user_id !="" AND $id_pasang_fo != "")
	{
	$query = "UPDATE `gx_pasang_fo` SET `user_id` = '$user_id', `nama` = '$nama', `alamat` = '$alamat',
        `pekerjaan` = '$pekerjaan', `keterangan` = '$keterangan', `status` = '$status', `teknisi` = '$teknisi', `time_slot` = '$time_slot',
		`id_area` = '$id_area', `tanggal` = '$tanggal', `user_upd` = '".$loggedin["username"]."', `date_upd` = now()
		WHERE `id_pasang_fo` = '$id_pasang_fo'";
	
        //echo $query;
	mysql_query($query) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	
	echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'jadwal_pasangfo.php';
            </script>";
	}
	else
	{
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'form_jadwalfo.php';
            </script>";
	}
}

$plugins = '<!-- InputMask -->
    <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<!-- datepicker -->
    <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
	<!-- bootstrap time picker -->
	<link rel="stylesheet" href="'.URL.'css/timepicker/bootstrap-timepicker.min.css">
    <script src="'.URL.'js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	
	
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
				//Timepicker
				$(".timepicker").timepicker({
				  showInputs: false
				});
            });
        </script>';

    $title	= 'Form Maintenance';
    $submenu	= "maintenance";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_CSO."logout.php");
    }

?>