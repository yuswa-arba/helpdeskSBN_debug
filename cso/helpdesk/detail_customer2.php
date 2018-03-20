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
if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open detail Customer");
    global $conn;

	

    $id_customer	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
	$cKode			= $id_customer;
    $query_customer = "SELECT * FROM `tbCustomer` WHERE `cKode`='".$cKode."' AND `level` = '0' LIMIT 0,1;";
    $sql_customer	= mysql_query($query_customer, $conn);
    $row_customer	= mysql_fetch_array($sql_customer);
	
		$sql_voip 		= mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$row_customer["id_cabang"]."' LIMIT 0,1;", $conn);
		$row_voip 		= mysql_fetch_array($sql_voip);
		
	if($row_voip["voip_config"] != "")
	{
		include("../../config/".$row_voip["voip_config"]);
		global $conn_voip;
	}
	
    $query_promosi 	= "SELECT * FROM `gx_duta_promosi` WHERE `kode_customer`='".$cKode."' AND `level` = '0' LIMIT 0,1;";
    $sql_promosi	= mysql_query($query_promosi, $conn);
    $row_promosi	= mysql_fetch_array($sql_promosi);
    
    $query_login 	= "SELECT `username`, `password` FROM `gxLogin` WHERE `customer_number`='".$cKode."' AND `level` = '0' LIMIT 0,1;";
    $sql_login		= mysql_query($query_login, $conn);
    $row_login		= mysql_fetch_array($sql_login);
    
    $query_foto	= "SELECT * FROM `gxFoto_Profile` WHERE `cKode`='".$cKode."' AND `level` = '0' LIMIT 0,1;";
    $sql_foto	= mysql_query($query_foto, $conn);
    $row_foto	= mysql_fetch_array($sql_foto);
    
    $query_foto2= "SELECT * FROM `gx_file_customer` WHERE `id_customer`='".$cKode."' AND `level` = '0' ORDER BY `date_add` DESC LIMIT 0,1;";
    $sql_foto2	= mysql_query($query_foto2, $conn);
    $row_foto2	= mysql_fetch_array($sql_foto2);
    


    $content ='<section class="content-header">
                    <h1>
                        Detail Customer
                        
                    </h1>
                    
                </section>
				
				<!-- Main content -->
                <section class="content">
				
				<div class="row">
				
                        <section class="col-lg-12">
							<div class="row">
								
								<div class="col-xs-3">
									<a href="form_complaint_new.php?id='.(isset($_GET['id']) ? $row_customer["cKode"] : '').'" class="btn btn-block btn-primary pull-right ">Complaint</a>
								</div>
								
							</div><br>
							
                            <div class="box box-solid box-info collapsed-box">
                                <div class="box-header">
                                    <h3 class="box-title">Detail Customer</h3>
									<div class="box-tools pull-right">
                                        <button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                        
                                    </div>
                                </div><!-- /.box-header -->
                                
				    
                                    <div class="box-body" style="display: none;">
									
									<div class="pull-right">
										<span style="font-size:16px;" class="text">Saldo Anda '.Rupiah($row_customer["gx_saldo"]).'</span>
									</div>
									<br>
                                        <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Data Customer</a></li>
                                    <li><a href="#tab_login" data-toggle="tab">Data Login</a></li>
									<li><a href="#tab_inet" data-toggle="tab">Network</a></li>
									<li><a href="#tab_history" data-toggle="tab">Account Statement</a></li>
									<li><a href="#tab_resume" data-toggle="tab">Resume Customer</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
				    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						';
						    
						    $sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$row_customer["id_cabang"]."' AND `level` = '0';", $conn);
						    $row_cabang = mysql_fetch_array($sql_cabang);
						    $content .= $row_cabang["nama_cabang"];
							
						    
						    
$content .='						
					    </div>
					    <div class="col-xs-3">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["cKode"] : '').'
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET['id']) ? $row_customer["cNama"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Perusahaan</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET['id']) ? $row_customer["cNamaPers"] : "").'
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET['id']) ? $row_customer["cAlamat1"] : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kelurahan</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["cArea"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>Kecamatan</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["cDaerah"] : "").'
					    </div>
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kota</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["cKota"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Telpon</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["ctelp"] : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No HP 1</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["cNoHp1"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>No HP 2</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["cNoHp2"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Contact Person</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET['id']) ? $row_customer["cContact"] : "").'
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tanggal Lahir</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? date("Y-m-d", strtotime($row_customer["dTglLahir"])) : "").'
					    </div>
					    
                                        </div>
					</div>
					 <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Email Address</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET['id']) ? $row_customer["cEmail"] : "").'
					    </div>
                                        </div>
					</div>
					 <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Email Address Intern</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET['id']) ? $row_customer["cMailIntern"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>User ID</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["cUserID"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Password</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["cPassword"] : "").'
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Paket</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["cKdPaket"] : "").'
						
					    </div>
					    <div class="col-xs-3">
						<label>Grace</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["nterm"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Paket</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_customer["cPaket"] : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kontrak</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? date("Y-m-d", strtotime($row_customer["dTglMulai"])) : "").'
					    </div>
					    <div class="col-xs-3">
						<label>s/d</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? date("Y-m-d", strtotime($row_customer["dTglBerhenti"])) : date("Y-m-d", strtotime("+ 10 Years"))).'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>PPN</label>
					    </div>
					    <div class="col-xs-9">
						'.((isset($_GET["id"]) && $row_customer["cIncludePPN"]== "1" ) ? 'Include PPN' : "") .'
						'.((isset($_GET["id"]) && $row_customer["cExcludePPN"]== "1" ) ? 'Exclude PPN' : "") .'
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<h3>NPWP</h3>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No NPWP</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET['id']) ? $row_customer["nama_npwp"] : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama NPWP</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET['id']) ? $row_customer["nama_npwp"] : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alamat NPWP</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET['id']) ? $row_customer["alamat_npwp"] : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Ibu Kandung</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET['id']) ? $row_customer["cNamaIbu"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Virtual Account</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET['id']) ? $row_customer["cNoRekVirtual"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Marketing</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_customer["cSales"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No ACC Justifikasi</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_customer["id_acc_justifikasi"] : "").'
					    </div>
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Status</label>
					    </div>
					    <div class="col-xs-9">
						'.((isset($_GET["id"]) && $row_customer["cNonAktiv"]== "0" ) ? "Aktif" : "") .'
						'.((isset($_GET["id"]) && $row_customer["cNonAktiv"]== "1" ) ? "NonAktif" : "") .'
						'.((isset($_GET["id"]) && $row_customer["cNonAktiv"]== "2" ) ? "Proses" : "") .'
					    </div>
                                        </div>
					</div>
					</div><!-- /.tab-pane -->
					
                    <div class="tab-pane" id="tab_voip">
                        <div class="form-group">
							<div class="row">
								<div class="col-xs-4">
									<label>Voip</label>
								</div>
							   
							</div>
						</div>
						
							
                    </div><!-- /.tab-pane -->
					<div class="tab-pane" id="tab_login">
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Username</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_login["username"] : "").'
					    </div>
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Password</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_customer["cPassword"] : "").'
					    </div>
                                        </div>
					</div>
                    </div><!-- /.tab-pane -->
					<div class="tab-pane" id="tab_vod">
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>VOD</label>
					    </div>
					    
                                        </div>
					</div>
                                    
                    </div><!-- /.tab-pane -->
					
					<div class="tab-pane" id="tab_history">
						<div class="form-group">
							<div class="row">
								<div class="col-xs-4">
								<label>Account Statement</label>
								</div>
								
							</div>
						</div>
						<table width="900" border="0" style="border:1px solid #000;" cellpadding="0" cellspacing="0">
        <tbody><tr align="center">
            <th width="100">Date</th>
            <th width="200">Description</th>
            <th width="100">Reference No</th>
            <th width="100">transaction No</th>
            <th width="100">Debit</th>
            <th width="100">Credit</th>
            <th width="100">Balance</th>
        </tr>
	<tr align="center">
	    <td style="border-bottom:1px solid #000 !important;" colspan="7"></td>
	</tr>';
		$customer_number    = isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
        $balance = 0;
		$credit  = 0;
		$debet   = 0;
		$html_data	= "";
		$sql_invoice = mysql_query("SELECT * FROM `gx_invoice`
			       WHERE `customer_number` = '".$customer_number."';", $conn);
    
    //$num_invoice = mysql_num_rows($sql_invoice);
	while($row_invoice = mysql_fetch_array($sql_invoice)){
	    $sql_invoice_detail = mysql_query("SELECT SUM(`harga`) AS `total` FROM `gx_invoice_detail`
					      WHERE `kode_invoice` = '".$row_invoice["kode_invoice"]."';", $conn);
	    $row_invoice_detail = mysql_fetch_array($sql_invoice_detail);
	    $balance = ($balance + ($credit - $row_invoice_detail["total"]));
	    $html_data .='<tr align="left">
		<td>'.date("d F Y").'</td>
		<td>'.$row_invoice["title"].'</td>
		<td>'.$row_invoice["kode_invoice"].'</td>
		<td></td>
		<td>'.number_format($row_invoice_detail["total"], 0, '.', ',').'</td>
		<td></td>
		<td>'.number_format($balance, 0, '.', ',').'</td>
	    </tr>';
	}
	
	$sql_bankmasuk = mysql_query("SELECT * FROM `gx_bank_masuk`
			       WHERE `id_customer` = '".$customer_number."';", $conn);
    
    //$num_invoice = mysql_num_rows($sql_invoice);
	while($row_bankmasuk = mysql_fetch_array($sql_bankmasuk)){
	    $sql_bank_detail = mysql_query("SELECT SUM(`nominal`) AS `total` FROM `gx_bm_detail`
					      WHERE `id_bankmasuk` = '".$row_bankmasuk["id_bankmasuk"]."';", $conn);
	    $row_bank_detail = mysql_fetch_array($sql_bank_detail);
	    $balance = ($balance + ($row_bank_detail["total"] - $debet));
	    $html_data .='<tr align="left">
		<td>'.date("d F Y").'</td>
		<td>'.$row_bankmasuk["remarks"].'</td>
		<td></td>
		<td>'.$row_bankmasuk["transaction_id"].'</td>
		<td></td>
		<td>'.number_format($row_bank_detail["total"], 0, '.', ',').'</td>
		<td>'.number_format($balance, 0, '.', ',').'</td>
	    </tr>';
	}
    $content .='
	'.$html_data.'
	</tbody></table>
                    </div><!-- /.tab-pane -->
					
				    <div class="tab-pane" id="tab_inet">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Longitude</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["cLongi"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>Latitude</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["cLati"] : "").'
					    </div>
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>IP AP</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["ip_ap"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>IP WL</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["ip_wl"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>IP BTS</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["ip_bts"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>Mac Address</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["cMacAdd"] : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>BTS</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["bts"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>Acc Type RBS</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["acc_type_rbs"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>User IP</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["user_ip"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>User Index RBS</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["iuserIndex"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Group RBS</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["cGroupRBS"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>Kode NAS Attribute</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["cKdNAS"] : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>NAS Attribute</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET['id']) ? $row_customer["NASAttribute"] : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>DDNS</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['id']) ? $row_customer["ddns"] : "").'
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.tab-pane -->
				    
				    
				    <div class="tab-pane" id="tab_resume">
                                        <div class="table-responsive">
					    <h4>Resume Customer</h4>
					    <table class="table table-bordered table-striped" style="width: 100%;">
						<tr>
						    <th>No.</th>
						    <th>Kode</th>
						    <th>Tanggal</th>
							<th>Title</th>
						    <th>Status</th>
						    <th>Last Updated by</th>
						    <th>Actions</th>
						</tr>';

$query_survey = mysql_query("SELECT * FROM `gx_survey` WHERE `kode_cust` = '".$cKode."';", $conn);
$no = 1;
while($row_survey = mysql_fetch_array($query_survey))
{
    
    $content .='<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_survey["no_spk_survey"].'</a></td>
		    <td>'.$row_survey["tanggal"].'</td>
		    <td>SPK Survey</td>
		    <td>'.$row_survey["user_upd"].' on '.$row_survey["date_upd"].'</td>
		    <td><a href="'.URL_CSO.'helpdesk/detail_survey.php?id_survey='.$row_survey["id_survey"].'"
		    onclick="return valideopenerform(\''.URL_CSO.'helpdesk/detail_survey.php?id_survey='.$row_survey["id_survey"].'\',\'detail survey\');">Detail</a>
		</tr>';
    $no++;
}

$query_pasang = mysql_query("SELECT * FROM `gx_spk_pasang` WHERE `id_customer` = '".$cKode."';", $conn);
$nos = 1;
while($row_pasang = mysql_fetch_array($query_pasang))
{
    $sql_jawab_pasang = mysql_query("SELECT * FROM `gx_jawab_spkpasang` WHERE `kode_spk` = '".$row_pasang["kode_spk"]."' LIMIT 0,1;", $conn);
    $row_jawabpasang = mysql_fetch_array($sql_jawab_pasang);
    $content .='<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_pasang["kode_spk"].'</a></td>
		    <td>'.$row_pasang["tanggal"].'</td>
			<td>SPK Pasang Baru</td>
		    <td>'.$row_jawabpasang["status"].'</td>
		    <td>'.$row_pasang["user_upd"].' on '.$row_pasang["date_upd"].'</td>
		    <td><a href="'.URL_CSO.'helpdesk/detail_spk_pasang_baru.php?id_spk_pasang_baru='.$row_pasang["id_spkpasang"].'"
		    onclick="return valideopenerform(\''.URL_CSO.'helpdesk/detail_spk_pasang_baru.php?id_spk_pasang_baru='.$row_pasang["id_spkpasang"].'\',\'detail survey\');">Detail</a>
		</tr>';
    $no++;
}


$query_aktivasi = mysql_query("SELECT * FROM `gx_spk_aktivasi` WHERE `id_customer` = '".$cKode."' LIMIT 0,10;", $conn);

while($row_aktivasi = mysql_fetch_array($query_aktivasi))
{
    $sql_jawab_aktivasi = mysql_query("SELECT * FROM `gx_jawab_spkaktivasi` WHERE `kode_spkaktivasi` = '".$row_aktivasi["kode_spkaktivasi"]."' LIMIT 0,1;", $conn);
    $row_jawabaktivasi = mysql_fetch_array($sql_jawab_aktivasi);
    $content .='<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_aktivasi["kode_spkaktivasi"].'</a></td>
		    <td>'.$row_aktivasi["tanggal"].'</td>
			<td>SPK Aktivasi</td>
		    <td>'.$row_jawabaktivasi["status"].'</td>
		    <td>'.$row_aktivasi["user_upd"].' on '.$row_aktivasi["date_upd"].'</td>
		    <td><a href="'.URL_CSO.'helpdesk/detail_spk_aktivasi_baru.php?id='.$row_aktivasi["id_spkaktivasi"].'"
		    onclick="return valideopenerform(\''.URL_CSO.'helpdesk/detail_spk_aktivasi_baru.php?id='.$row_aktivasi["id_spkaktivasi"].'\',\'detail_spk_aktivasi\');">Detail</a>
		</tr>';
    $no++;
}


$content .='
					    </table>
				
					</div>
					
                                    </div><!-- /.tab-pane -->
				    
                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                                    </div><!-- /.box-body -->
				    
                            </div><!-- /.box -->
				';
				

// DATA INTERNET
/*$sql_paket_data = mysql_query("SELECT `gx_paket`.* FROM `gx_paket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_data` = `gx_paket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_data = mysql_fetch_array($sql_paket_data);*/
$conn_soft = Config::getInstanceSoft();
$sql_paket_data = $conn_soft->prepare("SELECT TOP 1 [Users].*, [AccountTypes].[AccountName], [AccountTypes].[AccountDescription]
  FROM [dbo].[Users], [dbo].[AccountTypes]
  WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex]
  AND [Users].[UserIndex] = '".$row_customer["iuserIndex"]."';");

$sql_paket_data->execute();
$row_paket_data = $sql_paket_data->fetch();


//DATA VOIP

$sql_cust_voip = mysql_query("SELECT * FROM  `gx_voip_nomerTelpon` WHERE `customer_number` = '".$id_customer."';", $conn);
$sql_cardid ="";
$status_voip ='';

$jum_cust_voip = mysql_num_rows($sql_cust_voip);
if($jum_cust_voip < 1)
{
	$status_voip .='<div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-phone-square"></i>  Status Voip/Telepon</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        
                                    </div>
                                </div>
				<div class="box-body">
				    <div style="font-size:20px;">Status  <span class="label label-danger">Not Aktif</span></div><br>
				    
				    <br>
				    <br>
				    <br>
				    <br>
				    <br><br>
				    
				    <br><br><br>
			    </div><!-- /.box-body -->
                            </div><!-- /.box -->';
}else{
	

while($row_cust_voip = mysql_fetch_array($sql_cust_voip))
{
	$sql_voip = mysql_query("SELECT `id` FROM  `cc_card` WHERE `useralias` LIKE '%".$row_cust_voip["nomer_telpon"]."%';", $conn_voip);
	$row_voip = mysql_fetch_array($sql_voip);
	$view_id = $row_voip["id"];
	$sql_cardid .= " `card_id` = '".$view_id."' OR";
	
	$sql_saldo = mysql_query("SELECT `credit`, `useralias`, `expirationdate`, `status` FROM `cc_card` WHERE `useralias`  LIKE '%".$row_cust_voip["nomer_telpon"]."%' LIMIT 0,1;", $conn_voip);
	$row_saldo = mysql_fetch_array($sql_saldo);
	
	$status_voip .='<div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-phone-square"></i>  Status Voip/Telepon</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        
                                    </div>
                                </div>
				<div class="box-body">
				    <div style="font-size:20px;">Status  '.(($row_saldo["status"] == "1") ? '<span class="label label-success">'.ucfirst( StatusVOIP($row_saldo["status"])).'</span>' : '<span class="label label-danger">'.ucfirst(StatusVOIP($row_saldo["status"])).'</span>').'</div><br>
				    
				    Nomer Telpon : <b>'.$row_saldo["useralias"].'</b><br>
				    Saldo : <b>'.Rupiah((int)$row_saldo["credit"]).'</b><br>
				    Nama Paket :  <b>ABONEMEN</b><br>
				    Expired Paket:  <b></b><br>
				    Monthly fee:  <b></b><br><br>
				    
				    <br><br><br>
			    </div><!-- /.box-body -->
                            </div><!-- /.box -->';
	
}

}
$sql_cardid = substr($sql_cardid, 0, -2);

$query_callhistory = "SELECT t1.starttime, t1.src, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0 
                    AND `starttime`
					AND ($sql_cardid)
		    ORDER BY `starttime` DESC
		    LIMIT 0,4;";

	$sql_callhistory = mysql_query($query_callhistory, $conn_voip);


//DATA VIDEO


/*<div class="box-body">
				    <div style="font-size:20px;">Status  '.(($row_paket_voip["level"] == "0") ? "<span class=\"label label-success\">Active</span>" : "<span class=\"label label-danger\">Not Active</span>").'</div><br>
				    
				    Nomer Telpon : <b>'.$row_saldo["useralias"].'</b><br>
				    Saldo : <b>'.Rupiah((int)$row_saldo["credit"]).'</b><br>
                                    Nama Paket : '.(($row_paket_voip["nama_paket"] == "") ? "-" : $row_paket_voip["nama_paket"]).'<br>
				    Expired Paket: '.(($row_paket_voip["periode_paket"] == "") ? "-" : ($row_paket_voip["periode_paket"]/24)).' Hari<br>
				    Monthly fee: '.(($row_paket_voip["harga_paket"] == "" OR $row_paket_voip["harga_paket"] == "0") ? "-" : Rupiah($row_paket_voip["harga_paket"])).'<br><br>
				    
				    <br><br>
                                </div><!-- /.box-body -->*/

$content .='                                        
                                   
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-4 connectedSortable">                            
			    <div class="box box-solid box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-bar-chart-o"></i>  Status Data/Internet</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div style="font-size:20px;">Status  '.(($row_paket_data["UserActive"] == "1") ? "<span class=\"label label-success\">Active</span>" : "<span class=\"label label-danger\">Not Active</span>").'</div><br>
				    
				    Nama Paket : <b>'.(($row_paket_data["AccountDescription"] == "") ? "-" : $row_paket_data["AccountDescription"]).'</b><br>
				    Time Remaining: <b>'.(($row_paket_data["UserTimeBank"] == "") ? "-" : $row_paket_data["UserTimeBank"]).'</b><br>
				    Volume Based Remaining: <b>'.(($row_paket_data["UserKBBank"] == "") ? "-" :  number_format( ($row_paket_data["UserKBBank"]/1024/1024) , 2 , ',' , '.' ).' MB').'</b><br><br>
				    Periode: <b>'.(($row_paket_data["UserActive"] == "1") ? "3-".(date("M-Y", mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"))))." - "."3-".(date("M-Y", mktime(date("H"), date("i"), date("s"), (date("m")+1), date("d"), date("Y")))) : "Expire Date").'</b><br>
					IP Address: <b>'.long2ip($row_paket_data["UserIP"]).'</b><br>
					Topologi: <b>Link</b>
				    <br><br><br>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
                            <!-- List History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Invoice</h3>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Invoice</th>
                                            <th>Date</th>
                                            <th style="width: 40px">Status</th>
                                        </tr>';

$conn_soft2 = Config::getInstanceSoft();
$sql_invoice_data = $conn_soft2->prepare("SELECT TOP 5 [tbJual].*
  FROM [dbo].[tbJual]
  WHERE [tbJual].[cKode] = '".$row_customer["cKode"]."' ORDER BY [tbJual].[dtanggal] DESC;");

$sql_invoice_data->execute();



$no = 1;
while ($row_invoice_data = $sql_invoice_data->fetch()){
    
$content .='
<tr> 
    <td>'.$no.'</td>
    <td><a href="" onclick="return valideopenerform(\''.URL_CSO.'administrasi/detail_invoice_data.php?id='.$row_invoice_data["cNoJual"].'\',\'invoice_data'.$row_invoice_data["cNoJual"].'\');">'.$row_invoice_data["cNoJual"].'</a></td>
    <td>'.date("d-m-Y", strtotime($row_invoice_data["dtanggal"])).'</td>
    <td><span class="label bg-green">Paid</span></td>
</tr>
';
$no++;
}


$content .='
                                        
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
							<!-- List History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Complaint History</h3>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th style="width: 40px">Status</th>
                                        </tr>';

	
$query_complaint = "SELECT * FROM `gx_helpdesk_complaint` WHERE `cust_number` = '".$id_customer."' ORDER BY `date_upd` DESC LIMIT 0,4;";
//echo $query_complaint;
$sql_complaint = mysql_query($query_complaint, $conn);

$no = 1;
while ($row_complaint = mysql_fetch_array($sql_complaint)){
    
$content .='
<tr> 
    <td>'.$no.'</td>
    <td><a href="" onclick="return valideopenerform(\''.URL_CSO.'helpdesk/detail_incoming.php?id_complaint='.$row_complaint["id_complaint"].'\',\'complaint'.$row_complaint["id_complaint"].'\');">'.$row_complaint["problem"].'</a></td>
    <td>'.date("d-m-Y", strtotime($row_complaint["date_upd"])).'</td>
    <td>'.$row_complaint["status"].'</td>
</tr>
';
$no++;
}


$content .='
                                        
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </section><!-- /.Left col -->
                        
                        <section class="col-lg-4 connectedSortable">
			    '.$status_voip.'
			    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Invoice</h3>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tbody><tr>
                                            <th>#</th>
                                            <th>Kode Invoice</th>
                                            <th>Date</th>
                                            <th style="width: 40px">Status</th>
                                        </tr>
                                        
                                    </tbody></table>
                                </div><!-- /.box-body -->
                            </div>
							<!-- List History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Kwitansi</h3>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th style="width: 40px">Status</th>
                                        </tr>';
if($jum_cust_voip >= 1)
{
	$sql_cust_voip = mysql_query("SELECT * FROM  `gx_voip_nomerTelpon` WHERE `customer_number` = '".$id_customer."';", $conn);
	$sql_cardid = '';
	while($row_cust_voip = mysql_fetch_array($sql_cust_voip))
	{
		$sql_voip = mysql_query("SELECT `id` FROM  `cc_card` WHERE `useralias` LIKE '%".$row_cust_voip["nomer_telpon"]."%';", $conn_voip);
		$row_voip = mysql_fetch_array($sql_voip);
		$view_id = $row_voip["id"];
		$sql_cardid .= " `cc_invoice`.`id_card` = '".$view_id."' OR";
		
		
	}
	$sql_cardid = substr($sql_cardid, 0, -2);
	//invoice mya2billing
	$sql_invoice_voip = "SELECT `cc_invoice`.*, `cc_card`.`username`, `cc_card`.`firstname`, `cc_card`.`lastname`
					  FROM `cc_invoice`, `cc_card`
					  WHERE `cc_invoice`.`id_card` = `cc_card`.`id`
					  AND ($sql_cardid)
					  ORDER BY `cc_invoice`.`id` DESC;";
	//				  echo $sql_invoice;
	$query_invoice_voip = mysql_query($sql_invoice_voip, $conn_voip);
	
	$noi = 1;
	while ($row_invoice_voip = mysql_fetch_array($query_invoice_voip))
	{
		
		$content .= '<tr>
				<td>'.$noi.'.</td>
				<td><a href="" onclick="return valideopenerform(\''.URL_CSO.'helpdesk/detail_vinvoice?id='.$id_customer.'&inv='.$row_invoice_voip["id"].'\',\'invoice_voip'.$row_invoice_voip["id"].'\');">'.$row_invoice_voip["reference"].'</a></td>
				<td>'.date("d-m-Y", strtotime($row_invoice_voip["date"])).'</td>
				<td><span class="label label-success">Paid</span></td>
			</tr>';
			$noi++;
	}
	
}
$content .= '
                                        
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
							
							<!-- List History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Call History</h3>
                                    <div class="box-tools pull-right">
                                        <a href="'.URL_CSO.'voip/call_history.php?id='.$id_customer.'">View All</a>
                                        
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Destination</th>
                                            <th>Duration</th>
                                            <th>Rate</th>
                                        </tr>';
if($jum_cust_voip >= 1)
{
	$no = 1;
	while ($row_callhistory = mysql_fetch_array($sql_callhistory)){
		
	$content .='
	<tr> 
		<td>'.$no.'</td>
		<td>'.$row_callhistory["calledstation"].'</td>
		<td>'.gmdate("H:i:s", $row_callhistory["sessiontime"]).'</td>
		<td>'.Rupiah((int)$row_callhistory["sessionbill"]).'</td>
	</tr>
	';
	$no++;
	}
}
$content .='
                                        
					
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
							
                        </section><!-- right col -->
			
			<section class="col-lg-4 connectedSortable">
			    <div class="box box-solid box-warning">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-laptop"></i>  Status Video/VOD</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-warning btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        
                                    </div>
                                </div>
                                <div class="box-body">';
                                    $status_vod = 'OFF';
				    $content .= '<div style="font-size:20px;">Status  '.(($status_vod != "OFF") ? "<span class=\"label label-success\">Active</span>" : "<span class=\"label label-danger\">Not Active</span>").'</div><br>
				   <br><br>
				    
				    <button class="btn btn-default"  title="sign up" onclick="window.location.href=\'vod/paket.php\'">Sign up</button>
					<br><br><br><br><br>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Invoice</h3>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tbody><tr>
                                            <th>#</th>
                                            <th>Kode Invoice</th>
                                            <th>Date</th>
                                            <th style="width: 40px">Status</th>
                                        </tr>
                                        
                                    </tbody></table>
                                </div><!-- /.box-body -->
                            </div>
							<!-- List History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Last Movie Seen</h3>
				    <div class="box-tools">
                                        
                                    </div>
                                </div><!-- /.box-header -->
								
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th>Title</th>
                                            <th>Date</th>
					    <th></th>
                                        </tr>';
//$sql_history_movie = mysql_query("");
$content .='                                        
					
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			</section>
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            ';

$plugins = '';

	$title		= 'Detail Customer';
    $submenu	= "helpdesk_customer";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

    } else{
		header("location: ".URL_CSO."logout.php");
    }