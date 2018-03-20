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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Mailbox");
    global $conn;
    global $conn_voip;
    
$sql_last_data  = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk_pasang`", $conn)) + 1;
$array_last_data_jawab_spk = mysql_fetch_array(mysql_query("SELECT `kode_jawab_spk` FROM `gx_jawab_spkpasang` ORDER BY `kode_jawab_spk` DESC LIMIT 1", $conn));
$number_new_jawab_spk = $array_last_data_jawab_spk['kode_jawab_spk'] + 1;
 //echo date("Y-m-d H:i:s");   
	    if(isset($_GET['id_jawaban_spk_pasang_baru'])){
		$get_id = isset($_GET['id_jawaban_spk_pasang_baru']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_jawaban_spk_pasang_baru']))) : "";
		$data_jawaban_spk_pasang_baru = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spkpasang` WHERE `id_jawab_spkpasang`='$get_id'", $conn));
		$data_jawaban_spk_pasang_baru_teknisi = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$data_jawaban_spk_pasang_baru[id_teknisi]'", $conn));
		$data_jawaban_spk_pasang_baru_marketing = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$data_jawaban_spk_pasang_baru[id_marketing]'", $conn));
    }
    
    $sql_parent = mysql_query("SELECT * FROM `gx_email_kategori` ORDER BY `id_kategori` DESC;",$conn);
    $content = '<section class="content-header">
                    <h1>
                        Form Jawaban SPK Pasang Baru                        
                    </h1>
                    
                </section>
		<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				
				
                                <div class="box-body table-responsive">
				
				
        <form action="" role="form" name="myForm"  method="POST" >
	  
	  <input type="hidden" style="" name="id_jawab_spkpasang" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $_GET['id_jawaban_spk_pasang_baru'] :"").'" />
          
	<div >
	    <fieldset>
		<legend>Data Jawaban SPK Pasang Baru</legend>
		<div class="table-container table-form">
		    <!--<a href="'.URL_ADMIN.'helpdesk/data_cust.php?r=form_spk_pasang_baru" class="btn btn-sm bg-navy btn-flat margin pull-right"
						onclick="return valideopenerform(\''.URL_ADMIN.'helpdesk/data_cust.php?r=form_spk_pasang_baru\',\'prospek\');">Search Customer</a>-->
		 
		    
		    <div class="box-body">
					<div class="col-xs-12">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>No. SPK Pasang Baru</label>
			</div>
					    <div class="col-xs-4">
						
			
			  <input class="form-control" type="text" readonly="" name="kode_spk">
			   <a href="'.URL_ADMIN.'master_anyar/data_spk_pasang_baru.php?r=myForm" 
						onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_spk_pasang_baru.php?r=myForm\',\'spk_pasang_baru\');">Search SPK Pasang Baru</a>
			 <!--<input type="hidden" name="kode_spk">-->
			 <!--<input type="hidden" name="tanggal">
			 <input type="hidden" name="id_customer">
			 <input type="hidden" name="nama_customer">
			 <input type="hidden" name="nama_cabang">
			 <input type="hidden" name="id_linkbudget">
			 <input type="hidden" name="paket_koneksi">
			 <input type="hidden" name="nama_koneksi">
			 <input type="hidden" name="user_id">
			 <input type="hidden" name="telpon">
			 <input type="hidden" name="alamat">
			 <input type="hidden" name="teknisi_cNama">
			 <input type="hidden" name="marketing_cNama">
			 <input type="hidden" name="pekerjaan">-->
			 </div>
					    <div class="col-xs-2">
						
			  <label>Tanggal</label>
			</div>
					    <div class="col-xs-4">
					
			  <input class="form-control" name="id_spk_pasang_baru" type="hidden" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $_GET['id_jawaban_spk_pasang_baru'] :"") .'" readonly="">
			  <input class="form-control required" required="" readonly="" name="tanggal" id="tanggal" placeholder="Tanggal" type="text" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['tanggal'] : date("Y-m-d") ) .'" >
			  </div>
                                        </div>
					</div>
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			
			  <label>No. Jawaban SPK Pasang Baru</label>
	</div>
					    <div class="col-xs-10">
						<input type="text" required="" name="kode_jawab_spk" readonly="" class="form-control"  value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['kode_jawab_spk'] : 'GCT-'.date("dmy").sprintf("%04d", $number_new_jawab_spk)) .'" placeholder="No. Jawab SPK Pasang Baru">
	 </div>
	 
                                        </div>
					</div>
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kode Customer</label>
			</div>
					    <div class="col-xs-4">
			  <input class="form-control" required="" name="kode_customer" readonly="" id="kode_customer" placeholder="Kode Customer" type="text" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_customer'] :"") .'" >
			
			<!--<a onclick="kode_customer()" title="Search Customer" style="padding-left: 66%; color : #4571b5; cursor : pointer;">Search Customer</a>-->
			<!--<a href="'.URL_ADMIN.'master_anyar/data_spk_pasang_baru.php?r=myForm"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_spk_pasang_baru.php?r=myForm\',\'spk_pasang\');">Search Customer</a>-->
			</div>
					    <div class="col-xs-2">
					
			
			  <label>Nama Customer</label>
			 </div>
					    <div class="col-xs-4">
					
			  <input class="form-control" required="" name="nama_customer" placeholder="Nama Customer" type="text" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['nama_customer'] : "") .'">

		<input type="hidden" name="nama_perusahaan">
		<!--<input type="hidden" name="alamat">-->
		<input type="hidden" name="kota">
		<input type="hidden" name="notelp">
		<input type="hidden" name="hp1">
		<input type="hidden" name="hp2">
		<input type="hidden" name="contact">
		<input type="hidden" name="email">
		
			
			
				</div>
                                        </div>
					</div>
					
					
					
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			
			  <label>Cabang</label>
	</div>
					    <div class="col-xs-4">
						<input type="hidden" name="no_prospek"  class="form-control"  value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_cabang'] :"") .'" placeholder="ID Cabang">
						<input type="text" name="cabang"  class="form-control"  value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['nama_cabang'] :"") .'" placeholder="Nama Cabang">
	 		
	 </div>
	 <div class="col-xs-2">
			  <label>No. Link Budget</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control" required="" name="no_link_budget" placeholder="No Link Budget" type="text" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_linkbudget'] :"") .'" >
	</div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Paket Koneksi</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control" required="" name="paket_koneksi" placeholder="Paket Koneksi" type="text" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['paket_koneksi'] :"") .'" >
	 </div>
					    <div class="col-xs-2">
			  <label>Nama Koneksi</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control" required="" name="nama_koneksi" placeholder="Nama Koneksi" type="text" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['nama_koneksi'] :"") .'" >
	 </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>User ID</label>
			</div>
			<div class="col-xs-4">
			  <input class="form-control" required="" name="user_id" readonly="" placeholder="User ID" type="text" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['user_id'] :"") .'">
			<!--<a href="'.URL_ADMIN.'master_anyar/data_paket.php?r=myForm"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_paket.php?r=myForm\',\'paket\');">Search Paket</a>-->
			  
			
		</div>
					    <div class="col-xs-2">
	
			      <label>Telp</label>
	</div>
	<div class="col-xs-4">
			    <input class="form-control" required="" name="telpon" placeholder="Telepon" type="text" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['telpon'] :"") .'">
		        
				</div></div></div>
	
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Alamat</label>
	</div>
	<div class="col-xs-10">
			    <input class="form-control" required="" name="alamat" placeholder="alamat" type="text" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['alamat'] :"") .'">
		        </div>
			
			   </div></div>
	
	
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Teknisi 1</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" name="id_teknisi" type="hidden" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_teknisi'] :"") .'">
		        <input class="form-control"  name="nama_teknisi" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru_teknisi['cNama'] :"") .'">
		        </div>
			<div class="col-xs-2">
			  <label>Marketing</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" name="id_marketing" type="hidden" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_marketing'] :"") .'">
		        <input class="form-control"  name="nama_marketing" placeholder="Marketing" type="text" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru_marketing['cNama'] :"").'">
		        </div>
	</div></div>
	
	
	
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Teknisi 2</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" name="id_teknisi_2" type="hidden" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_teknisi'] :"") .'">
		        <input class="form-control" name="nama_teknisi_2" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru_teknisi['cNama'] :"") .'">
		        </div>
			
					    <div class="col-xs-2">
			  <label>Teknisi 4</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" name="id_teknisi_4" type="hidden" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_teknisi'] :"") .'">
		        <input class="form-control" name="nama_teknisi_4" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru_teknisi['cNama'] :"") .'">
		        </div>
			</div></div>
			
			
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Teknisi 3</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" name="id_teknisi_3" type="hidden" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_teknisi'] :"") .'">
		        <input class="form-control" name="nama_teknisi_3" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru_teknisi['cNama'] :"") .'">
		        </div>
			<div class="col-xs-2">
			  <label>Teknisi 5</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" name="id_teknisi_5" type="hidden" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_teknisi'] :"") .'">
		        <input class="form-control" name="nama_teknisi_5" placeholder="Nama Marketing" type="text" value="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru_teknisi['cNama'] :"") .'">
		        </div>
			   </div></div>
			   
			   	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Status</label>
	</div>
	<div class="col-xs-10">
			<table>
			<tr><td>
			Cleared </td><td><input class="form-control" name="status" type="radio" value="cleared" '.(isset($_GET['id_jawaban_spk_pasang_baru']) ? ($data_jawaban_spk_pasang_baru['status'] == 'cleared' ? "checked" : "" ) :"") .'>
		       	</td></tr>
			<tr><td>
			Uncleared </td><td><input class="form-control" name="status" type="radio" value="uncleared" '.(isset($_GET['id_jawaban_spk_pasang_baru']) ? ($data_jawaban_spk_pasang_baru['status'] == 'uncleared' ? "unchecked" : "" ) :"") .'>
		        </td></tr>
			</table>
			</div>
			   </div></div>
			   
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Perkerjaan</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="pekerjaan" class="form-control" placeholder="Pekerjaan" style="resize: none;">'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['pekerjaan'] :"").'</textarea>
			</div>
                                        </div>
					</div>
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Solusi</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="solusi" class="form-control" placeholder="Solusi" style="resize: none;">'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['solusi'] :"").'</textarea>
			</div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Alat yang terpasang</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="alat_terpasang" class="form-control" placeholder="Alat yang Terpasang" style="resize: none;">'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['alat_terpasang'] :"").'</textarea>
			</div>
                                        </div>
					</div>
			
			 <div class="form-group">
					 <div class="row">
					     <div class="col-xs-2">
					     <div>
					     <div class="col-xs-4">
	       <input name="created_by" value="'.$loggedin["username"].'" type="hidden">
	       <input name="id_employee" value="'.$loggedin["id_employee"].'" type="hidden">
	       <input type="submit" class="button button-primary" data-icon="v" name="'.(isset($_GET['id_jawaban_spk_pasang_baru']) ? "update" : "save") .'" value="Save">
	    
	     </div></div>
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

$save = isset($_POST["save"]) ? $_POST["save"] : "";
$update = isset($_POST["update"]) ? $_POST["update"] : "";


	if($save == "Save"){
	    $id_spkpasang	 	= isset($_POST["id_spk_pasang_baru"]) ? $_POST["id_spk_pasang_baru"] : "";
	    
	    $id_jawab_spkpasang		= isset($_POST["id_jawab_spkpasang"]) ? $_POST["id_jawab_spkpasang"] : '';
	    $kode_jawab_spk		= isset($_POST["kode_jawab_spk"]) ? $_POST["kode_jawab_spk"] : '';
	    $kode_spk 			= isset($_POST["kode_spk"]) ? $_POST["kode_spk"] : "";
	    $tanggal			= isset($_POST["tanggal"]) ? $_POST["tanggal"] : "";
	    $id_customer		= isset($_POST["kode_customer"]) ? $_POST["kode_customer"] : "";
	    $nama_customer		= isset($_POST["nama_customer"]) ? $_POST["nama_customer"] : "";
	    $id_cabang			= isset($_POST["no_prospek"]) ? $_POST["no_prospek"] : "";
	    $nama_cabang		= isset($_POST["cabang"]) ? $_POST["cabang"] : "";
	    $id_linkbudget		= isset($_POST["id_linkbudget"]) ? $_POST["id_linkbudget"] : "";
	    $paket_koneksi		= isset($_POST["paket_koneksi"]) ? $_POST["paket_koneksi"] : "";
	    $nama_koneksi		= isset($_POST["nama_koneksi"]) ? $_POST["nama_koneksi"] : "";
	    $user_id			= isset($_POST["user_id"]) ? $_POST["user_id"] : "";
	    $telpon			= isset($_POST["telpon"]) ? $_POST["telpon"] : "";
	    $alamat			= isset($_POST["alamat"]) ? $_POST["alamat"] : "";
	    $id_marketing		= isset($_POST["id_employee"]) ? $_POST["id_employee"] : "";
	    $id_teknisi			= isset($_POST["id_teknisi"]) ? $_POST["id_teknisi"] : "";
	    $id_teknisi2		= isset($_POST["id_teknisi2"]) ? $_POST["id_teknisi2"] : '';
	    $id_teknisi3		= isset($_POST["id_teknisi3"]) ? $_POST["id_teknisi3"] : '';
	    $id_teknisi4		= isset($_POST["id_teknisi4"]) ? $_POST["id_teknisi4"] : '';
	    $id_teknisi5		= isset($_POST["id_teknisi5"]) ? $_POST["id_teknisi5"] : '';
	    $pekerjaan			= isset($_POST["pekerjaan"]) ? $_POST["pekerjaan"] : '';
	    $status			= isset($_POST["status"]) ? $_POST["status"] : '';
	    $solusi			= isset($_POST["solusi"]) ? $_POST["solusi"] : '';
	    $alat_terpasang		= isset($_POST["alat_terpasang"]) ? $_POST["alat_terpasang"] : '';
	    
	    /*$ = isset($_POST[""]) ? $_POST[""] : "";*/
	    
		    
		$insert_spk_pasang_baru    	= "INSERT INTO `gx_jawab_spkpasang`(`id_jawab_spkpasang`, `kode_jawab_spk`, `kode_spk`, `tanggal`, `id_customer`, `nama_customer`, `id_cabang`, `nama_cabang`, `id_linkbudget`, `paket_koneksi`, `nama_koneksi`, `user_id`, `telpon`, `alamat`, `id_marketing`, `id_teknisi`, `id_teknisi2`, `id_teknisi3`, `id_teknisi4`, `id_teknisi5`, `pekerjaan`, `status`, `solusi`, `alat_terpasang`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
						   VALUES (NULL,'$kode_jawab_spk', '$kode_spk', '$tanggal', '$id_customer', '$nama_customer', '$id_cabang', '$nama_cabang', '$id_linkbudget', '$paket_koneksi', '$nama_koneksi', '$user_id', '$telpon', '$alamat', '$id_marketing', '$id_teknisi', '$id_teknisi2', '$id_teknisi3', '$id_teknisi4', '$id_teknisi5', '$pekerjaan', '$status', '$solusi', '$alat_terpasang', NOW(), NOW(), '$loggedin[username]', '$loggedin[username]', '0')";
		//echo $insert_spk_pasang_baru;
		mysql_query($insert_spk_pasang_baru, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinput ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert prospek = $insert_spk_pasang_baru");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'master_jawaban_spk_pasang_baru.php';
		</script>";
	}elseif($update == "Save"){
	    $id_spkpasang	 	= isset($_POST["id_spk_pasang_baru"]) ? $_POST["id_spk_pasang_baru"] : "";
	    
	    $id_jawab_spkpasang		= isset($_POST["id_jawab_spkpasang"]) ? $_POST["id_jawab_spkpasang"] : '';
	    $kode_jawab_spk		= isset($_POST["kode_jawab_spk"]) ? $_POST["kode_jawab_spk"] : '';
	    $kode_spk 			= isset($_POST["kode_spk"]) ? $_POST["kode_spk"] : "";
	    $tanggal			= isset($_POST["tanggal"]) ? $_POST["tanggal"] : "";
	    $id_customer		= isset($_POST["kode_customer"]) ? $_POST["kode_customer"] : "";
	    $nama_customer		= isset($_POST["nama_customer"]) ? $_POST["nama_customer"] : "";
	    $id_cabang			= isset($_POST["no_prospek"]) ? $_POST["no_prospek"] : "";
	    $nama_cabang		= isset($_POST["cabang"]) ? $_POST["cabang"] : "";
	    $id_linkbudget		= isset($_POST["id_linkbudget"]) ? $_POST["id_linkbudget"] : "";
	    $paket_koneksi		= isset($_POST["paket_koneksi"]) ? $_POST["paket_koneksi"] : "";
	    $nama_koneksi		= isset($_POST["nama_koneksi"]) ? $_POST["nama_koneksi"] : "";
	    $user_id			= isset($_POST["user_id"]) ? $_POST["user_id"] : "";
	    $telpon			= isset($_POST["telpon"]) ? $_POST["telpon"] : "";
	    $alamat			= isset($_POST["alamat"]) ? $_POST["alamat"] : "";
	    $id_marketing		= isset($_POST["id_employee"]) ? $_POST["id_employee"] : "";
	    $id_teknisi			= isset($_POST["id_teknisi"]) ? $_POST["id_teknisi"] : "";
	    $id_teknisi2		= isset($_POST["id_teknisi2"]) ? $_POST["id_teknisi2"] : '';
	    $id_teknisi3		= isset($_POST["id_teknisi3"]) ? $_POST["id_teknisi3"] : '';
	    $id_teknisi4		= isset($_POST["id_teknisi4"]) ? $_POST["id_teknisi4"] : '';
	    $id_teknisi5		= isset($_POST["id_teknisi5"]) ? $_POST["id_teknisi5"] : '';
	    $pekerjaan			= isset($_POST["pekerjaan"]) ? $_POST["pekerjaan"] : '';
	    $status			= isset($_POST["status"]) ? $_POST["status"] : '';
	    $solusi			= isset($_POST["solusi"]) ? $_POST["solusi"] : '';
	    $alat_terpasang		= isset($_POST["alat_terpasang"]) ? $_POST["alat_terpasang"] : '';
	    
		    
		$insert_spk_pasang_baru    	= "UPDATE `gx_jawab_spkpasang` SET `kode_jawab_spk`='$kode_jawab_spk',`kode_spk`='$kode_spk',`tanggal`='$tanggal',`id_customer`='$id_customer',`nama_customer`='$nama_customer',
		`id_cabang`='$id_cabang',`nama_cabang`='$nama_cabang',`id_linkbudget`='$id_linkbudget',`paket_koneksi`='$paket_koneksi',`nama_koneksi`='$nama_koneksi',`user_id`='$user_id',`telpon`='$telpon',`alamat`='$alamat',
		`id_marketing`='$id_marketing',`id_teknisi`='$id_teknisi',`id_teknisi2`='$id_teknisi2',`id_teknisi3`='$id_teknisi3',`id_teknisi4`='$id_teknisi4',`id_teknisi5`='$id_teknisi5',`pekerjaan`='$pekerjaan',`status`='$status',
		`solusi`='$solusi',`alat_terpasang`='$alat_terpasang',`user_upd`='$loggedin[username]',`date_upd`=NOW(),`level`='0' WHERE `id_jawab_spkpasang`='$id_jawab_spkpasang'";
		
		
		//echo $insert_spk_pasang_baru;
		mysql_query($insert_spk_pasang_baru, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit prospek = $insert_spk_pasang_baru");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'master_jawaban_spk_pasang_baru.php';
		</script>";
	}
$plugins = '';

    $title	= 'Form SPK Pasang Baru';
    $submenu	= "master_form_spk_pasang_baru";
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