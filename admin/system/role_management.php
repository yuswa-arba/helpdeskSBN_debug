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
     enableLog("", $loggedin["username"], $loggedin["username"], "Open List Menu");
	 global $conn;
	
	 if(isset($_POST["hapus"]))
	 {
		 $id_menu = array();
		 $id_menu = isset($_POST["id_menu"]) ? $_POST["id_menu"] : $id_menu;
		 
		 foreach($id_menu as $key => $value)
		 {
			 $query = "UPDATE `gx_menu` SET `level` = '1'
					 WHERE `id_menu` = '".$value."';";
			 $sql_update = mysql_query($query, $conn) or die (mysql_error());
			 //log
			 enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
		 }
		 header('location: list_menu.php');
	 }
    
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    <form action="" method="post" name="form_menu" id="form_menu">
                            <div class="box">
							  <div class="box-header">
                                    <h3 class="box-title">List Data</h3>
			   
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								
                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Nama Group</th>
                                                <th>Description</th>
                                                
						<th>Action</th>
						
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_menu 	= mysql_query("SELECT * FROM `gx_group`;", $conn);

$no = 1;
while ($row_menu = mysql_fetch_array($sql_menu))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_menu["nama_group"].'</td>
		    <td>'.$row_menu["desc"].'</td>
		    <td align="center">
		    <a href="form_role.php?id_group='.$row_menu['id_group'].'"><span class="label label-info">Edit</span></a> |
		    <a href="" onclick="return valideopenerform(\'detail_role.php?id_group='.$row_menu["id_group"].'\',\'rolemanagement\');"><span class="label label-info">Details</span></a></td>
		    
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
							  
                            </div><!-- /.box -->
                            </form>
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
/*<div class="box-footer">
                                    <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
                                </div>*/
$plugins = '';

    $title	= 'Master Cabang';
    $submenu	= "cabang";
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