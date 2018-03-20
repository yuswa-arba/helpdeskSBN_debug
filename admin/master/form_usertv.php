<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include("../../config/configuration_admin.php");
include("../../config/configuration_tv.php");

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') {

        global $conn;

        $conn_ott = DB_TV();
        $custnumber = isset($_GET['custnumber']) ? strip_tags($_GET['custnumber']) : '';

        if (isset($_POST["save"])) {
            $custnumber = isset($_POST['custnumber']) ? mysql_real_escape_string(trim($_POST['custnumber'])) : '';
            $CLIENTID = isset($_POST['CLIENTID']) ? mysql_real_escape_string(trim($_POST['CLIENTID'])) : '';
            $username = isset($_POST['username']) ? mysql_real_escape_string(trim($_POST['username'])) : '';
            $loginname = isset($_POST['loginname']) ? mysql_real_escape_string(trim($_POST['loginname'])) : '';
            $password = isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : '';
            $SN_STB = isset($_POST['SN_STB']) ? mysql_real_escape_string(trim($_POST['SN_STB'])) : '';
            $MACADDRESS = isset($_POST['MACADDRESS']) ? mysql_real_escape_string(trim($_POST['MACADDRESS'])) : '';
            $USESTATE = isset($_POST['USESTATE']) ? mysql_real_escape_string(trim($_POST['USESTATE'])) : '1';
            $GENDAR = isset($_POST['GENDAR']) ? mysql_real_escape_string(trim($_POST['GENDAR'])) : '';
            $birthday = isset($_POST['birthday']) ? mysql_real_escape_string(trim($_POST['birthday'])) : '';
            $phone = isset($_POST['phone']) ? mysql_real_escape_string(trim($_POST['phone'])) : '';
            $email = isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : '';
            $VIEWPASSWORD = isset($_POST['VIEWPASSWORD']) ? mysql_real_escape_string(trim($_POST['VIEWPASSWORD'])) : '';
            $ORDERTYPE = isset($_POST['ORDERTYPE']) ? mysql_real_escape_string(trim($_POST['ORDERTYPE'])) : '';
            $address = isset($_POST['address']) ? mysql_real_escape_string(trim($_POST['address'])) : '';
            $location = isset($_POST['location']) ? mysql_real_escape_string(trim($_POST['location'])) : '';
            $next_id = isset($_POST['next_id']) ? mysql_real_escape_string(trim($_POST['next_id'])) : "";
            $role = "boss00001";

            $useridstb = $SN_STB . '' . $MACADDRESS;

            if ($username != "" || $MACADDRESS != "" || $SN_STB != "") {

                //sql insert data usertv
                $sql_insert_usertv = "INSERT INTO `gx_user_tv` (`id_user_tv`, `custnumber_user_tv`, `clientname_user_tv`, `clientcode_user_tv`, `status_user_tv`)
		                        VALUES (NULL, '" . $custnumber . "', '" . $username . "', '" . strtoupper($useridstb) . "', 'aktif');";
                mysql_query($sql_insert_usertv, $conn) or die (mysql_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert_usertv); // untuk membuat log

                //insert into gx_data
                $sql_insert_data = "INSERT INTO `boss`.`t_account_cms` (`CLIENTID`, `CLIENTNAME`, `CLIENTCODE`, `TOKEN`, `STATUS`, `STARTDATE`, `ENDDATE`,
                            `PASSWORD`, `STBID`, `ORDERTYPE`, `BALANCE`, `BIRTHDAY`, `GENDAR`, `STATE`, `ORDERS`, `RESULT`, `EMAIL`, `REGISTTIME`, `EXPENDAMOUNT`,
                            `PHONE`, `USESTATE`, `SBA`, `VIEWPASSWORD`, `LOCATION`, `UNIT`, `PHOTOPROFILE`, `ADDRESS`, `MACADDRESS`, `role`)
                            VALUES ('" . $CLIENTID . "', '" . $username . "', '" . strtoupper($useridstb) . "', '', '1', NOW(), '',
                            '670b14728ad9902aecba32e22fa4f6bd', '0', '1', '0', '" . $birthday . "', '" . $GENDAR . "', NULL, NULL, NULL, '" . $email . "', NULL, '0',
                            '" . $phone . "', '1', NULL, '" . $VIEWPASSWORD . "', '" . $location . "', NULL, '', '" . $address . "', '" . strtoupper($MACADDRESS) . "', '" . $role . "');";
                mysqli_query($conn_ott, $sql_insert_data) or die (mysqli_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert_data); // untuk membuat log

                $sql_update_primarykey = "UPDATE `boss`.`t_primarykeyinfo` SET  `NOWID`='" . $next_id . "' WHERE (`TABLENAME`='t_account_cms' AND `PREFIX`='USR');";
                mysqli_query($conn_ott, $sql_update_primarykey) or die (mysqli_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update_primarykey); // untuk membuat log

                echo "<script language='JavaScript'>
                        alert('Data telah disimpan');
                        self.close();
                      </script>";


            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }

        } elseif (isset($_POST["update"])) {
            $CLIENTID = isset($_POST['CLIENTID']) ? mysql_real_escape_string(trim($_POST['CLIENTID'])) : '';
            $custnumber = isset($_POST['custnumber']) ? mysql_real_escape_string(trim($_POST['custnumber'])) : '';
            $username = isset($_POST['username']) ? mysql_real_escape_string(trim($_POST['username'])) : '';
            $loginname = isset($_POST['loginname']) ? mysql_real_escape_string(trim($_POST['loginname'])) : '';
            $password = isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : '';
            $SN_STB = isset($_POST['SN_STB']) ? mysql_real_escape_string(trim($_POST['SN_STB'])) : '';
            $MACADDRESS = isset($_POST['MACADDRESS']) ? mysql_real_escape_string(trim($_POST['MACADDRESS'])) : '';
            $USESTATE = isset($_POST['USESTATE']) ? mysql_real_escape_string(trim($_POST['USESTATE'])) : '1';
            $GENDAR = isset($_POST['GENDAR']) ? mysql_real_escape_string(trim($_POST['GENDAR'])) : '';
            $birthday = isset($_POST['birthday']) ? mysql_real_escape_string(trim($_POST['birthday'])) : '';
            $phone = isset($_POST['phone']) ? mysql_real_escape_string(trim($_POST['phone'])) : '';
            $email = isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : '';
            $VIEWPASSWORD = isset($_POST['VIEWPASSWORD']) ? mysql_real_escape_string(trim($_POST['VIEWPASSWORD'])) : '';
            $ORDERTYPE = isset($_POST['ORDERTYPE']) ? mysql_real_escape_string(trim($_POST['ORDERTYPE'])) : '';
            $address = isset($_POST['address']) ? mysql_real_escape_string(trim($_POST['address'])) : '';
            $location = isset($_POST['location']) ? mysql_real_escape_string(trim($_POST['location'])) : '';
            //$role	      	= isset($_POST['role']) ? mysql_real_escape_string(trim($_POST['role'])) : '';
            $role = "boss00001";

            $useridstb = $SN_STB . '' . $MACADDRESS;

            // `CLIENTCODE`='".$useridstb."',
            if ($USESTATE == "0") {
                $status = "`STATUS`='0', `CLIENTCODE`='', `MACADDRESS`='',";
            } else {
                $status = "`MACADDRESS`='" . $MACADDRESS . "',";
            }

            if ($username != "" || $MACADDRESS != "" || $SN_STB != "" || $custnumber != "") {

                $sql_select_data = mysqli_query($conn_ott, "SELECT * FROM `boss`.`t_account_cms` WHERE `CLIENTID` = '" . $CLIENTID . "' LIMIT 0,1;");
                $row_select_data = mysqli_fetch_array($sql_select_data);

                //backup database to t_account_cms databse server
                $sql_backup_data = "INSERT INTO `software`.`t_account_cms` (`CLIENTID`, `CLIENTNAME`, `CLIENTCODE`, `TOKEN`, `STATUS`, `STARTDATE`, `ENDDATE`, `PASSWORD`,
                            `STBID`, `ORDERTYPE`, `BALANCE`, `BIRTHDAY`, `GENDAR`, `STATE`, `ORDERS`, `RESULT`, `EMAIL`, `REGISTTIME`, `EXPENDAMOUNT`, `PHONE`,
                            `USESTATE`, `SBA`, `VIEWPASSWORD`, `LOCATION`, `UNIT`, `PHOTOPROFILE`, `ADDRESS`, `MACADDRESS`, `role`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
                            VALUES ('" . $row_select_data["CLIENTID"] . "', '" . $row_select_data["CLIENTNAME"] . "', '" . $row_select_data["CLIENTCODE"] . "',
                            '" . $row_select_data["TOKEN"] . "', '" . $row_select_data["STATUS"] . "', '" . $row_select_data["STARTDATE"] . "',
                            '" . $row_select_data["ENDDATE"] . "', '" . $row_select_data["PASSWORD"] . "', '" . $row_select_data["STBID"] . "',
                            '" . $row_select_data["ORDERTYPE"] . "', '" . $row_select_data["BALANCE"] . "', '" . $row_select_data["BIRTHDAY"] . "',
                            '" . $row_select_data["GENDAR"] . "', '" . $row_select_data["STATE"] . "', '" . $row_select_data["ORDERS"] . "',
                            '" . $row_select_data["RESULT"] . "', '" . $row_select_data["EMAIL"] . "', '" . $row_select_data["REGISTTIME"] . "',
                            '" . $row_select_data["EXPENDAMOUNT"] . "', '" . $row_select_data["PHONE"] . "', '" . $row_select_data["USESTATE"] . "',
                            '" . $row_select_data["SBA"] . "', '" . $row_select_data["VIEWPASSWORD"] . "', '" . $row_select_data["LOCATION"] . "',
                            '" . $row_select_data["UNIT"] . "', '" . $row_select_data["PHOTOPROFILE"] . "', '" . $row_select_data["ADDRESS"] . "',
                            '" . $row_select_data["MACADDRESS"] . "', '" . $row_select_data["role"] . "',
                            NOW(),	NOW(), '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', '0');";
                mysql_query($sql_backup_data, $conn) or die (mysql_error());

                //insert into gx_data
                $sql_insert_data = "UPDATE `boss`.`t_account_cms` SET `CLIENTNAME`='" . $username . "',
                            `CLIENTCODE`='" . strtoupper($useridstb) . "', `MACADDRESS`='" . strtoupper($MACADDRESS) . "', 
                            `TOKEN`='', `STATUS`='1', `STARTDATE`='', `ENDDATE`='',
                            `PASSWORD`='670b14728ad9902aecba32e22fa4f6bd',
                            `BIRTHDAY`='" . $birthday . "', `GENDAR`='" . $GENDAR . "', 
                            `EMAIL`='" . $email . "', $status
                            `PHONE`='" . $phone . "', `USESTATE`='" . $USESTATE . "', `VIEWPASSWORD`='" . $VIEWPASSWORD . "',
                            `LOCATION`='" . $location . "', `ADDRESS`='" . $address . "', `role` = '" . $role . "'
                            WHERE (`CLIENTID`='" . $CLIENTID . "');";
                mysqli_query($conn_ott, $sql_insert_data) or die (mysqli_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert_data); // untuk membuat log

                echo "<script language='JavaScript'>
                        alert('Data telah disimpan');
                        self.close();
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }
        }

        if (isset($_GET["id"])) {
            $id_data = isset($_GET['id']) ? strip_tags($_GET['id']) : '';
            $query_data = "SELECT * FROM `boss`.`t_account_cms` WHERE `boss`.`t_account_cms`.`CLIENTID`='" . $id_data . "' LIMIT 0,1;";
            $sql_data = mysqli_query($conn_ott, $query_data);
            $row_data = mysqli_fetch_array($sql_data);

        }

        $sql_data_boss = mysqli_query($conn_ott, "SELECT * FROM `boss`.`t_primarykeyinfo` WHERE `TABLENAME` = 't_account_cms' AND `PREFIX` = 'USR' LIMIT 0,1;");
        $row_data_boss = mysqli_fetch_array($sql_data_boss);

        $NOWID = $row_data_boss["PREFIX"] . sprintf("%05d", $row_data_boss["NOWID"]);
        $next_id = $row_data_boss["NOWID"] + 1;

        $CLIENTNAME = mt_rand(11111111, 9999999999);

        $content = '
                <section class="content-header">
                    <h1>
                        STB User
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
					
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <!-- /.box-header -->
								<div class="box-header">
                                    <h3 class="box-title">Form STB User</h3>
                                </div>
                                <!-- form start -->
                                <form name="formuser" action="" role="form" method="post" enctype="multipart/form-data" autocomplete="off">
				                    <div class="box-body">
				                    	<div class="form-group" hidden>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>STB ID</label>
                                                </div>
                                                <div class="col-xs-8">
                                                    <input type="text" class="form-control" readonly="" disabled="" name="CLIENTID" value="' . (isset($_GET['id']) ? $row_data["CLIENTID"] : $NOWID) . '">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Username</label>
                                                </div>
                                                <div class="col-xs-8">
                                                    <input type="hidden"  name="CLIENTID" value="' . (isset($_GET['id']) ? $row_data["CLIENTID"] : $NOWID) . '">
                                                    <input type="hidden"  name="custnumber" value="' . $custnumber . '">
                                                    <input type="hidden"  name="next_id" value="' . $next_id . '">
                                                    <input name="CLIENTCODE" type="hidden" value="' . (isset($_GET['id']) ? $row_data["CLIENTCODE"] : "") . '">
                                                    <input name="username" type="hidden" class="form-control" required="" maxlength="30" value="' . (isset($_GET['id']) ? $row_data["CLIENTNAME"] : $CLIENTNAME) . '">
                                                    ' . (isset($_GET['id']) ? $row_data["CLIENTNAME"] : $CLIENTNAME) . '
                                                </div>
                                            </div>
                                        </div>
                                           
                                        <div class="form-group" hidden>
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
                                                <div class="col-xs-4">
                                                    <input name="SN_STB" id="SN_STB" type="text" required="" class="form-control" maxlength="20" value="' . (isset($_GET['id']) ? substr($row_data["CLIENTCODE"], 0, -12) : "") . '" onBlur="checkSN()">
                                                </div>
                                                <div class="col-xs-4">
                                                    <span id="user-availability-status-sn"></span> <img src="loader.gif" id="loaderIconSn" style="display:none" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Mac Address</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    <input name="MACADDRESS" id="MACADDRESS" class="form-control" required="" type="text" maxlength="12" value="' . (isset($_GET['id']) ? $row_data["MACADDRESS"] : "") . '" onBlur="checkMac()">
                                                </div>
                                                <div class="col-xs-4">
                                                    <span id="user-availability-status-mac"></span> <img src="loader.gif" id="loaderIconMac" style="display:none" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" hidden>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Using a State</label>
                                                </div>
                                                <div class="col-xs-8">
                                                    <input name="USESTATE" type="radio" value="0" disabled="" ' . ((isset($_GET['id']) AND $row_data["USESTATE"] == "0") ? 'checked="checked"' : "") . '>Disable&nbsp;
                                                    <input name="USESTATE" type="radio" value="1" disabled="" ' . ((isset($_GET['id']) AND $row_data["USESTATE"] == "1") ? 'checked="checked"' : 'checked="checked"') . '>Available
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" hidden>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Gender</label>
                                                </div>
                                                <div class="col-xs-8">
                                                    <input name="GENDAR" type="radio" value="Man" ' . ((isset($_GET['id']) AND $row_data["GENDAR"] == "Man") ? 'checked="checked"' : "") . '>Man&nbsp;
                                                    <input name="GENDAR" type="radio" value="Woman" ' . ((isset($_GET['id']) AND $row_data["GENDAR"] == "Woman") ? 'checked="checked"' : "") . '>Woman
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" hidden>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Date of Birth</label>
                                                </div>
                                                <div class="col-xs-8">
                                                    <input name="birthday" class="form-control hasDatepicker" id="datepicker" type="text" readonly="" value="' . (isset($_GET['id']) ? $row_data["BIRTHDAY"] : "") . '">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" hidden>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Phone</label>
                                                </div>
                                                <div class="col-xs-8">
                                                    <input name="phone" class="form-control" type="text" value="' . (isset($_GET['id']) ? $row_data["PHONE"] : "") . '">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" hidden>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Email Address</label>
                                                </div>
                                                <div class="col-xs-8">
                                                    <input name="email" class="form-control" type="text" value="' . (isset($_GET['id']) ? $row_data["EMAIL"] : "") . '">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" hidden>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Access to the password</label>
                                                </div>
                                                <div class="col-xs-8">
                                                    <input name="VIEWPASSWORD" class="form-control" type="text" value="' . (isset($_GET['id']) ? $row_data["VIEWPASSWORD"] : "123") . '">
                                                </div>
                                            </div>
                                        </div>
                          
                                        <!--<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                            <label>User subscription type</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <select class="form-control" name="ORDERTYPE">
                                                    <option ' . ((isset($_GET['id']) AND $row_data["ORDERTYPE"] == "1") ? 'selected="selected"' : "") . ' value="1">Pay per</option>
                                                    <option ' . ((isset($_GET['id']) AND $row_data["ORDERTYPE"] == "2") ? 'selected="selected"' : "") . ' value="2">Monthly charge</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        </div>-->
					
                                        <div class="form-group" hidden>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Address</label>
                                                </div>
                                                <div class="col-xs-8">
                                                    <input name="address" class="form-control" type="text" value="' . (isset($_GET['id']) ? $row_data["ADDRESS"] : "") . '">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" hidden>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Location</label>
                                                </div>
                                                <div class="col-xs-8">
                                                    <input name="location" class="form-control" type="text" value="' . (isset($_GET['id']) ? $row_data["LOCATION"] : "") . '">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!--<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                            <label>Role</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <select class="form-control" name="role">
                                                <option ' . ((isset($_GET['id']) AND $row_data["role"] == NULL) ? 'selected="selected"' : "") . ' value="">NULL</option>';

        $query_role = "SELECT * FROM `boss`.`t_stbrole`;";
        $sql_role = mysqli_query($conn_ott, $query_role);

        while ($row_role = mysqli_fetch_array($sql_role)) {

            $content .= '<option ' . ((isset($_GET['id']) AND $row_data["role"] == "1") ? 'selected="selected"' : "") . ' value="' . $row_role["id"] . '">' . $row_role["rolename"] . '</option>';

        }

        $content .= '				            
				                                </select>
                                            </div>
                                        </div>
                                    </div>-->
								
                                </div><!-- /.box-body -->
				    
                            <div class="box-footer">
                                <button type="submit" value="Submit" ' . (isset($_GET['id']) ? 'name="update"' : 'name="save"') . ' class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div>
			
            </div>

        </section><!-- /.content -->';

        $plugins = '
                <!-- datepicker -->
                <script src="' . URL . 'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
                <script>
                    $(function() {
                        $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                    });
                    
                    function checkSN() {
                        $("#loaderIconSN").show();
                        jQuery.ajax({
                            url: "cek_sn.php",
                            data:\'SN_STB=\'+$("#SN_STB").val(),
                            type: "GET",
                            success:function(data){
                                $("#user-availability-status-sn").html(data);
                                $("#loaderIconSn").hide();
                            },
                            error:function (){}
                        });
                    }
        
                    function checkMac() {
                        $("#loaderIconMac").show();
                        jQuery.ajax({
                            url: "cek_sn.php",
                            data:\'MACADDRESS=\'+$("#MACADDRESS").val(),
                            type: "GET",
                            success:function(data){
                                $("#user-availability-status-mac").html(data);
                                $("#loaderIconMac").hide();
                            },
                            error:function (){}
                        });
                   }
                </script>';

        $title = 'Form User';
        $submenu = "stb_user";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group);

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>