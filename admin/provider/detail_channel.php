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
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Provider");
    global $conn;
	$conn_ott   = DB_TV();
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
	 $id_provider		= isset($_GET['id']) ? (int)$_GET['id'] : '';
	 $id_channel		= isset($_GET['cid']) ? (int)$_GET['cid'] : '';
	 
	 $sql_provider		= mysqli_query($conn, "SELECT `id_provider` FROM `gx_tv_channel_provider` WHERE `id_provider` = '".$id_provider."' LIMIT 0, 1;");
	 $row_provider		= mysqli_fetch_array($sql_provider);

	 $sql_channel		= mysqli_query($conn_ott, "SELECT `channelName` FROM `ott`.`ott_livechannel` WHERE `channelId` = '".$id_channel."' LIMIT 0, 1;");
	 $row_channel		= mysqli_fetch_array($sql_channel);

$content = '
                <!-- Main content -->
				<section class="content">
					

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Channel '.$row_channel["channelName"].'</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								
								<form action="" method="post" name="form_search">
								
			
									
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
											<label>Start Date</label>
											</div>
											<div class="col-xs-3">
												<input type="hidden" readonly="" name="id" value="'.(isset($_GET['id']) ? (int)$_GET['id'] : '').'">
												<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" name="date" id="date" value="'.date("d-m-Y").'">
											</div>
										</div>
										</div>
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
											<label>Finish Date</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker" id="datepicker2" readonly="" name="date2" id="date" value="'.date("d-m-Y").'">
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
	<hr>

<table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th width="3%">No.</th>
					<th>Customer Name</th>
					
					<th>Start Date</th>
					
					<th>Price</th>
					
					
                  </tr>
                </thead>
                <tbody>';
//select data

if(isset($_POST["search"]))
{
    $id_provider	= isset($_GET['id']) ? (int)$_GET['id'] : '';
	$id_channel		= isset($_GET['cid']) ? (int)$_GET['cid'] : '';
    $date		= isset($_POST["date"]) ? trim(strip_tags($_POST["date"])) :  date("Y-m-d H:i:s");
    $date2		= isset($_POST["date2"]) ? trim(strip_tags($_POST["date2"])) : date("Y-m-d H:i:s");
	
	$date		= date("Y-m-d", strtotime($date));
	$date2		= date("Y-m-d", strtotime($date2));
	$sql_date		= ($date != "") ? 'AND `boss`.`t_consumerecord`.`EXPENSEDT` >= \''.$date.' 00:00:00\'' : "";
    $sql_date2		= ($date2 != "") ? 'AND `boss`.`t_consumerecord`.`EXPENSEDT` <= \''.$date2.' 23:59:59\'' : "";
    
	
	//$id_channel		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    //$sql_data		= mysqli_query($conn, "SELECT * FROM `gx_tv_channel_provider` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC LIMIT $start, $perhalaman;");
	//$sql_total_data	= mysqli_num_rows(mysqli_query("SELECT * FROM `gx_tv_channel_provider` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC;", $conn));
	//echo "SELECT * FROM `gx_tv_channel_provider` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC LIMIT $start, $perhalaman;";
   	$sql_data	= mysqli_query($conn_ott, "SELECT `boss`.`t_consumerecord`.*, `boss`.`t_account_cms`.`CLIENTNAME`, `boss`.`t_account_cms`.`BALANCE`
									   FROM `boss`.`t_consumerecord`, `boss`.`t_account_cms`
									   WHERE `boss`.`t_consumerecord`.`CLIENTID` = `boss`.`t_account_cms`.`CLIENTID`
									   AND `boss`.`t_consumerecord`.`PROID` = '".$id_channel."'
									   $sql_date
									   $sql_date2
									   ORDER BY `boss`.`t_consumerecord`.`RECORDID` DESC LIMIT $start, $perhalaman;");
		$sql_total_data	= mysqli_num_rows(mysqli_query($conn_ott, "SELECT `boss`.`t_consumerecord`.*, `boss`.`t_account_cms`.`CLIENTNAME`, `boss`.`t_account_cms`.`BALANCE`
									   FROM `boss`.`t_consumerecord`, `boss`.`t_account_cms`
									   WHERE `boss`.`t_consumerecord`.`CLIENTID` = `boss`.`t_account_cms`.`CLIENTID`
									   AND `boss`.`t_consumerecord`.`PROID` = '".$id_channel."'
									   $sql_date
									   $sql_date2
									   ORDER BY `boss`.`t_consumerecord`.`RECORDID` DESC;"));
		$hal		= "?id=$id_provider&cid=$id_channel&d=$date&f=$date2&";
		echo "search";
}
elseif(isset($_GET["id"]))
{
	//$id				= $loggedin["id_provider"];
	$id_provider	= isset($_GET['id']) ? (int)$_GET['id'] : '';
	$id_channel		= isset($_GET['cid']) ? (int)$_GET['cid'] : '';
    //$sql_data		= mysqli_query($conn, "SELECT * FROM `gx_tv_channel_provider` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC LIMIT $start, $perhalaman;");
	//$sql_total_data	= mysqli_num_rows(mysqli_query("SELECT * FROM `gx_tv_channel_provider` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC;", $conn));
	//echo "SELECT * FROM `gx_tv_channel_provider` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC LIMIT $start, $perhalaman;";
   
		
		$sql_data	= mysqli_query($conn_ott, "SELECT `boss`.`t_consumerecord`.*, `boss`.`t_account_cms`.`CLIENTNAME`, `boss`.`t_account_cms`.`BALANCE`
									   FROM `boss`.`t_consumerecord`, `boss`.`t_account_cms`
									   WHERE `boss`.`t_consumerecord`.`CLIENTID` = `boss`.`t_account_cms`.`CLIENTID`
									   AND `boss`.`t_consumerecord`.`PROID` = '".$id_channel."' ORDER BY `boss`.`t_consumerecord`.`RECORDID` DESC LIMIT $start, $perhalaman;");
		$sql_total_data	= mysqli_num_rows(mysqli_query($conn_ott, "SELECT `boss`.`t_consumerecord`.*, `boss`.`t_account_cms`.`CLIENTNAME`, `boss`.`t_account_cms`.`BALANCE`
									   FROM `boss`.`t_consumerecord`, `boss`.`t_account_cms`
									   WHERE `boss`.`t_consumerecord`.`CLIENTID` = `boss`.`t_account_cms`.`CLIENTID`
									   AND `boss`.`t_consumerecord`.`PROID` = '".$id_channel."' ORDER BY `boss`.`t_consumerecord`.`RECORDID` DESC;"));
		$hal		= "?";
		//id
}
elseif(isset($_GET["d"]) || isset($_GET["f"]))
{
    $date		= isset($_POST["d"]) ? trim(strip_tags($_POST["d"])) :  date("Y-m-d H:i:s");
    $date2		= isset($_POST["f"]) ? trim(strip_tags($_POST["f"])) : date("Y-m-d H:i:s");
	
	$date		= date("Y-m-d", strtotime($date));
	$date2		= date("Y-m-d", strtotime($date2));
	$sql_date		= ($date != "") ? 'AND `boss`.`t_consumerecord`.`EXPENSEDT` >= \''.$date.' 00:00:00\'' : "";
    $sql_date2		= ($date2 != "") ? 'AND `boss`.`t_consumerecord`.`EXPENSEDT` <= \''.$date2.' 23:59:59\'' : "";
    
	$id_provider	= isset($_GET['id']) ? (int)$_GET['id'] : '';
	$id_channel		= isset($_GET['cid']) ? (int)$_GET['cid'] : '';
    //$sql_data		= mysqli_query($conn, "SELECT * FROM `gx_tv_channel_provider` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC LIMIT $start, $perhalaman;");
	//$sql_total_data	= mysqli_num_rows(mysqli_query("SELECT * FROM `gx_tv_channel_provider` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC;", $conn));
	//echo "SELECT * FROM `gx_tv_channel_provider` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC LIMIT $start, $perhalaman;";
	$sql_data	= mysqli_query($conn_ott, "SELECT `boss`.`t_consumerecord`.*, `boss`.`t_account_cms`.`CLIENTNAME`, `boss`.`t_account_cms`.`BALANCE`
									   FROM `boss`.`t_consumerecord`, `boss`.`t_account_cms`
									   WHERE `boss`.`t_consumerecord`.`CLIENTID` = `boss`.`t_account_cms`.`CLIENTID`
									   AND `boss`.`t_consumerecord`.`PROID` = '".$id_channel."'
									   $sql_date
									   $sql_date2
									   ORDER BY `boss`.`t_consumerecord`.`RECORDID` DESC LIMIT $start, $perhalaman;");
		$sql_total_data	= mysqli_num_rows(mysqli_query($conn_ott, "SELECT `boss`.`t_consumerecord`.*, `boss`.`t_account_cms`.`CLIENTNAME`, `boss`.`t_account_cms`.`BALANCE`
									   FROM `boss`.`t_consumerecord`, `boss`.`t_account_cms`
									   WHERE `boss`.`t_consumerecord`.`CLIENTID` = `boss`.`t_account_cms`.`CLIENTID`
									   AND `boss`.`t_consumerecord`.`PROID` = '".$id_channel."'
									   $sql_date
									   $sql_date2
									   ORDER BY `boss`.`t_consumerecord`.`RECORDID` DESC;"));
		$hal		= "?id=$id&d=$date&f=$date2&";
	//search id
}

	
		$no = $start + 1;
		$total = 0;
		
		while($row_data	= mysqli_fetch_array($sql_data))
		{
			$content .='<tr>
					<td>'.$no.'.</td>
					<td>'.$row_data["CLIENTNAME"].'</td>
					
					<td>'.$row_data["EXPENSEDT"].'</td>
					
					<td>'.number_format($row_data["PRICE"], 0,'', '.').'</td>
					
					</td>
				</tr>';
				$total = $total + $row_data["PRICE"];
			$no++;
		}

$query_provider 	= "SELECT * FROM `gx_tv_provider` WHERE `id_provider`='".$id_provider."' LIMIT 0,1;";

$sql_provider		= mysql_query($query_provider, $conn);
$row_provider		= mysql_fetch_array($sql_provider);
$persen 			= $row_provider["persentase_margin"];


$persen_margin = ($persen/100) * $total;
$content .='<tr>
					<td></td>
					
					<td></td>
					
					<td><b>Subtotal<b></td>
					<td><b>'.number_format($total, 0,'', '.').'<b></td>
					
					
                  </tr>
				  <tr>
					<td></td>
					
					<td></td>
					
					<td><b>Persentase Margin Provider ('.$persen.'%)<b></td>
					<td><b>'.number_format($persen_margin, 0,'', '.').'<b></td>
					
                  </tr>
				  
</tbody>
</table>
</div>

			<div class="box-footer">
				<div class="box-tools pull-right">
				'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
				</div>
				<br style="clear:both;">
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
                $("#datepicker").datepicker({format: "dd-mm-yyyy"});
				$("#datepicker2").datepicker({format: "dd-mm-yyyy"});
            });
        </script>';

    $title	= 'Detail Channel';
    $submenu	= "channel_provider";
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