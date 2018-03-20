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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data SPK Pasang Baru ");
    global $conn;
    global $conn_voip;
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data SPK Pasang Baru
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data SPK Pasang Baru</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      <tr>
			<td>
			  <label>No SPK Pasang Baru</label>
			</td>
			<td>
			  <input class="form-control" name="no_pasang_baru" placeholder="No SPK Pasang Baru" type="text" value="">
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
			<td>&nbsp;</td>
			<td>
			  <input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
			</td>
		      </tr>
		</table>';
		
if(isset($_POST["save_search"])){
	$no_pasang	= isset($_POST['no_pasang_baru']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_pasang_baru']))) : "";
	$customer_number= isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
	$name		= isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
	//$title	= isset($_POST['title']) ? mysql_real_escape_string(strip_tags(trim($_POST['title']))) : "";
	$address 	= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$phone	 	= isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
	$email	 	= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	
	$sql_nama	= ($name != "") ? "AND `nama_customer` LIKE '".$name."%'": "";
	$sql_kode	= ($customer_number != "") ? "AND `id_customer` LIKE '".$customer_number."%'": "";
	$sql_pasang	= ($no_pasang != "") ? "AND `kode_spk` LIKE '".$no_pasang."%'": "";
	$sql_address	= ($address != "") ? "AND `alamat` LIKE '%".$address."%'": "";
	$sql_phone	= ($phone != "") ? "AND `telpon` LIKE '%".$phone."%'" : "";
	
	$sql_pasang	= "SELECT * FROM `gx_spk_pasang`
	WHERE `level` = '0'
	$sql_kode
	$sql_pasang
	$sql_nama
	$sql_address
	$sql_phone
	ORDER BY `id_spkpasang` ASC LIMIT 0,10;";
}else{
	$sql_pasang	= "SELECT * FROM `gx_spk_pasang`
	WHERE `tanggal` LIKE NOW()
	ORDER BY `id_spkpasang` ASC LIMIT 0,10;";
}

		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
		    <th>No. SPK Pasang</th>
		    <th>Id Customer</th>
		    <th>Name</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_pasang	= mysql_query($sql_pasang, $conn);
$no = 1;

    while ($row_pasang = mysql_fetch_array($query_pasang)) {
     $sql_jawab_pasang		= "SELECT * FROM `gx_jawab_spkpasang` WHERE `kode_spk` = '$row_pasang[kode_spk]';";
     $query_jawab_pasang	= mysql_query($sql_jawab_pasang, $conn);
     $row_jawab_pasang		= mysql_fetch_array($query_jawab_pasang);
	$content .='<tr>
                    <td>'.$no.'</td>
		    <td>'.$row_pasang["kode_spk"].'</td>
                    <td>'.$row_pasang["id_customer"].'</td>
                    <td>'.$row_pasang["nama_customer"].'</td>
                    <td>
                      <a href="" onclick="validepopupform2(\''.$row_pasang["kode_spk"].'\',\''.$row_jawab_pasang["kode_jawab_spk"].'\',\''.$row_pasang["id_customer"].'\',\''.$row_pasang["nama_customer"].'\',\''.$row_pasang["id_cabang"].'\',\''.$row_pasang["id_linkbudget"].'\',\''.$row_pasang["paket_koneksi"].'\',\''.$row_pasang["nama_koneksi"].'\',\''.$row_pasang["user_id"].'\',\''.$row_pasang["telpon"].'\',\''.$row_pasang["alamat"].'\',\''.$row_pasang["id_teknisi"].'\',\''.$row_pasang["id_marketing"].'\',\''.$row_pasang["nama_teknisi"].'\',\''.$row_pasang["nama_marketing"].'\')">Select</a>
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
  
	function validepopupform2(kodespkpasang,kodejawabspk,idcustomer,namacustomer,idcabang,idlinkbudget,paketkoneksi,namakoneksi,userid,ctelpon,calamat,idteknisi,idmarketing,namateknisi,namamarketing){

                window.opener.document.'.$return_form.'.kode_spkpasang.value=kodespkpasang;
		window.opener.document.'.$return_form.'.kode_jawabspk.value=kodejawabspk;
		window.opener.document.'.$return_form.'.id_customer.value=idcustomer;
		window.opener.document.'.$return_form.'.nama_customer.value=namacustomer;
		window.opener.document.'.$return_form.'.id_cabang.value=idcabang;
		window.opener.document.'.$return_form.'.id_linkbudget.value=idlinkbudget;
		window.opener.document.'.$return_form.'.paket_koneksi.value=paketkoneksi;
		
		window.opener.document.'.$return_form.'.nama_koneksi.value=namakoneksi;
		window.opener.document.'.$return_form.'.user_id.value=userid;
		window.opener.document.'.$return_form.'.telpon.value=ctelpon;
		
		window.opener.document.'.$return_form.'.alamat.value=calamat;
		window.opener.document.'.$return_form.'.id_teknisi.value=idteknisi;
		window.opener.document.'.$return_form.'.id_employee.value=idmarketing;
		window.opener.document.'.$return_form.'.nama_teknisi.value=namateknisi;
		window.opener.document.'.$return_form.'.nama_marketing.value=namamarketing;
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

    $title	= 'Data Pasang Baru';
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