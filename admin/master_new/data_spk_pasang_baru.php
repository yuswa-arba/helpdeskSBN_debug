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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Cabang");
    global $conn;
    global $conn_voip;
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data SPK Pasang Baru
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data SPK Pasang Baru</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<!--<table class="form" width="80%">
		      <tr>
			<td>
			  <label>User ID *</label>
			</td>
			<td>
			  <input class="form-control" name="voip_number" placeholder="Voip Number" type="text" value="">
			</td>
		      </tr>
		      
		      <tr>
			<td>&nbsp;</td>
			<td>
			  <input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
			</td>
		      </tr>
		</table>-->';
		
if(isset($_POST["save_search"])){
	
}else{
 $sql_spk_pasang_baru	= "SELECT * FROM `gx_spk_pasang` WHERE `level` = '0' ORDER BY `id_spkpasang` ASC LIMIT 0,10;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>No. SPK Pasang Baru</th>
		    <th>Tanggal</th>
		    <th>Kode Customer</th>
		    
		    <th>No. Link Budget</th>
		    
		    <th>Teknisi</th>
		    
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_spk_pasang_baru	= mysql_query($sql_spk_pasang_baru, $conn);
$no = 1;

    while ($row_spk_pasang_baru = mysql_fetch_array($query_spk_pasang_baru)) {
	$sql_last_prospek  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_prospek` ORDER BY `id_prospek` DESC", $conn));
	$last_data  = $sql_last_prospek["id_prospek"] + 1;
	$row_spk_pasang_baru_teknisi 	= mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_spk_pasang_baru[id_teknisi]'", $conn));
	$row_spk_pasang_baru_marketing 	= mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_spk_pasang_baru[id_marketing]'", $conn));
	  
	$tanggal    = date("d");
	/*$kode_spk_pasang_baru = $row_spk_pasang_baru["kode_spk"].'-'.$row_spk_pasang_baru["kode_prospek"].''.$tanggal.''.sprintf("%04d", $last_data);*/
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_spk_pasang_baru["kode_spk"].'</td>
                    <td>'.$row_spk_pasang_baru["tanggal"].'</td>
		    <td>'.$row_spk_pasang_baru["id_customer"].'</td>
		    <td>'.$row_spk_pasang_baru["id_linkbudget"].'</td>
		    <td>'.$row_spk_pasang_baru_teknisi["cNama"].'</td>
		    
		   
		    <td>
                      <a href="" onclick="validepopupform2(\''.$row_spk_pasang_baru["kode_spk"].'\', \''.$row_spk_pasang_baru["id_customer"].'\', \''.$row_spk_pasang_baru["nama_customer"].'\', \''.$row_spk_pasang_baru["id_cabang"].'\', \''.$row_spk_pasang_baru["nama_cabang"].'\', \''.$row_spk_pasang_baru["id_linkbudget"].'\', \''.$row_spk_pasang_baru["paket_koneksi"].'\', \''.$row_spk_pasang_baru["nama_koneksi"].'\', \''.$row_spk_pasang_baru["user_id"].'\', \''.$row_spk_pasang_baru["telpon"].'\', \''.$row_spk_pasang_baru["alamat"].'\', \''.$row_spk_pasang_baru_teknisi["cNama"].'\', \''.$row_spk_pasang_baru_marketing["cNama"].'\', \''.$row_spk_pasang_baru["pekerjaan"].'\')">Select</a>
                    </td>
                  </tr>';
	$no++;
    }
		
                  $content .='
                  
                </tbody>
              </table>';


$content .='
</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '

<script type="text/javascript">
  
	function validepopupform2(v_kode_spk, v_id_customer, v_nama_customer, v_id_cabang, v_nama_cabang, v_id_linkbudget, v_paket_koneksi, v_nama_koneksi, v_user_id, v_telpon, v_alamat, v_teknisi_cNama, v_marketing_cNama, v_pekerjaan){
                window.opener.document.'.$return_form.'.kode_spk.value=v_kode_spk;
		window.opener.document.'.$return_form.'.kode_customer.value=v_id_customer;
		window.opener.document.'.$return_form.'.nama_customer.value=v_nama_customer;
		window.opener.document.'.$return_form.'.no_prospek.value=v_id_cabang;
		window.opener.document.'.$return_form.'.cabang.value=v_nama_cabang;
		window.opener.document.'.$return_form.'.no_link_budget.value=v_id_linkbudget;
		window.opener.document.'.$return_form.'.paket_koneksi.value=v_paket_koneksi;
		window.opener.document.'.$return_form.'.nama_koneksi.value=v_nama_koneksi;
		window.opener.document.'.$return_form.'.user_id.value=v_user_id;
		window.opener.document.'.$return_form.'.telpon.value=v_telpon;
		window.opener.document.'.$return_form.'.alamat.value=v_alamat;
		window.opener.document.'.$return_form.'.nama_teknisi.value=v_teknisi_cNama;
		window.opener.document.'.$return_form.'.nama_marketing.value=v_marketing_cNama;
		window.opener.document.'.$return_form.'.pekerjaan.value=v_pekerjaan;
		self.close();
        }
</script>

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

    $title	= 'Data Cabang';
    $submenu	= "cabang";
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