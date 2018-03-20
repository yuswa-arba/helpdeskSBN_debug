<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Invoice");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
    $f			= isset($_GET['f']) ? mysql_real_escape_string(strip_tags(trim($_GET['f']))) : "";
    $customer_number	= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : "";

    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Invoice dengan Customer Number '.(isset($_GET["c"]) ? $customer_number : "").'</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				<form action="" method="post" name="form_search" id="form_search">
				 <table class="form" width="80%">
		      <tr>
			<td>
			  <label>Kode Invoice</label>
			</td>
			<td>
			  <input class="form-control" name="kode_invoice" type="text" value="">
			  <input class="form-control" name="customer_number" type="hidden" value="'.(isset($_GET["c"]) ? $customer_number : "").'">
			</td>
		      </tr>
		      
		      <tr>
			<td>&nbsp;</td>
			<td>
			  <input type="submit" class="button button-primary" name="search" value="Search">
			</td>
		      </tr>
		</table>
				</form>
		';
		
if(isset($_POST["search"])){
 $kode_invoice		= isset($_POST['kode_invoice']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_invoice']))) : "";
 $customer_number	= isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
 
 $sql_data	= "SELECT * FROM `gx_invoice` WHERE `kode_invoice` LIKE '%".$kode_invoice."%' AND `level` = '0'
		    AND `status` = '1' AND `customer_number` = '".$customer_number."'
			AND `paid_status` <> '1'
		    ORDER BY `id_invoice` ASC;";
 
}else{
 $sql_data	= "SELECT * FROM `gx_invoice` WHERE `level` = '0'
		    AND `status` = '1'
			AND `paid_status` <> '1'
		   ORDER BY `id_invoice` ASC;";
		   //echo $sql_data;
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Customer Number</th>
					
					<th>Kode Invoice</th>
					<th>Nama</th>
					<th>Tanggal</th>
					<th>Nominal</th>
					<th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_data	= mysql_query($sql_data, $conn);
$no = 1;

while ($row_data = mysql_fetch_array($query_data)) {
 
 $query_customer	= mysql_query("SELECT * FROM `tbCustomer` WHERE `level` = '0' AND `cKode` = '".$row_data["customer_number"]."' LIMIT 0,1;", $conn);
 $row_customer		= mysql_fetch_array($query_customer);
 
    $sql_detail	= "SELECT SUM(`harga`) as `total` FROM `gx_invoice_detail`
		    WHERE `kode_invoice` ='".$row_data["kode_invoice"]."'
		    AND `level` = '0' ORDER BY `kode_invoice` DESC;";

    $query_detail = mysql_query($sql_detail, $conn);
    $row_detail	= mysql_fetch_array($query_detail);
	
	$ppn = (10/100) * $row_detail["total"];
	$total = $ppn + $row_detail["total"];
	
    $content .='<tr>
		<td>'.$no.'</td>
		<td>'.$row_data["customer_number"].'/'.$row_data["nama_customer"].'</td>
		<td>'.$row_data["kode_invoice"].'</td>
		<td>'.$row_data["title"].'</td>
		<td>'.date("d-m-Y", strtotime($row_data["tanggal_tagihan"])).'</td>
		<td>'.$total.'</td>
		<td>
		  <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_data["kode_invoice"]).'\',';
		   $content .='\''.mysql_real_escape_string($row_data["title"]).'\',';
		   $content .='\''.mysql_real_escape_string($row_data["customer_number"]).'\',';
		   $content .='\''.mysql_real_escape_string($row_data["nama_customer"]).'\',';
		   $content .='\''.mysql_real_escape_string($row_data["periode_tagihan"]).'\',';
		   $content .='\''.mysql_real_escape_string($row_customer["cEmail"]).'\',';
		   $content .='\''.mysql_real_escape_string($row_data["id_invoice"]).'\',';
		   
		   $content .='\''.mysql_real_escape_string($total).'\');">Select</a>
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
  
	function validepopupform2(kodei, judul, idcust, namacust, periode, email, idv, hargai){
                window.opener.document.'.$return_form.'.kode_invoice.value=kodei;
                window.opener.document.'.$return_form.'.title.value=judul;
				window.opener.document.'.$return_form.'.customer_number.value=idcust;
                window.opener.document.'.$return_form.'.nama_customer.value=namacust;
				window.opener.document.'.$return_form.'.periode_tagihan.value=periode;
				window.opener.document.'.$return_form.'.email_customer.value=email;
				window.opener.document.'.$return_form.'.id_invoice.value=idv;
				
				
		self.close();
        }
</script>

    ';
	

    $title	= 'Data Invoice';
    $submenu	= "master_invoice";
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