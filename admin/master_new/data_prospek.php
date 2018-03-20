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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Cust");
    global $conn;
    global $conn_voip;
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data Prospek
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Prospek</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
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
	
	$customer_number= isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
	$name		= isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
	//$title	= isset($_POST['title']) ? mysql_real_escape_string(strip_tags(trim($_POST['title']))) : "";
	$address 	= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$phone	 	= isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
	$email	 	= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	
	$sql_nama	= ($name != "") ? "AND `nama_cust` LIKE '".$name."%'": "";
	$sql_address	= ($address != "") ? "AND `alamat` LIKE '%".$address."%'": "";
	$sql_email	= ($email != "") ? "AND `email` LIKE '%".$email."%'" : "";
	$sql_phone	= ($phone != "") ? "AND `no_telp` LIKE '%".$phone."%'" : "";
	
	$sql_prospek	= "SELECT * FROM `gx_prospek`
	WHERE `kode_cust` LIKE '".$customer_number."%'
	$sql_nama
	$sql_address
	$sql_email
	$sql_phone
	ORDER BY `id_prospek` ASC LIMIT 0,10;";
}else{
	$sql_prospek	= "SELECT * FROM `gx_prospek`
	WHERE `tanggal` LIKE NOW()
	ORDER BY `id_prospek` ASC LIMIT 0,10;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
		    <th>Id Prospek</th>
		    <th>Name</th>
		    <th>Address</th>
                    <th>Phone</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_prospek	= mysql_query($sql_prospek, $conn);
$no = 1;

    while ($row_prospek = mysql_fetch_array($query_prospek)) {
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_prospek["no_prospek"].'</td>
                    <td>'.$row_prospek["nama_cust"].'</td>
		    <td>'.$row_prospek["alamat"].'</td>
		    <td>'.$row_prospek["no_telp"].'</td>
                    <td>
                      <a href="" onclick="validepopupform2(\''.$row_prospek["no_prospek"].'\',\''.$row_prospek["kode_cust"].'\',\''.$row_prospek["nama_cust"].'\',\''.$row_prospek["nama_perusahaan"].'\',\''.$row_prospek["alamat"].'\',\''.$row_prospek["kelurahan"].'\',\''.$row_prospek["kecamatan"].'\',\''.$row_prospek["kota"].'\',\''.$row_prospek["kode_pos"].'\',\''.$row_prospek["no_telp"].'\',\''.$row_prospek["no_hp_1"].'\',\''.$row_prospek["no_hp_2"].'\',\''.$row_prospek["contact_person"].'\',\''.$row_prospek["email"].'\')">Select</a>
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
  
	function validepopupform2(cnoprospek, ccustnumber, cnamacust, cnamaperusahaan, calamat, ckelurahan, ckecamatan, ckota, ckodepos, cnotelp, chp1, chp2, ccontact, cemail){
                window.opener.document.'.$return_form.'.no_prospek.value=cnoprospek;
		window.opener.document.'.$return_form.'.kode_customer.value=ccustnumber;
		window.opener.document.'.$return_form.'.nama_customer.value=cnamacust;
		window.opener.document.'.$return_form.'.nama_perusahaan.value=cnamaperusahaan;
		window.opener.document.'.$return_form.'.alamat.value=calamat;
		window.opener.document.'.$return_form.'.kelurahan.value=ckelurahan;
		window.opener.document.'.$return_form.'.kecamatan.value=ckecamatan;
		window.opener.document.'.$return_form.'.kota.value=ckota;
		window.opener.document.'.$return_form.'.kode_pos.value=ckodepos;
		window.opener.document.'.$return_form.'.notelp.value=cnotelp;
		window.opener.document.'.$return_form.'.hp1.value=chp1;
		window.opener.document.'.$return_form.'.hp2.value=chp2;
		window.opener.document.'.$return_form.'.contact.value=ccontact;
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

    $title	= 'Data Customer';
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