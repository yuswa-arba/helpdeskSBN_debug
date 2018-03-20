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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Cust");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data Balik Nama
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Balik Nama</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		     
		      <tr>
			<td>
			  <label>Kode Balik Nama</label>
			</td>
			<td>
			  <input class="form-control" name="kode_balik_nama" placeholder="Kode Balik Nama" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Kode Customer</label>
			</td>
			<td>
			  <input class="form-control" name="kode_customer" placeholder="Kode Customer" type="text" value="">
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
	$kode_balik_nama	= isset($_POST['kode_balik_nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_balik_nama']))) : "";
	$kode_customer		= isset($_POST['kode_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_customer']))) : "";
	
	$sql_customer	= ($kode_customer != "") ? "AND `kode_customer` LIKE '%".$kode_customer."%'": "";
	
	$sql	= "SELECT * FROM `gx_balik_nama`
	WHERE `kode_balik_nama` LIKE '".$kode_balik_nama."%'
	$sql_customer	ORDER BY `id` ASC LIMIT 0,10;";
	
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Cabang</th>
		    <th>Kode Balik Nama</th>
		    <th>Kode Customer</th>
		    <th>Nama Lama</th>
		    <th>Nama Baru</th>
		    <!--<th>Mother name</th>
                    <th>Phone</th>
                    <th>Status</th>-->
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query	= mysql_query($sql, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "data_balik_nama"){
  while ($row = mysql_fetch_array($query)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row["nama_cabang"].'</td>
		     <td>'.$row["kode_balik_nama"].'</td>
		     <td>'.$row["kode_customer"].'</td>
		     <td>'.$row["nama_lama"].'</td>
		     <td>'.$row["nama_baru"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row["kode_balik_nama"]).'\',\''.mysql_real_escape_string($row["nama_lama"]).'\',\''.mysql_real_escape_string($row["kode_customer"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }
 if($_GET["f"] == "data_invoice_balik_nama"){
  while ($row = mysql_fetch_array($query)) {
  
  $sql_customer	= "SELECT * FROM `tbCustomer` WHERE `cKode`='".$row['kode_customer']."' LIMIT 0,1";
  $query_customer = mysql_query($sql_customer, $conn);
  $data_array_customer = mysql_fetch_array($query_customer);
   
	 $nama_npwp 		= $data_array_customer['nama_npwp'];
	 $alamat_npwp 		= $data_array_customer['alamat_npwp'];
	 $no_npwp 		= $data_array_customer['no_npwp'];
	 
	 
	 $va		= $data_array_customer['cNoRekVirtual'];
	 $nama_va 	= $data_array_customer['cNama'];
	 $faktur 	= $data_array_customer['cIncludePPN'];
	 
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row["nama_cabang"].'</td>
		     <td>'.$row["kode_balik_nama"].'</td>
		     <td>'.$row["kode_customer"].'</td>
		     <td>'.$row["nama_lama"].'</td>
		     <td>'.$row["nama_baru"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row["kode_balik_nama"]).'\',\''.mysql_real_escape_string($row["nama_lama"]).'\',\''.mysql_real_escape_string($row["kode_customer"]).'\',\''.mysql_real_escape_string($no_npwp).'\',\''.mysql_real_escape_string($va).'\',\''.mysql_real_escape_string($nama_va).'\',\''.mysql_real_escape_string($faktur).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }
}else{
   while ($row = mysql_fetch_array($query)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row["nama_cabang"].'</td>
		     <td>'.$row["kode_balik_nama"].'</td>
		     <td>'.$row_customer["kode_customer"].'</td>
		     <td>'.$row_customer["nama_lama"].'</td>
		     <td>'.$row_customer["nama_baru"].'</td>
		     <!--<td>'.$row_customer["cNamaIbu"].'</td>-->
		     <!--<td>'.$row_customer["ctelp"].'</td>
		     <td>'.$row_customer["cNonAktiv"].'</td>-->
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row["kode_balik_nama"]).'\',\''.mysql_real_escape_string($row["nama_lama"]).'\',\''.mysql_real_escape_string($row["kode_customer"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
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
 if($_GET["f"] == "data_balik_nama"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(kdm, nl, kc){
		 window.opener.document.'.$return_form.'.kode_balik_nama.value=kdm;
		 window.opener.document.'.$return_form.'.nama_pelanggan.value=nl;
		 window.opener.document.'.$return_form.'.kode_customer.value=kc;
		 
		 
		 self.close();
	 }
 </script>
 
     ';
 }
 if($_GET["f"] == "data_invoice_balik_nama"){
  $plugins .= '
 <script type="text/javascript">
   	 function validepopupform2(kdm, nl, kc, no_npwp, va, nama_va, faktur){
		 window.opener.document.'.$return_form.'.kode_balik_nama.value=kdm;
		 window.opener.document.'.$return_form.'.nama_pelanggan.value=nl;
		 window.opener.document.'.$return_form.'.kode_customer.value=kc;
		 window.opener.document.'.$return_form.'.npwp.value=no_npwp;
		 window.opener.document.'.$return_form.'.no_virtual_account_bca.value=va;
		 window.opener.document.'.$return_form.'.nama_virtual_account.value=nama_va;
		 window.opener.document.'.$return_form.'.no_faktur_pajak.value=faktur;
		 self.close();
	 }
 </script>
 
     ';
 }
}else{
 $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(kdm, nl, kc){
		 window.opener.document.'.$return_form.'.kode_balik_nama.value=kdm;
		 window.opener.document.'.$return_form.'.nama_pelanggan.value=nl;
		 window.opener.document.'.$return_form.'.kode_customer.value=kc;
		 
		 
		 self.close();
	 }
 </script>
 
     ';
}


    $title	= 'Data Customer';
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