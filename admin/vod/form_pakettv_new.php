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
if($loggedin["group"] == 'admin'){
//enableLog( "", $loggedin["username"], $loggedin["id_employee"], "Open Form Paket TV");   
    global $conn;
    global $conn_voip;

if(isset($_POST["save_package"])){
    
    $workStyle = $_POST['package'];
print_r ($workStyle);
    // Setting up a blank variable to be used in the coming loop.
    $allStyles = "";

    // For every checkbox value sent to the form.
    foreach ($workStyle as $style) {
      // Append a string called $allStyles with the current array element, and then add a comma and a space at the end.
      $allStyles .= $style . ", ";
    }

    // Delete the last two characters from the string.
    //$allStyles = substr($allStyles, 0, -2); 

    echo "<p>The resulting string is: <strong>$allStyles</strong></p>\r\n";

    
    /*
    $package_name	= isset($_POST['package_name']) ? mysql_real_escape_string(strip_tags(trim($_POST['package_name']))) : "";
    
    $id_package		= isset($_POST["id_package"]) ? trim(strip_tags($_POST["id_package"])) : "";
    

    $sql_tvod_package	= "SELECT * FROM `gx_vod_tvod_packages`;";
    $query_tvod_package	= mysql_query($sql_tvod_package, $conn);
    $row_tvod_package 	= mysql_fetch_array($query_tvod_package);
    $last_tvod_package	= ($row_tvod_package['id_package'])+1;
    
    $role_package 	= array();
    $role_package	= isset($_POST["package"]) ? $_POST["package"] : $role_package;
    print_r ($role_package);

		foreach($role_package as $key => $value){

			$update    = mysql_query("INSERT INTO `gx_vod_tvod_packages_det` (`id_detpack`, `id_package`, `id_tv`, `date_add`, `date_upd`, `level`)
						    VALUES ('', '$last_tvod_package', '$value', NOW(), NOW(), '0')") or die(mysql_error());

		}
		
	    
		
	
    /*echo "<script language=\"JavaScript\">
	    alert('Data telah disimpan!');
	    location.href = '".URL_ADMIN."vod/list_paket_tv.php';
	</script>";*/

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
			    <div class="box">
				<div class="box-body">
				
                                    
					
				    
				    
                                </div>
			    </div>
			    ';

    $sql_tv = mysql_query("SELECT *
				  FROM `gx_vod_stream`
				  WHERE `level` = '0'
				  ORDER BY `id` ASC;",$conn);
    
$content .='		<div class="box">
				<div class="box-header">
                                    <h2 class="box-title">List TV</h2>
                                </div>
				
				<div class="box-body">
				<form role="form"  method="POST" action="form_pakettv_new">
				    <table id="paket" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th width="10%">#</th>
                                                <th width="15%">Selected</th>
						<th width="75%">Menu</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

$id_package	= isset($_GET["id_package"]) ? trim(strip_tags($_GET["id_package"])) : "";

$no = 1;
while ($row_tv = mysql_fetch_array($sql_tv))
{
    

	    $selected_role = '<input type="checkbox" value="'.$row_tv["id"].'" name="package[]">';

    
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$selected_role.'<input type="hidden" value="'.$row_tv["channel"].'" name="test[]"></td>
		    <td>'.$row_tv["channel"].'</td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
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