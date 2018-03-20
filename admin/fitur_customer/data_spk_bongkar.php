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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data spk bongkar");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data SPK Bongkar
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data SPK Bongkar</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		     
		      <tr>
			<td>
			  <label>Kode SPK Bongkar</label>
			</td>
			<td>
			  <input class="form-control" name="kode_spk_bongkar" placeholder="Kode SPK Bongkar" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Nama Customer</label>
			</td>
			<td>
			  <input class="form-control" name="nama_customer" placeholder="Nama Customer" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Cabang</label>
			</td>
			<td>
			  <input class="form-control" name="cabang" placeholder="cabang" type="text" value="">
			</td>
		      </tr>
		      
		      <tr>
			<td>&nbsp;</td>
			<td>
			  <input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
			</td>
		      </tr>
		</table>';
		
if(isset($_POST["save_search"])){
	$kode_spk_bongkar	= isset($_POST['kode_spk_bongkar']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_spk_bongkar']))) : "";
	$nama_customer = isset($_POST['nama_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_customer']))) : "";
	$cabang		= isset($_POST['cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['cabang']))) : "";
	
	
	$sql_nama_customer	= ($nama_customer != "") ? "AND `nama_customer` LIKE '".$nama_customer."%'": "";
	$sql_cabang		= ($cabang != "") ? "AND `cabang` LIKE '%".$cabang."%'": "";
	
	$sql_spk_bongkar_exe = "SELECT `id`, `kode_spk_bongkar`, `tanggal`, `kode_cabang`, `cabang`, `user_id`, `kode_customer`, `nama_customer`, `no_inactive`, `no_off_connection`, `telp`, `kode_teknisi`, `teknisi`, `alamat`, `pekerjaan`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`
	FROM `gx_spk_bongkar` WHERE `kode_spk_bongkar` LIKE '%".$kode_spk_bongkar."%' ".$sql_nama_customer." ".$sql_cabang."";
	
	
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode SPK Bongkar</th>
		    <th>Tanggal</th>
		    <th>Kode Cabang</th>
		    <th>Cabang</th>
		    <th>Kode Customer</th>
		    <th>Nama Customer</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_spk_bongkar	= mysql_query($sql_spk_bongkar_exe, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "data_spk_bongkar"){
  while ($row = mysql_fetch_array($query_spk_bongkar)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row["kode_spk_bongkar"].'</td>
		     <td>'.$row["tanggal"].'</td>
		     <td>'.$row["kode_cabang"].'</td>
		     <td>'.$row["cabang"].'</td>
		     <td>'.$row["kode_customer"].'</td>
		     <td>'.$row["nama_customer"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row["kode_spk_bongkar"]).'\',\''.mysql_real_escape_string($row["kode_customer"]).'\',\''.mysql_real_escape_string($row["nama_customer"]).'\',\''.mysql_real_escape_string($row["kode_cabang"]).'\',\''.mysql_real_escape_string($row["cabang"]).'\',\''.mysql_real_escape_string($row["user_id"]).'\',\''.mysql_real_escape_string($row["telp"]).'\',\''.mysql_real_escape_string($row["alamat"]).'\')">Select</a>
		     </td>
		   </tr>';
		  
	 $no++;
     }
 }
 if($_GET["f"] == "data_cek_list_barang_bongkar"){
  while ($row = mysql_fetch_array($query_spk_bongkar)){
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row["kode_spk_bongkar"].'</td>
		     <td>'.$row["tanggal"].'</td>
		     <td>'.$row["kode_cabang"].'</td>
		     <td>'.$row["cabang"].'</td>
		     <td>'.$row["kode_customer"].'</td>
		     <td>'.$row["nama_customer"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row["kode_spk_bongkar"]).'\',\''.mysql_real_escape_string($row["kode_customer"]).'\',\''.mysql_real_escape_string($row["nama_customer"]).'\')">Select</a>
		     </td>
		     </tr>';
	 $no++;
     }
 }
}else{
	$content .='';
}
                  $content .='
                  
                </tbody>
              </table>';
}
$content .='
</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
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
                $(\'#customer\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
		    
	    });
	    
	   
        </script>
';
if(isset($_GET["f"])){
 if($_GET["f"] == "data_spk_bongkar"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(ksb, kcus, ncus, kcab, ncab, ui, t, a){
		 window.opener.document.'.$return_form.'.no_spk_bongkar.value=ksb;
		 window.opener.document.'.$return_form.'.kode_customer.value=kcus;
		 window.opener.document.'.$return_form.'.nama_customer.value=ncus;
		 window.opener.document.'.$return_form.'.kode_cabang.value=kcab;
		 window.opener.document.'.$return_form.'.cabang.value=ncab;
		 window.opener.document.'.$return_form.'.user_id.value=ui;
		 window.opener.document.'.$return_form.'.telp.value=t;
		 window.opener.document.'.$return_form.'.alamat.value=a;
		 self.close();
	 }
 </script>';
 }
 if($_GET["f"] == "data_cek_list_barang_bongkar"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(ksb, kcus, ncus){
		 window.opener.document.'.$return_form.'.spk_bongkar.value=ksb;
		 window.opener.document.'.$return_form.'.kode_customer.value=kcus;
		 window.opener.document.'.$return_form.'.nama_customer.value=ncus;
		 self.close();
	 }
 </script>
 
     ';
 } 
}else{
 $plugins .= '';
}


    $title	= 'Data Inactive';
    $submenu	= "helpdesk";
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