<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
//enableLog( "", $loggedin["username"], $loggedin["id_employee"], "Open Form TV Channel");   
    global $conn;
    global $conn_voip;

if(isset($_POST["save_category"])){
   
       $category	= isset($_POST['category']) ? mysql_real_escape_string(strip_tags(trim($_POST['category']))) : "";
 
       $query = "INSERT INTO `gx_tv_category` (`id_category`, `category`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
				       VALUES ('', '$category', '$loggedin[username]', '$loggedin[username]', NOW(), NOW(), '0')";
      
       
       mysql_query($query, $conn) or die("<script language='JavaScript'>
				   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				   window.history.go(-1);
		       </script>");
       echo "<script language=\"JavaScript\">
	       alert('Data telah disimpan!');
	       location.href = '".URL_ADMIN."tv/list_category.php';
	   </script>";   
   


}elseif(isset($_POST["edit_category"])){
    $id_category	= isset($_POST['id_category']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_category']))) : "";
    $category		= isset($_POST['category']) ? mysql_real_escape_string(strip_tags(trim($_POST['category']))) : "";
    
    
$query = "UPDATE `gx_tv_category` SET `category` = '$category', `user_upd` = '$loggedin[username]',
					   `date_upd` = NOW(), `level` = '0' WHERE `id_category` = '$id_category'";
//echo $query;
mysql_query($query, $conn) or die("<script language='JavaScript'>
				    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				    window.history.go(-1);
			</script>");
	echo "<script language=\"JavaScript\">
		alert('Data telah disimpan!');
		location.href = '".URL_ADMIN."tv/list_category.php';
	    </script>";   
}

if(isset($_GET["id_category"])){
    
    $sql_tv_category	= "SELECT * FROM `gx_tv_category` WHERE `id_category` = '$_GET[id_category]';";
    $query_tv_category	= mysql_query($sql_tv_category, $conn);
    $row_tv_category	= mysql_fetch_array($query_tv_category); 
    
}
    $content ='<section class="content-header">
                    <h1>
                        Category
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="form_category"> Form Category</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			<form role="form"  method="POST" action="">
			    <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Form Category</h2>
                                </div>
				<div class="box-body">
                                    <table width="100%" style="border-collapse: inherit;border-spacing: 3px;">
                                        <thead>
                                            <tr>
						
						<th width="15%">Category : </th>
						<th width="70%"><input type="text" class="form-control" name="category" value="'.(isset($_GET['id_category']) ? $row_tv_category["category"] : "").'" style="width : 53%;"></th>
                                            </tr>
                                        </thead>
                                        </table>
					<div class="box-footer">
					    
					    <input type="hidden" name="id_category" value="'.(isset($_GET['id_category']) ? $_GET["id_category"] : "").'"/>
					    <button type="submit" name="'.(isset($_GET['id_category']) ? "edit_category" : "save_category").'" class="btn btn-primary">Save</button>
					</div>
                                </div>
			    </div>
			    
			    </form>
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script type="text/javascript">
             function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(\'#preview\')
                        .attr(\'src\', e.target.result)
                        .width(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
    ';

    $title	= 'Form TV Channel';
    $submenu	= "VOD";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>