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
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List Rates");
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
                                    <h3 class="box-title">Rates List</h3>
                                </div><!-- /.box-header -->

                                <div class="box-body table-responsive">
	
				
				
				    
				    <div align="right">
					<a href="" class="btn bg-navy btn-flat margin" >Add Rates</a>
				    </div>
				    
				    

                                    <table id="customer" class="table table-bordered table-striped" style="width: 100%;" align="center">
                                        <thead>
                                            <tr>					
												<th>#</th>
                                                <th>DESTINATION</th>
                                                <th>PREFIX</th>
                                                <th>BR</th>
												<th>SR</th>
                                                <th>START DATE</th>
                                                <th>STOP DATE</th>
                                                <th>INITB</th>
                                                <th>CC</th>
												<th>TRUNK</th>
                                                
												<th>STARTTIME</th>
                                                <th>ENDTIME</th>
												<th>LOCATION</th>
												<th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					
						
 					
$sql_data = mysql_query("SELECT * FROM `cc_ratecard`
						where `stopdate` LIKE '%2016%'
						ORDER BY `cc_ratecard`.`dialprefix` DESC;",$conn_voip);
$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `cc_ratecard`
						 where `stopdate` LIKE '%2016%';", $conn_voip));
$hal		= "?";

$no = $start + 1;
while ($row_data = mysql_fetch_array($sql_data)){
	
    $content1 .= '<tr>
		    <td>'.$no.'.</td>
			<td>'.$row_data["destination"].'</td>
		    <td>'.$row_data["dialprefix"].'</td>
		    <td>'.(int)$row_data["buyrate"].'</td>
		    <td>'.(int)$row_data["rateinitial"].'</td>
		    <td>'.$row_data["startdate"].'</td>
			<td>'.$row_data["stopdate"].'</td>
			<td>'.$row_data["buyrateinitblock"].'</td>
			<td>'.$row_data["chargec"].'</td>
			<td>'.$row_data["id_trunk"].'</td>
		    <td>'.$row_data["starttime"].'</td>
			<td>'.$row_data["endtime"].'</td>
            
		    <td>'.$row_data["tag"].'</td>
		    <td align="center"></td>
		</tr>';
	$no++;
	$content .= "UPDATE `cc_ratecard` SET `stopdate`='2030-03-19 12:28:03' WHERE (`id`='".$row_data["id"]."');
	<br>
	";
	mysql_query("UPDATE `cc_ratecard` SET `stopdate`='2030-03-19 12:28:03' WHERE (`id`='".$row_data["id"]."');", $conn_voip);
	
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
								<div class="box-footer">
									
									<br style="clear:both;">
								</div>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Rates List';
    $submenu	= "voip_rates";
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