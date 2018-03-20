<?php
/*
 * Theme Name: Software Globalxtreme ver. 1.0
 * Website: http://192.168.182.10/software/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 1.0  | 8 Agustus 2014
 * Email:
 * Theme for http://192.168.182.10/software/beta/
 */


function detail_pegawai($id_employee)
{
    global $conn;
    
    $id_employee    = ($id_employee != "") ? $id_employee : "";
    $sql_pegawai	    = mysql_query("SELECT * FROM `tbPegawai` WHERE `id_employee` = '".$id_employee."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_pegawai 	    = mysql_fetch_array($sql_pegawai);

    $template_pegawai = '   <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Pegawai</h2>
				</div>
				 
                                <div class="box-body">
                                    <table style="margin-bottom: 0;width:60%">
                                        <tbody>
                                        <tr>
                                            <td>cKode</td>
                                            <td>'.$row_pegawai["cKode"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>'.$row_pegawai["cNama"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Bagian</td>
                                            <td>'.$row_pegawai["cBagian"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>'.$row_pegawai["cAlamat1"].', Kota: '.$row_pegawai["cKota"].'</td>
                                        </tr>
                                        <tr>
                                            <td>No Telp</td>
                                            <td>'.$row_pegawai["cHandPhone1"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>'.$row_pegawai["cAlamatEmail"].'</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>';

    return $template_pegawai;

}

function detail_customer($customer_number)
{
    global $conn;
    
    $customer_number    = ($customer_number != "") ? $customer_number : "";
    $sql_user	    = mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".$customer_number."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_user 	    = mysql_fetch_array($sql_user);

    $template_pegawai = '   <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Customer</h2>
				</div>
				 
                                <div class="box-body">
                                    <table style="margin-bottom: 0;width:60%">
                                        <tbody>
                                        <tr>
                                            <td>Customer Number</td>
                                            <td>'.$row_user["cKode"].'</td>
                                        </tr>
                                        <tr>
                                            <td>User ID</td>
                                            <td><span class="sugar_field" id="name">'.$row_user["cUserID"].'</span></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>'.$row_user["cNama"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Perusahaan</td>
                                            <td>'.$row_user["cNamaPers"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>'.$row_user["cAlamat1"].', Kota: '.$row_user["cKota"].'</td>
                                        </tr>
                                        <tr>
                                            <td>No Telp</td>
                                            <td>'.$row_user["ctelp"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Fax</td>
                                            <td>'.$row_user["cfax"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>'.$row_user["cEmail"].'</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>';

    return $template_pegawai;

}

function history_complaint($customer_number)
{
    global $conn;
    
    $customer_number    = ($customer_number != "") ? $customer_number : "";
    $sql_history_complaint	= "SELECT * FROM `gx_helpdesk_complaint`
                                    WHERE `cust_number` = '".$customer_number."'
                                    ORDER BY `date_add` DESC;";
    $query_history_complaint= mysql_query($sql_history_complaint, $conn);
    
    $template_complaint = '     <div class="box">
                                    <div class="box-header">
                                        <h2 class="box-title">History Complaint</h2>
                                    </div>
                                    <div class="box-body">
                                    
                                    <div class="table-container">
                                        <table class="table table-bordered table-striped" id="complaint_history" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tanggal</th>
                                                <th>Problem</th>
                                                <th>Media</th>
                                                <th>Status</th>
                                                <th>Last Update</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

$no = 1;
while ($row_complaint = mysql_fetch_array($query_history_complaint)) {
    if($row_complaint["status"] == "open")
    {
         $status_complaint =  '<span class="label label-danger">Open</span>';
    }elseif($row_complaint["status"] == "closed")
    {
         $status_complaint =  '<span class="label label-success">Closed</span>';
    }elseif($row_complaint["status"] == "pending" || $row_complaint["status"] == "waiting")
    {
         $status_complaint =  '<span class="label label-warning">Waiting/Pending</span>';
    }else
    {
         $status_complaint =  '<span class="label label-danger">no status</span>';
    }

    $template_complaint .= '
    <tr>
                <td>'.$no.'</td>
                <td>'.$row_complaint["date_add"].'</td>
                <td>'.substr($row_complaint["problem"], 0, 50).'</td>
                <td>'.$row_complaint["media"].'</td>
                <td>'.$status_complaint.'</td>
                <td>Last updated by '.$row_complaint["updated_by"].' ('.$row_complaint["date_upd"].')</td>
                
    </tr>';
    $no++;

 }

    $template_complaint .= '            </tbody>
                                    </table><br>
                                </div>
                                </div>
                            </div>';

    return $template_complaint;

}

function history_email($email)
{
    global $conn;
    
    $email              = ($email != "") ? $email : "";
    $sql_history_email	= "SELECT * FROM `gx_email` WHERE `EmailFrom` LIKE '%".$email."%'
                        ORDER BY `date_add` DESC; ";
    $query_history_email= mysql_query($sql_history_email, $conn);


    $template_email = '     <div class="box">
                                <div class="box-header">
                                    <h2 class="box-title">History Email</h2>
                                </div>
                                <div class="box-body">
                                <div class="table-container">
                                    <table class="table table-bordered table-striped" id="email_history" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Messagge</th>
                                            <th>Status</th>
                                            <th>Last Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>';


$no = 1;
while ($row_email = mysql_fetch_array($query_history_email)) {
    $sql_status_reply = mysql_num_rows(mysql_query("SELECT * FROM `gx_email_reply`
                                                  WHERE `id_email` = '".$row_email["ID"]."';", $conn));
    $row_status_reply = mysql_fetch_array(mysql_query("SELECT * FROM `gx_email_reply`
                                                  WHERE `id_email` = '".$row_email["ID"]."';", $conn));
   
    $template_email .= '
    <tr>
          <td>'.$no.'.</td>
          <td>'.$row_email["date_add"].'</td>
          <td>'.substr($row_email["Message"], 0, 50).'</td>
          <td>'.(($sql_status_reply >= 1) ? '<a href="reply.php?id='.$row_email['ID'].'" onclick="return valideopenerform(\'reply.php?id='.$row_email['ID'].'\',\'reply'.$row_email["ID"].'\');"><span class="label label-success">replied</span></a>'
                 : '<span class="label label-warning">not replied</span>').'</td>
          <td>'.(($sql_status_reply >= 1) ? 'Last updated by:'.$row_status_reply["user_add"].' ('.$row_status_reply["date_add"].')' : '').'</td>
                
     </tr>
     
    ';
    $no++;
}


$template_email .= '
                                    </tbody>                    
                                    </table><br>
                                </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->';

    return $template_email;

}

function detail_kendaraan($id_kendaraan)
{
    global $conn;
    
    $id_kendaraan   = ($id_kendaraan != "") ? $id_kendaraan : "";
    $sql_kendaraan  = mysql_query("SELECT * FROM `gx_kendaraan` WHERE `id_kendaraan` = '".$id_kendaraan."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_kendaraan  = mysql_fetch_array($sql_kendaraan);

    $template_kendaraan = '   <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Kendaraan</h2>
				</div>
				 
                                <div class="box-body">
                                    <table style="margin-bottom: 0;width:60%">
                                        <tbody>
                                        <tr>
                                            <td>Nopol Kendaraan</td>
                                            <td>'.$row_kendaraan["nopol_kendaraan"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>'.$row_kendaraan["nama_kendaraan"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis</td>
                                            <td>'.$row_kendaraan["jenis_kendaraan"].', Tahun: '.$row_kendaraan["tahun_kendaraan"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td>'.$row_kendaraan["keterangan_kendaraan"].'</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>';

    return $template_kendaraan;

}

function detail_tracking($id_gps, $title_gps)
{
    global $conn;
    
    $id_gps   = ($id_gps != "") ? $id_gps : "";
    $title_gps= ($title_gps != "") ? $title_gps : "History GPS Hari ini";
    $sql_gps  = mysql_query("SELECT * FROM `gx_gps_device` WHERE `id_gps` = '".$id_gps."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_gps  = mysql_fetch_array($sql_gps);
    
    $template_gps = '   <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">'.$title_gps.'</h2>
				</div>
				 
                                <div class="box-body">
                                    <div id="map"></div>
                                </div>
                            </div>
    
    ';

    return $template_gps;

}

function detail_gps($id_gps)
{
    global $conn;
    
    $id_gps   = ($id_gps != "") ? $id_gps : "";
    $sql_gps  = mysql_query("SELECT * FROM `gx_gps_device` WHERE `id_gps` = '".$id_gps."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_gps  = mysql_fetch_array($sql_gps);

    $template_gps = '   <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data GPS Unit</h2>
				</div>
				 
                                <div class="box-body">
                                    <table style="margin-bottom: 0;width:60%">
                                        <tbody>
                                        <tr>
                                            <td>Nama GPS</td>
                                            <td>'.$row_gps["nama_gps"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Nomer SIM</td>
                                            <td>'.$row_gps["no_sim"].'</td>
                                        </tr>
                                        <tr>
                                            <td>IMEI</td>
                                            <td>'.$row_gps["imei"].'</td>
                                        </tr>
                                        <tr>
                                            <td>SMS Center</td>
                                            <td>'.$row_gps["sms_center"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Nomer SOS</td>
                                            <td>'.$row_gps["sos_1"].', '.$row_gps["sos_2"].', '.$row_gps["sos_3"].'</td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>';

    return $template_gps;

}

function detail_paket($id_paket)
{
    global $conn;
    
    $id_paket   = ($id_paket != "") ? $id_paket : "";
    $sql_paket  = mysql_query("SELECT `gx_paket`.*, `gx_tipe`.`nama_type`
				  FROM `gx_paket`, `gx_tipe`
				  WHERE `gx_paket`.`id_type` = `gx_tipe`.`id_type`
				  AND `gx_paket`.`id_paket` = '".$id_paket."'
                                  AND `gx_paket`.`level` = '0';", $conn);
    $row_paket  = mysql_fetch_array($sql_paket);

    $sql_cabang = mysql_query("SELECT `nama_cabang` FROM `gx_cabang`
                             WHERE `id_cabang` = '".$row_paket["id_cabang"]."'
                             AND `gx_cabang`.`level` = '0';", $conn);
    $row_cabang = mysql_fetch_array($sql_cabang);

    $template_paket = '   <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Paket</h2>
				</div>
				 
                                <div class="box-body">
                                    <table style="margin-bottom: 0;width:60%">
                                        <tbody>
                                        <tr>
                                            <td>Nama Paket</td>
                                            <td>'.$row_paket["nama_paket"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi Paket</td>
                                            <td>'.$row_paket["desc_paket"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Cabang</td>
                                            <td>'.(($row_paket["id_cabang"] == "0") ? "Semua Cabang" : $row_cabang["nama_cabang"]).'</td>
                                        </tr>
                                        <tr>
                                            <td>Tipe Paket</td>
                                            <td>'.$row_paket["nama_type"].'</td>
                                        </tr>
                                        <tr>
                                            <td>Periode Paket</td>
                                            <td>'.periodePaket($row_paket["periode_paket"]).'</td>
                                        </tr>
                                        <tr>
                                            <td>Harga Paket</td>
                                            <td>'.Rupiah($row_paket["harga_paket"]).'</td>
                                        </tr>
                                        <tr>
                                            <td>Setup Fee</td>
                                            <td>'.Rupiah($row_paket["setup_fee"]).'</td>
                                        </tr>
                                        <tr>
                                            <td>Bundling</td>
                                            <td>'.(($row_paket["bundling"] == "0") ? "Yes" : "No").'</td>
                                        </tr>
                                        </tbody>
                                    </table><br><br>
                                    
                                    <div id="form_data" '.(($row_paket["id_type"] != "2") ? ' style="display:none;"' : "").'>
				    <fieldset>
					<legend>DATA INTERNET:</legend>
					<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
						<label>Account Index RBS</label>
					    </div>
					    <div class="col-xs-8">
						'.$row_paket["account_index"].'
					    </div>
                                        </div>
                                        </div>
					<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
						<label>GroupName RBS</label>
					    </div>
					    <div class="col-xs-8">
						'.$row_paket["group_name"].'
					    </div>
                                        </div>
                                        </div>
					
					<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
						<label>Tipe Koneksi</label>
					    </div>
					    <div class="col-xs-4">
						'.$row_paket["tipe_koneksi"].'
					    </div>
                                        </div>
                                        </div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Time Based</label>
					    </div>
					    <div class="col-xs-6">
						'.$row_paket["time_based"].'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Volume Based(Kuota)</label>
					    </div>
					    <div class="col-xs-6">
						'.$row_paket["volume_based"].'
					    </div>
                                        </div>
					</div>
					
                                        <div id="form_dl" '.(($row_paket["tipe_koneksi"] == "dl") ? "" : ' style="display:none;"').'>
                                            <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <label for="bw_info">Informasi Bandwidth</label>
                                                </div>
                                            </div>
                                            </div>
                                            
                                            <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Limiter</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    '.$row_paket["bw_dl_down"].'
                                                </div>
                                                <div class="col-xs-4">
                                                    '.$row_paket["bw_dl_up"].'
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        
                                        <div id="form_upto" '.(($row_paket["tipe_koneksi"] == "upto") ? "" : ' style="display:none;"').'>
                                            <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <label for="bw_info">Bandwidth Info</label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Limiter Atas</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    '.$row_paket["bw_atas_down"].'
                                                </div>
                                                <div class="col-xs-4">
                                                    '.$row_paket["bw_atas_up"].'
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Limiter Tengah</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    '.$row_paket["bw_tengah_down"].'
                                                </div>
                                                <div class="col-xs-4">
                                                    '.
                                                    $row_paket["bw_tengah_up"].'
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Limiter Bawah</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    '.$row_paket["bw_bawah_down"].'
                                                </div>
                                                <div class="col-xs-4">
                                                    '.$row_paket["bw_bawah_up"].'
                                                </div>
                                            </div>
                                            </div>
                                            
                                            
                                        </div>
				    </fieldset>
				    </div>
				    
				    <div id="form_voip" '.(($row_paket["id_type"] != "1") ? ' style="display:none;"' : "").'>
				    <fieldset>
					<legend>DATA VOIP:</legend>
					
				    </fieldset>
				    </div>
				    <div id="form_vod" '.(($row_paket["id_type"] != "3") ? ' style="display:none;"' : "").'>
				    <fieldset>
					<legend>DATA VOD:</legend>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>List Paket TV</label>
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">';
$sql_tv = mysql_query("SELECT `gx_tv_stream`.* FROM `gx_tv_packages`, `gx_tv_packages_det`, `gx_tv_stream`
                        WHERE `gx_tv_packages`.`id_package` = `gx_tv_packages_det`.`id_package`
                        AND `gx_tv_stream`.`id` = `gx_tv_packages_det`.`id_tv`
                        AND `gx_tv_packages`.`id_package` = '".$row_paket["id_pakettv"]."'
                        AND `gx_tv_packages`.`level` = '0'
                        ORDER BY `gx_tv_stream`.`id` ASC;",$conn);

$template_paket .='	
                                            <div class="col-xs-12">
                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
                                                    <tr>
                                                    <td align="center">';
                                                    
                                                    while ($row_tv = mysql_fetch_array($sql_tv)){
                                                        $template_paket .='<div style="float : left; margin-left: 5px; margin-bottom: 3px;">
                                                                    <img src="'.URL_IMG_TV.$row_tv['url_thumb'].'" name="'.$row_tv["channel"].'"  width="123" height="86" border="0">
                                                                    </div>';
                                                    }
                                                   $template_paket .='
                                                    </td>
                                                    </tr>
                                                  
                                                </table>
                                            </div>
                                        </div>
					</div>
				    </fieldset>
				    </div>
                                </div>
                            </div>';

    return $template_paket;

}