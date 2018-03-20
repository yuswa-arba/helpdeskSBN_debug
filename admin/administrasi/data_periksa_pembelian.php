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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Permintaan Pembelian");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Periksa Pembelian</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		';
		
if(isset($_POST["save_search"])){
	
}else{
 $sql_permintaan_pembelian	= "SELECT * FROM `gx_periksa_pembelian` WHERE `level` = '0' ORDER BY `id_periksa_pembelian` DESC LIMIT 0,20;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Permintaan Pembelian</th>
		    <th>Tanggal</th>
		    <th>remarks Permintaan Beli</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_permintaan_pembelian	= mysql_query($sql_permintaan_pembelian, $conn);
$no = 1;

 while ($row_permintaan_pembelian = mysql_fetch_array($query_permintaan_pembelian)) {
	
	$tanggal    = date("d");
	
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_permintaan_pembelian["kode_periksa_pembelian"].'</td>
                    <td>'.$row_permintaan_pembelian["tanggal"].'</td>
		    
		    <td>'.$row_permintaan_pembelian["remarks_permintaanbeli"].'</td>
		    <td>
                      <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_permintaan_pembelian["kode_permintaan_pembelian"]).'\',';
		      $content .='\''.mysql_real_escape_string($row_permintaan_pembelian["kode_periksa_pembelian"]).'\',';
		      $content .='\''.mysql_real_escape_string($row_permintaan_pembelian["kode_divisi"]).'\',';
		      $content .='\''.mysql_real_escape_string($row_permintaan_pembelian["nama_divisi"]).'\',';
		      $content .='\''.mysql_real_escape_string($row_permintaan_pembelian["mu"]).'\',';
		      $content .='\''.mysql_real_escape_string($row_permintaan_pembelian["remarks_permintaanbeli"]).'\',';
		      $content .='\''.mysql_real_escape_string($row_permintaan_pembelian["remarks_periksabeli"]).'\')">Select</a>
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

 $plugins .='
 <script type="text/javascript">
   
	 function validepopupform2(v_kodepermintaanbeli, v_periksa, v_kodedivisi, v_namadivisi, v_mu, v_remarks, v_remarks_setuju){
		 window.opener.document.'.$return_form.'.kode_permintaan_pembelian.value=v_kodepermintaanbeli;
		 window.opener.document.'.$return_form.'.kode_periksa_pembelian.value=v_periksa;
		 window.opener.document.'.$return_form.'.kode_divisi.value=v_kodedivisi;
		 window.opener.document.'.$return_form.'.nama_divisi.value=v_namadivisi;
		 window.opener.document.'.$return_form.'.mu.value=v_mu;
		 window.opener.document.'.$return_form.'.remarks_permintaanbeli.value=v_remarks;
		 window.opener.document.'.$return_form.'.remarks_periksabeli.value=v_remarks_setuju;
		 self.close();
	 }
 </script>';


    $title	= 'Data permintaan Pembelian';
    $submenu	= "Pembelian";
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