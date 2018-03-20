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
    $f			= isset($_GET['f']) ? mysql_real_escape_string(strip_tags(trim($_GET['f']))) : "";
  
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Satuan</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
	</form>
		';
		
if(isset($_POST["save_search"])){
	
}else{
 $sql_data	= "SELECT * FROM `gx_pegawai` WHERE `level` = '0' ORDER BY `id_employee` ASC;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Staff</th>
		    <th>Nama</th>
			<th>Jabatan</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_data	= mysql_query($sql_data, $conn);
$no = 1;

  while ($row_data = mysql_fetch_array($query_data)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_data["kode_pegawai"].'</td>
		     <td>'.$row_data["nama"].'</td>
			 <td>'.$row_data["jabatan"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_data["id_employee"]).'\',';
			   $content .= '\''.mysql_real_escape_string($row_data["nama"]).'\')">Select</a>
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

$plugins = '';

 $plugins .= '
<script type="text/javascript">
  
	function validepopupform2(id, nama){
                window.opener.document.'.$return_form.'.id_staff.value=id;
				window.opener.document.'.$return_form.'.nama_staff.value=nama;
                self.close();
        }
</script>

    ';
    $title	= 'Data Satuan';
    $submenu	= "master_satuan";
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