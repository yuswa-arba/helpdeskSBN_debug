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
$table_main = "gx_list_barang_customer";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_batal_posting` WHERE 1

//INSERT 
    //INSERT INTO `gx_batal_posting`(`id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
    $url_redirect_insert 		= "master_list_barang_customer";
    $url_redirect_insert_detail	 	= "form_detail_list_barang_customer";
    
//UPDATE
    //UPDATE `gx_batal_posting` SET `id`=[value-1],`kode_batal_posting`=[value-2],`nama_balal`=[value-3],`kode_batal`=[value-4],`alasan_batal`=[value-5],`data_asli`=[value-6],`data_baru`=[value-7],`date_add`=[value-8],`date_upd`=[value-9],`level`=[value-10],`user_add`=[value-11],`user_upd`=[value-12] WHERE 1
    $redirect_update_data = "form_detail_list_barang_customer.php";
    
//DELETE
    //DELETE FROM `gx_batal_posting` WHERE 1


//String Data View
    //Judul Form
    $judul_form = "Form List Barang Customer";
    $header_form = "Data List Barang Customer";
    $index_field_sql = "id";
    $unix_field_sql = "kode_list_barang_customer";
    $url_form_detail = "detail_list_barang_customer";
    $url_form_edit = "form_list_barang_customer";
    
    $form_name = "form_list_barang_customer";
    $form_id = "form_list_barang_customer";
    
    $form_name_2 = "";
    $form_id_2 = "";
    
    //id web
    $title_header = 'Master List Barang Customer';
    $submenu_header = 'master_list_barang_customer';
    
    
    
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    //$							= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $kode_list_barang_customer				= isset($_POST['kode_list_barang_customer']) ? mysql_real_escape_string(trim($_POST['kode_list_barang_customer'])) : '';
    $kode_cabang					= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $cabang						= isset($_POST['cabang']) ? mysql_real_escape_string(trim($_POST['cabang'])) : '';
    $kode_customer					= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer					= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $uid						= isset($_POST['uid']) ? mysql_real_escape_string(trim($_POST['uid'])) : '';
    
	
    if($kode_list_barang_customer != ""){
    /*
    $sql_insert = "INSERT INTO `gx_list_barang_customer`(`id`, `kode_list_barang_customer`, `kode_customer`, `tanggal`, `kode_barang`, `nama_barang`, `qty`, `serial_number`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
    VALUES (NULL,'".$kode_list_barang_customer."','".$kode_customer."','".$tanggal."','".$kode_barang."','".$nama_barang."','".$qty."','".$serial_number."','0',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";
    */
    $sql_insert = "INSERT INTO `gx_list_barang_customer`(`id`, `kode_list_barang_customer`, `kode_cabang`, `cabang`, `kode_customer`, `nama_customer`, `uid`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
    VALUES (NULL,'$kode_list_barang_customer','$kode_cabang','$cabang','$kode_customer','$nama_customer','$uid','0',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";
    
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    $id_insert = mysql_insert_id($conn);
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    $c_id = isset($_GET['c']) ? $_GET['c'] : $kode_list_barang_customer;
    
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
    
    $id 						= isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c 							= isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';							
    $kode_list_barang_customer				= isset($_POST['kode_list_barang_customer']) ? mysql_real_escape_string(trim($_POST['kode_list_barang_customer'])) : '';
    $kode_cabang					= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $cabang						= isset($_POST['cabang']) ? mysql_real_escape_string(trim($_POST['cabang'])) : '';
    $kode_customer					= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer					= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $uid						= isset($_POST['uid']) ? mysql_real_escape_string(trim($_POST['uid'])) : '';
    
    if($c != ""){
	
	//UPDATE 
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	$data_array_select 	= mysql_fetch_array(mysql_query("SELECT `id` FROM `gx_jawaban_spk_bongkar` WHERE `kode_jawaban_spk_bongkar`='".$c."' ORDER BY `id` DESC LIMIT 0,1", $conn));
	$id			= $data_array_select['id'];
	
	
	$sql_update = "UPDATE `gx_list_barang_customer` SET `date_upd`=NOW(),`user_upd`='".$loggedin['username']."',`level`='1' WHERE `kode_list_barang_customer`='".$c."'";
				
	
	mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate (error sql update) ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	/*
	$sql_insert = "INSERT INTO `gx_jawaban_spk_bongkar`(`id`, `no_spk_bongkar`, `tanggal`, `kode_jawaban_spk_bongkar`, `kode_customer`, `nama_customer`, `kode_cabang`, `cabang`, `user_id`, `telp`, `alamat`, `kode_marketing`, `marketing`,  `kode_teknisi_1`, `teknisi_1`, `kode_teknisi_2`, `teknisi_2`, `kode_teknisi_3`, `teknisi_3`, `kode_teknisi_4`, `teknisi_4`, `kode_teknisi_5`, `teknisi_5`, `status_spk`, `pekerjaan`, `solusi`, `kode_list_alat`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL,'".$no_spk_bongkar."','".$tanggal."','".$kode_jawaban_spk_bongkar."','".$kode_customer."','".$nama_customer."','".$kode_cabang."','".$cabang."','".$user_id."','".$telp."','".$alamat."','".$kode_marketing."','".$marketing."','".$kode_teknisi_1."','".$teknisi_1."','".$kode_teknisi_2."','".$teknisi_2."','".$kode_teknisi_3."','".$teknisi_3."','".$kode_teknisi_4."','".$teknisi_4."','".$kode_teknisi_5."','".$teknisi_5."','".$status_spk."','".$pekerjaan."','".$solusi."','".$kode_list_alat."','0',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";
	*/
	/*
	$sql_insert = "INSERT INTO `gx_list_barang_customer`(`id`, `kode_list_barang_customer`, `kode_customer`, `tanggal`, `kode_barang`, `nama_barang`, `qty`, `serial_number`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL,'".$kode_list_barang_customer."','".$kode_customer."','".$tanggal."','".$kode_barang."','".$nama_barang."','".$qty."','".$serial_number."','0',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";
	*/
	
	$sql_insert = "INSERT INTO `gx_list_barang_customer`(`id`, `kode_list_barang_customer`, `kode_cabang`, `cabang`, `kode_customer`, `nama_customer`, `uid`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL,'".$kode_list_barang_customer."','".$kode_cabang."','".$cabang."','".$kode_customer."','".$nama_customer."','".$uid."','0',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";
	
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
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" required="" name="cabang" value="'.(isset($_GET['c']) ? $row["cabang"] : '').'" onclick="return valideopenerform(\'data_cabang.php?r=form_list_barang_customer&f=data_cabang_barang_customer\',\'list_barang_customer\');">
						<input type="hidden" class="form-control" required="" name="kode_cabang" value="'.(isset($_GET['c']) ? $row["kode_cabang"] : '').'" >
						<input type="hidden" name="kode_list_barang_customer" value="'.(isset($_GET['c']) ? $_GET['c'] : 'LBC-'.rand(000000,999999) ).'">
					    </div>
					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-4"> 
						<input type="text" readonly="" class="form-control" required="" name="kode_customer" value="'.(isset($_GET['c']) ? $row["kode_customer"] : '').'" onclick="return valideopenerform(\'data_customer.php?r=form_list_barang_customer&f=data_customer\',\'list_barang_customer\');">
					    </div>
					  
					    ';
					    //'.(isset($_GET['c']) ? $row["kode_cabang"] : "CAB-".rand(0000000, 9999999) ).'
					$content .= '
					  
                                        </div>
					</div>
					
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text" class="form-control" required="" name="nama_customer" value="'.(isset($_GET['c']) ? $row["nama_customer"] : '').'">
					    </div>
					  
					    <div class="col-xs-2">
						<label>Uid</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text" class="form-control" required="" name="uid" value="'.(isset($_GET['c']) ? $row["uid"] : '').'">
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