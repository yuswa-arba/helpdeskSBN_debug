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
	
	$RECHARGEID     = isset($_POST['RECHARGEID']) ? mysql_real_escape_string(trim($_POST['RECHARGEID'])) : '';
    $MONEY      	= isset($_POST['MONEY']) ? (int)($_POST['MONEY']) : '0';
	$RECHARGEDT     = isset($_POST['RECHARGEDT']) ? mysql_real_escape_string(trim($_POST['RECHARGEDT'])) : '';
	$CLIENTID      	= isset($_POST['CLIENTID']) ? mysql_real_escape_string(trim($_POST['CLIENTID'])) : '';
	
	
	
	//670b14728ad9902aecba32e22fa4f6bd
	
    if($MONEY != "0" || $RECHARGEID != "" || $CLIENTID != ""){
		
		//select user
		$query_data = "SELECT `BALANCE` FROM `boss`.`t_account_cms` WHERE `boss`.`t_account_cms`.`CLIENTID`='".$CLIENTID."' LIMIT 0,1;";
		$sql_data	= mysqli_query($conn_ott,$query_data);
		$row_data	= mysqli_fetch_array($sql_data);
		$total_balance	= $row_data["BALANCE"] + $MONEY;
		
		
		//insert into gx_data
		$sql_insert_data = "INSERT INTO `boss`.`t_recharge` (`RECHARGEID`, `MONEY`, `RECHARGEDT`, `CLIENTID`)
		VALUES ('".$RECHARGEID."', '".$MONEY."', NOW(), '".$CLIENTID."');";
		
		mysqli_query($conn_ott ,$sql_insert_data) or die (mysqli_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_data);
		
		
		//insert into gx_data
		$sql_update_data = "UPDATE `boss`.`t_account_cms` SET `BALANCE`='".$total_balance."'
		WHERE (`CLIENTID`='".$CLIENTID."');";
		
		mysqli_query($conn_ott ,$sql_update_data) or die (mysqli_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_data);
		
		
		//echo $sql_insert_data;
		//header("location: stb_user.php");
		echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='list_payment.php';
			</script>";
    }else{
		echo "<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
		</script>";
    }
    
}


if(isset($_GET["id"]))
{
    $id_data	= isset($_GET['id']) ? strip_tags($_GET['id']) : '';
    $query_data = "SELECT * FROM `boss`.`t_recharge` WHERE `boss`.`t_recharge`.`RECHARGEID`='".$id_data."' LIMIT 0,1;";
    $sql_data	= mysqli_query($conn_ott,$query_data);
    $row_data	= mysqli_fetch_array($sql_data);
    
}
	$sql_data_boss	= mysqli_query($conn_ott,"SELECT * FROM `boss`.`t_recharge`;");
	$count_data_boss	= mysqli_num_rows($sql_data_boss);
	$count = $count_data_boss + 1;
	
    $content ='

                <!-- Main content -->
                <section class="content">
					
					
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <!-- /.box-header -->
								<div class="box-header">
                                    <h3 class="box-title">Form Payment</h3>
                                </div>
                                <!-- form start -->
                                <form name="formtopup" action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
									
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>CLIENTID</label>
					    </div>
					    <div class="col-xs-8">
						<input type="hidden"  name="RECHARGEID" value="'.(isset($_GET['id']) ? $row_data["RECHARGEID"] : "TUTV".sprintf("%05d", $count)."").'">
						<input name="CLIENTID" type="text" class="form-control" readonly="" value="'.(isset($_GET['id']) ? $row_data["CLIENTID"] : "").'"
						onclick="return valideopenerform(\'data_user.php?r=formtopup\',\'topup\');">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-8">
						<input name="RECHARGEDT" readonly=""class="form-control" required="" type="text" value="'.(isset($_GET['id']) ? $row_data["RECHARGEDT"] : date("Y-m-d H:i:s")).'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nominal</label>
					    </div>
					    <div class="col-xs-4">
						<input name="MONEY"  type="text" value="" required="" class="form-control" id="MONEY" maxlength="11">
					    </div>
					</div>
					</div>
					
								
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form User';
    $submenu	= "stb_user";
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