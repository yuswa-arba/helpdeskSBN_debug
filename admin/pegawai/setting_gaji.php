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



enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Seting Gaji");
 
if(isset($_GET["id"]))
{
    
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_rekap_absensi` WHERE `id_rekap`='$id_data' AND `level`='0' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}
$query = mysql_query("SELECT * FROM `gx_setting_gaji_karyawan` WHERE `level`='0' ORDER BY `id_setting_gaji_karyawan` DESC", $conn);


    $link_form_add_data = '<a href="form_setting_gaji.php" class="btn bg-maroon btn-flat margin">Create New</a>';
    $content = '
		<section class="content">
		 <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				'.$link_form_add_data.' 
				</div>
			    </div>
			</div>
		    </div>
		
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                  <h3 class="box-title">Setting Gaji Karyawan</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
 				
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <input type="hidden" name="" value="">
				    <div class="box-body">
				    <table id="example1" class="table table-bordered table-striped">
												<tr><td>KODE</td><td>NAMA</td><td>LEVEL</td><td>GAJI POKOK</td><td>TUNJANGAN JABATAN</td><td>DANA PENSIUN</td><td>JAMSOSTEK</td><td>INSENTIF HADIR</td><td>TOTAL GAJI</td><td>TOTAL GAJI DITERIMA</td><td>KOPERASI</td><td>Action</td></tr>';
												while($row = mysql_fetch_array($query)){
												    $content .= '<tr><td>'.$row['kode'].'</td><td>'.$row['nama'].'</td><td>'.$row['level'].'</td> <td>'.$row['gaji_pokok'].'</td><td>'.$row['tunjangan_jabatan'].'</td><td>'.$row['dana_pensiun'].'</td> <td>'.$row['jamsostek'].'</td><td>'.$row['insentif_hadir'].'</td><td>'.$row['total_gaji'].'</td> <td>'.$row['total_gaji_diterima'].'</td><td>'.$row['koperasi'].'</td><td> <a href="form_setting_gaji.php?id='.$row['id_setting_gaji_karyawan'].'">Edit</a> | <a href="detail_setting_gaji.php?id='.$row['id_setting_gaji_karyawan'].'">Detail</a> </td> </tr>';    
												}
												
$data_total = mysql_fetch_array(mysql_query("SELECT SUM(`total_gaji`) AS  `total_gaji_karyawan` FROM `gx_setting_gaji_karyawan` WHERE `level`='0'", $conn));                                                                                                
												$content .= '
												<tr><td colspan="12" >Total: '.$data_total['total_gaji_karyawan'].'</td></tr>
                                    </table>

                                                                                
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label><h2>Hitung Gaji</h2></label>
											</div>
										</div>
										</div>
				
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>PERIODE</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="" name="periode" placeholder="" value="'.(isset($_GET['id']) ? $row_data["periode"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>TAHUN</label>
											</div>
											<div class="col-xs-4">
												<select name="tahun" class="form-control" required="required">';
												    $content .= '<option value="">Pilih Tahun</option>';
												    for($thn=date("Y"); $thn<=date("Y")+5; $thn++){
													$content .= '<option value="'.$thn.'">'.$thn.'</option>';
												    }
												$content .= '    
												</select>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>ABSENSI</label>
											</div>
											<div class="col-xs-4">
												<!--<input type="text" class="form-control" id="" name="mulai_tanggal" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["mulai_tanggal"] : "").'" required="" >-->
												<select name="mulai_tanggal" class="form-control" required="required">';
												
												    $content .= '<option value="">Pilih Tanggal</option>';
												    for($tgl=1; $tgl<=31; $tgl++){
													$content .= '<option value="'.$tgl.'">'.$tgl.'</option>';
												    }
												$content .= '    
												</select>
											</div>
											<div class="col-xs-1">
												<label>sd</label>
											</div>
											<div class="col-xs-4">
												<!--<input type="text" class="form-control" id="" name="finnish_tanggal" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["finnish_tanggal"] : "").'" required="" >-->
												<select name="finnish_tanggal" class="form-control" required="required">';
												    $content .= '<option value="">Pilih Tanggal</option>';
												    for($tgl=1; $tgl<=31; $tgl++){
													$content .= '<option value="'.$tgl.'">'.$tgl.'</option>';
												    }
												$content .= '    
												</select>
											</div>
										</div>
										</div>
												
							
 						
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <!--<button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>-->
					<button type="submit" name="hitung" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
			
}

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                $("#datepicker2").datepicker({format: "yyyy-mm-dd"});  
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
		';

    $title	= 'Setting Gaji';
    $submenu	= "setting_gaji";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
} else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>