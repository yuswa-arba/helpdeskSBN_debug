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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Add On");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_add_on` WHERE `id_add_on`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}

    $content ='<section class="content-header">
                    <h1>
                        Detail Add On
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Detail Add On</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Cabang</label>
											</div>
											<div class="col-xs-3">';
											if(isset($_GET["id"])){
												$content.='<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["kode_cabang"] : "").'">
														   <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'">
														';
											}else{
												$content.='<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["kode_cabang"] : "").'">
														   <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'">
														';
											}
											$content .='</div>
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_data["tanggal"] : date("Y-m-d")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Add On</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="kode_add_on" name="kode_add_on" readonly="" value="'.(isset($_GET['id']) ? $row_data["kode_add_on"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Kode Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_customer" name="kode_customer" required="" value="'.(isset($_GET['id']) ? $row_data["kode_customer"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control"  name="nama_customer" value="'.(isset($_GET['id']) ? $row_data["nama_customer"] : "").'">
											</div>
											<div class="col-xs-3">
												
											</div>
											<div class="col-xs-3">
												
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Paket Lama</label>
											</div>
											<div class="col-xs-3">
												
											</div>
											<div class="col-xs-3">
												<label></label>
											</div>
											<div  class="col-xs-3" >
												
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kode Paket</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control"  name="kode_paket_lama" value="'.(isset($_GET['id']) ? $row_data["kode_paket_lama"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Nama Paket</label>
											</div>
											<div  class="col-xs-3" >
												<input type="text" readonly="" class="form-control"  name="nama_paket_lama" value="'.(isset($_GET['id']) ? $row_data["nama_paket_lama"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Add On</label>
											</div>
											<div class="col-xs-3">
												
											</div>
											<div class="col-xs-3">
												<label></label>
											</div>
											<div  class="col-xs-3" >
												
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kode Paket</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control"  name="kode_paket_add_on" value="'.(isset($_GET['id']) ? $row_data["kode_paket_add_on"] : "").'" onclick="return valideopenerform(\'data_paket.php?r=myForm&f=add_on\',\'paket\');">
											</div>
											<div class="col-xs-3">
												<label>Nama Paket</label>
											</div>
											<div  class="col-xs-3" >
												<input type="text" readonly="" class="form-control"  name="nama_paket_add_on" value="'.(isset($_GET['id']) ? $row_data["nama_paket_add_on"] : "").'">
											</div>
										</div>
										</div>
						
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Periode Kontrak Add On</label>
											</div>
											<div class="col-xs-4">
												<input class="form-control" readonly="" name="periode_kontrak_add_on" placeholder="" type="text" value="'.(isset($_GET['id']) ? $row_data['periode_kontrak_add_on'] :"") .'">
											</div>
											<div class="col-xs-1">
												<label>Bulan</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Tanggal Kontrak</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="tanggal_kontrak1" value="'.(isset($_GET['id']) ? $row_data["tanggal_kontrak1"] : "").'">
											</div>
											<div class="col-xs-1">
												<label>sd</label>
											</div>
											<div  class="col-xs-3" >
												<input type="text" readonly="" class="form-control"  name="tanggal_kontrak2" value="'.(isset($_GET['id']) ? $row_data["tanggal_kontrak2"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Created By</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_data["user_add"] : $loggedin["username"]).'
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Latest Update By </label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_data["user_upd"]." ".$row_data["date_upd"] : "").'
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

    $title	= 'Detail Add On';
    $submenu	= "add_on";
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