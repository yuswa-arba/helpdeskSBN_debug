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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Service Plan");
    global $conn;
    

if(isset($_GET["id"])){

	$id_data	= isset( $_GET['id']) ? (int)$_GET['id'] : "";
	$query		= "SELECT * FROM `gx_service_plan` WHERE `level` = '0' AND `id_service_plan` = '".$id_data."' LIMIT 0,1";
	$sql_data	= mysql_query($query);
	$row_data	= mysql_fetch_array($sql_data);
	
	
}


    $content ='<section class="content-header">
                    <h1>
                        Form Service Plan
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
						<form action="" method="post" name="form_serviceplan" enctype="multipart/form-data">
                            <div class="box">
								<div class="box-header">
                                    <h3 class="box-title">Form Service Plan</h3>
                                </div><!-- /.box-header -->
												
                                <div class="box-body table-responsive">
		
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label>Nama</label>
				</div>
				<div class="col-xs-6">
					<input type="text" class="form-control" required="" name="nama" value="'.(isset($_GET["id"]) ? $row_data["nama"] : "").'">
					<input type="hidden" name="id_service_plan" readonly="" value="'.(isset($_GET["id"]) ? $row_data["id_service_plan"] : "").'" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label>Kategori</label>
				</div>
				<div class="col-xs-6">
					<select name="kategori" class="form-control">
                
						<option value="FO" '.(isset($_GET['id']) && ($row_data["kategori"]=="FO") ? 'selected=""' : "").' >FO (Fiber Optic)</option>
						<option value="WL" '.(isset($_GET['id']) && ($row_data["kategori"]=="WL") ? 'selected=""' : "").' >WL (Wirelless)</option>
						<option value="PHONE" '.(isset($_GET['id']) && ($row_data["kategori"]=="PHONE") ? 'selected=""' : "").' >PHONE</option>
						<option value="TV" '.(isset($_GET['id']) && ($row_data["kategori"]=="TV") ? 'selected=""' : "").' >TV</option>

              </select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label>Tipe</label>
				</div>
				<div class="col-xs-9">
					<input name="tipe" class="form-control" type="text" id="tipe" value="'.(isset($_GET['id']) ? $row_data["tipe"] : "").'" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label>Fitur</label>
				</div>
				<div class="col-xs-9">
					<textarea id="editor1" name="fitur" >'.(isset($_GET["id"]) ? $row_data["fitur"] : '').'</textarea>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label>Term and Condition (TC)</label>
				</div>
				<div class="col-xs-9">
					<textarea id="editor2" name="term" >'.(isset($_GET["id"]) ? $row_data["term"] : '').'</textarea>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label>Status</label>
				</div>
				<div class="col-xs-6">
					<select name="status" class="form-control">
                
						<option value="1" '.(isset($_GET['id']) && ($row_data["status"]=="1") ? 'selected=""' : "").' >Aktif</option>
						<option value="0" '.(isset($_GET['id']) && ($row_data["status"]=="0") ? 'selected=""' : "").' >Nonaktif</option>
						

              </select>
				</div>
			</div>
		</div>
		</div><!-- /.box-body -->
			
		   
		<div class="box-footer">
			<button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
		</div>
	
          
	
	
                               
                            </div><!-- /.box -->
							</form>
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

if(isset($_POST["save"]))
{
	$nama		= isset($_POST['nama']) ? strip_tags(trim($_POST["nama"])) : "";
	$kategori	= isset($_POST['kategori']) ? strip_tags(trim($_POST["kategori"])) : "";
	$tipe		= isset($_POST['tipe']) ? strip_tags(trim($_POST["tipe"])) : "";
 	$fitur		= isset($_POST['fitur']) ? mysql_real_escape_string($_POST["fitur"]) : "";
	$term	 	= isset($_POST['term']) ? mysql_real_escape_string($_POST["term"]) : "";
	$status 	= isset($_POST['status']) ? strip_tags(trim($_POST["status"])) : "";
	
	
	if($nama != ""){
	
		$query = "INSERT INTO `gx_service_plan` (`id_service_plan`, `nama`, `tipe`, `kategori`, `fitur`, `term`, `status`,
		`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
		VALUES (NULL, '".$nama."', '".$tipe."', '".$kategori."', '".$fitur."', '".$term."', '".$status."',
		'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
		
		mysql_query($query) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
			</script>");
		
		echo "<script language='JavaScript'>
				alert('Data telah disimpan!');
				location.href = 'service_plan.php';
			</script>";
	
	
	}
	else
	{
		echo "<script language='JavaScript'>
				alert('Data userid tidak boleh kosong!');
				location.href = 'form_serviceplan.php';
				</script>";	
	}
}
elseif( isset($_POST["update"]))
{
    $id_service_plan	= isset($_POST['id_service_plan']) ? strip_tags(trim($_POST["id_service_plan"])) : "";
    $nama		= isset($_POST['nama']) ? strip_tags(trim($_POST["nama"])) : "";
	$kategori	= isset($_POST['kategori']) ? strip_tags(trim($_POST["kategori"])) : "";
	$tipe		= isset($_POST['tipe']) ? strip_tags(trim($_POST["tipe"])) : "";
 	$fitur		= isset($_POST['fitur']) ? mysql_real_escape_string($_POST["fitur"]) : "";
	$term	 	= isset($_POST['term']) ? mysql_real_escape_string($_POST["term"]) : "";
	$status 	= isset($_POST['status']) ? strip_tags(trim($_POST["status"])) : "";
	
	if($nama !="" AND $id_service_plan != "")
	{
		$query = "UPDATE `gx_service_plan` SET  `nama`='".$nama."', `tipe`='".$tipe."', `kategori`='".$kategori."',
		`fitur`='".$fitur."', `term`='".$term."', `status`='".$status."', 
		`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
		WHERE `id_service_plan` = '".$id_service_plan."'";
		
			//echo $query;
		mysql_query($query) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
				</script>");
		
		echo "<script language='JavaScript'>
				alert('Data telah disimpan!');
				location.href = 'service_plan.php';
				</script>";
	}
	else
	{
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'form_serviceplan.php';
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
				CKEDITOR.replace(\'editor2\');
                //bootstrap WYSIHTML5 - text editor
                //$(".textarea").wysihtml5();
            });
        </script>
		
	<!-- InputMask -->
    <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<!-- datepicker -->
    <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
	<!-- bootstrap time picker -->
	<link rel="stylesheet" href="'.URL.'css/timepicker/bootstrap-timepicker.min.css">
    <script src="'.URL.'js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	
	
        <script>
            $(function()
			{
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
				//Timepicker
				$(".timepicker").timepicker({
				  showInputs: false
				});
            });
        </script>';

    $title	= 'Form Service Plan';
    $submenu	= "Form Service Plan";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
		header("location: ".URL_CSO."logout.php");
    }

?>