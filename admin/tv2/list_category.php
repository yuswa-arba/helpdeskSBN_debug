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
                        Category
                        
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
    
    $sql_group = mysql_query("SELECT * FROM `gx_tv_category`
				  WHERE `level` = '0'
				  ORDER BY `id_category` ASC;",$conn);
    
$content .='		<div class="box">
				<div class="box-header">
                                    <h2 class="box-title">List Category</h2>
                                </div>
				
				<div class="box-body">
				    <a href="'.URL_ADMIN.'tv/form_category.php" class="btn btn-success">Create Category</a><br><br>
				    <table id="usergroup" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th width="1%">#</th>
                                                <th  width="40%">Category</th>
						<th  width="10%">Create By</th>
						<th>Date Create</th>
                                                <th align="center"> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>';

$no = 1;
while ($row_category = mysql_fetch_array($sql_group))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_category["category"].'</td>
		    <td>'.$row_category["user_upd"].'</td>
		    <td>'.$row_category["date_upd"].'</td>
		    <td><a href="'.URL_ADMIN.'tv/form_category.php?id_category='.$row_category["id_category"].'">Edit</a></td>
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

    $title	= 'List Category';
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