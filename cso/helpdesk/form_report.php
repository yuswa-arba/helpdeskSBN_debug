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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form complaint");
    global $conn;
    
    
 //echo date("Y-m-d H:i:s");   
	    if(isset($_GET['id_report'])){
		$get_id = isset($_GET['id_report']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_report']))) : "";
		$data_report = mysql_fetch_array(mysql_query("SELECT * FROM `gx_cso_report`
							  WHERE `gx_cso_report`.`id_report` = '$get_id';", $conn));
	    }
    
    $content ='<section class="content-header">
                    <h1>
                        Form Report
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
						<form action="" method="post" name="form_report" enctype="multipart/form-data">
                            <div class="box">
								<div class="box-header">
                                    <h3 class="box-title">Form Report</h3>
                                </div><!-- /.box-header -->
												
                                <div class="box-body table-responsive">
				
				
		<div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Date/Time Incident Began</label>
				</div>
				<div class="col-xs-8">
					<input name="began" readonly="" class="form-control" type="text" id="datepicker"  value="'.(isset($_GET['id_report']) ? $data_report["began"] : "").'" />
					
				</div>
			</div>
		</div>
        <div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Date/Time Incident Resolve</label>
				</div>
				<div class="col-xs-8">
					<input name="resolve" readonly="" class="form-control" type="text" id="datepicker2"  value="'.(isset($_GET['id_report']) ? $data_report["resolve"] : "").'" />
				</div>
			</div>
		</div>  
		<div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Total Duration of Service Interruption/Outage</label>
				</div>
				<div class="col-xs-8">
					<textarea name="duration" id="duration" class="form-control">'.(isset($_GET['id_report']) ? $data_report["duration"] : "").'</textarea>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Total Number of User and Area Affected</label>
				</div>
				<div class="col-xs-8">
					<textarea name="number" id="number" class="form-control">'.(isset($_GET['id_report']) ? $data_report["number"] : "").'</textarea>
				</div>
			</div>
		</div>
        
        <div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>High Level Incident Overview</label>
				</div>
				<div class="col-xs-8">
					<textarea name="level" id="level" class="form-control">'.(isset($_GET['id_report']) ? $data_report["level"] : "").'</textarea>
				</div>
			</div>
		</div>
        
        <div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Technical Incident Details</label>
				</div>
				<div class="col-xs-8">
					<textarea name="technical" id="technical" class="form-control">'.(isset($_GET['id_report']) ? $data_report["technical"] : "").'</textarea>
				</div>
			</div>
		</div>
        
		<div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Reason for this Incident</label>
				</div>
				<div class="col-xs-8">
					<textarea name="reason" id="reason" class="form-control">'.(isset($_GET['id_report']) ? $data_report["reason"] : "").'</textarea>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Short-term Resolution Implemented</label>
				</div>
				<div class="col-xs-8">
					<textarea name="short" id="short" class="form-control">'.(isset($_GET['id_report']) ? $data_report["short"] : "").'</textarea>
				</div>
			</div>
		</div>
        
        <div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Recommended Long-term Resolution</label>
				</div>
				<div class="col-xs-8">
					<textarea name="long" id="long" class="form-control">'.(isset($_GET['id_report']) ? $data_report["long"] : "").'</textarea>
				</div>
			</div>
		</div>
        
        <div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Additional System Affected</label>
				</div>
				<div class="col-xs-8">
					<textarea name="affected" id="affected" class="form-control">'.(isset($_GET['id_report']) ? $data_report["affected"] : "").'</textarea>
				</div>
			</div>
		</div>
        
        <div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Miscellaneous Information</label>
				</div>
				<div class="col-xs-8">
					<textarea name="information" id="information" class="form-control">'.(isset($_GET['id_report']) ? $data_report["information"] : "").'</textarea>
				</div>
			</div>
		</div>
		
		</div><!-- /.box-body -->
			
		   
		<div class="box-footer">
			<button type="submit" value="Submit" name="'.(isset($_GET['id_report']) ? "update" : "save").'" class="btn btn-primary">Submit</button>
		</div>
	
          
	
	
                               
                            </div><!-- /.box -->
							</form>
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$save   = isset($_POST["save"]) ? $_POST["save"] : "";
$update = isset($_POST["update"]) ? $_POST["update"] : "";
	if($save == "Submit"){
	    $began          = date('Y-m-d',strtotime($_POST['began']));
        $resolve        = date('Y-m-d',strtotime($_POST['resolve']));
        $duration       = isset($_POST['duration']) ? $_POST['duration'] : '';
        $number         = isset($_POST['number']) ? $_POST['number'] : ''; 
        $level          = isset($_POST['level']) ? $_POST['level'] : '';
        $technical      = isset($_POST['technical']) ? $_POST['technical']  : '';
        $reason         = isset($_POST['reason']) ? $_POST['reason'] : '';
        $short          = isset($_POST['short']) ? $_POST['short']: '';
        $long           = isset($_POST['long']) ? $_POST['long'] : '';
        $affected       = isset($_POST['affected']) ? $_POST['affected'] :'' ;
        $information    = isset($_POST['information']) ? $_POST['information']: '';
        if($duration !=""  || $number !="" ){
        $sql = "INSERT INTO `gx_cso_report` (`id_report`, `began`, `resolve`, `duration`, `number`, `level`, `technical`, `reason`, `short`, `long`, `affected`, `information`)
                VALUES (NULL, '$began', '$resolve', '$duration' , '$number' , '$level' , '$technical' , '$reason' , '$short' , '$long' , '$affected' , '$information');";
            //echo $insert_complaint;
            mysql_query($sql, $conn) or die ("<script language='JavaScript'>
                                   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                                   window.history.go(-1);
                                   </script>");
            enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert Report = $sql");
            
            echo "<script language='JavaScript'>
                alert('Data telah disimpan!');
                location.href = 'form_report.php';
            </script>";
        }else{
            echo "<script language='JavaScript'>
                                   alert('Maaf Data tidak bisa disimpan, ada data yg harus diisi.');
                                   window.history.go(-1);
                                   </script>";
        }
    }
$plugins = '


    <script src="../../js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
	<!-- bootstrap time picker -->
	<link rel="stylesheet" href="../../css/timepicker/bootstrap-timepicker.min.css">
    <script src="../../js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                $("#datepicker2").datepicker({format: "yyyy-mm-dd"});
                
				//Timepicker
				$(".timepicker").timepicker({
				  showInputs: false
				});
            });
        </script>';

    $title	= 'Form report';
    $submenu	= "helpdesk_form_report";
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