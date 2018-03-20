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
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Template Email");
    
    

if(isset($_GET["id"])){

	$id_data	= isset( $_GET['id']) ? (int)$_GET['id'] : "";
	$query		= "SELECT * FROM `gx_tipe_notif` WHERE `id_tipe` = '".$id_data."'  LIMIT 0,1";
	$sql_data	= mysql_query($query);
	$row_data	= mysql_fetch_array($sql_data);
	
	
}
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
						<form action="" method="post" name="form_email" autocomplete="off" enctype="multipart/form-data" autocomplete="off">
                            <div class="box">
								<div class="box-header">
                                    <h3 class="box-title">Form Kategori</h3>
                                </div><!-- /.box-header -->
												
                                <div class="box-body">
								<div class="form-group">
									<div class="row">
										<div class="col-xs-2">
											<label>Nama</label>
										</div>
										<div class="col-xs-8">
											<input type="text" class="form-control" required="" name="nama_tipe" value="'.(isset($_GET["id"]) ? $row_data["nama_tipe"] : '').'">
											<input type="hidden" name="id_tipe" readonly="" value="'.(isset($_GET["id"]) ? $row_data["id_tipe"] : '').'" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-xs-2">
											<label>Keterangan</label>
										</div>
										<div class="col-xs-8">
											<input type="text" class="form-control" required="" name="keterangan" value="'.(isset($_GET["id"]) ? $row_data["keterangan"] : '').'">
											
										</div>
									</div>
								</div>
								
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					
				</div>
				<div class="col-xs-8">
					<button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
				</div>
			</div>
		</div>
		
			
		</div>
	
          
	
	
                               
                            </div><!-- /.box -->
							</form>
                        </div>
                    </div>

                </section>
            ';

if(isset($_POST["save"]))
{
	$nama_tipe		= isset($_POST['nama_tipe']) ? mysql_real_escape_string($_POST["nama_tipe"]) : "";
	$keterangan		= isset($_POST['keterangan']) ? mysql_real_escape_string($_POST["keterangan"]) : "";
	
	if($nama_tipe !="" AND $keterangan !="")
	{
		
		$query = "INSERT INTO `software`.`gx_tipe_notif` (`id_tipe`, `nama_tipe`, `keterangan`)
		VALUES (NULL, '".$nama_tipe."', '".$keterangan."');";
	
		mysql_query($query) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
				</script>");
	
		echo "<script language='JavaScript'>
				alert('Data telah disimpan!');
				location.href = 'list_kategori_notif.php';
				</script>";
	
	}
	else
	{
		echo "<script language='JavaScript'>
				alert('Data Judul tidak boleh kosong!');
				location.href = 'form_kategori.php';
				</script>";	
	}
}
elseif( isset($_POST["update"]))
{
	$id_tipe		= isset($_POST['id_tipe']) ? strip_tags(trim($_POST["id_tipe"])) : "";
	$nama_tipe		= isset($_POST['nama_tipe']) ? mysql_real_escape_string($_POST["nama_tipe"]) : "";
	$keterangan		= isset($_POST['keterangan']) ? mysql_real_escape_string($_POST["keterangan"]) : "";
	
	//$last_upd	= isset($_POST['last_upd']) ? strip_tags(trim($_POST["last_upd"])) : "";
	
	if($judul !="" AND $isi != "" AND $id != "")
	{
		$query = "UPDATE `software`.`gx_tipe_notif` SET `nama_tipe`='".$nama_tipe."', `keterangan`='".$keterangan."'
		WHERE (`id_tipe`='".$id_tipe."');";
		
			//echo $query;
		mysql_query($query) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
				</script>");
		
		echo "<script language='JavaScript'>
				alert('Data telah disimpan!');
				location.href = 'list_kategori_notif.php';
				</script>";
	}
	else
	{
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'form_email.php';
            </script>";
	}
}

$plugins = '<!-- bootstrap wysihtml5 - text editor -->
        <link href="'.URL.'css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        
        <script src="'.URL.'js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="'.URL.'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace(\'editor1\');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>
';

    $title	= 'Form Kategori';
    $submenu	= "tipe_notif";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
	}
	else
	{
		
		header("location: ".URL_ADMIN."logout.php");
	}
    }
	else
	{
		header("location: ".URL_ADMIN."logout.php");
    }

?>