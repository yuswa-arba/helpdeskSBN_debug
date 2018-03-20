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
    if($loggedin["group"] == 'admin')
    {
        global $conn;

if(isset($_GET["id"]))
{
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data	= "SELECT * FROM `gx_master_ipvm` WHERE `id_ip`='".$id_data."' LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
    
}
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form IP Address</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>IP Address</label>
					    </div>
					    <div class="col-xs-8">
						<div class="input-group">
						  <div class="input-group-addon">
						    <i class="fa fa-laptop"></i>
						  </div>
						  <input type="text" class="form-control" readonly data-inputmask="\'alias\': \'ip\'" data-mask="" name="ip_address" value="'.(isset($_GET['id']) ? long2ip($row_data["ip_address"]) : "").'">
						
						</div>
						
						<input type="hidden" name="id_ip" value="'.(isset($_GET['id']) ? $row_data["id_ip"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>UserID</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="userid_ip" max-length="100" value="'.(isset($_GET['id']) ? $row_data["userid_ip"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Tipe</label>
					    </div>
					    <div class="col-xs-4">
						
						<select class="form-control"name="type_ip" disabled>
							<option value="public" '.((isset($_GET['id']) AND ($row_data['type_ip'] == "public")) ? 'selected=""' : "").'>IP Public</option>
							<option value="private" '.((isset($_GET['id']) AND ($row_data['type_ip'] == "private")) ? 'selected=""' : "").'>IP Private</option>
						</select>
						
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly name="keterangan_ip" max-length="100" value="'.(isset($_GET['id']) ? $row_data["keterangan_ip"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Flag</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly name="flag_ip" max-length="100" value="'.(isset($_GET['id']) ? $row_data["flag_ip"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->
				    
				                               </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<!-- InputMask -->
<script src="'.URL.'js/plugins/input-mask/jquery.inputmask.js"></script>
<script src="'.URL.'js/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="'.URL.'js/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script text="javascript">
$(function () {
	$("[data-mask]").inputmask();
});
</script>
';

    $title	= 'Form VLAN';
    $submenu	= "master_ip";
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