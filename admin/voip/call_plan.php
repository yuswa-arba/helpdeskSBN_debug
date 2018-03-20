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
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List Callplan");
    global $conn;
    global $conn_voip;
    
	$perhalaman = 20;
	if (isset($_GET['page'])){
		$page = (int)$_GET['page'];
		$start=($page - 1) * $perhalaman;
	}else{
		$start=0;
	}
	
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Call Plan List</h2>
                                </div>

                                <div class="box-body table-responsive">
	
			
				    <div align="right">
					<a href="'.URL_ADMIN.'voip/form_call_plan.php" class="btn bg-navy btn-flat margin" >Add CallPlan</a>
				    </div>

                                    <table id="customer" class="table table-bordered table-striped" style="width: 100%;" align="center">
                                        <thead>
                                            <tr>					
						<th>#</th>
                                                <th>NAME</th>
                                                <th>CREATIONDATE</th>
                                                <th>LC TYPE</th>
						<th>PACKAGE</th>
                                                <th>INTER PREFIX</th>
						<th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					
						

    $sql_call_plan = mysql_query("SELECT * FROM `cc_tariffgroup` LIMIT $start, $perhalaman;",$conn_voip);
	$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `cc_tariffgroup`;", $conn_voip));
	$hal		= "?";

    



$no = $start + 1;
while ($row_call_plan = mysql_fetch_array($sql_call_plan)){
$sql_package_offer      = mysql_query("SELECT * FROM `cc_package_offer`", $conn_voip);
$row_package_offer	= mysql_fetch_array($sql_package_offer);

$package_offer		= "";
$package_offer		.= (($row_package_offer["id"] == $row_call_plan["id_cc_package_offer"]) ? $row_package_offer["label"] : "");
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_call_plan["tariffgroupname"].'</td>
		    <td>'.$row_call_plan["creationdate"].'</td>
		    <td>'.(($row_call_plan["lcrtype"] == "0") ? "LCR : buyer price" : "LCD : seller price").'</td>
		    <td>'.$package_offer.'</td>
		    <td>'.(($row_call_plan["removeinterprefix"] == "0") ? "Keep prefix" : "Remove prefix").'</td>
		    <td align="center"><a class="label label-info" href="form_call_plan.php?id='.$row_call_plan["id"].'">Edit</a></td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
								<div class="box-footer">
									<div class="box-tools pull-right">
									'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
									</div>
									<br style="clear:both;">
								</div>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Call Plan List';
    $submenu	= "voip_callplan";
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