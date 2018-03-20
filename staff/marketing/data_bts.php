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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data BTS");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";

    $content ='<section class="content-header">
                    <h1>
                        Data BTS
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data BTS</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      <tr>
			<td>
			  <label>ID BTS</label>
			</td>
			<td>
			  <input class="form-control" name="id_bts" placeholder="ID BTS" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Nama BTS</label>
			</td>
			<td>
			  <input class="form-control" name="nama_bts" placeholder="Nama BTS" type="text" value="">
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
 
	$id_bts	= isset($_POST['id_bts']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_bts']))) : "";
	$nama_bts	= isset($_POST['nama_bts']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_bts']))) : "";
	
	
	$sql_nama_bts	= ($nama_bts != "") ? "AND `nama_bts` LIKE '".$nama_bts."%'": "";
	
	$sql_bts	= "SELECT * FROM `gx_bts`
	WHERE `id_bts` LIKE '".$id_bts."%'
	$sql_nama_bts
	ORDER BY `id_bts` ASC LIMIT 0,10;";
	
		$content .='<table class="table table-bordered table-striped" id="paket">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>kode BTS</th>
		    <th>Nama BTS</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_bts	= mysql_query($sql_bts, $conn);
$no = 1;

    while ($row_bts = mysql_fetch_array($query_bts)) {
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_bts["kode_bts"].'</td>
                    <td>'.$row_bts["nama_bts"].'</td>
		    
                    <td>
                      <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_bts["kode_bts"]).'\',\''.mysql_real_escape_string($row_bts["nama_bts"]).'\')">Select</a>
                    </td>
                  </tr>';
	$no++;
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

<script type="text/javascript">
  
	function validepopupform2(id_bts_func, nama_bts_func){
		window.opener.document.'.$return_form.'.kode_bts.value=id_bts_func;
		window.opener.document.'.$return_form.'.nama_bts.value=nama_bts_func;
		
		
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

    $title	= 'Data BTS';
    $submenu	= "bts";
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