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
    

    enableLog("", $loggedin["username"], $loggedin["id_employee"], "create new form Download VA Baru");

    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Download VA Baru</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="form_master_va"  method="POST" action="">
                                    <div class="box-body">
					<div class="form-group">
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Folder</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" required="" name="folder" value="">
						
					    </div>
					</div>
					</div>
                    
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama File</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" required="" name="nama_file" value="">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Nama Rek</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="nama_rek" value="">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>kode Bank </label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="kode_bank1" value="">
					    </div>
						<div class="col-xs-5">
						<input type="text" class="form-control" required="" name="kode_bank2" value="">
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

                                    <div class="box-footer">
                                        <input type="submit" name="'.(isset($_GET["id"]) ? "update" : "save") .'" value="Save" class="btn btn-primary">
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
$plugins = '';

    $title	= 'Form Download VA Baru';
    $submenu	= "download_va_baru";
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