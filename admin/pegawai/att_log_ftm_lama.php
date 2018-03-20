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
if($loggedin = logged_inAdmin()){
// Check if they are logged in
 
//SQL 
$table_main = "";
$table_detail = "";

    $title_header = 'List Data Absensi Fingerspot';
    $submenu_header = '';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open log pegawai");
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
                                <div class="box-header">
                                    <h3 class="box-title">LIST DATA</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table">
									<form action="" method="post" name="form_search">
										<div class="form-group">
										<div class="row">
										<div class="col-xs-2">
											<label>Nama Staff</label>
										</div>
										<div class="col-xs-4">
											<input class="form-control" type="hidden" name="id_employee">
											<input class="form-control" type="text" name="nama_pegawai" placeholder="Nama Pegawai">
										</div>
										
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
										<div class="col-xs-2">
											<label>Tanggal </label>
										</div>
										<div class="col-xs-2">
											<input class="form-control" id="datepicker" name="start_date" type="text" placeholder="Tanggal Awal">
											
										</div>
										<div class="col-xs-2">
											<label>s/d </label>
										</div>
										<div class="col-xs-2">
											<input class="form-control" id="datepicker" type="text" name="end_date" placeholder="Tanggal Akhir">
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
						</div>
										</div>
										</div>
										</div>
						
						<div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">LIST DATA</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">	

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>PIN</th>
			<th>NIP</th>
			<th>Nama</th>
			<th>Scan Date</th>
			<th>Verify Mode</th>
                  </tr>
                </thead>
                <tbody>';
//select data
if(isset($_GET["id"]))
{
	$sql_data		= mysql_query("SELECT * FROM `fingerspot`.`att_log` WHERE `pin` = '".$_GET['id']."' ORDER BY `scan_date` DESC LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `fingerspot`.`att_log` WHERE `pin` = '".$_GET['id']."';", $conn));
}else{
	$sql_data		= mysql_query("SELECT * FROM `fingerspot`.`att_log` ORDER BY `scan_date` DESC LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `fingerspot`.`att_log`;", $conn));
}
    
    $hal		= "?";
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	$sql_data_pegawai		= mysql_query("SELECT * FROM `fingerspot`.`pegawai` WHERE `pegawai_pin` = '".$row_data['pin']."';", $conn);
	$row_data_pegawai 		= mysql_fetch_array($sql_data_pegawai);
	$verify = '';
	if($row_data['verifymode'] == '1'){
		$verify = 'jari';	
	}elseif($row_data['verifymode'] == '2'){
		$verify = 'Password';	
	}elseif($row_data['verifymode'] == '20'){
		$verify = 'Wajah';	
	}
	
	$content .= '<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data['pin'].'</td>
			<td>'.$row_data_pegawai['pegawai_nip'].'</td>
			<td>'.$row_data_pegawai['pegawai_nama'].'</td>
			<td>'.$row_data['scan_date'].'</td>
			<td>'.$verify.'</td>
		    </tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>
<br />
           
	    <div class="box-footer">
		<div class="box-tools pull-right">
		'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
		</div>
		<br style="clear:both;">
	     </div>
       </div>
	</section>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= $title_header;
    $submenu	= $submenu_header;
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>