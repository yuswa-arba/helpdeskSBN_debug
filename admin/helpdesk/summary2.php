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
                                    <h3 class="box-title">Summary</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								<a href="summary_complaint.php" class="btn bg-maroon btn-flat margin">Summary Complaint</a>
								<div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#cso" data-toggle="tab">CSO</a></li>
                                    <li><a href="#teknisimnt" data-toggle="tab">Teknisi</a></li>
									<li><a href="#teknisifo" data-toggle="tab">Teknisi FO</a></li>
									<li><a href="#teknisiwil" data-toggle="tab">Teknisi Wireless</a></li>
                                    <li><a href="#marketing" data-toggle="tab">Marketing</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="cso">
                                        <table style="width:60%;" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th rowspan="2" width="3%">No.</th>
					<th rowspan="2" >CSO</th>
					<th colspan="2" style="text-align:center;">'.date("F").'</th>
                  </tr>
				  <tr>
			<th>SPK</th>
			<th>Complaint</th>
                  </tr>
                </thead>
                <tbody>';

//<th width="2%">#</th>

$sql_complaint_total 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
							WHERE `date_add` LIKE '%".date("Y-m")."%' AND `level` = '0';", $conn);
$row_complaint_total 	= mysql_fetch_array($sql_complaint_total);
//echo "SELECT SUM(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
//							WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";

$sql_spk_total		= mysql_query("SELECT COUNT(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
							WHERE `date_add` LIKE '%".date("Y-m")."%' AND `level` = '0';", $conn);
//echo "SELECT SUM(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
//							WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
$row_spk_total = mysql_fetch_array($sql_spk_total);

$content .='<tr>
		<td>&nbsp;</td>
		<td style="text-align:center;">Total</td>
		<td>'.$row_spk_total["total"].'</td>
		<td>'.$row_complaint_total["total"].'</td>
		
	    </tr>';

	$no = 1;
	$id_cso			= $loggedin["id_employee"];
	$sql_pegawai 	= mysql_query("SELECT * FROM `gx_pegawai`
									WHERE `id_bagian` = 'CSO' AND `level` = '0' 
									ORDER BY `nama` ASC;", $conn);
	while($row_pegawai = mysql_fetch_array($sql_pegawai))
	{
	    $sql_complaint 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `date_add` LIKE '%".date("Y-m")."%' AND `level` = '0';", $conn);
		$row_complaint 	= mysql_fetch_array($sql_complaint);
		//echo "SELECT SUM(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
		//							WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		
		$sql_spk		= mysql_query("SELECT COUNT(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `date_add` LIKE '%".date("Y-m")."%' AND `level` = '0';", $conn);
		//echo "SELECT SUM(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
		//						WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		$row_spk = mysql_fetch_array($sql_spk);
	
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$row_pegawai["nama"].'</td>
		<td>'.$row_spk["total"].'</td>
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
									WHERE `id_bagian` = 'Teknisi' AND `bagian` = '3' AND `level` = '0' 
									ORDER BY `nama` ASC;", $conn);
	while($row_pegawai = mysql_fetch_array($sql_pegawai))
	{
	    $sql_complaint 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';", $conn);
		$row_complaint 	= mysql_fetch_array($sql_complaint);
		//echo "SELECT SUM(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
		//							WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		
		$sql_spk		= mysql_query("SELECT COUNT(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';", $conn);
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
									WHERE `id_bagian` = 'Teknisi' AND `bagian` = '7' AND `level` = '0' 
									ORDER BY `nama` ASC;", $conn);
	while($row_pegawai = mysql_fetch_array($sql_pegawai))
	{
	    $sql_complaint 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';", $conn);
		$row_complaint 	= mysql_fetch_array($sql_complaint);
		//echo "SELECT SUM(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
		//							WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		
		$sql_spk		= mysql_query("SELECT COUNT(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';", $conn);
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
									WHERE `id_bagian` = 'Teknisi' AND `bagian` = '8' AND `level` = '0' 
									ORDER BY `nama` ASC;", $conn);
	while($row_pegawai = mysql_fetch_array($sql_pegawai))
	{
	    $sql_complaint 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';", $conn);
		$row_complaint 	= mysql_fetch_array($sql_complaint);
		//echo "SELECT SUM(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
		//							WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		
		$sql_spk		= mysql_query("SELECT COUNT(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';", $conn);
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
									WHERE `id_bagian` = 'Marketing' AND `level` = '0' 
									ORDER BY `nama` ASC;", $conn);
	while($row_pegawai = mysql_fetch_array($sql_pegawai))
	{
	    $sql_complaint 	= mysql_query("SELECT COUNT(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';", $conn);
		$row_complaint 	= mysql_fetch_array($sql_complaint);
		//echo "SELECT SUM(`id_complaint`) AS `total` FROM `gx_helpdesk_complaint`
		//							WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		
		$sql_spk		= mysql_query("SELECT COUNT(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
									WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';", $conn);
		//echo "SELECT SUM(`id_spk`) AS `total` FROM `gx_helpdesk_spk`
		//						WHERE `id_cso` = '".$row_pegawai["id_employee"]."' AND `level` = '0';<br>";
		$row_spk = mysql_fetch_array($sql_spk);
	
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$row_pegawai["nama"].'</td>
		<td>'.$row_spk["total"].'</td>
		<td>'.$row_complaint["total"].'</td>
		
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
$plugins	= '

        <!-- DATA TABLES -->
        <link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable({
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
            });
			});
        </script>';

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