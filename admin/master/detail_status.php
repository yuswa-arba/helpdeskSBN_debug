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
	  $sql_data	= "SELECT `gx_status_collect`.*
			       FROM `gx_status_collect`
			       WHERE `gx_status_collect`.`level` =  '0'
			       AND `gx_status_collect`.`id_status` = '".$id_data."' LIMIT 0,1;";
	  $query_data	= mysql_query($sql_data, $conn);
	  $row_data	= mysql_fetch_array($query_data);
	  enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Status id =$id_data");
     }

     $content ='<section class="content-header">
		     <h1>
			 Detail Status Kolektibilitas
		     </h1>
		     
		 </section>
 
		 <!-- Main content -->
		 
		 <section class="content">
		     <div class="row">
			 <div class="col-xs-12">
			    
			    <div class="box">
				   <div class="box-header">
					<h2 class="box-title">Data Ruang</h2>
				   </div>
				 
				   <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Status</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text"  class="form-control" readonly="" name="nama_status" value="'.(isset($_GET["id"]) ? $row_data['nama_status'] :"").'">
						<input type="hidden" name="id_status" value="'.(isset($_GET["id"]) ? $row_data['id_status'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Range Hari</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" name="tgl1" value="'.(isset($_GET["id"]) ? $row_data['tgl1'] :"").'">
					    </div>
					    <div class="col-xs-3">
						<label>Sampai</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" name="tgl2" value="'.(isset($_GET["id"]) ? $row_data['tgl2'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" readonly="" name="keterangan" value="'.(isset($_GET["id"]) ? $row_data['keterangan'] :"").'">
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

    $title	= 'Detail Ruang';
    $submenu	= "master_ruang";
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