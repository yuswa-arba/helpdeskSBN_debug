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
    global $conn_voip;
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
/*
  SELECT `idCustomer`, `cKode`, `cNama`, `cAlamat1`, `cAlamat2`, `cKota`, `cArea`, `cContact`, `ctelp`, `cfax`, `cKet`, `nBatas`, `cKodePl`, `cNoAcc`, `dTglDtgAkhir`, `nHrKunjung`, `cSales`, `nNext`, `cSubArea`, `cDaerah`, `nNo`, `cMasukJd`, `cCab`, `cIntern`, `cNamaPers`, `cEmail`, `cUserID`, `cPaket`, `nHargaPaket`, `cCustInternet`, `cKdPaket`, `cKdOT`, `cNamaOT`, `dTglMulai`, `dTglBerhenti`, `cNonAktiv`, `rowguid`, `cIncludePPN`, `cExcludePPN`, `cIncludePPH`, `cNamaKomisi`, `nKomisi`, `cUserFree`, `cKodeParent`, `cIP1`, `cIP2`, `cIP3`, `nterm`, `cMailIntern`, `cCustomInfo1`, `cCustomInfo2`, `cCustomInfo3`, `cCustomInfo4`, `cComments`, `dTglLahir`, `cMacAdd`, `cKdBTS`, `cNamaBTS`, `cNoRekVirtual`, `cStatus`, `cNamaIbu`, `cNoHp1`, `cNoHp2`, `cNoHp3`, `cBarcode`, `cPassword`, `cIpR1`, `cIpR2`, `cIpR3`, `cIpR4`, `cAccIndex`, `iuserIndex`, `cGroupRBS`, `cJenis`, `cBaru`, `dTglTagihan`, `cKdNAS`, `NASAttribute`, `iGenerate`, `cKonversi`, `cKontrak`, `cPPHPasal23`, `cPPHPasal23Gx`, `cKdProspek`, `cNoKTP`, `cLongi`, `cLati`, `cBulanan`, `cTahunan`, `id_cabang`, `paket_voip`, `paket_data`, `paket_video`, `gx_saldo`, `gx_tipe`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `tbCustomer` WHERE 1 
id_cabang
*/   
    $content ='<section class="content-header">
                    <h1>
                        Data Customer
                        
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
			  <label>User ID *</label>
			</td>
			<td>
			  <input class="form-control" name="user_id" placeholder="User ID" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Nama Koneksi</label>
			</td>
			<td>
			  <input class="form-control" name="nama_koneksi" placeholder="Nama Konekis" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Telpon</label>
			</td>
			<td>
			  <input name="telpon" class="form-control" placeholder="Telpon">
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
	$nama_koneksi	= isset($_POST['nama_koneksi']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_koneksi']))) : "";
	$telpon		= isset($_POST['telpon']) ? mysql_real_escape_string(strip_tags(trim($_POST['telpon']))) : "";
	
	
	$sql_nama_koneksi	= ($nama_koneksi != "") ? "AND `nama_koneksi` LIKE '%".$nama_koneksi."%'": "";
	$sql_telpon		= ($telpon != "") ? "AND `telpon` LIKE '%".$telpon."%'": "";
	
	$sql_customer	= "SELECT * FROM `tbCustomer`
	WHERE `cUserID` LIKE '".$user_id."%'
	$sql_nama_koneksi
	$sql_telpon
	ORDER BY `idCustomer` ASC LIMIT 0,10;";
	
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Customer Number</th>
		    <th>User ID</th>
		    <th>Cabang</th>
		    <th>Paket Koneksi</th>
		    <th>Nama Koneksi</th>
                    <th>Telpon</th>
                    <th>Alamat</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_customer	= mysql_query($sql_customer, $conn);
$no = 1;

 while ($row_customer = mysql_fetch_array($query_customer)) {
 $row_customer_cabang = mysql_fetch_array(mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang`='$row_customer[id_cabang]'", $conn));
 
 $content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_customer["cKode"].'</td>
                    <td>'.$row_customer["cUserID"].'</td>
		    <td>'.$row_customer_cabang["nama_cabang"].'</td>
		    <td>'.$row_customer["cKdPaket"].'</td>
		    <td>'.$row_customer["cPaket"].'</td>
		    <td>'.$row_customer["ctelp"].'</td>
		    <td>'.$row_customer["cAlamat1"].'</td>
                    <td>
                      <a href="" onclick="validepopupform2(\''.$row_customer["idCustomer"].'\',\''.$row_customer["cUserID"].'\',\''.$row_customer["cKdPaket"].'\',\''.$row_customer_cabang["nama_cabang"].'\',\''.$row_customer["cKdPaket"].'\',\''.$row_customer["cPaket"].'\',\''.$row_customer["ctelp"].'\',\''.$row_customer["cAlamat1"].'\')">Select</a>
                    </td>
                  </tr>';
	$no++;
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

 $plugins .= '

<script type="text/javascript">
 	function validepopupform2(f_idcustomer, f_user_id, f_id_cabang, f_nama_cabang, f_paket_koneksi, f_nama_koneksi, f_telpon, f_alamat){
		window.opener.document.'.$return_form.'.kode_customer.value=f_idcustomer;
		window.opener.document.'.$return_form.'.user_id.value=f_user_id;
                window.opener.document.'.$return_form.'.id_cabang.value=f_id_cabang;
		window.opener.document.'.$return_form.'.nama_cabang.value=f_nama_cabang;
		window.opener.document.'.$return_form.'.paket_koneksi.value=f_paket_koneksi;
		window.opener.document.'.$return_form.'.nama_koneksi.value=f_nama_koneksi;
		window.opener.document.'.$return_form.'.telpon.value=f_telpon;
		window.opener.document.'.$return_form.'.alamat.value=f_alamat;
		self.close();
        }
</script>


    ';



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