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
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],"Open Menu List OLT Customer");
    $id_olt		= isset($_GET["id"]) ? (int)$_GET["id"] : "";
	
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">List OLT Customer</h3>
                                    
                                </div>
                                <div class="box-body">
								
                                    <form action="detail_olt.php" method="post" name="form_search">
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>Server OLT</label>
					</div>
					<div class="col-xs-4">
					    <select name="id_olt" class="form-control">';

$sql_olt = mysql_query("SELECT * FROM `software`.`gx_inet_listolt` WHERE `level` = '0';", $conn);
while($row_olt = mysql_fetch_array($sql_olt))
{
	$content .='<option value="'.$row_olt["id_server"].'" '.(($id_olt == $row_olt["id_server"]) ? 'selected=""' : '').'>'.$row_olt["nama_server"].'</option>';
}
						
						
$content .='
						</select>
					</div>
					
				    </div>
				    </div>
					<div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>User ID :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" type="text" name="userid" placeholder="User ID">
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
	
	<a href="form_olt_customer" class="btn bg-olive btn-flat margin pull-right">Create New</a><br><br>';
if(isset($_POST["search"])){
    $userid		= isset($_POST["userid"]) ? trim(strip_tags($_POST["userid"])) : "";
	$id_olt		= isset($_POST["id_olt"]) ? (int)$_POST["id_olt"] : "";
	
	$sql_userid = ($userid	!= "") ? "AND	`userid` = '$userid'" : "";
	
	$sql_server_ras = mysql_query("SELECT * FROM `software`.`v_olt_customer`
								  WHERE `id_olt` = '$id_olt'
								  $sql_userid
								ORDER BY `nama_server` ASC, CAST(`urutan_pon` as decimal(10,2)), `id` ASC;", $conn);
	
	//header('location: '.URL_ADMIN.'data/detail_olt.php?id='.$id_olt);
    $content .='<table class="table table-hover table-border">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>UserID</th>
												<th>Nama Server</th>
                                                <th>IP Address</th>
                                                <th>MAC Address</th>
												<th>Group</th>
												
												<th>Interface Uplink</th>
												<th>PON/ID</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

$no = 1;
$color = '';
while ($row_server_ras = mysql_fetch_array($sql_server_ras))
{
	if(($row_server_ras["urutan_pon"] % 4)  == '1')
	{
		$color = 'info';
	}elseif(($row_server_ras["urutan_pon"] % 4) == '2')
	{
		$color = 'success';
	}elseif(($row_server_ras["urutan_pon"] % 4) == '3')
	{
		$color = 'warning';
	}elseif(($row_server_ras["urutan_pon"] % 4) == '0')
	{
		$color = 'danger';
	}
	
    $content .= '<tr class="'.$color.'">
		    <td>'.$no.'.</td>
		    <td>'.$row_server_ras["userid"].' '.(($row_server_ras["status"] == "1") ? " - bongkar" : "" ).'</td>
			<td>'.$row_server_ras["nama_server"].'</td>
		    <td>'.($row_server_ras["ip_address"]).'</td>
			<td>'.($row_server_ras["mac_address"]).'</td>
			<td>'.($row_server_ras["nama_inet_listgroup"]).'</td>
			<td>'.($row_server_ras["interface_uplink"]).'</td>
			<td>'.($row_server_ras["pon"]).':'.($row_server_ras["id"]).'</td>
			<td><a href="form_olt_customer.php?id='.$row_server_ras["id_olt_customer"].'">edit</a></td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>';
									
}
if(isset($_GET["id"])){
    //$userid		= isset($_POST["userid"]) ? trim(strip_tags($_POST["userid"])) : "";
	$id_olt		= isset($_GET["id"]) ? (int)$_GET["id"] : "";
    
    $sql_server_ras = mysql_query("SELECT * FROM `software`.`v_olt_customer`
								  WHERE `id_olt` = '$id_olt'								  
								ORDER BY `nama_server` ASC, CAST(`urutan_pon` as decimal(10,2)), `id` ASC;", $conn);
	
//}else{
   // $sql_server_ras = mysql_query("SELECT * FROM `v_olt_customer` ORDER BY `nama_server` ASC;", $conn);
//}


$content .='<table class="table table-hover table-border">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>UserID</th>
												<th>Nama Server</th>
                                                <th>IP Address</th>
												<th>MAC Address</th>
                                                <th>Group</th>
												<th>Interface Uplink</th>
												<th>PON/ID</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

$no = 1;
$color = '';
while ($row_server_ras = mysql_fetch_array($sql_server_ras))
{
	if(($row_server_ras["urutan_pon"] % 4)  == '1')
	{
		$color = 'info';
	}elseif(($row_server_ras["urutan_pon"] % 4) == '2')
	{
		$color = 'success';
	}elseif(($row_server_ras["urutan_pon"] % 4) == '3')
	{
		$color = 'warning';
	}elseif(($row_server_ras["urutan_pon"] % 4) == '0')
	{
		$color = 'danger';
	}
	
    $content .= '<tr class="'.$color.'">
		    <td>'.$no.'.</td>
		    <td>'.$row_server_ras["userid"].' '.(($row_server_ras["status"] == "1") ? " - bongkar" : "" ).'</td>
			<td>'.$row_server_ras["nama_server"].'</td>
			
		    <td>'.($row_server_ras["ip_address"]).'</td>
			<td>'.($row_server_ras["mac_address"]).'</td>
			<td>'.($row_server_ras["nama_inet_listgroup"]).'</td>
			<td>'.($row_server_ras["interface_uplink"]).'</td>
			<td>'.($row_server_ras["pon"]).':'.($row_server_ras["id"]).'</td>
			<td><a href="form_olt_customer.php?id='.$row_server_ras["id_olt_customer"].'">edit</a></td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>';
									
}
$content .='
                                    
                                </div><!-- /.box-body-->
                                
                            </div><!-- /.box -->
                            </form>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->

            ';

$plugins = '';

    $title	= 'List OLT Customer';
    $submenu	= "inet_server_ras";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>