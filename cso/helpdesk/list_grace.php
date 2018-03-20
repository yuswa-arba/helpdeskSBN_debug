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

redirectToHTTPS();
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
    
    global $conn;
	$conn_soft = Config::getInstanceSoft();
    
	
	//paging
    $perhalaman = 50;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }

	

if(isset($_POST["search"])){
    $hal = "?";
	
	$no = $start + 1;
	$id_cso		= $loggedin["id_employee"];
	
	$tanggal	= isset($_POST["date"]) ? trim(strip_tags($_POST["date"])) : "";
	$uid		= isset($_POST["uid"]) ? trim(strip_tags($_POST["uid"])) : "";
    
	$sql_uid		= ($uid != "") ? "AND `cUserID` LIKE '%$uid%'" : "";
	
	$sql_data = mysql_query("SELECT * FROM `tbCustomer`
				     WHERE `tbCustomer`.`level` = '0'
					 $sql_uid
				       ORDER BY `tbCustomer`.`date_add`
				       DESC LIMIT $start, $perhalaman;", $conn);
	
	$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `tbCustomer`
				     WHERE `tbCustomer`.`level` = '0'
					 $sql_uid
				       ORDER BY `tbCustomer`.`date_add` DESC;", $conn));
}else{
	$hal = "?";
	
	$no = $start + 1;
	$id_cso		= $loggedin["id_employee"];
	$tanggal	= date("d-m-Y");
	$sql_data = mysql_query("SELECT * FROM `tbCustomer`
				     WHERE `tbCustomer`.`level` = '0' 
				       ORDER BY `tbCustomer`.`date_add`
				       DESC LIMIT $start, $perhalaman;", $conn);
	
	$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `tbCustomer`
				     WHERE `tbCustomer`.`level` = '0' 
				       ORDER BY `tbCustomer`.`date_add` DESC;", $conn));
	
}
/*if(isset($_GET["u"]) || isset($_GET["d"])){
    $date		= isset($_GET["d"]) ? trim(strip_tags($_GET["d"])) : "";
    $uid		= isset($_GET["u"]) ? trim(strip_tags($_GET["u"])) : "";
    
	$sql_date		= ($date != "") ? "AND `date_add` LIKE '%$date%'" : "";
    $sql_uid		= ($uid != "") ? "AND `uid` LIKE '%$uid%'" : "";
    
    
	$sql_data = mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0' AND `gx_helpdesk_complaint`.`trouble_ticket` = '1'
					 AND `status` = 'open'
					 $sql_date
					 $sql_uid
				       ORDER BY `gx_helpdesk_complaint`.`date_add`
				       DESC LIMIT $start, $perhalaman;", $conn);
	
	$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0' AND `gx_helpdesk_complaint`.`trouble_ticket` = '1'
					 AND `status` = 'open'
					 $sql_date
					 $sql_uid
				       ORDER BY `gx_helpdesk_complaint`.`date_add` DESC;", $conn));
    
    $hal= "?u=$uid&d=$date&";
    $no = $start + 1;
}*/
	
$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Rekap Customer GRACE
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Search</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								
								<form action="" method="post" name="form_search">
								
			
									
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
											<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" name="date" id="date" value="'.date("d-m-Y").'">
											</div>
										</div>
										</div>
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
											<label>UserID</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" name="uid" id="uid" value="">
											</div>
										</div>
										</div>
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    <input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
	</form>
	<hr>
								<div class="box-header">
                                    <h3 class="box-title">List Data</h3>
									
                                </div><!-- /.box-header -->
								
								

    <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>Customer Number</th>
			<th>UserID</th>
			<th>Nama</th>
			<th>Tanggal Grace</th>
			<th>Tanggal Blokir</th>
			<th>Piutang</th>
			<th>Status</th>
			
			
                  </tr>
                </thead>
                <tbody>';
	//<a href="form_troubleticket.php" class="btn bg-olive btn-flat margin pull-right">Create New</a>
	while($row_data = mysql_fetch_array($sql_data))
	{
		
$sql_rbs = $conn_soft->prepare("SELECT TOP 1 [Users].*
  FROM [dbo].[Users]
  WHERE [Users].[UserActive] = '1'
  AND [Users].[UserIndex] = '".$row_data["iuserIndex"]."';");

$sql_rbs->execute();
$row_rbs = $sql_rbs->fetch();
$grace		= date("d-m-Y", strtotime($row_rbs["GracePeriodExpiration"]));
		if($row_rbs["UserIndex"] != "" AND $grace == $tanggal)
		{
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$row_data["cKode"].'</td>
		<td>'.$row_data["cUserID"].'</td>
		<td>'.$row_data["cNama"].'</td>
		<td>'. date("d M Y", strtotime($row_rbs["GracePeriodExpiration"])).'</td>
		<td>'. date("d M Y", strtotime($grace . "+1 days")).'</td>
		<td>'.number_format($row_rbs["UserPaymentBalance"], 0, '.', ',').'</td>
		<td>'.(($row_rbs["UserActive"] == 1) ? "Aktif" : "NonAktif").'</td>
		
		
	    </tr>';
	    
	    $no++;
		}
	}

$content .='</tbody>

</table><br>
</div><!-- /.box-body -->
								<div class="box-footer">
				   
				   <br style="clear:both;">
				</div>
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "dd-mm-yyyy"});
            });
        </script>';

    $title	= 'List Blokir Customer';
    $submenu	= "helpdesk";	
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
}
     else{
	header("location: ".URL_CSO."logout.php");
    }

?>