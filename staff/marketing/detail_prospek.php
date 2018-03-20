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
if($loggedin["group"] == 'staff'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Prospek marketing");
	global $conn;
    
if(isset($_GET['id_prospek'])){
		$get_id = isset($_GET['id_prospek']) ? mysql_real_escape_string(trim(strip_tags($_GET['id_prospek']))) : "";
		$data_prospek = mysql_fetch_array(mysql_query("SELECT `id_prospek`, `no_prospek`, `tanggal`, `cabang`, `kode_cust`, `nama_cust`, `nama_perusahaan`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp_1`, `no_hp_2`, `contact_person`, `email`, `note`, `chat_history_wa`, `id_marketing`, `marketing`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_prospek` WHERE `gx_prospek`.`id_prospek` = '$get_id' AND `id_marketing` = '$loggedin[id_employee]';", $conn));
	    }
$sql_cabangg	= "SELECT * FROM `gx_cabang` WHERE `id_cabang` = '$loggedin[cabang]' ORDER BY `id_cabang` ASC LIMIT 0,1;";
$query_cabangg	= mysql_query($sql_cabangg, $conn);
$row_cabangg = mysql_fetch_array($query_cabangg);
    $content ='<section class="content-header">
                    <h1>
                        Detail prospek
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Detail Prospek</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="myForm"  method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" id="cabang" name="cabang" required=""  value="'.(isset($_GET["id_prospek"]) ? $row_cabangg["nama_cabang"] :"").'">
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control id="tanggal" name="tanggal" required="" value="'.(isset($_GET["id_prospek"]) ? date("Y-m-d H:i", strtotime($data_prospek['tanggal'])) : date("Y-m-d H:i")).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No. Prospek</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" required="" name="no_prospek" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_prospek'] :"").'">
						
					    </div>
					    <!--<div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" required="" name="kode_customer" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kode_cust'] :"").'"><a href="data_cust.php?r=myForm" onclick="return valideopenerform(\'data_cust.php?r=myForm\',\'cust\');">Search Customer</a>
					    </div>-->
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-10">
						<input type="text" readonly="" class="form-control"  name="nama_customer" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['nama_cust'] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Nama Perusahaan</label>
					    </div>
					    <div class="col-xs-10">
						<input type="text" readonly="" class="form-control" name="nama_perusahaan" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['nama_perusahaan'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-10">
					        <input type="text" readonly="" class="form-control"  name="alamat" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['alamat'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kelurahan</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control"  name="kelurahan" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kelurahan'] :"").'">
					    </div>
					    <div class="col-xs-2">
						<label>Kecamatan</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control"  name="kecamatan" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kecamatan'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kota</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="kota" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kota'] :"") .'">
					    </div>
					    <div class="col-xs-2">
						<label>Kode Pos</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="kode_pos" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kode_pos'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No. Telp</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="notelp" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_telp'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No. HP 1 </label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="hp1" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_hp_1'] :"") .'">
					    </div>
					    <div class="col-xs-2">
						<label>No. HP 2 </label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="hp2" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_hp_2'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Contact Person</label>
                                            </div>
					    <div class="col-xs-10">
						<input type="text" readonly="" class="form-control" name="contact" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['contact_person'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Email</label>
                                            </div>
					    <div class="col-xs-10">
						<input type="text" readonly="" class="form-control" name="email" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['email'] :"").'" required="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Note</label>
                                            </div>
					    <div class="col-xs-10">
						<textarea class="form-control" readonly="" name="note">'.(isset($_GET["id_prospek"]) ? $data_prospek['note'] :"").'</textarea>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Chat History WA</label>
                                            </div>
					    <div class="col-xs-10">
						<textarea class="form-control" readonly="" id="editor1" name="chat_history_wa">'.(isset($_GET["id_prospek"]) ? $data_prospek['chat_history_wa'] :"").'</textarea>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Marketing</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" required="" class="form-control" name="nama_marketing" value="'.(isset($_GET["id_prospek"]) ? $data_prospek["marketing"] : $loggedin["username"]) .'">
						<input type="hidden" class="form-control" name="id_employee" value="'.(isset($_GET["id_prospek"]) ? $data_prospek["id_marketing"] : $loggedin["id_employee"]) .'">
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
					</div>

                                    </div><!-- /.box-body -->
								    
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
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

    $title	= 'Detail Prospek';
    $submenu	= "prospek";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
}
    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>