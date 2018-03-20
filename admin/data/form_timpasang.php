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
if($loggedin["group"] == 'admin'){


global $conn;

//log
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open Form OLT Customer");

$messages = '';


if(isset($_POST["save"]))
{
    $id_timpasang			= isset($_POST['id_timpasang']) ? mysql_real_escape_string(trim($_POST['id_timpasang'])) : '';
	$nama_timpasang			= isset($_POST['nama_timpasang']) ? mysql_real_escape_string(trim($_POST['nama_timpasang'])) : '';
	$idpegawai_timpasang	= isset($_POST['idpegawai_timpasang']) ? mysql_real_escape_string(trim($_POST['idpegawai_timpasang'])) : '';
    $namapegawai_timpasang	= isset($_POST['namapegawai_timpasang']) ? mysql_real_escape_string(trim($_POST['namapegawai_timpasang'])) : '';
    $macaddress				= isset($_POST['macaddress']) ? mysql_real_escape_string(trim($_POST['macaddress'])) : '';
	$sn						= isset($_POST['sn']) ? mysql_real_escape_string(trim($_POST['sn'])) : '';
	$userid					= isset($_POST['userid']) ? mysql_real_escape_string(trim($_POST['userid'])) : '';
    
    //insert into gx_inet_grouptime
    $sql_insert = "INSERT INTO `db_sbn`.`gx_timpasang` (`id_timpasang`, `nama_timpasang`, `idpegawai_timpasang`,
	`namapegawai_timpasang`, `macaddress`, `sn`, `userid`, `date_add`, `date_upd`, `user_upd`, `user_add`, `level`)
	VALUES (NULL, '".$nama_timpasang."', '".$idpegawai_timpasang."', '".$namapegawai_timpasang."', '".$macaddress."',
	'".$sn."', '".$userid."',
	NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."data/list_timpasang.php';
	</script>";
    
}
elseif(isset($_POST["update"]))
{
    $id_timpasang			= isset($_POST['id_timpasang']) ? mysql_real_escape_string(trim($_POST['id_timpasang'])) : '';
	$nama_timpasang			= isset($_POST['nama_timpasang']) ? mysql_real_escape_string(trim($_POST['nama_timpasang'])) : '';
	$idpegawai_timpasang	= isset($_POST['idpegawai_timpasang']) ? mysql_real_escape_string(trim($_POST['idpegawai_timpasang'])) : '';
    $namapegawai_timpasang	= isset($_POST['namapegawai_timpasang']) ? mysql_real_escape_string(trim($_POST['namapegawai_timpasang'])) : '';
    $macaddress				= isset($_POST['macaddress']) ? mysql_real_escape_string(trim($_POST['macaddress'])) : '';
	$sn						= isset($_POST['sn']) ? mysql_real_escape_string(trim($_POST['sn'])) : '';
	$userid					= isset($_POST['userid']) ? mysql_real_escape_string(trim($_POST['userid'])) : '';
    
    //update gx_inet_grouptime
    $sql_update = "UPDATE `db_sbn`.`gx_timpasang` SET  `nama_timpasang`='".$nama_timpasang."', `idpegawai_timpasang`='".$idpegawai_timpasang."',
	`namapegawai_timpasang`='".$namapegawai_timpasang."', `macaddress`='".$macaddress."', `sn`='".$sn."', `userid`='".$userid."',
	`date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
	WHERE (`id_timpasang`='".$id_timpasang."');";
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."data/list_timpasang.php';
	</script>";
	
}


if(isset($_GET["id"]))
{
    $id_data     = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $sql_data = mysql_query("SELECT * FROM `gx_timpasang` WHERE `id_timpasang` = '".$id_data."' LIMIT 0,1;", $conn);
    $row_data = mysql_fetch_array($sql_data);
    //echo "SELECT * FROM `gx_inet_olt_customer` WHERE `id_olt_customer` = '".$id_data."' AND `level` = '0' LIMIT 0,1;";
}

    $content =' <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Tim Pasang</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    '.$messages.'
                                    <form role="form" method="POST" action="" name="form_pasang">
                                    <div class="box-body">
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Nama Tim Pasang</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" name="nama_timpasang" value="'.(isset($_GET["id"]) ? $row_data["nama_timpasang"] : "").'">
												<input type="hidden" class="form-control" name="id_timpasang" value="'.(isset($_GET["id"]) ? $row_data["id_timpasang"] : "").'">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Leader Tim Pasang</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly="" class="form-control"  required="" name="idpegawai_timpasang" id="idpegawai_timpasang"
												placeholder="Kode Pegawai" value="'.(isset($_GET['id']) ? $row_data["idpegawai_timpasang"] : '').'"
												onclick="return valideopenerform(\'data_pegawai.php?r=form_pasang&f=data_pegawai\',\'data_pegawai\');">
                                            </div>
                                        </div>
                                        </div>
										<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Leader Tim Pasang</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly class="form-control" name="namapegawai_timpasang" value="'.(isset($_GET["id"]) ? $row_data["namapegawai_timpasang"] : "").'">
                                            </div>
											
                                        </div>
                                        </div>
										<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Mac Address ONU TEST</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text"  class="form-control" name="macaddress" value="'.(isset($_GET["id"]) ? $row_data["macaddress"] : "").'">
                                            </div>
											
                                        </div>
                                        </div>
										<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>SN ONU Test</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text"  class="form-control" name="sn" value="'.(isset($_GET["id"]) ? $row_data["sn"] : "").'">
                                            </div>
											
                                        </div>
                                        </div>
										<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Userid ONU Test</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text"  class="form-control" name="userid" value="'.(isset($_GET["id"]) ? $row_data["userid"] : "").'">
                                            </div>
											
                                        </div>
                                        </div>
										
										
					
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET["id"]) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '<!-- InputMask -->
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        
        <script type="text/javascript">
        $(function() {
                $("[data-mask]").inputmask();
            });

        </script>
    ';

    $title	= 'Form Tim Pasang';
    $submenu	= "inet_olt_customer";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>