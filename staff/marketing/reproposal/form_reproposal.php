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
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
if(($loggedin["id_bagian"]) != "Marketing")  { die( 'Access Denied!' );}
        global $conn;



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Re Proposal");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_reproposal` WHERE `id_reproposal`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	$query_cabang	= "SELECT * FROM `gx_cabang` WHERE `id_cabang`='$row_data[id_cabang]' LIMIT 0,1;";
    $sql_cabang		= mysql_query($query_cabang, $conn);
    $row_cabang		= mysql_fetch_array($sql_cabang);
	$query_proposal	= "SELECT * FROM `gx_proposal` WHERE `id_proposal`='$row_data[id_proposal]' LIMIT 0,1;";
    $sql_proposal	= mysql_query($query_proposal, $conn);
    $row_proposal	= mysql_fetch_array($sql_proposal);
	
}

$sql_cabangg	= "SELECT * FROM `gx_cabang` WHERE `id_cabang` = '$loggedin[cabang]' ORDER BY `id_cabang` ASC LIMIT 0,1;";
$query_cabangg	= mysql_query($sql_cabangg, $conn);
$row_cabangg = mysql_fetch_array($query_cabangg);
$sql_last_data = mysql_fetch_array(mysql_query("SELECT * FROM `gx_reproposal` ORDER BY `id_reproposal` DESC", $conn));
$last_data  = $sql_last_data["id_reproposal"] + 1;
$tanggal    = date("d");
$kode_reproposalll = $row_cabangg["kode_cabang"].'-'.$row_cabangg["kode_proposal"].''.$tanggal.''.sprintf("%04d", $last_data);

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Re Proposal</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Cabang</label>
											</div>
											<div class="col-xs-3">';
											if(isset($_GET["id"])){
												$content .='<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["id_cabang"] : "").'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_cabang["nama_cabang"] : "").'">';
											}else{
												$content .='<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["id_cabang"] : $row_cabangg["id_cabang"]).'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_cabang["nama_cabang"] : $row_cabangg["nama_cabang"]).'">';
											}
											$content .='</div>
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? date("Y-m-d H:i", strtotime($row_data["tanggal"])): date("Y-m-d H:i")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Re Proposal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_reproposal" name="kode_reproposal" required="" value="'.(isset($_GET['id']) ? $row_data["kode_reproposal"] : $kode_reproposalll).'" >
											</div>
											<div class="col-xs-3">
												<label>No Proposal</label>
											</div>
											<div class="col-xs-3">
												<input type="hidden" readonly="" class="form-control" id="id_proposal" name="id_proposal" required="" value="'.(isset($_GET['id']) ? $row_data["id_proposal"] : "").'">
												<input type="text" readonly="" class="form-control" id="kode_proposal" name="kode_proposal" required="" value="'.(isset($_GET['id']) ? $row_proposal["kode_proposal"] : "").'" onclick="return valideopenerform(\'data_proposal.php?r=myForm&f=reproposal\',\'proposal\');">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Customer</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="nama_customer" name="nama_customer" required="" value="'.(isset($_GET['id']) ? $row_data["nama_customer"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>nama Perusahaan</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required="" value="'.(isset($_GET['id']) ? $row_data["nama_perusahaan"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Allowance</label>
											</div>
											<div class="col-xs-3">
												<input type="text" maxlength="20" class="form-control" id="harga" name="allowance" required="" value="'.(isset($_GET['id']) ? $row_data["allowance"] : "").'">
											</div>
											<div class="col-xs-2">
												<label> % dari NET</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Harga Re Proposal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" maxlength="20" class="form-control" id="harga" name="harga_reproposal" required="" value="'.(isset($_GET['id']) ? $row_data["harga_reproposal"] : "").'">
											</div>
											<div class="col-xs-2">
												<label> % dari NET</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Re Proposal Ke</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" maxlength="6" id="harga" name="reproposal_ke" required="" value="'.(isset($_GET['id']) ? $row_data["reproposal_ke"] : "").'">
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
	$kode_cabang	   	= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$tanggal    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_reproposal	= isset($_POST['kode_reproposal']) ? mysql_real_escape_string(trim($_POST['kode_reproposal'])) : '';
	$id_proposal		= isset($_POST['id_proposal']) ? mysql_real_escape_string(trim($_POST['id_proposal'])) : '';
	$nama_customer	 	= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
	$nama_perusahaan  	= isset($_POST['nama_perusahaan']) ? mysql_real_escape_string(trim($_POST['nama_perusahaan'])) : '';
	$allowance	  	 	= isset($_POST['allowance']) ? str_replace(",", "", $_POST['allowance']) : '';
	$harga_reproposal	= isset($_POST['harga_reproposal']) ? str_replace(",", "", $_POST['harga_reproposal']) : '';
    $reproposal_ke		= isset($_POST['reproposal_ke']) ? str_replace(",", "", $_POST['reproposal_ke']) : '';
	
	$sql_insert = "INSERT INTO `gx_reproposal` (`id_reproposal`, `id_proposal`, `id_cabang`,
						  `kode_reproposal`, `tanggal`, `nama_customer`, `nama_perusahaan`, `allowance`, `harga_reproposal`, `reproposal_ke`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$id_proposal."', '".$kode_cabang."',
						  '".$kode_reproposal."', '".$tanggal."', '".$nama_customer."', '".$nama_perusahaan."', '".$allowance."', '".$harga_reproposal."', '".$reproposal_ke."',
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
			window.location.href='".URL_STAFF."marketing/reproposal/master_reproposal.php';
			</script>";
			
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    $kode_cabang	   	= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$tanggal    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_reproposal	= isset($_POST['kode_reproposal']) ? mysql_real_escape_string(trim($_POST['kode_reproposal'])) : '';
	$id_proposal		= isset($_POST['id_proposal']) ? mysql_real_escape_string(trim($_POST['id_proposal'])) : '';
	$nama_customer	 	= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
	$nama_perusahaan  	= isset($_POST['nama_perusahaan']) ? mysql_real_escape_string(trim($_POST['nama_perusahaan'])) : '';
	$allowance	  	 	= isset($_POST['allowance']) ? str_replace(",", "", $_POST['allowance']) : '';
	$harga_reproposal	= isset($_POST['harga_reproposal']) ? str_replace(",", "", $_POST['harga_reproposal']) : '';
    $reproposal_ke		= isset($_POST['reproposal_ke']) ? str_replace(",", "", $_POST['reproposal_ke']) : '';
	
    $sql_update = "UPDATE `gx_reproposal` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_reproposal` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "INSERT INTO `gx_reproposal` (`id_reproposal`, `id_proposal`, `id_cabang`,
						  `kode_reproposal`, `tanggal`, `nama_customer`, `nama_perusahaan`, `allowance`, `harga_reproposal`, `reproposal_ke`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$id_proposal."', '".$kode_cabang."',
						  '".$kode_reproposal."', '".$tanggal."', '".$nama_customer."', '".$nama_perusahaan."', '".$allowance."', '".$harga_reproposal."', '".$reproposal_ke."',
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
			window.location.href='".URL_STAFF."marketing/reproposal/master_reproposal.php';
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

    $title	= 'Form Re Proposal';
    $submenu	= "reproposal";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
}
    }else{
	header("location: ".URL_STAFF."logout.php");
    }

?>