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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open detail Customer");
     global $conn;

     if(isset($_GET['id_spk_pasang_baru'])){
	  $id_spk_pasang_baru	= isset($_GET['id_spk_pasang_baru']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_spk_pasang_baru']))) : "";
	  $sql_detail	= mysql_query("SELECT * FROM `gx_spk_pasang` WHERE `id_spkpasang` = '$id_spk_pasang_baru' LIMIT 0,1;", $conn);
	  $row_detail 	= mysql_fetch_array($sql_detail);
	  
	  $data_array_teknisi 	= mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_detail[id_teknisi]'", $conn));
	  $data_array_marketing = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_detail[id_marketing]'", $conn));
	  
     
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
			 Detail SPK Pasang Baru
		     </h1>
		     
		 </section>
 
		 <!-- Main content -->
		 
		 <section class="content">
		     <div class="row">
			 <div class="col-xs-12">
			    
			    
			    <div class="box">
				   <div class="box-header">
					<h2 class="box-title">Detail SPK Pasang Baru</h2>
				   </div>
				 
				   <div class="box-body">
				   <table style="margin-bottom: 0;width:60%">
				     <tbody>
				     <tr>
					 <td>No. SPK Pasang Baru</td>
					 <td>'.$row_detail["kode_spk"].'</td>
				     </tr>
				     <tr>
					 <td>Tanggal</td>
					 <td>'.$row_detail["tanggal"].'</td>
				     </tr>
				     <tr>
					 <td>Kode Customer</td>
					 <td>'.$row_detail["id_customer"].'</td>
				     </tr>
				     <tr>
					 <td>Nama Customer</td>
					 <td>'.$row_detail["nama_customer"].'</td>
				     </tr>
				     <tr>
					 <td>Cabang</td>
					 <td>'.$row_detail["nama_cabang"].'</td>
				     </tr>
				     <tr>
					 <td>No. Link Budget</td>
					 <td>'.$row_detail["id_linkbudget"].'</td>
				     </tr>
				     <tr>
					 <td>Paket Koneksi</td>
					 <td>'.$row_detail["paket_koneksi"].'</td>
				     </tr>
				     <tr>
					 <td>Nama Koneksi</td>
					 <td>'.$row_detail["nama_koneksi"].'</td>
				     </tr>
				     
				     <tr>
					 <td>User ID</td>
					 <td>'.$row_detail["user_id"].'</td>
				     </tr>
				     <tr>
					 <td>Telp</td>
					 <td>'.$row_detail["telpon"].'</td>
				     </tr>
				     <tr>
					 <td>Alamat</td>
					 <td>'.$row_detail["alamat"].'</td>
				     </tr>
				     <tr>
					 <td>Teknisi</td>
					 <td>'.$data_array_teknisi["cNama"].'</td>
				     </tr>
				     <tr>
					 <td>Marketing</td>
					 <td>'.$data_array_marketing["cNama"].'</td>
				     </tr>
				     <tr>
					 <td>Pekerjaan</td>
					 <td>'.$row_detail["pekerjaan"].'</td>
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

    $title	= 'Detail SPK Pasang Baru ';
    $submenu	= "detail_pasang_baru";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>