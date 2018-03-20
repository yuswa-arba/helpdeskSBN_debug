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
if(($loggedin["id_bagian"]) != "Marketing")  { die( 'Access Denied!' );}
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Cetak Formulir");
	global $conn;
	
$sqltotalcetak 		= "SELECT count(*) AS `totalcetak` FROM `gx_cetak_formulir` WHERE `id_marketing` = '".$loggedin["id_employee"]."' ";
$querytotalcetak 	= mysql_query($sqltotalcetak,$conn);
$resulttotalcetak	= mysql_fetch_array($querytotalcetak);

$sqltotalrecycle	= "SELECT count(*) AS `totalrecycle` FROM `gx_recycle_blank_form` WHERE `id_marketing` = '".$loggedin["id_employee"]."' ";
$querytotalrecycle 	= mysql_query($sqltotalrecycle,$conn);
$resulttotalrecycle	= mysql_fetch_array($querytotalrecycle);

$total				=  ($resulttotalcetak["totalcetak"] - $resulttotalrecycle["totalrecycle"]) ;

$sql_maxcetak = mysql_query("SELECT * FROM `gx_setting_perusahaan`;",$conn);
$row_maxcetak = mysql_fetch_array($sql_maxcetak);

$sql_cetak_formulir = mysql_fetch_array(mysql_query("SELECT * FROM `gx_cetak_formulir` ORDER BY `id_cetak_formulir` DESC", $conn));
$last_data  = $sql_cetak_formulir["id_cetak_formulir"] + 1;
$tanggal    = date("dmy");
$kode_cetak_formulir = 'SCF-'.$tanggal.''.sprintf("%04d", $last_data);
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box">
				
                                <div class="box-body table-responsive">
				
									<div class="box-header">
										<h3 class="box-title">Cetak Formulir</h3>
                                        
									</div><!-- /.box-header --><hr>
									';
								if($total >= $row_maxcetak["limit_blank_form"]){
									$content .='<div class="alert alert-danger"><b>Cetak Formulir Mencapai Limit </b></div>';
								}else{
									$content .='<div class="alert alert-info"><b>Max Limit :  '.$row_maxcetak["limit_blank_form"].' <br> Cetak :'.$total.'</b></div>';
								}
										$content .='
									<form role="form" name="myForm" method="POST" action="" target="_blank">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>Tanggal</label>
											</div>
											<div class="col-xs-6">
											<input class="form-control" type="text" readonly="" name="tanggal" value="'.date("Y-m-d").'" placeholder="tanggal">
											</div>
										</div>
										</div>
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>Kode Cetak Formulir</label>
											</div>
											<div class="col-xs-6">
											<input type="text" class="form-control" readonly="" id="kode_cetak_formulir" name="kode_cetak_formulir" value="'.(isset($_GET['id']) ? $row_masterformulir["kode_cetak_formulir"] : $kode_cetak_formulir).'">
											</div>
										</div>
										</div>
										
										
											<table id="formulir" class="table table-bordered table-hover">
												<thead>
													<tr>
													<th>No</th>
													<th>Kode Formulir</th>
													<th>Nama Formulir</th>
													<th> # </th>
													
													</tr>
												</thead>
												<tbody>';
											
											$sql_masterformulir = mysql_query("SELECT * FROM `gx_formulir` WHERE `level` = '0';",$conn);
											$no = 1;
											while ($row_masterformulir = mysql_fetch_array($sql_masterformulir)){
											$content .= '<tr>
													<td>'.$no.'</td>
													<td>'.$row_masterformulir['kode_formulir'].'</td>
													<td>'.$row_masterformulir['nama_formulir'].'</td>
													<td><input type="radio" name="id_formulir" value="'.$row_masterformulir["id_formulir"].'"></td>
													
													</tr>';
													$no++;
													
											}
											$sql_masterformulir_detail = mysql_query("SELECT * FROM `gx_formulir_detail` WHERE `level` = '0' AND `id_formulir` = '$row_masterformulir[id_formulir]' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
											$row_masterformulir_detail = mysql_fetch_array($sql_masterformulir_detail);
											$content .= '
												
											</tbody>
											</table>
											
												<!--<a href="'.URL_ADMIN.''.$row_masterformulir_detail["lokasi_file"].''.$row_masterformulir_detail["nama_file"].'" target="_BLANK" class="btn bg-olive btn-flat margin">Print</a>-->
												<input class="form_input_text" type="hidden" name="id" value="'.$row_masterformulir_detail["id"].'">
												<input class="form_input_text" type="hidden" name="link" value="'.URL_ADMIN.''.$row_masterformulir_detail["lokasi_file"].''.$row_masterformulir_detail["nama_file"].'">
												
											<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
												</div>
												<div class="col-xs-6">';
													if($total >= $row_maxcetak["limit_blank_form"]){
														$content .='<button type="submit" disabled value="Print" name="save" class="btn btn-default btn-flat margin">Print</button>';
													}else{
														$content .='<button type="submit" value="Print" name="save" class="btn btn-primary btn-flat margin">Print</button>';
													}
													$content .='
												
													
													<a href="'.URL_ADMIN.'administrasi/master_formulir" class="btn bg-red btn-flat margin ">Cancel</a>
												</div>
											</div>
											</div>
												
												
										</form>
									
									
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
			
if(isset($_POST["save"])){
		
		$id_cabang	= isset($_POST['cabang']) ? mysql_real_escape_string(trim($_POST['cabang'])) : '';
		$kode_cetak	= isset($_POST['kode_cetak_formulir']) ? mysql_real_escape_string(trim($_POST['kode_cetak_formulir'])) : '';
		$tanggal	= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
		$id_formulir	= isset($_POST['id_formulir']) ? mysql_real_escape_string(trim($_POST['id_formulir'])) : '';
		
		$sql_last_cetak  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_cetak_formulir` ORDER BY `id_cetak_formulir` DESC", $conn));
		$last_data  = $sql_last_cetak["id_cetak_formulir"] + 1;
			
			if($id_formulir != ''){
				if($total >= $row_maxcetak){
					echo "<script language='JavaScript'>
						alert('Total Cetak Telah Mencapai Limit');
						window.history.go(-1);
						</script>";
				}else{
					$sql_insert = "INSERT INTO `gx_cetak_formulir`(`id_cetak_formulir`, `id_cabang`, `id_marketing`, `kode_cetak_formulir`, `tanggal`,
											`id_formulir`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
										VALUES ('', '".$id_cabang."', '".$loggedin["id_employee"]."', '".$kode_cetak."', '".$tanggal."',
											'".$id_formulir."', '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
					//echo $sql_insert;
					mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
												   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
												   window.history.go(-1);
											   </script>");
					
					echo header('location: print_form.php?id='.$last_data.'');
				}
			}else{
				echo "<script language='JavaScript'>
						alert('Tidak ada Formulir yang dicetak !');
						window.history.go(-1);
						</script>";
			}
			  
			    
	    }

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
		
    ';
			

    $title	= 'Cetak Formulir';
    $submenu	= "cetak_formulir";
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