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
include ("../../config/configuration_tv.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
		//koneksi RBS
		$conn_soft = Config::getInstanceSoft();
		//koneksi tv
		$conn_ott   = DB_TV();
   
$return_url = "";
if(isset($_GET["km"]))
{
    $kode_data	= isset($_GET['km']) ? mysql_real_escape_string(strip_tags(trim($_GET['km']))) : '';
    $query_data 	= "SELECT * FROM `gx_kas_masuk`
			    WHERE `transaction_id` = '".$kode_data."' AND `level` = '0'
			    LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
   
    
    $return_url = 'form_kasir_detail.php?km='.$kode_data;
    
}


    $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Kasir</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
									
									<form action="" role="form" name="form_bm" id="form_bm" method="post" enctype="multipart/form-data">
						
						<input type="hidden" name="id_customer" value="'.(isset($_GET['km']) ? $row_data["id_customer"] : "").'" readonly="">
						<input type="hidden" name="transaction_id" value="'.(isset($_GET['km']) ? $row_data["transaction_id"] : "").'" readonly="">
						
						
									
                                        <div class="form-group">
										
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Transaksi</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['km']) ? $row_data["transaction_id"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['km']) ? $row_data["tgl_transaction"] : date("Y-m-d")).'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Bank</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['km']) ? $row_data["bank_code"] : "").'
						
					    </div>
					    <div class="col-xs-3">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['km']) ? $row_data["id_customer"] : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC Cash</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['km']) ? $row_data["acc_cash"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['km']) ? $row_data["nama"] : "").'
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
						'.((isset($_GET['km'])) ? $row_data["mu"] : "").'
						
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Rate</label>
					    </div>
					    <div class="col-xs-3">
					        '.(isset($_GET['km']) ? $row_data["rate"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks</label>
                                            </div>
					    <div class="col-xs-9">
						'.(isset($_GET['km']) ? $row_data["remarks"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['km']) ? $row_data["user_add"] ." on".$row_data["date_add"]: $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Latest Updated By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['km']) ? $row_data["user_upd"]." on".$row_data["date_upd"] : "").'
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
							      <th>No.</th>
							      <th>ACC</th>
							      <th>No Jual</th>
							      <th>Keterangan</th>
							      <th>Nominal</th>
							    </tr>';
if(isset($_GET["km"]))
{
    $id_kasmasuk	= $row_data["id_kasmasuk"];
    $query_item	= "SELECT * FROM `gx_km_detail` WHERE `id_kasmasuk` ='".$id_kasmasuk."' AND `level` = '0';";
    $sql_item	= mysql_query($query_item, $conn);
    
    $id_km_detail  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_detail = "SELECT * FROM `gx_km_detail` WHERE `id_kasmasuk` ='".$id_kasmasuk."' AND `id_km_detail` = '".$id_km_detail."' LIMIT 0,1;";
    $sql_detail   = mysql_query($query_detail, $conn);
    $row_detail = mysql_fetch_array($sql_detail);
    
    $no = 1;
    $total = 0;
    
    while($row_item = mysql_fetch_array($sql_item))
    {
    
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_item["no_acc"].'</td>
	<td>'.$row_item["no_jual"].'</td>
	<td>'.$row_item["keterangan"].'</td>
	<td>'.number_format($row_item["nominal"], 0, ',', '.').'</td>
	</tr>';
	$no++;
	$total = $total + $row_item["nominal"];
	
    }
}else{
    
    $total_price = 0;
    $content .='<tr><td colspan="7">&nbsp;</td></tr>';
}

$content .='<tr>
							    <td>&nbsp;</td>
							    <td>&nbsp;</td>
							    <td colspan="2" align="right">TOTAL &nbsp;:</td>
							    <td  align="right">'.number_format($total, 0, ',', '.').'</td>
						    </tr>
					     
					    </tbody></table>
					    
					     
					    </td>
					    </tr>
					</tbody></table>
					
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
							</form>
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
		
		
function hapus(km, id)
{
	if (confirm("Delete ?"))
	{
		window.location.href = "form_kasir_detail?km=" + km + "&id=" + id + "&act=del";
	}
}

		
        </script>
		
';

    $title	= 'Detail Kasir CSO';
    $submenu	= "kas_masuk";
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