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
    $cKode       	= isset($_POST['cKode']) ? mysql_real_escape_string(trim($_POST['cKode'])) : '';
    $cNama       	= isset($_POST['cNama']) ? mysql_real_escape_string(trim($_POST['cNama'])) : '';
    $cNamaPers		= isset($_POST['cNamaPers']) ? mysql_real_escape_string(trim($_POST['cNamaPers'])) : '';
    $cAlamat1   	= isset($_POST['cAlamat1']) ? mysql_real_escape_string(trim($_POST['cAlamat1'])) : '';
    $cKota		= isset($_POST['cKota']) ? mysql_real_escape_string(trim($_POST['cKota'])) : '';
    $cDaerah		= isset($_POST['cDaerah']) ? mysql_real_escape_string(trim($_POST['cDaerah'])) : '';
    $ctelp		= isset($_POST['ctelp']) ? mysql_real_escape_string(trim($_POST['ctelp'])) : '';
    $cfax		= isset($_POST['cfax']) ? mysql_real_escape_string(trim($_POST['cfax'])) : '';
    $cContact		= isset($_POST['cContact']) ? mysql_real_escape_string(trim($_POST['cContact'])) : '';
    $nterm		= isset($_POST['nterm']) ? mysql_real_escape_string(trim($_POST['nterm'])) : '';
    $cKet		= isset($_POST['cKet']) ? mysql_real_escape_string(trim($_POST['cKet'])) : '';
    $cEmail		= isset($_POST['cEmail']) ? mysql_real_escape_string(trim($_POST['cEmail'])) : '';
    $cMailIntern 	= isset($_POST['cMailIntern']) ? mysql_real_escape_string(trim($_POST['cMailIntern'])) : '';
    $cUserID	 	= isset($_POST['cUserID']) ? mysql_real_escape_string(trim($_POST['cUserID'])) : '';
    $cNamaIbu	 	= isset($_POST['cNamaIbu']) ? mysql_real_escape_string(trim($_POST['cNamaIbu'])) : '';

    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $dTglMulai		= isset($_POST['dTglMulai']) ? mysql_real_escape_string(trim($_POST['dTglMulai'])) : '';
    $cNonAktiv		= isset($_POST['cNonAktiv']) ? mysql_real_escape_string(trim($_POST['cNonAktiv'])) : '';

    
    //insert into tbPegawai
    $sql_insert_customer = "INSERT INTO `tbCustomer` (`idCustomer`, `cKode`, `cNama`, `cNamaPers`, `cAlamat1`, 
	`cKota`, `cDaerah`, `ctelp`, `cfax`, `cContact`,
	`nterm`, `cKet`, `cEmail`, `cMailIntern`,
	`cUserID`, `cNamaIbu`, `dTglMulai`, `cNonAktiv`, 
	`id_cabang`, `paket_voip`, `paket_data`, `paket_video`, `gx_saldo`, `gx_tipe`,
	`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
	VALUES (NULL, '".$cKode."', '".$cNama."', '".$cNamaPers."', '".$cAlamat1."',
	'".$cKota."', '".$cDaerah."', '".$ctelp."', '".$cfax."', '".$cContact."',
	'".$nterm."', '".$cKet."', '".$cEmail."', '".$cMailIntern."', 
	'".$cUserID."', '".$cNamaIbu."', '".$dTglMulai."', '".$cNonAktiv."',
	'".$id_cabang."', '', '', '', '0', 'webgx',
	'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
        //echo $insert."<br>";
	
    //echo $sql_insert_customer;
    echo mysql_query($sql_insert_customer, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_customer);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master/customer.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $idCustomer       	= isset($_POST['idCustomer']) ? mysql_real_escape_string(trim($_POST['idCustomer'])) : '';
    $cKode       	= isset($_POST['cKode']) ? mysql_real_escape_string(trim($_POST['cKode'])) : '';
    $cNama       	= isset($_POST['cNama']) ? mysql_real_escape_string(trim($_POST['cNama'])) : '';
    $cNamaPers		= isset($_POST['cNamaPers']) ? mysql_real_escape_string(trim($_POST['cNamaPers'])) : '';
    $cAlamat1   	= isset($_POST['cAlamat1']) ? mysql_real_escape_string(trim($_POST['cAlamat1'])) : '';
    $cKota		= isset($_POST['cKota']) ? mysql_real_escape_string(trim($_POST['cKota'])) : '';
    $cDaerah		= isset($_POST['cDaerah']) ? mysql_real_escape_string(trim($_POST['cDaerah'])) : '';
    $ctelp		= isset($_POST['ctelp']) ? mysql_real_escape_string(trim($_POST['ctelp'])) : '';
    $cfax		= isset($_POST['cfax']) ? mysql_real_escape_string(trim($_POST['cfax'])) : '';
    $cContact		= isset($_POST['cContact']) ? mysql_real_escape_string(trim($_POST['cContact'])) : '';
    $nterm		= isset($_POST['nterm']) ? mysql_real_escape_string(trim($_POST['nterm'])) : '';
    $cKet		= isset($_POST['cKet']) ? mysql_real_escape_string(trim($_POST['cKet'])) : '';
    $cEmail		= isset($_POST['cEmail']) ? mysql_real_escape_string(trim($_POST['cEmail'])) : '';
    $cMailIntern 	= isset($_POST['cMailIntern']) ? mysql_real_escape_string(trim($_POST['cMailIntern'])) : '';
    $cUserID	 	= isset($_POST['cUserID']) ? mysql_real_escape_string(trim($_POST['cUserID'])) : '';
    $cNamaIbu	 	= isset($_POST['cNamaIbu']) ? mysql_real_escape_string(trim($_POST['cNamaIbu'])) : '';

    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $dTglMulai		= isset($_POST['dTglMulai']) ? mysql_real_escape_string(trim($_POST['dTglMulai'])) : '';
    $cNonAktiv		= isset($_POST['cNonAktiv']) ? mysql_real_escape_string(trim($_POST['cNonAktiv'])) : '';
    
    $idFoto		= isset($_POST['idFoto']) ? mysql_real_escape_string(trim($_POST['idFoto'])) : '';
    //Update into tbPegawai
    $sql_update_customer = "UPDATE `tbCustomer` SET `cKode` = '".$cKode."', `cNama` = '".$cNama."',
		    `cNamaPers` = '".$cNamaPers."', `cAlamat1` = '".$cAlamat1."',
		    `cKota` = '".$cKota."', `cDaerah` = '".$cDaerah."',
		    `ctelp` = '".$ctelp."', `cfax` = '".$cfax."', `cContact` = '".$cContact."',
		    `nterm` = '".$nterm."', `cKota` = '".$cKet."',
		    `cEmail` = '".$cEmail."', `cMailIntern` = '".$cMailIntern."',
		    `cUserID` = '".$cUserID."', `cNamaIbu` = '".$cNamaIbu."',
		    `dTglMulai` = '".$dTglMulai."', `cNonAktiv` = '".$cNonAktiv."',
		    `id_cabang` = '".$id_cabang."',
		    `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
		    WHERE `idCustomer` = '".$idCustomer."';";
    //echo $sql_update_customer;
    echo mysql_query($sql_update_customer, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_customer);

   
    /*echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."master/customer.php';
	</script>";*/
	
}

if(isset($_GET["id"]))
{
    $id_group		= isset($_GET['id']) ? $_GET['id'] : '';
    $query_group 	= "SELECT * FROM `gx_group` WHERE `id_group`='".$id_group."' AND `level` = '0' LIMIT 0,1;";
    $sql_group		= mysql_query($query_group, $conn);
    $row_group		= mysql_fetch_array($sql_group);
    
}


    
    $content ='<section class="content-header">
                    <h1>
                        Master Customer
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-7"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Form Customer</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cKode" value="'.(isset($_GET['id']) ? $row_customer["cKode"] : 'GNB-').'">
						<input type="hidden" name="idCustomer" value="'.(isset($_GET['id']) ? $row_customer["idCustomer"] : '').'" readonly="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Name</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cNama" value="'.(isset($_GET['id']) ? $row_customer["cNama"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Company Name</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cNamaPers" value="'.(isset($_GET['id']) ? $row_customer["cNamaPers"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Address</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" name="cAlamat1" cols="10" rows="6" style="resize:none;">'.(isset($_GET['id']) ? $row_customer["cAlamat1"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>City</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cKota" value="'.(isset($_GET['id']) ? $row_customer["cKota"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>State</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cDaerah" value="'.(isset($_GET['id']) ? $row_customer["cDaerah"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Phone</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="ctelp" value="'.(isset($_GET['id']) ? $row_customer["ctelp"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Fax</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cfax" value="'.(isset($_GET['id']) ? $row_customer["cfax"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Contact</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" required="" name="cContact" value="'.(isset($_GET['id']) ? $row_customer["cContact"] : "").'">
					    </div>
					    <div class="col-xs-2">
						<label>Term</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" required="" name="nterm" value="'.(isset($_GET['id']) ? $row_customer["nterm"] : "0").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cKet" value="'.(isset($_GET['id']) ? $row_customer["cKet"] : "").'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Email Address</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cEmail" value="'.(isset($_GET['id']) ? $row_customer["cEmail"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Email Intern</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cMailIntern" value="'.(isset($_GET['id']) ? $row_customer["cMailIntern"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>User ID</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cUserID" value="'.(isset($_GET['id']) ? $row_customer["cUserID"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Mother\'s Name</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cNamaIbu" value="'.(isset($_GET['id']) ? $row_customer["cNamaIbu"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Port Office</label>
					    </div>
					    <div class="col-xs-8">
						<select class="form-control required"  name="id_cabang" style="width:200px;">
						    <option value="">Choose one</option>';
						    
						    $sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `level` = '0';", $conn);
						    
						    while($row_cabang = mysql_fetch_array($sql_cabang))
						    {
							$content .='<option value="'.$row_cabang["id_cabang"].'" '.((isset($_GET["id"]) && $row_customer["id_cabang"] == $row_cabang["id_cabang"] ) ? 'selected="selected"' :"") .'>'.$row_cabang["nama_cabang"].'</option>';
						    }
						    
$content .='						</select>
					    </div>
                                        </div>
					</div>
					
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Activation Date</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="dTglMulai" value="'.(isset($_GET['id']) ? date("d-m-Y", strtotime($row_customer["dTglMulai"])) : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Status</label>
					    </div>
					    <div class="col-xs-8">
						<input class="required" type="radio" name="cNonAktiv" value="0" style="float:left;" '.((isset($_GET["id"]) && $row_customer["cNonAktiv"]== "0" ) ? "checked" :"") .'>Aktif
						<input class="required" type="radio" name="cNonAktiv" value="1" style="float:left;" '.((isset($_GET["id"]) && $row_customer["cNonAktiv"]== "1" ) ? "checked" :"") .'>NonAktif
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Customer';
    $submenu	= "master_customer";
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