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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Jawab Proposal");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_jawab_proposal` WHERE `id_jawab_proposal`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	$query_cabang	= "SELECT * FROM `gx_cabang` WHERE `id_cabang`='$row_data[id_cabang]' LIMIT 0,1;";
    $sql_cabang		= mysql_query($query_cabang, $conn);
    $row_cabang		= mysql_fetch_array($sql_cabang);
	$query_proposal	= "SELECT * FROM `gx_proposal` WHERE `id_proposal`='$row_data[id_proposal]' LIMIT 0,1;";
    $sql_proposal	= mysql_query($query_proposal, $conn);
    $row_proposal	= mysql_fetch_array($sql_proposal);
	
}

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Jawab Proposal</h3>
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
												$content .='<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["id_cabang"] : "").'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_cabang["nama_cabang"] : "").'"  onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=jawabproposal\',\'cabang\');">';
											}
											$content .='</div>
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_data["tanggal"] : date("Y-m-d")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Jawaban Proposal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_jawab_proposal" name="kode_jawab_proposal" required="" value="'.(isset($_GET['id']) ? $row_data["kode_jawab_proposal"] : "").'" >
											</div>
											<div class="col-xs-3">
												<label>No Proposal</label>
											</div>
											<div class="col-xs-3">
												<input type="hidden" readonly="" class="form-control" id="id_proposal" name="id_proposal" required="" value="'.(isset($_GET['id']) ? $row_data["id_proposal"] : "").'">
												<input type="text" readonly="" class="form-control" id="kode_proposal" name="kode_proposal" required="" value="'.(isset($_GET['id']) ? $row_proposal["kode_proposal"] : "").'" onclick="return valideopenerform(\'data_proposal.php?r=myForm&f=jawabproposal\',\'proposal\');">
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
												<label>Jawaban Proposal</label>
											</div>
											<div class="col-xs-9">
												<textarea style="height: 100px;" name="jawaban_proposal" class="form-control" placeholder="jawaban proposal" style="resize: none;">'.(isset($_GET['id']) ? $row_data['jawaban_proposal'] :"").'</textarea>
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
    $kode_jawab_proposal= isset($_POST['kode_jawab_proposal']) ? mysql_real_escape_string(trim($_POST['kode_jawab_proposal'])) : '';
	$id_proposal		= isset($_POST['id_proposal']) ? mysql_real_escape_string(trim($_POST['id_proposal'])) : '';
	$nama_customer	 	= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
	$nama_perusahaan  	= isset($_POST['nama_perusahaan']) ? mysql_real_escape_string(trim($_POST['nama_perusahaan'])) : '';
	$jawaban_proposal	= isset($_POST['jawaban_proposal']) ? mysql_real_escape_string(trim($_POST['jawaban_proposal'])) : '';
	
	$sql_insert = "INSERT INTO `gx_jawab_proposal` (`id_jawab_proposal`, `id_cabang`,
						   `tanggal`, `kode_jawab_proposal`, `id_proposal`, `nama_customer`, `nama_perusahaan`, `jawaban_proposal`, 
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."',
						  '".$tanggal."', '".$kode_jawab_proposal."', '".$id_proposal."', '".$nama_customer."', '".$nama_perusahaan."', '".$jawaban_proposal."',
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
			window.location.href='".URL_ADMIN."reproposal/master_jawab_proposal.php';
			</script>";
			
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    $kode_cabang	   	= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$tanggal    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_jawab_proposal= isset($_POST['kode_jawab_proposal']) ? mysql_real_escape_string(trim($_POST['kode_jawab_proposal'])) : '';
	$id_proposal		= isset($_POST['id_proposal']) ? mysql_real_escape_string(trim($_POST['id_proposal'])) : '';
	$nama_customer	 	= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
	$nama_perusahaan  	= isset($_POST['nama_perusahaan']) ? mysql_real_escape_string(trim($_POST['nama_perusahaan'])) : '';
	$jawaban_proposal	= isset($_POST['jawaban_proposal']) ? mysql_real_escape_string(trim($_POST['jawaban_proposal'])) : '';
	
    $sql_update = "UPDATE `gx_jawab_proposal` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_jawab_proposal` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "INSERT INTO `gx_jawab_proposal` (`id_jawab_proposal`, `id_cabang`,
						   `tanggal`, `kode_jawab_proposal`, `id_proposal`, `nama_customer`, `nama_perusahaan`, `jawaban_proposal`, 
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."',
						  '".$tanggal."', '".$kode_jawab_proposal."', '".$id_proposal."', '".$nama_customer."', '".$nama_perusahaan."', '".$jawaban_proposal."',
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
			window.location.href='".URL_ADMIN."reproposal/master_jawab_proposal.php';
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

    $title	= 'Form Jawab Proposal';
    $submenu	= "jawab_proposal";
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