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
include ("../../config/configuration_voip_bpn.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    $id_trunk	= (isset($_GET["id"]) ? $_GET["id"] : "");
    $act	= (isset($_GET["id"]) ? "Open Form Edit Trunk with id = $id_trunk" : "Open Form Trunk");
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], $act);
    global $conn;
    global $conn_voip;
    
   
   
   if(isset($_POST["confirm_save"])){
	$id_provider	= isset($_POST["id_provider"]) ? trim(strip_tags($_POST["id_provider"])) : "";
	$trunkcode	= isset($_POST["trunkcode"]) ? trim(strip_tags($_POST["trunkcode"])) : "";
	$trunkprefix	= ($_POST["trunkprefix"] != "") ? "'".trim(strip_tags($_POST["trunkprefix"]))."'" : "NULL";
	$removeprefix	= ($_POST["removeprefix"] != "") ? "'".trim(strip_tags($_POST["removeprefix"]))."'" : "NULL";
	$providertech	= isset($_POST["providertech"]) ? trim(strip_tags($_POST["providertech"])) : "";
	$providerip	= isset($_POST["providerip"]) ? trim(strip_tags($_POST["providerip"])) : "";
	$addparameter	= ($_POST["addparameter"] != "") ? "'".trim(strip_tags($_POST["addparameter"]))."'" : "NULL";
	$failover_trunk	= isset($_POST["failover_trunk"]) ? trim(strip_tags($_POST["failover_trunk"])) : "";
	$inuse		= isset($_POST["inuse"]) ? trim(strip_tags($_POST["inuse"])) : "";
	$maxuse		= isset($_POST["maxuse"]) ? trim(strip_tags($_POST["maxuse"])) : "";
	$if_max_use	= isset($_POST["if_max_use"]) ? trim(strip_tags($_POST["if_max_use"])) : "";
	$status		= isset($_POST["status"]) ? trim(strip_tags($_POST["status"])) : "";
        
	if($providertech == "" || $providerip == ""){
	    echo "<script language='JavaScript'>
			alert('Maaf Data tidak bisa diinput ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
	    </script>";
	}else{
	    $sql	= "INSERT INTO `cc_trunk` (`id_trunk`, `trunkcode`, `trunkprefix`, `providertech`, `providerip`, `removeprefix`,
						    `secondusedreal`, `secondusedcarrier`, `secondusedratecard`, `creationdate`, `failover_trunk`,
						    `addparameter`, `id_provider`, `inuse`, `maxuse`, `status`, `if_max_use`)
						    VALUE ('', '$trunkcode', $trunkprefix, '$providertech', '$providerip', $removeprefix,
						    '0', '0', '0', NOW(), '$failover_trunk',
						    $addparameter, '$id_provider', '$inuse','$maxuse', '$status', '$if_max_use')";
												
	mysql_query($sql, $conn_voip) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diinput ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
	    </script>");
	//echo $sql;
	enableLog("", $loggedin["username"], $loggedin["id_employee"],"Input Trunk = $sql");
	echo "<script language='JavaScript'>
			    alert('Data telah disimpan!');
			    location.href = 'trunk.php';
		</script>";
	}
	
   }elseif(isset($_POST["confirm_edit"])){
	$id_provider	= isset($_POST["id_provider"]) ? trim(strip_tags($_POST["id_provider"])) : "";
	$trunkcode	= isset($_POST["trunkcode"]) ? trim(strip_tags($_POST["trunkcode"])) : "";
	$trunkprefix	= ($_POST["trunkprefix"] != "") ? "'".trim(strip_tags($_POST["trunkprefix"]))."'" : "NULL";
	$removeprefix	= ($_POST["removeprefix"] != "") ? "'".trim(strip_tags($_POST["removeprefix"]))."'" : "NULL";
	$providertech	= isset($_POST["providertech"]) ? trim(strip_tags($_POST["providertech"])) : "";
	$providerip	= isset($_POST["providerip"]) ? trim(strip_tags($_POST["providerip"])) : "";
	$addparameter	= ($_POST["addparameter"] != "") ? "'".trim(strip_tags($_POST["addparameter"]))."'" : "NULL";
	$failover_trunk	= isset($_POST["failover_trunk"]) ? trim(strip_tags($_POST["failover_trunk"])) : "";
	$inuse		= isset($_POST["inuse"]) ? trim(strip_tags($_POST["inuse"])) : "";
	$maxuse		= isset($_POST["maxuse"]) ? trim(strip_tags($_POST["maxuse"])) : "";
	$if_max_use	= isset($_POST["if_max_use"]) ? trim(strip_tags($_POST["if_max_use"])) : "";
	$status		= isset($_POST["status"]) ? trim(strip_tags($_POST["status"])) : "";
        
       if($providertech == "" || $providerip == ""){
	    echo "<script language='JavaScript'>
			alert('Maaf Data tidak bisa diinput ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
	    </script>";
	}else{
	
	    $sql	= "UPDATE `cc_trunk` SET `id_provider` = '$id_provider', `trunkcode` = '$trunkcode',`trunkprefix` = $trunkprefix, `removeprefix` = $removeprefix,
			   `providertech` = '$providertech', `providerip` = '$providerip',`addparameter` = $addparameter, `failover_trunk` = '$failover_trunk',
			   `inuse` = '$inuse', `maxuse` = '$maxuse',`if_max_use` = '$if_max_use', `status` = '$status'
			   WHERE `id_trunk` = '$id_trunk'";
	    //echo $sql;
	    mysql_query($sql, $conn_voip) or die("<script language='JavaScript'>
			    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			    window.history.go(-1);
		</script>");
	    
	    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Edit Trunk = $sql");
	    echo "<script language='JavaScript'>
				alert('Data telah disimpan!');
				location.href = 'trunk.php';
		    </script>";
	}
   }
   
   $sql_trunk     = mysql_query("SELECT * FROM `cc_trunk` WHERE `id_trunk` = '$id_trunk'", $conn_voip);
   $row_trunk	  = mysql_fetch_array($sql_trunk);
   //echo "SELECT * FROM `cc_provider` WHERE `id` = '$id_provider'";
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title"></h2>
                                </div>

                                <div class="box-body table-responsive">
	
				<div class="box-header">
                                    <h3 class="box-title">Trunk Form</h3>
                                </div><!-- /.box-header -->
				    
				<form action="" id="trunk_form" method="post" name="trunk_form">
				    <table cellspacing="2" class="addform_table1" style="display: table;border-collapse: separate;border-spacing: 2px;border-color: gray;">
					<tbody>
					    <tr>
						<td width="15%" valign="middle" class="form_head">VOIP-PROVIDER</td>  
						<td width="85%" valign="top" class="tableBodyRight">
						    <select name="id_provider" class="form_input_select">
							<option value="-1" selected="">NOT DEFINED</option>
							';
							$sql_provider       = mysql_query("SELECT * FROM `cc_provider` ORDER BY `id` ASC", $conn_voip);
							while($row_provider = mysql_fetch_array($sql_provider)){
							    $content .='<option value="'.$row_provider["id"].'" '.((isset($_GET["id"] )&& ($row_provider["id"] == $row_trunk["id_provider"])) ? 'selected=""' : "").'> '.$row_provider["provider_name"].'</option>';
							}
							$content .='
						    </select>
						    <span class="liens">
						    </span> 
						</td>
					    </tr>
					    <tr>
						<td width="%25" valign="middle" class="form_head">LABEL</td>  
						<td width="%75" valign="top" class="tableBodyRight">
						    <input class="form_input_text" name="trunkcode" size="45" maxlength="40" value="'.(isset($_GET["id"]) ? $row_trunk["trunkcode"] : "").'">
						    <span class="liens">
							     </span> 
						    <br>Unique and friendly name for the trunk
						</td>
					    </tr>
					    <tr>
						<td width="%25" valign="middle" class="form_head">ADD PREFIX</td>  
						<td width="%75" valign="top" class="tableBodyRight">
						    <input class="form_input_text" name="trunkprefix" size="30" maxlength="20" value="'.(isset($_GET["id"]) ? $row_trunk["trunkprefix"] : "").'">
						    <span class="liens">
							     </span> 
						    <br>Add a prefix to the dialled digits.
						</td>
					    </tr>
					    <tr>
						<td width="%25" valign="middle" class="form_head">REMOVE PREFIX</td>  
						<td width="%75" valign="top" class="tableBodyRight">
						    <input class="form_input_text" name="removeprefix" size="30" maxlength="20" value="'.(isset($_GET["id"]) ? $row_trunk["removeprefix"] : "").'">
						    <span class="liens">
							     </span> 
						    <br>Remove prefix from the dialed digits.
						</td>
					    </tr>
					    <tr>
						<td width="%25" valign="middle" class="form_head">PROVIDER TECH *</td>  
						<td width="%75" valign="top" class="tableBodyRight">
						    <input class="form_input_text" name="providertech" size="20" maxlength="15" value="'.(isset($_GET["id"]) ? $row_trunk["providertech"] : "").'">
						    <span class="liens">
							     </span> 
						    <br>Technology used on the trunk (SIP,IAX2,ZAP,H323)
						</td>
					    </tr>
					    <tr>
						<td width="%25" valign="middle" class="form_head">PROVIDER IP *</td>  
						<td width="%75" valign="top" class="tableBodyRight">
						    <input class="form_input_text" name="providerip" size="80" maxlength="140" value="'.(isset($_GET["id"]) ? $row_trunk["providerip"] : "").'">
						    <span class="liens">
							     </span> 
						    <br>Set the IP or URL of the VoIP provider. Alternatively, put in the name of a previously defined trunk in Asterisk or FreePBX. (MyVoiPTrunk, ZAP4G etc.) You can use the following tags to as variables: %dialingnumber%, %cardnumber%. ie g2/1644787890wwwwwwwwww%dialingnumber%
						</td>
					    </tr>
					    <tr>
						<td width="%25" valign="middle" class="form_head">ADDITIONAL PARAMETER</td>  
						<td width="%75" valign="top" class="tableBodyRight">
						    <input class="form_input_text" name="addparameter" size="60" maxlength="100" value="'.(isset($_GET["id"]) ? $row_trunk["addparameter"] : "").'">
						    <span class="liens">
							     </span> 
						    <br>Define any additional parameters that will be used when running the Dial Command in Asterisk. Use the following tags as variables  %dialingnumber%, %cardnumber%. ie \'D(ww%cardnumber%wwwwwwwwww%dialingnumber%)\'
						</td>
					    </tr>
					    <tr>
						<td width="%25" valign="middle" class="form_head">FAILOVER TRUNK</td>  
						<td width="%75" valign="top" class="tableBodyRight">
						    <select name="failover_trunk" class="form_input_select">
							<option value="-1" selected="">NOT DEFINED</option>
							';
							$sql_select_trunk       = mysql_query("SELECT * FROM `cc_trunk` ORDER BY `id_trunk` ASC", $conn_voip);
							while($row_select_trunk = mysql_fetch_array($sql_select_trunk)){
							    $content .='<option value="'.$row_select_trunk["id_trunk"].'" '.((isset($_GET["id"] )&& ($row_select_trunk["id_trunk"] == $row_trunk["id_provider"])) ? 'selected=""' : "").'> '.$row_select_trunk["trunkcode"].'</option>';
							}
							$content .='
						    </select>
						    <span class="liens">
							     </span> 
						    <br>You can define another trunk in case of failover!
						</td>
					    </tr>
					    <tr>
						<td width="%25" valign="middle" class="form_head">CURRENT CONNECTIONS</td>  
						<td width="%75" valign="top" class="tableBodyRight">
						    <input class="form_input_text" name="inuse" size="30" value="'.(isset($_GET["id"]) ? $row_trunk["inuse"] : "0").'" maxlength="30">
						    <span class="liens">
							     </span> 
						    <br>Updated to show the number of channels currently in use on this trunk.If there are no channels in use, and the system shows that there are, manually reset this field back to zero.
						</td>
					    </tr>
					    <tr>
						<td width="%25" valign="middle" class="form_head">MAXIMUM CONNECTIONS</td>  
						<td width="%75" valign="top" class="tableBodyRight">
						    <input class="form_input_text" name="maxuse" size="30" value="'.(isset($_GET["id"]) ? $row_trunk["maxuse"] : "-1").'" maxlength="30">
						    <span class="liens">
							     </span> 
						    <br>The maximum number of channels available to this trunk. Set to -1 to have an unlimited number of channels
						</td>
					    </tr>
					    <tr>
						<td width="%25" valign="middle" class="form_head">IFMAXUSED</td>  
						<td width="%75" valign="top" class="tableBodyRight">
						    <select name="if_max_use" class="form_input_select">
							<option value="0" '.((isset($_GET["id"] )&& ($row_trunk["if_max_use"] == "0")) ? 'selected=""' : "").'> Use failover trunk</option>
							<option value="1" '.((isset($_GET["id"] )&& ($row_trunk["if_max_use"] == "1")) ? 'selected=""' : "").'> Use next trunk</option>
						    </select>
						    <span class="liens">
							     </span> 
						    <br>Specifies which trunk to use when the maximum number of connections is reached
						</td>
					    </tr>
					    <tr>
						<td width="%25" valign="middle" class="form_head">STATUS</td>  
						<td width="%75" valign="top" class="tableBodyRight">
						    <select name="status" class="form_input_select">
							<option value="1" '.((isset($_GET["id"] )&& ($row_trunk["status"] == "1")) ? 'selected=""' : "").'> Active</option>
							<option value="0" '.((isset($_GET["id"] )&& ($row_trunk["status"] == "0")) ? 'selected=""' : "").'> Inactive</option>
						    </select>
						    <span class="liens">
							     </span> 
						    <br>Define if this trunk is active or not
						</td>
					    </tr>
								    
					    
				    </tbody>
				  </table>
				  <br />
				      <table width="100%" cellspacing="0" class="editform_table8">
					    <tbody><tr>
						    
						    <td align="right" valign="top" class="text">
							   <input class="btn btn-primary" name="'.(isset($_GET["id"]) ? "confirm_edit" : "confirm_save").'" value="Confirm Data" type="submit">
						    </td>
					    </tr>
				      </tbody></table>
				    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
<style>
	    .editform_table1 {
	    border-right: 0px;
	    padding-right: 3px;
	    border-top: 0px;
	    padding-left: 3px;
	    padding-bottom: 3px;
	    border-left: 0px;
	    width: 95%;
	    padding-top: 3px;
	    border-bottom: 0px;
	    background-color: #eaeaea;
	    margin-left: auto;
	    margin-right: auto;
	    }
	    .form_head {
	    font-family: Arial, Helvetica, sans-serif;
	    font-size: 11px;
	    font-weight: bold;
	    text-transform: uppercase;
	    color: #FFFFFF;
	    background-color: #666666;
	    width: auto;
	    }
	    .tableBodyRight {
	    PADDING-BOTTOM: 4px;
	    PADDING-LEFT: 4px;
	    PADDING-RIGHT: 4px;
	    PADDING-TOP: 4px;
	    FONT-SIZE: 11px;
	    background-color: #F5F5F5;
	    }
	    th {
text-align: -webkit-center;
}
	    </style>
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#customer\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>
	
    ';

    $title	= 'Form Trunk';
    $submenu	= "voip_trunk";
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