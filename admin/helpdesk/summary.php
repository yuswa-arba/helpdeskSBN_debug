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
if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}

     global $conn;

	$start1		= isset($_GET["start"]) ? trim(strip_tags($_GET["start"])) : "";
	$end1		= isset($_GET["end"]) ? trim(strip_tags($_GET["end"])) : "";
$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Summary Complaint
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">'.(isset($_GET["start"]) ? "Summary Periode $start1 sampai $end1" : "Summary Hari ini").'</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								<form action="" method="get" name="form_search">
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-3">
					    <label>Periode</label>
					</div>
					<div class="col-xs-3">
					    
					</div>
					<div class="col-xs-1">
					    
					</div>
					<div class="col-xs-3">
					    
					</div>
				    </div>
					
					<div class="form-group">
				    <div class="row">
						<div class="col-xs-2">
							<label>Start</label>
						</div>
						<div class="col-xs-3">
							<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" name="start" value="'.date("Y-m-d").'">
						</div>
					</div>
				    </div>
					
					<div class="form-group">
				    <div class="row">
						<div class="col-xs-2">
							<label>End</label>
						</div>
						<div class="col-xs-3">
							<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" name="end" value="'.date("Y-m-d").'">
						</div>
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    <input class="btn bg-olive btn-flat" value="Search" type="submit">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
	</form>
	<hr>
								<div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#cso" data-toggle="tab">CSO</a></li>
									<li><a href="#teknisimnt" data-toggle="tab">Teknisi Maintenance</a></li>
									<li><a href="#teknisifo" data-toggle="tab">Teknisi FO</a></li>
									<li><a href="#teknisiwil" data-toggle="tab">Teknisi Wireless</a></li>
                                    <li><a href="#marketing" data-toggle="tab">Marketing</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="cso">
                                        <table style="width:100%;" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th rowspan="2" width="3%">No.</th>
					<th rowspan="2" >CSO</th>
					<th colspan="6" style="text-align:center;">'.date("F").'</th>
                  </tr>
				  <tr>
			<th>SPK</th>
			<th>Complaint by Phone</th>
			<th>Complaint by Email</th>
			<th>Complaint by Website</th>
			<th>Complaint by SMS</th>
			<th>Complaint by Walkin</th>
                  </tr>
                </thead>
                <tbody>';

//<th width="2%">#</th>
$start		= isset($_GET["start"]) ? trim(strip_tags($_GET["start"]))." 00:00:00" : date("Y-m-d 00:00:00");
$end		= isset($_GET["end"]) ? trim(strip_tags($_GET["end"]))." 23:59:59" : date("Y-m-d 23:59:59");

$sql_start 	= "AND `date_add` >= '$start'";
$sql_end 	= "AND `date_add` <= '$end'";

$sql_complaint_total 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
							WHERE `level` = '0'
							$sql_start $sql_end;", $conn);

$row_complaint_total 	= mysql_fetch_array($sql_complaint_total);

//phone
$sql_complaint_total1 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
							WHERE `level` = '0' AND `media` = 'telephone'
							$sql_start $sql_end;", $conn);

$row_complaint_total1 	= mysql_fetch_array($sql_complaint_total1);
//email
$sql_complaint_total2 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
							WHERE `level` = '0' AND `media` = 'email'
							$sql_start $sql_end;", $conn);

$row_complaint_total2 	= mysql_fetch_array($sql_complaint_total2);

//sms
$sql_complaint_total3 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
							WHERE `level` = '0' AND `media` = 'sms'
							$sql_start $sql_end;", $conn);

$row_complaint_total3 	= mysql_fetch_array($sql_complaint_total3);

//walkin
$sql_complaint_total4 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
							WHERE `level` = '0' AND `media` = 'walkin'
							$sql_start $sql_end;", $conn);

$row_complaint_total4	= mysql_fetch_array($sql_complaint_total4);

//website
$sql_complaint_total5 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
							WHERE `level` = '0' AND `media` = 'website'
							$sql_start $sql_end;", $conn);

$row_complaint_total5 	= mysql_fetch_array($sql_complaint_total5);

//echo "SELECT SUM(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
//							WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";

$sql_spk_total		= mysql_query("SELECT COUNT(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
							WHERE `level` = '0' 
							$sql_start $sql_end;", $conn);
//echo "SELECT SUM(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
//							WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
$row_spk_total = mysql_fetch_array($sql_spk_total);

$content .='<tr>
		<td>&nbsp;</td>
		<td style="text-align:center;">Total</td>
		<td>'.$row_spk_total["total"].'</td>
		<td>'.$row_complaint_total1["total"].'</td>
		<td>'.$row_complaint_total2["total"].'</td>
		<td>'.$row_complaint_total5["total"].'</td>
		<td>'.$row_complaint_total3["total"].'</td>
		<td>'.$row_complaint_total4["total"].'</td>
	    </tr>';

	$no = 1;
	$id_cso			= $loggedin["id_employee"];
	$sql_pegawai 	= mysql_query("SELECT * FROM `gx_pegawai`
									WHERE `id_bagian` = 'CSO' AND `id_cabang` = '6' AND `aktif` = '0' AND `level` = '0' 
									ORDER BY `nama` ASC;", $conn);
	while($row_pegawai = mysql_fetch_array($sql_pegawai))
	{
	    $sql_complaint 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0' $sql_start $sql_end;", $conn);
		$row_complaint 	= mysql_fetch_array($sql_complaint);
		//by phone
		$sql_complaint_phone 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `media` = 'telephone' AND `level` = '0' $sql_start $sql_end;", $conn);
		$row_complaint_phone 	= mysql_fetch_array($sql_complaint_phone);
		//by email
		$sql_complaint_email 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `media` = 'email' AND `level` = '0' $sql_start $sql_end;", $conn);
		$row_complaint_email 	= mysql_fetch_array($sql_complaint_email);
		//by sms
		$sql_complaint_sms 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `media` = 'sms' AND `level` = '0' $sql_start $sql_end;", $conn);
		$row_complaint_sms 	= mysql_fetch_array($sql_complaint_sms);
		//by website
		$sql_complaint_website 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `media` = 'website' AND `level` = '0' $sql_start $sql_end;", $conn);
		$row_complaint_website 	= mysql_fetch_array($sql_complaint_website);
		//by walkin
		$sql_complaint_walkin 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `media` = 'walkin' AND `level` = '0' $sql_start $sql_end;", $conn);
		$row_complaint_walkin 	= mysql_fetch_array($sql_complaint_walkin);
		//echo "SELECT SUM(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
		//							WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		
		$sql_spk		= mysql_query("SELECT COUNT(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0' $sql_start $sql_end;", $conn);
		//echo "SELECT SUM(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
		//						WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		$row_spk = mysql_fetch_array($sql_spk);
	
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td><a href="summary_complaint2.php?id='.$row_pegawai["id_employee"].'&start='.$start1.'&end='.$end1.'">'.$row_pegawai["nama"].'</a></td>
		<td>'.$row_spk["total"].'</td>
		<td>'.$row_complaint_phone["total"].'</td>
		<td>'.$row_complaint_email["total"].'</td>
		<td>'.$row_complaint_sms["total"].'</td>
		<td>'.$row_complaint_website["total"].'</td>
		<td>'.$row_complaint_walkin["total"].'</td>
		
	    </tr>';
	    $no++;
	}
//<td><input type="checkbox" name="id_complaint[]" value="'.$r_complaint["id_complaint"].'"></td>
$content .='</tbody>

</table>
                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="teknisimnt">
                                        <table style="width:60%;" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th rowspan="2" width="3%">No.</th>
					<th rowspan="2" >Teknisi</th>
					<th colspan="3" style="text-align:center;">'.date("F").'</th>
                  </tr>
				  <tr>
			<th>Maintenance</th>
			<th>Bongkar</th>
			<th>Pasang Baru</th>
                  </tr>
                </thead>
                <tbody>';


	$no = 1;
	$id_cso			= $loggedin["id_employee"];
	$sql_pegawai 	= mysql_query("SELECT * FROM `gx_pegawai`
									WHERE `id_bagian` = 'Teknisi' AND `id_cabang` = '6' AND `aktif` = '0' AND `bagian` = '3' AND `level` = '0' 
									ORDER BY `nama` ASC;", $conn);
	while($row_pegawai = mysql_fetch_array($sql_pegawai))
	{
	    $sql_complaint 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0' $sql_start $sql_end;", $conn);
		$row_complaint 	= mysql_fetch_array($sql_complaint);
		//echo "SELECT SUM(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
		//							WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		
		$sql_spk		= mysql_query("SELECT COUNT(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0' $sql_start $sql_end;", $conn);
		//echo "SELECT SUM(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
		//						WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		$row_spk = mysql_fetch_array($sql_spk);
	
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$row_pegawai["nama"].'</td>
		<td>'.$row_spk["total"].'</td>
		<td>'.$row_complaint["total"].'</td>
		<td>'.$row_complaint["total"].'</td>
	    </tr>';
	    $no++;
	}
//<td><input type="checkbox" name="id_complaint[]" value="'.$r_complaint["id_complaint"].'"></td>
$content .='</tbody>

</table>
                                    </div><!-- /.tab-pane -->
									<div class="tab-pane" id="teknisifo">
                                        <table style="width:60%;" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th rowspan="2" width="3%">No.</th>
					<th rowspan="2" >Teknisi</th>
					<th colspan="3" style="text-align:center;">'.date("F").'</th>
                  </tr>
				  <tr>
			<th>Maintenance</th>
			<th>Bongkar</th>
			<th>Pasang Baru</th>
                  </tr>
                </thead>
                <tbody>';


	$no = 1;
	$id_cso			= $loggedin["id_employee"];
	$sql_pegawai 	= mysql_query("SELECT * FROM `gx_pegawai`
									WHERE `id_bagian` = 'Teknisi' AND `id_cabang` = '6' AND `aktif` = '0' AND `bagian` = '7' AND `level` = '0' 
									ORDER BY `nama` ASC;", $conn);
	while($row_pegawai = mysql_fetch_array($sql_pegawai))
	{
	    $sql_complaint 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0' $sql_start $sql_end;", $conn);
		$row_complaint 	= mysql_fetch_array($sql_complaint);
		//echo "SELECT SUM(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
		//							WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		
		$sql_spk		= mysql_query("SELECT COUNT(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0' $sql_start $sql_end;", $conn);
		//echo "SELECT SUM(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
		//						WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		$row_spk = mysql_fetch_array($sql_spk);
	
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$row_pegawai["nama"].'</td>
		<td>'.$row_spk["total"].'</td>
		<td>'.$row_complaint["total"].'</td>
		<td>'.$row_complaint["total"].'</td>
	    </tr>';
	    $no++;
	}
//<td><input type="checkbox" name="id_complaint[]" value="'.$r_complaint["id_complaint"].'"></td>
$content .='</tbody>

</table>
                                    </div><!-- /.tab-pane -->
									<div class="tab-pane" id="teknisimnt">
                                        <table style="width:60%;" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th rowspan="2" width="3%">No.</th>
					<th rowspan="2" >Teknisi</th>
					<th colspan="3" style="text-align:center;">'.date("F").'</th>
                  </tr>
				  <tr>
			<th>Maintenance</th>
			<th>Bongkar</th>
			<th>Pasang Baru</th>
                  </tr>
                </thead>
                <tbody>';


	$no = 1;
	$id_cso			= $loggedin["id_employee"];
	$sql_pegawai 	= mysql_query("SELECT * FROM `gx_pegawai`
									WHERE `id_bagian` = 'Teknisi' AND `id_cabang` = '6' AND `aktif` = '0'AND `bagian` = '8' AND `level` = '0' 
									ORDER BY `nama` ASC;", $conn);
	while($row_pegawai = mysql_fetch_array($sql_pegawai))
	{
	    $sql_complaint 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0' $sql_start $sql_end;", $conn);
		$row_complaint 	= mysql_fetch_array($sql_complaint);
		//echo "SELECT SUM(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
		//							WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		
		$sql_spk		= mysql_query("SELECT COUNT(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0' $sql_start $sql_end ;", $conn);
		//echo "SELECT COUNT(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
		//							WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0' $sql_start $sql_end ;";
		$row_spk = mysql_fetch_array($sql_spk);
	
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$row_pegawai["nama"].'</td>
		<td>'.$row_spk["total"].'</td>
		<td>'.$row_complaint["total"].'</td>
		<td>'.$row_complaint["total"].'</td>
	    </tr>';
	    $no++;
	}
//<td><input type="checkbox" name="id_complaint[]" value="'.$r_complaint["id_complaint"].'"></td>
$content .='</tbody>

</table>
                                    </div><!-- /.tab-pane -->
									<div class="tab-pane" id="marketing">
                                        <table style="width:60%;" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th width="3%">No.</th>
					<th>Marketing</th>
					<th style="text-align:center;">'.date("F").'</th>
                  </tr>
				  
                </thead>
                <tbody>';


	$no = 1;
	$id_cso			= $loggedin["id_employee"];
	$sql_pegawai 	= mysql_query("SELECT * FROM `gx_pegawai`
									WHERE `id_bagian` = 'Marketing' AND `id_cabang` = '6' AND `aktif` = '0' AND `level` = '0' 
									ORDER BY `nama` ASC;", $conn);
	while($row_pegawai = mysql_fetch_array($sql_pegawai))
	{
	    $sql_complaint 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0' $sql_start $sql_end;", $conn);
		$row_complaint 	= mysql_fetch_array($sql_complaint);
		//echo "SELECT SUM(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
		//							WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		
		$sql_spk		= mysql_query("SELECT COUNT(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0' $sql_start $sql_end;", $conn);
		//echo "SELECT SUM(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
		//						WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		$row_spk = mysql_fetch_array($sql_spk);
	
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$row_pegawai["nama"].'</td>
		<td>'.$row_spk["total"].'</td>
		
		
	    </tr>';
	    $no++;
	}
//<td><input type="checkbox" name="id_complaint[]" value="'.$r_complaint["id_complaint"].'"></td>
$content .='</tbody>

</table>
                                    </div><!-- /.tab-pane -->
                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
    <br>
</div>
    <br />
            </div> 
       </div>';

$submenu	= "helpdesk_complaint";
$plugins	= '';

    $title	= 'Helpdesk';
    
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
     else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>