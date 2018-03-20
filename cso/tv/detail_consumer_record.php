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
include ("../../config/configuration_tv.php");

redirectToHTTPS();
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Technician");
   
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open STB User");
    global $conn;
    $conn_ott   = DB_TV();
	
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
	$id_data2	= isset($_GET['id']) ? $_GET['id'] : '';
    $query_data2 = "SELECT * FROM `boss`.`t_account_cms` WHERE `boss`.`t_account_cms`.`CLIENTID`='".$id_data2."' LIMIT 0,1;";
    $sql_data2	= mysqli_query($conn_ott,$query_data2);
    $row_data2	= mysqli_fetch_array($sql_data2);
	
$content = '<!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">
					
		    
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Data Consumer Record</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th width="3%">No.</th>
					<th>Title</th>
					<th>Price</th>
					<th>Start Date</th>
					<th>Valid Date</th>
                  </tr>
                </thead>
                <tbody>';
//select data
/*<div class="box-footer">
			<div class="box-tools pull-right">
			'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
			</div>
			<br style="clear:both;">
	    </div>*/
    $sql_data		= mysqli_query($conn_ott, "SELECT `boss`.`t_consumerecord`.*, `ott`.`ott_product`.`price` FROM `boss`.`t_consumerecord`, `ott`.`ott_product`
								   WHERE `boss`.`t_consumerecord`.`PROID` = `ott`.`ott_product`.`proID`
								   AND `boss`.`t_consumerecord`.`CLIENTID` = '".$_GET["id"]."'
								   ORDER BY `boss`.`t_consumerecord`.`EXPENSEDT` DESC
								   LIMIT $start, $perhalaman;");
    //$sql_total_data	= mysqli_num_rows(mysqli_query($conn_ott, "SELECT * FROM `boss`.`t_consumerecord` WHERE `boss`.`t_consumerecord`.`CLIENTID` = '".$_GET["id"]."';"));
    $hal		= "?id=".$_GET['id']."&";
    $no = $start + 1;

    while($row_data = mysqli_fetch_array($sql_data))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["PRODUCTNAME"].'</td>
			<td>'.number_format($row_data["price"], 0, ',', '.').'</td>
			<td>'.$row_data["EXPENSEDT"].'</td>
			<td>'.$row_data["VALIDDATE"].'</td>
		</tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>

	    
       </div>
	   
	   
	   </div>
                    </div>

                </section><!-- /.content -->';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'STB User';
    $submenu	= "stb_user";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_CSO."logout.php");
    }

?>