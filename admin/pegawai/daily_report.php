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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Master Gaji");
 
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
                                <form role="form" method="POST" name="daily_report" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label><h2>Daily Report</h2></label>
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
												<input type="text" class="form-control" id="" name="nama_pegawai" placeholder="" value="'.(isset($_GET['id']) ? $row_data["nama_pegawai"] : "").'" readonly="" onclick="return valideopenerform(\'data_staff.php?r=daily_report&f=cek_daily_report\',\'staff\');">
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
												<tr><td>No</td><td>Uraian Pekerjaan</td><td>Status</td><td>Remarks</td></tr>
												<tr><td></td><td></td><td></td><td></td></tr>
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
												<tr><td>No</td><td>Uraian Pekerjaan</td><td>Status</td><td>Remarks</td></tr>
												<tr><td></td><td></td><td></td><td></td></tr>
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
												<tr><td>No</td><td>Uraian Pekerjaan</td><td>Status</td></tr>
												<tr><td></td><td></td><td></td></tr>
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
    //echo "update";
	$a1	   		= isset($_POST['a1']) ? mysql_real_escape_string(trim($_POST['a1'])) : '';
	$a2	   		= isset($_POST['a2']) ? mysql_real_escape_string(trim($_POST['a2'])) : '';
	$a3	   		= isset($_POST['a3']) ? mysql_real_escape_string(trim($_POST['a3'])) : '';
	$a4	   		= isset($_POST['a4']) ? mysql_real_escape_string(trim($_POST['a4'])) : '';
	$a5	   		= isset($_POST['a5']) ? mysql_real_escape_string(trim($_POST['a5'])) : '';
	$a6	   		= isset($_POST['a6']) ? mysql_real_escape_string(trim($_POST['a6'])) : '';
	$a7	   		= isset($_POST['a7']) ? mysql_real_escape_string(trim($_POST['a7'])) : '';
	$a8	   		= isset($_POST['a8']) ? mysql_real_escape_string(trim($_POST['a8'])) : '';
	$a9	   		= isset($_POST['a9']) ? mysql_real_escape_string(trim($_POST['a9'])) : '';
	$a10   		= isset($_POST['a10']) ? mysql_real_escape_string(trim($_POST['a10'])) : '';
	$a11   		= isset($_POST['a11']) ? mysql_real_escape_string(trim($_POST['a11'])) : '';
	$a12   		= isset($_POST['a12']) ? mysql_real_escape_string(trim($_POST['a12'])) : '';
	$a13   		= isset($_POST['a13']) ? mysql_real_escape_string(trim($_POST['a13'])) : '';
	$a14   		= isset($_POST['a14']) ? mysql_real_escape_string(trim($_POST['a14'])) : '';
	
	$b1	   		= isset($_POST['b1']) ? mysql_real_escape_string(trim($_POST['b1'])) : '';
	$b2	   		= isset($_POST['b2']) ? mysql_real_escape_string(trim($_POST['b2'])) : '';
	$b3	   		= isset($_POST['b3']) ? mysql_real_escape_string(trim($_POST['b3'])) : '';
	$b4	   		= isset($_POST['b4']) ? mysql_real_escape_string(trim($_POST['b4'])) : '';
	$b5	   		= isset($_POST['b5']) ? mysql_real_escape_string(trim($_POST['b5'])) : '';
	$b6	   		= isset($_POST['b6']) ? mysql_real_escape_string(trim($_POST['b6'])) : '';
	
	$c1	   		= isset($_POST['c1']) ? mysql_real_escape_string(trim($_POST['c1'])) : '';
	$c2	   		= isset($_POST['c2']) ? mysql_real_escape_string(trim($_POST['c2'])) : '';
	$c3	   		= isset($_POST['c3']) ? mysql_real_escape_string(trim($_POST['c3'])) : '';
	$c4	   		= isset($_POST['c4']) ? mysql_real_escape_string(trim($_POST['c4'])) : '';
	$c5	   		= isset($_POST['c5']) ? mysql_real_escape_string(trim($_POST['c5'])) : '';
	$c6	   		= isset($_POST['c6']) ? mysql_real_escape_string(trim($_POST['c6'])) : '';
	$c7	   		= isset($_POST['c7']) ? mysql_real_escape_string(trim($_POST['c7'])) : '';
	$c8	   		= isset($_POST['c8']) ? mysql_real_escape_string(trim($_POST['c8'])) : '';
	$c9	   		= isset($_POST['c9']) ? mysql_real_escape_string(trim($_POST['c9'])) : '';
	$c10   		= isset($_POST['c10']) ? mysql_real_escape_string(trim($_POST['c10'])) : '';
	$c11   		= isset($_POST['c11']) ? mysql_real_escape_string(trim($_POST['c11'])) : '';
	$c12   		= isset($_POST['c12']) ? mysql_real_escape_string(trim($_POST['c12'])) : '';
	$c13   		= isset($_POST['c13']) ? mysql_real_escape_string(trim($_POST['c13'])) : '';
	$c14   		= isset($_POST['c14']) ? mysql_real_escape_string(trim($_POST['c14'])) : '';
	$c15   		= isset($_POST['c15']) ? mysql_real_escape_string(trim($_POST['c15'])) : '';
	$c16   		= isset($_POST['c16']) ? mysql_real_escape_string(trim($_POST['c16'])) : '';
	$c17   		= isset($_POST['c17']) ? mysql_real_escape_string(trim($_POST['c17'])) : '';
	$c18   		= isset($_POST['c18']) ? mysql_real_escape_string(trim($_POST['c18'])) : '';
	$c19   		= isset($_POST['c19']) ? mysql_real_escape_string(trim($_POST['c19'])) : '';
	$c20   		= isset($_POST['c20']) ? mysql_real_escape_string(trim($_POST['c20'])) : '';
	$c21   		= isset($_POST['c21']) ? mysql_real_escape_string(trim($_POST['c21'])) : '';
	$c22   		= isset($_POST['c22']) ? mysql_real_escape_string(trim($_POST['c22'])) : '';
	$c23   		= isset($_POST['c23']) ? mysql_real_escape_string(trim($_POST['c23'])) : '';
	$c24   		= isset($_POST['c24']) ? mysql_real_escape_string(trim($_POST['c24'])) : '';
	$c25   		= isset($_POST['c25']) ? mysql_real_escape_string(trim($_POST['c25'])) : '';
	$c26   		= isset($_POST['c26']) ? mysql_real_escape_string(trim($_POST['c26'])) : '';
	
	$d1	   		= isset($_POST['d1']) ? mysql_real_escape_string(trim($_POST['d1'])) : '';
	$d2	   		= isset($_POST['d2']) ? mysql_real_escape_string(trim($_POST['d2'])) : '';
	$d3	   		= isset($_POST['d3']) ? mysql_real_escape_string(trim($_POST['d3'])) : '';
	$d4	   		= isset($_POST['d4']) ? mysql_real_escape_string(trim($_POST['d4'])) : '';
	$d5	   		= isset($_POST['d5']) ? mysql_real_escape_string(trim($_POST['d5'])) : '';
	$d6	   		= isset($_POST['d6']) ? mysql_real_escape_string(trim($_POST['d6'])) : '';
	$d7	   		= isset($_POST['d7']) ? mysql_real_escape_string(trim($_POST['d7'])) : '';
	$d8	   		= isset($_POST['d8']) ? mysql_real_escape_string(trim($_POST['d8'])) : '';
	$d9	   		= isset($_POST['d9']) ? mysql_real_escape_string(trim($_POST['d9'])) : '';
	$d10   		= isset($_POST['d10']) ? mysql_real_escape_string(trim($_POST['d10'])) : '';
	$d11   		= isset($_POST['d11']) ? mysql_real_escape_string(trim($_POST['d11'])) : '';
	$d12   		= isset($_POST['d12']) ? mysql_real_escape_string(trim($_POST['d12'])) : '';
	$d13   		= isset($_POST['d13']) ? mysql_real_escape_string(trim($_POST['d13'])) : '';
	$d14   		= isset($_POST['d14']) ? mysql_real_escape_string(trim($_POST['d14'])) : '';
	$d15   		= isset($_POST['d15']) ? mysql_real_escape_string(trim($_POST['d15'])) : '';
	$d16   		= isset($_POST['d16']) ? mysql_real_escape_string(trim($_POST['d16'])) : '';
	$d17   		= isset($_POST['d17']) ? mysql_real_escape_string(trim($_POST['d17'])) : '';
	$d18   		= isset($_POST['d18']) ? mysql_real_escape_string(trim($_POST['d18'])) : '';
	$d19   		= isset($_POST['d19']) ? mysql_real_escape_string(trim($_POST['d19'])) : '';
	$d20   		= isset($_POST['d20']) ? mysql_real_escape_string(trim($_POST['d20'])) : '';
	$d21   		= isset($_POST['d21']) ? mysql_real_escape_string(trim($_POST['d21'])) : '';
	$d22   		= isset($_POST['d22']) ? mysql_real_escape_string(trim($_POST['d22'])) : '';
	$d23   		= isset($_POST['d23']) ? mysql_real_escape_string(trim($_POST['d23'])) : '';
	$d24   		= isset($_POST['d24']) ? mysql_real_escape_string(trim($_POST['d24'])) : '';
	$d25   		= isset($_POST['d25']) ? mysql_real_escape_string(trim($_POST['d25'])) : '';
	$d26   		= isset($_POST['d26']) ? mysql_real_escape_string(trim($_POST['d26'])) : '';
	
    $sql_update = "UPDATE `gx_master_gaji` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_master_gaji` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "INSERT INTO `gx_master_gaji` (`id_master_gaji`, `A1`, `A2`, `A3`, `A4`, `A5`, `A6`, `A7`, `A8`, `A9`, `A10`, `A11`, `A12`,
						  `A13`, `A14`, `B1`, `B2`, `B3`, `B4`, `B5`, `B6`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`, `C7`, `C8`, `C9`, `C10`, `C11`, `C12`,
						  `C13`, `C14`, `C15`, `C16`, `C17`, `C18`, `C19`, `C20`, `C21`, `C22`, `C23`, `C24`, `C25`, `C26`, `D1`, `D2`, `D3`, `D4`, `D5`, `D6`, `D7`, `D8`, `D9`, `D10`, `D11`, `D12`,
						  `D13`, `D14`, `D15`, `D16`, `D17`, `D18`, `D19`, `D20`, `D21`, `D22`, `D23`, `D24`, `D25`, `D26`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$a1."', '".$a2."', '".$a3."', '".$a4."', '".$a5."', '".$a6."', '".$a7."', '".$a8."', '".$a9."', '".$a10."', '".$a11."', '".$a12."',
						  '".$a13."', '".$a14."', '".$b1."', '".$b2."', '".$b3."', '".$b4."', '".$b5."', '".$b6."', '".$c1."', '".$c2."', '".$c3."', '".$c4."', '".$c5."', '".$c6."', '".$c7."', '".$c8."', '".$c9."', '".$c10."', '".$c11."', '".$c12."',
						  '".$c13."', '".$c14."', '".$c15."', '".$c16."', '".$c17."', '".$c18."', '".$c19."', '".$c20."', '".$c21."', '".$c22."', '".$c23."', '".$c24."', '".$c25."', '".$c26."', '".$d1."', '".$d2."', '".$d3."', '".$d4."', '".$d5."', '".$d6."', '".$d7."', '".$d8."', '".$d9."', '".$d10."', '".$d11."', '".$d12."',
						  '".$d13."', '".$d14."', '".$d15."', '".$d16."', '".$d17."', '".$d18."', '".$d19."', '".$d20."', '".$d21."', '".$d22."', '".$d23."', '".$d24."', '".$d25."', '".$d26."',
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                                   
    
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

    $title	= 'Daily Report';
    $submenu	= "daily_report";
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