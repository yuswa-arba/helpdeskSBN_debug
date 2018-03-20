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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Cek Daily Report");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_master_gaji` WHERE `id_master_gaji`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}

    $content = '<section class="content-header">
                                       
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="cek_daily_report" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label><h2>Cek Daily Report</h2></label>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Cabang</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="" name="cabang" placeholder="" value="'.(isset($_GET['id']) ? $row_data["cabang"] : "").'">
											</div>
											
											<div class="col-xs-2">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="" name="tanggal" placeholder="" value="'.(isset($_GET['id']) ? $row_data["tanggal"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Kode Pegawai</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="" name="kode_pegawai" placeholder="" value="'.(isset($_GET['id']) ? $row_data["kode_pegawai"] : "").'" readonly="">
											</div>
											
											<div class="col-xs-2">
												<label>Nama Pegawai</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="" name="nama_pegawai" placeholder="" value="'.(isset($_GET['id']) ? $row_data["nama_pegawai"] : "").'" readonly="" onclick="return valideopenerform(\'data_staff.php?r=cek_daily_report&f=cek_daily_report\',\'staff\');">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Kabag</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="" name="kabag" placeholder="" value="'.(isset($_GET['id']) ? $row_data["kabag"] : "").'">
											</div>
											
											<div class="col-xs-2">
												<label>Divisi</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="" name="divisi" placeholder="" value="'.(isset($_GET['id']) ? $row_data["divisi"] : "").'">
											</div>
										</div>
										</div>
										
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Level</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="" name="level" placeholder="" value="'.(isset($_GET['id']) ? $row_data["level"] : "").'">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12">
											<label>RUTIN HARIAN</label>
											</div>
											<div class="col-xs-12">
											<!--
												<table>
												<tr><td>No</td><td>Uraian Pekerjaan</td><td>Status</td><td>Remarks</td></tr>
												<tr><td></td><td></td><td></td><td></td></tr>
												</table>
											-->
											<table id="example1" class="table table-bordered table-striped">
												<tr><td>No</td><td>Uraian Pekerjaan</td><td>Status</td><td>Remarks</td><td>Check List</td><td>COMMENT</td></tr>
												<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>
											</table>		
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12">
											<label>RUTIN TANGGAL</label>
											</div>
											<div class="col-xs-12">
											<table id="example1" class="table table-bordered table-striped">
												<tr><td>No</td><td>Uraian Pekerjaan</td><td>Status</td><td>Remarks</td><td>Check List</td><td>COMMENT</td></tr>
												<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>
											</table>		
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12">
											<label>To Do</label>
											</div>
											<div class="col-xs-12">
											<table id="example1" class="table table-bordered table-striped">
												<tr><td>No</td><td>Uraian Pekerjaan</td><td>Status</td><td>Check List</td><td>COMMENT</td></tr>
												<tr><td></td><td></td><td></td><td></td><td></td></tr>
											</table>		
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12">
											<label>Reminder</label>
											</div>
											<div class="col-xs-12">
											<table id="example1" class="table table-bordered table-striped">
												<tr><td>No</td><td>Uraian Pekerjaan</td><td>Status</td></tr>
												<tr><td></td><td></td><td></td></tr>
											</table>		
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

                </section><!-- /.content -->';
			

if(isset($_POST["save"]))
{
   
	$d26   		= isset($_POST['d26']) ? mysql_real_escape_string(trim($_POST['d26'])) : '';
	
	if($a1 != "" && $a2 != "" && $a14 != ""){
	$sql_insert = "INSERT INTO `gx_master_gaji` (`id_master_gaji`, `A1`, `A2`, `A3`, `A4`, `A5`, `A6`, `A7`, `A8`, `A9`, `A10`, `A11`, `A12`,
						  `A13`, `A14`, `B1`, `B2`, `B3`, `B4`, `B5`, `B6`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`, `C7`, `C8`, `C9`, `C10`, `C11`, `C12`,
						  `C13`, `C14`, `C15`, `C16`, `C17`, `C18`, `C19`, `C20`, `C21`, `C22`, `C23`, `C24`, `C25`, `C26`, `D1`, `D2`, `D3`, `D4`, `D5`, `D6`, `D7`, `D8`, `D9`, `D10`, `D11`, `D12`,
						  `D13`, `D14`, `D15`, `D16`, `D17`, `D18`, `D19`, `D20`, `D21`, `D22`, `D23`, `D24`, `D25`, `D26`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$a1."', '".$a2."', '".$a3."', '".$a4."', '".$a5."', '".$a6."', '".$a7."', '".$a8."', '".$a9."', '".$a10."', '".$a11."', '".$a12."',
						  '".$a13."', '".$a14."',  '".$b1."', '".$b2."', '".$b3."', '".$b4."', '".$b5."', '".$b6."', '".$c1."', '".$c2."', '".$c3."', '".$c4."', '".$c5."', '".$c6."', '".$c7."', '".$c8."', '".$c9."', '".$c10."', '".$c11."', '".$c12."',
						  '".$c13."', '".$c14."', '".$c15."', '".$c16."', '".$c17."', '".$c18."', '".$c19."', '".$c20."', '".$c21."', '".$c22."', '".$c23."', '".$c24."', '".$c25."', '".$c26."', '".$d1."', '".$d2."', '".$d3."', '".$d4."', '".$d5."', '".$d6."', '".$d7."', '".$d8."', '".$d9."', '".$d10."', '".$d11."', '".$d12."',
						  '".$d13."', '".$d14."', '".$d15."', '".$d16."', '".$d17."', '".$d18."', '".$d19."', '".$d20."', '".$d21."', '".$d22."', '".$d23."', '".$d24."', '".$d25."', '".$d26."',
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
   
	$d26   		= isset($_POST['d26']) ? mysql_real_escape_string(trim($_POST['d26'])) : '';
	
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
        </script>
		';

    $title	= 'Cek Daily Report';
    $submenu	= "cek_daily_report";
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