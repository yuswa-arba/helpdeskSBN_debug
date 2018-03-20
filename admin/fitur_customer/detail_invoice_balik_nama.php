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
$table_main = "gx_balik_nama";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_invoice_balik_nama` WHERE `level` =  '0' ".$urutan." LIMIT 0,1";

//INSERT 

//UPDATE
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail Invoice Balik Nama";
    $judul_table = "detail invoice balik nama";
    
    //id web
    $title_header = 'Detail Invoice Balik Nama';
    $submenu_header = 'detail_invoice_balik_nama';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Invoice Balik Nama");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_invoice_balik_nama` WHERE `kode_invoice`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
	$nama_pelanggan			= $data_d['nama_pelanggan'];
	$periode_tagihan		= $data_d['periode_tagihan'];
	$kode_customer			= $data_d['kode_customer'];
	$tanggal_tagihan		= $data_d['tanggal_tagihan'];
	$kode_invoice			= $data_d['kode_invoice'];
	$tanggal_jatuh_tempo		= $data_d['tanggal_jatuh_tempo'];
	$npwp				= $data_d['npwp'];
	$no_virtual_account_bca		= $data_d['no_virtual_account_bca'];
	$no_faktur_pajak		= $data_d['no_faktur_pajak'];
	$nama_virtual_account		= $data_d['nama_virtual_account'];
	$note				= $data_d['note'];
	$invoice_change_name		= $data_d['invoice_change_name'];
	$invoice_total			= $data_d['invoice_total'];
	$invoice_ppn			= $data_d['invoice_ppn'];
	$invoice_grand_total		= $data_d['invoice_grand_total'];
	$invoice_uang_muka		= $data_d['invoice_uang_muka'];
	$invoice_sisa			= $data_d['invoice_sisa'];
	$date_add			= $data_d['date_add'];
	$date_update			= $data_d['date_upd'];
	$level				= $data_d['level'];
	$user_add			= $data_d['user_add'];
	$user_update			= $data_d['user_upd'];


  

$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> '.$judul_form.'
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		     

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">'.$judul_table.'</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Pelanggan</label>
					    </div>
					    <div class="col-xs-9">
						'.$nama_pelanggan.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Periode Tagihan</label>
					    </div>
					    <div class="col-xs-9">
						'.$periode_tagihan.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_customer.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tanggal Tagihan</label>
					    </div>
					    <div class="col-xs-9">
						'.$tanggal_tagihan.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Invoice</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_invoice.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tanggal Jatuh Tempo</label>
					    </div>
					    <div class="col-xs-9">
						'.$tanggal_jatuh_tempo.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>NPWP</label>
					    </div>
					    <div class="col-xs-9">
						'.$npwp.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Virtual Account BCA</label>
					    </div>
					    <div class="col-xs-9">
						'.$no_virtual_account_bca.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Faktur Pajak</label>
					    </div>
					    <div class="col-xs-9">
						'.$no_faktur_pajak.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Virtual Account</label>
					    </div>
					    <div class="col-xs-9">
						'.$nama_virtual_account.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Note</label>
					    </div>
					    <div class="col-xs-9">
						'.$note.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Invoice Change Name</label>
					    </div>
					    <div class="col-xs-9">
						Rp. '.$invoice_change_name.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Invoice Total</label>
					    </div>
					    <div class="col-xs-9">
						Rp. '.$invoice_total.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Invoice PPN 10%</label>
					    </div>
					    <div class="col-xs-9">
						Rp. '.$invoice_ppn.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Invoice Grand Total</label>
					    </div>
					    <div class="col-xs-9">
						Rp. '.$invoice_grand_total.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Invoice Uang Muka</label>
					    </div>
					    <div class="col-xs-9">
						Rp. '.$invoice_uang_muka.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Invoice Sisa</label>
					    </div>
					    <div class="col-xs-9">
						Rp. '.$invoice_sisa.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>User Add</label>
					    </div>
					    <div class="col-xs-9">
						'.$user_add.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>User Update</label>
					    </div>
					    <div class="col-xs-9">
						'.$user_update.'
					    </div>
					    
                                        </div>
				    </div>



</div>
            </div>
	   
       </div>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= $title_header;
    $submenu	= $submenu_header;
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>