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

    $title_header = 'Master Pegawai fingerspot';
    $submenu_header = 'master_pegawai';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master pegawai");
    global $conn;
 

    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }

$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Report Absensi</h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			   
					<form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Report Absensi</h3>
                                </div>
                                <div class="box-body table-responsive">
                                    <form action="" method="post" name="form_search">
									<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
											<label>Tanggal</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control hasDatepicker" id="datepicker"  name="date_awal" id="date" value="">
											</div>
											<div class="col-xs-2">
											<label>Sampai</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control hasDatepicker" id="datepicker"  name="date_akhir" id="date" value="">
											</div>
										</div>
										</div>
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>Nama Pegawai</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" type="text" name="nama" placeholder="Nama Pegawai">
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
			<th>No</th>
			<th>Tanggal</th>
			<th>Msk</th>
			<th>Plg</th>
			<th>Ket</th>
			<th>Hari</th>
			<th>Jk</th>
			<th>Mt</th>
			<th>Ma</th>
			<th>Mb</th>
			<th>JLB</th>
			<th>JLL</th>
			<th>Shift</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("SELECT * FROM `fingerspot`.`att_log` WHERE `fingerspot`.`att_log`.`pin` = '913' LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `fingerspot`.`att_log` WHERE `fingerspot`.`att_log`.`pin` = '913';", $conn));
    $hal		= "?";
    $no = $start + 1;
	
    while($row_data = mysql_fetch_array($sql_data))
    {
		$tanggal = date("d/F/Y", strtotime($row_data['scan_date']));
	$content .= '<tr>
			<td>'.$no.'.</td>
			<td>'.$tanggal.'</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		    </tr>';
	$no++;
    }
    
    

$content .='</tbody>
</table>
'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
</div>
<br />
            </div>
	    <div class="box-footer">
		<div class="box-tools pull-right">
		
		</div>
		<br style="clear:both;">
	     </div>
       </div>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("[id=datepicker]").datepicker({format: "yyyy-mm-dd"});
            });
        </script>';
		
		
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