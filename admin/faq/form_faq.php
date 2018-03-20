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
    
if(isset($_POST["save"]))
{
    //echo "save";
    $kategori_faq	= isset($_POST['kategori_faq']) ? mysql_real_escape_string(trim($_POST['kategori_faq'])) : '';
    $judul_faq		= isset($_POST['judul_faq']) ? mysql_real_escape_string(trim($_POST['judul_faq'])) : '';
    $tanya_faq		= isset($_POST['tanya_faq']) ? mysql_real_escape_string(trim($_POST['tanya_faq'])) : '';
    $jawab_faq   	= isset($_POST['jawab_faq']) ? mysql_real_escape_string(trim($_POST['jawab_faq'])) : '';
	
    if($judul_faq != ""){
    
		//insert into gxCabang
		$sql_insert = "INSERT INTO `gx_faq` (`id_faq`, `kategori_faq`, `judul_faq`, `tanya_faq`, `jawab_faq`,
		`useradd_faq`, `userupd_faq`, `dateadd_faq`, `dateupd_faq`, `level`)
		VALUES (NULL, '".$kategori_faq."', '".$judul_faq."', '".$tanya_faq."','".$jawab_faq."',    
		'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
		
		//echo $sql_insert;
		mysql_query($sql_insert, $conn) or die (mysql_error());
		
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
		
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='list_faq.php';
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
    
    $id_faq		 	= isset($_POST['id_faq']) ? mysql_real_escape_string(trim($_POST['id_faq'])) : '';
    $kategori_faq	= isset($_POST['kategori_faq']) ? mysql_real_escape_string(trim($_POST['kategori_faq'])) : '';
    $judul_faq		= isset($_POST['judul_faq']) ? mysql_real_escape_string(trim($_POST['judul_faq'])) : '';
    $tanya_faq		= isset($_POST['tanya_faq']) ? mysql_real_escape_string(trim($_POST['tanya_faq'])) : '';
    $jawab_faq   	= isset($_POST['jawab_faq']) ? mysql_real_escape_string(trim($_POST['jawab_faq'])) : '';
	
	
    if($id_faq != ""){
	
	$sql_update = "UPDATE `gx_faq` SET `kategori_faq`='".$kategori_faq."',
	`judul_faq`='".$judul_faq."', `tanya_faq`='".$tanya_faq."', `jawab_faq`='".$jawab_faq."',
	`userupd_faq`='".$loggedin["username"]."', `dateupd_faq`=NOW() WHERE (`id_faq`='".$id_faq."');";
    
	//echo $sql_update;
	mysql_query($sql_update, $conn) or die (mysql_error());
	
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
	
	echo "<script language='JavaScript'>
	    alert('Data telah diupdate.');
	    window.location.href='list_faq.php';
	    </script>";
	    
    }else{
	
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
	    
    }
	
}

if(isset($_GET["id"]))
{
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data = "SELECT * FROM `gx_faq` WHERE `id_faq`='".$id_data."' LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
    
	$kategori = $row_data["kategori_faq"];
}

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form FAQ</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_faq" id="form_faq" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Title</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="judul_faq" name="judul_faq" required="" value="'.(isset($_GET['id']) ? $row_data["judul_faq"] : "").'">
					    <input type="hidden" name="id_faq" value="'.(isset($_GET['id']) ? $row_data["id_faq"] : "").'">
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kategori</label>
					    </div>
					    <div class="col-xs-3">
							<select class="form-control" name="kategori_faq">
								<option value="billing" '.((isset($_GET['id']) AND $kategori== "billing") ? 'selected=""' : "").'>Billing</option>
								<option value="helpdesk" '.((isset($_GET['id']) AND $kategori== "helpdesk") ? 'selected=""' : "").'>Helpdesk</option>
								<option value="cso" '.((isset($_GET['id']) AND $kategori== "cso") ? 'selected=""' : "").'>CSO</option>
								<option value="marketing" '.((isset($_GET['id']) AND $kategori== "marketing") ? 'selected=""' : "").'>Marketing</option>
								<option value="other" '.((isset($_GET['id']) AND $kategori== "other") ? 'selected=""' : "").'>Other</option>
							</select>
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>Tanya</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="tanya_faq" value="'.(isset($_GET['id']) ? $row_data["tanya_faq"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Jawab</label>
                                            </div>
					    <div class="col-xs-9">
						<textarea  id="editor" class="form-control"  name="jawab_faq">'.(isset($_GET['id']) ? $row_data["jawab_faq"] : "").'</textarea>
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

$plugins = '<!-- bootstrap wysihtml5 - text editor -->
        <link href="'.URL.'css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        
        <script src="'.URL.'js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="'.URL.'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace(\'editor\');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>';

    $title	= 'FAQ';
    $submenu	= "faq";
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