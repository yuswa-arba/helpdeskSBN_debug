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

     if(isset($_GET['id_permohonan_justifikasi'])){
	  $id_permohonan_justifikasi	= isset($_GET['id_permohonan_justifikasi']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_permohonan_justifikasi']))) : "";
	  $sql_detail	= mysql_query("SELECT * FROM `gx_permohonan_justifikasi` WHERE `id_permohonan_justifikasi` = '$id_permohonan_justifikasi' LIMIT 0,1;", $conn);
	  $row_detail 	= mysql_fetch_array($sql_detail);
	  
	  
	  $sql_user	= mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".$row_detail["kode_customer"]."' AND `cNonAktiv` = '0' AND `level` = '0' LIMIT 0,1;", $conn);
	  $row_user 	= mysql_fetch_array($sql_user);
	  $user_id	= $row_user["cUserID"];
          $user_index 	= $row_user["iuserIndex"];
     
     }
     
     //echo $user_id;
     //Data RBS
     /*$conn_soft2 = Config::getInstanceSoft();
     $sql_user_soft = $conn_soft2->prepare("SELECT [Users].*
					FROM [DRBSISP].[dbo].[Users]
					WHERE [Users].[UserIndex] = '".$user_index."';");

     $sql_user_soft->execute();
     $row_user_soft = $sql_user_soft->fetch();
     
     `id_permohonan_justifikasi`, `no_justifikasi`, `tanggal`, `kode_customer`,
     `nama_customer`, `longitude`, `latitude`, `tiang_terdekat`, `kode_paket`,
     `nama_paket`, `kontrak`, `setup_fee_normal`, `abonemen_normal`,
     `monthly_fee_normal`, `bandwith_normal`, `setup_fee_justifikasi`,
     `abonemen_justifikasi`, `monthly_fee_justifikasi`, `bandwith_justifikasi`,
     `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`
     FROM `gx_permohonan_justifikasi`
     
     */
     $content ='<section class="content-header">
		     <h1>
			 Detail Prospek
		     </h1>
		     
		 </section>
 
		 <!-- Main content -->
		 
		 <section class="content">
		     <div class="row">
			 <div class="col-xs-12">
			    
			    
			    <div class="box">
				   <div class="box-header">
					<h2 class="box-title">Detail Permohonan Justifikasi</h2>
				   </div>
				 
				   <div class="box-body">
				   <table style="margin-bottom: 0;width:60%">
				     <tbody>
				     <tr>
					 <td>No. Justifikasi </td>
					 <td>'.$row_detail["no_justifikasi"].'</td>
				     </tr>
				     <tr>
					 <td>Tanggal</td>
					 <td>'.$row_detail["tanggal"].'</td>
				     </tr>
				     <tr>
					 <td>Kode Customer</td>
					 <td>'.$row_detail["kode_customer"].'</td>
				     </tr>
				     <tr>
					 <td>Nama Customer</td>
					 <td>'.$row_detail["nama_customer"].'</td>
				     </tr>
				     <tr>
					 <td>Longitude</td>
					 <td>'.$row_detail["longitude"].'</td>
				     </tr>
				     <tr>
					 <td>Latitude</td>
					 <td>'.$row_detail["latitude"].'</td>
				     </tr>
				     <tr>
					 <td>Tiang Terdekat</td>
					 <td>'.$row_detail["tiang_terdekat"].'</td>
				     </tr>
				     <tr>
					 <td>Kode Paket</td>
					 <td>'.$row_detail["kode_paket"].'</td>
				     </tr>
				     
				     <tr>
					 <td>Nama Paket</td>
					 <td>'.$row_detail["nama_paket"].'</td>
				     </tr>
				     <tr>
					 <td>Kontrak</td>
					 <td>'.$row_detail["kontrak"].'</td>
				     </tr>
				     <tr>
					 <td>Setup Fee Normal</td>
					 <td>'.$row_detail["setup_fee_normal"].'</td>
				     </tr>
				     <tr>
					 <td>Abonemen Normal</td>
					 <td>'.$row_detail["abonemen_normal"].'</td>
				     </tr>
				     <tr>
					 <td>Monthly Fee Normal</td>
					 <td>'.$row_detail["monthly_fee_normal"].'</td>
				     </tr>
				     <tr>
					 <td>Bandwith Normal</td>
					 <td>'.$row_detail["bandwith_normal"].'</td>
				     </tr>
				     <tr>
					 <td>Setup Fee Justifikasi</td>
					 <td>'.$row_detail["setup_fee_justifikasi"].'</td>
				     </tr>
				     <tr>
					 <td>Abonemen Justifikasi</td>
					 <td>'.$row_detail["abonemen_justifikasi"].'</td>
				     </tr>
				     <tr>
					 <td>Monthly Fee Justifikasi</td>
					 <td>'.$row_detail['monthly_fee_justifikasi'].'</td>
				     </tr>
				     <tr>
					 <td>Bandwith Justifikasi</td>
					 <td>'.$row_detail['bandwith_justifikasi'].'</td>
				     </tr>
				     <tr>
					 <td>Remarks</td>
					 <td>'.$row_detail['remarks'].'</td>
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