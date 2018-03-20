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
    $kode_bk		= isset($_POST['kode_bk']) ? mysql_real_escape_string(trim($_POST['kode_bk'])) : '';
    $acc_bk		= isset($_POST['acc_bk']) ? mysql_real_escape_string(trim($_POST['acc_bk'])) : '';
    $nominal		= isset($_POST['nominal']) ? str_replace(",", "", $_POST['nominal']) : '';
    $kode_invoice	= isset($_POST['kode_invoice']) ? mysql_real_escape_string(trim($_POST['kode_invoice'])) : '';
    $title_invoice	= isset($_POST['title_invoice']) ? mysql_real_escape_string(trim($_POST['title_invoice'])) : '';
    $return_url		= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($kode_bk != ""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_bk_detail` (`id_bk_detail`, `id_bankkeluar`, `no_acc`,
    `kode_invoice`, `title`, `nominal`, `date_add`, `date_upd`, `user_upd`, `user_add`, `level`)
    VALUES (NULL, '".$kode_bk."', '".$acc_bk."', '".$kode_invoice."', '".$title_invoice."', '".$nominal."',
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
    $kode_bk		= isset($_POST['kode_bk']) ? mysql_real_escape_string(trim($_POST['kode_bk'])) : '';
    $acc_bk		= isset($_POST['acc_bk']) ? mysql_real_escape_string(trim($_POST['acc_bk'])) : '';
    $nominal		= isset($_POST['nominal']) ? str_replace(",", "", $_POST['nominal']) : '';
    $kode_invoice	= isset($_POST['kode_invoice']) ? mysql_real_escape_string(trim($_POST['kode_invoice'])) : '';
    $title_invoice	= isset($_POST['title_invoice']) ? mysql_real_escape_string(trim($_POST['title_invoice'])) : '';
    $return_url		= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($id != "" AND $kode_bk != ""){
    
    //Update into cc_subscription_service
    $sql_update = "UPDATE `gx_bk_detail` SET `id_bankkeluar`='".$kode_bk."', `no_acc`='".$acc_bk."', 
    `kode_invoice`='".$kode_invoice."',  `title`='".$title_invoice."',  `nominal`='".$nominal."', 
    `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE (`id_bk_detail`='".$id."');";
    

    
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
if(isset($_GET["bk"]))
{
    $kode_data	= isset($_GET['bk']) ? mysql_real_escape_string(strip_tags(trim($_GET['bk']))) : '';
    $query_data 	= "SELECT * FROM `gx_bank_keluar`
			    WHERE `transaction_id` = '".$kode_data."'
			    LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
   
    
    $return_url = 'form_bk_detail.php?bk='.$kode_data;
    
}


    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Bank Keluar</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Transaksi</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bk']) ? $row_data["transaction_id"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bk']) ? $row_data["tgl_transaction"] : date("Y-m-d")).'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Bank</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bk']) ? $row_data["bank_code"] : "").'
						
					    </div>
					    <div class="col-xs-3">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bk']) ? $row_data["id_customer"] : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC Kredit</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bk']) ? $row_data["acc_credit"] : "").'
					    </div>
					    <div class="col-xs-3">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['bk']) ? $row_data["nama"] : "").'
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
						'.((isset($_GET['bk'])) ? $row_data["mu"] : "").'
						
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Rate</label>
					    </div>
					    <div class="col-xs-3">
					        '.(isset($_GET['bk']) ? $row_data["rate"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks</label>
                                            </div>
					    <div class="col-xs-9">
						'.(isset($_GET['bk']) ? $row_data["remarks"] : "").'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_bankkeluar["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Latest Updated By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_bankkeluar["user_upd"]." ".$row_bankkeluar["date_upd"] : "").'
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
							      <th>#</th>
							    </tr>';
if(isset($_GET["bk"]))
{
    $id_bankkeluar	= $row_data["id_bankkeluar"];
    $query_item	= "SELECT * FROM `gx_bk_detail` WHERE `id_bankkeluar` ='".$id_bankkeluar."';";
    $sql_item	= mysql_query($query_item, $conn);
    
    $id_bk_detail  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_detail = "SELECT * FROM `gx_bk_detail` WHERE `id_bankkeluar` ='".$id_bankkeluar."' AND `id_bk_detail` = '".$id_bk_detail."' LIMIT 0,1;";
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
	<td><a href="form_bk_detail?bk='.$kode_data.'&id='.$row_item["id_bk_detail"].'"><span class="label label-info">Edit</span></a>
	<a href="form_bk_detail?bk='.$kode_data.'&id='.$row_item["id_bk_detail"].'&act=del"><span class="label label-danger">Hapus</span></a>
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
                                    <h3 class="box-title">FORM BANK KELUAR ITEM</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_bk_item" id="form_bk_item" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Invoice</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="kode_invoice" value="'.(isset($_GET['bk']) ? $row_detail["kode_invoice"] : "").'" readonly=""
						placeholder="Search Invoice" onclick="return valideopenerform(\'data_invoice.php?r=form_bk_item&f=bkd&c='.$row_data["id_customer"].'\',\'bkd\');">
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_detail["id_bk_detail"] : '').'" readonly="">
						<input type="hidden" name="kode_bk" value="'.(isset($_GET['bk']) ? $row_data["id_bankkeluar"] : '').'" readonly="">
						
						<input type="hidden" name="return_url" value="'.$return_url.'" readonly="">
						
					    </div>
					   
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Invoice</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="title_invoice" value="'.(isset($_GET['id']) ? $row_detail["title"] : "").'" readonly="">
					    </div>
					   
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>ACC</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required name="acc_bk" value="'.(isset($_GET['id']) ? $row_detail["no_acc"] : "").'" >
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
						'.(isset($_GET['id']) ? $row_invoice_detail["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_invoice_detail["user_upd"]." ".$row_invoice_detail["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="subkit" value="Subkit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Subkit</button>
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

    $title	= 'Form Bank Keluar Detail';
    $subkenu	= "master_bankkeluar";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$subkenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>