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
     
     global $conn;

     if(isset($_GET['id'])){
	  $id_data 	= isset($_GET['id']) ? (int)$_GET['id'] : "";
	  //$sql_data	= "SELECT * FROM `gx_lemari`, `gx_barang` WHERE `id_barang` = '".$id_data."' AND `gx_lemari`.`level`='0' AND `gx_barang`.`level`='0';";
	  $sql_data	= "SELECT * FROM `gx_lemari`, `gx_cetak_barcode`, `gx_barang` WHERE `gx_cetak_barcode`.`id_cetak` = '".$id_data."' AND `gx_cetak_barcode`.`kode_barang`=`gx_barang`.`kode_barang` AND `gx_cetak_barcode`.`level`='0' AND `gx_barang`.`level`='0' AND `gx_lemari`.`level`='0';";
	  $query_data	= mysql_query($sql_data, $conn);
	  $row_data	= mysql_fetch_array($query_data);
	  
	  $sql_data_cabang	= "SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$row_data["id_cabang"]."' AND `level`='0';";
	  $query_data_cabang	= mysql_query($sql_data_cabang, $conn);
	  $row_data_cabang	= mysql_fetch_array($query_data_cabang);
	  enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update form barang id=$id_data");
      }
include("qrcode/qrlib.php");
  // how to build raw content - QRCode with simple Business Card (VCard)
					     define("TMP_SERVERPATH", "qrcode/images/");
					     $tempDir = TMP_SERVERPATH;
						 
					     // text output  
					     $codeContents = '';
						 $codeContents .= 'Name Barang : '.(isset($_GET["id"]) ? $row_data['nama_barang'] :"").' '."\n";
						 $codeContents .= 'Kode Barang : '.(isset($_GET["id"]) ? $row_data['kode_barang'] :"").' '."\n";
						 $codeContents .= 'SN : '.(isset($_GET["id"]) ? $row_data['barcode'] :"").' '."\n";
						 $codeContents .= 'Ruang : '.(isset($_GET["id"]) ? $row_data['nama_ruang'] :"").' '."\n";
						 $codeContents .= 'Lemari : '.(isset($_GET["id"]) ? $row_data['nama_lemari'] :"").' '."\n";
					     
					     // generating
					    // $text = QRcode::png($codeContents);
					    $name_file = $tempDir.(isset($_GET["id"]) ? $row_data['kode_barang'] : "");
					     QRcode::png($codeContents, $name_file, QR_ECLEVEL_L, 3);
					     // displaying
					     
					     
     $content ='
 
		 <!-- Main content -->
		 
		 <section class="content">
		     <div class="row">
			 <div class="col-xs-12">
			    
			    
			    <div class="box">
				   <div class="box-header">
					<h2 class="box-title"></h2>
				   </div>
				   <div class="box-body">';
				   
				   $content .= '
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET["id"]) ? $row_data['tanggal'] :"").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET["id"]) ? $row_data_cabang['nama_cabang'] :"").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Kode Barang</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET["id"]) ? $row_data['kode_barang'] :"").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Nama Barang</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET["id"]) ? $row_data['nama_barang'] :"").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Barcode Barang</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET["id"]) ? $row_data['barcode'] :"").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>No Sebelumnya</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET["id"]) ? $row_data['no_sebelumnya'] :"").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Qty</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET["id"]) ? $row_data['qty'] :"").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>No Terakhir</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET["id"]) ? $row_data['no_terakhir'] :"").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>QR Code</label>
					    </div>
					    <div class="col-xs-6">
						<img src="'.$name_file.'"/>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET["id"]) ? $row_data['tanggal'] :"").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Last Update By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET["id"]) ? $row_data['tanggal'] :"").'
					    </div>
                                        </div>
					</div>
					
				   ';
				   
				   
				  
					/*
				   $content .= '
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" id="nama_cabang" value="'.(isset($_GET["id"]) ? $row_data_cabang['nama_cabang'] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Barang</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text"  class="form-control" readonly="" id="kode_barang" name="kode_barang" value="'.(isset($_GET["id"]) ? $row_data['kode_barang'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" readonly="" name="nama_barang" value="'.(isset($_GET["id"]) ? $row_data['nama_barang'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Satuan</label>
					    </div>
					    <div class="col-xs-3">
						1 &nbsp;&nbsp;<input type="text" readonly="" id="satuan1" name="satuan1" value="'.(isset($_GET["id"]) ? $row_data['satuan1'] :"").'">
						
					    </div>
					    <div class="col-xs-3">
						= &nbsp;&nbsp;<input type="text" id="isi" readonly="" name="isi" value="'.(isset($_GET["id"]) ? $row_data['isi'] :"").'">
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" id="satuan2" readonly="" name="satuan2" value="'.(isset($_GET["id"]) ? $row_data['satuan2'] :"").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Barcode</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="barcode" readonly="" value="'.(isset($_GET["id"]) ? $row_data['barcode'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Reorder Stok</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="reorder_stok" readonly="" value="'.(isset($_GET["id"]) ? $row_data['reorder_stok'] :"").'">
					    </div>
					    
					    <div class="col-xs-3">
						<label>Minimum Stok</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="minimum_stok" readonly="" value="'.(isset($_GET["id"]) ? $row_data['minimum_stok'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Kategori</label>
					    </div>
					    <div class="col-xs-9">
						
						<input type="text" class="form-control" readonly="" name="kategori" value="'.((isset($_GET["id"])) ? ucfirst($row_data["kategori"]) : "") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>ACC Biaya</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" name="acc_biaya" value="'.(isset($_GET["id"]) ? $row_data['acc_biaya'] :"").'">
					    </div>
					    
					    <div class="col-xs-3">
						<label>ACC Inventaris</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" name="acc_inventaris" value="'.(isset($_GET["id"]) ? $row_data['acc_inventaris'] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>ACC Free</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" name="acc_free" value="'.(isset($_GET["id"]) ? $row_data['acc_free'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Gambar</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET['id']) ? '<a href="'.URL_ADMIN.'upload/barang/'.$row_data["gambar"].'" class="lightbox"><img src="'.URL_ADMIN.'upload/barang/'.$row_data["gambar"].'" style="border:none; width:120px;"></a>' : "").'
					    </div>
                                        </div>
					</div>';
					
					  
					     
					     
					$content .= '
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>QR Code</label>
					    </div>
					    <div class="col-xs-9">
						  <img src="'.$name_file.'"/>
					    </div>
					</div>
					</div>
					
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Created By:</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET["id"]) ? $row_data['user_add'] : $loggedin["username"]).'
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>last Updated By:</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET["id"]) ? $row_data['user_upd'].' ( '.$row_data['date_upd'].' )' : "").'
					    </div>
                                        </div>
					</div>';
					*/
					
					
			      	$content .= '				
                                    </div>
			      </div>
			      </div>
			      
			     
			 </div>
		     </div>
 
		 </section><!-- /.content -->
	     ';

$plugins = '<!-- Colorbox -->
<link media="screen" rel="stylesheet" type="text/css" href="'.URL.'js/colorbox/example1/colorbox.css" />
  <script src="'.URL.'js/colorbox/jquery.colorbox.js"></script>
  <script type="text/javascript">
   $(document).ready(function(){
    //Examples of how to assign the ColorBox event to elements
    $(".lightbox").colorbox({width:"75%", height:"75%"});
    
   });

  </script>';

    $title	= 'Detail barang';
    $submenu	= "master_barang";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>