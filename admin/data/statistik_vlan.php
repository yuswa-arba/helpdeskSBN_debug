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

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;
    
	//paging
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
	
	$id_esx = isset($_GET['id_esx']) ? (int)$_GET['id_esx'] : "";
	$hal = isset($_GET['id_esx']) ? '?id_esx='.$id_esx.'&' : "?";
	
    enableLog("",$loggedin["username"], $loggedin["id_employee"],"Open Menu List VLAN");
	
	$total_server_ras_all 		= mysql_num_rows(mysql_query("SELECT * FROM `v_esx_vlan` WHERE `level` = '0' ORDER BY `vlan` ASC, `id_esx` ASC;", $conn));
	$total_server_ras_aktif 	= mysql_num_rows(mysql_query("SELECT * FROM `v_esx_vlan` WHERE `level` = '0' AND `userid_vlan` != ''  AND `flag_vlan` = 'aktif' ORDER BY `vlan` ASC, `id_esx` ASC;", $conn));
	$total_server_ras_nonaktif	= mysql_num_rows(mysql_query("SELECT * FROM `v_esx_vlan` WHERE `level` = '0' AND (`userid_vlan` = '' OR `userid_vlan` IS NULL) ORDER BY `vlan` ASC, `id_esx` ASC;", $conn));

    
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">List VLAN</h3>
                                    
                                </div>
                                <div class="box-body">
                                    <form action="" method="post" name="form_search">
									 <div class="row">
									<div class="col-lg-6 col-sm-12 col-xs-12">
				    
					<div class="form-group">
				    <div class="row">
					<div class="col-xs-3">
					    <label>VLAN ID :</label>
					</div>
					<div class="col-xs-6">
					    <input class="form-control" type="text" name="vlanid" placeholder="VLAN ID">
					</div>
					
				    </div>
				    </div>
					
					<div class="form-group">
				    <div class="row">
					<div class="col-xs-3">
					    <label>USERID :</label>
					</div>
					<div class="col-xs-6">
					    <input class="form-control" type="text" name="userid" placeholder="USERID">
					</div>
					
				    </div>
				    </div>
					
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-3">
					    
					</div>
					<div class="col-xs-6">
					    <input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
					</div>
					
				    </div>
				    </div>
				</div>
	</form>
			<div class="col-lg-6 col-sm-12 col-xs-12">
				<div class="row">
                <div class="col-md-8">
                 <div id="donut-chart" style="height: 200px;"></div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o text-red"></i> VLAN Aktif : '.$total_server_ras_aktif.'</li>
                    <li><i class="fa fa-circle-o text-green"></i> VLAN Non Aktif : '.$total_server_ras_nonaktif.'</li>
					
					<li><i class="fa fa-circle-o"></i> TOTAL VLAN : '.$total_server_ras_all.'</li>
					<li><i class="fa fa-circle-o"></i> DATA VLAN : 1001 - 2900</li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
			  
			  <div class="row">
			  <div class="col-md-12">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="detail_vlan?q=aktif">VLAN Aktif<span class="pull-right text-red"> '.$total_server_ras_aktif.' or '.round(($total_server_ras_aktif/$total_server_ras_all) *100).' %</span></a></li>
					<li><a href="detail_vlan?q=nonaktif">VLAN Non Aktif <span class="pull-right text-green"> '.$total_server_ras_nonaktif.' or '.round(($total_server_ras_nonaktif/$total_server_ras_all) *100).' %</span></a>
					</li>
					
				  </ul>
				</div>
			  </div>
			  
			</div>
		</div>
	<hr>
	
	<a href="form_vlan" class="btn bg-olive btn-flat margin pull-right">Create New</a><br><br>';
	
if(isset($_POST["search"])){
    $vlanid		= isset($_POST["vlanid"]) ? trim(strip_tags($_POST["vlanid"])) : "";
	$userid		= isset($_POST["userid"]) ? trim(strip_tags($_POST["userid"])) : "";
	$id_esx		= isset($_GET['id_esx']) ? (int)$_GET['id_esx'] : "";
	//$id_olt		= isset($_POST["id_olt"]) ? trim(strip_tags($_POST["id_olt"])) : "";
    
    $sql_vlanid		= ($vlanid != "") ? "AND `vlan` = '$vlanid'" : "";
	$sql_userid		= ($userid != "") ? "AND `userid_vlan` LIKE '%$userid%'" : "";
    
    
    $sql_server_ras = mysql_query("SELECT * FROM `v_esx_vlan`
								WHERE `level` = '0'
								$sql_vlanid
								$sql_userid
								
								ORDER BY `id_esx` ASC, `vlan` ASC LIMIT $start, $perhalaman;", $conn);
	$total_server_ras = mysql_num_rows(mysql_query("SELECT * FROM `v_esx_vlan`
												   WHERE `level` = '0'
												   $sql_vlanid
													$sql_userid
													ORDER BY `vlan` ASC, `id_esx` ASC;", $conn));
//}else{
   // $sql_server_ras = mysql_query("SELECT * FROM `v_olt_customer` ORDER BY `nama_server` ASC;", $conn);
//}
									
}else{
	$id_esx		= isset($_GET['id_esx']) ? (int)$_GET['id_esx'] : "";
	//$id_olt		= isset($_POST["id_olt"]) ? trim(strip_tags($_POST["id_olt"])) : "";
    
    $sql_userid		= ($id_esx != "") ? "AND `id_server` LIKE '$id_esx'" : "";
	
	$sql_server_ras = mysql_query("SELECT * FROM `v_esx_vlan` WHERE `level` = '0' $sql_userid ORDER BY `vlan` ASC, `id_esx` ASC  LIMIT $start, $perhalaman;", $conn);
	$total_server_ras = mysql_num_rows(mysql_query("SELECT * FROM `v_esx_vlan` WHERE `level` = '0' $sql_userid ORDER BY `vlan` ASC, `id_esx` ASC;", $conn));
	//$sql_server_ras = mysql_query("SELECT * FROM `gx_data_vlan` ORDER BY `id_vlan` ASC LIMIT 0, 30;;", $conn);
}

$content .='<table class="table table-hover table-border  table-responsive">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>UserID</th>
												<th>VLAN ID</th>
												<th>Mac Address</th>
                                                <th>Server ESX</th>
												<th>Status</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

$no = $start + 1;
while ($row_server_ras = mysql_fetch_array($sql_server_ras))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_server_ras["userid_vlan"].'</td>
			<td>'.$row_server_ras["vlan"].'</td>
			<td>'.$row_server_ras["mac_address"].'</td>
			<td>'.$row_server_ras["nama_server"].'</td>
			<td>'.$row_server_ras["flag_vlan"].'</td>
			<td><a href="form_vlan.php?id='.$row_server_ras['id_vlan'].'"><span class="label label-info">Edit</span></a></td>
		</tr>';
		$no++;
}


$content .= '
                                        </tbody>
                                    </table>

                                    
                                </div><!-- /.box-body-->
								<div class="box-footer">
									<div class="box-tools pull-right">
									'.(halaman($total_server_ras, $perhalaman, 1, $hal)).'
									</div>
									<br style="clear:both;">
								</div>
                                
                            </div><!-- /.box -->
                            
							</form>
							 </div><!-- /.col -->
                    </div><!-- /.row -->
							
	
                    
                </section><!-- /.content -->
            ';
	
$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
<!-- FLOT CHARTS -->
<script src="'.URL.'/assets/adminlte2/plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="'.URL.'/assets/adminlte2/plugins/flot/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="'.URL.'/assets/adminlte2/plugins/flot/jquery.flot.pie.min.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="'.URL.'/assets/adminlte2/plugins/flot/jquery.flot.categories.min.js"></script>
<!-- Page script -->
<script>
  $(function () {

    /*
     * DONUT CHART
     * -----------
     */

    var donutData = [
      {label: "VLAN Aktif", data: '.$total_server_ras_aktif.', color: "#dd4b39"},
      {label: "VLAN Non Aktif", data: '.$total_server_ras_nonaktif.', color: "#00a65a"}
    ];
    $.plot("#donut-chart", donutData, {
      series: {
        pie: {
          show: true,
          radius: 1,
          
          label: {
            show: true,
            radius: 1/2,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    });
    /*
     * END DONUT CHART
     */

  });

  /*
   * Custom Label formatter
   * ----------------------
   */
  function labelFormatter(label, series) {
    return \'<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">\'
        + label
        + "<br>"
        + Math.round(series.percent) + "% </div>";
  }
</script>';

    $title	= 'List Data VLAN';
    $submenu	= "";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>