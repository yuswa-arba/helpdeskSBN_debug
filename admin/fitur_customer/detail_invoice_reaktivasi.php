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
$target_path 	= "../upload/email/";     // Declaring Path for uploaded images.

redirectToHTTPS();
if($loggedin = logged_inAdmin()){
// Check if they are logged in
 
//SQL 
$table_main = "gx_invoice_reaktivasi_customer";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_invoice_reaktivasi_customer` WHERE `level` =  '0'";

//INSERT


//UPDATE
    //$sql_update_lock 
    $table_update_lock = "gx_invoice_reaktivasi_customer";
    $redirect_action_lock = "master_invoice_reaktivasi.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail Invoice Reaktivasi";
    $judul_table = "detail reaktivasi";
    
    //id web
    $title_header = 'Detail Invoice Reaktivasi';
    $submenu_header = 'detail_invoice_reaktivasi';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Invoice Reaktivasi");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_invoice_reaktivasi_customer` WHERE `kode_invoice`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    

   $nama_pelanggan			= $data_d['nama_pelanggan'];
   $kode_customer			= $data_d['kode_customer'];
   $periode_tagihan			= $data_d['periode_tagihan'];
   $tanggal_tagihan			= $data_d['tanggal_tagihan'];
   $kode_invoice			= $data_d['kode_invoice'];
   $tanggal_jatuh_tempo			= $data_d['tanggal_jatuh_tempo'];
   $npwp			= $data_d['npwp'];
   $no_virtual_account_bca			= $data_d['no_virtual_account_bca'];
   $nama_virtual_account			= $data_d['nama_virtual_account'];
   $no_faktur_pajak			= $data_d['no_faktur_pajak'];
   $note			= $data_d['note'];
   $reaktivasi_invoice			= $data_d['reaktivasi_invoice'];
   $total_invoice			= $data_d['total_invoice'];
   $ppn_invoice			= $data_d['ppn_invoice'];
   $grand_total_invoice			= $data_d['grand_total_invoice'];
   $uang_muka_invoice			= $data_d['uang_muka_invoice'];
   $sisa_invoice			= $data_d['sisa_invoice'];
   $prepared_by			= $data_d['prepared_by'];
   $printed_by			= $data_d['printed_by'];
   
   $date_add			= $data_d['date_add'];
   $date_upd			= $data_d['date_upd'];
   $user_add			= $data_d['user_add'];
   $user_upd			= $data_d['user_upd'];
	
	




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
						<label>Kode Invoice Reaktivasi</label>
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
						<label>No Inactive</label>
					    </div>
					    <div class="col-xs-9">
						'.$no_virtual_account_bca.'
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
						<label>Invoice Reaktivasi</label>
					    </div>
					    <div class="col-xs-9">
						'.$reaktivasi_invoice.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Invoice Total</label>
					    </div>
					    <div class="col-xs-9">
						'.$total_invoice.'
					    </div>
					    
                                        </div>
				    </div>
			   
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Invoice PPN</label>
					    </div>
					    <div class="col-xs-9">
						'.$ppn_invoice.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Invoice Grand Total</label>
					    </div>
					    <div class="col-xs-9">
						'.$grand_total_invoice.'
					    </div>
					    
                                        </div>
				    </div>
				   
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Invoice Uang Muka</label>
					    </div>
					    <div class="col-xs-9">
						'.$uang_muka_invoice.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Sisa Invoice</label>
					    </div>
					    <div class="col-xs-9">
						'.$sisa_invoice.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Prepared By</label>
					    </div>
					    <div class="col-xs-9">
						'.$prepared_by.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Printed By</label>
					    </div>
					    <div class="col-xs-9">
						'.$printed_by.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Date Add</label>
					    </div>
					    <div class="col-xs-9">
						'.$date_add.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Date Update</label>
					    </div>
					    <div class="col-xs-9">
						'.$date_upd.'
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
						'.$user_upd.'
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