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
include ("../../config/configuration_tv.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Provider");
    global $conn;
    $conn_tv   = DB_TV();
	
	
    $perhalaman = 20;
	if (isset($_GET['page'])){
		$page = (int)$_GET['page'];
		$start=($page - 1) * $perhalaman;
	}else{
		$start=0;
	}

$content = '
                

               
				<section class="content">
					

					<div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Data</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
<form action="" method="post" name="form_search">
								
			
									
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
											<label>Start Date</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" name="date" id="date" value="'.date("Y-m-01").'">
											</div>
										</div>
										</div>
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
											<label>Finish Date</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker" id="datepicker2" readonly="" name="date2" id="date" value="'.date("Y-m-d").'">
											</div>
										</div>
										</div>
										
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    <input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
	</form>
	<hr>';

if(isset($_POST["search"]))
{
	
	$date	= isset($_POST['date']) ? mysql_real_escape_string(trim($_POST['date'])) : '';
	$date2	= isset($_POST['date2']) ? mysql_real_escape_string(trim($_POST['date2'])) : '';
	
	$content.='<table id="example1" class="table table-bordered table-striped">
								<thead>
								  <tr align="top">
									<th width="3%">No.</th>
									<th>Package Name</th>
									<th>Package Type</th>
									<th>Channel Name</th>
									<th>Opening Subs<br>
									('.date("d-m-Y", strtotime($date)).')
									</th>
									<th>Closing Subs<br>
									('.date("d-m-Y", strtotime($date2)).')
									</th>
									<th>Average Subs</th>
									
								  </tr>
								</thead>
								<tbody>';
	
$sql_data		= mysqli_query($conn_tv, "SELECT `proName`, `proID` FROM `ott_product`;");

$no = 1;

while($row_data = mysqli_fetch_array($sql_data))
{
		
	$sql_channel	= mysqli_query($conn_tv, "SELECT `channelName`, `channelId` FROM `ott_livechannel`, `ott_productservice`
								   WHERE `ott_productservice`.`movieId` = `ott_livechannel`.`channelId`
								   AND `ott_productservice`.`proID` = '".$row_data["proID"]."';");
	$total_channel	= mysqli_num_rows($sql_channel);
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["proName"].'</td>
			<td>Base Pack</td>
			<td>';
			$content_total_user = "";
			$content_avg_user = "";
			while($row_channel = mysqli_fetch_array($sql_channel))
			{
				$content .=$row_channel["channelName"]."<br>";
				
				$sql_data_tv	= mysqli_query($conn_tv, "SELECT `ott`.`ott_livechannel`.`channelName`
									   FROM `boss`.`t_consumerecord`, `boss`.`t_account_cms`, `ott`.`ott_livechannel`
									   WHERE `boss`.`t_consumerecord`.`CLIENTID` = `boss`.`t_account_cms`.`CLIENTID`
									   AND `boss`.`t_consumerecord`.`PROID` = '".$row_channel["channelId"]."'
									   AND `boss`.`t_consumerecord`.`PROID` = `ott`.`ott_livechannel`.`channelId`
									   AND `boss`.`t_consumerecord`.`ORDERTYPE` != '1'
									   AND `boss`.`t_consumerecord`.`EXPENSEDT` >= '".date("Y-m-d", strtotime($date))." 00:00:00'
									   AND `boss`.`t_consumerecord`.`EXPENSEDT` <= '".date("Y-m-d", strtotime($date2))." 23:59:59';");
				$total_data_tv	= mysqli_num_rows($sql_data_tv);
				
				$content_total_user .= $total_data_tv.'<br>';
				$content_avg_user .= number_format(($total_data_tv/date("t")), '2', ',', '.').'<br>';
			}
			
	$content .='
			</td>
			<td>';
			for($i=1;$i<=$total_channel;$i++)
			{
				$content .= '0<br>';
			}
			
	$content .='
			</td>
			<td>'.$content_total_user.'</td>
			<td>'.$content_avg_user.'</td>
		</tr>';
	$no++;
}
$content .='
									</tbody>
									</table>';
									
}

$content .='								</div>
							</div>
						</div>
					</div>
				</section>
';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
				$("#datepicker2").datepicker({format: "yyyy-mm-dd"});
            });
        </script>';
		
    $title	= 'Subscriber Management System';
    $submenu	= "sms";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>