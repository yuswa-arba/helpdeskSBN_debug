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
$table_main = "gx_jawaban_spk_bongkar";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_jawaban_spk_bongkar` WHERE `level` =  '0'";

//INSERT 

//UPDATE
    //$sql_update_lock 
    $table_update_lock = "gx_jawaban_spk_bongkar";
    $redirect_action_lock = "master_jawaban_spk_bongkar.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail Jawaban SPK Bongkar";
    $judul_table = "detail jawaban spk bongkar";
    
    //id web
    $title_header = 'Detail Jawaban SPK Bongkar';
    $submenu_header = 'detail_jawaban_spk_bongkar';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Jawaban SPK Bongkar");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_jawaban_spk_bongkar` WHERE `kode_jawaban_spk_bongkar`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
    //`kode_cabang`, `nama_cabang`, `tanggal`, `kode_inactive`,
    //`kode_customer`, `nama_customer`, `user_id`, `remarks`, `kode_cso`, `request`,
    //`foto_email`, `no_formulir`
    
    /*
     *SELECT `id`, `no_spk_bongkar`, `tanggal`, `kode_jawaban_spk_bongkar`, `kode_customer`, `nama_customer`, `kode_cabang`, `cabang`, `user_id`, `telp`, `alamat`, `kode_teknisi_1`, `teknisi_1`, `kode_teknisi_2`, `teknisi_2`, `kode_teknsi_3`, `teknisi_3`, `kode_teknisi_4`, `teknisi_4`, `kode_teknisi_5`, `teknisi_5`, `status_spk`, `pekerjaan`, `solusi`, `kode_list_alat`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_jawaban_spk_bongkar` WHERE 1
     */
	
	
	
	
	
	
	
	
	
	
	
	
	$user_upd 			= $data_d['user_upd'];
	$user_add 			= $data_d['user_add'];
	$date_upd 			= $data_d['date_upd'];
	$date_add 			= $data_d['date_add'];
	$status 			= $data_d['status'];
	$kode_list_alat 		= $data_d['kode_list_alat'];
	$solusi 			= $data_d['solusi'];
	$pekerjaan 			= $data_d['pekerjaan'];
	$status_spk 			= $data_d['status_spk'];
	$teknisi_5 			= $data_d['teknisi_5'];
	$kode_teknisi_5 		= $data_d['kode_teknisi_5'];
	$teknisi_4 			= $data_d['teknisi_4'];
	$kode_teknisi_4 		= $data_d['kode_teknisi_4'];
	$teknisi_3 			= $data_d['teknisi_3'];
	$kode_teknisi_3 			= $data_d['kode_teknsi_3'];
	$teknisi_2 			= $data_d['teknisi_2'];
	$kode_teknisi_2 		= $data_d['kode_teknisi_2'];
	$teknisi_1 			= $data_d['teknisi_1'];
	$kode_teknisi_1 		= $data_d['kode_teknisi_1'];
	$alamat 			= $data_d['alamat'];
	$telp 				= $data_d['telp'];
	$user_id 			= $data_d['user_id'];
	$cabang 			= $data_d['cabang'];
	$kode_cabang 			= $data_d['kode_cabang'];
	$nama_customer 			= $data_d['nama_customer'];
	$kode_customer 			= $data_d['kode_customer'];
	$kode_jawaban_spk_bongkar 	= $data_d['kode_jawaban_spk_bongkar'];
	$tanggal 			= $data_d['tanggal'];
	$no_spk_bongkar 		= $data_d['no_spk_bongkar'];
	

  

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
						<label>No SPK Bongkar</label>
					    </div>
					    <div class="col-xs-9">
						'.$no_spk_bongkar.'
					    </div>    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-9">
						'.$tanggal.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Jawaban SPK Bongkar</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_jawaban_spk_bongkar.'
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
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-9">
						'.$nama_customer.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Cabang</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_cabang.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-9">
						'.$cabang.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>User ID</label>
					    </div>
					    <div class="col-xs-9">
						'.$user_id.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Telp</label>
					    </div>
					    <div class="col-xs-9">
						'.$telp.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-9">
						'.$alamat.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Teknisi 1</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_teknisi_1.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Teknisi 1</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_teknisi_1.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Teknisi 1</label>
					    </div>
					    <div class="col-xs-9">
						'.$teknisi_1.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Teknisi 2</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_teknisi_2.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Teknisi 2</label>
					    </div>
					    <div class="col-xs-9">
						'.$teknisi_2.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Teknisi 3</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_teknisi_3.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Teknisi 3</label>
					    </div>
					    <div class="col-xs-9">
						'.$teknisi_3.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Teknisi 4</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_teknisi_4.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Teknisi 4</label>
					    </div>
					    <div class="col-xs-9">
						'.$teknisi_4.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Teknisi 5</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_teknisi_5.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Teknisi 5</label>
					    </div>
					    <div class="col-xs-9">
						'.$teknisi_5.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Status SPK</label>
					    </div>
					    <div class="col-xs-9">
						'.$status_spk.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Pekerjaan</label>
					    </div>
					    <div class="col-xs-9">
						'.$pekerjaan.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Solusi</label>
					    </div>
					    <div class="col-xs-9">
						'.$solusi.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode List Alat</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_list_alat.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <!--				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Foto Email</label>
					    </div>
					    <div class="col-xs-9">';


$content .= '					    </div>
					    
                                        </div>
				    </div>
				    -->				    

				    				    
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