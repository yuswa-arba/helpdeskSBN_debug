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
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Permohonan Justifikasi marketing");
    global $conn;

    $total = mysql_num_rows(mysql_query("SELECT `no_justifikasi` FROM `gx_permohonan_justifikasi` WHERE  `tanggal`LIKE '%".date("Y-m")."%';", $conn));
	    
    $no_justifikasi = "GXJ".substr(date("Y-m-d"), 1).sprintf("%04d", $total);   
	    if(isset($_GET['id_permohonan_justifikasi'])){
		$get_id = isset($_GET['id_permohonan_justifikasi']) ? mysql_real_escape_string(trim(strip_tags($_GET['id_permohonan_justifikasi']))) : "";
		$data_permohonan_justifikasi = mysql_fetch_array(mysql_query("SELECT * FROM `gx_permohonan_justifikasi` WHERE  `gx_permohonan_justifikasi`.`id_permohonan_justifikasi` = '$get_id'  LIMIT 0,1;", $conn));
	    }
        
        if(isset($_GET['id_survey'])){
		$get_id = isset($_GET['id_survey']) ? mysql_real_escape_string(trim(strip_tags($_GET['id_survey']))) : "";
		$data_survey = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spksurvey` WHERE  `no_spksurvey` = '$get_id' LIMIT 0,1;", $conn));
        //echo "SELECT * FROM `gx_jawab_spksurvey` WHERE  `no_spksurvey` = '$get_id' LIMIT 0,1;";
	    }
        
    $content ='<section class="content-header">
                    <h1>
                        Form Permohonan Justifikasi                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			<ul class="nav nav-tabs" role="tablist" id="myTab">
			    <li role="presentation" '.(($_GET["t"] == "o") || ($_GET["t"] == "a") ? 'class="active"' : "") .' ><a href="#tab1" aria-controls="customer" role="tab" data-toggle="tab">Pelanggan Lama</a></li>
			    <li role="presentation" '.(($_GET["t"] == "n") ? 'class="active"' : "") .'><a href="#tab2" aria-controls="troubleticket" role="tab" data-toggle="tab">Pelanggan Baru</a></li>
			</ul>
			    <div class="tab-content">
                            <div role="tabpanel" '.(($_GET["t"] == "o") || ($_GET["t"] == "a") ? 'class="tab-pane active"' : 'class="tab-pane"') .'  id="tab1">
                            <div class="box">
				
				
                                <div class="box-body table-responsive">
				
				
        <form action="" role="form" name="myForm"  method="POST" >
	  
	<div >
	    <fieldset>
		<legend>Data Permohonan Justifikasi</legend>
		<div class="table-container table-form">
		   <div class="box-body">
					
						
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>No. Justifikasi*</label>
			</div>
					    <div class="col-xs-4">
						
			
			  <input type="text" class="form-control required" required="" readonly="" style="" id="no_justifikasi" name="no_justifikasi" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi["no_justifikasi"] : $no_justifikasi) .'" />
			 </div>
					    <div class="col-xs-2">
						
			  <label>Tanggal</label>
			</div>
					    <div class="col-xs-4">
					
			  <input name="id_permohonan_justifikasi" type="hidden" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $_GET["id_permohonan_justifikasi"] :"") .'" readonly="">
			  <input class="form-control hasDatepicker" required="" readonly="" name="tanggal" id="datepicker" placeholder="Tanggal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['tanggal'] : date("Y-m-d") ) .'" >
			  </div>
                                        </div>
					</div>
			
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kode Customer</label>
			</div>
					    <div class="col-xs-4">
			  <input class="form-control" required="" name="kode_customer" readonly="" id="kode_customer" placeholder="Kode Customer" type="text"   value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['kode_customer'] :"") .'" >
			
			</div>
					    <div class="col-xs-2">
					
			
			  <label>Nama Customer</label>
			 </div>
					    <div class="col-xs-4">
					
			  <input class="form-control required" required="" readonly="" name="nama_customer" placeholder="Nama Customer" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['nama_customer'] : "") .'">

				</div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			
			  <label>Longitude</label>
	</div>
					    <div class="col-xs-4">
						<input type="text" name="longitude"  readonly="" class="form-control required" required="" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['longitude'] :"") .'" placeholder="Longitude">
	 </div>
	 <div class="col-xs-2">
			  <label>Latitude</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control required" required="" readonly="" name="latitude" placeholder="Latitude" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['latitude'] :"") .'" >
	</div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Tiang Terdekat</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control required" required="" readonly="" name="tiang_terdekat" placeholder="Tiang Terdekat" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['tiang_terdekat'] :"") .'" >
	 </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>Paket</label>
					    </div>
					    <div class="col-xs-3">
						<input class="form-control" type="radio" name="paket" value="yes" style="float:left;" '.((isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") && $data_permohonan_justifikasi["paket"]== "yes" ) ? "checked" :"") .'>Yes 
						<input class="form-control" type="radio" name="paket" value="no" style="float:left;" '.((isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") && $data_permohonan_justifikasi["paket"]== "no" ) ? "checked" :"") .'>No
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kode Paket</label>
			</div>
			<div class="col-xs-4">
			  <input class="form-control required" required="" name="paket_koneksi" readonly="" placeholder="Kode Paket" type="text"   value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['kode_paket'] :"") .'">
			
			  
			
		</div>
					    <div class="col-xs-2">
	
			      <label>Nama Paket</label>
	</div>
	<div class="col-xs-4">
			    <input class="form-control required" readonly="" required="" name="nama_koneksi" placeholder="Nama Paket" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['nama_paket'] :"") .'">
		        
				</div></div></div>
	
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kontrak</label>
	</div>
	<div class="col-xs-4">
			    <input class="form-control required" required="" readonly=""  name="kontrak" placeholder="Kontrak" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['kontrak'] :"") .'">
		        </div>
			<div class="col-xs-2">
			<label>bulan</label>
			</div>
			<div class="col-xs-4">
			</div>
			   </div></div>
	<div class="form-group">
	    
	    <div class="row"> <div class="col-xs-6">
                                     <h3 class="box-title">Harga Normal</h3>
		</div>
	
	 <div class="col-xs-6">
	     <h3 class="box-title">Harga Justifikasi</h3>
				 </div><!-- /.box-header -->
			</div>
	</div>
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Setup Fee</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control required" required="" id="harga" name="setup_fee_normal" readonly="" placeholder="Setup Fee Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['setup_fee_normal'] :"") .'">
		        </div>
			<div class="col-xs-2">
			  <label>Setup Fee</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control required" required="" id="harga" name="setup_fee_justifikasi" readonly=""  placeholder="Setup Fee Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['setup_fee_justifikasi'] :"0") .'">
		        </div>
			   </div></div>
			   
			   
		
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					     <label>Abonemen</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" id="harga" readonly="" name="abonemen_normal" placeholder="Abonemen Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['abonemen_normal'] :"").'">
		           </div>
			      <div class="col-xs-2">
					     <label>Abonemen</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" readonly=""  id="harga" name="abonemen_justifikasi" placeholder="Abonemen Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['abonemen_justifikasi'] :"0").'">
		           </div>
			   </div></div>
					    
			
				<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					     <label>Monthly Fee</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" readonly="" id="harga" name="monthly" placeholder="Monthly Fee Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['monthly_fee_normal'] :"").'">
		           </div>
			      <div class="col-xs-2">
					     <label>Monthly Fee</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" readonly=""  id="harga"  name="monthly_fee_justifikasi" placeholder="Monthly Fee Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['monthly_fee_justifikasi'] :"0").'">
		           </div>
			   </div></div>
					   
			
			    
			  <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					     <label>Bandwith</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" readonly=""  name="bandwith_normal" placeholder="Bandwith Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['bandwith_normal'] :"").'">
		           </div>
			      <div class="col-xs-2">
					     <label>Bandwith</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" readonly=""   name="bandwith_justifikasi" placeholder="Bandwith Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['bandwith_justifikasi'] :"0").'">
		           </div>
			   </div></div>
			
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Remarks</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="remarks" class="form-control required" readonly=""  required="" placeholder="Remarks" style="resize: none;"> '.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['remarks'] :"").' </textarea>
			</div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_permohonan_justifikasi']) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_permohonan_justifikasi']) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi["user_upd"]." ".$data_permohonan_justifikasi["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
			 <div class="form-group">
					 <div class="row">
					     <div class="col-xs-2">
					     <div>
					     <div class="col-xs-4">
	       <input name="created_by" value="'.$loggedin["username"].'" type="hidden">
	       <input name="id_employee" value="'.$loggedin["id_employee"].'" type="hidden">
	     </div></div>
	     </div>
			
		      </div><br />
	      
	    
	    </div>
	    </fieldset>
	    </div>
	
	
	</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    </div>
			    
			    <div role="tabpanel"'.(($_GET["t"] == "n") ? 'class="tab-pane active"' : 'class="tab-pane"') .'  id="tab2">
                            <div class="box">
				
				
                                <div class="box-body table-responsive">
				
				
        <form action="" role="form" name="myFormtab2"  method="POST" >
	  
	<div >
	    <fieldset>
		<legend>Data Permohonan Justifikasi</legend>
		<div class="table-container table-form">
		    
		    <div class="box-body">
					<div class="col-xs-12">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>No. Justifikasi*</label>
			</div>
					    <div class="col-xs-4">
						
			
			  <input type="text" class="form-control required" required="" readonly="" style="" id="no_justifikasi" name="no_justifikasi" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi["no_justifikasi"] : $no_justifikasi) .'" />
			 </div>
					    <div class="col-xs-2">
						
			  <label>Tanggal</label>
			</div>
					    <div class="col-xs-4">
					
			  <input name="id_permohonan_justifikasi" type="hidden" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $_GET["id_permohonan_justifikasi"] :"") .'" readonly="">
			  <input class="form-control hasDatepicker" required="" readonly="" name="tanggal" id="datepicker" placeholder="Tanggal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['tanggal'] : date("Y-m-d") ) .'" >
			  </div>
                                        </div>
					</div>
			
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kode Survey</label>
			</div>
					    <div class="col-xs-4">
			  <input class="form-control" required="" name="kode_survey" readonly="" id="kode_survey" placeholder="Kode Survey"  type="text"
              value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['kode_survey'] :"") .''.(isset($_GET["id_survey"]) && ($_GET["t"] == "n") ? $data_survey['no_spksurvey'] :"") .'" >
			  <input class="form-control" required="" name="kode_jawab_survey" readonly="" id="kode_jawab_survey" placeholder="Kode Jawab Survey" type="hidden"
              value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['kode_jawab_survey'] :"") .''.(isset($_GET["id_survey"]) && ($_GET["t"] == "n") ? $data_survey['no_jawab'] :"") .'" >
			
			</div>
					    <div class="col-xs-2">
					
			
			  <label>Nama Customer</label>
			 </div>
					    <div class="col-xs-4">
					
			  <input class="form-control required" required="" readonly="" name="nama_customer" placeholder="Nama Customer" type="text"
              value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['nama_customer'] : "") .''.(isset($_GET["id_survey"]) && ($_GET["t"] == "n") ? $data_survey['nama'] :"") .'">

				</div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			
			  <label>Longitude</label>
	</div>
					    <div class="col-xs-4">
						<input type="text" name="longitude"  readonly="" class="form-control required" required=""
                        value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['longitude'] :"") .''.(isset($_GET["id_survey"]) && ($_GET["t"] == "n") ? $data_survey['longitude'] :"") .'" placeholder="Longitude">
	 </div>
	 <div class="col-xs-2">
			  <label>Latitude</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control required" readonly=""  name="latitude" placeholder="Latitude" type="text"
              value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['latitude'] :"") .''.(isset($_GET["id_survey"]) && ($_GET["t"] == "n") ? $data_survey['latitude'] :"") .'" >
	</div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Tiang Terdekat</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control required" readonly=""  name="tiang_terdekat" placeholder="Tiang Terdekat" type="text"
              value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['tiang_terdekat'] :"") .'" >
	 </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>Paket</label>
					    </div>
					    <div class="col-xs-3">
						<input class="form-control" type="radio" name="paket" value="yes" style="float:left;" '.((isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") && $data_permohonan_justifikasi["paket"]== "yes" ) ? "checked" :"") .'>Yes 
						<input class="form-control" type="radio" name="paket" value="no" style="float:left;" '.((isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") && $data_permohonan_justifikasi["paket"]== "no" ) ? "checked" :"") .'>No
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kode Paket</label>
			</div>
			<div class="col-xs-4">
			  <input class="form-control required" required=""  name="paket_koneksi" readonly="" placeholder="Kode Paket" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['kode_paket'] :"") .'">
			
			  
			
		</div>
					    <div class="col-xs-2">
	
			      <label>Nama Paket</label>
	</div>
	<div class="col-xs-4">
			    <input class="form-control required" readonly="" required="" name="nama_koneksi" placeholder="Nama Paket" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['nama_paket'] :"") .'">
		        
				</div></div></div>
	
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kontrak</label>
	</div>
	<div class="col-xs-4">
			    <input class="form-control required" required="" name="kontrak" readonly="" placeholder="Kontrak" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['kontrak'] :"") .'">
		        </div>
			<div class="col-xs-2">
			<label>bulan</label>
			</div>
			<div class="col-xs-4">
			</div>
			   </div></div>
	<div class="form-group">
	    
	    <div class="row"> <div class="col-xs-6">
                                     <h3 class="box-title">Harga Normal</h3>
		</div>
	
	 <div class="col-xs-6">
	     <h3 class="box-title">Harga Justifikasi</h3>
				 </div><!-- /.box-header -->
			</div>
	</div>
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Setup Fee</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control required" required="" id="harga" name="setup_fee_normal" readonly="" placeholder="Setup Fee Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['setup_fee_normal'] :"") .'">
		        </div>
			<div class="col-xs-2">
			  <label>Setup Fee</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control required" required="" id="harga" readonly="" name="setup_fee_justifikasi" placeholder="Setup Fee Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['setup_fee_justifikasi'] :"0") .'">
		        </div>
			   </div></div>
			   
			   
		
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					     <label>Abonemen</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" id="harga" readonly="" name="abonemen_normal" placeholder="Abonemen Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['abonemen_normal'] :"").'">
		           </div>
			      <div class="col-xs-2">
					     <label>Abonemen</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" id="harga" readonly="" name="abonemen_justifikasi" placeholder="Abonemen Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['abonemen_justifikasi'] :"0").'">
		           </div>
			   </div></div>
					    
			
				<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					     <label>Monthly Fee</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" readonly="" id="harga" name="monthly" placeholder="Monthly Fee Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['monthly_fee_normal'] :"").'">
		           </div>
			      <div class="col-xs-2">
					     <label>Monthly Fee</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" id="harga" readonly="" name="monthly_fee_justifikasi" placeholder="Monthly Fee Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['monthly_fee_justifikasi'] :"0").'">
		           </div>
			   </div></div>
					   
			
			    
			  <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					     <label>Bandwith</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" readonly=""  name="bandwith_normal" placeholder="Bandwith Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['bandwith_normal'] :"").'">
		           </div>
			      <div class="col-xs-2">
					     <label>Bandwith</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" readonly=""   name="bandwith_justifikasi" placeholder="Bandwith Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['bandwith_justifikasi'] :"0").'">
		           </div>
			   </div></div>
			
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Remarks</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="remarks" class="form-control required" required="" readonly=""  placeholder="Remarks" style="resize: none;"> '.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['remarks'] :"").' </textarea>
			</div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_permohonan_justifikasi']) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_permohonan_justifikasi']) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi["user_upd"]." ".$data_permohonan_justifikasi["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
			 <div class="form-group">
					 <div class="row">
					     <div class="col-xs-2">
					     <div>
					     <div class="col-xs-4">
	       <input name="created_by" value="'.$loggedin["username"].'" type="hidden">
	       <input name="id_employee" value="'.$loggedin["id_employee"].'" type="hidden">
	     </div></div>
	     </div>
			
		      </div><br />
	      
	    
	    </div>
	    </fieldset>
	    </div>
	
	
	</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    </div>
			    </div>
			    
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
        </script>';

    $title	= 'Detail Permohonan Justifikasi';
    $submenu	= "Permohonan_justifikasi";
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