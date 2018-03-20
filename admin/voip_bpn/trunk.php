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
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List Trunk");
    global $conn;
    global $conn_voip;
    
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
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
				
				<form method="POST" action="" name="form_search">
				<table class="editform_table1" style="display: table;border-collapse: separate;border-spacing: 2px;border-color: gray;width: 65%;"  align="center" cellpadding="3">
					<tbody>
					
						<!-- compare with a value //-->
					<tr>
					    <td class="form_head" align="left">
						<font class="fontstyle_003">&nbsp;&nbsp; IP/HOST</font>
					    </td>
					    <td class="bgcolor_003" align="left">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						    <tbody><tr>
							<td class="fontstyle_searchoptions"><input type="text" name="iphost" value="'.(isset($_GET["id"]) ? $row_data_provider["provider_name"] : "").'" class="form-control"></td>
						    </tr></tbody>
						</table>
					    </td>
					</tr>
					<tr>
					    <td class="form_head" align="left">
						<font class="fontstyle_003">&nbsp;&nbsp;</font>
					    </td>
					    <td class="bgcolor_003" align="left">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						    <tbody><tr>
							<td class="fontstyle_searchoptions">
							    <select name="id_provider" size="1" class="form_input_select">
								<option value="">SELECT PROVIDER</option>
								    ';
								    $sql_provider       = mysql_query("SELECT * FROM `cc_provider` ORDER BY `id` ASC", $conn_voip);
								    while($row_provider = mysql_fetch_array($sql_provider)){
									$content .='<option value="'.$row_provider["id"].'"> '.$row_provider["provider_name"].'</option>';
								    }
								    $content .='
								</select>
								<select name="status" size="1" class="form_input_select">
								    <option value="">SELECT STATUS</option>
								    <option class="input" value="0">Inactive</option>
								    <option class="input" value="1">Active</option>
								</select>
							</td>
						    </tr></tbody>
						</table>
					    </td>
					</tr>
					
					<tr>
					    <td class="bgcolor_004" align="left"> </td>
					    <td class="bgcolor_005" align="center">
						<input class="form_input_button" name="search" value=" Search " type="submit">
					    </td>
					</tr>
				    </tbody>
				</table>
				</form>
				    
				    <hr>
				    <div align="right">
					<a href="'.URL_ADMIN.'voip/form_trunk.php" class="btn bg-navy btn-flat margin" >Add Trunk</a>
				    </div>
				    
				    <div class="box-header">
                                    <h3 class="box-title">Trunk List</h3>
                                </div><!-- /.box-header -->

                                    <table id="customer" class="table table-bordered table-striped" style="width: 100%;" align="center">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>LABEL</th>
                                                <th>ADD_PREFIX</th>
                                                <th>REMOVE_PREFIX</th>
						<th>TECH</th>
                                                <th>IP/HOST</th>
                                                <th>PROVIDER</th>
                                                <th>MINUTES USED</th>
						<th>STATUS</th>
						<th>MAXUSE</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					
						
if(isset($_POST["search"])){
    $iphost		= isset($_POST["iphost"]) ? trim(strip_tags($_POST["iphost"])) : "";
    $id_provider	= isset($_POST["id_provider"]) ? trim(strip_tags($_POST["id_provider"])) : "";
    $status		= isset($_POST["status"]) ? trim(strip_tags($_POST["status"])) : "";
    
    $i_iphost		= ($iphost != '') ? "AND `providerip` LIKE '%$iphost%'" : "";
    $i_id_provider	= ($id_provider != '') ? "AND `id_provider` = '$id_provider'" : "";
    $i_status		= ($status != '') ? "AND `status` = '$status'" : "";
    
    $sql_trunk = mysql_query("SELECT * FROM `cc_trunk` WHERE `id_trunk` != '' $i_iphost $i_id_provider $i_status ORDER BY `id_trunk` ASC ;",$conn_voip);
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Search List Trunk = SELECT * FROM `cc_trunk` WHERE `id_trunk` != '' $i_iphost $i_id_provider $i_status ORDER BY `id_trunk` ASC ;");
}else{
    $sql_trunk = mysql_query("SELECT * FROM `cc_trunk` ORDER BY `id_trunk` ASC ;",$conn_voip);
}
    



$no = 1;
while ($row_trunk = mysql_fetch_array($sql_trunk)){
     $sql_provider = mysql_query("SELECT * FROM `cc_provider` WHERE `id` = '$row_trunk[id_provider]' ORDER BY `id` ASC ;",$conn_voip);
     $row_provider = mysql_fetch_array($sql_provider);
     
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_trunk["trunkcode"].'</td>
		    <td>'.$row_trunk["trunkprefix"].'</td>
		    <td>'.$row_trunk["removeprefix"].'</td>
		    <td>'.$row_trunk["providertech"].'</td>
		    <td>'.$row_trunk["providerip"].'</td>
		    <td>'.$row_provider["provider_name"].'</td>
		    <td>'.gmdate("H:i:s", $row_trunk["secondusedreal"]).'</td>
		    <td>'.(($row_trunk["status"]) ? "Active" : "Inactive").'</td>
		    <td>'.$row_trunk["maxuse"].'</td>
		    <td align="center"><span class="label label-info"><a href="form_trunk.php?id='.$row_trunk["id_trunk"].'" target="_blank">Edit</a></span></td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<style>
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

    $title	= 'Trunk List';
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