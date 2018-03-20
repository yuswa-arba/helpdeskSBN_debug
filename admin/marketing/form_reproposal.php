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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Allowance");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT `gx_allowance`.*, `gx_pegawai`.`nama` FROM `gx_allowance`, `gx_pegawai` WHERE `id_allowance` = '".$id_data."' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
}

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Data</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kode Pegawai</label>
											</div>
											<div class="col-xs-3">
												<input type="hidden" class="form-control" id="id_allowance" name="id_allowance" readonly="" value="'.(isset($_GET['id']) ? $row_data["id_allowance"] : "").'" >
												<input type="text" class="form-control" id="kode_pegawai" name="kode_pegawai" readonly="" value="'.(isset($_GET['id']) ? $row_data["kode_pegawai"] : "").'"
												 onclick="return valideopenerform(\'data_pegawai.php?r=myForm&f=pegawai\',\'pegawai\');">
                                            </div>
											
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Pegawai</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" required="" value="'.(isset($_GET['id']) ? $row_data["nama_pegawai"] : "").'" >
											</div>
											
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Golongan</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="golongan" name="golongan" required="" value="'.(isset($_GET['id']) ? $row_data["golongan"] : "").'">
											</div>
											
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Allowance</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="allowance" name="allowance" required="" value="'.(isset($_GET['id']) ? $row_data["allowance"] : "").'">
											</div>
											<div class="col-xs-6">
												% dari HET
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
												<label>Latest Update By </label>
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
			

if(isset($_POST["save"]))
{
    //echo "save";
    $kode_pegawai	   	= isset($_POST['kode_pegawai']) ? mysql_real_escape_string(trim($_POST['kode_pegawai'])) : '';
	$nama_pegawai  		= isset($_POST['nama_pegawai']) ? mysql_real_escape_string(trim($_POST['nama_pegawai'])) : '';
	$golongan    		= isset($_POST['golongan']) ? mysql_real_escape_string(trim($_POST['golongan'])) : '';
    $allowance			= isset($_POST['allowance']) ? mysql_real_escape_string(trim($_POST['allowance'])) : '';
	
	$sql_insert = "INSERT INTO `gx_allowance` (`id_allowance`, `kode_pegawai`, `nama_pegawai`,
						  `golongan`, `allowance`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_pegawai."', '".$nama_pegawai."',
						  '".$golongan."', '".$allowance."',
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."marketing/master_allowance.php';
			</script>";
			
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    $id_allowance	   	= isset($_POST['id_allowance']) ? mysql_real_escape_string(trim($_POST['id_allowance'])) : '';
	$kode_pegawai	   	= isset($_POST['kode_pegawai']) ? mysql_real_escape_string(trim($_POST['kode_pegawai'])) : '';
	$nama_pegawai  		= isset($_POST['nama_pegawai']) ? mysql_real_escape_string(trim($_POST['nama_pegawai'])) : '';
	$golongan    		= isset($_POST['golongan']) ? mysql_real_escape_string(trim($_POST['golongan'])) : '';
    $allowance			= isset($_POST['allowance']) ? mysql_real_escape_string(trim($_POST['allowance'])) : '';
	
    $sql_update = "UPDATE `software`.`gx_allowance` SET `kode_pegawai`='".$kode_pegawai."', `nama_pegawai`='".$nama_pegawai."',
			`golongan`='".$golongan."', `allowance`='".$allowance."',  
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_allowance` = '".$id_allowance."';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."marketing/master_allowance.php';
			</script>";
			
}

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
	<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: \'\',
		thousandsSeparator: \',\',
		centsLimit: 0
	    });
        </script>
		';

    $title	= 'Form Allowance';
    $submenu	= "allowance";
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