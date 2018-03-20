<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin())
{ // Check if they are logged in

    if($loggedin["group"] == 'admin')
    {
	global $conn;
    
if(isset($_POST["save"]))
{
    $id_cabang 	= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $id_type	= isset($_POST['id_type']) ? mysql_real_escape_string(trim($_POST['id_type'])) : '';
    $nama_paket	= isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
    $bw_paket	= isset($_POST['bw_paket']) ? mysql_real_escape_string(trim($_POST['bw_paket'])) : '';
    $sla_paket	= isset($_POST['sla_paket']) ? mysql_real_escape_string(trim($_POST['sla_paket'])) : '';
    $periode_paket	= isset($_POST['periode_paket']) ? mysql_real_escape_string(trim($_POST['periode_paket'])) : '';
    $grace_periode	= isset($_POST['grace_periode']) ? mysql_real_escape_string(trim($_POST['grace_periode'])) : '';
    $harga_paket	= isset($_POST['harga_paket']) ? mysql_real_escape_string(trim($_POST['harga_paket'])) : '';
    $abonemen_paket	= isset($_POST['abonemen_paket']) ? mysql_real_escape_string(trim($_POST['abonemen_paket'])) : '';
    $pulsa_paket 	= isset($_POST['pulsa_paket']) ? mysql_real_escape_string(trim($_POST['pulsa_paket'])) : '';
    
    $bundling		= isset($_POST['bundling']) ? mysql_real_escape_string(trim($_POST['bundling'])) : '';
    $setup_fee		= isset($_POST['setup_fee']) ? mysql_real_escape_string(trim($_POST['setup_fee'])) : '';
    $account_index	= isset($_POST['account_index']) ? mysql_real_escape_string(trim($_POST['account_index'])) : '';
    $group_name		= isset($_POST['group_name']) ? mysql_real_escape_string(trim($_POST['group_name'])) : '';
    $tipe_koneksi	= isset($_POST['tipe_koneksi']) ? mysql_real_escape_string(trim($_POST['tipe_koneksi'])) : '';
    $time_based		= isset($_POST['time_based']) ? mysql_real_escape_string(trim($_POST['time_based'])) : '';
    $volume_based	= isset($_POST['volume_based']) ? mysql_real_escape_string(trim($_POST['volume_based'])) : '';
    
    //bandwidth dedicated link
    $bw_dl_down	= isset($_POST['bw_dl_down']) ? mysql_real_escape_string(trim($_POST['bw_dl_down'])) : '';
    $bw_dl_up	= isset($_POST['bw_dl_up']) ? mysql_real_escape_string(trim($_POST['bw_dl_up'])) : '';
    
    //bandwidth upto
    $bw_up1_down= isset($_POST['bw_up1_down']) ? mysql_real_escape_string(trim($_POST['bw_up1_down'])) : '';
    $bw_up1_up	= isset($_POST['bw_up1_up']) ? mysql_real_escape_string(trim($_POST['bw_up1_up'])) : '';
    $bw_up2_down= isset($_POST['bw_up2_down']) ? mysql_real_escape_string(trim($_POST['bw_up2_down'])) : '';
    $bw_up2_up	= isset($_POST['bw_up2_up']) ? mysql_real_escape_string(trim($_POST['bw_up2_up'])) : '';
    $bw_up3_down= isset($_POST['bw_up3_down']) ? mysql_real_escape_string(trim($_POST['bw_up3_down'])) : '';
    $bw_up3_up	= isset($_POST['bw_up3_up']) ? mysql_real_escape_string(trim($_POST['bw_up3_up'])) : '';
    
    if($tipe_koneksi == "upto")
    {
	$nas_attributes	= '$bwrate = '.$bw_up3_down.'/'.$bw_up3_up.' '.$bw_up1_down.'/'.$bw_up1_up.' '.$bw_up2_down.'/'.$bw_up2_up.'         ';
    }elseif($tipe_koneksi == "dl")
    {
	$nas_attributes = '$bwrate = '.$bw_dl_down.'/'.$bw_dl_up.'         ';
    }elseif($tipe_koneksi == "")
    {
	$nas_attributes = '';
    }
    
    
    //insert into gxPaket
    $sql_insert = "INSERT INTO `gx_paket` (`id_paket`, `id_cabang`, `id_type`, `nama_paket`, `bw_paket`,
		    `sla_paket`, `periode_paket`, `grace_periode`, `harga_paket`, `abonemen_paket`,
		    `pulsa_paket`, `bundling`, `setup_fee`, `account_index`, `group_name`,
		    `tipe_koneksi`, `time_based`, `volume_based`, `nas_attributes`,
		    `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
		    VALUES (NULL, '".$id_cabang."', '".$id_type."', '".$nama_paket."', '".$bw_paket."',
		    '".$sla_paket."', '".$periode_paket."', '".$grace_periode."', '".$harga_paket."', '".$abonemen_paket."',
		    '".$pulsa_paket."', '".$bundling."', '".$setup_fee."', '".$account_index."', '".$group_name."',
		    '".$tipe_koneksi."', '".$time_based."', '".$volume_based."', '".$nas_attributes."',
		    NOW(), NOW(), '0', '".$loggedin["username"]."', '".$loggedin["username"]."');";                    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master_paket.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id_paket   = isset($_POST['id_paket']) ? mysql_real_escape_string(trim($_POST['id_paket'])) : '';
    $id_cabang 	= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $id_type	= isset($_POST['id_type']) ? mysql_real_escape_string(trim($_POST['id_type'])) : '';
    $nama_paket	= isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
    $bw_paket	= isset($_POST['bw_paket']) ? mysql_real_escape_string(trim($_POST['bw_paket'])) : '';
    $sla_paket	= isset($_POST['sla_paket']) ? mysql_real_escape_string(trim($_POST['sla_paket'])) : '';
    $periode_paket	= isset($_POST['periode_paket']) ? mysql_real_escape_string(trim($_POST['periode_paket'])) : '';
    $grace_periode	= isset($_POST['grace_periode']) ? mysql_real_escape_string(trim($_POST['grace_periode'])) : '';
    $harga_paket	= isset($_POST['harga_paket']) ? mysql_real_escape_string(trim($_POST['harga_paket'])) : '';
    $abonemen_paket	= isset($_POST['abonemen_paket']) ? mysql_real_escape_string(trim($_POST['abonemen_paket'])) : '';
    $pulsa_paket 	= isset($_POST['pulsa_paket']) ? mysql_real_escape_string(trim($_POST['pulsa_paket'])) : '';
    
    $bundling		= isset($_POST['bundling']) ? mysql_real_escape_string(trim($_POST['bundling'])) : '';
    $setup_fee		= isset($_POST['setup_fee']) ? mysql_real_escape_string(trim($_POST['setup_fee'])) : '';
    $account_index	= isset($_POST['account_index']) ? mysql_real_escape_string(trim($_POST['account_index'])) : '';
    $group_name		= isset($_POST['group_name']) ? mysql_real_escape_string(trim($_POST['group_name'])) : '';
    $tipe_koneksi	= isset($_POST['tipe_koneksi']) ? mysql_real_escape_string(trim($_POST['tipe_koneksi'])) : '';
    $time_based		= isset($_POST['time_based']) ? mysql_real_escape_string(trim($_POST['time_based'])) : '';
    $volume_based	= isset($_POST['volume_based']) ? mysql_real_escape_string(trim($_POST['volume_based'])) : '';
    
    //bandwidth dedicated link
    $bw_dl_down	= isset($_POST['bw_dl_down']) ? mysql_real_escape_string(trim($_POST['bw_dl_down'])) : '';
    $bw_dl_up	= isset($_POST['bw_dl_up']) ? mysql_real_escape_string(trim($_POST['bw_dl_up'])) : '';
    
    //bandwidth upto
    $bw_up1_down= isset($_POST['bw_up1_down']) ? mysql_real_escape_string(trim($_POST['bw_up1_down'])) : '';
    $bw_up1_up	= isset($_POST['bw_up1_up']) ? mysql_real_escape_string(trim($_POST['bw_up1_up'])) : '';
    $bw_up2_down= isset($_POST['bw_up2_down']) ? mysql_real_escape_string(trim($_POST['bw_up2_down'])) : '';
    $bw_up2_up	= isset($_POST['bw_up2_up']) ? mysql_real_escape_string(trim($_POST['bw_up2_up'])) : '';
    $bw_up3_down= isset($_POST['bw_up3_down']) ? mysql_real_escape_string(trim($_POST['bw_up3_down'])) : '';
    $bw_up3_up	= isset($_POST['bw_up3_up']) ? mysql_real_escape_string(trim($_POST['bw_up3_up'])) : '';
    
    if($tipe_koneksi == "upto")
    {
	$nas_attributes	= '$bwrate = '.$bw_up3_down.'/'.$bw_up3_up.' '.$bw_up1_down.'/'.$bw_up1_up.' '.$bw_up2_down.'/'.$bw_up2_up.'         ';
    }elseif($tipe_koneksi == "dl")
    {
	$nas_attributes = '$bwrate = '.$bw_dl_down.'/'.$bw_dl_up.'         ';
    }elseif($tipe_koneksi == "")
    {
	$nas_attributes = '';
    }
    
    //update gxPaket
    $sql_update = "UPDATE `gx_paket` SET `id_cabang` = '".$id_cabang."', `id_type` = '".$id_type."',
		    `nama_paket` = '".$nama_paket."', `bw_paket` = '".$bw_paket."', `sla_paket` = '".$sla_paket."',
		    `periode_paket` = '".$periode_paket."', `grace_periode` = '".$grace_periode."',
		    `harga_paket` = '".$harga_paket."', `abonemen_paket` = '".$abonemen_paket."',
		    `pulsa_paket` = '".$pulsa_paket."', `bundling` = '".$bundling."', `setup_fee` = '".$setup_fee."',
		    `account_index` = '".$account_index."', `group_name` = '".$group_name."',
		    `tipe_koneksi` = '".$tipe_koneksi."', `time_based` = '".$time_based."',
		    `volume_based` = '".$volume_based."', `nas_attributes` = '".$nas_attributes."',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		   WHERE `id_paket` = '".$id_paket."';";
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."master_paket.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_paket		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_paket 	= "SELECT * FROM `gx_paket_bundling` WHERE `id_paket`='".$id_paket."' LIMIT 0,1;";
    
    $sql_paket 		= mysql_query($query_paket, $conn);
    $row_paket 		= mysql_fetch_array($sql_paket);
    
}



    $content ='<section class="content-header">
                    <h1>
                        Form Paket Bundling
                        
                    </h1>
                    
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Paket</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="" name="form_paket" id="form_paket">
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Paket</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="nama_paket" value="'.(isset($_GET['id']) ? $row_paket["nama_paket"] : "").'">
						'.(isset($_GET['id']) ? '<input type="hidden" name="id_paket" value="'.$id_paket.'">' : "").'
					    </div>
					    
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-6">
						<select class="form-control" name="id_cabang">';
						
$selected_all = isset($_GET["id"]) ? $row_paket["id_cabang"] : "";
$selected_all = ($selected_all == '0') ? ' selected=""' : "";
    
$content .='<option value="0" '.$selected_all.'>Semua Cabang</option>';
					    
$sql_gxCabang = mysql_query("SELECT * FROM `gx_cabang` ORDER BY `nama_cabang` ASC", $conn);
while($row_gxcabang = mysql_fetch_array($sql_gxCabang)){
    $selected = isset($_GET["id"]) ? $row_paket["id_cabang"] : "";
    $selected = ($selected == $row_gxcabang["id_cabang"]) ? ' selected=""' : "";
    
    $content .= '<option value="'.$row_gxcabang["id_cabang"].'" '.$selected.'>'.$row_gxcabang["nama_cabang"].'</option>';
    
}
						
						
						$content .= '
                                            </select>
					    </div>
					    
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Periode</label>
					    </div>
					    <div class="col-xs-6">
						
						<select class="form-control" name="periode_paket">
						    <option value="1" '.(($selected_periode == "1") ? ' selected=""' : "").'>Harian</option>
						    <option value="7" '.(($selected_periode == "7") ? ' selected=""' : "").'>Mingguan</option>
						    <option value="30" '.(($selected_periode == "30") ? ' selected=""' : "").'>Bulanan</option>
						    <option value="365" '.(($selected_periode == "365") ? ' selected=""' : "").'>Tahunan</option>
						</select>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Harga</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" placeholder="Harga" name="harga_paket" value="'.(isset($_GET['id']) ? $row_paket["harga_paket"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Setup Fee</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" placeholder="Setup Fee" name="setup_fee" value="'.(isset($_GET['id']) ? $row_paket["setup_fee"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Paket Data</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="setup_fee" value="'.(isset($_GET['id']) ? $row_paket["setup_fee"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Paket VOIP</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="setup_fee" value="'.(isset($_GET['id']) ? $row_paket["setup_fee"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Paket VOD</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="setup_fee" value="'.(isset($_GET['id']) ? $row_paket["setup_fee"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						&nbsp;
					    </div>
					    <div class="col-xs-6">
						&nbsp;
					    </div>
                                        </div>
					</div>
					
					
				    <div id="form_data" '.(($selected_tipepaket != "2") ? ' style="display:none;"' : "").'>
				    <fieldset>
					<legend>DATA INTERNET:</legend>
					<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
						<label>Account Index RBS</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" name="account_index" value="'.(isset($_GET['id']) ? $row_paket["account_index"] : "").'">
						<input type="text" name="account_name" value="">
						<a href="select.php?tipe=account_index" class="btn btn-sm bg-navy btn-flat margin"
						onclick="return valideopenerform(\'select.php?tipe=account_index\',\'account_index\');">Select</a>
					    </div>
                                        </div>
                                        </div>
					<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
						<label>GroupName RBS</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" name="group_name" value="'.(isset($_GET['id']) ? $row_paket["group_name"] : "").'">
						<input type="text" name="group_index" value="">
						<a href="select.php?tipe=group_name" class="btn btn-sm bg-navy btn-flat margin"
						onclick="return valideopenerform(\'select.php?tipe=group_name\',\'groupname\');">Select</a>
					    </div>
                                        </div>
                                        </div>
					
					<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
						<label>Tipe Koneksi</label>
					    </div>
					    <div class="col-xs-4">
						<input id="upto" type="radio" name="tipe_koneksi" value="upto" '.(($selected_tipekoneksi == "upto") ? ' checked=""' : "").' />Upto
					    </div>
					    <div class="col-xs-4">
						<input id="dl" type="radio" name="tipe_koneksi" value="dl" '.(($selected_tipekoneksi == "dl") ? ' checked=""' : "").' /> Dedicated Link
					    </div>
                                        </div>
                                        </div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Time Based</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" placeholder="Satuan Detik" name="time_based" value="'.(isset($_GET['id']) ? $row_paket["time_based"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Volume Based(Kuota)</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" placeholder="satuan MB" name="volume_based" value="'.(isset($_GET['id']) ? $row_paket["volume_based"] : "").'">
					    </div>
                                        </div>
					</div>
					
                                        <div id="form_dl" '.(($selected_tipekoneksi == "dl") ? "" : ' style="display:none;"').'>
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
                                                    <input type="text" class="form-control" name="bw_dl_down" value="" placeholder="DOWNLOAD (MB/KB)">
                                                </div>
                                                <div class="col-xs-4">
                                                    <input type="text" class="form-control" name="bw_dl_up" value="" placeholder="UPLOAD (MB/KB)">
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        
                                        <div id="form_upto" '.(($selected_tipekoneksi == "upto") ? "" : ' style="display:none;"').'>
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
                                                    <input type="text" class="form-control" name="bw_up1_down" value="" placeholder="DOWNLOAD (MB/KB)">
                                                </div>
                                                <div class="col-xs-4">
                                                    <input type="text" class="form-control" name="bw_up1_up" value="" placeholder="UPLOAD (MB/KB)">
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Limiter Tengah</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    <input type="text" class="form-control" name="bw_up2_down" value="" placeholder="DOWNLOAD (MB/KB)">
                                                </div>
                                                <div class="col-xs-4">
                                                    <input type="text" class="form-control" name="bw_up2_up" value="" placeholder="UPLOAD (MB/KB)">
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Limiter Bawah</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    <input type="text" class="form-control" name="bw_up3_down" value="" placeholder="DOWNLOAD (MB/KB)">
                                                </div>
                                                <div class="col-xs-4">
                                                    <input type="text" class="form-control" name="bw_up3_up" value="" placeholder="UPLOAD (MB/KB)">
                                                </div>
                                            </div>
                                            </div>
                                            
                                            
                                        </div>
				    </fieldset>
				    </div>
				    
				    <div id="form_voip" '.(($selected_tipepaket != "1") ? ' style="display:none;"' : "").'>
				    <fieldset>
					<legend>DATA VOIP:</legend>
					
				    </fieldset>
				    </div>
				    <div id="form_vod" '.(($selected_tipepaket != "3") ? ' style="display:none;"' : "").'>
				    <fieldset>
					<legend>DATA VOD:</legend>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Paket</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" placeholder="Setup Fee" name="id_pakettv" value="">
						<input type="text" class="form-control" placeholder="Setup Fee" name="nama_pakettv" value="">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label for="nominal">Paket Channel TV</label>
					    </div>
					    <div class="col-xs-4">
						<h5>select</h5>
					    </div>
					    
                                        </div>
					</div>
				    </fieldset>
				    </div>
				    
				    
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary" value="Save">Save</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script type="text/javascript">
$(document).ready(function () {
$(\'#data\').on(\'ifChecked\', function(event){
    $(\'#form_voip\').hide(\'fast\');
    $(\'#form_vod\').hide(\'fast\');
    $(\'#form_data\').show(\'fast\');
});
   $(\'#voip\').on(\'ifChecked\', function(event){
        
	$(\'#form_vod\').hide(\'fast\');
	$(\'#form_data\').hide(\'fast\');
	$(\'#form_voip\').show(\'fast\');
    });
    
    $(\'#vod\').on(\'ifChecked\', function(event){
        
	$(\'#form_voip\').hide(\'fast\');
	$(\'#form_data\').hide(\'fast\');
	$(\'#form_vod\').show(\'fast\');
    });
});
</script>
<script type="text/javascript">
$(document).ready(function () {
    $(\'#dl\').on(\'ifChecked\', function(event){
        $(\'#form_upto\').hide(\'fast\');
        $(\'#form_dl\').show(\'fast\');
    });
   $(\'#upto\').on(\'ifChecked\', function(event){
        $(\'#form_dl\').hide(\'fast\');
        $(\'#form_upto\').show(\'fast\');
    });
});
</script>
';
    
    
    $title	= 'Form Paket';
    $submenu	= "paket";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>