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
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data Cabang
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Cabang</h2>
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
 $sql_cabang	= "SELECT * FROM `gx_cabang` WHERE `level` = '0' ORDER BY `id_cabang` ASC LIMIT 0,10;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Cabang</th>
		    <th>nama Cabang</th>
		    <th>Date Add</th>
		    <th>User Add</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_cabang	= mysql_query($sql_cabang, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "add_on"){
  while ($row_cabang = mysql_fetch_array($query_cabang)) {
	 $sql_last_data = mysql_fetch_array(mysql_query("SELECT * FROM `gx_add_on` ORDER BY `id_add_on` DESC", $conn));
	 $last_data  = $sql_last_data["id_add_on"] + 1;
	 $tanggal    = date("d");
	 $kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_add_on"].''.$tanggal.''.sprintf("%04d", $last_data);
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_cabang["kode_cabang"].'</td>
		     <td>'.$row_cabang["nama_cabang"].'</td>
		     <td>'.$row_cabang["date_add"].'</td>
		     <td>'.$row_cabang["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($kode_cabang).'\', \''.mysql_real_escape_string($row_cabang["id_cabang"]).'\', \''.mysql_real_escape_string($row_cabang["nama_cabang"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }elseif($_GET["f"] == "spk_pasang_add_on"){
  while ($row_cabang = mysql_fetch_array($query_cabang)) {
	 $sql_last_data = mysql_fetch_array(mysql_query("SELECT * FROM `gx_spk_pasang_add_on` ORDER BY `id_spk_pasang_add_on` DESC", $conn));
	 $last_data  = $sql_last_data["id_spk_pasang_add_on"] + 1;
	 $tanggal    = date("d");
	 $kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_spk_pasang_add_on"].''.$tanggal.''.sprintf("%04d", $last_data);
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_cabang["kode_cabang"].'</td>
		     <td>'.$row_cabang["nama_cabang"].'</td>
		     <td>'.$row_cabang["date_add"].'</td>
		     <td>'.$row_cabang["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($kode_cabang).'\', \''.mysql_real_escape_string($row_cabang["id_cabang"]).'\', \''.mysql_real_escape_string($row_cabang["nama_cabang"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }elseif($_GET["f"] == "jawab_spk_pasang_add_on"){
  while ($row_cabang = mysql_fetch_array($query_cabang)) {
	 $sql_last_data = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spk_pasang_add_on` ORDER BY `id_jawab_spk_pasang_add_on` DESC", $conn));
	 $last_data  = $sql_last_data["id_jawab_spk_pasang_add_on"] + 1;
	 $tanggal    = date("d");
	 $kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_jawab_spk_pasang_add_on"].''.$tanggal.''.sprintf("%04d", $last_data);
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_cabang["kode_cabang"].'</td>
		     <td>'.$row_cabang["nama_cabang"].'</td>
		     <td>'.$row_cabang["date_add"].'</td>
		     <td>'.$row_cabang["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($kode_cabang).'\', \''.mysql_real_escape_string($row_cabang["id_cabang"]).'\', \''.mysql_real_escape_string($row_cabang["nama_cabang"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }elseif($_GET["f"] == "spk_aktivasi_add_on"){
  while ($row_cabang = mysql_fetch_array($query_cabang)) {
	 $sql_last_data = mysql_fetch_array(mysql_query("SELECT * FROM `gx_spk_aktivasi_add_on` ORDER BY `id_spk_aktivasi_add_on` DESC", $conn));
	 $last_data  = $sql_last_data["id_spk_aktivasi_add_on"] + 1;
	 $tanggal    = date("d");
	 $kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_spk_aktivasi_add_on"].''.$tanggal.''.sprintf("%04d", $last_data);
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_cabang["kode_cabang"].'</td>
		     <td>'.$row_cabang["nama_cabang"].'</td>
		     <td>'.$row_cabang["date_add"].'</td>
		     <td>'.$row_cabang["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($kode_cabang).'\', \''.mysql_real_escape_string($row_cabang["id_cabang"]).'\', \''.mysql_real_escape_string($row_cabang["nama_cabang"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }elseif($_GET["f"] == "jawab_spk_aktivasi_add_on"){
  while ($row_cabang = mysql_fetch_array($query_cabang)) {
	 $sql_last_data = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spk_aktivasi_add_on` ORDER BY `id_jawab_spk_aktivasi_add_on` DESC", $conn));
	 $last_data  = $sql_last_data["id_jawab_spk_aktivasi_add_on"] + 1;
	 $tanggal    = date("d");
	 $kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_jawab_spk_aktivasi_add_on"].''.$tanggal.''.sprintf("%04d", $last_data);
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_cabang["kode_cabang"].'</td>
		     <td>'.$row_cabang["nama_cabang"].'</td>
		     <td>'.$row_cabang["date_add"].'</td>
		     <td>'.$row_cabang["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($kode_cabang).'\', \''.mysql_real_escape_string($row_cabang["id_cabang"]).'\', \''.mysql_real_escape_string($row_cabang["nama_cabang"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }elseif($_GET["f"] == "aktivasi_add_on"){
  while ($row_cabang = mysql_fetch_array($query_cabang)) {
	 $sql_last_data = mysql_fetch_array(mysql_query("SELECT * FROM `gx_aktivasi_add_on` ORDER BY `id_aktivasi_add_on` DESC", $conn));
	 $last_data  = $sql_last_data["id_aktivasi_add_on"] + 1;
	 $tanggal    = date("d");
	 $kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_aktivasi_add_on"].''.$tanggal.''.sprintf("%04d", $last_data);
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_cabang["kode_cabang"].'</td>
		     <td>'.$row_cabang["nama_cabang"].'</td>
		     <td>'.$row_cabang["date_add"].'</td>
		     <td>'.$row_cabang["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($kode_cabang).'\', \''.mysql_real_escape_string($row_cabang["id_cabang"]).'\', \''.mysql_real_escape_string($row_cabang["nama_cabang"]).'\')">Select</a>
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
 if($_GET["f"] == "add_on"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(kodeaddon, idcabang, namacabang){
		 window.opener.document.'.$return_form.'.kode_add_on.value=kodeaddon;
		 window.opener.document.'.$return_form.'.kode_cabang.value=idcabang;
		 window.opener.document.'.$return_form.'.nama_cabang.value=namacabang;
		 
		 self.close();
	 }
 </script>
 
     ';
 }elseif($_GET["f"] == "spk_pasang_add_on"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(kodeaddon, idcabang, namacabang){
		 window.opener.document.'.$return_form.'.kode_spk_pasang_add_on.value=kodeaddon;
		 window.opener.document.'.$return_form.'.kode_cabang.value=idcabang;
		 window.opener.document.'.$return_form.'.nama_cabang.value=namacabang;
		 
		 self.close();
	 }
 </script>
 
     ';
 }elseif($_GET["f"] == "jawab_spk_pasang_add_on"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(kodeaddon, idcabang, namacabang){
		 window.opener.document.'.$return_form.'.kode_jawab_spk_pasang_add_on.value=kodeaddon;
		 window.opener.document.'.$return_form.'.kode_cabang.value=idcabang;
		 window.opener.document.'.$return_form.'.nama_cabang.value=namacabang;
		 
		 self.close();
	 }
 </script>
 
     ';
 }elseif($_GET["f"] == "spk_aktivasi_add_on"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(kodeaddon, idcabang, namacabang){
		 window.opener.document.'.$return_form.'.kode_spk_aktivasi_add_on.value=kodeaddon;
		 window.opener.document.'.$return_form.'.kode_cabang.value=idcabang;
		 window.opener.document.'.$return_form.'.nama_cabang.value=namacabang;
		 
		 self.close();
	 }
 </script>
 
     ';
 }elseif($_GET["f"] == "jawab_spk_aktivasi_add_on"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(kodeaddon, idcabang, namacabang){
		 window.opener.document.'.$return_form.'.kode_jawab_spk_aktivasi_add_on.value=kodeaddon;
		 window.opener.document.'.$return_form.'.kode_cabang.value=idcabang;
		 window.opener.document.'.$return_form.'.nama_cabang.value=namacabang;
		 
		 self.close();
	 }
 </script>
 
     ';
 }elseif($_GET["f"] == "aktivasi_add_on"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(kodeaddon, idcabang, namacabang){
		 window.opener.document.'.$return_form.'.kode_aktivasi_add_on.value=kodeaddon;
		 window.opener.document.'.$return_form.'.kode_cabang.value=idcabang;
		 window.opener.document.'.$return_form.'.nama_cabang.value=namacabang;
		 
		 self.close();
	 }
 </script>
 
     ';
 }
}else{

}


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