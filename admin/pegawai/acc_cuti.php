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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open ACC Cuti");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_master_gaji` WHERE `id_master_gaji`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}

    $content ='<section class="content-header">
                    <h1>
                        ACC Cuti
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <!--<h3 class="box-title">ACC Cuti</h3>-->
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="acc_cuti" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label>ACC Cuti</label>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Acc Cuti</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="no_acc_cuti" name="no_acc_cuti" placeholder="No Acc Cuti" value="'.(isset($_GET['id']) ? $row_data["no_acc_cuti"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>No Set Cuti</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="no_set_cuti" name="" placeholder="no_set_cuti" required="" value="'.(isset($_GET['id']) ? $row_data["no_set_cuti"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Tahun</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="tahun" placeholder="Tahun" value="'.(isset($_GET['id']) ? $row_data["tahun"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Bulan</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="bulan" placeholder="Bulan" value="'.(isset($_GET['id']) ? $row_data["bulan"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Cabang</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="cabang" placeholder="Cabang" value="'.(isset($_GET['id']) ? $row_data["cabang"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Lama Kerja</label>
											</div>
											
											<div class="col-xs-2">
												<input type="text" class="form-control" id="" name="lama_kerja" placeholder="Lama Kerja" value="'.(isset($_GET['id']) ? $row_data["lama_kerja"] : "").'">
											</div>
											<div class="col-xs-1">
												<label>Tahun</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kode Pegawai</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="kode_pegawai" placeholder="Kode Pegawai" value="'.(isset($_GET['id']) ? $row_data["kode_pegawai"] : "").'" readonly="">
											</div>
											<div class="col-xs-3">
												<label>Nama Pegawai</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="nama_pegawai" placeholder="Nama Pegawai" value="'.(isset($_GET['id']) ? $row_data["nama_pegawai"] : "").'"  onclick="return valideopenerform(\'data_staff.php?r=acc_cuti&f=acc_cuti\',\'staff\');" readonly="">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Divisi</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="divisi" placeholder="Divisi" value="'.(isset($_GET['id']) ? $row_data["divisi"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Kabag</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="kabag" placeholder="kabag" value="'.(isset($_GET['id']) ? $row_data["kabag"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Jumlah Hak Cuti</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="jumlah_hak_cuti" placeholder="Jumlah Hak Cuti" value="'.(isset($_GET['id']) ? $row_data["jumlah_hak_cuti"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Sisa Cuti</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="sisa_cuti" placeholder="Sisa Cuti" value="'.(isset($_GET['id']) ? $row_data["sisa_cuti"] : "").'">
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
										
										<table id="example1" class="table table-bordered table-striped">
												<tr><td>Bulan</td><td>Tanggal</td><td>Keterangan</td><td>Otorisasi Atasan</td></tr>
												<tr><td></td><td></td><td></td><td></td></tr>
											</table>
										
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->';
			

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

    $title	= 'ACC Cuti';
    $submenu	= "acc_cuti";
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