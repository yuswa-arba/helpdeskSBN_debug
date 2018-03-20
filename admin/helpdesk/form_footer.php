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
 
$id_footer 	= isset($_GET['id_footer']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_footer']))) : "";

$sql_footer  	= mysql_fetch_array(mysql_query("select * FROM `gx_email_footer` WHERE `id_footer` = '$id_footer' ORDER BY `id_footer` DESC LIMIT 1", $conn));
//echo ''.$id_email.' hhhfhfhh'; 
 	
$save	= isset($_POST['insert']) ? $_POST["insert"] : "";
$edit	= isset($_POST['update']) ? $_POST["update"] : "";
if($save == "Save"){
         
	$footer 	= isset($_POST['footer']) ? $_POST["footer"] : '';
	$active		= isset($_POST['active']) ? mysql_real_escape_string(strip_tags(trim($_POST['active']))) : "";
            
    $sql_insert = "INSERT INTO `gx_email_footer`(`id_footer`,`id_employee`, `footer`, `user_add`, `date_add`, `date_upd`, `active`, `level`)
	    VALUES('', '$loggedin[id_employee]', '$footer', '$loggedin[username]', NOW(), NOW(), '$active', '0')";
	    //echo $sql_insert;
   
    mysql_query($sql_insert, $conn) or die("<script language='JavaScript'>
				    alert('Maaf Data tidak bisa disimpan ke dalam Database, Ada kesalahan!');
				    window.history.go(-1);
			      </script>");
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "insert Footer = $sql_insert");
    echo "<script language='JavaScript'>
         alert('Data Footer Telah tersimpan');
         location.href = 'setting_email.php';
      </script>";
   
}elseif($edit == "Save"){
         
	$footer 	= isset($_POST['footer']) ? $_POST["footer"] : '';
	$active		= isset($_POST['active']) ? mysql_real_escape_string(strip_tags(trim($_POST['active']))) : "";
            
    $sql_insert = "UPDATE `gx_email_footer` SET `footer` = '$footer', `user_upd` = '$loggedin[username]', `date_upd` = NOW(), `active` = '$active'
	    WHERE `gx_email_footer`.`id_footer` = $id_footer;";
	    //echo $sql_insert;
   
    mysql_query($sql_insert, $conn) or die("<script language='JavaScript'>
				    alert('Maaf Data tidak bisa disimpan ke dalam Database, Ada kesalahan!');
				    window.history.go(-1);
			      </script>");
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Edit Footer = $sql_insert");
    echo "<script language='JavaScript'>
         alert('Data Footer Telah tersimpan');
         location.href = 'setting_email.php';
      </script>";
   
}   
 
    $content ='<section class="content-header">
                    <h1>
                        Form Footer
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Footer</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				    <form action="" method="post" name="form_reply">
				
				    
          <table style="width:80%;">
	    <tbody>
	    
	    <tr style="vertical-align: middle;">
		<td style="vertical-align: middle;">
		    <label>Footer</label>
		</td>
		<td>
		    <div class="box-body pad">
			<textarea name="footer" rows="6" cols="50" id="editor1" style="resize: none;" style="resize: none;">
				'.(isset($_GET['id_footer']) ? $sql_footer["footer"] : "").'
			</textarea>
		    </div>
		</td>
	    </tr>
	    <tr>
		<td>
		  <label>Active</label>
		</td>
		<td>
		  <input type="radio" id="yes" name="active" value="0" style="float:left;" '.((isset($_GET['id_footer']) && $sql_footer["active"] == "0") ? "checked" : "").'> Yes
		  <input type="radio" id="no" name="active" value="1" style="float:left;" '.((isset($_GET['id_footer']) && $sql_footer["active"] == "1") ? "checked" : "checked").'> No
		</td>
	      </tr>
	    </tbody>
	</table>
	<div class="actions" align="center">
	    <div class="button-well">
		<input type="submit" class="btn bg-blue btn-flat" data-icon="v" name="'.(isset($_GET['id_footer']) ? "update" : "insert").'" value="Save">
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

    $title	= 'Form Footer';
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