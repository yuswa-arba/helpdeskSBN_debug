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
include ("../../config/configuration_voip_bali.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Cust");
    global $conn;
    global $conn_voip;
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Staff</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      <tr>
			<td>
			  <label>Kode Pegawai *</label>
			</td>
			<td>
			  <input class="form-control" name="kode_pegawai" placeholder="User ID" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Nama</label>
			</td>
			<td>
			  <input class="form-control" name="nama" placeholder="Name" type="text" value="">
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
	$kode_pegawai	= isset($_POST['kode_pegawai']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_pegawai']))) : "";
	$nama		= isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
	
	
	$sql_nama	= ($nama != "") ? "AND `nama` LIKE '".$nama."%'": "";
	
	$sql_data	= "SELECT * FROM `gx_pegawai`
	WHERE `kode_pegawai` LIKE '".$kode_pegawai."%'
	$sql_nama
	
	ORDER BY `nama` ASC LIMIT 0,10;";
	
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Pegawai</th>
		    <th>Nama</th>
		    <th>Alamat</th>
		    <th>Bagian</th>
		    
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
		    <td>'.$row_data["alamat"].'</td>
		    <td>'.$row_data["id_bagian"].'</td>
		    
                    <td>
                      <a href="" onclick="validepopupform2(\''.$row_data["kode_pegawai"].'\',\''.$row_data["nama"].'\',\''.$row_data["alamat"].'\',\'\',\'\',\'\',\''.$row_data["hp"].'\',\''.$row_data["email"].'\',\'\')">Select</a>
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
  
	function validepopupform2(custNumber, nama, alamat, namaperusahaan, kota, fax, ctelp, cemail, con_type){
		
                window.opener.document.'.$return_form.'.customer_number.value=custNumber;
		window.opener.document.'.$return_form.'.firstname.value=nama;
		window.opener.document.'.$return_form.'.company_name.value=namaperusahaan;
		window.opener.document.'.$return_form.'.city.value=kota;
		window.opener.document.'.$return_form.'.fax.value=fax;
		window.opener.document.'.$return_form.'.address.value=alamat;
		window.opener.document.'.$return_form.'.phone.value=ctelp;
		window.opener.document.'.$return_form.'.email.value=cemail;
		
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

    $title	= 'Data Pegawai';
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