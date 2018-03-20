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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Generate Report");
     global $conn;
     //echo $loggedin["id_level"];
	 
	 
	 //paging
    $perhalaman = 50;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
	 
     $content ='<section class="content-header">
		     <h1>
			Report Bulanan
		     </h1>
		     
		 </section>
 
		 <!-- Main content -->
		 
		 <section class="content">
		     <div class="row">
                <div class="col-xs-10">
                <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Laporan Bulanan</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" name="form_generate"  method="POST" action="">
                    <div class="box-body">
					
                        <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                            <label>Bulan</label>
                            </div>
                            <div class="col-xs-3">
                                <select name="bulan" class="form-control">
									<option value="01" '.((date("m") == "01") ? 'selected=""' : '').'>Januari</option>
									<option value="02" '.((date("m") == "02") ? 'selected=""' : '').'>Februari</option>
									<option value="03" '.((date("m") == "03") ? 'selected=""' : '').'>Maret</option>
									<option value="04" '.((date("m") == "04") ? 'selected=""' : '').'>April</option>
									<option value="05" '.((date("m") == "05") ? 'selected=""' : '').'>Mei</option>
									<option value="06" '.((date("m") == "06") ? 'selected=""' : '').'>Juni</option>
									<option value="07" '.((date("m") == "07") ? 'selected=""' : '').'>Juli</option>
									<option value="08" '.((date("m") == "08") ? 'selected=""' : '').'>Agustus</option>
									<option value="09" '.((date("m") == "09") ? 'selected=""' : '').'>September</option>
									<option value="10" '.((date("m") == "10") ? 'selected=""' : '').'>Oktober</option>
									<option value="11" '.((date("m") == "11") ? 'selected=""' : '').'>November</option>
									<option value="12" '.((date("m") == "12") ? 'selected=""' : '').'>Desember</option>
								</select>
                            </div>
							<div class="col-xs-3">
                            <label>Tahun</label>
                            </div>
                            <div class="col-xs-3">
                                <select name="tahun" class="form-control">
									';
								for($thn=2012;$thn<=date("Y"); $thn++)
								{
								   $content .= '<option value="'.$thn.'" '.((date("Y") == $thn) ? 'selected=""' : '').'>'.$thn.'</option>';
								}
$content .='</select>
                            </div>
                        </div>
                        </div>
						';
			 
if($loggedin["id_level"] == "Kabag")
{
	
	$content .='<div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                            <label>CSO</label>
                            </div>
                            <div class="col-xs-6">
							<select name="cso" class="form-control">
								<option value="">All CSO</option>';
								$data_cso = "SELECT * FROM `gx_pegawai` WHERE `aktif`='0' AND `id_bagian` = 'CSO' AND `id_cabang` = '".$loggedin["cabang"]."' ORDER BY `nama` ASC;";
								$data_query_cso = mysql_query($data_cso, $conn);
								while($row_cso = mysql_fetch_array($data_query_cso))
								{
									$content .= '<option value="'.$row_cso['id_employee'].'">'.$row_cso['nama'].'</option>';
								}
$content .= '
												</select>
                            </div>
                        </div>
                        </div>';
}
else
{
	$content .= '<input type="hidden" style="" name="cso" value="'.$loggedin["id_employee"].'" />';
}
$content .='					
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <input type="submit" name="generate" value="Generate" />
                    </div>
                </form>
            </div><!-- /.box -->
                </div>
		     </div>';
			 
if(isset($_POST["generate"])){
    $bulan		= isset($_POST["bulan"]) ? trim(strip_tags($_POST["bulan"])) : "";
    $tahun		= isset($_POST["tahun"]) ? trim(strip_tags($_POST["tahun"])) : "";
	$cso		= isset($_POST["cso"]) ? trim(strip_tags($_POST["cso"])) : "";
    
	$sql_date		= ($tahun != "") ? "AND `date_add` LIKE '%$tahun-$bulan-%'" : "";
    $sql_cso		= ($cso != "") ? "AND `id_cso` = '$cso'" : "";
   
	$sql_complaint = mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0'
					$sql_date
					$sql_cso
				       ORDER BY `gx_helpdesk_complaint`.`date_add`
				       DESC LIMIT $start, $perhalaman;", $conn);
	
	$sql_total_compliant = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0'
					$sql_date
					$sql_cso
				       ORDER BY `gx_helpdesk_complaint`.`date_add`;", $conn));
	$sql_total_compliant_phone = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0' AND `media`= 'telephone' 
					$sql_date
					$sql_cso
				       ORDER BY `gx_helpdesk_complaint`.`date_add`;", $conn));
	$sql_total_compliant_email = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0'  AND `media`= 'email'
					$sql_date
					$sql_cso
				       ORDER BY `gx_helpdesk_complaint`.`date_add`;", $conn));
	$sql_total_compliant_website = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0' AND `media`= 'website'
					$sql_date
					$sql_cso
				       ORDER BY `gx_helpdesk_complaint`.`date_add`;", $conn));
	$sql_total_compliant_sms = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0' AND `media`= 'sms'
					$sql_date
					$sql_cso
				       ORDER BY `gx_helpdesk_complaint`.`date_add`;", $conn));
	$sql_total_compliant_walkin = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0' AND `media`= 'walkin'
					$sql_date
					$sql_cso
				       ORDER BY `gx_helpdesk_complaint`.`date_add`;", $conn));
	$sql_total_compliant_voice = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0' AND `media`= 'voicemail'
					$sql_date
					$sql_cso
				       ORDER BY `gx_helpdesk_complaint`.`date_add`;", $conn));
    
    $hal= "?cso=$cso&d=$tahun-$bulan&";
    $no = $start + 1;
	
	
	$sql_problem = mysql_query("SELECT * FROM `gx_cso_problem` ORDER BY `id_problem` ASC;", $conn);
	
	
	$content .= '<div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Report Bulanan</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								
								
	<div>
	<h4>Total Bulan '.$bulan .'-'.$tahun.' : '.$sql_total_compliant.' Complaint</h4><br>
	
		<div class="row">
			<div class="col-xs-12 col-md-4">
                  <p class="text-center">
                    <strong>Media</strong>
                  </p>

                  <div class="progress-group">
                    <span class="progress-text">Telephone</span>
                    <span class="progress-number"><b>'.$sql_total_compliant_phone.'</b>/'.$sql_total_compliant.'</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: '.(number_format((($sql_total_compliant_phone/$sql_total_compliant)*100),2)).'%"></div>
                    </div>
                  </div>				  
				  <div class="progress-group">
                    <span class="progress-text">Email</span>
                    <span class="progress-number"><b>'.$sql_total_compliant_email.'</b>/'.$sql_total_compliant.'</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: '.(number_format((($sql_total_compliant_email/$sql_total_compliant)*100),2)).'%"></div>
                    </div>
                  </div>
				  
				  <div class="progress-group">
                    <span class="progress-text">Website</span>
                    <span class="progress-number"><b>'.$sql_total_compliant_website.'</b>/'.$sql_total_compliant.'</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: '.(number_format((($sql_total_compliant_website/$sql_total_compliant)*100),2)).'%"></div>
                    </div>
                  </div>
				  <div class="progress-group">
                    <span class="progress-text">SMS</span>
                    <span class="progress-number"><b>'.$sql_total_compliant_sms.'</b>/'.$sql_total_compliant.'</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: '.(number_format((($sql_total_compliant_sms/$sql_total_compliant)*100),2)).'%"></div>
                    </div>
                  </div>
				  <div class="progress-group">
                    <span class="progress-text">Walkin</span>
                    <span class="progress-number"><b>'.$sql_total_compliant_walkin.'</b>/'.$sql_total_compliant.'</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: '.(number_format((($sql_total_compliant_walkin/$sql_total_compliant)*100),2)).'%"></div>
                    </div>
                  </div>
				  
				  <div class="progress-group">
                    <span class="progress-text">Voice Mail</span>
                    <span class="progress-number"><b>'.$sql_total_compliant_voice.'</b>/'.$sql_total_compliant.'</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: '.(number_format((($sql_total_compliant_voice/$sql_total_compliant)*100),2)).'%"></div>
                    </div>
                  </div>
                  
                
			</div>
			
			<div class="col-xs-12 col-md-4">
                  <p class="text-center">
                    <strong>Problem</strong>
                  </p>';
				
				$no_problem = 1;
				$array_color = ["","aqua","red","yellow","green"];
				while($row_problem = mysql_fetch_array($sql_problem))
				{
					
					if($row_problem["problem"] != "")
					{
						$sql_total_problem = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
								 WHERE `gx_helpdesk_complaint`.`level` = '0' AND `problem_select`= '".$row_problem["problem"]."'
								$sql_date
								$sql_cso
								   ORDER BY `gx_helpdesk_complaint`.`date_add`;", $conn));
						$content .= '<div class="progress-group">
										<span class="progress-text">'.$row_problem["problem"].'</span>
										<span class="progress-number"><b>'.$sql_total_problem.'</b>/'.$sql_total_compliant.'</span>
					
										<div class="progress sm">
										  <div class="progress-bar progress-bar-'.$array_color[(($no_problem >= 4) ? ($no_problem % 4) : 0)].'" style="width: '.(number_format((($sql_total_problem/$sql_total_compliant)*100),2)).'%"></div>
										</div>
									  </div>';
						
						$no_problem++;
					}
				}
				
				//1. Telephone : '.$sql_total_compliant_phone.' Complaint<br>
				//2. Email : '.$sql_total_compliant_email.' Complaint<br>
				//3. Website : '.$sql_total_compliant_website.' Complaint<br>
				//4. SMS : '.$sql_total_compliant_sms.' Complaint<br>
				//5. Walkin : '.$sql_total_compliant_walkin.' Complaint<br><br><br>

$content .='	
			</div>
			
		</div>
	</div>

    <table id="complaint" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th width="10%">CSO</th>
			<th width="8%">User ID</th>
			<th width="8%">Tanggal</th>
			<th width="10%">Media</th>
			<th width="10%">Problem</th>
			<th width="10%" style="text-align:center">Problem</th>
			<th width="10%">Status</th>
			
                  </tr>
                </thead>
                <tbody>';
				
	while($r_complaint = mysql_fetch_array($sql_complaint))
	{
	    $trouble_ticket ='';
	    if($r_complaint['trouble_ticket'] == 1){
		$trouble_ticket .= '<a href="detail_troubleticket.php?id_troubleticket='.$r_complaint["id_complaint"].'" onclick="return valideopenerform(\'detail_troubleticket.php?id_troubleticket='.$r_complaint["id_complaint"].'\',\'complaint\');">Detail TroubleTicket</a>';
	    
	    }else{
		$trouble_ticket .= '<a href="form_troubleticket.php?id_complaint='.$r_complaint["id_complaint"].'">Create TroubleTicket</a>';
	    }
		
		if($r_complaint["status"] == "open")
		{
			$status = '<span class="label label-danger">Open</span>';
		}elseif($r_complaint["status"] == "closed")
		{
			$status = '<span class="label label-success">Closed</span>';
		}elseif($r_complaint["status"] == "reopen")
		{
			$status = '<span class="label label-warning">Reopen</span>';
		}else
		{
			$status = '<span class="label label-info">No Status</span>';
		}
	    
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$r_complaint["created_by"].'</td>
		<td>'.$r_complaint["user_id"].'</td>
		<td>'.date("d-m-Y", strtotime($r_complaint["date_add"])).'</td>
		<td>'.$r_complaint["media"].'</td>
		<td>'.$r_complaint["problem_select"].'</td>
		<td><a href="detail_incoming.php?id_complaint='.$r_complaint["id_complaint"].'" onclick="return valideopenerform(\'detail_incoming.php?id_complaint='.$r_complaint["id_complaint"].'\',\'complaint\');">'.
		(($r_complaint["problem_select"]  != "" ) ? $r_complaint["problem_select"] : "Details").'</a></td>
		<td>'.$status.'</td>
		
	    </tr>';
	    $no++;
	}

$content .='</tbody>

</table><br>
</div><!-- /.box-body -->
								<div class="box-footer">
				   <div class="box-tools pull-right">
				   '.(halaman($sql_total_compliant, $perhalaman, 1, $hal)).'
				   </div>
				   <br style="clear:both;">
				</div>
                            </div><!-- /.box -->
                        </div>
                    </div>';
	
	
}
elseif(isset($_GET["cso"]))
{
	$d   		= isset($_GET["d"]) ? trim(strip_tags($_GET["d"])) : "";
    
	$cso		= isset($_GET["cso"]) ? trim(strip_tags($_GET["cso"])) : "";
    
	$sql_date		= ($d != "") ? "AND `date_add` LIKE '%$d-%'" : "";
    $sql_cso		= ($cso != "") ? "AND `id_cso` = '$cso'" : "";
    
	$sql_complaint = mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0'
					$sql_date
					$sql_cso
				       ORDER BY `gx_helpdesk_complaint`.`date_add`
				       DESC LIMIT $start, $perhalaman;", $conn);
	
	$sql_total_compliant = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0'
					$sql_date
					$sql_cso
				       ORDER BY `gx_helpdesk_complaint`.`date_add`;", $conn));
    
    $hal= "?cso=$cso&d=$d&";
    $no = $start + 1;
	
	$content .= '<div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Report Bulanan</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								
								
	<div>
	<h4>Total Bulan '.$d.' : '.$sql_total_compliant.' Complaint</h4>
	</div>

    <table id="complaint" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th width="10%">CSO</th>
			<th width="8%">User ID</th>
			<th width="8%">Tanggal</th>
			<th width="10%">Media</th>
			<th width="10%">Problem</th>
			<th width="10%" style="text-align:center">Problem</th>
			<th width="10%">Status</th>
			
                  </tr>
                </thead>
                <tbody>';
				
	while($r_complaint = mysql_fetch_array($sql_complaint))
	{
	    $trouble_ticket ='';
	    if($r_complaint['trouble_ticket'] == 1){
		$trouble_ticket .= '<a href="detail_troubleticket.php?id_troubleticket='.$r_complaint["id_complaint"].'" onclick="return valideopenerform(\'detail_troubleticket.php?id_troubleticket='.$r_complaint["id_complaint"].'\',\'complaint\');">Detail TroubleTicket</a>';
	    
	    }else{
		$trouble_ticket .= '<a href="form_troubleticket.php?id_complaint='.$r_complaint["id_complaint"].'">Create TroubleTicket</a>';
	    }
		
		if($r_complaint["status"] == "open")
		{
			$status = '<span class="label label-danger">Open</span>';
		}elseif($r_complaint["status"] == "closed")
		{
			$status = '<span class="label label-success">Closed</span>';
		}elseif($r_complaint["status"] == "reopen")
		{
			$status = '<span class="label label-warning">Reopen</span>';
		}else
		{
			$status = '<span class="label label-info">No Status</span>';
		}
	    
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$r_complaint["created_by"].'</td>
		<td>'.$r_complaint["user_id"].'</td>
		<td>'.date("d-m-Y", strtotime($r_complaint["date_add"])).'</td>
		<td>'.$r_complaint["media"].'</td>
		<td>'.$r_complaint["problem_select"].'</td>
		<td><a href="detail_incoming.php?id_complaint='.$r_complaint["id_complaint"].'" onclick="return valideopenerform(\'detail_incoming.php?id_complaint='.$r_complaint["id_complaint"].'\',\'complaint\');">'.
		(($r_complaint["problem_select"]  != "" ) ? $r_complaint["problem_select"] : "Details").'</a></td>
		<td>'.$status.'</td>
		
	    </tr>';
	    $no++;
	}

$content .='</tbody>

</table><br>
</div><!-- /.box-body -->
								<div class="box-footer">
				   <div class="box-tools pull-right">
				   '.(halaman($sql_total_compliant, $perhalaman, 1, $hal)).'
				   </div>
				   <br style="clear:both;">
				</div>
                            </div><!-- /.box -->
                        </div>
                    </div>';
}

$content .='</section><!-- /.content -->';


$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" /><!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
            });
        </script>
    ';

    $title	= 'Report Bulanan';
    $submenu	= "gen_report";
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