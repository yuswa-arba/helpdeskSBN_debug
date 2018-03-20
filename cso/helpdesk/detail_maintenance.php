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
	$query		= "SELECT * FROM `gx_maintenance` WHERE `level` = '0' AND `id_monitoring` = '".$id_data."' LIMIT 0,1";
	$sql_data	= mysql_query($query);
	$row_data	= mysql_fetch_array($sql_data);
	
	
}

$selected_status 	= isset($_GET['id']) ? $row_data["status"] : "";
$time_hour      	= isset($_GET['id']) ? substr($row_data["time_slot"], 0, 2) : "";
$time_minutes   	= isset($_GET['id']) ? substr($row_data["time_slot"], 3, 2) : "";
$time_ampm      	= isset($_GET['id']) ? substr($row_data["time_slot"], 10, 2) : "";

    $content ='<section class="content-header">
                    <h1>
                        Detail Maintenance
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
								<div class="box-header">
                                    <h3 class="box-title">Detail Maintenance</h3>
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
					<input type="hidden" name="id_monitoring" readonly="" value="'.(isset($_GET["id"]) ? $row_data["id_monitoring"] : '').'" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>User ID</label>
				</div>
				<div class="col-xs-4">
					<input name="user_id" readonly="" class="form-control" type="text" id="user_id" value="'.(isset($_GET['id']) ? strip_tags(trim($row_data["user_id"])) : "").'" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Nama</label>
				</div>
				<div class="col-xs-4">
					<input name="nama" readonly="" class="form-control" type="text" id="nama" value="'.(isset($_GET['id']) ? strip_tags(trim($row_data["nama"])) : "").'" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Alamat</label>
				</div>
				<div class="col-xs-4">
					<textarea name="alamat" readonly="" id="alamat" class="form-control">'.(isset($_GET['id']) ? strip_tags(trim($row_data["alamat"])) : "").'</textarea>
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
					<label>SPK Start</label>
				</div>
				<div class="col-xs-4">
					<input name="spk_start" readonly="" class="form-control" type="text" id="datepicker2" value="'.(isset($_GET['id']) ? strip_tags(trim($row_data["spk_start"])) : "").'" />
				</div>
			
				<div class="col-xs-2">
					<label>SPK Finish</label>
				</div>
				<div class="col-xs-4">
					<input name="spk_finish" readonly="" class="form-control" type="text" id="datepicker3" value="'.(isset($_GET['id']) ? strip_tags(trim($row_data["spk_finish"])) : "").'" />
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Check-in</label>
				</div>
				<div class="col-xs-4">
				<div class="bootstrap-timepicker">
					<input name="check_in" readonly="" readonly="" class="form-control timepicker" type="text" value="'.(isset($_GET['id']) ? strip_tags(trim($row_data["check_in"])) : "").'" />
				</div>
				</div>
			
				<div class="col-xs-2">
					<label>Check-out</label>
				</div>
				<div class="col-xs-4">
				<div class="bootstrap-timepicker">
					<input name="check_out" readonly="" readonly="" class="form-control timepicker" type="text" value="'.(isset($_GET['id']) ? strip_tags(trim($row_data["check_out"])) : "").'" />
				</div>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Jenis Pekerjaan</label>
				</div>
				<div class="col-xs-4">
					 <select name="jenis_kerjaan" class="form-control" disabled="">
                
                <option value="MNT" '.(isset($_GET['id']) && ($row_data["jenis_kerjaan"]=="MNT") ? 'selected=""' : "").' >MNT (Maintainance)</option>
                <option value="PB" '.(isset($_GET['id']) && ($row_data["jenis_kerjaan"]=="PB") ? 'selected=""' : "").' >PB (Pasang Baru WL)</option>
                <option value="AKT" '.(isset($_GET['id']) && ($row_data["jenis_kerjaan"]=="AKT") ? 'selected=""' : "").' >AKT (Aktivasi FO)</option>
                <option value="MFO" '.(isset($_GET['id']) && ($row_data["jenis_kerjaan"]=="MFO") ? 'selected=""' : "").' >MFO (Maintenance FO)</option>
                <option value="PL" '.(isset($_GET['id']) && ($row_data["jenis_kerjaan"]=="PL") ? 'selected=""' : "").' >PL (perbaikan link)</option>
				<option value="RL" '.(isset($_GET['id']) && ($row_data["jenis_kerjaan"]=="RL") ? 'selected=""' : "").' >RL (Relokasi)</option>
				<option value="RP" '.(isset($_GET['id']) && ($row_data["jenis_kerjaan"]=="RP") ? 'selected=""' : "").' >RP (Reposisi)</option>
				<option value="RA" '.(isset($_GET['id']) && ($row_data["jenis_kerjaan"]=="RA") ? 'selected=""' : "").' >RA (Reaktivasi)</option>
				<option value="BKR" '.(isset($_GET['id']) && ($row_data["jenis_kerjaan"]=="BKR") ? 'selected=""' : "").' >BKR (Bongkar)</option>

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
					<select  class="form-control" name="teknisi" disabled="">';
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
					 <select name="status" class="form-control" disabled="">
						
						<option value="Open" '.(($selected_status =="Open") ? 'selected=""' : "").' >Open</option>
						<option value="Closed" '.(($selected_status =="Closed") ? 'selected=""' : "").' >Closed</option>
						<option value="Check-in" '.(($selected_status =="Check-in") ? 'selected=""' : "").' >Check-in</option>
						<option value="Check-out" '.(($selected_status =="Check-out") ? 'selected=""' : "").' >Check-out</option>
						<option value="Delay" '.(($selected_status =="Delay") ? 'selected=""' : "").' >Delay</option>
						<option value="Cleared" '.(($selected_status=="Cleared") ? 'selected=""' : "").' >Cleared </option>
						<option value="Uncleared" '.(($selected_status=="Uncleared") ? 'selected=""' : "").' >Uncleared</option>
						<option value="OTW" '.(($selected_status=="OTW") ? 'selected=""' : "").' >OTW</option>
						<option value="Pending" '.(($selected_status=="Pending") ? 'selected=""' : "").' >Pending</option>
						<option value="N/A" '.(($selected_status=="N/A") ? 'selected=""' : "").' >N/A</option>
						<option value="Cancelled" '.(($selected_status=="Cancelled") ? 'selected=""' : "").' >Cancelled</option>
              </select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Problem</label>
				</div>
				<div class="col-xs-4">
					<textarea  class="form-control" name="problem" readonly="">'.(isset($_GET['id']) ? $row_data["problem"] : '').'</textarea>
				</div>
			</div>
		</div>
			
			
			
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Solusi</label>
				</div>
				<div class="col-xs-4">
					<textarea  class="form-control" name="solusi" readonly="">'.(isset($_GET['id']) ? $row_data["solusi"] : '').'</textarea>
				</div>
			</div>
		</div>
		
		</div><!-- /.box-body -->
			
	                               
                            </div><!-- /.box -->
							
                        </div>
                    </div>

                </section><!-- /.content -->
            ';


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
                $("[datepicker]").datepicker({format: "yyyy-mm-dd"});
                
				//Timepicker
				$(".timepicker").timepicker({
				  showInputs: false
				});
            });
        </script>';

    $title	= 'Detail Maintenance';
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