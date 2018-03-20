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
    $kode_periksa_pembelian	= isset($_POST['kode_periksa_pembelian']) ? mysql_real_escape_string(trim($_POST['kode_periksa_pembelian'])) : '';
    
    $kode_permintaan_pembelian	= isset($_POST['kode_permintaan_pembelian']) ? mysql_real_escape_string(trim($_POST['kode_permintaan_pembelian'])) : '';
    $kode_pegawai	= isset($_POST['kode_pegawai']) ? mysql_real_escape_string(trim($_POST['kode_pegawai'])) : '';
    $kode_divisi	= isset($_POST['kode_divisi']) ? mysql_real_escape_string(trim($_POST['kode_divisi'])) : '';
    $nama_divisi	= isset($_POST['nama_divisi']) ? mysql_real_escape_string(trim($_POST['nama_divisi'])) : '';
    $mu		 	= isset($_POST['mu']) ? mysql_real_escape_string(trim($_POST['mu'])) : '';
    $remarks_permintaan_pembelian 	= isset($_POST['remarks_permintaanbeli']) ? mysql_real_escape_string(trim($_POST['remarks_permintaanbeli'])) : '';
    
    $remarks_periksa_pembelian		= isset($_POST['remarks_periksabeli']) ? mysql_real_escape_string(trim($_POST['remarks_periksabeli'])) : '';
    
    
    if($kode_periksa_pembelian != "" && $kode_permintaan_pembelian !=""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_periksa_pembelian`(`id_periksa_pembelian`, `id_cabang`, `nama_cabang`, `tanggal`, `kode_periksa_pembelian`, `kode_permintaan_pembelian`, `kode_pegawai`, `kode_divisi`,
     					    `nama_divisi`, `mu`, `remarks_permintaanbeli`, `remarks_periksabeli`,`date_add`, `date_upd`,
					    `user_add`, `user_upd`, `level`)
				    VALUES ('', '".$id_cabang."', '".$nama_cabang."', '".$tanggal."', '".$kode_periksa_pembelian."', '".$kode_permintaan_pembelian."', '".$kode_pegawai."', '".$kode_divisi."',
					    '".$nama_divisi."', '".$mu."', '".$remarks_permintaan_pembelian."', '".$remarks_periksa_pembelian."', NOW(), NOW(),
					    '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    
    //echo $sql_insert."<br>";

    echo mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    $query_permintaan_pembelian_detail = "SELECT * FROM `gx_permintaan_pembelian_detail` WHERE `kode_permintaan_pembelian` ='".$kode_permintaan_pembelian."' ;";
    $sql_permintaan_pembelian_detail	= mysql_query($query_permintaan_pembelian_detail, $conn);
    
    while($row_permintaan_pembelian_detail	= mysql_fetch_array($sql_permintaan_pembelian_detail)){
    $sql_insert_detail = "INSERT INTO `gx_periksa_pembelian_detail` (`id_periksa_pembelian_detail`, `kode_periksa_pembelian`, `kode_barang`,
						    `nama_barang`, `qty`, `harga`, `remarks_barang`, `stock`, `reorder`, `minim_stock`, `deviasi`, `harga_beli_terakhir`,
						    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES ('', '".$kode_periksa_pembelian."', '".$row_permintaan_pembelian_detail["kode_barang"]."',
						    '".$row_permintaan_pembelian_detail["nama_barang"]."', '".$row_permintaan_pembelian_detail["qty"]."', '".$row_permintaan_pembelian_detail["harga"]."', '".$row_permintaan_pembelian_detail["remarks_barang"]."','', '', '', '', '0',
						    NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    
    //echo $sql_insert_detail."<br>";
    echo mysql_query($sql_insert_detail, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    }

    header("location: form_periksabeli_detail.php?c=$kode_periksa_pembelian");

    
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
    $kode_periksa_pembelian	= isset($_POST['kode_periksa_pembelian']) ? mysql_real_escape_string(trim($_POST['kode_periksa_pembelian'])) : '';
    
    $kode_permintaan_pembelian	= isset($_POST['kode_permintaan_pembelian']) ? mysql_real_escape_string(trim($_POST['kode_permintaan_pembelian'])) : '';
    $kode_pegawai	= isset($_POST['kode_pegawai']) ? mysql_real_escape_string(trim($_POST['kode_pegawai'])) : '';
    $kode_divisi	= isset($_POST['kode_divisi']) ? mysql_real_escape_string(trim($_POST['kode_divisi'])) : '';
    $nama_divisi	= isset($_POST['nama_divisi']) ? mysql_real_escape_string(trim($_POST['nama_divisi'])) : '';
    $mu		 	= isset($_POST['mu']) ? mysql_real_escape_string(trim($_POST['mu'])) : '';
    $remarks_permintaan_pembelian 	= isset($_POST['remarks_permintaanbeli']) ? mysql_real_escape_string(trim($_POST['remarks_permintaanbeli'])) : '';
    $remarks_periksa_pembelian		= isset($_POST['remarks_periksabeli']) ? mysql_real_escape_string(trim($_POST['remarks_periksabeli'])) : '';
    
    
    
    if($kode_permintaan_pembelian != ""){
	    
	//Update into cc_subscription_service
	$sql_update = "UPDATE `gx_periksa_pembelian` SET `kode_divisi`='".$kode_divisi."',
	`nama_divisi`='".$nama_divisi."', `mu`='".$mu."',`remarks_permintaanbeli`='".$remarks_permintaan_pembelian."',`remarks_periksabeli`='".$remarks_periksa_pembelian."',
	`date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
	WHERE `kode_periksa_pembelian`='".$kode_periksa_pembelian."';";
	
	
	//echo $sql_update;
	echo mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
       
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
       
	/*echo "<script language='JavaScript'>
	    alert('Data telah diupdate.');
	    window.location.href='';
	    </script>";*/
	    
	header("location: master_periksa_pembelian.php");

    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
}

if(isset($_GET["id"]))
{
    $id_periksa_pembelian	= isset($_GET['id']) ? $_GET['id'] : '';
    $query_periksa_pembelian 	= "SELECT * FROM `gx_periksa_pembelian` WHERE `id_periksa_pembelian` ='".$id_periksa_pembelian."' LIMIT 0,1;";
    $sql_periksa_pembelian	= mysql_query($query_periksa_pembelian, $conn);
    $row_periksa_pembelian	= mysql_fetch_array($sql_periksa_pembelian);

}

    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-11"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Periksa Pembeliaan</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_periksa_pembelian" id="form_periksa_pembelian" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">';
				    if(isset($_GET["id"])){
					$content.='';
				    }else{
					$content.='
					    
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="" onclick="return valideopenerform(\'data_cabang.php?r=form_periksa_pembelian&f=periksa_pembelian\',\'cabang\');">
						<input type="hidden" readonly="" class="form-control" required="" name="id_cabang" value="">
						
					    </div>
					    ';
				    }
					$content .='
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="tanggal" value="'.(isset($_GET['id']) ? $row_periksa_pembelian["tanggal"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Periksa Pembelian</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="kode_periksa_pembelian" id="kode_periksa_pembelian" value="'.(isset($_GET['id']) ? $row_periksa_pembelian["kode_periksa_pembelian"] : '').'">
						
					    </div>

					    <div class="col-xs-2">
						<label>Nama Login</label>
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" class="form-control" readonly="" required="" name="kode_pegawai" id="kode_pegawai" value="'.(isset($_GET['id']) ? $row_periksa_pembelian["kode_pegawai"] : $loggedin["id_employee"]).'">
						<input type="text" class="form-control" readonly="" required="" name="nama_pegawai" id="nama_pegawai" value="'.(isset($_GET['id']) ? $row_periksa_pembelian["user_add"] : $loggedin["username"]).'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Permintaan Pembelian</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="kode_permintaan_pembelian" id="kode_permintaan_pembelian" value="'.(isset($_GET['id']) ? $row_periksa_pembelian["kode_permintaan_pembelian"] : '').'" onclick="return valideopenerform(\'data_permintaan_pembelian.php?r=form_periksa_pembelian\',\'permintaanbeli\');">
						
					    </div>

                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Divisi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" class="form-control"  required="" name="kode_divisi" id="id_divisi" value="'.(isset($_GET['id']) ? $row_periksa_pembelian["kode_divisi"] : '').'" >
						<input type="text" readonly="" class="form-control"  required="" name="nama_divisi" id="nama_divisi" value="'.(isset($_GET['id']) ? $row_periksa_pembelian["nama_divisi"] : '').'" onclick="return valideopenerform(\'data_divisi.php?r=form_periksa_pembelian\',\'divisi\');">
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
					    <div class="col-xs-3">
						<label>Remarks Permintaan Pembelian</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" readonly="" name="remarks_permintaanbeli" style="resize:none;">'.(isset($_GET['id']) ? $row_periksa_pembelian["remarks_permintaanbeli"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					
                    
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_periksa_pembelian["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_periksa_pembelian["user_upd"]." (".$row_periksa_pembelian["date_upd"].")" : "").'
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

    $title	= 'Form Periksa Pembelian';
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