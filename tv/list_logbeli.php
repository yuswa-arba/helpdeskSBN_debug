<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration.php");
include ("../config/configuration_tv.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Menu list logbeli");

	global $conn;
    $conn_ott   = DB_TV();

	$perhalaman = 20;
	if (isset($_GET['page'])){
		$page = (int)$_GET['page'];
		$start=($page - 1) * $perhalaman;
	}else{
		$start=0;
	}
	
	$sql_paket_tv = mysql_query("SELECT `gx_tv_customer`.* FROM `gx_tv_customer` WHERE `gx_tv_customer`.`id_customer` = '".$loggedin["customer_number"]."';", $conn);
	$row_paket_tv = mysql_fetch_array($sql_paket_tv);
	
	$sql_data_tv	= mysqli_query($conn_tv, "SELECT `boss`.`t_account_cms`.* FROM `boss`.`t_account_cms` WHERE `CLIENTID` = '".$row_paket_tv["id_stb"]."';");
	$row_data_tv	= mysqli_fetch_array($sql_data_tv);
	
    $content ='
                
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List History Pembelian Paket </h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <thead>
											<tr>
											  <th width="3%">No.</th>
											  <th>Nama Paket / Channel</th>
											  
											  <th>Expired date</th>
											  <th>Valid date</th>
											  
											  <th>Harga</th>
											  
											</tr>
										</thead>
										<tbody>';

	$sql_data		= mysqli_query($conn_ott, "SELECT * FROM `boss`.`t_consumerecord`, `boss`.`t_account_cms`
								   WHERE `boss`.`t_consumerecord`.`CLIENTID` = `boss`.`t_account_cms`.`CLIENTID`
								   AND `boss`.`t_consumerecord`.`CLIENTID` = '".$row_paket_tv["id_stb"]."'
								   ORDER BY `boss`.`t_consumerecord`.`RECORDID` DESC LIMIT $start, $perhalaman;");
    $sql_total_data	= mysqli_num_rows(mysqli_query($conn_ott, "SELECT * FROM `boss`.`t_consumerecord`, `boss`.`t_account_cms`
								   WHERE `boss`.`t_consumerecord`.`CLIENTID` = `boss`.`t_account_cms`.`CLIENTID`
								   AND `boss`.`t_consumerecord`.`CLIENTID` = '".$row_paket_tv["id_stb"]."';"));
    $hal		= "?";
    $no = $start + 1;
	
	
    while($row_data = mysqli_fetch_array($sql_data))
    {
		$content .='<tr>
				<td>'.$no.'.</td>
				<td>'.(($row_data["ORDERTYPE"] == "1") ? '<a href="detail_paket_ott.php?id='.$row_data["PROID"].'"
					   onclick="return valideopenerform(\'detail_paket_ott.php?id='.$row_data["PROID"].'\',\'topup\');">'.$row_data["PRODUCTNAME"].'</a>' : $row_data["PRODUCTNAME"]).'</td>
				
				<td>'.$row_data["EXPENSEDT"].'</td>
				<td>'.$row_data["VALIDDATE"].'</td>
				
				
				<td>'.number_format($row_data["PRICE"], 0, '', '.').'</td>
				
				
			</tr>';
		$no++;
    }

$content .='</tbody>
                                    </table>
				<div class="box-footer">
		<div class="box-tools pull-right">
		'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
		</div>
		<br style="clear:both;">
	     </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'History Pembelian Paket';
    $submenu	= "tv_invoice";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"yellow");
    
    echo $template;
}
    } else{
	header("location: ".URL."logout.php");
    }

?>