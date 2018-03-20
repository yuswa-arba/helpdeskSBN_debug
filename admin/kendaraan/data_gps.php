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
  
    $content = '<section class="content-header">
                    <h1>
                        Data GPS
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data GPS</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      <tr>
			<td>
			  <label>Kode GPS</label>
			</td>
			<td>
			  <input class="form-control" name="kode_gps" placeholder="Kode GPS" type="text" value="">
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
 $sql_gps	= "SELECT * FROM `gx_kendaraan_gps` WHERE `level`='0' AND `kode_gps` LIKE '%".mysql_real_escape_string($_POST['kode_gps'])."%' ORDER BY `id` ASC LIMIT 0,10;";
}else{
 $sql_gps	= "SELECT * FROM `gx_kendaraan_gps` WHERE `level`='0' ORDER BY `kode_gps` ASC LIMIT 0,10;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode GPS</th>
		    <th>Nama GPS</th>
		    <th>Date Add</th>
		    <th>User Add</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_gps	= mysql_query($sql_gps, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "data_gps"){
  while ($row_gps = mysql_fetch_array($query_gps)) {
	 $kode_gps = $row_gps["kode_gps"];
	 $nama_gps = $row_gps["nama_gps"];
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_gps["kode_gps"].'</td>
		     <td>'.$row_gps["nama_gps"].'</td>
		     <td>'.$row_gps["date_add"].'</td>
		     <td>'.$row_gps["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($kode_gps).'\', \''.mysql_real_escape_string($nama_gps).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }
  
}else{
   $content .= '';
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
 if($_GET["f"] == "data_gps"){
  $plugins .= '
 <script type="text/javascript">
	 function validepopupform2(kg){
		 window.opener.document.'.$return_form.'.kode_gps.value=kg;
		 
		 self.close();
	 }
 </script>';
 }
//window.opener.document.'.$return_form.'.nama_gps.value=ng;
}else{
 $plugins .= '';
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