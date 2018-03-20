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
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Jawaban SPK Aktivasi");
    global $conn;
    global $conn_voip;
    

 //echo date("Y-m-d H:i:s");   
	    if(isset($_GET['id'])){
		$get_id = isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
		$data_jawaban_spk_aktivasi_baru = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spkaktivasi` WHERE `id_jawab_spkaktivasi`='$get_id'", $conn));
		$data_jawaban_spk_aktivasi_baru_teknisi = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$data_jawaban_spk_aktivasi_baru[id_teknisi]'", $conn));
		$data_jawaban_spk_aktivasi_baru_marketing = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$data_jawaban_spk_aktivasi_baru[id_marketing]'", $conn));
		$data_cabang = mysql_fetch_array(mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang`='$data_jawaban_spk_aktivasi_baru[id_cabang]'", $conn));
    }
    
    $sql_parent = mysql_query("SELECT * FROM `gx_email_kategori` ORDER BY `id_kategori` DESC;",$conn);
    $content = '
		<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
				<form action="" role="form" name="myForm"  method="POST" >
			       
				<div >
				  <fieldset>
				  <legend>Data Jawab SPK Aktivasi Baru</legend>
				    <div class="table-container table-form">
		    
				      <div class="box-body">
				      <div class="col-xs-12">
					<div class="form-group">
					<div class="row">
					  <div class="col-xs-2">
					    <label>No. SPK Aktivasi Baru</label>
					  </div>
					  <div class="col-xs-4">
					    '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['kode_spkaktivasi'] : "" ) .'
					  </div>
					  <div class="col-xs-2">
					    <label>Tanggal</label>
					  </div>
					  <div class="col-xs-4">
					    '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['tanggal'] : "" ) .'
					  </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['id']) ? $data_cabang['nama_cabang'] :"") .'
					    </div>
					    <div class="col-xs-2">
						 <label>No. Jawab SPK Aktivasi</label>
					    </div>
					    <div class="col-xs-4">
						 '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['kode_jawab_aktivasi'] : "") .'
					    </div>
                                        </div>
					</div>
			
					<div class="form-group">
					<div class="row">
					   <div class="col-xs-2">
					     <label>Kode Customer</label>
					   </div>
					   <div class="col-xs-4">
					     '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['id_customer'] :"") .'
					   </div>
					   <div class="col-xs-2">
					     <label>Nama Customer</label>
					   </div>
					   <div class="col-xs-4">
					     '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['nama_customer'] : "") .'
					   </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					   <div class="col-xs-2">
					      <label>No. Link Budget</label>
					   </div>
					   <div class="col-xs-4">
					      '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['id_linkbudget'] :"") .'
					   </div>
                                        </div>
					</div> 
					
					<div class="form-group">
					<div class="row">
					   <div class="col-xs-2">
					      <label>Paket Koneksi</label>
					   </div>
					   <div class="col-xs-4">
					      '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['paket_koneksi'] :"") .'
					   </div>
					   <div class="col-xs-2">
					      <label>Nama Koneksi</label>
					   </div>
					   <div class="col-xs-4">
					      '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['nama_koneksi'] :"") .'
					   </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					     <div class="col-xs-2">
					       <label>User ID</label>
					     </div>
					     <div class="col-xs-4">
					       '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['user_id'] :"") .'
					     </div>
					     <div class="col-xs-2">
					       <label>Telp</label>
					     </div>
					     <div class="col-xs-4">
					       '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['telpon'] :"") .'
					     </div>
					</div>
					</div>
	
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					       <label>Alamat</label>
					    </div>
					    <div class="col-xs-10">
					       '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['alamat'] :"") .'
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Teknisi 1</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru_teknisi['cNama'] :"") .'
					    </div>
					    <div class="col-xs-2">
						 <label>Marketing</label>
					    </div>
					    <div class="col-xs-4">
						 '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru_marketing['cNama'] :"").'
					    </div>
					</div>
					</div>
	
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					       <label>Teknisi 2</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru_teknisi['id_teknisi2'] :"") .'
					    </div>
					    <div class="col-xs-2">
					       <label>Teknisi 4</label>
					    </div>
					    <div class="col-xs-4">
					       '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru_teknisi['id_teknisi4'] :"") .'
					    </div>
					</div>
					</div> 
			
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Teknisi 3</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru_teknisi['id_teknisi3'] :"") .'
					    </div>
					    <div class="col-xs-2">
						<label>Teknisi 5</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru_teknisi['id_teknisi5'] :"") .'
					    </div>
					</div>
					</div>
			   
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Status</label>
					    </div>
					    <div class="col-xs-10">
					      '.(isset($_GET['id']) ? ($data_jawaban_spk_aktivasi_baru['status'] == 'cleared' ? "clear" : "" ) :"") .'
					      '.(isset($_GET['id']) ? ($data_jawaban_spk_aktivasi_baru['status'] == 'uncleared' ? "uncleared" : "" ) :"") .'
						    
					    </div>
					</div>
					</div>
			
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					      <label>Perkerjaan</label>
					    </div>
					    <div  class="col-xs-10">
					     '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['pekerjaan'] :"").'
					    </div>
                                        </div>
					</div>
			
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					      <label>Solusi</label>
					    </div>
					    <div  class="col-xs-10">
					     '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['solusi'] :"").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					      <label>Alat yang terpasang</label>
					    </div>
					    <div  class="col-xs-10">
					     '.(isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['alat_terpasang'] :"").'
					    </div>
                                        </div>
					</div>
			
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					    </div>
					    <div class="col-xs-4">
					       
					    </div>
					</div>
					</div>
			
		      </div><br />
	      
	    
	    </div>
	    </fieldset>
	    </div>
	
	
	</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Detail SPK Aktivasi Baru';
    $submenu	= "master_form_spk_Aktivasi_baru";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>