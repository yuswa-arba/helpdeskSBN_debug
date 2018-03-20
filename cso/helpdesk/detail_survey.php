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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
global $conn;

if(isset($_GET['id_survey'])){
		$get_id = isset($_GET['id_survey']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_survey']))) : "";
		$data_survey = mysql_fetch_array(mysql_query("SELECT * FROM `gx_survey` WHERE `gx_survey`.`id_survey` = '$get_id';", $conn));
		$data_cabang = mysql_fetch_array(mysql_query("SELECT * FROM `gx_cabang` WHERE `gx_cabang`.`id_cabang` = '$data_survey[cabang]';", $conn));
		//$data_marketing = mysql_fetch_array(mysql_query("SELECT * FROM `gx_pegawai` WHERE `id_employee` = '$data_survey[marketing]';", $conn));
}
    
    $content ='<section class="content-header">
                    <h1>
                        Detail SPK Survey
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Detail SPK Survey</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="myForm" method="POST" action="">
                                    <div class="box-body">
					<div class="col-xs-12">
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-9">
						'.$data_cabang['nama_cabang'].'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. SPK Survey</label>
					    </div>
					    <div class="col-xs-3">
						'.$data_survey['no_spk_survey'].'
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-4">
						'.$data_survey['tanggal'].'
					    </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Prospek</label>
					    </div>
					    <div class="col-xs-3">
						'.$data_survey['no_prospek'].'
					    </div>
					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-4">
						'.$data_survey['kode_cust'].'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-9">
						'.$data_survey['nama_cust'].'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Perusahaan</label>
					    </div>
					    <div class="col-xs-9">
						'.$data_survey['nama_perusahaan'].'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-9">
					        '.$data_survey['alamat'].'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kelurahan</label>
                                            </div>
					    <div class="col-xs-3">
						'.$data_survey['kelurahan'].'
					    </div>
					    <div class="col-xs-2">
						<label>Kecamatan</label>
                                            </div>
					    <div class="col-xs-4">
						'.$data_survey['kecamatan'].'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kota</label>
                                            </div>
					    <div class="col-xs-3">
						'.$data_survey['kota'].'
					    </div>
					    <div class="col-xs-2">
						<label>Kode Pos</label>
                                            </div>
					    <div class="col-xs-4">
						'.$data_survey['kode_pos'].'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Telp</label>
                                            </div>
					    <div class="col-xs-9">
						'.$data_survey['no_telp'].'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. HP 1 </label>
                                            </div>
					    <div class="col-xs-3">
						'.$data_survey['no_hp_1'].'
					    </div>
					    <div class="col-xs-2">
						<label>No. HP 2 </label>
                                            </div>
					    <div class="col-xs-4">
						'.$data_survey['no_hp_2'].'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Contact Person</label>
                                            </div>
					    <div class="col-xs-9">
						'.$data_survey['contact_person'].'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Email</label>
                                            </div>
					    <div class="col-xs-9">
						'.$data_survey['email'].'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Longitude</label>
                                            </div>
					    <div class="col-xs-3">
						'.$data_survey['longitude'].'
					    </div>
					    <div class="col-xs-2">
						<label>Latitude</label>
                                            </div>
					    <div class="col-xs-4">
						'.$data_survey['latitude'].'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Marketing</label>
                                            </div>
					    <div class="col-xs-9">
						'.$data_survey['marketing'].'
					    </div>
                                        </div>
					</div>
					
					</div>

                                    </div><!-- /.box-body -->

                                </form>
				<div class="box-header">
                                    <h3 class="box-title">List Jawaban SPK Survey</h3>
                                </div><!-- /.box-header -->
				<table id="formulir" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>No. Jawab Survey</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No. telp</th>
						<th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_master_jawabsurvey = mysql_query("SELECT * FROM `gx_jawab_spksurvey` WHERE `level` = '0' AND `no_spksurvey` = '$data_survey[no_spk_survey]' ORDER BY `id_jawab_spksurvey` DESC LIMIT 0,100;",$conn);
$no = 1;
while ($row_master_jawabsurvey = mysql_fetch_array($sql_master_jawabsurvey))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td><a href="detail_jawab_survey.php?id='.$row_master_jawabsurvey['id_jawab_spksurvey'].'">'.$row_master_jawabsurvey['no_jawab'].'</a></td>
		    <td>'.$row_master_jawabsurvey['nama'].'</td>
		    <td>'.$row_master_jawabsurvey['alamat'].'</td>
		    <td>'.$row_master_jawabsurvey['no_telp'].'</td>
		    <td>'.$row_master_jawabsurvey['date_add'].'</td>
		    
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    <div class="box-footer" align="center">
                                       
                                    </div>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
	    
$plugins = '
    ';

    $title	= 'Detail Survey';
    $submenu	= "survey";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_CSO."logout.php");
    }

?>