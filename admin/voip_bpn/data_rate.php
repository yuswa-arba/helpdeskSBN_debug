<?php
/*
 * Theme Name: Software Voip
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 8 oktober 2014
 * Email: dwi@globalxtreme.net
 */
include ("../../config/configuration_admin.php");
include ("../../config/configuration_voip_bpn.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List data rate");
    global $conn;
    global $conn_voip;
$plugins = '
<script type=\'text/javascript\'>
	function validepopupform(num_rate){
		    window.opener.document.myForm.data_rate.value=num_rate;
		    self.close();
        }
</script>';
?>


<?php
$content ='
<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box-header">
                                    <h2 class="box-title"></h2>
                                </div>

                                <div class="box-body table-responsive">
	
				<div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
							 			
				    <div class="box-header">
                                    <h3 class="box-title">List CDR Report</h3>
                                </div><!-- /.box-header -->
				<div class="box">
			    
				
		<table id="example2" class="table table-bordered table-hover">';
		$content .= '
                <thead>
                  <tr>
                  <th>ID</th> 	<th>DESTINATION</th> 	<th>PREFIX</th>		<th>BR</th>		<th>SR</th>		<th>ACTION</th>
                  </tr>
                </thead>
                <tbody>';

$sql_rate	= "SELECT `id`, `idtariffplan`, `dialprefix`, `buyrate`, `buyrateinitblock`, `buyrateincrement`, `rateinitial`, `initblock`, `billingblock`, `connectcharge`, `disconnectcharge`, `stepchargea`, `chargea`, `timechargea`, `billingblocka`, `stepchargeb`, `chargeb`, `timechargeb`, `billingblockb`, `stepchargec`, `chargec`, `timechargec`, `billingblockc`, `startdate`, `stopdate`, `starttime`, `endtime`, `id_trunk`, `musiconhold`, `id_outbound_cidgroup`, `rounding_calltime`, `rounding_threshold`, `additional_block_charge`, `additional_block_charge_time`, `tag`, `disconnectcharge_after`, `is_merged`, `additional_grace`, `minimal_cost`, `announce_time_correction`, `destination` FROM `cc_ratecard`";
$query_rate	= mysql_query($sql_rate, $conn_voip);
$no = 1;

    while ($row_rate = mysql_fetch_array($query_rate)) {
	$content .='<tr>
                    <td>'.$row_rate["id"].'</td>
                    <td>'.$row_rate["destination"].'</td>
                    <td>'.$row_rate["dialprefix"].'</td>
		    <td>'.$row_rate["buyrate"].'</td>
		    <td>'.$row_rate["rateinitial"].'</td>
		    <td>
                      <a href="" onclick="validepopupform(\''.$row_rate['id'].'\')">Select</a>
                    </td>
                  </tr>';
	$no++;
    }
		
                  $content .='
                  
                </tbody>
              </table>';

$content .= '
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->';

		
    $title	= 'input data rate';
    $submenu	= "Data Number rate";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
?>


<?php

	} else{
		header("location: index.php");
	}
} else{
    header("location: index.php");
}
?>