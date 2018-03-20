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
    $query_data	= "SELECT * FROM `gx_master_onu` WHERE `id_onu`='".$id_data."' LIMIT 0,1;";
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
                                    <h3 class="box-title">Form Master ONU</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                               
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>USER ID</label>
					    </div>
					    <div class="col-xs-8">
						
						  <input type="text" class="form-control" readonly name="userid_onu" value="'.(isset($_GET['id']) ? ($row_data["userid_onu"]) : "").'">
						
						
						<input type="hidden" name="id_onu" value="'.(isset($_GET['id']) ? $row_data["id_onu"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>MAC ADDRESS ONU</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly name="mac_onu" max-length="100" value="'.(isset($_GET['id']) ? $row_data["mac_onu"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>SN ONU</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly name="sn_onu" max-length="100" value="'.(isset($_GET['id']) ? $row_data["sn_onu"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Status</label>
					    </div>
					    <div class="col-xs-4">
						
						<select class="form-control"name="type_ip" disabled>
							<option value="1" '.((isset($_GET['id']) AND ($row_data['status_onu'] == "1")) ? 'selected=""' : "").'>Terpasang</option>
							<option value="2" '.((isset($_GET['id']) AND ($row_data['status_onu'] == "2")) ? 'selected=""' : "").'>Belum bongkar</option>
							<option value="3" '.((isset($_GET['id']) AND ($row_data['status_onu'] == "3")) ? 'selected=""' : "").'>Sudah Bongkar</option>
							<option value="4" '.((isset($_GET['id']) AND ($row_data['status_onu'] == "4")) ? 'selected=""' : "").'>Sudah Tes</option>
						</select>
						
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

    $title	= 'Form ONU';
    $submenu	= "master_onu";
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