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
    if($loggedin["group"] == 'cso')
    {
        global $conn;
    
if(isset($_GET['id_prospek'])){
	$get_id = isset($_GET['id_prospek']) ? mysql_real_escape_string(trim(strip_tags($_GET['id_prospek']))) : "";
	$data_prospek = mysql_fetch_array(mysql_query("SELECT * FROM `gx_prospek`
												  WHERE `gx_prospek`.`id_prospek` = '$get_id';", $conn));
}

$sql_random 	= "SELECT `gx_cabang`.* FROM `gx_cabang`, `gx_pegawai`
				WHERE `gx_cabang`.`id_cabang` = `gx_pegawai`.`id_cabang`
				AND `gx_pegawai`.`id_employee` = '".$loggedin["id_employee"]."' LIMIT 0,1;";
$query_random 	= mysql_query($sql_random, $conn);
$row_random		= mysql_fetch_array($query_random);
//echo $sql_random;
$sql_last_prospek  	= mysql_fetch_array(mysql_query("SELECT * FROM `gx_prospek` ORDER BY `id_prospek` DESC", $conn));
$last_data  		= $sql_last_prospek["id_prospek"] + 1;
$tanggal    		= date("Ymd");
$kode_random 		= $row_random["kode_prospek"].''.$tanggal.''.sprintf("%04d", $last_data);

    $content ='<section class="content-header">
                    <h1>
                        Form prospek
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Prospek</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="myForm"  method="POST" action="">
                                    <div class="box-body">
									
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No. Prospek</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" required="" name="no_prospek" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_prospek'] : $kode_random).'">
						
					    </div>
						<div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="tanggal" value="'.date("Y-m-d").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Nama Customer *</label>
					    </div>
					    <div class="col-xs-10">
						<input type="text" class="form-control" required="" name="nama_customer" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['nama_cust'] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Nama Perusahaan</label>
					    </div>
					    <div class="col-xs-10">
						<input type="text" class="form-control" name="nama_perusahaan" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['nama_perusahaan'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-10">
					        
							<textarea class="form-control" name="alamat">'.(isset($_GET["id_prospek"]) ? $data_prospek['alamat'] :"").'</textarea>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kelurahan</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control"  name="kelurahan" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kelurahan'] :"").'">
					    </div>
					    <div class="col-xs-2">
						<label>Kecamatan</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control"  name="kecamatan" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kecamatan'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kota</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="kota" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kota'] :"") .'">
					    </div>
					    <div class="col-xs-2">
						<label>Kode Pos</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="kode_pos" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kode_pos'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No. Telp *</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" required="" name="notelp" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_telp'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No. HP 1 </label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="hp1" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_hp_1'] :"") .'">
					    </div>
					    <div class="col-xs-2">
						<label>No. HP 2 </label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="hp2" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_hp_2'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Nomer WA</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="no_wa" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_wa'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Contact Person</label>
                                            </div>
					    <div class="col-xs-10">
						<input type="text" class="form-control" name="contact" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['contact_person'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Email</label>
                                            </div>
					    <div class="col-xs-10">
						<input type="text" class="form-control" name="email" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['email'] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Note</label>
                                            </div>
					    <div class="col-xs-10">
						<textarea class="form-control" name="note">'.(isset($_GET["id_prospek"]) ? $data_prospek['note'] :"").'</textarea>
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Chat History WA</label>
                                            </div>
					    <div class="col-xs-10">
						<textarea name="chat_history_wa" rows="10" cols="80" id="editor1" cols="70" style="resize: none;"> '.(isset($_GET["id_prospek"]) ? $data_prospek['chat_history_wa'] :"").' </textarea>
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Marketing</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="nama_marketing" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['marketing'] :"") .'" > <a href="data_marketing.php?r=myForm" onclick="return valideopenerform(\'data_marketing.php?r=myForm\',\'cust\');">Search Employee</a>
						<input type="hidden" class="form-control" name="id_employee" value="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_prospek']) ? $data_prospek["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_prospek']) ? $data_prospek["user_upd"]." ".$data_prospek["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
				

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" name="'.(isset($_GET["id_prospek"]) ? "update" : "save") .'" value="Save" class="btn btn-primary">
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
$save = isset($_POST["save"]) ? $_POST["save"] : "";
$update = isset($_POST["update"]) ? $_POST["update"] : "";

	if($save == "Save"){
	    
	    $no_prospek		= isset($_POST['no_prospek']) ? mysql_real_escape_string(trim(strip_tags($_POST['no_prospek']))) : "";
	    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim(strip_tags($_POST['tanggal']))) : "";
	    $cabang			= isset($_POST['cabang']) ? mysql_real_escape_string(trim(strip_tags($_POST['cabang']))) : "";
	    
	    $nama_cust		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim(strip_tags($_POST['nama_customer']))) : "";
	    $nama_perusahaan= isset($_POST['nama_perusahaan']) ? mysql_real_escape_string(trim(strip_tags($_POST['nama_perusahaan']))) : "";
	    $alamat			= isset($_POST['alamat']) ? mysql_real_escape_string(trim(strip_tags($_POST['alamat']))) : "";
	    $kelurahan		= isset($_POST['kelurahan']) ? mysql_real_escape_string(trim(strip_tags($_POST['kelurahan']))) : "";
	    $kecamatan		= isset($_POST['kecamatan']) ? mysql_real_escape_string(trim(strip_tags($_POST['kecamatan']))) : "";
	    $kota			= isset($_POST['kota']) ? mysql_real_escape_string(trim(strip_tags($_POST['kota']))) : "";
	    $kode_pos		= isset($_POST['kode_pos']) ? mysql_real_escape_string(trim(strip_tags($_POST['kode_pos']))) : "";
	    $no_telp		= isset($_POST['notelp']) ? mysql_real_escape_string(trim(strip_tags($_POST['notelp']))) : "";
	    $no_hp_1		= isset($_POST['hp1']) ? mysql_real_escape_string(trim(strip_tags($_POST['hp1']))) : "";
	    $no_hp_2		= isset($_POST['hp2']) ? mysql_real_escape_string(trim(strip_tags($_POST['hp2']))) : "";
	    $contact_person	= isset($_POST['contact']) ? mysql_real_escape_string(trim(strip_tags($_POST['contact']))) : "";
	    $email			= isset($_POST['email']) ? mysql_real_escape_string(trim(strip_tags($_POST['email']))) : "";
	    $marketing		= isset($_POST['nama_marketing']) ? mysql_real_escape_string(trim(strip_tags($_POST['nama_marketing']))) : "";
	    $note			= isset($_POST['note']) ? mysql_real_escape_string(trim(strip_tags($_POST['note']))) : "";
	    $id_marketing	= isset($_POST['id_employee']) ? mysql_real_escape_string(trim(strip_tags($_POST['id_employee']))) : "";
	    $chat_wa		= isset($_POST['chat_history_wa']) ? mysql_real_escape_string(trim(strip_tags($_POST['chat_history_wa']))) : "";
		$no_wa		 	= isset($_POST['no_wa']) ? mysql_real_escape_string(trim(strip_tags($_POST['no_wa']))) : "";
	    if($no_prospek != "")
		{
			$insert_prospek    	= "INSERT INTO `gx_prospek`(`id_prospek`, `no_prospek`, `tanggal`, `cabang`, `nama_cust`, `nama_perusahaan`, `alamat`,
			`kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp_1`, `no_hp_2`, `no_wa`, `contact_person`, `email`, `marketing`,
			 `note`, `chat_history_wa`, `id_marketing`,
			`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
			VALUES (NULL,'".$no_prospek."',NOW(),'".$cabang."','".$nama_cust."','".$nama_perusahaan."','".$alamat."',
			'".$kelurahan."','".$kecamatan."','".$kota."','".$kode_pos."','".$no_telp."','".$no_hp_1."','".$no_hp_2."','".$no_wa."','".$contact_person."','".$email."',
			'".$marketing."', '".$note."', '".$chat_wa."', '".$id_marketing."',
			NOW(),NOW(),'".$loggedin["username"]."','".$loggedin["username"]."','0');";
			//echo $insert_prospek;
			mysql_query($insert_prospek, $conn) or die ("<script language='JavaScript'>
								   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
								   window.history.go(-1);
								   </script>");
			enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert prospek = $insert_prospek");
		}
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'prospek';
		</script>";
	}elseif($update == "Save"){
	    
	    $no_prospek		= isset($_POST['no_prospek']) ? mysql_real_escape_string(trim(strip_tags($_POST['no_prospek']))) : "";
	    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim(strip_tags($_POST['tanggal']))) : "";
	    $cabang		= isset($_POST['cabang']) ? mysql_real_escape_string(trim(strip_tags($_POST['cabang']))) : "";
	    
	    $nama_cust		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim(strip_tags($_POST['nama_customer']))) : "";
	    $nama_perusahaan	= isset($_POST['nama_perusahaan']) ? mysql_real_escape_string(trim(strip_tags($_POST['nama_perusahaan']))) : "";
	    $alamat		= isset($_POST['alamat']) ? mysql_real_escape_string(trim(strip_tags($_POST['alamat']))) : "";
	    $kelurahan		= isset($_POST['kelurahan']) ? mysql_real_escape_string(trim(strip_tags($_POST['kelurahan']))) : "";
	    $kecamatan		= isset($_POST['kecamatan']) ? mysql_real_escape_string(trim(strip_tags($_POST['kecamatan']))) : "";
	    $kota		= isset($_POST['kota']) ? mysql_real_escape_string(trim(strip_tags($_POST['kota']))) : "";
	    $kode_pos		= isset($_POST['kode_pos']) ? mysql_real_escape_string(trim(strip_tags($_POST['kode_pos']))) : "";
	    $no_telp		= isset($_POST['notelp']) ? mysql_real_escape_string(trim(strip_tags($_POST['notelp']))) : "";
	    $no_hp_1		= isset($_POST['hp1']) ? mysql_real_escape_string(trim(strip_tags($_POST['hp1']))) : "";
	    $no_hp_2		= isset($_POST['hp2']) ? mysql_real_escape_string(trim(strip_tags($_POST['hp2']))) : "";
	    $contact_person	= isset($_POST['contact']) ? mysql_real_escape_string(trim(strip_tags($_POST['contact']))) : "";
	    $email		= isset($_POST['email']) ? mysql_real_escape_string(trim(strip_tags($_POST['email']))) : "";
	    $marketing		= isset($_POST['nama_marketing']) ? mysql_real_escape_string(trim(strip_tags($_POST['nama_marketing']))) : "";
	    $note			= isset($_POST['note']) ? mysql_real_escape_string(trim(strip_tags($_POST['note']))) : "";
	    $id_marketing		= isset($_POST['id_employee']) ? mysql_real_escape_string(trim(strip_tags($_POST['id_employee']))) : "";
	    $chat_wa		= isset($_POST['chat_history_wa']) ? mysql_real_escape_string(trim(strip_tags($_POST['chat_history_wa']))) : "";
		$no_wa		 	= isset($_POST['no_wa']) ? mysql_real_escape_string(trim(strip_tags($_POST['no_wa']))) : "";
		if($_GET["id_prospek"] != ""){
			$insert_prospek    	= "UPDATE `gx_prospek` SET `level`='1',
			`date_upd`=NOW(),`user_upd`='".$loggedin["username"]."' WHERE `id_prospek`='".$_GET["id_prospek"]."'";
			
			
			//echo $insert_prospek;
			mysql_query($insert_prospek, $conn) or die ("<script language='JavaScript'>
								   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
								   window.history.go(-1);
								   </script>");
			enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit prospek = $insert_prospek");
			
			$insert_prospek    	= "INSERT INTO `gx_prospek`(`id_prospek`, `no_prospek`, `tanggal`, `cabang`, `nama_cust`, `nama_perusahaan`, `alamat`,
			`kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp_1`, `no_hp_2`, `no_wa`, `contact_person`, `email`, `marketing`,
			 `note`, `chat_history_wa`, `id_marketing`,
			`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
			VALUES (NULL,'".$no_prospek."',NOW(),'".$cabang."','".$nama_cust."','".$nama_perusahaan."','".$alamat."',
			'".$kelurahan."','".$kecamatan."','".$kota."','".$kode_pos."','".$no_telp."','".$no_hp_1."','".$no_hp_2."','".$no_wa."','".$contact_person."','".$email."',
			'".$marketing."', '".$note."', '".$chat_wa."', '".$id_marketing."',
			NOW(),NOW(),'".$loggedin["username"]."','".$loggedin["username"]."','0');";
			//echo $insert_prospek;
			mysql_query($insert_prospek, $conn) or die ("<script language='JavaScript'>
								   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
								   window.history.go(-1);
								   </script>");
			enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert prospek = $insert_prospek");
		
		}
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'prospek';
		</script>";
	}

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
		<script src="'.URL.'js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
		<script type="text/javascript">
				$(function() {
					// Replace the <textarea id="editor1"> with a CKEditor
					// instance, using default configuration.
					CKEDITOR.replace(\'editor1\');
					//bootstrap WYSIHTML5 - text editor
					$(".textarea").wysihtml5();
				});
			</script>
    ';

    $title	= 'Form Prospek';
    $submenu	= "helpdesk_prospek";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>