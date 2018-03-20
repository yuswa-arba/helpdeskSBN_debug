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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Control Justifikasi");
    global $conn;
    global $conn_voip;
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data Control Justifikasi
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Control Justifikasi</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      <tr>
			<td>
			  <label>No Control Justifikasi</label>
			</td>
			<td>
			  <input class="form-control" name="no_control" placeholder="No Control Justifikasi" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>customer_number</label>
			</td>
			<td>
			  <input class="form-control" name="customer_number" placeholder="ID Customer" type="text" value="GNB-">
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
	$no_control= isset($_POST['no_control']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_control']))) : "";
	$customer_number= isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
	$name		= isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
	//$title	= isset($_POST['title']) ? mysql_real_escape_string(strip_tags(trim($_POST['title']))) : "";
	$address 	= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$phone	 	= isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
	$email	 	= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	
	$sql_nama	= ($name != "") ? "AND `nama_customer` LIKE '".$name."%'": "";
	$sql_kode	= ($customer_number != "") ? "AND `kode_customer` LIKE '".$customer_number."%'": "";
	$sql_no_control	= ($no_control != "") ? "AND `no_control_justifikasi` LIKE '".$no_control."%'": "";
	$sql_address	= ($address != "") ? "AND `alamat` LIKE '%".$address."%'": "";
	$sql_email	= ($email != "") ? "AND `email` LIKE '%".$email."%'" : "";
	$sql_phone	= ($phone != "") ? "AND `no_telp` LIKE '%".$phone."%'" : "";
	
	$sql_control	= "SELECT * FROM `gx_control_justifikasi`
	WHERE `level` = '0'
	$sql_kode
	$sql_no_control
	$sql_nama
	$sql_address
	$sql_email
	$sql_phone
	ORDER BY `id_control_justifikasi` ASC LIMIT 0,10;";
}else{
	$sql_control	= "SELECT * FROM `gx_control_justifikasi`
	WHERE `tanggal` LIKE NOW()
	ORDER BY `id_control_justifikasi` ASC LIMIT 0,10;";
}

		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
		    <th>No. justifikasi</th>
		    <th>No. Control justifikasi</th>
		    <th>Name</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_control	= mysql_query($sql_control, $conn);
$no = 1;

    while ($row_control = mysql_fetch_array($query_control)) {
     
	$content .='<tr>
                    <td>'.$no.'</td>
		    <td>'.$row_control["no_justifikasi"].'</td>
                    <td>'.$row_control["no_control_justifikasi"].'</td>
                    <td>'.$row_control["nama_customer"].'</td>
                    <td>
                      <a href="" onclick="validepopupform2(\''.$row_control["no_control_justifikasi"].'\',\''.$row_control["no_justifikasi"].'\',\''.$row_control["kode_customer"].'\',\''.$row_control["nama_customer"].'\',\''.$row_control["longitude"].'\',\''.$row_control["latitude"].'\',\''.$row_control["tiang_terdekat"].'\',\''.$row_control["kode_paket"].'\',\''.$row_control["nama_paket"].'\',\''.$row_control["kontrak"].'\',\''.number_format($row_control["setup_fee_normal"]).'\',\''.number_format($row_control["abonemen_normal"]).'\',\''.number_format($row_control["monthly_fee_normal"]).'\',\''.number_format($row_control["bandwith_normal"]).'\',\''.$row_control["setup_fee_justifikasi"].'\',\''.$row_control["abonemen_justifikasi"].'\',\''.$row_control["monthly_fee_justifikasi"].'\',\''.$row_control["bandwith_justifikasi"].'\',\''.$row_control["total_linkbudget"].'\',\''.$row_control["laba_rugi_bulanan"].'\',\''.$row_control["laba_rugi_tahunan"].'\')">Select</a>
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
  
	function validepopupform2(nocontrol,nojustifikasi,kodecustomer,namacustomer,clongitude,clatitude,notiang,nopaket,namapaket,kontrak,setupfeenormal,abonemennormal,monthlyfeenormal,bandwithnormal,setupfeejustifikasi,abonemenjustifikasi,monthlyfeejustifikasi,bandwithjustifikasi,totallinkbudget,labarugibulanan,labarugitahunan){
		
		
                window.opener.document.'.$return_form.'.no_control_justifikasi.value=nocontrol;
		window.opener.document.'.$return_form.'.no_justifikasi.value=nojustifikasi;
		window.opener.document.'.$return_form.'.kode_customer.value=kodecustomer;
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
		
		window.opener.document.'.$return_form.'.total_linkbudget.value=totallinkbudget;
		window.opener.document.'.$return_form.'.laba_rugi_bulanan.value=labarugibulanan;
		window.opener.document.'.$return_form.'.laba_rugi_tahunan.value=labarugitahunan;
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