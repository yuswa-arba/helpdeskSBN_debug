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
                                    <h3 class="box-title">Detail Paket</h3>
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
						';

$sql_gxCabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$row_paket["id_cabang"]."' ORDER BY `nama_cabang` ASC", $conn);
$row_gxcabang = mysql_fetch_array($sql_gxCabang);
    $content .= $row_gxcabang["nama_cabang"];
    
						
						
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
						'.(isset($_GET['id']) ? $row_paket["kode_paket"] : "").'
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Paket</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_paket["nama_paket"] : "").'
						'.(isset($_GET['id']) ? '<input type="hidden" name="id_paket" value="'.$id_paket.'">' : "").'
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Jenis Paket</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_paket["jenis_paket"] : "").'
					    </div>
					    
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Periode Paket</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_paket["periode_start"] : "").' s/d '.(isset($_GET['id']) ? $row_paket["periode_end"] : "").'
					    </div>
					    
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Internet</label>
					    </div>
					    <div class="col-xs-6">
						'.$selected_internet_type.'
					    </div>
					    
					    
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						
					    </div>
					    <div class="col-xs-6">
						'.$selected_internet_paket.'
					    </div>
					    
					    
                                        </div>
					</div>
                                        
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>VOIP</label>
					    </div>
					    <div class="col-xs-6">
						<input type="checkbox" class="form-control" name="voip" value="voip" '.(($selected_voip == "voip") ? ' checked=""' : "").' disabled="" />
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Video</label>
					    </div>
					    <div class="col-xs-6">
						<input type="checkbox" class="form-control" name="video" value="video" '.(($selected_video == "video") ? ' checked=""' : "").' disabled="" />
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Setup Fee</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? Rupiah($row_paket["setup_fee"]) : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Abonemen VOIP</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? Rupiah($row_paket["abonemen_voip"]) : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Abonemen Video</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? Rupiah($row_paket["abonemen_video"]) : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Monthly Fee</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['id']) ? Rupiah($row_paket["monthly_fee"]) : "").'
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['id']) ? $row_paket["monthly_for"] : "").' Perbulan
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Maintenance Free</label>
					    </div>
					    <div class="col-xs-2">
						'.(isset($_GET['id']) ? $row_paket["maintenance_free"] : "").' SPK Maintenance
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC Piutang</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_paket["acc_piutang"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>ACC Uang Muka</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_paket["acc_um"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Group RBS</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_paket["group_rbs"] : "").'
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Account Index RBS</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_paket["account_index"] : "").'
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>SLA</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_paket["sla_paket"] : "").' %
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Bandwidth Usage</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_paket["bandwith_usage"] : "").' MB
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Bandwidth Upload</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_paket["bw_upload"] : "").' Mbps
					    </div>
					    
					    <div class="col-xs-3">
						<label>Bandwidth Download</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_paket["bw_download"] : "").' Mbps
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Backup Backbone</label>
					    </div>
					    <div class="col-xs-6">
						<input type="checkbox" class="form-control" name="backbone_1" value="telkom" '.(($selected_backbone1 == "telkom") ? ' checked=""' : "").' disabled=""> TELKOM<br>
						<input type="checkbox" class="form-control" name="backbone_2" value="indosat" '.(($selected_backbone2 == "indosat") ? ' checked=""' : "").' disabled=""> INDOSAT<br>
						<input type="checkbox" class="form-control" name="backbone_3" value="lintasarta" '.(($selected_backbone3 == "lintasarta") ? ' checked=""' : "").' disabled=""> LintasArta<br>
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

                                   
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';
    
    
    $title	= 'Detail Paket';
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