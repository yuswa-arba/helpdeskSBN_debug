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
    $perhalaman = 1000;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
	
	if(isset($_GET['id']))
	{
		$id_generate	= (int)$_GET['id'];
		$sql_generate 	= mysql_query("SELECT * FROM `gx_generate_invoice`, `gx_cabang` WHERE `gx_generate_invoice`.`id_cabang` = `gx_cabang`.`id_cabang`
								AND `gx_generate_invoice`.`id_generate` = '".$id_generate."'
								AND `gx_cabang`.`level` = '0' LIMIT 0,1;", $conn);
		
		$row_generate	= mysql_fetch_array($sql_generate);
	
	
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
								
								<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tanggal Tagihan</label>
					    </div>
					    <div class="col-xs-6">
							<input type="text" class="form-control" id="datepicker" readonly="" name="tgl_tagihan" value="'.$row_generate["tgl_tagihan"].'">
						</div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Port</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control"  readonly=""  id="datepicker" readonly="" name="cabang" value="'.$row_generate["nama_cabang"].'">

					    </div>
                                        </div>
					</div>
								
                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>#</th>
                                                <th>Kode Customer</th>
												<th>UserID</th>
												<th>Nama</th>
												<th>Nama Paket</th>
												<th>Internet</th>
												<th>Video</th>
												<th>VOIP</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_data = mysql_query("SELECT `gx_generate_detail`.`id_customer`, `tbCustomer`.`cUserID`, `tbCustomer`.`cNama`, `tbCustomer`.`cKdPaket`, `gx_paket2`.`monthly_fee`, `gx_paket2`.`abonemen_video`, `gx_paket2`.`abonemen_voip`
						FROM `gx_generate_detail`, `tbCustomer`, `gx_paket2`
						WHERE `gx_generate_detail`.`id_customer` = `tbCustomer`.`cKode`
						AND `gx_generate_detail`.`kode_paket` = `gx_paket2`.`kode_paket`
						AND `gx_generate_detail`.`id_generate` = '".$id_generate."'
						AND `tbCustomer`.`level` = '0'
						AND `gx_paket2`.`level` = '0' LIMIT $start, $perhalaman;", $conn);
$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_generate_invoice`;",$conn));
$hal = '?id='.(isset($_GET["id"]) ? $id_generate : "") .'&';

$no = $start + 1;
while ($row_data = mysql_fetch_array($sql_data))
{
     $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_data["id_customer"].'</td>
		    <td>'.$row_data["cUserID"].'</td>
		    <td>'.$row_data["cNama"].'</td>
			<td>'.$row_data["cKdPaket"].'</td>
			<td>'.$row_data["monthly_fee"].'</td>
			<td>'.$row_data["abonemen_video"].'</td>
			<td>'.$row_data["abonemen_voip"].'</td>
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
	}
	else
	{
		$content = "";
	}
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