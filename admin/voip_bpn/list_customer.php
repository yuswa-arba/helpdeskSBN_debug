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
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List Customer Voip");
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
				<form method="POST" action="" name="form_search">
				<table class="searchhandler_table1" width="65%" align="center" cellpadding="3">
					<tbody><tr>
					    <td align="left" class="bgcolor_002">
						<font class="fontstyle_003">&nbsp;&nbsp;CREATION DATE</font>
					    </td>
					    <td align="left" class="bgcolor_003">
						<table border="0" cellspacing="0" cellpadding="0" width="100%">
						    <tbody><tr>
							<td class="fontstyle_searchoptions">
							    &nbsp;&nbsp;<input type="checkbox" name="fromday_create" value="true"> From :
							    <select name="fromstatsday_sday" class="form_input_select">
								';
								$date_from = 01;
									for($f=$date_from;$f<=31; $f++){
										if($f==$date_from){
											$content .='<option value="'.sprintf('%02d', $f).'" selected="">'.sprintf('%02d', $f).'</option>';
										}else{
											$content .= '<option value="'.sprintf('%02d', $f).'">'.sprintf('%02d', $f).'</option>';
										}
									}
								$content .='
							    </select>
							    <select name="fromstatsmonth_sday" class="form_input_select">
								';
								$fromstatsmonth_sday = date("Y-m");
								$year_actual = date("Y");
									for ($i=$year_actual;$i >= $year_actual-1;$i--) {		   
										$monthname = array( "JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST",
												   "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER");
										if ($year_actual==$i){
											$monthnumber = date("n")-1; // Month number without lead 0.
										}else{
											$monthnumber=11;
										}		   
										for ($j=$monthnumber;$j>=0;$j--){	
											$month_formated = sprintf("%02d",$j+1);
											if ($fromstatsmonth_sday=="$i-$month_formated"){$selected="selected";}else{$selected="";}
											$content.='<option value="'.$i.'-'.$month_formated.'" '.$selected.'>'.$monthname[$j].'-'.$i.'</option>';
										}
									}
								
								$content.=' 
							    </select>
							</td>
							<td class="fontstyle_searchoptions">
							    <input type="checkbox" name="today_create" value="true">To :
							    <select name="tostatsday_sday" class="form_input_select">
								';
								$date_to = 01;
									for($t=$date_to;$t<=31; $t++){
										if($t==$date_to){
											$content .='<option value="'.sprintf('%02d', $t).'" selected="">'.sprintf('%02d', $t).'</option>';
										}else{
											$content .= '<option value="'.sprintf('%02d', $t).'">'.sprintf('%02d', $t).'</option>';
										}
									}
								$content .='
							    </select>
							    <select name="tostatsmonth_sday" class="form_input_select">
								';
								$fromstatsmonth_sday = date("Y-m");
								$year_actual = date("Y");
									for ($i=$year_actual;$i >= $year_actual-1;$i--) {		   
										$monthname = array( "JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST",
												   "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER");
										if ($year_actual==$i){
											$monthnumber = date("n")-1; // Month number without lead 0.
										}else{
											$monthnumber=11;
										}		   
										for ($j=$monthnumber;$j>=0;$j--){	
											$month_formated = sprintf("%02d",$j+1);
											if ($fromstatsmonth_sday=="$i-$month_formated"){$selected="selected";}else{$selected="";}
											$content.='<option value="'.$i.'-'.$month_formated.'" '.$selected.'>'.$monthname[$j].'-'.$i.'</option>';
										}
									}
								
								$content.=' 
							    </select>
							</td>
						    </tr></tbody>
						</table>
					    </td>
					</tr>			
					<tr>
					    <td align="left" class="bgcolor_002">
						<font class="fontstyle_003">&nbsp;&nbsp;FIRST USE DATE</font>
					    </td>
					    <td align="left" class="bgcolor_003">
						<table border="0" cellspacing="0" cellpadding="0" width="100%">
						    <tbody><tr>
							<td class="fontstyle_searchoptions">
							    &nbsp;&nbsp;<input type="checkbox" name="fromday_fud" value="true"> From :
							    <select name="fromstatsday_sday_bis" class="form_input_select">
								<';
								$date_from = 01;
									for($f=$date_from;$f<=31; $f++){
										if($f==$date_from){
											$content .='<option value="'.sprintf('%02d', $f).'" selected="">'.sprintf('%02d', $f).'</option>';
										}else{
											$content .= '<option value="'.sprintf('%02d', $f).'">'.sprintf('%02d', $f).'</option>';
										}
									}
								$content .='
							    </select>
							    <select name="fromstatsmonth_sday_bis" class="form_input_select">
								';
								$fromstatsmonth_sday = date("Y-m");
								$year_actual = date("Y");
									for ($i=$year_actual;$i >= $year_actual-1;$i--) {		   
										$monthname = array( "JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST",
												   "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER");
										if ($year_actual==$i){
											$monthnumber = date("n")-1; // Month number without lead 0.
										}else{
											$monthnumber=11;
										}		   
										for ($j=$monthnumber;$j>=0;$j--){	
											$month_formated = sprintf("%02d",$j+1);
											if ($fromstatsmonth_sday=="$i-$month_formated"){$selected="selected";}else{$selected="";}
											$content.='<option value="'.$i.'-'.$month_formated.'" '.$selected.'>'.$monthname[$j].'-'.$i.'</option>';
										}
									}
								
								$content.=' 
							    </select>
							</td>
							<td class="fontstyle_searchoptions">
							    <input type="checkbox" name="today_fud" value="true">To :
							    <select name="tostatsday_sday_bis" class="form_input_select">
								';
								$date_to = 01;
									for($t=$date_to;$t<=31; $t++){
										if($t==$date_to){
											$content .='<option value="'.sprintf('%02d', $t).'" selected="">'.sprintf('%02d', $t).'</option>';
										}else{
											$content .= '<option value="'.sprintf('%02d', $t).'">'.sprintf('%02d', $t).'</option>';
										}
									}
								$content .='
							    </select>
							    <select name="tostatsmonth_sday_bis" class="form_input_select">
								';
								$fromstatsmonth_sday = date("Y-m");
								$year_actual = date("Y");
									for ($i=$year_actual;$i >= $year_actual-1;$i--) {		   
										$monthname = array( "JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST",
												   "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER");
										if ($year_actual==$i){
											$monthnumber = date("n")-1; // Month number without lead 0.
										}else{
											$monthnumber=11;
										}		   
										for ($j=$monthnumber;$j>=0;$j--){	
											$month_formated = sprintf("%02d",$j+1);
											if ($fromstatsmonth_sday=="$i-$month_formated"){$selected="selected";}else{$selected="";}
											$content.='<option value="'.$i.'-'.$month_formated.'" '.$selected.'>'.$monthname[$j].'-'.$i.'</option>';
										}
									}
								
								$content.=' 
							    </select>
							</td>
						    </tr></tbody>
						</table>
					    </td>
					</tr>
					
						<!-- compare with a value //-->
					<tr>
					    <td class="bgcolor_004" align="left">
						<font class="fontstyle_003">&nbsp;&nbsp;ACCOUNT NUMBER</font>
					    </td>
					    <td class="bgcolor_005" align="left">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						    <tbody><tr>
							<td class="fontstyle_searchoptions"><input type="text" name="username" value="" class="form-control"></td>
						    </tr></tbody>
						</table>
					    </td>
					</tr>
					<tr>
					    <td class="bgcolor_002" align="left">
						<font class="fontstyle_003">&nbsp;&nbsp;EMAIL</font>
					    </td>
					    <td class="bgcolor_003" align="left">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						    <tbody><tr>
							<td class="fontstyle_searchoptions"><input type="text" name="email" value="" class="form-control"></td>
						    </tr></tbody>
						</table>
					    </td>
					</tr>
					<tr>
					    <td class="bgcolor_004" align="left">
						<font class="fontstyle_003">&nbsp;&nbsp;LASTNAME</font>
					    </td>
					    <td class="bgcolor_005" align="left">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						    <tbody><tr>
							<td class="fontstyle_searchoptions"><input type="text" name="lastname" value="" class="form-control"></td>
						    </tr></tbody>
						</table>
					    </td>
					</tr>
					<tr>
					    <td class="bgcolor_002" align="left">
						<font class="fontstyle_003">&nbsp;&nbsp;LOGIN</font>
					    </td>
					    <td class="bgcolor_003" align="left">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						    <tbody><tr>
							<td class="fontstyle_searchoptions"><input type="text" name="useralias" value="" class="form-control"></td>
						    </tr></tbody>
						</table>
					    </td>
					</tr>
					<tr>
					    <td class="bgcolor_004" align="left">
						<font class="fontstyle_003">&nbsp;&nbsp;MACADDRESS</font>
					    </td>
					    <td class="bgcolor_005" align="left">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						    <tbody><tr>
							<td class="fontstyle_searchoptions"><input type="text" name="mac_addr" value="" class="form-control"></td>
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
				<div class="box-header">
                                    <h3 class="box-title">List Customer</h3>
				    <a href="form_cust" class="btn bg-olive btn-flat margin pull-right">Create Account</a>
                                </div><!-- /.box-header -->
                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th style="width: 110px">Account Number</th>
                                                <th style="width: 75px">Login</th>
                                                <th>Name</th>
                                                <th>Group</th>
                                                <th>BA</th>
						<th>Plan</th>
						<th>Status</th>
						
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					

if(isset($_POST["search"])){
    
    $fromstatsday_sday		= isset($_POST["fromstatsday_sday"]) ? trim(strip_tags($_POST["fromstatsday_sday"])) : "";
    $fromstatsmonth_sday	= isset($_POST["fromstatsmonth_sday"]) ? trim(strip_tags($_POST["fromstatsmonth_sday"])) : "";
    $tostatsday_sday		= isset($_POST["tostatsday_sday"]) ? trim(strip_tags($_POST["tostatsday_sday"])) : "";
    $tostatsmonth_sday		= isset($_POST["tostatsmonth_sday"]) ? trim(strip_tags($_POST["tostatsmonth_sday"])) : "";
    $fromstatsday_sday_bis	= isset($_POST["fromstatsday_sday_bis"]) ? trim(strip_tags($_POST["fromstatsday_sday_bis"])) : "";
    $fromstatsmonth_sday_bis	= isset($_POST["fromstatsmonth_sday_bis"]) ? trim(strip_tags($_POST["fromstatsmonth_sday_bis"])) : "";
    $tostatsday_sday_bis	= isset($_POST["tostatsday_sday_bis"]) ? trim(strip_tags($_POST["tostatsday_sday_bis"])) : "";
    $tostatsmonth_sday_bis	= isset($_POST["tostatsmonth_sday_bis"]) ? trim(strip_tags($_POST["tostatsmonth_sday_bis"])) : "";
    $username			= isset($_POST["username"]) ? trim(strip_tags($_POST["username"])) : "";
    $email			= isset($_POST["email"]) ? trim(strip_tags($_POST["email"])) : "";
    $lastname			= isset($_POST["lastname"]) ? trim(strip_tags($_POST["lastname"])) : "";
    $useralias			= isset($_POST["useralias"]) ? trim(strip_tags($_POST["useralias"])) : "";
    $mac_addr			= isset($_POST["mac_addr"]) ? trim(strip_tags($_POST["mac_addr"])) : "";
   
    if(isset($_POST["fromday_create"])){
	    $sql_fromday_create = "AND `creationdate` >= '$fromstatsmonth_sday-$fromstatsday_sday'";
	    $summary_fromday_create = $fromstatsmonth_sday.'-'.$fromstatsday_sday;
    }else{
	    $sql_fromday_create = "";
	    $summary_fromday_create = '';
    }
    
    if(isset($_POST["today_create"])){
	    $sql_today_create = "AND `creationdate` <= '$tostatsmonth_sday-$tostatsday_sday 24:00:00' ";
	    $summary_today = $tostatsmonth_sday.'-'.$tostatsday_sday;
    }else{
	    $sql_today_create = "";
	    $summary_today_create = '';
    }
    
    if(isset($_POST["fromday_fub"])){
	    $sql_fromday_fub = "AND `firstusedate` >= '$fromstatsmonth_sday_bis-$fromstatsday_sday_bis'";
	    $summary_fromday_fub = $fromstatsmonth_sday_bis.'-'.$fromstatsday_sday_bis;
    }else{
	    $sql_fromday_fub = "";
	    $summary_fromday_fub = '';
    }
    
    if(isset($_POST["today_fub"])){
	    $sql_today_fub = "AND `firstusedate` <= '$tostatsmonth_sday_bis-$tostatsday_sday_bis 24:00:00' ";
	    $summary_today_fub = $tostatsmonth_sday_bis.'-'.$tostatsday_sday_bis;
    }else{
	    $sql_today_fub = "";
	    $summary_today_fub = '';
    }
    
    $i_username		= ($username != '') ? "AND `username` LIKE '%$username%'" : "";
    $i_email		= ($email != '') ? "AND `email` LIKE '%$email%'" : "";
    $i_lastname		= ($lastname != '') ? "AND `lastname` LIKE '%$lastname%'" : "";
    $i_useralias	= ($useralias != '') ? "AND `useralias` LIKE '%$useralias%'" : "";
    $i_mac_addr		= ($mac_addr != '') ? "AND `mac_addr` LIKE '%$mac_addr%'" : "";
   
    
    $sql_masterCustomer = mysql_query("SELECT * FROM `cc_card`
				  WHERE `username` != ''
				  $sql_fromday_create
				  $sql_today_create
				  $sql_fromday_fub
				  $sql_today_fub
				  $i_username
				  $i_email
				  $i_lastname
				  $i_useralias
				  $i_mac_addr
				  ORDER BY `id` ASC ;",$conn_voip);
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Search Customer = SELECT * FROM `cc_card`
				  WHERE `username` != ''
				  $sql_fromday_create
				  $sql_today_create
				  $sql_fromday_fub
				  $sql_today_fub
				  $i_username
				  $i_email
				  $i_lastname
				  $i_useralias
				  $i_mac_addr
				  ORDER BY `id` ASC ;");
}else{
    $sql_masterCustomer = mysql_query("SELECT * FROM `cc_card` ORDER BY `id` ASC ;",$conn_voip);
}


$no = 1;
while ($row_masterCustomer = mysql_fetch_array($sql_masterCustomer))
{
    $sql_getgroup = mysql_query("SELECT * FROM `cc_card_group` WHERE `id` = '".$row_masterCustomer["id_group"]."';",$conn_voip);
    $row_getgroup = mysql_fetch_array($sql_getgroup);
    $sql_gettariffplan = mysql_query("SELECT * FROM `cc_tariffgroup` WHERE `id` = '".$row_masterCustomer["tariff"]."';",$conn_voip);
    $row_gettariffplan = mysql_fetch_array($sql_gettariffplan);
    $status	= '';
    $status 	.= ($row_masterCustomer["status"] == "0") ? "CANCEL" : "";
    $status	.= ($row_masterCustomer["status"] == "1") ? "ACTIVATED" : "";
    $status	.= ($row_masterCustomer["status"] == "2") ? "NEW" : "";
    $status	.= ($row_masterCustomer["status"] == "3") ? "WAITING" : "";
    $status	.= ($row_masterCustomer["status"] == "4") ? "RESERV" : "";
    $status	.= ($row_masterCustomer["status"] == "5") ? "EXPIRED" : "";
    $status	.= ($row_masterCustomer["status"] == "6") ? "SUS-PAY" : "";
    $status	.= ($row_masterCustomer["status"] == "7") ? "SUS-LIT" : "";
    $status	.= ($row_masterCustomer["status"] == "8") ? "WAIT-PAY" : "";
    //echo "SELECT * FROM `cc_card_group` WHERE `id` = '".$row_masterCustomer["id_group"]."'";
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_masterCustomer["username"].'</td>
		    <td>'.$row_masterCustomer["useralias"].'</td>
		    <td>'.$row_masterCustomer["firstname"].' '.$row_masterCustomer["lastname"].'</td>
		    <td>'.$row_getgroup["name"].'</td>
		    <td>'.number_format($row_masterCustomer["credit"], 2, ',', '.').' IDR</td>
		    <td>'.$row_gettariffplan["tariffgroupname"].'</td>
		    <td>'.$status.'</td>
		    
		    <td align="center"><a href="detail_cust?cust_numb='.$row_masterCustomer["username"].'"><span class="label label-info">Detail</span></a>
		    <a href="form_cust?form_action=edit-cust&cust_id='.$row_masterCustomer["username"].'"><span class="label label-info">Edit</span></a></td>
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

$plugins = '
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
	
    ';

    $title	= 'List Customer';
    $submenu	= "voip_customers";
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