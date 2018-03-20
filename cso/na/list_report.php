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
    
    
	$sql = "Select * from `gx_cso_report`";
    //echo $sql;
   $query =  mysql_query($sql,$conn);
    
    $content ='<section class="content-header">
	
                    <h1>
                        List Report
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
				<div class="row">
                        <div class="col-xs-12">
							<div class="box">
								<div class="box-body">
									<a href="form_report.php" class="btn bg-maroon btn-flat margin">Create New</a>
								</div>
							</div>
						</div>
					</div>
                    <div class="row">
                        <div class="col-xs-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">List Report</h3>
							</div><!-- /.box-header -->
										
						<div class="box-body table-responsive">
						<table id="report" class="table table-bordered table-striped" style="margin-left:auto;margin-right: auto">
            
                    <thead>
                        <tr>
							<th >ID Report</th>
                            <th >Date/Time Incident Began</th>
                            <th >Date/Time Incident Resolve</th>
                            <th >Total Duration of Service Interruption/Outage</th>
                            <th >Total Number of User and Area Affected</th>
                            <th >High level Incident Overview</th>
                            <th >Technical Incident Details</th>
                            <th >Reason for this Incident</th>
                            <th >Short-Term Resolution Implemented</th>
                            <th >Recomended Long-Term Resolution</th>
                            <th >Additional System Affected</th>
                            <th >Miscellaneous Information</th>
							<th >Action</th>
                        </tr>';
                        
							$num = mysql_num_rows($query);
							
                            for($i=0; $i < $num; $i++){
								
								$data = mysql_fetch_array($query);
                                
								$id_report 		= $data['id_report'];
								$began 			= $data['began'];
								$resolve		= $data['resolve'];
								$duration		= $data['duration'];
								$number			= $data['number'];
								$level			= $data['level'];
								$technical 		= $data['technical'];
								$reason 		= $data['reason'];
								$short			= $data['short'];
								$long			= $data['long'];
								$affected		= $data['affected'];
								$information	= $data['information'];
								
								$wrap_id_report 		= wordwrap($id_report,3, "\n", TRUE);
								$wrap_began				= wordwrap($began,10,"\n", TRUE);
								$wrap_resolve			= wordwrap($resolve,10,"\n", TRUE);
								$wrap_duration			= wordwrap($duration,10,"\n", TRUE);
								$wrap_number			= wordwrap($number,8,"\n", TRUE);
								$wrap_level				= wordwrap($level,8,"\n", TRUE);
								$wrap_technical			= wordwrap($technical,8,"\n", TRUE);
								$wrap_reason			= wordwrap($reason,10,"\n", TRUE);
								$wrap_short				= wordwrap($short,8,"\n", TRUE);
								$wrap_long				= wordwrap($long,8,"\n", TRUE);
								$wrap_affected			= wordwrap($affected,8,"\n", TRUE);
								$wrap_information		= wordwrap($information,12,"\n", TRUE);
								
								$class = (($i % 2) == 0) ? "td2" : "td1";
								
								$content .='<tr><td class = "'.$class.'">'.$wrap_id_report.'</td>
								<td class = "'.$class.'">'.$wrap_began.'</td>
								<td class = "'.$class.'">'.$wrap_resolve.'</td>
                                <td class = "'.$class.'">'.$wrap_duration.'</td>
                                <td class = "'.$class.'">'.$wrap_number.'</td>
                                <td class = "'.$class.'">'.$wrap_level.'</td>
                                <td class = "'.$class.'">'.$wrap_technical.'</td>
                                <td class = "'.$class.'">'.$wrap_reason.'</td>
                                <td class = "'.$class.'">'.$wrap_short.'</td>
                                <td class = "'.$class.'">'.$wrap_long.'</td>
                                <td class = "'.$class.'">'.$wrap_affected.'</td>
                                <td class = "'.$class.'">'.$wrap_information.'</td>
                               <td><a href="detail_report.php?no='.$data['id_report'].'"><span class="label label-info">Detail</span></a>
									  <a href="edit_report.php?no='.$data['id_report'].'"><span class="label label-info">Edit</span></a></td>	
								
								';
                            }
                        
                       
                    $content .='</thead>
            
        </table>
		</div>
		 </div><!-- /.box -->
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