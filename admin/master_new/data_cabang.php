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
 if($_GET["f"] == "aktivasi"){
  while ($row_cabang = mysql_fetch_array($query_cabang)) {
	 $sql_last_aktivasi = mysql_fetch_array(mysql_query("SELECT * FROM `gx_aktivasi` ORDER BY `id_aktivasi` DESC", $conn));
	 $last_data  = $sql_last_aktivasi["id_aktivasi"] + 1;
	 $tanggal    = date("d");
	 $kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_spk_aktivasi"].''.$tanggal.''.sprintf("%04d", $last_data);
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_cabang["kode_cabang"].'</td>
		     <td>'.$row_cabang["nama_cabang"].'</td>
		     <td>'.$row_cabang["date_add"].'</td>
		     <td>'.$row_cabang["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.$kode_cabang.'\', \''.$row_cabang["id_cabang"].'\', \''.$row_cabang["nama_cabang"].'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }elseif($_GET["f"] == "survey"){
  while ($row_cabang = mysql_fetch_array($query_cabang)) {
	 $sql_last_survey = mysql_fetch_array(mysql_query("SELECT * FROM `gx_survey` ORDER BY `id_survey` DESC", $conn));
	 $last_data  = $sql_last_survey["id_survey"] + 1;
	 $tanggal    = date("d");
	 $kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_spk_survey"].''.$tanggal.''.sprintf("%04d", $last_data);
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_cabang["kode_cabang"].'</td>
		     <td>'.$row_cabang["nama_cabang"].'</td>
		     <td>'.$row_cabang["date_add"].'</td>
		     <td>'.$row_cabang["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.$kode_cabang.'\', \''.$row_cabang["id_cabang"].'\', \''.$row_cabang["nama_cabang"].'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }elseif($_GET["f"] == "jawabsurvey"){
  while ($row_cabang = mysql_fetch_array($query_cabang)) {
	 $sql_last_jawab  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spksurvey` ORDER BY `id_jawab_spksurvey` DESC", $conn));
	 $last_data  = $sql_last_jawab["id_jawab_spksurvey"] + 1;
	 $tanggal    = date("d");
	 $kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_jawab_survey"].''.$tanggal.''.sprintf("%04d", $last_data);
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_cabang["kode_cabang"].'</td>
		     <td>'.$row_cabang["nama_cabang"].'</td>
		     <td>'.$row_cabang["date_add"].'</td>
		     <td>'.$row_cabang["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.$kode_cabang.'\', \''.$row_cabang["id_cabang"].'\', \''.$row_cabang["nama_cabang"].'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }elseif($_GET["f"] == "ctrljustifikasi"){
  while ($row_cabang = mysql_fetch_array($query_cabang)) {
	 $sql_controljust  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_control_justifikasi` ORDER BY `id_control_justifikasi` DESC", $conn));
	 $last_data  = $sql_controljust["id_control_justifikasi"] + 1;
	 $tanggal    = date("d");
	 $kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_justifikasi"].''.$tanggal.''.sprintf("%04d", $last_data);
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_cabang["kode_cabang"].'</td>
		     <td>'.$row_cabang["nama_cabang"].'</td>
		     <td>'.$row_cabang["date_add"].'</td>
		     <td>'.$row_cabang["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.$kode_cabang.'\', \''.$row_cabang["id_cabang"].'\', \''.$row_cabang["nama_cabang"].'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }elseif($_GET["f"] == "persetujuanjustifikasi"){
  while ($row_cabang = mysql_fetch_array($query_cabang)) {
	 $sql_perseetujuanjust  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_persetujuan_justifikasi` ORDER BY `id_persetujuan_justifikasi` DESC", $conn));
	 $last_data  = $sql_perseetujuanjust["id_persetujuan_justifikasi"] + 1;   
	 $tanggal    = date("d");
	 $kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_acc_justifikasi"].''.$tanggal.''.sprintf("%04d", $last_data);
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_cabang["kode_cabang"].'</td>
		     <td>'.$row_cabang["nama_cabang"].'</td>
		     <td>'.$row_cabang["date_add"].'</td>
		     <td>'.$row_cabang["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.$kode_cabang.'\', \''.$row_cabang["id_cabang"].'\', \''.$row_cabang["nama_cabang"].'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }elseif($_GET["f"] == "linkbudget"){
  while ($row_cabang = mysql_fetch_array($query_cabang)) {
	 $sql_last_link  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_link_budget` ORDER BY `id_link_budget` DESC", $conn));
	 $last_data  = $sql_last_link["id_link_budget"] + 1;
	 $tanggal    = date("d");
	 $kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_link_budget"].''.$tanggal.''.sprintf("%04d", $last_data);
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_cabang["kode_cabang"].'</td>
		     <td>'.$row_cabang["nama_cabang"].'</td>
		     <td>'.$row_cabang["date_add"].'</td>
		     <td>'.$row_cabang["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.$kode_cabang.'\', \''.$row_cabang["id_cabang"].'\', \''.$row_cabang["nama_cabang"].'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }elseif($_GET["f"] == "permohonanjustifikasi"){
  while ($row_cabang = mysql_fetch_array($query_cabang)) {
	 $sql_permohonanjustifikasi  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_permohonan_justifikasi` ORDER BY `id_permohonan_justifikasi` DESC", $conn));
	 $last_data  = $sql_permohonanjustifikasi["id_permohonan_justifikasi"] + 1;
	 $tanggal    = date("d");
	 $kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_justifikasi"].''.$tanggal.''.sprintf("%04d", $last_data);
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_cabang["kode_cabang"].'</td>
		     <td>'.$row_cabang["nama_cabang"].'</td>
		     <td>'.$row_cabang["date_add"].'</td>
		     <td>'.$row_cabang["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.$kode_cabang.'\', \''.$row_cabang["id_cabang"].'\', \''.$row_cabang["nama_cabang"].'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }elseif($_GET["f"] == "spkpasangbaru"){
  while ($row_cabang = mysql_fetch_array($query_cabang)) {
	 $sql_spkpasang  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_spk_pasang` ORDER BY `id_spkpasang` DESC", $conn));
	 $last_data  = $sql_spkpasang["id_spkpasang"] + 1;
	 $tanggal    = date("d");
	 $kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_spk_pasang"].''.$tanggal.''.sprintf("%04d", $last_data);
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_cabang["kode_cabang"].'</td>
		     <td>'.$row_cabang["nama_cabang"].'</td>
		     <td>'.$row_cabang["date_add"].'</td>
		     <td>'.$row_cabang["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.$kode_cabang.'\', \''.$row_cabang["id_cabang"].'\', \''.$row_cabang["nama_cabang"].'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }
}else{
    while ($row_cabang = mysql_fetch_array($query_cabang)) {
	$sql_last_prospek  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_prospek` ORDER BY `id_prospek` DESC", $conn));
	$last_data  = $sql_last_prospek["id_prospek"] + 1;
	$tanggal    = date("d");
	$kode_cabang = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_prospek"].''.$tanggal.''.sprintf("%04d", $last_data);
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_cabang["kode_cabang"].'</td>
                    <td>'.$row_cabang["nama_cabang"].'</td>
		    <td>'.$row_cabang["date_add"].'</td>
		    <td>'.$row_cabang["user_add"].'</td>
                    <td>
                      <a href="" onclick="validepopupform2(\''.$kode_cabang.'\', \''.$row_cabang["nama_cabang"].'\')">Select</a>
                    </td>
                  </tr>';
	$no++;
    }
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
if(isset($_GET["f"]) == "aktivasi"){
 if($_GET["f"] == "aktivasi"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(noaktivasi, idcabang, namacabang){
		 window.opener.document.'.$return_form.'.kode_aktivasi.value=noaktivasi;
		 window.opener.document.'.$return_form.'.id_cabang.value=idcabang;
		 window.opener.document.'.$return_form.'.nama_cabang.value=namacabang;
		 
		 self.close();
	 }
 </script>
 
     ';
 }elseif($_GET["f"] == "survey"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(nosurvey,idcabang, namacabang){
		 window.opener.document.'.$return_form.'.no_survey.value=nosurvey;
		 window.opener.document.'.$return_form.'.cabang.value=idcabang;
		 window.opener.document.'.$return_form.'.nama_cabang.value=namacabang;
		 
		 self.close();
	 }
 </script>
 
     ';
 }elseif($_GET["f"] == "jawabsurvey"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(nojawabsurvey,idcabang, namacabang){
		 window.opener.document.'.$return_form.'.no_jawab.value=nojawabsurvey;
		 window.opener.document.'.$return_form.'.cabang.value=idcabang;
		 window.opener.document.'.$return_form.'.nama_cabang.value=namacabang;
		 
		 self.close();
	 }
 </script>
 
     ';
 }elseif($_GET["f"] == "ctrljustifikasi"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(noctrljustifikasi,idcabang, namacabang){
		 window.opener.document.'.$return_form.'.no_control_justifikasi.value=noctrljustifikasi;
		 window.opener.document.'.$return_form.'.cabang.value=idcabang;
		 window.opener.document.'.$return_form.'.nama_cabang.value=namacabang;
		 
		 self.close();
	 }
 </script>
 
     ';
 }elseif($_GET["f"] == "persetujuanjustifikasi"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(persetujuanjustifikasi,idcabang, namacabang){
		 window.opener.document.'.$return_form.'.no_persetujuan_justifikasi.value=persetujuanjustifikasi;
		 window.opener.document.'.$return_form.'.cabang.value=idcabang;
		 window.opener.document.'.$return_form.'.nama_cabang.value=namacabang;
		 
		 self.close();
	 }
 </script>
 
     ';
 }elseif($_GET["f"] == "linkbudget"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(nolinkbudget,idcabang, namacabang){
		 window.opener.document.'.$return_form.'.link.value=nolinkbudget;
		 window.opener.document.'.$return_form.'.cabang.value=idcabang;
		 window.opener.document.'.$return_form.'.nama_cabang.value=namacabang;
		 
		 self.close();
	 }
 </script>
 
     ';
 }elseif($_GET["f"] == "permohonanjustifikasi"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(cpermohonanjustifikasi,idcabang, namacabang){
		 window.opener.document.'.$return_form.'.troubleticket.value=cpermohonanjustifikasi;
		 window.opener.document.'.$return_form.'.cabang.value=idcabang;
		 window.opener.document.'.$return_form.'.nama_cabang.value=namacabang;
		 
		 self.close();
	 }
 </script>
 
     ';
 }elseif($_GET["f"] == "spkpasangbaru"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(kodespk,idcabang, namacabang){
		 window.opener.document.'.$return_form.'.kode_spk.value=kodespk;
		 window.opener.document.'.$return_form.'.cabang.value=idcabang;
		 window.opener.document.'.$return_form.'.namecabang.value=namacabang;
		 
		 self.close();
	 }
 </script>
 
     ';
 }
}else{
 $plugins .= '
<script type="text/javascript">
  
	function validepopupform2(kodecabang, namacabang){
                window.opener.document.'.$return_form.'.no_prospek.value=kodecabang;
		window.opener.document.'.$return_form.'.cabang.value=namacabang;
		
                self.close();
        }
</script>

    ';
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