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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List report generate invoice");
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
			    <form method ="POST" action="">
                            <div class="box">
				<div class="box-header">
                                   <h3 class="box-title">List Data</h3>
				  
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>#</th>
                                                <th>Kode customer</th>
												<th>Nama</th>
												<th>Email</th>
												<th>File</th>
												<th>Tanggal</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_data = mysql_query("SELECT * FROM `gx_invoice_email`
						ORDER BY `date` DESC LIMIT $start, $perhalaman;", $conn);
$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_invoice_email`
						ORDER BY `date` DESC;",$conn));
$hal = "?";

$no = $start + 1;
while ($row_data = mysql_fetch_array($sql_data))
{
     $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_data["kode_customer"].'</td>
			<td>'.$row_data["nama_customer"].'</td>
		    <td>'.$row_data["email_invoice"].'</td>
			<td>'.$row_data["file_invoice"].'</td>
		    <td>'.date("d-m-Y", strtotime($row_data["date"])).'</td>
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
                            </form>
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Report Generate Invoice';
    $submenu	= "report_generate_invoice";
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