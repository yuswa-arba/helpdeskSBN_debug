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
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
	
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Paket");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";

    $content ='<section class="content-header">
                    <h1>
                        Data Paket
                        
                    </h1>
                    
                </section>

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
			  <label>Kode Paket</label>
			</td>
			<td>
			  <input class="form-control" name="kode_paket" placeholder="Kode Paket" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Nama Paket</label>
			</td>
			<td>
			  <input class="form-control" name="nama_paket" placeholder="Nama Paket" type="text" value="">
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
 
	$kode_paket	= isset($_POST['kode_paket']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_paket']))) : "";
	$nama_paket	= isset($_POST['nama_paket']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_paket']))) : "";
	
	$sql_kode_paket	= ($kode_paket != "") ? "AND `kode_paket` LIKE '%".$kode_paket."%'": "";
	$sql_nama_paket	= ($nama_paket != "") ? "AND `nama_paket` LIKE '%".$nama_paket."%'": "";
	
	$sql_paket	= "SELECT * FROM `gx_paket2`
	WHERE  `level` = '0'
	$sql_kode_paket  
	$sql_nama_paket  
	ORDER BY `id_paket` ASC ;";
	
		$content .='<table class="table table-bordered table-striped" id="paket">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>ID Paket</th>
		    <th>Nama Paket</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_paket	= mysql_query($sql_paket, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "penawaran"){
  while ($row_paket = mysql_fetch_array($query_paket)) {
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_paket["kode_paket"].'</td>
                    <td>'.$row_paket["nama_paket"].'</td>
		    
                    <td>
                      <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_paket["id_paket"]).'\',\''.mysql_real_escape_string($row_paket["nama_paket"]).'\',\''.mysql_real_escape_string($row_paket["setup_fee"]).'\',\''.mysql_real_escape_string($row_paket["abonemen_voip"]).'\',\''.mysql_real_escape_string($row_paket["monthly_fee"]).'\')">Select</a>
                    </td>
                  </tr>';
	$no++;
    }
 }elseif($_GET["f"] == "jawabsurvey"){
  while ($row_paket = mysql_fetch_array($query_paket)) {
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_paket["kode_paket"].'</td>
                    <td>'.$row_paket["nama_paket"].'</td>
		    
                    <td>
                      <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_paket["id_paket"]).'\',\''.mysql_real_escape_string($row_paket["nama_paket"]).'\')">Select</a>
                    </td>
                  </tr>';
	$no++;
    }
 }
}else{
	 while ($row_paket = mysql_fetch_array($query_paket)) {
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_paket["kode_paket"].'</td>
                    <td>'.$row_paket["nama_paket"].'</td>
		    
                    <td>
                      <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_paket["id_paket"]).'\',\''.mysql_real_escape_string($row_paket["nama_paket"]).'\')">Select</a>
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


$plugins ='

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
 if($_GET["f"] == "penawaran"){
  $plugins .= '

<script type="text/javascript">
  
	function validepopupform2(id_paket_func, nama_paket_func,setup_fee_func, abonemen_func,monthly_fee_func){
		window.opener.document.'.$return_form.'.kode_paket.value=id_paket_func;
		window.opener.document.'.$return_form.'.nama_paket.value=nama_paket_func;
		window.opener.document.'.$return_form.'.setup_fee.value=setup_fee_func;
		window.opener.document.'.$return_form.'.abonemen.value=abonemen_func;
		window.opener.document.'.$return_form.'.monthly_fee.value=monthly_fee_func;
		
		
                self.close();
        }
</script>';
 }elseif($_GET["f"] == "jawabsurvey"){
  $plugins .= '

<script type="text/javascript">
  
	function validepopupform2(id_paket_func, nama_paket_func,setup_fee_func, abonemen_func,monthly_fee_func){
		window.opener.document.'.$return_form.'.kode_paket.value=id_paket_func;
		window.opener.document.'.$return_form.'.nama_paket.value=nama_paket_func;
		
		
                self.close();
        }
</script>';
 }
}else{
 $plugins .= '

<script type="text/javascript">
  
	function validepopupform2(id_paket_func, nama_paket_func){
		window.opener.document.'.$return_form.'.kode_paket.value=id_paket_func;
		window.opener.document.'.$return_form.'.nama_paket.value=nama_paket_func;
		
		
                self.close();
        }
</script>';
}

    $title	= 'Data Paket';
    $submenu	= "helpdesk";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>