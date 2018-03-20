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
    
    $type = isset($_GET["type"]) ? strip_tags($_GET["type"]) : "";
    
    if($type == "serverras")
    {
	$sql_select = mysql_query("SELECT * FROM `gx_inet_listServer` WHERE `level` = '0' ORDER BY `nama_server` ASC LIMIT 0,10;", $conn);
	
	$content ='<section class="content-header">
                    <h1>
                        Select Server RAS
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-12"> 
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Select server RAS</h3>
                                </div><!-- /.box-header -->
				<div class="box-body table-responsive">
                                
                                <table class="table table-hover table-border">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Nama Server</th>
                                                <th>IP Address</th>
                                                <th>Deskripsi</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

$no = 1;
while ($row_select = mysql_fetch_array($sql_select))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_select["nama_server"].'</td>
		    <td>'.($row_select["ip_address"]).'</td>
		    <td>'.$row_select["desc_server"].'</td>
                    <td><a href="" onclick="validepopupform(\''.$row_select["id_server"].'\',\''.$row_select["nama_server"].'\',\''.$row_select["ip_address"].'\')">Select</a></td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>
                                    
                                </div><!-- /.box-body-->
    			
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->';
		
    $plugins = '<script type="text/javascript">
  
	function validepopupform(id, nama, ip){
		window.opener.document.form_serverras.id_server.value=id;
                window.opener.document.form_serverras.nama_server.value=nama;
		window.opener.document.form_serverras.ip_address.value=ip;
                self.close();
        }
</script>';
	
    }elseif($type == "selectcmd")
    {
	$sql_select = mysql_query("SELECT * FROM `gx_inet_command` WHERE `level` = '0' LIMIT 0,10;", $conn);
	
	$content ='<section class="content-header">
                    <h1>
                        Select Profile Command
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-12"> 
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Select Profile Command</h3>
                                </div><!-- /.box-header -->
				<div class="box-body table-responsive">
                                <table class="table table-hover table-border">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Command</th>
                                                <th>Deskripsi</th>
						<th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>';

$no = 1;
while ($row_select = mysql_fetch_array($sql_select))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_select["command"].'</td>
		    <td>'.($row_select["desc_cmd"]).'</td>
                    <td><a href="" onclick="validepopupform(\''.$row_select["command"].'\')">Select</a></td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>
                                    
                                </div><!-- /.box-body-->
    			
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->';
		
    $plugins = '<script type="text/javascript">
  
	function validepopupform(cmd){
		window.opener.document.form_serverras.command_telnet.value=cmd;
     
                self.close();
        }
</script>';
	
    }
    
    $title	= 'Select ';
    $submenu	= "inet";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme_popup($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>