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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Setting Cuti Karyawan");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_master_gaji` WHERE `id_master_gaji`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}

    $content ='<section class="content-header">
                    <h1>
                        Setting Cuti Karyawan
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <!--<h3 class="box-title">Setting Cuti Karyawan</h3>-->
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label>Setting Cuti Karyawan</label>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Tahun</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="tahun" name="tahun" placeholder="Tahun" value="'.(isset($_GET['id']) ? $row_data["tahun"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Bulan</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="" placeholder="Bulan" required="" value="'.(isset($_GET['id']) ? $row_data["bulan"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Masa Kerja</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="" placeholder="Masa Kerja" value="'.(isset($_GET['id']) ? $row_data["masa_kerja"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Tahun</label>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Limit Karyawan Cuti</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="limit_karyawan_cuti" placeholder="Limit Karyawan Cuti" value="'.(isset($_GET['id']) ? $row_data["limit_karyawan_cuti"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Orang/Hari</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Jumlah Limit per Divisi</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="jumlah_limit_per_divisi" placeholder="Jumlah Limit Per Divisi" value="'.(isset($_GET['id']) ? $row_data["jumlah_limit_per_divisi"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Orang/Hari</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Remarks :</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Cuti : Kuning</label>
											</div>
											<div class="col-xs-3">
												<label>Ijin : Merah</label>
											</div>
											<div class="col-xs-3">
												<label>Merah : Libur Hari Besar</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12">
												<label>Tampilan Tanggalan</label>
											</div>
											<div class="col-xs-12">
												<textarea class="form-control" id="" name="" placeholder=""></textarea>
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
	$a1	   		= isset($_POST['a1']) ? mysql_real_escape_string(trim($_POST['a1'])) : '';
	
	
	if($a1 != "" && $a2 != "" && $a14 != ""){
	$sql_insert = "";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/master_gaji.php';
			</script>";
			
    }else{
		echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
	}
}elseif(isset($_POST["update"]))
{
    //echo "update";
	$a1	   		= isset($_POST['a1']) ? mysql_real_escape_string(trim($_POST['a1'])) : '';
	
	
    $sql_update = "";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "";                                   
    
    //echo $sql_insert;
    mysql_query($sql_insert_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/master_gaji.php';
			</script>";
			
}

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                $("#datepicker2").datepicker({format: "yyyy-mm-dd"});  
            });
        </script>
	<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: \'\',
		thousandsSeparator: \',\',
		centsLimit: 0
	    });
        </script>';

    $title	= 'Setting Cuti Karyawan';
    $submenu	= "setting_cuti_karyawan";
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