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
include ("../../config/configuration_voip_bali.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Report Helpdesk");
    
	global $conn;
	$conn_soft = Config::getInstanceSoft();

    $content ='
                <!-- Main content -->
                <section class="content">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
							<form role="form" method="POST" action="" id="report_blokir" name="report_blokir">
								<div class="box-header">
                                    <h4 class="box-title">Search</h4>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    
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
										
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<label>Cabang</label>
												</div>
												<div class="col-xs-3">
													<select name="cabang" class="form-control">';
													
$sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `level` = '0';", $conn);
while($row_cabang = mysql_fetch_array($sql_cabang))
{
	$content .='<option value="'.$row_cabang["id_cabang"].'">'.$row_cabang["nama_cabang"].'</option>';
}

$content .='
													</select>
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
									<h3 class="box-title">List Report</h3>
								</div><!-- /.box-header -->
								<div class="box-body table-responsive">
									<table  class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>Kode</th>
											<th>Nama</th>
											<th>UserID</th>
											<th>GroupName</th>
											<th>AccountName</th>
											<th>UserIP</th>
											<th>UserPaymentBalance</th>
											<th>GracePeriodExpiration</th>
											<th>UserExpiryDate</th>
											
											<th>Status</th>
								
										</tr>
									</thead>
									<tbody>';

						
						
						
if(isset($_POST["search"]))
{
	$no = 1;
	$tanggal	= isset($_POST['tanggal']) ? mysql_real_escape_string(strip_tags(trim($_POST['tanggal']))) : "";
	$cabang		= isset($_POST['cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['cabang']))) : "";
	
	$sql_tanggal	= ($tanggal != "") ? " AND dbo.Users.GracePeriodExpiration >= '".$tanggal." 00:00' AND dbo.Users.GracePeriodExpiration <= '".$tanggal." 23:59'" : "";
	$sql_rbs	= "SELECT dbo.Users.UserIndex, dbo.Users.UserID, dbo.Users.UserIP, dbo.AccountTypes.AccountName, dbo.Users.GroupName, dbo.Users.UserPaymentBalance,
								dbo.Users.GracePeriodExpiration , dbo.Users.UserActive, dbo.Users.UserExpiryDate
  FROM dbo.Users, dbo.AccountTypes
  WHERE dbo.Users.AccountIndex = dbo.AccountTypes.AccountIndex
  $sql_tanggal
  AND dbo.Users.UserActive = '1';";
  echo $sql_rbs;
	$query_rbs = $conn_soft->prepare($sql_rbs);
	$query_rbs->execute();
	
	$sql_data = mysql_query("SELECT * FROM `tbCustomer` WHERE `id_cabang` = '".$cabang."' AND `level` = '0' ORDER BY `date_add` DESC;", $conn);	
	
}
else
{
	$no = 1;
	
	$sql_rbs	= "SELECT dbo.Users.UserIndex, dbo.Users.UserID, dbo.Users.UserIP, dbo.AccountTypes.AccountName, dbo.Users.GroupName, dbo.Users.UserPaymentBalance,
								dbo.Users.GracePeriodExpiration , dbo.Users.UserActive, dbo.Users.UserExpiryDate
  FROM dbo.Users, dbo.AccountTypes
  WHERE dbo.Users.AccountIndex = dbo.AccountTypes.AccountIndex
  AND dbo.Users.UserActive = '1';";
	$query_rbs = $conn_soft->prepare($sql_rbs);
	$query_rbs->execute();
	
}

/*if(isset($_POST["search"]))
	{
	
		$tanggal	= isset($_POST['tanggal']) ? mysql_real_escape_string(strip_tags(trim($_POST['tanggal']))) : "";
		
		$sql_tanggal = ($tanggal != "") ? " AND dbo.Users.GracePeriodExpiration = '".$tanggal."' " : "";
	}
	else
	{
		$sql_tanggal = '';
	}
	echo $sql_tanggal;
	
	
	//echo date("Y-m-d");
	if($row_rbs["UserIndex"] !="")
	{
	
	*/

while($row_rbs	= $query_rbs->fetch())
{
	$cabang		= isset($_POST['cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['cabang']))) : "";
	
	$sql_data = mysql_query("SELECT * FROM `tbCustomer` WHERE `cUserID` = '".$row_rbs["UserID"]."' AND `level` = '0'
							AND `id_cabang` = '".$cabang."'
							ORDER BY `date_add` DESC LIMIT 0,1;", $conn);	
	$row_data = mysql_fetch_array($sql_data);
	
	if($row_data["cKode"] !="")
	{
		if(strtotime($row_rbs["GracePeriodExpiration"]) < strtotime(date("Y-m-d")))
		{
			$status = '<span class="label label-danger">Blokir</span>';
		}
		elseif(strtotime($row_rbs["GracePeriodExpiration"]) > strtotime(date("Y-m-d")))
		{
			$status = '<span class="label label-success">Aktif</span>';
		}
		elseif(strtotime($row_rbs["GracePeriodExpiration"]) == strtotime(date("Y-m-d")))
		{
			$status = '<span class="label label-warning">Aktif</span>';
		}
		//'.strtotime($row_rbs["GracePeriodExpiration"]).'<br>'.strtotime(date("Y-m-d"))
		$content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$row_data["cKode"].'</td>
		<td>'.$row_data["cNama"].'</td>
		<td>'.$row_rbs["UserID"].'</td>
		<td>'.$row_rbs["GroupName"].'</td>
		<td>'.$row_rbs["AccountName"].'</td>
		<td>'.$row_rbs["UserIP"].'</td>
		<td>'.number_format($row_rbs["UserPaymentBalance"], 0, ',', '.').'</td>
		<td>'.(($row_rbs["GracePeriodExpiration"] == "") ? "" : date("d-m-Y", strtotime($row_rbs["GracePeriodExpiration"]))).'</td>
		<td>'.(($row_rbs["UserExpiryDate"] == "") ? "" : date("d-m-Y", strtotime($row_rbs["UserExpiryDate"]))).'</td>
		<td>'.$status.'</td>
	
		
		</tr>';
		$no++;
	}
}

$content .='</tbody>

</table><br>
				    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			</div>';
			    

$content .='
                    </div>
                </section><!-- /.content -->
            ';

$plugins = '
	<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
    ';


    $title	= 'Report Blokir';
    $submenu	= "report_blokir";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group,"red");
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>