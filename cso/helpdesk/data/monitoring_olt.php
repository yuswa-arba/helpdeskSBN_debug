<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inCSO()){ // Check if they are logged in
	if($loggedin["group"] == 'cso'){
    
		global $conn;

 enableLog("",$loggedin["username"], $loggedin["id_employee"],"Open Menu List Inactive OLT Customer");
    
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Monitoring Inactive OLT</h3>
                                    
                                </div>
                                <div class="box-body table-responsive">
                                    <form action="" method="post" name="form_search">
									
									
									<div class="form-group">
									<div class="row">
										<div class="col-xs-2">
											<label>Kategori</label>
										</div>
										<div class="col-xs-2">
											<input name="kategori" type="radio" value="1" checked="checked">Per Cabang
											
										</div>
										<div class="col-xs-2">
											<input name="kategori" id="kategori" type="radio" value="2" >Per OLT
										</div>
										
									</div>
									</div>

				    <div class="form-group" id="olt" style="display:none">

				    <div class="row">
					<div class="col-xs-2">
					    <label>Server OLT</label>
					</div>
					<div class="col-xs-4">
					    <select name="id_olt" class="form-control">';

$sql_olt = mysql_query("SELECT * FROM `gx_inet_listolt` WHERE `id_cabang` = '".$loggedin["cabang"]."' AND `level` = '0';", $conn);
while($row_olt = mysql_fetch_array($sql_olt))
{
	$content .='<option value="'.$row_olt["id_server"].'">'.$row_olt["nama_server"].'</option>';
}
						
						
$content .='
						</select>
					</div>
					
				    </div>
				    </div>
					
					<div class="form-group" id="cabang" >

				    <div class="row">
					<div class="col-xs-2">
					    <label>Cabang</label>
					</div>
					<div class="col-xs-4">
					    <select name="id_cabang" class="form-control">';

$sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$loggedin["cabang"]."' AND `level` = '0';", $conn);
while($row_cabang = mysql_fetch_array($sql_cabang))
{
	$content .='<option value="'.$row_cabang["id_cabang"].'">'.$row_cabang["nama_cabang"].'</option>';
}
						
						
$content .='
						</select>
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
	';
	
if(isset($_POST["search"])){
	$id_olt		= isset($_POST["id_olt"]) ? trim(strip_tags($_POST["id_olt"])) : "";
	$id_cabang	= isset($_POST["id_cabang"]) ? trim(strip_tags($_POST["id_cabang"])) : "";
	$kategori	= isset($_POST["kategori"]) ? trim(strip_tags($_POST["kategori"])) : "";
	
$sql_cabang = mysql_query("SELECT * FROM `gx_cabang`
								  WHERE `id_cabang` = '$id_cabang';", $conn);
		
	$row_cabang = mysql_fetch_array($sql_cabang);
	$date = date("Y-m-d ");
	
	if(date("H") > 5 AND date("H") < 13 )
	{
		$date .= "06";
	}elseif(date("H") >= 13 AND date("H") < 19)
	{
		$date .= "13";
	}elseif(date("H") >= 19 )
	{
		$date .= "19";
	}
	
	//per cabang
	if($kategori == "1")
	{
		
		//echo "SELECT * FROM `v_monitoring_olt`
		//						  WHERE `id_cabang` = '$id_cabang' AND `lastderegreason` = 'wire-down'
		//						  AND `date_add` LIKE '%".date("Y-m-d")."%';";
		$sql_monitoring_wd = mysql_query("SELECT * FROM `v_monitoring_olt`
								  WHERE `id_cabang` = '$id_cabang' AND `lastderegreason` = 'wire-down'
								  AND `date_add` LIKE '%".date("Y-m-d H")."%';", $conn);
		$total_monitoring_wd = mysql_num_rows($sql_monitoring_wd);
		
		$sql_monitoring_off = mysql_query("SELECT * FROM `v_monitoring_olt`
								  WHERE `id_cabang` = '$id_cabang' AND `lastderegreason` LIKE '%off%'
								  AND `date_add` LIKE '%".date("Y-m-d H")."%';", $conn);
		$total_monitoring_off = mysql_num_rows($sql_monitoring_off);
		
		$sql_monitoring_status = mysql_query("SELECT * FROM `v_monitoring_olt`
								  WHERE `id_cabang` = '$id_cabang' 
								  AND `date_add` LIKE '%".date("Y-m-d H")."%';", $conn);
		$total_monitoring_status = mysql_num_rows($sql_monitoring_status);
		
		//echo $total_server_ras;
		$no_wd = 1;
		$content_wd = "";
		$no_off = 1;
		$content_off = "";
		$no = 1;
		$content_status = "";
		While($row_monitoring = mysql_fetch_array($sql_monitoring_status))
		{
			
			$sql_cust	= mysql_query("SELECT * FROM `tbCustomer`
								  WHERE  `cUserID` != '' AND `cUserID` = '".$row_monitoring["userid"]."' LIMIT 0,1;", $conn);
			$row_cust	= mysql_fetch_array($sql_cust);
			
			$tgl_dereg = str_replace('.', '-', substr($row_monitoring["lastderegtime"],0,10));
			$jam_dereg = substr($row_monitoring["lastderegtime"],11);
			$dereg	   = $tgl_dereg.' '.$jam_dereg;
			//2016.11.09.17:47:50
			
			if($row_monitoring["lastderegreason"] == "wire-down" OR $row_monitoring["lastderegreason"] == "wire down")
			{
				$content_wd .='<tr>
					<td>'.$no_wd.'</td>
					<td>'.$row_monitoring["nama_server"].'</td>
					<td>'.$row_monitoring["userid"].'</td>
					<td>'.$row_cust["gx_status"].'</td>
					
					
					<td>'.$row_monitoring["lastderegreason"].'</td>
					<td>'.date("d-m-Y H:i:s", strtotime($dereg)).'</td>
					
					<td>'.date("H:i:s", strtotime( $row_monitoring["date_add"])).'</td>
				
				</tr>';
				$no_wd++;
			}elseif($row_monitoring["lastderegreason"] == "power-off" OR $row_monitoring["lastderegreason"] == "power off")
			{
		
				$content_off .='<tr>
					<td>'.$no_off.'</td>
					<td>'.$row_monitoring["nama_server"].'</td>
					<td>'.$row_monitoring["userid"].'</td>
					<td>'.$row_cust["gx_status"].'</td>
					
					<td>'.$row_monitoring["lastderegreason"].'</td>
					<td>'.date("d-m-Y H:i:s", strtotime($dereg)).'</td>
					
					<td>'.date("H:i:s", strtotime( $row_monitoring["date_add"])).'</td>
				
				</tr>';
				$no_off++;
			}
			else
			{
				$content_status .='<tr>
					<td>'.$no.'</td>
					<td>'.$row_monitoring["nama_server"].'</td>
					<td>'.$row_monitoring["userid"].'</td>
					<td>'.$row_cust["gx_status"].'</td>
					
					<td>'.$row_monitoring["lastderegreason"].'</td>
					<td>'.date("d-m-Y H:i:s", strtotime($dereg)).'</td>
					
					<td>'.date("H:i:s", strtotime( $row_monitoring["date_add"])).'</td>
			
				</tr>';
				$no++;
			}
		}
		
		
		$content .= '<h3>'.$row_cabang["nama_cabang"].' per Tanggal '.date("d/m/Y").'</h3>
		<h4>Status : Wired-Down</h4>
		<table class="table table-hover table-border">
		<thead>
		<tr>
			<th>No.</th>
			<th>OLT</th>
			<th>UserID</th>
			<th>Status</th>
			
			<th>ONU Status</th>
			<th>LastDeregTime</th>
			
			<th>Last Checked</th>
		</tr>
		</thead>
		<tbody>';
		$content .= $content_wd;
		
		
		$content .= '
		</tbody>
		</table>
		<hr>
		
		<h4>Status : Power-Off</h4>
		<table class="table table-hover table-border">
		<thead>
		<tr>
			<th>No.</th>
			<th>OLT</th>
			<th>UserID</th>
			<th>Status</th>
			
			<th>ONU Status</th>
			<th>LastDeregTime</th>
			
			<th>Last Checked</th>
		</tr>
		</thead>
		<tbody>';
		$content .= $content_off;
		
		
		$content .= '
		</tbody>
		</table>
		<hr>
		<h4>Status: Unknown</h4>
		<table class="table table-hover table-border">
		<thead>
		<tr>
			<th>No.</th>
			<th>OLT</th>
			<th>UserID</th>
			<th>Status</th>
			
			<th>ONU Status</th>
			<th>LastDeregTime</th>
			
			<th>Last Checked</th>
		</tr>
		</thead>
		<tbody>';
		$content .= $content_status;
		
		
		$content .= "
		</tbody>
		</table>
		";
	}
	
	
}
$content .='
                                    
                                </div><!-- /.box-body-->
                                
                            </div><!-- /.box -->
                            </form>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->
            ';

$plugins = '<script language="javascript">
//ispay
$(\'input#kategori\').on(\'ifChecked\', function(event){
	document.getElementById("olt").style.display = "";
	document.getElementById("cabang").style.display = "none";
});
$(\'input#kategori\').on(\'ifUnchecked\', function(event){
	document.getElementById("cabang").style.display = "";
	document.getElementById("olt").style.display = "none";
});
</script>
';

    $title	= 'List Inactive OLT';
    $submenu	= "inet_server_ras";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
		
	}
} else{
	header('location: '.URL_CSO.'logout.php');
}

?>