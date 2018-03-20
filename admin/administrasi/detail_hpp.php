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
    $sql_data	= "SELECT * FROM `gx_hpp` WHERE `id_hpp` = '".$id_data."';";
    $query_data	= mysql_query($sql_data, $conn);
    $row_data	= mysql_fetch_array($query_data);
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update form hpp id=$id_data");
}else{
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "create new form hpp");
}

     $content ='
 
		 <!-- Main content -->
		 
		 <section class="content">
		     <div class="row">
			 <div class="col-xs-12">
			    
			    
			    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Barang</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" readonly="" name="kode_barang" value="'.(isset($_GET["id"]) ? $row_data['kode_barang'] :"").'"
						onclick="return valideopenerform(\'data_barang.php?r=form_hpp&f=hpp\',\'barang\');">
						<input type="hidden"  class="form-control" readonly ="" name="id_hpp" value="'.(isset($_GET["id"]) ? $row_data['id_hpp'] :"").'">
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Barang</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" readonly ="" name="nama_barang" value="'.(isset($_GET["id"]) ? $row_data['nama_barang'] :"").'">
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Harga Pokok Pembelian (Rp)<label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" readonly="" name="hpp_rp" value="'.(isset($_GET["id"]) ? $row_data['hpp_rp'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Kurs</label>
					    </div>
					    <div class="col-xs-4">
					    <select name="kurs" class="form-control" disabled="">';
						$query_matauang	= mysql_query("SELECT * FROM `gx_matauang` WHERE `level` = '0' ORDER BY `id_matauang` DESC ;", $conn);
						while ($row_matauang = mysql_fetch_array($query_matauang)) {
						    $content .='<option value="'.$row_matauang["kode_matauang"].'">'.$row_matauang["nama_matauang"].'</option>';
						}
					    $content .='</select>
						
						
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Harga Beli (Rp)<label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" readonly="" name="harga_beli" value="'.(isset($_GET["id"]) ? $row_data['harga_beli'] :"").'">
						
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Shipping Cost<label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" readonly="" name="shipping_cost" value="'.(isset($_GET["id"]) ? $row_data['shipping_cost'] :"").'">
						
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Harga Pokok Pembelian<label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" readonly="" name="hpp" value="'.(isset($_GET["id"]) ? $row_data['hpp'] :"").'">
						
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
					</div>
					
                                    </div><!-- /.box-body -->
			      
			     
			 </div>
		     </div>
 
		 </section><!-- /.content -->
	     ';

$plugins = '';

    $title	= 'Detail Harga Pokok';
    $submenu	= "hpp";
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