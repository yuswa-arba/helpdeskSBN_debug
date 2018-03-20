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
	$id				= isset($_GET['id']) ? (int)$_GET['id'] : '';

$content = '<!-- Content Header (Page header) -->
                

                <!-- Main content -->
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
												<input type="hidden" class="form-control" readonly="" name="id_provider" id="id_provider" value="'.$id_provider.'">
												<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" name="date" id="date" value="'.date("Y-m-d").'">
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
	
	$content .='
<table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th width="3%">No.</th>
					<th>Customer Name</th>
					<th>Channel Name</th>
					<th>Start Date</th>
					<th>Expired Date</th>
					<th>Price</th>
					
					
                  </tr>
                </thead>
                <tbody>';
//select data


	$id				= isset($_POST["id_provider"]) ? trim(strip_tags($_POST["id_provider"])) : "";
	$date			= isset($_POST["date"]) ? trim(strip_tags($_POST["date"])) :  date("Y-m-d H:i:s");
	$date2			= isset($_POST["date2"]) ? trim(strip_tags($_POST["date2"])) : date("Y-m-d H:i:s");
    $sql_data		= mysqli_query($conn, "SELECT * FROM `gx_tv_channel_provider` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC LIMIT $start, $perhalaman;");
	$sql_total_data	= mysqli_num_rows(mysqli_query("SELECT * FROM `gx_tv_channel_provider` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC;", $conn));
	//echo "SELECT * FROM `gx_tv_channel_provider` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC LIMIT $start, $perhalaman;";
   
	$hal		= "?id_provider=";


	
    $no = $start + 1;
	$total = 0;

    while($row_data = mysqli_fetch_array($sql_data))
    {
			
			$sql_date		= ($date != "") ? "AND `boss`.`t_consumerecord`.`EXPENSEDT` >= '$date 00:00:00'" : "";
			$sql_date2		= ($date2 != "") ? "AND `boss`.`t_consumerecord`.`EXPENSEDT` <= '$date2 23:59:59'" : "";
			
			$sql_data_tv	= mysqli_query($conn_ott, "SELECT `boss`.`t_consumerecord`.*, `boss`.`t_account_cms`.`CLIENTNAME`, `boss`.`t_account_cms`.`BALANCE`, `ott`.`ott_livechannel`.`channelName`
									   FROM `boss`.`t_consumerecord`, `boss`.`t_account_cms`, `ott`.`ott_livechannel`
									   WHERE `boss`.`t_consumerecord`.`CLIENTID` = `boss`.`t_account_cms`.`CLIENTID`
									   AND `boss`.`t_consumerecord`.`PROID` = '".$row_data["id_channel"]."'
									   AND `boss`.`t_consumerecord`.`PROID` = `ott`.`ott_livechannel`.`channelId`
									   $sql_date
									   $sql_date2
									   AND `boss`.`t_consumerecord`.`ORDERTYPE` = '3'
									   ORDER BY  `boss`.`t_consumerecord`.`EXPENSEDT` DESC;");
		
		while($row_data_tv	= mysqli_fetch_array($sql_data_tv))
		{
			$content .='<tr>
					<td>'.$no.'.</td>
					<td>'.$row_data_tv["CLIENTNAME"].'</td>
					<td>'.$row_data_tv["channelName"].'</td>
					<td>'.$row_data_tv["EXPENSEDT"].'</td>
					<td>'.$row_data_tv["VALIDDATE"].'</td>
					<td>'.number_format($row_data_tv["PRICE"], 0,'', '.').'</td>
					
					</td>
				</tr>';
				$total = $total + $row_data_tv["PRICE"];
			$no++;
		}
    }
	
	
$query_provider 	= "SELECT * FROM `gx_tv_provider_setting` WHERE `id_setting`='1' LIMIT 0,1;";
$sql_provider		= mysqli_query($conn, $query_provider);
$row_provider		= mysqli_fetch_array($sql_provider);
$persen 			= $row_provider["persen_margin"];

$persen_margin = ($persen/100) * $total;
$content .='<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					
					<td><b>Subtotal<b></td>
					<td><b>'.number_format($total, 0,'', '.').'<b></td>
					
					
                  </tr>
				  <tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					
					<td><b>Persentase Margin Provider ('.$persen.'%)<b></td>
					<td><b>'.number_format($persen_margin, 0,'', '.').'<b></td>
					
                  </tr>
				</tbody>
</table>';
}

$content .='
</div>

			
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
		
    $title	= 'Subscriber';
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