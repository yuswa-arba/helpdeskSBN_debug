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
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],"Open Menu List OLT Customer");
    
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">List Tim Pasang</h3>
                                    <a href="form_timpasang" class="btn bg-olive btn-flat margin pull-right">Create New</a>
                                </div>
                                <div class="box-body table-responsive">';
	
if(isset($_POST["search"])){
    $userid		= isset($_POST["userid"]) ? trim(strip_tags($_POST["userid"])) : "";
	$id_olt		= isset($_POST["id_olt"]) ? trim(strip_tags($_POST["id_olt"])) : "";
    
    $sql_userid		= ($userid != "") ? "AND `userid` LIKE '%$userid%'" : "";
	//$sql_userid		= ($id_olt != "") ? "AND " : "";
    
    
    $sql_data = mysql_query("SELECT * FROM `gx_timpasang`
								  WHERE `id_olt` = '$id_olt'
								  $sql_userid
				  ORDER BY `id_timpasang` ASC;", $conn);
}else{
    $sql_data = mysql_query("SELECT * FROM `gx_timpasang` ORDER BY `id_timpasang` ASC;", $conn);
}


$content .='<table class="table table-hover table-border">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>Nama Tim Pasang</th>
                                                <th>Leader Tim</th>
												<th>Mac Address</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

$no = 1;
while ($row_data = mysql_fetch_array($sql_data))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_data["nama_timpasang"].'</td>
			<td>'.$row_data["namapegawai_timpasang"].'</td>
			<td>'.$row_data["macaddress"].'</td>
			<td><a href="form_timpasang.php?id='.$row_data["id_timpasang"].'">edit</a> |
			</td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
										<tfooter>
										
										</tfooter>
                                    </table>
                                    
                                </div><!-- /.box-body-->
                                
                            </div><!-- /.box -->
                            
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->

            ';

$plugins = '';

    $title	= 'List Tim Pasang';
    $submenu	= "inet_server_ras";
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