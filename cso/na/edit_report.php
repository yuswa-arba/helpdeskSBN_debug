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
if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form complaint");
    global $conn;
    
    

    $id_report = isset($_GET['no']) ? mysql_real_escape_string(trim($_GET['no'])) : '';
    $sql = "Select * from `gx_cso_report` WHERE `id_report` = '$id_report'";
    //echo $sql;
    $query =  mysql_query($sql,$conn) or die(mysql_error());
    $data_report = mysql_fetch_array($query);
   
    $id_report1     = $data_report['id_report'];
    $began          = $data_report['began'];
    $resolve        = $data_report['resolve'];
    $duration       = $data_report['duration'];
    $number         = $data_report['number'];
    $level          = $data_report['level'];
    $technical      = $data_report['technical'];
    $reason         = $data_report['reason'];
    $short          = $data_report['short'];
    $long           = $data_report['long'];
    $affected       = $data_report['affected'];
    $information    = $data_report['information'];
	
	if(isset($_POST['update'])){
	
		$began          = date('Y-m-d',strtotime($_POST['began']));
		$resolve        = date('Y-m-d',strtotime($_POST['resolve']));
		$duration       = isset($_POST['duration']) ? mysql_real_escape_string(trim( $_POST['duration'])) : '';
		$number         = isset($_POST['number']) ? mysql_real_escape_string(trim( $_POST['number'])) : '';
		$level          = isset($_POST['level']) ? mysql_real_escape_string(trim( $_POST['level'])) : '';
		$technical      = isset($_POST['technical']) ? mysql_real_escape_string(trim( $_POST['technical'])) : '';
		$reason         = isset($_POST['reason']) ? mysql_real_escape_string(trim( $_POST['reason'])) : '';
		$short          = isset($_POST['short']) ? mysql_real_escape_string(trim( $_POST['short'])) : '';
		$long           = isset($_POST['long']) ? mysql_real_escape_string(trim( $_POST['long'])) : '';
		$affected       = isset($_POST['affected']) ? mysql_real_escape_string(trim( $_POST['affected'])) : '';
		$information    = isset($_POST['information']) ? mysql_real_escape_string(trim( $_POST['information'])) : '';
		
		$sql_update = "UPDATE `gx_cso_report` set  `began`='$began' , `resolve`='$resolve' , `duration`='$duration' , `number`='$number' , `level`='$level',
						`technical`='$technical', `reason`='$reason', `short`='$short' , `long`='$long' , `affected`='$affected' , `information`='$information'
						where `id_report`='$id_report'";
		
		if(mysql_query($sql_update,$conn)){
			
			echo "<script language='JavaScript'>
			
			    alert('Data berhasil update');

				window.location = 'list_report.php';
				</script>";
				
    
		}else {  echo ("<script language='JavaScript'>

			    alert('Data tidak bisa diupdate');

			    window.history.go(-1);

				</script>");
		}
	}
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
						<form action="" method="post" name="form_report" enctype="multipart/form-data">
                            <div class="box">
								<div class="box-header">
                                    <h3 class="box-title">Edit Report</h3>
                                </div><!-- /.box-header -->
								 				
                                <div class="box-body table-responsive">
				
				
		<div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Date/Time Incident Began</label>
				</div>
				<div class="col-xs-8">
					<input name="began" readonly="" class="form-control" type="text" id="datepicker"  value="'.$began.'" />
					
				</div>
			</div>
		</div>
        <div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Date/Time Incident Resolve</label>
				</div>
				<div class="col-xs-8">
					<input name="resolve" readonly="" class="form-control" type="text" id="datepicker2"  value="'.$resolve.'">
				</div>
			</div>
		</div>  
		<div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Total Duration of Service Interruption/Outage</label>
				</div>
				<div class="col-xs-8">
					<textarea name="duration" id="duration" class="form-control">'.$duration.'</textarea>
				</div>
			</div>
		</div>
			
		<div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Total Number of User and Area Affected</label>
				</div>
				<div class="col-xs-8">
					<textarea name="number" id="number" class="form-control">'.$number.'</textarea>
				</div>
			</div>
		</div>
        
        <div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>High Level Incident Overview</label>
				</div>
				<div class="col-xs-8">
					<textarea name="level" id="level" class="form-control">'.$level.'</textarea>
				</div>
			</div>
		</div>
        
        <div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Technical Incident Details</label>
				</div>
				<div class="col-xs-8">
					<textarea name="technical" id="technical" class="form-control">'.$technical.'</textarea>
				</div>
			</div>
		</div>
        
		<div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Reason for this Incident</label>
				</div>
				<div class="col-xs-8">
					<textarea name="reason" id="reason" class="form-control">'.$reason.'</textarea>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Short-term Resolution Implemented</label>
				</div>
				<div class="col-xs-8">
					<textarea name="short" id="short" class="form-control">'.$short.'</textarea>
				</div>
			</div>
		</div>
        
        <div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Recommended Long-term Resolution</label>
				</div>
				<div class="col-xs-8">
					<textarea name="long" id="long" class="form-control">'.$long.'</textarea>
				</div>
			</div>
		</div>
        
        <div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Additional System Affected</label>
				</div>
				<div class="col-xs-8">
					<textarea name="affected" id="affected" class="form-control">'.$affected.'</textarea>
				</div>
			</div>
		</div>
        
        <div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label>Miscellaneous Information</label>
				</div>
				<div class="col-xs-8">
					<textarea name="information" id="information" class="form-control">'.$information.'</textarea>
				</div>
			</div>
		</div>
		
		</div><!-- /.box-body -->
			
		   
		<div class="box-footer">
			<button type="submit" value="Submit" name="update" class="btn btn-primary">Submit</button>
		</div>
	
          
	
	
                               
                            </div><!-- /.box -->
							</form>
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

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
    $submenu	= "report";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

    } else{
	header("location: ".URL_CSO."logout.php");
    }

?>