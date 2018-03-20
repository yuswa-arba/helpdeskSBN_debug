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
if($loggedin["group"] == 'staff'){
global $conn;
if(isset($_GET['id'])){
    $get_id = isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
    $data_jawabsurvey = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spksurvey` WHERE `gx_jawab_spksurvey`.`id_jawab_spksurvey` = '$get_id';", $conn));
    $data_survey = mysql_fetch_array(mysql_query("SELECT * FROM `gx_survey` WHERE `no_spk_survey` = '".$data_jawabsurvey["no_spksurvey"]."';", $conn));
}

    
    $content ='<section class="content-header">
                    <h1>
                        Detail Jawab SPK Survey
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
                                <form role="form" name="myForm" method="POST" enctype="multipart/form-data" action="">
                                    <div class="box-body">
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>No. Jawaban SPK Survey</label>
											</div>
											<div class="col-xs-3">
											: '.$data_jawabsurvey['no_jawab'].'
											</div>
											
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>No. SPK</label>
											</div>
											<div class="col-xs-4">
											: '.$data_jawabsurvey['no_spksurvey'].'
											<!--<a href="data_survey.php?r=myForm"  onclick="return valideopenerform(\'data_survey.php?r=myForm\',\'survey\');">Search Survey</a>-->
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>Nama</label>
											</div>
											<div class="col-xs-9">
											: '.$data_jawabsurvey['nama'].'
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>Perusahaan</label>
											</div>
											<div class="col-xs-9">
											: '.$data_jawabsurvey['perusahaan'].'
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>Alamat</label>
											</div>
											<div class="col-xs-9">
												: '.$data_jawabsurvey['alamat'].'
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>Kota</label>
																</div>
											<div class="col-xs-9">
											: '.$data_jawabsurvey['kota'].'
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>No. Telp</label>
																</div>
											<div class="col-xs-9">
											: '.$data_jawabsurvey['no_telp'].'
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>No. HP 1 </label>
																</div>
											<div class="col-xs-9">
											: '.$data_jawabsurvey['no_hp_1'].'
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>Email</label>
																</div>
											<div class="col-xs-9">
											: '.$data_jawabsurvey['email'].'
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>Longitude</label>
																</div>
											<div class="col-xs-4">
											: '.$data_jawabsurvey['longitude'] .'
											</div>
											<div class="col-xs-1">
											<label>Latitude</label>
																</div>
											<div class="col-xs-4">
											: '.$data_jawabsurvey['latitude'] .'
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>No. Tiang Terdekat</label>
																</div>
											<div class="col-xs-4">
											: '.$data_jawabsurvey['no_tiang'] .'
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>Marketing</label>
																</div>
											<div class="col-xs-9">
											: '.$data_survey['marketing'] .'
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>Prospek</label>
																</div>
											<div class="col-xs-4">
											: <input type="checkbox" class="form-control" name="prospek" value="'.$data_jawabsurvey['check_prospek'].'" '.((isset($_GET["id"]) && $data_jawabsurvey['check_prospek'] == "1") ? "checked" : "").' readonly="">
											</div>
											<div class="col-xs-1">
											<label>pending</label>
																</div>
											<div class="col-xs-4">
											: <input type="checkbox" class="form-control" name="pending" value="'.$data_jawabsurvey['check_pending'].'" '.((isset($_GET["id"]) && $data_jawabsurvey['check_pending'] == "1") ? "checked" : "").' readonly="">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>Normal</label>
																</div>
											<div class="col-xs-4">
											: <input type="checkbox" class="form-control" name="normal" value="'.$data_jawabsurvey['check_normal'].'" '.((isset($_GET["id"]) && $data_jawabsurvey['check_normal'] == "1") ? "checked" : "").' readonly="">
											</div>
											<div class="col-xs-1">
											<label>Justifikasi</label>
																</div>
											<div class="col-xs-4">
											: <input type="checkbox" class="form-control" name="justifikasi" value="'.$data_jawabsurvey['check_justifikasi'].'" '.((isset($_GET["id"]) && $data_jawabsurvey['check_justifikasi'] == "1") ? "checked" : "").' readonly="">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>Remarks</label>
																</div>
											<div class="col-xs-9">
											: '.$data_jawabsurvey['remarks'].'
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>Foto Lokasi</label>
																</div>
											<div class="col-xs-9">';
											$sqlimg_jawabsurvey = mysql_query("SELECT * FROM `gx_upload` WHERE `gx_upload`.`id_jawab_spksurvey` = '".$data_jawabsurvey["id_jawab_spksurvey"]."';", $conn);
											while ($row_img = mysql_fetch_array($sqlimg_jawabsurvey)){
											$content .='<a class="group3" href="'.URL_ADMIN.'upload/jawab_spk_survey/'.$row_img['nama_file'].'" title=""><img src="'.URL_ADMIN.'upload/jawab_spk_survey/'.$row_img['nama_file'].'" width="200px" height="150px"></a>';
											}
											$content .='</div>
										</div>
										</div>
										
										</div>
                                    </div><!-- /.box-body -->
									
                                    
                                </form>
				    <div class="box-footer" align="center">
                                       
                                    </div>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
	    
$plugins = '

		<link rel="stylesheet" href="../../js/colorbox/example1/colorbox.css" />
		<script src="../../js/colorbox/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:\'group1\'});
				$(".group2").colorbox({rel:\'group2\', transition:"fade"});
				$(".group3").colorbox({rel:\'group3\', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:\'group4\', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert(\'onOpen: colorbox is about to open\'); },
					onLoad:function(){ alert(\'onLoad: colorbox has started to load the targeted content\'); },
					onComplete:function(){ alert(\'onComplete: colorbox has displayed the loaded content\'); },
					onCleanup:function(){ alert(\'onCleanup: colorbox has begun the close process\'); },
					onClosed:function(){ alert(\'onClosed: colorbox has completely closed\'); }
				});

				$(\'.non-retina\').colorbox({rel:\'group5\', transition:\'none\'})
				$(\'.retina\').colorbox({rel:\'group5\', transition:\'none\', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$(\'#click\').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
    ';

    $title	= 'Detail Jawab SPK Survey';
    $submenu	= "survey";
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