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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Formulir");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Paket</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      <tr>
			<td>
			  <label>Kode Formulir</label>
			</td>
			<td>
			  <input class="form-control" name="kode_formulir" placeholder="Kode Formulir" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Nama Formulir</label>
			</td>
			<td>
			  <input class="form-control" name="nama_formulir" placeholder="Nama Formulir" type="text" value="">
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
 
	$kode_formulir	= isset($_POST['kode_formulir']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_formulir']))) : "";
	$nama_formulir	= isset($_POST['nama_formulir']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_formulir']))) : "";
	
	
	$sql_nama_formulir	= ($nama_formulir != "") ? "AND `nama_formulir` LIKE '".$nama_formulir."%'": "";
	
	$sql_formulir	= "SELECT * FROM `gx_formulir`
	WHERE `kode_formulir` LIKE '".$kode_formulir."%'
	$sql_nama_formulir
	ORDER BY `id_formulir` DESC LIMIT 0,10;";
	
		$content .='<table class="table table-bordered table-striped" id="formulir">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Formulir</th>
		    <th>Nama Formulir</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_formulir	= mysql_query($sql_formulir, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "surat"){
    while ($row_formulir = mysql_fetch_array($query_formulir)) {
    $sql_formulir_detail	= "SELECT * FROM `gx_formulir_detail` WHERE `id_formulir` = '".$row_formulir["id_formulir"]."'
							 ORDER BY `id` DESC LIMIT 0,1;";
	$query_formulir_detail	= mysql_query($sql_formulir_detail, $conn);
	$row_formulir_detail = mysql_fetch_array($query_formulir_detail);
	
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_formulir["kode_formulir"].'</td>
                    <td>'.$row_formulir["nama_formulir"].'</td>
                    <td>
                      <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_formulir["kode_formulir"]).'\', \''.mysql_real_escape_string($row_formulir["nama_formulir"]).'\', \''.mysql_real_escape_string($row_formulir_detail["lokasi_file"]).'\', \''.mysql_real_escape_string($row_formulir_detail["nama_file"]).'\', \''.mysql_real_escape_string($row_formulir_detail["date_add"]).'\', \''.mysql_real_escape_string($row_formulir["exp_date"]).'\', \''.mysql_real_escape_string($row_formulir_detail["jumlah_halaman"]).'\')">Select</a>
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
                $(\'#paket\').dataTable({
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
 if($_GET["f"] == "surat"){
  $plugins .= '
<script type="text/javascript">
  
	function validepopupform2(ckode_formulir, cnama_formulir, clokasi_file, cnama_file, ctanggal, cexp_date, cjumlah_halaman){
		window.opener.document.'.$return_form.'.kode_formulir.value=ckode_formulir;
		window.opener.document.'.$return_form.'.nama_formulir.value=cnama_formulir;
		window.opener.document.'.$return_form.'.lokasi_file.value=clokasi_file;
		window.opener.document.'.$return_form.'.nama_file.value=cnama_file;
		window.opener.document.'.$return_form.'.tanggal_update_terakhir.value=ctanggal;
		window.opener.document.'.$return_form.'.exp_date.value=cexp_date;
		window.opener.document.'.$return_form.'.jumlah_halaman.value=cjumlah_halaman;
		self.close();
        }
</script>
';
 }
}else{
 
}


    $title	= 'Data Formulir';
    $submenu	= "surat";
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