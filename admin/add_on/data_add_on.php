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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Add On");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data Add On
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Add On</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      <tr>
			<td>
			  <label>Kode Add On *</label>
			</td>
			<td>
			  <input class="form-control" name="kode_add_on" placeholder="Kode Add On" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Customer Number</label>
			</td>
			<td>
			  <input class="form-control" name="kode_customer" placeholder="Customer Number" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Name</label>
			</td>
			<td>
			  <input class="form-control" name="nama_customer" placeholder="Name" type="text" value="">
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
	$kode_add_on			= isset($_POST['kode_add_on']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_add_on']))) : "";
	$customer_number	= isset($_POST['kode_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_customer']))) : "";
	$name				= isset($_POST['nama_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_customer']))) : "";

	
	$sql_nama	= ($name != "") ? "AND `nama_customer` LIKE '".$name."%'": "";
	$sql_kode_add_on	= ($kode_add_on != "") ? "AND `kode_add_on` LIKE '%".$kode_add_on."%'": "";

	$sql_customer	= "SELECT * FROM `gx_add_on`
	WHERE `kode_customer` LIKE '".$customer_number."%'
	$sql_nama
	$sql_kode_add_on
	AND `level` = '0'
	ORDER BY `id_add_on` DESC LIMIT 0,10;";
	
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Customer Number</th>
					<th>User ID</th>
					<th>Name</th>
					<th>Address</th>
					<th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_customer	= mysql_query($sql_customer, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "spk_pasang_add_on"){
  while ($row_customer = mysql_fetch_array($query_customer)) {
    $sql_tbcustomer = mysql_fetch_array(mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".$row_customer["kode_customer"]."' ORDER BY `idCustomer` DESC", $conn));
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_customer["kode_customer"].'</td>
		     <td>'.$sql_tbcustomer["cUserID"].'</td>
		     <td>'.$row_customer["nama_customer"].'</td>
		     <td>'.$sql_tbcustomer["cAlamat1"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_customer["kode_customer"]).'\', \''.mysql_real_escape_string($row_customer["nama_customer"]).'\', \''.mysql_real_escape_string($sql_tbcustomer["cUserID"]).'\', \''.mysql_real_escape_string($sql_tbcustomer["ctelp"]).'\', \''.mysql_real_escape_string($row_customer["kode_paket_add_on"]).'\', \''.mysql_real_escape_string($row_customer["nama_paket_add_on"]).'\', \''.mysql_real_escape_string($sql_tbcustomer["cAlamat1"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }
}else{
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
 if($_GET["f"] == "spk_pasang_add_on"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(customernumber, cnamacust, cuid, ctelp, ckode_paket, cnama_paket, calamat){
		 window.opener.document.'.$return_form.'.kode_customer.value=customernumber;
		 window.opener.document.'.$return_form.'.nama_customer.value=cnamacust;
		 window.opener.document.'.$return_form.'.uid.value=cuid;
		 window.opener.document.'.$return_form.'.telp.value=ctelp;
		 window.opener.document.'.$return_form.'.kode_paket.value=ckode_paket;
		 window.opener.document.'.$return_form.'.nama_paket.value=cnama_paket;
		 window.opener.document.'.$return_form.'.alamat.value=calamat;
		 
		 
		 self.close();
	 }
 </script>
 
     ';
 }
}else{

}


    $title	= 'Data Add On';
    $submenu	= "add_on";
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