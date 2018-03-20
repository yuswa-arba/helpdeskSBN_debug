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
    
if(isset($_POST["save"]))
{
    $kode_kk		= isset($_POST['kode_kk']) ? mysql_real_escape_string(trim($_POST['kode_kk'])) : '';
    $no_jual		= isset($_POST['no_jual']) ? mysql_real_escape_string(trim($_POST['no_jual'])) : '';
    $no_acc			= isset($_POST['no_acc']) ? mysql_real_escape_string(trim($_POST['no_acc'])) : '';
    $nominal		= isset($_POST['nominal']) ? str_replace(",", "", $_POST['nominal']) : '';
    $keterangan		= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
    $return_url		= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($kode_kk != ""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_kk_detail` (`id_kk_detail`, `id_kaskeluar`,
	`no_acc`, `no_jual`, `keterangan`, `nominal`,
	`date_add`, `date_upd`, `user_upd`, `user_add`, `level`)
	VALUES (NULL, '".$kode_kk."', '".$no_acc."', '".$no_jual."', '".$keterangan."', '".$nominal."',
    NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    //echo $sql_insert;
    echo mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."administrasi/".$return_url."';
	</script>";
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
}elseif(isset($_POST["update"]))
{
    $id       		= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    $kode_kk		= isset($_POST['kode_kk']) ? mysql_real_escape_string(trim($_POST['kode_kk'])) : '';
    $no_jual		= isset($_POST['no_jual']) ? mysql_real_escape_string(trim($_POST['no_jual'])) : '';
    $no_acc			= isset($_POST['no_acc']) ? mysql_real_escape_string(trim($_POST['no_acc'])) : '';
    $nominal		= isset($_POST['nominal']) ? str_replace(",", "", $_POST['nominal']) : '';
    $keterangan		= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
    $return_url		= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($id != "" AND $kode_kk != ""){
    
    //Update into cc_subscription_service
    $sql_update = "UPDATE `gx_kk_detail` SET `id_kaskeluar`='".$kode_kk."', `no_acc`='".$no_acc."',
	`no_jual`='".$no_jual."', `keterangan`='".$keterangan."', `nominal`='".$nominal."',
	`date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE (`id_kk_detail`='".$id."');";
    

    
    //echo $sql_update;
    echo mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);

   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".$return_url."';
	</script>";
	
    }else{
	
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
}
$return_url = "";
if(isset($_GET["kk"]))
{
    $kode_data	= isset($_GET['kk']) ? mysql_real_escape_string(strip_tags(trim($_GET['kk']))) : '';
    $query_data 	= "SELECT * FROM `gx_kas_keluar`
			    WHERE `transaction_id` = '".$kode_data."'
			    LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
   
    
    $return_url = 'form_kk_detail.php?kk='.$kode_data;
    
}


    $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Kas Keluar</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Transaksi</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control" readonly="" id="transaction_id" name="transaction_id" required="" value="'.(isset($_GET['kk']) ? $row_data["transaction_id"] : "").'">
							<input type="hidden" name="id_kaskeluar" value="'.(isset($_GET['kk']) ? $row_data["id_kaskeluar"] : "").'">
						</div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" id="tgl_transaction" name="tgl_transaction" value="'.(isset($_GET['kk']) ? $row_data["tgl_transaction"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Acc Cash</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" name="acc_cash" value="'.(isset($_GET['kk']) ? $row_data["acc_cash"] : "").'">
					    </div>
					    
                    </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" name="mu" value="'.((isset($_GET['kk'])) ? $row_data["mu"] : "").'">
						
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Rate</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control" readonly="" name="rate" value="'.(isset($_GET['kk']) ? $row_data["rate"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" readonly name="remarks" value="'.(isset($_GET['kk']) ? $row_data["remarks"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks</label>
                                            </div>
					    <div class="col-xs-9">
						'.(isset($_GET['kk']) ? $row_data["remarks"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['kk']) ? $row_data["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Latest Updated By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['kk']) ? $row_data["user_upd"]." on ".$row_data["date_upd"] : "").'
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
							      <th>#</th>
							    </tr>';
if(isset($_GET["kk"]))
{
    $id_kaskeluar	= $row_data["id_kaskeluar"];
    $query_item	= "SELECT * FROM `gx_kk_detail` WHERE `id_kaskeluar` ='".$id_kaskeluar."';";
    $sql_item	= mysql_query($query_item, $conn);
    
    $id_kk_detail  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_detail = "SELECT * FROM `gx_kk_detail` WHERE `id_kaskeluar` ='".$id_kaskeluar."' AND `id_kk_detail` = '".$id_kk_detail."' LIMIT 0,1;";
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
	<td><a href="form_kk_detail?kk='.$kode_data.'&id='.$row_item["id_kk_detail"].'"><span class="label label-info">Edit</span></a>
	</td>
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
							    <td>&nbsp;</td>
						    </tr>
					     
					    </tbody></table>
					    
					     
					    </td>
					    </tr>
					</tbody></table>
					
                                    </div><!-- /.box-body -->
				    
				   
                            </div><!-- /.box -->
                        </section>
                        <section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">FORM KAS MASUK ITEM</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_kk_item" id="form_kk_item" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>No Jual</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="no_jual" value="'.(isset($_GET['kk']) ? $row_detail["no_jual"] : "").'" >
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_detail["id_kk_detail"] : '').'" readonly="">
						<input type="hidden" name="kode_kk" value="'.(isset($_GET['kk']) ? $row_data["id_kaskeluar"] : '').'" readonly="">
						
						<input type="hidden" name="return_url" value="'.$return_url.'" readonly="">
						
					    </div>
					   
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>ACC</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="no_acc" value="'.(isset($_GET['id']) ? $row_detail["no_acc"] : "").'"
						onclick="return valideopenerform(\'data_acc.php?r=form_kk_item&f=no_acc\',\'acc_cash\');">
						<input type="hidden" class="form-control" readonly="" name="nama_acc" value="">
					    </div>
					   
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="keterangan"  value="'.(isset($_GET['id']) ? $row_detail["keterangan"] : "").'">
					    </div>
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nominal</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="nominal" id="harga" value="'.(isset($_GET['id']) ? $row_detail["nominal"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_detail["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_detail["user_upd"]." on ".$row_detail["date_upd"] : "").'
					    </div>
                                        
                        </div>
					</div>
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Sukeluarit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
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

    $title	= 'Form Kas Keluar Detail';
    $sukeluarenu	= "master_bankkeluar";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$sukeluarenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>