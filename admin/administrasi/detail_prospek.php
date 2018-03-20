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
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Prospek");
     global $conn;

     if(isset($_GET['id_prospek'])){
	  $id_prospek	= isset($_GET['id_prospek']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_prospek']))) : "";
	  $sql_detail	= mysql_query("SELECT * FROM `gx_prospek` WHERE `id_prospek` = '$id_prospek' LIMIT 0,1;", $conn);
	  $row_detail 	= mysql_fetch_array($sql_detail);
	  
	  
	  $sql_user	= mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".$row_detail["kode_cust"]."' AND `cNonAktiv` = '0' AND `level` = '0' LIMIT 0,1;", $conn);
	  $row_user 	= mysql_fetch_array($sql_user);
	  $user_id	= $row_user["cUserID"];
          $user_index = $row_user["iuserIndex"];
     
     }elseif(isset($_GET['id'])){
	  $id_Prospek	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
	  $sql_detail	= mysql_query("SELECT * FROM `gx_helpdesk_Prospek` WHERE `id_Prospek` = '".$id_Prospek."' LIMIT 0,1;", $conn);
	  $row_detail 	= mysql_fetch_array($sql_detail);
	  
	  $sql_user	= mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".$row_detail["cust_number"]."' AND `cNonAktiv` = '0' AND `level` = '0' LIMIT 0,1;", $conn);
	  $row_user 	= mysql_fetch_array($sql_user);
	  $user_id	= $row_user["cUserID"];
	  $user_email	= $row_detail["email"];
          $user_index = $row_user["iuserIndex"];
	  
     }
     
     //echo $user_id;
     //Data RBS
     /*$conn_soft2 = Config::getInstanceSoft();
     $sql_user_soft = $conn_soft2->prepare("SELECT [Users].*
					FROM [DRBSISP].[dbo].[Users]
					WHERE [Users].[UserIndex] = '".$user_index."';");

     $sql_user_soft->execute();
     $row_user_soft = $sql_user_soft->fetch();
     */
     $content =' 
		 <!-- Main content -->
		 
		 <section class="content">
		     <div class="row">
			 <div class="col-xs-12">
			    
			    
			    <div class="box">
				   <div class="box-header">
					<h2 class="box-title">Data Customer</h2>
				   </div>
				 
				   <div class="box-body">
				   <table style="margin-bottom: 0;width:60%">
				     <tbody>
				     <tr>
					 <td>No. Prospek</td>
					 <td>'.$row_detail["no_prospek"].'</td>
				     </tr>
				     <tr>
					 <td>Tanggal</td>
					 <td>'.$row_detail["tanggal"].'</td>
				     </tr>
				     <tr>
					 <td>Cabang</td>
					 <td>'.$row_detail["cabang"].'</td>
				     </tr>
				     <tr>
					 <td>Kode Customer</td>
					 <td>'.$row_detail["kode_cust"].'</td>
				     </tr>
				     <tr>
					 <td>Nama Customer</td>
					 <td>'.$row_detail["nama_cust"].'</td>
				     </tr>
				     <tr>
					 <td>Nama Perusahaan</td>
					 <td>'.$row_detail["nama_perusahaan"].'</td>
				     </tr>
				     <tr>
					 <td>Alamat</td>
					 <td>'.$row_detail["alamat"].'</td>
				     </tr>
				     <tr>
					 <td>Kelurahan</td>
					 <td>'.$row_detail["kelurahan"].'</td>
				     </tr>
				     
				     <tr>
					 <td>Kecamatan</td>
					 <td>'.$row_detail["kecamatan"].'</td>
				     </tr>
				     <tr>
					 <td>Kota</td>
					 <td>'.$row_detail["kota"].'</td>
				     </tr>
				     <tr>
					 <td>Kode Pos</td>
					 <td>'.$row_detail["kode_pos"].'</td>
				     </tr>
				     <tr>
					 <td>No. Telepon</td>
					 <td>'.$row_detail["no_telp"].'</td>
				     </tr>
				     <tr>
					 <td>No. HP 1</td>
					 <td>'.$row_detail["no_hp_1"].'</td>
				     </tr>
				     <tr>
					 <td>No. HP 2</td>
					 <td>'.$row_detail["no_hp_2"].'</td>
				     </tr>
				     <tr>
					 <td>Contact Person</td>
					 <td>'.$row_detail["contact_person"].'</td>
				     </tr>
				     <tr>
					 <td>Email</td>
					 <td>'.$row_detail["email"].'</td>
				     </tr>
				     <tr>
					 <td>Marketing</td>
					 <td>'.$row_detail['marketing'].'</td>
				     </tr>
				   
				   <tr><td colspan="2" width="100%" align="center" >
				   <!--<br><a href="javascript:history.go(-1)"> go back</a><br>-->
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

$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
	       $(\'#Prospek_history\').dataTable({
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
	       });
	       $(\'#email_history\').dataTable({
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
	       });
            });
        </script>
	<script>
	    $(function () {
	      $(\'#myTab a:first\').tab(\'show\')
	    })
	</script>

    ';

    $title	= 'Mailbox';
    $submenu	= "mailbox";
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