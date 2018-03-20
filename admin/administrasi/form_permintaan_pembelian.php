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
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $nama_cabang	= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_permintaan_pembelian	= isset($_POST['kode_permintaan_pembelian']) ? mysql_real_escape_string(trim($_POST['kode_permintaan_pembelian'])) : '';
    $kode_pegawai	= isset($_POST['kode_pegawai']) ? mysql_real_escape_string(trim($_POST['kode_pegawai'])) : '';
    $kode_divisi	= isset($_POST['kode_divisi']) ? mysql_real_escape_string(trim($_POST['kode_divisi'])) : '';
    $nama_divisi	= isset($_POST['nama_divisi']) ? mysql_real_escape_string(trim($_POST['nama_divisi'])) : '';
    $mu		 	= isset($_POST['mu']) ? mysql_real_escape_string(trim($_POST['mu'])) : '';
    $keterangan		= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
    $remarks_permintaan_pembelian 	= isset($_POST['remarks_permintaan_pembelian']) ? mysql_real_escape_string(trim($_POST['remarks_permintaan_pembelian'])) : '';
    
    if($kode_permintaan_pembelian != ""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_permintaan_pembelian`(`id_permintaan_pembelian`, `id_cabang`, `nama_cabang`, `tanggal`, `kode_permintaan_pembelian`, `kode_pegawai`, `kode_divisi`,
     					    `nama_divisi`, `mu`, `keterangan`, `remarks_permintaan_pembelian`,`date_add`, `date_upd`,
					    `user_add`, `user_upd`, `level`)
				    VALUES ('', '".$id_cabang."', '".$nama_cabang."', '".$tanggal."', '".$kode_permintaan_pembelian."', '".$kode_pegawai."', '".$kode_divisi."',
					    '".$nama_divisi."', '".$mu."', '".$keterangan."', '".$remarks_permintaan_pembelian."', NOW(), NOW(),
					    '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    
    //echo $sql_insert."<br>";

    echo mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    /*echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='form_permintaanbeli_detail.php?c=$kode_permintaan_pembelian';
	</script>";*/
    header("location: form_permintaanbeli_detail.php?c=$kode_permintaan_pembelian");
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
}elseif(isset($_POST["update"]))
{
    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $nama_cabang	= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_permintaan_pembelian	= isset($_POST['kode_permintaan_pembelian']) ? mysql_real_escape_string(trim($_POST['kode_permintaan_pembelian'])) : '';
    $kode_divisi	= isset($_POST['kode_divisi']) ? mysql_real_escape_string(trim($_POST['kode_divisi'])) : '';
    $nama_divisi	= isset($_POST['nama_divisi']) ? mysql_real_escape_string(trim($_POST['nama_divisi'])) : '';
    $mu		 	= isset($_POST['mu']) ? mysql_real_escape_string(trim($_POST['mu'])) : '';
    $keterangan		= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
    $remarks_permintaan_pembelian 	= isset($_POST['remarks_permintaan_pembelian']) ? mysql_real_escape_string(trim($_POST['remarks_permintaan_pembelian'])) : '';
    
    
    if($kode_permintaan_pembelian != ""){
	    
	//Update into cc_subscription_service
	$sql_update = "UPDATE `gx_permintaan_pembelian` SET `kode_divisi`='".$kode_divisi."',
	`nama_divisi`='".$nama_divisi."', `mu`='".$mu."', `keterangan`='".$keterangan."', `remarks_permintaan_pembelian`='".$remarks_permintaan_pembelian."',
	`date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
	WHERE `kode_permintaan_pembelian`='".$kode_permintaan_pembelian."';";
	
	
	//echo $sql_update;
	echo mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
       
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
       /*
	echo "<script language='JavaScript'>
	    alert('Data telah diupdate.');
	    window.location.href='master_permintaan_pembelian';
	    </script>";*/
	header("location: master_permintaan_pembelian.php");
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
}

if(isset($_GET["id"]))
{
    $id_permintaan_pembelian		= isset($_GET['id']) ? $_GET['id'] : '';
    $query_permintaan_pembelian 	= "SELECT * FROM `gx_permintaan_pembelian` WHERE `id_permintaan_pembelian` ='".$id_permintaan_pembelian."' LIMIT 0,1;";
    $sql_permintaan_pembelian		= mysql_query($query_permintaan_pembelian, $conn);
    $row_permintaan_pembelian		= mysql_fetch_array($sql_permintaan_pembelian);

}

    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-10"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Permintaan Pembeliaan</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_permintaan_pembelian" id="form_permintaan_pembelian" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">';
				    if(isset($_GET["id"])){
					$content.='';
				    }else{
					$content.='
					    
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="" onclick="return valideopenerform(\'data_cabang.php?r=form_permintaan_pembelian&f=permintaan_pembelian\',\'cabang\');">
						<input type="hidden" readonly="" class="form-control" required="" name="id_cabang" value="">
						
					    </div>
					    ';
				    }
					$content .='
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="tanggal" value="'.(isset($_GET['id']) ? $row_permintaan_pembelian["tanggal"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Permintaan Pembelian</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="kode_permintaan_pembelian" id="kode_permintaan_pembelian" value="'.(isset($_GET['id']) ? $row_permintaan_pembelian["kode_permintaan_pembelian"] : '').'">
						
					    </div>

					    <div class="col-xs-2">
						<label>Nama Login</label>
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" class="form-control" readonly="" required="" name="kode_pegawai" id="kode_pegawai" value="'.(isset($_GET['id']) ? $row_permintaan_pembelian["kode_pegawai"] : $loggedin["id_employee"]).'">
						<input type="text" class="form-control" readonly="" required="" name="nama_pegawai" id="nama_pegawai" value="'.(isset($_GET['id']) ? $row_permintaan_pembelian["user_add"] : $loggedin["username"]).'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Divisi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" class="form-control"  required="" name="kode_divisi" id="id_divisi" value="'.(isset($_GET['id']) ? $row_permintaan_pembelian["kode_divisi"] : '').'" >
						<input type="text" readonly="" class="form-control"  required="" name="nama_divisi" id="nama_divisi" value="'.(isset($_GET['id']) ? $row_permintaan_pembelian["nama_divisi"] : '').'" onclick="return valideopenerform(\'data_divisi.php?r=form_permintaan_pembelian\',\'divisi\');">
					    </div>

					    <div class="col-xs-2">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
					    <select name="mu" class="form-control">';
						$query_matauang	= mysql_query("SELECT * FROM `gx_matauang` WHERE `level` = '0' ORDER BY `id_matauang` DESC ;", $conn);
						while ($row_matauang = mysql_fetch_array($query_matauang)) {
						    $content .='<option value="'.$row_matauang["kode_matauang"].'">'.$row_matauang["nama_matauang"].'</option>';
						}
					    $content .='</select>
						
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" name="keterangan" style="resize:none;">'.(isset($_GET['id']) ? $row_permintaan_pembelian["keterangan"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Remarks Permintaan Pembelian</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" name="remarks_permintaan_pembelian" style="resize:none;">'.(isset($_GET['id']) ? $row_permintaan_pembelian["remarks_permintaan_pembelian"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
                                        
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_permintaan_pembelian["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_permintaan_pembelian["user_upd"]." (".$row_permintaan_pembelian["date_upd"].")" : "").'
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

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                 $("#datepicker2").datepicker({format: "yyyy-mm-dd"});
            });
        </script>';

    $title	= 'Form Permintaan Pembelian';
    $submenu	= "Pembelian";
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