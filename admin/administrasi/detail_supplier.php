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
	  $id_data	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
	  $sql_data	= "SELECT * FROM `gx_supplier` WHERE `id_supplier` = '".$id_data."' LIMIT 0,1;";
	  $query_data	= mysql_query($sql_data, $conn);
	  $row_data 	= mysql_fetch_array($query_data);
	  enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Supplier id =$id_data");
     }

     $content ='
 
		 <!-- Main content -->
		 
		 <section class="content">
		     <div class="row">
			 <div class="col-xs-12">
			    
			    
			    <div class="box">
				   <div class="box-header">
					<h2 class="box-title">Data Supplier</h2>
				   </div>
				 
				   <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Supplier</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET["id"]) ? $row_data['kode_supplier'] :"").'
						
						
					    </div>
					    <div class="col-xs-3">
						<label>Pembelian Intern</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET["id"]) ? $row_data['beli_intern'] :"").'
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET["id"]) ? $row_data['nama_supplier'] :"").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET["id"]) ? $row_data['alamat'] :"").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Kota</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET["id"]) ? $row_data['kota'] :"").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Kode Pos</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET["id"]) ? $row_data['kode_pos'] :"").'
					    </div>
					    
					    <div class="col-xs-3">
						<label>Negara</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET["id"]) ? $row_data['negara'] :"").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>No Telepon</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET["id"]) ? $row_data['no_telpon'] :"").'
					    </div>
					    
					    <div class="col-xs-3">
						<label>No Fax</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET["id"]) ? $row_data['no_fax'] :"").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Contact Person</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET["id"]) ? $row_data['contact_person'] :"").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Email</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET["id"]) ? $row_data['email'] :"").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET["id"]) ? $row_data['keterangan'] :"").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>ACC Hutang</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET["id"]) ? $row_data['acc_hutang'] :"").'
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
				 </div>
			      </div>
			      </div>
			      
			     
			 </div>
		     </div>
 
		 </section><!-- /.content -->
	     ';

$plugins = '';

    $title	= 'Detail Supplier';
    $submenu	= "master_supplier";
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