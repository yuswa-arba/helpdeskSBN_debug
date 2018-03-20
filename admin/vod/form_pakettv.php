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
enableLog( "", $loggedin["username"], $loggedin["id_employee"], "Open Form Paket TV");   
    global $conn;
    global $conn_voip;

if(isset($_POST["save_package"])){
    $idpackage		= isset($_POST['idpackage']) ? mysql_real_escape_string(strip_tags(trim($_POST['idpackage']))) : "";
    $package_name	= isset($_POST['package_name']) ? mysql_real_escape_string(strip_tags(trim($_POST['package_name']))) : "";
    $desc		= isset($_POST['desc']) ? mysql_real_escape_string(strip_tags(trim($_POST['desc']))) : "";
    $role_package 	= array();
    $role_package	= isset($_POST["role_package"]) ? $_POST["role_package"] : $role_package;
    $id_package		= isset($_POST["id_package"]) ? trim(strip_tags($_POST["id_package"])) : "";
    //print_r ($role_package);


    if(isset($_GET["id_package"])){
	
	
	$query_updlv = "UPDATE `gx_tv_packages` SET `level` = '1', `user_upd` = '$loggedin[username]',
						`date_upd` = NOW() WHERE `id_package` = '$idpackage';";
	//echo $query_updlv;
	
	mysql_query($query_updlv, $conn) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
		    </script>");
	
	$query = "INSERT INTO `gx_tv_packages` (`id_package`, `name_package`, `detail`, `user_add`, `date_add`,`date_upd`, `level`)
						    VALUES ('', '$package_name', '$desc', '$loggedin[username]', NOW(), NOW(), '0')";
    }else{
	$query = "INSERT INTO `gx_tv_packages` (`id_package`, `name_package`, `detail`, `user_add`, `date_add`,`date_upd`, `level`)
						    VALUES ('', '$package_name', '$desc', '$loggedin[username]', NOW(), NOW(), '0')";

    }
    
    mysql_query($query, $conn) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
		    </script>");

    
    
    
    
    $sql_tvod_package	= "SELECT * FROM `gx_tv_packages` ORDER BY `id_package` DESC;";
    $query_tvod_package	= mysql_query($sql_tvod_package, $conn);
    $row_tvod_package 	= mysql_fetch_array($query_tvod_package);
    $last_tvod_package	= $row_tvod_package['id_package'];

    for ($i = 0; $i < count($role_package); $i++) {
	$data_package	= $role_package[$i];
	
	
	    $query2 	= "INSERT INTO `gx_tv_packages_det` (`id_detpack`, `id_package`, `id_tv`, `date_add`, `date_upd`, `level`)
						    VALUES ('', '$last_tvod_package', '$data_package', NOW(), NOW(), '0')";
	    
    //echo $query2.'<br />';
    mysql_query($query2, $conn) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
		    </script>");
	
	
    }
		
    echo "<script language=\"JavaScript\">
	    alert('Data telah disimpan!');
	    location.href = '".URL_ADMIN."vod/list_paket_tv.php';
	</script>";

}

if(isset($_GET["id_package"])){
    
    $sql_tv_package	= "SELECT * FROM `gx_tv_packages` WHERE `id_package` = '$_GET[id_package]';";
    $query_tv_package	= mysql_query($sql_tv_package, $conn);
    $row_tv_package 	= mysql_fetch_array($query_tv_package); 
    
}
    $content ='<section class="content-header">
                    <h1>
                        Paket TV 
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="system_user"> User Group</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			<form role="form"  method="POST" action="">
			    <div class="box">
				<div class="box-body">
                                    <table width="100%">
                                        <thead>
                                            <tr>
						<input type="hidden" class="form-control" name="idpackage" value="'.(isset($_GET['id_package']) ? $_GET['id_package'] : "").'" style="width : 53%;">
						<th width="15%">Nama Package  : </th>
						<th width="70%"><input type="text" class="form-control" name="package_name" value="'.(isset($_GET['id_package']) ? $row_tv_package["name_package"] : "").'" style="width : 53%;"></th>
                                            </tr>
					    <tr>
						<th width="15%">Deskripsi  : </th>
						<th width="70%"><textarea name="desc" id="p_new" placeholder="Description" rows="4" cols="70" style="resize : none;">'.(isset($_GET['id_package']) ? $row_tv_package["detail"] : "").'</textarea></th>
                                            </tr>
                                        </thead>
                                        </table>
                                </div>
			    </div>
			    <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">List Channel TV Local</h2>
                                </div>
				
				<div class="box-body">
				    
				    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
				    
				      <tr>
				      <td align="center">';
						
						$id_package	= isset($_GET["id_package"]) ? trim(strip_tags($_GET["id_package"])) : "";
					        $img = mysql_query("SELECT * FROM `gx_tv_stream` WHERE `cCategory` = '1' AND `level`='0'", $conn);
					        while ($r = mysql_fetch_array($img)){
					        $content .='<div style="float : left; margin-left: 5px; margin-bottom: 3px;">
							    <img src="'.URL_IMG_TV.''.$r['url_thumb'].'" name="Image12"  width="123" height="86" border="0"><br />';
						
								$sql_role = mysql_query("SELECT * FROM `gx_tv_packages_det` WHERE `id_package` = '$id_package' AND `id_tv` = '$r[id]' LIMIT 0,1;", $conn);
								//echo "SELECT * FROM `gx_vod_tvod_packages_detail` WHERE `id_package` = '".$id_package."' AND `id_tv` = '$row_tv[id]' LIMIT 0,1;";
								$row_role = mysql_fetch_array($sql_role);
						$content .='<input type="checkbox" value="'.$r["id"].'" name="role_package[]" '.(($r["id"] == $row_role["id_tv"]) ? 'checked=""' : '').' ></div>
						';
						}
					       $content .='
				      </td>
				      </tr>
				    
				    </table>
                                </div><!-- /.box-body -->
				<div class="box-header">
                                    <h2 class="box-title">List Channel TV Premium </h2>
                                </div>
				
				<div class="box-body">
				    
				    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
				    
				      <tr>
				      <td align="center">';
						
						$id_package	= isset($_GET["id_package"]) ? trim(strip_tags($_GET["id_package"])) : "";
					        $img = mysql_query("SELECT * FROM `gx_tv_stream` WHERE `cCategory` = '2' AND `level`='0'", $conn);
					        while ($r = mysql_fetch_array($img)){
					        $content .='<div style="float : left; margin-left: 5px; margin-bottom: 3px;">
							    <img src="'.URL_IMG_TV.''.$r['url_thumb'].'" name="Image12"  width="123" height="86" border="0"><br />';
						
								$sql_role = mysql_query("SELECT * FROM `gx_tv_packages_det` WHERE `id_package` = '$id_package' AND `id_tv` = '$r[id]' LIMIT 0,1;", $conn);
								//echo "SELECT * FROM `gx_vod_tvod_packages_detail` WHERE `id_package` = '".$id_package."' AND `id_tv` = '$row_tv[id]' LIMIT 0,1;";
								$row_role = mysql_fetch_array($sql_role);
						$content .='<input type="checkbox" value="'.$r["id"].'" name="role_package[]" '.(($r["id"] == $row_role["id_tv"]) ? 'checked=""' : '').' ></div>
						';
						}
					       $content .='
				      </td>
				      </tr>
				    
				    </table>
                                </div><!-- /.box-body -->
				<div class="box-footer">
				    <input type="hidden" name="id_package" value="'.$id_package.'"/>
				    <button type="submit" name="save_package" class="btn btn-primary">Save</button>
				</div>
                            </div><!-- /.box -->
			    </form>
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#paket\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>


    ';

    $title	= 'User Group';
    $submenu	= "system_user";
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