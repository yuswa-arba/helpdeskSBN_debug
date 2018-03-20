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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Ruang");
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
                                    <h2 class="box-title">Data Peminjaman Barang</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
	</form>
		';
		
if(isset($_POST["save_search"])){
	
}else{
 $sql_data	= "SELECT *
			 FROM `gx_pinjam_barang`
			 WHERE `level` =  '0' ORDER BY `id_pinjam` DESC;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Peminjaman Barang</th>
		    <th>Nama Peminjam</th>
			<th>Nama Gudang</th>
			
		    
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_data	= mysql_query($sql_data, $conn);
$no = 1;

  while ($row_data = mysql_fetch_array($query_data)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_data["kode_pinjam"].'</td>
		     <td>'.$row_data["nama_pinjam"].'</td>
			 <td>'.$row_data["nama_gudang"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_data["kode_pinjam"]).'\',';
		       $content .= '\''.mysql_real_escape_string($row_data["nama_pinjam"]).'\',';
			   $content .= '\''.mysql_real_escape_string($row_data["gudang_pinjam"]).'\',';
			   $content .= '\''.mysql_real_escape_string($row_data["nama_gudang"]).'\',';
			   $content .= '\''.mysql_real_escape_string($row_data["keterangan"]).'\',';
			   $content .= '\''.mysql_real_escape_string($row_data["id_pinjam"]).'\')">Select</a>
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
<script type="text/javascript">
  
	function validepopupform2(koder, namar, gudang, namag, ket, idpinjam){
                window.opener.document.'.$return_form.'.kode_pinjam.value=koder;
                window.opener.document.'.$return_form.'.nama_staff.value=namar;
				window.opener.document.'.$return_form.'.gudang_pinjam.value=gudang;
				window.opener.document.'.$return_form.'.nama_gudang.value=namag;
				window.opener.document.'.$return_form.'.keterangan.value=ket;
				window.opener.document.getElementById(\'link_detail\').href  =\'barang_pinjam.php?c=\'+koder;
		self.close();
        }
</script>

    ';
 

    $title	= 'Data Peminjaman Barang';
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