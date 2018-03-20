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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Service Plan");
    global $conn;
    

if(isset($_GET["id"])){

	$id_data	= isset( $_GET['id']) ? (int)$_GET['id'] : "";
	$query		= "SELECT * FROM `gx_service_plan` WHERE `level` = '0' AND `id_service_plan` = '".$id_data."' LIMIT 0,1";
	$sql_data	= mysql_query($query);
	$row_data	= mysql_fetch_array($sql_data);
	
	
}


    $content ='<section class="content-header">
                    <h1>
                        Detail Service Plan
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
						<form action="" method="post" name="form_serviceplan" enctype="multipart/form-data">
                            <div class="box">
								<div class="box-header">
                                    <h3 class="box-title">Detail Service Plan</h3>
                                </div><!-- /.box-header -->
												
                                <div class="box-body table-responsive">
		
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label>Nama</label>
				</div>
				<div class="col-xs-6">
					<input type="text" class="form-control" readonly="" name="nama" value="'.(isset($_GET["id"]) ? $row_data["nama"] : "").'">
					<input type="hidden" name="id_service_plan" readonly="" value="'.(isset($_GET["id"]) ? $row_data["id_service_plan"] : "").'" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label>Kategori</label>
				</div>
				<div class="col-xs-6">
					<select name="kategori" class="form-control" disabled="">
                
						<option value="FO" '.(isset($_GET['id']) && ($row_data["kategori"]=="FO") ? 'selected=""' : "").' >FO (Fiber Optic)</option>
						<option value="WL" '.(isset($_GET['id']) && ($row_data["kategori"]=="WL") ? 'selected=""' : "").' >WL (Wirelless)</option>
						<option value="PHONE" '.(isset($_GET['id']) && ($row_data["kategori"]=="PHONE") ? 'selected=""' : "").' >PHONE</option>
						<option value="TV" '.(isset($_GET['id']) && ($row_data["kategori"]=="TV") ? 'selected=""' : "").' >TV</option>

              </select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label>Tipe</label>
				</div>
				<div class="col-xs-9">
					<input name="tipe" class="form-control" readonly="" type="text" id="tipe" value="'.(isset($_GET['id']) ? $row_data["tipe"] : "").'" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label>Fitur</label>
				</div>
				<div class="col-xs-9">
					'.(isset($_GET["id"]) ? $row_data["fitur"] : '').'
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label>Term and Condition (TC)</label>
				</div>
				<div class="col-xs-9">
					'.(isset($_GET["id"]) ? $row_data["term"] : '').'
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label>Status</label>
				</div>
				<div class="col-xs-6">
					'.(($row_data["status"] == "1") ? "Aktif" : "Nonaktif" ).'
				</div>
			</div>
		</div>
		</div><!-- /.box-body -->
			
	
                               
                            </div><!-- /.box -->
							</form>
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<!-- bootstrap wysihtml5 - text editor -->
        <link href="'.URL.'css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        
        <script src="'.URL.'js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="'.URL.'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace(\'editor1\');
				CKEDITOR.replace(\'editor2\');
                //bootstrap WYSIHTML5 - text editor
                //$(".textarea").wysihtml5();
            });
        </script>
		
	<!-- InputMask -->
    <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<!-- datepicker -->
    <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
	<!-- bootstrap time picker -->
	<link rel="stylesheet" href="'.URL.'css/timepicker/bootstrap-timepicker.min.css">
    <script src="'.URL.'js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	
	
        <script>
            $(function()
			{
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
				//Timepicker
				$(".timepicker").timepicker({
				  showInputs: false
				});
            });
        </script>';

    $title	= 'Detail Service Plan';
    $submenu	= "Detail Service Plan";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
		header("location: ".URL_CSO."logout.php");
    }

?>