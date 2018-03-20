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
enableLog( "", $loggedin["username"], $loggedin["id_employee"], "Open Detail Paket TV = id paket $_GET[id_package]");   
    global $conn;
    global $conn_voip;


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
						<input type="hidden" class="form-control" name="package_name" value="'.(isset($_GET['id_package']) ? $_GET['id_package'] : "").'" style="width : 53%;">
						<th width="15%">Nama Package  : </th>
						<th width="70%"><input type="text" class="form-control" name="package_name" readonly="" value="'.(isset($_GET['id_package']) ? $row_tv_package["name_package"] : "").'" style="width : 53%;"></th>
                                            </tr>
					    <tr>
						<th width="15%">Deskripsi  : </th>
						<th width="70%"><textarea name="desc" id="p_new" placeholder="Description" rows="4" cols="70" style="resize : none;" readonly="">'.(isset($_GET['id_package']) ? $row_tv_package["detail"] : "").'</textarea></th>
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
					        $img = mysql_query("SELECT * FROM `gx_tv_stream`, `gx_tv_packages_det` WHERE `gx_tv_packages_det`.`id_tv` = `gx_tv_stream`.`id` AND `gx_tv_packages_det`.`id_package` = '$id_package' AND  `gx_tv_packages_det`.`level`='0' AND  `gx_tv_stream`.`cCategory`='1'", $conn);
					        //echo "SELECT * FROM `gx_vod_stream`, `gx_vod_tvod_packages_det` WHERE `gx_vod_tvod_packages_det`.`id_tv` = `gx_vod_stream`.`id` AND `gx_vod_tvod_packages_det`.`id_package` = '$id_package' AND  `gx_vod_tvod_packages_det`.`level`='0'";
						while ($r = mysql_fetch_array($img)){
			    
					        $content .='<img src="'.URL_IMG_TV.''.$r['url_thumb'].'" name="Image12"  width="123" height="86" border="0">';
						}
					       $content .='
				      </td>
				      </tr>
				    
				    </table>
                                </div><!-- /.box-body -->
				<div class="box-header">
                                    <h2 class="box-title">List Channel TV Premium</h2>
                                </div>
				
				<div class="box-body">
				    
				    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
				    
				      <tr>
				      <td align="center">';
						
						$id_package	= isset($_GET["id_package"]) ? trim(strip_tags($_GET["id_package"])) : "";
					        $img = mysql_query("SELECT * FROM `gx_tv_stream`, `gx_tv_packages_det` WHERE `gx_tv_packages_det`.`id_tv` = `gx_tv_stream`.`id` AND `gx_tv_packages_det`.`id_package` = '$id_package' AND  `gx_tv_packages_det`.`level`='0' AND  `gx_tv_stream`.`cCategory`='2'", $conn);
					        //echo "SELECT * FROM `gx_vod_stream`, `gx_vod_tvod_packages_det` WHERE `gx_vod_tvod_packages_det`.`id_tv` = `gx_vod_stream`.`id` AND `gx_vod_tvod_packages_det`.`id_package` = '$id_package' AND  `gx_vod_tvod_packages_det`.`level`='0'";
						while ($r = mysql_fetch_array($img)){
			    
					        $content .='<img src="'.URL_IMG_TV.''.$r['url_thumb'].'" name="Image12"  width="123" height="86" border="0">';
						}
					       $content .='
				      </td>
				      </tr>
				    
				    </table>
                                </div><!-- /.box-body -->
				<div class="box-footer">
				    <input type="hidden" name="id_package" value="'.$id_package.'"/>
				    
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

    $title	= 'Detail Paket';
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