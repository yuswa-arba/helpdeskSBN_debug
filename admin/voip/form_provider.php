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
include ("../../config/configuration_voip_bali.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Provider");
    global $conn;
    global $conn_voip;
    
   $id_provider	= (isset($_GET["id"]) ? $_GET["id"] : "");
   
   if(isset($_POST["save"])){
	
	$provider_name	= isset($_POST["provider_name"]) ? trim(strip_tags($_POST["provider_name"])) : "";
	$description	= ($_POST["description"] != "") ? "'".$_POST["description"]."'" : "NULL";
       
	$sql		= "INSERT INTO `cc_provider` (`provider_name`, `creationdate`, `description`) VALUE ('$provider_name', NOW(), $description)";
	
	mysql_query($sql, $conn_voip) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diinput ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
	    </script>");
	//echo $sql;
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "Input Provider = $sql");
	echo "<script language='JavaScript'>
			    alert('Data telah disimpan!');
			    location.href = 'provider.php';
		</script>";
   }elseif(isset($_POST["edit"])){
	
	$provider_name	= isset($_POST["provider_name"]) ? trim(strip_tags($_POST["provider_name"])) : "";
	$description	= ($_POST["description"] != "") ? "'".$_POST["description"]."'" : "NULL";
       
        $sql		= "UPDATE `cc_provider` SET `provider_name` = '$provider_name', `description` = $description WHERE `id` = '$id_provider'";
	
	mysql_query($sql, $conn_voip) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
	    </script>");
	
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "Edit Provider = $sql");
	echo "<script language='JavaScript'>
			    alert('Data telah disimpan!');
			    location.href = 'provider.php';
		</script>";
       
   }
   
   $sql_provider      = mysql_query("SELECT * FROM `cc_provider` WHERE `id` = '$id_provider'", $conn_voip);
   $row_data_provider = mysql_fetch_array($sql_provider);
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
                                    <h3 class="box-title">Provider Form</h3>
                                </div><!-- /.box-header -->
				    
				    <form method="POST" action="" name="form_search">
				<table class="editform_table1" style="display: table;border-collapse: separate;border-spacing: 2px;border-color: gray;width: 65%;"  align="center" cellpadding="3">
					<tbody>
					
						<!-- compare with a value //-->
					<tr>
					    <td class="form_head" align="left">
						<font class="fontstyle_003">&nbsp;&nbsp;Provider Name</font>
					    </td>
					    <td class="bgcolor_003" align="left">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						    <tbody><tr>
							<td class="fontstyle_searchoptions"><input type="text" name="provider_name" value="'.(isset($_GET["id"]) ? $row_data_provider["provider_name"] : "").'" class="form-control"></td>
						    </tr></tbody>
						</table>
					    </td>
					</tr>
					<tr>
					    <td class="form_head" align="left">
						<font class="fontstyle_003">&nbsp;&nbsp;Description</font>
					    </td>
					    <td class="bgcolor_003" align="left">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						    <tbody><tr>
							<td class="fontstyle_searchoptions"><textarea class="form-control" name="description" cols="50" rows="5">'.(isset($_GET["id"]) ? $row_data_provider["description"] : "").'</textarea></td>
						    </tr></tbody>
						</table>
					    </td>
					</tr>
					
					<tr>
					    <td class="bgcolor_004" align="left"> </td>
					    <td class="bgcolor_005" align="center">
						<input class="form_input_button" name="'.(isset($_GET["id"]) ? "edit" : "save").'" value=" Confirm Data " type="submit">
					    </td>
					</tr>
				    </tbody>
				</table>
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
	    FONT-SIZE: 10px;
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

    $title	= 'Form Provider';
    $submenu	= "voip_provider";
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