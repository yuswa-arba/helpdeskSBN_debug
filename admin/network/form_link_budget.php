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
    
	    if(isset($_GET['id_link'])){
		$get_id = isset($_GET['id_link']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_link']))) : "";
		$data_link = mysql_fetch_array(mysql_query("SELECT * FROM `gx_link_budget` WHERE `gx_link_budget`.`id_link_budget` = '$get_id';", $conn));
	    }
    
 
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Link Budget</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="myForm" method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="">
						<input type="hidden" readonly="" class="form-control" required="" name="cabang" value="">
						<a href="'.URL_ADMIN.'administrasi/data_cabang.php?r=myForm&f=linkbudget"  onclick="return valideopenerform(\''.URL_ADMIN.'administrasi/data_cabang.php?r=myForm&f=linkbudget\',\'cabang\');">Search cabang</a>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No. Link Budget</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" id="link" name="link" required="" readonly="" value="'.(isset($_GET["id_link"]) ? $data_link['no_linkbudget'] : "").'">
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" id="tanggal" name="tanggal" readonly="" required="" value="'.(isset($_GET["id_link"]) ? $data_link['tanggal'] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Cust</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" readonly="" required="" name="kode_cust" value="'.(isset($_GET["id_link"]) ? $data_link['kode_cust'] : "").'">
						<a href="'.URL_ADMIN.'administrasi/data_custlink.php?r=myForm"  onclick="return valideopenerform(\''.URL_ADMIN.'administrasi/data_custlink.php?r=myForm\',\'cust\');">Search customer</a>
					    </div>
                                            <div class="col-xs-2">
						<label>nama Cust</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" id="nama" name="nama" readonly="" required="" value="'.(isset($_GET["id_link"]) ? $data_link['nama_cust'] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Longitude</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="longitude" value="'.(isset($_GET["id_link"]) ? $data_link['longitude'] : "").'">
					    </div>
					    <div class="col-xs-2">
						<label>Latitude</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="latitude" value="'.(isset($_GET["id_link"]) ? $data_link['latitude'] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No. Tiang Terdekat</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="no_tiang" value="'.(isset($_GET["id_link"]) ? $data_link['tiang_terdekat'] : "").'">
					    </div>
					    <div class="col-xs-2">
						<label>Name Created</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" readonly="" name="name_created" value="'.(isset($_GET["id_link"]) ? $data_link['user_created'] : $loggedin["username"]).'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Power Budget</label>
                                            </div>
					    <div class="col-xs-10">
						<textarea id="editor1"  rows="10" name="power_budget">'.(isset($_GET["id_link"]) ? $data_link['power_budget'] : "").'</textarea>
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Alat yang dibutuhkan</label>
                                            </div>
					    <div class="col-xs-10">
						<textarea  id="editor2" rows="10" name="list_alat">'.(isset($_GET["id_link"]) ? $data_link['list_alat'] : "").'</textarea>
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Total Link Budget</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="total" value="'.(isset($_GET["id_link"]) ? $data_link['total'] : "").'">
					    </div>
					   
                                        </div>
					</div>
					
					
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="'.(isset($_GET["id_link"]) ? "update" : "save") .'" value="Save" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
	    
$save = isset($_POST["save"]) ? $_POST["save"] : "";
$update = isset($_POST["update"]) ? $_POST["update"] : "";

	if($save == "Save"){
	    
	    $link		= isset($_POST['link']) ? mysql_real_escape_string(strip_tags(trim($_POST['link']))) : "";
	    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(strip_tags(trim($_POST['tanggal']))) : "";
	    $kode_cust		= isset($_POST['kode_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_customer']))) : "";
	    $nama_cust		= isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
	    $longitude		= isset($_POST['longitude']) ? mysql_real_escape_string(strip_tags(trim($_POST['longitude']))) : "";
	    $latitude		= isset($_POST['latitude']) ? mysql_real_escape_string(strip_tags(trim($_POST['latitude']))) : "";
	    $no_tiang		= isset($_POST['no_tiang']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_tiang']))) : "";
	    $name_created	= isset($_POST['name_created']) ? mysql_real_escape_string(strip_tags(trim($_POST['name_created']))) : "";
	    $power_budget	= isset($_POST['power_budget']) ? $_POST['power_budget'] : "";
	    $list_alat		= isset($_POST['list_alat']) ? $_POST['list_alat'] : "";
	    $total		= isset($_POST['total']) ? mysql_real_escape_string(strip_tags(trim($_POST['total']))) : "";

	    
		    
		$insert_link_budget  	= "INSERT INTO `gx_link_budget`(`id_link_budget`, `no_linkbudget`, `tanggal`, `kode_cust`, `nama_cust`,
									`latitude`, `longitude`, `tiang_terdekat`, `user_created`, `power_budget`,
									`list_alat`, `total`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
								VALUES ('', '$link', '$tanggal', '$kode_cust', '$nama_cust',
									'$latitude', '$longitude', '$no_tiang', '$name_created', '$power_budget',
									'$list_alat', '$total', NOW(), NOW(), '$loggedin[username]', '$loggedin[username]', '0');";
		//echo $insert_link_budget;
		mysql_query($insert_link_budget, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert link_budget = $insert_link_budget");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'link_budget.php';
		</script>";
	}elseif($update == "Save"){
	    
	    $link		= isset($_POST['link']) ? mysql_real_escape_string(strip_tags(trim($_POST['link']))) : "";
	    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(strip_tags(trim($_POST['tanggal']))) : "";
	    $kode_cust		= isset($_POST['kode_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_customer']))) : "";
	    $nama_cust		= isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
	    $longitude		= isset($_POST['longitude']) ? mysql_real_escape_string(strip_tags(trim($_POST['longitude']))) : "";
	    $latitude		= isset($_POST['latitude']) ? mysql_real_escape_string(strip_tags(trim($_POST['latitude']))) : "";
	    $no_tiang		= isset($_POST['no_tiang']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_tiang']))) : "";
	    $name_created	= isset($_POST['name_created']) ? mysql_real_escape_string(strip_tags(trim($_POST['name_created']))) : "";
	    $power_budget	= isset($_POST['power_budget']) ? $_POST['power_budget'] : "";
	    $list_alat		= isset($_POST['list_alat']) ? $_POST['list_alat'] : "";
	    $total		= isset($_POST['total']) ? mysql_real_escape_string(strip_tags(trim($_POST['total']))) : "";

		    
		$update_link_budget    	= "UPDATE `gx_link_budget` SET `kode_cust`='$kode_cust',
					`nama_cust`='$nama_cust',`latitude`='$latitude',
					`longitude`='$longitude',`tiang_terdekat`='$no_tiang',`power_budget`='$power_budget',
					`list_alat`='$list_alat',`total`='$total',
					`date_upd`=NOW(),`user_upd`='$loggedin[username]' WHERE `id_link_budget`='$_GET[id_link]'";
					
		
		//echo $insert_prospek;
		mysql_query($update_link_budget, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit link_budget = $update_link_budget");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'link_budget.php';
		</script>";
	}
$plugins = '
	    <script src="'.URL.'js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
	    
	<script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace(\'editor1\');
		CKEDITOR.replace(\'editor2\');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
	    
        </script>
	
	
    ';

    $title	= 'Form Survey';
    $submenu	= "survey";
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