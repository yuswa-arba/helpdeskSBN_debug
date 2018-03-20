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
	
	$CLIENTID     	= isset($_POST['CLIENTID']) ? mysql_real_escape_string(trim($_POST['CLIENTID'])) : '';
    $username      	= isset($_POST['username']) ? mysql_real_escape_string(trim($_POST['username'])) : '';
	$loginname     	= isset($_POST['loginname']) ? mysql_real_escape_string(trim($_POST['loginname'])) : '';
	$password      	= isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : '';
	$SN_STB      	= isset($_POST['SN_STB']) ? mysql_real_escape_string(trim($_POST['SN_STB'])) : '';
	$MACADDRESS    	= isset($_POST['MACADDRESS']) ? mysql_real_escape_string(trim($_POST['MACADDRESS'])) : '';
	$USESTATE      	= isset($_POST['USESTATE']) ? mysql_real_escape_string(trim($_POST['USESTATE'])) : '';
	$GENDAR       	= isset($_POST['GENDAR']) ? mysql_real_escape_string(trim($_POST['GENDAR'])) : '';
    $birthday      	= isset($_POST['birthday']) ? mysql_real_escape_string(trim($_POST['birthday'])) : '';
	$phone       	= isset($_POST['phone']) ? mysql_real_escape_string(trim($_POST['phone'])) : '';
    $email       	= isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : '';
	$VIEWPASSWORD  	= isset($_POST['VIEWPASSWORD']) ? mysql_real_escape_string(trim($_POST['VIEWPASSWORD'])) : '';
    $ORDERTYPE     	= isset($_POST['ORDERTYPE']) ? mysql_real_escape_string(trim($_POST['ORDERTYPE'])) : '';
	$address       	= isset($_POST['address']) ? mysql_real_escape_string(trim($_POST['address'])) : '';
    $location      	= isset($_POST['location']) ? mysql_real_escape_string(trim($_POST['location'])) : '';
    
	$useridstb     	= $SN_STB.''.$MACADDRESS;
    
	
	
	
	//670b14728ad9902aecba32e22fa4f6bd
	
    if($username != "" || $MACADDRESS != "" || $SN_STB != ""){
		//insert into gx_data
		$sql_insert_data = "INSERT INTO `boss`.`t_account_cms` (`CLIENTID`, `CLIENTNAME`, `CLIENTCODE`, `TOKEN`, `STATUS`, `STARTDATE`, `ENDDATE`,
		`PASSWORD`, `STBID`, `ORDERTYPE`, `BALANCE`, `BIRTHDAY`, `GENDAR`, `STATE`, `ORDERS`, `RESULT`, `EMAIL`, `REGISTTIME`, `EXPENDAMOUNT`,
		`PHONE`, `USESTATE`, `SBA`, `VIEWPASSWORD`, `LOCATION`, `UNIT`, `PHOTOPROFILE`, `ADDRESS`, `MACADDRESS`, `role`)
		VALUES ('".$CLIENTID."', '".$username."', '".$useridstb."', '', '1', '', '',
		'".$password."', '0', '1', '0', '".$birthday."', '".$GENDAR."', NULL, NULL, NULL, '".$email."', NULL, '0',
		'".$phone."', '1', NULL, '".$VIEWPASSWORD."', '".$location."', NULL, '', '".$address."', '".$MACADDRESS."', '1');";
		
		mysqli_query($conn_ott ,$sql_insert_data) or die (mysqli_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_data);
		
		/*insert into gx_data
		$sql_insert_log = "INSERT INTO `ott`.`ott_log` (`logID`, `createDate`, `logContext`, `userName`, `menuName`)
		VALUES (NULL, '".$createDate."', 'Added a  ".$proName."', 'OTTWEB (".$loggedin["username"].")', 'Master Paket');";
		//echo $sql_insert_staff;
		mysqli_query($conn_ott ,$sql_insert_log) or die (mysqli_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_log);
		*/
		//echo $sql_insert_data;
		//header("location: stb_user.php");
		echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='stb_user.php';
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
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data = "SELECT * FROM `boss`.`t_account_cms` WHERE `proID`='".$id_data."' LIMIT 0,1;";
    $sql_data	= mysqli_query($conn_ott,$query_data);
    $row_data	= mysqli_fetch_array($sql_data);
    
}
	$sql_data_boss	= mysqli_query($conn_tv,"SELECT `boss`.`t_acccount_cms`.* FROM `boss`.`t_account_cms` WHERE `boss`.`t_account_cms`.`CLIENTID` LIKE 'USR%' ;");
	$count_data_boss	= mysqli_num_rows($sql_data_boss);
	$count = $count_data_boss + 1;
	
    $content ='<section class="content-header">
                    <h1>
                        STB User
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="row">
					<div class="col-xs-12">
						<div class="box">
						<div class="box-body">
							<div class="box-header">
                                    <h3 class="box-title">Form STB User</h3>
                                </div>
						</div>
						</div>
					</div>
					</div>
					
					<div class="row">
					<div class="col-xs-12">
						<div class="box">
						<div class="box-body">
							<a href="data_customer.php" class="btn bg-maroon btn-flat margin" onclick="return valideopenerform(\'data_customer.php?r=formuser\',\'user\');">Search Customer</a>
						</div>
						</div>
					</div>
					</div>
					
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form name="formuser" action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
									
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Username</label>
					    </div>
					    <div class="col-xs-8">
						<input type="hidden"  name="CLIENTID" value="'.(isset($_GET['id']) ? $row_data["CLIENTID"] : "USR".sprintf("%05d", $count)."").'">
						<input name="username" type="text" class="form-control" maxlength="30" value="'.(isset($_GET['id']) ? $row_data["CLIENTNAME"] : "").'">
					    </div>
                    </div>
					</div>
					<!--
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Login Name</label>
					    </div>
					    <div class="col-xs-8">
						<input name="loginname" class="form-control" required="" type="text" maxlength="30" value="'.(isset($_GET['id']) ? $row_data["CLIENTCODE"] : "").'">
					    </div>
                    </div>
					</div>-->
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Default password</label>
					    </div>
					    <div class="col-xs-4">
						<input name="password" readonly="" type="password" value="000000" required="" class="form-control" id="password" maxlength="20">
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>SN STB</label>
					    </div>
					    <div class="col-xs-8">
							<input name="SN_STB" type="text" class="form-control" maxlength="30" value="">
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Mac Address</label>
					    </div>
					    <div class="col-xs-8">
						<input name="MACADDRESS" class="form-control" type="text" maxlength="30" value="'.(isset($_GET['id']) ? $row_data["MACADDRESS"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Using a State</label>
					    </div>
					    <div class="col-xs-8">
						<input name="USESTATE" type="radio" value="0" '.((isset($_GET['id']) AND $row_data["USESTATE"] == "0") ? 'checked="checked"' : "").'>Disable&nbsp;
						<input name="USESTATE" type="radio" value="1" '.((isset($_GET['id']) AND $row_data["USESTATE"] == "1") ? 'checked="checked"' : "").'>Available
						
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Gender</label>
					    </div>
					    <div class="col-xs-8">
						<input name="GENDAR" type="radio" value="Man" '.((isset($_GET['id']) AND $row_data["GENDAR"] == "Man") ? 'checked="checked"' : "").'>Man&nbsp;
						<input name="GENDAR" type="radio" value="Woman" '.((isset($_GET['id']) AND $row_data["GENDAR"] == "Woman") ? 'checked="checked"' : "").'>Woman
						
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Date of Birth</label>
					    </div>
					    <div class="col-xs-8">
						<input name="birthday" class="form-control" type="text" readonly="" value="'.(isset($_GET['id']) ? $row_data["BIRTHDAY"] : "").'">
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Phone</label>
					    </div>
					    <div class="col-xs-8">
						<input name="phone" class="form-control" type="text" value="'.(isset($_GET['id']) ? $row_data["PHONE"] : "").'">
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Email Address</label>
					    </div>
					    <div class="col-xs-8">
						<input name="email" class="form-control" type="text" value="'.(isset($_GET['id']) ? $row_data["EMAIL"] : "").'">
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Access to the password</label>
					    </div>
					    <div class="col-xs-8">
						<input name="VIEWPASSWORD" class="form-control" type="text" value="'.(isset($_GET['id']) ? $row_data["VIEWPASSWORD"] : "").'">
					    </div>
                    </div>
					</div>
                          
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>User subscription type</label>
					    </div>
					    <div class="col-xs-4">
							<select class="form-control" name="ORDERTYPE">
								<option '.((isset($_GET['id']) AND $row_data["ORDERTYPE"] == "1") ? 'selected="selected"' : "").' value="1">Pay per</option>
								<option '.((isset($_GET['id']) AND $row_data["ORDERTYPE"] == "2") ? 'selected="selected"' : "").' value="2">Monthly charge</option>
								
							</select>
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Address</label>
					    </div>
					    <div class="col-xs-8">
						<input name="address" class="form-control" type="text" value="'.(isset($_GET['id']) ? $row_data["ADDRESS"] : "").'">
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Location</label>
					    </div>
					    <div class="col-xs-8">
						<input name="location" class="form-control" type="text" value="'.(isset($_GET['id']) ? $row_data["LOCATION"] : "").'">
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