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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Data Justifikasi");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Justifikasi</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      <tr>
			<td>
			  <label>No Justifikasi</label>
			</td>
			<td>
			  <input class="form-control" name="no_justifikasi" placeholder="No Justifikasi" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>customer_number</label>
			</td>
			<td>
			  <input class="form-control" name="customer_number" placeholder="ID Customer" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Name</label>
			</td>
			<td>
			  <input class="form-control" name="name" placeholder="Name" type="text" value="">
			</td>
		      </tr>
		      
		      <tr>
			<td>
			  <label>Address</label>
			</td>
			<td>
			  <textarea name="address" rows="6" cols="40" style="resize: none;"></textarea>
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Phone</label>
			</td>
			<td>
			  <input class="form-control" name="phone" placeholder="Phone" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Email</label>
			</td>
			<td>
			  <input class="form-control" name="email" placeholder="Email" type="text" value="">
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
	$no_justifikasi= isset($_POST['no_justifikasi']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_justifikasi']))) : "";
	$customer_number= isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
	$name		= isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
	//$title	= isset($_POST['title']) ? mysql_real_escape_string(strip_tags(trim($_POST['title']))) : "";
	$address 	= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$phone	 	= isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
	$email	 	= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	
	$sql_nama	= ($name != "") ? "AND `nama_customer` LIKE '".$name."%'": "";
	$sql_kode	= ($customer_number != "") ? "AND `kode_customer` LIKE '".$customer_number."%'": "";
	$sql_no_justifikasi	= ($no_justifikasi != "") ? "AND `no_justifikasi` LIKE '".$no_justifikasi."%'": "";
	$sql_address	= ($address != "") ? "AND `alamat` LIKE '%".$address."%'": "";
	$sql_email	= ($email != "") ? "AND `email` LIKE '%".$email."%'" : "";
	$sql_phone	= ($phone != "") ? "AND `no_telp` LIKE '%".$phone."%'" : "";
	
	$sql_justifikasi	= "SELECT * FROM `gx_permohonan_justifikasi`
	WHERE `id_cabang` = '".$loggedin['cabang']."' AND  `level` = '0'
	$sql_kode
	$sql_no_justifikasi
	$sql_nama
	$sql_address
	$sql_email
	$sql_phone
	ORDER BY `id_permohonan_justifikasi` DESC LIMIT 0,10;";
}else{
	$sql_justifikasi	= "SELECT * FROM `gx_permohonan_justifikasi`
	WHERE `id_cabang` = '".$loggedin['cabang']."'
	ORDER BY `id_permohonan_justifikasi` DESC LIMIT 0,10;";
}

		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
		    <th>No. justifikasi</th>
		    <th>Name</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_justifikasi	= mysql_query($sql_justifikasi, $conn);
$no = 1;

    while ($row_justifikasi = mysql_fetch_array($query_justifikasi)) {
     
		$content .='<tr>
			   <td>'.$no.'</td>
			   <td>'.$row_justifikasi["no_justifikasi"].'</td>
			   <td>'.$row_justifikasi["nama_customer"].'</td>
			   <td>
			     <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_justifikasi["no_justifikasi"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["kode_customer"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["kode_survey"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["nama_customer"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["longitude"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["latitude"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["tiang_terdekat"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["kode_paket"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["nama_paket"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["kontrak"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["setup_fee_normal"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["abonemen_normal"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["monthly_fee_normal"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["bandwith_normal"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["setup_fee_justifikasi"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["abonemen_justifikasi"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["monthly_fee_justifikasi"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["bandwith_justifikasi"]).'\',';
			     $content .='\''.mysql_real_escape_string($row_justifikasi["remarks"]).'\')">Select</a>
			   </td>
		     </tr>';
		$no++;
    }
		//
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
//
$plugins = '

<script type="text/javascript">
  
	function validepopupform2(nojustifikasi,kodecustomer,kodesurvey,namacustomer,clongitude,clatitude,notiang,nopaket,namapaket,kontrak,setupfeenormal,abonemennormal,monthlyfeenormal,bandwithnormal,setupfeejustifikasi,abonemenjustifikasi,monthlyfeejustifikasi,bandwithjustifikasi, remarksp){
	
		window.opener.document.'.$return_form.'.no_justifikasi.value=nojustifikasi;
		window.opener.document.'.$return_form.'.kode_customer.value=kodecustomer;
		window.opener.document.'.$return_form.'.kode_survey.value=kodesurvey;
		window.opener.document.'.$return_form.'.nama_customer.value=namacustomer;
		window.opener.document.'.$return_form.'.longitude.value=clongitude;
		window.opener.document.'.$return_form.'.latitude.value=clatitude;
		window.opener.document.'.$return_form.'.tiang_terdekat.value=notiang;
		
		window.opener.document.'.$return_form.'.kode_paket.value=nopaket;
		window.opener.document.'.$return_form.'.nama_paket.value=namapaket;
		window.opener.document.'.$return_form.'.kontrak.value=kontrak;
		
		window.opener.document.'.$return_form.'.setup_fee_normal.value=setupfeenormal;
		window.opener.document.'.$return_form.'.abonemen_normal.value=abonemennormal;
		window.opener.document.'.$return_form.'.monthly_fee_normal.value=monthlyfeenormal;
		window.opener.document.'.$return_form.'.bandwith_normal.value=bandwithnormal;
		
		window.opener.document.'.$return_form.'.setup_fee_justifikasi.value=setupfeejustifikasi;
		window.opener.document.'.$return_form.'.abonemen_justifikasi.value=abonemenjustifikasi;
		window.opener.document.'.$return_form.'.monthly_fee_justifikasi.value=monthlyfeejustifikasi;
		window.opener.document.'.$return_form.'.bandwith_justifikasi.value=bandwithjustifikasi;
		
		window.opener.document.'.$return_form.'.remarks_permohonan.value=remarksp;
		
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

    $title	= 'Data Survey';
    $submenu	= "helpdesk";
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