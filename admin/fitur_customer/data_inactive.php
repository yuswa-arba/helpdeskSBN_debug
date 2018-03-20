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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Inactive");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data Inactive
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Inactive</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		     
		      <tr>
			<td>
			  <label>Customer Number</label>
			</td>
			<td>
			  <input class="form-control" name="customer_number" placeholder="Customer Number" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Nama Customer</label>
			</td>
			<td>
			  <input class="form-control" name="customer_number" placeholder="Customer Number" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>No Inactive</label>
			</td>
			<td>
			  <input class="form-control" name="name" placeholder="kode_inactive" type="text" value="">
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
	$user_id	= isset($_POST['user_id']) ? mysql_real_escape_string(strip_tags(trim($_POST['user_id']))) : "";
	$customer_number= isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
	$name		= isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
	$no_inactive 	= isset($_POST['no_inactive']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_inactive']))) : "";
	
	
	$sql_nama	= ($name != "") ? "AND `cNama` LIKE '".$name."%'": "";
	$sql_userid	= ($user_id != "") ? "AND `cUserID` LIKE '%".$user_id."%'": "";
	$sql_inactive	= ($no_inactive != "") ? "AND `cAlamat1` LIKE '%".$address."%'": "";
	
	$sql_inactive_exe = "SELECT `id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_inactive`, `kode_customer`, `nama_customer`, `user_id`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_inactive_customer` WHERE 1";
	
	$sql_customer	= "SELECT * FROM `tbCustomer`
	WHERE `cKode` LIKE '".$customer_number."%'
	$sql_nama
	$sql_userid
	$sql_inactive
	ORDER BY `idCustomer` ASC LIMIT 0,10;";
	
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Customer Number</th>
		    <th>User ID</th>
		    <th>Name</th>
		    <th>Address</th>
		    <!--<th>Mother name</th>
                    <th>Phone</th>
                    <th>Status</th>-->
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_customer	= mysql_query($sql_customer, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "data_customer"){
  while ($row_customer = mysql_fetch_array($query_customer)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_customer["cKode"].'</td>
		     <td>'.$row_customer["cUserID"].'</td>
		     <td>'.$row_customer["cNama"].'</td>
		     <td>'.$row_customer["cAlamat1"].'</td>
		     <!--<td>'.$row_customer["cNamaIbu"].'</td>-->
		     <!--<td>'.$row_customer["ctelp"].'</td>
		     <td>'.$row_customer["cNonAktiv"].'</td>-->
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_customer["cUserID"]).'\',\''.mysql_real_escape_string($row_customer["cKode"]).'\',\''.mysql_real_escape_string($row_customer["cNama"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }
  if($_GET["f"] == "data_customer_inactive"){
  while ($row_customer = mysql_fetch_array($query_customer)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_customer["cKode"].'</td>
		     <td>'.$row_customer["cUserID"].'</td>
		     <td>'.$row_customer["cNama"].'</td>
		     <td>'.$row_customer["cAlamat1"].'</td>
		     <!--<td>'.$row_customer["cNamaIbu"].'</td>-->
		     <!--<td>'.$row_customer["ctelp"].'</td>
		     <td>'.$row_customer["cNonAktiv"].'</td>-->
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_customer["cUserID"]).'\',\''.mysql_real_escape_string($row_customer["cKode"]).'\',\''.mysql_real_escape_string($row_customer["cNama"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }
  if($_GET["f"] == "data_customer_reaktivasi"){
  while ($row_customer = mysql_fetch_array($query_customer)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_customer["cKode"].'</td>
		     <td>'.$row_customer["cUserID"].'</td>
		     <td>'.$row_customer["cNama"].'</td>
		     <td>'.$row_customer["cAlamat1"].'</td>
		     <!--<td>'.$row_customer["cNamaIbu"].'</td>-->
		     <!--<td>'.$row_customer["ctelp"].'</td>
		     <td>'.$row_customer["cNonAktiv"].'</td>-->
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_customer["cUserID"]).'\',\''.mysql_real_escape_string($row_customer["cKode"]).'\',\''.mysql_real_escape_string($row_customer["cNama"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }
}else{
 while ($row_customer = mysql_fetch_array($query_customer)) {
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_customer["cKode"].'</td>
                    <td>'.$row_customer["cUserID"].'</td>
		    <td>'.$row_customer["cNama"].'</td>
		    <td>'.$row_customer["cAlamat1"].'</td>
		    <!--<td>'.$row_customer["cNamaIbu"].'</td>-->
		    <!--<td>'.$row_customer["ctelp"].'</td>
		    <td>'.$row_customer["cNonAktiv"].'</td>-->
                    <td>
                      <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_customer["cUserID"]).'\',\''.mysql_real_escape_string($row_customer["cKode"]).'\',\''.mysql_real_escape_string($row_customer["cNama"]).'\',\''.mysql_real_escape_string($row_customer["cAlamat1"]).'\',\''.mysql_real_escape_string($row_customer["cNamaPers"]).'\',\''.mysql_real_escape_string($row_customer["cKota"]).'\',\''.mysql_real_escape_string($row_customer["cfax"]).'\',\''.mysql_real_escape_string($row_customer["ctelp"]).'\',\''.mysql_real_escape_string($row_customer["cEmail"]).'\',\''.mysql_real_escape_string($row_customer["cPaket"]).'\',\''.mysql_real_escape_string($row_customer["cNoHp1"]).'\',\''.mysql_real_escape_string($row_customer["cNoHp2"]).'\',\''.mysql_real_escape_string($row_customer["cContact"]).'\')">Select</a>
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
 if($_GET["f"] == "data_customer"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(uid, custNumber, nama){
		 window.opener.document.'.$return_form.'.user_id.value=uid;
		 window.opener.document.'.$return_form.'.kode_customer.value=custNumber;
		 window.opener.document.'.$return_form.'.nama_lama.value=nama;
		 
		 
		 self.close();
	 }
 </script>
 
     ';
 }
 if($_GET["f"] == "data_customer_inactive"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(uid, custNumber, nama){
		 window.opener.document.'.$return_form.'.user_id.value=uid;
		 window.opener.document.'.$return_form.'.kode_customer.value=custNumber;
		 window.opener.document.'.$return_form.'.nama_customer.value=nama;
		 
		 
		 self.close();
	 }
 </script>
 
     ';
 }
 
 if($_GET["f"] == "data_customer_reaktivasi"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(uid, custNumber, nama){
		 window.opener.document.'.$return_form.'.user_id.value=uid;
		 window.opener.document.'.$return_form.'.kode_customer.value=custNumber;
		 window.opener.document.'.$return_form.'.nama_customer.value=nama;
		 
		 
		 self.close();
	 }
 </script>
 
     ';
 }
}else{
 $plugins .= '

<script type="text/javascript">
  
	function validepopupform2(uid, custNumber, nama, alamat, namaperusahaan, kota, fax, ctelp, cemail, con_type, hp1, hp2, contact){
		//window.opener.document.'.$return_form.'.user_id.value=uid;
                window.opener.document.'.$return_form.'.kode_customer.value=custNumber;
		window.opener.document.'.$return_form.'.nama_customer.value=nama;
		window.opener.document.'.$return_form.'.nama_perusahaan.value=namaperusahaan;
		window.opener.document.'.$return_form.'.alamat.value=alamat;
		window.opener.document.'.$return_form.'.kota.value=kota;
		window.opener.document.'.$return_form.'.notelp.value=ctelp;
		window.opener.document.'.$return_form.'.hp1.value=hp1;
		window.opener.document.'.$return_form.'.hp2.value=hp2;
		window.opener.document.'.$return_form.'.contact.value=contact;
		window.opener.document.'.$return_form.'.email.value=cemail;
		
		
                self.close();
        }
</script>


    ';
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