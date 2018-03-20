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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Group RBS");
    global $conn;
    
    
    
    //paging
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
                            <h3 class="box-title">List Data</h3>
						</div><!-- /.box-header -->
						
						<div class="box-body table-responsive">
                            <table class="table table-bordered table-striped">
								<thead>
									<tr>
										
										<th>Userid</th>
										<th>gx_saldo</th>
										
										<th>uang muka</th>
										<th>Total</th>
										<th>ppn</th>
										<th>grandtotal</th>
										
									</tr>
								</thead>
								<tbody>';

$sql_data = mysql_query("SELECT * FROM `v_rev_invoice` WHERE `title` LIKE '%September%'", $conn);

$no = 1;
$sql_data_update ='';
while ($row_data = mysql_fetch_array($sql_data))
{	
	$total_invoice = $row_data["grandtotal"];
	$gx_saldo = $total_invoice - $row_data["uangmuka"];
	$uangmuka = $total_invoice + $row_data["gx_saldo"];
	
	//$sql_data_update .= "UPDATE `gx_invoice` SET `uangmuka`='".$uangmuka."' WHERE (`id_invoice`='".$row_data["id_invoice"]."');<br>";
	
	if($row_data["gx_saldo"] < 1)
	{
		$sql_data_update .= "UPDATE `gx_invoice` SET `grandtotal`='".abs($row_data["gx_saldo"])."' WHERE (`id_invoice`='".$row_data["id_invoice"]."');<br>";
	}
$content .= '<tr>
			<td>'.$row_data["cUserID"].'</td>
			<td>'.$row_data["gx_saldo"].'</td>
			<td>'.$uangmuka .'</td>
			<td>'.$row_data["total"].'</td>
			<td>'.$row_data["ppn"].'</td>
			<td>'.$row_data["grandtotal"].'</td>
		</tr>';
		$no++;
}
echo $sql_data_update;
$content .= '
                                            
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#listdata\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false,
					"iDisplayLength": 50
                });
            });
        </script>
    ';

    $title	= 'Groups RBS';
    $submenu	= "group_rbs";
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