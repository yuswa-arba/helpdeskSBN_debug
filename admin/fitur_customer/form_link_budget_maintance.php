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
$table_main = "gx_link_budget_maintance";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_batal_posting` WHERE 1

//INSERT 
    //INSERT INTO `gx_batal_posting`(`id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
    $url_redirect_insert 		= "master_link_budget_maintance";
    $url_redirect_insert_detail	 	= "form_link_budget_maintance_detail";
    
//UPDATE
    //UPDATE `gx_batal_posting` SET `id`=[value-1],`kode_batal_posting`=[value-2],`nama_balal`=[value-3],`kode_batal`=[value-4],`alasan_batal`=[value-5],`data_asli`=[value-6],`data_baru`=[value-7],`date_add`=[value-8],`date_upd`=[value-9],`level`=[value-10],`user_add`=[value-11],`user_upd`=[value-12] WHERE 1
    $redirect_update_data = "form_link_budget_maintance.php";
    
//DELETE
    //DELETE FROM `gx_batal_posting` WHERE 1


//String Data View
    //Judul Form
    $judul_form = "Form Link Budget Maintance";
    $header_form = "Data Link Budget Maintance";
    $index_field_sql = "id";
    $unix_field_sql = "kode_link_budget_maintance";
    $url_form_detail = "detail_link_budget_maintance";
    $url_form_edit = "form_link_budget_maintance";
    
    $form_name = "form_link_budget_maintance";
    $form_id = "form_link_budget_maintance";
    
    $form_name_2 = "";
    $form_id_2 = "";
    
    //id web
    $title_header = 'Master Link Budget Maintance';
    $submenu_header = 'master_link_budget_maintance';
    
    
    
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    //$											= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $kode_link_budget_maintance								= isset($_POST['kode_link_budget_maintance']) ? mysql_real_escape_string(trim($_POST['kode_link_budget_maintance'])) : '';    
    $tanggal										= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';    
    $kode_cabang									= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';    
    $cabang										= isset($_POST['cabang']) ? mysql_real_escape_string(trim($_POST['cabang'])) : '';    
    $spk_maintance									= isset($_POST['spk_maintance']) ? mysql_real_escape_string(trim($_POST['spk_maintance'])) : '';    
    $kode_customer									= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';    
    $nama_customer									= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';    
    $latitude										= isset($_POST['latitude']) ? mysql_real_escape_string(trim($_POST['latitude'])) : '';    
    $longtidute										= isset($_POST['longtidute']) ? mysql_real_escape_string(trim($_POST['longtidute'])) : '';    
    $tiang_terdekat									= isset($_POST['tiang_terdekat']) ? mysql_real_escape_string(trim($_POST['tiang_terdekat'])) : '';    
    $nama_created									= isset($_POST['nama_created']) ? mysql_real_escape_string(trim($_POST['nama_created'])) : '';    
    $type_connection									= isset($_POST['type_connection']) ? mysql_real_escape_string(trim($_POST['type_connection'])) : '';        
    $power_budget									= isset($_POST['power_budget']) ? mysql_real_escape_string(trim($_POST['power_budget'])) : '';        
    $kode_alat_dibutuhkan								= isset($_POST['kode_alat_dibutuhkan']) ? mysql_real_escape_string(trim($_POST['kode_alat_dibutuhkan'])) : '';        	
    
	
    if($kode_link_budget_maintance!= ""){
    
    
    
    $sql_insert = "INSERT INTO `gx_link_budget_maintance`(`id`, `kode_link_budget_maintance`, `tanggal`, `kode_cabang`, `cabang`, `spk_maintance`, `kode_customer`, `nama_customer`, `latitude`, `longtidute`, `tiang_terdekat`, `nama_created`, `fiber_optic`, `wireless`, `type_connection`, `power_budget`, `kode_alat_dibutuhkan`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
    VALUES (NULL,'".$kode_link_budget_maintance."','".$tanggal."','".$kode_cabang."','".$cabang."','".$spk_maintance."','".$kode_customer."','".$nama_customer."','".$latitude."','".$longtidute."','".$tiang_terdekat."','".$nama_created."','','','".$type_connection."','".$power_budget."','".$kode_alat_dibutuhkan."','0',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";
    
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert (error insert) ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    $id_insert = mysql_insert_id($conn);
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    $c_id = isset($_GET['c']) ? $_GET['c'] : $kode_link_budget_maintance;
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".$url_redirect_insert_detail."?c=".$c_id."';
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
    
    $id 										= isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c 											= isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';							
    $kode_link_budget_maintance								= isset($_POST['kode_link_budget_maintance']) ? mysql_real_escape_string(trim($_POST['kode_link_budget_maintance'])) : '';    
    $tanggal										= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';    
    $kode_cabang									= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';    
    $cabang										= isset($_POST['cabang']) ? mysql_real_escape_string(trim($_POST['cabang'])) : '';    
    $spk_maintance									= isset($_POST['spk_maintance']) ? mysql_real_escape_string(trim($_POST['spk_maintance'])) : '';    
    $kode_customer									= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';    
    $nama_customer									= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';    
    $latitude										= isset($_POST['latitude']) ? mysql_real_escape_string(trim($_POST['latitude'])) : '';    
    $longtidute										= isset($_POST['longtidute']) ? mysql_real_escape_string(trim($_POST['longtidute'])) : '';    
    $tiang_terdekat									= isset($_POST['tiang_terdekat']) ? mysql_real_escape_string(trim($_POST['tiang_terdekat'])) : '';    
    $nama_created									= isset($_POST['nama_created']) ? mysql_real_escape_string(trim($_POST['nama_created'])) : '';    
    $type_connection									= isset($_POST['type_connection']) ? mysql_real_escape_string(trim($_POST['type_connection'])) : '';        
    $power_budget									= isset($_POST['power_budget']) ? mysql_real_escape_string(trim($_POST['power_budget'])) : '';        
    $kode_alat_dibutuhkan								= isset($_POST['kode_alat_dibutuhkan']) ? mysql_real_escape_string(trim($_POST['kode_alat_dibutuhkan'])) : '';        	
    
    
    if($c != ""){
	
	//UPDATE 
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	$data_array_select 	= mysql_fetch_array(mysql_query("SELECT `id` FROM `gx_link_budget_maintance` WHERE `kode_link_budget_maintance`='".$c."' ORDER BY `id` DESC LIMIT 0,1", $conn));
	$id			= $data_array_select['id'];
	
	
	$sql_update = "UPDATE `gx_link_budget_maintance` SET `date_upd`=NOW(),`user_upd`='".$loggedin['username']."',`level`='1' WHERE `kode_link_budget_maintance`='".$c."'";
				
	
	mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate (error sql update) ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
	
	$sql_insert = "INSERT INTO `gx_link_budget_maintance`(`id`, `kode_link_budget_maintance`, `tanggal`, `kode_cabang`, `cabang`, `spk_maintance`, `kode_customer`, `nama_customer`, `latitude`, `longtidute`, `tiang_terdekat`, `nama_created`, `fiber_optic`, `wireless`, `type_connection`, `power_budget`, `kode_alat_dibutuhkan`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL,'$kode_link_budget_maintance','$tanggal','$kode_cabang','$cabang','$spk_maintance','$kode_customer','$nama_customer','$latitude','$longtidute','$tiang_terdekat','$nama_created','','',$type_connection,'$power_budget','$kode_alat_dibutuhkan','0',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";
	
	
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
	    window.location.href='".$redirect_update_data."?c=".$c."';
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
						<label>Kode Link Budget Maintance</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" required="" name="kode_link_budget_maintance" value="'.(isset($_GET['c']) ? $row["kode_link_budget_maintance"] : 'PBR-'.rand(0000000,9999999) ).'" >
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-4"> 
						<input type="text" readonly="" class="form-control" required="" name="tanggal" value="'.(isset($_GET['c']) ? $row["tanggal"] : date("Y-m-d")).'">
					    </div>';
					    //'.(isset($_GET['c']) ? $row["kode_cabang"] : "CAB-".rand(0000000, 9999999) ).'
					$content .= '
					  
                                        </div>
					</div>
					
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text" class="form-control" required="" name="cabang" value="'.(isset($_GET['c']) ? $row["cabang"] : '').'" onclick="return valideopenerform(\'data_cabang.php?r=form_link_budget_maintance&f=data_link_budget_maintance\',\'link_budget_maintance\');">
						<input readonly="" type="hidden" class="form-control" required="" name="kode_cabang" value="'.(isset($_GET['c']) ? $row["kode_cabang"] : '').'">
					    </div>
					  
					    <div class="col-xs-2">
						<label>SPK Maintance</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text" class="form-control" required="" name="spk_maintance" value="'.(isset($_GET['c']) ? $row["spk_maintance"] : '').'" onclick="return valideopenerform(\'data_spk_maintance.php?r=form_link_budget_maintance&f=data_link_budget_maintance\',\'link_budget_maintance\');">
					    </div>
					  
                                        </div>
					</div>
					 
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text" class="form-control" required="" name="kode_customer" value="'.(isset($_GET['c']) ? $row["kode_customer"] : '').'">
					    </div>
					  
					    <div class="col-xs-2">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text" class="form-control" required="" name="nama_customer" value="'.(isset($_GET['c']) ? $row["nama_customer"] : '').'">
					    </div>
                                        </div>
					</div>
					  
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Latitude</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" required="" name="latitude" value="'.(isset($_GET['c']) ? $row["latitude"] : '').'">
					    </div>
					  
					    <div class="col-xs-2">
						<label>Longtidute</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" required="" name="longtidute" value="'.(isset($_GET['c']) ? $row["longtidute"] : '').'">
					    </div>
					  
                                        </div>
					</div>
					  
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Tiang Terdekat</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" required="" name="tiang_terdekat" value="'.(isset($_GET['c']) ? $row["tiang_terdekat"] : '').'">
					    </div>
					    <div class="col-xs-2">
						<label>Nama Created</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text" class="form-control" required="" name="nama_created" value="'.(isset($_GET['c']) ? $row["nama_created"] : $loggedin['username']).'">
					    </div>
					  
                                        </div>
					</div>
					  
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Type Connection</label>
					    </div>
					    <div class="col-xs-2">
						<input readonly="" type="radio" class="form-control" required="" name="type_connection" value="fiber_optic" '.(isset($_GET['c']) ? ($row["type_connection"]=='fiber_optic' ? 'checked' : '') : '').'> Fiber Optic
					    </div>
					    <div class="col-xs-2">
						<input readonly="" type="radio" class="form-control" required="" name="type_connection" value="wireless" '.(isset($_GET['c']) ? ($row["type_connection"]=='wireless' ? 'checked' : '') : '').'> Wireless
					    </div>
                                        </div>
					</div>
					    
					    
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Power Budget</label>
					    </div>
					    <div class="col-xs-12">
						<textarea type="text" class="form-control" required="" name="power_budget">'.(isset($_GET['c']) ? $row["power_budget"] : '').'</textarea>
					    </div>			  
                                        </div>
					</div>   
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Alat yang dibutuhkan</label>
					    </div>
					    <div class="col-xs-12">
						<table id="example1" class="table table-bordered table-striped">
								<thead>
								  <tr>
									<th width="3%">No.</th>
									<th width="3%">Nama Barang</th>
									<th width="3%">Quantity</th>
									<th width="3%">Serial Number</th>
									
								  </tr>
								</thead>
								<tbody>';
						//select data
						
						//SELECT `id`, `kode_link_budget_maintance_alat`, `kode_link_budget_maintance`, `tanggal`, `kode_barang`, `nama_barang`, `quantity`, `serial_number`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_link_budget_maintance_alat` WHERE
						$c = isset($_GET['c']) ? $_GET['c'] : '';
						$select_all_data_valid_alat = "SELECT * FROM `gx_link_budget_maintance_alat` WHERE `kode_link_budget_maintance`='".$c."'";
						$urutan_alat = "ORDER BY `id` ASC";
						$perhalaman = 20;
						if (isset($_GET['page'])){
							$page = (int)$_GET['page'];
							$start=($page - 1) * $perhalaman;
						}else{
							$start=0;
						}

						    $sql_data		= mysql_query("".$select_all_data_valid_alat." ".$urutan_alat." LIMIT $start, $perhalaman;", $conn);
						    
						    $sql_total_data	= mysql_num_rows(mysql_query($select_all_data_valid_alat, $conn));
						    $hal		= "?";
						    $no 		= $start + 1;
						
						    while($row_data = mysql_fetch_array($sql_data))
						    {	
							$content .= '<tr>
									<td>'.$no.'.</td>
									<td>'.$row_data['nama_barang'].'</td>
									<td>'.$row_data['quantity'].'</td>
									<td>'.$row_data['serial_number'].'</td>								
								    </tr>';
							$no++;
						    }
						
						$content .='</tbody>
						</table>
						<div class="box-footer">
						    <div class="box-tools pull-right">
						    '.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
						    </div>
						    <br style="clear:both;">
						 </div>
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