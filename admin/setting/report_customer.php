<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

 include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}

    global $conn;
	
	//$date = date("Y-m-d");
	$start		= isset($_GET["start"]) ? trim(strip_tags($_GET["start"]))." 00:00:00" : date("Y-m-d 00:00:00");
	$end		= isset($_GET["end"]) ? trim(strip_tags($_GET["end"]))." 23:59:59" : date("Y-m-d 23:59:59");
	$start1		= isset($_GET["start"]) ? trim(strip_tags($_GET["start"])) : date("Y-m-d");
	$end1		= isset($_GET["end"]) ? trim(strip_tags($_GET["end"])) : date("Y-m-d");

	$sql_start 	= "AND `gx_helpdesk_complaint`.`date_add` >= '$start'";
	$sql_end 	= "AND `gx_helpdesk_complaint`.`date_add` <= '$end'";

	$jum_total_open = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai`
					WHERE `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` 
					AND `gx_helpdesk_complaint`.`status` = 'open'
					AND `gx_helpdesk_complaint`.`level` = '0'
					$sql_start $sql_end ", $conn));
    
    $jum_total_closed = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai`
				WHERE `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee`
				AND `gx_helpdesk_complaint`.`status` = 'closed'
				AND `gx_helpdesk_complaint`.`level` = '0'
				$sql_start $sql_end ", $conn));
	
$content = '<!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">
					<div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Search</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								
								<form action="" method="get" name="form_search">
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-3">
					    <label>Periode</label>
					</div>
					<div class="col-xs-3">
					    
					</div>
					<div class="col-xs-1">
					    
					</div>
					<div class="col-xs-3">
					    
					</div>
				    </div>
					
					<div class="form-group">
				    <div class="row">
						<div class="col-xs-2">
							<label>Start</label>
						</div>
						<div class="col-xs-3">
							<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" name="start" value="'.date("Y-m-d").'">
						</div>
					</div>
				    </div>
					
					<div class="form-group">
				    <div class="row">
						<div class="col-xs-2">
							<label>End</label>
						</div>
						<div class="col-xs-3">
							<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" name="end" value="'.date("Y-m-d").'">
						</div>
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    <input class="btn bg-olive btn-flat" value="Search" type="submit">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
	</form>
	<hr>
								<div class="box-header">
                                    <h3 class="box-title">Summary</h3>
									
                                </div><!-- /.box-header -->
								
                                    <table class="table table-bordered table-striped" id="staff" style="width: 100%;">
                                        <tr>
                                            <th rowspan="2">Jenis Laporan</th>
                                            <th colspan="2">Hari ini</th>
                                            <th colspan="2">Mingguan</th>
                                            <th colspan="2">Bulanan</th>
                                            <th colspan="2">Tahunan</th>
                                            
                                        </tr>
										<tr>
                                            <th>Cleared</th>
                                            <th>Uncleared</th>
											<th>Cleared</th>
                                            <th>Uncleared</th>
											<th>Cleared</th>
                                            <th>Uncleared</th>
											<th>Cleared</th>
                                            <th>Uncleared</th>
                                        </tr>
										<tr>
											<td>Complaint</td>
                                            <td><a href="'.URL_ADMIN.'helpdesk/summary.php?start='.$start1.'&end='.$end1.'">'.$jum_total_closed.'</a></td>
                                            <td><a href="'.URL_ADMIN.'helpdesk/summary.php?start='.$start1.'&end='.$end1.'">'.$jum_total_open.'</a></td>
											<td></td>
                                            <td></td>
											<td></td>
                                            <td></td>
											<td></td>
                                            <td></td>
                                        </tr>
										<tr>
											<td>TroubleTicket</td>
                                            <td></td>
                                            <td></td>
											<td></td>
                                            <td></td>
											<td></td>
                                            <td></td>
											<td></td>
                                            <td></td>
                                        </tr>
								</table>
								
								
								
								</div>
							</div>
						</div>
					</div>
				</section>';

$submenu	= "";
$plugins	= '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("[id=datepicker]").datepicker({format: "yyyy-mm-dd"});
            });
        </script>';

    $title	= 'Report Customer';
    
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
     else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>