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
                        Data Reaktivasi
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Reaktivasi</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		     
		      <tr>
			<td>
			  <label>Kode Reaktivasi</label>
			</td>
			<td>
			  <input class="form-control" name="kode_reaktivasi" placeholder="Kode Reaktivasi" type="text" value="">
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
	$kode_reaktivasi	= isset($_POST['kode_reaktivasi']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_reaktivasi']))) : "";
	$kode_customer		= isset($_POST['kode_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_customer']))) : "";
	
	
	$sql_kode_reaktivasi	= ($kode_reaktivasi != "") ? "AND `kode_reaktivasi` LIKE '".$kode_reaktivasi."%'": "";
	$sql_kode_customer	= ($kode_customer != "") ? "AND `kode_customer` LIKE '".$kode_customer."%'": "";
	
	$sql_reaktivasi_exe = "SELECT * FROM `gx_reaktivasi_customer` WHERE `level`='0'
	$sql_kode_reaktivasi
	$sql_kode_customer";
		
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Reaktivasi</th>
                    <th>Kode Customer</th>
		    <th>Nama Customer</th>
		    <th>User ID</th>
		    <th>Remarks</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';
/*SELECT `id`, `nama_pelanggan`, `kode_customer`, `periode_tagihan`, `tanggal_tagihan`, `kode_invoice`, `tanggal_jatuh_tempo`,
`npwp`, `no_virtual_account_bca`, `nama_virtual_account`, `no_faktur_pajak`, `note`, `reaktivasi_invoice`, `total_invoice`,
`ppn_invoice`, `grand_total_invoice`, `uang_muka_invoice`, `sisa_invoice`, `prepared_by`, `printed_by`, `status`, `date_add`,
`date_upd`, `level`, `user_add`, `user_upd` FROM `gx_invoice_reaktivasi_customer` WHERE 1*/

$query_reaktivasi	= mysql_query($sql_reaktivasi_exe, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "data_reaktivasi"){
  /*SELECT `id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_reaktivasi`, `kode_customer`, `nama_customer`,
  `user_id`, `no_inactive`, `status_inactive`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir` FROM `gx_reaktivasi_customer` WHERE 1*/
  while ($row = mysql_fetch_array($query_reaktivasi)) {
	$exp_tanggal = explode("-", $row["tanggal"]); 
	$tgl_jatuh_tempo = date("Y-m-d", mktime('0', '0', '0', $exp_tanggal['1'], $exp_tanggal['2']+3, $exp_tanggal['0']));
	
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row["kode_reaktivasi"].'</td>
		     <td>'.$row["kode_customer"].'</td>
		     <td>'.$row["nama_customer"].'</td>
		     <td>'.$row["user_id"].'</td>
		     <td>'.$row["remarks"].'</td>
		     <td>

  
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row["kode_cabang"]).'\',
  \''.mysql_real_escape_string($row["nama_cabang"]).'\',\''.mysql_real_escape_string($row["tanggal"]).'\',
  \''.mysql_real_escape_string($row["kode_reaktivasi"]).'\',\''.mysql_real_escape_string($row["kode_customer"]).'\',
  \''.mysql_real_escape_string($row["nama_customer"]).'\',\''.mysql_real_escape_string($row["user_id"]).'\',
  \''.mysql_real_escape_string($row["no_inactive"]).'\',\''.mysql_real_escape_string($row["status_inactive"]).'\',
  \''.mysql_real_escape_string($row["remarks"]).'\',\''.mysql_real_escape_string($row["kode_cso"]).'\',
  \''.mysql_real_escape_string($row["request"]).'\',\''.mysql_real_escape_string($row["no_formulir"]).'\'
  ,\''.mysql_real_escape_string($tgl_jatuh_tempo).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }
}else{
	$content .='null';
}
    
		
                  $content .='</tbody>
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
 if($_GET["f"] == "data_reaktivasi"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(kc, nc, tg, kr, kcu, ncu, ui, ni, si, rm, kcs, rq, nf, tj){
		 window.opener.document.'.$return_form.'.kode_cabang.value=kc;
		 window.opener.document.'.$return_form.'.nama_cabang.value=nc;
		 window.opener.document.'.$return_form.'.tanggal_r.value=tg;
		 window.opener.document.'.$return_form.'.kode_reaktivasi.value=kr;
		 window.opener.document.'.$return_form.'.kode_customer.value=kcu;
		 window.opener.document.'.$return_form.'.nama_customer.value=ncu;
		 window.opener.document.'.$return_form.'.user_id.value=ui;
		 window.opener.document.'.$return_form.'.no_inactive.value=ni;
		 window.opener.document.'.$return_form.'.status_inactive.value=si;
		 window.opener.document.'.$return_form.'.remarks.value=rm;
		 window.opener.document.'.$return_form.'.kode_cso.value=kcs;
		 window.opener.document.'.$return_form.'.request.value=rq;
		 window.opener.document.'.$return_form.'.no_formulir.value=nf;		 
		 window.opener.document.'.$return_form.'.tanggal_jatuh_tempo.value=tj;
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