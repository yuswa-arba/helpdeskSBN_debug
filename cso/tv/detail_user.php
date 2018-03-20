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

redirectToHTTPS();
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Technician");
   
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open STB User");
    global $conn;
    $conn_ott   = DB_TV();
	
if(isset($_GET["id"]))
{
    $id_data	= isset($_GET['id']) ? $_GET['id'] : '';
    $query_data = "SELECT * FROM `boss`.`t_account_cms` WHERE `boss`.`t_account_cms`.`CLIENTID`='".$id_data."' LIMIT 0,1;";
    $sql_data	= mysqli_query($conn_ott,$query_data);
    $row_data	= mysqli_fetch_array($sql_data);
    //echo $query_data;
}
	$sql_data_boss	= mysqli_query($conn_tv,"SELECT `boss`.`t_acccount_cms`.* FROM `boss`.`t_account_cms` WHERE `boss`.`t_account_cms`.`CLIENTID` LIKE 'USR%' ;");
	$count_data_boss	= mysqli_num_rows($sql_data_boss);
	$count = $count_data_boss + 1;
	
    $content ='

                <!-- Main content -->
                <section class="content">
					<div class="row">
					<div class="col-xs-12">
						<div class="box">
						<div class="box-body">
							<div class="box-header">
                                    <h3 class="box-title">Detail STB User <b>'.$row_data["CLIENTNAME"].'</b></h3>
                                </div>
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
						<input type="hidden"  name="CLIENTID" value="'.$row_data["CLIENTID"].'">
						<input name="username" readonly="" type="text" class="form-control" maxlength="30" value="'.$row_data["CLIENTNAME"].'">
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>User ID</label>
					    </div>
					    <div class="col-xs-8">
						<input name="loginname" class="form-control" readonly="" required="" type="text" maxlength="30" value="'.(isset($_GET['id']) ? $row_data["CLIENTCODE"] : "").'">
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Mac Address</label>
					    </div>
					    <div class="col-xs-8">
						<input name="MACADDRESS" readonly="" class="form-control" type="text" maxlength="30" value="'.(isset($_GET['id']) ? $row_data["MACADDRESS"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Using a State</label>
					    </div>
					    <div class="col-xs-8">
						<input name="USESTATE" disabled type="radio" value="0" '.((isset($_GET['id']) AND $row_data["USESTATE"] == "0") ? 'checked="checked"' : "").'>Disable&nbsp;
						<input name="USESTATE" disabled type="radio" value="1" '.((isset($_GET['id']) AND $row_data["USESTATE"] == "1") ? 'checked="checked"' : "").'>Available
						
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Gender</label>
					    </div>
					    <div class="col-xs-8">
						<input name="GENDAR" disabled type="radio" value="Man" '.((isset($_GET['id']) AND $row_data["GENDAR"] == "Man") ? 'checked="checked"' : "").'>Man&nbsp;
						<input name="GENDAR" disabled type="radio" value="Woman" '.((isset($_GET['id']) AND $row_data["GENDAR"] == "Woman") ? 'checked="checked"' : "").'>Woman
						
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
						<input name="phone" readonly="" class="form-control" type="text" value="'.(isset($_GET['id']) ? $row_data["PHONE"] : "").'">
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Email Address</label>
					    </div>
					    <div class="col-xs-8">
						<input name="email" readonly="" class="form-control" type="text" value="'.(isset($_GET['id']) ? $row_data["EMAIL"] : "").'">
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Access to the password</label>
					    </div>
					    <div class="col-xs-8">
						<input readonly="" name="VIEWPASSWORD" class="form-control" type="text" value="'.(isset($_GET['id']) ? $row_data["VIEWPASSWORD"] : "").'">
					    </div>
                    </div>
					</div>
                          
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>User subscription type</label>
					    </div>
					    <div class="col-xs-4">
							<select class="form-control" name="ORDERTYPE" disabled>
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
						<input readonly="" name="address" class="form-control" type="text" value="'.(isset($_GET['id']) ? $row_data["ADDRESS"] : "").'">
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Location</label>
					    </div>
					    <div class="col-xs-8">
						<input readonly="" name="location" class="form-control" type="text" value="'.(isset($_GET['id']) ? $row_data["LOCATION"] : "").'">
					    </div>
                    </div>
					</div>
								
                                    </div><!-- /.box-body -->
				    
				   
                                </form>
                            </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Detail User';
    $submenu	= "stb_user";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_CSO."logout.php");
    }

?>