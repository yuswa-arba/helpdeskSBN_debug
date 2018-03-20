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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data SPK Pasang Add On");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data SPK Pasang Add On
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data SPK Pasang Add On</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      <tr>
			<td>
			  <label>User ID *</label>
			</td>
			<td>
			  <input class="form-control" name="uid" placeholder="User ID" type="text" value="">
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
	$user_id			= isset($_POST['uid']) ? mysql_real_escape_string(strip_tags(trim($_POST['uid']))) : "";
	$customer_number	= isset($_POST['kode_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_customer']))) : "";
	$name				= isset($_POST['nama_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_customer']))) : "";

	
	$sql_nama	= ($name != "") ? "AND `gx_spk_pasang_add_on`.`nama_customer` LIKE '".$name."%'": "";
	$sql_userid	= ($user_id != "") ? "AND `gx_spk_pasang_add_on`.`uid` LIKE '%".$user_id."%'": "";

	$sql_customer	= "SELECT `gx_jawab_spk_pasang_add_on`.* FROM `gx_spk_pasang_add_on` , `gx_jawab_spk_pasang_add_on`
							WHERE `gx_spk_pasang_add_on`.`kode_customer` LIKE '".$customer_number."%'
							$sql_nama
							$sql_userid
							AND `gx_spk_pasang_add_on`.`kode_spk_pasang_add_on` = `gx_jawab_spk_pasang_add_on`.`kode_spk_pasang_add_on`
							AND `gx_spk_pasang_add_on`.`level` = `gx_jawab_spk_pasang_add_on`.`level`
							AND  `gx_jawab_spk_pasang_add_on`.`level` = '0'
							ORDER BY `gx_spk_pasang_add_on`.`id_spk_pasang_add_on` DESC LIMIT 0,10;";
	
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
 if($_GET["f"] == "spk_aktivasi_add_on"){
  while ($row_customer = mysql_fetch_array($query_customer)) {
	$data_spk_pasang_konversi_teknisi = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_customer[id_teknisi]'", $conn));
	$data_spk_pasang_konversi_marketing = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_customer[id_marketing]'", $conn));
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_customer["kode_customer"].'</td>
		     <td>'.$row_customer["uid"].'</td>
		     <td>'.$row_customer["nama_customer"].'</td>
		     <td>'.$row_customer["alamat"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_customer["kode_spk_pasang_add_on"]).'\', \''.mysql_real_escape_string($row_customer["kode_jawab_spk_pasang_add_on"]).'\', \''.mysql_real_escape_string($row_customer["kode_customer"]).'\', \''.mysql_real_escape_string($row_customer["nama_customer"]).'\', \''.mysql_real_escape_string($row_customer["kode_paket"]).'\', \''.mysql_real_escape_string($row_customer["nama_paket"]).'\', \''.mysql_real_escape_string($row_customer["uid"]).'\', \''.mysql_real_escape_string($row_customer["telp"]).'\', \''.mysql_real_escape_string($row_customer["kode_linkbudget"]).'\', \''.mysql_real_escape_string($row_customer["alamat"]).'\', \''.mysql_real_escape_string($row_customer["id_teknisi"]).'\', \''.mysql_real_escape_string($row_customer["id_marketing"]).'\', \''.mysql_real_escape_string($data_spk_pasang_konversi_teknisi["cNama"]).'\', \''.mysql_real_escape_string($data_spk_pasang_konversi_marketing["cNama"]).'\', \''.mysql_real_escape_string($row_customer["pekerjaan"]).'\')">Select</a>
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
 if($_GET["f"] == "spk_aktivasi_add_on"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(ckode_spk_pasang,ckode_jawab_spk_pasang,ckode_customer,cnama_customer,ckode_paket,cnama_paket,cuid,ctelp,cnolink_budget,calamat,cid_teknisi,cid_marketing,cnama_teknisi,cnama_marketing){
		 window.opener.document.'.$return_form.'.kode_spk_pasang_add_on.value=ckode_spk_pasang;
		 window.opener.document.'.$return_form.'.kode_jawab_spk_pasang_add_on.value=ckode_jawab_spk_pasang;
		 window.opener.document.'.$return_form.'.kode_customer.value=ckode_customer;
		 window.opener.document.'.$return_form.'.nama_customer.value=cnama_customer;
		 window.opener.document.'.$return_form.'.kode_paket.value=ckode_paket;
		 window.opener.document.'.$return_form.'.nama_paket.value=cnama_paket;
		 window.opener.document.'.$return_form.'.uid.value=cuid;
		 window.opener.document.'.$return_form.'.telp.value=ctelp;
		 window.opener.document.'.$return_form.'.no_linkbudget.value=cnolink_budget;
		 window.opener.document.'.$return_form.'.alamat.value=calamat;
		 window.opener.document.'.$return_form.'.id_teknisi.value=cid_teknisi;
		 window.opener.document.'.$return_form.'.id_employee.value=cid_marketing;
		 window.opener.document.'.$return_form.'.nama_teknisi.value=cnama_teknisi;
		 window.opener.document.'.$return_form.'.nama_marketing.value=cnama_marketing;
		 
		 self.close();
	 }
 </script>
 
     ';
 }
}else{

}


    $title	= 'Data SPK Pasang Konversi';
    $submenu	= "spk_pasang_konversi";
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