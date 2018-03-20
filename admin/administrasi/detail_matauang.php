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
	  $sql_data	= "SELECT * FROM `gx_matauang` WHERE `id_matauang` = '".$id_data."' LIMIT 0,1;";
	  $query_data	= mysql_query($sql_data, $conn);
	  $row_data 	= mysql_fetch_array($query_data);
	  enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Matauang id =$id_data");
     }

     $content ='
 
		 <!-- Main content -->
		 
		 <section class="content">
		     <div class="row">
			 <div class="col-xs-12">
			    
			    <div class="box">
				   <div class="box-header">
					<h2 class="box-title">Data Mata Uang</h2>
				   </div>
				 
				   <div class="box-body">
				   <table style="margin-bottom: 0;width:60%">
				     <tbody>
				     <tr>
					 <td>Kode Mata Uang</td>
					 <td>'.(isset($_GET["id"]) ? $row_data['kode_matauang'] :"").'</td>
				     </tr>
				     <tr>
					 <td>Nama Mata Uang</td>
					 <td>'.(isset($_GET["id"]) ? $row_data['nama_matauang'] :"").'</td>
				     </tr>
				   <tr><td colspan="2" width="100%" align="center" >
				   </td></tr>
				     </tbody>
				 </table>
				 </div>
			      </div>
			      </div>
			      
			     
			 </div>
		     </div>
 
		 </section><!-- /.content -->
	     ';

$plugins = '';

    $title	= 'Detail Mata Uang';
    $submenu	= "master_matauang";
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