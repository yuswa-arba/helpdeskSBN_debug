<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

include ("../../config/configuration_admin.php");
include ("../../config/configuration_tv.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open STB User");
    global $conn;
    $conn_ott   = DB_TV();
	
    $perhalaman = 40;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
$content = '<!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">
					<div class="row">
					<div class="col-xs-12">
						<div class="box">
						<div class="box-body">
							<a href="form_belipaket.php" class="btn bg-maroon btn-flat margin">Beli Paket</a>
						</div>
						</div>
					</div>
					</div>
		    
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Data</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th width="3%">No.</th>
					<!--<th>RECORDID</th>-->
					<th>CLIENTNAME</th>
					<th>PRODUCTNAME</th>
					
					<th>EXPENSEDT</th>
					<th>VALIDDATE</th>
					<th>ORDERTYPE</th>
					<th>PRICE</th>
					<th width="10%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysqli_query($conn_ott, "SELECT * FROM `boss`.`t_consumerecord` ORDER BY `RECORDID` DESC LIMIT $start, $perhalaman;");
    $sql_total_data	= mysqli_num_rows(mysqli_query($conn_ott, "SELECT * FROM `boss`.`t_consumerecord`;"));
    $hal		= "?";
    $no = $start + 1;
	
	

    while($row_data = mysqli_fetch_array($sql_data))
    {
		$sql_data_user		= mysqli_query($conn_ott, "SELECT * FROM `boss`.`t_account_cms` WHERE `CLIENTID` = '".$row_data["CLIENTID"]."' LIMIT 0, 1;");
		$row_data_user		= mysqli_fetch_array($sql_data_user);
		$total_data_user	= mysqli_num_rows($sql_data_user);
		
		//
		$content .='<tr>
				<td>'.$no.'.</td>
				<!--<td>'.$row_data["RECORDID"].'</td>-->
				<td>'.(($total_data_user == 1) ? '<a href="detail_user.php?id='.$row_data["CLIENTID"].'"
					   onclick="return valideopenerform(\'detail_user.php?id='.$row_data["CLIENTID"].'\',\'topup\');">'.$row_data_user["CLIENTNAME"].'</a>'
					   : $row_data_user["CLIENTNAME"]).'</td>
				<td>'.(($row_data["ORDERTYPE"] == "1") ? '<a href="detail_paket_ott.php?id='.$row_data["PROID"].'"
					   onclick="return valideopenerform(\'detail_paket_ott.php?id='.$row_data["PROID"].'\',\'topup\');">'.$row_data["PRODUCTNAME"].'</a>' : $row_data["PRODUCTNAME"]).'</td>
				
				<td>'.$row_data["EXPENSEDT"].'</td>
				<td>'.$row_data["VALIDDATE"].'</td>
				<td>'.$row_data["ORDERTYPE"].'</td>
				
				<td>'.number_format($row_data["PRICE"], 0, '', '.').'</td>
				
				<td></td>
			</tr>';
		$no++;
    }

$content .='</tbody>
</table>
</div>

	    <div class="box-footer">
		<div class="box-tools pull-right">
		'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
		</div>
		<br style="clear:both;">
	     </div>
       </div>
	   
	   
	   </div>
                    </div>

                </section><!-- /.content -->';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'List Beli paket';
    $submenu	= "belipaket";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>