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
 //echo date("Y-m-d H:i:s");   
	    if(isset($_GET['id_spk_pasang_baru'])){
		$get_id = isset($_GET['id_spk_pasang_baru']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_spk_pasang_baru']))) : "";
		$data_spk_pasang_baru = mysql_fetch_array(mysql_query("SELECT * FROM `gx_spk_pasang` WHERE `id_spkpasang` = '$get_id';", $conn));
	    }
    
    $sql_parent = mysql_query("SELECT * FROM `gx_email_kategori` ORDER BY `id_kategori` DESC;",$conn);
    $content ='<section class="content-header">
                    <h1>
                        Form SPK Pasang Baru                        
                    </h1>
                    
                </section>
		<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				
				
                                <div class="box-body table-responsive">
				
				
        <form action="" role="form" name="myForm"  method="POST" >
	  
	  <input type="hidden" style="" name="id_spk_pasang_baru" value="'.(isset($_GET['id_spk_pasang_baru']) ? $_GET['id_spk_pasang_baru'] :"").'" />
          
	<div >
	    <fieldset>
		<legend>Data SPK Pasang Baru</legend>
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
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="namecabang" value="">
						<input type="hidden" readonly="" class="form-control" required="" name="cabang" value="">
						<a href="'.URL_ADMIN.'master_anyar/data_cabang.php?r=myForm&f=spkpasangbaru"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_cabang.php?r=myForm&f=spkpasangbaru\',\'cabang\');">Search cabang</a>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>No. SPK Pasang Baru</label>
			</div>
					    <div class="col-xs-4">
						
			
			  <input type="text" readonly="" class="form-control required" style="" name="kode_spk" value="" />
			 </div>
					    <div class="col-xs-2">
						
			  <label>Tanggal</label>
			</div>
					    <div class="col-xs-4">
					
			  <input class="form-control" name="id_spk_pasang_baru" type="hidden" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $_GET["id_spk_pasang_baru"] :"") .'" readonly="">
			  <input class="form-control required" readonly="" name="tanggal" id="tanggal" placeholder="Tanggal" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['tanggal'] : date("Y-m-d") ) .'" >
			  </div>
                                        </div>
					</div>
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kode Customer</label>
			</div>
					    <div class="col-xs-4">
			  <input class="form-control" name="kode_customer" readonly="" id="kode_customer" placeholder="Kode Customer" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['id_customer'] :"") .'" >
			<!--<a onclick="kode_customer()" title="Search Customer" style="padding-left: 66%; color : #4571b5; cursor : pointer;">Search Customer</a>-->
			<a href="'.URL_ADMIN.'master_anyar/data_customer_spk_pasang.php?r=myForm"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_customer_spk_pasang.php?r=myForm\',\'cust\');">Search Customer</a>
			</div>
					    <div class="col-xs-2">
					
			
			  <label>Nama Customer</label>
			 </div>
					    <div class="col-xs-4">
					
			  <input class="form-control" name="nama_customer" placeholder="Nama Customer" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['nama_customer'] : "") .'">

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
			
			  <label>Cabang</label>
	</div>
					    <div class="col-xs-4">
						<input type="hidden" name="id_cabang" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['id_cabang'] :"") .'">
						<input type="text" name="nama_cabang"  class="form-control"  value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['nama_cabang'] :"") .'" placeholder="Nama Cabang">
	 </div>
	 <div class="col-xs-2">
			  <label>No. Link Budget</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control" name="id_linkbudget" placeholder="No Link Budget" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['id_linkbudget'] :"") .'" >
	<a href="'.URL_ADMIN.'master_anyar/data_linkbudget.php?r=myForm"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_linkbudget.php?r=myForm\',\'cust\');">Search Link Budget</a>
	 </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Paket Koneksi</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control" name="paket_koneksi" placeholder="Paket Koneksi" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['paket_koneksi'] :"") .'" >
	 </div>
					    <div class="col-xs-2">
			  <label>Nama Koneksi</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control" name="nama_koneksi" placeholder="Nama Koneksi" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['nama_koneksi'] :"") .'" >
	 </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>User ID</label>
			</div>
			<div class="col-xs-4">
			  <input class="form-control" name="user_id" placeholder="User ID" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['user_id'] :"") .'">
			<!--<a href="'.URL_ADMIN.'master_anyar/data_paket.php?r=myForm"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_paket.php?r=myForm\',\'paket\');">Search Paket</a>-->
			  
			
		</div>
					    <div class="col-xs-2">
	
			      <label>Telpon</label>
	</div>
	<div class="col-xs-4">
			    <input class="form-control" name="telpon" placeholder="Telepon" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['telpon'] :"") .'">
		        
				</div></div></div>
	
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Alamat</label>
	</div>
	<div class="col-xs-10">
			    <input class="form-control" name="alamat" placeholder="alamat" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['alamat'] :"") .'">
		        </div>
			
			   </div></div>
	
	
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Teknisi</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" name="id_teknisi" type="hidden" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['id_teknisi'] :"") .'">
		        <input class="form-control" readonly="" name="nama_teknisi" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['nama_teknisi'] :"") .'">
		        <a href="'.URL_ADMIN.'master_anyar/data_teknisi.php?r=myForm"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_teknisi.php?r=myForm\',\'teknisi\');">Search Teknisi</a>
			</div>
			<div class="col-xs-2">
			  <label>Marketing</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" name="id_employee" type="hidden" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['id_marketing'] :"") .'">
		        <input class="form-control" readonly="" name="nama_marketing" placeholder="Nama Marketing" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['nama_marketing'] :"") .'">
		        <a href="'.URL_ADMIN.'master_anyar/data_marketing.php?r=myForm"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_marketing.php?r=myForm\',\'marketing\');">Search Marketing</a>
			</div>
			   </div></div>
			   
			   
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Perkerjaan</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="pekerjaan" class="form-control" placeholder="Pekerjaan" style="resize: none;"> '.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['pekerjaan'] :"").' </textarea>
			</div>
                                        </div>
					</div>
			
			 <div class="form-group">
					 <div class="row">
					     <div class="col-xs-2">
					     <div>
					     <div class="col-xs-4">
	       <input name="created_by" value="'.$loggedin["username"].'" type="hidden">
	       <input type="submit" class="button button-primary" data-icon="v" name="'.(isset($_GET["id_spk_pasang_baru"]) ? "update" : "save") .'" value="Save">
	    
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
	    $kode_spk 			= isset($_POST["kode_spk"]) ? $_POST["kode_spk"] : "";
	    $tanggal			= isset($_POST["tanggal"]) ? $_POST["tanggal"] : "";
	    $id_customer		= isset($_POST["kode_customer"]) ? $_POST["kode_customer"] : "";
	    $nama_customer		= isset($_POST["nama_customer"]) ? $_POST["nama_customer"] : "";
	    $id_cabang			= isset($_POST["id_cabang"]) ? $_POST["id_cabang"] : "";
	    $nama_cabang		= isset($_POST["nama_cabang"]) ? $_POST["nama_cabang"] : "";
	    $id_linkbudget		= isset($_POST["id_linkbudget"]) ? $_POST["id_linkbudget"] : "";
	    $paket_koneksi		= isset($_POST["paket_koneksi"]) ? $_POST["paket_koneksi"] : "";
	    $nama_koneksi		= isset($_POST["nama_koneksi"]) ? $_POST["nama_koneksi"] : "";
	    $user_id			= isset($_POST["user_id"]) ? $_POST["user_id"] : "";
	    $telpon			= isset($_POST["telpon"]) ? $_POST["telpon"] : "";
	    $alamat			= isset($_POST["alamat"]) ? $_POST["alamat"] : "";
	    $id_marketing		= isset($_POST["id_employee"]) ? $_POST["id_employee"] : "";
	    $nama_marketing		= isset($_POST["nama_marketing"]) ? $_POST["nama_marketing"] : "";
	    $id_teknisi			= isset($_POST["id_teknisi"]) ? $_POST["id_teknisi"] : "";
	    $nama_teknisi		= isset($_POST["nama_teknisi"]) ? $_POST["nama_teknisi"] : "";
	    $pekerjaan			= isset($_POST["pekerjaan"]) ? $_POST["pekerjaan"] : "";
	    
	    /*$ = isset($_POST[""]) ? $_POST[""] : "";*/
	    
		    
		$insert_spk_pasang_baru    	= "INSERT INTO `gx_spk_pasang`(`id_spkpasang`, `kode_spk`, `tanggal`, `id_customer`, `nama_customer`, `id_cabang`, `nama_cabang`, `id_linkbudget`, `paket_koneksi`, `nama_koneksi`, `user_id`, `telpon`, `alamat`, `id_marketing`, `id_teknisi`, `pekerjaan`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
						   VALUES (NULL,'$kode_spk', '$tanggal', '$id_customer', '$nama_customer', '$id_cabang', '$nama_cabang', '$id_linkbudget', '$paket_koneksi', '$nama_koneksi', '$user_id', '$telpon', '$alamat', '$id_marketing', '$id_teknisi', '$pekerjaan', NOW(), NOW(),'$loggedin[username]', '$loggedin[username]', '0')";
		//echo $insert_spk_pasang_baru;
		mysql_query($insert_spk_pasang_baru, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert prospek = $insert_spk_pasang_baru");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'master_spk_pasang_baru.php';
		</script>";
	}elseif($update == "Save"){
	    $id_spkpasang	 	= isset($_POST["id_spk_pasang_baru"]) ? $_POST["id_spk_pasang_baru"] : "";
	    $kode_spk 			= isset($_POST["kode_spk"]) ? $_POST["kode_spk"] : "";
	    $tanggal			= isset($_POST["tanggal"]) ? $_POST["tanggal"] : "";
	    $id_customer		= isset($_POST["kode_customer"]) ? $_POST["kode_customer"] : "";
	    $nama_customer		= isset($_POST["nama_customer"]) ? $_POST["nama_customer"] : "";
	    $id_cabang			= isset($_POST["id_cabang"]) ? $_POST["id_cabang"] : "";
	    $nama_cabang		= isset($_POST["nama_cabang"]) ? $_POST["nama_cabang"] : "";
	    $id_linkbudget		= isset($_POST["id_linkbudget"]) ? $_POST["id_linkbudget"] : "";
	    $paket_koneksi		= isset($_POST["paket_koneksi"]) ? $_POST["paket_koneksi"] : "";
	    $nama_koneksi		= isset($_POST["nama_koneksi"]) ? $_POST["nama_koneksi"] : "";
	    $user_id			= isset($_POST["user_id"]) ? $_POST["user_id"] : "";
	    $telpon			= isset($_POST["telpon"]) ? $_POST["telpon"] : "";
	    $alamat			= isset($_POST["alamat"]) ? $_POST["alamat"] : "";
	    $id_marketing		= isset($_POST["id_employee"]) ? $_POST["id_employee"] : "";
	    $nama_marketing		= isset($_POST["nama_marketing"]) ? $_POST["nama_marketing"] : "";
	    $id_teknisi			= isset($_POST["id_teknisi"]) ? $_POST["id_teknisi"] : "";
	    $nama_teknisi		= isset($_POST["nama_teknisi"]) ? $_POST["nama_teknisi"] : "";
	    $pekerjaan			= isset($_POST["pekerjaan"]) ? $_POST["pekerjaan"] : "";
	    
		    
		$insert_spk_pasang_baru    	= "UPDATE `gx_spk_pasang` SET `kode_spk`='$kode_spk',
		`id_customer`='$id_customer',`nama_customer`='$nama_customer',`id_cabang`='$id_cabang',`nama_cabang`='$nama_cabang',`id_linkbudget`='$id_linkbudget',
		`paket_koneksi`='$paket_koneksi',`nama_koneksi`='$nama_koneksi',`user_id`='$user_id',`telpon`='$telpon',`alamat`='$alamat',`id_marketing`='$id_marketing',
		`nama_marketing`='$nama_marketing',`id_teknisi`='$id_teknisi',`nama_teknisi`='$nama_teknisi',`pekerjaan`='$pekerjaan',
		`user_upd`='$loggedin[username]',`date_upd`=NOW(),`level`='0' WHERE `id_spkpasang`='$id_spkpasang'";
		
		
		//echo $insert_spk_pasang_baru;
		mysql_query($insert_spk_pasang_baru, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit prospek = $insert_spk_pasang_baru");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'master_spk_pasang_baru.php';
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