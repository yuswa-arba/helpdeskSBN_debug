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
		$conn_soft = Config::getInstanceSoft();

if(isset($_GET["bm"]))
{
    $kode_data	= isset($_GET['bm']) ? mysql_real_escape_string(strip_tags(trim($_GET['bm']))) : '';
    $query_data 	= "SELECT * FROM `v_bankmasuk_sbn`
			    WHERE `transaction_id` = '".$kode_data."' AND
				`id_cabang` = '".$loggedin['cabang']."'
			    LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
   
    
    $return_url = 'form_bm_detail.php?bm='.$kode_data;
    
}


    $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<section class="col-lg-9">
						<form action="" role="form" name="form_bm" id="form_bm" method="post" enctype="multipart/form-data">
						
						<input type="hidden" name="id_customer" value="'.(isset($_GET['bm']) ? $row_data["id_customer"] : "").'" readonly="">
						<input type="hidden" name="transaction_id" value="'.(isset($_GET['bm']) ? $row_data["transaction_id"] : "").'" readonly="">
						
						
						<div class="box box-solid box-info">
							<div class="box-header">
								<h3 class="box-title">Data Bank Masuk</h3>
							</div><!-- /.box-header -->
								<div class="box-body">
								
							<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Transaksi</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bm']) ? $row_data["transaction_id"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bm']) ? $row_data["tgl_transaction"] : date("Y-m-d")).'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Bank</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bm']) ? $row_data["bank_code"] : "").'
						
					    </div>
					    <div class="col-xs-3">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bm']) ? $row_data["id_customer"] : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC Kredit</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bm']) ? $row_data["acc_credit"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bm']) ? $row_data["cNama"] : "").'
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
						'.((isset($_GET['bm'])) ? $row_data["mu"] : "").'
						
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Rate</label>
					    </div>
					    <div class="col-xs-3">
					        '.(isset($_GET['bm']) ? $row_data["rate"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks</label>
                                            </div>
					    <div class="col-xs-9">
						'.(isset($_GET['bm']) ? $row_data["remarks"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['bm']) ? $row_data["user_add"] ." on".$row_data["date_add"]: $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Latest Updated By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['bm']) ? $row_data["user_upd"]." on".$row_data["date_upd"] : "").'
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
							      <th>Invoice Number</th>
							      <th>Invoice Name</th>
							      <th>Nominal</th>
							      <!--<th>#</th>-->
							    </tr>';
if(isset($_GET["bm"]))
{
    $id_bankmasuk	= $row_data["id_bankmasuk"];
    $query_item	= "SELECT * FROM `gx_bm_detail` WHERE `id_bankmasuk` ='".$id_bankmasuk."';";
    $sql_item	= mysql_query($query_item, $conn);
    
    $id_bm_detail  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_detail = "SELECT * FROM `gx_bm_detail` WHERE `id_bankmasuk` ='".$id_bankmasuk."' AND `id_bm_detail` = '".$id_bm_detail."' LIMIT 0,1;";
    $sql_detail   = mysql_query($query_detail, $conn);
    $row_detail = mysql_fetch_array($sql_detail);
    
    $no = 1;
    $total = 0;
    
    while($row_item = mysql_fetch_array($sql_item))
    {
    
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_item["no_acc"].'</td>
	<td>'.$row_item["kode_invoice"].'</td>
	<td>'.$row_item["title"].'</td>
	<td>'.number_format($row_item["nominal"], 0, ',', '.').'</td>
	<!--<td><a href="form_bm_detail?bm='.$kode_data.'&id='.$row_item["id_bm_detail"].'"><span class="label label-info">Edit</span></a>
	<a href="form_bm_detail?bm='.$kode_data.'&id='.$row_item["id_bm_detail"].'&act=del"><span class="label label-danger">Hapus</span></a>
	</td>-->
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
							    <!--<td>&nbsp;</td>-->
						    </tr>
					     
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

    $title	= 'Detail Bank Masuk';
    $submenu	= "master_bankmasuk";
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