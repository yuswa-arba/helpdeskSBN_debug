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
    
if(isset($_GET["id"]))
{
    $id_linkbudget	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
    $kode_spk_pasang	= isset($_GET['spk']) ? mysql_real_escape_string(strip_tags(trim($_GET['spk']))) : "";
    $kode_spk_aktivasi	= isset($_GET['aktivasi']) ? mysql_real_escape_string(strip_tags(trim($_GET['aktivasi']))) : "";
    
    $sql_spk2 = "";
    if(isset($_GET['spk'])){   
	$sql_spk2 = "AND `gx_alat_pasang`.`kode_spk_pasang` = '".$kode_spk_pasang."'";
    }elseif(isset($_GET['aktivasi']))
    {
	$sql_spk2 = "AND `gx_alat_pasang`.`kode_spk_aktivasi` = '".$kode_spk_aktivasi."'";
    }
    
    $sql_data	= "SELECT DISTINCT(`gx_alat_pasang`.`no_linkbudget`), `gx_alat_pasang`.`kode_spk_aktivasi`, gx_alat_pasang.kode_spk_pasang,
						    `gx_link_budget`.*
						    FROM `gx_alat_pasang`, `gx_link_budget`
						      WHERE `gx_alat_pasang`.`no_linkbudget`=`gx_link_budget`.`no_linkbudget`
						      AND `gx_alat_pasang`.`level` =  '0'
						      AND `gx_alat_pasang`.`no_linkbudget` = '".$id_linkbudget."'
						      $sql_spk2;";
    $query_data	= mysql_query($sql_data, $conn);
    $row_data	= mysql_fetch_array($query_data);
    
    
}

    $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Alat</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Link Budget</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="no_linkbudget" name="no_linkbudget" required="" readonly="" value="'.(isset($_GET["id"]) ? $row_data['no_linkbudget'] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Jawab SPK Pasang</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_spk_pasang" name="kode_spk_pasang" required="" readonly="" value="'.(isset($_GET["id"]) ? $row_data['kode_spk_pasang'] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Jawab SPK Aktivasi</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_spk_aktivasi" name="kode_spk_aktivasi" required="" readonly="" value="'.(isset($_GET["id"]) ? $row_data["kode_spk_aktivasi"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" readonly="" required="" name="kode_customer" value="'.(isset($_GET["id"]) ? $row_data['kode_cust'] : "").'">
					    </div>
                                            <div class="col-xs-2">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" id="nama" name="nama" readonly="" required="" value="'.(isset($_GET["id"]) ? $row_data['nama_cust'] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Longitude</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" readonly name="longitude" id="longitude" value="'.(isset($_GET["id"]) ? $row_data['longitude'] : "").'">
					    </div>
					    <div class="col-xs-2">
						<label>Latitude</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" readonly id="latitude" name="latitude" value="'.(isset($_GET["id"]) ? $row_data['latitude'] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No. Tiang Terdekat</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" readonly name="no_tiang" value="'.(isset($_GET["id"]) ? $row_data['tiang_terdekat'] : "").'">
					    </div>
					    <div class="col-xs-2">
						<label>Name Created</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" readonly="" name="name_created" value="'.(isset($_GET["id"]) ? $row_data['user_created'] : "").'">
					    </div>
                                        </div>
					</div>
					
                                        <table style="width:100%;">
					<tbody>
					    
					    <tr>
						<td colspan="2">&nbsp;</td>
					    </tr>
					    <tr>
						<td colspan="2">
					    <table width="100%" cellspacing="10" class="table table-bordered table-striped">
							    <tbody><tr>
							      <th width="10%">
								  No.
							      </th>
							      <th width="17%">
								  Kode
							      </th>
							      <th width="35%">
								    Nama
							      </th>
							      <th align="right" width="17%">
								    QTY
							      </th>
							      <th align="right" width="17%">
								    SN
							      </th>
							      
							    </tr>';
if(isset($_GET["id"]))
{
    $sql_spk = "";
    if(isset($_GET['spk'])){   
	$sql_spk = "AND `kode_spk_pasang` = '".$kode_spk_pasang."'";
    }elseif(isset($_GET['aktivasi']))
    {
	$sql_spk = "AND `kode_spk_aktivasi` = '".$kode_spk_aktivasi."'";
    }
    
    $sql_data_alat	= "SELECT * FROM `gx_alat_pasang` WHERE `no_linkbudget` = '".$id_linkbudget."' $sql_spk;";
    $query_data_alat	= mysql_query($sql_data_alat, $conn);
    $no = 1;
    while($row_alat = mysql_fetch_array($query_data_alat))
    {
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_alat["kode_barang"].'</td>
	<td>'.$row_alat["nama_barang"].'</td>
	<td>'.$row_alat["qty"].'</td>
	<td>'.$row_alat["serial_number"].'</td>
	
	</tr>';
	$no++;
	
    }
}else{
    

    $content .='<tr><td colspan="7">&nbsp;</td></tr>';
}

$content .='							    
					     
					    </tbody></table>
					    
					     
					    </td>
					    </tr>
					</tbody></table>
					
                                    </div><!-- /.box-body -->
				    
				   
                            </div><!-- /.box -->
                        </section>
                        
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: "",
		thousandsSeparator: ",",
		centsLimit: 0
	    });
        </script>
';

    $title	= 'Detail Realisasi';
    $submenu	= "realisasi_linkbudget";
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