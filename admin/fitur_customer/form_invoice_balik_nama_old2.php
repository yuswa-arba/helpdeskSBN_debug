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
$table_main = "gx_invoice_balik_nama";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_batal_posting` WHERE 1

//INSERT 
    //INSERT INTO `gx_batal_posting`(`id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
    $url_redirect_insert = "master_invoice_balik_nama";
    
//UPDATE
    //UPDATE `gx_batal_posting` SET `id`=[value-1],`kode_batal_posting`=[value-2],`nama_balal`=[value-3],`kode_batal`=[value-4],`alasan_batal`=[value-5],`data_asli`=[value-6],`data_baru`=[value-7],`date_add`=[value-8],`date_upd`=[value-9],`level`=[value-10],`user_add`=[value-11],`user_upd`=[value-12] WHERE 1
    $redirect_update_data = "master_invoice_balik_nama";
    
    
//DELETE
    //DELETE FROM `gx_batal_posting` WHERE 1


//String Data View
    //Judul Form
    $judul_form = "Form Invoice Balik Nama";
    $header_form = "Data Invoice Balik Nama";
    $index_field_sql = "id";
    $unix_field_sql = "kode_invoice";
    $url_form_detail = "detail_invoice_balik_nama";
    $url_form_edit = "form_invoice_balik_nama";
    
    $form_name = "form_invoice_balik_nama";
    $form_id = "";
    
    //id web
    $title_header = 'Master Invoice Balik Nama';
    $submenu_header = 'master_invoice_balik_nama';
    
    

    
    
    
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
	
    if(isset($_POST['save']) || isset($_POST['update'])){
	
	$kode_balik_nama		= isset($_POST['kode_balik_nama']) ? mysql_real_escape_string(trim($_POST['kode_balik_nama'])) : '';
	$nama_pelanggan			= isset($_POST['nama_pelanggan']) ? mysql_real_escape_string(trim($_POST['nama_pelanggan'])) : '';
	$periode_tagihan		= isset($_POST['periode_tagihan']) ? mysql_real_escape_string(trim($_POST['periode_tagihan'])) : '';
	$kode_customer			= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
	$tanggal_tagihan		= isset($_POST['tanggal_tagihan']) ? mysql_real_escape_string(trim($_POST['tanggal_tagihan'])) : '';
	$kode_invoice			= isset($_POST['kode_invoice']) ? mysql_real_escape_string(trim($_POST['kode_invoice'])) : '';
	$tanggal_jatuh_tempo		= isset($_POST['tanggal_jatuh_tempo']) ? mysql_real_escape_string(trim($_POST['tanggal_jatuh_tempo'])) : '';
	$npwp				= isset($_POST['npwp']) ? mysql_real_escape_string(trim($_POST['npwp'])) : '';
	$no_virtual_account_bca		= isset($_POST['no_virtual_account_bca']) ? mysql_real_escape_string(trim($_POST['no_virtual_account_bca'])) : '';
	$no_faktur_pajak		= isset($_POST['no_faktur_pajak']) ? mysql_real_escape_string(trim($_POST['no_faktur_pajak'])) : '';
	$nama_virtual_account		= isset($_POST['nama_virtual_account']) ? mysql_real_escape_string(trim($_POST['nama_virtual_account'])) : '';
	$note				= isset($_POST['note']) ? mysql_real_escape_string(trim($_POST['note'])) : '';
	$invoice_change_name		= isset($_POST['invoice_change_name']) ? mysql_real_escape_string(trim($_POST['invoice_change_name'])) : '';
	$invoice_total			= isset($_POST['invoice_total']) ? mysql_real_escape_string(trim($_POST['invoice_total'])) : '';
	$invoice_ppn			= isset($_POST['invoice_ppn']) ? mysql_real_escape_string(trim($_POST['invoice_ppn'])) : '';
	$invoice_grand_total		= isset($_POST['invoice_grand_total']) ? mysql_real_escape_string(trim($_POST['invoice_grand_total'])) : '';
	$invoice_uang_muka		= isset($_POST['invoice_uang_muka']) ? mysql_real_escape_string(trim($_POST['invoice_uang_muka'])) : '';
	$invoice_sisa			= isset($_POST['invoice_sisa']) ? mysql_real_escape_string(trim($_POST['invoice_sisa'])) : '';
	
    
    $field_insert_sql = "`id`, `kode_balik_nama`, `nama_pelanggan`, `periode_tagihan`, `kode_customer`, `tanggal_tagihan`, `kode_invoice`, `tanggal_jatuh_tempo`, `npwp`, `no_virtual_account_bca`, `no_faktur_pajak`, `nama_virtual_account`, `note`, `invoice_change_name`, `invoice_total`, `invoice_ppn`, `invoice_grand_total`, `invoice_uang_muka`, `invoice_sisa`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`";
    $value_insert_sql = "NULL,'".$kode_balik_nama."','".$nama_pelanggan."','".$periode_tagihan."','".$kode_customer."','".$tanggal_tagihan."','".$kode_invoice."','".$tanggal_jatuh_tempo."','".$npwp."','".$no_virtual_account_bca."','".$no_faktur_pajak."','".$nama_virtual_account."','".$note."','".$invoice_change_name."','".$invoice_total."','".$invoice_ppn."','".$invoice_grand_total."','".$invoice_uang_muka."','".$invoice_sisa."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."'";
    $post_c = $kode_balik_nama;
    }
    	
	
    
if(isset($_POST["save"]))
{
    //$							= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';

    if($post_c != ""){
    //insert into cc_subscription_service
    //'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0'
  
    $sql_insert = "INSERT INTO `".$table_main."`(".$field_insert_sql.")
    VALUES (".$value_insert_sql.")";
	
    
//    echo $sql_insert."<br>";

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
    //$ = isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    
    $id 						= isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c 							= isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';							

        
    if($c != ""){
	
	//UPDATE INTO GX PENGELUARAN
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	$data_array_select 	= mysql_fetch_array(mysql_query("SELECT `".$index_field_sql."` FROM `".$table_main."` WHERE `".$unix_field_sql."`='".$c."' ORDER BY `".$index_field_sql."` DESC LIMIT 0,1", $conn));
	$id			= $data_array_select['id'];
	
	/*$sql_update = "UPDATE `gx_setting_jadwal_pegawai` SET `date_upd`=NOW(),`level`='1',`user_upd`='$loggedin[username]' WHERE `id`='$id'";*/
	$sql_update = "UPDATE `".$table_main."` SET `date_upd`=NOW(),`level`='1',`user_upd`='".$loggedin['username']."' WHERE  `".$index_field_sql."`='".$id."'";
	$sql_insert = "INSERT INTO `".$table_main."`(".$field_insert_sql.")
	VALUES (".$value_insert_sql.")";
	
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
	    window.location.href='".$redirect_update_data."';
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
    $c		= isset($_GET['c']) ? $_GET['c'] : '';
    /*$query_pengeluaran_barang = "SELECT `id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaaan`, `nama_pemohon`, `nama_cabang`, `divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pengeluaran_barang` WHERE `id_pengeluaran_barang` ='".$id_pengeluaran_barang."' LIMIT 0,1;";*/
    $query 	= "SELECT * FROM `".$table_main."` WHERE  `".$unix_field_sql."` ='".$c."' ORDER BY `".$index_field_sql."` DESC LIMIT 0,1"; 
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
				    $content.=' <div class="col-xs-2">
						<label>Kode Balik Nama</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="kode_balik_nama" value="'.(isset($_GET['c']) ? $row["kode_balik_nama"] : '').'" onclick="return valideopenerform(\'data_balik_nama.php?r=form_invoice_balik_nama&f=data_balik_nama\',\'balik_nama\');">
						
					    </div>
					    <div class="col-xs-2">
						<label>Nama Pelanggan</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_pelanggan" value="'.(isset($_GET['c']) ? $row["nama_pelanggan"] : '').'"  onclick="return valideopenerform(\'data_customer.php?r=form_invoice_balik_nama&f=data_invoice_balik_nama\',\'customer\');">
					    </div>
					  
					    ';
					    //'.(isset($_GET['c']) ? $row["kode_cabang"] : "CAB-".rand(0000000, 9999999) ).'
					$content .= '
					  
                                        </div>
					</div>
					
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Periode Tagihan</label>
					    </div>
					    <div class="col-xs-3">
						<input  type="text" class="form-control" required="" name="periode_tagihan" value="'.(isset($_GET['c']) ? $row["periode_tagihan"] : '').'">
					    </div>
					  
					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input readonly="" type="text" class="form-control" required="" name="kode_customer" value="'.(isset($_GET['c']) ? $row["kode_customer"] : '').'">
					    </div>
                                        </div>
					</div>
					   
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Tanggal Tagihan</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" name="tanggal_tagihan" value="'.(isset($_GET['c']) ? $row["tanggal_tagihan"] : '').'">
					    </div>
					    <div class="col-xs-2">
						<label>Kode Invoice</label>
					    </div>
					    <div class="col-xs-3">
						<input readonly="" type="text"  class="form-control" name="kode_invoice" value="'.(isset($_GET['c']) ? $row["kode_invoice"] : "INV-".rand(000000,999999)).'">
					    </div>
                                        </div>
					</div>
					
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Tanggal Jatuh Tempo</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" name="tanggal_jatuh_tempo" value="'.(isset($_GET['c']) ? $row["tanggal_jatuh_tempo"] : '').'">
					    </div>

					    <div class="col-xs-2">
						<label>NPWP</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" name="npwp" value="'.(isset($_GET['c']) ? $row["npwp"] : '').'">
					    </div>
                                        </div>
					</div>
					
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Virtual Account BCA</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" name="no_virtual_account_bca" value="'.(isset($_GET['c']) ? $row["no_virtual_account_bca"] : '').'">
					    </div>

					    <div class="col-xs-2">
						<label>Nama Virtual Account</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" name="nama_virtual_account" value="'.(isset($_GET['c']) ? $row["nama_virtual_account"] : '').'">
					    </div>
					</div>
					</div>
					
                                        <div class="form-group">
					<div class="row">    
					    <div class="col-xs-2">
						<label>No Faktur Pajak</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" name="no_faktur_pajak" value="'.(isset($_GET['c']) ? $row["no_faktur_pajak"] : '').'">
					    </div>    
					    <div class="col-xs-2">
						<label>Note</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" name="note" value="'.(isset($_GET['c']) ? $row["note"] : '').'">
					    </div>
                                        </div>
					</div>
					    
						<input type="hidden"  class="form-control" name="invoice_sisa" value="'.(isset($_GET['c']) ? $row["invoice_sisa"] : '1140000').'">
						<input type="hidden"  class="form-control" name="invoice_uang_muka" value="'.(isset($_GET['c']) ? $row["invoice_uang_muka"] : '1250000').'">
						<input type="hidden"  class="form-control" name="invoice_ppn" value="'.(isset($_GET['c']) ? $row["invoice_ppn"] : '10000').'">
						<input type="hidden"  class="form-control" name="invoice_grand_total" value="'.(isset($_GET['c']) ? $row["invoice_grand_total"] : '110000').'">
						<input type="hidden"  class="form-control" name="invoice_change_name" value="'.(isset($_GET['c']) ? $row["invoice_change_name"] : '100000').'">
						<input type="hidden"  class="form-control" name="invoice_total" value="'.(isset($_GET['c']) ? $row["invoice_total"] : '100000').'">
					
                                        <!--<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Invoice Change Name</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" name="invoice_change_name" value="'.(isset($_GET['c']) ? $row["invoice_change_name"] : '').'">
					    </div>

					    <div class="col-xs-2">
						<label>Invoice Total</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" name="invoice_total" value="'.(isset($_GET['c']) ? $row["invoice_total"] : '').'">
					    </div>
    
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Invoice PPN</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" name="invoice_ppn" value="'.(isset($_GET['c']) ? $row["invoice_ppn"] : '').'">
					    </div>
					    
					    <div class="col-xs-2">
						<label>Invoice Grand Total</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" name="invoice_grand_total" value="'.(isset($_GET['c']) ? $row["invoice_grand_total"] : '').'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">

					    <div class="col-xs-2">
						<label>Invoice Uang Muka</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" name="invoice_uang_muka" value="'.(isset($_GET['c']) ? $row["invoice_uang_muka"] : '').'">
					    </div>
					    
					    <div class="col-xs-2">
						<label>Invoice Sisa</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" name="invoice_sisa" value="'.(isset($_GET['c']) ? $row["invoice_sisa"] : '').'">
					    </div>

					    
                                        </div>
					</div>-->
					
					
					</div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['c']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
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