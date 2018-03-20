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
                        Data Formulir
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Formulir</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <!--<form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      <tr>
			<td>
			  <label>Kode Brosur</label>
			</td>
			<td>
			  <input class="form-control" name="kode_brosur" placeholder="ID Paket" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Nama Brosur</label>
			</td>
			<td>
			  <input class="form-control" name="nama_brosur" placeholder="Nama Brosur" type="text" value="">
			</td>
		      </tr>
		      
		      <tr>
			<td>&nbsp;</td>
			<td>
			  <input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
			</td>
		      </tr>
		</table>
		</form>-->';
		
if(isset($_POST["save_search"])){
 
	$kode_brosur	= isset($_POST['kode_brosur']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_brosur']))) : "";
	$nama_brosur	= isset($_POST['nama_brosur']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_brosur']))) : "";
	
	
	$sql_nama_brosur= ($nama_brosur != "") ? "AND `nama_brosur` LIKE '".$nama_brosur."%'": "";
	
	$sql_brosur	= "SELECT * FROM `gx_brosur`
	WHERE `kode_brosur` LIKE '".$kode_brosur."%'
	$sql_nama_brosur
	ORDER BY `id_brosur` ASC LIMIT 0,10;";
	
		$content .='<table class="table table-bordered table-striped" id="paket">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Brosur</th>
		    <th>Nama Brosur</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_brosur	= mysql_query($sql_brosur, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "penawaran"){
  while ($row_brosur = mysql_fetch_array($query_brosur)) {
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_brosur["kode_brosur"].'</td>
                    <td>'.$row_brosur["nama_brosur"].'</td>
		    
                    <td>
                      <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_brosur["kode_brosur"]).'\',\''.mysql_real_escape_string($row_brosur["nama_brosur"]).'\')">Select</a>
                    </td>
                  </tr>';
	$no++;
    }
 }
}else{
	 while ($row_brosur = mysql_fetch_array($query_brosur)) {
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_brosur["kode_brosur"].'</td>
                    <td>'.$row_brosur["nama_brosur"].'</td>
		    
                    <td>
                      <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_brosur["id_paket"]).'\',\''.mysql_real_escape_string($row_brosur["nama_brosur"]).'\')">Select</a>
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
  
	function validepopupform2(kode_brosur_func, nama_brosur_func){
		window.opener.document.'.$return_form.'.kode_brosur.value=kode_brosur_func;
		
		
                self.close();
        }
</script>';
 }
}else{
 $plugins .= '

<script type="text/javascript">
  
	function validepopupform2(kode_brosur_func, nama_brosur_func){
		window.opener.document.'.$return_form.'.kode_brosur.value=kode_brosur_func;
		
		
                self.close();
        }
</script>';
}

    $title	= 'Data Brosur';
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