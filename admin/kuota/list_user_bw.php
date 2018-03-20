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
    
    global $conn;
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],"Open Menu List OLT server");
    
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">List Bandwidth User</h3>
                                    
                                </div>
                                <div class="box-body table-responsive">
								<a href="form_bw.php" class="btn bg-olive btn-flat margin pull-right">Update bandwidth</a>
                                <table class="table table-hover table-border">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>cKode</th>
                                                <th>Nama</th>
												<th>UserID</th>
                                                <th>GroupName(Bandwidth)</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
if(isset($_POST["search"])){
    $search		= isset($_POST["userid"]) ? trim(strip_tags($_POST["userid"])) : "";
    
    $sql_search		= ($search != "") ? "AND `cUserID` LIKE '%$search%'" : "";
    
    
    $sql_server_ras = mysql_query("SELECT * FROM `tbCustomer`
				  WHERE `level` = '0' $sql_search
				  ORDER BY `cUserID` ASC LIMIT 0,10;", $conn);
}else{
    $sql_server_ras = mysql_query("SELECT * FROM `tbCustomer`
				  WHERE `level` = '0' ORDER BY `cUserID` ASC;", $conn);
}

$no = 1;
while ($row_server_ras = mysql_fetch_array($sql_server_ras))
{
	$conn_soft = Config::getInstanceSoft();
    $sql_data = $conn_soft->prepare("SELECT TOP 1 [dbo].[Users].[GroupName] FROM [dbo].[Users]
									WHERE [dbo].[Users].[UserID] = '".$row_server_ras["cUserID"]."';");
    $sql_data->execute();
    
    $row_data = $sql_data->fetch(PDO::FETCH_ASSOC);
	//print_r($row_data);
	
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_server_ras["cKode"].'</td>
		    <td>'.$row_server_ras["cNama"].'</td>
			<td>'.$row_server_ras["cUserID"].'</td>
		    <td>'.$row_data['GroupName'].'</td>
            <td><a href="form_edit_bw.php?userid='.$row_server_ras["cUserID"].'">edit</a></td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>
                                    
                                </div><!-- /.box-body-->
                                
                            </div><!-- /.box -->
                            </form>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->

            ';

$plugins = '';

    $title	= 'List Bandwidth User';
    $submenu	= "inet_server_olt";
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