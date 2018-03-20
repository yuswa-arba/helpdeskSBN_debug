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
	$query		= "SELECT * FROM `gx_template_notif` WHERE `level` = '0' AND `id` = '".$id_data."' AND `tipe` = '2' LIMIT 0,1";
	$sql_data	= mysql_query($query);
	$row_data	= mysql_fetch_array($sql_data);
	
	
}
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
						<form action="" method="post" name="form_email" autocomplete="off" enctype="multipart/form-data">
                            <div class="box">
								<div class="box-header">
                                    <h3 class="box-title">Form Template Email</h3>
                                </div><!-- /.box-header -->
												
                                <div class="box-body table-responsive">
				
		
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Judul</label>
				</div>
				<div class="col-xs-8">
					<input type="text" class="form-control" required="" name="judul" value="'.(isset($_GET["id"]) ? $row_data["judul"] : '').'">
					<input type="hidden" name="id" readonly="" value="'.(isset($_GET["id"]) ? $row_data["id"] : '').'" />
				</div>
			</div>
		</div>
		<div class="form-group">
		<div class="row">
			<div class="col-xs-2">
				<label>Kategori</label>
			</div>
			<div class="col-xs-8">
				<select class="form-control" name="kategori">
				<option value=""></option>';
			

$sql_tipe	= mysql_query("SELECT * FROM `gx_tipe_notif`;",$conn);
while($row_tipe	= mysql_fetch_array($sql_tipe))
{
$content .= '<option '.((isset($_GET['id']) AND $row_data["kategori"] == $row_tipe["nama_tipe"]) ? 'selected="selected"' : "").' value="'.$row_tipe["nama_tipe"].'">'.$row_tipe["nama_tipe"].'</option>';
}

				
$content .='				</select>
			</div>
		</div>
		</div>
		<div class="form-group">
	
			<div class="row">
				<div class="col-xs-2">
					<label>Template</label>
				</div>
				<div class="col-xs-6">
					<textarea name="isi" cols="40" rows="6" style="resize:none" >'.(isset($_GET["id"]) ? $row_data["isi"] : '').'</textarea>
				</div>
			</div>
		</div>
		
		<button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
		
		</div><!-- /.box-body -->
			
		   
		<div class="box-footer">
			
		</div>
	
          
	
	
                               
                            </div><!-- /.box -->
							</form>
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

if(isset($_POST["save"]))
{
	$judul		= isset($_POST['judul']) ? strip_tags(trim($_POST["judul"])) : "";
	$isi		= isset($_POST['isi']) ? mysql_real_escape_string($_POST["isi"]) : "";
	$kategori	= isset($_POST['kategori']) ? mysql_real_escape_string($_POST["kategori"]) : "";
	
	if($judul !="" AND $isi !="")
	{
		
		$query = "INSERT INTO `software`.`gx_template_notif` (`id`, `judul`, `isi`, `tipe`, `kategori`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
		VALUES ('', '$judul', '$isi', '2', '$kategori',
		'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0')";
	
		mysql_query($query) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
				</script>");
	
		echo "<script language='JavaScript'>
				alert('Data telah disimpan!');
				location.href = 'list_sms.php';
				</script>";
	
	}
	else
	{
		echo "<script language='JavaScript'>
				alert('Data Judul tidak boleh kosong!');
				location.href = 'form_sms.php';
				</script>";	
	}
}
elseif( isset($_POST["update"]))
{
	$id		= isset($_POST['id']) ? strip_tags(trim($_POST["id"])) : "";
	$judul	= isset($_POST['judul']) ? strip_tags(trim($_POST["judul"])) : "";
	$isi	= isset($_POST['isi']) ? mysql_real_escape_string($_POST["isi"]) : "";
	$kategori	= isset($_POST['kategori']) ? mysql_real_escape_string($_POST["kategori"]) : "";
	
	//$last_upd	= isset($_POST['last_upd']) ? strip_tags(trim($_POST["last_upd"])) : "";
	
	if($judul !="" AND $isi != "" AND $id != "")
	{
	$query = "UPDATE `gx_template_notif` SET `isi` = '".$isi."', `judul` = '".$judul."',
	`kategori` = '".$kategori."',
	`user_upd` = '".$loggedin["username"]."', `date_upd` = now()
		WHERE `id` = '".$id."';";
	
        //echo $query;
	mysql_query($query) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	
	echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'list_sms.php';
            </script>";
	}
	else
	{
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'form_sms.php';
            </script>";
	}
}

$plugins = '';

    $title	= 'Form Template Email';
    $submenu	= "template_email";
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