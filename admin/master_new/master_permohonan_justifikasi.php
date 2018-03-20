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
    
    global $conn_helpdesk;
    global $conn;
$ttl  = "";

$ttl .= (isset($_GET['type']) && $_GET['type'] == "complaint") ? "List Incoming Complaint" : "";
$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Master Permohonan Justifikasi
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				    <a href="form_permohonan_justifikasi.php" class="btn bg-maroon btn-flat margin">Add Permohonan Justifikasi</a>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">'.$ttl.'</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				';

$type = isset($_GET['type']) ? $_GET['type'] : '';
// enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Helpdesk $type");

$content .='';

$content .= '
 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>	<th width="3%">no</th>
			<th width="5%">Tanggal</th>
			<th width="8%">Nama Customer</th>
			<th width="10%">Nama Paket</th>	
			<th width="8%">Kontrak</th>
			<th>Remarks</th>
			<th width="10%">Action</th>
			<!--<th width="2%">#</th>-->
                  </tr>
                </thead>
                <tbody>';


    $sql_permohonan_justifikasi	= mysql_query("SELECT `id_permohonan_justifikasi`, `no_justifikasi`, `tanggal`, `kode_customer`, `nama_customer`, `longitude`, `latitude`, `tiang_terdekat`, `kode_paket`, `nama_paket`, `kontrak`, `setup_fee_normal`, `abonemen_normal`, `monthly_fee_normal`, `bandwith_normal`, `setup_fee_justifikasi`, `abonemen_justifikasi`, `monthly_fee_justifikasi`, `bandwith_justifikasi`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_permohonan_justifikasi`
			    WHERE `level` =  '0'
			    ORDER BY  `date_add` DESC;", $conn);
    $no = 1;

    while($r_permohonan_justifikasi = mysql_fetch_array($sql_permohonan_justifikasi))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$r_permohonan_justifikasi['tanggal'].'</td>
			<td>'.$r_permohonan_justifikasi['nama_customer'].'</td>
			<td>'.$r_permohonan_justifikasi['nama_paket'].'</td>
			<td>'.$r_permohonan_justifikasi['kontrak'].'</td>
			<td>'.$r_permohonan_justifikasi['remarks'].'</td>
			<!--<td><a href="detail_permohonan_justifikasi.php?id_permohonan_justifikasi='.$r_permohonan_justifikasi["id_permohonan_justifikasi"].'"> View </a> || <a href="form_permohonan_justifikasi.php?id_permohonan_justifikasi='.$r_permohonan_justifikasi["id_permohonan_justifikasi"].'">edit</a></td>-->
			<td><a href="detail_permohonan_justifikasi.php?id_permohonan_justifikasi='.$r_permohonan_justifikasi["id_permohonan_justifikasi"].'" onclick="return valideopenerform(\'detail_permohonan_justifikasi.php?id_permohonan_justifikasi='.$r_permohonan_justifikasi["id_permohonan_justifikasi"].'\',\'permohonan_justifikasi\');">Details</a> || <a href="form_permohonan_justifikasi.php?id_permohonan_justifikasi='.$r_permohonan_justifikasi["id_permohonan_justifikasi"].'">edit</a></td>
			
			<!--<td><input type="checkbox" name="id_permohonan_justifikasi[]" value="'.$r_permohonan_justifikasi["id_permohonan_justifikasi"].'"></td>-->
		</tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>';

$submenu	= "master_permohonan_justifikasi";



 
 $content .='<br />
            </div> 
       </div>';

}else{
    $content ='
        <div class="box round first">
            <h2> Sorry, You don\'t have permission to access this Page</h2>
                <div class="block">
                   
                </div> 
       </div>';
    $submenu	= "master_dashboard";
}

//<script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
//
$plugins = '

        <!-- DATA TABLES -->
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
            });
        </script>';

    $title	= 'Master';
    
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