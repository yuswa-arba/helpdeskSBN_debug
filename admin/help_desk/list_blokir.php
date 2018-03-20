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
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Grace Customer");
    global $conn;
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }

$content = '

                <!-- Main content -->
                <section class="content">
		   
		    <div class="row">
			<div class="col-xs-12">
                            <div class="box">
							<form role="form" method="POST" action="" id="report_blokir" name="report_blokir">
								<div class="box-header">
                                    <h4 class="box-title">Search</h4>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    
                                        <div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<label>Tanggal Blokir</label>
												</div>
												<div class="col-xs-3">
													<input  class="form-control hasDatepicker" type="text" readonly="" name="tanggal" id="datepicker">
												</div>
											</div>
										</div>
										
										
                                    
                                </div>
								<div class="box-footer">
									<button type="submit" name="search" class="btn btn-primary">Search</button>
								</div>
                            </div>
							</form>
                        </div>
						
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Data Blokir </h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>Kode Customer</th>
			<th>Nama Customer</th>
			<th>UserID</th>
			<th>UserPaymentBalance</th>
			<th>Tanggal Grace</th>
			<th>Tanggal Blokir</th>
			
			
			
                  </tr>
                </thead>
                <tbody>';
//select data
if(isset($_POST["search"]))
{
	$tanggal	= isset($_POST['tanggal']) ? mysql_real_escape_string(strip_tags(trim($_POST['tanggal']))) : "";
	$sql_tgl = isset($_POST["tanggal"]) ? " AND (dbo.Users.GracePeriodExpiration BETWEEN '".date("Y-m-d 00:00:00", strtotime($tanggal))."' AND '".date("Y-m-d 23:59:59", strtotime($tanggal))."' )" : "";
	$conn_soft = Config::getInstanceSoft();
	$sql_data = $conn_soft->prepare("SELECT dbo.Users.UserIndex, dbo.Users.UserID, dbo.Users.UserIP, dbo.AccountTypes.AccountName, dbo.Users.GroupName, dbo.Users.UserPaymentBalance,
									dbo.Users.GracePeriodExpiration , dbo.Users.UserActive, dbo.Users.UserExpiryDate
	  FROM dbo.Users, dbo.AccountTypes
	  WHERE dbo.Users.AccountIndex = dbo.AccountTypes.AccountIndex
	  AND dbo.Users.UserActive = '1'
	  AND dbo.Users.UserPaymentBalance < 0
	$sql_tgl
	  ORDER BY dbo.Users.UserIndex DESC;");
	//  AND dbo.Users.UserIndex = '6418'
	$sql_data->execute();
	
    //$sql_data		= mysql_query("SELECT * FROM `gx_helpdesk_grace` WHERE `blokir_tanggal` = '".date("d-m-Y", strtotime($tanggal))."' AND `level` =  '0' ORDER BY `id_grace_customer` DESC LIMIT $start, $perhalaman;", $conn);
    //$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_grace` WHERE `blokir_tanggal` = '".date("d-m-Y", strtotime($tanggal))."' AND `level` =  '0';", $conn));
    $hal		= "?";
    $no = $start + 1;


    while ($row_data = $sql_data->fetch())
	{
		$sql_cust	= mysql_query("SELECT * FROM `tbCustomer` WHERE `cUserID` = '".$row_data["UserID"]."' LIMIT 1;", $conn);
		$row_cust	= mysql_fetch_array($sql_cust);
		$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_cust["cKode"].'</td>
			<td>'.$row_cust["cNama"].'</td>
			<td>'.$row_data["UserID"].'</td>
			<td>'.$row_data["UserPaymentBalance"].'</td>
			<td>'.date("d-m-Y", strtotime($row_data["GracePeriodExpiration"]."-1 day")).'</td>
			<td>'.date("d-m-Y", strtotime($row_data["GracePeriodExpiration"])).'</td>
			
			
			
		</tr>';
	$no++;
    }

}
$content .='</tbody>
</table>
</div>

	    <div class="box-footer">
		<div class="box-tools pull-right">';
//select data
//if(isset($_POST["search"]))
//{
//		echo (halaman($sql_total_data, $perhalaman, 1, $hal));
//}

$content .='
		</div>
		<br style="clear:both;">
	     </div>
       </div>
                </section>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'List Blokir';
    $submenu	= "grace_customer";
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