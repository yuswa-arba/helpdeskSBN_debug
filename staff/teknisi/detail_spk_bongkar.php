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

$perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
//SQL 
$table_main = "gx_spk_bongkar";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_batal_posting` WHERE 1

//INSERT 
    //INSERT INTO `gx_batal_posting`(`id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
    $url_redirect_insert = "master_spk_bongkar";
    
//UPDATE
    //UPDATE `gx_batal_posting` SET `id`=[value-1],`kode_batal_posting`=[value-2],`nama_balal`=[value-3],`kode_batal`=[value-4],`alasan_batal`=[value-5],`data_asli`=[value-6],`data_baru`=[value-7],`date_add`=[value-8],`date_upd`=[value-9],`level`=[value-10],`user_add`=[value-11],`user_upd`=[value-12] WHERE 1
    $redirect_update_data = "master_spk_bongkar";
        
//DELETE
    //DELETE FROM `gx_batal_posting` WHERE 1


//String Data View
    //Judul Form
    $judul_form = "Detail SPK Bongkar";
    $header_form = "Data SPK Bongkar";
    $index_field_sql = "id";
    $unix_field_sql = "kode_spk_bongkar";
    $url_form_detail = "detail_spk_bongkar";
    $url_form_edit = "form_spk_bongkar";
    
    $form_name = "form_spk_bongkar";
    $form_id = "";
    
    //id web
    $title_header = 'Master SPK Bongkar';
    $submenu_header = 'spk_bongkar';
    

        global $conn;
	global $conn_voip;
 

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
						<label>No SPK Bongkar</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text" class="form-control" required="" name="kode_spk_bongkar" value="'.(isset($_GET['c']) ? $row["kode_spk_bongkar"] : "SPB-".rand(0000000, 9999999)).'">
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
						<input readonly="" type="text"  class="form-control" name="cabang" value="'.(isset($_GET['c']) ? $row["cabang"] : '').'">
					    </div>
					    <div class="col-xs-2">
						<label>User ID</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="user_id" value="'.(isset($_GET['c']) ? $row["user_id"] : '').'">
					    </div>
                                        </div>
					</div>
					
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" readonly="" type="text"  class="form-control" name="kode_customer" value="'.(isset($_GET['c']) ? $row["kode_customer"] : '').'">
					    </div>
					    <div class="col-xs-2">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="nama_customer" value="'.(isset($_GET['c']) ? $row["nama_customer"] : '').'">
					    </div>
                                        </div>
					</div>
					
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Inactive</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="no_inactive" value="'.(isset($_GET['c']) ? $row["no_inactive"] : '' ).'">
					    </div>
					    <div class="col-xs-2">
						<label>No Off Connection</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="no_off_connection" value="'.(isset($_GET['c']) ? $row["no_off_connection"] : '').'">
					    </div>
                                        </div>
					</div>					

					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						    <label>Telpon</label>
					    </div>
					    <div class="col-xs-4">
						    <input type="text" readonly="" class="form-control" name="telp" value="'.(isset($_GET['c']) ? $row["telp"] : '').'">
					    </div>
					    <div class="col-xs-2">
						    <label>Teknisi</label>
					    </div>
					    <div class="col-xs-4">
						    <input type="text" readonly="" class="form-control" name="teknisi" value="'.(isset($_GET['c']) ? $row["teknisi"] : '').'">
					    </div>
					</div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-10">
						<input readonly="" type="text" class="form-control" name="alamat" value="'.(isset($_GET['c']) ? $row["alamat"] : '').'">
					    </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Pekerjaan</label>
					    </div>
					    <div class="col-xs-12">
						<textarea readonly="" class="form-control" name="pekerjaan">'.(isset($_GET['c']) ? $row["pekerjaan"] : '').'</textarea>
					    </div>

                                        </div>
					</div>
					
					</div><!-- /.box-body -->
				    
				    
                                    
                                </form>
                            </div><!-- /.box -->
							<div class="box">
                                <div class="box-body table-responsive">
							<legend>Data Jawab SPK Bongkar</legend>
								  <table id="example1" class="table table-bordered table-striped">
												  <thead>
													<tr>	<th width="3%">no</th>
											  <th width="12%">Tanggal</th>
											  <th width="20%">No Jawab SPK </th>
											  <th>Solusi</th>
											  <th width="15%">Action</th>
													</tr>
												  </thead>
												  <tbody>';
								  
								  
									  $sql_jawab_spk_pasang_baru	= mysql_query("SELECT * FROM `gx_jawaban_spk_bongkar`
												  WHERE `level` =  '0' AND
												  `no_spk_bongkar` = '$row[kode_spk_bongkar]'
												  ORDER BY  `date_add` DESC LIMIT $start, $perhalaman;", $conn);
									  $sql_total_jawab_spk_pasang_baru	= mysql_num_rows(mysql_query("SELECT * FROM `gx_jawaban_spk_bongkar`
												  WHERE `level` =  '0' AND
												  `no_spk_bongkar` = '$row[kode_spk_bongkar]'
												  ORDER BY  `date_add` DESC;", $conn));
									  $hal	="?";
									  $no = 1;
								  
									  while($r_spk_pasang_baru = mysql_fetch_array($sql_jawab_spk_pasang_baru))
									  {
									  $content .='<tr>
											  <td>'.$no.'.</td>
											  <td>'.$r_spk_pasang_baru['tanggal'].'</td>
											  <td>'.$r_spk_pasang_baru['kode_jawaban_spk_bongkar'].'</td>
											  <td>'.$r_spk_pasang_baru['solusi'].'</td>
											  <td><a href="detail_jawab_spk_bongkar.php?id='.$r_spk_pasang_baru["id"].'">Details</a>
										  </tr>';
									  $no++;
									  }
								  
								  $content .='</tbody>
								  </table>
                                </div><!-- /.box-body -->
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
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;

    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>