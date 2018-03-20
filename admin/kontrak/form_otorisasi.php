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
     
//SQL 
$table_main = "`gx_otorisasi`";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_kontrak` WHERE 1


//INSERT 
    //INSERT INTO `gx_kontrak`(`id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15])
    $url_redirect_insert = "form_otorisasi";
    
//UPDATE
    //UPDATE `gx_kontrak` SET `id`=[value-1],`kode_kontrak`=[value-2],`kode_cabang`=[value-3],`nama_cabang`=[value-4],`kode_customer`=[value-5],`nama_customer`=[value-6],`lama_kontrak`=[value-7],`periode_kontrak_mulai`=[value-8],`periode_kontrak_akhir`=[value-9],`tanggal`=[value-10],`date_add`=[value-11],`date_upd`=[value-12],`level`=[value-13],`user_add`=[value-14],`user_upd`=[value-15] WHERE 1
    $redirect_update_data = "form_otorisasi";
    
    
//DELETE
    //DELETE FROM `gx_kontrak` WHERE `id`


//String Data View
    //Judul Form
    $judul_form = "Otorisasi";
    $header_form = "Form Otorisasi";
    $unix_field_sql = "kode_otoriasi";
    $url_form_detail = "form_otorisasi";
    $url_form_edit = "form_otorisasi";
    $form_name = "form_otorisasi";
    $form_id = "form_otorisasi";
    $check_input_id = "kode_otorisasi";
    
    //id web
    $title_header = 'Master Otorisasi';
    $submenu_header = 'form_otorisasi';
    
    
    
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    //$							= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $kode 						= isset($_POST[$check_input_id]) ? mysql_real_escape_string(trim($_POST[$check_input_id])) : '';
    
    $kode_otorisasi					= isset($_POST['kode_otorisasi']) ? mysql_real_escape_string(trim($_POST['kode_otorisasi'])) : '';
    $kode_pengedit					= isset($_POST['kode_pegawai']) ? mysql_real_escape_string(trim($_POST['kode_pegawai'])) : '';
    $nama_pengedit					= isset($_POST['nama_pengedit']) ? mysql_real_escape_string(trim($_POST['nama_pengedit'])) : '';
    $nama_otorisasi					= isset($_POST['nama_otorisasi']) ? mysql_real_escape_string(trim($_POST['nama_otorisasi'])) : '';
    
    
    
    
    if($kode != ""){
    //insert into cc_subscription_service
    //'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0'
    $sql_insert = "INSERT INTO `gx_otorisasi`(`id`, `kode_otorisasi`, `kode_pengedit`, `nama_pengedit`, `nama_otorisasi`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL,'$kode_otorisasi','$kode_pengedit','$nama_pengedit','$nama_otorisasi','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
    
    //echo $sql_insert."<br>";

    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    $id_insert = mysql_insert_id($conn);
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".$url_redirect_insert."';
	</script>";
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
}elseif(isset($_POST["update"]))
{
    //$							= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $kode 						= isset($_POST[$check_input_id]) ? mysql_real_escape_string(trim($_POST[$check_input_id])) : '';
    
    $kode_otorisasi					= isset($_POST['kode_otorisasi']) ? mysql_real_escape_string(trim($_POST['kode_otorisasi'])) : '';
    $kode_pengedit					= isset($_POST['kode_pegawai']) ? mysql_real_escape_string(trim($_POST['kode_pegawai'])) : '';
    $nama_pengedit					= isset($_POST['nama_pengedit']) ? mysql_real_escape_string(trim($_POST['nama_pengedit'])) : '';
    $nama_otorisasi					= isset($_POST['nama_otorisasi']) ? mysql_real_escape_string(trim($_POST['nama_otorisasi'])) : '';
    
    
    if($kode != ""){
	
	//UPDATE INTO GX PENGELUARAN
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	$search_data_last = mysql_fetch_array(mysql_query("SELECT * FROM `gx_otorisasi` WHERE `kode_otorisasi`='".$kode_otorisasi."' AND `level`='0' ORDER BY `id` DESC LIMIT 1", $conn));
	$sql_update = "UPDATE `gx_otorisasi` SET `level`='1' WHERE `id`='".$search_data_last['id']."'";
	
	$sql_insert = "INSERT INTO `gx_otorisasi`(`id`, `kode_otorisasi`, `kode_pengedit`, `nama_pengedit`, `nama_otorisasi`, `status`, `checklist`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
	VALUES (NULL,'$kode_otorisasi','$kode_pengedit','$nama_pengedit','$nama_otorisasi','0','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
	
	
	
	//echo $sql_update;
	mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
       
	//echo $sql_update;
	mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
       
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
	
    
	echo "<script language='JavaScript'>
	    alert('Data telah diupdate.');
	    window.location.href='".$redirect_update_data."?c=".$_GET['c']."';
	    </script>";
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
}

if(isset($_GET["c"]))
{
    $id		= isset($_GET['id']) ? $_GET['id'] : '';
    /*$query_pengeluaran_barang = "SELECT `id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaaan`, `nama_pemohon`, `nama_cabang`, `divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pengeluaran_barang` WHERE `id_pengeluaran_barang` ='".$id_pengeluaran_barang."' LIMIT 0,1;";*/
    $query 	= "SELECT * FROM `gx_otorisasi` WHERE  `kode_otorisasi` ='".$_GET['c']."' ORDER BY `id` DESC LIMIT 0,1"; 
    $sql	= mysql_query($query, $conn);
    $row	= mysql_fetch_array($sql);

}

    $content = '<section class="content-header">
                    <h1>
                        '.$judul_form.'
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-12"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">'.$header_form.'</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="'.$form_name.'" id="'.$form_id.'" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
				    
				    
                                        <div class="form-group">
					<div class="row">';
				    $content.=' <div class="col-xs-3">
						<label>No. Otorisasi</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" readonly="" class="form-control" required="" name="kode_otorisasi" value="'.(isset($_GET['c']) ? $row["kode_otorisasi"] : "O-".rand(000000,999999)).'">
						<input type="hidden" readonly="" class="form-control" required="" name="kode" value="'.(isset($_GET['c']) ? $_GET['c'] : '').'">
						<input type="hidden" readonly="" class="form-control" required="" name="id" value="'.(isset($_GET['c']) ? $row["id"] : '').'">
					    </div>';
					$content .='
                                        </div>
					</div>
					
					
                                        <div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Nama Pengedit</label>
					    </div>
					    <div class="col-xs-9">
						<input type="hidden" class="form-control" required="" name="kode_pegawai" value="'.(isset($_GET['c']) ? $row["kode_pengedit"] : "").'">
					    	<input type="text" readonly="" class="form-control" required="" name="nama_pengedit" value="'.(isset($_GET['c']) ? $row["nama_pengedit"] : "").'" onclick="return valideopenerform(\'data_pegawai.php?r=form_otorisasi&f=data_pegawai\',\'pegawai\');">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Nama Otorisasi</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" readonly="" class="form-control"  required="" name="nama_otorisasi" id="nama_otorisasi" value="'.$loggedin['username'].'"  >
					    </div>
					</div>
					</div>
					
					
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['c']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
				
				
				
				
				 <table style="width:100%;">
					<tbody>
					    
					    <tr>
						<td colspan="2">&nbsp;</td>
					    </tr>
					    <tr>
						<td colspan="2">
					    <table width="100%" cellspacing="10" class="table table-bordered table-striped">
							    <tbody>
							    <tr>
							      <th>
								  No.
							      </th>
							      <th>
								  Data Lama
							      </th>
							      <th>
								  Data Baru
							      </th>
							      <th>
								  Nama Pemohon
							      </th>
							      <th>
								  Check List
							      </th>
							    </tr>';
			  
				//$kode = isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
				//SELECT `id_pengeluaran_barang_detail`, `kode_pengeluaran`, `kode_barang`, `nama_barang`, `serial_number`, `quantity`, `kode_lemari`, `nama_lemari`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pengeluaran_barang_detail` WHERE 1
				
				$sql = "SELECT DISTINCT `kode_otorisasi` FROM `gx_otorisasi` ORDER BY `id` DESC";
				$query = mysql_query($sql, $conn);
				
				//echo $query_pengeluaran_item;
				
				$no = 1;
				
				while($row = mysql_fetch_array($query))
				{
				    $sql_d_1 = mysql_fetch_array(mysql_query("SELECT * FROM `gx_otorisasi` WHERE `kode_otorisasi`='$row[kode_otorisasi]' AND `level`='1'", $conn));
				    $sql_d_2 = mysql_fetch_array(mysql_query("SELECT * FROM `gx_otorisasi` WHERE `kode_otorisasi`='$row[kode_otorisasi]' AND `level`='0'", $conn));
				    
				    //SELECT `id_employee`, `id_cabang`, `id_bagian`, `kode_pegawai`, `nama`, `alamat`, `email`, `hp`, `no_ktp`, `tgl_masuk`, `tgl_lahir`, `contact_person`, `nama_cp`, `alamat_cp`, `hubungan_cp`, `id_level`, `ptkp`, `sex`, `no_koperasi`, `no_hp`, `agama`, `status`, `account_bank`, `nama_bank`, `no_acc`, `nama_pemilik`, `kota`, `ext_voip`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pegawai`
				    $data_pegawai_lama = mysql_fetch_array(mysql_query("SELECT * FROM `gx_pegawai` WHERE `kode_pegawai`='".$sql_d_1['kode_pengedit']."'", $conn));
				    $data_pegawai_baru = mysql_fetch_array(mysql_query("SELECT * FROM `gx_pegawai` WHERE `kode_pegawai`='".$sql_d_2['kode_pengedit']."'", $conn));
				    
				    $link_check_list_on = isset($_GET['c']) ? '<a href="c='.$_GET['c'].'&checklist=on">Check</a>' : '';
				    $link_check_list_off = isset($_GET['c']) ? '<a href="c='.$_GET['c'].'&checklist=off">Uncheck</a>' : '';
				    
				    $content .= '<tr>
				    <td>'.$no.'.</td>
				    <td>'.($sql_d_1["kode_pengedit"] != '' ? "Kode Pengedit : ".$sql_d_1["kode_pengedit"]."<br>"."Nama : ".$data_pegawai_lama['nama']."<br>Alamat : ".$data_pegawai_lama['alamat']."<br>hp : ".$data_pegawai_lama['hp']."" : '-').'</td>
				    
				    <td>'.($sql_d_2["kode_pengedit"] != '' ? "Kode Pengedit : ".$sql_d_2["kode_pengedit"]."<br>"."Nama : ".$data_pegawai_baru['nama']."<br>Alamat : ".$data_pegawai_baru['alamat']."<br>hp : ".$data_pegawai_baru['hp']."" : '-').'</td>
				    
				    <td>'.$sql_d_2["nama_pengedit"].'</td>
				    <td>'.($sql_d_2['checklist'] == '1' ? $link_check_list_on : $link_check_list_off).' 
				    </td>
				    </tr>';
				    $no++;
				}
			  
			    $content .= '
					     
					    </tbody></table>
					    
					     
					    </td>
					    </tr>
					</tbody></table>
				
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                 $("#datepicker2").datepicker({format: "yyyy-mm-dd"});
            });
        </script>';

    $title	= $title_header;
    $submenu	= $submenu_header;
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