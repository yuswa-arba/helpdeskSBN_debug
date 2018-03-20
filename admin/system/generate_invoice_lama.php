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
    if($loggedin["group"] == 'admin')
    {
        global $conn;
    
if(isset($_POST["generate"]))
{
    //echo "update";
    
    $tgl_tagihan    = isset($_POST['tgl_tagihan']) ? mysql_real_escape_string(strip_tags(trim($_POST['tgl_tagihan']))) : '';
    $dept	    	= isset($_POST['dept']) ? mysql_real_escape_string(strip_tags(trim($_POST['dept']))) : '';
	$id_cabang    	= isset($_POST['id_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_cabang']))) : '';
	
	$tgl_tagihan	= str_replace('/', '-', $tgl_tagihan);

    if($tgl_tagihan != "" AND $id_cabang !=""){
		$sql_insert = "INSERT INTO `software`.`gx_generate_invoice` (`id_generate`, `tgl_tagihan`, `id_cabang`, `dept`, `user_add`, `date_add`)
		VALUES (NULL, '".date("Y-m-d", strtotime($tgl_tagihan))."', '".$id_cabang."', '".$dept."', '".$loggedin["username"]."', NOW());";
		
		//echo $sql_insert;
		mysql_query($sql_insert, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);		
		
		$sql_generate	= mysql_query("SELECT `id_generate` FROM `gx_generate_invoice` ORDER BY `id_generate` DESC LIMIT 0,1;", $conn);
		$row_generate	= mysql_fetch_array($sql_generate);
		
		$cKode = array();
		$cKode = isset($_POST["cKode"]) ? $_POST["cKode"] : $cKode;
		$total_key = 1;
		foreach($cKode as $key => $value)
		{
			//GENERATE INVOICE
			/*echo "SELECT `tbCustomer`.*, `gx_cabang`.`invoice_code, `gx_paket2`.`abonemen_voip`, `gx_paket2`.`abonemen_video`, `gx_paket2`.`monthly_fee`
											FROM `tbCustomer`, `gx_paket2`, `gx_cabang`
											WHERE `tbCustomer`.`cKdpaket` = `gx_paket2`.`kode_paket`
											AND `tbCustomer`.`id_cabang` = `gx_cabang`.`id_cabang`
											AND `tbCustomer`.`cKode` = '".$value."'
											AND `tbCustomer`.`level` = '0' 
											LIMIT 0,1;";
				*/
			//invoice
			
				$sql_customer	= mysql_query("SELECT `tbCustomer`.*, `gx_cabang`.`invoice_code`, `gx_paket2`.`abonemen_voip`, `gx_paket2`.`abonemen_video`, `gx_paket2`.`monthly_fee`
											FROM `tbCustomer`, `gx_paket2`, `gx_cabang`
											WHERE `tbCustomer`.`cKdPaket` = `gx_paket2`.`kode_paket`
											AND `tbCustomer`.`id_cabang` = `gx_cabang`.`id_cabang`
											AND `tbCustomer`.`cKode` = '".$value."'
											AND `tbCustomer`.`level` = '0'
											AND `gx_paket2`.`level` = '0'
											LIMIT 0,1;", $conn);
				
				$row_customer	= mysql_fetch_array($sql_customer);
				
				if($row_customer["nterm"]==-"0.00")
				{
					$grace = "2";
				}else
				{
					$grace =(int)$row_customer["nterm"] -1;
				}
				
				if($row_customer["cKode"] != "")
				{
				$sql_invoice  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_invoice` ORDER BY `id_invoice` DESC", $conn));
				$last_data  = $sql_invoice["id_invoice"] + 1;
				$tanggal    = date("Ymd");
				$kode_invoice = $row_customer["invoice_code"].''.$tanggal.''.sprintf("%04d", $last_data);
			
				$sql_insert_invoice = "INSERT INTO `gx_invoice`(`id_invoice`, `kode_aktivasi`, `kode_invoice`, `title`, `customer_number`,`nama_customer`,
										`npwp`, `no_faktur_pajak`, `note`, `periode_tagihan`,`tanggal_tagihan`, `tanggal_jatuh_tempo`,
									`no_virtual_account_bca`, `nama_virtual`, `prepared_by`, `date_add`, `date_upd`,
									`user_add`, `user_upd`, `level`)
								VALUES (NULL, '', '".$kode_invoice."', 'INVOICE ".NamaBulan(date("n", strtotime($tgl_tagihan)))." ".date("Y", strtotime($tgl_tagihan))."', '".$row_customer["cKode"]."', '".$row_customer["cNama"]."',
									'".$row_customer["no_npwp"]."', '', 'INVOICE ".NamaBulan(date("n", strtotime($tgl_tagihan)))." ".date("Y", strtotime($tgl_tagihan))."',
									'".NamaBulan(date("n", strtotime($tgl_tagihan)))." ".date("Y", strtotime($tgl_tagihan))."', '".date("Y-m-d", strtotime($tgl_tagihan))."',
									'".date("Y-m-d", strtotime("$tgl_tagihan +$grace days"))."',
									'".$row_customer["cNoRekVirtual"]."', '".$row_customer["cNama"]."', '".$loggedin["username"]."', NOW(), NOW(),
									'".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
				
				//echo $sql_insert."<br>";
			
				mysql_query($sql_insert_invoice, $conn) or die ("<script language='JavaScript'>
										   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
										   window.history.go(-1);
										   </script>");
				
				//log
				enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_invoice);
				
				//detiail invoice inet
				$sql_detail_inet = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`, `date`,
										`harga`, `desc`, `date_add`,
										`date_upd`, `user_add`, `user_upd`, `level`)
									VALUES ('', '".$kode_invoice."', '".date("Y-m-d H:i:s", strtotime($tgl_tagihan))."',
										'".$row_customer["monthly_fee"]."', 'INTERNET', NOW(),
										NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
				//echo $sql_insert;
				mysql_query($sql_detail_inet, $conn) or die ("<script language='JavaScript'>
										   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
										   window.history.go(-1);
										   </script>");
				//log
				enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_detail_inet);
				
				//detiail invoice voip
				$sql_detail_voip = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`, `date`,
										`harga`, `desc`, `date_add`,
										`date_upd`, `user_add`, `user_upd`, `level`)
									VALUES ('', '".$kode_invoice."', '".date("Y-m-d H:i:s", strtotime($tgl_tagihan))."',
										'".$row_customer["abonemen_voip"]."', 'VOIP', NOW(),
										NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
				//echo $sql_insert;
				mysql_query($sql_detail_voip, $conn) or die ("<script language='JavaScript'>
										   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
										   window.history.go(-1);
										   </script>");
				//log
				enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_detail_voip);
				
				//detiail invoice video
				$sql_detail_video = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`, `date`,
										`harga`, `desc`, `date_add`,
										`date_upd`, `user_add`, `user_upd`, `level`)
									VALUES ('', '".$kode_invoice."', '".date("Y-m-d H:i:s", strtotime($tgl_tagihan))."',
										'".$row_customer["abonemen_video"]."', 'TV/VIDEO', NOW(),
										NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
				//echo $sql_insert;
				mysql_query($sql_detail_video, $conn) or die ("<script language='JavaScript'>
										   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
										   window.history.go(-1);
										   </script>");
				//log
				enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_detail_video);
				
			
			//END GENERATE
			
		
			$sql_insert_detail = "INSERT INTO `software`.`gx_generate_detail` (`id_detail`, `id_generate`, `id_customer`, `kode_paket`)
			VALUES (NULL, '".$row_generate["id_generate"]."', '".$value."', '".$row_customer["cKdPaket"]."');";
			$total_key = $total_key + $key;
			//echo $sql_update;
			mysql_query($sql_insert_detail, $conn) or die (mysql_error());
			
				}
		}
		echo "<script language='JavaScript'>
			alert('".$total_key." invoice telah di generate.');
			window.location.href='".URL_ADMIN."administrasi/master_invoice.php';
			</script>";
    }else{
		echo "<script language='JavaScript'>
			alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
		</script>";
    }
}

    
    $content ='<section class="content-header">
                    <h1>
                        Generate Invoice
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Generate Invoice</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tanggal Tagihan</label>
					    </div>
					    <div class="col-xs-6">
							<input type="text" class="form-control" class="form-control hasDatepicker" id="datepicker" readonly="" name="tgl_tagihan" value="'.date("01/m/Y").'">
						</div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Port</label>
					    </div>
					    <div class="col-xs-6">
						<select class="form-control required"  name="id_cabang" id="id_cabang">';
						    
						    $sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `level` = '0';", $conn);
						    
						    while($row_cabang = mysql_fetch_array($sql_cabang))
						    {
								$content .='<option value="'.$row_cabang["id_cabang"].'" '.((isset($_GET["id"]) && $row_customer["id_cabang"] == $row_cabang["id_cabang"] ) ? 'selected="selected"' :"") .'>'.$row_cabang["nama_cabang"].'</option>';
							
						    }
						    
$content .='			</select>

					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tipe Koneksi</label>
					    </div>
					    <div class="col-xs-6">
						<select class="form-control" name="type_koneksi">
							<option value="wireless">Wifi</option>
							<option value="fo">FO</option>
                        </select>
					    </div>
					    
                                        </div>
					</div>
					
					<fieldset>
					<legend>Data Customer</legend>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>User ID</label>
					    </div>
					    <div class="col-xs-6">
							<input type="text" class="form-control" name="userid" maxlength="100" value="">
						
					    </div>
						<div class="col-xs-3">
						<button type="submit" name="search" class="btn btn-primary">Search</button>
                        </div>
						</div>
					</div>
					
<table id="customer" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>User ID</th>
			<th>Nama</th>
			<th width="15%"><input type="checkbox" id="select_all"></th>
                  </tr>
                </thead>
                <tbody>';
//select data
if(isset($_POST["search"]))
{
    $userid    		= isset($_POST['userid']) ? mysql_real_escape_string(strip_tags(trim($_POST['userid']))) : '';
	$id_cabang    	= isset($_POST['id_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_cabang']))) : '';
	$type_koneksi  	= isset($_POST['type_koneksi']) ? mysql_real_escape_string(strip_tags(trim($_POST['type_koneksi']))) : '';
    $sql_data		= mysql_query("SELECT `cKode`, `cUserID`, `cNama`, `cKdPaket`
								  FROM `tbCustomer`, `gx_paket2`
								  WHERE `tbCustomer`.`cKdPaket` = `gx_paket2`.`kode_paket`
								  AND `tbCustomer`.`id_cabang` = '".$id_cabang."'
								  AND `gx_paket2`.`internet_type` = '".$type_koneksi."'
								  AND `tbCustomer`.`cUserID` LIKE '%".$userid."%' AND `tbCustomer`.`level` =  '0'
								  AND `gx_paket2`.`level` =  '0';", $conn);
    /*echo "SELECT `cKode`, `cUserID`, `cNama`, `cKdPaket`
								  FROM `tbCustomer`, `gx_paket2`
								  WHERE `tbCustomer`.`cKdPaket` = `gx_paket2`.`kode_paket`
								  AND `tbCustomer`.`id_cabang` = '".$id_cabang."'
								  AND `gx_paket2`.`internet_type` = '".$type_koneksi."'
								  AND `tbCustomer`.`cUserID` LIKE '%".$userid."%' AND `tbCustomer`.`level` =  '0';";*/
}
/*else{
	
    $sql_data		= mysql_query("SELECT `cKode`, `cUserID`, `cNama` FROM `tbCustomer` WHERE `level` =  '0';", $conn);
}*/

if(isset($_POST["search"]))
{
	$no = 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["cUserID"].'</td>
			<td>'.$row_data["cNama"].'</td>
			<td><input class="generate" type="checkbox" name="cKode[]" value="'.$row_data["cKode"].'"></td>
		</tr>';
	$no++;
    }
}
$content .='</tbody>
</table>
</fieldset>
									</div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="generate" class="btn btn-primary">Generate</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script language="javascript">
$(\'input#select_all\').on(\'ifChecked\', function(event){
	$("input.generate").iCheck("check");
});
$(\'input#select_all\').on(\'ifUnchecked\', function(event){
	$("input.generate").iCheck("uncheck");
});
</script>

<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#customer\').dataTable({
                    "sScrollY":        "200px",
					"sScrollCollapse": true,
					"bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

<!-- datepicker -->
<script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

<script>
    $(function() {
	$("[id=datepicker]").datepicker({format: "dd/mm/yyyy"});
	
    });
</script>';

    $title	= 'Form Cabang';
    $submenu	= "cabang";
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