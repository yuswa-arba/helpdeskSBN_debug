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
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open STB User");
    global $conn;
    $conn_ott   = DB_TV();
	
    $perhalaman = 40;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }

$content = '<!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">
					<div class="row">
					<div class="col-xs-12">
						<div class="box">
						<div class="box-body">
							<a href="form_user.php" class="btn bg-maroon btn-flat margin">Add User</a>
						</div>
						</div>
					</div>
					</div>
		    
		    <div class="row">
                        <div class="col-xs-12">
                             <div class="box">
							 <div class="box-header">
                                    <h3 class="box-title">Search Data</h3>                                    
                                </div><!-- /.box-header -->
								<form action="" method="post" name="form_search" id="form_search">
								<div class="box-body table-responsive">
								<table id="example1" class="table table-bordered table-striped">
								<thead>
								  <tr>
									<th>Username</th>
									<th>SN</th>
									<th>MAC</th>
									<th></th>
								  </tr>
								</thead>
								<tbody>
								<tr>
									<td><input type="text" class="form-control" name="username" placeholder="username" value=""></td>
									<td><input type="text" class="form-control" name="userid" placeholder="SN" value=""></td>
									<td><input type="text" class="form-control" name="mac" placeholder="mac" value=""></td>
									<td><input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search"></td>
									
								</tr>
								</tbody>
								</table>
								</div>
									</form>
                                <div class="box-header">
                                    <h3 class="box-title">List Data</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th width="3%">No.</th>
					<th>Username</th>
					<th>UserID</th>
					<th>Login Status</th>
					<th>User Subscription</th>
					<th>Balance</th>
					<th>Payment History</th>
					<th width="10%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data
if(isset($_POST["save_search"])){
	$username	= isset($_POST['username']) ? mysql_real_escape_string(strip_tags(trim($_POST['username']))) : "";
	$mac		= isset($_POST['mac']) ? mysql_real_escape_string(strip_tags(trim($_POST['mac']))) : "";
	$userid		= isset($_POST['userid']) ? mysql_real_escape_string(strip_tags(trim($_POST['userid']))) : "";
	
    $sql_data		= mysqli_query($conn_ott, "SELECT * FROM `boss`.`t_account_cms` WHERE `boss`.`t_account_cms`.`CLIENTNAME` LIKE '%".$username."%' AND `boss`.`t_account_cms`.`MACADDRESS` LIKE '%".$mac."%' AND `boss`.`t_account_cms`.`CLIENTCODE` LIKE '".$userid."%' LIMIT $start, $perhalaman;");
    $sql_total_data	= mysqli_num_rows(mysqli_query($conn_ott, "SELECT * FROM `boss`.`t_account_cms` WHERE `boss`.`t_account_cms`.`CLIENTNAME` LIKE '%".$username."%' AND `boss`.`t_account_cms`.`MACADDRESS` LIKE '%".$mac."%' AND `boss`.`t_account_cms`.`CLIENTCODE` LIKE '".$userid."%';"));
}else{
	$sql_data		= mysqli_query($conn_ott, "SELECT * FROM `boss`.`t_account_cms` LIMIT $start, $perhalaman;");
    $sql_total_data	= mysqli_num_rows(mysqli_query($conn_ott, "SELECT * FROM `boss`.`t_account_cms`;"));
}
    $hal		= "?";
    $no = $start + 1;
	
	

    while($row_data = mysqli_fetch_array($sql_data))
    {
		$sql_paket		= mysqli_query($conn_ott, "SELECT `ott`.`ott_product`.`proName` FROM `boss`.`t_consumerecord`, `ott`.`ott_product`
								   WHERE `boss`.`t_consumerecord`.`PROID` = `ott`.`ott_product`.`proID`
								   AND `boss`.`t_consumerecord`.`CLIENTID` = '".$row_data["CLIENTID"]."'
								   AND `boss`.`t_consumerecord`.`VALIDDATE` >= NOW()
								   ORDER BY `boss`.`t_consumerecord`.`EXPENSEDT` DESC;");
		$paket = "";
		while ($row_paket = mysqli_fetch_array($sql_paket))
		{
			$paket .= $row_paket["proName"].",";
		}
		
		if($row_data["STATUS"] == "1")
		{
			$user_subscription = "Pay Per";
		}
		elseif($row_data["STATUS"] == "2")
		{
			$user_subscription = "Monthly charge";
		}
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["CLIENTNAME"].'</td>
			<td>'.$row_data["CLIENTCODE"].'</td>
			<td>'.($row_data["STATUS"] == "1" ? 'Logged' : 'Not Logged').'</td>
			<td>'.$user_subscription.', '.$paket.'</td>
			<td>'.number_format($row_data["BALANCE"], 0, '', '.').'</td>
			<td><a href="detail_consumer_record.php?id='.$row_data["CLIENTID"].'" onclick="return valideopenerform(\'detail_consumer_record.php?id='.$row_data["CLIENTID"].'\',\'stbuser\');">View</a> </td>
			<td><a href="detail_user.php?id='.$row_data["CLIENTID"].'" onclick="return valideopenerform(\'detail_user.php?id='.$row_data["CLIENTID"].'\',\'stbuser\');">Details</a> | 
			<a href="form_user.php?id='.$row_data["CLIENTID"].'">Update</a>
			</td>
		</tr>';
	$no++;
    }

$content .='</tbody>
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

                </section><!-- /.content -->';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'STB User';
    $submenu	= "stb_user";
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