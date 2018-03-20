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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Shipping");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Shipping</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		';
		
if(isset($_POST["save_search"])){
	
}else{
 $sql_data	= "SELECT * FROM `gx_shipping` WHERE `level` = '0' ORDER BY `id_shipping` DESC LIMIT 0,20;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Shipping</th>
		    <th>Nama Shipping</th>
		    <th>Alamat</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_data	= mysql_query($sql_data, $conn);
$no = 1;

 while ($row_data = mysql_fetch_array($query_data)) {
	
	$tanggal    = date("d");
	
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_data["kode_shipping"].'</td>
                    <td>'.$row_data["nama_shipping"].'</td>
		    
		    <td>'.$row_data["alamat"].'</td>
		    <td>
                      <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_data["kode_shipping"]).'\', \''.mysql_real_escape_string($row_data["nama_shipping"]).'\')">Select</a>
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
   
	 function validepopupform2(v_kode, v_nama){
		 window.opener.document.'.$return_form.'.kode_shipping.value=v_kode;
		 window.opener.document.'.$return_form.'.nama_shipping.value=v_nama;
		 self.close();
	 }
 </script>';


    $title	= 'Data Supplier';
    $submenu	= "";
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