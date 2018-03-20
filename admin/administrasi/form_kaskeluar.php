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
    $transaction_id		= isset($_POST['transaction_id']) ? mysql_real_escape_string(trim($_POST['transaction_id'])) : '';
    $tgl_transaction	= isset($_POST['tgl_transaction']) ? mysql_real_escape_string(trim($_POST['tgl_transaction'])) : '';
    $acc_cash			= isset($_POST['acc_cash']) ? mysql_real_escape_string(trim($_POST['acc_cash'])) : '';
    $mu			= isset($_POST['mu']) ? mysql_real_escape_string(trim($_POST['mu'])) : '';
    $rate		= isset($_POST['rate']) ? mysql_real_escape_string(trim($_POST['rate'])) : '';
    $remarks		= isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';
	$id_cabang = $loggedin['cabang'];
    
    if($transaction_id != ""){
    
	//insert into gxCabang
	$sql_insert = "INSERT INTO `gx_kas_keluar` (`id_kaskeluar`, `id_cabang`, `transaction_id`,
	`tgl_transaction`, `acc_cash`, `mu`, `rate`, `total`, `remarks`,
	`date_add`, `date_upd`, `user_upd`, `user_add`, `level`)
	VALUES (NULL, '".$id_cabang."', '".$transaction_id."', '".$tgl_transaction."', '".$acc_cash."', '".$mu."', '".$rate."', '', '".$remarks."',
	NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";                    
	
	//echo $sql_insert;
	mysql_query($sql_insert, $conn) or die (mysql_error());
	
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
	
	header("location: form_kk_detail.php?kk=".$transaction_id);
	
	/*echo "<script language='JavaScript'>
	    alert('Data telah disimpan');
	    window.location.href='form_keluar_detail.php?keluar=".$transaction_id."';
	    </script>";*/
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
}
elseif(isset($_POST["update"]))
{
    //echo "update";
    
    $id_kaskeluar 	= isset($_POST['id_kaskeluar']) ? mysql_real_escape_string(trim($_POST['id_kaskeluar'])) : '';
    $transaction_id		= isset($_POST['transaction_id']) ? mysql_real_escape_string(trim($_POST['transaction_id'])) : '';
    $tgl_transaction	= isset($_POST['tgl_transaction']) ? mysql_real_escape_string(trim($_POST['tgl_transaction'])) : '';
    $acc_cash			= isset($_POST['acc_cash']) ? mysql_real_escape_string(trim($_POST['acc_cash'])) : '';
    $mu			= isset($_POST['mu']) ? mysql_real_escape_string(trim($_POST['mu'])) : '';
    $rate		= isset($_POST['rate']) ? mysql_real_escape_string(trim($_POST['rate'])) : '';
    $remarks		= isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';
    
    if($transaction_id != "" AND $id_kaskeluar != ""){
	
	$sql_update = "UPDATE `gx_kas_keluar` SET `transaction_id`='".$transaction_id."',
	`tgl_transaction`='".$tgl_transaction."', `acc_cash`='".$acc_cash."', `mu`='".$mu."', `rate`='".$rate."',
	`remarks`='".$remarks."', 
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
	    
    }else{
	
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
	    
    }
	
}

if(isset($_GET["id"]))
{
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data = "SELECT * FROM `gx_kas_keluar` WHERE `id_kaskeluar`='".$id_data."' LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
    
}

$sql_cabang	= mysql_query("SELECT `gx_cabang`.`kode_cabang`, `gx_cabang`.`kode_kk` FROM `gx_cabang`, `gx_pegawai`
			      WHERE `gx_cabang`.`id_cabang` = `gx_pegawai`.`id_cabang`
			      AND `gx_pegawai`.`id_employee` = '".$loggedin["id_employee"]."' LIMIT 0,1;", $conn);
$row_cabang	= mysql_fetch_array($sql_cabang);

$sql_last_data 	= mysql_num_rows(mysql_query("SELECT `id_kaskeluar` FROM `gx_kas_keluar` WHERE `tgl_transaction` LIKE '%".date("Y-m-d")."%';", $conn));
$last_data  	= $sql_last_data + 1;
$tanggal    	= date("ymd");
$kode_data	= $row_cabang["kode_kk"].''.$tanggal.''.sprintf("%03d", $last_data);

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
                                <form action="" role="form" name="form_kk" id="form_kk" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Transaksi</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control"  id="transaction_id" name="transaction_id" required="" value="'.(isset($_GET['id']) ? $row_data["transaction_id"] : $kode_data).'">
							<input type="hidden" name="id_kaskeluar" value="'.(isset($_GET['id']) ? $row_data["id_kaskeluar"] : "").'">
						</div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" id="tgl_transaction" name="tgl_transaction" value="'.(isset($_GET['id']) ? $row_data["tgl_transaction"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Acc Cash</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" name="acc_cash" value="'.(isset($_GET['id']) ? $row_data["acc_cash"] : "").'"
						onclick="return valideopenerform(\'data_acc.php?r=form_kk&f=kk\',\'acc_cash\');">
					    </div>
					    
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
						<select name="mu" class="form-control">';

$sql_mu	= mysql_query("SELECT * FROM `gx_matauang`;", $conn);
while ($row_mu	= mysql_fetch_array($sql_mu)){
    $content .='<option value="'.$row_mu["kode_matauang"].'" '.((isset($_GET['id']) AND ($row_data["mu"] == $row_mu["kode_matauang"])) ? 'selected=""' : "").'>'.$row_mu["kode_matauang"].'</option>';
}

$content .='
						    
						</select>
						
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Rate</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="rate" value="'.(isset($_GET['id']) ? $row_data["rate"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control"  name="remarks" value="'.(isset($_GET['id']) ? $row_data["remarks"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_data["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Latest Updated By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_data["user_upd"]." ".$row_data["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Kas Keluar';
    $sukeluarenu	= "kas_keluar";
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