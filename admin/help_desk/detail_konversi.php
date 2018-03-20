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
    if($loggedin["group"] == 'admin')
    {
        global $conn;



if(isset($_GET["id"]))
{
    $id_konversi		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_konversi		= "SELECT * FROM `gx_helpdesk_konversi` WHERE `id_konversi`='$id_konversi' LIMIT 0,1;";
    $sql_konversi		= mysql_query($query_konversi, $conn);
    $row_konversi		= mysql_fetch_array($sql_konversi);
   
}

    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Detail Konversi</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Cabang</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_konversi["nama_cabang"] : "").'">
												<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_konversi["kode_cabang"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_konversi["tanggal"] : date("Y-m-d")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Konversi</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" readonly=""  class="form-control" id="kode_konversi" name="kode_konversi" required="" value="'.(isset($_GET['id']) ? $row_konversi["kode_konversi"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Kode Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" id="kode_customer" name="kode_customer" required="" value="'.(isset($_GET['id']) ? $row_konversi["kode_customer"] : "").'">
											</div>
										</div>
										</div> 
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control" name="nama_customer" value="'.(isset($_GET['id']) ? $row_konversi["nama_customer"] : "").'">
											</div>
															
											<div class="col-xs-3">
												<label>UID</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="uid" value="'.(isset($_GET['id']) ? $row_konversi["uid"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Paket Lama</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" name="kode_paket_lama" value="'.(isset($_GET['id']) ? $row_konversi["kode_paket_lama"] : "").'">
											</div>
											<div class="col-xs-5">
												<input type="text" class="form-control" readonly="" name="nama_paket_lama" value="'.(isset($_GET['id']) ? $row_konversi["nama_paket_lama"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Paket Baru</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" name="kode_paket_baru" value="'.(isset($_GET['id']) ? $row_konversi["kode_paket_baru"] : "").'">
											</div>
											<div class="col-xs-5">
												<input type="text" class="form-control" readonly="" name="nama_paket_baru" value="'.(isset($_GET['id']) ? $row_konversi["nama_paket_baru"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>No Formulir</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control"  name="kode_formulir" value="'.(isset($_GET['id']) ? $row_konversi["kode_formulir"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Foto Formulir</label>
											</div>
											<div class="col-xs-9">
												
												';
													if(isset($_GET["id"])){
														$sql_data		= mysql_query("SELECT * FROM `gx_upload` WHERE `level` =  '0' AND `kode_konversi` = '".$row_konversi["kode_konversi"]."'  ORDER BY `id` DESC;", $conn);
														while($row_data = mysql_fetch_array($sql_data)){
															$content .='<div class="abcd" style="float: left;"><img src="'.URL_ADMIN.''.$row_data["lokasi_file"].''.$row_data["nama_file"].'"></div>';
														}
													}
										   $content .='
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Created By</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_konversi["user_add"] : $loggedin["username"]).'
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Lates Update By </label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_konversi["user_upd"]." ".$row_konversi["date_upd"] : "").'
											</div>
										</div>
										</div>
                                    </div><!-- /.box-body -->

                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
			

$plugins = '<!-- datepicker -->
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
	    </style>';

    $title	= 'Detail Konversi';
    $submenu	= "konversi";
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