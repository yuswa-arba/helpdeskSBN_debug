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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data SPK Aktivasi Add On");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data SPK Aktivasi Add On
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data SPK Aktivasi Add On</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      <tr>
			<td>
			  <label>User ID *</label>
			</td>
			<td>
			  <input class="form-control" name="user_id" placeholder="User ID" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Customer Number</label>
			</td>
			<td>
			  <input class="form-control" name="customer_number" placeholder="Customer Number" type="text" value="">
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
	$user_id	= isset($_POST['user_id']) ? mysql_real_escape_string(strip_tags(trim($_POST['user_id']))) : "";
	$customer_number= isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
	$name		= isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
	//$title	= isset($_POST['title']) ? mysql_real_escape_string(strip_tags(trim($_POST['title']))) : "";
	$address 	= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$phone	 	= isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
	
	$sql_nama	= ($name != "") ? "AND `gx_jawab_spk_aktivasi_add_on`.`nama_customer` LIKE '".$name."%'": "";
	$sql_userid	= ($user_id != "") ? "AND `gx_jawab_spk_aktivasi_add_on`.`uid` LIKE '%".$user_id."%'": "";
	$sql_address	= ($address != "") ? "AND `gx_jawab_spk_aktivasi_add_on`.`alamat` LIKE '%".$address."%'": "";
	$sql_phone	= ($phone != "") ? "AND `gx_jawab_spk_aktivasi_add_on`.`telp` LIKE '%".$phone."%'" : "";
	
	$sql_customer	= "SELECT `gx_jawab_spk_aktivasi_add_on`.* FROM `gx_spk_aktivasi_add_on`, `gx_jawab_spk_aktivasi_add_on`
	WHERE `gx_jawab_spk_aktivasi_add_on`.`kode_customer` LIKE '".$customer_number."%'
	AND `gx_jawab_spk_aktivasi_add_on`.`level` = `gx_spk_aktivasi_add_on`.`level`
	AND	`gx_spk_aktivasi_add_on`.`level` = '0'
	$sql_nama
	$sql_userid
	$sql_address
	$sql_phone
	ORDER BY `id_spk_aktivasi_add_on` DESC LIMIT 0,10;";
	
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Customer Number</th>
					<th>User ID</th>
					<th>Name</th>
					<th>Address</th>
					<th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_customer	= mysql_query($sql_customer, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "aktivasi_add_on"){
  while ($row_customer = mysql_fetch_array($query_customer)) {
   
	$data_teknisi = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_customer[id_teknisi]'", $conn));
	$data_marketing = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_customer[id_marketing]'", $conn));
	
	   $sql_paket	= "SELECT * FROM `gx_paket2` WHERE `kode_paket` = '".$row_customer["kode_paket"]."' ORDER BY `id_paket` ASC LIMIT 0,1;";
	   $query_paket	= mysql_query($sql_paket, $conn);
	   $row_paket 	= mysql_fetch_array($query_paket);
	   
	   $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
	   $hari_ini	= date("d");
	   
	   $sum_aktivasi_sd_akhirbulan 	= $jumlah_hari - $hari_ini; //baru
	   $total_hari_pengurangan 		= $jumlah_hari - $sum_aktivasi_sd_akhirbulan; //lama
	   
	   $tagihanperhari  = $row_paket["monthly_fee"] / $jumlah_hari;
	   $total_tagihan	= $total_hari_pengurangan * $tagihanperhari;
	   $ppn				= 10/100 * $total_tagihan;
	   $totalppn		= $total_tagihan + $ppn;
	   
	   $tagihanperhari_baru = $row_paket["monthly_fee"] / $jumlah_hari;
	   $total_tagihan_baru	= $sum_aktivasi_sd_akhirbulan * $tagihanperhari_baru;
	   $ppn_baru			= 10/100 * $total_tagihan_baru;
	   $totalppn_baru		= $total_tagihan_baru + $ppn_baru;
	   
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_customer["kode_customer"].'</td>
		     <td>'.$row_customer["uid"].'</td>
		     <td>'.$row_customer["nama_customer"].'</td>
		     <td>'.$row_customer["alamat"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_customer["kode_customer"]).'\', \''.mysql_real_escape_string($row_customer["nama_customer"]).'\', \''.mysql_real_escape_string($row_customer["no_linkbudget"]).'\', \''.mysql_real_escape_string($row_customer["kode_paket"]).'\', \''.mysql_real_escape_string($row_customer["nama_paket"]).'\', \''.mysql_real_escape_string($row_customer["uid"]).'\', \''.mysql_real_escape_string($row_customer["telp"]).'\', \''.mysql_real_escape_string($row_customer["alamat"]).'\', \''.mysql_real_escape_string($row_customer["id_teknisi"]).'\', \''.mysql_real_escape_string($row_customer["id_marketing"]).'\',  \''.mysql_real_escape_string($data_teknisi["cNama"]).'\', \''.mysql_real_escape_string($data_marketing["cNama"]).'\', \''.number_format($row_paket["monthly_fee"],2).'\',\''.number_format($tagihanperhari_baru,2).'\',\''.$sum_aktivasi_sd_akhirbulan.'\',\''.number_format($total_tagihan_baru,2).'\',\''.number_format($ppn_baru,2).'\',\''.number_format($totalppn_baru,2).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }
}else{
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
if(isset($_GET["f"])){
 if($_GET["f"] == "aktivasi_add_on"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(customernumber, cnamacust, cno_linkbudget, ckodepaket, cnamapaket, cuid, ctelp, calamat, cid_teknisi, cid_marketing, cnama_teknisi, cnama_marketing, monthly_func_baru,daily_func_baru,aktivasi_func_baru,total_func_baru,ppn_baru,totalppn_baru){
		 window.opener.document.'.$return_form.'.kode_customer.value=customernumber;
		 window.opener.document.'.$return_form.'.nama_customer.value=cnamacust;
		 window.opener.document.'.$return_form.'.no_linkbudget.value=cno_linkbudget;
		 
		 window.opener.document.'.$return_form.'.kode_paket.value=ckodepaket;
		 window.opener.document.'.$return_form.'.nama_paket.value=cnamapaket;
		 window.opener.document.'.$return_form.'.uid.value=cuid;
		 window.opener.document.'.$return_form.'.telp.value=ctelp;
		 window.opener.document.'.$return_form.'.alamat.value=calamat;
		 window.opener.document.'.$return_form.'.id_teknisi.value=cid_teknisi;
		 window.opener.document.'.$return_form.'.id_marketing.value=cid_marketing;
		 window.opener.document.'.$return_form.'.nama_teknisi.value=cnama_teknisi;
		 window.opener.document.'.$return_form.'.nama_marketing.value=cnama_marketing;
		 
		 window.opener.document.'.$return_form.'.monthly_baru.value=monthly_func_baru;
		 window.opener.document.'.$return_form.'.daily_baru.value=daily_func_baru;
		 window.opener.document.'.$return_form.'.hari_aktivasi_baru.value=aktivasi_func_baru;
		 window.opener.document.'.$return_form.'.total_baru.value=total_func_baru;
		 window.opener.document.'.$return_form.'.ppn_baru.value=ppn_baru;
		 window.opener.document.'.$return_form.'.totalppn_baru.value=totalppn_baru;
		 
		 self.close();
	 }
 </script>
 
     ';
 }
}else{

}


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