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
        
    
 //echo date("Y-m-d H:i:s");
    $id_mcmd	= isset($_GET["id"]) ? mysql_real_escape_string(strip_tags(trim($_GET["id"]))) : "";
    
    $sql_mcmd = mysql_query("SELECT * FROM `gx_inet_multiple_cmd`
			 WHERE `id_mcmd` = '".$id_mcmd."' LIMIT 0,1;", $conn);

    $row_mcmd = mysql_fetch_array($sql_mcmd);
    
    $content ='<section class="content-header">
                    <h1>
                        Detail Command
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Profile Command</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				    <form role="form" method="POST" action="">
                                    <div class="box-body">
                                        
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Nama Command</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <label>'.(isset($_GET["id"]) ? $row_mcmd["nama_cmd"] : "").'</label>
                                            </div>
                                        </div>
                                        
					<div class="row">
					    <div class="col-xs-5">
						<h5>Tipe Server</h5>
					    </div>
					    <div class="col-xs-7">
						<label>'.(isset($_GET["id"]) ? $row_mcmd["type_cmd"] : "").'</label>
					    </div>
                                        </div>
					
                                        
                                        
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Deskripsi command</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <label>'.(isset($_GET["id"]) ? $row_mcmd["desc_cmd"] : "").'</label>
                                            </div>
                                        </div>
                                        
                                        
                                    <div id="form_ras">
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h5>Command RAS</h5>
                                            </div>
                                        </div>
                                        </div>
					
					<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table table-hover table-border">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Nama</th>
						<th>Command</th>
                                                <th>Deskripsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
if(isset($_POST["search"])){
    $search		= isset($_POST["nama"]) ? trim(strip_tags($_POST["nama"])) : "";
    
    $sql_search		= ($search != "") ? "AND `grouptime_nama` LIKE '%$search%'" : "";
    
    
    $sql_server_ras = mysql_query("SELECT * FROM `gx_inet_listServer`
				  WHERE `level` = '0'
                                  $sql_search
				  ORDER BY `nama_server` ASC LIMIT 0,10;", $conn);
}else{
    $type = ((isset($_GET["id"])) AND ($row_mcmd["type_cmd"] != "ras")) ? "_".$row_mcmd["type_cmd"] : "";
    $sql_list_command = mysql_query("SELECT `gx_inet_command$type`.* FROM `gx_inet_multiple_cmd_detail`, `gx_inet_command$type`
				  WHERE `gx_inet_multiple_cmd_detail`.`id_cmd` = `gx_inet_command$type`.`id_cmd`
				  AND `gx_inet_multiple_cmd_detail`.`id_mcmd` = '".$row_mcmd["id_mcmd"]."'
				  AND `gx_inet_multiple_cmd_detail`.`level` = '0'
				  ORDER BY `gx_inet_multiple_cmd_detail`.`id_mcmd` ASC;", $conn);
    
}

$no = 1;
while ($row_list_command = mysql_fetch_array($sql_list_command))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_list_command["nama_cmd"].'</td>
                    <td>'.$row_list_command["command"].'</td>
		    <td>'.$row_list_command["desc_cmd"].'</td>
		    
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                
                                
                                    
                                </div><!-- /.box-body-->
                                
                            </div><!-- /.box -->
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Detail Multiple Command';
    $submenu	= "customer";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>