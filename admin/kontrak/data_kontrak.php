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
$posisi_log_page = "Open data Cust";

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
 
 enableLog("", $loggedin["username"], $loggedin["id_employee"], $posisi_log_page);
    global $conn;    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data Kontrak 
                    </h1>
                    
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Customer</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      <tr>
			<td>
			  <label>No. Kontrak</label>
			</td>
			<td>
			  <input class="form-control" name="noKontrak" placeholder="noKontrak" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Kode Customer</label>
			</td>
			<td>
			  <input class="form-control" name="kodeCustomer" placeholder="kodeCustomer" type="text" value="">
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
	$noKontrak	= isset($_POST['noKontrak']) ? mysql_real_escape_string(strip_tags(trim($_POST['noKontrak']))) : "";
	$kodeCustomer	= isset($_POST['kodeCustomer']) ? mysql_real_escape_string(strip_tags(trim($_POST['kodeCustomer']))) : "";
	
	//$sqlNoKontrak		= ($noKontrak != "") ? "AND `cNama` LIKE '".$noKontrak."%'": "";
	$sqlKodeCustomer	= ($kodeCustomer != "") ? "AND `kode_customer` LIKE '%".$kodeCustomer."%'": "";
	
	$sql	= "SELECT * FROM `gx_kontrak`
	WHERE `kode_kontrak` LIKE '".$noKontrak."%'
	$sqlKodeCustomer
	ORDER BY `id` ASC LIMIT 0,10;";
	
		$content .='<table class="table table-bordered table-striped" id="data_kontrak">
                <thead>
                  <tr>
                    <th>No. Kontrak</th>
                    <th>Kode Cabang</th>
		    <th>Kode Customer</th>
		    <th>Lama Kontrak</th>
		    <th>Tanggal</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query	= mysql_query($sql, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "data_kontrak"){
  while ($row = mysql_fetch_array($query)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row["kode_kontrak"].'</td>
		     <td>'.$row["kode_customer"].'</td>
		     <td>'.$row["lama_kontrak"].'</td>
		     <td>'.$row["tanggal"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row["kode_kontrak"]).'\',\''.mysql_real_escape_string($row["kode_cabang"]).'\',\''.mysql_real_escape_string($row["nama_cabang"]).'\',\''.mysql_real_escape_string($row["kode_customer"]).'\',\''.mysql_real_escape_string($row["nama_customer"]).'\',\''.mysql_real_escape_string($row["lama_kontrak"]).'\',\''.mysql_real_escape_string($row["periode_kontrak_mulai"]).'\',\''.mysql_real_escape_string($row["periode_kontrak_akhir"]).'\',\''.mysql_real_escape_string($row["tanggal"]).'\')">Select</a>
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
 if($_GET["f"] == "data_kontrak"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(kodeKontrak, kodeCabang, namaCabang, kodeCustomer, namaCustomer, lamaKontrak, periodeKontrakMulai, periodeKontrakAkhir, tanggal){
		 window.opener.document.'.$return_form.'.kode_kontrak.value=kodeKontrak;
		 window.opener.document.'.$return_form.'.kode_cabang.value=kodeCabang;
		 window.opener.document.'.$return_form.'.nama_cabang.value=namaCabang;
		 window.opener.document.'.$return_form.'.kode_customer.value=kodeCustomer;
		 window.opener.document.'.$return_form.'.nama_customer.value=namaCustomer;
		 window.opener.document.'.$return_form.'.lama_kontrak.value=lamaKontrak;
		 window.opener.document.'.$return_form.'.periode_kontrak_mulai.value=periodeKontrakMulai;
		 window.opener.document.'.$return_form.'.periode_kontrak_akhir.value=periodeKontrakAkhir;
		 window.opener.document.'.$return_form.'.tanggal.value=tanggal;
		 
		 
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