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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List Report");
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
    
    $content ='<section class="content-header">
                    <h1>
                        List Report
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
						<!--<form action="form_report2.php" method="post" name="form_report" enctype="multipart/form-data">-->
                            <div class="box">
								<div class="box-header">
                                    <h3 class="box-title">Detail Report</h3>
                                </div><!-- /.box-header -->
												
                                <div class="box-body table-responsive">


            <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ID Report</label>
					    </div>
					    <div class="col-xs-9">
                            '.$id_report1.'
					    </div>
                     </div>
			</div>
            
            <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Date/Time Incident Began</label>
					    </div>
					    <div class="col-xs-9">
                            '.$began.'
					    </div>
                     </div>
			</div>
            
            <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Date/Time Incident Resolve</label>
					    </div>
					    <div class="col-xs-9">
                            '.$resolve.'
					    </div>
                     </div>
			</div>
            
            <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Total Duration of Service Interruption/Outage</label>
					    </div>
					    <div class="col-xs-9">
                            '.$duration.'
					    </div>
                     </div>
			</div>
            
            <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Total Number User and Area Affected</label>
					    </div>
					    <div class="col-xs-9">
                            '.$number.'
					    </div>
                     </div>
			</div>
            
            <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>High level Incident Overview</label>
					    </div>
					    <div class="col-xs-9">
						   '.$level.'
					    </div>
                     </div>
			</div>
            
            <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Technical Incident Details</label>
					    </div>
					    <div class="col-xs-9">
                            '.$technical.'
					    </div>
                     </div>
			</div>
            
            <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Reason for this Incident</label>
					    </div>
					    <div class="col-xs-9">
                            '.$reason.'
					    </div>
                     </div>
			</div>
            
            <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Short-term Resolution Implemented</label>
					    </div>
					    <div class="col-xs-9">
                            '.$short.'
					    </div>
                     </div>
			</div>
            
            <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Recomended Long-term Resolution</label>
					    </div>
					    <div class="col-xs-9">
                            '.$long.'
					    </div>
                     </div>
			</div>
            
            <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Additional System Affected</label>
					    </div>
					    <div class="col-xs-9">
                            '.$affected.'
					    </div>
                     </div>
			</div>
            
            <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Miscellaneous Information</label>
					    </div>
					    <div class="col-xs-9">
                            '.$information.'
					    </div>
                     </div>
			</div>
            
	
                               
                            </div><!-- /.box -->
							<!--</form>-->
                        </div>
                    </div>

                </section>
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

    $title	= 'list report';
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