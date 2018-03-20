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
include ("../../config/configuration_tv.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin())
{ // Check if they are logged in

    if($loggedin["group"] == 'admin')
    {
	global $conn;
	$conn_ott   = DB_TV();
	$conn_soft = Config::getInstanceSoft();
    
if(isset($_POST["save"]))
{
    //$id_paket           = isset($_POST['id_paket']) ? mysql_real_escape_string(trim($_POST['id_paket'])) : '';
    $id_cabang          = isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $kode_paket         = isset($_POST['kode_paket']) ? mysql_real_escape_string(trim($_POST['kode_paket'])) : '';
    $nama_paket         = isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
    $jenis_paket        = isset($_POST['jenis_paket']) ? mysql_real_escape_string(trim($_POST['jenis_paket'])) : '';
    $periode_start      = isset($_POST['periode_start']) ? mysql_real_escape_string(trim($_POST['periode_start'])) : '';
    $periode_end        = isset($_POST['periode_end']) ? mysql_real_escape_string(trim($_POST['periode_end'])) : '';
    $internet_type      = isset($_POST['internet_type']) ? mysql_real_escape_string(trim($_POST['internet_type'])) : '';
    $internet_paket     = isset($_POST['internet_paket']) ? mysql_real_escape_string(trim($_POST['internet_paket'])) : '';
    $voip               = isset($_POST['voip']) ? mysql_real_escape_string(trim($_POST['voip'])) : '';
    $video              = isset($_POST['video']) ? mysql_real_escape_string(trim($_POST['video'])) : '';
    $setup_fee          = isset($_POST['setup_fee']) ? str_replace(",", "", $_POST['setup_fee']) : '';
    $abonemen_voip      = isset($_POST['abonemen_voip']) ? str_replace(",", "", $_POST['abonemen_voip']) : '';
    $abonemen_video     = isset($_POST['abonemen_video']) ? str_replace(",", "", $_POST['abonemen_video']) : '';
	$monthly_fee        = isset($_POST['monthly_fee']) ? str_replace(",", "", $_POST['monthly_fee']) : '';
    $monthly_for        = isset($_POST['monthly_for']) ? mysql_real_escape_string(trim($_POST['monthly_for'])) : '';
    $maintenance_free   = isset($_POST['maintenance_free']) ? mysql_real_escape_string(trim($_POST['maintenance_free'])) : '';
    $maintenance_fee    = isset($_POST['maintenance_fee']) ? str_replace(",", "", $_POST['maintenance_fee']) : '';
    $acc_piutang        = isset($_POST['acc_piutang']) ? mysql_real_escape_string(trim($_POST['acc_piutang'])) : '';
    $acc_um             = isset($_POST['acc_um']) ? mysql_real_escape_string(trim($_POST['acc_um'])) : '';
    $group_rbs          = isset($_POST['group_rbs']) ? mysql_real_escape_string(trim($_POST['group_rbs'])) : '';
    $account_index      = isset($_POST['account_index']) ? mysql_real_escape_string(trim($_POST['account_index'])) : '';
    $bandwith_usage     = isset($_POST['bandwith_usage']) ? mysql_real_escape_string(trim($_POST['bandwith_usage'])) : '';
    $bw_upload          = isset($_POST['bw_upload']) ? mysql_real_escape_string(trim($_POST['bw_upload'])) : '';
    $bw_download        = isset($_POST['bw_download']) ? mysql_real_escape_string(trim($_POST['bw_download'])) : '';
    $backbone_1         = isset($_POST['backbone_1']) ? mysql_real_escape_string(trim($_POST['backbone_1'])) : '';
    $backbone_2         = isset($_POST['backbone_2']) ? mysql_real_escape_string(trim($_POST['backbone_2'])) : '';
    $backbone_3         = isset($_POST['backbone_3']) ? mysql_real_escape_string(trim($_POST['backbone_3'])) : '';
    $sla_paket          = isset($_POST['sla_paket']) ? mysql_real_escape_string(trim($_POST['sla_paket'])) : '';
	
    $acc_piutang_voip   = isset($_POST['acc_piutang_voip']) ? str_replace(",", "", $_POST['acc_piutang_voip']) : '';
    $acc_piutang_vod    = isset($_POST['acc_piutang_vod']) ? str_replace(",", "", $_POST['acc_piutang_vod']) : '';
    $acc_piutang_inet   = isset($_POST['acc_piutang_inet']) ? str_replace(",", "", $_POST['acc_piutang_inet']) : '';
	
	$service_perangkat  = isset($_POST['service_perangkat']) ? str_replace(",", "", $_POST['service_perangkat']) : '';
    $burst	        	= isset($_POST['burst']) ? mysql_real_escape_string(trim($_POST['burst'])) : '';
    $harga_nonkontrak   = isset($_POST['harga_nonkontrak']) ? mysql_real_escape_string(trim($_POST['harga_nonkontrak'])) : '';
    $restitusi			= isset($_POST['restitusi']) ? mysql_real_escape_string(trim($_POST['restitusi'])) : '';
    $internet_paket_ket		= isset($_POST['internet_paket_ket']) ? mysql_real_escape_string(trim($_POST['internet_paket_ket'])) : '';
    $internet_type_ket		= isset($_POST['internet_type_ket']) ? mysql_real_escape_string(trim($_POST['internet_type_ket'])) : '';
    $link				= isset($_POST['link']) ? mysql_real_escape_string(trim($_POST['link'])) : '';
    $faktur_pajak		= isset($_POST['faktur_pajak']) ? mysql_real_escape_string(trim($_POST['faktur_pajak'])) : '';
    
	$id_paket_tv		= isset($_POST['id_paket_tv']) ? mysql_real_escape_string(trim($_POST['id_paket_tv'])) : '';
	$acc_piutang_addon  = isset($_POST['acc_piutang_addon']) ? str_replace(",", "", $_POST['acc_piutang_addon']) : '';
	$abonemen_addon     = isset($_POST['abonemen_addon']) ? str_replace(",", "", $_POST['abonemen_addon']) : '';
    
    $id_area		= isset($_POST['id_area']) ? mysql_real_escape_string(trim($_POST['id_area'])) : '';
    $nama_area		= isset($_POST['nama_area']) ? mysql_real_escape_string(trim($_POST['nama_area'])) : '';
    
    if($kode_paket != ""){
    //insert into gxPaket
    $sql_insert = "INSERT INTO `gx_paket2` (`id_paket`, `id_cabang`, `kode_paket`, `nama_paket`,
    `jenis_paket`, `periode_start`, `periode_end`, `internet_type`, `internet_paket`, `voip`, `video`,
    `setup_fee`, `abonemen_voip`, `abonemen_video`, `monthly_fee`, `monthly_for`, `maintenance_free`, `maintenance_fee`,
    `acc_piutang`, `acc_um`, `group_rbs`, `account_index`, `bandwith_usage`, `bw_upload`, `bw_download`,
    `harga_nonkontrak`, `service_perangkat`, `burst`, `restitusi`, `internet_paket_ket`, `link`, `internet_type_ket`,
    `backbone_1`, `backbone_2`, `backbone_3`, `sla_paket`, `faktur_pajak`, `id_area`, `nama_area`,
	`acc_piutang_voip`, `acc_piutang_vod`, `acc_piutang_inet`,
	`id_paket_tv`, `acc_piutang_addon`, `abonemen_addon`,
    `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL, '".$id_cabang."', '".$kode_paket."', '".$nama_paket."',
    '".$jenis_paket."', '".$periode_start."', '".$periode_end."', '".$internet_type."', '".$internet_paket."', '".$voip."', '".$video."',
    '".$setup_fee."', '".$abonemen_voip."', '".$abonemen_video."', '".$monthly_fee."', '".$monthly_for."', '".$maintenance_free."', '".$maintenance_fee."',
    '".$acc_piutang."', '".$acc_um."', '".$group_rbs."', '".$account_index."', '".$bandwith_usage."', '".$bw_upload."', '".$bw_download."',
    '".$harga_nonkontrak."', '".$service_perangkat."', '".$burst."',  '".$restitusi."', '".$internet_paket_ket."',  '".$link."', '".$internet_type_ket."',
    '".$backbone_1."', '".$backbone_2."', '".$backbone_3."', '".$sla_paket."', '".$faktur_pajak."', '".$id_area."', '".$nama_area."',
	'".$acc_piutang_voip."', '".$acc_piutang_vod."', '".$acc_piutang_inet."',
	'".$id_paket_tv."', '".$acc_piutang_addon."', '".$abonemen_addon."',
    NOW(), NOW(), '0', '".$loggedin["username"]."', '".$loggedin["username"]."');";                    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='master_paket.php';
	</script>";
    }else{
	echo "<script language='JavaScript'>
	    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
	    window.history.go(-1);
	</script>";
    }
    
}
elseif(isset($_POST["update"]))
{
    $id_paket           = isset($_POST['id_paket']) ? mysql_real_escape_string(trim($_POST['id_paket'])) : '';
    $id_cabang          = isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $kode_paket         = isset($_POST['kode_paket']) ? mysql_real_escape_string(trim($_POST['kode_paket'])) : '';
    $nama_paket         = isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
    $jenis_paket        = isset($_POST['jenis_paket']) ? mysql_real_escape_string(trim($_POST['jenis_paket'])) : '';
    $periode_start      = isset($_POST['periode_start']) ? mysql_real_escape_string(trim($_POST['periode_start'])) : '';
    $periode_end        = isset($_POST['periode_end']) ? mysql_real_escape_string(trim($_POST['periode_end'])) : '';
    $internet_type      = isset($_POST['internet_type']) ? mysql_real_escape_string(trim($_POST['internet_type'])) : '';
    $internet_paket     = isset($_POST['internet_paket']) ? mysql_real_escape_string(trim($_POST['internet_paket'])) : '';
    $voip               = isset($_POST['voip']) ? mysql_real_escape_string(trim($_POST['voip'])) : '';
    $video              = isset($_POST['video']) ? mysql_real_escape_string(trim($_POST['video'])) : '';
    $setup_fee          = isset($_POST['setup_fee']) ? str_replace(",", "", $_POST['setup_fee']) : '';
    $abonemen_voip      = isset($_POST['abonemen_voip']) ? str_replace(",", "", $_POST['abonemen_voip']) : '';
    $abonemen_video     = isset($_POST['abonemen_video']) ? str_replace(",", "", $_POST['abonemen_video']) : '';
    $monthly_fee        = isset($_POST['monthly_fee']) ? str_replace(",", "", $_POST['monthly_fee']) : '';
    $monthly_for        = isset($_POST['monthly_for']) ? mysql_real_escape_string(trim($_POST['monthly_for'])) : '';
    $maintenance_free   = isset($_POST['maintenance_free']) ? mysql_real_escape_string(trim($_POST['maintenance_free'])) : '';
    $maintenance_fee    = isset($_POST['maintenance_fee']) ? str_replace(",", "", $_POST['maintenance_fee']) : '';
    $acc_piutang        = isset($_POST['acc_piutang']) ? mysql_real_escape_string(trim($_POST['acc_piutang'])) : '';
    $acc_um             = isset($_POST['acc_um']) ? mysql_real_escape_string(trim($_POST['acc_um'])) : '';
    $group_rbs          = isset($_POST['group_rbs']) ? mysql_real_escape_string(trim($_POST['group_rbs'])) : '';
    $account_index      = isset($_POST['account_index']) ? mysql_real_escape_string(trim($_POST['account_index'])) : '';
    $bandwith_usage     = isset($_POST['bandwith_usage']) ? mysql_real_escape_string(trim($_POST['bandwith_usage'])) : '';
    $bw_upload          = isset($_POST['bw_upload']) ? mysql_real_escape_string(trim($_POST['bw_upload'])) : '';
    $bw_download        = isset($_POST['bw_download']) ? mysql_real_escape_string(trim($_POST['bw_download'])) : '';
    $backbone_1         = isset($_POST['backbone_1']) ? mysql_real_escape_string(trim($_POST['backbone_1'])) : '';
    $backbone_2         = isset($_POST['backbone_2']) ? mysql_real_escape_string(trim($_POST['backbone_2'])) : '';
    $backbone_3         = isset($_POST['backbone_3']) ? mysql_real_escape_string(trim($_POST['backbone_3'])) : '';
    $sla_paket          = isset($_POST['sla_paket']) ? mysql_real_escape_string(trim($_POST['sla_paket'])) : '';
	
    $acc_piutang_voip   = isset($_POST['acc_piutang_voip']) ? str_replace(",", "", $_POST['acc_piutang_voip']) : '';
    $acc_piutang_vod    = isset($_POST['acc_piutang_vod']) ? str_replace(",", "", $_POST['acc_piutang_vod']) : '';
    $acc_piutang_inet   = isset($_POST['acc_piutang_inet']) ? str_replace(",", "", $_POST['acc_piutang_inet']) : '';
	
	$service_perangkat  = isset($_POST['service_perangkat']) ? str_replace(",", "", $_POST['service_perangkat']) : '';
    $burst	        	= isset($_POST['burst']) ? mysql_real_escape_string(trim($_POST['burst'])) : '';
    $harga_nonkontrak   = isset($_POST['harga_nonkontrak']) ? mysql_real_escape_string(trim($_POST['harga_nonkontrak'])) : '';
    $restitusi			= isset($_POST['restitusi']) ? mysql_real_escape_string(trim($_POST['restitusi'])) : '';
    $internet_paket_ket		= isset($_POST['internet_paket_ket']) ? mysql_real_escape_string(trim($_POST['internet_paket_ket'])) : '';
    $internet_type_ket		= isset($_POST['internet_type_ket']) ? mysql_real_escape_string(trim($_POST['internet_type_ket'])) : '';
    $link				= isset($_POST['link']) ? mysql_real_escape_string(trim($_POST['link'])) : '';
    $faktur_pajak		= isset($_POST['faktur_pajak']) ? mysql_real_escape_string(trim($_POST['faktur_pajak'])) : '';
    
	$id_paket_tv		= isset($_POST['id_paket_tv']) ? mysql_real_escape_string(trim($_POST['id_paket_tv'])) : '';
	$acc_piutang_addon  = isset($_POST['acc_piutang_addon']) ? str_replace(",", "", $_POST['acc_piutang_addon']) : '';
	$abonemen_addon     = isset($_POST['abonemen_addon']) ? str_replace(",", "", $_POST['abonemen_addon']) : '';
    
    $id_area		= isset($_POST['id_area']) ? mysql_real_escape_string(trim($_POST['id_area'])) : '';
    $nama_area		= isset($_POST['nama_area']) ? mysql_real_escape_string(trim($_POST['nama_area'])) : '';
    
    if($id_paket !=""){
    //update gxPaket
    $sql_update = "UPDATE `gx_paket2` SET `kode_paket` = '".$kode_paket."', `nama_paket` = '".$nama_paket."',
    `jenis_paket` = '".$jenis_paket."', `periode_start` = '".$periode_start."', `periode_end` = '".$periode_end."', `internet_type` = '".$internet_type."',
	`internet_paket` = '".$internet_paket."', `voip` = '".$voip."', `video` = '".$video."',
    `setup_fee` = '".$setup_fee."', `abonemen_voip` = '".$abonemen_voip."', `abonemen_video` = '".$abonemen_video."', `monthly_fee` = '".$monthly_fee."',
	`monthly_for` = '".$monthly_for."', `maintenance_free` = '".$maintenance_free."', `maintenance_fee` = '".$maintenance_fee."',
    `acc_piutang` = '".$acc_piutang."', `acc_um` = '".$acc_um."', `group_rbs` = '".$group_rbs."', `account_index` = '".$account_index."',
	`bandwith_usage` = '".$bandwith_usage."', `bw_upload` = '".$bw_upload."', `bw_download` = '".$bw_download."',
    `harga_nonkontrak` = '".$harga_nonkontrak."', `service_perangkat` = '".$service_perangkat."', `burst` = '".$burst."', `restitusi` = '".$restitusi."',
	`internet_paket_ket` = '".$internet_paket_ket."', `link` = '".$link."', `internet_type_ket` = '".$internet_type_ket."',
    `backbone_1` = '".$backbone_1."', `backbone_2` = '".$backbone_2."', `backbone_3` = '".$backbone_3."', `sla_paket` = '".$sla_paket."',
	`faktur_pajak` = '".$faktur_pajak."', `id_area` = '".$id_area."', `nama_area` = '".$nama_area."',
	`acc_piutang_voip` = '".$acc_piutang_voip."', `acc_piutang_vod` = '".$acc_piutang_vod."', `acc_piutang_inet` = '".$acc_piutang_inet."',
	`id_paket_tv` = '".$id_paket_tv."', `abonemen_addon` = '".$abonemen_addon."', `acc_piutang_addon` = '".$acc_piutang_addon."',
    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
    WHERE `id_paket` = '".$id_paket."';";
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
	
	
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='master_paket.php';
	</script>";
    }else{
	echo "<script language='JavaScript'>
	    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
	    window.history.go(-1);
	</script>";
    }
}

if(isset($_GET["id"]))
{
    $id_paket		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_paket 	= "SELECT * FROM `gx_paket2` WHERE `id_paket` = '".$id_paket."' AND `level` = '0' LIMIT 0,1;";
    
    $sql_paket 		= mysql_query($query_paket, $conn);
    $row_paket 		= mysql_fetch_array($sql_paket);
    
    
    
}
$selected_internet_type 	= isset($_GET["id"]) ? $row_paket["internet_type"] : "";
$selected_jenis_paket 		= isset($_GET["id"]) ? $row_paket["jenis_paket"] : "";
$selected_internet_paket 	= isset($_GET["id"]) ? $row_paket["internet_paket"] : "";
$selected_voip		 	= isset($_GET["id"]) ? $row_paket["voip"] : "";
$selected_video			= isset($_GET["id"]) ? $row_paket["video"] : "";

$selected_backbone1		= isset($_GET["id"]) ? $row_paket["backbone_1"] : "";
$selected_backbone2		= isset($_GET["id"]) ? $row_paket["backbone_2"] : "";
$selected_backbone3		= isset($_GET["id"]) ? $row_paket["backbone_3"] : "";

$selected_restitusi		= isset($_GET["id"]) ? $row_paket["restitusi"] : "";
$selected_link			= isset($_GET["id"]) ? $row_paket["link"] : "";
$selected_pajak			= isset($_GET["id"]) ? $row_paket["faktur_pajak"] : "";
/*
 <select class="form-control" name="id_cabang">';
						
$selected_all = isset($_GET["id"]) ? $row_paket["id_cabang"] : "";
$selected_all = ($selected_all == '0') ? ' selected=""' : "";
    
$content .='<option value="0" '.$selected_all.'>Semua Cabang</option>';
					    
$sql_gxCabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `level` = '0' ORDER BY `nama_cabang` ASC", $conn);
while($row_gxcabang = mysql_fetch_array($sql_gxCabang)){
    $selected = isset($_GET["id"]) ? $row_paket["id_cabang"] : "";
    $selected = ($selected == $row_gxcabang["id_cabang"]) ? ' selected=""' : "";
    
    $content .= '<option value="'.$row_gxcabang["id_cabang"].'" '.$selected.'>'.$row_gxcabang["nama_cabang"].'</option>';
    
}
						
						
						$content .= '
                                            </select>
*/
    $content ='
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
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-6">
							<input type="hidden" class="form-control" required="" id="id_cabang" name="id_cabang" value="'.(isset($_GET['id']) ? $row_staff["id_cabang"] : $loggedin["cabang"]).'" >
							<input type="text" readonly class="form-control" id="nama_cabang" name="nama_cabang" value="'.get_nama_cabang($loggedin['cabang']).'">
					    
						
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Paket</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" maxlength="100" name="kode_paket" value="'.(isset($_GET['id']) ? $row_paket["kode_paket"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Paket</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" maxlength="100" name="nama_paket" value="'.(isset($_GET['id']) ? $row_paket["nama_paket"] : "").'">
						'.(isset($_GET['id']) ? '<input type="hidden" name="id_paket" value="'.$id_paket.'">' : "").'
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Jenis Paket</label>
					    </div>
					    <div class="col-xs-3">
						<input id="jenis_paket" type="radio" name="jenis_paket" value="regular" '.(($selected_jenis_paket == "regular") ? ' checked=""' : "").' /> Regular
					    </div>
					    <div class="col-xs-3">
						<input id="jenis_paket" type="radio" name="jenis_paket" value="promo" '.(($selected_jenis_paket == "promo") ? ' checked=""' : "").' /> Promo
					    </div>
					    
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Periode Paket</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" id="datepicker" class="hasDatepicker" name="periode_start" value="'.(isset($_GET['id']) ? $row_paket["periode_start"] : date("d-m-Y")).'">
					    </div>
					    <div class="col-xs-3">
						sampai
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" id="datepicker2" class="hasDatepicker" name="periode_end" value="'.(isset($_GET['id']) ? $row_paket["periode_end"] : date("d-m-2099")).'">
					    </div>
					    
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Internet</label>
					    </div>
					    <div class="col-xs-3">
						<input id="internet_type" type="radio" name="internet_type" value="fo" '.(($selected_internet_type == "fo") ? ' checked=""' : "").' /> Fiber Optic
						
					    </div>
					    <div class="col-xs-3">
						<input id="internet_type" type="radio" name="internet_type" value="wireless" '.(($selected_internet_type == "wireless") ? ' checked=""' : "").' /> Wireless
					    </div>
					    <div class="col-xs-3">
						<input id="internet_type" type="radio" name="internet_type" value="lain" '.(($selected_internet_type == "lain") ? ' checked=""' : "").' /> Lain-lain
						<input type="text" id="internet_type_ket" maxlength="100" name="internet_type_ket" value="'.(($selected_internet_type == "lain")  ? $row_paket["internet_type_ket"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						
					    </div>
					    <div class="col-xs-3">
						<input id="internet_paket" type="radio" name="internet_paket" value="residential" '.(($selected_internet_paket == "residential") ? ' checked=""' : "").' /> Residential
						
					    </div>
					    
					    <div class="col-xs-3">
						<input id="internet_paket" type="radio" name="internet_paket" value="soho" '.(($selected_internet_paket == "soho") ? ' checked=""' : "").' /> SOHO
						
					    </div>
					    
					    <div class="col-xs-3">
						<input id="internet_paket" type="radio" name="internet_paket" value="dl" '.(($selected_internet_paket == "dl") ? ' checked=""' : "").' /> Dedicated Link
					    </div>
					
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						
					    </div>
					    <div class="col-xs-6">
						<input type="radio" name="internet_paket" id="internet_paket" value="lain" '.(($selected_internet_paket == "lain") ? ' checked=""' : "").' />Lain-lain
					    
						<input type="text" id="internet_paket_ket" maxlength="100" name="internet_paket_ket" value="'.(($selected_internet_paket == "lain")  ? $row_paket["internet_paket_ket"] : "").'">
						
					    </div>
					    
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Area</label>
					    </div>
					    <div class="col-xs-6">
						<input type="hidden"  name="id_area" value="'.(isset($_GET['id']) ? $row_paket["id_area"] : "").'" />
						<input type="text" class="form-control" readonly="" name="nama_area" value="'.(isset($_GET['id']) ? $row_paket["nama_area"] : "").'"
						onclick="return valideopenerform(\'data_area.php?r=form_paket&f=paket\',\'area\');" placeholder="Search Area"/>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>VOIP</label>
					    </div>
					    <div class="col-xs-6">
						<input type="checkbox"  name="voip"  value="voip" '.(($selected_voip == "voip") ? ' checked=""' : "").' />
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Video</label>
					    </div>
					    <div class="col-xs-3">
						<input type="checkbox"  name="video" value="video" '.(($selected_video == "video") ? ' checked=""' : "").' />
					    </div>
						<div class="col-xs-3">
						<label>Paket TV</label>
					    </div>
					    <div class="col-xs-3">
							<select name="id_paket_tv" class="form-control">';
						
					    
						
$sql_pakettv		= mysqli_query($conn_ott ,"SELECT * FROM `ott_product`;");


while($row_pakettv = mysqli_fetch_array($sql_pakettv))
{
	$content .='<option value="'.$row_pakettv["proID"].'">'.$row_pakettv["proName"].'</option>';
}
	
$content .='				</select>
						</div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Restitusi</label>
					    </div>
					    <div class="col-xs-3">
						<input id="restitusi" type="radio" name="restitusi" value="double_bw" '.(($selected_restitusi == "double_bw") ? ' checked=""' : "").' /> Double BW
					    </div>
					    <div class="col-xs-3">
						<input id="restitusi" type="radio" name="restitusi" value="rupiah" '.(($selected_restitusi == "rupiah") ? ' checked=""' : "").' /> Rupiah
					    </div>
					    
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Setup Fee</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="20" id="harga" name="setup_fee" value="'.(isset($_GET['id']) ? $row_paket["setup_fee"] : "").'">
					    </div>
						<div class="col-xs-3">
						<label>Persentase Pembayaran</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="10" required name="dp_policypaket" value="'.(isset($_GET['id']) ? $row_paket["dp_policypaket"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Abonemen VOIP</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="20" id="harga" name="abonemen_voip" value="'.(isset($_GET['id']) ? $row_paket["abonemen_voip"] : "").'">
					    </div>
						<div class="col-xs-3">
						<label>ACC Piutang VOIP</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="20" name="acc_piutang_voip" value="'.(isset($_GET['id']) ? $row_paket["acc_piutang_voip"] : "").'"
						readonly onclick="return valideopenerform(\'data_acc.php?r=form_paket&f=acc_piutang_voip\',\'acc_piutang_voip\');">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Abonemen Video</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="20" id="harga" name="abonemen_video" value="'.(isset($_GET['id']) ? $row_paket["abonemen_video"] : "").'">
					    </div>
						<div class="col-xs-3">
						<label>ACC Piutang VOD</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="20" name="acc_piutang_vod" value="'.(isset($_GET['id']) ? $row_paket["acc_piutang_vod"] : "").'"
						readonly onclick="return valideopenerform(\'data_acc.php?r=form_paket&f=acc_piutang_vod\',\'acc_piutang_vod\');">
					    </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Abonemen Addon</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="20" id="harga" name="abonemen_addon" value="'.(isset($_GET['id']) ? $row_paket["abonemen_addon"] : "").'">
					    </div>
						<div class="col-xs-3">
						<label>ACC Piutang Addon</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="20" name="acc_piutang_addon" value="'.(isset($_GET['id']) ? $row_paket["acc_piutang_addons"] : "").'"
						readonly onclick="return valideopenerform(\'data_acc.php?r=form_paket&f=acc_piutang_addon\',\'acc_piutang_addon\');">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Monthly Fee</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" maxlength="20" id="harga" name="monthly_fee" value="'.(isset($_GET['id']) ? $row_paket["monthly_fee"] : "").'">
					    </div>
					    <div class="col-xs-2">
						<label>PerBulan</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" maxlength="4"  name="monthly_for" value="'.(isset($_GET['id']) ? $row_paket["monthly_for"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC Piutang Internet</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="20"  name="acc_piutang_inet" value="'.(isset($_GET['id']) ? $row_paket["acc_piutang_inet"] : "").'"
						readonly onclick="return valideopenerform(\'data_acc.php?r=form_paket&f=acc_piutang_inet\',\'acc_piutang_inet\');">
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Harga Non-Kontrak</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" maxlength="20" id="harga" name="harga_nonkontrak" value="'.(isset($_GET['id']) ? $row_paket["harga_nonkontrak"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lama Kontrak</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="5"  name="lama_kontrak" value="'.(isset($_GET['id']) ? $row_paket["lama_kontrak"] : "").'">
					    </div>
					    <div class="col-xs-3">Bulan</div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Maintenance Free</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="2" name="maintenance_free" value="'.(isset($_GET['id']) ? $row_paket["maintenance_free"] : "").'">
					   
						SPK Maintenance
					    </div>
					    <div class="col-xs-3">
						<label>Maintenance Fee</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="20" id="harga" name="maintenance_fee" value="'.(isset($_GET['id']) ? $row_paket["maintenance_fee"] : "").'">
						
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Service Perangkat/Bulan</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" maxlength="20" id="harga" name="service_perangkat" value="'.(isset($_GET['id']) ? $row_paket["service_perangkat"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC Piutang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="20"  name="acc_piutang" value="'.(isset($_GET['id']) ? $row_paket["acc_piutang"] : "").'"
						readonly onclick="return valideopenerform(\'data_acc.php?r=form_paket&f=acc_piutang\',\'acc_piutang\');">
					    </div>
					    <div class="col-xs-3">
						<label>ACC Uang Muka</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" maxlength="20" name="acc_um" value="'.(isset($_GET['id']) ? $row_paket["acc_um"] : "").'"
						readonly onclick="return valideopenerform(\'data_acc.php?r=form_paket&f=acc_um\',\'acc_um\');">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Faktur Pajak</label>
					    </div>
					    <div class="col-xs-3">
						<input id="faktur_pajak" type="radio" name="faktur_pajak" value="yes" '.(($selected_pajak == "yes") ? ' checked=""' : "").' /> Yes
					    </div>
					    <div class="col-xs-3">
						<input id="faktur_pajak" type="radio" name="faktur_pajak" value="no" '.(($selected_pajak == "no") ? ' checked=""' : "").' /> No
					    </div>
					    
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Group RBS</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" maxlength="100" required="" name="group_rbs" value="'.(isset($_GET['id']) ? $row_paket["group_rbs"] : "").'"
						readonly onclick="return valideopenerform(\'data_grouprbs.php?r=form_paket&f=group_rbs\',\'acc_um\');">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Account Index RBS</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" maxlength="100" required="" name="account_index" value="'.(isset($_GET['id']) ? $row_paket["account_index"] : "").'"
						readonly onclick="return valideopenerform(\'data_accindexrbs.php?r=form_paket&f=account_index\',\'acc_um\');">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>SLA</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" name="sla_paket" maxlength="4" value="'.(isset($_GET['id']) ? $row_paket["sla_paket"] : "").'"> % 
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Fair Usage</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" name="bandwith_usage" maxlength="10" value="'.(isset($_GET['id']) ? $row_paket["bandwith_usage"] : "").'"> MB
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Bandwidth Upload</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  name="bw_upload" maxlength="10" value="'.(isset($_GET['id']) ? $row_paket["bw_upload"] : "").'"> Mbps
					    </div>
					    
					    <div class="col-xs-3">
						<label>Bandwidth Download</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  name="bw_download" maxlength="10" value="'.(isset($_GET['id']) ? $row_paket["bw_download"] : "").'"> Mbps
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Burst</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" maxlength="10" name="burst" value="'.(isset($_GET['id']) ? $row_paket["burst"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Link yg Dipakai</label>
					    </div>
					    <div class="col-xs-3">
						<input id="link" type="radio" name="link" value="1" '.(($selected_link == "1") ? ' checked=""' : "").' /> Single Link
					    </div>
					    <div class="col-xs-3">
						<input id="link"  type="radio" name="link" value="2" '.(($selected_link == "2") ? ' checked=""' : "").' /> Double Link
					    </div>
					    <div class="col-xs-3">
						<input id="link" type="radio" name="link" value="3" '.(($selected_link == "3") ? ' checked=""' : "").' /> Triple Link
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Backup Backbone</label>
					    </div>
					    <div class="col-xs-6">
						<input type="checkbox"  name="backbone_1" value="telkom" '.(($selected_backbone1 == "telkom") ? ' checked=""' : "").'> TELKOM<br>
						<input type="checkbox"  name="backbone_2" value="indosat" '.(($selected_backbone2 == "indosat") ? ' checked=""' : "").'> INDOSAT<br>
						<input type="checkbox" name="backbone_3" value="lintasarta" '.(($selected_backbone3 == "lintasarta") ? ' checked=""' : "").'> LintasArta<br>
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

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "dd-mm-yyyy"});
				$("#datepicker2").datepicker({format: "dd-mm-yyyy"});
                
            });
	
        </script>
	<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
  prefix: \'\',
  thousandsSeparator: \',\',
  centsLimit: 0
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
	header('location: '.URL_ADMIN.'logout.php');
    }

?>