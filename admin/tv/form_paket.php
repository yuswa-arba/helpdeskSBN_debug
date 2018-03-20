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
include ("../../config/configuration_tv.php");
//include ("config/configuration_ott.php");
redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
		$conn_ott   = DB_TV();
    
if(isset($_POST["save"]))
{
    $proName       	= isset($_POST['proName']) ? mysql_real_escape_string(trim($_POST['proName'])) : '';
    $price       	= isset($_POST['price']) ? mysql_real_escape_string(trim($_POST['price'])) : '';
    $StartDate     	= isset($_POST['StartDate']) ? mysql_real_escape_string(trim($_POST['StartDate'])) : '';
    $endDate       	= isset($_POST['endDate']) ? mysql_real_escape_string(trim($_POST['endDate'])) : '';
    $proType       	= isset($_POST['proType']) ? mysql_real_escape_string(trim($_POST['proType'])) : '';
    $pid	       	= isset($_POST['pid']) ? mysql_real_escape_string(trim($_POST['pid'])) : '0';
    
    $unit       	= isset($_POST['unit']) ? mysql_real_escape_string(trim($_POST['unit'])) : 'd';
    $description   	= isset($_POST['description']) ? mysql_real_escape_string(trim($_POST['description'])) : '';
    $orderType     	= isset($_POST['orderType']) ? mysql_real_escape_string(trim($_POST['orderType'])) : '';
	$createDate		= date("Y/m/d H:i:s");
	
	if($orderType == "1"){
		//bulanan fee
		$viewDate  	= "30";
	}elseif($orderType == "2"){
		//quarter fee
		$viewDate 	= "91";
	}elseif($orderType == "3"){
		//6 bulanan / a half year
		$viewDate	= "183";
	}elseif($orderType == "4"){
		$viewDate	= "365";
	}elseif($orderType == "5"){
		$viewDate	= "7";
	}else{
		$viewDate	= "0";
	}
	
	
    if($proName != ""){
		//insert into gx_data
		$sql_insert_data = "INSERT INTO `ott_product` (`proID`, `proName`, `price`, `StartDate`,
		`endDate`, `proType`, `pid`, `viewDate`, `unit`, `description`, `orderType`)
		VALUES (NULL, '".$proName."', '".$price."', NULL, NULL, '".$proType."', '".$pid."',
		'".$viewDate."', '".$unit."', '".$description."', '".$orderType."');";
		//echo $sql_insert_staff;
		mysqli_query($conn_ott ,$sql_insert_data) or die (mysqli_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_data);
		
		//insert into gx_data
		$sql_insert_log = "INSERT INTO `ott`.`ott_log` (`logID`, `createDate`, `logContext`, `userName`, `menuName`)
		VALUES (NULL, '".$createDate."', 'Added a  ".$proName."', 'OTTWEB (".$loggedin["username"].")', 'Master Paket');";
		//echo $sql_insert_staff;
		mysqli_query($conn_ott ,$sql_insert_log) or die (mysqli_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_log);
		
		
		$query_lastdata = "SELECT * FROM `ott_product` ORDER BY `proID` DESC LIMIT 0,1;";
		$sql_lastdata	= mysqli_query($conn_ott ,$query_lastdata);
		$row_lastdata	= mysqli_fetch_array($sql_lastdata);
		
		header("location: form_paketservice.php?id=".$row_lastdata["proID"]);
		/*echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='form_paket.php';
			</script>";*/
    }else{
		echo "<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
		</script>";
    }
    
}
/*elseif(isset($_POST["update"]))
{
    $id_data	 	= isset($_POST['id_data']) ? mysql_real_escape_string(trim($_POST['id_data'])) : '';
    $kode_data       	= isset($_POST['kode_data']) ? mysql_real_escape_string(trim($_POST['kode_data'])) : '';
    $nama_data       	= isset($_POST['nama_data']) ? mysql_real_escape_string(trim($_POST['nama_data'])) : '';
    $area       	= isset($_POST['area']) ? mysql_real_escape_string(trim($_POST['area'])) : '';
    $coverage       	= isset($_POST['coverage']) ? mysql_real_escape_string(trim($_POST['coverage'])) : '';
    
    if($id_data != ""){
		//insert into gx_data
		$sql_update_data = "UPDATE `gx_data` SET `level` = '1',
				`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
				WHERE `id_data` = '".$id_data."';";
		//echo $sql_update_staff;
		mysql_query($sql_update_data, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_data);
		
		//insert into gx_data
		$sql_insert_data = "INSERT INTO `gx_data` (`id_data`, `kode_data`, `nama_data`, `area`, `coverage`,
				`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
				VALUES (NULL, '".$kode_data."', '".$nama_data."', '".$area."', '".$coverage."',
				'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
		//echo $sql_insert_staff;
		mysql_query($sql_insert_data, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_data);
		
		
		echo "<script language='JavaScript'>
			alert('Data telah diupdate.');
			window.location.href='paket.php';
			</script>";
    }else{
	echo "<script language='JavaScript'>
	    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
	    window.history.go(-1);
	</script>";
    }
}*/

if(isset($_GET["id"]))
{
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data = "SELECT * FROM `ott_product` WHERE `proID`='".$id_data."' LIMIT 0,1;";
    $sql_data	= mysqli_query($conn_ott , $query_data);
    $row_data	= mysqli_fetch_array($sql_data);
    
}

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Paket</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Paket</label>
					    </div>
					    <div class="col-xs-8">
						<input type="hidden"  name="proID" value="'.(isset($_GET['id']) ? $row_data["proID"] : "").'">
						<input type="text" class="form-control" name="proName" required="" value="'.(isset($_GET['id']) ? $row_data["proName"] : "").'">
						
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Harga</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" required="" maxlength="10" name="price" value="'.(isset($_GET['id']) ? $row_data["price"] : "").'">
					    </div>
					</div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Product Type</label>
					    </div>
					    <div class="col-xs-4">
							<select class="form-control" name="proType">
								<option '.((isset($_GET['id']) AND $row_data["proType"] == "1") ? 'selected="selected"' : "").' value="1">VOD</option>
								<option '.((isset($_GET['id']) AND $row_data["proType"] == "2") ? 'selected="selected"' : "").' value="2">Live</option>
								<option '.((isset($_GET['id']) AND $row_data["proType"] == "3") ? 'selected="selected"' : "").' value="3">Replay</option>
								<option '.((isset($_GET['id']) AND $row_data["proType"] == "4") ? 'selected="selected"' : "").' value="4">All</option>
								<option '.((isset($_GET['id']) AND $row_data["proType"] == "5") ? 'selected="selected"' : "").' value="5">Combination</option>
								
							</select>
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Order Type</label>
					    </div>
					    <div class="col-xs-4">
							<select class="form-control" name="orderType">  
								<option '.((isset($_GET['id']) AND $row_data["orderType"] == "1") ? 'selected="selected"' : "").' value="1">Monthly</option>  
								<option '.((isset($_GET['id']) AND $row_data["orderType"] == "2") ? 'selected="selected"' : "").' value="2">Quarterly</option>  
								<option '.((isset($_GET['id']) AND $row_data["orderType"] == "3") ? 'selected="selected"' : "").' value="3">Halfyear</option>  
								<option '.((isset($_GET['id']) AND $row_data["orderType"] == "4") ? 'selected="selected"' : "").' value="4">A year</option>
								<option '.((isset($_GET['id']) AND $row_data["orderType"] == "5") ? 'selected="selected"' : "").' value="5">Weekly</option>
							</select>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Deskripsi</label>
					    </div>
					    <div class="col-xs-8">
							<textarea class="form-control" name="description">'.(isset($_GET['id']) ? $row_data["description"] : "").'</textarea>
					    </div>
					</div>
					</div>
					
					
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Next</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Paket';
    $submenu	= "master_paket";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>