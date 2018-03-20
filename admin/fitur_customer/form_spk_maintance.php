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
$table_main = "gx_spk_maintance";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_batal_posting` WHERE 1

//INSERT 
    //INSERT INTO `gx_batal_posting`(`id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
    $url_redirect_insert = "master_spk_maintance";
    
//UPDATE
    //UPDATE `gx_batal_posting` SET `id`=[value-1],`kode_batal_posting`=[value-2],`nama_balal`=[value-3],`kode_batal`=[value-4],`alasan_batal`=[value-5],`data_asli`=[value-6],`data_baru`=[value-7],`date_add`=[value-8],`date_upd`=[value-9],`level`=[value-10],`user_add`=[value-11],`user_upd`=[value-12] WHERE 1
    $redirect_update_data = "master_spk_maintance";
    
    
//DELETE
    //DELETE FROM `gx_batal_posting` WHERE 1


//String Data View
    //Judul Form
    $judul_form = "Form SPK Maintance";
    $header_form = "Data SPK Maintance";
    $index_field_sql = "id";
    $unix_field_sql = "kode_spk_maintance";
    $url_form_detail = "detail_spk_maintance";
    $url_form_edit = "form_spk_maintance";
    
    $form_name = "form_spk_maintance";
    $form_id = "";
    
    //id web
    $title_header = 'Master SPK Maintance';
    $submenu_header = 'master_spk_maintance';
    
    
    
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    //$							= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
   
    
    //$kode_cabang					= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $kode_spk_maintance					= isset($_POST['kode_spk_maintance']) ? mysql_real_escape_string(trim($_POST['kode_spk_maintance'])) : '';
    $tanggal						= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_cabang					= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $cabang						= isset($_POST['cabang']) ? mysql_real_escape_string(trim($_POST['cabang'])) : '';
    
    $user_id						= isset($_POST['user_id']) ? mysql_real_escape_string(trim($_POST['user_id'])) : '';
    $kode_customer					= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer					= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $no_inactive					= isset($_POST['no_inactive']) ? mysql_real_escape_string(trim($_POST['no_inactive'])) : '';
    $no_off_connection					= isset($_POST['no_off_connection']) ? mysql_real_escape_string(trim($_POST['no_off_connection'])) : '';
    $telp						= isset($_POST['telp']) ? mysql_real_escape_string(trim($_POST['telp'])) : '';
    $kode_teknisi					= isset($_POST['kode_teknisi']) ? mysql_real_escape_string(trim($_POST['kode_teknisi'])) : '';
    $teknisi						= isset($_POST['teknisi']) ? mysql_real_escape_string(trim($_POST['teknisi'])) : '';
    $alamat						= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    $pekerjaan						= isset($_POST['pekerjaan']) ? mysql_real_escape_string(trim($_POST['pekerjaan'])) : '';
    
	
    if($kode_spk_maintance != ""){
    //insert into cc_subscription_service
    //'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0'
  
    //$sql_insert = "INSERT INTO `gx_batal_posting`(`id`, `kode_batal_posting`, `nama_batal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    //VALUES (NULL,'$kode_batal_posting','$nama_batal','$kode_batal','$alasan_batal','$data_asli','$data_baru',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
	
	$j = 0;     // Variable for indexing uploaded image.
	$target_path 	= "../upload/email/";     // Declaring Path for uploaded images.
	$lokasi	    	= 'upload/email/';
	
    
    /*
    $sql_insert = "INSERT INTO `software`.`gx_reaktivasi_customer` (`id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_reaktivasi`, `kode_customer`, `nama_customer`, `user_id`, `no_inactive`, `status_inactive`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL, '".$kode_cabang."', '".$nama_cabang."', NOW(), '".$kode_reaktivasi."', '".$kode_customer."', '".$nama_customer."', '".$user_id."', '".$no_inactive."', '".$status_inactive."', '".$remarks."', '".$kode_cso."', '".$request."', '".$foto_email."', '".$no_formulir."', '0', NOW(), NOW(), '0', '".$loggedin['username']."', '".$loggedin['username']."')";
    //echo $sql_insert."<br>";
    */
    
    $sql_insert = "INSERT INTO `gx_spk_maintance`(`id`, `kode_spk_maintance`, `tanggal`,`kode_cabang`, `cabang`, `user_id`, `kode_customer`, `nama_customer`, `no_inactive`, `no_off_connection`, `telp`, `teknisi`, `alamat`, `pekerjaan`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL,'".$kode_spk_maintance."','".$tanggal."','".$kode_cabang."','".$cabang."','".$user_id."','".$kode_customer."','".$nama_customer."','".$no_inactive."','".$no_off_connection."','".$telp."','".$teknisi."','".$alamat."','".$pekerjaan."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
    
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
    
    $kode_spk_maintance					= isset($_POST['kode_spk_maintance']) ? mysql_real_escape_string(trim($_POST['kode_spk_maintance'])) : '';
    $tanggal						= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_cabang					= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $cabang						= isset($_POST['cabang']) ? mysql_real_escape_string(trim($_POST['cabang'])) : '';
    
    $user_id						= isset($_POST['user_id']) ? mysql_real_escape_string(trim($_POST['user_id'])) : '';
    $kode_customer					= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer					= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $no_inactive					= isset($_POST['no_inactive']) ? mysql_real_escape_string(trim($_POST['no_inactive'])) : '';
    $no_off_connection					= isset($_POST['no_off_connection']) ? mysql_real_escape_string(trim($_POST['no_off_connection'])) : '';
    $telp						= isset($_POST['telp']) ? mysql_real_escape_string(trim($_POST['telp'])) : '';
    $kode_teknisi					= isset($_POST['kode_teknisi']) ? mysql_real_escape_string(trim($_POST['kode_teknisi'])) : '';
    $teknisi						= isset($_POST['teknisi']) ? mysql_real_escape_string(trim($_POST['teknisi'])) : '';
    $alamat						= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    $pekerjaan						= isset($_POST['pekerjaan']) ? mysql_real_escape_string(trim($_POST['pekerjaan'])) : '';
    
    
    
    if($c != ""){
	
	//UPDATE INTO GX PENGELUARAN
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	$data_array_select 	= mysql_fetch_array(mysql_query("SELECT `id` FROM `gx_reaktivasi_customer` WHERE `kode_reaktivasi`='".$c."' ORDER BY `id` DESC LIMIT 0,1", $conn));
	$id			= $data_array_select['id'];
	
	
	/*	
	$sql_update = "UPDATE `gx_reaktivasi_customer` SET `date_upd`=NOW(),`level`='1',`user_upd`='".$loggedin['username']."' WHERE  `kode_reaktivasi`='".$c."'";
	$sql_update_file = "UPDATE `gx_reaktivasi_customer_image_email` SET `date_upd`=NOW(),`level`='1',`user_upd`='".$loggedin['username']."' WHERE `kode_reaktivasi`='".$c."'";
	*/
	
	$sql_update = "UPDATE `gx_spk_maintance` SET `date_upd`=NOW(),`level`='1',`user_upd`='".$loggedin['username']."' WHERE  `kode_spk_maintance`='".$c."'";
	
	$sql_insert = "INSERT INTO `gx_spk_maintance`(`id`, `kode_spk_maintance`, `tanggal`,`kode_cabang`, `cabang`, `user_id`, `kode_customer`, `nama_customer`, `no_inactive`, `no_off_connection`, `telp`, `kode_teknisi`, `teknisi`, `alamat`, `pekerjaan`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
	VALUES (NULL,'".$kode_spk_maintance."','".$tanggal."','".$kode_cabang."','".$cabang."','".$user_id."','".$kode_customer."','".$nama_customer."','".$no_inactive."','".$no_off_connection."','".$telp."','".$kode_teknisi."','".$teknisi."','".$alamat."','".$pekerjaan."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
	//echo $sql_insert."<br>";

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
				    
					<input type="hidden" class="form-control" name="kode_teknisi" value="'.(isset($_GET['c']) ? $row['kode_teknisi'] : '').'">
					<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['c']) ? $row['kode_cabang'] : '').'">
							       
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No SPK Maintance</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text" class="form-control" required="" name="kode_spk_maintance" value="'.(isset($_GET['c']) ? $row["kode_spk_maintance"] : "SMT-".rand(0000000, 9999999)).'">
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text" class="form-control" required="" name="tanggal" value="'.(isset($_GET['c']) ? $row["tanggal"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					   
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" required="" type="text"  class="form-control" name="cabang" value="'.(isset($_GET['c']) ? $row["cabang"] : '').'" onclick="return valideopenerform(\'data_cabang.php?r=form_spk_maintance&f=data_spk_maintance\',\'cabang\');" >
					    </div>
					    <div class="col-xs-2">
						<label>User ID</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" required="" class="form-control" name="user_id" value="'.(isset($_GET['c']) ? $row["user_id"] : '').'" onclick="return valideopenerform(\'data_customer.php?r=form_spk_maintance&f=data_spk_maintance\',\'user_id\');">
					    </div>
                                        </div>
					</div>
					
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" required="" type="text"  class="form-control" name="kode_customer" value="'.(isset($_GET['c']) ? $row["kode_customer"] : '').'">
					    </div>
					    <div class="col-xs-2">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" required="" class="form-control" name="nama_customer" value="'.(isset($_GET['c']) ? $row["nama_customer"] : '').'">
					    </div>
                                        </div>
					</div>
					
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Inactive</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" required="" class="form-control" name="no_inactive" value="'.(isset($_GET['c']) ? $row["no_inactive"] : '' ).'">
					    </div>
					    <div class="col-xs-2">
						<label>No Off Connection</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" required="" class="form-control" name="no_off_connection" value="'.(isset($_GET['c']) ? $row["no_off_connection"] : '').'" onclick="return valideopenerform(\'data_off_connection.php?r=form_spk_maintance&f=data_spk_maintance\',\'off_connection\');">
					    </div>
                                        </div>
					</div>					

					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						    <label>Telpon</label>
					    </div>
					    <div class="col-xs-4">
						    <input type="text" required="" readonly="" class="form-control" name="telp" value="'.(isset($_GET['c']) ? $row["telp"] : '').'">
					    </div>
					    <div class="col-xs-2">
						    <label>Teknisi</label>
					    </div>
					    <div class="col-xs-4">
						    <input type="text" required="" readonly="" class="form-control" name="teknisi" value="'.(isset($_GET['c']) ? $row["teknisi"] : '').'" onclick="return valideopenerform(\'data_teknisi.php?r=form_spk_maintance&f=data_spk_maintance\',\'teknisi\');">
					    </div>
					</div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-10">
						<input required="" readonly="" type="text" class="form-control" name="alamat" value="'.(isset($_GET['c']) ? $row["alamat"] : '').'">
					    </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Pekerjaan</label>
					    </div>
					    <div class="col-xs-12">
						<textarea required="" class="form-control" name="pekerjaan">'.(isset($_GET['c']) ? $row["pekerjaan"] : '').'</textarea>
					    </div>

                                        </div>
					</div>
					
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
        </script>
	<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
	<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: \'\',
		thousandsSeparator: \',\',
		centsLimit: 0
	    });
        </script>
		
		<script language="javascript">
			var abc = 0;      // Declaring and defining global increment variable.
			$(document).ready(function() {
			//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
				$(\'#add_more\').click(function() {
					$(this).before($("<div/>", {
						id: \'filediv\'
					}).fadeIn(\'slow\').append($("<input/>", {
						name: \'file[]\',
						type: \'file\',
						id: \'file\'
					}), $("")));
				});
			// Following function will executes on change event of file input to select different file.
				$(\'body\').on(\'change\', \'#file\', function() {
					if (this.files && this.files[0]) {
						abc += 1; // Incrementing global variable by 1.
						var z = abc - 1;
						var x = $(this).parent().find(\'#previewimg\' + z).remove();
						$(this).before("<div id=\'abcd" + abc + "\' class=\'abcd\'><img id=\'previewimg" + abc + "\' src=\'\'/></div>");
						var reader = new FileReader();
						reader.onload = imageIsLoaded;
						reader.readAsDataURL(this.files[0]);
						$(this).hide();
						$("#abcd" + abc).append($("<img/>", {
							id: \'img\',
							src: \''.URL_ADMIN.'img/x.png\',
							alt: \'delete\'
						}).click(function() {
							$(this).parent().parent().remove();
						}));
					}
				});
			// To Preview Image
				function imageIsLoaded(e) {
					$(\'#previewimg\' + abc).attr(\'src\', e.target.result);
				};
				$(\'#upload\').click(function(e) {
					var name = $(":file").val();
					if (!name) {
						alert("First Image Must Be Selected");
						e.preventDefault();
					}
			});
		});
	    </script>
	    <style type="text/css">

		#img{
		width:25px;
		border:none;
		height:25px;
		margin-left:-20px;
		margin-bottom:91px
		}
		.abcd{
		width: 120px;
		float:left;
		}
		.abcd img{
		height:100px;
		width:100px;
		padding:5px;
		border:1px solid #e8debd
		}
	    </style>
	';

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