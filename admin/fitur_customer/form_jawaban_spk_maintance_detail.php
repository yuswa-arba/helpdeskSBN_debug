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
$table_main = "gx_jawaban_spk_maintance";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_batal_posting` WHERE 1

//INSERT 
    //INSERT INTO `gx_batal_posting`(`id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
    $url_redirect_insert = "form_jawaban_spk_maintance_detail";
    
//UPDATE
    //UPDATE `gx_batal_posting` SET `id`=[value-1],`kode_batal_posting`=[value-2],`nama_balal`=[value-3],`kode_batal`=[value-4],`alasan_batal`=[value-5],`data_asli`=[value-6],`data_baru`=[value-7],`date_add`=[value-8],`date_upd`=[value-9],`level`=[value-10],`user_add`=[value-11],`user_upd`=[value-12] WHERE 1
    $redirect_update_data = "form_jawaban_spk_maintance_detail";
    
    
//DELETE
    //DELETE FROM `gx_batal_posting` WHERE 1


//String Data View
    //Judul Form
    $judul_form = "Form Jawaban SPK Maintance Detail";
    $header_form = "Data Jawaban SPK Maintance Detail";
    $index_field_sql = "id";
    $unix_field_sql = "kode_jawaban_spk_maintance";
    $url_form_detail = "detail_jawaban_spk_maintance";
    $url_form_edit = "form_jawaban_spk_maintance";
    
    $form_name = "form_jawaban_spk_maintance_detail";
    $form_id = "form_jawaban_spk_maintance_detail";
    
    $form_name_2 = "form_list_alat";
    $form_id_2 = "";
    //id web
    $title_header = 'Master Jawaban SPK Maintance';
    $submenu_header = 'master_jawaban_spk_maintance';
    
    
    
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
   //$							= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $kode_list_alat							= isset($_POST['kode_list_alat']) ? mysql_real_escape_string(trim($_POST['kode_list_alat'])) : '';
    $kode_barang							= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang							= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $qty								= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $no_seri_number							= isset($_POST['no_seri_number']) ? mysql_real_escape_string(trim($_POST['no_seri_number'])) : '';
    
	
    if($kode_list_alat != ""){
    
    /*
    $sql_insert = "INSERT INTO `software`.`gx_inactive_customer` (`id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_inactive`, `kode_customer`, `nama_customer`, `user_id`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL, '".$kode_cabang."', '".$nama_cabang."', NOW(), '".$kode_inactive."', '".$kode_customer."', '".$nama_customer."', '".$user_id."', '".$remarks."', '".$kode_cso."', '".$request."', '".$foto_email."', '".$no_formulir."', '0', NOW(), NOW(), '0', '".$loggedin['username']."', '".$loggedin['username']."')";
    */
    //echo $sql_insert."<br>";
    $c = isset($_GET['c']) ? $_GET['c'] : '';
    /*
    $sql_insert = "INSERT INTO `gx_jawaban_spk_maintance`(`id`, `no_spk_maintance`, `tanggal`, `kode_jawaban_spk_maintance`, `kode_customer`, `nama_customer`, `kode_cabang`, `cabang`, `user_id`, `telp`, `alamat`, `kode_teknisi_1`, `teknisi_1`, `kode_teknisi_2`, `teknisi_2`, `kode_teknisi_3`, `teknisi_3`, `kode_teknisi_4`, `teknisi_4`, `kode_teknisi_5`, `teknisi_5`, `status_spk`, `pekerjaan`, `solusi`, `kode_list_alat`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
    VALUES (NULL, '".$no_spk_maintance."','".$tanggal."','".$kode_jawaban_spk_maintance."','".$kode_customer."','".$nama_customer."','".$kode_cabang."','".$cabang."','".$user_id."','".$telp."','".$alamat."','".$kode_teknisi_1."','".$teknisi_1."','".$kode_teknisi_2."','".$teknisi_2."','".$kode_teknisi_3."','".$teknisi_3."','".$kode_teknisi_4."','".$teknisi_4."','".$kode_teknisi_5."','".$teknisi_5."','".$status_spk."','".$pekerjaan."','".$solusi."','".$kode_list_alat."','0',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";
    */
    
    $sql_insert = "INSERT INTO `gx_jawaban_spk_maintance_list_alat`(`id`, `kode_jawaban_spk_maintance`, `kode_list_alat`, `kode_barang`, `nama_barang`, `qty`, `no_seri_number`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
    VALUES (NULL,'".$c."','".$kode_list_alat."','".$kode_barang."','".$nama_barang."','".$qty."','".$no_seri_number."','0',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";
    
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    $id_insert = mysql_insert_id($conn);
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".$url_redirect_insert."?c=".$c."';
	</script>";
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database (error statement), Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
}elseif(isset($_POST["update"]))
{
    //$ = isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    
    $id 							= isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c 								= isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';							
    $a 								= isset($_GET['a']) ? mysql_real_escape_string(trim($_GET['a'])) : '';							
    $kode_list_alat							= isset($_POST['kode_list_alat']) ? mysql_real_escape_string(trim($_POST['kode_list_alat'])) : '';
    $kode_barang							= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang							= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $qty								= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $no_seri_number							= isset($_POST['no_seri_number']) ? mysql_real_escape_string(trim($_POST['no_seri_number'])) : '';
    
    
    if($a != ""){
	
	//UPDATE 
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	$data_array_select 	= mysql_fetch_array(mysql_query("SELECT `id` FROM `gx_jawaban_spk_maintance` WHERE `kode_jawaban_spk_maintance`='".$c."' ORDER BY `id` DESC LIMIT 0,1", $conn));
	$id			= $data_array_select['id'];
	
	
	//$sql_update = "UPDATE `gx_jawaban_spk_maintance` SET `date_upd`=NOW(),`level`='1',`user_upd`='".$loggedin['username']."' WHERE  `kode_jawaban_spk_maintance`='".$a."'";
	$sql_update = "UPDATE `gx_jawaban_spk_maintance_list_alat` SET `date_upd`=NOW(),`level`='1',`user_upd`='".$loggedin['username']."' WHERE `kode_list_alat`='".$a."'";			
	
	//echo $sql_insert."<br>";

	//echo $sql_update;
	
	mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate (error sql update) ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
	
	$sql_insert = "INSERT INTO `gx_jawaban_spk_maintance_list_alat`(`id`, `kode_jawaban_spk_maintance`, `kode_list_alat`, `kode_barang`, `nama_barang`, `qty`, `no_seri_number`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL,'".$c."','".$kode_list_alat."','".$kode_barang."','".$nama_barang."','".$qty."','".$no_seri_number."','0',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";
   
	//echo $sql_insert;
	mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate (error sql insert) ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
       
       
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	
    
	echo "<script language='JavaScript'>
	    alert('Data telah diupdate.');
	    window.location.href='".$redirect_update_data."?c=".$c."&a=".$a."';
	    </script>";
	
    }else{
	    echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diupdate ke dalam Database (error statement), Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
}

if(isset($_GET["c"]))
{
    $id		= isset($_GET['id']) ? $_GET['id'] : '';
    $c		= isset($_GET['c']) ? $_GET['c'] : '';
    /*$query_pengeluaran_barang = "SELECT `id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaaan`, `nama_pemohon`, `nama_cabang`, `divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pengeluaran_barang` WHERE `id_pengeluaran_barang` ='".$id_pengeluaran_barang."' LIMIT 0,1;";*/
    $query 	= "SELECT * FROM `".$table_main."` WHERE  `".$unix_field_sql."`='".$c."' ORDER BY `".$index_field_sql."` DESC LIMIT 0,1"; 
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
						<label>No SPK Maintance</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["no_spk_maintance"] : '').'
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["tanggal"] : date("Y-m-d")).'
					    </div>';
					    //'.(isset($_GET['c']) ? $row["kode_cabang"] : "CAB-".rand(0000000, 9999999) ).'
					$content .= '
					  
                                        </div>
					</div>
					
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Jawaban SPK Maintance</label>
					    </div>
					    <div class="col-xs-10">
						'.(isset($_GET['c']) ? $row["kode_jawaban_spk_maintance"] : "JSB-".rand(0000000, 9999999)).'
					    </div>
					  
                                        </div>
					</div>
					   
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["kode_customer"] : '').'
					    </div>
					    <div class="col-xs-2">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["nama_customer"] : '').'
					    </div>
                                        </div>
					</div>
									

					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["cabang"] : '').'
					    </div>
					    
						<div class="col-xs-2">
							<label>User ID</label>
						</div>
						<div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["user_id"] : '').'
						</div>
						
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Telp</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["telp"] : '').'
					    </div>
						
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-10">
						'.(isset($_GET['c']) ? $row["alamat"] : '').'
					    </div>
						
					</div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Teknisi 1</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["teknisi_1"] : '').'
					    </div>
					    
						<div class="col-xs-2">
							<label>Marketing</label>
						</div>
						<div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["marketing"] : '').'
					    </div>
						
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Teknisi 2</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["teknisi_2"] : '').'
					    </div>
					    
						<div class="col-xs-2">
							<label>Teknisi 4</label>
						</div>
						<div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["teknisi_4"] : '').'
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Teknisi 3</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["teknisi_3"] : '').'
					    </div>
					    
						<div class="col-xs-2">
							<label>Teknisi 5</label>
						</div>
						<div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["teknisi_5"] : '').'
					    </div>
						
					</div>
					</div>					
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Status</label>
					    </div>
					    <div class="col-xs-10">
						'.(isset($_GET['c']) ? ($row['status_spk']=='cleared' ? 'Cleared' : 'Uncleared' ) : '' ).'
					    </div>
					</div>
					</div>
					
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Pekerjaan</label>
					    </div>
					    <div class="col-xs-12">
						'.(isset($_GET['pekerjaan']) ? $row["pekerjaan"] : '').'
					    </div>

                                        </div>
					</div>
					
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Solusi</label>
					    </div>
					    <div class="col-xs-12">
						'.(isset($_GET['solusi']) ? $row["solusi"] : '').'
					    </div>
                                        </div>
					</div>
					</div><!-- /.box-body -->
				    
				   ';
				
				
				$a = isset($_GET['a']) ? $_GET['a'] : '';
				$c = isset($_GET['c']) ? $_GET['c'] : '';
				
				$sql2 = "SELECT `id`, `kode_jawaban_spk_maintance`, `kode_list_alat`, `kode_barang`, `nama_barang`, `qty`, `no_seri_number`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_jawaban_spk_maintance_list_alat` WHERE `kode_jawaban_spk_maintance`='".$c."' AND `kode_list_alat`='".$a."' AND `level`='0'";
				$query2 = mysql_query($sql2, $conn);
				$row2 = mysql_fetch_array($query2);		    
				$content .= '
				    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Barang</label>
					    </div>
					    <div class="col-xs-4">
						<input type="hidden"  class="form-control" name="kode_list_alat" value="'.(isset($_GET['a']) ? $row2["kode_list_alat"] : 'KLA-'.rand(000000,999999)).'" required="">
						<input type="text"  class="form-control" name="kode_barang" value="'.(isset($_GET['a']) ? $row2["kode_barang"] : '').'" required="">
					    </div>
					    
						<div class="col-xs-2">
							<label>Nama Barang</label>
						</div>
						<div class="col-xs-4">
						<input type="text"  class="form-control" name="nama_barang" value="'.(isset($_GET['a']) ? $row2["nama_barang"] : '').'"  required="">
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Qty</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text"  class="form-control" name="qty" value="'.(isset($_GET['a']) ? $row2["qty"] : '').'" required="">
					    </div>
					        
						<div class="col-xs-2">
							<label>No Seri Number</label>
						</div>
						<div class="col-xs-4">
						<input type="text"  class="form-control" name="no_seri_number" value="'.(isset($_GET['a']) ? $row2["no_seri_number"] : '').'"  required="">
						
					    </div>
						
					</div>
					</div>
					
					<div class="form-group"><div class="row"><div class="col-xs-2"><button type="submit" value="Submit" '.(isset($_GET['a']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button> </div></div></div>';
					
						
				 
					if($c != ''){
					$content .= '
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Alat yang terpasang maintance</label>
					    </div>
					    
					    <div class="col-xs-12">
						<table class="table table-hover">
						    <thead>
							<tr><th>Kode Barang</th><th>Nama Barang</th><th>Qty</th><th>No Seri Number</th><th>Action</th></tr>
						    </thead>
						    <tbody>';
						    
							$sql_1 = "SELECT * FROM `gx_jawaban_spk_maintance_list_alat` WHERE `kode_jawaban_spk_maintance`='".$c."' AND `level`='0'";
							$query_1 = mysql_query($sql_1, $conn);
						    
							while($row_1 = mysql_fetch_array($query_1)){    	
								$content .= '<tr><td>'.$row_1['kode_barang'].'</td><td>'.$row_1['nama_barang'].'</td><td>'.$row_1['qty'].'</td><td>'.$row_1['no_seri_number'].'</td><td><a href="?c='.$c.'&a='.$row_1['kode_list_alat'].'">Edit</a></td></tr>';
							}    
						
						    $content .= '
						    </tbody>';
						    
						$content .= '</table>    
					    </div>
                                        </div>
					</div>';
					}
				
				
					$content .= '
					</div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                      
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