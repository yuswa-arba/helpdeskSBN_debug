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
$table_main = "gx_recycle_blank_form";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_recycle_blank_form` WHERE `level` =  '0'";

//INSERT 

//UPDATE
    //$sql_update_lock 
    $table_update_lock = "gx_recycle_blank_form";
    $redirect_action_lock = "master_formulir.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail formulir";
    $judul_table = "detail formulir";
    
    //id web
    $title_header = 'Detail Formulir';
    $submenu_header = 'detail_formulir';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Detail Formulir");
    global $conn;
   // $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_recycle_blank_form` WHERE `kode_recycle`='$c_d' LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
	$kode_recycle 			= $data_d['kode_recycle'];
	$nama_recycle			= $data_d['nama_recycle'];
	$kode_formulir			= $data_d['kode_formulir'];
	$alasan				= $data_d['alasan'];
	$printer_rusak			= $data_d['printer_rusak'];
	$form_tidak_kembali		= $data_d['form_tidak_kembali'];
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
						<label>Kode Recycle</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_recycle.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Recycle</label>
					    </div>
					    <div class="col-xs-9">
						'.$nama_recycle.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Formulir</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_formulir.'
					    </div>
					    
                                        </div>
				    </div>
<!--
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alasan</label>
					    </div>
					    <div class="col-xs-9">
						'.$alasan.'
					    </div>
					    
                                        </div>
				    </div>
-->
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Printer Rusak</label>
					    </div>
					    <div class="col-xs-9">
						'.$printer_rusak.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Form tidak kembali</label>
					    </div>
					    <div class="col-xs-9">
						'.$form_tidak_kembali.'
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
						'.$date_update.'
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