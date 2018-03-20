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
    //echo "save";
    $transaction_id    = isset($_POST['transaction_id']) ? mysql_real_escape_string(trim($_POST['transaction_id'])) : '';
    $tgl_transaction    = isset($_POST['tgl_transaction']) ? mysql_real_escape_string(trim($_POST['tgl_transaction'])) : '';
    $acc_cash  	= isset($_POST['acc_cash']) ? mysql_real_escape_string(trim($_POST['acc_cash'])) : '';
    $mu    	= isset($_POST['mu']) ? mysql_real_escape_string(trim($_POST['mu'])) : '';
    $rate    	= isset($_POST['rate']) ? mysql_real_escape_string(trim($_POST['rate'])) : '';
    $total   	= isset($_POST['total']) ? mysql_real_escape_string(trim($_POST['total'])) : '';
    $remarks	= isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';
    
    //insert into gxCabang
    $sql_insert = "INSERT INTO `gx_kas_keluar` (`id_kaskeluar`, `transaction_id`, `tgl_transaction`,
    `acc_cash`, `mu`, `rate`, `total`, `remarks`, `date_add`, `date_upd`, `user_upd`, `user_add`, `level`)
    VALUES (NULL, '".$transaction_id."', '".$tgl_transaction."', '".$acc_cash."', '".$mu."', '".$rate."',
    '".$total."', '".$remarks."',
    NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='master_kaskeluar.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    
    $id_kaskeluar	= isset($_POST['id_kaskeluar']) ? mysql_real_escape_string(trim($_POST['id_kaskeluar'])) : '';
    $transaction_id	= isset($_POST['transaction_id']) ? mysql_real_escape_string(trim($_POST['transaction_id'])) : '';
    $tgl_transaction    = isset($_POST['tgl_transaction']) ? mysql_real_escape_string(trim($_POST['tgl_transaction'])) : '';
    $acc_cash  	= isset($_POST['acc_cash']) ? mysql_real_escape_string(trim($_POST['acc_cash'])) : '';
    $mu    	= isset($_POST['mu']) ? mysql_real_escape_string(trim($_POST['mu'])) : '';
    $rate    	= isset($_POST['rate']) ? mysql_real_escape_string(trim($_POST['rate'])) : '';
    $total   	= isset($_POST['total']) ? mysql_real_escape_string(trim($_POST['total'])) : '';
    $remarks	= isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';
    
    
    $sql_update = "UPDATE `gx_kas_keluar` SET `transaction_id`='".$transaction_id."',
		    `tgl_transaction`='".$tgl_transaction."', `acc_cash`='".$acc_cash."', `mu`='".$mu."', `rate`='".$rate."',
		    `total`='".$total."', `remarks`='".$remarks."',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE (`id_kaskeluar`='".$id_kaskeluar."');";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='master_kaskeluar.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_kaskeluar	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_kaskeluar 	= "SELECT * FROM `gx_kas_keluar` WHERE `id_kaskeluar`='$id_kaskeluar' LIMIT 0,1;";
    $sql_kaskeluar	= mysql_query($query_kaskeluar, $conn);
    $row_kaskeluar	= mysql_fetch_array($sql_kaskeluar);
    
}
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Kas Keluar</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Transaksi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" id="transaction_id" name="transaction_id" required="" value="'.(isset($_GET['id']) ? $row_kaskeluar["transaction_id"] : "").'">
						<input type="hidden" id="id_kaskeluar" name="id_kaskeluar" value="'.(isset($_GET['id']) ? $row_kaskeluar["id_kaskeluar"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" id="tgl_transaction" name="tgl_transaction" required="" value="'.(isset($_GET['id']) ? $row_kaskeluar["tgl_transaction"] : "").'">
					    </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC Cash</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="acc_cash" value="'.(isset($_GET['id']) ? $row_kaskeluar["acc_cash"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="mu" value="'.(isset($_GET['id']) ? $row_kaskeluar["mu"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Rate</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="rate" value="'.(isset($_GET['id']) ? $row_kaskeluar["rate"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control"  name="remarks" value="'.(isset($_GET['id']) ? $row_kaskeluar["remarks"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>No</th>
                                                <th>No ACC</th>
                                                <th>No Jual</th>
                                                <th>Keterangan</th>
						<th>Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					
					for($inv=1; $inv <=10; $inv++){
					
					    $content .='<tr>
						<td>'.$inv.'.</td>
						<td><input type="text" class="form-control" name="no_acc'.$inv.'" value=""></td>
						<td><input type="text" class="form-control" name="no_jual'.$inv.'" value=""></td>
						<td><input type="text" class="form-control" name="ket'.$inv.'" value=""></td>
						<td><input type="text" class="form-control" name="nominal'.$inv.'" value=""></td>
					    </tr>';
					}
					
$content .='
					    <tr>
						<td colspan="4">Total</td>
						<td><input type="text" class="form-control" name="total" value=""></td>
						
					    </tr>
					</tbody>
                                    </table>
				    
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						&nbsp;
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_kaskeluar["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_kaskeluar["user_upd"]." ".$row_kaskeluar["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="sukeluarit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Sukeluarit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Kas Keluar';
    $sukeluarenu	= "kaskeluar";
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