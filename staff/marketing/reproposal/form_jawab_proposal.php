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

$sql_cabangg	= "SELECT * FROM `gx_cabang` WHERE `id_cabang` = '$loggedin[cabang]' ORDER BY `id_cabang` ASC LIMIT 0,1;";
$query_cabangg	= mysql_query($sql_cabangg, $conn);
$row_cabangg = mysql_fetch_array($query_cabangg);
$sql_last_data = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_proposal` ORDER BY `id_jawab_proposal` DESC", $conn));
$last_data  = $sql_last_data["id_jawab_proposal"] + 1;
$tanggal    = date("d");
$kode_reproposalll = $row_cabangg["kode_cabang"].'-'.$row_cabangg["kode_jawab_proposal"].''.$tanggal.''.sprintf("%04d", $last_data);
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
												$content .='<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["id_cabang"] : $row_cabangg["id_cabang"]).'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_cabang["nama_cabang"] : $row_cabangg["nama_cabang"]).'"  onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=jawabproposal\',\'cabang\');">';
											}
											$content .='</div>
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? date("Y-m-d H:i", strtotime($row_data["tanggal"])) : date("Y-m-d H:i")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Jawaban Proposal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_jawab_proposal" name="kode_jawab_proposal" required="" value="'.(isset($_GET['id']) ? $row_data["kode_jawab_proposal"] : $kode_reproposalll).'" >
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
													<label>Re Proposal</label>
												</div>
												<div class="col-xs-3">
													<select name="re_proposal" class="form-control">
														<option value="yes">Yes</option>
														<option value="no">No</option>
														<option value="follows">Follow Again</option>
														<option value="done">Done</option>
													</select>
												</div>
											</div>
											</div>
											
											
											<div class="follow selectbox">
												<div class="form-group">
												<div class="row">
													<div class="col-xs-3">
														<label>Follow date</label>
													</div>
													<div class="col-xs-3">
															<input type="text" readonly="" class="form-control" id="datepicker" name="tgl_follow" required="" value="">
													</div>
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
	$re_proposal	  	= isset($_POST['re_proposal']) ? mysql_real_escape_string(trim($_POST['re_proposal'])) : '';
	$tgl_follow			= isset($_POST['tgl_follow']) ? mysql_real_escape_string(trim($_POST['tgl_follow'])) : '';
	
	$sql_insert = "INSERT INTO `gx_jawab_proposal` (`id_jawab_proposal`, `id_cabang`,
						   `tanggal`, `kode_jawab_proposal`, `id_proposal`, `nama_customer`, `nama_perusahaan`, `jawaban_proposal`,  `re_proposal`, `tanggal_follow`, 
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."',
						  '".$tanggal."', '".$kode_jawab_proposal."', '".$id_proposal."', '".$nama_customer."', '".$nama_perusahaan."', '".$jawaban_proposal."', '".$re_proposal."', '".$tgl_follow."',
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    if(($jawaban_proposal != "") && ($id_proposal != "")){
		//echo $sql_insert;
		mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
								   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
								   window.history.go(-1);
								   </script>");
		
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
		
		if($re_proposal == "yes")
		{
			echo "<script language='JavaScript'>
				alert('Data telah disimpan');
				window.location.href='".URL_STAFF."marketing/proposal/master_proposal.php';
				</script>";
		}elseif($re_proposal == "no")
		{
			echo "<script language='JavaScript'>
				alert('Data telah disimpan');
				window.location.href='".URL_STAFF."marketing/cetak_formulir.php';
				</script>";
		}elseif($re_proposal == "follow")
		{
			echo "<script language='JavaScript'>
				alert('Data telah disimpan');
				window.location.href='".URL_STAFF."marketing/reproposal/master_jawab_proposal.php';
				</script>";
		}elseif($re_proposal == "done")
		{
			echo "<script language='JavaScript'>
				alert('Data telah disimpan');
				window.location.href='".URL_STAFF."marketing/reproposal/master_jawab_proposal.php';
				</script>";
		}
	}else{
		echo "<script language='JavaScript'>
			alert('Data tidak boleh kosong!');
			window.history.go(-1);
			  </script>";
	}
    
	
			
    
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
	$re_proposal	  	= isset($_POST['re_proposal']) ? mysql_real_escape_string(trim($_POST['re_proposal'])) : '';
	$tgl_follow			= isset($_POST['tgl_follow']) ? mysql_real_escape_string(trim($_POST['tgl_follow'])) : '';
	
    $sql_update = "UPDATE `gx_jawab_proposal` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_jawab_proposal` = '$_GET[id]';";
    if(($jawaban_proposal != "") && ($id_proposal != "")){
		//echo $sql_update;
		mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
								   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
								   window.history.go(-1);
								   </script>");
		
		$sql_insert_update	= "INSERT INTO `gx_jawab_proposal` (`id_jawab_proposal`, `id_cabang`,
							   `tanggal`, `kode_jawab_proposal`, `id_proposal`, `nama_customer`, `nama_perusahaan`, `jawaban_proposal`,  `re_proposal`, `tanggal_follow`, 
							  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
						  VALUES ('', '".$kode_cabang."',
							  '".$tanggal."', '".$kode_jawab_proposal."', '".$id_proposal."', '".$nama_customer."', '".$nama_perusahaan."', '".$jawaban_proposal."', '".$re_proposal."', '".$tgl_follow."',
							  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";        
					
		
		//echo $sql_insert;
		mysql_query($sql_insert_update, $conn) or die ("<script language='JavaScript'>
								   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
								   window.history.go(-1);
								   </script>");
		
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
		
		if($re_proposal == "yes"){
			echo "<script language='JavaScript'>
				alert('Data telah disimpan');
				window.location.href='".URL_STAFF."marketing/proposal/master_proposal.php';
				</script>";
		}elseif($re_proposal == "no"){
			echo "<script language='JavaScript'>
				alert('Data telah disimpan');
				window.location.href='".URL_STAFF."marketing/cetak_formulir.php';
				</script>";
		}elseif($re_proposal == "follow"){
			echo "<script language='JavaScript'>
				alert('Data telah disimpan');
				window.location.href='".URL_STAFF."marketing/reproposal/master_jawab_proposal.php';
				</script>";
		}elseif($re_proposal == "done"){
			echo "<script language='JavaScript'>
				alert('Data telah disimpan');
				window.location.href='".URL_STAFF."marketing/reproposal/master_jawab_proposal.php';
				</script>";
		}
	}else{
		echo "<script language='JavaScript'>
			alert('Data tidak boleh kosong!');
			window.history.go(-1);
			  </script>";
	}
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
		<script>
		$(document).ready(function(){
			$("select").change(function(){
				$(this).find("option:selected").each(function(){
					if($(this).attr("value")=="follows"){
						$(".selectbox").not(".follow").hide();
						$(".follow").show();
					}
					else if($(this).attr("value")=="months"){
						$(".selectbox").not(".month").hide();
						$(".month").show();
					}
					else{
						$(".selectbox").hide();
					}
				});
			}).change();
		});
		</script>
		<style type="text/css">
			.togglebox{
				padding: 5px;
				display: none;
				margin-top: 20px;
			}
			.selectbox{
				padding: 5px;
				display: none;
				margin-top: 20px;
				
			}
		</style>
		';

    $title	= 'Form Jawab Proposal';
    $submenu	= "jawab_proposal";
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