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
	
enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Audit");
global $conn;
global $conn_voip;

	$perhalaman = 20;
	if (isset($_GET['page'])){
		$page = (int)$_GET['page'];
		$start=($page - 1) * $perhalaman;
	}else{
		$start=0;
	}
            
    $content ='<!-- Main content -->
                <section class="content">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h4 class="box-title">Search</h4>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <form role="form" method="POST" action="">
										<input type="hidden" name="n" maxlength="10" value="'.(isset($_GET['n']) ? mysql_real_escape_string(strip_tags(trim($_GET['n']))) : '').'">
                                        <div class="box-body">
                                            <h5>Filter By Date</h5>
                                            <div class="row">
                                                
                                                <div class="col-xs-9">
                                                    <p>Date: <input type="text" readonly="" name="tanggal" id="datepicker" class="hasDatepicker"></p>
                                                </div>
                                                
                                            </div>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="submit" name="search" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h3 class="box-title">List Report</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                
                                                <th>Source</th>
                                                <th>Destination</th>
                                                <th>Duration</th>
                                                <th>Type</th>
                                                <th>Price</th>
                                    </tr>
                                        </thead>
                                        <tbody>';
										
if(isset($_POST["search"]))
{
    $tanggal	= isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
	$n	= isset($_POST['n']) ? mysql_real_escape_string(strip_tags(trim($_POST['n']))) : '';
    $sql_cdr    = mysql_query("SELECT * FROM `asteriskcdrdb`.`cdr`
							  WHERE `userfield` != ''
							  AND `calldate` LIKE '%".$tanggal."%'
							  AND (`src` LIKE '".$n."%' OR `dst` LIKE '".$n."%')
							  ORDER BY `calldate` DESC LIMIT $start, $perhalaman;", $conn_voip);
	$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `asteriskcdrdb`.`cdr`
												 WHERE `userfield` != '' AND `calldate` LIKE '%".$tanggal."%'
												 AND (`src` LIKE '".$n."%' OR `dst` LIKE '".$n."%')
												 ORDER BY `calldate` DESC;", $conn_voip));
    $hal		= "?n=$n&";
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Search cdr history = SELECT * FROM `cdr` WHERE `userfield` != '' AND `calldate` LIKE '%".$tanggal."%' ORDER BY `calldate` DESC;");
}
else
{
	/*$n	= isset($_GET['n']) ? mysql_real_escape_string(strip_tags(trim($_GET['n']))) : '';
    $sql_cdr    = mysql_query("SELECT * FROM `asteriskcdrdb`.`cdr` WHERE `userfield` != ''
							  AND (`src` LIKE '".$n."%' OR `dst` LIKE '".$n."%')
							  ORDER BY `calldate` DESC LIMIT $start, $perhalaman;", $conn_voip);
	*/$n	= isset($_GET['n']) ? mysql_real_escape_string(strip_tags(trim($_GET['n']))) : '';
    $sql_cdr    = mysql_query("SELECT * FROM `asteriskcdrdb`.`cdr` WHERE `userfield` != ''
							  AND (`src` LIKE '".$n."%' OR `dst` LIKE '".$n."%')
							  ORDER BY `calldate` DESC LIMIT $start, $perhalaman;", $conn_voip);
	$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `asteriskcdrdb`.`cdr`
												 WHERE `userfield` != ''
												 AND (`src` LIKE '".$n."%' OR `dst` LIKE '".$n."%')
												 ORDER BY `calldate` DESC;", $conn_voip));
    $hal		= "?n=$n&";
    //echo "SELECT * FROM $asteriskcdrdb$.$cdr$ WHERE $userfield$ != ''  ORDER BY $calldate$ DESC LIMIT $start, $perhalaman;";
    //AND $calldate$ LIKE '%".date("Y-m-d")."%'
	/*echo "SELECT * FROM `asteriskcdrdb`.`cdr` WHERE `userfield` != ''
							  AND (`src` LIKE '".$n."%' OR `dst` LIKE '".$n."%')
							  AND `dst` LIKE '(SELECT `dialprefix` FROM `mya2billing`.`cc_ratecard`)%'
							  ORDER BY `calldate` DESC";*/
}
$sql_prefix = mysql_query("SELECT `dialprefix`
						FROM `cc_ratecard`;",$conn_voip);
	
$prefix = array();

while(($row_prefix = mysql_fetch_array($sql_prefix))) {
    $prefix[] = preffixVoip($row_prefix['dialprefix']);
}
//print_r($prefix);
$no = $start + 1;
while ($row_cdr = mysql_fetch_array($sql_cdr))
{
    $time = toSeconds(date("H", strtotime($row_cdr["calldate"])) , date("i", strtotime($row_cdr["calldate"])), date("N", strtotime($row_cdr["calldate"])));
    $sql_prefix = mysql_query("SELECT `rateinitial`, `buyrateinitblock` FROM `cc_ratecard`
							  WHERE `dialprefix` LIKE '_".substr($row_cdr["dst"], 0, 4)."%'
							  AND '".$time."' BETWEEN `starttime` AND `endtime`;",$conn_voip);
	
	
	$row_prefix = mysql_fetch_array($sql_prefix);
    
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_cdr["calldate"].'</td>
		    <td>'.$row_cdr["src"].'</td>
		    <td>'.$row_cdr["dst"].'</td>
            <td>'.detiktoTime($row_cdr["duration"]).'</td>
            <td>'.((strpos($row_cdr["dstchannel"],'DAHDI') !== false) ? "Outgoing" : "Group").'</td>
		    <td>'.((int)(ceil($row_cdr["duration"]/$row_prefix["buyrateinitblock"]) * $row_prefix["rateinitial"])).'</td>
		    
		</tr>';
                //'.(($row_cdr["userfield"] != "") ? '<a href="https://172.16.182.182/dwi/download.php?download=file&file='.base64_encode($wav[1]).'">Listen</a>' : "").'
                //onclick="return valideopenerform(\'https://172.16.182.182/dwi/download.php?download=file&file='.base64_encode($wav[1]).'\',\'recr'.$row_cdr["src"].'\');"
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

$plugins = '
	<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
		<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';


    $title	= 'CDR Asterix + Billing';
    $submenu	= "voip_cdr";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group,"red");
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>