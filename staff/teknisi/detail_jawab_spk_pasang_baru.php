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
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
//if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Jawab SPK Pasang Baru");
    global $conn;
    global $conn_voip;
    
$sql_last_data  = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk_pasang`", $conn)) + 1;
$array_last_data_jawab_spk = mysql_fetch_array(mysql_query("SELECT `kode_jawab_spk` FROM `gx_jawab_spkpasang` ORDER BY `kode_jawab_spk` DESC LIMIT 1", $conn));
$number_new_jawab_spk = $array_last_data_jawab_spk['kode_jawab_spk'] + 1;
 //echo date("Y-m-d H:i:s");   
	    if(isset($_GET['id_jawab_spk_pasang_baru'])){
		$get_id = isset($_GET['id_jawab_spk_pasang_baru']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_jawab_spk_pasang_baru']))) : "";
		$data_jawaban_spk_pasang_baru = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spkpasang` WHERE `id_jawab_spkpasang`='$get_id'", $conn));
		$data_jawaban_spk_pasang_baru_teknisi = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$data_jawaban_spk_pasang_baru[id_teknisi]'", $conn));
		$data_jawaban_spk_pasang_baru_teknisi2 = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$data_jawaban_spk_pasang_baru[id_teknisi2]'", $conn));
		$data_jawaban_spk_pasang_baru_teknisi3 = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$data_jawaban_spk_pasang_baru[id_teknisi3]'", $conn));
		$data_jawaban_spk_pasang_baru_teknisi4 = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$data_jawaban_spk_pasang_baru[id_teknisi4]'", $conn));
		$data_jawaban_spk_pasang_baru_teknisi5 = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$data_jawaban_spk_pasang_baru[id_teknisi5]'", $conn));
		$data_jawaban_spk_pasang_baru_marketing = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$data_jawaban_spk_pasang_baru[id_marketing]'", $conn));
    }elseif(isset($_GET['id_spk_pasang_baru'])){
		$get_id = isset($_GET['id_spk_pasang_baru']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_spk_pasang_baru']))) : "";
		$data_spk_pasang_baru = mysql_fetch_array(mysql_query("SELECT * FROM `gx_spk_pasang` WHERE `id_spkpasang`='$get_id'", $conn));
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
	  
	  <input type="hidden" style="" name="id_jawab_spkpasang" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $_GET['id_jawab_spk_pasang_baru'] :"").'" />
          
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
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" required="" onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=jawabspkpasangbaru\',\'cabang\');" name="namecabang" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['nama_cabang'] :"") .'">
						<input type="hidden" readonly="" class="form-control" required="" name="cabang" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_cabang'] :"") .'">
						
					    </div>
					    <div class="col-xs-2">
						
			  <label>Tanggal</label>
			</div>
					    <div class="col-xs-4">
					
			  <input class="form-control" name="id_spk_pasang_baru" type="hidden" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $_GET['id_jawab_spk_pasang_baru'] :"") .'" readonly="">
			  <input class="form-control required" required="" readonly="" name="tanggal" id="tanggal" placeholder="Tanggal" type="text" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['tanggal'] : date("Y-m-d") ) .'" >
			  </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>No. SPK Pasang Baru</label>
			</div>
					    <div class="col-xs-4">
						
			
			  <input class="form-control" type="text" readonly="" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['kode_spk'] :"") .''.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru['kode_spk'] :"") .'" name="kode_spk">
			   
			 </div>
					    
					    <div class="col-xs-2">
						 <label>No. Jawaban SPK Pasang Baru</label>
					    </div>
					    <div class="col-xs-4">
						 <input type="text" required="" readonly="" name="kode_jawab_spk" readonly="" class="form-control"  value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['kode_jawab_spk'] : "") .'" placeholder="No. Jawab SPK Pasang Baru">
					    </div>
                                        </div>
					</div>
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kode Customer</label>
			</div>
					    <div class="col-xs-4">
			  <input class="form-control" readonly="" name="kode_customer" readonly="" id="kode_customer" placeholder="Kode Customer" type="text" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_customer'] :"") .''.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru['id_customer'] :"") .'" >
			
			<!--<a onclick="kode_customer()" title="Search Customer" style="padding-left: 66%; color : #4571b5; cursor : pointer;">Search Customer</a>-->
			<!--<a href="data_spk_pasang_baru.php?r=myForm"  onclick="return valideopenerform(\'data_spk_pasang_baru.php?r=myForm\',\'spk_pasang\');">Search Customer</a>-->
			</div>
					    <div class="col-xs-2">
					
			
			  <label>Nama Customer</label>
			 </div>
					    <div class="col-xs-4">
					
			  <input class="form-control" readonly="" name="nama_customer" placeholder="Nama Customer" type="text" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['nama_customer'] : "") .''.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru['nama_customer'] :"") .'">

		<input type="hidden" name="nama_perusahaan">
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
			  <label>No. Link Budget</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control" readonly="" name="id_linkbudget" placeholder="No Link Budget" type="text" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_linkbudget'] :"") .''.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru['id_linkbudget'] :"") .'" >
	</div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Paket Koneksi</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control" readonly="" name="paket_koneksi" placeholder="Paket Koneksi" type="text" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['paket_koneksi'] :"") .''.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru['paket_koneksi'] :"") .'" >
	 </div>
					    <div class="col-xs-2">
			  <label>Nama Koneksi</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control" readonly="" name="nama_koneksi" placeholder="Nama Koneksi" type="text" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['nama_koneksi'] :"") .''.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru['nama_koneksi'] :"") .'" >
	 </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>User ID</label>
			</div>
			<div class="col-xs-4">
			  <input class="form-control" readonly=""name="user_id" readonly="" placeholder="User ID" type="text" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['user_id'] :"") .''.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru['user_id'] :"") .'">
			<!--<a href="data_paket.php?r=myForm"  onclick="return valideopenerform(\'data_paket.php?r=myForm\',\'paket\');">Search Paket</a>-->
			  
			
		</div>
					    <div class="col-xs-2">
	
			      <label>Telp</label>
	</div>
	<div class="col-xs-4">
			    <input class="form-control" required="" readonly="" name="telpon" placeholder="Telepon" type="text" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['telpon'] :"") .''.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru['telpon'] :"") .'">
		        
				</div></div></div>
	
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Alamat</label>
	</div>
	<div class="col-xs-10">
			    <input class="form-control" readonly="" name="alamat" placeholder="alamat" type="text" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['alamat'] :"") .''.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru['alamat'] :"") .'">
		        </div>
			
			   </div></div>
	
	
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Teknisi 1</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" readonly="" name="id_teknisi" type="hidden" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_teknisi'] :"") .''.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru['id_teknisi'] :"") .'">
		        <input class="form-control" readonly="" name="nama_teknisi" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru_teknisi['nama'] :"") .''.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru['nama_teknisi'] :"") .'">
		        </div>
			<div class="col-xs-2">
			  <label>Marketing</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" readonly="" name="id_marketing" type="hidden" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_marketing'] :"") .''.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru['id_marketing'] :"") .'">
		        <input class="form-control" readonly="" name="nama_marketing" placeholder="Marketing" type="text" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru_marketing['nama'] :"").''.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru['nama_marketing'] :"") .'">
		        </div>
	</div></div>
	
	
	
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Teknisi 2</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" readonly="" name="id_teknisi_2" type="hidden" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_teknisi2'] :"") .'">
		        <input class="form-control" readonly="" onclick="valideopenerform(\'data_teknisi.php?r=myForm&t=2\',\'teknisi\');" name="nama_teknisi_2" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru_teknisi2['nama'] :"") .'">
		        </div>
			
					    <div class="col-xs-2">
			  <label>Teknisi 4</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" readonly="" name="id_teknisi_4" type="hidden" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_teknisi4'] :"") .'">
		        <input class="form-control" readonly="" onclick="valideopenerform(\'data_teknisi.php?r=myForm&t=4\',\'teknisi4\');" name="nama_teknisi_4" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru_teknisi4['nama'] :"") .'">
		        </div>
			</div></div>
			
			
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Teknisi 3</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" readonly="" name="id_teknisi_3" type="hidden" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_teknisi3'] :"") .'">
		        <input class="form-control" readonly="" onclick="valideopenerform(\'data_teknisi.php?r=myForm&t=3\',\'teknisi3\');" name="nama_teknisi_3" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru_teknisi3['nama'] :"") .'">
		        </div>
			<div class="col-xs-2">
			  <label>Teknisi 5</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" readonly="" name="id_teknisi_5" type="hidden" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['id_teknisi5'] :"") .'">
		        <input class="form-control" readonly="" onclick="valideopenerform(\'data_teknisi.php?r=myForm&t=5\',\'teknisi5\');" name="nama_teknisi_5" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru_teknisi5['nama'] :"") .'">
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
			Cleared </td><td><input class="form-control" name="status" type="radio" value="cleared" '.(isset($_GET['id_jawab_spk_pasang_baru']) ? ($data_jawaban_spk_pasang_baru['status'] == 'cleared' ? "checked" : "" ) :"") .'>
		       	</td></tr>
			<tr><td>
			Uncleared </td><td><input class="form-control" name="status" type="radio" value="uncleared" '.(isset($_GET['id_jawab_spk_pasang_baru']) ? ($data_jawaban_spk_pasang_baru['status'] == 'uncleared' ? "unchecked" : "" ) :"") .'>
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
			 <textarea name="pekerjaan" class="form-control" placeholder="Pekerjaan" style="resize: none;">'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['pekerjaan'] :"").''.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru['pekerjaan'] :"") .'</textarea>
			</div>
                                        </div>
					</div>
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Solusi</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="solusi" class="form-control" placeholder="Solusi" style="resize: none;">'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['solusi'] :"").'</textarea>
			</div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Alat yang terpasang</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="alat_terpasang" class="form-control" placeholder="Alat yang Terpasang" style="resize: none;">'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru['alat_terpasang'] :"").'</textarea>
			</div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_jawab_spk_pasang_baru']) ? $data_jawaban_spk_pasang_baru["user_upd"]." ".$data_jawaban_spk_pasang_baru["date_upd"] : "").'
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
	       <input type="submit" class="button button-primary" data-icon="v" name="'.(isset($_GET['id_jawab_spk_pasang_baru']) ? "update" : "save") .'" value="Save">
	    
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

$plugins = '';

    $title	= 'Form SPK Pasang Baru';
    $submenu	= "master_form_spk_pasang_baru";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;

    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>