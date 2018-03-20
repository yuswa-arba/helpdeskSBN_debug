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
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List Rate Cards");
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
                                    <h3 class="box-title">RateCards List</h3>
                                </div><!-- /.box-header -->

                                <div class="box-body table-responsive">
	
				
				
				    
				    <div align="right">
					<a href="'.URL_ADMIN.'voip/form_ratecards.php" class="btn bg-navy btn-flat margin" >Add RateCards</a>
				    </div>
				    
				    

                                    <table id="customer" class="table table-bordered table-striped" style="width: 100%;" align="center">
                                        <thead>
                                            <tr>					
						<th>#</th>
                                                <th>TARIFFNAME</th>
                                                <th>START DATE</th>
                                                <th>EXPIRY DATE</th>
						<th>TRUNK</th>
                                                <th>MINUTES USED</th>
                                                <th>DNID PREFIX</th>
                                                <th>CID PREFIX</th>
						<th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					
						
 					
$sql_tariffplan = mysql_query("SELECT * FROM `cc_tariffplan` LIMIT $start, $perhalaman;",$conn_voip);
$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `cc_tariffplan`;", $conn_voip));
$hal		= "?";

$no = $start + 1;
while ($row_tariffplan = mysql_fetch_array($sql_tariffplan)){
	$sql_trunk      = mysql_query("SELECT * FROM `cc_trunk` WHERE `id_trunk` = '".$row_tariffplan["id_trunk"]."' LIMIT 0,1;", $conn_voip);
	$row_trunk	= mysql_fetch_array($sql_trunk);

    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_tariffplan["tariffname"].'</td>
		    <td>'.$row_tariffplan["startingdate"].'</td>
		    <td>'.$row_tariffplan["expirationdate"].'</td>
		    <td>'.$row_trunk["trunkcode"].'</td>
		    <td>'.gmdate("H:i:s", $row_tariffplan["secondusedreal"]).'</td>
                    <td>'.$row_tariffplan["dnidprefix"].'</td>
		    <td>'.$row_tariffplan["calleridprefix"].'</td>
		    <td align="center"><a class="label label-info" href="form_ratecards.php?id='.$row_tariffplan["id"].'">Edit</a></td>
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

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Rate Card List';
    $submenu	= "voip_ratecard";
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