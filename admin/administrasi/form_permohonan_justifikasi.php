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
if($loggedin["group"] == 'admin'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Mailbox");
    global $conn;
    global $conn_voip;
    
//echo date("Y-m-d H:i:s");   
if(isset($_GET['id_permohonan_justifikasi'])){
 $get_id = isset($_GET['id_permohonan_justifikasi']) ? mysql_real_escape_string(trim(strip_tags($_GET['id_permohonan_justifikasi']))) : "";
 $data_permohonan_justifikasi = mysql_fetch_array(mysql_query("SELECT * FROM `gx_permohonan_justifikasi` WHERE  `gx_permohonan_justifikasi`.`id_permohonan_justifikasi` = '$get_id';", $conn));
}

$query_cabang	= mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$loggedin['cabang']."' AND `level` = '0' ORDER BY `id_cabang` ASC LIMIT 1;", $conn);
$row_cabang 	= mysql_fetch_array($query_cabang);

$sql_permohonanjustifikasi  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_permohonan_justifikasi` ORDER BY `id_permohonan_justifikasi` DESC", $conn));
$last_data  = $sql_permohonanjustifikasi["id_permohonan_justifikasi"] + 1;
$tanggal    = date("d");
$kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_justifikasi"].''.$tanggal.''.sprintf("%04d", $last_data);

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			<ul class="nav nav-tabs" role="tablist" id="myTab">
			    <li role="presentation" class="active"><a href="#tab1" aria-controls="customer" role="tab" data-toggle="tab">Pelanggan Lama</a></li>
			    <li role="presentation"><a href="#tab2" aria-controls="troubleticket" role="tab" data-toggle="tab">Pelanggan Baru</a></li>
			</ul>
			    <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tab1">
                            <div class="box">
				
				
                                <div class="box-body table-responsive">
				
				
        <form action="" role="form" name="myForm"  method="POST" >
	  
	<div >
	    <fieldset>
		<legend>Data Permohonan Justifikasi</legend>
		<div class="table-container table-form">
		    <!--<a href="'.URL_ADMIN.'helpdesk/data_cust.php?r=form_permohonan_justifikasi" class="btn btn-sm bg-navy btn-flat margin pull-right"
						onclick="return valideopenerform(\''.URL_ADMIN.'helpdesk/data_cust.php?r=form_permohonan_justifikasi\',\'prospek\');">Search Customer</a>-->
		 
		    
		    <div class="box-body">
					<div class="col-xs-12">
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-10">
						<input type="hidden" class="form-control" required="" id="id_cabang" name="id_cabang" value="'.(isset($_GET['id']) ? $row_customer["id_cabang"] : $loggedin["cabang"]).'" >
<input type="text" readonly class="form-control" id="nama_cabang" name="nama_cabang" value="'.get_nama_cabang($loggedin['cabang']).'">
</div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>No. Justifikasi*</label>
			</div>
					    <div class="col-xs-4">
						
			
			  <input type="text" class="form-control required" required="" readonly="" style="" id="no_justifikasi" name="no_justifikasi" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi["no_justifikasi"] : $kode_cabang) .'" />
			 </div>
					    <div class="col-xs-2">
						
			  <label>Tanggal</label>
			</div>
					    <div class="col-xs-4">
					
			  <input name="id_permohonan_justifikasi" type="hidden" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $_GET["id_permohonan_justifikasi"] :"") .'" readonly="">
			  <input class="form-control hasDatepicker" required="" readonly="" name="tanggal" id="datepicker" placeholder="Tanggal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['tanggal'] : date("Y-m-d") ) .'" >
			  </div>
                                        </div>
					</div>
			
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kode Customer</label>
			</div>
					    <div class="col-xs-4">
			  <input class="form-control" required="" name="kode_customer" readonly="" id="kode_customer" placeholder="Kode Customer" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['kode_customer'] :"") .'" >
			
			<!--<a onclick="kode_customer()" title="Search Customer" style="padding-left: 66%; color : #4571b5; cursor : pointer;">Search Customer</a>-->
			<a href="data_cust.php?r=myForm"  onclick="return valideopenerform(\'data_cust.php?r=myForm\',\'cust\');">Search Customer</a>
			</div>
					    <div class="col-xs-2">
					
			
			  <label>Nama Customer</label>
			 </div>
					    <div class="col-xs-4">
					
			  <input class="form-control required" required="" readonly="" name="nama_customer" placeholder="Nama Customer" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['nama_customer'] : "") .'">

		<input type="hidden" name="nama_perusahaan">
		<input type="hidden" name="alamat">
		<input type="hidden" name="kota">
		<input type="hidden" name="notelp">
		<input type="hidden" name="hp1">
		<input type="hidden" name="hp2">
		<input type="hidden" name="contact">
		<input type="hidden" name="email">
			
				</div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			
			  <label>Longitude</label>
	</div>
					    <div class="col-xs-4">
						<input type="text" name="longitude"  readonly="" class="form-control required" required="" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['longitude'] :"") .'" placeholder="Longitude">
	 </div>
	 <div class="col-xs-2">
			  <label>Latitude</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control required" required="" readonly="" name="latitude" placeholder="Latitude" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['latitude'] :"") .'" >
	</div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Tiang Terdekat</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control required" required="" readonly="" name="tiang_terdekat" placeholder="Tiang Terdekat" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['tiang_terdekat'] :"") .'" >
	 </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>Paket</label>
					    </div>
					    <div class="col-xs-3">
						<input class="form-control" type="radio" name="paket" value="yes" style="float:left;" '.((isset($_GET["id_permohonan_justifikasi"]) && $data_permohonan_justifikasi["paket"]== "yes" ) ? "checked" :"") .'>Yes 
						<input class="form-control" type="radio" name="paket" value="no" style="float:left;" '.((isset($_GET["id_permohonan_justifikasi"]) && $data_permohonan_justifikasi["paket"]== "no" ) ? "checked" :"") .'>No
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kode Paket</label>
			</div>
			<div class="col-xs-4">
			  <input class="form-control required" required="" name="paket_koneksi" readonly="" placeholder="Kode Paket" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['kode_paket'] :"") .'">
			<a href="data_paket_2.php?r=myForm"  onclick="return valideopenerform(\'data_paket_2.php?r=myForm\',\'paket\');">Search Paket</a>
			  
			
		</div>
					    <div class="col-xs-2">
	
			      <label>Nama Paket</label>
	</div>
	<div class="col-xs-4">
			    <input class="form-control required" readonly="" required="" name="nama_koneksi" placeholder="Nama Paket" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['nama_paket'] :"") .'">
		        
				</div></div></div>
	
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kontrak</label>
	</div>
	<div class="col-xs-4">
			    <input class="form-control required" required="" name="kontrak" placeholder="Kontrak" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['kontrak'] :"") .'">
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
			<input class="form-control required" required="" id="harga" name="setup_fee_normal" readonly="" placeholder="Setup Fee Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['setup_fee_normal'] :"") .'">
		        </div>
			<div class="col-xs-2">
			  <label>Setup Fee</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control required" required="" id="harga" name="setup_fee_justifikasi" placeholder="Setup Fee Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['setup_fee_justifikasi'] :"0") .'">
		        </div>
			   </div></div>
			   
			   
		
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					     <label>Abonemen</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" id="harga" readonly="" name="abonemen_normal" placeholder="Abonemen Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['abonemen_normal'] :"").'">
		           </div>
			      <div class="col-xs-2">
					     <label>Abonemen</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" id="harga" name="abonemen_justifikasi" placeholder="Abonemen Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['abonemen_justifikasi'] :"0").'">
		           </div>
			   </div></div>
					    
			
				<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					     <label>Monthly Fee</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" readonly="" id="harga" name="monthly" placeholder="Monthly Fee Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['monthly_fee_normal'] :"").'">
		           </div>
			      <div class="col-xs-2">
					     <label>Monthly Fee</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" id="harga"  name="monthly_fee_justifikasi" placeholder="Monthly Fee Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['monthly_fee_justifikasi'] :"0").'">
		           </div>
			   </div></div>
					   
			
			    
			  <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					     <label>Bandwith</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" readonly=""  name="bandwith_normal" placeholder="Bandwith Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['bandwith_normal'] :"").'">
		           </div>
			      <div class="col-xs-2">
					     <label>Bandwith</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required=""  name="bandwith_justifikasi" placeholder="Bandwith Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['bandwith_justifikasi'] :"0").'">
		           </div>
			   </div></div>
			
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Remarks</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="remarks" class="form-control required" required="" placeholder="Remarks" style="resize: none;"> '.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['remarks'] :"").' </textarea>
			</div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_permohonan_justifikasi']) ? $data_permohonan_justifikasi["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_permohonan_justifikasi']) ? $data_permohonan_justifikasi["user_upd"]." ".$data_permohonan_justifikasi["date_upd"] : "").'
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
	       <input type="submit" class="button button-primary" data-icon="v" name="'.(isset($_GET["id_permohonan_justifikasi"]) ? "update" : "save") .'" value="Save">
	    
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
			    
			    <div role="tabpanel" class="tab-pane" id="tab2">
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
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-10">
						<input type="hidden" class="form-control" required="" id="id_cabang" name="id_cabang" value="'.(isset($_GET['id']) ? $row_customer["id_cabang"] : $loggedin["cabang"]).'" >
<input type="text" readonly class="form-control" id="nama_cabang" name="nama_cabang" value="'.get_nama_cabang($loggedin['cabang']).'">

					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>No. Justifikasi*</label>
			</div>
					    <div class="col-xs-4">
						
			
			  <input type="text" class="form-control required" required="" readonly="" style="" id="no_justifikasi" name="no_justifikasi" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi["no_justifikasi"] : $kode_cabang) .'" />
			 </div>
					    <div class="col-xs-2">
						
			  <label>Tanggal</label>
			</div>
					    <div class="col-xs-4">
					
			  <input name="id_permohonan_justifikasi" type="hidden" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $_GET["id_permohonan_justifikasi"] :"") .'" readonly="">
			  <input class="form-control hasDatepicker" required="" readonly="" name="tanggal" id="datepicker" placeholder="Tanggal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['tanggal'] : date("Y-m-d") ) .'" >
			  </div>
                                        </div>
					</div>
			
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kode Survey</label>
			</div>
					    <div class="col-xs-4">
			  <input class="form-control" required="" name="kode_survey" readonly="" id="kode_survey" placeholder="Kode Survey" onclick="return valideopenerform(\'data_jawab_survey.php?r=myFormtab2\',\'survey\');" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['kode_survey'] :"") .'" >
			  <input class="form-control" required="" name="kode_jawab_survey" readonly="" id="kode_jawab_survey" placeholder="Kode Jawab Survey" type="hidden" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['kode_jawab_survey'] :"") .'" >
			
			</div>
					    <div class="col-xs-2">
					
			
			  <label>Nama Customer</label>
			 </div>
					    <div class="col-xs-4">
					
			  <input class="form-control required" required="" readonly="" name="nama_customer" placeholder="Nama Customer" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['nama_customer'] : "") .'">

				</div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			
			  <label>Longitude</label>
	</div>
					    <div class="col-xs-4">
						<input type="text" name="longitude"  readonly="" class="form-control required" required="" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['longitude'] :"") .'" placeholder="Longitude">
	 </div>
	 <div class="col-xs-2">
			  <label>Latitude</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control required" readonly=""  name="latitude" placeholder="Latitude" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['latitude'] :"") .'" >
	</div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Tiang Terdekat</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control required" readonly=""  name="tiang_terdekat" placeholder="Tiang Terdekat" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['tiang_terdekat'] :"") .'" >
	 </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>Paket</label>
					    </div>
					    <div class="col-xs-3">
						<input class="form-control" type="radio" name="paket" value="yes" style="float:left;" '.((isset($_GET["id_permohonan_justifikasi"]) && $data_permohonan_justifikasi["paket"]== "yes" ) ? "checked" :"") .'>Yes 
						<input class="form-control" type="radio" name="paket" value="no" style="float:left;" '.((isset($_GET["id_permohonan_justifikasi"]) && $data_permohonan_justifikasi["paket"]== "no" ) ? "checked" :"") .'>No
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kode Paket</label>
			</div>
			<div class="col-xs-4">
			  <input class="form-control required" required=""  onclick="return valideopenerform(\'data_paket_2.php?r=myFormtab2\',\'paket\');" name="paket_koneksi" readonly="" placeholder="Kode Paket" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['kode_paket'] :"") .'">
			
			  
			
		</div>
					    <div class="col-xs-2">
	
			      <label>Nama Paket</label>
	</div>
	<div class="col-xs-4">
			    <input class="form-control required" readonly="" required="" name="nama_koneksi" placeholder="Nama Paket" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['nama_paket'] :"") .'">
		        
				</div></div></div>
	
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kontrak</label>
	</div>
	<div class="col-xs-4">
			    <input class="form-control required" required="" name="kontrak" placeholder="Kontrak" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['kontrak'] :"") .'">
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
			<input class="form-control required" required="" id="harga" name="setup_fee_normal" readonly="" placeholder="Setup Fee Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['setup_fee_normal'] :"") .'">
		        </div>
			<div class="col-xs-2">
			  <label>Setup Fee</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control required" required="" id="harga" name="setup_fee_justifikasi" placeholder="Setup Fee Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['setup_fee_justifikasi'] :"0") .'">
		        </div>
			   </div></div>
			   
			   
		
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					     <label>Abonemen</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" id="harga" readonly="" name="abonemen_normal" placeholder="Abonemen Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['abonemen_normal'] :"").'">
		           </div>
			      <div class="col-xs-2">
					     <label>Abonemen</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" id="harga" name="abonemen_justifikasi" placeholder="Abonemen Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['abonemen_justifikasi'] :"0").'">
		           </div>
			   </div></div>
					    
			
				<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					     <label>Monthly Fee</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" readonly="" id="harga" name="monthly" placeholder="Monthly Fee Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['monthly_fee_normal'] :"").'">
		           </div>
			      <div class="col-xs-2">
					     <label>Monthly Fee</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" id="harga"  name="monthly_fee_justifikasi" placeholder="Monthly Fee Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['monthly_fee_justifikasi'] :"0").'">
		           </div>
			   </div></div>
					   
			
			    
			  <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
					     <label>Bandwith</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required="" readonly=""  name="bandwith_normal" placeholder="Bandwith Normal" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['bandwith_normal'] :"").'">
		           </div>
			      <div class="col-xs-2">
					     <label>Bandwith</label>
			 	           </div>
			<div class="col-xs-4">
					    <input class="form-control required" required=""  name="bandwith_justifikasi" placeholder="Bandwith Justifikasi" type="text" value="'.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['bandwith_justifikasi'] :"0").'">
		           </div>
			   </div></div>
			
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Remarks</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="remarks" class="form-control required" required="" placeholder="Remarks" style="resize: none;"> '.(isset($_GET["id_permohonan_justifikasi"]) ? $data_permohonan_justifikasi['remarks'] :"").' </textarea>
			</div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_permohonan_justifikasi']) ? $data_permohonan_justifikasi["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_permohonan_justifikasi']) ? $data_permohonan_justifikasi["user_upd"]." ".$data_permohonan_justifikasi["date_upd"] : "").'
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
	       <input type="submit" class="button button-primary" data-icon="v" name="'.(isset($_GET["id_permohonan_justifikasi"]) ? "updatetab2" : "savetab2") .'" value="Save">
	    
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
	    /*$ = isset($_POST[""]) ? $_POST[""] : "";*/
	    
		    
		$insert_permohonan_justifikasi    	= "INSERT INTO `gx_permohonan_justifikasi`(`id_permohonan_justifikasi`, `no_justifikasi`, `tanggal`, `kode_customer`, `nama_customer`, `longitude`, `latitude`, `tiang_terdekat`,`paket`, `kode_paket`, `nama_paket`, `kontrak`, `setup_fee_normal`, `abonemen_normal`, `monthly_fee_normal`, `bandwith_normal`, `setup_fee_justifikasi`, `abonemen_justifikasi`, `monthly_fee_justifikasi`, `bandwith_justifikasi`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
							   VALUES (NULL,'".$no_justifikasi."','".$tanggal."','".$kode_customer."','".$nama_customer."','".$longitude."','".$latitude."','".$tiang_terdekat."', '".$paket."', '".$kode_paket."','".$nama_paket."','".$kontrak."','".$setup_fee_normal."','".$abonemen_normal."','".$monthly_fee_normal."','".$bandwith_normal."','".$setup_fee_justifikasi."','".$abonemen_justifikasi."','".$monthly_fee_justifikasi."','".$bandwith_justifikasi."','".$remarks."', NOW(), NOW(),'".$loggedin["username"]."', '".$loggedin["username"]."', '0')";
		//echo $insert_permohonan_justifikasi;
		mysql_query($insert_permohonan_justifikasi, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert prospek = $insert_permohonan_justifikasi");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'master_permohonan_justifikasi.php';
		</script>";
	}elseif($update == "Save"){
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
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit prospek = $insert_permohonan_justifikasi");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'master_permohonan_justifikasi.php';
		</script>";
	}elseif($savetab2 == "Save"){
	    /* `id_permohonan_justifikasi`, `no_justifikasi`, `tanggal`, `kode_customer`, `nama_customer`, `longitude`, `latitude`, `tiang_terdekat`, `kode_paket`, `nama_paket`, `kontrak`, `setup_fee_normal`, `abonemen_normal`, `monthly_fee_normal`, `bandwith_normal`, `setup_fee_justifikasi`, `abonemen_justifikasi`, `monthly_fee_justifikasi`, `bandwith_justifikasi`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`*/
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
	    
		    
		$insert_permohonan_justifikasi    	= "INSERT INTO `gx_permohonan_justifikasi`(`id_permohonan_justifikasi`, `no_justifikasi`, `tanggal`, `kode_survey`, `kode_jawab_survey`, `nama_customer`, `longitude`, `latitude`, `tiang_terdekat`,`paket`, `kode_paket`, `nama_paket`, `kontrak`, `setup_fee_normal`, `abonemen_normal`, `monthly_fee_normal`, `bandwith_normal`, `setup_fee_justifikasi`, `abonemen_justifikasi`, `monthly_fee_justifikasi`, `bandwith_justifikasi`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
							   VALUES (NULL,'".$no_justifikasi."','".$tanggal."','".$kode_survey."','".$kode_jawab_survey."','".$nama_customer."','".$longitude."','".$latitude."','".$tiang_terdekat."', '".$paket."', '".$kode_paket."','".$nama_paket."','".$kontrak."','".$setup_fee_normal."','".$abonemen_normal."','".$monthly_fee_normal."','".$bandwith_normal."','".$setup_fee_justifikasi."','".$abonemen_justifikasi."','".$monthly_fee_justifikasi."','".$bandwith_justifikasi."','".$remarks."', NOW(), NOW(),'".$loggedin["username"]."', '".$loggedin["username"]."', '0')";
		//echo $insert_permohonan_justifikasi;
		mysql_query($insert_permohonan_justifikasi, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert prospek = $insert_permohonan_justifikasi");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'master_permohonan_justifikasi.php';
		</script>";
	}elseif($updatetab2 == "Save"){
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
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit prospek = $insert_permohonan_justifikasi");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'master_permohonan_justifikasi.php';
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
    $submenu	= "master_form_permohonan_justifikasi";
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