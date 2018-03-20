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
    
    global $conn;
    global $conn_voip;
    
    $content ='<section class="content-header">
                    <h1>
                        TV Packages
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="list_paket_tv"> TV Packages</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    <!--<div class="box">
				<div class="box-body">
                                    
				    <a href="'.URL_ADMIN.'vod/form_pakettv.php" class="btn btn-warning">Create Package</a>
				    
                                </div>
			    </div>-->
			    ';
					


    $username		= isset($_POST["username"]) ? trim(strip_tags($_POST["username"])) : "";
    
    $sql_group = mysql_query("SELECT `name_package`, `detail`, `id_package`
				  FROM `gx_tv_packages`
				  WHERE `level` = '0'
				  ORDER BY `id_package` ASC;",$conn);
    
$content .='		<div class="box">
				<div class="box-header">
                                    <h2 class="box-title">List Paket</h2>
                                </div>
				
				<div class="box-body">
				    <a href="'.URL_ADMIN.'vod/form_pakettv.php" class="btn btn-success">Create Paket</a><br><br>
				    <table id="usergroup" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Nama Paket</th>
						<th>Deskripsi</th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>';

$no = 1;
while ($row_group = mysql_fetch_array($sql_group))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_group["name_package"].'</td>
		    <td>'.$row_group["detail"].'</td>
		    <td><a href="'.URL_ADMIN.'vod/form_pakettv.php?id_package='.$row_group["id_package"].'">Edit</a> | <a href="'.URL_ADMIN.'vod/detail_paket.php?id_package='.$row_group["id_package"].'">Detail</a></td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
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
                $(\'#usermanagement\').dataTable({
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