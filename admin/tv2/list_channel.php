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
enableLog( "", $loggedin["username"], $loggedin["id_employee"], "Open List Channel TV");   
    global $conn;
    global $conn_voip;


    $content ='<section class="content-header">
                    <h1>
                        List TV 
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="list_channel"> List Channel TV</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			<form role="form"  method="POST" action="">
			    <!--<div class="box">
				<div class="box-body">
                                    <table width="100%">
                                        <thead>
                                            <tr>
						<input type="hidden" class="form-control" name="package_name" value="">
						<th width="15%">Nama Package  : </th>
						<th width="70%"><input type="text" class="form-control" name="package_name" readonly="" value="" style="width : 53%;"></th>
                                            </tr>
					    <tr>
						<th width="15%">Deskripsi  : </th>
						<th width="70%"><textarea name="desc" id="p_new" placeholder="Description" rows="4" cols="70" style="resize : none;" readonly=""></textarea></th>
                                            </tr>
                                        </thead>
                                        </table>
                                </div>
			    </div>-->
				
			    <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">List TV Local Channels</h2>
				    <div class="box-tools pull-right">
				    <a href="'.URL_ADMIN.'tv/form_tvchannel.php" class="btn btn-warning">Add Channels</a>
				    <!--<a href="'.URL_ADMIN.'tv/list_category.php" class="btn btn-warning">list Category</a>-->
				    <a href="'.URL_ADMIN.'vod/list_paket_tv.php" class="btn btn-warning">TV Package</a>
				    
				    </div>
                                </div>
				
				<div class="box-body">
				    
				    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
				    
				      <tr>
				      <td align="center">';
						
						
					        $img = mysql_query("SELECT * FROM `gx_tv_stream` WHERE `cCategory` = '1' AND `level` = '0'  ", $conn);
					        //echo "SELECT * FROM `gx_vod_stream`, `gx_vod_tvod_packages_det` WHERE `gx_vod_tvod_packages_det`.`id_tv` = `gx_vod_stream`.`id` AND `gx_vod_tvod_packages_det`.`id_package` = '$id_package' AND  `gx_vod_tvod_packages_det`.`level`='0'";
						while ($r = mysql_fetch_array($img)){
			    
					        $content .='<a href="form_tvchannel.php?id_channel='.$r['id'].'"><img src="'.URL_IMG_TV.''.$r['url_thumb'].'" name="Image12"  width="123" height="86" border="0"></a>';
						}
					       $content .='
				      </td>
				      </tr>
				    
				    </table>
                                </div><!-- /.box-body -->
				<div class="box-footer">
				    
				    
				</div>
				<div class="box-header">
                                    <h2 class="box-title">List TV Premium Channels</h2>
				    <div class="box-tools pull-right">
				    </div>
                                </div>
				
				<div class="box-body">
				    
				    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
				    
				      <tr>
				      <td align="center">';
						
						
					        $img = mysql_query("SELECT * FROM `gx_tv_stream` WHERE `cCategory` = '2' AND `level` = '0'  ", $conn);
					        //echo "SELECT * FROM `gx_vod_stream`, `gx_vod_tvod_packages_det` WHERE `gx_vod_tvod_packages_det`.`id_tv` = `gx_vod_stream`.`id` AND `gx_vod_tvod_packages_det`.`id_package` = '$id_package' AND  `gx_vod_tvod_packages_det`.`level`='0'";
						while ($r = mysql_fetch_array($img)){
			    
					        $content .='<a href="form_tvchannel.php?id_channel='.$r['id'].'"><img src="'.URL_IMG_TV.''.$r['url_thumb'].'" name="Image12"  width="123" height="86" border="0"></a>';
						}
					       $content .='
				      </td>
				      </tr>
				    
				    </table>
                                </div><!-- /.box-body -->
				<div class="box-footer">
				    
				    
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