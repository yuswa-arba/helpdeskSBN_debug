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
   
require_once 'mailer/class.phpmailer.php';

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if( checkRole($loggedin["id_group"], 'email') == "0")  { die( 'Access Denied!' );}
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form footer ");
    global $conn;
    global $conn_voip;
 
$id_category 	= isset($_GET['id_category']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_category']))) : "";

$sql_category 	= mysql_fetch_array(mysql_query("select * FROM `gx_email_kategori` WHERE `id_kategori` = '$id_category' ORDER BY `id_kategori` DESC LIMIT 1", $conn));
//echo ''.$id_email.' hhhfhfhh'; 
 	
$save	= isset($_POST['insert']) ? $_POST["insert"] : "";
$edit	= isset($_POST['update']) ? $_POST["update"] : "";
if($save == "Save"){
         
	$name_category 	= isset($_POST['name_category']) ?  mysql_real_escape_string(strip_tags(trim($_POST["name_category"]))) : "";
	$desc_category 	= isset($_POST['desc_category']) ?  mysql_real_escape_string(strip_tags(trim($_POST["desc_category"]))) : "";
	
            
    $sql_insert = "INSERT INTO `gx_email_kategori`(`id_kategori`,`nama_kategori`, `desc_kategori`, `user_add`, `date_add`, `date_upd`, `level`)
	    VALUES('', '$name_category', '$desc_category', '$loggedin[username]', NOW(), NOW(), '0')";
	    //echo $sql_insert;
   
    mysql_query($sql_insert, $conn) or die("<script language='JavaScript'>
				    alert('Maaf Data tidak bisa disimpan ke dalam Database, Ada kesalahan!');
				    window.history.go(-1);
			      </script>");
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "insert category = $sql_insert");
    echo "<script language='JavaScript'>
         alert('Data Telah tersimpan');
         location.href = 'setting_email.php';
      </script>";
   
}elseif($edit == "Save"){
        
	$name_category 	= isset($_POST['name_category']) ?  mysql_real_escape_string(strip_tags(trim($_POST["name_category"]))) : "";
	$desc_category 	= isset($_POST['desc_category']) ?  mysql_real_escape_string(strip_tags(trim($_POST["desc_category"]))) : "";
	    
    $sql_insert = "UPDATE `gx_email_kategori` SET `nama_kategori` = '$name_category', desc_kategori = '$desc_category', `user_upd` = '$loggedin[username]', `date_upd` = NOW()
	    WHERE `gx_email_kategori`.`id_kategori` = $id_category;";
	    //echo $sql_insert;
   
    mysql_query($sql_insert, $conn) or die("<script language='JavaScript'>
				    alert('Maaf Data tidak bisa disimpan ke dalam Database, Ada kesalahan!');
				    window.history.go(-1);
			      </script>");
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Edit category = $sql_insert");
    echo "<script language='JavaScript'>
         alert('Data Telah tersimpan');
         location.href = 'setting_email.php';
      </script>";
   
}   
 
    $content ='<section class="content-header">
                    <h1>
                        Form Category
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Category</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				    <form action="" method="post" name="form_reply">
				
				    
          <table style="width:50%;">
	    <tbody>
	    
	    <tr style="vertical-align: middle;">
		<td style="vertical-align: middle;">
		    <label>Nama Kategori</label>
		</td>
		<td>
		    <div class="box-body pad">
			<input type="text" class="form-control" data-icon="v" name="name_category" value="'.(isset($_GET['id_category']) ? $sql_category["nama_kategori"] : "").'">
		    </div>
		</td>
	    </tr>
	    <tr style="vertical-align: middle;">
		<td style="vertical-align: middle;">
		    <label>Desc Kategori</label>
		</td>
		<td>
		    <div class="box-body pad">
			<input type="text" class="form-control" data-icon="v" name="desc_category" value="'.(isset($_GET['id_category']) ? $sql_category["desc_kategori"] : "").'">
		    </div>
		</td>
	    </tr>
	    
	    </tbody>
	</table>
	<div class="actions" align="center">
	    <div class="button-well">
		<input type="submit" class="btn bg-blue btn-flat" data-icon="v" name="'.(isset($_GET['id_category']) ? "update" : "insert").'" value="Save">
	    </div>
	</div>
	
	</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script src="'.URL.'js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
	<script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace(\'editor1\');
                
		CKEDITOR.replace(\'editor2\', {readOnly:true});
                
            });
        </script>';

    $title	= 'Form Category';
    $submenu	= "setting";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>