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
			  <input class="form-control" required="" name="kode_customer" readonly="" id="kode_customer" placeholder="Kode Customer" type="text" onclick="return valideopenerform(\'data_cust.php?r=myForm&f=permohonan_justifikasi\',\'cust\');" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['kode_customer'] :"") .'" >
			
			</div>
					    <div class="col-xs-2">
					
			
			  <label>Nama Customer</label>
			 </div>
					    <div class="col-xs-4">
					
			  <input class="form-control required" maxlength="50" required="" readonly="" name="nama_customer" placeholder="Nama Customer" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['nama_customer'] : "") .'">

				</div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			
			  <label>Longitude</label>
	</div>
					    <div class="col-xs-4">
						<input type="text" name="longitude" maxlength="20"  readonly="" class="form-control required" required="" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['longitude'] :"") .'" placeholder="Longitude">
	 </div>
	 <div class="col-xs-2">
			  <label>Latitude</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control required" maxlength="20" required="" readonly="" name="latitude" placeholder="Latitude" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['latitude'] :"") .'" >
	</div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Tiang Terdekat</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control required" maxlength="10" required="" name="tiang_terdekat" placeholder="Tiang Terdekat" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['tiang_terdekat'] :"") .'" >
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
			  <input class="form-control required" required="" name="paket_koneksi" readonly="" placeholder="Kode Paket" type="text" onclick="return valideopenerform(\'data_paket_2.php?r=myForm\',\'paket\');"  value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['kode_paket'] :"") .'">
			
			  
			
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
			    <input class="form-control required" maxlength="3" required="" name="kontrak" placeholder="Kontrak" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['kontrak'] :"") .'">
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
			<input class="form-control required" maxlength="20" required="" id="harga" name="setup_fee_justifikasi" placeholder="Setup Fee Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['setup_fee_justifikasi'] :"0") .'">
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
					    <input class="form-control required" maxlength="20" required="" id="harga" name="abonemen_justifikasi" placeholder="Abonemen Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['abonemen_justifikasi'] :"0").'">
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
					    <input class="form-control required" maxlength="20" required="" id="harga"  name="monthly_fee_justifikasi" placeholder="Monthly Fee Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['monthly_fee_justifikasi'] :"0").'">
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
					    <input class="form-control required" maxlength="20" required=""  name="bandwith_justifikasi" placeholder="Bandwith Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['bandwith_justifikasi'] :"0").'">
		           </div>
			   </div></div>
			
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Remarks</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="remarks" class="form-control required" required="" placeholder="Remarks" style="resize: none;"> '.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? $data_permohonan_justifikasi['remarks'] :"").' </textarea>
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
	       <input type="submit" class="button button-primary" data-icon="v" name="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "o") ? "update" : "save") .'" value="Save">
	    
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
			  <input class="form-control" required="" name="kode_survey" readonly="" id="kode_survey" placeholder="Kode Survey" onclick="return valideopenerform(\'data_jawab_survey.php?r=myFormtab2\',\'survey\');" type="text"
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
						<input type="text" name="longitude" maxlength="20"  readonly="" class="form-control required" required=""
                        value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['longitude'] :"") .''.(isset($_GET["id_survey"]) && ($_GET["t"] == "n") ? $data_survey['longitude'] :"") .'" placeholder="Longitude">
	 </div>
	 <div class="col-xs-2">
			  <label>Latitude</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control required" maxlength="20" readonly=""  name="latitude" placeholder="Latitude" type="text"
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
			  <input class="form-control required" required=""  onclick="return valideopenerform(\'data_paket_2.php?r=myFormtab2\',\'paket\');" name="paket_koneksi" readonly="" placeholder="Kode Paket" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['kode_paket'] :"") .'">
			
			  
			
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
			    <input class="form-control required" maxlength="3" required="" name="kontrak" placeholder="Kontrak" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['kontrak'] :"") .'">
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
			<input class="form-control required" maxlength="20" required="" id="harga" name="setup_fee_justifikasi" placeholder="Setup Fee Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['setup_fee_justifikasi'] :"0") .'">
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
					    <input class="form-control required" maxlength="20" required="" id="harga" name="abonemen_justifikasi" placeholder="Abonemen Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['abonemen_justifikasi'] :"0").'">
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
					    <input class="form-control required" maxlength="20" required="" id="harga"  name="monthly_fee_justifikasi" placeholder="Monthly Fee Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['monthly_fee_justifikasi'] :"0").'">
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
					    <input class="form-control required" maxlength="20" required=""  name="bandwith_justifikasi" placeholder="Bandwith Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['bandwith_justifikasi'] :"0").'">
		           </div>
			   </div></div>
			
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Remarks</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="remarks" class="form-control required" required="" placeholder="Remarks" style="resize: none;"> '.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? $data_permohonan_justifikasi['remarks'] :"").' </textarea>
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
	       <input type="submit" class="button button-primary" data-icon="v" name="'.(isset($_GET["id_permohonan_justifikasi"]) && ($_GET["t"] == "n") ? "updatetab2" : "savetab2") .'" value="Save">
	    
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

$save = isset($_POST["save"]) ? $_POST["save"] : "";
$update = isset($_POST["update"]) ? $_POST["update"] : "";
$savetab2 = isset($_POST["savetab2"]) ? $_POST["savetab2"] : "";
$updatetab2 = isset($_POST["updatetab2"]) ? $_POST["updatetab2"] : "";
	if($save == "Save"){
	    /* `id_permohonan_justifikasi`, `no_justifikasi`, `tanggal`, `kode_customer`, `nama_customer`, `longitude`, `latitude`, `tiang_terdekat`, `kode_paket`, `nama_paket`, `kontrak`, `setup_fee_normal`, `abonemen_normal`, `monthly_fee_normal`, `bandwith_normal`, `setup_fee_justifikasi`, `abonemen_justifikasi`, `monthly_fee_justifikasi`, `bandwith_justifikasi`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`*/
	    $nama_cabang 	= isset($_POST["nama_cabang"]) ? mysql_real_escape_string(trim($_POST["nama_cabang"])) : "";
		$id_cabang 		= isset($_POST["cabang"]) ? mysql_real_escape_string(trim($_POST["cabang"])) : "";
		$id_permohonan_justifikasi 	= isset($_POST["id_permohonan_justifikasi"]) ? mysql_real_escape_string(trim($_POST["id_permohonan_justifikasi"])) : "";
	    $no_justifikasi 		= isset($_POST["no_justifikasi"]) ? mysql_real_escape_string(trim($_POST["no_justifikasi"])) : "";
	    $tanggal 			= isset($_POST["tanggal"]) ? mysql_real_escape_string(trim($_POST["tanggal"])) : "";
	    $kode_customer 		= isset($_POST["kode_customer"]) ? mysql_real_escape_string(trim($_POST["kode_customer"])) : "";
	    $nama_customer 		= isset($_POST["nama_customer"]) ? mysql_real_escape_string(trim($_POST["nama_customer"])) : "";
	    $longitude 			= isset($_POST["longitude"]) ? mysql_real_escape_string(trim($_POST["longitude"])) : "";
	    $latitude 			= isset($_POST["latitude"]) ? mysql_real_escape_string(trim($_POST["latitude"])) : "";
	    $tiang_terdekat	 	= isset($_POST["tiang_terdekat"]) ? mysql_real_escape_string(trim($_POST["tiang_terdekat"])) : "";
	    $paket 			= isset($_POST["paket"]) ? mysql_real_escape_string(trim($_POST["paket"])) : "";
	    $kode_paket 		= isset($_POST["paket_koneksi"]) ? mysql_real_escape_string(trim($_POST["paket_koneksi"])) : "";
	    $nama_paket 		= isset($_POST["nama_koneksi"]) ? mysql_real_escape_string(trim($_POST["nama_koneksi"])) : "";
	    $kontrak	 		= isset($_POST["kontrak"]) ? mysql_real_escape_string(trim($_POST["kontrak"])) : "";
	    $setup_fee_normal 		= isset($_POST["setup_fee_normal"]) ? str_replace(",", "", $_POST["setup_fee_normal"]) : "";
	    $abonemen_normal 		= isset($_POST["abonemen_normal"]) ? str_replace(",", "", $_POST["abonemen_normal"]) : "";
	    $monthly_fee_normal 	= isset($_POST["monthly"]) ? str_replace(",", "", $_POST["monthly"]) : "";
	    $bandwith_normal 		= isset($_POST["bandwith_normal"]) ? mysql_real_escape_string(trim($_POST["bandwith_normal"])) : "";
	    $setup_fee_justifikasi 	= isset($_POST["setup_fee_justifikasi"]) ? str_replace(",", "", $_POST["setup_fee_justifikasi"]) : "";
	    $abonemen_justifikasi 	= isset($_POST["abonemen_justifikasi"]) ? str_replace(",", "", $_POST["abonemen_justifikasi"]) : "";
	    $monthly_fee_justifikasi 	= isset($_POST["monthly_fee_justifikasi"]) ? str_replace(",", "", $_POST["monthly_fee_justifikasi"]) : "";
	    $bandwith_justifikasi 	= isset($_POST["bandwith_justifikasi"]) ? mysql_real_escape_string(trim($_POST["bandwith_justifikasi"])) : "";
	    $remarks 			= isset($_POST["remarks"]) ? mysql_real_escape_string(trim($_POST["remarks"])) : "";
	    
		    
		$insert_permohonan_justifikasi    	= "INSERT INTO `gx_permohonan_justifikasi`(`id_permohonan_justifikasi`,
        `no_justifikasi`, `tanggal`, `kode_customer`, `nama_customer`, `longitude`, `latitude`, `tiang_terdekat`,
        `paket`, `kode_paket`, `nama_paket`, `kontrak`, `setup_fee_normal`, `abonemen_normal`, `monthly_fee_normal`,
        `bandwith_normal`, `setup_fee_justifikasi`, `abonemen_justifikasi`, `monthly_fee_justifikasi`, `bandwith_justifikasi`,
        `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
		VALUES (NULL,'".$no_justifikasi."','".$tanggal."','".$kode_customer."',
        '".$nama_customer."','".$longitude."','".$latitude."','".$tiang_terdekat."', '".$paket."', '".$kode_paket."',
        '".$nama_paket."','".$kontrak."','".$setup_fee_normal."','".$abonemen_normal."','".$monthly_fee_normal."',
        '".$bandwith_normal."','".$setup_fee_justifikasi."','".$abonemen_justifikasi."','".$monthly_fee_justifikasi."',
        '".$bandwith_justifikasi."','".$remarks."',
        NOW(), NOW(),'".$loggedin["username"]."', '".$loggedin["username"]."', '0')";
		//echo $insert_permohonan_justifikasi;
        
        mysql_query($insert_permohonan_justifikasi, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan1!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert prospek = $insert_permohonan_justifikasi");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'list_permohonan_justifikasi.php';
		</script>";
		
	}elseif($update == "Save"){
	    $nama_cabang 	= isset($_POST["nama_cabang"]) ? mysql_real_escape_string(trim($_POST["nama_cabang"])) : "";
		$id_cabang 		= isset($_POST["cabang"]) ? mysql_real_escape_string(trim($_POST["cabang"])) : "";
		$id_permohonan_justifikasi 	= isset($_POST["id_permohonan_justifikasi"]) ? mysql_real_escape_string(trim($_POST["id_permohonan_justifikasi"])) : "";
	    $no_justifikasi 		= isset($_POST["no_justifikasi"]) ? mysql_real_escape_string(trim($_POST["no_justifikasi"])) : "";
	    $tanggal 			= isset($_POST["tanggal"]) ? mysql_real_escape_string(trim($_POST["tanggal"])) : "";
	    $kode_customer 		= isset($_POST["kode_customer"]) ? mysql_real_escape_string(trim($_POST["kode_customer"])) : "";
	    $nama_customer 		= isset($_POST["nama_customer"]) ? mysql_real_escape_string(trim($_POST["nama_customer"])) : "";
	    $longitude 			= isset($_POST["longitude"]) ? mysql_real_escape_string(trim($_POST["longitude"])) : "";
	    $latitude 			= isset($_POST["latitude"]) ? mysql_real_escape_string(trim($_POST["latitude"])) : "";
	    $tiang_terdekat	 	= isset($_POST["tiang_terdekat"]) ? mysql_real_escape_string(trim($_POST["tiang_terdekat"])) : "";
	    $paket 			= isset($_POST["paket"]) ? mysql_real_escape_string(trim($_POST["paket"])) : "";
	    $kode_paket 		= isset($_POST["paket_koneksi"]) ? mysql_real_escape_string(trim($_POST["paket_koneksi"])) : "";
	    $nama_paket 		= isset($_POST["nama_koneksi"]) ? mysql_real_escape_string(trim($_POST["nama_koneksi"])) : "";
	    $kontrak	 		= isset($_POST["kontrak"]) ? mysql_real_escape_string(trim($_POST["kontrak"])) : "";
	    $setup_fee_normal 		= isset($_POST["setup_fee_normal"]) ? str_replace(",", "", $_POST["setup_fee_normal"]) : "";
	    $abonemen_normal 		= isset($_POST["abonemen_normal"]) ? str_replace(",", "", $_POST["abonemen_normal"]) : "";
	    $monthly_fee_normal 	= isset($_POST["monthly"]) ? str_replace(",", "", $_POST["monthly"]) : "";
	    $bandwith_normal 		= isset($_POST["bandwith_normal"]) ? mysql_real_escape_string(trim($_POST["bandwith_normal"])) : "";
	    $setup_fee_justifikasi 	= isset($_POST["setup_fee_justifikasi"]) ? str_replace(",", "", $_POST["setup_fee_justifikasi"]) : "";
	    $abonemen_justifikasi 	= isset($_POST["abonemen_justifikasi"]) ? str_replace(",", "", $_POST["abonemen_justifikasi"]) : "";
	    $monthly_fee_justifikasi 	= isset($_POST["monthly_fee_justifikasi"]) ? str_replace(",", "", $_POST["monthly_fee_justifikasi"]) : "";
	    $bandwith_justifikasi 	= isset($_POST["bandwith_justifikasi"]) ? mysql_real_escape_string(trim($_POST["bandwith_justifikasi"])) : "";
	    $remarks 			= isset($_POST["remarks"]) ? mysql_real_escape_string(trim($_POST["remarks"])) : "";
	    
		    
		$insert_permohonan_justifikasi    	= "UPDATE `gx_permohonan_justifikasi` SET `no_justifikasi`='".$no_justifikasi."',`tanggal`='".$tanggal."',
		`kode_customer`='".$kode_customer."',`nama_customer`='".$nama_customer."',`longitude`='".$longitude."',`latitude`='".$latitude."',`tiang_terdekat`='".$tiang_terdekat."',`paket` = '".$paket."', `kode_paket`='".$kode_paket."',`nama_paket`='".$nama_paket."',
		`kontrak`='".$kontrak."',`setup_fee_normal`='".$setup_fee_normal."',`abonemen_normal`='".$abonemen_normal."',`monthly_fee_normal`='".$monthly_fee_normal."',`bandwith_normal`='".$bandwith_normal."',`setup_fee_justifikasi`='".$setup_fee_justifikasi."',
		`abonemen_justifikasi`='".$abonemen_justifikasi."',`monthly_fee_justifikasi`='".$monthly_fee_justifikasi."',`bandwith_justifikasi`='".$bandwith_justifikasi."',`remarks`='".$remarks."',`date_upd`=NOW(),
		`user_upd`='".$loggedin["username"]."',`level`='0' WHERE
		`gx_permohonan_justifikasi`.`id_permohonan_justifikasi` = '".$id_permohonan_justifikasi."';";
		
		
		//echo $insert_permohonan_justifikasi;
		mysql_query($insert_permohonan_justifikasi, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan2!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit prospek = $insert_permohonan_justifikasi");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'list_permohonan_justifikasi.php';
		</script>";
	}elseif($savetab2 == "Save"){
	    /* `id_permohonan_justifikasi`, `no_justifikasi`, `tanggal`, `kode_customer`, `nama_customer`, `longitude`, `latitude`, `tiang_terdekat`, `kode_paket`, `nama_paket`, `kontrak`, `setup_fee_normal`, `abonemen_normal`, `monthly_fee_normal`, `bandwith_normal`, `setup_fee_justifikasi`, `abonemen_justifikasi`, `monthly_fee_justifikasi`, `bandwith_justifikasi`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`*/
	    $nama_cabang 	= isset($_POST["nama_cabang"]) ? mysql_real_escape_string(trim($_POST["nama_cabang"])) : "";
		$id_cabang 		= isset($_POST["cabang"]) ? mysql_real_escape_string(trim($_POST["cabang"])) : "";
		$id_permohonan_justifikasi 	= isset($_POST["id_permohonan_justifikasi"]) ? mysql_real_escape_string(trim($_POST["id_permohonan_justifikasi"])) : "";
	    $no_justifikasi 		= isset($_POST["no_justifikasi"]) ? mysql_real_escape_string(trim($_POST["no_justifikasi"])) : "";
	    $tanggal 			= isset($_POST["tanggal"]) ? mysql_real_escape_string(trim($_POST["tanggal"])) : "";
	    $kode_survey 		= isset($_POST["kode_survey"]) ? mysql_real_escape_string(trim($_POST["kode_survey"])) : "";
	    $kode_jawab_survey 		= isset($_POST["kode_jawab_survey"]) ? mysql_real_escape_string(trim($_POST["kode_jawab_survey"])) : "";
	    $nama_customer 		= isset($_POST["nama_customer"]) ? mysql_real_escape_string(trim($_POST["nama_customer"])) : "";
	    $longitude 			= isset($_POST["longitude"]) ? mysql_real_escape_string(trim($_POST["longitude"])) : "";
	    $latitude 			= isset($_POST["latitude"]) ? mysql_real_escape_string(trim($_POST["latitude"])) : "";
	    $tiang_terdekat	 	= isset($_POST["tiang_terdekat"]) ? mysql_real_escape_string(trim($_POST["tiang_terdekat"])) : "";
	    $paket 			= isset($_POST["paket"]) ? mysql_real_escape_string(trim($_POST["paket"])) : "";
	    $kode_paket 		= isset($_POST["paket_koneksi"]) ? mysql_real_escape_string(trim($_POST["paket_koneksi"])) : "";
	    $nama_paket 		= isset($_POST["nama_koneksi"]) ? mysql_real_escape_string(trim($_POST["nama_koneksi"])) : "";
	    $kontrak	 		= isset($_POST["kontrak"]) ? mysql_real_escape_string(trim($_POST["kontrak"])) : "";
	    $setup_fee_normal 		= isset($_POST["setup_fee_normal"]) ? str_replace(",", "", $_POST["setup_fee_normal"]) : "";
	    $abonemen_normal 		= isset($_POST["abonemen_normal"]) ? str_replace(",", "", $_POST["abonemen_normal"]) : "";
	    $monthly_fee_normal 	= isset($_POST["monthly"]) ? str_replace(",", "", $_POST["monthly"]) : "";
	    $bandwith_normal 		= isset($_POST["bandwith_normal"]) ? mysql_real_escape_string(trim($_POST["bandwith_normal"])) : "";
	    $setup_fee_justifikasi 	= isset($_POST["setup_fee_justifikasi"]) ? str_replace(",", "", $_POST["setup_fee_justifikasi"]) : "";
	    $abonemen_justifikasi 	= isset($_POST["abonemen_justifikasi"]) ? str_replace(",", "", $_POST["abonemen_justifikasi"]) : "";
	    $monthly_fee_justifikasi 	= isset($_POST["monthly_fee_justifikasi"]) ? str_replace(",", "", $_POST["monthly_fee_justifikasi"]) : "";
	    $bandwith_justifikasi 	= isset($_POST["bandwith_justifikasi"]) ? mysql_real_escape_string(trim($_POST["bandwith_justifikasi"])) : "";
	    $remarks 			= isset($_POST["remarks"]) ? mysql_real_escape_string(trim($_POST["remarks"])) : "";
	    /*$ = isset($_POST[""]) ? $_POST[""] : "";*/
	    
		    
		$insert_permohonan_justifikasi    	= "INSERT INTO `gx_permohonan_justifikasi`(`id_permohonan_justifikasi`,
        `no_justifikasi`, `tanggal`, `kode_survey`, `kode_jawab_survey`, `nama_customer`, `longitude`, `latitude`,
        `tiang_terdekat`,`paket`, `kode_paket`, `nama_paket`, `kontrak`, `setup_fee_normal`, `abonemen_normal`,
        `monthly_fee_normal`, `bandwith_normal`, `setup_fee_justifikasi`, `abonemen_justifikasi`, `monthly_fee_justifikasi`,
        `bandwith_justifikasi`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
		VALUES (NULL,'".$no_justifikasi."','".$tanggal."','".$kode_survey."',
        '".$kode_jawab_survey."','".$nama_customer."','".$longitude."','".$latitude."','".$tiang_terdekat."',
        '".$paket."', '".$kode_paket."','".$nama_paket."','".$kontrak."','".$setup_fee_normal."',
        '".$abonemen_normal."','".$monthly_fee_normal."','".$bandwith_normal."','".$setup_fee_justifikasi."',
        '".$abonemen_justifikasi."','".$monthly_fee_justifikasi."','".$bandwith_justifikasi."','".$remarks."',
        NOW(), NOW(),'".$loggedin["username"]."', '".$loggedin["username"]."', '0')";
		//echo $insert_permohonan_justifikasi;
		mysql_query($insert_permohonan_justifikasi, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan3!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert prospek = $insert_permohonan_justifikasi");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'list_permohonan_justifikasi.php';
		</script>";
	}elseif($updatetab2 == "Save"){
	    $nama_cabang 	= isset($_POST["nama_cabang"]) ? mysql_real_escape_string(trim($_POST["nama_cabang"])) : "";
		$id_cabang 		= isset($_POST["cabang"]) ? mysql_real_escape_string(trim($_POST["cabang"])) : "";
		$id_permohonan_justifikasi 	= isset($_POST["id_permohonan_justifikasi"]) ? mysql_real_escape_string(trim($_POST["id_permohonan_justifikasi"])) : "";
	    $no_justifikasi 		= isset($_POST["no_justifikasi"]) ? mysql_real_escape_string(trim($_POST["no_justifikasi"])) : "";
	    $tanggal 			= isset($_POST["tanggal"]) ? mysql_real_escape_string(trim($_POST["tanggal"])) : "";
	    $kode_survey 		= isset($_POST["kode_survey"]) ? mysql_real_escape_string(trim($_POST["kode_survey"])) : "";
	    $kode_jawab_survey 		= isset($_POST["kode_jawab_survey"]) ? mysql_real_escape_string(trim($_POST["kode_jawab_survey"])) : "";
	    $nama_customer 		= isset($_POST["nama_customer"]) ? mysql_real_escape_string(trim($_POST["nama_customer"])) : "";
	    $longitude 			= isset($_POST["longitude"]) ? mysql_real_escape_string(trim($_POST["longitude"])) : "";
	    $latitude 			= isset($_POST["latitude"]) ? mysql_real_escape_string(trim($_POST["latitude"])) : "";
	    $tiang_terdekat	 	= isset($_POST["tiang_terdekat"]) ? mysql_real_escape_string(trim($_POST["tiang_terdekat"])) : "";
	    $paket 			= isset($_POST["paket"]) ? mysql_real_escape_string(trim($_POST["paket"])) : "";
	    $kode_paket 		= isset($_POST["paket_koneksi"]) ? mysql_real_escape_string(trim($_POST["paket_koneksi"])) : "";
	    $nama_paket 		= isset($_POST["nama_koneksi"]) ? mysql_real_escape_string(trim($_POST["nama_koneksi"])) : "";
	    $kontrak	 		= isset($_POST["kontrak"]) ? mysql_real_escape_string(trim($_POST["kontrak"])) : "";
	    $setup_fee_normal 		= isset($_POST["setup_fee_normal"]) ? str_replace(",", "", $_POST["setup_fee_normal"]) : "";
	    $abonemen_normal 		= isset($_POST["abonemen_normal"]) ? str_replace(",", "", $_POST["abonemen_normal"]) : "";
	    $monthly_fee_normal 	= isset($_POST["monthly"]) ? str_replace(",", "", $_POST["monthly"]) : "";
	    $bandwith_normal 		= isset($_POST["bandwith_normal"]) ? mysql_real_escape_string(trim($_POST["bandwith_normal"])) : "";
	    $setup_fee_justifikasi 	= isset($_POST["setup_fee_justifikasi"]) ? str_replace(",", "", $_POST["setup_fee_justifikasi"]) : "";
	    $abonemen_justifikasi 	= isset($_POST["abonemen_justifikasi"]) ? str_replace(",", "", $_POST["abonemen_justifikasi"]) : "";
	    $monthly_fee_justifikasi 	= isset($_POST["monthly_fee_justifikasi"]) ? str_replace(",", "", $_POST["monthly_fee_justifikasi"]) : "";
	    $bandwith_justifikasi 	= isset($_POST["bandwith_justifikasi"]) ? mysql_real_escape_string(trim($_POST["bandwith_justifikasi"])) : "";
	    $remarks 			= isset($_POST["remarks"]) ? mysql_real_escape_string(trim($_POST["remarks"])) : "";
	    
		    
		$insert_permohonan_justifikasi    	= "UPDATE `gx_permohonan_justifikasi` SET `no_justifikasi`='".$no_justifikasi."',`tanggal`='".$tanggal."',
		`kode_survey`='".$kode_survey."',`kode_jawab_survey`='".$kode_jawab_survey."',`nama_customer`='".$nama_customer."',`longitude`='".$longitude."',`latitude`='".$latitude."',`tiang_terdekat`='".$tiang_terdekat."',`paket` = '".$paket."', `kode_paket`='".$kode_paket."',`nama_paket`='".$nama_paket."',
		`kontrak`='".$kontrak."',`setup_fee_normal`='".$setup_fee_normal."',`abonemen_normal`='".$abonemen_normal."',`monthly_fee_normal`='".$monthly_fee_normal."',`bandwith_normal`='".$bandwith_normal."',`setup_fee_justifikasi`='".$setup_fee_justifikasi."',
		`abonemen_justifikasi`='".$abonemen_justifikasi."',`monthly_fee_justifikasi`='".$monthly_fee_justifikasi."',`bandwith_justifikasi`='".$bandwith_justifikasi."',`remarks`='".$remarks."',`date_upd`=NOW(),
		`user_upd`='".$loggedin["username"]."',`level`='0' WHERE
		`gx_permohonan_justifikasi`.`id_permohonan_justifikasi` = '".$id_permohonan_justifikasi."';";
		
		
		//echo $insert_permohonan_justifikasi;
		mysql_query($insert_permohonan_justifikasi, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan4!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit prospek = $insert_permohonan_justifikasi");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'list_permohonan_justifikasi.php';
		</script>";
	}
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

    $title	= 'Form Permohonan Justifikasi';
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