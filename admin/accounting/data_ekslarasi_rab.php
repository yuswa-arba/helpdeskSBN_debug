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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Ekslarasi RAB");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Ekslarasi RAB</h2>
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
 $sql_rab	= "SELECT * FROM `gx_rab_ekslarasi` WHERE `level` = '0' AND `status` = '1' ORDER BY `id_rab_ekslarasi` DESC LIMIT 0,10;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Cabang</th>
		    <th>Kode ekslarasi RAB</th>
		    <th>Tanggal</th>
		    <th>User Add</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_rab	= mysql_query($sql_rab, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "accekslarasi_rab"){
  while ($row_rab = mysql_fetch_array($query_rab)) {
	 $sql_last_data = mysql_fetch_array(mysql_query("SELECT * FROM `gx_rab_ekslarasi` ORDER BY `id_rab_ekslarasi` DESC", $conn));
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_rab["kode_cabang"].'</td>
		     <td>'.$row_rab["kode_rab_ekslarasi"].'</td>
		     <td>'.$row_rab["tanggal"].'</td>
		     <td>'.$row_rab["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_rab["kode_rab_ekslarasi"]).'\', \''.mysql_real_escape_string($row_rab["keterangan"]).'\', \''.mysql_real_escape_string($row_rab["periode"]).'\', \''.mysql_real_escape_string($row_rab["probability_index"]).'\', \''.mysql_real_escape_string($row_rab["target_user_baru"]).'\', \''.mysql_real_escape_string($row_rab["user_add"]).'\')">Select</a>
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
 if($_GET["f"] == "accekslarasi_rab"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(kode_rabekslarasi, ketterangan, perriode, probabilityindex, target_userbaru, pembuatrab){
		 window.opener.document.'.$return_form.'.kode_rab_ekslarasi.value=kode_rabekslarasi;
		 window.opener.document.'.$return_form.'.keterangan.value=ketterangan;
		 window.opener.document.'.$return_form.'.periode.value=perriode;
		 window.opener.document.'.$return_form.'.probability_index.value=probabilityindex;
		 window.opener.document.'.$return_form.'.target_user_baru.value=target_userbaru;
		 window.opener.document.'.$return_form.'.pembuat_rab.value=pembuatrab;
		 self.close();
	 }
 </script>
 
     ';
 }
}else{

}


    $title	= 'Data Ekslarasi RAB';
    $submenu	= "ekslarasi_rab";
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