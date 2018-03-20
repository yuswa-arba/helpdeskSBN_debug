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
    if($loggedin["group"] == 'admin')
    {
        global $conn;
    
if(isset($_POST["save"]))
{
    //echo "save";
	//$id_transaksi			= isset($_POST['id_transaksi']) ? mysql_real_escape_string(trim($_POST['id_transaksi'])) : '';
	$nomer_transaksi		= isset($_POST['nomer_transaksi']) ? mysql_real_escape_string(trim($_POST['nomer_transaksi'])) : '';
	$tanggal_transaksi		= isset($_POST['tanggal_transaksi']) ? mysql_real_escape_string(trim($_POST['tanggal_transaksi'])) : '';
	$tipe_transaksi			= isset($_POST['tipe_transaksi']) ? mysql_real_escape_string(trim($_POST['tipe_transaksi'])) : '';
	$idbank_transaksi		= isset($_POST['idbank_transaksi']) ? mysql_real_escape_string(trim($_POST['idbank_transaksi'])) : '';
	$noacc_transaksi		= isset($_POST['noacc_transaksi']) ? mysql_real_escape_string(trim($_POST['noacc_transaksi'])) : '';
	$idcustomer_transaksi	= isset($_POST['idcustomer_transaksi']) ? mysql_real_escape_string(trim($_POST['idcustomer_transaksi'])) : '';
	$mu_transaksi			= isset($_POST['mu_transaksi']) ? mysql_real_escape_string(trim($_POST['mu_transaksi'])) : '';
	$rate_transaksi			= isset($_POST['rate_transaksi']) ? mysql_real_escape_string(trim($_POST['rate_transaksi'])) : '';
	$remark_transaksi		= isset($_POST['remark_transaksi']) ? mysql_real_escape_string(trim($_POST['remark_transaksi'])) : '';
	$ppn_transaksi			= isset($_POST['ppn_transaksi']) ? mysql_real_escape_string(trim($_POST['ppn_transaksi'])) : '';
	$total_transaksi		= isset($_POST['total_transaksi']) ? mysql_real_escape_string(trim($_POST['total_transaksi'])) : '';
	$gtotal_transaksi		= isset($_POST['gtotal_transaksi']) ? mysql_real_escape_string(trim($_POST['gtotal_transaksi'])) : '';
	$status_transaksi		= isset($_POST['status_transaksi']) ? mysql_real_escape_string(trim($_POST['status_transaksi'])) : '';
	$posting_transaksi		= isset($_POST['posting_transaksi']) ? mysql_real_escape_string(trim($_POST['posting_transaksi'])) : '';
	$void_transaksi			= isset($_POST['void_transaksi']) ? mysql_real_escape_string(trim($_POST['void_transaksi'])) : '';
	
    
    if($transaction_id != ""){
    
		//insert into gxCabang
		$sql_insert = "INSERT INTO `gx_transaksi` (`id_transaksi`, `nomer_transaksi`, `tanggal_transaksi`,
		`tipe_transaksi`, `idbank_transaksi`, `noacc_transaksi`, `idcustomer_transaksi`, `mu_transaksi`,
		`rate_transaksi`, `remark_transaksi`, `ppn_transaksi`, `total_transaksi`, `gtotal_transaksi`,
		`status_transaksi`, `posting_transaksi`, `void_transaksi`,
		`date_add`, `date_upd`, `user_upd`, `user_add`, `level`)
		VALUES (NULL, '".$nomer_transaksi."','".$tanggal_transaksi."',
		'".$tipe_transaksi."','".$idbank_transaksi."','".$noacc_transaksi."','".$idcustomer_transaksi."','".$mu_transaksi."',
		'".$rate_transaksi."','".$remark_transaksi."','".$ppn_transaksi."','".$total_transaksi."','".$gtotal_transaksi."',
		'".$status_transaksi."','".$posting_transaksi."','".$void_transaksi."',
		NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";                    
		
		//echo $sql_insert;
		mysql_query($sql_insert, $conn) or die (mysql_error());
		
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
		
		header("location: form_bm_detail.php?bm=".$transaction_id);
		/*echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='form_bm_detail.php?bm=".$transaction_id."';
			</script>";*/
    }else{
		echo "<script language='JavaScript'>
			alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
			</script>";
    }
}elseif(isset($_POST["update"]))
{
    //echo "update";
    
    $id_transaksi			= isset($_POST['id_transaksi']) ? mysql_real_escape_string(trim($_POST['id_transaksi'])) : '';
	$nomer_transaksi		= isset($_POST['nomer_transaksi']) ? mysql_real_escape_string(trim($_POST['nomer_transaksi'])) : '';
	$tanggal_transaksi		= isset($_POST['tanggal_transaksi']) ? mysql_real_escape_string(trim($_POST['tanggal_transaksi'])) : '';
	$tipe_transaksi			= isset($_POST['tipe_transaksi']) ? mysql_real_escape_string(trim($_POST['tipe_transaksi'])) : '';
	$idbank_transaksi		= isset($_POST['idbank_transaksi']) ? mysql_real_escape_string(trim($_POST['idbank_transaksi'])) : '';
	$noacc_transaksi		= isset($_POST['noacc_transaksi']) ? mysql_real_escape_string(trim($_POST['noacc_transaksi'])) : '';
	$idcustomer_transaksi	= isset($_POST['idcustomer_transaksi']) ? mysql_real_escape_string(trim($_POST['idcustomer_transaksi'])) : '';
	$mu_transaksi			= isset($_POST['mu_transaksi']) ? mysql_real_escape_string(trim($_POST['mu_transaksi'])) : '';
	$rate_transaksi			= isset($_POST['rate_transaksi']) ? mysql_real_escape_string(trim($_POST['rate_transaksi'])) : '';
	$remark_transaksi		= isset($_POST['remark_transaksi']) ? mysql_real_escape_string(trim($_POST['remark_transaksi'])) : '';
	$ppn_transaksi			= isset($_POST['ppn_transaksi']) ? mysql_real_escape_string(trim($_POST['ppn_transaksi'])) : '';
	$total_transaksi		= isset($_POST['total_transaksi']) ? mysql_real_escape_string(trim($_POST['total_transaksi'])) : '';
	$gtotal_transaksi		= isset($_POST['gtotal_transaksi']) ? mysql_real_escape_string(trim($_POST['gtotal_transaksi'])) : '';
	$status_transaksi		= isset($_POST['status_transaksi']) ? mysql_real_escape_string(trim($_POST['status_transaksi'])) : '';
	$posting_transaksi		= isset($_POST['posting_transaksi']) ? mysql_real_escape_string(trim($_POST['posting_transaksi'])) : '';
	$void_transaksi			= isset($_POST['void_transaksi']) ? mysql_real_escape_string(trim($_POST['void_transaksi'])) : '';
    
    if($transaction_id != "" AND $id_transaksi != ""){
	
	$sql_update = "UPDATE `gx_transaksi` SET `idbank_transaksi`='".$idbank_transaksi."', 
			`noacc_transaksi`='".$noacc_transaksi."', `idcustomer_transaksi`='".$idcustomer_transaksi."', `mu_transaksi`='".$mu_transaksi."',
			`rate_transaksi`='".$rate_transaksi."', `remark_transaksi`='".$remark_transaksi."',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE (`id_transaksi`='".$id_transaksi."');";
    
	//echo $sql_update;
	mysql_query($sql_update, $conn) or die (mysql_error());
	
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
	
	echo "<script language='JavaScript'>
	    alert('Data telah diupdate.');
	    window.location.href='master_transaksi.php';
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
    $id_transaksi	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_transaksi 	= "SELECT * FROM `v_transaksi` WHERE `id_transaksi`='".$id_transaksi."' LIMIT 0,1;";
    $sql_transaksi	= mysql_query($query_transaksi, $conn);
    $row_transaksi	= mysql_fetch_array($sql_transaksi);
    
}

$sql_cabang	= mysql_query("SELECT `gx_cabang`.`kode_cabang`, `gx_cabang`.`kode_bm` FROM `gx_cabang`, `gx_pegawai`
			      WHERE `gx_cabang`.`id_cabang` = `gx_pegawai`.`id_cabang`
			      AND `gx_pegawai`.`id_employee` = '".$loggedin["id_employee"]."' LIMIT 0,1;", $conn);
$row_cabang	= mysql_fetch_array($sql_cabang);

$sql_last_data 	= mysql_fetch_array(mysql_query("SELECT COUNT(`id_transaksi`) as `total` FROM `gx_transaksi`;", $conn));
$last_data  	= $sql_last_data["total"] + 1;
$tanggal    	= date("ymd");
$kode_data	= 'SBN-BM'.$tanggal.''.sprintf("%03d", $last_data);

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Bank Masuk</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_bm" id="form_bm" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Transaksi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" id="nomer_transaksi" name="nomer_transaksi" required="" value="'.(isset($_GET['id']) ? $row_transaksi["nomer_transaksi"] : $kode_data).'">
					    
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" id="tanggal_transaksi" name="tanggal_transaksi" required="" value="'.(isset($_GET['id']) ? $row_transaksi["tanggal_transaksi"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Bank</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" name="idbank_transaksi" id="kode_bank" value="'.(isset($_GET['id']) ? $row_transaksi["bank_code"] : "").'"
						placeholder="Search Bank" onclick="return valideopenerform(\'data_bank.php?r=form_bm&f=bm\',\'bm\');">
						
					    </div>
					    <div class="col-xs-3">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" name="idcustomer_transaksi" id="id_customer" placeholder="Kode Customer" onclick="return valideopenerform(\'data_cust.php?r=form_bm&f=bm\',\'bm\');"
						value="'.(isset($_GET['id']) ? $row_transaksi["id_customer"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						
					    </div>
					    <div class="col-xs-3">
						
					    </div>
					    <div class="col-xs-3">
							<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" name="nama" placeholder="Nama Customer" onclick="return valideopenerform(\'data_cust.php?r=form_bm&f=bm\',\'bm\');"
						value="'.(isset($_GET['id']) ? $row_transaksi["nama"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC Kredit</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="acc_bank" value="'.(isset($_GET['id']) ? $row_transaksi["acc_credit"] : "").'">
					    </div>
					    
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="nama_acc" value="'.(isset($_GET['id']) ? $row_transaksi["nama_acc"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
						<select name="mu_transaksi" class="form-control">';

$sql_mu	= mysql_query("SELECT * FROM `gx_matauang`;", $conn);
while ($row_mu	= mysql_fetch_array($sql_mu)){
    $content .='<option value="'.$row_mu["kode_matauang"].'" '.((isset($_GET['id']) AND ($row_transaksi["mu"] == $row_mu["kode_matauang"])) ? 'selected=""' : "").'>'.$row_mu["kode_matauang"].'</option>';
}

$content .='
						    
						</select>
						
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Rate</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="rate_transaksi" value="'.(isset($_GET['id']) ? $row_transaksi["rate"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control"  name="remarks" value="'.(isset($_GET['id']) ? $row_transaksi["remarks"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_transaksi["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Latest Updated By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_transaksi["user_upd"]." ".$row_transaksi["date_upd"] : "").'
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

    $title	= 'Form Bank Masuk';
    $submenu	= "transaksi";
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