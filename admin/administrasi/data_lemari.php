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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Lemari");
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
                                    <h2 class="box-title">Data Lemari</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
	</form>
		';
		
if(isset($_POST["save_search"])){
	
}else{
 /*
 $sql_data	= "SELECT `gx_lemari`.*, `gx_cabang`.`id_cabang`, `gx_cabang`.`nama_cabang`
			 FROM `gx_lemari`, `gx_cabang`
			 WHERE `gx_lemari`.`id_cabang` = `gx_cabang`.`id_cabang`
			 AND `gx_lemari`.`level` =  '0' ORDER BY `gx_lemari`.`id_lemari` DESC;";
*/
 $sql_data = "SELECT `id_lemari`, `kode_lemari`, `nama_lemari`, `kode_lemari`, `nama_lemari`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_lemari` ";

 
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Lemari</th>
		    <th>Nama Lemari</th>
		    <th>Kode Ruang</th>
		    <th>Nama Ruang</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_data	= mysql_query($sql_data, $conn);
$no = 1;

  while ($row_data = mysql_fetch_array($query_data)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_data["kode_lemari"].'</td>
		     <td>'.$row_data["nama_lemari"].'</td>
		     <td>'.$row_data["kode_lemari"].'</td>
		     <td>'.$row_data["nama_lemari"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_data["kode_lemari"]).'\',';
		       $content .= '\''.mysql_real_escape_string($row_data["nama_lemari"]).'\')">Select</a>
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
if($f == "lemari"){
 $plugins = '
<script type="text/javascript">
  
	function validepopupform2(koder, namar){
                window.opener.document.'.$return_form.'.kode_lemari.value=koder;
                window.opener.document.'.$return_form.'.nama_lemari.value=namar;
		self.close();
        }
</script>

    ';

}elseif($f == "Lemariakhir"){
$plugins = '
<script type="text/javascript">
  
	function validepopupform2(koder, namar){
                window.opener.document.'.$return_form.'.kode_lemari_akhir.value=koder;
                window.opener.document.'.$return_form.'.nama_lemari_akhir.value=namar;
		self.close();
        }
</script>

    ';
    
}elseif($f == "penjualan_barang"){
$plugins = '
<script type="text/javascript">
  
	function validepopupform2(koder, namar){
                window.opener.document.'.$return_form.'.kode_lemari.value=koder;
                window.opener.document.'.$return_form.'.nama_lemari.value=namar;
		self.close();
        }
</script>

    ';
    
}else{
 $plugins = '
<script type="text/javascript">
  
	function validepopupform2(koder, namar){
                window.opener.document.'.$return_form.'.kode_lemari.value=koder;
                window.opener.document.'.$return_form.'.nama_lemari.value=namar;
		self.close();
        }
</script>

    ';
 
}
    $title	= 'Data Satuan';
    $submenu	= "master_lemari";
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