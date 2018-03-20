<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
	
        global $conn;

    $id_data 	= isset($_GET['id']) ? (int)$_GET['id'] : "";
    $sql_data	= "SELECT * FROM `gx_tv_stb` WHERE `id_stb` = '".$id_data."';";
    $query_data	= mysql_query($sql_data, $conn);
    $row_data	= mysql_fetch_array($query_data);
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail STB id=$id_data");

    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Detail STB</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="form_stb"  method="POST" action="">
                                    <div class="box-body">
					<div class="form-group">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode STB</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly class="form-control" name="kode_stb" value="'.(isset($_GET["id"]) ? $row_data['kode_stb'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>SN</label>
					    </div>
					    <div class="col-xs-8">
						<input type="hidden"  class="form-control" required="" name="id_stb" value="'.(isset($_GET["id"]) ? $row_data['id_stb'] :"").'">
						<input type="text" readonly="" class="form-control" name="sn" value="'.(isset($_GET["id"]) ? $row_data['sn'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>MAC</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" required="" name="mac" value="'.(isset($_GET["id"]) ? $row_data['mac'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Version</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" required="" name="version" value="'.(isset($_GET["id"]) ? $row_data['version'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Kelengkapan</label>
					    </div>
					    <div class="col-xs-8">
                            
							<input type="checkbox" disabled="disabled" name="stb" value="0" '.(isset($_GET["id"]) && $row_data['stb'] == "0" ? "checked" :"").'> STB 
							<input type="checkbox" disabled="disabled" name="remote" value="0" '.(isset($_GET["id"]) && $row_data['remote'] == "0" ? "checked" :"").'> Remote
							<input type="checkbox" disabled="disabled" name="kabel_hdmi" value="0" '.(isset($_GET["id"]) && $row_data['kabel_hdmi'] == "0" ? "checked" :"").'> HDMI
							<input type="checkbox" disabled="disabled" name="adaptor" value="0" '.(isset($_GET["id"]) && $row_data['adaptor'] == "0" ? "checked" :"").'> STB 
							
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-8">
						<textarea name="keterangan" readonly="" id="keterangan" rows="6" cols="55" style="resize: none;">'.(isset($_GET["id"]) ? $row_data['keterangan'] :"").'</textarea>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Created By:</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET["id"]) ? $row_data['user_add'] : $loggedin["username"]).'
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>last Updated By:</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET["id"]) ? $row_data['user_upd'].' ( '.$row_data['date_upd'].' )' : "").'
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->

                                    
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Detail stb';
    $submenu	= "stb";
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