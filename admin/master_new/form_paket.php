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
if($loggedin = logged_inAdmin())
{ // Check if they are logged in

    if($loggedin["group"] == 'admin')
    {
	global $conn;
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
    $setup_fee          = isset($_POST['setup_fee']) ? mysql_real_escape_string(trim($_POST['setup_fee'])) : '';
    $abonemen_voip      = isset($_POST['abonemen_voip']) ? mysql_real_escape_string(trim($_POST['abonemen_voip'])) : '';
    $abonemen_video     = isset($_POST['abonemen_video']) ? mysql_real_escape_string(trim($_POST['abonemen_video'])) : '';
    $monthly_fee        = isset($_POST['monthly_fee']) ? mysql_real_escape_string(trim($_POST['monthly_fee'])) : '';
    $monthly_for        = isset($_POST['monthly_for']) ? mysql_real_escape_string(trim($_POST['monthly_for'])) : '';
    $maintenance_free   = isset($_POST['maintenance_free']) ? mysql_real_escape_string(trim($_POST['maintenance_free'])) : '';
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
	
    //insert into gxPaket
    $sql_insert = "INSERT INTO `gx_paket2` (`id_paket`, `id_cabang`, `kode_paket`, `nama_paket`,
    `jenis_paket`, `periode_start`, `periode_end`, `internet_type`, `internet_paket`, `voip`, `video`,
    `setup_fee`, `abonemen_voip`, `abonemen_video`, `monthly_fee`, `monthly_for`, `maintenance_free`,
    `acc_piutang`, `acc_um`, `group_rbs`, `account_index`, `bandwith_usage`, `bw_upload`, `bw_download`,
    `backbone_1`, `backbone_2`, `backbone_3`, `sla_paket`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL, '".$id_cabang."', '".$kode_paket."', '".$nama_paket."',
    '".$jenis_paket."', '".$periode_start."', '".$periode_end."', '".$internet_type."', '".$internet_paket."', '".$voip."', '".$video."',
    '".$setup_fee."', '".$abonemen_voip."', '".$abonemen_video."', '".$monthly_fee."', '".$monthly_for."', '".$maintenance_free."',
    '".$acc_piutang."', '".$acc_um."', '".$group_rbs."', '".$account_index."', '".$bandwith_usage."', '".$bw_upload."', '".$bw_download."',
    '".$backbone_1."', '".$backbone_2."', '".$backbone_3."', '".$sla_paket."',
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
    $setup_fee          = isset($_POST['setup_fee']) ? mysql_real_escape_string(trim($_POST['setup_fee'])) : '';
    $abonemen_voip      = isset($_POST['abonemen_voip']) ? mysql_real_escape_string(trim($_POST['abonemen_voip'])) : '';
    $abonemen_video     = isset($_POST['abonemen_video']) ? mysql_real_escape_string(trim($_POST['abonemen_video'])) : '';
    $monthly_fee        = isset($_POST['monthly_fee']) ? mysql_real_escape_string(trim($_POST['monthly_fee'])) : '';
    $monthly_for        = isset($_POST['monthly_for']) ? mysql_real_escape_string(trim($_POST['monthly_for'])) : '';
    $maintenance_free   = isset($_POST['maintenance_free']) ? mysql_real_escape_string(trim($_POST['maintenance_free'])) : '';
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
	
    
    //update gxPaket
    $sql_update = "UPDATE `gx_paket2` SET `id_cabang`='".$id_cabang."', `kode_paket`='".$kode_paket."',
    `nama_paket`='".$nama_paket."', `jenis_paket`='".$jenis_paket."',
    `periode_start`='".$periode_start."', `periode_end`='".$periode_end."', `internet_type`='".$internet_type."',
    `internet_paket`='".$internet_paket."', `voip`='".$voip."', `video`='".$video."', `setup_fee`='".$setup_fee."',
    `abonemen_voip`='".$abonemen_voip."', `abonemen_video`='".$abonemen_video."', `monthly_fee`='".$monthly_fee."',
    `monthly_for`='".$monthly_for."', `maintenance_free`='".$maintenance_free."', `acc_piutang`='".$acc_piutang."',
    `acc_um`='".$acc_um."', `group_rbs`='".$group_rbs."', `account_index`='".$account_index."',
    `bandwith_usage`='".$bandwith_usage."', `bw_upload`='".$bw_upload."', `bw_download`='".$bw_download."',
    `backbone_1`='".$backbone_1."', `backbone_2`='".$backbone_2."', `backbone_3`='".$backbone_3."', `sla_paket`='".$sla_paket."',
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
    $query_paket 	= "SELECT * FROM `gx_paket2` WHERE `id_paket`='".$id_paket."' LIMIT 0,1;";
    
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


    $content ='<section class="content-header">
                    <h1>
                        Form Paket
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
						<label>Kode Paket</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="kode_paket" value="'.(isset($_GET['id']) ? $row_paket["kode_paket"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
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
						<input type="text" class="form-control" name="periode_start" value="'.(isset($_GET['id']) ? $row_paket["periode_start"] : "").'">
					    </div>
					    <div class="col-xs-3">
						sampai
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="periode_end" value="'.(isset($_GET['id']) ? $row_paket["periode_end"] : "").'">
					    </div>
					    
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Internet</label>
					    </div>
					    <div class="col-xs-3">
						<input id="internet_type" type="radio" name="internet_type" value="fo" '.(($selected_internet_type == "fo") ? ' checked=""' : "").' /> Fiber
					    </div>
					    <div class="col-xs-3">
						<input id="internet_type" type="radio" name="internet_type" value="wireless" '.(($selected_internet_type == "wireless") ? ' checked=""' : "").' /> Wireless
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
						<label>VOIP</label>
					    </div>
					    <div class="col-xs-6">
						<input type="checkbox" class="form-control" name="voip" value="voip" '.(($selected_voip == "voip") ? ' checked=""' : "").' />
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Video</label>
					    </div>
					    <div class="col-xs-6">
						<input type="checkbox" class="form-control" name="video" value="video" '.(($selected_video == "video") ? ' checked=""' : "").' />
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Setup Fee</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="setup_fee" value="'.(isset($_GET['id']) ? $row_paket["setup_fee"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Abonemen VOIP</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="abonemen_voip" value="'.(isset($_GET['id']) ? $row_paket["abonemen_voip"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Abonemen Video</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="abonemen_video" value="'.(isset($_GET['id']) ? $row_paket["abonemen_video"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Monthly Fee</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="monthly_fee" value="'.(isset($_GET['id']) ? $row_paket["monthly_fee"] : "").'">
					    </div>
					    <div class="col-xs-2">
						<label>PerBulan</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" name="monthly_for" value="'.(isset($_GET['id']) ? $row_paket["monthly_for"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Maintenance Free</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" name="maintenance_free" value="'.(isset($_GET['id']) ? $row_paket["maintenance_free"] : "").'">
						SPK Maintenance
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC Piutang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="acc_piutang" value="'.(isset($_GET['id']) ? $row_paket["acc_piutang"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>ACC Uang Muka</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="acc_um" value="'.(isset($_GET['id']) ? $row_paket["acc_um"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Group RBS</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="group_rbs" value="'.(isset($_GET['id']) ? $row_paket["group_rbs"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Account Index RBS</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="account_index" value="'.(isset($_GET['id']) ? $row_paket["account_index"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>SLA</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" name="sla_paket" value="'.(isset($_GET['id']) ? $row_paket["sla_paket"] : "").'"> % 
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Bandwidth Usage</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" name="bandwith_usage" value="'.(isset($_GET['id']) ? $row_paket["bandwith_usage"] : "").'"> MB
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Bandwidth Upload</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  name="bw_upload" value="'.(isset($_GET['id']) ? $row_paket["bw_upload"] : "").'"> Mbps
					    </div>
					    
					    <div class="col-xs-3">
						<label>Bandwidth Download</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  name="bw_download" value="'.(isset($_GET['id']) ? $row_paket["bw_download"] : "").'"> Mbps
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Backup Backbone</label>
					    </div>
					    <div class="col-xs-6">
						<input type="checkbox" class="form-control" name="backbone_1" value="telkom" '.(($selected_backbone1 == "telkom") ? ' checked=""' : "").'> TELKOM<br>
						<input type="checkbox" class="form-control" name="backbone_2" value="indosat" '.(($selected_backbone2 == "indosat") ? ' checked=""' : "").'> INDOSAT<br>
						<input type="checkbox" class="form-control" name="backbone_3" value="lintasarta" '.(($selected_backbone3 == "lintasarta") ? ' checked=""' : "").'> LintasArta<br>
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

$plugins = '';
    
    
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